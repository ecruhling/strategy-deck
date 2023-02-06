/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/block/edit.js":
/*!**********************************!*\
  !*** ./assets/src/block/edit.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Edit": () => (/* binding */ Edit)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);




const Edit = _ref => {
  let {
    clientId,
    isSelected,
    attributes: {
      id,
      word,
      style
    },
    setAttributes
  } = _ref;
  // useEffect sets the id once and only once.
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    // if id has not been created, create and set it
    // this ensures it is set only once, at block creation
    if (id.length === 0) {
      setAttributes({
        id: clientId
      });
    }
  }, []);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)({
    style: {
      style
    }
  }), {
    id: `deck-card-${id}`
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.RichText, {
    className: "form-check-label",
    for: `${id}-input`,
    tagName: "label",
    value: word,
    onChange: value => setAttributes({
      word: value
    }),
    style: isSelected ? {
      border: '1px dashed black'
    } : {
      border: 'none'
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("input", {
    id: `${id}-input`,
    name: `${id}-input`,
    type: "checkbox"
  }));
};

/***/ }),

/***/ "./assets/src/block/icon.js":
/*!**********************************!*\
  !*** ./assets/src/block/icon.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "blockIcon": () => (/* binding */ blockIcon)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

const blockIcon = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
  height: "24",
  viewBox: "0 0 24 24",
  width: "24",
  xmlns: "http://www.w3.org/2000/svg"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
  d: "m.28 9.71c-.58-1-.23-2.28.76-2.85l7.23-4.17c1-.58 2.28-.23 2.85.76l6.26 10.85c.57 1 .23 2.28-.76 2.85l-7.23 4.17c-1 .58-2.27.24-2.85-.76zm1.56-.9 6.26 10.85c.08.13.25.18.39.07l7.23-4.14c.14-.08.18-.26.11-.39l-6.26-10.86c-.08-.13-.26-.18-.39-.1l-7.24 4.17c-.13.08-.18.26-.1.4zm16.59 4.88-5.13-8.88c.07-.01.13-.04.2-.04h8.4c1.16 0 2.1.97 2.1 2.1v12.63c0 1.16-.94 2.1-2.1 2.1h-8.4c-.51 0-.98-.18-1.35-.52l5.07-2.9c1.58-.9 2.12-2.91 1.21-4.49z"
}), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
  d: "m0 0h24v24h-24z",
  fill: "none"
}));

/***/ }),

/***/ "./assets/src/block/index.js":
/*!***********************************!*\
  !*** ./assets/src/block/index.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _icon__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./icon */ "./assets/src/block/icon.js");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./assets/src/block/edit.js");
/**
 * WordPress dependencies
 */



// The block configuration
const blockConfig = __webpack_require__(/*! ./block.json */ "./assets/src/block/block.json");

// not used because this is a dynamic block (render-block.php creates the front end markup)
// import { Save } from './save';

// Register the block
/// https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(blockConfig.name, {
  ...blockConfig,
  icon: _icon__WEBPACK_IMPORTED_MODULE_1__.blockIcon,
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__.Edit,
  // save: Save,
  save: () => null
});

/***/ }),

/***/ "./assets/src/styles/block.scss":
/*!**************************************!*\
  !*** ./assets/src/styles/block.scss ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/esm/extends.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/esm/extends.js ***!
  \************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _extends)
/* harmony export */ });
function _extends() {
  _extends = Object.assign ? Object.assign.bind() : function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];
      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }
    return target;
  };
  return _extends.apply(this, arguments);
}

/***/ }),

/***/ "./assets/src/block/block.json":
/*!*************************************!*\
  !*** ./assets/src/block/block.json ***!
  \*************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"strategydeck/deck-card","title":"Deck Card","category":"text","description":"A Deck Card used with the Strategy Deck plugin.","keywords":["card","strategy","deck"],"version":"1.0.0","textdomain":"strategydeck","attributes":{"id":{"type":"string","default":""},"word":{"type":"string","default":"Word"},"style":{"type":"object","default":{"color":{"background":"#fff9f1","text":"#b1a57e"}}}},"supports":{"jsx":true,"anchor":false,"align":false,"alignContent":false,"alignText":false,"alignWide":false,"className":false,"color":{"background":true,"__experimentalDuotone":false,"gradients":false,"link":false,"text":true},"customClassName":true,"fullHeight":false,"defaultStylePicker":false,"html":true,"inserter":true,"multiple":true,"reusable":true,"lock":true,"spacing":{"margin":false,"padding":false,"blockGap":false},"typography":{"fontSize":true,"lineHeight":false}},"editorScript":"file:../../build/plugin-block.js","viewScript":"file:../../build/plugin-view.js","editorStyle":"file:../../build/plugin-block.css","style":"file:../../build/plugin-block.css","render":"file:./render-block.php"}');

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
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
/*!************************************!*\
  !*** ./assets/src/plugin-block.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_block_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/block.scss */ "./assets/src/styles/block.scss");
/* harmony import */ var _block_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block/index */ "./assets/src/block/index.js");


})();

/******/ })()
;
//# sourceMappingURL=plugin-block.js.map