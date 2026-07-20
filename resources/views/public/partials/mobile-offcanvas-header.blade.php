<div class="mobile-offcanvas-header">
    <div class="close-section">
        @if(isset($showClose) && $showClose)
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        @endif
    </div>
    <div class="logo-section">
        <img src="{{ asset('assets/f_assets/image/HanifLogoBlack.png') }}" alt="Hanif Jewellers" class="mobile-logo">
    </div>
    <div class="action-section">
        <a href="/cart" class="mobile-nav-icon position-relative">
            {{-- <i class="fa-solid fa-cart-shopping"></i> --}}
            @php
                $cartCount = 0;
                if (Auth::check()) {
                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                } else {
                    $cartCount = \App\Models\Cart::where('session_id', session()->getId())->sum('quantity');
                }
            @endphp
            @if($cartCount > 0)
                {{-- <span class="mobile-cart-badge">{{ $cartCount }}</span> --}}
            @endif
        </a>
    </div>
</div> 
