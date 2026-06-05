<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include("admin_layout.header")
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header">
                    <a href="{{ route('dashboard') }}" class="app-sidebar-logo">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-25px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-20px h-lg-25px theme-dark-show" />
                    </a>
                    <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-light btn-color-gray-700 btn-active-color-primary d-none d-lg-flex rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                        <i class="ki-outline ki-text-align-right rotate-180 fs-1"></i>
                    </div>
                </div>
                <div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
                    <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header" data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
                        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                            <div class="menu-item mb-2">
                                <div class="menu-heading text-uppercase fs-7 fw-bold">Menu</div>
                                <div class="app-sidebar-separator separator"></div>
                            </div>
                            <div data-kt-menu-trigger="click" class="menu-item {{ request()->is('admin/dashboard') ? 'here show' : '' }} menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-home-2 fs-2"></i>
                                    </span>
                                    <span class="menu-title">Dashboards</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Default</span>
                                        </a>
                                    </div>
                                    <!-- <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Projects</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link" href="#">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Marketing</span>
                                        </a>
                                    </div> -->
                                </div>
                            </div>

                            <div data-kt-menu-trigger="click" class="menu-item {{ request()->is('admin/product/*') ? 'here show' : '' }} menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-sms fs-2"></i>
                                    </span>
                                    <span class="menu-title">Products</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('all-products') ? 'active' : '' }}" href="{{ route('all-products') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">All</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('add-product') ? 'active' : '' }}" href="{{ route('add-product') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Add Product</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('product-category') ? 'active' : '' }}" href="{{ route('product-category') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Categories List</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('add-product-category') ? 'active' : '' }}" href="{{ route('add-product-category') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Add Category</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('product-sub-category') ? 'active' : '' }}" href="{{ route('product-sub-category') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Sub-Categories List</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('add-product-sub-category') ? 'active' : '' }}" href="{{ route('add-product-sub-category') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Add Sub Category</span>
                                        </a>
                                    </div>
                                     <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('import-csv') ? 'active' : '' }}" href="{{ route('import-csv') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Import Csv</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

<div 
data-kt-menu-trigger="click"
    class="menu-item menu-accordion 
    {{ request()->routeIs('orders.*') || request()->routeIs('admin.orders.abandoned') ? 'here show' : '' }}">

    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-outline ki-shopping-cart fs-2"></i>
        </span>
        <span class="menu-title">Orders</span>
        <span class="menu-arrow"></span>
    </span>

    {{-- Sub Menu --}}
    <div class="menu-sub menu-sub-accordion">

        <div class="menu-item">
            <a 
                class="menu-link {{ request()->routeIs('orders.index') ? 'active' : '' }}" 
                href="{{ route('orders.index') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">All Orders</span>
            </a>
        </div>

        <div class="menu-item">
            <a 
                class="menu-link {{ request()->routeIs('admin.orders.abandoned') ? 'active' : '' }}" 
                href="{{ route('admin.orders.abandoned') }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Abandoned Orders</span>
            </a>
        </div>

    </div>
</div>


                            <div data-kt-menu-trigger="click" class="menu-item {{ request()->is('admin/page/*') ? 'here show' : '' }} menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-people fs-2"></i>
                                    </span>
                                    <span class="menu-title">Pages</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('page-home') ? 'active' : '' }}" href="{{ route('page-home') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Home</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.ehed-gallery') ? 'active' : '' }}" href="{{ route('admin.ehed-gallery') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Ehed Gallery</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.pure-lock-gallery') ? 'active' : '' }}" href="{{ route('admin.pure-lock-gallery') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Pure Lock Gallery</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.privacy-policy.edit') ? 'active' : '' }}" href="{{ route('admin.privacy-policy.edit') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Privacy Policy</span>
                                        </a>
                                    </div>
                                   <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.blogs.index') ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Blogs</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.refund-policy.edit') ? 'active' : '' }}" href="{{ route('admin.refund-policy.edit') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Refund Policy</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.terms-service.edit') ? 'active' : '' }}" href="{{ route('admin.terms-service.edit') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Terms of Service</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.shipping-policy.edit') ? 'active' : '' }}" href="{{ route('admin.shipping-policy.edit') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Shipping Policy</span>
                                        </a>
                                    </div>
                                    <!-- <div class="menu-item">
                                        <a class="menu-link {{ request()->is('client/leading') ? 'active' : '' }}" href="/client/leading">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Leading Clients</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->is('client/onboard') ? 'active' : '' }}" href="/client/onboard">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">OnBord Clients</span>
                                        </a>
                                    </div> -->
                                </div>
                            </div>

                             <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('admin.gold-rates.index') ? 'here show' : '' }} menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-wallet fs-2"></i>
                                    </span>
                                    <span class="menu-title">Gold Rates</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.gold-rates.index') ? 'active' : '' }}" href="{{ route('admin.gold-rates.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Manage Gold Rates</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                             <div data-kt-menu-trigger="click" class="menu-item {{ request()->routeIs('admin.diamond-rates.index') ? 'here show' : '' }} menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-star fs-2"></i>
                                    </span>
                                    <span class="menu-title">Diamond Rates</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.diamond-rates.index') ? 'active' : '' }}" href="{{ route('admin.diamond-rates.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Manage Diamond Rates</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                             <div class="menu-item">
        <a 
            class="menu-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" 
            href="{{ route('reviews.index') }}"
        >
            <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
            </span>
            <span class="menu-title">Manage Reviews</span>
        </a>
    </div>


           

                            <!-- <div data-kt-menu-trigger="click" class="menu-item {{ request()->is('settings/*') ? 'here show' : '' }} menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-setting fs-2"></i>
                                    </span>
                                    <span class="menu-title">Settings</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->is('settings/email-content-templates') ? 'active' : '' }}" href="/settings/email-content-templates">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Email Content Templates</span>
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
            <div id="kt_app_footer" class="app-footer">
                <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2025&copy;</span>
                        <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Hanif Jewellers</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
