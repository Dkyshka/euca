"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["sliderNews"],{

/***/ "./sliders/news-slider.js":
/*!********************************!*\
  !*** ./sliders/news-slider.js ***!
  \********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   sliderNews: function() { return /* binding */ sliderNews; }
/* harmony export */ });
/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "../../node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "../../node_modules/swiper/modules/index.mjs");


function sliderNews() {
  const swiper = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](".news-slider", {
    modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Autoplay],
    loop: true,
    autoHeight: true,
    breakpoints: {
      1080: {
        slidesPerView: 3,
        slidesPerGroup: 1
      },
      580: {
        slidesPerView: 2,
        slidesPerGroup: 1
      },
      360: {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 15
      }
    },
    autoplay: {
      delay: 3e3,
      disableOnInteraction: false
    },
    slidesPerView: 3,
    speed: 1500
  });
}


/***/ })

}]);
//# sourceMappingURL=sliderNews.js.map