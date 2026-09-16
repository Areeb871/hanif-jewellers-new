@extends('public.layouts.header_new')

@section('content')
@php
    $whatsappNumber = '923070222666';
@endphp

<style>
    :root { --momentu-lime:#c8d82e; --momentu-acid:#e4ef55; --momentu-court:#537134; --momentu-deep:#173b26; --momentu-cream:#f8f5e9; --momentu-ink:#14231a; }
    .momentu-page { overflow:hidden; background:var(--momentu-cream); color:var(--momentu-ink); }
    .momentu-hero { width:100%; margin:0; padding:0; overflow:hidden; background:#000; line-height:0; }
    .momentu-hero__video { display:block; width:100%; height:auto; }
    .momentu-intro { position:relative; padding:clamp(96px,10vw,168px) 24px; isolation:isolate; text-align:center; background:#fff; }
    .momentu-kicker { display:block; margin-bottom:clamp(16px,1.5vw,24px); font-size:11px; font-weight:600; letter-spacing:.36em; text-transform:uppercase; }
    .momentu-title { margin:0; font-family:Georgia,'Times New Roman',serif; font-size:clamp(54px,8vw,132px); font-weight:400; letter-spacing:-.055em; line-height:.82; }
    .momentu-subtitle { margin:clamp(22px,2vw,32px) 0 0; font-family:Georgia,'Times New Roman',serif; font-size:clamp(17px,2vw,28px); font-weight:400; letter-spacing:.08em; }
    .momentu-copy { max-width:680px; margin:clamp(18px,1.8vw,28px) auto 0; font-size:clamp(13px,1.1vw,16px); line-height:1.9; }
    .momentu-story-banner { width:100%; overflow:hidden; background:#0b0b0b; line-height:0; }
    .momentu-story-banner__image { display:block; width:100%; height:auto; }
    .momentu-story-banner__image--mobile { display:none; }
    @media (max-width:767px) {
        .momentu-story-banner__image--desktop { display:none; }
        .momentu-story-banner__image--mobile { display:block; }
    }
    .momentu-categories { padding:clamp(96px,9vw,144px) max(20px,5vw) clamp(104px,10vw,168px); background:#fff; text-align:center; }
    .momentu-section-kicker { margin:0 0 14px; color:#657055; font-size:10px; font-weight:600; letter-spacing:.28em; text-transform:uppercase; }
    .momentu-section-title { margin:0; font-family:Georgia,'Times New Roman',serif; font-size:clamp(34px,4.4vw,68px); font-weight:400; line-height:1; }
    .momentu-category-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:clamp(18px,1.8vw,28px); max-width:1400px; margin:clamp(52px,5vw,76px) auto 0; }
    .momentu-category { position:relative; display:flex; min-height:clamp(320px,30vw,440px); padding:30px; overflow:hidden; align-items:flex-end; border:0; color:#fff; text-align:left; text-decoration:none; cursor:pointer; transition:transform .35s ease; }
    .momentu-category:hover { transform:translateY(-5px); }
    .momentu-category:nth-child(1) { background:linear-gradient(145deg,#213f29,#789447); }
    .momentu-category:nth-child(2) { background:linear-gradient(145deg,#c7d629,#6d8b32); }
    .momentu-category:nth-child(3) { background:linear-gradient(145deg,#395831,#b0c738); }
    .momentu-category::before { content:''; position:absolute; z-index:1; inset:0; background:linear-gradient(180deg,rgba(12,28,18,.08) 25%,rgba(12,28,18,.82) 100%); }
    .momentu-category::after { content:''; position:absolute; z-index:2; inset:20px; border:1px solid rgba(255,255,255,.5); pointer-events:none; }
    .momentu-category__image { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; transition:transform .65s cubic-bezier(.2,.7,.2,1); }
    .momentu-category:hover .momentu-category__image { transform:scale(1.04); }
    .momentu-category__number { position:absolute; z-index:3; top:33px; left:33px; right:33px; font-size:10px; letter-spacing:.18em; text-transform:uppercase; }
    .momentu-category__content { position:relative; z-index:3; }
    .momentu-category__label { display:block; font-family:Georgia,'Times New Roman',serif; font-size:clamp(25px,2.5vw,39px); font-weight:400; line-height:1.08; }
    .momentu-category__price { display:block; margin-top:16px; font-size:10px; letter-spacing:.14em; }
    .momentu-shop { padding:clamp(62px,7vw,110px) max(18px,4vw) clamp(72px,9vw,135px); background:#fff; }
    .momentu-shop__head { display:flex; max-width:1500px; margin:0 auto 36px; align-items:flex-end; justify-content:space-between; gap:30px; }
    .momentu-filter { display:flex; flex-wrap:wrap; gap:8px; justify-content:flex-end; }
    .momentu-filter__button { padding:10px 18px; border:1px solid #b9c0af; border-radius:30px; background:transparent; color:var(--momentu-ink); font-size:10px; font-weight:600; letter-spacing:.15em; text-transform:uppercase; transition:.25s ease; }
    .momentu-filter__button:hover,.momentu-filter__button.is-active { border-color:var(--momentu-deep); background:var(--momentu-deep); color:#fff; }
    .momentu-products { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:clamp(10px,1.2vw,22px); max-width:1500px; margin:0 auto; }
    .momentu-product { min-width:0; }
    .momentu-product__detail { display:block; color:inherit; text-decoration:none; }
    .momentu-product.is-hidden { display:none; }
    .momentu-product__media { position:relative; aspect-ratio:1/1.12; overflow:hidden; background:#f2f0e7; }
    .momentu-product__media::after { content:''; position:absolute; inset:auto 0 0; height:5px; background:linear-gradient(90deg,var(--momentu-lime),var(--momentu-court)); transform:scaleX(0); transform-origin:left; transition:transform .35s ease; }
    .momentu-product:hover .momentu-product__media::after { transform:scaleX(1); }
    .momentu-product__image { width:100%; height:100%; display:block; object-fit:cover; transition:transform .65s cubic-bezier(.2,.7,.2,1); }
    .momentu-product:hover .momentu-product__image { transform:scale(1.035); }
    .momentu-product__badge { position:absolute; top:14px; left:14px; z-index:1; padding:7px 10px; border-radius:20px; background:var(--momentu-acid); color:var(--momentu-deep); font-size:9px; font-weight:700; letter-spacing:.14em; }
    .momentu-product__body { padding:20px 4px 30px; text-align:center; }
    .momentu-product__category { margin:0 0 8px; color:#748066; font-size:9px; letter-spacing:.22em; text-transform:uppercase; }
    .momentu-product__name { margin:0; font-family:Georgia,'Times New Roman',serif; font-size:clamp(17px,1.3vw,22px); font-weight:400; line-height:1.3; }
    .momentu-product__price { margin:9px 0 16px; font-size:11px; letter-spacing:.12em; }
    .momentu-product__link { display:inline-block; padding-bottom:4px; border-bottom:1px solid currentColor; color:var(--momentu-ink); font-size:9px; font-weight:600; letter-spacing:.18em; text-decoration:none; text-transform:uppercase; }
    .momentu-product__link:hover { color:var(--momentu-court); }
    .momentu-values { position:relative; padding:clamp(70px,9vw,145px) 24px; overflow:hidden; isolation:isolate; background:radial-gradient(circle at 12% 20%,rgba(228,239,85,.72) 0 8%,transparent 25%),radial-gradient(circle at 88% 78%,rgba(83,113,52,.3) 0 10%,transparent 28%),linear-gradient(135deg,#f8f5e9 0%,#eef2c7 48%,#f8f5e9 100%); text-align:center; }
    .momentu-values::before { content:''; position:absolute; inset:22px; border:1px solid rgba(23,59,38,.34); pointer-events:none; }
    .momentu-values__title { max-width:840px; margin:0 auto; font-family:Georgia,'Times New Roman',serif; font-size:clamp(36px,5vw,76px); font-weight:400; line-height:1.05; }
    .momentu-values__grid { display:grid; grid-template-columns:repeat(3,1fr); gap:25px; max-width:850px; margin:55px auto 0; }
    .momentu-value strong { display:block; margin-bottom:8px; font-family:Georgia,'Times New Roman',serif; font-size:25px; font-weight:400; }
    .momentu-value span { font-size:10px; letter-spacing:.18em; text-transform:uppercase; }
    .momentu-cta { padding:clamp(75px,9vw,140px) 24px; background:var(--momentu-deep); color:#fff; text-align:center; }
    .momentu-cta__title { margin:0; font-family:Georgia,'Times New Roman',serif; font-size:clamp(38px,5vw,72px); font-weight:400; }
    .momentu-cta__copy { max-width:560px; margin:20px auto 30px; color:rgba(255,255,255,.78); font-size:13px; line-height:1.8; }
    .momentu-cta__button { display:inline-block; padding:15px 27px; border:1px solid #fff; background:#fff; color:var(--momentu-deep); font-size:10px; font-weight:700; letter-spacing:.18em; text-decoration:none; text-transform:uppercase; transition:.25s ease; }
    .momentu-cta__button:hover { background:transparent; color:#fff; }
    @media(max-width:991px) { .momentu-products{grid-template-columns:repeat(3,minmax(0,1fr))}.momentu-category{min-height:280px} }
    @media(max-width:767px) { .momentu-intro{padding:76px 20px 82px}.momentu-title{font-size:clamp(55px,16vw,90px)}.momentu-subtitle{margin-top:18px}.momentu-copy{margin-top:16px;line-height:1.75}.momentu-categories{padding:72px 16px 88px}.momentu-section-title{line-height:1.08}.momentu-category-grid{grid-template-columns:1fr;gap:18px;margin-top:40px}.momentu-category{aspect-ratio:1/1;min-height:0;padding:24px}.momentu-category::after{inset:14px}.momentu-category__number{top:26px;left:26px;right:26px}.momentu-category__price{margin-top:12px}.momentu-shop__head{display:block;text-align:center}.momentu-filter{margin-top:28px;justify-content:center}.momentu-products{grid-template-columns:repeat(2,minmax(0,1fr))}.momentu-product__body{padding-top:14px}.momentu-values__grid{grid-template-columns:1fr;gap:30px;margin-top:42px} }
    @media(max-width:420px) { .momentu-shop{padding-inline:10px}.momentu-products{gap:8px}.momentu-product__name{font-size:15px}.momentu-product__price{font-size:9px}.momentu-product__link{font-size:8px}.momentu-filter__button{padding:9px 12px;font-size:8px} }
    @media(prefers-reduced-motion:reduce) { .momentu-product__image,.momentu-category{transition:none} }
</style>

<main class="momentu-page">
    <section class="momentu-hero d-none d-md-block" aria-label="Momento collection desktop film">
        <video class="momentu-hero__video" autoplay loop muted playsinline preload="metadata"><source src="{{ asset('assets/f_assets/image/momentu/Wesbite Banner 16.9 (Compressed).mp4') }}" type="video/mp4">Your browser does not support the video tag.</video>
    </section>
    <section class="momentu-hero d-md-none" aria-label="Momento collection mobile film">
        <video class="momentu-hero__video" autoplay loop muted playsinline preload="metadata"><source src="{{ asset('assets/f_assets/image/momentu/Wesbite Banner 9.16 (Compressed).mp4') }}" type="video/mp4">Your browser does not support the video tag.</video>
    </section>

    <section class="momentu-intro">
        <h1 class="momentu-title">MOMENTO</h1>
        <p class="momentu-subtitle">Evermore Diamonds.</p>
        <p class="momentu-copy">Every diamond, expertly cut and perfectly set, captures the effortless elegance of the tennis bracelet. Momento</p>
    </section>

    <section class="momentu-story-banner" aria-label="Momento diamond collection">
        <img class="momentu-story-banner__image momentu-story-banner__image--desktop" src="{{ asset('assets/f_assets/momento/momento-web.webp') }}" alt="Momento diamond jewellery" loading="lazy">
        <img class="momentu-story-banner__image momentu-story-banner__image--mobile" src="{{ asset('assets/f_assets/momento/Momento.webp') }}" alt="Momento diamond jewellery" loading="lazy">
    </section>

    <section class="momentu-categories" aria-labelledby="momentu-categories-title">
        <h2 class="momentu-section-title" id="momentu-categories-title">Choose your perfect match</h2>
        <div class="momentu-category-grid">
            @forelse($products->take(3) as $featuredProduct)
                @php
                    $featuredName = $featuredProduct->storefrontName();
                    $featuredReference = $featuredProduct->sku ?: $featuredProduct->barcode;
                    $featuredImage = $featuredProduct->images->isNotEmpty()
                        ? $featuredProduct->images->first()->image
                        : ($featuredProduct->image ?: 'default.jpg');
                    $featuredPrice = round($featuredProduct->storefront_price, -3);
                @endphp
                <a class="momentu-category" href="{{ route('product.details', $featuredProduct->slug) }}?store=1" aria-label="View {{ $featuredName }} details">
                    <img class="momentu-category__image" src="{{ asset(ltrim($featuredImage, '/')) }}" alt="{{ $featuredName }}" loading="lazy">
                    <span class="momentu-category__number">
                        {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }} / MOMENTO
                        @if($featuredReference) &middot; {{ $featuredReference }} @endif
                    </span>
                    <span class="momentu-category__content">
                        <span class="momentu-category__label">{{ $featuredName }}</span>
                        @if($featuredPrice > 0 && $featuredProduct->show_price)
                            <span class="momentu-category__price">PKR {{ number_format($featuredPrice, 0, '.', ',') }}</span>
                        @endif
                    </span>
                </a>
            @empty
                <p class="momentu-products__empty">No Momento products are available right now.</p>
            @endforelse
        </div>
    </section>

    <!-- <section class="momentu-shop" id="momentu-products" aria-labelledby="momentu-products-title">
        <div class="momentu-shop__head">
            <div><p class="momentu-section-kicker">The collection</p><h2 class="momentu-section-title" id="momentu-products-title">Made to move</h2></div>
            <div class="momentu-filter" role="group" aria-label="Filter Momento products">
                <button class="momentu-filter__button is-active" type="button" data-momentu-filter="all" aria-pressed="true">All</button>
                <button class="momentu-filter__button" type="button" data-momentu-filter="earrings" aria-pressed="false">Earrings</button>
                <button class="momentu-filter__button" type="button" data-momentu-filter="rings" aria-pressed="false">Rings</button>
                <button class="momentu-filter__button" type="button" data-momentu-filter="bracelets" aria-pressed="false">Bracelets</button>
            </div>
        </div>
        <div class="momentu-products" aria-live="polite">
            @forelse($products as $product)
                @php
                    $productName = $product->storefrontName();
                    $reference = $product->sku ?: $product->barcode;
                    $typeSource = strtolower(implode(' ', [
                        $productName,
                        $product->tags->pluck('name')->implode(' '),
                        $product->tags->pluck('slug')->implode(' '),
                    ]));
                    $productType = str_contains($typeSource, 'earring')
                        ? 'earrings'
                        : (str_contains($typeSource, 'bracelet')
                            ? 'bracelets'
                            : (str_contains($typeSource, 'ring') ? 'rings' : 'jewellery'));
                    $displayImage = $product->images->isNotEmpty()
                        ? $product->images->first()->image
                        : ($product->image ?: 'default.jpg');
                    $displayPrice = round($product->storefront_price, -3);
                    $detailUrl = route('product.details', $product->slug).'?store=1';
                @endphp
                <article class="momentu-product" data-momentu-product="{{ $productType }}">
                    <a class="momentu-product__detail" href="{{ $detailUrl }}" aria-label="View {{ $productName }} details">
                        <div class="momentu-product__media">
                            @if($product->is_latest)
                                <span class="momentu-product__badge">NEW</span>
                            @endif
                            <img class="momentu-product__image" src="{{ asset(ltrim($displayImage, '/')) }}" alt="{{ $productName }}" loading="lazy">
                        </div>
                        <div class="momentu-product__body">
                            <p class="momentu-product__category">
                                {{ $productType }} @if($reference) &middot; {{ $reference }} @endif
                            </p>
                            <h3 class="momentu-product__name">{{ $productName }}</h3>
                            @if($displayPrice > 0 && $product->show_price)
                                <p class="momentu-product__price">PKR {{ number_format($displayPrice, 0, '.', ',') }}</p>
                            @endif
                        </div>
                    </a>
                </article>
            @empty
                <p class="momentu-products__empty">No Momentu products are available right now.</p>
            @endforelse
        </div>
    </section>

    <section class="momentu-cta">
        <p class="momentu-section-kicker" style="color:var(--momentu-acid)">Your moment awaits</p><h2 class="momentu-cta__title">Meet your perfect match.</h2><p class="momentu-cta__copy">Discover the Momento collection in person with a private appointment at Hanif Jewellery &amp; Watches.</p><a class="momentu-cta__button" href="https://api.whatsapp.com/send?phone={{ $whatsappNumber }}&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment to view the Momento collection.') }}" target="_blank" rel="noopener noreferrer">Book an appointment</a>
    </section> -->
</main>

<script>
document.addEventListener('DOMContentLoaded',function(){const filters=document.querySelectorAll('[data-momentu-filter]'),categories=document.querySelectorAll('[data-momentu-category]'),products=document.querySelectorAll('[data-momentu-product]'),section=document.getElementById('momentu-products');function show(category){filters.forEach(button=>{const active=button.dataset.momentuFilter===category;button.classList.toggle('is-active',active);button.setAttribute('aria-pressed',active?'true':'false')});products.forEach(product=>product.classList.toggle('is-hidden',category!=='all'&&product.dataset.momentuProduct!==category))}filters.forEach(button=>button.addEventListener('click',()=>show(button.dataset.momentuFilter)));categories.forEach(button=>button.addEventListener('click',()=>{show(button.dataset.momentuCategory);section.scrollIntoView({behavior:'smooth',block:'start'})}))});
</script>
@endsection
