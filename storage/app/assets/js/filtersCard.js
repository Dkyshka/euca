"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["filtersCard"],{

/***/ "./helpers/members.js":
/*!****************************!*\
  !*** ./helpers/members.js ***!
  \****************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   filtersCard: function() { return /* binding */ filtersCard; },
/* harmony export */   membersCard: function() { return /* binding */ membersCard; }
/* harmony export */ });
function membersCard() {
  const catalogNewMembers = document.querySelector(".catalog-new-members");
  const membersTitle = document.querySelector(".members-title");
  const filtersWrapper = document.querySelector(".filters-wrapper");
  if (catalogNewMembers && membersTitle && filtersWrapper) {
    membersTitle.addEventListener("click", () => {
      catalogNewMembers.classList.toggle("open");
      if (filtersWrapper.classList.contains("open")) {
        filtersWrapper.classList.remove("open");
      }
    });
  }
}
function filtersCard() {
  const filtersWrapper = document.querySelector(".filters-wrapper");
  const filtersTitle = document.querySelector(".filters-title");
  const catalogNewMembers = document.querySelector(".catalog-new-members");
  if (filtersWrapper && filtersTitle && catalogNewMembers) {
    filtersTitle.addEventListener("click", () => {
      filtersWrapper.classList.toggle("open");
      if (catalogNewMembers.classList.contains("open")) {
        catalogNewMembers.classList.remove("open");
      }
    });
  }
}


/***/ })

}]);
//# sourceMappingURL=filtersCard.js.map