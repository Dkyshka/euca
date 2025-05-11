"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["togglePasswordVisibility"],{

/***/ "./helpers/toggleVisability.js":
/*!*************************************!*\
  !*** ./helpers/toggleVisability.js ***!
  \*************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   togglePasswordVisibility: function() { return /* binding */ togglePasswordVisibility; }
/* harmony export */ });
function togglePasswordVisibility() {
  const toggleButtons = document.querySelectorAll(".btn-hide");
  if (toggleButtons.length > 0) {
    toggleButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const passwordInput = button.closest("label").querySelector('input[type="password"], input[type="text"]');
        const eyeIcon = button.querySelector(".btn-eye");
        const eyeCloseIcon = button.querySelector(".btn-eye-close");
        if (passwordInput) {
          if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.style.display = "none";
            eyeCloseIcon.style.display = "block";
          } else {
            passwordInput.type = "password";
            eyeIcon.style.display = "block";
            eyeCloseIcon.style.display = "none";
          }
        }
      });
    });
  }
}


/***/ })

}]);
//# sourceMappingURL=togglePasswordVisibility.js.map