window.onload = () => {
  OwlCarousel.init();
  Amount.init();
  ProductBox.init();
  Collapse.init();
  BankingInfo.init();
  ProductCategoryDrawer.init();
};

const loading = {
  init: function () {
    this.config();
  },
  config: function () {},
};

const OwlCarousel = {
  init: function () {
    this.setupBannerCarousel();
    this.setupNavigationCarousel();
    this.setupProductCategoryCarousel();
    this.setupProductCategoryCarouselMobile();
  },
  setupNavigationCarousel: function () {
    const $owl = $("#Navigation-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-arrow-left-white.svg" alt="" />',
        '<img src="./assets/icons/icon-arrow-right-white.svg" alt="" />',
      ],
      margin: 0,
    });
  },
  setupBannerCarousel: function () {
    const $owl = $("#Banner-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          slideBy: 1,
        },
      },
      loop: true,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-arrow-left-white.svg" alt="" />',
        '<img src="./assets/icons/icon-arrow-right-white.svg" alt="" />',
      ],
      margin: 0,
    });
  },
  setupProductCategoryCarousel: function () {
    const $owl = $("#ProductCategory-carousel").owlCarousel({
      responsive: {
        0: {
          items: 3,
          slideBy: 1,
        },
        575: {
          items: 4,
          slideBy: 1,
        },
        768: {
          items: 5,
          slideBy: 1,
        },
        991: {
          items: 6,
          slideBy: 1,
        },
        1080: {
          items: 7,
          slideBy: 1,
        },
        1440: {
          items: 8,
          slideBy: 1,
        },
      },
      loop: false,
      autoplay: false,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-arrow-left-white.svg" alt="" />',
        '<img src="./assets/icons/icon-arrow-right-white.svg" alt="" />',
      ],
      margin: 30,
    });
  },
  setupProductCategoryCarouselMobile: function () {
    const $owl = $("#ProductCategory-carousel-mobile").owlCarousel({
      responsive: {
        0: {
          items: 3,
          slideBy: 1,
        },
        575: {
          items: 4,
          slideBy: 1,
        },
      },
      loop: false,
      autoplay: false,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      smartSpeed: 300,
      lazyLoad: true,
      dots: false,
      nav: false,
      navText: [
        '<img src="./assets/icons/icon-arrow-left-white.svg" alt="" />',
        '<img src="./assets/icons/icon-arrow-right-white.svg" alt="" />',
      ],
      margin: 20,
    });
  },
};

const Amount = {
  init: function () {
    this.config();
  },
  config: function () {
    const mains = document.querySelectorAll(".Amount");

    mains.forEach((main) => {
      const minus = main.querySelector(".Amount-minus");
      const plus = main.querySelector(".Amount-plus");
      const control = main.querySelector(".Amount-control");

      const min = control.min || Number.MIN_SAFE_INTEGER;
      const max = control.max || Number.MAX_SAFE_INTEGER;

      minus.addEventListener("click", () => {
        const controlValue = control.value;
        if (controlValue > min) {
          control.value = Number(controlValue) - 1;
        }
      });

      plus.addEventListener("click", () => {
        const controlValue = control.value;
        if (controlValue < max) {
          control.value = Number(controlValue) + 1;
        }
      });
    });
  },
};

const ProductBox = {
  init: function () {
    this.configProductBoxVideo();
    this.configProductDetailVideo();
    this.configAddCartProductDetail();
  },
  configAddCartProductDetail: function () {
    const btnOpen = document.querySelector(".ProductActions-item.cart");
    const main = document.querySelector(".ProductCartDrawer");

    if (btnOpen && main) {
      btnOpen.addEventListener("click", () => {
        main.classList.add("active");
      });

      const overlay = main.querySelector(".ProductCartDrawer-overlay");

      overlay.addEventListener("click", () => {
        main.classList.remove("active");
      });
    }
  },
  configProductBoxVideo: function () {
    const products = document.querySelectorAll(".ProductBox");
    products.forEach((item) => {
      const video = item.querySelector(".ProductBox-video");
      const srcVideo = video.dataset.src;

      const startVideo = () => {
        if (!video.src) {
          video.addEventListener("loadeddata", () => {
            video.classList.add("loaded");
          });
          video.src = srcVideo;
        }

        video.classList.add("active");
        video.play();
      };

      const endVideo = () => {
        video.classList.remove("active");
        video.pause();
        video.currentTime = 0;
      };

      item.addEventListener("mousemove", startVideo);
      item.addEventListener("touchstart", startVideo);
      item.addEventListener("mouseleave", endVideo);
      item.addEventListener("touchend", endVideo);
    });
  },
  configProductDetailVideo: function () {
    const video = document.querySelector(".ProductDetailPage-detail-video");
    const playBtn = document.querySelector(
      ".ProductDetailPage-detail-image-play"
    );
    if (video && playBtn) {
      video.addEventListener("loadeddata", () => {
        video.classList.add("loaded");
        playBtn.classList.remove("active");
        video.play();
      });

      video.addEventListener("click", () => {
        if (video.paused) {
          video.play();
          playBtn.classList.remove("active");
        } else {
          video.pause();
          playBtn.classList.add("active");
        }
      });
    }
  },
};

const Collapse = {
  init: function () {
    this.config();
  },
  config: function () {
    const mains = document.querySelectorAll(".Collapse");

    mains.forEach((main) => {
      const items = main.querySelectorAll(".Collapse-item");

      items?.[0]?.classList?.add("active");

      items.forEach((item, index) => {
        const header = item.querySelector(".Collapse-item-header");

        header.addEventListener("click", () => {
          items.forEach((i, idx) => {
            if (idx !== index) i.classList.remove("active");
          });

          item.classList.toggle("active");
        });
      });
    });
  },
};

const BankingInfo = {
  init: function () {
    this.toggle();
  },
  toggle: function () {
    const bankingInfo = document.querySelector(".js-banking-info");
    const bankingInfoCheck = document.querySelectorAll(
      '.js-banking-info-check input[type="radio"]'
    );

    if (bankingInfo) {
      bankingInfo.style.display = "none";
    }

    bankingInfoCheck.forEach((item) =>
      item.addEventListener("change", () => {
        const key = item.dataset.key;

        if (key === "banking") {
          bankingInfo.style.display = "block";
        } else {
          bankingInfo.style.display = "none";
        }
      })
    );
  },
};

const ProductCategoryDrawer = {
  init: function () {
    this.config();
  },
  config: function () {
    const btnOpen = document.querySelector(".NavigationMobile .danhmuc");
    const main = document.querySelector(".ProductCategoryDrawer");

    if (btnOpen && main) {
      btnOpen.addEventListener("click", (e) => {
        e.preventDefault();
        main.classList.add("active");
      });

      const overlay = main.querySelector(".ProductCategoryDrawer-overlay");

      overlay.addEventListener("click", () => {
        main.classList.remove("active");
      });
    }
  },
};
