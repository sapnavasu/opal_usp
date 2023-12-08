function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-transactionstatus-transactionstatus-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.html":
  /*!**********************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.html ***!
    \**********************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesTransactionstatusTransactionlandingpageTransactionlandingpageComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div class=\"headerstylings\">\r\n    <div class=\"topheaderimage\">\r\n        <div class=\"completebanner\">\r\n            <div class=\"leftsiddebanner\">\r\n                <div class=\"makeitright p-t-40 m-l-60\">\r\n                    <img src=\"assets/images/JSRSlogologin.png\" alt=\"OPAL logo\">\r\n                </div>\r\n            </div>\r\n            <div class=\"rightsidebanner\">\r\n                <div class=\"innerrightbanner\">\r\n                    <div class=\"textalignend m-b-10 m-t-22\">\r\n                        <p class=\"helplinect fs-16  lypisfont-bold p-l-10 m-0\">Sultanate of Oman</p>\r\n                        <img src=\"assets/images/flags/31.png\" alt=\"lybiyaflagimage\">\r\n                    </div>\r\n                    <img class=\"flaglypis\" src=\"assets/images/Flagbig.png\" alt=\"Country Flag\">\r\n                    <div class=\"regcontentbanner\">\r\n                        <div class=\"leftregcontrent position\">\r\n                            <mat-list class=\"menulistitems\" role=\"list\">\r\n                                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\"><i\r\n                                            class=\"bgi bgi-home\" matTooltip=\"Home\" matTooltipPosition=\"below\"></i></a>\r\n                                </mat-list-item>\r\n                                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">About</a></mat-list-item>\r\n                                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">Platforms</a>\r\n                                </mat-list-item>\r\n                                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">Media </a></mat-list-item>\r\n                                <mat-list-item role=\"listitem\"><a href=\"javascript:void(0)\">Contact</a></mat-list-item>\r\n                                <!-- <mat-list-item class=\"forsearchitem\" role=\"listitem\"><a href=\"javascript:void(0)\">\r\n                        <i class=\"bgi bgi-search\"></i>\r\n                      </a></mat-list-item> -->\r\n                            </mat-list>\r\n                        </div>\r\n                        <div class=\"rightregcontent\">\r\n                            <button disabled type=\"button\" routerLink=\"/registration/index\" mat-raised-button\r\n                                color=\"primary\" class=\"registerbtn m-r-15 lh-1\">Register</button>\r\n                            <button type=\"button\" routerLink=\"/admin/login\" mat-raised-button color=\"primary\"\r\n                                class=\"loginbutton lh-1\">Login</button>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <app-responseloader class=\"processloader\" *ngIf=\"showLoader\"></app-responseloader>\r\n    <app-transactionsucess [error_type]=\"error_type\" [pymtResponseDtls]=\"responseData\" [classification]=\"classification\" [country]=\"country\" [module]=\"module\" [sameUser]=\"sameUser\"></app-transactionsucess>\r\n    <div class=\"regfooter\">\r\n        <div class=\"login_footer\" fxFlex=\"100\" fxFlex.gt-xs=\"90\" fxFlex.gt-md=\"83.33\">\r\n            <div class=\"login_footer_left\" fxHide=\"true\" fxHide.gt-md='false'>\r\n                <ul>\r\n                    <li>\r\n                        <a href=\"#\">Terms of Service</a>\r\n                    </li>\r\n                    <li>\r\n                        <a href=\"#\">Privacy Policy</a>\r\n                    </li>\r\n                    <li>\r\n                        <a href=\"#\">Help Center</a>\r\n                    </li>\r\n                    <li>\r\n                        <a href=\"#\" class=\"m-r-20\"><i class=\"bgi bgi-facebook\" aria-hidden=\"true\"></i></a>\r\n                        <a href=\"#\" class=\"m-r-20\"><i class=\"bgi bgi-twitter\" aria-hidden=\"true\"></i></a>\r\n                        <a href=\"#\"><i class=\"bgi bgi-instagram\" aria-hidden=\"true\"></i></a>\r\n                    </li>\r\n                </ul>\r\n            </div>\r\n            <div class=\"login_footer_right\">\r\n                <span>All Rights Reserved &copy; Business Gateways International 2022.</span>\r\n            </div>\r\n            <div class=\"drivenalign\">\r\n                <P class=\"fs-14 m-0 p-t-38\">Driven by </P>\r\n                <img src=\"assets/images/bgi.svg\" alt=\"Business Gateways International\">\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.html":
  /*!************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.html ***!
    \************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesTransactionstatusTransactionsucessTransactionsucessComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" *ngIf=\"paymentStatusPage\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"thankyoulistview\">\r\n        <div class=\"thankyouinnerpart\" *ngIf=\"paymentStatus==1\">\r\n            <div class=\"successtick\">\r\n                <img src=\"assets/images/ticksymbol.svg\" alt=\"ticksymbol\">\r\n            </div>\r\n            <div class=\"jsrscontactcolor p-b-15\">\r\n                <h2>Transaction Successful</h2>\r\n            </div>\r\n            <div class=\"transfertextcolor\">\r\n                <p class=\"p-b-30\">Thank you for completing your payment. Here are the details.</p>\r\n                <h4 class=\"txt-gray6 fs-16 m-0 lypisfont-semibold p-b-20\">Payment Ref. No.: <span\r\n                        class=\"txt-gray3 m-0\">{{pymtResponseDtls?.ref_no}}</span></h4>\r\n                <p *ngIf=\"sameUser\" class=\"m-0 p-b-6 clickherecolor\">Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to view your payment details.</p>\r\n                <p *ngIf=\"!sameUser\" class=\"m-0 p-b-6 clickherecolor\">Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to login and view your payment details.</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"thankyouinnerpart\" *ngIf=\"paymentStatus==2\">\r\n            <div class=\"successtick\">\r\n                <img src=\"assets/images/alertnewtag.svg\" alt=\"alertnewtag\">\r\n            </div>\r\n            <div class=\"jsrscontactcolor p-b-15\">\r\n                <h2 class=\"awaitingcolor\">Awaiting payment transaction status</h2>\r\n            </div>\r\n            <div class=\"transfertextcolor\">\r\n                <p class=\"p-b-10\">We will authenticate your transaction and confirm your status at the earliest.</p>\r\n                <p class=\"p-b-30\">Please contact <span class=\"txt-blue lypisfont-regular\">accounts@businessgateways.com / +968 24166123, </span> if you need further assistance.</p>\r\n                <h4 class=\"txt-gray6 fs-16 m-0 lypisfont-semibold p-b-20\">Payment Ref. No.: <span\r\n                        class=\"txt-gray3 m-0\">{{pymtResponseDtls?.ref_no}}</span></h4>\r\n                <p *ngIf=\"sameUser\" class=\"m-0 p-b-6 clickherecolor\">Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to view your payment details.</p>\r\n                <p *ngIf=\"!sameUser\" class=\"m-0 p-b-6 clickherecolor\">Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to login and view your payment details.</p>\r\n            </div>\r\n        </div> \r\n        <div class=\"thankyouinnerpart\" *ngIf=\"paymentStatus==8\">\r\n            <div class=\"successtick crossimg\">\r\n                <img src=\"assets/images/CROSS.svg\" alt=\"CROSS\">\r\n            </div>\r\n            <div class=\"jsrscontactcolor p-b-15\">\r\n                <h2 class=\"awaitingcolor\">Transaction Cancelled</h2>\r\n            </div>\r\n            <div class=\"transfertextcolor\">\r\n                <p class=\"p-b-30\">You have chosen 'Cancel' option during payment.</p>\r\n                <!-- <h4 class=\"txt-gray6 fs-16 m-0 lypisfont-semibold p-b-20\">Payment Ref. No.: <span\r\n                        class=\"txt-gray3 m-0\">{{pymtResponseDtls?.ref_no}}</span></h4> -->\r\n                <p *ngIf=\"sameUser\" class=\"m-0 p-b-6 clickherecolor\">Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to make payment.</p>\r\n                <p *ngIf=\"!sameUser\" class=\"m-0 p-b-6 clickherecolor\">Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to make payment.</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"thankyouinnerpart\" *ngIf=\"paymentStatus==6\">\r\n            <div class=\"successtick crossimg\">\r\n                <img src=\"assets/images/CROSS.svg\" alt=\"CROSS\">\r\n            </div>\r\n            <div class=\"jsrscontactcolor p-b-15\">\r\n                <h2 class=\"awaitingcolor\">Transaction Failed</h2>\r\n            </div>\r\n            <div class=\"transfertextcolor\">                \r\n                <h4 class=\"txt-gray6 fs-16 m-0 lypisfont-semibold p-b-20\">Payment Ref. No.: <span\r\n                        class=\"txt-gray3 m-0\">{{pymtResponseDtls?.ref_no}}</span></h4>\r\n                <p *ngIf=\"sameUser\" class=\"m-0 p-b-6 clickherecolor\">There is an error occurred during the Payment. Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to make payment.</p>\r\n                <p *ngIf=\"!sameUser\" class=\"m-0 p-b-6 clickherecolor\">There is an error occurred during the Payment. Click <a class=\"bgi-orange fs-15\" [routerLink]=\"[redirectto]\">here</a> to make payment.</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"thankyouinnerpart\" *ngIf=\"error_type\">\r\n            <div class=\"successtick crossimg\">\r\n                <img src=\"assets/images/CROSS.svg\" alt=\"CROSS\">\r\n            </div>\r\n            <div class=\"jsrscontactcolor p-b-15\">\r\n                <h2 *ngIf=\"error_type == 1\" class=\"awaitingcolor\">Link expired, Please download file again</h2>\r\n                <h2 *ngIf=\"error_type == 2\" class=\"awaitingcolor\">File not Available</h2>\r\n            </div> \r\n        </div> \r\n        <div fxLayout=\"row wrap\" class=\"transcationcard\" *ngIf=\"!error_type\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                <h4 class=\"fs-16 m-0 txt-blue leftspace p-b-20\">Company Information</h4>\r\n                <div class=\"flexinfo\">\r\n                    <div class=\"card_icon\">\r\n                        <img src=\"{{pymtResponseDtls?.image_url}}\" alt=\"\">\r\n                    </div>\r\n                    <div class=\"headingalign w-100\">\r\n                        <h3 class=\"fs-15 txt-gray3 lh-35\">{{pymtResponseDtls?.comp_name}}</h3>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"15\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">NBF Number</p>\r\n                                <span class=\"txt-black lypisfont-regular fs-15\">{{pymtResponseDtls?.nbf_no}}</span>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"15\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Country</p>\r\n                                <span class=\"txt-black lypisfont-regular fs-15\">{{country}}</span>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"15\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Classification</p>\r\n                                <span class=\"msme_micro\" *ngIf=\"classification=='SME-Micro'\">{{classification}}</span>\r\n                                <span class=\"msme_small\" *ngIf=\"classification=='SME-Small'\">{{classification}}</span>\r\n                                <span class=\"msme_medium\" *ngIf=\"classification=='SME-Medium'\">{{classification}}</span>\r\n                                <span class=\"msme_large\" *ngIf=\"classification=='Non-SME'\">{{classification}}</span>\r\n                                <span class=\"msme_large\" *ngIf=\"classification=='International'\">{{classification}}</span>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"transcationcard p-t-0\" *ngIf=\"!error_type\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                <h4 class=\"fs-16 m-0 txt-blue leftspace p-b-20\">Payment Information</h4>\r\n                <div class=\"d-flex\">\r\n                    <div class=\"headingalign w-100 paymentinfo\">\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"16.6666\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Payment Made through</p>\r\n                                <span *ngIf=\"pymtResponseDtls?.card_type=='OTO'\" class=\"txt-black lypisfont-regular fs-15\">Ottu (Debit Card)</span>\r\n                                <span *ngIf=\"pymtResponseDtls?.card_type=='OTC'\" class=\"txt-black lypisfont-regular fs-15\">Ottu (Credit Card)</span>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"16.6666\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Payment Date</p>\r\n                                <span class=\"txt-black lypisfont-regular fs-15\">{{pymtResponseDtls?.trans_date}}</span>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"16.6666\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Payment Ref. No.</p>\r\n                                <span class=\"txt-black lypisfont-regular fs-15\">{{pymtResponseDtls?.ref_no}}</span>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"16.6666\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Payment status</p>\r\n                                <span class=\"largenew\" *ngIf=\"paymentStatus==1\" >Success</span>\r\n                                <span class=\"paymentinprogress\" *ngIf=\"paymentStatus==2\" >Payment In-progress</span> \r\n                                <span class=\"cancel\" *ngIf=\"paymentStatus==8\" >Cancelled</span>\r\n                                <span class=\"cancel\" *ngIf=\"paymentStatus==6\" >Failed</span>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"16.6666\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Subscription for</p>\r\n                                <span *ngIf=\"module=='REG'\" class=\"txt-black lypisfont-regular fs-15\">OPAL Registration</span>\r\n                                <span *ngIf=\"module=='RENEW'\" class=\"txt-black lypisfont-regular fs-15\">OPAL Renewal</span>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"16.6666\" fxFlex=\"100\" class=\"leftspace\">\r\n                                <p class=\"txt-blue lypisfont-regular fs-14 m-0 p-b-6\">Amount Paid</p>\r\n                                <span class=\"txt-black lypisfont-regular fs-15\">OMR {{pymtResponseDtls?.amount}}</span>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<app-responseloader class=\"processloader\"  *ngIf=\"showLoader\"></app-responseloader>";
    /***/
  },

  /***/
  "./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.scss":
  /*!********************************************************************************************************!*\
    !*** ./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.scss ***!
    \********************************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesTransactionstatusTransactionlandingpageTransactionlandingpageComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".headerstylings {\n  background: #f2f3f7 !important;\n  position: relative;\n}\n.headerstylings .headerimage {\n  text-align: center;\n}\n.headerstylings .headerimage img {\n  width: 150px;\n  height: 150px;\n  margin-top: 100px;\n}\n.headerstylings .headerimage h4 {\n  color: #333333;\n}\n.headerstylings .regfooter {\n  min-height: 95px;\n  align-items: flex-end;\n  padding-bottom: 20px;\n}\n.headerstylings .regfooter .login_footer {\n  display: flex;\n  justify-content: space-between;\n  background: transparent;\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 94% !important;\n  align-items: center;\n}\n.headerstylings .regfooter .login_footer .login_footer_left ul li a {\n  color: #333 !important;\n  display: flex;\n  align-items: center;\n  font-size: 15px !important;\n}\n.headerstylings .regfooter .login_footer_right span {\n  color: #333 !important;\n  font-size: 15px !important;\n}\n.headerstylings .regfooter .drivenalign {\n  display: flex;\n  align-items: flex-end;\n  margin-top: -40px;\n}\n.headerstylings .regfooter .drivenalign p {\n  color: #333;\n  padding-right: 10px;\n}\n.headerstylings .regfooter .drivenalign img {\n  height: 40px;\n}\n.headerstylings .tablbelicon i {\n  font-size: 3.125rem;\n}\n.headerstylings .topheaderimage img {\n  max-width: 82%;\n}\n.headerstylings .completebanner {\n  display: flex;\n  justify-content: center;\n  min-height: 275px;\n  background-color: #e0f0ff;\n}\n.headerstylings .completebanner .backtohome {\n  display: block;\n}\n.headerstylings .completebanner .regcontentbanner {\n  display: flex;\n  max-width: 100%;\n  justify-content: space-between;\n}\n.headerstylings .completebanner .regcontentbanner .rightregcontent {\n  text-align: center;\n}\n.headerstylings .completebanner .leftsiddebanner {\n  width: 20%;\n  background: #fff;\n}\n.headerstylings .completebanner .leftsiddebanner .welcomelybia {\n  color: #333;\n  font-size: 0.875rem;\n  text-align: center;\n  padding-top: 5px;\n}\n.headerstylings .completebanner .leftsiddebanner .logoandgoback {\n  height: 18%;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.headerstylings .completebanner .leftsiddebanner .logoandgoback .backtohome {\n  color: #333;\n  font-size: 0.875rem;\n  position: relative;\n  top: 32px;\n  display: flex;\n  align-items: center;\n  cursor: pointer;\n}\n.headerstylings .completebanner .leftsiddebanner .logoandgoback .backtohome i {\n  padding-right: 6px;\n  font-size: 0.625rem;\n}\n.headerstylings .completebanner .rightsidebanner {\n  width: 80%;\n  background-repeat: no-repeat;\n  background-image: url('http://192.168.1.200:82/opal_usp/app/assets/images/globenew.png');\n  background-position: right 0px top 120px;\n  background-size: contain;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner {\n  position: relative;\n  max-width: 96%;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner p {\n  color: #fff;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .helplinect {\n  color: #666;\n  padding-right: 10px;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .leftregcontrent {\n  width: 100%;\n  justify-content: flex-end;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .leftregcontrent .header {\n  color: #f1f2f7;\n  font-size: 1.625rem;\n  font-weight: bold;\n  margin-bottom: 10px;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .leftregcontrent .submitprofile {\n  color: #8ebae6;\n  font-size: 0.9375rem;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .rightregcontent {\n  display: flex;\n  align-items: center;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .rightregcontent .loginbutton {\n  color: #fff;\n  font-size: 0.9375rem;\n  background: #ef8436;\n  width: 85px;\n  height: 30px;\n  border-radius: 50px !important;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.headerstylings .completebanner .rightsidebanner .innerrightbanner .rightregcontent .registerbtn {\n  background-color: #006db7;\n  color: #fff;\n  width: 98px;\n  height: 30px;\n  font-size: 0.9375rem;\n  border-radius: 50px !important;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n.headerstylings .completebanner .rightsidebanner .flaglypis {\n  left: 0;\n  position: absolute;\n  top: 0;\n}\n.headerstylings .topheaderimage {\n  min-height: 175px;\n}\n.headerstylings .newcardright {\n  text-align: center;\n}\n.headerstylings .newcardright .explorer {\n  color: #006db7;\n  font-size: 1.125rem;\n  font-weight: bold;\n  padding-bottom: 10px;\n}\n.headerstylings .newcardright img {\n  padding-top: 25px;\n  padding-bottom: 25px;\n  max-width: 90px;\n  margin-left: auto;\n  margin-right: auto;\n}\n.headerstylings .position {\n  display: flex;\n  padding-top: 0px;\n  padding-left: 100px;\n}\n.headerstylings .position span {\n  padding-right: 44px;\n  color: #fff;\n}\n.headerstylings .circleimage img {\n  margin-top: -6px;\n}\n@media (max-width: 768px) {\n  .completebanner {\n    min-height: 320px !important;\n  }\n\n  .completebanner .regcontentbanner {\n    max-width: 100% !important;\n    display: block !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .leftregcontrent {\n    width: 100% !important;\n    padding-left: 60px;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner {\n    position: relative;\n    height: 100%;\n    max-width: 95% !important;\n  }\n\n  .completebanner .leftsiddebanner {\n    width: 30%;\n    background: #fff;\n  }\n\n  .completebanner .rightsidebanner {\n    width: 70%;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .helplinect {\n    padding-right: 15px;\n  }\n\n  .bottominfo {\n    margin-left: auto;\n    flex-direction: row-reverse;\n    max-width: 95%;\n    margin-top: -30px;\n    margin-right: auto;\n    padding-bottom: 30px;\n  }\n\n  .position {\n    position: relative;\n    display: flex;\n    padding-top: 0px;\n    flex-flow: row wrap;\n  }\n\n  .completebanner .regcontentbanner .rightregcontent {\n    display: flex;\n    justify-content: flex-end;\n    margin-top: 15px;\n  }\n}\n@media (max-width: 1024px) and (min-width: 769px) {\n  .completebanner {\n    min-height: 290px !important;\n  }\n\n  .bottominfo {\n    margin-left: auto;\n    display: flex;\n    max-width: 95%;\n    margin-top: -30px;\n    margin-right: auto;\n    padding-bottom: 30px;\n  }\n\n  .completebanner .leftsiddebanner {\n    width: 30%;\n    background: #fff;\n  }\n\n  .completebanner .rightsidebanner {\n    width: 70%;\n  }\n\n  .position {\n    position: relative;\n    display: flex;\n    padding-top: 0px;\n    flex-flow: row wrap;\n  }\n\n  .completebanner .regcontentbanner .rightregcontent {\n    display: flex;\n    justify-content: flex-end;\n  }\n\n  .completebanner .regcontentbanner {\n    max-width: 100% !important;\n    display: block !important;\n  }\n}\n@media (max-width: 767px) {\n  .textalignend {\n    padding-top: 20px !important;\n  }\n\n  .header {\n    font-size: 26px !important;\n  }\n\n  .makeitright {\n    margin-left: 0px !important;\n  }\n\n  .circleimage {\n    padding-top: 4px;\n  }\n  .circleimage img {\n    max-width: 72% !important;\n  }\n\n  .bottominfo {\n    margin-left: auto;\n    display: block !important;\n    max-width: 95%;\n    margin-top: -30px;\n    margin-right: auto;\n    padding-bottom: 30px;\n  }\n\n  .leftisideinfo {\n    width: auto !important;\n    margin-right: 0px !important;\n  }\n\n  .rightsideinfo {\n    width: 304px !important;\n    margin-left: 0px !important;\n    margin-top: 10px;\n  }\n\n  .completebanner {\n    justify-content: center;\n    min-height: 175px;\n  }\n\n  .completebanner .leftsiddebanner {\n    width: 100%;\n    background: #fff;\n    min-height: 170px !important;\n  }\n\n  .completebanner .leftsiddebanner .logoandgoback {\n    width: 100%;\n    height: 60%;\n    display: block !important;\n    align-items: center;\n    justify-content: center;\n  }\n\n  .rightsidebanner {\n    width: 100% !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner {\n    position: relative;\n    height: 100%;\n    max-width: 100% !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .leftregcontrent {\n    width: 100% !important;\n    padding-left: 60px;\n  }\n\n  .completebanner .regcontentbanner {\n    display: block !important;\n    max-width: 100% !important;\n    justify-content: space-between;\n    padding-top: 0px !important;\n  }\n\n  .makeitright {\n    text-align: center;\n  }\n\n  .completebanner .leftsiddebanner .logoandgoback .backtohome {\n    display: flex;\n    align-items: center;\n    justify-content: center;\n  }\n\n  .completebanner .regcontentbanner .rightregcontent {\n    text-align: center;\n    margin-bottom: 112px;\n    margin-right: 22px;\n  }\n\n  .submitprofile {\n    margin-bottom: 0px !important;\n  }\n\n  .completebanner .rightsidebanner .innerrightbanner .helplinect {\n    padding-right: 15px;\n  }\n}\n.leftregcontrent span {\n  color: #424549;\n}\n.circleimage img {\n  color: #424549;\n}\n.textalignend {\n  display: flex;\n  align-items: center;\n  justify-content: flex-end;\n}\n.textalignend img {\n  width: 30px;\n  height: 20px;\n}\n@media (max-width: 1400px) {\n  .completebanner .rightsidebanner .innerrightbanner {\n    position: relative;\n    height: 100%;\n    max-width: 98% !important;\n  }\n\n  .position {\n    display: flex;\n    padding-top: 0px;\n    padding-left: 92px !important;\n  }\n  .position span {\n    padding-right: 32px !important;\n  }\n}\n.menulistitems {\n  display: flex;\n  margin: 0;\n  padding: 0;\n}\n.menulistitems .mat-list-item {\n  margin-right: 15px;\n}\n.menulistitems .mat-list-item a {\n  color: #333;\n  font-size: 0.9375rem;\n}\n.menulistitems .forsearchitem a {\n  width: 30px;\n  height: 30px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  border: 1px solid #555;\n  border-radius: 50%;\n  padding: 7px;\n}\n.menulistitems .forsearchitem a i {\n  color: #555;\n  color: #555;\n  font-size: 0.9375rem;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy90cmFuc2FjdGlvbnN0YXR1cy90cmFuc2FjdGlvbmxhbmRpbmdwYWdlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXHRyYW5zYWN0aW9uc3RhdHVzXFx0cmFuc2FjdGlvbmxhbmRpbmdwYWdlXFx0cmFuc2FjdGlvbmxhbmRpbmdwYWdlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3RyYW5zYWN0aW9uc3RhdHVzL3RyYW5zYWN0aW9ubGFuZGluZ3BhZ2UvdHJhbnNhY3Rpb25sYW5kaW5ncGFnZS5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtFQUNJLDhCQUFBO0VBQ0Esa0JBQUE7QUNDSjtBREFJO0VBQ0ksa0JBQUE7QUNFUjtBRERRO0VBQ0ksWUFBQTtFQUNBLGFBQUE7RUFDQSxpQkFBQTtBQ0daO0FERFE7RUFDSSxjQUFBO0FDR1o7QURBSTtFQUNJLGdCQUFBO0VBQ0EscUJBQUE7RUFDQSxvQkFBQTtBQ0VSO0FERFE7RUFDSSxhQUFBO0VBQ0EsOEJBQUE7RUFDQSx1QkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSx5QkFBQTtFQUNBLG1CQUFBO0FDR1o7QUREUTtFQUNJLHNCQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsMEJBQUE7QUNHWjtBREFZO0VBQ0ksc0JBQUE7RUFDQSwwQkFBQTtBQ0VoQjtBRENRO0VBQ0ksYUFBQTtFQUNBLHFCQUFBO0VBQ0EsaUJBQUE7QUNDWjtBREFZO0VBQ0ksV0FBQTtFQUNBLG1CQUFBO0FDRWhCO0FEQVk7RUFDSSxZQUFBO0FDRWhCO0FER1E7RUFDSSxtQkFBQTtBQ0RaO0FES1E7RUFDSSxjQUFBO0FDSFo7QURNSTtFQUNJLGFBQUE7RUFDQSx1QkFBQTtFQUNBLGlCQUFBO0VBQ0EseUJBQUE7QUNKUjtBREtRO0VBQ0ksY0FBQTtBQ0haO0FES1E7RUFDSSxhQUFBO0VBQ0EsZUFBQTtFQUNBLDhCQUFBO0FDSFo7QURJWTtFQUNJLGtCQUFBO0FDRmhCO0FES1E7RUFDSSxVQUFBO0VBQ0EsZ0JBQUE7QUNIWjtBRElZO0VBQ0ksV0FBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxnQkFBQTtBQ0ZoQjtBRElZO0VBQ0ksV0FBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDRmhCO0FER2dCO0VBQ0ksV0FBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxTQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsZUFBQTtBQ0RwQjtBREVvQjtFQUNJLGtCQUFBO0VBQ0EsbUJBQUE7QUNBeEI7QURLUTtFQUNJLFVBQUE7RUFDQSw0QkFBQTtFQUNBLHdGQUFBO0VBQ0Esd0NBQUE7RUFDQSx3QkFBQTtBQ0haO0FESVk7RUFDSSxrQkFBQTtFQUNBLGNBQUE7QUNGaEI7QURHZ0I7RUFDSSxXQUFBO0FDRHBCO0FER2dCO0VBQ0ksV0FBQTtFQUNBLG1CQUFBO0FDRHBCO0FER2dCO0VBQ0ksV0FBQTtFQUNBLHlCQUFBO0FDRHBCO0FERW9CO0VBQ0ksY0FBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7RUFDQSxtQkFBQTtBQ0F4QjtBREVvQjtFQUNJLGNBQUE7RUFDQSxvQkFBQTtBQ0F4QjtBREdnQjtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ0RwQjtBREVvQjtFQUNJLFdBQUE7RUFDQSxvQkFBQTtFQUNBLG1CQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSw4QkFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FDQXhCO0FERW9CO0VBQ0kseUJBQUE7RUFDQSxXQUFBO0VBQ0EsV0FBQTtFQUNBLFlBQUE7RUFDQSxvQkFBQTtFQUNBLDhCQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBQUE7QUNBeEI7QURJWTtFQUNJLE9BQUE7RUFDQSxrQkFBQTtFQUNBLE1BQUE7QUNGaEI7QURPSTtFQUNJLGlCQUFBO0FDTFI7QURRSTtFQUNJLGtCQUFBO0FDTlI7QURPUTtFQUNJLGNBQUE7RUFDQSxtQkFBQTtFQUNBLGlCQUFBO0VBQ0Esb0JBQUE7QUNMWjtBRE9RO0VBQ0ksaUJBQUE7RUFDQSxvQkFBQTtFQUNBLGVBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0FDTFo7QURTSTtFQUNJLGFBQUE7RUFDQSxnQkFBQTtFQUNBLG1CQUFBO0FDUFI7QURRUTtFQUNJLG1CQUFBO0VBQ0EsV0FBQTtBQ05aO0FEVVE7RUFDSSxnQkFBQTtBQ1JaO0FEYUE7RUFDSTtJQUNJLDRCQUFBO0VDVk47O0VEWUU7SUFDSSwwQkFBQTtJQUNBLHlCQUFBO0VDVE47O0VEV0U7SUFDSSxzQkFBQTtJQUNBLGtCQUFBO0VDUk47O0VEVUU7SUFDSSxrQkFBQTtJQUNBLFlBQUE7SUFDQSx5QkFBQTtFQ1BOOztFRFNFO0lBQ0ksVUFBQTtJQUNBLGdCQUFBO0VDTk47O0VEUUU7SUFDSSxVQUFBO0VDTE47O0VET0U7SUFDSSxtQkFBQTtFQ0pOOztFRE9FO0lBQ0ksaUJBQUE7SUFDQSwyQkFBQTtJQUNBLGNBQUE7SUFDQSxpQkFBQTtJQUNBLGtCQUFBO0lBQ0Esb0JBQUE7RUNKTjs7RURNRTtJQUNJLGtCQUFBO0lBQ0EsYUFBQTtJQUNBLGdCQUFBO0lBQ0EsbUJBQUE7RUNITjs7RURLRTtJQUNJLGFBQUE7SUFDQSx5QkFBQTtJQUNBLGdCQUFBO0VDRk47QUFDRjtBRElBO0VBQ0k7SUFDSSw0QkFBQTtFQ0ZOOztFREtFO0lBQ0ksaUJBQUE7SUFDQSxhQUFBO0lBQ0EsY0FBQTtJQUNBLGlCQUFBO0lBQ0Esa0JBQUE7SUFDQSxvQkFBQTtFQ0ZOOztFRElFO0lBQ0ksVUFBQTtJQUNBLGdCQUFBO0VDRE47O0VER0U7SUFDSSxVQUFBO0VDQU47O0VERUU7SUFDSSxrQkFBQTtJQUNBLGFBQUE7SUFDQSxnQkFBQTtJQUNBLG1CQUFBO0VDQ047O0VEQ0U7SUFDSSxhQUFBO0lBQ0EseUJBQUE7RUNFTjs7RURBRTtJQUNJLDBCQUFBO0lBQ0EseUJBQUE7RUNHTjtBQUNGO0FEREE7RUFDSTtJQUNJLDRCQUFBO0VDR047O0VEREU7SUFDSSwwQkFBQTtFQ0lOOztFREZFO0lBQ0ksMkJBQUE7RUNLTjs7RURIRTtJQUNJLGdCQUFBO0VDTU47RURMTTtJQUNJLHlCQUFBO0VDT1Y7O0VESEU7SUFDSSxpQkFBQTtJQUNBLHlCQUFBO0lBQ0EsY0FBQTtJQUNBLGlCQUFBO0lBQ0Esa0JBQUE7SUFDQSxvQkFBQTtFQ01OOztFREpFO0lBQ0ksc0JBQUE7SUFDQSw0QkFBQTtFQ09OOztFRExFO0lBQ0ksdUJBQUE7SUFDQSwyQkFBQTtJQUNBLGdCQUFBO0VDUU47O0VETEU7SUFDSSx1QkFBQTtJQUNBLGlCQUFBO0VDUU47O0VETEU7SUFDSSxXQUFBO0lBQ0EsZ0JBQUE7SUFDQSw0QkFBQTtFQ1FOOztFRE5FO0lBQ0ksV0FBQTtJQUNBLFdBQUE7SUFDQSx5QkFBQTtJQUNBLG1CQUFBO0lBQ0EsdUJBQUE7RUNTTjs7RURQRTtJQUNJLHNCQUFBO0VDVU47O0VEUkU7SUFDSSxrQkFBQTtJQUNBLFlBQUE7SUFDQSwwQkFBQTtFQ1dOOztFRFRFO0lBQ0ksc0JBQUE7SUFDQSxrQkFBQTtFQ1lOOztFRFZFO0lBQ0kseUJBQUE7SUFDQSwwQkFBQTtJQUNBLDhCQUFBO0lBQ0EsMkJBQUE7RUNhTjs7RURYRTtJQUNJLGtCQUFBO0VDY047O0VEWkU7SUFDSSxhQUFBO0lBQ0EsbUJBQUE7SUFDQSx1QkFBQTtFQ2VOOztFRGJFO0lBQ0ksa0JBQUE7SUFDQSxvQkFBQTtJQUNBLGtCQUFBO0VDZ0JOOztFRGRFO0lBQ0ksNkJBQUE7RUNpQk47O0VEZkU7SUFDSSxtQkFBQTtFQ2tCTjtBQUNGO0FEZEk7RUFDSSxjQUFBO0FDZ0JSO0FEWEk7RUFDSSxjQUFBO0FDY1I7QURWQTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHlCQUFBO0FDYUo7QURaSTtFQUNJLFdBQUE7RUFDQSxZQUFBO0FDY1I7QURWQTtFQUNJO0lBQ0ksa0JBQUE7SUFDQSxZQUFBO0lBQ0EseUJBQUE7RUNhTjs7RURYRTtJQUNJLGFBQUE7SUFDQSxnQkFBQTtJQUNBLDZCQUFBO0VDY047RURaTTtJQUNJLDhCQUFBO0VDY1Y7QUFDRjtBRFhBO0VBQ0ksYUFBQTtFQUNBLFNBQUE7RUFDQSxVQUFBO0FDYUo7QURaSTtFQUNJLGtCQUFBO0FDY1I7QURiUTtFQUNJLFdBQUE7RUFDQSxvQkFBQTtBQ2VaO0FEWFE7RUFDSSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0Esc0JBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7QUNhWjtBRFpZO0VBQ0ksV0FBQTtFQUNBLFdBQUE7RUFDQSxvQkFBQTtBQ2NoQiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvdHJhbnNhY3Rpb25zdGF0dXMvdHJhbnNhY3Rpb25sYW5kaW5ncGFnZS90cmFuc2FjdGlvbmxhbmRpbmdwYWdlLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLmhlYWRlcnN0eWxpbmdzIHtcclxuICAgIGJhY2tncm91bmQ6ICNmMmYzZjcgIWltcG9ydGFudDtcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgIC5oZWFkZXJpbWFnZSB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxNTBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiAxNTBweDtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogMTAwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGg0IHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnJlZ2Zvb3RlciB7XHJcbiAgICAgICAgbWluLWhlaWdodDogOTVweDtcclxuICAgICAgICBhbGlnbi1pdGVtczogZmxleC1lbmQ7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDIwcHg7XHJcbiAgICAgICAgLmxvZ2luX2Zvb3RlciB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICAgICAgICAgIG1heC13aWR0aDogOTQlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5sb2dpbl9mb290ZXIgLmxvZ2luX2Zvb3Rlcl9sZWZ0IHVsIGxpIGEge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE1cHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmxvZ2luX2Zvb3Rlcl9yaWdodCB7XHJcbiAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzMgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5kcml2ZW5hbGlnbiB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBmbGV4LWVuZDtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogLTQwcHg7XHJcbiAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIGltZ3tcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC50YWJsYmVsaWNvbiB7XHJcbiAgICAgICAgaSB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMy4xMjVyZW07XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnRvcGhlYWRlcmltYWdlIHtcclxuICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICBtYXgtd2lkdGg6IDgyJTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuY29tcGxldGViYW5uZXIge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgbWluLWhlaWdodDogMjc1cHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2UwZjBmZjtcclxuICAgICAgICAuYmFja3RvaG9tZSB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIH1cclxuICAgICAgICAucmVnY29udGVudGJhbm5lciB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIG1heC13aWR0aDogMTAwJTtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICAucmlnaHRyZWdjb250ZW50IHtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAubGVmdHNpZGRlYmFubmVyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDIwJTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgICAgICAgICAgLndlbGNvbWVseWJpYSB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXRvcDogNXB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5sb2dvYW5kZ29iYWNrIHtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMTglO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIC5iYWNrdG9ob21lIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gICAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgICAgICB0b3A6IDMycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDogNnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuNjI1cmVtO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAucmlnaHRzaWRlYmFubmVyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDgwJTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1yZXBlYXQ6IG5vLXJlcGVhdDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1pbWFnZTogdXJsKFwifi9hc3NldHMvaW1hZ2VzL2dsb2JlbmV3LnBuZ1wiKTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1wb3NpdGlvbjogcmlnaHQgMHB4IHRvcCAxMjBweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1zaXplOiBjb250YWluO1xyXG4gICAgICAgICAgICAuaW5uZXJyaWdodGJhbm5lciB7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgICAgICBtYXgtd2lkdGg6IDk2JTtcclxuICAgICAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLmhlbHBsaW5lY3Qge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjNjY2O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAubGVmdHJlZ2NvbnRyZW50IHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgICAgICAgICAgICAgICAgIC5oZWFkZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2YxZjJmNztcclxuICAgICAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAxLjYyNXJlbTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5zdWJtaXRwcm9maWxlIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4ZWJhZTY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC5yaWdodHJlZ2NvbnRlbnQge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAubG9naW5idXR0b24ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNlZjg0MzY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOiA4NXB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDMwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDUwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5yZWdpc3RlcmJ0biB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDZkYjc7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogOThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLmZsYWdseXBpcyB7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiAwO1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgdG9wOiAwO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC50b3BoZWFkZXJpbWFnZSB7XHJcbiAgICAgICAgbWluLWhlaWdodDogMTc1cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLm5ld2NhcmRyaWdodCB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgIC5leHBsb3JlciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMDA2ZGI3O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIHBhZGRpbmctdG9wOiAyNXB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMjVweDtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA5MHB4O1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAucG9zaXRpb24ge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDBweDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDEwMHB4O1xyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiA0NHB4O1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuY2lyY2xlaW1hZ2Uge1xyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIG1hcmdpbi10b3A6IC02cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAgIC5jb21wbGV0ZWJhbm5lciB7XHJcbiAgICAgICAgbWluLWhlaWdodDogMzIwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciB7XHJcbiAgICAgICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5sZWZ0cmVnY29udHJlbnQge1xyXG4gICAgICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiA2MHB4O1xyXG4gICAgfVxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICBoZWlnaHQ6IDEwMCU7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5NSUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIHtcclxuICAgICAgICB3aWR0aDogMzAlO1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICB9XHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciB7XHJcbiAgICAgICAgd2lkdGg6IDcwJTtcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5oZWxwbGluZWN0IHtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5ib3R0b21pbmZvIHtcclxuICAgICAgICBtYXJnaW4tbGVmdDogYXV0bztcclxuICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93LXJldmVyc2U7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5NSU7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogLTMwcHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xyXG4gICAgfVxyXG4gICAgLnBvc2l0aW9uIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMHB4O1xyXG4gICAgICAgIGZsZXgtZmxvdzogcm93IHdyYXA7XHJcbiAgICB9XHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIgLnJpZ2h0cmVnY29udGVudCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDE1cHg7XHJcbiAgICB9XHJcbn1cclxuQG1lZGlhIChtYXgtd2lkdGg6IDEwMjRweCkgYW5kIChtaW4td2lkdGg6IDc2OXB4KSB7XHJcbiAgICAuY29tcGxldGViYW5uZXIge1xyXG4gICAgICAgIG1pbi1oZWlnaHQ6IDI5MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmJvdHRvbWluZm8ge1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5NSU7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogLTMwcHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xyXG4gICAgfVxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5sZWZ0c2lkZGViYW5uZXIge1xyXG4gICAgICAgIHdpZHRoOiAzMCU7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIHtcclxuICAgICAgICB3aWR0aDogNzAlO1xyXG4gICAgfVxyXG4gICAgLnBvc2l0aW9uIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMHB4O1xyXG4gICAgICAgIGZsZXgtZmxvdzogcm93IHdyYXA7XHJcbiAgICB9XHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIgLnJpZ2h0cmVnY29udGVudCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gICAgfVxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5yZWdjb250ZW50YmFubmVyIHtcclxuICAgICAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG59XHJcbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xyXG4gICAgLnRleHRhbGlnbmVuZCB7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDIwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5oZWFkZXIge1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMjZweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLm1ha2VpdHJpZ2h0IHtcclxuICAgICAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY2lyY2xlaW1hZ2Uge1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiA0cHg7XHJcbiAgICAgICAgaW1nIHtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA3MiUgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmJvdHRvbWluZm8ge1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWF4LXdpZHRoOiA5NSU7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogLTMwcHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xyXG4gICAgfVxyXG4gICAgLmxlZnRpc2lkZWluZm8ge1xyXG4gICAgICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5yaWdodHNpZGVpbmZvIHtcclxuICAgICAgICB3aWR0aDogMzA0cHggIWltcG9ydGFudDtcclxuICAgICAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogMTBweDtcclxuICAgIH1cclxuXHJcbiAgICAuY29tcGxldGViYW5uZXIge1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIG1pbi1oZWlnaHQ6IDE3NXB4O1xyXG4gICAgICBcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgICAgIG1pbi1oZWlnaHQ6IDE3MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciAubG9nb2FuZGdvYmFjayB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgaGVpZ2h0OiA2MCU7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgfVxyXG4gICAgLnJpZ2h0c2lkZWJhbm5lciB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgaGVpZ2h0OiAxMDAlO1xyXG4gICAgICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIgLmxlZnRyZWdjb250cmVudCB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDYwcHg7XHJcbiAgICB9XHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIge1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5tYWtlaXRyaWdodCB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgfVxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5sZWZ0c2lkZGViYW5uZXIgLmxvZ29hbmRnb2JhY2sgLmJhY2t0b2hvbWUge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIH1cclxuICAgIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcclxuICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMTEycHg7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAyMnB4O1xyXG4gICAgfVxyXG4gICAgLnN1Ym1pdHByb2ZpbGUge1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIgLmhlbHBsaW5lY3Qge1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDE1cHg7XHJcbiAgICB9XHJcbn1cclxuXHJcbi5sZWZ0cmVnY29udHJlbnQge1xyXG4gICAgc3BhbiB7XHJcbiAgICAgICAgY29sb3I6ICM0MjQ1NDk7XHJcbiAgICB9XHJcbn1cclxuXHJcbi5jaXJjbGVpbWFnZSB7XHJcbiAgICBpbWcge1xyXG4gICAgICAgIGNvbG9yOiAjNDI0NTQ5O1xyXG4gICAgfVxyXG59XHJcblxyXG4udGV4dGFsaWduZW5kIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcclxuICAgIGltZyB7XHJcbiAgICAgICAgd2lkdGg6IDMwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiAyMHB4O1xyXG4gICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogMTQwMHB4KSB7XHJcbiAgICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIGhlaWdodDogMTAwJTtcclxuICAgICAgICBtYXgtd2lkdGg6IDk4JSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnBvc2l0aW9uIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiAwcHg7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiA5MnB4ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAzMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcbi5tZW51bGlzdGl0ZW1zIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBtYXJnaW46IDA7XHJcbiAgICBwYWRkaW5nOiAwO1xyXG4gICAgLm1hdC1saXN0LWl0ZW0ge1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMTVweDtcclxuICAgICAgICBhIHtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5mb3JzZWFyY2hpdGVtIHtcclxuICAgICAgICBhIHtcclxuICAgICAgICAgICAgd2lkdGg6IDMwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICM1NTU7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDUwJTtcclxuICAgICAgICAgICAgcGFkZGluZzogN3B4O1xyXG4gICAgICAgICAgICBpIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjNTU1O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM1NTU7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5cclxuXHJcblxyXG4iLCIuaGVhZGVyc3R5bGluZ3Mge1xuICBiYWNrZ3JvdW5kOiAjZjJmM2Y3ICFpbXBvcnRhbnQ7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuaGVhZGVyaW1hZ2Uge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmhlYWRlcmltYWdlIGltZyB7XG4gIHdpZHRoOiAxNTBweDtcbiAgaGVpZ2h0OiAxNTBweDtcbiAgbWFyZ2luLXRvcDogMTAwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmhlYWRlcmltYWdlIGg0IHtcbiAgY29sb3I6ICMzMzMzMzM7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnJlZ2Zvb3RlciB7XG4gIG1pbi1oZWlnaHQ6IDk1cHg7XG4gIGFsaWduLWl0ZW1zOiBmbGV4LWVuZDtcbiAgcGFkZGluZy1ib3R0b206IDIwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnJlZ2Zvb3RlciAubG9naW5fZm9vdGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudDtcbiAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gIG1hcmdpbi1yaWdodDogYXV0bztcbiAgbWF4LXdpZHRoOiA5NCUgIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmVnZm9vdGVyIC5sb2dpbl9mb290ZXIgLmxvZ2luX2Zvb3Rlcl9sZWZ0IHVsIGxpIGEge1xuICBjb2xvcjogIzMzMyAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBmb250LXNpemU6IDE1cHggIWltcG9ydGFudDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmVnZm9vdGVyIC5sb2dpbl9mb290ZXJfcmlnaHQgc3BhbiB7XG4gIGNvbG9yOiAjMzMzICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xufVxuLmhlYWRlcnN0eWxpbmdzIC5yZWdmb290ZXIgLmRyaXZlbmFsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGZsZXgtZW5kO1xuICBtYXJnaW4tdG9wOiAtNDBweDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAucmVnZm9vdGVyIC5kcml2ZW5hbGlnbiBwIHtcbiAgY29sb3I6ICMzMzM7XG4gIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnJlZ2Zvb3RlciAuZHJpdmVuYWxpZ24gaW1nIHtcbiAgaGVpZ2h0OiA0MHB4O1xufVxuLmhlYWRlcnN0eWxpbmdzIC50YWJsYmVsaWNvbiBpIHtcbiAgZm9udC1zaXplOiAzLjEyNXJlbTtcbn1cbi5oZWFkZXJzdHlsaW5ncyAudG9waGVhZGVyaW1hZ2UgaW1nIHtcbiAgbWF4LXdpZHRoOiA4MiU7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIG1pbi1oZWlnaHQ6IDI3NXB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZTBmMGZmO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAuYmFja3RvaG9tZSB7XG4gIGRpc3BsYXk6IGJsb2NrO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIG1heC13aWR0aDogMTAwJTtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIHtcbiAgd2lkdGg6IDIwJTtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciAud2VsY29tZWx5YmlhIHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgcGFkZGluZy10b3A6IDVweDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciAubG9nb2FuZGdvYmFjayB7XG4gIGhlaWdodDogMTglO1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciAubG9nb2FuZGdvYmFjayAuYmFja3RvaG9tZSB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRvcDogMzJweDtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIC5sb2dvYW5kZ29iYWNrIC5iYWNrdG9ob21lIGkge1xuICBwYWRkaW5nLXJpZ2h0OiA2cHg7XG4gIGZvbnQtc2l6ZTogMC42MjVyZW07XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIge1xuICB3aWR0aDogODAlO1xuICBiYWNrZ3JvdW5kLXJlcGVhdDogbm8tcmVwZWF0O1xuICBiYWNrZ3JvdW5kLWltYWdlOiB1cmwoXCJ+L2Fzc2V0cy9pbWFnZXMvZ2xvYmVuZXcucG5nXCIpO1xuICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiByaWdodCAwcHggdG9wIDEyMHB4O1xuICBiYWNrZ3JvdW5kLXNpemU6IGNvbnRhaW47XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIG1heC13aWR0aDogOTYlO1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIHAge1xuICBjb2xvcjogI2ZmZjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAuaGVscGxpbmVjdCB7XG4gIGNvbG9yOiAjNjY2O1xuICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xufVxuLmhlYWRlcnN0eWxpbmdzIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5sZWZ0cmVnY29udHJlbnQge1xuICB3aWR0aDogMTAwJTtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAubGVmdHJlZ2NvbnRyZW50IC5oZWFkZXIge1xuICBjb2xvcjogI2YxZjJmNztcbiAgZm9udC1zaXplOiAxLjYyNXJlbTtcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XG4gIG1hcmdpbi1ib3R0b206IDEwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIgLmlubmVycmlnaHRiYW5uZXIgLmxlZnRyZWdjb250cmVudCAuc3VibWl0cHJvZmlsZSB7XG4gIGNvbG9yOiAjOGViYWU2O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAucmlnaHRyZWdjb250ZW50IC5sb2dpbmJ1dHRvbiB7XG4gIGNvbG9yOiAjZmZmO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgYmFja2dyb3VuZDogI2VmODQzNjtcbiAgd2lkdGg6IDg1cHg7XG4gIGhlaWdodDogMzBweDtcbiAgYm9yZGVyLXJhZGl1czogNTBweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAucmlnaHRyZWdjb250ZW50IC5yZWdpc3RlcmJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZkYjc7XG4gIGNvbG9yOiAjZmZmO1xuICB3aWR0aDogOThweDtcbiAgaGVpZ2h0OiAzMHB4O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgYm9yZGVyLXJhZGl1czogNTBweCAhaW1wb3J0YW50O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuZmxhZ2x5cGlzIHtcbiAgbGVmdDogMDtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDA7XG59XG4uaGVhZGVyc3R5bGluZ3MgLnRvcGhlYWRlcmltYWdlIHtcbiAgbWluLWhlaWdodDogMTc1cHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLm5ld2NhcmRyaWdodCB7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbn1cbi5oZWFkZXJzdHlsaW5ncyAubmV3Y2FyZHJpZ2h0IC5leHBsb3JlciB7XG4gIGNvbG9yOiAjMDA2ZGI3O1xuICBmb250LXNpemU6IDEuMTI1cmVtO1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgcGFkZGluZy1ib3R0b206IDEwcHg7XG59XG4uaGVhZGVyc3R5bGluZ3MgLm5ld2NhcmRyaWdodCBpbWcge1xuICBwYWRkaW5nLXRvcDogMjVweDtcbiAgcGFkZGluZy1ib3R0b206IDI1cHg7XG4gIG1heC13aWR0aDogOTBweDtcbiAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gIG1hcmdpbi1yaWdodDogYXV0bztcbn1cbi5oZWFkZXJzdHlsaW5ncyAucG9zaXRpb24ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBwYWRkaW5nLXRvcDogMHB4O1xuICBwYWRkaW5nLWxlZnQ6IDEwMHB4O1xufVxuLmhlYWRlcnN0eWxpbmdzIC5wb3NpdGlvbiBzcGFuIHtcbiAgcGFkZGluZy1yaWdodDogNDRweDtcbiAgY29sb3I6ICNmZmY7XG59XG4uaGVhZGVyc3R5bGluZ3MgLmNpcmNsZWltYWdlIGltZyB7XG4gIG1hcmdpbi10b3A6IC02cHg7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAuY29tcGxldGViYW5uZXIge1xuICAgIG1pbi1oZWlnaHQ6IDMyMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIge1xuICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAubGVmdHJlZ2NvbnRyZW50IHtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmctbGVmdDogNjBweDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIHtcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gICAgaGVpZ2h0OiAxMDAlO1xuICAgIG1heC13aWR0aDogOTUlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciB7XG4gICAgd2lkdGg6IDMwJTtcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIge1xuICAgIHdpZHRoOiA3MCU7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciAuaGVscGxpbmVjdCB7XG4gICAgcGFkZGluZy1yaWdodDogMTVweDtcbiAgfVxuXG4gIC5ib3R0b21pbmZvIHtcbiAgICBtYXJnaW4tbGVmdDogYXV0bztcbiAgICBmbGV4LWRpcmVjdGlvbjogcm93LXJldmVyc2U7XG4gICAgbWF4LXdpZHRoOiA5NSU7XG4gICAgbWFyZ2luLXRvcDogLTMwcHg7XG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xuICB9XG5cbiAgLnBvc2l0aW9uIHtcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBwYWRkaW5nLXRvcDogMHB4O1xuICAgIGZsZXgtZmxvdzogcm93IHdyYXA7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIgLnJpZ2h0cmVnY29udGVudCB7XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xuICAgIG1hcmdpbi10b3A6IDE1cHg7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiAxMDI0cHgpIGFuZCAobWluLXdpZHRoOiA3NjlweCkge1xuICAuY29tcGxldGViYW5uZXIge1xuICAgIG1pbi1oZWlnaHQ6IDI5MHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYm90dG9taW5mbyB7XG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XG4gICAgZGlzcGxheTogZmxleDtcbiAgICBtYXgtd2lkdGg6IDk1JTtcbiAgICBtYXJnaW4tdG9wOiAtMzBweDtcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gICAgcGFkZGluZy1ib3R0b206IDMwcHg7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciB7XG4gICAgd2lkdGg6IDMwJTtcbiAgICBiYWNrZ3JvdW5kOiAjZmZmO1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5yaWdodHNpZGViYW5uZXIge1xuICAgIHdpZHRoOiA3MCU7XG4gIH1cblxuICAucG9zaXRpb24ge1xuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIHBhZGRpbmctdG9wOiAwcHg7XG4gICAgZmxleC1mbG93OiByb3cgd3JhcDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmVnY29udGVudGJhbm5lciAucmlnaHRyZWdjb250ZW50IHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIge1xuICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xuICAudGV4dGFsaWduZW5kIHtcbiAgICBwYWRkaW5nLXRvcDogMjBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmhlYWRlciB7XG4gICAgZm9udC1zaXplOiAyNnB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWFrZWl0cmlnaHQge1xuICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jaXJjbGVpbWFnZSB7XG4gICAgcGFkZGluZy10b3A6IDRweDtcbiAgfVxuICAuY2lyY2xlaW1hZ2UgaW1nIHtcbiAgICBtYXgtd2lkdGg6IDcyJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmJvdHRvbWluZm8ge1xuICAgIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgbWF4LXdpZHRoOiA5NSU7XG4gICAgbWFyZ2luLXRvcDogLTMwcHg7XG4gICAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xuICAgIHBhZGRpbmctYm90dG9tOiAzMHB4O1xuICB9XG5cbiAgLmxlZnRpc2lkZWluZm8ge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5yaWdodHNpZGVpbmZvIHtcbiAgICB3aWR0aDogMzA0cHggIWltcG9ydGFudDtcbiAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gICAgbWFyZ2luLXRvcDogMTBweDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciB7XG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gICAgbWluLWhlaWdodDogMTc1cHg7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLmxlZnRzaWRkZWJhbm5lciB7XG4gICAgd2lkdGg6IDEwMCU7XG4gICAgYmFja2dyb3VuZDogI2ZmZjtcbiAgICBtaW4taGVpZ2h0OiAxNzBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5sZWZ0c2lkZGViYW5uZXIgLmxvZ29hbmRnb2JhY2sge1xuICAgIHdpZHRoOiAxMDAlO1xuICAgIGhlaWdodDogNjAlO1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgfVxuXG4gIC5yaWdodHNpZGViYW5uZXIge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciB7XG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xuICAgIGhlaWdodDogMTAwJTtcbiAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5sZWZ0cmVnY29udHJlbnQge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1sZWZ0OiA2MHB4O1xuICB9XG5cbiAgLmNvbXBsZXRlYmFubmVyIC5yZWdjb250ZW50YmFubmVyIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgICBwYWRkaW5nLXRvcDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWFrZWl0cmlnaHQge1xuICAgIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAubGVmdHNpZGRlYmFubmVyIC5sb2dvYW5kZ29iYWNrIC5iYWNrdG9ob21lIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIH1cblxuICAuY29tcGxldGViYW5uZXIgLnJlZ2NvbnRlbnRiYW5uZXIgLnJpZ2h0cmVnY29udGVudCB7XG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xuICAgIG1hcmdpbi1ib3R0b206IDExMnB4O1xuICAgIG1hcmdpbi1yaWdodDogMjJweDtcbiAgfVxuXG4gIC5zdWJtaXRwcm9maWxlIHtcbiAgICBtYXJnaW4tYm90dG9tOiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jb21wbGV0ZWJhbm5lciAucmlnaHRzaWRlYmFubmVyIC5pbm5lcnJpZ2h0YmFubmVyIC5oZWxwbGluZWN0IHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xuICB9XG59XG4ubGVmdHJlZ2NvbnRyZW50IHNwYW4ge1xuICBjb2xvcjogIzQyNDU0OTtcbn1cblxuLmNpcmNsZWltYWdlIGltZyB7XG4gIGNvbG9yOiAjNDI0NTQ5O1xufVxuXG4udGV4dGFsaWduZW5kIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi50ZXh0YWxpZ25lbmQgaW1nIHtcbiAgd2lkdGg6IDMwcHg7XG4gIGhlaWdodDogMjBweDtcbn1cblxuQG1lZGlhIChtYXgtd2lkdGg6IDE0MDBweCkge1xuICAuY29tcGxldGViYW5uZXIgLnJpZ2h0c2lkZWJhbm5lciAuaW5uZXJyaWdodGJhbm5lciB7XG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xuICAgIGhlaWdodDogMTAwJTtcbiAgICBtYXgtd2lkdGg6IDk4JSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnBvc2l0aW9uIHtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICAgIHBhZGRpbmctdG9wOiAwcHg7XG4gICAgcGFkZGluZy1sZWZ0OiA5MnB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgLnBvc2l0aW9uIHNwYW4ge1xuICAgIHBhZGRpbmctcmlnaHQ6IDMycHggIWltcG9ydGFudDtcbiAgfVxufVxuLm1lbnVsaXN0aXRlbXMge1xuICBkaXNwbGF5OiBmbGV4O1xuICBtYXJnaW46IDA7XG4gIHBhZGRpbmc6IDA7XG59XG4ubWVudWxpc3RpdGVtcyAubWF0LWxpc3QtaXRlbSB7XG4gIG1hcmdpbi1yaWdodDogMTVweDtcbn1cbi5tZW51bGlzdGl0ZW1zIC5tYXQtbGlzdC1pdGVtIGEge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG59XG4ubWVudWxpc3RpdGVtcyAuZm9yc2VhcmNoaXRlbSBhIHtcbiAgd2lkdGg6IDMwcHg7XG4gIGhlaWdodDogMzBweDtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGJvcmRlcjogMXB4IHNvbGlkICM1NTU7XG4gIGJvcmRlci1yYWRpdXM6IDUwJTtcbiAgcGFkZGluZzogN3B4O1xufVxuLm1lbnVsaXN0aXRlbXMgLmZvcnNlYXJjaGl0ZW0gYSBpIHtcbiAgY29sb3I6ICM1NTU7XG4gIGNvbG9yOiAjNTU1O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.ts":
  /*!******************************************************************************************************!*\
    !*** ./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.ts ***!
    \******************************************************************************************************/

  /*! exports provided: TransactionlandingpageComponent */

  /***/
  function srcAppModulesTransactionstatusTransactionlandingpageTransactionlandingpageComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "TransactionlandingpageComponent", function () {
      return TransactionlandingpageComponent;
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


    var _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @app/auth/admin.service */
    "./src/app/auth/admin.service.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");

    var TransactionlandingpageComponent = /*#__PURE__*/function () {
      function TransactionlandingpageComponent(activatedRoute, router, security, adminService, localstorage) {
        _classCallCheck(this, TransactionlandingpageComponent);

        this.activatedRoute = activatedRoute;
        this.router = router;
        this.security = security;
        this.adminService = adminService;
        this.localstorage = localstorage;
        this.showLoader = true;
        this.sameUser = false;
      }

      _createClass(TransactionlandingpageComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this = this;

          this.activatedRoute.queryParams.subscribe(function (params) {
            if (params.type) {
              _this.showLoader = false;
              _this.error_type = params.type;
            }

            if (params.reference_number) {
              if (localStorage.getItem('v3logindata')) {
                _this.enc_comppk = _this.localstorage.getInLocal('encCompPk');
              }

              _this.classification = params.classification;
              _this.country = params.country;
              _this.module = params.serv_module;
              var ref_no = params.reference_number;
              var cls = params.classification;
              var country = params.country;
              var serv_module = params.serv_module;
              var userpk = params.userpk;
              var comppk = params.comppk;

              if (_this.enc_comppk == params.comppk) {
                _this.sameUser = true;
              }

              var responseinfo = {
                ref_no: ref_no,
                cls: cls,
                country: country,
                serv_module: serv_module,
                userpk: userpk,
                comppk: comppk
              };

              _this.adminService.getOttuResponseData(_this.security.encrypt(JSON.stringify(responseinfo))).subscribe(function (data) {
                _this.showLoader = false;
                _this.responseData = data['data'];
              });
            }
          });
        }
      }]);

      return TransactionlandingpageComponent;
    }();

    TransactionlandingpageComponent.ctorParameters = function () {
      return [{
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"]
      }, {
        type: _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_2__["AdminService"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"]
      }];
    };

    TransactionlandingpageComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-transactionlandingpage',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./transactionlandingpage.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.html"))["default"],
      providers: [_app_auth_admin_service__WEBPACK_IMPORTED_MODULE_2__["AdminService"]],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./transactionlandingpage.component.scss */
      "./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"], _app_auth_admin_service__WEBPACK_IMPORTED_MODULE_2__["AdminService"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"]])], TransactionlandingpageComponent);
    /***/
  },

  /***/
  "./src/app/modules/transactionstatus/transactionstatus-routing.module.ts":
  /*!*******************************************************************************!*\
    !*** ./src/app/modules/transactionstatus/transactionstatus-routing.module.ts ***!
    \*******************************************************************************/

  /*! exports provided: TransactionstatusRoutingModule */

  /***/
  function srcAppModulesTransactionstatusTransactionstatusRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "TransactionstatusRoutingModule", function () {
      return TransactionstatusRoutingModule;
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


    var _transactionlandingpage_transactionlandingpage_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./transactionlandingpage/transactionlandingpage.component */
    "./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'transactionlandingpage',
        component: _transactionlandingpage_transactionlandingpage_component__WEBPACK_IMPORTED_MODULE_3__["TransactionlandingpageComponent"]
      }]
    }];

    var TransactionstatusRoutingModule = /*#__PURE__*/_createClass(function TransactionstatusRoutingModule() {
      _classCallCheck(this, TransactionstatusRoutingModule);
    });

    TransactionstatusRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], TransactionstatusRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/transactionstatus/transactionstatus.module.ts":
  /*!***********************************************************************!*\
    !*** ./src/app/modules/transactionstatus/transactionstatus.module.ts ***!
    \***********************************************************************/

  /*! exports provided: TransactionstatusModule */

  /***/
  function srcAppModulesTransactionstatusTransactionstatusModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "TransactionstatusModule", function () {
      return TransactionstatusModule;
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


    var _transactionstatus_routing_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./transactionstatus-routing.module */
    "./src/app/modules/transactionstatus/transactionstatus-routing.module.ts");
    /* harmony import */


    var _app_shared__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var _transactionlandingpage_transactionlandingpage_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./transactionlandingpage/transactionlandingpage.component */
    "./src/app/modules/transactionstatus/transactionlandingpage/transactionlandingpage.component.ts");
    /* harmony import */


    var _transactionsucess_transactionsucess_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./transactionsucess/transactionsucess.component */
    "./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.ts");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");

    var TransactionstatusModule = /*#__PURE__*/_createClass(function TransactionstatusModule() {
      _classCallCheck(this, TransactionstatusModule);
    });

    TransactionstatusModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_transactionlandingpage_transactionlandingpage_component__WEBPACK_IMPORTED_MODULE_5__["TransactionlandingpageComponent"], _transactionsucess_transactionsucess_component__WEBPACK_IMPORTED_MODULE_6__["TransactionsucessComponent"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _transactionstatus_routing_module__WEBPACK_IMPORTED_MODULE_3__["TransactionstatusRoutingModule"], _app_shared__WEBPACK_IMPORTED_MODULE_4__["SharedModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__["FlexLayoutModule"]]
    })], TransactionstatusModule);
    /***/
  },

  /***/
  "./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.scss":
  /*!**********************************************************************************************!*\
    !*** ./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.scss ***!
    \**********************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesTransactionstatusTransactionsucessTransactionsucessComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#thankyoulistview {\n  text-align: center;\n  border-radius: 10px;\n  background-clip: padding-box;\n  background-color: #fff;\n  box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);\n  margin-left: auto;\n  margin-right: auto;\n  max-width: 90% !important;\n  margin-top: -135px;\n  min-height: calc(100vh - 232px);\n  padding-top: 25px;\n}\n#thankyoulistview .leftspace {\n  text-align: left;\n}\n#thankyoulistview .crossimg img {\n  width: 44px;\n  height: 44px;\n}\n#thankyoulistview .flexinfo {\n  display: flex;\n  align-items: center;\n}\n#thankyoulistview .transcationcard {\n  padding: 15px;\n  margin-bottom: 15px;\n}\n#thankyoulistview .transcationcard .card_icon {\n  width: 70px;\n  height: 70px;\n  background-color: #fff;\n  color: #fff;\n  border-radius: 3px;\n  font-size: 1.5625rem;\n  display: inline-block;\n  text-align: center;\n  margin-right: 15px;\n  border: 1px solid #ddd;\n}\n#thankyoulistview .transcationcard .card_icon img {\n  width: 100% !important;\n}\n#thankyoulistview .headingalign {\n  max-width: 80%;\n}\n#thankyoulistview .headingalign.paymentinfo {\n  max-width: 100% !important;\n}\n#thankyoulistview .headingalign .msme_small, #thankyoulistview .headingalign .cancel, #thankyoulistview .headingalign .paymentinprogress, #thankyoulistview .headingalign .largenew, #thankyoulistview .headingalign .msme_large, #thankyoulistview .headingalign .msme_micro, #thankyoulistview .headingalign .msme_medium {\n  padding-left: 6px;\n  padding-right: 6px;\n  color: #fff !important;\n  background-color: #f2ac1d;\n  padding-top: 2px;\n  padding-bottom: 2px;\n  border-radius: 2px;\n  margin: 0px;\n}\n#thankyoulistview .headingalign .msme_medium {\n  background-color: #2fd0d4 !important;\n}\n#thankyoulistview .headingalign .msme_micro {\n  background-color: #3e78d8 !important;\n}\n#thankyoulistview .headingalign .msme_large {\n  background-color: #62a125 !important;\n}\n#thankyoulistview .headingalign .largenew {\n  background-color: #62a125 !important;\n}\n#thankyoulistview .headingalign .paymentinprogress {\n  background-color: #fc9202 !important;\n}\n#thankyoulistview .headingalign .cancel {\n  background-color: #de1818 !important;\n}\n#thankyoulistview .headingalign h3 {\n  text-align: left;\n}\n#thankyoulistview .clickherecolor a {\n  text-decoration: underline;\n}\n#thankyoulistview .cancellogo i {\n  font-size: 1.875rem;\n  color: red;\n}\n#thankyoulistview .jsrscontactcolor {\n  padding-bottom: 20px;\n}\n#thankyoulistview .jsrscontactcolor h2 {\n  font-size: 1.125rem;\n  margin: 0px;\n  color: #71c016;\n}\n#thankyoulistview .jsrscontactcolor .awaitingcolor {\n  color: #de1818;\n}\n#thankyoulistview .redcolor h2 {\n  font-size: 1.125rem;\n  margin: 0px;\n  color: red !important;\n}\n#thankyoulistview .transfertextcolor p {\n  color: #333333;\n  font-size: 1rem;\n  margin: 0px;\n}\n#thankyoulistview .transfertextcolor p span {\n  font-family: \"cairosemibold\";\n}\n#thankyoulistview .loginbtn {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-top: 30px;\n}\n#thankyoulistview .loginbtn button {\n  width: 160px;\n  color: #fff;\n  border-radius: 2px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy90cmFuc2FjdGlvbnN0YXR1cy90cmFuc2FjdGlvbnN1Y2Vzcy9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFx0cmFuc2FjdGlvbnN0YXR1c1xcdHJhbnNhY3Rpb25zdWNlc3NcXHRyYW5zYWN0aW9uc3VjZXNzLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3RyYW5zYWN0aW9uc3RhdHVzL3RyYW5zYWN0aW9uc3VjZXNzL3RyYW5zYWN0aW9uc3VjZXNzLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQStCQTtFQUNJLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSw0QkFBQTtFQUNBLHNCQUFBO0VBQ0Esd0NBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLCtCQUFBO0VBQ0EsaUJBQUE7QUM5Qko7QUQrQkk7RUFDSSxnQkFBQTtBQzdCUjtBRGdDUTtFQUNLLFdBQUE7RUFDQSxZQUFBO0FDOUJiO0FEaUNHO0VBQ0ssYUFBQTtFQUNBLG1CQUFBO0FDL0JSO0FEaUNJO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDL0JSO0FEZ0NRO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxzQkFBQTtFQUNBLFdBQUE7RUFDQSxrQkFBQTtFQUNBLG9CQUFBO0VBQ0EscUJBQUE7RUFDQSxrQkFBQTtFQUNBLGtCQUFBO0VBQ0Esc0JBQUE7QUM5Qlo7QURnQ1k7RUFDSSxzQkFBQTtBQzlCaEI7QURrQ0k7RUFzQ0ksY0FBQTtBQ3JFUjtBRGdDUTtFQUNLLDBCQUFBO0FDOUJiO0FEZ0NRO0VBQ0ksaUJBQUE7RUFDQSxrQkFBQTtFQUNBLHNCQUFBO0VBQ0EseUJBQUE7RUFDQSxnQkFBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxXQUFBO0FDOUJaO0FEZ0NRO0VBRUssb0NBQUE7QUMvQmI7QURpQ1E7RUFFSSxvQ0FBQTtBQ2hDWjtBRGtDUTtFQUVLLG9DQUFBO0FDakNiO0FEbUNRO0VBRUssb0NBQUE7QUNsQ2I7QURvQ1E7RUFFSSxvQ0FBQTtBQ25DWjtBRHFDUTtFQUVJLG9DQUFBO0FDcENaO0FEdUNVO0VBQ00sZ0JBQUE7QUNyQ2hCO0FEeUNjO0VBQ0ksMEJBQUE7QUN2Q2xCO0FEMkNRO0VBQ0ksbUJBQUE7RUFDQSxVQUFBO0FDekNaO0FENENJO0VBQ0ksb0JBQUE7QUMxQ1I7QUQyQ1E7RUFDSSxtQkFBQTtFQUNBLFdBQUE7RUFDQSxjQUFBO0FDekNaO0FEMkNRO0VBQ00sY0FBQTtBQ3pDZDtBRDhDUTtFQUNJLG1CQUFBO0VBQ0EsV0FBQTtFQUNBLHFCQUFBO0FDNUNaO0FEZ0RRO0VBQ0ksY0FBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0FDOUNaO0FEK0NZO0VBQ0ksNEJBQUE7QUM3Q2hCO0FEa0RJO0VBL0pBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLDhCQUFBO0VBK0pJLGdCQUFBO0FDOUNSO0FEK0NRO0VBQ0ksWUFBQTtFQUNBLFdBQUE7RUFDQSxrQkFBQTtFQXJLUixhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtBQ3lISiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvdHJhbnNhY3Rpb25zdGF0dXMvdHJhbnNhY3Rpb25zdWNlc3MvdHJhbnNhY3Rpb25zdWNlc3MuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJAbWl4aW4gZmxleGNlbnRlciB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbkBtaXhpbiBmbGV4c3RhcnQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIGZsZXhlbmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbkBtaXhpbiBzcGFjZWJldHdlZW4ge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbn1cclxuXHJcbkBtaXhpbiBtYXJnaW56ZXJvIHtcclxuICAgIG1hcmdpbjogMDtcclxuICAgIHdoaXRlLXNwYWNlOiBub3JtYWwgIWltcG9ydGFudDtcclxuICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbn1cclxuXHJcblxyXG4jdGhhbmt5b3VsaXN0dmlldyB7XHJcbiAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMHB4O1xyXG4gICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICBib3gtc2hhZG93OiAwIDAgMTBweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xyXG4gICAgbWFyZ2luLWxlZnQ6IGF1dG87XHJcbiAgICBtYXJnaW4tcmlnaHQ6IGF1dG87XHJcbiAgICBtYXgtd2lkdGg6IDkwJSAhaW1wb3J0YW50O1xyXG4gICAgbWFyZ2luLXRvcDogLTEzNXB4O1xyXG4gICAgbWluLWhlaWdodDogY2FsYygxMDB2aCAtIDIzMnB4KTtcclxuICAgIHBhZGRpbmctdG9wOiAyNXB4O1xyXG4gICAgLmxlZnRzcGFjZXtcclxuICAgICAgICB0ZXh0LWFsaWduOiBsZWZ0O1xyXG4gICB9XHJcbiAgIC5jcm9zc2ltZ3tcclxuICAgICAgICBpbWd7XHJcbiAgICAgICAgICAgICB3aWR0aDogNDRweDtcclxuICAgICAgICAgICAgIGhlaWdodDogNDRweDtcclxuICAgICAgICB9XHJcbiAgIH1cclxuICAgLmZsZXhpbmZve1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgfVxyXG4gICAgLnRyYW5zY2F0aW9uY2FyZCB7XHJcbiAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOiAxNXB4O1xyXG4gICAgICAgIC5jYXJkX2ljb24ge1xyXG4gICAgICAgICAgICB3aWR0aDogNzBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA3MHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDEuNTYyNXJlbTtcclxuICAgICAgICAgICAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xyXG4gICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTVweDtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcclxuICAgIFxyXG4gICAgICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0gICAgXHJcbiAgICAuaGVhZGluZ2FsaWdue1xyXG4gICAgICAgICYucGF5bWVudGluZm97XHJcbiAgICAgICAgICAgICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLm1zbWVfc21hbGx7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogNnB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiA2cHg7XHJcbiAgICAgICAgICAgIGNvbG9yOiNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjojZjJhYzFkO1xyXG4gICAgICAgICAgICBwYWRkaW5nLXRvcDogMnB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMnB4OyAgXHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tc21lX21lZGl1bXtcclxuICAgICAgICAgICAgIEBleHRlbmQgLm1zbWVfc21hbGw7XHJcbiAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMmZkMGQ0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tc21lX21pY3Jve1xyXG4gICAgICAgICAgICBAZXh0ZW5kIC5tc21lX3NtYWxsO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjM2U3OGQ4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICB9XHJcbiAgICAgICAgLm1zbWVfbGFyZ2V7XHJcbiAgICAgICAgICAgICBAZXh0ZW5kIC5tc21lX3NtYWxsO1xyXG4gICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzYyYTEyNSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAubGFyZ2VuZXd7XHJcbiAgICAgICAgICAgICBAZXh0ZW5kIC5tc21lX3NtYWxsO1xyXG4gICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzYyYTEyNSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAucGF5bWVudGlucHJvZ3Jlc3N7XHJcbiAgICAgICAgICAgIEBleHRlbmQgLm1zbWVfc21hbGw7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmYzkyMDIgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmNhbmNlbHtcclxuICAgICAgICAgICAgQGV4dGVuZCAubXNtZV9zbWFsbDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2RlMTgxOCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICBtYXgtd2lkdGg6IDgwJTtcclxuICAgICAgICAgIGgze1xyXG4gICAgICAgICAgICAgICAgdGV4dC1hbGlnbjogbGVmdDtcclxuICAgICAgICAgIH1cclxuICAgIH1cclxuICAgIC5jbGlja2hlcmVjb2xvcntcclxuICAgICAgICAgICAgICBhe1xyXG4gICAgICAgICAgICAgICAgICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuY2FuY2VsbG9nbyB7XHJcbiAgICAgICAgaSB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMS44NzVyZW07XHJcbiAgICAgICAgICAgIGNvbG9yOiByZWQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmpzcnNjb250YWN0Y29sb3Ige1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAyMHB4O1xyXG4gICAgICAgIGgyIHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxLjEyNXJlbTtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNzFjMDE2O1xyXG4gICAgICAgIH1cclxuICAgICAgICAuYXdhaXRpbmdjb2xvcntcclxuICAgICAgICAgICAgICBjb2xvcjogI2RlMTgxODtcclxuICAgICAgICB9XHJcbiAgICAgICBcclxuICAgIH1cclxuICAgIC5yZWRjb2xvciB7XHJcbiAgICAgICAgaDIge1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgY29sb3I6IHJlZCAgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAudHJhbnNmZXJ0ZXh0Y29sb3Ige1xyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxcmVtO1xyXG4gICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5sb2dpbmJ0biB7XHJcbiAgICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDMwcHg7XHJcbiAgICAgICAgYnV0dG9uIHtcclxuICAgICAgICAgICAgd2lkdGg6IDE2MHB4O1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5cclxuIiwiI3RoYW5reW91bGlzdHZpZXcge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIGJvcmRlci1yYWRpdXM6IDEwcHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJveC1zaGFkb3c6IDAgMCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4xNSk7XG4gIG1hcmdpbi1sZWZ0OiBhdXRvO1xuICBtYXJnaW4tcmlnaHQ6IGF1dG87XG4gIG1heC13aWR0aDogOTAlICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi10b3A6IC0xMzVweDtcbiAgbWluLWhlaWdodDogY2FsYygxMDB2aCAtIDIzMnB4KTtcbiAgcGFkZGluZy10b3A6IDI1cHg7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAubGVmdHNwYWNlIHtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5jcm9zc2ltZyBpbWcge1xuICB3aWR0aDogNDRweDtcbiAgaGVpZ2h0OiA0NHB4O1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmZsZXhpbmZvIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC50cmFuc2NhdGlvbmNhcmQge1xuICBwYWRkaW5nOiAxNXB4O1xuICBtYXJnaW4tYm90dG9tOiAxNXB4O1xufVxuI3RoYW5reW91bGlzdHZpZXcgLnRyYW5zY2F0aW9uY2FyZCAuY2FyZF9pY29uIHtcbiAgd2lkdGg6IDcwcHg7XG4gIGhlaWdodDogNzBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDNweDtcbiAgZm9udC1zaXplOiAxLjU2MjVyZW07XG4gIGRpc3BsYXk6IGlubGluZS1ibG9jaztcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBtYXJnaW4tcmlnaHQ6IDE1cHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAudHJhbnNjYXRpb25jYXJkIC5jYXJkX2ljb24gaW1nIHtcbiAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24ge1xuICBtYXgtd2lkdGg6IDgwJTtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24ucGF5bWVudGluZm8ge1xuICBtYXgtd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24gLm1zbWVfc21hbGwsICN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24gLmNhbmNlbCwgI3RoYW5reW91bGlzdHZpZXcgLmhlYWRpbmdhbGlnbiAucGF5bWVudGlucHJvZ3Jlc3MsICN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24gLmxhcmdlbmV3LCAjdGhhbmt5b3VsaXN0dmlldyAuaGVhZGluZ2FsaWduIC5tc21lX2xhcmdlLCAjdGhhbmt5b3VsaXN0dmlldyAuaGVhZGluZ2FsaWduIC5tc21lX21pY3JvLCAjdGhhbmt5b3VsaXN0dmlldyAuaGVhZGluZ2FsaWduIC5tc21lX21lZGl1bSB7XG4gIHBhZGRpbmctbGVmdDogNnB4O1xuICBwYWRkaW5nLXJpZ2h0OiA2cHg7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmMmFjMWQ7XG4gIHBhZGRpbmctdG9wOiAycHg7XG4gIHBhZGRpbmctYm90dG9tOiAycHg7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgbWFyZ2luOiAwcHg7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuaGVhZGluZ2FsaWduIC5tc21lX21lZGl1bSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMyZmQwZDQgIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24gLm1zbWVfbWljcm8ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjM2U3OGQ4ICFpbXBvcnRhbnQ7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuaGVhZGluZ2FsaWduIC5tc21lX2xhcmdlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzYyYTEyNSAhaW1wb3J0YW50O1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmhlYWRpbmdhbGlnbiAubGFyZ2VuZXcge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjNjJhMTI1ICFpbXBvcnRhbnQ7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAuaGVhZGluZ2FsaWduIC5wYXltZW50aW5wcm9ncmVzcyB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmYzkyMDIgIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24gLmNhbmNlbCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNkZTE4MTggIWltcG9ydGFudDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5oZWFkaW5nYWxpZ24gaDMge1xuICB0ZXh0LWFsaWduOiBsZWZ0O1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmNsaWNraGVyZWNvbG9yIGEge1xuICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5jYW5jZWxsb2dvIGkge1xuICBmb250LXNpemU6IDEuODc1cmVtO1xuICBjb2xvcjogcmVkO1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmpzcnNjb250YWN0Y29sb3Ige1xuICBwYWRkaW5nLWJvdHRvbTogMjBweDtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5qc3JzY29udGFjdGNvbG9yIGgyIHtcbiAgZm9udC1zaXplOiAxLjEyNXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjNzFjMDE2O1xufVxuI3RoYW5reW91bGlzdHZpZXcgLmpzcnNjb250YWN0Y29sb3IgLmF3YWl0aW5nY29sb3Ige1xuICBjb2xvcjogI2RlMTgxODtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5yZWRjb2xvciBoMiB7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIG1hcmdpbjogMHB4O1xuICBjb2xvcjogcmVkICFpbXBvcnRhbnQ7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAudHJhbnNmZXJ0ZXh0Y29sb3IgcCB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LXNpemU6IDFyZW07XG4gIG1hcmdpbjogMHB4O1xufVxuI3RoYW5reW91bGlzdHZpZXcgLnRyYW5zZmVydGV4dGNvbG9yIHAgc3BhbiB7XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvc2VtaWJvbGRcIjtcbn1cbiN0aGFua3lvdWxpc3R2aWV3IC5sb2dpbmJ0biB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi10b3A6IDMwcHg7XG59XG4jdGhhbmt5b3VsaXN0dmlldyAubG9naW5idG4gYnV0dG9uIHtcbiAgd2lkdGg6IDE2MHB4O1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufSJdfQ== */";
    /***/
  },

  /***/
  "./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.ts":
  /*!********************************************************************************************!*\
    !*** ./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.ts ***!
    \********************************************************************************************/

  /*! exports provided: TransactionsucessComponent */

  /***/
  function srcAppModulesTransactionstatusTransactionsucessTransactionsucessComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "TransactionsucessComponent", function () {
      return TransactionsucessComponent;
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


    var _app_modules_afterlogin_afterlogin_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @app/modules/afterlogin/afterlogin.service */
    "./src/app/modules/afterlogin/afterlogin.service.ts");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_3__);
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");

    var TransactionsucessComponent = /*#__PURE__*/function () {
      function TransactionsucessComponent(afterloginService, router) {
        _classCallCheck(this, TransactionsucessComponent);

        this.afterloginService = afterloginService;
        this.router = router;
        this.error_type = '';
        this.showLoader = false;
        this.thanksContent = '';
        this.paymentStatusPage = true;
        this.redirectto = '';
      }

      _createClass(TransactionsucessComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          this.thanksContent = 'Please login to make payment';

          if (this.sameUser) {
            this.thanksContent = 'You will be redirected to Payment page to try the payment again';

            if (this.module === 'REG') {
              this.redirectto = '/afterlogin/certificationpaymentdetail';
            } else if (this.module === 'RENEW') {
              this.redirectto = '/afterlogin/certificationpaymentdetail';
            }
          } else {
            this.redirectto = '/admin/login';
          }
        }
      }, {
        key: "ngOnChanges",
        value: function ngOnChanges() {
          var _this2 = this;

          var _a, _b, _c, _d;

          this.compPk = (_a = this.pymtResponseDtls) === null || _a === void 0 ? void 0 : _a.comppk;
          this.userPk = (_b = this.pymtResponseDtls) === null || _b === void 0 ? void 0 : _b.userpk;
          this.paymentStatus = (_c = this.pymtResponseDtls) === null || _c === void 0 ? void 0 : _c.payment_status;

          if (this.module === 'RENEW') {
            this.payModule = "2";
            this.subscriptionFee = 'Kindly confirm if the JSRS Subscription Fee has been debited from your bank account';
          } else {
            this.payModule = "1";
            this.subscriptionFee = 'Kindly confirm if the JSRS Certification Fee has been debited from your bank account';
          }

          if (this.paymentStatus && this.paymentStatus == '2' && ((_d = this.pymtResponseDtls) === null || _d === void 0 ? void 0 : _d.pymtconfirm) == '2') {
            this.paymentStatusPage = false;
            sweetalert__WEBPACK_IMPORTED_MODULE_3___default()({
              title: this.subscriptionFee,
              text: '',
              icon: "warning",
              buttons: ['Not Debited', 'Yes, Debited'],
              dangerMode: true,
              className: "swal-warning",
              closeOnClickOutside: false,
              closeOnEsc: false
            }).then(function (willDelete) {
              if (willDelete) {
                //Payment is debited
                _this2.afterloginService.updatePaymentStatus(_this2.compPk, _this2.userPk, _this2.payModule).subscribe(function (data) {
                  _this2.paymentStatusPage = true;
                });
              } else {
                //Payment is not debited
                _this2.showLoader = true;

                _this2.afterloginService.revertPayment(_this2.compPk, _this2.userPk, _this2.payModule).subscribe(function (data) {
                  _this2.paymentStatusPage = true;
                  _this2.showLoader = false;
                  _this2.paymentStatus = 6; //For failed status

                  sweetalert__WEBPACK_IMPORTED_MODULE_3___default()({
                    title: "Thanks for confirming",
                    text: _this2.thanksContent,
                    icon: "success",
                    closeOnClickOutside: false,
                    closeOnEsc: false
                  }).then(function (willConfirm) {
                    if (willConfirm) {
                      _this2.navigateTo();
                    }
                  });
                });
              }
            });
          }
        }
      }, {
        key: "navigateTo",
        value: function navigateTo() {
          if (this.redirectto) {
            this.router.navigate([this.redirectto]);
          } // this.router.navigate(['/admin/login'], {
          //   state: {
          //     paymentDeclined: true
          //   }
          // });

        }
      }]);

      return TransactionsucessComponent;
    }();

    TransactionsucessComponent.ctorParameters = function () {
      return [{
        type: _app_modules_afterlogin_afterlogin_service__WEBPACK_IMPORTED_MODULE_2__["AfterloginService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('pymtResponseDtls'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], TransactionsucessComponent.prototype, "pymtResponseDtls", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('classification'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], TransactionsucessComponent.prototype, "classification", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('country'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], TransactionsucessComponent.prototype, "country", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('module'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], TransactionsucessComponent.prototype, "module", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('sameUser'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], TransactionsucessComponent.prototype, "sameUser", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('error_type'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], TransactionsucessComponent.prototype, "error_type", void 0);
    TransactionsucessComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-transactionsucess',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./transactionsucess.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./transactionsucess.component.scss */
      "./src/app/modules/transactionstatus/transactionsucess/transactionsucess.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_modules_afterlogin_afterlogin_service__WEBPACK_IMPORTED_MODULE_2__["AfterloginService"], _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]])], TransactionsucessComponent);
    /***/
  }
}]);
//# sourceMappingURL=modules-transactionstatus-transactionstatus-module-es5.js.map