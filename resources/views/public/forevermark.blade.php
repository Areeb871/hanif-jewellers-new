@extends('public.layouts.header_latest')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/f_assets/css/forevermark.css') }}">

<main class="fm-page">

    <section class="fm-hero">
        <h1 class="fm-hero__title">Diamonds for every moment and milestone</h1>
        <img src="{{ asset('assets/forevermark/hero.webp') }}" alt="Forevermark Diamond Inspiration">
    </section>

    <div class="fm-intro-copy">
        <p>There’s a Forevermark diamond for every occasion, perfect to celebrate your special moment.</p>
        <p>Our diamonds are elevated in jewellery designs that light up life’s most memorable occasions as well as its everyday moments. Our designs are modern, distinctive and elegant - timeless with a twist, where the diamond is the hero of each piece.</p>
    </div>

    <div class="fm-title-marker">
        <img class="fm-title-marker__icon" src="{{ asset('assets/forevermark/diamond.png') }}" alt="" aria-hidden="true">
        <span class="fm-title-marker__line" aria-hidden="true"></span>
        
    </div>
<!-- First Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-icon">
        <h2 class="fm-row__title" id="fm-collection-icon">Get inspired by our jewellery collections</h2>

            <div class="fm-row__split fm-row__split--media-left">

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/f_assets/image/forevermark/sample.webp') }}" alt="The Icon™ Collection" loading="lazy">
                    </div>
                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__copy">
                    <p>Our collections are handcrafted to perfection and available in a range of settings and styles. Every design has a Forevermark diamond at its heart, designed to showcase its true beauty. You can also trust  that every Forevermark diamond holds the promise that it is beautiful, rare and responsibly sourced</p>
                    <!-- <br/> -->
                    <p>Learn more about our Collections below.</p>

                </div>
            </div>
        </section>
    </div>

    <!-- Second Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-two">
        <h2 class="fm-row__title" id="fm-collection-two">See something you like?</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>Currently, Forevermark is available in select markets and retail outlets. Contact us to learn more about jewellery availability.</p>
                    <!-- <br/> -->
                    <!-- <p>Learn more about our Collections below.</p> -->

                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/section2.webp') }}" alt="See something you like?" loading="lazy">
                    </div>
                </div>

               
            </div>
        </section>
    </div>

 <!-- Third Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-three">
        <h2 class="fm-row__title" id="fm-collection-three">The Icon™ Collection</h2>

            <div class="fm-row__split fm-row__split--media-left">

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/section3.webp') }}" alt="The Icon™ Collection" loading="lazy">
                    </div>
                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__copy">
                    <p>This collection is designed for those who define their own path, embrace who they are and celebrate their unique style. The brilliance is yours, own the light.</p>
                    <p>The Forevermark Icon™ Collection’s bridal jewellery highlights the timeless Forevermark ‘icon’ motif. A beautiful symbol and continuous reminder of the preciousness of love, the designs have been created for those seeking to celebrate a lifelong journey together. With a contemporary silhouette, this symbolic jewellery collection is crafted to maximise the brilliance of the unique diamond at the heart of each design.</p>
                </div>
            </div>
        </section>
    </div>
    <!-- Fourth Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-two">
        <h2 class="fm-row__title" id="fm-collection-two">The Forevermark Setting ™</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>Inspired by the shape of the Forevermark icon, The Forevermark Setting™ Collection is the ultimate in simple, classic elegance. The four-pronged mount delicately cradles the precious De Beers Forevermark diamond at its centre, a design specially fashioned to allow maximum light through the diamond’s facets and create that inimitable diamond sparkle.</p>
                    <!-- <br/> -->
                    <!-- <p>Learn more about our Collections below.</p> -->

                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/section4.webp') }}" alt="See something you like?" loading="lazy">
                    </div>
                </div>

               
            </div>
        </section>
    </div>

    <!-- Fifth Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-five">
        <h2 class="fm-row__title" id="fm-collection-five">The Avaanti ™ Collection</h2>

            <div class="fm-row__split fm-row__split--media-left">

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/section5.webp') }}" alt="The Avaanti™ Collection" loading="lazy">
                    </div>
                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__copy">
                    <p>The Avaanti ™ collection reflects the ever-evolving path of a journey. It begins with a Forevermark diamond, gracefully unfolding into a masterpiece. Its conical end mirrors the culet, completing the diamond’s form. The entire piece takes on the elegant silhouette of a natural diamond, symbolising growth.</p>

                </div>
            </div>
        </section>
    </div>

    <!-- Sixth Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-six">
        <h2 class="fm-row__title" id="fm-collection-six">The Millemoi™ Collection</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>This Collection symbolises the rich, intricate layers of the wearer’s story. Showing how diverse and dynamic their journey is, each layer adds texture and nuance in a uniquely compelling and authentic manner.</p>
                    <!-- <br/> -->
                    <p>Metal bands in three tones of gold – yellow, rose and white, perfectly embrace the beautiful Forevermark diamond at its heart.</p>

                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/section6.webp') }}" alt="The Millemoi™ Collection" loading="lazy">
                    </div>
                </div>

               
            </div>
        </section>
    </div>

    <!-- Seventh Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-seven">
        <h2 class="fm-row__title" id="fm-collection-seven">The Encordia™ Collection</h2>

            <div class="fm-row__split fm-row__split--media-left">

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/section7.webp') }}" alt="Get inspired by our jewellery collections" loading="lazy">
                    </div>
                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__copy">
                    <p>Each Encordia™  design features a Forevermark diamond held within a knot, inspired by the legendary ‘Knot of Herakles’ - a symbol of the strongest connection that be shared, symbolising ties that truly last.</p>
                    <!-- <br/> -->
                    <!-- <p>Learn more about our Collections below.</p> -->

                </div>
            </div>
        </section>
    </div>

    <!-- Eighth Section  -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-eight">
        <h2 class="fm-row__title" id="fm-collection-eight">The Centre of My Universe™ Collection</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>Starring a Forevermark solitaire diamond surrounded by a delicate halo of pavé diamonds, The Centre of My Universe™ Collection has been designed to embody the person at the very heart of your world, and their power to hold together and keep in motion the many different aspects of the universe you share.</p>
                    <!-- <br/> -->


                </div>

                <div class="fm-split__spine" aria-hidden="true">
                    <span class="fm-spine__line-v"></span>
                    <div class="fm-spine__arm">
                        <span class="fm-spine__line-h"></span>
                        <svg class="fm-spine__diamond" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1L12 7L7 13L2 7L7 1Z" stroke="currentColor" stroke-width="1" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/section8.webp') }}" alt="The Centre of My Universe™ Collection" loading="lazy">
                    </div>
                </div>

               
            </div>
        </section>
    </div>


    

</main>
@endsection
