<!-- ===== CARTIER-LIKE FOOTER (Desktop unchanged, Mobile accordion) ===== -->
<style>
/* ===== CARTIER-LIKE FOOTER ===== */
.hj-footer{
  background:#fff;
  color:#000;
  padding: 60px 0 0;
}

.hj-footer .hj-divider{
  height: 1px;
  background: #e6e6e6;
  width: 70%;
  margin: 0 auto 45px;   /* ✅ centered */
}
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
  color:#000;
  font-size: 18px;
  opacity: .85;
  text-decoration:none;
}

.hj-footer .hj-social a:hover{ opacity:1; }

/* Bottom divider + copyright */
.hj-footer .hj-divider-bottom{
  height:1px;
  background:#e6e6e6;
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
  opacity: .75;
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
    color:#000;

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
<!--<section class="hj-newsletter-section">-->
<!--  <div class="hj-divider"></div>-->

<!--  <div class="hj-container">-->
<!--    <div class="newsletter-wrap">-->
<!--      <h4>SUBSCRIBE TO OUR NEWSLETTER</h4>-->
<!--      <form class="newsletter-form">-->
<!--        <input type="email" placeholder="Email" required>-->
<!--        <button type="submit">SUBSCRIBE</button>-->
<!--      </form>-->
<!--    </div>-->
<!--  </div>-->

<!--</section>-->
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
          <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
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

