@extends('public.layouts.headerContact')

@section('content')
<div class="container" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: inline-block; padding: 40px 60px; margin-top: 10%;">
    <h1 style="font-size: 2.5em; margin-bottom: 16px;">Category Not Available</h1>
    <p style="font-size: 1.2em; margin-bottom: 24px;">Sorry, the category you are looking for is currently not available.</p>
    <a href="{{ url('/') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">Return to Home</a>
</div>
@endsection
