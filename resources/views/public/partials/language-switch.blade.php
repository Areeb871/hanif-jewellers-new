@php
    $currentLocale = app()->getLocale();
    $currentMarket = session('market', $currentLocale === 'ar' ? 'uae' : 'pk');
    $isPk = $currentLocale === 'en' && $currentMarket !== 'uae';
    $isUaeEn = $currentLocale === 'en' && $currentMarket === 'uae';
    $isAr = $currentLocale === 'ar';
@endphp
<form action="{{ route('locale.set') }}" method="POST" class="hj-lang-switch" aria-label="{{ $isAr ? 'الدولة واللغة' : 'Country / Language' }}">
    @csrf
    <button type="submit" name="choice" value="pk" class="{{ $isPk ? 'is-active' : '' }}" lang="en" title="Pakistan · PK">PK</button>
    <span class="hj-lang-divider" aria-hidden="true">|</span>
    <button type="submit" name="choice" value="uae" class="{{ $isUaeEn ? 'is-active' : '' }}" lang="en" title="UAE · AED">UAE</button>
    <span class="hj-lang-divider" aria-hidden="true">|</span>
    <button type="submit" name="choice" value="ar" class="{{ $isAr ? 'is-active' : '' }}" lang="ar" title="العربية · درهم">عربي</button>
</form>
