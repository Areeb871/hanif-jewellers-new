<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Redirecting to Bank Alfalah</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            color: #1f1f1f;
            background: #f7f6f3;
            font-family: Arial, Helvetica, sans-serif;
        }

        .payment-card {
            width: min(100%, 440px);
            padding: 44px 36px;
            text-align: center;
            background: #fff;
            border: 1px solid #e8e5df;
            border-radius: 18px;
            box-shadow: 0 18px 50px rgba(30, 25, 18, .07);
        }

        .loader {
            width: 48px;
            height: 48px;
            margin: 0 auto 26px;
            border: 3px solid #eee9df;
            border-top-color: #a77b32;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        h1 { margin: 0 0 12px; font-size: 24px; line-height: 1.3; }
        .message { margin: 0; color: #6d6a65; font-size: 15px; line-height: 1.6; }

        .order-reference {
            display: inline-flex;
            gap: 8px;
            margin-top: 24px;
            padding: 10px 14px;
            color: #5d5850;
            background: #f8f6f1;
            border-radius: 8px;
            font-size: 13px;
        }

        .order-reference strong { color: #25221e; }

        .secure-note {
            margin-top: 28px;
            color: #88837b;
            font-size: 12px;
        }

        .continue-button {
            width: 100%;
            margin-top: 24px;
            min-height: 46px;
            padding: 13px 18px;
            color: #fff;
            background: #17120f;
            border: 1px solid #17120f;
            border-radius: 0;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .14em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color .24s ease, color .24s ease;
        }

        .continue-button:hover,
        .continue-button:focus-visible {
            color: #17120f;
            background: #fff;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 480px) {
            .payment-card { padding: 36px 22px; }
            h1 { font-size: 21px; }
        }
    </style>
</head>
<body>
    <main class="payment-card" aria-live="polite">
        <div class="loader" aria-hidden="true"></div>
        <h1>Redirecting to Bank Alfalah</h1>
        <p class="message">Please wait while we connect you to the secure payment page.</p>

        <div class="order-reference">
            <span>Order reference</span>
            <strong>{{ $orderNumber }}</strong>
        </div>

        <p class="secure-note">Secure payment powered by Bank Alfalah</p>

        <form action="{{ $ssoUrl }}" method="post" id="bankAlfalahForm">
            @foreach($fields as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach

            <noscript>
                <p class="message">JavaScript is disabled. Please continue manually.</p>
                <button type="submit" class="continue-button">Continue to payment</button>
            </noscript>
        </form>
    </main>

    <script>
        document.getElementById('bankAlfalahForm').submit();
    </script>
</body>
</html>
