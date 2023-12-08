function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (typeof call === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["default~modules-accountsettings-accountsettings-module~modules-profilemanagement-profilemanagement-module"], {
  /***/
  "./node_modules/angularx-qrcode/__ivy_ngcc__/fesm2015/angularx-qrcode.js":
  /*!*******************************************************************************!*\
    !*** ./node_modules/angularx-qrcode/__ivy_ngcc__/fesm2015/angularx-qrcode.js ***!
    \*******************************************************************************/

  /*! exports provided: QRCodeComponent, QRCodeModule */

  /***/
  function node_modulesAngularxQrcode__ivy_ngcc__Fesm2015AngularxQrcodeJs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "QRCodeComponent", function () {
      return QRCodeComponent;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "QRCodeModule", function () {
      return QRCodeModule;
    });
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var qrcode__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! qrcode */
    "./node_modules/qrcode/lib/browser.js");
    /* harmony import */


    var qrcode__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(qrcode__WEBPACK_IMPORTED_MODULE_1__);

    var _c0 = ["qrcElement"];

    var QRCodeComponent = /*#__PURE__*/function () {
      function QRCodeComponent(renderer) {
        _classCallCheck(this, QRCodeComponent);

        this.renderer = renderer; // Deprecated

        this.colordark = '';
        this.colorlight = '';
        this.level = '';
        this.hidetitle = false;
        this.size = 0;
        this.usesvg = false; // Valid for 1.x and 2.x

        this.allowEmptyString = false;
        this.qrdata = ''; // New fields introduced in 2.0.0

        this.colorDark = '#000000ff';
        this.colorLight = '#ffffffff';
        this.cssClass = 'qrcode';
        this.elementType = 'canvas';
        this.errorCorrectionLevel = 'M';
        this.margin = 4;
        this.scale = 4;
        this.width = 10; // Deprecation warnings

        if (this.colordark !== '') {
          console.warn('[angularx-qrcode] colordark is deprecated, use colorDark.');
        }

        if (this.colorlight !== '') {
          console.warn('[angularx-qrcode] colorlight is deprecated, use colorLight.');
        }

        if (this.level !== '') {
          console.warn('[angularx-qrcode] level is deprecated, use errorCorrectionLevel.');
        }

        if (this.hidetitle !== false) {
          console.warn('[angularx-qrcode] hidetitle is deprecated.');
        }

        if (this.size !== 0) {
          console.warn('[angularx-qrcode] size is deprecated, use `width`. Defaults to 10.');
        }

        if (this.usesvg !== false) {
          console.warn("[angularx-qrcode] usesvg is deprecated, use [elementType]=\"'svg'\".");
        }
      }

      _createClass(QRCodeComponent, [{
        key: "ngOnChanges",
        value: function ngOnChanges() {
          this.createQRCode();
        }
      }, {
        key: "isValidQrCodeText",
        value: function isValidQrCodeText(data) {
          if (this.allowEmptyString === false) {
            return !(typeof data === 'undefined' || data === '' || data === 'null' || data === null);
          }

          return !(typeof data === 'undefined');
        }
      }, {
        key: "toDataURL",
        value: function toDataURL() {
          var _this = this;

          return new Promise(function (resolve, reject) {
            Object(qrcode__WEBPACK_IMPORTED_MODULE_1__["toDataURL"])(_this.qrdata, {
              color: {
                dark: _this.colorDark,
                light: _this.colorLight
              },
              errorCorrectionLevel: _this.errorCorrectionLevel,
              margin: _this.margin,
              scale: _this.scale,
              version: _this.version,
              width: _this.width
            }, function (err, url) {
              if (err) {
                reject(err);
              } else {
                resolve(url);
              }
            });
          });
        }
      }, {
        key: "toCanvas",
        value: function toCanvas(canvas) {
          var _this2 = this;

          return new Promise(function (resolve, reject) {
            Object(qrcode__WEBPACK_IMPORTED_MODULE_1__["toCanvas"])(canvas, _this2.qrdata, {
              color: {
                dark: _this2.colorDark,
                light: _this2.colorLight
              },
              errorCorrectionLevel: _this2.errorCorrectionLevel,
              margin: _this2.margin,
              scale: _this2.scale,
              version: _this2.version,
              width: _this2.width
            }, function (error) {
              if (error) {
                reject(error);
              } else {
                resolve('success');
              }
            });
          });
        }
      }, {
        key: "toSVG",
        value: function toSVG() {
          var _this3 = this;

          return new Promise(function (resolve, reject) {
            Object(qrcode__WEBPACK_IMPORTED_MODULE_1__["toString"])(_this3.qrdata, {
              color: {
                dark: _this3.colorDark,
                light: _this3.colorLight
              },
              errorCorrectionLevel: _this3.errorCorrectionLevel,
              margin: _this3.margin,
              scale: _this3.scale,
              type: 'svg',
              version: _this3.version,
              width: _this3.width
            }, function (err, url) {
              if (err) {
                reject(err);
              } else {
                resolve(url);
              }
            });
          });
        }
      }, {
        key: "renderElement",
        value: function renderElement(element) {
          var _iterator = _createForOfIteratorHelper(this.qrcElement.nativeElement.childNodes),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var node = _step.value;
              this.renderer.removeChild(this.qrcElement.nativeElement, node);
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }

          this.renderer.appendChild(this.qrcElement.nativeElement, element);
        }
      }, {
        key: "createQRCode",
        value: function createQRCode() {
          var _this4 = this;

          // Set sensitive defaults
          if (this.version && this.version > 40) {
            console.warn('[angularx-qrcode] max value for `version` is 40');
            this.version = 40;
          } else if (this.version && this.version < 1) {
            console.warn('[angularx-qrcode]`min value for `version` is 1');
            this.version = 1;
          } else if (this.version !== undefined && isNaN(this.version)) {
            console.warn('[angularx-qrcode] version should be a number, defaulting to auto.');
            this.version = undefined;
          }

          try {
            if (!this.isValidQrCodeText(this.qrdata)) {
              throw new Error('[angularx-qrcode] Field `qrdata` is empty, set`allowEmptyString="true"` to overwrite this behaviour.');
            }

            var element;

            switch (this.elementType) {
              case 'canvas':
                element = this.renderer.createElement('canvas');
                this.toCanvas(element).then(function () {
                  _this4.renderElement(element);
                })["catch"](function (e) {
                  console.error('[angularx-qrcode] canvas error: ', e);
                });
                break;

              case 'svg':
                element = this.renderer.createElement('div');
                this.toSVG().then(function (svgString) {
                  _this4.renderer.setProperty(element, 'innerHTML', svgString);

                  var innerElement = element.firstChild;

                  _this4.renderer.setAttribute(innerElement, 'height', "".concat(_this4.width));

                  _this4.renderer.setAttribute(innerElement, 'width', "".concat(_this4.width));

                  _this4.renderElement(innerElement);
                })["catch"](function (e) {
                  console.error('[angularx-qrcode] svg error: ', e);
                });
                break;

              case 'url':
              case 'img':
              default:
                element = this.renderer.createElement('img');
                this.toDataURL().then(function (dataUrl) {
                  element.setAttribute('src', dataUrl);

                  _this4.renderElement(element);
                })["catch"](function (e) {
                  console.error('[angularx-qrcode] img/url error: ', e);
                });
            }
          } catch (e) {
            console.error('[angularx-qrcode] Error generating QR Code: ', e.message);
          }
        }
      }]);

      return QRCodeComponent;
    }();

    QRCodeComponent.ɵfac = function QRCodeComponent_Factory(t) {
      return new (t || QRCodeComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_core__WEBPACK_IMPORTED_MODULE_0__["Renderer2"]));
    };

    QRCodeComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({
      type: QRCodeComponent,
      selectors: [["qrcode"]],
      viewQuery: function QRCodeComponent_Query(rf, ctx) {
        if (rf & 1) {
          _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵstaticViewQuery"](_c0, true);
        }

        if (rf & 2) {
          var _t;

          _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵloadQuery"]()) && (ctx.qrcElement = _t.first);
        }
      },
      inputs: {
        colordark: "colordark",
        colorlight: "colorlight",
        level: "level",
        hidetitle: "hidetitle",
        size: "size",
        usesvg: "usesvg",
        allowEmptyString: "allowEmptyString",
        qrdata: "qrdata",
        colorDark: "colorDark",
        colorLight: "colorLight",
        cssClass: "cssClass",
        elementType: "elementType",
        errorCorrectionLevel: "errorCorrectionLevel",
        margin: "margin",
        scale: "scale",
        width: "width",
        version: "version"
      },
      features: [_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵNgOnChangesFeature"]],
      decls: 2,
      vars: 2,
      consts: [["qrcElement", ""]],
      template: function QRCodeComponent_Template(rf, ctx) {
        if (rf & 1) {
          _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "div", null, 0);
        }

        if (rf & 2) {
          _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵclassMap"](ctx.cssClass);
        }
      },
      encapsulation: 2,
      changeDetection: 0
    });

    QRCodeComponent.ctorParameters = function () {
      return [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Renderer2"]
      }];
    };

    QRCodeComponent.propDecorators = {
      colordark: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      colorlight: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      level: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      hidetitle: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      size: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      usesvg: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      allowEmptyString: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      qrdata: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      colorDark: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      colorLight: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      cssClass: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      elementType: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      errorCorrectionLevel: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      margin: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      scale: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      version: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      width: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
      }],
      qrcElement: [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"],
        args: ['qrcElement', {
          "static": true
        }]
      }]
    };
    /*@__PURE__*/

    (function () {
      _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](QRCodeComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
          selector: 'qrcode',
          changeDetection: _angular_core__WEBPACK_IMPORTED_MODULE_0__["ChangeDetectionStrategy"].OnPush,
          template: "<div #qrcElement [class]=\"cssClass\"></div>"
        }]
      }], function () {
        return [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Renderer2"]
        }];
      }, {
        colordark: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        colorlight: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        level: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        hidetitle: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        size: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        usesvg: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        allowEmptyString: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        qrdata: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        colorDark: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        colorLight: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        cssClass: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        elementType: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        errorCorrectionLevel: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        margin: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        scale: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        width: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        version: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }],
        qrcElement: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"],
          args: ['qrcElement', {
            "static": true
          }]
        }]
      });
    })();

    var QRCodeModule = /*#__PURE__*/_createClass(function QRCodeModule() {
      _classCallCheck(this, QRCodeModule);
    });

    QRCodeModule.ɵmod = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineNgModule"]({
      type: QRCodeModule
    });
    QRCodeModule.ɵinj = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjector"]({
      factory: function QRCodeModule_Factory(t) {
        return new (t || QRCodeModule)();
      },
      providers: []
    });

    (function () {
      (typeof ngJitMode === "undefined" || ngJitMode) && _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsetNgModuleScope"](QRCodeModule, {
        declarations: [QRCodeComponent],
        exports: [QRCodeComponent]
      });
    })();
    /*@__PURE__*/


    (function () {
      _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](QRCodeModule, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"],
        args: [{
          providers: [],
          declarations: [QRCodeComponent],
          exports: [QRCodeComponent]
        }]
      }], null, null);
    })();
    /*
     * Public API Surface of angularx-qrcode
     */

    /**
     * Generated bundle index. Do not edit.
     */
    //# sourceMappingURL=angularx-qrcode.js.map

    /***/

  },

  /***/
  "./node_modules/dijkstrajs/dijkstra.js":
  /*!*********************************************!*\
    !*** ./node_modules/dijkstrajs/dijkstra.js ***!
    \*********************************************/

  /*! no static exports found */

  /***/
  function node_modulesDijkstrajsDijkstraJs(module, exports, __webpack_require__) {
    "use strict";
    /******************************************************************************
     * Created 2008-08-19.
     *
     * Dijkstra path-finding functions. Adapted from the Dijkstar Python project.
     *
     * Copyright (C) 2008
     *   Wyatt Baldwin <self@wyattbaldwin.com>
     *   All rights reserved
     *
     * Licensed under the MIT license.
     *
     *   http://www.opensource.org/licenses/mit-license.php
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
     *****************************************************************************/

    var dijkstra = {
      single_source_shortest_paths: function single_source_shortest_paths(graph, s, d) {
        // Predecessor map for each node that has been encountered.
        // node ID => predecessor node ID
        var predecessors = {}; // Costs of shortest paths from s to all nodes encountered.
        // node ID => cost

        var costs = {};
        costs[s] = 0; // Costs of shortest paths from s to all nodes encountered; differs from
        // `costs` in that it provides easy access to the node that currently has
        // the known shortest path from s.
        // XXX: Do we actually need both `costs` and `open`?

        var open = dijkstra.PriorityQueue.make();
        open.push(s, 0);
        var closest, u, v, cost_of_s_to_u, adjacent_nodes, cost_of_e, cost_of_s_to_u_plus_cost_of_e, cost_of_s_to_v, first_visit;

        while (!open.empty()) {
          // In the nodes remaining in graph that have a known cost from s,
          // find the node, u, that currently has the shortest path from s.
          closest = open.pop();
          u = closest.value;
          cost_of_s_to_u = closest.cost; // Get nodes adjacent to u...

          adjacent_nodes = graph[u] || {}; // ...and explore the edges that connect u to those nodes, updating
          // the cost of the shortest paths to any or all of those nodes as
          // necessary. v is the node across the current edge from u.

          for (v in adjacent_nodes) {
            if (adjacent_nodes.hasOwnProperty(v)) {
              // Get the cost of the edge running from u to v.
              cost_of_e = adjacent_nodes[v]; // Cost of s to u plus the cost of u to v across e--this is *a*
              // cost from s to v that may or may not be less than the current
              // known cost to v.

              cost_of_s_to_u_plus_cost_of_e = cost_of_s_to_u + cost_of_e; // If we haven't visited v yet OR if the current known cost from s to
              // v is greater than the new cost we just found (cost of s to u plus
              // cost of u to v across e), update v's cost in the cost list and
              // update v's predecessor in the predecessor list (it's now u).

              cost_of_s_to_v = costs[v];
              first_visit = typeof costs[v] === 'undefined';

              if (first_visit || cost_of_s_to_v > cost_of_s_to_u_plus_cost_of_e) {
                costs[v] = cost_of_s_to_u_plus_cost_of_e;
                open.push(v, cost_of_s_to_u_plus_cost_of_e);
                predecessors[v] = u;
              }
            }
          }
        }

        if (typeof d !== 'undefined' && typeof costs[d] === 'undefined') {
          var msg = ['Could not find a path from ', s, ' to ', d, '.'].join('');
          throw new Error(msg);
        }

        return predecessors;
      },
      extract_shortest_path_from_predecessor_list: function extract_shortest_path_from_predecessor_list(predecessors, d) {
        var nodes = [];
        var u = d;
        var predecessor;

        while (u) {
          nodes.push(u);
          predecessor = predecessors[u];
          u = predecessors[u];
        }

        nodes.reverse();
        return nodes;
      },
      find_path: function find_path(graph, s, d) {
        var predecessors = dijkstra.single_source_shortest_paths(graph, s, d);
        return dijkstra.extract_shortest_path_from_predecessor_list(predecessors, d);
      },

      /**
       * A very naive priority queue implementation.
       */
      PriorityQueue: {
        make: function make(opts) {
          var T = dijkstra.PriorityQueue,
              t = {},
              key;
          opts = opts || {};

          for (key in T) {
            if (T.hasOwnProperty(key)) {
              t[key] = T[key];
            }
          }

          t.queue = [];
          t.sorter = opts.sorter || T.default_sorter;
          return t;
        },
        default_sorter: function default_sorter(a, b) {
          return a.cost - b.cost;
        },

        /**
         * Add a new item to the queue and ensure the highest priority element
         * is at the front of the queue.
         */
        push: function push(value, cost) {
          var item = {
            value: value,
            cost: cost
          };
          this.queue.push(item);
          this.queue.sort(this.sorter);
        },

        /**
         * Return the highest priority element in the queue.
         */
        pop: function pop() {
          return this.queue.shift();
        },
        empty: function empty() {
          return this.queue.length === 0;
        }
      }
    }; // node.js module exports

    if (true) {
      module.exports = dijkstra;
    }
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/browser.js":
  /*!********************************************!*\
    !*** ./node_modules/qrcode/lib/browser.js ***!
    \********************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibBrowserJs(module, exports, __webpack_require__) {
    var canPromise = __webpack_require__(
    /*! ./can-promise */
    "./node_modules/qrcode/lib/can-promise.js");

    var QRCode = __webpack_require__(
    /*! ./core/qrcode */
    "./node_modules/qrcode/lib/core/qrcode.js");

    var CanvasRenderer = __webpack_require__(
    /*! ./renderer/canvas */
    "./node_modules/qrcode/lib/renderer/canvas.js");

    var SvgRenderer = __webpack_require__(
    /*! ./renderer/svg-tag.js */
    "./node_modules/qrcode/lib/renderer/svg-tag.js");

    function renderCanvas(renderFunc, canvas, text, opts, cb) {
      var args = [].slice.call(arguments, 1);
      var argsNum = args.length;
      var isLastArgCb = typeof args[argsNum - 1] === 'function';

      if (!isLastArgCb && !canPromise()) {
        throw new Error('Callback required as last argument');
      }

      if (isLastArgCb) {
        if (argsNum < 2) {
          throw new Error('Too few arguments provided');
        }

        if (argsNum === 2) {
          cb = text;
          text = canvas;
          canvas = opts = undefined;
        } else if (argsNum === 3) {
          if (canvas.getContext && typeof cb === 'undefined') {
            cb = opts;
            opts = undefined;
          } else {
            cb = opts;
            opts = text;
            text = canvas;
            canvas = undefined;
          }
        }
      } else {
        if (argsNum < 1) {
          throw new Error('Too few arguments provided');
        }

        if (argsNum === 1) {
          text = canvas;
          canvas = opts = undefined;
        } else if (argsNum === 2 && !canvas.getContext) {
          opts = text;
          text = canvas;
          canvas = undefined;
        }

        return new Promise(function (resolve, reject) {
          try {
            var data = QRCode.create(text, opts);
            resolve(renderFunc(data, canvas, opts));
          } catch (e) {
            reject(e);
          }
        });
      }

      try {
        var data = QRCode.create(text, opts);
        cb(null, renderFunc(data, canvas, opts));
      } catch (e) {
        cb(e);
      }
    }

    exports.create = QRCode.create;
    exports.toCanvas = renderCanvas.bind(null, CanvasRenderer.render);
    exports.toDataURL = renderCanvas.bind(null, CanvasRenderer.renderToDataURL); // only svg for now.

    exports.toString = renderCanvas.bind(null, function (data, _, opts) {
      return SvgRenderer.render(data, opts);
    });
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/can-promise.js":
  /*!************************************************!*\
    !*** ./node_modules/qrcode/lib/can-promise.js ***!
    \************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCanPromiseJs(module, exports) {
    // can-promise has a crash in some versions of react native that dont have
    // standard global objects
    // https://github.com/soldair/node-qrcode/issues/157
    module.exports = function () {
      return typeof Promise === 'function' && Promise.prototype && Promise.prototype.then;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/alignment-pattern.js":
  /*!***********************************************************!*\
    !*** ./node_modules/qrcode/lib/core/alignment-pattern.js ***!
    \***********************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreAlignmentPatternJs(module, exports, __webpack_require__) {
    /**
     * Alignment pattern are fixed reference pattern in defined positions
     * in a matrix symbology, which enables the decode software to re-synchronise
     * the coordinate mapping of the image modules in the event of moderate amounts
     * of distortion of the image.
     *
     * Alignment patterns are present only in QR Code symbols of version 2 or larger
     * and their number depends on the symbol version.
     */
    var getSymbolSize = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/core/utils.js").getSymbolSize;
    /**
     * Calculate the row/column coordinates of the center module of each alignment pattern
     * for the specified QR Code version.
     *
     * The alignment patterns are positioned symmetrically on either side of the diagonal
     * running from the top left corner of the symbol to the bottom right corner.
     *
     * Since positions are simmetrical only half of the coordinates are returned.
     * Each item of the array will represent in turn the x and y coordinate.
     * @see {@link getPositions}
     *
     * @param  {Number} version QR Code version
     * @return {Array}          Array of coordinate
     */


    exports.getRowColCoords = function getRowColCoords(version) {
      if (version === 1) return [];
      var posCount = Math.floor(version / 7) + 2;
      var size = getSymbolSize(version);
      var intervals = size === 145 ? 26 : Math.ceil((size - 13) / (2 * posCount - 2)) * 2;
      var positions = [size - 7]; // Last coord is always (size - 7)

      for (var i = 1; i < posCount - 1; i++) {
        positions[i] = positions[i - 1] - intervals;
      }

      positions.push(6); // First coord is always 6

      return positions.reverse();
    };
    /**
     * Returns an array containing the positions of each alignment pattern.
     * Each array's element represent the center point of the pattern as (x, y) coordinates
     *
     * Coordinates are calculated expanding the row/column coordinates returned by {@link getRowColCoords}
     * and filtering out the items that overlaps with finder pattern
     *
     * @example
     * For a Version 7 symbol {@link getRowColCoords} returns values 6, 22 and 38.
     * The alignment patterns, therefore, are to be centered on (row, column)
     * positions (6,22), (22,6), (22,22), (22,38), (38,22), (38,38).
     * Note that the coordinates (6,6), (6,38), (38,6) are occupied by finder patterns
     * and are not therefore used for alignment patterns.
     *
     * var pos = getPositions(7)
     * // [[6,22], [22,6], [22,22], [22,38], [38,22], [38,38]]
     *
     * @param  {Number} version QR Code version
     * @return {Array}          Array of coordinates
     */


    exports.getPositions = function getPositions(version) {
      var coords = [];
      var pos = exports.getRowColCoords(version);
      var posLength = pos.length;

      for (var i = 0; i < posLength; i++) {
        for (var j = 0; j < posLength; j++) {
          // Skip if position is occupied by finder patterns
          if (i === 0 && j === 0 || // top-left
          i === 0 && j === posLength - 1 || // bottom-left
          i === posLength - 1 && j === 0) {
            // top-right
            continue;
          }

          coords.push([pos[i], pos[j]]);
        }
      }

      return coords;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/alphanumeric-data.js":
  /*!***********************************************************!*\
    !*** ./node_modules/qrcode/lib/core/alphanumeric-data.js ***!
    \***********************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreAlphanumericDataJs(module, exports, __webpack_require__) {
    var Mode = __webpack_require__(
    /*! ./mode */
    "./node_modules/qrcode/lib/core/mode.js");
    /**
     * Array of characters available in alphanumeric mode
     *
     * As per QR Code specification, to each character
     * is assigned a value from 0 to 44 which in this case coincides
     * with the array index
     *
     * @type {Array}
     */


    var ALPHA_NUM_CHARS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', ' ', '$', '%', '*', '+', '-', '.', '/', ':'];

    function AlphanumericData(data) {
      this.mode = Mode.ALPHANUMERIC;
      this.data = data;
    }

    AlphanumericData.getBitsLength = function getBitsLength(length) {
      return 11 * Math.floor(length / 2) + 6 * (length % 2);
    };

    AlphanumericData.prototype.getLength = function getLength() {
      return this.data.length;
    };

    AlphanumericData.prototype.getBitsLength = function getBitsLength() {
      return AlphanumericData.getBitsLength(this.data.length);
    };

    AlphanumericData.prototype.write = function write(bitBuffer) {
      var i; // Input data characters are divided into groups of two characters
      // and encoded as 11-bit binary codes.

      for (i = 0; i + 2 <= this.data.length; i += 2) {
        // The character value of the first character is multiplied by 45
        var value = ALPHA_NUM_CHARS.indexOf(this.data[i]) * 45; // The character value of the second digit is added to the product

        value += ALPHA_NUM_CHARS.indexOf(this.data[i + 1]); // The sum is then stored as 11-bit binary number

        bitBuffer.put(value, 11);
      } // If the number of input data characters is not a multiple of two,
      // the character value of the final character is encoded as a 6-bit binary number.


      if (this.data.length % 2) {
        bitBuffer.put(ALPHA_NUM_CHARS.indexOf(this.data[i]), 6);
      }
    };

    module.exports = AlphanumericData;
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/core/bit-buffer.js":
  /*!****************************************************!*\
    !*** ./node_modules/qrcode/lib/core/bit-buffer.js ***!
    \****************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreBitBufferJs(module, exports) {
    function BitBuffer() {
      this.buffer = [];
      this.length = 0;
    }

    BitBuffer.prototype = {
      get: function get(index) {
        var bufIndex = Math.floor(index / 8);
        return (this.buffer[bufIndex] >>> 7 - index % 8 & 1) === 1;
      },
      put: function put(num, length) {
        for (var i = 0; i < length; i++) {
          this.putBit((num >>> length - i - 1 & 1) === 1);
        }
      },
      getLengthInBits: function getLengthInBits() {
        return this.length;
      },
      putBit: function putBit(bit) {
        var bufIndex = Math.floor(this.length / 8);

        if (this.buffer.length <= bufIndex) {
          this.buffer.push(0);
        }

        if (bit) {
          this.buffer[bufIndex] |= 0x80 >>> this.length % 8;
        }

        this.length++;
      }
    };
    module.exports = BitBuffer;
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/core/bit-matrix.js":
  /*!****************************************************!*\
    !*** ./node_modules/qrcode/lib/core/bit-matrix.js ***!
    \****************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreBitMatrixJs(module, exports, __webpack_require__) {
    var Buffer = __webpack_require__(
    /*! ../utils/buffer */
    "./node_modules/qrcode/lib/utils/typedarray-buffer.js");
    /**
     * Helper class to handle QR Code symbol modules
     *
     * @param {Number} size Symbol size
     */


    function BitMatrix(size) {
      if (!size || size < 1) {
        throw new Error('BitMatrix size must be defined and greater than 0');
      }

      this.size = size;
      this.data = new Buffer(size * size);
      this.data.fill(0);
      this.reservedBit = new Buffer(size * size);
      this.reservedBit.fill(0);
    }
    /**
     * Set bit value at specified location
     * If reserved flag is set, this bit will be ignored during masking process
     *
     * @param {Number}  row
     * @param {Number}  col
     * @param {Boolean} value
     * @param {Boolean} reserved
     */


    BitMatrix.prototype.set = function (row, col, value, reserved) {
      var index = row * this.size + col;
      this.data[index] = value;
      if (reserved) this.reservedBit[index] = true;
    };
    /**
     * Returns bit value at specified location
     *
     * @param  {Number}  row
     * @param  {Number}  col
     * @return {Boolean}
     */


    BitMatrix.prototype.get = function (row, col) {
      return this.data[row * this.size + col];
    };
    /**
     * Applies xor operator at specified location
     * (used during masking process)
     *
     * @param {Number}  row
     * @param {Number}  col
     * @param {Boolean} value
     */


    BitMatrix.prototype.xor = function (row, col, value) {
      this.data[row * this.size + col] ^= value;
    };
    /**
     * Check if bit at specified location is reserved
     *
     * @param {Number}   row
     * @param {Number}   col
     * @return {Boolean}
     */


    BitMatrix.prototype.isReserved = function (row, col) {
      return this.reservedBit[row * this.size + col];
    };

    module.exports = BitMatrix;
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/core/byte-data.js":
  /*!***************************************************!*\
    !*** ./node_modules/qrcode/lib/core/byte-data.js ***!
    \***************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreByteDataJs(module, exports, __webpack_require__) {
    var Buffer = __webpack_require__(
    /*! ../utils/buffer */
    "./node_modules/qrcode/lib/utils/typedarray-buffer.js");

    var Mode = __webpack_require__(
    /*! ./mode */
    "./node_modules/qrcode/lib/core/mode.js");

    function ByteData(data) {
      this.mode = Mode.BYTE;
      this.data = new Buffer(data);
    }

    ByteData.getBitsLength = function getBitsLength(length) {
      return length * 8;
    };

    ByteData.prototype.getLength = function getLength() {
      return this.data.length;
    };

    ByteData.prototype.getBitsLength = function getBitsLength() {
      return ByteData.getBitsLength(this.data.length);
    };

    ByteData.prototype.write = function (bitBuffer) {
      for (var i = 0, l = this.data.length; i < l; i++) {
        bitBuffer.put(this.data[i], 8);
      }
    };

    module.exports = ByteData;
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/core/error-correction-code.js":
  /*!***************************************************************!*\
    !*** ./node_modules/qrcode/lib/core/error-correction-code.js ***!
    \***************************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreErrorCorrectionCodeJs(module, exports, __webpack_require__) {
    var ECLevel = __webpack_require__(
    /*! ./error-correction-level */
    "./node_modules/qrcode/lib/core/error-correction-level.js");

    var EC_BLOCKS_TABLE = [// L  M  Q  H
    1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 2, 2, 4, 1, 2, 4, 4, 2, 4, 4, 4, 2, 4, 6, 5, 2, 4, 6, 6, 2, 5, 8, 8, 4, 5, 8, 8, 4, 5, 8, 11, 4, 8, 10, 11, 4, 9, 12, 16, 4, 9, 16, 16, 6, 10, 12, 18, 6, 10, 17, 16, 6, 11, 16, 19, 6, 13, 18, 21, 7, 14, 21, 25, 8, 16, 20, 25, 8, 17, 23, 25, 9, 17, 23, 34, 9, 18, 25, 30, 10, 20, 27, 32, 12, 21, 29, 35, 12, 23, 34, 37, 12, 25, 34, 40, 13, 26, 35, 42, 14, 28, 38, 45, 15, 29, 40, 48, 16, 31, 43, 51, 17, 33, 45, 54, 18, 35, 48, 57, 19, 37, 51, 60, 19, 38, 53, 63, 20, 40, 56, 66, 21, 43, 59, 70, 22, 45, 62, 74, 24, 47, 65, 77, 25, 49, 68, 81];
    var EC_CODEWORDS_TABLE = [// L  M  Q  H
    7, 10, 13, 17, 10, 16, 22, 28, 15, 26, 36, 44, 20, 36, 52, 64, 26, 48, 72, 88, 36, 64, 96, 112, 40, 72, 108, 130, 48, 88, 132, 156, 60, 110, 160, 192, 72, 130, 192, 224, 80, 150, 224, 264, 96, 176, 260, 308, 104, 198, 288, 352, 120, 216, 320, 384, 132, 240, 360, 432, 144, 280, 408, 480, 168, 308, 448, 532, 180, 338, 504, 588, 196, 364, 546, 650, 224, 416, 600, 700, 224, 442, 644, 750, 252, 476, 690, 816, 270, 504, 750, 900, 300, 560, 810, 960, 312, 588, 870, 1050, 336, 644, 952, 1110, 360, 700, 1020, 1200, 390, 728, 1050, 1260, 420, 784, 1140, 1350, 450, 812, 1200, 1440, 480, 868, 1290, 1530, 510, 924, 1350, 1620, 540, 980, 1440, 1710, 570, 1036, 1530, 1800, 570, 1064, 1590, 1890, 600, 1120, 1680, 1980, 630, 1204, 1770, 2100, 660, 1260, 1860, 2220, 720, 1316, 1950, 2310, 750, 1372, 2040, 2430];
    /**
     * Returns the number of error correction block that the QR Code should contain
     * for the specified version and error correction level.
     *
     * @param  {Number} version              QR Code version
     * @param  {Number} errorCorrectionLevel Error correction level
     * @return {Number}                      Number of error correction blocks
     */

    exports.getBlocksCount = function getBlocksCount(version, errorCorrectionLevel) {
      switch (errorCorrectionLevel) {
        case ECLevel.L:
          return EC_BLOCKS_TABLE[(version - 1) * 4 + 0];

        case ECLevel.M:
          return EC_BLOCKS_TABLE[(version - 1) * 4 + 1];

        case ECLevel.Q:
          return EC_BLOCKS_TABLE[(version - 1) * 4 + 2];

        case ECLevel.H:
          return EC_BLOCKS_TABLE[(version - 1) * 4 + 3];

        default:
          return undefined;
      }
    };
    /**
     * Returns the number of error correction codewords to use for the specified
     * version and error correction level.
     *
     * @param  {Number} version              QR Code version
     * @param  {Number} errorCorrectionLevel Error correction level
     * @return {Number}                      Number of error correction codewords
     */


    exports.getTotalCodewordsCount = function getTotalCodewordsCount(version, errorCorrectionLevel) {
      switch (errorCorrectionLevel) {
        case ECLevel.L:
          return EC_CODEWORDS_TABLE[(version - 1) * 4 + 0];

        case ECLevel.M:
          return EC_CODEWORDS_TABLE[(version - 1) * 4 + 1];

        case ECLevel.Q:
          return EC_CODEWORDS_TABLE[(version - 1) * 4 + 2];

        case ECLevel.H:
          return EC_CODEWORDS_TABLE[(version - 1) * 4 + 3];

        default:
          return undefined;
      }
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/error-correction-level.js":
  /*!****************************************************************!*\
    !*** ./node_modules/qrcode/lib/core/error-correction-level.js ***!
    \****************************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreErrorCorrectionLevelJs(module, exports) {
    exports.L = {
      bit: 1
    };
    exports.M = {
      bit: 0
    };
    exports.Q = {
      bit: 3
    };
    exports.H = {
      bit: 2
    };

    function fromString(string) {
      if (typeof string !== 'string') {
        throw new Error('Param is not a string');
      }

      var lcStr = string.toLowerCase();

      switch (lcStr) {
        case 'l':
        case 'low':
          return exports.L;

        case 'm':
        case 'medium':
          return exports.M;

        case 'q':
        case 'quartile':
          return exports.Q;

        case 'h':
        case 'high':
          return exports.H;

        default:
          throw new Error('Unknown EC Level: ' + string);
      }
    }

    exports.isValid = function isValid(level) {
      return level && typeof level.bit !== 'undefined' && level.bit >= 0 && level.bit < 4;
    };

    exports.from = function from(value, defaultValue) {
      if (exports.isValid(value)) {
        return value;
      }

      try {
        return fromString(value);
      } catch (e) {
        return defaultValue;
      }
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/finder-pattern.js":
  /*!********************************************************!*\
    !*** ./node_modules/qrcode/lib/core/finder-pattern.js ***!
    \********************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreFinderPatternJs(module, exports, __webpack_require__) {
    var getSymbolSize = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/core/utils.js").getSymbolSize;

    var FINDER_PATTERN_SIZE = 7;
    /**
     * Returns an array containing the positions of each finder pattern.
     * Each array's element represent the top-left point of the pattern as (x, y) coordinates
     *
     * @param  {Number} version QR Code version
     * @return {Array}          Array of coordinates
     */

    exports.getPositions = function getPositions(version) {
      var size = getSymbolSize(version);
      return [// top-left
      [0, 0], // top-right
      [size - FINDER_PATTERN_SIZE, 0], // bottom-left
      [0, size - FINDER_PATTERN_SIZE]];
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/format-info.js":
  /*!*****************************************************!*\
    !*** ./node_modules/qrcode/lib/core/format-info.js ***!
    \*****************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreFormatInfoJs(module, exports, __webpack_require__) {
    var Utils = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/core/utils.js");

    var G15 = 1 << 10 | 1 << 8 | 1 << 5 | 1 << 4 | 1 << 2 | 1 << 1 | 1 << 0;
    var G15_MASK = 1 << 14 | 1 << 12 | 1 << 10 | 1 << 4 | 1 << 1;
    var G15_BCH = Utils.getBCHDigit(G15);
    /**
     * Returns format information with relative error correction bits
     *
     * The format information is a 15-bit sequence containing 5 data bits,
     * with 10 error correction bits calculated using the (15, 5) BCH code.
     *
     * @param  {Number} errorCorrectionLevel Error correction level
     * @param  {Number} mask                 Mask pattern
     * @return {Number}                      Encoded format information bits
     */

    exports.getEncodedBits = function getEncodedBits(errorCorrectionLevel, mask) {
      var data = errorCorrectionLevel.bit << 3 | mask;
      var d = data << 10;

      while (Utils.getBCHDigit(d) - G15_BCH >= 0) {
        d ^= G15 << Utils.getBCHDigit(d) - G15_BCH;
      } // xor final data with mask pattern in order to ensure that
      // no combination of Error Correction Level and data mask pattern
      // will result in an all-zero data string


      return (data << 10 | d) ^ G15_MASK;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/galois-field.js":
  /*!******************************************************!*\
    !*** ./node_modules/qrcode/lib/core/galois-field.js ***!
    \******************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreGaloisFieldJs(module, exports, __webpack_require__) {
    var Buffer = __webpack_require__(
    /*! ../utils/buffer */
    "./node_modules/qrcode/lib/utils/typedarray-buffer.js");

    var EXP_TABLE;
    var LOG_TABLE;

    if (Buffer.alloc) {
      EXP_TABLE = Buffer.alloc(512);
      LOG_TABLE = Buffer.alloc(256);
    } else {
      EXP_TABLE = new Buffer(512);
      LOG_TABLE = new Buffer(256);
    }
    /**
     * Precompute the log and anti-log tables for faster computation later
     *
     * For each possible value in the galois field 2^8, we will pre-compute
     * the logarithm and anti-logarithm (exponential) of this value
     *
     * ref {@link https://en.wikiversity.org/wiki/Reed%E2%80%93Solomon_codes_for_coders#Introduction_to_mathematical_fields}
     */


    ;

    (function initTables() {
      var x = 1;

      for (var i = 0; i < 255; i++) {
        EXP_TABLE[i] = x;
        LOG_TABLE[x] = i;
        x <<= 1; // multiply by 2
        // The QR code specification says to use byte-wise modulo 100011101 arithmetic.
        // This means that when a number is 256 or larger, it should be XORed with 0x11D.

        if (x & 0x100) {
          // similar to x >= 256, but a lot faster (because 0x100 == 256)
          x ^= 0x11D;
        }
      } // Optimization: double the size of the anti-log table so that we don't need to mod 255 to
      // stay inside the bounds (because we will mainly use this table for the multiplication of
      // two GF numbers, no more).
      // @see {@link mul}


      for (i = 255; i < 512; i++) {
        EXP_TABLE[i] = EXP_TABLE[i - 255];
      }
    })();
    /**
     * Returns log value of n inside Galois Field
     *
     * @param  {Number} n
     * @return {Number}
     */


    exports.log = function log(n) {
      if (n < 1) throw new Error('log(' + n + ')');
      return LOG_TABLE[n];
    };
    /**
     * Returns anti-log value of n inside Galois Field
     *
     * @param  {Number} n
     * @return {Number}
     */


    exports.exp = function exp(n) {
      return EXP_TABLE[n];
    };
    /**
     * Multiplies two number inside Galois Field
     *
     * @param  {Number} x
     * @param  {Number} y
     * @return {Number}
     */


    exports.mul = function mul(x, y) {
      if (x === 0 || y === 0) return 0; // should be EXP_TABLE[(LOG_TABLE[x] + LOG_TABLE[y]) % 255] if EXP_TABLE wasn't oversized
      // @see {@link initTables}

      return EXP_TABLE[LOG_TABLE[x] + LOG_TABLE[y]];
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/kanji-data.js":
  /*!****************************************************!*\
    !*** ./node_modules/qrcode/lib/core/kanji-data.js ***!
    \****************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreKanjiDataJs(module, exports, __webpack_require__) {
    var Mode = __webpack_require__(
    /*! ./mode */
    "./node_modules/qrcode/lib/core/mode.js");

    var Utils = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/core/utils.js");

    function KanjiData(data) {
      this.mode = Mode.KANJI;
      this.data = data;
    }

    KanjiData.getBitsLength = function getBitsLength(length) {
      return length * 13;
    };

    KanjiData.prototype.getLength = function getLength() {
      return this.data.length;
    };

    KanjiData.prototype.getBitsLength = function getBitsLength() {
      return KanjiData.getBitsLength(this.data.length);
    };

    KanjiData.prototype.write = function (bitBuffer) {
      var i; // In the Shift JIS system, Kanji characters are represented by a two byte combination.
      // These byte values are shifted from the JIS X 0208 values.
      // JIS X 0208 gives details of the shift coded representation.

      for (i = 0; i < this.data.length; i++) {
        var value = Utils.toSJIS(this.data[i]); // For characters with Shift JIS values from 0x8140 to 0x9FFC:

        if (value >= 0x8140 && value <= 0x9FFC) {
          // Subtract 0x8140 from Shift JIS value
          value -= 0x8140; // For characters with Shift JIS values from 0xE040 to 0xEBBF
        } else if (value >= 0xE040 && value <= 0xEBBF) {
          // Subtract 0xC140 from Shift JIS value
          value -= 0xC140;
        } else {
          throw new Error('Invalid SJIS character: ' + this.data[i] + '\n' + 'Make sure your charset is UTF-8');
        } // Multiply most significant byte of result by 0xC0
        // and add least significant byte to product


        value = (value >>> 8 & 0xff) * 0xC0 + (value & 0xff); // Convert result to a 13-bit binary string

        bitBuffer.put(value, 13);
      }
    };

    module.exports = KanjiData;
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/core/mask-pattern.js":
  /*!******************************************************!*\
    !*** ./node_modules/qrcode/lib/core/mask-pattern.js ***!
    \******************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreMaskPatternJs(module, exports) {
    /**
     * Data mask pattern reference
     * @type {Object}
     */
    exports.Patterns = {
      PATTERN000: 0,
      PATTERN001: 1,
      PATTERN010: 2,
      PATTERN011: 3,
      PATTERN100: 4,
      PATTERN101: 5,
      PATTERN110: 6,
      PATTERN111: 7
    };
    /**
     * Weighted penalty scores for the undesirable features
     * @type {Object}
     */

    var PenaltyScores = {
      N1: 3,
      N2: 3,
      N3: 40,
      N4: 10
    };
    /**
     * Check if mask pattern value is valid
     *
     * @param  {Number}  mask    Mask pattern
     * @return {Boolean}         true if valid, false otherwise
     */

    exports.isValid = function isValid(mask) {
      return mask != null && mask !== '' && !isNaN(mask) && mask >= 0 && mask <= 7;
    };
    /**
     * Returns mask pattern from a value.
     * If value is not valid, returns undefined
     *
     * @param  {Number|String} value        Mask pattern value
     * @return {Number}                     Valid mask pattern or undefined
     */


    exports.from = function from(value) {
      return exports.isValid(value) ? parseInt(value, 10) : undefined;
    };
    /**
    * Find adjacent modules in row/column with the same color
    * and assign a penalty value.
    *
    * Points: N1 + i
    * i is the amount by which the number of adjacent modules of the same color exceeds 5
    */


    exports.getPenaltyN1 = function getPenaltyN1(data) {
      var size = data.size;
      var points = 0;
      var sameCountCol = 0;
      var sameCountRow = 0;
      var lastCol = null;
      var lastRow = null;

      for (var row = 0; row < size; row++) {
        sameCountCol = sameCountRow = 0;
        lastCol = lastRow = null;

        for (var col = 0; col < size; col++) {
          var module = data.get(row, col);

          if (module === lastCol) {
            sameCountCol++;
          } else {
            if (sameCountCol >= 5) points += PenaltyScores.N1 + (sameCountCol - 5);
            lastCol = module;
            sameCountCol = 1;
          }

          module = data.get(col, row);

          if (module === lastRow) {
            sameCountRow++;
          } else {
            if (sameCountRow >= 5) points += PenaltyScores.N1 + (sameCountRow - 5);
            lastRow = module;
            sameCountRow = 1;
          }
        }

        if (sameCountCol >= 5) points += PenaltyScores.N1 + (sameCountCol - 5);
        if (sameCountRow >= 5) points += PenaltyScores.N1 + (sameCountRow - 5);
      }

      return points;
    };
    /**
     * Find 2x2 blocks with the same color and assign a penalty value
     *
     * Points: N2 * (m - 1) * (n - 1)
     */


    exports.getPenaltyN2 = function getPenaltyN2(data) {
      var size = data.size;
      var points = 0;

      for (var row = 0; row < size - 1; row++) {
        for (var col = 0; col < size - 1; col++) {
          var last = data.get(row, col) + data.get(row, col + 1) + data.get(row + 1, col) + data.get(row + 1, col + 1);
          if (last === 4 || last === 0) points++;
        }
      }

      return points * PenaltyScores.N2;
    };
    /**
     * Find 1:1:3:1:1 ratio (dark:light:dark:light:dark) pattern in row/column,
     * preceded or followed by light area 4 modules wide
     *
     * Points: N3 * number of pattern found
     */


    exports.getPenaltyN3 = function getPenaltyN3(data) {
      var size = data.size;
      var points = 0;
      var bitsCol = 0;
      var bitsRow = 0;

      for (var row = 0; row < size; row++) {
        bitsCol = bitsRow = 0;

        for (var col = 0; col < size; col++) {
          bitsCol = bitsCol << 1 & 0x7FF | data.get(row, col);
          if (col >= 10 && (bitsCol === 0x5D0 || bitsCol === 0x05D)) points++;
          bitsRow = bitsRow << 1 & 0x7FF | data.get(col, row);
          if (col >= 10 && (bitsRow === 0x5D0 || bitsRow === 0x05D)) points++;
        }
      }

      return points * PenaltyScores.N3;
    };
    /**
     * Calculate proportion of dark modules in entire symbol
     *
     * Points: N4 * k
     *
     * k is the rating of the deviation of the proportion of dark modules
     * in the symbol from 50% in steps of 5%
     */


    exports.getPenaltyN4 = function getPenaltyN4(data) {
      var darkCount = 0;
      var modulesCount = data.data.length;

      for (var i = 0; i < modulesCount; i++) darkCount += data.data[i];

      var k = Math.abs(Math.ceil(darkCount * 100 / modulesCount / 5) - 10);
      return k * PenaltyScores.N4;
    };
    /**
     * Return mask value at given position
     *
     * @param  {Number} maskPattern Pattern reference value
     * @param  {Number} i           Row
     * @param  {Number} j           Column
     * @return {Boolean}            Mask value
     */


    function getMaskAt(maskPattern, i, j) {
      switch (maskPattern) {
        case exports.Patterns.PATTERN000:
          return (i + j) % 2 === 0;

        case exports.Patterns.PATTERN001:
          return i % 2 === 0;

        case exports.Patterns.PATTERN010:
          return j % 3 === 0;

        case exports.Patterns.PATTERN011:
          return (i + j) % 3 === 0;

        case exports.Patterns.PATTERN100:
          return (Math.floor(i / 2) + Math.floor(j / 3)) % 2 === 0;

        case exports.Patterns.PATTERN101:
          return i * j % 2 + i * j % 3 === 0;

        case exports.Patterns.PATTERN110:
          return (i * j % 2 + i * j % 3) % 2 === 0;

        case exports.Patterns.PATTERN111:
          return (i * j % 3 + (i + j) % 2) % 2 === 0;

        default:
          throw new Error('bad maskPattern:' + maskPattern);
      }
    }
    /**
     * Apply a mask pattern to a BitMatrix
     *
     * @param  {Number}    pattern Pattern reference number
     * @param  {BitMatrix} data    BitMatrix data
     */


    exports.applyMask = function applyMask(pattern, data) {
      var size = data.size;

      for (var col = 0; col < size; col++) {
        for (var row = 0; row < size; row++) {
          if (data.isReserved(row, col)) continue;
          data.xor(row, col, getMaskAt(pattern, row, col));
        }
      }
    };
    /**
     * Returns the best mask pattern for data
     *
     * @param  {BitMatrix} data
     * @return {Number} Mask pattern reference number
     */


    exports.getBestMask = function getBestMask(data, setupFormatFunc) {
      var numPatterns = Object.keys(exports.Patterns).length;
      var bestPattern = 0;
      var lowerPenalty = Infinity;

      for (var p = 0; p < numPatterns; p++) {
        setupFormatFunc(p);
        exports.applyMask(p, data); // Calculate penalty

        var penalty = exports.getPenaltyN1(data) + exports.getPenaltyN2(data) + exports.getPenaltyN3(data) + exports.getPenaltyN4(data); // Undo previously applied mask

        exports.applyMask(p, data);

        if (penalty < lowerPenalty) {
          lowerPenalty = penalty;
          bestPattern = p;
        }
      }

      return bestPattern;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/mode.js":
  /*!**********************************************!*\
    !*** ./node_modules/qrcode/lib/core/mode.js ***!
    \**********************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreModeJs(module, exports, __webpack_require__) {
    var VersionCheck = __webpack_require__(
    /*! ./version-check */
    "./node_modules/qrcode/lib/core/version-check.js");

    var Regex = __webpack_require__(
    /*! ./regex */
    "./node_modules/qrcode/lib/core/regex.js");
    /**
     * Numeric mode encodes data from the decimal digit set (0 - 9)
     * (byte values 30HEX to 39HEX).
     * Normally, 3 data characters are represented by 10 bits.
     *
     * @type {Object}
     */


    exports.NUMERIC = {
      id: 'Numeric',
      bit: 1 << 0,
      ccBits: [10, 12, 14]
    };
    /**
     * Alphanumeric mode encodes data from a set of 45 characters,
     * i.e. 10 numeric digits (0 - 9),
     *      26 alphabetic characters (A - Z),
     *   and 9 symbols (SP, $, %, *, +, -, ., /, :).
     * Normally, two input characters are represented by 11 bits.
     *
     * @type {Object}
     */

    exports.ALPHANUMERIC = {
      id: 'Alphanumeric',
      bit: 1 << 1,
      ccBits: [9, 11, 13]
    };
    /**
     * In byte mode, data is encoded at 8 bits per character.
     *
     * @type {Object}
     */

    exports.BYTE = {
      id: 'Byte',
      bit: 1 << 2,
      ccBits: [8, 16, 16]
    };
    /**
     * The Kanji mode efficiently encodes Kanji characters in accordance with
     * the Shift JIS system based on JIS X 0208.
     * The Shift JIS values are shifted from the JIS X 0208 values.
     * JIS X 0208 gives details of the shift coded representation.
     * Each two-byte character value is compacted to a 13-bit binary codeword.
     *
     * @type {Object}
     */

    exports.KANJI = {
      id: 'Kanji',
      bit: 1 << 3,
      ccBits: [8, 10, 12]
    };
    /**
     * Mixed mode will contain a sequences of data in a combination of any of
     * the modes described above
     *
     * @type {Object}
     */

    exports.MIXED = {
      bit: -1
    };
    /**
     * Returns the number of bits needed to store the data length
     * according to QR Code specifications.
     *
     * @param  {Mode}   mode    Data mode
     * @param  {Number} version QR Code version
     * @return {Number}         Number of bits
     */

    exports.getCharCountIndicator = function getCharCountIndicator(mode, version) {
      if (!mode.ccBits) throw new Error('Invalid mode: ' + mode);

      if (!VersionCheck.isValid(version)) {
        throw new Error('Invalid version: ' + version);
      }

      if (version >= 1 && version < 10) return mode.ccBits[0];else if (version < 27) return mode.ccBits[1];
      return mode.ccBits[2];
    };
    /**
     * Returns the most efficient mode to store the specified data
     *
     * @param  {String} dataStr Input data string
     * @return {Mode}           Best mode
     */


    exports.getBestModeForData = function getBestModeForData(dataStr) {
      if (Regex.testNumeric(dataStr)) return exports.NUMERIC;else if (Regex.testAlphanumeric(dataStr)) return exports.ALPHANUMERIC;else if (Regex.testKanji(dataStr)) return exports.KANJI;else return exports.BYTE;
    };
    /**
     * Return mode name as string
     *
     * @param {Mode} mode Mode object
     * @returns {String}  Mode name
     */


    exports.toString = function toString(mode) {
      if (mode && mode.id) return mode.id;
      throw new Error('Invalid mode');
    };
    /**
     * Check if input param is a valid mode object
     *
     * @param   {Mode}    mode Mode object
     * @returns {Boolean} True if valid mode, false otherwise
     */


    exports.isValid = function isValid(mode) {
      return mode && mode.bit && mode.ccBits;
    };
    /**
     * Get mode object from its name
     *
     * @param   {String} string Mode name
     * @returns {Mode}          Mode object
     */


    function fromString(string) {
      if (typeof string !== 'string') {
        throw new Error('Param is not a string');
      }

      var lcStr = string.toLowerCase();

      switch (lcStr) {
        case 'numeric':
          return exports.NUMERIC;

        case 'alphanumeric':
          return exports.ALPHANUMERIC;

        case 'kanji':
          return exports.KANJI;

        case 'byte':
          return exports.BYTE;

        default:
          throw new Error('Unknown mode: ' + string);
      }
    }
    /**
     * Returns mode from a value.
     * If value is not a valid mode, returns defaultValue
     *
     * @param  {Mode|String} value        Encoding mode
     * @param  {Mode}        defaultValue Fallback value
     * @return {Mode}                     Encoding mode
     */


    exports.from = function from(value, defaultValue) {
      if (exports.isValid(value)) {
        return value;
      }

      try {
        return fromString(value);
      } catch (e) {
        return defaultValue;
      }
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/numeric-data.js":
  /*!******************************************************!*\
    !*** ./node_modules/qrcode/lib/core/numeric-data.js ***!
    \******************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreNumericDataJs(module, exports, __webpack_require__) {
    var Mode = __webpack_require__(
    /*! ./mode */
    "./node_modules/qrcode/lib/core/mode.js");

    function NumericData(data) {
      this.mode = Mode.NUMERIC;
      this.data = data.toString();
    }

    NumericData.getBitsLength = function getBitsLength(length) {
      return 10 * Math.floor(length / 3) + (length % 3 ? length % 3 * 3 + 1 : 0);
    };

    NumericData.prototype.getLength = function getLength() {
      return this.data.length;
    };

    NumericData.prototype.getBitsLength = function getBitsLength() {
      return NumericData.getBitsLength(this.data.length);
    };

    NumericData.prototype.write = function write(bitBuffer) {
      var i, group, value; // The input data string is divided into groups of three digits,
      // and each group is converted to its 10-bit binary equivalent.

      for (i = 0; i + 3 <= this.data.length; i += 3) {
        group = this.data.substr(i, 3);
        value = parseInt(group, 10);
        bitBuffer.put(value, 10);
      } // If the number of input digits is not an exact multiple of three,
      // the final one or two digits are converted to 4 or 7 bits respectively.


      var remainingNum = this.data.length - i;

      if (remainingNum > 0) {
        group = this.data.substr(i);
        value = parseInt(group, 10);
        bitBuffer.put(value, remainingNum * 3 + 1);
      }
    };

    module.exports = NumericData;
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/core/polynomial.js":
  /*!****************************************************!*\
    !*** ./node_modules/qrcode/lib/core/polynomial.js ***!
    \****************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCorePolynomialJs(module, exports, __webpack_require__) {
    var Buffer = __webpack_require__(
    /*! ../utils/buffer */
    "./node_modules/qrcode/lib/utils/typedarray-buffer.js");

    var GF = __webpack_require__(
    /*! ./galois-field */
    "./node_modules/qrcode/lib/core/galois-field.js");
    /**
     * Multiplies two polynomials inside Galois Field
     *
     * @param  {Buffer} p1 Polynomial
     * @param  {Buffer} p2 Polynomial
     * @return {Buffer}    Product of p1 and p2
     */


    exports.mul = function mul(p1, p2) {
      var coeff = new Buffer(p1.length + p2.length - 1);
      coeff.fill(0);

      for (var i = 0; i < p1.length; i++) {
        for (var j = 0; j < p2.length; j++) {
          coeff[i + j] ^= GF.mul(p1[i], p2[j]);
        }
      }

      return coeff;
    };
    /**
     * Calculate the remainder of polynomials division
     *
     * @param  {Buffer} divident Polynomial
     * @param  {Buffer} divisor  Polynomial
     * @return {Buffer}          Remainder
     */


    exports.mod = function mod(divident, divisor) {
      var result = new Buffer(divident);

      while (result.length - divisor.length >= 0) {
        var coeff = result[0];

        for (var i = 0; i < divisor.length; i++) {
          result[i] ^= GF.mul(divisor[i], coeff);
        } // remove all zeros from buffer head


        var offset = 0;

        while (offset < result.length && result[offset] === 0) offset++;

        result = result.slice(offset);
      }

      return result;
    };
    /**
     * Generate an irreducible generator polynomial of specified degree
     * (used by Reed-Solomon encoder)
     *
     * @param  {Number} degree Degree of the generator polynomial
     * @return {Buffer}        Buffer containing polynomial coefficients
     */


    exports.generateECPolynomial = function generateECPolynomial(degree) {
      var poly = new Buffer([1]);

      for (var i = 0; i < degree; i++) {
        poly = exports.mul(poly, [1, GF.exp(i)]);
      }

      return poly;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/qrcode.js":
  /*!************************************************!*\
    !*** ./node_modules/qrcode/lib/core/qrcode.js ***!
    \************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreQrcodeJs(module, exports, __webpack_require__) {
    var Buffer = __webpack_require__(
    /*! ../utils/buffer */
    "./node_modules/qrcode/lib/utils/typedarray-buffer.js");

    var Utils = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/core/utils.js");

    var ECLevel = __webpack_require__(
    /*! ./error-correction-level */
    "./node_modules/qrcode/lib/core/error-correction-level.js");

    var BitBuffer = __webpack_require__(
    /*! ./bit-buffer */
    "./node_modules/qrcode/lib/core/bit-buffer.js");

    var BitMatrix = __webpack_require__(
    /*! ./bit-matrix */
    "./node_modules/qrcode/lib/core/bit-matrix.js");

    var AlignmentPattern = __webpack_require__(
    /*! ./alignment-pattern */
    "./node_modules/qrcode/lib/core/alignment-pattern.js");

    var FinderPattern = __webpack_require__(
    /*! ./finder-pattern */
    "./node_modules/qrcode/lib/core/finder-pattern.js");

    var MaskPattern = __webpack_require__(
    /*! ./mask-pattern */
    "./node_modules/qrcode/lib/core/mask-pattern.js");

    var ECCode = __webpack_require__(
    /*! ./error-correction-code */
    "./node_modules/qrcode/lib/core/error-correction-code.js");

    var ReedSolomonEncoder = __webpack_require__(
    /*! ./reed-solomon-encoder */
    "./node_modules/qrcode/lib/core/reed-solomon-encoder.js");

    var Version = __webpack_require__(
    /*! ./version */
    "./node_modules/qrcode/lib/core/version.js");

    var FormatInfo = __webpack_require__(
    /*! ./format-info */
    "./node_modules/qrcode/lib/core/format-info.js");

    var Mode = __webpack_require__(
    /*! ./mode */
    "./node_modules/qrcode/lib/core/mode.js");

    var Segments = __webpack_require__(
    /*! ./segments */
    "./node_modules/qrcode/lib/core/segments.js");

    var isArray = __webpack_require__(
    /*! isarray */
    "./node_modules/qrcode/node_modules/isarray/index.js");
    /**
     * QRCode for JavaScript
     *
     * modified by Ryan Day for nodejs support
     * Copyright (c) 2011 Ryan Day
     *
     * Licensed under the MIT license:
     *   http://www.opensource.org/licenses/mit-license.php
     *
    //---------------------------------------------------------------------
    // QRCode for JavaScript
    //
    // Copyright (c) 2009 Kazuhiko Arase
    //
    // URL: http://www.d-project.com/
    //
    // Licensed under the MIT license:
    //   http://www.opensource.org/licenses/mit-license.php
    //
    // The word "QR Code" is registered trademark of
    // DENSO WAVE INCORPORATED
    //   http://www.denso-wave.com/qrcode/faqpatent-e.html
    //
    //---------------------------------------------------------------------
    */

    /**
     * Add finder patterns bits to matrix
     *
     * @param  {BitMatrix} matrix  Modules matrix
     * @param  {Number}    version QR Code version
     */


    function setupFinderPattern(matrix, version) {
      var size = matrix.size;
      var pos = FinderPattern.getPositions(version);

      for (var i = 0; i < pos.length; i++) {
        var row = pos[i][0];
        var col = pos[i][1];

        for (var r = -1; r <= 7; r++) {
          if (row + r <= -1 || size <= row + r) continue;

          for (var c = -1; c <= 7; c++) {
            if (col + c <= -1 || size <= col + c) continue;

            if (r >= 0 && r <= 6 && (c === 0 || c === 6) || c >= 0 && c <= 6 && (r === 0 || r === 6) || r >= 2 && r <= 4 && c >= 2 && c <= 4) {
              matrix.set(row + r, col + c, true, true);
            } else {
              matrix.set(row + r, col + c, false, true);
            }
          }
        }
      }
    }
    /**
     * Add timing pattern bits to matrix
     *
     * Note: this function must be called before {@link setupAlignmentPattern}
     *
     * @param  {BitMatrix} matrix Modules matrix
     */


    function setupTimingPattern(matrix) {
      var size = matrix.size;

      for (var r = 8; r < size - 8; r++) {
        var value = r % 2 === 0;
        matrix.set(r, 6, value, true);
        matrix.set(6, r, value, true);
      }
    }
    /**
     * Add alignment patterns bits to matrix
     *
     * Note: this function must be called after {@link setupTimingPattern}
     *
     * @param  {BitMatrix} matrix  Modules matrix
     * @param  {Number}    version QR Code version
     */


    function setupAlignmentPattern(matrix, version) {
      var pos = AlignmentPattern.getPositions(version);

      for (var i = 0; i < pos.length; i++) {
        var row = pos[i][0];
        var col = pos[i][1];

        for (var r = -2; r <= 2; r++) {
          for (var c = -2; c <= 2; c++) {
            if (r === -2 || r === 2 || c === -2 || c === 2 || r === 0 && c === 0) {
              matrix.set(row + r, col + c, true, true);
            } else {
              matrix.set(row + r, col + c, false, true);
            }
          }
        }
      }
    }
    /**
     * Add version info bits to matrix
     *
     * @param  {BitMatrix} matrix  Modules matrix
     * @param  {Number}    version QR Code version
     */


    function setupVersionInfo(matrix, version) {
      var size = matrix.size;
      var bits = Version.getEncodedBits(version);
      var row, col, mod;

      for (var i = 0; i < 18; i++) {
        row = Math.floor(i / 3);
        col = i % 3 + size - 8 - 3;
        mod = (bits >> i & 1) === 1;
        matrix.set(row, col, mod, true);
        matrix.set(col, row, mod, true);
      }
    }
    /**
     * Add format info bits to matrix
     *
     * @param  {BitMatrix} matrix               Modules matrix
     * @param  {ErrorCorrectionLevel}    errorCorrectionLevel Error correction level
     * @param  {Number}    maskPattern          Mask pattern reference value
     */


    function setupFormatInfo(matrix, errorCorrectionLevel, maskPattern) {
      var size = matrix.size;
      var bits = FormatInfo.getEncodedBits(errorCorrectionLevel, maskPattern);
      var i, mod;

      for (i = 0; i < 15; i++) {
        mod = (bits >> i & 1) === 1; // vertical

        if (i < 6) {
          matrix.set(i, 8, mod, true);
        } else if (i < 8) {
          matrix.set(i + 1, 8, mod, true);
        } else {
          matrix.set(size - 15 + i, 8, mod, true);
        } // horizontal


        if (i < 8) {
          matrix.set(8, size - i - 1, mod, true);
        } else if (i < 9) {
          matrix.set(8, 15 - i - 1 + 1, mod, true);
        } else {
          matrix.set(8, 15 - i - 1, mod, true);
        }
      } // fixed module


      matrix.set(size - 8, 8, 1, true);
    }
    /**
     * Add encoded data bits to matrix
     *
     * @param  {BitMatrix} matrix Modules matrix
     * @param  {Buffer}    data   Data codewords
     */


    function setupData(matrix, data) {
      var size = matrix.size;
      var inc = -1;
      var row = size - 1;
      var bitIndex = 7;
      var byteIndex = 0;

      for (var col = size - 1; col > 0; col -= 2) {
        if (col === 6) col--;

        while (true) {
          for (var c = 0; c < 2; c++) {
            if (!matrix.isReserved(row, col - c)) {
              var dark = false;

              if (byteIndex < data.length) {
                dark = (data[byteIndex] >>> bitIndex & 1) === 1;
              }

              matrix.set(row, col - c, dark);
              bitIndex--;

              if (bitIndex === -1) {
                byteIndex++;
                bitIndex = 7;
              }
            }
          }

          row += inc;

          if (row < 0 || size <= row) {
            row -= inc;
            inc = -inc;
            break;
          }
        }
      }
    }
    /**
     * Create encoded codewords from data input
     *
     * @param  {Number}   version              QR Code version
     * @param  {ErrorCorrectionLevel}   errorCorrectionLevel Error correction level
     * @param  {ByteData} data                 Data input
     * @return {Buffer}                        Buffer containing encoded codewords
     */


    function createData(version, errorCorrectionLevel, segments) {
      // Prepare data buffer
      var buffer = new BitBuffer();
      segments.forEach(function (data) {
        // prefix data with mode indicator (4 bits)
        buffer.put(data.mode.bit, 4); // Prefix data with character count indicator.
        // The character count indicator is a string of bits that represents the
        // number of characters that are being encoded.
        // The character count indicator must be placed after the mode indicator
        // and must be a certain number of bits long, depending on the QR version
        // and data mode
        // @see {@link Mode.getCharCountIndicator}.

        buffer.put(data.getLength(), Mode.getCharCountIndicator(data.mode, version)); // add binary data sequence to buffer

        data.write(buffer);
      }); // Calculate required number of bits

      var totalCodewords = Utils.getSymbolTotalCodewords(version);
      var ecTotalCodewords = ECCode.getTotalCodewordsCount(version, errorCorrectionLevel);
      var dataTotalCodewordsBits = (totalCodewords - ecTotalCodewords) * 8; // Add a terminator.
      // If the bit string is shorter than the total number of required bits,
      // a terminator of up to four 0s must be added to the right side of the string.
      // If the bit string is more than four bits shorter than the required number of bits,
      // add four 0s to the end.

      if (buffer.getLengthInBits() + 4 <= dataTotalCodewordsBits) {
        buffer.put(0, 4);
      } // If the bit string is fewer than four bits shorter, add only the number of 0s that
      // are needed to reach the required number of bits.
      // After adding the terminator, if the number of bits in the string is not a multiple of 8,
      // pad the string on the right with 0s to make the string's length a multiple of 8.


      while (buffer.getLengthInBits() % 8 !== 0) {
        buffer.putBit(0);
      } // Add pad bytes if the string is still shorter than the total number of required bits.
      // Extend the buffer to fill the data capacity of the symbol corresponding to
      // the Version and Error Correction Level by adding the Pad Codewords 11101100 (0xEC)
      // and 00010001 (0x11) alternately.


      var remainingByte = (dataTotalCodewordsBits - buffer.getLengthInBits()) / 8;

      for (var i = 0; i < remainingByte; i++) {
        buffer.put(i % 2 ? 0x11 : 0xEC, 8);
      }

      return createCodewords(buffer, version, errorCorrectionLevel);
    }
    /**
     * Encode input data with Reed-Solomon and return codewords with
     * relative error correction bits
     *
     * @param  {BitBuffer} bitBuffer            Data to encode
     * @param  {Number}    version              QR Code version
     * @param  {ErrorCorrectionLevel} errorCorrectionLevel Error correction level
     * @return {Buffer}                         Buffer containing encoded codewords
     */


    function createCodewords(bitBuffer, version, errorCorrectionLevel) {
      // Total codewords for this QR code version (Data + Error correction)
      var totalCodewords = Utils.getSymbolTotalCodewords(version); // Total number of error correction codewords

      var ecTotalCodewords = ECCode.getTotalCodewordsCount(version, errorCorrectionLevel); // Total number of data codewords

      var dataTotalCodewords = totalCodewords - ecTotalCodewords; // Total number of blocks

      var ecTotalBlocks = ECCode.getBlocksCount(version, errorCorrectionLevel); // Calculate how many blocks each group should contain

      var blocksInGroup2 = totalCodewords % ecTotalBlocks;
      var blocksInGroup1 = ecTotalBlocks - blocksInGroup2;
      var totalCodewordsInGroup1 = Math.floor(totalCodewords / ecTotalBlocks);
      var dataCodewordsInGroup1 = Math.floor(dataTotalCodewords / ecTotalBlocks);
      var dataCodewordsInGroup2 = dataCodewordsInGroup1 + 1; // Number of EC codewords is the same for both groups

      var ecCount = totalCodewordsInGroup1 - dataCodewordsInGroup1; // Initialize a Reed-Solomon encoder with a generator polynomial of degree ecCount

      var rs = new ReedSolomonEncoder(ecCount);
      var offset = 0;
      var dcData = new Array(ecTotalBlocks);
      var ecData = new Array(ecTotalBlocks);
      var maxDataSize = 0;
      var buffer = new Buffer(bitBuffer.buffer); // Divide the buffer into the required number of blocks

      for (var b = 0; b < ecTotalBlocks; b++) {
        var dataSize = b < blocksInGroup1 ? dataCodewordsInGroup1 : dataCodewordsInGroup2; // extract a block of data from buffer

        dcData[b] = buffer.slice(offset, offset + dataSize); // Calculate EC codewords for this data block

        ecData[b] = rs.encode(dcData[b]);
        offset += dataSize;
        maxDataSize = Math.max(maxDataSize, dataSize);
      } // Create final data
      // Interleave the data and error correction codewords from each block


      var data = new Buffer(totalCodewords);
      var index = 0;
      var i, r; // Add data codewords

      for (i = 0; i < maxDataSize; i++) {
        for (r = 0; r < ecTotalBlocks; r++) {
          if (i < dcData[r].length) {
            data[index++] = dcData[r][i];
          }
        }
      } // Apped EC codewords


      for (i = 0; i < ecCount; i++) {
        for (r = 0; r < ecTotalBlocks; r++) {
          data[index++] = ecData[r][i];
        }
      }

      return data;
    }
    /**
     * Build QR Code symbol
     *
     * @param  {String} data                 Input string
     * @param  {Number} version              QR Code version
     * @param  {ErrorCorretionLevel} errorCorrectionLevel Error level
     * @param  {MaskPattern} maskPattern     Mask pattern
     * @return {Object}                      Object containing symbol data
     */


    function createSymbol(data, version, errorCorrectionLevel, maskPattern) {
      var segments;

      if (isArray(data)) {
        segments = Segments.fromArray(data);
      } else if (typeof data === 'string') {
        var estimatedVersion = version;

        if (!estimatedVersion) {
          var rawSegments = Segments.rawSplit(data); // Estimate best version that can contain raw splitted segments

          estimatedVersion = Version.getBestVersionForData(rawSegments, errorCorrectionLevel);
        } // Build optimized segments
        // If estimated version is undefined, try with the highest version


        segments = Segments.fromString(data, estimatedVersion || 40);
      } else {
        throw new Error('Invalid data');
      } // Get the min version that can contain data


      var bestVersion = Version.getBestVersionForData(segments, errorCorrectionLevel); // If no version is found, data cannot be stored

      if (!bestVersion) {
        throw new Error('The amount of data is too big to be stored in a QR Code');
      } // If not specified, use min version as default


      if (!version) {
        version = bestVersion; // Check if the specified version can contain the data
      } else if (version < bestVersion) {
        throw new Error('\n' + 'The chosen QR Code version cannot contain this amount of data.\n' + 'Minimum version required to store current data is: ' + bestVersion + '.\n');
      }

      var dataBits = createData(version, errorCorrectionLevel, segments); // Allocate matrix buffer

      var moduleCount = Utils.getSymbolSize(version);
      var modules = new BitMatrix(moduleCount); // Add function modules

      setupFinderPattern(modules, version);
      setupTimingPattern(modules);
      setupAlignmentPattern(modules, version); // Add temporary dummy bits for format info just to set them as reserved.
      // This is needed to prevent these bits from being masked by {@link MaskPattern.applyMask}
      // since the masking operation must be performed only on the encoding region.
      // These blocks will be replaced with correct values later in code.

      setupFormatInfo(modules, errorCorrectionLevel, 0);

      if (version >= 7) {
        setupVersionInfo(modules, version);
      } // Add data codewords


      setupData(modules, dataBits);

      if (isNaN(maskPattern)) {
        // Find best mask pattern
        maskPattern = MaskPattern.getBestMask(modules, setupFormatInfo.bind(null, modules, errorCorrectionLevel));
      } // Apply mask pattern


      MaskPattern.applyMask(maskPattern, modules); // Replace format info bits with correct values

      setupFormatInfo(modules, errorCorrectionLevel, maskPattern);
      return {
        modules: modules,
        version: version,
        errorCorrectionLevel: errorCorrectionLevel,
        maskPattern: maskPattern,
        segments: segments
      };
    }
    /**
     * QR Code
     *
     * @param {String | Array} data                 Input data
     * @param {Object} options                      Optional configurations
     * @param {Number} options.version              QR Code version
     * @param {String} options.errorCorrectionLevel Error correction level
     * @param {Function} options.toSJISFunc         Helper func to convert utf8 to sjis
     */


    exports.create = function create(data, options) {
      if (typeof data === 'undefined' || data === '') {
        throw new Error('No input text');
      }

      var errorCorrectionLevel = ECLevel.M;
      var version;
      var mask;

      if (typeof options !== 'undefined') {
        // Use higher error correction level as default
        errorCorrectionLevel = ECLevel.from(options.errorCorrectionLevel, ECLevel.M);
        version = Version.from(options.version);
        mask = MaskPattern.from(options.maskPattern);

        if (options.toSJISFunc) {
          Utils.setToSJISFunction(options.toSJISFunc);
        }
      }

      return createSymbol(data, version, errorCorrectionLevel, mask);
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/reed-solomon-encoder.js":
  /*!**************************************************************!*\
    !*** ./node_modules/qrcode/lib/core/reed-solomon-encoder.js ***!
    \**************************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreReedSolomonEncoderJs(module, exports, __webpack_require__) {
    var Buffer = __webpack_require__(
    /*! ../utils/buffer */
    "./node_modules/qrcode/lib/utils/typedarray-buffer.js");

    var Polynomial = __webpack_require__(
    /*! ./polynomial */
    "./node_modules/qrcode/lib/core/polynomial.js");

    function ReedSolomonEncoder(degree) {
      this.genPoly = undefined;
      this.degree = degree;
      if (this.degree) this.initialize(this.degree);
    }
    /**
     * Initialize the encoder.
     * The input param should correspond to the number of error correction codewords.
     *
     * @param  {Number} degree
     */


    ReedSolomonEncoder.prototype.initialize = function initialize(degree) {
      // create an irreducible generator polynomial
      this.degree = degree;
      this.genPoly = Polynomial.generateECPolynomial(this.degree);
    };
    /**
     * Encodes a chunk of data
     *
     * @param  {Buffer} data Buffer containing input data
     * @return {Buffer}      Buffer containing encoded data
     */


    ReedSolomonEncoder.prototype.encode = function encode(data) {
      if (!this.genPoly) {
        throw new Error('Encoder not initialized');
      } // Calculate EC for this data block
      // extends data size to data+genPoly size


      var pad = new Buffer(this.degree);
      pad.fill(0);
      var paddedData = Buffer.concat([data, pad], data.length + this.degree); // The error correction codewords are the remainder after dividing the data codewords
      // by a generator polynomial

      var remainder = Polynomial.mod(paddedData, this.genPoly); // return EC data blocks (last n byte, where n is the degree of genPoly)
      // If coefficients number in remainder are less than genPoly degree,
      // pad with 0s to the left to reach the needed number of coefficients

      var start = this.degree - remainder.length;

      if (start > 0) {
        var buff = new Buffer(this.degree);
        buff.fill(0);
        remainder.copy(buff, start);
        return buff;
      }

      return remainder;
    };

    module.exports = ReedSolomonEncoder;
    /***/
  },

  /***/
  "./node_modules/qrcode/lib/core/regex.js":
  /*!***********************************************!*\
    !*** ./node_modules/qrcode/lib/core/regex.js ***!
    \***********************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreRegexJs(module, exports) {
    var numeric = '[0-9]+';
    var alphanumeric = '[A-Z $%*+\\-./:]+';
    var kanji = '(?:[u3000-u303F]|[u3040-u309F]|[u30A0-u30FF]|' + '[uFF00-uFFEF]|[u4E00-u9FAF]|[u2605-u2606]|[u2190-u2195]|u203B|' + '[u2010u2015u2018u2019u2025u2026u201Cu201Du2225u2260]|' + '[u0391-u0451]|[u00A7u00A8u00B1u00B4u00D7u00F7])+';
    kanji = kanji.replace(/u/g, "\\u");

    var _byte = '(?:(?![A-Z0-9 $%*+\\-./:]|' + kanji + ')(?:.|[\r\n]))+';

    exports.KANJI = new RegExp(kanji, 'g');
    exports.BYTE_KANJI = new RegExp('[^A-Z0-9 $%*+\\-./:]+', 'g');
    exports.BYTE = new RegExp(_byte, 'g');
    exports.NUMERIC = new RegExp(numeric, 'g');
    exports.ALPHANUMERIC = new RegExp(alphanumeric, 'g');
    var TEST_KANJI = new RegExp('^' + kanji + '$');
    var TEST_NUMERIC = new RegExp('^' + numeric + '$');
    var TEST_ALPHANUMERIC = new RegExp('^[A-Z0-9 $%*+\\-./:]+$');

    exports.testKanji = function testKanji(str) {
      return TEST_KANJI.test(str);
    };

    exports.testNumeric = function testNumeric(str) {
      return TEST_NUMERIC.test(str);
    };

    exports.testAlphanumeric = function testAlphanumeric(str) {
      return TEST_ALPHANUMERIC.test(str);
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/segments.js":
  /*!**************************************************!*\
    !*** ./node_modules/qrcode/lib/core/segments.js ***!
    \**************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreSegmentsJs(module, exports, __webpack_require__) {
    var Mode = __webpack_require__(
    /*! ./mode */
    "./node_modules/qrcode/lib/core/mode.js");

    var NumericData = __webpack_require__(
    /*! ./numeric-data */
    "./node_modules/qrcode/lib/core/numeric-data.js");

    var AlphanumericData = __webpack_require__(
    /*! ./alphanumeric-data */
    "./node_modules/qrcode/lib/core/alphanumeric-data.js");

    var ByteData = __webpack_require__(
    /*! ./byte-data */
    "./node_modules/qrcode/lib/core/byte-data.js");

    var KanjiData = __webpack_require__(
    /*! ./kanji-data */
    "./node_modules/qrcode/lib/core/kanji-data.js");

    var Regex = __webpack_require__(
    /*! ./regex */
    "./node_modules/qrcode/lib/core/regex.js");

    var Utils = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/core/utils.js");

    var dijkstra = __webpack_require__(
    /*! dijkstrajs */
    "./node_modules/dijkstrajs/dijkstra.js");
    /**
     * Returns UTF8 byte length
     *
     * @param  {String} str Input string
     * @return {Number}     Number of byte
     */


    function getStringByteLength(str) {
      return unescape(encodeURIComponent(str)).length;
    }
    /**
     * Get a list of segments of the specified mode
     * from a string
     *
     * @param  {Mode}   mode Segment mode
     * @param  {String} str  String to process
     * @return {Array}       Array of object with segments data
     */


    function getSegments(regex, mode, str) {
      var segments = [];
      var result;

      while ((result = regex.exec(str)) !== null) {
        segments.push({
          data: result[0],
          index: result.index,
          mode: mode,
          length: result[0].length
        });
      }

      return segments;
    }
    /**
     * Extracts a series of segments with the appropriate
     * modes from a string
     *
     * @param  {String} dataStr Input string
     * @return {Array}          Array of object with segments data
     */


    function getSegmentsFromString(dataStr) {
      var numSegs = getSegments(Regex.NUMERIC, Mode.NUMERIC, dataStr);
      var alphaNumSegs = getSegments(Regex.ALPHANUMERIC, Mode.ALPHANUMERIC, dataStr);
      var byteSegs;
      var kanjiSegs;

      if (Utils.isKanjiModeEnabled()) {
        byteSegs = getSegments(Regex.BYTE, Mode.BYTE, dataStr);
        kanjiSegs = getSegments(Regex.KANJI, Mode.KANJI, dataStr);
      } else {
        byteSegs = getSegments(Regex.BYTE_KANJI, Mode.BYTE, dataStr);
        kanjiSegs = [];
      }

      var segs = numSegs.concat(alphaNumSegs, byteSegs, kanjiSegs);
      return segs.sort(function (s1, s2) {
        return s1.index - s2.index;
      }).map(function (obj) {
        return {
          data: obj.data,
          mode: obj.mode,
          length: obj.length
        };
      });
    }
    /**
     * Returns how many bits are needed to encode a string of
     * specified length with the specified mode
     *
     * @param  {Number} length String length
     * @param  {Mode} mode     Segment mode
     * @return {Number}        Bit length
     */


    function getSegmentBitsLength(length, mode) {
      switch (mode) {
        case Mode.NUMERIC:
          return NumericData.getBitsLength(length);

        case Mode.ALPHANUMERIC:
          return AlphanumericData.getBitsLength(length);

        case Mode.KANJI:
          return KanjiData.getBitsLength(length);

        case Mode.BYTE:
          return ByteData.getBitsLength(length);
      }
    }
    /**
     * Merges adjacent segments which have the same mode
     *
     * @param  {Array} segs Array of object with segments data
     * @return {Array}      Array of object with segments data
     */


    function mergeSegments(segs) {
      return segs.reduce(function (acc, curr) {
        var prevSeg = acc.length - 1 >= 0 ? acc[acc.length - 1] : null;

        if (prevSeg && prevSeg.mode === curr.mode) {
          acc[acc.length - 1].data += curr.data;
          return acc;
        }

        acc.push(curr);
        return acc;
      }, []);
    }
    /**
     * Generates a list of all possible nodes combination which
     * will be used to build a segments graph.
     *
     * Nodes are divided by groups. Each group will contain a list of all the modes
     * in which is possible to encode the given text.
     *
     * For example the text '12345' can be encoded as Numeric, Alphanumeric or Byte.
     * The group for '12345' will contain then 3 objects, one for each
     * possible encoding mode.
     *
     * Each node represents a possible segment.
     *
     * @param  {Array} segs Array of object with segments data
     * @return {Array}      Array of object with segments data
     */


    function buildNodes(segs) {
      var nodes = [];

      for (var i = 0; i < segs.length; i++) {
        var seg = segs[i];

        switch (seg.mode) {
          case Mode.NUMERIC:
            nodes.push([seg, {
              data: seg.data,
              mode: Mode.ALPHANUMERIC,
              length: seg.length
            }, {
              data: seg.data,
              mode: Mode.BYTE,
              length: seg.length
            }]);
            break;

          case Mode.ALPHANUMERIC:
            nodes.push([seg, {
              data: seg.data,
              mode: Mode.BYTE,
              length: seg.length
            }]);
            break;

          case Mode.KANJI:
            nodes.push([seg, {
              data: seg.data,
              mode: Mode.BYTE,
              length: getStringByteLength(seg.data)
            }]);
            break;

          case Mode.BYTE:
            nodes.push([{
              data: seg.data,
              mode: Mode.BYTE,
              length: getStringByteLength(seg.data)
            }]);
        }
      }

      return nodes;
    }
    /**
     * Builds a graph from a list of nodes.
     * All segments in each node group will be connected with all the segments of
     * the next group and so on.
     *
     * At each connection will be assigned a weight depending on the
     * segment's byte length.
     *
     * @param  {Array} nodes    Array of object with segments data
     * @param  {Number} version QR Code version
     * @return {Object}         Graph of all possible segments
     */


    function buildGraph(nodes, version) {
      var table = {};
      var graph = {
        'start': {}
      };
      var prevNodeIds = ['start'];

      for (var i = 0; i < nodes.length; i++) {
        var nodeGroup = nodes[i];
        var currentNodeIds = [];

        for (var j = 0; j < nodeGroup.length; j++) {
          var node = nodeGroup[j];
          var key = '' + i + j;
          currentNodeIds.push(key);
          table[key] = {
            node: node,
            lastCount: 0
          };
          graph[key] = {};

          for (var n = 0; n < prevNodeIds.length; n++) {
            var prevNodeId = prevNodeIds[n];

            if (table[prevNodeId] && table[prevNodeId].node.mode === node.mode) {
              graph[prevNodeId][key] = getSegmentBitsLength(table[prevNodeId].lastCount + node.length, node.mode) - getSegmentBitsLength(table[prevNodeId].lastCount, node.mode);
              table[prevNodeId].lastCount += node.length;
            } else {
              if (table[prevNodeId]) table[prevNodeId].lastCount = node.length;
              graph[prevNodeId][key] = getSegmentBitsLength(node.length, node.mode) + 4 + Mode.getCharCountIndicator(node.mode, version); // switch cost
            }
          }
        }

        prevNodeIds = currentNodeIds;
      }

      for (n = 0; n < prevNodeIds.length; n++) {
        graph[prevNodeIds[n]]['end'] = 0;
      }

      return {
        map: graph,
        table: table
      };
    }
    /**
     * Builds a segment from a specified data and mode.
     * If a mode is not specified, the more suitable will be used.
     *
     * @param  {String} data             Input data
     * @param  {Mode | String} modesHint Data mode
     * @return {Segment}                 Segment
     */


    function buildSingleSegment(data, modesHint) {
      var mode;
      var bestMode = Mode.getBestModeForData(data);
      mode = Mode.from(modesHint, bestMode); // Make sure data can be encoded

      if (mode !== Mode.BYTE && mode.bit < bestMode.bit) {
        throw new Error('"' + data + '"' + ' cannot be encoded with mode ' + Mode.toString(mode) + '.\n Suggested mode is: ' + Mode.toString(bestMode));
      } // Use Mode.BYTE if Kanji support is disabled


      if (mode === Mode.KANJI && !Utils.isKanjiModeEnabled()) {
        mode = Mode.BYTE;
      }

      switch (mode) {
        case Mode.NUMERIC:
          return new NumericData(data);

        case Mode.ALPHANUMERIC:
          return new AlphanumericData(data);

        case Mode.KANJI:
          return new KanjiData(data);

        case Mode.BYTE:
          return new ByteData(data);
      }
    }
    /**
     * Builds a list of segments from an array.
     * Array can contain Strings or Objects with segment's info.
     *
     * For each item which is a string, will be generated a segment with the given
     * string and the more appropriate encoding mode.
     *
     * For each item which is an object, will be generated a segment with the given
     * data and mode.
     * Objects must contain at least the property "data".
     * If property "mode" is not present, the more suitable mode will be used.
     *
     * @param  {Array} array Array of objects with segments data
     * @return {Array}       Array of Segments
     */


    exports.fromArray = function fromArray(array) {
      return array.reduce(function (acc, seg) {
        if (typeof seg === 'string') {
          acc.push(buildSingleSegment(seg, null));
        } else if (seg.data) {
          acc.push(buildSingleSegment(seg.data, seg.mode));
        }

        return acc;
      }, []);
    };
    /**
     * Builds an optimized sequence of segments from a string,
     * which will produce the shortest possible bitstream.
     *
     * @param  {String} data    Input string
     * @param  {Number} version QR Code version
     * @return {Array}          Array of segments
     */


    exports.fromString = function fromString(data, version) {
      var segs = getSegmentsFromString(data, Utils.isKanjiModeEnabled());
      var nodes = buildNodes(segs);
      var graph = buildGraph(nodes, version);
      var path = dijkstra.find_path(graph.map, 'start', 'end');
      var optimizedSegs = [];

      for (var i = 1; i < path.length - 1; i++) {
        optimizedSegs.push(graph.table[path[i]].node);
      }

      return exports.fromArray(mergeSegments(optimizedSegs));
    };
    /**
     * Splits a string in various segments with the modes which
     * best represent their content.
     * The produced segments are far from being optimized.
     * The output of this function is only used to estimate a QR Code version
     * which may contain the data.
     *
     * @param  {string} data Input string
     * @return {Array}       Array of segments
     */


    exports.rawSplit = function rawSplit(data) {
      return exports.fromArray(getSegmentsFromString(data, Utils.isKanjiModeEnabled()));
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/utils.js":
  /*!***********************************************!*\
    !*** ./node_modules/qrcode/lib/core/utils.js ***!
    \***********************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreUtilsJs(module, exports) {
    var toSJISFunction;
    var CODEWORDS_COUNT = [0, // Not used
    26, 44, 70, 100, 134, 172, 196, 242, 292, 346, 404, 466, 532, 581, 655, 733, 815, 901, 991, 1085, 1156, 1258, 1364, 1474, 1588, 1706, 1828, 1921, 2051, 2185, 2323, 2465, 2611, 2761, 2876, 3034, 3196, 3362, 3532, 3706];
    /**
     * Returns the QR Code size for the specified version
     *
     * @param  {Number} version QR Code version
     * @return {Number}         size of QR code
     */

    exports.getSymbolSize = function getSymbolSize(version) {
      if (!version) throw new Error('"version" cannot be null or undefined');
      if (version < 1 || version > 40) throw new Error('"version" should be in range from 1 to 40');
      return version * 4 + 17;
    };
    /**
     * Returns the total number of codewords used to store data and EC information.
     *
     * @param  {Number} version QR Code version
     * @return {Number}         Data length in bits
     */


    exports.getSymbolTotalCodewords = function getSymbolTotalCodewords(version) {
      return CODEWORDS_COUNT[version];
    };
    /**
     * Encode data with Bose-Chaudhuri-Hocquenghem
     *
     * @param  {Number} data Value to encode
     * @return {Number}      Encoded value
     */


    exports.getBCHDigit = function (data) {
      var digit = 0;

      while (data !== 0) {
        digit++;
        data >>>= 1;
      }

      return digit;
    };

    exports.setToSJISFunction = function setToSJISFunction(f) {
      if (typeof f !== 'function') {
        throw new Error('"toSJISFunc" is not a valid function.');
      }

      toSJISFunction = f;
    };

    exports.isKanjiModeEnabled = function () {
      return typeof toSJISFunction !== 'undefined';
    };

    exports.toSJIS = function toSJIS(kanji) {
      return toSJISFunction(kanji);
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/version-check.js":
  /*!*******************************************************!*\
    !*** ./node_modules/qrcode/lib/core/version-check.js ***!
    \*******************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreVersionCheckJs(module, exports) {
    /**
     * Check if QR Code version is valid
     *
     * @param  {Number}  version QR Code version
     * @return {Boolean}         true if valid version, false otherwise
     */
    exports.isValid = function isValid(version) {
      return !isNaN(version) && version >= 1 && version <= 40;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/core/version.js":
  /*!*************************************************!*\
    !*** ./node_modules/qrcode/lib/core/version.js ***!
    \*************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibCoreVersionJs(module, exports, __webpack_require__) {
    var Utils = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/core/utils.js");

    var ECCode = __webpack_require__(
    /*! ./error-correction-code */
    "./node_modules/qrcode/lib/core/error-correction-code.js");

    var ECLevel = __webpack_require__(
    /*! ./error-correction-level */
    "./node_modules/qrcode/lib/core/error-correction-level.js");

    var Mode = __webpack_require__(
    /*! ./mode */
    "./node_modules/qrcode/lib/core/mode.js");

    var VersionCheck = __webpack_require__(
    /*! ./version-check */
    "./node_modules/qrcode/lib/core/version-check.js");

    var isArray = __webpack_require__(
    /*! isarray */
    "./node_modules/qrcode/node_modules/isarray/index.js"); // Generator polynomial used to encode version information


    var G18 = 1 << 12 | 1 << 11 | 1 << 10 | 1 << 9 | 1 << 8 | 1 << 5 | 1 << 2 | 1 << 0;
    var G18_BCH = Utils.getBCHDigit(G18);

    function getBestVersionForDataLength(mode, length, errorCorrectionLevel) {
      for (var currentVersion = 1; currentVersion <= 40; currentVersion++) {
        if (length <= exports.getCapacity(currentVersion, errorCorrectionLevel, mode)) {
          return currentVersion;
        }
      }

      return undefined;
    }

    function getReservedBitsCount(mode, version) {
      // Character count indicator + mode indicator bits
      return Mode.getCharCountIndicator(mode, version) + 4;
    }

    function getTotalBitsFromDataArray(segments, version) {
      var totalBits = 0;
      segments.forEach(function (data) {
        var reservedBits = getReservedBitsCount(data.mode, version);
        totalBits += reservedBits + data.getBitsLength();
      });
      return totalBits;
    }

    function getBestVersionForMixedData(segments, errorCorrectionLevel) {
      for (var currentVersion = 1; currentVersion <= 40; currentVersion++) {
        var length = getTotalBitsFromDataArray(segments, currentVersion);

        if (length <= exports.getCapacity(currentVersion, errorCorrectionLevel, Mode.MIXED)) {
          return currentVersion;
        }
      }

      return undefined;
    }
    /**
     * Returns version number from a value.
     * If value is not a valid version, returns defaultValue
     *
     * @param  {Number|String} value        QR Code version
     * @param  {Number}        defaultValue Fallback value
     * @return {Number}                     QR Code version number
     */


    exports.from = function from(value, defaultValue) {
      if (VersionCheck.isValid(value)) {
        return parseInt(value, 10);
      }

      return defaultValue;
    };
    /**
     * Returns how much data can be stored with the specified QR code version
     * and error correction level
     *
     * @param  {Number} version              QR Code version (1-40)
     * @param  {Number} errorCorrectionLevel Error correction level
     * @param  {Mode}   mode                 Data mode
     * @return {Number}                      Quantity of storable data
     */


    exports.getCapacity = function getCapacity(version, errorCorrectionLevel, mode) {
      if (!VersionCheck.isValid(version)) {
        throw new Error('Invalid QR Code version');
      } // Use Byte mode as default


      if (typeof mode === 'undefined') mode = Mode.BYTE; // Total codewords for this QR code version (Data + Error correction)

      var totalCodewords = Utils.getSymbolTotalCodewords(version); // Total number of error correction codewords

      var ecTotalCodewords = ECCode.getTotalCodewordsCount(version, errorCorrectionLevel); // Total number of data codewords

      var dataTotalCodewordsBits = (totalCodewords - ecTotalCodewords) * 8;
      if (mode === Mode.MIXED) return dataTotalCodewordsBits;
      var usableBits = dataTotalCodewordsBits - getReservedBitsCount(mode, version); // Return max number of storable codewords

      switch (mode) {
        case Mode.NUMERIC:
          return Math.floor(usableBits / 10 * 3);

        case Mode.ALPHANUMERIC:
          return Math.floor(usableBits / 11 * 2);

        case Mode.KANJI:
          return Math.floor(usableBits / 13);

        case Mode.BYTE:
        default:
          return Math.floor(usableBits / 8);
      }
    };
    /**
     * Returns the minimum version needed to contain the amount of data
     *
     * @param  {Segment} data                    Segment of data
     * @param  {Number} [errorCorrectionLevel=H] Error correction level
     * @param  {Mode} mode                       Data mode
     * @return {Number}                          QR Code version
     */


    exports.getBestVersionForData = function getBestVersionForData(data, errorCorrectionLevel) {
      var seg;
      var ecl = ECLevel.from(errorCorrectionLevel, ECLevel.M);

      if (isArray(data)) {
        if (data.length > 1) {
          return getBestVersionForMixedData(data, ecl);
        }

        if (data.length === 0) {
          return 1;
        }

        seg = data[0];
      } else {
        seg = data;
      }

      return getBestVersionForDataLength(seg.mode, seg.getLength(), ecl);
    };
    /**
     * Returns version information with relative error correction bits
     *
     * The version information is included in QR Code symbols of version 7 or larger.
     * It consists of an 18-bit sequence containing 6 data bits,
     * with 12 error correction bits calculated using the (18, 6) Golay code.
     *
     * @param  {Number} version QR Code version
     * @return {Number}         Encoded version info bits
     */


    exports.getEncodedBits = function getEncodedBits(version) {
      if (!VersionCheck.isValid(version) || version < 7) {
        throw new Error('Invalid QR Code version');
      }

      var d = version << 12;

      while (Utils.getBCHDigit(d) - G18_BCH >= 0) {
        d ^= G18 << Utils.getBCHDigit(d) - G18_BCH;
      }

      return version << 12 | d;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/renderer/canvas.js":
  /*!****************************************************!*\
    !*** ./node_modules/qrcode/lib/renderer/canvas.js ***!
    \****************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibRendererCanvasJs(module, exports, __webpack_require__) {
    var Utils = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/renderer/utils.js");

    function clearCanvas(ctx, canvas, size) {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      if (!canvas.style) canvas.style = {};
      canvas.height = size;
      canvas.width = size;
      canvas.style.height = size + 'px';
      canvas.style.width = size + 'px';
    }

    function getCanvasElement() {
      try {
        return document.createElement('canvas');
      } catch (e) {
        throw new Error('You need to specify a canvas element');
      }
    }

    exports.render = function render(qrData, canvas, options) {
      var opts = options;
      var canvasEl = canvas;

      if (typeof opts === 'undefined' && (!canvas || !canvas.getContext)) {
        opts = canvas;
        canvas = undefined;
      }

      if (!canvas) {
        canvasEl = getCanvasElement();
      }

      opts = Utils.getOptions(opts);
      var size = Utils.getImageWidth(qrData.modules.size, opts);
      var ctx = canvasEl.getContext('2d');
      var image = ctx.createImageData(size, size);
      Utils.qrToImageData(image.data, qrData, opts);
      clearCanvas(ctx, canvasEl, size);
      ctx.putImageData(image, 0, 0);
      return canvasEl;
    };

    exports.renderToDataURL = function renderToDataURL(qrData, canvas, options) {
      var opts = options;

      if (typeof opts === 'undefined' && (!canvas || !canvas.getContext)) {
        opts = canvas;
        canvas = undefined;
      }

      if (!opts) opts = {};
      var canvasEl = exports.render(qrData, canvas, opts);
      var type = opts.type || 'image/png';
      var rendererOpts = opts.rendererOpts || {};
      return canvasEl.toDataURL(type, rendererOpts.quality);
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/renderer/svg-tag.js":
  /*!*****************************************************!*\
    !*** ./node_modules/qrcode/lib/renderer/svg-tag.js ***!
    \*****************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibRendererSvgTagJs(module, exports, __webpack_require__) {
    var Utils = __webpack_require__(
    /*! ./utils */
    "./node_modules/qrcode/lib/renderer/utils.js");

    function getColorAttrib(color, attrib) {
      var alpha = color.a / 255;
      var str = attrib + '="' + color.hex + '"';
      return alpha < 1 ? str + ' ' + attrib + '-opacity="' + alpha.toFixed(2).slice(1) + '"' : str;
    }

    function svgCmd(cmd, x, y) {
      var str = cmd + x;
      if (typeof y !== 'undefined') str += ' ' + y;
      return str;
    }

    function qrToPath(data, size, margin) {
      var path = '';
      var moveBy = 0;
      var newRow = false;
      var lineLength = 0;

      for (var i = 0; i < data.length; i++) {
        var col = Math.floor(i % size);
        var row = Math.floor(i / size);
        if (!col && !newRow) newRow = true;

        if (data[i]) {
          lineLength++;

          if (!(i > 0 && col > 0 && data[i - 1])) {
            path += newRow ? svgCmd('M', col + margin, 0.5 + row + margin) : svgCmd('m', moveBy, 0);
            moveBy = 0;
            newRow = false;
          }

          if (!(col + 1 < size && data[i + 1])) {
            path += svgCmd('h', lineLength);
            lineLength = 0;
          }
        } else {
          moveBy++;
        }
      }

      return path;
    }

    exports.render = function render(qrData, options, cb) {
      var opts = Utils.getOptions(options);
      var size = qrData.modules.size;
      var data = qrData.modules.data;
      var qrcodesize = size + opts.margin * 2;
      var bg = !opts.color.light.a ? '' : '<path ' + getColorAttrib(opts.color.light, 'fill') + ' d="M0 0h' + qrcodesize + 'v' + qrcodesize + 'H0z"/>';
      var path = '<path ' + getColorAttrib(opts.color.dark, 'stroke') + ' d="' + qrToPath(data, size, opts.margin) + '"/>';
      var viewBox = 'viewBox="' + '0 0 ' + qrcodesize + ' ' + qrcodesize + '"';
      var width = !opts.width ? '' : 'width="' + opts.width + '" height="' + opts.width + '" ';
      var svgTag = '<svg xmlns="http://www.w3.org/2000/svg" ' + width + viewBox + ' shape-rendering="crispEdges">' + bg + path + '</svg>\n';

      if (typeof cb === 'function') {
        cb(null, svgTag);
      }

      return svgTag;
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/renderer/utils.js":
  /*!***************************************************!*\
    !*** ./node_modules/qrcode/lib/renderer/utils.js ***!
    \***************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibRendererUtilsJs(module, exports) {
    function hex2rgba(hex) {
      if (typeof hex === 'number') {
        hex = hex.toString();
      }

      if (typeof hex !== 'string') {
        throw new Error('Color should be defined as hex string');
      }

      var hexCode = hex.slice().replace('#', '').split('');

      if (hexCode.length < 3 || hexCode.length === 5 || hexCode.length > 8) {
        throw new Error('Invalid hex color: ' + hex);
      } // Convert from short to long form (fff -> ffffff)


      if (hexCode.length === 3 || hexCode.length === 4) {
        hexCode = Array.prototype.concat.apply([], hexCode.map(function (c) {
          return [c, c];
        }));
      } // Add default alpha value


      if (hexCode.length === 6) hexCode.push('F', 'F');
      var hexValue = parseInt(hexCode.join(''), 16);
      return {
        r: hexValue >> 24 & 255,
        g: hexValue >> 16 & 255,
        b: hexValue >> 8 & 255,
        a: hexValue & 255,
        hex: '#' + hexCode.slice(0, 6).join('')
      };
    }

    exports.getOptions = function getOptions(options) {
      if (!options) options = {};
      if (!options.color) options.color = {};
      var margin = typeof options.margin === 'undefined' || options.margin === null || options.margin < 0 ? 4 : options.margin;
      var width = options.width && options.width >= 21 ? options.width : undefined;
      var scale = options.scale || 4;
      return {
        width: width,
        scale: width ? 4 : scale,
        margin: margin,
        color: {
          dark: hex2rgba(options.color.dark || '#000000ff'),
          light: hex2rgba(options.color.light || '#ffffffff')
        },
        type: options.type,
        rendererOpts: options.rendererOpts || {}
      };
    };

    exports.getScale = function getScale(qrSize, opts) {
      return opts.width && opts.width >= qrSize + opts.margin * 2 ? opts.width / (qrSize + opts.margin * 2) : opts.scale;
    };

    exports.getImageWidth = function getImageWidth(qrSize, opts) {
      var scale = exports.getScale(qrSize, opts);
      return Math.floor((qrSize + opts.margin * 2) * scale);
    };

    exports.qrToImageData = function qrToImageData(imgData, qr, opts) {
      var size = qr.modules.size;
      var data = qr.modules.data;
      var scale = exports.getScale(size, opts);
      var symbolSize = Math.floor((size + opts.margin * 2) * scale);
      var scaledMargin = opts.margin * scale;
      var palette = [opts.color.light, opts.color.dark];

      for (var i = 0; i < symbolSize; i++) {
        for (var j = 0; j < symbolSize; j++) {
          var posDst = (i * symbolSize + j) * 4;
          var pxColor = opts.color.light;

          if (i >= scaledMargin && j >= scaledMargin && i < symbolSize - scaledMargin && j < symbolSize - scaledMargin) {
            var iSrc = Math.floor((i - scaledMargin) / scale);
            var jSrc = Math.floor((j - scaledMargin) / scale);
            pxColor = palette[data[iSrc * size + jSrc] ? 1 : 0];
          }

          imgData[posDst++] = pxColor.r;
          imgData[posDst++] = pxColor.g;
          imgData[posDst++] = pxColor.b;
          imgData[posDst] = pxColor.a;
        }
      }
    };
    /***/

  },

  /***/
  "./node_modules/qrcode/lib/utils/typedarray-buffer.js":
  /*!************************************************************!*\
    !*** ./node_modules/qrcode/lib/utils/typedarray-buffer.js ***!
    \************************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeLibUtilsTypedarrayBufferJs(module, exports, __webpack_require__) {
    "use strict";
    /**
     * Implementation of a subset of node.js Buffer methods for the browser.
     * Based on https://github.com/feross/buffer
     */

    /* eslint-disable no-proto */

    var isArray = __webpack_require__(
    /*! isarray */
    "./node_modules/qrcode/node_modules/isarray/index.js");

    function typedArraySupport() {
      // Can typed array instances be augmented?
      try {
        var arr = new Uint8Array(1);
        arr.__proto__ = {
          __proto__: Uint8Array.prototype,
          foo: function foo() {
            return 42;
          }
        };
        return arr.foo() === 42;
      } catch (e) {
        return false;
      }
    }

    Buffer.TYPED_ARRAY_SUPPORT = typedArraySupport();
    var K_MAX_LENGTH = Buffer.TYPED_ARRAY_SUPPORT ? 0x7fffffff : 0x3fffffff;

    function Buffer(arg, offset, length) {
      if (!Buffer.TYPED_ARRAY_SUPPORT && !(this instanceof Buffer)) {
        return new Buffer(arg, offset, length);
      }

      if (typeof arg === 'number') {
        return allocUnsafe(this, arg);
      }

      return from(this, arg, offset, length);
    }

    if (Buffer.TYPED_ARRAY_SUPPORT) {
      Buffer.prototype.__proto__ = Uint8Array.prototype;
      Buffer.__proto__ = Uint8Array; // Fix subarray() in ES2016. See: https://github.com/feross/buffer/pull/97

      if (typeof Symbol !== 'undefined' && Symbol.species && Buffer[Symbol.species] === Buffer) {
        Object.defineProperty(Buffer, Symbol.species, {
          value: null,
          configurable: true,
          enumerable: false,
          writable: false
        });
      }
    }

    function checked(length) {
      // Note: cannot use `length < K_MAX_LENGTH` here because that fails when
      // length is NaN (which is otherwise coerced to zero.)
      if (length >= K_MAX_LENGTH) {
        throw new RangeError('Attempt to allocate Buffer larger than maximum ' + 'size: 0x' + K_MAX_LENGTH.toString(16) + ' bytes');
      }

      return length | 0;
    }

    function isnan(val) {
      return val !== val; // eslint-disable-line no-self-compare
    }

    function createBuffer(that, length) {
      var buf;

      if (Buffer.TYPED_ARRAY_SUPPORT) {
        buf = new Uint8Array(length);
        buf.__proto__ = Buffer.prototype;
      } else {
        // Fallback: Return an object instance of the Buffer class
        buf = that;

        if (buf === null) {
          buf = new Buffer(length);
        }

        buf.length = length;
      }

      return buf;
    }

    function allocUnsafe(that, size) {
      var buf = createBuffer(that, size < 0 ? 0 : checked(size) | 0);

      if (!Buffer.TYPED_ARRAY_SUPPORT) {
        for (var i = 0; i < size; ++i) {
          buf[i] = 0;
        }
      }

      return buf;
    }

    function fromString(that, string) {
      var length = byteLength(string) | 0;
      var buf = createBuffer(that, length);
      var actual = buf.write(string);

      if (actual !== length) {
        // Writing a hex string, for example, that contains invalid characters will
        // cause everything after the first invalid character to be ignored. (e.g.
        // 'abxxcd' will be treated as 'ab')
        buf = buf.slice(0, actual);
      }

      return buf;
    }

    function fromArrayLike(that, array) {
      var length = array.length < 0 ? 0 : checked(array.length) | 0;
      var buf = createBuffer(that, length);

      for (var i = 0; i < length; i += 1) {
        buf[i] = array[i] & 255;
      }

      return buf;
    }

    function fromArrayBuffer(that, array, byteOffset, length) {
      if (byteOffset < 0 || array.byteLength < byteOffset) {
        throw new RangeError('\'offset\' is out of bounds');
      }

      if (array.byteLength < byteOffset + (length || 0)) {
        throw new RangeError('\'length\' is out of bounds');
      }

      var buf;

      if (byteOffset === undefined && length === undefined) {
        buf = new Uint8Array(array);
      } else if (length === undefined) {
        buf = new Uint8Array(array, byteOffset);
      } else {
        buf = new Uint8Array(array, byteOffset, length);
      }

      if (Buffer.TYPED_ARRAY_SUPPORT) {
        // Return an augmented `Uint8Array` instance, for best performance
        buf.__proto__ = Buffer.prototype;
      } else {
        // Fallback: Return an object instance of the Buffer class
        buf = fromArrayLike(that, buf);
      }

      return buf;
    }

    function fromObject(that, obj) {
      if (Buffer.isBuffer(obj)) {
        var len = checked(obj.length) | 0;
        var buf = createBuffer(that, len);

        if (buf.length === 0) {
          return buf;
        }

        obj.copy(buf, 0, 0, len);
        return buf;
      }

      if (obj) {
        if (typeof ArrayBuffer !== 'undefined' && obj.buffer instanceof ArrayBuffer || 'length' in obj) {
          if (typeof obj.length !== 'number' || isnan(obj.length)) {
            return createBuffer(that, 0);
          }

          return fromArrayLike(that, obj);
        }

        if (obj.type === 'Buffer' && Array.isArray(obj.data)) {
          return fromArrayLike(that, obj.data);
        }
      }

      throw new TypeError('First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.');
    }

    function utf8ToBytes(string, units) {
      units = units || Infinity;
      var codePoint;
      var length = string.length;
      var leadSurrogate = null;
      var bytes = [];

      for (var i = 0; i < length; ++i) {
        codePoint = string.charCodeAt(i); // is surrogate component

        if (codePoint > 0xD7FF && codePoint < 0xE000) {
          // last char was a lead
          if (!leadSurrogate) {
            // no lead yet
            if (codePoint > 0xDBFF) {
              // unexpected trail
              if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD);
              continue;
            } else if (i + 1 === length) {
              // unpaired lead
              if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD);
              continue;
            } // valid lead


            leadSurrogate = codePoint;
            continue;
          } // 2 leads in a row


          if (codePoint < 0xDC00) {
            if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD);
            leadSurrogate = codePoint;
            continue;
          } // valid surrogate pair


          codePoint = (leadSurrogate - 0xD800 << 10 | codePoint - 0xDC00) + 0x10000;
        } else if (leadSurrogate) {
          // valid bmp char, but last char was a lead
          if ((units -= 3) > -1) bytes.push(0xEF, 0xBF, 0xBD);
        }

        leadSurrogate = null; // encode utf8

        if (codePoint < 0x80) {
          if ((units -= 1) < 0) break;
          bytes.push(codePoint);
        } else if (codePoint < 0x800) {
          if ((units -= 2) < 0) break;
          bytes.push(codePoint >> 0x6 | 0xC0, codePoint & 0x3F | 0x80);
        } else if (codePoint < 0x10000) {
          if ((units -= 3) < 0) break;
          bytes.push(codePoint >> 0xC | 0xE0, codePoint >> 0x6 & 0x3F | 0x80, codePoint & 0x3F | 0x80);
        } else if (codePoint < 0x110000) {
          if ((units -= 4) < 0) break;
          bytes.push(codePoint >> 0x12 | 0xF0, codePoint >> 0xC & 0x3F | 0x80, codePoint >> 0x6 & 0x3F | 0x80, codePoint & 0x3F | 0x80);
        } else {
          throw new Error('Invalid code point');
        }
      }

      return bytes;
    }

    function byteLength(string) {
      if (Buffer.isBuffer(string)) {
        return string.length;
      }

      if (typeof ArrayBuffer !== 'undefined' && typeof ArrayBuffer.isView === 'function' && (ArrayBuffer.isView(string) || string instanceof ArrayBuffer)) {
        return string.byteLength;
      }

      if (typeof string !== 'string') {
        string = '' + string;
      }

      var len = string.length;
      if (len === 0) return 0;
      return utf8ToBytes(string).length;
    }

    function blitBuffer(src, dst, offset, length) {
      for (var i = 0; i < length; ++i) {
        if (i + offset >= dst.length || i >= src.length) break;
        dst[i + offset] = src[i];
      }

      return i;
    }

    function utf8Write(buf, string, offset, length) {
      return blitBuffer(utf8ToBytes(string, buf.length - offset), buf, offset, length);
    }

    function from(that, value, offset, length) {
      if (typeof value === 'number') {
        throw new TypeError('"value" argument must not be a number');
      }

      if (typeof ArrayBuffer !== 'undefined' && value instanceof ArrayBuffer) {
        return fromArrayBuffer(that, value, offset, length);
      }

      if (typeof value === 'string') {
        return fromString(that, value, offset);
      }

      return fromObject(that, value);
    }

    Buffer.prototype.write = function write(string, offset, length) {
      // Buffer#write(string)
      if (offset === undefined) {
        length = this.length;
        offset = 0; // Buffer#write(string, encoding)
      } else if (length === undefined && typeof offset === 'string') {
        length = this.length;
        offset = 0; // Buffer#write(string, offset[, length])
      } else if (isFinite(offset)) {
        offset = offset | 0;

        if (isFinite(length)) {
          length = length | 0;
        } else {
          length = undefined;
        }
      }

      var remaining = this.length - offset;
      if (length === undefined || length > remaining) length = remaining;

      if (string.length > 0 && (length < 0 || offset < 0) || offset > this.length) {
        throw new RangeError('Attempt to write outside buffer bounds');
      }

      return utf8Write(this, string, offset, length);
    };

    Buffer.prototype.slice = function slice(start, end) {
      var len = this.length;
      start = ~~start;
      end = end === undefined ? len : ~~end;

      if (start < 0) {
        start += len;
        if (start < 0) start = 0;
      } else if (start > len) {
        start = len;
      }

      if (end < 0) {
        end += len;
        if (end < 0) end = 0;
      } else if (end > len) {
        end = len;
      }

      if (end < start) end = start;
      var newBuf;

      if (Buffer.TYPED_ARRAY_SUPPORT) {
        newBuf = this.subarray(start, end); // Return an augmented `Uint8Array` instance

        newBuf.__proto__ = Buffer.prototype;
      } else {
        var sliceLen = end - start;
        newBuf = new Buffer(sliceLen, undefined);

        for (var i = 0; i < sliceLen; ++i) {
          newBuf[i] = this[i + start];
        }
      }

      return newBuf;
    };

    Buffer.prototype.copy = function copy(target, targetStart, start, end) {
      if (!start) start = 0;
      if (!end && end !== 0) end = this.length;
      if (targetStart >= target.length) targetStart = target.length;
      if (!targetStart) targetStart = 0;
      if (end > 0 && end < start) end = start; // Copy 0 bytes; we're done

      if (end === start) return 0;
      if (target.length === 0 || this.length === 0) return 0; // Fatal error conditions

      if (targetStart < 0) {
        throw new RangeError('targetStart out of bounds');
      }

      if (start < 0 || start >= this.length) throw new RangeError('sourceStart out of bounds');
      if (end < 0) throw new RangeError('sourceEnd out of bounds'); // Are we oob?

      if (end > this.length) end = this.length;

      if (target.length - targetStart < end - start) {
        end = target.length - targetStart + start;
      }

      var len = end - start;
      var i;

      if (this === target && start < targetStart && targetStart < end) {
        // descending copy from end
        for (i = len - 1; i >= 0; --i) {
          target[i + targetStart] = this[i + start];
        }
      } else if (len < 1000 || !Buffer.TYPED_ARRAY_SUPPORT) {
        // ascending copy from start
        for (i = 0; i < len; ++i) {
          target[i + targetStart] = this[i + start];
        }
      } else {
        Uint8Array.prototype.set.call(target, this.subarray(start, start + len), targetStart);
      }

      return len;
    };

    Buffer.prototype.fill = function fill(val, start, end) {
      // Handle string cases:
      if (typeof val === 'string') {
        if (typeof start === 'string') {
          start = 0;
          end = this.length;
        } else if (typeof end === 'string') {
          end = this.length;
        }

        if (val.length === 1) {
          var code = val.charCodeAt(0);

          if (code < 256) {
            val = code;
          }
        }
      } else if (typeof val === 'number') {
        val = val & 255;
      } // Invalid ranges are not set to a default, so can range check early.


      if (start < 0 || this.length < start || this.length < end) {
        throw new RangeError('Out of range index');
      }

      if (end <= start) {
        return this;
      }

      start = start >>> 0;
      end = end === undefined ? this.length : end >>> 0;
      if (!val) val = 0;
      var i;

      if (typeof val === 'number') {
        for (i = start; i < end; ++i) {
          this[i] = val;
        }
      } else {
        var bytes = Buffer.isBuffer(val) ? val : new Buffer(val);
        var len = bytes.length;

        for (i = 0; i < end - start; ++i) {
          this[i + start] = bytes[i % len];
        }
      }

      return this;
    };

    Buffer.concat = function concat(list, length) {
      if (!isArray(list)) {
        throw new TypeError('"list" argument must be an Array of Buffers');
      }

      if (list.length === 0) {
        return createBuffer(null, 0);
      }

      var i;

      if (length === undefined) {
        length = 0;

        for (i = 0; i < list.length; ++i) {
          length += list[i].length;
        }
      }

      var buffer = allocUnsafe(null, length);
      var pos = 0;

      for (i = 0; i < list.length; ++i) {
        var buf = list[i];

        if (!Buffer.isBuffer(buf)) {
          throw new TypeError('"list" argument must be an Array of Buffers');
        }

        buf.copy(buffer, pos);
        pos += buf.length;
      }

      return buffer;
    };

    Buffer.byteLength = byteLength;
    Buffer.prototype._isBuffer = true;

    Buffer.isBuffer = function isBuffer(b) {
      return !!(b != null && b._isBuffer);
    };

    module.exports = Buffer;
    /***/
  },

  /***/
  "./node_modules/qrcode/node_modules/isarray/index.js":
  /*!***********************************************************!*\
    !*** ./node_modules/qrcode/node_modules/isarray/index.js ***!
    \***********************************************************/

  /*! no static exports found */

  /***/
  function node_modulesQrcodeNode_modulesIsarrayIndexJs(module, exports) {
    var toString = {}.toString;

    module.exports = Array.isArray || function (arr) {
      return toString.call(arr) == '[object Array]';
    };
    /***/

  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.html":
  /*!*****************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.html ***!
    \*****************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesProfilemanagementContactinformationAddcontactAddcontactComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" class=\"sidenavmainrow\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex.gt-xs=\"100\" fxFlex=\"100\">\r\n        <form class=\"sidenavform\" [formGroup]=\"formGroup\" #formDirective=\"ngForm\" autocomplete=\"off\"\r\n            (ngSubmit)=\"save(formDirective)\">\r\n            <div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"m-t-0 p-b-0\">\r\n                <!-- column -->\r\n                <div *ngIf=\"!hideComponentHeader\" fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\" selectproductheaderwithclose\">\r\n                    <div class=\"titletext\">\r\n                        <div class=\"closeandadd\">\r\n                            <i mat-button matTooltip=\"Close\" aria-label=\"Displays a tooltip\"\r\n                                matTooltipClass=\"custom-tooltip\" (click)=\"showSweetAlert()\"\r\n                                class=\"bgi bgi-close p-l-5 fs-14\"></i>\r\n                            <h5 class=\"m-0 p-l-20 tt\">Contact Information<i\r\n                                    (click)=\"toggleShowDiv('descriptioncontentmarketpresence')\"\r\n                                    class=\"bgi bgi-info\"></i></h5>\r\n                        </div>\r\n\r\n                        <div class=\"clearandaddbutton\">\r\n                            <div class=\"infosteplist\" *ngIf=\"showtoolicon\" (click)=\"infolisting('infoview')\">\r\n                                <i class=\"bgi bgi-question\"matTooltip=\"Help\"></i>\r\n                            </div>\r\n                            <button type=\"button\" mat-raised-button color=\"primary\"\r\n                                class=\"clearbutton height-35 m-r-10 p-l-20 p-r-20\"\r\n                                (click)=\"resetData(formDirective);\">Clear</button>\r\n                            <button *ngIf=\"!hideLocationlist\" color=\"preview\" type=\"submit\"\r\n                                [disabled]=\"isFormValid || disableSubmitButton\" mat-raised-button ngClass.xs=\" m-r-15\"\r\n                                ngClass.sm=\" m-r-15\" class=\"addbutton height-35 p-l-20 p-r-20\">{{buttonname}}</button>\r\n                            <span *ngIf=\"hideLocationlist\">\r\n                                <button *ngIf=\"!showmapbutton\" color=\"preview\" type=\"submit\"\r\n                                    [disabled]=\"isFormValid || disableSubmitButton\" mat-raised-button\r\n                                    ngClass.xs=\" m-r-15\" ngClass.sm=\" m-r-15\"\r\n                                    class=\"addbutton height-35 p-l-20 p-r-20\">{{buttonname}}</button>\r\n                                <button *ngIf=\"showmapbutton\" color=\"preview\" type=\"button\"\r\n                                    [disabled]=\"selected_location_id == null || selected_location_id == ''\"\r\n                                    mat-raised-button ngClass.xs=\" m-r-15\" ngClass.sm=\" m-r-15\"\r\n                                    class=\"addbutton height-35 p-l-20 p-r-20\"\r\n                                    (click)=\"mapselectedlocation()\">Map</button>\r\n                            </span>\r\n\r\n                        </div>\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n            <div *ngIf=\"!hideComponentHeader\" fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\"\r\n                class=\"p-t-0 descriptioncontentmarketpresence\" [@slideInOut]=\"animationState\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\">\r\n                    <mat-card class=\"headerinformationtext sidenavinfotext m-r-0\">\r\n                        <mat-card-header>\r\n                            <div class=\"titletext\" *ngIf=\"dyHelpContent\">\r\n                                <mat-card-subtitle class=\"informationtext fs-14\">\r\n                                    <div> {{dyHelpContent.title}}</div>\r\n\r\n                                </mat-card-subtitle>\r\n                            </div>\r\n                            <div *ngIf=\"!dyHelpContent\" class=\"titletext\" fxFlex.xs=\"100\" fxFlex.sm=\"80\" fxFlex.md=\"100\"\r\n                                fxFlex.lg=\"100\" fxFlex.xl=\"100\">\r\n                                <mat-card-subtitle class=\"informationtext fs-14\">\r\n                                    {{ helpContent }}\r\n                                </mat-card-subtitle>\r\n                            </div>\r\n                            <div class=\"selectforward m-r-0\">\r\n                                <div class=\"p-l-15 gotit\">\r\n                                    <span (click)=\"toggleShowDiv('descriptioncontentmarketpresence')\" mat-raised-button\r\n                                        color=\"primary\">Ok, Got It </span>\r\n                                </div>\r\n                            </div>\r\n                        </mat-card-header>\r\n                    </mat-card>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\" class=\"p-t-0 infoview\" [@slideInOut]=\"animationState2\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\">\r\n                    <mat-card class=\"headerinformationtext sidenavinfotext m-r-0 infosteps\">\r\n                        <mat-card-header>\r\n                            <div class=\"titletext\" *ngIf=\"dyHelpContent\">\r\n                                <mat-card-subtitle class=\"informationtext fs-14\">\r\n                                    <div>\r\n                                        <h5 class=\"m-t-5\"><b>{{dyHelpContent.boldHeading}}</b></h5>\r\n                                        <ul class=\"p-l-10 m-t-6\">\r\n                                            <li *ngFor=\"let listContent of dyHelpContent?.list\">{{listContent.content}}\r\n                                            </li>\r\n                                        </ul>\r\n                                    </div>\r\n                                </mat-card-subtitle>\r\n                            </div>\r\n                            <div class=\"selectforward m-r-0\">\r\n                                <div class=\"p-l-15 gotit\">\r\n                                    <span (click)=\"infolisting('infoview')\" mat-raised-button color=\"primary\">Ok, Got It\r\n                                    </span>\r\n                                </div>\r\n                            </div>\r\n                        </mat-card-header>\r\n                    </mat-card>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row wrap\" fxFlexAlign=\"center\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                    <div *ngIf=\"locationType != 13 && locationType != 16 && locationType != 4\" fxLayout=\"row wrap\"\r\n                        fxFlexAlign=\"center\" class=\"borderbottom\">\r\n                        <div fxFlex.gt-sm=\"70\" fxFlex=\"100\" class=\"companyinfomcp p-l-75\">\r\n                            <img src=\"{{logoUrl}}\" alt=\"company logo\">\r\n                            <div class=\"p-l-10 content\">\r\n                                <p class=\"p-b-8 fs-15 w-100\">{{companyname}}</p>\r\n                                <p class=\"lypisid w-100\"><span>OPAL ID: </span> <span>{{lypisID}}</span></p>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n\r\n                    <div class=\"innnerpartofdrwer\" #scrollDiv [ngClass]=\"(hideLocationlist)?'':'noscroll'\">\r\n                        <div fxLayout=\"row wrap\" class=\"organisationinfo\" fxLayoutAlign=\"center\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\" class=\"data_width\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabsection mptab\">\r\n                                    <mat-tab-group (selectedTabChange)=\"setshowmap($event)\" #tab [disableRipple]=\"true\"\r\n                                        [ngClass]=\"(hideLocationlist)?'':'hidetabstyle'\">\r\n                                        <mat-tab label=\"First\" *ngIf=\"hideLocationlist\">\r\n                                            <ng-template mat-tab-label>\r\n                                                <div #mapTab class=\"tabselectheadercontent\">\r\n                                                    <div class=\"selectionlogo\">\r\n                                                        <i class=\"bgi bgi-Existing\"></i>\r\n                                                    </div>\r\n                                                    <div class=\"selectiontext\">\r\n                                                        <h4>Map</h4>\r\n                                                        <p>Map your existing {{sideNavSubHeaderNameText}} Location\r\n                                                            Details.</p>\r\n                                                    </div>\r\n                                                </div>\r\n                                            </ng-template>\r\n                                            <div fxLayout=\"row wrap\" class=\"m-t-20\">\r\n                                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                    <div class=\"busisearchdiv m-b-25 w-100\">\r\n                                                        <div class=\"bssearchbox\">\r\n                                                            <button type=\"button\" mat-raised-button\r\n                                                                class=\"searchbtn m-r-10\"><i\r\n                                                                    class=\"bgi bgi-search\"></i></button>\r\n                                                            <mat-form-field class=\"searchfielddiv\">\r\n                                                                <input #searchFieldbus\r\n                                                                    (keyup)=\"filteroutlocation(searchFieldbus.value,1)\"\r\n                                                                    matInput autocomplete=\"nope\"\r\n                                                                    placeholder=\"Search by Email ID/Mobile/Country/Address\">\r\n                                                            </mat-form-field>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    <div class=\"w-100\" *ngFor=\"let localst of locationlists\">\r\n                                                        <mat-card class=\"selectedbsfull\">\r\n                                                            <mat-card-header>\r\n                                                                <div class=\"sbsimg\">\r\n                                                                    <mat-radio-button\r\n                                                                        [checked]=\"selected_location_id == localst.memcompmplocationdtls_pk\"\r\n                                                                        (click)=\"setlocationid(localst.memcompmplocationdtls_pk)\">\r\n                                                                    </mat-radio-button>\r\n                                                                </div>\r\n                                                                <div class=\"sbsdetails\">\r\n                                                                    <!--mat-card-title class=\"selecttitle fs-16 p-b-5 m-b-0\">\r\n                                      <span>{{localst.ltype}}</span>\r\n                                    </mat-card-title-->\r\n                                                                    <mat-card-subtitle\r\n                                                                        class=\"selectsubtitle m-t-0 fs-16\">\r\n                                                                        <p class=\"country\">\r\n                                                                            <span class=\"cbox-label\">Country</span>\r\n                                                                            <span class=\"cbox-value\">\r\n                                                                                <img class=\"flagicon\"\r\n                                                                                    src=\"assets/images/flags/{{localst.dialcode_country_pk + '.png'}}\"\r\n                                                                                    alt=\"Oman\" /> {{localst.country}}\r\n                                                                            </span>\r\n                                                                        </p>\r\n                                                                        <p class=\"country\">\r\n                                                                            <span class=\"cbox-label\">Landline</span>\r\n                                                                            <span\r\n                                                                                class=\"cbox-value\">{{localst.dialocode_country_code\r\n                                                                                + '' +\r\n                                                                                localst.mcmpld_landlineno}}</span>\r\n                                                                        </p>\r\n                                                                        <p class=\"country\">\r\n                                                                            <span class=\"cbox-label\">Mail</span>\r\n                                                                            <span\r\n                                                                                class=\"cbox-value\">{{localst.mcmpld_emailid}}</span>\r\n                                                                        </p>\r\n                                                                        <p class=\"address\">\r\n                                                                            <span class=\"cbox-label\">Address</span>\r\n                                                                            <span class=\"cbox-value cutetext\">\r\n                                                                                {{localst.mcmpld_address}}\r\n                                                                            </span>\r\n                                                                        </p>\r\n                                                                    </mat-card-subtitle>\r\n                                                                </div>\r\n                                                            </mat-card-header>\r\n                                                        </mat-card>\r\n                                                    </div>\r\n                                                    <div class=\"w-100 m-t-30\" *ngIf=\"locationlists.length == 0\">\r\n                                                        No record found\r\n                                                    </div>\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-tab>\r\n                                        <mat-tab label=\"First\">\r\n                                            <ng-template mat-tab-label>\r\n                                                <div class=\"tabselectheadercontent\">\r\n                                                    <div class=\"selectionlogo\">\r\n                                                        <i class=\"bgi bgi-New_icon align\"></i>\r\n                                                    </div>\r\n                                                    <div ngClass.xs=\"p-t-10\" ngClass.sm=\"p-t-10\"\r\n                                                        class=\"selectiontext p-l-8\">\r\n                                                        <h4 class=\"createresolution\">Create New</h4>\r\n                                                        <p class=\"savedresolution\">\r\n                                                            Add the details of your {{sideNavSubHeaderNameText}}\r\n                                                            Location.</p>\r\n                                                    </div>\r\n                                                </div>\r\n                                            </ng-template>\r\n                                            <div fxLayout=\"row wrap\" fxFlexAlign=\"center\">\r\n                                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"mapwidth\">\r\n                                                    <!-- <div class=\"profilelinkboxshadow m-b-10\">\r\n                                <div fxLayout=\"row wrap\" class=\"borderflex\">\r\n  \r\n                                  <div fxFlex.gt-sm=\"8\" fxFlex=\"100\" class=\"p-l-15\">\r\n                                    <i class=\"bgi bgi-search Searchcolor\"></i>\r\n                                  </div>\r\n                                  <div fxFlex.gt-sm=\"92\" fxFlex=\"100\" class=\"Search\">\r\n                                    <input app-restrict-input=\"firstspace\"\r\n                                      placeholder=\" Search your Existing Details From Google Maps\" class=\"border\" required>\r\n                                  </div>\r\n  \r\n                                </div>\r\n                              </div> -->\r\n                                                </div>\r\n                                            </div>\r\n                                            <div *ngIf=\"locationType == 13\" fxLayout=\"row wrap\" fxFlexAlign=\"center\">\r\n                                                <div fxFlex.gt-sm=\"45\" fxFlex=\"100\" class=\"m-b-10\">\r\n                                                    <mat-form-field>\r\n                                                        <mat-label>Transport Type</mat-label>\r\n                                                        <mat-select\r\n                                                            (selectionChange)=\"changeLabelName(formGroup?.controls['transporttype'].value)\"\r\n                                                            formControlName=\"transporttype\" panelClass=\"myPanelClass\"\r\n                                                            [disableOptionCentering]=\"true\" required>\r\n                                                            <mat-option *ngFor=\"let transtype of transporttypes\"\r\n                                                                [value]=\"transtype.tvalue\">\r\n                                                                {{transtype.tlabel}}</mat-option>\r\n                                                        </mat-select>\r\n                                                        <mat-error *ngIf=\"form?.transporttype.errors?.required\">\r\n                                                            Select transport type\r\n                                                        </mat-error>\r\n                                                    </mat-form-field>\r\n                                                </div>\r\n                                                <!-- column -->\r\n                                            </div>\r\n                                            <!-- <div *ngIf=\"locationType == 16\" fxLayout=\"row wrap\" fxFlexAlign=\"center\">\r\n                          <div fxFlex.gt-sm=\"45\" fxFlex=\"100\" class=\"m-b-10\">\r\n                            <mat-form-field>\r\n                              <mat-label>Delivery location Type</mat-label>\r\n                              <mat-select formControlName=\"deliveryLocationType\" panelClass=\"myPanelClass\"\r\n                                [disableOptionCentering]=\"true\" required>\r\n                                <mat-option *ngFor=\"let deliverytype of deliverytypes\" [value]=\"deliverytype.tvalue\">\r\n                                  {{deliverytype.tlabel}}</mat-option>\r\n                              </mat-select>\r\n                            </mat-form-field>\r\n                          </div>\r\n                          <div fxFlex.gt-sm=\"65\" fxFlex=\"100\" class=\"l-l-15\"\r\n                            *ngIf=\"form?.deliveryLocationType.value == '3'\">\r\n                            <mat-form-field>\r\n                              <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb placeholder=\"Other\"\r\n                                formControlName=\"otherloc\" maxlength=\"150\" required>\r\n                              <mat-error *ngIf=\"form?.otherloc.errors?.required\">\r\n                                Enter othere\r\n                              </mat-error>\r\n                            </mat-form-field>\r\n                          </div>\r\n                        </div> -->\r\n                                            <div fxLayout=\"row wrap\" fxFlexAlign=\"center\">\r\n                                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"mapwidth m-t-20\">\r\n                                                    <app-bgimaps #map *ngIf=\"enabled\" [country]=\"mapMarkerLocation\"\r\n                                                        [city_auto_list_filed]=\"true\" [lat_field]=\"true\"\r\n                                                        [long_field]=\"true\" [address_field]=\"false\" [zoom_level]=\"1\"\r\n                                                        [latitude]=\"latitude\" [longitude]=\"longitude\"\r\n                                                        [draggable]=\"false\" [street_view]=\"false\"\r\n                                                        [searchboxApperance]=\"'standard'\"\r\n                                                        [placeholderText]=\"'Search your location from Google Maps'\"\r\n                                                        fxFlex.gt-sm=\"100\" fxFlex=\"100\"\r\n                                                        (locationObject)=\"getLocationDetails($event)\">\r\n                                                    </app-bgimaps>\r\n                                                </div>\r\n                                            </div>\r\n                                            <div fxLayout=\"row wrap\" class=\"organisationinfo  p-t-20\">\r\n                                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\">\r\n                                                    <app-filee #complogo isLogo=true *ngIf=\"showLogo\"\r\n                                                        [fileMstRef]=\"drv_repcomplogo\"\r\n                                                        (filesSelected)=\"fileeSelected($event,drv_repcomplogo)\"\r\n                                                        formControlName=\"repcomplogo\" isMandatory=\"true\"></app-filee>\r\n                                                    <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n\r\n                                                        <div fxFlex=\"100\">\r\n                                                            <mat-form-field>\r\n                                                                <input matInput [errorStateMatcher]=\"matcher\"\r\n                                                                    app-restrict-input=\"firstspace\" minlength=\"1\"\r\n                                                                    autocomplete=\"nope\" appAlphanumsymb\r\n                                                                    placeholder=\"Head Quarters (Location - City)\"\r\n                                                                    formControlName=\"crn\"\r\n                                                                    [required]=\"stkholdertype==6?true:false\">\r\n                                                                <mat-error *ngIf=\"form?.crn.errors?.required\">\r\n                                                                    Enter head quarter\r\n                                                                </mat-error>\r\n                                                            </mat-form-field>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    <div fxLayout=\"row wrap\" fxFlexAlign=\"center\">\r\n                                                        <div fxFlex.gt-sm=\"100\" fxFlex=\"  100\" class=\"p-b-10\">\r\n                                                            <mat-form-field>\r\n                                                                <label>Address</label>\r\n                                                                <input matInput minlength=\"1\" [errorStateMatcher]=\"matcher\"\r\n                                                                    app-restrict-input=\"firstspace\" appAlphanumsymb\r\n                                                                    autocomplete=\"nope\" formControlName=\"address\"\r\n                                                                    required>\r\n                                                                <mat-error *ngIf=\"form?.crn.errors?.required\">\r\n                                                                    Enter address\r\n                                                                </mat-error>\r\n                                                            </mat-form-field>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    <div fxLayout=\"row wrap\" fxLayoutGap.sm=\"10px grid\"\r\n                                                        fxLayoutGap.md=\"10px grid\" fxLayoutGap.lg=\"10px grid\"\r\n                                                        fxLayoutGap.xl=\"10px grid\" fxLayoutGap=\"10px grid\"\r\n                                                        class=\"flexsame\">\r\n\r\n                                                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.md=\"p-r-30\"\r\n                                                            ngClass.lg=\"p-r-30 paddingspace\" ngClass.sm=\"p-r-0\"\r\n                                                            ngClass.xs=\"p-r-0\" ngClass.xl=\"p-r-30\">\r\n                                                            <div fxLayout=\"row wrap\" class=\"setcountryflag flexsame\">\r\n                                                                <div class=\"flagimage code\">\r\n                                                                    <mat-form-field class=\"country-flag\">\r\n                                                                        <mat-select  minlength=\"1\" maxlength=\"5\" placeholder=\"Code\"\r\n                                                                            [(value)]=\"country_code_flag\"\r\n                                                                            (closed)=\"searchCountryFlag = ''\"\r\n                                                                            (selectionChange)=\"setcountryFlag($event.value);\"\r\n                                                                            panelClass=\"select_with_search\"\r\n                                                                            [disabled]=\"country_code_flag == defaultCountryPk\"\r\n                                                                            [disableOptionCentering]=\"true\"\r\n                                                                            *ngIf=\"(countrylist | searchFilter: searchCountryFlag : 'CyM_CountryName_en') as result\">\r\n                                                                            <mat-select-trigger>\r\n                                                                                <img src=\"assets/images/flags/{{country_code_flag}}.png\"\r\n                                                                                    alt=\"Country Flag\">\r\n                                                                            </mat-select-trigger>\r\n                                                                            <div class=\"searchinmultiselect\">\r\n                                                                                <i class=\"bgi bgi-search\"></i>\r\n                                                                                <input matInput class=\"searchselect\"\r\n                                                                                    [(ngModel)]=\"searchCountryFlag\"\r\n                                                                                    autocomplete=\"nope\"\r\n                                                                                    placeholder=\"Search\"\r\n                                                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                                                    [ngModelOptions]=\"{standalone: true}\">\r\n                                                                                <i (click)=\"searchCountryFlag = ''\"\r\n                                                                                    class=\"reseticon\" matSuffix\r\n                                                                                    *ngIf=\"searchCountryFlag !='' && searchCountryFlag !=null\"\r\n                                                                                    class=\"bgi bgi-close\"></i>\r\n                                                                            </div>\r\n                                                                            <div class=\"option-listing\">\r\n                                                                                <mat-option class=\"countrynameselect\"\r\n                                                                                    *ngFor=\"let country of countrylist | searchFilter: searchCountryFlag : 'CyM_CountryName_en'\"\r\n                                                                                    [value]=\"country.CountryMst_Pk\">\r\n                                                                                    <img src=\"assets/images/flags/{{country.CountryMst_Pk}}.png\"\r\n                                                                                        alt=\"Country Flag\">\r\n                                                                                    {{country.CyM_CountryName_en}}\r\n                                                                                </mat-option>\r\n                                                                                <div class=\"p-t-10\"\r\n                                                                                    *ngIf=\"result.length == 0\">\r\n                                                                                    No country match your search\r\n                                                                                    criteria!\r\n                                                                                </div>\r\n                                                                            </div>\r\n                                                                        </mat-select>\r\n                                                                        <mat-error\r\n                                                                            *ngIf=\"form?.landline_cc.errors?.required\">\r\n                                                                            Enter country code\r\n                                                                        </mat-error>\r\n                                                                    </mat-form-field>\r\n                                                                </div>\r\n                                                                <div class=\"p-l-10  number\">\r\n                                                                    <mat-form-field class=\"d-flex\" floatLabel=\"always\"\r\n                                                                        class=\"numberandcode\">\r\n                                                                        <span class=\"p-r-10\">{{phonecode}}</span>\r\n                                                                        <input matInput app-restrict-input=\"firstspace\"\r\n                                                                            appNumberonly minlength=\"1\" maxlength=\"20\" \r\n                                                                            autocomplete=\"nope\"\r\n                                                                            formControlName=\"landline_no\"\r\n                                                                            class=\"preFlag\" placeholder=\"Landline\"\r\n                                                                            required>\r\n                                                                        <input matInput hidden='true'\r\n                                                                            placeholder=\"Phone Code\"\r\n                                                                            autocomplete=\"nope\">\r\n                                                                        <mat-error\r\n                                                                            *ngIf=\"form?.landline_no.errors?.required\">\r\n                                                                            Enter phone number\r\n                                                                        </mat-error>\r\n                                                                    </mat-form-field>\r\n\r\n                                                                </div>\r\n                                                                <div class=\"ext p-l-10\">\r\n                                                                    <mat-form-field>\r\n                                                                        <input matInput app-restrict-input=\"firstspace\"\r\n                                                                            appNumberonly minlength=\"1\" maxlength=\"5\"\r\n                                                                            autocomplete=\"nope\"\r\n                                                                            formControlName=\"landline_ext\"\r\n                                                                            placeholder=\"Ext.\">\r\n                                                                    </mat-form-field>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                                            <div fxLayout=\"row wrap\" class=\"setcountryflag flexsame\">\r\n                                                                <div class=\"flagimage widthflagview\">\r\n                                                                    <mat-form-field class=\"country-flag\">\r\n                                                                        <mat-select  minlength=\"1\" maxlength=\"5\" placeholder=\"Code\"\r\n                                                                            [(value)]=\"country_code_flag\"\r\n                                                                            (closed)=\"searchCountryFlag = ''\"\r\n                                                                            (selectionChange)=\"setcountryFlag($event.value);\"\r\n                                                                            panelClass=\"select_with_search\"\r\n                                                                            [disabled]=\"country_code_flag == defaultCountryPk\"\r\n                                                                            [disableOptionCentering]=\"true\"\r\n                                                                            *ngIf=\"(countrylist | searchFilter: searchCountryFlag : 'CyM_CountryName_en') as result\">\r\n                                                                            <mat-select-trigger>\r\n                                                                                <img src=\"assets/images/flags/{{country_code_flag}}.png\"\r\n                                                                                    alt=\"Country Flag\">\r\n                                                                            </mat-select-trigger>\r\n                                                                            <div class=\"searchinmultiselect\">\r\n                                                                                <i class=\"bgi bgi-search\"></i>\r\n                                                                                <input matInput class=\"searchselect\"\r\n                                                                                    [(ngModel)]=\"searchCountryFlag\"\r\n                                                                                    autocomplete=\"nope\"\r\n                                                                                    placeholder=\"Search\"\r\n                                                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                                                    [ngModelOptions]=\"{standalone: true}\">\r\n                                                                                <i (click)=\"searchCountryFlag = ''\"\r\n                                                                                    class=\"reseticon\" matSuffix\r\n                                                                                    *ngIf=\"searchCountryFlag !='' && searchCountryFlag !=null\"\r\n                                                                                    class=\"bgi bgi-close\"></i>\r\n                                                                            </div>\r\n                                                                            <div class=\"option-listing\">\r\n                                                                                <mat-option class=\"countrynameselect\"\r\n                                                                                    *ngFor=\"let country of countrylist | searchFilter: searchCountryFlag : 'CyM_CountryName_en'\"\r\n                                                                                    [value]=\"country.CountryMst_Pk\">\r\n                                                                                    <img src=\"assets/images/flags/{{country.CountryMst_Pk}}.png\"\r\n                                                                                        alt=\"Country Flag\">\r\n                                                                                    {{country.CyM_CountryName_en}}\r\n                                                                                </mat-option>\r\n                                                                                <div class=\"p-t-10\"\r\n                                                                                    *ngIf=\"result.length == 0\">\r\n                                                                                    No country match your search\r\n                                                                                    criteria!\r\n                                                                                </div>\r\n                                                                            </div>\r\n                                                                        </mat-select>\r\n                                                                        <mat-error\r\n                                                                            *ngIf=\"form?.landline_cc.errors?.required\">\r\n                                                                            Enter country code\r\n                                                                        </mat-error>\r\n                                                                    </mat-form-field>\r\n                                                                </div>\r\n                                                                <div class=\"widthfax p-l-10\">\r\n                                                                    <mat-form-field>\r\n                                                                        <input matInput app-restrict-input=\"firstspace\"\r\n                                                                        appNumberonly maxlength=\"20\" minlength=\"1\" autocomplete=\"nope\"\r\n                                                                            formControlName=\"landline_ext\"\r\n                                                                            placeholder=\"Fax\">\r\n                                                                    </mat-form-field>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    <div fxLayout=\"row wrap\" class=\"flexsame p-t-15\">\r\n                                                        <div fxFlex=\"100\">\r\n                                                            <mat-form-field>\r\n                                                                <input matInput appAlphanumsymb minlength=\"1\"\r\n                                                                    maxlength=\"250\" placeholder=\"Email ID\"\r\n                                                                    autocomplete=\"nope\" formControlName=\"emailid\"\r\n                                                                    required>\r\n                                                                <mat-error *ngIf=\"form?.emailid.errors?.required\">\r\n                                                                    Enter email ID\r\n                                                                </mat-error>\r\n                                                                <mat-error *ngIf=\"form?.emailid.errors?.pattern\">\r\n                                                                    Enter valid email ID\r\n                                                                </mat-error>\r\n                                                            </mat-form-field>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    <div fxLayout=\"row wrap\" class=\"flexsame\">\r\n                                                        <!-- column -->\r\n                                                        <div fxFlex=\"100\">\r\n                                                            <mat-form-field>\r\n                                                                <input matInput app-restrict-input=\"firstspace\"\r\n                                                                    appAlphanumsymb minlength=\"1\" autocomplete=\"nope\"\r\n                                                                    maxlength=\"250\" placeholder=\" Organisation Website\"\r\n                                                                    formControlName=\"website\">\r\n                                                                <mat-error *ngIf=\"form?.website.errors?.pattern\">\r\n                                                                    Enter valid website\r\n                                                                </mat-error>\r\n                                                            </mat-form-field>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-tab>\r\n                                    </mat-tab-group>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </form>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/contactinformation/contactinformation.component.html":
  /*!**************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/contactinformation/contactinformation.component.html ***!
    \**************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesProfilemanagementContactinformationContactinformationComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" ngClass.sm=\"p-r-15 p-l-15 mastercompnaycontent\" ngClass.xs=\"p-r-15 p-l-15 mastercompnaycontent\"\r\n    class=\"mastercompnaycontent\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n        <div fxLayout=\"row wrap\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                <div class=\"topheadermain\">\r\n                    <div class=\"imagewithtext\">\r\n                        <h4 class=\"p-l-20 mat-pagetitle-1\">Master Company Profile</h4>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"center\" class=\" organizationdetail\" id=\"mastercompanydetail\" class=\"m-t-40\">\r\n            <div fxFlex.gt-sm=\"83.33\" fxFlex=\"100\">\r\n                <div fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <div class=\"progressandhistory\">\r\n                            <div class=\"pagetitlenew\">\r\n                                <h4 class=\"mat-pagetitle-2\">4. Contact Information</h4>\r\n                            </div>\r\n\r\n                        </div>\r\n                        <mat-accordion class=\"commonexpandandcollapse m-t-15\">\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"\" class=\"triggeredto\" id=\"cust1\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                    <mat-expansion-panel [expanded]=\"panel === panelNo\" (opened)=\"panel = panelNo\">\r\n                                        <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                                            [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                                            <mat-panel-title>\r\n                                                <div class=\"accrodianheader\">\r\n                                                    <p class=\"header m-0 fs-15\">\r\n                                                        <span class=\"pagenumberinprofile\"\r\n                                                            [class.completed]=\"resultsLength\">4.{{panelNo}}</span>\r\n                                                        <span>Contact Information</span>\r\n                                                    </p>\r\n                                                </div>\r\n                                            </mat-panel-title>\r\n                                        </mat-expansion-panel-header>\r\n                                        <div fxLayout=\"row wrap\" class=\"organisationinfo\">\r\n                                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                <div fxLayout=\"row wrap\">\r\n                                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                        <div fxLayout=\"row wrap\" class=\"certiticatecounts m-b-20\">\r\n                                                            <div ngClass.xs=\"m-l-0\" ngclass.sm=\"m-l-15\"\r\n                                                                fxFlex.gt-sm=\"66\" fxFlex=\"100\" class=\"width\">\r\n                                                                <mat-paginator\r\n                                                                    [style.visibility]=\"(resultsLength > 3) ? 'visible' : 'hidden' \"\r\n                                                                    class=\"masterPage masterPageTop\" #paginator\r\n                                                                    [length]=\"resultsLength\" [pageSize]=\"perpage\"\r\n                                                                    (page)=\"onPaginateChange($event)\"\r\n                                                                    [pageSizeOptions]=\"paginationSet\">\r\n                                                                </mat-paginator>\r\n                                                            </div>\r\n\r\n                                                            <div ngClass.lg=\"searchinfo\" ngC lass.md=\"searchinfo\"\r\n                                                                ngClass.xs=\"searchinfo start\"\r\n                                                                ngclass.sm=\"searchinfo start\" fxFlex.gt-sm=\"34\"\r\n                                                                fxFlex=\"100\" class=\"searchinfo widthsecond\">\r\n                                                                <mat-form-field class=\"m-r-15\" *ngIf=\"overallcnt > 0\">\r\n                                                                    <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                                        autocomplete=\"off\" placeholder=\"Search\" matInput\r\n                                                                        [(ngModel)]=\"searchmarketpresence\">\r\n                                                                    <button mat-button matSuffix mat-icon-button\r\n                                                                        aria-label=\"Search\" (click)=\"onFilterSubmit()\">\r\n                                                                        <mat-icon matSuffix>search</mat-icon>\r\n                                                                    </button>\r\n                                                                    <button mat-button *ngIf=\"searchmarketpresence\"\r\n                                                                        matSuffix mat-icon-button aria-label=\"Clear\"\r\n                                                                        (click)=\"searchmarketpresence = '';onFilterSubmit()\">\r\n                                                                        <mat-icon>close</mat-icon>\r\n                                                                    </button>\r\n                                                                </mat-form-field>\r\n\r\n                                                                <div class=\"showfilterandadditem m-b-0\">\r\n                                                                    <button\r\n                                                                        (click)=\"loadAddComponent = true;addbranchoff()\"\r\n                                                                        type=\"button\" mat-raised-button color=\"preview\"\r\n                                                                        class=\"height-35 \">\r\n                                                                        Add\r\n                                                                    </button>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </div>\r\n\r\n                                                <div fxLayout=\"row wrap\" class=\"\" *ngIf=\"achivementData?.length > 0\" >\r\n                                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                        <div class=\"addedcertificate\">\r\n                                                            <div class=\"certificates\">\r\n                                                                <div class=\"certificateicon\">\r\n                                                                    <i class=\"bgi bgi-Business_Source cursorupoint\"\r\n                                                                        matTooltip=\"\"></i>\r\n                                                                    <!-- <img src=\"./assets/images/nocertificateimage.png\" alt=\"certiticate\"> -->\r\n                                                                </div>\r\n                                                                <div class=\"certificateinfo\">\r\n                                                                    <h4 class=\"header\">Ministry of Energy and Minaral Development (MEMD)</h4>                                                                    \r\n                                                                    <h5 class=\"m-t-5 fs-14 txt-6\">Address</h5>\r\n                                                                    <p class=\"m-t-0\">\r\n                                                                        2nd Floor,Building 4 (KOM4),Knowledge Oasis Muscut, Al Rusail,Muscut Government,Sultane of Oman,<br>\r\n                                                                        Muscat Expy,Seeb,Oman\r\n                                                                    </p>\r\n                                                                        <div class=\"d-flex\">\r\n                                                                            <div class=\"w-50\">\r\n                                                                                <p ><span class=\"txt-6\">Land:</span><span>+986 2416 6100</span></p>\r\n                                                                                <p ><span class=\"txt-6\">Fax:</span><span>+986 2416 6104</span></p>\r\n                                                                            </div>\r\n                                                                            <div class=\"w-50\">\r\n                                                                                <p ><span class=\"txt-6\">Email:</span><span>info@energyminral.com</span></p>\r\n                                                                                <p ><span class=\"txt-6\">Website:</span><span>www.energyiminaral.og.ug</span></p>\r\n                                                                            </div>\r\n                                                                        </div>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                            <div class=\"editanddelete\">\r\n                                                                <span class=\"edit m-r-20\"><i\r\n                                                                        class=\"bgi bgi-edit1 cursorupoint\"\r\n                                                                        matTooltip=\"Edit\"></i></span>\r\n                                                                <span matTooltip=\"Delete\" class=\"delete\"><i\r\n                                                                        class=\"bgi bgi-delete\"></i></span>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </div>\r\n                                                <div fxLayout=\"row wrap\" *ngIf=\"!achivementData\"\r\n                                                    class=\"m-t-0 noducumentaddedyet\">\r\n                                                    <div fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                            <img src=\"./assets/images/no_records.svg\" alt=\"nocollateral\">\r\n                                                            <p class=\"fs-16 lypisfont-bold  header m-0 lh-25 p-t-20\">\r\n                                                                There's nothing in here, yet\r\n                                                            </p>\r\n                                                            <p class=\"fs-14 lypisfont-regular m-0 txt-gray9 p-b-20\">\r\n                                                                Adding your achievements would give\r\n                                                                more\r\n                                                                credibility to your profile.</p>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </div>\r\n                                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\"\r\n                                                    *ngIf=\"resultsLength > 3\">\r\n                                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                        <mat-paginator class=\"masterPage masterbottom\"\r\n                                                            showFirstLastButtons\r\n                                                            (page)=\"onPaginateChange($event);syncPrimaryPaginator($event);\"\r\n                                                            [pageSize]=\"paginator?.pageSize\"\r\n                                                            [pageIndex]=\"paginator?.pageIndex\"\r\n                                                            [length]=\"paginator?.length\"\r\n                                                            [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                                        </mat-paginator>\r\n                                                    </div>\r\n                                                </div>\r\n                                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-t-30 cancelandpublish\">\r\n                                                    <button type=\"button\" mat-raised-button color=\"secondary\"\r\n                                                        (click)=\"openPrev()\"\r\n                                                        class=\"m-r-12 button-40 previousbutton\">Previous</button>\r\n                                                    <button type=\"button\" mat-raised-button color=\"primary\"\r\n                                                        (click)=\"openNext()\" class=\" button-40 nextbutton\">Next</button>\r\n                                                </div>\r\n                                            </div>\r\n                                        </div>\r\n                                    </mat-expansion-panel>\r\n                                </div>\r\n                            </div>\r\n                        </mat-accordion>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<mat-drawer-container class=\"example-container\">\r\n    <mat-drawer disableClose #drawer class=\"example-sidenav sidenavsamewidthall\" mode=\"over\" position=\"end\">\r\n        <app-addcontact *ngIf=\"loadAddComponent\" #addmarketpresence [drawer]=\"drawer\" [companyname]=\"companyname\"\r\n            [locationType]=\"locationType\" [countrylist]=\"countrylist\" [sideNavHeaderName]=\"'Branch Office'\"\r\n            [namePlaceholder]=\"'Branch Office Name'\" [addressPlaceholder]=\"'Office Address'\"\r\n            [popupContentPrefix]=\"'Branch Office'\" (marketpresencelist)=\"updatedList($event)\" [perpage]=\"perpage\"\r\n            [logoUrl]=\"logoUrl\" [hidePropertyType]=\"true\" [dyHelpContent]=\"dyHelpContent\"\r\n            [helpContent]=\"'Fill in the details of your registered branches. Branches are outlets at different locations that don’t constitute a separate legal entity.'\">\r\n        </app-addcontact>\r\n    </mat-drawer>\r\n</mat-drawer-container>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/welcomeback/welcomeback.component.html":
  /*!************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/welcomeback/welcomeback.component.html ***!
    \************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesProfilemanagementWelcomebackWelcomebackComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" *ngIf=\"showwelcomeback =='1'\"   fxLayoutAlign=\"flex-end\" class=\"m-t-0 welcomebackrow\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"maindivision\">\r\n    <div class=\"welcomeback\">\r\n      <mat-card>\r\n        <mat-card-header class=\"addproductheaders\">\r\n          <div mat-card-avatar class=\"example-header-image m-r-0\">\r\n            <img src=\"assets/images/editor.svg\" alt=\"\" />\r\n          </div>\r\n          <div  routerLink=\"{{routerlink}}\" (click)=\"welcomeback()\" class=\"titletext\">\r\n            <mat-card-title  class=\"selecttitle notyettitle fs-18 p-b-2 m-b-0\">{{'welcomeback.welcback' | translate}}</mat-card-title>\r\n            <mat-card-subtitle class=\"selectsubtitle fs-14\">{{'welcomeback.tolastedit' | translate}}</mat-card-subtitle>\r\n          </div>\r\n        </mat-card-header>\r\n        <mat-card-actions>\r\n          <div>\r\n            <span (click)=\"cancellastview()\" class=\"close\">{{'welcomeback.close' | translate}}</span>\r\n          </div>\r\n        </mat-card-actions>\r\n      </mat-card>\r\n    </div>\r\n  </div>\r\n  </div>";
    /***/
  },

  /***/
  "./src/app/common/city/service/city.service.ts":
  /*!*****************************************************!*\
    !*** ./src/app/common/city/service/city.service.ts ***!
    \*****************************************************/

  /*! exports provided: CityService */

  /***/
  function srcAppCommonCityServiceCityServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "CityService", function () {
      return CityService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/http */
    "./node_modules/@angular/http/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var rxjs_add_observable_of__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! rxjs/add/observable/of */
    "./node_modules/rxjs-compat/_esm2015/add/observable/of.js");

    var _url;

    var CityService = /*#__PURE__*/function () {
      function CityService(_http) {
        _classCallCheck(this, CityService);

        this._http = _http;
        this._url = 'mst/citymaster/';
        this.filterurl = 'mst/citymaster/index';
      }

      _createClass(CityService, [{
        key: "createcity",
        value: function createcity(formvalues, moduleID, accessType) {
          var body = JSON.stringify({
            'citymaster': formvalues
          });
          return this._http.post(this._url + 'newcity' + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "updatecity",
        value: function updatecity(id, formvalues, moduleID, accessType) {
          var body = JSON.stringify({
            'citymaster': formvalues
          });
          return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getcity",
        value: function getcity() {
          return this._http.get(this._url + 'citylist').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getcitybyid",
        value: function getcitybyid(id, moduleID, accessType) {
          return this._http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getcitybystateid",
        value: function getcitybystateid(id, moduleID, accessType) {
          return this._http.get(this._url + 'getcitybystateid?stateid=' + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "editcity",
        value: function editcity(id, moduleID, accessType) {
          return this._http.get(this._url + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "updatestatus",
        value: function updatestatus(id, moduleID, accessType) {
          var body = JSON.stringify({
            'updatestatus': id
          });
          return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "deletecity",
        value: function deletecity(id, moduleID, accessType) {
          return this._http["delete"](this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "citytablefilter",
        value: function citytablefilter(filterpagestring, name, status) {
          var options = new _angular_http__WEBPACK_IMPORTED_MODULE_2__["RequestOptions"]({
            headers: new _angular_http__WEBPACK_IMPORTED_MODULE_2__["Headers"]({})
          });
          var url_params = "".concat(this.filterurl, "?").concat(filterpagestring, "&CM_CityName_en=").concat(name, "&type=", 'filter', "&CM_Status=").concat(status);
          return this._http.get(url_params, options).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "citylist",
        value: function citylist() {
          return this._http.get(this._url + 'citylist').map(function (res) {
            return res.json();
          });
        }
      }]);

      return CityService;
    }();

    CityService.ctorParameters = function () {
      return [{
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }];
    };

    CityService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]])], CityService);
    /***/
  },

  /***/
  "./src/app/common/class/script.load.ts":
  /*!*********************************************!*\
    !*** ./src/app/common/class/script.load.ts ***!
    \*********************************************/

  /*! exports provided: ScriptService */

  /***/
  function srcAppCommonClassScriptLoadTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ScriptService", function () {
      return ScriptService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _script_store__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ./script.store */
    "./src/app/common/class/script.store.ts");

    var ScriptService = /*#__PURE__*/function () {
      function ScriptService() {
        var _this5 = this;

        _classCallCheck(this, ScriptService);

        this.scripts = {};

        _script_store__WEBPACK_IMPORTED_MODULE_2__["ScriptStore"].forEach(function (script) {
          _this5.scripts[script.name] = {
            loaded: false,
            src: script.src
          };
        });
      }

      _createClass(ScriptService, [{
        key: "load",
        value: function load() {
          var _this6 = this;

          var promises = [];

          for (var _len = arguments.length, scripts = new Array(_len), _key = 0; _key < _len; _key++) {
            scripts[_key] = arguments[_key];
          }

          scripts.forEach(function (script) {
            return promises.push(_this6.loadScript(script));
          });
          return Promise.all(promises);
        }
      }, {
        key: "unloadScript",
        value: function unloadScript(name) {
          this.scripts[name].unloadScript();
        }
      }, {
        key: "loadScript",
        value: function loadScript(name) {
          var _this7 = this;

          return new Promise(function (resolve, reject) {
            //resolve if already loaded
            if (_this7.scripts[name].loaded) {
              resolve({
                script: name,
                loaded: true,
                status: 'Already Loaded'
              });
            } else {
              //load script
              var script = document.createElement('script');
              script.type = 'text/javascript';
              script.src = _this7.scripts[name].src;

              if (script.readyState) {
                //IE
                script.onreadystatechange = function () {
                  if (script.readyState === "loaded" || script.readyState === "complete") {
                    script.onreadystatechange = null;
                    _this7.scripts[name].loaded = true;
                    resolve({
                      script: name,
                      loaded: true,
                      status: 'Loaded'
                    });
                  }
                };
              } else {
                //Others
                script.onload = function () {
                  _this7.scripts[name].loaded = true;
                  resolve({
                    script: name,
                    loaded: true,
                    status: 'Loaded'
                  });
                };
              }

              script.onerror = function (error) {
                return resolve({
                  script: name,
                  loaded: false,
                  status: 'Loaded'
                });
              };

              document.getElementsByTagName('head')[0].appendChild(script);
            }
          });
        }
      }]);

      return ScriptService;
    }();

    ScriptService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [])], ScriptService);
    /***/
  },

  /***/
  "./src/app/common/class/script.store.ts":
  /*!**********************************************!*\
    !*** ./src/app/common/class/script.store.ts ***!
    \**********************************************/

  /*! exports provided: ScriptStore */

  /***/
  function srcAppCommonClassScriptStoreTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ScriptStore", function () {
      return ScriptStore;
    });

    var ScriptStore = [{
      name: 'twitter',
      src: 'https://platform.twitter.com/widgets.js'
    }, {
      name: 'instagram',
      src: 'https://www.instagram.com/embed.js'
    }];
    /***/
  },

  /***/
  "./src/app/common/classes/driveInput.ts":
  /*!**********************************************!*\
    !*** ./src/app/common/classes/driveInput.ts ***!
    \**********************************************/

  /*! exports provided: ValidateDrive */

  /***/
  function srcAppCommonClassesDriveInputTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ValidateDrive", function () {
      return ValidateDrive;
    });

    function ValidateDrive(control) {
      if (control.value !== null && control.value.length < 1) {
        return {
          validDrive: true
        };
      }

      return null;
    }
    /***/

  },

  /***/
  "./src/app/common/currency/createcurrency/currrency.service.ts":
  /*!*********************************************************************!*\
    !*** ./src/app/common/currency/createcurrency/currrency.service.ts ***!
    \*********************************************************************/

  /*! exports provided: CurrrencyService */

  /***/
  function srcAppCommonCurrencyCreatecurrencyCurrrencyServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "CurrrencyService", function () {
      return CurrrencyService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/http */
    "./node_modules/@angular/http/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var rxjs_add_observable_of__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! rxjs/add/observable/of */
    "./node_modules/rxjs-compat/_esm2015/add/observable/of.js");

    var _url;

    var CurrrencyService = /*#__PURE__*/function () {
      function CurrrencyService(http) {
        _classCallCheck(this, CurrrencyService);

        this.http = http;
        this._url = 'mst/currencymaster/';
        this.filterurl = 'mst/currencymaster/index';
      }

      _createClass(CurrrencyService, [{
        key: "getcurrency",
        value: function getcurrency() {
          return this.http.get(this.filterurl).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "create",
        value: function create(postval, moduleID, accessType) {
          var body = JSON.stringify({
            'currencymaster': postval
          });
          return this.http.post("".concat(this._url, "newcurrency?uac=f3f86bb473399a2239202c31420a1ee1&uam=").concat(moduleID, "&uat=").concat(accessType), body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "update",
        value: function update(id, postval, moduleID, accessType) {
          var body = JSON.stringify({
            'currencymaster': postval
          });
          return this.http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "editcurrency",
        value: function editcurrency(id, moduleID, accessType) {
          return this.http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "updatestatus",
        value: function updatestatus(id) {
          var body = JSON.stringify({
            'updatestatus': id
          });
          return this.http.put(this._url + id, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "deletecurrency",
        value: function deletecurrency(id, moduleID, accessType) {
          return this.http["delete"](this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType);
        }
      }, {
        key: "filtertable",
        value: function filtertable(filterpagestring, symbol, name, status) {
          var options = new _angular_http__WEBPACK_IMPORTED_MODULE_2__["RequestOptions"]({
            headers: new _angular_http__WEBPACK_IMPORTED_MODULE_2__["Headers"]({})
          });
          var f_url = "".concat(this.filterurl, "?").concat(filterpagestring, "&CurM_CurrSymbol=").concat(symbol, "&CurM_CurrencyName_en=").concat(name, "&CurM_Status=").concat(status, "&type=", 'filter');
          return this.http.get(f_url, options).map(function (res) {
            return res.json();
          });
        }
      }]);

      return CurrrencyService;
    }();

    CurrrencyService.ctorParameters = function () {
      return [{
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }];
    };

    CurrrencyService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]])], CurrrencyService);
    /***/
  },

  /***/
  "./src/app/common/directives/date_format.ts":
  /*!**************************************************!*\
    !*** ./src/app/common/directives/date_format.ts ***!
    \**************************************************/

  /*! exports provided: DateFormat */

  /***/
  function srcAppCommonDirectivesDate_formatTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "DateFormat", function () {
      return DateFormat;
    });
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");

    var SUPPORTS_INTL_API = typeof Intl !== 'undefined';

    var DateFormat = /*#__PURE__*/function (_angular_material_cor) {
      _inherits(DateFormat, _angular_material_cor);

      var _super = _createSuper(DateFormat);

      function DateFormat() {
        var _this8;

        _classCallCheck(this, DateFormat);

        _this8 = _super.apply(this, arguments);
        _this8.useUtcForDisplay = true;
        return _this8;
      }

      _createClass(DateFormat, [{
        key: "parse",
        value: function parse(value) {
          if (typeof value === 'string' && value.indexOf('/') > -1) {
            var str = value.split('/');
            var year = Number(str[2]);
            var month = Number(str[1]) - 1;
            var date = Number(str[0]);
            return new Date(year, month, date);
          }

          var timestamp = typeof value === 'number' ? value : Date.parse(value);
          return isNaN(timestamp) ? null : new Date(timestamp);
        }
      }]);

      return DateFormat;
    }(_angular_material_core__WEBPACK_IMPORTED_MODULE_0__["NativeDateAdapter"]);
    /***/

  },

  /***/
  "./src/app/common/state/service/state.service.ts":
  /*!*******************************************************!*\
    !*** ./src/app/common/state/service/state.service.ts ***!
    \*******************************************************/

  /*! exports provided: StateService */

  /***/
  function srcAppCommonStateServiceStateServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "StateService", function () {
      return StateService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/http */
    "./node_modules/@angular/http/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var rxjs_add_observable_of__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! rxjs/add/observable/of */
    "./node_modules/rxjs-compat/_esm2015/add/observable/of.js");

    var StateService = /*#__PURE__*/function () {
      function StateService(_http) {
        _classCallCheck(this, StateService);

        this._http = _http;
        this._url = 'mst/statemaster/';
        this.filterurl = 'mst/statemaster/index';
      }

      _createClass(StateService, [{
        key: "createState",
        value: function createState(formvalues, moduleID, accessType) {
          var body = JSON.stringify({
            'statemaster': formvalues
          });
          return this._http.post(this._url + 'newstate' + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "updateState",
        value: function updateState(id, formvalues, moduleID, accessType) {
          var body = JSON.stringify({
            'statemaster': formvalues
          });
          return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getState",
        value: function getState(offset, pageindex) {
          this._url = 'http://' + window.location.hostname + '/bgiv3/server/api/web/v1/statemsttbls?offset=' + offset + '&pageindex=' + pageindex;
          return this._http.get(this._url).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getstatebyid",
        value: function getstatebyid(id, moduleID, accessType) {
          return this._http.get(this._url + 'statelistbycountry?countryid=' + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "editState",
        value: function editState(id, moduleID, accessType) {
          return this._http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "updatestatus",
        value: function updatestatus(id, moduleID, accessType) {
          var body = JSON.stringify({
            'updatestatus': id
          });
          return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body);
        }
      }, {
        key: "deletestate",
        value: function deletestate(id, moduleID, accessType) {
          return this._http["delete"](this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType);
        }
      }, {
        key: "statetablefilter",
        value: function statetablefilter(filterpagestring, countryname, statename, status) {
          var options = new _angular_http__WEBPACK_IMPORTED_MODULE_2__["RequestOptions"]({
            headers: new _angular_http__WEBPACK_IMPORTED_MODULE_2__["Headers"]({})
          });
          var urlparams = "".concat(this.filterurl, "?").concat(filterpagestring, "&CyM_CountryName_en=").concat(countryname, "&SM_StateName_en=").concat(statename, "&SM_Status=").concat(status, "&type=", 'filter');
          return this._http.get(urlparams, options).map(function (res) {
            return res.json();
          });
        }
      }]);

      return StateService;
    }();

    StateService.ctorParameters = function () {
      return [{
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }];
    };

    StateService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]])], StateService);
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.scss":
  /*!***************************************************************************************************!*\
    !*** ./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.scss ***!
    \***************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesProfilemanagementContactinformationAddcontactAddcontactComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".selectproductheaderwithclose {\n  height: auto !important;\n}\n\n.selectproductheaderwithclose .titletext {\n  display: block !important;\n}\n\n.selectproductheaderwithclose .closeandadd {\n  margin-bottom: 10px;\n}\n\n.widthfax {\n  width: 80%;\n}\n\n.widthflagview {\n  width: 20%;\n}\n\nimg[src=null] {\n  display: none;\n}\n\nimg[src=\"[object Storage]\"] {\n  display: none;\n}\n\n.flagicon {\n  position: relative;\n  top: 3px;\n}\n\n.flexsame {\n  display: flex;\n}\n\n.information {\n  padding: 0px !important;\n  display: block;\n  margin: 0;\n}\n\n.information .info {\n  padding: 15px !important;\n  display: flex;\n}\n\n.information .info a {\n  text-decoration: underline;\n}\n\n.mat-button-toggle-checked {\n  background: #2dbe55;\n  color: #fff;\n}\n\n.documentsrow {\n  align-items: center !important;\n}\n\nmat-option[aria-label] {\n  position: relative;\n  font-size: 0.875rem;\n  color: #333 !important;\n  height: 50px;\n  padding-top: 0px;\n  padding-bottom: 15px;\n}\n\nmat-option[aria-label]::after {\n  content: attr(aria-label);\n  position: absolute;\n  bottom: -5px;\n  font-size: 0.75rem;\n  color: #666666;\n}\n\n.mat-tab-body-content::-webkit-scrollbar {\n  width: 0.5em;\n  position: absolute;\n  right: 0;\n}\n\n.mat-tab-body-content::-webkit-scrollbar-thumb {\n  background-color: #b8c3cb;\n}\n\n.organisationinfo {\n  background: #fff;\n}\n\n#mastercompanydetail .borderclass {\n  border: 5px solid #006cb7;\n}\n\n.topheadermain {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  color: #fff !important;\n}\n\n.topheadermain .imagewithtext {\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.cancelandpublish .cancel {\n  height: 45px;\n  color: #777;\n  border: 1px solid #cbcbcb;\n  border-radius: 2px !important;\n}\n\n.cancelandpublish .publish {\n  height: 45px;\n  border-radius: 2px !important;\n}\n\n.mat-form-field {\n  font-size: 0.9375rem;\n}\n\n::ng-deep.mat-form-field-infix {\n  border-top: 0.54375em solid transparent;\n}\n\n::slotted .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: rgba(0, 0, 0, 0.22);\n}\n\n.profilecompleteness p {\n  color: #fff;\n  font-size: 0.75rem;\n}\n\n.profilecompleteness .mat-progress-bar {\n  width: 190px;\n  margin-bottom: 15px;\n}\n\n::ng-deep.mat-progress-bar-fill::after {\n  background-color: #71c015 !important;\n}\n\n.progressandhistory {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  margin-bottom: 10px;\n}\n\n.pagenumberinprofile {\n  border: 1px solid #fff;\n  height: 20px;\n  min-width: 20px;\n  color: #fff;\n  border-radius: 10px/11px;\n  background: #2b7db5;\n  font-size: 0.75rem;\n  width: auto;\n  padding: 0 6px;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n  margin-right: 10px;\n}\n\n.completed {\n  background: #71c114;\n}\n\n.mat-select-panel {\n  border-radius: 0;\n}\n\n.mat-option[aria-disabled=true] {\n  background: #006cb7;\n  color: #fff;\n  height: 35px;\n}\n\n.accrodianheader .header {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.uploadandcompnayinfo {\n  display: flex;\n}\n\n.dropfilesheretoadd {\n  padding: 5px;\n  border: 1px dashed #999;\n  border-radius: 2px;\n}\n\n.dropfilesheretoadd div {\n  background: #f3f4f6;\n  height: 45px;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.dropfilesheretoadd div p {\n  color: #333;\n  font-size: 0.875rem;\n  margin: 0;\n  font-family: \"cairosemibold\";\n}\n\n.dropfilesheretoadd div p span {\n  color: #006cb7;\n}\n\n.saveandnext, .previous {\n  background: #ececec;\n  border-radius: 2px;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n  font-size: 0.9375rem;\n}\n\n.previous {\n  background: transparent;\n  font-size: 15px !important;\n  margin-right: 15px;\n  width: auto;\n}\n\n.viewingcontrols .mat-form-field {\n  width: 90px;\n}\n\n::ng-deep.mat-paginator-container {\n  padding: 0 !important;\n  font-size: 0.875rem;\n  justify-content: flex-start !important;\n}\n\n.showfilterandadditem button {\n  font-size: 14px !important;\n}\n\n.selectproductheaderwithclose {\n  height: 56px;\n}\n\n.selectproductheaderwithclose .closeandadd {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.selectproductheaderwithclose .titletext {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  padding: 10px;\n}\n\n.selectproductheaderwithclose .clearandaddbutton {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.selectproductheaderwithclose .clearandaddbutton .clearbutton {\n  background: #006cb7;\n}\n\n.selectproductheaderwithclose .clearandaddbutton .addbutton {\n  background: #28b8e7;\n}\n\n::ng-deep.mat-drawer-backdrop {\n  position: fixed;\n}\n\n.companyinfomcp {\n  display: flex;\n  align-items: flex-start !important;\n}\n\n.companyinfomcp img {\n  width: 44px;\n  height: 44px;\n}\n\n.companyinfomcp .lypisid {\n  color: #666666;\n  font-size: 0.75rem;\n}\n\n.companyinfomcp p {\n  margin: 0;\n  line-height: 1;\n  color: #000;\n}\n\n.borderbottom {\n  border-bottom: 1px solid #ddd;\n  padding-bottom: 5px;\n}\n\n::ng-deep.mat-select-panel {\n  max-height: 400px;\n}\n\n::ng-deep.mat-option:hover:not(.mat-option-disabled),\n::ng-deep .mat-option:focus:not(.mat-option-disabled),\n::ng-deep.mat-option.mat-selected:not(.mat-option-disabled) {\n  background: #cbdcf9 !important;\n}\n\n::ng-deep.mat-option.mat-active {\n  background: transparent;\n}\n\n.editanddelete {\n  display: inline-flex;\n  margin-bottom: 10px;\n}\n\n.editanddelete .edit {\n  color: #999;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.editanddelete i {\n  font-size: 1rem;\n}\n\n.editanddelete span {\n  opacity: 0;\n  width: 35px;\n  height: 35px;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n  cursor: pointer;\n}\n\n::ng-deep.numberandcode .mat-form-field-infix {\n  display: flex !important;\n}\n\n.addedcertificate {\n  padding: 20px;\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n\n.addedcertificate:hover {\n  background: #e1efff;\n}\n\n.addedcertificate:hover .certificateimage {\n  background: #006cb7;\n}\n\n.addedcertificate:hover .certificateimage i {\n  color: #fff;\n}\n\n.addedcertificate:hover .editanddelete span {\n  opacity: 1;\n  background: #cbdcf9;\n  color: #006cb7;\n  border-radius: 50%;\n}\n\n.addedcertificate:hover .companyandofficeinfo .name {\n  color: #006cb7;\n}\n\n.addedcertificate:hover .companyandofficeinfo .eachitem .lablename {\n  color: #006cb7;\n}\n\n.certificates {\n  display: flex;\n}\n\n:host ::ng-deep.mastercompnaycontent .commonexpandandcollapse .mat-expansion-panel-body {\n  padding: 10px !important;\n}\n\n.certiticatecounts {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n\n.certiticatecounts p {\n  color: #006cb7;\n  font-size: 0.875rem;\n}\n\n.certiticatecounts .addbutton {\n  background: #006cb7;\n  font-size: 14px !important;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.certificateinfo {\n  padding-left: 20px;\n}\n\n.certificateinfo p {\n  font-size: 0.875rem;\n  margin: 0;\n  color: #000;\n  padding-bottom: 10px;\n}\n\n.certificateinfo .cerlabel {\n  color: #999;\n}\n\n.certificateinfo .header {\n  color: #333;\n  font-size: 1.125rem;\n  font-weight: bold;\n  padding-bottom: 15px;\n}\n\n.primaryofficeinfo {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n\n.primaryofficeinfo .officebuilding {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding: 20px;\n  align-items: flex-start !important;\n  width: 100%;\n}\n\n.primaryofficeinfo .addresslabel {\n  color: #999;\n  font-size: 11px !important;\n}\n\n.primaryofficeinfo .companyandofficeinfo {\n  width: calc(100% - 65px);\n}\n\n.primaryofficeinfo .companyandofficeinfo .name {\n  color: #006cb7;\n}\n\n.companyandofficeinfo {\n  padding-left: 20px;\n}\n\n.companyandofficeinfo p {\n  margin: 0;\n}\n\n.companyandofficeinfo .crandbranchids {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding-top: 10px;\n  padding-bottom: 10px;\n}\n\n.companyandofficeinfo .crandbranchids .count {\n  font-family: \"cairosemibold\";\n}\n\n.companyandofficeinfo .title {\n  color: #999;\n  font-size: 0.75rem;\n  margin: 0;\n  line-height: 0.9;\n  padding-bottom: 6px;\n}\n\n.companyandofficeinfo .lablename {\n  color: #999;\n  font-size: 0.9375rem;\n}\n\n.companyandofficeinfo .name {\n  color: #333;\n  font-size: 1rem;\n  margin: 0;\n  line-height: 1.5;\n}\n\n.officeaddressdetail {\n  padding-top: 20px;\n}\n\n.officeaddressdetail .addressinfo {\n  font-size: 0.9375rem;\n}\n\n.contactandwebsite {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  align-items: flex-start !important;\n  padding-top: 20px;\n}\n\n.contactandwebsite p {\n  font-size: 0.9375rem;\n  padding-bottom: 5px;\n}\n\n.contactandwebsite .contact {\n  padding-right: 20px;\n}\n\n.contactandwebsite .webiste {\n  padding-left: 20px;\n}\n\n.contactdetails {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding-top: 15px;\n}\n\n.contactdetails div {\n  padding-right: 30px;\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.contactdetails div i {\n  color: #9a9a9a;\n  padding-right: 10px;\n}\n\n.contactdetails div span {\n  color: #333;\n  font-size: 0.875rem;\n}\n\n.companydetailwithflag {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n\n.certificateimage {\n  position: relative;\n  width: 65px;\n  height: 65px;\n  background: #e5eefe;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.certificateimage i {\n  color: #006cb7;\n  font-size: 1.5625rem;\n}\n\n.countryandcrinfo {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding-top: 10px;\n}\n\n.countryandcrinfo .eachitem {\n  padding-right: 60px;\n}\n\n.countryandcrinfo .eachitem .lablename {\n  font-size: 12px !important;\n}\n\n.countryandcrinfo .eachitem img {\n  width: 22px;\n}\n\n.countryandcrinfo .eachitem:last-child {\n  padding-right: 0;\n}\n\n.searchitembelow {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  border: 1px solid #ddd;\n  height: 50px;\n}\n\n.searchitembelow input {\n  height: 100%;\n  width: 100%;\n  border: none;\n}\n\n.Paymentcontacthead p {\n  color: red;\n  margin: 0px;\n}\n\n.setcountryflag {\n  align-items: center;\n}\n\n.setcountryflag .code {\n  width: 60px;\n}\n\n.setcountryflag .number {\n  width: calc(100% - 120px);\n}\n\n.setcountryflag .ext {\n  width: 60px;\n}\n\n.setcountryflag .faxnumber {\n  width: calc(100% - 60px);\n}\n\n.flagimage img {\n  max-width: 24px;\n  margin-top: -5px;\n}\n\n::ng-deep.countrynameselect {\n  height: 40px !important;\n  line-height: 40px !important;\n}\n\n::ng-deep.countrynameselect .mat-option-text {\n  display: flex;\n  align-items: center;\n}\n\n::ng-deep.countrynameselect .mat-option-text img {\n  padding-right: 10px;\n  max-width: 34px;\n  height: auto;\n}\n\n.mapwidth img {\n  width: 100%;\n}\n\n.profilelinkboxshadow {\n  box-shadow: 0 0 5px #ddd;\n  width: 100%;\n  padding-left: 7px;\n  padding-right: 7px;\n}\n\n.borderflex {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  min-height: 45px;\n  padding-top: 5px;\n}\n\n.pdfview {\n  display: flex;\n}\n\n.Search p {\n  color: #a9a9a9;\n}\n\n.Searchcolor {\n  color: #a9a9a9;\n}\n\n.certificateborder {\n  border: 1px dashed #b3b3b3 !important;\n  width: 100%;\n  height: 60px;\n  border-radius: 2px;\n  background: #f3f4f6;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n\n.certificateborder .fileherecolor {\n  color: #333333;\n}\n\n.certificateborder .addfilecolor {\n  color: #006cb7;\n}\n\n.certificateborder .uploadpdf {\n  color: #989898;\n}\n\n.certificateborder .uploadpdf p {\n  color: #989898;\n}\n\n.pdfbackground {\n  background-color: #edf3ff;\n}\n\n.uploadphoto {\n  padding: 5px;\n  border: 1px dashed #999;\n  border-radius: 2px;\n  height: 150px;\n  width: 150px;\n}\n\n.uploadphoto .outerlayer {\n  background: #e8ebf0;\n  height: 100%;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.uploadphoto .outerlayer p {\n  margin: 0;\n  color: #333;\n  font-size: 0.875rem;\n  padding-top: 10px;\n}\n\n.marketingheight {\n  display: flex;\n  align-items: center;\n  height: 195px;\n}\n\n.marketingheight p {\n  margin: 0px;\n  margin-top: 38px;\n}\n\n.textcolor {\n  color: #006cb7 !important;\n}\n\n.deleteflexend {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n\n.border {\n  border: none !important;\n  width: 96% !important;\n}\n\n.flexoman {\n  display: flex;\n  align-items: center;\n}\n\n.flexserach {\n  display: flex;\n  align-items: center;\n}\n\n.iconstyle {\n  font-size: 1.125rem;\n  color: #006cb7;\n}\n\n.searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 15px 15px;\n  background: #e9edf0;\n}\n\n.searchselect {\n  width: calc(100% - 25px) !important;\n  padding-left: 10px;\n}\n\n@media (max-width: 767px) {\n  .selectproductheaderwithclose {\n    height: auto !important;\n  }\n\n  .selectproductheaderwithclose .titletext {\n    display: block !important;\n  }\n\n  .selectproductheaderwithclose .closeandadd {\n    margin-bottom: 10px;\n  }\n\n  .innnerpartofdrwer {\n    padding-left: 20px !important;\n    padding-right: 20px !important;\n  }\n\n  html body .p-r-20 {\n    padding-right: 0px !important;\n  }\n}\n\n::ng-deep.sidenavmainrow .innnerpartofdrwer {\n  padding-top: 25px;\n  padding-left: 75px;\n  padding-right: 75px;\n  padding-bottom: 70px !important;\n  max-height: calc(100vh - 140px) !important;\n  overflow-x: hidden;\n  overflow-y: auto;\n  height: 100%;\n}\n\n.descriptioncontentmarketpresence.show {\n  display: flex;\n}\n\n.descriptioncontentmarketpresence.hide {\n  display: none !important;\n}\n\nsup {\n  color: red;\n}\n\n.preFlag {\n  width: calc(100% - 60px) !important;\n}\n\n.borderbottom {\n  display: none !important;\n}\n\n.searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 6px 10px;\n  background: #e9edf0;\n}\n\n.searchinmultiselect input::-webkit-input-placeholder {\n  color: #7f8fa3 !important;\n}\n\n.searchinmultiselect i {\n  color: #7f8fa3 !important;\n  padding-right: 6px;\n}\n\n.searchinmultiselect .searchselect {\n  width: calc(100% - 25px) !important;\n}\n\n.searchinmultiselect .reseticon {\n  cursor: pointer;\n}\n\n.option-listing {\n  overflow-x: auto;\n  overflow-y: auto;\n  max-height: 290px;\n}\n\n.countrynameselect {\n  line-height: 40px !important;\n  height: 40px !important;\n}\n\n.countrynameselect img {\n  width: 24px;\n  height: auto;\n  margin-right: 5px;\n}\n\n::ng-deep.select_with_search {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 40px !important;\n  margin-bottom: 15px !important;\n}\n\n:host::ng-deep.mat-tooltip {\n  font-size: 0.875rem;\n}\n\n:host::ng-deep.sameasaddress .mat-checkbox-label {\n  color: #f47f1f;\n  font-size: 0.9375rem;\n}\n\n::ng-deep#data_design .sidenavmainrow .innnerpartofdrwer {\n  padding: 0 !important;\n  overflow: initial;\n  max-height: 100% !important;\n}\n\n::ng-deep#data_design .sidenavmainrow .innnerpartofdrwer .organisationinfo {\n  padding-top: 0 !important;\n}\n\n::ng-deep#data_design .sidenavmainrow .innnerpartofdrwer .organisationinfo .data_width {\n  max-width: 100% !important;\n}\n\n.mat-card.selectedbsfull {\n  background-color: #fff !important;\n  border: solid 1px #fff;\n  margin: 0 !important;\n  border-radius: 2px;\n  box-shadow: none !important;\n  border-bottom: 1px solid #ddd !important;\n}\n\n.mat-card.selectedbsfull .mat-card-header {\n  display: flex;\n  padding: 15px !important;\n  width: 100%;\n  justify-content: flex-start;\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsimg {\n  width: 7%;\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsimg .imgbg {\n  width: 48px;\n  height: 64px;\n  background: #006cb7;\n  color: #fff;\n  font-size: 28px;\n  text-align: center;\n  line-height: 64px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails {\n  width: 90%;\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails .selecttitle {\n  font-family: \"cairobold\";\n  color: #333;\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle {\n  display: flex;\n  width: 100%;\n  flex-direction: row;\n  justify-content: flex-start;\n  line-height: 17px;\n  flex-wrap: wrap;\n}\n\n@media (max-width: 768px) {\n  .mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle {\n    flex-direction: column;\n  }\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle p {\n  display: flex;\n  width: 100%;\n  flex-direction: column;\n  color: #222;\n  font-size: 14px;\n  margin: 0;\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle p.country {\n  width: 33.33%;\n}\n\n@media (max-width: 768px) {\n  .mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle p.country {\n    width: 100%;\n  }\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle p.country img {\n  width: 22px;\n  margin: 0;\n  height: auto;\n  position: relative;\n  top: 2px;\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle p.address {\n  width: 100%;\n  display: flex;\n  margin: 10px 0 0 0;\n}\n\n@media (max-width: 768px) {\n  .mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle p.address {\n    width: 100%;\n  }\n}\n\n.mat-card.selectedbsfull .mat-card-header .sbsdetails .selectsubtitle p span.cbox-label {\n  font-size: 12px;\n  color: #999;\n}\n\n.mat-card.selectedbsfull .mat-card-header .deletediv {\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n\n.mat-card.selectedbsfull .mat-card-header .deletediv .bgi {\n  color: #fff;\n  cursor: pointer;\n  width: 31px;\n  height: 31px;\n  line-height: 31px;\n  border-radius: 31px;\n  text-align: center;\n  font-size: 0.75rem;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n\n.mat-card.selectedbsfull:hover {\n  background-color: #f3f5f9 !important;\n  border: solid 1px #f3f5f9 !important;\n}\n\n.mat-card.selectedbsfull:hover .mat-card-header .sbsdetails .selecttitle {\n  color: #1877bb;\n}\n\n.mat-card.selectedbsfull:hover .mat-card-header .sbsdetails .selectsubtitle p span.cbox-label {\n  color: #1877bb;\n}\n\n.mat-card.selectedbsfull:hover .deletediv .bgi {\n  color: #1877bb;\n  cursor: pointer;\n  border: 1px solid #c5dbfd;\n}\n\n.mat-card.selectedbsfull:hover .deletediv .bgi:hover {\n  background-color: #c5dbfd;\n}\n\n.profilelinkboxshadow {\n  box-shadow: none;\n  width: 100%;\n  padding-left: 7px;\n  padding-right: 7px;\n  margin-bottom: 10px;\n  border: 1px solid #ddd;\n}\n\n.profilelinkboxshadow .borderflex {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  min-height: 45px;\n  padding-top: 5px;\n}\n\n.profilelinkboxshadow .border {\n  border: none !important;\n  width: 96% !important;\n}\n\n.tabsection.mptab .mat-tab-group.hidetabstyle {\n  width: 100%;\n}\n\n.tabsection.mptab .mat-tab-group.hidetabstyle .mat-tab-header {\n  display: none;\n}\n\n.tabsection .mat-tab-label.mat-tab-label-active {\n  background: #1877bb;\n  color: #fff;\n}\n\n.tabsection .mat-tab-label.mat-tab-label-active .tabselectheadercontent p, .tabsection .mat-tab-label.mat-tab-label-active .tabselectheadercontent h4 {\n  color: #fff;\n}\n\n.innnerpartofdrwer.noscroll {\n  /*max-height:unset !important;*/\n  min-height: unset !important;\n  height: auto !important;\n}\n\n.innnerpartofdrwer.noscroll .mat-tab-body {\n  overflow: unset;\n}\n\n.innnerpartofdrwer.noscroll .mat-tab-body.mat-tab-body-active {\n  overflow: unset;\n}\n\n.innnerpartofdrwer.noscroll .mat-tab-body .mat-tab-body-content {\n  overflow: unset;\n  height: auto !important;\n  padding-top: 10px;\n}\n\n.innnerpartofdrwer {\n  min-height: unset !important;\n  height: auto !important;\n}\n\n.innnerpartofdrwer .mat-tab-body {\n  overflow: unset;\n}\n\n.innnerpartofdrwer .mat-tab-body.mat-tab-body-active {\n  overflow: unset;\n}\n\n.innnerpartofdrwer .mat-tab-body .mat-tab-body-content {\n  overflow: unset;\n  height: auto !important;\n  padding-top: 10px;\n}\n\n.busisearchdiv {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n\n@media (max-width: 660px) {\n  .busisearchdiv {\n    flex-direction: column;\n  }\n}\n\n.busisearchdiv .searchfielddiv {\n  width: calc(100% - 80px);\n  max-width: 100%;\n}\n\n.busisearchdiv .searchfielddiv.show {\n  visibility: visible;\n}\n\n.busisearchdiv .searchfielddiv.hide {\n  visibility: hidden !important;\n}\n\n.busisearchdiv .searchfielddiv .mat-input-element {\n  height: 28px !important;\n}\n\n.busisearchdiv .searchfielddiv .mat-form-field-infix {\n  padding: 0 !important;\n  height: 32px !important;\n  border-top-width: 5px;\n}\n\n.busisearchdiv .searchfielddiv button {\n  height: 30px !important;\n}\n\n.busisearchdiv button {\n  height: 38px;\n}\n\n.busisearchdiv button .bgi-add {\n  font-size: 10px;\n  margin-right: 5px;\n  position: relative;\n  top: -3px;\n}\n\n.busisearchdiv button.searchbtn {\n  background: transparent;\n  color: #333 !important;\n  font-size: 1.1875rem;\n  line-height: 12px;\n  width: 42px !important;\n  min-width: 42px !important;\n  max-width: 42px !important;\n  padding: 0 !important;\n}\n\n.busisearchdiv .bssearchbox {\n  width: 100%;\n  margin-right: 0px;\n  border: 1px solid #ddd;\n  display: flex;\n}\n\n@media (max-width: 660px) {\n  .busisearchdiv .bssearchbox {\n    width: 100%;\n    margin-right: 0px;\n    margin-bottom: 5px;\n  }\n}\n\n.busisearchdiv .bssearchbox .mat-form-field-underline {\n  display: none;\n}\n\n.busisearchdiv .bssearchbox .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n\n.busisearchdiv .mat-focused .mat-form-field-label, .busisearchdiv .mat-form-field-should-float .mat-form-field-label {\n  display: none;\n}\n\n.busisearchdiv .mat-form-field-label-wrapper {\n  line-height: 14px;\n}\n\n.tabforclientelenew .tabselectheadercontent .selectiontext {\n  min-height: 50px;\n  height: auto;\n  align-content: flex-start;\n  display: flex;\n  flex-direction: column;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9wcm9maWxlbWFuYWdlbWVudC9jb250YWN0aW5mb3JtYXRpb24vYWRkY29udGFjdC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxwcm9maWxlbWFuYWdlbWVudFxcY29udGFjdGluZm9ybWF0aW9uXFxhZGRjb250YWN0XFxhZGRjb250YWN0LmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3Byb2ZpbGVtYW5hZ2VtZW50L2NvbnRhY3RpbmZvcm1hdGlvbi9hZGRjb250YWN0L2FkZGNvbnRhY3QuY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBeUJFO0VBQ0UsdUJBQUE7QUN4Qko7O0FEMEJFO0VBQ0UseUJBQUE7QUN2Qko7O0FEeUJFO0VBQ0UsbUJBQUE7QUN0Qko7O0FEd0JFO0VBQ0csVUFBQTtBQ3JCTDs7QUR1QkU7RUFDRyxVQUFBO0FDcEJMOztBRHNCRTtFQUNFLGFBQUE7QUNuQko7O0FEcUJFO0VBQ0UsYUFBQTtBQ2xCSjs7QURvQkU7RUFDRSxrQkFBQTtFQUNBLFFBQUE7QUNqQko7O0FEbUJFO0VBQ0UsYUFBQTtBQ2hCSjs7QURrQkU7RUFDRSx1QkFBQTtFQUNBLGNBQUE7RUFDQSxTQUFBO0FDZko7O0FEZ0JJO0VBQ0Usd0JBQUE7RUFDQSxhQUFBO0FDZE47O0FEZU07RUFDRSwwQkFBQTtBQ2JSOztBRGtCRTtFQUNFLG1CQUFBO0VBQ0EsV0FBQTtBQ2ZKOztBRGtCRTtFQUNFLDhCQUFBO0FDZko7O0FEa0JFO0VBQ0Usa0JBQUE7RUFDQSxtQkFBQTtFQUNBLHNCQUFBO0VBQ0EsWUFBQTtFQUNBLGdCQUFBO0VBQ0Esb0JBQUE7QUNmSjs7QURnQkk7RUFDRSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0EsY0FBQTtBQ2ROOztBRGtCRTtFQUNFLFlBQUE7RUFDQSxrQkFBQTtFQUNBLFFBQUE7QUNmSjs7QURrQkU7RUFDRSx5QkFBQTtBQ2ZKOztBRGtCRTtFQUNFLGdCQUFBO0FDZko7O0FEbUJJO0VBQ0UseUJBQUE7QUNoQk47O0FEbUJFO0VBOUZFLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtFQThGQSxzQkFBQTtBQ2RKOztBRGVJO0VBaEhBLHdCQUFBO0VBQ0Esa0NBQUE7RUFDQSw4QkFBQTtBQ29HSjs7QURnQkk7RUFDRSxZQUFBO0VBQ0EsV0FBQTtFQUNBLHlCQUFBO0VBQ0EsNkJBQUE7QUNiTjs7QURlSTtFQUNFLFlBQUE7RUFDQSw2QkFBQTtBQ2JOOztBRGlCRTtFQUNFLG9CQUFBO0FDZEo7O0FEaUJFO0VBQ0UsdUNBQUE7QUNkSjs7QURpQkU7RUFDRSxxQ0FBQTtBQ2RKOztBRGlCSTtFQUNFLFdBQUE7RUFDQSxrQkFBQTtBQ2ROOztBRGdCSTtFQUNFLFlBQUE7RUFDQSxtQkFBQTtBQ2ROOztBRGlCRTtFQUNFLG9DQUFBO0FDZEo7O0FEaUJFO0VBNUlFLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtFQTRJQSxtQkFBQTtBQ1pKOztBRGNFO0VBQ0Usc0JBQUE7RUFDQSxZQUFBO0VBQ0EsZUFBQTtFQUNBLFdBQUE7RUFDQSx3QkFBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxXQUFBO0VBQ0EsY0FBQTtFQXhLQSx3QkFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7RUF3S0Esa0JBQUE7QUNUSjs7QURXRTtFQUNFLG1CQUFBO0FDUko7O0FEV0U7RUFDRSxnQkFBQTtBQ1JKOztBRFdFO0VBQ0UsbUJBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtBQ1JKOztBRFlJO0VBdExBLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtBQzhLSjs7QURVRTtFQUNFLGFBQUE7QUNQSjs7QURVRTtFQUNFLFlBQUE7RUFDQSx1QkFBQTtFQUNBLGtCQUFBO0FDUEo7O0FEUUk7RUFDRSxtQkFBQTtFQUNBLFlBQUE7RUF6TUYsd0JBQUE7RUFDQSxrQ0FBQTtFQUNBLDhCQUFBO0FDb01KOztBREtNO0VBdkxGLFdBQUE7RUFDQSxtQkFBQTtFQUNBLFNBQUE7RUF1TEksNEJBQUE7QUNEUjs7QURFUTtFQUNFLGNBQUE7QUNBVjs7QURLRTtFQUNFLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxvQ0FBQTtFQUNBLHNCQUFBO0VBQ0Esb0JBQUE7QUNGSjs7QURJRTtFQUVFLHVCQUFBO0VBQ0EsMEJBQUE7RUFDQSxrQkFBQTtFQUNBLFdBQUE7QUNGSjs7QURLSTtFQUNFLFdBQUE7QUNGTjs7QURNRTtFQUNFLHFCQUFBO0VBQ0EsbUJBQUE7RUFDQSxzQ0FBQTtBQ0hKOztBREtFO0VBQ0UsMEJBQUE7QUNGSjs7QURJRTtFQUlFLFlBQUE7QUNKSjs7QURDSTtFQTVPQSx3QkFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7QUM4T0o7O0FEQUk7RUF0T0Esd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0VBc09FLGFBQUE7QUNJTjs7QURGSTtFQXBQQSx3QkFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7QUN5UEo7O0FETE07RUFDRSxtQkFBQTtBQ09SOztBRExNO0VBQ0UsbUJBQUE7QUNPUjs7QURIRTtFQUNFLGVBQUE7QUNNSjs7QURKRTtFQUNFLGFBQUE7RUFDQSxrQ0FBQTtBQ09KOztBRExJO0VBQ0UsV0FBQTtFQUNBLFlBQUE7QUNPTjs7QURMSTtFQUNFLGNBQUE7RUFDQSxrQkFBQTtBQ09OOztBRExJO0VBQ0UsU0FBQTtFQUNBLGNBQUE7RUFDQSxXQUFBO0FDT047O0FESEU7RUFDRSw2QkFBQTtFQUNBLG1CQUFBO0FDTUo7O0FESEU7RUFDRSxpQkFBQTtBQ01KOztBREpFOzs7RUFHRSw4QkFBQTtBQ09KOztBRExFO0VBQ0UsdUJBQUE7QUNRSjs7QURORTtFQUNFLG9CQUFBO0VBQ0EsbUJBQUE7QUNTSjs7QURQSTtFQUNFLFdBQUE7RUE5U0Ysd0JBQUE7RUFDQSxrQ0FBQTtFQUNBLDhCQUFBO0FDd1RKOztBRFRJO0VBQ0UsZUFBQTtBQ1dOOztBRFRJO0VBQ0UsVUFBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBdlRGLHdCQUFBO0VBQ0Esa0NBQUE7RUFDQSw4QkFBQTtFQXVURSxlQUFBO0FDYU47O0FEUkk7RUFDRSx3QkFBQTtBQ1dOOztBRFBFO0VBQ0UsYUFBQTtFQXJUQSx3QkFBQTtFQUNBLHlDQUFBO0VBQ0EsOEJBQUE7QUNnVUo7O0FEWEk7RUFDRSxtQkFBQTtBQ2FOOztBRFpNO0VBQ0UsbUJBQUE7QUNjUjs7QURiUTtFQUNFLFdBQUE7QUNlVjs7QURaTTtFQUNFLFVBQUE7RUFDQSxtQkFBQTtFQUNBLGNBQUE7RUFDQSxrQkFBQTtBQ2NSOztBRFhRO0VBQ0UsY0FBQTtBQ2FWOztBRFhRO0VBQ0UsY0FBQTtBQ2FWOztBRFJFO0VBQ0UsYUFBQTtBQ1dKOztBRFRFO0VBQ0Usd0JBQUE7QUNZSjs7QURWRTtFQXJWRSx3QkFBQTtFQUNBLHlDQUFBO0VBQ0EsOEJBQUE7QUNtV0o7O0FEZEk7RUFDRSxjQUFBO0VBQ0EsbUJBQUE7QUNnQk47O0FEYkk7RUFDRSxtQkFBQTtFQUNBLDBCQUFBO0VBN1dGLHdCQUFBO0VBQ0Esa0NBQUE7RUFDQSw4QkFBQTtBQzZYSjs7QURiRTtFQUNFLGtCQUFBO0FDZ0JKOztBRGZJO0VBQ0UsbUJBQUE7RUFDQSxTQUFBO0VBQ0EsV0FBQTtFQUNBLG9CQUFBO0FDaUJOOztBRGZJO0VBQ0UsV0FBQTtBQ2lCTjs7QURmSTtFQUNFLFdBQUE7RUFDQSxtQkFBQTtFQUNBLGlCQUFBO0VBQ0Esb0JBQUE7QUNpQk47O0FEYkU7RUF0WEUsd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0FDdVlKOztBRGpCSTtFQWxZQSx3QkFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7RUFrWUUsYUFBQTtFQUNBLGtDQUFBO0VBQ0EsV0FBQTtBQ3FCTjs7QURuQkk7RUFDRSxXQUFBO0VBQ0EsMEJBQUE7QUNxQk47O0FEbkJJO0VBQ0Usd0JBQUE7QUNxQk47O0FEcEJNO0VBQ0UsY0FBQTtBQ3NCUjs7QURsQkU7RUFZRSxrQkFBQTtBQ1VKOztBRHJCSTtFQUNFLFNBQUE7QUN1Qk47O0FEckJJO0VBdlpBLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtFQXVaRSxpQkFBQTtFQUNBLG9CQUFBO0FDeUJOOztBRHhCTTtFQUNFLDRCQUFBO0FDMEJSOztBRHRCSTtFQUNFLFdBQUE7RUFDQSxrQkFBQTtFQUNBLFNBQUE7RUFDQSxnQkFBQTtFQUNBLG1CQUFBO0FDd0JOOztBRHRCSTtFQUNFLFdBQUE7RUFDQSxvQkFBQTtBQ3dCTjs7QUR0Qkk7RUFDRSxXQUFBO0VBQ0EsZUFBQTtFQUNBLFNBQUE7RUFDQSxnQkFBQTtBQ3dCTjs7QURyQkU7RUFDRSxpQkFBQTtBQ3dCSjs7QUR0Qkk7RUFDRSxvQkFBQTtBQ3dCTjs7QURyQkU7RUF6YkUsd0JBQUE7RUFDQSxzQ0FBQTtFQUNBLDhCQUFBO0VBeWJBLGtDQUFBO0VBQ0EsaUJBQUE7QUMwQko7O0FEekJJO0VBQ0Usb0JBQUE7RUFDQSxtQkFBQTtBQzJCTjs7QUR6Qkk7RUFDRSxtQkFBQTtBQzJCTjs7QUR6Qkk7RUFDRSxrQkFBQTtBQzJCTjs7QUR4QkU7RUF4Y0Usd0JBQUE7RUFDQSxzQ0FBQTtFQUNBLDhCQUFBO0VBd2NBLGlCQUFBO0FDNkJKOztBRDVCSTtFQUNFLG1CQUFBO0VBNWNGLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtBQzJlSjs7QUQvQk07RUFDRSxjQUFBO0VBQ0EsbUJBQUE7QUNpQ1I7O0FEL0JNO0VBQ0UsV0FBQTtFQUNBLG1CQUFBO0FDaUNSOztBRDVCRTtFQS9jRSx3QkFBQTtFQUNBLHlDQUFBO0VBQ0EsOEJBQUE7QUMrZUo7O0FEL0JFO0VBQ0Usa0JBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLG1CQUFBO0VBcmVBLHdCQUFBO0VBQ0Esa0NBQUE7RUFDQSw4QkFBQTtBQ3dnQko7O0FEbkNJO0VBQ0UsY0FBQTtFQUNBLG9CQUFBO0FDcUNOOztBRGxDRTtFQXZlRSx3QkFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7RUF1ZUEsaUJBQUE7QUN1Q0o7O0FEdENJO0VBQ0UsbUJBQUE7QUN3Q047O0FEdkNNO0VBQ0UsMEJBQUE7QUN5Q1I7O0FEdkNNO0VBQ0UsV0FBQTtBQ3lDUjs7QUR2Q007RUFDRSxnQkFBQTtBQ3lDUjs7QURwQ0U7RUE5ZUUsd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0VBOGVBLHNCQUFBO0VBQ0EsWUFBQTtBQ3lDSjs7QUR4Q0k7RUFDRSxZQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7QUMwQ047O0FEdENJO0VBQ0UsVUFBQTtFQUNBLFdBQUE7QUN5Q047O0FEdENFO0VBQ0UsbUJBQUE7QUN5Q0o7O0FEeENJO0VBQ0UsV0FBQTtBQzBDTjs7QUR4Q0k7RUFDRSx5QkFBQTtBQzBDTjs7QUR4Q0k7RUFDRSxXQUFBO0FDMENOOztBRHhDSTtFQUNFLHdCQUFBO0FDMENOOztBRHZDRTtFQUNFLGVBQUE7RUFDQSxnQkFBQTtBQzBDSjs7QUR2Q0U7RUFDRSx1QkFBQTtFQUNBLDRCQUFBO0FDMENKOztBRHpDSTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtBQzJDTjs7QUQxQ007RUFDRSxtQkFBQTtFQUNBLGVBQUE7RUFDQSxZQUFBO0FDNENSOztBRHZDSTtFQUNFLFdBQUE7QUMwQ047O0FEdkNFO0VBQ0Usd0JBQUE7RUFDQSxXQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtBQzBDSjs7QUR4Q0U7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSw4QkFBQTtFQUNBLGdCQUFBO0VBQ0EsZ0JBQUE7QUMyQ0o7O0FEekNFO0VBQ0UsYUFBQTtBQzRDSjs7QUR6Q0k7RUFDRSxjQUFBO0FDNENOOztBRHpDRTtFQUNFLGNBQUE7QUM0Q0o7O0FEMUNFO0VBQ0UscUNBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSx1QkFBQTtBQzZDSjs7QUQzQ0k7RUFDRSxjQUFBO0FDNkNOOztBRDNDSTtFQUNFLGNBQUE7QUM2Q047O0FEM0NJO0VBQ0UsY0FBQTtBQzZDTjs7QUQ1Q007RUFDRSxjQUFBO0FDOENSOztBRDFDRTtFQUNFLHlCQUFBO0FDNkNKOztBRDNDRTtFQUNFLFlBQUE7RUFDQSx1QkFBQTtFQUNBLGtCQUFBO0VBQ0EsYUFBQTtFQUNBLFlBQUE7QUM4Q0o7O0FEN0NJO0VBQ0UsbUJBQUE7RUFDQSxZQUFBO0VBN21CRix3QkFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7QUM2cEJKOztBRC9DTTtFQUNFLFNBQUE7RUFDQSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSxpQkFBQTtBQ2lEUjs7QUQ3Q0U7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxhQUFBO0FDZ0RKOztBRC9DSTtFQUNFLFdBQUE7RUFDQSxnQkFBQTtBQ2lETjs7QUQ5Q0U7RUFDRSx5QkFBQTtBQ2lESjs7QUQvQ0U7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSx5QkFBQTtBQ2tESjs7QURoREU7RUFDRSx1QkFBQTtFQUNBLHFCQUFBO0FDbURKOztBRGpERTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtBQ29ESjs7QURqREU7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7QUNvREo7O0FEbERFO0VBQ0UsbUJBQUE7RUFDQSxjQUFBO0FDcURKOztBRGxERTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0EsbUJBQUE7QUNxREo7O0FEbERFO0VBQ0UsbUNBQUE7RUFDQSxrQkFBQTtBQ3FESjs7QURsREU7RUFDRTtJQUNFLHVCQUFBO0VDcURKOztFRG5ERTtJQUNFLHlCQUFBO0VDc0RKOztFRHBERTtJQUNFLG1CQUFBO0VDdURKOztFRHJERTtJQUNFLDZCQUFBO0lBQ0EsOEJBQUE7RUN3REo7O0VEdERFO0lBQ0UsNkJBQUE7RUN5REo7QUFDRjs7QUR2REU7RUFDRSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSwrQkFBQTtFQUNBLDBDQUFBO0VBQ0Esa0JBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7QUN5REo7O0FEckRJO0VBQ0UsYUFBQTtBQ3dETjs7QUR0REk7RUFDRSx3QkFBQTtBQ3dETjs7QURyREU7RUFDRSxVQUFBO0FDd0RKOztBRHRERTtFQUNFLG1DQUFBO0FDeURKOztBRHZERTtFQUNFLHdCQUFBO0FDMERKOztBRHZERTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtFQUNBLGlCQUFBO0VBQ0EsbUJBQUE7QUMwREo7O0FEeERJO0VBQ0UseUJBQUE7QUMwRE47O0FEdkRJO0VBQ0UseUJBQUE7RUFDQSxrQkFBQTtBQ3lETjs7QUR0REk7RUFDRSxtQ0FBQTtBQ3dETjs7QURyREk7RUFDRSxlQUFBO0FDdUROOztBRHBERTtFQUNFLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxpQkFBQTtBQ3VESjs7QURwREU7RUFDRSw0QkFBQTtFQUNBLHVCQUFBO0FDdURKOztBRHRESTtFQUNFLFdBQUE7RUFDQSxZQUFBO0VBQ0EsaUJBQUE7QUN3RE47O0FEcERFO0VBQ0UsMkJBQUE7RUFDQSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7QUN1REo7O0FEcERFO0VBQ0UsbUJBQUE7QUN1REo7O0FEcERJO0VBQ0UsY0FBQTtFQUNBLG9CQUFBO0FDdUROOztBRGxETTtFQUNFLHFCQUFBO0VBQ0EsaUJBQUE7RUFDQSwyQkFBQTtBQ3FEUjs7QURwRFE7RUFDRSx5QkFBQTtBQ3NEVjs7QURyRFU7RUFDRSwwQkFBQTtBQ3VEWjs7QURoREU7RUFDRSxpQ0FBQTtFQUNBLHNCQUFBO0VBQ0Esb0JBQUE7RUFDQSxrQkFBQTtFQUNBLDJCQUFBO0VBQ0Esd0NBQUE7QUNtREo7O0FEbERJO0VBQ0UsYUFBQTtFQUNBLHdCQUFBO0VBQ0EsV0FBQTtFQUNBLDJCQUFBO0FDb0ROOztBRG5ETTtFQUNFLFNBQUE7QUNxRFI7O0FEcERRO0VBQ0UsV0FBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtFQUNBLFdBQUE7RUFDQSxlQUFBO0VBQ0Esa0JBQUE7RUFDQSxpQkFBQTtFQUNBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0FDc0RWOztBRG5ETTtFQUNFLFVBQUE7QUNxRFI7O0FEcERRO0VBQ0Usd0JBQUE7RUFDQSxXQUFBO0FDc0RWOztBRHBEUTtFQUNFLGFBQUE7RUFDQSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSwyQkFBQTtFQUNBLGlCQUFBO0VBQ0EsZUFBQTtBQ3NEVjs7QURyRFU7RUFQRjtJQVFNLHNCQUFBO0VDd0RaO0FBQ0Y7O0FEdkRVO0VBQ0ksYUFBQTtFQUNBLFdBQUE7RUFDQSxzQkFBQTtFQUNBLFdBQUE7RUFDQSxlQUFBO0VBQ0EsU0FBQTtBQ3lEZDs7QUR4RGM7RUFDSSxhQUFBO0FDMERsQjs7QUR6RGtCO0VBRko7SUFHUSxXQUFBO0VDNERwQjtBQUNGOztBRDNEa0I7RUFDRSxXQUFBO0VBQ0EsU0FBQTtFQUNBLFlBQUE7RUFDQSxrQkFBQTtFQUNBLFFBQUE7QUM2RHBCOztBRDFEYztFQUNFLFdBQUE7RUFDQSxhQUFBO0VBQ0Esa0JBQUE7QUM0RGhCOztBRDNEZ0I7RUFKRjtJQUtNLFdBQUE7RUM4RGxCO0FBQ0Y7O0FENURjO0VBQ0ksZUFBQTtFQUNBLFdBQUE7QUM4RGxCOztBRHpETTtFQUNFLGFBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0FDMkRSOztBRDFEUTtFQUNFLFdBQUE7RUFDQSxlQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxpQkFBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxrQkFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDNERWOztBRHhESTtFQUNFLG9DQUFBO0VBQ0Esb0NBQUE7QUMwRE47O0FEdkRVO0VBQ0UsY0FBQTtBQ3lEWjs7QURyRGM7RUFDRSxjQUFBO0FDdURoQjs7QURoRFE7RUFDRSxjQUFBO0VBQ0EsZUFBQTtFQUNBLHlCQUFBO0FDa0RWOztBRGpEVTtFQUNFLHlCQUFBO0FDbURaOztBRDdDRTtFQUNFLGdCQUFBO0VBQ0EsV0FBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxtQkFBQTtFQUNBLHNCQUFBO0FDZ0RKOztBRC9DSTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtFQUNBLDhCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkFBQTtBQ2lETjs7QUQvQ0k7RUFDRSx1QkFBQTtFQUNBLHFCQUFBO0FDaUROOztBRDVDTTtFQUNFLFdBQUE7QUMrQ1I7O0FEOUNRO0VBQ0UsYUFBQTtBQ2dEVjs7QUR6Q007RUFDRSxtQkFBQTtFQUNBLFdBQUE7QUM0Q1I7O0FEMUNVO0VBQ0UsV0FBQTtBQzRDWjs7QURyQ0k7RUFDRSwrQkFBQTtFQUNBLDRCQUFBO0VBQ0EsdUJBQUE7QUN3Q047O0FEdkNNO0VBQ0UsZUFBQTtBQ3lDUjs7QUR4Q1E7RUFDRSxlQUFBO0FDMENWOztBRHhDUTtFQUNFLGVBQUE7RUFDQSx1QkFBQTtFQUNBLGlCQUFBO0FDMENWOztBRHJDRTtFQUNJLDRCQUFBO0VBQ0EsdUJBQUE7QUN3Q047O0FEdkNNO0VBQ0UsZUFBQTtBQ3lDUjs7QUR4Q1E7RUFDRSxlQUFBO0FDMENWOztBRHhDUTtFQUNFLGVBQUE7RUFDQSx1QkFBQTtFQUNBLGlCQUFBO0FDMENWOztBRHRDRTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHlCQUFBO0FDeUNKOztBRHhDSTtFQUpGO0lBS0ksc0JBQUE7RUMyQ0o7QUFDRjs7QUQxQ0k7RUFDRSx3QkFBQTtFQUNBLGVBQUE7QUM0Q047O0FEM0NNO0VBQ0UsbUJBQUE7QUM2Q1I7O0FEM0NNO0VBQ0UsNkJBQUE7QUM2Q1I7O0FEM0NNO0VBQ0UsdUJBQUE7QUM2Q1I7O0FEM0NNO0VBQ0UscUJBQUE7RUFDQSx1QkFBQTtFQUNBLHFCQUFBO0FDNkNSOztBRDNDTTtFQUNFLHVCQUFBO0FDNkNSOztBRDFDSTtFQUNFLFlBQUE7QUM0Q047O0FEM0NNO0VBQ0UsZUFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxTQUFBO0FDNkNSOztBRDNDTTtFQUNFLHVCQUFBO0VBQ0Esc0JBQUE7RUFDQSxvQkFBQTtFQUNBLGlCQUFBO0VBQ0Esc0JBQUE7RUFDQSwwQkFBQTtFQUNBLDBCQUFBO0VBQ0EscUJBQUE7QUM2Q1I7O0FEMUNJO0VBQ0UsV0FBQTtFQUNBLGlCQUFBO0VBQ0Esc0JBQUE7RUFDQSxhQUFBO0FDNENOOztBRDNDTTtFQUxGO0lBTUksV0FBQTtJQUNBLGlCQUFBO0lBQ0Esa0JBQUE7RUM4Q047QUFDRjs7QUQ3Q007RUFDRSxhQUFBO0FDK0NSOztBRDdDTTtFQUNFLG1CQUFBO0FDK0NSOztBRDNDTTtFQUNFLGFBQUE7QUM2Q1I7O0FEMUNJO0VBQ0UsaUJBQUE7QUM0Q047O0FEdkNRO0VBQ0UsZ0JBQUE7RUFDQSxZQUFBO0VBQ0EseUJBQUE7RUFDQSxhQUFBO0VBQ0Esc0JBQUE7QUMwQ1YiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL3Byb2ZpbGVtYW5hZ2VtZW50L2NvbnRhY3RpbmZvcm1hdGlvbi9hZGRjb250YWN0L2FkZGNvbnRhY3QuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJAbWl4aW4gZmxleGNlbnRlciB7XHJcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBAbWl4aW4gZmxleHN0YXJ0IHtcclxuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBAbWl4aW4gZmxleGVuZCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIEBtaXhpbiBzcGFjZWJldHdlZW4ge1xyXG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIEBtaXhpbiBjb21tYW5jc3Nmb3JwdGFnIHtcclxuICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgIG1hcmdpbjogMDtcclxuICB9XHJcbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2Uge1xyXG4gICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC50aXRsZXRleHQge1xyXG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsb3NlYW5kYWRkIHtcclxuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgfVxyXG4gIC53aWR0aGZheHtcclxuICAgICB3aWR0aDogODAlO1xyXG4gIH1cclxuICAud2lkdGhmbGFndmlld3tcclxuICAgICB3aWR0aDogMjAlO1xyXG4gIH1cclxuICBpbWdbc3JjPVwibnVsbFwiXSB7XHJcbiAgICBkaXNwbGF5OiBub25lO1xyXG4gIH1cclxuICBpbWdbc3JjPVwiW29iamVjdCBTdG9yYWdlXVwiXSB7XHJcbiAgICBkaXNwbGF5OiBub25lO1xyXG4gIH1cclxuICAuZmxhZ2ljb257XHJcbiAgICBwb3NpdGlvbjpyZWxhdGl2ZTtcclxuICAgIHRvcDozcHg7XHJcbiAgfVxyXG4gIC5mbGV4c2FtZSB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxuICAuaW5mb3JtYXRpb24ge1xyXG4gICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIG1hcmdpbjogMDtcclxuICAgIC5pbmZvIHtcclxuICAgICAgcGFkZGluZzogMTVweCAhaW1wb3J0YW50O1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICBhIHtcclxuICAgICAgICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAubWF0LWJ1dHRvbi10b2dnbGUtY2hlY2tlZCB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjMmRiZTU1O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgfVxyXG4gIFxyXG4gIC5kb2N1bWVudHNyb3cge1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBcclxuICBtYXQtb3B0aW9uW2FyaWEtbGFiZWxdIHtcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xyXG4gICAgaGVpZ2h0OiA1MHB4O1xyXG4gICAgcGFkZGluZy10b3A6IDBweDtcclxuICAgIHBhZGRpbmctYm90dG9tOiAxNXB4O1xyXG4gICAgJjo6YWZ0ZXIge1xyXG4gICAgICBjb250ZW50OiBhdHRyKGFyaWEtbGFiZWwpO1xyXG4gICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgIGJvdHRvbTogLTVweDtcclxuICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgICBjb2xvcjogIzY2NjY2NjtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLm1hdC10YWItYm9keS1jb250ZW50Ojotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICB3aWR0aDogMC41ZW07XHJcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICByaWdodDogMDtcclxuICB9XHJcbiAgXHJcbiAgLm1hdC10YWItYm9keS1jb250ZW50Ojotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjYjhjM2NiO1xyXG4gIH1cclxuICBcclxuICAub3JnYW5pc2F0aW9uaW5mbyB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gIH1cclxuICBcclxuICAjbWFzdGVyY29tcGFueWRldGFpbCB7XHJcbiAgICAuYm9yZGVyY2xhc3Mge1xyXG4gICAgICBib3JkZXI6IDVweCBzb2xpZCAjMDA2Y2I3O1xyXG4gICAgfVxyXG4gIH1cclxuICAudG9waGVhZGVybWFpbiB7XHJcbiAgICBAaW5jbHVkZSBzcGFjZWJldHdlZW4oKTtcclxuICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAuaW1hZ2V3aXRodGV4dCB7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLmNhbmNlbGFuZHB1Ymxpc2gge1xyXG4gICAgLmNhbmNlbCB7XHJcbiAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgY29sb3I6ICM3Nzc7XHJcbiAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNjYmNiY2I7XHJcbiAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnB1Ymxpc2gge1xyXG4gICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgfVxyXG4gIFxyXG4gIDo6bmctZGVlcC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICBib3JkZXItdG9wOiAwLjU0Mzc1ZW0gc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgfVxyXG4gIFxyXG4gIDo6c2xvdHRlZCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKDAsIDAsIDAsIDAuMjIpO1xyXG4gIH1cclxuICAucHJvZmlsZWNvbXBsZXRlbmVzcyB7XHJcbiAgICBwIHtcclxuICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgIH1cclxuICAgIC5tYXQtcHJvZ3Jlc3MtYmFyIHtcclxuICAgICAgd2lkdGg6IDE5MHB4O1xyXG4gICAgICBtYXJnaW4tYm90dG9tOiAxNXB4O1xyXG4gICAgfVxyXG4gIH1cclxuICA6Om5nLWRlZXAubWF0LXByb2dyZXNzLWJhci1maWxsOjphZnRlciB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNzFjMDE1ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIFxyXG4gIC5wcm9ncmVzc2FuZGhpc3Rvcnkge1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xyXG4gIH1cclxuICAucGFnZW51bWJlcmlucHJvZmlsZSB7XHJcbiAgICBib3JkZXI6IDFweCBzb2xpZCAjZmZmO1xyXG4gICAgaGVpZ2h0OiAyMHB4O1xyXG4gICAgbWluLXdpZHRoOiAyMHB4O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4IC8gMTFweDtcclxuICAgIGJhY2tncm91bmQ6ICMyYjdkYjU7XHJcbiAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICB3aWR0aDogYXV0bztcclxuICAgIHBhZGRpbmc6IDAgNnB4O1xyXG4gICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gIH1cclxuICAuY29tcGxldGVkIHtcclxuICAgIGJhY2tncm91bmQ6ICM3MWMxMTQ7XHJcbiAgfVxyXG4gIFxyXG4gIC5tYXQtc2VsZWN0LXBhbmVsIHtcclxuICAgIGJvcmRlci1yYWRpdXM6IDA7XHJcbiAgfVxyXG4gIFxyXG4gIC5tYXQtb3B0aW9uW2FyaWEtZGlzYWJsZWQ9XCJ0cnVlXCJdIHtcclxuICAgIGJhY2tncm91bmQ6ICMwMDZjYjc7XHJcbiAgICBjb2xvcjogI2ZmZjtcclxuICAgIGhlaWdodDogMzVweDtcclxuICB9XHJcbiAgXHJcbiAgLmFjY3JvZGlhbmhlYWRlciB7XHJcbiAgICAuaGVhZGVyIHtcclxuICAgICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC51cGxvYWRhbmRjb21wbmF5aW5mbyB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxuICBcclxuICAuZHJvcGZpbGVzaGVyZXRvYWRkIHtcclxuICAgIHBhZGRpbmc6IDVweDtcclxuICAgIGJvcmRlcjogMXB4IGRhc2hlZCAjOTk5O1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgZGl2IHtcclxuICAgICAgYmFja2dyb3VuZDogI2YzZjRmNjtcclxuICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgIHAge1xyXG4gICAgICAgIEBpbmNsdWRlIGNvbW1hbmNzc2ZvcnB0YWcoKTtcclxuICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5zYXZlYW5kbmV4dCB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZWNlY2VjO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI2VjZWNlYyAhaW1wb3J0YW50O1xyXG4gICAgY29sb3I6ICM5OTkgIWltcG9ydGFudDtcclxuICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gIH1cclxuICAucHJldmlvdXMge1xyXG4gICAgQGV4dGVuZCAuc2F2ZWFuZG5leHQ7XHJcbiAgICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcclxuICAgIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xyXG4gICAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xyXG4gICAgd2lkdGg6IGF1dG87XHJcbiAgfVxyXG4gIC52aWV3aW5nY29udHJvbHMge1xyXG4gICAgLm1hdC1mb3JtLWZpZWxkIHtcclxuICAgICAgd2lkdGg6IDkwcHg7XHJcbiAgICB9XHJcbiAgfVxyXG4gIFxyXG4gIDo6bmctZGVlcC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICBwYWRkaW5nOiAwICFpbXBvcnRhbnQ7XHJcbiAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5zaG93ZmlsdGVyYW5kYWRkaXRlbSBidXR0b24ge1xyXG4gICAgZm9udC1zaXplOiAxNHB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIHtcclxuICAgIC5jbG9zZWFuZGFkZCB7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgfVxyXG4gICAgaGVpZ2h0OiA1NnB4O1xyXG4gICAgLnRpdGxldGV4dCB7XHJcbiAgICAgIEBpbmNsdWRlIHNwYWNlYmV0d2VlbigpO1xyXG4gICAgICBwYWRkaW5nOiAxMHB4O1xyXG4gICAgfVxyXG4gICAgLmNsZWFyYW5kYWRkYnV0dG9uIHtcclxuICAgICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICAgIC5jbGVhcmJ1dHRvbiB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogIzAwNmNiNztcclxuICAgICAgfVxyXG4gICAgICAuYWRkYnV0dG9uIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjMjhiOGU3O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG4gIDo6bmctZGVlcC5tYXQtZHJhd2VyLWJhY2tkcm9wIHtcclxuICAgIHBvc2l0aW9uOiBmaXhlZDtcclxuICB9XHJcbiAgLmNvbXBhbnlpbmZvbWNwIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gIFxyXG4gICAgaW1nIHtcclxuICAgICAgd2lkdGg6IDQ0cHg7XHJcbiAgICAgIGhlaWdodDogNDRweDtcclxuICAgIH1cclxuICAgIC5seXBpc2lkIHtcclxuICAgICAgY29sb3I6ICM2NjY2NjY7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgIH1cclxuICAgIHAge1xyXG4gICAgICBtYXJnaW46IDA7XHJcbiAgICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgICBjb2xvcjogIzAwMDtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLmJvcmRlcmJvdHRvbSB7XHJcbiAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcclxuICAgIHBhZGRpbmctYm90dG9tOiA1cHg7XHJcbiAgfVxyXG4gIFxyXG4gIDo6bmctZGVlcC5tYXQtc2VsZWN0LXBhbmVsIHtcclxuICAgIG1heC1oZWlnaHQ6IDQwMHB4O1xyXG4gIH1cclxuICA6Om5nLWRlZXAubWF0LW9wdGlvbjpob3Zlcjpub3QoLm1hdC1vcHRpb24tZGlzYWJsZWQpLFxyXG4gIDo6bmctZGVlcCAubWF0LW9wdGlvbjpmb2N1czpub3QoLm1hdC1vcHRpb24tZGlzYWJsZWQpLFxyXG4gIDo6bmctZGVlcC5tYXQtb3B0aW9uLm1hdC1zZWxlY3RlZDpub3QoLm1hdC1vcHRpb24tZGlzYWJsZWQpIHtcclxuICAgIGJhY2tncm91bmQ6ICNjYmRjZjkgIWltcG9ydGFudDtcclxuICB9XHJcbiAgOjpuZy1kZWVwLm1hdC1vcHRpb24ubWF0LWFjdGl2ZSB7XHJcbiAgICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcclxuICB9XHJcbiAgLmVkaXRhbmRkZWxldGUge1xyXG4gICAgZGlzcGxheTogaW5saW5lLWZsZXg7XHJcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xyXG4gIFxyXG4gICAgLmVkaXQge1xyXG4gICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgfVxyXG4gICAgaSB7XHJcbiAgICAgIGZvbnQtc2l6ZTogMXJlbTtcclxuICAgIH1cclxuICAgIHNwYW4ge1xyXG4gICAgICBvcGFjaXR5OiAwO1xyXG4gICAgICB3aWR0aDogMzVweDtcclxuICAgICAgaGVpZ2h0OiAzNXB4O1xyXG4gICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgOjpuZy1kZWVwLm51bWJlcmFuZGNvZGUge1xyXG4gICAgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcclxuICAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAuYWRkZWRjZXJ0aWZpY2F0ZSB7XHJcbiAgICBwYWRkaW5nOiAyMHB4O1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICAmOmhvdmVyIHtcclxuICAgICAgYmFja2dyb3VuZDogI2UxZWZmZjtcclxuICAgICAgLmNlcnRpZmljYXRlaW1hZ2Uge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICMwMDZjYjc7XHJcbiAgICAgICAgaSB7XHJcbiAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgLmVkaXRhbmRkZWxldGUgc3BhbiB7XHJcbiAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjY2JkY2Y5O1xyXG4gICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDUwJTtcclxuICAgICAgfVxyXG4gICAgICAuY29tcGFueWFuZG9mZmljZWluZm8ge1xyXG4gICAgICAgIC5uYW1lIHtcclxuICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgIH1cclxuICAgICAgICAuZWFjaGl0ZW0gLmxhYmxlbmFtZSB7XHJcbiAgICAgICAgICBjb2xvcjogIzAwNmNiNztcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgLmNlcnRpZmljYXRlcyB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxuICA6aG9zdCA6Om5nLWRlZXAubWFzdGVyY29tcG5heWNvbnRlbnQgLmNvbW1vbmV4cGFuZGFuZGNvbGxhcHNlIC5tYXQtZXhwYW5zaW9uLXBhbmVsLWJvZHkge1xyXG4gICAgcGFkZGluZzogMTBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuY2VydGl0aWNhdGVjb3VudHMge1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICBwIHtcclxuICAgICAgY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICB9XHJcbiAgXHJcbiAgICAuYWRkYnV0dG9uIHtcclxuICAgICAgYmFja2dyb3VuZDogIzAwNmNiNztcclxuICAgICAgZm9udC1zaXplOiAxNHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLmNlcnRpZmljYXRlaW5mbyB7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDIwcHg7XHJcbiAgICBwIHtcclxuICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICBjb2xvcjogIzAwMDtcclxuICAgICAgcGFkZGluZy1ib3R0b206IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuY2VybGFiZWwge1xyXG4gICAgICBjb2xvcjogIzk5OTtcclxuICAgIH1cclxuICAgIC5oZWFkZXIge1xyXG4gICAgICBjb2xvcjogIzMzMztcclxuICAgICAgZm9udC1zaXplOiAxLjEyNXJlbTtcclxuICAgICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICAgIHBhZGRpbmctYm90dG9tOiAxNXB4O1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAucHJpbWFyeW9mZmljZWluZm8ge1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICAub2ZmaWNlYnVpbGRpbmcge1xyXG4gICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgICAgcGFkZGluZzogMjBweDtcclxuICAgICAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgICAuYWRkcmVzc2xhYmVsIHtcclxuICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgIGZvbnQtc2l6ZTogMTFweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIHtcclxuICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDY1cHgpO1xyXG4gICAgICAubmFtZSB7XHJcbiAgICAgICAgY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIHtcclxuICAgIHAge1xyXG4gICAgICBtYXJnaW46IDA7XHJcbiAgICB9XHJcbiAgICAuY3JhbmRicmFuY2hpZHMge1xyXG4gICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgICAgcGFkZGluZy10b3A6IDEwcHg7XHJcbiAgICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gICAgICAuY291bnQge1xyXG4gICAgICAgIGZvbnQtZmFtaWx5OiAnY2Fpcm9zZW1pYm9sZCc7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgIC50aXRsZSB7XHJcbiAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICAgIG1hcmdpbjogMDtcclxuICAgICAgbGluZS1oZWlnaHQ6IDAuOTtcclxuICAgICAgcGFkZGluZy1ib3R0b206IDZweDtcclxuICAgIH1cclxuICAgIC5sYWJsZW5hbWUge1xyXG4gICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICB9XHJcbiAgICAubmFtZSB7XHJcbiAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICBmb250LXNpemU6IDFyZW07XHJcbiAgICAgIG1hcmdpbjogMDtcclxuICAgICAgbGluZS1oZWlnaHQ6IDEuNTtcclxuICAgIH1cclxuICB9XHJcbiAgLm9mZmljZWFkZHJlc3NkZXRhaWwge1xyXG4gICAgcGFkZGluZy10b3A6IDIwcHg7XHJcbiAgXHJcbiAgICAuYWRkcmVzc2luZm8ge1xyXG4gICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgIH1cclxuICB9XHJcbiAgLmNvbnRhY3RhbmR3ZWJzaXRlIHtcclxuICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgIHBhZGRpbmctdG9wOiAyMHB4O1xyXG4gICAgcCB7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICBwYWRkaW5nLWJvdHRvbTogNXB4O1xyXG4gICAgfVxyXG4gICAgLmNvbnRhY3Qge1xyXG4gICAgICBwYWRkaW5nLXJpZ2h0OiAyMHB4O1xyXG4gICAgfVxyXG4gICAgLndlYmlzdGUge1xyXG4gICAgICBwYWRkaW5nLWxlZnQ6IDIwcHg7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5jb250YWN0ZGV0YWlscyB7XHJcbiAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgIHBhZGRpbmctdG9wOiAxNXB4O1xyXG4gICAgZGl2IHtcclxuICAgICAgcGFkZGluZy1yaWdodDogMzBweDtcclxuICAgICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICAgIGkge1xyXG4gICAgICAgIGNvbG9yOiAjOWE5YTlhO1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XHJcbiAgICAgIH1cclxuICAgICAgc3BhbiB7XHJcbiAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAuY29tcGFueWRldGFpbHdpdGhmbGFnIHtcclxuICAgIEBpbmNsdWRlIHNwYWNlYmV0d2VlbigpO1xyXG4gIH1cclxuICAuY2VydGlmaWNhdGVpbWFnZSB7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICB3aWR0aDogNjVweDtcclxuICAgIGhlaWdodDogNjVweDtcclxuICAgIGJhY2tncm91bmQ6ICNlNWVlZmU7XHJcbiAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICBpIHtcclxuICAgICAgY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgIGZvbnQtc2l6ZTogMS41NjI1cmVtO1xyXG4gICAgfVxyXG4gIH1cclxuICAuY291bnRyeWFuZGNyaW5mbyB7XHJcbiAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgIHBhZGRpbmctdG9wOiAxMHB4O1xyXG4gICAgLmVhY2hpdGVtIHtcclxuICAgICAgcGFkZGluZy1yaWdodDogNjBweDtcclxuICAgICAgLmxhYmxlbmFtZSB7XHJcbiAgICAgICAgZm9udC1zaXplOiAxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICAgICAgaW1nIHtcclxuICAgICAgICB3aWR0aDogMjJweDtcclxuICAgICAgfVxyXG4gICAgICAmOmxhc3QtY2hpbGQge1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDA7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLnNlYXJjaGl0ZW1iZWxvdyB7XHJcbiAgICBAaW5jbHVkZSBzcGFjZWJldHdlZW4oKTtcclxuICAgIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICBoZWlnaHQ6IDUwcHg7XHJcbiAgICBpbnB1dCB7XHJcbiAgICAgIGhlaWdodDogMTAwJTtcclxuICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgIGJvcmRlcjogbm9uZTtcclxuICAgIH1cclxuICB9XHJcbiAgLlBheW1lbnRjb250YWN0aGVhZCB7XHJcbiAgICBwIHtcclxuICAgICAgY29sb3I6IHJlZDtcclxuICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5zZXRjb3VudHJ5ZmxhZyB7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgLmNvZGUge1xyXG4gICAgICB3aWR0aDogNjBweDtcclxuICAgIH1cclxuICAgIC5udW1iZXIge1xyXG4gICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTIwcHgpO1xyXG4gICAgfVxyXG4gICAgLmV4dCB7XHJcbiAgICAgIHdpZHRoOiA2MHB4O1xyXG4gICAgfVxyXG4gICAgLmZheG51bWJlciB7XHJcbiAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSA2MHB4KTtcclxuICAgIH1cclxuICB9XHJcbiAgLmZsYWdpbWFnZSBpbWcge1xyXG4gICAgbWF4LXdpZHRoOiAyNHB4O1xyXG4gICAgbWFyZ2luLXRvcDogLTVweDtcclxuICB9XHJcbiAgXHJcbiAgOjpuZy1kZWVwLmNvdW50cnluYW1lc2VsZWN0IHtcclxuICAgIGhlaWdodDogNDBweCAhaW1wb3J0YW50O1xyXG4gICAgbGluZS1oZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcclxuICAgIC5tYXQtb3B0aW9uLXRleHQge1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICBpbWcge1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgbWF4LXdpZHRoOiAzNHB4O1xyXG4gICAgICAgIGhlaWdodDogYXV0bztcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAubWFwd2lkdGgge1xyXG4gICAgaW1nIHtcclxuICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5wcm9maWxlbGlua2JveHNoYWRvdyB7XHJcbiAgICBib3gtc2hhZG93OiAwIDAgNXB4ICNkZGQ7XHJcbiAgICB3aWR0aDogMTAwJTtcclxuICAgIHBhZGRpbmctbGVmdDogN3B4O1xyXG4gICAgcGFkZGluZy1yaWdodDogN3B4O1xyXG4gIH1cclxuICAuYm9yZGVyZmxleCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgIG1pbi1oZWlnaHQ6IDQ1cHg7XHJcbiAgICBwYWRkaW5nLXRvcDogNXB4O1xyXG4gIH1cclxuICAucGRmdmlldyB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxuICAuU2VhcmNoIHtcclxuICAgIHAge1xyXG4gICAgICBjb2xvcjogI2E5YTlhOTtcclxuICAgIH1cclxuICB9XHJcbiAgLlNlYXJjaGNvbG9yIHtcclxuICAgIGNvbG9yOiAjYTlhOWE5O1xyXG4gIH1cclxuICAuY2VydGlmaWNhdGVib3JkZXIge1xyXG4gICAgYm9yZGVyOiAxcHggZGFzaGVkICNiM2IzYjMgIWltcG9ydGFudDtcclxuICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgaGVpZ2h0OiA2MHB4O1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgYmFja2dyb3VuZDogI2YzZjRmNjtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgXHJcbiAgICAuZmlsZWhlcmVjb2xvciB7XHJcbiAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgfVxyXG4gICAgLmFkZGZpbGVjb2xvciB7XHJcbiAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgfVxyXG4gICAgLnVwbG9hZHBkZiB7XHJcbiAgICAgIGNvbG9yOiAjOTg5ODk4O1xyXG4gICAgICBwIHtcclxuICAgICAgICBjb2xvcjogIzk4OTg5ODtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAucGRmYmFja2dyb3VuZCB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWRmM2ZmO1xyXG4gIH1cclxuICAudXBsb2FkcGhvdG8ge1xyXG4gICAgcGFkZGluZzogNXB4O1xyXG4gICAgYm9yZGVyOiAxcHggZGFzaGVkICM5OTk7XHJcbiAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICBoZWlnaHQ6IDE1MHB4O1xyXG4gICAgd2lkdGg6IDE1MHB4O1xyXG4gICAgLm91dGVybGF5ZXIge1xyXG4gICAgICBiYWNrZ3JvdW5kOiAjZThlYmYwO1xyXG4gICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICBcclxuICAgICAgcCB7XHJcbiAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDEwcHg7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgLm1hcmtldGluZ2hlaWdodCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIGhlaWdodDogMTk1cHg7XHJcbiAgICBwIHtcclxuICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgIG1hcmdpbi10b3A6IDM4cHg7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC50ZXh0Y29sb3Ige1xyXG4gICAgY29sb3I6ICMwMDZjYjcgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLmRlbGV0ZWZsZXhlbmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gIH1cclxuICAuYm9yZGVyIHtcclxuICAgIGJvcmRlcjogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgd2lkdGg6IDk2JSAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuZmxleG9tYW4ge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgfVxyXG4gIFxyXG4gIC5mbGV4c2VyYWNoIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gIH1cclxuICAuaWNvbnN0eWxlIHtcclxuICAgIGZvbnQtc2l6ZTogMS4xMjVyZW07XHJcbiAgICBjb2xvcjogIzAwNmNiNztcclxuICB9XHJcbiAgXHJcbiAgLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICBwYWRkaW5nOiAxNXB4IDE1cHg7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZTllZGYwO1xyXG4gIH1cclxuICBcclxuICAuc2VhcmNoc2VsZWN0IHtcclxuICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xyXG4gICAgcGFkZGluZy1sZWZ0OiAxMHB4O1xyXG4gIH1cclxuICBcclxuICBAbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcclxuICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIHtcclxuICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAudGl0bGV0ZXh0IHtcclxuICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbG9zZWFuZGFkZCB7XHJcbiAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuaW5ubmVycGFydG9mZHJ3ZXIge1xyXG4gICAgICBwYWRkaW5nLWxlZnQ6IDIwcHggIWltcG9ydGFudDtcclxuICAgICAgcGFkZGluZy1yaWdodDogMjBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgaHRtbCBib2R5IC5wLXItMjAge1xyXG4gICAgICBwYWRkaW5nLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICB9XHJcbiAgOjpuZy1kZWVwLnNpZGVuYXZtYWlucm93IC5pbm5uZXJwYXJ0b2ZkcndlciB7XHJcbiAgICBwYWRkaW5nLXRvcDogMjVweDtcclxuICAgIHBhZGRpbmctbGVmdDogNzVweDtcclxuICAgIHBhZGRpbmctcmlnaHQ6IDc1cHg7XHJcbiAgICBwYWRkaW5nLWJvdHRvbTogNzBweCAhaW1wb3J0YW50O1xyXG4gICAgbWF4LWhlaWdodDogY2FsYygxMDB2aCAtIDE0MHB4KSAhaW1wb3J0YW50O1xyXG4gICAgb3ZlcmZsb3cteDogaGlkZGVuO1xyXG4gICAgb3ZlcmZsb3cteTogYXV0bztcclxuICAgIGhlaWdodDogMTAwJTtcclxuICB9XHJcbiAgXHJcbiAgLmRlc2NyaXB0aW9uY29udGVudG1hcmtldHByZXNlbmNlIHtcclxuICAgICYuc2hvdyB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICB9XHJcbiAgICAmLmhpZGUge1xyXG4gICAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgfVxyXG4gIHN1cCB7XHJcbiAgICBjb2xvcjogcmVkO1xyXG4gIH1cclxuICAucHJlRmxhZyB7XHJcbiAgICB3aWR0aDogY2FsYygxMDAlIC0gNjBweCkgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLmJvcmRlcmJvdHRvbSB7XHJcbiAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIFxyXG4gIC5zZWFyY2hpbm11bHRpc2VsZWN0IHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgcGFkZGluZzogNnB4IDEwcHg7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZTllZGYwO1xyXG4gIFxyXG4gICAgaW5wdXQ6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXIge1xyXG4gICAgICBjb2xvcjogIzdmOGZhMyAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIFxyXG4gICAgaSB7XHJcbiAgICAgIGNvbG9yOiAjN2Y4ZmEzICFpbXBvcnRhbnQ7XHJcbiAgICAgIHBhZGRpbmctcmlnaHQ6IDZweDtcclxuICAgIH1cclxuICBcclxuICAgIC5zZWFyY2hzZWxlY3Qge1xyXG4gICAgICB3aWR0aDogY2FsYygxMDAlIC0gMjVweCkgIWltcG9ydGFudDtcclxuICAgIH1cclxuICBcclxuICAgIC5yZXNldGljb24ge1xyXG4gICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5vcHRpb24tbGlzdGluZyB7XHJcbiAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgb3ZlcmZsb3cteTogYXV0bztcclxuICAgIG1heC1oZWlnaHQ6IDI5MHB4O1xyXG4gIH1cclxuICBcclxuICAuY291bnRyeW5hbWVzZWxlY3Qge1xyXG4gICAgbGluZS1oZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcclxuICAgIGhlaWdodDogNDBweCAhaW1wb3J0YW50O1xyXG4gICAgaW1nIHtcclxuICAgICAgd2lkdGg6IDI0cHg7XHJcbiAgICAgIGhlaWdodDogYXV0bztcclxuICAgICAgbWFyZ2luLXJpZ2h0OiA1cHg7XHJcbiAgICAgIC8vIG1hcmdpbi10b3A6IC04cHg7XHJcbiAgICB9XHJcbiAgfVxyXG4gIDo6bmctZGVlcC5zZWxlY3Rfd2l0aF9zZWFyY2gge1xyXG4gICAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xyXG4gICAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgbWFyZ2luLXRvcDogNDBweCAhaW1wb3J0YW50O1xyXG4gICAgbWFyZ2luLWJvdHRvbTogMTVweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBcclxuICA6aG9zdDo6bmctZGVlcC5tYXQtdG9vbHRpcCB7XHJcbiAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gIH1cclxuICA6aG9zdDo6bmctZGVlcC5zYW1lYXNhZGRyZXNzIHtcclxuICAgIC5tYXQtY2hlY2tib3gtbGFiZWwge1xyXG4gICAgICBjb2xvcjogI2Y0N2YxZjtcclxuICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICB9XHJcbiAgfVxyXG4gIDo6bmctZGVlcCNkYXRhX2Rlc2lnbiB7XHJcbiAgICAuc2lkZW5hdm1haW5yb3cge1xyXG4gICAgICAuaW5ubmVycGFydG9mZHJ3ZXIge1xyXG4gICAgICAgIHBhZGRpbmc6IDAgIWltcG9ydGFudDtcclxuICAgICAgICBvdmVyZmxvdzogaW5pdGlhbCA7XHJcbiAgICAgICAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgIC5vcmdhbmlzYXRpb25pbmZve1xyXG4gICAgICAgICAgcGFkZGluZy10b3A6IDAgIWltcG9ydGFudDtcclxuICAgICAgICAgIC5kYXRhX3dpZHRoe1xyXG4gICAgICAgICAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLm1hdC1jYXJkLnNlbGVjdGVkYnNmdWxse1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjojZmZmICFpbXBvcnRhbnQ7XHJcbiAgICBib3JkZXI6IHNvbGlkIDFweCAjZmZmO1xyXG4gICAgbWFyZ2luOjAgIWltcG9ydGFudDtcclxuICAgIGJvcmRlci1yYWRpdXM6MnB4O1xyXG4gICAgYm94LXNoYWRvdzpub25lICFpbXBvcnRhbnQ7XHJcbiAgICBib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZGRkICFpbXBvcnRhbnQ7XHJcbiAgICAubWF0LWNhcmQtaGVhZGVye1xyXG4gICAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICAgIHBhZGRpbmc6IDE1cHggIWltcG9ydGFudDtcclxuICAgICAgd2lkdGg6MTAwJTtcclxuICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAuc2JzaW1ne1xyXG4gICAgICAgIHdpZHRoOjclO1xyXG4gICAgICAgIC5pbWdiZ3tcclxuICAgICAgICAgIHdpZHRoOjQ4cHg7XHJcbiAgICAgICAgICBoZWlnaHQ6NjRweDtcclxuICAgICAgICAgIGJhY2tncm91bmQ6IzAwNmNiNztcclxuICAgICAgICAgIGNvbG9yOiNmZmY7XHJcbiAgICAgICAgICBmb250LXNpemU6MjhweDtcclxuICAgICAgICAgIHRleHQtYWxpZ246Y2VudGVyO1xyXG4gICAgICAgICAgbGluZS1oZWlnaHQ6NjRweDtcclxuICAgICAgICAgIGRpc3BsYXk6ZmxleDtcclxuICAgICAgICAgIGp1c3RpZnktY29udGVudDpjZW50ZXI7XHJcbiAgICAgICAgICBhbGlnbi1pdGVtczpjZW50ZXI7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICAgIC5zYnNkZXRhaWxze1xyXG4gICAgICAgIHdpZHRoOjkwJTtcclxuICAgICAgICAuc2VsZWN0dGl0bGUge1xyXG4gICAgICAgICAgZm9udC1mYW1pbHk6XCJjYWlyb2JvbGRcIjtcclxuICAgICAgICAgIGNvbG9yOiMzMzM7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5zZWxlY3RzdWJ0aXRsZXtcclxuICAgICAgICAgIGRpc3BsYXk6ZmxleDtcclxuICAgICAgICAgIHdpZHRoOjEwMCU7XHJcbiAgICAgICAgICBmbGV4LWRpcmVjdGlvbjpyb3c7XHJcbiAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICBsaW5lLWhlaWdodDoxN3B4O1xyXG4gICAgICAgICAgZmxleC13cmFwOndyYXA7XHJcbiAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo3NjhweCl7XHJcbiAgICAgICAgICAgICAgZmxleC1kaXJlY3Rpb246Y29sdW1uO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICBwe1xyXG4gICAgICAgICAgICAgIGRpc3BsYXk6ZmxleDtcclxuICAgICAgICAgICAgICB3aWR0aDoxMDAlO1xyXG4gICAgICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOmNvbHVtbjtcclxuICAgICAgICAgICAgICBjb2xvcjojMjIyO1xyXG4gICAgICAgICAgICAgIGZvbnQtc2l6ZToxNHB4O1xyXG4gICAgICAgICAgICAgIG1hcmdpbjowO1xyXG4gICAgICAgICAgICAgICYuY291bnRyeXtcclxuICAgICAgICAgICAgICAgICAgd2lkdGg6MzMuMzMlO1xyXG4gICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo3NjhweCl7XHJcbiAgICAgICAgICAgICAgICAgICAgICB3aWR0aDoxMDAlO1xyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIGltZ3tcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMjJweDtcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW46MDtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IGF1dG87XHJcbiAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgIHRvcDogMnB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAmLmFkZHJlc3N7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDoxMDAlO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTpmbGV4O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOjEwcHggMCAwIDA7XHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo3NjhweCl7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6MTAwJTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgc3Bhbi5jYm94LWxhYmVse1xyXG4gICAgICAgICAgICAgICAgICBmb250LXNpemU6MTJweDtcclxuICAgICAgICAgICAgICAgICAgY29sb3I6Izk5OTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICAgIC5kZWxldGVkaXYge1xyXG4gICAgICAgIGRpc3BsYXk6ZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIC5iZ2l7XHJcbiAgICAgICAgICBjb2xvcjojZmZmO1xyXG4gICAgICAgICAgY3Vyc29yOnBvaW50ZXI7XHJcbiAgICAgICAgICB3aWR0aDogMzFweDtcclxuICAgICAgICAgIGhlaWdodDogMzFweDtcclxuICAgICAgICAgIGxpbmUtaGVpZ2h0OiAzMXB4O1xyXG4gICAgICAgICAgYm9yZGVyLXJhZGl1czogMzFweDtcclxuICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICAmOmhvdmVye1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiNmM2Y1ZjkgIWltcG9ydGFudDtcclxuICAgICAgYm9yZGVyOiBzb2xpZCAxcHggI2YzZjVmOSAhaW1wb3J0YW50O1xyXG4gICAgICAubWF0LWNhcmQtaGVhZGVye1xyXG4gICAgICAgIC5zYnNkZXRhaWxze1xyXG4gICAgICAgICAgLnNlbGVjdHRpdGxlIHtcclxuICAgICAgICAgICAgY29sb3I6IzE4NzdiYjtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIC5zZWxlY3RzdWJ0aXRsZXtcclxuICAgICAgICAgICAgcHtcclxuICAgICAgICAgICAgICBzcGFuLmNib3gtbGFiZWx7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjojMTg3N2JiO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgICAuZGVsZXRlZGl2IHtcclxuICAgICAgICAuYmdpe1xyXG4gICAgICAgICAgY29sb3I6IzE4NzdiYjtcclxuICAgICAgICAgIGN1cnNvcjpwb2ludGVyO1xyXG4gICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2M1ZGJmZDtcclxuICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjYzVkYmZkO1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAucHJvZmlsZWxpbmtib3hzaGFkb3cge1xyXG4gICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgcGFkZGluZy1sZWZ0OiA3cHg7XHJcbiAgICBwYWRkaW5nLXJpZ2h0OiA3cHg7XHJcbiAgICBtYXJnaW4tYm90dG9tOjEwcHg7XHJcbiAgICBib3JkZXI6MXB4IHNvbGlkICNkZGQ7XHJcbiAgICAuYm9yZGVyZmxleCB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgbWluLWhlaWdodDogNDVweDtcclxuICAgICAgcGFkZGluZy10b3A6IDVweDtcclxuICAgIH1cclxuICAgIC5ib3JkZXIge1xyXG4gICAgICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgd2lkdGg6IDk2JSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIH1cclxuICAudGFic2VjdGlvbi5tcHRhYntcclxuICAgIC5tYXQtdGFiLWdyb3Vwe1xyXG4gICAgICAmLmhpZGV0YWJzdHlsZXtcclxuICAgICAgICB3aWR0aDoxMDAlO1xyXG4gICAgICAgIC5tYXQtdGFiLWhlYWRlcntcclxuICAgICAgICAgIGRpc3BsYXk6bm9uZTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgLnRhYnNlY3Rpb257XHJcbiAgICAubWF0LXRhYi1sYWJlbHtcclxuICAgICAgJi5tYXQtdGFiLWxhYmVsLWFjdGl2ZXtcclxuICAgICAgICBiYWNrZ3JvdW5kOiMxODc3YmI7XHJcbiAgICAgICAgY29sb3I6I2ZmZjtcclxuICAgICAgICAudGFic2VsZWN0aGVhZGVyY29udGVudHtcclxuICAgICAgICAgIHAsaDR7XHJcbiAgICAgICAgICAgIGNvbG9yOiNmZmY7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5pbm5uZXJwYXJ0b2ZkcndlciB7XHJcbiAgICAmLm5vc2Nyb2xse1xyXG4gICAgICAvKm1heC1oZWlnaHQ6dW5zZXQgIWltcG9ydGFudDsqL1xyXG4gICAgICBtaW4taGVpZ2h0OnVuc2V0ICFpbXBvcnRhbnQ7XHJcbiAgICAgIGhlaWdodDphdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgIC5tYXQtdGFiLWJvZHl7XHJcbiAgICAgICAgb3ZlcmZsb3c6dW5zZXQ7XHJcbiAgICAgICAgJi5tYXQtdGFiLWJvZHktYWN0aXZle1xyXG4gICAgICAgICAgb3ZlcmZsb3c6dW5zZXQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtdGFiLWJvZHktY29udGVudHtcclxuICAgICAgICAgIG92ZXJmbG93OnVuc2V0O1xyXG4gICAgICAgICAgaGVpZ2h0OmF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgIHBhZGRpbmctdG9wOjEwcHhcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgLmlubm5lcnBhcnRvZmRyd2VyIHtcclxuICAgICAgbWluLWhlaWdodDp1bnNldCAhaW1wb3J0YW50O1xyXG4gICAgICBoZWlnaHQ6YXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAubWF0LXRhYi1ib2R5e1xyXG4gICAgICAgIG92ZXJmbG93OnVuc2V0O1xyXG4gICAgICAgICYubWF0LXRhYi1ib2R5LWFjdGl2ZXtcclxuICAgICAgICAgIG92ZXJmbG93OnVuc2V0O1xyXG4gICAgICAgIH1cclxuICAgICAgICAubWF0LXRhYi1ib2R5LWNvbnRlbnR7XHJcbiAgICAgICAgICBvdmVyZmxvdzp1bnNldDtcclxuICAgICAgICAgIGhlaWdodDphdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICBwYWRkaW5nLXRvcDoxMHB4XHJcbiAgICAgICAgfVxyXG4gICAgICB9ICBcclxuICB9XHJcbiAgLmJ1c2lzZWFyY2hkaXZ7XHJcbiAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczpjZW50ZXI7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6ZmxleC1lbmQ7XHJcbiAgICBAbWVkaWEgKG1heC13aWR0aDo2NjBweCl7XHJcbiAgICAgIGZsZXgtZGlyZWN0aW9uOmNvbHVtbjtcclxuICAgIH1cclxuICAgIC5zZWFyY2hmaWVsZGRpdntcclxuICAgICAgd2lkdGg6Y2FsYygxMDAlIC0gODBweCk7XHJcbiAgICAgIG1heC13aWR0aDoxMDAlO1xyXG4gICAgICAmLnNob3d7XHJcbiAgICAgICAgdmlzaWJpbGl0eTp2aXNpYmxlO1xyXG4gICAgICB9XHJcbiAgICAgICYuaGlkZXtcclxuICAgICAgICB2aXNpYmlsaXR5OmhpZGRlbiAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICAgIC5tYXQtaW5wdXQtZWxlbWVudHtcclxuICAgICAgICBoZWlnaHQ6MjhweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeHtcclxuICAgICAgICBwYWRkaW5nOjAgIWltcG9ydGFudDtcclxuICAgICAgICBoZWlnaHQ6MzJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlci10b3Atd2lkdGg6NXB4O1xyXG4gICAgICB9XHJcbiAgICAgIGJ1dHRvbntcclxuICAgICAgICBoZWlnaHQ6MzBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICBidXR0b257XHJcbiAgICAgIGhlaWdodDozOHB4O1xyXG4gICAgICAuYmdpLWFkZHtcclxuICAgICAgICBmb250LXNpemU6MTBweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6NXB4O1xyXG4gICAgICAgIHBvc2l0aW9uOnJlbGF0aXZlO1xyXG4gICAgICAgIHRvcDotM3B4O1xyXG4gICAgICB9XHJcbiAgICAgICYuc2VhcmNoYnRue1xyXG4gICAgICAgIGJhY2tncm91bmQ6dHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgY29sb3I6ICMzMzMgIWltcG9ydGFudDtcclxuICAgICAgICBmb250LXNpemU6IDEuMTg3NXJlbTtcclxuICAgICAgICBsaW5lLWhlaWdodDogMTJweDtcclxuICAgICAgICB3aWR0aDo0MnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWluLXdpZHRoOjQycHggIWltcG9ydGFudDtcclxuICAgICAgICBtYXgtd2lkdGg6NDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIHBhZGRpbmc6MCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICAuYnNzZWFyY2hib3h7XHJcbiAgICAgIHdpZHRoOjEwMCU7XHJcbiAgICAgIG1hcmdpbi1yaWdodDowcHg7XHJcbiAgICAgIGJvcmRlcjoxcHggc29saWQgI2RkZDtcclxuICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgQG1lZGlhIChtYXgtd2lkdGg6NjYwcHgpe1xyXG4gICAgICAgIHdpZHRoOjEwMCU7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OjBweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOjVweDtcclxuICAgICAgfVxyXG4gICAgICAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5le1xyXG4gICAgICAgIGRpc3BsYXk6bm9uZTtcclxuICAgICAgfVxyXG4gICAgICAubWF0LWZvcm0tZmllbGQtd3JhcHBlcntcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTowcHg7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIC5tYXQtZm9jdXNlZCwgLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdHtcclxuICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVse1xyXG4gICAgICAgIGRpc3BsYXk6bm9uZTtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsLXdyYXBwZXJ7XHJcbiAgICAgIGxpbmUtaGVpZ2h0OjE0cHg7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC50YWJmb3JjbGllbnRlbGVuZXd7XHJcbiAgICAgIC50YWJzZWxlY3RoZWFkZXJjb250ZW50e1xyXG4gICAgICAgIC5zZWxlY3Rpb250ZXh0e1xyXG4gICAgICAgICAgbWluLWhlaWdodDo1MHB4O1xyXG4gICAgICAgICAgaGVpZ2h0OmF1dG87XHJcbiAgICAgICAgICBhbGlnbi1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgfSBcclxuICAiLCIuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSB7XG4gIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xufVxuXG4uc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAudGl0bGV0ZXh0IHtcbiAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbn1cblxuLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsb3NlYW5kYWRkIHtcbiAgbWFyZ2luLWJvdHRvbTogMTBweDtcbn1cblxuLndpZHRoZmF4IHtcbiAgd2lkdGg6IDgwJTtcbn1cblxuLndpZHRoZmxhZ3ZpZXcge1xuICB3aWR0aDogMjAlO1xufVxuXG5pbWdbc3JjPW51bGxdIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cblxuaW1nW3NyYz1cIltvYmplY3QgU3RvcmFnZV1cIl0ge1xuICBkaXNwbGF5OiBub25lO1xufVxuXG4uZmxhZ2ljb24ge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRvcDogM3B4O1xufVxuXG4uZmxleHNhbWUge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuXG4uaW5mb3JtYXRpb24ge1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG1hcmdpbjogMDtcbn1cbi5pbmZvcm1hdGlvbiAuaW5mbyB7XG4gIHBhZGRpbmc6IDE1cHggIWltcG9ydGFudDtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5pbmZvcm1hdGlvbiAuaW5mbyBhIHtcbiAgdGV4dC1kZWNvcmF0aW9uOiB1bmRlcmxpbmU7XG59XG5cbi5tYXQtYnV0dG9uLXRvZ2dsZS1jaGVja2VkIHtcbiAgYmFja2dyb3VuZDogIzJkYmU1NTtcbiAgY29sb3I6ICNmZmY7XG59XG5cbi5kb2N1bWVudHNyb3cge1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG5cbm1hdC1vcHRpb25bYXJpYS1sYWJlbF0ge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIGNvbG9yOiAjMzMzICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogNTBweDtcbiAgcGFkZGluZy10b3A6IDBweDtcbiAgcGFkZGluZy1ib3R0b206IDE1cHg7XG59XG5tYXQtb3B0aW9uW2FyaWEtbGFiZWxdOjphZnRlciB7XG4gIGNvbnRlbnQ6IGF0dHIoYXJpYS1sYWJlbCk7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgYm90dG9tOiAtNXB4O1xuICBmb250LXNpemU6IDAuNzVyZW07XG4gIGNvbG9yOiAjNjY2NjY2O1xufVxuXG4ubWF0LXRhYi1ib2R5LWNvbnRlbnQ6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcbiAgd2lkdGg6IDAuNWVtO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHJpZ2h0OiAwO1xufVxuXG4ubWF0LXRhYi1ib2R5LWNvbnRlbnQ6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2I4YzNjYjtcbn1cblxuLm9yZ2FuaXNhdGlvbmluZm8ge1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xufVxuXG4jbWFzdGVyY29tcGFueWRldGFpbCAuYm9yZGVyY2xhc3Mge1xuICBib3JkZXI6IDVweCBzb2xpZCAjMDA2Y2I3O1xufVxuXG4udG9waGVhZGVybWFpbiB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbi50b3BoZWFkZXJtYWluIC5pbWFnZXdpdGh0ZXh0IHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG5cbi5jYW5jZWxhbmRwdWJsaXNoIC5jYW5jZWwge1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGNvbG9yOiAjNzc3O1xuICBib3JkZXI6IDFweCBzb2xpZCAjY2JjYmNiO1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbn1cbi5jYW5jZWxhbmRwdWJsaXNoIC5wdWJsaXNoIHtcbiAgaGVpZ2h0OiA0NXB4O1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbn1cblxuLm1hdC1mb3JtLWZpZWxkIHtcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG59XG5cbjo6bmctZGVlcC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIGJvcmRlci10b3A6IDAuNTQzNzVlbSBzb2xpZCB0cmFuc3BhcmVudDtcbn1cblxuOjpzbG90dGVkIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogcmdiYSgwLCAwLCAwLCAwLjIyKTtcbn1cblxuLnByb2ZpbGVjb21wbGV0ZW5lc3MgcCB7XG4gIGNvbG9yOiAjZmZmO1xuICBmb250LXNpemU6IDAuNzVyZW07XG59XG4ucHJvZmlsZWNvbXBsZXRlbmVzcyAubWF0LXByb2dyZXNzLWJhciB7XG4gIHdpZHRoOiAxOTBweDtcbiAgbWFyZ2luLWJvdHRvbTogMTVweDtcbn1cblxuOjpuZy1kZWVwLm1hdC1wcm9ncmVzcy1iYXItZmlsbDo6YWZ0ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjNzFjMDE1ICFpbXBvcnRhbnQ7XG59XG5cbi5wcm9ncmVzc2FuZGhpc3Rvcnkge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDEwcHg7XG59XG5cbi5wYWdlbnVtYmVyaW5wcm9maWxlIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI2ZmZjtcbiAgaGVpZ2h0OiAyMHB4O1xuICBtaW4td2lkdGg6IDIwcHg7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAxMHB4LzExcHg7XG4gIGJhY2tncm91bmQ6ICMyYjdkYjU7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbiAgd2lkdGg6IGF1dG87XG4gIHBhZGRpbmc6IDAgNnB4O1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xufVxuXG4uY29tcGxldGVkIHtcbiAgYmFja2dyb3VuZDogIzcxYzExNDtcbn1cblxuLm1hdC1zZWxlY3QtcGFuZWwge1xuICBib3JkZXItcmFkaXVzOiAwO1xufVxuXG4ubWF0LW9wdGlvblthcmlhLWRpc2FibGVkPXRydWVdIHtcbiAgYmFja2dyb3VuZDogIzAwNmNiNztcbiAgY29sb3I6ICNmZmY7XG4gIGhlaWdodDogMzVweDtcbn1cblxuLmFjY3JvZGlhbmhlYWRlciAuaGVhZGVyIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuXG4udXBsb2FkYW5kY29tcG5heWluZm8ge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuXG4uZHJvcGZpbGVzaGVyZXRvYWRkIHtcbiAgcGFkZGluZzogNXB4O1xuICBib3JkZXI6IDFweCBkYXNoZWQgIzk5OTtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuLmRyb3BmaWxlc2hlcmV0b2FkZCBkaXYge1xuICBiYWNrZ3JvdW5kOiAjZjNmNGY2O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmRyb3BmaWxlc2hlcmV0b2FkZCBkaXYgcCB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBtYXJnaW46IDA7XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvc2VtaWJvbGRcIjtcbn1cbi5kcm9wZmlsZXNoZXJldG9hZGQgZGl2IHAgc3BhbiB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xufVxuXG4uc2F2ZWFuZG5leHQsIC5wcmV2aW91cyB7XG4gIGJhY2tncm91bmQ6ICNlY2VjZWM7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYm9yZGVyOiAxcHggc29saWQgI2VjZWNlYyAhaW1wb3J0YW50O1xuICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cblxuLnByZXZpb3VzIHtcbiAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XG4gIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xuICBtYXJnaW4tcmlnaHQ6IDE1cHg7XG4gIHdpZHRoOiBhdXRvO1xufVxuXG4udmlld2luZ2NvbnRyb2xzIC5tYXQtZm9ybS1maWVsZCB7XG4gIHdpZHRoOiA5MHB4O1xufVxuXG46Om5nLWRlZXAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICBwYWRkaW5nOiAwICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xufVxuXG4uc2hvd2ZpbHRlcmFuZGFkZGl0ZW0gYnV0dG9uIHtcbiAgZm9udC1zaXplOiAxNHB4ICFpbXBvcnRhbnQ7XG59XG5cbi5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIHtcbiAgaGVpZ2h0OiA1NnB4O1xufVxuLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsb3NlYW5kYWRkIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLnRpdGxldGV4dCB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgcGFkZGluZzogMTBweDtcbn1cbi5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbGVhcmFuZGFkZGJ1dHRvbiB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbGVhcmFuZGFkZGJ1dHRvbiAuY2xlYXJidXR0b24ge1xuICBiYWNrZ3JvdW5kOiAjMDA2Y2I3O1xufVxuLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsZWFyYW5kYWRkYnV0dG9uIC5hZGRidXR0b24ge1xuICBiYWNrZ3JvdW5kOiAjMjhiOGU3O1xufVxuXG46Om5nLWRlZXAubWF0LWRyYXdlci1iYWNrZHJvcCB7XG4gIHBvc2l0aW9uOiBmaXhlZDtcbn1cblxuLmNvbXBhbnlpbmZvbWNwIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbn1cbi5jb21wYW55aW5mb21jcCBpbWcge1xuICB3aWR0aDogNDRweDtcbiAgaGVpZ2h0OiA0NHB4O1xufVxuLmNvbXBhbnlpbmZvbWNwIC5seXBpc2lkIHtcbiAgY29sb3I6ICM2NjY2NjY7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbn1cbi5jb21wYW55aW5mb21jcCBwIHtcbiAgbWFyZ2luOiAwO1xuICBsaW5lLWhlaWdodDogMTtcbiAgY29sb3I6ICMwMDA7XG59XG5cbi5ib3JkZXJib3R0b20ge1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcbiAgcGFkZGluZy1ib3R0b206IDVweDtcbn1cblxuOjpuZy1kZWVwLm1hdC1zZWxlY3QtcGFuZWwge1xuICBtYXgtaGVpZ2h0OiA0MDBweDtcbn1cblxuOjpuZy1kZWVwLm1hdC1vcHRpb246aG92ZXI6bm90KC5tYXQtb3B0aW9uLWRpc2FibGVkKSxcbjo6bmctZGVlcCAubWF0LW9wdGlvbjpmb2N1czpub3QoLm1hdC1vcHRpb24tZGlzYWJsZWQpLFxuOjpuZy1kZWVwLm1hdC1vcHRpb24ubWF0LXNlbGVjdGVkOm5vdCgubWF0LW9wdGlvbi1kaXNhYmxlZCkge1xuICBiYWNrZ3JvdW5kOiAjY2JkY2Y5ICFpbXBvcnRhbnQ7XG59XG5cbjo6bmctZGVlcC5tYXQtb3B0aW9uLm1hdC1hY3RpdmUge1xuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcbn1cblxuLmVkaXRhbmRkZWxldGUge1xuICBkaXNwbGF5OiBpbmxpbmUtZmxleDtcbiAgbWFyZ2luLWJvdHRvbTogMTBweDtcbn1cbi5lZGl0YW5kZGVsZXRlIC5lZGl0IHtcbiAgY29sb3I6ICM5OTk7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmVkaXRhbmRkZWxldGUgaSB7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbn1cbi5lZGl0YW5kZGVsZXRlIHNwYW4ge1xuICBvcGFjaXR5OiAwO1xuICB3aWR0aDogMzVweDtcbiAgaGVpZ2h0OiAzNXB4O1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuXG46Om5nLWRlZXAubnVtYmVyYW5kY29kZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG59XG5cbi5hZGRlZGNlcnRpZmljYXRlIHtcbiAgcGFkZGluZzogMjBweDtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjZTFlZmZmO1xufVxuLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgLmNlcnRpZmljYXRlaW1hZ2Uge1xuICBiYWNrZ3JvdW5kOiAjMDA2Y2I3O1xufVxuLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgLmNlcnRpZmljYXRlaW1hZ2UgaSB7XG4gIGNvbG9yOiAjZmZmO1xufVxuLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgLmVkaXRhbmRkZWxldGUgc3BhbiB7XG4gIG9wYWNpdHk6IDE7XG4gIGJhY2tncm91bmQ6ICNjYmRjZjk7XG4gIGNvbG9yOiAjMDA2Y2I3O1xuICBib3JkZXItcmFkaXVzOiA1MCU7XG59XG4uYWRkZWRjZXJ0aWZpY2F0ZTpob3ZlciAuY29tcGFueWFuZG9mZmljZWluZm8gLm5hbWUge1xuICBjb2xvcjogIzAwNmNiNztcbn1cbi5hZGRlZGNlcnRpZmljYXRlOmhvdmVyIC5jb21wYW55YW5kb2ZmaWNlaW5mbyAuZWFjaGl0ZW0gLmxhYmxlbmFtZSB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xufVxuXG4uY2VydGlmaWNhdGVzIHtcbiAgZGlzcGxheTogZmxleDtcbn1cblxuOmhvc3QgOjpuZy1kZWVwLm1hc3RlcmNvbXBuYXljb250ZW50IC5jb21tb25leHBhbmRhbmRjb2xsYXBzZSAubWF0LWV4cGFuc2lvbi1wYW5lbC1ib2R5IHtcbiAgcGFkZGluZzogMTBweCAhaW1wb3J0YW50O1xufVxuXG4uY2VydGl0aWNhdGVjb3VudHMge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4uY2VydGl0aWNhdGVjb3VudHMgcCB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xuICBmb250LXNpemU6IDAuODc1cmVtO1xufVxuLmNlcnRpdGljYXRlY291bnRzIC5hZGRidXR0b24ge1xuICBiYWNrZ3JvdW5kOiAjMDA2Y2I3O1xuICBmb250LXNpemU6IDE0cHggIWltcG9ydGFudDtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG5cbi5jZXJ0aWZpY2F0ZWluZm8ge1xuICBwYWRkaW5nLWxlZnQ6IDIwcHg7XG59XG4uY2VydGlmaWNhdGVpbmZvIHAge1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBtYXJnaW46IDA7XG4gIGNvbG9yOiAjMDAwO1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbi5jZXJ0aWZpY2F0ZWluZm8gLmNlcmxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG59XG4uY2VydGlmaWNhdGVpbmZvIC5oZWFkZXIge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAxLjEyNXJlbTtcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XG4gIHBhZGRpbmctYm90dG9tOiAxNXB4O1xufVxuXG4ucHJpbWFyeW9mZmljZWluZm8ge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4ucHJpbWFyeW9mZmljZWluZm8gLm9mZmljZWJ1aWxkaW5nIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBwYWRkaW5nOiAyMHB4O1xuICBhbGlnbi1pdGVtczogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB3aWR0aDogMTAwJTtcbn1cbi5wcmltYXJ5b2ZmaWNlaW5mbyAuYWRkcmVzc2xhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTFweCAhaW1wb3J0YW50O1xufVxuLnByaW1hcnlvZmZpY2VpbmZvIC5jb21wYW55YW5kb2ZmaWNlaW5mbyB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSA2NXB4KTtcbn1cbi5wcmltYXJ5b2ZmaWNlaW5mbyAuY29tcGFueWFuZG9mZmljZWluZm8gLm5hbWUge1xuICBjb2xvcjogIzAwNmNiNztcbn1cblxuLmNvbXBhbnlhbmRvZmZpY2VpbmZvIHtcbiAgcGFkZGluZy1sZWZ0OiAyMHB4O1xufVxuLmNvbXBhbnlhbmRvZmZpY2VpbmZvIHAge1xuICBtYXJnaW46IDA7XG59XG4uY29tcGFueWFuZG9mZmljZWluZm8gLmNyYW5kYnJhbmNoaWRzIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXRvcDogMTBweDtcbiAgcGFkZGluZy1ib3R0b206IDEwcHg7XG59XG4uY29tcGFueWFuZG9mZmljZWluZm8gLmNyYW5kYnJhbmNoaWRzIC5jb3VudCB7XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvc2VtaWJvbGRcIjtcbn1cbi5jb21wYW55YW5kb2ZmaWNlaW5mbyAudGl0bGUge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAwLjc1cmVtO1xuICBtYXJnaW46IDA7XG4gIGxpbmUtaGVpZ2h0OiAwLjk7XG4gIHBhZGRpbmctYm90dG9tOiA2cHg7XG59XG4uY29tcGFueWFuZG9mZmljZWluZm8gLmxhYmxlbmFtZSB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5jb21wYW55YW5kb2ZmaWNlaW5mbyAubmFtZSB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDFyZW07XG4gIG1hcmdpbjogMDtcbiAgbGluZS1oZWlnaHQ6IDEuNTtcbn1cblxuLm9mZmljZWFkZHJlc3NkZXRhaWwge1xuICBwYWRkaW5nLXRvcDogMjBweDtcbn1cbi5vZmZpY2VhZGRyZXNzZGV0YWlsIC5hZGRyZXNzaW5mbyB7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuXG4uY29udGFjdGFuZHdlYnNpdGUge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctdG9wOiAyMHB4O1xufVxuLmNvbnRhY3RhbmR3ZWJzaXRlIHAge1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgcGFkZGluZy1ib3R0b206IDVweDtcbn1cbi5jb250YWN0YW5kd2Vic2l0ZSAuY29udGFjdCB7XG4gIHBhZGRpbmctcmlnaHQ6IDIwcHg7XG59XG4uY29udGFjdGFuZHdlYnNpdGUgLndlYmlzdGUge1xuICBwYWRkaW5nLWxlZnQ6IDIwcHg7XG59XG5cbi5jb250YWN0ZGV0YWlscyB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgcGFkZGluZy10b3A6IDE1cHg7XG59XG4uY29udGFjdGRldGFpbHMgZGl2IHtcbiAgcGFkZGluZy1yaWdodDogMzBweDtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmNvbnRhY3RkZXRhaWxzIGRpdiBpIHtcbiAgY29sb3I6ICM5YTlhOWE7XG4gIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG59XG4uY29udGFjdGRldGFpbHMgZGl2IHNwYW4ge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbn1cblxuLmNvbXBhbnlkZXRhaWx3aXRoZmxhZyB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cblxuLmNlcnRpZmljYXRlaW1hZ2Uge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHdpZHRoOiA2NXB4O1xuICBoZWlnaHQ6IDY1cHg7XG4gIGJhY2tncm91bmQ6ICNlNWVlZmU7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmNlcnRpZmljYXRlaW1hZ2UgaSB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xuICBmb250LXNpemU6IDEuNTYyNXJlbTtcbn1cblxuLmNvdW50cnlhbmRjcmluZm8ge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctdG9wOiAxMHB4O1xufVxuLmNvdW50cnlhbmRjcmluZm8gLmVhY2hpdGVtIHtcbiAgcGFkZGluZy1yaWdodDogNjBweDtcbn1cbi5jb3VudHJ5YW5kY3JpbmZvIC5lYWNoaXRlbSAubGFibGVuYW1lIHtcbiAgZm9udC1zaXplOiAxMnB4ICFpbXBvcnRhbnQ7XG59XG4uY291bnRyeWFuZGNyaW5mbyAuZWFjaGl0ZW0gaW1nIHtcbiAgd2lkdGg6IDIycHg7XG59XG4uY291bnRyeWFuZGNyaW5mbyAuZWFjaGl0ZW06bGFzdC1jaGlsZCB7XG4gIHBhZGRpbmctcmlnaHQ6IDA7XG59XG5cbi5zZWFyY2hpdGVtYmVsb3cge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG4gIGhlaWdodDogNTBweDtcbn1cbi5zZWFyY2hpdGVtYmVsb3cgaW5wdXQge1xuICBoZWlnaHQ6IDEwMCU7XG4gIHdpZHRoOiAxMDAlO1xuICBib3JkZXI6IG5vbmU7XG59XG5cbi5QYXltZW50Y29udGFjdGhlYWQgcCB7XG4gIGNvbG9yOiByZWQ7XG4gIG1hcmdpbjogMHB4O1xufVxuXG4uc2V0Y291bnRyeWZsYWcge1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnNldGNvdW50cnlmbGFnIC5jb2RlIHtcbiAgd2lkdGg6IDYwcHg7XG59XG4uc2V0Y291bnRyeWZsYWcgLm51bWJlciB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxMjBweCk7XG59XG4uc2V0Y291bnRyeWZsYWcgLmV4dCB7XG4gIHdpZHRoOiA2MHB4O1xufVxuLnNldGNvdW50cnlmbGFnIC5mYXhudW1iZXIge1xuICB3aWR0aDogY2FsYygxMDAlIC0gNjBweCk7XG59XG5cbi5mbGFnaW1hZ2UgaW1nIHtcbiAgbWF4LXdpZHRoOiAyNHB4O1xuICBtYXJnaW4tdG9wOiAtNXB4O1xufVxuXG46Om5nLWRlZXAuY291bnRyeW5hbWVzZWxlY3Qge1xuICBoZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcbiAgbGluZS1oZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcbn1cbjo6bmctZGVlcC5jb3VudHJ5bmFtZXNlbGVjdCAubWF0LW9wdGlvbi10ZXh0IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbjo6bmctZGVlcC5jb3VudHJ5bmFtZXNlbGVjdCAubWF0LW9wdGlvbi10ZXh0IGltZyB7XG4gIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG4gIG1heC13aWR0aDogMzRweDtcbiAgaGVpZ2h0OiBhdXRvO1xufVxuXG4ubWFwd2lkdGggaW1nIHtcbiAgd2lkdGg6IDEwMCU7XG59XG5cbi5wcm9maWxlbGlua2JveHNoYWRvdyB7XG4gIGJveC1zaGFkb3c6IDAgMCA1cHggI2RkZDtcbiAgd2lkdGg6IDEwMCU7XG4gIHBhZGRpbmctbGVmdDogN3B4O1xuICBwYWRkaW5nLXJpZ2h0OiA3cHg7XG59XG5cbi5ib3JkZXJmbGV4IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBtaW4taGVpZ2h0OiA0NXB4O1xuICBwYWRkaW5nLXRvcDogNXB4O1xufVxuXG4ucGRmdmlldyB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG5cbi5TZWFyY2ggcCB7XG4gIGNvbG9yOiAjYTlhOWE5O1xufVxuXG4uU2VhcmNoY29sb3Ige1xuICBjb2xvcjogI2E5YTlhOTtcbn1cblxuLmNlcnRpZmljYXRlYm9yZGVyIHtcbiAgYm9yZGVyOiAxcHggZGFzaGVkICNiM2IzYjMgIWltcG9ydGFudDtcbiAgd2lkdGg6IDEwMCU7XG4gIGhlaWdodDogNjBweDtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kOiAjZjNmNGY2O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5jZXJ0aWZpY2F0ZWJvcmRlciAuZmlsZWhlcmVjb2xvciB7XG4gIGNvbG9yOiAjMzMzMzMzO1xufVxuLmNlcnRpZmljYXRlYm9yZGVyIC5hZGRmaWxlY29sb3Ige1xuICBjb2xvcjogIzAwNmNiNztcbn1cbi5jZXJ0aWZpY2F0ZWJvcmRlciAudXBsb2FkcGRmIHtcbiAgY29sb3I6ICM5ODk4OTg7XG59XG4uY2VydGlmaWNhdGVib3JkZXIgLnVwbG9hZHBkZiBwIHtcbiAgY29sb3I6ICM5ODk4OTg7XG59XG5cbi5wZGZiYWNrZ3JvdW5kIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkZjNmZjtcbn1cblxuLnVwbG9hZHBob3RvIHtcbiAgcGFkZGluZzogNXB4O1xuICBib3JkZXI6IDFweCBkYXNoZWQgIzk5OTtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBoZWlnaHQ6IDE1MHB4O1xuICB3aWR0aDogMTUwcHg7XG59XG4udXBsb2FkcGhvdG8gLm91dGVybGF5ZXIge1xuICBiYWNrZ3JvdW5kOiAjZThlYmYwO1xuICBoZWlnaHQ6IDEwMCU7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLnVwbG9hZHBob3RvIC5vdXRlcmxheWVyIHAge1xuICBtYXJnaW46IDA7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBwYWRkaW5nLXRvcDogMTBweDtcbn1cblxuLm1hcmtldGluZ2hlaWdodCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGhlaWdodDogMTk1cHg7XG59XG4ubWFya2V0aW5naGVpZ2h0IHAge1xuICBtYXJnaW46IDBweDtcbiAgbWFyZ2luLXRvcDogMzhweDtcbn1cblxuLnRleHRjb2xvciB7XG4gIGNvbG9yOiAjMDA2Y2I3ICFpbXBvcnRhbnQ7XG59XG5cbi5kZWxldGVmbGV4ZW5kIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cblxuLmJvcmRlciB7XG4gIGJvcmRlcjogbm9uZSAhaW1wb3J0YW50O1xuICB3aWR0aDogOTYlICFpbXBvcnRhbnQ7XG59XG5cbi5mbGV4b21hbiB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG5cbi5mbGV4c2VyYWNoIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cblxuLmljb25zdHlsZSB7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIGNvbG9yOiAjMDA2Y2I3O1xufVxuXG4uc2VhcmNoaW5tdWx0aXNlbGVjdCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIHBhZGRpbmc6IDE1cHggMTVweDtcbiAgYmFja2dyb3VuZDogI2U5ZWRmMDtcbn1cblxuLnNlYXJjaHNlbGVjdCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWxlZnQ6IDEwcHg7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSB7XG4gICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAudGl0bGV0ZXh0IHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsb3NlYW5kYWRkIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLmlubm5lcnBhcnRvZmRyd2VyIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDIwcHggIWltcG9ydGFudDtcbiAgICBwYWRkaW5nLXJpZ2h0OiAyMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICBodG1sIGJvZHkgLnAtci0yMCB7XG4gICAgcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbjo6bmctZGVlcC5zaWRlbmF2bWFpbnJvdyAuaW5ubmVycGFydG9mZHJ3ZXIge1xuICBwYWRkaW5nLXRvcDogMjVweDtcbiAgcGFkZGluZy1sZWZ0OiA3NXB4O1xuICBwYWRkaW5nLXJpZ2h0OiA3NXB4O1xuICBwYWRkaW5nLWJvdHRvbTogNzBweCAhaW1wb3J0YW50O1xuICBtYXgtaGVpZ2h0OiBjYWxjKDEwMHZoIC0gMTQwcHgpICFpbXBvcnRhbnQ7XG4gIG92ZXJmbG93LXg6IGhpZGRlbjtcbiAgb3ZlcmZsb3cteTogYXV0bztcbiAgaGVpZ2h0OiAxMDAlO1xufVxuXG4uZGVzY3JpcHRpb25jb250ZW50bWFya2V0cHJlc2VuY2Uuc2hvdyB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4uZGVzY3JpcHRpb25jb250ZW50bWFya2V0cHJlc2VuY2UuaGlkZSB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cblxuc3VwIHtcbiAgY29sb3I6IHJlZDtcbn1cblxuLnByZUZsYWcge1xuICB3aWR0aDogY2FsYygxMDAlIC0gNjBweCkgIWltcG9ydGFudDtcbn1cblxuLmJvcmRlcmJvdHRvbSB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cblxuLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBwYWRkaW5nOiA2cHggMTBweDtcbiAgYmFja2dyb3VuZDogI2U5ZWRmMDtcbn1cbi5zZWFyY2hpbm11bHRpc2VsZWN0IGlucHV0Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVyIHtcbiAgY29sb3I6ICM3ZjhmYTMgIWltcG9ydGFudDtcbn1cbi5zZWFyY2hpbm11bHRpc2VsZWN0IGkge1xuICBjb2xvcjogIzdmOGZhMyAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXJpZ2h0OiA2cHg7XG59XG4uc2VhcmNoaW5tdWx0aXNlbGVjdCAuc2VhcmNoc2VsZWN0IHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDI1cHgpICFpbXBvcnRhbnQ7XG59XG4uc2VhcmNoaW5tdWx0aXNlbGVjdCAucmVzZXRpY29uIHtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuXG4ub3B0aW9uLWxpc3Rpbmcge1xuICBvdmVyZmxvdy14OiBhdXRvO1xuICBvdmVyZmxvdy15OiBhdXRvO1xuICBtYXgtaGVpZ2h0OiAyOTBweDtcbn1cblxuLmNvdW50cnluYW1lc2VsZWN0IHtcbiAgbGluZS1oZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA0MHB4ICFpbXBvcnRhbnQ7XG59XG4uY291bnRyeW5hbWVzZWxlY3QgaW1nIHtcbiAgd2lkdGg6IDI0cHg7XG4gIGhlaWdodDogYXV0bztcbiAgbWFyZ2luLXJpZ2h0OiA1cHg7XG59XG5cbjo6bmctZGVlcC5zZWxlY3Rfd2l0aF9zZWFyY2gge1xuICBvdmVyZmxvdzogaGlkZGVuICFpbXBvcnRhbnQ7XG4gIG1heC1oZWlnaHQ6IDEwMCUgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogNDBweCAhaW1wb3J0YW50O1xuICBtYXJnaW4tYm90dG9tOiAxNXB4ICFpbXBvcnRhbnQ7XG59XG5cbjpob3N0OjpuZy1kZWVwLm1hdC10b29sdGlwIHtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbn1cblxuOmhvc3Q6Om5nLWRlZXAuc2FtZWFzYWRkcmVzcyAubWF0LWNoZWNrYm94LWxhYmVsIHtcbiAgY29sb3I6ICNmNDdmMWY7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuXG46Om5nLWRlZXAjZGF0YV9kZXNpZ24gLnNpZGVuYXZtYWlucm93IC5pbm5uZXJwYXJ0b2ZkcndlciB7XG4gIHBhZGRpbmc6IDAgIWltcG9ydGFudDtcbiAgb3ZlcmZsb3c6IGluaXRpYWw7XG4gIG1heC1oZWlnaHQ6IDEwMCUgIWltcG9ydGFudDtcbn1cbjo6bmctZGVlcCNkYXRhX2Rlc2lnbiAuc2lkZW5hdm1haW5yb3cgLmlubm5lcnBhcnRvZmRyd2VyIC5vcmdhbmlzYXRpb25pbmZvIHtcbiAgcGFkZGluZy10b3A6IDAgIWltcG9ydGFudDtcbn1cbjo6bmctZGVlcCNkYXRhX2Rlc2lnbiAuc2lkZW5hdm1haW5yb3cgLmlubm5lcnBhcnRvZmRyd2VyIC5vcmdhbmlzYXRpb25pbmZvIC5kYXRhX3dpZHRoIHtcbiAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG59XG5cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiBzb2xpZCAxcHggI2ZmZjtcbiAgbWFyZ2luOiAwICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZCAhaW1wb3J0YW50O1xufVxuLm1hdC1jYXJkLnNlbGVjdGVkYnNmdWxsIC5tYXQtY2FyZC1oZWFkZXIge1xuICBkaXNwbGF5OiBmbGV4O1xuICBwYWRkaW5nOiAxNXB4ICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMDAlO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG59XG4ubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGwgLm1hdC1jYXJkLWhlYWRlciAuc2JzaW1nIHtcbiAgd2lkdGg6IDclO1xufVxuLm1hdC1jYXJkLnNlbGVjdGVkYnNmdWxsIC5tYXQtY2FyZC1oZWFkZXIgLnNic2ltZyAuaW1nYmcge1xuICB3aWR0aDogNDhweDtcbiAgaGVpZ2h0OiA2NHB4O1xuICBiYWNrZ3JvdW5kOiAjMDA2Y2I3O1xuICBjb2xvcjogI2ZmZjtcbiAgZm9udC1zaXplOiAyOHB4O1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIGxpbmUtaGVpZ2h0OiA2NHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbCAubWF0LWNhcmQtaGVhZGVyIC5zYnNkZXRhaWxzIHtcbiAgd2lkdGg6IDkwJTtcbn1cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbCAubWF0LWNhcmQtaGVhZGVyIC5zYnNkZXRhaWxzIC5zZWxlY3R0aXRsZSB7XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvYm9sZFwiO1xuICBjb2xvcjogIzMzMztcbn1cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbCAubWF0LWNhcmQtaGVhZGVyIC5zYnNkZXRhaWxzIC5zZWxlY3RzdWJ0aXRsZSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHdpZHRoOiAxMDAlO1xuICBmbGV4LWRpcmVjdGlvbjogcm93O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGxpbmUtaGVpZ2h0OiAxN3B4O1xuICBmbGV4LXdyYXA6IHdyYXA7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgLm1hdC1jYXJkLnNlbGVjdGVkYnNmdWxsIC5tYXQtY2FyZC1oZWFkZXIgLnNic2RldGFpbHMgLnNlbGVjdHN1YnRpdGxlIHtcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICB9XG59XG4ubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGwgLm1hdC1jYXJkLWhlYWRlciAuc2JzZGV0YWlscyAuc2VsZWN0c3VidGl0bGUgcCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHdpZHRoOiAxMDAlO1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICBjb2xvcjogIzIyMjtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBtYXJnaW46IDA7XG59XG4ubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGwgLm1hdC1jYXJkLWhlYWRlciAuc2JzZGV0YWlscyAuc2VsZWN0c3VidGl0bGUgcC5jb3VudHJ5IHtcbiAgd2lkdGg6IDMzLjMzJTtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGwgLm1hdC1jYXJkLWhlYWRlciAuc2JzZGV0YWlscyAuc2VsZWN0c3VidGl0bGUgcC5jb3VudHJ5IHtcbiAgICB3aWR0aDogMTAwJTtcbiAgfVxufVxuLm1hdC1jYXJkLnNlbGVjdGVkYnNmdWxsIC5tYXQtY2FyZC1oZWFkZXIgLnNic2RldGFpbHMgLnNlbGVjdHN1YnRpdGxlIHAuY291bnRyeSBpbWcge1xuICB3aWR0aDogMjJweDtcbiAgbWFyZ2luOiAwO1xuICBoZWlnaHQ6IGF1dG87XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgdG9wOiAycHg7XG59XG4ubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGwgLm1hdC1jYXJkLWhlYWRlciAuc2JzZGV0YWlscyAuc2VsZWN0c3VidGl0bGUgcC5hZGRyZXNzIHtcbiAgd2lkdGg6IDEwMCU7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIG1hcmdpbjogMTBweCAwIDAgMDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGwgLm1hdC1jYXJkLWhlYWRlciAuc2JzZGV0YWlscyAuc2VsZWN0c3VidGl0bGUgcC5hZGRyZXNzIHtcbiAgICB3aWR0aDogMTAwJTtcbiAgfVxufVxuLm1hdC1jYXJkLnNlbGVjdGVkYnNmdWxsIC5tYXQtY2FyZC1oZWFkZXIgLnNic2RldGFpbHMgLnNlbGVjdHN1YnRpdGxlIHAgc3Bhbi5jYm94LWxhYmVsIHtcbiAgZm9udC1zaXplOiAxMnB4O1xuICBjb2xvcjogIzk5OTtcbn1cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbCAubWF0LWNhcmQtaGVhZGVyIC5kZWxldGVkaXYge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbCAubWF0LWNhcmQtaGVhZGVyIC5kZWxldGVkaXYgLmJnaSB7XG4gIGNvbG9yOiAjZmZmO1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIHdpZHRoOiAzMXB4O1xuICBoZWlnaHQ6IDMxcHg7XG4gIGxpbmUtaGVpZ2h0OiAzMXB4O1xuICBib3JkZXItcmFkaXVzOiAzMXB4O1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4ubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGw6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjNmNWY5ICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogc29saWQgMXB4ICNmM2Y1ZjkgIWltcG9ydGFudDtcbn1cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbDpob3ZlciAubWF0LWNhcmQtaGVhZGVyIC5zYnNkZXRhaWxzIC5zZWxlY3R0aXRsZSB7XG4gIGNvbG9yOiAjMTg3N2JiO1xufVxuLm1hdC1jYXJkLnNlbGVjdGVkYnNmdWxsOmhvdmVyIC5tYXQtY2FyZC1oZWFkZXIgLnNic2RldGFpbHMgLnNlbGVjdHN1YnRpdGxlIHAgc3Bhbi5jYm94LWxhYmVsIHtcbiAgY29sb3I6ICMxODc3YmI7XG59XG4ubWF0LWNhcmQuc2VsZWN0ZWRic2Z1bGw6aG92ZXIgLmRlbGV0ZWRpdiAuYmdpIHtcbiAgY29sb3I6ICMxODc3YmI7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2M1ZGJmZDtcbn1cbi5tYXQtY2FyZC5zZWxlY3RlZGJzZnVsbDpob3ZlciAuZGVsZXRlZGl2IC5iZ2k6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjYzVkYmZkO1xufVxuXG4ucHJvZmlsZWxpbmtib3hzaGFkb3cge1xuICBib3gtc2hhZG93OiBub25lO1xuICB3aWR0aDogMTAwJTtcbiAgcGFkZGluZy1sZWZ0OiA3cHg7XG4gIHBhZGRpbmctcmlnaHQ6IDdweDtcbiAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbn1cbi5wcm9maWxlbGlua2JveHNoYWRvdyAuYm9yZGVyZmxleCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgbWluLWhlaWdodDogNDVweDtcbiAgcGFkZGluZy10b3A6IDVweDtcbn1cbi5wcm9maWxlbGlua2JveHNoYWRvdyAuYm9yZGVyIHtcbiAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiA5NiUgIWltcG9ydGFudDtcbn1cblxuLnRhYnNlY3Rpb24ubXB0YWIgLm1hdC10YWItZ3JvdXAuaGlkZXRhYnN0eWxlIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4udGFic2VjdGlvbi5tcHRhYiAubWF0LXRhYi1ncm91cC5oaWRldGFic3R5bGUgLm1hdC10YWItaGVhZGVyIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cblxuLnRhYnNlY3Rpb24gLm1hdC10YWItbGFiZWwubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xuICBiYWNrZ3JvdW5kOiAjMTg3N2JiO1xuICBjb2xvcjogI2ZmZjtcbn1cbi50YWJzZWN0aW9uIC5tYXQtdGFiLWxhYmVsLm1hdC10YWItbGFiZWwtYWN0aXZlIC50YWJzZWxlY3RoZWFkZXJjb250ZW50IHAsIC50YWJzZWN0aW9uIC5tYXQtdGFiLWxhYmVsLm1hdC10YWItbGFiZWwtYWN0aXZlIC50YWJzZWxlY3RoZWFkZXJjb250ZW50IGg0IHtcbiAgY29sb3I6ICNmZmY7XG59XG5cbi5pbm5uZXJwYXJ0b2Zkcndlci5ub3Njcm9sbCB7XG4gIC8qbWF4LWhlaWdodDp1bnNldCAhaW1wb3J0YW50OyovXG4gIG1pbi1oZWlnaHQ6IHVuc2V0ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xufVxuLmlubm5lcnBhcnRvZmRyd2VyLm5vc2Nyb2xsIC5tYXQtdGFiLWJvZHkge1xuICBvdmVyZmxvdzogdW5zZXQ7XG59XG4uaW5ubmVycGFydG9mZHJ3ZXIubm9zY3JvbGwgLm1hdC10YWItYm9keS5tYXQtdGFiLWJvZHktYWN0aXZlIHtcbiAgb3ZlcmZsb3c6IHVuc2V0O1xufVxuLmlubm5lcnBhcnRvZmRyd2VyLm5vc2Nyb2xsIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IHtcbiAgb3ZlcmZsb3c6IHVuc2V0O1xuICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgcGFkZGluZy10b3A6IDEwcHg7XG59XG5cbi5pbm5uZXJwYXJ0b2ZkcndlciB7XG4gIG1pbi1oZWlnaHQ6IHVuc2V0ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xufVxuLmlubm5lcnBhcnRvZmRyd2VyIC5tYXQtdGFiLWJvZHkge1xuICBvdmVyZmxvdzogdW5zZXQ7XG59XG4uaW5ubmVycGFydG9mZHJ3ZXIgLm1hdC10YWItYm9keS5tYXQtdGFiLWJvZHktYWN0aXZlIHtcbiAgb3ZlcmZsb3c6IHVuc2V0O1xufVxuLmlubm5lcnBhcnRvZmRyd2VyIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IHtcbiAgb3ZlcmZsb3c6IHVuc2V0O1xuICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgcGFkZGluZy10b3A6IDEwcHg7XG59XG5cbi5idXNpc2VhcmNoZGl2IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA2NjBweCkge1xuICAuYnVzaXNlYXJjaGRpdiB7XG4gICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcbiAgfVxufVxuLmJ1c2lzZWFyY2hkaXYgLnNlYXJjaGZpZWxkZGl2IHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDgwcHgpO1xuICBtYXgtd2lkdGg6IDEwMCU7XG59XG4uYnVzaXNlYXJjaGRpdiAuc2VhcmNoZmllbGRkaXYuc2hvdyB7XG4gIHZpc2liaWxpdHk6IHZpc2libGU7XG59XG4uYnVzaXNlYXJjaGRpdiAuc2VhcmNoZmllbGRkaXYuaGlkZSB7XG4gIHZpc2liaWxpdHk6IGhpZGRlbiAhaW1wb3J0YW50O1xufVxuLmJ1c2lzZWFyY2hkaXYgLnNlYXJjaGZpZWxkZGl2IC5tYXQtaW5wdXQtZWxlbWVudCB7XG4gIGhlaWdodDogMjhweCAhaW1wb3J0YW50O1xufVxuLmJ1c2lzZWFyY2hkaXYgLnNlYXJjaGZpZWxkZGl2IC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIHBhZGRpbmc6IDAgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiAzMnB4ICFpbXBvcnRhbnQ7XG4gIGJvcmRlci10b3Atd2lkdGg6IDVweDtcbn1cbi5idXNpc2VhcmNoZGl2IC5zZWFyY2hmaWVsZGRpdiBidXR0b24ge1xuICBoZWlnaHQ6IDMwcHggIWltcG9ydGFudDtcbn1cbi5idXNpc2VhcmNoZGl2IGJ1dHRvbiB7XG4gIGhlaWdodDogMzhweDtcbn1cbi5idXNpc2VhcmNoZGl2IGJ1dHRvbiAuYmdpLWFkZCB7XG4gIGZvbnQtc2l6ZTogMTBweDtcbiAgbWFyZ2luLXJpZ2h0OiA1cHg7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgdG9wOiAtM3B4O1xufVxuLmJ1c2lzZWFyY2hkaXYgYnV0dG9uLnNlYXJjaGJ0biB7XG4gIGJhY2tncm91bmQ6IHRyYW5zcGFyZW50O1xuICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDEuMTg3NXJlbTtcbiAgbGluZS1oZWlnaHQ6IDEycHg7XG4gIHdpZHRoOiA0MnB4ICFpbXBvcnRhbnQ7XG4gIG1pbi13aWR0aDogNDJweCAhaW1wb3J0YW50O1xuICBtYXgtd2lkdGg6IDQycHggIWltcG9ydGFudDtcbiAgcGFkZGluZzogMCAhaW1wb3J0YW50O1xufVxuLmJ1c2lzZWFyY2hkaXYgLmJzc2VhcmNoYm94IHtcbiAgd2lkdGg6IDEwMCU7XG4gIG1hcmdpbi1yaWdodDogMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xuICBkaXNwbGF5OiBmbGV4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDY2MHB4KSB7XG4gIC5idXNpc2VhcmNoZGl2IC5ic3NlYXJjaGJveCB7XG4gICAgd2lkdGg6IDEwMCU7XG4gICAgbWFyZ2luLXJpZ2h0OiAwcHg7XG4gICAgbWFyZ2luLWJvdHRvbTogNXB4O1xuICB9XG59XG4uYnVzaXNlYXJjaGRpdiAuYnNzZWFyY2hib3ggLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4uYnVzaXNlYXJjaGRpdiAuYnNzZWFyY2hib3ggLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMHB4O1xufVxuLmJ1c2lzZWFyY2hkaXYgLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1sYWJlbCwgLmJ1c2lzZWFyY2hkaXYgLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBkaXNwbGF5OiBub25lO1xufVxuLmJ1c2lzZWFyY2hkaXYgLm1hdC1mb3JtLWZpZWxkLWxhYmVsLXdyYXBwZXIge1xuICBsaW5lLWhlaWdodDogMTRweDtcbn1cblxuLnRhYmZvcmNsaWVudGVsZW5ldyAudGFic2VsZWN0aGVhZGVyY29udGVudCAuc2VsZWN0aW9udGV4dCB7XG4gIG1pbi1oZWlnaHQ6IDUwcHg7XG4gIGhlaWdodDogYXV0bztcbiAgYWxpZ24tY29udGVudDogZmxleC1zdGFydDtcbiAgZGlzcGxheTogZmxleDtcbiAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.ts":
  /*!*************************************************************************************************!*\
    !*** ./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.ts ***!
    \*************************************************************************************************/

  /*! exports provided: MY_FORMATS, AddcontactComponent */

  /***/
  function srcAppModulesProfilemanagementContactinformationAddcontactAddcontactComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "MY_FORMATS", function () {
      return MY_FORMATS;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AddcontactComponent", function () {
      return AddcontactComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/@shared/filee/filee */
    "./src/app/@shared/filee/filee.ts");
    /* harmony import */


    var _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @app/common/city/service/city.service */
    "./src/app/common/city/service/city.service.ts");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_classes_driveInput__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/common/classes/driveInput */
    "./src/app/common/classes/driveInput.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/common/state/service/state.service */
    "./src/app/common/state/service/state.service.ts");
    /* harmony import */


    var _env_common_veriables__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @env/common_veriables */
    "./src/environments/common_veriables.ts");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! moment */
    "./node_modules/moment/moment.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_12__);
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_13__);
    /* harmony import */


    var _profilemanagement_animation__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! ../../../profilemanagement/animation */
    "./src/app/modules/profilemanagement/animation.ts");
    /* harmony import */


    var _profile_service__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! ../../profile.service */
    "./src/app/modules/profilemanagement/profile.service.ts");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");

    var moment = moment__WEBPACK_IMPORTED_MODULE_12___default.a || moment__WEBPACK_IMPORTED_MODULE_12__;
    var MY_FORMATS = {
      parse: {
        dateInput: 'DD-MM-YYYY'
      },
      display: {
        dateInput: 'DD-MM-YYYY',
        monthYearLabel: 'MMM YYYY',
        dateA11yLabel: 'LL',
        monthYearA11yLabel: 'MMMM YYYY'
      }
    };

    var AddcontactComponent = /*#__PURE__*/function () {
      /*Sar Ens*/
      function AddcontactComponent(formBuilder, profileService, localStorage, stateService, cityService, cdr, security, routeid, toastr) {
        _classCallCheck(this, AddcontactComponent);

        this.formBuilder = formBuilder;
        this.profileService = profileService;
        this.localStorage = localStorage;
        this.stateService = stateService;
        this.cityService = cityService;
        this.cdr = cdr;
        this.security = security;
        this.routeid = routeid;
        this.toastr = toastr;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_18__["ErrorStateMatcher"]();
        this.animationState = 'out';
        this.animationState2 = 'out';
        this.showBusinessScope = false;
        this.sidePanelToggle = true;
        this.showLogo = false;
        this.hidePropertyType = false;
        this.hideCrn = false;
        this.hideBranchid = false;
        this.showDescription = false;
        this.showNationality = false;
        this.showOtherMarketPresence = false;
        this.countrylist = [];
        this.marketpresencelist = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.selectedPanel = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.emailwebsite = false;
        this.portNamehide = false;
        this.hideComponentHeader = false;
        this.fromFactoryInfo = false;
        this.fromLogistic = false;
        this.noLeaseDoc = false;
        this.hideFax = false;
        this.hideLocationlist = false;
        this.validation = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.countrylisttemp = [];
        this.encryptedcompanypk = '';
        this.statelist = [];
        this.citylist = [];
        this.buttonname = 'Add';
        this.editMode = false;
        this.maxDate = new Date();
        this.minDate = new Date();
        this.mapMarkerLocation = '';
        this.enabled = true;
        this.disableSubmitButton = false;
        this.countrydisabled = false;
        this.showPostalAddress = false;
        this.infotoggle = false;
        this.sideNavSubHeaderNameText = 'Delivery';
        this.transporttypes = [{
          tvalue: '3',
          tlabel: 'Airways'
        }, {
          tvalue: '1',
          tlabel: 'Railways'
        }, {
          tvalue: '2',
          tlabel: 'Roadways'
        }, {
          tvalue: '4',
          tlabel: 'Waterways'
        }];
        this.deliverytypes = [{
          tvalue: '1',
          tlabel: 'Branch'
        }, {
          tvalue: '2',
          tlabel: 'Warehouse'
        }, {
          tvalue: '3',
          tlabel: 'Other'
        }];
        this.locationlists = [];
        this.showmapbutton = true;
        /*Sar Starts*/

        this.stkholdertype = 0;
        this.selectedAddress = [];
        this.selected_location_id = null;
        this.showtoolicon = true;
      }

      _createClass(AddcontactComponent, [{
        key: "sideNavSubHeaderName",
        get: function get() {
          return this.sideNavSubHeaderNameText;
        },
        set: function set(value) {
          this.sideNavSubHeaderNameText = value;
        }
      }, {
        key: "despchange",
        value: function despchange() {
          this.infotoggle = !this.infotoggle;
        }
      }, {
        key: "getlocationlist",
        value: function getlocationlist() {
          var _this9 = this;

          this.profileService.getcmsmatketpresencelist(16).subscribe(function (data) {
            if (data) {
              _this9.locationlists_backup = _this9.locationlists = data.data.items.data;
            }
          });
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this10 = this;

          this.getlocationlist();
          this.stkholdertype = this.localStorage.getInLocal('reg_type');
          this.country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
          this.country_code_flag_fax = Number(this.localStorage.getInLocal('countryPk'));
          this.phonecode = this.localStorage.getInLocal('country_dialcode');
          this.phonecodefax = this.localStorage.getInLocal('country_dialcode');

          if (_env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanPk != undefined) {
            this.defaultNationality = this.country_code_flag == _env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanPk ? '1' : '2';
            this.defaultCountryPk = _env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanPk;
          }

          this.lypisID = this.localStorage.getInLocal('lypis_id');
          this.locationType = this.locationType ? this.locationType : 0;
          this.namePlaceholder = this.namePlaceholder ? this.namePlaceholder : "Organisation Name";
          this.descPlaceholder = this.descPlaceholder ? this.descPlaceholder : "";
          this.addressPlaceholder = this.addressPlaceholder ? this.addressPlaceholder : "Organisation Address";
          this.companypk = this.localStorage.getInLocal('comp_pk');
          this.encryptedcompanypk = this.security.encrypt(this.companypk);
          this.initializeFormGroup();

          if (this.locationType == 1) {
            this.formGroup.controls['name'].disable();
          }

          this.formGroup.controls['country'].valueChanges.subscribe(function (value) {
            if (value) {
              _this10.getStateList(value);
            }
          });
          this.formGroup.controls['state'].valueChanges.subscribe(function (value) {
            if (value) {
              _this10.getCityList(value);
            }
          });
          this.formGroup.controls['primeheadofz'].valueChanges.subscribe(function (checked) {
            if (checked && _this10.isHeadOfficeGiven) {
              sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
                title: "Do you want to delete the existing Head Office?",
                icon: 'warning',
                buttons: ["No", "Yes"],
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false
              }).then(function (willDelete) {
                if (!willDelete) {
                  _this10.formGroup.controls['primeheadofz'].setValue(false);
                }
              });
            }
          });
          this.drv_leasedoc = {
            fileMstPk: 19,
            selectedFilesPk: []
          };
          this.drv_repcomplogo = {
            fileMstPk: 20,
            selectedFilesPk: []
          };
          this.formGroup.valueChanges.map(function (value) {
            var dataVal = {
              type: _this10.locationType,
              value: _this10.formGroup.valid
            };

            _this10.validation.emit(dataVal);
          }).subscribe(function (value) {});
        }
      }, {
        key: "setshowmap",
        value: function setshowmap(val) {
          if (val.index == 0) {
            this.showmapbutton = true;
          } else {
            this.showmapbutton = false;
          }
        }
      }, {
        key: "mapselectedlocation",
        value: function mapselectedlocation() {
          var _this11 = this;

          this.profileService.getlocationdetail(this.selected_location_id).subscribe(function (data) {
            var dataToSend = {
              data: data['data'].items,
              isDelete: false,
              last_added_mp_pk: _this11.selected_location_id
            };

            if (_this11.sidePanelToggle == true) {
              _this11.drawer.toggle();
            }

            _this11.marketpresencelist.emit(dataToSend);
          });
        }
      }, {
        key: "setlocationid",
        value: function setlocationid(id) {
          this.selected_location_id = id;
          this.tab.selectedIndex = 0;
        }
      }, {
        key: "filteroutlocation",
        value: function filteroutlocation(searchword, type) {
          if (searchword != '') {
            var searchword_lowercase = searchword.toLowerCase().trim();

            if (type == 1) {
              if (searchword_lowercase.length >= 3) {
                this.locationlists = this.locationlists.filter(function (x) {
                  return x.country.toLowerCase().includes(searchword_lowercase) || x.mcmpld_landlineno.toLowerCase().includes(searchword_lowercase) || x.mcmpld_address.toLowerCase().includes(searchword_lowercase) || x.mcmpld_emailid.toLowerCase().includes(searchword_lowercase);
                });
              }
            }
          } else {
            this.locationlists = this.locationlists_backup;
          }
        }
      }, {
        key: "initializeFormGroup",
        value: function initializeFormGroup() {
          this.formGroup = this.formBuilder.group({
            location_pk: ["", ""],
            companypk: [this.companypk, ""],
            name: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            type: [this.locationType, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            otherloc: ["", ""],
            nationality: [this.defaultNationality, ""],
            crn: ["", ""],
            description: ["", ""],
            business_scope: ["", ""],
            branchid: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            address: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            latitude: ["", ""],
            longitude: ["", ""],
            country: [Number(this.localStorage.getInLocal('countryPk')), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            state: [null, ''],
            city: [null, ''],
            postaladdress: [null, ''],
            postalcountry: [null, ''],
            postalstate: [null, ''],
            postalcity: [null, ''],
            postalAddressAvailable: [false, ''],
            landline_cc: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            landline_no: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            landline_ext: ["", ""],
            faxnocc: ["", ""],
            faxno: ["", ""],
            emailid: ["", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
            website: ["", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/^((https?|ftp|smtp):\/\/)?(www.)?[a-z0-9]+(\.[a-z]{2,}){1,3}(#?\/?[a-zA-Z0-9#]+)*\/?(\?[a-zA-Z0-9-_]+=[a-zA-Z0-9-%]+&?)?$/)]],
            repcomplogo: ['', ''],
            property_type: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            issued_on: ['', ''],
            expired_on: ['', ''],
            leasedoc: ['', ''],
            selected_address: ['', ''],
            selected_latitude: ['', ''],
            selected_longitude: ['', ''],
            transporttype: ['', ''],
            deliveryLocationType: [null, ''],
            primeheadofz: [null, ''],
            headofficeid: [null, '']
          });
          this.getStateList(this.localStorage.getInLocal('countryPk'));

          if (this.locationType == 1) {
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
          } else if (this.locationType == 2) {
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
          } else if (this.locationType == 3) {
            this.form.business_scope.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.description.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.business_scope.updateValueAndValidity();
            this.form.description.updateValueAndValidity();
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
            this.form.repcomplogo.setValidators([_app_common_classes_driveInput__WEBPACK_IMPORTED_MODULE_8__["ValidateDrive"]]);
            this.form.repcomplogo.updateValueAndValidity();
          } else if (this.locationType == 5 || this.locationType == 6 || this.locationType == 11) {
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
          } else if (this.locationType == 7) {
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
          } else if (this.locationType == 8) {
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
          } else if (this.locationType == 12) {
            this.form.otherloc.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.otherloc.updateValueAndValidity();
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
          } else if (this.locationType == 13) {
            this.form.otherloc.setValidators(null);
            this.form.otherloc.updateValueAndValidity();
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
            this.form.transporttype.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.transporttype.updateValueAndValidity();
            this.form.emailid.setValidators(null);
            this.form.emailid.updateValueAndValidity();
            this.form.website.setValidators(null);
            this.form.website.updateValueAndValidity();
            this.form.landline_cc.setValidators(null);
            this.form.landline_cc.updateValueAndValidity();
            this.form.landline_no.setValidators(null);
            this.form.landline_no.updateValueAndValidity();
            this.form.deliveryLocationType.setValidators(null);
            this.form.deliveryLocationType.updateValueAndValidity();
          } else if (this.locationType == 16) {
            this.form.otherloc.setValidators(null);
            this.form.otherloc.updateValueAndValidity();
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.name.setValidators(null);
            this.form.name.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
            this.form.transporttype.setValidators(null);
            this.form.transporttype.updateValueAndValidity();
            this.form.deliveryLocationType.setValidators(null);
            this.form.deliveryLocationType.updateValueAndValidity();
            this.form.emailid.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]);
            this.form.emailid.updateValueAndValidity();
            this.form.website.setValidators(null);
            this.form.website.updateValueAndValidity();
            this.form.landline_cc.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.landline_cc.updateValueAndValidity();
            this.form.landline_no.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.landline_no.updateValueAndValidity();
          } else if (this.locationType == 4) {
            this.form.otherloc.setValidators(null);
            this.form.otherloc.updateValueAndValidity();
            this.form.crn.setValidators(null);
            this.form.crn.updateValueAndValidity();
            this.form.branchid.setValidators(null);
            this.form.branchid.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
            this.form.name.setValidators(null);
            this.form.name.updateValueAndValidity();
            this.form.emailid.setValidators(null);
            this.form.emailid.updateValueAndValidity();
            this.form.website.setValidators(null);
            this.form.website.updateValueAndValidity();
          } else if (this.locationType == 17) {
            this.form.nationality.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.nationality.updateValueAndValidity();
            this.form.property_type.setValidators(null);
            this.form.property_type.updateValueAndValidity();
          }

          if (this.stkholdertype == 6 && this.locationType == 2) {
            this.form.crn.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.crn.updateValueAndValidity();
          }
        }
      }, {
        key: "patchForm",
        value: function patchForm(data) {
          var _this12 = this;

          this.formGroup.patchValue({
            location_pk: data.memcompmplocationdtls_pk,
            companypk: data.mcmpld_membercompmst_fk,
            name: data.mcmpld_officename,
            type: data.mcmpld_locationtype,
            otherloc: data.mcmpld_otherloc,
            nationality: data.mcmpld_nationality,
            crn: data.mcmpld_crregno,
            description: data.mcmpld_description,
            business_scope: data.mcmpld_businscope,
            branchid: data.mcmpld_branchid,
            address: data.mcmpld_address,
            latitude: data.mcmpld_latitude,
            longitude: data.mcmpld_longitude,
            country: Number(data.mcmpld_countrymst_fk),
            state: Number(data.mcmpld_statemst_fk),
            city: Number(data.mcmpld_citymst_fk),
            postalAddressAvailable: data.mcmpld_ispostaladdr == 2 ? true : false,
            postaladdress: data.mcmpld_postaladdress,
            postalcountry: Number(data.mcmpld_postalcountrymst_fk),
            postalstate: Number(data.mcmpld_postalstatemst_fk),
            postalcity: Number(data.mcmpld_postalcitymst_fk),
            landline_cc: data.dialocode_country_code,
            landline_no: data.mcmpld_landlineno,
            landline_ext: data.mcmpld_landlineext,
            faxnocc: data.mcmpld_faxnocc,
            faxno: data.mcmpld_faxno,
            emailid: data.mcmpld_emailid,
            website: data.mcmpld_website,
            recomplogo: Array(data.mcmpld_complogo),
            leasedoc: data.mcmpld_leasedoc != null ? Array(data.mcmpld_leasedoc) : null,
            property_type: data.mcmpld_leasetype,
            issued_on: data.mcmpld_leasestartdt != null ? data.mcmpld_leasestartdt : '',
            expired_on: data.mcmpld_leaseenddt != null ? data.mcmpld_leaseenddt : '',
            transporttype: String(data.mcmpld_modeoftrans),
            deliveryLocationType: data.deliveryType
          });
          this.formGroup.controls['primeheadofz'].setValue(data.mcmpld_isprimheadofc == 1 ? true : false, {
            emitEvent: false
          });
          this.formGroup.controls['headofficeid'].setValue(data.mcmpld_isprimheadofc == 2 ? this.headOfficeId : '', {
            emitEvent: false
          });
          this.changeLabelName(String(data.mcmpld_modeoftrans));
          this.map_data_onload = this.formGroup.value;

          if (data.mcmpld_ispostaladdr == 2) {
            this.form.postaladdress.setValue(this.form.address.value);
            this.form.postalcountry.setValue(this.form.country.value);
            this.form.postalstate.setValue(this.form.state.value);
            this.form.postalcity.setValue(this.form.city.value);
          }

          if (this.fromLogistic) {
            this.routeid.queryParams.subscribe(function (params) {
              if (params['fct']) {
                _this12.fctpk = params['fct'];
              }
            });
          }

          this.country_code_flag = Number(data.landlinecc);
          this.country_code_flag_fax = Number(data.landline_cc);
          this.country_code_flag = Number(data.dialcode_country_pk);
          this.phonecode = data.dialocode_country_code;
          this.setfaxcountryFlag(Number(data.mcmpld_countrymst_fk));
          this.mapMarkerLocation = data.mcmpld_address;

          if (this.locationType == 3) {
            this.drv_repcomplogo.selectedFilesPk = Array(data.mcmpld_complogo);
            setTimeout(function () {
              if (_this12.compLogoFilee) {
                _this12.compLogoFilee.triggerChange();
              }

              _this12.previousFormValue = _this12.formDirective.value;
            }, 1000);
          }

          this.drv_leasedoc.selectedFilesPk = Array(data.mcmpld_leasedoc);

          if (!this.fromFactoryInfo) {
            setTimeout(function () {
              if (_this12.leaseDocFilee) _this12.leaseDocFilee.triggerChange();
            }, 1000);
          }

          this.cdr.detectChanges();
          this.selected_ownertype = data.mcmpld_leasetype;

          if (this.fromFactoryInfo) {
            this.hideShowDateField('');
          }

          this.previousFormValue = this.formDirective.value;
        }
      }, {
        key: "changeLabelName",
        value: function changeLabelName(value) {
          if (value == 1) {
            this.namePlaceholder = 'Train Station';
          } else if (value == 2) {
            this.namePlaceholder = 'Warehouse';
          } else if (value == 3) {
            this.namePlaceholder = 'Airport';
          } else if (value == 4) {
            this.namePlaceholder = 'Port';
          }
        }
      }, {
        key: "save",
        value: function save(formDirective) {
          var _this13 = this;

          if (this.formGroup.valid) {
            this.transmode = this.formGroup.controls['transporttype'].value;
            this.deliveryType = this.formGroup.controls['deliveryLocationType'].value;
            this.disableSubmitButton = true;
            this.profileService.saveMarketPresence(this.formGroup.getRawValue()).subscribe(function (data) {
              if (data['data'].status == 1) {
                _this13.last_added_mp_pk = data['data'].added_marketpresence_pk;
                _this13.disableSubmitButton = false;

                if (!_this13.fromFactoryInfo) {
                  sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
                    title: _this13.popupContentPrefix ? _this13.popupContentPrefix + data['data'].data : data['data'].data.trim(),
                    icon: 'success',
                    closeOnClickOutside: false,
                    closeOnEsc: false
                  });

                  if (_this13.sidePanelToggle == true) {
                    _this13.drawer.toggle();
                  }

                  _this13.resetFile();

                  _this13.resetData(formDirective);

                  _this13.editMode = false;
                }

                if (_this13.fromLogistic) {
                  _this13.routeid.queryParams.subscribe(function (params) {
                    if (params['fct']) {
                      _this13.fctpk = params['fct'];
                    }
                  });
                }

                _this13.getMarketPresenceList(_this13.encryptedcompanypk, _this13.locationType, 1, _this13.perpage);

                var el = _this13.mapTab.nativeElement;
                el.click();
              }
            });
          }
        }
      }, {
        key: "externalSaveReset",
        value: function externalSaveReset(dataType) {
          if (dataType == 1) {
            this.save(this.formDirective);
          } else if (dataType == 2) {
            this.resetData(this.formDirective);
          }
        }
      }, {
        key: "resetData",
        value: function resetData(formDirective) {
          this.formGroup.reset();
          if (formDirective) formDirective.resetForm();
          this.disableSubmitButton = false;
          this.form.type.setValue(this.locationType);
          this.form.country.setValue(Number(this.localStorage.getInLocal('countryPk')));
          this.form.companypk.setValue(this.companypk);
          this.phonecode = '';
          this.country_code_flag = 0;
          this.country_code_flag_fax = 0;
          this.reloadGoogleMaps();
          this.animationState = 'out';
          this.animationState2 = "out";
          this.formGroup.controls['name'].enable();
          this.formGroup.controls['crn'].enable();
          this.country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
          this.country_code_flag_fax = Number(this.localStorage.getInLocal('countryPk'));
          this.phonecode = this.localStorage.getInLocal('country_dialcode');
          this.phonecodefax = this.localStorage.getInLocal('country_dialcode');
          this.scrollElement.nativeElement.scrollTo(0, 0);
          this.getStateList(this.localStorage.getInLocal('countryPk'));

          if (this.searchFieldbus) {
            this.searchFieldbus.nativeElement.value = '';
          }

          this.filteroutlocation('', '');
          this.selected_location_id = '';
        }
      }, {
        key: "edit",
        value: function edit(data) {
          this.buttonname = 'Update';
          this.editMode = true;
          this.formGroup.controls['crn'].disable();

          if (this.sideNavHeaderName == "Registered Office") {
            this.countrydisabled = true;
            this.showtoolicon = false;
          }

          this.patchForm(data);

          if (!this.fromFactoryInfo) {
            this.drawer.toggle();
          }
        }
      }, {
        key: "delete",
        value: function _delete(pk, page, search) {
          var _this14 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
            title: "Do you want to delete this ".concat(this.sideNavHeaderName, "?"),
            icon: 'warning',
            buttons: ["No", "Yes"],
            dangerMode: true,
            closeOnClickOutside: false,
            closeOnEsc: false
          }).then(function (willDelete) {
            if (willDelete) {
              var encryptedPk = _this14.security.encrypt(pk);

              var encryptedType = _this14.security.encrypt(_this14.locationType);

              _this14.profileService.deleteMarketPresence(encryptedPk, encryptedType).subscribe(function (data) {
                if (data['data'].status == 1) {
                  // swal({
                  //   'title':this.sideNavHeaderName + ' deleted successfully',
                  //   icon: 'success',
                  //   closeOnClickOutside: false,
                  //   closeOnEsc: false
                  // });
                  _this14.showSuccess();

                  _this14.getMarketPresenceList(_this14.encryptedcompanypk, _this14.locationType, page, _this14.perpage, search, true);
                }
              });
            }
          });
        }
      }, {
        key: "showSuccess",
        value: function showSuccess() {
          this.toastr.success('Deleted successfully.', 'Success !', {
            timeOut: 3000,
            "positionClass": "toast-bottom-left"
          });
        }
      }, {
        key: "getMarketPresenceList",
        value: function getMarketPresenceList(companypk, type, pageno, perpage, search, forDelete) {
          var _this15 = this;

          forDelete = forDelete ? forDelete : false;
          this.profileService.getMarketPresenceList(companypk, type, pageno, perpage, search).subscribe(function (data) {
            if (_this15.deliverytypes) {
              var index = null;
              index = _this15.deliverytypes.findIndex(function (x) {
                return x.tvalue == _this15.deliveryType;
              });
              _this15.selectedDeliveryType = _this15.deliverytypes[index];
            }

            var dataToSend = {
              data: data['data'].items.data,
              count: data['data'].items.count,
              overallcount: data['data'].items.overallcount,
              isDelete: forDelete,
              last_added_mp_pk: _this15.last_added_mp_pk,
              deliverytypeData: _this15.selectedDeliveryType
            };
            _this15.locationlists = data['data'].items.data;

            _this15.marketpresencelist.emit(dataToSend);
          });
        }
      }, {
        key: "setcountryFlag",
        value: function setcountryFlag(value, type) {
          var _this16 = this;

          this.country_code_flag = value;

          if (this.countrylist !== null) {
            this.countrylist.forEach(function (x) {
              if (x.CountryMst_Pk == value) {
                _this16.formGroup.controls['landline_cc'].setValue(x.dialcode);

                _this16.phonecode = x.dialcode;
              }
            });
          }
        }
      }, {
        key: "setfaxcountryFlag",
        value: function setfaxcountryFlag(value, type) {
          var _this17 = this;

          this.country_code_flag_fax = value;

          if (this.countrylist !== null) {
            this.countrylist.forEach(function (x) {
              if (x.CountryMst_Pk == value) {
                // this.formGroup.controls['landline_cc'].setValue(x.dialcode);
                _this17.phonecodefax = x.dialcode;
              }
            });
          }
        }
      }, {
        key: "form",
        get: function get() {
          if (this.formGroup != undefined) {
            return this.formGroup.controls;
          }
        }
      }, {
        key: "getStateList",
        value: function getStateList(countrypk) {
          var _this18 = this;

          countrypk = countrypk ? countrypk : this.formGroup.controls['country'].value;
          this.stateService.getstatebyid(countrypk).subscribe(function (data) {
            _this18.statelist = data['data'];
          });
        }
      }, {
        key: "getCityList",
        value: function getCityList(statepk) {
          var _this19 = this;

          this.cityService.getcitybystateid(statepk).subscribe(function (data) {
            _this19.citylist = data['data'];
          });
        }
      }, {
        key: "getLocationDetails",
        value: function getLocationDetails(value) {
          this.form.address.setValue(value.address);
          this.form.latitude.setValue(String(value.coordinates.latitude));
          this.form.longitude.setValue(String(value.coordinates.longitude));
          this.getcountrypk(value.countryName, value.stateName, value.cityName);

          if (value.countryName != _env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanRecordFromDB.CyM_CountryName_en) {
            var index = this.countrylist.findIndex(function (x) {
              return x.CyM_CountryName_en.toLowerCase().trim() == value.countryName.toLowerCase().trim();
            });

            if (index !== -1) {
              this.phonecode = this.countrylist[index].dialcode;
              this.phonecodefax = this.countrylist[index].dialcode;
              this.country_code_flag = this.countrylist[index].CountryMst_Pk;
              this.country_code_flag_fax = this.countrylist[index].CountryMst_Pk;
              this.form.landline_cc.setValue(this.countrylist[index].dialcode);
            } else {
              this.phonecode = '';
              this.country_code_flag = 0;
              this.country_code_flag_fax = 0;
              this.form.landline_cc.setValue('');
            }
          } else {
            this.phonecode = _env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanDialCode;
            this.country_code_flag = _env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanPk;
            this.country_code_flag_fax = _env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanPk;
            this.form.landline_cc.setValue(_env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanDialCode);
          }
        }
      }, {
        key: "getcountrypk",
        value: function getcountrypk(country, state, city) {
          var _this20 = this;

          this.profileService.getCountryStateCityPk(country, state, city).subscribe(function (data) {
            if (data.data.country == String(_env_common_veriables__WEBPACK_IMPORTED_MODULE_11__["common_var"].omanPk)) {
              _this20.form.nationality.setValue('1');
            } else {
              _this20.form.nationality.setValue('2', {
                emitEvent: false
              });

              _this20.form.country.setValue(Number(data.data.country));
            }

            _this20.form.state.setValue(Number(data.data.state));

            _this20.form.city.setValue(Number(data.data.city));
          });
        }
      }, {
        key: "hideShowDateField",
        value: function hideShowDateField(event) {
          var event_check;

          if (event == '') {
            event_check = this.selected_ownertype;
          } else {
            event_check = event.value;
          }

          if (event_check == '1' || this.locationType == 13 || this.locationType == 16 || this.noLeaseDoc == true) {
            this.form.issued_on.setValue("");
            this.form.expired_on.setValue("");
            this.form.issued_on.setValidators(null);
            this.form.issued_on.updateValueAndValidity();
            this.form.expired_on.setValidators(null);
            this.form.expired_on.updateValueAndValidity();
            this.form.leasedoc.setValidators(null);
            this.form.leasedoc.updateValueAndValidity();

            if (this.form.leasedoc.value) {
              this.form.leasedoc.reset();
              this.resetFile();
            }
          } else {
            this.form.issued_on.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.issued_on.updateValueAndValidity();
            this.form.expired_on.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.expired_on.updateValueAndValidity();
            this.form.leasedoc.setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.form.leasedoc.updateValueAndValidity();
          }
        }
      }, {
        key: "toggleShowDiv",
        value: function toggleShowDiv(divName) {
          if (divName === 'descriptioncontentmarketpresence') {
            this.animationState = this.animationState === 'out' ? 'in' : 'out';
          }
        }
      }, {
        key: "infolisting",
        value: function infolisting(divName) {
          if (divName === 'infoview') {
            this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
          }
        }
      }, {
        key: "reloadGoogleMaps",
        value: function reloadGoogleMaps() {
          this.enabled = false;
          this.cdr.detectChanges();
          this.enabled = true;
        }
      }, {
        key: "fileeSelected",
        value: function fileeSelected(file, fileId) {
          fileId.selectedFilesPk = file;
        }
      }, {
        key: "resetFile",
        value: function resetFile() {
          var _this21 = this;

          if (this.locationType == 3) {
            this.drv_repcomplogo.selectedFilesPk = [];
            setTimeout(function () {
              if (_this21.compLogoFilee) _this21.compLogoFilee.triggerChange();
            }, 1000);
          }

          this.drv_leasedoc.selectedFilesPk = [];

          if (!this.fromFactoryInfo) {
            setTimeout(function () {
              if (_this21.leaseDocFilee) _this21.leaseDocFilee.triggerChange();
            }, 1000);
          }
        }
      }, {
        key: "isFormValid",
        get: function get() {
          var isValid = true;

          if (this.formGroup.valid && !this.previousFormValue || this.previousFormValue && this.isFormValueChanged) {
            isValid = this.formGroup.invalid;
          }

          return isValid;
        }
      }, {
        key: "isFormValueChanged",
        get: function get() {
          return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.formGroup.value);
        }
      }, {
        key: "showSweetAlert",
        value: function showSweetAlert() {
          var _this22 = this;

          if (this.formGroup.touched) {
            var msg = '';

            if (this.locationType == 13) {
              msg = 'Logistics Location';
            } else {
              msg = this.sideNavHeaderName;
            }

            sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
              title: 'Do you want to cancel adding this ' + msg + '?',
              text: 'All the data that you entered will be lost.',
              icon: 'warning',
              buttons: ['No', 'Yes'],
              dangerMode: true,
              closeOnClickOutside: false,
              closeOnEsc: false
            }).then(function (willDelete) {
              if (willDelete) {
                _this22.drawer.toggle();

                _this22.formGroup.reset();

                _this22.buttonname = 'Add';
                _this22.editMode = false;

                _this22.resetData();

                _this22.resetFile();

                _this22.disableSubmitButton = false;
                _this22.animationState = 'out';
                _this22.animationState2 = "out";
              }
            });
          } else {
            this.drawer.toggle();
            this.formGroup.reset();
            this.buttonname = 'Add';
            this.editMode = false;
            this.resetData();
            this.resetFile();
            this.disableSubmitButton = false;
            this.animationState = 'out';
            this.animationState2 = "out";
          }
        }
      }, {
        key: "setPostalAddress",
        value: function setPostalAddress(event) {
          if (event.checked) {
            this.form.postaladdress.setValue(this.form.address.value);
            this.form.postalcountry.setValue(this.form.country.value);
            this.form.postalstate.setValue(this.form.state.value);
            this.form.postalcity.setValue(this.form.city.value);
          } else {
            this.form.postaladdress.setValue('');
            this.form.postalcountry.setValue('');
            this.form.postalstate.setValue('');
            this.form.postalcity.setValue('');
          }
        }
      }]);

      return AddcontactComponent;
    }();

    AddcontactComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _profile_service__WEBPACK_IMPORTED_MODULE_15__["ProfileService"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"]
      }, {
        type: _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_10__["StateService"]
      }, {
        type: _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_6__["CityService"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ChangeDetectorRef"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_7__["Encrypt"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_17__["ToastrService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('mapTab'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])], AddcontactComponent.prototype, "mapTab", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_3__["MatDrawer"])], AddcontactComponent.prototype, "drawer", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], AddcontactComponent.prototype, "panel", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], AddcontactComponent.prototype, "locationType", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "sideNavHeaderName", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "popupContentPrefix", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "helpContent", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], AddcontactComponent.prototype, "dyHelpContent", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "showBusinessScope", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "sidePanelToggle", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "showLogo", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "hidePropertyType", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "hideCrn", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "hideBranchid", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "showDescription", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "showNationality", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "showOtherMarketPresence", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "namePlaceholder", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "descPlaceholder", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "addressPlaceholder", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], AddcontactComponent.prototype, "countrylist", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "companyname", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], AddcontactComponent.prototype, "perpage", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], AddcontactComponent.prototype, "marketpresencelist", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], AddcontactComponent.prototype, "selectedPanel", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('tab'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_tabs__WEBPACK_IMPORTED_MODULE_16__["MatTabGroup"])], AddcontactComponent.prototype, "tab", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('leasedoc'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_5__["Filee"])], AddcontactComponent.prototype, "leaseDocFilee", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('complogo'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_5__["Filee"])], AddcontactComponent.prototype, "compLogoFilee", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "emailwebsite", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "portNamehide", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "hideComponentHeader", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('formDirective'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormGroupDirective"])], AddcontactComponent.prototype, "formDirective", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "fromFactoryInfo", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "fromLogistic", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "noLeaseDoc", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "hideFax", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "headOfficeId", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "hideLocationlist", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], AddcontactComponent.prototype, "validation", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('scrollDiv'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])], AddcontactComponent.prototype, "scrollElement", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('searchFieldbus'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])], AddcontactComponent.prototype, "searchFieldbus", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], AddcontactComponent.prototype, "logoUrl", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "showPostalAddress", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], AddcontactComponent.prototype, "isHeadOfficeGiven", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [Object])], AddcontactComponent.prototype, "sideNavSubHeaderName", null);
    AddcontactComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-addcontact',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./addcontact.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.html"))["default"],
      animations: [_profilemanagement_animation__WEBPACK_IMPORTED_MODULE_14__["SlideInOutAnimation"]],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./addcontact.component.scss */
      "./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _profile_service__WEBPACK_IMPORTED_MODULE_15__["ProfileService"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"], _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_10__["StateService"], _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_6__["CityService"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ChangeDetectorRef"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_7__["Encrypt"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"], ngx_toastr__WEBPACK_IMPORTED_MODULE_17__["ToastrService"]])], AddcontactComponent);
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/contactinformation/contactinformation.component.scss":
  /*!************************************************************************************************!*\
    !*** ./src/app/modules/profilemanagement/contactinformation/contactinformation.component.scss ***!
    \************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesProfilemanagementContactinformationContactinformationComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "img[src=null] {\n  display: none;\n}\n\nimg[src=\"[object Storage]\"] {\n  display: none;\n}\n\n.w-50 {\n  width: 50%;\n}\n\n.information {\n  padding: 0px !important;\n  display: block;\n  margin: 0;\n}\n\n.information .info {\n  padding: 15px !important;\n  display: flex;\n}\n\n.information .info a {\n  text-decoration: underline;\n}\n\n.mat-button-toggle-checked {\n  background: #2dbe55;\n  color: #fff;\n}\n\n.documentsrow {\n  align-items: center !important;\n}\n\nmat-option[aria-label] {\n  position: relative;\n  font-size: 0.875rem;\n  color: #333 !important;\n  height: 50px;\n  padding-top: 0px;\n  padding-bottom: 15px;\n}\n\nmat-option[aria-label]::after {\n  content: attr(aria-label);\n  position: absolute;\n  bottom: -5px;\n  font-size: 0.75rem;\n  color: #666666;\n}\n\n.mat-tab-body-content::-webkit-scrollbar {\n  width: 0.5em;\n  position: absolute;\n  right: 0;\n}\n\n.mat-tab-body-content::-webkit-scrollbar-thumb {\n  background-color: #b8c3cb;\n}\n\n.organisationinfo {\n  background: #fff;\n}\n\n#mastercompanydetail .borderclass {\n  border: 5px solid #006cb7;\n}\n\n.topheadermain {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  color: #fff !important;\n}\n\n.topheadermain .imagewithtext {\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.cancelandpublish .cancel {\n  height: 45px;\n  color: #777;\n  border: 1px solid #cbcbcb;\n  border-radius: 2px !important;\n}\n\n.cancelandpublish .publish {\n  height: 45px;\n  border-radius: 2px !important;\n}\n\n.mat-form-field {\n  font-size: 0.9375rem;\n}\n\n::ng-deep.mat-form-field-infix {\n  border-top: 0.54375em solid transparent;\n}\n\n::slotted .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: rgba(0, 0, 0, 0.22);\n}\n\n.profilecompleteness p {\n  color: #fff;\n  font-size: 0.75rem;\n}\n\n.profilecompleteness .mat-progress-bar {\n  width: 190px;\n  margin-bottom: 15px;\n}\n\n::ng-deep.mat-progress-bar-fill::after {\n  background-color: #71c015 !important;\n}\n\n.progressandhistory {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  margin-bottom: 10px;\n}\n\n.pagenumberinprofile {\n  border: 1px solid #fff;\n  height: 20px;\n  min-width: 20px;\n  color: #fff;\n  border-radius: 10px/11px;\n  background: #2b7db5;\n  font-size: 0.75rem;\n  width: auto;\n  padding: 0 6px;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n  margin-right: 10px;\n}\n\n.completed {\n  background: #71c114;\n}\n\n.circlecolor {\n  background: #71c114;\n}\n\n.mat-select-panel {\n  border-radius: 0;\n}\n\n.mat-option[aria-disabled=true] {\n  background: #006cb7;\n  color: #fff;\n  height: 35px;\n}\n\n.accrodianheader .header {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.uploadandcompnayinfo {\n  display: flex;\n}\n\n.dropfilesheretoadd {\n  padding: 5px;\n  border: 1px dashed #999;\n  border-radius: 2px;\n}\n\n.dropfilesheretoadd div {\n  background: #f3f4f6;\n  height: 45px;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.dropfilesheretoadd div p {\n  color: #333;\n  font-size: 0.875rem;\n  margin: 0;\n  font-family: \"cairosemibold\";\n}\n\n.dropfilesheretoadd div p span {\n  color: #006cb7;\n}\n\n.saveandnext, .previous {\n  background: #ececec;\n  border-radius: 2px;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n  font-size: 0.9375rem;\n}\n\n.previous {\n  background: transparent;\n  font-size: 15px !important;\n  margin-right: 15px;\n  width: auto;\n}\n\n.viewingcontrols .mat-form-field {\n  width: 90px;\n}\n\n::ng-deep.mat-paginator-container {\n  padding: 0 !important;\n  font-size: 0.875rem;\n  justify-content: flex-start !important;\n}\n\n.showfilterandadditem button {\n  font-size: 14px !important;\n}\n\n.selectproductheaderwithclose {\n  height: 56px;\n}\n\n.selectproductheaderwithclose .closeandadd {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.selectproductheaderwithclose .titletext {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  padding: 10px;\n}\n\n.selectproductheaderwithclose .clearandaddbutton {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.selectproductheaderwithclose .clearandaddbutton .clearbutton {\n  background: #006cb7;\n}\n\n.selectproductheaderwithclose .clearandaddbutton .addbutton {\n  background: #28b8e7;\n}\n\n::ng-deep.mat-drawer-backdrop {\n  position: fixed;\n}\n\n.companyinfomcp {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  align-items: flex-start !important;\n}\n\n.companyinfomcp img {\n  width: 44px;\n  height: 44px;\n}\n\n.companyinfomcp .lypisid {\n  color: #666666;\n  font-size: 0.75rem;\n}\n\n.companyinfomcp p {\n  margin: 0;\n  line-height: 1;\n  color: #000;\n}\n\n.borderbottom {\n  border-bottom: 1px solid #ddd;\n  padding-bottom: 5px;\n}\n\n.innnerpartofdrwer {\n  padding-top: 25px;\n  padding-left: 75px !important;\n  padding-right: 75px !important;\n  padding-bottom: 45px !important;\n}\n\n::ng-deep.mat-select-panel {\n  max-height: 400px;\n}\n\n::ng-deep.mat-option:hover:not(.mat-option-disabled),\n::ng-deep .mat-option:focus:not(.mat-option-disabled),\n::ng-deep.mat-option.mat-selected:not(.mat-option-disabled) {\n  background: #cbdcf9 !important;\n}\n\n::ng-deep.mat-option.mat-active {\n  background: transparent;\n}\n\n.nextbutton {\n  color: white !important;\n  border: none !important;\n}\n\n.certificates {\n  display: flex !important;\n}\n\n:host ::ng-deep.mastercompnaycontent .commonexpandandcollapse .mat-expansion-panel-body {\n  padding: 10px !important;\n}\n\n.certiticatecounts {\n  justify-content: space-evenly;\n}\n\n.certiticatecounts p {\n  color: #006cb7;\n  font-size: 0.875rem;\n}\n\n.certiticatecounts .addbutton {\n  background: #006cb7;\n  font-size: 14px !important;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.certificateinfo {\n  padding-left: 20px;\n}\n\n.certificateinfo p {\n  font-size: 0.875rem;\n  margin: 0;\n  color: #000;\n  padding-bottom: 10px;\n}\n\n.certificateinfo .cerlabel {\n  color: #999;\n}\n\n.certificateinfo .header {\n  color: #333;\n  font-size: 1.125rem;\n  font-weight: bold;\n  padding-bottom: 15px;\n}\n\n.primaryofficeinfo {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n\n.primaryofficeinfo .officebuilding {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding: 20px;\n  align-items: flex-start !important;\n  width: 100%;\n}\n\n.primaryofficeinfo .addresslabel {\n  color: #999;\n  font-size: 11px !important;\n}\n\n.primaryofficeinfo .companyandofficeinfo {\n  width: calc(100% - 65px);\n}\n\n.primaryofficeinfo .companyandofficeinfo .name {\n  color: #006cb7;\n}\n\n.companyandofficeinfo {\n  width: calc(100% - 65px);\n  padding-left: 20px;\n}\n\n.companyandofficeinfo p {\n  margin: 0;\n  font-size: 0.9375rem;\n}\n\n.companyandofficeinfo .crandbranchids {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding-top: 10px;\n  padding-bottom: 10px;\n}\n\n.companyandofficeinfo .crandbranchids .count {\n  font-family: \"cairosemibold\";\n}\n\n.companyandofficeinfo .title {\n  color: #999;\n  font-size: 0.75rem;\n  margin: 0;\n  line-height: 0.9;\n  padding-bottom: 6px;\n}\n\n.companyandofficeinfo .lablename {\n  color: #999;\n  font-size: 0.9375rem;\n}\n\n.companyandofficeinfo .name {\n  color: #333;\n  font-size: 1rem;\n  margin: 0;\n  line-height: 18px;\n}\n\n.officeaddressdetail {\n  padding-top: 20px;\n}\n\n.officeaddressdetail .addressinfo {\n  font-size: 0.9375rem;\n}\n\n.contactandwebsite {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  align-items: flex-start !important;\n  padding-top: 20px;\n}\n\n.contactandwebsite p {\n  font-size: 0.9375rem;\n  padding-bottom: 5px;\n}\n\n.contactandwebsite .contact {\n  padding-right: 20px;\n}\n\n.contactandwebsite .webiste {\n  padding-left: 20px;\n}\n\n.contactdetails {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding-top: 15px;\n}\n\n.contactdetails div {\n  padding-right: 30px;\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n\n.contactdetails div i {\n  color: #9a9a9a;\n  padding-right: 10px;\n}\n\n.contactdetails div span {\n  color: #333;\n  font-size: 0.875rem;\n}\n\n.companydetailwithflag {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n\n.certificateimage {\n  position: relative;\n  width: 65px;\n  height: 65px;\n  background: #e0f0ff;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.certificateimage i {\n  color: #006cb7;\n  font-size: 1.5625rem;\n}\n\n.countryandcrinfo {\n  display: flex !important;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding-top: 10px;\n}\n\n.countryandcrinfo .eachitem {\n  padding-right: 25px;\n}\n\n.countryandcrinfo .eachitem .lablename {\n  font-size: 12px !important;\n}\n\n.countryandcrinfo .eachitem img {\n  width: 22px;\n}\n\n.countryandcrinfo .eachitem:last-child {\n  padding-right: 0;\n}\n\n.searchitembelow {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n  border: 1px solid #ddd;\n  height: 50px;\n}\n\n.searchitembelow input {\n  height: 100%;\n  width: 100%;\n  border: none;\n}\n\n.Paymentcontacthead p {\n  color: red;\n  margin: 0px;\n}\n\n::ng-deep.setcountryflag {\n  align-items: center;\n}\n\n.flagimage img {\n  max-width: 24px;\n}\n\n::ng-deep.countrynameselect .mat-option-text {\n  display: flex;\n  align-items: center;\n}\n\n::ng-deep.countrynameselect .mat-option-text img {\n  padding-right: 10px;\n}\n\n.mapwidth img {\n  width: 100%;\n}\n\n.profilelinkboxshadow {\n  box-shadow: 0 0 5px #ddd;\n  width: 100%;\n  padding-left: 7px;\n  padding-right: 7px;\n}\n\n.borderflex {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  min-height: 45px;\n  padding-top: 5px;\n}\n\n.pdfview {\n  display: flex;\n}\n\n.Search p {\n  color: #a9a9a9;\n}\n\n.Searchcolor {\n  color: #a9a9a9;\n}\n\n.certificateborder {\n  border: 1px dashed #b3b3b3 !important;\n  width: 100%;\n  height: 60px;\n  border-radius: 2px;\n  background: #f3f4f6;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n\n.certificateborder .fileherecolor {\n  color: #333333;\n}\n\n.certificateborder .addfilecolor {\n  color: #006cb7;\n}\n\n.certificateborder .uploadpdf {\n  color: #989898;\n}\n\n.certificateborder .uploadpdf p {\n  color: #989898;\n}\n\n.pdfbackground {\n  background-color: #edf3ff;\n}\n\n.textcolor {\n  color: #006cb7 !important;\n}\n\n.deleteflexend {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n\n.border {\n  border: none !important;\n  width: 96% !important;\n}\n\n.flexoman {\n  display: flex;\n  align-items: center;\n  /* width: 190px; */\n}\n\n.flexoman span {\n  font-size: 0.9375rem;\n  margin-left: 4px;\n}\n\n.flexserach {\n  display: flex;\n  align-items: center;\n}\n\n.iconstyle {\n  font-size: 1.125rem;\n  color: #006cb7;\n}\n\n.start {\n  display: flex;\n  align-items: center;\n  margin-left: 0px;\n}\n\n.searchinfo {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n  height: 34px;\n}\n\n.pdfimage {\n  width: 14px;\n  height: 14px;\n}\n\n.propertytype {\n  display: flex;\n}\n\n@media (max-width: 767px) {\n  .countryandcrinfo {\n    display: block !important;\n  }\n  .countryandcrinfo .eachitem {\n    padding-right: 0px !important;\n    padding-bottom: 15px;\n  }\n\n  .certificates {\n    display: block !important;\n  }\n\n  .companyandofficeinfo {\n    padding-left: 0px !important;\n  }\n\n  ::ng-deep.masterbottom .mat-paginator {\n    display: contents;\n  }\n\n  .createresolution {\n    padding-top: 42px;\n  }\n\n  .selectproductheaderwithclose {\n    height: auto !important;\n  }\n\n  .selectproductheaderwithclose .titletext {\n    display: block !important;\n  }\n\n  .selectproductheaderwithclose .closeandadd {\n    margin-bottom: 10px;\n  }\n\n  .selectproductheaderwithclose .titletext .bgi-info {\n    font-size: 0.75rem;\n    margin-left: 4px;\n    position: relative;\n    top: -1px;\n  }\n\n  .searchinfo {\n    display: block !important;\n    align-items: center !important;\n    justify-content: center !important;\n  }\n\n  .height-35 {\n    margin-left: 0px !important;\n  }\n\n  ::ng-deep.masterPage .mat-paginator-range-label {\n    margin: 0 32px 0 12px;\n    display: contents !important;\n    font-size: 12px !important;\n  }\n}\n\n@media (max-width: 767px) {\n  ::ng-deep.masterbottom .mat-paginator-range-label {\n    margin: 0 32px 0 12px;\n    color: black;\n    margin-right: -6px;\n    font-size: 0.75rem;\n  }\n\n  ::ng-deep.masterPage .mat-paginator-page-size {\n    display: flex;\n    align-items: baseline;\n    margin-right: 0px;\n  }\n\n  ::ng-deep.masterbottom .mat-paginator-range-actions {\n    display: contents;\n  }\n\n  ::ng-deep.masterbottom .mat-paginator-page-size-label {\n    font-size: 0.75rem;\n  }\n\n  ::ng-deep.masterbottom .mat-paginator-range-label {\n    font-size: 0.75rem;\n  }\n\n  ::ng-deep.masterbottom .mat-paginator-container {\n    display: flex;\n    align-items: center;\n    justify-content: flex-end;\n    min-height: 56px;\n    padding: 0px;\n    flex-wrap: wrap-reverse;\n    width: 261px;\n  }\n}\n\n@media (max-width: 320px) {\n  ::ng-deep.masterbottom .mat-paginator-range-actions {\n    display: contents;\n  }\n\n  ::ng-deep.masterbottom .mat-paginator-page-size-label {\n    font-size: 0.75rem;\n  }\n\n  ::ng-deep.masterbottom .mat-paginator-range-label {\n    font-size: 0.75rem;\n  }\n}\n\n@media (min-width: 360px) {\n  ::ng-deep.masterbottom .mat-paginator-range-actions {\n    display: contents;\n  }\n}\n\n@media (max-width: 768px) {\n  .certificates {\n    display: block;\n  }\n\n  .searchinfo {\n    display: flex !important;\n    align-items: center !important;\n    justify-content: space-between !important;\n  }\n}\n\n@media (max-width: 1920px) and (min-width: 1080px) {\n  .width {\n    max-width: 70% !important;\n  }\n\n  .widthsecond {\n    max-width: 30% !important;\n  }\n}\n\n.widthfiled {\n  width: 60%;\n}\n\n.eachitem {\n  min-width: 200px;\n  max-width: 200px;\n}\n\n.tooltipwidth {\n  width: 50px;\n}\n\n.txt-6 {\n  color: #666;\n}\n\n.w-150 {\n  width: 25px;\n}\n\n.pagenumberinprofile {\n  border: 1px solid #fff;\n  height: 20px;\n  min-width: 20px;\n  color: #fff;\n  border-radius: 10px/11px;\n  background: #2b7db5;\n  font-size: 0.75rem;\n  width: auto;\n  padding: 0 6px;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n  margin-right: 10px;\n}\n\n.completed {\n  background: #71c114;\n}\n\n.certiticatecounts {\n  height: 34px;\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n\n.certiticatecounts p {\n  color: #333;\n  font-size: 0.875rem;\n}\n\n.certiticatecounts .addbutton {\n  background: #006cb7;\n  font-size: 14px !important;\n  display: flex !important;\n  justify-content: center !important;\n  align-items: center !important;\n}\n\n.insideheader {\n  color: #006cb7;\n  font-size: 0.9375rem;\n  font-weight: bold;\n  margin: 0;\n  padding-top: 25px;\n  padding-bottom: 15px;\n}\n\n.saveandnext, .previous {\n  background: #ececec;\n  border-radius: 2px;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n  font-size: 0.9375rem;\n  min-width: 120px;\n}\n\n.previous {\n  background: transparent;\n  font-size: 15px !important;\n  margin-right: 15px;\n  width: auto;\n}\n\n.txt-tropaz {\n  color: #006cb7 !important;\n}\n\n.commonexpandandcollapse .triggeredto#cust1 mat-expansion-panel.mat-expanded {\n  margin-bottom: 0px !important;\n  margin-top: 30px !important;\n}\n\n.certificateimage {\n  width: 85px !important;\n}\n\n.addedcertificate:hover .header, .addedcertificate:hover h5 {\n  color: #006cb7;\n}\n\n.redTxt {\n  color: #f4811f;\n  cursor: pointer;\n}\n\n.royal {\n  display: flex;\n  justify-content: space-between;\n}\n\n.certificateicon {\n  z-index: 1;\n  height: 85px;\n  width: 85px;\n  display: flex;\n  align-items: center;\n  position: relative;\n  background-color: #e0f0ff;\n  border-radius: 3px;\n}\n\n.certificateicon i {\n  color: #006cb7;\n  font-size: 2.5rem;\n  padding-left: 25px;\n}\n\n.cancelandpublish .cancel {\n  height: 45px;\n  color: #777;\n  border: 1px solid #cbcbcb;\n  border-radius: 2px !important;\n}\n\n.cancelandpublish .publish {\n  height: 45px;\n  border-radius: 2px !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9wcm9maWxlbWFuYWdlbWVudC9jb250YWN0aW5mb3JtYXRpb24vQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xccHJvZmlsZW1hbmFnZW1lbnRcXGNvbnRhY3RpbmZvcm1hdGlvblxcY29udGFjdGluZm9ybWF0aW9uLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3Byb2ZpbGVtYW5hZ2VtZW50L2NvbnRhY3RpbmZvcm1hdGlvbi9jb250YWN0aW5mb3JtYXRpb24uY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBMEJFO0VBQ0UsYUFBQTtBQ3pCSjs7QUQyQkU7RUFDRSxhQUFBO0FDeEJKOztBRDBCRTtFQUNJLFVBQUE7QUN2Qk47O0FEeUJFO0VBQ0UsdUJBQUE7RUFDQSxjQUFBO0VBQ0EsU0FBQTtBQ3RCSjs7QUR1Qkk7RUFDRSx3QkFBQTtFQUNBLGFBQUE7QUNyQk47O0FEc0JNO0VBQ0UsMEJBQUE7QUNwQlI7O0FEeUJFO0VBQ0UsbUJBQUE7RUFDQSxXQUFBO0FDdEJKOztBRHlCRTtFQUNFLDhCQUFBO0FDdEJKOztBRHlCRTtFQUNFLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxzQkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtFQUNBLG9CQUFBO0FDdEJKOztBRHVCSTtFQUNFLHlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxjQUFBO0FDckJOOztBRHlCRTtFQUNFLFlBQUE7RUFDQSxrQkFBQTtFQUNBLFFBQUE7QUN0Qko7O0FEeUJFO0VBQ0UseUJBQUE7QUN0Qko7O0FEeUJFO0VBQ0UsZ0JBQUE7QUN0Qko7O0FEMEJJO0VBQ0UseUJBQUE7QUN2Qk47O0FEMEJFO0VBNUVFLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtFQTRFQSxzQkFBQTtBQ3JCSjs7QURzQkk7RUE5RkEsd0JBQUE7RUFDQSxrQ0FBQTtFQUNBLDhCQUFBO0FDMkVKOztBRHdCSTtFQUNFLFlBQUE7RUFDQSxXQUFBO0VBQ0EseUJBQUE7RUFDQSw2QkFBQTtBQ3JCTjs7QUR1Qkk7RUFDRSxZQUFBO0VBQ0EsNkJBQUE7QUNyQk47O0FEeUJFO0VBQ0Usb0JBQUE7QUN0Qko7O0FEeUJFO0VBQ0UsdUNBQUE7QUN0Qko7O0FEeUJFO0VBQ0UscUNBQUE7QUN0Qko7O0FEeUJJO0VBQ0UsV0FBQTtFQUNBLGtCQUFBO0FDdEJOOztBRHdCSTtFQUNFLFlBQUE7RUFDQSxtQkFBQTtBQ3RCTjs7QUR5QkU7RUFDRSxvQ0FBQTtBQ3RCSjs7QUR5QkU7RUEzSEUsd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0VBMkhBLG1CQUFBO0FDcEJKOztBRHNCRTtFQUNFLHNCQUFBO0VBQ0EsWUFBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0VBQ0Esd0JBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0EsV0FBQTtFQUNBLGNBQUE7RUF2SkEsd0JBQUE7RUFDQSxrQ0FBQTtFQUNBLDhCQUFBO0VBdUpBLGtCQUFBO0FDakJKOztBRG1CRTtFQUNFLG1CQUFBO0FDaEJKOztBRGtCRTtFQUNFLG1CQUFBO0FDZko7O0FEaUJFO0VBQ0UsZ0JBQUE7QUNkSjs7QURpQkU7RUFDRSxtQkFBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0FDZEo7O0FEa0JJO0VBdktBLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtBQ3lKSjs7QURnQkU7RUFDRSxhQUFBO0FDYko7O0FEZ0JFO0VBQ0UsWUFBQTtFQUNBLHVCQUFBO0VBQ0Esa0JBQUE7QUNiSjs7QURjSTtFQUNFLG1CQUFBO0VBQ0EsWUFBQTtFQTFMRix3QkFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7QUMrS0o7O0FEV007RUF4S0YsV0FBQTtFQUNBLG1CQUFBO0VBQ0EsU0FBQTtFQXdLSSw0QkFBQTtBQ1BSOztBRFFRO0VBQ0UsY0FBQTtBQ05WOztBRFdFO0VBQ0UsbUJBQUE7RUFDQSxrQkFBQTtFQUNBLG9DQUFBO0VBQ0Esc0JBQUE7RUFDQSxvQkFBQTtBQ1JKOztBRFVFO0VBRUUsdUJBQUE7RUFDQSwwQkFBQTtFQUNBLGtCQUFBO0VBQ0EsV0FBQTtBQ1JKOztBRFdJO0VBQ0UsV0FBQTtBQ1JOOztBRFlFO0VBQ0UscUJBQUE7RUFDQSxtQkFBQTtFQUNBLHNDQUFBO0FDVEo7O0FEV0U7RUFDRSwwQkFBQTtBQ1JKOztBRFVFO0VBSUUsWUFBQTtBQ1ZKOztBRE9JO0VBN05BLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtBQ3lOSjs7QURNSTtFQXZOQSx3QkFBQTtFQUNBLHlDQUFBO0VBQ0EsOEJBQUE7RUF1TkUsYUFBQTtBQ0ZOOztBRElJO0VBck9BLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtBQ29PSjs7QURDTTtFQUNFLG1CQUFBO0FDQ1I7O0FEQ007RUFDRSxtQkFBQTtBQ0NSOztBREdFO0VBQ0UsZUFBQTtBQ0FKOztBREVFO0VBbFBFLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtFQWtQQSxrQ0FBQTtBQ0dKOztBRERJO0VBQ0UsV0FBQTtFQUNBLFlBQUE7QUNHTjs7QURESTtFQUNFLGNBQUE7RUFDQSxrQkFBQTtBQ0dOOztBRERJO0VBQ0UsU0FBQTtFQUNBLGNBQUE7RUFDQSxXQUFBO0FDR047O0FEQ0U7RUFDRSw2QkFBQTtFQUNBLG1CQUFBO0FDRUo7O0FEQUU7RUFDRSxpQkFBQTtFQUNBLDZCQUFBO0VBQ0EsOEJBQUE7RUFDQSwrQkFBQTtBQ0dKOztBREFFO0VBQ0UsaUJBQUE7QUNHSjs7QURERTs7O0VBR0UsOEJBQUE7QUNJSjs7QURGRTtFQUNFLHVCQUFBO0FDS0o7O0FEREU7RUFDRSx1QkFBQTtFQUNBLHVCQUFBO0FDSUo7O0FEREU7RUFDRSx3QkFBQTtBQ0lKOztBREZFO0VBQ0Usd0JBQUE7QUNLSjs7QURGRTtFQUNFLDZCQUFBO0FDS0o7O0FESkk7RUFDRSxjQUFBO0VBQ0EsbUJBQUE7QUNNTjs7QURISTtFQUNFLG1CQUFBO0VBQ0EsMEJBQUE7RUF2VEYsd0JBQUE7RUFDQSxrQ0FBQTtFQUNBLDhCQUFBO0FDNlRKOztBREhFO0VBQ0Usa0JBQUE7QUNNSjs7QURMSTtFQUNFLG1CQUFBO0VBQ0EsU0FBQTtFQUNBLFdBQUE7RUFDQSxvQkFBQTtBQ09OOztBRExJO0VBQ0UsV0FBQTtBQ09OOztBRExJO0VBQ0UsV0FBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7RUFDQSxvQkFBQTtBQ09OOztBREhFO0VBaFVFLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtBQ3VVSjs7QURQSTtFQTVVQSx3QkFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7RUE0VUUsYUFBQTtFQUNBLGtDQUFBO0VBQ0EsV0FBQTtBQ1dOOztBRFRJO0VBQ0UsV0FBQTtFQUNBLDBCQUFBO0FDV047O0FEVEk7RUFFRSx3QkFBQTtBQ1VOOztBRFRNO0VBQ0UsY0FBQTtBQ1dSOztBRFBFO0VBQ0Usd0JBQUE7RUFhQSxrQkFBQTtBQ0ZKOztBRFZJO0VBQ0UsU0FBQTtFQUNBLG9CQUFBO0FDWU47O0FEVkk7RUFwV0Esd0JBQUE7RUFDQSxzQ0FBQTtFQUNBLDhCQUFBO0VBb1dFLGlCQUFBO0VBQ0Esb0JBQUE7QUNjTjs7QURiTTtFQUNFLDRCQUFBO0FDZVI7O0FEWEk7RUFDRSxXQUFBO0VBQ0Esa0JBQUE7RUFDQSxTQUFBO0VBQ0EsZ0JBQUE7RUFDQSxtQkFBQTtBQ2FOOztBRFhJO0VBQ0UsV0FBQTtFQUNBLG9CQUFBO0FDYU47O0FEWEk7RUFDRSxXQUFBO0VBQ0EsZUFBQTtFQUNBLFNBQUE7RUFDQSxpQkFBQTtBQ2FOOztBRFZFO0VBQ0UsaUJBQUE7QUNhSjs7QURYSTtFQUNFLG9CQUFBO0FDYU47O0FEVkU7RUF0WUUsd0JBQUE7RUFDQSxzQ0FBQTtFQUNBLDhCQUFBO0VBc1lBLGtDQUFBO0VBQ0EsaUJBQUE7QUNlSjs7QURkSTtFQUNFLG9CQUFBO0VBQ0EsbUJBQUE7QUNnQk47O0FEZEk7RUFDRSxtQkFBQTtBQ2dCTjs7QURkSTtFQUNFLGtCQUFBO0FDZ0JOOztBRGJFO0VBclpFLHdCQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtFQXFaQSxpQkFBQTtBQ2tCSjs7QURqQkk7RUFDRSxtQkFBQTtFQXpaRix3QkFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7QUM2YUo7O0FEcEJNO0VBQ0UsY0FBQTtFQUNBLG1CQUFBO0FDc0JSOztBRHBCTTtFQUNFLFdBQUE7RUFDQSxtQkFBQTtBQ3NCUjs7QURqQkU7RUE1WkUsd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0FDaWJKOztBRHBCRTtFQUNFLGtCQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtFQWxiQSx3QkFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7QUMwY0o7O0FEeEJJO0VBQ0UsY0FBQTtFQUNBLG9CQUFBO0FDMEJOOztBRHZCRTtFQXBiRSx3QkFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7RUFvYkEsaUJBQUE7QUM0Qko7O0FEM0JJO0VBQ0UsbUJBQUE7QUM2Qk47O0FENUJNO0VBQ0UsMEJBQUE7QUM4QlI7O0FENUJNO0VBQ0UsV0FBQTtBQzhCUjs7QUQ1Qk07RUFDRSxnQkFBQTtBQzhCUjs7QUR6QkU7RUEzYkUsd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0VBMmJBLHNCQUFBO0VBQ0EsWUFBQTtBQzhCSjs7QUQ3Qkk7RUFDRSxZQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7QUMrQk47O0FEM0JJO0VBQ0UsVUFBQTtFQUNBLFdBQUE7QUM4Qk47O0FEM0JFO0VBQ0UsbUJBQUE7QUM4Qko7O0FENUJFO0VBQ0UsZUFBQTtBQytCSjs7QUQzQkk7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7QUM4Qk47O0FEN0JNO0VBQ0UsbUJBQUE7QUMrQlI7O0FEMUJJO0VBQ0UsV0FBQTtBQzZCTjs7QUQxQkU7RUFDRSx3QkFBQTtFQUNBLFdBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0FDNkJKOztBRDNCRTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtFQUNBLDhCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkFBQTtBQzhCSjs7QUQ1QkU7RUFDRSxhQUFBO0FDK0JKOztBRDVCSTtFQUNFLGNBQUE7QUMrQk47O0FENUJFO0VBQ0UsY0FBQTtBQytCSjs7QUQ3QkU7RUFDRSxxQ0FBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxtQkFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDZ0NKOztBRDlCSTtFQUNFLGNBQUE7QUNnQ047O0FEOUJJO0VBQ0UsY0FBQTtBQ2dDTjs7QUQ5Qkk7RUFDRSxjQUFBO0FDZ0NOOztBRC9CTTtFQUNFLGNBQUE7QUNpQ1I7O0FEN0JFO0VBQ0UseUJBQUE7QUNnQ0o7O0FEOUJFO0VBQ0UseUJBQUE7QUNpQ0o7O0FEL0JFO0VBQ0UsYUFBQTtFQUNBLG1CQUFBO0VBQ0EseUJBQUE7QUNrQ0o7O0FEaENFO0VBQ0UsdUJBQUE7RUFDQSxxQkFBQTtBQ21DSjs7QURqQ0U7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxrQkFBQTtBQ29DSjs7QURuQ0k7RUFDRSxvQkFBQTtFQUNBLGdCQUFBO0FDcUNOOztBRGxDRTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtBQ3FDSjs7QURuQ0U7RUFDRSxtQkFBQTtFQUNBLGNBQUE7QUNzQ0o7O0FEcENFO0VBQ0UsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsZ0JBQUE7QUN1Q0o7O0FEckNFO0VBQ0UsYUFBQTtFQUNBLG1CQUFBO0VBQ0EseUJBQUE7RUFDQSxZQUFBO0FDd0NKOztBRHJDRTtFQUNFLFdBQUE7RUFDQSxZQUFBO0FDd0NKOztBRHRDRTtFQUNFLGFBQUE7QUN5Q0o7O0FEdkNFO0VBQ0U7SUFDRSx5QkFBQTtFQzBDSjtFRHpDSTtJQUNFLDZCQUFBO0lBQ0Esb0JBQUE7RUMyQ047O0VEeENFO0lBQ0UseUJBQUE7RUMyQ0o7O0VEekNHO0lBQ0MsNEJBQUE7RUM0Q0o7O0VEMUNFO0lBQ0UsaUJBQUE7RUM2Q0o7O0VEM0NFO0lBQ0UsaUJBQUE7RUM4Q0o7O0VENUNFO0lBQ0UsdUJBQUE7RUMrQ0o7O0VEN0NFO0lBQ0UseUJBQUE7RUNnREo7O0VEOUNFO0lBQ0UsbUJBQUE7RUNpREo7O0VEN0NFO0lBQ0Usa0JBQUE7SUFDQSxnQkFBQTtJQUNBLGtCQUFBO0lBQ0EsU0FBQTtFQ2dESjs7RUQ3Q0U7SUFDRSx5QkFBQTtJQUNBLDhCQUFBO0lBQ0Esa0NBQUE7RUNnREo7O0VEOUNFO0lBQ0UsMkJBQUE7RUNpREo7O0VEOUNFO0lBQ0UscUJBQUE7SUFDQSw0QkFBQTtJQUNBLDBCQUFBO0VDaURKO0FBQ0Y7O0FEL0NFO0VBQ0U7SUFDRSxxQkFBQTtJQUNBLFlBQUE7SUFDQSxrQkFBQTtJQUNBLGtCQUFBO0VDaURKOztFRC9DRTtJQUNFLGFBQUE7SUFDQSxxQkFBQTtJQUNBLGlCQUFBO0VDa0RKOztFRGhERTtJQUNFLGlCQUFBO0VDbURKOztFRGpERTtJQUNFLGtCQUFBO0VDb0RKOztFRGxERTtJQUNFLGtCQUFBO0VDcURKOztFRGxERTtJQUNFLGFBQUE7SUFDQSxtQkFBQTtJQUNBLHlCQUFBO0lBQ0EsZ0JBQUE7SUFDQSxZQUFBO0lBQ0EsdUJBQUE7SUFDQSxZQUFBO0VDcURKO0FBQ0Y7O0FEbkRFO0VBQ0U7SUFDRSxpQkFBQTtFQ3FESjs7RURuREU7SUFDRSxrQkFBQTtFQ3NESjs7RURwREU7SUFDRSxrQkFBQTtFQ3VESjtBQUNGOztBRHJERTtFQUNFO0lBQ0UsaUJBQUE7RUN1REo7QUFDRjs7QURwREU7RUFDRTtJQUNFLGNBQUE7RUNzREo7O0VEbkRFO0lBQ0Usd0JBQUE7SUFDQSw4QkFBQTtJQUNBLHlDQUFBO0VDc0RKO0FBQ0Y7O0FEbkRFO0VBQ0U7SUFDRSx5QkFBQTtFQ3FESjs7RURuREU7SUFDRSx5QkFBQTtFQ3NESjtBQUNGOztBRHBERTtFQUNFLFVBQUE7QUNzREo7O0FEbERFO0VBQ0UsZ0JBQUE7RUFDQSxnQkFBQTtBQ3FESjs7QURsREU7RUFDSSxXQUFBO0FDcUROOztBRG5ERTtFQUNFLFdBQUE7QUNzREo7O0FEcERBO0VBQ0ksV0FBQTtBQ3VESjs7QURyREE7RUFDRSxzQkFBQTtFQUNGLFlBQUE7RUFDQSxlQUFBO0VBQ0EsV0FBQTtFQUNBLHdCQUFBO0VBQ0EsbUJBQUE7RUFDQSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxjQUFBO0VBdnVCSSx3QkFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7RUF1dUJGLGtCQUFBO0FDMERGOztBRHhEQTtFQUNFLG1CQUFBO0FDMkRGOztBRHpEQTtFQUNJLFlBQUE7RUFodUJBLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtBQzZ4Qko7O0FEN0RJO0VBQ0UsV0FBQTtFQUNBLG1CQUFBO0FDK0ROOztBRDVESTtFQUNFLG1CQUFBO0VBQ0EsMEJBQUE7RUF4dkJGLHdCQUFBO0VBQ0Esa0NBQUE7RUFDQSw4QkFBQTtBQ3V6Qko7O0FEN0RFO0VBQ0UsY0FBQTtFQUNBLG9CQUFBO0VBQ0EsaUJBQUE7RUFDQSxTQUFBO0VBQ0EsaUJBQUE7RUFDQSxvQkFBQTtBQ2dFSjs7QUQ3REU7RUFDRSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0Esb0NBQUE7RUFDQSxzQkFBQTtFQUNBLG9CQUFBO0VBQ0EsZ0JBQUE7QUNnRUo7O0FEOURFO0VBRUUsdUJBQUE7RUFDQSwwQkFBQTtFQUNBLGtCQUFBO0VBQ0EsV0FBQTtBQ2dFSjs7QUQ5REE7RUFDQSx5QkFBQTtBQ2lFQTs7QUQvREE7RUFDQSw2QkFBQTtFQUNBLDJCQUFBO0FDa0VBOztBRGhFQTtFQUNFLHNCQUFBO0FDbUVGOztBRC9ESTtFQUNFLGNBQUE7QUNrRU47O0FEOURBO0VBQ0UsY0FBQTtFQUNBLGVBQUE7QUNpRUY7O0FEL0RBO0VBQ0ksYUFBQTtFQUNBLDhCQUFBO0FDa0VKOztBRGhFQTtFQUNFLFVBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtBQ21FRjs7QURsRUU7RUFDSSxjQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtBQ29FTjs7QURoRUU7RUFDRSxZQUFBO0VBQ0EsV0FBQTtFQUNBLHlCQUFBO0VBQ0EsNkJBQUE7QUNtRUo7O0FEakVFO0VBQ0UsWUFBQTtFQUNBLDZCQUFBO0FDbUVKIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9wcm9maWxlbWFuYWdlbWVudC9jb250YWN0aW5mb3JtYXRpb24vY29udGFjdGluZm9ybWF0aW9uLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiQG1peGluIGZsZXhjZW50ZXIge1xyXG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuICB9XHJcbiAgQG1peGluIGZsZXhzdGFydCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuICB9XHJcbiAgQG1peGluIGZsZXhlbmQge1xyXG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZCAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBAbWl4aW4gc3BhY2ViZXR3ZWVuIHtcclxuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBAbWl4aW4gY29tbWFuY3NzZm9ycHRhZyB7XHJcbiAgICBjb2xvcjogIzMzMztcclxuICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICBtYXJnaW46IDA7XHJcbiAgfVxyXG4gIFxyXG4gIGltZ1tzcmM9XCJudWxsXCJdIHtcclxuICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgfVxyXG4gIGltZ1tzcmM9XCJbb2JqZWN0IFN0b3JhZ2VdXCJdIHtcclxuICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgfVxyXG4gIC53LTUwe1xyXG4gICAgICB3aWR0aDogNTAlO1xyXG4gIH1cclxuICAuaW5mb3JtYXRpb24ge1xyXG4gICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIG1hcmdpbjogMDtcclxuICAgIC5pbmZvIHtcclxuICAgICAgcGFkZGluZzogMTVweCAhaW1wb3J0YW50O1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICBhIHtcclxuICAgICAgICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAubWF0LWJ1dHRvbi10b2dnbGUtY2hlY2tlZCB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjMmRiZTU1O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgfVxyXG4gIFxyXG4gIC5kb2N1bWVudHNyb3cge1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBcclxuICBtYXQtb3B0aW9uW2FyaWEtbGFiZWxdIHtcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xyXG4gICAgaGVpZ2h0OiA1MHB4O1xyXG4gICAgcGFkZGluZy10b3A6IDBweDtcclxuICAgIHBhZGRpbmctYm90dG9tOiAxNXB4O1xyXG4gICAgJjo6YWZ0ZXIge1xyXG4gICAgICBjb250ZW50OiBhdHRyKGFyaWEtbGFiZWwpO1xyXG4gICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgIGJvdHRvbTogLTVweDtcclxuICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgICBjb2xvcjogIzY2NjY2NjtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLm1hdC10YWItYm9keS1jb250ZW50Ojotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICB3aWR0aDogMC41ZW07XHJcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICByaWdodDogMDtcclxuICB9XHJcbiAgXHJcbiAgLm1hdC10YWItYm9keS1jb250ZW50Ojotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjYjhjM2NiO1xyXG4gIH1cclxuICBcclxuICAub3JnYW5pc2F0aW9uaW5mbyB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gIH1cclxuICBcclxuICAjbWFzdGVyY29tcGFueWRldGFpbCB7XHJcbiAgICAuYm9yZGVyY2xhc3Mge1xyXG4gICAgICBib3JkZXI6IDVweCBzb2xpZCAjMDA2Y2I3O1xyXG4gICAgfVxyXG4gIH1cclxuICAudG9waGVhZGVybWFpbiB7XHJcbiAgICBAaW5jbHVkZSBzcGFjZWJldHdlZW4oKTtcclxuICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAuaW1hZ2V3aXRodGV4dCB7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgXHJcbiAgLmNhbmNlbGFuZHB1Ymxpc2gge1xyXG4gICAgLmNhbmNlbCB7XHJcbiAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgY29sb3I6ICM3Nzc7XHJcbiAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNjYmNiY2I7XHJcbiAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnB1Ymxpc2gge1xyXG4gICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgfVxyXG4gIFxyXG4gIDo6bmctZGVlcC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICBib3JkZXItdG9wOiAwLjU0Mzc1ZW0gc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgfVxyXG4gIFxyXG4gIDo6c2xvdHRlZCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKDAsIDAsIDAsIDAuMjIpO1xyXG4gIH1cclxuICAucHJvZmlsZWNvbXBsZXRlbmVzcyB7XHJcbiAgICBwIHtcclxuICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgIH1cclxuICAgIC5tYXQtcHJvZ3Jlc3MtYmFyIHtcclxuICAgICAgd2lkdGg6IDE5MHB4O1xyXG4gICAgICBtYXJnaW4tYm90dG9tOiAxNXB4O1xyXG4gICAgfVxyXG4gIH1cclxuICA6Om5nLWRlZXAubWF0LXByb2dyZXNzLWJhci1maWxsOjphZnRlciB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNzFjMDE1ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIFxyXG4gIC5wcm9ncmVzc2FuZGhpc3Rvcnkge1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xyXG4gIH1cclxuICAucGFnZW51bWJlcmlucHJvZmlsZSB7XHJcbiAgICBib3JkZXI6IDFweCBzb2xpZCAjZmZmO1xyXG4gICAgaGVpZ2h0OiAyMHB4O1xyXG4gICAgbWluLXdpZHRoOiAyMHB4O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4IC8gMTFweDtcclxuICAgIGJhY2tncm91bmQ6ICMyYjdkYjU7XHJcbiAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICB3aWR0aDogYXV0bztcclxuICAgIHBhZGRpbmc6IDAgNnB4O1xyXG4gICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gIH1cclxuICAuY29tcGxldGVkIHtcclxuICAgIGJhY2tncm91bmQ6ICM3MWMxMTQ7XHJcbiAgfVxyXG4gIC5jaXJjbGVjb2xvciB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjNzFjMTE0O1xyXG4gIH1cclxuICAubWF0LXNlbGVjdC1wYW5lbCB7XHJcbiAgICBib3JkZXItcmFkaXVzOiAwO1xyXG4gIH1cclxuICBcclxuICAubWF0LW9wdGlvblthcmlhLWRpc2FibGVkPVwidHJ1ZVwiXSB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjMDA2Y2I3O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgICBoZWlnaHQ6IDM1cHg7XHJcbiAgfVxyXG4gIFxyXG4gIC5hY2Nyb2RpYW5oZWFkZXIge1xyXG4gICAgLmhlYWRlciB7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgfVxyXG4gIH1cclxuICAudXBsb2FkYW5kY29tcG5heWluZm8ge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICB9XHJcbiAgXHJcbiAgLmRyb3BmaWxlc2hlcmV0b2FkZCB7XHJcbiAgICBwYWRkaW5nOiA1cHg7XHJcbiAgICBib3JkZXI6IDFweCBkYXNoZWQgIzk5OTtcclxuICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgIGRpdiB7XHJcbiAgICAgIGJhY2tncm91bmQ6ICNmM2Y0ZjY7XHJcbiAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICBwIHtcclxuICAgICAgICBAaW5jbHVkZSBjb21tYW5jc3Nmb3JwdGFnKCk7XHJcbiAgICAgICAgZm9udC1mYW1pbHk6ICdjYWlyb3NlbWlib2xkJztcclxuICAgICAgICBzcGFuIHtcclxuICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAuc2F2ZWFuZG5leHQge1xyXG4gICAgYmFja2dyb3VuZDogI2VjZWNlYztcclxuICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgIGJvcmRlcjogMXB4IHNvbGlkICNlY2VjZWMgIWltcG9ydGFudDtcclxuICAgIGNvbG9yOiAjOTk5ICFpbXBvcnRhbnQ7XHJcbiAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICB9XHJcbiAgLnByZXZpb3VzIHtcclxuICAgIEBleHRlbmQgLnNhdmVhbmRuZXh0O1xyXG4gICAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XHJcbiAgICBmb250LXNpemU6IDE1cHggIWltcG9ydGFudDtcclxuICAgIG1hcmdpbi1yaWdodDogMTVweDtcclxuICAgIHdpZHRoOiBhdXRvO1xyXG4gIH1cclxuICAudmlld2luZ2NvbnRyb2xzIHtcclxuICAgIC5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAgIHdpZHRoOiA5MHB4O1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICA6Om5nLWRlZXAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgcGFkZGluZzogMCAhaW1wb3J0YW50O1xyXG4gICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuc2hvd2ZpbHRlcmFuZGFkZGl0ZW0gYnV0dG9uIHtcclxuICAgIGZvbnQtc2l6ZTogMTRweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSB7XHJcbiAgICAuY2xvc2VhbmRhZGQge1xyXG4gICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgIH1cclxuICAgIGhlaWdodDogNTZweDtcclxuICAgIC50aXRsZXRleHQge1xyXG4gICAgICBAaW5jbHVkZSBzcGFjZWJldHdlZW4oKTtcclxuICAgICAgcGFkZGluZzogMTBweDtcclxuICAgIH1cclxuICAgIC5jbGVhcmFuZGFkZGJ1dHRvbiB7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgICAuY2xlYXJidXR0b24ge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICMwMDZjYjc7XHJcbiAgICAgIH1cclxuICAgICAgLmFkZGJ1dHRvbiB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogIzI4YjhlNztcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICA6Om5nLWRlZXAubWF0LWRyYXdlci1iYWNrZHJvcCB7XHJcbiAgICBwb3NpdGlvbjogZml4ZWQ7XHJcbiAgfVxyXG4gIC5jb21wYW55aW5mb21jcCB7XHJcbiAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgXHJcbiAgICBpbWcge1xyXG4gICAgICB3aWR0aDogNDRweDtcclxuICAgICAgaGVpZ2h0OiA0NHB4O1xyXG4gICAgfVxyXG4gICAgLmx5cGlzaWQge1xyXG4gICAgICBjb2xvcjogIzY2NjY2NjtcclxuICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgfVxyXG4gICAgcCB7XHJcbiAgICAgIG1hcmdpbjogMDtcclxuICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgIGNvbG9yOiAjMDAwO1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAuYm9yZGVyYm90dG9tIHtcclxuICAgIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgcGFkZGluZy1ib3R0b206IDVweDtcclxuICB9XHJcbiAgLmlubm5lcnBhcnRvZmRyd2VyIHtcclxuICAgIHBhZGRpbmctdG9wOiAyNXB4O1xyXG4gICAgcGFkZGluZy1sZWZ0OiA3NXB4ICFpbXBvcnRhbnQ7XHJcbiAgICBwYWRkaW5nLXJpZ2h0OiA3NXB4ICFpbXBvcnRhbnQ7XHJcbiAgICBwYWRkaW5nLWJvdHRvbTogNDVweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBcclxuICA6Om5nLWRlZXAubWF0LXNlbGVjdC1wYW5lbCB7XHJcbiAgICBtYXgtaGVpZ2h0OiA0MDBweDtcclxuICB9XHJcbiAgOjpuZy1kZWVwLm1hdC1vcHRpb246aG92ZXI6bm90KC5tYXQtb3B0aW9uLWRpc2FibGVkKSxcclxuICA6Om5nLWRlZXAgLm1hdC1vcHRpb246Zm9jdXM6bm90KC5tYXQtb3B0aW9uLWRpc2FibGVkKSxcclxuICA6Om5nLWRlZXAubWF0LW9wdGlvbi5tYXQtc2VsZWN0ZWQ6bm90KC5tYXQtb3B0aW9uLWRpc2FibGVkKSB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjY2JkY2Y5ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIDo6bmctZGVlcC5tYXQtb3B0aW9uLm1hdC1hY3RpdmUge1xyXG4gICAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XHJcbiAgfVxyXG4gIFxyXG4gIFxyXG4gIC5uZXh0YnV0dG9uIHtcclxuICAgIGNvbG9yOiB3aGl0ZSAhaW1wb3J0YW50O1xyXG4gICAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIFxyXG4gIC5jZXJ0aWZpY2F0ZXMge1xyXG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICA6aG9zdCA6Om5nLWRlZXAubWFzdGVyY29tcG5heWNvbnRlbnQgLmNvbW1vbmV4cGFuZGFuZGNvbGxhcHNlIC5tYXQtZXhwYW5zaW9uLXBhbmVsLWJvZHkge1xyXG4gICAgcGFkZGluZzogMTBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBcclxuICAuY2VydGl0aWNhdGVjb3VudHMge1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1ldmVubHk7XHJcbiAgICBwIHtcclxuICAgICAgY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICB9XHJcbiAgXHJcbiAgICAuYWRkYnV0dG9uIHtcclxuICAgICAgYmFja2dyb3VuZDogIzAwNmNiNztcclxuICAgICAgZm9udC1zaXplOiAxNHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLmNlcnRpZmljYXRlaW5mbyB7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDIwcHg7XHJcbiAgICBwIHtcclxuICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICBjb2xvcjogIzAwMDtcclxuICAgICAgcGFkZGluZy1ib3R0b206IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuY2VybGFiZWwge1xyXG4gICAgICBjb2xvcjogIzk5OTtcclxuICAgIH1cclxuICAgIC5oZWFkZXIge1xyXG4gICAgICBjb2xvcjogIzMzMztcclxuICAgICAgZm9udC1zaXplOiAxLjEyNXJlbTtcclxuICAgICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICAgIHBhZGRpbmctYm90dG9tOiAxNXB4O1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICAucHJpbWFyeW9mZmljZWluZm8ge1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICAub2ZmaWNlYnVpbGRpbmcge1xyXG4gICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgICAgcGFkZGluZzogMjBweDtcclxuICAgICAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgICAuYWRkcmVzc2xhYmVsIHtcclxuICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgIGZvbnQtc2l6ZTogMTFweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIFxyXG4gICAge1xyXG4gICAgICB3aWR0aDogY2FsYygxMDAlIC0gNjVweCk7XHJcbiAgICAgIC5uYW1lIHtcclxuICAgICAgICBjb2xvcjogIzAwNmNiNztcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAuY29tcGFueWFuZG9mZmljZWluZm8ge1xyXG4gICAgd2lkdGg6IGNhbGMoMTAwJSAtIDY1cHgpO1xyXG4gICAgcCB7XHJcbiAgICAgIG1hcmdpbjogMDtcclxuICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICB9XHJcbiAgICAuY3JhbmRicmFuY2hpZHMge1xyXG4gICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgICAgcGFkZGluZy10b3A6IDEwcHg7XHJcbiAgICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gICAgICAuY291bnQge1xyXG4gICAgICAgIGZvbnQtZmFtaWx5OiAnY2Fpcm9zZW1pYm9sZCc7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgIC50aXRsZSB7XHJcbiAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICAgIG1hcmdpbjogMDtcclxuICAgICAgbGluZS1oZWlnaHQ6IDAuOTtcclxuICAgICAgcGFkZGluZy1ib3R0b206IDZweDtcclxuICAgIH1cclxuICAgIC5sYWJsZW5hbWUge1xyXG4gICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICB9XHJcbiAgICAubmFtZSB7XHJcbiAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICBmb250LXNpemU6IDFyZW07XHJcbiAgICAgIG1hcmdpbjogMDtcclxuICAgICAgbGluZS1oZWlnaHQ6IDE4cHg7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5vZmZpY2VhZGRyZXNzZGV0YWlsIHtcclxuICAgIHBhZGRpbmctdG9wOiAyMHB4O1xyXG4gIFxyXG4gICAgLmFkZHJlc3NpbmZvIHtcclxuICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5jb250YWN0YW5kd2Vic2l0ZSB7XHJcbiAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICBwYWRkaW5nLXRvcDogMjBweDtcclxuICAgIHAge1xyXG4gICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgcGFkZGluZy1ib3R0b206IDVweDtcclxuICAgIH1cclxuICAgIC5jb250YWN0IHtcclxuICAgICAgcGFkZGluZy1yaWdodDogMjBweDtcclxuICAgIH1cclxuICAgIC53ZWJpc3RlIHtcclxuICAgICAgcGFkZGluZy1sZWZ0OiAyMHB4O1xyXG4gICAgfVxyXG4gIH1cclxuICAuY29udGFjdGRldGFpbHMge1xyXG4gICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICBwYWRkaW5nLXRvcDogMTVweDtcclxuICAgIGRpdiB7XHJcbiAgICAgIHBhZGRpbmctcmlnaHQ6IDMwcHg7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgICBpIHtcclxuICAgICAgICBjb2xvcjogIzlhOWE5YTtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xyXG4gICAgICB9XHJcbiAgICAgIHNwYW4ge1xyXG4gICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLmNvbXBhbnlkZXRhaWx3aXRoZmxhZyB7XHJcbiAgICBAaW5jbHVkZSBzcGFjZWJldHdlZW4oKTtcclxuICB9XHJcbiAgLmNlcnRpZmljYXRlaW1hZ2Uge1xyXG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgd2lkdGg6IDY1cHg7XHJcbiAgICBoZWlnaHQ6IDY1cHg7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZTBmMGZmO1xyXG4gICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgaSB7XHJcbiAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICBmb250LXNpemU6IDEuNTYyNXJlbTtcclxuICAgIH1cclxuICB9XHJcbiAgLmNvdW50cnlhbmRjcmluZm8ge1xyXG4gICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICBwYWRkaW5nLXRvcDogMTBweDtcclxuICAgIC5lYWNoaXRlbSB7XHJcbiAgICAgIHBhZGRpbmctcmlnaHQ6IDI1cHg7XHJcbiAgICAgIC5sYWJsZW5hbWUge1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICAgIGltZyB7XHJcbiAgICAgICAgd2lkdGg6IDIycHg7XHJcbiAgICAgIH1cclxuICAgICAgJjpsYXN0LWNoaWxkIHtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwO1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG4gIFxyXG4gIC5zZWFyY2hpdGVtYmVsb3cge1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgaGVpZ2h0OiA1MHB4O1xyXG4gICAgaW5wdXQge1xyXG4gICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICBib3JkZXI6IG5vbmU7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5QYXltZW50Y29udGFjdGhlYWQge1xyXG4gICAgcCB7XHJcbiAgICAgIGNvbG9yOiByZWQ7XHJcbiAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgfVxyXG4gIH1cclxuICA6Om5nLWRlZXAuc2V0Y291bnRyeWZsYWcge1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICB9XHJcbiAgLmZsYWdpbWFnZSBpbWcge1xyXG4gICAgbWF4LXdpZHRoOiAyNHB4O1xyXG4gIH1cclxuICBcclxuICA6Om5nLWRlZXAuY291bnRyeW5hbWVzZWxlY3Qge1xyXG4gICAgLm1hdC1vcHRpb24tdGV4dCB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgIGltZyB7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogMTBweDtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAubWFwd2lkdGgge1xyXG4gICAgaW1nIHtcclxuICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5wcm9maWxlbGlua2JveHNoYWRvdyB7XHJcbiAgICBib3gtc2hhZG93OiAwIDAgNXB4ICNkZGQ7XHJcbiAgICB3aWR0aDogMTAwJTtcclxuICAgIHBhZGRpbmctbGVmdDogN3B4O1xyXG4gICAgcGFkZGluZy1yaWdodDogN3B4O1xyXG4gIH1cclxuICAuYm9yZGVyZmxleCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgIG1pbi1oZWlnaHQ6IDQ1cHg7XHJcbiAgICBwYWRkaW5nLXRvcDogNXB4O1xyXG4gIH1cclxuICAucGRmdmlldyB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxuICAuU2VhcmNoIHtcclxuICAgIHAge1xyXG4gICAgICBjb2xvcjogI2E5YTlhOTtcclxuICAgIH1cclxuICB9XHJcbiAgLlNlYXJjaGNvbG9yIHtcclxuICAgIGNvbG9yOiAjYTlhOWE5O1xyXG4gIH1cclxuICAuY2VydGlmaWNhdGVib3JkZXIge1xyXG4gICAgYm9yZGVyOiAxcHggZGFzaGVkICNiM2IzYjMgIWltcG9ydGFudDtcclxuICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgaGVpZ2h0OiA2MHB4O1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgYmFja2dyb3VuZDogI2YzZjRmNjtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgXHJcbiAgICAuZmlsZWhlcmVjb2xvciB7XHJcbiAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgfVxyXG4gICAgLmFkZGZpbGVjb2xvciB7XHJcbiAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgfVxyXG4gICAgLnVwbG9hZHBkZiB7XHJcbiAgICAgIGNvbG9yOiAjOTg5ODk4O1xyXG4gICAgICBwIHtcclxuICAgICAgICBjb2xvcjogIzk4OTg5ODtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAucGRmYmFja2dyb3VuZCB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWRmM2ZmO1xyXG4gIH1cclxuICAudGV4dGNvbG9yIHtcclxuICAgIGNvbG9yOiAjMDA2Y2I3ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5kZWxldGVmbGV4ZW5kIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICB9XHJcbiAgLmJvcmRlciB7XHJcbiAgICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcclxuICAgIHdpZHRoOiA5NiUgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLmZsZXhvbWFuIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgLyogd2lkdGg6IDE5MHB4OyAqL1xyXG4gICAgc3BhbiB7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICBtYXJnaW4tbGVmdDo0cHg7IFxyXG4gICAgfVxyXG4gIH1cclxuICAuZmxleHNlcmFjaCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICB9XHJcbiAgLmljb25zdHlsZSB7XHJcbiAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgY29sb3I6ICMwMDZjYjc7XHJcbiAgfVxyXG4gIC5zdGFydCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIG1hcmdpbi1sZWZ0OiAwcHg7XHJcbiAgfVxyXG4gIC5zZWFyY2hpbmZvIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgIGhlaWdodDogMzRweDtcclxuICB9XHJcbiAgXHJcbiAgLnBkZmltYWdlIHtcclxuICAgIHdpZHRoOiAxNHB4O1xyXG4gICAgaGVpZ2h0OiAxNHB4O1xyXG4gIH1cclxuICAucHJvcGVydHl0eXBlIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgfVxyXG4gIEBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xyXG4gICAgLmNvdW50cnlhbmRjcmluZm8ge1xyXG4gICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAuZWFjaGl0ZW0ge1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAxNXB4O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICAuY2VydGlmaWNhdGVzIHtcclxuICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgICAuY29tcGFueWFuZG9mZmljZWluZm8ge1xyXG4gICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvciB7XHJcbiAgICAgIGRpc3BsYXk6IGNvbnRlbnRzO1xyXG4gICAgfVxyXG4gICAgLmNyZWF0ZXJlc29sdXRpb24ge1xyXG4gICAgICBwYWRkaW5nLXRvcDogNDJweDtcclxuICAgIH1cclxuICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIHtcclxuICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAudGl0bGV0ZXh0IHtcclxuICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbG9zZWFuZGFkZCB7XHJcbiAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICB9XHJcbiAgXHJcbiAgXHJcbiAgICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAudGl0bGV0ZXh0IC5iZ2ktaW5mbyB7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgICAgbWFyZ2luLWxlZnQ6IDRweDtcclxuICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICB0b3A6IC0xcHg7XHJcbiAgICB9XHJcbiAgXHJcbiAgICAuc2VhcmNoaW5mbyB7XHJcbiAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5oZWlnaHQtMzUge1xyXG4gICAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgXHJcbiAgICA6Om5nLWRlZXAubWFzdGVyUGFnZSAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgIG1hcmdpbjogMCAzMnB4IDAgMTJweDtcclxuICAgICAgZGlzcGxheTogY29udGVudHMgIWltcG9ydGFudDtcclxuICAgICAgZm9udC1zaXplOiAxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgfVxyXG4gIEBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xyXG4gICAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgIG1hcmdpbjogMCAzMnB4IDAgMTJweDtcclxuICAgICAgY29sb3I6IGJsYWNrO1xyXG4gICAgICBtYXJnaW4tcmlnaHQ6IC02cHg7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgIH1cclxuICAgIDo6bmctZGVlcC5tYXN0ZXJQYWdlIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZSB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBiYXNlbGluZTtcclxuICAgICAgbWFyZ2luLXJpZ2h0OiAwcHg7XHJcbiAgICB9XHJcbiAgICA6Om5nLWRlZXAubWFzdGVyYm90dG9tIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xyXG4gICAgICBkaXNwbGF5OiBjb250ZW50cztcclxuICAgIH1cclxuICAgIDo6bmctZGVlcC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgfVxyXG4gICAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgIH1cclxuICBcclxuICAgIDo6bmctZGVlcC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgICAgbWluLWhlaWdodDogNTZweDtcclxuICAgICAgcGFkZGluZzogMHB4O1xyXG4gICAgICBmbGV4LXdyYXA6IHdyYXAtcmV2ZXJzZTtcclxuICAgICAgd2lkdGg6IDI2MXB4O1xyXG4gICAgfVxyXG4gIH1cclxuICBAbWVkaWEgKG1heC13aWR0aDogMzIwcHgpIHtcclxuICAgIDo6bmctZGVlcC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgIGRpc3BsYXk6IGNvbnRlbnRzO1xyXG4gICAgfVxyXG4gICAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xyXG4gICAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICB9XHJcbiAgICA6Om5nLWRlZXAubWFzdGVyYm90dG9tIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgfVxyXG4gIH1cclxuICBAbWVkaWEgKG1pbi13aWR0aDogMzYwcHgpIHtcclxuICAgIDo6bmctZGVlcC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgIGRpc3BsYXk6IGNvbnRlbnRzO1xyXG4gICAgfVxyXG4gIFxyXG4gIH1cclxuICBAbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAgIC5jZXJ0aWZpY2F0ZXMge1xyXG4gICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIH1cclxuICBcclxuICAgIC5zZWFyY2hpbmZvIHtcclxuICAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIH1cclxuICBcclxuICBAbWVkaWEgKG1heC13aWR0aDogMTkyMHB4KSBhbmQgKG1pbi13aWR0aDogMTA4MHB4KSB7XHJcbiAgICAud2lkdGgge1xyXG4gICAgICBtYXgtd2lkdGg6IDcwJSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLndpZHRoc2Vjb25kIHtcclxuICAgICAgbWF4LXdpZHRoOiAzMCUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICB9XHJcbiAgLndpZHRoZmlsZWQge1xyXG4gICAgd2lkdGg6IDYwJTtcclxuICB9XHJcbiAgXHJcbiAgXHJcbiAgLmVhY2hpdGVtIHtcclxuICAgIG1pbi13aWR0aDogMjAwcHg7XHJcbiAgICBtYXgtd2lkdGg6IDIwMHB4O1xyXG4gIH1cclxuICBcclxuICAudG9vbHRpcHdpZHRoe1xyXG4gICAgICB3aWR0aDogNTBweDtcclxuICB9XHJcbiAgLnR4dC02e1xyXG4gICAgY29sb3I6ICM2NjY7XHJcbn1cclxuLnctMTUwe1xyXG4gICAgd2lkdGg6IDI1cHg7XHJcbn1cclxuLnBhZ2VudW1iZXJpbnByb2ZpbGUge1xyXG4gIGJvcmRlcjogMXB4IHNvbGlkICNmZmY7XHJcbmhlaWdodDogMjBweDtcclxubWluLXdpZHRoOiAyMHB4O1xyXG5jb2xvcjogI2ZmZjtcclxuYm9yZGVyLXJhZGl1czogMTBweCAvIDExcHg7XHJcbmJhY2tncm91bmQ6ICMyYjdkYjU7XHJcbmZvbnQtc2l6ZTogMC43NXJlbTtcclxud2lkdGg6IGF1dG87XHJcbnBhZGRpbmc6IDAgNnB4O1xyXG4gIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICBtYXJnaW4tcmlnaHQ6IDEwcHg7XHJcbn1cclxuLmNvbXBsZXRlZCB7XHJcbiAgYmFja2dyb3VuZDogIzcxYzExNDtcclxufVxyXG4uY2VydGl0aWNhdGVjb3VudHMge1xyXG4gICAgaGVpZ2h0OiAzNHB4O1xyXG4gICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICBwIHtcclxuICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICB9XHJcbiAgXHJcbiAgICAuYWRkYnV0dG9uIHtcclxuICAgICAgYmFja2dyb3VuZDogIzAwNmNiNztcclxuICAgICAgZm9udC1zaXplOiAxNHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgIH1cclxuICB9XHJcbiAgLmluc2lkZWhlYWRlciB7XHJcbiAgICBjb2xvcjogIzAwNmNiNztcclxuICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICBtYXJnaW46IDA7XHJcbiAgICBwYWRkaW5nLXRvcDogMjVweDtcclxuICAgIHBhZGRpbmctYm90dG9tOiAxNXB4O1xyXG4gIH1cclxuICAgICBcclxuICAuc2F2ZWFuZG5leHQge1xyXG4gICAgYmFja2dyb3VuZDogI2VjZWNlYztcclxuICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgIGJvcmRlcjogMXB4IHNvbGlkICNlY2VjZWMgIWltcG9ydGFudDtcclxuICAgIGNvbG9yOiAjOTk5ICFpbXBvcnRhbnQ7XHJcbiAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgIG1pbi13aWR0aDogMTIwcHg7XHJcbiAgfVxyXG4gIC5wcmV2aW91cyB7XHJcbiAgICBAZXh0ZW5kIC5zYXZlYW5kbmV4dDtcclxuICAgIGJhY2tncm91bmQ6IHRyYW5zcGFyZW50O1xyXG4gICAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICBtYXJnaW4tcmlnaHQ6IDE1cHg7XHJcbiAgICB3aWR0aDogYXV0bztcclxuICB9XHJcbi50eHQtdHJvcGF6IHtcclxuY29sb3I6ICMwMDZjYjcgIWltcG9ydGFudDtcclxufVxyXG4uY29tbW9uZXhwYW5kYW5kY29sbGFwc2UgLnRyaWdnZXJlZHRvI2N1c3QxICBtYXQtZXhwYW5zaW9uLXBhbmVsLm1hdC1leHBhbmRlZHtcclxubWFyZ2luLWJvdHRvbTogMHB4ICFpbXBvcnRhbnQ7XHJcbm1hcmdpbi10b3A6IDMwcHggIWltcG9ydGFudDtcclxufVxyXG4uY2VydGlmaWNhdGVpbWFnZSB7XHJcbiAgd2lkdGg6IDg1cHggIWltcG9ydGFudDtcclxufVxyXG4uYWRkZWRjZXJ0aWZpY2F0ZXtcclxuICAmOmhvdmVye1xyXG4gICAgLmhlYWRlcixoNSB7XHJcbiAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgfVxyXG4gIH1cclxufVxyXG4ucmVkVHh0e1xyXG4gIGNvbG9yOiAjZjQ4MTFmO1xyXG4gIGN1cnNvcjogcG9pbnRlcjtcclxufVxyXG4ucm95YWx7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OnNwYWNlLWJldHdlZW47XHJcbn1cclxuLmNlcnRpZmljYXRlaWNvbntcclxuICB6LWluZGV4OiAxO1xyXG4gIGhlaWdodDogODVweDtcclxuICB3aWR0aDogODVweDtcclxuICBkaXNwbGF5OiBmbGV4O1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gIGJhY2tncm91bmQtY29sb3I6ICNlMGYwZmY7XHJcbiAgYm9yZGVyLXJhZGl1czogM3B4O1xyXG4gIGl7XHJcbiAgICAgIGNvbG9yOiMwMDZjYjc7XHJcbiAgICAgIGZvbnQtc2l6ZTogMi41cmVtO1xyXG4gICAgICBwYWRkaW5nLWxlZnQ6IDI1cHg7XHJcbiAgfVxyXG59XHJcbi5jYW5jZWxhbmRwdWJsaXNoIHtcclxuICAuY2FuY2VsIHtcclxuICAgIGhlaWdodDogNDVweDtcclxuICAgIGNvbG9yOiAjNzc3O1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI2NiY2JjYjtcclxuICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAucHVibGlzaCB7XHJcbiAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICB9XHJcbn0iLCJpbWdbc3JjPW51bGxdIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cblxuaW1nW3NyYz1cIltvYmplY3QgU3RvcmFnZV1cIl0ge1xuICBkaXNwbGF5OiBub25lO1xufVxuXG4udy01MCB7XG4gIHdpZHRoOiA1MCU7XG59XG5cbi5pbmZvcm1hdGlvbiB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBibG9jaztcbiAgbWFyZ2luOiAwO1xufVxuLmluZm9ybWF0aW9uIC5pbmZvIHtcbiAgcGFkZGluZzogMTVweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xufVxuLmluZm9ybWF0aW9uIC5pbmZvIGEge1xuICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcbn1cblxuLm1hdC1idXR0b24tdG9nZ2xlLWNoZWNrZWQge1xuICBiYWNrZ3JvdW5kOiAjMmRiZTU1O1xuICBjb2xvcjogI2ZmZjtcbn1cblxuLmRvY3VtZW50c3JvdyB7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cblxubWF0LW9wdGlvblthcmlhLWxhYmVsXSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgY29sb3I6ICMzMzMgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA1MHB4O1xuICBwYWRkaW5nLXRvcDogMHB4O1xuICBwYWRkaW5nLWJvdHRvbTogMTVweDtcbn1cbm1hdC1vcHRpb25bYXJpYS1sYWJlbF06OmFmdGVyIHtcbiAgY29udGVudDogYXR0cihhcmlhLWxhYmVsKTtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBib3R0b206IC01cHg7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbiAgY29sb3I6ICM2NjY2NjY7XG59XG5cbi5tYXQtdGFiLWJvZHktY29udGVudDo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogMC41ZW07XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgcmlnaHQ6IDA7XG59XG5cbi5tYXQtdGFiLWJvZHktY29udGVudDo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjYjhjM2NiO1xufVxuXG4ub3JnYW5pc2F0aW9uaW5mbyB7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG59XG5cbiNtYXN0ZXJjb21wYW55ZGV0YWlsIC5ib3JkZXJjbGFzcyB7XG4gIGJvcmRlcjogNXB4IHNvbGlkICMwMDZjYjc7XG59XG5cbi50b3BoZWFkZXJtYWluIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuLnRvcGhlYWRlcm1haW4gLmltYWdld2l0aHRleHQge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cblxuLmNhbmNlbGFuZHB1Ymxpc2ggLmNhbmNlbCB7XG4gIGhlaWdodDogNDVweDtcbiAgY29sb3I6ICM3Nzc7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNjYmNiY2I7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xufVxuLmNhbmNlbGFuZHB1Ymxpc2ggLnB1Ymxpc2gge1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xufVxuXG4ubWF0LWZvcm0tZmllbGQge1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cblxuOjpuZy1kZWVwLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgYm9yZGVyLXRvcDogMC41NDM3NWVtIHNvbGlkIHRyYW5zcGFyZW50O1xufVxuXG46OnNsb3R0ZWQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKDAsIDAsIDAsIDAuMjIpO1xufVxuXG4ucHJvZmlsZWNvbXBsZXRlbmVzcyBwIHtcbiAgY29sb3I6ICNmZmY7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbn1cbi5wcm9maWxlY29tcGxldGVuZXNzIC5tYXQtcHJvZ3Jlc3MtYmFyIHtcbiAgd2lkdGg6IDE5MHB4O1xuICBtYXJnaW4tYm90dG9tOiAxNXB4O1xufVxuXG46Om5nLWRlZXAubWF0LXByb2dyZXNzLWJhci1maWxsOjphZnRlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICM3MWMwMTUgIWltcG9ydGFudDtcbn1cblxuLnByb2dyZXNzYW5kaGlzdG9yeSB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLWJvdHRvbTogMTBweDtcbn1cblxuLnBhZ2VudW1iZXJpbnByb2ZpbGUge1xuICBib3JkZXI6IDFweCBzb2xpZCAjZmZmO1xuICBoZWlnaHQ6IDIwcHg7XG4gIG1pbi13aWR0aDogMjBweDtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDEwcHgvMTFweDtcbiAgYmFja2dyb3VuZDogIzJiN2RiNTtcbiAgZm9udC1zaXplOiAwLjc1cmVtO1xuICB3aWR0aDogYXV0bztcbiAgcGFkZGluZzogMCA2cHg7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBtYXJnaW4tcmlnaHQ6IDEwcHg7XG59XG5cbi5jb21wbGV0ZWQge1xuICBiYWNrZ3JvdW5kOiAjNzFjMTE0O1xufVxuXG4uY2lyY2xlY29sb3Ige1xuICBiYWNrZ3JvdW5kOiAjNzFjMTE0O1xufVxuXG4ubWF0LXNlbGVjdC1wYW5lbCB7XG4gIGJvcmRlci1yYWRpdXM6IDA7XG59XG5cbi5tYXQtb3B0aW9uW2FyaWEtZGlzYWJsZWQ9dHJ1ZV0ge1xuICBiYWNrZ3JvdW5kOiAjMDA2Y2I3O1xuICBjb2xvcjogI2ZmZjtcbiAgaGVpZ2h0OiAzNXB4O1xufVxuXG4uYWNjcm9kaWFuaGVhZGVyIC5oZWFkZXIge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG5cbi51cGxvYWRhbmRjb21wbmF5aW5mbyB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG5cbi5kcm9wZmlsZXNoZXJldG9hZGQge1xuICBwYWRkaW5nOiA1cHg7XG4gIGJvcmRlcjogMXB4IGRhc2hlZCAjOTk5O1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4uZHJvcGZpbGVzaGVyZXRvYWRkIGRpdiB7XG4gIGJhY2tncm91bmQ6ICNmM2Y0ZjY7XG4gIGhlaWdodDogNDVweDtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4uZHJvcGZpbGVzaGVyZXRvYWRkIGRpdiBwIHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIG1hcmdpbjogMDtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9zZW1pYm9sZFwiO1xufVxuLmRyb3BmaWxlc2hlcmV0b2FkZCBkaXYgcCBzcGFuIHtcbiAgY29sb3I6ICMwMDZjYjc7XG59XG5cbi5zYXZlYW5kbmV4dCwgLnByZXZpb3VzIHtcbiAgYmFja2dyb3VuZDogI2VjZWNlYztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZWNlY2VjICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjOTk5ICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuXG4ucHJldmlvdXMge1xuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcbiAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1yaWdodDogMTVweDtcbiAgd2lkdGg6IGF1dG87XG59XG5cbi52aWV3aW5nY29udHJvbHMgLm1hdC1mb3JtLWZpZWxkIHtcbiAgd2lkdGg6IDkwcHg7XG59XG5cbjo6bmctZGVlcC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDAgIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG59XG5cbi5zaG93ZmlsdGVyYW5kYWRkaXRlbSBidXR0b24ge1xuICBmb250LXNpemU6IDE0cHggIWltcG9ydGFudDtcbn1cblxuLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2Uge1xuICBoZWlnaHQ6IDU2cHg7XG59XG4uc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAuY2xvc2VhbmRhZGQge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4uc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAudGl0bGV0ZXh0IHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBwYWRkaW5nOiAxMHB4O1xufVxuLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsZWFyYW5kYWRkYnV0dG9uIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsZWFyYW5kYWRkYnV0dG9uIC5jbGVhcmJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6ICMwMDZjYjc7XG59XG4uc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAuY2xlYXJhbmRhZGRidXR0b24gLmFkZGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6ICMyOGI4ZTc7XG59XG5cbjo6bmctZGVlcC5tYXQtZHJhd2VyLWJhY2tkcm9wIHtcbiAgcG9zaXRpb246IGZpeGVkO1xufVxuXG4uY29tcGFueWluZm9tY3Age1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG59XG4uY29tcGFueWluZm9tY3AgaW1nIHtcbiAgd2lkdGg6IDQ0cHg7XG4gIGhlaWdodDogNDRweDtcbn1cbi5jb21wYW55aW5mb21jcCAubHlwaXNpZCB7XG4gIGNvbG9yOiAjNjY2NjY2O1xuICBmb250LXNpemU6IDAuNzVyZW07XG59XG4uY29tcGFueWluZm9tY3AgcCB7XG4gIG1hcmdpbjogMDtcbiAgbGluZS1oZWlnaHQ6IDE7XG4gIGNvbG9yOiAjMDAwO1xufVxuXG4uYm9yZGVyYm90dG9tIHtcbiAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkZGQ7XG4gIHBhZGRpbmctYm90dG9tOiA1cHg7XG59XG5cbi5pbm5uZXJwYXJ0b2ZkcndlciB7XG4gIHBhZGRpbmctdG9wOiAyNXB4O1xuICBwYWRkaW5nLWxlZnQ6IDc1cHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogNzVweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWJvdHRvbTogNDVweCAhaW1wb3J0YW50O1xufVxuXG46Om5nLWRlZXAubWF0LXNlbGVjdC1wYW5lbCB7XG4gIG1heC1oZWlnaHQ6IDQwMHB4O1xufVxuXG46Om5nLWRlZXAubWF0LW9wdGlvbjpob3Zlcjpub3QoLm1hdC1vcHRpb24tZGlzYWJsZWQpLFxuOjpuZy1kZWVwIC5tYXQtb3B0aW9uOmZvY3VzOm5vdCgubWF0LW9wdGlvbi1kaXNhYmxlZCksXG46Om5nLWRlZXAubWF0LW9wdGlvbi5tYXQtc2VsZWN0ZWQ6bm90KC5tYXQtb3B0aW9uLWRpc2FibGVkKSB7XG4gIGJhY2tncm91bmQ6ICNjYmRjZjkgIWltcG9ydGFudDtcbn1cblxuOjpuZy1kZWVwLm1hdC1vcHRpb24ubWF0LWFjdGl2ZSB7XG4gIGJhY2tncm91bmQ6IHRyYW5zcGFyZW50O1xufVxuXG4ubmV4dGJ1dHRvbiB7XG4gIGNvbG9yOiB3aGl0ZSAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcbn1cblxuLmNlcnRpZmljYXRlcyB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbn1cblxuOmhvc3QgOjpuZy1kZWVwLm1hc3RlcmNvbXBuYXljb250ZW50IC5jb21tb25leHBhbmRhbmRjb2xsYXBzZSAubWF0LWV4cGFuc2lvbi1wYW5lbC1ib2R5IHtcbiAgcGFkZGluZzogMTBweCAhaW1wb3J0YW50O1xufVxuXG4uY2VydGl0aWNhdGVjb3VudHMge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWV2ZW5seTtcbn1cbi5jZXJ0aXRpY2F0ZWNvdW50cyBwIHtcbiAgY29sb3I6ICMwMDZjYjc7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4uY2VydGl0aWNhdGVjb3VudHMgLmFkZGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6ICMwMDZjYjc7XG4gIGZvbnQtc2l6ZTogMTRweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cblxuLmNlcnRpZmljYXRlaW5mbyB7XG4gIHBhZGRpbmctbGVmdDogMjBweDtcbn1cbi5jZXJ0aWZpY2F0ZWluZm8gcCB7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIG1hcmdpbjogMDtcbiAgY29sb3I6ICMwMDA7XG4gIHBhZGRpbmctYm90dG9tOiAxMHB4O1xufVxuLmNlcnRpZmljYXRlaW5mbyAuY2VybGFiZWwge1xuICBjb2xvcjogIzk5OTtcbn1cbi5jZXJ0aWZpY2F0ZWluZm8gLmhlYWRlciB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDEuMTI1cmVtO1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgcGFkZGluZy1ib3R0b206IDE1cHg7XG59XG5cbi5wcmltYXJ5b2ZmaWNlaW5mbyB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5wcmltYXJ5b2ZmaWNlaW5mbyAub2ZmaWNlYnVpbGRpbmcge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDIwcHg7XG4gIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMDAlO1xufVxuLnByaW1hcnlvZmZpY2VpbmZvIC5hZGRyZXNzbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxMXB4ICFpbXBvcnRhbnQ7XG59XG4ucHJpbWFyeW9mZmljZWluZm8gLmNvbXBhbnlhbmRvZmZpY2VpbmZvIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDY1cHgpO1xufVxuLnByaW1hcnlvZmZpY2VpbmZvIC5jb21wYW55YW5kb2ZmaWNlaW5mbyAubmFtZSB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xufVxuXG4uY29tcGFueWFuZG9mZmljZWluZm8ge1xuICB3aWR0aDogY2FsYygxMDAlIC0gNjVweCk7XG4gIHBhZGRpbmctbGVmdDogMjBweDtcbn1cbi5jb21wYW55YW5kb2ZmaWNlaW5mbyBwIHtcbiAgbWFyZ2luOiAwO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5jb21wYW55YW5kb2ZmaWNlaW5mbyAuY3JhbmRicmFuY2hpZHMge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctdG9wOiAxMHB4O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbi5jb21wYW55YW5kb2ZmaWNlaW5mbyAuY3JhbmRicmFuY2hpZHMgLmNvdW50IHtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9zZW1pYm9sZFwiO1xufVxuLmNvbXBhbnlhbmRvZmZpY2VpbmZvIC50aXRsZSB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDAuNzVyZW07XG4gIG1hcmdpbjogMDtcbiAgbGluZS1oZWlnaHQ6IDAuOTtcbiAgcGFkZGluZy1ib3R0b206IDZweDtcbn1cbi5jb21wYW55YW5kb2ZmaWNlaW5mbyAubGFibGVuYW1lIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuLmNvbXBhbnlhbmRvZmZpY2VpbmZvIC5uYW1lIHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbiAgbWFyZ2luOiAwO1xuICBsaW5lLWhlaWdodDogMThweDtcbn1cblxuLm9mZmljZWFkZHJlc3NkZXRhaWwge1xuICBwYWRkaW5nLXRvcDogMjBweDtcbn1cbi5vZmZpY2VhZGRyZXNzZGV0YWlsIC5hZGRyZXNzaW5mbyB7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuXG4uY29udGFjdGFuZHdlYnNpdGUge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctdG9wOiAyMHB4O1xufVxuLmNvbnRhY3RhbmR3ZWJzaXRlIHAge1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgcGFkZGluZy1ib3R0b206IDVweDtcbn1cbi5jb250YWN0YW5kd2Vic2l0ZSAuY29udGFjdCB7XG4gIHBhZGRpbmctcmlnaHQ6IDIwcHg7XG59XG4uY29udGFjdGFuZHdlYnNpdGUgLndlYmlzdGUge1xuICBwYWRkaW5nLWxlZnQ6IDIwcHg7XG59XG5cbi5jb250YWN0ZGV0YWlscyB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgcGFkZGluZy10b3A6IDE1cHg7XG59XG4uY29udGFjdGRldGFpbHMgZGl2IHtcbiAgcGFkZGluZy1yaWdodDogMzBweDtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmNvbnRhY3RkZXRhaWxzIGRpdiBpIHtcbiAgY29sb3I6ICM5YTlhOWE7XG4gIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG59XG4uY29udGFjdGRldGFpbHMgZGl2IHNwYW4ge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbn1cblxuLmNvbXBhbnlkZXRhaWx3aXRoZmxhZyB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cblxuLmNlcnRpZmljYXRlaW1hZ2Uge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHdpZHRoOiA2NXB4O1xuICBoZWlnaHQ6IDY1cHg7XG4gIGJhY2tncm91bmQ6ICNlMGYwZmY7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmNlcnRpZmljYXRlaW1hZ2UgaSB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xuICBmb250LXNpemU6IDEuNTYyNXJlbTtcbn1cblxuLmNvdW50cnlhbmRjcmluZm8ge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctdG9wOiAxMHB4O1xufVxuLmNvdW50cnlhbmRjcmluZm8gLmVhY2hpdGVtIHtcbiAgcGFkZGluZy1yaWdodDogMjVweDtcbn1cbi5jb3VudHJ5YW5kY3JpbmZvIC5lYWNoaXRlbSAubGFibGVuYW1lIHtcbiAgZm9udC1zaXplOiAxMnB4ICFpbXBvcnRhbnQ7XG59XG4uY291bnRyeWFuZGNyaW5mbyAuZWFjaGl0ZW0gaW1nIHtcbiAgd2lkdGg6IDIycHg7XG59XG4uY291bnRyeWFuZGNyaW5mbyAuZWFjaGl0ZW06bGFzdC1jaGlsZCB7XG4gIHBhZGRpbmctcmlnaHQ6IDA7XG59XG5cbi5zZWFyY2hpdGVtYmVsb3cge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG4gIGhlaWdodDogNTBweDtcbn1cbi5zZWFyY2hpdGVtYmVsb3cgaW5wdXQge1xuICBoZWlnaHQ6IDEwMCU7XG4gIHdpZHRoOiAxMDAlO1xuICBib3JkZXI6IG5vbmU7XG59XG5cbi5QYXltZW50Y29udGFjdGhlYWQgcCB7XG4gIGNvbG9yOiByZWQ7XG4gIG1hcmdpbjogMHB4O1xufVxuXG46Om5nLWRlZXAuc2V0Y291bnRyeWZsYWcge1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuXG4uZmxhZ2ltYWdlIGltZyB7XG4gIG1heC13aWR0aDogMjRweDtcbn1cblxuOjpuZy1kZWVwLmNvdW50cnluYW1lc2VsZWN0IC5tYXQtb3B0aW9uLXRleHQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuOjpuZy1kZWVwLmNvdW50cnluYW1lc2VsZWN0IC5tYXQtb3B0aW9uLXRleHQgaW1nIHtcbiAgcGFkZGluZy1yaWdodDogMTBweDtcbn1cblxuLm1hcHdpZHRoIGltZyB7XG4gIHdpZHRoOiAxMDAlO1xufVxuXG4ucHJvZmlsZWxpbmtib3hzaGFkb3cge1xuICBib3gtc2hhZG93OiAwIDAgNXB4ICNkZGQ7XG4gIHdpZHRoOiAxMDAlO1xuICBwYWRkaW5nLWxlZnQ6IDdweDtcbiAgcGFkZGluZy1yaWdodDogN3B4O1xufVxuXG4uYm9yZGVyZmxleCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgbWluLWhlaWdodDogNDVweDtcbiAgcGFkZGluZy10b3A6IDVweDtcbn1cblxuLnBkZnZpZXcge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuXG4uU2VhcmNoIHAge1xuICBjb2xvcjogI2E5YTlhOTtcbn1cblxuLlNlYXJjaGNvbG9yIHtcbiAgY29sb3I6ICNhOWE5YTk7XG59XG5cbi5jZXJ0aWZpY2F0ZWJvcmRlciB7XG4gIGJvcmRlcjogMXB4IGRhc2hlZCAjYjNiM2IzICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMDAlO1xuICBoZWlnaHQ6IDYwcHg7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZDogI2YzZjRmNjtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4uY2VydGlmaWNhdGVib3JkZXIgLmZpbGVoZXJlY29sb3Ige1xuICBjb2xvcjogIzMzMzMzMztcbn1cbi5jZXJ0aWZpY2F0ZWJvcmRlciAuYWRkZmlsZWNvbG9yIHtcbiAgY29sb3I6ICMwMDZjYjc7XG59XG4uY2VydGlmaWNhdGVib3JkZXIgLnVwbG9hZHBkZiB7XG4gIGNvbG9yOiAjOTg5ODk4O1xufVxuLmNlcnRpZmljYXRlYm9yZGVyIC51cGxvYWRwZGYgcCB7XG4gIGNvbG9yOiAjOTg5ODk4O1xufVxuXG4ucGRmYmFja2dyb3VuZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZGYzZmY7XG59XG5cbi50ZXh0Y29sb3Ige1xuICBjb2xvcjogIzAwNmNiNyAhaW1wb3J0YW50O1xufVxuXG4uZGVsZXRlZmxleGVuZCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XG59XG5cbi5ib3JkZXIge1xuICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcbiAgd2lkdGg6IDk2JSAhaW1wb3J0YW50O1xufVxuXG4uZmxleG9tYW4ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAvKiB3aWR0aDogMTkwcHg7ICovXG59XG4uZmxleG9tYW4gc3BhbiB7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xuICBtYXJnaW4tbGVmdDogNHB4O1xufVxuXG4uZmxleHNlcmFjaCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG5cbi5pY29uc3R5bGUge1xuICBmb250LXNpemU6IDEuMTI1cmVtO1xuICBjb2xvcjogIzAwNmNiNztcbn1cblxuLnN0YXJ0IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgbWFyZ2luLWxlZnQ6IDBweDtcbn1cblxuLnNlYXJjaGluZm8ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xuICBoZWlnaHQ6IDM0cHg7XG59XG5cbi5wZGZpbWFnZSB7XG4gIHdpZHRoOiAxNHB4O1xuICBoZWlnaHQ6IDE0cHg7XG59XG5cbi5wcm9wZXJ0eXR5cGUge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcbiAgLmNvdW50cnlhbmRjcmluZm8ge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbiAgLmNvdW50cnlhbmRjcmluZm8gLmVhY2hpdGVtIHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgICBwYWRkaW5nLWJvdHRvbTogMTVweDtcbiAgfVxuXG4gIC5jZXJ0aWZpY2F0ZXMge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY29tcGFueWFuZG9mZmljZWluZm8ge1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICA6Om5nLWRlZXAubWFzdGVyYm90dG9tIC5tYXQtcGFnaW5hdG9yIHtcbiAgICBkaXNwbGF5OiBjb250ZW50cztcbiAgfVxuXG4gIC5jcmVhdGVyZXNvbHV0aW9uIHtcbiAgICBwYWRkaW5nLXRvcDogNDJweDtcbiAgfVxuXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIHtcbiAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxuXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC50aXRsZXRleHQge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAuY2xvc2VhbmRhZGQge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cblxuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAudGl0bGV0ZXh0IC5iZ2ktaW5mbyB7XG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xuICAgIG1hcmdpbi1sZWZ0OiA0cHg7XG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xuICAgIHRvcDogLTFweDtcbiAgfVxuXG4gIC5zZWFyY2hpbmZvIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmhlaWdodC0zNSB7XG4gICAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgOjpuZy1kZWVwLm1hc3RlclBhZ2UgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xuICAgIG1hcmdpbjogMCAzMnB4IDAgMTJweDtcbiAgICBkaXNwbGF5OiBjb250ZW50cyAhaW1wb3J0YW50O1xuICAgIGZvbnQtc2l6ZTogMTJweCAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcbiAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gICAgbWFyZ2luOiAwIDMycHggMCAxMnB4O1xuICAgIGNvbG9yOiBibGFjaztcbiAgICBtYXJnaW4tcmlnaHQ6IC02cHg7XG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xuICB9XG5cbiAgOjpuZy1kZWVwLm1hc3RlclBhZ2UgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGFsaWduLWl0ZW1zOiBiYXNlbGluZTtcbiAgICBtYXJnaW4tcmlnaHQ6IDBweDtcbiAgfVxuXG4gIDo6bmctZGVlcC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gICAgZGlzcGxheTogY29udGVudHM7XG4gIH1cblxuICA6Om5nLWRlZXAubWFzdGVyYm90dG9tIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xuICB9XG5cbiAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xuICB9XG5cbiAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xuICAgIG1pbi1oZWlnaHQ6IDU2cHg7XG4gICAgcGFkZGluZzogMHB4O1xuICAgIGZsZXgtd3JhcDogd3JhcC1yZXZlcnNlO1xuICAgIHdpZHRoOiAyNjFweDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDMyMHB4KSB7XG4gIDo6bmctZGVlcC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gICAgZGlzcGxheTogY29udGVudHM7XG4gIH1cblxuICA6Om5nLWRlZXAubWFzdGVyYm90dG9tIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xuICB9XG5cbiAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xuICB9XG59XG5AbWVkaWEgKG1pbi13aWR0aDogMzYwcHgpIHtcbiAgOjpuZy1kZWVwLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgICBkaXNwbGF5OiBjb250ZW50cztcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gIC5jZXJ0aWZpY2F0ZXMge1xuICAgIGRpc3BsYXk6IGJsb2NrO1xuICB9XG5cbiAgLnNlYXJjaGluZm8ge1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiAxOTIwcHgpIGFuZCAobWluLXdpZHRoOiAxMDgwcHgpIHtcbiAgLndpZHRoIHtcbiAgICBtYXgtd2lkdGg6IDcwJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoc2Vjb25kIHtcbiAgICBtYXgtd2lkdGg6IDMwJSAhaW1wb3J0YW50O1xuICB9XG59XG4ud2lkdGhmaWxlZCB7XG4gIHdpZHRoOiA2MCU7XG59XG5cbi5lYWNoaXRlbSB7XG4gIG1pbi13aWR0aDogMjAwcHg7XG4gIG1heC13aWR0aDogMjAwcHg7XG59XG5cbi50b29sdGlwd2lkdGgge1xuICB3aWR0aDogNTBweDtcbn1cblxuLnR4dC02IHtcbiAgY29sb3I6ICM2NjY7XG59XG5cbi53LTE1MCB7XG4gIHdpZHRoOiAyNXB4O1xufVxuXG4ucGFnZW51bWJlcmlucHJvZmlsZSB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNmZmY7XG4gIGhlaWdodDogMjBweDtcbiAgbWluLXdpZHRoOiAyMHB4O1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMTBweC8xMXB4O1xuICBiYWNrZ3JvdW5kOiAjMmI3ZGI1O1xuICBmb250LXNpemU6IDAuNzVyZW07XG4gIHdpZHRoOiBhdXRvO1xuICBwYWRkaW5nOiAwIDZweDtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1yaWdodDogMTBweDtcbn1cblxuLmNvbXBsZXRlZCB7XG4gIGJhY2tncm91bmQ6ICM3MWMxMTQ7XG59XG5cbi5jZXJ0aXRpY2F0ZWNvdW50cyB7XG4gIGhlaWdodDogMzRweDtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmNlcnRpdGljYXRlY291bnRzIHAge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbn1cbi5jZXJ0aXRpY2F0ZWNvdW50cyAuYWRkYnV0dG9uIHtcbiAgYmFja2dyb3VuZDogIzAwNmNiNztcbiAgZm9udC1zaXplOiAxNHB4ICFpbXBvcnRhbnQ7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuXG4uaW5zaWRlaGVhZGVyIHtcbiAgY29sb3I6ICMwMDZjYjc7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgbWFyZ2luOiAwO1xuICBwYWRkaW5nLXRvcDogMjVweDtcbiAgcGFkZGluZy1ib3R0b206IDE1cHg7XG59XG5cbi5zYXZlYW5kbmV4dCwgLnByZXZpb3VzIHtcbiAgYmFja2dyb3VuZDogI2VjZWNlYztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZWNlY2VjICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjOTk5ICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xuICBtaW4td2lkdGg6IDEyMHB4O1xufVxuXG4ucHJldmlvdXMge1xuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcbiAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1yaWdodDogMTVweDtcbiAgd2lkdGg6IGF1dG87XG59XG5cbi50eHQtdHJvcGF6IHtcbiAgY29sb3I6ICMwMDZjYjcgIWltcG9ydGFudDtcbn1cblxuLmNvbW1vbmV4cGFuZGFuZGNvbGxhcHNlIC50cmlnZ2VyZWR0byNjdXN0MSBtYXQtZXhwYW5zaW9uLXBhbmVsLm1hdC1leHBhbmRlZCB7XG4gIG1hcmdpbi1ib3R0b206IDBweCAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiAzMHB4ICFpbXBvcnRhbnQ7XG59XG5cbi5jZXJ0aWZpY2F0ZWltYWdlIHtcbiAgd2lkdGg6IDg1cHggIWltcG9ydGFudDtcbn1cblxuLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgLmhlYWRlciwgLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgaDUge1xuICBjb2xvcjogIzAwNmNiNztcbn1cblxuLnJlZFR4dCB7XG4gIGNvbG9yOiAjZjQ4MTFmO1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG5cbi5yb3lhbCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2Vlbjtcbn1cblxuLmNlcnRpZmljYXRlaWNvbiB7XG4gIHotaW5kZXg6IDE7XG4gIGhlaWdodDogODVweDtcbiAgd2lkdGg6IDg1cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2UwZjBmZjtcbiAgYm9yZGVyLXJhZGl1czogM3B4O1xufVxuLmNlcnRpZmljYXRlaWNvbiBpIHtcbiAgY29sb3I6ICMwMDZjYjc7XG4gIGZvbnQtc2l6ZTogMi41cmVtO1xuICBwYWRkaW5nLWxlZnQ6IDI1cHg7XG59XG5cbi5jYW5jZWxhbmRwdWJsaXNoIC5jYW5jZWwge1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGNvbG9yOiAjNzc3O1xuICBib3JkZXI6IDFweCBzb2xpZCAjY2JjYmNiO1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbn1cbi5jYW5jZWxhbmRwdWJsaXNoIC5wdWJsaXNoIHtcbiAgaGVpZ2h0OiA0NXB4O1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/contactinformation/contactinformation.component.ts":
  /*!**********************************************************************************************!*\
    !*** ./src/app/modules/profilemanagement/contactinformation/contactinformation.component.ts ***!
    \**********************************************************************************************/

  /*! exports provided: ContactinformationComponent */

  /***/
  function srcAppModulesProfilemanagementContactinformationContactinformationComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ContactinformationComponent", function () {
      return ContactinformationComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _env_environment__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @env/environment */
    "./src/environments/environment.ts");
    /* harmony import */


    var rxjs_add_observable_of__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! rxjs/add/observable/of */
    "./node_modules/rxjs-compat/_esm2015/add/observable/of.js");
    /* harmony import */


    var _profile_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ../profile.service */
    "./src/app/modules/profilemanagement/profile.service.ts");

    var ContactinformationComponent = /*#__PURE__*/function () {
      function ContactinformationComponent(profileService, localStorage, security) {
        _classCallCheck(this, ContactinformationComponent);

        this.profileService = profileService;
        this.localStorage = localStorage;
        this.security = security;
        this.selectedPanel = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.panelOpenState = false;
        this.customCollapsedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_6__["environment"].customCollapsedHeight;
        this.customExpandedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_6__["environment"].customExpandedHeight;
        this.color = 'success';
        this.mode = 'determinate';
        this.value = 50;
        this.bufferValue = 75;
        this.buttonname = "Add";
        this.page = 1;
        this.searchmarketpresence = '';
        this.encryptedcompanypk = '';
        this.search = '';
        this.loadAddComponent = false;
        this.countrylist = [];
        /*Notify Content*/

        this.dyHelpContent = {
          'title': 'Fill in the details of your registered branch office. Branch offices are outlets at different locations that do not constitute a separate legal entity.',
          'boldHeading': 'Steps to add your Branch office:',
          'list': [{
            'content': 'You can either fill in the address of your Branch office in the google map.'
          }, {
            'content': 'Or update the location details of your Branch office in the respective fields.'
          }]
        };
      }

      _createClass(ContactinformationComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.lusrtpye = this.localStorage.getInLocal('usertype');

          if (this.lusrtpye == 'U') {
            this.useraccess = this.localStorage.getInLocal('uerpermission');
          }

          this.companypk = this.localStorage.getInLocal('comp_pk');
          this.encryptedcompanypk = this.security.encrypt(this.companypk);
        }
      }, {
        key: "syncPrimaryPaginator",
        value: function syncPrimaryPaginator(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.paginator.page.emit(event);
        }
      }, {
        key: "onPaginateChange",
        value: function onPaginateChange(event) {
          this.perpage = event.pageSize;
          this.page = parseInt(event.pageIndex) + 1;
          this.getMarketPresenceList(this.encryptedcompanypk, this.locationType, this.page, this.perpage, this.search);
        }
      }, {
        key: "getMarketPresenceList",
        value: function getMarketPresenceList(companypk, type, pageno, perpage, search, updateresultlength) {
          var _this23 = this;

          this.profileService.getMarketPresenceList(companypk, type, pageno, perpage, search).subscribe(function (data) {
            _this23.listdata = data['data'].items.data;
            _this23.overallcnt = data['data'].items.overallcount;

            if (updateresultlength) {
              _this23.resultsLength = data['data'].items.count;
            }
          });
        }
      }, {
        key: "scrollTo",
        value: function scrollTo(className) {
          try {
            var elementList = document.querySelectorAll('.' + className);
            var element = elementList[0];
            element.scrollIntoView({
              behavior: 'smooth'
            });
          } catch (error) {
            console.log('page-content');
          }
        }
      }, {
        key: "updatedList",
        value: function updatedList(value) {
          if (!value.isDelete) {
            this.paginator.firstPage();
          }

          this.listdata = value.data;
          this.resultsLength = value.count;
          this.overallcnt = value.overallcount;
        }
      }, {
        key: "openPrev",
        value: function openPrev() {
          this.panel = this.panel - 1;
          this.selectedPanel.emit(this.panel);
        }
      }, {
        key: "openNext",
        value: function openNext() {
          this.panel = this.panel + 1;
          this.selectedPanel.emit(this.panel);
        }
      }, {
        key: "onFilterSubmit",
        value: function onFilterSubmit() {
          this.getMarketPresenceList(this.encryptedcompanypk, this.locationType, this.page, this.perpage, this.searchmarketpresence, true);
        }
      }, {
        key: "addbranchoff",
        value: function addbranchoff() {
          if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[21] && this.useraccess[21].create == 'Y') {
            this.drawer.toggle();
          } else {
            this.security.userpermissionpop();
          }
        }
      }, {
        key: "edit",
        value: function edit(data) {
          if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[21] && this.useraccess[21].update == 'Y') {
            this.loadAddComponent = true;
            setTimeout(function () {}, 10);
          } else {
            this.security.userpermissionpop();
          }
        }
      }, {
        key: "delete",
        value: function _delete(pk, page, search) {
          if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[21] && this.useraccess[21]["delete"] == 'Y') {
            this.loadAddComponent = true;

            if (this.listdata.length == 1) {
              page = page - 1;
              this.paginator.pageIndex = this.paginator.pageIndex - 1;
            }

            setTimeout(function () {}, 10);
          } else {
            this.security.userpermissionpop();
          }
        }
      }]);

      return ContactinformationComponent;
    }();

    ContactinformationComponent.ctorParameters = function () {
      return [{
        type: _profile_service__WEBPACK_IMPORTED_MODULE_8__["ProfileService"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('drawer'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_3__["MatDrawer"])], ContactinformationComponent.prototype, "drawer", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('paginator'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__["MatPaginator"])], ContactinformationComponent.prototype, "paginator", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], ContactinformationComponent.prototype, "panel", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], ContactinformationComponent.prototype, "panelNo", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], ContactinformationComponent.prototype, "selectedPanel", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], ContactinformationComponent.prototype, "listdata", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], ContactinformationComponent.prototype, "logoUrl", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], ContactinformationComponent.prototype, "achivementData", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], ContactinformationComponent.prototype, "perpage", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], ContactinformationComponent.prototype, "paginationSet", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], ContactinformationComponent.prototype, "resultsLength", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], ContactinformationComponent.prototype, "overallcnt", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], ContactinformationComponent.prototype, "locationType", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], ContactinformationComponent.prototype, "countrylist", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], ContactinformationComponent.prototype, "companyname", void 0);
    ContactinformationComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-contactinformation',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./contactinformation.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/contactinformation/contactinformation.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./contactinformation.component.scss */
      "./src/app/modules/profilemanagement/contactinformation/contactinformation.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_profile_service__WEBPACK_IMPORTED_MODULE_8__["ProfileService"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"]])], ContactinformationComponent);
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/profilemanagement-routing.module.ts":
  /*!*******************************************************************************!*\
    !*** ./src/app/modules/profilemanagement/profilemanagement-routing.module.ts ***!
    \*******************************************************************************/

  /*! exports provided: ProfilemanagementRouting */

  /***/
  function srcAppModulesProfilemanagementProfilemanagementRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ProfilemanagementRouting", function () {
      return ProfilemanagementRouting;
    });
    /* harmony import */


    var _app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! @app/auth/auth.guard */
    "./src/app/auth/auth.guard.ts");
    /* harmony import */


    var _contactinformation_contactinformation_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! ./contactinformation/contactinformation.component */
    "./src/app/modules/profilemanagement/contactinformation/contactinformation.component.ts");

    var ProfilemanagementRouting = [{
      path: '',
      children: [{
        path: 'contactinfo',
        component: _contactinformation_contactinformation_component__WEBPACK_IMPORTED_MODULE_1__["ContactinformationComponent"],
        data: {
          accessmodule: [19],
          title: 'Contactinfo',
          breadcrumb: 'Contactinfo'
        },
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_0__["AuthGuard"]]
      }]
    }];
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/profilemanagement.module.ts":
  /*!***********************************************************************!*\
    !*** ./src/app/modules/profilemanagement/profilemanagement.module.ts ***!
    \***********************************************************************/

  /*! exports provided: createTranslateLoader, ProfilemanagementModule */

  /***/
  function srcAppModulesProfilemanagementProfilemanagementModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function () {
      return createTranslateLoader;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ProfilemanagementModule", function () {
      return ProfilemanagementModule;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_material_extensions_google_maps_autocomplete__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular-material-extensions/google-maps-autocomplete */
    "./node_modules/@angular-material-extensions/google-maps-autocomplete/__ivy_ngcc__/fesm2015/angular-material-extensions-google-maps-autocomplete.js");
    /* harmony import */


    var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/common */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_shared__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var _app_shared_util__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/@shared/util */
    "./src/app/@shared/util.ts");
    /* harmony import */


    var _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @app/common/city/service/city.service */
    "./src/app/common/city/service/city.service.ts");
    /* harmony import */


    var _app_common_ckeditor__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @app/common/ckeditor */
    "./src/app/common/ckeditor/index.ts");
    /* harmony import */


    var _app_common_class_script_load__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @app/common/class/script.load */
    "./src/app/common/class/script.load.ts");
    /* harmony import */


    var _app_common_currency_createcurrency_currrency_service__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @app/common/currency/createcurrency/currrency.service */
    "./src/app/common/currency/createcurrency/currrency.service.ts");
    /* harmony import */


    var _app_common_directives_date_format__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! @app/common/directives/date_format */
    "./src/app/common/directives/date_format.ts");
    /* harmony import */


    var _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! @app/common/state/service/state.service */
    "./src/app/common/state/service/state.service.ts");
    /* harmony import */


    var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! @ngx-translate/http-loader */
    "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
    /* harmony import */


    var angularx_qrcode__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! angularx-qrcode */
    "./node_modules/angularx-qrcode/__ivy_ngcc__/fesm2015/angularx-qrcode.js");
    /* harmony import */


    var ngx_smart_popover__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! ngx-smart-popover */
    "./node_modules/ngx-smart-popover/__ivy_ngcc__/fesm2015/ngx-smart-popover.js");
    /* harmony import */


    var _image_cropper_image_cropper_module__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(
    /*! ../image-cropper/image-cropper.module */
    "./src/app/modules/image-cropper/image-cropper.module.ts");
    /* harmony import */


    var _contactinfo_dept_dept_component__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(
    /*! ./contactinfo/dept/dept.component */
    "./src/app/modules/profilemanagement/contactinfo/dept/dept.component.ts");
    /* harmony import */


    var _profile_service__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(
    /*! ./profile.service */
    "./src/app/modules/profilemanagement/profile.service.ts");
    /* harmony import */


    var _profilemanagement_routing_module__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(
    /*! ./profilemanagement-routing.module */
    "./src/app/modules/profilemanagement/profilemanagement-routing.module.ts");
    /* harmony import */


    var _welcomeback_welcomeback_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(
    /*! ./welcomeback/welcomeback.component */
    "./src/app/modules/profilemanagement/welcomeback/welcomeback.component.ts");
    /* harmony import */


    var _contactinformation_contactinformation_component__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(
    /*! ./contactinformation/contactinformation.component */
    "./src/app/modules/profilemanagement/contactinformation/contactinformation.component.ts");
    /* harmony import */


    var _contactinformation_addcontact_addcontact_component__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(
    /*! ./contactinformation/addcontact/addcontact.component */
    "./src/app/modules/profilemanagement/contactinformation/addcontact/addcontact.component.ts");
    /* harmony import */


    var ngx_daterangepicker_material__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(
    /*! ngx-daterangepicker-material */
    "./node_modules/ngx-daterangepicker-material/__ivy_ngcc__/fesm2015/ngx-daterangepicker-material.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js"); // AoT requires an exported function for factories


    function createTranslateLoader(http) {
      return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_17__["TranslateHttpLoader"](http, './assets/i18n/profilemanagement/', '.json');
    }

    var ProfilemanagementModule = /*#__PURE__*/_createClass(function ProfilemanagementModule(dateAdapter) {
      _classCallCheck(this, ProfilemanagementModule);

      this.dateAdapter = dateAdapter;
      dateAdapter.setLocale('en-in'); // DD/MM/YYYY
    });

    ProfilemanagementModule.ctorParameters = function () {
      return [{
        type: _angular_material_core__WEBPACK_IMPORTED_MODULE_7__["DateAdapter"]
      }];
    };

    ProfilemanagementModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_4__["NgModule"])({
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _app_shared__WEBPACK_IMPORTED_MODULE_9__["SharedModule"], _angular_common_http__WEBPACK_IMPORTED_MODULE_3__["HttpClientModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_6__["ReactiveFormsModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_6__["FormsModule"], ngx_smart_popover__WEBPACK_IMPORTED_MODULE_19__["PopoverModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__["FlexLayoutModule"], _image_cropper_image_cropper_module__WEBPACK_IMPORTED_MODULE_20__["ImageCropperModule"], _angular_material_extensions_google_maps_autocomplete__WEBPACK_IMPORTED_MODULE_1__["MatGoogleMapsAutocompleteModule"], _app_common_ckeditor__WEBPACK_IMPORTED_MODULE_12__["CKEditorModule"], _angular_router__WEBPACK_IMPORTED_MODULE_8__["RouterModule"].forChild(_profilemanagement_routing_module__WEBPACK_IMPORTED_MODULE_23__["ProfilemanagementRouting"]), angularx_qrcode__WEBPACK_IMPORTED_MODULE_18__["QRCodeModule"], ngx_daterangepicker_material__WEBPACK_IMPORTED_MODULE_27__["NgxDaterangepickerMd"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_28__["TranslateModule"].forChild({
        loader: {
          provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_28__["TranslateLoader"],
          useFactory: createTranslateLoader,
          deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_3__["HttpClient"]]
        }
      })],
      exports: [_contactinfo_dept_dept_component__WEBPACK_IMPORTED_MODULE_21__["DeptComponent"]],
      declarations: [_contactinfo_dept_dept_component__WEBPACK_IMPORTED_MODULE_21__["DeptComponent"], _welcomeback_welcomeback_component__WEBPACK_IMPORTED_MODULE_24__["WelcomebackComponent"], _contactinformation_contactinformation_component__WEBPACK_IMPORTED_MODULE_25__["ContactinformationComponent"], _contactinformation_addcontact_addcontact_component__WEBPACK_IMPORTED_MODULE_26__["AddcontactComponent"]],
      entryComponents: [],
      providers: [_profile_service__WEBPACK_IMPORTED_MODULE_22__["ProfileService"], _app_shared_util__WEBPACK_IMPORTED_MODULE_10__["Util"], _app_common_currency_createcurrency_currrency_service__WEBPACK_IMPORTED_MODULE_14__["CurrrencyService"], _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_16__["StateService"], _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_11__["CityService"], _app_common_class_script_load__WEBPACK_IMPORTED_MODULE_13__["ScriptService"], {
        provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_7__["DateAdapter"],
        useClass: _app_common_directives_date_format__WEBPACK_IMPORTED_MODULE_15__["DateFormat"]
      }]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_material_core__WEBPACK_IMPORTED_MODULE_7__["DateAdapter"]])], ProfilemanagementModule);
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/welcomeback/welcomeback.component.scss":
  /*!**********************************************************************************!*\
    !*** ./src/app/modules/profilemanagement/welcomeback/welcomeback.component.scss ***!
    \**********************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesProfilemanagementWelcomebackWelcomebackComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".welcomeback {\n  display: flex;\n  justify-content: flex-end;\n  align-items: center;\n}\n.welcomeback .titletext {\n  padding-left: 15px;\n}\n.welcomeback .mat-card {\n  background: #f0fff2;\n  width: 350px;\n  min-height: 90px;\n  padding-bottom: 10px;\n  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important;\n  border-radius: 0 !important;\n  z-index: 9999;\n}\n.welcomeback .mat-card-header {\n  padding-bottom: 0;\n  padding-top: 0;\n  padding-left: 0;\n}\n.welcomeback .mat-card-header img {\n  height: 100%;\n}\n.welcomeback .mat-card-title {\n  font-size: 1rem;\n  color: #39b549;\n  line-height: 1;\n  margin-bottom: 5px !important;\n}\n.welcomeback .mat-card-actions {\n  padding: 0 0px;\n}\n.welcomeback .mat-card-actions div {\n  text-align: right;\n}\n.welcomeback .close {\n  font-size: 0.75rem;\n  color: #4c972e;\n  padding: 5px 10px;\n  cursor: pointer;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9wcm9maWxlbWFuYWdlbWVudC93ZWxjb21lYmFjay9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxwcm9maWxlbWFuYWdlbWVudFxcd2VsY29tZWJhY2tcXHdlbGNvbWViYWNrLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3Byb2ZpbGVtYW5hZ2VtZW50L3dlbGNvbWViYWNrL3dlbGNvbWViYWNrLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0VBR0ksYUFBQTtFQUNBLHlCQUFBO0VBQ0EsbUJBQUE7QUNESjtBREVHO0VBRUksa0JBQUE7QUNEUDtBREdBO0VBRUEsbUJBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxvQkFBQTtFQUdJLG9EQUFBO0VBQ0EsMkJBQUE7RUFDQSxhQUFBO0FDRko7QURJQTtFQUVJLGlCQUFBO0VBQ0EsY0FBQTtFQUNBLGVBQUE7QUNISjtBRElLO0VBRUwsWUFBQTtBQ0hBO0FETUE7RUFFSSxlQUFBO0VBQ0EsY0FBQTtFQUNBLGNBQUE7RUFDQSw2QkFBQTtBQ0xKO0FET0E7RUFFSSxjQUFBO0FDTko7QURPSTtFQUVJLGlCQUFBO0FDTlI7QURTQTtFQUVJLGtCQUFBO0VBQ0EsY0FBQTtFQUNBLGlCQUFBO0VBQ0EsZUFBQTtBQ1JKIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9wcm9maWxlbWFuYWdlbWVudC93ZWxjb21lYmFjay93ZWxjb21lYmFjay5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIi53ZWxjb21lYmFja1xyXG57XHJcblxyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAudGl0bGV0ZXh0XHJcbiAgIHtcclxuICAgICAgIHBhZGRpbmctbGVmdDogMTVweDtcclxuICAgfSBcclxuLm1hdC1jYXJkXHJcbntcclxuYmFja2dyb3VuZDogI2YwZmZmMjtcclxud2lkdGg6IDM1MHB4O1xyXG5taW4taGVpZ2h0OiA5MHB4O1xyXG5wYWRkaW5nLWJvdHRvbTogMTBweDtcclxuLXdlYmtpdC1ib3gtc2hhZG93OiAwIDJweCAxMHB4IHJnYmEoMCwwLDAsLjIpO1xyXG5cdC1tb3otYm94LXNoYWRvdzogMCAycHggMTBweCByZ2JhKDAsMCwwLC4yKTtcclxuICAgIGJveC1zaGFkb3c6IDAgMnB4IDEwcHggcmdiYSgwLDAsMCwuMikgIWltcG9ydGFudDtcclxuICAgIGJvcmRlci1yYWRpdXM6IDAgIWltcG9ydGFudDtcclxuICAgIHotaW5kZXg6IDk5OTk7XHJcbn1cclxuLm1hdC1jYXJkLWhlYWRlclxyXG57XHJcbiAgICBwYWRkaW5nLWJvdHRvbTogMDtcclxuICAgIHBhZGRpbmctdG9wOiAwO1xyXG4gICAgcGFkZGluZy1sZWZ0OiAwO1xyXG4gICAgIGltZ1xyXG57XHJcbmhlaWdodDoxMDAlO1xyXG59XHJcbn1cclxuLm1hdC1jYXJkLXRpdGxlXHJcbntcclxuICAgIGZvbnQtc2l6ZTogMXJlbTtcclxuICAgIGNvbG9yOiAjMzliNTQ5O1xyXG4gICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICBtYXJnaW4tYm90dG9tOiA1cHggIWltcG9ydGFudDtcclxufVxyXG4ubWF0LWNhcmQtYWN0aW9uc1xyXG57XHJcbiAgICBwYWRkaW5nOiAwIDBweDtcclxuICAgIGRpdlxyXG4gICAge1xyXG4gICAgICAgIHRleHQtYWxpZ246IHJpZ2h0O1xyXG4gICAgfVxyXG59XHJcbi5jbG9zZVxyXG57XHJcbiAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICBjb2xvcjogIzRjOTcyZTtcclxuICAgIHBhZGRpbmc6IDVweCAxMHB4O1xyXG4gICAgY3Vyc29yOiBwb2ludGVyO1xyXG59XHJcbn0iLCIud2VsY29tZWJhY2sge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLndlbGNvbWViYWNrIC50aXRsZXRleHQge1xuICBwYWRkaW5nLWxlZnQ6IDE1cHg7XG59XG4ud2VsY29tZWJhY2sgLm1hdC1jYXJkIHtcbiAgYmFja2dyb3VuZDogI2YwZmZmMjtcbiAgd2lkdGg6IDM1MHB4O1xuICBtaW4taGVpZ2h0OiA5MHB4O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbiAgLXdlYmtpdC1ib3gtc2hhZG93OiAwIDJweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbiAgLW1vei1ib3gtc2hhZG93OiAwIDJweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbiAgYm94LXNoYWRvdzogMCAycHggMTBweCByZ2JhKDAsIDAsIDAsIDAuMikgIWltcG9ydGFudDtcbiAgYm9yZGVyLXJhZGl1czogMCAhaW1wb3J0YW50O1xuICB6LWluZGV4OiA5OTk5O1xufVxuLndlbGNvbWViYWNrIC5tYXQtY2FyZC1oZWFkZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMDtcbiAgcGFkZGluZy10b3A6IDA7XG4gIHBhZGRpbmctbGVmdDogMDtcbn1cbi53ZWxjb21lYmFjayAubWF0LWNhcmQtaGVhZGVyIGltZyB7XG4gIGhlaWdodDogMTAwJTtcbn1cbi53ZWxjb21lYmFjayAubWF0LWNhcmQtdGl0bGUge1xuICBmb250LXNpemU6IDFyZW07XG4gIGNvbG9yOiAjMzliNTQ5O1xuICBsaW5lLWhlaWdodDogMTtcbiAgbWFyZ2luLWJvdHRvbTogNXB4ICFpbXBvcnRhbnQ7XG59XG4ud2VsY29tZWJhY2sgLm1hdC1jYXJkLWFjdGlvbnMge1xuICBwYWRkaW5nOiAwIDBweDtcbn1cbi53ZWxjb21lYmFjayAubWF0LWNhcmQtYWN0aW9ucyBkaXYge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbi53ZWxjb21lYmFjayAuY2xvc2Uge1xuICBmb250LXNpemU6IDAuNzVyZW07XG4gIGNvbG9yOiAjNGM5NzJlO1xuICBwYWRkaW5nOiA1cHggMTBweDtcbiAgY3Vyc29yOiBwb2ludGVyO1xufSJdfQ== */";
    /***/
  },

  /***/
  "./src/app/modules/profilemanagement/welcomeback/welcomeback.component.ts":
  /*!********************************************************************************!*\
    !*** ./src/app/modules/profilemanagement/welcomeback/welcomeback.component.ts ***!
    \********************************************************************************/

  /*! exports provided: WelcomebackComponent */

  /***/
  function srcAppModulesProfilemanagementWelcomebackWelcomebackComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "WelcomebackComponent", function () {
      return WelcomebackComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");

    var WelcomebackComponent = /*#__PURE__*/function () {
      function WelcomebackComponent(localdata, translate, remoteService, cookieService) {
        _classCallCheck(this, WelcomebackComponent);

        this.localdata = localdata;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.localvisit = this.localdata.getInLocal('lastvisit');
      }

      _createClass(WelcomebackComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this24 = this;

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this24.translate.setDefaultLang(_this24.cookieService.get('languageCode'));
          });
          this.showwelcomeback = localStorage.getItem('userlastvisit') != '0' ? '1' : '0';

          if (window.location.href.split('#')[1] == this.localdata.getInLocal('lastvisit')) {
            this.showwelcomeback = 0;
          } else {
            this.routerlink = this.localdata.getInLocal('lastvisit');
          }
        }
      }, {
        key: "cancellastview",
        value: function cancellastview() {
          localStorage.setItem('userlastvisit', '0');
          this.showwelcomeback = '0';
        }
      }, {
        key: "welcomeback",
        value: function welcomeback() {
          localStorage.setItem('userlastvisit', '0');
          this.showwelcomeback = '0';
        }
      }]);

      return WelcomebackComponent;
    }();

    WelcomebackComponent.ctorParameters = function () {
      return [{
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_2__["AppLocalStorageServices"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_4__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__["CookieService"]
      }];
    };

    WelcomebackComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-welcomeback',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./welcomeback.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilemanagement/welcomeback/welcomeback.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./welcomeback.component.scss */
      "./src/app/modules/profilemanagement/welcomeback/welcomeback.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_2__["AppLocalStorageServices"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_4__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__["CookieService"]])], WelcomebackComponent);
    /***/
  }
}]);
//# sourceMappingURL=default~modules-accountsettings-accountsettings-module~modules-profilemanagement-profilemanagement-module-es5.js.map