(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-paymentinvoice-paymentinvoice-module"],{

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.html":
/*!***************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.html ***!
  \***************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div id=\"paymented\" #pageScroll fxLayoutAlign=\"center\">\r\n    <div fxFlex.gt-sm=\"90\" fxFlex=\"98\">\r\n        <div class=\"knowledgegrid m-t-10 m-b-20\" fxLayout=\"column\">\r\n            <div class=\"details\" fxFlex=\"100\">\r\n                <div class= \"head\" fxLayout=\"row wrap\">\r\n                    <h2 class=\"headcolor fs-18 m-0 lh-15\">{{omrm_companyname_en}}</h2>\r\n                   <div class=\"grade\">\r\n                    <p class=\"grade d-flex fs-16\"*ngIf=\"appdt_grademst_fk == 1\"><img src=\"assets\\images\\opalimages\\BRONZE.svg\" alt=\"Grade\">{{'invoice.gradbron' | translate}} </p>\r\n                    <p class=\"gold d-flex fs-16\" *ngIf=\"appdt_grademst_fk == 3\"><img src=\"assets\\images\\opalimages\\GOLD.svg\" alt=\"Grade\">{{'invoice.gradgold' | translate}}\r\n                    </p>\r\n                    <p class=\"silver d-flex fs-16\" *ngIf=\"appdt_grademst_fk == 2\"><img src=\"assets\\images\\opalimages\\SILVER.svg\" alt=\"Grade\">{{'invoice.gradsilv' | translate}} </p>\r\n                   </div>\r\n                </div>\r\n               <div class=\"m-t-20\">\r\n                <p class=\"text-gray m-0 fs-15 \">{{'invoice.traiprovname' | translate}}:<span class=\"text-default\">{{omrm_tpname_en}}</span></p>\r\n               </div>\r\n                <div class=\"fs-13 m-t-20 m-b-20\" fxLayout=\"row wrap\">\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.applirefno' | translate}}:<span\r\n                            class=\"text-default\"> {{appdt_appreferno}}</span>\r\n                    </p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.offitype' | translate}}:<span\r\n                            class=\"text-default\"> {{ appiit_officetype}}</span></p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.applytype' | translate}}:<span\r\n                            class=\"text-default\"> {{ appdt_apptype}}</span></p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.applstat' | translate}}:\r\n                            <span *ngIf=\"appdt_status == '1'\" class=\"text-default\">{{'table.yettosubmit'\r\n                                    |translate}}</span>\r\n                                <span *ngIf=\"appdt_status == '2'\" class=\"text-default\">{{'table.subfordesk'\r\n                                    |translate}}</span>\r\n                                <span *ngIf=\"appdt_status == '3'\" class=\"text-default\">{{'table.declduringdesk'\r\n                                    |translate}}</span>\r\n                                <span *ngIf=\"appdt_status == '4'\" class=\"text-default\">{{'table.resubmdesk'\r\n                                    |translate}}</span>\r\n                                <span *ngIf=\"appdt_status == '5'\" class=\"text-default\">{{'table.yettopay'\r\n                                    |translate}}</span>\r\n                                <span *ngIf=\"appdt_status == '6'\" class=\"text-default\">{{'table.paidconfipend'\r\n                                    |translate}}</span>\r\n                        \r\n                        </p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.certstat' | translate}}:\r\n                            <span  *ngIf=\"!appdt_certificategenon\" class=\"new\">{{'table.new'\r\n                                |translate}}</span>\r\n                            <span *ngIf=\"appdt_certificategenon\" class=\"approved\" class=\"green\"> {{'table.acti'\r\n                                    |translate}}</span>\r\n                            <span *ng-if=\"appdt_certificategenon != ' ' && isexpired == '1'\"  class=\"red\">{{'table.expi'\r\n                                |translate}}</span>\r\n                        </p>\r\n                </div>\r\n            </div>\r\n            <mat-divider></mat-divider>\r\n            <div class=\"address  p-l-15\" fxLayout=\"row wrap\" fxFlex.gt-sm=\"60\"  fxFlex=\"100\">\r\n                <div class=\"add-details\" fxFlex.gt-sm=\"20\"  fxFlex=\"50\" >\r\n                    <p class=\"text-gray fs-14\">{{'invoice.siteloca' | translate}} <br>  <a matTooltip=\"View Location\" href=\"https://www.google.com.sa/maps/search/{{appiit_loclatitude}},{{appiit_loclongitude}}\"  target=\"_blank\"><mat-icon class=\"fa fa-map-marker mapicon\" ></mat-icon></a></p>\r\n                </div>\r\n                <div class=\"add-details\" fxFlex.gt-sm=\"20\"  fxFlex=\"50\" >\r\n                    <p class=\"text-gray fs-14\">{{'invoice.dateexoi' | translate}} <br>\r\n                    <span class=\"text-default\">{{appdt_certificateexpiry}}</span> </p>\r\n                </div>\r\n                <div class=\"add-details\" fxFlex.gt-sm=\"20\"  fxFlex=\"50\" >\r\n                    <p class=\"text-gray fs-14\">{{'invoice.addon' | translate}} <br>\r\n                    <span class=\"text-default\">{{appdt_submittedon}}</span></p>\r\n                </div>\r\n                <div class=\"add-details\" fxFlex.gt-sm=\"20\"  fxFlex=\"50\" >\r\n                    <p class=\"text-gray fs-14\">{{'invoice.lastupdat' | translate}}<br>\r\n                    <span class=\"text-default\">{{appdt_updatedon}}</span></p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayoutAlign=\"flex-start\" fxLayout=\"row wrap\" class=\"m-b-40\">\r\n            <div class=\"feedetails m-t-20\" fxFlex.gt-md=\"40\" fxFlex=\"100\">\r\n                <h4 class=\"headcolor fs-18 m-0\">{{'invoice.certfeedeta' | translate}}</h4>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.invonumb' | translate}}</p>\r\n                    <span>{{apid_invoiceno}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\" *ngIf=\"appdt_status == 5\">\r\n                    <p class=\"m-0\">{{'invoice.invorrais' | translate}}</p>\r\n                    <span>{{apid_raisedon}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\" *ngIf=\"appdt_status == 5\">\r\n                    <p class=\"m-0\">{{'invoice.invoage' | translate}}</p>\r\n                    <span>{{age}} {{days}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.certfee' | translate}}</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; {{apppdt_amount}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.vat' | translate}}(5%) </p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; {{apppdt_vatpercent}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.totaamou' | translate}}</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; {{totalamt}}</span>\r\n                </div>\r\n            </div>\r\n            <div class=\"feedetails\" ngClass=\"m-t-28\" fxFlex.gt-md=\"35\" \r\n                fxFlex=\"100\"  *ngIf=\"appdt_status != 5\">\r\n                <h4 class=\"headcolor fs-18 m-0\">{{'invoice.paymdeta' | translate}}</h4>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.paymmode' | translate}}</p>\r\n                    <span>{{apppdt_paymentmode}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.tranid' | translate}}</p>\r\n                    <span>{{apppdt_transuniqueId}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.bankname' | translate}}</p>\r\n                    <span>{{apppdt_bankname}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.dateofpaym' | translate}}</p>\r\n                    <span>{{apppdt_dateofpymt}}</span>\r\n                </div>\r\n                <!-- <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.paymproo' | translate}}</p>\r\n                    <span class=\"document\" matTooptip=\"cr activity pdf\"><img src=\"assets\\images\\opalimages\\pdf.png\"\r\n                            alt=\"\" cractivitydocument></span>\r\n                </div> -->\r\n\r\n            </div>\r\n           <div class=\"m-t-20\" *ngIf=\"notpayment\">\r\n                <!-- <div class=\"m-t-20\"> -->\r\n            <app-viewvalidation [hidebtn]=\"false\"  [callbackFn]=\"onValidation\"  [paymentcondition]=\"paymentcondition\" [paymentbutton]=\"true\" (dataEmitter)=\"receiveData($event)\"></app-viewvalidation>\r\n           </div>\r\n        </div>\r\n        <mat-divider></mat-divider>\r\n        <div class=\"comments m-t-20\" *ngIf=\"apppdt_status == 3 || apppdt_status == 4\">\r\n            <div class=\"title m-b-20\" fxLayout=\"row wrap\" fxLayoutAlign=\"space-between center\">\r\n               <div class=\"title\" fxLayout=\"row\">\r\n                <h4 class=\"m-r-10 m-0\">{{'invoice.verification' | translate}}</h4>\r\n                <span class=\"badge decl\" *ngIf=\"apppdt_status == 4\">{{'invoice.notrece' | translate}}</span>\r\n                <span class=\"badge appr\" *ngIf=\"apppdt_status == 3\">{{'invoice.receive' | translate}}</span>\r\n               </div>\r\n               <!-- <app-viewvalidation [hidebtn]=\"true\" [condition]=\"condition\"></app-viewvalidation> -->\r\n            </div>\r\n            <div   [ngClass]=\"apppdt_status == 3 ? 'successcmd' : 'declinecmd'\" class=\" m-l-0 m-r-0 m-b-20\">\r\n                <p class=\"18 comment\">{{'invoice.comm' | translate}}</p>\r\n                <p class=\"16 m-b-30\"  [innerHtml]='apppdt_appdeccomment'> </p>\r\n                <mat-divider></mat-divider>\r\n                <div class=\"validinfo\" fxLayout=\"row wrap\">\r\n                    <p class=\"fs-16 txt-gry m-r-40\">{{'invoice.lastvalion' | translate}}:<span\r\n                            class=\"fs-16 txt-gry3 m-l-10\">{{apppdt_appdecon}}</span></p>\r\n                    <p class=\"fs-16 txt-gry\" ng>{{'invoice.lastvaliby' | translate}}:<span\r\n                            class=\"fs-16 txt-gry3 m-l-10\">{{oum_firstname}}</span></p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>");

/***/ }),

