@extends('public.layouts.header_latest')

@section('content')
    <!-- Google Fonts: Cinzel -->
    <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700&display=swap" rel="stylesheet">
    <section class="aboutSection p-5">

    </section>

    <section class="">
        @php $isAr = app()->getLocale() === 'ar'; @endphp
        <div class="container py-5 text-center"
            style="font-family: {{ $isAr ? 'Cairo, sans-serif' : "'Cinzel', serif" }}; font-weight: 300; font-size: 20px; text-transform: {{ $isAr ? 'none' : 'uppercase' }}; line-height: 1.8; margin-top:50px;">
            @if($isAr)
            <p>حنيف يعني إيمان صادق بالأصالة، وإرث راقي من سنة ١٩٧٨.</p>
            <p>التزام ثابت بالجودة، وعلاقات تبقى.</p>
            <p>دار عائلية من بيت حنيف، على ثلاث أجيال، تصنع وتنتقي المجوهرات والساعات الفاخرة، ويثق فيها ملايين العملاء.</p>
            <p>تجربة حقيقية للفن الخالص، ولمجوهرات تُصنع حسب الطلب.</p>
            @else
            <p>
            <span style="font-size: 23px">H</span>ANIF means A <span style="font-size: 23px">T</span>rue <span style="font-size: 23px">B</span>elief in <span style="font-size: 23px">O</span>riginality and a<br>
            <span style="font-size: 23px">H</span>ERITAGE <span style="font-size: 23px">P</span>AR <span style="font-size: 23px">E</span>XCELLENCE <span style="font-size: 23px">S</span>INCE 1978.
            </p>
            <p>
            <span style="font-size: 23px">T</span>HE UNWAVERING DEDICATION TO QUALITY <span style="font-size: 23px">&amp;</span> BUILDING RELATIONS THAT LAST FOREVER.
            </p>
            <p>
            <span style="font-size: 23px">A</span> <span style="font-size: 23px">F</span>AMILY-OWNED BUSINESS FROM THE <span style="font-size: 23px">H</span>OUSE OF <span style="font-size: 23px">H</span>ANIF SPANNING THREE GENERATIONS<br>
            OF CREATING <span style="font-size: 23px">&amp;</span> CURATING <span style="font-size: 23px">J</span>EWELLERY <span style="font-size: 23px">&amp;</span> <span style="font-size: 23px">L</span>UXURY TIMEPIECES TRUSTED BY MILLIONS OF<br>
            SATISFIED CUSTOMERS.
            </p>
            <p>
            <span style="font-size: 23px">A</span> TRUE EXPERIENCE OF PURE ART <span style="font-size: 23px">&amp;</span> BESPOKE<br> HANDCRAFTED
            LUXURY.
            </p>
            @endif
            <div style="width: 25%; border-bottom: 2px solid #000; margin: 30px auto 0 auto;"></div>
        </div>
    </section>
@endsection
