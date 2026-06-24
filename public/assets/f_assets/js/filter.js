document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const $ = (selector, parent = document) => parent.querySelector(selector);
    const $all = (selector, parent = document) => Array.from(parent.querySelectorAll(selector));

    function formatPKR(value) {
        value = Number(value || 0);

        return "PKR " + value.toLocaleString(undefined, {
            maximumFractionDigits: 0
        });
    }

    function reloadWithParams(params) {
        params.delete("page");

        const query = params.toString();
        window.location.href = window.location.pathname + (query ? "?" + query : "");
    }

    function setQueryParam(key, value) {
        const params = new URLSearchParams(window.location.search);

        if (value !== null && value !== undefined && value !== "") {
            params.set(key, value);
        } else {
            params.delete(key);
        }

        reloadWithParams(params);
    }

    /* ===============================
       DESKTOP FILTER PANELS
    =============================== */

    function closeDesktopPanels() {
        [
            ["#shapeFilterBtn", "#shapesPanel"],
            ["#materialFilterBtn", "#materialPanel"],
            ["#priceFilterBtn", "#pricePanel"]
        ].forEach(function (item) {
            const btn = $(item[0]);
            const panel = $(item[1]);

            if (btn) btn.classList.remove("active");
            if (panel) panel.classList.remove("show");
        });
    }

    [
        ["#shapeFilterBtn", "#shapesPanel"],
        ["#materialFilterBtn", "#materialPanel"],
        ["#priceFilterBtn", "#pricePanel"]
    ].forEach(function (item) {
        const btn = $(item[0]);
        const panel = $(item[1]);

        if (!btn || !panel) return;

        btn.addEventListener("click", function (event) {
            event.stopPropagation();

            const isOpen = panel.classList.contains("show");

            closeDesktopPanels();

            if (!isOpen) {
                btn.classList.add("active");
                panel.classList.add("show");
            }
        });
    });

    document.addEventListener("click", function (event) {
        const filterSection = $(".hj-filter-section");

        if (filterSection && !filterSection.contains(event.target)) {
            closeDesktopPanels();
        }
    });

    /* ===============================
       DESKTOP SHAPE FILTER
    =============================== */

    $all("[data-filter-shape]").forEach(function (button) {
        button.addEventListener("click", function () {
            setQueryParam("shape", this.dataset.filterShape);
        });
    });

    /* ===============================
       DESKTOP METAL FILTER
    =============================== */

    $all("[data-filter-metal]").forEach(function (button) {
        button.addEventListener("click", function () {
            setQueryParam("metal", this.dataset.filterMetal);
        });
    });

    /* ===============================
       CLEAR FILTERS
    =============================== */

    $all("[data-clear-filter]").forEach(function (button) {
        button.addEventListener("click", function () {
            const params = new URLSearchParams(window.location.search);
            const type = this.dataset.clearFilter;

            if (type === "shape") {
                params.delete("shape");
            }

            if (type === "metal") {
                params.delete("metal");
            }

            if (type === "price") {
                params.delete("min_price");
                params.delete("max_price");
            }

            if (type === "all") {
                params.delete("shape");
                params.delete("metal");
                params.delete("min_price");
                params.delete("max_price");
                params.delete("sort");
            }

            reloadWithParams(params);
        });
    });

    /* ===============================
       DESKTOP + MOBILE DUAL PRICE RANGE
    =============================== */

    function setupDualPriceRange(config) {
        const minRange = $(config.minRange);
        const maxRange = $(config.maxRange);
        const fill = $(config.fill);

        const minTop = $(config.minTop);
        const maxTop = $(config.maxTop);

        const minText = $(config.minText);
        const maxText = $(config.maxText);

        const minInput = $(config.minInput);
        const maxInput = $(config.maxInput);

        if (!minRange || !maxRange || !fill) return;

        function updateUI(changedInput = null) {
            let minVal = Number(minRange.value || 0);
            let maxVal = Number(maxRange.value || 0);

            if (minVal > maxVal) {
                if (changedInput === "min") {
                    maxVal = minVal;
                    maxRange.value = maxVal;
                } else {
                    minVal = maxVal;
                    minRange.value = minVal;
                }
            }

            const minLimit = Number(minRange.min || 0);
            const maxLimit = Number(minRange.max || 1);

            const left = ((minVal - minLimit) / (maxLimit - minLimit)) * 100;
            const right = ((maxVal - minLimit) / (maxLimit - minLimit)) * 100;

            fill.style.left = left + "%";
            fill.style.width = (right - left) + "%";

            if (minTop) minTop.textContent = formatPKR(minVal);
            if (maxTop) maxTop.textContent = formatPKR(maxVal);

            if (minText) minText.value = formatPKR(minVal);
            if (maxText) maxText.value = formatPKR(maxVal);

            if (minInput) minInput.value = minVal;
            if (maxInput) maxInput.value = maxVal;
        }

        function applyPriceFilter() {
            if (!config.applyOnChange) return;

            const params = new URLSearchParams(window.location.search);

            const minVal = minInput ? minInput.value : minRange.value;
            const maxVal = maxInput ? maxInput.value : maxRange.value;
            const maxLimit = Number(maxRange.max || 0);

            if (Number(minVal) <= 0 && Number(maxVal) >= maxLimit) {
                params.delete("min_price");
                params.delete("max_price");
            } else {
                params.set("min_price", minVal);
                params.set("max_price", maxVal);
            }

            reloadWithParams(params);
        }

        minRange.addEventListener("input", function () {
            updateUI("min");
        });

        maxRange.addEventListener("input", function () {
            updateUI("max");
        });

        minRange.addEventListener("change", applyPriceFilter);
        maxRange.addEventListener("change", applyPriceFilter);

        updateUI();
    }

    setupDualPriceRange({
        minRange: "#desktopPriceMinRange",
        maxRange: "#desktopPriceMaxRange",
        fill: "#desktopPriceFill",
        minTop: "#desktopPriceMinTop",
        maxTop: "#desktopPriceMaxTop",
        minText: "#desktopPriceMinText",
        maxText: "#desktopPriceMaxText",
        minInput: "#desktopMinPriceInput",
        maxInput: "#desktopMaxPriceInput",
        applyOnChange: true
    });

    setupDualPriceRange({
        minRange: "#mobilePriceMinRange",
        maxRange: "#mobilePriceMaxRange",
        fill: "#mobilePriceFill",
        minTop: "#mobilePriceMinTop",
        maxTop: "#mobilePriceMaxTop",
        minText: "#mobilePriceMinText",
        maxText: "#mobilePriceMaxText",
        minInput: "#mobileMinPriceInput",
        maxInput: "#mobileMaxPriceInput",
        applyOnChange: false
    });

    /* ===============================
       SORT DESKTOP + MOBILE
    =============================== */

    const sortValueInput = $("#hjSortValue");

    const desktopSort = $("#hjDesktopSort");
    const desktopSortToggle = $("#hjDesktopSortToggle");
    const desktopSortText = $("#hjDesktopSortText");

    const modalSortWrap = $("#hjModalSortWrap");
    const modalSortToggle = $("#hjModalSortToggle");
    const modalSortText = $("#hjModalSortText");

    function closeSortDropdowns() {
        if (desktopSort) desktopSort.classList.remove("show");
        if (modalSortWrap) modalSortWrap.classList.remove("show");
    }

    function setSortText(value) {
        let label = "Sort: Best Selling";
        const finalValue = value || "featured";

        $all("[data-sort-value]").forEach(function (option) {
            const isSelected = option.dataset.sortValue === finalValue;

            option.classList.toggle("is-selected", isSelected);

            if (isSelected) {
                label = option.dataset.sortLabel || option.textContent.trim();
            }
        });

        if (sortValueInput) {
            sortValueInput.value = finalValue;
        }

        if (desktopSortText) {
            desktopSortText.textContent = label;
        }

        if (modalSortText) {
            modalSortText.textContent = label;
        }
    }

    if (desktopSortToggle && desktopSort) {
        desktopSortToggle.addEventListener("click", function (event) {
            event.stopPropagation();

            const isOpen = desktopSort.classList.contains("show");

            closeSortDropdowns();

            if (!isOpen) {
                desktopSort.classList.add("show");
            }
        });
    }

    if (modalSortToggle && modalSortWrap) {
        modalSortToggle.addEventListener("click", function (event) {
            event.stopPropagation();

            const isOpen = modalSortWrap.classList.contains("show");

            closeSortDropdowns();

            if (!isOpen) {
                modalSortWrap.classList.add("show");
            }
        });
    }

    $all("[data-sort-value]").forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.stopPropagation();

            const sortValue = this.dataset.sortValue || "featured";
            const isMobileSort = this.closest("#hjModalSortDropdown");

            setSortText(sortValue);
            closeSortDropdowns();

            if (!isMobileSort) {
                if (sortValue === "featured") {
                    setQueryParam("sort", "");
                } else {
                    setQueryParam("sort", sortValue);
                }
            }
        });
    });

    document.addEventListener("click", function (event) {
        const inDesktopSort = desktopSort && desktopSort.contains(event.target);
        const inMobileSort = modalSortWrap && modalSortWrap.contains(event.target);

        if (!inDesktopSort && !inMobileSort) {
            closeSortDropdowns();
        }
    });

    setSortText(sortValueInput ? sortValueInput.value : "featured");

    /* ===============================
       MOBILE FILTER DRAWER
    =============================== */

    const openMobileFilters = $("#hjOpenMobileFilters");
    const closeMobileFilters = $("#hjCloseMobileFilters");
    const mobileDrawer = $("#hjMobileFilterDrawer");
    const mobileOverlay = $("#hjMobileFilterOverlay");

    function openMobileDrawer() {
        if (!mobileDrawer || !mobileOverlay) return;

        mobileDrawer.classList.add("show");
        mobileOverlay.classList.add("show");
        document.body.classList.add("hj-mobile-filter-opened");
    }

    function closeMobileDrawer() {
        if (!mobileDrawer || !mobileOverlay) return;

        mobileDrawer.classList.remove("show");
        mobileOverlay.classList.remove("show");
        document.body.classList.remove("hj-mobile-filter-opened");

        closeSortDropdowns();
    }

    if (openMobileFilters) {
        openMobileFilters.addEventListener("click", function (event) {
            event.preventDefault();
            openMobileDrawer();
        });
    }

    if (closeMobileFilters) {
        closeMobileFilters.addEventListener("click", function (event) {
            event.preventDefault();
            closeMobileDrawer();
        });
    }

    if (mobileOverlay) {
        mobileOverlay.addEventListener("click", closeMobileDrawer);
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeMobileDrawer();
        }
    });

    /* ===============================
       MOBILE ACCORDION
    =============================== */

    $all(".hj-mobile-filter-title").forEach(function (button) {
        button.addEventListener("click", function () {
            const block = this.closest(".hj-mobile-filter-block");

            if (block) {
                block.classList.toggle("active");
            }
        });
    });

    /* ===============================
       MOBILE METAL SINGLE SELECT
    =============================== */

    const mobileMetalInput = $("#mobileMetalInput");

    $all(".hj-mobile-metal-list button").forEach(function (button) {
        button.addEventListener("click", function () {
            $all(".hj-mobile-metal-list button").forEach(function (item) {
                item.classList.remove("active");
            });

            this.classList.add("active");

            if (mobileMetalInput) {
                mobileMetalInput.value = this.dataset.value || "";
            }
        });
    });

    /* ===============================
       MOBILE SHAPE SINGLE SELECT
    =============================== */

    const mobileShapesInput = $("#mobileShapesInput");

    $all(".hj-mobile-shapes-grid button").forEach(function (button) {
        button.addEventListener("click", function () {
            $all(".hj-mobile-shapes-grid button").forEach(function (item) {
                item.classList.remove("active");
            });

            this.classList.add("active");

            if (mobileShapesInput) {
                mobileShapesInput.value = this.dataset.value || "";
            }
        });
    });

    /* ===============================
       MOBILE VIEW PRODUCTS APPLY
    =============================== */

    const viewProductsBtn = $("#hjMobileViewProducts");

    if (viewProductsBtn) {
        viewProductsBtn.addEventListener("click", function () {
            const params = new URLSearchParams(window.location.search);

            const selectedMetal = mobileMetalInput ? mobileMetalInput.value : "";
            const selectedShape = mobileShapesInput ? mobileShapesInput.value : "";
            const minPriceInput = $("#mobileMinPriceInput");
            const maxPriceInput = $("#mobileMaxPriceInput");

            const minPrice = minPriceInput ? minPriceInput.value : "";
            const maxPrice = maxPriceInput ? maxPriceInput.value : "";
            const selectedSort = sortValueInput ? sortValueInput.value : "featured";

            if (selectedMetal) {
                params.set("metal", selectedMetal);
            } else {
                params.delete("metal");
            }

            if (selectedShape) {
                params.set("shape", selectedShape);
            } else {
                params.delete("shape");
            }

            if (minPrice !== "") {
                params.set("min_price", minPrice);
            } else {
                params.delete("min_price");
            }

            if (maxPrice !== "") {
                params.set("max_price", maxPrice);
            } else {
                params.delete("max_price");
            }

            if (selectedSort && selectedSort !== "featured") {
                params.set("sort", selectedSort);
            } else {
                params.delete("sort");
            }

            reloadWithParams(params);
        });
    }

    /* ===============================
       PRODUCT DETAIL MOBILE GALLERY
    =============================== */

    function initGallerySlider() {
        const gallery = $("#hjProductGallery");
        const nextBtn = $("#hjGalleryNext");
        const dotsWrap = $("#hjGalleryDots");

        if (!gallery || !nextBtn || !dotsWrap) {
            return;
        }

        const getVisibleSlides = function () {
            return $all(".hj-gallery-item", gallery).filter(function (slide) {
                return slide.offsetParent !== null;
            });
        };

        const slides = getVisibleSlides();

        dotsWrap.innerHTML = "";

        slides.forEach(function (_, i) {
            const dot = document.createElement("button");
            dot.type = "button";
            dot.setAttribute("aria-label", "Go to image " + (i + 1));

            if (i === 0) {
                dot.classList.add("active");
            }

            dotsWrap.appendChild(dot);
        });

        const dots = $all("button", dotsWrap);

        function getCurrentGalleryIndex() {
            if (!gallery.clientWidth || !slides.length) {
                return 0;
            }

            return Math.min(
                Math.round(gallery.scrollLeft / gallery.clientWidth),
                slides.length - 1
            );
        }

        function goToGallerySlide(index) {
            if (!slides.length) {
                return;
            }

            gallery.scrollTo({
                left: gallery.clientWidth * index,
                behavior: "smooth"
            });
        }

        function updateGalleryDots() {
            const index = getCurrentGalleryIndex();

            dots.forEach(function (dot, i) {
                dot.classList.toggle("active", i === index);
            });
        }

        nextBtn.onclick = function () {
            const currentSlides = getVisibleSlides();

            if (!currentSlides.length) {
                return;
            }

            let index = getCurrentGalleryIndex() + 1;

            if (index >= currentSlides.length) {
                index = 0;
            }

            goToGallerySlide(index);
        };

        dots.forEach(function (dot, index) {
            dot.onclick = function () {
                goToGallerySlide(index);
            };
        });

        gallery.scrollLeft = 0;
        updateGalleryDots();
    }

    window.hjInitGallerySlider = initGallerySlider;

    const galleryEl = $("#hjProductGallery");

    if (galleryEl && !galleryEl.dataset.sliderBound) {
        galleryEl.dataset.sliderBound = "1";

        let ticking = false;

        galleryEl.addEventListener("scroll", function () {
            if (!ticking) {
                window.requestAnimationFrame(function () {
                    const dotsWrap = $("#hjGalleryDots");
                    const gallery = $("#hjProductGallery");

                    if (dotsWrap && gallery && gallery.clientWidth) {
                        const dots = $all("button", dotsWrap);
                        const slides = $all(".hj-gallery-item", gallery).filter(function (slide) {
                            return slide.offsetParent !== null;
                        });
                        const index = slides.length
                            ? Math.min(
                                Math.round(gallery.scrollLeft / gallery.clientWidth),
                                slides.length - 1
                            )
                            : 0;

                        dots.forEach(function (dot, i) {
                            dot.classList.toggle("active", i === index);
                        });
                    }

                    ticking = false;
                });

                ticking = true;
            }
        });
    }

    if ($("#hjProductGallery") && $("#hjGalleryNext") && $("#hjGalleryDots")) {
        initGallerySlider();
    }

    /* ===============================
       REVIEW GALLERY SLIDER
    =============================== */

    const reviewGalleryViewport = $(".hj-review-gallery-viewport");
    const reviewGalleryTrack = $(".hj-review-gallery-track");
    const reviewPrevBtn = $(".hj-review-arrows .hj-gallery-prev");
    const reviewNextBtn = $(".hj-review-arrows .hj-gallery-next");

    if (reviewGalleryViewport && reviewGalleryTrack && reviewPrevBtn && reviewNextBtn) {
        function getReviewScrollAmount() {
            const firstImg = $("img", reviewGalleryTrack);
            const gap = 6;

            if (!firstImg) {
                return 156;
            }

            return firstImg.offsetWidth + gap;
        }

        reviewNextBtn.addEventListener("click", function () {
            reviewGalleryTrack.scrollBy({
                left: getReviewScrollAmount(),
                behavior: "smooth"
            });
        });

        reviewPrevBtn.addEventListener("click", function () {
            reviewGalleryTrack.scrollBy({
                left: -getReviewScrollAmount(),
                behavior: "smooth"
            });
        });
    }

    /* ===============================
       FALLBACK CARAT BUTTON UPDATE
    =============================== */

    const detailDataScript = $("#hjDetailProductData");
    const caratRange = $("#caratRange");
    const caratBtn = $("#caratBtn");

    if (!detailDataScript && caratRange && caratBtn) {
        const caratValues = [
            "0.25 CARAT",
            "0.30 CARAT",
            "0.40 CARAT",
            "0.60 CARAT",
            "0.70 CARAT",
            "0.75 CARAT",
            "0.90 CARAT",
            "1.00 CARAT"
        ];

        caratRange.addEventListener("input", function () {
            caratBtn.textContent = caratValues[this.value] || caratValues[0];
        });
    }

    /* ===============================
       SPEC TABS
    =============================== */

    $all(".hj-tab-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const tabId = this.getAttribute("data-tab");

            $all(".hj-tab-btn").forEach(function (tab) {
                tab.classList.remove("active");
            });

            $all(".hj-tab-panel").forEach(function (panel) {
                panel.classList.remove("active");
            });

            this.classList.add("active");

            const panel = document.getElementById(tabId);

            if (panel) {
                panel.classList.add("active");
            }
        });
    });

    /* ===============================
       SPEC HELP DROPDOWN
    =============================== */

    $all(".hj-help-btn").forEach(function (btn) {
        btn.addEventListener("click", function (event) {
            event.stopPropagation();

            const currentItem = this.closest(".hj-spec-item");

            $all(".hj-spec-item").forEach(function (item) {
                if (item !== currentItem) {
                    item.classList.remove("active-help");
                }
            });

            if (currentItem) {
                currentItem.classList.toggle("active-help");
            }
        });
    });

    document.addEventListener("click", function () {
        $all(".hj-spec-item").forEach(function (item) {
            item.classList.remove("active-help");
        });
    });

    /* ===============================
       SIMPLE ACCORDION
    =============================== */

    $all(".hj-acc-item button").forEach(function (button) {
        button.addEventListener("click", function () {
            const currentItem = this.closest(".hj-acc-item");

            $all(".hj-acc-item").forEach(function (item) {
                if (item !== currentItem) {
                    item.classList.remove("active");
                }
            });

            if (currentItem) {
                currentItem.classList.toggle("active");
            }
        });
    });
});
