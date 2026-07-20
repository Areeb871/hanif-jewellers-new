<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

class BankAlfalahPaymentController extends Controller
{
    private const CURRENCY = 'PKR';

    private const IS_BIN = '0';

    /**
     * Keep the original sandbox test page working while the real checkout
     * uses start(). Credentials are always taken from server configuration.
     */
    public function handshake(Request $request): JsonResponse
    {
        abort_unless(app()->environment('local'), 404);

        $data = $request->validate([
            'HS_RequestHash' => ['required', 'string'],
            'HS_TransactionReferenceNumber' => [
                'required',
                'string',
                'max:40',
            ],
        ]);

        $gateway = $this->gatewayConfiguration([
            'handshake_url',
            'channel_id',
            'is_redirection_request',
            'return_url',
            'merchant_id',
            'store_id',
            'merchant_hash',
            'merchant_username',
            'merchant_password',
        ]);

        $payload = [
            'HS_RequestHash' => $data['HS_RequestHash'],
            'HS_IsRedirectionRequest' => $gateway['is_redirection_request'],
            'HS_ChannelId' => $gateway['channel_id'],
            'HS_ReturnURL' => $gateway['return_url'],
            'HS_MerchantId' => $gateway['merchant_id'],
            'HS_StoreId' => $gateway['store_id'],
            'HS_MerchantHash' => $gateway['merchant_hash'],
            'HS_MerchantUsername' => $gateway['merchant_username'],
            'HS_MerchantPassword' => $gateway['merchant_password'],
            'HS_TransactionReferenceNumber' => trim(
                $data['HS_TransactionReferenceNumber']
            ),
        ];

        try {
            $response = Http::asForm()
                ->acceptJson()
                ->timeout(30)
                ->withoutRedirecting()
                ->post($gateway['handshake_url'], $payload);

            $body = $this->decodeBankResponse($response->body());

            if (! is_array($body)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bank Alfalah returned a non-JSON handshake response.',
                    'http_status' => $response->status(),
                    'redirect_url' => $response->header('Location'),
                ], 502);
            }

