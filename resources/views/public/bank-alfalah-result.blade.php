<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title }}</title>
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

        .result-card {
            width: min(100%, 460px);
            padding: 44px 36px;
            text-align: center;
            background: #fff;
            border: 1px solid #e8e5df;
            border-radius: 18px;
            box-shadow: 0 18px 50px rgba(30, 25, 18, .07);
        }

        .brand-logo {
            display: block;
            width: auto;
            max-width: 220px;
            max-height: 78px;
            margin: 0 auto 30px;
            object-fit: contain;
        }

        .status-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .status-icon {
            display: grid;
            place-items: center;
            flex: 0 0 38px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
        }

        .status-icon.success { color: #287a55; background: #eaf6ef; }
        .status-icon.error { color: #b0473f; background: #fbeeed; }
        .status-icon svg { width: 20px; height: 20px; }

        h1 { margin: 0; font-size: 24px; line-height: 1.3; }
        .message { margin: 0; color: #6d6a65; font-size: 15px; line-height: 1.65; }

        .order-reference {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 26px;
            padding: 14px 16px;
            color: #716c64;
            background: #f8f6f1;
            border-radius: 9px;
            font-size: 13px;
        }

        .order-reference strong { color: #25221e; overflow-wrap: anywhere; }

        .copy-button {
            margin-top: 12px;
            padding: 8px 12px;
            color: #5f5951;
            background: transparent;
            border: 0;
            font: inherit;
            font-size: 12px;
            text-decoration: underline;
            text-underline-offset: 3px;
            cursor: pointer;
        }

        .copy-button:hover,
        .copy-button:focus-visible { color: #17120f; }

        .home-link {
            display: block;
            margin-top: 28px;
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
            text-decoration: none;
            transition: background-color .24s ease, color .24s ease;
        }

        .home-link:hover,
        .home-link:focus-visible {
            color: #17120f;
            background: #fff;
        }

        @media (max-width: 480px) {
            .result-card { padding: 36px 22px; }
            h1 { font-size: 21px; }
        }
    </style>
</head>
<body>
    <main class="result-card">
        <img
            src="{{ asset('assets/media/logos/logo.png') }}"
            alt="Hanif Jewellers"
            class="brand-logo"
        >

        <div class="status-heading">
            <h1>{{ $title }}</h1>
            <div class="status-icon {{ $success ? 'success' : 'error' }}" aria-hidden="true">
                @if($success)
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                @else
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round">
                        <path d="M12 8v5" />
                        <path d="M12 17h.01" />
                        <circle cx="12" cy="12" r="9" />
                    </svg>
                @endif
            </div>
        </div>
        <p class="message">{{ $message }}</p>

        @if($orderNumber)
            <div class="order-reference">
                <span>Order reference</span>
                <strong id="orderNumber">{{ $orderNumber }}</strong>
            </div>
            <button type="button" class="copy-button" id="copyOrderNumber">
                Copy order number
            </button>
        @endif

        <a href="{{ route('index') }}" class="home-link">Return to home</a>
    </main>

    @if($orderNumber)
        <script>
            document.getElementById('copyOrderNumber').addEventListener('click', async function () {
                const orderNumber = document.getElementById('orderNumber').textContent.trim();

                try {
                    await navigator.clipboard.writeText(orderNumber);
                } catch (error) {
                    const input = document.createElement('textarea');
                    input.value = orderNumber;
                    input.style.position = 'fixed';
                    input.style.opacity = '0';
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    input.remove();
                }

                this.textContent = 'Copied';
                setTimeout(() => {
                    this.textContent = 'Copy order number';
                }, 1600);
            });
        </script>
    @endif
</body>
</html>
