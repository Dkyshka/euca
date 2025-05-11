"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["showContacts"],{

/***/ "./helpers/show-contacts.js":
/*!**********************************!*\
  !*** ./helpers/show-contacts.js ***!
  \**********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   showContacts: function() { return /* binding */ showContacts; }
/* harmony export */ });
function showContacts() {
  const showContactsBtns = document.querySelectorAll(".show-contacts_btn");
  if (!showContactsBtns) return;
  showContactsBtns.forEach(function(showContactsBtn) {
    const showInfoContactsDiv = showContactsBtn.nextElementSibling;
    if (showContactsBtn && showInfoContactsDiv) {
      showContactsBtn.addEventListener("click", function() {
        showContactsBtn.classList.add("hidden");
        showInfoContactsDiv.classList.add("show");
      });
    }
  });
}


/***/ })

}]);
//# sourceMappingURL=showContacts.js.map