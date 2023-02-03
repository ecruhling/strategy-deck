/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/styles/public.scss":
/*!***************************************!*\
  !*** ./assets/src/styles/public.scss ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*************************************!*\
  !*** ./assets/src/plugin-public.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_public_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/public.scss */ "./assets/src/styles/public.scss");
/* global sd_js_vars */

window.onload = () => {
  // Write in console log the PHP value passed in enqueue_js_vars in frontend/Enqueue.php
  (() => {
    jQuery('#example-demo-button').on('click', function () {
      jQuery.ajax({
        method: 'POST',
        url: window.location + 'wp-json/wp/v2/demo/example',
        data: {
          nonce: window.example_demo.nonce
        },
        beforeSend(xhr) {
          xhr.setRequestHeader('X-WP-Nonce', window.example_demo.wp_rest);
        }
      }).done(function (msg) {
        window.location.reload();
      }).fail(function (msg) {
        alert(window.example_demo.alert);
      });
    });
  })();

  // Place your public-facing JavaScript here
};
})();

/******/ })()
;
//# sourceMappingURL=plugin-public.js.map