/***/ "./src/app/modules/paymentinvoice/paymentinvoice-routing.module.ts":
/*!*************************************************************************!*\
  !*** ./src/app/modules/paymentinvoice/paymentinvoice-routing.module.ts ***!
  \*************************************************************************/
/*! exports provided: PaymentinvoiceRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PaymentinvoiceRoutingModule", function() { return PaymentinvoiceRoutingModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _paymentprofile_paymentprofile_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./paymentprofile/paymentprofile.component */ "./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.ts");




const routes = [
    {
        path: '',
        children: [
            {
                path: 'invoice',
                component: _paymentprofile_paymentprofile_component__WEBPACK_IMPORTED_MODULE_3__["PaymentprofileComponent"],
                data: {
                    title: 'View Invoice',
                    urls: [
                        { title: 'Training Evaluation Centre Approval', url: '/paymentinvoiceindex/invoice' }
                    ]
                },
            },
        ],
    },
];
let PaymentinvoiceRoutingModule = class PaymentinvoiceRoutingModule {
};
PaymentinvoiceRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })
], PaymentinvoiceRoutingModule);



/***/ }),

/***/ "./src/app/modules/paymentinvoice/paymentinvoice.module.ts":
/*!*****************************************************************!*\
  !*** ./src/app/modules/paymentinvoice/paymentinvoice.module.ts ***!
  \*****************************************************************/
