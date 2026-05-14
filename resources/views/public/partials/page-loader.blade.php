{{-- Page Loader Partial --}}
<div id="pageLoader" class="page-loader">
    <div class="loader-container">
        <div class="loader-logo">
            <img src="{{ asset('assets/f_assets/image/HanifLogoLoadingAnimation.gif') }}" alt="Hanif Jewellers" class="loader-logo-img" preload="auto">
        </div>
    </div>
</div>

<style>
/* Page Loader Styles */
.page-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 99999;
    opacity: 0.5;
    visibility: visible;
    transition: opacity 0.5s ease, visibility 0.5s ease;
}

.page-loader.hidden {
    opacity: 0;
    visibility: hidden;
}

.loader-container {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.loader-logo {
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader-logo-img {
    width: 100px;
    height: auto;
    opacity: 1;
}

/* Animations */
@keyframes logoFadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .loader-logo-img {
        width: 70px;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .page-loader {
        background: #ffffff; /* Keep white background even in dark mode */
    }
}
</style>

<script>
// Page Loader JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const pageLoader = document.getElementById('pageLoader');
    let pageLoaded = false;
    let minTimeElapsed = false;
    
    // Hide loader when both conditions are met
    function hideLoader() {
        if (pageLoader && pageLoaded && minTimeElapsed) {
            pageLoader.classList.add('hidden');
            // Remove loader from DOM after animation completes
            setTimeout(() => {
                if (pageLoader.parentNode) {
                    pageLoader.parentNode.removeChild(pageLoader);
                }
            }, 500);
        }
    }
    
    // Check if page is fully loaded
    function checkPageLoaded() {
        pageLoaded = true;
        hideLoader();
    }
    
    // Set minimum time elapsed flag
    setTimeout(() => {
        minTimeElapsed = true;
        hideLoader();
    }, 2700); // Minimum 2.7 seconds
    
    // Hide loader when page is fully loaded
    if (document.readyState === 'complete') {
        checkPageLoaded();
    } else {
        window.addEventListener('load', checkPageLoaded);
    }
    
    // Fallback: Hide loader after 5 seconds maximum (increased from 3s)
    setTimeout(() => {
        pageLoaded = true;
        minTimeElapsed = true;
        hideLoader();
    }, 5500);
    
    // Hide loader on user interaction (optional) - but still respect minimum time
    document.addEventListener('click', () => {
        pageLoaded = true;
        hideLoader();
    }, { once: true });
    document.addEventListener('keydown', () => {
        pageLoaded = true;
        hideLoader();
    }, { once: true });
});
</script>
