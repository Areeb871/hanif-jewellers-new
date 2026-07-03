<!-- Mobile Header Styles -->
<style>
    /* Mobile Header Styles */
    .mobile-header {
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    
    .mobile-header-top {
        background: #000;
        color: #fff;
        padding: 8px 0;
        font-size: 12px;
    }
    
    header.mobile-header-main {
        padding: 6px 0;
        background: #fff !important;
    }

    header.mobile-header-main:hover {
        background: #fff !important;
    }
    
    .mobile-logo {
        max-width: 150px;
        height: 37px;
        width: auto;
        object-fit: contain;
    }
    
    .mobile-nav-icons {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .mobile-nav-icon {
        color: #333;
        font-size: 18px;
        text-decoration: none;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .mobile-nav-icon:hover {
        background: #f8f9fa;
        color: #000;
    }
    
    .mobile-cart-badge {
        position: absolute;
        top: 0px;
        right: 0px;
        background: #dc3545;
        color: #fff;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    
    .mobile-menu-toggle {
        border: none;
        background: none;
        padding: 8px;
        border-radius: 4px;
        transition: background 0.3s ease;
    }
    
    .mobile-menu-toggle:hover {
        background: #f8f9fa;
    }
    
    .mobile-menu-toggle .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 37, 41, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    /* Mobile Offcanvas Styles */
    .mobile-offcanvas {
        width: 100%;
        max-width: 100%;
    }
    
    .mobile-offcanvas-header {
        border-bottom: 1px solid #e9ecef !important;
        padding: 20px !important;
        display: grid !important;
        grid-template-columns: 1fr 1fr 1fr !important;
        align-items: center !important;
        background: #fff !important;
        margin: 0 !important;
        width: 100% !important;
    }
    
    .mobile-offcanvas-header .close-section {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
    }
    
    .mobile-offcanvas-header .close-section .btn-close {
        background: none !important;
        border: none !important;
        font-size: 20px !important;
        color: #666 !important;
        padding: 0 !important;
        width: auto !important;
        height: auto !important;
    }
    
    .mobile-offcanvas-header .close-section .btn-close::before {
        content: "×" !important;
        font-size: 24px !important;
        font-weight: 300 !important;
        color: #666 !important;
    }
    
    .mobile-offcanvas-header .close-section .btn-close i {
        font-size: 20px !important;
        color: #666 !important;
    }
    
    .mobile-offcanvas-header .logo-section {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    
    .mobile-offcanvas-header .logo-section .brand-text {
        font-family: "Times New Roman", serif !important;
        font-size: 24px !important;
        font-weight: bold !important;
        color: #000 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
    }
    
    .mobile-offcanvas-header .action-section {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
    }
    
    .mobile-offcanvas-header .action-section a {
        color: #000 !important;
        text-decoration: none !important;
        font-size: 18px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 30px !important;
        height: 30px !important;
    }
    
    .mobile-offcanvas-body {
        padding: 0;
    }
    
    .mobile-nav-item {
        border-bottom: 1px solid #f8f9fa;
    }
    
    .mobile-nav-link {
        padding: 14px 20px;
        font-size: 14px;
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 500;
        transition: background 0.3s ease;
    }
    
    .mobile-nav-link:hover {
        background: #f8f9fa;
        color: #000;
    }
    
    .mobile-nav-link.active {
        background: #f8f9fa;
        color: #000;
    }
    
    .mobile-submenu {
        background: #f8f9fa;
        padding-left: 20px;
    }
    
    .mobile-submenu-item {
        padding: 12px 20px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .mobile-submenu-link {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }
    
    .mobile-submenu-link:hover {
        color: #000;
    }
    
    .mobile-contact-info {
        padding: 20px;
        background: #f8f9fa;
        margin-top: auto;
    }
    
    .mobile-contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        color: #666;
        font-size: 14px;
    }
    
    .mobile-back-button {
        padding: 5px 20px 40px 20px;
        border-bottom: 1px solid #f8f9fa;
    }
    
    .mobile-back-button .btn-back {
        background: none;
        border: none;
        color: #666;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0;
        transition: color 0.3s ease;
    }
    
    .mobile-back-button .btn-back:hover {
        color: #000;
    }
    
    .mobile-back-button .btn-back i {
        font-size: 18px;
    }
    
    /* Collection images styling */
    .mobile-nav-link .collection-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
    }
    
    .mobile-nav-link:has(.collection-img) {
        justify-content: flex-start;
    }
    
    .mobile-nav-link:has(.collection-img) span {
        flex: 1;
    }
    
    /* Collection cards layout */
    .collection-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .collection-card {
        background: #fff;
        /* border: 1px solid #f0f0f0; */
        border-radius: 5px;
        overflow: hidden;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #333;
    }
    
    .collection-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgb(0 0 0 / 3%);
        color: #333;
    }
    
    .collection-card-img {
        width: 100%;
        height: auto;
        object-fit: contain;
        object-position: center;
    }
    
    .collection-card-title {
        display: none;
    }
    
    /* Responsive Breakpoints */
    @media (min-width: 768px) {
        .mobile-header {
            display: none;
        }
    }
    
    @media (max-width: 767px) {
        .desktop-header {
            display: none;
        }
    }
    
    /* Animation for mobile menu */
    .mobile-nav-item .collapse {
        transition: all 0.3s ease;
    }
    
    .mobile-nav-item .collapsing {
        transition: all 0.3s ease;
    }
    
    /* Slower offcanvas transitions */
    .mobile-offcanvas {
        transition: transform 0.4s ease-in-out !important;
    }
    
    .offcanvas {
        transition: transform 0.4s ease-in-out !important;
    }
    
    .offcanvas.show {
        transition: transform 0.4s ease-in-out !important;
    }

    .mobile-offcanvas-header .btn-close:focus {
        box-shadow: none !important;
        outline: none !important;
        border: none !important;
    }
    
.mobile-offcanvas-header .btn-close:focus-visible {
    box-shadow: none !important;
    outline: none !important;
    border: none !important;
}

@media (max-width: 767.98px) {
    .currency-toggle-btn {
        display: none !important; /* hide currency toggle on mobile */
    }
}
.mobile-nav-icon {
    font-size: 18px;
    color: #000;
}

.mobile-cart-badge {
    position: absolute;
    top: -4px;
    right: -8px;
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    padding: 2px 5px;
    border-radius: 999px;
}
.menu-section-title{
  font-size:14px;
  font-weight:600;
  letter-spacing:2px;
  color:#1a1a1a;
  margin:20px 0 12px;
  position:relative;
  display:inline-block;
  padding-bottom:6px;
}

.menu-section-title::after{
  content:"";
  position:absolute;
  left:0;
  bottom:0;
  width:60px;
  height:2px;
  background:#c8a96a; /* luxury gold line */
}
.mobile-submenu ul{
  list-style:none;
  padding:0;
  margin:0;
}

.mobile-submenu li{
  padding:8px 0;
}

.mobile-submenu a{
  text-decoration:none;
  font-size:13px;
  letter-spacing:2px;
  color:#7a7a7a;
  text-transform:uppercase;
}
</style>

<!-- Mobile Header -->
<header class="mobile-header-main d-block d-lg-none">
    <!-- Top Bar -->
    <!-- <div class="mobile-header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <a href="/locator" class="text-white text-decoration-none me-3">
                        <i class="fa-solid fa-location-dot me-1"></i>
                        <span class="d-none d-sm-inline">Store Locator</span>
                    </a>
                    <a href="/contact-us" class="text-white text-decoration-none">
                        <i class="fa-solid fa-phone-volume me-1"></i>
                        <span class="d-none d-sm-inline">Contact</span>
                    </a>
                </div>
                <div class="col-6 text-end">
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    
    <!-- Main Header -->
  <div class="mobile-header-main d-block d-lg-none">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left: Hamburger -->
            <div class="col-3">
                <button class="mobile-menu-toggle" type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobileOffcanvas"
                        aria-label="Open menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Center: Logo -->
            <div class="col-6 text-center">
                <a href="/" class="d-inline-block">
                    <img src="{{ asset('assets/f_assets/image/HanifLogoBlack.png') }}"
                         alt="Hanif Jewellers"
                         class="mobile-logo">
                </a>
            </div>

            <!-- Right: Search + Cart -->
            <div class="col-3">
                <div class="mobile-nav-icons d-flex justify-content-end align-items-center gap-3">

                    <!-- Search (same modal as desktop) -->
                    <a href="#"
                       class="mobile-nav-icon"
                       data-bs-toggle="modal"
                       data-bs-target="#navSearchModal"
                       aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>

                    <!-- Cart -->
                    <a href="/cart" class="mobile-nav-icon position-relative">
                        <i class="fa-solid fa-cart-shopping"></i>

                        @php
                            $cartCount = 0;
                            if (Auth::check()) {
                                $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                            } else {
                                $cartCount = \App\Models\Cart::where('session_id', session()->getId())->sum('quantity');
                            }
                        @endphp

                        @if($cartCount > 0)
                            <span class="mobile-cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>


</header>

@php
    // Shared data for all offcanvas menus
    $customRoutes = [
        'EHED' => route('ehed'),
        'CLEOPATRA' => route('cleopatra'),
        'MISTERIO' => route('misterio'),
        'GOHAR' => route('gohar'),
        'HASHT' => route('hasht'),
        'QAWS-AL-MATAR' => route('qaws-al-matar'),
        'MARCHISIO' => route('marchisio'),
        'TIMLESS JEWELS' => route('timeless-jewels'),
        'GEHNAWA' => route('gehnawa'),
        'NAVRATAN' => route('collections.navratan'),
        'TAJ MAHAL' => route('taj-mahal'),
        'GULPOSH' => route('gulposh'),
        'PURE LOCK' => route('pure-lock'),
    ];
    
    $jewelryCollections = \App\Models\Subcategory::where([['status', 'active'],['category_id', 1]])->get();
    
    $highEndCollections =  ['HASHT', 'QAWS-AL-MATAR','NAGAR', 'GULPOSH','GOHAR','HAPHAZARD'];
    $bridalCollections = [ 'GEHNAWA', 'NAVRATAN', 'TAJ MAHAL', 'HERITAGE','BREATHTAKING','CLEOPATRA','DIVINE TREASURES','MISTERIO','MARCHISIO'];
    $seasonalCollections = ['EID PAR SONY KI CHORIYAN', 'VALENTINE JEWELS', 'WINTER JEWELS'];
    $lifestyleCollections = ['EHED', 'JEWELPHABETS', 'MONA LISA', 'PURE LOCK', 'SELENE'];
@endphp

<!-- Mobile Offcanvas Menu -->
<div class="offcanvas offcanvas-start mobile-offcanvas" tabindex="-1" id="mobileOffcanvas" style="--bs-offcanvas-width: 100%;">
    @include('public.partials.mobile-offcanvas-header', ['showClose' => true])
    <div class="offcanvas-body d-flex flex-column">
        <nav class="mobile-nav">
            <ul class="list-unstyled mb-4">
                <!-- Collections -->
                <!-- <li class="mobile-nav-item">
                    <a class="mobile-nav-link collections-link" href="#">
                        <span>COLLECTIONS</span>
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li> -->
                 <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/highend-jewellery">HIGH END</a>
                </li>
              <li class="mobile-nav-item">

  <a class="mobile-nav-link d-flex justify-content-between align-items-center"
     data-bs-toggle="collapse"
     href="#jewelryMenu"
     role="button">

     JEWELRY
     <span class="mobile-arrow">▲</span>

  </a>

  <div class="collapse" id="jewelryMenu">
    <div class="mobile-submenu">

    <div class="menu-section-title">
BRIDALS
</div>
    <ul>
<li><a href="{{ url('/collections/gehnawa') }}">GEHNAWA</a></li>
<li><a href="{{ url('/collections/navratan') }}">NAVRATAN</a></li>
<li><a href="{{ url('/collections/taj-mahal') }}">TAJ MAHAL</a></li>
<li><a href="{{ url('/collections/heritage') }}">HERITAGE</a></li>
<li><a href="{{ url('/collections/cleopatra') }}">CLEOPATRA</a></li>
<li><a href="{{ url('/collections/misterio') }}">MISTERIO</a></li>


    </ul>
      <div class="menu-section-title">
        LIFESTYLE
    </div>
    
    <ul>
        <li><a href="/collections/ehed">EHED</a></li>
<!-- <li><a href="/collections/jewelphabets">JEWELPHABETS</a></li> -->
<!-- <li><a href="/collections/mona-lisa">MONA LISA</a></li> -->
<li><a href="/collections/pure-lock">PURE LOCK</a></li>
<li><a href="/collections/selene">SELENE</a></li>
<li><a href="{{ url('/collections/divine-treasures') }}">DIVINE TREASURES</a></li>
<li><a href="{{ url('/collections/marchisio') }}">MARCHISIO</a></li>
    </ul>
    
     <!-- <div class="menu-section-title">
        Festive
    </div> -->
<!-- <ul>
        <li><a href="/collections/eid-par-sony-ki-choriyan">Eid Par Sone Ki Choriyan</a></li>
       <li><a href="/collections/valentine-jewels">Valentine Hearts</a></li>

    </ul> -->

</div>
  </div>

</li>
                <!-- Watches -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/watches">WATCHES</a>
                </li>
                
                <!-- Online Shopping -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/collections/online-shopping-store">ONLINE SHOPPING STORE</a>
                </li>

                <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/solitaire-old">SOLITAIRE</a>
                </li>
                
                <!-- About Us -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/about-us">ABOUT US</a>
                </li>
                
                <!-- Contact -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link" href="/contact-us">CONTACT</a>
                </li>
                
            </ul>
        </nav>
        
        @include('public.partials.mobile-offcanvas-footer')
    </div>
</div>

<!-- Mobile Offcanvas Menu for Collections -->
<div class="offcanvas offcanvas-start mobile-offcanvas" tabindex="-1" id="collectionsOffcanvas" style="--bs-offcanvas-width: 100%;">
    @include('public.partials.mobile-offcanvas-header', ['showClose' => true])
    <div class="offcanvas-body d-flex flex-column">
        <!-- Back Button -->
        <div class="mobile-back-button">
            <button type="button" class="btn-back" data-bs-dismiss="offcanvas">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Collections</span>
            </button>
        </div>
        
        <nav class="mobile-nav">
            <ul class="list-unstyled mb-0">
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link collection-item" href="#" data-collection="high-end">
                        <span>HIGH END | BESPOKE</span>
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link collection-item" href="#" data-collection="bridal">
                        <span>BRIDAL</span>
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li>
                <!-- <li class="mobile-nav-item">
                    <a class="mobile-nav-link collection-item" href="#" data-collection="seasonal">
                        <span>SEASONAL</span>
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li> -->
                <li class="mobile-nav-item">
                    <a class="mobile-nav-link collection-item" href="#" data-collection="lifestyle">
                        <span>LIFESTYLE</span>
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        
        @include('public.partials.mobile-offcanvas-footer')
    </div>
</div>

<!-- Collection Offcanvas Menus -->
@include('public.partials.collection-offcanvas', [
    'id' => 'highEndOffcanvas',
    'title' => 'HIGH END | BESPOKE',
    'collections' => $highEndCollections,
    'customRoutes' => $customRoutes,
    'jewelryCollections' => $jewelryCollections
])

@include('public.partials.collection-offcanvas', [
    'id' => 'bridalOffcanvas',
    'title' => 'BRIDAL',
    'collections' => $bridalCollections,
    'customRoutes' => $customRoutes,
    'jewelryCollections' => $jewelryCollections
])

@include('public.partials.collection-offcanvas', [
    'id' => 'seasonalOffcanvas',
    'title' => 'SEASONAL',
    'collections' => $seasonalCollections,
    'customRoutes' => $customRoutes,
    'jewelryCollections' => $jewelryCollections
])

@include('public.partials.collection-offcanvas', [
    'id' => 'lifestyleOffcanvas',
    'title' => 'LIFESTYLE',
    'collections' => $lifestyleCollections,
    'customRoutes' => $customRoutes,
    'jewelryCollections' => $jewelryCollections
])

<!-- Mobile Header JavaScript -->
<script>
    // Mobile menu enhancements
    document.addEventListener('DOMContentLoaded', function() {
        // Handle collections link click for smooth transition
        const collectionsLink = document.querySelector('.collections-link');
        
        if (collectionsLink) {
            collectionsLink.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const collectionsOffcanvas = document.getElementById('collectionsOffcanvas');
                
                if (collectionsOffcanvas) {
                    const bsOffcanvas = new bootstrap.Offcanvas(collectionsOffcanvas);
                    bsOffcanvas.show();
                }
            });
        }
        
        // Handle collection item clicks
        const collectionItems = document.querySelectorAll('.collection-item');
        collectionItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const collectionType = this.getAttribute('data-collection');
                let targetOffcanvasId = '';
                
                switch(collectionType) {
                    case 'high-end':
                        targetOffcanvasId = 'highEndOffcanvas';
                        break;
                    case 'bridal':
                        targetOffcanvasId = 'bridalOffcanvas';
                        break;
                    case 'seasonal':
                        targetOffcanvasId = 'seasonalOffcanvas';
                        break;
                    case 'lifestyle':
                        targetOffcanvasId = 'lifestyleOffcanvas';
                        break;
                }
                
                if (targetOffcanvasId) {
                    const targetOffcanvas = document.getElementById(targetOffcanvasId);
                    if (targetOffcanvas) {
                        const bsOffcanvas = new bootstrap.Offcanvas(targetOffcanvas);
                        bsOffcanvas.show();
                    }
                }
            });
        });
        
        // Auto-close mobile menu when clicking on collection cards
        const collectionCards = document.querySelectorAll('.collection-card');
        collectionCards.forEach(card => {
            card.addEventListener('click', function() {
                // Close all offcanvas menus
                const allOffcanvas = document.querySelectorAll('.offcanvas');
                allOffcanvas.forEach(offcanvas => {
                    const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                    if (bsOffcanvas) {
                        bsOffcanvas.hide();
                    }
                });
            });
        });
        
        // Auto-close mobile menu when clicking on a link (except collections)
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link[href]:not([data-bs-toggle]):not(.collections-link)');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('mobileOffcanvas'));
                const collectionsOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('collectionsOffcanvas'));
                if (offcanvas) {
                    offcanvas.hide();
                }
                if (collectionsOffcanvas) {
                    collectionsOffcanvas.hide();
                }
            });
        });
        
        // Smooth scroll for mobile menu
        const mobileOffcanvas = document.getElementById('mobileOffcanvas');
        const collectionsOffcanvas = document.getElementById('collectionsOffcanvas');
        
        if (mobileOffcanvas) {
            mobileOffcanvas.addEventListener('show.bs.offcanvas', function() {
                document.body.style.overflow = 'hidden';
            });
            
            mobileOffcanvas.addEventListener('hide.bs.offcanvas', function() {
                document.body.style.overflow = '';
            });
        }
        
        if (collectionsOffcanvas) {
            collectionsOffcanvas.addEventListener('show.bs.offcanvas', function() {
                document.body.style.overflow = 'hidden';
            });
            
            collectionsOffcanvas.addEventListener('hide.bs.offcanvas', function() {
                document.body.style.overflow = '';
            });
        }
    });
</script> 
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.offcanvas').forEach(offcanvas => {
        offcanvas.addEventListener('hidden.bs.offcanvas', function () {
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            document.body.classList.remove('modal-open');

            document.querySelectorAll('.offcanvas-backdrop').forEach(el => el.remove());
        });
    });
});
</script>
