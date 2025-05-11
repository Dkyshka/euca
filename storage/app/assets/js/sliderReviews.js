"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["sliderReviews"],{

/***/ "./sliders/reviews-slider.js":
/*!***********************************!*\
  !*** ./sliders/reviews-slider.js ***!
  \***********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   sliderReviews: function() { return /* binding */ sliderReviews; }
/* harmony export */ });
/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "../../node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "../../node_modules/swiper/modules/index.mjs");


function sliderReviews() {
  const swiper = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](".reviews__slider", {
    modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Navigation],
    slidesPerView: 3,
    loop: true,
    speed: 800,
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
    navigation: {
      nextEl: ".reviews__btn-right",
      prevEl: ".reviews__btn-left"
    }
  });
}


/***/ })

}]);
//# sourceMappingURL=sliderReviews.js.map