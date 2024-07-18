/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

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
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

/**
 * Main index.js file.
 * 
 * @since 0.1.0
 */

/**
 * Define consts.
 */
//import classnames from 'classnames';
const {
  assign,
  merge
} = lodash;
const {
  __
} = wp.i18n;
const {
  addFilter
} = wp.hooks;
const {
  createHigherOrderComponent
} = wp.compose;
const {
  Fragment
} = wp.element;
const {
  InspectorControls
} = wp.blockEditor;
const {
  PanelBody,
  SelectControl,
  RangeControl,
  CheckboxControl
} = wp.components;

/**
 * Add animation attributes.
 * 
 * Add the attributes we need.
 * 
 * @param   {Object} settings Original block settings.
 * @param   {string} name 	Block name.
 * @returns {Object}		Filtered block settings.
 */
function addAnimationAtts(settings, name) {
  return assign({}, settings, {
    attributes: merge(settings.attributes, {
      animation_name: {
        type: 'string',
        default: ''
      },
      animation_delay: {
        type: 'string',
        default: ''
      },
      animation_duration: {
        type: 'string',
        default: ''
      },
      animation_repeat: {
        type: 'string',
        default: ''
      },
      reset_view: {
        type: 'boolean',
        default: ''
      }
    })
  });
}
addFilter('blocks.registerBlockType', 'wonder-animations/add-animation-atts', addAnimationAtts);

/**
 * Add the controls for the attributes.
 * 
 * @since 0.13.0 Changing controls to fully use animate.css (animate.style) classes.
 * @since 0.6.0  Removed toUpperCase().
 */
const addAnimationAttributeControls = createHigherOrderComponent(BlockEdit => {
  return props => {
    const {
      attributes: {
        animation_name,
        animation_delay,
        animation_duration,
        animation_repeat,
        reset_view
      },
      setAttributes
    } = props;
    const presetAnimations = wonderAnimations;
    const animationOptions = [{
      label: '',
      value: ''
    }];
    for (let i = 0; i < presetAnimations.length; i++) {
      console.log(presetAnimations[i]);
      animationOptions.push({
        label: presetAnimations[i],
        value: presetAnimations[i]
      });
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(BlockEdit, {
      ...props
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(PanelBody, {
      title: __('Animation', 'wonder-animations'),
      initialOpen: false
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(SelectControl, {
      label: __('Name', 'wonder-animations'),
      value: animation_name,
      options: animationOptions,
      onChange: value => setAttributes({
        animation_name: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(SelectControl, {
      label: __('Delay', 'wonder-animations'),
      value: animation_delay,
      options: [{
        label: '',
        value: ''
      }, {
        label: __('2s', 'wonder-animations'),
        value: 'delay-2s'
      }, {
        label: __('3s', 'wonder-animations'),
        value: 'delay-3s'
      }, {
        label: __('4s', 'wonder-animations'),
        value: 'delay-4s'
      }, {
        label: __('5s', 'wonder-animations'),
        value: 'delay-5s'
      }],
      onChange: value => setAttributes({
        animation_delay: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(SelectControl, {
      label: __('Duration', 'wonder-animations'),
      value: animation_duration,
      options: [{
        label: '',
        value: ''
      }, {
        label: __('Slower', 'wonder-animations'),
        value: 'slower'
      }, {
        label: __('Slow', 'wonder-animations'),
        value: 'slow'
      }, {
        label: __('Fast', 'wonder-animations'),
        value: 'fast'
      }, {
        label: __('Faster', 'wonder-animations'),
        value: 'faster'
      }],
      onChange: value => setAttributes({
        animation_duration: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(SelectControl, {
      label: __('Repeat', 'wonder-animations'),
      value: animation_repeat,
      options: [{
        label: '',
        value: ''
      }, {
        label: __('1', 'wonder-animations'),
        value: 'repeat-1'
      }, {
        label: __('2', 'wonder-animations'),
        value: 'repeat-2'
      }, {
        label: __('3', 'wonder-animations'),
        value: 'repeat-3'
      }, {
        label: __('Infinite', 'wonder-animations'),
        value: 'infinite'
      }],
      onChange: value => setAttributes({
        animation_repeat: value
      })
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(CheckboxControl, {
      label: __('Reset view', 'wonder-animations'),
      help: __('Should we reset the view after leaving the viewport?', 'wonder-animations'),
      checked: reset_view,
      onChange: value => setAttributes({
        reset_view: value
      })
    }))));
  };
}, 'addAnimationAttributeControls');
addFilter('editor.BlockEdit', 'wonder-animations/add-animation-attribute-controls', addAnimationAttributeControls);
/******/ })()
;
//# sourceMappingURL=index.js.map