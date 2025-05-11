"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["dropdown"],{

/***/ "./utils/tabs.js":
/*!***********************!*\
  !*** ./utils/tabs.js ***!
  \***********************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   closeDropdown: function() { return /* binding */ closeDropdown; }
/* harmony export */ });
const closeDropdown = () => {
  window.addEventListener(`click`, (e) => {
    if (document.querySelector(`details[open]`)) {
      let target = e.target.closest(`details[open]`);
      if (!target && e.target.tagName !== `BUTTON`) {
        document.querySelectorAll(`details[open]`).forEach((item) => {
          item.removeAttribute(`open`);
        });
      }
    }
  });
};


/***/ })

}]);
//# sourceMappingURL=dropdown.js.map