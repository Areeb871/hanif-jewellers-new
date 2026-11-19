@extends('public.layouts.header_new')

@section('content')
    <section class="careInstructionsSection" aria-label="Care instructions banner">
        <h1 class="care-banner-title">
            @if(app()->getLocale() === 'ar')
                <span>طريقة</span>
                <span>العناية</span>
            @else
                <span>CARE</span>
                <span>INSTRUCTION</span>
            @endif
        </h1>
    </section>

    <section class="care-content-section">
        <!-- <div class="container py-4">
            <div class="breadcrumb">
                <a href="/" title="Home" class="a_link">
                    Home
                </a> &nbsp; ♦ &nbsp;
                <span>Care Instructions</span>
            </div>
            <h2 class="pb-4 mb-3 text-center title text-black text-uppercase border-bottom border-black">Care Instructions
            </h2> -->

            <div class="container">
                <h1 class="care-page-title text-center fw-bold border-bottom border-1 border-black">
                    {{ app()->getLocale() === 'ar' ? 'أسئلة شائعة' : 'FAQS' }}
                </h1>
                <div class="accordion faqPageWrapper border-0" id="faqAccordion">
                    <!-- Item 1 -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed bg-white px-0 py-4 shadow-none text-uppercase fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne" style="font-size: 1.1rem;">
                                {{ app()->getLocale() === 'ar' ? 'عناية الأحجار والمجوهرات' : 'GEMS & JEWELLERY CARE' }}
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-0">
                                <ul>
                                    @if(app()->getLocale() === 'ar')
                                    <li>شدّي المخالب بعد سنة أو سنتين إذا كنتِ تلبسين القطعة باستمرار.</li>
                                    <li>حطّي الأحجار في علبة مجوهرات مبطّنة، أو علبة فيها تقسيمات. إذا بتستخدمين علبة عادية، لفّي كل قطعة لحالها بمخمل أو حرير أو ورق، لأن الألماس يخدش باقي القطع.</li>
                                    <li>زوري الصائغ مرة في السنة على الأقل، وخليه يتأكد من الدبابيس والقفل.</li>
                                    <li>لمّا تشيلين القطعة، امسحيها بقماش ناعم ورطب. كذا يزيد اللمعان وتكون نظيفة قبل التخزين.</li>
                                    <li>حطّي العطر أو مثبت الشعر قبل ما تلبسين المجوهرات.</li>
                                    @else
                                    <li>Ensure to tighten the clamps after one year or two years if they are worn frequently.</li>
                                    <li>Store the gems in a fabric-lined jewellery box or box with compartments. If you prefer to use a regular box, wrap each piece individually in velvet, silk or paper because the diamond will line/damage other pieces of jewellery and diamonds.</li>
                                    <li>Visit the jeweller at least annually and ask him to check the parts for loose pins and wear/tear fasteners.</li>
                                    <li>When taking off the jewellery, wipe it with a soft moist cloth. This will improve the luster and ensure that the jewels are clean before they are stored.</li>
                                    <li>Before wearing a piece of jewellery apply perfume or hairspray.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed bg-white px-0 py-4 shadow-none text-uppercase fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo" style="font-size: 1.1rem;">
                                {{ app()->getLocale() === 'ar' ? 'تنظيف الأحجار والمجوهرات' : 'GEMS & JEWELLERY CLEANING' }}
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-0">
                                <ul>
                                    @if(app()->getLocale() === 'ar')
                                    <li>دايم شيلي مجوهرات الألماس قبل غسيل اليدين، وبعّديها عن الدهون. للتنظيف استخدمي:</li>
                                    <li>منظف بالموجات أو بالبخار</li>
                                    <li>مذيبات خفيفة أو منظفات مجوهرات</li>
                                    @else
                                    <li>Always remove the diamond jewellery prior to washing hands and avoid contact with greasy substances. Use the following to clean the diamond jewellery</li>
                                    <li>Ultrasonic cleaner or steamer</li>
                                    <li>Mild solvents or jewellery cleansers</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed bg-white px-0 py-4 shadow-none text-uppercase fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree" style="font-size: 1.1rem;">
                                {{ app()->getLocale() === 'ar' ? 'الياقوت الأحمر والأزرق' : 'RUBIES & SAPPHIRES' }}
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-0">
                                <ul>
                                    @if(app()->getLocale() === 'ar')
                                    <li>الياقوت الأحمر والأزرق ينغسل بماء دافي وصابون وفرشاة ناعمة.</li>
                                    <li>اشطفيه بماء نظيف وامسحيه لين ينشف.</li>
                                    <li>الأفضل تتجنبين التنظيف الآلي.</li>
                                    @else
                                    <li>Rubies and Sapphire can be cleaned with warm soapy water and a gentle brush.</li>
                                    <li>Rinse under clean water and wipe until it becomes dry.</li>
                                    <li>It is recommended that mechanical cleansing be best if avoided.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed bg-white px-0 py-4 shadow-none text-uppercase fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                aria-controls="collapseFour" style="font-size: 1.1rem;">
                                {{ app()->getLocale() === 'ar' ? 'الزمرد' : 'EMERALDS' }}
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-0">
                                <ul>
                                    @if(app()->getLocale() === 'ar')
                                    <li>كوني أهدى مع قطع الزمرد.</li>
                                    <li>الزمرد ينغسل بماء دافي وصابون وفرشاة ناعمة.</li>
                                    <li>الأفضل تتجنبين المذيبات والتنظيف الآلي.</li>
                                    @else
                                    <li>Be more cautious with your emerald jewels.</li>
                                    <li>Emeralds can be cleaned with warm soapy water and a gentle brush.</li>
                                    <li>It is recommended that solvents and mechanical cleaning be best if avoided.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed bg-white px-0 py-4 shadow-none text-uppercase fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                                aria-controls="collapseFive" style="font-size: 1.1rem;">
                                {{ app()->getLocale() === 'ar' ? 'اللؤلؤ' : 'PEARLS' }}
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-0">
                                <ul>
                                    @if(app()->getLocale() === 'ar')
                                    <li>اللؤلؤ يحتاج عناية أكثر من الأحجار الكريستالية.</li>
                                    <li>نظّفي مجوهرات اللؤلؤ بقماش ناعم.</li>
                                    <li>اللؤلؤ يتأثر بالعطر ومستحضرات التجميل والعرق.</li>
                                    <li>بعّديه عن مثبت الشعر والكحول والمبيّض والأمونيا.</li>
                                    <li>لا تسبحين وأنتِ لابسة لؤلؤ.</li>
                                    <li>نفس الشي ينطبق على الأحجار العضوية الثانية.</li>
                                    @else
                                    <li>Pearls require more attention than crystalline gems.</li>
                                    <li>Clean pearl jewellery using a soft cloth.</li>
                                    <li>Pearls are susceptible to perfume, cosmetics and perspiration.</li>
                                    <li>Avoid contact with hairspray, alcohol, bleach and ammonia.</li>
                                    <li>Do not swim when wearing pearls.</li>
                                    <li>Applies to other organic gems.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed bg-white px-0 py-4 shadow-none text-uppercase fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                aria-controls="collapseSix" style="font-size: 1.1rem;">
                                {{ app()->getLocale() === 'ar' ? 'أحجار طبيعية ثانية' : 'OTHER NATURAL STONES' }}
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-0">
                                <ul>
                                    @if(app()->getLocale() === 'ar')
                                    <li>أأمن وأسهل طريقة لتنظيف الأحجار الطبيعية: ماء دافي، وكمية بسيطة من صابون خفيف بدون منظف قوي، وفرشاة ناعمة.</li>
                                    <li>افرشيها بهدوء، اشطفيها، وبعدين امسحيها بقماش ناعم.</li>
                                    <li>بعض الأحجار مثل الزبرجد والفيروز تحتاج معاملة ألطف: فرشاة ناعمة وماء دافي، أو قماش ناعم ورطب.</li>
                                    @else
                                    <li>The safest, easiest and most effective way to clean the natural gems is to use warm water, a small quantity of mild soap without detergent and a gentle brush.</li>
                                    <li>Carefully brush and rinse with water, then wipe with a gentle cloth.</li>
                                    <li>Some gems require gentle treatment such as Peridot and Turquoise should be cleaned with a soft brush and warm water or a soft and moist cloth.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
@endsection
