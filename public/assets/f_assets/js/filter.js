document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    function $(selector, parent = document) {
        return parent.querySelector(selector);
    }

    function $all(selector, parent = document) {
        return Array.from(parent.querySelectorAll(selector));
    }

    function formatPKR(value) {
        return "PKR " + Number(value).toLocaleString();
    }

    /* ===============================
       DESKTOP FILTER PANELS
    =============================== */

    const desktopButtons = [
        { btn: $("#shapeFilterBtn"), panel: $("#shapesPanel") },
        { btn: $("#materialFilterBtn"), panel: $("#materialPanel") },
        { btn: $("#priceFilterBtn"), panel: $("#pricePanel") }
    ];

    function closeDesktopPanels() {
        desktopButtons.forEach(function (item) {
            if (item.btn) item.btn.classList.remove("active");
            if (item.panel) item.panel.classList.remove("show");
        });
    }

    desktopButtons.forEach(function (item) {
        if (!item.btn || !item.panel) return;

        item.btn.addEventListener("click", function () {
            const isOpen = item.panel.classList.contains("show");

            closeDesktopPanels();

            if (!isOpen) {
                item.btn.classList.add("active");
                item.panel.classList.add("show");

                if (item.btn.id === "priceFilterBtn") {
                    updateDesktopPriceRange();
                }
            }
        });
    });

    const shapeItems = $all(".hj-shape-item");

    shapeItems.forEach(function (item) {
        item.addEventListener("click", function () {
            shapeItems.forEach(function (shape) {
                shape.classList.remove("active");
            });
            item.classList.add("active");
        });
    });

    const materialItems = $all(".hj-material-item");

    materialItems.forEach(function (item) {
        item.addEventListener("click", function () {
            materialItems.forEach(function (material) {
                material.classList.remove("active");
            });
            item.classList.add("active");
        });
    });

    const clearShapeBtn = $(".hj-clear-btn");
    const clearMaterialBtn = $(".hj-clear-material-btn");
    const clearPriceBtn = $(".hj-clear-price-btn");

    if (clearShapeBtn) {
        clearShapeBtn.addEventListener("click", function () {
            shapeItems.forEach(function (shape) {
                shape.classList.remove("active");
            });

            const shapeBtn = $("#shapeFilterBtn");
            const shapesPanel = $("#shapesPanel");

            if (shapeBtn) shapeBtn.classList.remove("active");
            if (shapesPanel) shapesPanel.classList.remove("show");
        });
    }

    if (clearMaterialBtn) {
        clearMaterialBtn.addEventListener("click", function () {
            materialItems.forEach(function (material) {
                material.classList.remove("active");
            });

            const materialBtn = $("#materialFilterBtn");
            const materialPanel = $("#materialPanel");

            if (materialBtn) materialBtn.classList.remove("active");
            if (materialPanel) materialPanel.classList.remove("show");
        });
    }

    /* ===============================
   DESKTOP CUSTOM SORT DROPDOWN
=============================== */

const desktopSort = document.getElementById("hjDesktopSort");
const desktopSortToggle = document.getElementById("hjDesktopSortToggle");
const desktopSortText = document.getElementById("hjDesktopSortText");
const desktopSortOptions = document.querySelectorAll("#hjDesktopSortDropdown button");

if (desktopSort && desktopSortToggle) {
    desktopSortToggle.addEventListener("click", function (event) {
        event.stopPropagation();
        desktopSort.classList.toggle("show");
    });
}

desktopSortOptions.forEach(function (option) {
    option.addEventListener("click", function (event) {
        event.stopPropagation();

        const selectedValue = option.dataset.sort || option.textContent.trim();

        if (desktopSortText) {
            desktopSortText.textContent = selectedValue;
        }

        if (desktopSort) {
            desktopSort.classList.remove("show");
        }
    });
});

