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
                    @endphp
                    @if($collection)
                        <a class="collection-card" href="{{ $url }}">
                            <img src="{{ asset('assets/f_assets/image/jewelry-collection-logos/' . $name . '.jpg') }}" class="collection-card-img" alt="{{ $collectionName }}">
                            <div class="collection-card-title">{{ $collectionName }}</div>
                        </a>
                    @endif
                @endforeach
            </div>
        </nav>
        
        @include('public.partials.mobile-offcanvas-footer')
    </div>
</div> 