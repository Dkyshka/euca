"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["accordions"],{

/***/ "./helpers/accordeons.js":
/*!*******************************!*\
  !*** ./helpers/accordeons.js ***!
  \*******************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   accordions: function() { return /* binding */ accordions; }
/* harmony export */ });
function accordions() {
  const accordionsContainer = document.querySelector(".accordions");
  if (!accordionsContainer) return;
  const accordionCards = Array.from(accordionsContainer.querySelectorAll(".accordions-card"));
  function closeAllAccordions(currentCard) {
    accordionCards.forEach((card) => {
      if (card !== currentCard && card.classList.contains("open")) {
        card.classList.remove("open");
      }
    });
  }
  function toggleAccordion(card) {
    closeAllAccordions(card);
    if (card.classList.contains("open")) {
      card.classList.remove("open");
    } else {
      card.classList.add("open");
    }
  }
  accordionCards.forEach((card) => {
    card.addEventListener("click", () => toggleAccordion(card));
  });
}


/***/ })

}]);
//# sourceMappingURL=accordions.js.map