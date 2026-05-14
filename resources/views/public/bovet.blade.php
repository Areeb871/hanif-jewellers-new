@extends('public.layouts.header')

@section('content')
    {{-- <section class="bovetSection p-5">

    </section> --}}
    @php
        $bgImage = $subcategory->banner_url ? asset($subcategory->banner_url) : asset('assets/f_assets/image/Watch_Creative_Banner.jpg'); // Fallback if null
        $videoExtensions = ['mp4', 'webm', 'ogg'];
        $videoUrl = $subcategory->banner_url ?? null;
        $isVideo = false;
        if ($videoUrl) {
            $ext = strtolower(pathinfo($videoUrl, PATHINFO_EXTENSION));
            $isVideo = in_array($ext, $videoExtensions);
        }
    @endphp

    <section class="bovetSection p-5 position-relative" style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center;">
        @if($isVideo)
            <div id="bovet-video-wrapper" class="position-absolute top-0 start-0 w-100" style="z-index:2;">
                <video id="bovet-video" class="w-100 object-fit-cover"
                    autoplay muted loop playsinline preload="auto" poster="{{ $bgImage }}" width="1920" height="1080">
                    <source src="{{ asset($videoUrl) }}" type="video/mp4">
                    <img src="{{ $bgImage }}" alt="Bovet background" style="width:100%;height:auto;"/>
                    Your browser does not support the video tag.
                </video>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var video = document.getElementById('bovet-video');
                    var source = video ? video.querySelector('source') : null;
                    if (video && source) {
                        if ('IntersectionObserver' in window) {
                            var observer = new IntersectionObserver(function(entries, observer) {
                                entries.forEach(function(entry) {
                                    if (entry.isIntersecting) {
                                        if (!source.src) {
                                            source.src = source.dataset.src;
                                            video.load();
                                        }
                                        observer.unobserve(video);
                                    }
                                });
                            }, { threshold: 0.25 });
                            observer.observe(video);
                        } else {
                            // Fallback: load video immediately
                            source.src = source.dataset.src;
                            video.load();
                        }
                    }
                });
            </script>
        @endif
    </section>

    <section>
        <div class="container py-5">
            <!-- <div class="breadcrumb">
                <a href="/" title="Home" class="a_link">
                    Home
                </a> &nbsp; ♦ &nbsp;
                <span>bovet</span>
            </div> -->
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="row g-3"> 
                        <div class="col-md-4">
                            <select class="form-select">
                                <option selected>Metal</option>
                                <option>Rose Gold</option>
                                <option>White Gold</option>
                                <option>Yellow Gold</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select class="form-select">
                                <option selected>Texture</option>
                                <option>Polish</option>
                                <option>Matte</option>
                                <option>Silk</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select class="form-select">
                                <option selected>Band Width</option>
                                <option>2mm</option>
                                <option>3mm</option>
                                <option>4mm</option>
                                <option>5mm</option>
                                <option>6mm</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="row g-3"> 
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <select class="form-select">
                                <option selected>SORT BY</option>
                                <option>Best Selling</option>
                                <option>Alphabetically, A-Z</option>
                                <option>Alphabetically, Z-A</option>
                                <option>Price, low to high</option>
                                <option>Price, high to low</option>
                                <option>Date, new to old</option>
                                <option>Date, old to new</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div> -->
        </div>
        <div class="py-5">
            <div class="pt-5">
                <div class="text-center">
                    <img src="{{ $subcategory->image ? asset($subcategory->image) : asset('default.jpg')}}" alt="Bovet Collection"
                        class="watch" width="130px">

                    <p class="p-3">{!! $subcategory->description !!}</p>
                </div>
                 <section class="onlineStore py-5">
                    <div class="row mx-auto my-auto g-2 gy-2">
                        @foreach ($products as $key => $product)
                            <div class="col-md-3">
                                @include('public.partials.product-card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
            <div class="text-center py-4">
                <div style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                    SHOWING {{ $products->count() + ($products->perPage() * ($products->currentPage() - 1)) }} OF {{ $products->total() }} PRODUCTS
                </div>
                <button id="loadMoreBtn"
                        style="background: #e3e4e5; border: none; color: #222; font-size: 0.8rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: inherit; font-weight: 400; box-shadow: none; transition: background 0.2s;"
                        data-page="2"
                        data-last-page="{{ $products->lastPage() }}"
                        {{ $products->currentPage() == $products->lastPage() ? 'style=display:none;' : '' }}>
                    LOAD MORE
                </button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const loadMoreBtn = document.getElementById('loadMoreBtn');
                    if (!loadMoreBtn) return;

                    loadMoreBtn.addEventListener('click', function() {
                        const btn = this;
                        const nextPage = btn.getAttribute('data-page');
                        const lastPage = btn.getAttribute('data-last-page');
                        btn.disabled = true;
                        btn.textContent = 'Loading...';

                        fetch(`{{ request()->url() }}?page=${nextPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Extract only the product cards from the returned HTML
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newCards = doc.querySelectorAll('.onlineStore .row > .col-md-3');
                            const row = document.querySelector('.onlineStore .row');
                            newCards.forEach(card => row.appendChild(card));

                            // Update the count display
                            const totalShown = row.querySelectorAll('.col-md-3').length;
                            document.querySelector('.text-center > div').textContent = `SHOWING ${totalShown} OF {{ $products->total() }} PRODUCTS`;

                            // Update button state
                            let newPage = parseInt(nextPage) + 1;
                            btn.setAttribute('data-page', newPage);
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                            if (parseInt(nextPage) >= parseInt(lastPage)) {
                                btn.style.display = 'none';
                            }
                        })
                        .catch(() => {
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                        });
                    });
                });
            </script>
        </div>
    </section>
@endsection
