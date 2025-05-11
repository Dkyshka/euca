"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["sliderCatalog"],{

/***/ "./sliders/catalog-slider.js":
/*!***********************************!*\
  !*** ./sliders/catalog-slider.js ***!
  \***********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   sliderCatalog: function() { return /* binding */ sliderCatalog; }
/* harmony export */ });
/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "../../node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "../../node_modules/swiper/modules/index.mjs");


function sliderCatalog() {
  const swiper = new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](".catalog-inner__slider", {
    modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Autoplay, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Navigation],
    slidesPerView: "auto",
    grabCursor: true,
    loop: true,
    autoplay: {
      delay: 3e3,
      disableOnInteraction: false
    },
    speed: 600,
    navigation: {
      nextEl: ".catalog-btn-right",
      prevEl: ".catalog-btn-left"
    }
  });
}


/***/ })

}]);
//# sourceMappingURL=sliderCatalog.js.map