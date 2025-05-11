"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["catalogTabs"],{

/***/ "./catalog-tabs.js":
/*!*************************!*\
  !*** ./catalog-tabs.js ***!
  \*************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   catalogTabs: function() { return /* binding */ catalogTabs; }
/* harmony export */ });
function catalogTabs() {
  const tabs = document.querySelectorAll(".catalog-tabs button");
  const inputRows = document.querySelectorAll(".input-row");
  const buttonDecor = document.querySelector(".button-decor");
  if (!tabs || !inputRows || !buttonDecor) return;
  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const target = tab.getAttribute("data-tab");
      inputRows.forEach((row) => {
        row.style.display = row.getAttribute("data-input") === target ? "flex" : "none";
      });
      tabs.forEach((button) => button.classList.remove("active"));
      tab.classList.add("active");
      const tabRect = tab.getBoundingClientRect();
      const tabsRect2 = tab.parentNode.getBoundingClientRect();
      buttonDecor.style.width = `${tabRect.width}px`;
      buttonDecor.style.transform = `translateX(${tabRect.left - tabsRect2.left}px)`;
    });
  });
  inputRows.forEach((row) => row.style.display = "none");
  const firstTab = tabs[0];
  firstTab.classList.add("active");
  document.querySelector(`.input-row[data-input="${firstTab.getAttribute("data-tab")}"]`).style.display = "flex";
  const firstTabRect = firstTab.getBoundingClientRect();
  const tabsRect = firstTab.parentNode.getBoundingClientRect();
  buttonDecor.style.width = `${firstTabRect.width}px`;
  buttonDecor.style.height = `${firstTabRect.height}px`;
  buttonDecor.style.transform = `translateX(${firstTabRect.left - tabsRect.left}px)`;
}


/***/ }),

/***/ "./filters-range.js":
/*!**************************!*\
  !*** ./filters-range.js ***!
  \**************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   filtersRange: function() { return /* binding */ filtersRange; }
/* harmony export */ });
function filtersRange() {
  const minValueInput = document.getElementById("minValue");
  const maxValueInput = document.getElementById("maxValue");
  const minHandler = document.querySelector(".min-hanler");
  const maxHandler = document.querySelector(".max-handler");
  const rangeWrapper = document.querySelector(".range-wrapper");
  const maxLimit = parseInt(maxValueInput.max) + 1;
  const rangeWidth = rangeWrapper.offsetWidth;
  const handlerWidth = minHandler.offsetWidth;
  function updateInputValue(input, handler) {
    const percentage = handler.offsetLeft / rangeWidth;
    const value = Math.round(percentage * maxLimit);
    input.value = value;
    const changeEvent = new Event("change");
    input.dispatchEvent(changeEvent);
  }
  function setInitialHandlerPositions() {
    const minValue = parseInt(minValueInput.value);
    const maxValue = parseInt(maxValueInput.value);
    const minPosition = minValue / maxLimit * rangeWidth;
    minHandler.style.left = `${minPosition}px`;
    updateInputValue(minValueInput, minHandler);
    const maxPosition = maxValue / maxLimit * rangeWidth;
    maxHandler.style.left = `${maxPosition}px`;
    updateInputValue(maxValueInput, maxHandler);
  }
  minHandler.addEventListener("pointerdown", (e) => {
    document.addEventListener("pointermove", onMouseMoveMin);
    document.addEventListener("pointerup", onMouseUp);
    minHandler.setPointerCapture(e.pointerId);
  });
  maxHandler.addEventListener("pointerdown", (e) => {
    document.addEventListener("pointermove", onMouseMoveMax);
    document.addEventListener("pointerup", onMouseUp);
    maxHandler.setPointerCapture(e.pointerId);
  });
  function onMouseMoveMin(e) {
    let newLeft = e.clientX - rangeWrapper.getBoundingClientRect().left - handlerWidth * 0.4;
    newLeft = Math.min(maxHandler.offsetLeft - handlerWidth * 0.4, Math.max(0, newLeft));
    minHandler.style.left = `${newLeft}px`;
    updateInputValue(minValueInput, minHandler);
  }
  function onMouseMoveMax(e) {
    let newLeft = e.clientX - rangeWrapper.getBoundingClientRect().left - handlerWidth * 0.4;
    newLeft = Math.max(minHandler.offsetLeft + handlerWidth * 0.4, Math.min(rangeWidth - handlerWidth * 0.6, newLeft));
    maxHandler.style.left = `${newLeft}px`;
    updateInputValue(maxValueInput, maxHandler);
  }
  function onMouseUp(e) {
    document.removeEventListener("pointermove", onMouseMoveMin);
    document.removeEventListener("pointermove", onMouseMoveMax);
    document.removeEventListener("pointerup", onMouseUp);
  }
  setInitialHandlerPositions();
}


/***/ })

}]);
//# sourceMappingURL=catalogTabs.js.map