document.addEventListener("click", function (event) {
    if (desktopSort && !desktopSort.contains(event.target)) {
        desktopSort.classList.remove("show");
    }
});

    /* ===============================
       UNIFIED PRICE RANGE (Desktop & Mobile)
    =============================== */

    function setupPriceRange(rangeId, tooltipId, minId, maxId, clearBtnId) {
        const priceRange = $(rangeId);
        const priceTooltip = $(tooltipId);
        const priceMin = $(minId);
        const priceMax = $(maxId);
        const clearBtn = clearBtnId ? $(clearBtnId) : null;

        if (!priceRange) return;

        function updatePriceRange() {
            const min = Number(priceRange.min || 0);
            const max = Number(priceRange.max || 0);
            const value = Number(priceRange.value || 0);
            const percent = max > min ? ((value - min) / (max - min)) * 100 : 0;

            priceRange.style.background =
                "linear-gradient(to right, #777 " + percent + "%, #e4e4e4 " + percent + "%)";

            if (priceTooltip) {
                priceTooltip.style.left = percent + "%";
                priceTooltip.innerText = formatPKR(value);
            }

            if (priceMin && !priceMin.value) {
                priceMin.value = formatPKR(min);
            }

            if (priceMax) {
                priceMax.value = formatPKR(value);
                if (value > 0) {
                    priceMax.classList.add("is-active");
                } else {
                    priceMax.classList.remove("is-active");
                }
            }
        }

        priceRange.addEventListener("input", updatePriceRange);
        updatePriceRange();

        if (clearBtn) {
            clearBtn.addEventListener("click", function () {
                priceRange.value = priceRange.min || 0;
                updatePriceRange();
            });
        }
    }

    setupPriceRange("#priceRange", "#priceTooltip", "#priceMin", "#priceMax", ".hj-clear-price-btn");
    
    const priceBtn = $("#priceFilterBtn");
    const pricePanel = $("#pricePanel");
    if (clearPriceBtn && priceBtn && pricePanel) {
        clearPriceBtn.addEventListener("click", function () {
            priceBtn.classList.remove("active");
            pricePanel.classList.remove("show");
        });
    }

    /* ===============================
       MOBILE DUAL PRICE RANGE SLIDER
    =============================== */

    function setupMobilePriceRangeSlider() {
        const minRange = $("#mobilePriceMinRange");
        const maxRange = $("#mobilePriceMaxRange");
        const fill = $("#mobilePriceFill");
        const minLabel = $("#mobilePriceMinTop");
        const maxLabel = $("#mobilePriceMaxTop");
        const minInput = $("#mobilePriceMinText");
        const maxInput = $("#mobilePriceMaxText");
        const minHidden = $("#mobileMinPriceInput");
        const maxHidden = $("#mobileMaxPriceInput");

        if (!minRange || !maxRange || !fill) return;

        function updateSliderFill() {
            const minVal = Number(minRange.value);
            const maxVal = Number(maxRange.value);
            const minMax = Number(minRange.max);
            const minMin = Number(minRange.min);

            // Calculate percentages
            const minPercent = ((minVal - minMin) / (minMax - minMin)) * 100;
            const maxPercent = ((maxVal - minMin) / (minMax - minMin)) * 100;

            // Update fill bar position and width
            fill.style.left = minPercent + "%";
            fill.style.width = maxPercent - minPercent + "%";

            // Update labels
            if (minLabel) minLabel.textContent = "$" + minVal.toLocaleString();
            if (maxLabel) maxLabel.textContent = "$" + maxVal.toLocaleString();

            // Update input fields
            if (minInput) minInput.value = "$" + minVal.toLocaleString();
            if (maxInput) maxInput.value = "$" + maxVal.toLocaleString();

            // Update hidden inputs
            if (minHidden) minHidden.value = minVal;
            if (maxHidden) maxHidden.value = maxVal;

            // Prevent max range from going below min range
            if (maxVal < minVal) {
                maxRange.value = minVal;
            }
        }

        minRange.addEventListener("input", updateSliderFill);
        maxRange.addEventListener("input", updateSliderFill);

        // Initial update
        updateSliderFill();
    }

    setupMobilePriceRangeSlider();

 /* ===============================
   MOBILE FILTER MODAL OPEN / CLOSE
=============================== */

const openMobileFilters = $("#hjOpenMobileFilters");
const mobileDrawer = $("#hjMobileFilterDrawer");
const mobileOverlay = $("#hjMobileFilterOverlay");
const closeMobileFilters = $("#hjCloseMobileFilters");
const mobileCloseHeader = $(".hj-mobile-filter-head");
const viewProductsBtn = $(".hj-mobile-view-products");
const modalSortWrap = $(".hj-modal-sort-wrap");

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

    if (modalSortWrap) {
        modalSortWrap.classList.remove("show");
    }
}

if (openMobileFilters) {
    openMobileFilters.addEventListener("click", function (event) {
        event.preventDefault();
        openMobileDrawer();
    });
}

