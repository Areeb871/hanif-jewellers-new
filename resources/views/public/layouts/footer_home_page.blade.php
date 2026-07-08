<!-- ===== CARTIER-LIKE FOOTER (Desktop unchanged, Mobile accordion) ===== -->
<style>
/* ===== CARTIER-LIKE FOOTER ===== */
.hj-footer{
  background:#e6ded3;
  color:white;
  padding: 60px 0 0;
}
footer h4 {
  font-size: 12px;
  font-weight: 500;
  text-transform: uppercase;
  line-height: 1;
  letter-spacing: 4px;
  margin-bottom: 27px !important;
  font-family: Lato, sans-serif;
  color:white;
}

.hj-footer .hj-divider{
  height: 1px;
  background: black;
  width: 70%;
  margin: 0 auto 45px;   /* ✅ centered */
}/* Mobile screens (small to large mobile) */
@media (max-width: 767.98px) {
    .hj-footer .hj-divider {
        width: 100%;
    }
}

.hj-footer .hj-container{
  max-width: 1320px;
  margin: 0 auto;
  padding-bottom:30px;
}

/* Newsletter block (top) */
.hj-footer .newsletter-wrap{
  max-width: 390px;
  margin: 0 auto 50px;
  text-align:center;
  padding-top: 30px;

}

.hj-footer .newsletter-wrap h4{
  font-family: "Montserrat", Almarai, Helvetica, Arial, sans-serif;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: .14em;
  text-transform: uppercase;
  margin: 0 0 22px;
  color:#000;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.hj-footer .newsletter-form{
  display:flex;
  align-items:center;
  border-bottom: 1px solid #d7d7d7;
}

.hj-footer .newsletter-form input{
  flex:1;
  border:0;
  outline:0;
  background:transparent;
  padding: 12px 4px;
  font-size: 14px;
  color:#000;
}

