function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-standardcourses-standardcourses-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/standardcourses/modalavailabledate.html":
  /*!*******************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/standardcourses/modalavailabledate.html ***!
    \*******************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesStandardcoursesModalavailabledateHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div [formGroup]=\"batchform\" id=\"traininglistpopup\">\r\n    <div class=\"trainingdurationhead\" fxLayoutAlign=\"space-between center\">\r\n        <h2 class=\"m-0 fs-16\">{{'course.trainingdurset' | translate}}</h2>\r\n        <mat-icon (click)=\"closedialog()\" class=\"cursor-pointer\" matTooltip=\"Close\">close</mat-icon>\r\n    </div>\r\n    <div class=\"pd-25\">\r\n        <div fxLayout=\"row wrap\" class=\"coursesubtitle\" fxLayoutAlign=\"flex-start center\">\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                <p class=\"fs-14 m-0\">{{'course.coursetitle' | translate}}</p>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <span class=\"fs-14 complantag\">Computer Programming Languages</span>\r\n            </div>  \r\n         \r\n        </div>\r\n        <div fxLayout=\"row wrap\">\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                 &nbsp;\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\" class=\"p-t-35\" fxLayoutAlign=\"flex-start\">\r\n                <div class=\"totalleanerheader mindaterangewidth\">\r\n                    <p class=\"fs-14 m-0\">{{'course.daterange' | translate}}</p>\r\n                    <span class=\"fs-16\">1-1-2023 to 1-3-2023</span>\r\n                </div>\r\n                <div class=\"totalleanerheader\">\r\n                    <p class=\"fs-14 m-0\">{{'course.totaldays' | translate}}</p>\r\n                    <span class=\"fs-16\">90</span>\r\n                </div>\r\n            </div>  \r\n         \r\n        </div>\r\n        <div fxLayout=\"row wrap\" >\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                 &nbsp;\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <div class=\"conftiming\">\r\n                    <h4 class=\"fs-14\">{{'course.configtiming' | translate}}</h4>\r\n               </div>\r\n            </div>  \r\n        </div>\r\n       \r\n        <div fxLayout=\"row wrap\" >\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n               \r\n                <div fxLayout=\"row wrap\" class=\"coursesubtitle p-b-20\" fxLayoutAlign=\"flex-start center\">\r\n                    <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                        <p class=\"fs-14 m-0\">{{'course.from' | translate}}</p>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                        <div fxLayoutAlign=\"flex-start\">\r\n                            <div class=\"timepickerwidth\">\r\n                                <mat-form-field >\r\n                                    <!-- The timepicker input -->\r\n                                    <input matTimepicker #t=\"matTimepicker\" [minDate]=\"minValue\"\r\n                                        [maxDate]=\"maxValue\" [strict]=\"false\"\r\n                                        formControlName=\"starttime\"\r\n                                        required>\r\n                                    <mat-icon matSuffix\r\n                                        (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                                     \r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxLayoutAlign=\"flex-start center\" class=\"slottag p-l-15\">\r\n                                <mat-icon>add</mat-icon>\r\n                                <span class=\"fs-14 p-l-8\">{{'course.addslot' | translate}}</span>\r\n                            </div>\r\n                        </div>\r\n                        <mat-error *ngIf=\"cour.starttime.errors?.required || batchform.submitted\">\r\n                            {{'course.starttime' | translate}} </mat-error>\r\n                    </div>  \r\n                </div>\r\n                \r\n            </div>\r\n         \r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"coursesubtitle p-b-30\" fxLayoutAlign=\"flex-start center\">\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                <p class=\"fs-14 m-0\">{{'course.to' | translate}}</p>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <div class=\"timepickerwidth\"> \r\n                    <mat-form-field >\r\n                        <!-- The timepicker input -->\r\n                        <input matTimepicker #t=\"matTimepicker\" [minDate]=\"minValue\"\r\n                            [maxDate]=\"maxValue\" [strict]=\"false\"\r\n                            formControlName=\"endtime\"\r\n                            required>\r\n                        <mat-icon matSuffix\r\n                            (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                          \r\n                    </mat-form-field>\r\n                </div>\r\n                <mat-error *ngIf=\"cour.endtime.errors?.required || batchform.submitted\">\r\n                    {{'course.endtime' | translate}} </mat-error>\r\n            </div>  \r\n        </div>\r\n        <div fxLayout=\"row wrap\" >\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\" class=\"coursesubtitle\">\r\n                <p class=\"fs-14 m-0\">{{'course.setweekedned' | translate}}</p>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <mat-table class=\"summarytablelist\" #table [dataSource]=\"quicksetupdatalist\" \r\n                matSortDisableClear>\r\n                <ng-container matColumnDef=\"days\">\r\n                    <mat-header-cell rowspan=\"2\" fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                       ></mat-header-cell>\r\n                    <mat-cell rowspan=\"2\"  data-label=\"Selected Date\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                      <div class=\"daytopalign\">\r\n                            <h4 class=\"m-0 fs-14\">{{'course.days' | translate}}</h4>\r\n                      </div> \r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"sunday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                     >{{'course.sunday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"monday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.monday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"tuesday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                       >{{'course.tuesday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"wednesday\">\r\n                    <mat-header-cell fxFlex=\"95px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.wednesday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"95px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"thursday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                       >{{'course.thursday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"friday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.friday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"saturday\">\r\n                    <mat-header-cell fxFlex=\"115px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.saturday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"115px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <mat-header-row *matHeaderRowDef=\"quicksetupcolumn\"></mat-header-row>\r\n                <mat-row *matRowDef=\"let row; columns: quicksetupcolumn;\"></mat-row>\r\n            </mat-table>\r\n            </div>  \r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-40\">\r\n            <button mat-raised-button class=\"m-r-10 clearbtn ShowHide fs-15\" type=\"button\">{{'course.courclear' | translate}}\r\n            </button>\r\n            <button mat-raised-button  type=\"submit\"\r\n                class=\"ShowHidefs-15 savebtn m-l-10\">{{'course.coursave' | translate}}\r\n            </button>\r\n        </div>\r\n    </div>\r\n   \r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/standardcourses/standardcourses.component.html":
  /*!**************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/standardcourses/standardcourses.component.html ***!
    \**************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesStandardcoursesStandardcoursesComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div [ngSwitch]=\"standardTemplate\" #pageScroll id=\"standard_customized\" class=\"pagescroll\">\r\n    <div id=\"standard_course\" *ngIf=\"Submitted\" fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n        <div fxFlex=\"100\" class=\"branches\">\r\n            <div class=\"renewal m-b-30\" *ngIf=\"!renewal\">\r\n                <div class=\"renewal_info\">\r\n                    <p class=\"fs-16 m-0\">{{'institute.opalapplnumb' | translate}} <br><span>OPAL25897</span></p>\r\n                    <mat-divider [vertical]=\"true\"></mat-divider>\r\n                    <p class=\"fs-16 m-0\">{{'institute.dateofexpi' | translate}}<br><span>24-01-2014</span></p>\r\n                    <div class=\"remainder\">\r\n                        <p class=\"fs-16 m-0\">{{'institute.nooddays' | translate}}: <span>24</span></p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"btns\">\r\n                    <button mat-raised-button class=\"viewbtn fs-16\">{{'institute.viewcert' | translate}}</button>\r\n                </div>\r\n            </div>\r\n            <ng-template [ngSwitchCase]=\"'course'\">\r\n                <div class=\"paginationwithfilter masterPageTop \">\r\n                    <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                    <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                        [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                            <!-- <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                (click)=\"ApplyCertificate();scrollTo('pagescroll')\"\r\n                                class=\"ShowHidefs-15 submit_btn m-r-10\">{{'international.add' | translate}}\r\n                            </button> -->\r\n                            <button mat-raised-button [matMenuTriggerFor]=\"menu\"\r\n                                class=\"ShowHidefs-15 submit_btn m-r-10\">{{'branch.applycourse' | translate}}<i\r\n                                    class=\"fa fa-chevron-down m-l-5\" aria-hidden=\"true\"></i></button>\r\n                            <mat-menu #menu=\"matMenu\" class=\"menu-panel\">\r\n                                <button mat-menu-item (click)=\"ApplyCertificate(2);scrollTo('pagescroll')\"\r\n                                    class=\"fs-16\">{{'branch.stand' | translate}}</button>\r\n                                <button mat-menu-item (click)=\"ApplyCertificate(3);scrollTo('pagescroll')\"\r\n                                    class=\"fs-16\">{{'branch.cust' | translate}}</button>\r\n                            </mat-menu>\r\n                            <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                                class=\"filter\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                    aria-hidden=\"true\"></i></button>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                        <div class=\"awaredtable\">\r\n                            <mat-table #table class=\"scrolldata\" [dataSource]=\"TrainingBranchData\" matSort\r\n                                matSortDisableClear>\r\n                                <ng-container matColumnDef=\"applictionno\">\r\n                                    <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.applform' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"applictionno\" fxFlex=\"200px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"> {{BranchData.applictionno}}</div>\r\n                                        </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"offictype\">\r\n                                    <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.offitype' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"offictype\" fxFlex=\"200px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"> {{(BranchData.appiim_officetype == 1)?'Main Office':'Branch Offine'}}</div>\r\n                                         </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"branchname\">\r\n                                    <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.branchname' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"branchname\" fxFlex=\"250px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"> {{(BranchData.appiim_officetype == 2)?(ifarbic == true?\r\n                                            (BranchData.appiim_branchname_ar):(BranchData.appiim_branchname_en)):('-')}}</div>\r\n                                         </mat-cell>\r\n                                </ng-container>\r\n\r\n                                <ng-container matColumnDef=\"courtype\">\r\n                                    <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.courtype' |\r\n                                        translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"courtype\" fxFlex=\"200px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\">{{ifarbic == true?\r\n                                            (BranchData.pm_projectname_ar):(BranchData.pm_projectname_en)}}</div>\r\n                                         </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"coursetitle\">\r\n                                    <mat-header-cell fxFlex=\"270px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.courtile' |\r\n                                        translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"coursetitle\" fxFlex=\"270px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"> {{ifarbic == true?\r\n                                            (BranchData.coursename_ar):(BranchData.coursename_en)}}</div>\r\n                                        </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"coursecate\">\r\n                                    <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.courcate' |\r\n                                        translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"coursecate\" fxFlex=\"200px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"> {{ifarbic == true?\r\n                                            (BranchData.courscat_ar):(BranchData.courscat_en)}}</div>\r\n                                         </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"requestfor\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.request' |\r\n                                        translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"requestfor\" fxFlex=\"230px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\">{{BranchData.reqfor_ar ?(ifarbic == true?\r\n                                            (BranchData.reqfor_ar):(BranchData.reqfor_en)):'-'}}</div>\r\n                                         </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"coursedeliver\">\r\n                                    <mat-header-cell fxFlex=\"300px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.courdeli' |\r\n                                        translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"coursedeliver\" fxFlex=\"300px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\">  {{ (ifarbic == true?\r\n                                            (BranchData.delto_ar):(BranchData.delto_en)) ? (ifarbic == true?\r\n                                            (BranchData.delto_ar):(BranchData.delto_en)) : '-' }}</div>\r\n                                       </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"dateofexpiry\">\r\n                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.dateofexpi' | translate}}\r\n                                    </mat-header-cell>\r\n                                    <mat-cell data-label=\"dateofexpiry\" fxFlex=\"263px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\">{{BranchData.dateofexpiry ? BranchData.dateofexpiry : '-'}} </div>\r\n                                        </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"applicationstatus\">\r\n                                    <mat-header-cell fxFlex=\"280px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'branch.applstat' |\r\n                                        translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"applicationstatus\" fxFlex=\"280px\"\r\n                                        *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"> <span *ngIf=\"BranchData.applicationstatus == '1'\">{{'table.yettosubmit'\r\n                                            |translate}}</span>\r\n                                        <span *ngIf=\"BranchData.applicationstatus == '2'\">{{'table.subfordesk'\r\n                                            |translate}}</span>\r\n                                        <span *ngIf=\"BranchData.applicationstatus == '3'\">{{'table.declduringdesk'\r\n                                            |translate}}</span>\r\n                                        <span *ngIf=\"BranchData.applicationstatus == '4'\">{{'table.resubmdesk'\r\n                                            |translate}}</span>\r\n                                        <span *ngIf=\"BranchData.applicationstatus == '5'\">{{'table.yettopay'\r\n                                            |translate}}</span>\r\n                                        <span *ngIf=\"BranchData.applicationstatus == '6'\">{{'table.paidconfipend'\r\n                                            |translate}}</span> \r\n                                    <span *ngIf=\"BranchData.applicationstatus == '7'\">{{'table.awitorsiteaudit'\r\n                                        |translate}}</span> \r\n                                    <span *ngIf=\"BranchData.applicationstatus == '8'\">{{'table.confsiteautit'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"BranchData.applicationstatus == '9'\">{{'table.readforaudit'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"BranchData.applicationstatus == '10'\">{{'table.submforqualmana'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"BranchData.applicationstatus == '11'\">{{'table.submforauthor'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"BranchData.applicationstatus == '12'\">{{'table.submforceo'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"BranchData.applicationstatus == '13'\">{{'table.siteaudidecl'\r\n                                        |translate}}</span> \r\n                                    <span *ngIf=\"BranchData.applicationstatus == '14'\">{{'table.resubmforqual'\r\n                                        |translate}}</span> \r\n                                    <span *ngIf=\"BranchData.applicationstatus == '15'\">{{'table.resubmforauth'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"BranchData.applicationstatus == '16'\">{{'table.resubmforceoapp'\r\n                                        |translate}}</span> \r\n                                    <span *ngIf=\"BranchData.applicationstatus == '17'\">{{'table.approved'\r\n                                        |translate}}</span></div>\r\n                                        </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"certification\">\r\n                                    <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                        {{'branch.certstat' | translate}} </mat-header-cell>\r\n                                    <mat-cell data-label=\"certification\" fxFlex=\"190px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"> <span *ngIf=\"BranchData.certification == '1'\" class=\"liteorange\">{{'table.new'\r\n                                            |translate}}</span>\r\n                                            <span *ngIf=\"BranchData.certification == '2'\" class=\"green\">{{'table.acti'\r\n                                                |translate}}</span>\r\n                                        <span *ngIf=\"BranchData.certification == '3'\" class=\"red\">{{'table.expi'\r\n                                            |translate}}</span></div></mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"addedon\">\r\n                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                        {{'branch.addon' | translate}} </mat-header-cell>\r\n                                    <mat-cell data-label=\"addedon\" fxFlex=\"263px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\">{{BranchData.addedon}}</div></mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"lastUpdated\">\r\n                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                        {{'branch.lastupdat' | translate}} </mat-header-cell>\r\n                                    <mat-cell data-label=\"lastUpdated\" fxFlex=\"263px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\">{{(BranchData.lastUpdated)?BranchData.lastUpdated:'-'}}</div> </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"action\" stickyEnd>\r\n                                    <mat-header-cell fxFlex=\"100px\" mat-header-cell *matHeaderCellDef>{{'branch.action'\r\n                                        | translate}}\r\n                                    </mat-header-cell>\r\n                                    <mat-cell data-label=\"action\" fxFlex=\"100px\" *matCellDef=\"let BranchData\">\r\n                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                        <div *ngIf=\"!tblplaceholder\"><div class=\"manageoptions\">\r\n                                            <button class=\"menubutton\" mat-icon-button [matMenuTriggerFor]=\"actionmenu\"\r\n                                                aria-label=\"Example icon-button with a menu\">\r\n                                                <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                            </button>\r\n                                            <mat-menu #actionmenu=\"matMenu\"\r\n                                                class=\"master-menu whentootltipadded table_menu\">\r\n                                                <!-- edit -->\r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.applicationstatus == '1'\" (click)=\"editapplicationdata(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,'edit')\"><span>{{'table.edit' |\r\n                                                        translate}} </span></button>\r\n                                                 <!-- view -->\r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.applicationstatus == '2' || BranchData.applicationstatus == '4' || BranchData.applicationstatus == '17'\"  (click)=\"editapplicationdata(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,'view')\"><span>{{'table.certificate' | translate}}</span></button>\r\n                                               <!-- renew  -->\r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.days && BranchData.days < 30\" (click)=\"editapplicationdata(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,'renew')\" ><span>{{'table.renew' |translate}}</span></button>\r\n                                               <!-- update -->\r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.applicationstatus == '3'\"  (click)=\"editapplicationdata(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,'update')\" ><span>{{'table.updatcert' | translate}}</span></button>\r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.applicationstatus == '5' || BranchData.applicationstatus == '18' \" (click)=\"makepayment(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,BranchData.appdt_apptype,BranchData.appdt_status,'edit')\"><span>{{'table.makepaym' | translate}}</span></button>\r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.applicationstatus == '6'\"   (click)=\"makepayment(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,BranchData.appdt_apptype,BranchData.appdt_status,'edit')\"><span>{{'table.paymdeta' | translate}}</span></button>\r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.applicationstatus == '8'\" (click)=\"makepayment(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,BranchData.appdt_apptype,BranchData.appdt_status,'edit')\" ><span>{{'table.confirm' | translate}}</span></button> \r\n                                                <button type=\"button\" mat-menu-item *ngIf=\"BranchData.applicationstatus == '9'\" (click)=\"makepayment(BranchData.applicationdtlstmp_pk,BranchData.appdt_projectmst_fk,BranchData.appdt_apptype,BranchData.appdt_status,'edit')\" ><span>{{'table.viewsite' | translate}}</span></button>\r\n                                                <!-- <button type=\"button\" mat-menu-item><span>{{'table.addbatch' |\r\n                                                        translate}}</span></button> --> \r\n                                            </mat-menu>\r\n                                        </div></div>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-first\">\r\n                                    <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"appl_form\" (keyup)=\"applyFilter($event.target.value,'appl_form')\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-second\">\r\n                                    <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.sele' |\r\n                                                translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"officetype\" (selectionChange)=\"applyFilter($event.value,'officetype')\" multiple>\r\n                                                <mat-option value=\"1\">{{'table.main' |translate}}</mat-option>\r\n                                                <mat-option value=\"2\">{{'table.branch' |translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-three\">\r\n                                    <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"bran_name\" (keyup)=\"applyFilter($event.target.value,'bran_name')\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-four\">\r\n                                    <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.sele' |\r\n                                                translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"coures_type\" (selectionChange)=\"applyFilter($event.value,'coures_type')\" multiple>\r\n                                                <mat-option value=\"2\">{{'table.stand' |translate}}</mat-option>\r\n                                                <mat-option value=\"3\">{{'table.cust' |translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-five\">\r\n                                    <mat-header-cell fxFlex=\"270px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"course_titles\"  (keyup)=\"applyFilter($event.target.value,'course_titles')\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-six\">\r\n                                    <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"course_cat\"  (keyup)=\"applyFilter($event.target.value,'course_cat')\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-seven\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.sele' |\r\n                                                translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"requested\" (selectionChange)=\"applyFilter($event.value,'requested')\" multiple>\r\n                                                <mat-option *ngFor=\"let req of reqformst\"\r\n                                                value={{req.referencemst_pk}}>{{ifarbic == true ?\r\n                                                (req.rm_name_ar):(req.rm_name_en)}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-eight\">\r\n                                    <mat-header-cell fxFlex=\"300px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"courdeliver\"  (keyup)=\"applyFilter($event.target.value,'courdeliver')\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-nine\">\r\n                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                <input id=\"login_session\"  (ngModelChange)=\"applyFilter($event,'date_expiry')\" [formControl]=\"date_expiry\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                <div class=\"closeanddateicon\">\r\n                                                    <mat-datepicker-toggle matSuffix >\r\n                                                    </mat-datepicker-toggle>\r\n                                                </div>\r\n                                            </div>\r\n                                         \r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-ten\">\r\n                                    <mat-header-cell fxFlex=\"280px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.sele' |\r\n                                                translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"appl_status\" panelClass=\"select_with_search multiple\" (selectionChange)=\"applyFilter($event.value,'appl_status')\" multiple>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option value=\"1\">{{'table.yettosubmit' |translate}}</mat-option>\r\n                                                <mat-option value=\"2\">{{'table.subfordesk' |translate}}</mat-option>\r\n                                                <mat-option value=\"3\">{{'table.declduringdesk' |translate}}</mat-option>\r\n                                                <mat-option value=\"4\">{{'table.resubmdesk' |translate}}</mat-option>\r\n                                                <mat-option value=\"5\">{{'table.yettopay' |translate}}</mat-option>\r\n                                                <mat-option value=\"6\">{{'table.paidconfipend' |translate}}</mat-option>\r\n                                                <mat-option value=\"7\">{{'table.awitorsiteaudit' |translate}}</mat-option>\r\n                                                <mat-option value=\"8\">{{'table.confsiteautit' |translate}}</mat-option>\r\n                                                <mat-option value=\"9\">{{'table.readforaudit' |translate}}</mat-option>\r\n                                                <mat-option value=\"10\">{{'table.submforqualmana' |translate}}</mat-option>\r\n                                                <mat-option value=\"11\">{{'table.submforauthor' |translate}}</mat-option>\r\n                                                <mat-option value=\"12\">{{'table.submforceo' |translate}}</mat-option>\r\n                                                <mat-option value=\"13\">{{'table.siteaudidecl' |translate}}</mat-option>\r\n                                                <mat-option value=\"14\">{{'table.resubmforqual' |translate}}</mat-option>\r\n                                                <mat-option value=\"15\">{{'table.resubmforauth' |translate}}</mat-option>\r\n                                                <mat-option value=\"16\">{{'table.resubmforceoapp' |translate}}</mat-option>\r\n                                                <mat-option value=\"17\">{{'table.approved' |translate}}</mat-option>\r\n                                                </div>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-eleven\">\r\n                                    <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.sele' |\r\n                                                translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"cert\" multiple>\r\n                                                <mat-option value=\"1\">{{'table.new' |translate}}</mat-option>\r\n                                                <mat-option value=\"2\">{{'table.acti' |translate}}</mat-option>\r\n                                                <mat-option value=\"3\">{{'table.expi' |translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-twelve\">\r\n                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                <input id=\"login_session\" [formControl]=\"addedon_branch\"  (ngModelChange)=\"applyFilter($event,'addedon_branch')\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                <div class=\"closeanddateicon\">\r\n                                                    <mat-datepicker-toggle matSuffix >\r\n                                                    </mat-datepicker-toggle>\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-thirten\">\r\n                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                <input id=\"login_session\" (ngModelChange)=\"applyFilter($event,'addedon_branch')\" [formControl]=\"lastUpdated_branch\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                <div class=\"closeanddateicon\">\r\n                                                    <mat-datepicker-toggle matSuffix >\r\n                                                    </mat-datepicker-toggle>\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-fourteen\" stickyEnd>\r\n                                    <mat-header-cell fxFlex=\"100px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n\r\n                                        <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"clearFiltersecound();filtersts=false;\"\r\n                                            aria-hidden=\"true\" matTooltip=\"{{'table.refr' |translate}}\"></i>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"BranchListData;sticky: true\" >\r\n                                </mat-header-row>\r\n                                <mat-header-row id=\"searchrow\"\r\n                                    *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-three' , 'row-four' , 'row-five' , 'row-six' , 'row-seven' , 'row-eight' , 'row-nine' , 'row-ten' , 'row-eleven' , 'row-twelve' , 'row-thirten' , 'row-fourteen']\">\r\n                                </mat-header-row>\r\n                                <mat-row mat-row *matRowDef=\"let row; columns: BranchListData;\"></mat-row>\r\n                                <ng-container matColumnDef=\"disclaimer\">\r\n                                    <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n                                        <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                            <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                    </div>\r\n                                </div>\r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container>\r\n                                  \r\n                                    <mat-footer-row [style.display]=\"(resultsLength > 0) ? 'none' : 'block' \" \r\n                                        *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                    </mat-footer-row>\r\n                                </ng-container>\r\n                            </mat-table>\r\n                        </div>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                    class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                    [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                    [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                    [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                </mat-paginator>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </ng-template>\r\n            <ng-template [ngSwitchCase]=\"'standardFroms'\">\r\n                <mat-tab-group class=\"tabsdetials \" *ngIf=\"ShowHide\" [(selectedIndex)]=\"mattab\" (selectedTabChange)=\"onTabSelect($event)\">\r\n                    <!--tab 1-->\r\n                    <mat-tab>\r\n                        <ng-template mat-tab-label>\r\n                            <div class=\"tabscontent\">\r\n                                <span class=\"contentcircle m-r-10\">1</span>\r\n                                <div class=\"tabtitle\">\r\n                                    <P class=\"fs-14\">{{'course.course' | translate}}</P>\r\n                                </div>\r\n                            </div>\r\n                        </ng-template>\r\n                        <!-- <div class=\"formcontainer m-t-25\">\r\n                            <div class=\"title\" fxLayout=\"row\" fxLayoutAlign=\"center center\">\r\n                                <h4 clas=\"fs-18\"> {{'course.course' | translate}}</h4>\r\n                                <div class=\"line p-l-20\"><mat-divider></mat-divider></div>\r\n                            </div>\r\n                        </div> -->\r\n                        <div class=\"successcmd m-l-0 m-r-0 m-b-20 m-t-25\" *ngIf=\"coursecommandsts == 3 || coursecommandsts == 4\" [ngClass]=\"coursecommandsts == 4 ? 'declinecmd' : 'successcmd'\">\r\n                            <p class=\"18 comment\" *ngIf=\"coursecommandsts == 3\">{{'institute.approvalcmd' | translate}}</p>\r\n                            <p class=\"18 comment\" *ngIf=\"coursecommandsts == 4\">{{'institute.declcomm' | translate}}</p>\r\n                            <p class=\"16 m-b-30\" >{{coursecommand}}</p>\r\n                                <mat-divider></mat-divider>\r\n                               <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{courseappon}}</span></p>\r\n                                <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{courseappby}}</span></p>\r\n                               </div>\r\n                        </div>\r\n                        <form autocomplete=\"off\" [formGroup]=\"CourseForm\">\r\n                            <div class=\"formcontainer m-t-15\">\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'course.offtype' | translate}} </mat-label>\r\n                                            <mat-select required formControlName=\"office_type\" required\r\n                                                panelClass=\"select_with_option\"\r\n                                                (selectionChange)=\"offictypechange(cour.office_type.value)\">\r\n                                                <mat-option [value]=\"1\">{{'table.main' |translate}}</mat-option>\r\n                                                <mat-option [value]=\"2\">{{'table.branch' |translate}}</mat-option>\r\n                                            </mat-select>\r\n                                            <mat-error\r\n                                                *ngIf=\"cour.office_type.errors?.required || CourseForm.submitted\">\r\n                                                {{'course.selectofftype' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div *ngIf=\"showbranch\" fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'course.branchname' | translate}} </mat-label>\r\n                                            <mat-select required formControlName=\"bran_ch\" required  (selectionChange)=\"branchchoose(cour.bran_ch.value)\"\r\n                                                panelClass=\"select_with_option\">\r\n                                                <mat-option *ngFor=\"let branch of branchlist\"\r\n                                                    value={{branch.appinstinfomain_pk}}>{{branch.branchname_en}}</mat-option>\r\n\r\n                                            </mat-select>\r\n                                            <mat-error *ngIf=\"cour.bran_ch.errors?.required || CourseForm.submitted\">\r\n                                                {{'course.selectbranchname' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                    <div fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'course.courtitl' | translate}} </mat-label>\r\n                                            <mat-select required formControlName=\"course_titleen\"\r\n                                                [errorStateMatcher]=\"matcher\" panelClass=\"select_with_search\"\r\n                                                [disableOptionCentering]=\"true\"\r\n                                                *ngIf=\"(courselist | filter : searchGovernorate) as goverresult\"\r\n                                                (selectionChange)=\"selectedcourse(cour.course_titleen.value)\">\r\n                                                <div class=\"searchinmultiselect\">\r\n                                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                        matInput class=\"searchselect\" type=\"Search\"\r\n                                                        placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                        (keydown)=\"$event.stopPropagation();\"\r\n                                                        [(ngModel)]=\"searchGovernorate\"\r\n                                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                    <mat-icon (click)=\"searchGovernorate = ''\" class=\"reseticon\"\r\n                                                        matSuffix\r\n                                                        *ngIf=\"searchGovernorate !='' && searchGovernorate !=null\">clear</mat-icon>\r\n                                                </div>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                    <mat-option\r\n                                                        *ngFor=\"let cousre of courselist | filter : searchGovernorate\"\r\n                                                        value={{cousre.pk}}>{{cousre.course_en}}</mat-option>\r\n                                                    <div *ngIf=\"goverresult?.length == 0\">No result found</div>\r\n                                                </div>\r\n                                            </mat-select>\r\n                                            <mat-error\r\n                                                *ngIf=\"cour.course_titleen.errors?.required || CourseForm.submitted\">\r\n                                                {{'course.entecourengl' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\">\r\n                                            <mat-label>{{'course.courlevel' | translate}}</mat-label>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                [errorStateMatcher]=\"matcher\" matInput formControlName=\"cour_level\"\r\n                                                [readonly]=\"editOption\">\r\n                                            <!-- <mat-error *ngIf=\"cour.cour_level.errors?.required || CourseForm.submitted\">\r\n                                                {{'course.selecourlevel' | translate}}\r\n                                            </mat-error> -->\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\">\r\n                                            <mat-label>{{'course.courcate' | translate}}</mat-label>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                [errorStateMatcher]=\"matcher\" matInput formControlName=\"cour_cate\"\r\n                                                [readonly]=\"editOption\">\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-select required formControlName=\"cour_subcate\" multiple\r\n                                                *ngIf=\"(governoratelist | filter : searchGovernorate1) as sublist\"\r\n                                                panelClass=\"select_with_search multiple\">\r\n                                                <mat-select-trigger>\r\n                                                    {{CourseForm.controls['cour_subcate'].value ? businessUnitDataTemp :\r\n                                                    ''}}\r\n                                                    <span *ngIf=\"CourseForm.controls['cour_subcate'].value?.length > 1\"\r\n                                                        class=\"example-additional-selection\">\r\n                                                        (+{{CourseForm.controls['cour_subcate'].value.length - 1}}\r\n                                                        {{CourseForm.controls['cour_subcate'].value?.length === 2 ?\r\n                                                        'other' : 'others'}})\r\n                                                    </span>\r\n                                                </mat-select-trigger>\r\n                                                <div class=\"searchinmultiselect\">\r\n                                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                        matInput class=\"searchselect\" type=\"Search\"\r\n                                                        placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                        (keydown)=\"$event.stopPropagation();\"\r\n                                                        [(ngModel)]=\"searchGovernorate1\"\r\n                                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                    <mat-icon (click)=\"searchGovernorate1 = ''\" class=\"reseticon\"\r\n                                                        matSuffix\r\n                                                        *ngIf=\"searchGovernorate1 !='' && searchGovernorate1 !=null\">clear</mat-icon>\r\n                                                </div>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                    <mat-option\r\n                                                        *ngFor=\"let subcate of subcategory  | filter : searchGovernorate1 \"\r\n                                                        value={{subcate.subpk}}> {{subcate.subcategory_en}}</mat-option>\r\n                                                    <div *ngIf=\"sublist?.length == 0\">No result found</div>\r\n                                                </div>\r\n                                            </mat-select>\r\n                                            <mat-label>{{'course.coursubcate' | translate}}</mat-label>\r\n                                            <mat-error *ngIf=\"cour.cour_subcate.errors?.required || CourseForm.submitted\">\r\n                                                {{'course.selectthesub' | translate}}\r\n                                            </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-select required formControlName=\"request_for\"  (selectionChange)=\"selectedreqfor(cour.request_for.value)\"\r\n                                                panelClass=\"select_with_option\">\r\n                                                <mat-option *ngFor=\"let req of reqformst\"\r\n                                                    value={{req.referencemst_pk}}>{{ifarbic == true ?\r\n                                                    (req.rm_name_ar):(req.rm_name_en)}}</mat-option>\r\n\r\n                                            </mat-select>\r\n                                            <mat-label>{{'course.request' | translate}}</mat-label>\r\n                                            <mat-error\r\n                                                *ngIf=\"cour.request_for.errors?.required || CourseForm.submitted\">\r\n                                                {{'course.selerequest' | translate}}\r\n                                            </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div *ngIf=\"standorcustom == 'custom'\" fxLayout=\"column\">\r\n                                    <p class=\"fs-18 txt-gry3 subtitleform\">{{'course.courunit' | translate}}</p>\r\n                                    <div class=\"detials\">\r\n                                        <div class=\"paginationwithfilter masterPageTop \">\r\n                                            <mat-paginator class=\"masterPage masterPageTop\" #paginators [length]=\"resultsLengthcode\"\r\n                                                [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                                (page)=\"syncPrimaryunitcde($event);\"></mat-paginator>\r\n                                        </div>\r\n                                    </div>\r\n                                    <div class=\"courebox m-t-15\">\r\n                                        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 units\"\r\n                                            *ngFor=\"let uni of unit\">\r\n                                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" >\r\n                                                <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\">\r\n                                                    <mat-label>{{'course.unitcode' | translate}} </mat-label>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                        [errorStateMatcher]=\"matcher\" matInput \r\n                                                         required [readonly]=\"editOption\"\r\n                                                        value={{uni.appocum_UnitCode}}>\r\n\r\n                                                </mat-form-field>\r\n                                            </div>\r\n                                            <div fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                                                ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-20\" ngClass.xl=\"p-l-20\"\r\n                                                fxFlex=\"100\">\r\n                                                <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\">\r\n                                                    <mat-label>{{'course.unittitl' | translate}} </mat-label>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                        [errorStateMatcher]=\"matcher\" matInput \r\n                                                         required [readonly]=\"editOption\"\r\n                                                        value={{uni.appocum_UnitTitle}}>\r\n\r\n                                                </mat-form-field>\r\n                                            </div>\r\n\r\n                                        </div>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                        <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                            class=\"masterPage masterbottom \" showFirstLastButtons [pageSize]=\"paginators?.pageSize\"\r\n                                            (page)=\"syncPrimaryunitcde($event);\" [pageIndex]=\"paginators?.pageIndex\"\r\n                                            [length]=\"paginators?.length\" [pageSizeOptions]=\"paginators?.pageSizeOptions\">\r\n                                        </mat-paginator>\r\n                                    </div>\r\n                                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 units\">\r\n                                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                            <mat-form-field appearance=\"outline\" *ngIf = \"!others\">\r\n                                                <mat-label>{{'course.courdeli' | translate}} </mat-label>\r\n                                                <mat-select required formControlName=\"course_delivered\"\r\n                                                    [errorStateMatcher]=\"matcher\" panelClass=\"select_with_search\"\r\n                                                    [disableOptionCentering]=\"true\"\r\n                                                    *ngIf=\"(deliverto | filter : searchGovernorate) as goverresult\"\r\n                                                    (selectionChange)=\"delivertochange(cour.course_delivered.value)\"\r\n                                                    panelClass=\"select_with_search\" >\r\n                                                    <div class=\"searchinmultiselect\">\r\n                                                        <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                        <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                            matInput class=\"searchselect\" type=\"Search\"\r\n                                                            placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                            (keydown)=\"$event.stopPropagation();\"\r\n                                                            [(ngModel)]=\"searchGovernorate\"\r\n                                                            [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                        <mat-icon (click)=\"searchGovernorate = ''\" class=\"reseticon\"\r\n                                                            matSuffix\r\n                                                            *ngIf=\"searchGovernorate !='' && searchGovernorate !=null\">clear</mat-icon>\r\n                                                    </div>\r\n                                                    <div class=\"option-listing countryselectwithimage\">\r\n                                                        <mat-option\r\n                                                            *ngFor=\"let deliver of deliverto | filter : searchGovernorate\"\r\n                                                            value={{deliver.referencemst_pk}}>{{ifarbic == true?\r\n                                                            (deliver.rm_name_ar):(deliver.rm_name_en)}}</mat-option>\r\n                                                            <mat-option value=\"others\">{{'Others'}}</mat-option>\r\n                                                        <div *ngIf=\"goverresult?.length == 0\">No result found</div>\r\n                                                    </div>\r\n                                                </mat-select>\r\n                                                <mat-error\r\n                                                *ngIf=\"cour.course_delivered.errors?.required || CourseForm.submitted\">\r\n                                                {{'course.selectcourdeli' | translate}}\r\n                                            </mat-error>\r\n                                            </mat-form-field>\r\n                                            <mat-form-field appearance=\"outline\" *ngIf = \"others\">\r\n                                                <mat-label>{{'course.courdeli' | translate}} </mat-label>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" formControlName=\"course_delivered_new\"\r\n                                                      matInput \r\n                                                    required\r\n                                                    >\r\n                                                    <mat-error\r\n                                                    *ngIf=\"cour.course_delivered_new.errors?.required || CourseForm.submitted\">\r\n                                                    {{'course.Enterctcourdeli' | translate}}\r\n                                                </mat-error>\r\n                                            </mat-form-field>\r\n                                        \r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                                <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                    (click)=\"prev()\">{{'course.canc' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button color=\"primary\" *ngIf=\"this.applicationtype == 'new'\"  type=\"submit\" (click)=\"courseAdd()\"\r\n                                    class=\"ShowHidefs-15 submit_btn m-l-10\">{{'course.saveandnext' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button color=\"primary\"  *ngIf=\"this.applicationtype == 'edit' || this.applicationtype == 'update'\" type=\"submit\" (click)=\"courseAdd()\"\r\n                                    class=\"ShowHidefs-15 submit_btn m-l-10\">{{'course.updateandnext' | translate}}\r\n                                </button>\r\n                                 <button mat-raised-button color=\"primary\" *ngIf=\"this.applicationtype == 'view'\"  type=\"submit\" (click)=\"nexttab()\"\r\n                                    class=\"ShowHidefs-15 submit_btn m-l-10\">{{'course.next' | translate}}\r\n                                </button>\r\n                            </div>\r\n                        </form>\r\n                    </mat-tab>\r\n                    <!--tab 2-->\r\n                    <mat-tab>\r\n                        <ng-template mat-tab-label>\r\n                            <div class=\"tabscontent\">\r\n                                <span class=\"contentcircle m-r-10\">2</span>\r\n                                <div class=\"tabtitle\">\r\n                                    <P class=\"fs-14\">{{'international.interreco' | translate}}</P>\r\n                                </div>\r\n                            </div>\r\n                        </ng-template>\r\n                        <!-- <div class=\"formcontainer m-t-25\">\r\n                            <div class=\"title\" fxLayout=\"row\" fxLayoutAlign=\"center center\">\r\n                                <h4 clas=\"fs-18\">{{'international.interreco' | translate}}</h4>\r\n                                <div class=\"line p-l-20\"><mat-divider></mat-divider></div>\r\n                            </div>\r\n                            <div class=\"successcmd m-l-0 m-r-0 m-b-20\" *ngIf=\"interstatus == 3 || interstatus == 4 \" [ngClass]=\"interstatus == 4 ? 'declinecmd' : 'successcmd'\">\r\n                                <p class=\"18 comment\" *ngIf=\"interstatus == 3\">{{'institute.approvalcmd' | translate}}</p>\r\n                                <p class=\"18 comment\" *ngIf=\"interstatus == 4\">{{'institute.declcomm' | translate}}</p>\r\n                                <p class=\"16 m-b-30\" >{{intercomment}}</p>\r\n                                    <mat-divider></mat-divider>\r\n                                   <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                    <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{interaddedon}}</span></p>\r\n                                    <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{interaddedby}}</span></p>\r\n                                   </div>\r\n                            </div>\r\n                        </div> -->\r\n                        <div class=\"paginationwithfilter masterPageTop m-b-25\">\r\n                            <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                            <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"secondaryLength\"\r\n                                [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                (page)=\"secondaryPaginator($event);\"></mat-paginator>\r\n                            <div fxLayout=\"row wrap\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                    <button *ngIf=\"this.applicationtype !='view'\" mat-raised-button color=\"primary\" type=\"button\" (click)=\"sHowhide()\"\r\n                                        class=\"ShowHidefs-15 submit_btn m-r-10\">{{'international.add' | translate}}\r\n                                    </button>\r\n                                    <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent()\"\r\n                                        class=\"filter\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                            aria-hidden=\"true\"></i></button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                                <div class=\"awaredtable\">\r\n                                    <mat-table #table class=\"scrolldata\" [dataSource]=\"dataSource\" matSort multiTemplateDataRows\r\n                                        matSortDisableClear>\r\n                                        <ng-container matColumnDef=\"irm_intlrecogname_en\">\r\n                                            <mat-header-cell fxFlex=\"300px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'international.awarorgan' | translate}}\r\n                                            </mat-header-cell>\r\n                                            <mat-cell data-label=\"irm_intlrecogname_en\" fxFlex=\"300px\"\r\n                                                *matCellDef=\"let element\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{element.irm_intlrecogname_en}}</div> </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"last_aud\">\r\n                                            <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'international.lastaudi' |\r\n                                                translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"last_aud\" fxFlex=\"263px\" *matCellDef=\"let element\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{element.last_aud}}</div> </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"url\">\r\n                                            <mat-header-cell fxFlex=\"120px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'international.document' | translate}}\r\n                                            </mat-header-cell>\r\n                                            <mat-cell data-label=\"url\" fxFlex=\"120px\" *matCellDef=\"let element\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\" fxLayoutAlign=\"start center\"><img  href={{element.url}} class=\"document_img\" src=\"assets/images/opalimages/{{element.mcfd_filetype}}_new.svg\">\r\n                                                    <span mat-button class=\"viewdocument txt-gry3 m-t-5 m-l-5\"><a target=\"_blank\"\r\n                                                      class=\"txt-gry3 \"  href={{element.url}}>view</a></span></div></mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"status\">\r\n                                            <mat-header-cell fxFlex=\"170px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>\r\n                                                {{'international.stat' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"status\" fxFlex=\"170px\" *matCellDef=\"let element\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\"> <span *ngIf=\"element.status == '1'\" class=\"liteorange\">{{'table.new'\r\n                                                    |translate}}</span>\r\n                                                <span *ngIf=\"element.status == '2'\" class=\"blue\">{{'table.updated' |translate}}</span>\r\n                                                <!-- <span *ngIf=\"element.status == '3'\" class=\"green\"  (click)=\"expandedElement = expandedElement === element ? null : element\">{{'table.approv'\r\n                                                    |translate}}<img class=\"p-l-15\" matTooltip=\"{{'table.tool' |translate}}\"\r\n                                                    mat-button src=\"assets/images/statusicon.svg\" alt=\"statusicon\"></span>\r\n                                                <span *ngIf=\"element.status == '4'\" class=\"red\"  (click)=\"expandedElement = expandedElement === element ? null : element\">{{'table.decl'\r\n                                                    |translate}}<img class=\"p-l-15\" matTooltip=\"{{'table.tool' |translate}}\"\r\n                                                    mat-button src=\"assets/images/statusicon.svg\" alt=\"statusicon\"></span> -->\r\n                                                    <span *ngIf=\"element.status == '3'\" class=\"green\">{{'table.approv' |translate}}</span>\r\n                                                    <span *ngIf=\"element.status == '4'\" class=\"red\">{{'table.decl' |translate}}</span>\r\n                                                </div>\r\n                                               \r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"created_on\">\r\n                                            <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>\r\n                                                {{'international.addon' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"created_on\" fxFlex=\"263px\" *matCellDef=\"let element\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{element.created_on}}</div>\r\n                                                 </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"updated_on\">\r\n                                            <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>\r\n                                                {{'international.lastupdat' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"updated_on\" fxFlex=\"263px\" *matCellDef=\"let element\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{element.updated_on ? element.updated_on : '-'}}</div>\r\n                                                 </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"action\" stickyEnd>\r\n                                            <mat-header-cell fxFlex=\"100px\" mat-header-cell *matHeaderCellDef>\r\n                                                {{'international.Action' | translate}}\r\n                                            </mat-header-cell>\r\n                                            <mat-cell data-label=\"action\" fxFlex=\"100px\" *matCellDef=\"let element\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\"><div class=\"manageoptions\">\r\n                                                    <button class=\"menubutton\" mat-icon-button\r\n                                                        [matMenuTriggerFor]=\"actionmenu\"\r\n                                                        aria-label=\"Example icon-button with a menu\">\r\n                                                        <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                                    </button>\r\n                                                    <mat-menu #actionmenu=\"matMenu\"\r\n                                                        class=\"master-menu whentootltipadded\">\r\n                                                        <button type=\"button\" mat-menu-item\r\n                                                            (click)=\"interedit(element,'edit')\" *ngIf=\"this.applicationtype !='view'\"><span>{{'table.edit'\r\n                                                                |\r\n                                                                translate}} </span></button>\r\n                                                        <button type=\"button\" mat-menu-item *ngIf=\"this.applicationtype !='view' && element.status == 1\" (click)=\"interdelete(element.appintrecogtmp_pk,'delete')\"><span>{{'table.delete' |\r\n                                                                translate}}</span></button>\r\n                                                        <button type=\"button\" mat-menu-item *ngIf=\"this.applicationtype =='view'\" (click)=\"interedit(element,'view')\"><span>{{'table.view' |\r\n                                                                translate}}</span></button>\r\n                                                    </mat-menu>\r\n                                                </div></div>\r\n                                                \r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"expandedDetail\" stickyEnd>\r\n                                            <td mat-cell fxFlex=\"1479px\"  *matCellDef=\"let element\" [attr.colspan]=\"displayedColumns.length\">\r\n                                              <div *ngIf=\"expandedElement === element\">\r\n                                                <div class=\"example-element-detail\"\r\n                                                   [@detailExpand]=\"element == expandedElement ? 'expanded' : 'collapsed'\" *ngIf=\"element.status == '3' || element.status == '4'\" >\r\n                                                <div class=\"example-element-diagram \"  [ngClass]=\"element.status == 3 ? 'successcmd' : 'declinecmd'\">\r\n                                                    <div fxLayout=\"row\" fxLayoutAlign=\"space-between center\">\r\n                                                        <p class=\"fs-18 comment m-0\">{{'institute.comm' | translate}}  </p>\r\n                                                        <mat-icon  class=\"fs-18 comment\" matTooltip=\"close\" (click)=\"toggleExpansion()\">close</mat-icon>\r\n                                                       </div>\r\n                                                        <p class=\"16 m-b-30\" [innerHTML]=\"element.appintit_appdeccomment | striphtml\" ></p>\r\n                                                            <mat-divider></mat-divider>\r\n                                                           <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                                            <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{element.appintit_appdecon}}</span></p>\r\n                                                            <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{element.oum_firstname}}</span></p>\r\n                                                           </div>\r\n                                                </div>\r\n                                              </div>\r\n                                              </div>\r\n                                            </td>\r\n                                          </ng-container>\r\n                                        <ng-container matColumnDef=\"row-first\">\r\n                                            <mat-header-cell fxFlex=\"300px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                    <input matInput [formControl]=\"Awarding\" (keyup)=\"applyFilterforinter($event.target.value,'Awarding')\">\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-second\">\r\n                                            <mat-header-cell fxFlex=\"263px\" class=\"serachrow datepickerrangeform\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <!-- <mat-label>{{'table.search' |translate}}</mat-label> -->\r\n                                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                                        <input id=\"login_session\" (ngModelChange)=\"applyFilterforinter($event,'LastAudited')\" [formControl]=\"LastAudited\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                        <div class=\"closeanddateicon\">\r\n                                                            <mat-datepicker-toggle matSuffix >\r\n                                                            </mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-three\">\r\n                                            <mat-header-cell fxFlex=\"120px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <!-- <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                    <input matInput [formControl]=\" \">\r\n                                                </mat-form-field> -->\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <!-- <ng-container matColumnDef=\"row-three\"></ng-container> -->\r\n                                        <ng-container matColumnDef=\"row-four\">\r\n                                            <mat-header-cell fxFlex=\"170px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.sele' |translate}}</mat-label>\r\n                                                    <mat-select [formControl]=\"Status\" multiple (selectionChange)=\"applyFilterforinter($event.value,'Status')\">\r\n                                                        <mat-option value=\"1\">{{'table.new' |translate}}</mat-option>\r\n                                                        <mat-option value=\"2\">{{'table.updated'\r\n                                                            |translate}}</mat-option>\r\n                                                        <mat-option value=\"3\">{{'table.approv' |translate}}</mat-option>\r\n                                                        <mat-option value=\"4\">{{'table.decl' |translate}}</mat-option>\r\n                                                    </mat-select>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-five\">\r\n                                            <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <!-- <mat-label>{{'table.search' |translate}}</mat-label> -->\r\n                                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                                        <input id=\"login_session\" (ngModelChange)=\"applyFilterforinter($event,'Addedon')\" [formControl]=\"Addedon\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                        <div class=\"closeanddateicon\">\r\n                                                            <mat-datepicker-toggle matSuffix >\r\n                                                            </mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    \r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-six\">\r\n                                            <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                                        <input id=\"login_session\" (ngModelChange)=\"applyFilterforinter($event,'LastUpdated')\" [formControl]=\"LastUpdated\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                        <div class=\"closeanddateicon\">\r\n                                                            <mat-datepicker-toggle matSuffix >\r\n                                                            </mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-seven\" stickyEnd>\r\n                                            <mat-header-cell fxFlex=\"100px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n\r\n                                                <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"Filterinternational();filtersts=false;\"\r\n                                                    aria-hidden=\"true\" matTooltip=\"{{'table.refr' |translate}}\"></i>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <!-- <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"displayedColumns\">\r\n                                        </mat-header-row>\r\n                                        <mat-header-row id=\"searchrow\"\r\n                                            *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six' , 'row-seven']\">\r\n                                        </mat-header-row>\r\n                                        <mat-row mat-row *matRowDef=\"let row; columns: displayedColumns;\"></mat-row> -->\r\n                                        <tr mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"displayedColumns;sticky: true\"></tr>\r\n                                        <mat-header-row id=\"searchrow\"\r\n                                        *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six' , 'row-seven']\">\r\n                                        </mat-header-row>\r\n                                        <tr mat-row *matRowDef=\"let element; columns: displayedColumns;\" class=\"example-element-row\"\r\n                                            [class.example-expanded-row]=\"expandedElement === element\">\r\n                                        </tr>\r\n                                        <tr mat-row *matRowDef=\"let element; columns: ['expandedDetail']\"\r\n                                        [class.example-detail-row-expanded]=\"expandedElement === element\"\r\n                                        [class.example-detail-row-collapsed]=\"expandedElement !== element\">\r\n                                    </tr>\r\n                                        <!-- <tr mat-row *matRowDef=\"let row; columns: ['expandedDetail']\" class=\"example-detail-row\"></tr> -->\r\n                                        <ng-container matColumnDef=\"disclaimer\">\r\n                                            <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n                                                <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                    <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                        <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                        <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                            </div>\r\n                                        </div>\r\n                                            </td>\r\n                                        </ng-container>\r\n                                        <ng-container>\r\n                                          \r\n                                            <mat-footer-row [style.display]=\"(secondaryLength > 0) ? 'none' : 'block' \" \r\n                                                *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                            </mat-footer-row>\r\n                                        </ng-container>\r\n                                    </mat-table>\r\n                                </div>\r\n                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                        <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                            class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                            [pageSize]=\"paginator?.pageSize\" (page)=\"secondaryPaginator($event);\"\r\n                                            [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                            [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                        </mat-paginator>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                            <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                (click)=\"previnst()\">{{'international.prev' | translate}}\r\n                            </button>\r\n                            <button mat-raised-button color=\"primary\" type=\"button\" (click)=\"nextOperate()\"\r\n                                class=\"ShowHidefs-15 submit_btn m-l-10\">{{'international.next' | translate}}\r\n                            </button>\r\n                        </div>\r\n                    </mat-tab>\r\n                    <!--tab 3-->\r\n                    <mat-tab>\r\n                        <ng-template mat-tab-label>\r\n                            <div class=\"tabscontent\">\r\n                                <span class=\"contentcircle m-r-10\">3</span>\r\n                                <div class=\"tabtitle\">\r\n                                    <P class=\"fs-14\">{{'documents.docurequ' | translate}}</P>\r\n                                </div>\r\n                            </div>\r\n                        </ng-template>\r\n                        <!-- <div class=\"formcontainer m-t-25\">\r\n                            <div class=\"title\" fxLayout=\"row\" fxLayoutAlign=\"center center\">\r\n                                <h4 clas=\"fs-18\"> {{'documents.docurequ' | translate}}</h4>\r\n                                <div class=\"line p-l-20\"><mat-divider></mat-divider></div>\r\n                            </div>\r\n                        </div> -->\r\n                      \r\n                        <form autocomplete=\"off\" [formGroup]=\"documentForm\" id=\"documentForm\">\r\n                            <div class=\"requiredfiels m-t-25\" *ngFor=\"let doc of docmst ;let indexOfelement=index;\">\r\n\r\n                                <div class=\"successcmd m-l-0 m-r-0 m-b-20\" *ngIf=\"doc.appdst_status == 3 || doc.appdst_status == 4\" [ngClass]=\"doc.appdst_status == 4 ? 'declinecmd' : 'successcmd'\">\r\n                                    <p class=\"18 comment\" *ngIf=\"doc.appdst_status == 3\">{{'institute.approvalcmd' | translate}}</p>\r\n                                    <p class=\"18 comment\" *ngIf=\"doc.appdst_status == 4\">{{'institute.declcomm' | translate}}</p>\r\n                                    <p class=\"16 m-b-30\" [innerHTML]=\"doc.appdst_appdeccomment | striphtml\"></p>\r\n                                        <mat-divider></mat-divider>\r\n                                       <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                        <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{doc.appdst_appdecon}}</span></p>\r\n                                        <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{doc.oum_firstname}}</span></p>\r\n                                       </div>\r\n                                </div>\r\n\r\n                                <h4 class=\"m-0 fs-16\">{{indexOfelement+1}}{{'.'}} {{ifarbic == true?\r\n                                    (doc.ddm_documentname_ar):(doc.ddm_documentname_en)}}</h4>\r\n                                <span *ngIf=\"formParentArrayFormation(indexOfelement+1,'text',doc)\"></span>\r\n \r\n                                <input matInput *ngIf=\"hidden\" formControlName=\"referpk_{{indexOfelement+1}}\">\r\n\r\n                                <div class=\"yesno\">\r\n                                    <p class=\"m-r-40\">{{'documents.prov' | translate}}<span class=\"req m-l-5\">*</span>\r\n                                    </p>\r\n                                    <mat-radio-group aria-label=\"Select an option\"\r\n                                        formControlName=\"redio_{{indexOfelement+1}}\">\r\n                                        <mat-radio-button value=\"1\"\r\n                                            (click)=\"docradiobtn(1,indexOfelement+1,doc.documentdtlsmst_pk);\"\r\n                                            class=\"m-r-30 m-l-30\" >{{'documents.yes' |\r\n                                            translate}}</mat-radio-button>\r\n                                        <mat-radio-button value=\"2\"\r\n                                            (click)=\"docradiobtn(2,indexOfelement+1,doc.documentdtlsmst_pk);\"\r\n                                            class=\"m-l-30\">{{'documents.no'\r\n                                            |\r\n                                            translate}}</mat-radio-button>\r\n                                    </mat-radio-group>\r\n                                </div>\r\n\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\"\r\n                                    id=\"doc_{{indexOfelement+1}}\"><!-- *ngIf=\"isValid\" -->\r\n                                    <div fxFlex=\"100\" fxFlex.gt-sm=\"100\" class=\"documents\">\r\n                                        <app-filee #updateinfo [noteHideShow]=\"false\" [fileMstRef]=\"drvInputed1\" [deleteicon]=\"deleteicon\"\r\n                                            (filesSelected)=\"fileeSelected1($event,drvInputed1,indexOfelement+1)\" formControlName=\"file_{{indexOfelement+1}}\">\r\n                                        </app-filee>\r\n                                        <mat-hint class=\"txt-gry fs-12\"> {{'documents.noteyoucanupload' | translate}}</mat-hint>\r\n                                    </div>\r\n                                </div>\r\n                                <div *ngIf=\"doc.ddm_status == 2 || (doc.appdst_submissionstatus && doc.appdst_submissionstatus)== 2\" fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\"\r\n                                    id=\"re_{{indexOfelement+1}}\"><!-- *ngIf=\"!isValid\" -->\r\n                                \r\n                                    <div fxFlex=\"100\" fxFlex=\"90\" class=\"remark\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'documents.remark' | translate}}</mat-label>\r\n                                            <textarea #length matInput (ngModelChange)=\"onCommentChange($event,indexOfelement+1)\" maxlength=\"1000\"\r\n                                                formControlName=\"remark_{{indexOfelement+1}}\" required>\r\n                                         </textarea>\r\n                                            <!-- <mat-error\r\n                                                *ngIf=\"mark.remark_fst.errors?.required || documentForm.submitted\">\r\n                                                {{'documents.enterthrremark' | translate}} </mat-error> -->\r\n                                        </mat-form-field>\r\n                                        <mat-hint fxLayoutAlign=\"flex-end start\"\r\n                                            class=\"fs-13 txt-gry\">{{uploadlength[indexOfelement+1] || 0 || ((doc.appdst_remarks)?(doc.appdst_remarks.length):(0)) }}/1000</mat-hint>\r\n                                            <!-- || ((doc.appdst_remarks.length)?(doc.appdst_remarks.length):(0)) -->\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n\r\n\r\n\r\n                            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                                <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                    (click)=\"prevoperat()\">{{'documents.prev' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button color=\"primary\" type=\"submit\" [disabled]=\"docsavebtn\" *ngIf=\"this.applicationtype == 'new'\"  (click)=\"nextCourse()\"\r\n                                    class=\"ShowHidefs-15 submit_btn m-l-10\">{{'documents.saveandnext' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button color=\"primary\" type=\"submit\" *ngIf=\"this.applicationtype == 'edit' || this.applicationtype == 'update' \" (click)=\"nextCourse()\"\r\n                                class=\"ShowHidefs-15 submit_btn m-l-10\">{{'course.updateandnext' | translate}}\r\n                            </button>\r\n                            <button mat-raised-button color=\"primary\" type=\"submit\"  *ngIf=\"this.applicationtype =='view'\"  (click)=\"gotostaff()\"\r\n                            class=\"ShowHidefs-15 submit_btn m-l-10\">{{'course.next' | translate}}\r\n                        </button>\r\n                      \r\n                            </div>\r\n                        </form>\r\n                    </mat-tab>\r\n                    <!--tab 4-->\r\n                    <mat-tab>\r\n                        <ng-template mat-tab-label>\r\n                            <div class=\"tabscontent\">\r\n                                <span class=\"contentcircle m-r-10\"> 4\r\n                                </span>\r\n                                <div class=\"tabtitle\">\r\n                                    <P class=\"fs-14\">{{'staff.staff' | translate}}</P>\r\n                                </div>\r\n                            </div>\r\n                        </ng-template>\r\n                        <!-- <div class=\"formcontainer m-t-25\">\r\n                            <div class=\"title\" fxLayout=\"row\" fxLayoutAlign=\"center center\">\r\n                                <h4 clas=\"fs-18\"> {{'staff.staff' | translate}}</h4>\r\n                                <div class=\"line p-l-20\"><mat-divider></mat-divider></div>\r\n                            </div>\r\n                        </div> -->\r\n                        <div class=\"successcmd m-l-0 m-r-0 m-b-20 m-t-25\" *ngIf=\"comment == 3 || comment == 4\" [ngClass]=\"comment == true ? 'declinecmd' : 'successcmd'\">\r\n                            <p class=\"18 comment\" *ngIf=\"comment == 3\">{{'institute.approvalcmd' | translate}}</p>\r\n                            <p class=\"18 comment\" *ngIf=\"comment == 4\">{{'institute.declcomm' | translate}}</p>\r\n                            <p class=\"16 m-b-30\" >test</p>\r\n                                <mat-divider></mat-divider>\r\n                               <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">2-03-2023</span></p>\r\n                                <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">sam</span></p>\r\n                               </div>\r\n                        </div>\r\n                        <div class=\"paginationwithfilter masterPageTop \">\r\n                            <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                            <mat-paginator class=\"masterPage masterPageTop\" #paginatorthird [length]=\"thirdLength\"\r\n                                [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                (page)=\"thirdPaginator($event);\"></mat-paginator>\r\n                            <div fxLayout=\"row wrap\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                    <button mat-raised-button color=\"primary\" type=\"button\" *ngIf=\"this.applicationtype !='view'\" (click)=\"showHidestaff()\"\r\n                                        class=\"ShowHidefs-15 submit_btn m-r-10\">{{'international.add' | translate}}\r\n                                    </button>\r\n                                    <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent()\"\r\n                                        class=\"filter\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                            aria-hidden=\"true\"></i></button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                                <div class=\"awaredtable\">\r\n                                    <mat-table #table class=\"scrolldata\" [dataSource]=\"StaffList\" matSort  multiTemplateDataRows\r\n                                        matSortDisableClear>\r\n                                        <ng-container matColumnDef=\"civilnumb\">\r\n                                            <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'staff.civinumb' | translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"civilnumb\" fxFlex=\"250px\" *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{staffData.sir_idnumber}}</div>\r\n                                                  </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"staffname\">\r\n                                            <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'staff.staffnameengl' | translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"staffname\" fxFlex=\"250px\" *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{ifarbic == true ?(staffData.sir_name_ar):(staffData.sir_name_en)}}</div>\r\n                                                </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"age\">\r\n                                            <mat-header-cell fxFlex=\"120px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'staff.age' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"age\" fxFlex=\"120px\" *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{staffData.age}}</div>\r\n                                                  </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"rolecourse\">\r\n                                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'staff.roleofcourse' | translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"rolecourse\" fxFlex=\"230px\"\r\n                                                *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{(ifarbic == true ?(staffData.rm_rolename_ar):(staffData.rm_rolename_en))?(ifarbic == true ?(staffData.rm_rolename_ar):(staffData.rm_rolename_en)):'-'}}</div>\r\n                                                 </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"coursesubcat\">\r\n                                            <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'staff.coursesub' | translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"coursesubcat\" fxFlex=\"200px\"\r\n                                                *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{ifarbic == true ?(staffData.catname_ar):(staffData.catname_en)}}</div>\r\n                                                 </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"status\">\r\n                                            <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>\r\n                                                {{'staff.stat' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"status\" fxFlex=\"190px\" *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\"><span *ngIf=\"staffData.appsit_status == '1'\" class=\"liteorange\">{{'table.new'\r\n                                                    |translate}}</span>\r\n                                                <span *ngIf=\"staffData.appsit_status == '2'\" class=\"blue\">{{'table.updated'\r\n                                                    |translate}}</span>\r\n                                                <!-- <span *ngIf=\"staffData.appsit_status == '3'\" class=\"green\" (click)=\"expandedElement = expandedElement === staffData ? null : staffData\">{{'table.approv'\r\n                                                    |translate}}<img class=\"p-l-15\" matTooltip=\"{{staffData.appsit_appdeccomment}}\"\r\n                                                    mat-button src=\"assets/images/statusicon.svg\" alt=\"statusicon\"></span>\r\n                                                <span *ngIf=\"staffData.appsit_status == '4'\" class=\"red\"  (click)=\"expandedElement = expandedElement === staffData ? null : staffData\">{{'table.decl'\r\n                                                    |translate}}<img class=\"p-l-15\" matTooltip=\"{{staffData.appsit_appdeccomment}}\"\r\n                                                    mat-button src=\"assets/images/statusicon.svg\" alt=\"statusicon\"></span>\r\n                                                    <span *ngIf=\"staffData.appsit_status == '5'\" class=\"declined\">{{'Failed'}}</span></div> -->\r\n                                                    <span *ngIf=\"staffData.appsit_status == '3'\" class=\"green\">{{'table.approv' |translate}}</span>\r\n                                                    <span *ngIf=\"staffData.appsit_status == '4'\" class=\"red\">{{'table.decl' |translate}}</span></div>\r\n                                                </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"competcard\">\r\n                                            <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>\r\n                                                {{'staff.compcard' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"competcard\" fxFlex=\"190px\"\r\n                                                *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\"><span *ngIf=\"staffData.competcard == 'A'\"\r\n                                                    class=\"approved\">{{'table.acti' |translate}}</span>\r\n                                                <span *ngIf=\"staffData.competcard == 'E'\" class=\"update\">{{'table.expi'\r\n                                                    |translate}}</span>\r\n                                                <span *ngIf=\"staffData.competcard == 'EP'\"\r\n                                                    class=\"new\">{{'table.evalpend' |translate}}</span>\r\n                                                <span *ngIf=\"staffData.competcard == 'P'\"\r\n                                                class=\"declined\">{{'table.post' |translate}}</span></div>\r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"add\">\r\n                                            <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'staff.addon' | translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"add\" fxFlex=\"263px\" *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{staffData.addedon}}</div>\r\n                                                 </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"lastUpdated\">\r\n                                            <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'staff.lastupdat' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"lastUpdated\" fxFlex=\"263px\"\r\n                                                *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\">{{staffData.updatedon?staffData.updatedon:'-'}}</div>\r\n                                                 </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"action\" stickyEnd>\r\n                                            <mat-header-cell fxFlex=\"100px\" mat-header-cell\r\n                                                *matHeaderCellDef>{{'staff.Action' | translate}} </mat-header-cell>\r\n                                            <mat-cell data-label=\"action\" fxFlex=\"100px\" *matCellDef=\"let staffData\">\r\n                                                <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                <div *ngIf=\"!tblplaceholder\"><div class=\"manageoptions\">\r\n                                                    <button class=\"menubutton\" mat-icon-button\r\n                                                        [matMenuTriggerFor]=\"actionmenu\"\r\n                                                        aria-label=\"Example icon-button with a menu\">\r\n                                                        <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                                    </button>\r\n                                                    <mat-menu #actionmenu=\"matMenu\"\r\n                                                        class=\"master-menu whentootltipadded\">\r\n                                                        <button type=\"button\" mat-menu-item *ngIf=\"this.applicationtype !='view'\" (click)=\"editstaffgrid(staffData,'edit')\">\r\n                                                            <span>{{'table.edit' | translate}} </span>\r\n                                                        </button>\r\n                                                        <button type=\"button\" mat-menu-item *ngIf=\"this.applicationtype !='view' && staffData.appsit_status == 1\" (click)=\"deletestaffgrid(staffData.appostaffinfotmp_pk)\">\r\n                                                            <span>{{'table.delete' | translate}}</span>\r\n                                                        </button>\r\n                                                        <button type=\"button\" mat-menu-item *ngIf=\"this.applicationtype =='view'\" (click)=\"editstaffgrid(staffData,'view')\">\r\n                                                            <span>{{'table.view' | translate}}</span>\r\n                                                        </button>\r\n                                                    </mat-menu>\r\n                                                </div></div>\r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"expandedDetail\">\r\n                                            <td mat-cell fxFlex=\"1866px\"  *matCellDef=\"let staffData\" [attr.colspan]=\"staffListData.length\">\r\n                                             <div *ngIf=\"expandedElement === staffData\">\r\n                                                <div class=\"example-element-detail\"\r\n                                                [@detailExpand]=\"staffData == expandedElement ? 'expanded' : 'collapsed'\" *ngIf=\"staffData.appsit_status == '3' || staffData.appsit_status == '4'\">\r\n                                             <div class=\"example-element-diagram\" [ngClass]=\"staffData.appsit_status == 3 ? 'successcmd' : 'declinecmd'\">\r\n                                                 <div fxLayout=\"row\" fxLayoutAlign=\"space-between center\">\r\n                                                     <p class=\"fs-18 comment m-0\">{{'institute.comm' | translate}}  </p>\r\n                                                     <mat-icon  class=\"fs-18 comment\" matTooltip=\"close\" (click)=\"toggleExpansion()\">close</mat-icon>\r\n                                                    </div>\r\n                                                     <p class=\"16 m-b-30\" [innerHTML]=\"staffData.appsit_appdeccomment | striphtml\"></p>\r\n                                                         <mat-divider></mat-divider>\r\n                                                        <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                                         <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{staffData.oum_firstname}}</span></p>\r\n                                                         <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{staffData.appsit_appdecby}}</span></p>\r\n                                                        </div>\r\n                                             </div>\r\n                                           </div>\r\n                                             </div>\r\n                                            </td>\r\n                                          </ng-container>\r\n                                        <ng-container matColumnDef=\"row-first\">\r\n                                            <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                    <input matInput [formControl]=\"civil_numb\" (keyup)=\"applyFilterforstaff($event.target.value,'civil_numb')\">\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-second\">\r\n                                            <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                    <input matInput [formControl]=\"staff_name\" (keyup)=\"applyFilterforstaff($event.target.value,'staff_name')\">\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-three\">\r\n                                            <mat-header-cell fxFlex=\"120px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <!-- <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.search' | translate}}</mat-label>\r\n                                                    <mat-select [formControl]=\"age\">\r\n                                                        <mat-option value=\"1\">23</mat-option>\r\n                                                        <mat-option value=\"2\">30</mat-option>\r\n                                                    </mat-select>\r\n                                                </mat-form-field> -->\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-four\">\r\n                                            <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                    <input matInput [formControl]=\"role_course\"  (keyup)=\"applyFilterforstaff($event.target.value,'role_course')\">\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-five\">\r\n                                            <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.search' | translate}}</mat-label>\r\n                                                    <input matInput [formControl]=\"cours_sub_cate\" (keyup)=\"applyFilterforstaff($event.target.value,'cours_sub_cate')\">\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-six\">\r\n                                            <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'table.sele' |\r\n                                                        translate}}</mat-label>\r\n                                                    <mat-select [formControl]=\"StatusCour\" multiple  (selectionChange)=\"applyFilterforstaff($event.value,'StatusCour')\">\r\n                                                        <mat-option value=\"1\">{{'table.new' |translate}}</mat-option>\r\n                                                        <mat-option value=\"2\">{{'table.updated'|translate}}</mat-option>\r\n                                                        <mat-option value=\"3\">{{'table.approv' |translate}}</mat-option>\r\n                                                        <mat-option value=\"4\">{{'table.decl' |translate}}</mat-option>\r\n                                                    </mat-select>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n\r\n                                        <ng-container matColumnDef=\"row-seven\">\r\n                                            <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <!-- <mat-label>{{'table.search' |translate}}</mat-label> -->\r\n                                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                                        <input id=\"login_session\" [formControl]=\"adddoncour\" (ngModelChange)=\"applyFilterforinter($event,'adddoncour')\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                        <div class=\"closeanddateicon\">\r\n                                                            <mat-datepicker-toggle matSuffix >\r\n                                                            </mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    \r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-eight\">\r\n                                            <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <!-- <mat-label>{{'table.search' |translate}}</mat-label> -->\r\n                                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                                        <input id=\"login_session\" [formControl]=\"LastUpdatedcour\" (ngModelChange)=\"applyFilterforinter($event,'LastUpdatedcour')\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                        <div class=\"closeanddateicon\">\r\n                                                            <mat-datepicker-toggle matSuffix >\r\n                                                            </mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                  \r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-nine\" stickyEnd>\r\n                                            <mat-header-cell fxFlex=\"100px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"clearFilterfour();filtersts=false;\"\r\n                                                    aria-hidden=\"true\" matTooltip=\"{{'table.refr' |translate}}\"></i>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <!-- <ng-container matColumnDef=\"row-ten\" stickyEnd>\r\n                                            <mat-header-cell fxFlex=\"100px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                \r\n                                                <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"Filterstaff();filtersts=false;\"\r\n                                                    aria-hidden=\"true\" matTooltip=\"{{'table.refr' |translate}}\"></i>\r\n                                            </mat-header-cell>\r\n                                        </ng-container> -->\r\n                                        <!-- <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"staffListData\">\r\n                                        </mat-header-row>\r\n                                        <mat-header-row id=\"searchrow\"\r\n                                            *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six' , 'row-seven' , 'row-eight', 'row-nine']\">\r\n                                        </mat-header-row>\r\n                                        <mat-row mat-row *matRowDef=\"let row; columns: staffListData;\"></mat-row> -->\r\n                                        <tr mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"staffListData;sticky: true\"></tr>\r\n                                        <mat-header-row id=\"searchrow\"\r\n                                        *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six' , 'row-seven' , 'row-eight', 'row-nine']\">\r\n                                        </mat-header-row>\r\n                                        <tr mat-row *matRowDef=\"let element; columns: staffListData;\" class=\"example-element-row\"\r\n                                            [class.example-expanded-row]=\"expandedElement === element\">\r\n                                        </tr>\r\n                                        <tr mat-row *matRowDef=\"let element; columns: ['expandedDetail']\"\r\n                                        [class.example-detail-row-expanded]=\"expandedElement === element\"\r\n                                        [class.example-detail-row-collapsed]=\"expandedElement !== element\">\r\n                                    </tr>\r\n                                        <ng-container matColumnDef=\"disclaimer\">\r\n                                            <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n                                                <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                    <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                        <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                        <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                            </div>\r\n                                        </div>\r\n                                            </td>\r\n                                        </ng-container>\r\n                                        <ng-container>\r\n                                            <mat-footer-row [style.display]=\"(thirdLength > 0) ? 'none' : 'block' \" \r\n                                                *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                            </mat-footer-row>\r\n                                        </ng-container>\r\n                                    </mat-table>\r\n                                </div>\r\n                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                        <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                            class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                            [pageSize]=\"paginatorthird?.pageSize\" (page)=\"thirdPaginator($event);\"\r\n                                            [pageIndex]=\"paginatorthird?.pageIndex\" [length]=\"thirdLength\"\r\n                                            [pageSizeOptions]=\"paginatorthird?.pageSizeOptions\">\r\n                                        </mat-paginator>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                            <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                (click)=\"prevcourse()\">{{'staff.prev' | translate}}\r\n                            </button>\r\n                            <button  *ngIf=\"(this.StaffList.length >= 1 && this.interdata.length >= 0 ) && ( this.applicationtype != 'view')\"  mat-raised-button color=\"primary\" type=\"button\" (click)=\"finished()\"\r\n                                class=\"ShowHidefs-15 submit_btn m-l-10\">{{'staff.submdeskrev' | translate}}\r\n                            </button>\r\n                        </div>\r\n                    </mat-tab>\r\n                </mat-tab-group>\r\n                <div id=\"forms\">\r\n                    <!--courses-->\r\n                    <form autocomplete=\"off\" [formGroup]=\"awaredForm\" *ngIf=\"international\">\r\n                        <div class=\"successcmd m-l-0 m-r-0 m-b-20\" *ngIf=\"interstatus == 3 || interstatus == 4\" [ngClass]=\"interstatus == 4 ? 'declinecmd' : 'successcmd'\">\r\n                            <p class=\"18 comment\" *ngIf=\"interstatus == 3\">{{'institute.approvalcmd' | translate}}</p>\r\n                            <p class=\"18 comment\" *ngIf=\"interstatus == 4\">{{'institute.declcomm' | translate}}</p>\r\n                            <p class=\"16 m-b-30\"[innerHTML]=\"intercomment | striphtml\" ></p>\r\n                                <mat-divider></mat-divider>\r\n                               <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{interaddedon}}</span></p>\r\n                                <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{interaddedby}}</span></p>\r\n                               </div>\r\n                        </div>\r\n                        <div class=\"formcontainer m-t-25\">\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                    <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                        <mat-select [errorStateMatcher]=\"matcher\" required\r\n                                        formControlName=\"award_organ\" (click)=\"listedaward = ''\"\r\n                                        panelClass=\"select_with_search\"\r\n                                        *ngIf=\"(interreg | filter : listedaward) as listedresult\" >\r\n                                        <div class=\"searchinmultiselect\">\r\n                                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                            class=\"searchselect\" type=\"Search\" placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                            (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"listedaward\"\r\n                                            [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"listedaward = ''\" class=\"reseticon\" matSuffix\r\n                                            *ngIf=\"listedaward !='' && listedaward !=null\">clear</mat-icon>\r\n                                        </div>\r\n                                        <div class=\"option-listing countryselectwithimage\">\r\n                                            <mat-option *ngFor=\"let inter of interreg | filter : listedaward\"\r\n                                            value={{inter.pk}}>{{inter.irm_intlrecogname_en}}\r\n                                            </mat-option>\r\n                                            <div *ngIf=\"listedresult.length == 0\">No result found</div>\r\n                                        </div>\r\n                                </mat-select>\r\n                                <mat-label>{{'international.awardorgan' | translate}}</mat-label>\r\n                                <mat-error *ngIf=\"awar.award_organ.errors?.required || awaredForm.submitted\">\r\n                                    {{'international.seleanawarorgan' | translate}}\r\n                                </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\" class=\"date_exp\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label> {{'international.lastaudidate' | translate}}</mat-label>\r\n                                        <input matInput required formControlName=\"last_audit\" (mousedown)=\"picker4.open(); $event.preventDefault\" [disabled]=\"picker4.opened\" (dateChange)=\"addEvent('last_audit', $event)\"\r\n                                            [matDatepicker]=\"picker4\" readonly [max]=\"today\">\r\n                                        <mat-datepicker-toggle matSuffix [for]=\"picker4\"></mat-datepicker-toggle>\r\n                                        <mat-datepicker #picker4></mat-datepicker>\r\n                                        <!-- <mat-icon matSuffix class=\"m-b-4\"\r\n                                            matTooltip=\"{{'supplierreg.provtheopal' | translate}} \">info_outline</mat-icon> -->\r\n                                        <mat-error *ngIf=\"awar.last_audit.errors?.required || awaredForm.submitted\">\r\n                                            {{'international.selelastaudi' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                <div fxFlex=\"100\" id=\"documents\">\r\n\r\n                                    <!-- <app-multifileupload formGroupName=\"document_upload\" [callbackFn]=\"onFileupload\"\r\n                                        [placeholder]=\"\" #Intrecog [key]=5\r\n                                        (fileuploaded)=\"checkfile($event,5)\"></app-multifileupload> -->\r\n                                <app-filee #Intrecog [fileMstRef]=\"drvInputed\" [deleteicon]=\"deleteicon\"\r\n                                    (filesSelected)=\"fileeSelected($event,drvInputed)\" formControlName=\"document_upload\"\r\n                                    [notePosition]=\"'bottom'\">\r\n                                </app-filee> \r\n\r\n                                   <mat-hint class=\"txt-gry fs-12\"> {{'international.noteyoucanupload' |\r\n                                        translate}}</mat-hint> \r\n                                        <!-- <mat-error *ngIf=\"!fileerror\">Please Upload a file</mat-error> -->\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                            <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                (click)=\"awardcancel()\">{{'international.canc' | translate}}\r\n                            </button>\r\n                            <button *ngIf=\"this.interapptype == 'new'\" mat-raised-button color=\"primary\" type=\"submit\" (click)=\"addData()\"\r\n                                class=\"ShowHidefs-15 submit_btn m-l-10\">{{'international.add' | translate}}\r\n                            </button>\r\n                            <button *ngIf=\"this.interapptype == 'edit'\"  mat-raised-button color=\"primary\" type=\"submit\" (click)=\"addData()\"\r\n                                class=\"ShowHidefs-15 submit_btn m-l-10\">{{'Update'}}\r\n                            </button>\r\n                        </div>\r\n                    </form>\r\n                    <!--staff-->\r\n                    <div *ngIf=\"staffform\">\r\n                        <div class=\"successcmd m-l-0 m-r-0 m-b-20\" *ngIf=\"staffstatus == 3 || staffstatus == 4\" [ngClass]=\"staffstatus == 4 ? 'declinecmd' : 'successcmd'\">\r\n                            <p class=\"18 comment\" *ngIf=\"staffstatus == 3\">{{'institute.approvalcmd' | translate}}</p>\r\n                            <p class=\"18 comment\" *ngIf=\"staffstatus == 4\">{{'institute.declcomm' | translate}}</p>\r\n                            <p class=\"16 m-b-30\" [innerHTML]=\"staffcommand | striphtml\"></p>\r\n                                <mat-divider></mat-divider>\r\n                               <div class=\"validinfo\"  fxLayout=\"row wrap\" >\r\n                                <p class=\"fs-16 txt-gry m-r-40\">{{'institute.lastvalion' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{staffappon}}</span></p>\r\n                                <p class=\"fs-16 txt-gry m-l-30\">{{'institute.lastvaliby' | translate}}:<span class=\"fs-16 txt-gry3 m-l-10\">{{staffappby}}</span></p>\r\n                               </div>\r\n                        </div>\r\n                        <div  class=\"projlstngph w-100 listsector\" *ngIf=\"loaderform\">\r\n                            <div class=\"leftmainspace\">\r\n                                <div class=\"subcontent\">\r\n                                    <div class=\"descriptitlesector\">\r\n                                        <p class=\"pagetitle\"></p>\r\n                                        </div>\r\n                                    <div fxLayout=\"row wrap\" >\r\n                                        <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth m-r-25\"></span>\r\n                                      </div>\r\n                                  <div fxLayout=\"row wrap\" >\r\n                                    <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                    <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                    ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                  </div>\r\n                                  <div fxLayout=\"row wrap\" >\r\n                                    <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                    <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-0\" ngClass.md=\"m-l-25\"\r\n                                    ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                  </div>\r\n                                  <div fxLayout=\"row wrap\" >\r\n                                    <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                    <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                    ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                  </div>\r\n                                  <div fxLayout=\"row wrap\" >\r\n                                    <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                    <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                    ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                  </div>\r\n                                  <div fxLayout=\"row wrap\" >\r\n                                    <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                    <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                    ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                  </div>\r\n                                  <div class=\"descriptitlesector\">\r\n                                    <p class=\"pagetitle\"></p>\r\n                                    </div>\r\n                                <div fxLayout=\"row wrap\" >\r\n                                  <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                  <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                  ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" >\r\n                                  <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                  <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-0\" ngClass.md=\"m-l-25\"\r\n                                  ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" >\r\n                                  <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                </div>\r\n                               \r\n                                </div>\r\n                            </div>\r\n                            </div>\r\n                        <form autocomplete=\"off\" [formGroup]=\"staffForm\" *ngIf=\"!loaderform\">\r\n                            <div class=\"yesno\">\r\n                                <p class=\"m-r-40\">{{'staff.chos' | translate}}<span class=\"req m-l-5\">*</span>\r\n                                </p>\r\n                                <mat-radio-group aria-label=\"Select an option\" (change)=\"radioButtonGroupChange($event)\">\r\n                                    <mat-radio-button value=\"1\"  class=\"m-r-30 m-l-30\"\r\n                                        [checked]=\"true\">{{'staff.mapexis'|translate}}</mat-radio-button>\r\n                                    <mat-radio-button value=\"2\" \r\n                                        class=\"m-l-30\" >{{'staff.addnew'|translate}}</mat-radio-button>\r\n                                </mat-radio-group>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                    class=\"read_only\" *ngIf=\"newstaff\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.civinumb' | translate}} </mat-label>\r\n                                        <mat-select required formControlName=\"civil_num\" panelClass=\"select_with_search\"\r\n                                            [disableOptionCentering]=\"true\" appAlphabetonly\r\n                                            *ngIf=\"(staffs | filter : searchGovernorate) as goverresult\"\r\n                                            (selectionChange)=\"selectcivilid(staf.civil_num.value)\"\r\n                                            panelClass=\"select_with_option\">\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" \r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \" \r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"searchGovernorate\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"searchGovernorate = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"searchGovernorate !='' && searchGovernorate !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <mat-option *ngFor=\"let staff of staffs | filter : searchGovernorate\"\r\n                                                value={{staff.staffinforepo_pk}}> {{staff.sir_idnumber}}</mat-option>\r\n                                            <div *ngIf=\"goverresult?.length == 0\">No result found</div>\r\n                                        </mat-select>\r\n                                        <mat-error *ngIf=\"staf.civil_num.errors?.required  || staffForm.submitted\">\r\n                                            {{'staff.selyourcivinumb' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                    *ngIf=\"!newstaff\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.civinumb' | translate}} </mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" app-restrict-input=\"numberonly\"\r\n                                            matInput required formControlName=\"civil_num\" (blur)=\"checkcivilnum($event.target.value,'civil_num')\"\r\n                                            >\r\n                                            <!-- (keypress)=\"getstaffinfo(staf.civil_num.value)\" -->\r\n                                        <mat-error *ngIf=\"staf.civil_num.errors?.required  || staffForm.submitted\">\r\n                                            {{'staff.enteyourcivinumb' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                    class=\"read_only\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.staffnameengl' | translate}} </mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\"\r\n                                            matInput app-restrict-input=\"englishspace\" appAlphabetonly required formControlName=\"staffeng\">\r\n                                        <mat-error *ngIf=\"staf.staffeng.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.entethenameofengl' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\" class=\"read_only\">\r\n                                    <mat-form-field appearance=\"outline\" class=\" arabiclanguage\">\r\n                                        <mat-label>{{'staff.staffnamearab' | translate}} </mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" app-restrict-input=\"arabic\"\r\n                                            [errorStateMatcher]=\"matcher\" matInput appAlphabetonly required formControlName=\"staffarab\">\r\n                                        <mat-error *ngIf=\"staf.staffarab.errors?.required  || staffForm.submitted\">\r\n                                            {{'staff.entestaffarab' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.email' | translate}} </mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\"\r\n                                            matInput pattern=\"[a-zA-Z0-9]{1,}@[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,}\"\r\n                                            app-restrict-input=\"english\" (change)=\"changeingmdtls()\" required\r\n                                            formControlName=\"email_id\" maxlength=\"255\">\r\n                                        <mat-error *ngIf=\"staf.email_id.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.enteanemail' | translate}} </mat-error>\r\n                                        <mat-error\r\n                                            *ngIf=\"staffForm.get('email_id').hasError('pattern')\">{{'staff.entevalidemail'|\r\n                                            translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.sm=\"m-0\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.datebirth' | translate}} </mat-label>\r\n                                        <input matInput required formControlName=\"date_birth\"\r\n                                            (mousedown)=\"pickerage.open(); $event.preventDefault\" [disabled]=\"pickerage.opened\" \r\n                                            [max]=\"maxDate\" [matDatepicker]=\"pickerage\" readonly>\r\n                                        <mat-datepicker-toggle matSuffix [for]=\"pickerage\"></mat-datepicker-toggle>\r\n                                        <mat-datepicker #pickerage></mat-datepicker>\r\n                                        <mat-error *ngIf=\"staf.date_birth.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.selethedate' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\" class=\"readonly\"\r\n                                  *ngIf=\"!ageShow\"  >\r\n                                    <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\">\r\n                                        <mat-label>{{'staff.age' | translate}} </mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" matInput [readonly]=\"editOption\" \r\n                                            (change)=\"changeingmdtls()\" formControlName=\"age\" >\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required formControlName=\"gend_er\" \r\n                                            panelClass=\"select_with_option\">\r\n                                            <mat-option value=\"1\">{{'staff.male' | translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'staff.female' | translate}}</mat-option>\r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.gender' | translate}}</mat-label>\r\n                                        <mat-error *ngIf=\"staf.gend_er.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.selegender' | translate}}\r\n                                        </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\" *ngIf=\"!gendershow\">\r\n                                    <mat-label>{{'staff.formofadd' | translate}}</mat-label>\r\n                                    <!-- <mat-select required formControlName=\"gender_address\" \r\n                                        [(ngModel)]='genderselect' panelClass=\"select_with_option\">\r\n                                        <mat-option value=\"1\">{{'staff.mr' | translate}}</mat-option>\r\n                                        <mat-option value=\"2\">{{'staff.ms' | translate}}</mat-option>\r\n                                    </mat-select> -->\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" matInput \r\n                                    (change)=\"changeingmdtls()\" [readonly]=\"editOption\"   formControlName=\"gender_address\"  >\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required formControlName=\"national\" [errorStateMatcher]=\"matcher\"\r\n                                            panelClass=\"select_with_search\"\r\n                                            *ngIf=\"(countrylist | filter : searchGovernorate) as countresult\"\r\n                                            (selectionChange)=\"selectedGovernorate(cour.course_titleen.value)\">\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"searchGovernorate\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"searchGovernorate = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"searchGovernorate !='' && searchGovernorate !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option \r\n                                                    *ngFor=\"let country of countrylist | filter : searchGovernorate\"\r\n                                                    value=\"{{country.opalcountrymst_pk}}\">\r\n                                                    {{ifarbic == true ?\r\n                                                    (country.ocym_countryname_ar):(country.ocym_countryname_en)}}\r\n                                                </mat-option>\r\n                                                <div *ngIf=\"countresult?.length == 0\">No result found</div>\r\n                                            </div>\r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.nation' | translate}}</mat-label>\r\n                                        <mat-error *ngIf=\"staf.national.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.selenation' | translate}}\r\n                                        </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select multiple required formControlName=\"role\"\r\n                                            [errorStateMatcher]=\"matcher\" panelClass=\"select_with_search multiple\"\r\n                                            *ngIf=\"(rolemst | filter : searchrole) as roleresult\">\r\n                                            <mat-select-trigger>\r\n                                                {{staffForm.controls['role'].value ? mainroleUnitDataTemp : ''}}\r\n                                                <span *ngIf=\"staffForm.controls['role'].value?.length > 1\"\r\n                                                    class=\"example-additional-selection\">\r\n                                                    (+{{staffForm.controls['role'].value.length - 1}}\r\n                                                    {{staffForm.controls['role'].value?.length === 2 ? 'other' :\r\n                                                    'others'}})\r\n                                                </span>\r\n                                            </mat-select-trigger>\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchrole\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"searchrole = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"searchrole !='' && searchrole !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option *ngFor=\"let role of rolemst | filter : searchrole\"\r\n                                                    value={{role.rolemst_pk}}>\r\n                                                    {{ifarbic == true ? (role.rm_rolename_ar):\r\n                                                    (role.rm_rolename_en)}}</mat-option>\r\n\r\n                                                <div *ngIf=\"roleresult?.length == 0\">No result found</div>\r\n                                            </div>\r\n                                        </mat-select>\r\n\r\n                                        <mat-label>{{'staff.mainrole' | translate}}</mat-label>\r\n                                        <mat-error *ngIf=\"staf.role.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.selemainrole' | translate}}\r\n                                        </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.jobtitl' | translate}} </mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\"\r\n                                            matInput app-restrict-input=\"english\" required formControlName=\"job_title\">\r\n                                        <mat-error *ngIf=\"staf.job_title.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.entejobtitl' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required formControlName=\"cont_type\"\r\n                                            panelClass=\"select_with_option\">\r\n                                            <mat-option *ngFor=\"let contact of contacttypemst\"\r\n                                                value={{contact.referencemst_pk}}>{{ifarbic == true ? (contact.rm_name_ar):\r\n                                                (contact.rm_name_en)}}</mat-option>\r\n\r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.conttype' | translate}}</mat-label>\r\n                                        <mat-error *ngIf=\"staf.cont_type.errors?.required || staffForm.submitted\">\r\n                                            {{'staff.seleconttype' | translate}}\r\n                                        </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <p class=\"fs-18 txt-gry3 subtitleform \">{{'staff.permanresid' | translate}}</p>\r\n                            <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                    class=\"read_only\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.house/street' | translate}} </mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" app-restrict-input=\"english\"\r\n                                            [errorStateMatcher]=\"matcher\" matInput required appAlphabetonly\r\n                                            formControlName=\"house\">\r\n                                        <mat-error *ngIf=\"staf.house.errors?.required  || staffForm.submitted\">\r\n                                            {{'staff.entehouse' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-label>{{'staff.house/street' | translate}} 2</mat-label>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\"\r\n                                            matInput app-restrict-input=\"english\" formControlName=\"houseadd\">\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" class=\"p-t-10 secondtab\" fxLayoutAlign=\"space-between center\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                    class=\"read_only\">\r\n                                        <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\">\r\n                                            <mat-select required formControlName=\"count_ry\" \r\n                                              panelClass=\"select_with_option\">\r\n                                                <mat-option *ngFor=\"let country of countrymst  | filter : searchcount_ry\"\r\n                                                value={{country.opalcountrymst_pk}}>{{ifarbic == true ? (country.ocym_countryname_ar):\r\n                                                (country.ocym_countryname_en)}}</mat-option>\r\n                                            </mat-select>\r\n                                            <mat-label>{{'staff.count' | translate}}</mat-label>\r\n                                            \r\n                                        </mat-form-field>\r\n                                        <!-- <mat-form-field appearance=\"outline\" [ngClass]=\"editOption == true ? 'readonlyfield' : ' '\">\r\n                                            <input matInput formControlName=\"count_ry\" [value]=\"31\" >\r\n                                            <mat-label>{{'staff.count' | translate}}</mat-label>\r\n                                            \r\n                                        </mat-form-field> -->\r\n                                </div>\r\n                                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required formControlName=\"state\" [errorStateMatcher]=\"matcher\"\r\n                                            panelClass=\"select_with_search\"\r\n                                            *ngIf=\"(statemst | filter : searchGovernorate) as countresult\"\r\n                                            (selectionChange)=\"stateselect(staf.state.value)\">\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"searchGovernorate\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"searchGovernorate = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"searchGovernorate !='' && searchGovernorate !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option *ngFor=\"let state of statemst  | filter : searchGovernorate\"\r\n                                                    value={{state.opalstatemst_pk}}>{{ifarbic == true? (state.osm_statename_ar):\r\n                                                    (state.osm_statename_en)}}</mat-option>\r\n                                                <div *ngIf=\"countresult?.length == 0\">{{'staff.noresultfound' | translate}}\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.gove' | translate}}</mat-label>\r\n                                        <mat-error *ngIf=\"staf.state.errors?.required  || staffForm.submitted\">\r\n                                            {{'staff.selegover' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 m-b-25\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required formControlName=\"city\" [errorStateMatcher]=\"matcher\"\r\n                                            panelClass=\"select_with_search\"\r\n                                            *ngIf=\"(citymst | filter : searchGovernorate) as countresult\">\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"searchGovernorate\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"searchGovernorate = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"searchGovernorate !='' && searchGovernorate !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option *ngFor=\"let city of citymst  | filter : searchGovernorate\"\r\n                                                    value={{city.opalcitymst_pk}}>{{ifarbic == true ? (city.ocim_cityname_ar):\r\n                                                    (city.ocim_cityname_en)}}</mat-option>\r\n                                                <div *ngIf=\"countresult?.length == 0\">{{'staff.noresultfound' | translate}}\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.wila' | translate}}</mat-label>\r\n                                        <mat-error *ngIf=\"staf.city.errors?.required  || staffForm.submitted\">\r\n                                            {{'staff.selewila' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <mat-hint class=\"txt-gry3 fs-16\" *ngIf=\"saveandproceed\" > {{'staff.note' | translate}}</mat-hint>\r\n                            <!-- <mat-hint class=\"txt-gry3 fs-16\" *ngIf=\"saveandproceed\" >save and proceed </mat-hint> -->\r\n                            <div *ngIf=\"saveandproceed\"  fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                                <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\"\r\n                                    type=\"button\" (click)=\"canclstaff()\">{{'staff.canc' |\r\n                                    translate}}\r\n                                </button>\r\n                                <button mat-raised-button color=\"primary\" type=\"submit\" (click)=\"savestaff()\"\r\n                                    class=\"ShowHidefs-15 submit_btn m-l-10\">Save & Proceed\r\n                                </button>\r\n                            </div>\r\n                        </form>\r\n                      <div *ngIf=\"staffotherdetails\"  class=\"editformeducation\" #editformeducation>\r\n                       \r\n                            <form autocomplete=\"off\" [formGroup]=\"educationForm\" >\r\n                                <p  *ngIf=\"!loaderformeducation\" class=\"fs-18 txt-gry3 subtitleform \" >{{'staff.educqual' | translate}}</p>\r\n                                <div class=\"card m-b-40 \">\r\n                                    <div  class=\"projlstngph w-100 listsector\" *ngIf=\"loaderformeducation\">\r\n                                        <div class=\"leftmainspace\">\r\n                                            <div class=\"subcontent\">\r\n                                                <div class=\"descriptitlesector\">\r\n                                                    <p class=\"pagetitle\"></p>\r\n                                                    </div>\r\n                                              <div fxLayout=\"row wrap\" >\r\n                                                <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                                <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                                ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                              </div>\r\n                                              <div fxLayout=\"row wrap\" >\r\n                                                <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                                <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-0\" ngClass.md=\"m-l-25\"\r\n                                                ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                              </div>\r\n                                              <div fxLayout=\"row wrap\" >\r\n                                                <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                                <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                                ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                              </div>\r\n                                              <div fxLayout=\"row wrap\" >\r\n                                                <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                                <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                                ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                              </div>\r\n                                            <div fxLayout=\"row wrap\" >\r\n                                              <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                            </div>\r\n                                           \r\n                                            </div>\r\n                                        </div>\r\n                                        </div>\r\n                              <div *ngIf=\"!loaderformeducation\">\r\n                                <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center \" >\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.sm=\"m-0\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.startdate' | translate}} </mat-label>\r\n                                            <input matInput required formControlName=\"year_join\" (mousedown)=\"pickerofjoin.open(); $event.preventDefault\" [disabled]=\"pickerofjoin.opened\"\r\n                                                [matDatepicker]=\"pickerofjoin\" readonly> \r\n                                            <mat-datepicker-toggle matSuffix \r\n                                                [for]=\"pickerofjoin\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #pickerofjoin></mat-datepicker>\r\n                                            <!-- <mat-icon matSuffix class=\"m-b-4\"\r\n                                        matTooltip=\"{{'staff.provtheopal' | translate}} \">info_outline</mat-icon> -->\r\n                                            <mat-error *ngIf=\"edu.year_join.errors?.required || educationForm.submitted\">\r\n                                                {{'staff.selestartdate' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.enddate' | translate}} </mat-label>\r\n                                            <input matInput required formControlName=\"year_pass\"\r\n                                            [min]=\"educationForm.controls['year_join'].value == null ? today : educationForm.controls['year_join'].value\"\r\n                                            (mousedown)=\"pickerpass.open(); $event.preventDefault\" [disabled]=\"pickerpass.opened\"[matDatepicker]=\"pickerpass\" readonly>\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"pickerpass\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #pickerpass></mat-datepicker>\r\n                                            <!-- <mat-icon matSuffix class=\"m-b-4\"\r\n                                        matTooltip=\"{{'staff.provtheopal' | translate}} \">info_outline</mat-icon> -->\r\n                                            <mat-error *ngIf=\"edu.year_pass.errors?.required || educationForm.submitted\">\r\n                                                {{'staff.seleenddate' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                        class=\"read_only\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.instname' | translate}}</mat-label>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphabetonly\r\n                                                app-restrict-input=\"english\" [errorStateMatcher]=\"matcher\" matInput app-restrict-input=\"firstspace\"\r\n                                                required  formControlName=\"institute_name\">\r\n                                            <mat-error\r\n                                                *ngIf=\"edu.institute_name.errors?.required  || educationForm.submitted\">\r\n                                                {{'staff.enteinstname' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-select required formControlName=\"institue_country\" [errorStateMatcher]=\"matcher\"\r\n                                            panelClass=\"select_with_search\"  (selectionChange)=\"ctrychoose(edu.institue_country.value);cityselect(edu.institue_country.value)\" \r\n                                            *ngIf=\"(countrymst | filter : searchcount_ry) as countresult\">\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"searchcount_ry\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"searchcount_ry = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"searchcount_ry !='' && searchcount_ry !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option *ngFor=\"let country of countrymst  | filter : searchcount_ry\"\r\n                                                value={{country.opalcountrymst_pk}}>{{ifarbic == true ? (country.ocym_countryname_ar):\r\n                                                (country.ocym_countryname_en)}}</mat-option>\r\n                                                <div *ngIf=\"countresult.length == 0\">{{'staff.nocounmatc' | translate}}\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-select>\r\n                                         \r\n                                            <mat-label>{{'staff.count' | translate}}</mat-label>\r\n                                            <mat-error\r\n                                                *ngIf=\"edu.institue_country.errors?.required  || educationForm.submitted\">\r\n                                                {{'staff.selecount' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-t-10\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-select required formControlName=\"inst_state\" [errorStateMatcher]=\"matcher\"\r\n                                            panelClass=\"select_with_search\" (selectionChange)=\"stateselect(edu.inst_state.value)\"\r\n                                            *ngIf=\"(state | filter : selectsearchstate) as countresult\">\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"selectsearchstate\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"selectsearchstate = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"selectsearchstate !='' && selectsearchstate !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option *ngFor=\"let stat of state  | filter : selectsearchstate\"\r\n                                                value={{stat.opalstatemst_pk}}>{{ifarbic == true? (stat.osm_statename_ar):\r\n                                                (stat.osm_statename_en)}}</mat-option>\r\n                                                <div *ngIf=\"countresult.length == 0\">No result found\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-select>\r\n                                            <!-- <mat-select required formControlName=\"inst_state\" (selectionChange)=\"stateselect(edu.inst_state.value)\"\r\n                                                panelClass=\"select_with_option\">\r\n                                                <mat-option *ngFor=\"let stat of state  | filter : searchGovernorate\"\r\n                                                value={{stat.opalstatemst_pk}}>{{ifarbic == true? (stat.osm_statename_ar):\r\n                                                (stat.osm_statename_en)}}</mat-option>\r\n                                            </mat-select> -->\r\n                                            <mat-label *ngIf=\"!oman\">{{'staff.state' | translate}}</mat-label>\r\n                                            <mat-label *ngIf=\"oman\">{{'staff.gove' | translate}}</mat-label>\r\n                                            <mat-error\r\n                                                *ngIf=\"(edu.inst_state.errors?.required  || educationForm.submitted) && !oman\">\r\n                                                {{'staff.selestate' | translate}} </mat-error>\r\n                                            <mat-error\r\n                                                *ngIf=\"(edu.inst_state.errors?.required  || educationForm.submitted) && oman\">\r\n                                                {{'staff.selegover' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                                <mat-select required formControlName=\"inst_city\" [errorStateMatcher]=\"matcher\"\r\n                                                panelClass=\"select_with_search\" (selectionChange)=\"stateselect(edu.inst_state.value)\"\r\n                                                *ngIf=\"(citymst | filter : selectsearchcity) as countresult\">\r\n                                                <div class=\"searchinmultiselect\">\r\n                                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                        matInput class=\"searchselect\" type=\"Search\"\r\n                                                        placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                        (keydown)=\"$event.stopPropagation();\"\r\n                                                        [(ngModel)]=\"selectsearchcity\"\r\n                                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                    <mat-icon (click)=\"selectsearchcity = ''\" class=\"reseticon\" matSuffix\r\n                                                        *ngIf=\"selectsearchcity !='' && selectsearchcity !=null\">clear</mat-icon>\r\n                                                </div>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                    <mat-option *ngFor=\"let city of citymst  | filter : selectsearchcity\"\r\n                                                    value={{city.opalcitymst_pk}}>{{ifarbic == true ? (city.ocim_cityname_ar):\r\n                                                    (city.ocim_cityname_en)}}</mat-option>\r\n                                                    <div *ngIf=\"countresult.length == 0\">No result found\r\n                                                    </div>\r\n                                                </div>\r\n                                            </mat-select>\r\n                                            <!-- <mat-select required formControlName=\"inst_city\"\r\n                                                panelClass=\"select_with_option\">\r\n                                                <mat-option *ngFor=\"let city of citymst  | filter : searchGovernorate\"\r\n                                                    value={{city.opalcitymst_pk}}>{{ifarbic == true ? (city.ocim_cityname_ar):\r\n                                                    (city.ocim_cityname_en)}}</mat-option>\r\n                                            </mat-select> -->\r\n                                            <mat-label *ngIf=\"!oman\">{{'staff.city' | translate}}</mat-label>\r\n                                            <mat-label *ngIf=\"oman\">{{'staff.wila' | translate}}</mat-label>\r\n                                            <mat-error\r\n                                                *ngIf=\"(edu.inst_city.errors?.required  || educationForm.submitted) && oman\">\r\n                                                {{'staff.selewila' | translate}} </mat-error>\r\n                                            <mat-error\r\n                                                *ngIf=\"(edu.inst_city.errors?.required  || educationForm.submitted) && !oman\">\r\n                                                {{'staff.selecity' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                        class=\"read_only\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-select required formControlName=\"edut_level\" [errorStateMatcher]=\"matcher\"\r\n                                                panelClass=\"select_with_search\" \r\n                                                *ngIf=\"(educationlvl | filter : selectsearchcity) as countresult\">\r\n                                                <div class=\"searchinmultiselect\">\r\n                                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                        matInput class=\"searchselect\" type=\"Search\"\r\n                                                        placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                        (keydown)=\"$event.stopPropagation();\"\r\n                                                        [(ngModel)]=\"selectsearchcity\"\r\n                                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                    <mat-icon (click)=\"selectsearchcity = ''\" class=\"reseticon\" matSuffix\r\n                                                        *ngIf=\"selectsearchcity !='' && selectsearchcity !=null\">clear</mat-icon>\r\n                                                </div>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                    <mat-option *ngFor=\"let lvl of educationlvl | filter : selectsearchcity\"\r\n                                                value={{lvl.referencemst_pk}}>{{ifarbic == true? (lvl.rm_name_ar):\r\n                                                (lvl.rm_name_en)}}</mat-option>\r\n                                                    <div *ngIf=\"countresult.length == 0\">No result found\r\n                                                    </div>\r\n                                                </div>\r\n                                            </mat-select>\r\n                                            <mat-label>{{'staff.educlevel' | translate}}</mat-label>\r\n                                            <mat-error *ngIf=\"edu.edut_level.errors?.required  || educationForm.submitted\">\r\n                                                {{'staff.seleeduclevel' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.degecert' | translate}} </mat-label>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                [errorStateMatcher]=\"matcher\" matInput app-restrict-input=\"numberonly\"\r\n                                                required formControlName=\"degree_cert\">\r\n                                            <mat-error *ngIf=\"edu.degree_cert.errors?.required || educationForm.submitted\">\r\n                                                {{'staff.entedegecert' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                        class=\"read_only\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.gpagrad' | translate}} </mat-label>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                app-restrict-input=\"english\" [errorStateMatcher]=\"matcher\" matInput\r\n                                                required formControlName=\"gpa_grade\" appNumberonly maxlength=\"30\">\r\n                                            <mat-error *ngIf=\"edu.gpa_grade.errors?.required  || staffForm.submitted\">\r\n                                                {{'staff.entegpagrad' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                                    <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" (click)=\"cancelstaffedu()\"\r\n                                        type=\"button\">{{'staff.canc' |\r\n                                        translate}}\r\n                                    </button>\r\n                                    <button mat-raised-button color=\"primary\" type=\"button\" *ngIf=\"this.staffeduapptype == 'new'\" (click)=\"savestaffedu()\"\r\n                                        class=\"ShowHidefs-15 submit_btn m-l-10\">{{'staff.add' | translate}}\r\n                                    </button>\r\n                                    <button mat-raised-button color=\"primary\" type=\"button\" *ngIf=\"this.staffeduapptype == 'edit'\" (click)=\"savestaffedu()\"\r\n                                    class=\"ShowHidefs-15 submit_btn m-l-10\">{{'Update'}}\r\n                                </button>\r\n                                </div>\r\n                              </div>\r\n                                <div class=\"paginationwithfilter masterPageTop m-t-30 tableedu\"  #tableedu>\r\n                                    <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                                    <mat-paginator class=\"masterPage masterPageTop\" #paginatorfourth [length]=\"fourthLength\"\r\n                                        [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                        (page)=\"fourthPaginator($event);\"></mat-paginator>\r\n                                    <div fxLayout=\"row wrap\">\r\n                                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                            <button mat-raised-button type=\"button\" color=\"primary\"\r\n                                                (click)=\"clickEvent()\" class=\"filter\">{{filtername}}<i\r\n                                                    class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\">\r\n                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                                        <div class=\"awaredtable\"  >\r\n                                            <mat-table #table class=\"scrolldata\" [dataSource]=\"education\" matSort\r\n                                                matSortDisableClear>\r\n                                                <ng-container matColumnDef=\"institute\">\r\n                                                    <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.instname' | translate}}</mat-header-cell>\r\n                                                        <mat-cell data-label=\"institute\" fxFlex=\"250px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{educationData.institute}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"degree\">\r\n                                                    <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.degecert' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"degree\" fxFlex=\"250px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{educationData.degree}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"yearjoin\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.startdate' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"yearjoin\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{educationData.yearjoin}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"yearpass\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.enddate' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"yearpass\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{educationData.yearpass}} </div>\r\n                                                        </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"grade\">\r\n                                                    <mat-header-cell fxFlex=\"170px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.gpagrad' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"grade\" fxFlex=\"170px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{educationData.grade}} </div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"addedu\">\r\n                                                    <mat-header-cell fxFlex=\"283px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header> {{'staff.addon' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"addedu\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{educationData.addedu}} </div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"lastUpdated\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header> {{'staff.lastupdat' | translate}}\r\n\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"lastUpdated\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{educationData.lastUpdated?educationData.lastUpdated:'-'}}  </div>\r\n                                                        </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"action\" stickyEnd>\r\n                                                    <mat-header-cell fxFlex=\"100px\" mat-header-cell *matHeaderCellDef>\r\n                                                        {{'staff.Action' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"action\" fxFlex=\"100px\"\r\n                                                        *matCellDef=\"let educationData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\"><div class=\"manageoptions\">\r\n                                                            <button class=\"menubutton\" mat-icon-button\r\n                                                                [matMenuTriggerFor]=\"actionmenu\"\r\n                                                                aria-label=\"Example icon-button with a menu\">\r\n                                                                <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                                            </button>\r\n                                                            <mat-menu #actionmenu=\"matMenu\"\r\n                                                                class=\"master-menu whentootltipadded\">\r\n                                                                <button type=\"button\" mat-menu-item (click)=\"editstaffedu(educationData,'edit')\">\r\n                                                                    <span>{{'table.edit' | translate}} </span>\r\n                                                                </button>\r\n                                                                <button type=\"button\" mat-menu-item (click)=\"deletestaffedu(educationData.staffacademics_pk)\">\r\n                                                                    <span>{{'table.delete' | translate}}</span>\r\n                                                                </button>\r\n                                                                <button type=\"button\" mat-menu-item (click)=\"editstaffedu(educationData,'view')\">\r\n                                                                    <span>{{'table.view' | translate}}</span>\r\n                                                                </button>\r\n                                                            </mat-menu>\r\n                                                        </div></div>\r\n                                                    </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-first\">\r\n                                                    <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                            <input matInput [formControl]=\"institute\" (keyup)=\"seracheducation($event.target.value,'institute')\">\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-second\">\r\n                                                    <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <!-- <mat-label>{{'table.search' | translate}}</mat-label> -->\r\n                                                     \r\n                                                                <input matInput  [formControl]=\"degree\" (keyup)=\"seracheducation($event.target.value,'institute')\">\r\n                                                          \r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-three\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <!-- <mat-label>{{'table.search' |translate}}</mat-label> -->\r\n                                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"year_join\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-four\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"year_pass\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-five\">\r\n                                                    <mat-header-cell fxFlex=\"170px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <mat-label>{{'table.sele' | translate}}</mat-label>\r\n                                                           \r\n                                                                <input matInput  [formControl]=\"grade\" (keyup)=\"seracheducation($event.target.value,'grade')\">\r\n                                                         \r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-six\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"add_On\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-seven\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                              <!-- <mat-label>{{'table.search' |translate}}</mat-label> -->\r\n                                                              <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"Last_Date\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-eight\" stickyEnd>\r\n                                                    <mat-header-cell fxFlex=\"100px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n        \r\n                                                        <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"clearFiltereducation();filtersts=false;\"\r\n                                                            aria-hidden=\"true\" matTooltip=\"{{'table.refr' |translate}}\"></i>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"educationList;sticky: true\">\r\n                                                </mat-header-row>\r\n                                                <mat-header-row id=\"searchrow\"\r\n                                                    *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six' , 'row-seven', 'row-eight' ]\">\r\n                                                </mat-header-row>\r\n                                                <mat-row mat-row\r\n                                                    *matRowDef=\"let row; columns: educationList;\"></mat-row>\r\n                                                    <ng-container matColumnDef=\"disclaimer\">\r\n                                                        <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n                                                            <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                                <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                                    <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                                    <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                        </td>\r\n                                                    </ng-container>\r\n                                                    <ng-container>\r\n                                                      \r\n                                                        <mat-footer-row [style.display]=\"(fourthLength > 0) ? 'none' : 'block' \" \r\n                                                            *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                                        </mat-footer-row>\r\n                                                    </ng-container>\r\n                                            </mat-table>\r\n                                        </div>\r\n                                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                                <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                                    class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                                    [pageSize]=\"paginatorfourth?.pageSize\"\r\n                                                    (page)=\"fourthPaginator($event);\"\r\n                                                    [pageIndex]=\"paginatorfourth?.pageIndex\" [length]=\"fourthLength\"\r\n                                                    [pageSizeOptions]=\"paginatorfourth?.pageSizeOptions\">\r\n                                                </mat-paginator>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </form>\r\n                        <p class=\"fs-18 txt-gry3 subtitleform editdata\" #editdata>{{'staff.workqual' | translate}}</p>\r\n                        <div class=\"card m-b-40\" >\r\n                            <div  class=\"projlstngph w-100 listsector\" *ngIf=\"loaderformwork\">\r\n                                <div class=\"leftmainspace\">\r\n                                    <div class=\"subcontent\">\r\n                                        <div class=\"descriptitlesector\">\r\n                                            <p class=\"pagetitle\"></p>\r\n                                            </div>\r\n                                      <div fxLayout=\"row wrap\" >\r\n                                        <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                        <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                        ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                      </div>\r\n                                      <div fxLayout=\"row wrap\" >\r\n                                        <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                        <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-0\" ngClass.md=\"m-l-25\"\r\n                                        ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                      </div>\r\n                                      <div fxLayout=\"row wrap\" >\r\n                                        <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                        <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                        ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                      </div>\r\n                                      <div fxLayout=\"row wrap\" >\r\n                                        <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                        <span fxFlex.gt-sm=\"48\" ngClass.xs=\"m-l-25\" ngClass.sm=\"m-l-25\" ngClass.md=\"m-l-25\"\r\n                                        ngClass.lg=\"m-l-25\" ngClass.xl=\"m-l-25\" fxFlex=\"100\" class=\"pagetitle secondwidth\"></span>\r\n                                      </div>\r\n                                    <div fxLayout=\"row wrap\" >\r\n                                      <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                    </div>\r\n                                   \r\n                                    </div>\r\n                                </div>\r\n                                </div>\r\n                            <form autocomplete=\"off\" [formGroup]=\"staffworkexperienceForm\">\r\n                              <div *ngIf=\"!loaderformwork\">\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\" >\r\n                                    <div fxFlex.gt-md=\"50\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.empl' | translate}} </mat-label>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                [errorStateMatcher]=\"matcher\" matInput app-restrict-input=\"english\"\r\n                                                required formControlName=\"oragn_name\">\r\n                                            <mat-error\r\n                                                *ngIf=\"work.oragn_name.errors?.required || staffworkexperienceForm.submitted\">\r\n                                                {{'staff.seleempl' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.datejoin' | translate}} </mat-label>\r\n                                            <input matInput required formControlName=\"date_join\" [max]=\"today\"\r\n                                                (click)=\"pickerdatejoin.open()\" [matDatepicker]=\"pickerdatejoin\"\r\n                                                readonly>\r\n                                            <mat-datepicker-toggle matSuffix\r\n                                                [for]=\"pickerdatejoin\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #pickerdatejoin></mat-datepicker>\r\n                                            <mat-error\r\n                                                *ngIf=\"work.date_join.errors?.required || staffworkexperienceForm.submitted\">\r\n                                                {{'staff.seledatejoin' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 date_exp\">\r\n                                    <div fxFlex.gt-md=\"50\" fxFlex=\"100\">\r\n                                        <!-- <mat-form-field appearance=\"outline\" fxFlex=\"60\">\r\n                                            <mat-label>{{'staff.worktill' | translate}} </mat-label>\r\n                                            <input matInput required formControlName=\"workdate\" [max]=\"today\" [required]=\"worktilled\" (dateChange)=\"dateSelected($event)\" [(ngModel)]=\"selectedDate\"  [disabled]=\"notallowed\"\r\n                                                 (mousedown)=\"pickerwork.open(); $event.preventDefault\" [disabled]=\"pickerwork.opened\"  readonly>\r\n                                           <mat-icon matDatepickerToggleIcon matSuffix *ngIf=\"cleardate\" (dateChange)=\"dateSelected($event)\" (click)=\"clearDate()\">clear</mat-icon>\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"pickerwork\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #pickerwork></mat-datepicker>\r\n                                            <mat-error\r\n                                                *ngIf=\"work.workdate.errors?.required || staffworkexperienceForm.submitted\">\r\n                                                {{'staff.seleworktill' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                        <div class=\"workcheckbox m-l-20 m-b-13\">\r\n                                            <mat-checkbox formControlName=\"curr_work\"  [required]=\"!worktilled\" (change)=\"onCheckboxChange($event)\" [disabled]=\"isCheckboxDisabled\"> </mat-checkbox>\r\n                                            <mat-lable class=\"m-l-5 txt-gry\">{{'staff.currwork' |translate}} <span class=\"errors\" *ngIf=\"!worktilled\">*</span></mat-lable>\r\n                                        </div> -->\r\n                                        <mat-form-field appearance=\"outline\" fxFlex=\"60\">\r\n                                            <mat-label>{{'staff.worktill' | translate}} </mat-label>\r\n                                            <input matInput  formControlName=\"workdate\" [required]=\"worktilled\" (dateChange)=\"dateSelected($event)\" [(ngModel)]=\"selectedDate\"  [disabled]=\"notallowed\"\r\n                                            (mousedown)=\"pickerwork.open(); $event.preventDefault\" [disabled]=\"pickerwork.opened\"   [matDatepicker]=\"pickerwork\" readonly [max]=\"today\">\r\n                                            <mat-icon matDatepickerToggleIcon matSuffix *ngIf=\"cleardate\" (dateChange)=\"dateSelected($event)\" (click)=\"clearDate()\">clear</mat-icon>\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"pickerwork\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #pickerwork></mat-datepicker>\r\n                                            <mat-error\r\n                                                *ngIf=\"work.workdate.errors?.required || staffworkexperienceForm.submitted\">\r\n                                                {{'staff.seleworktill' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                        <div class=\"workcheckbox m-l-20 m-b-13\">\r\n                                            <mat-checkbox formControlName=\"curr_work\"  [required]=\"!worktilled\" (change)=\"onCheckboxChange($event)\" [disabled]=\"isCheckboxDisabled\"> </mat-checkbox>\r\n                                            <mat-lable class=\"m-l-5 txt-gry\">{{'staff.currwork' |translate}} <span class=\"errors\" *ngIf=\"!worktilled\">*</span></mat-lable>\r\n                                        </div>\r\n                                    </div>\r\n                                    <div fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-select required formControlName=\"employ_country\" [errorStateMatcher]=\"matcher\"\r\n                                            panelClass=\"select_with_search\" (click)=\"searchcount_ry = ''\"   (selectionChange)=\"ctrychoose(work.employ_country.value);cityselecttwo(work.employ_country.value)\" \r\n                                            *ngIf=\"(countrymst | filter : searchcount_ry) as countresult\">\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"searchcount_ry\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"searchcount_ry = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"searchcount_ry !='' && searchcount_ry !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option *ngFor=\"let country of countrymst  | filter : searchcount_ry\"\r\n                                                value={{country.opalcountrymst_pk}}>{{ifarbic == true ? (country.ocym_countryname_ar):\r\n                                                (country.ocym_countryname_en)}}</mat-option>\r\n                                                <div *ngIf=\"countresult.length == 0\">{{'staff.nocounmatc' | translate}}\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-select>\r\n                                            <!-- <mat-select required formControlName=\"employ_country\"\r\n                                                (ngModelChange)=\"cityselect()\" panelClass=\"select_with_option\" (selectionChange)=\"ctrychoose(work.employ_country.value)\">\r\n                                                <mat-option *ngFor=\"let country of countrymst  | filter : searchGovernorate\"\r\n                                                value={{country.opalcountrymst_pk}}>{{ifarbic == true ? (country.ocym_countryname_ar):\r\n                                                (country.ocym_countryname_en)}}</mat-option>\r\n                                            </mat-select> -->\r\n                                            <mat-label>{{'staff.count' | translate}}</mat-label>\r\n                                            <mat-error\r\n                                                *ngIf=\"work.employ_country.errors?.required  || staffworkexperienceForm.submitted\">\r\n                                                {{'staff.selecount' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"space-between center\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\"\r\n                                        class=\"read_only\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-select required formControlName=\"employ_state\" [errorStateMatcher]=\"matcher\"\r\n                                            panelClass=\"select_with_search\" (selectionChange)=\"stateselect(work.employ_state.value)\"\r\n                                            *ngIf=\"(state | filter : selectsearchstate) as countresult\"  (click)=\"selectsearchstate = ''\" >\r\n                                            <div class=\"searchinmultiselect\">\r\n                                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                    matInput class=\"searchselect\" type=\"Search\"\r\n                                                    placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                    (keydown)=\"$event.stopPropagation();\"\r\n                                                    [(ngModel)]=\"selectsearchstate\"\r\n                                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                <mat-icon (click)=\"selectsearchstate = ''\" class=\"reseticon\" matSuffix\r\n                                                    *ngIf=\"selectsearchstate !='' && selectsearchstate !=null\">clear</mat-icon>\r\n                                            </div>\r\n                                            <div class=\"option-listing countryselectwithimage\">\r\n                                                <mat-option *ngFor=\"let stat of state  | filter : selectsearchstate\"\r\n                                                value={{stat.opalstatemst_pk}}>{{ifarbic == true? (stat.osm_statename_ar):\r\n                                                (stat.osm_statename_en)}}</mat-option>\r\n                                                <div *ngIf=\"countresult.length == 0\">{{'staff.noresultfound' | translate}}\r\n                                                </div>\r\n                                            </div>\r\n                                        </mat-select>\r\n                                            <!-- <mat-select required formControlName=\"employ_state\"\r\n                                                panelClass=\"select_with_option\" (selectionChange)=\"stateselect(work.employ_state.value)\">\r\n                                                <mat-option *ngFor=\"let stat of state  | filter : searchGovernorate\"\r\n                                                value={{stat.opalstatemst_pk}}>{{ifarbic == true? (stat.osm_statename_ar):\r\n                                                (stat.osm_statename_en)}}</mat-option>\r\n                                            </mat-select> -->\r\n                                            <mat-label *ngIf=\"!nonoman\">{{'staff.state' | translate}}</mat-label>\r\n                                            <mat-label *ngIf=\"nonoman\">{{'staff.gove' | translate}}</mat-label>\r\n                                            <mat-error\r\n                                                *ngIf=\"(work.employ_state.errors?.required  || staffworkexperienceForm.submitted) && !nonoman\">\r\n                                                {{'staff.selestate' | translate}} </mat-error>\r\n                                            <mat-error\r\n                                                *ngIf=\"(work.employ_state.errors?.required  || staffworkexperienceForm.submitted) && nonoman\">\r\n                                                {{'staff.selegover' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                                <mat-select required formControlName=\"employ_city\" [errorStateMatcher]=\"matcher\"\r\n                                                panelClass=\"select_with_search\" (selectionChange)=\"stateselect(work.employ_state.value)\"\r\n                                                *ngIf=\"(citymst | filter : selectsearchcity) as countresult \" (click)=\"selectsearchcity = ''\">\r\n                                                <div class=\"searchinmultiselect\">\r\n                                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                        matInput class=\"searchselect\" type=\"Search\"\r\n                                                        placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                        (keydown)=\"$event.stopPropagation();\"\r\n                                                        [(ngModel)]=\"selectsearchcity\"\r\n                                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                    <mat-icon (click)=\"selectsearchcity = ''\" class=\"reseticon\" matSuffix\r\n                                                        *ngIf=\"selectsearchcity !='' && selectsearchcity !=null\">clear</mat-icon>\r\n                                                </div>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                    <mat-option *ngFor=\"let city of citymst  | filter : selectsearchcity\"\r\n                                                value={{city.opalcitymst_pk}}>{{ifarbic == true ? (city.ocim_cityname_ar):\r\n                                                (city.ocim_cityname_en)}}</mat-option>\r\n                                                    <div *ngIf=\"countresult.length == 0\">{{'staff.noresultfound' | translate}}\r\n                                                    </div>\r\n                                                </div>\r\n                                            </mat-select>\r\n                                            <!-- <mat-select required formControlName=\"employ_city\"\r\n                                                panelClass=\"select_with_option\">\r\n                                                <mat-option *ngFor=\"let city of citymst  | filter : searchGovernorate\"\r\n                                                value={{city.opalcitymst_pk}}>{{ifarbic == true ? (city.ocim_cityname_ar):\r\n                                                (city.ocim_cityname_en)}}</mat-option>\r\n                                            </mat-select> -->\r\n                                            <mat-label *ngIf=\"!nonoman\">{{'staff.city' | translate}}</mat-label>\r\n                                            <mat-label *ngIf=\"nonoman\">{{'staff.wila' | translate}}</mat-label>\r\n                                            <mat-error\r\n                                                *ngIf=\"(work.employ_city.errors?.required  || staffworkexperienceForm.submitted ) && !nonoman \">\r\n                                                {{'staff.selecity' | translate}} </mat-error>\r\n                                            <mat-error\r\n                                                *ngIf=\"(work.employ_city.errors?.required  || staffworkexperienceForm.submitted) && nonoman \">\r\n                                                {{'staff.selewila' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" class=\"p-t-10\" fxLayoutAlign=\"start center\">\r\n                                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                        <mat-form-field appearance=\"outline\">\r\n                                            <mat-label>{{'staff.desi' | translate}} </mat-label>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\"\r\n                                                [errorStateMatcher]=\"matcher\" matInput app-restrict-input=\"english\"\r\n                                                required formControlName=\"designat\">\r\n                                            <mat-error\r\n                                                *ngIf=\"work.designat.errors?.required || staffworkexperienceForm.submitted\">\r\n                                                {{'staff.entedesi' | translate}} </mat-error>\r\n                                        </mat-form-field>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                                    <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\"\r\n                                        type=\"button\" (click)=\"canclework()\">{{'staff.canc' |\r\n                                        translate}}\r\n                                    </button>\r\n                                    <button mat-raised-button color=\"primary\" type=\"button\"  *ngIf=\"this.staffworkapptype == 'new'\" (click)=\"savestaffwork()\"\r\n                                        class=\"ShowHidefs-15 submit_btn m-l-10\">{{'staff.add' | translate}}\r\n                                    </button>\r\n                                    <button mat-raised-button color=\"primary\" type=\"button\" *ngIf=\"this.staffworkapptype == 'edit'\"  (click)=\"savestaffwork()\"\r\n                                        class=\"ShowHidefs-15 submit_btn m-l-10\">{{'table.update' | translate}}\r\n                                    </button>\r\n                                </div>\r\n                              </div>\r\n                                <div class=\"paginationwithfilter masterPageTop m-t-30 workedtable\" #workedtable>\r\n                                    <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                                    <mat-paginator class=\"masterPage masterPageTop\" #paginatorfifth [length]=\"fifthLength\"\r\n                                        [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                        (page)=\"fifthPaginator($event);\"></mat-paginator>\r\n                                    <div fxLayout=\"row wrap\">\r\n                                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                            <button mat-raised-button type=\"button\" color=\"primary\"\r\n                                                (click)=\"clickfilterEvent()\" class=\"filter\">{{filtername}}<i\r\n                                                    class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                <div fxLayout=\"row wrap\" >\r\n                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                                        <div class=\"awaredtable\" >\r\n                                            <mat-table #table class=\"scrolldata\" [dataSource]=\"workExperience\" matSort\r\n                                                matSortDisableClear >\r\n                                                <ng-container matColumnDef=\"organname\">\r\n                                                    <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.empl' | translate}}</mat-header-cell>\r\n                                                    <mat-cell data-label=\"organname\" fxFlex=\"250px\"\r\n                                                        *matCellDef=\"let workexperienceData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{workexperienceData.organname}} </div>\r\n                                                        </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"datejoin\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.datejoin' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"datejoin\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let workexperienceData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{workexperienceData.datejoin}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"worktill\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.worktill' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"worktill\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let workexperienceData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{(workexperienceData.sexp_currentlyworking == 1)? ('Worktill' ): (workexperienceData.worktill)}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"desig\">\r\n                                                    <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header>{{'staff.jobtitl' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"desig\" fxFlex=\"180px\"\r\n                                                        *matCellDef=\"let workexperienceData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{workexperienceData.desig}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"addedu\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header> {{'staff.addon' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"addedu\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let workexperienceData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{workexperienceData.addedu}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"lastUpdated\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef\r\n                                                        mat-sort-header> {{'staff.lastupdat' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"lastUpdated\" fxFlex=\"263px\"\r\n                                                        *matCellDef=\"let workexperienceData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\">{{workexperienceData.lastUpdated?workexperienceData.lastUpdated:'-'}}</div>\r\n                                                         </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"action\" stickyEnd>\r\n                                                    <mat-header-cell fxFlex=\"100px\" mat-header-cell *matHeaderCellDef>\r\n                                                        {{'staff.Action' | translate}}\r\n                                                    </mat-header-cell>\r\n                                                    <mat-cell data-label=\"action\" fxFlex=\"100px\"\r\n                                                        *matCellDef=\"let workexperienceData\">\r\n                                                        <div *ngIf=\"tblplaceholder\" class=\"w-100\"><div class=\"tabledataloader\"></div></div>\r\n                                                        <div *ngIf=\"!tblplaceholder\"><div class=\"manageoptions\">\r\n                                                            <button class=\"menubutton\" mat-icon-button\r\n                                                                [matMenuTriggerFor]=\"actionmenu\"\r\n                                                                aria-label=\"Example icon-button with a menu\">\r\n                                                                <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                                            </button>\r\n                                                            <mat-menu #actionmenu=\"matMenu\"\r\n                                                                class=\"master-menu whentootltipadded\">\r\n                                                                <button type=\"button\" mat-menu-item (click)=\"editstaffwork(workexperienceData,'edit')\">\r\n                                                                    <span>{{'table.edit' | translate}} </span>\r\n                                                                </button>\r\n                                                                <button type=\"button\" mat-menu-item (click)=\"deletestaffwork(workexperienceData.staffworkexp_pk)\">\r\n                                                                    <span>{{'table.delete' | translate}}</span>\r\n                                                                </button>\r\n                                                                <button type=\"button\" mat-menu-item (click)=\"editstaffwork(workexperienceData,'view')\">\r\n                                                                    <span>{{'table.view' | translate}}</span>\r\n                                                                </button>\r\n                                                            </mat-menu>\r\n                                                        </div></div>\r\n                                                    </mat-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-first\">\r\n                                                    <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                            <input matInput [formControl]=\"oranisation\" (keyup)=\"serachwork($event.target.value,'oranisation')\" >\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-second\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"date_joined\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-three\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"work_till\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-four\">\r\n                                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <mat-label>{{'table.sele' | translate}}</mat-label>\r\n                                                        \r\n                                                                <input matInput [formControl]=\"designation\" (keyup)=\"serachwork($event.target.value,'designation')\" >\r\n                                                     \r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-five\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"add_edOn\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-six\">\r\n                                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n                                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                            <div class=\"drpicker\" id=\"regapp\">\r\n                                                                <input id=\"login_session\" [formControl]=\"date_last\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                                                                <div class=\"closeanddateicon\">\r\n                                                                    <mat-datepicker-toggle matSuffix >\r\n                                                                    </mat-datepicker-toggle>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-form-field>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"row-seven\" stickyEnd>\r\n                                                    <mat-header-cell fxFlex=\"100px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                        style=\"text-align:center\">\r\n        \r\n                                                        <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"clearFilterework();filtersts=false;\"\r\n                                                            aria-hidden=\"true\" matTooltip=\"{{'table.refr' |translate}}\"></i>\r\n                                                    </mat-header-cell>\r\n                                                </ng-container>\r\n                                                <mat-header-row id=\"headerrowcells\"\r\n                                                    *matHeaderRowDef=\"workExperienceList;sticky: true\">\r\n                                                </mat-header-row>\r\n                                                <mat-header-row id=\"filtershow\"\r\n                                                    *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six', 'row-seven' ]\">\r\n                                                </mat-header-row>\r\n                                                <mat-row mat-row\r\n                                                    *matRowDef=\"let row; columns: workExperienceList;\"></mat-row>\r\n                                                    <ng-container matColumnDef=\"disclaimer\">\r\n                                                        <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n                                                            <div class=\"leftmainspace\">\r\n                                                                <div class=\"subcontent\">\r\n                                                                    \r\n                                                                  <div fxLayout=\"row wrap\" >\r\n                                                                    <span fxFlex.gt-sm=\"48\" fxFlex=\"100\" class=\"pagetitle secondwidth \"></span>\r\n                                                                      </div>\r\n                                                                  <div class=\"descriptitlesector\">\r\n                                                                    <p class=\"pagetitle\"></p>\r\n                                                                    </div>\r\n                                                                    </div>\r\n                                                                    </div>\r\n                                                                    \r\n                                                            <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                                <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                                    <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                                    <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                        </td>\r\n                                                    </ng-container>\r\n                                                    <ng-container>\r\n                                                      \r\n                                                        <mat-footer-row [style.display]=\"(fifthLength > 0) ? 'none' : 'block' \" \r\n                                                            *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                                        </mat-footer-row>\r\n                                                    </ng-container>\r\n                                            </mat-table>\r\n                                        </div>\r\n                                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                                <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                                    class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                                    [pageSize]=\"paginatorfifth?.pageSize\"\r\n                                                    (page)=\"fifthPaginator($event);\"\r\n                                                    [pageIndex]=\"paginatorfifth?.pageIndex\" [length]=\"fifthLength\"\r\n                                                    [pageSizeOptions]=\"paginatorfifth?.pageSizeOptions\">\r\n                                                </mat-paginator>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </form>\r\n                        </div>\r\n                        <p class=\"fs-18 txt-gry3 subtitleform \">{{'staff.moheappr' | translate}}</p>\r\n                        <form autocomplete=\"off\" [formGroup]=\"courseselectForm\">\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                                <div fxFlex=\"100\" fxFlex.gt-sm=\"100\"  class=\"documents\">\r\n                                    <!-- <app-fileupload></app-fileupload>\r\n                                    -->\r\n                                        <app-filee #moheri [fileMstRef]=\"drvInputedmoheri\" [deleteicon]=\"deleteicon\"\r\n                                    (filesSelected)=\"fileeSelectedmoheri($event,drvInputedmoheri)\" formControlName=\"moheri_upload\"\r\n                                    ></app-filee>\r\n                                    <mat-hint class=\"txt-gry fs-12\"> {{'documents.noteyoucanupload' | translate}}</mat-hint>\r\n                                </div>\r\n                            </div> \r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-20\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required formControlName=\"rolefor_cour\" multiple\r\n                                            [errorStateMatcher]=\"matcher\" panelClass=\"select_with_option multiple\">\r\n                                            <mat-option *ngFor=\"let role of rolemst | filter : searchrole\"\r\n                                            value={{role.rolemst_pk}}>\r\n                                            {{ifarbic == true ? (role.rm_rolename_ar):\r\n                                            (role.rm_rolename_en)}}</mat-option>\r\n                                          \r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.roleofcourse' | translate}}</mat-label>\r\n                                        <mat-error\r\n                                            *ngIf=\"course.rolefor_cour.errors?.required || courseselectForm.submitted\">\r\n                                            {{'staff.seleroleofcourse' | translate}}\r\n                                        </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div fxFlex.gt-md=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required formControlName=\"select_coursubcate\" multiple\r\n                                            [errorStateMatcher]=\"matcher\" panelClass=\"select_with_option multiple\">\r\n                                            <mat-option\r\n                                            *ngFor=\"let subcate of staffsubcat  | filter : searchGovernorate1 \"\r\n                                            value={{subcate.appcoursetrnstmp_pk}}> {{ ifarbic == true ? (subcate.ccm_catname_ar):\r\n                                                (subcate.ccm_catname_en)}}</mat-option>\r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.coursubcate' | translate}}</mat-label>\r\n                                        <mat-error\r\n                                            *ngIf=\"course.select_coursubcate.errors?.required || courseselectForm.submitted\">\r\n                                            {{'staff.selecoursubcate' | translate}}\r\n                                        </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 m-b-25\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                    <mat-form-field appearance=\"outline\">\r\n                                        <mat-select required multiple formControlName=\"selectlanguage\"\r\n                                            [errorStateMatcher]=\"matcher\" panelClass=\"select_with_option multiple\">\r\n                                            <mat-option *ngFor=\"let lang of languages\"\r\n                                                value={{lang.referencemst_pk}}>{{ifarbic == true ? (lang.rm_name_ar):\r\n                                                (lang.rm_name_en)}}</mat-option>\r\n                                        </mat-select>\r\n                                        <mat-label>{{'staff.lang' | translate}}</mat-label>\r\n                                        <mat-icon matSuffix matTooltip=\"{{'staff.langinfo' | translate}}\">info_outline</mat-icon>\r\n                                        <mat-error\r\n                                            *ngIf=\"course.selectlanguage.errors?.required || courseselectForm.submitted\">\r\n                                            {{'staff.selelang' | translate}}\r\n                                        </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                        </form>\r\n                        <p class=\"fs-18 txt-gry3 subtitleform\">{{'staff.assesavai' | translate}} <mat-icon\r\n                                matTooltip=\"{{'staff.selecinfo' |translate}}\" class=\"m-l-5\">info_outline</mat-icon></p>\r\n                        <div class=\"carder m-b-40\">\r\n                            <form autocomplete=\"off\" [formGroup]=\"selectslotForm\">\r\n                                <div class=\"rangedate datepickerrangeform\" fxLayoutAlign=\"space-between center\">\r\n                                    <div fxLayout=\"row\" fxFlex=\"100\" fxLayoutAlign=\"flex-start center\">\r\n                                        <div fxFlex.gt-sm=\"62\" fxFlex=\"100\" class=\"m-b-30\">\r\n                                            <mat-form-field class=\"filter daterangetime\" appearance=\"outline\">\r\n                                                <mat-label>{{'staff.assesavai' |translate}}</mat-label>\r\n                                                <!-- <div class=\"drpicker\" id=\"regapp\"> -->\r\n                                                <!-- <input matInput type=\"text\" id=\"login_session\" [formControl]=\"daterange\"\r\n                                                    ngxDaterangepickerMd [showCustomRangeLabel]=\"true\"\r\n                                                    [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\" [locale]=\"locale\"\r\n                                                    (datesUpdated)=\"dateFltrChange($event)\" [linkedCalendars]=\"true\"\r\n                                                    [showClearButton]=\"true\" [maxDate]=\"selected2\"\r\n                                                    [showClearButton]=\"true\" readonly class=\"form-control\" />\r\n                                                <mat-datepicker-toggle matSuffix></mat-datepicker-toggle>\r\n                                                <mat-datepicker #dateexpiry></mat-datepicker> -->\r\n                                                <div class=\"drpicker\" id=\"regapp\">\r\n                                                    <input matInput type=\"text\" id=\"login_session\" [formControl]=\"daterange\"\r\n                                                    ngxDaterangepickerMd [showCustomRangeLabel]=\"true\"\r\n                                                    [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\" [locale]=\"locale\"\r\n                                                    (datesUpdated)=\"dateFltrChange($event)\" [linkedCalendars]=\"true\"\r\n                                                    [showClearButton]=\"true\" [maxDate]=\"selected2\"\r\n                                                    [showClearButton]=\"true\" readonly class=\"form-control\" />\r\n                                                        <div class=\"closeanddateicomax\">\r\n                                                            <mat-datepicker-toggle matSuffix></mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                </div>\r\n                                                <mat-error\r\n                                                    *ngIf=\"range.daterange.errors?.required || selectslotForm.submitted\">\r\n                                                    {{'staff.seleassesavail' | translate}}\r\n                                                </mat-error>\r\n                                            </mat-form-field>\r\n                                        </div>\r\n                                        <span fxFlex=\"20\" class=\"m-l-20 m-b-20 txt-gry3 fs-16\">Total: <span\r\n                                                class=\"txt-gry3 fs-16\">{{selectslotForm.controls['days'].value}}</span>\r\n                                            Days</span>\r\n                                    </div>\r\n                                    <div class=\"calendarbtn m-b-20\" fxLayoutAlign=\"end\">\r\n                                        <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                            (click)=\"canclstaff()\">{{'staff.canc' | translate}}\r\n                                        </button>\r\n                                        <button mat-raised-button color=\"primary\" type=\"submit\" (click)=\"staffAdd()\"\r\n                                            class=\"ShowHidefs-15 submit_btn m-l-10\">{{'staff.add' | translate}}\r\n                                        </button>\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"availabledate m-t-20\">\r\n                                    <div class=\"paginationwithfilter masterPageTop \">\r\n                                        <mat-paginator class=\"masterPage masterPageTop\" #paginator\r\n                                            [length]=\"sixLength\" [pageSize]=\"10\"\r\n                                            [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                            (page)=\"sixthPaginator($event);\"></mat-paginator>\r\n                                        <div fxLayout=\"row wrap\">\r\n                                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                                <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                                    class=\"ShowHidefs-15 setup_btn m-r-10\"\r\n                                                    (click)=\"scrollTo('pagescroll');opendialogquicksetup()\">{{'staff.quickset'\r\n                                                    | translate}}\r\n                                                    <mat-icon class=\"m-l-7\"></mat-icon>\r\n                                                </button>\r\n                                                <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                                    class=\"ShowHidefs-15 submit_btn m-r-10\">{{'staff.save' | translate}}\r\n                                                </button>\r\n                                                <button mat-raised-button type=\"button\" color=\"primary\"\r\n                                                    (click)=\"hideEvent()\" class=\"filter\">{{filtername}}<i\r\n                                                        class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                    <div fxLayout=\"row wrap\">\r\n                                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                                            <div class=\"availabletable\">\r\n                                                <mat-table #mtable class=\"scrolldata\" [dataSource]=\"batchtrainingdata\"\r\n                                                    matSort matSortDisableClear>\r\n                                                    <ng-container matColumnDef=\"selecteddate\">\r\n                                                        <mat-header-cell fxFlex=\"19\" mat-header-cell\r\n                                                            *matHeaderCellDef>{{'staff.seledate' |\r\n                                                            translate}}</mat-header-cell>\r\n                                                        <mat-cell data-label=\"selecteddate\" fxFlex=\"200px\"\r\n                                                            *matCellDef=\"let Timedata\">\r\n                                                            {{Timedata.selecteddate}} </mat-cell>\r\n                                                    </ng-container>\r\n                                                    <ng-container matColumnDef=\"schedule\">\r\n                                                        <mat-header-cell fxFlex=\"18\" mat-header-cell\r\n                                                            *matHeaderCellDef>{{'staff.daysched' |\r\n                                                            translate}}</mat-header-cell>\r\n                                                        <mat-cell data-label=\"schedule\" class=\"p-r-30\" fxFlex=\"200px\"\r\n                                                            *matCellDef=\"let Timedata\">\r\n                                                            <mat-form-field>\r\n                                                                <mat-select formControlName=\"availablestatus\"\r\n                                                                    (selectionChange)=\"checkData(selectslotForm.controls.availablestatus.value)\"\r\n                                                                    [(ngModel)]=\"Timedata.schedule\">\r\n                                                                    <mat-option *ngFor=\"let day of dayschedule\"\r\n                                                value={{day.referencemst_pk}}>{{ifarbic == true ? (day.rm_name_ar):\r\n                                                (day.rm_name_en)}}</mat-option>\r\n                                                                </mat-select>\r\n                                                            </mat-form-field>\r\n                                                        </mat-cell>\r\n                                                    </ng-container>\r\n                                                    <ng-container matColumnDef=\"start\">\r\n                                                        <mat-header-cell fxFlex=\"820px\" class=\"p-l-15\" mat-header-cell\r\n                                                            *matHeaderCellDef mat-sort-header>{{'course.courstarttime' | translate}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{'course.courendtime' | translate}}</mat-header-cell>\r\n                                                     <div >\r\n                                                        <mat-cell id=\"{{z}}\" data-label=\"{{'batch.officetype' | translate}}\" fxFlex=\"820px\"\r\n                                                        *matCellDef=\"let Timedata;let z = index;\">\r\n                                                        <div fxLayoutAlign=\"space-between\" class=\"w-100\">\r\n                                                            <div fxLayoutAlign=\"flex-start\">                                                                \r\n                                                                <div  fxLayoutAlign=\"flex-start center\"\r\n                                                                    class=\"slottag borderslot p-l-20\">\r\n                                                                    <form *ngIf=\"Timedata.subarr.length > 0\" class=\"usrfrm\" [formGroup]=\"userForm\">\r\n                                                                        <div *ngFor=\"let phone of Timedata.subarr; let i = index\">\r\n                                                                                <mat-form-field class=\"w-150 m-l-15\">\r\n                                                                                    <input matTimepicker #t=\"matTimepicker\" [minDate]=\"minValue\"\r\n                                                                                        [maxDate]=\"maxValue\" [strict]=\"false\"\r\n                                                                                        formControlName=\"sstarttime\"  id=\"form{{z}}{{i}}\" \r\n                                                                                        required>\r\n                                                                                    <mat-icon matSuffix\r\n                                                                                        (click)=\"t.showDialog()\">access_time</mat-icon>                                                                                    \r\n                                                                                </mat-form-field>\r\n                                                                                <mat-form-field class=\"w-150 m-l-15\">                                                                                    \r\n                                                                                        <input matTimepicker #et=\"matTimepicker\" [minDate]=\"minValue\"\r\n                                                                                            [maxDate]=\"maxValue\" [strict]=\"false\"  \r\n                                                                                            formControlName=\"sendtime\"  id=\"to{{z}}{{i}}\"  (timeChange)=\"calculateTimeDifference(z,i)\"\r\n                                                                                            required >\r\n                                                                                        <mat-icon matSuffix\r\n                                                                                            (click)=\"et.showDialog()\">access_time</mat-icon>                                                                                        \r\n                                                                                </mat-form-field>\r\n                                                                                <!-- <mat-form-field class=\"w-150 m-l-15\">                                                                                    \r\n                                                                                    <input  matInput\r\n                                                                                        formControlName=\"totaltime\" id=\"difference{{z}}{{i}}\"\r\n                                                                                        >\r\n                                                                                    <mat-icon matSuffix\r\n                                                                                        (click)=\"et.showDialog()\">access_time</mat-icon>                                                                                        \r\n                                                                            </mat-form-field> -->\r\n                                                                                <span class=\"fs-12 hrstag m-l-15\"><span id=\"difference{{z}}{{i}}\">{{formattedTime}}</span> Hr(s)</span>\r\n                                                                            <!-- <button class=\"m-l-15\" (click)=\"removePhone(i, z)\"><mat-icon>remove</mat-icon></button>   -->\r\n                                                                        </div>\r\n                                                                    </form> \r\n                                                                    <button class=\"m-l-15 txt-gry addbtn\" (click)=\"addPhone(z)\" >\r\n                                                                        <mat-icon>add</mat-icon> Add\r\n                                                                    </button> \r\n                                                                    <!-- <div *ngIf=\"weekend\">\r\n                                                                        <p class=\"week fs-16 lite-orange\">Weekend</p>\r\n                                                                   </div>\r\n                                                                   <div *ngIf=\"holiday\">\r\n                                                                      <p class=\"week fs-16 lite-orange\">Holiday</p>\r\n                                                                   </div> -->\r\n                                                                </div>\r\n                                                            </div>\r\n                                                            <div fxLayoutAlign=\"flex-start\">\r\n                                                                <button mat-raised-button class=\"m-r-10 clearbtn ShowHide fs-15\" *ngIf=\"\" (click)=\"removePhone(i, z)\"\r\n                                                                    type=\"button\">{{'course.courclear' | translate}}\r\n                                                                </button>\r\n                                                                <!-- <button mat-raised-button class=\"m-r-10 clearbtn ShowHide fs-15\"  (click)=\"clearRecordData(Timedata.id))\"\r\n                                                                    type=\"button\">{{'course.courclear' | translate}}\r\n                                                                </button> -->\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </mat-cell>\r\n                                                     </div>\r\n                                                     \r\n                                                    </ng-container>\r\n                                                    <!-- <ng-container matColumnDef=\"start\">\r\n                                                        <mat-header-cell fxFlex=\"60\" mat-header-cell\r\n                                                            *matHeaderCellDef>{{'staff.startdate' |\r\n                                                            translate}}</mat-header-cell>\r\n                                                        <mat-cell data-label=\"start\" fxFlex=\"60\"\r\n                                                            *matCellDef=\"let Timedata\">\r\n                                                            <div fxLayoutAlign=\"flex-start\">\r\n                                                                <div class=\"timepickerwidth m-r-15 m-l-15\">\r\n                                                                    <mat-form-field>\r\n                                                                        <input matTimepicker #t=\"matTimepicker\"\r\n                                                                            [minDate]=\"minValue\" [maxDate]=\"maxValue\"\r\n                                                                            [(ngModel)]=\"starTtime\" [strict]=\"false\"\r\n                                                                            formControlName=\"starttime\"\r\n                                                                            (ngModelChange)=\"calculateTimeDifference()\"\r\n                                                                            required>\r\n                                                                        <mat-icon matSuffix\r\n                                                                            (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                                                                        <mat-error\r\n                                                                            *ngIf=\"range.starttime.errors?.required || selectslotForm.submitted\">\r\n                                                                            {{'staff.starttime' | translate}}\r\n                                                                        </mat-error>\r\n                                                                    </mat-form-field>\r\n                                                                </div>\r\n                                                                <div class=\"timepickerwidth\">\r\n                                                                    <mat-form-field>\r\n                                                                        <input matTimepicker #t=\"matTimepicker\"\r\n                                                                            [minDate]=\"minValue\" [maxDate]=\"maxValue\"\r\n                                                                            [strict]=\"false\" formControlName=\"endtime\"\r\n                                                                            [(ngModel)]=\"enDtime\" required\r\n                                                                            (ngModelChange)=\"calculateTimeDifference()\">\r\n                                                                        <mat-icon matSuffix\r\n                                                                            (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                                                                        <mat-error\r\n                                                                            *ngIf=\"range.endtime.errors?.required || selectslotForm.submitted\">\r\n                                                                            {{'staff.endtime' | translate}} </mat-error>\r\n                                                                    </mat-form-field>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                            <div fxLayoutAlign=\"space-between\" class=\"w-100\">\r\n                                                                <div fxLayoutAlign=\"flex-start\">\r\n                                                                    <span class=\"fs-12 hrstag m-r-20\">{{formattedTime}}\r\n                                                                        Hr(s)</span>\r\n                                                                    <div fxLayoutAlign=\"flex-start center\"\r\n                                                                        class=\"slottag borderslot p-l-20\">\r\n                                                                        <mat-icon>add</mat-icon>\r\n                                                                        <span class=\"fs-14 p-l-8\">{{'course.add' |\r\n                                                                            translate}}</span>\r\n                                                                    </div>\r\n                                                                </div>\r\n                                                                <div fxLayoutAlign=\"flex-start\">\r\n                                                                    <button mat-raised-button\r\n                                                                        class=\"m-r-10 clearbtn ShowHide fs-15\"\r\n                                                                        type=\"button\">{{'course.clear' | translate}}\r\n                                                                    </button>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </mat-cell>\r\n                                                    </ng-container> -->\r\n\r\n                                                    <ng-container matColumnDef=\"row-first\">\r\n                                                        <mat-header-cell fxFlex=\"19\" class=\"serachrow\" *matHeaderCellDef\r\n                                                            style=\"text-align:center\">\r\n                                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                                <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                                <input matInput [formControl]=\"appl_form\">\r\n                                                            </mat-form-field>\r\n                                                        </mat-header-cell>\r\n                                                    </ng-container>\r\n                                                    <ng-container matColumnDef=\"row-second\">\r\n                                                        <mat-header-cell fxFlex=\"18\" class=\"serachrow\" *matHeaderCellDef\r\n                                                            style=\"text-align:center\">\r\n                                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                                <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                                                <input matInput [formControl]=\"course_cat\">\r\n                                                            </mat-form-field>\r\n                                                        </mat-header-cell>\r\n                                                    </ng-container>\r\n                                                    <mat-header-row id=\"headerrowcells\"\r\n                                                        *matHeaderRowDef=\"BatchtrainingData;sticky: true\">\r\n                                                    </mat-header-row>\r\n                                                    <mat-header-row id=\"searchfilters\"\r\n                                                        *matHeaderRowDef=\"['row-first' , 'row-second']\">\r\n                                                    </mat-header-row>\r\n                                                    <mat-row mat-row\r\n                                                        *matRowDef=\"let row; columns: BatchtrainingData;\"></mat-row>\r\n                                                </mat-table>\r\n                                            </div>\r\n                                            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                                    <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                                        class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                                        [pageSize]=\"paginator?.pageSize\"\r\n                                                        (page)=\"sixthPaginator($event);\"\r\n                                                        [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                                        [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                                    </mat-paginator>\r\n                                                </div>\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </form>\r\n                        </div>\r\n                        <p class=\"fs-18 txt-gry3 subtitleform\">{{'staff.asseloca' | translate}} <mat-icon\r\n                                matTooltip=\"{{'staff.selectinfolocat' |translate}}\"\r\n                                class=\"m-l-5\">info_outline</mat-icon></p>\r\n                               \r\n                        <form autocomplete=\"off\" [formGroup]=\"addressForm\">\r\n                            <div formArrayName=\"Address\" class=\"courebox m-t-15\" fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start baseline\">\r\n                                <div *ngFor=\"let referral of AddressFormArr.controls; let i = index\"  fxFlex=\"96\">\r\n                                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 units\"\r\n                                        [formGroupName]=\"i\" >\r\n                                        <div fxFlex.gt-sm=\"48\" fxFlex=\"98\">\r\n                                            <mat-form-field appearance=\"outline\">\r\n                                                <mat-label>{{'staff.gove' | translate}} </mat-label>\r\n                                                <mat-select required formControlName=\"governate\" [errorStateMatcher]=\"matcher\"\r\n                                                panelClass=\"select_with_search\" (click)=\"searchGovernorate = ''\"\r\n                                                *ngIf=\"(statemst | filter : searchGovernorate) as countresult\"\r\n                                                (selectionChange)=\"sample(i,$event)\">\r\n                                                <div class=\"searchinmultiselect\">\r\n                                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                        matInput class=\"searchselect\" type=\"Search\"\r\n                                                        placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                        (keydown)=\"$event.stopPropagation();\"\r\n                                                        [(ngModel)]=\"searchGovernorate\"\r\n                                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                    <mat-icon (click)=\"searchGovernorate = ''\" class=\"reseticon\" matSuffix\r\n                                                        *ngIf=\"searchGovernorate !='' && searchGovernorate !=null\">clear</mat-icon>\r\n                                                </div>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                    <mat-option *ngFor=\"let state of statemst  | filter : searchGovernorate\"\r\n                                                    value={{state.opalstatemst_pk}}>{{ifarbic == true? (state.osm_statename_ar):\r\n                                                    (state.osm_statename_en)}}</mat-option>\r\n                                                    <div *ngIf=\"countresult?.length == 0\">{{'staff.nocounmatc' | translate}}\r\n                                                    </div>\r\n                                                </div>\r\n                                            </mat-select>\r\n                                                <!-- <mat-select required formControlName=\"governate\"\r\n                                                  panelClass=\"select_with_option\"  (selectionChange)=\"sample(i,$event)\">\r\n                                                    <mat-option *ngFor=\"let state of statemst  | filter : searchGovernorate\"\r\n                                                    value={{state.opalstatemst_pk}}>{{ifarbic == true? (state.osm_statename_ar):\r\n                                                    (state.osm_statename_en)}}</mat-option>\r\n                                                </mat-select> -->\r\n                                                <mat-error\r\n                                                    *ngIf=\"getReferralsFormArr(i).controls['governate'].hasError('required') || CourseForm.submitted\">\r\n                                                    {{'staff.selegover' | translate}} </mat-error>\r\n                                            </mat-form-field>\r\n                                        </div>\r\n                                        <div fxFlex.gt-md=\"48\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                            ngClass.lg=\"p-l-20\" ngClass.xl=\"p-l-20\" fxFlex=\"98\">\r\n                                            <mat-form-field appearance=\"outline\">\r\n                                                <mat-label>{{'staff.wila' | translate}} </mat-label>\r\n                                                <mat-select required formControlName=\"wilayat\" [errorStateMatcher]=\"matcher\"\r\n                                                panelClass=\"select_with_search multiple\" (click)=\"searchGovernoratewilay = ''\"\r\n                                                *ngIf=\"(citylist[i] | filter : searchGovernoratewilay) as countresult\"\r\n                                                multiple>\r\n                                                <div class=\"searchinmultiselect\">\r\n                                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb\r\n                                                        matInput class=\"searchselect\" type=\"Search\"\r\n                                                        placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                        (keydown)=\"$event.stopPropagation();\"\r\n                                                        [(ngModel)]=\"searchGovernoratewilay\"\r\n                                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                                    <mat-icon (click)=\"searchGovernoratewilay = ''\" class=\"reseticon\" matSuffix\r\n                                                        *ngIf=\"searchGovernoratewilay !='' && searchGovernoratewilay !=null\">clear</mat-icon>\r\n                                                </div>\r\n                                                <div class=\"option-listing countryselectwithimage\">\r\n                                                    <mat-option *ngFor=\"let city of citylist[i]  | filter : searchGovernoratewilay\"\r\n                                                    value={{city.opalcitymst_pk}}>{{ifarbic == true ? (city.ocim_cityname_ar):\r\n                                                    (city.ocim_cityname_en)}}</mat-option>\r\n                                                    <div *ngIf=\"countresult?.length == 0\">{{'staff.nocounmatc' | translate}}\r\n                                                    </div>\r\n                                                </div>\r\n                                                <!-- <mat-select required multiple formControlName=\"wilayat\"\r\n                                                    panelClass=\"select_with_option\" >\r\n                                                    <mat-option *ngFor=\"let city of citylist[i]  | filter : searchGovernorate\"\r\n                                                    value={{city.opalcitymst_pk}}>{{ifarbic == true ? (city.ocim_cityname_ar):\r\n                                                    (city.ocim_cityname_en)}}</mat-option> -->\r\n                                                </mat-select>\r\n                                                <mat-error *ngIf=\"getReferralsFormArr(i).controls['wilayat'].hasError('required') || CourseForm.submitted\">\r\n                                                    {{'staff.selewilayat' | translate}} </mat-error>\r\n                                            </mat-form-field>\r\n                                        </div>\r\n                                        <div  *ngIf=\"addressForm.get('Address').controls.length > 1 && addressForm.get('Address').controls.length != i+1\" class=\"icongroup p-l-30\" fxFlex=\"1\" fxLayout=\"row wrap\" >\r\n                                            <mat-icon matTooltip=\"delete\" class=\"delete m-b-19 fa fa-trash-o\" (click)=\"removeReferral(i)\"></mat-icon>\r\n                                        </div>\r\n                                        <!-- <div class=\"icongroup p-l-20\" fxFlex.gt-md=\"4\">\r\n                                            <mat-icon matTooltip=\"delete\" class=\"delete m-b-19 fa fa-trash-o\"\r\n                                                (click)=\"removeReferral(i)\"></mat-icon>\r\n                                        </div> -->\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"icongroup\"  fxLayout=\"row wrap\">\r\n                                    <mat-icon matTooltip=\"click to add fields\" class=\"add p-t-5\"  (click)=\"addReferral()\">add</mat-icon>\r\n                                </div>\r\n                            </div>\r\n                        </form>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                            <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                (click)=\"canclstaff()\">{{'staff.canc' | translate}}\r\n                            </button>\r\n                            <button mat-raised-button color=\"primary\" *ngIf=\"this.staffapptype == 'new'\" type=\"submit\" (click)=\"staffAdd()\"\r\n                                class=\"ShowHidefs-15 submit_btn m-l-10\">{{'staff.add' | translate}}\r\n                            </button>\r\n                            <button mat-raised-button color=\"primary\" *ngIf=\"this.staffapptype == 'edit'\" type=\"submit\" (click)=\"staffAdd()\"\r\n                                class=\"ShowHidefs-15 submit_btn m-l-10\">{{'Update'}}\r\n                            </button>\r\n                        </div>\r\n                    </div>\r\n\r\n                    </div>\r\n                </div>\r\n            </ng-template>\r\n        </div>\r\n        <div class=\"success\" fxLayout=\"row\" fxLayoutAlign=\"center center \" *ngIf=\"!Submitted\">\r\n            <div fxFlex=\"50\" class=\"centercontent\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                <div class=\"success_icon\">\r\n                    <mat-icon>check</mat-icon>\r\n                </div>\r\n                <div class=\"succes_msg text-center\">\r\n                    <h4 clss=\"20\">{{'succes.thankyou' | translate}}</h4>\r\n                    <p>{{'succes.thankyoucontent' | translate}}</p>\r\n                    <button mat-raised-button class=\"viewform\">{{'succes.viewform' | translate}}</button>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <ng-template [ngSwitchCase]=\"'payment'\">\r\n        <app-opalpayment [payment]=\"payment\" [record]=\"record\" ></app-opalpayment>\r\n    </ng-template>\r\n</div>\r\n\r\n<app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>";
    /***/
  },

  /***/
  "./src/app/modules/standardcourses/modalavailabledate.scss":
  /*!*****************************************************************!*\
    !*** ./src/app/modules/standardcourses/modalavailabledate.scss ***!
    \*****************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesStandardcoursesModalavailabledateScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".quicksetuplist .mat-dialog-container {\n  padding: 0px !important;\n}\n.quicksetuplist #traininglistpopup .clearbtn, .quicksetuplist #traininglistpopup .savebtn {\n  min-width: 65px;\n  background-color: #fff;\n  color: #333;\n  border: 1px solid #c4c4c4;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 30px;\n  box-shadow: none;\n  line-height: 1;\n}\n.quicksetuplist #traininglistpopup .timepickerwidth {\n  max-width: 85px;\n}\n.quicksetuplist #traininglistpopup .timepickerwidth .mat-icon {\n  font-size: 20px;\n  color: #848484;\n}\n.quicksetuplist #traininglistpopup .slottag .mat-icon {\n  color: #848484;\n}\n.quicksetuplist #traininglistpopup .slottag span {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .mindaterangewidth {\n  min-width: 230px;\n}\n.quicksetuplist #traininglistpopup .savebtn {\n  background-color: #ed1c27 !important;\n  color: #fff !important;\n  border: none !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist {\n  border-top: 1px solid #ddd;\n  border-left: 1px solid #ddd;\n  border-right: 1px solid #ddd;\n}\n.quicksetuplist #traininglistpopup .summarytablelist mat-cell, .quicksetuplist #traininglistpopup .summarytablelist mat-header-cell, .quicksetuplist #traininglistpopup .summarytablelist mat-footer-cell {\n  flex: 1;\n  display: flex;\n  align-items: center;\n  overflow: inherit !important;\n  word-wrap: break-word;\n  min-height: inherit;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-row, .quicksetuplist #traininglistpopup .summarytablelist .mat-row {\n  min-height: 36px !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .daytopalign {\n  width: 100px;\n  background: #fff;\n  position: relative;\n  top: -18px;\n  overflow: inherit;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .daytopalign h4 {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .summarytablelist mat-cell:first-of-type, .quicksetuplist #traininglistpopup .summarytablelist mat-header-cell:first-of-type, .quicksetuplist #traininglistpopup .summarytablelist mat-footer-cell:first-of-type {\n  padding-left: 0px !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-cell {\n  font-size: 14px;\n  color: #262626 !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-cell, .quicksetuplist #traininglistpopup .summarytablelist .mat-cell {\n  text-align: center;\n  border-left: 1px solid #ddd;\n  justify-content: center;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-cell:first-child, .quicksetuplist #traininglistpopup .summarytablelist .mat-cell:first-child {\n  border-left: 0 !important;\n}\n.quicksetuplist #traininglistpopup .trainingdurationhead {\n  padding: 10px 25px;\n  background-color: #0c4b9a;\n  border-radius: 3px;\n}\n.quicksetuplist #traininglistpopup .trainingdurationhead .mat-icon {\n  color: #fff;\n}\n.quicksetuplist #traininglistpopup .trainingdurationhead h2 {\n  color: #fff;\n}\n.quicksetuplist #traininglistpopup .conftiming h4 {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .totalleanerheader p {\n  color: #848484;\n  padding-bottom: 4px;\n}\n.quicksetuplist #traininglistpopup .totalleanerheader span {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .coursesubtitle .complantag {\n  border: 1px solid #ddd;\n  padding: 8px 10px;\n}\n.quicksetuplist #traininglistpopup .coursesubtitle p {\n  color: #848484;\n}\n.quicksetuplist #traininglistpopup .coursesubtitle span {\n  color: #262626;\n}\n@media (max-width: 699px) {\n  .rangewidthdateres {\n    display: block !important;\n  }\n\n  .mindaterangewidth {\n    padding-bottom: 10px;\n  }\n\n  .widthlangtitle {\n    padding-top: 15px;\n  }\n}\n@media (max-width: 768px) {\n  .summarytablelist {\n    position: relative;\n    z-index: 1;\n    display: block;\n    overflow-x: auto;\n    overflow-y: hidden;\n    background-color: #fff;\n    scroll-behavior: smooth;\n  }\n  .summarytablelist::-webkit-scrollbar {\n    width: 6px;\n    height: 5px;\n  }\n  .summarytablelist::-webkit-scrollbar-track {\n    background: #f1f1f1;\n  }\n  .summarytablelist::-webkit-scrollbar-thumb {\n    background: #ccc;\n    border-radius: 2px;\n  }\n  .summarytablelist::-webkit-scrollbar-thumb:hover {\n    background: #ccc;\n  }\n}\n@media (max-width: 768px) and (min-width: 766px) {\n  .widthrestitle {\n    max-width: 13% !important;\n  }\n\n  .widthlangtitle {\n    max-width: 87% !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9zdGFuZGFyZGNvdXJzZXMvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcc3RhbmRhcmRjb3Vyc2VzXFxtb2RhbGF2YWlsYWJsZWRhdGUuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9zdGFuZGFyZGNvdXJzZXMvbW9kYWxhdmFpbGFibGVkYXRlLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBRUU7RUFDRSx1QkFBQTtBQ0RKO0FESVE7RUFDSSxlQUFBO0VBQ0Esc0JBQUE7RUFDQSxXQUFBO0VBQ0EseUJBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtFQUNBLGdCQUFBO0VBQ0EsY0FBQTtBQ0ZaO0FESVM7RUFDRyxlQUFBO0FDRlo7QURHWTtFQUNJLGVBQUE7RUFDQSxjQUFBO0FDRGhCO0FES2E7RUFDRyxjQUFBO0FDSGhCO0FES2E7RUFDSSxjQUFBO0FDSGpCO0FETVM7RUFDSSxnQkFBQTtBQ0piO0FETVM7RUFFRyxvQ0FBQTtFQUNBLHNCQUFBO0VBQ0EsdUJBQUE7QUNMWjtBRFFRO0VBQ0ksMEJBQUE7RUFDQSwyQkFBQTtFQUNBLDRCQUFBO0FDTlo7QURPWTtFQUNJLE9BQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSw0QkFBQTtFQUNBLHFCQUFBO0VBQ0EsbUJBQUE7QUNMaEI7QURPVTtFQUNHLDJCQUFBO0FDTGI7QURPVTtFQUNFLFlBQUE7RUFDQSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLGlCQUFBO0FDTFo7QURNWTtFQUNLLGNBQUE7QUNKakI7QURPVTtFQUNFLDRCQUFBO0FDTFo7QURPVTtFQUNNLGVBQUE7RUFDQSx5QkFBQTtBQ0xoQjtBRE9VO0VBQ0ksa0JBQUE7RUFDQSwyQkFBQTtFQUNBLHVCQUFBO0FDTGQ7QURNYztFQUNHLHlCQUFBO0FDSmpCO0FEU1E7RUFDSSxrQkFBQTtFQUNBLHlCQUFBO0VBQ0Esa0JBQUE7QUNQWjtBRFFZO0VBQ0ssV0FBQTtBQ05qQjtBRFFZO0VBQ0ssV0FBQTtBQ05qQjtBRFVXO0VBQ0MsY0FBQTtBQ1JaO0FEWVE7RUFDRyxjQUFBO0VBQ0EsbUJBQUE7QUNWWDtBRFlRO0VBQ0ssY0FBQTtBQ1ZiO0FEY1E7RUFDTSxzQkFBQTtFQUNBLGlCQUFBO0FDWmQ7QURjVztFQUNLLGNBQUE7QUNaaEI7QURjVztFQUNFLGNBQUE7QUNaYjtBRG9CQTtFQUNFO0lBQ0kseUJBQUE7RUNqQko7O0VEbUJBO0lBQ0csb0JBQUE7RUNoQkg7O0VEa0JBO0lBRUUsaUJBQUE7RUNoQkY7QUFDRjtBRG9CQTtFQUVFO0lBQ0Usa0JBQUE7SUFDQSxVQUFBO0lBQ0EsY0FBQTtJQUNBLGdCQUFBO0lBQ0Esa0JBQUE7SUFDQSxzQkFBQTtJQUNBLHVCQUFBO0VDbkJGO0VEb0JFO0lBQ0ksVUFBQTtJQUNBLFdBQUE7RUNsQk47RURxQkU7SUFDSSxtQkFBQTtFQ25CTjtFRHNCRTtJQUNJLGdCQUFBO0lBQ0Esa0JBQUE7RUNwQk47RUR1QkU7SUFDSSxnQkFBQTtFQ3JCTjtBQUNGO0FEMEJBO0VBQ0s7SUFDRyx5QkFBQTtFQ3hCTjs7RUQwQkc7SUFDQyx5QkFBQTtFQ3ZCSjtBQUNGIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9zdGFuZGFyZGNvdXJzZXMvbW9kYWxhdmFpbGFibGVkYXRlLnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJcclxuLnF1aWNrc2V0dXBsaXN0e1xyXG4gIC5tYXQtZGlhbG9nLWNvbnRhaW5lciB7XHJcbiAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgfVxyXG4gICAgI3RyYWluaW5nbGlzdHBvcHVwe1xyXG4gICAgICAgIC5jbGVhcmJ0biB7XHJcbiAgICAgICAgICAgIG1pbi13aWR0aDogNjVweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNjNGM0YzQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgLnRpbWVwaWNrZXJ3aWR0aHtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA4NXB4O1xyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgIH1cclxuICAgICAgICAgLnNsb3R0YWd7XHJcbiAgICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDsgICBcclxuICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICB9XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgLm1pbmRhdGVyYW5nZXdpZHRoe1xyXG4gICAgICAgICAgICAgbWluLXdpZHRoOiAyMzBweDtcclxuICAgICAgICAgfVxyXG4gICAgICAgICAuc2F2ZWJ0bntcclxuICAgICAgICAgICAgQGV4dGVuZCAuY2xlYXJidG47XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICB9XHJcbiAgICAgICAgLnN1bW1hcnl0YWJsZWxpc3R7XHJcbiAgICAgICAgICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICBib3JkZXItbGVmdDogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgICAgIGJvcmRlci1yaWdodDogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgICAgIG1hdC1jZWxsLCBtYXQtaGVhZGVyLWNlbGwsIG1hdC1mb290ZXItY2VsbCB7XHJcbiAgICAgICAgICAgICAgICBmbGV4OiAxO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBvdmVyZmxvdzogaW5oZXJpdCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgd29yZC13cmFwOiBicmVhay13b3JkO1xyXG4gICAgICAgICAgICAgICAgbWluLWhlaWdodDogaW5oZXJpdDtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIC5tYXQtaGVhZGVyLXJvdywgLm1hdC1yb3d7XHJcbiAgICAgICAgICAgICBtaW4taGVpZ2h0OiAzNnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgIC5kYXl0b3BhbGlnbntcclxuICAgICAgICAgICAgd2lkdGg6IDEwMHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgIHRvcDogLTE4cHg7XHJcbiAgICAgICAgICAgIG92ZXJmbG93OiBpbmhlcml0O1xyXG4gICAgICAgICAgICBoNHtcclxuICAgICAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgICAgbWF0LWNlbGw6Zmlyc3Qtb2YtdHlwZSwgbWF0LWhlYWRlci1jZWxsOmZpcnN0LW9mLXR5cGUsIG1hdC1mb290ZXItY2VsbDpmaXJzdC1vZi10eXBlIHtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDsgXHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICAubWF0LWhlYWRlci1jZWxse1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNHB4IDtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwsIC5tYXQtY2VsbHtcclxuICAgICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICAgICY6Zmlyc3QtY2hpbGR7XHJcbiAgICAgICAgICAgICAgICAgYm9yZGVyLWxlZnQ6IDAgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICBcclxuICAgICAgICAudHJhaW5pbmdkdXJhdGlvbmhlYWR7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDEwcHggMjVweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4O1xyXG4gICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgaDJ7XHJcbiAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgIH1cclxuICAgICAgIC5jb25mdGltaW5ne1xyXG4gICAgICAgICAgIGg0e1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgIH0gICBcclxuICAgICAgIH1cclxuICAgICAgIC50b3RhbGxlYW5lcmhlYWRlcntcclxuICAgICAgICBwe1xyXG4gICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgIHBhZGRpbmctYm90dG9tOiA0cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgIC5jb3Vyc2VzdWJ0aXRsZXtcclxuICAgICAgICAuY29tcGxhbnRhZ3tcclxuICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICAgIHBhZGRpbmc6IDhweCAxMHB4O1xyXG4gICAgICAgIH1cclxuICAgICAgICAgICBwe1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgICAgfVxyXG4gICAgICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICB9XHJcbiAgICAgICB9XHJcbiAgICAgICBcclxuICAgIH1cclxufVxyXG5cclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOiA2OTlweCkge1xyXG4gIC5yYW5nZXdpZHRoZGF0ZXJlc3tcclxuICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLm1pbmRhdGVyYW5nZXdpZHRoe1xyXG4gICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gIH1cclxuICAud2lkdGhsYW5ndGl0bGV7XHJcblxyXG4gICAgcGFkZGluZy10b3A6IDE1cHg7XHJcbiAgfVxyXG59XHJcblxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiBcclxuICAuc3VtbWFyeXRhYmxlbGlzdCB7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICB6LWluZGV4OiAxO1xyXG4gICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgb3ZlcmZsb3cteTogaGlkZGVuO1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoOyBcclxuICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICAgICAgICB3aWR0aDogNnB4O1xyXG4gICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgfVxyXG4gIFxyXG4gICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XHJcbiAgICB9XHJcbiAgXHJcbiAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICB9XHJcbiAgXHJcbiAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgIH1cclxuICB9XHJcbn1cclxuXHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIGFuZCAobWluLXdpZHRoOiA3NjZweCkge1xyXG4gICAgIC53aWR0aHJlc3RpdGxle1xyXG4gICAgICAgIG1heC13aWR0aDogMTMlICFpbXBvcnRhbnQ7XHJcbiAgICAgfVxyXG4gICAgIC53aWR0aGxhbmd0aXRsZXtcclxuICAgICAgbWF4LXdpZHRoOiA4NyUgIWltcG9ydGFudDtcclxuICAgfVxyXG59IiwiLnF1aWNrc2V0dXBsaXN0IC5tYXQtZGlhbG9nLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuY2xlYXJidG4sIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnNhdmVidG4ge1xuICBtaW4td2lkdGg6IDY1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGNvbG9yOiAjMzMzO1xuICBib3JkZXI6IDFweCBzb2xpZCAjYzRjNGM0O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDMwcHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG4gIGxpbmUtaGVpZ2h0OiAxO1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudGltZXBpY2tlcndpZHRoIHtcbiAgbWF4LXdpZHRoOiA4NXB4O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudGltZXBpY2tlcndpZHRoIC5tYXQtaWNvbiB7XG4gIGZvbnQtc2l6ZTogMjBweDtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zbG90dGFnIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc2xvdHRhZyBzcGFuIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5taW5kYXRlcmFuZ2V3aWR0aCB7XG4gIG1pbi13aWR0aDogMjMwcHg7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zYXZlYnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3Qge1xuICBib3JkZXItdG9wOiAxcHggc29saWQgI2RkZDtcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xuICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZGRkO1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCBtYXQtY2VsbCwgLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCBtYXQtaGVhZGVyLWNlbGwsIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgbWF0LWZvb3Rlci1jZWxsIHtcbiAgZmxleDogMTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgb3ZlcmZsb3c6IGluaGVyaXQgIWltcG9ydGFudDtcbiAgd29yZC13cmFwOiBicmVhay13b3JkO1xuICBtaW4taGVpZ2h0OiBpbmhlcml0O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWhlYWRlci1yb3csIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgLm1hdC1yb3cge1xuICBtaW4taGVpZ2h0OiAzNnB4ICFpbXBvcnRhbnQ7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zdW1tYXJ5dGFibGVsaXN0IC5kYXl0b3BhbGlnbiB7XG4gIHdpZHRoOiAxMDBweDtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0b3A6IC0xOHB4O1xuICBvdmVyZmxvdzogaW5oZXJpdDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgLmRheXRvcGFsaWduIGg0IHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zdW1tYXJ5dGFibGVsaXN0IG1hdC1jZWxsOmZpcnN0LW9mLXR5cGUsIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgbWF0LWhlYWRlci1jZWxsOmZpcnN0LW9mLXR5cGUsIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgbWF0LWZvb3Rlci1jZWxsOmZpcnN0LW9mLXR5cGUge1xuICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWhlYWRlci1jZWxsIHtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBjb2xvcjogIzI2MjYyNiAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWhlYWRlci1jZWxsLCAucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zdW1tYXJ5dGFibGVsaXN0IC5tYXQtY2VsbCB7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgLm1hdC1oZWFkZXItY2VsbDpmaXJzdC1jaGlsZCwgLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWNlbGw6Zmlyc3QtY2hpbGQge1xuICBib3JkZXItbGVmdDogMCAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudHJhaW5pbmdkdXJhdGlvbmhlYWQge1xuICBwYWRkaW5nOiAxMHB4IDI1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XG4gIGJvcmRlci1yYWRpdXM6IDNweDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnRyYWluaW5nZHVyYXRpb25oZWFkIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjZmZmO1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudHJhaW5pbmdkdXJhdGlvbmhlYWQgaDIge1xuICBjb2xvcjogI2ZmZjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLmNvbmZ0aW1pbmcgaDQge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnRvdGFsbGVhbmVyaGVhZGVyIHAge1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgcGFkZGluZy1ib3R0b206IDRweDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnRvdGFsbGVhbmVyaGVhZGVyIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLmNvdXJzZXN1YnRpdGxlIC5jb21wbGFudGFnIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbiAgcGFkZGluZzogOHB4IDEwcHg7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5jb3Vyc2VzdWJ0aXRsZSBwIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5jb3Vyc2VzdWJ0aXRsZSBzcGFuIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA2OTlweCkge1xuICAucmFuZ2V3aWR0aGRhdGVyZXMge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWluZGF0ZXJhbmdld2lkdGgge1xuICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLndpZHRobGFuZ3RpdGxlIHtcbiAgICBwYWRkaW5nLXRvcDogMTVweDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gIC5zdW1tYXJ5dGFibGVsaXN0IHtcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gICAgei1pbmRleDogMTtcbiAgICBkaXNwbGF5OiBibG9jaztcbiAgICBvdmVyZmxvdy14OiBhdXRvO1xuICAgIG92ZXJmbG93LXk6IGhpZGRlbjtcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xuICB9XG4gIC5zdW1tYXJ5dGFibGVsaXN0Ojotd2Via2l0LXNjcm9sbGJhciB7XG4gICAgd2lkdGg6IDZweDtcbiAgICBoZWlnaHQ6IDVweDtcbiAgfVxuICAuc3VtbWFyeXRhYmxlbGlzdDo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xuICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XG4gIH1cbiAgLnN1bW1hcnl0YWJsZWxpc3Q6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgICBiYWNrZ3JvdW5kOiAjY2NjO1xuICAgIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgfVxuICAuc3VtbWFyeXRhYmxlbGlzdDo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICAgIGJhY2tncm91bmQ6ICNjY2M7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkgYW5kIChtaW4td2lkdGg6IDc2NnB4KSB7XG4gIC53aWR0aHJlc3RpdGxlIHtcbiAgICBtYXgtd2lkdGg6IDEzJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRobGFuZ3RpdGxlIHtcbiAgICBtYXgtd2lkdGg6IDg3JSAhaW1wb3J0YW50O1xuICB9XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/standardcourses/standardcourses-routing.module.ts":
  /*!***************************************************************************!*\
    !*** ./src/app/modules/standardcourses/standardcourses-routing.module.ts ***!
    \***************************************************************************/

  /*! exports provided: StandardcoursesRoutingModule */

  /***/
  function srcAppModulesStandardcoursesStandardcoursesRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "StandardcoursesRoutingModule", function () {
      return StandardcoursesRoutingModule;
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


    var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/auth/auth.guard */
    "./src/app/auth/auth.guard.ts");
    /* harmony import */


    var _standardcourses_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./standardcourses.component */
    "./src/app/modules/standardcourses/standardcourses.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'home',
        component: _standardcourses_component__WEBPACK_IMPORTED_MODULE_4__["StandardcoursesComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
        data: {
          title: 'Standard & Customized Course Certification'
        }
      }]
    }];

    var StandardcoursesRoutingModule = /*#__PURE__*/_createClass(function StandardcoursesRoutingModule() {
      _classCallCheck(this, StandardcoursesRoutingModule);
    });

    StandardcoursesRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], StandardcoursesRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/standardcourses/standardcourses.component.scss":
  /*!************************************************************************!*\
    !*** ./src/app/modules/standardcourses/standardcourses.component.scss ***!
    \************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesStandardcoursesStandardcoursesComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#standard_customized {\n  margin-bottom: 11%;\n}\n#standard_customized .clearbtn {\n  height: 35px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  margin-top: 10px;\n}\n#standard_customized .addbtn {\n  background: none;\n  border: none;\n  display: flex;\n  align-items: center;\n}\n#standard_customized .projlstngph span {\n  display: block;\n}\n#standard_customized .projlstngph span.tphid {\n  width: 30%;\n  height: 12px;\n  margin-top: 12px;\n}\n#standard_customized .projlstngph span.tphtitle {\n  width: 60%;\n  height: 12px;\n  margin-top: 12px;\n}\n#standard_customized .projlstngph span.tphtype {\n  width: 20%;\n  height: 12px;\n  margin-top: 12px;\n}\n#standard_customized .projlstngph span.tphstatus {\n  width: 100px;\n  height: 12px;\n  margin-top: 12px;\n}\n#standard_customized .projlstngph span.tphcount {\n  width: 40px;\n  height: 12px;\n  margin-top: 12px;\n}\n#standard_customized .projlstngph span.tphdesp {\n  width: 100%;\n  height: 12px;\n  margin-top: 12px;\n}\n#standard_customized .projlstngph .tphmore {\n  position: absolute;\n  top: 10px;\n  right: 10px;\n  color: #999;\n}\n#standard_customized .projlstngph .docrow {\n  display: flex;\n  width: 100%;\n}\n#standard_customized .projlstngph .docrow .docimg {\n  width: 80px;\n  height: 80px;\n  margin-right: 20px;\n}\n#standard_customized .projlstngph .docrow .doccontent {\n  display: flex;\n  flex-direction: column;\n}\n#standard_customized .projlstngph .docrow .doccontent .doctitle {\n  width: 50%;\n  height: 12px;\n}\n#standard_customized .projlstngph .docrow .doccontent .doccol {\n  display: flex;\n  flex-direction: row;\n}\n#standard_customized .projlstngph .docrow .doccontent .doccol .doccoldata {\n  width: 25%;\n  margin-right: 30px;\n  display: flex;\n  flex-direction: column;\n}\n#standard_customized .projlstngph .docrow .doccontent .doccol .doccoldata .docdate {\n  width: 150px;\n  height: 12px;\n}\n#standard_customized .projlstngph hr {\n  width: 100%;\n  border-top: 1px solid #ddd;\n  margin: 20px 0;\n}\n#standard_customized .projlstngph .targetjustify {\n  display: flex;\n  justify-content: space-between;\n  flex-direction: row;\n}\n#standard_customized .projlstngph .targetjustify .pager {\n  width: 25%;\n  height: 32px;\n}\n#standard_customized .projlstngph .targetjustify .search {\n  width: 25%;\n  height: 32px;\n}\n#standard_customized .projlstngph .tablerow {\n  display: flex;\n  justify-content: space-around;\n  flex-direction: row;\n  width: 100%;\n}\n#standard_customized .projlstngph .tablerow .tabletitle {\n  width: 18%;\n  margin-right: 2%;\n  height: 32px;\n}\n#standard_customized .projlstngph .project-lst {\n  border: 1px solid rgba(204, 204, 204, 0.5);\n  border-radius: 4px;\n  background-clip: padding-box;\n  background-color: #fff;\n  min-height: 242px;\n  width: 100%;\n  padding: 0px;\n  margin-top: 20px;\n}\n#standard_customized .projlstngph .project-lst .project-lst-header {\n  min-height: 180px;\n  width: 100%;\n  display: flex;\n  flex-direction: row;\n  padding: 15px;\n  position: relative;\n}\n#standard_customized .projlstngph .project-lst .project-lst-header .projimg {\n  width: 160px;\n  height: 160px;\n  margin-right: 20px;\n}\n#standard_customized .projlstngph .project-lst .project-lst-header .projdet {\n  display: flex;\n  flex-direction: column;\n  width: calc(100% - 160px);\n}\n#standard_customized .projlstngph .project-lst .project-lst-footer {\n  min-height: 60px;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #ebeff5;\n  padding: 8px 0px !important;\n  align-items: center;\n  justify-content: space-between;\n}\n#standard_customized .listsector .viewclear {\n  min-width: 165px;\n  height: 40px;\n}\n#standard_customized .listsector .leftmainspace .subcontent {\n  max-width: 100%;\n  margin-left: auto;\n  margin-right: auto;\n  margin-top: 25px;\n}\n#standard_customized .listsector .leftmainspace .subcontent .widthoffirst, #standard_customized .listsector .leftmainspace .subcontent .descriptitlesector .descriptioncontent, #standard_customized .listsector .leftmainspace .subcontent .sectorheight, #standard_customized .listsector .leftmainspace .subcontent .secondwidth {\n  width: 50%;\n  height: 55px;\n  margin-bottom: 25px;\n}\n#standard_customized .listsector .leftmainspace .subcontent .secondwidth {\n  width: 100% !important;\n}\n#standard_customized .listsector .leftmainspace .subcontent .sectorheight {\n  width: 100% !important;\n  height: 45px !important;\n  margin-bottom: 6px !important;\n}\n#standard_customized .listsector .leftmainspace .subcontent .firstviewcontent p {\n  width: 35%;\n  height: 20px;\n  margin-bottom: 20px;\n}\n#standard_customized .listsector .leftmainspace .subcontent .descriptitlesector p {\n  width: 20%;\n  height: 15px;\n  margin-bottom: 20px;\n}\n#standard_customized .listsector .leftmainspace .subcontent .descriptitlesector .descriptioncontent {\n  width: 100% !important;\n  height: 85px !important;\n}\n#standard_customized .listsector .clearpro, #standard_customized .listsector .addviewload {\n  min-width: 80px;\n  height: 40px;\n}\n#standard_customized .listsector .addviewload {\n  min-width: 95px !important;\n}\n#standard_customized .listsector .alignload {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n#standard_customized .listsector .addviewload .heightofbtn {\n  height: 40px;\n}\n#standard_customized .placeholder-content {\n  height: 320px;\n  background: #000;\n  position: relative;\n  animation-duration: 1.7s;\n  animation-fill-mode: forwards;\n  animation-iteration-count: infinite;\n  animation-timing-function: linear;\n  animation-name: placeholderAnimate;\n  background: #f6f7f8;\n  background: linear-gradient(to right, #eee 2%, #ddd 18%, #eee 33%);\n  background-size: 1300px;\n}\n#standard_customized .placeholder-content_item {\n  width: 100%;\n  height: 20px;\n  position: absolute;\n  z-index: 2;\n}\n#standard_customized .placeholder-content_item:after,\n#standard_customized .placeholder-content_item:before {\n  width: inherit;\n  height: inherit;\n  content: \"\";\n  position: absolute;\n}\n@keyframes placeholderAnimate {\n  0% {\n    background-position: -650px 0;\n  }\n  100% {\n    background-position: 650px 0;\n  }\n}\n#standard_customized .pagetitle {\n  background: #000;\n  position: relative;\n  animation-duration: 1.7s;\n  animation-fill-mode: forwards;\n  animation-iteration-count: infinite;\n  animation-timing-function: linear;\n  animation-name: pagetitleAnimate;\n  background: #f6f7f8;\n  background: linear-gradient(to right, #eee 2%, #ddd 18%, #eee 33%);\n  background-size: 1300px;\n}\n#standard_customized .pagetitle:before {\n  width: inherit;\n  height: inherit;\n  content: \"\";\n  position: absolute;\n}\n@keyframes pagetitleAnimate {\n  0% {\n    background-position: -650px 0;\n  }\n  100% {\n    background-position: 650px 0;\n  }\n}\n#standard_customized .errors {\n  color: #dc4c64;\n}\n#standard_customized .mat-checkbox-disabled {\n  opacity: 0.5;\n  cursor: no-drop;\n  background-color: #f8f8f8;\n}\n#standard_customized #standard_course .approved {\n  color: #00a551;\n}\n#standard_customized #standard_course .update {\n  color: #0c4b9a;\n}\n#standard_customized #standard_course .declined {\n  color: #ed1c27;\n}\n#standard_customized #standard_course .new {\n  color: #f4811f;\n}\n#standard_customized #standard_course .requiredfiels h4 {\n  color: #262626;\n}\n#standard_customized #standard_course .requiredfiels .yesno {\n  display: flex;\n  align-items: center;\n}\n#standard_customized #standard_course .requiredfiels .yesno p {\n  color: #848484;\n}\n#standard_customized #standard_course .requiredfiels .yesno p span {\n  color: #dc4c64;\n}\n#standard_customized #standard_course .yesno {\n  display: flex;\n  align-items: center;\n}\n#standard_customized #standard_course .yesno p {\n  color: #848484;\n}\n#standard_customized #standard_course .yesno p span {\n  color: #dc4c64;\n}\n#standard_customized #standard_course .readonlyfield .mat-form-field-outline {\n  background-color: #f8f8f8 !important;\n  cursor: no-drop !important;\n}\n#standard_customized #standard_course .readonlyfield input[readonly] {\n  cursor: no-drop !important;\n}\n#standard_customized #standard_course .txt-gry {\n  color: #848484;\n}\n#standard_customized #standard_course .txt-gry3 {\n  color: #262626 !important;\n}\n#standard_customized #standard_course #profile .hint {\n  width: 168px;\n  word-break: break-word;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field {\n  width: 162px !important;\n  height: 162px !important;\n}\n#standard_customized #standard_course #profile #uploaded .filers input.mat-input-element {\n  margin-top: 0rem !important;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #999999;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-flex {\n  padding: 0px !important;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 0 2px !important;\n  border-top: 0.4em solid transparent !important;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border: 1px solid currentcolor !important;\n  border-radius: 1px !important;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border: 1px solid currentcolor !important;\n  border-radius: 1px !important;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n#standard_customized #standard_course #profile #uploaded .filers mat-label {\n  color: #999999;\n}\n#standard_customized #standard_course #profile #uploaded .filers mat-label span {\n  color: #ED1C27;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field label {\n  text-align: center;\n  margin-top: 1px;\n}\n#standard_customized #standard_course #profile #uploaded .filers input.mat-input-element {\n  background-color: #fff;\n  text-align: center;\n  height: 162px !important;\n  width: 162px !important;\n  margin-bottom: 2px !important;\n}\n#standard_customized #standard_course #profile #uploaded .filers .mat-form-field-suffix {\n  top: -0.75em;\n}\n#standard_customized #standard_course #profile #uploaded .document mat-label {\n  color: #999999;\n}\n#standard_customized #standard_course #profile #uploaded .document img {\n  width: 20px;\n}\n#standard_customized #standard_course #profile #uploaded .document mat-icon {\n  color: #999999;\n}\n#standard_customized #standard_course #profile #uploaded .document .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n#standard_customized #standard_course #profile #uploaded .document .mat-form-field-outline-start {\n  border: none !important;\n  border-radius: 1px !important;\n}\n#standard_customized #standard_course #profile #uploaded .document .mat-form-field-outline-end {\n  border: none !important;\n  border-radius: 1px !important;\n}\n#standard_customized #standard_course .mat-radio-button .mat-radio-outer-circle {\n  border-color: #d9d9d9;\n}\n#standard_customized #standard_course .mat-radio-button.mat-accent .mat-radio-inner-circle {\n  background-color: #e20613 !important;\n}\n#standard_customized #standard_course .mat-radio-button.mat-accent.mat-radio-checked .mat-radio-outer-circle {\n  border-color: #d9d9d9;\n}\n#standard_customized #standard_course .mat-radio-label-content {\n  color: #000000cc;\n  font-size: 16px;\n}\n#standard_customized #standard_course .mat-cell {\n  color: #262626;\n}\n#standard_customized #standard_course .mat-cell .document_img {\n  width: 32px;\n}\n#standard_customized #standard_course .mat-cell .viewdocument {\n  cursor: pointer;\n}\n#standard_customized #standard_course .daterangetime .md-drppicker {\n  width: 650px;\n  right: 0 !important;\n  margin-top: 20px;\n}\n#standard_customized #standard_course .closeanddateicon {\n  display: flex !important;\n  align-items: center !important;\n}\n#standard_customized #standard_course .mat-raised-button {\n  border-radius: 2px;\n  box-shadow: none;\n  font-size: 16px;\n}\n#standard_customized #standard_course .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 110px;\n  height: 45px;\n}\n#standard_customized #standard_course .setup_btn {\n  background-color: #848484 !important;\n  color: #fff !important;\n  min-width: 110px;\n  height: 45px;\n}\n#standard_customized #standard_course .cancelbtn {\n  min-width: 110px;\n  background-color: #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n}\n#standard_customized #standard_course .mat-ink-bar {\n  width: 0px !important;\n}\n#standard_customized #standard_course .mat-tab-header {\n  border: 0px;\n}\n#standard_customized #standard_course .mat-tab-label-active {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n#standard_customized #standard_course .mat-tab-label-active .contentcircle {\n  color: #fff !important;\n  border: 1px solid #fff !important;\n}\n#standard_customized #standard_course .mat-tab-label-active p {\n  color: #fff !important;\n}\n#standard_customized #standard_course .file_upload #uploaded {\n  display: flex;\n}\n@media (max-width: 1279px) {\n  #standard_customized #standard_course .file_upload #uploaded {\n    display: block;\n  }\n}\n#standard_customized #standard_course .file_upload #uploaded .filers {\n  width: 50%;\n}\n@media (max-width: 1279px) {\n  #standard_customized #standard_course .file_upload #uploaded .filers {\n    width: 100%;\n  }\n}\n#standard_customized #standard_course .file_upload #uploaded .document {\n  width: 50%;\n  padding-left: 30px;\n}\n#standard_customized #standard_course .file_upload #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  display: none;\n}\n#standard_customized #standard_course .file_upload #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  display: none;\n}\n#standard_customized #standard_course .file_upload #uploaded .document .mat-form-field-appearance-outline .mat-form-field-suffix {\n  left: -239px;\n}\n@media (max-width: 1279px) {\n  #standard_customized #standard_course .file_upload #uploaded .document {\n    width: 100%;\n    padding-left: 0px;\n  }\n}\n#standard_customized #standard_course .file_upload #uploaded .document .close_icons {\n  display: block;\n}\n#standard_customized #standard_course .file_upload #uploaded .document .delete_icon {\n  display: none;\n}\n#standard_customized #standard_course .file_upload #uploaded .document .view_btn {\n  display: block;\n  color: #848484;\n}\n#standard_customized #standard_course .workcheckbox {\n  display: flex;\n  align-items: center;\n}\n#standard_customized #standard_course .workcheckbox .mat-checkbox-inner-container {\n  width: 20px;\n  height: 20px;\n}\n#standard_customized #standard_course .workcheckbox .mat-checkbox-checked.mat-accent .mat-checkbox-background {\n  background-color: #0c4b9a !important;\n}\n#standard_customized #standard_course .workcheckbox .mat-checkbox-frame {\n  border: 1px solid #c4c4c4;\n}\n#standard_customized #standard_course .mat-slide-toggle.mat-checked .mat-slide-toggle-thumb {\n  background-color: #00a551;\n}\n#standard_customized #standard_course .mat-slide-toggle.mat-checked .mat-slide-toggle-bar {\n  background-color: #00a55062;\n}\n#standard_customized #standard_course .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 5px;\n  height: 80px;\n  justify-content: flex-start;\n  padding: 0 10px;\n  min-width: 125px;\n}\n#standard_customized #standard_course .mat-tab-label:nth-child(2) {\n  width: 250px;\n}\n#standard_customized #standard_course .mat-tab-list {\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n}\n#standard_customized #standard_course .mat-raised-button[disabled]:not([class*=mat-elevation-z]) {\n  cursor: no-drop;\n  opacity: 0.5;\n}\n#standard_customized #standard_course .mat-card {\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  position: relative;\n}\n#standard_customized #standard_course .mat-card .mat-card-content img {\n  width: 100px;\n  height: 100px;\n}\n#standard_customized #standard_course .mat-card .mat-card-content .cardinfo h4 {\n  color: #262626;\n}\n#standard_customized #standard_course .mat-card .mat-card-content .cardinfo .centre_info {\n  gap: 30px;\n}\n#standard_customized #standard_course .mat-card .mat-card-content .cardinfo .centre_info p {\n  color: #848484;\n}\n#standard_customized #standard_course .mat-card .mat-card-content .cardinfo .centre_info p span {\n  color: #262626;\n}\n#standard_customized #standard_course .mat-card .cardbtn {\n  position: absolute;\n  margin-top: -34px;\n  width: 93%;\n  border-radius: 20px;\n  display: flex;\n  align-items: baseline;\n  justify-content: end;\n}\n#standard_customized #standard_course .mat-card .cardbtn button {\n  border-radius: 20px;\n}\n#standard_customized #standard_course .tabscontent {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#standard_customized #standard_course .tabscontent .contentcircle {\n  width: 28px;\n  height: 28px;\n  min-width: 28px;\n  border-radius: 50%;\n  display: flex;\n  justify-content: center !important;\n  align-items: center !important;\n  background-clip: padding-box;\n  background-color: transparent;\n  color: #848484;\n  box-shadow: 0 0 8px rgba(51, 51, 51, 0.15);\n  border: 1px solid #848484;\n}\n#standard_customized #standard_course .tabscontent .tabtitle p {\n  color: #262626;\n  text-align: left;\n  white-space: normal;\n}\n#standard_customized #standard_course .subtitleform {\n  font-weight: 700;\n}\n#standard_customized #standard_course .title h4 {\n  color: #0c4b9a;\n}\n#standard_customized #standard_course .title .subtitle h4 {\n  color: #262626;\n}\n#standard_customized #standard_course .title .line {\n  flex: 4;\n}\n#standard_customized #standard_course .title .line .mat-divider {\n  width: 12%;\n  border-top-width: 3px;\n  border-color: #ED1C27;\n}\n#standard_customized #standard_course .mat-input-element {\n  color: #262626;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#standard_customized #standard_course .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#standard_customized #standard_course .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#standard_customized #standard_course .date_exp .mat-form-field-appearance-outline .mat-form-field-suffix {\n  display: flex;\n  align-items: center;\n}\n#standard_customized #standard_course .readonly input[readonly] {\n  cursor: no-drop;\n}\n#standard_customized #standard_course .mat-form-field.mat-focused.mat-primary .mat-select-arrow {\n  color: transparent !important;\n}\n#standard_customized #standard_course .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n#standard_customized #standard_course .filter {\n  height: 45px;\n}\n#standard_customized #standard_course .userimg {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#standard_customized #standard_course .userimg img {\n  width: 168px;\n  height: 168px;\n}\n#standard_customized #standard_course .userimg img:hover {\n  transform: scale(1.1);\n}\n#standard_customized #standard_course .userimg span {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  width: 32px;\n  height: 32px;\n  border-radius: 20px;\n  background-color: #c4c4c4;\n  position: relative;\n  top: 33px;\n  left: -44px;\n  opacity: 0.5;\n}\n#standard_customized #standard_course .userimg span:hover {\n  background-color: #ed1c2770;\n  transform: scale(1.1);\n}\n#standard_customized #standard_course .userimg span:hover .mat-icon {\n  color: #ED1C27;\n}\n#standard_customized #standard_course .mat-icon {\n  cursor: pointer;\n}\n#standard_customized #standard_course .mat-form-field-suffix .mat-icon {\n  color: #848484;\n  cursor: pointer;\n}\n#standard_customized #standard_course .icongroup .mat-icon {\n  background-color: #fff;\n  color: #848484;\n  padding: 10px;\n  border: 1px solid #d9d9d9;\n  border-radius: 3px;\n  width: 40px;\n  height: 40px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  font-size: 25px;\n}\n#standard_customized #standard_course .icongroup .mat-icon.add {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n#standard_customized #standard_course .add_icon {\n  color: #fff;\n  background-color: #0c4b9a;\n  padding: 15px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  font-size: 25px;\n}\n#standard_customized #standard_course .arabiclanguage input,\n#standard_customized #standard_course .arabiclanguage .mat-form-field-label {\n  text-align: right;\n}\n#standard_customized #standard_course .arabiclanguage .mat-form-field-label {\n  text-align: right;\n}\n#standard_customized #standard_course .arabiclanguage .mat-error {\n  text-align: right;\n}\n#standard_customized #standard_course .editbtn {\n  background-color: transparent;\n  cursor: pointer;\n  padding: 4px;\n}\n#standard_customized #standard_course .editbtn:hover {\n  background-color: #ED1C27;\n  color: #fff;\n  border-radius: 2px;\n}\n#standard_customized #standard_course .courebox {\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  padding: 5px 10px;\n  margin: 2px;\n}\n#standard_customized #standard_course .subtitleform {\n  display: flex;\n}\n#standard_customized #standard_course .subtitleform .mat-icon {\n  color: #848484;\n}\n#standard_customized #standard_course .icongroup .fa {\n  color: #848484;\n  border: 1px solid #848484;\n  -webkit-text-stroke-width: 0px !important;\n  -webkit-text-stroke-color: #848484 !important;\n}\n#standard_customized #standard_course .icongroup .mat-icon {\n  background-color: #fff;\n  border: 1px solid #d9d9d9;\n  width: 40px;\n  height: 40px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  font-size: 30px;\n}\n#standard_customized #standard_course #documents #uploaded,\n#standard_customized #standard_course .documents #uploaded {\n  display: flex;\n}\n@media (max-width: 959px) {\n  #standard_customized #standard_course #documents #uploaded,\n#standard_customized #standard_course .documents #uploaded {\n    display: block;\n  }\n}\n#standard_customized #standard_course #documents #uploaded .filers,\n#standard_customized #standard_course .documents #uploaded .filers {\n  width: 50%;\n}\n@media (max-width: 959px) {\n  #standard_customized #standard_course #documents #uploaded .filers,\n#standard_customized #standard_course .documents #uploaded .filers {\n    width: 100%;\n  }\n}\n#standard_customized #standard_course #documents #uploaded .document,\n#standard_customized #standard_course .documents #uploaded .document {\n  width: 50%;\n  padding-left: 30px;\n}\n#standard_customized #standard_course #documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-start,\n#standard_customized #standard_course .documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  display: none;\n}\n#standard_customized #standard_course #documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-end,\n#standard_customized #standard_course .documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  display: none;\n}\n#standard_customized #standard_course #documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-suffix,\n#standard_customized #standard_course .documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-suffix {\n  left: -239px;\n}\n@media (max-width: 959px) {\n  #standard_customized #standard_course #documents #uploaded .document,\n#standard_customized #standard_course .documents #uploaded .document {\n    width: 100%;\n    padding-left: 0px;\n  }\n}\n#standard_customized #standard_course #documents #uploaded .document .close_icons,\n#standard_customized #standard_course .documents #uploaded .document .close_icons {\n  display: block;\n}\n#standard_customized #standard_course #documents #uploaded .document .delete_icon,\n#standard_customized #standard_course .documents #uploaded .document .delete_icon {\n  display: none;\n}\n#standard_customized #standard_course #documents #uploaded .document .view_btn,\n#standard_customized #standard_course .documents #uploaded .document .view_btn {\n  display: block;\n  color: #848484;\n}\n#standard_customized #standard_course .masterPageTop {\n  display: flex;\n}\n#standard_customized #standard_course .availabledate {\n  padding: 15px;\n}\n#standard_customized #standard_course .availabletable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#standard_customized #standard_course .availabletable .mat-cell {\n  color: #262626;\n}\n#standard_customized #standard_course .availabletable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#standard_customized #standard_course .availabletable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#standard_customized #standard_course .availabletable #searchrow,\n#standard_customized #standard_course .availabletable #filtershow {\n  background: #fbfbfb !important;\n  border: none;\n}\n#standard_customized #standard_course .availabletable .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#standard_customized #standard_course .availabletable .serachrow .mat-form-field-outline {\n  background-color: #fff !important;\n}\n#standard_customized #standard_course .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#standard_customized #standard_course .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#standard_customized #standard_course .awaredtable .mat-row {\n  width: -moz-fit-content;\n  width: fit-content;\n}\n#standard_customized #standard_course .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#standard_customized #standard_course .awaredtable .mat-cell {\n  color: #262626;\n}\n#standard_customized #standard_course .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#standard_customized #standard_course .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#standard_customized #standard_course .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#standard_customized #standard_course .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#standard_customized #standard_course .renewal {\n  display: flex;\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  padding: 15px;\n  justify-content: space-between;\n  align-items: center;\n}\n#standard_customized #standard_course .renewal .renewal_info {\n  gap: 30px;\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#standard_customized #standard_course .renewal .renewal_info .mat-divider {\n  height: 51px;\n}\n#standard_customized #standard_course .renewal .renewal_info .mat-divider .mat-divider-vertical {\n  border-right-color: #c4c4c4;\n  border-right-width: 2px !important;\n}\n#standard_customized #standard_course .renewal .renewal_info p {\n  color: #848484;\n}\n#standard_customized #standard_course .renewal .renewal_info p span {\n  color: #262626;\n}\n#standard_customized #standard_course .renewal .renewal_info .remainder {\n  border: 1px solid #ED1C27;\n  border-radius: 2px;\n  padding: 8px;\n}\n#standard_customized #standard_course .renewal .renewal_info .remainder p {\n  color: #ED1C27;\n}\n#standard_customized #standard_course .renewal .renewal_info .remainder p span {\n  color: #ED1C27;\n}\n#standard_customized #standard_course .renewal .viewbtn {\n  background-color: #0c4b9a;\n  color: #fff;\n}\n#standard_customized #standard_course .success .centercontent {\n  height: 71vh;\n}\n#standard_customized #standard_course .success .success_icon {\n  width: 72px;\n  height: 72px;\n  border-radius: 50px;\n  background-color: #fff;\n  border: 3px solid #00a551;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n#standard_customized #standard_course .success .success_icon .mat-icon {\n  font-size: 50px;\n  color: #00a551;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#standard_customized #standard_course .success .succes_msg h4 {\n  color: #00a551;\n}\n#standard_customized #standard_course .success .succes_msg p {\n  color: #262626;\n}\n#standard_customized #standard_course .success .succes_msg .viewform {\n  background-color: #ED1C27;\n  color: #fff;\n}\n#standard_customized #standard_course .secondtab .mat-form-field .mat-select.mat-select-disabled .mat-select-arrow::before {\n  color: transparent !important;\n}\n#standard_customized #standard_course .decline {\n  border: 1px solid #ED1C27;\n  border-radius: 3px;\n  padding: 15px;\n  background-color: #fff8f8;\n}\n#standard_customized #standard_course .decline h4 {\n  color: #ED1C27;\n}\n#standard_customized #standard_course .decline p {\n  color: #262626;\n}\n#standard_customized #standard_course .card {\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  padding: 15px;\n}\n#standard_customized #standard_course .carder {\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n}\n#standard_customized #standard_course .carder .rangedate {\n  padding: 15px;\n}\n#standard_customized #standard_course .filter .fa {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #fff;\n}\n#standard_customized #standard_course #regapp .closeanddateicomax {\n  top: 14px !important;\n}\n#standard_customized #standard_course #searchrow,\n#standard_customized #standard_course #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#standard_customized #standard_course #searchrow .serachrow,\n#standard_customized #standard_course #filtershow .serachrow {\n  background: #f8f8f8 !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#standard_customized #standard_course #searchrow .serachrow .mat-form-field-outline,\n#standard_customized #standard_course #filtershow .serachrow .mat-form-field-outline {\n  background-color: #fff !important;\n}\n#standard_customized #standard_course .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n  padding: 0px !important;\n}\n@media (max-width: 768px) {\n  #standard_customized #standard_course .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n    display: block !important;\n  }\n}\n#standard_customized #standard_course .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#standard_customized #standard_course .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n@media (max-width: 768px) {\n  #standard_customized #standard_course .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n#standard_customized #standard_course .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#standard_customized #standard_course .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#standard_customized #standard_course .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#standard_customized #standard_course .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#standard_customized #standard_course .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#standard_customized #standard_course .tabforclientelenew .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#standard_customized #standard_course .tabforclientelenew .manageoptions .mat-icon {\n  color: #acacac;\n}\n#standard_customized #standard_course .hrstag {\n  padding: 5px 10px;\n  border: 1px solid #ddd;\n  border-radius: 6px;\n  margin-left: 15px;\n  min-width: 82px;\n}\n#standard_customized #standard_course .master-menu .mat-menu-content {\n  background-color: #000;\n  color: #fff;\n}\n#standard_customized #standard_course .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#standard_customized #standard_course .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: #d9d9d9 !important;\n}\n#standard_customized #standard_course .mat-sort-header-arrow {\n  color: #ED1C27;\n}\n#standard_customized #standard_course .nofound {\n  margin-top: 5%;\n}\n#standard_customized #standard_course .rangedate {\n  background-color: #fbfbfb;\n}\n#standard_customized #standard_course .timepickerwidth {\n  max-width: 85px;\n}\n#standard_customized #standard_course .timepickerwidth .mat-icon {\n  font-size: 20px;\n  color: #848484;\n}\n#standard_customized .borderslot {\n  border-left: 1px solid #ddd;\n  align-items: center !important;\n  place-content: center center !important;\n}\n#standard_customized .w-150 {\n  width: 150px;\n}\n#standard_customized .usrfrm {\n  display: flex;\n  flex-direction: column !important;\n}\n.mat-button-focus-overlay {\n  display: none !important;\n}\n.option-listing div {\n  margin: 0 !important;\n}\n.searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 6px 10px;\n  background: #e9edf0;\n}\n.searchinmultiselect input::-webkit-input-placeholder {\n  color: #7f8fa3 !important;\n}\n.searchinmultiselect i {\n  color: #7f8fa3 !important;\n  padding-right: 6px;\n}\n.searchinmultiselect .searchselect {\n  width: calc(100% - 25px) !important;\n}\n.searchinmultiselect .reseticon {\n  cursor: pointer;\n}\n.select_with_search {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 50px !important;\n  margin-bottom: 15px !important;\n}\n.select_with_option {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 49px !important;\n  margin-bottom: 15px !important;\n}\n.select_with_option.multiple {\n  margin-top: 48px !important;\n  margin-left: 25px;\n  min-width: calc(100% + 28px) !important;\n}\n.searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 10px 10px;\n  background: #e9edf0;\n  margin: 10px;\n}\n.searchselect {\n  width: calc(100% - 25px) !important;\n  padding-left: 10px;\n}\n.mat-option.mat-active {\n  background: #fff;\n  color: rgba(0, 0, 0, 0.87);\n}\n.option-listing {\n  overflow-x: auto;\n  overflow-y: auto;\n  max-height: 290px;\n}\n.option-listing::-webkit-scrollbar {\n  width: 7px;\n}\n/* Track */\n.option-listing::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n/* Handle */\n.option-listing::-webkit-scrollbar-thumb {\n  background: #ED1C27;\n}\n/* hover */\n.option-listing::-webkit-scrollbar-thumb:hover {\n  background: #ED1C27;\n}\n.myPanelClass {\n  margin: 36px 0px;\n}\n.mat-menu-panel.table_menu {\n  background-color: #666666 !important;\n}\n.mat-menu-panel.table_menu .mat-menu-item {\n  line-height: 36px;\n  height: 31px;\n  color: #fff;\n}\n.mat-select-disabled .mat-select-value {\n  cursor: no-drop;\n  color: #262626 !important;\n}\n.mat-menu-panel.menu-panel {\n  margin-top: 7px;\n  min-width: 230px;\n}\n.mat-menu-panel.menu-panel .mat-menu-item:hover {\n  color: #ED1C27;\n}\n.mat-dialog-container {\n  padding: 24px !important;\n}\n@media (max-width: 1366px) {\n  #regapp .md-drppicker.double {\n    left: 0 !important;\n  }\n}\n.select_with_search.multiple {\n  margin-top: 55px !important;\n  margin-left: 25px;\n  min-width: calc(100% + 27px) !important;\n}\n.whentootltipadded {\n  background-color: #666666 !important;\n  color: #fff;\n  min-height: 45px !important;\n}\n.whentootltipadded .mat-menu-item {\n  color: #fff !important;\n  height: 30px !important;\n  line-height: 20px !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9zdGFuZGFyZGNvdXJzZXMvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcc3RhbmRhcmRjb3Vyc2VzXFxzdGFuZGFyZGNvdXJzZXMuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvc3RhbmRhcmRjb3Vyc2VzL3N0YW5kYXJkY291cnNlcy5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtFQXdVSSxrQkFBQTtBQ3RVSjtBREFJO0VBQ0ksWUFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsZ0JBQUE7QUNFUjtBREFJO0VBQ0ksZ0JBQUE7RUFDQSxZQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0FDRVI7QURDUTtFQUNJLGNBQUE7QUNDWjtBRENZO0VBQ0ksVUFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ0NoQjtBREVZO0VBQ0ksVUFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ0FoQjtBREdZO0VBQ0ksVUFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ0RoQjtBRElZO0VBQ0ksWUFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ0ZoQjtBREtZO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ0hoQjtBRE1ZO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ0poQjtBRFFRO0VBQ0ksa0JBQUE7RUFDQSxTQUFBO0VBQ0EsV0FBQTtFQUNBLFdBQUE7QUNOWjtBRFNRO0VBQ0ksYUFBQTtFQUNBLFdBQUE7QUNQWjtBRFNZO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxrQkFBQTtBQ1BoQjtBRFVZO0VBQ0ksYUFBQTtFQUNBLHNCQUFBO0FDUmhCO0FEVWdCO0VBQ0ksVUFBQTtFQUNBLFlBQUE7QUNScEI7QURXZ0I7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7QUNUcEI7QURXb0I7RUFDSSxVQUFBO0VBQ0Esa0JBQUE7RUFDQSxhQUFBO0VBQ0Esc0JBQUE7QUNUeEI7QURXd0I7RUFDSSxZQUFBO0VBQ0EsWUFBQTtBQ1Q1QjtBRGlCUTtFQUNJLFdBQUE7RUFDQSwwQkFBQTtFQUNBLGNBQUE7QUNmWjtBRGtCUTtFQUNJLGFBQUE7RUFDQSw4QkFBQTtFQUNBLG1CQUFBO0FDaEJaO0FEa0JZO0VBQ0ksVUFBQTtFQUNBLFlBQUE7QUNoQmhCO0FEbUJZO0VBQ0ksVUFBQTtFQUNBLFlBQUE7QUNqQmhCO0FEcUJRO0VBQ0ksYUFBQTtFQUNBLDZCQUFBO0VBQ0EsbUJBQUE7RUFDQSxXQUFBO0FDbkJaO0FEcUJZO0VBQ0ksVUFBQTtFQUNBLGdCQUFBO0VBQ0EsWUFBQTtBQ25CaEI7QUR1QlE7RUFDSSwwQ0FBQTtFQUNBLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSxzQkFBQTtFQUNBLGlCQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ3JCWjtBRHVCWTtFQUNJLGlCQUFBO0VBQ0EsV0FBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLGFBQUE7RUFDQSxrQkFBQTtBQ3JCaEI7QUR1QmdCO0VBQ0ksWUFBQTtFQUNBLGFBQUE7RUFDQSxrQkFBQTtBQ3JCcEI7QUR3QmdCO0VBQ0ksYUFBQTtFQUNBLHNCQUFBO0VBQ0EseUJBQUE7QUN0QnBCO0FEMEJZO0VBQ0ksZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0VBQ0EsOEJBQUE7QUN4QmhCO0FEOEJRO0VBQ0ksZ0JBQUE7RUFDQSxZQUFBO0FDNUJaO0FEZ0NZO0VBQ0ksZUFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxnQkFBQTtBQzlCaEI7QURnQ2dCO0VBQ0ksVUFBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtBQzlCcEI7QURpQ2dCO0VBRUksc0JBQUE7QUNoQ3BCO0FEbUNnQjtFQUVJLHNCQUFBO0VBQ0EsdUJBQUE7RUFDQSw2QkFBQTtBQ2xDcEI7QURzQ29CO0VBQ0ksVUFBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtBQ3BDeEI7QUR5Q29CO0VBQ0ksVUFBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtBQ3ZDeEI7QUQwQ29CO0VBRUksc0JBQUE7RUFDQSx1QkFBQTtBQ3pDeEI7QUQrQ1E7RUFDSSxlQUFBO0VBQ0EsWUFBQTtBQzdDWjtBRGdEUTtFQUVJLDBCQUFBO0FDL0NaO0FEa0RRO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0VBQ0EseUJBQUE7QUNoRFo7QURtRFE7RUFDSSxZQUFBO0FDakRaO0FEc0RJO0VBQ0ksYUFBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFFQSx3QkFBQTtFQUNBLDZCQUFBO0VBQ0EsbUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGtDQUFBO0VBQ0EsbUJBQUE7RUFDQSxrRUFBQTtFQUNBLHVCQUFBO0FDckRSO0FEd0RJO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxrQkFBQTtFQUNBLFVBQUE7QUN0RFI7QUR5REk7O0VBRUksY0FBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0VBQ0Esa0JBQUE7QUN2RFI7QUQwREk7RUFDSTtJQUNJLDZCQUFBO0VDeERWO0VEMkRNO0lBQ0ksNEJBQUE7RUN6RFY7QUFDRjtBRDRESTtFQUNJLGdCQUFBO0VBQ0Esa0JBQUE7RUFFQSx3QkFBQTtFQUNBLDZCQUFBO0VBQ0EsbUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsbUJBQUE7RUFDQSxrRUFBQTtFQUNBLHVCQUFBO0FDM0RSO0FEOERJO0VBQ0ksY0FBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0VBQ0Esa0JBQUE7QUM1RFI7QUQrREk7RUFDSTtJQUNJLDZCQUFBO0VDN0RWO0VEZ0VNO0lBQ0ksNEJBQUE7RUM5RFY7QUFDRjtBRG1FSTtFQUNJLGNBQUE7QUNqRVI7QURvRUk7RUFDSSxZQUFBO0VBQ0EsZUFBQTtFQUNBLHlCQUFBO0FDbEVSO0FEc0VRO0VBQ0ksY0FBQTtBQ3BFWjtBRHVFUTtFQUNJLGNBQUE7QUNyRVo7QUR3RVE7RUFDSSxjQUFBO0FDdEVaO0FEeUVRO0VBQ0ksY0FBQTtBQ3ZFWjtBRDJFWTtFQUNJLGNBQUE7QUN6RWhCO0FENEVZO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDMUVoQjtBRDRFZ0I7RUFDSSxjQUFBO0FDMUVwQjtBRDRFb0I7RUFDSSxjQUFBO0FDMUV4QjtBRGlGUTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQy9FWjtBRGlGWTtFQUNJLGNBQUE7QUMvRWhCO0FEaUZnQjtFQUNJLGNBQUE7QUMvRXBCO0FEdUZZO0VBQ0ksb0NBQUE7RUFDQSwwQkFBQTtBQ3JGaEI7QUR3Rlk7RUFDSSwwQkFBQTtBQ3RGaEI7QUQyRlE7RUFDSSxjQUFBO0FDekZaO0FENEZRO0VBQ0kseUJBQUE7QUMxRlo7QUQrRlk7RUFDSSxZQUFBO0VBQ0Esc0JBQUE7QUM3RmhCO0FEa0dvQjtFQUNJLHVCQUFBO0VBQ0Esd0JBQUE7QUNoR3hCO0FEbUdvQjtFQUNJLDJCQUFBO0FDakd4QjtBRHFHd0I7RUFDSSxjQUFBO0FDbkc1QjtBRHNHd0I7RUFDSSx1QkFBQTtBQ3BHNUI7QUR1R3dCO0VBQ0kseUJBQUE7RUFDQSw4Q0FBQTtBQ3JHNUI7QUR3R3dCO0VBQ0kseUNBQUE7RUFDQSw2QkFBQTtBQ3RHNUI7QUR5R3dCO0VBQ0kseUNBQUE7RUFDQSw2QkFBQTtBQ3ZHNUI7QUQwR3dCO0VBQ0ksbUJBQUE7QUN4RzVCO0FENEdvQjtFQUNJLGNBQUE7QUMxR3hCO0FENEd3QjtFQUNJLGNBQUE7QUMxRzVCO0FEOEdvQjtFQUNJLGtCQUFBO0VBQ0EsZUFBQTtBQzVHeEI7QURnSHdCO0VBQ0ksc0JBQUE7RUFDQSxrQkFBQTtFQUNBLHdCQUFBO0VBQ0EsdUJBQUE7RUFDQSw2QkFBQTtBQzlHNUI7QURrSG9CO0VBQ0ksWUFBQTtBQ2hIeEI7QURxSG9CO0VBQ0ksY0FBQTtBQ25IeEI7QURzSG9CO0VBQ0ksV0FBQTtBQ3BIeEI7QUR1SG9CO0VBQ0ksY0FBQTtBQ3JIeEI7QUR3SG9CO0VBQ0ksbUJBQUE7QUN0SHhCO0FEeUhvQjtFQUNJLHVCQUFBO0VBQ0EsNkJBQUE7QUN2SHhCO0FEMEhvQjtFQUNJLHVCQUFBO0VBQ0EsNkJBQUE7QUN4SHhCO0FEZ0lZO0VBQ0kscUJBQUE7QUM5SGhCO0FEbUlnQjtFQUNJLG9DQUFBO0FDaklwQjtBRHFJb0I7RUFDSSxxQkFBQTtBQ25JeEI7QUQwSVE7RUFDSSxnQkFBQTtFQUNBLGVBQUE7QUN4SVo7QUQySVE7RUFDSSxjQUFBO0FDeklaO0FEMklZO0VBQ0ksV0FBQTtBQ3pJaEI7QUQ0SVk7RUFDSSxlQUFBO0FDMUloQjtBRCtJWTtFQUVJLFlBQUE7RUFDQSxtQkFBQTtFQUNBLGdCQUFBO0FDOUloQjtBRGtKUTtFQUNJLHdCQUFBO0VBQ0EsOEJBQUE7QUNoSlo7QURtSlE7RUFDSSxrQkFBQTtFQUNBLGdCQUFBO0VBQ0EsZUFBQTtBQ2pKWjtBRG9KUTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7QUNsSlo7QURxSlE7RUFDSSxvQ0FBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxZQUFBO0FDbkpaO0FEc0pRO0VBQ0ksZ0JBQUE7RUFDQSx5QkFBQTtFQUNBLGNBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtBQ3BKWjtBRHVKUTtFQUNJLHFCQUFBO0FDckpaO0FEd0pRO0VBQ0ksV0FBQTtBQ3RKWjtBRHlKUTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUN2Slo7QUR5Slk7RUFDSSxzQkFBQTtFQUNBLGlDQUFBO0FDdkpoQjtBRDBKWTtFQUNJLHNCQUFBO0FDeEpoQjtBRDZKWTtFQUNJLGFBQUE7QUMzSmhCO0FENkpnQjtFQUhKO0lBSVEsY0FBQTtFQzFKbEI7QUFDRjtBRDRKZ0I7RUFDSSxVQUFBO0FDMUpwQjtBRDRKb0I7RUFISjtJQUlRLFdBQUE7RUN6SnRCO0FBQ0Y7QUQ0SmdCO0VBQ0ksVUFBQTtFQUNBLGtCQUFBO0FDMUpwQjtBRDZKd0I7RUFDSSxhQUFBO0FDM0o1QjtBRDhKd0I7RUFDSSxhQUFBO0FDNUo1QjtBRCtKd0I7RUFDSSxZQUFBO0FDN0o1QjtBRGlLb0I7RUFsQko7SUFtQlEsV0FBQTtJQUNBLGlCQUFBO0VDOUp0QjtBQUNGO0FEZ0tvQjtFQUNJLGNBQUE7QUM5SnhCO0FEaUtvQjtFQUNJLGFBQUE7QUMvSnhCO0FEa0tvQjtFQUNJLGNBQUE7RUFDQSxjQUFBO0FDaEt4QjtBRHNLUTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ3BLWjtBRHNLWTtFQUNJLFdBQUE7RUFDQSxZQUFBO0FDcEtoQjtBRHlLb0I7RUFDSSxvQ0FBQTtBQ3ZLeEI7QUQ0S1k7RUFDSSx5QkFBQTtBQzFLaEI7QURnTGdCO0VBQ0kseUJBQUE7QUM5S3BCO0FEaUxnQjtFQUNJLDJCQUFBO0FDL0twQjtBRG9MUTtFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxpQkFBQTtFQUNBLFlBQUE7RUFDQSwyQkFBQTtFQUNBLGVBQUE7RUFDQSxnQkFBQTtBQ2xMWjtBRG1MWTtFQUNJLFlBQUE7QUNqTGhCO0FEc0xRO0VBQ0ksVUFBQTtFQUNBLDBCQUFBO0VBQ0EsdUJBQUE7RUFDQSwyQkFBQTtBQ3BMWjtBRHVMUTtFQUNJLGVBQUE7RUFDQSxZQUFBO0FDckxaO0FEd0xRO0VBQ0ksc0NBQUE7RUFDQSxrQkFBQTtBQ3RMWjtBRHlMZ0I7RUFDSSxZQUFBO0VBQ0EsYUFBQTtBQ3ZMcEI7QUQyTG9CO0VBQ0ksY0FBQTtBQ3pMeEI7QUQ0TG9CO0VBQ0ksU0FBQTtBQzFMeEI7QUQ0THdCO0VBQ0ksY0FBQTtBQzFMNUI7QUQ0TDRCO0VBQ0ksY0FBQTtBQzFMaEM7QURpTVk7RUFDSSxrQkFBQTtFQUNBLGlCQUFBO0VBQ0EsVUFBQTtFQUNBLG1CQUFBO0VBQ0EsYUFBQTtFQUNBLHFCQUFBO0VBQ0Esb0JBQUE7QUMvTGhCO0FEaU1nQjtFQUNJLG1CQUFBO0FDL0xwQjtBRG9NUTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDbE1aO0FEb01ZO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxlQUFBO0VBQ0Esa0JBQUE7RUFDQSxhQUFBO0VBQ0Esa0NBQUE7RUFDQSw4QkFBQTtFQUNBLDRCQUFBO0VBQ0EsNkJBQUE7RUFDQSxjQUFBO0VBQ0EsMENBQUE7RUFDQSx5QkFBQTtBQ2xNaEI7QURzTWdCO0VBQ0ksY0FBQTtFQUNBLGdCQUFBO0VBQ0EsbUJBQUE7QUNwTXBCO0FEeU1RO0VBQ0ksZ0JBQUE7QUN2TVo7QUQyTVk7RUFDSSxjQUFBO0FDek1oQjtBRDZNZ0I7RUFDSSxjQUFBO0FDM01wQjtBRCtNWTtFQUNJLE9BQUE7QUM3TWhCO0FEK01nQjtFQUNJLFVBQUE7RUFDQSxxQkFBQTtFQUNBLHFCQUFBO0FDN01wQjtBRGtOUTtFQUNJLGNBQUE7QUNoTlo7QURvTlk7RUFDSSxjQUFBO0FDbE5oQjtBRHFOWTtFQUNJLDBCQUFBO0FDbk5oQjtBRHNOWTtFQUNJLDBCQUFBO0FDcE5oQjtBRHVOWTtFQUNJLGNBQUE7QUNyTmhCO0FEd05ZO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDdE5oQjtBRDBOZ0I7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUN4TnBCO0FENk53QjtFQUNJLGNBQUE7QUMzTjVCO0FEa09nQjtFQUNJLHlCQUFBO0FDaE9wQjtBRHNPZ0I7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNwT3BCO0FEME9vQjtFQUNJLDBDQUFBO0VBQ0EsY0FBQTtBQ3hPeEI7QUQwT3dCO0VBQ0ksY0FBQTtBQ3hPNUI7QUQ0T29CO0VBQ0kscUJBQUE7QUMxT3hCO0FEZ1BRO0VBQ0ksd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0FDOU9aO0FEbVBnQjtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ2pQcEI7QUR1UFk7RUFDSSxlQUFBO0FDclBoQjtBRDRQb0I7RUFDSSw2QkFBQTtBQzFQeEI7QURrUWdCO0VBQ0kseUJBQUE7QUNoUXBCO0FEcVFRO0VBQ0ksWUFBQTtBQ25RWjtBRHNRUTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDcFFaO0FEc1FZO0VBQ0ksWUFBQTtFQUNBLGFBQUE7QUNwUWhCO0FEc1FnQjtFQUNJLHFCQUFBO0FDcFFwQjtBRHdRWTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtFQUNBLHlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxTQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7QUN0UWhCO0FEd1FnQjtFQUNJLDJCQUFBO0VBQ0EscUJBQUE7QUN0UXBCO0FEd1FvQjtFQUNJLGNBQUE7QUN0UXhCO0FENFFRO0VBQ0ksZUFBQTtBQzFRWjtBRDhRWTtFQUNJLGNBQUE7RUFDQSxlQUFBO0FDNVFoQjtBRGlSWTtFQUNJLHNCQUFBO0VBQ0EsY0FBQTtFQUNBLGFBQUE7RUFDQSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSx1QkFBQTtFQUNBLGVBQUE7QUMvUWhCO0FEaVJnQjtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUMvUXBCO0FEb1JRO0VBQ0ksV0FBQTtFQUNBLHlCQUFBO0VBQ0EsYUFBQTtFQUNBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0VBQ0EsZUFBQTtBQ2xSWjtBRHVSWTs7RUFFSSxpQkFBQTtBQ3JSaEI7QUR3Ulk7RUFDSSxpQkFBQTtBQ3RSaEI7QUR5Ulk7RUFDSSxpQkFBQTtBQ3ZSaEI7QUQyUlE7RUFDSSw2QkFBQTtFQUNBLGVBQUE7RUFDQSxZQUFBO0FDelJaO0FEMlJZO0VBQ0kseUJBQUE7RUFDQSxXQUFBO0VBQ0Esa0JBQUE7QUN6UmhCO0FENlJRO0VBQ0ksc0NBQUE7RUFDQSxpQkFBQTtFQUNBLFdBQUE7QUMzUlo7QUQ4UlE7RUFDSSxhQUFBO0FDNVJaO0FEOFJZO0VBQ0ksY0FBQTtBQzVSaEI7QURpU1k7RUFDSSxjQUFBO0VBQ0EseUJBQUE7RUFDQSx5Q0FBQTtFQUNBLDZDQUFBO0FDL1JoQjtBRGtTWTtFQUNJLHNCQUFBO0VBQ0EseUJBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsZUFBQTtBQ2hTaEI7QUQ0U1k7O0VBQ0ksYUFBQTtBQ3pTaEI7QUQyU2dCO0VBSEo7O0lBSVEsY0FBQTtFQ3ZTbEI7QUFDRjtBRDBTZ0I7O0VBQ0ksVUFBQTtBQ3ZTcEI7QUR5U29CO0VBSEo7O0lBSVEsV0FBQTtFQ3JTdEI7QUFDRjtBRHdTZ0I7O0VBQ0ksVUFBQTtFQUNBLGtCQUFBO0FDclNwQjtBRHdTd0I7O0VBQ0ksYUFBQTtBQ3JTNUI7QUR3U3dCOztFQUNJLGFBQUE7QUNyUzVCO0FEd1N3Qjs7RUFDSSxZQUFBO0FDclM1QjtBRHlTb0I7RUFsQko7O0lBbUJRLFdBQUE7SUFDQSxpQkFBQTtFQ3JTdEI7QUFDRjtBRHVTb0I7O0VBQ0ksY0FBQTtBQ3BTeEI7QUR1U29COztFQUNJLGFBQUE7QUNwU3hCO0FEdVNvQjs7RUFDSSxjQUFBO0VBQ0EsY0FBQTtBQ3BTeEI7QUQyU1E7RUFDSSxhQUFBO0FDelNaO0FENFNRO0VBQ0ksYUFBQTtBQzFTWjtBRDZTUTtFQUNJLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0FDM1NaO0FENlNZO0VBQ0ksY0FBQTtBQzNTaEI7QUQ4U1k7RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBQzVTaEI7QURrVGdCO0VBQ0ksb0NBQUE7QUNoVHBCO0FEcVRZOztFQUVJLDhCQUFBO0VBQ0EsWUFBQTtBQ25UaEI7QUR1VFk7RUFDSSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsbUJBQUE7QUNyVGhCO0FEdVRnQjtFQUNJLGlDQUFBO0FDclRwQjtBRDBUUTtFQUNJLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0FDeFRaO0FEMFRZO0VBQ0ksbUJBQUE7QUN4VGhCO0FEMlRZO0VBQ0ksdUJBQUE7RUFBQSxrQkFBQTtBQ3pUaEI7QUQyVGdCO0VBQ0ksb0NBQUE7QUN6VHBCO0FEK1RZO0VBQ0ksY0FBQTtBQzdUaEI7QURnVVk7RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBQzlUaEI7QURtVVk7RUFDSSxXQUFBO0VBQ0EsZUFBQTtBQ2pVaEI7QURvVVk7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQ2xVaEI7QURxVVk7RUFDSSxXQUFBO0VBQ0EsZUFBQTtFQUNBLDJCQUFBO0FDblVoQjtBRHVVUTtFQUNJLGFBQUE7RUFDQSxzQ0FBQTtFQUNBLGFBQUE7RUFDQSw4QkFBQTtFQUNBLG1CQUFBO0FDclVaO0FEdVVZO0VBQ0ksU0FBQTtFQUNBLGFBQUE7RUFDQSw4QkFBQTtFQUNBLG1CQUFBO0FDclVoQjtBRHVVZ0I7RUFDSSxZQUFBO0FDclVwQjtBRHVVb0I7RUFDSSwyQkFBQTtFQUNBLGtDQUFBO0FDclV4QjtBRHlVZ0I7RUFDSSxjQUFBO0FDdlVwQjtBRHlVb0I7RUFDSSxjQUFBO0FDdlV4QjtBRDJVZ0I7RUFDSSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtBQ3pVcEI7QUQyVW9CO0VBQ0ksY0FBQTtBQ3pVeEI7QUQyVXdCO0VBQ0ksY0FBQTtBQ3pVNUI7QUQrVVk7RUFDSSx5QkFBQTtFQUNBLFdBQUE7QUM3VWhCO0FEbVZZO0VBQ0ksWUFBQTtBQ2pWaEI7QURvVlk7RUFDSSxXQUFBO0VBQ0EsWUFBQTtFQUNBLG1CQUFBO0VBQ0Esc0JBQUE7RUFDQSx5QkFBQTtFQUNBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0FDbFZoQjtBRG9WZ0I7RUFDSSxlQUFBO0VBQ0EsY0FBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDbFZwQjtBRHVWZ0I7RUFDSSxjQUFBO0FDclZwQjtBRHdWZ0I7RUFDSSxjQUFBO0FDdFZwQjtBRHlWZ0I7RUFDSSx5QkFBQTtFQUNBLFdBQUE7QUN2VnBCO0FEZ1d3QjtFQUNJLDZCQUFBO0FDOVY1QjtBRHFXUTtFQUNJLHlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxhQUFBO0VBQ0EseUJBQUE7QUNuV1o7QURxV1k7RUFDSSxjQUFBO0FDbldoQjtBRHNXWTtFQUNJLGNBQUE7QUNwV2hCO0FEd1dRO0VBQ0ksc0NBQUE7RUFDQSxhQUFBO0FDdFdaO0FEeVdRO0VBQ0ksc0NBQUE7QUN2V1o7QUR5V1k7RUFDSSxhQUFBO0FDdldoQjtBRGdYWTtFQUNJLGtCQUFBO0VBQ0EsOEJBQUE7RUFDQSwrQkFBQTtBQzlXaEI7QURvWFk7RUFDSSxvQkFBQTtBQ2xYaEI7QURzWFE7O0VBRUksMkJBQUE7RUFDQSxZQUFBO0FDcFhaO0FEc1hZOztFQUNJLDhCQUFBO0VBQ0EsMkJBQUE7RUFDQSxtQkFBQTtBQ25YaEI7QURxWGdCOztFQUNJLGlDQUFBO0FDbFhwQjtBRHlYZ0I7RUFDSSx1QkFBQTtBQ3ZYcEI7QUR5WG9CO0VBSEo7SUFJUSx5QkFBQTtFQ3RYdEI7QUFDRjtBRHlYZ0I7RUFDSSx5QkFBQTtFQUNBLGNBQUE7QUN2WHBCO0FEeVhvQjtFQUNJLHlCQUFBO0FDdlh4QjtBRDJYb0I7RUFUSjtJQVVRLHNCQUFBO0VDeFh0QjtBQUNGO0FENlhRO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQzNYWjtBRDZYWTtFQUNJLFVBQUE7RUFDQSxXQUFBO0FDM1hoQjtBRDhYWTtFQUNJLG1CQUFBO0FDNVhoQjtBRCtYWTtFQUNJLGdCQUFBO0VBQ0Esa0JBQUE7QUM3WGhCO0FEZ1lZO0VBQ0ksZ0JBQUE7QUM5WGhCO0FEb1lnQjtFQUNJLHlCQUFBO0FDbFlwQjtBRHVZZ0I7RUFDSSxjQUFBO0FDcllwQjtBRDBZUTtFQUNJLGlCQUFBO0VBQ0Esc0JBQUE7RUFDQSxrQkFBQTtFQUNBLGlCQUFBO0VBQ0EsZUFBQTtBQ3hZWjtBRDRZWTtFQUNJLHNCQUFBO0VBQ0EsV0FBQTtBQzFZaEI7QUQrWVk7RUFDSSxhQUFBO0FDN1loQjtBRGtaWTtFQUNJLG9DQUFBO0FDaFpoQjtBRG9aUTtFQUNJLGNBQUE7QUNsWlo7QURxWlE7RUFDSSxjQUFBO0FDblpaO0FEc1pRO0VBQ0kseUJBQUE7QUNwWlo7QURrYVE7RUFDSSxlQUFBO0FDaGFaO0FEa2FZO0VBQ0ksZUFBQTtFQUNBLGNBQUE7QUNoYWhCO0FEcWFJO0VBQ0ksMkJBQUE7RUFDQSw4QkFBQTtFQUNBLHVDQUFBO0FDbmFSO0FEc2FJO0VBQ0ksWUFBQTtBQ3BhUjtBRHVhSTtFQUNJLGFBQUE7RUFDQSxpQ0FBQTtBQ3JhUjtBRHdhQTtFQUNJLHdCQUFBO0FDcmFKO0FEeWFJO0VBQ0Esb0JBQUE7QUN0YUo7QUQwYUE7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxpQkFBQTtFQUNBLG1CQUFBO0FDdmFKO0FEeWFJO0VBQ0kseUJBQUE7QUN2YVI7QUQwYUk7RUFDSSx5QkFBQTtFQUNBLGtCQUFBO0FDeGFSO0FEMmFJO0VBQ0ksbUNBQUE7QUN6YVI7QUQ0YUk7RUFDSSxlQUFBO0FDMWFSO0FEOGFBO0VBQ0ksMkJBQUE7RUFDQSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7QUMzYUo7QUQ4YUE7RUFDSSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsMkJBQUE7RUFDQSw4QkFBQTtBQzNhSjtBRDRhSTtFQUNJLDJCQUFBO0VBQ0EsaUJBQUE7RUFDQSx1Q0FBQTtBQzFhUjtBRDhhQTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxZQUFBO0FDM2FKO0FEOGFBO0VBQ0ksbUNBQUE7RUFDQSxrQkFBQTtBQzNhSjtBRCthQTtFQUNJLGdCQUFBO0VBQ0EsMEJBQUE7QUM1YUo7QUQrYUE7RUFDSSxnQkFBQTtFQUNBLGdCQUFBO0VBQ0EsaUJBQUE7QUM1YUo7QURnYkE7RUFDSSxVQUFBO0FDN2FKO0FEZ2JBLFVBQUE7QUFDQTtFQUNJLG1CQUFBO0FDN2FKO0FEZ2JBLFdBQUE7QUFDQTtFQUNJLG1CQUFBO0FDN2FKO0FEZ2JBLFVBQUE7QUFDQTtFQUNJLG1CQUFBO0FDN2FKO0FEZ2JBO0VBQ0ksZ0JBQUE7QUM3YUo7QURtYkk7RUFDSSxvQ0FBQTtBQ2hiUjtBRGtiUTtFQUNJLGlCQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7QUNoYlo7QURzYkk7RUFDSSxlQUFBO0VBQ0EseUJBQUE7QUNuYlI7QUR3Ykk7RUFDSSxlQUFBO0VBQ0EsZ0JBQUE7QUNyYlI7QUR3Ylk7RUFDSSxjQUFBO0FDdGJoQjtBRGtjQTtFQUNJLHdCQUFBO0FDL2JKO0FEa2NBO0VBRVE7SUFDSSxrQkFBQTtFQ2hjVjtBQUNGO0FEb2NJO0VBQ0MsMkJBQUE7RUFDQyxpQkFBQTtFQUNBLHVDQUFBO0FDbGNOO0FENGNBO0VBQ0ksb0NBQUE7RUFDQSxXQUFBO0VBQ0EsMkJBQUE7QUN6Y0o7QUQwY0k7RUFDSSxzQkFBQTtFQUNBLHVCQUFBO0VBQ0EsNEJBQUE7QUN4Y1IiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL3N0YW5kYXJkY291cnNlcy9zdGFuZGFyZGNvdXJzZXMuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjc3RhbmRhcmRfY3VzdG9taXplZCB7XHJcbiAgIFxyXG4gICAgLmNsZWFyYnRuIHtcclxuICAgICAgICBoZWlnaHQ6IDM1cHg7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuYWRkYnRuIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiBub25lO1xyXG4gICAgICAgIGJvcmRlcjogbm9uZTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICB9XHJcbiAgICAucHJvamxzdG5ncGgge1xyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuXHJcbiAgICAgICAgICAgICYudHBoaWQge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDMwJTtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMTJweDtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDEycHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYudHBodGl0bGUge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDYwJTtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMTJweDtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDEycHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYudHBodHlwZSB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMjAlO1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxMnB4O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMTJweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgJi50cGhzdGF0dXMge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDEwMHB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxMnB4O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMTJweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgJi50cGhjb3VudCB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogNDBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMTJweDtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDEycHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYudHBoZGVzcCB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMTJweDtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDEycHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC50cGhtb3JlIHtcclxuICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICB0b3A6IDEwcHg7XHJcbiAgICAgICAgICAgIHJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5kb2Nyb3cge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuXHJcbiAgICAgICAgICAgIC5kb2NpbWcge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDgwcHg7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDgwcHg7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDIwcHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5kb2Njb250ZW50IHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xyXG5cclxuICAgICAgICAgICAgICAgIC5kb2N0aXRsZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDUwJTtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDEycHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLmRvY2NvbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAuZG9jY29sZGF0YSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOiAyNSU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMzBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5kb2NkYXRlIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOiAxNTBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDogMTJweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGhyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICBtYXJnaW46IDIwcHggMDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC50YXJnZXRqdXN0aWZ5IHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93O1xyXG5cclxuICAgICAgICAgICAgLnBhZ2VyIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAyNSU7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDMycHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5zZWFyY2gge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDI1JTtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMzJweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnRhYmxlcm93IHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1hcm91bmQ7XHJcbiAgICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOiByb3c7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG5cclxuICAgICAgICAgICAgLnRhYmxldGl0bGUge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDE4JTtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMiU7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDMycHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5wcm9qZWN0LWxzdCB7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIHJnYmEoMjA0LCAyMDQsIDIwNCwgMC41KTtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICBtaW4taGVpZ2h0OiAyNDJweDtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDBweDtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogMjBweDtcclxuXHJcbiAgICAgICAgICAgIC5wcm9qZWN0LWxzdC1oZWFkZXIge1xyXG4gICAgICAgICAgICAgICAgbWluLWhlaWdodDogMTgwcHg7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuXHJcbiAgICAgICAgICAgICAgICAucHJvamltZyB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDE2MHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGhlaWdodDogMTYwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5wcm9qZGV0IHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE2MHB4KTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLnByb2plY3QtbHN0LWZvb3RlciB7XHJcbiAgICAgICAgICAgICAgICBtaW4taGVpZ2h0OiA2MHB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYmVmZjU7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHggMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5saXN0c2VjdG9yIHtcclxuICAgICAgICAudmlld2NsZWFyIHtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiAxNjVweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA0MHB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmxlZnRtYWluc3BhY2Uge1xyXG4gICAgICAgICAgICAuc3ViY29udGVudCB7XHJcbiAgICAgICAgICAgICAgICBtYXgtd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogYXV0bztcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDI1cHg7XHJcblxyXG4gICAgICAgICAgICAgICAgLndpZHRob2ZmaXJzdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDUwJTtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDU1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMjVweDtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuc2Vjb25kd2lkdGgge1xyXG4gICAgICAgICAgICAgICAgICAgIEBleHRlbmQgLndpZHRob2ZmaXJzdDtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5zZWN0b3JoZWlnaHQge1xyXG4gICAgICAgICAgICAgICAgICAgIEBleHRlbmQgLndpZHRob2ZmaXJzdDtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIGhlaWdodDogNDVweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDZweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5maXJzdHZpZXdjb250ZW50IHtcclxuICAgICAgICAgICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDM1JTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW4tYm90dG9tOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuZGVzY3JpcHRpdGxlc2VjdG9yIHtcclxuICAgICAgICAgICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDIwJTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAxNXB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW4tYm90dG9tOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLmRlc2NyaXB0aW9uY29udGVudCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIEBleHRlbmQgLndpZHRob2ZmaXJzdDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiA4NXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuY2xlYXJwcm8ge1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDgwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5hZGR2aWV3bG9hZCB7XHJcbiAgICAgICAgICAgIEBleHRlbmQgLmNsZWFycHJvO1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDk1cHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5hbGlnbmxvYWQge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmFkZHZpZXdsb2FkIC5oZWlnaHRvZmJ0biB7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5wbGFjZWhvbGRlci1jb250ZW50IHtcclxuICAgICAgICBoZWlnaHQ6IDMyMHB4O1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICMwMDA7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIC8vIEFuaW1hdGlvblxyXG4gICAgICAgIGFuaW1hdGlvbi1kdXJhdGlvbjogMS43cztcclxuICAgICAgICBhbmltYXRpb24tZmlsbC1tb2RlOiBmb3J3YXJkcztcclxuICAgICAgICBhbmltYXRpb24taXRlcmF0aW9uLWNvdW50OiBpbmZpbml0ZTtcclxuICAgICAgICBhbmltYXRpb24tdGltaW5nLWZ1bmN0aW9uOiBsaW5lYXI7XHJcbiAgICAgICAgYW5pbWF0aW9uLW5hbWU6IHBsYWNlaG9sZGVyQW5pbWF0ZTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZjZmN2Y4OyAvLyBGYWxsYmFja1xyXG4gICAgICAgIGJhY2tncm91bmQ6IGxpbmVhci1ncmFkaWVudCh0byByaWdodCwgI2VlZSAyJSwgI2RkZCAxOCUsICNlZWUgMzMlKTtcclxuICAgICAgICBiYWNrZ3JvdW5kLXNpemU6IDEzMDBweDsgLy8gQW5pbWF0aW9uIEFyZWFcclxuICAgIH1cclxuXHJcbiAgICAucGxhY2Vob2xkZXItY29udGVudF9pdGVtIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBoZWlnaHQ6IDIwcHg7XHJcbiAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgIHotaW5kZXg6IDI7XHJcbiAgICB9XHJcblxyXG4gICAgLnBsYWNlaG9sZGVyLWNvbnRlbnRfaXRlbTphZnRlcixcclxuICAgIC5wbGFjZWhvbGRlci1jb250ZW50X2l0ZW06YmVmb3JlIHtcclxuICAgICAgICB3aWR0aDogaW5oZXJpdDtcclxuICAgICAgICBoZWlnaHQ6IGluaGVyaXQ7XHJcbiAgICAgICAgY29udGVudDogXCJcIjtcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICB9XHJcblxyXG4gICAgQGtleWZyYW1lcyBwbGFjZWhvbGRlckFuaW1hdGUge1xyXG4gICAgICAgIDAlIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbjogLTY1MHB4IDA7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAxMDAlIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbjogNjUwcHggMDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnBhZ2V0aXRsZSB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogIzAwMDtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgLy8gQW5pbWF0aW9uXHJcbiAgICAgICAgYW5pbWF0aW9uLWR1cmF0aW9uOiAxLjdzO1xyXG4gICAgICAgIGFuaW1hdGlvbi1maWxsLW1vZGU6IGZvcndhcmRzO1xyXG4gICAgICAgIGFuaW1hdGlvbi1pdGVyYXRpb24tY291bnQ6IGluZmluaXRlO1xyXG4gICAgICAgIGFuaW1hdGlvbi10aW1pbmctZnVuY3Rpb246IGxpbmVhcjtcclxuICAgICAgICBhbmltYXRpb24tbmFtZTogcGFnZXRpdGxlQW5pbWF0ZTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZjZmN2Y4OyAvLyBGYWxsYmFja1xyXG4gICAgICAgIGJhY2tncm91bmQ6IGxpbmVhci1ncmFkaWVudCh0byByaWdodCwgI2VlZSAyJSwgI2RkZCAxOCUsICNlZWUgMzMlKTtcclxuICAgICAgICBiYWNrZ3JvdW5kLXNpemU6IDEzMDBweDsgLy8gQW5pbWF0aW9uIEFyZWFcclxuICAgIH1cclxuXHJcbiAgICAucGFnZXRpdGxlOmJlZm9yZSB7XHJcbiAgICAgICAgd2lkdGg6IGluaGVyaXQ7XHJcbiAgICAgICAgaGVpZ2h0OiBpbmhlcml0O1xyXG4gICAgICAgIGNvbnRlbnQ6IFwiXCI7XHJcbiAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgfVxyXG5cclxuICAgIEBrZXlmcmFtZXMgcGFnZXRpdGxlQW5pbWF0ZSB7XHJcbiAgICAgICAgMCUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiAtNjUwcHggMDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIDEwMCUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiA2NTBweCAwO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICBtYXJnaW4tYm90dG9tOiAxMSU7XHJcblxyXG4gICAgLmVycm9ycyB7XHJcbiAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1jaGVja2JveC1kaXNhYmxlZCB7XHJcbiAgICAgICAgb3BhY2l0eTogMC41O1xyXG4gICAgICAgIGN1cnNvcjogbm8tZHJvcDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgfVxyXG5cclxuICAgICNzdGFuZGFyZF9jb3Vyc2Uge1xyXG4gICAgICAgIC5hcHByb3ZlZCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMDBhNTUxO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnVwZGF0ZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmRlY2xpbmVkIHtcclxuICAgICAgICAgICAgY29sb3I6ICNlZDFjMjc7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubmV3IHtcclxuICAgICAgICAgICAgY29sb3I6ICNmNDgxMWY7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAucmVxdWlyZWRmaWVscyB7XHJcbiAgICAgICAgICAgIGg0IHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAueWVzbm8ge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAueWVzbm8ge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuXHJcbiAgICAgICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5yZWFkb25seWZpZWxkIHtcclxuXHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4ZjggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogbm8tZHJvcCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBpbnB1dFtyZWFkb25seV0ge1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOiBuby1kcm9wICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAudHh0LWdyeSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnR4dC1ncnkzIHtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjYgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAjcHJvZmlsZSB7XHJcbiAgICAgICAgICAgIC5oaW50IHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxNjhweDtcclxuICAgICAgICAgICAgICAgIHdvcmQtYnJlYWs6IGJyZWFrLXdvcmQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICN1cGxvYWRlZCB7XHJcbiAgICAgICAgICAgICAgICAuZmlsZXJzIHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTYycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAxNjJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgaW5wdXQubWF0LWlucHV0LWVsZW1lbnQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAwcmVtICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM5OTk5OTk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1mbGV4IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtaW5maXgge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZzogMCAycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci10b3A6IDAuNGVtIHNvbGlkIHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGN1cnJlbnRjb2xvciAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBjdXJyZW50Y29sb3IgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICBtYXQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzk5OTk5OTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZCBsYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgaW5wdXQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAmLm1hdC1pbnB1dC1lbGVtZW50IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDE2MnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTYycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdG9wOiAtMC43NWVtO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuZG9jdW1lbnQge1xyXG4gICAgICAgICAgICAgICAgICAgIG1hdC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgaW1nIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICBtYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1yYWRpby1idXR0b24ge1xyXG4gICAgICAgICAgICAubWF0LXJhZGlvLW91dGVyLWNpcmNsZSB7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItY29sb3I6ICNkOWQ5ZDk7XHJcblxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmLm1hdC1hY2NlbnQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1yYWRpby1pbm5lci1jaXJjbGUge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlMjA2MTMgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAmLm1hdC1yYWRpby1jaGVja2VkIHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LXJhZGlvLW91dGVyLWNpcmNsZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci1jb2xvcjogI2Q5ZDlkOTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXJhZGlvLWxhYmVsLWNvbnRlbnQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzAwMDAwMGNjO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE2cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuXHJcbiAgICAgICAgICAgIC5kb2N1bWVudF9pbWcge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDMycHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC52aWV3ZG9jdW1lbnQge1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGF0ZXJhbmdldGltZSB7XHJcbiAgICAgICAgICAgIC5tZC1kcnBwaWNrZXIge1xyXG5cclxuICAgICAgICAgICAgICAgIHdpZHRoOiA2NTBweDtcclxuICAgICAgICAgICAgICAgIHJpZ2h0OiAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAyMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuY2xvc2VhbmRkYXRlaWNvbiB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1yYWlzZWQtYnV0dG9uIHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE2cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuc3VibWl0X2J0biB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiAxMTBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnNldHVwX2J0biB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICM4NDg0ODQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiAxMTBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmNhbmNlbGJ0biB7XHJcbiAgICAgICAgICAgIG1pbi13aWR0aDogMTEwcHg7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlOGU4ZTg7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMHB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWluay1iYXIge1xyXG4gICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXRhYi1oZWFkZXIge1xyXG4gICAgICAgICAgICBib3JkZXI6IDBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgIC5jb250ZW50Y2lyY2xlIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmZpbGVfdXBsb2FkIHtcclxuICAgICAgICAgICAgI3VwbG9hZGVkIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcblxyXG4gICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDEyNzlweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5maWxlcnMge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiA1MCU7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiAxMjc5cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5kb2N1bWVudCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDUwJTtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDMwcHg7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsZWZ0OiAtMjM5cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiAxMjc5cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLmNsb3NlX2ljb25zIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAuZGVsZXRlX2ljb24ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLnZpZXdfYnRuIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLndvcmtjaGVja2JveCB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgICAubWF0LWNoZWNrYm94LWlubmVyLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMjBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMjBweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1jaGVja2JveC1jaGVja2VkIHtcclxuICAgICAgICAgICAgICAgICYubWF0LWFjY2VudCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1jaGVja2JveC1iYWNrZ3JvdW5kIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1jaGVja2JveC1mcmFtZSB7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjYzRjNGM0O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXNsaWRlLXRvZ2dsZSB7XHJcbiAgICAgICAgICAgICYubWF0LWNoZWNrZWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1zbGlkZS10b2dnbGUtdGh1bWIge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTE7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1zbGlkZS10b2dnbGUtYmFyIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDBhNTUwNjI7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtdGFiLWxhYmVsIHtcclxuICAgICAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDVweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA4MHB4O1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6MCAxMHB4O1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDEyNXB4O1xyXG4gICAgICAgICAgICAmOm50aC1jaGlsZCgyKXtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAyNTBweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtdGFiLWxpc3Qge1xyXG4gICAgICAgICAgICBvcGFjaXR5OiAxO1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcmFpc2VkLWJ1dHRvbltkaXNhYmxlZF06bm90KFtjbGFzcyo9bWF0LWVsZXZhdGlvbi16XSkge1xyXG4gICAgICAgICAgICBjdXJzb3I6IG5vLWRyb3A7XHJcbiAgICAgICAgICAgIG9wYWNpdHk6IDAuNTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtY2FyZCB7XHJcbiAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMCA0cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcblxyXG4gICAgICAgICAgICAubWF0LWNhcmQtY29udGVudCB7XHJcbiAgICAgICAgICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiAxMDBweDtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDEwMHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5jYXJkaW5mbyB7XHJcbiAgICAgICAgICAgICAgICAgICAgaDQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5jZW50cmVfaW5mbyB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGdhcDogMzBweDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5jYXJkYnRuIHtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IC0zNHB4O1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDkzJTtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGJhc2VsaW5lO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBlbmQ7XHJcblxyXG4gICAgICAgICAgICAgICAgYnV0dG9uIHtcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAudGFic2NvbnRlbnQge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgICAgIC5jb250ZW50Y2lyY2xlIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAyOHB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAyOHB4O1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiAyOHB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMCA4cHggcmdiKDUxIDUxIDUxIC8gMTUlKTtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICM4NDg0ODQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC50YWJ0aXRsZSB7XHJcbiAgICAgICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOiBsZWZ0O1xyXG4gICAgICAgICAgICAgICAgICAgIHdoaXRlLXNwYWNlOiBub3JtYWw7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5zdWJ0aXRsZWZvcm0ge1xyXG4gICAgICAgICAgICBmb250LXdlaWdodDogNzAwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnRpdGxlIHtcclxuICAgICAgICAgICAgaDQge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5zdWJ0aXRsZSB7XHJcbiAgICAgICAgICAgICAgICBoNCB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5saW5lIHtcclxuICAgICAgICAgICAgICAgIGZsZXg6IDQ7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1kaXZpZGVyIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTIlO1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlci10b3Atd2lkdGg6IDNweDtcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXItY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtaW5wdXQtZWxlbWVudCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG5cclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLS45cmVtKSBzY2FsZSgwLjc1KTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGF0ZV9leHAge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnJlYWRvbmx5IHtcclxuICAgICAgICAgICAgaW5wdXRbcmVhZG9ubHldIHtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogbm8tZHJvcDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkIHtcclxuICAgICAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1wcmltYXJ5IHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LXNlbGVjdC1hcnJvdyB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkIHtcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmZpbHRlciB7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC51c2VyaW1nIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDE2OHB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxNjhweDtcclxuXHJcbiAgICAgICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHNjYWxlKDEuMSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAzMnB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAzMnB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMjBweDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNjNGM0YzQ7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDMzcHg7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiAtNDRweDtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDAuNTtcclxuXHJcbiAgICAgICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3NzA7XHJcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjEpO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5pY29uZ3JvdXAge1xyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMTBweDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkOWQ5ZDk7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogNDBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDI1cHg7XHJcblxyXG4gICAgICAgICAgICAgICAgJi5hZGQge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYWRkX2ljb24ge1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMjVweFxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmFyYWJpY2xhbmd1YWdlIHtcclxuXHJcbiAgICAgICAgICAgIGlucHV0LFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgdGV4dC1hbGlnbjogcmlnaHQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOiByaWdodDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1lcnJvciB7XHJcbiAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOiByaWdodDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmVkaXRidG4ge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiB0cmFuc3BhcmVudDtcclxuICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgICAgICBwYWRkaW5nOiA0cHg7XHJcblxyXG4gICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmNvdXJlYm94IHtcclxuICAgICAgICAgICAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDVweCAxMHB4O1xyXG4gICAgICAgICAgICBtYXJnaW46IDJweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5zdWJ0aXRsZWZvcm0ge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG5cclxuICAgICAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuaWNvbmdyb3VwIHtcclxuICAgICAgICAgICAgLmZhIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgIzg0ODQ4NDtcclxuICAgICAgICAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogIzg0ODQ4NCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkOWQ5ZDk7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogNDBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDMwcHg7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gJjpudGgtY2hpbGQoMSkge1xyXG4gICAgICAgICAgICAgICAgLy8gICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAvLyAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICAvLyB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICNkb2N1bWVudHMsXHJcbiAgICAgICAgLmRvY3VtZW50cyB7XHJcblxyXG4gICAgICAgICAgICAjdXBsb2FkZWQge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogOTU5cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAvLyAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYXJvdW5kOyBcclxuICAgICAgICAgICAgICAgIC5maWxlcnMge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiA1MCU7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiA5NTlweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLmRvY3VtZW50IHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogNTAlO1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMzBweDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGxlZnQ6IC0yMzlweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDk1OXB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5jbG9zZV9pY29ucyB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLmRlbGV0ZV9pY29uIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC52aWV3X2J0biB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYXZhaWxhYmxlZGF0ZSB7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDE1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYXZhaWxhYmxldGFibGUge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIG1hcmdpbjogMTBweCAwcHg7XHJcblxyXG4gICAgICAgICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtcm93IHtcclxuICAgICAgICAgICAgICAgIC8vIHdpZHRoOiBmaXQtY29udGVudDtcclxuXHJcbiAgICAgICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAjc2VhcmNocm93LFxyXG4gICAgICAgICAgICAjZmlsdGVyc2hvdyB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmJmYmZiICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6IG5vbmU7XHJcblxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAuc2VyYWNocm93IHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDE1cHg7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmF3YXJlZHRhYmxlIHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICBtYXJnaW46IDEwcHggMHB4O1xyXG5cclxuICAgICAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1yb3cge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IGZpdC1jb250ZW50O1xyXG5cclxuICAgICAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjUgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1zZWxlY3QtdmFsdWUge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAucmVuZXdhbCB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMCA0cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xyXG4gICAgICAgICAgICBwYWRkaW5nOiAxNXB4O1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgICAucmVuZXdhbF9pbmZvIHtcclxuICAgICAgICAgICAgICAgIGdhcDogMzBweDtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZGl2aWRlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiA1MXB4O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWRpdmlkZXItdmVydGljYWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXItcmlnaHQtY29sb3I6ICNjNGM0YzQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci1yaWdodC13aWR0aDogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5yZW1haW5kZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDhweDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLnZpZXdidG4ge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnN1Y2Nlc3Mge1xyXG4gICAgICAgICAgICAuY2VudGVyY29udGVudCB7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDcxdmg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5zdWNjZXNzX2ljb24ge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDcycHg7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDcycHg7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogM3B4IHNvbGlkICMwMGE1NTE7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMDBhNTUxO1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLnN1Y2Nlc19tc2cge1xyXG4gICAgICAgICAgICAgICAgaDQge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMDBhNTUxO1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC52aWV3Zm9ybSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnNlY29uZHRhYiB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LXNlbGVjdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgJi5tYXQtc2VsZWN0LWRpc2FibGVkIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1zZWxlY3QtYXJyb3c6OmJlZm9yZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmRlY2xpbmUge1xyXG4gICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjRUQxQzI3O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDE1cHg7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY4Zjg7XHJcblxyXG4gICAgICAgICAgICBoNCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmNhcmQge1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiAwIDAgNHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcclxuICAgICAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5jYXJkZXIge1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiAwIDAgNHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcclxuXHJcbiAgICAgICAgICAgIC5yYW5nZWRhdGUge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMTVweDtcclxuXHJcbiAgICAgICAgICAgICAgICAvLyBzcGFuIHtcclxuICAgICAgICAgICAgICAgIC8vICAgICBjb2xvcjogIzI2MjYyNlxyXG4gICAgICAgICAgICAgICAgLy8gfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZmlsdGVyIHtcclxuICAgICAgICAgICAgLmZhIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiB0cmFuc3BhcmVudDtcclxuICAgICAgICAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDFweDtcclxuICAgICAgICAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2UtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAjcmVnYXBwIHtcclxuICAgICAgICAgICAgLmNsb3NlYW5kZGF0ZWljb21heCB7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDE0cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgI3NlYXJjaHJvdyxcclxuICAgICAgICAjZmlsdGVyc2hvdyB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm9yZGVyOiBub25lO1xyXG5cclxuICAgICAgICAgICAgLnNlcmFjaHJvdyB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjhmOGY4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBtaW4taGVpZ2h0OiA3M3B4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5mb290ZXJwYWdpbmF0b3Ige1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6NzY4cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIEBtZWRpYShtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuc2Nyb2xsZGF0YSB7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgei1pbmRleDogMTtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xyXG5cclxuICAgICAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDZweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAudGFiZm9yY2xpZW50ZWxlbmV3IHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtaW5maXgge1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDhweCAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYW5hZ2VvcHRpb25zIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNhY2FjYWM7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5ocnN0YWcge1xyXG4gICAgICAgICAgICBwYWRkaW5nOiA1cHggMTBweDtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNnB4O1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogMTVweDtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiA4MnB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hc3Rlci1tZW51IHtcclxuICAgICAgICAgICAgLm1hdC1tZW51LWNvbnRlbnQge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwMDtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Q5ZDlkOSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXNvcnQtaGVhZGVyLWFycm93IHtcclxuICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubm9mb3VuZCB7XHJcbiAgICAgICAgICAgIG1hcmdpbi10b3A6IDUlO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnJhbmdlZGF0ZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmYmZiZmI7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAvLyAjcmVnYXBwe1xyXG4gICAgICAgIC8vICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIC8vICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIC8vICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgLy8gICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gICAgICAgIC8vICAgICAubWQtZHJwcGlja2VyLmRvdWJsZXtcclxuICAgICAgICAvLyAgICAgICAgIHdpZHRoOiA2NTBweDtcclxuICAgICAgICAvLyAgICAgICAgIHJpZ2h0OiAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgLy8gICAgICAgICBtYXJnaW4tdG9wOjIwcHg7XHJcbiAgICAgICAgLy8gICAgIH1cclxuICAgICAgICAvLyB9XHJcbiAgICAgICAgLnRpbWVwaWNrZXJ3aWR0aCB7XHJcbiAgICAgICAgICAgIG1heC13aWR0aDogODVweDtcclxuXHJcbiAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYm9yZGVyc2xvdCB7XHJcbiAgICAgICAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgICAgICBwbGFjZS1jb250ZW50OiBjZW50ZXIgY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnctMTUwIHtcclxuICAgICAgICB3aWR0aDogMTUwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnVzcmZybSB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbn1cclxuLm1hdC1idXR0b24tZm9jdXMtb3ZlcmxheSB7XHJcbiAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XHJcbn1cclxuLm9wdGlvbi1saXN0aW5nIFxyXG57XHJcbiAgICBkaXYge1xyXG4gICAgbWFyZ2luOiAwICFpbXBvcnRhbnQ7IFxyXG59XHJcbn1cclxuXHJcbi5zZWFyY2hpbm11bHRpc2VsZWN0IHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgcGFkZGluZzogNnB4IDEwcHg7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZTllZGYwO1xyXG5cclxuICAgIGlucHV0Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVyIHtcclxuICAgICAgICBjb2xvcjogIzdmOGZhMyAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIGkge1xyXG4gICAgICAgIGNvbG9yOiAjN2Y4ZmEzICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogNnB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5zZWFyY2hzZWxlY3Qge1xyXG4gICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5yZXNldGljb24ge1xyXG4gICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgIH1cclxufVxyXG5cclxuLnNlbGVjdF93aXRoX3NlYXJjaCB7XHJcbiAgICBvdmVyZmxvdzogaGlkZGVuICFpbXBvcnRhbnQ7XHJcbiAgICBtYXgtaGVpZ2h0OiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICBtYXJnaW4tdG9wOiA1MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICBtYXJnaW4tYm90dG9tOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbi5zZWxlY3Rfd2l0aF9vcHRpb24ge1xyXG4gICAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xyXG4gICAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgbWFyZ2luLXRvcDogNDlweCAhaW1wb3J0YW50O1xyXG4gICAgbWFyZ2luLWJvdHRvbTogMTVweCAhaW1wb3J0YW50O1xyXG4gICAgJi5tdWx0aXBsZSB7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogNDhweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAyNXB4O1xyXG4gICAgICAgIG1pbi13aWR0aDogY2FsYygxMDAlICsgMjhweCkgIWltcG9ydGFudDtcclxuICAgICB9XHJcbn1cclxuXHJcbi5zZWFyY2hpbm11bHRpc2VsZWN0IHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgcGFkZGluZzogMTBweCAxMHB4O1xyXG4gICAgYmFja2dyb3VuZDogI2U5ZWRmMDtcclxuICAgIG1hcmdpbjogMTBweDtcclxufVxyXG5cclxuLnNlYXJjaHNlbGVjdCB7XHJcbiAgICB3aWR0aDogY2FsYygxMDAlIC0gMjVweCkgIWltcG9ydGFudDtcclxuICAgIHBhZGRpbmctbGVmdDogMTBweDtcclxuXHJcbn1cclxuXHJcbi5tYXQtb3B0aW9uLm1hdC1hY3RpdmUge1xyXG4gICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgIGNvbG9yOiByZ2JhKDAsIDAsIDAsIDAuODcpO1xyXG59XHJcblxyXG4ub3B0aW9uLWxpc3Rpbmcge1xyXG4gICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgIG92ZXJmbG93LXk6IGF1dG87XHJcbiAgICBtYXgtaGVpZ2h0OiAyOTBweDtcclxuXHJcbn1cclxuXHJcbi5vcHRpb24tbGlzdGluZzo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgd2lkdGg6IDdweDtcclxufVxyXG5cclxuLyogVHJhY2sgKi9cclxuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG59XHJcblxyXG4vKiBIYW5kbGUgKi9cclxuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjRUQxQzI3O1xyXG59XHJcblxyXG4vKiBob3ZlciAqL1xyXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcclxuICAgIGJhY2tncm91bmQ6ICNFRDFDMjc7XHJcbn1cclxuXHJcbi5teVBhbmVsQ2xhc3Mge1xyXG4gICAgbWFyZ2luOiAzNnB4IDBweDtcclxufVxyXG5cclxuXHJcblxyXG4ubWF0LW1lbnUtcGFuZWwge1xyXG4gICAgJi50YWJsZV9tZW51IHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNjY2NjY2ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgIC5tYXQtbWVudS1pdGVtIHtcclxuICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDM2cHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogMzFweDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG4ubWF0LXNlbGVjdC1kaXNhYmxlZCB7XHJcbiAgICAubWF0LXNlbGVjdC12YWx1ZSB7XHJcbiAgICAgICAgY3Vyc29yOiBuby1kcm9wO1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbn1cclxuXHJcbi5tYXQtbWVudS1wYW5lbCB7XHJcbiAgICAmLm1lbnUtcGFuZWwge1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDdweDtcclxuICAgICAgICBtaW4td2lkdGg6IDIzMHB4O1xyXG5cclxuICAgICAgICAubWF0LW1lbnUtaXRlbSB7XHJcbiAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC8vICY6Zm9jdXMge1xyXG4gICAgICAgICAgICAvLyAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgIC8vIH1cclxuICAgICAgICB9XHJcblxyXG5cclxuICAgIH1cclxufVxyXG5cclxuLm1hdC1kaWFsb2ctY29udGFpbmVyIHtcclxuICAgIHBhZGRpbmc6IDI0cHggIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6MTM2NnB4KSB7XHJcbiAgICAjcmVnYXBwIHtcclxuICAgICAgICAubWQtZHJwcGlja2VyLmRvdWJsZSB7XHJcbiAgICAgICAgICAgIGxlZnQ6IDAgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuLnNlbGVjdF93aXRoX3NlYXJjaCB7IFxyXG4gICAgJi5tdWx0aXBsZSB7XHJcbiAgICAgbWFyZ2luLXRvcDogNTVweCAhaW1wb3J0YW50O1xyXG4gICAgICBtYXJnaW4tbGVmdDogMjVweDtcclxuICAgICAgbWluLXdpZHRoOiBjYWxjKDEwMCUgKyAyN3B4KSAhaW1wb3J0YW50O1xyXG4gIH1cclxuLy8gICAuc2VsZWN0X3dpdGhfb3B0aW9uIHtcclxuLy8gICAgICYubXVsdGlwbGUge1xyXG4vLyAgICAgICAgIG1hcmdpbi10b3A6IDE1NXB4ICFpbXBvcnRhbnQ7XHJcbi8vICAgICAgICAgIG1hcmdpbi1sZWZ0OiAyNXB4O1xyXG4vLyAgICAgICAgICBtaW4td2lkdGg6IGNhbGMoMTAwJSArIDI3cHgpICFpbXBvcnRhbnQ7XHJcbi8vICAgICAgfVxyXG4vLyAgIH1cclxufVxyXG4ud2hlbnRvb3RsdGlwYWRkZWQge1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogIzY2NjY2NiAhaW1wb3J0YW50O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgICBtaW4taGVpZ2h0OiA0NXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAubWF0LW1lbnUtaXRlbSB7XHJcbiAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBoZWlnaHQ6IDMwcHggIWltcG9ydGFudDtcclxuICAgICAgICBsaW5lLWhlaWdodDogMjBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG59XHJcbiIsIiNzdGFuZGFyZF9jdXN0b21pemVkIHtcbiAgbWFyZ2luLWJvdHRvbTogMTElO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLmNsZWFyYnRuIHtcbiAgaGVpZ2h0OiAzNXB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgbWFyZ2luLXRvcDogMTBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5hZGRidG4ge1xuICBiYWNrZ3JvdW5kOiBub25lO1xuICBib3JkZXI6IG5vbmU7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggc3BhbiB7XG4gIGRpc3BsYXk6IGJsb2NrO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIHNwYW4udHBoaWQge1xuICB3aWR0aDogMzAlO1xuICBoZWlnaHQ6IDEycHg7XG4gIG1hcmdpbi10b3A6IDEycHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggc3Bhbi50cGh0aXRsZSB7XG4gIHdpZHRoOiA2MCU7XG4gIGhlaWdodDogMTJweDtcbiAgbWFyZ2luLXRvcDogMTJweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCBzcGFuLnRwaHR5cGUge1xuICB3aWR0aDogMjAlO1xuICBoZWlnaHQ6IDEycHg7XG4gIG1hcmdpbi10b3A6IDEycHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggc3Bhbi50cGhzdGF0dXMge1xuICB3aWR0aDogMTAwcHg7XG4gIGhlaWdodDogMTJweDtcbiAgbWFyZ2luLXRvcDogMTJweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCBzcGFuLnRwaGNvdW50IHtcbiAgd2lkdGg6IDQwcHg7XG4gIGhlaWdodDogMTJweDtcbiAgbWFyZ2luLXRvcDogMTJweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCBzcGFuLnRwaGRlc3Age1xuICB3aWR0aDogMTAwJTtcbiAgaGVpZ2h0OiAxMnB4O1xuICBtYXJnaW4tdG9wOiAxMnB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC50cGhtb3JlIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDEwcHg7XG4gIHJpZ2h0OiAxMHB4O1xuICBjb2xvcjogIzk5OTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCAuZG9jcm93IHtcbiAgZGlzcGxheTogZmxleDtcbiAgd2lkdGg6IDEwMCU7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggLmRvY3JvdyAuZG9jaW1nIHtcbiAgd2lkdGg6IDgwcHg7XG4gIGhlaWdodDogODBweDtcbiAgbWFyZ2luLXJpZ2h0OiAyMHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC5kb2Nyb3cgLmRvY2NvbnRlbnQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC5kb2Nyb3cgLmRvY2NvbnRlbnQgLmRvY3RpdGxlIHtcbiAgd2lkdGg6IDUwJTtcbiAgaGVpZ2h0OiAxMnB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC5kb2Nyb3cgLmRvY2NvbnRlbnQgLmRvY2NvbCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGZsZXgtZGlyZWN0aW9uOiByb3c7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggLmRvY3JvdyAuZG9jY29udGVudCAuZG9jY29sIC5kb2Njb2xkYXRhIHtcbiAgd2lkdGg6IDI1JTtcbiAgbWFyZ2luLXJpZ2h0OiAzMHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC5kb2Nyb3cgLmRvY2NvbnRlbnQgLmRvY2NvbCAuZG9jY29sZGF0YSAuZG9jZGF0ZSB7XG4gIHdpZHRoOiAxNTBweDtcbiAgaGVpZ2h0OiAxMnB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIGhyIHtcbiAgd2lkdGg6IDEwMCU7XG4gIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZGRkO1xuICBtYXJnaW46IDIwcHggMDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCAudGFyZ2V0anVzdGlmeSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgZmxleC1kaXJlY3Rpb246IHJvdztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCAudGFyZ2V0anVzdGlmeSAucGFnZXIge1xuICB3aWR0aDogMjUlO1xuICBoZWlnaHQ6IDMycHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggLnRhcmdldGp1c3RpZnkgLnNlYXJjaCB7XG4gIHdpZHRoOiAyNSU7XG4gIGhlaWdodDogMzJweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCAudGFibGVyb3cge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWFyb3VuZDtcbiAgZmxleC1kaXJlY3Rpb246IHJvdztcbiAgd2lkdGg6IDEwMCU7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggLnRhYmxlcm93IC50YWJsZXRpdGxlIHtcbiAgd2lkdGg6IDE4JTtcbiAgbWFyZ2luLXJpZ2h0OiAyJTtcbiAgaGVpZ2h0OiAzMnB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC5wcm9qZWN0LWxzdCB7XG4gIGJvcmRlcjogMXB4IHNvbGlkIHJnYmEoMjA0LCAyMDQsIDIwNCwgMC41KTtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBtaW4taGVpZ2h0OiAyNDJweDtcbiAgd2lkdGg6IDEwMCU7XG4gIHBhZGRpbmc6IDBweDtcbiAgbWFyZ2luLXRvcDogMjBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wcm9qbHN0bmdwaCAucHJvamVjdC1sc3QgLnByb2plY3QtbHN0LWhlYWRlciB7XG4gIG1pbi1oZWlnaHQ6IDE4MHB4O1xuICB3aWR0aDogMTAwJTtcbiAgZGlzcGxheTogZmxleDtcbiAgZmxleC1kaXJlY3Rpb246IHJvdztcbiAgcGFkZGluZzogMTVweDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC5wcm9qZWN0LWxzdCAucHJvamVjdC1sc3QtaGVhZGVyIC5wcm9qaW1nIHtcbiAgd2lkdGg6IDE2MHB4O1xuICBoZWlnaHQ6IDE2MHB4O1xuICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucHJvamxzdG5ncGggLnByb2plY3QtbHN0IC5wcm9qZWN0LWxzdC1oZWFkZXIgLnByb2pkZXQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTYwcHgpO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnByb2psc3RuZ3BoIC5wcm9qZWN0LWxzdCAucHJvamVjdC1sc3QtZm9vdGVyIHtcbiAgbWluLWhlaWdodDogNjBweDtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWJlZmY1O1xuICBwYWRkaW5nOiA4cHggMHB4ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2Vlbjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5saXN0c2VjdG9yIC52aWV3Y2xlYXIge1xuICBtaW4td2lkdGg6IDE2NXB4O1xuICBoZWlnaHQ6IDQwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAubGlzdHNlY3RvciAubGVmdG1haW5zcGFjZSAuc3ViY29udGVudCB7XG4gIG1heC13aWR0aDogMTAwJTtcbiAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gIG1hcmdpbi1yaWdodDogYXV0bztcbiAgbWFyZ2luLXRvcDogMjVweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5saXN0c2VjdG9yIC5sZWZ0bWFpbnNwYWNlIC5zdWJjb250ZW50IC53aWR0aG9mZmlyc3QsICNzdGFuZGFyZF9jdXN0b21pemVkIC5saXN0c2VjdG9yIC5sZWZ0bWFpbnNwYWNlIC5zdWJjb250ZW50IC5kZXNjcmlwdGl0bGVzZWN0b3IgLmRlc2NyaXB0aW9uY29udGVudCwgI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLmxpc3RzZWN0b3IgLmxlZnRtYWluc3BhY2UgLnN1YmNvbnRlbnQgLnNlY3RvcmhlaWdodCwgI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLmxpc3RzZWN0b3IgLmxlZnRtYWluc3BhY2UgLnN1YmNvbnRlbnQgLnNlY29uZHdpZHRoIHtcbiAgd2lkdGg6IDUwJTtcbiAgaGVpZ2h0OiA1NXB4O1xuICBtYXJnaW4tYm90dG9tOiAyNXB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLmxpc3RzZWN0b3IgLmxlZnRtYWluc3BhY2UgLnN1YmNvbnRlbnQgLnNlY29uZHdpZHRoIHtcbiAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5saXN0c2VjdG9yIC5sZWZ0bWFpbnNwYWNlIC5zdWJjb250ZW50IC5zZWN0b3JoZWlnaHQge1xuICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDQ1cHggIWltcG9ydGFudDtcbiAgbWFyZ2luLWJvdHRvbTogNnB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAubGlzdHNlY3RvciAubGVmdG1haW5zcGFjZSAuc3ViY29udGVudCAuZmlyc3R2aWV3Y29udGVudCBwIHtcbiAgd2lkdGg6IDM1JTtcbiAgaGVpZ2h0OiAyMHB4O1xuICBtYXJnaW4tYm90dG9tOiAyMHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLmxpc3RzZWN0b3IgLmxlZnRtYWluc3BhY2UgLnN1YmNvbnRlbnQgLmRlc2NyaXB0aXRsZXNlY3RvciBwIHtcbiAgd2lkdGg6IDIwJTtcbiAgaGVpZ2h0OiAxNXB4O1xuICBtYXJnaW4tYm90dG9tOiAyMHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLmxpc3RzZWN0b3IgLmxlZnRtYWluc3BhY2UgLnN1YmNvbnRlbnQgLmRlc2NyaXB0aXRsZXNlY3RvciAuZGVzY3JpcHRpb25jb250ZW50IHtcbiAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA4NXB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAubGlzdHNlY3RvciAuY2xlYXJwcm8sICNzdGFuZGFyZF9jdXN0b21pemVkIC5saXN0c2VjdG9yIC5hZGR2aWV3bG9hZCB7XG4gIG1pbi13aWR0aDogODBweDtcbiAgaGVpZ2h0OiA0MHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLmxpc3RzZWN0b3IgLmFkZHZpZXdsb2FkIHtcbiAgbWluLXdpZHRoOiA5NXB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAubGlzdHNlY3RvciAuYWxpZ25sb2FkIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5saXN0c2VjdG9yIC5hZGR2aWV3bG9hZCAuaGVpZ2h0b2ZidG4ge1xuICBoZWlnaHQ6IDQwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucGxhY2Vob2xkZXItY29udGVudCB7XG4gIGhlaWdodDogMzIwcHg7XG4gIGJhY2tncm91bmQ6ICMwMDA7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgYW5pbWF0aW9uLWR1cmF0aW9uOiAxLjdzO1xuICBhbmltYXRpb24tZmlsbC1tb2RlOiBmb3J3YXJkcztcbiAgYW5pbWF0aW9uLWl0ZXJhdGlvbi1jb3VudDogaW5maW5pdGU7XG4gIGFuaW1hdGlvbi10aW1pbmctZnVuY3Rpb246IGxpbmVhcjtcbiAgYW5pbWF0aW9uLW5hbWU6IHBsYWNlaG9sZGVyQW5pbWF0ZTtcbiAgYmFja2dyb3VuZDogI2Y2ZjdmODtcbiAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KHRvIHJpZ2h0LCAjZWVlIDIlLCAjZGRkIDE4JSwgI2VlZSAzMyUpO1xuICBiYWNrZ3JvdW5kLXNpemU6IDEzMDBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wbGFjZWhvbGRlci1jb250ZW50X2l0ZW0ge1xuICB3aWR0aDogMTAwJTtcbiAgaGVpZ2h0OiAyMHB4O1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHotaW5kZXg6IDI7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucGxhY2Vob2xkZXItY29udGVudF9pdGVtOmFmdGVyLFxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgLnBsYWNlaG9sZGVyLWNvbnRlbnRfaXRlbTpiZWZvcmUge1xuICB3aWR0aDogaW5oZXJpdDtcbiAgaGVpZ2h0OiBpbmhlcml0O1xuICBjb250ZW50OiBcIlwiO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG59XG5Aa2V5ZnJhbWVzIHBsYWNlaG9sZGVyQW5pbWF0ZSB7XG4gIDAlIHtcbiAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiAtNjUwcHggMDtcbiAgfVxuICAxMDAlIHtcbiAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiA2NTBweCAwO1xuICB9XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAucGFnZXRpdGxlIHtcbiAgYmFja2dyb3VuZDogIzAwMDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBhbmltYXRpb24tZHVyYXRpb246IDEuN3M7XG4gIGFuaW1hdGlvbi1maWxsLW1vZGU6IGZvcndhcmRzO1xuICBhbmltYXRpb24taXRlcmF0aW9uLWNvdW50OiBpbmZpbml0ZTtcbiAgYW5pbWF0aW9uLXRpbWluZy1mdW5jdGlvbjogbGluZWFyO1xuICBhbmltYXRpb24tbmFtZTogcGFnZXRpdGxlQW5pbWF0ZTtcbiAgYmFja2dyb3VuZDogI2Y2ZjdmODtcbiAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KHRvIHJpZ2h0LCAjZWVlIDIlLCAjZGRkIDE4JSwgI2VlZSAzMyUpO1xuICBiYWNrZ3JvdW5kLXNpemU6IDEzMDBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5wYWdldGl0bGU6YmVmb3JlIHtcbiAgd2lkdGg6IGluaGVyaXQ7XG4gIGhlaWdodDogaW5oZXJpdDtcbiAgY29udGVudDogXCJcIjtcbiAgcG9zaXRpb246IGFic29sdXRlO1xufVxuQGtleWZyYW1lcyBwYWdldGl0bGVBbmltYXRlIHtcbiAgMCUge1xuICAgIGJhY2tncm91bmQtcG9zaXRpb246IC02NTBweCAwO1xuICB9XG4gIDEwMCUge1xuICAgIGJhY2tncm91bmQtcG9zaXRpb246IDY1MHB4IDA7XG4gIH1cbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5lcnJvcnMge1xuICBjb2xvcjogI2RjNGM2NDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5tYXQtY2hlY2tib3gtZGlzYWJsZWQge1xuICBvcGFjaXR5OiAwLjU7XG4gIGN1cnNvcjogbm8tZHJvcDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmFwcHJvdmVkIHtcbiAgY29sb3I6ICMwMGE1NTE7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC51cGRhdGUge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmRlY2xpbmVkIHtcbiAgY29sb3I6ICNlZDFjMjc7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5uZXcge1xuICBjb2xvcjogI2Y0ODExZjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlcXVpcmVkZmllbHMgaDQge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlcXVpcmVkZmllbHMgLnllc25vIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlcXVpcmVkZmllbHMgLnllc25vIHAge1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlcXVpcmVkZmllbHMgLnllc25vIHAgc3BhbiB7XG4gIGNvbG9yOiAjZGM0YzY0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAueWVzbm8ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAueWVzbm8gcCB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAueWVzbm8gcCBzcGFuIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5yZWFkb25seWZpZWxkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmOCAhaW1wb3J0YW50O1xuICBjdXJzb3I6IG5vLWRyb3AgIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlYWRvbmx5ZmllbGQgaW5wdXRbcmVhZG9ubHldIHtcbiAgY3Vyc29yOiBuby1kcm9wICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50eHQtZ3J5IHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50eHQtZ3J5MyB7XG4gIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNwcm9maWxlIC5oaW50IHtcbiAgd2lkdGg6IDE2OHB4O1xuICB3b3JkLWJyZWFrOiBicmVhay13b3JkO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjcHJvZmlsZSAjdXBsb2FkZWQgLmZpbGVycyAubWF0LWZvcm0tZmllbGQge1xuICB3aWR0aDogMTYycHggIWltcG9ydGFudDtcbiAgaGVpZ2h0OiAxNjJweCAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjcHJvZmlsZSAjdXBsb2FkZWQgLmZpbGVycyBpbnB1dC5tYXQtaW5wdXQtZWxlbWVudCB7XG4gIG1hcmdpbi10b3A6IDByZW0gIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjOTk5OTk5O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjcHJvZmlsZSAjdXBsb2FkZWQgLmZpbGVycyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1mbGV4IHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgcGFkZGluZzogMCAycHggIWltcG9ydGFudDtcbiAgYm9yZGVyLXRvcDogMC40ZW0gc29saWQgdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlcjogMXB4IHNvbGlkIGN1cnJlbnRjb2xvciAhaW1wb3J0YW50O1xuICBib3JkZXItcmFkaXVzOiAxcHggIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXI6IDFweCBzb2xpZCBjdXJyZW50Y29sb3IgIWltcG9ydGFudDtcbiAgYm9yZGVyLXJhZGl1czogMXB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjcHJvZmlsZSAjdXBsb2FkZWQgLmZpbGVycyBtYXQtbGFiZWwge1xuICBjb2xvcjogIzk5OTk5OTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgbWF0LWxhYmVsIHNwYW4ge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkIGxhYmVsIHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBtYXJnaW4tdG9wOiAxcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIGlucHV0Lm1hdC1pbnB1dC1lbGVtZW50IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBoZWlnaHQ6IDE2MnB4ICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxNjJweCAhaW1wb3J0YW50O1xuICBtYXJnaW4tYm90dG9tOiAycHggIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCB7XG4gIHRvcDogLTAuNzVlbTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5kb2N1bWVudCBtYXQtbGFiZWwge1xuICBjb2xvcjogIzk5OTk5OTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5kb2N1bWVudCBpbWcge1xuICB3aWR0aDogMjBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5kb2N1bWVudCBtYXQtaWNvbiB7XG4gIGNvbG9yOiAjOTk5OTk5O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjcHJvZmlsZSAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcbiAgcGFkZGluZy1ib3R0b206IDBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5kb2N1bWVudCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlcjogbm9uZSAhaW1wb3J0YW50O1xuICBib3JkZXItcmFkaXVzOiAxcHggIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3Byb2ZpbGUgI3VwbG9hZGVkIC5kb2N1bWVudCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcbiAgYm9yZGVyLXJhZGl1czogMXB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtcmFkaW8tYnV0dG9uIC5tYXQtcmFkaW8tb3V0ZXItY2lyY2xlIHtcbiAgYm9yZGVyLWNvbG9yOiAjZDlkOWQ5O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXJhZGlvLWJ1dHRvbi5tYXQtYWNjZW50IC5tYXQtcmFkaW8taW5uZXItY2lyY2xlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2UyMDYxMyAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXJhZGlvLWJ1dHRvbi5tYXQtYWNjZW50Lm1hdC1yYWRpby1jaGVja2VkIC5tYXQtcmFkaW8tb3V0ZXItY2lyY2xlIHtcbiAgYm9yZGVyLWNvbG9yOiAjZDlkOWQ5O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXJhZGlvLWxhYmVsLWNvbnRlbnQge1xuICBjb2xvcjogIzAwMDAwMGNjO1xuICBmb250LXNpemU6IDE2cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNlbGwgLmRvY3VtZW50X2ltZyB7XG4gIHdpZHRoOiAzMnB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNlbGwgLnZpZXdkb2N1bWVudCB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmRhdGVyYW5nZXRpbWUgLm1kLWRycHBpY2tlciB7XG4gIHdpZHRoOiA2NTBweDtcbiAgcmlnaHQ6IDAgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMjBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmNsb3NlYW5kZGF0ZWljb24ge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3gtc2hhZG93OiBub25lO1xuICBmb250LXNpemU6IDE2cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5zdWJtaXRfYnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4td2lkdGg6IDExMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5zZXR1cF9idG4ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjODQ4NDg0ICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGhlaWdodDogNDVweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmNhbmNlbGJ0biB7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlOGU4ZTg7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtaW5rLWJhciB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC10YWItaGVhZGVyIHtcbiAgYm9yZGVyOiAwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC10YWItbGFiZWwtYWN0aXZlIC5jb250ZW50Y2lyY2xlIHtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiAxcHggc29saWQgI2ZmZiAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXRhYi1sYWJlbC1hY3RpdmUgcCB7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDEyNzlweCkge1xuICAjc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQge1xuICAgIGRpc3BsYXk6IGJsb2NrO1xuICB9XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQgLmZpbGVycyB7XG4gIHdpZHRoOiA1MCU7XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTI3OXB4KSB7XG4gICNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZpbGVfdXBsb2FkICN1cGxvYWRlZCAuZmlsZXJzIHtcbiAgICB3aWR0aDogMTAwJTtcbiAgfVxufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZmlsZV91cGxvYWQgI3VwbG9hZGVkIC5kb2N1bWVudCB7XG4gIHdpZHRoOiA1MCU7XG4gIHBhZGRpbmctbGVmdDogMzBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZpbGVfdXBsb2FkICN1cGxvYWRlZCAuZG9jdW1lbnQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZpbGVfdXBsb2FkICN1cGxvYWRlZCAuZG9jdW1lbnQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcbiAgbGVmdDogLTIzOXB4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDEyNzlweCkge1xuICAjc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQgLmRvY3VtZW50IHtcbiAgICB3aWR0aDogMTAwJTtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgfVxufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZmlsZV91cGxvYWQgI3VwbG9hZGVkIC5kb2N1bWVudCAuY2xvc2VfaWNvbnMge1xuICBkaXNwbGF5OiBibG9jaztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZpbGVfdXBsb2FkICN1cGxvYWRlZCAuZG9jdW1lbnQgLmRlbGV0ZV9pY29uIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZpbGVfdXBsb2FkICN1cGxvYWRlZCAuZG9jdW1lbnQgLnZpZXdfYnRuIHtcbiAgZGlzcGxheTogYmxvY2s7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAud29ya2NoZWNrYm94IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLndvcmtjaGVja2JveCAubWF0LWNoZWNrYm94LWlubmVyLWNvbnRhaW5lciB7XG4gIHdpZHRoOiAyMHB4O1xuICBoZWlnaHQ6IDIwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC53b3JrY2hlY2tib3ggLm1hdC1jaGVja2JveC1jaGVja2VkLm1hdC1hY2NlbnQgLm1hdC1jaGVja2JveC1iYWNrZ3JvdW5kIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAud29ya2NoZWNrYm94IC5tYXQtY2hlY2tib3gtZnJhbWUge1xuICBib3JkZXI6IDFweCBzb2xpZCAjYzRjNGM0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXNsaWRlLXRvZ2dsZS5tYXQtY2hlY2tlZCAubWF0LXNsaWRlLXRvZ2dsZS10aHVtYiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTE7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtc2xpZGUtdG9nZ2xlLm1hdC1jaGVja2VkIC5tYXQtc2xpZGUtdG9nZ2xlLWJhciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTA2Mjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC10YWItbGFiZWwge1xuICBvcGFjaXR5OiAxO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIG1hcmdpbi1yaWdodDogNXB4O1xuICBoZWlnaHQ6IDgwcHg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgcGFkZGluZzogMCAxMHB4O1xuICBtaW4td2lkdGg6IDEyNXB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXRhYi1sYWJlbDpudGgtY2hpbGQoMikge1xuICB3aWR0aDogMjUwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtdGFiLWxpc3Qge1xuICBvcGFjaXR5OiAxO1xuICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1yYWlzZWQtYnV0dG9uW2Rpc2FibGVkXTpub3QoW2NsYXNzKj1tYXQtZWxldmF0aW9uLXpdKSB7XG4gIGN1cnNvcjogbm8tZHJvcDtcbiAgb3BhY2l0eTogMC41O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNhcmQge1xuICBib3gtc2hhZG93OiAwIDAgNHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNhcmQgLm1hdC1jYXJkLWNvbnRlbnQgaW1nIHtcbiAgd2lkdGg6IDEwMHB4O1xuICBoZWlnaHQ6IDEwMHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNhcmQgLm1hdC1jYXJkLWNvbnRlbnQgLmNhcmRpbmZvIGg0IHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtY2FyZCAubWF0LWNhcmQtY29udGVudCAuY2FyZGluZm8gLmNlbnRyZV9pbmZvIHtcbiAgZ2FwOiAzMHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNhcmQgLm1hdC1jYXJkLWNvbnRlbnQgLmNhcmRpbmZvIC5jZW50cmVfaW5mbyBwIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtY2FyZCAubWF0LWNhcmQtY29udGVudCAuY2FyZGluZm8gLmNlbnRyZV9pbmZvIHAgc3BhbiB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNhcmQgLmNhcmRidG4ge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIG1hcmdpbi10b3A6IC0zNHB4O1xuICB3aWR0aDogOTMlO1xuICBib3JkZXItcmFkaXVzOiAyMHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogYmFzZWxpbmU7XG4gIGp1c3RpZnktY29udGVudDogZW5kO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWNhcmQgLmNhcmRidG4gYnV0dG9uIHtcbiAgYm9yZGVyLXJhZGl1czogMjBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnRhYnNjb250ZW50IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50YWJzY29udGVudCAuY29udGVudGNpcmNsZSB7XG4gIHdpZHRoOiAyOHB4O1xuICBoZWlnaHQ6IDI4cHg7XG4gIG1pbi13aWR0aDogMjhweDtcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50O1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgYm94LXNoYWRvdzogMCAwIDhweCByZ2JhKDUxLCA1MSwgNTEsIDAuMTUpO1xuICBib3JkZXI6IDFweCBzb2xpZCAjODQ4NDg0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAudGFic2NvbnRlbnQgLnRhYnRpdGxlIHAge1xuICBjb2xvcjogIzI2MjYyNjtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbiAgd2hpdGUtc3BhY2U6IG5vcm1hbDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnN1YnRpdGxlZm9ybSB7XG4gIGZvbnQtd2VpZ2h0OiA3MDA7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50aXRsZSBoNCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAudGl0bGUgLnN1YnRpdGxlIGg0IHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50aXRsZSAubGluZSB7XG4gIGZsZXg6IDQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50aXRsZSAubGluZSAubWF0LWRpdmlkZXIge1xuICB3aWR0aDogMTIlO1xuICBib3JkZXItdG9wLXdpZHRoOiAzcHg7XG4gIGJvcmRlci1jb2xvcjogI0VEMUMyNztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1pbnB1dC1lbGVtZW50IHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjNmJhNWVjO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZGF0ZV9leHAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlYWRvbmx5IGlucHV0W3JlYWRvbmx5XSB7XG4gIGN1cnNvcjogbm8tZHJvcDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1mb3JtLWZpZWxkLm1hdC1mb2N1c2VkLm1hdC1wcmltYXJ5IC5tYXQtc2VsZWN0LWFycm93IHtcbiAgY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtZm9ybS1maWVsZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjZGM0YzY0ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5maWx0ZXIge1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC51c2VyaW1nIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC51c2VyaW1nIGltZyB7XG4gIHdpZHRoOiAxNjhweDtcbiAgaGVpZ2h0OiAxNjhweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnVzZXJpbWcgaW1nOmhvdmVyIHtcbiAgdHJhbnNmb3JtOiBzY2FsZSgxLjEpO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAudXNlcmltZyBzcGFuIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIHdpZHRoOiAzMnB4O1xuICBoZWlnaHQ6IDMycHg7XG4gIGJvcmRlci1yYWRpdXM6IDIwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNjNGM0YzQ7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgdG9wOiAzM3B4O1xuICBsZWZ0OiAtNDRweDtcbiAgb3BhY2l0eTogMC41O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAudXNlcmltZyBzcGFuOmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNzcwO1xuICB0cmFuc2Zvcm06IHNjYWxlKDEuMSk7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC51c2VyaW1nIHNwYW46aG92ZXIgLm1hdC1pY29uIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtaWNvbiB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCAubWF0LWljb24ge1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuaWNvbmdyb3VwIC5tYXQtaWNvbiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGNvbG9yOiAjODQ4NDg0O1xuICBwYWRkaW5nOiAxMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZDlkOWQ5O1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG4gIHdpZHRoOiA0MHB4O1xuICBoZWlnaHQ6IDQwcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBmb250LXNpemU6IDI1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5pY29uZ3JvdXAgLm1hdC1pY29uLmFkZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmFkZF9pY29uIHtcbiAgY29sb3I6ICNmZmY7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XG4gIHBhZGRpbmc6IDE1cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBmb250LXNpemU6IDI1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5hcmFiaWNsYW5ndWFnZSBpbnB1dCxcbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmFyYWJpY2xhbmd1YWdlIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuYXJhYmljbGFuZ3VhZ2UgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdGV4dC1hbGlnbjogcmlnaHQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5hcmFiaWNsYW5ndWFnZSAubWF0LWVycm9yIHtcbiAgdGV4dC1hbGlnbjogcmlnaHQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5lZGl0YnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgcGFkZGluZzogNHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZWRpdGJ0bjpob3ZlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjc7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5jb3VyZWJveCB7XG4gIGJveC1zaGFkb3c6IDAgMCA0cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xuICBwYWRkaW5nOiA1cHggMTBweDtcbiAgbWFyZ2luOiAycHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5zdWJ0aXRsZWZvcm0ge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuc3VidGl0bGVmb3JtIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuaWNvbmdyb3VwIC5mYSB7XG4gIGNvbG9yOiAjODQ4NDg0O1xuICBib3JkZXI6IDFweCBzb2xpZCAjODQ4NDg0O1xuICAtd2Via2l0LXRleHQtc3Ryb2tlLXdpZHRoOiAwcHggIWltcG9ydGFudDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogIzg0ODQ4NCAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuaWNvbmdyb3VwIC5tYXQtaWNvbiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkOWQ5ZDk7XG4gIHdpZHRoOiA0MHB4O1xuICBoZWlnaHQ6IDQwcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBmb250LXNpemU6IDMwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNkb2N1bWVudHMgI3VwbG9hZGVkLFxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZG9jdW1lbnRzICN1cGxvYWRlZCB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG5AbWVkaWEgKG1heC13aWR0aDogOTU5cHgpIHtcbiAgI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjZG9jdW1lbnRzICN1cGxvYWRlZCxcbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmRvY3VtZW50cyAjdXBsb2FkZWQge1xuICAgIGRpc3BsYXk6IGJsb2NrO1xuICB9XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNkb2N1bWVudHMgI3VwbG9hZGVkIC5maWxlcnMsXG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5kb2N1bWVudHMgI3VwbG9hZGVkIC5maWxlcnMge1xuICB3aWR0aDogNTAlO1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDk1OXB4KSB7XG4gICNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI2RvY3VtZW50cyAjdXBsb2FkZWQgLmZpbGVycyxcbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmRvY3VtZW50cyAjdXBsb2FkZWQgLmZpbGVycyB7XG4gICAgd2lkdGg6IDEwMCU7XG4gIH1cbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI2RvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50LFxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQge1xuICB3aWR0aDogNTAlO1xuICBwYWRkaW5nLWxlZnQ6IDMwcHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0LFxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCxcbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmRvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI2RvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCxcbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmRvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCB7XG4gIGxlZnQ6IC0yMzlweDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA5NTlweCkge1xuICAjc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCxcbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmRvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IHtcbiAgICB3aWR0aDogMTAwJTtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgfVxufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLmNsb3NlX2ljb25zLFxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLmNsb3NlX2ljb25zIHtcbiAgZGlzcGxheTogYmxvY2s7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAuZGVsZXRlX2ljb24sXG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5kb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAuZGVsZXRlX2ljb24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLnZpZXdfYnRuLFxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLnZpZXdfYnRuIHtcbiAgZGlzcGxheTogYmxvY2s7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWFzdGVyUGFnZVRvcCB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5hdmFpbGFibGVkYXRlIHtcbiAgcGFkZGluZzogMTVweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmF2YWlsYWJsZXRhYmxlIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBtYXJnaW46IDEwcHggMHB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuYXZhaWxhYmxldGFibGUgLm1hdC1jZWxsIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5hdmFpbGFibGV0YWJsZSAubWF0LWhlYWRlci1jZWxsIHtcbiAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuYXZhaWxhYmxldGFibGUgLm1hdC1yb3c6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5hdmFpbGFibGV0YWJsZSAjc2VhcmNocm93LFxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuYXZhaWxhYmxldGFibGUgI2ZpbHRlcnNob3cge1xuICBiYWNrZ3JvdW5kOiAjZmJmYmZiICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogbm9uZTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmF2YWlsYWJsZXRhYmxlIC5zZXJhY2hyb3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmF2YWlsYWJsZXRhYmxlIC5zZXJhY2hyb3cgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5hd2FyZWR0YWJsZSB7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgbWFyZ2luOiAxMHB4IDBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmF3YXJlZHRhYmxlIC5tYW5hZ2VvcHRpb25zIHtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmF3YXJlZHRhYmxlIC5tYXQtcm93IHtcbiAgd2lkdGg6IGZpdC1jb250ZW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuYXdhcmVkdGFibGUgLm1hdC1yb3c6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5hd2FyZWR0YWJsZSAubWF0LWNlbGwge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmF3YXJlZHRhYmxlIC5tYXQtaGVhZGVyLWNlbGwge1xuICBjb2xvcjogIzYyNjM2NiAhaW1wb3J0YW50O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1zZWxlY3QtdmFsdWUge1xuICBjb2xvcjogIzYyNjM2NjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBtYXJnaW46IDBweCAxMHB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5yZW5ld2FsIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XG4gIHBhZGRpbmc6IDE1cHg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlbmV3YWwgLnJlbmV3YWxfaW5mbyB7XG4gIGdhcDogMzBweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAucmVuZXdhbCAucmVuZXdhbF9pbmZvIC5tYXQtZGl2aWRlciB7XG4gIGhlaWdodDogNTFweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlbmV3YWwgLnJlbmV3YWxfaW5mbyAubWF0LWRpdmlkZXIgLm1hdC1kaXZpZGVyLXZlcnRpY2FsIHtcbiAgYm9yZGVyLXJpZ2h0LWNvbG9yOiAjYzRjNGM0O1xuICBib3JkZXItcmlnaHQtd2lkdGg6IDJweCAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAucmVuZXdhbCAucmVuZXdhbF9pbmZvIHAge1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlbmV3YWwgLnJlbmV3YWxfaW5mbyBwIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlbmV3YWwgLnJlbmV3YWxfaW5mbyAucmVtYWluZGVyIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI0VEMUMyNztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBwYWRkaW5nOiA4cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5yZW5ld2FsIC5yZW5ld2FsX2luZm8gLnJlbWFpbmRlciBwIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5yZW5ld2FsIC5yZW5ld2FsX2luZm8gLnJlbWFpbmRlciBwIHNwYW4ge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJlbmV3YWwgLnZpZXdidG4ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xuICBjb2xvcjogI2ZmZjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnN1Y2Nlc3MgLmNlbnRlcmNvbnRlbnQge1xuICBoZWlnaHQ6IDcxdmg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5zdWNjZXNzIC5zdWNjZXNzX2ljb24ge1xuICB3aWR0aDogNzJweDtcbiAgaGVpZ2h0OiA3MnB4O1xuICBib3JkZXItcmFkaXVzOiA1MHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBib3JkZXI6IDNweCBzb2xpZCAjMDBhNTUxO1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnN1Y2Nlc3MgLnN1Y2Nlc3NfaWNvbiAubWF0LWljb24ge1xuICBmb250LXNpemU6IDUwcHg7XG4gIGNvbG9yOiAjMDBhNTUxO1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnN1Y2Nlc3MgLnN1Y2Nlc19tc2cgaDQge1xuICBjb2xvcjogIzAwYTU1MTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnN1Y2Nlc3MgLnN1Y2Nlc19tc2cgcCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuc3VjY2VzcyAuc3VjY2VzX21zZyAudmlld2Zvcm0ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3O1xuICBjb2xvcjogI2ZmZjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnNlY29uZHRhYiAubWF0LWZvcm0tZmllbGQgLm1hdC1zZWxlY3QubWF0LXNlbGVjdC1kaXNhYmxlZCAubWF0LXNlbGVjdC1hcnJvdzo6YmVmb3JlIHtcbiAgY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5kZWNsaW5lIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI0VEMUMyNztcbiAgYm9yZGVyLXJhZGl1czogM3B4O1xuICBwYWRkaW5nOiAxNXB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmOGY4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZGVjbGluZSBoNCB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZGVjbGluZSBwIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5jYXJkIHtcbiAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XG4gIHBhZGRpbmc6IDE1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5jYXJkZXIge1xuICBib3gtc2hhZG93OiAwIDAgNHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmNhcmRlciAucmFuZ2VkYXRlIHtcbiAgcGFkZGluZzogMTVweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZpbHRlciAuZmEge1xuICBjb2xvcjogdHJhbnNwYXJlbnQ7XG4gIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDFweDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogI2ZmZjtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI3JlZ2FwcCAuY2xvc2VhbmRkYXRlaWNvbWF4IHtcbiAgdG9wOiAxNHB4ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNzZWFyY2hyb3csXG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNmaWx0ZXJzaG93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmU7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNzZWFyY2hyb3cgLnNlcmFjaHJvdyxcbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgI2ZpbHRlcnNob3cgLnNlcmFjaHJvdyB7XG4gIGJhY2tncm91bmQ6ICNmOGY4ZjggIWltcG9ydGFudDtcbiAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAjc2VhcmNocm93IC5zZXJhY2hyb3cgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUsXG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlICNmaWx0ZXJzaG93IC5zZXJhY2hyb3cgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gICNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICB9XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICB9XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5zY3JvbGxkYXRhIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAxO1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhciB7XG4gIHdpZHRoOiA2cHg7XG4gIGhlaWdodDogNXB4O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xuICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50YWJmb3JjbGllbnRlbGVuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAudGFiZm9yY2xpZW50ZWxlbmV3IC5tYW5hZ2VvcHRpb25zIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjYWNhY2FjO1xufVxuI3N0YW5kYXJkX2N1c3RvbWl6ZWQgI3N0YW5kYXJkX2NvdXJzZSAuaHJzdGFnIHtcbiAgcGFkZGluZzogNXB4IDEwcHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG4gIGJvcmRlci1yYWRpdXM6IDZweDtcbiAgbWFyZ2luLWxlZnQ6IDE1cHg7XG4gIG1pbi13aWR0aDogODJweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hc3Rlci1tZW51IC5tYXQtbWVudS1jb250ZW50IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwMDtcbiAgY29sb3I6ICNmZmY7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZDlkOWQ5ICFpbXBvcnRhbnQ7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC5tYXQtc29ydC1oZWFkZXItYXJyb3cge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLm5vZm91bmQge1xuICBtYXJnaW4tdG9wOiA1JTtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkICNzdGFuZGFyZF9jb3Vyc2UgLnJhbmdlZGF0ZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmYmZiZmI7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50aW1lcGlja2Vyd2lkdGgge1xuICBtYXgtd2lkdGg6IDg1cHg7XG59XG4jc3RhbmRhcmRfY3VzdG9taXplZCAjc3RhbmRhcmRfY291cnNlIC50aW1lcGlja2Vyd2lkdGggLm1hdC1pY29uIHtcbiAgZm9udC1zaXplOiAyMHB4O1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC5ib3JkZXJzbG90IHtcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIHBsYWNlLWNvbnRlbnQ6IGNlbnRlciBjZW50ZXIgIWltcG9ydGFudDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC53LTE1MCB7XG4gIHdpZHRoOiAxNTBweDtcbn1cbiNzdGFuZGFyZF9jdXN0b21pemVkIC51c3Jmcm0ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uICFpbXBvcnRhbnQ7XG59XG5cbi5tYXQtYnV0dG9uLWZvY3VzLW92ZXJsYXkge1xuICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XG59XG5cbi5vcHRpb24tbGlzdGluZyBkaXYge1xuICBtYXJnaW46IDAgIWltcG9ydGFudDtcbn1cblxuLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBwYWRkaW5nOiA2cHggMTBweDtcbiAgYmFja2dyb3VuZDogI2U5ZWRmMDtcbn1cbi5zZWFyY2hpbm11bHRpc2VsZWN0IGlucHV0Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVyIHtcbiAgY29sb3I6ICM3ZjhmYTMgIWltcG9ydGFudDtcbn1cbi5zZWFyY2hpbm11bHRpc2VsZWN0IGkge1xuICBjb2xvcjogIzdmOGZhMyAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXJpZ2h0OiA2cHg7XG59XG4uc2VhcmNoaW5tdWx0aXNlbGVjdCAuc2VhcmNoc2VsZWN0IHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDI1cHgpICFpbXBvcnRhbnQ7XG59XG4uc2VhcmNoaW5tdWx0aXNlbGVjdCAucmVzZXRpY29uIHtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuXG4uc2VsZWN0X3dpdGhfc2VhcmNoIHtcbiAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xuICBtYXgtaGVpZ2h0OiAxMDAlICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi10b3A6IDUwcHggIWltcG9ydGFudDtcbiAgbWFyZ2luLWJvdHRvbTogMTVweCAhaW1wb3J0YW50O1xufVxuXG4uc2VsZWN0X3dpdGhfb3B0aW9uIHtcbiAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xuICBtYXgtaGVpZ2h0OiAxMDAlICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi10b3A6IDQ5cHggIWltcG9ydGFudDtcbiAgbWFyZ2luLWJvdHRvbTogMTVweCAhaW1wb3J0YW50O1xufVxuLnNlbGVjdF93aXRoX29wdGlvbi5tdWx0aXBsZSB7XG4gIG1hcmdpbi10b3A6IDQ4cHggIWltcG9ydGFudDtcbiAgbWFyZ2luLWxlZnQ6IDI1cHg7XG4gIG1pbi13aWR0aDogY2FsYygxMDAlICsgMjhweCkgIWltcG9ydGFudDtcbn1cblxuLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBwYWRkaW5nOiAxMHB4IDEwcHg7XG4gIGJhY2tncm91bmQ6ICNlOWVkZjA7XG4gIG1hcmdpbjogMTBweDtcbn1cblxuLnNlYXJjaHNlbGVjdCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWxlZnQ6IDEwcHg7XG59XG5cbi5tYXQtb3B0aW9uLm1hdC1hY3RpdmUge1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xuICBjb2xvcjogcmdiYSgwLCAwLCAwLCAwLjg3KTtcbn1cblxuLm9wdGlvbi1saXN0aW5nIHtcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgb3ZlcmZsb3cteTogYXV0bztcbiAgbWF4LWhlaWdodDogMjkwcHg7XG59XG5cbi5vcHRpb24tbGlzdGluZzo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogN3B4O1xufVxuXG4vKiBUcmFjayAqL1xuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG5cbi8qIEhhbmRsZSAqL1xuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XG4gIGJhY2tncm91bmQ6ICNFRDFDMjc7XG59XG5cbi8qIGhvdmVyICovXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogI0VEMUMyNztcbn1cblxuLm15UGFuZWxDbGFzcyB7XG4gIG1hcmdpbjogMzZweCAwcHg7XG59XG5cbi5tYXQtbWVudS1wYW5lbC50YWJsZV9tZW51IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzY2NjY2NiAhaW1wb3J0YW50O1xufVxuLm1hdC1tZW51LXBhbmVsLnRhYmxlX21lbnUgLm1hdC1tZW51LWl0ZW0ge1xuICBsaW5lLWhlaWdodDogMzZweDtcbiAgaGVpZ2h0OiAzMXB4O1xuICBjb2xvcjogI2ZmZjtcbn1cblxuLm1hdC1zZWxlY3QtZGlzYWJsZWQgLm1hdC1zZWxlY3QtdmFsdWUge1xuICBjdXJzb3I6IG5vLWRyb3A7XG4gIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XG59XG5cbi5tYXQtbWVudS1wYW5lbC5tZW51LXBhbmVsIHtcbiAgbWFyZ2luLXRvcDogN3B4O1xuICBtaW4td2lkdGg6IDIzMHB4O1xufVxuLm1hdC1tZW51LXBhbmVsLm1lbnUtcGFuZWwgLm1hdC1tZW51LWl0ZW06aG92ZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cblxuLm1hdC1kaWFsb2ctY29udGFpbmVyIHtcbiAgcGFkZGluZzogMjRweCAhaW1wb3J0YW50O1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogMTM2NnB4KSB7XG4gICNyZWdhcHAgLm1kLWRycHBpY2tlci5kb3VibGUge1xuICAgIGxlZnQ6IDAgIWltcG9ydGFudDtcbiAgfVxufVxuLnNlbGVjdF93aXRoX3NlYXJjaC5tdWx0aXBsZSB7XG4gIG1hcmdpbi10b3A6IDU1cHggIWltcG9ydGFudDtcbiAgbWFyZ2luLWxlZnQ6IDI1cHg7XG4gIG1pbi13aWR0aDogY2FsYygxMDAlICsgMjdweCkgIWltcG9ydGFudDtcbn1cblxuLndoZW50b290bHRpcGFkZGVkIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzY2NjY2NiAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZjtcbiAgbWluLWhlaWdodDogNDVweCAhaW1wb3J0YW50O1xufVxuLndoZW50b290bHRpcGFkZGVkIC5tYXQtbWVudS1pdGVtIHtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiAzMHB4ICFpbXBvcnRhbnQ7XG4gIGxpbmUtaGVpZ2h0OiAyMHB4ICFpbXBvcnRhbnQ7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/standardcourses/standardcourses.component.ts":
  /*!**********************************************************************!*\
    !*** ./src/app/modules/standardcourses/standardcourses.component.ts ***!
    \**********************************************************************/

  /*! exports provided: MY_FORMATS, StandardcoursesComponent, Modalavailabledate */

  /***/
  function srcAppModulesStandardcoursesStandardcoursesComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "MY_FORMATS", function () {
      return MY_FORMATS;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "StandardcoursesComponent", function () {
      return StandardcoursesComponent;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "Modalavailabledate", function () {
      return Modalavailabledate;
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


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var rxjs_internal_ReplaySubject__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! rxjs/internal/ReplaySubject */
    "./node_modules/rxjs/internal/ReplaySubject.js");
    /* harmony import */


    var rxjs_internal_ReplaySubject__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(rxjs_internal_ReplaySubject__WEBPACK_IMPORTED_MODULE_8__);
    /* harmony import */


    var _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/modules/profilemanagement/profile.service */
    "./src/app/modules/profilemanagement/profile.service.ts");
    /* harmony import */


    var _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/@shared/filee/filee */
    "./src/app/@shared/filee/filee.ts");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @app/config/BGIConfig/bgi-jsonconfig-services */
    "./src/app/config/BGIConfig/bgi-jsonconfig-services.ts");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
    /* harmony import */


    var _angular_material_sort__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @angular/material/sort */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! @app/modules/registration/registration.service */
    "./src/app/modules/registration/registration.service.ts");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_17__);
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! moment */
    "./node_modules/moment/moment.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_18___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_18__);
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _app_services_application_service__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(
    /*! @app/services/application.service */
    "./src/app/services/application.service.ts");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_services_batch_service__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(
    /*! @app/services/batch.service */
    "./src/app/services/batch.service.ts");
    /* harmony import */


    var _app_shared_format_datepicker__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(
    /*! @app/@shared/format-datepicker */
    "./src/app/@shared/format-datepicker.ts");
    /* harmony import */


    var _app_modules_profilemanagement_animation__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(
    /*! @app/modules/profilemanagement/animation */
    "./src/app/modules/profilemanagement/animation.ts");
    /* harmony import */


    var _angular_animations__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(
    /*! @angular/animations */
    "./node_modules/@angular/animations/__ivy_ngcc__/fesm2015/animations.js");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");

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
    var ELEMENT_DATA = [{
      position: 1,
      awarding: 'NABET',
      lastaudited: '10-1-2023',
      document: 'PDF',
      status: 'A',
      addedon: '10-1-2023',
      lastupdated: 20 - 1 - 2023
    }, {
      position: 2,
      awarding: 'NABET',
      lastaudited: '10-1-2023',
      document: 'PDF',
      status: 'D',
      addedon: '10-1-2023',
      lastupdated: 20 - 1 - 2023
    }, {
      position: 3,
      awarding: 'NABET',
      lastaudited: '10-1-2023',
      document: 'PDF',
      status: 'U',
      addedon: '10-1-2023',
      lastupdated: 20 - 1 - 2023
    }, {
      position: 4,
      awarding: 'NABET',
      lastaudited: '10-1-2023',
      document: 'PDF',
      status: 'N',
      addedon: '10-1-2023',
      lastupdated: 20 - 1 - 2023
    }];
    var BranchList_Data = [{
      position: 1,
      applictionno: 'General Electric',
      offictype: 'Main Branch',
      branchname: 'Direct Contract',
      courtype: 'Standard',
      coursetitle: 'cyber Security',
      coursecate: 'computer sicence',
      requestfor: 'Training',
      coursedeliver: 'Arabian Traning',
      applicationstatus: '2',
      certification: 'A',
      dateofexpiry: '23-04-2024',
      addedon: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }, {
      position: 2,
      applictionno: 'General Electric',
      offictype: 'Main Branch',
      branchname: 'Direct Contract',
      courtype: 'Standard',
      coursetitle: 'cyber Security',
      coursecate: 'computer sicence',
      requestfor: 'Training',
      coursedeliver: 'Arabian Traning',
      applicationstatus: '8',
      certification: 'E',
      dateofexpiry: '23-04-2024',
      addedon: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }, {
      position: 3,
      applictionno: 'General Electric',
      offictype: 'Main Branch',
      branchname: 'Direct Contract',
      courtype: 'Standard',
      coursetitle: 'cyber Security',
      coursecate: 'computer sicence',
      requestfor: 'Training',
      coursedeliver: 'Arabian Traning',
      applicationstatus: '3',
      certification: 'N',
      dateofexpiry: '23-04-2024',
      addedon: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }, {
      position: 4,
      applictionno: 'General Electric',
      offictype: 'Main Branch',
      branchname: 'Direct Contract',
      courtype: 'Standard',
      coursetitle: 'cyber Security',
      coursecate: 'computer sicence',
      requestfor: 'Training',
      coursedeliver: 'Arabian Traning',
      applicationstatus: '5',
      certification: 'E',
      dateofexpiry: '23-04-2024',
      addedon: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }, {
      position: 5,
      applictionno: 'General Electric',
      offictype: 'Main Branch',
      branchname: 'Direct Contract',
      courtype: 'Standard',
      coursetitle: 'cyber Security',
      coursecate: 'computer sicence',
      requestfor: 'Training',
      coursedeliver: 'Arabian Traning',
      applicationstatus: '7',
      certification: 'N',
      dateofexpiry: '23-04-2024',
      addedon: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }, {
      position: 6,
      applictionno: 'General Electric',
      offictype: 'Main Branch',
      branchname: 'Direct Contract',
      courtype: 'Standard',
      coursetitle: 'cyber Security',
      coursecate: 'computer sicence',
      requestfor: 'Training',
      coursedeliver: 'Arabian Traning',
      applicationstatus: '9',
      certification: 'A',
      dateofexpiry: '23-04-2024',
      addedon: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }];
    var Course_DATA = [{
      position: 1,
      coursetitle: 'Workshop',
      courseduration: '1 year',
      courselevel: 'Level 1',
      coursecat: 'Fire and safety',
      coursetest: 'Fire and safety',
      status: 'APPROVED',
      add: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }]; // const staff_DATA: staffData[] = [
    //   { position: 1, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'A', competcard: 'P' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
    //   { position: 2, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'U', competcard: 'E' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
    //   { position: 3, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'D', competcard: 'EP' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
    //   { position: 4, civilnumb: '10610798', staffname: 'Muhammed', age: '34', rolecourse: 'Totue', coursesubcat: 'light' , status: 'N', competcard: 'A' , add: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
    // ];

    var Eduction_DATA = [{
      position: 1,
      institute: 'National Training Institute (NTI)',
      degree: '',
      yearjoin: '10-10-2012',
      yearpass: '10-10-2014',
      grade: 'A Grade',
      addedu: '10-1-2023',
      lastUpdated: 20 - 1 - 2023
    }];
    var Work_DATA = [{
      position: 1,
      organname: 'KHDA',
      datejoin: '10-10-2015',
      worktill: '10-10-2022',
      desig: 'Tutor',
      addedu: '10-10-2022',
      lastUpdated: '20-1-2023'
    }]; // const timetrack_Data: Timedata[] = [
    //   { position: 1, selecteddate: 'Sun 01-Jan-2023', dayschedule:'' , start: '', },
    // ];

    var StandardcoursesComponent = /*#__PURE__*/function () {
      function StandardcoursesComponent(formBuilder, el, translate, remoteService, profileService, cookieService, appservice, regService, dialog, security, localstorage, myRoute, secuirty, batchService, toastr, routeid) {
        _classCallCheck(this, StandardcoursesComponent);

        this.formBuilder = formBuilder;
        this.el = el;
        this.translate = translate;
        this.remoteService = remoteService;
        this.profileService = profileService;
        this.cookieService = cookieService;
        this.appservice = appservice;
        this.regService = regService;
        this.dialog = dialog;
        this.security = security;
        this.localstorage = localstorage;
        this.myRoute = myRoute;
        this.secuirty = secuirty;
        this.batchService = batchService;
        this.toastr = toastr;
        this.routeid = routeid;
        this.staffsubcat = [];
        this.showbranch = false;
        this.uploadlength = [];
        this.saveproceed = false;
        this.coursesavebtn = false;
        this.docsavebtn = false;
        this.loaderformeducation = false;
        this.loaderformwork = false;
        this.displayedColumns = ['irm_intlrecogname_en', 'last_aud', 'url', 'status', 'created_on', 'updated_on', 'action'];
        this.BranchListData = ['applictionno', 'offictype', 'branchname', 'courtype', 'coursetitle', 'coursecate', 'requestfor', 'coursedeliver', 'dateofexpiry', 'applicationstatus', 'certification', 'addedon', 'lastUpdated', 'action'];
        this.courseListData = ['coursetitle', 'courseduration', 'courselevel', 'coursecat', 'coursetest', 'status', 'add', 'lastUpdated', 'action'];
        this.staffListData = ['civilnumb', 'staffname', 'age', 'rolecourse', 'coursesubcat', 'status', 'add', 'lastUpdated', 'action'];
        this.educationList = ['institute', 'degree', 'yearjoin', 'yearpass', 'grade', 'addedu', 'lastUpdated', 'action'];
        this.workExperienceList = ['organname', 'datejoin', 'worktill', 'desig', 'addedu', 'lastUpdated', 'action'];
        this.courseData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](Course_DATA);
        this.BatchtrainingData = ['selecteddate', 'schedule', 'start'];
        this.standardTemplate = 'course';
        this.apptype = 'new';
        this.staffapptype = 'new';
        this.staffeduapptype = 'new';
        this.staffworkapptype = 'new';
        this.interapptype = 'new';
        this.staffotherdetails = false;
        this.saveandproceed = true;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_7__["ErrorStateMatcher"]();
        this.filteredSector = new rxjs_internal_ReplaySubject__WEBPACK_IMPORTED_MODULE_8__["ReplaySubject"](1);
        this.sectorFilter = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]();
        this.filteredBussrc = new rxjs_internal_ReplaySubject__WEBPACK_IMPORTED_MODULE_8__["ReplaySubject"](1);
        this.bussrcFilter = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]();
        this.hidden = false;
        this.ShowHide = true;
        this.add_btn = true;
        this.operatcont = false;
        this.international = false;
        this.courses = false;
        this.staffform = false;
        this.Submitted = true;
        this.renewal = true;
        this.decline = true; // maxDate = new Date();

        this.maximumdate = moment__WEBPACK_IMPORTED_MODULE_18___default()();
        this.filtername = "Hide Filter";
        this.countryselect = '1';
        this.hidefilder = true;
        this.length = '';
        this.second = '';
        this.third = '';
        this.four = '';
        this.appstatus = '';
        this.app_type = '';
        this.prodpk = '';
        this.apptemppk = '';
        this.editOption = true;
        this.updated = true;
        this.isValid = true;
        this.isValided = true;
        this.valided = true;
        this.validture = true;
        this.others = false;
        this.perpage = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__["BgiJsonconfigServices"].bgiConfigData.configuration.enterpriseAdminPerpage;
        this.bgiConfigJson = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__["BgiJsonconfigServices"].bgiConfigData.configuration;
        this.tog = "";
        this.finalpermissionarray = [];
        this.page = 10;
        this.page1 = 10;
        this.page2 = 10;
        this.page3 = 10;
        this.page4 = 10;
        this.page5 = 10;
        this.ageinput = false;
        this.paginationSet = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__["BgiJsonconfigServices"].bgiConfigData.configuration.enterpriseAdminPaginatonSet;
        this.newstaff = true;
        this.expandedElement = false;
        this.spinnerButtonOption = {
          active: false,
          text: 'Verified',
          spinnerSize: 15,
          raised: false,
          stroked: false,
          // buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate',
          type: 'button'
        };
        this.mattab = 0;
        this.genderShow = false;
        this.courselist = [];
        this.subcategory = [];
        this.interreg = [];
        this.countrylist = [];
        this.rolemst = [];
        this.contacttypemst = [];
        this.countrymst = [];
        this.statemst = [];
        this.educationlvl = [];
        this.languages = [];
        this.dayschedule = [];
        this.state = [];
        this.citymst = [];
        this.citylist = [[]];
        this.unit = [];
        this.firstgrid = [];
        this.branchlist = [];
        this.reqformst = [];
        this.deliverto = [];
        this.staffs = [];
        this.applyinternatdata = [];
        this.interdata = [];
        this.docmst = [];
        this.batchtraningdata_data = [];
        this.contentinputloader = false;
        this.mcpPk = '';
        this.oman = true;
        this.nonoman = true;
        this.noteHideShow = false;
        this.maindata = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.tblplaceholder = false;
        this.gendershow = true;
        this.ageShow = true;
        this.deleteicon = true;
        this.hiddenbtn = false;
        this.loaderform = false;
        this.fileerror = true;
        this.availablepk = 64;
        this.avaliabledate = true;
        this.weekend = true;
        this.holiday = true;
        this.spinnerButtonOptionsmem = {
          active: false,
          text: 'Verify',
          spinnerSize: 15,
          raised: false,
          stroked: false,
          // buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate',
          type: 'button'
        };
        this.spinnerButtonOptionscr = {
          active: false,
          text: 'Verify',
          spinnerSize: 15,
          raised: false,
          stroked: false,
          // buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate',
          type: 'button'
        };
        this.locale = {
          format: 'DD-MM-YYYY'
        };
        this.ranges = {
          'Today': [moment__WEBPACK_IMPORTED_MODULE_18___default()(), moment__WEBPACK_IMPORTED_MODULE_18___default()()],
          'Yesterday': [moment__WEBPACK_IMPORTED_MODULE_18___default()().subtract(1, 'days'), moment__WEBPACK_IMPORTED_MODULE_18___default()().subtract(1, 'days')],
          'Last 7 Days': [moment__WEBPACK_IMPORTED_MODULE_18___default()().subtract(6, 'days'), moment__WEBPACK_IMPORTED_MODULE_18___default()()],
          'Last 30 Days': [moment__WEBPACK_IMPORTED_MODULE_18___default()().subtract(29, 'days'), moment__WEBPACK_IMPORTED_MODULE_18___default()()],
          'This Month': [moment__WEBPACK_IMPORTED_MODULE_18___default()().startOf('month'), moment__WEBPACK_IMPORTED_MODULE_18___default()().endOf('month')],
          'Last Month': [moment__WEBPACK_IMPORTED_MODULE_18___default()().subtract(1, 'month').startOf('month'), moment__WEBPACK_IMPORTED_MODULE_18___default()().subtract(1, 'month').endOf('month')]
        };
        this.today = new Date();
        this.maxDate = new Date();
        this.startDate = new Date('2023-02-23');
        this.endDate = new Date('2023-02-28');
        this.days2 = ['Sunday', 'Wednesday'];
        this.startTime = '10:30';
        this.endTime = '11:30';
        this.ifarbic = false;
        this.languagelist = [{
          "id": "1",
          "languageName": "English",
          "languagecode": "en",
          "CountryMst_Pk": "136",
          "dir": "ltr"
        }, {
          "id": "2",
          "languageName": "Arabic",
          "languagecode": "ar",
          "CountryMst_Pk": "31",
          "dir": "rtl"
        }];
        this.dir = 'ltr'; //filterformcontral name

        this.Awarding = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.appl_form = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.officetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.bran_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.coures_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.course_titles = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.course_cat = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.requested = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.courdeliver = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.appl_status = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.cert = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.date_expiry = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.addedon_branch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.lastUpdated_branch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.Statusone = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.LastAudited = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.LastUpdated = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.Status = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.course_title = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.course_dura = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.course_level = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.course_cate = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.course_test = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.StatusCour = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.adddoncour = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.LastUpdatedcour = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.civil_numb = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.staff_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.age = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.role_course = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.cours_sub_cate = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.compcard = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.institute = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.degree = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.year_join = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.year_pass = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.yearpass = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.grade = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.add_On = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.Last_Date = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.Addedon = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.oranisation = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.date_joined = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.work_till = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.designation = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.add_edOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.date_last = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.range_date = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.dateselect = true;
        this.dateFilterSt = '';
        this.dateFilterEd = '';
        this.daterange = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required); // totaltime = '00:00';

        this.formattedTime = '00:00';
        this.isCheckboxDisabled = false;
        this.cleardate = false;
        this.worktilled = true;
        this.notallowed = false;
        this.userForm = this.formBuilder.group({
          phones: this.formBuilder.array([this.formBuilder.control(null)])
        });
      }

      _createClass(StandardcoursesComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this = this;

          this.userForm = this.formBuilder.group({
            sstartdata: [''],
            senddata: ['']
          });
          this.checkQueryParams();

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect.languagecode);
            this.dir = _toSelect.dir;
          }

          if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
            this.ifarbic = true;
          } else {
            this.ifarbic = false;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this.translate.setDefaultLang(_this.cookieService.get('languageCode'));

            if (_this.cookieService.get('languageCookieId') && _this.cookieService.get('languageCookieId') != undefined && _this.cookieService.get('languageCookieId') != null) {
              var _toSelect2 = _this.languagelist.find(function (c) {
                return c.id === _this.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this.translate.setDefaultLang(_toSelect2.languagecode);

              _this.dir = _toSelect2.dir;
            } else {
              var _toSelect3 = _this.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this.translate.setDefaultLang(_toSelect3.languagecode);

              _this.dir = _toSelect3.dir;
            }

            if (_this.cookieService.get('languageCode') && _this.cookieService.get('languageCode') == 'ar') {
              _this.ifarbic = true;
            } else {
              _this.ifarbic = false;
            }

            _this.drvInputed = {
              fileMstPk: 2,
              selectedFilesPk: []
            };
            _this.drvInputed1 = {
              fileMstPk: 4,
              selectedFilesPk: []
            };
            _this.drvInputedmoheri = {
              fileMstPk: 2,
              selectedFilesPk: []
            };
          });
          this.regpk = this.localstorage.getInLocal('registerPk');
          this.Standardcourese();
          this.getGoverenoratelist();
          this.getconfigurations();
          this.getMoherigradinglist();
          this.getfirstgrid(this.page, 0, null);
          this.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](this.batchtraningdata_data);
          this.CourseForm.controls['cour_subcate'].valueChanges.subscribe(function (value) {
            if (value) {
              var index = _this.subcategory.findIndex(function (x) {
                return x.subpk == value[0];
              });

              if (index !== -1) {
                _this.businessUnitDataTemp = _this.subcategory[index].subcategory_en; // console.log( this.businessUnitDataTemp);
              }
            } else {
              _this.businessUnitDataTemp = ''; // console.log(false);
            }
          });
          this.staffForm.controls['role'].valueChanges.subscribe(function (value) {
            if (value) {
              var index = _this.rolemst.findIndex(function (x) {
                return x.rolemst_pk == value[0];
              });

              if (index !== -1) {
                _this.mainroleUnitDataTemp = _this.rolemst[index].rm_rolename_en; // console.log( this.mainroleUnitDataTemp);
              }
            } else {
              _this.mainroleUnitDataTemp = ''; // console.log(false);
            }
          });
          this.getcountrymst();
          this.userForm = this.formBuilder.group({
            phones: this.formBuilder.array([this.formBuilder.control(null)])
          });
          this.onbread();
          this.maxDate.setFullYear(new Date().getFullYear() - 18);
          this.staffForm.controls['date_birth'].valueChanges.subscribe(function (value) {
            // console.log(24323)
            var m = moment__WEBPACK_IMPORTED_MODULE_18___default()();
            var years = m.diff(value, 'years');
            m.add(-years, 'years');
            var months = m.diff(value, 'months');
            m.add(-months, 'months');
            var days = m.diff(value, 'days'); // console.log(years);
            // console.log(months);
            // console.log(days);

            _this.staffForm.controls.age.setValue(years); // if(this.staffForm.controls.age.value == true) {


            _this.ageShow = false; // }
          });
          this.staffForm.controls['gend_er'].valueChanges.subscribe(function (value) {
            if (_this.staffForm.controls.gend_er.value == 1) {
              _this.genderselect = '1';
              _this.gendershow = false;

              _this.staffForm.controls.gender_address.setValue(_this.i18n('staff.mr'));
            } else if (_this.staffForm.controls.gend_er.value == 2) {
              _this.genderselect = '2';
              _this.gendershow = false;

              _this.staffForm.controls.gender_address.setValue(_this.i18n('staff.ms'));
            } else {
              _this.genderselect = ' ';
            }
          });
          this.onchangecount();
        }
      }, {
        key: "ngAfterViewInit",
        value: function ngAfterViewInit() {
          // console.log('afterviewinit');
          this.checkQueryParams();
        }
      }, {
        key: "calculateAge",
        value: function calculateAge(event) {
          var birthDate = new Date(event.value);
          var today = new Date();
          var diffInMilliseconds = Math.abs(today.getTime() - birthDate.getTime());
          var age = Math.floor(diffInMilliseconds / (1000 * 3600 * 24 * 365)); // console.log(age); // or set the age to a component variable to display in the template
        }
      }, {
        key: "getfirstgrid",
        value: function getfirstgrid(limit, page, searchkey) {
          var _this2 = this;

          this.tblplaceholder = true;
          this.appservice.getfirstgrid(limit, page, searchkey).subscribe(function (res) {
            if (res.status == 200) {
              _this2.tblplaceholder = false; // this.applyinternatdata =res['data'];

              _this2.resultsLength = res['data']['firstgrid']['totalcount'];
              _this2.TrainingBranchData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](res['data']['firstgrid']['applydata']);
              _this2.firstgrid = res['data']['firstgrid']['applydata'];
              _this2.reqformst = res['data']['reqfor'];
            }
          });
        }
      }, {
        key: "getcoursedata",
        value: function getcoursedata() {
          var _this3 = this;

          this.appservice.getcoursedata().subscribe(function (res) {
            _this3.courselist = res.data.courselist;
            _this3.reqformst = res.data.requestformst;
            _this3.deliverto = res.data.deliverto;
          });
        } // formValue(label,pkey,doc) {
        //   let valuarr = this.documentForm.get('remark_'+label).patchValue(doc.documentdtlsmst_pk);
        //   let valuarr1 = this.documentForm.get('doc_'+label).patchValue(doc.documentdtlsmst_pk);
        // //  valuarr.matchcriteria = event.value;
        // //  (((this.documentForm.get(catkey) as FormGroup).get(fkey) as FormArray).at(0) as FormGroup).get(ftype).patchValue({ dataVal: valuarr })
        // }

      }, {
        key: "formParentArrayFormation",
        value: function formParentArrayFormation(label, pkey, doc) {
          if (this.apptype == 'new') {
            this.documentForm.addControl('remark_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]());
            this.documentForm.addControl('doc_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]());
            this.documentForm.addControl('file_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]));
            this.documentForm.addControl('redio_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('1', []));
            this.documentForm.addControl('referpk_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](doc.documentdtlsmst_pk, []));
          } else {
            // alert(this.apptype)
            this.documentForm.addControl('remark_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](doc.appdst_remarks, []));
            this.documentForm.addControl('doc_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](doc.appdocsubmissiontmp_pk, []));
            this.documentForm.addControl('file_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](doc.appdst_memcompfiledtls_fk, []));
            this.documentForm.addControl('redio_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](doc.appdst_submissionstatus, []));
            this.documentForm.addControl('referpk_' + label, new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](doc.documentdtlsmst_pk, [])); // this.changeValue(doc.appdst_submissionstatus,label,doc.documentdtlsmst_pk)

            var val = this.docmst.findIndex(function (x) {
              return x.documentdtlsmst_pk == doc.documentdtlsmst_pk;
            });
            this.docmst[val]['ddm_status'] = doc.appdst_submissionstatus;
            this.drvInputed1.selectedFilesPk = [doc.appdst_memcompfiledtls_fk]; // this.mark.redio_+id.setValue(valid);

            if (doc.appdst_submissionstatus == 1) {
              $('#doc_' + label).show();
              $('#re_' + label).hide();
            } else {
              $('#doc_' + label).hide();
              $('#re_' + label).show();
            }

            this.isValid = doc.appdst_submissionstatus;
          } // this.formValue(label,pkey,doc);
          // Object.keys(this.tryFormGroup[pkey].category[0]).forEach(key => {
          //   (this.myFormGroup.get(this.tryFormGroup[pkey]['labelName']) as FormGroup).addControl(key + 'type', new FormControl('1', []))
          // })

        }
      }, {
        key: "onCommentChange",
        value: function onCommentChange(textValue, index) {
          this.uploadlength[index] = textValue.length;
        }
      }, {
        key: "nextCourse",
        value: function nextCourse() {
          var _this4 = this;

          // return true;
          // if(this.documentForm.valid){
          this.mattab = 3;
          this.disableSubmitButton = true;
          this.appservice.savedocuments(this.documentForm.value, this.referencepk, this.apptype).subscribe(function (res) {
            if (res.status == 200) {
              _this4.disableSubmitButton = false; // this.appservice.getdocumentdata(this.referencepk,this.standardorcustomized).subscribe(res => {
              //   this.docmst =res.data.docmst;
              //   this.mark.total_mst.setValue(res.data.total);
              // });
            }
          }); // }
          // const formdata = new FormData(this.documentForm);
          // this.pageScrolltop();

          this.scrollTo('pagescroll'); // return false;
        }
      }, {
        key: "docradiobtn",
        value: function docradiobtn(valid, id, idpk) {
          var val = this.docmst.findIndex(function (x) {
            return x.documentdtlsmst_pk == idpk;
          });
          this.docmst[val]['ddm_status'] = Number(valid);
          this.docmst[val]['appdst_submissionstatus'] = Number(valid); // this.docmst.splice([val]['ddm_status'],1,valid)
          // this.mark.redio_+id.setValue(valid);

          var ctralname = 'remark_' + id;
          var docctrlname = 'file_' + id;

          if (valid == 1) {
            $('#doc_' + id).show();
            $('#re_' + id).hide();
            this.documentForm.controls[ctralname].reset();
            this.documentForm.controls[docctrlname].setValidators(_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required);
            this.documentForm.controls[ctralname].setValidators(null);
          } else {
            this.documentForm.controls[docctrlname].setValidators(null);
            this.documentForm.controls[ctralname].setValidators(_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required);
            $('#doc_' + id).hide();
            $('#re_' + id).show();
          }

          this.isValid = valid;
        }
      }, {
        key: "getdocmstdata",
        value: function getdocmstdata(standpk, reqfor) {
          var _this5 = this;

          this.appservice.getdocmstdata(this.standorcustom, standpk, reqfor).subscribe(function (res) {
            _this5.docmst = res.data.docmst;

            _this5.mark.total_mst.setValue(res.data.total);
          });
        }
      }, {
        key: "getcustomcourse",
        value: function getcustomcourse() {
          var _this6 = this;

          this.appservice.getcustomcourse().subscribe(function (res) {
            _this6.courselist = res.data.courselist;
            _this6.reqformst = res.data.requestformst;
            _this6.deliverto = res.data.deliverto;
          });
        }
      }, {
        key: "getstaffsinfo",
        value: function getstaffsinfo(institutepk) {
          var _this7 = this;

          this.appservice.getstaffsinfo(institutepk).subscribe(function (res) {
            _this7.staffs = res.data.staffinfo;
          });
        }
      }, {
        key: "branchchoose",
        value: function branchchoose(brancpk) {
          this.appinstinfomain_pk = brancpk;
        }
      }, {
        key: "selectedcourse",
        value: function selectedcourse(value) {
          var _this8 = this;

          this.courselist.forEach(function (z) {
            if (z.pk == value) {
              if (_this8.standorcustom == 'standard') {
                _this8.appservice.chechalredyapply(z.pk, z.scm_requestfor, _this8.appinstinfomain_pk).subscribe(function (res) {
                  if (res.data.exists == 'yes') {
                    sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                      title: 'This course already applied choose another course',
                      text: '',
                      icon: 'warning',
                      // buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                      dangerMode: true,
                      closeOnClickOutside: false
                    });

                    _this8.cour.course_titleen.reset();

                    _this8.cour.cour_cate.reset();

                    _this8.cour.cour_level.reset();
                  } else {
                    _this8.reqformst = res.data.requestformst;

                    _this8.cour.cour_cate.setValue(z.ccm_catname_en);

                    _this8.cour.cour_level.setValue(z.level); // this.cour.request_for.setValue(Number(z.scm_requestfor));

                  }

                  _this8.cour.cour_subcate.reset();
                });
              } else {
                _this8.cour.cour_cate.setValue(z.ccm_catname_en);

                _this8.cour.cour_level.setValue(z.level); // this.cour.request_for.setValue(Number(z.scm_requestfor));

              }

              if (z.scm_coursecategorymst_fk) {
                _this8.appservice.getseccategory(z.scm_coursecategorymst_fk).subscribe(function (res) {
                  _this8.subcategory = res.data.subcategory;
                });
              }

              if (z.appocm_coursesubcategorymst_fk) {
                _this8.appservice.getseccategory(z.appocm_coursesubcategorymst_fk).subscribe(function (res) {
                  _this8.subcategory = res.data.subcategory;
                });
              }

              if (_this8.standorcustom == 'custom') {
                _this8.appservice.getunit(z.pk).subscribe(function (res) {
                  _this8.unit = res.data.unit;
                });
              }
            }
          });
          this.cour.cour_cate.disable();
          this.cour.cour_level.disable();
        }
      }, {
        key: "selectedreqfor",
        value: function selectedreqfor(value) {
          this.getdocmstdata(this.cour.course_titleen.value, value);
        }
      }, {
        key: "delivertochange",
        value: function delivertochange(value) {
          // console.log('(*********)')
          // console.log(value)
          if (value == 'others') {
            this.others = true;
          }
        } //check query params to redirect the pament page & site audit page   

      }, {
        key: "checkQueryParams",
        value: function checkQueryParams() {
          var _this9 = this;

          this.routeid.queryParams.subscribe(function (params) {
            _this9.appstatus = _this9.security.decrypt(params['s']);
            _this9.app_type = _this9.security.decrypt(params['t']);
            _this9.prodpk = _this9.security.decrypt(params['p']);
            _this9.apptemppk = _this9.security.decrypt(params['at']); // console.log('data for query', this.appstatus, this.app_type, this.prodpk, this.apptemppk)
            //const myArray: any[] = [5,6,7,8,9];
            //if(myArray.includes(this.appstatus)){

            if (_this9.appstatus == 5 || _this9.appstatus == 6 || _this9.appstatus == 7 || _this9.appstatus == 8 || _this9.appstatus == 9) {
              _this9.disableSubmitButton = true;

              _this9.appservice.getpaymentinfo(_this9.apptemppk, 1).subscribe(function (res) {
                if (res.status == 200) {
                  setTimeout(function () {
                    _this9.payment = res.data.payment;
                    _this9.record = res.data.record; // console.log('payment standard data', this.payment);

                    _this9.standardTemplate = 'payment';
                    document.querySelector('.page-title').innerHTML = 'Standard & Customized Course Certification - Payment';
                    _this9.disableSubmitButton = false;
                  }, 1000);
                }
              });
            } else {
              _this9.standardTemplate = 'course';
            }
          });
        }
      }, {
        key: "getstaffedu",
        value: function getstaffedu(limit, page, searchkey, referencepk) {
          var _this10 = this;

          this.tblplaceholder = true;
          this.appservice.getstaffedu(limit, page, searchkey, referencepk).subscribe(function (res) {
            if (res.status == 200) {
              _this10.tblplaceholder = false;
              _this10.education = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](res.data.education);
              _this10.fourthLength = res['data']['totalcount'];
            }
          });
        }
      }, {
        key: "getstaffwork",
        value: function getstaffwork(limit, page, searchkey, referencepk) {
          var _this11 = this;

          this.tblplaceholder = true;
          this.appservice.getstaffwork(limit, page, searchkey, referencepk).subscribe(function (res) {
            if (res.status == 200) {
              _this11.tblplaceholder = false;
              _this11.workExperience = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](res.data.workexp);
              _this11.fifthLength = res['data']['totalcount'];
            }
          });
        }
      }, {
        key: "selectcivilid",
        value: function selectcivilid(value) {
          var _this12 = this;

          this.staffs.forEach(function (z) {
            if (z.staffinforepo_pk == value) {
              _this12.appservice.getstaffavialabe(z.staffinforepo_pk, _this12.referencepk).subscribe(function (res) {
                if (res.status == 200) {
                  if (res.data.alreadymapped == 'yes') {
                    sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                      title: 'The staff is already mapped with the same course ',
                      text: '',
                      icon: 'warning',
                      // buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                      dangerMode: true,
                      closeOnClickOutside: false
                    });

                    _this12.staf.civil_num.reset();
                  } else {
                    _this12.staffreferencepk = z.staffinforepo_pk;

                    _this12.staf.staffeng.setValue(z.sir_name_en);

                    _this12.staf.staffarab.setValue(z.sir_name_ar);

                    _this12.staf.email_id.setValue(z.sir_emailid);

                    _this12.staf.date_birth.setValue(z.sir_dob);

                    _this12.staf.gend_er.setValue(z.sir_gender);

                    _this12.staf.national.setValue(z.sir_nationality);

                    _this12.staf.house.setValue(z.sir_addrline1);

                    _this12.staf.houseadd.setValue(z.sir_addrline2);

                    _this12.staf.state.setValue(z.sir_opalstatemst_fk);

                    _this12.appservice.getcitymst(z.sir_opalstatemst_fk).subscribe(function (res) {
                      if (res.status == 200) {
                        _this12.citymst = res.data.citymst;

                        _this12.staf.city.setValue(z.sir_opalcitymst_fk);
                      }
                    });

                    _this12.edu.staffrepopk.setValue(z.staffinforepo_pk);

                    _this12.work.staffrepopk.setValue(z.staffinforepo_pk);

                    _this12.staf.role.setValue(z.appsim_mainrole.split(","));

                    _this12.staf.job_title.setValue(z.appsim_jobtitle);

                    _this12.staf.cont_type.setValue(z.appsim_contracttype);

                    _this12.getstaffedu(_this12.page, 0, null, z.staffinforepo_pk);

                    _this12.getstaffwork(_this12.page, 0, null, z.staffinforepo_pk);

                    _this12.staffotherdetails = true;
                    _this12.saveandproceed = false;
                  }
                }
              }); // this.appservice.getstaffinfo(z.staffinforepo_pk).subscribe(res => {
              //   if(res.status == 200){
              //   this.education = new MatTableDataSource<educationData>(res.data.education);
              //   this.workExperience =  new MatTableDataSource<workexperienceData>(res.data.workexp);
              //     } 
              // });

            }
          });
        }
      }, {
        key: "checkcivilnum",
        value: function checkcivilnum(civilnum, formctrlname) {
          var _this13 = this;

          this.appservice.checkcivilnum(civilnum, this.appinstinfomain_pk, this.referencepk).subscribe(function (res) {
            if (res.data.alreadymapped == 'alreadyadded') {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: 'Already added',
                text: '',
                icon: 'warning',
                // buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              });

              _this13.staffForm.reset();
            }

            if (res.data.alreadymapped == 'list') {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: 'Click on Map Existing Staff to add this Staff',
                text: '',
                icon: 'warning',
                // buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              });

              _this13.staffForm.reset();
            }

            if (res.data.alreadymapped == 'samebranch') {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: 'The Staff is added in different location of your centre. You cannot add the staff from your different Centre’s Location',
                text: '',
                icon: 'warning',
                // buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              });

              _this13.staffForm.reset();
            }

            if (res.data.alreadymapped == 'diffbranch') {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: 'The Staff is added in different centre. You cannot add the staff who is already added in different centre',
                text: '',
                icon: 'warning',
                // buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              });

              _this13.staffForm.reset();
            }

            if (res.data.dataavailable == 'yes') {
              _this13.stateselect(res.data.isstaffavi.sir_opalstatemst_fk); // alert(res.data.isstaffavi.sir_addrline1)


              _this13.staffForm.patchValue({
                civil_num: res.data.isstaffavi.sir_idnumber,
                staffeng: res.data.isstaffavi.sir_name_en,
                staffarab: res.data.isstaffavi.sir_name_ar,
                email_id: res.data.isstaffavi.sir_emailid,
                date_birth: res.data.isstaffavi.sir_dob,
                gend_er: res.data.isstaffavi.sir_gender,
                national: res.data.isstaffavi.sir_nationality,
                house: res.data.isstaffavi.sir_addrline1,
                houseadd: res.data.isstaffavi.sir_addrline2,
                state: res.data.isstaffavi.sir_opalstatemst_fk,
                city: res.data.isstaffavi.sir_opalcitymst_fk,
                // role:res.data.isstaffavi.appsit_mainrole.split(','),
                job_title: res.data.isstaffavi.appsit_jobtitle,
                cont_type: res.data.isstaffavi.appsit_contracttype
              });

              _this13.edu.staffrepopk.setValue(res.data.isstaffavi.staffinforepo_pk);

              _this13.work.staffrepopk.setValue(res.data.isstaffavi.staffinforepo_pk);

              _this13.staffreferencepk = res.data.isstaffavi.staffinforepo_pk;

              _this13.getstaffwork(_this13.page, 0, null, _this13.staffreferencepk);

              _this13.getstaffedu(_this13.page, 0, null, _this13.staffreferencepk);

              _this13.saveandproceed = false;
              _this13.staffotherdetails = true;
            }
          });
        }
      }, {
        key: "sample",
        value: function sample(index, sam) {
          var _this14 = this;

          this.appservice.getcitymst(sam.value).subscribe(function (res) {
            if (res.status == 200) {
              _this14.citylist[index] = res.data.citymst;
            }
          });
        }
      }, {
        key: "sample1",
        value: function sample1(index, sam) {
          var _this15 = this;

          this.appservice.getcitymst(sam).subscribe(function (res) {
            if (res.status == 200) {
              _this15.citylist[index] = res.data.citymst;
            }
          });
        }
      }, {
        key: "getcountrymst",
        value: function getcountrymst() {
          var _this16 = this;

          this.appservice.getcountrymst().subscribe(function (res) {
            if (res.status == 200) {
              _this16.countrymst = res.data.country;
            }
          });
        }
      }, {
        key: "getintnatrecogmst",
        value: function getintnatrecogmst() {
          var _this17 = this;

          this.appservice.getintnatrecogmst(this.standardorcustomized).subscribe(function (res) {
            _this17.interreg = res.data.recogmst;
            _this17.countrylist = res.data.countrymst;
            _this17.rolemst = res.data.rolemst;
            _this17.contacttypemst = res.data.contacttypemst;
            _this17.statemst = res.data.statemst;
            _this17.educationlvl = res.data.educationlvl;
            _this17.languages = res.data.languages;
            _this17.dayschedule = res.data.dayscheule; // this.pageScrolltop();

            _this17.scrollTo('pagescroll');
          });
        }
      }, {
        key: "savestaff",
        value: function savestaff() {
          var _this18 = this;

          if (this.staffForm.valid) {
            this.loaderform = true;
            this.appservice.savestaff(this.staffForm.value).subscribe(function (res) {
              _this18.loaderform = false;
              _this18.saveproceed = true;
              _this18.staffreferencepk = res.data.staffrepopk;

              _this18.edu.staffrepopk.setValue(_this18.staffreferencepk);

              _this18.work.staffrepopk.setValue(_this18.staffreferencepk);

              _this18.saveandproceed = false;
              _this18.staffotherdetails = true; // this.pageScrolltop();

              _this18.scrollTo('editformeducation');
            });
          } else {
            this.focusInvalidInput(this.staffForm);
          }
        }
      }, {
        key: "savestaffedu",
        value: function savestaffedu() {
          var _this19 = this;

          if (this.educationForm.valid) {
            this.loaderformeducation = true;
            this.appservice.savestaffedu(this.educationForm.value, this.staffeduapptype).subscribe(function (res) {
              if (res.status == 200) {
                _this19.loaderformeducation = false; // this.pageScrolltoptabletwo();

                _this19.scrollTo('tableedu'); // this.educationForm.reset();


                _this19.edu.staffrepopk.setValue(_this19.staffreferencepk);

                _this19.staffeduapptype = 'new';

                _this19.getstaffedu(_this19.page, 0, null, _this19.staffreferencepk);

                _this19.educationForm.controls['institute_name'].reset();

                _this19.educationForm.controls['degree_cert'].reset();

                _this19.educationForm.controls['year_join'].reset();

                _this19.educationForm.controls['year_pass'].reset();

                _this19.educationForm.controls['gpa_grade'].reset();

                _this19.educationForm.controls['institue_country'].reset();

                _this19.educationForm.controls['edut_level'].reset();

                _this19.educationForm.controls['inst_city'].reset();

                _this19.educationForm.controls['inst_state'].reset();
              }

              setTimeout(function () {
                _this19.loaderform = false;
              }, 2000);
            });
          } else {
            this.focusInvalidInput(this.educationForm);
          }
        }
      }, {
        key: "savestaffwork",
        value: function savestaffwork() {
          var _this20 = this;

          console.log(this.staffworkexperienceForm);

          if (this.staffworkexperienceForm.valid) {
            this.loaderformwork = true;
            this.appservice.savestaffwork(this.staffworkexperienceForm.value, this.staffworkapptype).subscribe(function (res) {
              if (res.status == 200) {
                _this20.loaderformwork = false; // this.pageScrolltoptable();

                _this20.scrollTo('workedtable'); // this.staffworkexperienceForm.reset();


                _this20.work.staffrepopk.setValue(_this20.staffreferencepk);

                _this20.staffworkapptype = 'new';

                _this20.getstaffwork(_this20.page, 0, null, _this20.staffreferencepk);

                _this20.staffworkexperienceForm.controls['oragn_name'].reset();

                _this20.staffworkexperienceForm.controls['designat'].reset();

                _this20.staffworkexperienceForm.controls['date_join'].reset();

                _this20.staffworkexperienceForm.controls['curr_work'].reset();

                _this20.staffworkexperienceForm.controls['employ_country'].reset();

                _this20.staffworkexperienceForm.controls['employ_state'].reset();

                _this20.staffworkexperienceForm.controls['employ_city'].reset();

                _this20.staffworkexperienceForm.controls['workdate'].setValue('');

                _this20.clearDate();

                _this20.onCheckboxChange1(true);

                _this20.onCheckboxChange1(false);

                _this20.staffworkexperienceForm.controls['workdate'].setValidators(null);

                _this20.staffworkexperienceForm.controls['curr_work'].setValidators(null);
              } // else {
              //   this.disableSubmitButton = false;
              // }

            });
          } else {
            this.focusInvalidInput(this.staffworkexperienceForm);
          }
        }
      }, {
        key: "getstaffinfo",
        value: function getstaffinfo(value) {
          var _this21 = this;

          this.appservice.getstaffdetails(value).subscribe(function (res) {
            _this21.subcategory = res.data.subcategory;
          });
        }
      }, {
        key: "checkfile",
        value: function checkfile(files, filepk) {
          if (filepk == 5) {
            // let value = JSON.stringify(files);
            this.awar.document_upload.setValue(files[0].filePk);
            this.awar.document_upload.updateValueAndValidity();
          }
        }
      }, {
        key: "getconfigurations",
        value: function getconfigurations() {
          var _this22 = this;

          this.regService.getConfiguration().subscribe(function (res) {
            _this22.configurationlist = res.data;
            _this22.crnumverify = _this22.configurationlist['CR Integration'] == 'A' ? true : false;
            _this22.memshpverify = _this22.configurationlist['OPAL Membership Integration'] == 'A' ? true : false;
          });
        }
      }, {
        key: "onselect",
        value: function onselect() {
          if (this.staffForm.controls.gend_er.value == 1) {
            this.genderselect = '1';
            this.genderShow = true;
          } else if (this.staffForm.controls.gend_er.value == 2) {
            this.genderselect = '2';
            this.genderShow = true;
          } else {
            this.genderselect = ' ';
          }
        }
      }, {
        key: "fileData",
        value: function fileData() {
          this.companyLogoFilee = {
            fileName: 'Company Logo',
            fileNote: '',
            fileFormat: 'jpg, jpeg',
            fileSize: '1 MB',
            fileMaxCount: 1,
            fileData: '',
            selectedFiles: []
          };
        }
      }, {
        key: "ChangeValue",
        value: function ChangeValue(valid) {
          this.isValided = valid;
        }
      }, {
        key: "Changevalue",
        value: function Changevalue(valid) {
          this.valided = valid;
        }
      }, {
        key: "changevalue",
        value: function changevalue(valid) {
          this.validture = valid;
        }
      }, {
        key: "radioButtonGroupChange",
        value: function radioButtonGroupChange(data) {
          // console.log(data.value);
          if (data.value == 1) {
            this.newstaff = true;
            this.staffForm.reset(); // this.educationForm.reset(); 
            // this.staffworkexperienceForm.reset(); 
            // this.addressForm.reset();
            // this.selectslotForm.reset(); 

            this.staffForm.controls['count_ry'].setValue('31');
            this.gendershow = true;
            this.ageShow = true;
            this.saveandproceed = false;
            this.staffotherdetails = true;
            this.workExperience = [];
            this.education = [];
            this.fourthLength = 0;
            this.fifthLength = 0;
            this.batchtraningdata_data = []; // this.staffForm.controls.civil_num.reset()
          }

          if (data.value == 2) {
            this.workExperience = [];
            this.education = [];
            this.fourthLength = 0;
            this.fifthLength = 0;
            this.batchtraningdata_data = [];
            this.newstaff = false; // this.staffForm.controls.civil_num.reset()
            // this.staffForm.reset(); 
            // this.educationForm.reset(); 
            // this.staffworkexperienceForm.reset(); 
            // this.addressForm.reset();
            // this.selectslotForm.reset(); 

            this.saveandproceed = true;
            this.staffotherdetails = false;
            this.gendershow = true;
            this.staffForm.reset();
            this.courseselectForm.reset(); // this.educationForm.reset();

            this.staffForm.controls['count_ry'].setValue('31');
            this.ageShow = true; //remove data in grid list
          }
        }
      }, {
        key: "Standardcourese",
        value: function Standardcourese() {
          this.instituteform = this.formBuilder.group({
            offtype: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            exp_a: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            oma_n: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            tot_oman: [''],
            oman_percen: [''],
            site_search: [''],
            site_main: [''],
            molpercent: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            no_techstaff: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            curr_learn: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            ratio_tech: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            trainprovmax: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          }), this.CourseForm = this.formBuilder.group({
            office_type: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            bran_ch: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            course_titleen: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            // course_titlear: ['', Validators.required],
            // course_durat: ['', Validators.required],
            cour_cate: [''],
            cour_subcate: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            cour_level: [''],
            request_for: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            // unit_titl: ['', Validators.required],
            // unit_code: ['', Validators.required],
            course_delivered: ['', null],
            course_delivered_new: ['', null],
            referencepk: [null, null],
            standorcustom: [null, null],
            institute: [null, null],
            appcoursedtlstmp_pk: [null, null]
          }), this.documentForm = this.formBuilder.group({
            // remark_fst: ['', Validators.required],
            // remark_snd: ['', Validators.required],
            // remark_thrd: ['', Validators.required],
            // remark_ffth: ['', Validators.required],
            files: ["", null],
            remark_fst: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            'total_mst': [null, null]
          }), this.staffForm = this.formBuilder.group({
            civil_num: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            staffeng: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            staffarab: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            email_id: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            age: [''],
            date_birth: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            gend_er: [''],
            gender_address: [''],
            national: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            role: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            job_title: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            cont_type: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            house: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            houseadd: [''],
            count_ry: [''],
            state: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            city: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          }), this.educationForm = this.formBuilder.group({
            institute_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            degree_cert: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            year_join: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            year_pass: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            gpa_grade: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            // instute_locate:  ['', Validators.required],
            institue_country: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            edut_level: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            inst_city: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            inst_state: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            staffrepopk: [null, null],
            staffacademics_pk: [null, null]
          }), this.staffworkexperienceForm = this.formBuilder.group({
            oragn_name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            workdate: [''],
            designat: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            date_join: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            // selectcourses: ['', Validators.required],
            curr_work: [''],
            // employ_locate:  ['', Validators.required],
            employ_country: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            employ_state: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            employ_city: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            staffrepopk: [null, null],
            staffworkexp_pk: [null, null]
          }), this.courseselectForm = this.formBuilder.group({
            moheri_upload: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            rolefor_cour: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            select_coursubcate: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            selectlanguage: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          });
          this.addressForm = this.formBuilder.group({
            Address: this.formBuilder.array([this.createCountry()]) // governate: ['', Validators.required],
            // wilayat: ['', Validators.required],

          }), this.awaredForm = this.formBuilder.group({
            award_organ: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            last_audit: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            document_upload: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            referencepk: [null, null],
            appintrecogtmp_pk: [null, null]
          }), this.selectslotForm = this.formBuilder.group({
            daterange: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            availablestatus: [''],
            starttime: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            enDtime: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            days: [0],
            sstartdata: [''],
            senddata: [''],
            sendtime: [''],
            sstarttime: ['']
          });
        }
      }, {
        key: "inst",
        get: function get() {
          return this.instituteform.controls;
        }
      }, {
        key: "awar",
        get: function get() {
          return this.awaredForm.controls;
        }
      }, {
        key: "cour",
        get: function get() {
          return this.CourseForm.controls;
        }
      }, {
        key: "mark",
        get: function get() {
          return this.documentForm.controls;
        }
      }, {
        key: "staf",
        get: function get() {
          return this.staffForm.controls;
        }
      }, {
        key: "edu",
        get: function get() {
          return this.educationForm.controls;
        }
      }, {
        key: "work",
        get: function get() {
          return this.staffworkexperienceForm.controls;
        }
      }, {
        key: "course",
        get: function get() {
          return this.courseselectForm.controls;
        }
      }, {
        key: "add",
        get: function get() {
          return this.addressForm.controls;
        }
      }, {
        key: "range",
        get: function get() {
          return this.selectslotForm.controls;
        } // focusInvalidKeys(keys, form, panel = null) {
        //   if (form == 'form') {
        //     for (const key of keys) {
        //       if (this.comanydetialsform.controls[key].invalid) {
        //         this.comanydetialsform.controls[key].setErrors({ required: true });
        //         this.comanydetialsform.controls[key].markAsTouched();
        //         const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        //         if (invalidControl) {
        //           invalidControl.focus();
        //         }
        //         return false;
        //       }
        //     }
        //     return true;
        //   }
        // }

      }, {
        key: "focusInvalidInput",
        value: function focusInvalidInput(form) {
          for (var _i = 0, _Object$keys = Object.keys(form.controls); _i < _Object$keys.length; _i++) {
            var key = _Object$keys[_i];

            if (form.controls[key].invalid) {
              var invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');

              if (invalidControl) {
                invalidControl.focus();
              }

              break;
            }
          }
        }
      }, {
        key: "getMoherigradinglist",
        value: function getMoherigradinglist() {
          var _this23 = this;

          this.regService.getMoherigradinglist().subscribe(function (data) {
            _this23.moherigradinglist = data.data;
          });
        }
      }, {
        key: "getGoverenoratelist",
        value: function getGoverenoratelist() {
          var _this24 = this;

          this.profileService.getstatebyid(1).subscribe(function (data) {
            _this24.governoratelist = data.data;
          });
        }
      }, {
        key: "getwilayatbyid",
        value: function getwilayatbyid(country, state) {
          var _this25 = this;

          this.profileService.getcity(country, state).subscribe(function (data) {
            return _this25.wilayatlist = data.data;
          });
        }
      }, {
        key: "syncPrimaryunitcde",
        value: function syncPrimaryunitcde(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
          this.getfirstgrid(this.paginator.pageSize, this.paginator.pageIndex, null);
        }
      }, {
        key: "syncPrimaryPaginator",
        value: function syncPrimaryPaginator(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
          this.getfirstgrid(this.paginator.pageSize, this.paginator.pageIndex, null);
        }
      }, {
        key: "secondaryPaginator",
        value: function secondaryPaginator(event) {
          this.paginator1.pageIndex = event.pageIndex;
          this.paginator1.pageSize = event.pageSize;
          this.page1 = event.pageSize;
          this.getinternatinallist(this.paginator1.pageSize, this.paginator1.pageIndex, null);
        }
      }, {
        key: "thirdPaginator",
        value: function thirdPaginator(event) {
          this.paginator2.pageIndex = event.pageIndex;
          this.paginator2.pageSize = event.pageSize;
          this.page2 = event.pageSize;
          this.getstaffgridlist(this.paginator2.pageSize, this.paginator2.pageIndex, null);
        }
      }, {
        key: "fourthPaginator",
        value: function fourthPaginator(event) {
          console.log('fourth ');
          this.paginator3.pageIndex = event.pageIndex;
          this.paginator3.pageSize = event.pageSize;
          this.page3 = event.pageSize;
          this.getstaffedu(this.paginator3.pageSize, this.paginator3.pageIndex, null, this.staffreferencepk);
        }
      }, {
        key: "fifthPaginator",
        value: function fifthPaginator(event) {
          console.log(event);
          this.paginator4.pageIndex = event.pageIndex;
          this.paginator4.pageSize = event.pageSize;
          this.page4 = event.pageSize;
          this.getstaffwork(this.paginator4.pageSize, this.paginator4.pageIndex, null, this.staffreferencepk);
        }
      }, {
        key: "sixthPaginator",
        value: function sixthPaginator(event) {
          this.paginator5.pageIndex = event.pageIndex;
          this.paginator5.pageSize = event.pageSize;
          this.page5 = event.pageSize;
        }
      }, {
        key: "clickEvent",
        value: function clickEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = 'Show Filter';
            var id = document.getElementById('searchrow');
            id.style.display = 'none';
          } else {
            this.filtername = 'Hide Filter';

            var _id = document.getElementById('searchrow');

            _id.style.display = 'flex';
          }
        }
      }, {
        key: "clickfilterEvent",
        value: function clickfilterEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = 'Show Filter';
            var id = document.getElementById('filtershow');
            id.style.display = 'none';
          } else {
            this.filtername = 'Hide Filter';

            var _id2 = document.getElementById('filtershow');

            _id2.style.display = 'flex';
          }
        }
      }, {
        key: "hideEvent",
        value: function hideEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = 'Show Filter';
            var id = document.getElementById('searchfilters');
            id.style.display = 'none';
          } else {
            this.filtername = 'Hide Filter';

            var _id3 = document.getElementById('searchfilters');

            _id3.style.display = 'flex';
          }
        }
      }, {
        key: "getAge",
        value: function getAge(value) {
          var m = moment__WEBPACK_IMPORTED_MODULE_18___default()();
          var years = m.diff(value, 'years');
          m.add(-years, 'years');
          var months = m.diff(value, 'months');
          m.add(-months, 'months');
          var days = m.diff(value, 'days');
          this.staffForm.controls.age.setValue(years);

          if (years >= 5) {
            this.ageinput = true;
          }
        } //   public dateFilterSt: any = '';
        // public dateFilterEd: any = '';
        // daterange = new FormControl('', Validators.required);
        // dateFltrChange(event) {
        //   let stDate = '';
        //   let edDate = '';
        //   this.dateFilterSt = '';
        //   this.dateFilterEd = '';
        //   if (this.daterange.value) {
        //     stDate = (this.daterange.value.startDate) ? moment(this.daterange.value.startDate).format('DD-MM-YYYY') : '';
        //     edDate = (this.daterange.value.endDate) ? moment(this.daterange.value.endDate).format('DD-MM-YYYY') : '';
        //     var stDateArr = stDate.split('-');
        //     var edDateArr = edDate.split('-');
        //     const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        //     const firstDate = new Date(Number(stDateArr[2]), Number(stDateArr[1]), Number(stDateArr[0])).valueOf();
        //     const secondDate = new Date(Number(edDateArr[2]), Number(edDateArr[1]), Number(edDateArr[0])).valueOf();
        //     const diffDays = Math.round(Math.abs(firstDate - secondDate) / oneDay);
        //     this.selectslotForm.controls['days'].setValue(diffDays);
        // alert( this.selectslotForm.controls['days'].value)
        // }
        // }
        // checkfile(files,key)
        // {
        //   this.disableSubmitButton = true;
        //   let value = JSON.stringify(files[0]);
        //   this.accSettingsService.saveUserDp(value).subscribe(res => {
        //     if(res.success)
        //     {
        //       this.getaccousettingsData();
        // }
        //   })
        // }
        //focal point edit 
        //previous button

      }, {
        key: "offictypechange",
        value: function offictypechange(value) {
          var _this26 = this;

          if (value == 1) {
            this.CourseForm.controls['bran_ch'].disable();
            this.showbranch = false;
            this.CourseForm.controls['bran_ch'].reset();
            var encregpk = this.security.encrypt(this.regpk);
            this.appservice.getBranchlistbyregpk(this.regpk, value).subscribe(function (response) {
              _this26.cour.institute.setValue(response.data.data[0].appinstinfomain_pk);

              _this26.getstaffsinfo(response.data.data[0].appinstinfomain_pk);

              _this26.appinstinfomain_pk = response.data.data[0].appinstinfomain_pk;
            });
          } else {
            this.showbranch = true;

            var _encregpk = this.security.encrypt(this.regpk);

            this.appservice.getBranchlistbyregpk(this.regpk, value).subscribe(function (response) {
              if (response.data.status == 1) {
                _this26.cour.institute.setValue(response.data.data[0].appinstinfomain_pk);

                _this26.CourseForm.controls['bran_ch'].enable();

                _this26.branchlist = response.data.data;

                _this26.getstaffsinfo(response.data.data[0].appinstinfomain_pk);

                _this26.appinstinfomain_pk = response.data.data[0].appinstinfomain_pk;
              }
            });
          }
        }
      }, {
        key: "prev",
        value: function prev() {
          var _this27 = this;

          if (this.CourseForm.touched) {
            if (this.applicationtype == 'edit') {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: this.i18n('maincenter.doyouwantcourse'),
                text: this.i18n('maincenter.doyouwantnote'),
                icon: 'warning',
                buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(function (willGoBack) {
                if (willGoBack) {
                  _this27.disableSubmitButton = true;
                  _this27.standardTemplate = 'course';

                  _this27.getfirstgrid(_this27.page, 0, null);

                  setTimeout(function () {
                    _this27.disableSubmitButton = false;
                  }, 2000);
                } // this.pageScrolltop();


                _this27.scrollTo('pagescroll');
              });
            } else {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: this.i18n('maincenter.doyouwantcourseadd'),
                text: this.i18n('maincenter.doyouwantnote'),
                icon: 'warning',
                buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(function (willGoBack) {
                if (willGoBack) {
                  _this27.disableSubmitButton = true;
                  _this27.standardTemplate = 'course';

                  _this27.getfirstgrid(_this27.page, 0, null);

                  setTimeout(function () {
                    _this27.disableSubmitButton = false;
                  }, 2000);
                } // this.pageScrolltop();


                _this27.scrollTo('pagescroll');
              });
            }
          } else {
            sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
              title: this.i18n('uploadfile.doyouwantback'),
              text: '',
              icon: 'warning',
              buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
              dangerMode: true,
              closeOnClickOutside: false
            }).then(function (willGoBack) {
              if (willGoBack) {
                _this27.disableSubmitButton = true;
                _this27.standardTemplate = 'course';

                _this27.getfirstgrid(_this27.page, 0, null);

                setTimeout(function () {
                  _this27.disableSubmitButton = false;
                }, 2000);
              } // this.pageScrolltop();


              _this27.scrollTo('pagescroll');
            });
          }
        } //apply certificate

      }, {
        key: "ApplyCertificate",
        value: function ApplyCertificate(value) {
          var _this28 = this;

          this.mattab = 0;
          this.disableSubmitButton = true;
          this.CourseForm.reset();
          this.awaredForm.reset();
          this.documentForm.reset();
          this.staffForm.reset();
          this.educationForm.reset();
          this.staffworkexperienceForm.reset();
          this.courseselectForm.reset();
          this.applicationtype = 'new';
          this.cour.office_type.enable();
          this.cour.course_titleen.enable();
          this.cour.request_for.enable();
          this.cour.course_delivered.enable();
          this.cour.bran_ch.enable();
          this.cour.cour_level.disable();
          this.cour.cour_cate.disable();
          this.cour.cour_subcate.enable();
          this.docmst = [];
          this.dataSource = [];
          this.StaffList = [];
          this.unit = [];
          this.onchangecount();

          if (value == 2) {
            this.getcoursedata();
            this.standorcustom = 'standard'; // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course',
            // document.getElementById( 'breadactive' ).style.display = 'block';
          } else {
            this.getcustomcourse();
            this.standorcustom = 'custom'; // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course',
            // document.getElementById( 'breadactive' ).style.display = 'block';
          }

          this.standardTemplate = 'standardFroms'; // inside application

          this.appservice.applycertificate(value).subscribe(function (res) {
            if (res.status == 200) {
              _this28.referencepk = res.data.applicationrefpk;

              _this28.cour.referencepk.setValue(_this28.referencepk);

              _this28.cour.standorcustom.setValue(_this28.standorcustom);

              _this28.awar.referencepk.setValue(_this28.referencepk);

              _this28.awaredForm.controls['referencepk'].setValue(_this28.referencepk);
            }
          });
          this.standardorcustomized = value;
          this.getintnatrecogmst();
          this.getinternatinallist(this.page, 0, null);
          setTimeout(function () {
            _this28.disableSubmitButton = false;
          }, 2000); // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "getstaffsubcategory",
        value: function getstaffsubcategory() {
          var _this29 = this;

          this.appservice.getstaffsubcategory(this.appcoursedtlstmppk).subscribe(function (res) {
            _this29.staffsubcat = res.data.staffsubcat;
          });
        }
      }, {
        key: "getinternatinallist",
        value: function getinternatinallist(limit, page, searchkey) {
          var _this30 = this;

          this.tblplaceholder = true;
          this.appservice.getinternational(limit, page, searchkey, this.referencepk).subscribe(function (res) {
            if (res.status == 200) {
              _this30.tblplaceholder = false;
              _this30.applyinternatdata = res['data'];
              _this30.secondaryLength = res['data']['totalcount'];
              _this30.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](_this30.applyinternatdata['applydata']);
              _this30.interdata = _this30.applyinternatdata['applydata'];
            }
          });
        }
      }, {
        key: "getstaffgridlist",
        value: function getstaffgridlist(limit, page, searchkey) {
          var _this31 = this;

          this.tblplaceholder = true;
          this.appservice.getstaffgridlist(limit, page, searchkey, this.referencepk).subscribe(function (res) {
            if (res.status == 200) {
              _this31.tblplaceholder = false;
              _this31.thirdLength = res['data']['totalcount'];
              _this31.StaffList = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](res['data']['staffgrid']);
            }
          });
        } //institute detials

      }, {
        key: "addinstite",
        value: function addinstite() {
          this.mattab = 1; // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "addEvent",
        value: function addEvent(field, event) {
          this.awaredForm.controls[field].setValue(moment__WEBPACK_IMPORTED_MODULE_18___default()(event.value).format('YYYY-MM-DD').toString());
        } //international

      }, {
        key: "addData",
        value: function addData() {
          var _this32 = this;

          if (this.awaredForm.valid) {
            this.disableSubmitButton = true;
            this.appservice.saveinternational(this.awaredForm.value, this.interapptype, this.applicationtype).subscribe(function (res) {
              if (res.status == 200) {
                _this32.disableSubmitButton = false; // this.awaredForm.reset();

                if (_this32.interapptype == 'edit') {
                  _this32.toastr.success('International Recognition and Accreditation Updated Successfully.', ''), {
                    timeOut: 2000,
                    closeButton: false
                  };
                } else {
                  _this32.toastr.success('International Recognition and Accreditation Added Successfully.', ''), {
                    timeOut: 2000,
                    closeButton: false
                  };
                }

                _this32.getinternatinallist(_this32.page, 0, null);
              }
            });
            this.awaredForm.controls.award_organ.reset();
            this.awaredForm.controls.last_audit.reset();
            this.awaredForm.controls.document_upload.reset();
            this.ShowHide = true;
            this.international = false;
            this.mattab = 1; // this.pageScrolltop();

            this.scrollTo('pagescroll');
          } else {
            this.fileerror = false;
            this.focusInvalidInput(this.awaredForm);
          }

          this.cour.referencepk.setValue(this.referencepk);
          this.awar.referencepk.setValue(this.referencepk);
        }
      }, {
        key: "awardcancel",
        value: function awardcancel() {
          var _this33 = this;

          if (this.awaredForm.touched) {
            if (this.awaredForm.get('appintrecogtmp_pk').value) {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: this.i18n('maincenter.doyouwantupdate'),
                text: this.i18n('maincenter.doyouwantnote'),
                icon: 'warning',
                buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(function (willGoBack) {
                if (willGoBack) {
                  _this33.disableSubmitButton = true;
                  _this33.disableSubmitButton = true;
                  _this33.ShowHide = true;
                  _this33.international = false;
                  _this33.mattab = 1;
                  setTimeout(function () {
                    _this33.disableSubmitButton = false;
                  }, 2000); // this.pageScrolltop();

                  _this33.scrollTo('pagescroll');
                }
              });
            } else {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: this.i18n('maincenter.doyouwantadd'),
                text: this.i18n('maincenter.doyouwantnote'),
                icon: 'warning',
                buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(function (willGoBack) {
                if (willGoBack) {
                  _this33.disableSubmitButton = true;
                  _this33.ShowHide = true;
                  _this33.international = false;
                  _this33.mattab = 1;
                  setTimeout(function () {
                    _this33.disableSubmitButton = false;
                  }, 2000); // this.pageScrolltop();

                  _this33.scrollTo('pagescroll');
                }
              });
            }
          } else {
            this.disableSubmitButton = true;
            this.ShowHide = true;
            this.international = false;
            this.mattab = 1;
            setTimeout(function () {
              _this33.disableSubmitButton = false;
            }, 2000); // this.pageScrolltop();

            this.scrollTo('pagescroll');
          }
        }
      }, {
        key: "sHowhide",
        value: function sHowhide() {
          // this.awaredForm.reset()
          this.drvInputed.selectedFilesPk = [];
          this.ShowHide = false;
          this.international = true;
          this.add_btn = true;
          this.interapptype = 'new';
          this.awaredForm.enable();
          this.awaredForm.controls['award_organ'].reset();
          this.awaredForm.controls['document_upload'].reset();
          this.awaredForm.controls['last_audit'].reset(); // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "interedit",
        value: function interedit(value, oprtype) {
          var _this34 = this;

          this.disableSubmitButton = true;
          this.interapptype = oprtype;
          this.deleteicon = true;
          this.scrollTo('pagescroll');

          if (oprtype == 'view') {
            this.deleteicon = false;
            this.hiddenbtn = false;
            this.awaredForm.disable();
          }

          if (oprtype == 'edit') {
            this.awaredForm.enable();
          }

          this.intercomment = value.appintit_appdeccomment;
          this.interaddedon = value.appintit_appdecon;
          this.interaddedby = value.oum_firstname;
          this.interstatus = value.status; //  console.log(value.status)

          this.ShowHide = false;
          this.international = true;
          this.add_btn = false;
          this.drvInputed.selectedFilesPk = [value.appintit_doc]; // let date =formatDate(value.last_aud,'yyyy-MM-dd','en-US');

          this.awaredForm.patchValue({
            award_organ: value.appintit_intnatrecogmst_fk,
            last_audit: value.last_aud1,
            appintrecogtmp_pk: value.appintrecogtmp_pk,
            document_upload: value.appintit_doc
          }); //     this.interdata.forEach(z => {
          //       if(z.appintrecogtmp_pk == value){
          // alert(z.appintit_intnatrecogmst_fk)
          //         alert(typeof(z.last_aud))
          //         let date =formatDate(z.last_aud,'yyyy-MM-dd','en-US');
          //         this.awaredForm.patchValue({
          //         award_organ :z.appintit_intnatrecogmst_fk,
          //         last_audit :date
          //         // document_upload:
          //       });
          //       }
          //     });

          setTimeout(function () {
            _this34.disableSubmitButton = false;
          }, 2000); // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "interdelete",
        value: function interdelete(value, oprtype) {
          var _this35 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
            title: this.i18n('maincenter.doyouwantgrid'),
            text: '',
            icon: 'warning',
            buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this35.appservice.interdelete(value).subscribe(function (res) {
                if (res.status == 200) {
                  _this35.getinternatinallist(_this35.page, 0, null);

                  _this35.toastr.success(_this35.i18n('maincenter.griddele'), ''), {
                    timeOut: 2000,
                    closeButton: false
                  }; // this.pageScrolltop();

                  _this35.scrollTo('pagescroll');
                }
              });
            }
          });
        }
      }, {
        key: "editapplicationdata",
        value: function editapplicationdata(applicationpk, projectfk, applicationtype) {
          var _this36 = this;

          this.applicationtype = applicationtype;
          this.standardorcustomized = projectfk;
          this.disableSubmitButton = true;

          if (this.applicationtype == 'view') {
            this.coursesavebtn = true;
            this.docsavebtn = true;
            this.cour.office_type.disable();
            this.cour.course_titleen.disable();
            this.cour.request_for.disable();
            this.cour.course_delivered.disable();
            this.cour.bran_ch.disable();
            this.cour.cour_level.disable();
            this.cour.cour_cate.disable();
            this.cour.cour_subcate.disable();
          }

          if (this.applicationtype == 'update' || this.applicationtype == 'edit' || this.applicationtype == 'renew') {
            this.cour.office_type.disable();
            this.cour.course_titleen.disable();
            this.cour.request_for.disable();
            this.cour.course_delivered.disable();
            this.cour.bran_ch.disable();
            this.cour.cour_level.disable();
            this.cour.cour_cate.disable();
            this.cour.cour_subcate.enable();
            this.coursesavebtn = false;
          }

          if (projectfk == 2) {
            this.getcoursedata();
          } else {
            this.getcustomcourse();
          } // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course';
          // document.getElementById( 'breadactive' ).style.display = 'block';


          this.apptype = 'edit';
          this.cour.cour_cate.enable();
          this.cour.cour_level.enable();
          this.appservice.getalldata(applicationpk, projectfk).subscribe(function (res) {
            _this36.referencepk = applicationpk;
            _this36.coursecommandsts = res.data.course[0].appcdt_status;
            _this36.coursecommand = res.data.course[0].appcdt_appdeccomment;
            _this36.courseappon = res.data.course[0].appcdtappdecon;
            _this36.courseappby = res.data.course[0].oum_firstname;

            _this36.getinternatinallist(_this36.page, 0, null);

            _this36.getstaffgridlist(_this36.page, 0, null);

            _this36.getintnatrecogmst();

            _this36.awaredForm.controls['referencepk'].setValue(applicationpk);

            if (res.status == 200) {
              _this36.standardTemplate = 'standardFroms'; // inside application

              if (projectfk == 2) {
                //standard
                var coursefk = res.data.course[0].appcdt_standardcoursemst_fk;

                _this36.appservice.getseccategory(res.data.course[0].scm_coursecategorymst_fk).subscribe(function (res) {
                  _this36.subcategory = res.data.subcategory;
                });
              } else {
                //customized
                var coursefk = res.data.course[0].appcdt_appoffercoursemain_fk;

                _this36.appservice.getseccategory(res.data.course[0].appocm_coursesubcategorymst_fk).subscribe(function (res) {
                  _this36.standorcustom = 'custom';
                  _this36.subcategory = res.data.subcategory;
                });

                _this36.appservice.getunit(res.data.course[0].appoffercoursemain_pk).subscribe(function (res) {
                  _this36.unit = res.data.unit;
                });
              }

              _this36.appservice.getdocumentdata(_this36.referencepk, _this36.standardorcustomized).subscribe(function (res) {
                _this36.docmst = res.data.docmst;

                _this36.mark.total_mst.setValue(res.data.total);
              });

              if (res.data.course[0].appiim_officetype == 1) {
                _this36.CourseForm.controls['bran_ch'].disable();
              } else {
                _this36.offictypechange(2);

                if (_this36.applicationtype == 'update') {
                  _this36.cour.bran_ch.disable();
                }
              }

              _this36.getstaffsinfo(res.data.course[0].appcdt_appinstinfomain_fk);

              _this36.appinstinfomain_pk = res.data.course[0].appcdt_appinstinfomain_fk;
              setTimeout(function () {
                _this36.CourseForm.patchValue({
                  'referencepk': applicationpk,
                  'office_type': Number(res.data.course[0].appiim_officetype),
                  'course_titleen': coursefk,
                  'cour_level': _this36.dir == 'ltr' ? res.data.course[0].rm_name_en : res.data.course[0].rm_name_ar,
                  'cour_cate': _this36.dir == 'ltr' ? res.data.course[0].ccm_catname_en : res.data.course[0].ccm_catname_ar,
                  'request_for': res.data.course[0].appcdt_requestfor,
                  'cour_subcate': res.data.category,
                  'course_delivered': res.data.course[0].appcdt_deliverto,
                  'appcoursedtlstmp_pk': res.data.course[0].appcoursedtlstmp_pk,
                  'bran_ch': res.data.course[0].appcdt_appinstinfomain_fk
                });

                _this36.disableSubmitButton = false;
              }, 1000);
              _this36.appcoursedtlstmppk = res.data.course[0].appcoursedtlstmp_pk;

              _this36.getstaffsubcategory();
            }
          }); // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "applyFilter",
        value: function applyFilter(serch, key) {
          var search = {
            serchkey: serch,
            name: key
          }; // console.log(serch)

          this.getfirstgrid(this.page, 0, search);
        }
      }, {
        key: "applyFilterforinter",
        value: function applyFilterforinter(serch, key) {
          var search = {
            serchkey: serch,
            name: key
          }; // console.log(serch)

          this.getinternatinallist(this.page, 0, search);
        }
      }, {
        key: "applyFilterforstaff",
        value: function applyFilterforstaff(serch, key) {
          var search = {
            serchkey: serch,
            name: key
          }; // console.log(serch)

          this.getstaffgridlist(this.page, 0, search);
        }
      }, {
        key: "seracheducation",
        value: function seracheducation(serch, key) {
          var search = {
            serchkey: serch,
            name: key
          }; // console.log(serch)

          this.getstaffedu(this.page, 0, search, this.staffreferencepk);
        }
      }, {
        key: "serachwork",
        value: function serachwork(serch, key) {
          var search = {
            serchkey: serch,
            name: key
          }; // console.log(serch)

          this.getstaffwork(this.page, 0, search, this.staffreferencepk);
        }
      }, {
        key: "editstaffgrid",
        value: function editstaffgrid(element, oprtype) {
          var _this37 = this;

          this.staffform = true;
          this.ShowHide = false;
          this.staffapptype = 'edit';
          this.staffotherdetails = true; //hide and show staff other details

          this.newstaff = false;
          this.staffcommand = element.appsit_appdeccomment;
          this.staffappon = element.appsit_appdecby;
          this.staffappby = element.oum_firstname;
          this.staffstatus = element.appsit_status;
          this.appostaffinfotmp_pk = element.appostaffinfotmp_pk;
          this.staffreferencepk = element.staffinforepo_pk;
          this.stateselect(element.sir_opalstatemst_fk);
          this.getstaffedu(this.page, 0, null, element.staffinforepo_pk);
          this.getstaffwork(this.page, 0, null, element.staffinforepo_pk);
          this.edu.staffrepopk.setValue(element.staffinforepo_pk);
          this.work.staffrepopk.setValue(element.staffinforepo_pk);
          this.saveandproceed = false; // alert(element.appsit_mainrole)

          this.staffForm.controls['civil_num'].disable();
          this.staffForm.controls['staffeng'].disable();
          this.staffForm.controls['staffarab'].disable();
          this.staffForm.patchValue({
            civil_num: element.sir_idnumber,
            staffeng: element.sir_name_en,
            staffarab: element.sir_name_ar,
            email_id: element.sir_emailid,
            date_birth: element.sir_dob,
            gend_er: element.sir_gender,
            national: element.sir_nationality,
            // role:element.appsit_mainrole.split(','),
            job_title: element.appsit_jobtitle,
            cont_type: element.appsit_contracttype,
            house: element.sir_addrline1,
            houseadd: element.sir_addrline2,
            state: element.sir_opalstatemst_fk,
            city: element.sir_opalcitymst_fk
          }); // console.log(element.sir_moheridoc)

          console.log('mohari doc');
          console.log(element.sir_moheridoc);
          this.drvInputedmoheri.selectedFilesPk = [element.sir_moheridoc];
          this.appservice.getstaffdata(element.appostaffinfotmp_pk).subscribe(function (res) {
            if (res.status == 200) {
              _this37.courseselectForm.patchValue({
                moheri_upload: element.sir_moheridoc,
                rolefor_cour: res.data.stafftmp.appsit_roleforcourse1,
                select_coursubcate: res.data.stafftmp.appsit_appcoursetrnstmp_fk1,
                selectlanguage: res.data.stafftmp.appsit_language1
              });

              _this37.staffForm.patchValue({
                role: res.data.stafftmp.appsit_mainrole1
              });

              res.data.staffloc.forEach(function (element, index) {
                _this37.sample1(index, element.aslt_opalstatemst_fk);
              });

              if (res.data.staffloc.length != 0) {
                var termsFormArray = _this37.addressForm.controls.Address;

                while (termsFormArray.length !== 0) {
                  termsFormArray.removeAt(0);
                }

                res.data.staffloc.forEach(function (data) {
                  // console.log('-----------')
                  city1 = [];

                  if (data.aslt_opalcitymst.length == 1) {
                    city1 = data.aslt_opalcitymst;
                  } else {
                    var city1 = data.aslt_opalcitymst_fk.split(',');
                  } // console.log(city1)


                  _this37.AddressFormArr.push(_this37.formBuilder.group({
                    governate: data.aslt_opalstatemst_fk.toString(),
                    wilayat: [city1, '']
                  })); // this.AddressFormArr.controls['wilayat'].setValue(city)

                });
              }
            }
          }); // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "deletestaffgrid",
        value: function deletestaffgrid(appostaffinfotmp_pk) {
          var _this38 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
            title: this.i18n('maincenter.doyouwantgrid'),
            text: '',
            icon: 'warning',
            buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this38.appservice.deletestaffgrid(appostaffinfotmp_pk).subscribe(function (res) {
                if (res.status == 200) {
                  _this38.getstaffgridlist(_this38.page, 0, null);

                  _this38.toastr.success(_this38.i18n('maincenter.griddele'), ''), {
                    timeOut: 2000,
                    closeButton: false
                  }; // this.pageScrolltop();

                  _this38.scrollTo('pagescroll');
                }
              });
            }
          });
        }
      }, {
        key: "deletestaffedu",
        value: function deletestaffedu(staffacademics_pk) {
          var _this39 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
            title: this.i18n('maincenter.doyouwantgrid'),
            text: '',
            icon: 'warning',
            buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this39.appservice.deletestaffedu(staffacademics_pk).subscribe(function (res) {
                if (res.status == 200) {
                  _this39.getstaffedu(_this39.page, 0, null, _this39.staffreferencepk);

                  _this39.toastr.success(_this39.i18n('maincenter.griddele'), ''), {
                    timeOut: 2000,
                    closeButton: false
                  }; // this.pageScrolltop();

                  _this39.scrollTo('pagescroll');
                }
              });
            }
          });
        }
      }, {
        key: "deletestaffwork",
        value: function deletestaffwork(staffworkexp_pk) {
          var _this40 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
            title: this.i18n('maincenter.doyouwantgrid'),
            text: '',
            icon: 'warning',
            buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this40.appservice.deletestaffwork(staffworkexp_pk).subscribe(function (res) {
                if (res.status == 200) {
                  _this40.getstaffwork(_this40.page, 0, null, _this40.staffreferencepk);

                  _this40.toastr.success(_this40.i18n('maincenter.griddele'), ''), {
                    timeOut: 2000,
                    closeButton: false
                  }; // this.pageScrolltop();

                  _this40.scrollTo('pagescroll');
                }
              });
            }
          });
        }
      }, {
        key: "cancelstaffedu",
        value: function cancelstaffedu() {
          // this.apptype = 'new';
          this.educationForm.controls['institute_name'].reset();
          this.educationForm.controls['degree_cert'].reset();
          this.educationForm.controls['year_join'].reset();
          this.educationForm.controls['year_pass'].reset();
          this.educationForm.controls['gpa_grade'].reset();
          this.educationForm.controls['institue_country'].reset();
          this.educationForm.controls['edut_level'].reset();
          this.educationForm.controls['inst_city'].reset();
          this.educationForm.controls['inst_state'].reset();
          this.staffeduapptype = 'new';
          this.scrollTo('editformeducation');
        }
      }, {
        key: "editstaffedu",
        value: function editstaffedu(educationData, educationtype) {
          this.staffeduapptype = educationtype; // this.pageScrolltoformtwo();

          this.staffreferencepk = educationData.sacd_staffinforepo_fk;
          this.ctrychoose(educationData.sacd_opalcountrymst_fk);
          this.stateselect(educationData.sacd_opalstatemst_fk);
          this.educationForm.patchValue({
            year_join: educationData.sacd_startdate,
            year_pass: educationData.sacd_enddate,
            institute_name: educationData.institute,
            institue_country: educationData.sacd_opalcountrymst_fk,
            inst_state: educationData.sacd_opalstatemst_fk,
            inst_city: educationData.sacd_opalcitymst_fk,
            edut_level: educationData.sacd_edulevel,
            degree_cert: educationData.degree,
            gpa_grade: educationData.grade,
            staffacademics_pk: educationData.staffacademics_pk,
            staffrepopk: educationData.sacd_staffinforepo_fk
          });
          this.scrollTo('editformeducation');
        }
      }, {
        key: "editstaffwork",
        value: function editstaffwork(workexperienceData, worktype) {
          // console.log(workexperienceData)
          this.staffworkapptype = worktype;
          this.staffreferencepk = workexperienceData.sexp_staffinforepo_fk;
          this.ctrychoose(workexperienceData.sexp_opalcountrymst_fk);
          this.stateselect(workexperienceData.sexp_opalstatemst_fk); // this.pageScrolltoform();

          this.scrollTo('editdata');

          if (workexperienceData.sexp_currentlyworking == 1) {
            this.staffworkexperienceForm.controls['curr_work'].setValue(1);
            this.staffworkexperienceForm.controls['workdate'].reset();
          }

          this.staffworkexperienceForm.patchValue({
            oragn_name: workexperienceData.organname,
            date_join: workexperienceData.sexp_doj,
            workdate: workexperienceData.sexp_eod,
            // curr_work:workexperienceData.sexp_currentlyworking,
            employ_country: workexperienceData.sexp_opalcountrymst_fk,
            employ_state: workexperienceData.sexp_opalstatemst_fk,
            employ_city: workexperienceData.sexp_opalcitymst_fk,
            designat: workexperienceData.sexp_designation,
            staffworkexp_pk: workexperienceData.staffworkexp_pk,
            staffrepopk: workexperienceData.sexp_staffinforepo_fk
          });
        }
      }, {
        key: "previnst",
        value: function previnst() {
          this.mattab = 0; // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "nextOperate",
        value: function nextOperate() {
          this.mattab = 2; // this.pageScrolltop();

          this.scrollTo('pagescroll');
        } //document 

      }, {
        key: "prevoperat",
        value: function prevoperat() {
          this.mattab = 1; // this.pageScrolltop();

          this.scrollTo('pagescroll');
        } //opearator contact

      }, {
        key: "showHidecourse",
        value: function showHidecourse() {
          this.courses = true;
          this.ShowHide = false; // this.pageScrolltop();

          this.scrollTo('pagescroll'); // this.mattab = 5;
        }
      }, {
        key: "courseAdd",
        value: function courseAdd() {
          var _this41 = this;

          if (this.CourseForm.valid) {
            this.disableSubmitButton = true;
            this.appservice.addcourse(this.CourseForm.value, this.apptype).subscribe(function (res) {
              if (res.status == 200) {
                _this41.disableSubmitButton = false;

                if (_this41.apptype == 'new') {
                  _this41.toastr.success(_this41.i18n('maincenter.couradde'), ''), {
                    timeOut: 2000,
                    closeButton: false
                  };
                } else {
                  _this41.toastr.success(_this41.i18n('maincenter.courupdat'), ''), {
                    timeOut: 2000,
                    closeButton: false
                  };
                }

                _this41.appcoursedtlstmppk = res.data.appcoursedtlstmp_pk;

                _this41.CourseForm.controls['appcoursedtlstmp_pk'].setValue(res.data.appcoursedtlstmp_pk);

                _this41.getstaffsubcategory();
              } else {
                _this41.disableSubmitButton = false;
              } // this.pageScrolltop();


              _this41.scrollTo('pagescroll');
            });
            this.mattab = 1;
          } else {
            this.focusInvalidInput(this.CourseForm);
          }
        }
      }, {
        key: "stateselect",
        value: function stateselect(value) {
          var _this42 = this;

          this.appservice.getcitymst(value).subscribe(function (res) {
            if (res.status == 200) {
              _this42.citymst = res.data.citymst;
            }
          });
        }
      }, {
        key: "nextstaff",
        value: function nextstaff() {
          this.mattab = 2; // this.pageScrolltop();

          this.scrollTo('pagescroll');
        } //staff

      }, {
        key: "canclstaff",
        value: function canclstaff() {
          var _this43 = this;

          if (this.staffForm.touched || this.courseselectForm.touched) {
            if (this.staffapptype == 'new') {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: this.i18n('maincenter.doyouwantdelestaffupdate'),
                text: this.i18n('maincenter.doyouwantnote'),
                icon: 'warning',
                buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(function (willGoBack) {
                if (willGoBack) {
                  _this43.disableSubmitButton = true;
                  _this43.mattab = 3;
                  _this43.staffform = false;
                  _this43.ShowHide = true; // this.pageScrolltop();

                  _this43.scrollTo('pagescroll');

                  setTimeout(function () {
                    _this43.disableSubmitButton = false;
                  }, 2000);
                }
              });
            } else {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: this.i18n('maincenter.doyouwantdelestaffadd'),
                text: this.i18n('maincenter.doyouwantnote'),
                icon: 'warning',
                buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(function (willGoBack) {
                if (willGoBack) {
                  _this43.disableSubmitButton = true;
                  _this43.mattab = 3;
                  _this43.staffform = false;
                  _this43.ShowHide = true; // this.pageScrolltop();

                  _this43.scrollTo('pagescroll');

                  setTimeout(function () {
                    _this43.disableSubmitButton = false;
                  }, 2000);
                }
              });
            }
          } else {
            this.disableSubmitButton = true;
            this.mattab = 3;
            this.staffform = false;
            this.ShowHide = true; // this.pageScrolltop();

            this.scrollTo('pagescroll');
            setTimeout(function () {
              _this43.disableSubmitButton = false;
            }, 2000);
          }
        }
      }, {
        key: "staffAdd",
        value: function staffAdd() {
          var _this44 = this;

          // if(this.staffForm.valid  && this.courseselectForm.valid  && this.addressForm.valid) {
          var data = {
            'repo': this.staffForm.value,
            'addressform': this.addressForm.value,
            'selectslotForm': this.selectslotForm.value,
            'userform': this.userForm.value,
            'courseselectForm': this.courseselectForm.value,
            'calenderdata': this.batchtraningdata_data,
            'referencek': this.referencepk,
            'staffrepopk': this.staffreferencepk,
            'courseform': this.CourseForm.value,
            'appostaffinfotmp_pk': this.appostaffinfotmp_pk,
            'applicationtype': this.applicationtype
          }; // console.log("*********************")
          // console.log(data)
          // console.log(this.batchtraningdata_data)

          this.disableSubmitButton = true;
          this.appservice.stafffinalsave(data, this.staffapptype).subscribe(function (res) {
            _this44.disableSubmitButton = false;

            if (res.status == 200) {
              _this44.getstaffgridlist(_this44.page, 0, null);
            }
          });
          this.mattab = 3;
          this.staffform = false;
          this.ShowHide = true; // this.pageScrolltop();

          this.scrollTo('pagescroll'); // }else if (this.staffForm.invalid) {
          //   this.focusInvalidInput(this.staffForm);
          // // }else if (this.educationForm.invalid) {
          // //   this.focusInvalidInput(this.educationForm);
          // // }else if (this.staffworkexperienceForm.invalid)  {
          // //   this.focusInvalidInput(this.staffworkexperienceForm);
          // }
          // else if (this.courseselectForm.invalid)  {
          //   this.focusInvalidInput(this.courseselectForm);
          // }
          // else if (this.selectslotForm.invalid)  {
          //   this.focusInvalidInput(this.selectslotForm);
          // }else {
          //   this.focusInvalidInput(this.addressForm)
          // }
        }
      }, {
        key: "showHidestaff",
        value: function showHidestaff() {
          this.staffapptype = 'new';
          this.staffform = true;
          this.ShowHide = false;
          this.newstaff = true; // this.pageScrolltop();

          this.staffstatus = 0;
          this.scrollTo('pagescroll');
          this.staffForm.reset();
          this.ageShow = true;
          this.educationForm.reset();
          this.staffworkexperienceForm.reset();
          this.addressForm.reset();
          this.courseselectForm.reset();
          this.workExperience = [];
          this.education = [];
          this.fourthLength = 0;
          this.fifthLength = 0;
          this.batchtraningdata_data = [];
          this.staffForm.controls['civil_num'].enable();
          this.staffForm.controls['staffeng'].enable();
          this.staffForm.controls['staffarab'].enable();
          this.staffForm.controls['count_ry'].setValue('31');
        }
      }, {
        key: "prevcourse",
        value: function prevcourse() {
          this.mattab = 1; // this.pageScrolltop();

          this.scrollTo('pagescroll');
        }
      }, {
        key: "finished",
        value: function finished() {
          var _this45 = this;

          // if(this.staffForm.valid || this.educationForm.valid || this.staffworkexperienceForm.valid) {
          sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
            title: this.i18n('maincenter.doyousubmt'),
            // text: 'You can still recover the file from the JSRS drive.',
            icon: 'success',
            buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this45.disableSubmitButton = true;

              _this45.appservice.submitdesktoreview(_this45.referencepk, _this45.apptype, _this45.applicationtype).subscribe(function (res) {
                if (res.status == 200) {
                  _this45.getfirstgrid(_this45.page, 0, null);

                  _this45.standardTemplate = 'course';
                }
              });

              setTimeout(function () {
                _this45.disableSubmitButton = false;
              }, 2000);
              _this45.toastr.success(_this45.i18n('maincenter.popsubmit'), ''), {
                timeOut: 2000,
                closeButton: false
              };
            }
          }); // this.pageScrolltop();

          this.scrollTo('pagescroll'); // }else {
          //      this.focusInvalidInput(this.staffForm);
          //      this.focusInvalidInput(this.educationForm);
          //      this.focusInvalidInput(this.staffworkexperienceForm);
          // }
        }
      }, {
        key: "makepayment",
        value: function makepayment(apppk, apptye, appstage, appsts, type) {
          this.disableSubmitButton = true;
          var pk = apppk;
          var type = type;
          console.log('encrypt data', apptye, appstage, appsts, apppk);
          this.myRoute.navigate(['standardcourse/home'], {
            queryParams: {
              p: this.secuirty.encrypt(apptye),
              t: this.secuirty.encrypt(appstage),
              s: this.secuirty.encrypt(appsts),
              at: this.secuirty.encrypt(apppk)
            }
          });
          this.maindata;
        }
      }, {
        key: "canc",
        value: function canc() {
          var _this46 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
            title: "Do you want back to main centre",
            text: " ",
            icon: 'warning',
            buttons: ["No", "Yes"],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(function () {
            _this46.standardTemplate = 'MainCentre'; // this.pageScrolltop();

            _this46.scrollTo('pagescroll');
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
            }); // console.log(123)
          } catch (error) {
            console.log('page-content');
          }
        }
      }, {
        key: "opendialogquicksetup",
        value: function opendialogquicksetup() {
          var dialogRef = this.dialog.open(Modalavailabledate, {
            disableClose: true,
            panelClass: 'quicksetuplist'
          }); //dialogRef.componentInstance.drawer = this.drawercontactus;

          dialogRef.afterClosed().subscribe(function (result) {});
        }
      }, {
        key: "checkData",
        value: function checkData(availablecalender) {
          if (availablecalender == 64) {
            this.avaliabledate = false;
          } else if (availablecalender == 30) {
            this.weekend == false;
          } else if (availablecalender == 31) {
            this.holiday == false;
          } // console.info(this.batchtraningdata_data);
          // if(this.selectslotForm.controls.availablestatus.value == 1) {
          //   this.dateselect = true;
          // }else if (this.selectslotForm.controls.availablestatus.value == 2) {
          //   this.dateselect = false;
          // }else if (this.selectslotForm.controls.availablestatus.value == 3) {
          //   this.dateselect = false;
          // }

        }
      }, {
        key: "getDateArray",
        value: function getDateArray(start, end) {
          var arr = [];
          var dt = new Date(start);

          while (dt <= end) {
            arr.push(new Date(dt));
            dt.setDate(dt.getDate() + 1);
          }

          var i = 1;

          for (var _i2 = 0, _arr = arr; _i2 < _arr.length; _i2++) {
            var val = _arr[_i2];
            var year = val.getFullYear();
            var month = val.getMonth() + 1;
            var date = val.getDate();
            var fullDate = year + '-' + month + '-' + date;
            var fullDateFormat = val;
            var obj = {
              date: fullDate,
              day: val.toLocaleDateString('en-US', {
                weekday: 'long'
              }),
              selecteddate: val.toLocaleDateString('en-US', {
                weekday: 'short'
              }) + ' ' + moment__WEBPACK_IMPORTED_MODULE_18___default()(fullDateFormat).format('DD-MM-YYYY'),
              id: i,
              schedule: 1,
              start: '10:30',
              end: '11:30',
              hrs: '1',
              startDateTime: '',
              endDateTime: '',
              subarr: []
            };
            this.batchtraningdata_data.push(obj); // this.cour.slots.setValue(this.batchtraningdata_data);

            i++;
          }

          this.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](this.batchtraningdata_data);
          this.selectslotForm.controls['days'].setValue(this.batchtraningdata_data.length); //  this.cour.slots.setValue(this.batchtraningdata_data);

          this.getSelectedDayArray();
        }
      }, {
        key: "getSelectedDayArray",
        value: function getSelectedDayArray() {
          // console.log(this.batchtraningdata_data);
          var selectedDayArray = [];

          var _iterator = _createForOfIteratorHelper(this.days2),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var day = _step.value;

              var _iterator2 = _createForOfIteratorHelper(this.batchtraningdata_data),
                  _step2;

              try {
                for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
                  var val = _step2.value;

                  if (val.day == day) {
                    var obj = {
                      startDateTime: val.date + 'T' + this.startTime,
                      endDateTime: val.date + 'T' + this.endTime,
                      day: val.day
                    };
                    selectedDayArray.push(obj);
                  }
                }
              } catch (err) {
                _iterator2.e(err);
              } finally {
                _iterator2.f();
              }
            } // console.log(selectedDayArray);

          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }
        } // removeEmployee(empIndex: number) {
        //   this.employees().removeAt(empIndex);
        // }

      }, {
        key: "lessons",
        get: function get() {
          return this.selectslotForm.controls["lessons"];
        }
      }, {
        key: "addLesson",
        value: function addLesson(i, event) {
          // console.log(event + "valuearray");
          this.selectslotForm.get('lessons').at(i).get('title').setValue(event.value);
        }
      }, {
        key: "deleteLesson",
        value: function deleteLesson(lessonIndex) {
          this.lessons.removeAt(lessonIndex);
        }
      }, {
        key: "dateFltrChange",
        value: function dateFltrChange(event) {
          var stDate = '';
          var edDate = '';
          this.dateFilterSt = '';
          this.dateFilterEd = '';

          if (this.daterange.value) {
            var startvaldate = new Date(moment__WEBPACK_IMPORTED_MODULE_18___default()(this.daterange.value.startDate).format('YYYY-MM-DD'));
            var endvaldate = new Date(moment__WEBPACK_IMPORTED_MODULE_18___default()(this.daterange.value.endDate).format('YYYY-MM-DD'));
            this.getDateArray(startvaldate, endvaldate);
          }
        }
      }, {
        key: "AddressFormArr",
        get: function get() {
          return this.addressForm.get('Address');
        }
      }, {
        key: "getReferralsFormArr",
        value: function getReferralsFormArr(index) {
          var formGroup = this.AddressFormArr.controls[index];
          return formGroup;
        }
      }, {
        key: "createCountry",
        value: function createCountry() {
          return this.formBuilder.group({
            governate: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            wilayat: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          });
        }
      }, {
        key: "addReferral",
        value: function addReferral() {
          // if (this.ReferralsFormArr.length < 10) {
          this.AddressFormArr.push(this.createCountry());
        } // }

      }, {
        key: "removeReferral",
        value: function removeReferral(index) {
          this.AddressFormArr.removeAt(index);
        }
      }, {
        key: "fileeSelectedmoheri",
        value: function fileeSelectedmoheri(file, fileId) {
          // console.log(file)
          // console.log(fileId)
          fileId.selectedFilesPk = file;
          this.courseselectForm.controls['moheri_upload'].setValue(file[file.length - 1]);
        }
      }, {
        key: "fileeSelected",
        value: function fileeSelected(file, fileId) {
          //  console.log(file)
          //  console.log(fileId)
          this.awaredForm.controls['document_upload'].setValue(file[0]);
          fileId.selectedFilesPk = []; // this.upload_name = fileId.selectedFilesPk[0]; 
        }
      }, {
        key: "fileeSelected1",
        value: function fileeSelected1(file, fileId, formctlname) {
          var filepk = file[file.length - 1]; // console.log(filepk)
          // fileId.selectedFilesPk = file;

          var ctrlname = 'file_' + formctlname;
          this.documentForm.controls[ctrlname].setValue(file[formctlname - 1]); // console.log('test this')
          // this.upload_name = fileId.selectedFilesPk[0]; 
        } //  endMilliseconds: any;

      }, {
        key: "addPhone",
        value: function addPhone(rowindex) {
          var dataArray = this.batchtrainingdata.data;
          var selectedindex = dataArray[rowindex];
          selectedindex.subarr.push({
            sstartdata: null,
            senddate: null
          });
          setTimeout(function () {
            this.batchtrainingdata.data = dataArray;
            this.mtable.renderRows();
          }, 20);
        }
      }, {
        key: "removePhone",
        value: function removePhone(index, rowindex) {
          var dataArray = this.batchtrainingdata.data;
          var selectedindex = dataArray[rowindex];
          var subselectedindex = selectedindex.subarr; // console.log('subarrayindex',selectedindex,subselectedindex);

          selectedindex.subarr.splice(index, 1);
          setTimeout(function () {
            this.batchtrainingdata.data = dataArray;
            this.mtable.renderRows();
          }, 20);
        }
      }, {
        key: "getPhonesFormControls",
        value: function getPhonesFormControls() {
          return this.userForm.get('phones').controls;
        }
      }, {
        key: "calculateTimeDifference",
        value: function calculateTimeDifference(z, i) {
          setTimeout(function () {
            var endMilliseconds = document.getElementById('to' + z + i).value;
            var startMilliseconds = document.getElementById('form' + z + i).value;
            document.getElementById('difference' + z + i).innerHTML = '00:00';
            var timeParts = startMilliseconds.split(':');
            var timetwo = endMilliseconds.split(':'); //console.log(timeParts)
            //console.log(timetwo);

            var startTime = new Date();
            startTime.setHours(parseInt(timeParts[0], 10));
            startTime.setMinutes(parseInt(timeParts[1], 10));
            var endTime = new Date();
            endTime.setHours(parseInt(timetwo[0], 10));
            endTime.setMinutes(parseInt(timetwo[1], 10));
            var totalMilliseconds = endTime.getTime() - startTime.getTime();
            var hours = Math.floor(totalMilliseconds / 3600000);
            var minutes = Math.floor(totalMilliseconds % 3600000 / 60000); // this.totaltime = `${hours}:${minutes}`;
            // document.getElementById('difference'+z+i)[0].value = this.totaltime;

            this.formattedTime = "".concat(hours, ":").concat(minutes);
            document.getElementById('difference' + z + i).innerHTML = this.formattedTime; //console.log(this.formattedTime);
            // console.log(this.totaltime);

            return false;
          }, 300);
        }
      }, {
        key: "cityselect",
        value: function cityselect(country) {
          // this.citylabel = this.staffForm.controls.inst_city.value == 1 ? this.i18n('staff.gove') : this.i18n('staff.state');
          if (country == 31) {
            this.oman = true; //  console.log(true)
          } else if (country = 31) {
            this.oman = false; // console.log(false)
          }
        }
      }, {
        key: "cityselecttwo",
        value: function cityselecttwo(countrytwo) {
          if (countrytwo == 31) {
            this.nonoman = true;
          } else if (countrytwo != 31) {
            this.nonoman = false;
          }
        }
      }, {
        key: "ctrychoose",
        value: function ctrychoose(countryfk) {
          var _this47 = this;

          this.appservice.getstatemst(countryfk).subscribe(function (res) {
            if (res.status == 200) {
              _this47.state = res.data.state;
            }
          });
        }
      }, {
        key: "countryselected",
        value: function countryselected() {// this.citylabel = this.staffForm.controls.inst_city.value == 1 ? this.i18n('staff.gove') : this.i18n('staff.state');
        } // tabClickFunctions = [
        //   () =>  document.querySelector('.breadcrumb-item.active').innerHTML = 'Course',
        //   () =>  document.querySelector('.breadcrumb-item.active').innerHTML = 'International Recognition and Accerditation',
        //   () =>  document.querySelector('.breadcrumb-item.active').innerHTML = 'Document Required',
        //   () =>  document.querySelector('.breadcrumb-item.active').innerHTML = 'Staff',
        // ];

      }, {
        key: "onTabSelect",
        value: function onTabSelect(event) {// const index = event.index;
          // this.tabClickFunctions[index]();
        }
      }, {
        key: "onbread",
        value: function onbread() {// (<HTMLInputElement>document.getElementById('breadactive')).style.display = 'none';
          // const bread = document.getElementById('breadactive');
          // bread.style.display = 'none';
          // const breadactive = this.breadactiveref.nativeElement;
          // breadactive.style.color = 'red';
        }
      }, {
        key: "dateSelected",
        value: function dateSelected(event) {
          var selectedDate = event.value;

          if (selectedDate) {
            this.isCheckboxDisabled = true;
            this.cleardate = true;
            this.worktilled = true;
          }
        }
      }, {
        key: "clearDate",
        value: function clearDate() {
          this.staffworkexperienceForm.controls['workdate'].reset();
          this.isCheckboxDisabled = false;
          this.cleardate = false;
        }
      }, {
        key: "onCheckboxChange",
        value: function onCheckboxChange(event) {
          if (event.checked) {
            this.notallowed = true;
            this.staffworkexperienceForm.controls['workdate'].reset();
            this.staffworkexperienceForm.controls['workdate'].setErrors(null);
            this.worktilled = false;
          } else {
            // console.log(9)
            this.staffworkexperienceForm.controls['workdate'].setErrors({
              'incorrect': true
            });
            this.worktilled = true;
            this.notallowed = false;
          }
        }
      }, {
        key: "onCheckboxChange1",
        value: function onCheckboxChange1(truedata) {
          if (truedata) {
            this.notallowed = true;
            this.staffworkexperienceForm.controls['workdate'].reset();
            this.staffworkexperienceForm.controls['workdate'].setErrors(null);
            this.worktilled = false;
          } else {
            // console.log(9)
            this.staffworkexperienceForm.controls['workdate'].setErrors({
              'incorrect': true
            });
            this.worktilled = true;
            this.notallowed = false;
          }
        }
      }, {
        key: "toggleExpansion",
        value: function toggleExpansion() {
          this.expandedElement = !this.expandedElement; // this.expandedElement = false;
        }
      }, {
        key: "Filterinternational",
        value: function Filterinternational() {
          this.Awarding.setValue("");
          this.LastAudited.setValue("");
          this.Status.setValue("");
          this.Addedon.setValue("");
          this.LastUpdated.setValue("");
          this.getinternatinallist(this.page, 0, null);
        }
      }, {
        key: "clearFiltersecound",
        value: function clearFiltersecound() {
          this.appl_form.setValue("");
          this.officetype.setValue("");
          this.bran_name.setValue("");
          this.coures_type.setValue("");
          this.course_titles.setValue("");
          this.course_cat.setValue("");
          this.requested.setValue("");
          this.courdeliver.setValue("");
          this.date_expiry.setValue("");
          this.appl_status.setValue("");
          this.cert.setValue("");
          this.addedon_branch.setValue("");
          this.lastUpdated_branch.setValue("");
          this.getfirstgrid(this.page, 0, null);
        }
      }, {
        key: "clearFilterfour",
        value: function clearFilterfour() {
          this.civil_numb.setValue("");
          this.staff_name.setValue("");
          this.role_course.setValue("");
          this.cours_sub_cate.setValue("");
          this.StatusCour.setValue("");
          this.adddoncour.setValue("");
          this.LastUpdatedcour.setValue("");
        }
      }, {
        key: "clearFiltereducation",
        value: function clearFiltereducation() {
          this.institute.setValue("");
          this.degree.setValue("");
          this.year_join.setValue("");
          this.year_pass.setValue("");
          this.grade.setValue("");
          this.add_On.setValue("");
          this.Last_Date.setValue("");
        }
      }, {
        key: "clearFilterework",
        value: function clearFilterework() {
          this.oranisation.setValue("");
          this.date_joined.setValue("");
          this.work_till.setValue("");
          this.designation.setValue("");
          this.add_edOn.setValue("");
          this.add_On.setValue("");
          this.date_last.setValue("");
        } // pageScrolltop(){
        //   // console.log("no")
        //     document.getElementById('standard_customized').scrollIntoView({
        //       behavior: "smooth",
        //       block: "start",
        //       inline: "nearest"
        //     });
        //   }
        //   pageScrolltoptable(){
        //     // console.log(12)
        //       document.getElementById('workedtable').scrollIntoView({
        //         behavior: "smooth",
        //         block: "start",
        //         inline: "nearest"
        //       });
        //     }
        //     pageScrolltoform(){
        //       // console.log(12)
        //         document.getElementById('editdata').scrollIntoView({
        //           behavior: "smooth",
        //           block: "start",
        //           inline: "nearest"
        //         });
        //       }
        //     pageScrolltoptabletwo(){
        //       // console.log(12)
        //         document.getElementById('tableedu').scrollIntoView({
        //           behavior: "smooth",
        //           block: "start",
        //           inline: "nearest"
        //         });
        //       }
        //       pageScrolltoformtwo(){
        //         // console.log(12)
        //           document.getElementById('editdataedu').scrollIntoView({
        //             behavior: "smooth",
        //             block: "start",
        //             inline: "nearest"
        //           });
        //         }

      }, {
        key: "onchangecount",
        value: function onchangecount() {
          this.staffForm.controls['count_ry'].enable();
          this.staffForm.controls['count_ry'].setValue('31');
          this.staffForm.controls['count_ry'].disable();
        }
      }, {
        key: "nexttab",
        value: function nexttab() {
          this.mattab = 1;
        }
      }, {
        key: "gotostaff",
        value: function gotostaff() {
          this.mattab = 3;
        }
      }, {
        key: "canclework",
        value: function canclework() {
          this.staffworkexperienceForm.controls['oragn_name'].reset();
          this.staffworkexperienceForm.controls['workdate'].reset();
          this.staffworkexperienceForm.controls['designat'].reset();
          this.staffworkexperienceForm.controls['date_join'].reset();
          this.staffworkexperienceForm.controls['curr_work'].reset();
          this.staffworkexperienceForm.controls['employ_country'].reset();
          this.staffworkexperienceForm.controls['employ_state'].reset();
          this.staffworkexperienceForm.controls['employ_city'].reset();
          this.staffworkapptype = 'new';
          this.scrollTo('editdata');
        }
      }, {
        key: "clearRecordData",
        value: function clearRecordData(value) {
          var _this48 = this;

          this.batchtraningdata_data.forEach(function (z) {
            if (z.id === value) {
              console.log('fgfgs');

              _this48.batchtraningdata_data.splice(value - 1, 1);

              var obj = {
                date: z.date,
                day: z.day,
                selecteddate: z.selecteddate,
                id: value,
                schedule: '',
                subarr: []
              };

              _this48.batchtraningdata_data.splice(value - 1, 0, obj);

              _this48.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](_this48.batchtraningdata_data);

              _this48.selectslotForm.controls['days'].setValue(_this48.batchtraningdata_data.length);

              _this48.cour.slots.setValue(_this48.batchtraningdata_data);

              console.log(_this48.batchtraningdata_data);

              _this48.getSelectedDayArray();
            }
          });
        }
      }]);

      return StandardcoursesComponent;
    }();

    StandardcoursesComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"]
      }, {
        type: _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_9__["ProfileService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__["CookieService"]
      }, {
        type: _app_services_application_service__WEBPACK_IMPORTED_MODULE_20__["ApplicationService"]
      }, {
        type: _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_16__["RegistrationService"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_19__["MatDialog"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_21__["Encrypt"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_22__["AppLocalStorageServices"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_21__["Encrypt"]
      }, {
        type: _app_services_batch_service__WEBPACK_IMPORTED_MODULE_23__["BatchService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_27__["ToastrService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], StandardcoursesComponent.prototype, "tog", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('formFocus'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])], StandardcoursesComponent.prototype, "scrollElement", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('companylogo'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_10__["Filee"])], StandardcoursesComponent.prototype, "companylogoFilee", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('MatTabGroup'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_tabs__WEBPACK_IMPORTED_MODULE_13__["MatTabGroup"])], StandardcoursesComponent.prototype, "tabGroup", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__["MatPaginator"])], StandardcoursesComponent.prototype, "paginator", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__["MatPaginator"])], StandardcoursesComponent.prototype, "paginator1", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__["MatPaginator"])], StandardcoursesComponent.prototype, "paginator2", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__["MatPaginator"])], StandardcoursesComponent.prototype, "paginator3", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__["MatPaginator"])], StandardcoursesComponent.prototype, "paginator4", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__["MatPaginator"])], StandardcoursesComponent.prototype, "paginator5", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_14__["MatSort"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_14__["MatSort"])], StandardcoursesComponent.prototype, "sort", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], StandardcoursesComponent.prototype, "mattab", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], StandardcoursesComponent.prototype, "maindata", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('breadactive'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])], StandardcoursesComponent.prototype, "breadactiveref", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTable"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTable"])], StandardcoursesComponent.prototype, "table", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTable"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTable"])], StandardcoursesComponent.prototype, "mtable", void 0);
    StandardcoursesComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-standardcourses',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./standardcourses.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/standardcourses/standardcourses.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      providers: [{
        provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_7__["DateAdapter"],
        useClass: _app_shared_format_datepicker__WEBPACK_IMPORTED_MODULE_24__["AppDateAdapter"]
      }, {
        provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_7__["MAT_DATE_FORMATS"],
        useValue: _app_shared_format_datepicker__WEBPACK_IMPORTED_MODULE_24__["APP_DATE_FORMATS"]
      }],
      animations: [_app_modules_profilemanagement_animation__WEBPACK_IMPORTED_MODULE_25__["SlideInOutAnimation"], Object(_angular_animations__WEBPACK_IMPORTED_MODULE_26__["trigger"])('detailExpand', [Object(_angular_animations__WEBPACK_IMPORTED_MODULE_26__["state"])('collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_26__["style"])({
        height: '0px',
        minHeight: '0',
        display: 'none'
      })), Object(_angular_animations__WEBPACK_IMPORTED_MODULE_26__["state"])('expanded', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_26__["style"])({
        height: '*',
        display: 'block'
      })), Object(_angular_animations__WEBPACK_IMPORTED_MODULE_26__["transition"])('expanded <=> collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_26__["animate"])('225ms cubic-bezier(0.4, 0.0, 0.2, 1)'))])],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./standardcourses.component.scss */
      "./src/app/modules/standardcourses/standardcourses.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"], _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_9__["ProfileService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__["CookieService"], _app_services_application_service__WEBPACK_IMPORTED_MODULE_20__["ApplicationService"], _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_16__["RegistrationService"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_19__["MatDialog"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_21__["Encrypt"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_22__["AppLocalStorageServices"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_21__["Encrypt"], _app_services_batch_service__WEBPACK_IMPORTED_MODULE_23__["BatchService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_27__["ToastrService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"]])], StandardcoursesComponent);
    var quickset_data = [{
      position: 1
    }];

    var Modalavailabledate = /*#__PURE__*/function () {
      function Modalavailabledate(translate, cookieService, dialogRef, remoteService, appservice, el, fb, data) {
        _classCallCheck(this, Modalavailabledate);

        this.translate = translate;
        this.cookieService = cookieService;
        this.dialogRef = dialogRef;
        this.remoteService = remoteService;
        this.appservice = appservice;
        this.el = el;
        this.fb = fb;
        this.data = data;
        this.quicksetupdatalist = new _angular_material_table__WEBPACK_IMPORTED_MODULE_15__["MatTableDataSource"](quickset_data);
        this.quicksetupcolumn = ['days', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        this.dir = 'ltr';
        this.languagelist = [{
          "id": "1",
          "languageName": "English",
          "languagecode": "en",
          "CountryMst_Pk": "136",
          "dir": "ltr"
        }, {
          "id": "2",
          "languageName": "Arabic",
          "languagecode": "ar",
          "CountryMst_Pk": "31",
          "dir": "rtl"
        }];
      }

      _createClass(Modalavailabledate, [{
        key: "cour",
        get: function get() {
          return this.batchform.controls;
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this49 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this49.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect4 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect4.languagecode);
            this.dir = _toSelect4.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this49.translate.setDefaultLang(_this49.cookieService.get('languageCode'));

            if (_this49.cookieService.get('languageCookieId') && _this49.cookieService.get('languageCookieId') != undefined && _this49.cookieService.get('languageCookieId') != null) {
              var _toSelect5 = _this49.languagelist.find(function (c) {
                return c.id === _this49.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this49.translate.setDefaultLang(_toSelect5.languagecode);

              _this49.dir = _toSelect5.dir;
            } else {
              var _toSelect6 = _this49.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this49.translate.setDefaultLang(_toSelect6.languagecode);

              _this49.dir = _toSelect6.dir;
            }
          });
          this.batchform = this.fb.group({
            starttime: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            endtime: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          });
        }
      }, {
        key: "closedialog",
        value: function closedialog() {
          this.dialogRef.close();
        }
      }]);

      return Modalavailabledate;
    }();

    Modalavailabledate.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__["CookieService"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_19__["MatDialogRef"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"]
      }, {
        type: _app_services_application_service__WEBPACK_IMPORTED_MODULE_20__["ApplicationService"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: undefined,
        decorators: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"],
          args: [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_19__["MAT_DIALOG_DATA"]]
        }]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('scroll', {
      read: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])], Modalavailabledate.prototype, "scroll", void 0);
    Modalavailabledate = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'modalavailabledate',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./modalavailabledate.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/standardcourses/modalavailabledate.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./modalavailabledate.scss */
      "./src/app/modules/standardcourses/modalavailabledate.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__param"])(7, Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"])(_angular_material_dialog__WEBPACK_IMPORTED_MODULE_19__["MAT_DIALOG_DATA"])), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__["CookieService"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_19__["MatDialogRef"], _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"], _app_services_application_service__WEBPACK_IMPORTED_MODULE_20__["ApplicationService"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"], _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], Object])], Modalavailabledate);
    /***/
  },

  /***/
  "./src/app/modules/standardcourses/standardcourses.module.ts":
  /*!*******************************************************************!*\
    !*** ./src/app/modules/standardcourses/standardcourses.module.ts ***!
    \*******************************************************************/

  /*! exports provided: createTranslateLoader, StandardcoursesModule */

  /***/
  function srcAppModulesStandardcoursesStandardcoursesModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function () {
      return createTranslateLoader;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "StandardcoursesModule", function () {
      return StandardcoursesModule;
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


    var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/common */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
    /* harmony import */


    var _standardcourses_routing_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./standardcourses-routing.module */
    "./src/app/modules/standardcourses/standardcourses-routing.module.ts");
    /* harmony import */


    var _standardcourses_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./standardcourses.component */
    "./src/app/modules/standardcourses/standardcourses.component.ts");
    /* harmony import */


    var mat_progress_buttons__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! mat-progress-buttons */
    "./node_modules/mat-progress-buttons/__ivy_ngcc__/fesm2015/mat-progress-buttons.js");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _registration_registration_routing_module__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ../registration/registration-routing.module */
    "./src/app/modules/registration/registration-routing.module.ts");
    /* harmony import */


    var _angular_material_autocomplete__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @angular/material/autocomplete */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/autocomplete.js");
    /* harmony import */


    var _angular_material_button__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @angular/material/button */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/button.js");
    /* harmony import */


    var _angular_material_button_toggle__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @angular/material/button-toggle */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/button-toggle.js");
    /* harmony import */


    var _angular_material_card__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @angular/material/card */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/card.js");
    /* harmony import */


    var _angular_material_checkbox__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @angular/material/checkbox */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/checkbox.js");
    /* harmony import */


    var _angular_material_chips__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! @angular/material/chips */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/chips.js");
    /* harmony import */


    var _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! @angular/material/datepicker */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/datepicker.js");
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _angular_material_expansion__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! @angular/material/expansion */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/expansion.js");
    /* harmony import */


    var _angular_material_grid_list__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! @angular/material/grid-list */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/grid-list.js");
    /* harmony import */


    var _angular_material_icon__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(
    /*! @angular/material/icon */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/icon.js");
    /* harmony import */


    var _angular_material_input__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(
    /*! @angular/material/input */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/input.js");
    /* harmony import */


    var _angular_material_list__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(
    /*! @angular/material/list */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/list.js");
    /* harmony import */


    var _angular_material_menu__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(
    /*! @angular/material/menu */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/menu.js");
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_progress_bar__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(
    /*! @angular/material/progress-bar */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/progress-bar.js");
    /* harmony import */


    var _angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(
    /*! @angular/material/progress-spinner */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/progress-spinner.js");
    /* harmony import */


    var _angular_material_radio__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(
    /*! @angular/material/radio */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/radio.js");
    /* harmony import */


    var _angular_material_select__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(
    /*! @angular/material/select */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/select.js");
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
    /* harmony import */


    var _angular_material_slider__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(
    /*! @angular/material/slider */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/slider.js");
    /* harmony import */


    var _angular_material_slide_toggle__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(
    /*! @angular/material/slide-toggle */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/slide-toggle.js");
    /* harmony import */


    var _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(
    /*! @angular/material/snack-bar */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/snack-bar.js");
    /* harmony import */


    var _angular_material_sort__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(
    /*! @angular/material/sort */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_35__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_36__ = __webpack_require__(
    /*! @angular/material/toolbar */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/toolbar.js");
    /* harmony import */


    var _angular_material_tooltip__WEBPACK_IMPORTED_MODULE_37__ = __webpack_require__(
    /*! @angular/material/tooltip */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tooltip.js");
    /* harmony import */


    var _angular_material_stepper__WEBPACK_IMPORTED_MODULE_38__ = __webpack_require__(
    /*! @angular/material/stepper */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/stepper.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_39__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var ngx_owl_carousel_o__WEBPACK_IMPORTED_MODULE_40__ = __webpack_require__(
    /*! ngx-owl-carousel-o */
    "./node_modules/ngx-owl-carousel-o/__ivy_ngcc__/fesm2015/ngx-owl-carousel-o.js");
    /* harmony import */


    var _mat_select_search_mat_select_search_module__WEBPACK_IMPORTED_MODULE_41__ = __webpack_require__(
    /*! ../mat-select-search/mat-select-search.module */
    "./src/app/modules/mat-select-search/mat-select-search.module.ts");
    /* harmony import */


    var ngx_smart_popover__WEBPACK_IMPORTED_MODULE_42__ = __webpack_require__(
    /*! ngx-smart-popover */
    "./node_modules/ngx-smart-popover/__ivy_ngcc__/fesm2015/ngx-smart-popover.js");
    /* harmony import */


    var ng_recaptcha__WEBPACK_IMPORTED_MODULE_43__ = __webpack_require__(
    /*! ng-recaptcha */
    "./node_modules/ng-recaptcha/__ivy_ngcc__/fesm2015/ng-recaptcha.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_44__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_45__ = __webpack_require__(
    /*! @ngx-translate/http-loader */
    "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
    /* harmony import */


    var _app_shared_shared_module__WEBPACK_IMPORTED_MODULE_46__ = __webpack_require__(
    /*! @app/@shared/shared.module */
    "./src/app/@shared/shared.module.ts");

    function createTranslateLoader(http) {
      return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_45__["TranslateHttpLoader"](http, './assets/i18n/standardcourse/', '.json');
    }

    var StandardcoursesModule = /*#__PURE__*/_createClass(function StandardcoursesModule() {
      _classCallCheck(this, StandardcoursesModule);
    });

    StandardcoursesModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_standardcourses_component__WEBPACK_IMPORTED_MODULE_4__["StandardcoursesComponent"], _standardcourses_component__WEBPACK_IMPORTED_MODULE_4__["Modalavailabledate"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _standardcourses_routing_module__WEBPACK_IMPORTED_MODULE_3__["StandardcoursesRoutingModule"], _angular_material_tabs__WEBPACK_IMPORTED_MODULE_6__["MatTabsModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__["FlexLayoutModule"], mat_progress_buttons__WEBPACK_IMPORTED_MODULE_5__["MatProgressButtonsModule"], _registration_registration_routing_module__WEBPACK_IMPORTED_MODULE_9__["RegistrationRoutingModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__["FlexLayoutModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_8__["ReactiveFormsModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormsModule"], _angular_material_autocomplete__WEBPACK_IMPORTED_MODULE_10__["MatAutocompleteModule"], _angular_material_button__WEBPACK_IMPORTED_MODULE_11__["MatButtonModule"], _angular_material_button_toggle__WEBPACK_IMPORTED_MODULE_12__["MatButtonToggleModule"], _angular_material_card__WEBPACK_IMPORTED_MODULE_13__["MatCardModule"], _angular_material_checkbox__WEBPACK_IMPORTED_MODULE_14__["MatCheckboxModule"], _angular_material_chips__WEBPACK_IMPORTED_MODULE_15__["MatChipsModule"], _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_16__["MatDatepickerModule"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_17__["MatDialogModule"], _angular_material_expansion__WEBPACK_IMPORTED_MODULE_18__["MatExpansionModule"], _angular_material_grid_list__WEBPACK_IMPORTED_MODULE_19__["MatGridListModule"], _angular_material_icon__WEBPACK_IMPORTED_MODULE_20__["MatIconModule"], _angular_material_input__WEBPACK_IMPORTED_MODULE_21__["MatInputModule"], _angular_material_list__WEBPACK_IMPORTED_MODULE_22__["MatListModule"], _angular_material_menu__WEBPACK_IMPORTED_MODULE_23__["MatMenuModule"], _angular_material_core__WEBPACK_IMPORTED_MODULE_24__["MatNativeDateModule"], _angular_material_paginator__WEBPACK_IMPORTED_MODULE_25__["MatPaginatorModule"], _angular_material_progress_bar__WEBPACK_IMPORTED_MODULE_26__["MatProgressBarModule"], _angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_27__["MatProgressSpinnerModule"], _angular_material_radio__WEBPACK_IMPORTED_MODULE_28__["MatRadioModule"], _angular_material_core__WEBPACK_IMPORTED_MODULE_24__["MatRippleModule"], _angular_material_select__WEBPACK_IMPORTED_MODULE_29__["MatSelectModule"], _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_30__["MatSidenavModule"], _angular_material_slider__WEBPACK_IMPORTED_MODULE_31__["MatSliderModule"], _angular_material_slide_toggle__WEBPACK_IMPORTED_MODULE_32__["MatSlideToggleModule"], _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_33__["MatSnackBarModule"], _angular_material_sort__WEBPACK_IMPORTED_MODULE_34__["MatSortModule"], _angular_material_table__WEBPACK_IMPORTED_MODULE_35__["MatTableModule"], _angular_material_tabs__WEBPACK_IMPORTED_MODULE_6__["MatTabsModule"], _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_36__["MatToolbarModule"], _angular_material_tooltip__WEBPACK_IMPORTED_MODULE_37__["MatTooltipModule"], _angular_material_stepper__WEBPACK_IMPORTED_MODULE_38__["MatStepperModule"], _angular_common_http__WEBPACK_IMPORTED_MODULE_39__["HttpClientModule"], ngx_owl_carousel_o__WEBPACK_IMPORTED_MODULE_40__["CarouselModule"], _mat_select_search_mat_select_search_module__WEBPACK_IMPORTED_MODULE_41__["MatSelectSearchModule"], ngx_smart_popover__WEBPACK_IMPORTED_MODULE_42__["PopoverModule"], ng_recaptcha__WEBPACK_IMPORTED_MODULE_43__["RecaptchaV3Module"], _app_shared_shared_module__WEBPACK_IMPORTED_MODULE_46__["SharedModule"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_44__["TranslateModule"].forChild({
        loader: {
          provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_44__["TranslateLoader"],
          useFactory: createTranslateLoader,
          deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_39__["HttpClient"]]
        }
      })],
      entryComponents: [_standardcourses_component__WEBPACK_IMPORTED_MODULE_4__["Modalavailabledate"]],
      exports: [_standardcourses_component__WEBPACK_IMPORTED_MODULE_4__["Modalavailabledate"]]
    })], StandardcoursesModule);
    /***/
  }
}]);
//# sourceMappingURL=modules-standardcourses-standardcourses-module-es5.js.map