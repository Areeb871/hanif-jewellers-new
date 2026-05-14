@php
    $hasPkr = isset($pkr);
    $hasAed = isset($aed);
    $pkrValue = $hasPkr ? $pkr : null;
    $aedValue = $hasAed ? $aed : null;
    $pkrDecimals = $pkrDecimals ?? 0;
    $aedDecimals = $aedDecimals ?? 2;
    $classes = $class ?? $classes ?? '';
@endphp
<span class="currency-amount {{ $classes }}">
    @if($hasPkr)
        <span class="price-value price-value-pkr">PKR {{ number_format($pkrValue, $pkrDecimals) }}</span>
    @endif
    @if($hasAed)
        <span class="price-value price-value-aed">AED {{ number_format($aedValue, $aedDecimals) }}</span>
    @endif
    @if(!$hasPkr && !$hasAed)
        <span class="text-muted">Price on request</span>
    @endif
</span>

