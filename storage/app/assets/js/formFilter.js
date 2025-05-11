"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["formFilter"],{

/***/ "./helpers/form-filters.js":
/*!*********************************!*\
  !*** ./helpers/form-filters.js ***!
  \*********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   formFilter: function() { return /* binding */ formFilter; }
/* harmony export */ });
function formFilter() {
  const btnHeader = document.querySelector(".form-btn__filters");
  const btnProfile = document.querySelector(".form-order-close");
  const sideBar = document.querySelector(".form-order-goods");
  if (!btnHeader || !sideBar || !btnProfile) return;
  btnHeader.addEventListener("click", (e) => {
    e.preventDefault();
    sideBar.classList.add("open");
  });
  btnProfile.addEventListener("click", (e) => {
    e.preventDefault();
    sideBar.classList.remove("open");
  });
}


/***/ })

}]);
//# sourceMappingURL=formFilter.js.map