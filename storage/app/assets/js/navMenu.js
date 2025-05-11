"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["navMenu"],{

/***/ "./helpers/burger-menu.js":
/*!********************************!*\
  !*** ./helpers/burger-menu.js ***!
  \********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   navMenu: function() { return /* binding */ navMenu; }
/* harmony export */ });
function navMenu() {
  const menuBtn = document.querySelector(".nav__btn");
  const navMenu2 = document.querySelector(".nav-menu");
  const body = document.querySelector("body");
  if (menuBtn && navMenu2) {
    menuBtn.addEventListener("click", (e) => {
      e.preventDefault();
      body.classList.toggle("open");
      menuBtn.classList.toggle("open");
      if (navMenu2) navMenu2.classList.toggle("open");
    });
    window.addEventListener("resize", () => {
      if (window.innerWidth > 999) {
        menuBtn.classList.remove("open");
        body.classList.remove("open");
        if (navMenu2) navMenu2.classList.remove("open");
      }
    });
  }
}


/***/ })

}]);
//# sourceMappingURL=navMenu.js.map