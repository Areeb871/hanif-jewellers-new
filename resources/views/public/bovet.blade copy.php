@extends('public.layouts.header')

@section('content')
    <section class="bovetSection p-5">

    </section>

    <section>
        <div class="container py-5">
            <div class="breadcrumb">
                <a href="/" title="Home" class="a_link">
                    Home
                </a> &nbsp; ♦ &nbsp;
                <span>bovet</span>
            </div>
            <div class="row">
                <!-- First Half -->
                <div class="col-md-6">
                    <div class="row g-3"> <!-- Add gap between selects -->
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

                <!-- Second Half -->
                <div class="col-md-6">
                    <div class="row g-3"> <!-- Add gap between selects -->
                        <div class="col-md-8"></div> <!-- Empty columns to push Sort By to right -->
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

            </div>
        </div>
        <div class="py-3 mx-md-5 m-3 bgColorLight">
            <div class="container py-5">
                <div class="text-center">
                    <img src="//www.hanifjewellers.com/cdn/shop/t/24/assets/bovet.png?v=144805122806282352531653048849"
                        class="watch" width="130px">

                    <p class="p-3"> The House of BOVET artfully combines the most sophisticated high-watchmaking
                        mechanisms with the highest craftsmanship, employing artisanal techniques such as hand-finishing,
                        hand-engraving, enameling, and
                        miniature painting, while at the same time using cutting-edge designs, colors, and materials. For
                        200 years, the House of BOVET has handcrafted the finest timepieces, allowing collectors to
                        experience
                        the true pleasure of the luxury of time. To further ensure this excellence, owner Mr. Pascal Raffy
                        has
                        limited the House’s annual manufacture of handcrafted timepieces, making nearly all the components
                        in-house, including the beating heart, the hairspring and regulating organ. BOVET 1822 is intent on
                        perpetuating Swiss artisanal processes and constantly reinforcing its commitment to exclusivity and
                        uniqueness every single day. Join us in celebrating 200 years of Timeless Art and Engineering
                        Brilliance. </p>
                </div>

                <div class="row onlineStore g-3">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-img">
                                <a href="http://">
                                    <img src="https://objects-prod.cdn.chopard.com/q_auto,f_auto,dpr_auto/e_trim/c_lpad,w_iw,h_ih/c_lpad,ar_1:1,w_600,d_Placeholders:nav-catalog-placeholder.png,g_center,e_sharpen:60/ProductsAssets/Web/161954-9001_01.png"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="card-img-overlay">New</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Gold Bracelet - E113705</h5>
                                <p class="card-text">PKR 295,000</p>
                                <a href="http://" class="btn text-white bg-black addToCart">
                                    Discover More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
