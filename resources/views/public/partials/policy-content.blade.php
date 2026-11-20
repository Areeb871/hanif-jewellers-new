<section class="py-5">
    <div class="container" @if(app()->getLocale() === 'ar') dir="rtl" lang="ar" @endif>
        {!! optional($page)->displayDescription() !!}
    </div>
</section>
