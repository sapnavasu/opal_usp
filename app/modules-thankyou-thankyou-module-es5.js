function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-thankyou-thankyou-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/approvechange/approvechange.component.html":
  /*!*******************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/approvechange/approvechange.component.html ***!
    \*******************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesThankyouApprovechangeApprovechangeComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"headerstylings\" dir=\"{{dir}}\">\r\n  <!-- <div class=\"topheaderimage\">\r\n    <div class=\"completebanner\">\r\n      <div class=\"leftsiddebanner\">\r\n        <div class=\"makeitright p-t-40 m-l-60\">\r\n          <img src=\"assets/images/JSRSlogologin.png\" alt=\"jsrs logo\">\r\n        </div>\r\n      </div>\r\n      <div class=\"rightsidebanner\">  \r\n        <div class=\"innerrightbanner\">\r\n          <div class=\"textalignend m-b-10 m-t-22\">\r\n            <p class=\"helplinect fs-16  lypisfont-bold p-l-10 m-0\">Sultanate of Oman</p>\r\n            <img src=\"assets/images/flags/31.png\" alt=\"lybiyaflagimage\">\r\n          </div>\r\n          <img class=\"flaglypis\" src=\"assets/images/Flagbig.png\" alt=\"Country Flag\">\r\n          <div class=\"regcontentbanner\">\r\n            <div class=\"leftregcontrent position\">\r\n              <mat-list class=\"menulistitems\" role=\"list\">\r\n                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\"><i class=\"bgi bgi-home\" matTooltip=\"Home\" matTooltipPosition=\"below\"></i></a>\r\n                </mat-list-item>\r\n                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">About</a></mat-list-item>\r\n                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">Platforms</a></mat-list-item>\r\n                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">Media </a></mat-list-item>\r\n                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">Contact</a></mat-list-item>\r\n               \r\n              </mat-list>\r\n            </div>\r\n            <div class=\"rightregcontent\">\r\n              <button disabled type=\"button\" routerLink=\"/registration/index\" mat-raised-button color=\"primary\"\r\n                class=\"registerbtn m-r-15\">Register</button>\r\n              <button type=\"button\" routerLink=\"/admin/login\" mat-raised-button color=\"primary\"\r\n                class=\"loginbutton\">Login</button>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div> -->\r\n  <div class=\"leftisideinfodetail\">\r\n    <!-- <owl-carousel-o [options]=\"customOptions\"> -->\r\n\r\n    <!-- <ng-template carouselSlide> -->\r\n    <div class=\"imgposition loginbg\">\r\n      <!-- <img src=\"assets/images/jsrs-bannernew\" alt=\"jsrs-bannernew.jpg\"> -->\r\n    </div>\r\n    <!-- </ng-template> -->\r\n\r\n\r\n    <!-- </owl-carousel-o> -->\r\n  </div>\r\n\r\n  <div  class=\"rightsideinfodetail\">\r\n    <div class=\"langbtn d-flex\">\r\n      <button class=\"fs-15\" (click)=\"setLanguageFlag(lang);\">{{'commonlogin.engl' | translate}}</button>\r\n\r\n    </div>\r\n\r\n    <div class=\"footer-height\">\r\n    <div *ngIf=\"!pageStatus && pageFor == 'accept_cancel_reg'\">\r\n      <app-responseloader class=\"fixedaloders\" ></app-responseloader> \r\n    </div>\r\n    <div *ngIf=\"!isAuthorized && !isExpired && pageFor == 'change_user_authorise'\">\r\n       <app-registerationconfirmed></app-registerationconfirmed>\r\n    </div>\r\n    <div *ngIf=\"isAuthorized && !isExpired && pageFor == 'change_user_authorise'\">\r\n      <app-thankyoupageview [newUser]=\"newUser\"  [oldUser]=\"oldUser\" [type]='changetype'></app-thankyoupageview>\r\n    </div>\r\n    <div *ngIf=\"isExpired && !isAuthorized && pageFor == 'change_user_authorise'\">\r\n      <app-inviteexpired></app-inviteexpired>\r\n    </div>\r\n    </div>\r\n    <div ngClass.xs=\"responsivefooter\" ngClass.sm=\"responsivefooter\" class=\"login_footer p-l-5 p-r-5\"\r\n        fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n        <div fxFlex=\"<grow> <shrink> 100\" fxLayoutAlign='end' class=\"fs-14 adminfooter res_dis-con\" id=\"res_white-spc\">\r\n          <div ngClass.xs=\"fs-14 p-r-24 p-t-12\" ngClass.sm=\"fs-14 p-r-24 p-t-12 \" id=\"res_pr-0 \">\r\n            <p class=\"res_center\">&copy; OPAL {{currentyear}}{{'superadminfooter.allrigh' | translate}} .</p>\r\n\r\n          </div>\r\n        </div>\r\n        <div fxFlex=\"<grow> <shrink> 100\" class=\"fs-14 adminfooter footerspace\">\r\n          <div ngClass.xs=\"fs-14 p-r-24 p-t-12\" ngClass.sm=\"fs-14 p-r-24 p-t-12\" id=\"res_pr-0\">\r\n            <p>{{'superadminfooter.drivby' | translate}} <img class=\"img_hig-mar p-l-5 p-r-5\" src=\"./assets/images/bgi.svg\"\r\n                alt=\"Businessgateways International\"></p>\r\n          </div>\r\n        </div>\r\n      </div>\r\n  </div>\r\n \r\n  <app-responseloader class=\"aftersearchloaders\" *ngIf=\"initSpinner\"></app-responseloader>\r\n  <div *ngIf=\"pageStatus == 'C' && pageFor == 'accept_cancel_reg'\"  class=\"makeittopminus\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"cancelledreglist\">\r\n        <div class=\"registercancellist\">\r\n          <div class=\"textheadingreg\">\r\n            <h2 class=\"fs-18 m-0\">We are sorry to see you go.\r\n            </h2>\r\n            <p class=\"fs-15 m-0\">Before we cancel your OPAL Subscription, please let us know your feedback.</p>\r\n          </div>\r\n          <form [formGroup]=\"RegistercancelledForm\" (ngSubmit)=\"cancelRegistration()\">\r\n          <div fxLayout=\"row wrap\" class=\"subscribetext\">\r\n            <div fxFlex.gt-sm=\"16\" fxFlex=\"100\">\r\n              <p class=\"fs-16 m-0\">We are unsubscribing\r\n              </p>\r\n              <p class=\"fs-16 m-0 p-l-15\">from OPAL because:</p>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"84\" fxFlex=\"100\">\r\n              <mat-radio-group aria-labelledby=\"example-radio-group-label\" formControlName=\"canceldata\"  class=\"specifyradiogroup\"\r\n                [(ngModel)]=\"otherspecify\" (change)=\"radioChange()\">\r\n                <mat-radio-button class=\"example-radio-button\" *ngFor=\"let createspecify of createspecifys\"\r\n                  [value]=\"createspecify\">\r\n                  {{createspecify}}\r\n                </mat-radio-button>\r\n              </mat-radio-group>\r\n              <div *ngIf=\"RegistercancelledForm.controls['canceldata'].value == 'Others'\">                \r\n                  <div class=\"p-l-30 widthfiled\">\r\n                    <mat-form-field>\r\n                      <input matInput formControlName=\"pleasespecify\" [errorStateMatcher]=\"matcher\"\r\n                        placeholder=\"Please Specify\" required app-restrict-input=\"firstspace\">\r\n                      <mat-error\r\n                        *ngIf=\"RegistercancelledForm.controls['pleasespecify'].errors?.required && RegistercancelledForm.controls['pleasespecify'].touched\"\r\n                        class=\"text-danger font-14\">\r\n                        Please specify others\r\n                      </mat-error>\r\n                    </mat-form-field>\r\n                  </div>\r\n              </div>\r\n              <div class=\"willingcolor p-t-20\">\r\n                <mat-checkbox formControlName=\"termsandcondition\">\r\n                  <p class=\"m-0 fs-15\">We are willing to explore OPAL Certification after a year.</p>\r\n                </mat-checkbox>\r\n              </div>\r\n              <div fxLayout=\"row wrap\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"btnalignsub\">\r\n                  <button mat-raised-button type=\"submit\" class=\"submitbtn m-r-15\"\r\n                    [class.submitdisable]=\"!RegistercancelledForm.valid\"\r\n                    [disabled]=\"!RegistercancelledForm.valid\">Submit</button>                  \r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </form>\r\n        <app-responseloader class=\"aftersearchloaders\" *ngIf=\"initSpinner\"></app-responseloader>\r\n          <!-- <div class=\"loginbtn\">\r\n          <button mat-raised-button (click)=\"navigate()\" class=\"downloadbtncolor fs-16 button-45\">Go to Login</button>\r\n        </div> -->\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div *ngIf=\"pageStatus == 'CC' && pageFor == 'accept_cancel_reg'\" class=\"makeittopminus\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"thankyoulistview\">\r\n        <div class=\"thankyouinnerpart\">\r\n          <div class=\"p-b-10\">\r\n            <span class=\"cancellogo\">\r\n              <i class=\"bgi bgi-cancel\"></i>\r\n            </span>\r\n          </div>\r\n          <div class=\"jsrscontactcolor redcolor\">\r\n            <h2>Registration has been cancelled</h2>\r\n          </div>\r\n          <div class=\"transfertextcolor\">\r\n            <p>You have cancelled your OPAL registration. </p>\r\n          </div>\r\n          <div class=\"loginbtn\">\r\n            <button mat-raised-button (click)=\"navigateToLogin()\" color=\"primary\"\r\n              class=\"downloadbtncolor fs-16 button-45\">Go to Login</button>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div *ngIf=\"pageStatus == 'A' && pageFor == 'accept_cancel_reg'\" class=\"makeittopminus\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"thankyoulistview\">\r\n        <div class=\"thankyouinnerpart\">\r\n          <div class=\"successtick\">\r\n            <span>\r\n              <i class=\"bgi bgi-tick\"></i>\r\n            </span>\r\n          </div>\r\n          <div class=\"jsrscontactcolor\">\r\n            <h2>Registration Confirmed</h2>\r\n          </div>\r\n          <div class=\"transfertextcolor\">\r\n            <p>Thank you for confirming your registration. An email has been sent for setting your password. </p>\r\n            <p> The OPAL Certification fee invoice has been sent to your registered email ID.</p>\r\n          </div>\r\n          <div class=\"loginbtn\">\r\n            <button mat-raised-button color=\"primary\" (click)=\"redirectToSetPassword()\" class=\"downloadbtncolor fs-16 button-45\">Set Password</button>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div *ngIf=\"pageStatus == 'AA' && pageFor == 'accept_cancel_reg'\" class=\"makeittopminus\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"thankyoulistview\">\r\n        <div class=\"thankyouinnerpart\">\r\n          <div class=\"p-b-10\">\r\n            <span class=\"cancellogo\">\r\n              <i class=\"bgi bgi-cancel\"></i>\r\n            </span>\r\n          </div>\r\n          <div class=\"jsrscontactcolor redcolor\">\r\n            <h2>Registration already confirmed</h2>\r\n          </div>\r\n          <div class=\"transfertextcolor\">\r\n            <p>You have already confirmed your OPAL registration. </p>\r\n          </div>\r\n          <div class=\"loginbtn\">\r\n            <button mat-raised-button (click)=\"navigateToLogin()\" color=\"primary\" class=\"downloadbtncolor fs-16 button-45\">Go to Login</button>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div *ngIf=\"pageStatus == 'AC' && pageFor == 'accept_cancel_reg'\" class=\"makeittopminus\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"thankyoulistview\">\r\n        <div class=\"thankyouinnerpart\">\r\n          <div class=\"p-b-10\">\r\n            <span class=\"cancellogo\">\r\n              <i class=\"bgi bgi-cancel\"></i>\r\n            </span>\r\n          </div>\r\n          <div class=\"jsrscontactcolor redcolor\">\r\n            <h2>Registration already cancelled</h2>\r\n          </div>\r\n          <div class=\"transfertextcolor\">\r\n            <p>You have already cancelled your OPAL registration. </p>\r\n          </div>\r\n          <div class=\"loginbtn\">\r\n            <button mat-raised-button (click)=\"navigateToLogin()\" color=\"primary\"\r\n              class=\"downloadbtncolor fs-16 button-45\">Go to Login</button>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div *ngIf=\"pageStatus == 'EP' && pageFor == 'accept_cancel_reg'\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"expiredlistview\">\r\n        <div>\r\n          <img src=\"assets/images/expiredview.png\" alt=\"expiredview\">\r\n        </div>\r\n        <div class=\"jsrscontactcolor\">\r\n          <h2>OPAL Registration Expired!</h2>\r\n        </div>\r\n        <div class=\"transfertextcolor\">\r\n          <p>This link has expired. Kindly contact your Company Administrator.</p>\r\n        </div>\r\n        <div class=\"loginbtn\">\r\n          <button mat-raised-button (click)=\"navigateToLogin()\" class=\"downloadbtncolor fs-16 button-45\">OK</button>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div *ngIf=\"pageStatus == 'AI' && pageFor == 'accept_cancel_reg'\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"sessionexpired\">\r\n        <div  id=\"sessionlistview\">\r\n        <div>\r\n          <img src=\"assets/images/expiredview.png\" alt=\"expiredview\">\r\n        </div>\r\n        <div class=\"jsrscontactcolor\">\r\n          <h2>Registration Confirmation - Time Period Lapsed </h2>\r\n        </div>\r\n        <div class=\"transfertextcolor\">\r\n          <p>You have missed the 30-day time period to confirm your registration. Your registration is no longer valid, and we kindly request you to register once again on OPAL.\r\n            For queries or concerns, please feel free to reach out to us via email: <a href=\"mailto:jsrs@businessgateways.com\">jsrs@businessgateways.com </a>or call: +968 9671 3467</p>\r\n          \r\n        </div>\r\n        <div class=\"loginbtn\">\r\n          <button mat-raised-button (click)=\"navigateToLogin()\" class=\"downloadbtncolor fs-16 button-45\">OK</button>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <div class=\"regfooter\">\r\n    <div class=\"login_footer\" fxFlex=\"100\" fxFlex.gt-xs=\"90\" fxFlex.gt-md=\"83.33\">\r\n      <div class=\"login_footer_left\" fxHide=\"true\" fxHide.gt-md='false'>\r\n        <ul>\r\n          <li>\r\n            <a href=\"#\">Terms of Service</a>\r\n          </li>\r\n          <li>\r\n            <a href=\"#\">Privacy Policy</a>\r\n          </li>\r\n          <li>\r\n            <a href=\"#\">Help Center</a>\r\n          </li>\r\n          <li>\r\n            <a href=\"#\" class=\"m-r-20\"><i class=\"bgi bgi-facebook\" aria-hidden=\"true\"></i></a>\r\n            <a href=\"#\" class=\"m-r-20\"><i class=\"bgi bgi-twitter\" aria-hidden=\"true\"></i></a>\r\n            <a href=\"#\"><i class=\"bgi bgi-instagram\" aria-hidden=\"true\"></i></a>\r\n          </li>\r\n        </ul>\r\n      </div>\r\n      <div class=\"login_footer_right\">\r\n        <span>All Rights Reserved &copy; Business Gateways International 2022.</span>\r\n      </div>\r\n      <div class=\"drivenalign\">\r\n        <P class=\"fs-14 m-0 p-t-38\">Driven by </P>\r\n        <img src=\"assets/images/bgi.svg\" alt=\"Business Gateways International\">\r\n      </div>\r\n    </div>\r\n  </div>\r\n\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/inviteexpired/inviteexpired.component.html":
  /*!*******************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/inviteexpired/inviteexpired.component.html ***!
    \*******************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesThankyouInviteexpiredInviteexpiredComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"expiredlistview\">\r\n     <div>\r\n       <img src=\"assets/images/expiredview.png\" alt=\"expiredview\">\r\n     </div>\r\n    <div class=\"jsrscontactcolor\">\r\n      <h2>{{'inviteexpire.userinvilink' | translate}} </h2>\r\n    </div>\r\n    <div class=\"transfertextcolor\">\r\n      <p>{{'inviteexpire.thislinkhas' | translate}} </p>\r\n    </div>\r\n    <div class=\"transfertextcolor\">\r\n      <p>{{'inviteexpire.forfurthquer' | translate}} <a href=\"support@OPAL.om\" target=\"_blank\" innerHtml=\"{{'inviteexpire.supemIL' | translate}}\"></a>  {{'inviteexpire.orcl' | translate}}  +968 2416 6177. </p>\r\n    </div>\r\n    <div class=\"loginbtn\">\r\n      <a href=\"https://qa.OPAL.om/\"> <button mat-raised-button  class=\"downloadbtncolor fs-14 button-45 \">{{'inviteexpire.backtohom' | translate}}</button></a>\r\n    </div>\r\n  </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.html":
  /*!*************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.html ***!
    \*************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesThankyouRegisterationconfirmedRegisterationconfirmedComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"headerstyle\" dir=\"{{dir}}\">\r\n    <div class=\"leftisideinfodetail\">\r\n      <div class=\"imgposition loginbg\">\r\n      </div>\r\n    </div>\r\n  <div class=\"rightsideinfodetail\">\r\n      <div class=\"langbtn d-flex\">\r\n        <button class=\"fs-15\" (click)=\"setLanguageFlag(lang);\">{{'commonlogin.engl' | translate}}</button>\r\n      </div>\r\n      <div fxLayout=\"row wrap\">\r\n        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n          <div id=\"registerlistview\">\r\n            <div class=\"successtick\">\r\n              <span>\r\n                <i class=\"bgi bgi-tick\"></i>\r\n              </span>\r\n            </div>\r\n            <div class=\"jsrscontactcolor\">\r\n              <h2>{{'registrationconfirmed.regconfim' | translate}}</h2>\r\n            </div>\r\n            <div class=\"transfertextcolor\">\r\n              <p>{{'registrationconfirmed.thankyufrconfirm' | translate}}\r\n              </p>\r\n            </div>\r\n            <div class=\"loginbtn d-flex\">\r\n              <button mat-raised-button (click)=\"navigate()\"class=\"downloadbtncolor fs-16 button-45 m-r-10\">{{'registrationconfirmed.gotolog' | translate}}</button>\r\n              <a href=\"https://qa.OPAL.om/\"> <button mat-raised-button\r\n                class=\"downloadbtncolor fs-16 button-45\">{{'registrationconfirmed.backtohom' | translate}}</button></a>\r\n          </div>\r\n        </div>\r\n      </div>\r\n  </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.html":
  /*!*************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.html ***!
    \*************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesThankyouThankyoupageviewThankyoupageviewComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" *ngIf=\"type == 'accept'\" class=\"contain\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"thankyoulistview\">\r\n    <div class=\"successtick\">\r\n      <span>\r\n        <i class=\"bgi bgi-tick\"></i>\r\n      </span>\r\n    </div>\r\n    <div class=\"jsrscontactcolor\">\r\n      <h2>{{'registrationconfirmed.regconfim' | translate}}</h2>\r\n    </div>\r\n    <div class=\"transfertextcolor\">\r\n      <p>{{'registrationconfirmed.thankyufrconfirm' | translate}}&nbsp;{{newUser}}&nbsp;{{'registrationconfirmed.thankyufrconfirmnext' | translate}}</p>\r\n      \r\n    </div>\r\n    <div class=\"btns d-flex\">\r\n      <div class=\"loginbtn p-r-20\">\r\n        <button mat-raised-button (click)=\"navigate()\" class=\"downloadbtncolor fs-16 button-45\">{{'registrationconfirmed.gotolog' | translate}}</button>\r\n      </div>\r\n      <div class=\"loginbtn\">\r\n        <a href=\"https://qa.OPAL.om/\"> <button mat-raised-button\r\n          class=\"downloadbtncolor fs-16 button-45\">{{'registrationconfirmed.backtohom' | translate}}</button></a>   \r\n    </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div fxLayout=\"row wrap\" *ngIf=\"type == 'cancel'\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"thankyoulistview\">\r\n    <div class=\"successtick\">\r\n      <span>\r\n        <i class=\"bgi bgi-tick\"></i>\r\n      </span>\r\n    </div>\r\n    <div class=\"jsrscontactcolor\">\r\n      <h2>{{'thankyoupageview.chanreqinprim' | translate}}</h2>\r\n    </div>\r\n    <div class=\"transfertextcolor\">\r\n      <p>{{'thankyoupageview.youhavcanthereq' | translate}}&nbsp;{{newUser}}&nbsp;{{'thankyoupageview.to' | translate}}&nbsp;{{oldUser}}.</p>\r\n      <p>{{'thankyoupageview.forfurtquer' | translate}}<a href=\"support@OPAL.om\" target=\"_blank\" innerHtml=\"{{'thankyoupageview.email' | translate}}\"></a>{{'thankyoupageview.orcal' | translate}}  +968 2416 6177.</p>\r\n      <p><a href=\"//www.qa.OPAL.om\" target=\"_blank\" innerHtml=\"{{'thankyoupageview.website' | translate}}\"></a></p>\r\n     \r\n    </div>\r\n    <div class=\"loginbtn\">\r\n      <button mat-raised-button (click)=\"navigate()\" class=\"downloadbtncolor fs-16 button-45\">{{'thankyoupageview.gotolog' | translate}}</button>\r\n    </div>\r\n  </div>\r\n</div>";
    /***/
  },

  /***/
  "./src/app/modules/thankyou/approvechange/approvechange.component.scss":
  /*!*****************************************************************************!*\
    !*** ./src/app/modules/thankyou/approvechange/approvechange.component.scss ***!
    \*****************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesThankyouApprovechangeApprovechangeComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".headerstylings {\n  background: #f2f3f7 !important;\n  position: relative;\n  height: 100vh;\n  display: flex;\n}\n.headerstylings .headerimage {\n  text-align: center;\n}\n.headerstylings .headerimage img {\n  width: 150px;\n  height: 150px;\n  margin-top: 100px;\n}\n.headerstylings .headerimage h4 {\n  color: #333333;\n}\n.headerstylings .regfooter {\n  min-height: 95px;\n  align-items: flex-end;\n  padding-bottom: 20px;\n}\n.headerstylings .regfooter .login_footer {\n  display: flex;\n  justify-content: space-between;\n  background: transparent;\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 94% !important;\n  align-items: center;\n}\n.headerstylings .regfooter .login_footer .login_footer_left ul li a {\n  color: #333 !important;\n  display: flex;\n  align-items: center;\n  font-size: 15px !important;\n}\n.headerstylings .regfooter .login_footer_right span {\n  color: #333 !important;\n  font-size: 15px !important;\n}\n.headerstylings .regfooter .drivenalign {\n  display: flex;\n  align-items: flex-end;\n  margin-top: -40px;\n}\n.headerstylings .regfooter .drivenalign p {\n  color: #333;\n  padding-right: 10px;\n}\n.headerstylings .regfooter .drivenalign img {\n  height: 40px;\n}\n.headerstylings .tablbelicon i {\n  font-size: 3.125rem;\n}\n.headerstylings .topheaderimage img {\n  max-width: 82%;\n}\n.headerstylings .completebanner {\n  display: flex;\n  justify-content: center;\n  min-height: 275px;\n  background-color: #e0f0ff;\n}\n.headerstylings .completebanner .backtohome {\n  display: block;\n}\n.headerstylings .completebanner .regcontentbanner {\n  display: flex;\n  max-width: 100%;\n  justify-content: space-between;\n}\n.headerstylings .completebanner .regcontentbanner .rightregcontent {\n  text-align: center;\n}\n.headerstylings .completebanner .leftsiddebanner {\n  width: 20%;\n  background: #fff;\n}\n.headerstylings .completebanner .leftsiddebanner .welcomelybia {\n  color: #333;\n  font-size: 0.875rem;\n  text-align: center;\n  padding-top: 5px;\n}\n.headerstylings .completebanner .leftsiddebanner .logoandgoback {\n  height: 18%;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.headerstylings .completebanner .leftsiddebanner .logoandgoback .backtohome {\n  color: #333;\n  font-size: 0.875rem;\n  position: relative;\n  top: 32px;\n  display: flex;\n  align-items: center;\n  cursor: pointer;\n}\n.headerstylings .completebanner .leftsiddebanner .logoandgoback .backtohome i {\n  padding-right: 6px;\n  font-size: 0.625rem;\n}\n.headerstylings .completebanner .rightsidebanner {\n  width: 80%;\n  background-repeat: no-repeat;\n  background-image: url('http://192.168.1.200:82/opal_usp/app/assets/images/globenew.png');\n  background-position: right 0px top 120px;\n  background-size: contain;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner {\n  position: relative;\n  max-width: 96%;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner p {\n  color: #fff;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .helplinect {\n  color: #666;\n  padding-right: 10px;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .leftregcontrent {\n  width: 100%;\n  justify-content: flex-end;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .leftregcontrent .header {\n  color: #f1f2f7;\n  font-size: 1.625rem;\n  font-weight: bold;\n  margin-bottom: 10px;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .leftregcontrent .submitprofile {\n  color: #8ebae6;\n  font-size: 0.9375rem;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .rightregcontent {\n  display: flex;\n  align-items: center;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .rightregcontent .loginbutton {\n  color: #fff;\n  font-size: 0.9375rem;\n  background: #ef8436;\n  width: 85px;\n  height: 30px;\n  border-radius: 50px !important;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .rightregcontent .registerbtn {\n  background-color: #006db7;\n  color: #fff;\n  width: 98px;\n  height: 30px;\n  font-size: 0.9375rem;\n  border-radius: 50px !important;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.headerstylings .completebanner .rightsidebanner .flaglypis {\n  left: 0;\n  position: absolute;\n  top: 0;\n}\n.headerstylings .newcardright {\n  text-align: center;\n}\n.headerstylings .newcardright .explorer {\n  color: #006db7;\n  font-size: 1.125rem;\n  font-weight: bold;\n  padding-bottom: 10px;\n}\n.headerstylings .newcardright img {\n  padding-top: 25px;\n  padding-bottom: 25px;\n  max-width: 90px;\n  margin-left: auto;\n  margin-right: auto;\n}\n.headerstylings .position {\n  display: flex;\n  padding-top: 0px;\n  padding-left: 100px;\n}\n.headerstylings .position span {\n  padding-right: 44px;\n  color: #fff;\n}\n.headerstylings .circleimage img {\n  margin-top: -6px;\n}\n.headerstylings .leftisideinfodetail {\n  background-clip: padding-box;\n  width: 50%;\n  z-index: 0;\n  height: 100%;\n}\n.headerstylings .leftisideinfodetail .loginbg {\n  background: url('http://192.168.1.200:82/opal_usp/app/assets/images/bg.png') top left no-repeat;\n  background-size: cover;\n  height: 100% !important;\n  width: 100%;\n  -o-object-fit: cover;\n     object-fit: cover;\n  margin-left: 0;\n  background-position: center;\n}\n@media (min-width: 1920px) {\n  .headerstylings .leftisideinfodetail .loginbg {\n    background: url('http://192.168.1.200:82/opal_usp/app/assets/images/bg.png') top left no-repeat;\n    background-size: cover !important;\n  }\n}\n.headerstylings .rightsideinfodetail {\n  width: 50%;\n  background-color: #fff;\n  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);\n  height: 100%;\n  min-height: 655px;\n  height: 100vh;\n  text-align: center;\n}\n.headerstylings .rightsideinfodetail .langbtn {\n  justify-content: end;\n}\n.headerstylings .rightsideinfodetail .langbtn button {\n  background: none;\n  border: none;\n  color: #4AA2AD;\n  cursor: pointer;\n}\n.headerstylings .rightsideinfodetail .login_footer .adminfooter.footerspace #res_pr-0 .img_hig-mar {\n  width: 140px !important;\n}\n.headerstylings .rightsideinfodetail .footer-height {\n  height: calc(100vh - 60px);\n}\n@media (max-width: 768px) {\n  .completebanner {\n    min-height: 320px !important;\n  }\n\n  .completebanner .regcontentbanner {\n    max-width: 100% !important;\n    display: block !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .leftregcontrent {\n    width: 100% !important;\n    padding-left: 60px;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner {\n    position: relative;\n    height: 100%;\n    max-width: 95% !important;\n  }\n\n  .completebanner .leftsiddebanner {\n    width: 30%;\n    background: #fff;\n  }\n\n  .completebanner .rightsidebanner {\n    width: 70%;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .helplinect {\n    padding-right: 15px;\n  }\n\n  .bottominfo {\n    margin-left: auto;\n    flex-direction: row-reverse;\n    max-width: 95%;\n    margin-top: -30px;\n    margin-right: auto;\n    padding-bottom: 30px;\n  }\n\n  .position {\n    position: relative;\n    display: flex;\n    padding-top: 0px;\n    flex-flow: row wrap;\n  }\n\n  .completebanner .regcontentbanner .rightregcontent {\n    display: flex;\n    justify-content: flex-end;\n    margin-top: 15px;\n  }\n\n  .headerstylings .leftisideinfodetail {\n    display: none;\n  }\n  .headerstylings .rightsideinfodetail {\n    width: 100%;\n  }\n}\n@media (max-width: 1024px) and (min-width: 769px) {\n  .headerstylings .leftisideinfodetail {\n    display: none;\n  }\n  .headerstylings .rightsideinfodetail {\n    width: 100%;\n  }\n\n  .completebanner {\n    min-height: 290px !important;\n  }\n\n  .bottominfo {\n    margin-left: auto;\n    display: flex;\n    max-width: 95%;\n    margin-top: -30px;\n    margin-right: auto;\n    padding-bottom: 30px;\n  }\n\n  .completebanner .leftsiddebanner {\n    width: 30%;\n    background: #fff;\n  }\n\n  .completebanner .rightsidebanner {\n    width: 70%;\n  }\n\n  .position {\n    position: relative;\n    display: flex;\n    padding-top: 0px;\n    flex-flow: row wrap;\n  }\n\n  .completebanner .regcontentbanner .rightregcontent {\n    display: flex;\n    justify-content: flex-end;\n  }\n\n  .completebanner .regcontentbanner {\n    max-width: 100% !important;\n    display: block !important;\n  }\n}\n@media (max-width: 767px) {\n  .textalignend {\n    padding-top: 20px !important;\n  }\n\n  .header {\n    font-size: 26px !important;\n  }\n\n  .makeitright {\n    margin-left: 0px !important;\n  }\n\n  .circleimage {\n    padding-top: 4px;\n  }\n  .circleimage img {\n    max-width: 72% !important;\n  }\n\n  .bottominfo {\n    margin-left: auto;\n    display: block !important;\n    max-width: 95%;\n    margin-top: -30px;\n    margin-right: auto;\n    padding-bottom: 30px;\n  }\n\n  .leftisideinfo {\n    width: auto !important;\n    margin-right: 0px !important;\n  }\n\n  .rightsideinfo {\n    width: 304px !important;\n    margin-left: 0px !important;\n    margin-top: 10px;\n  }\n\n  .completebanner {\n    justify-content: center;\n    min-height: 175px;\n  }\n\n  .completebanner .leftsiddebanner {\n    width: 100%;\n    background: #fff;\n    min-height: 170px !important;\n  }\n\n  .completebanner .leftsiddebanner .logoandgoback {\n    width: 100%;\n    height: 60%;\n    display: block !important;\n    align-items: center;\n    justify-content: center;\n  }\n\n  .rightsidebanner {\n    width: 100% !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner {\n    position: relative;\n    height: 100%;\n    max-width: 100% !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .leftregcontrent {\n    width: 100% !important;\n    padding-left: 60px;\n  }\n\n  .completebanner .regcontentbanner {\n    display: block !important;\n    max-width: 100% !important;\n    justify-content: space-between;\n    padding-top: 0px !important;\n  }\n\n  .makeitright {\n    text-align: center;\n  }\n\n  .completebanner .leftsiddebanner .logoandgoback .backtohome {\n    display: flex;\n    align-items: center;\n    justify-content: center;\n  }\n\n  .completebanner .regcontentbanner .rightregcontent {\n    text-align: center;\n    margin-bottom: 112px;\n    margin-right: 22px;\n  }\n\n  .submitprofile {\n    margin-bottom: 0px !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .helplinect {\n    padding-right: 15px;\n  }\n}\n.leftregcontrent span {\n  color: #424549;\n}\n.circleimage img {\n  color: #424549;\n}\n.textalignend {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n.textalignend img {\n  width: 30px;\n  height: 20px;\n}\n@media (max-width: 1400px) {\n  .completebanner .rightsidebanner .innerrightbanner {\n    position: relative;\n    height: 100%;\n    max-width: 98% !important;\n  }\n\n  .position {\n    display: flex;\n    padding-top: 0px;\n    padding-left: 92px !important;\n  }\n  .position span {\n    padding-right: 32px !important;\n  }\n}\n.menulistitems {\n  display: flex;\n  margin: 0;\n  padding: 0;\n}\n.menulistitems .mat-list-item {\n  margin-right: 15px;\n}\n.menulistitems .mat-list-item a {\n  color: #333;\n  font-size: 0.9375rem;\n}\n.menulistitems .forsearchitem a {\n  width: 30px;\n  height: 30px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  border: 1px solid #555;\n  border-radius: 50%;\n  padding: 7px;\n}\n.menulistitems .forsearchitem a i {\n  color: #555;\n  color: #555;\n  font-size: 0.9375rem;\n}\n#thankyoulistview {\n  text-align: center;\n}\n#thankyoulistview .successtick {\n  padding-bottom: 30px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n#thankyoulistview .successtick span {\n  height: 64px;\n  width: 64px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  border-radius: 100%;\n  background: #27a91d;\n  color: #fff;\n}\n#thankyoulistview .successtick span i {\n  font-size: 1.875rem;\n}\n#thankyoulistview .cancellogo i {\n  font-size: 1.875rem;\n  color: red;\n}\n#thankyoulistview .jsrscontactcolor {\n  padding-bottom: 20px;\n}\n#thankyoulistview .jsrscontactcolor h2 {\n  font-size: 1.125rem;\n  margin: 0px;\n  color: #27a91d;\n}\n#thankyoulistview .redcolor h2 {\n  font-size: 1.125rem;\n  margin: 0px;\n  color: red !important;\n}\n#thankyoulistview .transfertextcolor p {\n  color: #333333;\n  font-size: 1rem;\n  margin: 0px;\n}\n#thankyoulistview .transfertextcolor p span {\n  font-family: \"cairosemibold\";\n}\n#thankyoulistview .loginbtn {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-top: 30px;\n}\n#thankyoulistview .loginbtn button {\n  width: 160px;\n  color: #fff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n.thankyouinnerpart {\n  border-radius: 10px;\n  background-color: #fff;\n  box-shadow: 0 0 50px rgba(0, 0, 0, 0.15);\n  max-width: 80%;\n  margin: 0 auto;\n  padding: 65px 35px;\n}\n#cancelledreglist .registercancellist {\n  border-radius: 10px;\n  background-color: #fff;\n  box-shadow: 0 0 50px rgba(0, 0, 0, 0.15);\n  max-width: 80%;\n  margin: 0 auto;\n  padding-bottom: 10px;\n  margin-bottom: 4px;\n}\n#cancelledreglist .registercancellist .widthfiled {\n  width: 80%;\n}\n#cancelledreglist .registercancellist .willingcolor p {\n  color: #333333;\n  margin: 0px;\n}\n#cancelledreglist .registercancellist .textheadingreg {\n  padding: 30px;\n}\n#cancelledreglist .registercancellist .textheadingreg h2 {\n  color: #006db8;\n}\n#cancelledreglist .registercancellist .textheadingreg p {\n  color: #333333;\n}\n#cancelledreglist .registercancellist .subscribetext {\n  padding: 30px;\n  background: #fbfcfd;\n}\n#cancelledreglist .registercancellist .subscribetext p {\n  color: #333333;\n}\n#cancelledreglist .registercancellist .btnalignsub {\n  display: flex;\n  margin-top: 20px;\n}\n#cancelledreglist .registercancellist .btnalignsub .submitbtn, #cancelledreglist .registercancellist .btnalignsub .btncancel {\n  background: #006db8;\n  color: #fff;\n  min-width: 140px;\n  height: 45px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  font-size: 1rem;\n}\n#cancelledreglist .registercancellist .btnalignsub .btncancel {\n  background: #ebebeb !important;\n  color: #333333 !important;\n}\n#cancelledreglist .registercancellist .submitdisable {\n  background: #ececec !important;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n}\n:host::ng-deep.specifyradiogroup {\n  display: flex;\n  flex-direction: column;\n}\n:host::ng-deep.specifyradiogroup .mat-radio-label-content {\n  color: #333333;\n  padding-left: 10px;\n  font-size: 0.9375rem;\n}\n:host::ng-deep.specifyradiogroup .mat-radio-button {\n  padding-bottom: 6px;\n}\n.makeittopminus {\n  margin-top: -158px;\n  min-height: calc(100vh - 232px);\n}\n#expiredlistview {\n  text-align: center;\n  border-radius: 10px;\n  background-clip: padding-box;\n  background-color: #fff;\n  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 80% !important;\n  height: 100%;\n  padding-top: 90px;\n  min-height: 420px;\n  text-align: center;\n  margin-top: -135px;\n}\n#expiredlistview .transfertextcolor p {\n  color: #333333;\n  font-size: 1rem;\n  margin: 0px;\n}\n#expiredlistview .jsrscontactcolor h2 {\n  color: #d91f24;\n  margin: 0px;\n  font-size: 1.125rem;\n  padding-top: 15px;\n  padding-bottom: 10px;\n}\n#expiredlistview .loginbtn {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-top: 30px;\n}\n#expiredlistview .loginbtn button {\n  background: #006db8;\n  width: 100px;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n#sessionlistview {\n  text-align: center;\n  border-radius: 10px;\n  background-clip: padding-box;\n  background-color: #fff;\n  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 50% !important;\n  height: 420px;\n  padding-top: 90px;\n  text-align: center;\n  margin-top: -100px;\n  padding-left: 30px;\n  padding-right: 30px;\n}\n#sessionlistview .transfertextcolor p {\n  color: #333333;\n  font-size: 1rem;\n  margin: 0px;\n}\n#sessionlistview .jsrscontactcolor h2 {\n  color: #d91f24;\n  margin: 0px;\n  font-size: 1.125rem;\n  padding-top: 15px;\n  padding-bottom: 10px;\n}\n#sessionlistview .loginbtn {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-top: 30px;\n}\n#sessionlistview .loginbtn button {\n  background: #006db8;\n  width: 100px;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n#sessionexpired {\n  height: calc(100vh - 370px);\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy90aGFua3lvdS9hcHByb3ZlY2hhbmdlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXHRoYW5reW91XFxhcHByb3ZlY2hhbmdlXFxhcHByb3ZlY2hhbmdlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3RoYW5reW91L2FwcHJvdmVjaGFuZ2UvYXBwcm92ZWNoYW5nZS5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtFQUNJLDhCQUFBO0VBQ0Esa0JBQUE7RUFDQSxhQUFBO0VBQ0EsYUFBQTtBQ0NKO0FEQ0k7RUFDSSxrQkFBQTtBQ0NSO0FEQ1E7RUFDSSxZQUFBO0VBQ0EsYUFBQTtFQUNBLGlCQUFBO0FDQ1o7QURFUTtFQUNJLGNBQUE7QUNBWjtBRElJO0VBQ0ksZ0JBQUE7RUFDQSxxQkFBQTtFQUNBLG9CQUFBO0FDRlI7QURJUTtFQUNJLGFBQUE7RUFDQSw4QkFBQTtFQUNBLHVCQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLHlCQUFBO0VBQ0EsbUJBQUE7QUNGWjtBREtRO0VBQ0ksc0JBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSwwQkFBQTtBQ0haO0FET1k7RUFDSSxzQkFBQTtFQUNBLDBCQUFBO0FDTGhCO0FEU1E7RUFDSSxhQUFBO0VBQ0EscUJBQUE7RUFDQSxpQkFBQTtBQ1BaO0FEU1k7RUFDSSxXQUFBO0VBQ0EsbUJBQUE7QUNQaEI7QURVWTtFQUNJLFlBQUE7QUNSaEI7QURjUTtFQUNJLG1CQUFBO0FDWlo7QURpQlE7RUFDSSxjQUFBO0FDZlo7QURtQkk7RUFDSSxhQUFBO0VBQ0EsdUJBQUE7RUFDQSxpQkFBQTtFQUNBLHlCQUFBO0FDakJSO0FEbUJRO0VBQ0ksY0FBQTtBQ2pCWjtBRG9CUTtFQUNJLGFBQUE7RUFDQSxlQUFBO0VBQ0EsOEJBQUE7QUNsQlo7QURvQlk7RUFDSSxr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Q0EsV0FBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7RUFDQSxvQkFBQTtBQ3pLWjtBRDZLSTtFQTdSQSxhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtFQTZSSSxnQkFBQTtBQ3pLUjtBRDJLUTtFQUNJLG1CQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSw2QkFBQTtFQXJTUixhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtBQzZISjtBRDZLQTtFQUNJLDJCQUFBO0FDMUtKIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy90aGFua3lvdS9hcHByb3ZlY2hhbmdlL2FwcHJvdmVjaGFuZ2UuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIuaGVhZGVyc3R5bGluZ3Mge1xyXG4gICAgYmFja2dyb3VuZDogI2YyZjNmNyAhaW1wb3J0YW50O1xyXG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgaGVpZ2h0OiAxMDB2aDtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcblxyXG4gICAgLmhlYWRlcmltYWdlIHtcclxuICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcblxyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxNTBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiAxNTBweDtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogMTAwcHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBoNCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAucmVnZm9vdGVyIHtcclxuICAgICAgICBtaW4taGVpZ2h0OiA5NXB4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBmbGV4LWVuZDtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMjBweDtcclxuXHJcbiAgICAgICAgLmxvZ2luX2Zvb3RlciB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgICAgICAgIG1heC13aWR0aDogOTQlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubG9naW5fZm9vdGVyIC5sb2dpbl9mb290ZXJfbGVmdCB1bCBsaSBhIHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzMgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubG9naW5fZm9vdGVyX3JpZ2h0IHtcclxuICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5kcml2ZW5hbGlnbiB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBmbGV4LWVuZDtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogLTQwcHg7XHJcblxyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgaW1nIHtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAudGFibGJlbGljb24ge1xyXG4gICAgICAgIGkge1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDMuMTI1cmVtO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAudG9waGVhZGVyaW1hZ2Uge1xyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIG1heC13aWR0aDogODIlO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuY29tcGxldGViYW5uZXIge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgbWluLWhlaWdodDogMjc1cHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2UwZjBmZjtcclxuXHJcbiAgICAgICAgLmJhY2t0b2hvbWUge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5yZWdjb250ZW50YmFubmVyIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcblxyXG4gICAgICAgICAgICAucmlnaHRyZWdjb250ZW50IHtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmxlZnRzaWRkZWJhbm5lciB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAyMCU7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcblxyXG4gICAgICAgICAgICAud2VsY29tZWx5YmlhIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctdG9wOiA1cHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5sb2dvYW5kZ29iYWNrIHtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMTglO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgICAgICAgICAuYmFja3RvaG9tZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgICAgICAgICAgdG9wOiAzMnB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiA2cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC42MjVyZW07XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAucmlnaHRzaWRlYmFubmVyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDgwJTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1yZXBlYXQ6IG5vLXJlcGVhdDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1pbWFnZTogdXJsKFwifi9hc3NldHMvaW1hZ2VzL2dsb2JlbmV3LnBuZ1wiKTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbjogcmlnaHQgMHB4IHRvcCAxMjBweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1zaXplOiBjb250YWluO1xyXG5cclxuICAgICAgICAgICAgLmlubmVycmlnaHRiYW5uZXIge1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgbWF4LXdpZHRoOiA5NiU7XHJcblxyXG4gICAgICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLmhlbHBsaW5lY3Qge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjNjY2O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLmxlZnRyZWdjb250cmVudCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLmhlYWRlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZjFmMmY3O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDEuNjI1cmVtO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5zdWJtaXRwcm9maWxlIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4ZWJhZTY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAucmlnaHRyZWdjb250ZW50IHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5sb2dpbmJ1dHRvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2VmODQzNjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDg1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5yZWdpc3RlcmJ0biB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDZkYjc7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogOThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5mbGFnbHlwaXMge1xyXG4gICAgICAgICAgICAgICAgbGVmdDogMDtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgIHRvcDogMDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAvLyAudG9waGVhZGVyaW1hZ2Uge1xyXG4gICAgLy8gICAgIG1pbi1oZWlnaHQ6IDE3NXB4O1xyXG4gICAgLy8gfVxyXG5cclxuICAgIC5uZXdjYXJkcmlnaHQge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuXHJcbiAgICAgICAgLmV4cGxvcmVyIHtcclxuICAgICAgICAgICAgY29sb3I6ICMwMDZkYjc7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMS4xMjVyZW07XHJcbiAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIHBhZGRpbmctdG9wOiAyNXB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMjVweDtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA5MHB4O1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAucG9zaXRpb24ge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDBweDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDEwMHB4O1xyXG5cclxuICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogNDRweDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5jaXJjbGVpbWFnZSB7XHJcbiAgICAgICAgaW1nIHtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogLTZweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmxlZnRpc2lkZWluZm9kZXRhaWwge1xyXG4gICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcblxyXG4gICAgICAgIHdpZHRoOiA1MCU7XHJcblxyXG4gICAgICAgIHotaW5kZXg6IDA7XHJcbiAgICAgICAgaGVpZ2h0OiAxMDAlO1xyXG5cclxuXHJcbiAgICAgICAgLmxvZ2luYmcge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiB1cmwoJ34vYXNzZXRzL2ltYWdlcy9iZy5wbmcnKSB0b3AgbGVmdCBuby1yZXBlYXQ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtc2l6ZTogY292ZXI7XHJcbiAgICAgICAgICAgIGhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgIG9iamVjdC1maXQ6IGNvdmVyO1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogMDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbjogY2VudGVyO1xyXG5cclxuICAgICAgICAgICAgQG1lZGlhIChtaW4td2lkdGg6MTkyMHB4KSB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiB1cmwoJ34vYXNzZXRzL2ltYWdlcy9iZy5wbmcnKSB0b3AgbGVmdCBuby1yZXBlYXQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLXNpemU6IGNvdmVyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5yaWdodHNpZGVpbmZvZGV0YWlsIHtcclxuICAgICAgICB3aWR0aDogNTAlO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMCAwIDEwcHggcmdiKDAgMCAwIC8gMTUlKTtcclxuICAgICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgICAgbWluLWhlaWdodDogNjU1cHg7XHJcbiAgICAgICAgaGVpZ2h0OiAxMDB2aDtcclxuXHJcbiAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG5cclxuICAgICAgICAvLyBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIC8vIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIC8vIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgLmxhbmdidG4ge1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGVuZDtcclxuXHJcbiAgICAgICAgICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiBub25lO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM0QUEyQUQ7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5sb2dpbl9mb290ZXIge1xyXG4gICAgICAgICAgICAuYWRtaW5mb290ZXIuZm9vdGVyc3BhY2Uge1xyXG4gICAgICAgICAgICAgICAgI3Jlc19wci0wIHtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLmltZ19oaWctbWFyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDE0MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZm9vdGVyLWhlaWdodCB7XHJcbiAgICAgICAgICAgIGhlaWdodDogY2FsYygxMDB2aCAtIDYwcHgpO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcblxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAgIC5jb21wbGV0ZWJhbm5lciB7XHJcbiAgICAgICAgbWluLWhlaWdodDogMzIwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIge1xyXG4gICAgICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIgLmxlZnRyZWdjb250cmVudCB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDYwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5NSUgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciB7XHJcbiAgICAgICAgd2lkdGg6IDMwJTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIHtcclxuICAgICAgICB3aWR0aDogNzAlO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5oZWxwbGluZWN0IHtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5ib3R0b21pbmZvIHtcclxuICAgICAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93LXJldmVyc2U7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5NSU7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogLTMwcHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5wb3NpdGlvbiB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDBweDtcclxuICAgICAgICBmbGV4LWZsb3c6IHJvdyB3cmFwO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMTVweDtcclxuICAgIH1cclxuXHJcbiAgICAuaGVhZGVyc3R5bGluZ3Mge1xyXG4gICAgICAgIC5sZWZ0aXNpZGVpbmZvZGV0YWlsIHtcclxuICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5yaWdodHNpZGVpbmZvZGV0YWlsIHtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDEwMjRweCkgYW5kIChtaW4td2lkdGg6IDc2OXB4KSB7XHJcbiAgICAuaGVhZGVyc3R5bGluZ3Mge1xyXG4gICAgICAgIC5sZWZ0aXNpZGVpbmZvZGV0YWlsIHtcclxuICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5yaWdodHNpZGVpbmZvZGV0YWlsIHtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciB7XHJcbiAgICAgICAgbWluLWhlaWdodDogMjkwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuYm90dG9taW5mbyB7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IGF1dG87XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBtYXgtd2lkdGg6IDk1JTtcclxuICAgICAgICBtYXJnaW4tdG9wOiAtMzBweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDMwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5sZWZ0c2lkZGViYW5uZXIge1xyXG4gICAgICAgIHdpZHRoOiAzMCU7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgIH1cclxuXHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciB7XHJcbiAgICAgICAgd2lkdGg6IDcwJTtcclxuICAgIH1cclxuXHJcbiAgICAucG9zaXRpb24ge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiAwcHg7XHJcbiAgICAgICAgZmxleC1mbG93OiByb3cgd3JhcDtcclxuICAgIH1cclxuXHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIgLnJpZ2h0cmVnY29udGVudCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciB7XHJcbiAgICAgICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XHJcbiAgICAudGV4dGFsaWduZW5kIHtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMjBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5oZWFkZXIge1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMjZweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYWtlaXRyaWdodCB7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5jaXJjbGVpbWFnZSB7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDRweDtcclxuXHJcbiAgICAgICAgaW1nIHtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA3MiUgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmJvdHRvbWluZm8ge1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5NSU7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogLTMwcHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5sZWZ0aXNpZGVpbmZvIHtcclxuICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnJpZ2h0c2lkZWluZm8ge1xyXG4gICAgICAgIHdpZHRoOiAzMDRweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICBtYXJnaW4tdG9wOiAxMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciB7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgbWluLWhlaWdodDogMTc1cHg7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgICAgIG1pbi1oZWlnaHQ6IDE3MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5sZWZ0c2lkZGViYW5uZXIgLmxvZ29hbmRnb2JhY2sge1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIGhlaWdodDogNjAlO1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAucmlnaHRzaWRlYmFubmVyIHtcclxuICAgICAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5sZWZ0cmVnY29udHJlbnQge1xyXG4gICAgICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiA2MHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYWtlaXRyaWdodCB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIC5sb2dvYW5kZ29iYWNrIC5iYWNrdG9ob21lIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5yZWdjb250ZW50YmFubmVyIC5yaWdodHJlZ2NvbnRlbnQge1xyXG4gICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOiAxMTJweDtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDIycHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnN1Ym1pdHByb2ZpbGUge1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5oZWxwbGluZWN0IHtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgfVxyXG59XHJcblxyXG4ubGVmdHJlZ2NvbnRyZW50IHtcclxuICAgIHNwYW4ge1xyXG4gICAgICAgIGNvbG9yOiAjNDI0NTQ5O1xyXG4gICAgfVxyXG59XHJcblxyXG4uY2lyY2xlaW1hZ2Uge1xyXG4gICAgaW1nIHtcclxuICAgICAgICBjb2xvcjogIzQyNDU0OTtcclxuICAgIH1cclxufVxyXG5cclxuLnRleHRhbGlnbmVuZCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcblxyXG4gICAgaW1nIHtcclxuICAgICAgICB3aWR0aDogMzBweDtcclxuICAgICAgICBoZWlnaHQ6IDIwcHg7XHJcbiAgICB9XHJcbn1cclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOiAxNDAwcHgpIHtcclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgICAgIG1heC13aWR0aDogOTglICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBvc2l0aW9uIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiAwcHg7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiA5MnB4ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAzMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG4ubWVudWxpc3RpdGVtcyB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgbWFyZ2luOiAwO1xyXG4gICAgcGFkZGluZzogMDtcclxuXHJcbiAgICAubWF0LWxpc3QtaXRlbSB7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xyXG5cclxuICAgICAgICBhIHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZm9yc2VhcmNoaXRlbSB7XHJcbiAgICAgICAgYSB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAzMHB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDMwcHg7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjNTU1O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiA1MCU7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDdweDtcclxuXHJcbiAgICAgICAgICAgIGkge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM1NTU7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzU1NTtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5AbWl4aW4gZmxleGNlbnRlciB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbkBtaXhpbiBmbGV4c3RhcnQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIGZsZXhlbmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbkBtaXhpbiBzcGFjZWJldHdlZW4ge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbn1cclxuXHJcbkBtaXhpbiBtYXJnaW56ZXJvIHtcclxuICAgIG1hcmdpbjogMDtcclxuICAgIHdoaXRlLXNwYWNlOiBub3JtYWwgIWltcG9ydGFudDtcclxuICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbn1cclxuXHJcbiN0aGFua3lvdWxpc3R2aWV3IHtcclxuICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuXHJcbiAgICAuc3VjY2Vzc3RpY2sge1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xyXG4gICAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuXHJcbiAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgIGhlaWdodDogNjRweDtcclxuICAgICAgICAgICAgd2lkdGg6IDY0cHg7XHJcbiAgICAgICAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMTAwJTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogIzI3YTkxZDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcblxyXG4gICAgICAgICAgICBpIHtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMS44NzVyZW07XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNhbmNlbGxvZ28ge1xyXG4gICAgICAgIGkge1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDEuODc1cmVtO1xyXG4gICAgICAgICAgICBjb2xvcjogcmVkO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuanNyc2NvbnRhY3Rjb2xvciB7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDIwcHg7XHJcblxyXG4gICAgICAgIGgyIHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxLjEyNXJlbTtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjdhOTFkO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICB9XHJcblxyXG4gICAgLnJlZGNvbG9yIHtcclxuICAgICAgICBoMiB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMS4xMjVyZW07XHJcbiAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICBjb2xvcjogcmVkICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC50cmFuc2ZlcnRleHRjb2xvciB7XHJcbiAgICAgICAgcCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDFyZW07XHJcbiAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG5cclxuICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5sb2dpbmJ0biB7XHJcbiAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcblxyXG4gICAgICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxNjBweDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuXHJcbi50aGFua3lvdWlubmVycGFydCB7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgIGJveC1zaGFkb3c6IDAgMCA1MHB4IHJnYmEoMCwgMCwgMCwgMC4xNSk7XHJcbiAgICBtYXgtd2lkdGg6IDgwJTtcclxuICAgIG1hcmdpbjogMCBhdXRvO1xyXG4gICAgcGFkZGluZzogNjVweCAzNXB4O1xyXG59XHJcblxyXG4jY2FuY2VsbGVkcmVnbGlzdCB7XHJcbiAgICAucmVnaXN0ZXJjYW5jZWxsaXN0IHtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMCAwIDUwcHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcclxuICAgICAgICBtYXgtd2lkdGg6IDgwJTtcclxuICAgICAgICBtYXJnaW46IDAgYXV0bztcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOiA0cHg7XHJcblxyXG4gICAgICAgIC53aWR0aGZpbGVkIHtcclxuICAgICAgICAgICAgd2lkdGg6IDgwJTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC53aWxsaW5nY29sb3Ige1xyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC50ZXh0aGVhZGluZ3JlZyB7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDMwcHg7XHJcblxyXG4gICAgICAgICAgICBoMiB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzAwNmRiODtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnN1YnNjcmliZXRleHQge1xyXG4gICAgICAgICAgICBwYWRkaW5nOiAzMHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmJmY2ZkO1xyXG5cclxuICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmJ0bmFsaWduc3ViIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogMjBweDtcclxuXHJcbiAgICAgICAgICAgIC5zdWJtaXRidG4ge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogIzAwNmRiODtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiAxNDBweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICAgICAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMXJlbTtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLmJ0bmNhbmNlbCB7XHJcbiAgICAgICAgICAgICAgICBAZXh0ZW5kIC5zdWJtaXRidG47XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZWJlYmViICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuc3VibWl0ZGlzYWJsZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNlY2VjZWMgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2VjZWNlYyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgfVxyXG59XHJcblxyXG46aG9zdDo6bmctZGVlcC5zcGVjaWZ5cmFkaW9ncm91cCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcclxuXHJcbiAgICAubWF0LXJhZGlvLWxhYmVsLWNvbnRlbnQge1xyXG4gICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMTBweDtcclxuICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LXJhZGlvLWJ1dHRvbiB7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDZweDtcclxuICAgIH1cclxufVxyXG5cclxuLm1ha2VpdHRvcG1pbnVzIHtcclxuICAgIG1hcmdpbi10b3A6IC0xNThweDtcclxuICAgIG1pbi1oZWlnaHQ6IGNhbGMoMTAwdmggLSAyMzJweCk7XHJcbn1cclxuXHJcblxyXG5cclxuI2V4cGlyZWRsaXN0dmlldyB7XHJcbiAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICBib3gtc2hhZG93OiAwIDAgMTBweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xyXG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XHJcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICBtYXgtd2lkdGg6IDgwJSAhaW1wb3J0YW50O1xyXG4gICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgcGFkZGluZy10b3A6IDkwcHg7XHJcbiAgICBtaW4taGVpZ2h0OiA0MjBweDtcclxuICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgIG1hcmdpbi10b3A6IC0xMzVweDtcclxuXHJcbiAgICAudHJhbnNmZXJ0ZXh0Y29sb3Ige1xyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxcmVtO1xyXG4gICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmpzcnNjb250YWN0Y29sb3Ige1xyXG4gICAgICAgIGgyIHtcclxuICAgICAgICAgICAgY29sb3I6ICNkOTFmMjQ7XHJcbiAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgICBwYWRkaW5nLXRvcDogMTVweDtcclxuICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5sb2dpbmJ0biB7XHJcbiAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcblxyXG4gICAgICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICMwMDZkYjg7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxMDBweDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5cclxuI3Nlc3Npb25saXN0dmlldyB7XHJcbiAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICBib3gtc2hhZG93OiAwIDAgMTBweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xyXG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XHJcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICBtYXgtd2lkdGg6IDUwJSAhaW1wb3J0YW50O1xyXG4gICAgaGVpZ2h0OiA0MjBweDtcclxuICAgIHBhZGRpbmctdG9wOiA5MHB4O1xyXG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgbWFyZ2luLXRvcDogLTEwMHB4O1xyXG4gICAgcGFkZGluZy1sZWZ0OiAzMHB4O1xyXG4gICAgcGFkZGluZy1yaWdodDogMzBweDtcclxuXHJcbiAgICAudHJhbnNmZXJ0ZXh0Y29sb3Ige1xyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxcmVtO1xyXG4gICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmpzcnNjb250YWN0Y29sb3Ige1xyXG4gICAgICAgIGgyIHtcclxuICAgICAgICAgICAgY29sb3I6ICNkOTFmMjQ7XHJcbiAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgICBwYWRkaW5nLXRvcDogMTVweDtcclxuICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5sb2dpbmJ0biB7XHJcbiAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcblxyXG4gICAgICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICMwMDZkYjg7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxMDBweDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbn1cclxuXHJcbiNzZXNzaW9uZXhwaXJlZCB7XHJcbiAgICBoZWlnaHQ6IGNhbGMoMTAwdmggLSAzNzBweCk7XHJcbn0iLCIuaGVhZGVyc3R5bGluZ3Mge1xuICBiYWNrZ3JvdW5kOiAjZjJmM2Y3ICFpbXBvcnRhbnQ7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgaGVpZ2h0OiAxMDB2aDtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuaGVhZGVyaW1hZ2Uge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmhlYWRlcmltYWdlIGltZyB7XG4gIHdpZHRoOiAxNTBweDtcbiAgaGVpZ2h0OiAxNTBweDtcbiAgbWFyZ2luLXRvcDogMTAwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmhlYWRlcmltYWdlIGg0IHtcbiAgY29sb3I6ICMzMzMzMzM7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnJlZ2Zvb3RlciB7XG4gIG1pbi1oZWlnaHQ6IDk1cHg7XG4gIGFsaWduLWl0ZW1zOiBmbGV4LWVuZDtcbiAgcGFkZGluZy1ib3R0b206IDIwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnJlZ2Zvb3RlciAubG9naW5fZm9vdGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcbiAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gIG1hcmdpbi1yaWdodDogYXV0bztcbiAgbWF4LXdpZHRoOiA5NCUgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmVnZm9vdGVyIC5sb2dpbl9mb290ZXIgLmxvZ2luX2Zvb3Rlcl9sZWZ0IHVsIGxpIGEge1xuICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBmb250LXNpemU6IDE1cHggIWltcG9ydGFudDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmVnZm9vdGVyIC5sb2dpbl9mb290ZXJfcmlnaHQgc3BhbiB7XG4gIGNvbG9yOiAjMzMzICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xufVxuLmhlYWRlcnN0eWxpbmdzIC5yZWdmb290ZXIgLmRyaXZlbmFsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGZsZXgtZW5kO1xuICBtYXJnaW4tdG9wOiAtNDBweDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmVnZm9vdGVyIC5kcml2ZW5hbGlnbiBwIHtcbiAgY29sb3I6ICMzMzM7XG4gIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnJlZ2Zvb3RlciAuZHJpdmVuYWxpZ24gaW1nIHtcbiAgaGVpZ2h0OiA0MHB4O1xufVxuLmhlYWRlcnN0eWxpbmdzIC50YWJsYmVsaWNvbiBpIHtcbiAgZm9udC1zaXplOiAzLjEyNXJlbTtcbn1cbi5oZWFkZXJzdHlsaW5ncyAudG9waGVhZGVyaW1hZ2UgaW1nIHtcbiAgbWF4LXdpZHRoOiA4MiU7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIG1pbi1oZWlnaHQ6IDI3NXB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZTBmMGZmO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAuYmFja3RvaG9tZSB7XG4gIGRpc3BsYXk6IGJsb2NrO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIG1heC13aWR0aDogMTAwJTtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIHtcbiAgd2lkdGg6IDIwJTtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciAud2VsY29tZWx5YmlhIHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgcGFkZGluZy10b3A6IDVweDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciAubG9nb2FuZGdvYmFjayB7XG4gIGhlaWdodDogMTglO1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciAubG9nb2FuZGdvYmFjayAuYmFja3RvaG9tZSB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRvcDogMzJweDtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIC5sb2dvYW5kZ29iYWNrIC5iYWNrdG9ob21lIGkge1xuICBwYWRkaW5nLXJpZ2h0OiA2cHg7XG4gIGZvbnQtc2l6ZTogMC42MjVyZW07XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIge1xuICB3aWR0aDogODAlO1xuICBiYWNrZ3JvdW5kLXJlcGVhdDogbm8tcmVwZWF0O1xuICBiYWNrZ3JvdW5kLWltYWdlOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvZ2xvYmVuZXcucG5nXCIpO1xuICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiByaWdodCAwcHggdG9wIDEyMHB4O1xuICBiYWNrZ3JvdW5kLXNpemU6IGNvbnRhaW47XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIG1heC13aWR0aDogOTYlO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIHAge1xuICBjb2xvcjogI2ZmZjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAuaGVscGxpbmVjdCB7XG4gIGNvbG9yOiAjNjY2O1xuICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5sZWZ0cmVnY29udHJlbnQge1xuICB3aWR0aDogMTAwJTtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAubGVmdHJlZ2NvbnRyZW50IC5oZWFkZXIge1xuICBjb2xvcjogI2YxZjJmNztcbiAgZm9udC1zaXplOiAxLjYyNXJlbTtcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XG4gIG1hcmdpbi1ib3R0b206IDEwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIgLmxlZnRyZWdjb250cmVudCAuc3VibWl0cHJvZmlsZSB7XG4gIGNvbG9yOiAjOGViYWU2O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAucmlnaHRyZWdjb250ZW50IC5sb2dpbmJ1dHRvbiB7XG4gIGNvbG9yOiAjZmZmO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgYmFja2dyb3VuZDogI2VmODQzNjtcbiAgd2lkdGg6IDg1cHg7XG4gIGhlaWdodDogMzBweDtcbiAgYm9yZGVyLXJhZGl1czogNTBweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAucmlnaHRyZWdjb250ZW50IC5yZWdpc3RlcmJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZkYjc7XG4gIGNvbG9yOiAjZmZmO1xuICB3aWR0aDogOThweDtcbiAgaGVpZ2h0OiAzMHB4O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgYm9yZGVyLXJhZGl1czogNTBweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuZmxhZ2x5cGlzIHtcbiAgbGVmdDogMDtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDA7XG59XG4uaGVhZGVyc3R5bGluZ3MgLm5ld2NhcmRyaWdodCB7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAubmV3Y2FyZHJpZ2h0IC5leHBsb3JlciB7XG4gIGNvbG9yOiAjMDA2ZGI3O1xuICBmb250LXNpemU6IDEuMTI1cmVtO1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgcGFkZGluZy1ib3R0b206IDEwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLm5ld2NhcmRyaWdodCBpbWcge1xuICBwYWRkaW5nLXRvcDogMjVweDtcbiAgcGFkZGluZy1ib3R0b206IDI1cHg7XG4gIG1heC13aWR0aDogOTBweDtcbiAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gIG1hcmdpbi1yaWdodDogYXV0bztcbn1cbi5oZWFkZXJzdHlsaW5ncyAucG9zaXRpb24ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBwYWRkaW5nLXRvcDogMHB4O1xuICBwYWRkaW5nLWxlZnQ6IDEwMHB4O1xufVxuLmhlYWRlcnN0eWxpbmdzIC5wb3NpdGlvbiBzcGFuIHtcbiAgcGFkZGluZy1yaWdodDogNDRweDtcbiAgY29sb3I6ICNmZmY7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNpcmNsZWltYWdlIGltZyB7XG4gIG1hcmdpbi10b3A6IC02cHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmxlZnRpc2lkZWluZm9kZXRhaWwge1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICB3aWR0aDogNTAlO1xuICB6LWluZGV4OiAwO1xuICBoZWlnaHQ6IDEwMCU7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmxlZnRpc2lkZWluZm9kZXRhaWwgLmxvZ2luYmcge1xuICBiYWNrZ3JvdW5kOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvYmcucG5nXCIpIHRvcCBsZWZ0IG5vLXJlcGVhdDtcbiAgYmFja2dyb3VuZC1zaXplOiBjb3ZlcjtcbiAgaGVpZ2h0OiAxMDAlICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMDAlO1xuICBvYmplY3QtZml0OiBjb3ZlcjtcbiAgbWFyZ2luLWxlZnQ6IDA7XG4gIGJhY2tncm91bmQtcG9zaXRpb246IGNlbnRlcjtcbn1cbkBtZWRpYSAobWluLXdpZHRoOiAxOTIwcHgpIHtcbiAgLmhlYWRlcnN0eWxpbmdzIC5sZWZ0aXNpZGVpbmZvZGV0YWlsIC5sb2dpbmJnIHtcbiAgICBiYWNrZ3JvdW5kOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvYmcucG5nXCIpIHRvcCBsZWZ0IG5vLXJlcGVhdDtcbiAgICBiYWNrZ3JvdW5kLXNpemU6IGNvdmVyICFpbXBvcnRhbnQ7XG4gIH1cbn1cbi5oZWFkZXJzdHlsaW5ncyAucmlnaHRzaWRlaW5mb2RldGFpbCB7XG4gIHdpZHRoOiA1MCU7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJveC1zaGFkb3c6IDAgMCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4xNSk7XG4gIGhlaWdodDogMTAwJTtcbiAgbWluLWhlaWdodDogNjU1cHg7XG4gIGhlaWdodDogMTAwdmg7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmlnaHRzaWRlaW5mb2RldGFpbCAubGFuZ2J0biB7XG4gIGp1c3RpZnktY29udGVudDogZW5kO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5yaWdodHNpZGVpbmZvZGV0YWlsIC5sYW5nYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6IG5vbmU7XG4gIGJvcmRlcjogbm9uZTtcbiAgY29sb3I6ICM0QUEyQUQ7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmlnaHRzaWRlaW5mb2RldGFpbCAubG9naW5fZm9vdGVyIC5hZG1pbmZvb3Rlci5mb290ZXJzcGFjZSAjcmVzX3ByLTAgLmltZ19oaWctbWFyIHtcbiAgd2lkdGg6IDE0MHB4ICFpbXBvcnRhbnQ7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnJpZ2h0c2lkZWluZm9kZXRhaWwgLmZvb3Rlci1oZWlnaHQge1xuICBoZWlnaHQ6IGNhbGMoMTAwdmggLSA2MHB4KTtcbn1cblxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gIC5jb21wbGV0ZWJhbm5lciB7XG4gICAgbWluLWhlaWdodDogMzIwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciB7XG4gICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5sZWZ0cmVnY29udHJlbnQge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1sZWZ0OiA2MHB4O1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIge1xuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgICBoZWlnaHQ6IDEwMCU7XG4gICAgbWF4LXdpZHRoOiA5NSUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIHtcbiAgICB3aWR0aDogMzAlO1xuICAgIGJhY2tncm91bmQ6ICNmZmY7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciB7XG4gICAgd2lkdGg6IDcwJTtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5oZWxwbGluZWN0IHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xuICB9XG5cbiAgLmJvdHRvbWluZm8ge1xuICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICAgIGZsZXgtZGlyZWN0aW9uOiByb3ctcmV2ZXJzZTtcbiAgICBtYXgtd2lkdGg6IDk1JTtcbiAgICBtYXJnaW4tdG9wOiAtMzBweDtcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gICAgcGFkZGluZy1ib3R0b206IDMwcHg7XG4gIH1cblxuICAucG9zaXRpb24ge1xuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIHBhZGRpbmctdG9wOiAwcHg7XG4gICAgZmxleC1mbG93OiByb3cgd3JhcDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XG4gICAgbWFyZ2luLXRvcDogMTVweDtcbiAgfVxuXG4gIC5oZWFkZXJzdHlsaW5ncyAubGVmdGlzaWRlaW5mb2RldGFpbCB7XG4gICAgZGlzcGxheTogbm9uZTtcbiAgfVxuICAuaGVhZGVyc3R5bGluZ3MgLnJpZ2h0c2lkZWluZm9kZXRhaWwge1xuICAgIHdpZHRoOiAxMDAlO1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTAyNHB4KSBhbmQgKG1pbi13aWR0aDogNzY5cHgpIHtcbiAgLmhlYWRlcnN0eWxpbmdzIC5sZWZ0aXNpZGVpbmZvZGV0YWlsIHtcbiAgICBkaXNwbGF5OiBub25lO1xuICB9XG4gIC5oZWFkZXJzdHlsaW5ncyAucmlnaHRzaWRlaW5mb2RldGFpbCB7XG4gICAgd2lkdGg6IDEwMCU7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIge1xuICAgIG1pbi1oZWlnaHQ6IDI5MHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYm90dG9taW5mbyB7XG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBtYXgtd2lkdGg6IDk1JTtcbiAgICBtYXJnaW4tdG9wOiAtMzBweDtcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gICAgcGFkZGluZy1ib3R0b206IDMwcHg7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciB7XG4gICAgd2lkdGg6IDMwJTtcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIge1xuICAgIHdpZHRoOiA3MCU7XG4gIH1cblxuICAucG9zaXRpb24ge1xuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIHBhZGRpbmctdG9wOiAwcHg7XG4gICAgZmxleC1mbG93OiByb3cgd3JhcDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIge1xuICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xuICAudGV4dGFsaWduZW5kIHtcbiAgICBwYWRkaW5nLXRvcDogMjBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmhlYWRlciB7XG4gICAgZm9udC1zaXplOiAyNnB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWFrZWl0cmlnaHQge1xuICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jaXJjbGVpbWFnZSB7XG4gICAgcGFkZGluZy10b3A6IDRweDtcbiAgfVxuICAuY2lyY2xlaW1hZ2UgaW1nIHtcbiAgICBtYXgtd2lkdGg6IDcyJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmJvdHRvbWluZm8ge1xuICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgbWF4LXdpZHRoOiA5NSU7XG4gICAgbWFyZ2luLXRvcDogLTMwcHg7XG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xuICB9XG5cbiAgLmxlZnRpc2lkZWluZm8ge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5yaWdodHNpZGVpbmZvIHtcbiAgICB3aWR0aDogMzA0cHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXRvcDogMTBweDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciB7XG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gICAgbWluLWhlaWdodDogMTc1cHg7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciB7XG4gICAgd2lkdGg6IDEwMCU7XG4gICAgYmFja2dyb3VuZDogI2ZmZjtcbiAgICBtaW4taGVpZ2h0OiAxNzBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5sZWZ0c2lkZGViYW5uZXIgLmxvZ29hbmRnb2JhY2sge1xuICAgIHdpZHRoOiAxMDAlO1xuICAgIGhlaWdodDogNjAlO1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgfVxuXG4gIC5yaWdodHNpZGViYW5uZXIge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciB7XG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xuICAgIGhlaWdodDogMTAwJTtcbiAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5sZWZ0cmVnY29udHJlbnQge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1sZWZ0OiA2MHB4O1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5yZWdjb250ZW50YmFubmVyIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgICBwYWRkaW5nLXRvcDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWFrZWl0cmlnaHQge1xuICAgIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIC5sb2dvYW5kZ29iYWNrIC5iYWNrdG9ob21lIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIgLnJpZ2h0cmVnY29udGVudCB7XG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xuICAgIG1hcmdpbi1ib3R0b206IDExMnB4O1xuICAgIG1hcmdpbi1yaWdodDogMjJweDtcbiAgfVxuXG4gIC5zdWJtaXRwcm9maWxlIHtcbiAgICBtYXJnaW4tYm90dG9tOiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5oZWxwbGluZWN0IHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xuICB9XG59XG4ubGVmdHJlZ2NvbnRyZW50IHNwYW4ge1xuICBjb2xvcjogIzQyNDU0OTtcbn1cblxuLmNpcmNsZWltYWdlIGltZyB7XG4gIGNvbG9yOiAjNDI0NTQ5O1xufVxuXG4udGV4dGFsaWduZW5kIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi50ZXh0YWxpZ25lbmQgaW1nIHtcbiAgd2lkdGg6IDMwcHg7XG4gIGhlaWdodDogMjBweDtcbn1cblxuQG1lZGlhIChtYXgtd2lkdGg6IDE0MDBweCkge1xuICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciB7XG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xuICAgIGhlaWdodDogMTAwJTtcbiAgICBtYXgtd2lkdGg6IDk4JSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnBvc2l0aW9uIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIHBhZGRpbmctdG9wOiAwcHg7XG4gICAgcGFkZGluZy1sZWZ0OiA5MnB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgLnBvc2l0aW9uIHNwYW4ge1xuICAgIHBhZGRpbmctcmlnaHQ6IDMycHggIWltcG9ydGFudDtcbiAgfVxufVxuLm1lbnVsaXN0aXRlbXMge1xuICBkaXNwbGF5OiBmbGV4O1xuICBtYXJnaW46IDA7XG4gIHBhZGRpbmc6IDA7XG59XG4ubWVudWxpc3RpdGVtcyAubWF0LWxpc3QtaXRlbSB7XG4gIG1hcmdpbi1yaWdodDogMTVweDtcbn1cbi5tZW51bGlzdGl0ZW1zIC5tYXQtbGlzdC1pdGVtIGEge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG59XG4ubWVudWxpc3RpdGVtcyAuZm9yc2VhcmNoaXRlbSBhIHtcbiAgd2lkdGg6IDMwcHg7XG4gIGhlaWdodDogMzBweDtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGJvcmRlcjogMXB4IHNvbGlkICM1NTU7XG4gIGJvcmRlci1yYWRpdXM6IDUwJTtcbiAgcGFkZGluZzogN3B4O1xufVxuLm1lbnVsaXN0aXRlbXMgLmZvcnNlYXJjaGl0ZW0gYSBpIHtcbiAgY29sb3I6ICM1NTU7XG4gIGNvbG9yOiAjNTU1O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cblxuI3RoYW5reW91bGlzdHZpZXcge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuc3VjY2Vzc3RpY2sge1xuICBwYWRkaW5nLWJvdHRvbTogMzBweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5zdWNjZXNzdGljayBzcGFuIHtcbiAgaGVpZ2h0OiA2NHB4O1xuICB3aWR0aDogNjRweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYm9yZGVyLXJhZGl1czogMTAwJTtcbiAgYmFja2dyb3VuZDogIzI3YTkxZDtcbiAgY29sb3I6ICNmZmY7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuc3VjY2Vzc3RpY2sgc3BhbiBpIHtcbiAgZm9udC1zaXplOiAxLjg3NXJlbTtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5jYW5jZWxsb2dvIGkge1xuICBmb250LXNpemU6IDEuODc1cmVtO1xuICBjb2xvcjogcmVkO1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmpzcnNjb250YWN0Y29sb3Ige1xuICBwYWRkaW5nLWJvdHRvbTogMjBweDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5qc3JzY29udGFjdGNvbG9yIGgyIHtcbiAgZm9udC1zaXplOiAxLjEyNXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjMjdhOTFkO1xufVxuI3RoYW5reW91bGlzdHZpZXcgLnJlZGNvbG9yIGgyIHtcbiAgZm9udC1zaXplOiAxLjEyNXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiByZWQgIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC50cmFuc2ZlcnRleHRjb2xvciBwIHtcbiAgY29sb3I6ICMzMzMzMzM7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbiAgbWFyZ2luOiAwcHg7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAudHJhbnNmZXJ0ZXh0Y29sb3IgcCBzcGFuIHtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9zZW1pYm9sZFwiO1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmxvZ2luYnRuIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMzBweDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5sb2dpbmJ0biBidXR0b24ge1xuICB3aWR0aDogMTYwcHg7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG5cbi50aGFua3lvdWlubmVycGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDEwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJveC1zaGFkb3c6IDAgMCA1MHB4IHJnYmEoMCwgMCwgMCwgMC4xNSk7XG4gIG1heC13aWR0aDogODAlO1xuICBtYXJnaW46IDAgYXV0bztcbiAgcGFkZGluZzogNjVweCAzNXB4O1xufVxuXG4jY2FuY2VsbGVkcmVnbGlzdCAucmVnaXN0ZXJjYW5jZWxsaXN0IHtcbiAgYm9yZGVyLXJhZGl1czogMTBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgYm94LXNoYWRvdzogMCAwIDUwcHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcbiAgbWF4LXdpZHRoOiA4MCU7XG4gIG1hcmdpbjogMCBhdXRvO1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbiAgbWFyZ2luLWJvdHRvbTogNHB4O1xufVxuI2NhbmNlbGxlZHJlZ2xpc3QgLnJlZ2lzdGVyY2FuY2VsbGlzdCAud2lkdGhmaWxlZCB7XG4gIHdpZHRoOiA4MCU7XG59XG4jY2FuY2VsbGVkcmVnbGlzdCAucmVnaXN0ZXJjYW5jZWxsaXN0IC53aWxsaW5nY29sb3IgcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBtYXJnaW46IDBweDtcbn1cbiNjYW5jZWxsZWRyZWdsaXN0IC5yZWdpc3RlcmNhbmNlbGxpc3QgLnRleHRoZWFkaW5ncmVnIHtcbiAgcGFkZGluZzogMzBweDtcbn1cbiNjYW5jZWxsZWRyZWdsaXN0IC5yZWdpc3RlcmNhbmNlbGxpc3QgLnRleHRoZWFkaW5ncmVnIGgyIHtcbiAgY29sb3I6ICMwMDZkYjg7XG59XG4jY2FuY2VsbGVkcmVnbGlzdCAucmVnaXN0ZXJjYW5jZWxsaXN0IC50ZXh0aGVhZGluZ3JlZyBwIHtcbiAgY29sb3I6ICMzMzMzMzM7XG59XG4jY2FuY2VsbGVkcmVnbGlzdCAucmVnaXN0ZXJjYW5jZWxsaXN0IC5zdWJzY3JpYmV0ZXh0IHtcbiAgcGFkZGluZzogMzBweDtcbiAgYmFja2dyb3VuZDogI2ZiZmNmZDtcbn1cbiNjYW5jZWxsZWRyZWdsaXN0IC5yZWdpc3RlcmNhbmNlbGxpc3QgLnN1YnNjcmliZXRleHQgcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xufVxuI2NhbmNlbGxlZHJlZ2xpc3QgLnJlZ2lzdGVyY2FuY2VsbGlzdCAuYnRuYWxpZ25zdWIge1xuICBkaXNwbGF5OiBmbGV4O1xuICBtYXJnaW4tdG9wOiAyMHB4O1xufVxuI2NhbmNlbGxlZHJlZ2xpc3QgLnJlZ2lzdGVyY2FuY2VsbGlzdCAuYnRuYWxpZ25zdWIgLnN1Ym1pdGJ0biwgI2NhbmNlbGxlZHJlZ2xpc3QgLnJlZ2lzdGVyY2FuY2VsbGlzdCAuYnRuYWxpZ25zdWIgLmJ0bmNhbmNlbCB7XG4gIGJhY2tncm91bmQ6ICMwMDZkYjg7XG4gIGNvbG9yOiAjZmZmO1xuICBtaW4td2lkdGg6IDE0MHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbn1cbiNjYW5jZWxsZWRyZWdsaXN0IC5yZWdpc3RlcmNhbmNlbGxpc3QgLmJ0bmFsaWduc3ViIC5idG5jYW5jZWwge1xuICBiYWNrZ3JvdW5kOiAjZWJlYmViICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjMzMzMzMzICFpbXBvcnRhbnQ7XG59XG4jY2FuY2VsbGVkcmVnbGlzdCAucmVnaXN0ZXJjYW5jZWxsaXN0IC5zdWJtaXRkaXNhYmxlIHtcbiAgYmFja2dyb3VuZDogI2VjZWNlYyAhaW1wb3J0YW50O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZWNlY2VjICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjOTk5ICFpbXBvcnRhbnQ7XG59XG5cbjpob3N0OjpuZy1kZWVwLnNwZWNpZnlyYWRpb2dyb3VwIHtcbiAgZGlzcGxheTogZmxleDtcbiAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcbn1cbjpob3N0OjpuZy1kZWVwLnNwZWNpZnlyYWRpb2dyb3VwIC5tYXQtcmFkaW8tbGFiZWwtY29udGVudCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBwYWRkaW5nLWxlZnQ6IDEwcHg7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuOmhvc3Q6Om5nLWRlZXAuc3BlY2lmeXJhZGlvZ3JvdXAgLm1hdC1yYWRpby1idXR0b24ge1xuICBwYWRkaW5nLWJvdHRvbTogNnB4O1xufVxuXG4ubWFrZWl0dG9wbWludXMge1xuICBtYXJnaW4tdG9wOiAtMTU4cHg7XG4gIG1pbi1oZWlnaHQ6IGNhbGMoMTAwdmggLSAyMzJweCk7XG59XG5cbiNleHBpcmVkbGlzdHZpZXcge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIGJvcmRlci1yYWRpdXM6IDEwcHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJveC1zaGFkb3c6IDAgMCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4xNSk7XG4gIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gIG1heC13aWR0aDogODAlICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogMTAwJTtcbiAgcGFkZGluZy10b3A6IDkwcHg7XG4gIG1pbi1oZWlnaHQ6IDQyMHB4O1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1hcmdpbi10b3A6IC0xMzVweDtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLnRyYW5zZmVydGV4dGNvbG9yIHAge1xuICBjb2xvcjogIzMzMzMzMztcbiAgZm9udC1zaXplOiAxcmVtO1xuICBtYXJnaW46IDBweDtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLmpzcnNjb250YWN0Y29sb3IgaDIge1xuICBjb2xvcjogI2Q5MWYyNDtcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIHBhZGRpbmctdG9wOiAxNXB4O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLmxvZ2luYnRuIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMzBweDtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLmxvZ2luYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6ICMwMDZkYjg7XG4gIHdpZHRoOiAxMDBweDtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuXG4jc2Vzc2lvbmxpc3R2aWV3IHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBib3JkZXItcmFkaXVzOiAxMHB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBib3gtc2hhZG93OiAwIDAgMTBweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xuICBtYXJnaW4tbGVmdDogYXV0bztcbiAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICBtYXgtd2lkdGg6IDUwJSAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDQyMHB4O1xuICBwYWRkaW5nLXRvcDogOTBweDtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBtYXJnaW4tdG9wOiAtMTAwcHg7XG4gIHBhZGRpbmctbGVmdDogMzBweDtcbiAgcGFkZGluZy1yaWdodDogMzBweDtcbn1cbiNzZXNzaW9ubGlzdHZpZXcgLnRyYW5zZmVydGV4dGNvbG9yIHAge1xuICBjb2xvcjogIzMzMzMzMztcbiAgZm9udC1zaXplOiAxcmVtO1xuICBtYXJnaW46IDBweDtcbn1cbiNzZXNzaW9ubGlzdHZpZXcgLmpzcnNjb250YWN0Y29sb3IgaDIge1xuICBjb2xvcjogI2Q5MWYyNDtcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIHBhZGRpbmctdG9wOiAxNXB4O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbiNzZXNzaW9ubGlzdHZpZXcgLmxvZ2luYnRuIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMzBweDtcbn1cbiNzZXNzaW9ubGlzdHZpZXcgLmxvZ2luYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6ICMwMDZkYjg7XG4gIHdpZHRoOiAxMDBweDtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuXG4jc2Vzc2lvbmV4cGlyZWQge1xuICBoZWlnaHQ6IGNhbGMoMTAwdmggLSAzNzBweCk7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/thankyou/approvechange/approvechange.component.ts":
  /*!***************************************************************************!*\
    !*** ./src/app/modules/thankyou/approvechange/approvechange.component.ts ***!
    \***************************************************************************/

  /*! exports provided: ApprovechangeComponent */

  /***/
  function srcAppModulesThankyouApprovechangeApprovechangeComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ApprovechangeComponent", function () {
      return ApprovechangeComponent;
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


    var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _app_modules_accountsettings_accountsettings_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/modules/accountsettings/accountsettings.service */
    "./src/app/modules/accountsettings/accountsettings.service.ts");
    /* harmony import */


    var _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/auth/admin.service */
    "./src/app/auth/admin.service.ts");
    /* harmony import */


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");

    var ApprovechangeComponent = /*#__PURE__*/function () {
      function ApprovechangeComponent(activatedRoute, accSettingsService, adminService, router, fb, translate, remoteService, cookieService) {
        _classCallCheck(this, ApprovechangeComponent);

        this.activatedRoute = activatedRoute;
        this.accSettingsService = accSettingsService;
        this.adminService = adminService;
        this.router = router;
        this.fb = fb;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.currentyear = new Date().getFullYear();
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_6__["ErrorStateMatcher"]();
        this.createspecifys = ['We are not looking for business opportunities in Oman.', 'We are out of business at the moment.', 'The JSRS Certification fee is too expensive.', 'Others'];
        this.adminPks = {};
        this.isAuthorized = false;
        this.isExpired = false;
        this.initSpinner = false;
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
        this.dir = 'ltr';
        this.lang = '1';
      }

      _createClass(ApprovechangeComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this = this;

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
          });
          this.RegistercancelledForm = this.fb.group({
            pleasespecify: ['', null],
            canceldata: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required],
            termsandcondition: ['', null]
          });
          this.activatedRoute.queryParams.subscribe(function (params) {
            if (params.type === 'accept' || params.type === 'cancel') {
              _this.pageFor = 'accept_cancel_reg';
              var type = params.type;
              var regPk = params.reg_pk;
              var cancelcmt = '';
              var willingon = '';

              if (params.type === 'accept' || params.type === 'cancel') {
                _this.adminService.acceptOrCancelReg(type, regPk, cancelcmt, willingon).subscribe(function (data) {
                  _this.pageStatus = data['data'].msg;
                  _this.setPasswordLink = data['data'].setpassword;
                });
              }
            } else {
              _this.initSpinner = true;
              _this.pageFor = 'change_user_authorise';
              _this.adminPks['currentAdminPk'] = params.c;
              _this.adminPks['newAdminPk'] = params.n;
              _this.adminPks['t'] = params.t;
              _this.adminPks['catype'] = params.catype;

              _this.authorizeChangeUser();
            }
          });
        }
      }, {
        key: "setLanguageFlag",
        value: function setLanguageFlag(value) {
          var _this2 = this;

          this.lang = value == '1' ? '2' : '1';
          var toSelect = this.languagelist.find(function (c) {
            return c.id === _this2.lang;
          });
          this.cookieService.set('languageCookieId', toSelect.id);
          this.cookieService.set('languageCode', toSelect.languagecode);
          this.cookieService.set('dir', toSelect.dir);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          this.remoteService.languageCookieValue(toSelect);
        }
      }, {
        key: "redirectToSetPassword",
        value: function redirectToSetPassword() {
          window.location.href = this.setPasswordLink;
        }
      }, {
        key: "navigateToLogin",
        value: function navigateToLogin() {
          this.router.navigate(['/admin/login']);
        }
      }, {
        key: "authorizeChangeUser",
        value: function authorizeChangeUser() {
          var _this3 = this;

          this.accSettingsService.changeAuthorizeUser(this.adminPks).subscribe(function (data) {
            _this3.isAuthorized = false;
            _this3.isExpired = false;

            if (data['data'].status == 1) {
              _this3.isAuthorized = true;
              _this3.isExpired = false;
              _this3.changetype = data['data'].type;
              _this3.oldUser = data['data'].oldUser;
              _this3.newUser = data['data'].newUser;
              _this3.initSpinner = false;
            } else if (data['data'].status == 2) {
              _this3.isExpired = true;
              _this3.isAuthorized = false;
              _this3.initSpinner = false;
            }
          });
        }
      }, {
        key: "cancelRegistration",
        value: function cancelRegistration() {
          var _this4 = this;

          this.activatedRoute.queryParams.subscribe(function (params) {
            if (params.type === 'cancel') {
              _this4.initSpinner = true;
              _this4.pageFor = 'accept_cancel_reg';
              var type = params.type;
              var regPk = params.reg_pk;

              if (_this4.RegistercancelledForm.value.canceldata == 'Other, please specify') {
                _this4.cancelcmt = _this4.RegistercancelledForm.value.pleasespecify;
              } else {
                _this4.cancelcmt = _this4.RegistercancelledForm.value.canceldata;
              }

              if (_this4.RegistercancelledForm.value.termsandcondition) {
                _this4.willingon = '1';
              } else {
                _this4.willingon = '';
              }

              if (_this4.RegistercancelledForm.valid) {
                _this4.adminService.acceptOrCancelReg(type, regPk, _this4.cancelcmt, _this4.willingon).subscribe(function (data) {
                  _this4.pageStatus = data['data'].msg;
                  _this4.setPasswordLink = data['data'].setpassword;
                  _this4.initSpinner = false;
                });
              } else {
                _this4.initSpinner = false;
              }
            }
          });
        }
      }, {
        key: "radioChange",
        value: function radioChange() {
          if (this.RegistercancelledForm.controls['canceldata'].value == 'Other, please specify') {
            this.RegistercancelledForm.controls['pleasespecify'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required]);
            this.RegistercancelledForm.controls['pleasespecify'].updateValueAndValidity();
          } else {
            this.RegistercancelledForm.controls['pleasespecify'].setValidators(null);
            this.RegistercancelledForm.controls['pleasespecify'].updateValueAndValidity();
          }
        }
      }]);

      return ApprovechangeComponent;
    }();

    ApprovechangeComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"]
      }, {
        type: _app_modules_accountsettings_accountsettings_service__WEBPACK_IMPORTED_MODULE_4__["AccountsettingsService"]
      }, {
        type: _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_5__["AdminService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormBuilder"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_8__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__["CookieService"]
      }];
    };

    ApprovechangeComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-approvechange',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./approvechange.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/approvechange/approvechange.component.html"))["default"],
      providers: [_app_modules_accountsettings_accountsettings_service__WEBPACK_IMPORTED_MODULE_4__["AccountsettingsService"], _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_5__["AdminService"]],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./approvechange.component.scss */
      "./src/app/modules/thankyou/approvechange/approvechange.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"], _app_modules_accountsettings_accountsettings_service__WEBPACK_IMPORTED_MODULE_4__["AccountsettingsService"], _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_5__["AdminService"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormBuilder"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_8__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__["CookieService"]])], ApprovechangeComponent);
    /***/
  },

  /***/
  "./src/app/modules/thankyou/inviteexpired/inviteexpired.component.scss":
  /*!*****************************************************************************!*\
    !*** ./src/app/modules/thankyou/inviteexpired/inviteexpired.component.scss ***!
    \*****************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesThankyouInviteexpiredInviteexpiredComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#expiredlistview {\n  background-color: #fff;\n  min-height: 470px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  flex-direction: column;\n  height: calc(100vh - 65px);\n}\n#expiredlistview .transfertextcolor p {\n  color: #333333;\n  font-size: 1rem;\n  margin: 0px;\n}\n#expiredlistview .jsrscontactcolor h2 {\n  color: #d91f24;\n  margin: 0px;\n  font-size: 1.125rem;\n  padding-top: 15px;\n  padding-bottom: 10px;\n}\n#expiredlistview .loginbtn {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-top: 30px;\n}\n#expiredlistview .loginbtn button {\n  background: #4ba2ac;\n  width: 100px;\n  color: #fff;\n  border-radius: 2px !important;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy90aGFua3lvdS9pbnZpdGVleHBpcmVkL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXHRoYW5reW91XFxpbnZpdGVleHBpcmVkXFxpbnZpdGVleHBpcmVkLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3RoYW5reW91L2ludml0ZWV4cGlyZWQvaW52aXRlZXhwaXJlZC5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFnQ0E7RUFHRSxzQkFBQTtFQU9BLGlCQUFBO0VBeENBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLDhCQUFBO0VBMENBLHNCQUFBO0VBQ0EsMEJBQUE7QUN2Q0Y7QUR5Q1E7RUFDSSxjQUFBO0VBQ0EsZUFBQTtFQUNBLFdBQUE7QUN2Q1o7QUQyQ087RUFDRyxjQUFBO0VBQ0EsV0FBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7RUFDQSxvQkFBQTtBQ3pDVjtBRDRDRTtFQTlEQSxhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtFQThESSxnQkFBQTtBQ3hDTjtBRHlDTztFQUNJLG1CQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSw2QkFBQTtFQXJFVCxhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtBQytCRiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvdGhhbmt5b3UvaW52aXRlZXhwaXJlZC9pbnZpdGVleHBpcmVkLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiXHJcbkBtaXhpbiBmbGV4Y2VudGVyIHtcclxuICBkaXNwbGF5OiBmbGV4O1xyXG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIGZsZXhzdGFydCB7XHJcbiAgZGlzcGxheTogZmxleDtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcblxyXG5AbWl4aW4gZmxleGVuZCB7XHJcbiAgZGlzcGxheTogZmxleDtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIHNwYWNlYmV0d2VlbiB7XHJcbiAgZGlzcGxheTogZmxleDtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxufVxyXG5cclxuQG1peGluIG1hcmdpbnplcm8ge1xyXG4gIG1hcmdpbjogMDtcclxuICB3aGl0ZS1zcGFjZTogbm9ybWFsICFpbXBvcnRhbnQ7XHJcbiAgdGV4dC1hbGlnbjogbGVmdDtcclxufVxyXG5cclxuXHJcbiNleHBpcmVkbGlzdHZpZXd7XHJcbiAgLy8gYm9yZGVyLXJhZGl1czogMTBweDtcclxuICAvLyBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgLy8gYm94LXNoYWRvdzogMCAwIDEwcHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcclxuICAvLyBtYXJnaW4tbGVmdDogYXV0bztcclxuICAvLyBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgLy8gbWF4LXdpZHRoOiA4MCUgIWltcG9ydGFudDtcclxuICAvLyBoZWlnaHQ6IDEwMCU7XHJcbiAgLy8gcGFkZGluZy10b3A6IDkwcHg7XHJcbiAgbWluLWhlaWdodDogNDcwcHg7IFxyXG4gIC8vIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAvLyBtYXJnaW4tdG9wOiAtMTU4cHg7XHJcbiAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XHJcbiAgaGVpZ2h0OiBjYWxjKDEwMHZoIC0gNjVweCk7XHJcbiAgLnRyYW5zZmVydGV4dGNvbG9ye1xyXG4gICAgICAgIHB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDFyZW07XHJcbiAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgIH1cclxuICB9XHJcbiAgLmpzcnNjb250YWN0Y29sb3J7XHJcbiAgICAgICBoMntcclxuICAgICAgICAgIGNvbG9yOiAjZDkxZjI0O1xyXG4gICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgcGFkZGluZy10b3A6IDE1cHg7XHJcbiAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgIH1cclxuICB9XHJcbiAgLmxvZ2luYnRue1xyXG4gICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcbiAgICAgICBidXR0b257XHJcbiAgICAgICAgICAgYmFja2dyb3VuZDogIzRiYTJhYztcclxuICAgICAgICAgICB3aWR0aDogMTAwcHg7XHJcbiAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcjtcclxuICAgICAgIH1cclxuICB9XHJcbn1cclxuIiwiI2V4cGlyZWRsaXN0dmlldyB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIG1pbi1oZWlnaHQ6IDQ3MHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICBoZWlnaHQ6IGNhbGMoMTAwdmggLSA2NXB4KTtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLnRyYW5zZmVydGV4dGNvbG9yIHAge1xuICBjb2xvcjogIzMzMzMzMztcbiAgZm9udC1zaXplOiAxcmVtO1xuICBtYXJnaW46IDBweDtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLmpzcnNjb250YWN0Y29sb3IgaDIge1xuICBjb2xvcjogI2Q5MWYyNDtcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIHBhZGRpbmctdG9wOiAxNXB4O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLmxvZ2luYnRuIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMzBweDtcbn1cbiNleHBpcmVkbGlzdHZpZXcgLmxvZ2luYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6ICM0YmEyYWM7XG4gIHdpZHRoOiAxMDBweDtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufSJdfQ== */";
    /***/
  },

  /***/
  "./src/app/modules/thankyou/inviteexpired/inviteexpired.component.ts":
  /*!***************************************************************************!*\
    !*** ./src/app/modules/thankyou/inviteexpired/inviteexpired.component.ts ***!
    \***************************************************************************/

  /*! exports provided: InviteexpiredComponent */

  /***/
  function srcAppModulesThankyouInviteexpiredInviteexpiredComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "InviteexpiredComponent", function () {
      return InviteexpiredComponent;
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


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");

    var InviteexpiredComponent = /*#__PURE__*/function () {
      function InviteexpiredComponent(translate, remoteService, cookieService, router) {
        _classCallCheck(this, InviteexpiredComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.router = router;
        this.currentyear = new Date().getFullYear();
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
        this.dir = 'ltr';
        this.lang = '1';
      }

      _createClass(InviteexpiredComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this5 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this5.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect4 = this.languagelist.find(function (c) {
              return c.id == '1';
            });

            this.cookieService.set('languageCookieId', _toSelect4.id);
            this.cookieService.set('languageCode', _toSelect4.languagecode);
            this.cookieService.set('dir', _toSelect4.dir);
            this.translate.setDefaultLang(_toSelect4.languagecode);
            this.dir = _toSelect4.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this5.translate.setDefaultLang(_this5.cookieService.get('languageCode'));

            if (_this5.cookieService.get('languageCookieId') && _this5.cookieService.get('languageCookieId') != undefined && _this5.cookieService.get('languageCookieId') != null) {
              var _toSelect5 = _this5.languagelist.find(function (c) {
                return c.id === _this5.cookieService.get('languageCookieId');
              });

              _this5.translate.setDefaultLang(_toSelect5.languagecode);

              _this5.dir = _toSelect5.dir;
            } else {
              var _toSelect6 = _this5.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this5.translate.setDefaultLang(_toSelect6.languagecode);

              _this5.dir = _toSelect6.dir;
            }
          });
        }
      }, {
        key: "setLanguageFlag",
        value: function setLanguageFlag(value) {
          var _this6 = this;

          this.lang = value == '1' ? '2' : '1';
          var toSelect = this.languagelist.find(function (c) {
            return c.id === _this6.lang;
          });
          this.cookieService.set('languageCookieId', toSelect.id);
          this.cookieService.set('languageCode', toSelect.languagecode);
          this.cookieService.set('dir', toSelect.dir);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          this.remoteService.languageCookieValue(toSelect);
        }
      }, {
        key: "navigate",
        value: function navigate() {
          this.router.navigate(['/admin/login']);
        }
      }]);

      return InviteexpiredComponent;
    }();

    InviteexpiredComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]
      }];
    };

    InviteexpiredComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-inviteexpired',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./inviteexpired.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/inviteexpired/inviteexpired.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./inviteexpired.component.scss */
      "./src/app/modules/thankyou/inviteexpired/inviteexpired.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"], _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]])], InviteexpiredComponent);
    /***/
  },

  /***/
  "./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.scss":
  /*!***********************************************************************************************!*\
    !*** ./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.scss ***!
    \***********************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesThankyouRegisterationconfirmedRegisterationconfirmedComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#registerlistview {\n  /* border-radius: 10px; */\n  /* background-clip: padding-box; */\n  /* background-color: #fff; */\n  /* box-shadow: 0 0 10px rgb(0 0 0 / 15%); */\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 80% !important;\n  height: 100%;\n  padding-top: 90px;\n  min-height: 470px;\n  text-align: center;\n  /* margin-top: -158px; */\n}\n#registerlistview .notecolorrole {\n  padding-bottom: 20px;\n}\n#registerlistview .notecolorrole p {\n  color: #333333;\n  margin: 0px;\n  font-size: 0.875rem;\n}\n#registerlistview .notecolorrole p span {\n  color: #f4811f;\n}\n#registerlistview .successtick {\n  padding-bottom: 30px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n#registerlistview .successtick span {\n  height: 64px;\n  width: 64px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  border-radius: 100%;\n  background: #27a91d;\n  color: #fff;\n}\n#registerlistview .successtick span i {\n  font-size: 1.875rem;\n}\n#registerlistview .jsrscontactcolor {\n  padding-bottom: 20px;\n}\n#registerlistview .jsrscontactcolor h2 {\n  font-size: 1.125rem;\n  margin: 0px;\n  color: #27a91d;\n}\n#registerlistview .transfertextcolor p {\n  color: #333333;\n  font-size: 1rem;\n  margin: 0px;\n}\n#registerlistview .transfertextcolor p span {\n  font-family: \"cairosemibold\";\n}\n#registerlistview .loginbtn {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-top: 30px;\n}\n#registerlistview .loginbtn button {\n  background: #4ba2ac;\n  width: 160px;\n  color: #fff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n.headerstyle {\n  display: flex;\n  height: 100vh;\n}\n.headerstyle .leftisideinfodetail {\n  background-clip: padding-box;\n  width: 50%;\n  z-index: 0;\n  height: 100%;\n}\n.headerstyle .leftisideinfodetail .loginbg {\n  background: url('http://192.168.1.200:82/opal_usp/app/assets/images/bg.png') top left no-repeat;\n  background-size: cover;\n  height: 100% !important;\n  width: 100%;\n  -o-object-fit: cover;\n     object-fit: cover;\n  margin-left: 0;\n  background-position: center;\n}\n@media (min-width: 1920px) {\n  .headerstyle .leftisideinfodetail .loginbg {\n    background: url('http://192.168.1.200:82/opal_usp/app/assets/images/bg.png') top left no-repeat;\n    background-size: cover !important;\n  }\n}\n.headerstyle .rightsideinfodetail {\n  width: 50%;\n  background-color: #fff;\n  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);\n  min-height: 623px;\n  height: 100vh;\n  text-align: center;\n}\n.headerstyle .rightsideinfodetail .langbtn {\n  justify-content: end;\n}\n.headerstyle .rightsideinfodetail .langbtn button {\n  background: none;\n  border: none;\n  color: #4AA2AD;\n  cursor: pointer;\n}\n.headerstyle .rightsideinfodetail .login_footer .adminfooter.footerspace #res_pr-0 .img_hig-mar {\n  width: 140px !important;\n}\n.headerstyle .rightsideinfodetail .footer-height {\n  height: calc(100vh - 60px);\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy90aGFua3lvdS9yZWdpc3RlcmF0aW9uY29uZmlybWVkL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXHRoYW5reW91XFxyZWdpc3RlcmF0aW9uY29uZmlybWVkXFxyZWdpc3RlcmF0aW9uY29uZmlybWVkLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3RoYW5reW91L3JlZ2lzdGVyYXRpb25jb25maXJtZWQvcmVnaXN0ZXJhdGlvbmNvbmZpcm1lZC5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUE4QkE7RUFDUSx5QkFBQTtFQUNKLGtDQUFBO0VBQ0EsNEJBQUE7RUFDQSwyQ0FBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSx5QkFBQTtFQUNBLFlBQUE7RUFDQSxpQkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSx3QkFBQTtBQzdCSjtBRDhCSTtFQUNJLG9CQUFBO0FDNUJSO0FENkJTO0VBQ0UsY0FBQTtFQUNBLFdBQUE7RUFDQSxtQkFBQTtBQzNCWDtBRDRCWTtFQUNBLGNBQUE7QUMxQlo7QUQ4Qkk7RUFDSSxvQkFBQTtFQXJESixhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtBQzBCSjtBRDJCUTtFQUNJLFlBQUE7RUFDQSxXQUFBO0VBekRSLGFBQUE7RUFDQSx1QkFBQTtFQUNBLDhCQUFBO0VBeURRLG1CQUFBO0VBQ0EsbUJBQUE7RUFDQSxXQUFBO0FDdkJaO0FEd0JZO0VBQ0ksbUJBQUE7QUN0QmhCO0FEMEJJO0VBQ0ksb0JBQUE7QUN4QlI7QUR5Qlc7RUFDSSxtQkFBQTtFQUNBLFdBQUE7RUFDQSxjQUFBO0FDdkJmO0FEMkJVO0VBQ0ksY0FBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0FDekJkO0FEMEJjO0VBQ0ksNEJBQUE7QUN4QmxCO0FENEJJO0VBckZBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLDhCQUFBO0VBcUZJLGdCQUFBO0FDeEJSO0FEeUJTO0VBQ0ksbUJBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0VBNUZULGFBQUE7RUFDQSx1QkFBQTtFQUNBLDhCQUFBO0FDc0VKO0FEeUJBO0VBRUksYUFBQTtFQUNBLGFBQUE7QUN2Qko7QUR3QkE7RUFDSSw0QkFBQTtFQUVBLFVBQUE7RUFFQSxVQUFBO0VBQ0EsWUFBQTtBQ3hCSjtBRDJCSTtFQUNJLCtGQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtFQUVBLFdBQUE7RUFDQSxvQkFBQTtLQUFBLGlCQUFBO0VBQ0EsY0FBQTtFQUNBLDJCQUFBO0FDMUJSO0FENEJRO0VBVko7SUFXUSwrRkFBQTtJQUNBLGlDQUFBO0VDekJWO0FBQ0Y7QUQ2QkE7RUFDSSxVQUFBO0VBQ0Esc0JBQUE7RUFDQSx3Q0FBQTtFQUVBLGlCQUFBO0VBQ0EsYUFBQTtFQUVBLGtCQUFBO0FDN0JKO0FEa0NJO0VBQ0ksb0JBQUE7QUNoQ1I7QURrQ1E7RUFDSSxnQkFBQTtFQUNBLFlBQUE7RUFDQSxjQUFBO0VBQ0EsZUFBQTtBQ2hDWjtBRHdDZ0I7RUFDSSx1QkFBQTtBQ3RDcEI7QUQrQ0k7RUFDSSwwQkFBQTtBQzdDUiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvdGhhbmt5b3UvcmVnaXN0ZXJhdGlvbmNvbmZpcm1lZC9yZWdpc3RlcmF0aW9uY29uZmlybWVkLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiXHJcbkBtaXhpbiBmbGV4Y2VudGVyIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIGZsZXhzdGFydCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcblxyXG5AbWl4aW4gZmxleGVuZCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIHNwYWNlYmV0d2VlbiB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxufVxyXG5cclxuQG1peGluIG1hcmdpbnplcm8ge1xyXG4gICAgbWFyZ2luOiAwO1xyXG4gICAgd2hpdGUtc3BhY2U6IG5vcm1hbCAhaW1wb3J0YW50O1xyXG4gICAgdGV4dC1hbGlnbjogbGVmdDtcclxuICB9XHJcbiNyZWdpc3Rlcmxpc3R2aWV3e1xyXG4gICAgICAgIC8qIGJvcmRlci1yYWRpdXM6IDEwcHg7ICovXHJcbiAgICAvKiBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94OyAqL1xyXG4gICAgLyogYmFja2dyb3VuZC1jb2xvcjogI2ZmZjsgKi9cclxuICAgIC8qIGJveC1zaGFkb3c6IDAgMCAxMHB4IHJnYigwIDAgMCAvIDE1JSk7ICovXHJcbiAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgIG1hcmdpbi1yaWdodDogYXV0bztcclxuICAgIG1heC13aWR0aDogODAlICFpbXBvcnRhbnQ7XHJcbiAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICBwYWRkaW5nLXRvcDogOTBweDtcclxuICAgIG1pbi1oZWlnaHQ6IDQ3MHB4O1xyXG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgLyogbWFyZ2luLXRvcDogLTE1OHB4OyAqL1xyXG4gICAgLm5vdGVjb2xvcnJvbGV7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDIwcHg7XHJcbiAgICAgICAgIHB7XHJcbiAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICAgICAgc3BhbntcclxuICAgICAgICAgICAgY29sb3I6ICNmNDgxMWY7XHJcbiAgICAgICAgICAgfVxyXG4gICAgICAgICB9XHJcbiAgICAgIH0gICAgICBcclxuICAgIC5zdWNjZXNzdGljayB7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDMwcHg7XHJcbiAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDY0cHg7XHJcbiAgICAgICAgICAgIHdpZHRoOiA2NHB4O1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDEwMCU7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6IzI3YTkxZDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGkge1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxLjg3NXJlbTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5qc3JzY29udGFjdGNvbG9ye1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAyMHB4O1xyXG4gICAgICAgICAgIGgye1xyXG4gICAgICAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICAgY29sb3I6ICMyN2E5MWQ7XHJcbiAgICAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnRyYW5zZmVydGV4dGNvbG9ye1xyXG4gICAgICAgICAgcHtcclxuICAgICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgICBmb250LXNpemU6IDFyZW07ICBcclxuICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICBzcGFue1xyXG4gICAgICAgICAgICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgIH1cclxuICAgIH1cclxuICAgIC5sb2dpbmJ0bntcclxuICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMzBweDtcclxuICAgICAgICAgYnV0dG9ue1xyXG4gICAgICAgICAgICAgYmFja2dyb3VuZDogIzRiYTJhYztcclxuICAgICAgICAgICAgIHdpZHRoOiAxNjBweDtcclxuICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcjtcclxuICAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcbi5oZWFkZXJzdHlsZXtcclxuXHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgaGVpZ2h0OiAxMDB2aDtcclxuLmxlZnRpc2lkZWluZm9kZXRhaWwge1xyXG4gICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuXHJcbiAgICB3aWR0aDogNTAlO1xyXG5cclxuICAgIHotaW5kZXg6IDA7XHJcbiAgICBoZWlnaHQ6IDEwMCU7XHJcblxyXG5cclxuICAgIC5sb2dpbmJnIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiB1cmwoJ34vYXNzZXRzL2ltYWdlcy9iZy5wbmcnKSB0b3AgbGVmdCBuby1yZXBlYXQ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1zaXplOiBjb3ZlcjtcclxuICAgICAgICBoZWlnaHQ6IDEwMCUgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgb2JqZWN0LWZpdDogY292ZXI7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDA7XHJcbiAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbjogY2VudGVyO1xyXG5cclxuICAgICAgICBAbWVkaWEgKG1pbi13aWR0aDoxOTIwcHgpIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogdXJsKCd+L2Fzc2V0cy9pbWFnZXMvYmcucG5nJykgdG9wIGxlZnQgbm8tcmVwZWF0O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLXNpemU6IGNvdmVyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxufVxyXG4ucmlnaHRzaWRlaW5mb2RldGFpbCB7XHJcbiAgICB3aWR0aDogNTAlO1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgIGJveC1zaGFkb3c6IDAgMCAxMHB4IHJnYigwIDAgMCAvIDE1JSk7XHJcbiAgICAvLyBoZWlnaHQ6IDEwMCU7XHJcbiAgICBtaW4taGVpZ2h0OiA2MjNweDtcclxuICAgIGhlaWdodDogMTAwdmg7XHJcblxyXG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG5cclxuICAgIC8vIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAvLyBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIC8vIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAubGFuZ2J0biB7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBlbmQ7XHJcblxyXG4gICAgICAgIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6IG5vbmU7XHJcbiAgICAgICAgICAgIGJvcmRlcjogbm9uZTtcclxuICAgICAgICAgICAgY29sb3I6ICM0QUEyQUQ7XHJcbiAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmxvZ2luX2Zvb3RlciB7XHJcbiAgICAgICAgLmFkbWluZm9vdGVyLmZvb3RlcnNwYWNlIHtcclxuICAgICAgICAgICAgI3Jlc19wci0wIHtcclxuXHJcbiAgICAgICAgICAgICAgICAuaW1nX2hpZy1tYXIge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiAxNDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgfVxyXG5cclxuXHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5mb290ZXItaGVpZ2h0IHtcclxuICAgICAgICBoZWlnaHQ6IGNhbGMoMTAwdmggLSA2MHB4KTtcclxuICAgIH1cclxufVxyXG5cclxufSIsIiNyZWdpc3Rlcmxpc3R2aWV3IHtcbiAgLyogYm9yZGVyLXJhZGl1czogMTBweDsgKi9cbiAgLyogYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDsgKi9cbiAgLyogYmFja2dyb3VuZC1jb2xvcjogI2ZmZjsgKi9cbiAgLyogYm94LXNoYWRvdzogMCAwIDEwcHggcmdiKDAgMCAwIC8gMTUlKTsgKi9cbiAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gIG1hcmdpbi1yaWdodDogYXV0bztcbiAgbWF4LXdpZHRoOiA4MCUgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiAxMDAlO1xuICBwYWRkaW5nLXRvcDogOTBweDtcbiAgbWluLWhlaWdodDogNDcwcHg7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgLyogbWFyZ2luLXRvcDogLTE1OHB4OyAqL1xufVxuI3JlZ2lzdGVybGlzdHZpZXcgLm5vdGVjb2xvcnJvbGUge1xuICBwYWRkaW5nLWJvdHRvbTogMjBweDtcbn1cbiNyZWdpc3Rlcmxpc3R2aWV3IC5ub3RlY29sb3Jyb2xlIHAge1xuICBjb2xvcjogIzMzMzMzMztcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4jcmVnaXN0ZXJsaXN0dmlldyAubm90ZWNvbG9ycm9sZSBwIHNwYW4ge1xuICBjb2xvcjogI2Y0ODExZjtcbn1cbiNyZWdpc3Rlcmxpc3R2aWV3IC5zdWNjZXNzdGljayB7XG4gIHBhZGRpbmctYm90dG9tOiAzMHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI3JlZ2lzdGVybGlzdHZpZXcgLnN1Y2Nlc3N0aWNrIHNwYW4ge1xuICBoZWlnaHQ6IDY0cHg7XG4gIHdpZHRoOiA2NHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBib3JkZXItcmFkaXVzOiAxMDAlO1xuICBiYWNrZ3JvdW5kOiAjMjdhOTFkO1xuICBjb2xvcjogI2ZmZjtcbn1cbiNyZWdpc3Rlcmxpc3R2aWV3IC5zdWNjZXNzdGljayBzcGFuIGkge1xuICBmb250LXNpemU6IDEuODc1cmVtO1xufVxuI3JlZ2lzdGVybGlzdHZpZXcgLmpzcnNjb250YWN0Y29sb3Ige1xuICBwYWRkaW5nLWJvdHRvbTogMjBweDtcbn1cbiNyZWdpc3Rlcmxpc3R2aWV3IC5qc3JzY29udGFjdGNvbG9yIGgyIHtcbiAgZm9udC1zaXplOiAxLjEyNXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjMjdhOTFkO1xufVxuI3JlZ2lzdGVybGlzdHZpZXcgLnRyYW5zZmVydGV4dGNvbG9yIHAge1xuICBjb2xvcjogIzMzMzMzMztcbiAgZm9udC1zaXplOiAxcmVtO1xuICBtYXJnaW46IDBweDtcbn1cbiNyZWdpc3Rlcmxpc3R2aWV3IC50cmFuc2ZlcnRleHRjb2xvciBwIHNwYW4ge1xuICBmb250LWZhbWlseTogXCJjYWlyb3NlbWlib2xkXCI7XG59XG4jcmVnaXN0ZXJsaXN0dmlldyAubG9naW5idG4ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiAzMHB4O1xufVxuI3JlZ2lzdGVybGlzdHZpZXcgLmxvZ2luYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6ICM0YmEyYWM7XG4gIHdpZHRoOiAxNjBweDtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cblxuLmhlYWRlcnN0eWxlIHtcbiAgZGlzcGxheTogZmxleDtcbiAgaGVpZ2h0OiAxMDB2aDtcbn1cbi5oZWFkZXJzdHlsZSAubGVmdGlzaWRlaW5mb2RldGFpbCB7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIHdpZHRoOiA1MCU7XG4gIHotaW5kZXg6IDA7XG4gIGhlaWdodDogMTAwJTtcbn1cbi5oZWFkZXJzdHlsZSAubGVmdGlzaWRlaW5mb2RldGFpbCAubG9naW5iZyB7XG4gIGJhY2tncm91bmQ6IHVybChcIn4vYXNzZXRzL2ltYWdlcy9iZy5wbmdcIikgdG9wIGxlZnQgbm8tcmVwZWF0O1xuICBiYWNrZ3JvdW5kLXNpemU6IGNvdmVyO1xuICBoZWlnaHQ6IDEwMCUgIWltcG9ydGFudDtcbiAgd2lkdGg6IDEwMCU7XG4gIG9iamVjdC1maXQ6IGNvdmVyO1xuICBtYXJnaW4tbGVmdDogMDtcbiAgYmFja2dyb3VuZC1wb3NpdGlvbjogY2VudGVyO1xufVxuQG1lZGlhIChtaW4td2lkdGg6IDE5MjBweCkge1xuICAuaGVhZGVyc3R5bGUgLmxlZnRpc2lkZWluZm9kZXRhaWwgLmxvZ2luYmcge1xuICAgIGJhY2tncm91bmQ6IHVybChcIn4vYXNzZXRzL2ltYWdlcy9iZy5wbmdcIikgdG9wIGxlZnQgbm8tcmVwZWF0O1xuICAgIGJhY2tncm91bmQtc2l6ZTogY292ZXIgIWltcG9ydGFudDtcbiAgfVxufVxuLmhlYWRlcnN0eWxlIC5yaWdodHNpZGVpbmZvZGV0YWlsIHtcbiAgd2lkdGg6IDUwJTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgYm94LXNoYWRvdzogMCAwIDEwcHggcmdiYSgwLCAwLCAwLCAwLjE1KTtcbiAgbWluLWhlaWdodDogNjIzcHg7XG4gIGhlaWdodDogMTAwdmg7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsZSAucmlnaHRzaWRlaW5mb2RldGFpbCAubGFuZ2J0biB7XG4gIGp1c3RpZnktY29udGVudDogZW5kO1xufVxuLmhlYWRlcnN0eWxlIC5yaWdodHNpZGVpbmZvZGV0YWlsIC5sYW5nYnRuIGJ1dHRvbiB7XG4gIGJhY2tncm91bmQ6IG5vbmU7XG4gIGJvcmRlcjogbm9uZTtcbiAgY29sb3I6ICM0QUEyQUQ7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi5oZWFkZXJzdHlsZSAucmlnaHRzaWRlaW5mb2RldGFpbCAubG9naW5fZm9vdGVyIC5hZG1pbmZvb3Rlci5mb290ZXJzcGFjZSAjcmVzX3ByLTAgLmltZ19oaWctbWFyIHtcbiAgd2lkdGg6IDE0MHB4ICFpbXBvcnRhbnQ7XG59XG4uaGVhZGVyc3R5bGUgLnJpZ2h0c2lkZWluZm9kZXRhaWwgLmZvb3Rlci1oZWlnaHQge1xuICBoZWlnaHQ6IGNhbGMoMTAwdmggLSA2MHB4KTtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.ts":
  /*!*********************************************************************************************!*\
    !*** ./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.ts ***!
    \*********************************************************************************************/

  /*! exports provided: RegisterationconfirmedComponent */

  /***/
  function srcAppModulesThankyouRegisterationconfirmedRegisterationconfirmedComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "RegisterationconfirmedComponent", function () {
      return RegisterationconfirmedComponent;
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


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");

    var RegisterationconfirmedComponent = /*#__PURE__*/function () {
      function RegisterationconfirmedComponent(translate, remoteService, cookieService, router) {
        _classCallCheck(this, RegisterationconfirmedComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.router = router;
        this.currentyear = new Date().getFullYear();
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
        this.dir = 'ltr';
        this.lang = '1';
      }

      _createClass(RegisterationconfirmedComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this7 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this7.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect7 = this.languagelist.find(function (c) {
              return c.id == '1';
            });

            this.cookieService.set('languageCookieId', _toSelect7.id);
            this.cookieService.set('languageCode', _toSelect7.languagecode);
            this.cookieService.set('dir', _toSelect7.dir);
            this.translate.setDefaultLang(_toSelect7.languagecode);
            this.dir = _toSelect7.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this7.translate.setDefaultLang(_this7.cookieService.get('languageCode'));

            if (_this7.cookieService.get('languageCookieId') && _this7.cookieService.get('languageCookieId') != undefined && _this7.cookieService.get('languageCookieId') != null) {
              var _toSelect8 = _this7.languagelist.find(function (c) {
                return c.id === _this7.cookieService.get('languageCookieId');
              });

              _this7.translate.setDefaultLang(_toSelect8.languagecode);

              _this7.dir = _toSelect8.dir;
            } else {
              var _toSelect9 = _this7.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this7.translate.setDefaultLang(_toSelect9.languagecode);

              _this7.dir = _toSelect9.dir;
            }
          });
        }
      }, {
        key: "setLanguageFlag",
        value: function setLanguageFlag(value) {
          var _this8 = this;

          this.lang = value == '1' ? '2' : '1';
          var toSelect = this.languagelist.find(function (c) {
            return c.id === _this8.lang;
          });
          this.cookieService.set('languageCookieId', toSelect.id);
          this.cookieService.set('languageCode', toSelect.languagecode);
          this.cookieService.set('dir', toSelect.dir);
          this.translate.setDefaultLang(toSelect.languagecode);
          this.dir = toSelect.dir;
          this.remoteService.languageCookieValue(toSelect);
        }
      }, {
        key: "navigate",
        value: function navigate() {
          this.router.navigate(['/admin/login']);
        }
      }]);

      return RegisterationconfirmedComponent;
    }();

    RegisterationconfirmedComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]
      }];
    };

    RegisterationconfirmedComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-registerationconfirmed',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./registerationconfirmed.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./registerationconfirmed.component.scss */
      "./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"], _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]])], RegisterationconfirmedComponent);
    /***/
  },

  /***/
  "./src/app/modules/thankyou/thankyou-routing.module.ts":
  /*!*************************************************************!*\
    !*** ./src/app/modules/thankyou/thankyou-routing.module.ts ***!
    \*************************************************************/

  /*! exports provided: ThankyouRoutingModule */

  /***/
  function srcAppModulesThankyouThankyouRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ThankyouRoutingModule", function () {
      return ThankyouRoutingModule;
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


    var _approvechange_approvechange_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./approvechange/approvechange.component */
    "./src/app/modules/thankyou/approvechange/approvechange.component.ts");
    /* harmony import */


    var _inviteexpired_inviteexpired_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./inviteexpired/inviteexpired.component */
    "./src/app/modules/thankyou/inviteexpired/inviteexpired.component.ts");
    /* harmony import */


    var _registerationconfirmed_registerationconfirmed_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./registerationconfirmed/registerationconfirmed.component */
    "./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'approvechange',
        component: _approvechange_approvechange_component__WEBPACK_IMPORTED_MODULE_3__["ApprovechangeComponent"]
      }, {
        path: 'inviteexpired',
        component: _inviteexpired_inviteexpired_component__WEBPACK_IMPORTED_MODULE_4__["InviteexpiredComponent"]
      }, {
        path: 'regisconfirm',
        component: _registerationconfirmed_registerationconfirmed_component__WEBPACK_IMPORTED_MODULE_5__["RegisterationconfirmedComponent"]
      }]
    }];

    var ThankyouRoutingModule = /*#__PURE__*/_createClass(function ThankyouRoutingModule() {
      _classCallCheck(this, ThankyouRoutingModule);
    });

    ThankyouRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], ThankyouRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/thankyou/thankyou.module.ts":
  /*!*****************************************************!*\
    !*** ./src/app/modules/thankyou/thankyou.module.ts ***!
    \*****************************************************/

  /*! exports provided: createTranslateLoader, ThankyouModule */

  /***/
  function srcAppModulesThankyouThankyouModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function () {
      return createTranslateLoader;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ThankyouModule", function () {
      return ThankyouModule;
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


    var _thankyou_routing_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./thankyou-routing.module */
    "./src/app/modules/thankyou/thankyou-routing.module.ts");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
    /* harmony import */


    var _thankyoupageview_thankyoupageview_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./thankyoupageview/thankyoupageview.component */
    "./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.ts");
    /* harmony import */


    var _approvechange_approvechange_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ./approvechange/approvechange.component */
    "./src/app/modules/thankyou/approvechange/approvechange.component.ts");
    /* harmony import */


    var _inviteexpired_inviteexpired_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ./inviteexpired/inviteexpired.component */
    "./src/app/modules/thankyou/inviteexpired/inviteexpired.component.ts");
    /* harmony import */


    var _registerationconfirmed_registerationconfirmed_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ./registerationconfirmed/registerationconfirmed.component */
    "./src/app/modules/thankyou/registerationconfirmed/registerationconfirmed.component.ts");
    /* harmony import */


    var _app_shared__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @ngx-translate/http-loader */
    "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs"); // AoT requires an exported function for factories


    function createTranslateLoader(http) {
      return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_13__["TranslateHttpLoader"](http, './assets/i18n/dashboard/', '.json');
    }

    var ThankyouModule = /*#__PURE__*/_createClass(function ThankyouModule() {
      _classCallCheck(this, ThankyouModule);
    });

    ThankyouModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_thankyoupageview_thankyoupageview_component__WEBPACK_IMPORTED_MODULE_6__["ThankyoupageviewComponent"], _approvechange_approvechange_component__WEBPACK_IMPORTED_MODULE_7__["ApprovechangeComponent"], _inviteexpired_inviteexpired_component__WEBPACK_IMPORTED_MODULE_8__["InviteexpiredComponent"], _registerationconfirmed_registerationconfirmed_component__WEBPACK_IMPORTED_MODULE_9__["RegisterationconfirmedComponent"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _thankyou_routing_module__WEBPACK_IMPORTED_MODULE_3__["ThankyouRoutingModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["ReactiveFormsModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__["FlexLayoutModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormsModule"], _app_shared__WEBPACK_IMPORTED_MODULE_10__["SharedModule"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__["TranslateModule"].forChild({
        loader: {
          provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__["TranslateLoader"],
          useFactory: createTranslateLoader,
          deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_12__["HttpClient"]]
        }
      })],
      exports: [_thankyoupageview_thankyoupageview_component__WEBPACK_IMPORTED_MODULE_6__["ThankyoupageviewComponent"], _approvechange_approvechange_component__WEBPACK_IMPORTED_MODULE_7__["ApprovechangeComponent"]]
    })], ThankyouModule);
    /***/
  },

  /***/
  "./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.scss":
  /*!***********************************************************************************!*\
    !*** ./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.scss ***!
    \***********************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesThankyouThankyoupageviewThankyoupageviewComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".contain {\n  height: calc(100vh - 65px);\n}\n\n#thankyoulistview {\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  flex-direction: column;\n  min-height: 623px;\n  text-align: center;\n}\n\n#thankyoulistview .notecolorrole {\n  padding-bottom: 20px;\n}\n\n#thankyoulistview .notecolorrole p {\n  color: #333333;\n  margin: 0px;\n  font-size: 0.875rem;\n}\n\n#thankyoulistview .notecolorrole p span {\n  color: #f4811f;\n}\n\n#thankyoulistview .successtick {\n  padding-bottom: 30px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n\n#thankyoulistview .successtick span {\n  height: 64px;\n  width: 64px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  border-radius: 100%;\n  background: #27a91d;\n  color: #fff;\n}\n\n#thankyoulistview .successtick span i {\n  font-size: 1.875rem;\n}\n\n#thankyoulistview .jsrscontactcolor {\n  padding-bottom: 20px;\n}\n\n#thankyoulistview .jsrscontactcolor h2 {\n  font-size: 1.125rem;\n  margin: 0px;\n  color: #27a91d;\n}\n\n#thankyoulistview .transfertextcolor p {\n  color: #333333;\n  font-size: 1rem;\n  margin: 0px;\n}\n\n#thankyoulistview .transfertextcolor p span {\n  font-family: \"cairosemibold\";\n}\n\n#thankyoulistview .loginbtn {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-top: 30px;\n}\n\n#thankyoulistview .loginbtn button {\n  background: #4AA2AD;\n  width: 160px;\n  color: #fff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy90aGFua3lvdS90aGFua3lvdXBhZ2V2aWV3L0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXHRoYW5reW91XFx0aGFua3lvdXBhZ2V2aWV3XFx0aGFua3lvdXBhZ2V2aWV3LmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3RoYW5reW91L3RoYW5reW91cGFnZXZpZXcvdGhhbmt5b3VwYWdldmlldy5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUE4QkE7RUFDSSwwQkFBQTtBQzdCSjs7QUQrQkE7RUFDSSxhQUFBO0VBQ0EsdUJBQUE7RUFDQSxtQkFBQTtFQUNBLHNCQUFBO0VBQ0EsaUJBQUE7RUFZQSxrQkFBQTtBQ3ZDSjs7QUQ0Qkk7RUFDSSxvQkFBQTtBQzFCUjs7QUQyQlM7RUFDRSxjQUFBO0VBQ0EsV0FBQTtFQUNBLG1CQUFBO0FDekJYOztBRDBCWTtFQUNBLGNBQUE7QUN4Qlo7O0FENkJJO0VBQ0ksb0JBQUE7RUFsREosYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7QUN3Qko7O0FEMEJRO0VBQ0ksWUFBQTtFQUNBLFdBQUE7RUF0RFIsYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7RUFzRFEsbUJBQUE7RUFDQSxtQkFBQTtFQUNBLFdBQUE7QUN0Qlo7O0FEdUJZO0VBQ0ksbUJBQUE7QUNyQmhCOztBRHlCSTtFQUNJLG9CQUFBO0FDdkJSOztBRHdCVztFQUNJLG1CQUFBO0VBQ0EsV0FBQTtFQUNBLGNBQUE7QUN0QmY7O0FEMEJVO0VBQ0ksY0FBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0FDeEJkOztBRHlCYztFQUNJLDRCQUFBO0FDdkJsQjs7QUQyQkk7RUFsRkEsYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7RUFrRkksZ0JBQUE7QUN2QlI7O0FEd0JTO0VBQ0ksbUJBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0VBekZULGFBQUE7RUFDQSx1QkFBQTtFQUNBLDhCQUFBO0FDb0VKIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy90aGFua3lvdS90aGFua3lvdXBhZ2V2aWV3L3RoYW5reW91cGFnZXZpZXcuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJcclxuQG1peGluIGZsZXhjZW50ZXIge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcblxyXG5AbWl4aW4gZmxleHN0YXJ0IHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbkBtaXhpbiBmbGV4ZW5kIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcblxyXG5AbWl4aW4gc3BhY2ViZXR3ZWVuIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG59XHJcblxyXG5AbWl4aW4gbWFyZ2luemVybyB7XHJcbiAgICBtYXJnaW46IDA7XHJcbiAgICB3aGl0ZS1zcGFjZTogbm9ybWFsICFpbXBvcnRhbnQ7XHJcbiAgICB0ZXh0LWFsaWduOiBsZWZ0O1xyXG4gIH1cclxuLmNvbnRhaW4ge1xyXG4gICAgaGVpZ2h0OiBjYWxjKDEwMHZoIC0gNjVweCk7XHJcbn1cclxuI3RoYW5reW91bGlzdHZpZXd7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjsgXHJcbiAgICBtaW4taGVpZ2h0OiA2MjNweDtcclxuICAgIC5ub3RlY29sb3Jyb2xle1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAyMHB4O1xyXG4gICAgICAgICBwe1xyXG4gICAgICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZjQ4MTFmO1xyXG4gICAgICAgICAgIH1cclxuICAgICAgICAgfVxyXG4gICAgICB9ICAgICAgXHJcbiAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAuc3VjY2Vzc3RpY2sge1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xyXG4gICAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgaGVpZ2h0OiA2NHB4O1xyXG4gICAgICAgICAgICB3aWR0aDogNjRweDtcclxuICAgICAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAxMDAlO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiMyN2E5MWQ7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICBpIHtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMS44NzVyZW07XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuanNyc2NvbnRhY3Rjb2xvcntcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMjBweDtcclxuICAgICAgICAgICBoMntcclxuICAgICAgICAgICAgICAgZm9udC1zaXplOiAxLjEyNXJlbTtcclxuICAgICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgICAgIGNvbG9yOiAjMjdhOTFkO1xyXG4gICAgICAgICAgIH1cclxuICAgIH1cclxuICAgIC50cmFuc2ZlcnRleHRjb2xvcntcclxuICAgICAgICAgIHB7XHJcbiAgICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgICAgZm9udC1zaXplOiAxcmVtO1xyXG4gICAgICAgICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICAgICAgIGZvbnQtZmFtaWx5OiAnY2Fpcm9zZW1pYm9sZCc7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmxvZ2luYnRue1xyXG4gICAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgICAgICBtYXJnaW4tdG9wOiAzMHB4O1xyXG4gICAgICAgICBidXR0b257XHJcbiAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjNEFBMkFEO1xyXG4gICAgICAgICAgICAgd2lkdGg6IDE2MHB4O1xyXG4gICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyO1xyXG4gICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuIiwiLmNvbnRhaW4ge1xuICBoZWlnaHQ6IGNhbGMoMTAwdmggLSA2NXB4KTtcbn1cblxuI3RoYW5reW91bGlzdHZpZXcge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcbiAgbWluLWhlaWdodDogNjIzcHg7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5ub3RlY29sb3Jyb2xlIHtcbiAgcGFkZGluZy1ib3R0b206IDIwcHg7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAubm90ZWNvbG9ycm9sZSBwIHtcbiAgY29sb3I6ICMzMzMzMzM7XG4gIG1hcmdpbjogMHB4O1xuICBmb250LXNpemU6IDAuODc1cmVtO1xufVxuI3RoYW5reW91bGlzdHZpZXcgLm5vdGVjb2xvcnJvbGUgcCBzcGFuIHtcbiAgY29sb3I6ICNmNDgxMWY7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuc3VjY2Vzc3RpY2sge1xuICBwYWRkaW5nLWJvdHRvbTogMzBweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5zdWNjZXNzdGljayBzcGFuIHtcbiAgaGVpZ2h0OiA2NHB4O1xuICB3aWR0aDogNjRweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYm9yZGVyLXJhZGl1czogMTAwJTtcbiAgYmFja2dyb3VuZDogIzI3YTkxZDtcbiAgY29sb3I6ICNmZmY7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuc3VjY2Vzc3RpY2sgc3BhbiBpIHtcbiAgZm9udC1zaXplOiAxLjg3NXJlbTtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5qc3JzY29udGFjdGNvbG9yIHtcbiAgcGFkZGluZy1ib3R0b206IDIwcHg7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuanNyc2NvbnRhY3Rjb2xvciBoMiB7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIG1hcmdpbjogMHB4O1xuICBjb2xvcjogIzI3YTkxZDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC50cmFuc2ZlcnRleHRjb2xvciBwIHtcbiAgY29sb3I6ICMzMzMzMzM7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbiAgbWFyZ2luOiAwcHg7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAudHJhbnNmZXJ0ZXh0Y29sb3IgcCBzcGFuIHtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9zZW1pYm9sZFwiO1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmxvZ2luYnRuIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMzBweDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5sb2dpbmJ0biBidXR0b24ge1xuICBiYWNrZ3JvdW5kOiAjNEFBMkFEO1xuICB3aWR0aDogMTYwcHg7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.ts":
  /*!*********************************************************************************!*\
    !*** ./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.ts ***!
    \*********************************************************************************/

  /*! exports provided: ThankyoupageviewComponent */

  /***/
  function srcAppModulesThankyouThankyoupageviewThankyoupageviewComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ThankyoupageviewComponent", function () {
      return ThankyoupageviewComponent;
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

    var ThankyoupageviewComponent = /*#__PURE__*/function () {
      function ThankyoupageviewComponent(router, translate, remoteService, cookieService) {
        _classCallCheck(this, ThankyoupageviewComponent);

        this.router = router;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
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
        this.dir = 'ltr';
      }

      _createClass(ThankyoupageviewComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this9 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this9.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect10 = this.languagelist.find(function (c) {
              return c.id == '1';
            });

            this.cookieService.set('languageCookieId', _toSelect10.id);
            this.cookieService.set('languageCode', _toSelect10.languagecode);
            this.cookieService.set('dir', _toSelect10.dir);
            this.translate.setDefaultLang(_toSelect10.languagecode);
            this.dir = _toSelect10.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this9.translate.setDefaultLang(_this9.cookieService.get('languageCode'));

            if (_this9.cookieService.get('languageCookieId') && _this9.cookieService.get('languageCookieId') != undefined && _this9.cookieService.get('languageCookieId') != null) {
              var _toSelect11 = _this9.languagelist.find(function (c) {
                return c.id === _this9.cookieService.get('languageCookieId');
              });

              _this9.translate.setDefaultLang(_toSelect11.languagecode);

              _this9.dir = _toSelect11.dir;
            } else {
              var _toSelect12 = _this9.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this9.translate.setDefaultLang(_toSelect12.languagecode);

              _this9.dir = _toSelect12.dir;
            }
          });
        }
      }, {
        key: "navigate",
        value: function navigate() {
          this.router.navigate(['/admin/login']);
        }
      }]);

      return ThankyoupageviewComponent;
    }();

    ThankyoupageviewComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_4__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__["CookieService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('type'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], ThankyoupageviewComponent.prototype, "type", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('oldUser'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], ThankyoupageviewComponent.prototype, "oldUser", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('newUser'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], ThankyoupageviewComponent.prototype, "newUser", void 0);
    ThankyoupageviewComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-thankyoupageview',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./thankyoupageview.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./thankyoupageview.component.scss */
      "./src/app/modules/thankyou/thankyoupageview/thankyoupageview.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_4__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_5__["CookieService"]])], ThankyoupageviewComponent);
    /***/
  }
}]);
//# sourceMappingURL=modules-thankyou-thankyou-module-es5.js.map