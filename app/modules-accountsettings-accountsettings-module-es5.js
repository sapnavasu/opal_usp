function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-accountsettings-accountsettings-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/accountsettings.component.html":
  /*!**************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/accountsettings.component.html ***!
    \**************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsAccountsettingsComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div id=\"accountcontainer\"  dir=\"{{dir}}\" class=\"{{dir}}\">\r\n  <div fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n    <div fxFlex=\"100\" fxFlex.gt-sm=\"30\" class=\"detials\">\r\n      <mat-card class=\"profile_cardfrt\">\r\n        <mat-card-header fxLayout=\"column\">\r\n          <div class=\"file_uploaded\" *ngIf=\"accSettingsData?.primaryContact?.userdp\">\r\n            <app-fileupload #userdp [key]=3 (fileuploaded)=\"checkfile($event,1)\"></app-fileupload>\r\n          </div>\r\n          <div class=\"userimg m-l-30\" *ngIf=\"!accSettingsData?.primaryContact?.userdp\">\r\n            <img mat-card-image src=\"{{accSettingsData?.primaryContact?.dppath}}\"\r\n              onError=\"this.src = '/assets/images/avatar.svg'\" alt=\"petroleumlogo\">\r\n            <span matTooltip=\"delete\" (click)=\"removeDp()\"><mat-icon class=\"fa fa-trash-o\"></mat-icon></span>\r\n          </div>\r\n          <h4 class=\"fs-18 txt-gry text-center\" *ngIf=\"accSettingsData?.primaryContact?.usertype == 'A'\">\r\n            {{accSettingsData?.companyName}}</h4>\r\n          <h4 class=\"fs-18 txt-gry text-center\" *ngIf=\"accSettingsData?.primaryContact?.usertype != 'A'\">\r\n            {{accSettingsData?.primaryContact?.firstname}}</h4>\r\n          <!-- <h4 class=\"fs-18 txt-gry text-center\">{{accSettingsData?.primaryContact?.firstname}}</h4> -->\r\n        </mat-card-header>\r\n        <mat-card-content>\r\n            <mat-divider></mat-divider>\r\n\r\n          <div class=\"comp_img\" fxLayout=\"row\">\r\n            <!-- <div fxFlex=\"20\">\r\n            <img mat-card-image src=\"assets/images/opalimages/comp_logo.png\" alt=\"pro_pic\">\r\n          </div> -->\r\n            <div class=\"comp_name p-t-20\" fxFlex=\"80\" *ngIf=\"accSettingsData?.primaryContact?.usertype != 'A'\">\r\n              <span class=\"txt-gry fs-14 \" >sdf{{accSettingsData?.companyName}}</span>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row\" class=\"date_detials m-t-15\">\r\n            <!-- <mat-divider></mat-divider> -->\r\n            <span class=\"txt-gry3 fs-15 p-r-30 m-t-15\"\r\n              *ngIf=\"accSettingsData?.primaryContact?.usertype != 'A'\">{{'accountlandingpage.creaon' |\r\n              translate}}</span>\r\n            <span class=\"txt-gry fs-15  m-t-15\"\r\n              *ngIf=\"accSettingsData?.primaryContact?.usertype != 'A'\">{{accSettingsData?.primaryContact?.createdon}}</span>\r\n            <span class=\"txt-gry3 fs-15 p-r-30 m-t-15\"\r\n              *ngIf=\"accSettingsData?.primaryContact?.usertype == 'A'\">{{'accountlandingpage.region' |\r\n              translate}}</span>\r\n            <span class=\"txt-gry fs-15  m-t-15\"\r\n              *ngIf=\"accSettingsData?.primaryContact?.usertype == 'A'\">{{accSettingsData?.primaryContact?.createdon}}</span>\r\n          </div>\r\n        </mat-card-content>\r\n      </mat-card>\r\n    </div>\r\n    <div fxFlex.gt-sm=\"70\" fxFlex=\"100\" class=\"profile \">\r\n      <mat-card class=\"profile_card\">\r\n        <mat-card-header fxLayout=\"column\">\r\n          <div fxLayout=\"row wrap\" fxLayoutAlign=\"space-between center\" class=\"p-b-10\">\r\n            <div class=\"usr_name p-b-10\">\r\n              <p class=\"fs-18 txt-gry m-b-0\">{{accSettingsData?.primaryContact?.firstname}}</p>\r\n              <p class=\"fs-15 txt-gry3 m-b-0 m-t-2\" *ngIf=\"accSettingsData?.primaryContact?.usertype == 'A'\">{{'accountlandingpage.desi' | translate}}: <span\r\n                  class=\"fs-15 txt-gry\">{{accSettingsData?.primaryContact?.designation}}</span></p>\r\n              <p class=\"fs-15 txt-gry3 m-b-0 m-t-2\" *ngIf=\"accSettingsData?.primaryContact?.usertype != 'A'\">{{'accountlandingpage.civil' | translate}}: <span\r\n                    class=\"fs-15 txt-gry\">{{accSettingsData?.primaryContact?.civilnumber}}</span></p>\r\n            </div>\r\n            <div fxLayoutAlign=\"space-between center\" class=\"btns\">\r\n              <button mat-raised-button class=\"edit_btn fs-13 \" (click)=\"editor()\"\r\n                >{{'accountlandingpage.edit' | translate}} <mat-icon\r\n                class=\"material-icons-outlined fs-15 p-t-3\">edit</mat-icon></button>\r\n              <button mat-raised-button class=\"pass_btn fs-13\"\r\n                [routerLink]=\"'/accountsettings/changepassword'\">{{'accountlandingpage.chanpass' | translate}}</button>\r\n              <!-- <button mat-raised-button class=\"view_btn fs-13\">{{'accountlandingpage.viewperm' | translate}}</button> -->\r\n            </div>\r\n          </div>\r\n        </mat-card-header>\r\n        <mat-divider class=\"m-l-27\"></mat-divider>\r\n        <mat-card-content>\r\n          <div fxLayout=\"row\" class=\"m-t-20\">\r\n            <div fxFlex=\"35\">\r\n              <span class=\"fs-16 txt-gry3\">{{'accountlandingpage.emailid' | translate}}</span>\r\n            </div>\r\n            <div fxFlex=\"65\" fxLayout=\"row\">\r\n              <span class=\"fs-16 txt-gry\">{{accSettingsData?.primaryContact?.emailid}}</span>\r\n              <span *ngIf=\"accSettingsData?.primaryContact?.confirmstatus == 1\"\r\n                class=\"verified fs-11 m-l-20\">{{'accountlandingpage.veri' | translate}}</span>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row\" class=\"m-t-20\">\r\n            <div fxFlex=\"35\">\r\n              <span class=\"fs-16 txt-gry3\">{{'accountlandingpage.mobi' | translate}}</span>\r\n            </div>\r\n            <div fxFlex=\"65\">\r\n              <span class=\"fs-16 txt-gry\">{{accSettingsData?.primaryContact?.mobilecc}}&nbsp; <span\r\n                  id=\"mobinumb\">{{accSettingsData?.primaryContact?.mobileno}}</span></span>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row\" class=\"m-t-20\">\r\n            <div fxFlex=\"35\">\r\n              <span class=\"fs-16 txt-gry3\">{{'accountlandingpage.passseton' | translate}}</span>\r\n            </div>\r\n            <div fxFlex=\"65\">\r\n              <span class=\"fs-16 txt-gry\">{{accSettingsData?.primaryContact?.emailpassseton}}</span>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row\" class=\"m-t-20\">\r\n            <div fxFlex=\"35\">\r\n              <span class=\"fs-16 txt-gry3\">{{'accountlandingpage.lastpasschan' | translate}}</span>\r\n            </div>\r\n            <div fxFlex=\"65\">\r\n              <span class=\"fs-16 txt-gry\">{{accSettingsData?.primaryContact?.lastchangepass}}</span>\r\n            </div>\r\n          </div>\r\n        </mat-card-content>\r\n      </mat-card>\r\n    </div>\r\n\r\n  </div>\r\n  <app-userallocation *ngIf=\"accSettingsData?.primaryContact?.usertype != 'A'\"></app-userallocation>\r\n  <!-- <app-viewpermissionsidenav *ngIf=\"accSettingsData?.primaryContact?.usertype != 'A'\"></app-viewpermissionsidenav> -->\r\n  <div class=\"banner\">\r\n  </div>\r\n  \r\n</div>\r\n<app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.html":
  /*!**********************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.html ***!
    \**********************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsAudittrailsidenavAudittrailsidenavComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" class=\"audit_mainclass\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex.gt-xs=\"100\" fxFlex=\"100\">\r\n        <div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"m-t-0 p-b-0\">\r\n            <!-- column -->\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\" selectproductheaderwithclose\">\r\n                <div class=\"titletext\">\r\n                    <div class=\"closeandadd\">\r\n                        <i mat-button matTooltip=\"Close\" aria-label=\"Displays a tooltip\"\r\n                            matTooltipClass=\"custom-tooltip\" (click)=\"auditalert()\"\r\n                            class=\"bgi bgi-close p-l-5 fs-14\"></i>\r\n                        <h5 class=\"m-0 p-l-20 tt\">Audit Trail<i class=\"bgi bgi-info\"\r\n                                (click)=\"audittraildropdown('audittraillist')\"></i></h5>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\" class=\"p-t-0 audittraillist\" [@slideInOut]=\"animationState\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\">\r\n                <mat-card class=\"headerinformationtext sidenavinfotext m-r-0\">\r\n                    <mat-card-header>\r\n                        <div class=\"titletext\" fxFlex.xs=\"100\" fxFlex.sm=\"80\" fxFlex.md=\"100\" fxFlex.lg=\"100\"\r\n                            fxFlex.xl=\"100\">\r\n                            <mat-card-subtitle class=\"informationtext fs-14\">\r\n                                Audit Trail\r\n                            </mat-card-subtitle>\r\n                        </div>\r\n                        <div class=\"selectforward m-r-0\">\r\n                            <div class=\"p-l-15 gotit\">\r\n                                <span (click)=\"audittraildropdown('audittraillist')\" mat-raised-button\r\n                                    color=\"primary\">Ok, Got\r\n                                    It\r\n                                </span>\r\n                            </div>\r\n                        </div>\r\n                    </mat-card-header>\r\n                </mat-card>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"audittrailbottomlist\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"audittrailflexalign p-l-50 p-r-50\">\r\n                <div class=\"p-t-8 p-b-8\">\r\n                    <div class=\"auditheader\">\r\n                        <div class=\"imageview\">\r\n                            <img src=\"assets/images/NoimageJPG.jpg\" alt=\"NoimageJPG\">\r\n                        </div>\r\n                        <div class=\"subtitleofaudit\">\r\n                            <h4 class=\"fs-15 lypisfont-semibold m-0\">Zachary Spencer</h4>\r\n                            <p class=\"fs-14 txt-gray m-0\">Associate Software Test Engineer Employement</p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class=\"innnerpartofdrwer\">\r\n            <div fxLayout=\"row wrap\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"audit_traillist\">\r\n                    <div class=\"daterangepickerfilter\">\r\n                        <div class=\"flexdaterange\">\r\n                            <p class=\"fs-14 txt-gray m-0\">Activity Count: 3\r\n                            </p>\r\n                            <div class=\"dateselect\">\r\n                                <mat-form-field>\r\n                                    <div class=\"drpicker\">\r\n                                        <input id=\"login_session\" [formControl]=\"dateFilter\" #login_session matInput\r\n                                            type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd [dateLimit]=\"14\"\r\n                                            [locale]=\"locale\" [singleDatePicker]=\"false\" placeholder=\"Select Date Range\"\r\n                                            [autoApply]=\"false\" [maxDate]='selected2' [showClearButton]=\"true\"\r\n                                            [showDropdowns]=\"true\" readonly class=\"form-control\" />\r\n                                        <div class=\"closeanddateicon\">\r\n                                            <mat-icon class=\"cleardate\" matDatepickerToggleIcon\r\n                                                (click)=\"clearDatelogin($event);$event.stopPropagation()\">clear\r\n                                            </mat-icon>\r\n                                            <mat-datepicker-toggle matSuffix></mat-datepicker-toggle>\r\n                                        </div>\r\n                                    </div>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <mat-table #table [dataSource]=\"dataSource\" multiTemplateDataRows\r\n                        class=\"heading_oftable headercolor p-t-10\">\r\n                        <ng-container matColumnDef=\"s_no\">\r\n                            <th fxFlex=\"10\" *matHeaderCellDef class=\"m-l-12 lypisfont-semibold\"> S.No</th>\r\n                            <td fxFlex=\"10\" *matCellDef=\"let element\" data-label=\"S.No\" class=\"m-l-12\">\r\n                                {{element.sno}}\r\n                            </td>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"date_time\">\r\n                            <th fxFlex=\"25\" *matHeaderCellDef class=\"lypisfont-semibold\"> Date & Time </th>\r\n                            <td fxFlex=\"25\" *matCellDef=\"let element\" data-label=\"Date & Time\">\r\n                                {{element.datetime}} </td>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"module\">\r\n                            <th fxFlex=\"65\" *matHeaderCellDef class=\"lypisfont-semibold\"> Module </th>\r\n                            <td fxFlex=\"65\" [title]=\"element.modulename\" *matCellDef=\"let element\" data-label=\"Module\" class=\"aftercolor\">\r\n                                {{element.modulename | truncate:[45]}}\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"expandedDetail\">\r\n                            <td mat-cell *matCellDef=\"let element\" [attr.colspan]=\"columnsToDisplay.length\">\r\n                                <div class=\"example-element-detail\"\r\n                                    [@detailExpand]=\"element == expandedElement ? 'expanded' : 'collapsed'\">\r\n                                    <table class=\"gdpcontribution\">\r\n                                        <tr>\r\n                                            <td>\r\n                                                <div fxLayout=\"row wrap\" class=\"expand_mainclass\">\r\n                                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-25\">\r\n                                                        <div class=\"profilecolor\">\r\n                                                            <p class=\"lypisfont-bold fs-16\">PROFILE</p>\r\n                                                        </div>\r\n                                                        <div fxLayout=\"row wrap\" class=\"externalbox\"\r\n                                                            *ngFor=\"let companylist of companydataview\">\r\n                                                            <div fxFlex.gt-sm=\"85\" fxFlex=\"100\">\r\n                                                                <div class=\"subtitle_secondrow\">\r\n                                                                    <h4\r\n                                                                        class=\"fs-15 lypisfont-semibold txt-gray3 p-b-5\">\r\n                                                                        {{companylist.profiletitle}}</h4>\r\n                                                                    <p class=\"fs-13\">{{companylist.profilesubtitlte}}\r\n                                                                    </p>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                            <div fxFlex.gt-sm=\"15\" fxFlex=\"100\"\r\n                                                                class=\"end_switch\">\r\n                                                                <div class=\"p-r-25\">\r\n                                                                    <span class=\"txt-gray3 fs-15\"\r\n                                                                        *ngIf=\"companylist.status == 'on'\"\r\n                                                                        class=\"oncolor fs-15 lypisfont-semibold\">On</span>\r\n                                                                    <span class=\"oncolor\"\r\n                                                                        *ngIf=\"companylist.status == 'off'\"\r\n                                                                        class=\"offcolor fs-15 lypisfont-semibold\">Off</span>\r\n                                                                </div>\r\n                                                            </div>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </div>\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>\r\n                                </div>\r\n                            </td>\r\n                        </ng-container>\r\n\r\n                        <mat-header-row *matHeaderRowDef=\"columnsToDisplay\"></mat-header-row>\r\n                        <mat-row *matRowDef=\"let element; columns: columnsToDisplay;\" class=\"example-element-row\"\r\n                            [class.example-expanded-row]=\"expandedElement === element\"\r\n                            (click)=\"expandedElement = expandedElement === element ? null : element\">\r\n                        </mat-row>\r\n                        <mat-row *matRowDef=\"let row; columns: ['expandedDetail']\" class=\"example-detail-row\"></mat-row>\r\n                    </mat-table>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.html":
  /*!******************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.html ***!
    \******************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsChangepasswordbackendChangepasswordbackendComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div id=\"pass_change\"  dir=\"{{dir}}\" class=\"{{dir}}\">\r\n  <div class=\"content_box\">\r\n    <div fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n      <div fxFlex=\"70\" fxFlex.gt-sm=\"40\" [ngSwitch]=\"changePasswordTemplate\">\r\n        <ng-template [ngSwitchCase]=\"'PassForm'\">\r\n          <form [formGroup]=\"changePasswordForm\" autocomplete=\"off\" (ngSubmit)=\"saveNewPasswords()\">\r\n            <div class=\"card\" [ngSwitch]=\"FormTemplate\">\r\n              <ng-template [ngSwitchCase]=\"'currentpass'\">\r\n                <h4 class=\"txt-gry fs-20\">{{'changepassword.changpass' | translate}}</h4>\r\n                <p class=\"txt-gry3 fs-16\">{{'changepassword.wewillsendypuon' | translate}}</p>\r\n                <mat-form-field appearance=\"outline\">\r\n                  <mat-label>{{'changepassword.currpass' | translate}}</mat-label>\r\n                  <input autocomplete=\"off\" maxlength=\"20\" appAlphanumsymb (keydown.enter)=\"$event.preventDefault();SendOTP()\"\r\n                    [type]=\"isInputTextTypefirst ? 'text' : 'password'\" type=\"password\" app-restrict-input=\"firstspace\"\r\n                    matInput required formControlName=\"currentpassword\">\r\n                  <span matSuffix class=\"spaceinfo\">\r\n                    <i class=\"fa fa-eye-slash fs-16\" aria-hidden=\"true\" *ngIf=\"!isInputTextTypefirst\"\r\n                      (click)=\"isInputTextTypefirst = !isInputTextTypefirst\"></i>\r\n                    <i class=\"fa fa-eye fs-16\" aria-hidden=\"true\" *ngIf=\"isInputTextTypefirst\"\r\n                      (click)=\"isInputTextTypefirst = !isInputTextTypefirst\"></i>\r\n                  </span>\r\n                  <mat-error\r\n                    *ngIf=\"changePasswordForm.controls['currentpassword'].hasError('required') || changePasswordForm.submitted\"\r\n                    class=\" font-14\">{{'changepassword.entecurrpass' | translate}}</mat-error>\r\n                  <mat-error *ngIf=\"changePasswordForm.controls['currentpassword'].hasError('invalidPassword')\"\r\n                    class=\" font-14\">{{'changepassword.invacurrpass' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <div fxLayoutAlign=\"end\" class=\"m-t-10\">\r\n                  <button type=\"button\" (click)=\"backtoaccount()\" class=\"cancelbtn \" mat-raised-button\r\n                    mat-buttons>{{'changepassword.canc' | translate}}</button>\r\n                  <mat-spinner-button (click)=\"SendOTP()\" mat-raised-button class=\"subbtn m-l-15 \"\r\n                    [options]=\"spinnerButtonOptionssaveupdate\" ></mat-spinner-button>\r\n                  <!-- <button type=\"button\" (click)=\"SendOTP()\" color=\"primary\" mat-raised-button class=\"subbtn fs-14\">{{'changepassword.sendotp' | translate}}</button> -->\r\n                </div>\r\n\r\n              </ng-template>\r\n              <ng-template [ngSwitchCase]=\"'otpscreen'\">\r\n                <h4 class=\"txt-gry fs-20\">{{'changepassword.enteotp' | translate}}</h4>\r\n                <p class=\"txt-gry3 fs-16\">{{'changepassword.entetheotp' | translate}}</p>\r\n                <div class=\"fields\">\r\n                  <div class=\"divouter\">\r\n                    <mat-form-field appearance=\"none\" class=\"flexalign divinner\">\r\n                      <input maxlength=\"4\" type=\"text\" formControlName=\"verifyotp\" (keydown.enter)=\"$event.preventDefault();VerifyOTP()\"\r\n                        (keydown.space)=\"$event.preventDefault();\" class=\"inputcolor\" id=\"partitioned\" matInput\r\n                        loginname app-restrict-input=\"firstspace\" appNumberonly>\r\n                        <span class=\"otpfield\"></span>\r\n                    </mat-form-field>\r\n                  </div>\r\n                  <div class=\"error\" fxLayoutAlign=\"center\">\r\n                    <div fxFlex=\"100\" fxLayoutAlign=\"space-between center\" class=\"m-r-23\">\r\n                      <mat-error\r\n                        *ngIf=\"changePasswordForm.controls.verifyotp?.errors?.invalidOTP ||  changePasswordForm.submitted\"\r\n                        class=\"fs-14 \" fxFlex=\"100\">\r\n                        {{'changepassword.ivaliotp' | translate}}\r\n                      </mat-error>\r\n                      <mat-error fxFlex=\"100\" *ngIf=\"changePasswordForm.controls.verifyotp?.errors?.ExpiredOTP\" class=\"fs-14 \">\r\n                        {{'changepassword.expiredotp' | translate}}\r\n                      </mat-error>\r\n\r\n                      <div fxLayoutAlign=\"end\" fxFlex=\"100\">\r\n                        <button  type=\"button\" class=\"fs-14 m-l-20 resentbtn\" *ngIf=\"disableResend == false\"\r\n                          [disabled]=\"disableResend == true\" (click)=\"resendOtp()\">{{'changepassword.reseotp' |\r\n                          translate}}</button>\r\n                        <mat-hint *ngIf=\"disableResend == true\" class=\"txt-gry fs-14\">{{'changepassword.reseotpin' |\r\n                          translate}} <span class=\"txt-red fs-14\">{{countDown}}</span></mat-hint>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                  <!-- <div class=\"error\" fxLayoutAlign=\"center\">\r\n                    <div fxFlex=\"90\" fxLayoutAlign=\"space-between center\">\r\n                      <div fxFlex=\"50\">\r\n                        <mat-error\r\n                          *ngIf=\"changePasswordForm.controls.verifyotp?.errors?.invalidOTP ||  changePasswordForm.submitted\"\r\n                          class=\"fs-14 \">\r\n                          {{'changepassword.ivaliotp' | translate}}\r\n                        </mat-error>\r\n                        <mat-error *ngIf=\"changePasswordForm.controls.verifyotp?.errors?.ExpiredOTP\" class=\"fs-14 \">\r\n                          {{'changepassword.ivaliotp' | translate}}\r\n                        </mat-error>\r\n                      </div>\r\n                     \r\n                    </div>\r\n                    <button fxFlex=\"50\" type=\"button\" class=\"fs-14 m-l-20 resentbtn\" *ngIf=\"disableResend == false\"\r\n                    [disabled]=\"disableResend == true\" (click)=\"resendOtp()\">{{'changepassword.reseotp' |\r\n                    translate}}</button>\r\n                    <div fxLayoutAlign=\"end\" fxFlex=\"100\">\r\n                      <mat-hint *ngIf=\"disableResend == true\" class=\"txt-gry fs-14\">{{'changepassword.reseotpin' |\r\n                        translate}} <span class=\"txt-red fs-14\">{{countDown}}</span></mat-hint>\r\n                    </div>\r\n                  </div> -->\r\n                </div>\r\n\r\n                <div class=\"m-t-20 btns\">\r\n                  <mat-spinner-button (click)=\"VerifyOTP()\" mat-raised-button class=\"procbtn m-l-15\"\r\n                    [options]=\"spinnerButtonOptionsproceed\"></mat-spinner-button>\r\n                  <!-- <button mat-raised-button type=\"button\" (click)=\"VerifyOTP()\" class=\"procbtn fs-16\">{{'changepassword.proc' | translate}}</button> -->\r\n                </div>\r\n              </ng-template>\r\n              <ng-template [ngSwitchCase]=\"'newpasswords'\">\r\n                <h4 class=\"txt-gry fs-20\">{{'changepassword.setpass' | translate}}</h4>\r\n                <!-- <p class=\"txt-gry3 fs-16\">{{'changepassword.wewillsendypuon' | translate}} -->\r\n                <!-- </p> -->\r\n                <mat-form-field appearance=\"outline\">\r\n                  <mat-label>{{'changepassword.newpass' | translate}}</mat-label>\r\n                  <!-- <input autocomplete=\"off\" [popover]=\"usersviewlits\" popoverPlacement=\"left\" [popoverOnHover]=\"false\"\r\n                    maxlength=\"20\" appAlphanumsymb [type]=\"isInputTextTypefirst ? 'text' : 'password'\" type=\"password\"\r\n                    (focus)=\"passwordFieldCtrl.markAsTouched()\" (keydown.space)=\"$event.preventDefault();\" \r\n                    [popoverCloseOnClickOutside]=\"changePasswordForm.controls['newpassword'].valid\"\r\n                    [popoverCloseOnMouseOutside]=\"changePasswordForm.controls['newpassword'].valid\"\r\n                    [popoverAnimation]=\"false\"  autocomplete=\"off\"\r\n                  maxlength=\"20\" formControlName=\"newpassword\"\r\n                    class=\"inputcolor\" matInput  app-restrict-input=\"firstspace\" required> -->\r\n\r\n                  <input [type]=\"isInputTextTypefirst ? 'text' : 'password'\" maxlength=\"20\" app-restrict-input=\"firstspace\" matInput\r\n                   formControlName=\"newpassword\" [popoverCloseOnMouseOutside]=\"changePasswordForm.controls['newpassword'].valid\"\r\n                  class=\"inputcolor\"  [popoverAnimation]=\"false\"  autocomplete=\"off\" (keydown.space)=\"$event.preventDefault();\" [popoverCloseOnClickOutside]=\"changePasswordForm.controls['newpassword'].valid\" appAlphanumsymb matInput  required [popover]=\"usersviewlits\" popoverPlacement=\"left\" [popoverOnHover]=\"false\">\r\n\r\n                  <span matSuffix class=\"spaceinfo\">\r\n                    <i class=\"fa fa-eye-slash fs-16\" aria-hidden=\"true\" *ngIf=\"!isInputTextTypefirst\"\r\n                      (click)=\"isInputTextTypefirst = !isInputTextTypefirst\"></i>\r\n                    <i class=\"fa fa-eye fs-16\" aria-hidden=\"true\" *ngIf=\"isInputTextTypefirst\"\r\n                      (click)=\"isInputTextTypefirst = !isInputTextTypefirst\"></i>\r\n                  </span>\r\n                  <mat-error\r\n                    *ngIf=\"changePasswordForm.controls['newpassword'].hasError('required')  \"\r\n                    class=\"text-danger font-14\">{{'changepassword.entecurrpass' | translate}}</mat-error>\r\n                  <!-- <mat-error *ngIf=\"changePasswordForm.controls.newpassword?.errors?.lastpass\" class=\"fs-14\">\r\n                    {{'changepassword.connotusesame' | translate}}\r\n                  </mat-error>\r\n                  <mat-error *ngIf=\"changePasswordForm.controls.newpassword?.errors?.username\" class=\"fs-14\">\r\n                    {{'changepassword.usercannopass' | translate}}  \r\n                  </mat-error> -->\r\n                </mat-form-field>\r\n                <popover-content #usersviewlits placement=\"bottom\" [animation]=\"true\"\r\n                  [closeOnClickOutside]=\"changePasswordForm.controls['newpassword'].valid\">\r\n                  <div class=\"popovermaincontent\">\r\n                    <div class=\"passwordheadcolor\">\r\n                      <p id=\"changethesize\">{{'changepassword.passmustcon' | translate}}</p>\r\n                      <ul class=\"containcolor\">\r\n                        <li\r\n                          [class.unmatched]=\"passwordFieldCtrl.errors?.minlength || !changePasswordForm.controls['newpassword'].value\"\r\n                          [class.matched]=\"!passwordFieldCtrl.errors?.minlength && changePasswordForm.controls['newpassword'].value\">\r\n                          {{'changepassword.mini8char' | translate}}</li>\r\n                        <li [class.unmatched]=\"!changePasswordForm.controls['newpassword'].value || !isuppercase\"\r\n                          [class.matched]=\"changePasswordForm.controls['newpassword'].value || isuppercase\">\r\n                          {{'changepassword.oneupper' | translate}}</li>\r\n                        <li [class.unmatched]=\"!changePasswordForm.controls['newpassword'].value || !isnumber\"\r\n                          [class.matched]=\"changePasswordForm.controls['newpassword'].value || isnumber\">\r\n                          {{'changepassword.onenum' | translate}}</li>\r\n                        <li [class.unmatched]=\"!changePasswordForm.controls['newpassword'].value || !issymbol\"\r\n                          [class.matched]=\"changePasswordForm.controls['newpassword'].value || issymbol\">\r\n                          {{'changepassword.onespecichar' | translate}}</li>\r\n                        <li [class.unmatched]=\"!changePasswordForm.controls['newpassword'].value || !issmallcase\"\r\n                          [class.matched]=\"changePasswordForm.controls['newpassword'].value || issmallcase\">\r\n                          {{'changepassword.onelowe' | translate}}</li>\r\n                      </ul>\r\n                    </div>\r\n                  </div>\r\n                </popover-content>\r\n                <mat-form-field appearance=\"outline\" class=\"m-t-15\">\r\n                  <mat-label>{{'changepassword.confipass' | translate}}</mat-label>\r\n                  <input maxlength=\"20\" appAlphanumsymb [type]=\"isInputTextTypefirstcnfm ? 'text' : 'password'\" \r\n                    type=\"password\" app-restrict-input=\"firstspace\" matInput required\r\n                    formControlName=\"confirmnewpassword\">\r\n                  <span matSuffix class=\"spaceinfo\">\r\n                    <i class=\"fa fa-eye-slash fs-16\" aria-hidden=\"true\" *ngIf=\"!isInputTextTypefirstcnfm\"\r\n                      (click)=\"isInputTextTypefirstcnfm = !isInputTextTypefirstcnfm\"></i>\r\n                    <i class=\"fa fa-eye fs-16\" aria-hidden=\"true\" *ngIf=\"isInputTextTypefirstcnfm\"\r\n                      (click)=\"isInputTextTypefirstcnfm = !isInputTextTypefirstcnfm\"></i>\r\n                  </span>\r\n                  <mat-error\r\n                    *ngIf=\"changePasswordForm.controls['confirmnewpassword'].hasError('required') \"\r\n                    class=\"text-danger font-14\">{{'changepassword.enteconfpass' | translate}}</mat-error>\r\n                  <mat-error\r\n                    *ngIf=\"changePasswordForm.controls['confirmnewpassword'].hasError('mustMatch')\"\r\n                    class=\"text-danger font-14\">{{'changepassword.passmustmatc' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <div fxLayoutAlign=\"end\" class=\"m-t-10\">\r\n                  <button type=\"button\" (click)=\"backtoaccount()\" class=\"cancelbtn m-r-15\" mat-raised-button\r\n                    mat-buttons>{{'changepassword.canc' | translate}}</button>\r\n                  <mat-spinner-button type=\"submit\" [options]=\"spinnerButtonOptions\" class=\"fs-14 submitbtns\"\r\n                    [class.previousdisabled]=\"changePasswordForm.invalid || validationCount <= 3\"\r\n                    [disabled]=\"changePasswordForm.invalid || validationCount <= 3\">\r\n                  </mat-spinner-button>\r\n                  <!-- <button type=\"submit\" color=\"white\" mat-raised-button\r\n                    class=\"subbtn fs-14\">{{'changepassword.saveandupda' | translate}}</button> -->\r\n                </div>\r\n              </ng-template>\r\n              <ng-template [ngSwitchCase]=\"'sucesspage'\">\r\n                <div class=\"succes\">\r\n                  <div class=\"successtick\">\r\n                    <span>\r\n                      <mat-icon class=\"bgi bgi-tick\">check</mat-icon>\r\n                    </span>\r\n                  </div>\r\n                  <h4 class=\"txt-gry fs-20\"> {{'changepassword.passsetsucc' | translate}}</h4>\r\n                  <p class=\"txt-gry3 fs-16\">{{'changepassword.youcannowlogi' | translate}} </p>\r\n                </div>\r\n              </ng-template>\r\n            </div>\r\n          </form>\r\n        </ng-template>\r\n      </div>\r\n      <app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>\r\n    </div>\r\n  </div>\r\n  <div class=\"banner\">\r\n\r\n  </div>\r\n  \r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.html":
  /*!****************************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.html ***!
    \****************************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsChangesubscriptionlistviewChangesubscriptionlistviewComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"m-t-0 p-b-0\">\r\n    <!-- column -->\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\" selectproductheaderwithclose\">\r\n      <div class=\"titletext\">\r\n        <div class=\"closeandadd\">\r\n          <i mat-button matTooltip=\"Close\" aria-label=\"Displays a tooltip\" matTooltipClass=\"custom-tooltip\"\r\n            (click)=\"changesubscriptionAlert()\" class=\"bgi bgi-close p-l-5 fs-14\"></i>\r\n          <h5 class=\"m-0 p-l-20 tt\">Change Subscription<i class=\"bgi bgi-info\"\r\n              (click)=\"changesubscriptionlist('changesubscriptionlisted')\"></i></h5>\r\n        </div>\r\n        <div class=\"clearandaddbutton\">\r\n          <button type=\"button\" mat-raised-button color=\"primary\"\r\n            class=\"clearbutton height-35 m-r-10 p-l-20 p-r-20 spacemargin\">Cancel</button>\r\n          <button color=\"preview\" type=\"submit\" mat-raised-button ngClass.xs=\" m-r-15\" ngClass.sm=\" m-r-15\"\r\n            class=\"addbutton height-35 p-l-20 p-r-20\">{{buttonname}}</button>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\" class=\"p-t-0 changesubscriptionlisted\" [@slideInOut]=\"animationState1\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\">\r\n      <mat-card class=\"headerinformationtext sidenavinfotext m-r-0\">\r\n        <mat-card-header>\r\n          <div class=\"titletext\" fxFlex.xs=\"100\" fxFlex.sm=\"80\" fxFlex.md=\"100\" fxFlex.lg=\"100\" fxFlex.xl=\"100\">\r\n            <mat-card-subtitle class=\"informationtext fs-14\">\r\n                Change Subscription\r\n            </mat-card-subtitle>\r\n          </div>\r\n        </mat-card-header>\r\n      </mat-card>\r\n    </div>\r\n  </div>\r\n  <div class=\"innnerpartofdrwer\">\r\n    <app-changesubscriptionlist></app-changesubscriptionlist>\r\n  </div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.html":
  /*!****************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.html ***!
    \****************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsEmailpreferenceslistEmailpreferenceslistComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"pd-30  mainheader\">\r\n  <div fxLayout=\"row wrap\" class=\"alignsecurity p-b-20\">\r\n    <div fxFlex.gt-sm=\"80\" fxFlex=\"100\" class=\"flexaudittrail\">\r\n      <img src=\"assets/images/securitynote.png\" alt=\"securitynote\">\r\n      <div class=\"securitytitle p-l-20\">\r\n        <p class=\"fs-14 m-0\">You'll receive email notifications when there’s critical information about your OPAL\r\n          account.\r\n          You can also choose to<br>\r\n          receive other types of notifications by email.</p>\r\n      </div>\r\n    </div>\r\n    <div fxFlex.gt-sm=\"20\" fxFlex=\"100\" class=\"flexendaudit\">\r\n      <button (click)=\"audittraillview.toggle();\" type=\"button\" mat-raised-button color=\"preview\"\r\n        class=\"lineheight button-35\">\r\n        Audit Trail\r\n      </button>\r\n    </div>\r\n  </div>\r\n  <div id=\"emailprefaccordio\">\r\n    <mat-accordion>\r\n      <mat-expansion-panel [expanded]=\"panel === 1\" (opened)=\"setOpen(1)\">\r\n        <mat-expansion-panel-header (click)=\"scrollTo('page-content')\" [collapsedHeight]=\"customCollapsedHeight\"\r\n          [expandedHeight]=\"customExpandedHeight\">\r\n          <mat-panel-title>\r\n            <div class=\"titlepfcompayname\">\r\n              <p class=\"lypisfont-semibold m-0 fs-16 txt-gray3\">\r\n                Master Company Profile (MCP)\r\n              </p>\r\n            </div>\r\n          </mat-panel-title>\r\n          <mat-panel-description>\r\n          </mat-panel-description>\r\n        </mat-expansion-panel-header>\r\n        <div fxLayout=\"row wrap\" class=\"accordionlistemail\">\r\n          <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n            <div class=\"profilecolor\">\r\n              <p class=\"lypisfont-bold fs-16\">PROFILE</p>\r\n            </div>\r\n            <form [formGroup]=\"Emailprefform\">\r\n              <div formArrayName=\"companyprofiledata\" fxLayout=\"row wrap\" class=\"externalbox\"\r\n                *ngFor=\" let companyprflist of getspecControls(); let i = index;\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                  <div [formGroupName]=\"i\" fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"85\" fxFlex=\"100\">\r\n                      <div class=\"subtitle_secondrow\">\r\n                        <h4 class=\"fs-15 lypisfont-semibold txt-gray3 p-b-5\">\r\n                          {{companyprflist.controls.profiletitle.value}}</h4>\r\n                        <p class=\"fs-13\">{{companyprflist.controls.profilesubtitlte.value}}</p>\r\n                      </div>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"15\" fxFlex=\"100\" class=\"togglemode_switch\">\r\n                      <div class=\"p-r-25\">\r\n                        <span class=\"listviewadded\"\r\n                          [ngClass]=\"{'oncolor':onOff[i] ==true}\">{{Emailprefform.get('companyprofiledata').at(i).get('slide').value\r\n                          == true ? 'On':'Off'}}</span>\r\n                      </div>\r\n                      <mat-slide-toggle (change)=\"setslidevalue(i, $event.checked)\" formControlName=\"slide\">\r\n                      </mat-slide-toggle>\r\n                    </div>\r\n                    <div class=\"m-t-10\" *ngIf=\"Emailprefform.get('companyprofiledata').at(i).get('slide').value\">\r\n                      <div class=\"searchfiltercompany m-t-10\" fxLayout=\"row wrap\">\r\n                        <div class=\"searchhere\">\r\n                          <mat-form-field>\r\n                            <mat-label>Select Mode</mat-label>\r\n                            <mat-select (selectionChange)=\"setmodevalue(i, $event)\" formControlName=\"selectmodevalue\"\r\n                              [disableOptionCentering]=\"true\">\r\n                              <mat-option *ngFor=\"let searchBy of searchOptions\" [value]=\"searchBy.value\">\r\n                                {{searchBy.name}}\r\n                              </mat-option>\r\n                            </mat-select>\r\n                          </mat-form-field>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </form>\r\n          </div>\r\n        </div>\r\n      </mat-expansion-panel>\r\n      <mat-expansion-panel [expanded]=\"panel === 2\" (opened)=\"setOpen(2)\">\r\n        <mat-expansion-panel-header (click)=\"scrollTo('page-content')\" [collapsedHeight]=\"customCollapsedHeight\"\r\n          [expandedHeight]=\"customExpandedHeight\">\r\n          <mat-panel-title>\r\n            <div class=\"titlepfcompayname\">\r\n              <p class=\"lypisfont-semibold m-0 fs-16 txt-gray3\">\r\n                Supplier Certification form (SCF)\r\n              </p>\r\n            </div>\r\n          </mat-panel-title>\r\n          <mat-panel-description>\r\n          </mat-panel-description>\r\n        </mat-expansion-panel-header>\r\n        <div fxLayout=\"row wrap\" class=\"accordionlistemail\">\r\n          <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n            <div class=\"profilecolor\">\r\n              <p class=\"lypisfont-bold fs-16\">SCF</p>\r\n            </div>\r\n            <div fxLayout=\"row wrap\" class=\"externalbox\">\r\n              <div fxFlex.gt-sm=\"85\" fxFlex=\"100\">\r\n                <div class=\"subtitle_secondrow\">\r\n                  <h4 class=\"fs-15 lypisfont-semibold txt-gray3 p-b-5\">\r\n                    When the SCF OPAL Subscription is expired\r\n                  </h4>\r\n                  <p class=\"fs-13\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum,\r\n                    euismod tellus vitae</p>\r\n                </div>\r\n              </div>\r\n              <div fxFlex.gt-sm=\"15\" fxFlex=\"100\" class=\"togglemode_switch\">\r\n                <div class=\"p-r-25\">\r\n                  <span *ngIf=\"!scfform.controls['selectmode'].value\" class=\"txt-gray3 fs-15\">Off</span>\r\n                  <span *ngIf=\"scfform.controls['selectmode'].value\" class=\"oncolor\">On</span>\r\n                </div>\r\n                <mat-slide-toggle [formControl]=\"scfform.controls['selectmode']\"></mat-slide-toggle>\r\n              </div>\r\n              <div class=\"m-t-10\" *ngIf=\"scfform.controls['selectmode'].value\">\r\n                <div class=\"searchfiltercompany\" fxLayout=\"row wrap\">\r\n                  <div class=\"searchhere\">\r\n                    <mat-form-field>\r\n                      <mat-label>Select Mode</mat-label>\r\n                      <mat-select formControlName=\"selectmodestatus\" [disableOptionCentering]=\"true\">\r\n                        <mat-option *ngFor=\"let searchBy of searchOptions\" [value]=\"searchBy.value\">\r\n                          {{searchBy.name}}\r\n                        </mat-option>\r\n                      </mat-select>\r\n                    </mat-form-field>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </mat-expansion-panel>\r\n      <mat-expansion-panel [expanded]=\"panel === 3\" (opened)=\"setOpen(3)\">\r\n        <mat-expansion-panel-header (click)=\"scrollTo('page-content')\" [collapsedHeight]=\"customCollapsedHeight\"\r\n          [expandedHeight]=\"customExpandedHeight\">\r\n          <mat-panel-title>\r\n            <div class=\"titlepfcompayname\">\r\n              <p class=\"lypisfont-semibold m-0 fs-16 txt-gray3\">\r\n                Contract Management System (CMS)\r\n              </p>\r\n            </div>\r\n          </mat-panel-title>\r\n          <mat-panel-description>\r\n          </mat-panel-description>\r\n        </mat-expansion-panel-header>\r\n        <div [formGroup]=\"contractform\" fxLayout=\"row wrap\" class=\"accordionlistemail\">\r\n          <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n            <div class=\"profilecolor\">\r\n              <p class=\"lypisfont-bold fs-16\">Contract</p>\r\n            </div>\r\n            <div fxLayout=\"row wrap\" class=\"externalbox\">\r\n              <div fxFlex.gt-sm=\"85\" fxFlex=\"100\">\r\n                <div class=\"subtitle_secondrow\">\r\n                  <h4 class=\"fs-15 lypisfont-semibold txt-gray3 p-b-5\">\r\n                    When the Contractor's OPAL Subscription is expired\r\n                  </h4>\r\n                  <p class=\"fs-13\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum,\r\n                    euismod tellus vitae</p>\r\n                </div>\r\n              </div>\r\n              <div fxFlex.gt-sm=\"15\" fxFlex=\"100\" class=\"togglemode_switch\">\r\n                <div class=\"p-r-25\">\r\n                  <span *ngIf=\"!contractform.controls['selectstatus'].value\" class=\"txt-gray3 fs-15\">Off</span>\r\n                  <span *ngIf=\"contractform.controls['selectstatus'].value\" class=\"oncolor\">On</span>\r\n                </div>\r\n                <mat-slide-toggle [formControl]=\"contractform.controls['selectstatus']\"></mat-slide-toggle>\r\n              </div>\r\n              <div *ngIf=\"contractform.controls['selectstatus'].value\" class=\"m-t-10\">\r\n                <div class=\"searchfiltercompany\" fxLayout=\"row wrap\">\r\n                  <div class=\"searchhere\">\r\n                    <mat-form-field>\r\n                      <mat-select formControlName=\"selectvaluestatus\" [disableOptionCentering]=\"true\">\r\n                        <mat-option *ngFor=\"let searchBy of searchOptions\" [value]=\"searchBy.value\">\r\n                          {{searchBy.name}}\r\n                        </mat-option>\r\n                      </mat-select>\r\n                    </mat-form-field>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </mat-expansion-panel>\r\n    </mat-accordion>\r\n  </div>\r\n  <div class=\"alignendsave p-t-20\">\r\n    <button mat-raised-button (click)=\"submitform()\" class=\"savebtn fs-15\" type=\"button\">Save</button>\r\n  </div>\r\n</div>\r\n\r\n<mat-drawer-container class=\"example-container sidenavindexclass\">\r\n  <mat-drawer #audittraillview class=\"example-sidenav sidenavsamewidthall auditview\" mode=\"over\" position=\"end\">\r\n    <app-audittrailsidenav [audittraillview]=\"audittraillview\"></app-audittrailsidenav>\r\n  </mat-drawer>\r\n</mat-drawer-container>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/securitydetail/securitydetail.component.html":
  /*!****************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/securitydetail/securitydetail.component.html ***!
    \****************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsSecuritydetailSecuritydetailComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\"  class=\"viewaccounttab rtl\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-t-30\">\r\n    <div class=\"securityheader activescroll spacewhitespace\">\r\n      <div class=\"borderspecheight\">\r\n        <div>\r\n          <div class=\"spencercoor\">\r\n            <p class=\"fs-16 p-r-20 m-0 title lypisfont-semibold\">{{settingsData?.primaryContact.firstname}}</p>\r\n              <span ><i (click)=\"editUser(settingsData?.primaryContact?.pk)\" class=\"bgi bgi-edit1\" matTooltip=\"Edit\">edit</i></span>\r\n            <div class=\"coloractive m-l-10\" *ngIf=\"settingsData?.primaryContact?.isPrimaryContact\">\r\n              <span class=\"fs-13\" *ngIf=\"settingsData?.primaryContact?.isPrimaryContact\">{{'accountdetails.adminpriconttact' | translate}}</span>\r\n            </div>\r\n          </div>\r\n          <div class=\"marketcolor\" >\r\n            <p class=\"fs-14 txt-gray6 m-0\">{{settingsData?.primaryContact?.designation || 'NIL'}}</p>\r\n          </div>\r\n          <!-- <div *ngIf=\"companytype == 6 || companytype == 1\" class=\"domaincolor\">\r\n            <p class=\"fs-14 lypisfont-regular m-0 p-t-6\"><span>DOMAIN:</span> PROCUREMENT</p>\r\n          </div> -->\r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"btnalign\">\r\n          <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"widthuser\">\r\n            <div class=\"alignpassword\">\r\n              <button color=\"primary\" mat-raised-button *ngIf=\"userType && userType == 'U'\" class=\"viewpermission m-r-10 fs-14\"\r\n                (click)=\"getuserpermissiondet(settingsData?.baseModulesAccess);draweruserallocation.toggle()\">{{'accountdetails.viewpermission' | translate}}</button>\r\n              <div class=\"border_btn\">\r\n              <button mat-raised-button class=\"changecolor fs-13\" (click)=\"openDialog()\" >{{'accountdetails.changepwd' | translate}}\r\n              </button>\r\n              \r\n              </div>\r\n              \r\n             <div id=\"changeadminpanel\" *ngIf=\"stakeHolderType != 1\">\r\n              <div\r\n              popover=\"{{'accountdetails.changeadminpopover' | translate}}\"\r\n              popoverPlacement=\"bottom-right\" [popoverOnHover]=\"true\" [popoverCloseOnClickOutside]=\"true\"\r\n              [popoverCloseOnMouseOutside]=\"false\" [popoverDisabled]=\"false\" [popoverAnimation]=\"true\"\r\n              *ngIf=\"userType && userType == 'A' && ischangeadmin == 1 && !isGraceExpired\">\r\n              <button color=\"primary\" *ngIf=\"userType && userType == 'A'\"\r\n                [disabled]=\"userType && userType == 'A' && ischangeadmin == 1 && !isGraceExpired\"\r\n                (click)=\"avoidmulti();drawer.toggle();maporcreateuser?.mapuser.stakeholderUserDetails();maporcreateuser.changeheadername();\"\r\n                mat-raised-button class=\"usercolor fs-13\">{{'accountdetails.changeadmin' | translate}}</button>\r\n            </div>\r\n          \r\n            <div *ngIf=\"userType && userType == 'A' && ischangeadmin == 2 && !isGraceExpired\">                \r\n              <button color=\"primary\" *ngIf=\"userType && userType == 'A'\"\r\n                (click)=\"avoidmulti();drawer.toggle();maporcreateuser?.mapuser.stakeholderUserDetails();maporcreateuser.changeheadername();\"\r\n                mat-raised-button class=\"usercolor fs-13\">{{'accountdetails.changeadmin' | translate}}</button>                  \r\n            </div>\r\n            <div\r\n              popover=\"{{'accountdetails.accessrenewyousubscrip' | translate}}\"\r\n              popoverPlacement=\"bottom-right\" [popoverOnHover]=\"true\" [popoverCloseOnClickOutside]=\"true\"\r\n              [popoverCloseOnMouseOutside]=\"false\" [popoverDisabled]=\"false\" [popoverAnimation]=\"true\"\r\n              *ngIf=\"userType && userType == 'A' && ischangeadmin == 1 && isGraceExpired\">\r\n              <button color=\"primary\" *ngIf=\"userType && userType == 'A'\"\r\n                [disabled]=\"isGraceExpired\"\r\n                (click)=\"avoidmulti();drawer.toggle();maporcreateuser?.mapuser.stakeholderUserDetails();maporcreateuser.changeheadername();\"\r\n                mat-raised-button class=\"usercolor fs-13\">{{'accountdetails.changeadmin' | translate}}</button>\r\n            </div>\r\n            <div *ngIf=\"userType && userType == 'A' && ischangeadmin == 2 && isGraceExpired\">\r\n              <div\r\n              popover=\"{{'accountdetails.accessrenewyousubscrip' | translate}}\"\r\n              popoverPlacement=\"bottom-right\" [popoverOnHover]=\"true\" [popoverCloseOnClickOutside]=\"true\"\r\n              [popoverCloseOnMouseOutside]=\"false\" [popoverDisabled]=\"false\" [popoverAnimation]=\"true\"\r\n              *ngIf=\"isGraceExpired\">\r\n              <button color=\"primary\" *ngIf=\"userType && userType == 'A'\" [disabled]=\"isGraceExpired\"\r\n                (click)=\"avoidmulti();drawer.toggle();maporcreateuser?.mapuser.stakeholderUserDetails();maporcreateuser.changeheadername();\"\r\n                mat-raised-button class=\"usercolor fs-13\">{{'accountdetails.changeadmin' | translate}}</button>\r\n                </div>\r\n            </div>\r\n             </div>\r\n\r\n              \r\n              \r\n            </div>\r\n            <p class=\"fs-14 p-t-10 m-0 txt-gray3\" *ngIf=\"settingsData?.primaryContact?.lastpwdchangedon\">{{'accountdetails.pwdseton' | translate}}\r\n              {{settingsData?.primaryContact?.lastpwdchangedon}}</p>\r\n          </div>\r\n        </div>\r\n      </div>\r\n      <div class=\" p-l-20 p-t-18 p-b-18 borderemail\">\r\n        <div class=\"widthcomp\">\r\n          <div class=\"cmpnyinfo p-b-15\">\r\n            <p class=\"labelcmp m-0 clabel\">{{'accountdetails.emailid' | translate}}</p>\r\n            <p class=\"cvalue m-0\" *ngIf=\"settingsData?.primaryContact?.emailid.length < 50\">\r\n              {{settingsData?.primaryContact?.emailid || 'NIL' | truncate:[50]}} <img\r\n                *ngIf=\"settingsData?.primaryContact?.confirmstatus == 1\" class=\"widthimgcheck p-l-5\"\r\n                src=\"assets/images/check.png\" alt=\"check.png\"></p>\r\n            <p class=\"cvalue m-0\" *ngIf=\"settingsData?.primaryContact?.emailid.length > 50\"\r\n              popover=\"{{settingsData?.primaryContact?.emailid}}\" popoverPlacement=\"bottom-right\"\r\n              [popoverOnHover]=\"true\" [popoverCloseOnClickOutside]=\"true\" [popoverCloseOnMouseOutside]=\"false\"\r\n              [popoverDisabled]=\"false\" [popoverAnimation]=\"true\">{{settingsData?.primaryContact?.emailid || 'NIL' |\r\n              truncate:[50]}} <img *ngIf=\"settingsData?.primaryContact?.confirmstatus == 1\" class=\"widthimgcheck p-l-5\"\r\n                src=\"assets/images/check.png\" alt=\"check.png\"></p>\r\n                <div fxLayoutAlign=\"flex-start center\">\r\n                  <!-- <i  class=\"bgi bgi-edit1 p-l-15\" matTooltip=\"Edit\"></i> -->\r\n\r\n                  <span *ngIf=\"userType == 'A' && settingsData?.primaryContact?.emailverified == 1\"  class=\"verifiedcontent m-l-15\">\r\n                    <i class=\"bgi bgi-tick fs-12\"></i>\r\n                    <span class=\"p-l-8\">Verified</span>\r\n                 \r\n                </span>\r\n                \r\n                </div>\r\n          </div>\r\n          <div class=\"cmpnyinfo\">\r\n            <p class=\"labelcmp m-0 clabel\">{{'accountdetails.mobile' | translate}}</p>\r\n            <p class=\"cvalue m-0\"\r\n              *ngIf=\"settingsData?.primaryContact?.mobilecc && settingsData?.primaryContact?.mobileDialCode && settingsData?.primaryContact?.mobileno\">\r\n              {{settingsData?.primaryContact?.mobilecc}} {{settingsData?.primaryContact?.mobileno}}\r\n            </p>\r\n            <p *ngIf=\"!settingsData?.primaryContact?.mobilecc || !settingsData?.primaryContact?.mobileDialCode || !settingsData?.primaryContact?.mobileno\"\r\n              class=\"cvalue m-0\">{{'accountdetails.nil' | translate}}</p>\r\n              <div fxLayoutAlign=\"flex-start center\">\r\n                <!-- <i  class=\"bgi bgi-edit1 p-l-15\" matTooltip=\"Edit\"></i> -->\r\n                <span  *ngIf=\"userType == 'A' && settingsData?.primaryContact?.mobileverified == 1\"  class=\"verifiedcontent m-l-15\">\r\n                  <i class=\"bgi bgi-tick fs-12\"></i>\r\n                  <span class=\"p-l-8\">Verified</span>\r\n               \r\n                </span>\r\n        \r\n              </div>\r\n          </div>\r\n        </div>\r\n        <div *ngIf=\"userType && (userType == 'A' || userType == 'U') && stakeHolderType != 1 \">\r\n          <div class=\"cmpnyinfo\" *ngIf=\"userType && userType == 'U'\">\r\n            <p class=\"labelcmp m-0 clabel\">{{'accountdetails.division' | translate}}</p>\r\n            <p class=\"m-0 cvalue\" *ngIf=\"settingsData?.primaryContact?.division.length <= 25\">\r\n              {{settingsData?.primaryContact?.division || 'NIL'}}</p>\r\n            <p class=\"cvalue m-0\" *ngIf=\"settingsData?.primaryContact?.division.length > 25\"\r\n              popover=\"{{settingsData?.primaryContact?.division}}\" popoverPlacement=\"bottom-left\"\r\n              [popoverOnHover]=\"true\" [popoverCloseOnClickOutside]=\"true\" [popoverCloseOnMouseOutside]=\"false\"\r\n              [popoverDisabled]=\"false\" [popoverAnimation]=\"true\">{{settingsData?.primaryContact?.division || 'NIL' |\r\n              truncate:[25]}}</p>\r\n          </div>\r\n          <div class=\"cmpnyinfo\">\r\n            <p class=\"labelcmp m-0 clabel\">{{'accountdetails.department' | translate}}</p>\r\n            <p class=\"cvalue m-0\" >\r\n              {{settingsData?.primaryContact?.department || 'NIL'}}</p>\r\n            <!-- <p class=\"cvalue m-0\" *ngIf=\"settingsData?.primaryContact?.departmentCount > 25\"\r\n              popover=\"{{settingsData?.primaryContact?.department}}\" popoverPlacement=\"bottom-left\"\r\n              [popoverOnHover]=\"true\" [popoverCloseOnClickOutside]=\"true\" [popoverCloseOnMouseOutside]=\"false\"\r\n              [popoverDisabled]=\"false\" [popoverAnimation]=\"true\">{{settingsData?.primaryContact?.departmentwithcnt}} </p> -->\r\n          </div>\r\n        </div>\r\n        <!-- <div *ngIf=\"userType && userType == 'U' && companytype == 1\">\r\n          <div class=\"cmpnyinfo\">\r\n            <p class=\"labelcmp m-0\">Created On</p>\r\n            <p class=\"infocmp m-0\">{{settingsData?.primaryContact?.createdon || '-'}}</p>\r\n          </div>\r\n        </div> -->\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<!-- accountsettings -- securitydetail -- maporcreate -->\r\n<mat-drawer-container class=\"example-container\">\r\n  <mat-drawer disableClose #drawer class=\"example-sidenav sidenavsamewidthall\" mode=\"over\" position=\"end\">\r\n    <app-maporcreateuser *ngIf=\"avoidmultiv\" #maporcreateuser [contentObj]=\"contentObj\" (disablechgnadmin)=\"ischangeadmin=1\"\r\n      (showLoader)=\"showLoaderOutput($event)\" [settingsData]=\"settingsData\" [reusedFor]=\"'changeuser'\"\r\n      [drawer]=\"drawer\"></app-maporcreateuser>\r\n  </mat-drawer>\r\n</mat-drawer-container> \r\n<mat-drawer-container class=\"example-container\">\r\n  <mat-drawer disableClose #draweraddinguser  class=\"example-sidenav sidenavsamewidthall\" mode=\"over\" position=\"end\">\r\n    <app-addusersidenav [fromwhere]=\"1\" [fromwheremobile]=\"1\" [triggercountrymst]=\"triggercountryser\" #addUpdateemail #addUpdateUserRef [draweraddinguser]=\"draweraddinguser\"\r\n      [addUserFromType]=\"addUserFromType\" (reloadGrid)=\"reload($event)\"></app-addusersidenav>\r\n  </mat-drawer>\r\n</mat-drawer-container> \r\n  <mat-drawer-container class=\"example-container\">\r\n  <mat-drawer disableClose #draweruserallocation class=\"example-sidenav sidenavsamewidthall filtersidenav\" mode=\"over\"\r\n    position=\"end\">\r\n    <app-userallocation *ngIf=\"viewpermission\"  (showLoader)=\"showLoaderOutput($event)\"  [draweruserallocation]=\"draweruserallocation\" #addUpdateAccess \r\n    (userPermData)=\"userPermData($event)\" [onlyview]=\"1\" [currentUserPk]=\"encrypt.encrypt(settingsData?.primaryContact?.pk)\"></app-userallocation>\r\n  \r\n    <!-- <app-viewpermissionsidenav [viewpermissionsidenav]=\"viewpermissionsidenav\"></app-viewpermissionsidenav> -->\r\n  </mat-drawer>\r\n</mat-drawer-container>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.html":
  /*!****************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.html ***!
    \****************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsSecurityquestionlistSecurityquestionlistComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" class=\"spcesme\">\r\n  <div class=\"alignsecurity p-t-30 p-b-30\">\r\n    <img src=\"assets/images/securitynote.png\" alt=\"securitynote\">\r\n    <div class=\"securitytitle p-l-20\">\r\n      <p class=\"fs-14 m-0\">These Security Questions will help your reset your password if you forget it. Choose two\r\n        questions and supply answers you will<br>\r\n        remember. Using answers that are not easily guessed increases security.</p>\r\n    </div>\r\n  </div>\r\n  <div fxLayout=\"row wrap\" class=\"widthquestion\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n      <form [formGroup]=\"accountsettingForm\" autocomplete=\"off\" (ngSubmit)=\"saveAnswers()\">\r\n        <div fxLayout=\"row wrap\" class=\"alignitems\">\r\n          <div fxFlex.gt-sm=\"70\" fxFlex=\"100\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <mat-select formControlName=\"question1\"  panelClass=\"select_with_search\" [disableOptionCentering]=\"true\" placeholder=\"Security question 1\">\r\n                <div class=\"option-listing\">\r\n                  <mat-option class=\"countrynameselect\"  *ngFor=\"let question of questArr\" [value]=\"question?.questionpk\">{{question?.question}}\r\n                  </mat-option>\r\n                </div>\r\n              </mat-select>\r\n            </mat-form-field>\r\n          </div>\r\n          <div fxFlex.gt-sm=\"30\" fxFlex=\"100\" class=\"p-l-30 spacequestion\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <textarea formControlName=\"answer1\" appAlphanum app-restrict-input=\"firstspace\" maxlength=\"150\" maxle\r\n                matInput placeholder=\"Your answer\" cdkTextareaAutosize #autosize=\"cdkTextareaAutosize\"\r\n                cdkAutosizeMinRows=\"1\" cdkAutosizeMaxRows=\"5\"></textarea>\r\n            </mat-form-field>\r\n          </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"alignitems\">\r\n          <div fxFlex.gt-sm=\"70\" fxFlex=\"100\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <mat-select formControlName=\"question2\"  panelClass=\"select_with_search\" [disableOptionCentering]=\"true\" placeholder=\"Security question 2\">\r\n                <div class=\"option-listing\">\r\n                  <mat-option class=\"countrynameselect\"  *ngFor=\"let question of questArr\" [value]=\"question?.questionpk\">{{question?.question}}\r\n                  </mat-option>\r\n                </div>\r\n              </mat-select>\r\n            </mat-form-field>\r\n          </div>\r\n          <div fxFlex.gt-sm=\"30\" fxFlex=\"100\" class=\"p-l-30 spacequestion\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <textarea formControlName=\"answer2\" appAlphanum app-restrict-input=\"firstspace\" maxlength=\"150\" matInput\r\n                placeholder=\"Your answer\" cdkTextareaAutosize #autosize=\"cdkTextareaAutosize\" cdkAutosizeMinRows=\"1\"\r\n                cdkAutosizeMaxRows=\"5\"></textarea>\r\n            </mat-form-field>\r\n          </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"alignitems\">\r\n          <div fxFlex.gt-sm=\"70\" fxFlex=\"100\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <mat-select formControlName=\"question3\"  panelClass=\"select_with_search\" [disableOptionCentering]=\"true\" placeholder=\"Security question 3\">\r\n                <div class=\"option-listing\">\r\n                  <mat-option class=\"countrynameselect\"  *ngFor=\"let question of questArr\" [value]=\"question?.questionpk\">{{question?.question}}\r\n                  </mat-option>\r\n                </div>\r\n              </mat-select>\r\n            </mat-form-field>\r\n          </div>\r\n          <div fxFlex.gt-sm=\"30\" fxFlex=\"100\" class=\"p-l-30 spacequestion\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <textarea formControlName=\"answer3\" appAlphanum app-restrict-input=\"firstspace\" maxlength=\"150\" matInput\r\n                placeholder=\"Your answer\" cdkTextareaAutosize #autosize=\"cdkTextareaAutosize\" cdkAutosizeMinRows=\"1\"\r\n                cdkAutosizeMaxRows=\"5\"></textarea>\r\n            </mat-form-field>\r\n          </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"alignitems\">\r\n          <div fxFlex.gt-sm=\"70\" fxFlex=\"100\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <mat-select formControlName=\"question4\"  panelClass=\"select_with_search\" [disableOptionCentering]=\"true\" placeholder=\"Security question 4\">\r\n                <div class=\"option-listing\">\r\n                  <mat-option class=\"countrynameselect\" *ngFor=\"let question of questArr\" [value]=\"question?.questionpk\">{{question?.question}}\r\n                  </mat-option>\r\n                </div>\r\n              </mat-select>\r\n            </mat-form-field>\r\n          </div>\r\n          <div fxFlex.gt-sm=\"30\" fxFlex=\"100\" class=\"p-l-30 spacequestion\">\r\n            <mat-form-field class=\"p-b-12\">\r\n              <textarea formControlName=\"answer4\" appAlphanum app-restrict-input=\"firstspace\" maxlength=\"150\" matInput\r\n                placeholder=\"Your answer\" cdkTextareaAutosize #autosize=\"cdkTextareaAutosize\" cdkAutosizeMinRows=\"1\"\r\n                cdkAutosizeMaxRows=\"5\"></textarea>\r\n            </mat-form-field>\r\n          </div>\r\n        </div>\r\n        <mat-error *ngIf=\"accountsettingForm.errors?.selecttwo\">Select any two question and give answer</mat-error>\r\n        <div class=\"alignendsave\">\r\n          <button (click)=\"accountsettingForm.reset()\" mat-raised-button class=\"cancel m-r-15 fs-15\">Clear</button>\r\n          <button type=\"submit\" mat-raised-button class=\"save fs-15\" [disabled]=\"accountsettingForm.invalid\">Save\r\n            Answers</button>\r\n        </div>\r\n      </form>\r\n    </div>\r\n  </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.html":
  /*!**********************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.html ***!
    \**********************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsSubscriptionpaymentlistSubscriptionpaymentlistComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" class=\"spcesme p-t-15 activescroll paymentview rtl\"  *ngIf=\"settingsData\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"contactpopover\">\r\n    <div class=\"jsrscolor\">\r\n      <h2>{{'subscriptionpayment.jsrscertsubscrip' | translate}}</h2>\r\n    </div>\r\n    <div class=\"m-l-20 m-b-20\">\r\n      <mat-accordion *ngIf=\"settingsData?.renewalstatus=='D'\">\r\n        <mat-expansion-panel (opened)=\"setOpen(1)\" [expanded]=\"panel === 1\">\r\n          <mat-expansion-panel-header (click)=\"scrollTo('page-content')\">\r\n            <mat-panel-title>\r\n              <div class=\"alignpayment\">\r\n                <img src=\"assets/images/exclamatorycircle.png\" alt=\"exclamatorycircle.png\">\r\n                <div class=\"declinedtext p-l-15 titletext\">\r\n                  <h2>{{'subscriptionpayment.paymentdeclined' | translate}}</h2>\r\n                  <!-- <p> {{settingsData.payComments}}\r\n                  </p> -->\r\n                </div>\r\n              </div>\r\n            </mat-panel-title>\r\n            <mat-panel-description>\r\n            </mat-panel-description>\r\n          </mat-expansion-panel-header>\r\n          <div class=\"accordionshowtext p-t-10\" *ngIf=\"settingsData?.renewalstatus=='D'\">\r\n            <div class=\"fs-14 m-0 d-flex\" >\r\n              <p class=\"m-r-5 mw75\">{{'subscriptionpayment.comments' | translate}} </p>\r\n              <p [innerHTML]=\"settingsData.payComments\" class=\"posreltop0\"></p>\r\n            </div>\r\n          </div>\r\n        </mat-expansion-panel>\r\n      </mat-accordion>\r\n    </div>\r\n\r\n    <div class=\"borderspeccompanycolor\">\r\n      <div>\r\n        <div class=\"spencercoorpayment\">\r\n          <p class=\"fs-15 p-r-20\">{{'subscriptionpayment.compclassify' | translate}}</p>\r\n        </div>\r\n        <div class=\"p-b-20\">\r\n          <span class=\"fs-12 m-0\" [class.micro]=\"settingsData?.classificationType?.toLowerCase().includes('micro')\"\r\n            [class.small]=\"settingsData?.classificationType?.toLowerCase().includes('small')\"\r\n            [class.medium]=\"settingsData?.classificationType?.toLowerCase().includes('medium')\"\r\n            [class.large]=\"settingsData?.classificationType?.toLowerCase().includes('large') || settingsData?.classificationType?.toLowerCase().includes('international')\">\r\n            {{settingsData?.classificationType}}</span>\r\n        </div>\r\n      </div>\r\n      <div fxLayout=\"row wrap\" class=\"btnalign\">\r\n        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"widthuserbtn\">\r\n          <div class=\"alignpassword position\">\r\n            <!-- <button mat-raised-button class=\"collaberatebtncolor m-r-10 fs-14\">Collaborations</button> -->\r\n            <!-- <button mat-raised-button\r\n              *ngIf=\"settingsData?.payStatus==1 || settingsData?.payStatus==2 || settingsData?.payStatus==4 || settingsData?.payStatus==5 || settingsData?.payStatus==6 || settingsData?.invoiceStatus=='G'\"\r\n              (click)=\"downloadInvoice()\" [matMenuTriggerFor]=\"invrecdownload\" class=\"renewcolor fs-14 downspace\"><i\r\n                class=\"bgi bgi-download fs-14 colorlogo p-r-8\"></i><span>{{'subscriptionpayment.invoice' | translate}}</span>\r\n            </button> -->\r\n            <!-- <button mat-raised-button *ngIf=\"settingsData?.invoiceStatus!='G' && settingsData?.payStatus==3 && (settingsData?.renewalstatus=='A' || settingsData?.renewalstatus=='R')\" (click)=\"downloadReceipt()\"\r\n              [matMenuTriggerFor]=\"invrecdownload\" class=\"renewcolor fs-14 downspace\"><i\r\n                class=\"bgi bgi-download fs-14 colorlogo p-r-8\"></i><span>{{'subscriptionpayment.receipt' | translate}}</span>\r\n            </button> -->\r\n            <!-- <button mat-raised-button class=\"usercolor fs-14\"  (click)=\"changesubscriptiondrawer.toggle()\">Change Subscription</button> -->\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    <div class=\" p-l-20 p-l-20 p-t-18 p-b-18 borderemail\">\r\n      <div class=\"widthcompmain\" *ngIf=\"settingsData\">\r\n        <!-- <div class=\"cmpnyinfo aligndomian\">\r\n          <p class=\"labelcmp m-0 clable\">Domain</p>\r\n          <p class=\"cvalue m-0\">Procurement</p>\r\n        </div> -->\r\n        <!-- <div class=\"cmpnyinfo aligndomian\">\r\n          <p class=\"labelcmp m-0 clable\">{{'subscriptionpayment.supplierid' | translate}}</p>\r\n          <p class=\"infocmp m-0 cvalue\">{{settingsData?.supplierid}}</p>\r\n        </div> -->\r\n        <div class=\"cmpnyinfo aligndomian\" *ngIf=\"orginstatus == 'N'\">\r\n          <p class=\"labelcmp m-0 clable\">{{'subscriptionpayment.headcount' | translate}}</p>\r\n          <p class=\"m-0 cvalue\" *ngIf=\"!settingsData?.headCount?.toLowerCase().includes('employees')\">\r\n            {{settingsData?.headCount + ' Employees' }}</p>\r\n          <p class=\"m-0 cvalue\" *ngIf=\"settingsData?.headCount?.toLowerCase().includes('employees')\">\r\n            {{settingsData?.headCount}}</p>\r\n        </div>\r\n        <div class=\"cmpnyinfo aligndomian\">\r\n          <p class=\"labelcmp m-0 clable\">{{'subscriptionpayment.OPALcertfee' | translate}}</p>\r\n          <p class=\"cvalue m-0\">\r\n            {{ settingsData?.packageDtl?.subscription?.packageBaseCurrencySymbol}}\r\n            {{ settingsData?.packageDtl?.subscription?.packageBaseCurrencySymbol === 'OMR' ?\r\n            settingsData?.packageDtl?.subscription?.packageBasePrice :\r\n            settingsData?.packageDtl?.subscription?.packageBasePrice}}\r\n          </p>\r\n          <!-- <p class=\"infocmp m-0\">\r\n              OMR 100.000\r\n            </p> -->\r\n          <!-- <p class=\"infocmp m-0\">\r\n               USD 1000.00\r\n            </p> -->\r\n        </div>\r\n      </div>\r\n      <div class=\"widthcompsale\">\r\n        <div class=\"cmpnyinfo aligndomian\" *ngIf=\"settingsData?.origin != 'INTERNATIONAL' && !hideChangeSubscription\">\r\n          <p class=\"labelcmp m-0 clable\">{{'subscriptionpayment.annualsale' | translate}}</p>\r\n          <p class=\"cvalue m-0\">\r\n            {{settingsData?.annualSales}}</p>\r\n        </div>\r\n        <div class=\"cmpnyinfo aligndomian\">\r\n          <p class=\"labelcmp m-0 clable\">{{'subscriptionpayment.subscripperiod' | translate}}</p>\r\n          <p class=\"cvalue m-0\">{{ settingsData?.packageDtl?.subscription?.duration?.Years}}\r\n            {{settingsData?.packageDtl?.subscription?.duration?.Years > 1 ? 'Years' : 'Year' }}</p>\r\n        </div>        \r\n      </div>\r\n      <div class=\"nextrenewal p-l-25\">\r\n        <div class=\"cmpnyinfo aligndomian p-b-0\">\r\n          <div class=\"flexstartalign p-b-8\" *ngIf=\"(settingsData?.renewTempData || settingsData?.renewalstatus=='A' || settingsData?.renewalstatus=='R') && (settingsData?.invoiceStatus!='G' || settingsData?.renewalstatus=='D')\">\r\n            <div class=\"paymentstatuscolor m-r-20\" *ngIf=\"settingsData?.payStatus!=4\">\r\n              <p>{{'subscriptionpayment.paymentstatus' | translate}}</p>\r\n              <a mat-raised-button [routerLink]=\"['/afterlogin/certificationpaymentdetail']\"\r\n                routerLinkActive=\"router-link-active\" *ngIf=\"settingsData?.payStatus=='1'\"\r\n                class=\"postedverification  fs-14\">{{'subscriptionpayment.postedforverfy' | translate}}</a>\r\n              <a mat-raised-button [routerLink]=\"['/afterlogin/certificationpaymentdetail']\"\r\n                *ngIf=\"settingsData?.payStatus=='2'\" class=\"paymentinprogress  fs-14\">{{'subscriptionpayment.payinprogress' | translate}}</a>\r\n              <a mat-raised-button *ngIf=\"settingsData?.payStatus=='3'\" class=\"approve  fs-14\">{{'accountdetails.approved' | translate}}</a>\r\n              <a mat-raised-button [routerLink]=\"['/afterlogin/certificationpaymentdetail']\"\r\n                *ngIf=\"settingsData?.payStatus=='6'\" class=\"failed  fs-14\">{{'subscriptionpayment.failed' | translate}}</a>\r\n              <a mat-raised-button [routerLink]=\"['/afterlogin/certificationpaymentdetail']\"\r\n                *ngIf=\"settingsData?.payStatus=='8'\" class=\"resubmit  fs-14\">{{'subscriptionpayment.resubmitpay' | translate}}</a>\r\n              <!-- <button mat-raised-button class=\"resubmit  fs-14\">Resubmit Payment</button> -->\r\n            </div>\r\n            <div class=\"paymentstatuscolor m-r-20\" *ngIf=\"settingsData?.payStatus==4\">\r\n              <p *ngIf=\"settingsData?.payStatus==4\" class=\"statuswidth m-0\">{{'subscriptionpayment.paymentstatus' | translate}} <i\r\n                  class=\"inputinfoicon bgi bgi-infonew\" [popover]=\"paymentstatus\" popoverPlacement=\"top\"\r\n                  [popoverOnHover]=\"false\" [popoverCloseOnClickOutside]=\"true\" [popoverCloseOnMouseOutside]=\"true\"\r\n                  [popoverDisabled]=\"false\" [popoverAnimation]=\"true\"></i>\r\n                <popover-content #paymentstatus placement=\"top\" [animation]=\"true\" [closeOnClickOutside]=\"true\">\r\n                  <div class=\"popovermaincontent\">\r\n                    <div class=\"fs-12 m-0\">{{'subscriptionpayment.paymentdeclined' | translate}}</div>\r\n                    <div class=\"fs-12 m-0 paymentscroll\" >\r\n                      <div class=\"m-r-5\">{{'subscriptionpayment.comments' | translate}}</div>\r\n                      <div [innerHTML]=\"settingsData.payComments\"></div>\r\n                    </div>\r\n                  </div>\r\n                </popover-content>\r\n              </p>\r\n              <a mat-raised-button [routerLink]=\"['/afterlogin/certificationpaymentdetail']\"\r\n                *ngIf=\"settingsData?.payStatus=='4' || settingsData?.renewalstatus=='D'\" class=\"resubmit fs-14\">{{'subscriptionpayment.resubmitpay' | translate}}</a>\r\n            </div>\r\n            <div class=\"paymentstatuscolor\">\r\n              <p>{{'accountdetails.OPALcertstatus' | translate}}</p>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus==null\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.yettosubmit' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='I'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.inproress' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='S'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.postedforvald' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='D'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.declined' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\"\r\n                *ngIf=\"settingsData?.scfformststaus=='OSD' || settingsData?.scfformststaus=='OVD'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.overalldeclined' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='DI'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.declinedinprogress' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='RS'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.resubmitted' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='A'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.approved' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='U'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.updated' | translate}}</button>\r\n              <button mat-raised-button [routerLink]=\"['/scf/scf/dashboard']\" *ngIf=\"settingsData?.scfformststaus=='R'\"\r\n                class=\"postedverification fs-14\">{{'subscriptionpayment.reopened' | translate}}</button>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <p class=\"infocmp m-0\"\r\n          *ngIf=\"settingsData?.memberstatus=='A' && settingsData?.payStatus!=1 && !settingsData?.isExpired && (settingsData?.renewalstatus==null || settingsData?.renewalstatus=='R' || settingsData?.renewalstatus=='NE' || settingsData?.renewalstatus=='A')\">\r\n          {{renewalDays}}</p>\r\n        <p class=\"infocmp m-0\"\r\n          *ngIf=\"settingsData?.memberstatus=='A' && settingsData?.payStatus!=1 && !settingsData?.isExpired && (settingsData?.renewalstatus==null || settingsData?.renewalstatus=='R' || settingsData?.renewalstatus=='NE' || settingsData?.renewalstatus=='A')\">\r\n          {{settingsData?.actExpiry}}</p>\r\n        <div class=\"spacerenew\">\r\n          <span class=\"aftercoloruserlist\" [popover]=\"users\" popoverPlacement=\"top\" [popoverOnHover]=\"true\"\r\n            [popoverCloseOnClickOutside]=\"true\" [popoverCloseOnMouseOutside]=\"false\" [popoverAnimation]=\"true\">\r\n            <popover-content #users placement=\"top\" [animation]=\"true\" [closeOnClickOutside]=\"true\">\r\n              <div class=\"popovermaincontent  afternext\">\r\n                <div class=\"popovertexts positionname\">\r\n                  <div class=\"headerevent\">\r\n                    <div class=\"headerpopview p-l-18\">\r\n                      <h2 class=\"fs-15\">{{settingsData?.paymentContact?.firstname}}\r\n                        {{settingsData?.paymentContact?.lastname}}\r\n                      </h2>\r\n                      <p class=\"fs-15 seniorcolor\">{{settingsData?.paymentContact?.designation}}</p>\r\n                    </div>\r\n                    <div class=\"p-t-10 p-b-10 p-l-18\">\r\n                      <div class=\"cmpnyinfo\" *ngIf=\"settingsData?.paymentContact?.department\">\r\n                        <span class=\"firsttextcolor m-0 clable\">{{'subscriptionpayment.department' | translate}}</span>\r\n                        <span class=\"secondcontenttext m-0 cvalue\">{{settingsData?.paymentContact?.department}}</span>\r\n                      </div>\r\n                      <div class=\"cmpnyinfo\" *ngIf=\"settingsData?.paymentContact?.mobileno\">\r\n                        <span class=\"firsttextcolor m-0 clable\">{{'subscriptionpayment.mobile' | translate}}</span>\r\n                        <span class=\"secondcontenttext m-0 cvalue\">{{settingsData?.paymentContact?.mobileDialCode}}\r\n                          {{settingsData?.paymentContact?.mobileno}}</span>\r\n                      </div>\r\n                      <div class=\"cmpnyinfo\" *ngIf=\"settingsData?.paymentContact?.landlineno\">\r\n                        <span class=\"firsttextcolor m-0 clable\">{{'subscriptionpayment.landline' | translate}}</span>\r\n                        <span class=\"secondcontenttext m-0 cvalue\">{{settingsData?.paymentContact?.landlineDialCode}}\r\n                          {{settingsData?.paymentContact?.landlineno}}\r\n                          {{settingsData?.paymentContact?.landlineext}}</span>\r\n                      </div>\r\n                      <div class=\"cmpnyinfo\">\r\n                        <span class=\"firsttextcolor m-0 clable\">{{'subscriptionpayment.emailid' | translate}}</span>\r\n                        <span class=\"secondcontenttext m-0 cvalue\">{{settingsData?.paymentContact?.emailid}}</span>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </popover-content>{{'subscriptionpayment.showpaycont' | translate}}<i class=\"fa fa-angle-right p-l-8\" aria-hidden=\"true\"></i>\r\n          </span>\r\n          <div fxLayout=\"row wrap\"\r\n            *ngIf=\"settingsData?.memberstatus=='A' && settingsData?.payStatus!=1 && (settingsData?.renewalstatus=='NE' || settingsData?.renewalstatus=='E' || settingsData?.renewalstatus=='I' || settingsData?.renewalstatus=='GE')\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"flexrenew justifyend m-r-6\" *ngIf=\"!settingsData?.renewTempData\">\r\n              <button mat-raised-button class=\"collaberatecolor m-r-14 fs-14\"\r\n                (click)=\"certificaterenewaldrawer.toggle();certificaterenw.setHeadCount()\">{{'subscriptionpayment.renew' | translate}}</button>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"flexrenew justifyend m-r-6\" *ngIf=\"settingsData?.invoiceStatus=='G' && settingsData?.renewTempData\">\r\n              <button mat-raised-button class=\"collaberatecolor m-r-14 fs-14\"\r\n              [routerLink]=\"['/afterlogin/certificationpaymentdetail']\">{{'subscriptionpayment.renew' | translate}}</button>\r\n            </div>\r\n          </div>\r\n        </div>\r\n\r\n\r\n\r\n\r\n      </div>\r\n    </div>\r\n    <div class=\"kindlytext\" *ngIf=\"settingsData?.renewalstatus=='RW'\">\r\n      <p>{{'subscriptionpayment.kindly' | translate}} <a href=\"javascript:void(0)\" (click)=\"drawercontactus.toggle()\">{{'subscriptionpayment.contactus' | translate}}</a>{{'subscriptionpayment.changeyourcompclassify' | translate}} </p>\r\n    </div>\r\n \r\n  </div>\r\n</div>\r\n\r\n<mat-drawer-container class=\"example-container classifywidth\">\r\n  <mat-drawer #certificaterenewaldrawer disableClose class=\"example-sidenav sidenavsamewidthall classifysidenavwidth\"\r\n    mode=\"over\" position=\"end\">\r\n   \r\n  </mat-drawer>\r\n</mat-drawer-container>\r\n\r\n<mat-drawer-container class=\"example-container certificatelistview\">\r\n  <mat-drawer #changesubscriptiondrawer disableClose class=\"example-sidenav sidenavsamewidthall certifcatesidenavwidth\"\r\n    mode=\"over\" position=\"end\">\r\n    <app-changesubscriptionlistview [changesubscriptiondrawer]=\"changesubscriptiondrawer\">\r\n    </app-changesubscriptionlistview>\r\n  </mat-drawer>\r\n</mat-drawer-container>\r\n\r\n<mat-drawer-container class=\"example-container\">\r\n  <mat-drawer disableClose #drawercontactus class=\"example-sidenav sidenavsamewidthall filtersidenav\" mode=\"over\"\r\n    position=\"end\">\r\n    <app-contactusnav [drawercontactus]=\"drawercontactus\" [contactusData]=\"contactusData\"></app-contactusnav>\r\n  </mat-drawer>\r\n</mat-drawer-container>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/twofactorauth/modal/successmodal.html":
  /*!*********************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/twofactorauth/modal/successmodal.html ***!
    \*********************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsTwofactorauthModalSuccessmodalHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div id=\"verified_fields\"  dir=\"{{dir}}\" class=\"{{dir}}\">\r\n    <mat-icon mat-button  [disabled]=\"!Submitted\" [ngClass]=\"Submitted == true ? 'disable_icon' : ' '\" mat-dialog-close matTooltip=\"close\">close</mat-icon>\r\n    <form [formGroup]=\"OTPForm\" autocomplete=\"off\">\r\n        <div class=\"cont_otp\">\r\n            <h4 class=\"fs-20 txt-gry\">{{'successmodel.otpveri' | translate}}</h4>\r\n            <!-- <p class=\"fs-16 txt-gry3 m-t-15\">{{'successmodel.inpibliandgrap' | translate}}\r\n                <span>{{OTPForm.controls.email.value}}</span>.\r\n            </p> -->\r\n        </div>\r\n        <div class=\"otp_fld  txt-gry3\">\r\n            <!-- <mat-spinner></mat-spinner> -->\r\n            <p class=\"text-center\">{{'successmodel.entethe' | translate}}</p>\r\n            <div class=\"fields\">\r\n                <div class=\" divouter\">\r\n                    <mat-form-field appearance=\"none\" class=\"flexalign divinner\">\r\n                        <input maxlength=\"4\" type=\"text\" formControlName=\"otp\" required\r\n                            (keydown.space)=\"$event.preventDefault();\" class=\"inputcolor\" id=\"partitioned\" matInput app-restrict-input=\"firstspace\" appNumberonly>\r\n                        <span class=\"otpfield\"></span>\r\n                    </mat-form-field>\r\n                </div>\r\n                <div class=\"error\" fxLayoutAlign=\"center\">\r\n                    <div fxFlex=\"52\" fxLayoutAlign=\"space-between center\" class=\"m-l-22\">\r\n                       \r\n                        <mat-error *ngIf=\"OTPForm.controls.otp?.errors?.invalidOTP\" fxFlex=\"80\" class=\"fs-13\">\r\n                            {{'successmodel.invaliotp' | translate}}\r\n                        </mat-error>\r\n                        <mat-error *ngIf=\"OTPForm.controls.otp?.errors?.expiredOTP\" fxFlex=\"80\" class=\"fs-13\">\r\n                            {{'successmodel.expiredotp' | translate}}\r\n                        </mat-error>\r\n                        <div fxLayoutAlign=\"end\" fxFlex=\"100\">\r\n                            <button type=\"button\" class=\"fs-14 resentbtn\" *ngIf=\"disableResend == false\"\r\n                                [disabled]=\"disableResend == true\" (click)=\"resendOtp()\">{{'successmodel.reseotp' |\r\n                                translate}}</button>\r\n                            <mat-hint *ngIf=\"disableResend == true\" class=\"txt-gry fs-13\">{{'successmodel.reseotpin' |\r\n                                translate}} <span class=\"txt-red fs-12\">{{countDown}}</span></mat-hint>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"m-t-20 btns\">\r\n                <!-- <button mat-raised-button class=\"procbtn fs-16\">{{'successmodel.proc' | translate}}</button> -->\r\n                <mat-spinner-button (click)=\"submitOtp()\" mat-raised-button class=\"procbtn m-l-15\"\r\n                    [options]=\"spinnerButtonOptionsproced\"></mat-spinner-button>\r\n                    <!-- <button mat-raised-button class=\"procbtn fs-16\">{{'successmodel.proc' | translate}}</button> -->\r\n            </div>\r\n        </div>\r\n<app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>\r\n\r\n    </form>\r\n\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.html":
  /*!**************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.html ***!
    \**************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesAccountsettingsTwofactorauthTwofactorauthComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div *ngIf=\"!text\" id=\"email_verification\"  dir=\"{{dir}}\" class=\"{{dir}}\">\r\n  <div fXLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n    <div fxFlex=\"100\" class=\"account_information\">\r\n      <div fXLayout=\"row wrap\" fxLayoutAlign=\"center\" class=\"bread_title\">\r\n        <!-- <span class=\"langbtn txt-gry\" matTooltip=\"Back\" (click)=\"backtoaccount()\"><mat-icon\r\n          class=\"bgi bgi-back txt-gry fs-15 p-r-3\" fxLayoutAlign=\"flex-start centre fs-25\">keyboard_backspace</mat-icon>{{'twofactor.back' | translate}}</span> -->\r\n          <div fxLayoutAlign=\"center\" fxFlex=\"100\">\r\n            <h4 class=\"fs-18 txt-gry3 m-0 p-r-40\" >{{'twofactor.editaccount' | translate}}</h4>\r\n        </div>\r\n      </div>\r\n      <div class=\"ban_er\">\r\n        <div fxLayout=\"row\" fxLayoutAlign=\"center\" class=\"verify-form\">\r\n          <div fxFlex=\"100\" fxFlex.gt-sm=\"75\">\r\n            <form autocomplete=\"off\" [formGroup]=\"AccEditForm\" (ngSubmit)=\"submitUserDtls()\" class=\"m-t-25\">\r\n              <div fxLayoutAlign=\"center\">\r\n                <div fxFlex=\"50\">\r\n                  <mat-form-field appearance=\"outline\">\r\n                    <mat-label>{{'twofactor.name' | translate}}</mat-label>\r\n                    <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\" matInput required\r\n                      formControlName=\"name\">\r\n                    <mat-error *ngIf=\"form.name.errors?.required || (form.name.touched) || AccEditForm.submitted\">\r\n                      {{'twofactor.entename' | translate}} </mat-error>\r\n                  </mat-form-field>\r\n                  <mat-form-field appearance=\"outline\" class=\"m-t-13\">\r\n                    <mat-label>{{'twofactor.desi' | translate}}</mat-label>\r\n                    <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\" matInput required\r\n                      formControlName=\"userdesig\">\r\n                    <mat-error\r\n                      *ngIf=\"form.userdesig.errors?.required || (form.userdesig.touched) || AccEditForm.submitted\">\r\n                      {{'twofactor.entedesi' | translate}} </mat-error>\r\n                  </mat-form-field>\r\n                  <mat-form-field appearance=\"outline\" class=\"m-t-13\">\r\n                    <mat-label>{{'twofactor.emaiid' | translate}}</mat-label>\r\n                    <input (keydown.enter)=\"$event.preventDefault()\" (keyup)=\"checkemail()\"\r\n                      (change)=\"checkemailexists(form.useremailid.value)\" [errorStateMatcher]=\"matcher\" matInput\r\n                      required formControlName=\"useremailid\"  pattern=\"[a-zA-Z0-9]{1,}@[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,}\">\r\n                    <mat-spinner-button *ngIf=\"form.emailverified.value == 2\" class=\"submitbtnedit verifytop\" matSuffix\r\n                      (click)=\"openDialog()\" [options]=\"spinnerButtonOptionsverify\"></mat-spinner-button>\r\n                    <mat-spinner-button matSuffix type=\"button\" *ngIf=\"form.emailverified.value == 1\"\r\n                      class=\"submitbtnedit verifed\" [options]=\"spinnerButtonOptionsverified\">\r\n                    </mat-spinner-button>\r\n                    <mat-error\r\n                      *ngIf=\"form.useremailid.errors?.required && !form.useremailid.errors?.invalidGMemail || AccEditForm.submitted\">\r\n                      {{'twofactor.enteemailid' | translate}}</mat-error>\r\n                    <mat-error *ngIf=\"form.useremailid.errors?.alreadyavailable \">\r\n                      {{'twofactor.emailalready' | translate}}</mat-error>\r\n                    <mat-error *ngIf=\"form.useremailid.errors?.pattern\">\r\n                      {{'twofactor.entevaliemai' | translate}} </mat-error>\r\n                      \r\n                  </mat-form-field>\r\n                  <mat-error *ngIf=\"form.emailverified.errors?.NotVerified == true\">\r\n                    {{'twofactor.plsverifthe' | translate}} </mat-error>\r\n                  <mat-form-field appearance=\"outline\" class=\"m-t-13\">\r\n                    <mat-label>{{'twofactor.mobinum' | translate}}</mat-label>\r\n                    <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\" matInput required\r\n                      formControlName=\"usercontact\" appNumberonly maxlength=\"8\">\r\n                    <mat-error\r\n                      *ngIf=\"form.usercontact.errors?.required || (form.usercontact.touched) || AccEditForm.submitted\">\r\n                      {{'twofactor.entemobinumb' | translate}} </mat-error>\r\n\r\n                  </mat-form-field>\r\n                  <div fxLayoutAlign=\"flex-end center\">\r\n                    <button type=\"button\" (click)=\"backtoaccount()\" mat-raised-button\r\n                      class=\"cancelbtn\">{{'twofactor.canc' | translate}}</button>\r\n                    <!-- <button mat-raised-button class=\"savebtn m-l-15\">{{'twofactor.saveandupda' | translate}}</button> -->\r\n                    <mat-spinner-button (click)=\"submitUserDtls()\" mat-raised-button class=\"savebtn m-l-15\"\r\n                      [options]=\"spinnerButtonOptionssaveupdate\"></mat-spinner-button>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n            </form>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div class=\"banners\">\r\n  </div>\r\n  \r\n</div>\r\n\r\n<app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/accountsettings-routing.module.ts":
  /*!***************************************************************************!*\
    !*** ./src/app/modules/accountsettings/accountsettings-routing.module.ts ***!
    \***************************************************************************/

  /*! exports provided: AccountsettingsRoutingModule */

  /***/
  function srcAppModulesAccountsettingsAccountsettingsRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AccountsettingsRoutingModule", function () {
      return AccountsettingsRoutingModule;
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


    var _accountsettings_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./accountsettings.component */
    "./src/app/modules/accountsettings/accountsettings.component.ts");
    /* harmony import */


    var _twofactorauth_twofactorauth_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./twofactorauth/twofactorauth.component */
    "./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.ts");
    /* harmony import */


    var _changepasswordbackend_changepasswordbackend_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./changepasswordbackend/changepasswordbackend.component */
    "./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'home',
        component: _accountsettings_component__WEBPACK_IMPORTED_MODULE_4__["AccountsettingsComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
        data: {
          title: 'Account Settings',
          urls: [{
            title: 'Account Settings',
            url: '/accountsettings/home'
          }]
        }
      }, {
        path: 'twofactorauth',
        component: _twofactorauth_twofactorauth_component__WEBPACK_IMPORTED_MODULE_5__["TwofactorauthComponent"],
        data: {
          title: 'Account Settings',
          urls: [{
            title: 'Edit - Account Information',
            url: '/accountsettings/twofactorauth',
            breadcrumb: 'Invited User'
          }]
        }
      }, {
        path: 'changepassword',
        component: _changepasswordbackend_changepasswordbackend_component__WEBPACK_IMPORTED_MODULE_6__["ChangepasswordbackendComponent"],
        data: {
          title: 'Account Setting'
        }
      }]
    }];

    var AccountsettingsRoutingModule = /*#__PURE__*/_createClass(function AccountsettingsRoutingModule() {
      _classCallCheck(this, AccountsettingsRoutingModule);
    });

    AccountsettingsRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], AccountsettingsRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/accountsettings.component.scss":
  /*!************************************************************************!*\
    !*** ./src/app/modules/accountsettings/accountsettings.component.scss ***!
    \************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsAccountsettingsComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#accountcontainer .txt-gry {\n  color: #262626;\n  font-family: \"opal_semibold\", sans-serif;\n}\n#accountcontainer .txt-gry3 {\n  color: #848484;\n}\n#accountcontainer .userimg {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#accountcontainer .userimg img:hover {\n  transform: scale(1.1);\n}\n#accountcontainer .userimg span {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  width: 32px;\n  height: 32px;\n  border-radius: 20px;\n  background-color: #c4c4c4;\n  position: relative;\n  top: 33px;\n  left: -44px;\n  cursor: pointer;\n}\n#accountcontainer .userimg span:hover {\n  background-color: #ed1c2770;\n  transform: scale(1.1);\n}\n#accountcontainer .userimg span:hover .mat-icon {\n  color: #ED1C27;\n}\n#accountcontainer .userimg span .mat-icon {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  font-size: 20px;\n  color: #848484;\n  font-weight: 700;\n}\n#accountcontainer .mat-card {\n  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.051) !important;\n  border: 1px solid #e8e8e8;\n  padding-top: 20px !important;\n  height: 95%;\n}\n#accountcontainer .mat-card.profile_card {\n  padding-top: 0px !important;\n}\n#accountcontainer .mat-card .mat-card-image {\n  width: 128px;\n  height: 128px;\n  border-radius: 5px;\n  border: 1px solid #e8e8e8;\n}\n#accountcontainer .mat-card .mat-card-image:first-child {\n  margin-top: 0px;\n}\n#accountcontainer .comp_img img {\n  width: 44px !important;\n  height: 44px !important;\n  border-radius: 4px !important;\n}\n#accountcontainer .comp_img img:hover {\n  transform: scale(1.1);\n}\n#accountcontainer .mat-divider-horizontal {\n  position: relative !important;\n}\n#accountcontainer .mat-divider {\n  width: 80px;\n  border-top-width: 3px;\n  border-color: #ED1C27;\n  margin: 0 auto;\n}\n#accountcontainer .date_detials .mat-divider {\n  width: 100%;\n  margin-left: 0px !important;\n  border-top-width: 1px;\n  border-color: #e8e8e8;\n}\n#accountcontainer .date_detials .mat-divider-horizontal {\n  position: relative !important;\n}\n#accountcontainer .profile .mat-card {\n  padding: 14px 15px 0 15px !important;\n  height: 95%;\n}\n#accountcontainer .profile .mat-card .mat-divider {\n  width: 93%;\n  border-top-width: 1px;\n  border-color: #e8e8e8;\n}\n#accountcontainer .profile .mat-card .mat-divider-horizontal {\n  position: relative !important;\n}\n#accountcontainer .verified {\n  width: 55px;\n  height: 20px;\n  background-color: #00a551;\n  color: #ffffff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n#accountcontainer .mat-raised-button {\n  box-shadow: none;\n  border-radius: 2px;\n  font-size: 16px;\n}\n#accountcontainer .file_uploaded {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  align-items: center;\n  justify-content: center;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field {\n  width: 126px !important;\n}\n#accountcontainer .file_uploaded #uploaded .filers input.mat-input-element {\n  margin-top: 0rem !important;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #d9d9d9;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-flex {\n  padding: 0px !important;\n  border: 1px solid #d9d9d9;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 0 2px !important;\n  border: 1px solid #d9d9d9 !important;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border: 1px solid currentcolor !important;\n  border-radius: 1px !important;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border: 1px solid currentcolor !important;\n  border-radius: 1px !important;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n#accountcontainer .file_uploaded #uploaded .filers mat-label {\n  color: #999999;\n}\n#accountcontainer .file_uploaded #uploaded .filers mat-label span {\n  color: #ED1C27;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field label {\n  text-align: center;\n  margin-top: 1px;\n}\n#accountcontainer .file_uploaded #uploaded .filers input.mat-input-element {\n  background-color: #f5f5f5;\n  text-align: center;\n  height: 128px !important;\n  width: 128px !important;\n  margin-bottom: 2px !important;\n}\n#accountcontainer .file_uploaded #uploaded .filers .mat-form-field-suffix {\n  top: -0.75em;\n}\n#accountcontainer .file_uploaded #uploaded .filers .subbtn {\n  position: absolute;\n  background-color: #f5f5f5 !important;\n  color: #848484;\n  height: 100%;\n  width: 100%;\n  margin-bottom: 0px !important;\n}\n#accountcontainer .file_uploaded #uploaded .filers .subbtn:hover {\n  background-color: #f5f5f5;\n}\n#accountcontainer .file_uploaded #uploaded .filers button {\n  height: 100%;\n}\n#accountcontainer .file_uploaded #uploaded .document mat-label {\n  color: #999999;\n}\n#accountcontainer .file_uploaded #uploaded .document img {\n  width: 20px;\n}\n#accountcontainer .file_uploaded #uploaded .document mat-icon {\n  color: #999999;\n}\n#accountcontainer .file_uploaded #uploaded .document .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n#accountcontainer .btns {\n  gap: 20px;\n}\n#accountcontainer .btns button {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#accountcontainer .btns button.edit_btn {\n  min-width: 65px;\n  height: 30px;\n  background-color: #f5f5f5;\n  color: #626366;\n  border: 1px solid #d4d4d4;\n  border-radius: 2px;\n}\n#accountcontainer .btns button.edit_btn:hover {\n  background: #ED1C27;\n  color: #ffffff;\n  border: 1px solid currentColor;\n}\n#accountcontainer .btns button.edit_btn:hover .fa {\n  -webkit-text-stroke-color: #fff;\n}\n#accountcontainer .btns button.pass_btn {\n  min-width: 120px;\n  height: 30px;\n  background: #ED1C27;\n  color: #ffffff;\n  border: 1px solid #ED1C27;\n  border-radius: 2px;\n}\n#accountcontainer .btns button.view_btn {\n  min-width: 120px;\n  height: 30px;\n  background-color: #ED1C27;\n  color: #ffffff;\n  border: 1px solid currentColor;\n  border-radius: 2px;\n}\n#accountcontainer .btns button.view_btn:hover {\n  background: #ffffff;\n  color: #999999;\n  border: 1px solid #d4d4d4;\n}\n#accountcontainer .banner {\n  background-image: url('http://192.168.1.200:82/opal_usp/app/assets/images/opalimages/backbanner.svg');\n  background-position: center;\n  background-repeat: no-repeat;\n  height: 430px;\n}\n#accountcontainer .login_footer {\n  margin-top: -7%;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcYWNjb3VudHNldHRpbmdzXFxhY2NvdW50c2V0dGluZ3MuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL2FjY291bnRzZXR0aW5ncy5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFFSTtFQUNJLGNBQUE7RUFDQSx3Q0FBQTtBQ0RSO0FESUk7RUFDSSxjQUFBO0FDRlI7QURlSTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDYlI7QURnQlk7RUFDSSxxQkFBQTtBQ2RoQjtBRGtCUTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtFQUNBLHlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxTQUFBO0VBQ0EsV0FBQTtFQUVBLGVBQUE7QUNqQlo7QURtQlk7RUFDSSwyQkFBQTtFQUNBLHFCQUFBO0FDakJoQjtBRG1CZ0I7RUFDSSxjQUFBO0FDakJwQjtBRHFCWTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsZUFBQTtFQUNBLGNBQUE7RUFDQSxnQkFBQTtBQ25CaEI7QUR3Qkk7RUFDSSx3REFBQTtFQUNBLHlCQUFBO0VBQ0EsNEJBQUE7RUFDQSxXQUFBO0FDdEJSO0FEd0JRO0VBQ0ksMkJBQUE7QUN0Qlo7QUR5QlE7RUFDSSxZQUFBO0VBQ0EsYUFBQTtFQUNBLGtCQUFBO0VBQ0EseUJBQUE7QUN2Qlo7QUR5Qlk7RUFDSSxlQUFBO0FDdkJoQjtBRDZCUTtFQUNJLHNCQUFBO0VBQ0EsdUJBQUE7RUFDQSw2QkFBQTtBQzNCWjtBRDZCWTtFQUNJLHFCQUFBO0FDM0JoQjtBRGdDSTtFQUNJLDZCQUFBO0FDOUJSO0FEa0NJO0VBQ0ksV0FBQTtFQUNBLHFCQUFBO0VBQ0EscUJBQUE7RUFDQSxjQUFBO0FDaENSO0FEb0NRO0VBQ0ksV0FBQTtFQUNBLDJCQUFBO0VBQ0EscUJBQUE7RUFDQSxxQkFBQTtBQ2xDWjtBRHFDUTtFQUNJLDZCQUFBO0FDbkNaO0FEd0NRO0VBQ0ksb0NBQUE7RUFDQSxXQUFBO0FDdENaO0FEd0NZO0VBQ0ksVUFBQTtFQUNBLHFCQUFBO0VBQ0EscUJBQUE7QUN0Q2hCO0FEeUNZO0VBQ0ksNkJBQUE7QUN2Q2hCO0FEOENJO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSx5QkFBQTtFQUNBLGNBQUE7RUFDQSxrQkFBQTtFQUNBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0FDNUNSO0FEZ0RJO0VBQ0ksZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7QUM5Q1I7QURpREk7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBQUE7QUMvQ1I7QURtRGdCO0VBQ0ksdUJBQUE7QUNqRHBCO0FEb0RnQjtFQUNJLDJCQUFBO0FDbERwQjtBRHNEb0I7RUFDSSxjQUFBO0FDcER4QjtBRHVEb0I7RUFDSSx1QkFBQTtFQUNBLHlCQUFBO0FDckR4QjtBRHdEb0I7RUFDSSx5QkFBQTtFQUNBLG9DQUFBO0FDdER4QjtBRHlEb0I7RUFDSSx5Q0FBQTtFQUNBLDZCQUFBO0FDdkR4QjtBRDBEb0I7RUFDSSx5Q0FBQTtFQUNBLDZCQUFBO0FDeER4QjtBRDJEb0I7RUFDSSxtQkFBQTtBQ3pEeEI7QUQ2RGdCO0VBQ0ksY0FBQTtBQzNEcEI7QUQ2RG9CO0VBQ0ksY0FBQTtBQzNEeEI7QUQrRGdCO0VBQ0ksa0JBQUE7RUFDQSxlQUFBO0FDN0RwQjtBRGlFb0I7RUFDSSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0Esd0JBQUE7RUFDQSx1QkFBQTtFQUNBLDZCQUFBO0FDL0R4QjtBRG1FZ0I7RUFDSSxZQUFBO0FDakVwQjtBRG9FZ0I7RUFDSSxrQkFBQTtFQUNBLG9DQUFBO0VBQ0EsY0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0EsNkJBQUE7QUNsRXBCO0FEb0VvQjtFQUNJLHlCQUFBO0FDbEV4QjtBRHNFZ0I7RUFDSSxZQUFBO0FDcEVwQjtBRHlFZ0I7RUFDSSxjQUFBO0FDdkVwQjtBRDBFZ0I7RUFDSSxXQUFBO0FDeEVwQjtBRDJFZ0I7RUFDSSxjQUFBO0FDekVwQjtBRDRFZ0I7RUFDSSxtQkFBQTtBQzFFcEI7QURnRkk7RUFDSSxTQUFBO0FDOUVSO0FEZ0ZRO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBQUE7QUM5RVo7QURnRlk7RUFDSSxlQUFBO0VBQ0EsWUFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtFQUNBLHlCQUFBO0VBQ0Esa0JBQUE7QUM5RWhCO0FEZ0ZnQjtFQUNJLG1CQUFBO0VBQ0EsY0FBQTtFQUNBLDhCQUFBO0FDOUVwQjtBRGdGb0I7RUFDSSwrQkFBQTtBQzlFeEI7QURtRlk7RUFDSSxnQkFBQTtFQUNBLFlBQUE7RUFDQSxtQkFBQTtFQUNBLGNBQUE7RUFDQSx5QkFBQTtFQUNBLGtCQUFBO0FDakZoQjtBRG9GWTtFQUNJLGdCQUFBO0VBQ0EsWUFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtFQUNBLDhCQUFBO0VBQ0Esa0JBQUE7QUNsRmhCO0FEb0ZnQjtFQUNJLG1CQUFBO0VBQ0EsY0FBQTtFQUNBLHlCQUFBO0FDbEZwQjtBRDBGSTtFQUNJLHFHQUFBO0VBQ0EsMkJBQUE7RUFDQSw0QkFBQTtFQUNBLGFBQUE7QUN4RlI7QUQyRkk7RUFDSSxlQUFBO0FDekZSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvYWNjb3VudHNldHRpbmdzLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiI2FjY291bnRjb250YWluZXIge1xyXG5cclxuICAgIC50eHQtZ3J5IHtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICBmb250LWZhbWlseTogXCJvcGFsX3NlbWlib2xkXCIsIHNhbnMtc2VyaWY7XHJcbiAgICB9XHJcblxyXG4gICAgLnR4dC1ncnkzIHtcclxuICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgIH1cclxuXHJcbiAgICAvLyAuZmEge1xyXG4gICAgLy8gICAgIGNvbG9yOiB0cmFuc3BhcmVudDtcclxuICAgIC8vICAgICAtd2Via2l0LXRleHQtc3Ryb2tlLXdpZHRoOiAxcHg7XHJcbiAgICAvLyAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogIzYyNjM2NjtcclxuXHJcbiAgICAvLyAgICAgJjpob3ZlciB7XHJcbiAgICAvLyAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2UtY29sb3I6ICNmZmY7XHJcbiAgICAvLyAgICAgfVxyXG4gICAgLy8gfVxyXG5cclxuICAgIC51c2VyaW1nIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcblxyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjEpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIHdpZHRoOiAzMnB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDMycHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDIwcHg7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNjNGM0YzQ7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgdG9wOiAzM3B4O1xyXG4gICAgICAgICAgICBsZWZ0OiAtNDRweDtcclxuICAgICAgICAgICAgLy8gb3BhY2l0eTogMC41O1xyXG4gICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcblxyXG4gICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjc3MDtcclxuICAgICAgICAgICAgICAgIHRyYW5zZm9ybTogc2NhbGUoMS4xKTtcclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMjBweDtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgICAgZm9udC13ZWlnaHQ6IDcwMDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWNhcmQge1xyXG4gICAgICAgIGJveC1zaGFkb3c6IDBweCAwcHggMTBweCByZ2JhKDAsIDAsIDAsIDAuMDUxKSAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNlOGU4ZTg7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDIwcHggIWltcG9ydGFudDtcclxuICAgICAgICBoZWlnaHQ6IDk1JTtcclxuXHJcbiAgICAgICAgJi5wcm9maWxlX2NhcmQge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXRvcDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWNhcmQtaW1hZ2Uge1xyXG4gICAgICAgICAgICB3aWR0aDogMTI4cHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogMTI4cHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDVweDtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2U4ZThlODtcclxuXHJcbiAgICAgICAgICAgICY6Zmlyc3QtY2hpbGQge1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5jb21wX2ltZyB7XHJcbiAgICAgICAgaW1nIHtcclxuICAgICAgICAgICAgd2lkdGg6IDQ0cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA0NHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDRweCAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgJjpob3ZlciB7XHJcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHNjYWxlKDEuMSk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1kaXZpZGVyLWhvcml6b250YWwge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZSAhaW1wb3J0YW50O1xyXG4gICAgICAgIC8vIGxlZnQ6IDM4JTtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWRpdmlkZXIge1xyXG4gICAgICAgIHdpZHRoOiA4MHB4O1xyXG4gICAgICAgIGJvcmRlci10b3Atd2lkdGg6IDNweDtcclxuICAgICAgICBib3JkZXItY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgbWFyZ2luOiAwIGF1dG87XHJcbiAgICB9XHJcblxyXG4gICAgLmRhdGVfZGV0aWFscyB7XHJcbiAgICAgICAgLm1hdC1kaXZpZGVyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm9yZGVyLXRvcC13aWR0aDogMXB4O1xyXG4gICAgICAgICAgICBib3JkZXItY29sb3I6ICNlOGU4ZTg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWRpdmlkZXItaG9yaXpvbnRhbCB7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAucHJvZmlsZSB7XHJcbiAgICAgICAgLm1hdC1jYXJkIHtcclxuICAgICAgICAgICAgcGFkZGluZzogMTRweCAxNXB4IDAgMTVweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDk1JTtcclxuXHJcbiAgICAgICAgICAgIC5tYXQtZGl2aWRlciB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogOTMlO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXRvcC13aWR0aDogMXB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLWNvbG9yOiAjZThlOGU4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWRpdmlkZXItaG9yaXpvbnRhbCB7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICB9XHJcblxyXG5cclxuICAgIC52ZXJpZmllZCB7XHJcbiAgICAgICAgd2lkdGg6IDU1cHg7XHJcbiAgICAgICAgaGVpZ2h0OiAyMHB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTE7XHJcbiAgICAgICAgY29sb3I6ICNmZmZmZmY7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcblxyXG4gICAgLm1hdC1yYWlzZWQtYnV0dG9uIHtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBmb250LXNpemU6IDE2cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmZpbGVfdXBsb2FkZWQge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG5cclxuICAgICAgICAjdXBsb2FkZWQge1xyXG4gICAgICAgICAgICAuZmlsZXJzIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEyNnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgaW5wdXQubWF0LWlucHV0LWVsZW1lbnQge1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDByZW0gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWZsZXgge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q5ZDlkOTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDAgMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkOWQ5ZDkgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgY3VycmVudGNvbG9yICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgY3VycmVudGNvbG9yICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICBtYXQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZCBsYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDFweDtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICBpbnB1dCB7XHJcbiAgICAgICAgICAgICAgICAgICAgJi5tYXQtaW5wdXQtZWxlbWVudCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAxMjhweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTI4cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xyXG4gICAgICAgICAgICAgICAgICAgIHRvcDogLTAuNzVlbTtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuc3ViYnRuIHtcclxuICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgICAgICAgIGhlaWdodDogMTAwJTtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW4tYm90dG9tOiAwcHggIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgJjpob3ZlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjU7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAuZG9jdW1lbnQge1xyXG4gICAgICAgICAgICAgICAgbWF0LWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzk5OTk5OTtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIG1hdC1pY29uIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzk5OTk5OTtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDBweDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYnRucyB7XHJcbiAgICAgICAgZ2FwOiAyMHB4O1xyXG5cclxuICAgICAgICBidXR0b24ge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgICAgICYuZWRpdF9idG4ge1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA2NXB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjNjI2MzY2O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q0ZDRkNDtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuXHJcbiAgICAgICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmZmZmO1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGN1cnJlbnRDb2xvcjtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLmZhIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYucGFzc19idG4ge1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZmZmZjtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYudmlld19idG4ge1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZmZmZjtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGN1cnJlbnRDb2xvcjtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuXHJcbiAgICAgICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmZmZmO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkNGQ0ZDQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG5cclxuXHJcbiAgICAuYmFubmVyIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWltYWdlOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvb3BhbGltYWdlcy9iYWNrYmFubmVyLnN2Z1wiKTtcclxuICAgICAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiBjZW50ZXI7XHJcbiAgICAgICAgYmFja2dyb3VuZC1yZXBlYXQ6IG5vLXJlcGVhdDtcclxuICAgICAgICBoZWlnaHQ6IDQzMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5sb2dpbl9mb290ZXIge1xyXG4gICAgICAgIG1hcmdpbi10b3A6IC03JTtcclxuICAgIH1cclxufSIsIiNhY2NvdW50Y29udGFpbmVyIC50eHQtZ3J5IHtcbiAgY29sb3I6ICMyNjI2MjY7XG4gIGZvbnQtZmFtaWx5OiBcIm9wYWxfc2VtaWJvbGRcIiwgc2Fucy1zZXJpZjtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC50eHQtZ3J5MyB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI2FjY291bnRjb250YWluZXIgLnVzZXJpbWcge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC51c2VyaW1nIGltZzpob3ZlciB7XG4gIHRyYW5zZm9ybTogc2NhbGUoMS4xKTtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC51c2VyaW1nIHNwYW4ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgd2lkdGg6IDMycHg7XG4gIGhlaWdodDogMzJweDtcbiAgYm9yZGVyLXJhZGl1czogMjBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2M0YzRjNDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0b3A6IDMzcHg7XG4gIGxlZnQ6IC00NHB4O1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4jYWNjb3VudGNvbnRhaW5lciAudXNlcmltZyBzcGFuOmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNzcwO1xuICB0cmFuc2Zvcm06IHNjYWxlKDEuMSk7XG59XG4jYWNjb3VudGNvbnRhaW5lciAudXNlcmltZyBzcGFuOmhvdmVyIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2FjY291bnRjb250YWluZXIgLnVzZXJpbWcgc3BhbiAubWF0LWljb24ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZm9udC1zaXplOiAyMHB4O1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgZm9udC13ZWlnaHQ6IDcwMDtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5tYXQtY2FyZCB7XG4gIGJveC1zaGFkb3c6IDBweCAwcHggMTBweCByZ2JhKDAsIDAsIDAsIDAuMDUxKSAhaW1wb3J0YW50O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZThlOGU4O1xuICBwYWRkaW5nLXRvcDogMjBweCAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDk1JTtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5tYXQtY2FyZC5wcm9maWxlX2NhcmQge1xuICBwYWRkaW5nLXRvcDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jYWNjb3VudGNvbnRhaW5lciAubWF0LWNhcmQgLm1hdC1jYXJkLWltYWdlIHtcbiAgd2lkdGg6IDEyOHB4O1xuICBoZWlnaHQ6IDEyOHB4O1xuICBib3JkZXItcmFkaXVzOiA1cHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNlOGU4ZTg7XG59XG4jYWNjb3VudGNvbnRhaW5lciAubWF0LWNhcmQgLm1hdC1jYXJkLWltYWdlOmZpcnN0LWNoaWxkIHtcbiAgbWFyZ2luLXRvcDogMHB4O1xufVxuI2FjY291bnRjb250YWluZXIgLmNvbXBfaW1nIGltZyB7XG4gIHdpZHRoOiA0NHB4ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogNDRweCAhaW1wb3J0YW50O1xuICBib3JkZXItcmFkaXVzOiA0cHggIWltcG9ydGFudDtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5jb21wX2ltZyBpbWc6aG92ZXIge1xuICB0cmFuc2Zvcm06IHNjYWxlKDEuMSk7XG59XG4jYWNjb3VudGNvbnRhaW5lciAubWF0LWRpdmlkZXItaG9yaXpvbnRhbCB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZSAhaW1wb3J0YW50O1xufVxuI2FjY291bnRjb250YWluZXIgLm1hdC1kaXZpZGVyIHtcbiAgd2lkdGg6IDgwcHg7XG4gIGJvcmRlci10b3Atd2lkdGg6IDNweDtcbiAgYm9yZGVyLWNvbG9yOiAjRUQxQzI3O1xuICBtYXJnaW46IDAgYXV0bztcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5kYXRlX2RldGlhbHMgLm1hdC1kaXZpZGVyIHtcbiAgd2lkdGg6IDEwMCU7XG4gIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgYm9yZGVyLXRvcC13aWR0aDogMXB4O1xuICBib3JkZXItY29sb3I6ICNlOGU4ZTg7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuZGF0ZV9kZXRpYWxzIC5tYXQtZGl2aWRlci1ob3Jpem9udGFsIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlICFpbXBvcnRhbnQ7XG59XG4jYWNjb3VudGNvbnRhaW5lciAucHJvZmlsZSAubWF0LWNhcmQge1xuICBwYWRkaW5nOiAxNHB4IDE1cHggMCAxNXB4ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogOTUlO1xufVxuI2FjY291bnRjb250YWluZXIgLnByb2ZpbGUgLm1hdC1jYXJkIC5tYXQtZGl2aWRlciB7XG4gIHdpZHRoOiA5MyU7XG4gIGJvcmRlci10b3Atd2lkdGg6IDFweDtcbiAgYm9yZGVyLWNvbG9yOiAjZThlOGU4O1xufVxuI2FjY291bnRjb250YWluZXIgLnByb2ZpbGUgLm1hdC1jYXJkIC5tYXQtZGl2aWRlci1ob3Jpem9udGFsIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlICFpbXBvcnRhbnQ7XG59XG4jYWNjb3VudGNvbnRhaW5lciAudmVyaWZpZWQge1xuICB3aWR0aDogNTVweDtcbiAgaGVpZ2h0OiAyMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDBhNTUxO1xuICBjb2xvcjogI2ZmZmZmZjtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuZmlsZV91cGxvYWRlZCAjdXBsb2FkZWQgLmZpbGVycyAubWF0LWZvcm0tZmllbGQge1xuICB3aWR0aDogMTI2cHggIWltcG9ydGFudDtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5maWxlX3VwbG9hZGVkICN1cGxvYWRlZCAuZmlsZXJzIGlucHV0Lm1hdC1pbnB1dC1lbGVtZW50IHtcbiAgbWFyZ2luLXRvcDogMHJlbSAhaW1wb3J0YW50O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjZDlkOWQ5O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtZmxleCB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZDlkOWQ5O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBwYWRkaW5nOiAwIDJweCAhaW1wb3J0YW50O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZDlkOWQ5ICFpbXBvcnRhbnQ7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuZmlsZV91cGxvYWRlZCAjdXBsb2FkZWQgLmZpbGVycyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcbiAgYm9yZGVyOiAxcHggc29saWQgY3VycmVudGNvbG9yICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXI6IDFweCBzb2xpZCBjdXJyZW50Y29sb3IgIWltcG9ydGFudDtcbiAgYm9yZGVyLXJhZGl1czogMXB4ICFpbXBvcnRhbnQ7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuZmlsZV91cGxvYWRlZCAjdXBsb2FkZWQgLmZpbGVycyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcbiAgcGFkZGluZy1ib3R0b206IDBweDtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5maWxlX3VwbG9hZGVkICN1cGxvYWRlZCAuZmlsZXJzIG1hdC1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5OTk5O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgbWF0LWxhYmVsIHNwYW4ge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5maWxlX3VwbG9hZGVkICN1cGxvYWRlZCAuZmlsZXJzIC5tYXQtZm9ybS1maWVsZCBsYWJlbCB7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgbWFyZ2luLXRvcDogMXB4O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgaW5wdXQubWF0LWlucHV0LWVsZW1lbnQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1O1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIGhlaWdodDogMTI4cHggIWltcG9ydGFudDtcbiAgd2lkdGg6IDEyOHB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDJweCAhaW1wb3J0YW50O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCB7XG4gIHRvcDogLTAuNzVlbTtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5maWxlX3VwbG9hZGVkICN1cGxvYWRlZCAuZmlsZXJzIC5zdWJidG4ge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjUgIWltcG9ydGFudDtcbiAgY29sb3I6ICM4NDg0ODQ7XG4gIGhlaWdodDogMTAwJTtcbiAgd2lkdGg6IDEwMCU7XG4gIG1hcmdpbi1ib3R0b206IDBweCAhaW1wb3J0YW50O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5maWxlcnMgLnN1YmJ0bjpob3ZlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjU7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuZmlsZV91cGxvYWRlZCAjdXBsb2FkZWQgLmZpbGVycyBidXR0b24ge1xuICBoZWlnaHQ6IDEwMCU7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuZmlsZV91cGxvYWRlZCAjdXBsb2FkZWQgLmRvY3VtZW50IG1hdC1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5OTk5O1xufVxuI2FjY291bnRjb250YWluZXIgLmZpbGVfdXBsb2FkZWQgI3VwbG9hZGVkIC5kb2N1bWVudCBpbWcge1xuICB3aWR0aDogMjBweDtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5maWxlX3VwbG9hZGVkICN1cGxvYWRlZCAuZG9jdW1lbnQgbWF0LWljb24ge1xuICBjb2xvcjogIzk5OTk5OTtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5maWxlX3VwbG9hZGVkICN1cGxvYWRlZCAuZG9jdW1lbnQgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMHB4O1xufVxuI2FjY291bnRjb250YWluZXIgLmJ0bnMge1xuICBnYXA6IDIwcHg7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuYnRucyBidXR0b24ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5idG5zIGJ1dHRvbi5lZGl0X2J0biB7XG4gIG1pbi13aWR0aDogNjVweDtcbiAgaGVpZ2h0OiAzMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1O1xuICBjb2xvcjogIzYyNjM2NjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2Q0ZDRkNDtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2FjY291bnRjb250YWluZXIgLmJ0bnMgYnV0dG9uLmVkaXRfYnRuOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogI0VEMUMyNztcbiAgY29sb3I6ICNmZmZmZmY7XG4gIGJvcmRlcjogMXB4IHNvbGlkIGN1cnJlbnRDb2xvcjtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5idG5zIGJ1dHRvbi5lZGl0X2J0bjpob3ZlciAuZmEge1xuICAtd2Via2l0LXRleHQtc3Ryb2tlLWNvbG9yOiAjZmZmO1xufVxuI2FjY291bnRjb250YWluZXIgLmJ0bnMgYnV0dG9uLnBhc3NfYnRuIHtcbiAgbWluLXdpZHRoOiAxMjBweDtcbiAgaGVpZ2h0OiAzMHB4O1xuICBiYWNrZ3JvdW5kOiAjRUQxQzI3O1xuICBjb2xvcjogI2ZmZmZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgI0VEMUMyNztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2FjY291bnRjb250YWluZXIgLmJ0bnMgYnV0dG9uLnZpZXdfYnRuIHtcbiAgbWluLXdpZHRoOiAxMjBweDtcbiAgaGVpZ2h0OiAzMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3O1xuICBjb2xvcjogI2ZmZmZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgY3VycmVudENvbG9yO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jYWNjb3VudGNvbnRhaW5lciAuYnRucyBidXR0b24udmlld19idG46aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjZmZmZmZmO1xuICBjb2xvcjogIzk5OTk5OTtcbiAgYm9yZGVyOiAxcHggc29saWQgI2Q0ZDRkNDtcbn1cbiNhY2NvdW50Y29udGFpbmVyIC5iYW5uZXIge1xuICBiYWNrZ3JvdW5kLWltYWdlOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvb3BhbGltYWdlcy9iYWNrYmFubmVyLnN2Z1wiKTtcbiAgYmFja2dyb3VuZC1wb3NpdGlvbjogY2VudGVyO1xuICBiYWNrZ3JvdW5kLXJlcGVhdDogbm8tcmVwZWF0O1xuICBoZWlnaHQ6IDQzMHB4O1xufVxuI2FjY291bnRjb250YWluZXIgLmxvZ2luX2Zvb3RlciB7XG4gIG1hcmdpbi10b3A6IC03JTtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/accountsettings.component.ts":
  /*!**********************************************************************!*\
    !*** ./src/app/modules/accountsettings/accountsettings.component.ts ***!
    \**********************************************************************/

  /*! exports provided: AccountsettingsComponent */

  /***/
  function srcAppModulesAccountsettingsAccountsettingsComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AccountsettingsComponent", function () {
      return AccountsettingsComponent;
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


    var _accountsettings_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./accountsettings.service */
    "./src/app/modules/accountsettings/accountsettings.service.ts");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_4__);
    /* harmony import */


    var _subscriptionpaymentlist_subscriptionpaymentlist_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./subscriptionpaymentlist/subscriptionpaymentlist.component */
    "./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.ts");
    /* harmony import */


    var _app_shared_factorauthentication_factorauthentication_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @app/@shared/factorauthentication/factorauthentication.component */
    "./src/app/@shared/factorauthentication/factorauthentication.component.ts");
    /* harmony import */


    var _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/@shared/filee/filee */
    "./src/app/@shared/filee/filee.ts");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! @app/@shared/modal/successdialog */
    "./src/app/@shared/modal/successdialog.ts");
    /* harmony import */


    var _twofactorauth_twofactorauth_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! ./twofactorauth/twofactorauth.component */
    "./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");

    var ELEMENT_DATA = [{
      name: 'Enterprise Admin',
      type: 1
    }, {
      name: 'Divisions',
      type: 2
    }, {
      name: 'Departments',
      type: 2
    }, {
      name: 'User Creation',
      type: 2
    }, {
      name: 'Accounts Settings',
      type: 1
    }, {
      name: 'General Settings',
      type: 2
    }, {
      name: 'Manage Subscription',
      type: 2
    }, {
      name: 'Email Preference',
      type: 2
    }, {
      name: 'Master Company Profile',
      type: 1
    }, {
      name: 'Company Information',
      type: 2
    }, {
      name: 'About Company',
      type: 2
    }, {
      name: 'Accomplishments',
      type: 2
    }, {
      name: 'Market Presence',
      type: 2
    }, {
      name: 'Web Presence',
      type: 2
    }, {
      name: 'Board Members and Management Team',
      type: 2
    }, {
      name: 'Domain Profile',
      type: 1
    }, {
      name: 'Business Source',
      type: 2
    }, {
      name: 'Product Catalog',
      type: 2
    }, {
      name: 'Service Catalog',
      type: 2
    }, {
      name: 'jSearch',
      type: 1
    }, {
      name: 'Internal Search',
      type: 2
    }, {
      name: 'Domain Search',
      type: 2
    }, {
      name: 'JSRS Search',
      type: 2
    }, {
      name: 'Supplier Certification Management',
      type: 1
    }];

    var AccountsettingsComponent = /*#__PURE__*/function () {
      function AccountsettingsComponent(fb, localstorage, translate, remoteService, dialog, router, cookieService, accSettingsService, routeid, toastr) {
        _classCallCheck(this, AccountsettingsComponent);

        this.fb = fb;
        this.localstorage = localstorage;
        this.translate = translate;
        this.remoteService = remoteService;
        this.dialog = dialog;
        this.router = router;
        this.cookieService = cookieService;
        this.accSettingsService = accSettingsService;
        this.routeid = routeid;
        this.toastr = toastr;
        this.disableloader = true;
        this.text = true;
        this.selectedtab = 0;
        this.filemstPk = 1; // 5 - company filemst reference

        this.contactusData = {};
        this.twofactorData = {};
        this.lusrtpye = null;
        this.warnUserBeforeLeavingPage = true;
        this.displayedColumns = ['module', 'create', 'update', 'read', 'delete', 'approval', 'download'];
        this.dataSource = ELEMENT_DATA;
        this.buttonname = 'Request Access';
        this.changeuserloader = false;
        this.animationState1 = 'out';
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
        this.dir = "ltr";
      }

      _createClass(AccountsettingsComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "unloadHandler",
        value: function unloadHandler(event) {
          if (this.warnUserBeforeLeavingPage) {
            event.returnValue = false;
          }
        }
      }, {
        key: "ngAfterViewInit",
        value: function ngAfterViewInit() {
          var _this = this;

          setInterval(function () {
            return _this.transFun();
          }, 100); // const div = document.querySelector('.topbar');
          // const observer = new MutationObserver(list => {
          //   list.forEach((mutation, index) => {
          //     console.log(list) 
          //     if (mutation.type === "childList") {
          //       console.log(list)            
          //     }
          //   });
          // });
          // observer.observe(div, {attributes: true, childList: true, subtree: true});
        }
      }, {
        key: "transFun",
        value: function transFun() {
          var _this2 = this;

          this.translate.setDefaultLang(this.cookieService.get('languageCode'));

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this2.cookieService.get('languageCookieId');
            });
            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect = this.languagelist.find(function (c) {
              return c.id == '1';
            });

            this.translate.setDefaultLang(_toSelect.languagecode);
            this.dir = _toSelect.dir;
          }
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this3 = this;

          if (localStorage.getItem('v3logindata') == null) {
            this.router.navigate(['/admin/login']);
          }
          /*  if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
             const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
             //this.patientCategory.get('patientCategory').setValue(toSelect);
            this.translate.setDefaultLang(toSelect.languagecode);
             this.dir = toSelect.dir;
             
           }else{
             const toSelect = this.languagelist.find(c => c.id == '1');
             //this.patientCategory.get('patientCategory').setValue(toSelect);
             this.translate.setDefaultLang(toSelect.languagecode);
             this.dir = toSelect.dir;
           } */


          this.remoteService.getLanguageCookie().subscribe(function (data) {
            console.log('test tespsdfsd dsfsdrap Prabu');

            _this3.translate.setDefaultLang(_this3.cookieService.get('languageCode'));

            if (_this3.cookieService.get('languageCookieId') && _this3.cookieService.get('languageCookieId') != undefined && _this3.cookieService.get('languageCookieId') != null) {
              var toSelect = _this3.languagelist.find(function (c) {
                return c.id === _this3.cookieService.get('languageCookieId');
              });

              _this3.translate.setDefaultLang(toSelect.languagecode);

              _this3.dir = toSelect.dir;
            } else {
              var _toSelect2 = _this3.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this3.translate.setDefaultLang(_toSelect2.languagecode);

              _this3.dir = _toSelect2.dir;
            }
          });
          this.lusrtpye = this.localstorage.getInLocal('usertype');

          if (this.lusrtpye == 'U') {
            this.useraccess = this.localstorage.getInLocal('uerpermission');
          }

          this.stakeHolderType = this.localstorage.getInLocal('reg_type');
          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this3.translate.setDefaultLang(_this3.cookieService.get('languageCode'));
          });
          this.companyPk = this.localstorage.getInLocal('companyPk');
          this.companytype = this.localstorage.getInLocal('reg_type');
          this.industryType = this.localstorage.getInLocal('industryType');
          this.buyerId = this.localstorage.getInLocal('buyerId');
          this.isForRenewal = window.history.state.openRenewal;
          this.projectName = this.localstorage.getInLocal('projectName');
          this.RegisteredOn = this.localstorage.getInLocal('RegisteredOn');
          this.MRM_ValSubStatus = this.localstorage.getInLocal('MRM_ValSubStatus');
          this.mcm_RegistrationNo = this.localstorage.getInLocal('mcm_RegistrationNo');
          this.MRM_RenewalStatus = this.localstorage.getInLocal('MRM_RenewalStatus');
          this.supplierId = this.localstorage.getInLocal('supplierId');
          this.UserCreatedOn = this.localstorage.getInLocal('UserCreatedOn');
          this.filemstPk = this.userType == 'U' ? 93 : this.filemstPk; // 93 - user file mst reference

          this.accountsettingForm = this.fb.group({
            upload: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          });
          this.drv_logo = {
            fileMstPk: this.filemstPk,
            selectedFilesPk: []
          };
          this.isGraceExpired = this.MRM_RenewalStatus == 'I' || this.MRM_RenewalStatus == 'GE' ? true : false;
          this.disableSubmitButton = true;
          this.getaccousettingsData();
        }
      }, {
        key: "getaccousettingsData",
        value: function getaccousettingsData() {
          var _this4 = this;

          this.accSettingsService.accountsettingsdata(this.editdata).subscribe(function (data) {
            _this4.accSettingsData = data['data'];
            console.log(_this4.accSettingsData);
            var primaryContactData = _this4.accSettingsData.primaryContact;
            _this4.userType = primaryContactData === null || primaryContactData === void 0 ? void 0 : primaryContactData.usertype;
            var username = primaryContactData.firstname + ' ' + primaryContactData.lastname;
            var useremail = primaryContactData.emailid;
            _this4.contactusData = {
              companyname: _this4.accSettingsData.companyName,
              username: username,
              useremail: useremail,
              subject: ''
            };
            _this4.disableSubmitButton = false;
          });
          this.viewinvoice(); // this.editor();
        }
      }, {
        key: "initfunctions",
        value: function initfunctions() {
          if (this.selectedtab != 0) {
            console.log('fsd'); // this.twofactorauthtab.resetall();
          }
        }
      }, {
        key: "fileeSelected",
        value: function fileeSelected(file, fileId) {
          fileId.selectedFilesPk = file;
          this.accSettingsService.saveLogo(file).subscribe(function (data) {
            if (data['data'].status == 1) {
              console.log("Logo updated successfully");
            }
          });
        }
      }, {
        key: "deleteLogo",
        value: function deleteLogo(event) {
          var _this5 = this;

          if (this.lusrtpye == 'A' || this.lusrtpye == 'U' && this.useraccess[257] && this.useraccess[257]["delete"] == 'Y') {
            if (event) {
              sweetalert__WEBPACK_IMPORTED_MODULE_4___default()({
                title: this.i18n('accsettinglandingpage.doyouwanttodele'),
                text: this.i18n('accsettinglandingpage.youcanstilreco'),
                icon: "warning",
                buttons: [this.i18n('accsettinglandingpage.canc'), this.i18n('accsettinglandingpage.ok')],
                dangerMode: true,
                className: "swal-delete",
                closeOnClickOutside: false,
                closeOnEsc: false
              }).then(function (willDelete) {
                if (willDelete) {
                  _this5.accSettingsService.saveLogo([]).subscribe(function (data) {
                    if (data['data'].status == 1) {
                      _this5.showSuccess();

                      console.log("Logo deleted successfully");
                      _this5.drv_logo.selectedFilesPk = [];
                      window.location.reload(); // setTimeout(() => {
                      //   this.logo.triggerChange();
                      //   swal('Success','Deleted successfully', 'success');
                      // }, 1000);
                    }
                  });
                }
              });
            }
          } else {
            this.toastr.warning(this.i18n('accsettinglandingpage.youdonthaveperm'), '', {
              timeOut: 3000,
              closeButton: true
            });
          }
        }
      }, {
        key: "showSuccess",
        value: function showSuccess() {
          this.toastr.success(this.i18n('accsettinglandingpage.delesucc'), '', {
            timeOut: 3000,
            closeButton: true
          });
        }
      }, {
        key: "checkfile",
        value: function checkfile(files, key) {
          var _this6 = this;

          this.disableSubmitButton = true;
          var value = JSON.stringify(files[0]);
          console.log(value);
          this.accSettingsService.saveUserDp(value).subscribe(function (res) {
            if (res.success) {
              _this6.getaccousettingsData();
            }
          });
        }
      }, {
        key: "removeDp",
        value: function removeDp() {
          var _this7 = this;

          this.disableSubmitButton = true;
          this.accSettingsService.removeDp().subscribe(function (res) {
            if (res.success) {
              _this7.getaccousettingsData();
            }
          });
        }
      }, {
        key: "openDialog",
        value: function openDialog() {
          var dialogRef = this.dialog.open(_app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_15__["Successdialog"], {
            disableClose: true,
            panelClass: 'changeuserloaderview'
          });
          dialogRef.afterClosed().subscribe(function (result) {});
        }
      }, {
        key: "viewinvoice",
        value: function viewinvoice() {
          var _this8 = this;

          this.routeid.queryParams.subscribe(function (params) {
            _this8.edit = params['id'];
          });
        }
      }, {
        key: "editor",
        value: function editor() {
          if (this.edit == 3) {
            console.log(1234);
            this.router.navigate(['/accountsettings/twofactorauth'], {
              queryParams: {
                id: 1
              }
            });
          } else {
            this.router.navigate(['/accountsettings/twofactorauth']);
            console.log(12345);
          }
        }
      }]);

      return AccountsettingsComponent;
    }();

    AccountsettingsComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_17__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_14__["RemoteService"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_18__["MatDialog"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_10__["Router"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_13__["CookieService"]
      }, {
        type: _accountsettings_service__WEBPACK_IMPORTED_MODULE_3__["AccountsettingsService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_10__["ActivatedRoute"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_11__["ToastrService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('logo'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_7__["Filee"])], AccountsettingsComponent.prototype, "logo", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('MatTabGroup'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_tabs__WEBPACK_IMPORTED_MODULE_8__["MatTabGroup"])], AccountsettingsComponent.prototype, "tabGroup", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('subscriptiontab'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _subscriptionpaymentlist_subscriptionpaymentlist_component__WEBPACK_IMPORTED_MODULE_5__["SubscriptionpaymentlistComponent"])], AccountsettingsComponent.prototype, "subscriptiontab", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('twofactorauthtab'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _twofactorauth_twofactorauth_component__WEBPACK_IMPORTED_MODULE_16__["TwofactorauthComponent"])], AccountsettingsComponent.prototype, "twofactorauthtab", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('factortab'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_factorauthentication_factorauthentication_component__WEBPACK_IMPORTED_MODULE_6__["FactorauthenticationComponent"])], AccountsettingsComponent.prototype, "factortab", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('certificaterenewaldrawer'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_12__["MatDrawer"])], AccountsettingsComponent.prototype, "certificaterenewaldrawer", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["HostListener"])("window:beforeunoad", ["$event"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Function), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [Event]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:returntype", void 0)], AccountsettingsComponent.prototype, "unloadHandler", null);
    AccountsettingsComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-accountsettings',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./accountsettings.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/accountsettings.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./accountsettings.component.scss */
      "./src/app/modules/accountsettings/accountsettings.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_17__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_14__["RemoteService"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_18__["MatDialog"], _angular_router__WEBPACK_IMPORTED_MODULE_10__["Router"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_13__["CookieService"], _accountsettings_service__WEBPACK_IMPORTED_MODULE_3__["AccountsettingsService"], _angular_router__WEBPACK_IMPORTED_MODULE_10__["ActivatedRoute"], ngx_toastr__WEBPACK_IMPORTED_MODULE_11__["ToastrService"]])], AccountsettingsComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/accountsettings.module.ts":
  /*!*******************************************************************!*\
    !*** ./src/app/modules/accountsettings/accountsettings.module.ts ***!
    \*******************************************************************/

  /*! exports provided: createTranslateLoader, AccountsettingsModule */

  /***/
  function srcAppModulesAccountsettingsAccountsettingsModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function () {
      return createTranslateLoader;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AccountsettingsModule", function () {
      return AccountsettingsModule;
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


    var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _accountsettings_routing_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./accountsettings-routing.module */
    "./src/app/modules/accountsettings/accountsettings-routing.module.ts");
    /* harmony import */


    var _accountsettings_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./accountsettings.component */
    "./src/app/modules/accountsettings/accountsettings.component.ts");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
    /* harmony import */


    var _securitydetail_securitydetail_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ./securitydetail/securitydetail.component */
    "./src/app/modules/accountsettings/securitydetail/securitydetail.component.ts");
    /* harmony import */


    var ngx_smart_popover__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ngx-smart-popover */
    "./node_modules/ngx-smart-popover/__ivy_ngcc__/fesm2015/ngx-smart-popover.js");
    /* harmony import */


    var _securityquestionlist_securityquestionlist_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ./securityquestionlist/securityquestionlist.component */
    "./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.ts");
    /* harmony import */


    var _emailpreferenceslist_emailpreferenceslist_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! ./emailpreferenceslist/emailpreferenceslist.component */
    "./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.ts");
    /* harmony import */


    var _subscriptionpaymentlist_subscriptionpaymentlist_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! ./subscriptionpaymentlist/subscriptionpaymentlist.component */
    "./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.ts");
    /* harmony import */


    var _changesubscriptionlistview_changesubscriptionlistview_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! ./changesubscriptionlistview/changesubscriptionlistview.component */
    "./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.ts");
    /* harmony import */


    var _app_shared__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var _profilemanagement_profilemanagement_module__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! ../profilemanagement/profilemanagement.module */
    "./src/app/modules/profilemanagement/profilemanagement.module.ts");
    /* harmony import */


    var _enterpriseadmin_enterpriseadmin_module__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! ../enterpriseadmin/enterpriseadmin.module */
    "./src/app/modules/enterpriseadmin/enterpriseadmin.module.ts");
    /* harmony import */


    var _app_auth__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! @app/auth */
    "./src/app/auth/index.ts");
    /* harmony import */


    var _app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! @app/@shared/modal/successdialog */
    "./src/app/@shared/modal/successdialog.ts");
    /* harmony import */


    var _audittrailsidenav_audittrailsidenav_component__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! ./audittrailsidenav/audittrailsidenav.component */
    "./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.ts");
    /* harmony import */


    var ngx_daterangepicker_material__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! ngx-daterangepicker-material */
    "./node_modules/ngx-daterangepicker-material/__ivy_ngcc__/fesm2015/ngx-daterangepicker-material.js");
    /* harmony import */


    var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(
    /*! @ngx-translate/http-loader */
    "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _changepasswordbackend_changepasswordbackend_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(
    /*! ./changepasswordbackend/changepasswordbackend.component */
    "./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.ts");
    /* harmony import */


    var _twofactorauth_twofactorauth_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(
    /*! ./twofactorauth/twofactorauth.component */
    "./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.ts");
    /* harmony import */


    var mat_progress_buttons__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(
    /*! mat-progress-buttons */
    "./node_modules/mat-progress-buttons/__ivy_ngcc__/fesm2015/mat-progress-buttons.js");
    /* harmony import */


    var _twofactorauth_modal_succesinfo__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(
    /*! ./twofactorauth/modal/succesinfo */
    "./src/app/modules/accountsettings/twofactorauth/modal/succesinfo.ts"); // import { Successdialog } from './modal/successdialog';
    // import { ModulepermissionnewComponent } from './modulepermissionnew/modulepermissionnew.component';


    function createTranslateLoader(http) {
      return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_20__["TranslateHttpLoader"](http, './assets/i18n/accountsettings/', '.json');
    }

    var AccountsettingsModule = /*#__PURE__*/_createClass(function AccountsettingsModule() {
      _classCallCheck(this, AccountsettingsModule);
    });

    AccountsettingsModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_accountsettings_component__WEBPACK_IMPORTED_MODULE_5__["AccountsettingsComponent"], _securitydetail_securitydetail_component__WEBPACK_IMPORTED_MODULE_7__["SecuritydetailComponent"], _app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_17__["Successdialog"], _securityquestionlist_securityquestionlist_component__WEBPACK_IMPORTED_MODULE_9__["SecurityquestionlistComponent"], _emailpreferenceslist_emailpreferenceslist_component__WEBPACK_IMPORTED_MODULE_10__["EmailpreferenceslistComponent"], _subscriptionpaymentlist_subscriptionpaymentlist_component__WEBPACK_IMPORTED_MODULE_11__["SubscriptionpaymentlistComponent"], _changesubscriptionlistview_changesubscriptionlistview_component__WEBPACK_IMPORTED_MODULE_12__["ChangesubscriptionlistviewComponent"], _audittrailsidenav_audittrailsidenav_component__WEBPACK_IMPORTED_MODULE_18__["AudittrailsidenavComponent"], _changepasswordbackend_changepasswordbackend_component__WEBPACK_IMPORTED_MODULE_23__["ChangepasswordbackendComponent"], _twofactorauth_twofactorauth_component__WEBPACK_IMPORTED_MODULE_24__["TwofactorauthComponent"], _twofactorauth_modal_succesinfo__WEBPACK_IMPORTED_MODULE_26__["succesinfo"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _app_auth__WEBPACK_IMPORTED_MODULE_16__["AuthModule"], _accountsettings_routing_module__WEBPACK_IMPORTED_MODULE_4__["AccountsettingsRoutingModule"], mat_progress_buttons__WEBPACK_IMPORTED_MODULE_25__["MatProgressButtonsModule"], _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], ngx_smart_popover__WEBPACK_IMPORTED_MODULE_8__["PopoverModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_6__["FlexLayoutModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["ReactiveFormsModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormsModule"], _app_shared__WEBPACK_IMPORTED_MODULE_13__["SharedModule"], _profilemanagement_profilemanagement_module__WEBPACK_IMPORTED_MODULE_14__["ProfilemanagementModule"], _enterpriseadmin_enterpriseadmin_module__WEBPACK_IMPORTED_MODULE_15__["EnterpriseadminModule"], ngx_daterangepicker_material__WEBPACK_IMPORTED_MODULE_19__["NgxDaterangepickerMd"].forRoot(), _ngx_translate_core__WEBPACK_IMPORTED_MODULE_22__["TranslateModule"].forChild({
        loader: {
          provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_22__["TranslateLoader"],
          useFactory: createTranslateLoader,
          deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_21__["HttpClient"]]
        }
      })],
      entryComponents: [_app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_17__["Successdialog"]],
      exports: [_changepasswordbackend_changepasswordbackend_component__WEBPACK_IMPORTED_MODULE_23__["ChangepasswordbackendComponent"]],
      providers: [ngx_daterangepicker_material__WEBPACK_IMPORTED_MODULE_19__["NgxDaterangepickerMd"]]
    })], AccountsettingsModule);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.scss":
  /*!********************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.scss ***!
    \********************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsAudittrailsidenavAudittrailsidenavComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "@charset \"UTF-8\";\n.audit_mainclass #audit_traillist .heading_oftable .expand_mainclass .end_switch {\n  display: flex;\n  justify-content: flex-end !important;\n  align-items: center !important;\n}\n.audit_mainclass #audit_traillist .heading_oftable .expand_mainclass .end_switch .oncolor {\n  color: #14a922;\n}\n.audit_mainclass #audit_traillist .heading_oftable .expand_mainclass .end_switch .offcolor {\n  color: #eb3b3b;\n}\n.audit_mainclass #audit_traillist .heading_oftable .expand_mainclass .profilecolor {\n  padding-bottom: 12px;\n  padding-top: 12px;\n}\n.audit_mainclass #audit_traillist .heading_oftable .expand_mainclass .profilecolor P {\n  color: #f4811f;\n  margin: 0px;\n}\n.audit_mainclass #audit_traillist .heading_oftable .expand_mainclass .externalbox {\n  padding: 20px;\n  border: 1px solid #dde4e9;\n  background-clip: padding-box;\n  background-color: #fff;\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);\n}\n.audit_mainclass #audit_traillist .heading_oftable .expand_mainclass .externalbox .subtitle_secondrow p {\n  color: #666;\n  margin: 0px;\n}\n.audit_mainclass #audit_traillist .heading_oftable .example-expanded-row .aftercolor::after {\n  transform: rotate(180deg);\n  color: #006cb7 !important;\n}\n.audit_mainclass #audit_traillist .heading_oftable .mat-header-row {\n  min-height: 42px;\n  background-color: #e0f0ff;\n  border-radius: 2px;\n  border: none;\n}\n.audit_mainclass #audit_traillist .heading_oftable .aftercolor {\n  position: relative;\n  height: 20px;\n  width: 20px;\n  border-radius: 50%;\n  display: inline-block;\n  cursor: pointer;\n}\n.audit_mainclass #audit_traillist .heading_oftable .aftercolor img {\n  width: 20px;\n  height: 20px;\n  margin-left: 14px;\n  margin-top: 15px;\n}\n.audit_mainclass #audit_traillist .heading_oftable .mat-ripple:not(:empty) {\n  padding-left: 12px;\n}\n.audit_mainclass #audit_traillist .heading_oftable .aftercolor::after {\n  font-family: \"bgi-icon\" !important;\n  font-style: normal;\n  font-weight: normal;\n  font-variant: normal;\n  text-transform: none;\n  line-height: 1;\n  -webkit-font-smoothing: antialiased;\n  -moz-osx-font-smoothing: grayscale;\n  content: \"\";\n  cursor: pointer;\n  color: #7f8fa4;\n  vertical-align: middle;\n  position: absolute;\n  top: 6px;\n  font-size: 0.625rem;\n  text-align: center;\n  right: 20px;\n  font-weight: 600;\n  left: auto;\n}\n.audit_mainclass #audit_traillist .heading_oftable th {\n  text-align: left;\n  color: #333;\n}\n.audit_mainclass #audit_traillist table {\n  width: 100%;\n}\n.audit_mainclass #audit_traillist .example-detail-row {\n  min-height: 0;\n  height: 0;\n}\n.audit_mainclass #audit_traillist .example-detail-row td {\n  padding: 0 !important;\n  font-size: 0.875rem;\n  color: #333;\n}\n.audit_mainclass #audit_traillist .example-expanded-row + .example-detail-row {\n  min-height: auto;\n  height: auto;\n}\n.audit_mainclass #audit_traillist .example-element-row:not(.example-expanded-row):hover {\n  background: whitesmoke;\n}\n.audit_mainclass #audit_traillist .example-element-row:not(.example-expanded-row):active {\n  background: #efefef;\n}\n.audit_mainclass #audit_traillist .example-element-row td {\n  border-bottom-width: 0;\n  font-size: 0.875rem;\n  color: #333;\n}\n.audit_mainclass #audit_traillist .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n.audit_mainclass #audit_traillist .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n.audit_mainclass #audit_traillist .example-element-symbol {\n  font-weight: bold;\n  font-size: 2.5rem;\n  line-height: normal;\n}\n.audit_mainclass #audit_traillist .example-element-description {\n  padding: 16px;\n}\n.audit_mainclass #audit_traillist .example-element-description-attribution {\n  opacity: 0.5;\n}\n.audit_mainclass #audit_traillist .daterangepickerfilter {\n  position: relative;\n}\n.audit_mainclass #audit_traillist .daterangepickerfilter .md-drppicker {\n  right: 1px !important;\n}\n.audit_mainclass #audit_traillist .daterangepickerfilter .flexdaterange {\n  display: flex;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker {\n  display: flex;\n  justify-content: flex-start !important;\n  align-items: center !important;\n  padding-top: 2px;\n  position: relative;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker input.mat-input-element {\n  height: auto;\n  font-size: 0.8125rem;\n  background: transparent;\n  cursor: pointer;\n  z-index: 9999;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker input.mat-input-element:focus {\n  box-shadow: none !important;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .md-drppicker .btn {\n  line-height: 1.5;\n  height: 30px;\n  padding-left: 10px !important;\n  padding-right: 10px !important;\n  text-transform: capitalize !important;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .mat-datepicker-toggle {\n  display: flex;\n  position: absolute;\n  right: 0;\n  z-index: 0;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .mat-icon-button {\n  height: auto;\n  line-height: inherit;\n  width: auto;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .mat-icon-button .mat-button-wrapper {\n  display: flex;\n  justify-content: flex-end !important;\n  align-items: center !important;\n}\n@media (max-width: 1279px) {\n  .audit_mainclass #audit_traillist .dateselect .drpicker .md-drppicker.double {\n    max-width: 278px;\n    left: -20px !important;\n    margin-top: 15px;\n  }\n}\n@media (min-width: 1280px) {\n  .audit_mainclass #audit_traillist .dateselect .drpicker .md-drppicker.double {\n    min-width: 540px;\n    margin-left: -20px;\n    left: auto !important;\n    margin-top: 15px;\n  }\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .md-drppicker.double .buttons {\n  float: left;\n  width: 100%;\n  padding-right: 10px;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .md-drppicker.double .btn.clear {\n  background: #bbb !important;\n  margin-right: 8px;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .md-drppicker.double .btn.clear svg {\n  display: none !important;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .md-drppicker.double th.month div {\n  text-align: left;\n  margin-right: 12px;\n}\n.audit_mainclass #audit_traillist .dateselect .drpicker .mat-datepicker-toggle-default-icon {\n  height: 15px;\n}\n.audit_mainclass #audit_traillist .dateselect .md-drppicker {\n  right: 1px !important;\n}\n.audit_mainclass #audit_traillist .dateselect .mat-form-field-appearance-legacy .mat-form-field-ripple {\n  display: none;\n}\n.audit_mainclass #audit_traillist .dateselect .mat-form-field {\n  width: 205px !important;\n}\n.audit_mainclass #audit_traillist .dateselect .mat-form-field-flex {\n  align-items: center;\n}\n.audit_mainclass #audit_traillist .dateselect .mat-form-field-appearance-legacy .mat-form-field-wrapper {\n  padding-bottom: 13px;\n}\n.audit_mainclass #audit_traillist .dateselect .mat-form-field.mat-focused .mat-form-field-label {\n  color: #006cb7;\n  opacity: 0;\n}\n.audit_mainclass #audit_traillist .dateselect .mat-form-field-infix {\n  border-top: 0;\n}\n.audit_mainclass #audit_traillist .dateselect input.mat-input-element,\n.audit_mainclass #audit_traillist .dateselect .mat-form-field-label {\n  font-size: 0.875rem;\n  padding-left: 5px;\n  color: #333 !important;\n}\n.audit_mainclass #audit_traillist .dateselect .cleardate {\n  position: absolute;\n  top: 0;\n  cursor: pointer;\n  color: rgba(0, 0, 0, 0.54);\n  right: 22px;\n  font-size: 1.125rem;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  height: 15px;\n  margin-top: 2px;\n  z-index: 9999;\n}\n.audit_mainclass #audit_traillist .dateselect .closeanddateicon {\n  display: flex !important;\n  align-items: center !important;\n}\n.audit_mainclass .audittrailbottomlist {\n  width: 100%;\n  border-bottom: 1px solid #dadada;\n}\n.audit_mainclass .audittrailbottomlist .audittrailflexalign {\n  width: 100%;\n}\n.audit_mainclass .audittrailbottomlist .audittrailflexalign .auditheader {\n  display: flex;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n.audit_mainclass .audittrailbottomlist .audittrailflexalign .auditheader .subtitleofaudit h4 {\n  color: #006cb7;\n  padding-bottom: 2px;\n}\n.audit_mainclass .audittrailbottomlist .audittrailflexalign .auditheader .imageview {\n  width: 45px;\n  height: 45px;\n  border: 1px solid #ddd;\n  border-radius: 3px;\n  margin-right: 10px;\n}\n.audit_mainclass .audittrailbottomlist .audittrailflexalign .auditheader .imageview img {\n  max-width: 100%;\n}\n@media (max-width: 768px) {\n  #audit_traillist .mat-table .mat-row {\n    display: flex !important;\n  }\n}\n@media (max-width: 767px) {\n  .audittrailflexalign {\n    padding-left: 12px !important;\n    padding-right: 12px !important;\n  }\n\n  #audit_traillist .mat-table .mat-row {\n    display: block !important;\n    padding: 10px;\n  }\n  #audit_traillist .heading_oftable .aftercolor::after {\n    position: absolute;\n    top: 25px !important;\n    right: -276px !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvYXVkaXR0cmFpbHNpZGVuYXYvYXVkaXR0cmFpbHNpZGVuYXYuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL2F1ZGl0dHJhaWxzaWRlbmF2L0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFjY291bnRzZXR0aW5nc1xcYXVkaXR0cmFpbHNpZGVuYXZcXGF1ZGl0dHJhaWxzaWRlbmF2LmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLGdCQUFnQjtBQ3lCQTtFQWRaLGFBQUE7RUFDQSxvQ0FBQTtFQUNBLDhCQUFBO0FEUko7QUNzQm9CO0VBQ0ksY0FBQTtBRHBCeEI7QUNzQm9CO0VBQ0ssY0FBQTtBRHBCekI7QUN1QmdCO0VBQ0ksb0JBQUE7RUFDQSxpQkFBQTtBRHJCcEI7QUNzQnFCO0VBQ0ksY0FBQTtFQUNBLFdBQUE7QURwQnpCO0FDdUJnQjtFQUNJLGFBQUE7RUFDQSx5QkFBQTtFQUNBLDRCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1Q0FBQTtBRHJCcEI7QUN1QndCO0VBQ0ksV0FBQTtFQUNBLFdBQUE7QURyQjVCO0FDMkJXO0VBQ0cseUJBQUE7RUFDQSx5QkFBQTtBRHpCZDtBQzJCYTtFQUNHLGdCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7QUR6QmhCO0FDMkJZO0VBQ0ksa0JBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0VBQ0EscUJBQUE7RUFDQSxlQUFBO0FEekJoQjtBQzBCb0I7RUFDSyxXQUFBO0VBQ0EsWUFBQTtFQUNBLGlCQUFBO0VBQ0QsZ0JBQUE7QUR4QnhCO0FDMkJxQjtFQUNHLGtCQUFBO0FEekJ4QjtBQzJCb0I7RUFDSSxrQ0FBQTtFQUNBLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxvQkFBQTtFQUNB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QUE7QURuQ1o7QUNvQ1k7RUE1U1IsYUFBQTtFQUNBLHNDQUFBO0VBQ0EsOEJBQUE7QUQyUUo7QUNrQ29CO0VBQ0ksY0FBQTtFQUNBLG1CQUFBO0FEaEN4QjtBQ21DaUI7RUFDRyxXQUFBO0VBQ0EsWUFBQTtFQUNBLHNCQUFBO0VBQ0Esa0JBQUE7RUFDQSxrQkFBQTtBRGpDcEI7QUNrQ3NCO0VBQ00sZUFBQTtBRGhDNUI7QUN3Q0E7RUFFSTtJQUNFLHdCQUFBO0VEdENKO0FBQ0Y7QUMyQ0E7RUFDRTtJQUNJLDZCQUFBO0lBQ0EsOEJBQUE7RUR6Q0o7O0VDNENFO0lBQ0UseUJBQUE7SUFDQSxhQUFBO0VEekNKO0VDMkNJO0lBQ0Usa0JBQUE7SUFDQSxvQkFBQTtJQUNBLHdCQUFBO0VEekNOO0FBQ0YiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL2FjY291bnRzZXR0aW5ncy9hdWRpdHRyYWlsc2lkZW5hdi9hdWRpdHRyYWlsc2lkZW5hdi5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIkBjaGFyc2V0IFwiVVRGLThcIjtcbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuaGVhZGluZ19vZnRhYmxlIC5leHBhbmRfbWFpbmNsYXNzIC5lbmRfc3dpdGNoIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmhlYWRpbmdfb2Z0YWJsZSAuZXhwYW5kX21haW5jbGFzcyAuZW5kX3N3aXRjaCAub25jb2xvciB7XG4gIGNvbG9yOiAjMTRhOTIyO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5oZWFkaW5nX29mdGFibGUgLmV4cGFuZF9tYWluY2xhc3MgLmVuZF9zd2l0Y2ggLm9mZmNvbG9yIHtcbiAgY29sb3I6ICNlYjNiM2I7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmhlYWRpbmdfb2Z0YWJsZSAuZXhwYW5kX21haW5jbGFzcyAucHJvZmlsZWNvbG9yIHtcbiAgcGFkZGluZy1ib3R0b206IDEycHg7XG4gIHBhZGRpbmctdG9wOiAxMnB4O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5oZWFkaW5nX29mdGFibGUgLmV4cGFuZF9tYWluY2xhc3MgLnByb2ZpbGVjb2xvciBQIHtcbiAgY29sb3I6ICNmNDgxMWY7XG4gIG1hcmdpbjogMHB4O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5oZWFkaW5nX29mdGFibGUgLmV4cGFuZF9tYWluY2xhc3MgLmV4dGVybmFsYm94IHtcbiAgcGFkZGluZzogMjBweDtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZTRlOTtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5oZWFkaW5nX29mdGFibGUgLmV4cGFuZF9tYWluY2xhc3MgLmV4dGVybmFsYm94IC5zdWJ0aXRsZV9zZWNvbmRyb3cgcCB7XG4gIGNvbG9yOiAjNjY2O1xuICBtYXJnaW46IDBweDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuaGVhZGluZ19vZnRhYmxlIC5leGFtcGxlLWV4cGFuZGVkLXJvdyAuYWZ0ZXJjb2xvcjo6YWZ0ZXIge1xuICB0cmFuc2Zvcm06IHJvdGF0ZSgxODBkZWcpO1xuICBjb2xvcjogIzAwNmNiNyAhaW1wb3J0YW50O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5oZWFkaW5nX29mdGFibGUgLm1hdC1oZWFkZXItcm93IHtcbiAgbWluLWhlaWdodDogNDJweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2UwZjBmZjtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3JkZXI6IG5vbmU7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmhlYWRpbmdfb2Z0YWJsZSAuYWZ0ZXJjb2xvciB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgaGVpZ2h0OiAyMHB4O1xuICB3aWR0aDogMjBweDtcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xuICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuaGVhZGluZ19vZnRhYmxlIC5hZnRlcmNvbG9yIGltZyB7XG4gIHdpZHRoOiAyMHB4O1xuICBoZWlnaHQ6IDIwcHg7XG4gIG1hcmdpbi1sZWZ0OiAxNHB4O1xuICBtYXJnaW4tdG9wOiAxNXB4O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5oZWFkaW5nX29mdGFibGUgLm1hdC1yaXBwbGU6bm90KDplbXB0eSkge1xuICBwYWRkaW5nLWxlZnQ6IDEycHg7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmhlYWRpbmdfb2Z0YWJsZSAuYWZ0ZXJjb2xvcjo6YWZ0ZXIge1xuICBmb250LWZhbWlseTogXCJiZ2ktaWNvblwiICFpbXBvcnRhbnQ7XG4gIGZvbnQtc3R5bGU6IG5vcm1hbDtcbiAgZm9udC13ZWlnaHQ6IG5vcm1hbDtcbiAgZm9udC12YXJpYW50OiBub3JtYWw7XG4gIHRleHQtdHJhbnNmb3JtOiBub25lO1xuICBsaW5lLWhlaWdodDogMTtcbiAgLXdlYmtpdC1mb250LXNtb290aGluZzogYW50aWFsaWFzZWQ7XG4gIC1tb3otb3N4LWZvbnQtc21vb3RoaW5nOiBncmF5c2NhbGU7XG4gIGNvbnRlbnQ6IFwi7qSIXCI7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgY29sb3I6ICM3ZjhmYTQ7XG4gIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgdG9wOiA2cHg7XG4gIGZvbnQtc2l6ZTogMC42MjVyZW07XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgcmlnaHQ6IDIwcHg7XG4gIGZvbnQtd2VpZ2h0OiA2MDA7XG4gIGxlZnQ6IGF1dG87XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmhlYWRpbmdfb2Z0YWJsZSB0aCB7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG4gIGNvbG9yOiAjMzMzO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IHRhYmxlIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmV4YW1wbGUtZGV0YWlsLXJvdyB7XG4gIG1pbi1oZWlnaHQ6IDA7XG4gIGhlaWdodDogMDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZXhhbXBsZS1kZXRhaWwtcm93IHRkIHtcbiAgcGFkZGluZzogMCAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBjb2xvcjogIzMzMztcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZXhhbXBsZS1leHBhbmRlZC1yb3cgKyAuZXhhbXBsZS1kZXRhaWwtcm93IHtcbiAgbWluLWhlaWdodDogYXV0bztcbiAgaGVpZ2h0OiBhdXRvO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogd2hpdGVzbW9rZTtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZXhhbXBsZS1lbGVtZW50LXJvdzpub3QoLmV4YW1wbGUtZXhwYW5kZWQtcm93KTphY3RpdmUge1xuICBiYWNrZ3JvdW5kOiAjZWZlZmVmO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcbiAgYm9yZGVyLWJvdHRvbS13aWR0aDogMDtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgY29sb3I6ICMzMzM7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmV4YW1wbGUtZWxlbWVudC1kZXRhaWwge1xuICBvdmVyZmxvdzogaGlkZGVuO1xuICBkaXNwbGF5OiBmbGV4O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5leGFtcGxlLWVsZW1lbnQtZGlhZ3JhbSB7XG4gIG1pbi13aWR0aDogODBweDtcbiAgYm9yZGVyOiAycHggc29saWQgYmxhY2s7XG4gIHBhZGRpbmc6IDhweDtcbiAgZm9udC13ZWlnaHQ6IGxpZ2h0ZXI7XG4gIG1hcmdpbjogOHB4IDA7XG4gIGhlaWdodDogMTA0cHg7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmV4YW1wbGUtZWxlbWVudC1zeW1ib2wge1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgZm9udC1zaXplOiAyLjVyZW07XG4gIGxpbmUtaGVpZ2h0OiBub3JtYWw7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbiB7XG4gIHBhZGRpbmc6IDE2cHg7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XG4gIG9wYWNpdHk6IDAuNTtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXJhbmdlcGlja2VyZmlsdGVyIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5kYXRlcmFuZ2VwaWNrZXJmaWx0ZXIgLm1kLWRycHBpY2tlciB7XG4gIHJpZ2h0OiAxcHggIWltcG9ydGFudDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXJhbmdlcGlja2VyZmlsdGVyIC5mbGV4ZGF0ZXJhbmdlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXRvcDogMnB4O1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLmRycGlja2VyIGlucHV0Lm1hdC1pbnB1dC1lbGVtZW50IHtcbiAgaGVpZ2h0OiBhdXRvO1xuICBmb250LXNpemU6IDAuODEyNXJlbTtcbiAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgei1pbmRleDogOTk5OTtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIgaW5wdXQubWF0LWlucHV0LWVsZW1lbnQ6Zm9jdXMge1xuICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLmRycGlja2VyIC5tZC1kcnBwaWNrZXIgLmJ0biB7XG4gIGxpbmUtaGVpZ2h0OiAxLjU7XG4gIGhlaWdodDogMzBweDtcbiAgcGFkZGluZy1sZWZ0OiAxMHB4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctcmlnaHQ6IDEwcHggIWltcG9ydGFudDtcbiAgdGV4dC10cmFuc2Zvcm06IGNhcGl0YWxpemUgIWltcG9ydGFudDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIgLm1hdC1kYXRlcGlja2VyLXRvZ2dsZSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgcmlnaHQ6IDA7XG4gIHotaW5kZXg6IDA7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLmRycGlja2VyIC5tYXQtaWNvbi1idXR0b24ge1xuICBoZWlnaHQ6IGF1dG87XG4gIGxpbmUtaGVpZ2h0OiBpbmhlcml0O1xuICB3aWR0aDogYXV0bztcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIgLm1hdC1pY29uLWJ1dHRvbiAubWF0LWJ1dHRvbi13cmFwcGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTI3OXB4KSB7XG4gIC5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIgLm1kLWRycHBpY2tlci5kb3VibGUge1xuICAgIG1heC13aWR0aDogMjc4cHg7XG4gICAgbGVmdDogLTIwcHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tdG9wOiAxNXB4O1xuICB9XG59XG5AbWVkaWEgKG1pbi13aWR0aDogMTI4MHB4KSB7XG4gIC5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIgLm1kLWRycHBpY2tlci5kb3VibGUge1xuICAgIG1pbi13aWR0aDogNTQwcHg7XG4gICAgbWFyZ2luLWxlZnQ6IC0yMHB4O1xuICAgIGxlZnQ6IGF1dG8gIWltcG9ydGFudDtcbiAgICBtYXJnaW4tdG9wOiAxNXB4O1xuICB9XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLmRycGlja2VyIC5tZC1kcnBwaWNrZXIuZG91YmxlIC5idXR0b25zIHtcbiAgZmxvYXQ6IGxlZnQ7XG4gIHdpZHRoOiAxMDAlO1xuICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5kYXRlc2VsZWN0IC5kcnBpY2tlciAubWQtZHJwcGlja2VyLmRvdWJsZSAuYnRuLmNsZWFyIHtcbiAgYmFja2dyb3VuZDogI2JiYiAhaW1wb3J0YW50O1xuICBtYXJnaW4tcmlnaHQ6IDhweDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIgLm1kLWRycHBpY2tlci5kb3VibGUgLmJ0bi5jbGVhciBzdmcge1xuICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLmRycGlja2VyIC5tZC1kcnBwaWNrZXIuZG91YmxlIHRoLm1vbnRoIGRpdiB7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG4gIG1hcmdpbi1yaWdodDogMTJweDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuZHJwaWNrZXIgLm1hdC1kYXRlcGlja2VyLXRvZ2dsZS1kZWZhdWx0LWljb24ge1xuICBoZWlnaHQ6IDE1cHg7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLm1kLWRycHBpY2tlciB7XG4gIHJpZ2h0OiAxcHggIWltcG9ydGFudDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXJpcHBsZSB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLm1hdC1mb3JtLWZpZWxkIHtcbiAgd2lkdGg6IDIwNXB4ICFpbXBvcnRhbnQ7XG59XG4uYXVkaXRfbWFpbmNsYXNzICNhdWRpdF90cmFpbGxpc3QgLmRhdGVzZWxlY3QgLm1hdC1mb3JtLWZpZWxkLWZsZXgge1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5kYXRlc2VsZWN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XG4gIHBhZGRpbmctYm90dG9tOiAxM3B4O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5kYXRlc2VsZWN0IC5tYXQtZm9ybS1maWVsZC5tYXQtZm9jdXNlZCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzAwNmNiNztcbiAgb3BhY2l0eTogMDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBib3JkZXItdG9wOiAwO1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5kYXRlc2VsZWN0IGlucHV0Lm1hdC1pbnB1dC1lbGVtZW50LFxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5kYXRlc2VsZWN0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIHBhZGRpbmctbGVmdDogNXB4O1xuICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xufVxuLmF1ZGl0X21haW5jbGFzcyAjYXVkaXRfdHJhaWxsaXN0IC5kYXRlc2VsZWN0IC5jbGVhcmRhdGUge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHRvcDogMDtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBjb2xvcjogcmdiYSgwLCAwLCAwLCAwLjU0KTtcbiAgcmlnaHQ6IDIycHg7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBoZWlnaHQ6IDE1cHg7XG4gIG1hcmdpbi10b3A6IDJweDtcbiAgei1pbmRleDogOTk5OTtcbn1cbi5hdWRpdF9tYWluY2xhc3MgI2F1ZGl0X3RyYWlsbGlzdCAuZGF0ZXNlbGVjdCAuY2xvc2VhbmRkYXRlaWNvbiB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLmF1ZGl0X21haW5jbGFzcyAuYXVkaXR0cmFpbGJvdHRvbWxpc3Qge1xuICB3aWR0aDogMTAwJTtcbiAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkYWRhZGE7XG59XG4uYXVkaXRfbWFpbmNsYXNzIC5hdWRpdHRyYWlsYm90dG9tbGlzdCAuYXVkaXR0cmFpbGZsZXhhbGlnbiB7XG4gIHdpZHRoOiAxMDAlO1xufVxuLmF1ZGl0X21haW5jbGFzcyAuYXVkaXR0cmFpbGJvdHRvbWxpc3QgLmF1ZGl0dHJhaWxmbGV4YWxpZ24gLmF1ZGl0aGVhZGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5hdWRpdF9tYWluY2xhc3MgLmF1ZGl0dHJhaWxib3R0b21saXN0IC5hdWRpdHRyYWlsZmxleGFsaWduIC5hdWRpdGhlYWRlciAuc3VidGl0bGVvZmF1ZGl0IGg0IHtcbiAgY29sb3I6ICMwMDZjYjc7XG4gIHBhZGRpbmctYm90dG9tOiAycHg7XG59XG4uYXVkaXRfbWFpbmNsYXNzIC5hdWRpdHRyYWlsYm90dG9tbGlzdCAuYXVkaXR0cmFpbGZsZXhhbGlnbiAuYXVkaXRoZWFkZXIgLmltYWdldmlldyB7XG4gIHdpZHRoOiA0NXB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG4gIGJvcmRlci1yYWRpdXM6IDNweDtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xufVxuLmF1ZGl0X21haW5jbGFzcyAuYXVkaXR0cmFpbGJvdHRvbWxpc3QgLmF1ZGl0dHJhaWxmbGV4YWxpZ24gLmF1ZGl0aGVhZGVyIC5pbWFnZXZpZXcgaW1nIHtcbiAgbWF4LXdpZHRoOiAxMDAlO1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI2F1ZGl0X3RyYWlsbGlzdCAubWF0LXRhYmxlIC5tYXQtcm93IHtcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xuICAuYXVkaXR0cmFpbGZsZXhhbGlnbiB7XG4gICAgcGFkZGluZy1sZWZ0OiAxMnB4ICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1yaWdodDogMTJweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgI2F1ZGl0X3RyYWlsbGlzdCAubWF0LXRhYmxlIC5tYXQtcm93IHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmc6IDEwcHg7XG4gIH1cbiAgI2F1ZGl0X3RyYWlsbGlzdCAuaGVhZGluZ19vZnRhYmxlIC5hZnRlcmNvbG9yOjphZnRlciB7XG4gICAgcG9zaXRpb246IGFic29sdXRlO1xuICAgIHRvcDogMjVweCAhaW1wb3J0YW50O1xuICAgIHJpZ2h0OiAtMjc2cHggIWltcG9ydGFudDtcbiAgfVxufSIsIkBtaXhpbiBmbGV4Y2VudGVyIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcbkBtaXhpbiBmbGV4c3RhcnQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcbkBtaXhpbiBmbGV4ZW5kIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuQG1peGluIHNwYWNlYmV0d2VlbiB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbi5hdWRpdF9tYWluY2xhc3N7XHJcbiAgICAjYXVkaXRfdHJhaWxsaXN0e1xyXG4gICAgICAgIC5oZWFkaW5nX29mdGFibGV7XHJcbiAgICAgICAgICAgIC5leHBhbmRfbWFpbmNsYXNze1xyXG4gICAgICAgICAgICAgICAgLmVuZF9zd2l0Y2h7XHJcbiAgICAgICAgICAgICAgICAgICAgQGluY2x1ZGUgZmxleGVuZCgpO1xyXG4gICAgICAgICAgICAgICAgICAgIC5vbmNvbG9ye1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzE0YTkyMjtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgLm9mZmNvbG9ye1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNlYjNiM2I7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLnByb2ZpbGVjb2xvcntcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTJweDtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLXRvcDogMTJweDtcclxuICAgICAgICAgICAgICAgICAgICAgUHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZjQ4MTFmO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC5leHRlcm5hbGJveHtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkZGU0ZTk7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMCA0cHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcclxuICAgICAgICAgICAgICAgICAgICAuc3VidGl0bGVfc2Vjb25kcm93e1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM2NjY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgLmV4YW1wbGUtZXhwYW5kZWQtcm93IC5hZnRlcmNvbG9yOjphZnRlcntcclxuICAgICAgICAgICAgICB0cmFuc2Zvcm06IHJvdGF0ZSgxODBkZWcpO1xyXG4gICAgICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgIC5tYXQtaGVhZGVyLXJvdyB7XHJcbiAgICAgICAgICAgICAgICBtaW4taGVpZ2h0OiA0MnB4O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2UwZjBmZjtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogbm9uZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAuYWZ0ZXJjb2xvcntcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMjBweDtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOnBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgaW1ne1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW4tbGVmdDogMTRweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMTVweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgLm1hdC1yaXBwbGU6bm90KDplbXB0eSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDEycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5hZnRlcmNvbG9yOjphZnRlcntcclxuICAgICAgICAgICAgICAgICAgICAgICAgZm9udC1mYW1pbHk6IFwiYmdpLWljb25cIiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250LXN0eWxlOiBub3JtYWw7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiBub3JtYWw7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtdmFyaWFudDogbm9ybWFsO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LXRyYW5zZm9ybTogbm9uZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC13ZWJraXQtZm9udC1zbW9vdGhpbmc6IGFudGlhbGlhc2VkO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAtbW96LW9zeC1mb250LXNtb290aGluZzogZ3JheXNjYWxlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb250ZW50OiBcIlxcZTkwOFwiO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjdXJzb3I6cG9pbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM3ZjhmYTQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdG9wOiA2cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC42MjVyZW07XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcmlnaHQ6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiA2MDA7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGxlZnQ6IGF1dG87XHJcbiAgICAgICAgICAgICAgICAgICAgfSAgICAgICAgXHJcbiAgICAgICAgICAgICBcclxuICAgICAgICAgICAgdGh7XHJcbiAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbiAgICAgICAgICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgdGFibGUge1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIC5leGFtcGxlLWRldGFpbC1yb3cge1xyXG4gICAgICAgICAgICBtaW4taGVpZ2h0OiAwO1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDA7XHJcbiAgICAgICAgICAgIHRke1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICAuZXhhbXBsZS1leHBhbmRlZC1yb3cgKy5leGFtcGxlLWRldGFpbC1yb3cge1xyXG4gICAgICAgICAgICBtaW4taGVpZ2h0OiBhdXRvO1xyXG4gICAgICAgICAgICBoZWlnaHQ6IGF1dG87XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LXJvdzpub3QoLmV4YW1wbGUtZXhwYW5kZWQtcm93KTpob3ZlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6IHdoaXRlc21va2U7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICBcclxuICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmFjdGl2ZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNlZmVmZWY7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICBcclxuICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcclxuICAgICAgICAgICAgYm9yZGVyLWJvdHRvbS13aWR0aDogMDtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICBcclxuICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGV0YWlsIHtcclxuICAgICAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIFxyXG4gICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1kaWFncmFtIHtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiA4MHB4O1xyXG4gICAgICAgICAgICBib3JkZXI6IDJweCBzb2xpZCBibGFjaztcclxuICAgICAgICAgICAgcGFkZGluZzogOHB4O1xyXG4gICAgICAgICAgICBmb250LXdlaWdodDogbGlnaHRlcjtcclxuICAgICAgICAgICAgbWFyZ2luOiA4cHggMDtcclxuICAgICAgICAgICAgaGVpZ2h0OiAxMDRweDtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIFxyXG4gICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1zeW1ib2wge1xyXG4gICAgICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAyLjVyZW07XHJcbiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiBub3JtYWw7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICBcclxuICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xyXG4gICAgICAgICAgICBwYWRkaW5nOiAxNnB4O1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XHJcbiAgICAgICAgICAgIG9wYWNpdHk6IDAuNTtcclxuICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgLmRhdGVyYW5nZXBpY2tlcmZpbHRlciB7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgXHJcbiAgICAgICAgICAgIC5tZC1kcnBwaWNrZXJcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgIHJpZ2h0OjFweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5mbGV4ZGF0ZXJhbmdle1xyXG4gICAgICAgICAgICAgICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuICAgICAgICAgIC5kYXRlc2VsZWN0IHtcclxuICAgICAgICAgICAgLmRycGlja2VyIHtcclxuICAgICAgICAgICAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy10b3A6IDJweDtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIGlucHV0Lm1hdC1pbnB1dC1lbGVtZW50IHtcclxuICAgICAgICAgICAgICAgICAgaGVpZ2h0OiBhdXRvO1xyXG4gICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuODEyNXJlbTtcclxuICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgICAgei1pbmRleDogOTk5OTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIGlucHV0Lm1hdC1pbnB1dC1lbGVtZW50OmZvY3VzIHtcclxuICAgICAgICAgICAgICAgICAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1kLWRycHBpY2tlciAuYnRuIHtcclxuICAgICAgICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDEuNTtcclxuICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICB0ZXh0LXRyYW5zZm9ybTogY2FwaXRhbGl6ZSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1hdC1kYXRlcGlja2VyLXRvZ2dsZSB7XHJcbiAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgcmlnaHQ6IDA7XHJcbiAgICAgICAgICAgICAgICAgIHotaW5kZXg6IDA7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAubWF0LWljb24tYnV0dG9uIHtcclxuICAgICAgICAgICAgICAgICAgaGVpZ2h0OiBhdXRvO1xyXG4gICAgICAgICAgICAgICAgICBsaW5lLWhlaWdodDogaW5oZXJpdDtcclxuICAgICAgICAgICAgICAgICAgd2lkdGg6IGF1dG87XHJcbiAgICAgICAgICAgICAgICAgIC5tYXQtYnV0dG9uLXdyYXBwZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIEBpbmNsdWRlIGZsZXhlbmQoKTtcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1kLWRycHBpY2tlci5kb3VibGUge1xyXG4gICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogMTI3OXB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAyNzhweDtcclxuICAgICAgICAgICAgICAgICAgICBsZWZ0OiAtMjBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDE1cHg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgQG1lZGlhIChtaW4td2lkdGg6IDEyODBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDogNTQwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IC0yMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGxlZnQ6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAxNXB4O1xyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIC5idXR0b25zIHtcclxuICAgICAgICAgICAgICAgICAgICBmbG9hdDogbGVmdDtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIC5idG4uY2xlYXIge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNiYmIgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDhweDtcclxuICAgICAgICAgICAgICAgICAgICBzdmcge1xyXG4gICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICB0aC5tb250aCB7XHJcbiAgICAgICAgICAgICAgICAgICAgZGl2IHtcclxuICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDEycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAubWF0LWRhdGVwaWNrZXItdG9nZ2xlLWRlZmF1bHQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICAgIGhlaWdodDogMTVweDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgLm1kLWRycHBpY2tlclxyXG4gICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIHJpZ2h0OjFweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IC5tYXQtZm9ybS1maWVsZC1yaXBwbGUge1xyXG4gICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICB3aWR0aDogMjA1cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtZmxleCB7XHJcbiAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xyXG4gICAgICAgICAgICAgIHBhZGRpbmctYm90dG9tOiAxM3B4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC5tYXQtZm9jdXNlZCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgICAgICAgIG9wYWNpdHk6IDA7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcclxuICAgICAgICAgICAgICBib3JkZXItdG9wOiAwO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIGlucHV0Lm1hdC1pbnB1dC1lbGVtZW50LFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiA1cHg7XHJcbiAgICAgICAgICAgICAgY29sb3I6ICMzMzMgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAuY2xlYXJkYXRlIHtcclxuICAgICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICAgICAgdG9wOiAwO1xyXG4gICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICBjb2xvcjogcmdiYSgwLCAwLCAwLCAwLjU0KTtcclxuICAgICAgICAgICAgICByaWdodDogMjJweDtcclxuICAgICAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICBoZWlnaHQ6IDE1cHg7XHJcbiAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMnB4O1xyXG4gICAgICAgICAgICAgIHotaW5kZXg6IDk5OTk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLmNsb3NlYW5kZGF0ZWljb25cclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuICAgICAgfVxyXG4gICAgLmF1ZGl0dHJhaWxib3R0b21saXN0e1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGFkYWRhO1xyXG4gICAgICAgIC5hdWRpdHRyYWlsZmxleGFsaWdue1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgLmF1ZGl0aGVhZGVye1xyXG4gICAgICAgICAgICAgICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICAgICAgICAgICAgICAuc3VidGl0bGVvZmF1ZGl0e1xyXG4gICAgICAgICAgICAgICAgICAgIGg0e1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzAwNmNiNztcclxuICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDJweDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgLmltYWdldmlld3tcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogNDVweDtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgaW1ne1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgIH0gICBcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfSBcclxuICAgICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDo3NjhweCl7XHJcbiAgI2F1ZGl0X3RyYWlsbGlzdHtcclxuICAgIC5tYXQtdGFibGUgLm1hdC1yb3cge1xyXG4gICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICB9XHJcbiBcclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6NzY3cHgpe1xyXG4gIC5hdWRpdHRyYWlsZmxleGFsaWdue1xyXG4gICAgICBwYWRkaW5nLWxlZnQ6IDEycHggIWltcG9ydGFudDtcclxuICAgICAgcGFkZGluZy1yaWdodDogMTJweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAjYXVkaXRfdHJhaWxsaXN0e1xyXG4gICAgLm1hdC10YWJsZSAubWF0LXJvdyB7XHJcbiAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgIHBhZGRpbmc6IDEwcHg7XHJcbiAgICAgIH1cclxuICAgICAgLmhlYWRpbmdfb2Z0YWJsZSAuYWZ0ZXJjb2xvcjo6YWZ0ZXIge1xyXG4gICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICB0b3A6IDI1cHggIWltcG9ydGFudDtcclxuICAgICAgICByaWdodDogLTI3NnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgXHJcbiAgICB9XHJcbiAgfVxyXG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.ts":
  /*!******************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.ts ***!
    \******************************************************************************************/

  /*! exports provided: AudittrailsidenavComponent */

  /***/
  function srcAppModulesAccountsettingsAudittrailsidenavAudittrailsidenavComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AudittrailsidenavComponent", function () {
      return AudittrailsidenavComponent;
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


    var _app_common_drive_animation__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/common/drive/animation */
    "./src/app/common/drive/animation.ts");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! moment */
    "./node_modules/moment/moment.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_5__);
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_6__);
    /* harmony import */


    var _angular_animations__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/animations */
    "./node_modules/@angular/animations/__ivy_ngcc__/fesm2015/animations.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");

    var ELEMENT_DATA = [{
      sno: "1",
      datetime: "30-10-2020  10:00",
      modulename: "Contract Management System (CMS)"
    }, {
      sno: "2",
      datetime: "30-10-2021  10:10",
      modulename: "Master Company Profile (MCP)"
    }, {
      sno: "3",
      datetime: "30-10-2019  10:15",
      modulename: "Supplier Certification form (SCF)"
    }];

    var AudittrailsidenavComponent = /*#__PURE__*/function () {
      function AudittrailsidenavComponent() {
        _classCallCheck(this, AudittrailsidenavComponent);

        this.companydataview = [{
          profiletitle: "To be notified when user contacts from the external Profile",
          profilesubtitlte: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",
          status: "on"
        }, {
          profiletitle: "To receive audit log on a weekly basis",
          profilesubtitlte: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",
          status: "off"
        }];
        this.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_8__["MatTableDataSource"](ELEMENT_DATA);
        this.columnsToDisplay = ['s_no', 'date_time', 'module'];
        this.animationState = 'out';
        this.dateFilter = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]();
        this.selected2 = moment__WEBPACK_IMPORTED_MODULE_5___default()();
        this.locale = {
          customRangeLabel: ' - ',
          separator: ' to ',
          applyLabel: 'Apply',
          cancelLabel: 'Cancel',
          clearLabel: 'Clear',
          format: 'DD-MM-YYYY',
          daysOfWeek: moment__WEBPACK_IMPORTED_MODULE_5___default.a.weekdaysMin(),
          monthNames: moment__WEBPACK_IMPORTED_MODULE_5___default.a.monthsShort(),
          firstDay: moment__WEBPACK_IMPORTED_MODULE_5___default.a.localeData().firstDayOfWeek()
        };
      }

      _createClass(AudittrailsidenavComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }, {
        key: "auditalert",
        value: function auditalert() {
          var _this9 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_6___default()({
            title: "Do you want to cancel Audit Trail?",
            text: 'All the Data that you have entered will be lost.',
            icon: 'warning',
            closeOnClickOutside: false,
            closeOnEsc: false,
            buttons: ['Cancel', 'Ok'],
            dangerMode: true
          }).then(function (willDelete) {
            if (willDelete) {
              _this9.audittraillview.toggle();
            }
          });
          this.animationState = 'out';
        }
      }, {
        key: "audittraildropdown",
        value: function audittraildropdown(divName) {
          if (divName === 'audittraillist') {
            this.animationState = this.animationState === 'out' ? 'in' : 'out';
          }
        }
      }, {
        key: "clearDatelogin",
        value: function clearDatelogin(event) {
          event.stopPropagation();
          this.date = null;
          this.dateFilter.reset();
        }
      }]);

      return AudittrailsidenavComponent;
    }();

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('audittraillview'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_3__["MatDrawer"])], AudittrailsidenavComponent.prototype, "audittraillview", void 0);
    AudittrailsidenavComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-audittrailsidenav',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./audittrailsidenav.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.html"))["default"],
      animations: [_app_common_drive_animation__WEBPACK_IMPORTED_MODULE_4__["SlideInOutAnimation"], Object(_angular_animations__WEBPACK_IMPORTED_MODULE_7__["trigger"])('detailExpand', [Object(_angular_animations__WEBPACK_IMPORTED_MODULE_7__["state"])('collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_7__["style"])({
        height: '0px',
        minHeight: '0',
        visibility: 'hidden'
      })), Object(_angular_animations__WEBPACK_IMPORTED_MODULE_7__["state"])('expanded', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_7__["style"])({
        height: '*',
        visibility: 'visible'
      })), Object(_angular_animations__WEBPACK_IMPORTED_MODULE_7__["transition"])('expanded <=> collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_7__["animate"])('225ms cubic-bezier(0.4, 0.0, 0.2, 1)'))])],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./audittrailsidenav.component.scss */
      "./src/app/modules/accountsettings/audittrailsidenav/audittrailsidenav.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [])], AudittrailsidenavComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.scss":
  /*!****************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.scss ***!
    \****************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsChangepasswordbackendChangepasswordbackendComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "@charset \"UTF-8\";\n#pass_change {\n  background-color: #ffff;\n}\n#pass_change .txt-gry {\n  color: #262626;\n}\n#pass_change .txt-gry3 {\n  color: #848484;\n}\n#pass_change .txt-red {\n  color: #ED1C27;\n}\n#pass_change .content_box {\n  background-color: #ffff;\n}\n#pass_change .content_box .card {\n  box-shadow: 0 2px 11px 2px #0003, 0 1px 1px #00000024, 0 1px 3px #0000001f;\n  padding: 30px;\n  text-align: center;\n  border-radius: 5px;\n}\n#pass_change .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#pass_change .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#pass_change .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#pass_change .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#pass_change .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#pass_change .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#pass_change .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#pass_change .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#pass_change .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#pass_change .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#pass_change .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#pass_change .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#pass_change .savebtn {\n  height: 45px;\n  border-radius: 2px;\n}\n#pass_change .mat-raised-button {\n  box-shadow: none !important;\n  border-radius: 2px !important;\n  font-size: 1rem;\n  color: #fff;\n  text-decoration: none;\n  padding: 5px 10px;\n}\n#pass_change .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n#pass_change .cancelbtn {\n  min-width: 110px;\n  background-color: #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n}\n#pass_change .subbtn {\n  min-width: 110px;\n  color: #FFf;\n  padding-left: 0px;\n  padding-right: 0px;\n}\n#pass_change .subbtn button {\n  background-color: #21497c;\n  height: 45px;\n  border-radius: 2px !important;\n  font-size: 1em;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#pass_change .previousdisabled {\n  background-color: #ececec !important;\n  height: 45px;\n  border-radius: 2px !important;\n  font-size: 1em;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  color: #999 !important;\n}\n#pass_change .previousdisabled span.button-text {\n  color: #999 !important;\n  font-size: 1rem !important;\n}\n#pass_change .resentbtn {\n  background-color: transparent !important;\n  border: none;\n  color: #21497c;\n  cursor: pointer;\n}\n#pass_change .procbtn {\n  color: #ffffff;\n  min-width: 110px;\n}\n#pass_change .procbtn button {\n  background-color: #ED1C27;\n  height: 45px;\n  border-radius: 2px !important;\n  font-size: 1em;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#pass_change .submitbtns {\n  height: 46px;\n  border-radius: 2px;\n  background-color: #ed1c27;\n  color: #fff;\n  border: none;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n#pass_change .submitbtns .button-text {\n  font-size: 1rem !important;\n}\n#pass_change .btns {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#pass_change .divouter {\n  width: 89%;\n}\n#pass_change .divouter .flexalign.divinner {\n  display: flex;\n  justify-content: center;\n  left: 0;\n  position: sticky;\n  max-width: 88%;\n}\n#pass_change .divouter .flexalign.divinner #partitioned {\n  text-align: left;\n  padding-left: 16px;\n  letter-spacing: 62px;\n  border: 0;\n  min-width: 303px;\n  outline: none;\n  position: relative;\n  top: 5px;\n}\n#pass_change .otpfield {\n  display: block;\n  height: 12px;\n  width: 261px !important;\n  background-image: linear-gradient(to left, black 69%, rgba(255, 255, 255, 0) 0%) !important;\n  background-position: bottom;\n  background-size: 70px 1px;\n  background-repeat: repeat-x;\n  background-position-x: 47px;\n}\n#pass_change .successtick {\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n#pass_change .successtick span {\n  height: 64px;\n  width: 64px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  border-radius: 100%;\n  background: #fff;\n  border: 2px solid #169955;\n  color: #169955;\n}\n#pass_change .successtick span .mat-icon {\n  font-size: 43px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#pass_change button {\n  color: #fff;\n}\n#pass_change button .spinner {\n  top: auto !important;\n  bottom: auto !important;\n}\n#pass_change button .mat-progress-spinner.mat-warn circle,\n#pass_change button .mat-spinner.mat-warn circle {\n  stroke: #fff !important;\n}\n#pass_change .popover.popover-content.bs-popover-left {\n  margin-left: 0px !important;\n  left: 0px !important;\n  padding: 10px;\n  width: 90% !important;\n  margin-top: 10px;\n  top: 35% !important;\n  transform: translateY(-10%);\n}\n#pass_change .popover.popover-content.bs-popover-left .arrow::before,\n#pass_change .popover.popover-content.bs-popover-left .arrow::after {\n  border-width: 15px 0px 15px 15px !important;\n  top: 50% !important;\n  left: 50% !important;\n  transform: translate(-50%, -50%) !important;\n}\n#pass_change .popover.popover-content {\n  background-color: #ffff;\n  box-shadow: 0 0.2rem 0.4rem 0 rgba(0, 0, 0, 0.15);\n  border: none;\n  padding: 0;\n  z-index: 1060;\n  max-width: none;\n  border-radius: 0rem;\n  font-family: \"cairoregular\";\n  font-size: \"12px\";\n  border-radius: 2px;\n}\n#pass_change .popover.popover-content.sm {\n  max-width: 20rem;\n  min-width: 150px;\n  width: auto;\n}\n#pass_change .popover {\n  position: absolute;\n}\n#pass_change .popover.popover-content.sm {\n  max-width: 20rem;\n  min-width: 150px;\n}\n#pass_change .pophoverlisted .containcolor {\n  list-style-type: none;\n  padding: 0px;\n}\n#pass_change .pophoverlisted .containcolor li {\n  position: relative;\n  font-size: 0.875rem;\n  margin: 0px;\n  padding-left: 18px;\n  margin-bottom: 5px;\n  display: flex;\n  align-items: center;\n}\n#pass_change .pophoverlisted .unmatched::before {\n  font-family: FontAwesome;\n  content: \"\";\n  color: red !important;\n}\n#pass_change .pophoverlisted li::before {\n  font-family: FontAwesome;\n  content: \"\";\n  position: absolute;\n  left: 0px;\n  display: flex;\n  color: #666666;\n  font-size: 0.625rem;\n}\n#pass_change .containcolor {\n  list-style-type: none;\n  padding: 0px;\n}\n#pass_change .containcolor li {\n  position: relative;\n  font-size: 0.875rem;\n  margin: 0px;\n  padding-left: 18px;\n  margin-bottom: 5px;\n  display: flex;\n  align-items: center;\n}\n#pass_change .matched::before {\n  font-family: FontAwesome;\n  content: \"\";\n  color: #78c320 !important;\n}\n#pass_change .unmatched::before {\n  font-family: FontAwesome;\n  content: \"\";\n  color: red !important;\n}\n#pass_change li::before {\n  font-family: FontAwesome;\n  content: \"\";\n  position: absolute;\n  left: 0px;\n  display: flex;\n  color: #666666;\n  font-size: 0.625rem;\n}\n#pass_change .spacesuport {\n  padding-left: 60px;\n}\n#pass_change .spacesuport .textalign {\n  text-align: center;\n}\n#pass_change .spacesuport .passwordheadcolor {\n  position: relative;\n}\n#pass_change .spacesuport .passwordheadcolor h2, #pass_change .spacesuport .passwordheadcolor p {\n  color: #333333;\n  font-family: \"cairosemibold\";\n  font-size: 0.875rem;\n  margin: 0px;\n}\n#pass_change .spacesuport .passwordheadcolor p {\n  color: #666666 !important;\n  margin: 0px;\n  font-size: 15px !important;\n  padding-bottom: 5px;\n}\n#pass_change .banner {\n  background-image: url('http://192.168.1.200:82/opal_usp/app/assets/images/opalimages/backbanner.svg');\n  background-position: center;\n  background-repeat: no-repeat;\n  height: 555px;\n}\n#pass_change .login_footer {\n  margin-top: -11%;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvY2hhbmdlcGFzc3dvcmRiYWNrZW5kL2NoYW5nZXBhc3N3b3JkYmFja2VuZC5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvY2hhbmdlcGFzc3dvcmRiYWNrZW5kL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFjY291bnRzZXR0aW5nc1xcY2hhbmdlcGFzc3dvcmRiYWNrZW5kXFxjaGFuZ2VwYXNzd29yZGJhY2tlbmQuY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUEsZ0JBQWdCO0FDQWhCO0VBQ0ksdUJBQUE7QURFSjtBQ0FJO0VBQ0ksY0FBQTtBREVSO0FDQ0k7RUFDSSxjQUFBO0FEQ1I7QUNFSTtFQUNJLGNBQUE7QURBUjtBQ0dJO0VBQ0ksdUJBQUE7QUREUjtBQ0dRO0VBQ0ksMEVBQUE7RUFDQSxhQUFBO0VBQ0Esa0JBQUE7RUFDQSxrQkFBQTtBRERaO0FDT1E7RUFDSSxjQUFBO0FETFo7QUNRUTtFQUNJLDBCQUFBO0FETlo7QUNTUTtFQUNJLDBCQUFBO0FEUFo7QUNVUTtFQUNJLGNBQUE7QURSWjtBQ1dRO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FEVFo7QUNhWTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBRFhoQjtBQ2dCb0I7RUFDSSxjQUFBO0FEZHhCO0FDcUJZO0VBQ0kseUJBQUE7QURuQmhCO0FDeUJZO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FEdkJoQjtBQzZCZ0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUQzQnBCO0FDNkJvQjtFQUNJLGNBQUE7QUQzQnhCO0FDK0JnQjtFQUNJLHFCQUFBO0FEN0JwQjtBQ21DSTtFQUNJLFlBQUE7RUFDQSxrQkFBQTtBRGpDUjtBQ29DSTtFQUNJLDJCQUFBO0VBQ0EsNkJBQUE7RUFDQSxlQUFBO0VBQ0EsV0FB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LFlBQUE7RUFDQSxxQkFBQTtBRHJFUjtBQ3dFSTtFQUNJLHdCQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0EsU0FBQTtFQUNBLGFBQUE7RUFDQSxjQUFBO0VBQ0EsbUJBQUE7QUR0RVI7QUN5RUk7RUFDSSxxQkFBQTtFQUNBLFlBQUE7QUR2RVI7QUN5RVE7RUFDSSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0VBQ0Esa0JBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUR2RVo7QUMyRUk7RUFDSSx3QkFBQTtFQUNBLFlBQUE7RUFDQSx5QkFBQTtBRHpFUjtBQzRFSTtFQUNJLHdCQUFBO0VBQ0EsWUFBQTtFQUNBLHFCQUFBO0FEMUVSO0FDNkVJO0VBQ0ksd0JBQUE7RUFDQSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxTQUFBO0VBQ0EsYUFBQTtFQUNBLGNBQUE7RUFDQSxtQkFBQTtBRDNFUjtBQzhFSTtFQUNJLGtCQUFBO0FENUVSO0FDOEVRO0VBQ0ksa0JBQUE7QUQ1RVo7QUMrRVE7RUFDSSxrQkFBQTtBRDdFWjtBQytFWTtFQUNJLGNBQUE7RUFDQSw0QkFBQTtFQUNBLG1CQUFBO0VBQ0EsV0FBQTtBRDdFaEI7QUNnRlk7RUFFSSx5QkFBQTtFQUNBLFdBQUE7RUFDQSwwQkFBQTtFQUNBLG1CQUFBO0FEL0VoQjtBQ29GSTtFQUNJLHFHQUFBO0VBQ0EsMkJBQUE7RUFDQSw0QkFBQTtFQUNBLGFBQUE7QURsRlI7QUNxRkk7RUFDSSxnQkFBQTtBRG5GUiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL2NoYW5nZXBhc3N3b3JkYmFja2VuZC9jaGFuZ2VwYXNzd29yZGJhY2tlbmQuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJAY2hhcnNldCBcIlVURi04XCI7XG4jcGFzc19jaGFuZ2Uge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcbn1cbiNwYXNzX2NoYW5nZSAudHh0LWdyeSB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3Bhc3NfY2hhbmdlIC50eHQtZ3J5MyB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3Bhc3NfY2hhbmdlIC50eHQtcmVkIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jcGFzc19jaGFuZ2UgLmNvbnRlbnRfYm94IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZmY7XG59XG4jcGFzc19jaGFuZ2UgLmNvbnRlbnRfYm94IC5jYXJkIHtcbiAgYm94LXNoYWRvdzogMCAycHggMTFweCAycHggIzAwMDMsIDAgMXB4IDFweCAjMDAwMDAwMjQsIDAgMXB4IDNweCAjMDAwMDAwMWY7XG4gIHBhZGRpbmc6IDMwcHg7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgYm9yZGVyLXJhZGl1czogNXB4O1xufVxuI3Bhc3NfY2hhbmdlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbn1cbiNwYXNzX2NoYW5nZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcbiAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XG59XG4jcGFzc19jaGFuZ2UgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcbn1cbiNwYXNzX2NoYW5nZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNwYXNzX2NoYW5nZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICM2YmE1ZWM7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jcGFzc19jaGFuZ2UgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjMGM0YjlhO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI3Bhc3NfY2hhbmdlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNwYXNzX2NoYW5nZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNwYXNzX2NoYW5nZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjZGM0YzY0O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI3Bhc3NfY2hhbmdlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3Bhc3NfY2hhbmdlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI3Bhc3NfY2hhbmdlIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xuICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jcGFzc19jaGFuZ2UgLnNhdmVidG4ge1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbn1cbiNwYXNzX2NoYW5nZSAubWF0LXJhaXNlZC1idXR0b24ge1xuICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDFyZW07XG4gIGNvbG9yOiAjZmZmO1xuICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XG4gIHBhZGRpbmc6IDVweCAxMHB4O1xufVxuI3Bhc3NfY2hhbmdlIC5tYXQtZm9ybS1maWVsZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjZGM0YzY0ICFpbXBvcnRhbnQ7XG59XG4jcGFzc19jaGFuZ2UgLmNhbmNlbGJ0biB7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlOGU4ZTg7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xufVxuI3Bhc3NfY2hhbmdlIC5zdWJidG4ge1xuICBtaW4td2lkdGg6IDExMHB4O1xuICBjb2xvcjogI0ZGZjtcbiAgcGFkZGluZy1sZWZ0OiAwcHg7XG4gIHBhZGRpbmctcmlnaHQ6IDBweDtcbn1cbiNwYXNzX2NoYW5nZSAuc3ViYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMyMTQ5N2M7XG4gIGhlaWdodDogNDVweDtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMWVtO1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNwYXNzX2NoYW5nZSAucHJldmlvdXNkaXNhYmxlZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlY2VjZWMgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA0NXB4O1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAxZW07XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xufVxuI3Bhc3NfY2hhbmdlIC5wcmV2aW91c2Rpc2FibGVkIHNwYW4uYnV0dG9uLXRleHQge1xuICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDFyZW0gIWltcG9ydGFudDtcbn1cbiNwYXNzX2NoYW5nZSAucmVzZW50YnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcbiAgYm9yZGVyOiBub25lO1xuICBjb2xvcjogIzIxNDk3YztcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuI3Bhc3NfY2hhbmdlIC5wcm9jYnRuIHtcbiAgY29sb3I6ICNmZmZmZmY7XG4gIG1pbi13aWR0aDogMTEwcHg7XG59XG4jcGFzc19jaGFuZ2UgLnByb2NidG4gYnV0dG9uIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcbiAgaGVpZ2h0OiA0NXB4O1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAxZW07XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xufVxuI3Bhc3NfY2hhbmdlIC5zdWJtaXRidG5zIHtcbiAgaGVpZ2h0OiA0NnB4O1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjc7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXI6IG5vbmU7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI3Bhc3NfY2hhbmdlIC5zdWJtaXRidG5zIC5idXR0b24tdGV4dCB7XG4gIGZvbnQtc2l6ZTogMXJlbSAhaW1wb3J0YW50O1xufVxuI3Bhc3NfY2hhbmdlIC5idG5zIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4jcGFzc19jaGFuZ2UgLmRpdm91dGVyIHtcbiAgd2lkdGg6IDg5JTtcbn1cbiNwYXNzX2NoYW5nZSAuZGl2b3V0ZXIgLmZsZXhhbGlnbi5kaXZpbm5lciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBsZWZ0OiAwO1xuICBwb3NpdGlvbjogc3RpY2t5O1xuICBtYXgtd2lkdGg6IDg4JTtcbn1cbiNwYXNzX2NoYW5nZSAuZGl2b3V0ZXIgLmZsZXhhbGlnbi5kaXZpbm5lciAjcGFydGl0aW9uZWQge1xuICB0ZXh0LWFsaWduOiBsZWZ0O1xuICBwYWRkaW5nLWxlZnQ6IDE2cHg7XG4gIGxldHRlci1zcGFjaW5nOiA2MnB4O1xuICBib3JkZXI6IDA7XG4gIG1pbi13aWR0aDogMzAzcHg7XG4gIG91dGxpbmU6IG5vbmU7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgdG9wOiA1cHg7XG59XG4jcGFzc19jaGFuZ2UgLm90cGZpZWxkIHtcbiAgZGlzcGxheTogYmxvY2s7XG4gIGhlaWdodDogMTJweDtcbiAgd2lkdGg6IDI2MXB4ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtaW1hZ2U6IGxpbmVhci1ncmFkaWVudCh0byBsZWZ0LCBibGFjayA2OSUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMCkgMCUpICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtcG9zaXRpb246IGJvdHRvbTtcbiAgYmFja2dyb3VuZC1zaXplOiA3MHB4IDFweDtcbiAgYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdC14O1xuICBiYWNrZ3JvdW5kLXBvc2l0aW9uLXg6IDQ3cHg7XG59XG4jcGFzc19jaGFuZ2UgLnN1Y2Nlc3N0aWNrIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jcGFzc19jaGFuZ2UgLnN1Y2Nlc3N0aWNrIHNwYW4ge1xuICBoZWlnaHQ6IDY0cHg7XG4gIHdpZHRoOiA2NHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgYm9yZGVyLXJhZGl1czogMTAwJTtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbiAgYm9yZGVyOiAycHggc29saWQgIzE2OTk1NTtcbiAgY29sb3I6ICMxNjk5NTU7XG59XG4jcGFzc19jaGFuZ2UgLnN1Y2Nlc3N0aWNrIHNwYW4gLm1hdC1pY29uIHtcbiAgZm9udC1zaXplOiA0M3B4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNwYXNzX2NoYW5nZSBidXR0b24ge1xuICBjb2xvcjogI2ZmZjtcbn1cbiNwYXNzX2NoYW5nZSBidXR0b24gLnNwaW5uZXIge1xuICB0b3A6IGF1dG8gIWltcG9ydGFudDtcbiAgYm90dG9tOiBhdXRvICFpbXBvcnRhbnQ7XG59XG4jcGFzc19jaGFuZ2UgYnV0dG9uIC5tYXQtcHJvZ3Jlc3Mtc3Bpbm5lci5tYXQtd2FybiBjaXJjbGUsXG4jcGFzc19jaGFuZ2UgYnV0dG9uIC5tYXQtc3Bpbm5lci5tYXQtd2FybiBjaXJjbGUge1xuICBzdHJva2U6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNwYXNzX2NoYW5nZSAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1sZWZ0IHtcbiAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICBsZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgcGFkZGluZzogMTBweDtcbiAgd2lkdGg6IDkwJSAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiAxMHB4O1xuICB0b3A6IDM1JSAhaW1wb3J0YW50O1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTEwJSk7XG59XG4jcGFzc19jaGFuZ2UgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItbGVmdCAuYXJyb3c6OmJlZm9yZSxcbiNwYXNzX2NoYW5nZSAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xuICBib3JkZXItd2lkdGg6IDE1cHggMHB4IDE1cHggMTVweCAhaW1wb3J0YW50O1xuICB0b3A6IDUwJSAhaW1wb3J0YW50O1xuICBsZWZ0OiA1MCUgIWltcG9ydGFudDtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGUoLTUwJSwgLTUwJSkgIWltcG9ydGFudDtcbn1cbiNwYXNzX2NoYW5nZSAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcbiAgYm94LXNoYWRvdzogMCAwLjJyZW0gMC40cmVtIDAgcmdiYSgwLCAwLCAwLCAwLjE1KTtcbiAgYm9yZGVyOiBub25lO1xuICBwYWRkaW5nOiAwO1xuICB6LWluZGV4OiAxMDYwO1xuICBtYXgtd2lkdGg6IG5vbmU7XG4gIGJvcmRlci1yYWRpdXM6IDByZW07XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvcmVndWxhclwiO1xuICBmb250LXNpemU6IFwiMTJweFwiO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jcGFzc19jaGFuZ2UgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LnNtIHtcbiAgbWF4LXdpZHRoOiAyMHJlbTtcbiAgbWluLXdpZHRoOiAxNTBweDtcbiAgd2lkdGg6IGF1dG87XG59XG4jcGFzc19jaGFuZ2UgLnBvcG92ZXIge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG59XG4jcGFzc19jaGFuZ2UgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LnNtIHtcbiAgbWF4LXdpZHRoOiAyMHJlbTtcbiAgbWluLXdpZHRoOiAxNTBweDtcbn1cbiNwYXNzX2NoYW5nZSAucG9waG92ZXJsaXN0ZWQgLmNvbnRhaW5jb2xvciB7XG4gIGxpc3Qtc3R5bGUtdHlwZTogbm9uZTtcbiAgcGFkZGluZzogMHB4O1xufVxuI3Bhc3NfY2hhbmdlIC5wb3Bob3Zlcmxpc3RlZCAuY29udGFpbmNvbG9yIGxpIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBtYXJnaW46IDBweDtcbiAgcGFkZGluZy1sZWZ0OiAxOHB4O1xuICBtYXJnaW4tYm90dG9tOiA1cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jcGFzc19jaGFuZ2UgLnBvcGhvdmVybGlzdGVkIC51bm1hdGNoZWQ6OmJlZm9yZSB7XG4gIGZvbnQtZmFtaWx5OiBGb250QXdlc29tZTtcbiAgY29udGVudDogXCLvhIxcIjtcbiAgY29sb3I6IHJlZCAhaW1wb3J0YW50O1xufVxuI3Bhc3NfY2hhbmdlIC5wb3Bob3Zlcmxpc3RlZCBsaTo6YmVmb3JlIHtcbiAgZm9udC1mYW1pbHk6IEZvbnRBd2Vzb21lO1xuICBjb250ZW50OiBcIu+EjFwiO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIGxlZnQ6IDBweDtcbiAgZGlzcGxheTogZmxleDtcbiAgY29sb3I6ICM2NjY2NjY7XG4gIGZvbnQtc2l6ZTogMC42MjVyZW07XG59XG4jcGFzc19jaGFuZ2UgLmNvbnRhaW5jb2xvciB7XG4gIGxpc3Qtc3R5bGUtdHlwZTogbm9uZTtcbiAgcGFkZGluZzogMHB4O1xufVxuI3Bhc3NfY2hhbmdlIC5jb250YWluY29sb3IgbGkge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIG1hcmdpbjogMHB4O1xuICBwYWRkaW5nLWxlZnQ6IDE4cHg7XG4gIG1hcmdpbi1ib3R0b206IDVweDtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNwYXNzX2NoYW5nZSAubWF0Y2hlZDo6YmVmb3JlIHtcbiAgZm9udC1mYW1pbHk6IEZvbnRBd2Vzb21lO1xuICBjb250ZW50OiBcIu+EjFwiO1xuICBjb2xvcjogIzc4YzMyMCAhaW1wb3J0YW50O1xufVxuI3Bhc3NfY2hhbmdlIC51bm1hdGNoZWQ6OmJlZm9yZSB7XG4gIGZvbnQtZmFtaWx5OiBGb250QXdlc29tZTtcbiAgY29udGVudDogXCLvhIxcIjtcbiAgY29sb3I6IHJlZCAhaW1wb3J0YW50O1xufVxuI3Bhc3NfY2hhbmdlIGxpOjpiZWZvcmUge1xuICBmb250LWZhbWlseTogRm9udEF3ZXNvbWU7XG4gIGNvbnRlbnQ6IFwi74SMXCI7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgbGVmdDogMHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBjb2xvcjogIzY2NjY2NjtcbiAgZm9udC1zaXplOiAwLjYyNXJlbTtcbn1cbiNwYXNzX2NoYW5nZSAuc3BhY2VzdXBvcnQge1xuICBwYWRkaW5nLWxlZnQ6IDYwcHg7XG59XG4jcGFzc19jaGFuZ2UgLnNwYWNlc3Vwb3J0IC50ZXh0YWxpZ24ge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG59XG4jcGFzc19jaGFuZ2UgLnNwYWNlc3Vwb3J0IC5wYXNzd29yZGhlYWRjb2xvciB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbiNwYXNzX2NoYW5nZSAuc3BhY2VzdXBvcnQgLnBhc3N3b3JkaGVhZGNvbG9yIGgyLCAjcGFzc19jaGFuZ2UgLnNwYWNlc3Vwb3J0IC5wYXNzd29yZGhlYWRjb2xvciBwIHtcbiAgY29sb3I6ICMzMzMzMzM7XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvc2VtaWJvbGRcIjtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgbWFyZ2luOiAwcHg7XG59XG4jcGFzc19jaGFuZ2UgLnNwYWNlc3Vwb3J0IC5wYXNzd29yZGhlYWRjb2xvciBwIHtcbiAgY29sb3I6ICM2NjY2NjYgIWltcG9ydGFudDtcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWJvdHRvbTogNXB4O1xufVxuI3Bhc3NfY2hhbmdlIC5iYW5uZXIge1xuICBiYWNrZ3JvdW5kLWltYWdlOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvb3BhbGltYWdlcy9iYWNrYmFubmVyLnN2Z1wiKTtcbiAgYmFja2dyb3VuZC1wb3NpdGlvbjogY2VudGVyO1xuICBiYWNrZ3JvdW5kLXJlcGVhdDogbm8tcmVwZWF0O1xuICBoZWlnaHQ6IDU1NXB4O1xufVxuI3Bhc3NfY2hhbmdlIC5sb2dpbl9mb290ZXIge1xuICBtYXJnaW4tdG9wOiAtMTElO1xufSIsIiNwYXNzX2NoYW5nZSB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcclxuXHJcbiAgICAudHh0LWdyeSB7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICB9XHJcblxyXG4gICAgLnR4dC1ncnkzIHtcclxuICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgIH1cclxuXHJcbiAgICAudHh0LXJlZCB7XHJcbiAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbnRlbnRfYm94IHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcclxuXHJcbiAgICAgICAgLmNhcmQge1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiAwIDJweCAxMXB4IDJweCAjMDAwMywgMCAxcHggMXB4ICMwMDAwMDAyNCwgMCAxcHggM3B4ICMwMDAwMDAxZjtcclxuICAgICAgICAgICAgcGFkZGluZzogMzBweDtcclxuICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiA1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuXHJcbiAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLS45cmVtKSBzY2FsZSgwLjc1KTtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuc2F2ZWJ0biB7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LXJhaXNlZC1idXR0b24ge1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICBmb250LXNpemU6IDFyZW07XHJcbiAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG4gICAgICAgIHBhZGRpbmc6IDVweCAxMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNhbmNlbGJ0biB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMTBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZThlOGU4O1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgIH1cclxuXHJcbiAgICAuc3ViYnRuIHtcclxuICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICAgIGNvbG9yOiAjRkZmO1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuXHJcbiAgICAgICAgYnV0dG9uIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzIxNDk3YztcclxuICAgICAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxZW07XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5wcmV2aW91c2Rpc2FibGVkIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWNlY2VjICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMWVtO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xyXG4gICAgICAgIHNwYW4uYnV0dG9uLXRleHQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDFyZW0gIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAucmVzZW50YnRuIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlcjogbm9uZTtcclxuICAgICAgICBjb2xvcjogIzIxNDk3YztcclxuICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICB9XHJcblxyXG4gICAgLnByb2NidG4ge1xyXG5cclxuICAgICAgICBjb2xvcjogI2ZmZmZmZjtcclxuICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG5cclxuICAgICAgICBidXR0b24ge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDFlbTtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnN1Ym1pdGJ0bnMge1xyXG4gICAgICAgIGhlaWdodDogNDZweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNztcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIC5idXR0b24tdGV4dCB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMXJlbSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYnRucyB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgfVxyXG4gICAgLmRpdm91dGVyIHtcclxuICAgICAgICB3aWR0aDogODklO1xyXG5cclxuICAgICAgICAuZmxleGFsaWduLmRpdmlubmVyIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGxlZnQ6IDA7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiBzdGlja3k7XHJcbiAgICAgICAgICAgIG1heC13aWR0aDogODglO1xyXG5cclxuICAgICAgICAgICAgI3BhcnRpdGlvbmVkIHtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDE2cHg7XHJcbiAgICAgICAgICAgICAgICBsZXR0ZXItc3BhY2luZzogNjJweDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMDtcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMzAzcHg7XHJcbiAgICAgICAgICAgICAgICBvdXRsaW5lOiBub25lO1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgdG9wOiA1cHg7XHJcbiAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLm90cGZpZWxkIHtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBoZWlnaHQ6IDEycHg7XHJcbiAgICAgICAgd2lkdGg6IDI2MXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1pbWFnZTogbGluZWFyLWdyYWRpZW50KHRvIGxlZnQsIGJsYWNrIDY5JSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwKSAwJSkgIWltcG9ydGFudDtcclxuICAgICAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiBib3R0b207XHJcbiAgICAgICAgYmFja2dyb3VuZC1zaXplOiA3MHB4IDFweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLXJlcGVhdDogcmVwZWF0LXg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbi14OiA0N3B4O1xyXG4gICAgfVxyXG5cclxuICAgIC5zdWNjZXNzdGljayB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgaGVpZ2h0OiA2NHB4O1xyXG4gICAgICAgICAgICB3aWR0aDogNjRweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDEwMCU7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMnB4IHNvbGlkICMxNjk5NTU7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMTY5OTU1O1xyXG5cclxuICAgICAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogNDNweDtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgYnV0dG9uIHtcclxuICAgICAgICAuc3Bpbm5lciB7XHJcbiAgICAgICAgICAgIHRvcDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBib3R0b206IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcHJvZ3Jlc3Mtc3Bpbm5lci5tYXQtd2FybiBjaXJjbGUsXHJcbiAgICAgICAgLm1hdC1zcGlubmVyLm1hdC13YXJuIGNpcmNsZSB7XHJcbiAgICAgICAgICAgIHN0cm9rZTogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLy8gYmFja2dyb3VuZDogI0VEMUMyNztcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgIH1cclxuXHJcblxyXG5cclxuICAgIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWxlZnQge1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICBsZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nOiAxMHB4O1xyXG4gICAgICAgIHdpZHRoOiA5MCUgIWltcG9ydGFudDtcclxuICAgICAgICBtYXJnaW4tdG9wOiAxMHB4O1xyXG4gICAgICAgIHRvcDogMzUlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0xMCUpO1xyXG4gICAgfVxyXG5cclxuICAgIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWxlZnQgLmFycm93OjpiZWZvcmUsXHJcbiAgICAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xyXG4gICAgICAgIGJvcmRlci13aWR0aDogMTVweCAwcHggMTVweCAxNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgdG9wOiA1MCUgIWltcG9ydGFudDtcclxuICAgICAgICBsZWZ0OiA1MCUgIWltcG9ydGFudDtcclxuICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZSgtNTAlLCAtNTAlKSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5wb3BvdmVyLnBvcG92ZXItY29udGVudCB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZmY7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMCAwLjJyZW0gMC40cmVtIDAgcmdiKDAgMCAwIC8gMTUlKTtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcbiAgICAgICAgcGFkZGluZzogMDtcclxuICAgICAgICB6LWluZGV4OiAxMDYwO1xyXG4gICAgICAgIG1heC13aWR0aDogbm9uZTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAwcmVtO1xyXG4gICAgICAgIGZvbnQtZmFtaWx5OiBcImNhaXJvcmVndWxhclwiO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogXCIxMnB4XCI7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5zbSB7XHJcbiAgICAgICAgbWF4LXdpZHRoOiAyMHJlbTtcclxuICAgICAgICBtaW4td2lkdGg6IDE1MHB4O1xyXG4gICAgICAgIHdpZHRoOiBhdXRvO1xyXG4gICAgfVxyXG5cclxuICAgIC5wb3BvdmVyIHtcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICB9XHJcblxyXG4gICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LnNtIHtcclxuICAgICAgICBtYXgtd2lkdGg6IDIwcmVtO1xyXG4gICAgICAgIG1pbi13aWR0aDogMTUwcHg7XHJcblxyXG4gICAgfVxyXG5cclxuXHJcbiAgICAucG9waG92ZXJsaXN0ZWQgLmNvbnRhaW5jb2xvciB7XHJcbiAgICAgICAgbGlzdC1zdHlsZS10eXBlOiBub25lO1xyXG4gICAgICAgIHBhZGRpbmc6IDBweDtcclxuICAgIH1cclxuXHJcbiAgICAucG9waG92ZXJsaXN0ZWQgLmNvbnRhaW5jb2xvciBsaSB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAxOHB4O1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDVweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICB9XHJcblxyXG4gICAgLnBvcGhvdmVybGlzdGVkIC51bm1hdGNoZWQ6OmJlZm9yZSB7XHJcbiAgICAgICAgZm9udC1mYW1pbHk6IEZvbnRBd2Vzb21lO1xyXG4gICAgICAgIGNvbnRlbnQ6IFwi74SMXCI7XHJcbiAgICAgICAgY29sb3I6IHJlZCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5wb3Bob3Zlcmxpc3RlZCBsaTo6YmVmb3JlIHtcclxuICAgICAgICBmb250LWZhbWlseTogRm9udEF3ZXNvbWU7XHJcbiAgICAgICAgY29udGVudDogXCLvhIxcIjtcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgbGVmdDogMHB4O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgY29sb3I6ICM2NjY2NjY7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjYyNXJlbTtcclxuICAgIH1cclxuXHJcbiAgICAuY29udGFpbmNvbG9yIHtcclxuICAgICAgICBsaXN0LXN0eWxlLXR5cGU6IG5vbmU7XHJcbiAgICAgICAgcGFkZGluZzogMHB4O1xyXG5cclxuICAgICAgICBsaSB7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMThweDtcclxuICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogNXB4O1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0Y2hlZDo6YmVmb3JlIHtcclxuICAgICAgICBmb250LWZhbWlseTogRm9udEF3ZXNvbWU7XHJcbiAgICAgICAgY29udGVudDogXCJcXGYxMGNcIjtcclxuICAgICAgICBjb2xvcjogIzc4YzMyMCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC51bm1hdGNoZWQ6OmJlZm9yZSB7XHJcbiAgICAgICAgZm9udC1mYW1pbHk6IEZvbnRBd2Vzb21lO1xyXG4gICAgICAgIGNvbnRlbnQ6IFwiXFxmMTBjXCI7XHJcbiAgICAgICAgY29sb3I6IHJlZCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIGxpOjpiZWZvcmUge1xyXG4gICAgICAgIGZvbnQtZmFtaWx5OiBGb250QXdlc29tZTtcclxuICAgICAgICBjb250ZW50OiBcIlxcZjEwY1wiO1xyXG4gICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICBsZWZ0OiAwcHg7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBjb2xvcjogIzY2NjY2NjtcclxuICAgICAgICBmb250LXNpemU6IDAuNjI1cmVtO1xyXG4gICAgfVxyXG5cclxuICAgIC5zcGFjZXN1cG9ydCB7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiA2MHB4O1xyXG5cclxuICAgICAgICAudGV4dGFsaWduIHtcclxuICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnBhc3N3b3JkaGVhZGNvbG9yIHtcclxuICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG5cclxuICAgICAgICAgICAgaDIge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIEBleHRlbmQgaDI7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzY2NjY2NiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctYm90dG9tOiA1cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmJhbm5lciB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1pbWFnZTogdXJsKFwifi9hc3NldHMvaW1hZ2VzL29wYWxpbWFnZXMvYmFja2Jhbm5lci5zdmdcIik7XHJcbiAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbjogY2VudGVyO1xyXG4gICAgICAgIGJhY2tncm91bmQtcmVwZWF0OiBuby1yZXBlYXQ7XHJcbiAgICAgICAgaGVpZ2h0OiA1NTVweDtcclxuICAgIH1cclxuXHJcbiAgICAubG9naW5fZm9vdGVyIHtcclxuICAgICAgICBtYXJnaW4tdG9wOiAtMTElO1xyXG4gICAgfVxyXG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.ts":
  /*!**************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.ts ***!
    \**************************************************************************************************/

  /*! exports provided: ChangepasswordbackendComponent */

  /***/
  function srcAppModulesAccountsettingsChangepasswordbackendChangepasswordbackendComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ChangepasswordbackendComponent", function () {
      return ChangepasswordbackendComponent;
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


    var _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/snack-bar */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/snack-bar.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/auth/admin.service */
    "./src/app/auth/admin.service.ts");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_directives_must_match_validator__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/common/directives/must-match.validator */
    "./src/app/common/directives/must-match.validator.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/modules/profilemanagement/profile.service */
    "./src/app/modules/profilemanagement/profile.service.ts");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_13__);
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");

    var ChangepasswordbackendComponent = /*#__PURE__*/function () {
      function ChangepasswordbackendComponent(formBuilder, translate, remoteService, profileService, router, snackBar, localstorage, adminservice, security, cookieService, toastr) {
        _classCallCheck(this, ChangepasswordbackendComponent);

        this.formBuilder = formBuilder;
        this.translate = translate;
        this.remoteService = remoteService;
        this.profileService = profileService;
        this.router = router;
        this.snackBar = snackBar;
        this.localstorage = localstorage;
        this.adminservice = adminservice;
        this.security = security;
        this.cookieService = cookieService;
        this.toastr = toastr;
        this.changePasswordTemplate = 'PassForm';
        this.FormTemplate = 'currentpass';
        this.disableResend = false;
        this.isnumber = false;
        this.issmallcase = false;
        this.isuppercase = false;
        this.issymbol = false;
        this.showPwdCtrl = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]();
        this.validationCount = 0;
        this.spinnerButtonOptionssaveupdate = {
          active: false,
          spinnerSize: 25,
          type: 'button',
          text: 'Send OTP',
          raised: false,
          stroked: false,
          buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate'
        };
        this.spinnerButtonOptionsproceed = {
          active: false,
          spinnerSize: 25,
          text: 'Proceed',
          type: 'button',
          raised: false,
          stroked: false,
          buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate'
        };
        this.spinnerButtonOptions = {
          active: false,
          spinnerSize: 25,
          text: 'Save and Update',
          type: 'button',
          raised: false,
          stroked: false,
          buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate'
        };
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
        this.dir = "ltr";
      }

      _createClass(ChangepasswordbackendComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this10 = this;

          if (localStorage.getItem('v3logindata') == null) {
            this.router.navigate(['/admin/login']);
          }

          this.encryptedUserPk = this.security.encrypt(this.localstorage.getInLocal('opalusermst_pk'));
          this.stktype = this.localstorage.getInLocal('omrm_stkholdertypmst_fk');

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this10.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;

            if (toSelect.languagecode == 'en') {
              this.spinnerButtonOptionssaveupdate.text = 'Send OTP';
              this.spinnerButtonOptionsproceed.text = 'Proceed';
              this.spinnerButtonOptions.text = 'Save and Update';
            } else {
              this.spinnerButtonOptionssaveupdate.text = 'Send OTP';
              this.spinnerButtonOptionsproceed.text = 'Proceed';
              this.spinnerButtonOptions.text = 'Save and Update';
            }
          } else {
            var _toSelect3 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect3.languagecode);
            this.dir = _toSelect3.dir;
            this.spinnerButtonOptionssaveupdate.text = 'Send OTP';
            this.spinnerButtonOptionsproceed.text = 'Proceed';
            this.spinnerButtonOptions.text = 'Save and Update';
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this10.translate.setDefaultLang(_this10.cookieService.get('languageCode'));

            if (_this10.cookieService.get('languageCookieId') && _this10.cookieService.get('languageCookieId') != undefined && _this10.cookieService.get('languageCookieId') != null) {
              var _toSelect4 = _this10.languagelist.find(function (c) {
                return c.id === _this10.cookieService.get('languageCookieId');
              });

              _this10.translate.setDefaultLang(_toSelect4.languagecode);

              _this10.dir = _toSelect4.dir;

              if (_toSelect4.languagecode == 'en') {
                _this10.spinnerButtonOptionssaveupdate.text = 'Send OTP';
                _this10.spinnerButtonOptionsproceed.text = 'Proceed';
                _this10.spinnerButtonOptions.text = 'Save and Update';
              } else {
                _this10.spinnerButtonOptionssaveupdate.text = 'Send OTP';
                _this10.spinnerButtonOptionsproceed.text = 'Proceed';
                _this10.spinnerButtonOptions.text = 'Save and Update';
              }
            } else {
              var _toSelect5 = _this10.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this10.translate.setDefaultLang(_toSelect5.languagecode);

              _this10.dir = _toSelect5.dir;
              _this10.spinnerButtonOptionssaveupdate.text = 'Send OTP';
              _this10.spinnerButtonOptionsproceed.text = 'Proceed';
              _this10.spinnerButtonOptions.text = 'Save and Update';
            }
          });
          this.createForm();
        }
      }, {
        key: "createForm",
        value: function createForm() {
          this.changePasswordForm = this.formBuilder.group({
            currentpassword: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(8)]],
            verifyotp: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(4)]],
            newpassword: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(8), this.validateInput.bind(this)]],
            confirmnewpassword: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(8)]]
          }, {
            validator: Object(_app_common_directives_must_match_validator__WEBPACK_IMPORTED_MODULE_7__["MustMatch"])('newpassword', 'confirmnewpassword')
          });
        }
      }, {
        key: "validateInput",
        value: function validateInput(c) {
          if (!c.value) {
            this.validationCount = 0;
            return {};
          } else {
            var numbers = new RegExp(".*[0-9].*");
            var alphabets = new RegExp(".*[A-Z].*");
            var smallalphabets = new RegExp(".*[a-z].*");
            var symbols = new RegExp(".*[@'!#$%&':*+/=?^_`{|},<>;\")\\\\[\\](~.-\\s+].*");
            var validationArr = [smallalphabets.test(c.value), numbers.test(c.value), alphabets.test(c.value), symbols.test(c.value)];
            this.isnumber = numbers.test(c.value);
            this.issmallcase = smallalphabets.test(c.value);
            this.isuppercase = alphabets.test(c.value);
            this.issymbol = symbols.test(c.value);
            this.validationCount = validationArr.filter(function (isValid) {
              return isValid === true;
            }).length;
            return {};
          }
        }
      }, {
        key: "SendOTP",
        value: function SendOTP() {
          var _this11 = this;

          if (this.changePasswordForm.controls.currentpassword.valid) {
            this.spinnerButtonOptionssaveupdate.active = true;
            this.disableResend = true;
            this.encryptPassword = this.security.aesencrypt(this.changePasswordForm.controls.currentpassword.value);
            this.adminservice.sendOTP(this.encryptedUserPk, this.encryptPassword, 'email').subscribe(function (data) {
              console.log(data);
              _this11.disableSubmitButton = false;
              _this11.spinnerButtonOptionssaveupdate.active = false;

              _this11.timer(15, data.data.expiry);

              if (data['data'].status == 1) {
                _this11.toastr.success(_this11.i18n('changepassword.otpsendtoyou'), '', {
                  timeOut: 2000,
                  closeButton: false
                });

                _this11.FormTemplate = 'otpscreen';

                _this11.changePasswordForm.controls['verifyotp'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);

                _this11.changePasswordForm.controls['verifyotp'].updateValueAndValidity();
              } else if (data['data'].status == 4) {
                // this.disableUpdateButton = false;
                _this11.changePasswordForm.controls['currentpassword'].setErrors({
                  invalidPassword: true
                });
              } else if (data['data'].status == 2) {// this.disableUpdateButton = false;
                // this.changePasswordForm.controls['confirmnewpassword'].setErrors({usernameSame: true});
              } else if (data['data'].status == 3) {
                // this.disableUpdateButton = false;
                _this11.changePasswordForm.controls['confirmnewpassword'].setErrors({
                  oldPassword: true
                });
              }
            });
          }
        }
      }, {
        key: "timer",
        value: function timer(minutes, time) {
          var _this12 = this;

          this.timersec = setInterval(function () {
            var date1 = new Date(time);
            var date2 = new Date();

            if (date1.getTime() >= date2.getTime()) {
              var Days = date1.getTime() - date2.getTime();
              var minute = Days / (1000 * 60);
              var seconds = minute * 60;
              var textSec = "0";
              var statSec = 60;
              var prefix = minute < 10 ? "0" : "";
              seconds--;
              if (statSec != 0) statSec--;else statSec = 59;
              var prefixsec = Math.floor(seconds % 60) < 10 ? "0" : "";
              _this12.countDown = "".concat(prefix).concat(Math.floor(seconds / 60), ":").concat(prefixsec).concat(Math.floor(seconds % 60));

              if (seconds <= 0 || date1.getTime() <= date2.getTime() || !_this12.timersec) {
                _this12.disableResend = false;
                _this12.countDown = "00:00";
                clearInterval(_this12.timersec);
                _this12.timersec = null;
              }
            } else {
              _this12.disableResend = false;
              _this12.countDown = "00:00";
              console.log('time cleared' + date2);
              clearInterval(_this12.timersec);
            }
          }, 1000);
        }
      }, {
        key: "resendOtp",
        value: function resendOtp() {
          this.disableSubmitButton = true;
          this.SendOTP();
        }
      }, {
        key: "VerifyOTP",
        value: function VerifyOTP() {
          var _this13 = this;

          if (this.changePasswordForm.controls.verifyotp.valid) {
            this.spinnerButtonOptionsproceed.active = true;
            var otp = this.changePasswordForm.controls.verifyotp.value;
            this.adminservice.verifyOTP(this.encryptedUserPk, otp, 'email').subscribe(function (data) {
              console.log(data);
              _this13.disableSendOTPButton = false;
              _this13.spinnerButtonOptionsproceed.active = false;

              if (data['data'].status == 1) {
                clearInterval(_this13.timersec);
                _this13.disableResend = false;

                _this13.toastr.success(_this13.i18n('changepassword.otpverisucc'), '', {
                  timeOut: 2000,
                  closeButton: false
                });

                _this13.FormTemplate = 'newpasswords';
              } else if (data['data'].status == 2) {
                _this13.changePasswordForm.controls['verifyotp'].reset();

                _this13.changePasswordForm.controls['verifyotp'].setErrors({
                  invalidOTP: true
                });
              } else if (data['data'].status == 3) {
                _this13.changePasswordForm.controls['verifyotp'].reset();

                _this13.changePasswordForm.controls['verifyotp'].setErrors({
                  ExpiredOTP: true
                });
              }
            });
          }
        }
      }, {
        key: "saveNewPasswords",
        value: function saveNewPasswords() {
          var _this14 = this;

          if (this.changePasswordForm.valid) {
            this.spinnerButtonOptions.active = true;
            var newencpass = this.security.aesencrypt(this.changePasswordForm.controls.newpassword.value);
            this.adminservice.resetPassword(this.encryptedUserPk, newencpass, 'email').subscribe(function (data) {
              if (data.data.status == 1) {
                _this14.disableResend = false;
                clearInterval(_this14.timersec);
                _this14.FormTemplate = 'sucesspage';

                _this14.profileService.logout().subscribe(function (d) {
                  return _this14.router.navigate(['admin/login']);
                }); // this.router.navigate(['accountsettings/home']);

              } else if (data['data'].status == 2) {
                // this.disableResend = false;
                _this14.changePasswordForm.controls['newpassword'].setErrors({
                  username: true
                });
              } else if (data['data'].status == 3) {
                // this.disableResend = false;
                _this14.changePasswordForm.controls['newpassword'].setErrors({
                  lastpass: true
                });
              }

              _this14.spinnerButtonOptions.active = false;
            });
          }
        }
      }, {
        key: "resetAll",
        value: function resetAll() {
          clearInterval(this.timersec);
          this.disableResend = false;
          this.changePasswordTemplate = 'PassForm';
          this.FormTemplate = 'currentpass';
          this.changePasswordForm.reset();
        }
      }, {
        key: "backtoaccount",
        value: function backtoaccount() {
          var _this15 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
            title: this.i18n('changepassword.doyouwantcanc'),
            text: this.i18n('changepassword.ifyesanyunsave'),
            icon: 'warning',
            buttons: [this.i18n('changepassword.no'), this.i18n('changepassword.yes')]
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this15.resetAll();

              if (_this15.stktype == '1') {
                _this15.router.navigate(['dashboard/supplier']);
              } else {
                _this15.router.navigate(['accountsettings/home']);
              }
            }
          });
        }
      }, {
        key: "newpassword",
        get: function get() {
          return this.changePasswordForm.controls['newpassword'].value;
        }
      }, {
        key: "passwordFieldCtrl",
        get: function get() {
          return this.changePasswordForm.controls['newpassword'];
        }
      }]);

      return ChangepasswordbackendComponent;
    }();

    ChangepasswordbackendComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_10__["RemoteService"]
      }, {
        type: _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_9__["ProfileService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]
      }, {
        type: _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_3__["MatSnackBar"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_8__["AppLocalStorageServices"]
      }, {
        type: _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_5__["AdminService"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_6__["Encrypt"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_12__["CookieService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_14__["ToastrService"]
      }];
    };

    ChangepasswordbackendComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-changepasswordbackend',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./changepasswordbackend.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./changepasswordbackend.component.scss */
      "./src/app/modules/accountsettings/changepasswordbackend/changepasswordbackend.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_10__["RemoteService"], _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_9__["ProfileService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"], _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_3__["MatSnackBar"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_8__["AppLocalStorageServices"], _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_5__["AdminService"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_6__["Encrypt"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_12__["CookieService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_14__["ToastrService"]])], ChangepasswordbackendComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.scss":
  /*!**************************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.scss ***!
    \**************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsChangesubscriptionlistviewChangesubscriptionlistviewComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL2NoYW5nZXN1YnNjcmlwdGlvbmxpc3R2aWV3L2NoYW5nZXN1YnNjcmlwdGlvbmxpc3R2aWV3LmNvbXBvbmVudC5zY3NzIn0= */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.ts":
  /*!************************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.ts ***!
    \************************************************************************************************************/

  /*! exports provided: ChangesubscriptionlistviewComponent */

  /***/
  function srcAppModulesAccountsettingsChangesubscriptionlistviewChangesubscriptionlistviewComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ChangesubscriptionlistviewComponent", function () {
      return ChangesubscriptionlistviewComponent;
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


    var sweetalert__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_2__);
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");

    var ChangesubscriptionlistviewComponent = /*#__PURE__*/function () {
      function ChangesubscriptionlistviewComponent(toastr) {
        _classCallCheck(this, ChangesubscriptionlistviewComponent);

        this.toastr = toastr;
        this.buttonname = 'Update';
        this.animationState1 = 'out';
      }

      _createClass(ChangesubscriptionlistviewComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {}
      }, {
        key: "changesubscriptionlist",
        value: function changesubscriptionlist(divName) {
          if (divName === 'changesubscriptionlisted') {
            this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
          }
        }
      }, {
        key: "changesubscriptionAlert",
        value: function changesubscriptionAlert() {
          var _this16 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_2___default()({
            title: "Do you want to cancel creating this Change Subscription",
            text: 'Are you sure you want to cancel? If yes all the data will be lost',
            icon: 'warning',
            closeOnClickOutside: false,
            closeOnEsc: false,
            buttons: ['Cancel', 'Ok'],
            dangerMode: true
          }).then(function (willDelete) {
            if (willDelete) {
              _this16.changesubscriptiondrawer.toggle();

              _this16.showSuccess();
            }
          });
          this.animationState1 = 'out';
        }
      }, {
        key: "showSuccess",
        value: function showSuccess() {
          this.toastr.success('everything is broken', 'Success !', {
            timeOut: 3000,
            closeButton: true
          });
        }
      }]);

      return ChangesubscriptionlistviewComponent;
    }();

    ChangesubscriptionlistviewComponent.ctorParameters = function () {
      return [{
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_4__["ToastrService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('changesubscriptiondrawer'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_3__["MatDrawer"])], ChangesubscriptionlistviewComponent.prototype, "changesubscriptiondrawer", void 0);
    ChangesubscriptionlistviewComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-changesubscriptionlistview',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./changesubscriptionlistview.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./changesubscriptionlistview.component.scss */
      "./src/app/modules/accountsettings/changesubscriptionlistview/changesubscriptionlistview.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [ngx_toastr__WEBPACK_IMPORTED_MODULE_4__["ToastrService"]])], ChangesubscriptionlistviewComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.scss":
  /*!**************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.scss ***!
    \**************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsEmailpreferenceslistEmailpreferenceslistComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".mainheader {\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 83.33%;\n  background: #fff;\n}\n.mainheader .emailalign {\n  display: flex;\n}\n.mainheader .flexaudittrail {\n  display: flex;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n.mainheader .flexendaudit {\n  display: flex;\n  justify-content: flex-end !important;\n  align-items: center !important;\n}\n.mainheader .lineheight {\n  line-height: 1;\n}\n.mainheader #emailprefaccordio .offcolor {\n  color: #333;\n}\n.mainheader #emailprefaccordio .searchfiltercompany {\n  display: flex;\n  align-items: end;\n  justify-content: end;\n  width: 100%;\n  margin: 0 auto;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .searchhere {\n  position: relative;\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n  width: 70%;\n  background: #fff;\n  border-radius: 2px;\n  padding-left: 10px !important;\n  padding: 2px 5px;\n  border: 1px solid #d0d1dc;\n}\n@media screen and (max-width: 599px) {\n  .mainheader #emailprefaccordio .searchfiltercompany .searchhere {\n    flex-direction: column;\n    width: 100%;\n  }\n}\n.mainheader #emailprefaccordio .searchfiltercompany .searchhere .mat-icon {\n  height: 35px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  cursor: pointer;\n  color: #999;\n  font-size: 20px !important;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .searchhere input[type=text] {\n  border: 0;\n  height: 50px;\n  width: 85%;\n  padding-left: 5px;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .searchhere .mat-form-field:first-child {\n  margin-right: 15px;\n  padding-right: 10px;\n}\n@media screen and (max-width: 599px) {\n  .mainheader #emailprefaccordio .searchfiltercompany .searchhere .mat-form-field:first-child {\n    margin: 0px;\n    padding: 0px;\n    padding-bottom: 10px;\n    border-bottom: 1px solid #d0d1dc;\n  }\n}\n.mainheader #emailprefaccordio .searchfiltercompany .filterbutton {\n  min-width: 100px;\n  height: 45px !important;\n  color: #fff !important;\n  border: 0;\n  border-radius: 2px;\n  background-clip: padding-box;\n  margin-left: 12px;\n  font-size: 0.9375rem;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .mat-form-field-appearance-legacy .mat-form-field-underline {\n  display: none;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .mat-form-field-appearance-legacy .mat-form-field-ripple {\n  display: none;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .mat-form-field-flex {\n  align-items: center;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .mat-form-field-appearance-legacy .mat-form-field-wrapper {\n  padding-bottom: 0;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .mat-form-field.mat-focused .mat-form-field-label {\n  color: #006cb7;\n  opacity: 0;\n}\n.mainheader #emailprefaccordio .searchfiltercompany .mat-form-field-infix {\n  border-top: 0;\n}\n.mainheader #emailprefaccordio .mat-expansion-panel-body {\n  border: none !important;\n  padding: 0px;\n}\n.mainheader #emailprefaccordio .mat-slide-toggle.mat-checked:not(.mat-disabled) .mat-slide-toggle-bar {\n  background-color: #9bd35b !important;\n}\n.mainheader #emailprefaccordio .togglemode_switch {\n  display: flex;\n  justify-content: flex-end !important;\n  align-items: center !important;\n}\n.mainheader #emailprefaccordio .togglemode_switch .oncolor {\n  color: #9ad15a;\n  font-size: 0.9375rem;\n}\n.mainheader #emailprefaccordio .mat-slide-toggle.mat-checked:not(.mat-disabled) .mat-slide-toggle-thumb {\n  border: 2px solid #9bd35b !important;\n  background: #fff;\n}\n.mainheader #emailprefaccordio .mat-expanded .mat-expansion-panel-header {\n  background-color: #006cb7 !important;\n}\n.mainheader #emailprefaccordio .mat-expanded .mat-expansion-panel {\n  margin-top: 0px !important;\n}\n.mainheader #emailprefaccordio .mat-expanded .titlepfcompayname P {\n  color: #fff !important;\n}\n.mainheader #emailprefaccordio mat-expansion-panel.mat-expanded {\n  box-shadow: none !important;\n  margin-top: 20px;\n}\n.mainheader #emailprefaccordio .mat-expansion-panel {\n  border-radius: 2px !important;\n}\n.mainheader #emailprefaccordio .mat-expanded .mat-expansion-indicator::after {\n  color: #fff !important;\n}\n.mainheader #emailprefaccordio .mat-expansion-panel-header {\n  background-color: #fff !important;\n  margin-bottom: 0 !important;\n  height: 50px !important;\n  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);\n}\n.mainheader #emailprefaccordio .accordionlistemail .profilecolor {\n  padding-bottom: 15px;\n  padding-top: 15px;\n  padding-left: 24px;\n}\n.mainheader #emailprefaccordio .accordionlistemail .profilecolor P {\n  color: #f4811f;\n  margin: 0px;\n}\n.mainheader #emailprefaccordio .accordionlistemail .externalbox {\n  padding: 20px;\n  border: 1px solid #dde4e9;\n  background-clip: padding-box;\n  background-color: #fff;\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);\n}\n.mainheader #emailprefaccordio .accordionlistemail .externalbox .subtitle_secondrow p {\n  color: #666;\n  margin: 0px;\n}\n.mainheader .infocmprating {\n  color: #333333;\n  font-size: 0.9375rem;\n}\n.mainheader .labelcmpafter {\n  color: #999999;\n  font-size: 0.875rem;\n}\n.mainheader .alignendsave {\n  display: flex;\n  justify-content: flex-end;\n}\n.mainheader .savebtn {\n  width: 102px;\n  height: 42px;\n  background-color: #006cb7;\n  color: #fff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n.mainheader .securitytitle p {\n  color: #006cb7;\n}\n.mainheader .alignsecurity {\n  display: flex;\n  align-items: center;\n}\n@media (max-width: 766px) and (min-width: 318px) {\n  .alignendsave {\n    display: block;\n    justify-content: center;\n    margin-left: 12px;\n  }\n\n  .mainheader {\n    margin-left: auto;\n    margin-right: auto;\n    max-width: 90% !important;\n    background: #fff;\n    padding: 30px 0px 30px 0px !important;\n  }\n}\n@media (max-width: 414px) and (min-width: 412px) {\n  .alignendsave {\n    display: flex;\n    justify-content: flex-start !important;\n    margin-left: 12px !important;\n    margin-right: 0px !important;\n  }\n}\n@media (max-width: 768px) {\n  .sidenavindexclass .auditview {\n    width: 75% !important;\n  }\n}\n@media (max-width: 767px) {\n  .sidenavindexclass .auditview {\n    width: 100% !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvZW1haWxwcmVmZXJlbmNlc2xpc3QvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcYWNjb3VudHNldHRpbmdzXFxlbWFpbHByZWZlcmVuY2VzbGlzdFxcZW1haWxwcmVmZXJlbmNlc2xpc3QuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL2VtYWlscHJlZmVyZW5jZXNsaXN0L2VtYWlscHJlZmVyZW5jZXNsaXN0LmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQXFCQTtFQUNLLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxpQkFBQTtFQUNBLGdCQUFBO0FDcEJMO0FEcUJJO0VBQ0ksYUFBQTtBQ25CUjtBRHFCSTtFQXZCQSxhQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtBQ0tKO0FEbUJJO0VBckJBLGFBQUE7RUFDQSxvQ0FBQTtFQUNBLDhCQUFBO0FDS0o7QURpQkk7RUFDSyxjQUFBO0FDZlQ7QURrQlE7RUFDSSxXQUFBO0FDaEJaO0FEa0JRO0VBQ0ksYUFBQTtFQUNBLGdCQUFBO0VBQ0Esb0JBQUE7RUFDQSxXQUFBO0VBQ0EsY0FBQTtBQ2hCWjtBRGlCWTtFQUNJLGtCQUFBO0VBQ0EsYUFBQTtFQUNBLDhCQUFBO0VBQ0EsbUJBQUE7RUFDQSxVQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLDZCQUFBO0VBQ0EsZ0JBQUE7RUFDQSx5QkFBQTtBQ2ZoQjtBRGdCZ0I7RUFYSjtJQVlRLHNCQUFBO0lBQ0EsV0FBQTtFQ2JsQjtBQUNGO0FEY2dCO0VBQ0ksWUFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsZUFBQTtFQUNBLFdBQUE7RUFDQSwwQkFBQTtBQ1pwQjtBRGNnQjtFQUNJLFNBQUE7RUFDQSxZQUFBO0VBQ0EsVUFBQTtFQUNBLGlCQUFBO0FDWnBCO0FEZW9CO0VBQ0ksa0JBQUE7RUFDQSxtQkFBQTtBQ2J4QjtBRGN3QjtFQUhKO0lBSVEsV0FBQTtJQUNBLFlBQUE7SUFDQSxvQkFBQTtJQUNBLGdDQUFBO0VDWDFCO0FBQ0Y7QURnQlk7RUFDSSxnQkFBQTtFQUNBLHVCQUFBO0VBQ0Esc0JBQUE7RUFDQSxTQUFBO0VBQ0Esa0JBQUE7RUFDQSw0QkFBQTtFQUNBLGlCQUFBO0VBQ0Esb0JBQUE7QUNkaEI7QURnQlk7RUFDSSxhQUFBO0FDZGhCO0FEZ0JZO0VBQ0ksYUFBQTtBQ2RoQjtBRGdCWTtFQUNJLG1CQUFBO0FDZGhCO0FEZ0JZO0VBQ0ksaUJBQUE7QUNkaEI7QURnQlk7RUFDSSxjQUFBO0VBQ0EsVUFBQTtBQ2RoQjtBRGdCWTtFQUNJLGFBQUE7QUNkaEI7QURpQlE7RUFDSyx1QkFBQTtFQUNBLFlBQUE7QUNmYjtBRGlCUTtFQUNJLG9DQUFBO0FDZlo7QURpQlE7RUF0SEosYUFBQTtFQUNBLG9DQUFBO0VBQ0EsOEJBQUE7QUN3R0o7QURjYTtFQUNJLGNBQUE7RUFDQSxvQkFBQTtBQ1pqQjtBRGVRO0VBQ0ksb0NBQUE7RUFDQSxnQkFBQTtBQ2JaO0FEZ0JZO0VBQ0ksb0NBQUE7QUNkaEI7QURnQlk7RUFDSSwwQkFBQTtBQ2RoQjtBRGlCa0I7RUFDSSxzQkFBQTtBQ2Z0QjtBRG1CUTtFQUNHLDJCQUFBO0VBQ0EsZ0JBQUE7QUNqQlg7QURtQlE7RUFDSSw2QkFBQTtBQ2pCWjtBRG1CUTtFQUNJLHNCQUFBO0FDakJaO0FEbUJRO0VBQ0ksaUNBQUE7RUFDQSwyQkFBQTtFQUNBLHVCQUFBO0VBQ0EsdUNBQUE7QUNqQlo7QURvQlk7RUFDSSxvQkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7QUNsQmhCO0FEbUJpQjtFQUNJLGNBQUE7RUFDQSxXQUFBO0FDakJyQjtBRG9CWTtFQUNJLGFBQUE7RUFDQSx5QkFBQTtFQUNBLDRCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1Q0FBQTtBQ2xCaEI7QURvQm9CO0VBQ0ksV0FBQTtFQUNBLFdBQUE7QUNsQnhCO0FEeUJJO0VBQ0ksY0FBQTtFQUNBLG9CQUFBO0FDdkJSO0FEMEJRO0VBQ0ksY0FBQTtFQUNBLG1CQUFBO0FDeEJaO0FEMkJRO0VBQ0ksYUFBQTtFQUNBLHlCQUFBO0FDekJaO0FENEJRO0VBQ0ksWUFBQTtFQUNBLFlBQUE7RUFDQSx5QkFBQTtFQUNBLFdBQUE7RUFDQSxrQkFBQTtFQUNBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0FDMUJaO0FENkJZO0VBQ0ksY0FBQTtBQzNCaEI7QUQ4QlE7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7QUM1Qlo7QURpQ0M7RUFFVztJQUNJLGNBQUE7SUFDQSx1QkFBQTtJQUNBLGlCQUFBO0VDL0JkOztFRGlDVTtJQUNJLGlCQUFBO0lBQ0Qsa0JBQUE7SUFDQSx5QkFBQTtJQUNBLGdCQUFBO0lBQ0EscUNBQUE7RUM5QmI7QUFDRjtBRGdDSTtFQUNJO0lBQ0ksYUFBQTtJQUNBLHNDQUFBO0lBQ0EsNEJBQUE7SUFDQSw0QkFBQTtFQzlCVjtBQUNGO0FEa0NJO0VBQ0c7SUFDTSxxQkFBQTtFQ2hDWDtBQUNGO0FEbUNNO0VBQ0c7SUFDSSxzQkFBQTtFQ2pDWDtBQUNGIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvZW1haWxwcmVmZXJlbmNlc2xpc3QvZW1haWxwcmVmZXJlbmNlc2xpc3QuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJAbWl4aW4gZmxleGNlbnRlciB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5AbWl4aW4gZmxleHN0YXJ0IHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5AbWl4aW4gZmxleGVuZCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZCAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcbkBtaXhpbiBzcGFjZWJldHdlZW4ge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcblxyXG4ubWFpbmhlYWRlcntcclxuICAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgbWF4LXdpZHRoOiA4My4zMyU7XHJcbiAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgIC5lbWFpbGFsaWdue1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICB9XHJcbiAgICAuZmxleGF1ZGl0dHJhaWx7XHJcbiAgICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgIH1cclxuICAgIC5mbGV4ZW5kYXVkaXR7XHJcbiAgICAgICBAaW5jbHVkZSBmbGV4ZW5kKCk7XHJcbiAgICB9XHJcbiAgICAubGluZWhlaWdodHtcclxuICAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICB9XHJcbiAgICAjZW1haWxwcmVmYWNjb3JkaW97XHJcbiAgICAgICAgLm9mZmNvbG9ye1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgfVxyXG4gICAgICAgIC5zZWFyY2hmaWx0ZXJjb21wYW55IHtcclxuICAgICAgICAgICAgZGlzcGxheTpmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczplbmQ7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDplbmQ7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICBtYXJnaW46IDAgYXV0bztcclxuICAgICAgICAgICAgLnNlYXJjaGhlcmUge1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDo3MCU7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiAycHggNXB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2QwZDFkYztcclxuICAgICAgICAgICAgICAgIEBtZWRpYSBzY3JlZW4gYW5kIChtYXgtd2lkdGg6NTk5cHgpe1xyXG4gICAgICAgICAgICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOmNvbHVtbjtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDoxMDAlO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDM1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgZGlzcGxheTpmbGV4O1xyXG4gICAgICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOmNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAyMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICBpbnB1dFt0eXBlPVwidGV4dFwiXSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYm9yZGVyOiAwO1xyXG4gICAgICAgICAgICAgICAgICAgIGhlaWdodDogNTBweDtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogODUlO1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogNXB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxke1xyXG4gICAgICAgICAgICAgICAgICAgICY6Zmlyc3QtY2hpbGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTVweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIHNjcmVlbiBhbmQgKG1heC13aWR0aDo1OTlweCl7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW46MHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZzowcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbToxMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLWJvdHRvbToxcHggc29saWQgI2QwZDFkYztcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5maWx0ZXJidXR0b24ge1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiAxMDBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDVweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMDtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tbGVmdDogMTJweDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IC5tYXQtZm9ybS1maWVsZC1yaXBwbGUge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtZmxleCB7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgICAgICAgICAgb3BhY2l0eTogMDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtaW5maXgge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXRvcDogMDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAubWF0LWV4cGFuc2lvbi1wYW5lbC1ib2R5e1xyXG4gICAgICAgICAgICAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICBwYWRkaW5nOiAwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtc2xpZGUtdG9nZ2xlLm1hdC1jaGVja2VkOm5vdCgubWF0LWRpc2FibGVkKSAubWF0LXNsaWRlLXRvZ2dsZS1iYXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjOWJkMzViICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC50b2dnbGVtb2RlX3N3aXRjaHtcclxuICAgICAgICAgICAgQGluY2x1ZGUgZmxleGVuZCgpO1xyXG4gICAgICAgICAgICAgLm9uY29sb3J7XHJcbiAgICAgICAgICAgICAgICAgY29sb3I6ICM5YWQxNWE7XHJcbiAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtc2xpZGUtdG9nZ2xlLm1hdC1jaGVja2VkOm5vdCgubWF0LWRpc2FibGVkKSAubWF0LXNsaWRlLXRvZ2dsZS10aHVtYiB7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMnB4IHNvbGlkICM5YmQzNWIgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgICAgICB9IFxyXG4gICAgICAgIC5tYXQtZXhwYW5kZWQge1xyXG4gICAgICAgICAgICAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXIge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtZXhwYW5zaW9uLXBhbmVse1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnRpdGxlcGZjb21wYXluYW1le1xyXG4gICAgICAgICAgICAgICAgICBQe1xyXG4gICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgbWF0LWV4cGFuc2lvbi1wYW5lbC5tYXQtZXhwYW5kZWQge1xyXG4gICAgICAgICAgIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICBtYXJnaW4tdG9wOiAyMHB4O1xyXG4gICAgICAgIH1cclxuICAgICAgICAubWF0LWV4cGFuc2lvbi1wYW5lbHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtZXhwYW5kZWQgLm1hdC1leHBhbnNpb24taW5kaWNhdG9yOjphZnRlciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDUwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm94LXNoYWRvdzogMCAwIDIwcHggcmdiYSgwLCAwLCAwLCAgMC4yMCk7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5hY2NvcmRpb25saXN0ZW1haWx7XHJcbiAgICAgICAgICAgIC5wcm9maWxlY29sb3J7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTVweDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctdG9wOiAxNXB4O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAyNHB4O1xyXG4gICAgICAgICAgICAgICAgIFB7XHJcbiAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZjQ4MTFmO1xyXG4gICAgICAgICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLmV4dGVybmFsYm94e1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMjBweDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkZGU0ZTk7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMCA0cHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcclxuICAgICAgICAgICAgICAgIC5zdWJ0aXRsZV9zZWNvbmRyb3d7XHJcbiAgICAgICAgICAgICAgICAgICAgcHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM2NjY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9IFxyXG4gICAgfVxyXG4gICAgLmluZm9jbXByYXRpbmd7XHJcbiAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgLmxhYmVsY21wYWZ0ZXJ7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICAuYWxpZ25lbmRzYXZle1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICAuc2F2ZWJ0bntcclxuICAgICAgICAgICAgd2lkdGg6MTAycHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDJweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNztcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5zZWN1cml0eXRpdGxle1xyXG4gICAgICAgICAgICBwe1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwMDZjYjc7ICBcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAuYWxpZ25zZWN1cml0eXtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICB9XHJcbiAgICBcclxufVxyXG5cclxuIEBtZWRpYSAobWF4LXdpZHRoOjc2NnB4KSBhbmQgKG1pbi13aWR0aDozMThweCkge1xyXG5cclxuICAgICAgICAgICAgLmFsaWduZW5kc2F2ZXtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tbGVmdDogMTJweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWFpbmhlYWRlcntcclxuICAgICAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgICAgICAgICAgIG1heC13aWR0aDogOTAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgICAgICAgIHBhZGRpbmc6IDMwcHggMHB4IDMwcHggMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgIH1cclxuICAgIEBtZWRpYSAobWF4LXdpZHRoOjQxNHB4KSBhbmQgKG1pbi13aWR0aDo0MTJweCkge1xyXG4gICAgICAgIC5hbGlnbmVuZHNhdmV7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAgXHJcbiAgICB9XHJcblxyXG4gICAgQG1lZGlhIChtYXgtd2lkdGg6NzY4cHgpe1xyXG4gICAgICAgLnNpZGVuYXZpbmRleGNsYXNzIC5hdWRpdHZpZXd7XHJcbiAgICAgICAgICAgICB3aWR0aDogNzUlICFpbXBvcnRhbnQ7XHJcbiAgICAgICB9XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIEBtZWRpYSAobWF4LXdpZHRoOjc2N3B4KXtcclxuICAgICAgICAgLnNpZGVuYXZpbmRleGNsYXNzIC5hdWRpdHZpZXd7XHJcbiAgICAgICAgICAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgICB9XHJcbiAgICAgIH0iLCIubWFpbmhlYWRlciB7XG4gIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gIG1heC13aWR0aDogODMuMzMlO1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xufVxuLm1haW5oZWFkZXIgLmVtYWlsYWxpZ24ge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuLm1haW5oZWFkZXIgLmZsZXhhdWRpdHRyYWlsIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5tYWluaGVhZGVyIC5mbGV4ZW5kYXVkaXQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5tYWluaGVhZGVyIC5saW5laGVpZ2h0IHtcbiAgbGluZS1oZWlnaHQ6IDE7XG59XG4ubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLm9mZmNvbG9yIHtcbiAgY29sb3I6ICMzMzM7XG59XG4ubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLnNlYXJjaGZpbHRlcmNvbXBhbnkge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogZW5kO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGVuZDtcbiAgd2lkdGg6IDEwMCU7XG4gIG1hcmdpbjogMCBhdXRvO1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC5zZWFyY2hmaWx0ZXJjb21wYW55IC5zZWFyY2hoZXJlIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIHdpZHRoOiA3MCU7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgcGFkZGluZy1sZWZ0OiAxMHB4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDJweCA1cHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkMGQxZGM7XG59XG5AbWVkaWEgc2NyZWVuIGFuZCAobWF4LXdpZHRoOiA1OTlweCkge1xuICAubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLnNlYXJjaGZpbHRlcmNvbXBhbnkgLnNlYXJjaGhlcmUge1xuICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XG4gICAgd2lkdGg6IDEwMCU7XG4gIH1cbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuc2VhcmNoZmlsdGVyY29tcGFueSAuc2VhcmNoaGVyZSAubWF0LWljb24ge1xuICBoZWlnaHQ6IDM1cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDIwcHggIWltcG9ydGFudDtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuc2VhcmNoZmlsdGVyY29tcGFueSAuc2VhcmNoaGVyZSBpbnB1dFt0eXBlPXRleHRdIHtcbiAgYm9yZGVyOiAwO1xuICBoZWlnaHQ6IDUwcHg7XG4gIHdpZHRoOiA4NSU7XG4gIHBhZGRpbmctbGVmdDogNXB4O1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC5zZWFyY2hmaWx0ZXJjb21wYW55IC5zZWFyY2hoZXJlIC5tYXQtZm9ybS1maWVsZDpmaXJzdC1jaGlsZCB7XG4gIG1hcmdpbi1yaWdodDogMTVweDtcbiAgcGFkZGluZy1yaWdodDogMTBweDtcbn1cbkBtZWRpYSBzY3JlZW4gYW5kIChtYXgtd2lkdGg6IDU5OXB4KSB7XG4gIC5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuc2VhcmNoZmlsdGVyY29tcGFueSAuc2VhcmNoaGVyZSAubWF0LWZvcm0tZmllbGQ6Zmlyc3QtY2hpbGQge1xuICAgIG1hcmdpbjogMHB4O1xuICAgIHBhZGRpbmc6IDBweDtcbiAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbiAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2QwZDFkYztcbiAgfVxufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC5zZWFyY2hmaWx0ZXJjb21wYW55IC5maWx0ZXJidXR0b24ge1xuICBtaW4td2lkdGg6IDEwMHB4O1xuICBoZWlnaHQ6IDQ1cHggIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiAwO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIG1hcmdpbi1sZWZ0OiAxMnB4O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuc2VhcmNoZmlsdGVyY29tcGFueSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4ubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLnNlYXJjaGZpbHRlcmNvbXBhbnkgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IC5tYXQtZm9ybS1maWVsZC1yaXBwbGUge1xuICBkaXNwbGF5OiBub25lO1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC5zZWFyY2hmaWx0ZXJjb21wYW55IC5tYXQtZm9ybS1maWVsZC1mbGV4IHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuc2VhcmNoZmlsdGVyY29tcGFueSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMDtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuc2VhcmNoZmlsdGVyY29tcGFueSAubWF0LWZvcm0tZmllbGQubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICMwMDZjYjc7XG4gIG9wYWNpdHk6IDA7XG59XG4ubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLnNlYXJjaGZpbHRlcmNvbXBhbnkgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgYm9yZGVyLXRvcDogMDtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAubWF0LWV4cGFuc2lvbi1wYW5lbC1ib2R5IHtcbiAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDBweDtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAubWF0LXNsaWRlLXRvZ2dsZS5tYXQtY2hlY2tlZDpub3QoLm1hdC1kaXNhYmxlZCkgLm1hdC1zbGlkZS10b2dnbGUtYmFyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzliZDM1YiAhaW1wb3J0YW50O1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC50b2dnbGVtb2RlX3N3aXRjaCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1lbmQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC50b2dnbGVtb2RlX3N3aXRjaCAub25jb2xvciB7XG4gIGNvbG9yOiAjOWFkMTVhO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAubWF0LXNsaWRlLXRvZ2dsZS5tYXQtY2hlY2tlZDpub3QoLm1hdC1kaXNhYmxlZCkgLm1hdC1zbGlkZS10b2dnbGUtdGh1bWIge1xuICBib3JkZXI6IDJweCBzb2xpZCAjOWJkMzViICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG59XG4ubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLm1hdC1leHBhbmRlZCAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA2Y2I3ICFpbXBvcnRhbnQ7XG59XG4ubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLm1hdC1leHBhbmRlZCAubWF0LWV4cGFuc2lvbi1wYW5lbCB7XG4gIG1hcmdpbi10b3A6IDBweCAhaW1wb3J0YW50O1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC5tYXQtZXhwYW5kZWQgLnRpdGxlcGZjb21wYXluYW1lIFAge1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIG1hdC1leHBhbnNpb24tcGFuZWwubWF0LWV4cGFuZGVkIHtcbiAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiAyMHB4O1xufVxuLm1haW5oZWFkZXIgI2VtYWlscHJlZmFjY29yZGlvIC5tYXQtZXhwYW5zaW9uLXBhbmVsIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG59XG4ubWFpbmhlYWRlciAjZW1haWxwcmVmYWNjb3JkaW8gLm1hdC1leHBhbmRlZCAubWF0LWV4cGFuc2lvbi1pbmRpY2F0b3I6OmFmdGVyIHtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDAgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA1MHB4ICFpbXBvcnRhbnQ7XG4gIGJveC1zaGFkb3c6IDAgMCAyMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuYWNjb3JkaW9ubGlzdGVtYWlsIC5wcm9maWxlY29sb3Ige1xuICBwYWRkaW5nLWJvdHRvbTogMTVweDtcbiAgcGFkZGluZy10b3A6IDE1cHg7XG4gIHBhZGRpbmctbGVmdDogMjRweDtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuYWNjb3JkaW9ubGlzdGVtYWlsIC5wcm9maWxlY29sb3IgUCB7XG4gIGNvbG9yOiAjZjQ4MTFmO1xuICBtYXJnaW46IDBweDtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuYWNjb3JkaW9ubGlzdGVtYWlsIC5leHRlcm5hbGJveCB7XG4gIHBhZGRpbmc6IDIwcHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGU0ZTk7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJveC1zaGFkb3c6IDAgMCA0cHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcbn1cbi5tYWluaGVhZGVyICNlbWFpbHByZWZhY2NvcmRpbyAuYWNjb3JkaW9ubGlzdGVtYWlsIC5leHRlcm5hbGJveCAuc3VidGl0bGVfc2Vjb25kcm93IHAge1xuICBjb2xvcjogIzY2NjtcbiAgbWFyZ2luOiAwcHg7XG59XG4ubWFpbmhlYWRlciAuaW5mb2NtcHJhdGluZyB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5tYWluaGVhZGVyIC5sYWJlbGNtcGFmdGVyIHtcbiAgY29sb3I6ICM5OTk5OTk7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4ubWFpbmhlYWRlciAuYWxpZ25lbmRzYXZlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5tYWluaGVhZGVyIC5zYXZlYnRuIHtcbiAgd2lkdGg6IDEwMnB4O1xuICBoZWlnaHQ6IDQycHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLm1haW5oZWFkZXIgLnNlY3VyaXR5dGl0bGUgcCB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xufVxuLm1haW5oZWFkZXIgLmFsaWduc2VjdXJpdHkge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY2cHgpIGFuZCAobWluLXdpZHRoOiAzMThweCkge1xuICAuYWxpZ25lbmRzYXZlIHtcbiAgICBkaXNwbGF5OiBibG9jaztcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgICBtYXJnaW4tbGVmdDogMTJweDtcbiAgfVxuXG4gIC5tYWluaGVhZGVyIHtcbiAgICBtYXJnaW4tbGVmdDogYXV0bztcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gICAgbWF4LXdpZHRoOiA5MCUgIWltcG9ydGFudDtcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xuICAgIHBhZGRpbmc6IDMwcHggMHB4IDMwcHggMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA0MTRweCkgYW5kIChtaW4td2lkdGg6IDQxMnB4KSB7XG4gIC5hbGlnbmVuZHNhdmUge1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLWxlZnQ6IDEycHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgLnNpZGVuYXZpbmRleGNsYXNzIC5hdWRpdHZpZXcge1xuICAgIHdpZHRoOiA3NSUgIWltcG9ydGFudDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XG4gIC5zaWRlbmF2aW5kZXhjbGFzcyAuYXVkaXR2aWV3IHtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICB9XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.ts":
  /*!************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.ts ***!
    \************************************************************************************************/

  /*! exports provided: EmailpreferenceslistComponent */

  /***/
  function srcAppModulesAccountsettingsEmailpreferenceslistEmailpreferenceslistComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "EmailpreferenceslistComponent", function () {
      return EmailpreferenceslistComponent;
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


    var _accountsettings_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! ../accountsettings.service */
    "./src/app/modules/accountsettings/accountsettings.service.ts");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _env_environment__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @env/environment */
    "./src/environments/environment.ts");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");

    var EmailpreferenceslistComponent = /*#__PURE__*/function () {
      // emailusers = [
      //   {id:1,name:"Rating reminders",title:"Send an email reminding me to rate an item a week after purchase"},
      //   {id:2,name:"Item update notifications",title:"Send an email when an item I've purchased is updated"},
      //   {id:3,name:"Item comment notifications",title:"Send me an email when someone comments on one of my items"},
      //   {id:4,name:"Team comment notifications",title:"Send me an email when someone comments on one of my team items"},
      //   {id:5,name:"Item review notifications",title:"Send me an email when my items are approved or rejected"},
      //   {id:6,name:"Buyer review notifications",title:"Send me an email when someone leaves a review with their rating"},
      //   {id:7,name:"Expiring support notifications",title:"Send me emails showing my soon to expire support entitlements"},
      //   {id:8,name:"Daily summary emails",title:"Send me a daily summary of all items approved or rejected"}, 
      // ];
      function EmailpreferenceslistComponent(accSettingService, toastr, fb) {
        _classCallCheck(this, EmailpreferenceslistComponent);

        this.accSettingService = accSettingService;
        this.toastr = toastr;
        this.fb = fb;
        this.searchOptions = [{
          'value': 1,
          'name': 'On'
        }, {
          'value': 2,
          'name': 'Off'
        }];
        this.onOff = [];
        this.customCollapsedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_4__["environment"].customCollapsedHeight;
        this.customExpandedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_4__["environment"].customExpandedHeight;
        this.ischeckedanother = true;
        this.panel = 1;
        this.companyprofiledata = [{
          profiletitle: "CR document to be displayed in the External Profile",
          profilesubtitlte: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",
          id: 1
        }, {
          profiletitle: "To be notified when user contacts from the external Profile",
          profilesubtitlte: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",
          id: 2
        }, {
          profiletitle: "To receive audit log on a weekly basis",
          profilesubtitlte: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",
          id: 3
        }, {
          profiletitle: "To receive an email on the newly registered users when they log in",
          profilesubtitlte: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",
          id: 4
        }];
      }

      _createClass(EmailpreferenceslistComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this17 = this;

          this.onOff = [false];
          this.Emailprefform = this.fb.group({
            companyprofiledata: this.fb.array([])
          });
          this.contractform = this.fb.group({
            selectstatus: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required],
            selectvaluestatus: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required]
          });
          this.scfform = this.fb.group({
            selectmode: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required],
            selectmodestatus: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required]
          });
          this.companyprofile = this.Emailprefform.get('companyprofiledata');
          this.companyprofiledata.forEach(function (val) {
            if (_this17.company(val.profiletitle, val.profilesubtitlte)) {
              _this17.companyprofile.push(_this17.company(val.profiletitle, val.profilesubtitlte));
            }
          });
        }
      }, {
        key: "company",
        value: function company(title, subtile) {
          return this.fb.group({
            profiletitle: title,
            profilesubtitlte: subtile,
            slide: [],
            selectmodevalue: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required]
          });
        }
      }, {
        key: "getspecControls",
        value: function getspecControls() {
          if (this.Emailprefform) {
            return this.Emailprefform.get('companyprofiledata').controls;
          }
        } // employees(): FormArray {
        //   return this.Emailprefform.get('companyprofiledata') as FormArray;
        // }

      }, {
        key: "setslidevalue",
        value: function setslidevalue(i, value) {
          this.Emailprefform.get('companyprofiledata').at(i).get('slide').setValue(value);
        }
      }, {
        key: "setmodevalue",
        value: function setmodevalue(i, event) {
          this.Emailprefform.get('companyprofiledata').at(i).get('selectmodevalue').setValue(event.value);
        }
      }, {
        key: "submitform",
        value: function submitform() {}
      }, {
        key: "showTSuccess",
        value: function showTSuccess() {
          this.toastr.success('Email preferences updated successfully.', 'Success !', {
            timeOut: 3000,
            closeButton: true
          });
        }
      }, {
        key: "saveEmailPref",
        value: function saveEmailPref(selectedList) {
          var _this18 = this;

          if (selectedList.length > 0) {
            var formatedEmailPref = this.formatEmailPref(selectedList);
            this.accSettingService.saveEmailPref(formatedEmailPref).subscribe(function (data) {
              _this18.showTSuccess();
            });
          }
        }
      }, {
        key: "formatEmailPref",
        value: function formatEmailPref(selectedList) {
          var returnVal = {};

          for (var i = 0; i < selectedList.length; i++) {
            returnVal[selectedList[i].value] = "Yes";
          }

          return returnVal;
        }
      }, {
        key: "setOpen",
        value: function setOpen(i) {
          this.panel = i;
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
          } catch (error) {}
        }
      }]);

      return EmailpreferenceslistComponent;
    }();

    EmailpreferenceslistComponent.ctorParameters = function () {
      return [{
        type: _accountsettings_service__WEBPACK_IMPORTED_MODULE_2__["AccountsettingsService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_3__["ToastrService"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormBuilder"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], EmailpreferenceslistComponent.prototype, "selectedEmailPref", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('audittraillview'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_6__["MatDrawer"])], EmailpreferenceslistComponent.prototype, "audittraillview", void 0);
    EmailpreferenceslistComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-emailpreferenceslist',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./emailpreferenceslist.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./emailpreferenceslist.component.scss */
      "./src/app/modules/accountsettings/emailpreferenceslist/emailpreferenceslist.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_accountsettings_service__WEBPACK_IMPORTED_MODULE_2__["AccountsettingsService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_3__["ToastrService"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormBuilder"]])], EmailpreferenceslistComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/securitydetail/securitydetail.component.scss":
  /*!**************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/securitydetail/securitydetail.component.scss ***!
    \**************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsSecuritydetailSecuritydetailComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "@charset \"UTF-8\";\n.changeuserloaderview .mat-dialog-container {\n  background: transparent;\n  width: 100%;\n  box-shadow: none !important;\n}\n.changeuserloaderview .loaderrespone {\n  position: fixed !important;\n  width: 100%;\n  left: 50% !important;\n  top: 50% !important;\n  transform: translate(-50%, -50%) !important;\n  height: 100%;\n  z-index: 9999;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  background-color: rgba(0, 0, 0, 0.7);\n}\n.viewaccounttab {\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 83.33%;\n  background: #fff;\n}\n.viewaccounttab .verifiedcontent {\n  background: #63a126;\n  min-width: 80px;\n  height: 22px;\n  color: #fff;\n  border-radius: 3px;\n  display: flex;\n  justify-content: center !important;\n  align-items: center !important;\n  font-size: 13px;\n}\n.viewaccounttab .verifiedcontent i {\n  width: 16px;\n  height: 16px;\n  background: #fff;\n  border-radius: 50%;\n  display: flex;\n  justify-content: center !important;\n  align-items: center !important;\n  color: #63a126;\n  font-size: 10px !important;\n}\n.viewaccounttab .disactive {\n  display: none;\n}\n.viewaccounttab .spacewhitespace {\n  padding-bottom: 160px;\n}\n.viewaccounttab .borderspecheight {\n  border-top: 1px solid #d7d7d7;\n  border-left: 1px solid #d7d7d7;\n  border-right: 1px solid #d7d7d7;\n  margin-left: 20px;\n  margin-right: 20px;\n  padding: 20px;\n  display: flex;\n  justify-content: space-between;\n  background-color: #f8f8f8;\n}\n.viewaccounttab .domaincolor p {\n  color: #333333;\n}\n.viewaccounttab .domaincolor span {\n  color: #d9a55d;\n}\n.viewaccounttab .btnalign p {\n  color: #333333;\n}\n.viewaccounttab .coloractive {\n  font-weight: normal !important;\n  background: #58626e;\n  color: #fff;\n  border-radius: 4px;\n  padding: 0 10px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.viewaccounttab .alignpassword {\n  display: flex;\n  justify-content: flex-end;\n}\n.viewaccounttab .borderemail {\n  border-bottom: 1px solid #d7d7d7;\n  border-left: 1px solid #d7d7d7;\n  border-right: 1px solid #d7d7d7;\n  border-top: none;\n  display: flex;\n  background: #fff;\n  margin-left: 20px;\n  margin-right: 20px;\n}\n.viewaccounttab .changecolor, .viewaccounttab .viewpermission {\n  background-color: #f3feff;\n  color: #4aa1ac;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  line-height: 1;\n  align-items: center;\n  height: 26px;\n  min-width: 140px;\n  border: 1px solid #4aa1ac;\n}\n.viewaccounttab .border_btn {\n  margin-right: 10px;\n}\n.viewaccounttab .viewpermission {\n  background: #4aa1ac !important;\n  color: #fff !important;\n  border: none !important;\n}\n.viewaccounttab .usercolor {\n  background-color: #4aa1ac;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  line-height: 12px;\n  height: 26px;\n  cursor: pointer;\n}\n.viewaccounttab .spencercoor {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center;\n}\n.viewaccounttab .spencercoor p {\n  color: #333;\n}\n.viewaccounttab .widthcomp {\n  width: 50%;\n}\n.viewaccounttab .widthcompmain {\n  width: 34%;\n}\n.viewaccounttab .cmpnyinfo {\n  margin-bottom: 0;\n  display: flex;\n  line-height: 25px;\n  padding-bottom: 8px;\n  justify-content: flex-start;\n  align-items: center !important;\n}\n.viewaccounttab .cmpnyinfo .widthimgcheck {\n  display: none;\n  width: 20px;\n  height: 18px;\n}\n.viewaccounttab .flagwidthcode {\n  width: 30px;\n}\n.viewaccounttab .labelcmp {\n  min-width: 85px;\n}\n.viewaccounttab .marketcolor p {\n  color: #333333;\n}\n.viewaccounttab .marketcolor .borderspec {\n  border: 1px solid #d7d7d7;\n  margin-left: 20px;\n  margin-right: 20px;\n  padding: 18px;\n  display: flex;\n  justify-content: space-between;\n  background-color: #eef0f4;\n  align-items: center;\n  height: 122px;\n}\n.viewaccounttab .marketcolor .spencercoorpayment h2 {\n  color: #333333;\n}\n.viewaccounttab .marketcolor .borderspeccompanycolor {\n  border: 1px solid #d7d7d7;\n  margin-left: 20px;\n  margin-right: 20px;\n  display: flex;\n  justify-content: space-between;\n  background-color: #eef0f4;\n  min-height: 90px;\n  padding: 12px 26px 26px 26px;\n  border: none;\n}\n.viewaccounttab .marketcolor .nextrenewal {\n  line-height: 25px;\n}\n.viewaccounttab .marketcolor .nextrenewal span {\n  font-size: 0.875rem;\n  color: #3366ff;\n}\n.viewaccounttab .marketcolor .widthcompsale {\n  width: 32%;\n  border-right: 1px solid #dadada;\n}\n.viewaccounttab .marketcolor .aftercolor {\n  position: relative;\n  cursor: pointer;\n}\n.viewaccounttab .marketcolor .aftercolor::after {\n  font-family: \"bgi-icon\" !important;\n  font-style: normal;\n  font-weight: normal;\n  font-variant: normal;\n  text-transform: none;\n  line-height: 1;\n  -webkit-font-smoothing: antialiased;\n  -moz-osx-font-smoothing: grayscale;\n  content: \"\";\n  transform: rotate(267deg);\n  cursor: pointer;\n  color: #3366ff;\n  vertical-align: middle;\n  position: absolute;\n  height: 25px;\n  width: 26px;\n  border-radius: 50%;\n  top: -2px;\n  font-size: 8px;\n  line-height: 26px;\n  text-align: center;\n}\n.viewaccounttab .marketcolor .valuecolor {\n  color: #f08235;\n}\n.viewaccounttab .marketcolor .alignend {\n  display: flex;\n}\n.viewaccounttab .marketcolor .widthload {\n  width: 50%;\n}\n.viewaccounttab .marketcolor .spencercoorpaymentclassification {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  padding: 12px;\n}\n.viewaccounttab .marketcolor .spencercoorpaymentclassification p {\n  color: #006cb7;\n}\n.viewaccounttab .marketcolor .borderspeccompanycolordownload {\n  border: 1px solid #d7d7d7;\n  margin-left: 20px;\n  min-height: 50px;\n  border-bottom: none;\n  background-color: #eef0f4;\n}\n.viewaccounttab .marketcolor .activescroll .mat-tab-body.mat-tab-body-active {\n  position: relative;\n  overflow-x: hidden;\n  overflow-y: inherit;\n  z-index: 1;\n  flex-grow: 1;\n}\n.viewaccounttab .marketcolor .projectborder {\n  border-top: none;\n  border-left: 1px solid #dadada;\n  border-right: 1px solid #dadada;\n  border-bottom: 1px solid #dadada;\n}\n.viewaccounttab .marketcolor .borderspeccompanycolordownloadanother {\n  border: 1px solid #d7d7d7;\n  margin-left: 15px;\n  margin-right: 20px;\n  min-height: 50px;\n  border-bottom: none;\n  background-color: #eef0f4;\n}\n.viewaccounttab .marketcolor .emailalign {\n  display: flex;\n}\n.viewaccounttab .marketcolor .infocmprating {\n  color: #333333;\n  font-size: 0.9375rem;\n}\n.viewaccounttab .marketcolor .labelcmpafter {\n  color: #999999;\n  font-size: 0.875rem;\n}\n.viewaccounttab .marketcolor .save {\n  width: 152px;\n  height: 42px;\n  background-color: #006cb7;\n  color: #fff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n.viewaccounttab .marketcolor .alignendsave {\n  display: flex;\n  justify-content: flex-end;\n}\n@media (max-width: 1024px) and (min-width: 769px) {\n  .afternext::after {\n    content: \"\";\n    border-top: 18px solid #345f9f;\n    border-left: 18px solid transparent;\n    border-right: 18px solid transparent;\n    position: absolute;\n    bottom: 188px;\n    transform: rotate(-180deg);\n    left: 157px !important;\n  }\n\n  .viewaccounttab {\n    max-width: 100% !important;\n  }\n\n  .widthform {\n    width: 100% !important;\n  }\n\n  .widthcomp {\n    width: 56% !important;\n  }\n\n  .securityheader {\n    background-color: #fff;\n    box-shadow: none !important;\n    max-width: 83.33%;\n    margin-left: auto;\n    margin-right: auto;\n  }\n\n  .nextrenewal {\n    padding-left: 0px !important;\n  }\n\n  .widthcompsale {\n    width: 40% !important;\n    border-right: none !important;\n  }\n\n  .widthcompmain {\n    width: 34% !important;\n  }\n\n  .spencercoorpaymentclassification {\n    display: block !important;\n    align-items: center;\n    justify-content: flex-start;\n    padding: 12px;\n  }\n\n  .borderspeccompanycolordownload {\n    border: 1px solid #d7d7d7;\n    margin-left: 20px;\n    min-height: 84px !important;\n    border-bottom: none;\n    background-color: #eef0f4;\n  }\n\n  .alignpassword {\n    display: flex;\n    justify-content: flex-start !important;\n    align-items: flex-start !important;\n  }\n\n  .spacebtn {\n    margin-top: 10px;\n  }\n\n  .borderspeccompanycolordownloadanother {\n    min-height: 84px !important;\n  }\n\n  .backgroundnextdesign h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n\n  .backgroundnextdesign {\n    background-color: #fff;\n    margin-left: 78px;\n    margin-right: 78px;\n    height: 544px;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .backgroundnextdesign h4 {\n    color: #333333;\n  }\n\n  .background h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n}\n@media (max-width: 768px) {\n  .labelcmp {\n    color: #999;\n    font-size: 0.9375rem;\n    display: block;\n    min-width: 120px !important;\n  }\n\n  .afternext::after {\n    content: \"\";\n    border-top: 18px solid #345f9f;\n    border-left: 18px solid transparent;\n    border-right: 18px solid transparent;\n    position: absolute;\n    bottom: 288px !important;\n    transform: rotate(-180deg);\n    left: 48px;\n  }\n\n  .widthcomp {\n    width: auto !important;\n  }\n\n  .widthcompmain {\n    width: auto !important;\n  }\n\n  .borderspecheight {\n    display: flex !important;\n    background-color: #eef0f4;\n    align-items: center;\n  }\n\n  .widthuserbtn {\n    max-width: 62% !important;\n  }\n\n  .borderemail {\n    border-bottom: 1px solid #d7d7d7;\n    border-left: 1px solid #d7d7d7;\n    border-right: 1px solid #d7d7d7;\n    border-top: none;\n    display: flex !important;\n    margin-left: 0px !important;\n  }\n\n  .widthcomp {\n    width: 58% !important;\n    padding-bottom: 12px;\n  }\n\n  .borderspeccompanycolor {\n    border: 1px solid #d7d7d7;\n    margin-left: 20px;\n    margin-right: 20px;\n    display: flex !important;\n    justify-content: space-between;\n    background-color: #eef0f4;\n    padding: 12px 26px 26px 26px;\n    border: none;\n    min-height: 125px !important;\n  }\n\n  .nextrenewal {\n    padding-left: 0px !important;\n    padding-top: 10px;\n  }\n\n  .widthcompsale {\n    width: auto !important;\n    border-right: none !important;\n  }\n\n  .spencercoorpaymentclassification {\n    display: flex !important;\n    align-items: center;\n    justify-content: flex-start;\n    padding: 12px;\n  }\n\n  .borderspeccompanycolordownload {\n    border: 1px solid #d7d7d7;\n    margin-left: 20px;\n    min-height: 106px !important;\n    border-bottom: none;\n    background-color: #eef0f4;\n  }\n\n  .spacebtn {\n    margin-top: 10px;\n  }\n\n  .alignpassword {\n    display: flex;\n    justify-content: flex-start !important;\n  }\n\n  .cmpnyinfo {\n    margin-bottom: 10;\n    display: flex !important;\n    line-height: 25px;\n    justify-content: flex-start;\n    align-items: center !important;\n    padding-bottom: 10px;\n  }\n\n  .securityheader {\n    background-color: #fff;\n    box-shadow: none !important;\n  }\n\n  .spcesme {\n    padding-bottom: 135px !important;\n  }\n\n  .widthform {\n    width: 100% !important;\n  }\n\n  .backgroundnextdesign {\n    background-color: #fff;\n    margin-left: 78px !important;\n    margin-right: 78px !important;\n    height: 662px !important;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .backgroundnextdesign h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n\n  .background {\n    background-color: #fff;\n    margin-left: 78px;\n    margin-right: 78px;\n    height: 520px;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .background h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n}\n@media (max-width: 600px) {\n  .border_btn p {\n    text-align: left !important;\n    margin-bottom: 10px !important;\n  }\n\n  .backgroundnextdesign {\n    height: 823px !important;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .backgroundnextdesign h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n\n  .background {\n    background-color: #fff;\n    margin-left: 78px;\n    margin-right: 78px;\n    height: 702px !important;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .background h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n\n  .btnresponsive {\n    display: contents;\n  }\n\n  .blockresponsivewidth {\n    display: block !important;\n  }\n\n  .submitcontentwidth {\n    display: contents;\n  }\n\n  .spacingfiled {\n    margin-bottom: 10px;\n  }\n\n  .backgroundnextdesign {\n    background-color: #fff;\n    margin-left: 10px !important;\n    margin-right: 10px !important;\n    height: 850px !important;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .backgroundnextdesign h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n\n  .blockalign {\n    display: block !important;\n  }\n\n  .verfiedonresponsivewidth {\n    max-width: 80% !important;\n  }\n\n  .verfiedalign span {\n    color: #70c015;\n    padding-left: 6px !important;\n  }\n\n  .imagealign {\n    display: flex;\n    align-items: center;\n    color: black;\n  }\n  .imagealign img {\n    padding-left: 4px;\n  }\n}\n@media (max-width: 766px) and (min-width: 318px) {\n  .cmpnyinfo {\n    display: block !important;\n  }\n\n  .responsivepaddingwidth {\n    padding-left: 18px !important;\n  }\n\n  .flexalign {\n    display: flex;\n    align-items: center;\n    justify-content: flex-start;\n    padding-right: 0px;\n  }\n  .flexalign .backgroundnextdesign {\n    background-color: #fff;\n    margin-left: 10px !important;\n    margin-right: 10px !important;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .flexalign .backgroundnextdesign h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n  .flexalign .flexalign {\n    display: flex;\n    align-items: center;\n    justify-content: flex-start;\n    padding-right: 0px;\n  }\n  .flexalign .responsivepadding {\n    padding-left: 8px !important;\n  }\n\n  .spencercoor {\n    display: block !important;\n    justify-content: flex-start;\n    align-items: center;\n  }\n\n  .alignpassword {\n    display: block !important;\n    justify-content: flex-start !important;\n  }\n\n  .changecolor, .viewaccounttab .viewpermission {\n    margin-bottom: 10px;\n  }\n\n  .projectborder {\n    padding: 12px !important;\n  }\n\n  .borderspecheight {\n    display: block !important;\n    background-color: #eef0f4;\n    align-items: center;\n    height: 272px !important;\n    padding: 12px !important;\n  }\n\n  .marketcolor {\n    padding-top: 10px;\n  }\n\n  .securityheader {\n    background-color: #fff;\n    max-width: 100% !important;\n    margin-left: auto;\n    margin-right: auto;\n    box-shadow: none !important;\n  }\n\n  .title {\n    padding-right: 0px !important;\n  }\n\n  .borderspeccompanycolor {\n    border: 1px solid #d7d7d7;\n    margin-left: 20px;\n    margin-right: 20px;\n    display: block !important;\n    justify-content: space-between;\n    padding: 12px 12px 12px 12px;\n    border: none;\n  }\n\n  .borderspec {\n    height: 142px !important;\n    padding: 12px !important;\n  }\n\n  .borderemail {\n    padding-left: 12px !important;\n  }\n\n  .widthimgcheck {\n    padding-left: 2px !important;\n  }\n\n  .alignend {\n    display: block !important;\n    height: 100%;\n  }\n\n  .borderspeccompanycolordownload {\n    margin-right: 20px;\n  }\n\n  .borderspeccompanycolordownloadanother {\n    margin-top: 168px !important;\n    margin-left: 20px !important;\n  }\n\n  .spcesme {\n    padding-bottom: 148px !important;\n  }\n\n  .borderspeccompanycolordownloadanother {\n    min-height: 116px !important;\n  }\n\n  .widthload {\n    width: auto !important;\n  }\n\n  .alignendsave {\n    display: block;\n    justify-content: center;\n    margin-left: 12px;\n  }\n\n  .cancel {\n    margin-bottom: 10px;\n  }\n\n  .widthform {\n    padding-left: 12px !important;\n    padding-right: 12px !important;\n  }\n}\n@media (max-width: 414px) and (min-width: 412px) {\n  .alignendsave {\n    display: flex;\n    justify-content: flex-start !important;\n    margin-left: 12px !important;\n    margin-right: 0px !important;\n  }\n\n  .packalign {\n    display: flex !important;\n    align-items: flex-start;\n    justify-content: flex-start;\n  }\n}\n@media (max-width: 414px) and (min-width: 375px) {\n  .borderspeccompanycolordownloadanother {\n    min-height: 94px !important;\n  }\n\n  .borderspeccompanycolordownload {\n    min-height: 94px !important;\n  }\n}\n@media (max-width: 1280px) and (min-width: 1278px) {\n  .widthcompmain {\n    width: 32% !important;\n  }\n\n  .widthcompsale {\n    width: 36% !important;\n    border-right: 1px solid #dadada;\n  }\n}\n#tabforchangeusers .mat-tab-group {\n  padding-top: 25px;\n}\n#tabforchangeusers .mat-tab-body-content {\n  overflow: hidden !important;\n}\n#tabforchangeusers .mat-ink-bar {\n  display: none;\n}\n#tabforchangeusers .mat-tab-header {\n  border-bottom: none;\n  background: none !important;\n  color: #333;\n}\n#tabforchangeusers .mat-tab-labels {\n  width: 100%;\n  opacity: 1;\n}\n#tabforchangeusers .mat-tab-label {\n  width: 100%;\n  opacity: 1;\n  min-height: 90px !important;\n  background: #e8ebef;\n  padding-right: 10px;\n  padding-left: 10px;\n  border: 1px solid #e8ebef;\n  height: auto !important;\n  overflow: hidden !important;\n}\n#tabforchangeusers .mat-tab-label:first-child {\n  margin-right: 15px;\n}\n#tabforchangeusers .mat-tab-list {\n  padding: 0 !important;\n  opacity: 1;\n  margin-bottom: 15px;\n  margin-bottom: 15px !important;\n  width: 100% !important;\n  max-width: 100% !important;\n  height: auto !important;\n}\n#tabforchangeusers .mat-tab-label-active {\n  border-bottom: none !important;\n  background-color: #4aa1ac !important;\n  box-shadow: 0 0 9px rgba(0, 0, 0, 0.15);\n  border: 1px solid #e1dede;\n  border-bottom: none !important;\n  position: relative;\n}\n#tabforchangeusers .mat-tab-label-active .tabselectheadercontent .selectiontext h4 {\n  color: #fff !important;\n}\n#tabforchangeusers .mat-tab-label-active .tabselectheadercontent .selectiontext p {\n  color: #90b4ea !important;\n}\n#tabforchangeusers .mat-tab-label-active .mat-tab-label-content {\n  color: #fff;\n}\n#tabforchangeusers .tabselectheadercontent {\n  display: flex;\n}\n#tabforchangeusers .tabselectheadercontent .selectiontext {\n  width: calc(100% - 65px);\n}\n#tabforchangeusers .tabselectheadercontent .selectionlogo {\n  width: 50px;\n  display: flex;\n  justify-content: center !important;\n  align-items: center !important;\n  margin-right: 10px;\n}\n#tabforchangeusers .tabselectheadercontent .selectionlogo i {\n  font-size: 1.875rem;\n}\n#tabforchangeusers .tabselectheadercontent h4 {\n  font-size: 0.9375rem;\n  color: #354052;\n  font-family: \"cairoregular\";\n  margin: 0;\n  white-space: normal !important;\n  text-align: left;\n}\n#tabforchangeusers .tabselectheadercontent p {\n  font-size: 0.75rem;\n  color: #7f8fa4;\n  margin: 0;\n  white-space: normal !important;\n  text-align: left;\n}\n#tabforchangeusers .mat-tab-body-wrapper {\n  background-color: #fff;\n  border-top: none;\n}\n[dir=rtl] .viewaccounttab .usercolor {\n  margin-right: 10px !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3Mvc2VjdXJpdHlkZXRhaWwvc2VjdXJpdHlkZXRhaWwuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL3NlY3VyaXR5ZGV0YWlsL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFjY291bnRzZXR0aW5nc1xcc2VjdXJpdHlkZXRhaWxcXHNlY3VyaXR5ZGV0YWlsLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLGdCQUFnQjtBQzJCWjtFQUNHLHVCQUFBO0VBQ0EsV0FBQTtFQUNBLDJCQUFBO0FEekJQO0FDNkJJO0VBQ0ksMEJBQUE7RUFDQSxXQUFBO0VBQ0Esb0JBQUE7RUFDQSxtQkFBQTtFQUNBLDJDQUFBO0VBQ0EsWUFBQTtFQUNBLGFBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSx1QkFBQTtFQUNBLG9DQUFBO0FEM0JSO0FDOEJBO0VBQ0ksaUJBQUE7RUFDQSxrQkFBQTtFQUNBLGlCQUFBO0VBQ0EsZ0JBQUE7QUQzQko7QUM0Qkk7RUFDSSxtQkFBQTtFQUNBLGVBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0VBekRKLGFBQUE7RUFDQSxrQ0FBQTtFQUNBLDhCQUFBO0VBeURJLGVBQUE7QUR4QlI7QUN5QlE7RUFDSSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFoRVIsYUFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7RUFnRVEsY0FBQTtFQUNBLDBCQUFBO0FEckJaO0FDd0JJO0VBQ0ksYUFBQTtBRHRCUjtBQ3dCSTtFQUNJLHFCQUFBO0FEdEJSO0FDd0JJO0VBQ0ksNkJBQUE7RUFDQSw4QkFBQTtFQUNBLCtCQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLGFBQUE7RUFDQSxhQUFBO0VBQ0EsOEJB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Q0ksc0JBQUE7QURFaEI7QUNBWTtFQUNJLHlCQUFBO0FERWhCO0FDQ1E7RUFDSSxXQUFBO0FEQ1o7QUNFSTtFQUNJLGFBQUE7QURBUjtBQ0NRO0VBRUksd0JBQUE7QURBWjtBQ0VRO0VBQ0ksV0FBQTtFQXoyQlIsYUFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7RUF5MkJRLGtCQUFBO0FERVo7QUNEWTtFQUNJLG1CQUFBO0FER2hCO0FDQVE7RUFDSSxvQkFBQTtFQUNBLGNBQUE7RUFDQSwyQkFBQTtFQS8xQlIsU0FBQTtFQUNBLDhCQUFBO0VBQ0EsZ0JBQUE7QURrMkJKO0FDRlE7RUFDSSxrQkFBQTtFQUNBLGNBQUE7RUFwMkJSLFNBQUE7RUFDQSw4QkFBQTtFQUNBLGdCQUFBO0FEeTJCSjtBQ0hJO0VBQ0ksc0JBQUE7RUFDQSxnQkFBQTtBREtSO0FDS1E7RUFDSSw2QkFBQTtBREZaIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3Mvc2VjdXJpdHlkZXRhaWwvc2VjdXJpdHlkZXRhaWwuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJAY2hhcnNldCBcIlVURi04XCI7XG4uY2hhbmdldXNlcmxvYWRlcnZpZXcgLm1hdC1kaWFsb2ctY29udGFpbmVyIHtcbiAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XG4gIHdpZHRoOiAxMDAlO1xuICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XG59XG4uY2hhbmdldXNlcmxvYWRlcnZpZXcgLmxvYWRlcnJlc3BvbmUge1xuICBwb3NpdGlvbjogZml4ZWQgIWltcG9ydGFudDtcbiAgd2lkdGg6IDEwMCU7XG4gIGxlZnQ6IDUwJSAhaW1wb3J0YW50O1xuICB0b3A6IDUwJSAhaW1wb3J0YW50O1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZSgtNTAlLCAtNTAlKSAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDEwMCU7XG4gIHotaW5kZXg6IDk5OTk7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKDAsIDAsIDAsIDAuNyk7XG59XG5cbi52aWV3YWNjb3VudHRhYiB7XG4gIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gIG1heC13aWR0aDogODMuMzMlO1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xufVxuLnZpZXdhY2NvdW50dGFiIC52ZXJpZmllZGNvbnRlbnQge1xuICBiYWNrZ3JvdW5kOiAjNjNhMTI2O1xuICBtaW4td2lkdGg6IDgwcHg7XG4gIGhlaWdodDogMjJweDtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDNweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDEzcHg7XG59XG4udmlld2FjY291bnR0YWIgLnZlcmlmaWVkY29udGVudCBpIHtcbiAgd2lkdGg6IDE2cHg7XG4gIGhlaWdodDogMTZweDtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjNjNhMTI2O1xuICBmb250LXNpemU6IDEwcHggIWltcG9ydGFudDtcbn1cbi52aWV3YWNjb3VudHRhYiAuZGlzYWN0aXZlIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbi52aWV3YWNjb3VudHRhYiAuc3BhY2V3aGl0ZXNwYWNlIHtcbiAgcGFkZGluZy1ib3R0b206IDE2MHB4O1xufVxuLnZpZXdhY2NvdW50dGFiIC5ib3JkZXJzcGVjaGVpZ2h0IHtcbiAgYm9yZGVyLXRvcDogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcbiAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2Q3ZDdkNztcbiAgbWFyZ2luLWxlZnQ6IDIwcHg7XG4gIG1hcmdpbi1yaWdodDogMjBweDtcbiAgcGFkZGluZzogMjBweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuLnZpZXdhY2NvdW50dGFiIC5kb21haW5jb2xvciBwIHtcbiAgY29sb3I6ICMzMzMzMzM7XG59XG4udmlld2FjY291bnR0YWIgLmRvbWFpbmNvbG9yIHNwYW4ge1xuICBjb2xvcjogI2Q5YTU1ZDtcbn1cbi52aWV3YWNjb3VudHRhYiAuYnRuYWxpZ24gcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xufVxuLnZpZXdhY2NvdW50dGFiIC5jb2xvcmFjdGl2ZSB7XG4gIGZvbnQtd2VpZ2h0OiBub3JtYWwgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZDogIzU4NjI2ZTtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDRweDtcbiAgcGFkZGluZzogMCAxMHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi52aWV3YWNjb3VudHRhYiAuYWxpZ25wYXNzd29yZCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XG59XG4udmlld2FjY291bnR0YWIgLmJvcmRlcmVtYWlsIHtcbiAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcbiAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2Q3ZDdkNztcbiAgYm9yZGVyLXRvcDogbm9uZTtcbiAgZGlzcGxheTogZmxleDtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbiAgbWFyZ2luLWxlZnQ6IDIwcHg7XG4gIG1hcmdpbi1yaWdodDogMjBweDtcbn1cbi52aWV3YWNjb3VudHRhYiAuY2hhbmdlY29sb3IsIC52aWV3YWNjb3VudHRhYiAudmlld3Blcm1pc3Npb24ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjNmZWZmO1xuICBjb2xvcjogIzRhYTFhYztcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBsaW5lLWhlaWdodDogMTtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgaGVpZ2h0OiAyNnB4O1xuICBtaW4td2lkdGg6IDE0MHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjNGFhMWFjO1xufVxuLnZpZXdhY2NvdW50dGFiIC5ib3JkZXJfYnRuIHtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xufVxuLnZpZXdhY2NvdW50dGFiIC52aWV3cGVybWlzc2lvbiB7XG4gIGJhY2tncm91bmQ6ICM0YWExYWMgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XG59XG4udmlld2FjY291bnR0YWIgLnVzZXJjb2xvciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICM0YWExYWM7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGxpbmUtaGVpZ2h0OiAxMnB4O1xuICBoZWlnaHQ6IDI2cHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi52aWV3YWNjb3VudHRhYiAuc3BlbmNlcmNvb3Ige1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4udmlld2FjY291bnR0YWIgLnNwZW5jZXJjb29yIHAge1xuICBjb2xvcjogIzMzMztcbn1cbi52aWV3YWNjb3VudHRhYiAud2lkdGhjb21wIHtcbiAgd2lkdGg6IDUwJTtcbn1cbi52aWV3YWNjb3VudHRhYiAud2lkdGhjb21wbWFpbiB7XG4gIHdpZHRoOiAzNCU7XG59XG4udmlld2FjY291bnR0YWIgLmNtcG55aW5mbyB7XG4gIG1hcmdpbi1ib3R0b206IDA7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGxpbmUtaGVpZ2h0OiAyNXB4O1xuICBwYWRkaW5nLWJvdHRvbTogOHB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi52aWV3YWNjb3VudHRhYiAuY21wbnlpbmZvIC53aWR0aGltZ2NoZWNrIHtcbiAgZGlzcGxheTogbm9uZTtcbiAgd2lkdGg6IDIwcHg7XG4gIGhlaWdodDogMThweDtcbn1cbi52aWV3YWNjb3VudHRhYiAuZmxhZ3dpZHRoY29kZSB7XG4gIHdpZHRoOiAzMHB4O1xufVxuLnZpZXdhY2NvdW50dGFiIC5sYWJlbGNtcCB7XG4gIG1pbi13aWR0aDogODVweDtcbn1cbi52aWV3YWNjb3VudHRhYiAubWFya2V0Y29sb3IgcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYm9yZGVyc3BlYyB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gIG1hcmdpbi1sZWZ0OiAyMHB4O1xuICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG4gIHBhZGRpbmc6IDE4cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VlZjBmNDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgaGVpZ2h0OiAxMjJweDtcbn1cbi52aWV3YWNjb3VudHRhYiAubWFya2V0Y29sb3IgLnNwZW5jZXJjb29ycGF5bWVudCBoMiB7XG4gIGNvbG9yOiAjMzMzMzMzO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYm9yZGVyc3BlY2NvbXBhbnljb2xvciB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gIG1hcmdpbi1sZWZ0OiAyMHB4O1xuICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VlZjBmNDtcbiAgbWluLWhlaWdodDogOTBweDtcbiAgcGFkZGluZzogMTJweCAyNnB4IDI2cHggMjZweDtcbiAgYm9yZGVyOiBub25lO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAubmV4dHJlbmV3YWwge1xuICBsaW5lLWhlaWdodDogMjVweDtcbn1cbi52aWV3YWNjb3VudHRhYiAubWFya2V0Y29sb3IgLm5leHRyZW5ld2FsIHNwYW4ge1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBjb2xvcjogIzMzNjZmZjtcbn1cbi52aWV3YWNjb3VudHRhYiAubWFya2V0Y29sb3IgLndpZHRoY29tcHNhbGUge1xuICB3aWR0aDogMzIlO1xuICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZGFkYWRhO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYWZ0ZXJjb2xvciB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYWZ0ZXJjb2xvcjo6YWZ0ZXIge1xuICBmb250LWZhbWlseTogXCJiZ2ktaWNvblwiICFpbXBvcnRhbnQ7XG4gIGZvbnQtc3R5bGU6IG5vcm1hbDtcbiAgZm9udC13ZWlnaHQ6IG5vcm1hbDtcbiAgZm9udC12YXJpYW50OiBub3JtYWw7XG4gIHRleHQtdHJhbnNmb3JtOiBub25lO1xuICBsaW5lLWhlaWdodDogMTtcbiAgLXdlYmtpdC1mb250LXNtb290aGluZzogYW50aWFsaWFzZWQ7XG4gIC1tb3otb3N4LWZvbnQtc21vb3RoaW5nOiBncmF5c2NhbGU7XG4gIGNvbnRlbnQ6IFwi7qSIXCI7XG4gIHRyYW5zZm9ybTogcm90YXRlKDI2N2RlZyk7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgY29sb3I6ICMzMzY2ZmY7XG4gIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgaGVpZ2h0OiAyNXB4O1xuICB3aWR0aDogMjZweDtcbiAgYm9yZGVyLXJhZGl1czogNTAlO1xuICB0b3A6IC0ycHg7XG4gIGZvbnQtc2l6ZTogOHB4O1xuICBsaW5lLWhlaWdodDogMjZweDtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAudmFsdWVjb2xvciB7XG4gIGNvbG9yOiAjZjA4MjM1O1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYWxpZ25lbmQge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAud2lkdGhsb2FkIHtcbiAgd2lkdGg6IDUwJTtcbn1cbi52aWV3YWNjb3VudHRhYiAubWFya2V0Y29sb3IgLnNwZW5jZXJjb29ycGF5bWVudGNsYXNzaWZpY2F0aW9uIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBwYWRkaW5nOiAxMnB4O1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb24gcCB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgbWFyZ2luLWxlZnQ6IDIwcHg7XG4gIG1pbi1oZWlnaHQ6IDUwcHg7XG4gIGJvcmRlci1ib3R0b206IG5vbmU7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XG59XG4udmlld2FjY291bnR0YWIgLm1hcmtldGNvbG9yIC5hY3RpdmVzY3JvbGwgLm1hdC10YWItYm9keS5tYXQtdGFiLWJvZHktYWN0aXZlIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBvdmVyZmxvdy14OiBoaWRkZW47XG4gIG92ZXJmbG93LXk6IGluaGVyaXQ7XG4gIHotaW5kZXg6IDE7XG4gIGZsZXgtZ3JvdzogMTtcbn1cbi52aWV3YWNjb3VudHRhYiAubWFya2V0Y29sb3IgLnByb2plY3Rib3JkZXIge1xuICBib3JkZXItdG9wOiBub25lO1xuICBib3JkZXItbGVmdDogMXB4IHNvbGlkICNkYWRhZGE7XG4gIGJvcmRlci1yaWdodDogMXB4IHNvbGlkICNkYWRhZGE7XG4gIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGFkYWRhO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkYW5vdGhlciB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gIG1hcmdpbi1sZWZ0OiAxNXB4O1xuICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG4gIG1pbi1oZWlnaHQ6IDUwcHg7XG4gIGJvcmRlci1ib3R0b206IG5vbmU7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XG59XG4udmlld2FjY291bnR0YWIgLm1hcmtldGNvbG9yIC5lbWFpbGFsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbn1cbi52aWV3YWNjb3VudHRhYiAubWFya2V0Y29sb3IgLmluZm9jbXByYXRpbmcge1xuICBjb2xvcjogIzMzMzMzMztcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG59XG4udmlld2FjY291bnR0YWIgLm1hcmtldGNvbG9yIC5sYWJlbGNtcGFmdGVyIHtcbiAgY29sb3I6ICM5OTk5OTk7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4udmlld2FjY291bnR0YWIgLm1hcmtldGNvbG9yIC5zYXZlIHtcbiAgd2lkdGg6IDE1MnB4O1xuICBoZWlnaHQ6IDQycHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnZpZXdhY2NvdW50dGFiIC5tYXJrZXRjb2xvciAuYWxpZ25lbmRzYXZlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cblxuQG1lZGlhIChtYXgtd2lkdGg6IDEwMjRweCkgYW5kIChtaW4td2lkdGg6IDc2OXB4KSB7XG4gIC5hZnRlcm5leHQ6OmFmdGVyIHtcbiAgICBjb250ZW50OiBcIlwiO1xuICAgIGJvcmRlci10b3A6IDE4cHggc29saWQgIzM0NWY5ZjtcbiAgICBib3JkZXItbGVmdDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcbiAgICBib3JkZXItcmlnaHQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XG4gICAgcG9zaXRpb246IGFic29sdXRlO1xuICAgIGJvdHRvbTogMTg4cHg7XG4gICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICBsZWZ0OiAxNTdweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnZpZXdhY2NvdW50dGFiIHtcbiAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC53aWR0aGZvcm0ge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhjb21wIHtcbiAgICB3aWR0aDogNTYlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc2VjdXJpdHloZWFkZXIge1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gICAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xuICAgIG1heC13aWR0aDogODMuMzMlO1xuICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICAgIG1hcmdpbi1yaWdodDogYXV0bztcbiAgfVxuXG4gIC5uZXh0cmVuZXdhbCB7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC53aWR0aGNvbXBzYWxlIHtcbiAgICB3aWR0aDogNDAlICFpbXBvcnRhbnQ7XG4gICAgYm9yZGVyLXJpZ2h0OiBub25lICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhjb21wbWFpbiB7XG4gICAgd2lkdGg6IDM0JSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwZW5jZXJjb29ycGF5bWVudGNsYXNzaWZpY2F0aW9uIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICAgIHBhZGRpbmc6IDEycHg7XG4gIH1cblxuICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkIHtcbiAgICBib3JkZXI6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xuICAgIG1pbi1oZWlnaHQ6IDg0cHggIWltcG9ydGFudDtcbiAgICBib3JkZXItYm90dG9tOiBub25lO1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XG4gIH1cblxuICAuYWxpZ25wYXNzd29yZCB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwYWNlYnRuIHtcbiAgICBtYXJnaW4tdG9wOiAxMHB4O1xuICB9XG5cbiAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZGFub3RoZXIge1xuICAgIG1pbi1oZWlnaHQ6IDg0cHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiBoNCB7XG4gICAgY29sb3I6ICMzMzMzMzM7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiB7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgICBtYXJnaW4tbGVmdDogNzhweDtcbiAgICBtYXJnaW4tcmlnaHQ6IDc4cHg7XG4gICAgaGVpZ2h0OiA1NDRweDtcbiAgICBvdmVyZmxvdzogaGlkZGVuO1xuICAgIG1hcmdpbi10b3A6IDMwcHg7XG4gICAgYm9yZGVyLXJhZGl1czogNHB4O1xuICB9XG4gIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiBoNCB7XG4gICAgY29sb3I6ICMzMzMzMzM7XG4gIH1cblxuICAuYmFja2dyb3VuZCBoNCB7XG4gICAgY29sb3I6ICMzMzMzMzM7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gIC5sYWJlbGNtcCB7XG4gICAgY29sb3I6ICM5OTk7XG4gICAgZm9udC1zaXplOiAwLjkzNzVyZW07XG4gICAgZGlzcGxheTogYmxvY2s7XG4gICAgbWluLXdpZHRoOiAxMjBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmFmdGVybmV4dDo6YWZ0ZXIge1xuICAgIGNvbnRlbnQ6IFwiXCI7XG4gICAgYm9yZGVyLXRvcDogMThweCBzb2xpZCAjMzQ1ZjlmO1xuICAgIGJvcmRlci1sZWZ0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xuICAgIGJvcmRlci1yaWdodDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gICAgYm90dG9tOiAyODhweCAhaW1wb3J0YW50O1xuICAgIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoLTE4MGRlZyk7XG4gICAgdHJhbnNmb3JtOiByb3RhdGUoLTE4MGRlZyk7XG4gICAgbGVmdDogNDhweDtcbiAgfVxuXG4gIC53aWR0aGNvbXAge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhjb21wbWFpbiB7XG4gICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxuXG4gIC5ib3JkZXJzcGVjaGVpZ2h0IHtcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2VlZjBmNDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICB9XG5cbiAgLndpZHRodXNlcmJ0biB7XG4gICAgbWF4LXdpZHRoOiA2MiUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5ib3JkZXJlbWFpbCB7XG4gICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gICAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICAgIGJvcmRlci1yaWdodDogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gICAgYm9yZGVyLXRvcDogbm9uZTtcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoY29tcCB7XG4gICAgd2lkdGg6IDU4JSAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmctYm90dG9tOiAxMnB4O1xuICB9XG5cbiAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Ige1xuICAgIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gICAgbWFyZ2luLWxlZnQ6IDIwcHg7XG4gICAgbWFyZ2luLXJpZ2h0OiAyMHB4O1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2VlZjBmNDtcbiAgICBwYWRkaW5nOiAxMnB4IDI2cHggMjZweCAyNnB4O1xuICAgIGJvcmRlcjogbm9uZTtcbiAgICBtaW4taGVpZ2h0OiAxMjVweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLm5leHRyZW5ld2FsIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmctdG9wOiAxMHB4O1xuICB9XG5cbiAgLndpZHRoY29tcHNhbGUge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gICAgYm9yZGVyLXJpZ2h0OiBub25lICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb24ge1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgICBwYWRkaW5nOiAxMnB4O1xuICB9XG5cbiAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZCB7XG4gICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgICBtYXJnaW4tbGVmdDogMjBweDtcbiAgICBtaW4taGVpZ2h0OiAxMDZweCAhaW1wb3J0YW50O1xuICAgIGJvcmRlci1ib3R0b206IG5vbmU7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2VlZjBmNDtcbiAgfVxuXG4gIC5zcGFjZWJ0biB7XG4gICAgbWFyZ2luLXRvcDogMTBweDtcbiAgfVxuXG4gIC5hbGlnbnBhc3N3b3JkIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNtcG55aW5mbyB7XG4gICAgbWFyZ2luLWJvdHRvbTogMTA7XG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICAgIGxpbmUtaGVpZ2h0OiAyNXB4O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1ib3R0b206IDEwcHg7XG4gIH1cblxuICAuc2VjdXJpdHloZWFkZXIge1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gICAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwY2VzbWUge1xuICAgIHBhZGRpbmctYm90dG9tOiAxMzVweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoZm9ybSB7XG4gICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiB7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgICBtYXJnaW4tbGVmdDogNzhweCAhaW1wb3J0YW50O1xuICAgIG1hcmdpbi1yaWdodDogNzhweCAhaW1wb3J0YW50O1xuICAgIGhlaWdodDogNjYycHggIWltcG9ydGFudDtcbiAgICBvdmVyZmxvdzogaGlkZGVuO1xuICAgIG1hcmdpbi10b3A6IDMwcHg7XG4gICAgYm9yZGVyLXJhZGl1czogNHB4O1xuICB9XG4gIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiBoNCB7XG4gICAgY29sb3I6ICMzMzMzMzM7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5iYWNrZ3JvdW5kIHtcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICAgIG1hcmdpbi1sZWZ0OiA3OHB4O1xuICAgIG1hcmdpbi1yaWdodDogNzhweDtcbiAgICBoZWlnaHQ6IDUyMHB4O1xuICAgIG92ZXJmbG93OiBoaWRkZW47XG4gICAgbWFyZ2luLXRvcDogMzBweDtcbiAgICBib3JkZXItcmFkaXVzOiA0cHg7XG4gIH1cbiAgLmJhY2tncm91bmQgaDQge1xuICAgIGNvbG9yOiAjMzMzMzMzO1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA2MDBweCkge1xuICAuYm9yZGVyX2J0biBwIHtcbiAgICB0ZXh0LWFsaWduOiBsZWZ0ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLWJvdHRvbTogMTBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmJhY2tncm91bmRuZXh0ZGVzaWduIHtcbiAgICBoZWlnaHQ6IDgyM3B4ICFpbXBvcnRhbnQ7XG4gICAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgICBtYXJnaW4tdG9wOiAzMHB4O1xuICAgIGJvcmRlci1yYWRpdXM6IDRweDtcbiAgfVxuICAuYmFja2dyb3VuZG5leHRkZXNpZ24gaDQge1xuICAgIGNvbG9yOiAjMzMzMzMzO1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYmFja2dyb3VuZCB7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgICBtYXJnaW4tbGVmdDogNzhweDtcbiAgICBtYXJnaW4tcmlnaHQ6IDc4cHg7XG4gICAgaGVpZ2h0OiA3MDJweCAhaW1wb3J0YW50O1xuICAgIG92ZXJmbG93OiBoaWRkZW47XG4gICAgbWFyZ2luLXRvcDogMzBweDtcbiAgICBib3JkZXItcmFkaXVzOiA0cHg7XG4gIH1cbiAgLmJhY2tncm91bmQgaDQge1xuICAgIGNvbG9yOiAjMzMzMzMzO1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYnRucmVzcG9uc2l2ZSB7XG4gICAgZGlzcGxheTogY29udGVudHM7XG4gIH1cblxuICAuYmxvY2tyZXNwb25zaXZld2lkdGgge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc3VibWl0Y29udGVudHdpZHRoIHtcbiAgICBkaXNwbGF5OiBjb250ZW50cztcbiAgfVxuXG4gIC5zcGFjaW5nZmlsZWQge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cblxuICAuYmFja2dyb3VuZG5leHRkZXNpZ24ge1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gICAgbWFyZ2luLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tcmlnaHQ6IDEwcHggIWltcG9ydGFudDtcbiAgICBoZWlnaHQ6IDg1MHB4ICFpbXBvcnRhbnQ7XG4gICAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgICBtYXJnaW4tdG9wOiAzMHB4O1xuICAgIGJvcmRlci1yYWRpdXM6IDRweDtcbiAgfVxuICAuYmFja2dyb3VuZG5leHRkZXNpZ24gaDQge1xuICAgIGNvbG9yOiAjMzMzMzMzO1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYmxvY2thbGlnbiB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuXG4gIC52ZXJmaWVkb25yZXNwb25zaXZld2lkdGgge1xuICAgIG1heC13aWR0aDogODAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAudmVyZmllZGFsaWduIHNwYW4ge1xuICAgIGNvbG9yOiAjNzBjMDE1O1xuICAgIHBhZGRpbmctbGVmdDogNnB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuaW1hZ2VhbGlnbiB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGNvbG9yOiBibGFjaztcbiAgfVxuICAuaW1hZ2VhbGlnbiBpbWcge1xuICAgIHBhZGRpbmctbGVmdDogNHB4O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY2cHgpIGFuZCAobWluLXdpZHRoOiAzMThweCkge1xuICAuY21wbnlpbmZvIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnJlc3BvbnNpdmVwYWRkaW5nd2lkdGgge1xuICAgIHBhZGRpbmctbGVmdDogMThweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmZsZXhhbGlnbiB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIH1cbiAgLmZsZXhhbGlnbiAuYmFja2dyb3VuZG5leHRkZXNpZ24ge1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gICAgbWFyZ2luLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tcmlnaHQ6IDEwcHggIWltcG9ydGFudDtcbiAgICBvdmVyZmxvdzogaGlkZGVuO1xuICAgIG1hcmdpbi10b3A6IDMwcHg7XG4gICAgYm9yZGVyLXJhZGl1czogNHB4O1xuICB9XG4gIC5mbGV4YWxpZ24gLmJhY2tncm91bmRuZXh0ZGVzaWduIGg0IHtcbiAgICBjb2xvcjogIzMzMzMzMztcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG4gIC5mbGV4YWxpZ24gLmZsZXhhbGlnbiB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIH1cbiAgLmZsZXhhbGlnbiAucmVzcG9uc2l2ZXBhZGRpbmcge1xuICAgIHBhZGRpbmctbGVmdDogOHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc3BlbmNlcmNvb3Ige1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIH1cblxuICAuYWxpZ25wYXNzd29yZCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jaGFuZ2Vjb2xvciwgLnZpZXdhY2NvdW50dGFiIC52aWV3cGVybWlzc2lvbiB7XG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgfVxuXG4gIC5wcm9qZWN0Ym9yZGVyIHtcbiAgICBwYWRkaW5nOiAxMnB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYm9yZGVyc3BlY2hlaWdodCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVmMGY0O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAgaGVpZ2h0OiAyNzJweCAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmc6IDEycHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5tYXJrZXRjb2xvciB7XG4gICAgcGFkZGluZy10b3A6IDEwcHg7XG4gIH1cblxuICAuc2VjdXJpdHloZWFkZXIge1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICAgIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC50aXRsZSB7XG4gICAgcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvciB7XG4gICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgICBtYXJnaW4tbGVmdDogMjBweDtcbiAgICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gICAgcGFkZGluZzogMTJweCAxMnB4IDEycHggMTJweDtcbiAgICBib3JkZXI6IG5vbmU7XG4gIH1cblxuICAuYm9yZGVyc3BlYyB7XG4gICAgaGVpZ2h0OiAxNDJweCAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmc6IDEycHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5ib3JkZXJlbWFpbCB7XG4gICAgcGFkZGluZy1sZWZ0OiAxMnB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhpbWdjaGVjayB7XG4gICAgcGFkZGluZy1sZWZ0OiAycHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5hbGlnbmVuZCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBoZWlnaHQ6IDEwMCU7XG4gIH1cblxuICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkIHtcbiAgICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG4gIH1cblxuICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkYW5vdGhlciB7XG4gICAgbWFyZ2luLXRvcDogMTY4cHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tbGVmdDogMjBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwY2VzbWUge1xuICAgIHBhZGRpbmctYm90dG9tOiAxNDhweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZGFub3RoZXIge1xuICAgIG1pbi1oZWlnaHQ6IDExNnB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhsb2FkIHtcbiAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmFsaWduZW5kc2F2ZSB7XG4gICAgZGlzcGxheTogYmxvY2s7XG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gICAgbWFyZ2luLWxlZnQ6IDEycHg7XG4gIH1cblxuICAuY2FuY2VsIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLndpZHRoZm9ybSB7XG4gICAgcGFkZGluZy1sZWZ0OiAxMnB4ICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1yaWdodDogMTJweCAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNDE0cHgpIGFuZCAobWluLXdpZHRoOiA0MTJweCkge1xuICAuYWxpZ25lbmRzYXZlIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICAgIG1hcmdpbi1sZWZ0OiAxMnB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5wYWNrYWxpZ24ge1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA0MTRweCkgYW5kIChtaW4td2lkdGg6IDM3NXB4KSB7XG4gIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yZG93bmxvYWRhbm90aGVyIHtcbiAgICBtaW4taGVpZ2h0OiA5NHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkIHtcbiAgICBtaW4taGVpZ2h0OiA5NHB4ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiAxMjgwcHgpIGFuZCAobWluLXdpZHRoOiAxMjc4cHgpIHtcbiAgLndpZHRoY29tcG1haW4ge1xuICAgIHdpZHRoOiAzMiUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC53aWR0aGNvbXBzYWxlIHtcbiAgICB3aWR0aDogMzYlICFpbXBvcnRhbnQ7XG4gICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2RhZGFkYTtcbiAgfVxufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC5tYXQtdGFiLWdyb3VwIHtcbiAgcGFkZGluZy10b3A6IDI1cHg7XG59XG4jdGFiZm9yY2hhbmdldXNlcnMgLm1hdC10YWItYm9keS1jb250ZW50IHtcbiAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC5tYXQtaW5rLWJhciB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jdGFiZm9yY2hhbmdldXNlcnMgLm1hdC10YWItaGVhZGVyIHtcbiAgYm9yZGVyLWJvdHRvbTogbm9uZTtcbiAgYmFja2dyb3VuZDogbm9uZSAhaW1wb3J0YW50O1xuICBjb2xvcjogIzMzMztcbn1cbiN0YWJmb3JjaGFuZ2V1c2VycyAubWF0LXRhYi1sYWJlbHMge1xuICB3aWR0aDogMTAwJTtcbiAgb3BhY2l0eTogMTtcbn1cbiN0YWJmb3JjaGFuZ2V1c2VycyAubWF0LXRhYi1sYWJlbCB7XG4gIHdpZHRoOiAxMDAlO1xuICBvcGFjaXR5OiAxO1xuICBtaW4taGVpZ2h0OiA5MHB4ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQ6ICNlOGViZWY7XG4gIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG4gIHBhZGRpbmctbGVmdDogMTBweDtcbiAgYm9yZGVyOiAxcHggc29saWQgI2U4ZWJlZjtcbiAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcbn1cbiN0YWJmb3JjaGFuZ2V1c2VycyAubWF0LXRhYi1sYWJlbDpmaXJzdC1jaGlsZCB7XG4gIG1hcmdpbi1yaWdodDogMTVweDtcbn1cbiN0YWJmb3JjaGFuZ2V1c2VycyAubWF0LXRhYi1saXN0IHtcbiAgcGFkZGluZzogMCAhaW1wb3J0YW50O1xuICBvcGFjaXR5OiAxO1xuICBtYXJnaW4tYm90dG9tOiAxNXB4O1xuICBtYXJnaW4tYm90dG9tOiAxNXB4ICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbn1cbiN0YWJmb3JjaGFuZ2V1c2VycyAubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xuICBib3JkZXItYm90dG9tOiBub25lICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICM0YWExYWMgIWltcG9ydGFudDtcbiAgLXdlYmtpdC1ib3gtc2hhZG93OiAwIDAgOXB4IHJnYmEoMCwgMCwgMCwgMC4xNSk7XG4gIC1tb3otYm94LXNoYWRvdzogMCAwIDlweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xuICBib3gtc2hhZG93OiAwIDAgOXB4IHJnYmEoMCwgMCwgMCwgMC4xNSk7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNlMWRlZGU7XG4gIGJvcmRlci1ib3R0b206IG5vbmUgIWltcG9ydGFudDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSAudGFic2VsZWN0aGVhZGVyY29udGVudCAuc2VsZWN0aW9udGV4dCBoNCB7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG4jdGFiZm9yY2hhbmdldXNlcnMgLm1hdC10YWItbGFiZWwtYWN0aXZlIC50YWJzZWxlY3RoZWFkZXJjb250ZW50IC5zZWxlY3Rpb250ZXh0IHAge1xuICBjb2xvcjogIzkwYjRlYSAhaW1wb3J0YW50O1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSAubWF0LXRhYi1sYWJlbC1jb250ZW50IHtcbiAgY29sb3I6ICNmZmY7XG59XG4jdGFiZm9yY2hhbmdldXNlcnMgLnRhYnNlbGVjdGhlYWRlcmNvbnRlbnQge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC50YWJzZWxlY3RoZWFkZXJjb250ZW50IC5zZWxlY3Rpb250ZXh0IHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDY1cHgpO1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC50YWJzZWxlY3RoZWFkZXJjb250ZW50IC5zZWxlY3Rpb25sb2dvIHtcbiAgd2lkdGg6IDUwcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC50YWJzZWxlY3RoZWFkZXJjb250ZW50IC5zZWxlY3Rpb25sb2dvIGkge1xuICBmb250LXNpemU6IDEuODc1cmVtO1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC50YWJzZWxlY3RoZWFkZXJjb250ZW50IGg0IHtcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG4gIGNvbG9yOiAjMzU0MDUyO1xuICBmb250LWZhbWlseTogXCJjYWlyb3JlZ3VsYXJcIjtcbiAgbWFyZ2luOiAwO1xuICB3aGl0ZS1zcGFjZTogbm9ybWFsICFpbXBvcnRhbnQ7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG59XG4jdGFiZm9yY2hhbmdldXNlcnMgLnRhYnNlbGVjdGhlYWRlcmNvbnRlbnQgcCB7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbiAgY29sb3I6ICM3ZjhmYTQ7XG4gIG1hcmdpbjogMDtcbiAgd2hpdGUtc3BhY2U6IG5vcm1hbCAhaW1wb3J0YW50O1xuICB0ZXh0LWFsaWduOiBsZWZ0O1xufVxuI3RhYmZvcmNoYW5nZXVzZXJzIC5tYXQtdGFiLWJvZHktd3JhcHBlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJvcmRlci10b3A6IG5vbmU7XG59XG5cbltkaXI9cnRsXSAudmlld2FjY291bnR0YWIgLnVzZXJjb2xvciB7XG4gIG1hcmdpbi1yaWdodDogMTBweCAhaW1wb3J0YW50O1xufSIsIkBtaXhpbiBmbGV4Y2VudGVyIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcbkBtaXhpbiBmbGV4c3RhcnQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcbkBtaXhpbiBmbGV4ZW5kIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuQG1peGluIHNwYWNlYmV0d2VlbiB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuQG1peGluIG1hcmdpbnplcm8ge1xyXG4gICAgbWFyZ2luOiAwO1xyXG4gICAgd2hpdGUtc3BhY2U6IG5vcm1hbCAhaW1wb3J0YW50O1xyXG4gICAgdGV4dC1hbGlnbjogbGVmdDtcclxufVxyXG5cclxuLmNoYW5nZXVzZXJsb2FkZXJ2aWV3IHtcclxuICAgIC5tYXQtZGlhbG9nLWNvbnRhaW5lciB7XHJcbiAgICAgICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcclxuICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xyXG5cclxuICAgIH1cclxuICBcclxuICAgIC5sb2FkZXJyZXNwb25lIHtcclxuICAgICAgICBwb3NpdGlvbjogZml4ZWQgIWltcG9ydGFudDtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBsZWZ0OiA1MCUgIWltcG9ydGFudDtcclxuICAgICAgICB0b3A6IDUwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgIHRyYW5zZm9ybTogdHJhbnNsYXRlKC01MCUsLTUwJSkgIWltcG9ydGFudDtcclxuICAgICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgICAgei1pbmRleDogOTk5OTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYSgwLCAwLCAwLCAwLjcpO1xyXG4gICAgfVxyXG59XHJcbi52aWV3YWNjb3VudHRhYiB7XHJcbiAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgIG1hcmdpbi1yaWdodDogYXV0bztcclxuICAgIG1heC13aWR0aDogODMuMzMlO1xyXG4gICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgIC52ZXJpZmllZGNvbnRlbnR7XHJcbiAgICAgICAgYmFja2dyb3VuZDogIzYzYTEyNjtcclxuICAgICAgICBtaW4td2lkdGg6IDgwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiAyMnB4O1xyXG4gICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDNweDtcclxuICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgICAgZm9udC1zaXplOiAxM3B4O1xyXG4gICAgICAgIGl7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxNnB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDE2cHg7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDUwJTtcclxuICAgICAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICAgICAgICBjb2xvcjogIzYzYTEyNjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmRpc2FjdGl2ZXtcclxuICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgfVxyXG4gICAgLnNwYWNld2hpdGVzcGFjZXtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTYwcHg7XHJcbiAgICAgfVxyXG4gICAgLmJvcmRlcnNwZWNoZWlnaHQge1xyXG4gICAgICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMjBweDtcclxuICAgICAgICBwYWRkaW5nOiAyMHB4O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICB9XHJcbiAgICAuZG9tYWluY29sb3Ige1xyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICB9XHJcbiAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZDlhNTVkO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5idG5hbGlnbiB7XHJcbiAgICAgICAgcCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5jb2xvcmFjdGl2ZSB7XHJcbiAgICAgICAgZm9udC13ZWlnaHQ6IG5vcm1hbCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICM1ODYyNmU7XHJcbiAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogNHB4O1xyXG4gICAgICAgIHBhZGRpbmc6IDAgMTBweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICB9XHJcblxyXG4gICAgLmFsaWducGFzc3dvcmQge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgIH1cclxuICAgIC5ib3JkZXJlbWFpbCB7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIGJvcmRlci1yaWdodDogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgYm9yZGVyLXRvcDogbm9uZTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAyMHB4O1xyXG4gICAgfVxyXG4gICAgLmNoYW5nZWNvbG9yIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjNmZWZmO1xyXG4gICAgICAgIGNvbG9yOiAjNGFhMWFjO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBoZWlnaHQ6IDI2cHg7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxNDBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjNGFhMWFjO1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcl9idG57XHJcblxyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMTBweDtcclxuICAgIH1cclxuICAgIC52aWV3cGVybWlzc2lvbntcclxuICAgICAgICAgQGV4dGVuZCAuY2hhbmdlY29sb3I7XHJcbiAgICAgICAgIGJhY2tncm91bmQ6ICM0YWExYWMgIWltcG9ydGFudDtcclxuICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAudXNlcmNvbG9yIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNGFhMWFjO1xyXG4gICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBsaW5lLWhlaWdodDogMTJweDtcclxuICAgICAgICBoZWlnaHQ6IDI2cHg7XHJcbiAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgfVxyXG4gICAgLnNwZW5jZXJjb29yIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAud2lkdGhjb21wIHtcclxuICAgICAgICB3aWR0aDogNTAlO1xyXG4gICAgfVxyXG5cclxuICAgIC53aWR0aGNvbXBtYWluIHtcclxuICAgICAgICB3aWR0aDogMzQlO1xyXG4gICAgfVxyXG4gICAgLmNtcG55aW5mbyB7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGxpbmUtaGVpZ2h0OiAyNXB4O1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiA4cHg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgLndpZHRoaW1nY2hlY2sge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgICAgICB3aWR0aDogMjBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiAxOHB4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5mbGFnd2lkdGhjb2Rle1xyXG4gICAgICAgIHdpZHRoOiAzMHB4O1xyXG4gICAgfVxyXG4gICAgLmxhYmVsY21wIHtcclxuICAgICAgICBtaW4td2lkdGg6IDg1cHg7XHJcbiAgICB9XHJcbiAgICAubWFya2V0Y29sb3Ige1xyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5ib3JkZXJzcGVjIHtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMjBweDtcclxuICAgICAgICAgICAgcGFkZGluZzogMThweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVmMGY0O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDEyMnB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnNwZW5jZXJjb29ycGF5bWVudCB7XHJcbiAgICAgICAgICAgIGgyIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yIHtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMjBweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVmMGY0O1xyXG4gICAgICAgICAgICBtaW4taGVpZ2h0OiA5MHB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nOiAxMnB4IDI2cHggMjZweCAyNnB4O1xyXG4gICAgICAgICAgICBib3JkZXI6IG5vbmU7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubmV4dHJlbmV3YWwge1xyXG4gICAgICAgICAgICBsaW5lLWhlaWdodDogMjVweDtcclxuICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzY2ZmY7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC53aWR0aGNvbXBzYWxlIHtcclxuICAgICAgICAgICAgd2lkdGg6IDMyJTtcclxuICAgICAgICAgICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2RhZGFkYTtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmFmdGVyY29sb3Ige1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5hZnRlcmNvbG9yOjphZnRlciB7XHJcbiAgICAgICAgICAgIGZvbnQtZmFtaWx5OiBcImJnaS1pY29uXCIgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgZm9udC1zdHlsZTogbm9ybWFsO1xyXG4gICAgICAgICAgICBmb250LXdlaWdodDogbm9ybWFsO1xyXG4gICAgICAgICAgICBmb250LXZhcmlhbnQ6IG5vcm1hbDtcclxuICAgICAgICAgICAgdGV4dC10cmFuc2Zvcm06IG5vbmU7XHJcbiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgICAgICAgICAtd2Via2l0LWZvbnQtc21vb3RoaW5nOiBhbnRpYWxpYXNlZDtcclxuICAgICAgICAgICAgLW1vei1vc3gtZm9udC1zbW9vdGhpbmc6IGdyYXlzY2FsZTtcclxuICAgICAgICAgICAgY29udGVudDogXCJcXGU5MDhcIjtcclxuXHJcbiAgICAgICAgICAgIHRyYW5zZm9ybTogcm90YXRlKDI2N2RlZyk7XHJcbiAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzY2ZmY7XHJcbiAgICAgICAgICAgIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgaGVpZ2h0OiAyNXB4O1xyXG4gICAgICAgICAgICB3aWR0aDogMjZweDtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gICAgICAgICAgICB0b3A6IC0ycHg7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogOHB4O1xyXG4gICAgICAgICAgICBsaW5lLWhlaWdodDogMjZweDtcclxuICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnZhbHVlY29sb3Ige1xyXG4gICAgICAgICAgICBjb2xvcjogI2YwODIzNTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5hbGlnbmVuZCB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC53aWR0aGxvYWQge1xyXG4gICAgICAgICAgICB3aWR0aDogNTAlO1xyXG4gICAgICAgIH1cclxuICAgICAgICAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb24ge1xyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICAgcGFkZGluZzogMTJweDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZCB7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xyXG4gICAgICAgICAgICBtaW4taGVpZ2h0OiA1MHB4O1xyXG4gICAgICAgICAgICBib3JkZXItYm90dG9tOiBub25lO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVmMGY0O1xyXG4gICAgICAgIH1cclxuICAgICAgICAuYWN0aXZlc2Nyb2xsIC5tYXQtdGFiLWJvZHkubWF0LXRhYi1ib2R5LWFjdGl2ZSB7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgb3ZlcmZsb3cteDogaGlkZGVuO1xyXG4gICAgICAgICAgICBvdmVyZmxvdy15OiBpbmhlcml0O1xyXG4gICAgICAgICAgICB6LWluZGV4OiAxO1xyXG4gICAgICAgICAgICBmbGV4LWdyb3c6IDE7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAucHJvamVjdGJvcmRlciB7XHJcbiAgICAgICAgICAgIGJvcmRlci10b3A6IG5vbmU7XHJcbiAgICAgICAgICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2RhZGFkYTtcclxuICAgICAgICAgICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2RhZGFkYTtcclxuICAgICAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkYWRhZGE7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkYW5vdGhlciB7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAxNXB4O1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDIwcHg7XHJcbiAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDUwcHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1ib3R0b206IG5vbmU7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZW1haWxhbGlnbiB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuaW5mb2NtcHJhdGluZyB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmxhYmVsY21wYWZ0ZXIge1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OTk5OTtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnNhdmUge1xyXG4gICAgICAgICAgICB3aWR0aDogMTUycHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDJweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNztcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYWxpZ25lbmRzYXZlIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOiAxMDI0cHgpIGFuZCAobWluLXdpZHRoOiA3NjlweCkge1xyXG4gICAgLmFmdGVybmV4dDo6YWZ0ZXIge1xyXG4gICAgICAgIGNvbnRlbnQ6IFwiXCI7XHJcbiAgICAgICAgYm9yZGVyLXRvcDogMThweCBzb2xpZCAjMzQ1ZjlmO1xyXG4gICAgICAgIGJvcmRlci1sZWZ0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xyXG4gICAgICAgIGJvcmRlci1yaWdodDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgYm90dG9tOiAxODhweDtcclxuICAgICAgICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgIHRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgIGxlZnQ6IDE1N3B4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAudmlld2FjY291bnR0YWJ7XHJcbiAgICAgICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLndpZHRoZm9ybSB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXAge1xyXG4gICAgICAgIHdpZHRoOiA1NiUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5zZWN1cml0eWhlYWRlciB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA4My4zMyU7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IGF1dG87XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgfVxyXG4gICAgLm5leHRyZW5ld2FsIHtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLndpZHRoY29tcHNhbGUge1xyXG4gICAgICAgIHdpZHRoOiA0MCUgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItcmlnaHQ6IG5vbmUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXBtYWluIHtcclxuICAgICAgICB3aWR0aDogMzQlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb24ge1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgcGFkZGluZzogMTJweDtcclxuICAgIH1cclxuICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yZG93bmxvYWQge1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgbWluLWhlaWdodDogODRweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlci1ib3R0b206IG5vbmU7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VlZjBmNDtcclxuICAgIH1cclxuICAgIC5hbGlnbnBhc3N3b3JkIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc3BhY2VidG4ge1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2FkYW5vdGhlciB7XHJcbiAgICAgICAgbWluLWhlaWdodDogODRweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmJhY2tncm91bmRuZXh0ZGVzaWduIHtcclxuICAgICAgICBoNCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBtYXJnaW4tbGVmdDogNzhweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDc4cHg7XHJcbiAgICAgICAgaGVpZ2h0OiA1NDRweDtcclxuICAgICAgICBvdmVyZmxvdzogaGlkZGVuO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogNHB4O1xyXG4gICAgICAgIGg0IHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmJhY2tncm91bmQge1xyXG4gICAgICAgIGg0IHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgLmxhYmVsY21wIHtcclxuICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBtaW4td2lkdGg6IDEyMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYWZ0ZXJuZXh0OjphZnRlciB7XHJcbiAgICAgICAgY29udGVudDogXCJcIjtcclxuICAgICAgICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICMzNDVmOWY7XHJcbiAgICAgICAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xyXG4gICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICBib3R0b206IDI4OHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcclxuICAgICAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcclxuICAgICAgICBsZWZ0OiA0OHB4O1xyXG4gICAgfVxyXG4gICAgLndpZHRoY29tcCB7XHJcbiAgICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAud2lkdGhjb21wbWFpbiB7XHJcbiAgICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuYm9yZGVyc3BlY2hlaWdodCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuICAgIC53aWR0aHVzZXJidG4ge1xyXG4gICAgICAgIG1heC13aWR0aDogNjIlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYm9yZGVyZW1haWwge1xyXG4gICAgICAgIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIGJvcmRlci10b3A6IG5vbmU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXAge1xyXG4gICAgICAgIHdpZHRoOiA1OCUgIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTJweDtcclxuICAgIH1cclxuICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yIHtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMjBweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XHJcbiAgICAgICAgcGFkZGluZzogMTJweCAyNnB4IDI2cHggMjZweDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcbiAgICAgICAgbWluLWhlaWdodDogMTI1cHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5uZXh0cmVuZXdhbCB7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMTBweDtcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXBzYWxlIHtcclxuICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlci1yaWdodDogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnNwZW5jZXJjb29ycGF5bWVudGNsYXNzaWZpY2F0aW9uIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgcGFkZGluZzogMTJweDtcclxuICAgIH1cclxuICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yZG93bmxvYWQge1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgbWluLWhlaWdodDogMTA2cHggIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItYm90dG9tOiBub25lO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XHJcbiAgICB9XHJcbiAgICAuc3BhY2VidG4ge1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuYWxpZ25wYXNzd29yZCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jbXBueWluZm8ge1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDEwO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICBsaW5lLWhlaWdodDogMjVweDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5zZWN1cml0eWhlYWRlciB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc3BjZXNtZSB7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDEzNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAud2lkdGhmb3JtIHtcclxuICAgICAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmJhY2tncm91bmRuZXh0ZGVzaWduIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiA3OHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiA3OHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgaGVpZ2h0OiA2NjJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMzBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgaDQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYmFja2dyb3VuZCB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBtYXJnaW4tbGVmdDogNzhweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDc4cHg7XHJcbiAgICAgICAgaGVpZ2h0OiA1MjBweDtcclxuICAgICAgICBvdmVyZmxvdzogaGlkZGVuO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogNHB4O1xyXG4gICAgICAgIGg0IHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNjAwcHgpIHtcclxuICAgICAgLmJvcmRlcl9idG57XHJcbiAgICAgICAgIHB7XHJcbiAgICAgICAgICAgIHRleHQtYWxpZ246IGxlZnQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiB7XHJcbiAgICAgICAgaGVpZ2h0OiA4MjNweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMzBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgaDQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYmFja2dyb3VuZCB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBtYXJnaW4tbGVmdDogNzhweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDc4cHg7XHJcbiAgICAgICAgaGVpZ2h0OiA3MDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMzBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgaDQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYnRucmVzcG9uc2l2ZSB7XHJcbiAgICAgICAgZGlzcGxheTogY29udGVudHM7XHJcbiAgICB9XHJcbiAgICAuYmxvY2tyZXNwb25zaXZld2lkdGgge1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc3VibWl0Y29udGVudHdpZHRoIHtcclxuICAgICAgICBkaXNwbGF5OiBjb250ZW50cztcclxuICAgIH1cclxuICAgIC5zcGFjaW5nZmlsZWQge1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuYmFja2dyb3VuZG5leHRkZXNpZ24ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDEwcHggIWltcG9ydGFudDtcclxuICAgICAgICBoZWlnaHQ6IDg1MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgICAgICBtYXJnaW4tdG9wOiAzMHB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDRweDtcclxuICAgICAgICBoNCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5ibG9ja2FsaWduIHtcclxuICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnZlcmZpZWRvbnJlc3BvbnNpdmV3aWR0aCB7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA4MCUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC52ZXJmaWVkYWxpZ24ge1xyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICBjb2xvcjogIzcwYzAxNTtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiA2cHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuaW1hZ2VhbGlnbiB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGNvbG9yOiBibGFjaztcclxuICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDRweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOiA3NjZweCkgYW5kIChtaW4td2lkdGg6IDMxOHB4KSB7XHJcbiAgICAuY21wbnlpbmZvIHtcclxuICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnJlc3BvbnNpdmVwYWRkaW5nd2lkdGgge1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMThweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmZsZXhhbGlnbiB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgLmJhY2tncm91bmRuZXh0ZGVzaWduIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDRweDtcclxuICAgICAgICAgICAgaDQge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5mbGV4YWxpZ24ge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnJlc3BvbnNpdmVwYWRkaW5nIHtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiA4cHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuc3BlbmNlcmNvb3Ige1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICB9XHJcbiAgICAuYWxpZ25wYXNzd29yZCB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jaGFuZ2Vjb2xvciB7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgIH1cclxuICAgIC5wcm9qZWN0Ym9yZGVyIHtcclxuICAgICAgICBwYWRkaW5nOiAxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYm9yZGVyc3BlY2hlaWdodCB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVmMGY0O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaGVpZ2h0OiAyNzJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIHBhZGRpbmc6IDEycHggIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAubWFya2V0Y29sb3Ige1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiAxMHB4O1xyXG4gICAgfVxyXG4gICAgLnNlY3VyaXR5aGVhZGVyIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogYXV0bztcclxuICAgICAgICBib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAudGl0bGUge1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Ige1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAyMHB4O1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIHBhZGRpbmc6IDEycHggMTJweCAxMnB4IDEycHg7XHJcbiAgICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcnNwZWMge1xyXG4gICAgICAgIGhlaWdodDogMTQycHggIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nOiAxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYm9yZGVyZW1haWwge1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMTJweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLndpZHRoaW1nY2hlY2sge1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYWxpZ25lbmQge1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZCB7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAyMHB4O1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZGFub3RoZXIge1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDE2OHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5zcGNlc21lIHtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTQ4cHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yZG93bmxvYWRhbm90aGVyIHtcclxuICAgICAgICBtaW4taGVpZ2h0OiAxMTZweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLndpZHRobG9hZCB7XHJcbiAgICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5hbGlnbmVuZHNhdmUge1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAxMnB4O1xyXG4gICAgfVxyXG4gICAgLmNhbmNlbCB7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgIH1cclxuICAgIC53aWR0aGZvcm0ge1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDEycHggIWltcG9ydGFudDtcclxuICAgIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDQxNHB4KSBhbmQgKG1pbi13aWR0aDogNDEycHgpIHtcclxuIFxyXG4gICAgLmFsaWduZW5kc2F2ZSB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgICBtYXJnaW4tbGVmdDogMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAucGFja2FsaWduIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNDE0cHgpIGFuZCAobWluLXdpZHRoOiAzNzVweCkge1xyXG4gICAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZGFub3RoZXIge1xyXG4gICAgICAgIG1pbi1oZWlnaHQ6IDk0cHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yZG93bmxvYWQge1xyXG4gICAgICAgIG1pbi1oZWlnaHQ6IDk0cHggIWltcG9ydGFudDtcclxuICAgIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDEyODBweCkgYW5kIChtaW4td2lkdGg6IDEyNzhweCkge1xyXG4gICAgLndpZHRoY29tcG1haW4ge1xyXG4gICAgICAgIHdpZHRoOiAzMiUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXBzYWxlIHtcclxuICAgICAgICB3aWR0aDogMzYlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2RhZGFkYTtcclxuICAgIH1cclxufVxyXG5cclxuXHJcbiN0YWJmb3JjaGFuZ2V1c2VycyB7XHJcbiAgICAubWF0LXRhYi1ncm91cCB7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDI1cHg7XHJcbiAgICB9XHJcbiAgICAubWF0LXRhYi1ib2R5LWNvbnRlbnQge1xyXG4gICAgICAgIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5tYXQtaW5rLWJhciB7XHJcbiAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgIH1cclxuICAgIC5tYXQtdGFiLWhlYWRlciB7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbTogbm9uZTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICB9XHJcbiAgICAubWF0LXRhYi1sYWJlbHMge1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICB9XHJcbiAgICAubWF0LXRhYi1sYWJlbCB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICBtaW4taGVpZ2h0OiA5MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2U4ZWJlZjtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMTBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZThlYmVmO1xyXG4gICAgICAgIGhlaWdodDphdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xyXG4gICAgICAgICY6Zmlyc3QtY2hpbGQge1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDE1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLm1hdC10YWItbGlzdCB7XHJcbiAgICAgICAgcGFkZGluZzogMCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMTVweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICBoZWlnaHQ6YXV0byAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcclxuICAgICAgICBib3JkZXItYm90dG9tOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzRhYTFhYyAhaW1wb3J0YW50O1xyXG4gICAgICAgIC13ZWJraXQtYm94LXNoYWRvdzogMCAwIDlweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xyXG4gICAgICAgIC1tb3otYm94LXNoYWRvdzogMCAwIDlweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xyXG4gICAgICAgIGJveC1zaGFkb3c6IDAgMCA5cHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCByZ2IoMjI1LCAyMjIsIDIyMik7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAudGFic2VsZWN0aGVhZGVyY29udGVudCB7XHJcbiAgICAgICAgICAgIC5zZWxlY3Rpb250ZXh0IGg0IHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnNlbGVjdGlvbnRleHQgcCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzkwYjRlYSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtdGFiLWxhYmVsLWNvbnRlbnQge1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAudGFic2VsZWN0aGVhZGVyY29udGVudCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAuc2VsZWN0aW9udGV4dFxyXG4gICAgICAgIHtcclxuICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDY1cHgpO1xyXG4gICAgICAgIH1cclxuICAgICAgICAuc2VsZWN0aW9ubG9nbyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgaSB7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDEuODc1cmVtO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGg0IHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzU0MDUyO1xyXG4gICAgICAgICAgICBmb250LWZhbWlseTogXCJjYWlyb3JlZ3VsYXJcIjtcclxuICAgICAgICAgICAgQGluY2x1ZGUgbWFyZ2luemVybygpO1xyXG4gICAgICAgIH1cclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgICAgICAgICBjb2xvcjogIzdmOGZhNDtcclxuICAgICAgICAgICAgQGluY2x1ZGUgbWFyZ2luemVybygpO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5tYXQtdGFiLWJvZHktd3JhcHBlciB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXItdG9wOiBub25lO1xyXG4gICAgfVxyXG5cclxufVxyXG5cclxuXHJcblxyXG4gICAgICAgIFxyXG5bZGlyPXJ0bF17XHJcbiAgICAudmlld2FjY291bnR0YWJ7XHJcbiAgICAgICAgLnVzZXJjb2xvcntcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICBcclxuICAgXHJcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/securitydetail/securitydetail.component.ts":
  /*!************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/securitydetail/securitydetail.component.ts ***!
    \************************************************************************************/

  /*! exports provided: SecuritydetailComponent */

  /***/
  function srcAppModulesAccountsettingsSecuritydetailSecuritydetailComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "SecuritydetailComponent", function () {
      return SecuritydetailComponent;
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


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @app/@shared/modal/successdialog */
    "./src/app/@shared/modal/successdialog.ts");
    /* harmony import */


    var _app_shared_sidepanel_userallocation_userallocation_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/@shared/sidepanel/userallocation/userallocation.component */
    "./src/app/@shared/sidepanel/userallocation/userallocation.component.ts");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_modules_enterpriseadmin_addusersidenav_addusersidenav_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/modules/enterpriseadmin/addusersidenav/addusersidenav.component */
    "./src/app/modules/enterpriseadmin/addusersidenav/addusersidenav.component.ts");
    /* harmony import */


    var _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @app/modules/profilemanagement/profile.service */
    "./src/app/modules/profilemanagement/profile.service.ts");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _accountsettings_service__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! ../accountsettings.service */
    "./src/app/modules/accountsettings/accountsettings.service.ts"); // import { Successdialog } from '../modal/successdialog';


    var SecuritydetailComponent = /*#__PURE__*/function () {
      function SecuritydetailComponent(translate, remoteService, cookieService, localstorage, fb, dialog, accSettingsService, profileService, router, toastr, encrypt) {
        _classCallCheck(this, SecuritydetailComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.localstorage = localstorage;
        this.fb = fb;
        this.dialog = dialog;
        this.accSettingsService = accSettingsService;
        this.profileService = profileService;
        this.router = router;
        this.toastr = toastr;
        this.encrypt = encrypt;
        this.disableSendOTPButton = false;
        this.settingsData = [];
        this.showLoader = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.animationState = "out";
        this.contentObj = {
          sideNavHeading: 'Select User',
          firstTabSubmitButtonName: 'Map',
          secondTabSubmitButtonName: 'Add',
          infoIconText: 'Transfer your Admin roles and rights in OPAL to another user of your Company.',
          firstTabSubText: 'Map an existing user for the OPAL admin role.',
          secondTabSubText: 'Add new user for the OPAL admin role.',
          clearText: 'Clear'
        };
        this.triggercountryser = 1;
        this.addUserFromType = 1;
        this.userPermission = [];
        this.lusrtpye = null;
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
        this.dir = "ltr";
        this.avoidmultiv = false;
        this.viewpermission = false;
      }

      _createClass(SecuritydetailComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this19 = this;

          this.stakeHolderType = this.localstorage.getInLocal('reg_type');

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this19.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir; // if(toSelect.languagecode == 'en'){
            //   this.addUpdateUserRef.addUpdateText='Update';
            // }
            // else {
            //   this.addUpdateUserRef.addUpdateText='Update';
            // }
          } else {
            var _toSelect6 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect6.languagecode);
            this.dir = _toSelect6.dir; // this.addUpdateUserRef.addUpdateText='Update';
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this19.translate.setDefaultLang(_this19.cookieService.get('languageCode'));

            if (_this19.cookieService.get('languageCookieId') && _this19.cookieService.get('languageCookieId') != undefined && _this19.cookieService.get('languageCookieId') != null) {
              var _toSelect7 = _this19.languagelist.find(function (c) {
                return c.id === _this19.cookieService.get('languageCookieId');
              });

              _this19.translate.setDefaultLang(_toSelect7.languagecode);

              _this19.dir = _toSelect7.dir; // if(toSelect.languagecode == 'en'){
              //   this.addUpdateUserRef.addUpdateText='Update';
              // }
              // else {
              //   this.addUpdateUserRef.addUpdateText='Update';
              // }
            } else {
              var _toSelect8 = _this19.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this19.translate.setDefaultLang(_toSelect8.languagecode);

              _this19.dir = _toSelect8.dir; // this.addUpdateUserRef.addUpdateText='Update';
            }
          });
          this.lusrtpye = this.localstorage.getInLocal('usertype');

          if (this.lusrtpye == 'U') {
            this.useraccess = this.localstorage.getInLocal('uerpermission');
          }

          this.stakeHolderType = this.localstorage.getInLocal('reg_type');
          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this19.translate.setDefaultLang(_this19.cookieService.get('languageCode'));
          });
        }
      }, {
        key: "ngOnChanges",
        value: function ngOnChanges(changes) {
          if (this.settingsData && this.settingsData.primaryContact && this.settingsData.primaryContact.ischangeuser !== undefined) {
            this.ischangeadmin = this.settingsData.primaryContact.ischangeuser;
          }
        }
      }, {
        key: "f",
        get: function get() {
          return this.accountsettingForm.controls;
        }
      }, {
        key: "openDialog",
        value: function openDialog() {
          var dialogRef = this.dialog.open(_app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_6__["Successdialog"], {
            disableClose: true,
            panelClass: 'changeuserloaderview'
          });
          dialogRef.afterClosed().subscribe(function (result) {});
        }
      }, {
        key: "toggleShowDiv",
        value: function toggleShowDiv(divName) {
          if (divName === "descriptioncontent") {
            this.animationState = this.animationState === "out" ? "in" : "out";
          }
        }
      }, {
        key: "clear",
        value: function clear() {}
      }, {
        key: "showSweetAlert",
        value: function showSweetAlert() {
          this.animationState = "out";
        }
      }, {
        key: "showLoaderOutput",
        value: function showLoaderOutput(event) {
          this.showLoader.emit(event);
        }
      }, {
        key: "getuserpermissiondet",
        value: function getuserpermissiondet(userper) {
          var _this20 = this;

          this.showLoader.emit(true);
          this.avoidmultiv = false;
          this.viewpermission = true;
          setTimeout(function () {
            _this20.addUpdateAccess.userAccessview(userper);
          }, 100);
        }
      }, {
        key: "avoidmulti",
        value: function avoidmulti() {
          this.avoidmultiv = true;
          this.viewpermission = false;
        }
      }, {
        key: "userPermData",
        value: function userPermData(event) {
          var userPermission = event;
        }
      }, {
        key: "editUser",
        value: function editUser(userPk) {}
      }, {
        key: "showSuccess",
        value: function showSuccess() {
          this.toastr.success(this.i18n('accountdetails.everisbrok'), this.i18n('accountdetails.succ'), {
            timeOut: 3000,
            closeButton: true
          });
        }
      }, {
        key: "reload",
        value: function reload(event) {
          var _this21 = this;

          if (event) {
            this.accSettingsService.accountsettingsdata(event).subscribe(function (data) {
              _this21.settingsData = data['data'];
            });
          }
        }
      }]);

      return SecuritydetailComponent;
    }();

    SecuritydetailComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_12__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_14__["CookieService"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialog"]
      }, {
        type: _accountsettings_service__WEBPACK_IMPORTED_MODULE_16__["AccountsettingsService"]
      }, {
        type: _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_11__["ProfileService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_15__["ToastrService"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__["Encrypt"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SecuritydetailComponent.prototype, "userType", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SecuritydetailComponent.prototype, "settingsData", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SecuritydetailComponent.prototype, "companytype", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], SecuritydetailComponent.prototype, "isGraceExpired", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])('showLoader'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SecuritydetailComponent.prototype, "showLoader", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('drawer'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__["MatDrawer"])], SecuritydetailComponent.prototype, "drawer", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('viewpermissionsidenav'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__["MatDrawer"])], SecuritydetailComponent.prototype, "viewpermissionsidenav", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('drawer2'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__["MatDrawer"])], SecuritydetailComponent.prototype, "drawer2", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('addUpdateAccess'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_sidepanel_userallocation_userallocation_component__WEBPACK_IMPORTED_MODULE_7__["UserallocationComponent"])], SecuritydetailComponent.prototype, "addUpdateAccess", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('draweruserallocation'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__["MatDrawer"])], SecuritydetailComponent.prototype, "draweruserallocation", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('draweraddinguser'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__["MatDrawer"])], SecuritydetailComponent.prototype, "draweraddinguser", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('addUpdateUserRef'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_modules_enterpriseadmin_addusersidenav_addusersidenav_component__WEBPACK_IMPORTED_MODULE_10__["AddusersidenavComponent"])], SecuritydetailComponent.prototype, "addUpdateUserRef", void 0);
    SecuritydetailComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-securitydetail',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./securitydetail.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/securitydetail/securitydetail.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./securitydetail.component.scss */
      "./src/app/modules/accountsettings/securitydetail/securitydetail.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_12__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_14__["CookieService"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"], _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialog"], _accountsettings_service__WEBPACK_IMPORTED_MODULE_16__["AccountsettingsService"], _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_11__["ProfileService"], _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"], ngx_toastr__WEBPACK_IMPORTED_MODULE_15__["ToastrService"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__["Encrypt"]])], SecuritydetailComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.scss":
  /*!**************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.scss ***!
    \**************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsSecurityquestionlistSecurityquestionlistComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".spcesme {\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 83.33%;\n  background: #fff;\n}\n.spcesme .alignitems {\n  align-items: center;\n}\n.spcesme .widthform {\n  width: 50%;\n}\n.spcesme .alignendsave {\n  display: flex;\n  justify-content: flex-end;\n}\n.spcesme .cancel {\n  width: 102px;\n  height: 42px;\n  background-color: #ececec;\n  color: #727272;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n.spcesme .save {\n  width: 152px;\n  height: 42px;\n  background-color: #006cb7;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n.spcesme .securitytitle p {\n  color: #006cb7;\n}\n.spcesme .alignsecurity {\n  display: flex;\n  align-items: center;\n}\n.spcesme .widthquestion {\n  width: 100%;\n}\n.securityscroll::-webkit-scrollbar {\n  width: 0.4em;\n  position: absolute;\n  right: 0;\n}\n.securityscroll::-webkit-scrollbar-track {\n  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);\n  background-color: #fff;\n}\n.securityscroll::-webkit-scrollbar-thumb {\n  background-color: #b8c3cb;\n  outline: 1px solid slategrey;\n}\n.securityscroll {\n  max-height: 300px !important;\n  overflow-x: auto !important;\n}\n.countrynameselect {\n  line-height: 40px !important;\n  height: 40px !important;\n}\n@media (max-width: 766px) and (min-width: 318px) {\n  .alignendsave {\n    display: flex !important;\n    justify-content: flex-start !important;\n    align-items: center;\n  }\n\n  .spcesme {\n    margin-left: auto;\n    margin-right: auto;\n    max-width: 90% !important;\n    background: #fff;\n    padding: 30px 0px 30px 0px !important;\n  }\n}\n@media (max-width: 768px) {\n  .spacequestion {\n    padding-left: 0px !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3Mvc2VjdXJpdHlxdWVzdGlvbmxpc3QvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcYWNjb3VudHNldHRpbmdzXFxzZWN1cml0eXF1ZXN0aW9ubGlzdFxcc2VjdXJpdHlxdWVzdGlvbmxpc3QuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL3NlY3VyaXR5cXVlc3Rpb25saXN0L3NlY3VyaXR5cXVlc3Rpb25saXN0LmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUdBO0VBQ0ksaUJBQUE7RUFDQSxrQkFBQTtFQUNBLGlCQUFBO0VBQ0EsZ0JBQUE7QUNGSjtBREdBO0VBQ0ksbUJBQUE7QUNESjtBREdBO0VBQ0ksVUFBQTtBQ0RKO0FESUk7RUFDSSxhQUFBO0VBQ0EseUJBQUE7QUNGUjtBREtJO0VBQ0ksWUFBQTtFQUNBLFlBQUE7RUFDQSx5QkFBQTtFQUNBLGNBQUE7RUFDQSw2QkFBQTtFQUNBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0FDSFI7QURLSTtFQUNJLFlBQUE7RUFDQSxZQUFBO0VBQ0EseUJBQUE7RUFDQSxXQUFBO0VBQ0EsNkJBQUE7RUFDQSxhQUFBO0VBQ0EsdUJBQUE7RUFDQSxtQkFBQTtBQ0hSO0FET1E7RUFDSSxjQUFBO0FDTFo7QURRSTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ05SO0FEU0k7RUFDSSxXQUFBO0FDUFI7QURXQTtFQUNJLFlBQUE7RUFDQSxrQkFBQTtFQUNBLFFBQUE7QUNSSjtBRFVFO0VBRUUsNENBQUE7RUFDQSxzQkFBQTtBQ1BKO0FEU0U7RUFDRSx5QkFBQTtFQUNBLDRCQUFBO0FDTko7QURRRTtFQUNFLDRCQUFBO0VBQ0EsMkJBQUE7QUNMSjtBRFFJO0VBQ0ksNEJBQUE7RUFDQSx1QkFBQTtBQ0xSO0FEUUE7RUFFSztJQUNJLHdCQUFBO0lBQ0Esc0NBQUE7SUFDQSxtQkFBQTtFQ05QOztFRFFHO0lBQ0csaUJBQUE7SUFDQSxrQkFBQTtJQUNBLHlCQUFBO0lBQ0EsZ0JBQUE7SUFDQSxxQ0FBQTtFQ0xOO0FBQ0Y7QURTQztFQUNHO0lBQ0ksNEJBQUE7RUNQTjtBQUNGIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3Mvc2VjdXJpdHlxdWVzdGlvbmxpc3Qvc2VjdXJpdHlxdWVzdGlvbmxpc3QuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJcclxuXHJcblxyXG4uc3BjZXNtZXtcclxuICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgbWF4LXdpZHRoOiA4My4zMyU7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4uYWxpZ25pdGVtc3tcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbn1cclxuLndpZHRoZm9ybXtcclxuICAgIHdpZHRoOjUwJTtcclxufVxyXG5cclxuICAgIC5hbGlnbmVuZHNhdmV7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgfVxyXG5cclxuICAgIC5jYW5jZWx7XHJcbiAgICAgICAgd2lkdGg6MTAycHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0MnB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlY2VjZWM7XHJcbiAgICAgICAgY29sb3I6ICM3MjcyNzI7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgfVxyXG4gICAgLnNhdmV7XHJcbiAgICAgICAgd2lkdGg6MTUycHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0MnB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgfVxyXG5cclxuICAgIC5zZWN1cml0eXRpdGxle1xyXG4gICAgICAgIHB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3OyAgXHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmFsaWduc2VjdXJpdHl7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAud2lkdGhxdWVzdGlvbntcclxuICAgICAgICB3aWR0aDoxMDAlO1xyXG4gICAgfVxyXG59XHJcblxyXG4uc2VjdXJpdHlzY3JvbGw6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICAgIHdpZHRoOiAwLjRlbTtcclxuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgIHJpZ2h0OiAwO1xyXG4gICB9XHJcbiAgLnNlY3VyaXR5c2Nyb2xsOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICAtd2Via2l0LWJveC1zaGFkb3c6IGluc2V0IDAgMCA2cHggcmdiYSgwLCAwLCAwLCAwLjMpO1xyXG4gICAgYm94LXNoYWRvdzogaW5zZXQgMCAwIDZweCByZ2JhKDAsIDAsIDAsIDAuMyk7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICB9XHJcbiAgLnNlY3VyaXR5c2Nyb2xsOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjYjhjM2NiO1xyXG4gICAgb3V0bGluZTogMXB4IHNvbGlkIHNsYXRlZ3JleTtcclxuICAgfVxyXG4gIC5zZWN1cml0eXNjcm9sbHtcclxuICAgIG1heC1oZWlnaHQ6IDMwMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICBvdmVyZmxvdy14OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICBcclxuICAgIC5jb3VudHJ5bmFtZXNlbGVjdCB7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcclxuICAgICAgICBoZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOjc2NnB4KSBhbmQgKG1pbi13aWR0aDozMThweCkge1xyXG4gIFxyXG4gICAgIC5hbGlnbmVuZHNhdmUge1xyXG4gICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgIH1cclxuICAgICAuc3BjZXNtZXtcclxuICAgICAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5MCUgIWltcG9ydGFudDtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgICAgIHBhZGRpbmc6IDMwcHggMHB4IDMwcHggMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICBcclxuIH1cclxuXHJcbiBAbWVkaWEgKG1heC13aWR0aDo3NjhweCl7XHJcbiAgICAuc3BhY2VxdWVzdGlvbntcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICBcclxuIH0iLCIuc3BjZXNtZSB7XG4gIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gIG1heC13aWR0aDogODMuMzMlO1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xufVxuLnNwY2VzbWUgLmFsaWduaXRlbXMge1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnNwY2VzbWUgLndpZHRoZm9ybSB7XG4gIHdpZHRoOiA1MCU7XG59XG4uc3BjZXNtZSAuYWxpZ25lbmRzYXZlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5zcGNlc21lIC5jYW5jZWwge1xuICB3aWR0aDogMTAycHg7XG4gIGhlaWdodDogNDJweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VjZWNlYztcbiAgY29sb3I6ICM3MjcyNzI7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5zcGNlc21lIC5zYXZlIHtcbiAgd2lkdGg6IDE1MnB4O1xuICBoZWlnaHQ6IDQycHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4uc3BjZXNtZSAuc2VjdXJpdHl0aXRsZSBwIHtcbiAgY29sb3I6ICMwMDZjYjc7XG59XG4uc3BjZXNtZSAuYWxpZ25zZWN1cml0eSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4uc3BjZXNtZSAud2lkdGhxdWVzdGlvbiB7XG4gIHdpZHRoOiAxMDAlO1xufVxuXG4uc2VjdXJpdHlzY3JvbGw6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcbiAgd2lkdGg6IDAuNGVtO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHJpZ2h0OiAwO1xufVxuXG4uc2VjdXJpdHlzY3JvbGw6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcbiAgLXdlYmtpdC1ib3gtc2hhZG93OiBpbnNldCAwIDAgNnB4IHJnYmEoMCwgMCwgMCwgMC4zKTtcbiAgYm94LXNoYWRvdzogaW5zZXQgMCAwIDZweCByZ2JhKDAsIDAsIDAsIDAuMyk7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG59XG5cbi5zZWN1cml0eXNjcm9sbDo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjYjhjM2NiO1xuICBvdXRsaW5lOiAxcHggc29saWQgc2xhdGVncmV5O1xufVxuXG4uc2VjdXJpdHlzY3JvbGwge1xuICBtYXgtaGVpZ2h0OiAzMDBweCAhaW1wb3J0YW50O1xuICBvdmVyZmxvdy14OiBhdXRvICFpbXBvcnRhbnQ7XG59XG5cbi5jb3VudHJ5bmFtZXNlbGVjdCB7XG4gIGxpbmUtaGVpZ2h0OiA0MHB4ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogNDBweCAhaW1wb3J0YW50O1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY2cHgpIGFuZCAobWluLXdpZHRoOiAzMThweCkge1xuICAuYWxpZ25lbmRzYXZlIHtcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgfVxuXG4gIC5zcGNlc21lIHtcbiAgICBtYXJnaW4tbGVmdDogYXV0bztcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gICAgbWF4LXdpZHRoOiA5MCUgIWltcG9ydGFudDtcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xuICAgIHBhZGRpbmc6IDMwcHggMHB4IDMwcHggMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAuc3BhY2VxdWVzdGlvbiB7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxufSJdfQ== */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.ts":
  /*!************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.ts ***!
    \************************************************************************************************/

  /*! exports provided: SecurityquestionlistComponent */

  /***/
  function srcAppModulesAccountsettingsSecurityquestionlistSecurityquestionlistComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "SecurityquestionlistComponent", function () {
      return SecurityquestionlistComponent;
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


    var _accountsettings_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ../accountsettings.service */
    "./src/app/modules/accountsettings/accountsettings.service.ts");
    /* harmony import */


    var _angular_cdk_text_field__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/cdk/text-field */
    "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/text-field.js");
    /* harmony import */


    var rxjs_operators__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! rxjs/operators */
    "./node_modules/rxjs/_esm2015/operators/index.js");
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/@shared/modal/successdialog */
    "./src/app/@shared/modal/successdialog.ts");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");

    var SecurityquestionlistComponent = /*#__PURE__*/function () {
      function SecurityquestionlistComponent(fb, dialog, accSettingsService, _ngZone, toastr) {
        _classCallCheck(this, SecurityquestionlistComponent);

        this.fb = fb;
        this.dialog = dialog;
        this.accSettingsService = accSettingsService;
        this._ngZone = _ngZone;
        this.toastr = toastr;
        this.parentCount = 0;
      }

      _createClass(SecurityquestionlistComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.accountsettingForm = this.fb.group({
            question1: [null, null],
            question2: [null, null],
            question3: [null, null],
            question4: [null, null],
            answer1: [null, null],
            answer2: [null, null],
            answer3: [null, null],
            answer4: [null, null]
          });
        }
      }, {
        key: "displayCounter",
        value: function displayCounter(count) {
          this.parentCount = count;
        }
      }, {
        key: "ngOnChanges",
        value: function ngOnChanges() {
          if (this.alreadyAnswered) {
            this.accountsettingForm.patchValue(this.alreadyAnswered);
          }
        }
      }, {
        key: "triggerResize",
        value: function triggerResize() {
          var _this22 = this;

          this._ngZone.onStable.pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_5__["take"])(1)).subscribe(function () {
            return _this22.autosize.resizeToFitContent(true);
          });
        }
      }, {
        key: "customValidator",
        value: function customValidator(group) {
          var questionSelectedCount = 0;

          for (var i = 1; i <= 4; i++) {
            if (group.controls["question" + i].value && group.controls["answer" + i].value) {
              questionSelectedCount = questionSelectedCount + 1;
            }
          }

          if (questionSelectedCount < 2) {
            group.setErrors({
              selecttwo: true
            });
            return null;
          }

          return true;
        }
      }, {
        key: "f",
        get: function get() {
          return this.accountsettingForm.controls;
        }
      }, {
        key: "openDialog",
        value: function openDialog() {
          var dialogRef = this.dialog.open(_app_shared_modal_successdialog__WEBPACK_IMPORTED_MODULE_7__["Successdialog"], {
            panelClass: 'custom-modalbox'
          });
          dialogRef.afterClosed().subscribe(function (result) {});
        }
      }, {
        key: "saveAnswers",
        value: function saveAnswers() {
          var _this23 = this;

          if (this.customValidator(this.accountsettingForm)) {
            this.accSettingsService.saveSecurityQA(this.accountsettingForm.value).subscribe(function (data) {
              if (data['data'].status == 1) {
                _this23.showSuccess(); // swal({
                //   title: 'saved successfully.',
                //   icon: 'success',
                //   closeOnClickOutside: false,
                //   closeOnEsc: false
                // })

              }
            });
          }
        }
      }, {
        key: "showSuccess",
        value: function showSuccess() {
          this.toastr.success('Deleted Successfully', 'Success !', {
            timeOut: 3000,
            closeButton: true
          });
        }
      }]);

      return SecurityquestionlistComponent;
    }();

    SecurityquestionlistComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_6__["MatDialog"]
      }, {
        type: _accountsettings_service__WEBPACK_IMPORTED_MODULE_3__["AccountsettingsService"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["NgZone"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_8__["ToastrService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SecurityquestionlistComponent.prototype, "questArr", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SecurityquestionlistComponent.prototype, "alreadyAnswered", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('autosize'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_cdk_text_field__WEBPACK_IMPORTED_MODULE_4__["CdkTextareaAutosize"])], SecurityquestionlistComponent.prototype, "autosize", void 0);
    SecurityquestionlistComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-securityquestionlist',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./securityquestionlist.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./securityquestionlist.component.scss */
      "./src/app/modules/accountsettings/securityquestionlist/securityquestionlist.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_6__["MatDialog"], _accountsettings_service__WEBPACK_IMPORTED_MODULE_3__["AccountsettingsService"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["NgZone"], ngx_toastr__WEBPACK_IMPORTED_MODULE_8__["ToastrService"]])], SecurityquestionlistComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.scss":
  /*!********************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.scss ***!
    \********************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsSubscriptionpaymentlistSubscriptionpaymentlistComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "@charset \"UTF-8\";\n.paymentview {\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 83.33%;\n  background: #fff;\n}\n.paymentview .spacerenew {\n  display: flex;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n.paymentview .justifyend {\n  justify-content: flex-end;\n}\n.paymentview .inputinfoicon {\n  color: #ff0505;\n}\n.paymentview .mat-expansion-panel-body {\n  padding-bottom: 0px;\n}\n.paymentview .mat-expansion-panel-spacing {\n  overflow: inherit;\n}\n.paymentview .titletext p {\n  font-size: 0.9375rem;\n  margin: 0px;\n  color: #333333 !important;\n}\n.paymentview .accordionshowtext {\n  padding-right: 20px;\n  padding-left: 55px;\n}\n.paymentview .accordionshowtext p {\n  font-size: 0.9375rem;\n  margin: 0px;\n  color: #333333 !important;\n  line-height: 1.6;\n  position: relative;\n  top: -18px;\n}\n.paymentview .accordionshowtext p.posreltop0 {\n  position: relative;\n  top: 0px;\n}\n.paymentview .accordionshowtext .mw75 {\n  min-width: 75px;\n}\n@media (min-width: 1600px) {\n  .paymentview .accordionshowtext .mw75 {\n    min-width: 80px;\n  }\n}\n.paymentview .alignpayment {\n  display: flex;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n.paymentview .alignpayment .declinedtext h2 {\n  color: #ff0000;\n  font-size: 0.9375rem;\n  font-family: \"cairosemibold\";\n  margin: 0px;\n  line-height: 26px;\n}\n.paymentview .alignpayment .declinedtext p {\n  font-size: 0.9375rem;\n  margin: 0px;\n  color: #333333 !important;\n  padding-bottom: 8px;\n  word-break: break-word;\n}\n.paymentview .mat-expanded .mat-expansion-indicator {\n  border-radius: 50%;\n  background-color: #fff;\n  height: 30px;\n  width: 30px;\n  text-align: center;\n}\n.paymentview .mat-expansion-panel {\n  box-shadow: none;\n}\n.paymentview .backgroundcomment {\n  background-color: #ffeded !important;\n}\n.paymentview .mat-expansion-panel-header {\n  height: 76px !important;\n  border-radius: 0;\n  background-color: #ffeded !important;\n}\n.paymentview .mat-expansion-panel-header p {\n  margin: 0;\n}\n.paymentview .mat-expansion-panel-content {\n  background-color: #ffeded !important;\n}\n.paymentview .mat-expansion-panel-header-description {\n  flex-grow: 0;\n  display: flex;\n  align-items: center;\n  margin-right: 0;\n}\n.paymentview .mat-expansion-panel-header-description p {\n  padding-right: 30px;\n}\n.paymentview .pointertext {\n  cursor: pointer;\n}\n.paymentview .kindlytext {\n  padding-left: 20px;\n  padding-top: 10px;\n}\n.paymentview .kindlytext p {\n  color: #666666;\n  margin: 0px;\n  font-size: 0.875rem;\n}\n.paymentview .kindlytext p a {\n  color: #f58020;\n  text-decoration: underline;\n}\n.paymentview .alignendsave {\n  display: flex;\n  justify-content: flex-end;\n}\n.paymentview .jsrscolor {\n  padding-bottom: 10px;\n  padding-left: 20px;\n}\n.paymentview .jsrscolor h2 {\n  font-size: 0.9375rem;\n  color: #333;\n  margin: 0px;\n}\n.paymentview .widthform {\n  width: 50%;\n}\n.paymentview .cancel {\n  width: 152px;\n  height: 40px;\n  background-color: #ececec;\n  color: #727272;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n.paymentview .afternext::after {\n  content: \"\";\n  border-top: 18px solid #006cb7;\n  border-left: 18px solid transparent;\n  border-right: 18px solid transparent;\n  position: absolute;\n  bottom: 206px;\n  transform: rotate(-180deg);\n  left: 35px;\n  display: none;\n}\n.paymentview .positionname {\n  position: relative;\n  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);\n}\n.paymentview .afternext {\n  position: relative;\n}\n.paymentview .headerevent {\n  position: relative;\n}\n.paymentview .headerevent h2 {\n  color: #fff;\n  margin: 0px;\n  padding-top: 4px;\n}\n.paymentview .seniorcolor {\n  margin: 0px;\n  color: #fff;\n  line-height: 0.3;\n}\n.paymentview .valuecolor {\n  color: #f08235;\n}\n.paymentview .alignend {\n  display: flex;\n}\n.paymentview .widthload {\n  width: 50%;\n}\n.paymentview .spencercoorpaymentclassification {\n  background-color: #f5f6f9;\n  position: relative;\n  max-height: 50px;\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n  padding: 12px 20px 12px 20px;\n}\n.paymentview .spencercoorpaymentclassification p {\n  color: #333333;\n  font-family: \"cairosemibold\";\n}\n.paymentview .projectborder {\n  border-top: none;\n  border-left: 1px solid #dadada;\n  border-right: 1px solid #dadada;\n  border-bottom: 1px solid #dadada;\n}\n.paymentview .emailalign {\n  display: flex;\n}\n.paymentview .infocmprating {\n  color: #333333;\n  font-size: 0.9375rem;\n}\n.paymentview .labelcmpafter {\n  color: #999999;\n  font-size: 0.875rem;\n}\n.paymentview .save {\n  width: 152px;\n  height: 40px;\n  background-color: #006cb7;\n  color: #fff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n.paymentview .mat-tab-body.mat-tab-body-active {\n  position: relative;\n  overflow-x: hidden;\n  overflow-y: inherit;\n  z-index: 1;\n  flex-grow: 1;\n}\n.paymentview .spcesme {\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 83.33%;\n  background: #fff;\n}\n.paymentview .colortextyear {\n  color: #333333;\n  font-family: \"cairosemibold\";\n}\n.paymentview .businessunitinfo {\n  width: 34%;\n  z-index: 9999;\n  position: absolute;\n  margin-left: -11px;\n}\n.paymentview .payemtnlist {\n  width: 100%;\n  z-index: 9999;\n  position: absolute;\n  top: 26px;\n  margin-left: -5px;\n}\n.paymentview .dropdownlist {\n  width: 100%;\n  z-index: 9999;\n  position: absolute;\n  top: 26px;\n  margin-left: -5px;\n}\n.paymentview .position {\n  position: relative;\n}\n.paymentview .afteruser .headerinformationtext::after {\n  content: \"\";\n  position: absolute;\n  left: 100px;\n  top: -10px;\n  width: 0;\n  height: 0;\n  border-left: 10px solid transparent;\n  border-right: 10px solid transparent;\n  border-bottom: 10px solid #e1efff;\n  clear: both;\n  display: none;\n}\n.paymentview .invoicefont p {\n  font-family: \"cairosemibold\";\n}\n.paymentview .nextrenewal .cmpnyinfo {\n  margin-bottom: 0;\n  display: flex;\n  padding-bottom: 15px;\n  justify-content: flex-start;\n  align-items: flex-start !important;\n}\n.paymentview .nextrenewal .cmpnyinfo .firsttextcolor {\n  min-width: 110px;\n}\n.paymentview .nextrenewal .cmpnyinfo .secondcontenttext {\n  word-break: break-word;\n  padding-right: 8px;\n}\n.paymentview .nextrenewal .popover-body {\n  padding: 0px !important;\n}\n.paymentview .nextrenewal .popover.popover-content .popover-body p {\n  color: #fff !important;\n  font-size: 12px !important;\n  line-height: 1.5 !important;\n}\n.paymentview .nextrenewal .popover.popover-content.sm {\n  background-color: #fff;\n  min-width: 366px;\n  box-shadow: 0 10px 6px -6px rgba(0, 0, 0, 0.2);\n  z-index: 9999;\n}\n.paymentview .nextrenewal .popover.popover-content .popover-body {\n  color: #333;\n  font-size: 0.75rem;\n  line-height: 1.5;\n  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);\n}\n.paymentview .nextrenewal .popover.popover-content .arrow {\n  z-index: 9999 !important;\n}\n.paymentview .nextrenewal .popover.popover-content.bs-popover-top .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-top .arrow::after, .paymentview .nextrenewal .popover.popover-content.bs-popover-top-right .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-top-right .arrow::after, .paymentview .nextrenewal .popover.popover-content.bs-popover-top-left .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-top-left .arrow::after {\n  content: \"\";\n  border-top: 18px solid #fff;\n  border-left: 18px solid transparent;\n  border-right: 18px solid transparent;\n  position: absolute;\n  transform: rotate(-360deg);\n  left: -70px;\n  top: -8px;\n}\n.paymentview .nextrenewal .popover.popover-content.bs-popover-bottom .arrow::after, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-right .arrow::after, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-left .arrow::after {\n  top: 0rem;\n  border-bottom-color: #fff;\n}\n.paymentview .nextrenewal .popover.popover-content.bs-popover-bottom .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-right .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-left .arrow::before {\n  border-bottom-color: #fff;\n}\n.paymentview .nextrenewal .popover.popover-content.bs-popover-bottom .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom .arrow::after, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-right .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-right .arrow::after, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-left .arrow::before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-left .arrow::after {\n  top: -2px;\n  border-width: 0 8px 8px 8px;\n}\n.paymentview .nextrenewal .popover.popover-content.bs-popover-bottom .arrow:before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom .arrow:after, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-right .arrow:before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-right .arrow:after, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-left .arrow:before, .paymentview .nextrenewal .popover.popover-content.bs-popover-bottom-left .arrow:after {\n  top: -2px !important;\n}\n.paymentview .headerpopview {\n  max-height: 70px;\n  background: #58626e;\n  min-height: 70px;\n}\n.paymentview .widthformfiled {\n  width: 230px;\n}\n.paymentview .usercolor {\n  background-color: #006cb7;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  line-height: 12px;\n  height: 25px;\n}\n.paymentview .widthimg {\n  width: 15px;\n  height: 15px;\n  padding-left: 8px;\n}\n.paymentview .smecolor {\n  background-color: #71c015;\n  color: #fff;\n  border-radius: 2px;\n  height: 20px;\n  margin: 0px;\n  line-height: 18px;\n  padding: 2px 6px 2px 6px;\n}\n.paymentview .spencercoorpayment p {\n  color: #333333;\n  font-family: \"cairosemibold\";\n}\n.paymentview .borderspeccompanycolor {\n  border-top: 1px solid #d7d7d7;\n  border-left: 1px solid #d7d7d7;\n  border-right: 1px solid #d7d7d7;\n  margin-left: 20px;\n  margin-right: 0px;\n  display: flex;\n  justify-content: space-between;\n  background-color: #f5f6f9;\n  padding: 20px 22px 20px 22px;\n}\n.paymentview .nextrenewal {\n  line-height: 25px;\n}\n.paymentview .nextrenewal .aftercoloruserlist {\n  font-size: 0.875rem;\n  color: #f4811f;\n}\n.paymentview .aftercolorreniew p {\n  font-size: 0.875rem;\n  color: #f4811f;\n}\n.paymentview .widthcompsale {\n  width: 33.33%;\n  border-right: 1px solid #dadada;\n}\n.paymentview .nextrenewal {\n  width: 33.33%;\n}\n.paymentview .aftercoloruserlist {\n  cursor: pointer;\n}\n.paymentview .aftercolorreniewpack {\n  position: relative;\n  cursor: pointer;\n}\n.paymentview .alignpassword {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n.paymentview .cmpnyinfo {\n  margin-bottom: 0;\n  display: flex;\n  padding-bottom: 8px;\n  justify-content: flex-start;\n  align-items: flex-start !important;\n}\n.paymentview .cmpnyinfo .labelcmpdep {\n  color: #999999 !important;\n  font-size: 0.875rem;\n  min-width: 110px;\n}\n.paymentview .cmpnyinfo .infocmpnance {\n  color: #333333 !important;\n  font-size: 0.875rem;\n}\n.paymentview .labelcmp {\n  display: block;\n  min-width: 165px;\n  line-height: inherit !important;\n}\n.paymentview .infocmp {\n  color: #333;\n  font-size: 0.875rem;\n}\n.paymentview .statuswidth {\n  color: #666666;\n  font-size: 0.875rem;\n  display: block;\n}\n.paymentview .widthimgcheck {\n  width: 20px;\n  height: 16px;\n}\n.paymentview .borderemail {\n  border-bottom: 1px solid #d7d7d7;\n  border-left: 1px solid #d7d7d7;\n  border-right: 1px solid #d7d7d7;\n  border-top: none;\n  display: flex;\n  background: #fff;\n  margin-left: 20px;\n}\n.paymentview .widthcomp {\n  width: 50%;\n}\n.paymentview .widthcompmain {\n  width: 33.33%;\n}\n.paymentview .alignpassword {\n  display: flex;\n  align-items: center;\n}\n.paymentview .coloractive {\n  font-weight: normal !important;\n  background: #2389f1;\n  color: #fff;\n  border-radius: 20px;\n  padding: 2px 11px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.paymentview .spencercoor {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center;\n}\n.paymentview .spencercoor h2 {\n  color: #022f67;\n}\n.paymentview .marketcolor p {\n  color: #333333;\n}\n.paymentview .borderspec {\n  border: 1px solid #d7d7d7;\n  margin-left: 20px;\n  margin-right: 20px;\n  padding: 18px;\n  display: flex;\n  justify-content: space-between;\n  background-color: #f5f6f9;\n  align-items: center;\n  height: 122px;\n}\n.paymentview .borderspecheight {\n  border: 1px solid #d7d7d7;\n  margin-left: 20px;\n  margin-right: 20px;\n  padding: 18px;\n  display: flex;\n  justify-content: space-between;\n  background-color: #f5f6f9;\n  align-items: center;\n  height: 122px;\n}\n.paymentview .domaincolor p {\n  color: #333333;\n  font-family: \"cairosemibold\";\n}\n.paymentview .domaincolor span {\n  color: #f08235;\n}\n.paymentview .renewcolor {\n  background-color: #e0f0ff;\n  color: #006cb7;\n  display: flex;\n  justify-content: center;\n  line-height: 1;\n  align-items: center;\n  height: 25px;\n  border: 1px solid #006cb7;\n  width: 115px;\n}\n.paymentview .flexpagae {\n  display: flex;\n  justify-content: space-between;\n}\n.paymentview .collaberatecolor {\n  background-color: #f4811f;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  line-height: 1;\n  align-items: center;\n  height: 25px;\n}\n.paymentview .flexrenew {\n  display: flex;\n  align-items: flex-end;\n}\n.paymentview .flexstartalign {\n  display: flex;\n  justify-content: flex-start !important;\n  align-items: center !important;\n}\n.paymentview .flexstartalign p {\n  margin-bottom: 6px !important;\n}\n.paymentview .flexstartalign .paymentstatuscolor P {\n  color: #666666;\n  margin: 0px;\n  font-size: 0.875rem;\n}\n.paymentview .flexstartalign .paymentstatuscolor .postedverification, .paymentview .flexstartalign .paymentstatuscolor .resubmit, .paymentview .flexstartalign .paymentstatuscolor .paymentinprogress, .paymentview .flexstartalign .paymentstatuscolor .failed, .paymentview .flexstartalign .paymentstatuscolor .approve {\n  background-color: #1e99f7;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  line-height: 1;\n  align-items: center;\n  height: 25px;\n}\n.paymentview .flexstartalign .paymentstatuscolor .approve {\n  background-color: #50af49 !important;\n}\n.paymentview .flexstartalign .paymentstatuscolor .failed {\n  background-color: #f23f3a !important;\n}\n.paymentview .flexstartalign .paymentstatuscolor .paymentinprogress {\n  background-color: #fc9202 !important;\n}\n.paymentview .flexstartalign .paymentstatuscolor .resubmit {\n  background: #f4811f !important;\n}\n.paymentview .collaberatebtncolor {\n  background-color: #fbe4d0;\n  color: #f48c34;\n  border-radius: 2px !important;\n  border: 1px solid #f48c34;\n  display: flex;\n  justify-content: center;\n  line-height: 1;\n  align-items: center;\n  height: 25px;\n  width: 135px !important;\n}\n.paymentview .borderspeccompanycolordownload {\n  border: 1px solid #d7d7d7;\n}\n.paymentview .reviewbtncolor {\n  background-color: #006cb7;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  line-height: 1;\n  align-items: center;\n  height: 25px;\n}\n.paymentview .btnalign {\n  margin-bottom: 6px;\n}\n.paymentview .btnalign p {\n  color: #333333;\n}\n.paymentview .imagealign {\n  display: flex;\n  align-items: center;\n  color: black;\n}\n.paymentview .imagealign img {\n  padding-left: 14px;\n}\n.paymentview .background {\n  background-color: #fff;\n  margin-left: 127px;\n  margin-right: 127px;\n  height: 410px;\n  overflow: hidden;\n  margin-top: 30px;\n  border-radius: 4px;\n}\n.paymentview .background h4 {\n  color: #333333;\n}\n.paymentview .afterpanel::after {\n  content: \"\";\n  border-top: 18px solid #353b47;\n  border-left: 18px solid transparent;\n  border-right: 18px solid transparent;\n  position: absolute;\n  bottom: 95px;\n  transform: rotate(-180deg);\n  right: 15px;\n}\n.paymentview .edit::after {\n  font-family: \"bgi-icon\" !important;\n  font-style: normal;\n  font-weight: normal;\n  font-variant: normal;\n  text-transform: none;\n  line-height: 1;\n  -webkit-font-smoothing: antialiased;\n  -moz-osx-font-smoothing: grayscale;\n  content: \"\";\n  position: absolute;\n  color: #999999;\n  font-size: 9px;\n  top: 14px;\n  right: 15px;\n}\n.paymentview .backgroundnextdesign {\n  background-color: #fff;\n  margin-left: 127px !important;\n  margin-right: 127px !important;\n  overflow: hidden;\n  height: 520px;\n  margin-top: 30px;\n  border-radius: 4px;\n}\n.paymentview .backgroundnextdesign h4 {\n  color: #333333;\n}\n.paymentview .edit {\n  background-color: #ececec;\n  color: #999999;\n  font-size: 14px;\n  font-family: calibri;\n  border-radius: 4px !important;\n  width: 100px;\n  height: 35px;\n  margin-bottom: 20px;\n  padding-left: 0px;\n}\n.paymentview .numberbtn {\n  background-color: #ececec;\n  color: #999999;\n  font-size: 14px;\n  font-family: calibri;\n  border-radius: 4px !important;\n  width: 126px;\n  height: 35px;\n  margin-bottom: 20px;\n}\n.paymentview .savechangesbtn {\n  background-color: #006cb7;\n  color: #fff;\n  font-size: 0.875rem;\n  width: 120px;\n  height: 35px;\n  border-radius: 4px !important;\n}\n.paymentview .submitbtn {\n  background-color: #006cb7;\n  color: #fff;\n  font-size: 0.875rem;\n  width: 75px;\n  height: 35px;\n  border-radius: 4px !important;\n}\n.paymentview .imagealign img {\n  height: 16px;\n}\n.paymentview .cancelbtn {\n  background-color: #ececec;\n  color: #999999;\n  font-size: 14px;\n  font-family: calibri;\n  border-radius: 4px !important;\n  width: 70px;\n  height: 35px;\n  margin-bottom: 20px;\n}\n.paymentview .flexend {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n.paymentview .doted {\n  height: 6px;\n  width: 6px;\n  background-color: #333333;\n  border-radius: 50%;\n  display: inline-block;\n}\n.paymentview .borderbottom {\n  border-bottom: 1px solid #dadada;\n}\n.paymentview .flexalign {\n  display: flex;\n  justify-content: flex-end;\n  padding-right: 56px;\n}\n.paymentview #cdk-overlay-0 .mat-menu-panel {\n  background: white;\n  position: relative;\n  right: 28px;\n  overflow: initial;\n}\n.paymentview .image:after {\n  content: \"\";\n  background: #27b8e7;\n  position: absolute;\n  height: 62%;\n  right: -5px;\n  width: 42%;\n  z-index: -1;\n  bottom: -30px;\n}\n.paymentview .image {\n  position: relative;\n  z-index: 9999;\n}\n.paymentview .mat-menu-panel {\n  min-width: 112px;\n  max-width: 280px;\n  overflow: auto;\n  -webkit-overflow-scrolling: touch;\n  max-height: calc(100vh - 48px);\n  border-radius: 4px;\n  outline: 0;\n  position: relative;\n  right: 28px;\n}\n.paymentview .image img {\n  position: relative;\n  top: 25px;\n}\n.paymentview .custom-modalbox .mat-dialog-container {\n  background: transparent;\n  width: 100%;\n}\n.paymentview .border1 .mat-button-toggle-button {\n  border: 0;\n  background: 0 0;\n  color: inherit;\n  padding: 0;\n  margin: 0;\n  font: inherit;\n  outline: 0;\n  width: 80px !important;\n  height: 40px !important;\n  cursor: pointer;\n  border: 1px solid #006cb7;\n}\n.paymentview .display {\n  display: flex;\n  justify-content: space-between;\n}\n.paymentview .current p {\n  margin-right: 6px;\n}\n.paymentview .verfiedalign span {\n  color: #70c015;\n}\n.paymentview .removetextcolor span {\n  color: #4a6ea6;\n}\n.paymentview .btn {\n  color: #63686e;\n  width: 130px;\n  height: 38px;\n  border-radius: 0;\n  box-shadow: none;\n  background-color: #e8ebf0;\n  border-radius: 5px;\n}\n.paymentview .borderspeccompanycolor {\n  border-top: 1px solid #d7d7d7;\n  border-left: 1px solid #d7d7d7;\n  border-right: 1px solid #d7d7d7;\n  margin-left: 20px;\n  margin-right: 0px;\n  padding: 20px 25px 0px 25px;\n  display: flex;\n  justify-content: space-between;\n  background-color: #f5f6f9;\n  align-items: center;\n}\n@media (max-width: 767px) {\n  .aligndomian {\n    padding-bottom: 15px;\n  }\n\n  .responsivepaddingwidth {\n    padding-left: 18px !important;\n  }\n\n  .flexalign {\n    display: flex;\n    align-items: center;\n    justify-content: flex-start;\n    padding-right: 0px;\n  }\n  .flexalign .backgroundnextdesign {\n    background-color: #fff;\n    margin-left: 10px !important;\n    margin-right: 10px !important;\n    overflow: hidden;\n    margin-top: 30px;\n    border-radius: 4px;\n  }\n  .flexalign .backgroundnextdesign h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n  .flexalign .flexalign {\n    display: flex;\n    align-items: center;\n    justify-content: flex-start;\n    padding-right: 0px;\n  }\n  .flexalign .responsivepadding {\n    padding-left: 8px !important;\n  }\n}\n@media (max-width: 1024px) and (min-width: 769px) {\n  .backgroundnextdesign h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n\n  .background h4 {\n    color: #333333;\n    padding-left: 0px !important;\n  }\n}\n@media (max-width: 768px) {\n  .caneditresponsivewidth {\n    max-width: 23% !important;\n  }\n\n  .submitresponsive {\n    max-width: 43% !important;\n  }\n\n  .emailresponsivewidth {\n    max-width: 65% !important;\n  }\n\n  .cancelresponsivewidth {\n    max-width: 35% !important;\n  }\n\n  .updatedatewidth {\n    max-width: 72% !important;\n  }\n\n  .alternateresponsivewidth {\n    max-width: 57% !important;\n  }\n\n  .changenumberbtnwidth {\n    max-width: 28% !important;\n  }\n}\n@media (max-width: 600px) {\n  .btnresponsive {\n    display: contents;\n  }\n\n  .paymentview .nextrenewal .popover.popover-content.sm {\n    background-color: #fff;\n    min-width: 320px !important;\n    box-shadow: 0 10px 6px -6px rgba(0, 0, 0, 0.2);\n    left: 24px !important;\n  }\n\n  .blockresponsivewidth {\n    display: block !important;\n  }\n\n  .submitcontentwidth {\n    display: contents;\n  }\n\n  .spacingfiled {\n    margin-bottom: 10px;\n  }\n\n  .blockalign {\n    display: block !important;\n  }\n\n  .verfiedonresponsivewidth {\n    max-width: 80% !important;\n  }\n\n  .verfiedalign span {\n    color: #70c015;\n    padding-left: 6px !important;\n  }\n\n  .imagealign {\n    display: flex;\n    align-items: center;\n    color: black;\n  }\n  .imagealign img {\n    padding-left: 4px;\n  }\n}\n@media (max-width: 768px) {\n  .certificatelistview .certifcatesidenavwidth {\n    width: 98% !important;\n  }\n\n  .flexpagae {\n    display: block !important;\n  }\n\n  .flexrenew {\n    margin-top: 10px;\n  }\n\n  .spencercoorpaymentclassification {\n    background-color: #f5f6f9;\n    max-height: 112px !important;\n    display: flex;\n    align-items: center;\n    justify-content: space-between;\n    padding: 12px 0px 12px 20px !important;\n  }\n\n  .afternext::after {\n    content: \"\";\n    border-top: 18px solid #006cb7;\n    border-left: 18px solid transparent;\n    border-right: 18px solid transparent;\n    position: absolute;\n    bottom: 188px !important;\n    transform: rotate(-180deg);\n    left: 35px;\n  }\n\n  .activescroll .arrow {\n    display: none !important;\n  }\n\n  .widthcomp {\n    width: auto !important;\n  }\n\n  .widthcompmain {\n    width: auto !important;\n  }\n\n  .borderspecheight {\n    display: block !important;\n    background-color: #eef0f4;\n    align-items: center;\n    height: 198px !important;\n  }\n\n  .widthuserbtn {\n    max-width: 100% !important;\n    margin-top: 15px;\n  }\n\n  .borderemail {\n    border-bottom: 1px solid #d7d7d7;\n    border-left: 1px solid #d7d7d7;\n    border-right: 1px solid #d7d7d7;\n    border-top: none;\n    display: block !important;\n  }\n\n  .widthcomp {\n    width: auto !important;\n    padding-bottom: 12px;\n  }\n\n  .borderspeccompanycolor {\n    border-top: 1px solid #d7d7d7;\n    border-left: 1px solid #d7d7d7;\n    border-right: 1px solid #d7d7d7;\n    margin-left: 20px;\n    margin-right: 0px;\n    display: block !important;\n    justify-content: space-between;\n    background-color: #f5f6f9;\n    padding: 20px 22px 20px 22px;\n  }\n\n  .nextrenewal {\n    padding-left: 0px !important;\n    padding-top: 10px;\n  }\n\n  .widthcompsale {\n    width: auto !important;\n    border-right: none !important;\n  }\n\n  .spencercoorpaymentclassification {\n    display: block !important;\n    align-items: center;\n    justify-content: flex-start;\n    padding: 12px;\n  }\n\n  .spacebtn {\n    margin-top: 10px;\n  }\n\n  .alignpassword {\n    display: flex;\n    align-items: center;\n    justify-content: flex-start !important;\n  }\n\n  .aligndomian {\n    margin-bottom: 0;\n    display: block !important;\n    line-height: 25px;\n    justify-content: flex-start;\n    align-items: flex-start !important;\n  }\n\n  .spcesme {\n    margin-left: auto;\n    margin-right: auto;\n    max-width: 97.33% !important;\n    background: #fff;\n  }\n\n  .packalign {\n    display: flex !important;\n    align-items: flex-start;\n    justify-content: flex-start;\n  }\n\n  .widthform {\n    width: 100% !important;\n  }\n}\n@media (max-width: 1024px) and (min-width: 769px) {\n  .certificatelistview .certifcatesidenavwidth {\n    width: 98% !important;\n  }\n\n  .flexpagae {\n    display: block !important;\n  }\n\n  .flexrenew {\n    margin-top: 10px;\n  }\n\n  .packalign {\n    display: flex !important;\n    align-items: flex-start;\n    justify-content: flex-start;\n  }\n\n  .afternext::after {\n    content: \"\";\n    border-top: 18px solid #006cb7;\n    border-left: 18px solid transparent;\n    border-right: 18px solid transparent;\n    position: absolute;\n    bottom: 187px;\n    transform: rotate(-180deg);\n    left: 35px;\n  }\n\n  .borderemail {\n    border-bottom: 1px solid #d7d7d7;\n    border-left: 1px solid #d7d7d7;\n    border-right: 1px solid #d7d7d7;\n    border-top: none;\n    display: block !important;\n  }\n\n  .widthform {\n    width: 100% !important;\n  }\n\n  .widthcomp {\n    width: 56% !important;\n  }\n\n  .shadow {\n    background-color: #fff;\n    margin-left: auto;\n    margin-right: auto;\n    box-shadow: none !important;\n  }\n\n  .nextrenewal {\n    padding-left: 0px !important;\n  }\n\n  .widthcompsale {\n    width: 40% !important;\n    border-right: none !important;\n  }\n\n  .widthcompmain {\n    width: 34% !important;\n  }\n\n  .spencercoorpaymentclassification {\n    display: block !important;\n    align-items: center;\n    justify-content: flex-start;\n    padding: 12px;\n    max-height: 75px !important;\n  }\n\n  .alignpassword {\n    display: flex;\n    align-items: center;\n    justify-content: flex-start !important;\n  }\n\n  .spacebtn {\n    margin-top: 10px;\n  }\n}\n@media (max-width: 767px) and (min-width: 318px) {\n  .borderemail {\n    margin-left: 0px !important;\n  }\n\n  .flexpagae {\n    display: block !important;\n  }\n\n  .cmpnyinfo {\n    display: block !important;\n  }\n\n  .spacemargin {\n    margin-bottom: 10px;\n  }\n\n  .selectproductheaderwithclose {\n    height: auto !important;\n  }\n\n  .selectproductheaderwithclose .titletext {\n    display: block !important;\n  }\n\n  .selectproductheaderwithclose .closeandadd {\n    margin-bottom: 10px;\n  }\n\n  .spacing {\n    padding-right: 10px !important;\n  }\n\n  .selectproductheaderwithclose .clearandaddbutton {\n    display: block !important;\n    justify-content: flex-start !important;\n    align-items: center !important;\n  }\n\n  .certificatelistview .certifcatesidenavwidth {\n    width: 100% !important;\n  }\n\n  .maintab .mat-tab-body-content {\n    height: auto;\n    overflow: hidden !important;\n  }\n\n  .afternext::after {\n    content: \"\";\n    border-top: 18px solid #006cb7;\n    border-left: 18px solid transparent;\n    border-right: 18px solid transparent;\n    position: absolute;\n    bottom: 188px !important;\n    transform: rotate(-180deg);\n    left: 130px !important;\n  }\n\n  .packalign {\n    display: block !important;\n    align-items: flex-start;\n    justify-content: flex-start;\n  }\n\n  .spcesme {\n    margin-left: auto;\n    margin-right: auto;\n    max-width: 90% !important;\n    background: #fff;\n  }\n\n  .nextrenewal {\n    width: auto !important;\n  }\n\n  .downspace {\n    margin-top: 10px;\n  }\n\n  .activescroll .popover.popover-content.bs-popover-bottom .arrow::after, .popover.popover-content.bs-popover-bottom-right .arrow::after, .popover.popover-content.bs-popover-bottom-left .arrow::after {\n    top: 0rem;\n    border-bottom-color: #fff !important;\n  }\n\n  .activescroll .popover.popover-content.bs-popover-bottom .arrow::before, .popover.popover-content.bs-popover-bottom-right .arrow::before, .popover.popover-content.bs-popover-bottom-left .arrow::before {\n    border-bottom-color: #fff !important;\n  }\n\n  .spencercoor {\n    display: block !important;\n    justify-content: flex-start;\n    align-items: center;\n  }\n\n  .alignpassword {\n    display: block !important;\n    align-items: center;\n    justify-content: flex-start !important;\n  }\n\n  .changecolor {\n    margin-bottom: 10px;\n  }\n\n  .projectborder {\n    padding: 12px !important;\n  }\n\n  .borderspecheight {\n    display: block !important;\n    background-color: #eef0f4;\n    align-items: center;\n    height: 272px !important;\n    padding: 12px !important;\n    margin-left: 0px !important;\n  }\n\n  .marketcolor {\n    padding-top: 10px;\n  }\n\n  .title {\n    padding-right: 0px !important;\n  }\n\n  .borderspeccompanycolor {\n    border: 1px solid #d7d7d7 !important;\n    margin-left: 0px !important;\n    margin-right: 0px;\n    display: block !important;\n    justify-content: space-between;\n    padding: 12px 12px 12px 12px;\n    border: none;\n  }\n\n  .borderemail {\n    padding-left: 12px !important;\n  }\n\n  .widthimgcheck {\n    padding-left: 2px !important;\n  }\n\n  .alignend {\n    display: block !important;\n    height: 100%;\n  }\n\n  .borderspeccompanycolordownload {\n    margin-right: 0px !important;\n  }\n\n  .borderspeccompanycolordownloadanother {\n    margin-top: 20px !important;\n    margin-left: 20px !important;\n    margin-right: 0px !important;\n  }\n\n  .widthload {\n    width: auto !important;\n    margin-left: 0px !important;\n    margin-bottom: 10px;\n    background: #fff;\n  }\n\n  .alignendsave {\n    display: block;\n    justify-content: center;\n    margin-left: 12px;\n  }\n\n  .cancel {\n    margin-bottom: 10px;\n  }\n\n  .widthform {\n    padding-left: 12px !important;\n    padding-right: 12px !important;\n  }\n}\n@media (max-width: 414px) and (min-width: 412px) {\n  .alignendsave {\n    display: flex;\n    justify-content: flex-start !important;\n    margin-left: 12px !important;\n    margin-right: 0px !important;\n  }\n\n  .packalign {\n    display: flex !important;\n    align-items: flex-start;\n    justify-content: flex-start;\n  }\n}\n@media (max-width: 1280px) and (min-width: 1278px) {\n  .widthcompmain {\n    width: 31% !important;\n  }\n\n  .widthcompsale {\n    width: 33% !important;\n    border-right: 1px solid #dadada;\n  }\n\n  .labelcmp {\n    min-width: 155px !important;\n  }\n\n  .nextrenewal {\n    width: 36% !important;\n  }\n}\n@media (max-width: 1366px) and (min-width: 1362px) {\n  .certificatelistview .certifcatesidenavwidth {\n    width: 80% !important;\n  }\n\n  .paymentview .collaberatebtncolor {\n    padding-right: 15px;\n  }\n\n  .paymentview {\n    margin-left: auto;\n    margin-right: auto;\n    max-width: 88% !important;\n    background: #fff;\n  }\n}\n.certificatelistview .certifcatesidenavwidth {\n  width: 75%;\n}\n.micro {\n  padding-left: 6px;\n  padding-right: 6px;\n  color: #fff !important;\n  background-color: #3e78d8;\n  padding-top: 2px;\n  padding-bottom: 2px;\n  font-size: 0.75rem;\n}\n.small {\n  padding-left: 6px;\n  padding-right: 6px;\n  color: #fff !important;\n  background-color: #f2ac1d;\n  padding-top: 2px;\n  padding-bottom: 2px;\n  font-size: 0.75rem;\n}\n.medium {\n  padding-left: 6px;\n  padding-right: 6px;\n  color: #fff !important;\n  background-color: #2fd0d4;\n  padding-top: 2px;\n  padding-bottom: 2px;\n  font-size: 0.75rem;\n}\n.large {\n  padding-left: 6px;\n  padding-right: 6px;\n  color: #fff !important;\n  background-color: #62a125;\n  padding-top: 2px;\n  padding-bottom: 2px;\n  font-size: 0.75rem;\n}\n.statuswidth .popover.popover-content.sm {\n  background-color: #333333 !important;\n  min-width: 366px;\n  box-shadow: 0 10px 6px -6px rgba(0, 0, 0, 0.2);\n  z-index: 9999;\n}\n.statuswidth .popover.popover-content .popover-body {\n  color: #fff !important;\n  font-size: 0.75rem;\n  line-height: 1.5;\n  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);\n  padding: 18px !important;\n}\n.statuswidth .popover.popover-content .arrow {\n  z-index: 9999 !important;\n}\n.statuswidth .popover.popover-content.bs-popover-top .arrow::before, .statuswidth .popover.popover-content.bs-popover-top .arrow::after, .statuswidth .popover.popover-content.bs-popover-top-right .arrow::before, .statuswidth .popover.popover-content.bs-popover-top-right .arrow::after, .statuswidth .popover.popover-content.bs-popover-top-left .arrow::before, .statuswidth .popover.popover-content.bs-popover-top-left .arrow::after {\n  content: \"\";\n  border-top: 18px solid #333 !important;\n  border-left: 18px solid transparent;\n  border-right: 18px solid transparent;\n  position: absolute;\n  transform: rotate(-360deg);\n  left: -14px !important;\n  top: -12px !important;\n}\n.statuswidth .popover.popover-content.bs-popover-bottom .arrow::after, .statuswidth .popover.popover-content.bs-popover-bottom-right .arrow::after, .statuswidth .popover.popover-content.bs-popover-bottom-left .arrow::after {\n  top: 0rem;\n  border-bottom-color: #333333 !important;\n}\n.statuswidth .popover.popover-content.bs-popover-bottom .arrow::before, .statuswidth .popover.popover-content.bs-popover-bottom-right .arrow::before, .statuswidth .popover.popover-content.bs-popover-bottom-left .arrow::before {\n  border-bottom-color: #333333 !important;\n}\n.paymentscroll {\n  max-height: 112px !important;\n  overflow: auto !important;\n}\n.paymentscroll::-webkit-scrollbar {\n  width: 0.5em;\n  position: absolute;\n  right: 0;\n}\n.paymentscroll::-webkit-scrollbar-track {\n  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);\n}\n.paymentscroll::-webkit-scrollbar-thumb {\n  background-color: #b8c3cb;\n}\n.classifywidth .classifysidenavwidth {\n  width: 75%;\n}\n.classifywidth {\n  position: relative;\n  z-index: 2;\n  box-sizing: border-box;\n  -webkit-overflow-scrolling: touch;\n  display: block;\n  overflow: hidden;\n}\n@media (max-width: 768px) {\n  .classifywidth .classifysidenavwidth {\n    width: 95% !important;\n  }\n}\n@media (max-width: 1024px) and (min-width: 769px) {\n  .classifywidth .classifysidenavwidth {\n    width: 95% !important;\n  }\n}\n@media (max-width: 1366px) and (min-width: 1280px) {\n  .classifywidth .classifysidenavwidth {\n    width: 85% !important;\n  }\n}\n@media (max-width: 767px) {\n  .classifywidth .classifysidenavwidth {\n    width: 100% !important;\n  }\n\n  .selectproductheaderwithclose {\n    height: auto !important;\n  }\n\n  .selectproductheaderwithclose .titletext {\n    display: block !important;\n  }\n\n  .selectproductheaderwithclose .closeandadd {\n    margin-bottom: 10px;\n  }\n\n  .selectproductheaderwithclose .clearandaddbutton {\n    justify-content: flex-start !important;\n    width: 100% !important;\n  }\n}\n#contactpopover .clable {\n  color: #666 !important;\n  font-size: 0.875rem !important;\n  line-height: 1rem !important;\n}\n#contactpopover .cvalue {\n  color: #333333 !important;\n  font-size: 0.9375rem !important;\n  line-height: 1rem !important;\n}\n[dir=rtl] .paymentview .borderspeccompanycolor {\n  margin-left: 0px;\n  margin-right: 0px !important;\n}\n[dir=rtl] .paymentview .borderemail {\n  margin-left: 0px;\n  margin-right: 0px !important;\n}\n[dir=rtl] .paymentview .colorlogo {\n  padding-right: 8px !important;\n  padding-left: 0px !important;\n}\n[dir=rtl] .paymentview .widthcompsale {\n  padding-right: 20px;\n}\n[dir=rtl] .paymentview .marginremovertl {\n  margin-right: 0px !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3Mvc3Vic2NyaXB0aW9ucGF5bWVudGxpc3Qvc3Vic2NyaXB0aW9ucGF5bWVudGxpc3QuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL3N1YnNjcmlwdGlvbnBheW1lbnRsaXN0L0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFjY291bnRzZXR0aW5nc1xcc3Vic2NyaXB0aW9ucGF5bWVudGxpc3RcXHN1YnNjcmlwdGlvbnBheW1lbnRsaXN0LmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBLGdCQUFnQjtBQ3FCaEI7RUFvSEksaUJBQUE7RUFDQSxrQkFBQTtFQUNBLGlCQUFBO0VBQ0EsZ0JBQUE7QUR0SUo7QUNnQkk7RUFOQSxhQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtBRFBKO0FDY0k7RUFDSSx5QkFBQTtBRFpSO0FDY0k7RUFDSSxjQUFBO0FEWlI7QUNjSTtFQUNJLG1CQUFBO0FEWlI7QUNjSTtFQUNJLGlCQUFBO0FEWlI7QUNlUTtFQUNJLG9CQUFBO0VBQ0EsV0FBQTtFQUNBLHlCQUFBO0FEYlo7QUNnQkk7RUFDSSxtQkFBQTtFQUNBLGtCQUFBO0FEZFI7QUNlUTtFQUNJLG9CQUFBO0VBQ0EsV0FBQTtFQUNBLHlCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLFVBQUE7QURiWjtBQ2NZO0VBQ0ksa0JBQUE7RUFDQSxRQUFBO0FEWmhCO0FDZVE7RUFDSSxlQUFBO0FEYlo7QUNjWTtFQUZKO0lBR1EsZUFBQTtFRFhkO0FBQ0Y7QUNjSTtFQTVEQSxhQUFBO0VBQ0Esc0NBQUE7RUFDQSw4QkFBQTtBRGlESjtBQ1lZO0VBQ0ksY0FBQTtFQUNBLG9CQUFBO0VBQ0EsNEJBQUE7RUFDQSxXQUFBO0VBQ0EsaUJBQUE7QURWaEI7QUNZWTtFQUNJLG9C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Z0RRO0VBQ0ksWUFBQTtFQUNBLGtCQUFBO0VBQ0EsUUFBQTtBRDdDWjtBQytDUTtFQUVJLDRDQUFBO0FENUNaO0FDK0NRO0VBQ0kseUJBQUE7QUQ1Q1o7QUNnRFE7RUFDSSxVQUFBO0FEN0NaO0FDZ0RRO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0Esc0JBQUE7RUFDQSxpQ0FBQTtFQUNBLGNBQUE7RUFDQSxnQkFBQTtBRDdDWjtBQ2dEUTtFQUNJO0lBQ0kscUJBQUE7RUQ3Q2Q7QUFDRjtBQ2dEUTtFQUNJO0lBQ0kscUJBQUE7RUQ5Q2Q7QUFDRjtBQ2dEUTtFQUNJO0lBQ0kscUJBQUE7RUQ5Q2Q7QUFDRjtBQ2dEUTtFQUNJO0lBQ0ksc0JBQUE7RUQ5Q2Q7O0VDZ0RVO0lBQ0ksdUJBQUE7RUQ3Q2Q7O0VDK0NVO0lBQ0kseUJBQUE7RUQ1Q2Q7O0VDOENVO0lBQ0ksbUJBQUE7RUQzQ2Q7O0VDOENVO0lBQ0ksc0NBQUE7SUFDQSxzQkFBQTtFRDNDZDtBQUNGO0FDK0NZO0VBQ0ksc0JBQUE7RUFDQSw4QkFBQTtFQUNBLDRCQUFBO0FEN0NoQjtBQytDYztFQUNFLHlCQUFBO0VBQ0EsK0JBQUE7RUFDQSw0QkFBQTtBRDdDaEI7QUNxRFE7RUFDSSxnQkFBQTtFQUNBLDRCQUFBO0FEbERaO0FDb0RRO0VBQ0ksZ0JBQUE7RUFDQSw0QkFBQTtBRGxEWjtBQ29EUTtFQUNLLDZCQUFBO0VBQ0EsNEJBQUE7QURsRGI7QUNvRFE7RUFDSyxtQkFBQTtBRGxEYjtBQ29EUTtFQUNJLDRCQUFBO0FEbERaIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3Mvc3Vic2NyaXB0aW9ucGF5bWVudGxpc3Qvc3Vic2NyaXB0aW9ucGF5bWVudGxpc3QuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJAY2hhcnNldCBcIlVURi04XCI7XG4ucGF5bWVudHZpZXcge1xuICBtYXJnaW4tbGVmdDogYXV0bztcbiAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICBtYXgtd2lkdGg6IDgzLjMzJTtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbn1cbi5wYXltZW50dmlldyAuc3BhY2VyZW5ldyB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLmp1c3RpZnllbmQge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xufVxuLnBheW1lbnR2aWV3IC5pbnB1dGluZm9pY29uIHtcbiAgY29sb3I6ICNmZjA1MDU7XG59XG4ucGF5bWVudHZpZXcgLm1hdC1leHBhbnNpb24tcGFuZWwtYm9keSB7XG4gIHBhZGRpbmctYm90dG9tOiAwcHg7XG59XG4ucGF5bWVudHZpZXcgLm1hdC1leHBhbnNpb24tcGFuZWwtc3BhY2luZyB7XG4gIG92ZXJmbG93OiBpbmhlcml0O1xufVxuLnBheW1lbnR2aWV3IC50aXRsZXRleHQgcCB7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xuICBtYXJnaW46IDBweDtcbiAgY29sb3I6ICMzMzMzMzMgIWltcG9ydGFudDtcbn1cbi5wYXltZW50dmlldyAuYWNjb3JkaW9uc2hvd3RleHQge1xuICBwYWRkaW5nLXJpZ2h0OiAyMHB4O1xuICBwYWRkaW5nLWxlZnQ6IDU1cHg7XG59XG4ucGF5bWVudHZpZXcgLmFjY29yZGlvbnNob3d0ZXh0IHAge1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjMzMzMzMzICFpbXBvcnRhbnQ7XG4gIGxpbmUtaGVpZ2h0OiAxLjY7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgdG9wOiAtMThweDtcbn1cbi5wYXltZW50dmlldyAuYWNjb3JkaW9uc2hvd3RleHQgcC5wb3NyZWx0b3AwIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0b3A6IDBweDtcbn1cbi5wYXltZW50dmlldyAuYWNjb3JkaW9uc2hvd3RleHQgLm13NzUge1xuICBtaW4td2lkdGg6IDc1cHg7XG59XG5AbWVkaWEgKG1pbi13aWR0aDogMTYwMHB4KSB7XG4gIC5wYXltZW50dmlldyAuYWNjb3JkaW9uc2hvd3RleHQgLm13NzUge1xuICAgIG1pbi13aWR0aDogODBweDtcbiAgfVxufVxuLnBheW1lbnR2aWV3IC5hbGlnbnBheW1lbnQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLnBheW1lbnR2aWV3IC5hbGlnbnBheW1lbnQgLmRlY2xpbmVkdGV4dCBoMiB7XG4gIGNvbG9yOiAjZmYwMDAwO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9zZW1pYm9sZFwiO1xuICBtYXJnaW46IDBweDtcbiAgbGluZS1oZWlnaHQ6IDI2cHg7XG59XG4ucGF5bWVudHZpZXcgLmFsaWducGF5bWVudCAuZGVjbGluZWR0ZXh0IHAge1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjMzMzMzMzICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctYm90dG9tOiA4cHg7XG4gIHdvcmQtYnJlYWs6IGJyZWFrLXdvcmQ7XG59XG4ucGF5bWVudHZpZXcgLm1hdC1leHBhbmRlZCAubWF0LWV4cGFuc2lvbi1pbmRpY2F0b3Ige1xuICBib3JkZXItcmFkaXVzOiA1MCU7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGhlaWdodDogMzBweDtcbiAgd2lkdGg6IDMwcHg7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbn1cbi5wYXltZW50dmlldyAubWF0LWV4cGFuc2lvbi1wYW5lbCB7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4ucGF5bWVudHZpZXcgLmJhY2tncm91bmRjb21tZW50IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZWRlZCAhaW1wb3J0YW50O1xufVxuLnBheW1lbnR2aWV3IC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlciB7XG4gIGhlaWdodDogNzZweCAhaW1wb3J0YW50O1xuICBib3JkZXItcmFkaXVzOiAwO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZlZGVkICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLm1hdC1leHBhbnNpb24tcGFuZWwtaGVhZGVyIHAge1xuICBtYXJnaW46IDA7XG59XG4ucGF5bWVudHZpZXcgLm1hdC1leHBhbnNpb24tcGFuZWwtY29udGVudCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmVkZWQgIWltcG9ydGFudDtcbn1cbi5wYXltZW50dmlldyAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXItZGVzY3JpcHRpb24ge1xuICBmbGV4LWdyb3c6IDA7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIG1hcmdpbi1yaWdodDogMDtcbn1cbi5wYXltZW50dmlldyAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXItZGVzY3JpcHRpb24gcCB7XG4gIHBhZGRpbmctcmlnaHQ6IDMwcHg7XG59XG4ucGF5bWVudHZpZXcgLnBvaW50ZXJ0ZXh0IHtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLnBheW1lbnR2aWV3IC5raW5kbHl0ZXh0IHtcbiAgcGFkZGluZy1sZWZ0OiAyMHB4O1xuICBwYWRkaW5nLXRvcDogMTBweDtcbn1cbi5wYXltZW50dmlldyAua2luZGx5dGV4dCBwIHtcbiAgY29sb3I6ICM2NjY2NjY7XG4gIG1hcmdpbjogMHB4O1xuICBmb250LXNpemU6IDAuODc1cmVtO1xufVxuLnBheW1lbnR2aWV3IC5raW5kbHl0ZXh0IHAgYSB7XG4gIGNvbG9yOiAjZjU4MDIwO1xuICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcbn1cbi5wYXltZW50dmlldyAuYWxpZ25lbmRzYXZlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5wYXltZW50dmlldyAuanNyc2NvbG9yIHtcbiAgcGFkZGluZy1ib3R0b206IDEwcHg7XG4gIHBhZGRpbmctbGVmdDogMjBweDtcbn1cbi5wYXltZW50dmlldyAuanNyc2NvbG9yIGgyIHtcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG4gIGNvbG9yOiAjMzMzO1xuICBtYXJnaW46IDBweDtcbn1cbi5wYXltZW50dmlldyAud2lkdGhmb3JtIHtcbiAgd2lkdGg6IDUwJTtcbn1cbi5wYXltZW50dmlldyAuY2FuY2VsIHtcbiAgd2lkdGg6IDE1MnB4O1xuICBoZWlnaHQ6IDQwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlY2VjZWM7XG4gIGNvbG9yOiAjNzI3MjcyO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnBheW1lbnR2aWV3IC5hZnRlcm5leHQ6OmFmdGVyIHtcbiAgY29udGVudDogXCJcIjtcbiAgYm9yZGVyLXRvcDogMThweCBzb2xpZCAjMDA2Y2I3O1xuICBib3JkZXItbGVmdDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcbiAgYm9yZGVyLXJpZ2h0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIGJvdHRvbTogMjA2cHg7XG4gIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoLTE4MGRlZyk7XG4gIHRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xuICBsZWZ0OiAzNXB4O1xuICBkaXNwbGF5OiBub25lO1xufVxuLnBheW1lbnR2aWV3IC5wb3NpdGlvbm5hbWUge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGJveC1zaGFkb3c6IDAgMCAyMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbn1cbi5wYXltZW50dmlldyAuYWZ0ZXJuZXh0IHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xufVxuLnBheW1lbnR2aWV3IC5oZWFkZXJldmVudCB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbi5wYXltZW50dmlldyAuaGVhZGVyZXZlbnQgaDIge1xuICBjb2xvcjogI2ZmZjtcbiAgbWFyZ2luOiAwcHg7XG4gIHBhZGRpbmctdG9wOiA0cHg7XG59XG4ucGF5bWVudHZpZXcgLnNlbmlvcmNvbG9yIHtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjZmZmO1xuICBsaW5lLWhlaWdodDogMC4zO1xufVxuLnBheW1lbnR2aWV3IC52YWx1ZWNvbG9yIHtcbiAgY29sb3I6ICNmMDgyMzU7XG59XG4ucGF5bWVudHZpZXcgLmFsaWduZW5kIHtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5wYXltZW50dmlldyAud2lkdGhsb2FkIHtcbiAgd2lkdGg6IDUwJTtcbn1cbi5wYXltZW50dmlldyAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb24ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNmY5O1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIG1heC1oZWlnaHQ6IDUwcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgcGFkZGluZzogMTJweCAyMHB4IDEycHggMjBweDtcbn1cbi5wYXltZW50dmlldyAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb24gcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LWZhbWlseTogXCJjYWlyb3NlbWlib2xkXCI7XG59XG4ucGF5bWVudHZpZXcgLnByb2plY3Rib3JkZXIge1xuICBib3JkZXItdG9wOiBub25lO1xuICBib3JkZXItbGVmdDogMXB4IHNvbGlkICNkYWRhZGE7XG4gIGJvcmRlci1yaWdodDogMXB4IHNvbGlkICNkYWRhZGE7XG4gIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGFkYWRhO1xufVxuLnBheW1lbnR2aWV3IC5lbWFpbGFsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5wYXltZW50dmlldyAuaW5mb2NtcHJhdGluZyB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5wYXltZW50dmlldyAubGFiZWxjbXBhZnRlciB7XG4gIGNvbG9yOiAjOTk5OTk5O1xuICBmb250LXNpemU6IDAuODc1cmVtO1xufVxuLnBheW1lbnR2aWV3IC5zYXZlIHtcbiAgd2lkdGg6IDE1MnB4O1xuICBoZWlnaHQ6IDQwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnBheW1lbnR2aWV3IC5tYXQtdGFiLWJvZHkubWF0LXRhYi1ib2R5LWFjdGl2ZSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgb3ZlcmZsb3cteDogaGlkZGVuO1xuICBvdmVyZmxvdy15OiBpbmhlcml0O1xuICB6LWluZGV4OiAxO1xuICBmbGV4LWdyb3c6IDE7XG59XG4ucGF5bWVudHZpZXcgLnNwY2VzbWUge1xuICBtYXJnaW4tbGVmdDogYXV0bztcbiAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICBtYXgtd2lkdGg6IDgzLjMzJTtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbn1cbi5wYXltZW50dmlldyAuY29sb3J0ZXh0eWVhciB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LWZhbWlseTogXCJjYWlyb3NlbWlib2xkXCI7XG59XG4ucGF5bWVudHZpZXcgLmJ1c2luZXNzdW5pdGluZm8ge1xuICB3aWR0aDogMzQlO1xuICB6LWluZGV4OiA5OTk5O1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIG1hcmdpbi1sZWZ0OiAtMTFweDtcbn1cbi5wYXltZW50dmlldyAucGF5ZW10bmxpc3Qge1xuICB3aWR0aDogMTAwJTtcbiAgei1pbmRleDogOTk5OTtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDI2cHg7XG4gIG1hcmdpbi1sZWZ0OiAtNXB4O1xufVxuLnBheW1lbnR2aWV3IC5kcm9wZG93bmxpc3Qge1xuICB3aWR0aDogMTAwJTtcbiAgei1pbmRleDogOTk5OTtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDI2cHg7XG4gIG1hcmdpbi1sZWZ0OiAtNXB4O1xufVxuLnBheW1lbnR2aWV3IC5wb3NpdGlvbiB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbi5wYXltZW50dmlldyAuYWZ0ZXJ1c2VyIC5oZWFkZXJpbmZvcm1hdGlvbnRleHQ6OmFmdGVyIHtcbiAgY29udGVudDogXCJcIjtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBsZWZ0OiAxMDBweDtcbiAgdG9wOiAtMTBweDtcbiAgd2lkdGg6IDA7XG4gIGhlaWdodDogMDtcbiAgYm9yZGVyLWxlZnQ6IDEwcHggc29saWQgdHJhbnNwYXJlbnQ7XG4gIGJvcmRlci1yaWdodDogMTBweCBzb2xpZCB0cmFuc3BhcmVudDtcbiAgYm9yZGVyLWJvdHRvbTogMTBweCBzb2xpZCAjZTFlZmZmO1xuICBjbGVhcjogYm90aDtcbiAgZGlzcGxheTogbm9uZTtcbn1cbi5wYXltZW50dmlldyAuaW52b2ljZWZvbnQgcCB7XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvc2VtaWJvbGRcIjtcbn1cbi5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLmNtcG55aW5mbyB7XG4gIG1hcmdpbi1ib3R0b206IDA7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHBhZGRpbmctYm90dG9tOiAxNXB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5jbXBueWluZm8gLmZpcnN0dGV4dGNvbG9yIHtcbiAgbWluLXdpZHRoOiAxMTBweDtcbn1cbi5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLmNtcG55aW5mbyAuc2Vjb25kY29udGVudHRleHQge1xuICB3b3JkLWJyZWFrOiBicmVhay13b3JkO1xuICBwYWRkaW5nLXJpZ2h0OiA4cHg7XG59XG4ucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLWJvZHkge1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbn1cbi5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50IC5wb3BvdmVyLWJvZHkgcCB7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMTJweCAhaW1wb3J0YW50O1xuICBsaW5lLWhlaWdodDogMS41ICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5zbSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIG1pbi13aWR0aDogMzY2cHg7XG4gIGJveC1zaGFkb3c6IDAgMTBweCA2cHggLTZweCByZ2JhKDAsIDAsIDAsIDAuMik7XG4gIHotaW5kZXg6IDk5OTk7XG59XG4ucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudCAucG9wb3Zlci1ib2R5IHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbiAgbGluZS1oZWlnaHQ6IDEuNTtcbiAgYm94LXNoYWRvdzogMCAwIDIwcHggcmdiYSgwLCAwLCAwLCAwLjIpO1xufVxuLnBheW1lbnR2aWV3IC5uZXh0cmVuZXdhbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQgLmFycm93IHtcbiAgei1pbmRleDogOTk5OSAhaW1wb3J0YW50O1xufVxuLnBheW1lbnR2aWV3IC5uZXh0cmVuZXdhbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci10b3AgLmFycm93OjpiZWZvcmUsIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wIC5hcnJvdzo6YWZ0ZXIsIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wLXJpZ2h0IC5hcnJvdzo6YmVmb3JlLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcC1yaWdodCAuYXJyb3c6OmFmdGVyLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcC1sZWZ0IC5hcnJvdzo6YmVmb3JlLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcC1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xuICBjb250ZW50OiBcIlwiO1xuICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICNmZmY7XG4gIGJvcmRlci1sZWZ0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xuICBib3JkZXItcmlnaHQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgdHJhbnNmb3JtOiByb3RhdGUoLTM2MGRlZyk7XG4gIGxlZnQ6IC03MHB4O1xuICB0b3A6IC04cHg7XG59XG4ucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6OmFmdGVyLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1yaWdodCAuYXJyb3c6OmFmdGVyLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xuICB0b3A6IDByZW07XG4gIGJvcmRlci1ib3R0b20tY29sb3I6ICNmZmY7XG59XG4ucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6OmJlZm9yZSwgLnBheW1lbnR2aWV3IC5uZXh0cmVuZXdhbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OjpiZWZvcmUsIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLWxlZnQgLmFycm93OjpiZWZvcmUge1xuICBib3JkZXItYm90dG9tLWNvbG9yOiAjZmZmO1xufVxuLnBheW1lbnR2aWV3IC5uZXh0cmVuZXdhbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20gLmFycm93OjpiZWZvcmUsIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tIC5hcnJvdzo6YWZ0ZXIsIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLXJpZ2h0IC5hcnJvdzo6YmVmb3JlLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1yaWdodCAuYXJyb3c6OmFmdGVyLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzo6YmVmb3JlLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xuICB0b3A6IC0ycHg7XG4gIGJvcmRlci13aWR0aDogMCA4cHggOHB4IDhweDtcbn1cbi5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tIC5hcnJvdzpiZWZvcmUsIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tIC5hcnJvdzphZnRlciwgLnBheW1lbnR2aWV3IC5uZXh0cmVuZXdhbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OmJlZm9yZSwgLnBheW1lbnR2aWV3IC5uZXh0cmVuZXdhbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OmFmdGVyLCAucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzpiZWZvcmUsIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLWxlZnQgLmFycm93OmFmdGVyIHtcbiAgdG9wOiAtMnB4ICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLmhlYWRlcnBvcHZpZXcge1xuICBtYXgtaGVpZ2h0OiA3MHB4O1xuICBiYWNrZ3JvdW5kOiAjNTg2MjZlO1xuICBtaW4taGVpZ2h0OiA3MHB4O1xufVxuLnBheW1lbnR2aWV3IC53aWR0aGZvcm1maWxlZCB7XG4gIHdpZHRoOiAyMzBweDtcbn1cbi5wYXltZW50dmlldyAudXNlcmNvbG9yIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNztcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgbGluZS1oZWlnaHQ6IDEycHg7XG4gIGhlaWdodDogMjVweDtcbn1cbi5wYXltZW50dmlldyAud2lkdGhpbWcge1xuICB3aWR0aDogMTVweDtcbiAgaGVpZ2h0OiAxNXB4O1xuICBwYWRkaW5nLWxlZnQ6IDhweDtcbn1cbi5wYXltZW50dmlldyAuc21lY29sb3Ige1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjNzFjMDE1O1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBoZWlnaHQ6IDIwcHg7XG4gIG1hcmdpbjogMHB4O1xuICBsaW5lLWhlaWdodDogMThweDtcbiAgcGFkZGluZzogMnB4IDZweCAycHggNnB4O1xufVxuLnBheW1lbnR2aWV3IC5zcGVuY2VyY29vcnBheW1lbnQgcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LWZhbWlseTogXCJjYWlyb3NlbWlib2xkXCI7XG59XG4ucGF5bWVudHZpZXcgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Ige1xuICBib3JkZXItdG9wOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICBtYXJnaW4tbGVmdDogMjBweDtcbiAgbWFyZ2luLXJpZ2h0OiAwcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjZmOTtcbiAgcGFkZGluZzogMjBweCAyMnB4IDIwcHggMjJweDtcbn1cbi5wYXltZW50dmlldyAubmV4dHJlbmV3YWwge1xuICBsaW5lLWhlaWdodDogMjVweDtcbn1cbi5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLmFmdGVyY29sb3J1c2VybGlzdCB7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIGNvbG9yOiAjZjQ4MTFmO1xufVxuLnBheW1lbnR2aWV3IC5hZnRlcmNvbG9ycmVuaWV3IHAge1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBjb2xvcjogI2Y0ODExZjtcbn1cbi5wYXltZW50dmlldyAud2lkdGhjb21wc2FsZSB7XG4gIHdpZHRoOiAzMy4zMyU7XG4gIGJvcmRlci1yaWdodDogMXB4IHNvbGlkICNkYWRhZGE7XG59XG4ucGF5bWVudHZpZXcgLm5leHRyZW5ld2FsIHtcbiAgd2lkdGg6IDMzLjMzJTtcbn1cbi5wYXltZW50dmlldyAuYWZ0ZXJjb2xvcnVzZXJsaXN0IHtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLnBheW1lbnR2aWV3IC5hZnRlcmNvbG9ycmVuaWV3cGFjayB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLnBheW1lbnR2aWV3IC5hbGlnbnBhc3N3b3JkIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5wYXltZW50dmlldyAuY21wbnlpbmZvIHtcbiAgbWFyZ2luLWJvdHRvbTogMDtcbiAgZGlzcGxheTogZmxleDtcbiAgcGFkZGluZy1ib3R0b206IDhweDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICBhbGlnbi1pdGVtczogZmxleC1zdGFydCAhaW1wb3J0YW50O1xufVxuLnBheW1lbnR2aWV3IC5jbXBueWluZm8gLmxhYmVsY21wZGVwIHtcbiAgY29sb3I6ICM5OTk5OTkgIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgbWluLXdpZHRoOiAxMTBweDtcbn1cbi5wYXltZW50dmlldyAuY21wbnlpbmZvIC5pbmZvY21wbmFuY2Uge1xuICBjb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDAuODc1cmVtO1xufVxuLnBheW1lbnR2aWV3IC5sYWJlbGNtcCB7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBtaW4td2lkdGg6IDE2NXB4O1xuICBsaW5lLWhlaWdodDogaW5oZXJpdCAhaW1wb3J0YW50O1xufVxuLnBheW1lbnR2aWV3IC5pbmZvY21wIHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4ucGF5bWVudHZpZXcgLnN0YXR1c3dpZHRoIHtcbiAgY29sb3I6ICM2NjY2NjY7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIGRpc3BsYXk6IGJsb2NrO1xufVxuLnBheW1lbnR2aWV3IC53aWR0aGltZ2NoZWNrIHtcbiAgd2lkdGg6IDIwcHg7XG4gIGhlaWdodDogMTZweDtcbn1cbi5wYXltZW50dmlldyAuYm9yZGVyZW1haWwge1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICBib3JkZXItdG9wOiBub25lO1xuICBkaXNwbGF5OiBmbGV4O1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xuICBtYXJnaW4tbGVmdDogMjBweDtcbn1cbi5wYXltZW50dmlldyAud2lkdGhjb21wIHtcbiAgd2lkdGg6IDUwJTtcbn1cbi5wYXltZW50dmlldyAud2lkdGhjb21wbWFpbiB7XG4gIHdpZHRoOiAzMy4zMyU7XG59XG4ucGF5bWVudHZpZXcgLmFsaWducGFzc3dvcmQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnBheW1lbnR2aWV3IC5jb2xvcmFjdGl2ZSB7XG4gIGZvbnQtd2VpZ2h0OiBub3JtYWwgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZDogIzIzODlmMTtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDIwcHg7XG4gIHBhZGRpbmc6IDJweCAxMXB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5wYXltZW50dmlldyAuc3BlbmNlcmNvb3Ige1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4ucGF5bWVudHZpZXcgLnNwZW5jZXJjb29yIGgyIHtcbiAgY29sb3I6ICMwMjJmNjc7XG59XG4ucGF5bWVudHZpZXcgLm1hcmtldGNvbG9yIHAge1xuICBjb2xvcjogIzMzMzMzMztcbn1cbi5wYXltZW50dmlldyAuYm9yZGVyc3BlYyB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gIG1hcmdpbi1sZWZ0OiAyMHB4O1xuICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG4gIHBhZGRpbmc6IDE4cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjZmOTtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgaGVpZ2h0OiAxMjJweDtcbn1cbi5wYXltZW50dmlldyAuYm9yZGVyc3BlY2hlaWdodCB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gIG1hcmdpbi1sZWZ0OiAyMHB4O1xuICBtYXJnaW4tcmlnaHQ6IDIwcHg7XG4gIHBhZGRpbmc6IDE4cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjZmOTtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgaGVpZ2h0OiAxMjJweDtcbn1cbi5wYXltZW50dmlldyAuZG9tYWluY29sb3IgcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LWZhbWlseTogXCJjYWlyb3NlbWlib2xkXCI7XG59XG4ucGF5bWVudHZpZXcgLmRvbWFpbmNvbG9yIHNwYW4ge1xuICBjb2xvcjogI2YwODIzNTtcbn1cbi5wYXltZW50dmlldyAucmVuZXdjb2xvciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlMGYwZmY7XG4gIGNvbG9yOiAjMDA2Y2I3O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgbGluZS1oZWlnaHQ6IDE7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGhlaWdodDogMjVweDtcbiAgYm9yZGVyOiAxcHggc29saWQgIzAwNmNiNztcbiAgd2lkdGg6IDExNXB4O1xufVxuLnBheW1lbnR2aWV3IC5mbGV4cGFnYWUge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG59XG4ucGF5bWVudHZpZXcgLmNvbGxhYmVyYXRlY29sb3Ige1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjQ4MTFmO1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBsaW5lLWhlaWdodDogMTtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgaGVpZ2h0OiAyNXB4O1xufVxuLnBheW1lbnR2aWV3IC5mbGV4cmVuZXcge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogZmxleC1lbmQ7XG59XG4ucGF5bWVudHZpZXcgLmZsZXhzdGFydGFsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5wYXltZW50dmlldyAuZmxleHN0YXJ0YWxpZ24gcCB7XG4gIG1hcmdpbi1ib3R0b206IDZweCAhaW1wb3J0YW50O1xufVxuLnBheW1lbnR2aWV3IC5mbGV4c3RhcnRhbGlnbiAucGF5bWVudHN0YXR1c2NvbG9yIFAge1xuICBjb2xvcjogIzY2NjY2NjtcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4ucGF5bWVudHZpZXcgLmZsZXhzdGFydGFsaWduIC5wYXltZW50c3RhdHVzY29sb3IgLnBvc3RlZHZlcmlmaWNhdGlvbiwgLnBheW1lbnR2aWV3IC5mbGV4c3RhcnRhbGlnbiAucGF5bWVudHN0YXR1c2NvbG9yIC5yZXN1Ym1pdCwgLnBheW1lbnR2aWV3IC5mbGV4c3RhcnRhbGlnbiAucGF5bWVudHN0YXR1c2NvbG9yIC5wYXltZW50aW5wcm9ncmVzcywgLnBheW1lbnR2aWV3IC5mbGV4c3RhcnRhbGlnbiAucGF5bWVudHN0YXR1c2NvbG9yIC5mYWlsZWQsIC5wYXltZW50dmlldyAuZmxleHN0YXJ0YWxpZ24gLnBheW1lbnRzdGF0dXNjb2xvciAuYXBwcm92ZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMxZTk5Zjc7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGxpbmUtaGVpZ2h0OiAxO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBoZWlnaHQ6IDI1cHg7XG59XG4ucGF5bWVudHZpZXcgLmZsZXhzdGFydGFsaWduIC5wYXltZW50c3RhdHVzY29sb3IgLmFwcHJvdmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjNTBhZjQ5ICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLmZsZXhzdGFydGFsaWduIC5wYXltZW50c3RhdHVzY29sb3IgLmZhaWxlZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmMjNmM2EgIWltcG9ydGFudDtcbn1cbi5wYXltZW50dmlldyAuZmxleHN0YXJ0YWxpZ24gLnBheW1lbnRzdGF0dXNjb2xvciAucGF5bWVudGlucHJvZ3Jlc3Mge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmM5MjAyICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLmZsZXhzdGFydGFsaWduIC5wYXltZW50c3RhdHVzY29sb3IgLnJlc3VibWl0IHtcbiAgYmFja2dyb3VuZDogI2Y0ODExZiAhaW1wb3J0YW50O1xufVxuLnBheW1lbnR2aWV3IC5jb2xsYWJlcmF0ZWJ0bmNvbG9yIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZiZTRkMDtcbiAgY29sb3I6ICNmNDhjMzQ7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZjQ4YzM0O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgbGluZS1oZWlnaHQ6IDE7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGhlaWdodDogMjVweDtcbiAgd2lkdGg6IDEzNXB4ICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZCB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDc7XG59XG4ucGF5bWVudHZpZXcgLnJldmlld2J0bmNvbG9yIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNztcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgbGluZS1oZWlnaHQ6IDE7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGhlaWdodDogMjVweDtcbn1cbi5wYXltZW50dmlldyAuYnRuYWxpZ24ge1xuICBtYXJnaW4tYm90dG9tOiA2cHg7XG59XG4ucGF5bWVudHZpZXcgLmJ0bmFsaWduIHAge1xuICBjb2xvcjogIzMzMzMzMztcbn1cbi5wYXltZW50dmlldyAuaW1hZ2VhbGlnbiB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGNvbG9yOiBibGFjaztcbn1cbi5wYXltZW50dmlldyAuaW1hZ2VhbGlnbiBpbWcge1xuICBwYWRkaW5nLWxlZnQ6IDE0cHg7XG59XG4ucGF5bWVudHZpZXcgLmJhY2tncm91bmQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBtYXJnaW4tbGVmdDogMTI3cHg7XG4gIG1hcmdpbi1yaWdodDogMTI3cHg7XG4gIGhlaWdodDogNDEwcHg7XG4gIG92ZXJmbG93OiBoaWRkZW47XG4gIG1hcmdpbi10b3A6IDMwcHg7XG4gIGJvcmRlci1yYWRpdXM6IDRweDtcbn1cbi5wYXltZW50dmlldyAuYmFja2dyb3VuZCBoNCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xufVxuLnBheW1lbnR2aWV3IC5hZnRlcnBhbmVsOjphZnRlciB7XG4gIGNvbnRlbnQ6IFwiXCI7XG4gIGJvcmRlci10b3A6IDE4cHggc29saWQgIzM1M2I0NztcbiAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XG4gIGJvcmRlci1yaWdodDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBib3R0b206IDk1cHg7XG4gIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoLTE4MGRlZyk7XG4gIHRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xuICByaWdodDogMTVweDtcbn1cbi5wYXltZW50dmlldyAuZWRpdDo6YWZ0ZXIge1xuICBmb250LWZhbWlseTogXCJiZ2ktaWNvblwiICFpbXBvcnRhbnQ7XG4gIGZvbnQtc3R5bGU6IG5vcm1hbDtcbiAgZm9udC13ZWlnaHQ6IG5vcm1hbDtcbiAgZm9udC12YXJpYW50OiBub3JtYWw7XG4gIHRleHQtdHJhbnNmb3JtOiBub25lO1xuICBsaW5lLWhlaWdodDogMTtcbiAgLXdlYmtpdC1mb250LXNtb290aGluZzogYW50aWFsaWFzZWQ7XG4gIC1tb3otb3N4LWZvbnQtc21vb3RoaW5nOiBncmF5c2NhbGU7XG4gIGNvbnRlbnQ6IFwi7qSIXCI7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgY29sb3I6ICM5OTk5OTk7XG4gIGZvbnQtc2l6ZTogOXB4O1xuICB0b3A6IDE0cHg7XG4gIHJpZ2h0OiAxNXB4O1xufVxuLnBheW1lbnR2aWV3IC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIG1hcmdpbi1sZWZ0OiAxMjdweCAhaW1wb3J0YW50O1xuICBtYXJnaW4tcmlnaHQ6IDEyN3B4ICFpbXBvcnRhbnQ7XG4gIG92ZXJmbG93OiBoaWRkZW47XG4gIGhlaWdodDogNTIwcHg7XG4gIG1hcmdpbi10b3A6IDMwcHg7XG4gIGJvcmRlci1yYWRpdXM6IDRweDtcbn1cbi5wYXltZW50dmlldyAuYmFja2dyb3VuZG5leHRkZXNpZ24gaDQge1xuICBjb2xvcjogIzMzMzMzMztcbn1cbi5wYXltZW50dmlldyAuZWRpdCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlY2VjZWM7XG4gIGNvbG9yOiAjOTk5OTk5O1xuICBmb250LXNpemU6IDE0cHg7XG4gIGZvbnQtZmFtaWx5OiBjYWxpYnJpO1xuICBib3JkZXItcmFkaXVzOiA0cHggIWltcG9ydGFudDtcbiAgd2lkdGg6IDEwMHB4O1xuICBoZWlnaHQ6IDM1cHg7XG4gIG1hcmdpbi1ib3R0b206IDIwcHg7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xufVxuLnBheW1lbnR2aWV3IC5udW1iZXJidG4ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWNlY2VjO1xuICBjb2xvcjogIzk5OTk5OTtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBmb250LWZhbWlseTogY2FsaWJyaTtcbiAgYm9yZGVyLXJhZGl1czogNHB4ICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMjZweDtcbiAgaGVpZ2h0OiAzNXB4O1xuICBtYXJnaW4tYm90dG9tOiAyMHB4O1xufVxuLnBheW1lbnR2aWV3IC5zYXZlY2hhbmdlc2J0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG4gIGNvbG9yOiAjZmZmO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICB3aWR0aDogMTIwcHg7XG4gIGhlaWdodDogMzVweDtcbiAgYm9yZGVyLXJhZGl1czogNHB4ICFpbXBvcnRhbnQ7XG59XG4ucGF5bWVudHZpZXcgLnN1Ym1pdGJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG4gIGNvbG9yOiAjZmZmO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICB3aWR0aDogNzVweDtcbiAgaGVpZ2h0OiAzNXB4O1xuICBib3JkZXItcmFkaXVzOiA0cHggIWltcG9ydGFudDtcbn1cbi5wYXltZW50dmlldyAuaW1hZ2VhbGlnbiBpbWcge1xuICBoZWlnaHQ6IDE2cHg7XG59XG4ucGF5bWVudHZpZXcgLmNhbmNlbGJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlY2VjZWM7XG4gIGNvbG9yOiAjOTk5OTk5O1xuICBmb250LXNpemU6IDE0cHg7XG4gIGZvbnQtZmFtaWx5OiBjYWxpYnJpO1xuICBib3JkZXItcmFkaXVzOiA0cHggIWltcG9ydGFudDtcbiAgd2lkdGg6IDcwcHg7XG4gIGhlaWdodDogMzVweDtcbiAgbWFyZ2luLWJvdHRvbTogMjBweDtcbn1cbi5wYXltZW50dmlldyAuZmxleGVuZCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XG59XG4ucGF5bWVudHZpZXcgLmRvdGVkIHtcbiAgaGVpZ2h0OiA2cHg7XG4gIHdpZHRoOiA2cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICMzMzMzMzM7XG4gIGJvcmRlci1yYWRpdXM6IDUwJTtcbiAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xufVxuLnBheW1lbnR2aWV3IC5ib3JkZXJib3R0b20ge1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RhZGFkYTtcbn1cbi5wYXltZW50dmlldyAuZmxleGFsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbiAgcGFkZGluZy1yaWdodDogNTZweDtcbn1cbi5wYXltZW50dmlldyAjY2RrLW92ZXJsYXktMCAubWF0LW1lbnUtcGFuZWwge1xuICBiYWNrZ3JvdW5kOiB3aGl0ZTtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICByaWdodDogMjhweDtcbiAgb3ZlcmZsb3c6IGluaXRpYWw7XG59XG4ucGF5bWVudHZpZXcgLmltYWdlOmFmdGVyIHtcbiAgY29udGVudDogXCJcIjtcbiAgYmFja2dyb3VuZDogIzI3YjhlNztcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBoZWlnaHQ6IDYyJTtcbiAgcmlnaHQ6IC01cHg7XG4gIHdpZHRoOiA0MiU7XG4gIHotaW5kZXg6IC0xO1xuICBib3R0b206IC0zMHB4O1xufVxuLnBheW1lbnR2aWV3IC5pbWFnZSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgei1pbmRleDogOTk5OTtcbn1cbi5wYXltZW50dmlldyAubWF0LW1lbnUtcGFuZWwge1xuICBtaW4td2lkdGg6IDExMnB4O1xuICBtYXgtd2lkdGg6IDI4MHB4O1xuICBvdmVyZmxvdzogYXV0bztcbiAgLXdlYmtpdC1vdmVyZmxvdy1zY3JvbGxpbmc6IHRvdWNoO1xuICBtYXgtaGVpZ2h0OiBjYWxjKDEwMHZoIC0gNDhweCk7XG4gIGJvcmRlci1yYWRpdXM6IDRweDtcbiAgb3V0bGluZTogMDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICByaWdodDogMjhweDtcbn1cbi5wYXltZW50dmlldyAuaW1hZ2UgaW1nIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0b3A6IDI1cHg7XG59XG4ucGF5bWVudHZpZXcgLmN1c3RvbS1tb2RhbGJveCAubWF0LWRpYWxvZy1jb250YWluZXIge1xuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcbiAgd2lkdGg6IDEwMCU7XG59XG4ucGF5bWVudHZpZXcgLmJvcmRlcjEgLm1hdC1idXR0b24tdG9nZ2xlLWJ1dHRvbiB7XG4gIGJvcmRlcjogMDtcbiAgYmFja2dyb3VuZDogMCAwO1xuICBjb2xvcjogaW5oZXJpdDtcbiAgcGFkZGluZzogMDtcbiAgbWFyZ2luOiAwO1xuICBmb250OiBpbmhlcml0O1xuICBvdXRsaW5lOiAwO1xuICB3aWR0aDogODBweCAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBib3JkZXI6IDFweCBzb2xpZCAjMDA2Y2I3O1xufVxuLnBheW1lbnR2aWV3IC5kaXNwbGF5IHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xufVxuLnBheW1lbnR2aWV3IC5jdXJyZW50IHAge1xuICBtYXJnaW4tcmlnaHQ6IDZweDtcbn1cbi5wYXltZW50dmlldyAudmVyZmllZGFsaWduIHNwYW4ge1xuICBjb2xvcjogIzcwYzAxNTtcbn1cbi5wYXltZW50dmlldyAucmVtb3ZldGV4dGNvbG9yIHNwYW4ge1xuICBjb2xvcjogIzRhNmVhNjtcbn1cbi5wYXltZW50dmlldyAuYnRuIHtcbiAgY29sb3I6ICM2MzY4NmU7XG4gIHdpZHRoOiAxMzBweDtcbiAgaGVpZ2h0OiAzOHB4O1xuICBib3JkZXItcmFkaXVzOiAwO1xuICBib3gtc2hhZG93OiBub25lO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZThlYmYwO1xuICBib3JkZXItcmFkaXVzOiA1cHg7XG59XG4ucGF5bWVudHZpZXcgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Ige1xuICBib3JkZXItdG9wOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICBtYXJnaW4tbGVmdDogMjBweDtcbiAgbWFyZ2luLXJpZ2h0OiAwcHg7XG4gIHBhZGRpbmc6IDIwcHggMjVweCAwcHggMjVweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNmY5O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcbiAgLmFsaWduZG9taWFuIHtcbiAgICBwYWRkaW5nLWJvdHRvbTogMTVweDtcbiAgfVxuXG4gIC5yZXNwb25zaXZlcGFkZGluZ3dpZHRoIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDE4cHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5mbGV4YWxpZ24ge1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gICAgcGFkZGluZy1yaWdodDogMHB4O1xuICB9XG4gIC5mbGV4YWxpZ24gLmJhY2tncm91bmRuZXh0ZGVzaWduIHtcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICAgIG1hcmdpbi1sZWZ0OiAxMHB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXJpZ2h0OiAxMHB4ICFpbXBvcnRhbnQ7XG4gICAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgICBtYXJnaW4tdG9wOiAzMHB4O1xuICAgIGJvcmRlci1yYWRpdXM6IDRweDtcbiAgfVxuICAuZmxleGFsaWduIC5iYWNrZ3JvdW5kbmV4dGRlc2lnbiBoNCB7XG4gICAgY29sb3I6ICMzMzMzMzM7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuICAuZmxleGFsaWduIC5mbGV4YWxpZ24ge1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gICAgcGFkZGluZy1yaWdodDogMHB4O1xuICB9XG4gIC5mbGV4YWxpZ24gLnJlc3BvbnNpdmVwYWRkaW5nIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDhweCAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTAyNHB4KSBhbmQgKG1pbi13aWR0aDogNzY5cHgpIHtcbiAgLmJhY2tncm91bmRuZXh0ZGVzaWduIGg0IHtcbiAgICBjb2xvcjogIzMzMzMzMztcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmJhY2tncm91bmQgaDQge1xuICAgIGNvbG9yOiAjMzMzMzMzO1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAuY2FuZWRpdHJlc3BvbnNpdmV3aWR0aCB7XG4gICAgbWF4LXdpZHRoOiAyMyUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5zdWJtaXRyZXNwb25zaXZlIHtcbiAgICBtYXgtd2lkdGg6IDQzJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmVtYWlscmVzcG9uc2l2ZXdpZHRoIHtcbiAgICBtYXgtd2lkdGg6IDY1JSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNhbmNlbHJlc3BvbnNpdmV3aWR0aCB7XG4gICAgbWF4LXdpZHRoOiAzNSUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC51cGRhdGVkYXRld2lkdGgge1xuICAgIG1heC13aWR0aDogNzIlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWx0ZXJuYXRlcmVzcG9uc2l2ZXdpZHRoIHtcbiAgICBtYXgtd2lkdGg6IDU3JSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNoYW5nZW51bWJlcmJ0bndpZHRoIHtcbiAgICBtYXgtd2lkdGg6IDI4JSAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNjAwcHgpIHtcbiAgLmJ0bnJlc3BvbnNpdmUge1xuICAgIGRpc3BsYXk6IGNvbnRlbnRzO1xuICB9XG5cbiAgLnBheW1lbnR2aWV3IC5uZXh0cmVuZXdhbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuc20ge1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gICAgbWluLXdpZHRoOiAzMjBweCAhaW1wb3J0YW50O1xuICAgIGJveC1zaGFkb3c6IDAgMTBweCA2cHggLTZweCByZ2JhKDAsIDAsIDAsIDAuMik7XG4gICAgbGVmdDogMjRweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmJsb2NrcmVzcG9uc2l2ZXdpZHRoIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnN1Ym1pdGNvbnRlbnR3aWR0aCB7XG4gICAgZGlzcGxheTogY29udGVudHM7XG4gIH1cblxuICAuc3BhY2luZ2ZpbGVkIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLmJsb2NrYWxpZ24ge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAudmVyZmllZG9ucmVzcG9uc2l2ZXdpZHRoIHtcbiAgICBtYXgtd2lkdGg6IDgwJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnZlcmZpZWRhbGlnbiBzcGFuIHtcbiAgICBjb2xvcjogIzcwYzAxNTtcbiAgICBwYWRkaW5nLWxlZnQ6IDZweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmltYWdlYWxpZ24ge1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBjb2xvcjogYmxhY2s7XG4gIH1cbiAgLmltYWdlYWxpZ24gaW1nIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDRweDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gIC5jZXJ0aWZpY2F0ZWxpc3R2aWV3IC5jZXJ0aWZjYXRlc2lkZW5hdndpZHRoIHtcbiAgICB3aWR0aDogOTglICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuZmxleHBhZ2FlIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmZsZXhyZW5ldyB7XG4gICAgbWFyZ2luLXRvcDogMTBweDtcbiAgfVxuXG4gIC5zcGVuY2VyY29vcnBheW1lbnRjbGFzc2lmaWNhdGlvbiB7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjZmOTtcbiAgICBtYXgtaGVpZ2h0OiAxMTJweCAhaW1wb3J0YW50O1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gICAgcGFkZGluZzogMTJweCAwcHggMTJweCAyMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWZ0ZXJuZXh0OjphZnRlciB7XG4gICAgY29udGVudDogXCJcIjtcbiAgICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICMwMDZjYjc7XG4gICAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XG4gICAgYm9yZGVyLXJpZ2h0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgICBib3R0b206IDE4OHB4ICFpbXBvcnRhbnQ7XG4gICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICBsZWZ0OiAzNXB4O1xuICB9XG5cbiAgLmFjdGl2ZXNjcm9sbCAuYXJyb3cge1xuICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC53aWR0aGNvbXAge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhjb21wbWFpbiB7XG4gICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxuXG4gIC5ib3JkZXJzcGVjaGVpZ2h0IHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBoZWlnaHQ6IDE5OHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGh1c2VyYnRuIHtcbiAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgICBtYXJnaW4tdG9wOiAxNXB4O1xuICB9XG5cbiAgLmJvcmRlcmVtYWlsIHtcbiAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgICBib3JkZXItbGVmdDogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2Q3ZDdkNztcbiAgICBib3JkZXItdG9wOiBub25lO1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhjb21wIHtcbiAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmctYm90dG9tOiAxMnB4O1xuICB9XG5cbiAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Ige1xuICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcbiAgICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xuICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xuICAgIG1hcmdpbi1yaWdodDogMHB4O1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNmNWY2Zjk7XG4gICAgcGFkZGluZzogMjBweCAyMnB4IDIwcHggMjJweDtcbiAgfVxuXG4gIC5uZXh0cmVuZXdhbCB7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgICBwYWRkaW5nLXRvcDogMTBweDtcbiAgfVxuXG4gIC53aWR0aGNvbXBzYWxlIHtcbiAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICAgIGJvcmRlci1yaWdodDogbm9uZSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwZW5jZXJjb29ycGF5bWVudGNsYXNzaWZpY2F0aW9uIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICAgIHBhZGRpbmc6IDEycHg7XG4gIH1cblxuICAuc3BhY2VidG4ge1xuICAgIG1hcmdpbi10b3A6IDEwcHg7XG4gIH1cblxuICAuYWxpZ25wYXNzd29yZCB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmFsaWduZG9taWFuIHtcbiAgICBtYXJnaW4tYm90dG9tOiAwO1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgbGluZS1oZWlnaHQ6IDI1cHg7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICAgIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc3BjZXNtZSB7XG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICAgIG1heC13aWR0aDogOTcuMzMlICFpbXBvcnRhbnQ7XG4gICAgYmFja2dyb3VuZDogI2ZmZjtcbiAgfVxuXG4gIC5wYWNrYWxpZ24ge1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIH1cblxuICAud2lkdGhmb3JtIHtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTAyNHB4KSBhbmQgKG1pbi13aWR0aDogNzY5cHgpIHtcbiAgLmNlcnRpZmljYXRlbGlzdHZpZXcgLmNlcnRpZmNhdGVzaWRlbmF2d2lkdGgge1xuICAgIHdpZHRoOiA5OCUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5mbGV4cGFnYWUge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuZmxleHJlbmV3IHtcbiAgICBtYXJnaW4tdG9wOiAxMHB4O1xuICB9XG5cbiAgLnBhY2thbGlnbiB7XG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICAgIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgfVxuXG4gIC5hZnRlcm5leHQ6OmFmdGVyIHtcbiAgICBjb250ZW50OiBcIlwiO1xuICAgIGJvcmRlci10b3A6IDE4cHggc29saWQgIzAwNmNiNztcbiAgICBib3JkZXItbGVmdDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcbiAgICBib3JkZXItcmlnaHQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XG4gICAgcG9zaXRpb246IGFic29sdXRlO1xuICAgIGJvdHRvbTogMTg3cHg7XG4gICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICBsZWZ0OiAzNXB4O1xuICB9XG5cbiAgLmJvcmRlcmVtYWlsIHtcbiAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2Q3ZDdkNztcbiAgICBib3JkZXItbGVmdDogMXB4IHNvbGlkICNkN2Q3ZDc7XG4gICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2Q3ZDdkNztcbiAgICBib3JkZXItdG9wOiBub25lO1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhmb3JtIHtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoY29tcCB7XG4gICAgd2lkdGg6IDU2JSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNoYWRvdyB7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgICBtYXJnaW4tbGVmdDogYXV0bztcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gICAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLm5leHRyZW5ld2FsIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoY29tcHNhbGUge1xuICAgIHdpZHRoOiA0MCUgIWltcG9ydGFudDtcbiAgICBib3JkZXItcmlnaHQ6IG5vbmUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC53aWR0aGNvbXBtYWluIHtcbiAgICB3aWR0aDogMzQlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb24ge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gICAgcGFkZGluZzogMTJweDtcbiAgICBtYXgtaGVpZ2h0OiA3NXB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWxpZ25wYXNzd29yZCB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwYWNlYnRuIHtcbiAgICBtYXJnaW4tdG9wOiAxMHB4O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIGFuZCAobWluLXdpZHRoOiAzMThweCkge1xuICAuYm9yZGVyZW1haWwge1xuICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5mbGV4cGFnYWUge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY21wbnlpbmZvIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwYWNlbWFyZ2luIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2Uge1xuICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLnRpdGxldGV4dCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbG9zZWFuZGFkZCB7XG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgfVxuXG4gIC5zcGFjaW5nIHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAxMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAuY2xlYXJhbmRhZGRidXR0b24ge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNlcnRpZmljYXRlbGlzdHZpZXcgLmNlcnRpZmNhdGVzaWRlbmF2d2lkdGgge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWFpbnRhYiAubWF0LXRhYi1ib2R5LWNvbnRlbnQge1xuICAgIGhlaWdodDogYXV0bztcbiAgICBvdmVyZmxvdzogaGlkZGVuICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWZ0ZXJuZXh0OjphZnRlciB7XG4gICAgY29udGVudDogXCJcIjtcbiAgICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICMwMDZjYjc7XG4gICAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XG4gICAgYm9yZGVyLXJpZ2h0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgICBib3R0b206IDE4OHB4ICFpbXBvcnRhbnQ7XG4gICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcbiAgICBsZWZ0OiAxMzBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnBhY2thbGlnbiB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIH1cblxuICAuc3BjZXNtZSB7XG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICAgIG1heC13aWR0aDogOTAlICFpbXBvcnRhbnQ7XG4gICAgYmFja2dyb3VuZDogI2ZmZjtcbiAgfVxuXG4gIC5uZXh0cmVuZXdhbCB7XG4gICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxuXG4gIC5kb3duc3BhY2Uge1xuICAgIG1hcmdpbi10b3A6IDEwcHg7XG4gIH1cblxuICAuYWN0aXZlc2Nyb2xsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6OmFmdGVyLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OjphZnRlciwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLWxlZnQgLmFycm93OjphZnRlciB7XG4gICAgdG9wOiAwcmVtO1xuICAgIGJvcmRlci1ib3R0b20tY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5hY3RpdmVzY3JvbGwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tIC5hcnJvdzo6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OjpiZWZvcmUsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzo6YmVmb3JlIHtcbiAgICBib3JkZXItYm90dG9tLWNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuc3BlbmNlcmNvb3Ige1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIH1cblxuICAuYWxpZ25wYXNzd29yZCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNoYW5nZWNvbG9yIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLnByb2plY3Rib3JkZXIge1xuICAgIHBhZGRpbmc6IDEycHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5ib3JkZXJzcGVjaGVpZ2h0IHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNlZWYwZjQ7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBoZWlnaHQ6IDI3MnB4ICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZzogMTJweCAhaW1wb3J0YW50O1xuICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5tYXJrZXRjb2xvciB7XG4gICAgcGFkZGluZy10b3A6IDEwcHg7XG4gIH1cblxuICAudGl0bGUge1xuICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Ige1xuICAgIGJvcmRlcjogMXB4IHNvbGlkICNkN2Q3ZDcgIWltcG9ydGFudDtcbiAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXJpZ2h0OiAwcHg7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gICAgcGFkZGluZzogMTJweCAxMnB4IDEycHggMTJweDtcbiAgICBib3JkZXI6IG5vbmU7XG4gIH1cblxuICAuYm9yZGVyZW1haWwge1xuICAgIHBhZGRpbmctbGVmdDogMTJweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoaW1nY2hlY2sge1xuICAgIHBhZGRpbmctbGVmdDogMnB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWxpZ25lbmQge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgaGVpZ2h0OiAxMDAlO1xuICB9XG5cbiAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZCB7XG4gICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yZG93bmxvYWRhbm90aGVyIHtcbiAgICBtYXJnaW4tdG9wOiAyMHB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLWxlZnQ6IDIwcHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRobG9hZCB7XG4gICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xuICB9XG5cbiAgLmFsaWduZW5kc2F2ZSB7XG4gICAgZGlzcGxheTogYmxvY2s7XG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gICAgbWFyZ2luLWxlZnQ6IDEycHg7XG4gIH1cblxuICAuY2FuY2VsIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLndpZHRoZm9ybSB7XG4gICAgcGFkZGluZy1sZWZ0OiAxMnB4ICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1yaWdodDogMTJweCAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNDE0cHgpIGFuZCAobWluLXdpZHRoOiA0MTJweCkge1xuICAuYWxpZ25lbmRzYXZlIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICAgIG1hcmdpbi1sZWZ0OiAxMnB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5wYWNrYWxpZ24ge1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiAxMjgwcHgpIGFuZCAobWluLXdpZHRoOiAxMjc4cHgpIHtcbiAgLndpZHRoY29tcG1haW4ge1xuICAgIHdpZHRoOiAzMSUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC53aWR0aGNvbXBzYWxlIHtcbiAgICB3aWR0aDogMzMlICFpbXBvcnRhbnQ7XG4gICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2RhZGFkYTtcbiAgfVxuXG4gIC5sYWJlbGNtcCB7XG4gICAgbWluLXdpZHRoOiAxNTVweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLm5leHRyZW5ld2FsIHtcbiAgICB3aWR0aDogMzYlICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiAxMzY2cHgpIGFuZCAobWluLXdpZHRoOiAxMzYycHgpIHtcbiAgLmNlcnRpZmljYXRlbGlzdHZpZXcgLmNlcnRpZmNhdGVzaWRlbmF2d2lkdGgge1xuICAgIHdpZHRoOiA4MCUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5wYXltZW50dmlldyAuY29sbGFiZXJhdGVidG5jb2xvciB7XG4gICAgcGFkZGluZy1yaWdodDogMTVweDtcbiAgfVxuXG4gIC5wYXltZW50dmlldyB7XG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICAgIG1heC13aWR0aDogODglICFpbXBvcnRhbnQ7XG4gICAgYmFja2dyb3VuZDogI2ZmZjtcbiAgfVxufVxuLmNlcnRpZmljYXRlbGlzdHZpZXcgLmNlcnRpZmNhdGVzaWRlbmF2d2lkdGgge1xuICB3aWR0aDogNzUlO1xufVxuXG4ubWljcm8ge1xuICBwYWRkaW5nLWxlZnQ6IDZweDtcbiAgcGFkZGluZy1yaWdodDogNnB4O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjM2U3OGQ4O1xuICBwYWRkaW5nLXRvcDogMnB4O1xuICBwYWRkaW5nLWJvdHRvbTogMnB4O1xuICBmb250LXNpemU6IDAuNzVyZW07XG59XG5cbi5zbWFsbCB7XG4gIHBhZGRpbmctbGVmdDogNnB4O1xuICBwYWRkaW5nLXJpZ2h0OiA2cHg7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmMmFjMWQ7XG4gIHBhZGRpbmctdG9wOiAycHg7XG4gIHBhZGRpbmctYm90dG9tOiAycHg7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbn1cblxuLm1lZGl1bSB7XG4gIHBhZGRpbmctbGVmdDogNnB4O1xuICBwYWRkaW5nLXJpZ2h0OiA2cHg7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICMyZmQwZDQ7XG4gIHBhZGRpbmctdG9wOiAycHg7XG4gIHBhZGRpbmctYm90dG9tOiAycHg7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbn1cblxuLmxhcmdlIHtcbiAgcGFkZGluZy1sZWZ0OiA2cHg7XG4gIHBhZGRpbmctcmlnaHQ6IDZweDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzYyYTEyNTtcbiAgcGFkZGluZy10b3A6IDJweDtcbiAgcGFkZGluZy1ib3R0b206IDJweDtcbiAgZm9udC1zaXplOiAwLjc1cmVtO1xufVxuXG4uc3RhdHVzd2lkdGggLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LnNtIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xuICBtaW4td2lkdGg6IDM2NnB4O1xuICBib3gtc2hhZG93OiAwIDEwcHggNnB4IC02cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xuICB6LWluZGV4OiA5OTk5O1xufVxuLnN0YXR1c3dpZHRoIC5wb3BvdmVyLnBvcG92ZXItY29udGVudCAucG9wb3Zlci1ib2R5IHtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAwLjc1cmVtO1xuICBsaW5lLWhlaWdodDogMS41O1xuICBib3gtc2hhZG93OiAwIDAgMjBweCByZ2JhKDAsIDAsIDAsIDAuMik7XG4gIHBhZGRpbmc6IDE4cHggIWltcG9ydGFudDtcbn1cbi5zdGF0dXN3aWR0aCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQgLmFycm93IHtcbiAgei1pbmRleDogOTk5OSAhaW1wb3J0YW50O1xufVxuLnN0YXR1c3dpZHRoIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcCAuYXJyb3c6OmJlZm9yZSwgLnN0YXR1c3dpZHRoIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcCAuYXJyb3c6OmFmdGVyLCAuc3RhdHVzd2lkdGggLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wLXJpZ2h0IC5hcnJvdzo6YmVmb3JlLCAuc3RhdHVzd2lkdGggLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wLXJpZ2h0IC5hcnJvdzo6YWZ0ZXIsIC5zdGF0dXN3aWR0aCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci10b3AtbGVmdCAuYXJyb3c6OmJlZm9yZSwgLnN0YXR1c3dpZHRoIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcC1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xuICBjb250ZW50OiBcIlwiO1xuICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICMzMzMgIWltcG9ydGFudDtcbiAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XG4gIGJvcmRlci1yaWdodDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0cmFuc2Zvcm06IHJvdGF0ZSgtMzYwZGVnKTtcbiAgbGVmdDogLTE0cHggIWltcG9ydGFudDtcbiAgdG9wOiAtMTJweCAhaW1wb3J0YW50O1xufVxuLnN0YXR1c3dpZHRoIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6OmFmdGVyLCAuc3RhdHVzd2lkdGggLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLXJpZ2h0IC5hcnJvdzo6YWZ0ZXIsIC5zdGF0dXN3aWR0aCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tbGVmdCAuYXJyb3c6OmFmdGVyIHtcbiAgdG9wOiAwcmVtO1xuICBib3JkZXItYm90dG9tLWNvbG9yOiAjMzMzMzMzICFpbXBvcnRhbnQ7XG59XG4uc3RhdHVzd2lkdGggLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tIC5hcnJvdzo6YmVmb3JlLCAuc3RhdHVzd2lkdGggLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLXJpZ2h0IC5hcnJvdzo6YmVmb3JlLCAuc3RhdHVzd2lkdGggLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLWxlZnQgLmFycm93OjpiZWZvcmUge1xuICBib3JkZXItYm90dG9tLWNvbG9yOiAjMzMzMzMzICFpbXBvcnRhbnQ7XG59XG5cbi5wYXltZW50c2Nyb2xsIHtcbiAgbWF4LWhlaWdodDogMTEycHggIWltcG9ydGFudDtcbiAgb3ZlcmZsb3c6IGF1dG8gIWltcG9ydGFudDtcbn1cblxuLnBheW1lbnRzY3JvbGw6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcbiAgd2lkdGg6IDAuNWVtO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHJpZ2h0OiAwO1xufVxuXG4ucGF5bWVudHNjcm9sbDo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xuICAtd2Via2l0LWJveC1zaGFkb3c6IGluc2V0IDAgMCA2cHggcmdiYSgwLCAwLCAwLCAwLjMpO1xuICBib3gtc2hhZG93OiBpbnNldCAwIDAgNnB4IHJnYmEoMCwgMCwgMCwgMC4zKTtcbn1cblxuLnBheW1lbnRzY3JvbGw6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2I4YzNjYjtcbn1cblxuLmNsYXNzaWZ5d2lkdGggLmNsYXNzaWZ5c2lkZW5hdndpZHRoIHtcbiAgd2lkdGg6IDc1JTtcbn1cblxuLmNsYXNzaWZ5d2lkdGgge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHotaW5kZXg6IDI7XG4gIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XG4gIC13ZWJraXQtb3ZlcmZsb3ctc2Nyb2xsaW5nOiB0b3VjaDtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG92ZXJmbG93OiBoaWRkZW47XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAuY2xhc3NpZnl3aWR0aCAuY2xhc3NpZnlzaWRlbmF2d2lkdGgge1xuICAgIHdpZHRoOiA5NSUgIWltcG9ydGFudDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDEwMjRweCkgYW5kIChtaW4td2lkdGg6IDc2OXB4KSB7XG4gIC5jbGFzc2lmeXdpZHRoIC5jbGFzc2lmeXNpZGVuYXZ3aWR0aCB7XG4gICAgd2lkdGg6IDk1JSAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTM2NnB4KSBhbmQgKG1pbi13aWR0aDogMTI4MHB4KSB7XG4gIC5jbGFzc2lmeXdpZHRoIC5jbGFzc2lmeXNpZGVuYXZ3aWR0aCB7XG4gICAgd2lkdGg6IDg1JSAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcbiAgLmNsYXNzaWZ5d2lkdGggLmNsYXNzaWZ5c2lkZW5hdndpZHRoIHtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2Uge1xuICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLnRpdGxldGV4dCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbG9zZWFuZGFkZCB7XG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgfVxuXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbGVhcmFuZGFkZGJ1dHRvbiB7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgfVxufVxuI2NvbnRhY3Rwb3BvdmVyIC5jbGFibGUge1xuICBjb2xvcjogIzY2NiAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDAuODc1cmVtICFpbXBvcnRhbnQ7XG4gIGxpbmUtaGVpZ2h0OiAxcmVtICFpbXBvcnRhbnQ7XG59XG4jY29udGFjdHBvcG92ZXIgLmN2YWx1ZSB7XG4gIGNvbG9yOiAjMzMzMzMzICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtICFpbXBvcnRhbnQ7XG4gIGxpbmUtaGVpZ2h0OiAxcmVtICFpbXBvcnRhbnQ7XG59XG5cbltkaXI9cnRsXSAucGF5bWVudHZpZXcgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Ige1xuICBtYXJnaW4tbGVmdDogMHB4O1xuICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xufVxuW2Rpcj1ydGxdIC5wYXltZW50dmlldyAuYm9yZGVyZW1haWwge1xuICBtYXJnaW4tbGVmdDogMHB4O1xuICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xufVxuW2Rpcj1ydGxdIC5wYXltZW50dmlldyAuY29sb3Jsb2dvIHtcbiAgcGFkZGluZy1yaWdodDogOHB4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG59XG5bZGlyPXJ0bF0gLnBheW1lbnR2aWV3IC53aWR0aGNvbXBzYWxlIHtcbiAgcGFkZGluZy1yaWdodDogMjBweDtcbn1cbltkaXI9cnRsXSAucGF5bWVudHZpZXcgLm1hcmdpbnJlbW92ZXJ0bCB7XG4gIG1hcmdpbi1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XG59IiwiQG1peGluIGZsZXhjZW50ZXIge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuQG1peGluIGZsZXhzdGFydCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuQG1peGluIGZsZXhlbmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQgIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5AbWl4aW4gc3BhY2ViZXR3ZWVuIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuLnBheW1lbnR2aWV3e1xyXG4gICAgLnNwYWNlcmVuZXd7XHJcbiAgICAgICAgIEBpbmNsdWRlIHNwYWNlYmV0d2VlbigpO1xyXG4gICAgfVxyXG4gICAgLmp1c3RpZnllbmR7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgIH1cclxuICAgIC5pbnB1dGluZm9pY29ue1xyXG4gICAgICAgIGNvbG9yOiAjZmYwNTA1O1xyXG4gICAgfVxyXG4gICAgLm1hdC1leHBhbnNpb24tcGFuZWwtYm9keXtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMHB4O1xyXG4gICAgfVxyXG4gICAgLm1hdC1leHBhbnNpb24tcGFuZWwtc3BhY2luZyB7XHJcbiAgICAgICAgb3ZlcmZsb3c6IGluaGVyaXQ7XHJcbiAgICB9XHJcbiAgICAudGl0bGV0ZXh0e1xyXG4gICAgICAgIHB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzMzMzMgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYWNjb3JkaW9uc2hvd3RleHR7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogMjBweDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDU1cHg7XHJcbiAgICAgICAgcHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBsaW5lLWhlaWdodDogMS42O1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgIHRvcDogLTE4cHg7XHJcbiAgICAgICAgICAgICYucG9zcmVsdG9wMHtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIHRvcDogMHB4OyBcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAubXc3NXtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiA3NXB4O1xyXG4gICAgICAgICAgICBAbWVkaWEgKG1pbi13aWR0aDoxNjAwcHgpe1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOjgwcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYWxpZ25wYXltZW50e1xyXG4gICAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgICAgIC5kZWNsaW5lZHRleHR7XHJcbiAgICAgICAgICAgIGgye1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNmZjAwMDA7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgICAgIGZvbnQtZmFtaWx5OiAnY2Fpcm9zZW1pYm9sZCc7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAyNnB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIHB7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICAgICBjb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogOHB4O1xyXG4gICAgICAgICAgICAgICB3b3JkLWJyZWFrOiBicmVhay13b3JkO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLm1hdC1leHBhbmRlZHtcclxuICAgICAgICAubWF0LWV4cGFuc2lvbi1pbmRpY2F0b3J7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDUwJTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgICB3aWR0aDogMzBweDtcclxuICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgICAgICB9XHJcbiAgICB9XHJcbiBcclxuICAgIC5tYXQtZXhwYW5zaW9uLXBhbmVse1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICB9XHJcbiAgICAuYmFja2dyb3VuZGNvbW1lbnR7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZWRlZCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLm1hdC1leHBhbnNpb24tcGFuZWwtaGVhZGVyIHtcclxuICAgICAgICBoZWlnaHQ6IDc2cHggIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAwO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmVkZWQgIWltcG9ydGFudDtcclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgICAubWF0LWV4cGFuc2lvbi1wYW5lbC1jb250ZW50IHtcclxuICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZWRlZCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAgIC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlci1kZXNjcmlwdGlvbiB7XHJcbiAgICAgICAgZmxleC1ncm93OiAwO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDA7XHJcbiAgICAgICAgcCB7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDMwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgfSAgIFxyXG4gICAgLnBvaW50ZXJ0ZXh0e1xyXG4gICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgIH1cclxuICAgIC5raW5kbHl0ZXh0e1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMTBweDtcclxuICAgICAgICAgcHtcclxuICAgICAgICAgICAgIGNvbG9yOiAjNjY2NjY2O1xyXG4gICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICAgICAgICAgYXtcclxuICAgICAgICAgICAgICAgICBjb2xvcjogI2Y1ODAyMDtcclxuICAgICAgICAgICAgICAgICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcclxuICAgICAgICAgICAgIH1cclxuICAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XHJcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICBtYXgtd2lkdGg6IDgzLjMzJTtcclxuICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICBcclxuICAgIC5hbGlnbmVuZHNhdmV7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgfVxyXG4gICAgLmpzcnNjb2xvcntcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgaDJ7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLndpZHRoZm9ybXtcclxuICAgICAgICB3aWR0aDo1MCU7XHJcbiAgICB9XHJcblxyXG4gICAgLmNhbmNlbHtcclxuICAgICAgICB3aWR0aDoxNTJweDtcclxuICAgICAgICBoZWlnaHQ6IDQwcHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VjZWNlYztcclxuICAgICAgICBjb2xvcjogIzcyNzI3MjtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgfVxyXG5cclxuICAgLmFmdGVybmV4dDo6YWZ0ZXJ7XHJcbiAgICAgICAgY29udGVudDogJyc7XHJcbiAgICAgICAgYm9yZGVyLXRvcDogMThweCBzb2xpZCAjMDA2Y2I3O1xyXG4gICAgICAgIGJvcmRlci1sZWZ0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xyXG4gICAgICAgIGJvcmRlci1yaWdodDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgYm90dG9tOiAyMDZweDtcclxuICAgICAgICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgIHRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgIGxlZnQ6IDM1cHg7XHJcbiAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgIH1cclxuLnBvc2l0aW9ubmFtZXtcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgIGJveC1zaGFkb3c6IDAgMCAyMHB4IHJnYmEoMCwgMCwgMCwgIDAuMjApO1xyXG59XHJcblxyXG4gICAgLmFmdGVybmV4dHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICB9XHJcbiAgICAuaGVhZGVyZXZlbnR7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIGgye1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctdG9wOiA0cHg7XHJcbiAgICAgICAgfSAgXHJcbiAgICB9XHJcbiAgICAuc2VuaW9yY29sb3J7XHJcbiAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDAuMztcclxuICAgIH1cclxuICAgIC52YWx1ZWNvbG9ye1xyXG4gICAgICAgIGNvbG9yOiAjZjA4MjM1O1xyXG4gICAgICAgfSBcclxuXHJcbiAgICAgICAuYWxpZ25lbmR7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgIH1cclxuICAgICAgIC53aWR0aGxvYWR7XHJcbiAgICAgICAgICAgd2lkdGg6IDUwJTtcclxuICAgICAgIH1cclxuXHJcbiAgICAgICAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb257XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjZmOTtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgbWF4LWhlaWdodDogNTBweDtcclxuICAgICAgICAgICBwe1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgZm9udC1mYW1pbHk6ICdjYWlyb3NlbWlib2xkJztcclxuICAgICAgICAgICB9XHJcbiAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICBwYWRkaW5nOiAxMnB4IDIwcHggMTJweCAyMHB4O1xyXG4gICAgICAgfVxyXG5cclxuICAgIC5wcm9qZWN0Ym9yZGVye1xyXG4gICAgICAgIGJvcmRlci10b3A6bm9uZTtcclxuICAgICAgICBib3JkZXItbGVmdDogMXB4IHNvbGlkICNkYWRhZGE7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OjFweCBzb2xpZCAjZGFkYWRhO1xyXG4gICAgICAgIGJvcmRlci1ib3R0b206MXB4IHNvbGlkICNkYWRhZGE7XHJcbiAgICB9XHJcbiAgICAuZW1haWxhbGlnbntcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgfVxyXG5cclxuICAgIC5pbmZvY21wcmF0aW5ne1xyXG4gICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgfVxyXG4gICAgLmxhYmVsY21wYWZ0ZXJ7XHJcbiAgICAgICAgY29sb3I6ICM5OTk5OTk7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgIH1cclxuICAgIC5zYXZle1xyXG4gICAgICAgIHdpZHRoOjE1MnB4O1xyXG4gICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICB9XHJcbiAgICAubWF0LXRhYi1ib2R5Lm1hdC10YWItYm9keS1hY3RpdmUge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICBvdmVyZmxvdy14OiBoaWRkZW47XHJcbiAgICAgICAgb3ZlcmZsb3cteTogaW5oZXJpdDtcclxuICAgICAgICB6LWluZGV4OiAxO1xyXG4gICAgICAgIGZsZXgtZ3JvdzogMTtcclxuICAgIH1cclxuICAgIC5zcGNlc21le1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogYXV0bztcclxuICAgICAgICBtYXgtd2lkdGg6IDgzLjMzJTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb2xvcnRleHR5ZWFye1xyXG4gICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgIGZvbnQtZmFtaWx5OiAnY2Fpcm9zZW1pYm9sZCc7XHJcbiAgICB9XHJcbiAgXHJcbiAgIC5idXNpbmVzc3VuaXRpbmZvIHtcclxuICAgIHdpZHRoOiAzNCU7XHJcbiAgICB6LWluZGV4OiA5OTk5O1xyXG4gICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgbWFyZ2luLWxlZnQ6IC0xMXB4O1xyXG4gfVxyXG4ucGF5ZW10bmxpc3R7XHJcbiAgICB3aWR0aDogMTAwJTtcclxuICAgIHotaW5kZXg6IDk5OTk7XHJcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICB0b3A6IDI2cHg7XHJcbiAgICBtYXJnaW4tbGVmdDogLTVweDsgIFxyXG59XHJcbi5kcm9wZG93bmxpc3R7XHJcbiAgICB3aWR0aDogMTAwJTtcclxuICAgIHotaW5kZXg6IDk5OTk7XHJcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICB0b3A6IDI2cHg7XHJcbiAgICBtYXJnaW4tbGVmdDogLTVweDtcclxuICAgXHJcbn1cclxuXHJcbi5wb3NpdGlvbntcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxufVxyXG5cclxuLmFmdGVydXNlciAuaGVhZGVyaW5mb3JtYXRpb250ZXh0OjphZnRlciB7XHJcbiAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgbGVmdDogMTAwcHg7XHJcbiAgICB0b3A6IC0xMHB4O1xyXG4gICAgd2lkdGg6IDA7XHJcbiAgICBoZWlnaHQ6IDA7XHJcbiAgICBib3JkZXItbGVmdDogMTBweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuICAgIGJvcmRlci1yaWdodDogMTBweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuICAgIGJvcmRlci1ib3R0b206IDEwcHggc29saWQgI2UxZWZmZjtcclxuICAgIGNsZWFyOiBib3RoO1xyXG4gICAgZGlzcGxheTogbm9uZTtcclxufVxyXG5cclxuLmludm9pY2Vmb250e1xyXG4gICAgcHtcclxuICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgfVxyXG4gICAgfVxyXG4gICAgLm5leHRyZW5ld2Fse1xyXG4gICAgICAgIC5jbXBueWluZm8ge1xyXG4gICAgICAgICAgICBtYXJnaW4tYm90dG9tOiAwO1xyXG4gICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDE1cHg7XHJcbiAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAuZmlyc3R0ZXh0Y29sb3J7XHJcbiAgICAgICAgICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICAgICAgIH1cclxuICAgICAgICAgICAuc2Vjb25kY29udGVudHRleHR7XHJcbiAgICAgICAgICAgICAgd29yZC1icmVhazogYnJlYWstd29yZDtcclxuICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiA4cHg7XHJcbiAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAucG9wb3Zlci1ib2R5IHtcclxuICAgICAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7IFxyXG4gICAgICAgfVxyXG4gICAgICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50IC5wb3BvdmVyLWJvZHkgcCB7XHJcbiAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDsgXHJcbiAgICAgICBmb250LXNpemU6IDEycHggIWltcG9ydGFudDtcclxuICAgICAgIGxpbmUtaGVpZ2h0OiAxLjUgIWltcG9ydGFudDtcclxuICAgICAgIFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuc20ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbWluLXdpZHRoOiAzNjZweDtcclxuICAgICAgICBib3gtc2hhZG93OiAwIDEwcHggNnB4IC02cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xyXG4gICAgICAgIHotaW5kZXg6IDk5OTk7XHJcbiAgICB9XHJcbiAgICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50IC5wb3BvdmVyLWJvZHkge1xyXG4gICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgICAgICBsaW5lLWhlaWdodDogMS41O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IDAgMCAyMHB4IHJnYmEoMCwgMCwgMCwgIDAuMjApO1xyXG4gICAgfVxyXG4gICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50IC5hcnJvd1xyXG4gICAge1xyXG4gICAgICAgIHotaW5kZXg6IDk5OTkgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcCAuYXJyb3c6OmJlZm9yZSwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wIC5hcnJvdzo6YWZ0ZXIsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcC1yaWdodCAuYXJyb3c6OmJlZm9yZSwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wLXJpZ2h0IC5hcnJvdzo6YWZ0ZXIsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcC1sZWZ0IC5hcnJvdzo6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci10b3AtbGVmdCAuYXJyb3c6OmFmdGVyIHtcclxuICAgICAgICBjb250ZW50OiAnJztcclxuICAgICAgICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICNmZmY7XHJcbiAgICAgICAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xyXG4gICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgIHRyYW5zZm9ybTogcm90YXRlKC0zNjBkZWcpO1xyXG4gICAgICAgIGxlZnQ6IC03MHB4O1xyXG4gICAgICAgIHRvcDogLThweDtcclxuICAgIH1cclxuICAgIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6OmFmdGVyLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OjphZnRlciwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLWxlZnQgLmFycm93OjphZnRlciB7XHJcbiAgICAgICAgdG9wOiAwcmVtO1xyXG4gICAgICAgIGJvcmRlci1ib3R0b20tY29sb3I6ICNmZmY7XHJcbiAgICB9XHJcbiAgICAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20gLmFycm93OjpiZWZvcmUsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1yaWdodCAuYXJyb3c6OmJlZm9yZSwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLWxlZnQgLmFycm93OjpiZWZvcmUge1xyXG4gICAgICAgIGJvcmRlci1ib3R0b20tY29sb3I6ICNmZmY7XHJcbiAgICB9XHJcbiAgICAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20gLmFycm93OjpiZWZvcmUsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6OmFmdGVyLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OjpiZWZvcmUsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1yaWdodCAuYXJyb3c6OmFmdGVyLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tbGVmdCAuYXJyb3c6OmJlZm9yZSwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLWxlZnQgLmFycm93OjphZnRlciB7XHJcbiAgICAgICAgdG9wOi0ycHg7XHJcbiAgICAgICAgYm9yZGVyLXdpZHRoOiAwIDhweCA4cHggOHB4O1xyXG4gICAgfVxyXG4gICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tIC5hcnJvdzpiZWZvcmUsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6YWZ0ZXIsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1yaWdodCAuYXJyb3c6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OmFmdGVyLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tbGVmdCAuYXJyb3c6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tbGVmdCAuYXJyb3c6YWZ0ZXIge1xyXG4gICAgICAgIHRvcDogLTJweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgfVxyXG4gICAgLmhlYWRlcnBvcHZpZXcge1xyXG4gICAgICAgIG1heC1oZWlnaHQ6IDcwcHg7XHJcbiAgICAgICAgYmFja2dyb3VuZDogIzU4NjI2ZTtcclxuICAgICAgICBtaW4taGVpZ2h0OiA3MHB4O1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAud2lkdGhmb3JtZmlsZWR7XHJcbiAgICAgICAgd2lkdGg6MjMwcHg7XHJcbiAgICB9XHJcbiAgICAudXNlcmNvbG9ye1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGxpbmUtaGVpZ2h0OiAxMnB4O1xyXG4gICAgICAgIGhlaWdodDogMjVweDtcclxuICAgIH1cclxuICAgIFxyXG4gICAgLndpZHRoaW1ne1xyXG4gICAgd2lkdGg6IDE1cHg7XHJcbiAgICBoZWlnaHQ6IDE1cHg7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDhweDtcclxuICAgIH1cclxuLnNtZWNvbG9ye1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogIzcxYzAxNTtcclxuICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgaGVpZ2h0OiAyMHB4O1xyXG4gICAgbWFyZ2luOiAwcHg7XHJcbiAgICBsaW5lLWhlaWdodDogMThweDtcclxuICAgIHBhZGRpbmc6IDJweCA2cHggMnB4IDZweDtcclxufVxyXG4uc3BlbmNlcmNvb3JwYXltZW50e1xyXG4gICAgcHtcclxuICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgfVxyXG59XHJcblxyXG4uYm9yZGVyc3BlY2NvbXBhbnljb2xvcntcclxuICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xyXG4gICAgbWFyZ2luLXJpZ2h0OiAwcHg7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjZmOTtcclxuICAgIHBhZGRpbmc6IDIwcHggMjJweCAyMHB4IDIycHg7XHJcblxyXG59XHJcblxyXG4ubmV4dHJlbmV3YWx7XHJcbiAgICBsaW5lLWhlaWdodDogMjVweDtcclxuICAgIC5hZnRlcmNvbG9ydXNlcmxpc3R7XHJcbiAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICBjb2xvcjogI2Y0ODExZjtcclxuICB9ICBcclxufVxyXG4uYWZ0ZXJjb2xvcnJlbmlld3tcclxuICAgIHB7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgIGNvbG9yOiAjZjQ4MTFmO1xyXG4gICAgICB9ICBcclxufVxyXG4ud2lkdGhjb21wc2FsZXtcclxuICAgIHdpZHRoOiAzMy4zMyU7XHJcbiAgICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZGFkYWRhO1xyXG59XHJcbi5uZXh0cmVuZXdhbHtcclxuICAgIHdpZHRoOiAzMy4zMyU7XHJcbn1cclxuLmFmdGVyY29sb3J1c2VybGlzdHtcclxuICAgIGN1cnNvcjogcG9pbnRlcjtcclxufVxyXG4uYWZ0ZXJjb2xvcnJlbmlld3BhY2t7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbn1cclxuICAgIC5hbGlnbnBhc3N3b3Jke1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgfVxyXG4gICAgLmNtcG55aW5mbyB7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMDtcclxuICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICBwYWRkaW5nLWJvdHRvbTogOHB4O1xyXG4gICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgLmxhYmVsY21wZGVwe1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OTk5OSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgXHJcbiAgICB9XHJcbiAgICAuaW5mb2NtcG5hbmNle1xyXG4gICAgICAgIGNvbG9yOiAjMzMzMzMzICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgIH1cclxuICAgIH1cclxuICAgIC5sYWJlbGNtcCB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxNjVweDtcclxuICAgICAgICBsaW5lLWhlaWdodDogaW5oZXJpdCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmluZm9jbXAge1xyXG4gICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICB9XHJcbiAgICAuc3RhdHVzd2lkdGh7XHJcbiAgICAgICAgY29sb3I6ICM2NjY2NjY7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIH1cclxuICAgIFxyXG4gICAgLndpZHRoaW1nY2hlY2t7XHJcbiAgICAgICAgd2lkdGg6MjBweDtcclxuICAgICAgICBoZWlnaHQ6MTZweDtcclxuICAgIH1cclxuICAgIFxyXG4gICAgLmJvcmRlcmVtYWlse1xyXG4gICAgICAgIGJvcmRlci1ib3R0b206MXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgYm9yZGVyLWxlZnQ6MXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OjFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIGJvcmRlci10b3A6IG5vbmU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAud2lkdGhjb21we1xyXG4gICAgICB3aWR0aDogNTAlOyAgXHJcbiAgICB9XHJcbiAgICBcclxuICAgIC53aWR0aGNvbXBtYWlue1xyXG4gICAgICAgIHdpZHRoOiAzMy4zMyU7XHJcbiAgICB9XHJcbiAgICBcclxuICAgIC5hbGlnbnBhc3N3b3Jke1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuICAgIFxyXG4gICAgLmNvbG9yYWN0aXZlIHtcclxuICAgICAgICBmb250LXdlaWdodDogbm9ybWFsICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZDogIzIzODlmMTtcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAyMHB4O1xyXG4gICAgICAgIHBhZGRpbmc6IDJweCAxMXB4O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIH1cclxuICAgIC5zcGVuY2VyY29vcntcclxuICAgICAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaDJ7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMDIyZjY3O1xyXG4gICAgICAgIH1cclxuICAgICAgIFxyXG4gICAgfVxyXG4gICAgLm1hcmtldGNvbG9ye1xyXG4gICAgICAgIHB7XHJcbiAgICAgICAgICAgIGNvbG9yOiMzMzMzMzM7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmJvcmRlcnNwZWN7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBtYXJnaW4tbGVmdDogMjBweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDIwcHg7XHJcbiAgICAgICAgcGFkZGluZzogMThweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNmY5O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaGVpZ2h0OiAxMjJweDtcclxuICAgIFxyXG4gICAgfVxyXG4gICAgLmJvcmRlcnNwZWNoZWlnaHR7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBtYXJnaW4tbGVmdDogMjBweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDIwcHg7XHJcbiAgICAgICAgcGFkZGluZzogMThweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNmY5O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaGVpZ2h0OiAxMjJweDtcclxuICAgIFxyXG4gICAgfVxyXG4gICAgLmRvbWFpbmNvbG9ye1xyXG4gICAgICAgIHB7XHJcbiAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgZm9udC1mYW1pbHk6ICdjYWlyb3NlbWlib2xkJztcclxuICAgICAgICB9XHJcbiAgICAgICAgc3BhbntcclxuICAgICAgICAgICAgY29sb3I6ICNmMDgyMzU7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnJlbmV3Y29sb3J7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2UwZjBmZjtcclxuICAgICAgICBjb2xvcjogIzAwNmNiNztcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaGVpZ2h0OiAyNXB4O1xyXG4gICAgICAgIGJvcmRlcjoxcHggc29saWQgIzAwNmNiNztcclxuICAgICAgICB3aWR0aDogMTE1cHg7XHJcbiAgICB9XHJcbiAgICAuZmxleHBhZ2Fle1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgfVxyXG4gICAgLmNvbGxhYmVyYXRlY29sb3J7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y0ODExZjtcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaGVpZ2h0OiAyNXB4O1xyXG4gICAgfVxyXG4gICAgLmZsZXhyZW5ld3tcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBmbGV4LWVuZDtcclxuICAgIH1cclxuICAgIC5mbGV4c3RhcnRhbGlnbntcclxuICAgICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgICAgICBwe1xyXG4gICAgICAgICAgICBtYXJnaW4tYm90dG9tOiA2cHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnBheW1lbnRzdGF0dXNjb2xvcntcclxuICAgICAgICAgICAgUHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjNjY2NjY2O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5wb3N0ZWR2ZXJpZmljYXRpb257XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMWU5OWY3O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMjVweDsgXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLmFwcHJvdmV7XHJcbiAgICAgICAgICAgICAgICBAZXh0ZW5kIC5wb3N0ZWR2ZXJpZmljYXRpb247XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNTBhZjQ5ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLmZhaWxlZHtcclxuICAgICAgICAgICAgICAgIEBleHRlbmQgLnBvc3RlZHZlcmlmaWNhdGlvbjtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmMjNmM2EgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAucGF5bWVudGlucHJvZ3Jlc3N7XHJcbiAgICAgICAgICAgICAgICBAZXh0ZW5kIC5wb3N0ZWR2ZXJpZmljYXRpb247XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmM5MjAyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnJlc3VibWl0e1xyXG4gICAgICAgICAgICAgICAgQGV4dGVuZCAucG9zdGVkdmVyaWZpY2F0aW9uO1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2Y0ODExZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmNvbGxhYmVyYXRlYnRuY29sb3J7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZiZTRkMDtcclxuICAgICAgICBjb2xvcjogI2Y0OGMzNDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZjQ4YzM0O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBoZWlnaHQ6IDI1cHg7XHJcbiAgICAgICAgd2lkdGg6IDEzNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcmRvd25sb2Fke1xyXG4gICAgICBib3JkZXI6IDFweCBzb2xpZCAjZDdkN2Q3OyAgXHJcbiAgICB9XHJcbiAgICAucmV2aWV3YnRuY29sb3J7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNztcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaGVpZ2h0OiAyNXB4O1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAuYnRuYWxpZ257XHJcbiAgICAgICBtYXJnaW4tYm90dG9tOiA2cHg7XHJcbiAgICAgICAgcHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmltYWdlYWxpZ257XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGNvbG9yOmJsYWNrO1xyXG4gICAgICAgIGltZ3tcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAxNHB4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5iYWNrZ3JvdW5ke1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6I2ZmZjtcclxuICAgICAgICBtYXJnaW4tbGVmdDogMTI3cHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMjdweDtcclxuICAgICAgICBoZWlnaHQ6IDQxMHB4O1xyXG4gICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMzBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgaDR7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgLmFmdGVycGFuZWw6OmFmdGVye1xyXG4gICAgICAgIGNvbnRlbnQ6ICcnO1xyXG4gICAgICAgIGJvcmRlci10b3A6IDE4cHggc29saWQgIzM1M2I0NztcclxuICAgICAgICBib3JkZXItbGVmdDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuICAgICAgICBib3JkZXItcmlnaHQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgIGJvdHRvbTogOTVweDtcclxuICAgICAgICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgIHRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgIHJpZ2h0OiAxNXB4O1xyXG4gICAgfVxyXG4gICAgLmVkaXQ6OmFmdGVyXHJcbiAgICAgICAgIHtcclxuICAgICAgICAgICAgZm9udC1mYW1pbHk6IFwiYmdpLWljb25cIiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBmb250LXN0eWxlOiBub3JtYWw7XHJcbiAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiBub3JtYWw7XHJcbiAgICAgICAgICAgIGZvbnQtdmFyaWFudDogbm9ybWFsO1xyXG4gICAgICAgICAgICB0ZXh0LXRyYW5zZm9ybTogbm9uZTtcclxuICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgICAgICAgIC13ZWJraXQtZm9udC1zbW9vdGhpbmc6IGFudGlhbGlhc2VkO1xyXG4gICAgICAgICAgICAtbW96LW9zeC1mb250LXNtb290aGluZzogZ3JheXNjYWxlO1xyXG4gICAgICAgICAgICBjb250ZW50OiBcIlxcZTkwOFwiO1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDlweDtcclxuICAgICAgICAgICAgdG9wOiAxNHB4O1xyXG4gICAgICAgICAgICByaWdodDogMTVweDtcclxuICAgICAgICB9XHJcbiAgICAuYmFja2dyb3VuZG5leHRkZXNpZ257XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjojZmZmO1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAxMjdweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMTI3cHggIWltcG9ydGFudDtcclxuICAgICAgICBvdmVyZmxvdzogaGlkZGVuO1xyXG4gICAgICAgIGhlaWdodDogNTIwcHg7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMzBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgaDR7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgXHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmVkaXR7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjojZWNlY2VjO1xyXG4gICAgICAgIGNvbG9yOiM5OTk5OTk7XHJcbiAgICAgICAgZm9udC1zaXplOjE0cHg7XHJcbiAgICAgICAgZm9udC1mYW1pbHk6Y2FsaWJyaTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOjRweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIHdpZHRoOjEwMHB4O1xyXG4gICAgICAgIGhlaWdodDozNXB4O1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206MjBweDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweDtcclxuICAgIH1cclxuICAgIC5udW1iZXJidG57XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjojZWNlY2VjO1xyXG4gICAgICAgIGNvbG9yOiM5OTk5OTk7XHJcbiAgICAgICAgZm9udC1zaXplOjE0cHg7XHJcbiAgICAgICAgZm9udC1mYW1pbHk6Y2FsaWJyaTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOjRweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIHdpZHRoOjEyNnB4O1xyXG4gICAgICAgIGhlaWdodDozNXB4O1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206MjBweDtcclxuICAgIH1cclxuICAgIC5zYXZlY2hhbmdlc2J0bntcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgd2lkdGg6IDEyMHB4O1xyXG4gICAgICAgIGhlaWdodDogMzVweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5zdWJtaXRidG57XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNztcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICAgIHdpZHRoOiA3NXB4O1xyXG4gICAgICAgIGhlaWdodDogMzVweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5pbWFnZWFsaWdue1xyXG4gICAgICAgIGltZ3tcclxuICAgICAgICAgICAgaGVpZ2h0OjE2cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmNhbmNlbGJ0bntcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiNlY2VjZWM7XHJcbiAgICAgICAgY29sb3I6Izk5OTk5OTtcclxuICAgICAgICBmb250LXNpemU6MTRweDtcclxuICAgICAgICBmb250LWZhbWlseTpjYWxpYnJpO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6NHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgd2lkdGg6NzBweDtcclxuICAgICAgICBoZWlnaHQ6MzVweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOjIwcHg7XHJcbiAgICB9XHJcbiAgICAuZmxleGVuZHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgIH1cclxuICAgIC5kb3RlZHtcclxuICAgICAgICBoZWlnaHQ6IDZweDtcclxuICAgICAgICB3aWR0aDogNnB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gICAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgIH1cclxuICAgIFxyXG4gICAgLmJvcmRlcmJvdHRvbXtcclxuICAgICAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RhZGFkYTtcclxuICAgIH1cclxuICAgIC5mbGV4YWxpZ257XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDU2cHg7XHJcbiAgICB9XHJcbiAgICAjY2RrLW92ZXJsYXktMCAubWF0LW1lbnUtcGFuZWx7XHJcbiAgICAgICAgYmFja2dyb3VuZDogd2hpdGU7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIHJpZ2h0OiAyOHB4O1xyXG4gICAgICAgIG92ZXJmbG93OiBpbml0aWFsO1xyXG4gICAgfVxyXG4gICAgLmltYWdlOmFmdGVye1xyXG4gICAgICAgIGNvbnRlbnQ6ICcnO1xyXG4gICAgICAgIGJhY2tncm91bmQ6IzI3YjhlNztcclxuICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgaGVpZ2h0OiA2MiU7XHJcbiAgICAgICAgcmlnaHQ6IC01cHg7XHJcbiAgICAgICAgd2lkdGg6IDQyJTtcclxuICAgICAgICB6LWluZGV4OiAtMTtcclxuICAgICAgICBib3R0b206LTMwcHg7XHJcbiAgICAgICAgXHJcbiAgICB9XHJcbiAgICAuaW1hZ2V7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIHotaW5kZXg6OTk5OTtcclxuICAgIH1cclxuICAgIC5tYXQtbWVudS1wYW5lbHtcclxuICAgICAgICBtaW4td2lkdGg6IDExMnB4O1xyXG4gICAgICAgIG1heC13aWR0aDogMjgwcHg7XHJcbiAgICAgICAgb3ZlcmZsb3c6IGF1dG87XHJcbiAgICAgICAgLXdlYmtpdC1vdmVyZmxvdy1zY3JvbGxpbmc6IHRvdWNoO1xyXG4gICAgICAgIG1heC1oZWlnaHQ6IGNhbGMoMTAwdmggLSA0OHB4KTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgb3V0bGluZTogMDtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgcmlnaHQ6IDI4cHg7XHJcbiAgICB9XHJcbiAgICAuaW1hZ2UgaW1ne1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICB0b3A6MjVweDtcclxuICAgIH1cclxuICAgIFxyXG4gICAgLmN1c3RvbS1tb2RhbGJveCB7XHJcbiAgICAgICAgLm1hdC1kaWFsb2ctY29udGFpbmVyIHtcclxuICAgICAgICAgICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcclxuICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICBcclxuICAgIC5ib3JkZXIxIC5tYXQtYnV0dG9uLXRvZ2dsZS1idXR0b24ge1xyXG4gICAgICAgIGJvcmRlcjogMDtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAwIDA7XHJcbiAgICAgICAgY29sb3I6IGluaGVyaXQ7XHJcbiAgICAgICAgcGFkZGluZzogMDtcclxuICAgICAgICBtYXJnaW46IDA7XHJcbiAgICAgICAgZm9udDogaW5oZXJpdDtcclxuICAgICAgICBvdXRsaW5lOiAwO1xyXG4gICAgICAgIHdpZHRoOiA4MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgaGVpZ2h0OjQwcHggIWltcG9ydGFudDtcclxuICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgYm9yZGVyOjFweCBzb2xpZCAjMDA2Y2I3O1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAuZGlzcGxheXtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDpzcGFjZS1iZXR3ZWVuO1xyXG4gICAgfVxyXG4gICAgLmN1cnJlbnR7XHJcbiAgICAgICAgcHtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiA2cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnZlcmZpZWRhbGlnbntcclxuICAgICAgICBzcGFue1xyXG4gICAgICAgICAgICBjb2xvcjojNzBjMDE1O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5yZW1vdmV0ZXh0Y29sb3J7XHJcbiAgICAgICAgc3BhbntcclxuICAgICAgICAgICAgY29sb3I6IzRhNmVhNjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYnRue1xyXG4gICAgICAgIGNvbG9yOiM2MzY4NmU7XHJcbiAgICAgICAgd2lkdGg6MTMwcHg7XHJcbiAgICAgICAgaGVpZ2h0OjM4cHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMDtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6I2U4ZWJmMDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOjVweDsgXHJcbiAgICB9XHJcbiAgICBcclxuICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9ye1xyXG4gICAgICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmc6IDIwcHggMjVweCAwcHggMjVweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNmY5O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICB9XHJcbn1cclxuXHJcbiAgICBAbWVkaWEgKG1heC13aWR0aDogNzY3cHgpe1xyXG4gICAgICAgIC5hbGlnbmRvbWlhbntcclxuICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDE1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgICAucmVzcG9uc2l2ZXBhZGRpbmd3aWR0aHtcclxuICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMThweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICB9IFxyXG4gICAgICAgICAuZmxleGFsaWdue1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDsgIFxyXG4gICAgICAgLmJhY2tncm91bmRuZXh0ZGVzaWdue1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBvdmVyZmxvdzogaGlkZGVuO1xyXG4gICAgICAgICAgICBtYXJnaW4tdG9wOiAzMHB4O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgaDR7XHJcbiAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5mbGV4YWxpZ257XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMHB4O1xyXG4gICAgICAgIH1cclxuICAgICAgICAucmVzcG9uc2l2ZXBhZGRpbmd7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogOHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICB9IFxyXG4gICAgfVxyXG4gICAgXHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogMTAyNHB4KSBhbmQgKG1pbi13aWR0aDogNzY5cHgpe1xyXG4gICAgLmJhY2tncm91bmRuZXh0ZGVzaWdue1xyXG4gICAgICAgXHJcbiAgICAgICAgaDR7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYmFja2dyb3VuZHtcclxuICAgICAgXHJcbiAgICAgICAgaDR7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICB9XHJcbiAgXHJcbn1cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KXtcclxuICBcclxuICAgIC5jYW5lZGl0cmVzcG9uc2l2ZXdpZHRoe1xyXG4gICAgICAgIG1heC13aWR0aDogMjMlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc3VibWl0cmVzcG9uc2l2ZXtcclxuICAgICAgICBtYXgtd2lkdGg6NDMlICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICAgICAgLmVtYWlscmVzcG9uc2l2ZXdpZHRoe1xyXG4gICAgICAgIG1heC13aWR0aDogNjUlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY2FuY2VscmVzcG9uc2l2ZXdpZHRoe1xyXG4gICAgICAgIG1heC13aWR0aDozNSUgIWltcG9ydGFudDtcclxuICAgICAgfVxyXG4gICAgICAudXBkYXRlZGF0ZXdpZHRoe1xyXG4gICAgICAgIG1heC13aWR0aDogNzIlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYWx0ZXJuYXRlcmVzcG9uc2l2ZXdpZHRoe1xyXG4gICAgICAgIG1heC13aWR0aDo1NyUgIWltcG9ydGFudDtcclxuICAgICAgfVxyXG4gICAgICAuY2hhbmdlbnVtYmVyYnRud2lkdGh7XHJcbiAgICAgICAgbWF4LXdpZHRoOjI4JSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG59XHJcbkBtZWRpYSAobWF4LXdpZHRoOiA2MDBweCl7XHJcbiAgICAuYnRucmVzcG9uc2l2ZXtcclxuICAgICAgICBkaXNwbGF5OiBjb250ZW50cztcclxuICAgIH1cclxuICAgIC5wYXltZW50dmlldyAubmV4dHJlbmV3YWwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LnNtIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIG1pbi13aWR0aDogMzIwcHggIWltcG9ydGFudDtcclxuICAgICAgICBib3gtc2hhZG93OiAwIDEwcHggNnB4IC02cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xyXG4gICAgICAgIGxlZnQ6IDI0cHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5ibG9ja3Jlc3BvbnNpdmV3aWR0aHtcclxuICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgXHJcbiAgICB9XHJcbiAgICAuc3VibWl0Y29udGVudHdpZHRoe1xyXG4gICAgICAgIGRpc3BsYXk6IGNvbnRlbnRzO1xyXG4gICAgfVxyXG4gICAgLnNwYWNpbmdmaWxlZHtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xyXG4gICAgfVxyXG4gICAgLmJsb2NrYWxpZ257XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC52ZXJmaWVkb25yZXNwb25zaXZld2lkdGh7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA4MCUgIWltcG9ydGFudDtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIC52ZXJmaWVkYWxpZ257XHJcbiAgICAgICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICAgICBjb2xvcjojNzBjMDE1O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiA2cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAuaW1hZ2VhbGlnbntcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgY29sb3I6YmxhY2s7XHJcbiAgICAgICAgICAgIGltZ3tcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogNHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG59XHJcblxyXG4gICAgXHJcbkBtZWRpYSAobWF4LXdpZHRoOjc2OHB4KXtcclxuICAgIC5jZXJ0aWZpY2F0ZWxpc3R2aWV3IC5jZXJ0aWZjYXRlc2lkZW5hdndpZHRoe1xyXG4gICAgICAgIHdpZHRoOiA5OCUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5mbGV4cGFnYWV7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5mbGV4cmVuZXd7XHJcbiAgICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb257XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjZmOTtcclxuICAgICAgICBtYXgtaGVpZ2h0OiAxMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgcGFkZGluZzogMTJweCAwcHggMTJweCAyMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYWZ0ZXJuZXh0OjphZnRlcntcclxuICAgICAgICBjb250ZW50OiAnJztcclxuICAgICAgICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICMwMDZjYjc7XHJcbiAgICAgICAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xyXG4gICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICBib3R0b206IDE4OHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcclxuICAgICAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcclxuICAgICAgICBsZWZ0OiAzNXB4O1xyXG4gICAgfVxyXG4gICAgLmFjdGl2ZXNjcm9sbCAuYXJyb3d7XHJcbiAgICAgICAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLndpZHRoY29tcHtcclxuICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50OyAgXHJcbiAgICAgIH1cclxuICAgICAgXHJcbiAgICAgIC53aWR0aGNvbXBtYWlue1xyXG4gICAgICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgfVxyXG4gIFxyXG4gICAgLmJvcmRlcnNwZWNoZWlnaHR7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVmMGY0O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgaGVpZ2h0OiAxOThweCAhaW1wb3J0YW50O1xyXG4gICAgICAgXHJcbiAgICB9XHJcbiAgICAud2lkdGh1c2VyYnRue1xyXG4gICAgICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDE1cHg7XHJcbiAgICB9XHJcbiAgICAuYm9yZGVyZW1haWx7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbToxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBib3JkZXItbGVmdDoxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBib3JkZXItcmlnaHQ6MXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgYm9yZGVyLXRvcDogbm9uZTtcclxuICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLndpZHRoY29tcHtcclxuICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDsgXHJcbiAgICAgIHBhZGRpbmctYm90dG9tOiAxMnB4OyBcclxuICAgIH1cclxuICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9ye1xyXG4gICAgICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZDdkN2Q3O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAyMHB4O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMHB4O1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmNWY2Zjk7XHJcbiAgICAgICAgcGFkZGluZzogMjBweCAyMnB4IDIwcHggMjJweDtcclxuICAgIFxyXG4gICAgfVxyXG4gICAgLm5leHRyZW5ld2Fse1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDowcHggIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMTBweDtcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXBzYWxlIHtcclxuICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlci1yaWdodDogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnNwZW5jZXJjb29ycGF5bWVudGNsYXNzaWZpY2F0aW9ue1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgcGFkZGluZzogMTJweDtcclxuICAgIH1cclxuICAgXHJcbi5zcGFjZWJ0bntcclxuICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbn1cclxuLmFsaWducGFzc3dvcmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxufVxyXG4uYWxpZ25kb21pYW57XHJcbiAgICBtYXJnaW4tYm90dG9tOiAwO1xyXG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIGxpbmUtaGVpZ2h0OiAyNXB4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxufVxyXG5cclxuLnNwY2VzbWV7XHJcbiAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgIG1hcmdpbi1yaWdodDogYXV0bztcclxuICAgIG1heC13aWR0aDogOTcuMzMlICFpbXBvcnRhbnQ7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG59XHJcbi5wYWNrYWxpZ257XHJcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxufVxyXG4ud2lkdGhmb3Jte1xyXG4gICAgd2lkdGg6MTAwJSAhaW1wb3J0YW50O1xyXG4gICAgXHJcbn1cclxuICAgIH1cclxuXHJcbiAgICBAbWVkaWEgKG1heC13aWR0aDoxMDI0cHgpIGFuZCAobWluLXdpZHRoOjc2OXB4KSB7XHJcbiAgICAgICAgLmNlcnRpZmljYXRlbGlzdHZpZXcgLmNlcnRpZmNhdGVzaWRlbmF2d2lkdGh7XHJcbiAgICAgICAgICAgIHdpZHRoOiA5OCUgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmZsZXhwYWdhZXtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmZsZXhyZW5ld3tcclxuICAgICAgICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5wYWNrYWxpZ257XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmFmdGVybmV4dDo6YWZ0ZXJ7XHJcbiAgICAgICAgICAgIGNvbnRlbnQ6ICcnO1xyXG4gICAgICAgICAgICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICMwMDZjYjc7XHJcbiAgICAgICAgICAgIGJvcmRlci1sZWZ0OiAxOHB4IHNvbGlkIHRyYW5zcGFyZW50O1xyXG4gICAgICAgICAgICBib3JkZXItcmlnaHQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgYm90dG9tOiAxODdweDtcclxuICAgICAgICAgICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSgtMTgwZGVnKTtcclxuICAgICAgICAgICAgdHJhbnNmb3JtOiByb3RhdGUoLTE4MGRlZyk7XHJcbiAgICAgICAgICAgIGxlZnQ6IDM1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5ib3JkZXJlbWFpbHtcclxuICAgICAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkN2Q3ZDc7XHJcbiAgICAgICAgICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICAgICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2Q3ZDdkNztcclxuICAgICAgICAgICAgYm9yZGVyLXRvcDogbm9uZTtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgLndpZHRoZm9ybXtcclxuICAgICAgICAgICAgd2lkdGg6MTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAud2lkdGhjb21we1xyXG4gICAgICAgICAgICB3aWR0aDogNTYlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5zaGFkb3d7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgICAgICAgIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLm5leHRyZW5ld2Fse1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDowcHggIWltcG9ydGFudDtcclxuICBcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXBzYWxlIHtcclxuICAgICAgICB3aWR0aDogNDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAud2lkdGhjb21wbWFpbntcclxuICAgICAgICB3aWR0aDogMzQlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuc3BlbmNlcmNvb3JwYXltZW50Y2xhc3NpZmljYXRpb257XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgICAgICBwYWRkaW5nOiAxMnB4O1xyXG4gICAgICAgIG1heC1oZWlnaHQ6IDc1cHggIWltcG9ydGFudDtcclxuICAgIH1cclxuLmFsaWducGFzc3dvcmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxufVxyXG4uc3BhY2VidG57XHJcbiAgICBtYXJnaW4tdG9wOiAxMHB4O1xyXG59XHJcblxyXG4gICAgfVxyXG5cclxuXHJcbiAgICBAbWVkaWEgKG1heC13aWR0aDo3NjdweCkgYW5kIChtaW4td2lkdGg6MzE4cHgpIHtcclxuICAgICAgICAuYm9yZGVyZW1haWx7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmZsZXhwYWdhZXtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDsgXHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5jbXBueWluZm97XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7IFxyXG4gICAgICAgIH1cclxuICAgICAgICAuc3BhY2VtYXJnaW57XHJcbiAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgfSBcclxuICAgICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSB7XHJcbiAgICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICAgICAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLnRpdGxldGV4dCB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgfVxyXG4gICAgICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAuY2xvc2VhbmRhZGQge1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgIH1cclxuICAgICAgLnNwYWNpbmd7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbGVhcmFuZGFkZGJ1dHRvbiB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAgIC5jZXJ0aWZpY2F0ZWxpc3R2aWV3IC5jZXJ0aWZjYXRlc2lkZW5hdndpZHRoe1xyXG4gICAgICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICAgICAgXHJcbiAgICAgIFxyXG4gICAgICAgLm1haW50YWIgLm1hdC10YWItYm9keS1jb250ZW50IHtcclxuICAgICAgICAgICAgaGVpZ2h0OiBhdXRvO1xyXG4gICAgICAgICAgICBvdmVyZmxvdzogaGlkZGVuICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgXHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5hZnRlcm5leHQ6OmFmdGVyIHtcclxuICAgICAgICAgICAgY29udGVudDogJyc7XHJcbiAgICAgICAgICAgIGJvcmRlci10b3A6IDE4cHggc29saWQgIzAwNmNiNztcclxuICAgICAgICAgICAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgIGJvcmRlci1yaWdodDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICBib3R0b206IDE4OHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoLTE4MGRlZyk7XHJcbiAgICAgICAgICAgIHRyYW5zZm9ybTogcm90YXRlKC0xODBkZWcpO1xyXG4gICAgICAgICAgICBsZWZ0OiAxMzBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAucGFja2FsaWduIHtcclxuICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnNwY2VzbWV7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgICAgICAgIG1heC13aWR0aDogOTAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgfVxyXG4gICAgICAgXHJcbiAgICAgICAgLm5leHRyZW5ld2Fse1xyXG4gICAgICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICBcclxuICAgICAgICAuZG93bnNwYWNle1xyXG4gICAgICAgICAgICBtYXJnaW4tdG9wOjEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgLmFjdGl2ZXNjcm9sbCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20gLmFycm93OjphZnRlciwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLXJpZ2h0IC5hcnJvdzo6YWZ0ZXIsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xyXG4gICAgICAgICAgICB0b3A6IDByZW07XHJcbiAgICAgICAgICAgIGJvcmRlci1ib3R0b20tY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAuYWN0aXZlc2Nyb2xsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbSAuYXJyb3c6OmJlZm9yZSwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLXJpZ2h0IC5hcnJvdzo6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tbGVmdCAuYXJyb3c6OmJlZm9yZSB7XHJcbiAgICAgICAgICAgIGJvcmRlci1ib3R0b20tY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnNwZW5jZXJjb29yIHtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIH1cclxuICAgICAgICAuYWxpZ25wYXNzd29yZHtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5jaGFuZ2Vjb2xvciB7XHJcbiAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnByb2plY3Rib3JkZXJ7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDEycHggIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5ib3JkZXJzcGVjaGVpZ2h0e1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWVmMGY0O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDI3MnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDEycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgIFxyXG4gICAgICAgIC5tYXJrZXRjb2xvcntcclxuICAgICAgICAgICAgcGFkZGluZy10b3A6IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIC50aXRsZXtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9ye1xyXG4gICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZDdkN2Q3ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICAgcGFkZGluZzogMTJweCAxMnB4IDEycHggMTJweDtcclxuICAgICAgICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICAuYm9yZGVyZW1haWx7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDoxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC53aWR0aGltZ2NoZWNre1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAuYWxpZ25lbmQge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5ib3JkZXJzcGVjY29tcGFueWNvbG9yZG93bmxvYWR7XHJcbiAgICAgICAgICAgXHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICBcclxuICAgICAgICB9XHJcbiAgICAgICAgLmJvcmRlcnNwZWNjb21wYW55Y29sb3Jkb3dubG9hZGFub3RoZXJ7XHJcbiAgICAgICAgICAgIG1hcmdpbi10b3A6IDIwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDIwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgLndpZHRobG9hZHtcclxuICAgICAgICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDsgXHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAuYWxpZ25lbmRzYXZle1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAxMnB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5jYW5jZWwge1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAud2lkdGhmb3Jte1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICBAbWVkaWEgKG1heC13aWR0aDo0MTRweCkgYW5kIChtaW4td2lkdGg6NDEycHgpIHtcclxuICBcclxuICAgIC5hbGlnbmVuZHNhdmV7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgICBtYXJnaW4tbGVmdDogMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAucGFja2FsaWdue1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICB9XHJcbn1cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6MTI4MHB4KSBhbmQgKG1pbi13aWR0aDoxMjc4cHgpIHtcclxuICAgIC53aWR0aGNvbXBtYWlue1xyXG4gICAgICAgIHdpZHRoOiAzMSUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC53aWR0aGNvbXBzYWxle1xyXG4gICAgICAgIHdpZHRoOiAzMyUgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZGFkYWRhO1xyXG4gICAgfVxyXG4gICAgLmxhYmVsY21wIHtcclxuICAgICAgICAgbWluLXdpZHRoOiAxNTVweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLm5leHRyZW5ld2FsIHtcclxuICAgICAgICB3aWR0aDogMzYlICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICB9XHJcbiAgXHJcbiAgICBAbWVkaWEgKG1heC13aWR0aDoxMzY2cHgpIGFuZCAobWluLXdpZHRoOjEzNjJweCkge1xyXG4gICAgICAgIC5jZXJ0aWZpY2F0ZWxpc3R2aWV3IC5jZXJ0aWZjYXRlc2lkZW5hdndpZHRoe1xyXG4gICAgICAgICAgICB3aWR0aDogODAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5wYXltZW50dmlldyAuY29sbGFiZXJhdGVidG5jb2xvciB7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogMTVweDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnBheW1lbnR2aWV3IHtcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IGF1dG87XHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogYXV0bztcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA4OCUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgXHJcblxyXG4gICAgICAuY2VydGlmaWNhdGVsaXN0dmlldyAuY2VydGlmY2F0ZXNpZGVuYXZ3aWR0aHtcclxuICAgICAgICAgIHdpZHRoOiA3NSU7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5taWNyb3tcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDZweDtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiA2cHg7XHJcbiAgICAgICAgY29sb3I6I2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6IzNlNzhkODtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMnB4O1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAycHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgfVxyXG4gICAgLnNtYWxse1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogNnB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDZweDtcclxuICAgICAgICBjb2xvcjojZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjojZjJhYzFkO1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiAycHg7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDJweDtcclxuICAgICAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICB9XHJcbiAgICAubWVkaXVte1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogNnB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDZweDtcclxuICAgICAgICBjb2xvcjojZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjojMmZkMGQ0O1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiAycHg7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDJweDtcclxuICAgICAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICB9XHJcbiAgICAubGFyZ2V7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiA2cHg7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogNnB4O1xyXG4gICAgICAgIGNvbG9yOiNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiM2MmExMjU7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDJweDtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMnB4O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgIH1cclxuXHJcbiAgICAuc3RhdHVzd2lkdGh7XHJcbiAgICAgICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LnNtIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDM2NnB4O1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiAwIDEwcHggNnB4IC02cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xyXG4gICAgICAgICAgICB6LWluZGV4OiA5OTk5O1xyXG4gICAgICAgIH1cclxuICAgICAgICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50IC5wb3BvdmVyLWJvZHkge1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDAuNzVyZW07XHJcbiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxLjU7XHJcbiAgICAgICAgICAgIGJveC1zaGFkb3c6IDAgMCAyMHB4IHJnYmEoMCwgMCwgMCwgIDAuMjApO1xyXG4gICAgICAgICAgICBwYWRkaW5nOiAxOHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5wb3BvdmVyLnBvcG92ZXItY29udGVudCAuYXJyb3dcclxuICAgICAgICB7XHJcbiAgICAgICAgICAgIHotaW5kZXg6IDk5OTkgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wIC5hcnJvdzo6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci10b3AgLmFycm93OjphZnRlciwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wLXJpZ2h0IC5hcnJvdzo6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci10b3AtcmlnaHQgLmFycm93OjphZnRlciwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItdG9wLWxlZnQgLmFycm93OjpiZWZvcmUsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLXRvcC1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xyXG4gICAgICAgICAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgICAgICAgICBib3JkZXItdG9wOiAxOHB4IHNvbGlkICMzMzMgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm9yZGVyLWxlZnQ6IDE4cHggc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgIGJvcmRlci1yaWdodDogMThweCBzb2xpZCB0cmFuc3BhcmVudDtcclxuICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICB0cmFuc2Zvcm06IHJvdGF0ZSgtMzYwZGVnKTtcclxuICAgICAgICAgICAgbGVmdDogLTE0cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgdG9wOiAtMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20gLmFycm93OjphZnRlciwgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tLXJpZ2h0IC5hcnJvdzo6YWZ0ZXIsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzo6YWZ0ZXIge1xyXG4gICAgICAgICAgICB0b3A6IDByZW07XHJcbiAgICAgICAgICAgIGJvcmRlci1ib3R0b20tY29sb3I6ICMzMzMzMzMgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnBvcG92ZXIucG9wb3Zlci1jb250ZW50LmJzLXBvcG92ZXItYm90dG9tIC5hcnJvdzo6YmVmb3JlLCAucG9wb3Zlci5wb3BvdmVyLWNvbnRlbnQuYnMtcG9wb3Zlci1ib3R0b20tcmlnaHQgLmFycm93OjpiZWZvcmUsIC5wb3BvdmVyLnBvcG92ZXItY29udGVudC5icy1wb3BvdmVyLWJvdHRvbS1sZWZ0IC5hcnJvdzo6YmVmb3JlIHtcclxuICAgICAgICAgICAgYm9yZGVyLWJvdHRvbS1jb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAucGF5bWVudHNjcm9sbHtcclxuICAgICAgICBtYXgtaGVpZ2h0OiAxMTJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG92ZXJmbG93OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5wYXltZW50c2Nyb2xsOjotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAwLjVlbTtcclxuICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICByaWdodDogMDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnBheW1lbnRzY3JvbGw6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcclxuICAgICAgICAgICAgLXdlYmtpdC1ib3gtc2hhZG93OiBpbnNldCAwIDAgNnB4IHJnYmEoMCwgMCwgMCwgMC4zKTtcclxuICAgICAgICAgICAgYm94LXNoYWRvdzogaW5zZXQgMCAwIDZweCByZ2JhKDAsIDAsIDAsIDAuMyk7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIC5wYXltZW50c2Nyb2xsOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNiOGMzY2I7XHJcbiAgICAgICAgfVxyXG5cclxuXHJcbiAgICAgICAgLmNsYXNzaWZ5d2lkdGggLmNsYXNzaWZ5c2lkZW5hdndpZHRoIHtcclxuICAgICAgICAgICAgd2lkdGg6IDc1JTtcclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgLmNsYXNzaWZ5d2lkdGgge1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgIHotaW5kZXg6IDI7XHJcbiAgICAgICAgICAgIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XHJcbiAgICAgICAgICAgIC13ZWJraXQtb3ZlcmZsb3ctc2Nyb2xsaW5nOiB0b3VjaDtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgICAgICAgICAuY2xhc3NpZnl3aWR0aCAuY2xhc3NpZnlzaWRlbmF2d2lkdGgge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDk1JSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiAxMDI0cHgpIGFuZCAobWluLXdpZHRoOiA3NjlweCkge1xyXG4gICAgICAgICAgICAuY2xhc3NpZnl3aWR0aCAuY2xhc3NpZnlzaWRlbmF2d2lkdGgge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDk1JSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiAxMzY2cHgpIGFuZCAobWluLXdpZHRoOiAxMjgwcHgpIHtcclxuICAgICAgICAgICAgLmNsYXNzaWZ5d2lkdGggLmNsYXNzaWZ5c2lkZW5hdndpZHRoIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiA4NSUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcclxuICAgICAgICAgICAgLmNsYXNzaWZ5d2lkdGggLmNsYXNzaWZ5c2lkZW5hdndpZHRoIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2Uge1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLnRpdGxldGV4dCB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbG9zZWFuZGFkZCB7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbGVhcmFuZGFkZGJ1dHRvbiB7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgI2NvbnRhY3Rwb3BvdmVye1xyXG4gICAgICAgICAgICAuY2xhYmxle1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2NjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW0gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxcmVtICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIC5jdmFsdWV7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW0gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxcmVtICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgIFxyXG4gIFtkaXI9cnRsXXtcclxuICAgIC5wYXltZW50dmlld3tcclxuICAgICAgICAuYm9yZGVyc3BlY2NvbXBhbnljb2xvcntcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDBweDtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmJvcmRlcmVtYWlse1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogMHB4O1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAuY29sb3Jsb2dve1xyXG4gICAgICAgICAgICAgcGFkZGluZy1yaWdodDogOHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAud2lkdGhjb21wc2FsZSB7XHJcbiAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAyMHB4O1xyXG4gICAgICAgIH1cclxuICAgICAgICAubWFyZ2lucmVtb3ZlcnRse1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgXHJcbiAgIFxyXG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.ts":
  /*!******************************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.ts ***!
    \******************************************************************************************************/

  /*! exports provided: SubscriptionpaymentlistComponent */

  /***/
  function srcAppModulesAccountsettingsSubscriptionpaymentlistSubscriptionpaymentlistComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "SubscriptionpaymentlistComponent", function () {
      return SubscriptionpaymentlistComponent;
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


    var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/material/sidenav */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
    /* harmony import */


    var _registartionapproval_approval_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./../../registartionapproval/approval.service */
    "./src/app/modules/registartionapproval/approval.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");

    var SubscriptionpaymentlistComponent = /*#__PURE__*/function () {
      function SubscriptionpaymentlistComponent(approvalservice, myRoute, routeid, translate, remoteService, cookieService, localStorage) {
        _classCallCheck(this, SubscriptionpaymentlistComponent);

        this.approvalservice = approvalservice;
        this.myRoute = myRoute;
        this.routeid = routeid;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.localStorage = localStorage;
        this.panelOpenState = false;
        this.panel = 1;
        this.animationState = 'out';
        this.animationState1 = 'out';
        this.animationState2 = 'out';
        this.hideChangeSubscription = false;
        this.drtrenew = false;
        this.renewalDays = '';
      }

      _createClass(SubscriptionpaymentlistComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this24 = this;

          this.orginstatus = this.localStorage.getInLocal('origin');
          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this24.translate.setDefaultLang(_this24.cookieService.get('languageCode'));
          });
          this.getForeignClassification();
          this.routeid.queryParams.subscribe(function (params) {
            _this24.drtrenew = params['nav'] == 'yes' ? true : false;
          });
        }
      }, {
        key: "ngAfterViewInit",
        value: function ngAfterViewInit() {}
      }, {
        key: "showdropdown",
        value: function showdropdown(divName) {
          if (divName === 'businessunitinfo') {
            this.animationState = this.animationState === 'out' ? 'in' : 'out';
          }
        }
      }, {
        key: "showdropdowndownload",
        value: function showdropdowndownload(divName) {
          if (divName === 'securityinfo') {
            this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
          }
        }
      }, {
        key: "clickdropdown",
        value: function clickdropdown(divName) {
          if (divName === 'paymentinfo') {
            this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
          }
        }
      }, {
        key: "getForeignClassification",
        value: function getForeignClassification() {
          var _this25 = this;

          this.approvalservice.checkforeignclassification(this.compPk).subscribe(function (data) {
            if (data['data'].status == 1) {
              _this25.hideChangeSubscription = true;
            }
          });
        }
      }, {
        key: "downloadInvoice",
        value: function downloadInvoice() {
          window.open(this.settingsData.invoiceLink, '_blank');
        }
      }, {
        key: "downloadReceipt",
        value: function downloadReceipt() {
          window.open(this.settingsData.receiptLink, '_blank');
        }
      }, {
        key: "setOpen",
        value: function setOpen(i) {
          this.panel = i;
        }
      }, {
        key: "scrollTo",
        value: function scrollTo(className) {
          try {
            var elementList = document.querySelectorAll('.' + className);
            var element = elementList[0];
          } catch (error) {
            console.log('page-content');
          }
        }
      }]);

      return SubscriptionpaymentlistComponent;
    }();

    SubscriptionpaymentlistComponent.ctorParameters = function () {
      return [{
        type: _registartionapproval_approval_service__WEBPACK_IMPORTED_MODULE_3__["ApprovalService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_6__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__["CookieService"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_8__["AppLocalStorageServices"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)], SubscriptionpaymentlistComponent.prototype, "panelNo", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('drawercontactus'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_2__["MatDrawer"])], SubscriptionpaymentlistComponent.prototype, "drawercontactus", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SubscriptionpaymentlistComponent.prototype, "settingsData", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SubscriptionpaymentlistComponent.prototype, "compPk", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], SubscriptionpaymentlistComponent.prototype, "contactusData", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], SubscriptionpaymentlistComponent.prototype, "openonlyRenewal", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)], SubscriptionpaymentlistComponent.prototype, "isGraceExpired", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('certificaterenewaldrawer'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_2__["MatDrawer"])], SubscriptionpaymentlistComponent.prototype, "certificaterenewaldrawer", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('changesubscriptiondrawer'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_2__["MatDrawer"])], SubscriptionpaymentlistComponent.prototype, "changesubscriptiondrawer", void 0);
    SubscriptionpaymentlistComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-subscriptionpaymentlist',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./subscriptionpaymentlist.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./subscriptionpaymentlist.component.scss */
      "./src/app/modules/accountsettings/subscriptionpaymentlist/subscriptionpaymentlist.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_registartionapproval_approval_service__WEBPACK_IMPORTED_MODULE_3__["ApprovalService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_6__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__["CookieService"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_8__["AppLocalStorageServices"]])], SubscriptionpaymentlistComponent);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/twofactorauth/modal/succesinfo.ts":
  /*!***************************************************************************!*\
    !*** ./src/app/modules/accountsettings/twofactorauth/modal/succesinfo.ts ***!
    \***************************************************************************/

  /*! exports provided: succesinfo */

  /***/
  function srcAppModulesAccountsettingsTwofactorauthModalSuccesinfoTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "succesinfo", function () {
      return succesinfo;
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


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/modules/registration/registration.service */
    "./src/app/modules/registration/registration.service.ts");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");

    var succesinfo = /*#__PURE__*/function () {
      function succesinfo(dialogRef, toastr, security, regService, fb, applocalstorage, translate, remoteService, cookieService, data) {
        _classCallCheck(this, succesinfo);

        this.dialogRef = dialogRef;
        this.toastr = toastr;
        this.security = security;
        this.regService = regService;
        this.fb = fb;
        this.applocalstorage = applocalstorage;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.data = data;
        this.Submitted = false;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_4__["ErrorStateMatcher"]();
        this.spinnerButtonOptionsproced = {
          active: false,
          spinnerSize: 25,
          text: 'Proceed',
          raised: false,
          stroked: false,
          buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate'
        };
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
        this.dir = "ltr";
      }

      _createClass(succesinfo, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this26 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this26.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;

            if (toSelect.languagecode == 'en') {
              this.spinnerButtonOptionsproced.text = "Proceed";
            } else {
              this.spinnerButtonOptionsproced.text = "Proceed";
            }
          } else {
            var _toSelect9 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect9.languagecode);
            this.dir = _toSelect9.dir;
            this.spinnerButtonOptionsproced.text = "Proceed";
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this26.translate.setDefaultLang(_this26.cookieService.get('languageCode'));

            if (_this26.cookieService.get('languageCookieId') && _this26.cookieService.get('languageCookieId') != undefined && _this26.cookieService.get('languageCookieId') != null) {
              var _toSelect10 = _this26.languagelist.find(function (c) {
                return c.id === _this26.cookieService.get('languageCookieId');
              });

              _this26.translate.setDefaultLang(_toSelect10.languagecode);

              _this26.dir = _toSelect10.dir;

              if (_toSelect10.languagecode == 'en') {
                _this26.spinnerButtonOptionsproced.text = "Proceed";
              } else {
                _this26.spinnerButtonOptionsproced.text = "Proceed";
              }
            } else {
              var _toSelect11 = _this26.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this26.translate.setDefaultLang(_toSelect11.languagecode);

              _this26.dir = _toSelect11.dir;
              _this26.spinnerButtonOptionsproced.text = "Proceed";
            }
          });
          this.newemail = this.data.email;
          this.encryptedUserPk = this.security.encrypt(this.applocalstorage.getInLocal('opalusermst_pk'));
          this.OTPForm = this.fb.group({
            email: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            otp: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
          });
          console.log(this.newemail);
          this.OTPForm.controls['email'].setValue(this.newemail);
          this.OTPForm.controls['email'].updateValueAndValidity();
          this.sendverifyotp(this.OTPForm.controls.email.value, 'email', this.encryptedUserPk);
        }
      }, {
        key: "ot",
        get: function get() {
          return this.OTPForm.controls;
        }
      }, {
        key: "sendverifyotp",
        value: function sendverifyotp(value, type, pk) {
          var _this27 = this;

          this.disableSubmitButton = true;
          this.disableResend = true;
          this.regService.sendverifyotpdb(value, type, pk).subscribe(function (data) {
            console.log(data);
            var date1 = new Date(data['data'].expiry);
            var date2 = new Date();
            var Time = date1.getTime() - date2.getTime();
            var Days = Time / (1000 * 60); //Diference in Days.

            console.info(date1);
            console.info(date1.getTime());

            _this27.timer(Days, date1);

            _this27.disableSubmitButton = false;
            console.log(data.data);
          });
        }
      }, {
        key: "timer",
        value: function timer(minutes, time) {
          var _this28 = this;

          this.timersec = setInterval(function () {
            var date1 = new Date(time);
            var date2 = new Date();

            if (date1.getTime() >= date2.getTime()) {
              var Days = date1.getTime() - date2.getTime();
              var minute = Days / (1000 * 60);
              var seconds = minute * 60;
              var textSec = "0";
              var statSec = 60;
              var prefix = minute < 10 ? "0" : "";
              seconds--;
              if (statSec != 0) statSec--;else statSec = 59;
              var prefixsec = Math.floor(seconds % 60) < 10 ? "0" : "";
              _this28.countDown = "".concat(prefix).concat(Math.floor(seconds / 60), ":").concat(prefixsec).concat(Math.floor(seconds % 60));

              if (seconds <= 0 || date1.getTime() <= date2.getTime() || !_this28.timersec) {
                _this28.disableResend = false;
                _this28.countDown = "00:00";
                clearInterval(_this28.timersec);
                _this28.timersec = null;
              }
            } else {
              _this28.disableResend = false;
              _this28.countDown = "00:00";
              console.log('time cleared' + date2);
              clearInterval(_this28.timersec);
            }
          }, 1000);
        }
      }, {
        key: "resendOtp",
        value: function resendOtp() {
          this.sendverifyotp(this.OTPForm.controls.email.value, 'email', this.encryptedUserPk);
        }
      }, {
        key: "submitOtp",
        value: function submitOtp() {
          this.verifyotpdata(this.OTPForm.controls.email.value, this.OTPForm.controls.otp.value, 'email', this.encryptedUserPk);
        }
      }, {
        key: "verifyotpdata",
        value: function verifyotpdata(value, otp, type, usrPk) {
          var _this29 = this;

          this.spinnerButtonOptionsproced.active = true;
          this.Submitted = true;
          this.regService.verifyotpdatadb(value, otp, type, usrPk).subscribe(function (data) {
            if (data['data'].flag == 1) {
              _this29.disableResend = false;

              _this29.closeModalPopup();

              _this29.toastr.success(_this29.i18n('successmodel.otpverif'), '', {
                timeOut: 3000,
                closeButton: false
              });
            } else if (data['data'].flag == 2) {
              if (type == 'email') {
                _this29.OTPForm.controls.otp.reset();

                _this29.spinnerButtonOptionsproced.active = false;
                _this29.Submitted = false;

                _this29.OTPForm.controls.otp.setErrors({
                  invalidOTP: true
                });
              }

              _this29.toastr.warning(_this29.i18n('successmodel.reenteotpverif'), '', {
                timeOut: 3000,
                closeButton: false
              });
            } else {
              if (type == 'email') {
                _this29.OTPForm.controls.otp.reset();

                _this29.spinnerButtonOptionsproced.active = false;
                _this29.Submitted = false;

                _this29.OTPForm.controls.otp.setErrors({
                  expiredOTP: true
                });
              }

              _this29.toastr.warning(_this29.i18n('successmodel.resendotpandretry'), '', {
                timeOut: 3000,
                closeButton: false
              });
            }
          });
        }
      }, {
        key: "closeModalPopup",
        value: function closeModalPopup() {
          clearInterval(this.timersec);
          this.dialogRef.close({
            data: true
          });
        }
      }]);

      return succesinfo;
    }();

    succesinfo.ctorParameters = function () {
      return [{
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialogRef"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_11__["ToastrService"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_5__["Encrypt"]
      }, {
        type: _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_7__["RegistrationService"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_6__["AppLocalStorageServices"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_9__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_10__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"]
      }, {
        type: undefined,
        decorators: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"],
          args: [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MAT_DIALOG_DATA"]]
        }]
      }];
    };

    succesinfo = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: "successmodal",
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./successmodal.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/twofactorauth/modal/successmodal.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./successmodal.scss */
      "./src/app/modules/accountsettings/twofactorauth/modal/successmodal.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__param"])(9, Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"])(_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MAT_DIALOG_DATA"])), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialogRef"], ngx_toastr__WEBPACK_IMPORTED_MODULE_11__["ToastrService"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_5__["Encrypt"], _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_7__["RegistrationService"], _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_6__["AppLocalStorageServices"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_9__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_10__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"], Object])], succesinfo);
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/twofactorauth/modal/successmodal.scss":
  /*!*******************************************************************************!*\
    !*** ./src/app/modules/accountsettings/twofactorauth/modal/successmodal.scss ***!
    \*******************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsTwofactorauthModalSuccessmodalScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#verified_fields {\n  min-width: 500px;\n  max-width: 600px;\n  height: 100%;\n  overflow: hidden;\n  padding: 15px 10px;\n}\n#verified_fields .mat-icon {\n  cursor: pointer;\n  margin-left: 15px;\n}\n#verified_fields .mat-icon:hover {\n  transform: scale(1.1);\n  color: #ED1C27;\n}\n#verified_fields .txt-gry {\n  color: #262626;\n}\n#verified_fields .txt-gry3 {\n  color: #848484;\n}\n#verified_fields .txt-red {\n  color: #ED1C27;\n}\n#verified_fields .cont_otp {\n  text-align: center;\n}\n#verified_fields .cont_otp p span {\n  color: #ED1C27;\n}\n#verified_fields .mat-form-field-appearance-outline .mat-form-field-wrapper {\n  padding-bottom: 5px !important;\n}\n#verified_fields .mat-raised-button {\n  min-width: 110px;\n  box-shadow: none !important;\n  border-radius: 2px !important;\n  font-size: 1rem;\n  text-decoration: none;\n  padding: 5px 10px;\n}\n#verified_fields .procbtn {\n  background-color: #295da0;\n  color: #ffffff;\n  display: flex;\n  justify-content: center;\n}\n#verified_fields .btns {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#verified_fields .resentbtn {\n  background-color: transparent;\n  border: none;\n  color: #295da0;\n  cursor: pointer;\n}\n#verified_fields .divouter {\n  width: 100%;\n}\n#verified_fields .divouter .flexalign.divinner {\n  display: flex;\n  justify-content: center;\n  left: 0;\n  position: sticky;\n  max-width: 88%;\n}\n#verified_fields .divouter .flexalign.divinner #partitioned {\n  text-align: left;\n  padding-left: 16px;\n  letter-spacing: 62px;\n  border: 0;\n  min-width: 303px;\n  outline: none;\n  position: relative;\n  top: 5px;\n}\n#verified_fields .disable_icon {\n  opacity: 0.5;\n  cursor: not-allowed;\n  pointer-events: none;\n}\n#verified_fields .otpfield {\n  display: block;\n  height: 12px;\n  width: 261px !important;\n  background-image: linear-gradient(to left, black 69%, rgba(255, 255, 255, 0) 0%) !important;\n  background-position: bottom;\n  background-size: 70px 1px;\n  background-repeat: repeat-x;\n  background-position-x: 47px;\n}\n#verified_fields .procbtn {\n  color: #ffffff;\n  min-width: 110px;\n}\n#verified_fields .procbtn button {\n  background-color: #295da0;\n  height: 45px;\n  border-radius: 2px !important;\n  font-size: 1em;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#verified_fields .procbtn .button-text {\n  color: #fff;\n}\n#verified_fields button .spinner {\n  top: auto !important;\n  bottom: auto !important;\n}\n#verified_fields button .mat-progress-spinner.mat-warn circle,\n#verified_fields button .mat-spinner.mat-warn circle {\n  stroke: #fff !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvdHdvZmFjdG9yYXV0aC9tb2RhbC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxhY2NvdW50c2V0dGluZ3NcXHR3b2ZhY3RvcmF1dGhcXG1vZGFsXFxzdWNjZXNzbW9kYWwuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvdHdvZmFjdG9yYXV0aC9tb2RhbC9zdWNjZXNzbW9kYWwuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDQTtFQUVJLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtBQ0RKO0FER0k7RUFDSSxlQUFBO0VBQ0EsaUJBQUE7QUNEUjtBREdRO0VBQ0kscUJBQUE7RUFDQSxjQUFBO0FDRFo7QURLSTtFQUNJLGNBQUE7QUNIUjtBRE1JO0VBQ0ksY0FBQTtBQ0pSO0FET0k7RUFDSSxjQUFBO0FDTFI7QURRSTtFQUNJLGtCQUFBO0FDTlI7QURTWTtFQUNJLGNBQUE7QUNQaEI7QURhUTtFQUNJLDhCQUFBO0FDWFo7QURlSTtFQUNJLGdCQUFBO0VBQ0EsMkJBQUE7RUFDQSw2QkFBQTtFQUNBLGVBQUE7RUFDQSxxQkFBQTtFQUNBLGlCQUFBO0FDYlI7QURnQkk7RUFDSSx5QkFBQTtFQUNBLGNBQUE7RUFDQSxhQUFBO0VBQ0EsdUJBQUE7QUNkUjtBRGlCSTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDZlI7QURrQkk7RUFDSSw2QkFBQTtFQUNBLFlBQUE7RUFDQSxjQUFBO0VBQ0EsZUFBQTtBQ2hCUjtBRG1CSTtFQUNJLFdBQUE7QUNqQlI7QURtQlE7RUFDSSxhQUFBO0VBQ0EsdUJBQUE7RUFDQSxPQUFBO0VBQ0EsZ0JBQUE7RUFDQSxjQUFBO0FDakJaO0FEbUJZO0VBQ0ksZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLG9CQUFBO0VBQ0EsU0FBQTtFQUNBLGdCQUFBO0VBQ0EsYUFBQTtFQUNBLGtCQUFBO0VBQ0EsUUFBQTtBQ2pCaEI7QUR1Qkk7RUFDSSxZQUFBO0VBQ0EsbUJBQUE7RUFDQSxvQkFBQTtBQ3JCUjtBRHdCSTtFQUNJLGNBQUE7RUFDQSxZQUFBO0VBQ0EsdUJBQUE7RUFDQSwyRkFBQTtFQUNBLDJCQUFBO0VBQ0EseUJBQUE7RUFDQSwyQkFBQTtFQUNBLDJCQUFBO0FDdEJSO0FEOEJJO0VBRUksY0FBQTtFQUNBLGdCQUFBO0FDN0JSO0FEK0JRO0VBQ0kseUJBQUE7RUFDQSxZQUFBO0VBQ0EsNkJBQUE7RUFDQSxjQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBQUE7QUM3Qlo7QURnQ1E7RUFDSSxXQUFBO0FDOUJaO0FEbUNRO0VBQ0ksb0JBQUE7RUFDQSx1QkFBQTtBQ2pDWjtBRG9DUTs7RUFFSSx1QkFBQTtBQ2xDWiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL3R3b2ZhY3RvcmF1dGgvbW9kYWwvc3VjY2Vzc21vZGFsLnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJcclxuI3ZlcmlmaWVkX2ZpZWxkcyB7XHJcbiAgICBcclxuICAgIG1pbi13aWR0aDogNTAwcHg7XHJcbiAgICBtYXgtd2lkdGg6IDYwMHB4O1xyXG4gICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgIHBhZGRpbmc6IDE1cHggMTBweDtcclxuXHJcbiAgICAubWF0LWljb24ge1xyXG4gICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICBtYXJnaW4tbGVmdDogMTVweDtcclxuXHJcbiAgICAgICAgJjpob3ZlciB7XHJcbiAgICAgICAgICAgIHRyYW5zZm9ybTogc2NhbGUoMS4xKTtcclxuICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC50eHQtZ3J5IHtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgIH1cclxuXHJcbiAgICAudHh0LWdyeTMge1xyXG4gICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgfVxyXG5cclxuICAgIC50eHQtcmVkIHtcclxuICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgIH1cclxuXHJcbiAgICAuY29udF9vdHAge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuXHJcbiAgICAgICAgcCB7XHJcbiAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xyXG4gICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogNXB4ICFpbXBvcnRhbnRcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1yYWlzZWQtYnV0dG9uIHtcclxuICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICBmb250LXNpemU6IDFyZW07XHJcbiAgICAgICAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG4gICAgICAgIHBhZGRpbmc6IDVweCAxMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5wcm9jYnRuIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMjk1ZGEwO1xyXG4gICAgICAgIGNvbG9yOiAjZmZmZmZmO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICB9XHJcblxyXG4gICAgLmJ0bnMge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAucmVzZW50YnRuIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiB0cmFuc3BhcmVudDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcbiAgICAgICAgY29sb3I6ICMyOTVkYTA7XHJcbiAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgfVxyXG5cclxuICAgIC5kaXZvdXRlciB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcblxyXG4gICAgICAgIC5mbGV4YWxpZ24uZGl2aW5uZXIge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgbGVmdDogMDtcclxuICAgICAgICAgICAgcG9zaXRpb246IHN0aWNreTtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA4OCU7XHJcblxyXG4gICAgICAgICAgICAjcGFydGl0aW9uZWQge1xyXG4gICAgICAgICAgICAgICAgdGV4dC1hbGlnbjogbGVmdDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMTZweDtcclxuICAgICAgICAgICAgICAgIGxldHRlci1zcGFjaW5nOiA2MnB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAwO1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiAzMDNweDtcclxuICAgICAgICAgICAgICAgIG91dGxpbmU6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDVweDtcclxuXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmRpc2FibGVfaWNvbiB7XHJcbiAgICAgICAgb3BhY2l0eTogMC41O1xyXG4gICAgICAgIGN1cnNvcjogbm90LWFsbG93ZWQ7XHJcbiAgICAgICAgcG9pbnRlci1ldmVudHM6IG5vbmU7XHJcbiAgICB9XHJcblxyXG4gICAgLm90cGZpZWxkIHtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBoZWlnaHQ6IDEycHg7XHJcbiAgICAgICAgd2lkdGg6IDI2MXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1pbWFnZTogbGluZWFyLWdyYWRpZW50KHRvIGxlZnQsIGJsYWNrIDY5JSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwKSAwJSkgIWltcG9ydGFudDtcclxuICAgICAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiBib3R0b207XHJcbiAgICAgICAgYmFja2dyb3VuZC1zaXplOiA3MHB4IDFweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLXJlcGVhdDogcmVwZWF0LXg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbi14OiA0N3B4O1xyXG4gICAgfVxyXG5cclxuICAgIC8vIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAvLyAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgLy8gICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAvLyAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgIC8vIH1cclxuICAgIC5wcm9jYnRuIHtcclxuXHJcbiAgICAgICAgY29sb3I6ICNmZmZmZmY7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMTBweDtcclxuXHJcbiAgICAgICAgYnV0dG9uIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzI5NWRhMDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxZW07XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmJ1dHRvbi10ZXh0IHtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgLnNwaW5uZXIge1xyXG4gICAgICAgICAgICB0b3A6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm90dG9tOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXByb2dyZXNzLXNwaW5uZXIubWF0LXdhcm4gY2lyY2xlLFxyXG4gICAgICAgIC5tYXQtc3Bpbm5lci5tYXQtd2FybiBjaXJjbGUge1xyXG4gICAgICAgICAgICBzdHJva2U6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0iLCIjdmVyaWZpZWRfZmllbGRzIHtcbiAgbWluLXdpZHRoOiA1MDBweDtcbiAgbWF4LXdpZHRoOiA2MDBweDtcbiAgaGVpZ2h0OiAxMDAlO1xuICBvdmVyZmxvdzogaGlkZGVuO1xuICBwYWRkaW5nOiAxNXB4IDEwcHg7XG59XG4jdmVyaWZpZWRfZmllbGRzIC5tYXQtaWNvbiB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgbWFyZ2luLWxlZnQ6IDE1cHg7XG59XG4jdmVyaWZpZWRfZmllbGRzIC5tYXQtaWNvbjpob3ZlciB7XG4gIHRyYW5zZm9ybTogc2NhbGUoMS4xKTtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jdmVyaWZpZWRfZmllbGRzIC50eHQtZ3J5IHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jdmVyaWZpZWRfZmllbGRzIC50eHQtZ3J5MyB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3ZlcmlmaWVkX2ZpZWxkcyAudHh0LXJlZCB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI3ZlcmlmaWVkX2ZpZWxkcyAuY29udF9vdHAge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG59XG4jdmVyaWZpZWRfZmllbGRzIC5jb250X290cCBwIHNwYW4ge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiN2ZXJpZmllZF9maWVsZHMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XG4gIHBhZGRpbmctYm90dG9tOiA1cHggIWltcG9ydGFudDtcbn1cbiN2ZXJpZmllZF9maWVsZHMgLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgbWluLXdpZHRoOiAxMTBweDtcbiAgYm94LXNoYWRvdzogbm9uZSAhaW1wb3J0YW50O1xuICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAxcmVtO1xuICB0ZXh0LWRlY29yYXRpb246IG5vbmU7XG4gIHBhZGRpbmc6IDVweCAxMHB4O1xufVxuI3ZlcmlmaWVkX2ZpZWxkcyAucHJvY2J0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMyOTVkYTA7XG4gIGNvbG9yOiAjZmZmZmZmO1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiN2ZXJpZmllZF9maWVsZHMgLmJ0bnMge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiN2ZXJpZmllZF9maWVsZHMgLnJlc2VudGJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50O1xuICBib3JkZXI6IG5vbmU7XG4gIGNvbG9yOiAjMjk1ZGEwO1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4jdmVyaWZpZWRfZmllbGRzIC5kaXZvdXRlciB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI3ZlcmlmaWVkX2ZpZWxkcyAuZGl2b3V0ZXIgLmZsZXhhbGlnbi5kaXZpbm5lciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBsZWZ0OiAwO1xuICBwb3NpdGlvbjogc3RpY2t5O1xuICBtYXgtd2lkdGg6IDg4JTtcbn1cbiN2ZXJpZmllZF9maWVsZHMgLmRpdm91dGVyIC5mbGV4YWxpZ24uZGl2aW5uZXIgI3BhcnRpdGlvbmVkIHtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbiAgcGFkZGluZy1sZWZ0OiAxNnB4O1xuICBsZXR0ZXItc3BhY2luZzogNjJweDtcbiAgYm9yZGVyOiAwO1xuICBtaW4td2lkdGg6IDMwM3B4O1xuICBvdXRsaW5lOiBub25lO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRvcDogNXB4O1xufVxuI3ZlcmlmaWVkX2ZpZWxkcyAuZGlzYWJsZV9pY29uIHtcbiAgb3BhY2l0eTogMC41O1xuICBjdXJzb3I6IG5vdC1hbGxvd2VkO1xuICBwb2ludGVyLWV2ZW50czogbm9uZTtcbn1cbiN2ZXJpZmllZF9maWVsZHMgLm90cGZpZWxkIHtcbiAgZGlzcGxheTogYmxvY2s7XG4gIGhlaWdodDogMTJweDtcbiAgd2lkdGg6IDI2MXB4ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtaW1hZ2U6IGxpbmVhci1ncmFkaWVudCh0byBsZWZ0LCBibGFjayA2OSUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMCkgMCUpICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtcG9zaXRpb246IGJvdHRvbTtcbiAgYmFja2dyb3VuZC1zaXplOiA3MHB4IDFweDtcbiAgYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdC14O1xuICBiYWNrZ3JvdW5kLXBvc2l0aW9uLXg6IDQ3cHg7XG59XG4jdmVyaWZpZWRfZmllbGRzIC5wcm9jYnRuIHtcbiAgY29sb3I6ICNmZmZmZmY7XG4gIG1pbi13aWR0aDogMTEwcHg7XG59XG4jdmVyaWZpZWRfZmllbGRzIC5wcm9jYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMyOTVkYTA7XG4gIGhlaWdodDogNDVweDtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMWVtO1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiN2ZXJpZmllZF9maWVsZHMgLnByb2NidG4gLmJ1dHRvbi10ZXh0IHtcbiAgY29sb3I6ICNmZmY7XG59XG4jdmVyaWZpZWRfZmllbGRzIGJ1dHRvbiAuc3Bpbm5lciB7XG4gIHRvcDogYXV0byAhaW1wb3J0YW50O1xuICBib3R0b206IGF1dG8gIWltcG9ydGFudDtcbn1cbiN2ZXJpZmllZF9maWVsZHMgYnV0dG9uIC5tYXQtcHJvZ3Jlc3Mtc3Bpbm5lci5tYXQtd2FybiBjaXJjbGUsXG4jdmVyaWZpZWRfZmllbGRzIGJ1dHRvbiAubWF0LXNwaW5uZXIubWF0LXdhcm4gY2lyY2xlIHtcbiAgc3Ryb2tlOiAjZmZmICFpbXBvcnRhbnQ7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.scss":
  /*!************************************************************************************!*\
    !*** ./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.scss ***!
    \************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesAccountsettingsTwofactorauthTwofactorauthComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".otpfields .mat-dialog-container {\n  padding: 0 !important;\n  overflow: inherit;\n}\n\n#email_verification .banners {\n  background-image: url('http://192.168.1.200:82/opal_usp/app/assets/images/opalimages/backbanner.svg');\n  background-position: center;\n  background-repeat: no-repeat;\n  height: 430px;\n}\n\n#email_verification .login_footer {\n  margin-top: -7%;\n}\n\n#email_verification .langbtn {\n  background: none;\n  border: none;\n  font-size: 1rem;\n  cursor: pointer;\n}\n\n#email_verification .langbtn:hover .mat-icon {\n  color: #ED1C27;\n}\n\n#email_verification .langbtn .mat-icon {\n  display: flex;\n  align-items: center;\n  font-size: 25px !important;\n}\n\n#email_verification .langbtn .mat-icon:hover {\n  color: #ED1C27;\n}\n\n#email_verification .txt-gry {\n  color: #262626;\n}\n\n#email_verification .txt-gry3 {\n  color: #848484;\n}\n\n#email_verification .account_information .bredcrumblist {\n  list-style-type: none;\n  margin: 0;\n  display: flex;\n  align-items: center;\n}\n\n#email_verification .account_information .bredcrumblist li {\n  display: flex;\n  align-items: center;\n}\n\n#email_verification .account_information .bredcrumblist li span {\n  display: flex;\n  align-items: center;\n  color: #626366;\n  font-size: 0.875rem;\n}\n\n#email_verification .account_information .bredcrumblist li a {\n  color: #626366;\n  font-size: 14px;\n}\n\n#email_verification .account_information .bredcrumblist:last-child {\n  margin-right: 0;\n}\n\n#email_verification .account_information .bredcrumblist:last-child a {\n  margin-right: 0;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#email_verification .account_information .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n\n#email_verification .account_information .read_only input[readonly] {\n  cursor: no-drop;\n}\n\n#email_verification .account_information .mat-raised-button {\n  box-shadow: none !important;\n  border-radius: 2px !important;\n  font-size: 1rem;\n  text-decoration: none;\n  padding: 5px 10px;\n}\n\n#email_verification .account_information .cancelbtn {\n  min-width: 110px;\n  background-color: #e8e8e8;\n  color: #58626e;\n  padding-left: 0px;\n  padding-right: 0px;\n}\n\n#email_verification .account_information .savebtn {\n  min-width: 110px;\n  height: 45px;\n  background-color: #ED1C27;\n  color: #ffffff !important;\n  display: inline-block;\n}\n\n#email_verification .account_information .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n\n#email_verification .account_information .mat-form-field-suffix .mat-icon {\n  color: #999999;\n}\n\n#email_verification .account_information .verifytop {\n  background-color: #C4C4C4;\n  color: #fff !important;\n  font-size: 14px;\n  position: relative;\n  top: -7px;\n  padding: 2px 0px;\n  border-radius: 20px;\n}\n\n#email_verification .account_information .verifytop span {\n  font-size: 14px;\n  height: 0px;\n}\n\n#email_verification .account_information .verifed {\n  background-color: #009c3a;\n  color: #fff !important;\n  font-size: 14px;\n  padding: 2px 0px;\n  position: relative;\n  top: -7px;\n  border-radius: 20px;\n}\n\n#email_verification .account_information .verifed span {\n  font-size: 14px;\n  height: 0px;\n}\n\n#email_verification .button-text {\n  line-height: 45px !important;\n  font-size: 14px;\n  color: #fff;\n}\n\n#email_verification button .spinner {\n  top: auto !important;\n  bottom: auto !important;\n}\n\n#email_verification button .mat-progress-spinner.mat-warn circle,\n#email_verification button .mat-spinner.mat-warn circle {\n  stroke: #fff !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hY2NvdW50c2V0dGluZ3MvdHdvZmFjdG9yYXV0aC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxhY2NvdW50c2V0dGluZ3NcXHR3b2ZhY3RvcmF1dGhcXHR3b2ZhY3RvcmF1dGguY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYWNjb3VudHNldHRpbmdzL3R3b2ZhY3RvcmF1dGgvdHdvZmFjdG9yYXV0aC5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDSTtFQUNJLHFCQUFBO0VBQ0EsaUJBQUE7QUNBUjs7QURLSTtFQUNJLHFHQUFBO0VBQ0EsMkJBQUE7RUFDQSw0QkFBQTtFQUNBLGFBQUE7QUNGUjs7QURJSTtFQUNJLGVBQUE7QUNGUjs7QURLSTtFQUNJLGdCQUFBO0VBQ0EsWUFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0FDSFI7O0FES1k7RUFDSSxjQUFBO0FDSGhCOztBRE1RO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0VBQ0EsMEJBQUE7QUNKWjs7QURLWTtFQUNJLGNBQUE7QUNIaEI7O0FEUUk7RUFDSSxjQUFBO0FDTlI7O0FEU0k7RUFDSSxjQUFBO0FDUFI7O0FEWVE7RUFDSSxxQkFBQTtFQUNBLFNBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUNWWjs7QURZWTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ1ZoQjs7QURZZ0I7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxjQUFBO0VBQ0EsbUJBQUE7QUNWcEI7O0FEYWdCO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QUNYcEI7O0FEZVk7RUFDSSxlQUFBO0FDYmhCOztBRGVnQjtFQUNJLGVBQUE7QUNicEI7O0FEbUJZO0VBQ0ksY0FBQTtBQ2pCaEI7O0FEb0JZO0VBQ0ksMEJBQUE7QUNsQmhCOztBRHFCWTtFQUNJLDBCQUFBO0FDbkJoQjs7QURzQlk7RUFDSSxjQUFBO0FDcEJoQjs7QUR1Qlk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNyQmhCOztBRHlCZ0I7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUN2QnBCOztBRDRCd0I7RUFDSSxjQUFBO0FDMUI1Qjs7QURpQ2dCO0VBQ0kseUJBQUE7QUMvQnBCOztBRHFDZ0I7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNuQ3BCOztBRHlDb0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUN2Q3hCOztBRHlDd0I7RUFDSSxjQUFBO0FDdkM1Qjs7QUQyQ29CO0VBQ0kscUJBQUE7QUN6Q3hCOztBRGlEWTtFQUNJLGVBQUE7QUMvQ2hCOztBRG1EUTtFQUNJLDJCQUFBO0VBQ0EsNkJBQUE7RUFDQSxlQUFBO0VBQ0EscUJBQUE7RUFDQSxpQkFBQTtBQ2pEWjs7QURvRFE7RUFDSSxnQkFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7QUNsRFo7O0FEcURRO0VBQ0ksZ0JBQUE7RUFDQSxZQUFBO0VBQ0EseUJBQUE7RUFDQSx5QkFBQTtFQUNBLHFCQUFBO0FDbkRaOztBRHdEZ0I7RUFDSSx5QkFBQTtBQ3REcEI7O0FENERZO0VBQ0ksY0FBQTtBQzFEaEI7O0FEZ0VRO0VBQ0kseUJBQUE7RUFDQSxzQkFBQTtFQUNBLGVBQUE7RUFDQSxrQkFBQTtFQUNBLFNBQUE7RUFDQSxnQkFBQTtFQUNBLG1CQUFBO0FDOURaOztBRGdFWTtFQUNJLGVBQUE7RUFDQSxXQUFBO0FDOURoQjs7QURrRVE7RUFDSSx5QkFBQTtFQUNBLHNCQUFBO0VBQ0EsZUFBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFDQSxTQUFBO0VBQ0EsbUJBQUE7QUNoRVo7O0FEa0VZO0VBQ0ksZUFBQTtFQUNBLFdBQUE7QUNoRWhCOztBRHNFSTtFQUNJLDRCQUFBO0VBQ0EsZUFBQTtFQUNBLFdBQUE7QUNwRVI7O0FEeUVRO0VBQ0ksb0JBQUE7RUFDQSx1QkFBQTtBQ3ZFWjs7QUQwRVE7O0VBRUksdUJBQUE7QUN4RVoiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL2FjY291bnRzZXR0aW5ncy90d29mYWN0b3JhdXRoL3R3b2ZhY3RvcmF1dGguY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIub3RwZmllbGRzIHtcclxuICAgIC5tYXQtZGlhbG9nLWNvbnRhaW5lciB7XHJcbiAgICAgICAgcGFkZGluZzogMCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG92ZXJmbG93OiBpbmhlcml0O1xyXG4gICAgfVxyXG59XHJcbiNlbWFpbF92ZXJpZmljYXRpb24ge1xyXG4gICBcclxuICAgIC5iYW5uZXJzIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWltYWdlOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvb3BhbGltYWdlcy9iYWNrYmFubmVyLnN2Z1wiKTtcclxuICAgICAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiBjZW50ZXI7XHJcbiAgICAgICAgYmFja2dyb3VuZC1yZXBlYXQ6IG5vLXJlcGVhdDtcclxuICAgICAgICBoZWlnaHQ6IDQzMHB4O1xyXG4gICAgfVxyXG4gICAgLmxvZ2luX2Zvb3RlciB7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogLTclO1xyXG4gICAgfVxyXG5cclxuICAgIC5sYW5nYnRuIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiBub25lO1xyXG4gICAgICAgIGJvcmRlcjogbm9uZTtcclxuICAgICAgICBmb250LXNpemU6IDFyZW07XHJcbiAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAyNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnR4dC1ncnkge1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG5cclxuICAgIC50eHQtZ3J5MyB7XHJcbiAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmFjY291bnRfaW5mb3JtYXRpb24ge1xyXG5cclxuICAgICAgICAuYnJlZGNydW1ibGlzdCB7XHJcbiAgICAgICAgICAgIGxpc3Qtc3R5bGUtdHlwZTogbm9uZTtcclxuICAgICAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgICAgICAgbGkge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjNjI2MzY2O1xyXG4gICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgYSB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmOmxhc3QtY2hpbGQge1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAwO1xyXG5cclxuICAgICAgICAgICAgICAgIGEge1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG5cclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLS45cmVtKSBzY2FsZSgwLjc1KTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuXHJcbiAgICAgICAgLnJlYWRfb25seSB7XHJcbiAgICAgICAgICAgIGlucHV0W3JlYWRvbmx5XSB7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IG5vLWRyb3A7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMXJlbTtcclxuICAgICAgICAgICAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xyXG4gICAgICAgICAgICBwYWRkaW5nOiA1cHggMTBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5jYW5jZWxidG4ge1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZThlOGU4O1xyXG4gICAgICAgICAgICBjb2xvcjogIzU4NjI2ZTtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5zYXZlYnRuIHtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiAxMTBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZmZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAgICBcclxuXHJcbiAgICAgICAgLnZlcmlmeXRvcCB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNDNEM0QzQ7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTRweDtcclxuICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICB0b3A6IC03cHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDJweCAwcHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDIwcHg7XHJcblxyXG4gICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTRweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAudmVyaWZlZCB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2E7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTRweDtcclxuICAgICAgICAgICAgcGFkZGluZzogMnB4IDBweDtcclxuICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICB0b3A6IC03cHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDIwcHg7XHJcblxyXG4gICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTRweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAuYnV0dG9uLXRleHQge1xyXG4gICAgICAgIGxpbmUtaGVpZ2h0OiA0NXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIC5zcGlubmVyY2lyY2xlIHtcclxuICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgLnNwaW5uZXIge1xyXG4gICAgICAgICAgICB0b3A6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm90dG9tOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXByb2dyZXNzLXNwaW5uZXIubWF0LXdhcm4gY2lyY2xlLFxyXG4gICAgICAgIC5tYXQtc3Bpbm5lci5tYXQtd2FybiBjaXJjbGUge1xyXG4gICAgICAgICAgICBzdHJva2U6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLy8gfVxyXG59IiwiLm90cGZpZWxkcyAubWF0LWRpYWxvZy1jb250YWluZXIge1xuICBwYWRkaW5nOiAwICFpbXBvcnRhbnQ7XG4gIG92ZXJmbG93OiBpbmhlcml0O1xufVxuXG4jZW1haWxfdmVyaWZpY2F0aW9uIC5iYW5uZXJzIHtcbiAgYmFja2dyb3VuZC1pbWFnZTogdXJsKFwifi9hc3NldHMvaW1hZ2VzL29wYWxpbWFnZXMvYmFja2Jhbm5lci5zdmdcIik7XG4gIGJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlcjtcbiAgYmFja2dyb3VuZC1yZXBlYXQ6IG5vLXJlcGVhdDtcbiAgaGVpZ2h0OiA0MzBweDtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmxvZ2luX2Zvb3RlciB7XG4gIG1hcmdpbi10b3A6IC03JTtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmxhbmdidG4ge1xuICBiYWNrZ3JvdW5kOiBub25lO1xuICBib3JkZXI6IG5vbmU7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAubGFuZ2J0bjpob3ZlciAubWF0LWljb24ge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmxhbmdidG4gLm1hdC1pY29uIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgZm9udC1zaXplOiAyNXB4ICFpbXBvcnRhbnQ7XG59XG4jZW1haWxfdmVyaWZpY2F0aW9uIC5sYW5nYnRuIC5tYXQtaWNvbjpob3ZlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAudHh0LWdyeSB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAudHh0LWdyeTMge1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLmJyZWRjcnVtYmxpc3Qge1xuICBsaXN0LXN0eWxlLXR5cGU6IG5vbmU7XG4gIG1hcmdpbjogMDtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLmJyZWRjcnVtYmxpc3QgbGkge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAuYnJlZGNydW1ibGlzdCBsaSBzcGFuIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY29sb3I6ICM2MjYzNjY7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4jZW1haWxfdmVyaWZpY2F0aW9uIC5hY2NvdW50X2luZm9ybWF0aW9uIC5icmVkY3J1bWJsaXN0IGxpIGEge1xuICBjb2xvcjogIzYyNjM2NjtcbiAgZm9udC1zaXplOiAxNHB4O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAuYnJlZGNydW1ibGlzdDpsYXN0LWNoaWxkIHtcbiAgbWFyZ2luLXJpZ2h0OiAwO1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAuYnJlZGNydW1ibGlzdDpsYXN0LWNoaWxkIGEge1xuICBtYXJnaW4tcmlnaHQ6IDA7XG59XG4jZW1haWxfdmVyaWZpY2F0aW9uIC5hY2NvdW50X2luZm9ybWF0aW9uIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjNmJhNWVjO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jZW1haWxfdmVyaWZpY2F0aW9uIC5hY2NvdW50X2luZm9ybWF0aW9uIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jZW1haWxfdmVyaWZpY2F0aW9uIC5hY2NvdW50X2luZm9ybWF0aW9uIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jZW1haWxfdmVyaWZpY2F0aW9uIC5hY2NvdW50X2luZm9ybWF0aW9uIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLnJlYWRfb25seSBpbnB1dFtyZWFkb25seV0ge1xuICBjdXJzb3I6IG5vLWRyb3A7XG59XG4jZW1haWxfdmVyaWZpY2F0aW9uIC5hY2NvdW50X2luZm9ybWF0aW9uIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XG4gIGJveC1zaGFkb3c6IG5vbmUgIWltcG9ydGFudDtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbiAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xuICBwYWRkaW5nOiA1cHggMTBweDtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLmNhbmNlbGJ0biB7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlOGU4ZTg7XG4gIGNvbG9yOiAjNTg2MjZlO1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAuc2F2ZWJ0biB7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcbiAgY29sb3I6ICNmZmZmZmYgIWltcG9ydGFudDtcbiAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAubWF0LWZvcm0tZmllbGQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogI2RjNGM2NCAhaW1wb3J0YW50O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAubWF0LWZvcm0tZmllbGQtc3VmZml4IC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjOTk5OTk5O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAudmVyaWZ5dG9wIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0M0QzRDNDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRvcDogLTdweDtcbiAgcGFkZGluZzogMnB4IDBweDtcbiAgYm9yZGVyLXJhZGl1czogMjBweDtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLnZlcmlmeXRvcCBzcGFuIHtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBoZWlnaHQ6IDBweDtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmFjY291bnRfaW5mb3JtYXRpb24gLnZlcmlmZWQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA5YzNhO1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDE0cHg7XG4gIHBhZGRpbmc6IDJweCAwcHg7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgdG9wOiAtN3B4O1xuICBib3JkZXItcmFkaXVzOiAyMHB4O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiAuYWNjb3VudF9pbmZvcm1hdGlvbiAudmVyaWZlZCBzcGFuIHtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBoZWlnaHQ6IDBweDtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gLmJ1dHRvbi10ZXh0IHtcbiAgbGluZS1oZWlnaHQ6IDQ1cHggIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBjb2xvcjogI2ZmZjtcbn1cbiNlbWFpbF92ZXJpZmljYXRpb24gYnV0dG9uIC5zcGlubmVyIHtcbiAgdG9wOiBhdXRvICFpbXBvcnRhbnQ7XG4gIGJvdHRvbTogYXV0byAhaW1wb3J0YW50O1xufVxuI2VtYWlsX3ZlcmlmaWNhdGlvbiBidXR0b24gLm1hdC1wcm9ncmVzcy1zcGlubmVyLm1hdC13YXJuIGNpcmNsZSxcbiNlbWFpbF92ZXJpZmljYXRpb24gYnV0dG9uIC5tYXQtc3Bpbm5lci5tYXQtd2FybiBjaXJjbGUge1xuICBzdHJva2U6ICNmZmYgIWltcG9ydGFudDtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.ts":
  /*!**********************************************************************************!*\
    !*** ./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.ts ***!
    \**********************************************************************************/

  /*! exports provided: TwofactorauthComponent */

  /***/
  function srcAppModulesAccountsettingsTwofactorauthTwofactorauthComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "TwofactorauthComponent", function () {
      return TwofactorauthComponent;
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


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/modules/registration/registration.service */
    "./src/app/modules/registration/registration.service.ts");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_6__);
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _modal_succesinfo__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! ./modal/succesinfo */
    "./src/app/modules/accountsettings/twofactorauth/modal/succesinfo.ts");
    /* harmony import */


    var _accountsettings_service__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! ../accountsettings.service */
    "./src/app/modules/accountsettings/accountsettings.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");

    var TwofactorauthComponent = /*#__PURE__*/function () {
      function TwofactorauthComponent(formBuilder, regService, accService, localstorageservice, security, router, el, translate, remoteService, cookieService, dialog, routeid) {
        _classCallCheck(this, TwofactorauthComponent);

        this.formBuilder = formBuilder;
        this.regService = regService;
        this.accService = accService;
        this.localstorageservice = localstorageservice;
        this.security = security;
        this.router = router;
        this.el = el;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.dialog = dialog;
        this.routeid = routeid;
        this.selectedtype = null;
        this.showpanel = false;
        this.matched = false;
        this.placeholder = this.i18n('tschangepassword.emaiadd');
        this.inputenable = false;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_10__["ErrorStateMatcher"]();
        this.spinnerButtonOptionsverify = {
          active: false,
          text: 'Verify',
          spinnerSize: 15,
          raised: false,
          stroked: false,
          type: 'button',
          buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate'
        };
        this.spinnerButtonOptionsverified = {
          active: false,
          text: 'Verified',
          spinnerSize: 25,
          raised: false,
          stroked: false,
          type: 'button',
          buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: true,
          mode: 'indeterminate'
        };
        this.spinnerButtonOptionssaveupdate = {
          active: false,
          spinnerSize: 25,
          text: 'Save & Update',
          raised: false,
          stroked: false,
          buttonColor: 'primary',
          spinnerColor: 'warn',
          fullWidth: true,
          disabled: false,
          mode: 'indeterminate'
        };
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
        this.dir = "ltr";
        this.AccEditForm = this.formBuilder.group({
          name: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
          userdesig: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
          useremailid: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
          useremailcnfmon: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
          usercontact: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
          emailverified: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
        });
      }

      _createClass(TwofactorauthComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this30 = this;

          if (localStorage.getItem('v3logindata') == null) {
            this.router.navigate(['/admin/login']);
          }

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this30.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;

            if (toSelect.languagecode == 'en') {
              this.spinnerButtonOptionsverify.text = 'Verify';
              this.spinnerButtonOptionsverified.text = 'Verified';
              this.spinnerButtonOptionssaveupdate.text = 'Save and Update';
            } else {
              this.spinnerButtonOptionsverify.text = 'Verify';
              this.spinnerButtonOptionsverified.text = 'Verified';
              this.spinnerButtonOptionssaveupdate.text = 'Save and Update';
            }
          } else {
            var _toSelect12 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect12.languagecode);
            this.dir = _toSelect12.dir;
            this.spinnerButtonOptionsverify.text = 'Verify';
            this.spinnerButtonOptionsverified.text = 'Verified';
            this.spinnerButtonOptionssaveupdate.text = 'Save and Update';
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this30.translate.setDefaultLang(_this30.cookieService.get('languageCode'));

            if (_this30.cookieService.get('languageCookieId') && _this30.cookieService.get('languageCookieId') != undefined && _this30.cookieService.get('languageCookieId') != null) {
              var _toSelect13 = _this30.languagelist.find(function (c) {
                return c.id === _this30.cookieService.get('languageCookieId');
              });

              _this30.translate.setDefaultLang(_toSelect13.languagecode);

              _this30.dir = _toSelect13.dir;

              if (_toSelect13.languagecode == 'en') {
                _this30.spinnerButtonOptionsverify.text = 'Verify';
                _this30.spinnerButtonOptionsverified.text = 'Verified';
                _this30.spinnerButtonOptionssaveupdate.text = 'Save and Update';
              } else {
                _this30.spinnerButtonOptionsverify.text = 'Verify';
                _this30.spinnerButtonOptionsverified.text = 'Verified';
                _this30.spinnerButtonOptionssaveupdate.text = 'Save and Update';
              }
            } else {
              var _toSelect14 = _this30.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this30.translate.setDefaultLang(_toSelect14.languagecode);

              _this30.dir = _toSelect14.dir;
              _this30.spinnerButtonOptionsverify.text = 'Verify';
              _this30.spinnerButtonOptionsverified.text = 'Verified';
              _this30.spinnerButtonOptionssaveupdate.text = 'Save and Update';
            }
          });
          this.pk = this.security.encrypt(this.localstorageservice.getInLocal('userPk'));
          this.getAccountsettingsdtls();
          this.viewinvoice();
        }
      }, {
        key: "focusInvalidKeys",
        value: function focusInvalidKeys(keys, form) {
          var panel = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;

          if (form == 'form') {
            var _iterator = _createForOfIteratorHelper(keys),
                _step;

            try {
              for (_iterator.s(); !(_step = _iterator.n()).done;) {
                var key = _step.value;

                if (this.AccEditForm.controls[key].invalid) {
                  this.AccEditForm.controls[key].setErrors({
                    required: true
                  });
                  this.AccEditForm.controls[key].markAsTouched();
                  var invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');

                  if (invalidControl) {
                    invalidControl.focus();
                  }

                  return false;
                }
              }
            } catch (err) {
              _iterator.e(err);
            } finally {
              _iterator.f();
            }

            return true;
          }
        }
      }, {
        key: "getAccountsettingsdtls",
        value: function getAccountsettingsdtls() {
          var _this31 = this;

          this.disableSubmitButton = true;
          this.accService.accountsettingsdata("").subscribe(function (response) {
            if (response.success) {
              _this31.AccEditForm.patchValue({
                name: response.data.primaryContact.firstname,
                userdesig: response.data.primaryContact.designation,
                useremailid: response.data.primaryContact.emailid,
                usercontact: response.data.primaryContact.mobileno,
                emailverified: response.data.primaryContact.confirmstatus,
                useremailcnfmon: response.data.primaryContact.emailpassseton
              });

              _this31.email = response.data.primaryContact.emailid;
            }

            _this31.disableSubmitButton = false;
          });
        }
      }, {
        key: "form",
        get: function get() {
          return this.AccEditForm.controls;
        }
      }, {
        key: "openDialog",
        value: function openDialog() {
          var _this32 = this;

          // this.spinnerButtonOptionsverify.active = true;
          // this.disableSubmitButton = true;
          if (this.form.useremailid.errors == null) {
            this.form.emailverified.setValue('2');
            this.form.emailverified.updateValueAndValidity();
            var dialogRef = this.dialog.open(_modal_succesinfo__WEBPACK_IMPORTED_MODULE_12__["succesinfo"], {
              disableClose: true,
              panelClass: 'otpfields',
              data: {
                'email': this.form.useremailid.value
              }
            });
            dialogRef.afterClosed().subscribe(function (result) {
              console.log(result.data); // this.spinnerButtonOptionsverify.active = false;

              if (result.data == true) {
                var date1 = new Date();

                _this32.form.emailverified.setValue('1');

                _this32.form.useremailcnfmon.setValue(date1.getTime());
              } else {
                _this32.form.emailverified.setValue('2');
              }

              _this32.form.emailverified.updateValueAndValidity();
            });
          } // this.disableSubmitButton = false;

        }
      }, {
        key: "submitUserDtls",
        value: function submitUserDtls() {
          var _this33 = this;

          this.spinnerButtonOptionssaveupdate.active = true;
          console.log(this.form.emailverified.value);

          if (this.AccEditForm.valid && this.form.emailverified.value == 1) {
            this.disableSubmitButton = true;
            this.accService.saveUserDtls(this.AccEditForm.value).subscribe(function (response) {
              _this33.getAccountsettingsdtls();

              setTimeout(function () {
                _this33.disableSubmitButton = false;
              }, 2000);

              if (_this33.train == 1) {
                _this33.router.navigate(['/trainingcentremanagement/maincentre'], {
                  queryParams: {
                    id: 1
                  }
                }); // console.log(123456)

              } else {
                _this33.router.navigate(['accountsettings/home']); // console.log(1234567)

              }
            });
          } else if (this.form.emailverified.value != 1) {
            this.form.emailverified.setErrors({
              NotVerified: true
            });
          }

          this.spinnerButtonOptionssaveupdate.active = false;
        }
      }, {
        key: "checkemailexists",
        value: function checkemailexists(value) {
          var _this34 = this;

          if (this.email !== value) {
            this.regService.checkEmail(value, this.pk, '2').subscribe(function (data) {
              if (data['data'].available) {
                _this34.form.useremailid.setErrors({
                  alreadyavailable: true
                });

                return false;
              }
            });
          }
        }
      }, {
        key: "checkemail",
        value: function checkemail() {
          if (this.email !== this.form.useremailid.value) {
            this.form.emailverified.setValue('2');
            this.form.emailverified.updateValueAndValidity();
          } else {
            this.form.emailverified.setValue('1');
            this.form.emailverified.updateValueAndValidity();
          }
        }
      }, {
        key: "backtoaccount",
        value: function backtoaccount() {
          var _this35 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_6___default()({
            title: this.i18n('twofactor.doyoucancl'),
            text: this.i18n('twofactor.ifyesanyunsave'),
            icon: 'warning',
            buttons: [this.i18n('twofactor.no'), this.i18n('twofactor.yes')]
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this35.getAccountsettingsdtls();

              _this35.disableSubmitButton = true; // this.router.navigate(['accountsettings/home']);

              if (_this35.train == 1) {
                _this35.router.navigate(['/trainingcentremanagement/maincentre'], {
                  queryParams: {
                    id: 1
                  }
                });

                console.log(123456);
              } else {
                _this35.router.navigate(['accountsettings/home']);

                console.log(1234567);
              }

              setTimeout(function () {
                _this35.disableSubmitButton = false;
              }, 2000);
            }
          });
        }
      }, {
        key: "viewinvoice",
        value: function viewinvoice() {
          var _this36 = this;

          this.routeid.queryParams.subscribe(function (params) {
            _this36.train = params['id'];
          });
        }
      }]);

      return TwofactorauthComponent;
    }();

    TwofactorauthComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_5__["RegistrationService"]
      }, {
        type: _accountsettings_service__WEBPACK_IMPORTED_MODULE_13__["AccountsettingsService"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_4__["AppLocalStorageServices"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_3__["Encrypt"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_14__["Router"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_11__["MatDialog"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_14__["ActivatedRoute"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('accSettingsData'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Array)], TwofactorauthComponent.prototype, "accSettingsData", void 0);
    TwofactorauthComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-twofactorauth',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./twofactorauth.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./twofactorauth.component.scss */
      "./src/app/modules/accountsettings/twofactorauth/twofactorauth.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_5__["RegistrationService"], _accountsettings_service__WEBPACK_IMPORTED_MODULE_13__["AccountsettingsService"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_4__["AppLocalStorageServices"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_3__["Encrypt"], _angular_router__WEBPACK_IMPORTED_MODULE_14__["Router"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_11__["MatDialog"], _angular_router__WEBPACK_IMPORTED_MODULE_14__["ActivatedRoute"]])], TwofactorauthComponent);
    /***/
  }
}]);
//# sourceMappingURL=modules-accountsettings-accountsettings-module-es5.js.map