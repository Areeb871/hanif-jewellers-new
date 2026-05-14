let items = document.querySelectorAll(".JW .carousel .carousel-item");

items.forEach((el) => {
  const minPerSlide = 3;
  let next = el.nextElementSibling;
  for (var i = 1; i < minPerSlide; i++) {
    if (!next) {
      // wrap carousel by using first child
      next = items[0];
    }
    let cloneChild = next.cloneNode(true);
    el.appendChild(cloneChild.children[0]);
    next = next.nextElementSibling;
  }
});

// ['HIGH_END', 'BRIDAL', 'SEASONAL', 'LIFESTYLE'].forEach(function(tabKey) {
//   let items = document.querySelectorAll("#headerCarousel-" + tabKey + "-0 .carousel-item");
//   let minPerSlide = 3;
//   items.forEach((el, idx) => {
//     let row = el.querySelector('.row');
//     let nextIdx = idx + 1;
//     for (let i = 1; i < minPerSlide; i++) {
//       if (nextIdx >= items.length) nextIdx = 0;
//       let nextRow = items[nextIdx].querySelector('.row');
//       let clone = nextRow.children[0].cloneNode(true);
//       row.appendChild(clone);
//       nextIdx++;
//     }
//   });
// });

// menu for js

document.querySelectorAll(".main-menu a").forEach((item) => {
  item.addEventListener("mouseenter", function () {
    // Only apply on desktop
    if (window.innerWidth >= 992) {
      const key = this.dataset.sub;

      // Hide all submenus and images
      document
        .querySelectorAll(".submenuDesktop .submenu, .image-preview")
        .forEach((el) => el.classList.remove("active"));

      // Show the matching submenu and image
      const submenu = document.querySelector(`.submenuDesktop #submenu-${key}`);
      const image = document.getElementById(`image-${key}`);

      if (submenu) submenu.classList.add("active");
      if (image) image.classList.add("active");
    }
  });
});

// Optional: Show first submenu/image by default only on desktop
// if (window.innerWidth >= 992) {
//   document
//     .querySelector('[data-sub="gold-edit"]')
//     .dispatchEvent(new Event("mouseenter"));
// }

if (window.innerWidth < 768) {
  document.querySelectorAll(".main-menu a").forEach((item) => {
    item.addEventListener("click", function (e) {
      e.preventDefault();
      const key = this.dataset.sub;

      // Toggle current submenu only
      const submenu = document.querySelector(`#submenu-${key}.submenuMobile`);
      if (submenu) submenu.classList.toggle("active");
    });
  });
}

