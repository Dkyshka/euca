"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["autoResizeTextarea"],{

/***/ "./helpers/autoResizeTextarea.js":
/*!***************************************!*\
  !*** ./helpers/autoResizeTextarea.js ***!
  \***************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   autoResizeTextarea: function() { return /* binding */ autoResizeTextarea; }
/* harmony export */ });
function autoResizeTextarea() {
  const textareas = document.querySelectorAll("textarea");
  if (!textareas) return;
  textareas.forEach((textarea) => {
    textarea.style.height = "auto";
    textarea.style.overflow = "hidden";
    textarea.addEventListener("input", () => {
      textarea.style.height = "auto";
      textarea.style.height = `${textarea.scrollHeight}px`;
    });
  });
}


/***/ })

}]);
//# sourceMappingURL=autoResizeTextarea.js.map