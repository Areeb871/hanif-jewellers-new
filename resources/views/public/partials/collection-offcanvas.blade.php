<!-- {{ $title }} Collection Offcanvas -->
<div class="offcanvas offcanvas-start mobile-offcanvas" tabindex="-1" id="{{ $id }}" style="--bs-offcanvas-width: 425px;">
    @include('public.partials.mobile-offcanvas-header', ['showClose' => true])
    <div class="offcanvas-body d-flex flex-column">
        <!-- Back Button -->
        <div class="mobile-back-button">
            <button type="button" class="btn-back" data-bs-toggle="offcanvas" data-bs-target="#collectionsOffcanvas">
                <i class="fa-solid fa-arrow-left"></i>
                <span>{{ $title }}</span>
            </button>
        </div>
        
        <nav class="mobile-nav mb-5">
            <div class="collection-cards">
                @foreach($collections as $collectionName)
                    @php
                        $collection = $jewelryCollections->filter(function($item) use ($collectionName) {
                            return strtolower($item->name) === strtolower($collectionName);
                        })->first();
                        $url = $customRoutes[$collectionName] ?? ($collection ? route('subcategory', ['subcategory' => $collection->slug]) : '#');
                        $name = $collection ? $collection->name : $collectionName;
                        $collectionLabels = [
                            'EHED' => __('site.col_ehed'),
                            'CLEOPATRA' => __('site.col_cleopatra'),
                            'GOHAR' => __('site.col_gohar'),
                            'HASHT' => __('site.dxb_hasht_title'),
                            'QAWS-AL-MATAR' => __('site.col_qaws'),
                            'MARCHISIO' => __('site.col_marchisio'),
                            'TIMLESS JEWELS' => __('site.col_timeless_menu'),
                            'GEHNAWA' => __('site.col_gehnawa'),
                            'NAVRATAN' => __('site.col_navratan'),
                            'TAJ MAHAL' => __('site.col_taj'),
                            'GULPOSH' => __('site.col_gulposh'),
                            'PURE LOCK' => __('site.col_pure_lock'),
                            'MOMENTU' => 'MOMENTU',
                            'NAGAR' => __('site.col_nagar'),
                            'HAPHAZARD' => __('site.col_haphazard'),
                            'HERITAGE' => __('site.col_heritage'),
                            'DIVINE TREASURES' => __('site.col_divine'),
                            'JEWELPHABETS' => __('site.col_jewelphabets'),
                            'MONA LISA' => __('site.col_mona'),
                            'SELENE' => __('site.col_selene'),
                            'MIRAS' => __('site.col_miras'),
                        ];
                        $collectionLabel = $collectionLabels[$collectionName] ?? $collectionName;
                        if (app()->getLocale() !== 'ar') {
                            $collectionLabel = $collectionName;
                        }
                    @endphp
                    @if($collection)
                        <a class="collection-card" href="{{ $url }}">
                            <img src="{{ asset('assets/f_assets/image/jewelry-collection-logos/' . $name . '.jpg') }}" class="collection-card-img" alt="{{ $collectionName }}" width="1080" height="511" loading="lazy" decoding="async">
                            <div class="collection-card-title">{{ $collectionLabel }}</div>
                        </a>
                    @endif
                @endforeach
            </div>
        </nav>
        
        @include('public.partials.mobile-offcanvas-footer')
    </div>
</div>
