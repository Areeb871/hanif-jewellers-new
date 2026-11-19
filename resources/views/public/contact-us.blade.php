@extends('public.layouts.header_new')

@section('content')
       <section>
        <div class="container py-5">
            <div class="contactInfo text-center">
                <h2 class="titleLarge title py-3">{{ __('site.contact_us') }}</h2>
                <p class="mb-5">{{ __('site.contact_intro') }}</p>
                <a href="tel:+{{ $appointmentWhatsappPhone }}" class="contactP" dir="ltr" style="unicode-bidi: isolate; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa fa-phone"></i>
                    <span dir="ltr" style="unicode-bidi: isolate; direction: ltr;">{{ $appointmentPhoneDisplay }}</span>
                </a>
                <br><br>
                <p class="pt-3">{{ __('site.contact_mail') }}</p>

                <a class="contactP" href="mailto:info@hanifjewellers.com">
                    <i class="fa fa-envelope"></i> info@hanifjewellers.com
                </a>
            </div>
        </div>
    </section>
@endsection