/*! exports provided: createTranslateLoader, PaymentinvoiceModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function() { return createTranslateLoader; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PaymentinvoiceModule", function() { return PaymentinvoiceModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
/* harmony import */ var _paymentinvoice_routing_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./paymentinvoice-routing.module */ "./src/app/modules/paymentinvoice/paymentinvoice-routing.module.ts");
/* harmony import */ var _paymentprofile_paymentprofile_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./paymentprofile/paymentprofile.component */ "./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.ts");
/* harmony import */ var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/flex-layout */ "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @ngx-translate/http-loader */ "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _app_shared_shared_module__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @app/@shared/shared.module */ "./src/app/@shared/shared.module.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");











function createTranslateLoader(http) {
    return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_7__["TranslateHttpLoader"](http, './assets/i18n/payment/', '.json');
}
let PaymentinvoiceModule = class PaymentinvoiceModule {
};
PaymentinvoiceModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        declarations: [_paymentprofile_paymentprofile_component__WEBPACK_IMPORTED_MODULE_4__["PaymentprofileComponent"]],
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"],
            _paymentinvoice_routing_module__WEBPACK_IMPORTED_MODULE_3__["PaymentinvoiceRoutingModule"],
            _app_shared_shared_module__WEBPACK_IMPORTED_MODULE_9__["SharedModule"],
            _ngx_translate_core__WEBPACK_IMPORTED_MODULE_10__["TranslateModule"],
            _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__["FlexLayoutModule"],
            _angular_common_http__WEBPACK_IMPORTED_MODULE_6__["HttpClientModule"],
            _ngx_translate_core__WEBPACK_IMPORTED_MODULE_10__["TranslateModule"].forChild({
                loader: {
                    provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_10__["TranslateLoader"],
                    useFactory: createTranslateLoader,
                    deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_6__["HttpClient"]]
                }
            }),
        ],
        providers: [
            _app_remote_service__WEBPACK_IMPORTED_MODULE_8__["RemoteService"]
        ]
    })
], PaymentinvoiceModule);



/***/ }),

