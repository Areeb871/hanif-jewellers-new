@extends('public.layouts.header_latest')

@section('content')
    <!-- <section class="solitaireSection d-flex align-items-center" style="min-height:340px;">
        <div class="">
            <div class="row align-items-center">
                <div class="col-md-5 text-start px-3 px-md-5">
                    <h1 class="fw-bold mb-3">Solitaire Engagement Rings</h1>
                    <p class="mb-0 text-muted" style="font-size:1.1rem;">
                        Classic, sparkling and endlessly symbolic solitaire rings bring sleek style. Explore gemstone and diamond
                        solitaire engagement rings in gold and platinum.
                    </p>
                </div>
                <div class="col-md-7 text-center">
                    <img src="{{ asset('assets/f_assets/image/Soliteir_Banner.png') }}" alt="Solitaire Engagement Rings" class="img-fluid rounded shadow" style="bject-fit:cover;">
                </div>
            </div>
        </div>
    </section> -->
    <section class="bovetSection p-5 position-relative" style="background-image: url('{{ 'assets/f_assets/image/Soliteir_Banner.png' }}'); background-size: cover; background-position: center;">
       
    </section>

    <section class="p-5">
        <!-- <div class="breadcrumb">
            <a href="/" title="Home" class="">
                Home
            </a> &nbsp; / &nbsp;
            <span class="text-black">Solitaire Engagement Rings</span>
        </div> -->
        <!-- <hr> -->
        <div class="mb-4">
            <div class="row align-items-center py-3 border-bottom">
                <div class="col-12 col-md-auto border-end border-light mb-3 mb-md-3">
                    <svg width="20" height="14" viewBox="0 0 20 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 2C0.447715 2 0 2.44772 0 3C0 3.55228 0.447715 4 1 4V2ZM1 4H5V2H1V4Z" fill="black">
                        </path>
                        <path d="M1 10C0.447715 10 0 10.4477 0 11C0 11.5523 0.447715 12 1 12V10ZM1 12H11V10H1V12Z"
                            fill="black"></path>
                        <path
                            d="M10 2H9V4H10V2ZM19 4C19.5523 4 20 3.55228 20 3C20 2.44772 19.5523 2 19 2V4ZM10 4H19V2H10V4Z"
                            fill="black"></path>
                        <path
                            d="M16 10H15V12H16V10ZM19 12C19.5523 12 20 11.5523 20 11C20 10.4477 19.5523 10 19 10V12ZM16 12H19V10H16V12Z"
                            fill="black"></path>
                        <path
                            d="M7 5C8.10457 5 9 4.10457 9 3C9 1.89543 8.10457 1 7 1C5.89543 1 5 1.89543 5 3C5 4.10457 5.89543 5 7 5Z"
                            stroke="black" stroke-width="2"></path>
                        <path
                            d="M13 13C14.1046 13 15 12.1046 15 11C15 9.89543 14.1046 9 13 9C11.8954 9 11 9.89543 11 11C11 12.1046 11.8954 13 13 13Z"
                            stroke="black" stroke-width="2"></path>
                    </svg>
                    <span>Filters</span>
                </div>
                <div class="col-12 col-md mb-2 mb-md-0">
                    <div class="collapse show" id="filtersCollapse">
                        <div class="d-flex flex-wrap">
                            <!-- Shape Filter -->
                            <div class="dropdown me-2 mb-2">
                                <button class="btn btn-outline-dark dropdown-toggle border rounded-pill w-100" type="button"
                                    id="shapeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Shapes
                                </button>
                                <div class="dropdown-menu px-5 py-3 border-0 shadow" aria-labelledby="shapeDropdown"
                                    style="min-width: 99vw;">
                                    <div class="text-end mt-2">
                                       x <button type="button"
                                            class="btn btn-link text-dark text-uppercase btn-sm p-0 clear-shape" style="font-size:12px;">Clear
                                            all</button>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @php
                                            // Define the image path for diamond shapes
                                            $diamondImagePath = 'assets/f_assets/image/diamonds-icons/';
                                            $diamondImageExtension = '.png';
                                            // Define the image names for each shape
                                            $diamondShapes = [
                                                'Round' => 'Round Stone (Black)',
                                                'Cushion' => 'Cushion Stone (Black)',
                                                'Princess' => 'Princess Stone (Black)',
                                                'Oval' => 'Oval Stone (Black)',
                                                'Emerald' => 'Emerald Stone (Black)',
                                                'Radiant' => 'Radiant Stone (Black)',
                                                'Asscher' => 'Asscher Stone (Black)-01-01',
                                                'Pear' => 'Pear Stone (Black)',
                                                'Marquise' => 'Marquise Stone (Black)',
                                                'Heart' => 'Heart Stone (Black)',
                                            ];
                                        @endphp
                                        @foreach (['Round', 'Cushion', 'Princess', 'Oval', 'Emerald', 'Radiant', 'Asscher', 'Pear', 'Marquise', 'Heart'] as $shape)
                                            <button type="button"
                                                class="btn btn-sm btn-outline-light rounded-2 m-1 shape-filter-btn"
                                                data-shape="{{ $shape }}">
                                                <img src="{{ asset($diamondImagePath . $diamondShapes[$shape] . $diamondImageExtension) }}"
                                                    width="60" height="60" alt="{{ $shape }}">
                                                <br> <span class="dropdown-inner-text">{{ $shape }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Material Filter -->
                            <div class="dropdown me-2 mb-2">
                                <button class="btn btn-outline-dark dropdown-toggle border rounded-pill w-100" type="button"
                                    id="materialDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Material Type
                                </button>
                                <div class="dropdown-menu px-5 py-3 border-0 shadow" aria-labelledby="materialDropdown"
                                    style="min-width: 99vw;">
                                    <div class="text-end mt-2">
                                        x <button type="button"
                                            class="btn btn-link text-dark text-uppercase btn-sm p-0 clear-material" style="font-size:12px;">Clear
                                            all</button>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @php
                                            $materials = [
                                                ['14K Silver', '14k_Silver.png'],
                                                ['14K Rose', '14k_Rose.png'],
                                                ['14K Gold', '14k_Gold.png'],
                                                ['18K Silver', '18k_Silver.png'],
                                                ['18K Rose', '18k_Rose.png'],
                                                ['18K Gold', '18k_Gold.png'],
                                                ['Platinum', 'PT.png'],
                                            ];
                                        @endphp
                                        @foreach ($materials as $mat)
                                            <button type="button"
                                                class="btn btn-sm btn-outline-light rounded-2 m-1 material-filter-btn"
                                                data-material="{{ $mat[0] }}">
                                                <img src="https://cdn.shopify.com/s/files/1/0565/7916/2292/files/{{ $mat[1] }}?v=1736782344"
                                                    width="60" height="60" alt="{{ $mat[0] }}"><br>
                                                <span class="dropdown-inner-text">{{ $mat[0] }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Price Filter -->
                            <!-- <div class="dropdown me-2 mb-2 position-relative" style="z-index:2;">
                                <button class="btn btn-outline-dark dropdown-toggle border rounded-pill w-100" type="button"
                                    id="priceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Price Ranges
                                </button>
                                <div class="dropdown-menu px-4 py-4 border-0 shadow w-100" aria-labelledby="priceDropdown" style="min-width: 99vw; max-width: 100vw;">
                                    <div class="rounded-4 p-4 position-relative" style="min-height:140px;">
                                        <div class="d-flex justify-content-end align-items-center mb-2">
                                            <span class="me-1" style="font-size:18px; cursor:pointer;">&#10005;</span>
                                            <button type="button" class="btn btn-link text-dark text-uppercase btn-sm p-0 clear-price" style="text-decoration:underline;">CLEAR ALL</button>
                                        </div>
                                        <div class="slider-container position-relative mt-4">
                                            <div class="price-tooltip" id="price-tooltip-css">
                                                PKR <span id="price-value-css">50,000</span>
                                            </div>
                                            <div class="d-flex align-items-center" style="gap:40px;">
                                                <div>
                                                    <input type="text" class="form-control rounded-pill px-4 py-2 text-muted fw-normal" id="min-price" value="PKR 0" readonly style="width:130px; background:#fff;">
                                                </div>
                                                <div class="flex-grow-1 position-relative" style="height:40px;">
                                                    <input type="range" min="0" max="200000" value="50000" step="1000" id="price-range-css"
                                                        class="w-100 price-range-css">
                                                </div>
                                                <div>
                                                    <input type="text" class="form-control rounded-pill px-4 py-2 text-muted fw-normal" id="max-price" value="PKR 200,000" readonly style="width:170px; background:#fff;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .price-range-css::-webkit-slider-thumb {
                                    -webkit-appearance: none;
                                    appearance: none;
                                    width:32px;height:32px;
                                    background:#fff;
                                    border:4px solid #666;
                                    border-radius:50%;
                                    box-shadow:0 2px 6px rgba(0,0,0,0.1);
                                    cursor:pointer;
                                    position:relative;
                                    z-index:3;
                                }
                                .price-range-css::-moz-range-thumb {
                                    width:32px;height:32px;
                                    background:#fff;
                                    border:4px solid #666;
                                    border-radius:50%;
                                    box-shadow:0 2px 6px rgba(0,0,0,0.1);
                                    cursor:pointer;
                                    position:relative;
                                    z-index:3;
                                }
                                .price-range-css::-ms-thumb {
                                    width:32px;height:32px;
                                    background:#fff;
                                    border:4px solid #666;
                                    border-radius:50%;
                                    box-shadow:0 2px 6px rgba(0,0,0,0.1);
                                    cursor:pointer;
                                    position:relative;
                                    z-index:3;
                                }
                                .price-range-css {
                                    accent-color: #666;
                                    height:8px;
                                    background:#e5e5e5;
                                    border-radius:6px;
                                    outline: none;
                                }

                                /* Tooltip styling */
                                .slider-container {
                                    position: relative;
                                    width: 50%;
                                    margin-bottom: 10px;
                                }
                                .price-tooltip {
                                    position: absolute;
                                    left: 25%;
                                    top: -40px;
                                    transform: translateX(-50%);
                                    background: #222;
                                    color: #fff;
                                    border-radius: 999px;
                                    padding: 8px 32px;
                                    font-size: 16px;
                                    min-width: 120px;
                                    text-align: center;
                                    pointer-events: none;
                                    z-index: 10;
                                    transition: left 0.2s;
                                }

                                /* Position tooltip above thumb using only CSS */
                                .price-range-css {
                                    width: 100%;
                                    margin: 0;
                                    background: transparent;
                                    position: relative;
                                }
                                .slider-container {
                                    width: 60%;
                                    position: relative;
                                }
                                .slider-container .price-tooltip {
                                    left: calc(25% + 0px); /* Default for 50,000 of 200,000 */
                                }
                                #price-range-css:focus + .price-tooltip,
                                #price-range-css:hover + .price-tooltip {
                                    /* Optionally highlight tooltip on focus/hover */
                                }

                                /* Responsive */
                                @media (max-width: 767.98px) {
                                    .dropdown { width: 100% !important; min-width: 100% !important; max-width: 100% !important; }
                                    .dropdown-menu { min-width: 100vw !important; }
                                }
                            </style>
                            <script>
                                // Only update the tooltip value and position using CSS, no extra JS for movement
                                document.addEventListener('DOMContentLoaded', function() {
                                    const range = document.getElementById('price-range-css');
                                    const priceValue = document.getElementById('price-value-css');
                                    const tooltip = document.getElementById('price-tooltip-css');
                                    function formatPKR(val) {
                                        return parseInt(val, 10).toLocaleString();
                                    }
                                    range.addEventListener('input', function() {
                                        priceValue.textContent = formatPKR(range.value);
                                        // Move tooltip using only CSS: update left percent
                                        const min = parseInt(range.min, 10);
                                        const max = parseInt(range.max, 10);
                                        const val = parseInt(range.value, 10);
                                        const percent = ((val - min) / (max - min)) * 100;
                                        tooltip.style.left = `calc(${percent}% + ${8 - percent * 0.16}px)`;
                                    });
                                    // Initial position
                                    range.dispatchEvent(new Event('input'));
                                });
                            </script> -->
                        </div>
                    </div>
                </div>
                <!-- Sort -->
                <div class="col-12 col-md-auto pb-2">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle border-0" type="button"
                            id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                            <button class="dropdown-item active" data-sort="best-selling">Best Selling</button>
                            <button class="dropdown-item" data-sort="title-ascending">Alphabetically, A-Z</button>
                            <button class="dropdown-item" data-sort="title-descending">Alphabetically, Z-A</button>
                            <button class="dropdown-item" data-sort="price-ascending">Price, low to high</button>
                            <button class="dropdown-item" data-sort="price-descending">Price, high to low</button>
                            <button class="dropdown-item" data-sort="created-descending">Date, new to old</button>
                            <button class="dropdown-item" data-sort="created-ascending">Date, old to new</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <!-- <div class="container-fluid mt-5 text-center">
            <h2>Solitaire Diamond Engagement Ring</h2>
            <p>A perfect solitaire ring lets your gorgeous diamond take the center stage so everyone can admire it
                along with you. Browse through our stylish solitaire rings in the latest couture designs and find
                the one that tells your lovestory to perfection.</p>
            <p>Can you do any better than perfection? Well, that’s a tough act to follow. The lady who is drawn to
                the sophistication of a solitaire ring knows her mind. She knows what she likes, and reveals a
                confidence born of a developed</p>
            <p>sense of style—you don’t follow—you lead the way with your effortless chic. There are so many ways to
                personalize your solitaire ring, we’ll let you decide how you want to show your style. Rose gold or
                platinum can be your</p>
            <p>heart’s desire. But so can princess cut diamonds, or a romantic heart shaped stone. Your choice will
                be simply perfection.</p>
        </div> -->
    </section>
    <section class="onlineStore py-5">
        <div class="row mx-auto my-auto g-2 gy-3">
            @foreach ($products as $key => $product)
                <div class="col-md-3">
                    @include('public.partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </section>
@endsection
