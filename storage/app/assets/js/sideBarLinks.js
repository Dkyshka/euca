"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["sideBarLinks"],{

/***/ "./helpers/side-bar-links.js":
/*!***********************************!*\
  !*** ./helpers/side-bar-links.js ***!
  \***********************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   sideBarLinks: function() { return /* binding */ sideBarLinks; }
/* harmony export */ });
function sideBarLinks() {
  const menuRows = document.querySelectorAll(".side-bar__menu-row");
  let activeDropdown = null;
  menuRows.forEach((row) => {
    const clickableElement = row.querySelector("b") || row.querySelector("a");
    if (clickableElement) {
      clickableElement.addEventListener("click", (event) => {
        if (clickableElement.tagName === "A" && !row.nextElementSibling) {
          return;
        } else {
          event.preventDefault();
        }
        const associatedDropdown = row.nextElementSibling;
        if (associatedDropdown && associatedDropdown.classList.contains("dropdown-menu")) {
          if (activeDropdown && activeDropdown !== associatedDropdown) {
            activeDropdown.classList.remove("open");
            activeDropdown.previousElementSibling.classList.remove("open");
          }
          associatedDropdown.classList.toggle("open");
        }
        row.classList.toggle("open");
        if (associatedDropdown) {
          activeDropdown = associatedDropdown.classList.contains("open") ? associatedDropdown : null;
        } else {
          if (row.classList.contains("open")) {
            activeDropdown = null;
          } else {
            if (activeDropdown) {
              activeDropdown.classList.remove("open");
              activeDropdown.previousElementSibling.classList.remove("open");
              activeDropdown = null;
            }
          }
        }
        const isExpanded = row.classList.contains("open");
        row.setAttribute("aria-expanded", isExpanded);
        if (associatedDropdown) {
          associatedDropdown.setAttribute("aria-hidden", !isExpanded);
        }
      });
    }
  });
  document.addEventListener("click", (event) => {
    if (activeDropdown && !activeDropdown.contains(event.target) && !activeDropdown.previousElementSibling.contains(event.target)) {
      activeDropdown.classList.remove("open");
      activeDropdown.previousElementSibling.classList.remove("open");
      activeDropdown.previousElementSibling.setAttribute("aria-expanded", false);
      activeDropdown.setAttribute("aria-hidden", true);
      activeDropdown = null;
    }
  });
}


/***/ })

}]);
//# sourceMappingURL=sideBarLinks.js.map