/***/ "./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.scss":
/*!*************************************************************************************!*\
  !*** ./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.scss ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#paymented .knowledgegrid {\n  background: #FFFFFF 0% 0% no-repeat padding-box;\n  box-shadow: 0px 0px 8px #0000001a;\n  border: 1px solid #D7DCE3;\n  border-radius: 4px;\n  opacity: 1;\n  padding: 10px;\n}\n#paymented .knowledgegrid .text-gray {\n  color: #848484;\n}\n#paymented .knowledgegrid .text-default {\n  color: #262626 !important;\n}\n#paymented .knowledgegrid .bold {\n  font-weight: 600;\n}\n#paymented .knowledgegrid .details .head {\n  justify-content: space-between;\n  align-items: center;\n  height: 40px;\n}\n#paymented .knowledgegrid .details .head .grade {\n  align-items: center;\n  color: #895B37;\n}\n#paymented .knowledgegrid .details .head .gold {\n  align-items: center;\n  color: #BA9666;\n}\n#paymented .knowledgegrid .details .head .silver {\n  align-items: center;\n  color: #B9BABC;\n}\n#paymented .knowledgegrid .details .application-detais {\n  border: 1px solid #D7DCE3;\n  padding: 5px;\n  margin-top: 10px !important;\n}\n#paymented .knowledgegrid .address {\n  justify-content: space-between;\n  width: 60%;\n}\n#paymented .knowledgegrid .address .add-details i {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #707070;\n}\n#paymented h4 {\n  color: #0C4B9A;\n}\n#paymented .feedetails .view_dtl p {\n  min-width: 200px;\n  color: #848484;\n  font-size: 16px;\n}\n@media (max-width: 768px) {\n  #paymented .feedetails .view_dtl p {\n    min-width: 178px;\n  }\n}\n#paymented .feedetails .view_dtl span {\n  color: #262626;\n  font-size: 16px;\n}\n#paymented .feedetails .view_dtl span .document {\n  width: 22px;\n  height: 28px;\n}\n#paymented .badge {\n  color: #fff;\n  padding: 3px 5px;\n  font-size: 15px;\n  border-radius: 3px;\n}\n#paymented .badge.pendings {\n  background-color: #f4811f;\n}\n#paymented .badge.update {\n  background-color: #0c4b9a;\n}\n#paymented .badge.appr {\n  background-color: #00a551;\n}\n#paymented .badge.decl {\n  background-color: #ed1c27;\n}\n#paymented .validet {\n  background-color: #0C4B9A !important;\n  color: #fff !important;\n}\n#paymented .successcmd {\n  border: 1px solid #00a551;\n  border-radius: 3px;\n  padding: 15px 15px 10px 15px;\n  background-color: #f8fffb;\n}\n#paymented .successcmd .comment {\n  color: #00a551 !important;\n}\n#paymented .successcmd p {\n  color: #262626;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9wYXltZW50aW52b2ljZS9wYXltZW50cHJvZmlsZS9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxwYXltZW50aW52b2ljZVxccGF5bWVudHByb2ZpbGVcXHBheW1lbnRwcm9maWxlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL3BheW1lbnRpbnZvaWNlL3BheW1lbnRwcm9maWxlL3BheW1lbnRwcm9maWxlLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUNJO0VBQ0ksK0NBQUE7RUFDQSxpQ0FBQTtFQUNBLHlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxVQUFBO0VBQ0EsYUFBQTtBQ0FSO0FERVE7RUFDSSxjQUFBO0FDQVo7QURHUTtFQUNJLHlCQUFBO0FDRFo7QURJUTtFQUNJLGdCQUFBO0FDRlo7QURPWTtFQUNJLDhCQUFBO0VBQ0EsbUJBQUE7RUFDQSxZQUFBO0FDTGhCO0FET2dCO0VBQ0ksbUJBQUE7RUFDQSxjQUFBO0FDTHBCO0FEUWdCO0VBQ0ksbUJBQUE7RUFDQSxjQUFBO0FDTnBCO0FEU2dCO0VBQ0ksbUJBQUE7RUFDQSxjQUFBO0FDUHBCO0FEV1k7RUFDSSx5QkFBQTtFQUNBLFlBQUE7RUFDQSwyQkFBQTtBQ1RoQjtBRGNRO0VBQ0ksOEJBQUE7RUFDQSxVQUFBO0FDWlo7QURlZ0I7RUFFSSxrQkFBQTtFQUNBLDhCQUFBO0VBQ0Esa0NBQUE7QUNkcEI7QURxQkk7RUFDSSxjQUFBO0FDbkJSO0FEMEJZO0VBQ0ksZ0JBQUE7RUFDQSxjQUFBO0VBQ0EsZUFBQTtBQ3hCaEI7QUQwQmdCO0VBTEo7SUFNUSxnQkFBQTtFQ3ZCbEI7QUFDRjtBRDBCWTtFQUNJLGNBQUE7RUFDQSxlQUFBO0FDeEJoQjtBRDBCZ0I7RUFDSSxXQUFBO0VBQ0EsWUFBQTtBQ3hCcEI7QUQ4Qkk7RUFDSSxXQUFBO0VBQ0EsZ0JBQUE7RUFDQSxlQUFBO0VBQ0Esa0JBQUE7QUM1QlI7QUQ4QlE7RUFDSSx5QkFBQTtBQzVCWjtBRCtCUTtFQUNJLHlCQUFBO0FDN0JaO0FEZ0NRO0VBQ0kseUJBQUE7QUM5Qlo7QURpQ1E7RUFDSSx5QkFBQTtBQy9CWjtBRG9DSTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNsQ1I7QURxQ0k7RUFDSSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSx5QkFBQTtBQ25DUjtBRHFDUTtFQUNJLHlCQUFBO0FDbkNaO0FEc0NRO0VBQ0ksY0FBQTtBQ3BDWiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvcGF5bWVudGludm9pY2UvcGF5bWVudHByb2ZpbGUvcGF5bWVudHByb2ZpbGUuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjcGF5bWVudGVkIHtcclxuICAgIC5rbm93bGVkZ2VncmlkIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjRkZGRkZGIDAlIDAlIG5vLXJlcGVhdCBwYWRkaW5nLWJveDtcclxuICAgICAgICBib3gtc2hhZG93OiAwcHggMHB4IDhweCAjMDAwMDAwMWE7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI0Q3RENFMztcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICBwYWRkaW5nOiAxMHB4O1xyXG5cclxuICAgICAgICAudGV4dC1ncmF5IHtcclxuICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAudGV4dC1kZWZhdWx0IHtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjYgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5ib2xkIHtcclxuICAgICAgICAgICAgZm9udC13ZWlnaHQ6IDYwMDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5kZXRhaWxzIHtcclxuXHJcbiAgICAgICAgICAgIC5oZWFkIHtcclxuICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDQwcHg7XHJcblxyXG4gICAgICAgICAgICAgICAgLmdyYWRlIHtcclxuICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODk1QjM3O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5nb2xkIHtcclxuICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjQkE5NjY2O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5zaWx2ZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNCOUJBQkM7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5hcHBsaWNhdGlvbi1kZXRhaXMge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI0Q3RENFMztcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDVweDtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDEwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5hZGRyZXNzIHtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICB3aWR0aDogNjAlO1xyXG5cclxuICAgICAgICAgICAgLmFkZC1kZXRhaWxzIHtcclxuICAgICAgICAgICAgICAgIGkge1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS13aWR0aDogMXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2UtY29sb3I6ICM3MDcwNzA7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIGg0IHtcclxuICAgICAgICBjb2xvcjogIzBDNEI5QTtcclxuICAgIH1cclxuXHJcbiAgICAuZmVlZGV0YWlscyB7XHJcblxyXG5cclxuICAgICAgICAudmlld19kdGwge1xyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMjAwcHg7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTZweDtcclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMTc4cHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE2cHg7XHJcblxyXG4gICAgICAgICAgICAgICAgLmRvY3VtZW50IHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMjJweDtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDI4cHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmJhZGdlIHtcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBwYWRkaW5nOiAzcHggNXB4O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcblxyXG4gICAgICAgICYucGVuZGluZ3Mge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjQ4MTFmO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi51cGRhdGUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5hcHByIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwYTU1MTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYuZGVjbCB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjc7XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAudmFsaWRldCB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBDNEI5QSAhaW1wb3J0YW50O1xyXG4gICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnN1Y2Nlc3NjbWQge1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICMwMGE1NTE7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4O1xyXG4gICAgICAgIHBhZGRpbmc6IDE1cHggMTVweCAxMHB4IDE1cHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZmZmYjtcclxuXHJcbiAgICAgICAgLmNvbW1lbnQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzAwYTU1MSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgcCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufSIsIiNwYXltZW50ZWQgLmtub3dsZWRnZWdyaWQge1xuICBiYWNrZ3JvdW5kOiAjRkZGRkZGIDAlIDAlIG5vLXJlcGVhdCBwYWRkaW5nLWJveDtcbiAgYm94LXNoYWRvdzogMHB4IDBweCA4cHggIzAwMDAwMDFhO1xuICBib3JkZXI6IDFweCBzb2xpZCAjRDdEQ0UzO1xuICBib3JkZXItcmFkaXVzOiA0cHg7XG4gIG9wYWNpdHk6IDE7XG4gIHBhZGRpbmc6IDEwcHg7XG59XG4jcGF5bWVudGVkIC5rbm93bGVkZ2VncmlkIC50ZXh0LWdyYXkge1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNwYXltZW50ZWQgLmtub3dsZWRnZWdyaWQgLnRleHQtZGVmYXVsdCB7XG4gIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XG59XG4jcGF5bWVudGVkIC5rbm93bGVkZ2VncmlkIC5ib2xkIHtcbiAgZm9udC13ZWlnaHQ6IDYwMDtcbn1cbiNwYXltZW50ZWQgLmtub3dsZWRnZWdyaWQgLmRldGFpbHMgLmhlYWQge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGhlaWdodDogNDBweDtcbn1cbiNwYXltZW50ZWQgLmtub3dsZWRnZWdyaWQgLmRldGFpbHMgLmhlYWQgLmdyYWRlIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY29sb3I6ICM4OTVCMzc7XG59XG4jcGF5bWVudGVkIC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIC5nb2xkIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY29sb3I6ICNCQTk2NjY7XG59XG4jcGF5bWVudGVkIC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIC5zaWx2ZXIge1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBjb2xvcjogI0I5QkFCQztcbn1cbiNwYXltZW50ZWQgLmtub3dsZWRnZWdyaWQgLmRldGFpbHMgLmFwcGxpY2F0aW9uLWRldGFpcyB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNEN0RDRTM7XG4gIHBhZGRpbmc6IDVweDtcbiAgbWFyZ2luLXRvcDogMTBweCAhaW1wb3J0YW50O1xufVxuI3BheW1lbnRlZCAua25vd2xlZGdlZ3JpZCAuYWRkcmVzcyB7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgd2lkdGg6IDYwJTtcbn1cbiNwYXltZW50ZWQgLmtub3dsZWRnZWdyaWQgLmFkZHJlc3MgLmFkZC1kZXRhaWxzIGkge1xuICBjb2xvcjogdHJhbnNwYXJlbnQ7XG4gIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDFweDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogIzcwNzA3MDtcbn1cbiNwYXltZW50ZWQgaDQge1xuICBjb2xvcjogIzBDNEI5QTtcbn1cbiNwYXltZW50ZWQgLmZlZWRldGFpbHMgLnZpZXdfZHRsIHAge1xuICBtaW4td2lkdGg6IDIwMHB4O1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gICNwYXltZW50ZWQgLmZlZWRldGFpbHMgLnZpZXdfZHRsIHAge1xuICAgIG1pbi13aWR0aDogMTc4cHg7XG4gIH1cbn1cbiNwYXltZW50ZWQgLmZlZWRldGFpbHMgLnZpZXdfZHRsIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuI3BheW1lbnRlZCAuZmVlZGV0YWlscyAudmlld19kdGwgc3BhbiAuZG9jdW1lbnQge1xuICB3aWR0aDogMjJweDtcbiAgaGVpZ2h0OiAyOHB4O1xufVxuI3BheW1lbnRlZCAuYmFkZ2Uge1xuICBjb2xvcjogI2ZmZjtcbiAgcGFkZGluZzogM3B4IDVweDtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG59XG4jcGF5bWVudGVkIC5iYWRnZS5wZW5kaW5ncyB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmNDgxMWY7XG59XG4jcGF5bWVudGVkIC5iYWRnZS51cGRhdGUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xufVxuI3BheW1lbnRlZCAuYmFkZ2UuYXBwciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTE7XG59XG4jcGF5bWVudGVkIC5iYWRnZS5kZWNsIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNztcbn1cbiNwYXltZW50ZWQgLnZhbGlkZXQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMEM0QjlBICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG4jcGF5bWVudGVkIC5zdWNjZXNzY21kIHtcbiAgYm9yZGVyOiAxcHggc29saWQgIzAwYTU1MTtcbiAgYm9yZGVyLXJhZGl1czogM3B4O1xuICBwYWRkaW5nOiAxNXB4IDE1cHggMTBweCAxNXB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmZmZiO1xufVxuI3BheW1lbnRlZCAuc3VjY2Vzc2NtZCAuY29tbWVudCB7XG4gIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XG59XG4jcGF5bWVudGVkIC5zdWNjZXNzY21kIHAge1xuICBjb2xvcjogIzI2MjYyNjtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.ts":
/*!***********************************************************************************!*\
  !*** ./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.ts ***!
  \***********************************************************************************/
