@extends('public.layouts.header_latest')

@section('content')
<section class="py-5">
    <div class="container">
        {!! optional($page)->description !!}
    </div>
</section>
@endsection

