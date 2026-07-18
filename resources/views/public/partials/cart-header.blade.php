@php
    $sessionId    = session()->getId();
    $sessionToken = session()->token();

    if(auth()->check()){
        $cartCount = (int) \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
    } else {
        $cartCount = (int) \App\Models\Cart::where(function($q) use ($sessionId, $sessionToken){
            $q->where('session_id', $sessionId)
              ->orWhere('session_id', $sessionToken);
        })->sum('quantity');
    }
@endphp
<style>
/* ================================
   CART BADGE (FORCE FILLED RED)
==================================*/

#cartHeader a,
#cartHeader .cart-link{
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

/* Force badge background even if you have "a * { background: transparent !important; }" */
#cartHeader .cart-count{
  position: absolute;
  top: -8px;
  right: -10px;

  min-width: 18px;
  height: 18px;
  padding: 0 6px;              /* allows 20+ */

  background: #C00000 !important;   /* ✅ FORCE red fill */
  color: #fff !important;           /* ✅ FORCE white text */

  border: 0 !important;             /* ✅ no ring */
  border-radius: 999px;             /* ✅ circle for 1 digit, pill for 20+ */

  display: inline-flex;
  align-items: center;
  justify-content: center;

  font-size: 11px;
  font-weight: 800;
  line-height: 1;

  box-shadow: 0 4px 10px rgba(0,0,0,.18);
  z-index: 999999;

  pointer-events: none;
}

/* If empty or 0, hide */
#cartHeader .cart-count:empty{ display:none; }
#cartHeader .cart-count.is-zero{ display:none !important; }
</style>
<a href="{{ route('cart') }}" class="cart-link" aria-label="Cart">
    {{-- <i class="fa-solid fa-cart-shopping"></i> --}}

    @if($cartCount > 0)
    {{-- <span class="cart-count">
        {{ $cartCount }}
    </span> --}}
    @endif
</a>
