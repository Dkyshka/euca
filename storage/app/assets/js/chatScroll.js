"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["chatScroll"],{

/***/ "./helpers/chat-scroll.js":
/*!********************************!*\
  !*** ./helpers/chat-scroll.js ***!
  \********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   chatScroll: function() { return /* binding */ chatScroll; }
/* harmony export */ });
function chatScroll() {
  const chatWindow = document.querySelector(".chat-window");
  if (chatWindow) {
    chatWindow.scrollTop = chatWindow.scrollHeight;
  }
}


/***/ })

}]);
//# sourceMappingURL=chatScroll.js.map