            return response()->json(
                $body,
                $response->successful() ? 200 : 422
            );
        } catch (Throwable $exception) {
            report($exception);

            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to Bank Alfalah sandbox.',
                'error' => config('app.debug')
                    ? $exception->getMessage()
                    : null,
            ], 502);
        }
    }

    /**
     * Start payment for an already-created pending order.
     *
     * The route is signed. The order reference and amount are read only from
     * the database, never from browser input.
     */
    public function start(Request $request, Order $order)
    {
        $data = $request->validate([
            'transaction_type' => ['nullable', 'integer', 'in:1,2,3'],
        ]);

        $this->ensureOrderBelongsToCurrentCustomer($request, $order);

        abort_unless($order->payment_method === 'bank_alfalah', 409);
        abort_unless(
            $order->status === 'pending'
                && $order->payment_status === 'pending',
            409
        );

        $amount = $this->canonicalAmount((string) $order->total_amount);
        abort_unless($amount !== null && $amount !== '0.00', 422);

        $reference = trim((string) $order->order_number);
        abort_unless($reference !== '' && strlen($reference) <= 40, 422);

        $transactionType = (string) ($data['transaction_type'] ?? 3);

        try {
            $gateway = $this->gatewayConfiguration([
                'handshake_url',
                'sso_url',
                'channel_id',
                'is_redirection_request',
                'return_url',
                'merchant_id',
                'store_id',
                'merchant_hash',
                'merchant_username',
                'merchant_password',
                'key_1',
                'key_2',
            ]);

            $handshakeHashFields = [
                'HS_ChannelId' => $gateway['channel_id'],
                'HS_IsRedirectionRequest' => $gateway['is_redirection_request'],
                'HS_MerchantId' => $gateway['merchant_id'],
                'HS_StoreId' => $gateway['store_id'],
                'HS_ReturnURL' => $gateway['return_url'],
                'HS_MerchantHash' => $gateway['merchant_hash'],
                'HS_MerchantUsername' => $gateway['merchant_username'],
                'HS_MerchantPassword' => $gateway['merchant_password'],
                'HS_TransactionReferenceNumber' => $reference,
            ];

            $handshakePayload = $handshakeHashFields + [
                'HS_RequestHash' => $this->encryptFields(
                    $handshakeHashFields,
                    $gateway['key_1'],
                    $gateway['key_2']
                ),
            ];

            $response = Http::asForm()
                ->acceptJson()
                ->timeout(30)
                ->withoutRedirecting()
                ->post($gateway['handshake_url'], $handshakePayload);

            $handshake = $this->decodeBankResponse($response->body());
            $successfulHandshake = is_array($handshake)
                && ($handshake['success'] ?? null) !== null
                && filter_var(
                    $handshake['success'],
                    FILTER_VALIDATE_BOOLEAN
                ) === true;
            $authToken = is_array($handshake)
                ? trim((string) ($handshake['AuthToken'] ?? ''))
                : '';

            if (! $response->successful() || ! $successfulHandshake
                || $authToken === '') {
                $message = is_array($handshake)
                    ? trim((string) (
                        $handshake['ErrorMessage']
                        ?? $handshake['message']
                        ?? ''
                    ))
                    : '';

                return response()->view('public.bank-alfalah-result', [
                    'success' => false,
                    'title' => 'Payment could not be started',
                    'message' => $message !== ''
                        ? $message
                        : 'Bank Alfalah handshake was unsuccessful.',
                    'orderNumber' => $reference,
                ], 502);
            }

            // RequestHash must be present as an empty value in the plaintext
            // in this exact order, matching Bank Alfalah's PHP sample.
            $ssoHashFields = [
                'AuthToken' => $authToken,
                'RequestHash' => '',
                'ChannelId' => $gateway['channel_id'],
                'Currency' => self::CURRENCY,
                'IsBIN' => self::IS_BIN,
                'ReturnURL' => $gateway['return_url'],
                'MerchantId' => $gateway['merchant_id'],
                'StoreId' => $gateway['store_id'],
                'MerchantHash' => $gateway['merchant_hash'],
                'MerchantUsername' => $gateway['merchant_username'],
                'MerchantPassword' => $gateway['merchant_password'],
                'TransactionTypeId' => $transactionType,
                'TransactionReferenceNumber' => $reference,
                'TransactionAmount' => $amount,
            ];

            $ssoFields = $ssoHashFields;
            $ssoFields['RequestHash'] = $this->encryptFields(
                $ssoHashFields,
                $gateway['key_1'],
                $gateway['key_2']
            );

            return view('public.bank-alfalah-redirect', [
                'ssoUrl' => $gateway['sso_url'],
                'fields' => $ssoFields,
                'orderNumber' => $reference,
            ]);
        } catch (Throwable $exception) {
            report($exception);

            return response()->view('public.bank-alfalah-result', [
                'success' => false,
                'title' => 'Payment could not be started',
                'message' => config('app.debug')
                    ? $exception->getMessage()
                    : 'Unable to connect to Bank Alfalah.',
                'orderNumber' => $reference,
            ], 502);
        }
    }

    /**
     * Bank Alfalah may append callback values either as query parameters or
     * path segments, e.g. /TS=P/RC=00/RD=/O=ORD-123.
     */
    public function handleReturn(Request $request)
    {
        $reference = $this->callbackReference($request);

        if ($reference === null) {
            return response()->view('public.bank-alfalah-result', [
                'success' => false,
                'title' => 'Payment status unavailable',
                'message' => 'The payment response did not include an order reference.',
                'orderNumber' => null,
            ], 400);
        }

        $order = Order::query()
            ->where('order_number', $reference)
            ->first();

        if (! $order) {
            return response()->view('public.bank-alfalah-result', [
                'success' => false,
                'title' => 'Order not found',
                'message' => 'No matching order was found for this payment.',
                'orderNumber' => $reference,
            ], 404);
        }

        if ($order->payment_method !== 'bank_alfalah') {
            return response()->view('public.bank-alfalah-result', [
                'success' => false,
                'title' => 'Payment status unavailable',
                'message' => 'This order does not use Bank Alfalah.',
                'orderNumber' => $reference,
            ], 409);
        }

        // Repeated browser returns are harmless once the payment is verified.
        if ($order->payment_status === 'verified') {
            return view('public.bank-alfalah-result', [
                'success' => true,
                'title' => 'Payment successful',
                'message' => 'Your payment has already been verified.',
                'orderNumber' => $reference,
            ]);
        }

        try {
            $gateway = $this->gatewayConfiguration([
                'order_status_url',
                'merchant_id',
                'store_id',
            ]);

            $statusUrl = rtrim($gateway['order_status_url'], '/')
                .'/'.rawurlencode($gateway['merchant_id'])
                .'/'.rawurlencode($gateway['store_id'])
                .'/'.rawurlencode($reference);

            $response = Http::acceptJson()
                ->timeout(30)
                ->withoutRedirecting()
                ->get($statusUrl);

            $status = $this->unwrapStatusResponse(
                $this->decodeBankResponse($response->body())
            );

            if (! $response->successful() || ! is_array($status)) {
                throw new RuntimeException(
                    'Bank Alfalah returned an invalid order-status response.'
                );
            }

            $verified = DB::transaction(function () use (
                $order,
                $status,
                $gateway,
                $reference
            ): bool {
                $lockedOrder = Order::query()
                    ->lockForUpdate()
                    ->findOrFail($order->id);

                if ($lockedOrder->payment_status === 'verified') {
                    return true;
                }

                if (! $this->isVerifiedPaidResponse(
                    $status,
                    $gateway,
                    $lockedOrder,
                    $reference
                )) {
                    return false;
                }

                $lockedOrder->forceFill([
                    'payment_status' => 'verified',
                    'status' => 'processing',
                ])->save();

                return true;
            });

            if (! $verified) {
                return response()->view('public.bank-alfalah-result', [
                    'success' => false,
                    'title' => 'Payment not verified',
                    'message' => 'Bank Alfalah has not confirmed this payment as paid.',
                    'orderNumber' => $reference,
                ], 422);
            }

            return view('public.bank-alfalah-result', [
                'success' => true,
                'title' => 'Payment successful',
                'message' => 'Your payment has been verified successfully.',
                'orderNumber' => $reference,
            ]);
        } catch (Throwable $exception) {
            report($exception);

            return response()->view('public.bank-alfalah-result', [
                'success' => false,
                'title' => 'Payment verification pending',
                'message' => config('app.debug')
                    ? $exception->getMessage()
                    : 'We could not verify the payment yet. Please try again later.',
                'orderNumber' => $reference,
            ], 502);
        }
    }

    private function ensureOrderBelongsToCurrentCustomer(
        Request $request,
        Order $order
    ): void {
        if ($request->user()) {
            abort_unless(
                (int) $order->user_id === (int) $request->user()->id,
                403
            );

            return;
        }

        abort_unless(
            $order->user_id === null
                && is_string($order->session_id)
                && hash_equals(
                    $order->session_id,
                    $request->session()->getId()
                ),
            403
        );
    }

    /**
     * @param  array<string, string>  $fields
     */
    private function encryptFields(
        array $fields,
        string $key,
        string $initializationVector
    ): string {
        if (strlen($key) !== 16 || strlen($initializationVector) !== 16) {
            throw new RuntimeException(
                'Bank Alfalah Key1 and Key2 must each be exactly 16 bytes.'
            );
        }

        // Bank's PHP sample concatenates raw key=value pairs; it does not URL
        // encode this plaintext before AES encryption.
        $mapString = implode('&', array_map(
            static fn (string $name, string $value): string => $name.'='.$value,
            array_keys($fields),
            array_values($fields)
        ));

        $cipherText = openssl_encrypt(
            $mapString,
            'aes-128-cbc',
            $key,
            OPENSSL_RAW_DATA,
            $initializationVector
        );

        if ($cipherText === false) {
            throw new RuntimeException(
                'Unable to generate the Bank Alfalah request hash.'
            );
        }

        return base64_encode($cipherText);
    }

    /**
     * @param  array<int, string>  $required
     * @return array<string, string>
     */
    private function gatewayConfiguration(array $required): array
    {
        $gateway = config('services.bank_alfalah', []);
        $missing = [];

        foreach ($required as $key) {
            if (! array_key_exists($key, $gateway)
                || trim((string) $gateway[$key]) === '') {
                $missing[] = $key;
            }
        }

        if ($missing !== []) {
            throw new RuntimeException(
                'Bank Alfalah configuration is incomplete: '
                .implode(', ', $missing)
            );
        }

        return array_map(
            static fn ($value): string => (string) $value,
            $gateway
        );
    }

    private function decodeBankResponse(string $body)
    {
        $decoded = json_decode($body, true);

        // Sandbox responses are sometimes a JSON string containing JSON.
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        return $decoded;
    }

    private function callbackReference(Request $request): ?string
    {
        foreach (['O', 'o', 'TransactionReferenceNumber'] as $key) {
            $value = $request->query($key);
            if (is_scalar($value) && trim((string) $value) !== '') {
                return trim((string) $value);
            }
        }

        $callbackPath = (string) ($request->route('callbackPath') ?? '');
        preg_match_all(
            '/(?:^|\/)([A-Za-z]+)=([^\/]*)/',
            $callbackPath,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            if (strtoupper($match[1]) === 'O') {
                $value = trim(rawurldecode($match[2]));

                return $value !== '' ? $value : null;
            }
        }

        return null;
    }

    private function unwrapStatusResponse($status)
    {
        if (! is_array($status)) {
            return null;
        }

        if (array_is_list($status)) {
            return isset($status[0]) && is_array($status[0])
                ? $status[0]
                : null;
        }

        foreach (['data', 'Data', 'response', 'Response'] as $wrapper) {
            if (isset($status[$wrapper]) && is_array($status[$wrapper])) {
                return $status[$wrapper];
            }
        }

        return $status;
    }

    /**
     * Validate every value that binds the gateway payment to the local order.
     * No callback URL value is trusted for this decision.
     *
     * @param  array<string, mixed>  $status
     * @param  array<string, string>  $gateway
     */
    private function isVerifiedPaidResponse(
        array $status,
        array $gateway,
        Order $order,
        string $reference
    ): bool {
        $bankAmount = $this->canonicalAmount(
            (string) ($status['TransactionAmount'] ?? '')
        );
        $orderAmount = $this->canonicalAmount(
            (string) $order->total_amount
        );

        return trim((string) ($status['ResponseCode'] ?? '')) === '00'
            && strcasecmp(
                trim((string) ($status['TransactionStatus'] ?? '')),
                'Paid'
            ) === 0
            && (string) ($status['MerchantId'] ?? '')
                === $gateway['merchant_id']
            && (string) ($status['StoreId'] ?? '')
                === $gateway['store_id']
            && (string) ($status['TransactionReferenceNumber'] ?? '')
                === $reference
            && $bankAmount !== null
            && $orderAmount !== null
            && hash_equals($orderAmount, $bankAmount);
    }

    /**
     * Canonicalise a decimal amount without ever converting it to float.
     */
    private function canonicalAmount(string $amount): ?string
    {
        $amount = trim($amount);

        if (! preg_match('/^\+?(\d+)(?:\.(\d+))?$/', $amount, $matches)) {
            return null;
        }

        $whole = ltrim($matches[1], '0');
        $whole = $whole === '' ? '0' : $whole;
        $fraction = $matches[2] ?? '';

        if (strlen($fraction) > 2
            && trim(substr($fraction, 2), '0') !== '') {
            return null;
        }

        $fraction = str_pad(substr($fraction, 0, 2), 2, '0');

        return $whole.'.'.$fraction;
    }
}
