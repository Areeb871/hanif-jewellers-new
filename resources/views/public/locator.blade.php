@extends('public.layouts.header_latest')

@php
    $market = $market ?? \App\Models\Products::currentMarket();
    $isUae = $market === 'uae';
    $dubaiMap = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14431.92745836418!2d55.2970309!3d25.2711955!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe577102cc48998b7!2sHanif%20Jewellery%20%26%20Watches%20LLC!5e0!3m2!1sen!2sae!4v1668697188869!5m2!1sen!2sae';
    $lahoreMap = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6466.438102655719!2d74.350692!3d31.509776!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190451c8bbf6b5%3A0x1323e5523eee96d8!2sHanif%20Jewellery%20and%20Watches!5e1!3m2!1sen!2us!4v1746935949665!5m2!1sen!2us';
    $defaultMap = $isUae ? $dubaiMap : $lahoreMap;
    $defaultCity = $isUae ? 'dubai' : 'lahore';
    $defaultCityLabel = $isUae ? __('site.city_dubai') : __('site.city_lahore');
    $storeCards = [
        ['image' => 'assets/f_assets/image/store_images/MMA LHR.jpg', 'title' => __('site.card_flagship_lahore')],
        ['image' => 'assets/f_assets/image/store_images/F6 ISB.jpg', 'title' => __('site.card_flagship_islamabad')],
        ['image' => 'assets/f_assets/image/store_images/Dubai.jpg', 'title' => __('site.card_flagship_dubai')],
        ['image' => 'assets/f_assets/image/store_images/DHA LHR.jpg', 'title' => __('site.card_premium_lahore')],
        ['image' => 'assets/f_assets/image/store_images/Dolmen.png', 'title' => __('site.card_dolmen')],
        ['image' => 'assets/f_assets/image/store_images/Serena.jpg', 'title' => __('site.card_exclusive_islamabad')],
        ['image' => 'assets/f_assets/image/store_images/Merriot.jpg', 'title' => __('site.card_lifestyle_islamabad')],
        ['image' => 'assets/f_assets/image/store_images/FM Pace.jpg', 'title' => __('site.card_franck_muller')],
    ];
    $locationData = [
        'lahore' => [
            ['name' => __('site.store_mm_alam'), 'map' => $lahoreMap],
            ['name' => __('site.store_dha'), 'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6469.01293641384!2d74.377992!3d31.472541!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190715cb842efd%3A0x4fa6cc0a02e21627!2sHanif%20Jewellers%20Y%20Block!5e1!3m2!1sen!2sus!4v1746937029778!5m2!1sen!2sus'],
            ['name' => __('site.store_franck_muller'), 'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6466.008686618933!2d74.352009!3d31.515982!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919073c2a5977cb%3A0xf233059a915c8858!2sFranck%20Muller%20Boutique!5e1!3m2!1sen!2sus!4v1746940330291!5m2!1sen!2sus'],
            ['name' => __('site.store_dolmen'), 'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13640.48652379273!2d74.3470166!3d31.5077711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190900372d5c97%3A0x13adaf745e607f8a!2sDolmen%20Mall%20Lahore!5e0!3m2!1sen!2spk!4v1746940330291'],
        ],
        'islamabad' => [
            ['name' => __('site.store_f6'), 'map' => 'https://maps.google.com/maps?q=Hanif%20Jewellery%20F6%20Islamabad&t=&z=13&ie=UTF8&iwloc=&output=embed'],
            ['name' => __('site.store_serena'), 'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6309.097781911657!2d73.101929!3d33.715203!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfc1062db7201b%3A0xea2a999c57fa3ac4!2sHanif%20Jewellery%20%26%20Watches%20Serena%20Hotel!5e1!3m2!1sen!2sus!4v1746940664880!5m2!1sen!2sus'],
            ['name' => __('site.store_marriott'), 'map' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6307.757784579137!2d73.087097!3d33.733435!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfc1a69a7861ff%3A0x93c656193ea86422!2sHanif%20Jewellery%20%26%20Watches%20Marriot%20Hotel%20Islamabad!5e1!3m2!1sen!2sus!4v1746940778895!5m2!1sen!2sus'],
        ],
        'dubai' => [[
            'name' => __('site.store_dubai_flagship'),
            'map' => $dubaiMap,
        ]],
    ];
@endphp

@section('content')
    <section class="container pt-5">
        <h2 class="py-4 text-center title text-black text-uppercase">{{ __('site.store_locations') }}</h2>
        <div class="text-center mb-3">
            <form action="{{ route('locale.set') }}" method="POST" class="d-inline-flex align-items-center gap-2 hj-lang-switch justify-content-center">
                @csrf
                @if($isUae)
                    <button type="submit" name="choice" value="pk" class="btn btn-sm btn-outline-dark rounded-0">{{ __('site.switch_to_pakistan') }}</button>
                @else
                    <button type="submit" name="choice" value="uae" class="btn btn-sm btn-outline-dark rounded-0">{{ __('site.switch_to_uae') }}</button>
                @endif
            </form>
        </div>

        <div class="row align-items-center justify-content-center g-3">
            <div class="col-md-7">
                <iframe id="mapFrame"
                    src="{{ $defaultMap }}"
                    class="map-1" width="100%" height="397" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="col-md-5">
                <p class="">
                    {{ __('site.locator_intro_all') }}
                </p>

                <!-- <label for="citySelect" class="form-label">Choose City</label> -->
                <div class="dropdown mb-4 position-relative">
                    <button class="btn w-100 text-start bg-white border-0 rounded-0 py-3 px-4 shadow-sm d-flex align-items-center justify-content-between"
                        type="button" id="cityDropdownBtn" aria-expanded="false"
                        style="font-size: 0.85rem; letter-spacing: 0.12em; color: #6c6e7e;">
                        <span id="cityDropdownLabel">{{ $defaultCityLabel }}</span>
                        <span>
                            <svg width="24" height="24" fill="none" stroke="#6c6e7e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </span>
                    </button>
                    <ul class="dropdown-menu w-100 border-0 rounded-0 shadow-sm mt-1"
                        aria-labelledby="cityDropdownBtn"
                        id="cityDropdownMenu"
                        style="font-size: 0.85rem;">
                        <li>
                            <button class="dropdown-item py-3 d-flex align-items-center" type="button" data-value="lahore" style="background: #fafafa;">
                                <span class="me-3 d-inline-block rounded-circle" style="width:25px;height:25px;background:#fff;border:1px solid #eee;">
                                </span>
                                <span style="letter-spacing:0.12em;color:#0a1744;">{{ __('site.city_lahore') }}</span>
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item py-2 d-flex align-items-center" type="button" data-value="islamabad" style="background: #fafafa; height: 44px;">
                                <span class="me-3 d-inline-block rounded-circle" style="width:25px;height:25px;background:#fff;border:1px solid #eee;">
                                </span>
                                <span style="letter-spacing:0.12em;color:#0a1744;">{{ __('site.city_islamabad') }}</span>
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item py-3 d-flex align-items-center" type="button" data-value="dubai" style="background: #fafafa;">
                                <span class="me-3 d-inline-block rounded-circle" style="width:25px;height:25px;background:#fff;border:1px solid #eee;">
                                </span>
                                <span style="letter-spacing:0.12em;color:#0a1744;">{{ __('site.city_dubai') }}</span>
                            </button>
                        </li>
                    </ul>
                    <input type="hidden" id="citySelect" value="{{ $defaultCity }}">
                </div>
                <style>
                    #cityDropdownMenu {
                        opacity: 0;
                        transform: translateY(-20px) scaleY(0.7);
                        pointer-events: none;
                        max-height: 0;
                        transition:
                            opacity 0.4s cubic-bezier(.4,0,.2,1),
                            transform 0.4s cubic-bezier(.4,0,.2,1),
                            max-height 0.5s cubic-bezier(.4,0,.2,1);
                        will-change: opacity, transform, max-height;
                        display: block;
                        overflow: hidden;
                    }
                    #cityDropdownMenu.dropdown-open {
                        opacity: 1;
                        transform: translateY(0) scaleY(1);
                        pointer-events: auto;
                        max-height: 500px;
                    }
                </style>
                <script>
                    // Custom dropdown logic for smooth transition
                    const cityDropdownBtn = document.getElementById('cityDropdownBtn');
                    const cityDropdownMenu = document.getElementById('cityDropdownMenu');

                    // Toggle dropdown
                    cityDropdownBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        cityDropdownMenu.classList.toggle('dropdown-open');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!cityDropdownBtn.contains(e.target) && !cityDropdownMenu.contains(e.target)) {
                            cityDropdownMenu.classList.remove('dropdown-open');
                        }
                    });

                    // Close dropdown on item click
                    cityDropdownMenu.querySelectorAll('.dropdown-item').forEach(function(item) {
                        item.addEventListener('click', function() {
                            setTimeout(() => {
                                cityDropdownMenu.classList.remove('dropdown-open');
                            }, 100);
                        });
                    });
                </script>
                <script>
                    document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(function(item) {
                        item.addEventListener('click', function() {
                            var value = this.getAttribute('data-value');
                            var label = this.querySelector('span:last-child').textContent;
                            document.getElementById('cityDropdownLabel').textContent = label;
                            document.getElementById('citySelect').value = value;
                            document.getElementById('citySelect').dispatchEvent(new Event('change'));
                        });
                    });
                </script>

                <!-- <label for="locationSelect" class="form-label" style="font-size: 0.85rem;">Choose Location</label> -->
                <div class="dropdown mb-4 position-relative">
                    <button class="btn w-100 text-start bg-white border-0 rounded-0 py-3 px-4 shadow-sm d-flex align-items-center justify-content-between"
                        type="button" id="locationSelect" aria-expanded="false"
                        style="font-size: 0.85rem; letter-spacing: 0.12em; color: #6c6e7e;" disabled>
                        <span id="locationDropdownLabel" style="font-size: 0.85rem;">{{ __('site.select_location') }}</span>
                        <span>
                            <svg width="24" height="24" fill="none" stroke="#6c6e7e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </span>
                    </button>
                    <ul class="dropdown-menu w-100 border-0 rounded-0 shadow-sm mt-1"
                        aria-labelledby="locationSelect"
                        id="locationDropdownMenu"
                        style="font-size: 0.85rem;">
                        <!-- Location options will be populated by JS -->
                    </ul>
                </div>
                <style>
                    #locationDropdownMenu {
                        opacity: 0;
                        transform: translateY(-20px) scaleY(0.7);
                        pointer-events: none;
                        max-height: 0;
                        transition:
                            opacity 0.4s cubic-bezier(.4,0,.2,1),
                            transform 0.4s cubic-bezier(.4,0,.2,1),
                            max-height 0.5s cubic-bezier(.4,0,.2,1);
                        will-change: opacity, transform, max-height;
                        display: block;
                        overflow: hidden;
                    }
                    #locationDropdownMenu.dropdown-open {
                        opacity: 1;
                        transform: translateY(0) scaleY(1);
                        pointer-events: auto;
                        max-height: 500px;
                    }
                </style>
                <script>
                    // Custom dropdown logic for smooth transition (location)
                    const locationDropdownBtn = document.getElementById('locationSelect');
                    const locationDropdownMenuA = document.getElementById('locationDropdownMenu');

                    // Toggle dropdown
                    locationDropdownBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        if (locationDropdownBtn.disabled) return;
                        locationDropdownMenuA.classList.toggle('dropdown-open');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!locationDropdownBtn.contains(e.target) && !locationDropdownMenuA.contains(e.target)) {
                            locationDropdownMenuA.classList.remove('dropdown-open');
                        }
                    });

                    // Close dropdown on item click
                    locationDropdownMenuA.addEventListener('click', function(e) {
                        if (e.target.closest('.dropdown-item')) {
                            setTimeout(() => {
                                locationDropdownMenuA.classList.remove('dropdown-open');
                            }, 100);
                        }
                    });
                </script>
                <script>
                    const locationData = @json($locationData);

                    const citySelect = document.getElementById('citySelect');
                    const mapFrame = document.getElementById('mapFrame');
                    // const locationDropdownBtn = document.getElementById('locationSelect');
                    const locationDropdownLabel = document.getElementById('locationDropdownLabel');
                    const locationDropdownMenu = locationDropdownBtn.nextElementSibling;

                    function updateLocationDropdown(city) {
                        locationDropdownMenu.innerHTML = '';
                        locationDropdownLabel.textContent = @json(__('site.select_location'));
                        locationDropdownBtn.value = ''; // Reset value
                        if (locationData[city]) {
                            locationData[city].forEach((loc, idx) => {
                                const li = document.createElement('li');
                                const btn = document.createElement('button');
                                btn.className = 'dropdown-item py-2 d-flex align-items-center';
                                btn.type = 'button';
                                btn.setAttribute('data-value', idx);
                                btn.style.background = '#fafafa';
                                btn.innerHTML = `
                                    <span class="me-3 d-inline-block rounded-circle" style="width:25px;height:25px;background:#fff;border:1px solid #eee;"></span>
                                    <span style="letter-spacing:0.12em;color:#0a1744;font-size:0.85rem;">${loc.name}</span>
                                `;
                                btn.addEventListener('click', function() {
                                    locationDropdownLabel.textContent = loc.name;
                                    locationDropdownBtn.value = idx;
                                    locationDropdownBtn.dispatchEvent(new Event('change'));
                                });
                                li.appendChild(btn);
                                locationDropdownMenu.appendChild(li);
                            });
                            locationDropdownBtn.disabled = false;
                        } else {
                            locationDropdownBtn.disabled = true;
                        }
                    }

                    citySelect.addEventListener('change', function() {
                        updateLocationDropdown(this.value);
                        // Set first location as selected and update map
                        if (locationData[this.value] && locationData[this.value][0]) {
                            // locationDropdownLabel.textContent = locationData[this.value][0].name;
                            locationDropdownBtn.value = 0;
                            mapFrame.src = locationData[this.value][0].map;
                        }
                    });

                    locationDropdownBtn.addEventListener('change', function() {
                        const city = citySelect.value;
                        const idx = this.value;
                        if (locationData[city] && locationData[city][idx]) {
                            mapFrame.src = locationData[city][idx].map;
                        }
                    });

                    // Open locations for the active region (Pakistan or UAE) on load.
                    (function initRegionLocations() {
                        const defaultCity = citySelect.value || '{{ $defaultCity }}';
                        if (!locationData[defaultCity]) {
                            return;
                        }
                        updateLocationDropdown(defaultCity);
                        if (locationData[defaultCity][0]) {
                            locationDropdownLabel.textContent = locationData[defaultCity][0].name;
                            locationDropdownBtn.value = 0;
                            mapFrame.src = locationData[defaultCity][0].map;
                        }
                    })();
                </script>
            </div>
        </div>

        <script>
            // locationData, citySelect, locationSelect, and mapFrame are already defined and used above.
            // No need for duplicate select/option logic here.
        </script>
    </section>

    <!-- <section class="JW pb-5 pt-5">
        <div class="row mx-auto ">
            <div id="loactionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="col-md-3">
                            <a href="#" class="text-decoration-none">
                                <div class="card rounded-0 border-0 text-center position-relative overflow-hidden">
                                    <img src="https://cdn.shopify.com/s/files/1/0565/7916/2292/files/1_1_46ed87a9-3cd5-4600-83f0-755797b2ef40.jpg?v=1716973934"
                                        class="card-img-top rounded-0 carousel-img" alt="Bovet">
                                    <div class="card-img-overlay d-flex align-items-end justify-content-center p-0"
                                        style="background: none; pointer-events: none;">
                                        <div class="w-100 card-title-overlay" style="display: none;">
                                            <h5 class="card-title bg-dark bg-opacity-75 text-white m-0 py-2">FLAGSHIP, Dubai</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <a href="#" class="text-decoration-none">
                                <div class="card rounded-0 border-0 text-center position-relative overflow-hidden">
                                    <img src="https://cdn.shopify.com/s/files/1/0565/7916/2292/files/5_e507edb3-f60b-44e9-be7e-5f40b5fd8f92.jpg?v=1713259210"
                                        class="card-img-top rounded-0 carousel-img" alt="LOUIS MOINET">
                                    <div class="card-img-overlay d-flex align-items-end justify-content-center p-0"
                                        style="background: none; pointer-events: none;">
                                        <div class="w-100 card-title-overlay" style="display: none;">
                                            <h5 class="card-title bg-dark bg-opacity-75 text-white m-0 py-2">Pearl Continental Hotel
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <a href="#" class="text-decoration-none">
                                <div class="card rounded-0 border-0 text-center position-relative overflow-hidden">
                                    <img src="https://cdn.shopify.com/s/files/1/0565/7916/2292/files/1_594197b9-ba5d-4331-81bc-427992b6496c.jpg?v=1713260289"
                                        class="card-img-top rounded-0 carousel-img" alt="BOVET">
                                    <div class="card-img-overlay d-flex align-items-end justify-content-center p-0"
                                        style="background: none; pointer-events: none;">
                                        <div class="w-100 card-title-overlay" style="display: none;">
                                            <h5 class="card-title bg-dark bg-opacity-75 text-white m-0 py-2">F-6 Markaz, Islamabad</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <a href="#" class="text-decoration-none">
                                <div class="card rounded-0 border-0 text-center position-relative overflow-hidden">
                                    <img src="https://cdn.shopify.com/s/files/1/0565/7916/2292/files/1_9bf4b1c9-c0e5-4d0c-8f4c-2c08b06a2391.jpg?v=1713261988"
                                        class="card-img-top rounded-0 carousel-img" alt="CHRONOSWISS">
                                    <div class="card-img-overlay d-flex align-items-end justify-content-center p-0"
                                        style="background: none; pointer-events: none;">
                                        <div class="w-100 card-title-overlay" style="display: none;">
                                            <h5 class="card-title bg-dark bg-opacity-75 text-white m-0 py-2">Marriott Hotel, Islamabad
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev d-none" type="button" data-bs-target="#loactionCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-white p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next d-none" type="button" data-bs-target="#loactionCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-white p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section> -->

    <section class="container pb-5 pt-5">
        <h2 class="py-4 text-center title text-black text-uppercase">{{ __('site.our_stores') }}</h2>
        <div class="row g-4">
            @foreach($storeCards as $store)
                <div class="col-md-4 col-12">
                    <div class="card border-0 rounded-0 h-100">
                        <img src="{{ asset($store['image']) }}" class="card-img-top rounded-0" alt="{{ $store['title'] }}" style="width:100%;height:280px;object-fit:cover;">
                        <div class="card-body text-center">
                            <h6 class="card-title mb-0" style="font-size: 1rem;">{{ $store['title'] }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