.hj-footer .newsletter-form input::placeholder{ color:#b5b5b5; }

.hj-footer .newsletter-form button{
  background:#000;
  color:#fff;
  border:0;
  padding: 12px 30px;
  font-size: 12px;
  letter-spacing: .10em;
  text-transform: uppercase;
  cursor:pointer;
}

/* Grid like Cartier (4 columns) */
.hj-footer .hj-grid{
  display:grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 80px;
  padding-bottom: 60px;
}

/* Column headings */
.hj-footer .hj-title{
  font-family: "Montserrat", Almarai, Helvetica, Arial, sans-serif;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: .14em;
  text-transform: uppercase;
  margin: 0 0 18px;
      color: black;

}

/* Links */
.hj-footer .hj-links{
  list-style:none;
  padding:0;
  margin:0;
}

.hj-footer .hj-links li{
  margin: 0 0 14px;
}

/* ===== CARTIER-LIKE HOVER LINE ===== */
.hj-footer .hj-links a{
  position: relative;
  display: inline-block;
  padding-bottom: 2px;
  transition: opacity .25s ease;
}

/* underline */
.hj-footer .hj-links a::after{
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  width: 100%;
  height: 1px;
  background: #000;

  transform: scaleX(0);
  transform-origin: left;
  transition: transform .28s ease;
}

/* hover effect */
.hj-footer .hj-links a:hover{
  opacity: 1;
}

.hj-footer .hj-links a:hover::after{
  transform: scaleX(1);
}
/* Follow us icons */
.hj-footer .hj-social{
  display:flex;
  gap: 18px;
  align-items:center;
  margin-top: 6px;
}

.hj-footer .hj-social a{
  color:black;
  font-size: 18px;
  opacity: .85;
  text-decoration:none;
}

.hj-footer .hj-social a:hover{ opacity:1; }

/* Bottom divider + copyright */
.hj-footer .hj-divider-bottom{
  height:1px;
  background:black;
  width:100%;
  margin: 0;
}

.hj-footer .hj-bottom{
  padding: 18px 0;
  text-align:center;
  font-family: "Montserrat", Almarai, Helvetica, Arial, sans-serif;
  font-size: 12px;
  letter-spacing: .06em;
  text-transform: uppercase;
  background-color:#3c230d;

}

/* Responsive (keep desktop same) */
@media (max-width: 1199px){
  .hj-footer .hj-container{ padding: 0 30px; }
  .hj-footer .hj-grid{ gap: 40px; }
}
@media (min-width: 1200px) and (max-width: 1500px) {
    .hj-footer .hj-grid {
        max-width: 1050px;
        margin: 0 auto; /* keep centered */
    }
}

@media (max-width: 992px){
  .hj-footer .hj-grid{ grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 576px){
  .hj-footer .hj-grid{ grid-template-columns: 1fr; }
  .hj-footer .newsletter-wrap{ 
          max-width: 100%; 
          padding-top: 7px;
  }
}

/* Hide accordion buttons on desktop */
@media (min-width: 577px){
  .hj-footer .hj-acc-btn{ display:none; }
}

/* ===========================
   MOBILE ACCORDION (ONLY)
   Smooth + dynamic height
   Desktop not disturbed
=========================== */
@media (max-width: 576px){

  .hj-footer .hj-grid{
    gap: 0;
    padding-bottom: 30px;
  }

  /* Hide desktop titles on mobile (only for accordion columns) */
  .hj-footer .hj-acc .hj-title{
    display:none;
  }

  /* Accordion button */
  .hj-footer .hj-acc-btn{
    width: 100%;
    background: transparent;
    border: 0;
    padding: 18px 0;
    text-align: left;

    font-family: "Montserrat", Almarai, Helvetica, Arial, sans-serif;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: .14em;
    text-transform: uppercase;
    display:flex;
    align-items:center;
    justify-content:space-between;
    cursor:pointer;
  }

  /* Chevron icon */
  .hj-footer .hj-acc-btn::after{
    content:"";
    width: 8px;
    height: 8px;
    border-right: 1.5px solid #000;
    border-bottom: 1.5px solid #000;
    transform: rotate(45deg);
    opacity: .7;
    transition: transform .2s ease, opacity .2s ease;
    margin-left: 10px;
    flex: 0 0 auto;
  }

  /* Divider between accordion sections */
  .hj-footer .hj-acc{
    border-bottom: 1px solid #e6e6e6;
  }

  /* Accordion panel (ul) */
  .hj-footer .hj-acc .hj-links{
    max-height: 0;
    overflow: hidden;
    transition: max-height .28s ease;
    margin: 0;
    padding: 0;
  }

  /* breathing room when open */
  .hj-footer .hj-acc.is-open .hj-links{
    padding-bottom: 12px;
  }

  .hj-footer .hj-acc.is-open .hj-acc-btn::after{
    transform: rotate(-135deg);
    opacity: 1;
  }

  /* ===== FOLLOW US CENTERED ON MOBILE ===== */
  .hj-footer .hj-follow{
    text-align: center;
    border-bottom: 1px solid #e6e6e6;
    padding: 22px 0;
  }
  .hj-footer .hj-follow .hj-title{
    margin: 0 0 14px;
    text-align:center;
  }
  .hj-footer .hj-follow .hj-social{
    justify-content: center;
    margin-top: 0;
    gap: 22px;
  }
   .hj-footer .hj-acc .hj-links{
    will-change: max-height;
  }
  .hj-footer .hj-acc{
    border-bottom: none;
  }

  /* Add line ONLY under LEGAL AREA (last accordion) */
  .hj-footer .hj-acc:last-of-type{
    border-bottom: 1px solid #e6e6e6;
  }

  /* No line under Follow Us */
  .hj-footer .hj-follow{
    border-bottom: none;
  }
}

</style>
<!-- ===== NEWSLETTER SECTION (SEPARATE) ===== -->

<footer class="hj-footer">
<!-- <section class="hj-newsletter-section">
  <div class="hj-divider"></div>

  <div class="hj-container">
    <div class="newsletter-wrap">
      <h4>SUBSCRIBE TO OUR NEWSLETTER</h4>
      <form class="newsletter-form">
        <input type="email" placeholder="Email" required>
        <button type="submit">SUBSCRIBE</button>
      </form>
    </div>
  </div>

</section>
  <div class="hj-divider"></div> -->


  <div class="hj-divider"></div>

  <!-- Footer Grid -->
  <div class="hj-container">
    <div class="hj-grid">

      <!-- CUSTOMER CARE (Accordion on mobile) -->
      <div class="hj-acc">
        <h4 class="hj-title">CUSTOMER CARE</h4>
        <button class="hj-acc-btn" type="button" aria-expanded="false">CUSTOMER CARE</button>
        <ul class="hj-links">
          <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
          <li><a href="{{ url('locator') }}">Stores</a></li>
          <li><a href="{{ url('after-sale-services') }}">After Sale Services</a></li>
          <li><a href="{{ url('care-instructions') }}">Care Instructions</a></li>
        </ul>
      </div>

      <!-- OUR COMPANY (Accordion on mobile) -->
      <div class="hj-acc">
        <h4 class="hj-title">OUR COMPANY</h4>
        <button class="hj-acc-btn" type="button" aria-expanded="false">OUR COMPANY</button>
        <ul class="hj-links">
          <li><a href="{{ url('locator') }}">Find a Boutique ↗</a></li>
          <li><a href="{{ url('about-us') }}">About Us</a></li>
          <li><a href="{{ url('assurance') }}">Assurance</a></li>
        </ul>
      </div>

      <!-- LEGAL AREA (Accordion on mobile) -->
      <div class="hj-acc">
        <h4 class="hj-title">LEGAL AREA</h4>
        <button class="hj-acc-btn" type="button" aria-expanded="false">LEGAL AREA</button>
        <ul class="hj-links">
          <li><a href="{{ route('terms-of-service') }}">Terms of Service</a></li>
          <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
          <li><a href="{{ route('shipping-policy') }}">Shipping Policy</a></li>
          <li><a href="{{ route('refund-policy') }}">Refund Policy</a></li>
        </ul>
      </div>

      <!-- FOLLOW US (Centered on mobile) -->
      <div class="hj-follow">
        <h4 class="hj-title">FOLLOW US</h4>
        <div class="hj-social">
          <a target="_blank" rel="noopener" href="https://www.instagram.com/hanifjewellers" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a target="_blank" rel="noopener" href="https://www.facebook.com/ExperiencePureArt/" aria-label="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a target="_blank" rel="noopener" href="https://www.youtube.com/channel/UCKvZhJlCD4G9Zq-mE4X1ERw" aria-label="YouTube">
            <i class="fa-brands fa-youtube"></i>
          </a>
          <a target="_blank" rel="noopener" href="https://www.linkedin.com/company/hanifjewellers/" aria-label="LinkedIn">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
          <a target="_blank" rel="noopener" href="https://www.tiktok.com/discover/hanif-jewellers?is_from_webapp=1&sender_device=pc" aria-label="TikTok">
            <i class="fa-brands fa-tiktok"></i>
          </a>
        </div>
      </div>

    </div>
  </div>

  <div class="hj-divider-bottom"></div>

  <div class="hj-bottom">
    © <?= date("Y"); ?> Hanif | All rights reserved.
  </div>
</footer>

<!-- Accordion JS (Mobile only, 1 open at a time, smooth height) -->
<script>
(function () {

  function isMobile() {
    return window.matchMedia("(max-width: 576px)").matches;
  }

  function closeAll(cols) {
    cols.forEach(function (c) {
      var u = c.querySelector(".hj-links");
      var b = c.querySelector(".hj-acc-btn");
      c.classList.remove("is-open");
      if (u) u.style.maxHeight = "0px";
      if (b) b.setAttribute("aria-expanded", "false");
    });
  }

  function openCol(col) {
    var ul  = col.querySelector(".hj-links");
    var btn = col.querySelector(".hj-acc-btn");
    if (!ul || !btn) return;

    col.classList.add("is-open");
    btn.setAttribute("aria-expanded", "true");

    // iOS/Safari fix: force reflow, then set height next frame
    ul.style.maxHeight = "0px";
    ul.offsetHeight; // reflow
    requestAnimationFrame(function () {
      ul.style.maxHeight = ul.scrollHeight + "px";
    });
  }

  function refreshOpenHeight() {
    if (!isMobile()) return;
    var openColEl = document.querySelector(".hj-footer .hj-acc.is-open");
    if (!openColEl) return;

    var openUl = openColEl.querySelector(".hj-links");
    if (!openUl) return;

    // recalc height after font/viewport changes
    openUl.style.maxHeight = "none";
    openUl.offsetHeight;
    openUl.style.maxHeight = openUl.scrollHeight + "px";
  }

  function initAccordion() {
    var cols = document.querySelectorAll(".hj-footer .hj-acc");
    if (!cols.length) return;

    cols.forEach(function (col) {
      var btn = col.querySelector(".hj-acc-btn");
      var ul  = col.querySelector(".hj-links");
      if (!btn || !ul) return;

      // prevent double event binding
      if (btn.dataset.hjBound === "1") return;
      btn.dataset.hjBound = "1";

      // always start closed (mobile only)
      if (isMobile()) {
        col.classList.remove("is-open");
        ul.style.maxHeight = "0px";
        btn.setAttribute("aria-expanded", "false");
      } else {
        // desktop: remove inline height so it doesn't affect layout
        ul.style.maxHeight = "";
        btn.setAttribute("aria-expanded", "false");
      }

      btn.addEventListener("click", function () {
        if (!isMobile()) return;

        var wasOpen = col.classList.contains("is-open");
        closeAll(cols);

        if (!wasOpen) openCol(col);
      });
    });

    // Safari bfcache + fonts load issues
    window.addEventListener("pageshow", function () {
      setTimeout(refreshOpenHeight, 60);
    });

    window.addEventListener("load", function () {
      setTimeout(refreshOpenHeight, 60);
    });

    window.addEventListener("resize", function () {
      // if user crosses breakpoint, clean inline styles
      if (!isMobile()) {
        cols.forEach(function (c) {
          var u = c.querySelector(".hj-links");
          if (u) u.style.maxHeight = "";
          c.classList.remove("is-open");
        });
      } else {
        refreshOpenHeight();
      }
    });

    window.addEventListener("orientationchange", function () {
      setTimeout(refreshOpenHeight, 120);
    });
  }

  document.addEventListener("DOMContentLoaded", initAccordion);

})();
</script>
<!-- <a href="javascript:void(0)" class="hanif-whatsapp-btn" id="openHanifPopup" aria-label="Open Contact Popup">
  
    <span class="hanif-close-btn" id="hideHanifBtn">×</span>
     <svg class="hanif-bubble-shape" viewBox="0 0 64 64" aria-hidden="true">
        <path d="M32 6
                 C18.2 6 7 16.6 7 29.8
                 C7 37.1 10.4 43.6 16.2 47.8
                 L13.4 57
                 L22.9 52.1
                 C25.8 53.1 28.8 53.6 32 53.6
                 C45.8 53.6 57 43 57 29.8
                 C57 16.6 45.8 6 32 6 Z"
              fill="transparent"
              stroke="#000"
              stroke-width="1"
              stroke-linejoin="round"
              stroke-linecap="round"/>
    </svg>


    <img src="{{ asset('assets/f_assets/image/emb1.png') }}" alt="HANIF Logo" class="hanif-inner-logo">
</a> -->

<style>
.hanif-close-btn{
    position:absolute;
    top:-8px;
    right:-4px;
    width:24px;
    height:24px;
    background:#fff;
    border:1px solid #ccc;
    border-radius:50%;
    font-size:18px;
    line-height:22px;
    text-align:center;
    color:#333;
    font-weight:bold;
    cursor:pointer;
    z-index:10;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);

    /* hidden by default */
    opacity:0;
    visibility:hidden;
    pointer-events:none;
    transition:0.25s ease;
}

/* desktop hover */
.hanif-whatsapp-btn:hover .hanif-close-btn{
    opacity:1;
    visibility:visible;
    pointer-events:auto;
}

/* mobile + tablet first tap / touch shows cross */
.hanif-whatsapp-btn.show-close .hanif-close-btn{
    opacity:1;
    visibility:visible;
    pointer-events:auto;
}
.hanif-whatsapp-btn{
    position: fixed;
    right: 20px;
    bottom: 20px;
    width: 64px;
    height: 64px;
    display: block;
    text-decoration: none;
    z-index: 9999;
    transition: transform .25s ease;
    color: #3c230d;
    fill: #3c230d;
}

.hanif-whatsapp-btn:hover{
    transform: translateY(-3px) scale(1.03);
}

.hanif-bubble-shape{
    position: absolute;
    inset: 0;
    width: 70px;
    height: 70px;
    display: block;
}

.hanif-inner-logo{
    position: absolute;
    top: 51%;
    left: 56%;
    transform: translate(-50%, -50%);
    width: 33px;
    height: 33px;
    object-fit: contain;
    z-index: 2;
    display: block;
    
}
.hanif-bubble-shape path{
    fill:  #3c230d !important;
    stroke: white;
    stroke-width: 1;
}

/* CENTER LOGO (image) */
.header-logo{
  justify-self: center;
  display: inline-flex;
  align-items: center;
  text-decoration: none;
  line-height: 1;
}
.header-logo-img-new{
  display:block;
  height: 33px;   /* adjust 44–60 */
  width: auto;
  object-fit: contain;
}
</style>


<!-- OVERLAY -->
<div class="hanif-popup-overlay" id="hanifPopupOverlay"></div>

<!-- POPUP -->
<div class="hanif-contact-popup" id="hanifContactPopup">
    <div class="hanif-popup-header">
        <div class="hanif-popup-brand">
            <a href="/" class="header-logo" aria-label="Hanif Jewellers Home">
        <img
          src="{{ asset('assets/f_assets/image/HanifLogoBlack.png') }}"
          alt="Hanif Jewellers"
          class="header-logo-img-new"
          width="200"
          height="60"
          loading="eager"
        >
      </a>
        </div>

        <button class="hanif-popup-toggle" id="closeHanifPopup" aria-label="Close popup">
            <svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true">
                <path d="M6 9l6 6 6-6" fill="none" stroke="#111" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <div class="hanif-popup-body">
        <p class="hanif-popup-text hanif-popup-subtext">
          Please select one of the below options to connect with us.
        </p>

        <div class="hanif-popup-actions">
            <a href="mailto:info@hanifjewellers.com" class="hanif-action-btn">
                <span class="hanif-action-icon">
                    <svg viewBox="0 0 24 24" width="30" height="30" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2.4" fill="none" stroke="#fdfdfd" stroke-width="1.8"/>
                        <path d="M4.5 7L12 13l7.5-6" fill="none" stroke="#fdfdfd" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="hanif-action-label">Email us</span>
            </a>

           <a href="javascript:void(0);" onclick="openWhatsapp()" class="hanif-action-btn">
    
    <span class="hanif-action-icon">
        <svg viewBox="0 0 24 24" width="30" height="30" aria-hidden="true">
            <rect x="4" y="6" width="16" height="14" rx="2.5" fill="none" stroke="#fdfdfd" stroke-width="1.8"/>
            <path d="M8 4.5v3M16 4.5v3M4 9.5h16" fill="none" stroke="#fdfdfd" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M9 14l2 2 4-4" fill="white" stroke="#fdfdfd" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>

    <span class="hanif-action-label">
        Book an appointment
    </span>

</a>

            <a href="/pages/locator" class="hanif-action-btn">
                <span class="hanif-action-icon">
                    <svg viewBox="0 0 24 24" width="30" height="30" aria-hidden="true">
                        <path d="M12 21s6-5.3 6-10a6 6 0 10-12 0c0 4.7 6 10 6 10z" fill="none" stroke="#fdfdfd" stroke-width="1.8"/>
                        <circle cx="12" cy="11" r="2.2" fill="white" stroke="#fdfdfd" stroke-width="1.8"/>
                    </svg>
                </span>
                <span class="hanif-action-label">Find a boutique</span>
            </a>

            <a href="/track-order" class="hanif-action-btn">
                <span class="hanif-action-icon">
                    <svg viewBox="0 0 24 24" width="30" height="30" aria-hidden="true">
                        <path d="M7 8h10l1.3 10H5.7L7 8z" fill="none" stroke="#fdfdfd" stroke-width="1.8"/>
                        <path d="M9 9V7a3 3 0 016 0v2" fill="white" stroke="#fdfdfd" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="hanif-action-label">Track your order</span>
            </a>

            <a href="/service-request" class="hanif-action-btn hanif-action-btn-wide">
                <span class="hanif-action-icon">
                    <svg viewBox="0 0 24 24" width="30" height="30" aria-hidden="true">
                        <path d="M3.5 15.5h4l2.5-2.2a2.3 2.3 0 011.5-.6h2.3a1.7 1.7 0 010 3.4H11" fill="none" stroke="#fdfdfd" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.5 14.2l2.8-2.4a2 2 0 012.7 3l-4.3 4A3.5 3.5 0 0113.3 20H7.5" fill="none" stroke="#fdfdfd" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="2.5" y="14" width="3" height="5.5" rx="1" fill="white" stroke="#fdfdfd" stroke-width="1.8"/>
                    </svg>
                </span>
                <span class="hanif-action-label">Request or track a service</span>
            </a>
        </div>

        <p class="hanif-popup-footer">
            For more information on how to Contact Us, <a href="/pages/contact-us">click here</a>.
        </p>
    </div>
</div>

<style>
.hanif-popup-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.12);
    opacity:0;
    visibility:hidden;
    transition:.3s ease;
    z-index:9999;
}