/*! exports provided: PaymentprofileComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PaymentprofileComponent", function() { return PaymentprofileComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var ngx_toastr__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ngx-toastr */ "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
/* harmony import */ var _app_services_application_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @app/services/application.service */ "./src/app/services/application.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! sweetalert */ "./node_modules/sweetalert/dist/sweetalert.min.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_8__);










let PaymentprofileComponent = class PaymentprofileComponent {
    constructor(translate, remoteService, toastr, cookieService, routeid, route, appservice) {
        this.translate = translate;
        this.remoteService = remoteService;
        this.toastr = toastr;
        this.cookieService = cookieService;
        this.routeid = routeid;
        this.route = route;
        this.appservice = appservice;
        this.pending = false;
        this.recivied = true;
        this.bronze = false;
        this.gold = false;
        this.approvedcmd = false;
        this.validationstatus = false;
        this.disableSubmitButton = false;
        this.notpayment = false;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = "ltr";
        this.onValidation = this.onValidation.bind(this);
    }
    ngOnInit() {
        if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
            //this.patientCategory.get('patientCategory').setValue(toSelect);
            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
        }
        else {
            const toSelect = this.languagelist.find(c => c.id == '1');
            //this.patientCategory.get('patientCategory').setValue(toSelect);
            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
        }
        this.remoteService.getLanguageCookie().subscribe(data => {
            this.translate.setDefaultLang(this.cookieService.get('languageCode'));
            if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
                const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
                //this.patientCategory.get('patientCategory').setValue(toSelect);
                this.translate.setDefaultLang(toSelect.languagecode);
                this.dir = toSelect.dir;
            }
            else {
                const toSelect = this.languagelist.find(c => c.id == '1');
                //this.patientCategory.get('patientCategory').setValue(toSelect);
                this.translate.setDefaultLang(toSelect.languagecode);
                this.dir = toSelect.dir;
                if (toSelect.languagecode == 'en') {
                    this.ifarabic = false;
                }
                else {
                    this.ifarabic = true;
                }
            }
        });
        this.viewinvoice();
        // if(this.refname == 1) {
        //   this.notpayment = false;
        // } 
        // if(this.refname == 2) {
        //   this.notpayment = true;
        // }
        // if(this.refname == 3) {
        //   this.notpayment = true;
        //   this.paymentcondition = true;
        //   this.validationstatus = true;
        //   this.condition = true;
        // }
        this.paymentdata();
    }
    paymentdata() {
        if (this.refname) {
            this.appservice.getpayment(this.refname).subscribe(data => {
                this.appdt_appreferno = data.data.data.appdt_appreferno;
                this.appdt_status = data.data.data.appdt_status;
                if (this.appdt_status == 6) {
                    this.notpayment = true;
                }
                else {
                    this.notpayment = false;
                }
                this.appiit_officetype = (data.data.data.appiit_officetype == 1) ? 'Main Office' : 'Branch Office';
                this.appdt_apptype = (data.data.data.appdt_apptype == 1) ? 'Initial' : (data.data.data.appdt_apptype == 2) ? 'Renewal' : 'Updated';
                this.appdt_certificateexpiry = data.data.data.appdt_certificateexpiry;
                this.appdt_certificategenon = data.data.data.appdt_certificategenon;
                this.appdt_submittedon = data.data.data.appdt_submittedon;
                this.appdt_updatedon = data.data.data.appdt_updatedon;
                this.apppdt_appdeccomment = data.data.data.apppdt_appdeccomment;
                this.apppdt_appdecon = data.data.data.apppdt_appdecon;
                this.apppdt_appdecby = data.data.data.apppdt_appdecby;
                this.gm_gradename_en = (this.arabic == true) ? data.data.data.gm_gradename_ar : data.data.data.gm_gradename_en;
                this.appiit_branchname_en = (this.arabic == true) ? data.data.data.appiit_branchname_ar : data.data.data.appiit_branchname_en;
                this.omrm_companyname_en = (this.arabic == true) ? data.data.data.omrm_companyname_ar : data.data.data.omrm_companyname_en;
                this.omrm_tpname_en = (this.arabic == true) ? data.data.data.omrm_tpname_ar : data.data.data.omrm_tpname_en;
                this.apid_raisedon = data.data.data.apid_raisedon;
                var current_date = new Date();
                var specific_date = new Date(this.appdt_certificateexpiry); //Year, Month, Date   
                var specific_date1 = new Date(this.apid_raisedon);
                if (current_date.getTime() > specific_date.getTime()) {
                    this.isexpired = 1;
                }
                else {
                    this.isexpired = 0;
                }
                this.appiit_loclatitude = data.data.data.appiit_loclatitude;
                this.appiit_loclongitude = data.data.data.appiit_loclongitude;
                this.apppdt_vatchrgs = data.data.data.apppdt_vatchrgs;
                this.apppdt_vatpercent = Number(data.data.data.apppdt_vatpercent);
                this.apppdt_amount = data.data.data.apppdt_amount;
                this.apppdt_currency = data.data.data.apppdt_currency;
                this.totalamt = Number(this.apppdt_amount) + Number(this.apppdt_vatchrgs);
                this.apppdt_bankname = data.data.data.apppdt_bankname;
                this.apppdt_dateofpymt = data.data.data.apppdt_dateofpymt;
                this.apppdt_transuniqueId = data.data.data.apppdt_transuniqueId;
                this.oum_firstname = data.data.data.oum_firstname;
                this.apppdt_orderrefno = data.data.data.apppdt_orderrefno;
                this.apid_invoiceno = data.data.data.apid_invoiceno;
                this.apppdt_status = data.data.data.apppdt_status;
                const days = (date_1, date_2) => {
                    let difference = date_1.getTime() - date_2.getTime();
                    let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
                    return TotalDays;
                };
                this.age = days(specific_date1, current_date);
                this.days = (this.age == 1) ? 'Day' : 'Days';
                this.apppdt_paymentmode = (data.data.data.apppdt_paymentmode == 1) ? 'Cheque' : (data.data.data.apppdt_paymentmode == 2) ? 'Bank Transfer' : 'Cash';
                this.apppdt_appdeccomment = (data.data.data.apppdt_appdeccomment) ? data.data.data.apppdt_appdeccomment : 'Nil';
            });
        }
    }
    receiveData(data) {
        this.validationstatus = data;
    }
    viewinvoice() {
        this.routeid.queryParams.subscribe(params => {
            this.refname = params['id'];
        });
    }
    onValidation(form, resetForm) {
        this.disableSubmitButton = true;
        this.appservice.updatePayment(form.value, this.refname).subscribe(data => {
            this.disableSubmitButton = false;
            if (data.data.msg == 'false') {
                resetForm();
                sweetalert__WEBPACK_IMPORTED_MODULE_8___default()({
                    title: "something went wrong.",
                    text: " ",
                    icon: 'warning',
                    buttons: [false, "ok"],
                    dangerMode: true,
                    closeOnClickOutside: false
                }).then(() => {
                    // this.standardTemplate = 'MainCentre';
                });
            }
            else {
                sweetalert__WEBPACK_IMPORTED_MODULE_8___default()({
                    title: "Successfully Payment  Status changed",
                    text: " ",
                    icon: 'warning',
                    buttons: [false, "Ok"],
                    dangerMode: true,
                    closeOnClickOutside: false
                }).then(() => {
                    this.apppdt_status = data.data.data.apppdt_status;
                    this.apppdt_appdecon = data.data.data.apppdt_appdecon;
                    this.apppdt_appdecby = data.data.data.apppdt_appdecby;
                    this.apppdt_appdeccomment = (data.data.data.apppdt_appdeccomment) ? data.data.data.apppdt_appdeccomment : 'Nil';
                    this.route.navigate(['centrecertification/home']);
                });
            }
        });
    }
};
PaymentprofileComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"] },
    { type: ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_7__["ActivatedRoute"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_7__["Router"] },
    { type: _app_services_application_service__WEBPACK_IMPORTED_MODULE_6__["ApplicationService"] }
];
PaymentprofileComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-paymentprofile',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./paymentprofile.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./paymentprofile.component.scss */ "./src/app/modules/paymentinvoice/paymentprofile/paymentprofile.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"], _angular_router__WEBPACK_IMPORTED_MODULE_7__["ActivatedRoute"], _angular_router__WEBPACK_IMPORTED_MODULE_7__["Router"],
        _app_services_application_service__WEBPACK_IMPORTED_MODULE_6__["ApplicationService"]])
], PaymentprofileComponent);



/***/ })

}]);
//# sourceMappingURL=modules-paymentinvoice-paymentinvoice-module-es2015.js.map