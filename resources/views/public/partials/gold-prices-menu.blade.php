@php
    $headerGoldRates = app('header.gold_rates');
    $goldMarket = $siteMarket ?? \App\Models\Products::currentMarket();
    $goldIsArabic = app()->getLocale() === 'ar';
    $goldCurrency = $goldMarket === 'uae' ? ($goldIsArabic ? 'د.إ' : 'AED') : 'PKR';
    $goldTitle = $goldIsArabic ? 'أسعار الذهب' : 'Gold Prices';
    $goldKaratLabel = $goldIsArabic ? 'عيار' : 'Karat';
    $goldPerGram = $goldIsArabic ? 'لكل غرام' : 'Per gram';
@endphp
@if($headerGoldRates->isNotEmpty())
<div class="hj-gold-menu">
    <button type="button"
            class="hj-gold-menu__btn"
            aria-expanded="false"
            aria-haspopup="true"
            aria-label="{{ $goldTitle }}">
        <svg class="hj-gold-menu__icon" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false">
            <path d="M3.5 3.2v17.3h17.3" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8 20.5V13.2" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
            <path d="M12.1 20.5V14.6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
            <path d="M16.2 20.5V8.4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
            <path d="M5.4 15.6 9.1 11.4 13 13.5 20.2 5.6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <div class="hj-gold-menu__panel" role="region" aria-label="{{ $goldTitle }}">
        <div class="hj-gold-menu__title">{{ $goldTitle }}</div>
        @foreach($headerGoldRates as $rate)
            @php
                $amount = (float) $rate->gold_rate_per_gram;
                $decimals = abs($amount - round($amount)) < 0.001 ? 0 : 2;
            @endphp
            <div class="hj-gold-menu__row">
                <span class="hj-gold-menu__karat">{{ $goldKaratLabel }} {{ $rate->karat }}</span>
                <span class="hj-gold-menu__price">{{ number_format($amount, $decimals) }} <span class="hj-gold-menu__cur">{{ $goldCurrency }}</span></span>
            </div>
        @endforeach
        <div class="hj-gold-menu__note">{{ $goldPerGram }}</div>
    </div>
</div>
@once
<style>
    .hj-gold-menu {
        position: relative;
        display: inline-flex;
        align-items: center;
        vertical-align: middle;
    }
    .hj-gold-menu__btn {
        appearance: none;
        -webkit-appearance: none;
        border: 0;
        background: transparent;
        padding: 0;
        margin: 0;
        line-height: 0;
        color: inherit;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .hj-gold-menu__btn:focus {
        outline: none;
    }
    .hj-gold-menu__btn:focus-visible {
        outline: 1px solid currentColor;
        outline-offset: 3px;
    }
    .luxury-header .hj-gold-menu__btn,
    header.mobile-header-main .hj-gold-menu__btn {
        color: #111;
    }
    .desktopLogos .hj-gold-menu__btn {
        color: #fff;
    }
    .hj-gold-menu__panel {
        display: none;
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        min-width: 270px;
        padding: 18px 22px 14px;
        background: #fff;
        color: #1a1a1a;
        border-radius: 2px;
        box-shadow: 0 12px 36px rgba(0, 0, 0, 0.14);
        z-index: 10080;
        text-align: start;
        text-transform: none;
        letter-spacing: 0;
        white-space: normal;
    }
    .hj-gold-menu__panel::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: -14px;
        height: 14px;
    }
    .hj-gold-menu:hover .hj-gold-menu__panel,
    .hj-gold-menu:focus-within .hj-gold-menu__panel,
    .hj-gold-menu.is-open .hj-gold-menu__panel {
        display: block;
    }
    .hj-gold-menu__title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.2;
        margin: 0 0 12px;
    }
    .hj-gold-menu__row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 28px;
        padding: 7px 0;
    }
    .hj-gold-menu__karat {
        color: #c9962a;
        font-weight: 700;
        font-size: 15px;
        white-space: nowrap;
    }
    .hj-gold-menu__price {
        color: #1a1a1a;
        font-weight: 600;
        font-size: 15px;
        white-space: nowrap;
    }
    .hj-gold-menu__cur {
        font-size: 13px;
        font-weight: 500;
        margin-left: 2px;
    }
    .hj-gold-menu__note {
        margin-top: 8px;
        font-size: 11px;
        letter-spacing: 0.04em;
        color: #8a8a8a;
        text-transform: none;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.hj-gold-menu__btn').forEach(function (btn) {
            btn.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                var menu = btn.closest('.hj-gold-menu');
                var open = menu.classList.toggle('is-open');
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                document.querySelectorAll('.hj-gold-menu.is-open').forEach(function (other) {
                    if (other === menu) return;
                    other.classList.remove('is-open');
                    var otherBtn = other.querySelector('.hj-gold-menu__btn');
                    if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                });
            });
        });

        document.addEventListener('click', function (event) {
            document.querySelectorAll('.hj-gold-menu.is-open').forEach(function (menu) {
                if (menu.contains(event.target)) return;
                menu.classList.remove('is-open');
                var btn = menu.querySelector('.hj-gold-menu__btn');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape') return;
            document.querySelectorAll('.hj-gold-menu.is-open').forEach(function (menu) {
                menu.classList.remove('is-open');
                var btn = menu.querySelector('.hj-gold-menu__btn');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            });
        });
    });
</script>
@endonce
@endif
