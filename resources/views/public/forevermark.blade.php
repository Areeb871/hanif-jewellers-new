@extends('public.layouts.header_black_white_fixed')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/f_assets/css/forevermark.css') }}">

<main class="fm-page">

    <section class="fm-hero">
        <h1 class="fm-hero__title">{{ __('site.forevermark_hero_title') }}</h1>
        <img src="{{ asset('assets/forevermark/hero.webp') }}" alt="Forevermark Diamond Inspiration">
    </section>

    <div class="fm-intro-copy">
        <p>{{ __('site.forevermark_intro_1') }}</p>
        <p>{{ __('site.forevermark_intro_2') }}</p>
    </div>

    <div class="fm-title-marker">
        <img class="fm-title-marker__icon" src="{{ asset('assets/forevermark/diamond.png') }}" alt="" aria-hidden="true">
        <span class="fm-title-marker__line" aria-hidden="true"></span>
        
    </div>
<!-- First Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-icon">
        <h2 class="fm-row__title" id="fm-collection-icon">{{ __('site.forevermark_inspired_title') }}</h2>

            <div class="fm-row__split fm-row__split--media-left">

                <div class="fm-split__media">
                    <div class="fm-media">
                        <img src="{{ asset('assets/forevermark/sample.webp') }}" alt="The Icon™ Collection" loading="lazy">
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
                    <p>{{ __('site.forevermark_inspired_p1') }}</p>
                    <!-- <br/> -->
                    <p>{{ __('site.forevermark_inspired_p2') }}</p>

                </div>
            </div>
        </section>
    </div>

    <!-- Second Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-two">
        <h2 class="fm-row__title" id="fm-collection-two">{{ __('site.forevermark_like_title') }}</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>{{ __('site.forevermark_like_p') }}</p>
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
        <h2 class="fm-row__title" id="fm-collection-three">{{ __('site.forevermark_icon_title') }}</h2>

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
                    <p>{{ __('site.forevermark_icon_p1') }}</p>
                    <p>{{ __('site.forevermark_icon_p2') }}</p>
                </div>
            </div>
        </section>
    </div>
    <!-- Fourth Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-two">
        <h2 class="fm-row__title" id="fm-collection-two">{{ __('site.forevermark_setting_title') }}</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>{{ __('site.forevermark_setting_p') }}</p>
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
        <h2 class="fm-row__title" id="fm-collection-five">{{ __('site.forevermark_avaanti_title') }}</h2>

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
                    <p>{{ __('site.forevermark_avaanti_p') }}</p>

                </div>
            </div>
        </section>
    </div>

    <!-- Sixth Section -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-six">
        <h2 class="fm-row__title" id="fm-collection-six">{{ __('site.forevermark_millemoi_title') }}</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>{{ __('site.forevermark_millemoi_p1') }}</p>
                    <!-- <br/> -->
                    <p>{{ __('site.forevermark_millemoi_p2') }}</p>

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
        <h2 class="fm-row__title" id="fm-collection-seven">{{ __('site.forevermark_encordia_title') }}</h2>

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
                    <p>{{ __('site.forevermark_encordia_p') }}</p>
                    <!-- <br/> -->
                    <!-- <p>Learn more about our Collections below.</p> -->

                </div>
            </div>
        </section>
    </div>

    <!-- Eighth Section  -->
    <div class="fm-wrap">
        <section class="fm-row fm-row--media-left" aria-labelledby="fm-collection-eight">
        <h2 class="fm-row__title" id="fm-collection-eight">{{ __('site.forevermark_universe_title') }}</h2>

            <div class="fm-row__split fm-row__split--media-left fm-row__split--arm-left">

                

                <div class="fm-split__copy">
                    <p>{{ __('site.forevermark_universe_p') }}</p>
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

    <div class="fm-wrap text-center">
        <x-book-appointment
            :href="'https://api.whatsapp.com/send?phone='.$appointmentWhatsappPhone.'&text='.rawurlencode('Hi, I\'d like to connect with a sales expert about Book an Appointment.')"
            target="_blank"
            rel="noopener noreferrer"
        />
    </div>

</main>
@endsection