if (closeMobileFilters) {
    closeMobileFilters.addEventListener("click", closeMobileDrawer);
}

if (mobileCloseHeader) {
    mobileCloseHeader.addEventListener("click", closeMobileDrawer);
}

document.body.addEventListener("click", function (event) {
    if (event.target.closest("#hjCloseMobileFilters")) {
        closeMobileDrawer();
    }
});

if (mobileOverlay) {
    mobileOverlay.addEventListener("click", closeMobileDrawer);
}

if (viewProductsBtn) {
    viewProductsBtn.addEventListener("click", closeMobileDrawer);
}

const mobileFilterTitles = $all(".hj-mobile-filter-title");

mobileFilterTitles.forEach(function (title) {
    title.addEventListener("click", function () {
        const block = title.closest(".hj-mobile-filter-block");
        if (!block) return;
        block.classList.toggle("active");
    });
});


/* ===============================
   MODAL SORT DROPDOWN
=============================== */

const modalSortToggle = $("#hjModalSortToggle");
const modalSortText = $("#hjModalSortText");
const modalSortInput = $("#mobileSortInput");
const modalSortOptions = $all(".hj-modal-sort-dropdown button");

if (modalSortToggle && modalSortWrap) {
    modalSortToggle.addEventListener("click", function (event) {
        event.stopPropagation();
        modalSortWrap.classList.toggle("show");
    });
}

modalSortOptions.forEach(function (option) {
    option.addEventListener("click", function (event) {
        event.stopPropagation();

        const label = option.dataset.label || option.textContent.trim();
        const value = option.dataset.value || option.textContent.trim();

        if (modalSortText) {
            modalSortText.textContent = label;
        }

        if (modalSortInput) {
            modalSortInput.value = value;
        }

        if (modalSortWrap) {
            modalSortWrap.classList.remove("show");
        }
    });
});

document.addEventListener("click", function (event) {
    if (modalSortWrap && !modalSortWrap.contains(event.target)) {
        modalSortWrap.classList.remove("show");
    }
});

document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeMobileDrawer();
    }
});
/* ===============================
   MOBILE MULTI SELECT FILTER ITEMS
=============================== */

const mobileMetalItems = $all(".hj-mobile-metal-list button");
const mobileShapeItems = $all(".hj-mobile-shapes-grid button");

const selectedFiltersWrap = $("#hjMobileSelectedFiltersWrap");
const selectedFiltersBox = $("#hjMobileSelectedFilters");
const resetFiltersBtn = $("#hjMobileResetFilters");

function getFilterLabel(item) {
    const small = item.querySelector("small");
    const span = item.querySelector("span");

    if (small) return small.textContent.trim();
    if (span) return span.textContent.trim();

    return item.textContent.trim();
}

function updateSelectedFilterChips() {
    if (!selectedFiltersBox || !selectedFiltersWrap) return;

    selectedFiltersBox.innerHTML = "";

    const selectedItems = [
        ...mobileMetalItems.filter(item => item.classList.contains("active")),
        ...mobileShapeItems.filter(item => item.classList.contains("active"))
    ];

    if (selectedItems.length === 0) {
        selectedFiltersWrap.classList.remove("show");
        return;
    }

    selectedFiltersWrap.classList.add("show");

    selectedItems.forEach(function (item) {
        const label = getFilterLabel(item);

        const chip = document.createElement("button");
        chip.type = "button";
        chip.className = "hj-mobile-selected-chip";
        chip.innerHTML = `${label} <span>×</span>`;

        chip.addEventListener("click", function () {
            item.classList.remove("active");
            updateSelectedFilterChips();
        });

        selectedFiltersBox.appendChild(chip);
    });
}

/* MULTI SELECT METAL */
mobileMetalItems.forEach(function (item) {
    item.addEventListener("click", function () {
        item.classList.toggle("active");
        updateSelectedFilterChips();
    });
});

/* MULTI SELECT SHAPES */
mobileShapeItems.forEach(function (item) {
    item.addEventListener("click", function () {
        item.classList.toggle("active");
        updateSelectedFilterChips();
    });
});

/* RESET ALL FILTERS */
if (resetFiltersBtn) {
    resetFiltersBtn.addEventListener("click", function () {
        mobileMetalItems.forEach(function (item) {
            item.classList.remove("active");
        });

        mobileShapeItems.forEach(function (item) {
            item.classList.remove("active");
        });

        updateSelectedFilterChips();
    });
}

