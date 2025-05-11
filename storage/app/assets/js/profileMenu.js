"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["profileMenu"],{

/***/ "./helpers/profile-menu.js":
/*!*********************************!*\
  !*** ./helpers/profile-menu.js ***!
  \*********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   profileMenu: function() { return /* binding */ profileMenu; }
/* harmony export */ });
function profileMenu() {
  const btnHeader = document.querySelector(".nav__btn-header");
  const btnProfile = document.querySelector(".nav__btn-profile");
  const sideBar = document.querySelector(".side-bar");
  if (!btnHeader || !sideBar || !btnProfile) return;
  btnHeader.addEventListener("click", (e) => {
    e.preventDefault();
    sideBar.classList.add("open");
  });
  btnProfile.addEventListener("click", (e) => {
    e.preventDefault();
    sideBar.classList.remove("open");
  });
  document.addEventListener("click", (e) => {
    if (!sideBar.contains(e.target) && !btnHeader.contains(e.target) && sideBar.classList.contains("open")) {
      sideBar.classList.remove("open");
    }
  });
}


/***/ })

}]);
//# sourceMappingURL=profileMenu.js.map