.hanif-contact-popup{
    position:fixed;
    right:28px;
    bottom:92px;
    width:330px;
    max-width:calc(100vw - 24px);
    background:#ffffff;
    border-radius:18px;
    box-shadow:0 8px 26px rgba(0,0,0,0.14);
    border:1px solid #eaeaea;
    overflow:hidden;
    opacity:0;
    visibility:hidden;
    transform:translateY(18px);
    transition:.35s ease;
    z-index:10000;
    font-family: "Avenir Next", Avenir, "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.hanif-contact-popup.active,
.hanif-popup-overlay.active{
    opacity:1;
    visibility:visible;
}
.hanif-contact-popup.active{
    transform:translateY(0);
}

.hanif-popup-header{
    position:relative;
    padding:18px 26px 14px;
    border-bottom:1px solid #ececec;
    background:#fff;
}

.hanif-popup-brand{
    text-align:center;
    font-family:"Times New Roman", Georgia, serif;
    font-style:italic;
    font-size:48px;
    line-height:1;
    color:#111;
    letter-spacing:.2px;
}

.hanif-popup-toggle{
    position:absolute;
    top:18px;
    right:18px;
    width:32px;
    height:32px;
    border:none;
    background:transparent;
    padding:0;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
}

.hanif-popup-body{
    max-height:72vh;
    overflow-y:auto;
    padding:18px 24px 24px;
}

.hanif-popup-body::-webkit-scrollbar{
    width:7px;
}
.hanif-popup-body::-webkit-scrollbar-thumb{
    background:#9d9d9d;
    border-radius:10px;
}
.hanif-popup-body::-webkit-scrollbar-track{
    background:#f1f1f1;
}

.hanif-popup-text{
    margin:0 0 18px 0;
    font-size:14px;
    line-height:1.42;
    color:#4a4a4a;
    font-weight:400;
}
.hanif-popup-text a{
    color:#4a4a4a;
    text-decoration:underline;
}
.hanif-popup-subtext{
    margin-bottom:18px;
}

.hanif-popup-actions{
    padding-top:2px;
}
.hanif-action-btn{
    width: fit-content;

    margin: 0 0 8px auto;   /* PUSH TO RIGHT */

    background: #efefef;
    border-radius: 20px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding:4px 18px 4px 18px;
    text-decoration: none;
    box-sizing: border-box;

    white-space: nowrap;
}

.hanif-action-btn-wide{
    width: fit-content;
}

.hanif-action-btn:hover{
    background:#e8e8e8;
}


.hanif-feedback-btn{
    width:43%;
    justify-content:center;
    padding-left:0;
    padding-right:0;
    margin-right:18px;
}

.hanif-action-icon{
    width:34px;
    min-width:34px;
    height:34px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-right:0px;
    opacity:.95;
}

.hanif-action-label{
    font-size:14px;
    line-height:1.2;
    color:#5f5f5f;
    font-weight:500;
    letter-spacing:.1px;
    white-space: nowrap;
}

.hanif-popup-footer{
    margin:18px 0 0;
    text-align:center;
    font-size:12px;
    line-height:1.45;
    color:#4a4a4a;
    white-space: nowrap;
}
.hanif-popup-footer a{
    color:#4a4a4a;
    text-decoration:underline;
}

    @media (max-width:767px){

    .hanif-contact-popup{
        right:10px;
        left:10px;
        bottom:140px;
        max-width:none;
        border-radius:16px;
    }

    .hanif-popup-brand{
        font-size:42px;
    }

    .hanif-popup-body{
        padding:16px 16px 20px;
        max-height:70vh;
    }

    /* RIGHT SIDE AUTO WIDTH BUTTONS */
    .hanif-action-btn{
        width:fit-content;
        min-height:54px;

        margin:0 0 8px auto;   /* right aligned */

        padding:0 18px 0 15px;

        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:6px;

        white-space:nowrap;
    }

    .hanif-action-btn-wide{
        width:fit-content;
    }

    .hanif-feedback-btn{
        width:fit-content;
        margin:0 10px 12px auto;
    }

    .hanif-action-label{
        font-size:14px;
    }
    .hanif-whatsapp-btn{
    position: fixed;
    right: 20px;
    bottom: 60px;
    width: 64px;
    height: 64px;
    display: block;
    text-decoration: none;
    z-index: 9999;
    transition: transform .25s ease;
       color: #3c230d;
    fill: #3c230d;
}
}
.hanif-chat-ended-screen{
    display:none;
    text-align:center;
    padding:4px 6px 20px !important;   /* bottom space after Back */
    padding-top:0 !important;
    margin-top:-21px !important;

}
/* paragraph top gap less */
.hanif-chat-ended-screen .hanif-popup-text:first-of-type{
    margin-top:0 !important;
    padding-top:0 !important;
}

.hanif-chat-ended-screen.active{
    display:block;
}

.hanif-chat-ended-time{
    margin:6px 0 10px 0 !important;
    text-align:left;
    font-size:13px;
    color:#b0a59a;
}

.hanif-chat-ended-bubble{
      display:flex !important;
    width:fit-content;
    max-width:78%;
    margin:0 0 0 auto !important;   /* push fully right */
    min-height:42px;
    padding:0 18px;
    border-radius:22px;
    background:#efefef;
    align-items:center;
    justify-content:center;
}

.hanif-chat-ended-bubble-time{
    text-align:right;
    font-size:13px;
    color:#b0a59a;
    margin:8px 0 34px 0;
}

.hanif-chat-ended-title{
    font-size:18px;
    line-height:1.4;
    color:#5a534d;
    font-weight:600;
    margin:0 0 22px 0;
}

.hanif-chat-ended-back{
    min-width:84px;
    height:46px;
    padding:0 24px;
    border:none;
    border-radius:22px;
    background:#efefef;
    color:#111;
    font-size:16px;
    cursor:pointer;
}

.hanif-chat-ended-back:hover{
    background:#e7e7e7;
}
/* make sure text shows inside ended screen */
.hanif-chat-ended-screen .hanif-popup-text,
.hanif-chat-ended-screen .hanif-popup-subtext{
    display:block !important;
    visibility:visible !important;
    opacity:1 !important;
    margin:0 0 16px 0;
    font-size:14px;
    line-height:1.45;
    color:#4a4a4a;
    text-align:left;
}

.hanif-chat-ended-screen .hanif-popup-text a{
    color:#4a4a4a;
    text-decoration:underline;
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const openBtn = document.getElementById("openHanifPopup");
    const closeBtn = document.getElementById("closeHanifPopup");
    const popup = document.getElementById("hanifContactPopup");
    const overlay = document.getElementById("hanifPopupOverlay");

    const actionButtons = document.querySelectorAll(".hanif-action-btn");
    const actionsWrap = document.querySelector(".hanif-popup-actions");
    const footer = document.querySelector(".hanif-popup-footer");
    const topText = document.querySelectorAll(".hanif-popup-text");

    function openPopup() {
        if (popup) popup.classList.add("active");
        if (overlay) overlay.classList.add("active");
        document.body.style.overflow = "hidden";
        resetChatScreen();
    }

    function closePopup() {
        if (popup) popup.classList.remove("active");
        if (overlay) overlay.classList.remove("active");
        document.body.style.overflow = "";
        resetChatScreen();
    }

    if (openBtn) {
        openBtn.addEventListener("click", function(e) {
            e.preventDefault();
            openPopup();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener("click", function() {
            closePopup();
        });
    }

    if (overlay) {
        overlay.addEventListener("click", function() {
            closePopup();
        });
    }

    actionButtons.forEach(function(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();

            const url = btn.getAttribute("href");
            const label = btn.querySelector(".hanif-action-label");
            const text = label ? label.textContent.trim() : "Selected";

            if (url && url !== "#") {
                window.open(url, "_blank");
            }

            setTimeout(function() {
                showEndedScreen(text);
            }, 150);
        });
    });

    if (backBtn) {
        backBtn.addEventListener("click", function() {
            resetChatScreen();
        });
    }

    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape") {
            closePopup();
        }
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const closeBtn = document.getElementById("hideHanifBtn");
    const floatingBtn = document.getElementById("openHanifPopup");

    if (!closeBtn || !floatingBtn) return;

    /* mobile/tablet: first tap shows X */
    floatingBtn.addEventListener("touchstart", function(e){
        if (!floatingBtn.classList.contains("show-close")) {
            e.preventDefault();
            floatingBtn.classList.add("show-close");
        }
    }, { passive: false });

    /* click X = hide whole button */
    closeBtn.addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        floatingBtn.style.display = "none";
    });

    /* click outside = hide X again */
    document.addEventListener("click", function(e){
        if (!floatingBtn.contains(e.target)) {
            floatingBtn.classList.remove("show-close");
        }
    });

    document.addEventListener("touchstart", function(e){
        if (!floatingBtn.contains(e.target)) {
            floatingBtn.classList.remove("show-close");
        }
    });
});
</script>
<script>
function openWhatsapp() {

    const phoneNumber = "923070222666";

    const message = "Hi, I'd like to connect with a sales expert about Book an Appointment.";

    const whatsappUrl =
        "https://api.whatsapp.com/send?phone=" +
        phoneNumber +
        "&text=" +
        encodeURIComponent(message);

    window.open(whatsappUrl, "_blank");
}
</script>