updateSelectedFilterChips();
   
    setupPriceRange("#mobilePriceRange", "#mobilePriceTooltip", "#mobilePriceMin", "#mobilePriceMax", ".hj-clear-mobile-price-btn");

    /* ===============================
       MOBILE GALLERY SLIDER
    =============================== */

    const gallery = $("#hjProductGallery");
    const nextBtn = $("#hjGalleryNext");
    const dotsWrap = $("#hjGalleryDots");

    if (gallery && nextBtn && dotsWrap) {
        const slides = $all(".hj-gallery-item", gallery);
        const dots = $all("button", dotsWrap);

        function getCurrentGalleryIndex() {
            return Math.round(gallery.scrollLeft / gallery.clientWidth);
        }

        function goToGallerySlide(index) {
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

        nextBtn.addEventListener("click", function () {
            let index = getCurrentGalleryIndex() + 1;

            if (index >= slides.length) {
                index = 0;
            }

            goToGallerySlide(index);
        });

        dots.forEach(function (dot, index) {
            dot.addEventListener("click", function () {
                goToGallerySlide(index);
            });
        });

        let ticking = false;

        gallery.addEventListener("scroll", function () {
            if (!ticking) {
                window.requestAnimationFrame(function () {
                    updateGalleryDots();
                    ticking = false;
                });

                ticking = true;
            }
        });

        updateGalleryDots();
    }

    /* ===============================
       REVIEW GALLERY SLIDER
    =============================== */

    const reviewGalleryViewport = $(".hj-review-gallery-viewport");
    const reviewGalleryTrack = $(".hj-review-gallery-track");
    const reviewPrevBtn = $(".hj-review-arrows .hj-gallery-prev");
    const reviewNextBtn = $(".hj-review-arrows .hj-gallery-next");

    if (reviewGalleryViewport && reviewGalleryTrack && reviewPrevBtn && reviewNextBtn) {
        const reviewImages = $all("img", reviewGalleryTrack);
        const imageWidth = 150; // Default width from CSS
        const imageGap = 6; // Gap from CSS

        function getReviewImageDimensions() {
            const firstImg = reviewImages[0];
            if (firstImg) {
                return {
                    width: firstImg.offsetWidth,
                    gap: imageGap
                };
            }
            return { width: imageWidth, gap: imageGap };
        }

        function scrollReviewGallery(direction) {
            const dims = getReviewImageDimensions();
            const scrollAmount = dims.width + dims.gap;
            
            reviewGalleryTrack.scrollBy({
                left: direction === "next" ? scrollAmount : -scrollAmount,
                behavior: "smooth"
            });
        }

        reviewNextBtn.addEventListener("click", function () {
            scrollReviewGallery("next");
        });

        reviewPrevBtn.addEventListener("click", function () {
            scrollReviewGallery("prev");
        });
    }

         const caratValues = [
        "0.25 CARAT",
        "0.30 CARAT",
        "0.40 CARAT",
        "0.50 CARAT",
        "0.60 CARAT",
        "0.70 CARAT",
        "0.75 CARAT",
        "0.90 CARAT",
        "1.00 CARAT"
    ];

    const caratRange = document.getElementById("caratRange");
    const caratBtn = document.getElementById("caratBtn");

    if (caratRange && caratBtn) {
        caratRange.addEventListener("input", function () {
            caratBtn.textContent = caratValues[this.value];
        });
    }
document.querySelectorAll('.hj-tab-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const tabId = this.getAttribute('data-tab');

        document.querySelectorAll('.hj-tab-btn').forEach(function(tab) {
            tab.classList.remove('active');
        });

        document.querySelectorAll('.hj-tab-panel').forEach(function(panel) {
            panel.classList.remove('active');
        });

        this.classList.add('active');
        document.getElementById(tabId).classList.add('active');
    });
});

document.querySelectorAll('.hj-help-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();

        const currentItem = this.closest('.hj-spec-item');

        document.querySelectorAll('.hj-spec-item').forEach(function(item) {
            if (item !== currentItem) {
                item.classList.remove('active-help');
            }
        });

        currentItem.classList.toggle('active-help');
    });
});

document.addEventListener('click', function() {
    document.querySelectorAll('.hj-spec-item').forEach(function(item) {
        item.classList.remove('active-help');
    });
});
    
});