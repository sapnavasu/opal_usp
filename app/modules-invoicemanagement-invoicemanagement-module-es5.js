function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-invoicemanagement-invoicemanagement-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.html":
  /*!****************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.html ***!
    \****************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesInvoicemanagementInvoicecentreInvoicecentreComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<app-responseloader *ngIf=\"pageloader\"></app-responseloader>\r\n<div fxLayout=\"row wrap\" fxLayoutAlign=\"center\" id=\"centrecertificate\">\r\n    <div fxFlex.gt-sm=\"90\" fxFlex=\"100\" [ngSwitch]=\"trainingevaluation\">\r\n        <ng-template [ngSwitchCase]=\"'tabs'\">\r\n            <mat-tab-group class=\"tabsdetials dashtabs\">\r\n                <!--Training Tab-->\r\n                <mat-tab>\r\n                    <ng-template mat-tab-label>\r\n                        <div class=\"tabscontent\">\r\n                            <div class=\"tabtitle\">\r\n                                <p class=\"fs-14\">{{'invoice.traineval' | translate}}</p>\r\n                            </div>\r\n                        </div>\r\n                    </ng-template>\r\n                    <div class=\"paginationwithfilter masterPageTop \" fxLayout=\"row wrap\">\r\n                        <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                        <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\"\r\n                            [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                            (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                    class=\"ShowHidefs-15 exportbtn m-r-10 fs-15\">{{'invoice.export' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent()\"\r\n                                    class=\"filter fs-15\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                        aria-hidden=\"true\"></i></button>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                            <div class=\"awaredtable\">\r\n                                <mat-table #table class=\"scrolldata\" [dataSource]=\"TrainingData\" matSort\r\n                                    matSortDisableClear>\r\n                                    <ng-container matColumnDef=\"invoiceno\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invonumb' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceno\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceno}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"compannyname\">\r\n                                        <mat-header-cell fxFlex=\"300px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.companyname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"compannyname\" fxFlex=\"300px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.compannyname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"trainingprovider\">\r\n                                        <mat-header-cell fxFlex=\"260px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.trainname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"trainingprovider\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.trainingprovider}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"officetype\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.offitype' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"officetype\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.officetype}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"branchname\">\r\n                                        <mat-header-cell fxFlex=\"270px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.branchname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"branchname\" fxFlex=\"270px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.branchname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"opalmember\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.opalmemb' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"opalmember\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.opalmember}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"Feetype\">\r\n                                        <mat-header-cell fxFlex=\"230px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.fee' |translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"Feetype\" fxFlex=\"230px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.Feetype}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceamount\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invoamount' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceamount\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceamount}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentstatus\">\r\n                                        <mat-header-cell fxFlex=\"280px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.status' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"paymentstatus\" fxFlex=\"280px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <span class=\"receive\"\r\n                                                *ngIf=\"trainingEvaluationData.paymentstatus == 'R'\">{{'invoice.receive'\r\n                                                |translate}}</span>\r\n                                            <span class=\"pending\"\r\n                                                *ngIf=\"trainingEvaluationData.paymentstatus == 'P'\">{{'invoice.pending'\r\n                                                |translate}}</span>\r\n                                            <span class=\"paid\"\r\n                                                *ngIf=\"trainingEvaluationData.paymentstatus == 'Paid'\">{{'invoice.paid'\r\n                                                |translate}}</span>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymenttype\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.paymtype' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"paymenttype\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <span *ngIf=\"trainingEvaluationData.paymenttype == 'O'\">{{'invoice.online'\r\n                                                |translate}}</span>\r\n                                            <span\r\n                                                *ngIf=\"trainingEvaluationData.paymenttype == 'B'\">{{'invoice.banktrans'\r\n                                                |translate}}</span>\r\n                                            <span *ngIf=\"trainingEvaluationData.paymenttype == 'CA'\">{{'invoice.check'\r\n                                                |translate}}</span>\r\n                                            <span\r\n                                                *ngIf=\"trainingEvaluationData.paymenttype == 'CH'\">{{'invoice.castdepo'\r\n                                                |translate}}</span>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoicedate\">\r\n                                        <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invodate' | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoicedate\" fxFlex=\"190px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoicedate}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceage\">\r\n                                        <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.invoage' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceage\" fxFlex=\"150px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceage}}</mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentdate\">\r\n                                        <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.paydate' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"paymentdate\" fxFlex=\"180px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.paymentdate}} </mat-cell>\r\n                                    </ng-container>\r\n\r\n                                    <ng-container matColumnDef=\"action\">\r\n                                        <mat-header-cell fxFlex=\"100px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.action'\r\n                                            | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"action\" fxFlex=\"100px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <div class=\"manageoptions\">\r\n                                                <button type=\"button\" mat-menu-item><a href=\"#\">{{'invoice.view' |\r\n                                                        translate}}</a></button>\r\n                                            </div>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-first\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"invoice_no\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-second\">\r\n                                        <mat-header-cell fxFlex=\"290px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"company_name\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-three\">\r\n                                        <mat-header-cell fxFlex=\"260px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"training_provider\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-four\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"office_type\">\r\n                                                    <mat-option value=\"1\">{{'invoice.main' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.branch' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-five\">\r\n                                        <mat-header-cell fxFlex=\"270px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"bran_name\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-six\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"opal_membership\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-seven\">\r\n                                        <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"Fee_type\">\r\n                                                    <mat-option value=\"1\">Centre Registration(initial)</mat-option>\r\n                                                    <mat-option value=\"2\">Centre Registration(renewal)</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eight\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-nine\">\r\n                                        <mat-header-cell fxFlex=\"280px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"pay_status\">\r\n                                                    <mat-option value=\"1\">{{'invoice.receive' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.pending' |translate}}</mat-option>\r\n                                                    <mat-option value=\"3\">{{'invoice.paid' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-ten\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"pay_type\">\r\n                                                    <mat-option value=\"1\">{{'invoice.online' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.banktrans'\r\n                                                        |translate}}</mat-option>\r\n                                                    <mat-option value=\"3\">{{'invoice.check' |translate}}</mat-option>\r\n                                                    <mat-option value=\"4\">{{'invoice.castdepo' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eleven\">\r\n                                        <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"invoice_date\"\r\n                                                    (click)=\"invoicedate.open()\" [matDatepicker]=\"invoicedate\">\r\n                                                <mat-datepicker-toggle matSuffix\r\n                                                    [for]=\"invoicedate\"></mat-datepicker-toggle>\r\n                                                <mat-datepicker #invoicedate></mat-datepicker>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-twelve\">\r\n                                        <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"invoice_age\">\r\n                                                    <mat-option value=\"1\">20 Days</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-thirteen\">\r\n                                        <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"payment_date\"\r\n                                                    (click)=\"paymentdate.open()\" [matDatepicker]=\"paymentdate\">\r\n                                                <mat-datepicker-toggle matSuffix\r\n                                                    [for]=\"paymentdate\"></mat-datepicker-toggle>\r\n                                                <mat-datepicker #paymentdate></mat-datepicker>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"TrainingListData\">\r\n                                    </mat-header-row>\r\n                                    <mat-header-row id=\"searchrow\"\r\n                                        *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-three' , 'row-four' , 'row-five' , 'row-six' , 'row-seven' , 'row-eight' , 'row-nine' , 'row-ten' , 'row-eleven' , 'row-twelve' , 'row-thirteen']\">\r\n                                    </mat-header-row>\r\n                                    <mat-row mat-row *matRowDef=\"let row; columns: TrainingListData;\"></mat-row>\r\n                                </mat-table>\r\n                            </div>\r\n                            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                    <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                        class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                        [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                        [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                        [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                    </mat-paginator>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"btngroup m-t-30 m-b-10\" fxLayout=\"row\" fxLayoutAlign=\"flex-end\">\r\n                        <button mat-raised-button class=\"cancelbtn\" type=\"button\">{{'invoice.prev' |\r\n                            translate}}</button>\r\n                        <button mat-raised-button class=\"submit_btn m-l-20\" (click)=\"next()\"\r\n                            type=\"submit\">{{'invoice.next' |\r\n                            translate}}</button>\r\n                    </div>\r\n                </mat-tab>\r\n                <!--Technical Tab-->\r\n                <mat-tab [ngSwitch]=\"technicalevaluation\">\r\n                    <ng-template mat-tab-label>\r\n                        <div class=\"tabscontent\">\r\n                            <div class=\"tabtitle\">\r\n                                <p class=\"fs-14\">{{'invoice.techeval' | translate}}</p>\r\n                            </div>\r\n                        </div>\r\n                    </ng-template>\r\n                    <div class=\"paginationwithfilter masterPageTop \" fxLayout=\"row wrap\">\r\n                        <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                        <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\"\r\n                            [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                            (page)=\"syncPrimaryPaginators($event);\"></mat-paginator>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                    class=\"ShowHidefs-15 exportbtn m-r-10 fs-15\">{{'invoice.export' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickedEvent()\"\r\n                                    class=\"filter fs-15\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                        aria-hidden=\"true\"></i></button>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                            <div class=\"awaredtable\">\r\n                                <mat-table #table class=\"scrolldata\" [dataSource]=\"TechnicalData\" matSort\r\n                                    matSortDisableClear>\r\n                                    <ng-container matColumnDef=\"invoiceno\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invonumb' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceno\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceno}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"compannyname\">\r\n                                        <mat-header-cell fxFlex=\"300px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.companyname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"compannyname\" fxFlex=\"300px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.compannyname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"centrename\">\r\n                                        <mat-header-cell fxFlex=\"260px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.centrename' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"centrename\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.centrename}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"officetype\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.offitype' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"officetype\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.officetype}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"branchname\">\r\n                                        <mat-header-cell fxFlex=\"270px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.branchname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"branchname\" fxFlex=\"270px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.branchname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"opalmember\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.opalmemb' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"opalmember\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.opalmember}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"projectname\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.projname' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"projectname\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.projectname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"Feetype\">\r\n                                        <mat-header-cell fxFlex=\"230px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.fee' |translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"Feetype\" fxFlex=\"230px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.Feetype}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"noofstaff\">\r\n                                        <mat-header-cell fxFlex=\"190px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.nostaff' |translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"noofstaff\" fxFlex=\"190px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.noofstaff}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceamount\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invoamount' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceamount\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceamount}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentstatus\">\r\n                                        <mat-header-cell fxFlex=\"280px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.status' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"paymentstatus\" fxFlex=\"280px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <span class=\"receive\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'R'\">{{'invoice.receive'\r\n                                            |translate}}</span>\r\n                                        <span class=\"pending\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'P'\">{{'invoice.pending'\r\n                                            |translate}}</span>\r\n                                        <span class=\"paid\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'Paid'\">{{'invoice.paid'\r\n                                            |translate}}</span>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymenttype\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.paymtype' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"paymenttype\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <span *ngIf=\"trainingEvaluationData.paymenttype == 'O'\">{{'invoice.online'\r\n                                                |translate}}</span>\r\n                                            <span\r\n                                                *ngIf=\"trainingEvaluationData.paymenttype == 'B'\">{{'invoice.banktrans'\r\n                                                |translate}}</span>\r\n                                            <span *ngIf=\"trainingEvaluationData.paymenttype == 'CA'\">{{'invoice.check'\r\n                                                |translate}}</span>\r\n                                            <span\r\n                                                *ngIf=\"trainingEvaluationData.paymenttype == 'CH'\">{{'invoice.castdepo'\r\n                                                |translate}}</span>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoicedate\">\r\n                                        <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invodate' | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoicedate\" fxFlex=\"190px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoicedate}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceage\">\r\n                                        <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.invoage' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceage\" fxFlex=\"150px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceage}}</mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentdate\">\r\n                                        <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.paydate' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"paymentdate\" fxFlex=\"180px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.paymentdate}} </mat-cell>\r\n                                    </ng-container>\r\n\r\n                                    <ng-container matColumnDef=\"action\">\r\n                                        <mat-header-cell fxFlex=\"100px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.action'\r\n                                            | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"action\" fxFlex=\"100px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <div class=\"manageoptions\">\r\n                                                <button type=\"button\" mat-menu-item><a href=\"#\">{{'invoice.view' |\r\n                                                        translate}}</a></button>\r\n                                            </div>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-first\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"invoiceno\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-second\">\r\n                                        <mat-header-cell fxFlex=\"290px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"companyname\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-three\">\r\n                                        <mat-header-cell fxFlex=\"260px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"centre_name\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-four\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"officetype\">\r\n                                                    <mat-option value=\"1\">{{'invoice.main' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.branch' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-five\">\r\n                                        <mat-header-cell fxFlex=\"270px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"branname\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-six\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"opalmembership\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-seven\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"projecttype\">\r\n                                                    <mat-option value=\"1\">Centre Registration(initial)</mat-option>\r\n                                                    <mat-option value=\"2\">Centre Registration(renewal)</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eight\">\r\n                                        <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"Feetype\">\r\n                                                    <mat-option value=\"1\">Centre Registration(initial)</mat-option>\r\n                                                    <mat-option value=\"2\">Centre Registration(renewal)</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-nine\">\r\n                                        <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"noofstaff\">\r\n                                                    <mat-option value=\"1\">20 </mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-ten\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eleven\">\r\n                                        <mat-header-cell fxFlex=\"280px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"paystatus\">\r\n                                                    <mat-option value=\"1\">{{'invoice.receive' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.pending' |translate}}</mat-option>\r\n                                                    <mat-option value=\"3\">{{'invoice.paid' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-twelve\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"paytype\">\r\n                                                    <mat-option value=\"1\">{{'invoice.online' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.banktrans'\r\n                                                        |translate}}</mat-option>\r\n                                                    <mat-option value=\"3\">{{'invoice.check' |translate}}</mat-option>\r\n                                                    <mat-option value=\"4\">{{'invoice.castdepo' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-thirteen\">\r\n                                        <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"invoicedate\" (click)=\"invoicedatepicker.open()\"\r\n                                                    [matDatepicker]=\"invoicedatepicker\">\r\n                                                <mat-datepicker-toggle matSuffix\r\n                                                    [for]=\"invoicedatepicker\"></mat-datepicker-toggle>\r\n                                                <mat-datepicker #invoicedatepicker></mat-datepicker>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-fourteen\">\r\n                                        <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"invoiceage\">\r\n                                                    <mat-option value=\"1\">20 Days</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-fifteen\">\r\n                                        <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"paymentdate\" (click)=\"paymentdatepicker.open()\"\r\n                                                    [matDatepicker]=\"paymentdatepicker\">\r\n                                                <mat-datepicker-toggle matSuffix\r\n                                                    [for]=\"paymentdatepicker\"></mat-datepicker-toggle>\r\n                                                <mat-datepicker #paymentdatepicker></mat-datepicker>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"TechnicalListData\">\r\n                                    </mat-header-row>\r\n                                    <mat-header-row id=\"searchrow\"\r\n                                        *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-three' , 'row-four' , 'row-five' , 'row-six' , 'row-seven' , 'row-eight' , 'row-nine' , 'row-ten' , 'row-eleven' , 'row-twelve' , 'row-thirteen' , 'row-fourteen' , 'row-fifteen']\">\r\n                                    </mat-header-row>\r\n                                    <mat-row mat-row *matRowDef=\"let row; columns: TechnicalListData;\"></mat-row>\r\n                                </mat-table>\r\n                            </div>\r\n                            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                    <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                        class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                        [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                        [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                        [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                    </mat-paginator>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"btngroup m-t-30 m-b-10\" fxLayout=\"row\" fxLayoutAlign=\"flex-end\">\r\n                        <button mat-raised-button class=\"cancelbtn\" type=\"button\">{{'invoice.prev' |\r\n                            translate}}</button>\r\n                        <button mat-raised-button class=\"submit_btn m-l-20\" (click)=\"nextpayment()\"\r\n                            type=\"submit\">{{'invoice.next' |\r\n                            translate}}</button>\r\n                    </div>\r\n                </mat-tab>\r\n            </mat-tab-group>\r\n        </ng-template>\r\n        <ng-template [ngSwitchCase]=\"'payment'\">\r\n            <app-paymentmanagement></app-paymentmanagement>\r\n        </ng-template>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.html":
  /*!****************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.html ***!
    \****************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesInvoicemanagementInvoicecourseInvoicecourseComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<app-responseloader *ngIf=\"pageloader\"></app-responseloader>\r\n<div fxLayout=\"row wrap\" fxLayoutAlign=\"center\" id=\"coursecertificate\">\r\n    <div fxFlex.gt-sm=\"90\" fxFlex=\"100\" [ngSwitch]=\"trainingevaluation\">\r\n        <ng-template [ngSwitchCase]=\"'technicalgridlist'\">\r\n            <div class=\"paginationwithfilter masterPageTop \" fxLayout=\"row wrap\">\r\n                <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                    [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginators($event);\"></mat-paginator>\r\n                <div fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <button mat-raised-button color=\"primary\" type=\"button\"\r\n                            class=\"ShowHidefs-15 exportbtn m-r-10 fs-15\">{{'invoice.export' | translate}}\r\n                        </button>\r\n                        <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickedEvent()\"\r\n                            class=\"filter fs-15\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                aria-hidden=\"true\"></i></button>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row wrap\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                    <div class=\"awaredtable\">\r\n                        <mat-table #table class=\"scrolldata\" [dataSource]=\"TechnicalData\" matSort matSortDisableClear>\r\n                            <ng-container matColumnDef=\"invoiceno\">\r\n                                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.invonumb' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"invoiceno\" fxFlex=\"250px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.invoiceno}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"coursetype\">\r\n                                <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.courtype' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"coursetype\" fxFlex=\"200px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.coursetype}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"compannyname\">\r\n                                <mat-header-cell fxFlex=\"300px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.companyname' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"compannyname\" fxFlex=\"300px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.compannyname}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"trainingprovider\">\r\n                                <mat-header-cell fxFlex=\"260px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.trainname' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"trainingprovider\" fxFlex=\"250px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.trainingprovider}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"officetype\">\r\n                                <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.offitype' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"officetype\" fxFlex=\"200px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.officetype}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"branchname\">\r\n                                <mat-header-cell fxFlex=\"270px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.branchname' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"branchname\" fxFlex=\"270px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.branchname}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"opalmember\">\r\n                                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.opalmemb' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"opalmember\" fxFlex=\"250px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.opalmember}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"coursetitle\">\r\n                                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.courtitle' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"coursetitle\" fxFlex=\"250px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.coursetitle}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"coursecate\">\r\n                                <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.courcate' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"coursecate\" fxFlex=\"220px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.coursecate}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"coursesubcate\">\r\n                                <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.coursubcate' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"coursesubcate\" fxFlex=\"250px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.coursesubcate}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"Feetype\">\r\n                                <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef>{{'invoice.fee'\r\n                                    |translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Feetype\" fxFlex=\"230px\" *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.Feetype}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"noofstaff\">\r\n                                <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef>{{'invoice.nostaff'\r\n                                    |translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"noofstaff\" fxFlex=\"190px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.noofstaff}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"invoiceamount\">\r\n                                <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.invoamount' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"invoiceamount\" fxFlex=\"200px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.invoiceamount}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"paymentstatus\">\r\n                                <mat-header-cell fxFlex=\"280px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.status' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"paymentstatus\" fxFlex=\"280px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    <span class=\"receive\"\r\n                                                *ngIf=\"trainingEvaluationData.paymentstatus == 'R'\">{{'invoice.receive'\r\n                                                |translate}}</span>\r\n                                            <span class=\"pending\"\r\n                                                *ngIf=\"trainingEvaluationData.paymentstatus == 'P'\">{{'invoice.pending'\r\n                                                |translate}}</span>\r\n                                            <span class=\"paid\"\r\n                                                *ngIf=\"trainingEvaluationData.paymentstatus == 'Paid'\">{{'invoice.paid'\r\n                                                |translate}}</span>\r\n                                </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"paymenttype\">\r\n                                <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.paymtype' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"paymenttype\" fxFlex=\"200px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    <span *ngIf=\"trainingEvaluationData.paymenttype == 'O'\">{{'invoice.online'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"trainingEvaluationData.paymenttype == 'B'\">{{'invoice.banktrans'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"trainingEvaluationData.paymenttype == 'CA'\">{{'invoice.check'\r\n                                        |translate}}</span>\r\n                                    <span *ngIf=\"trainingEvaluationData.paymenttype == 'CH'\">{{'invoice.castdepo'\r\n                                        |translate}}</span>\r\n                                </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"invoicedate\">\r\n                                <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.invodate' | translate}}\r\n                                </mat-header-cell>\r\n                                <mat-cell data-label=\"invoicedate\" fxFlex=\"190px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.invoicedate}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"invoiceage\">\r\n                                <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'invoice.invoage' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"invoiceage\" fxFlex=\"150px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.invoiceage}}</mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"paymentdate\">\r\n                                <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'invoice.paydate' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"paymentdate\" fxFlex=\"180px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.paymentdate}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <ng-container matColumnDef=\"action\">\r\n                                <mat-header-cell fxFlex=\"100px\" mat-header-cell *matHeaderCellDef>{{'invoice.action'\r\n                                    | translate}}\r\n                                </mat-header-cell>\r\n                                <mat-cell data-label=\"action\" fxFlex=\"100px\" *matCellDef=\"let trainingEvaluationData\">\r\n                                    <div class=\"manageoptions\">\r\n                                        <button type=\"button\" mat-menu-item><a href=\"#\">{{'invoice.view' |\r\n                                                translate}}</a></button>\r\n                                    </div>\r\n                                </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-first\">\r\n                                <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"invoiceno\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-second\">\r\n                                <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"officetype\">\r\n                                            <mat-option value=\"1\">{{'invoice.stand' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'invoice.custom' |translate}}</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-three\">\r\n                                <mat-header-cell fxFlex=\"290px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"companyname\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-four\">\r\n                                <mat-header-cell fxFlex=\"260px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"trainingprovider\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-five\">\r\n                                <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"officetype\">\r\n                                            <mat-option value=\"1\">{{'invoice.main' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'invoice.branch' |translate}}</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-six\">\r\n                                <mat-header-cell fxFlex=\"270px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"branname\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-seven\">\r\n                                <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"opalmembership\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-eight\">\r\n                                <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"course_title\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-nine\">\r\n                                <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"course_cate\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-ten\">\r\n                                <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"course_sub\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-eleven\">\r\n                                <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"Feetype\">\r\n                                            <mat-option value=\"1\">Centre Registration(initial)</mat-option>\r\n                                            <mat-option value=\"2\">Centre Registration(renewal)</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-twelve\">\r\n                                <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"noofstaff\">\r\n                                            <mat-option value=\"1\">20 </mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-thirteen\">\r\n                                <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-fourteen\">\r\n                                <mat-header-cell fxFlex=\"280px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"paystatus\">\r\n                                            <mat-option value=\"1\">{{'invoice.receive' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'invoice.pending' |translate}}</mat-option>\r\n                                            <mat-option value=\"3\">{{'invoice.paid' |translate}}</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-fifteen\">\r\n                                <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"paytype\">\r\n                                            <mat-option value=\"1\">{{'invoice.online' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'invoice.banktrans'\r\n                                                |translate}}</mat-option>\r\n                                            <mat-option value=\"3\">{{'invoice.check' |translate}}</mat-option>\r\n                                            <mat-option value=\"4\">{{'invoice.castdepo' |translate}}</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-sixteen\">\r\n                                <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"invoicedate\" (click)=\"invoicedatepicker.open()\"\r\n                                            [matDatepicker]=\"invoicedatepicker\">\r\n                                        <mat-datepicker-toggle matSuffix [for]=\"invoicedatepicker\"></mat-datepicker-toggle>\r\n                                        <mat-datepicker #invoicedatepicker></mat-datepicker>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-seventeen\">\r\n                                <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"invoiceage\">\r\n                                            <mat-option value=\"1\">20 Days</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-eighteen\">\r\n                                <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"paymentdate\" (click)=\"paymentdatepicker.open()\"\r\n                                            [matDatepicker]=\"paymentdatepicker\">\r\n                                        <mat-datepicker-toggle matSuffix [for]=\"paymentdatepicker\"></mat-datepicker-toggle>\r\n                                        <mat-datepicker #paymentdatepicker></mat-datepicker>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"TechnicalListData\">\r\n                            </mat-header-row>\r\n                            <mat-header-row id=\"searchrow\"\r\n                                *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-three' , 'row-four' , 'row-five' , 'row-six' , 'row-seven' ,'row-eight' , 'row-nine' , 'row-ten' , 'row-eleven' , 'row-twelve' , 'row-thirteen' , 'row-fourteen' , 'row-fifteen' , 'row-sixteen' , 'row-seventeen' , 'row-eighteen' ]\">\r\n                            </mat-header-row>\r\n                            <mat-row mat-row *matRowDef=\"let row; columns: TechnicalListData;\"></mat-row>\r\n                        </mat-table>\r\n                    </div>\r\n                    <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                            <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                class=\"masterPage masterbottom \" showFirstLastButtons [pageSize]=\"paginator?.pageSize\"\r\n                                (page)=\"syncPrimaryPaginator($event);\" [pageIndex]=\"paginator?.pageIndex\"\r\n                                [length]=\"paginator?.length\" [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                            </mat-paginator>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"btngroup m-t-30 m-b-10\" fxLayout=\"row\" fxLayoutAlign=\"flex-end\">\r\n                <button mat-raised-button class=\"cancelbtn\" type=\"button\">{{'invoice.prev' |\r\n                    translate}}</button>\r\n                <button mat-raised-button class=\"submit_btn m-l-20\" (click)=\"next()\" type=\"submit\">{{'invoice.next' |\r\n                    translate}}</button>\r\n            </div>\r\n        </ng-template>\r\n        <ng-template [ngSwitchCase]=\"'payment'\">\r\n            <app-paymentmanagement></app-paymentmanagement>\r\n        </ng-template>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.html":
  /*!************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.html ***!
    \************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesInvoicemanagementPaymentmanagementPaymentmanagementComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div id=\"payment\" #pageScroll fxLayoutAlign=\"center\">\r\n    <div fxFlex.gt-sm=\"90\" fxFlex=\"98\">\r\n        <div class=\"knowledgegrid m-t-10 m-b-20\" fxLayout=\"column\">\r\n            <div class=\"details pd-15\" fxFlex=\"100\">\r\n                <div class= \"head\" fxLayout=\"row wrap\">\r\n                    <h4 class=\"headcolor fs-18 m-0 lh-15\">Knowledge Grid Academy LLC</h4>\r\n                   <div class=\"grade\">\r\n                    <p class=\"grade d-flex fs-16\" *ngIf=\"bronze\"><img src=\"assets\\images\\opalimages\\BRONZE.svg\" alt=\"Grade\">{{'invoice.bron' | translate}} </p>\r\n                    <p class=\"gold d-flex fs-16\" *ngIf=\"gold\"><img src=\"assets\\images\\opalimages\\GOLD.svg\" alt=\"Grade\">{{'invoice.gold' | translate}}\r\n                    </p>\r\n                    <p class=\"silver d-flex fs-16\"><img src=\"assets\\images\\opalimages\\SILVER.svg\" alt=\"Grade\">{{'invoice.silv' | translate}} </p>\r\n                   </div>\r\n                </div>\r\n               <div class=\"m-t-20\">\r\n                <p class=\"text-gray m-0 fs-15 \">{{'invoice.trainname' | translate}}:<span class=\"text-default\"> Knowledge Grid\r\n                    Academy</span></p>\r\n               </div>\r\n                <div class=\"d-flex fs-13 m-t-20 m-b-20 \" fxLayout=\"row wrap\">\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.offitype' | translate}}:<span\r\n                            class=\"text-default\"> Main office</span>\r\n                    </p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.opalmemb' | translate}}:<span\r\n                            class=\"text-default\">OPP2486384211</span></p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.courtitle' | translate}}:<span\r\n                            class=\"text-default\"> Resume form height for scaff</span></p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.courtype' | translate}}:<span\r\n                            class=\"text-default\">Standard Course</span></p>\r\n\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.coursubcate' | translate}}:<span\r\n                            class=\"text-default\">Fire and safety</span></p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.fee' | translate}}:<span\r\n                            class=\"text-default\">Course Certification (Initial)</span></p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.status' | translate}}:\r\n                        <span class=\"liteorange\">{{'invoice.pending' | translate}}</span>\r\n                        <!-- <span class=\"green\">{{'invoice.receive' | translate}}</span> -->\r\n                        <!-- <span class=\"\">{{'invoice.status' | translate}}</span>\r\n                         <span class=\"\">{{'invoice.status' | translate}}</span> -->\r\n                    </p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayoutAlign=\"flex-start center\" fxLayout=\"row wrap\" class=\"m-b-40\">\r\n            <div class=\"feedetails m-t-20\" fxFlex.gt-md=\"50\" fxFlex=\"100\">\r\n                <h4 class=\"headcolor fs-18 m-0\">{{'invoice.certfeedeta' | translate}}</h4>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.invonumb' | translate}}</p>\r\n                    <span>INV-999-CCI-2022-001</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.nostaff' | translate}}</p>\r\n                    <span>3</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.courcert' | translate}}</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; 100.000</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.stafeval' | translate}}</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; 300.000</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.vat' | translate}}</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; 5.000</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.totaamou' | translate}}</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; 405.000</span>\r\n                </div>\r\n            </div>\r\n            <div class=\"feedetails\" ngClass.gt-md=\"m-t-0\" ngClass-md=\"m-t-20\" ngClass.lt-md=\"m-t-20\" fxFlex.gt-md=\"50\"\r\n                fxFlex=\"100\">\r\n                <h4 class=\"headcolor fs-18 m-0\">{{'invoice.paymdeta' | translate}}</h4>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.paymmode' | translate}}</p>\r\n                    <span>Bank transfer</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.tranid' | translate}}</p>\r\n                    <span>NBO2932983</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.bankname' | translate}}</p>\r\n                    <span>National Bank Oman</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.dateofpaym' | translate}}</p>\r\n                    <span>2-2-2023</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.paymproo' | translate}}</p>\r\n                    <span class=\"document\" matTooptip=\"cr activity pdf\"><img src=\"assets\\images\\opalimages\\pdf.png\"\r\n                            alt=\"\" cractivitydocument></span>\r\n                </div>\r\n\r\n            </div>\r\n        </div>\r\n        <mat-divider></mat-divider>\r\n        <div class=\"comments m-t-10\">\r\n            <div class=\"title\" fxLayout=\"row\" fxLayoutAlign=\"flex-start center\">\r\n                <h4 class=\"m-r-10\">{{'invoice.verification' | translate}}</h4>\r\n                <span class=\"badge decl\" *ngIf=\"!reci\">{{'invoice.notrece' | translate}}</span>\r\n                <span class=\"badge appr\" *ngIf=\"reci\">{{'invoice.receive' | translate}}</span>\r\n            </div>\r\n            <div class=\"successcmd m-l-0 m-r-0 m-b-20\">\r\n                <p class=\"18 comment\">{{'invoice.comm' | translate}}</p>\r\n                <p class=\"16 m-b-30\">Does the course recognised by International Organisation? If Yes\r\n                    Select\r\n                    the International Organisation </p>\r\n                <mat-divider></mat-divider>\r\n                <div class=\"validinfo\" fxLayout=\"row wrap\">\r\n                    <p class=\"fs-16 txt-gry m-r-40\">{{'invoice.lastvalion' | translate}}:<span\r\n                            class=\"fs-16 txt-gry3 m-l-10\">11-02-2023</span></p>\r\n                    <p class=\"fs-16 txt-gry\" ng>{{'invoice.lastvaliby' | translate}}:<span\r\n                            class=\"fs-16 txt-gry3 m-l-10\">Sameer Mohammed</span></p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.html":
  /*!**********************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.html ***!
    \**********************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesInvoicemanagementRoyaltyfeeRoyaltyfeeComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<app-responseloader *ngIf=\"pageloader\"></app-responseloader>\r\n<div fxLayout=\"row wrap\" fxLayoutAlign=\"center\" id=\"centrecertificate\">\r\n    <div fxFlex.gt-sm=\"90\" fxFlex=\"100\" [ngSwitch]=\"trainingevaluation\">\r\n        <ng-template [ngSwitchCase]=\"'tabs'\">\r\n            <mat-tab-group class=\"tabsdetials dashtabs\">\r\n                <!--Training Tab-->\r\n                <mat-tab>\r\n                    <ng-template mat-tab-label>\r\n                        <div class=\"tabscontent\">\r\n                            <div class=\"tabtitle\">\r\n                                <p class=\"fs-14\">{{'invoice.traineval' | translate}}</p>\r\n                            </div>\r\n                        </div>\r\n                    </ng-template>\r\n                    <div class=\"paginationwithfilter masterPageTop \" fxLayout=\"row wrap\">\r\n                        <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                        <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\"\r\n                            [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                            (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                    class=\"ShowHidefs-15 exportbtn m-r-10 fs-15\">{{'invoice.export' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent()\"\r\n                                    class=\"filter fs-15\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                        aria-hidden=\"true\"></i></button>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                            <div class=\"awaredtable\">\r\n                                <mat-table #table class=\"scrolldata\" [dataSource]=\"TrainingData\" matSort\r\n                                    matSortDisableClear>\r\n                                    <ng-container matColumnDef=\"invoiceno\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invonumb' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceno\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceno}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"compannyname\">\r\n                                        <mat-header-cell fxFlex=\"300px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.companyname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"compannyname\" fxFlex=\"300px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.compannyname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"trainingprovider\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.trainname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"trainingprovider\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.trainingprovider}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"coursetitle\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.courtitle' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"coursetitle\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.coursetitle}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"coursecate\">\r\n                                        <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.courcate' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"coursecate\" fxFlex=\"230px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.coursecate}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"officetype\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.offitype' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"officetype\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.officetype}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"branchname\">\r\n                                        <mat-header-cell fxFlex=\"270px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.branchname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"branchname\" fxFlex=\"270px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.branchname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"opalmember\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.opalmemb' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"opalmember\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.opalmember}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoicemonth\">\r\n                                        <mat-header-cell fxFlex=\"170px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.invoofthemon' |translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoicemonth\" fxFlex=\"170px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoicemonth}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"totallearner\">\r\n                                        <mat-header-cell fxFlex=\"130px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.totalear' |translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"totallearner\" fxFlex=\"130px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.totallearner}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceamount\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invoamount' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceamount\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceamount}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentstatus\">\r\n                                        <mat-header-cell fxFlex=\"280px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.status' |\r\n                                            translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"paymentstatus\" fxFlex=\"280px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <span class=\"receive\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'R'\">{{'invoice.receive'\r\n                                            |translate}}</span>\r\n                                        <span class=\"pending\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'P'\">{{'invoice.pending'\r\n                                            |translate}}</span>\r\n                                        <span class=\"paid\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'Paid'\">{{'invoice.paidackn'\r\n                                            |translate}}</span>\r\n                                            <span class=\"over\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'O'\">{{'invoice.over'\r\n                                            |translate}}</span>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <!-- <ng-container matColumnDef=\"paymenttype\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.paymtype' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"paymenttype\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <span *ngIf=\"trainingEvaluationData.paymenttype == 'O'\">{{'invoice.online'\r\n                                                |translate}}</span>\r\n                                            <span\r\n                                                *ngIf=\"trainingEvaluationData.paymenttype == 'B'\">{{'invoice.banktrans'\r\n                                                |translate}}</span>\r\n                                            <span *ngIf=\"trainingEvaluationData.paymenttype == 'CA'\">{{'invoice.check'\r\n                                                |translate}}</span>\r\n                                            <span\r\n                                                *ngIf=\"trainingEvaluationData.paymenttype == 'CH'\">{{'invoice.castdepo'\r\n                                                |translate}}</span>\r\n                                        </mat-cell>\r\n                                    </ng-container> -->\r\n                                    <ng-container matColumnDef=\"invoicedate\">\r\n                                        <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invodate' | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoicedate\" fxFlex=\"190px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoicedate}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceage\">\r\n                                        <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.invoage' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceage\" fxFlex=\"150px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceage}}</mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentdate\">\r\n                                        <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.paydate' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"paymentdate\" fxFlex=\"180px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.paymentdate}} </mat-cell>\r\n                                    </ng-container>\r\n\r\n                                    <ng-container matColumnDef=\"action\">\r\n                                        <mat-header-cell fxFlex=\"100px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.action'\r\n                                            | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"action\" fxFlex=\"100px\" *matCellDef=\"let courseList\">\r\n                                            <div class=\"manageoptions\">\r\n                                                <button class=\"menubutton\" mat-icon-button\r\n                                                    [matMenuTriggerFor]=\"actionmenu\"\r\n                                                    aria-label=\"Example icon-button with a menu\">\r\n                                                    <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                                </button>\r\n                                                <mat-menu #actionmenu=\"matMenu\"\r\n                                                    class=\"master-menu whentootltipadded\">\r\n                                                    <button type=\"button\" mat-menu-item>\r\n                                                        <span>{{'invoice.edit' | translate}} </span>\r\n                                                    </button>\r\n                                                    <button type=\"button\" mat-menu-item>\r\n                                                        <span>{{'invoice.down' | translate}}</span>\r\n                                                    </button>\r\n                                                </mat-menu>\r\n                                            </div>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-first\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"invoice_no\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-second\">\r\n                                        <mat-header-cell fxFlex=\"290px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"company_name\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-three\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"training_provider\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-four\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"course_title\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-five\">\r\n                                        <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"course_cate\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-six\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"office_type\">\r\n                                                    <mat-option value=\"1\">{{'invoice.main' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.branch' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-seven\">\r\n                                        <mat-header-cell fxFlex=\"270px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"bran_name\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eight\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"opal_membership\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-nine\">\r\n                                        <mat-header-cell fxFlex=\"170px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                           \r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-ten\">\r\n                                        <mat-header-cell fxFlex=\"130px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eleven\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-twelve\">\r\n                                        <mat-header-cell fxFlex=\"280px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"pay_status\">\r\n                                                    <mat-option value=\"1\">{{'invoice.receive' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.pending' |translate}}</mat-option>\r\n                                                    <mat-option value=\"3\">{{'invoice.paidackn' |translate}}</mat-option>\r\n                                                    <mat-option value=\"3\">{{'invoice.over' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-thirteen\">\r\n                                        <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"invoice_date\"\r\n                                                (click)=\"invoicedate.open()\" [matDatepicker]=\"invoicedate\">\r\n                                            <mat-datepicker-toggle matSuffix\r\n                                                [for]=\"invoicedate\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #invoicedate></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-fourteen\">\r\n                                        <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'invoice.search' |\r\n                                                translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"invoice_age\">\r\n                                                <mat-option value=\"1\">20 Days</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-fifteen\">\r\n                                        <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"payment_date\"\r\n                                                (click)=\"paymentdate.open()\" [matDatepicker]=\"paymentdate\">\r\n                                            <mat-datepicker-toggle matSuffix\r\n                                                [for]=\"paymentdate\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #paymentdate></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                    </ng-container>\r\n                                    \r\n                                    <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"TrainingListData\">\r\n                                    </mat-header-row>\r\n                                    <mat-header-row id=\"searchrow\"\r\n                                        *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-three' , 'row-four' , 'row-five' , 'row-six' , 'row-seven' , 'row-eight' , 'row-nine' , 'row-ten' , 'row-eleven' , 'row-twelve' , 'row-thirteen' , 'row-fourteen' , 'row-fifteen' ]\">\r\n                                    </mat-header-row>\r\n                                    <mat-row mat-row *matRowDef=\"let row; columns: TrainingListData;\"></mat-row>\r\n                                </mat-table>\r\n                            </div>\r\n                            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                    <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                        class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                        [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                        [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                        [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                    </mat-paginator>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"btngroup m-t-30 m-b-10\" fxLayout=\"row\" fxLayoutAlign=\"flex-end\">\r\n                        <button mat-raised-button class=\"cancelbtn\" type=\"button\">{{'invoice.prev' |\r\n                            translate}}</button>\r\n                        <button mat-raised-button class=\"submit_btn m-l-20\" (click)=\"next()\"\r\n                            type=\"submit\">{{'invoice.next' |\r\n                            translate}}</button>\r\n                    </div>\r\n                </mat-tab>\r\n                <!--Technical Tab-->\r\n                <mat-tab [ngSwitch]=\"technicalevaluation\">\r\n                    <ng-template mat-tab-label>\r\n                        <div class=\"tabscontent\">\r\n                            <div class=\"tabtitle\">\r\n                                <p class=\"fs-14\">{{'invoice.techeval' | translate}}</p>\r\n                            </div>\r\n                        </div>\r\n                    </ng-template>\r\n                    <div class=\"paginationwithfilter masterPageTop \" fxLayout=\"row wrap\">\r\n                        <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                        <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\"\r\n                            [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                            (page)=\"syncPrimaryPaginators($event);\"></mat-paginator>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                    class=\"ShowHidefs-15 exportbtn m-r-10 fs-15\">{{'invoice.export' | translate}}\r\n                                </button>\r\n                                <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickedEvent()\"\r\n                                    class=\"filter fs-15\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                        aria-hidden=\"true\"></i></button>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                            <div class=\"awaredtable\">\r\n                                <mat-table #table class=\"scrolldata\" [dataSource]=\"TechnicalData\" matSort\r\n                                    matSortDisableClear>\r\n                                    <ng-container matColumnDef=\"invoiceno\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invonumb' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceno\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceno}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"compannyname\">\r\n                                        <mat-header-cell fxFlex=\"300px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.companyname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"compannyname\" fxFlex=\"300px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.compannyname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"centrename\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.centrename' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"centrename\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.centrename}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"officetype\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.offitype' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"officetype\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.officetype}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"branchname\">\r\n                                        <mat-header-cell fxFlex=\"270px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.branchname' | translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"branchname\" fxFlex=\"270px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.branchname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"opalmember\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.opalmemb' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"opalmember\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.opalmember}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"projectname\">\r\n                                        <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.proj' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"projectname\" fxFlex=\"250px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.projectname}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoicemonth\">\r\n                                        <mat-header-cell fxFlex=\"160px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.invoofthemon' |translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoicemonth\" fxFlex=\"160px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoicemonth}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"totallearner\">\r\n                                        <mat-header-cell fxFlex=\"150px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.totalear' |translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"totallearner\" fxFlex=\"150px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.totallearner}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceamount\">\r\n                                        <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invoamount' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceamount\" fxFlex=\"200px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceamount}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentstatus\">\r\n                                        <mat-header-cell fxFlex=\"280px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.status' |\r\n                                            translate}}</mat-header-cell>\r\n                                        <mat-cell data-label=\"paymentstatus\" fxFlex=\"280px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            <span class=\"receive\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'R'\">{{'invoice.receive'\r\n                                            |translate}}</span>\r\n                                        <span class=\"pending\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'P'\">{{'invoice.pending'\r\n                                            |translate}}</span>\r\n                                        <span class=\"paid\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'Paid'\">{{'invoice.paidackn'\r\n                                            |translate}}</span>\r\n                                            <span class=\"over\"\r\n                                            *ngIf=\"trainingEvaluationData.paymentstatus == 'O'\">{{'invoice.over'\r\n                                            |translate}}</span>\r\n                                        </mat-cell>\r\n                                        \r\n                                    </ng-container>\r\n                                 \r\n                                    <ng-container matColumnDef=\"invoicedate\">\r\n                                        <mat-header-cell fxFlex=\"190px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>{{'invoice.invodate' | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoicedate\" fxFlex=\"190px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoicedate}} </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"invoiceage\">\r\n                                        <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.invoage' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"invoiceage\" fxFlex=\"150px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.invoiceage}}</mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"paymentdate\">\r\n                                        <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                            mat-sort-header>\r\n                                            {{'invoice.paydate' | translate}} </mat-header-cell>\r\n                                        <mat-cell data-label=\"paymentdate\" fxFlex=\"180px\"\r\n                                            *matCellDef=\"let trainingEvaluationData\">\r\n                                            {{trainingEvaluationData.paymentdate}} </mat-cell>\r\n                                    </ng-container>\r\n\r\n                                    <ng-container matColumnDef=\"action\">\r\n                                        <mat-header-cell fxFlex=\"100px\" mat-header-cell\r\n                                            *matHeaderCellDef>{{'invoice.action'\r\n                                            | translate}}\r\n                                        </mat-header-cell>\r\n                                        <mat-cell data-label=\"action\" fxFlex=\"100px\" *matCellDef=\"let courseList\">\r\n                                            <div class=\"manageoptions\">\r\n                                                <button class=\"menubutton\" mat-icon-button\r\n                                                    [matMenuTriggerFor]=\"actionmenu\"\r\n                                                    aria-label=\"Example icon-button with a menu\">\r\n                                                    <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                                </button>\r\n                                                <mat-menu #actionmenu=\"matMenu\"\r\n                                                    class=\"master-menu whentootltipadded\">\r\n                                                    <button type=\"button\" mat-menu-item>\r\n                                                        <span>{{'invoice.edit' | translate}} </span>\r\n                                                    </button>\r\n                                                    <button type=\"button\" mat-menu-item>\r\n                                                        <span>{{'invoice.down' | translate}}</span>\r\n                                                    </button>\r\n                                                </mat-menu>\r\n                                            </div>\r\n                                        </mat-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-first\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"invoiceno\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-second\">\r\n                                        <mat-header-cell fxFlex=\"290px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"companyname\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-three\">\r\n                                        <mat-header-cell fxFlex=\"260px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"centre_name\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-four\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"officetype\">\r\n                                                    <mat-option value=\"1\">{{'invoice.main' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.branch' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-five\">\r\n                                        <mat-header-cell fxFlex=\"270px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"branname\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-six\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"opalmembership\">\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-seven\">\r\n                                        <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"projecttype\">\r\n                                                    <mat-option value=\"1\">Centre Registration(initial)</mat-option>\r\n                                                    <mat-option value=\"2\">Centre Registration(renewal)</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eight\">\r\n                                        <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <!-- <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"Feetype\">\r\n                                                    <mat-option value=\"1\">Centre Registration(initial)</mat-option>\r\n                                                    <mat-option value=\"2\">Centre Registration(renewal)</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field> -->\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-nine\">\r\n                                        <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                         \r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-ten\">\r\n                                        <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-eleven\">\r\n                                        <mat-header-cell fxFlex=\"280px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |\r\n                                                    translate}}</mat-label>\r\n                                                <mat-select [formControl]=\"paystatus\">\r\n                                                    <mat-option value=\"1\">{{'invoice.receive' |translate}}</mat-option>\r\n                                                    <mat-option value=\"2\">{{'invoice.pending' |translate}}</mat-option>\r\n                                                    <mat-option value=\"3\">{{'invoice.paidackn' |translate}}</mat-option>\r\n                                                    <mat-option value=\"4\">{{'invoice.over' |translate}}</mat-option>\r\n                                                </mat-select>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-twelve\">\r\n                                        <mat-header-cell fxFlex=\"190px\" class=\"serachrow\" *matHeaderCellDef\r\n                                            style=\"text-align:center\">\r\n                                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                                <input matInput [formControl]=\"invoicedate\" (click)=\"invoicedatepicker.open()\"\r\n                                                    [matDatepicker]=\"invoicedatepicker\">\r\n                                                <mat-datepicker-toggle matSuffix\r\n                                                    [for]=\"invoicedatepicker\"></mat-datepicker-toggle>\r\n                                                <mat-datepicker #invoicedatepicker></mat-datepicker>\r\n                                            </mat-form-field>\r\n                                        </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-thirteen\">\r\n                                        <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'invoice.search' |\r\n                                                translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"invoiceage\">\r\n                                                <mat-option value=\"1\">20 Days</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                    </ng-container>\r\n                                    <ng-container matColumnDef=\"row-fourteen\">\r\n                                        <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"paymentdate\" (click)=\"paymentdatepicker.open()\"\r\n                                                [matDatepicker]=\"paymentdatepicker\">\r\n                                            <mat-datepicker-toggle matSuffix\r\n                                                [for]=\"paymentdatepicker\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #paymentdatepicker></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                    </ng-container>\r\n                                   \r\n                                    <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"TechnicalListData\">\r\n                                    </mat-header-row>\r\n                                    <mat-header-row id=\"searchrow\"\r\n                                        *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-three' , 'row-four' , 'row-five' , 'row-six' , 'row-seven' , 'row-eight' , 'row-nine' , 'row-ten' , 'row-eleven' , 'row-twelve' , 'row-thirteen' , 'row-fourteen' ]\">\r\n                                    </mat-header-row>\r\n                                    <mat-row mat-row *matRowDef=\"let row; columns: TechnicalListData;\"></mat-row>\r\n                                </mat-table>\r\n                            </div>\r\n                            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                    <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                        class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                        [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                        [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                        [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                    </mat-paginator>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"btngroup m-t-30 m-b-10\" fxLayout=\"row\" fxLayoutAlign=\"flex-end\">\r\n                        <button mat-raised-button class=\"cancelbtn\" type=\"button\">{{'invoice.prev' |\r\n                            translate}}</button>\r\n                        <button mat-raised-button class=\"submit_btn m-l-20\" (click)=\"nextpayment()\"\r\n                            type=\"submit\">{{'invoice.next' |\r\n                            translate}}</button>\r\n                    </div>\r\n                </mat-tab>\r\n            </mat-tab-group>\r\n        </ng-template>\r\n        <ng-template [ngSwitchCase]=\"'payment'\">\r\n            <app-royaltypayment></app-royaltypayment>\r\n        </ng-template>\r\n    </div>\r\n</div>\r\n";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.html":
  /*!******************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.html ***!
    \******************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesInvoicemanagementRoyaltypaymentRoyaltypaymentComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div id=\"royalpayment\" #pageScroll fxLayoutAlign=\"center\">\r\n    <div fxFlex.gt-sm=\"90\" fxFlex=\"98\">\r\n        <div class=\"view\" fxLayoutAlign=\"end\">\r\n            <app-viewvalidation [hidebtn]=\"false\"></app-viewvalidation>\r\n        </div>\r\n        <div class=\"knowledgegrid m-t-10 m-b-20\" fxLayout=\"column\">\r\n            <div class=\"details pd-15\" fxFlex=\"100\">\r\n                <div class=\"head\" fxLayout=\"row wrap\">\r\n                    <h4 class=\"headcolor fs-18 m-0 lh-15\">Knowledge Grid Academy LLC</h4>\r\n                </div>\r\n                <div class=\"m-t-20\">\r\n                    <p class=\"text-gray m-0 fs-15 \">{{'invoice.centrename' | translate}}:<span class=\"text-default\">\r\n                            Knowledge Grid\r\n                            Academy</span></p>\r\n                </div>\r\n                <div class=\"d-flex fs-13 m-t-20 m-b-20 \" fxLayout=\"row wrap\">\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.offitype' | translate}}:<span\r\n                            class=\"text-default\"> Main office</span>\r\n                    </p>\r\n                    <p class=\"application-detais m-r-10 text-gray m-0\">{{'invoice.opalmemb' | translate}}:<span\r\n                            class=\"text-default\">OPP2486384211</span></p>\r\n                    <p class=\"application-detais status m-r-10 text-gray m-0\">{{'invoice.status' | translate}}:\r\n                        <span class=\"liteorange\">{{'invoice.invodeta' | translate}}</span>\r\n                        <span class=\" blue\">{{'invoice.paidackn' | translate}}</span>\r\n                        <span class=\"red\">{{'invoice.over' | translate}}</span>\r\n                         <span class=\"green\">{{'invoice.receive' | translate}}</span>\r\n                    </p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayoutAlign=\"flex-start center\" fxLayout=\"row wrap\" class=\"m-b-40\">\r\n            <div class=\"feedetails m-t-20\" fxFlex.gt-md=\"50\" fxFlex=\"100\">\r\n                <h4 class=\"headcolor fs-18 m-0\">{{'invoice.invodeta' | translate}}</h4>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.invonumb' | translate}}</p>\r\n                    <span>INV-999-CCI-2022-001</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.invoofthemon' | translate}}</p>\r\n                    <span>Jan 2023</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.invodate' | translate}}</p>\r\n                    <span> 15-03-2023</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.invoage' | translate}}</p>\r\n                    <span>2 {{'invoice.days' | translate}}</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.royafee' | translate}}</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; 5.000</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.vat' | translate}} 5% ({{'invoice.omr' | translate}})</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; 5.000</span>\r\n                </div>\r\n                <div class=\"view_dtl m-t-25\" fxLayout=\"row\">\r\n                    <p class=\"m-0\">{{'invoice.totaamou' | translate}} ({{'invoice.omr' | translate}})</p>\r\n                    <span>{{'invoice.omr' | translate}} &nbsp; 405.000</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class=\"vehicle\">\r\n            <h4 class=\"fs-18\">{{'invoice.vechdeta' | translate}}</h4>\r\n            <div class=\"paginationwithfilter masterPageTop \" fxLayout=\"row wrap\">\r\n                <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\"\r\n                    [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                    (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                <div fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent()\"\r\n                            class=\"filter fs-15\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                aria-hidden=\"true\"></i></button>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row wrap\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                    <div class=\"awaredtable\">\r\n                        <mat-table #table class=\"scrolldata\" [dataSource]=\"vehicleData\" matSort\r\n                            matSortDisableClear>\r\n                            <ng-container matColumnDef=\"chassisnumber\">\r\n                                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.chasnumb' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"chassisnumber\" fxFlex=\"250px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.chassisnumber}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"vehiclenumber\">\r\n                                <mat-header-cell fxFlex=\"220px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.vehinumb' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"vehiclenumber\" fxFlex=\"220px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.vehiclenumber}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"ownername\">\r\n                                <mat-header-cell fxFlex=\"220px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.ownenmae' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"ownername\" fxFlex=\"220px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.ownername}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"feepaid\">\r\n                                <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.feepaidomr' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"feepaid\" fxFlex=\"150px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.feepaid}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"royaltypaid\">\r\n                                <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'invoice.royalpaid' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"royaltypaid\" fxFlex=\"150px\"\r\n                                    *matCellDef=\"let trainingEvaluationData\">\r\n                                    {{trainingEvaluationData.royaltypaid}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-first\">\r\n                                <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"chass_numb\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-second\">\r\n                                <mat-header-cell fxFlex=\"220px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"vehicle_numb\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-third\">\r\n                                <mat-header-cell fxFlex=\"220px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'invoice.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"vehicle_owner\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"VehicleListData\">\r\n                            </mat-header-row>\r\n                            <mat-header-row id=\"searchrow\"\r\n                                *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-third']\">\r\n                            </mat-header-row>\r\n                            <mat-row mat-row *matRowDef=\"let row; columns: VehicleListData;\"></mat-row>\r\n                        </mat-table>\r\n                    </div>\r\n                    <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                            <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                            </mat-paginator>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class=\"comments m-t-10\">\r\n            <div class=\"title\" fxLayout=\"row\" fxLayoutAlign=\"flex-start center\">\r\n                <h4 class=\"m-r-10 fs-18\">{{'invoice.paym' | translate}}</h4>\r\n                <span class=\"badge decl\" *ngIf=\"reci\">{{'invoice.notrece' | translate}}</span>\r\n                <span class=\"badge appr\" *ngIf=\"!reci\">{{'invoice.receive' | translate}}</span>\r\n            </div>\r\n            <div class=\"successcmd m-l-0 m-r-0 m-b-20\">\r\n                <p class=\"18 comment\">{{'invoice.comm' | translate}}</p>\r\n                <p class=\"16 m-b-30\">Does the course recognised by International Organisation? If Yes\r\n                    Select\r\n                    the International Organisation </p>\r\n                <mat-divider></mat-divider>\r\n                <div class=\"validinfo\" fxLayout=\"row wrap\">\r\n                    <p class=\"fs-16 txt-gry m-r-40\">{{'invoice.lastvalion' | translate}}:<span\r\n                            class=\"fs-16 txt-gry3 m-l-10\">11-02-2023</span></p>\r\n                    <p class=\"fs-16 txt-gry\" ng>{{'invoice.lastvaliby' | translate}}:<span\r\n                            class=\"fs-16 txt-gry3 m-l-10\">Sameer Mohammed</span></p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.scss":
  /*!**************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.scss ***!
    \**************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesInvoicemanagementInvoicecentreInvoicecentreComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#centrecertificate .dashtabs {\n  width: 100%;\n}\n#centrecertificate .dashtabs .mat-tab-header {\n  border: 0px;\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list {\n  flex-grow: 1;\n  position: relative;\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n}\n@media (max-width: 480px) {\n  #centrecertificate .dashtabs .mat-tab-header .mat-tab-list {\n    height: auto !important;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n  display: flex;\n}\n@media (max-width: 480px) {\n  #centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n    flex-direction: column;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 10px;\n  height: 36px;\n  justify-content: flex-start !important;\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label.mat-tab-label-active {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-ink-bar {\n  width: 0px !important;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs {\n  width: 100%;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header {\n  border: 0px;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list {\n  flex-grow: 1;\n  position: relative;\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n  height: 30px !important;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list {\n    height: auto !important;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n  display: flex;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n    flex-direction: column;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 10px;\n  height: 28px;\n  justify-content: flex-start !important;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label.mat-tab-label-active {\n  background-color: #ed1c27 !important;\n  color: #fff !important;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-ink-bar {\n  width: 0px !important;\n}\n#centrecertificate .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#centrecertificate .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#centrecertificate .awaredtable .mat-row {\n  width: -moz-fit-content;\n  width: fit-content;\n}\n#centrecertificate .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#centrecertificate .awaredtable .mat-cell {\n  color: #262626;\n}\n#centrecertificate .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#centrecertificate .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#centrecertificate .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#centrecertificate .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#centrecertificate #searchrow,\n#centrecertificate #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#centrecertificate #searchrow .serachrow,\n#centrecertificate #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n  padding: 0px !important;\n}\n@media (max-width: 768px) {\n  #centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n    display: block !important;\n  }\n}\n#centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n@media (max-width: 768px) {\n  #centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n#centrecertificate .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#centrecertificate .exportbtn {\n  background-color: #fff;\n  border: 1px solid #d7dce3;\n  height: 45px;\n  min-width: 110px;\n  color: #262626;\n}\n#centrecertificate .mat-raised-button {\n  box-shadow: none;\n  border-radius: 2px;\n}\n#centrecertificate .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 120px;\n  height: 45px;\n  padding-left: 0px;\n  padding-right: 0px;\n  font-size: 15px;\n}\n#centrecertificate .cancelbtn {\n  min-width: 120px;\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  font-size: 15px;\n  box-shadow: none;\n}\n#centrecertificate .filter {\n  height: 45px;\n}\n#centrecertificate .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#centrecertificate .tabforclientelenew .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#centrecertificate .tabforclientelenew .manageoptions .mat-icon {\n  color: #acacac;\n}\n#centrecertificate .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#centrecertificate .receive {\n  color: #00a551 !important;\n}\n#centrecertificate .paid {\n  color: #0c4b9a !important;\n}\n#centrecertificate .declined {\n  color: #ed1c27 !important;\n}\n#centrecertificate .pending {\n  color: #f4811f !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9pbnZvaWNlY2VudHJlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGludm9pY2VtYW5hZ2VtZW50XFxpbnZvaWNlY2VudHJlXFxpbnZvaWNlY2VudHJlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2ludm9pY2VtYW5hZ2VtZW50L2ludm9pY2VjZW50cmUvaW52b2ljZWNlbnRyZS5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDSTtFQUNJLFdBQUE7QUNBUjtBREVRO0VBQ0ksV0FBQTtBQ0FaO0FERVk7RUFDSSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxVQUFBO0VBQ0EsMEJBQUE7RUFDQSx1QkFBQTtFQUNBLDJCQUFBO0FDQWhCO0FERWdCO0VBUko7SUFTUSx1QkFBQTtFQ0NsQjtBQUNGO0FEQ2dCO0VBQ0ksYUFBQTtBQ0NwQjtBRENvQjtFQUhKO0lBSVEsc0JBQUE7RUNFdEI7QUFDRjtBREFvQjtFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxzQ0FBQTtBQ0V4QjtBREF3QjtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNFNUI7QURDd0I7RUFkSjtJQWVRLG1CQUFBO0VDRTFCO0FBQ0Y7QURFZ0I7RUFDSSxxQkFBQTtBQ0FwQjtBRE9nQjtFQUNJLFdBQUE7QUNMcEI7QURPb0I7RUFDSSxXQUFBO0FDTHhCO0FET3dCO0VBQ0ksWUFBQTtFQUNBLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLDBCQUFBO0VBQ0EsdUJBQUE7RUFDQSwyQkFBQTtFQUNBLHVCQUFBO0FDTDVCO0FETzRCO0VBVEo7SUFVUSx1QkFBQTtFQ0o5QjtBQUNGO0FETTRCO0VBQ0ksYUFBQTtBQ0poQztBRE1nQztFQUhKO0lBSVEsc0JBQUE7RUNIbEM7QUFDRjtBREtnQztFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxzQ0FBQTtBQ0hwQztBREtvQztFQVRKO0lBVVEsbUJBQUE7RUNGdEM7QUFDRjtBRElvQztFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNGeEM7QURPNEI7RUFDSSxxQkFBQTtBQ0xoQztBRGVJO0VBQ0ksa0JBQUE7RUFDQSw0QkFBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7QUNiUjtBRGVRO0VBQ0ksbUJBQUE7QUNiWjtBRGdCUTtFQUNJLHVCQUFBO0VBQUEsa0JBQUE7QUNkWjtBRGdCWTtFQUNJLG9DQUFBO0FDZGhCO0FEb0JRO0VBQ0ksY0FBQTtBQ2xCWjtBRHFCUTtFQUNJLHlCQUFBO0VBQ0EseUJBQUE7RUFDQSxlQUFBO0FDbkJaO0FEd0JRO0VBQ0ksV0FBQTtFQUNBLGVBQUE7QUN0Qlo7QUR5QlE7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQ3ZCWjtBRDBCUTtFQUNJLFdBQUE7RUFDQSxlQUFBO0VBQ0EsMkJBQUE7QUN4Qlo7QUQ0Qkk7O0VBRUksMkJBQUE7RUFDQSxZQUFBO0FDMUJSO0FENEJROztFQUNJLDJCQUFBO0VBQ0EsMkJBQUE7RUFDQSxtQkFBQTtBQ3pCWjtBRCtCWTtFQUNJLHVCQUFBO0FDN0JoQjtBRDhCZ0I7RUFGSjtJQUdRLHlCQUFBO0VDM0JsQjtBQUNGO0FENkJZO0VBQ0kseUJBQUE7RUFDQSxjQUFBO0FDM0JoQjtBRDZCZ0I7RUFDSSx5QkFBQTtBQzNCcEI7QUQ4QmdCO0VBUko7SUFTUSxzQkFBQTtFQzNCbEI7QUFDRjtBRGdDSTtFQUNJLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLGNBQUE7RUFDQSxnQkFBQTtFQUNBLHNCQUFBO0VBQ0EsdUJBQUE7QUM5QlI7QURnQ1E7RUFDSSxVQUFBO0VBQ0EsV0FBQTtBQzlCWjtBRGlDUTtFQUNJLG1CQUFBO0FDL0JaO0FEa0NRO0VBQ0ksZ0JBQUE7RUFDQSxrQkFBQTtBQ2hDWjtBRG1DUTtFQUNJLGdCQUFBO0FDakNaO0FEcUNJO0VBQ0ksc0JBQUE7RUFDQSx5QkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtFQUNBLGNBQUE7QUNuQ1I7QURzQ0k7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FDcENSO0FEdUNJO0VBQ0ksb0NBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0VBQ0EsWUFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxlQUFBO0FDckNSO0FEd0NJO0VBQ0ksZ0JBQUE7RUFDQSx1QkFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0VBQ0EsZUFBQTtFQUNBLGdCQUFBO0FDdENSO0FEMENJO0VBQ0ksWUFBQTtBQ3hDUjtBRDJDSTtFQUNJLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtBQ3pDUjtBRDhDWTtFQUNJLHlCQUFBO0FDNUNoQjtBRGlEWTtFQUNJLGNBQUE7QUMvQ2hCO0FEb0RRO0VBQ0ksYUFBQTtBQ2xEWjtBRHFESTtFQUNJLHlCQUFBO0FDbkRSO0FEc0RJO0VBQ0kseUJBQUE7QUNwRFI7QUR1REk7RUFDSSx5QkFBQTtBQ3JEUjtBRHdESTtFQUNJLHlCQUFBO0FDdERSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9pbnZvaWNlY2VudHJlL2ludm9pY2VjZW50cmUuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjY2VudHJlY2VydGlmaWNhdGUge1xyXG4gICAgLmRhc2h0YWJzIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuXHJcbiAgICAgICAgLm1hdC10YWItaGVhZGVyIHtcclxuICAgICAgICAgICAgYm9yZGVyOiAwcHg7XHJcblxyXG4gICAgICAgICAgICAubWF0LXRhYi1saXN0IHtcclxuICAgICAgICAgICAgICAgIGZsZXgtZ3JvdzogMTtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgICAgICAgICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG5cclxuICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOjQ4MHB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC10YWItbGFiZWxzIHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo0ODBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC10YWItbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBvcGFjaXR5OiAxO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzNnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICYubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1pbmstYmFyIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtdGFiLWJvZHkge1xyXG4gICAgICAgICAgICAubWF0LXRhYi1ib2R5LWNvbnRlbnQge1xyXG4gICAgICAgICAgICAgICAgLmlubmVyZGFzaHRhYnMge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LXRhYi1oZWFkZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXI6IDBweDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtdGFiLWxpc3Qge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgZmxleC1ncm93OiAxO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDMwcHggIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo4MDBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtdGFiLWxhYmVscyB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtdGFiLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDogMjhweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo4MDBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJi5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtaW5rLWJhciB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAuYXdhcmVkdGFibGUge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDBweDtcclxuXHJcbiAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1yb3cge1xyXG4gICAgICAgICAgICB3aWR0aDogZml0LWNvbnRlbnQ7XHJcblxyXG4gICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjUgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG5cclxuICAgICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzYyNjM2NiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtc2VsZWN0LXZhbHVlIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAjc2VhcmNocm93LFxyXG4gICAgI2ZpbHRlcnNob3cge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcblxyXG4gICAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweFxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo3NjhweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgQG1lZGlhKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5zY3JvbGxkYXRhIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgei1pbmRleDogMTtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDZweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNjY2M7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmV4cG9ydGJ0biB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZDdkY2UzO1xyXG4gICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XHJcbiAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnN1Ym1pdF9idG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcclxuICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1pbi13aWR0aDogMTIwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNhbmNlbGJ0biB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZThlOGU4O1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5maWx0ZXIge1xyXG4gICAgICAgIGhlaWdodDogNDVweDtcclxuICAgIH1cclxuXHJcbiAgICAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnRhYmZvcmNsaWVudGVsZW5ldyB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2FjYWNhYztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5tYXN0ZXJQYWdlVG9wIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnJlY2VpdmUge1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBhaWQge1xyXG4gICAgICAgIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmRlY2xpbmVkIHtcclxuICAgICAgICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5wZW5kaW5nIHtcclxuICAgICAgICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG59IiwiI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIge1xuICBib3JkZXI6IDBweDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3Qge1xuICBmbGV4LWdyb3c6IDE7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgb3BhY2l0eTogMTtcbiAgbWluLXdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNDgwcHgpIHtcbiAgI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCB7XG4gICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIHtcbiAgZGlzcGxheTogZmxleDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA0ODBweCkge1xuICAjY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtdGFiLWxhYmVscyB7XG4gICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcbiAgfVxufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMgLm1hdC10YWItbGFiZWwge1xuICBvcGFjaXR5OiAxO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIG1hcmdpbi1yaWdodDogMTBweDtcbiAgaGVpZ2h0OiAzNnB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIC5tYXQtdGFiLWxhYmVsLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDgwMHB4KSB7XG4gICNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIC5tYXQtdGFiLWxhYmVsIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtaW5rLWJhciB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMge1xuICB3aWR0aDogMTAwJTtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIHtcbiAgYm9yZGVyOiAwcHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IC5pbm5lcmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IHtcbiAgZmxleC1ncm93OiAxO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIG9wYWNpdHk6IDE7XG4gIG1pbi13aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICBoZWlnaHQ6IDMwcHggIWltcG9ydGFudDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA4MDBweCkge1xuICAjY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IC5pbm5lcmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IHtcbiAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDgwMHB4KSB7XG4gICNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIHtcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICB9XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IC5pbm5lcmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtdGFiLWxhYmVscyAubWF0LXRhYi1sYWJlbCB7XG4gIG9wYWNpdHk6IDE7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xuICBoZWlnaHQ6IDI4cHg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDgwMHB4KSB7XG4gICNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIC5tYXQtdGFiLWxhYmVsIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IC5pbm5lcmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtdGFiLWxhYmVscyAubWF0LXRhYi1sYWJlbC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC1pbmstYmFyIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSB7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgbWFyZ2luOiAxMHB4IDBweDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuYXdhcmVkdGFibGUgLm1hbmFnZW9wdGlvbnMge1xuICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSAubWF0LXJvdyB7XG4gIHdpZHRoOiBmaXQtY29udGVudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuYXdhcmVkdGFibGUgLm1hdC1yb3c6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmF3YXJlZHRhYmxlIC5tYXQtY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSAubWF0LWhlYWRlci1jZWxsIHtcbiAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXNlbGVjdC12YWx1ZSB7XG4gIGNvbG9yOiAjNjI2MzY2O1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlICNzZWFyY2hyb3csXG4jY2VudHJlY2VydGlmaWNhdGUgI2ZpbHRlcnNob3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogbm9uZTtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAjc2VhcmNocm93IC5zZXJhY2hyb3csXG4jY2VudHJlY2VydGlmaWNhdGUgI2ZpbHRlcnNob3cgLnNlcmFjaHJvdyB7XG4gIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcbiAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gICNjZW50cmVjZXJ0aWZpY2F0ZSAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI2NlbnRyZWNlcnRpZmljYXRlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuc2Nyb2xsZGF0YSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgei1pbmRleDogMTtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG92ZXJmbG93LXg6IGF1dG87XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhciB7XG4gIHdpZHRoOiA2cHg7XG4gIGhlaWdodDogNXB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmV4cG9ydGJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2RjZTM7XG4gIGhlaWdodDogNDVweDtcbiAgbWluLXdpZHRoOiAxMTBweDtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgYm94LXNoYWRvdzogbm9uZTtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5zdWJtaXRfYnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4td2lkdGg6IDEyMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xuICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuY2FuY2VsYnRuIHtcbiAgbWluLXdpZHRoOiAxMjBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZmY7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNlOGU4ZTg7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgYm94LXNoYWRvdzogbm9uZTtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZmlsdGVyIHtcbiAgaGVpZ2h0OiA0NXB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAudGFiZm9yY2xpZW50ZWxlbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgcGFkZGluZzogOHB4IDAgIWltcG9ydGFudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAudGFiZm9yY2xpZW50ZWxlbmV3IC5tYW5hZ2VvcHRpb25zIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjYWNhY2FjO1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAucmVjZWl2ZSB7XG4gIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnBhaWQge1xuICBjb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kZWNsaW5lZCB7XG4gIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnBlbmRpbmcge1xuICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xufSJdfQ== */";
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.ts":
  /*!************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.ts ***!
    \************************************************************************************/

  /*! exports provided: InvoicecentreComponent */

  /***/
  function srcAppModulesInvoicemanagementInvoicecentreInvoicecentreComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "InvoicecentreComponent", function () {
      return InvoicecentreComponent;
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


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js"); //tab 1


    var TraingList_Data = [{
      position: 1,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      Feetype: 'Centre Recognisation(Initial)',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      paymenttype: 'O',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 2,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      Feetype: 'Centre Recognisation(Initial)',
      invoiceamount: '105.000',
      paymentstatus: 'P',
      paymenttype: 'CH',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 3,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      Feetype: 'Centre Recognisation(Renewal)',
      invoiceamount: '105.000',
      paymentstatus: 'Paid',
      paymenttype: 'CA',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 4,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      Feetype: 'Centre Recognisation(Initial)',
      invoiceamount: '105.000',
      paymentstatus: 'P',
      paymenttype: 'B',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 5,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      Feetype: 'Centre Recognisation(Initial)',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      paymenttype: 'B',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }]; //tab 2

    var TechnicalList_Data = [{
      position: 1,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      Feetype: 'Centre Recognisation(Initial)',
      noofstaff: '3',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      paymenttype: 'O',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 2,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      Feetype: 'Centre Recognisation(Initial)',
      noofstaff: '4',
      invoiceamount: '105.000',
      paymentstatus: 'P',
      paymenttype: 'CH',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 3,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      Feetype: 'Centre Recognisation(Initial)',
      noofstaff: '6',
      invoiceamount: '105.000',
      paymentstatus: 'Paid',
      paymenttype: 'CA',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 4,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      Feetype: 'Centre Recognisation(Initial)',
      noofstaff: '3',
      invoiceamount: '105.000',
      paymentstatus: 'P',
      paymenttype: 'B',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 5,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      Feetype: 'Centre Recognisation(Initial)',
      noofstaff: '4',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      paymenttype: 'B',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }];

    var InvoicecentreComponent = /*#__PURE__*/function () {
      function InvoicecentreComponent(translate, remoteService, toastr, cookieService) {
        _classCallCheck(this, InvoicecentreComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.toastr = toastr;
        this.cookieService = cookieService;
        this.mattab = 0;
        this.trainingevaluation = 'tabs'; // technicalevaluation = 'technicalgridlist';
        //tab 1

        this.TrainingListData = ['invoiceno', 'compannyname', 'trainingprovider', 'officetype', 'branchname', 'opalmember', 'Feetype', 'invoiceamount', 'paymentstatus', 'paymenttype', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
        this.TrainingData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](TraingList_Data); //tab 2

        this.TechnicalListData = ['invoiceno', 'compannyname', 'centrename', 'officetype', 'branchname', 'opalmember', 'projectname', 'Feetype', 'noofstaff', 'invoiceamount', 'paymentstatus', 'paymenttype', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
        this.TechnicalData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](TechnicalList_Data);
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.page = 10;
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
        this.dir = "ltr"; //tab 1

        this.invoice_no = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.company_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.training_provider = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.office_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.bran_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.opal_membership = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.Fee_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.pay_status = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.pay_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoice_date = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoice_age = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.payment_date = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"](''); // tab 2

        this.invoiceno = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.companyname = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.centre_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.officetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.branname = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.opalmembership = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.Feetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.project_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.noofstaff = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paystatus = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paytype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoicedate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoiceage = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paymentdate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
      }

      _createClass(InvoicecentreComponent, [{
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
        key: "clickedEvent",
        value: function clickedEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = 'Show Filter';
            var id = document.getElementById('searchrow');
            id.style.display = 'none';
          } else {
            this.filtername = 'Hide Filter';

            var _id2 = document.getElementById('searchrow');

            _id2.style.display = 'flex';
          }
        }
      }, {
        key: "syncPrimaryPaginator",
        value: function syncPrimaryPaginator(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
        }
      }, {
        key: "syncPrimaryPaginators",
        value: function syncPrimaryPaginators(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
        }
      }, {
        key: "next",
        value: function next() {
          this.trainingevaluation = 'payment';
        }
      }, {
        key: "nextpayment",
        value: function nextpayment() {
          this.trainingevaluation = 'payment';
        }
      }]);

      return InvoicecentreComponent;
    }();

    InvoicecentreComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('MatTabGroup'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__["MatTabGroup"])], InvoicecentreComponent.prototype, "tabGroup", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__["MatPaginator"])], InvoicecentreComponent.prototype, "paginator", void 0);
    InvoicecentreComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-invoicecentre',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./invoicecentre.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./invoicecentre.component.scss */
      "./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]])], InvoicecentreComponent);
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.scss":
  /*!**************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.scss ***!
    \**************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesInvoicemanagementInvoicecourseInvoicecourseComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#coursecertificate .dashtabs {\n  width: 100%;\n}\n#coursecertificate .dashtabs .mat-tab-header {\n  border: 0px;\n}\n#coursecertificate .dashtabs .mat-tab-header .mat-tab-list {\n  flex-grow: 1;\n  position: relative;\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n}\n@media (max-width: 480px) {\n  #coursecertificate .dashtabs .mat-tab-header .mat-tab-list {\n    height: auto !important;\n  }\n}\n#coursecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n  display: flex;\n}\n@media (max-width: 480px) {\n  #coursecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n    flex-direction: column;\n  }\n}\n#coursecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 10px;\n  height: 36px;\n  justify-content: flex-start !important;\n}\n#coursecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label.mat-tab-label-active {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n@media (max-width: 800px) {\n  #coursecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#coursecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-ink-bar {\n  width: 0px !important;\n}\n#coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs {\n  width: 100%;\n}\n#coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header {\n  border: 0px;\n}\n#coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list {\n  flex-grow: 1;\n  position: relative;\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n  height: 30px !important;\n}\n@media (max-width: 800px) {\n  #coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list {\n    height: auto !important;\n  }\n}\n#coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n  display: flex;\n}\n@media (max-width: 800px) {\n  #coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n    flex-direction: column;\n  }\n}\n#coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 10px;\n  height: 28px;\n  justify-content: flex-start !important;\n}\n@media (max-width: 800px) {\n  #coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label.mat-tab-label-active {\n  background-color: #ed1c27 !important;\n  color: #fff !important;\n}\n#coursecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-ink-bar {\n  width: 0px !important;\n}\n#coursecertificate .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#coursecertificate .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#coursecertificate .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#coursecertificate .awaredtable .mat-row {\n  width: -moz-fit-content;\n  width: fit-content;\n}\n#coursecertificate .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#coursecertificate .awaredtable .mat-cell {\n  color: #262626;\n}\n#coursecertificate .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#coursecertificate .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#coursecertificate .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#coursecertificate .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#coursecertificate #searchrow,\n#coursecertificate #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#coursecertificate #searchrow .serachrow,\n#coursecertificate #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#coursecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n  padding: 0px !important;\n}\n@media (max-width: 768px) {\n  #coursecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n    display: block !important;\n  }\n}\n#coursecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#coursecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n@media (max-width: 768px) {\n  #coursecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n#coursecertificate .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#coursecertificate .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#coursecertificate .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#coursecertificate .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#coursecertificate .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#coursecertificate .exportbtn {\n  background-color: #fff;\n  border: 1px solid #d7dce3;\n  height: 45px;\n  min-width: 110px;\n  color: #262626;\n}\n#coursecertificate .mat-raised-button {\n  box-shadow: none;\n  border-radius: 2px;\n}\n#coursecertificate .receive {\n  color: #00a551 !important;\n}\n#coursecertificate .paid {\n  color: #0c4b9a !important;\n}\n#coursecertificate .declined {\n  color: #ed1c27 !important;\n}\n#coursecertificate .pending {\n  color: #f4811f !important;\n}\n#coursecertificate .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 120px;\n  height: 45px;\n  padding-left: 0px;\n  padding-right: 0px;\n  font-size: 15px;\n}\n#coursecertificate .cancelbtn {\n  min-width: 120px;\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  font-size: 15px;\n  box-shadow: none;\n}\n#coursecertificate .filter {\n  height: 45px;\n}\n#coursecertificate .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#coursecertificate .tabforclientelenew .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#coursecertificate .tabforclientelenew .manageoptions .mat-icon {\n  color: #acacac;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9pbnZvaWNlY291cnNlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGludm9pY2VtYW5hZ2VtZW50XFxpbnZvaWNlY291cnNlXFxpbnZvaWNlY291cnNlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2ludm9pY2VtYW5hZ2VtZW50L2ludm9pY2Vjb3Vyc2UvaW52b2ljZWNvdXJzZS5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDSTtFQUNJLFdBQUE7QUNBUjtBREVRO0VBQ0ksV0FBQTtBQ0FaO0FERVk7RUFDSSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxVQUFBO0VBQ0EsMEJBQUE7RUFDQSx1QkFBQTtFQUNBLDJCQUFBO0FDQWhCO0FERWdCO0VBUko7SUFTUSx1QkFBQTtFQ0NsQjtBQUNGO0FEQ2dCO0VBQ0ksYUFBQTtBQ0NwQjtBRENvQjtFQUhKO0lBSVEsc0JBQUE7RUNFdEI7QUFDRjtBREFvQjtFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxzQ0FBQTtBQ0V4QjtBREF3QjtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNFNUI7QURDd0I7RUFkSjtJQWVRLG1CQUFBO0VDRTFCO0FBQ0Y7QURFZ0I7RUFDSSxxQkFBQTtBQ0FwQjtBRE9nQjtFQUNJLFdBQUE7QUNMcEI7QURPb0I7RUFDSSxXQUFBO0FDTHhCO0FET3dCO0VBQ0ksWUFBQTtFQUNBLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLDBCQUFBO0VBQ0EsdUJBQUE7RUFDQSwyQkFBQTtFQUNBLHVCQUFBO0FDTDVCO0FETzRCO0VBVEo7SUFVUSx1QkFBQTtFQ0o5QjtBQUNGO0FETTRCO0VBQ0ksYUFBQTtBQ0poQztBRE1nQztFQUhKO0lBSVEsc0JBQUE7RUNIbEM7QUFDRjtBREtnQztFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxzQ0FBQTtBQ0hwQztBREtvQztFQVRKO0lBVVEsbUJBQUE7RUNGdEM7QUFDRjtBRElvQztFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNGeEM7QURPNEI7RUFDSSxxQkFBQTtBQ0xoQztBRGVRO0VBQ0ksYUFBQTtBQ2JaO0FEZ0JJO0VBQ0ksa0JBQUE7RUFDQSw0QkFBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7QUNkUjtBRGdCUTtFQUNJLG1CQUFBO0FDZFo7QURpQlE7RUFDSSx1QkFBQTtFQUFBLGtCQUFBO0FDZlo7QURpQlk7RUFDSSxvQ0FBQTtBQ2ZoQjtBRHFCUTtFQUNJLGNBQUE7QUNuQlo7QURzQlE7RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBQ3BCWjtBRHlCUTtFQUNJLFdBQUE7RUFDQSxlQUFBO0FDdkJaO0FEMEJRO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QUN4Qlo7QUQyQlE7RUFDSSxXQUFBO0VBQ0EsZUFBQTtFQUNBLDJCQUFBO0FDekJaO0FENkJJOztFQUVJLDJCQUFBO0VBQ0EsWUFBQTtBQzNCUjtBRDZCUTs7RUFDSSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsbUJBQUE7QUMxQlo7QURnQ1k7RUFDSSx1QkFBQTtBQzlCaEI7QUQrQmdCO0VBRko7SUFHUSx5QkFBQTtFQzVCbEI7QUFDRjtBRDhCWTtFQUNJLHlCQUFBO0VBQ0EsY0FBQTtBQzVCaEI7QUQ4QmdCO0VBQ0kseUJBQUE7QUM1QnBCO0FEK0JnQjtFQVJKO0lBU1Esc0JBQUE7RUM1QmxCO0FBQ0Y7QURnQ0k7RUFDSSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxjQUFBO0VBQ0EsZ0JBQUE7RUFDQSxzQkFBQTtFQUNBLHVCQUFBO0FDOUJSO0FEZ0NRO0VBQ0ksVUFBQTtFQUNBLFdBQUE7QUM5Qlo7QURpQ1E7RUFDSSxtQkFBQTtBQy9CWjtBRGtDUTtFQUNJLGdCQUFBO0VBQ0Esa0JBQUE7QUNoQ1o7QURtQ1E7RUFDSSxnQkFBQTtBQ2pDWjtBRHFDSTtFQUNJLHNCQUFBO0VBQ0EseUJBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxjQUFBO0FDbkNSO0FEc0NJO0VBQ0ksZ0JBQUE7RUFDQSxrQkFBQTtBQ3BDUjtBRHNDSTtFQUNFLHlCQUFBO0FDcENOO0FEdUNJO0VBQ0kseUJBQUE7QUNyQ1I7QUR3Q0k7RUFDSSx5QkFBQTtBQ3RDUjtBRHlDSTtFQUNJLHlCQUFBO0FDdkNSO0FEeUNJO0VBQ0ksb0NBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0VBQ0EsWUFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxlQUFBO0FDdkNSO0FEMENJO0VBQ0ksZ0JBQUE7RUFDQSx1QkFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0VBQ0EsZUFBQTtFQUNBLGdCQUFBO0FDeENSO0FENENJO0VBQ0ksWUFBQTtBQzFDUjtBRDZDSTtFQUNJLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtBQzNDUjtBRGdEWTtFQUNJLHlCQUFBO0FDOUNoQjtBRG1EWTtFQUNJLGNBQUE7QUNqRGhCIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9pbnZvaWNlY291cnNlL2ludm9pY2Vjb3Vyc2UuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjY291cnNlY2VydGlmaWNhdGUge1xyXG4gICAgLmRhc2h0YWJzIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuXHJcbiAgICAgICAgLm1hdC10YWItaGVhZGVyIHtcclxuICAgICAgICAgICAgYm9yZGVyOiAwcHg7XHJcblxyXG4gICAgICAgICAgICAubWF0LXRhYi1saXN0IHtcclxuICAgICAgICAgICAgICAgIGZsZXgtZ3JvdzogMTtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgICAgICAgICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG5cclxuICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOjQ4MHB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC10YWItbGFiZWxzIHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo0ODBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC10YWItbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBvcGFjaXR5OiAxO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzNnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICYubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1pbmstYmFyIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICBcclxuICAgICAgICAubWF0LXRhYi1ib2R5IHtcclxuICAgICAgICAgICAgLm1hdC10YWItYm9keS1jb250ZW50IHtcclxuICAgICAgICAgICAgICAgIC5pbm5lcmRhc2h0YWJzIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC10YWItaGVhZGVyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyOiAwcHg7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LXRhYi1saXN0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGZsZXgtZ3JvdzogMTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzMHB4ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAubWF0LXRhYi1sYWJlbHMge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOjgwMHB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAubWF0LXRhYi1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDI4cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICYubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAubWF0LWluay1iYXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICB9XHJcbiAgICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5hd2FyZWR0YWJsZSB7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBtYXJnaW46IDEwcHggMHB4O1xyXG5cclxuICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDE1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXJvdyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiBmaXQtY29udGVudDtcclxuXHJcbiAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNSAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgIC5tYXQtY2VsbCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1oZWFkZXItY2VsbCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1zZWxlY3QtdmFsdWUge1xyXG4gICAgICAgICAgICBjb2xvcjogIzYyNjM2NjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgICBtYXJnaW46IDBweCAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgICNzZWFyY2hyb3csXHJcbiAgICAjZmlsdGVyc2hvdyB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlcjogbm9uZTtcclxuXHJcbiAgICAgICAgLnNlcmFjaHJvdyB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5mb290ZXJwYWdpbmF0b3Ige1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOjc2OHB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICBAbWVkaWEobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuc2Nyb2xsZGF0YSB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIHotaW5kZXg6IDE7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICAgICAgICAgIHdpZHRoOiA2cHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNjY2M7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5leHBvcnRidG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZGNlMztcclxuICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMTBweDtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LXJhaXNlZC1idXR0b24ge1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgfVxyXG4gICAgLnJlY2VpdmV7XHJcbiAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBhaWQge1xyXG4gICAgICAgIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmRlY2xpbmVkIHtcclxuICAgICAgICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5wZW5kaW5nIHtcclxuICAgICAgICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnN1Ym1pdF9idG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcclxuICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1pbi13aWR0aDogMTIwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNhbmNlbGJ0biB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZThlOGU4O1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5maWx0ZXIge1xyXG4gICAgICAgIGhlaWdodDogNDVweDtcclxuICAgIH1cclxuXHJcbiAgICAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnRhYmZvcmNsaWVudGVsZW5ldyB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2FjYWNhYztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbn0iLCIjY291cnNlY2VydGlmaWNhdGUgLmRhc2h0YWJzIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciB7XG4gIGJvcmRlcjogMHB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCB7XG4gIGZsZXgtZ3JvdzogMTtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBvcGFjaXR5OiAxO1xuICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA0ODBweCkge1xuICAjY291cnNlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IHtcbiAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDQ4MHB4KSB7XG4gICNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIHtcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICB9XG59XG4jY291cnNlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtdGFiLWxhYmVscyAubWF0LXRhYi1sYWJlbCB7XG4gIG9wYWNpdHk6IDE7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xuICBoZWlnaHQ6IDM2cHg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMgLm1hdC10YWItbGFiZWwubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogODAwcHgpIHtcbiAgI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMgLm1hdC10YWItbGFiZWwge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC1pbmstYmFyIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIge1xuICBib3JkZXI6IDBweDtcbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3Qge1xuICBmbGV4LWdyb3c6IDE7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgb3BhY2l0eTogMTtcbiAgbWluLXdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGhlaWdodDogMzBweCAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDgwMHB4KSB7XG4gICNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3Qge1xuICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xuICB9XG59XG4jY291cnNlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IC5pbm5lcmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtdGFiLWxhYmVscyB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG5AbWVkaWEgKG1heC13aWR0aDogODAwcHgpIHtcbiAgI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMge1xuICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XG4gIH1cbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIC5tYXQtdGFiLWxhYmVsIHtcbiAgb3BhY2l0eTogMTtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xuICBtYXJnaW4tcmlnaHQ6IDEwcHg7XG4gIGhlaWdodDogMjhweDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogODAwcHgpIHtcbiAgI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMgLm1hdC10YWItbGFiZWwge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIC5tYXQtdGFiLWxhYmVsLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LWluay1iYXIge1xuICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSB7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgbWFyZ2luOiAxMHB4IDBweDtcbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuYXdhcmVkdGFibGUgLm1hbmFnZW9wdGlvbnMge1xuICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSAubWF0LXJvdyB7XG4gIHdpZHRoOiBmaXQtY29udGVudDtcbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuYXdhcmVkdGFibGUgLm1hdC1yb3c6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLmF3YXJlZHRhYmxlIC5tYXQtY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSAubWF0LWhlYWRlci1jZWxsIHtcbiAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXNlbGVjdC12YWx1ZSB7XG4gIGNvbG9yOiAjNjI2MzY2O1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlICNzZWFyY2hyb3csXG4jY291cnNlY2VydGlmaWNhdGUgI2ZpbHRlcnNob3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogbm9uZTtcbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAjc2VhcmNocm93IC5zZXJhY2hyb3csXG4jY291cnNlY2VydGlmaWNhdGUgI2ZpbHRlcnNob3cgLnNlcmFjaHJvdyB7XG4gIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcbiAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gICNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI2NvdXJzZWNlcnRpZmljYXRlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAuc2Nyb2xsZGF0YSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgei1pbmRleDogMTtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG92ZXJmbG93LXg6IGF1dG87XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhciB7XG4gIHdpZHRoOiA2cHg7XG4gIGhlaWdodDogNXB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLmV4cG9ydGJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2RjZTM7XG4gIGhlaWdodDogNDVweDtcbiAgbWluLXdpZHRoOiAxMTBweDtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgYm94LXNoYWRvdzogbm9uZTtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5yZWNlaXZlIHtcbiAgY29sb3I6ICMwMGE1NTEgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAucGFpZCB7XG4gIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLmRlY2xpbmVkIHtcbiAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VjZXJ0aWZpY2F0ZSAucGVuZGluZyB7XG4gIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLnN1Ym1pdF9idG4ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3ICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi13aWR0aDogMTIwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgcGFkZGluZy1sZWZ0OiAwcHg7XG4gIHBhZGRpbmctcmlnaHQ6IDBweDtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5jYW5jZWxidG4ge1xuICBtaW4td2lkdGg6IDEyMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2U4ZThlODtcbiAgY29sb3I6ICMyNjI2MjY7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xuICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC5maWx0ZXIge1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jY291cnNlY2VydGlmaWNhdGUgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC50YWJmb3JjbGllbnRlbGVuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZWNlcnRpZmljYXRlIC50YWJmb3JjbGllbnRlbGVuZXcgLm1hbmFnZW9wdGlvbnMgLm1hdC1pY29uIHtcbiAgY29sb3I6ICNhY2FjYWM7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.ts":
  /*!************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.ts ***!
    \************************************************************************************/

  /*! exports provided: InvoicecourseComponent */

  /***/
  function srcAppModulesInvoicemanagementInvoicecourseInvoicecourseComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "InvoicecourseComponent", function () {
      return InvoicecourseComponent;
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


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");

    var TechnicalList_Data = [{
      position: 1,
      invoiceno: 'General Electric',
      coursetype: 'Standard course',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      coursetitle: 'Project Management - PMP',
      coursecate: 'Procurement',
      coursesubcate: 'Fire and Safety',
      Feetype: 'Standard',
      noofstaff: '3',
      invoiceamount: 'computer sicence',
      paymentstatus: 'R',
      paymenttype: 'O',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 2,
      invoiceno: 'General Electric',
      coursetype: 'Standard course',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      coursetitle: 'Project Management - PMP',
      coursecate: 'Procurement',
      coursesubcate: 'Fire and Safety',
      Feetype: 'Standard',
      noofstaff: '4',
      invoiceamount: 'computer sicence',
      paymentstatus: 'P',
      paymenttype: 'CH',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 3,
      invoiceno: 'General Electric',
      coursetype: 'Standard course',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      coursetitle: 'Project Management - PMP',
      coursecate: 'Procurement',
      coursesubcate: 'Fire and Safety',
      Feetype: 'Standard',
      noofstaff: '5',
      invoiceamount: 'computer sicence',
      paymentstatus: 'Paid',
      paymenttype: 'CA',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 4,
      invoiceno: 'General Electric',
      coursetype: 'Standard course',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      coursetitle: 'Project Management - PMP',
      coursecate: 'Procurement',
      coursesubcate: 'Fire and Safety',
      Feetype: 'Standard',
      noofstaff: '',
      invoiceamount: 'computer sicence',
      paymentstatus: 'P',
      paymenttype: 'B',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 5,
      invoiceno: 'General Electric',
      coursetype: 'Standard course',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      coursetitle: 'Project Management - PMP',
      coursecate: 'Procurement',
      coursesubcate: 'Fire and Safety',
      Feetype: 'Standard',
      noofstaff: '9',
      invoiceamount: 'computer sicence',
      paymentstatus: 'R',
      paymenttype: 'B',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }];

    var InvoicecourseComponent = /*#__PURE__*/function () {
      function InvoicecourseComponent(translate, remoteService, toastr, cookieService) {
        _classCallCheck(this, InvoicecourseComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.toastr = toastr;
        this.cookieService = cookieService;
        this.mattab = 0;
        this.trainingevaluation = 'technicalgridlist';
        this.TechnicalListData = ['invoiceno', 'coursetype', 'compannyname', 'trainingprovider', 'officetype', 'branchname', 'opalmember', 'coursetitle', 'coursecate', 'coursesubcate', 'Feetype', 'noofstaff', 'invoiceamount', 'paymentstatus', 'paymenttype', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
        this.TechnicalData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](TechnicalList_Data);
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.page = 10;
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
        this.invoiceno = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.coursetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.companyname = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.trainingprovider = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.officetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.branname = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.opalmembership = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.course_title = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.course_cate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.course_sub = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.Feetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.noofstaff = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paystatus = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paytype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoicedate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoiceage = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paymentdate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
      }

      _createClass(InvoicecourseComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this2 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this2.cookieService.get('languageCookieId');
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
            _this2.translate.setDefaultLang(_this2.cookieService.get('languageCode'));

            if (_this2.cookieService.get('languageCookieId') && _this2.cookieService.get('languageCookieId') != undefined && _this2.cookieService.get('languageCookieId') != null) {
              var _toSelect5 = _this2.languagelist.find(function (c) {
                return c.id === _this2.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this2.translate.setDefaultLang(_toSelect5.languagecode);

              _this2.dir = _toSelect5.dir;
            } else {
              var _toSelect6 = _this2.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this2.translate.setDefaultLang(_toSelect6.languagecode);

              _this2.dir = _toSelect6.dir;
            }
          });
        }
      }, {
        key: "clickedEvent",
        value: function clickedEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = 'Show Filter';
            var id = document.getElementById('searchrow');
            id.style.display = 'none';
          } else {
            this.filtername = 'Hide Filter';

            var _id3 = document.getElementById('searchrow');

            _id3.style.display = 'flex';
          }
        }
      }, {
        key: "syncPrimaryPaginators",
        value: function syncPrimaryPaginators(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
        }
      }, {
        key: "next",
        value: function next() {
          this.trainingevaluation = 'payment';
        }
      }]);

      return InvoicecourseComponent;
    }();

    InvoicecourseComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('MatTabGroup'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__["MatTabGroup"])], InvoicecourseComponent.prototype, "tabGroup", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__["MatPaginator"])], InvoicecourseComponent.prototype, "paginator", void 0);
    InvoicecourseComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-invoicecourse',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./invoicecourse.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./invoicecourse.component.scss */
      "./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]])], InvoicecourseComponent);
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/invoicemanagement-routing.module.ts":
  /*!*******************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/invoicemanagement-routing.module.ts ***!
    \*******************************************************************************/

  /*! exports provided: InvoicemanagementRoutingModule */

  /***/
  function srcAppModulesInvoicemanagementInvoicemanagementRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "InvoicemanagementRoutingModule", function () {
      return InvoicemanagementRoutingModule;
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


    var _invoicecentre_invoicecentre_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./invoicecentre/invoicecentre.component */
    "./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.ts");
    /* harmony import */


    var _invoicecourse_invoicecourse_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./invoicecourse/invoicecourse.component */
    "./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.ts");
    /* harmony import */


    var _royaltyfee_royaltyfee_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./royaltyfee/royaltyfee.component */
    "./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'royaltyfee',
        component: _royaltyfee_royaltyfee_component__WEBPACK_IMPORTED_MODULE_6__["RoyaltyfeeComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
        data: {
          title: 'Invoice Management - Royalty Fee',
          urls: [{
            title: 'Invoice Management - Royalty Fee',
            url: '/invoicemanagement/royaltyfee'
          }]
        }
      }, {
        path: 'centrecertificate',
        component: _invoicecentre_invoicecentre_component__WEBPACK_IMPORTED_MODULE_4__["InvoicecentreComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
        data: {
          title: 'Invoice Management - Centre Certification',
          urls: [{
            title: 'Invoice Management - Centre Certification',
            url: '/invoicemanagement/centrecertificate'
          }]
        }
      }, {
        path: 'coursecertificate',
        component: _invoicecourse_invoicecourse_component__WEBPACK_IMPORTED_MODULE_5__["InvoicecourseComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
        data: {
          title: 'Invoice Management - Course Certification',
          urls: [{
            title: 'Invoice Management - Course Certification',
            url: '/invoicemanagement/coursecertificate'
          }]
        }
      }]
    }];

    var InvoicemanagementRoutingModule = /*#__PURE__*/_createClass(function InvoicemanagementRoutingModule() {
      _classCallCheck(this, InvoicemanagementRoutingModule);
    });

    InvoicemanagementRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], InvoicemanagementRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/invoicemanagement.module.ts":
  /*!***********************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/invoicemanagement.module.ts ***!
    \***********************************************************************/

  /*! exports provided: createTranslateLoader, InvoicemanagementModule */

  /***/
  function srcAppModulesInvoicemanagementInvoicemanagementModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function () {
      return createTranslateLoader;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "InvoicemanagementModule", function () {
      return InvoicemanagementModule;
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


    var _invoicemanagement_routing_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./invoicemanagement-routing.module */
    "./src/app/modules/invoicemanagement/invoicemanagement-routing.module.ts");
    /* harmony import */


    var _royaltyfee_royaltyfee_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./royaltyfee/royaltyfee.component */
    "./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.ts");
    /* harmony import */


    var _paymentmanagement_paymentmanagement_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ./paymentmanagement/paymentmanagement.component */
    "./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.ts");
    /* harmony import */


    var _invoicecentre_invoicecentre_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ./invoicecentre/invoicecentre.component */
    "./src/app/modules/invoicemanagement/invoicecentre/invoicecentre.component.ts");
    /* harmony import */


    var _invoicecourse_invoicecourse_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ./invoicecourse/invoicecourse.component */
    "./src/app/modules/invoicemanagement/invoicecourse/invoicecourse.component.ts");
    /* harmony import */


    var _app_shared__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @ngx-translate/http-loader */
    "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
    /* harmony import */


    var _royaltypayment_royaltypayment_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! ./royaltypayment/royaltypayment.component */
    "./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.ts");

    function createTranslateLoader(http) {
      return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_13__["TranslateHttpLoader"](http, './assets/i18n/invoicemanagement/', '.json');
    }

    var InvoicemanagementModule = /*#__PURE__*/_createClass(function InvoicemanagementModule() {
      _classCallCheck(this, InvoicemanagementModule);
    });

    InvoicemanagementModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_royaltyfee_royaltyfee_component__WEBPACK_IMPORTED_MODULE_5__["RoyaltyfeeComponent"], _paymentmanagement_paymentmanagement_component__WEBPACK_IMPORTED_MODULE_6__["PaymentmanagementComponent"], _invoicecentre_invoicecentre_component__WEBPACK_IMPORTED_MODULE_7__["InvoicecentreComponent"], _invoicecourse_invoicecourse_component__WEBPACK_IMPORTED_MODULE_8__["InvoicecourseComponent"], _royaltypayment_royaltypayment_component__WEBPACK_IMPORTED_MODULE_15__["RoyaltypaymentComponent"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _invoicemanagement_routing_module__WEBPACK_IMPORTED_MODULE_4__["InvoicemanagementRoutingModule"], _app_shared__WEBPACK_IMPORTED_MODULE_9__["SharedModule"], _angular_material_tabs__WEBPACK_IMPORTED_MODULE_10__["MatTabsModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_14__["FlexLayoutModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["ReactiveFormsModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormsModule"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_12__["TranslateModule"].forChild({
        loader: {
          provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_12__["TranslateLoader"],
          useFactory: createTranslateLoader,
          deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_11__["HttpClient"]]
        }
      })]
    })], InvoicemanagementModule);
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.scss":
  /*!**********************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.scss ***!
    \**********************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesInvoicemanagementPaymentmanagementPaymentmanagementComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#payment .knowledgegrid {\n  background: #FFFFFF 0% 0% no-repeat padding-box;\n  box-shadow: 0px 0px 8px #0000001a;\n  border: 1px solid #D7DCE3;\n  border-radius: 4px;\n  opacity: 1;\n  padding: 10px;\n}\n#payment .knowledgegrid .text-gray {\n  color: #848484;\n}\n#payment .knowledgegrid .text-default {\n  color: #262626 !important;\n}\n#payment .knowledgegrid .bold {\n  font-weight: 600;\n}\n#payment .knowledgegrid .details .head {\n  justify-content: space-between;\n  align-items: center;\n  height: 40px;\n}\n#payment .knowledgegrid .details .head .grade {\n  align-items: center;\n  color: #895B37;\n}\n#payment .knowledgegrid .details .head .gold {\n  align-items: center;\n  color: #BA9666;\n}\n#payment .knowledgegrid .details .head .silver {\n  align-items: center;\n  color: #B9BABC;\n}\n#payment .knowledgegrid .details .application-detais {\n  border: 1px solid #D7DCE3;\n  padding: 5px;\n  margin-top: 10px !important;\n}\n#payment .knowledgegrid .address {\n  justify-content: space-between;\n  width: 60%;\n}\n#payment .knowledgegrid .address .add-details i {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #707070;\n}\n#payment h4 {\n  color: #0C4B9A;\n}\n#payment .feedetails .view_dtl p {\n  min-width: 222px;\n  color: #848484;\n  font-size: 16px;\n}\n@media (max-width: 768px) {\n  #payment .feedetails .view_dtl p {\n    min-width: 178px;\n  }\n}\n#payment .feedetails .view_dtl span {\n  color: #262626;\n  font-size: 16px;\n}\n#payment .feedetails .view_dtl span .document {\n  width: 22px;\n  height: 28px;\n}\n#payment .badge {\n  color: #fff;\n  padding: 3px 5px;\n  font-size: 15px;\n  border-radius: 3px;\n}\n#payment .badge.pendings {\n  background-color: #f4811f;\n}\n#payment .badge.update {\n  background-color: #0c4b9a;\n}\n#payment .badge.appr {\n  background-color: #00a551;\n}\n#payment .badge.decl {\n  background-color: #ed1c27;\n}\n#payment .successcmd {\n  border: 1px solid #00a551;\n  border-radius: 3px;\n  padding: 15px 15px 10px 15px;\n  background-color: #f8fffb;\n}\n#payment .successcmd .comment {\n  color: #00a551 !important;\n}\n#payment .successcmd p {\n  color: #262626;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9wYXltZW50bWFuYWdlbWVudC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxpbnZvaWNlbWFuYWdlbWVudFxccGF5bWVudG1hbmFnZW1lbnRcXHBheW1lbnRtYW5hZ2VtZW50LmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2ludm9pY2VtYW5hZ2VtZW50L3BheW1lbnRtYW5hZ2VtZW50L3BheW1lbnRtYW5hZ2VtZW50LmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUNJO0VBQ0ksK0NBQUE7RUFDQSxpQ0FBQTtFQUNBLHlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxVQUFBO0VBQ0EsYUFBQTtBQ0FSO0FERVE7RUFDSSxjQUFBO0FDQVo7QURHUTtFQUNJLHlCQUFBO0FDRFo7QURJUTtFQUNJLGdCQUFBO0FDRlo7QURPWTtFQUNJLDhCQUFBO0VBQ0EsbUJBQUE7RUFDQSxZQUFBO0FDTGhCO0FET2dCO0VBQ0ksbUJBQUE7RUFDQSxjQUFBO0FDTHBCO0FEUWdCO0VBQ0ksbUJBQUE7RUFDQSxjQUFBO0FDTnBCO0FEU2dCO0VBQ0ksbUJBQUE7RUFDQSxjQUFBO0FDUHBCO0FEV1k7RUFDSSx5QkFBQTtFQUNBLFlBQUE7RUFDQSwyQkFBQTtBQ1RoQjtBRGNRO0VBQ0ksOEJBQUE7RUFDQSxVQUFBO0FDWlo7QURlZ0I7RUFFSSxrQkFBQTtFQUNBLDhCQUFBO0VBQ0Esa0NBQUE7QUNkcEI7QURvQkk7RUFDSSxjQUFBO0FDbEJSO0FEd0JZO0VBQ0ksZ0JBQUE7RUFDQSxjQUFBO0VBQ0EsZUFBQTtBQ3RCaEI7QUR1QmE7RUFKRDtJQUtJLGdCQUFBO0VDcEJkO0FBQ0Y7QUR1Qlk7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQ3JCaEI7QUR1QmdCO0VBQ0ksV0FBQTtFQUNBLFlBQUE7QUNyQnBCO0FEMEJJO0VBQ0ksV0FBQTtFQUNBLGdCQUFBO0VBQ0EsZUFBQTtFQUNBLGtCQUFBO0FDeEJSO0FEMEJRO0VBQ0kseUJBQUE7QUN4Qlo7QUQyQlE7RUFDSSx5QkFBQTtBQ3pCWjtBRDRCUTtFQUNJLHlCQUFBO0FDMUJaO0FENkJRO0VBQ0kseUJBQUE7QUMzQlo7QUQrQkk7RUFDSSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSx5QkFBQTtBQzdCUjtBRCtCUTtFQUNJLHlCQUFBO0FDN0JaO0FEZ0NRO0VBQ0ksY0FBQTtBQzlCWiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvaW52b2ljZW1hbmFnZW1lbnQvcGF5bWVudG1hbmFnZW1lbnQvcGF5bWVudG1hbmFnZW1lbnQuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjcGF5bWVudCB7XHJcbiAgICAua25vd2xlZGdlZ3JpZCB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI0ZGRkZGRiAwJSAwJSBuby1yZXBlYXQgcGFkZGluZy1ib3g7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMHB4IDBweCA4cHggIzAwMDAwMDFhO1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNEN0RDRTM7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogNHB4O1xyXG4gICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgcGFkZGluZzogMTBweDtcclxuXHJcbiAgICAgICAgLnRleHQtZ3JheSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnRleHQtZGVmYXVsdCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYm9sZCB7XHJcbiAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiA2MDA7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGV0YWlscyB7XHJcblxyXG4gICAgICAgICAgICAuaGVhZCB7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiA0MHB4O1xyXG5cclxuICAgICAgICAgICAgICAgIC5ncmFkZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzg5NUIzNztcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuZ29sZCB7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0JBOTY2NjtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuc2lsdmVyIHtcclxuICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjQjlCQUJDO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAuYXBwbGljYXRpb24tZGV0YWlzIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNEN0RDRTM7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA1cHg7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYWRkcmVzcyB7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgICAgICAgICAgd2lkdGg6IDYwJTtcclxuXHJcbiAgICAgICAgICAgIC5hZGQtZGV0YWlscyB7XHJcbiAgICAgICAgICAgICAgICBpIHtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6IHRyYW5zcGFyZW50O1xyXG4gICAgICAgICAgICAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDFweDtcclxuICAgICAgICAgICAgICAgICAgICAtd2Via2l0LXRleHQtc3Ryb2tlLWNvbG9yOiAjNzA3MDcwO1xyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIGg0IHtcclxuICAgICAgICBjb2xvcjogIzBDNEI5QTtcclxuICAgIH1cclxuICAgIC5mZWVkZXRhaWxzIHtcclxuICAgICAgIFxyXG5cclxuICAgICAgICAudmlld19kdGwge1xyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMjIycHg7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTZweDtcclxuICAgICAgICAgICAgIEBtZWRpYShtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiAgICAgICAgICAgICAgICBtaW4td2lkdGg6IDE3OHB4O1xyXG4gICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNnB4O1xyXG5cclxuICAgICAgICAgICAgICAgIC5kb2N1bWVudCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDIycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAyOHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmJhZGdlIHtcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBwYWRkaW5nOiAzcHggNXB4O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcblxyXG4gICAgICAgICYucGVuZGluZ3Mge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjQ4MTFmO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi51cGRhdGUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5hcHByIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwYTU1MTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYuZGVjbCB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjc7XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuICAgIC5zdWNjZXNzY21kIHtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjMDBhNTUxO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDNweDtcclxuICAgICAgICBwYWRkaW5nOiAxNXB4IDE1cHggMTBweCAxNXB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGZmZmI7XHJcblxyXG4gICAgICAgIC5jb21tZW50IHtcclxuICAgICAgICAgICAgY29sb3I6ICMwMGE1NTEgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICB9XHJcbiAgICB9ICAgICAgIFxyXG59IiwiI3BheW1lbnQgLmtub3dsZWRnZWdyaWQge1xuICBiYWNrZ3JvdW5kOiAjRkZGRkZGIDAlIDAlIG5vLXJlcGVhdCBwYWRkaW5nLWJveDtcbiAgYm94LXNoYWRvdzogMHB4IDBweCA4cHggIzAwMDAwMDFhO1xuICBib3JkZXI6IDFweCBzb2xpZCAjRDdEQ0UzO1xuICBib3JkZXItcmFkaXVzOiA0cHg7XG4gIG9wYWNpdHk6IDE7XG4gIHBhZGRpbmc6IDEwcHg7XG59XG4jcGF5bWVudCAua25vd2xlZGdlZ3JpZCAudGV4dC1ncmF5IHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jcGF5bWVudCAua25vd2xlZGdlZ3JpZCAudGV4dC1kZWZhdWx0IHtcbiAgY29sb3I6ICMyNjI2MjYgIWltcG9ydGFudDtcbn1cbiNwYXltZW50IC5rbm93bGVkZ2VncmlkIC5ib2xkIHtcbiAgZm9udC13ZWlnaHQ6IDYwMDtcbn1cbiNwYXltZW50IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIHtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBoZWlnaHQ6IDQwcHg7XG59XG4jcGF5bWVudCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuaGVhZCAuZ3JhZGUge1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBjb2xvcjogIzg5NUIzNztcbn1cbiNwYXltZW50IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIC5nb2xkIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY29sb3I6ICNCQTk2NjY7XG59XG4jcGF5bWVudCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuaGVhZCAuc2lsdmVyIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY29sb3I6ICNCOUJBQkM7XG59XG4jcGF5bWVudCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuYXBwbGljYXRpb24tZGV0YWlzIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI0Q3RENFMztcbiAgcGFkZGluZzogNXB4O1xuICBtYXJnaW4tdG9wOiAxMHB4ICFpbXBvcnRhbnQ7XG59XG4jcGF5bWVudCAua25vd2xlZGdlZ3JpZCAuYWRkcmVzcyB7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgd2lkdGg6IDYwJTtcbn1cbiNwYXltZW50IC5rbm93bGVkZ2VncmlkIC5hZGRyZXNzIC5hZGQtZGV0YWlscyBpIHtcbiAgY29sb3I6IHRyYW5zcGFyZW50O1xuICAtd2Via2l0LXRleHQtc3Ryb2tlLXdpZHRoOiAxcHg7XG4gIC13ZWJraXQtdGV4dC1zdHJva2UtY29sb3I6ICM3MDcwNzA7XG59XG4jcGF5bWVudCBoNCB7XG4gIGNvbG9yOiAjMEM0QjlBO1xufVxuI3BheW1lbnQgLmZlZWRldGFpbHMgLnZpZXdfZHRsIHAge1xuICBtaW4td2lkdGg6IDIyMnB4O1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gICNwYXltZW50IC5mZWVkZXRhaWxzIC52aWV3X2R0bCBwIHtcbiAgICBtaW4td2lkdGg6IDE3OHB4O1xuICB9XG59XG4jcGF5bWVudCAuZmVlZGV0YWlscyAudmlld19kdGwgc3BhbiB7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBmb250LXNpemU6IDE2cHg7XG59XG4jcGF5bWVudCAuZmVlZGV0YWlscyAudmlld19kdGwgc3BhbiAuZG9jdW1lbnQge1xuICB3aWR0aDogMjJweDtcbiAgaGVpZ2h0OiAyOHB4O1xufVxuI3BheW1lbnQgLmJhZGdlIHtcbiAgY29sb3I6ICNmZmY7XG4gIHBhZGRpbmc6IDNweCA1cHg7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgYm9yZGVyLXJhZGl1czogM3B4O1xufVxuI3BheW1lbnQgLmJhZGdlLnBlbmRpbmdzIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y0ODExZjtcbn1cbiNwYXltZW50IC5iYWRnZS51cGRhdGUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xufVxuI3BheW1lbnQgLmJhZGdlLmFwcHIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDBhNTUxO1xufVxuI3BheW1lbnQgLmJhZGdlLmRlY2wge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3O1xufVxuI3BheW1lbnQgLnN1Y2Nlc3NjbWQge1xuICBib3JkZXI6IDFweCBzb2xpZCAjMDBhNTUxO1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG4gIHBhZGRpbmc6IDE1cHggMTVweCAxMHB4IDE1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGZmZmI7XG59XG4jcGF5bWVudCAuc3VjY2Vzc2NtZCAuY29tbWVudCB7XG4gIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XG59XG4jcGF5bWVudCAuc3VjY2Vzc2NtZCBwIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.ts":
  /*!********************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.ts ***!
    \********************************************************************************************/

  /*! exports provided: PaymentmanagementComponent */

  /***/
  function srcAppModulesInvoicemanagementPaymentmanagementPaymentmanagementComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "PaymentmanagementComponent", function () {
      return PaymentmanagementComponent;
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


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");

    var PaymentmanagementComponent = /*#__PURE__*/function () {
      function PaymentmanagementComponent(translate, remoteService, toastr, cookieService) {
        _classCallCheck(this, PaymentmanagementComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.toastr = toastr;
        this.cookieService = cookieService;
        this.pending = false;
        this.reci = false;
        this.bronze = false;
        this.gold = false;
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

      _createClass(PaymentmanagementComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this3 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this3.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect7 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect7.languagecode);
            this.dir = _toSelect7.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this3.translate.setDefaultLang(_this3.cookieService.get('languageCode'));

            if (_this3.cookieService.get('languageCookieId') && _this3.cookieService.get('languageCookieId') != undefined && _this3.cookieService.get('languageCookieId') != null) {
              var _toSelect8 = _this3.languagelist.find(function (c) {
                return c.id === _this3.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this3.translate.setDefaultLang(_toSelect8.languagecode);

              _this3.dir = _toSelect8.dir;
            } else {
              var _toSelect9 = _this3.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this3.translate.setDefaultLang(_toSelect9.languagecode);

              _this3.dir = _toSelect9.dir;
            }
          });
        }
      }]);

      return PaymentmanagementComponent;
    }();

    PaymentmanagementComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }];
    };

    PaymentmanagementComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-paymentmanagement',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./paymentmanagement.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./paymentmanagement.component.scss */
      "./src/app/modules/invoicemanagement/paymentmanagement/paymentmanagement.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]])], PaymentmanagementComponent);
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.scss":
  /*!********************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.scss ***!
    \********************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesInvoicemanagementRoyaltyfeeRoyaltyfeeComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#centrecertificate .dashtabs {\n  width: 100%;\n}\n#centrecertificate .dashtabs .mat-tab-header {\n  border: 0px;\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list {\n  flex-grow: 1;\n  position: relative;\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n}\n@media (max-width: 480px) {\n  #centrecertificate .dashtabs .mat-tab-header .mat-tab-list {\n    height: auto !important;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n  display: flex;\n}\n@media (max-width: 480px) {\n  #centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n    flex-direction: column;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 10px;\n  height: 36px;\n  justify-content: flex-start !important;\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label.mat-tab-label-active {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-header .mat-tab-list .mat-ink-bar {\n  width: 0px !important;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs {\n  width: 100%;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header {\n  border: 0px;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list {\n  flex-grow: 1;\n  position: relative;\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n  height: 30px !important;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list {\n    height: auto !important;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n  display: flex;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels {\n    flex-direction: column;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 10px;\n  height: 28px;\n  justify-content: flex-start !important;\n}\n@media (max-width: 800px) {\n  #centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-tab-labels .mat-tab-label.mat-tab-label-active {\n  background-color: #ed1c27 !important;\n  color: #fff !important;\n}\n#centrecertificate .dashtabs .mat-tab-body .mat-tab-body-content .innerdashtabs .mat-tab-header .mat-tab-list .mat-ink-bar {\n  width: 0px !important;\n}\n#centrecertificate .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#centrecertificate .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#centrecertificate .awaredtable .mat-row {\n  width: -moz-fit-content;\n  width: fit-content;\n}\n#centrecertificate .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#centrecertificate .awaredtable .mat-cell {\n  color: #262626;\n}\n#centrecertificate .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#centrecertificate .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#centrecertificate .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#centrecertificate .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#centrecertificate #searchrow,\n#centrecertificate #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#centrecertificate #searchrow .serachrow,\n#centrecertificate #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n  padding: 0px !important;\n}\n@media (max-width: 768px) {\n  #centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n    display: block !important;\n  }\n}\n#centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n@media (max-width: 768px) {\n  #centrecertificate .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n#centrecertificate .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#centrecertificate .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#centrecertificate .exportbtn {\n  background-color: #fff;\n  border: 1px solid #d7dce3;\n  height: 45px;\n  min-width: 110px;\n  color: #262626;\n}\n#centrecertificate .mat-raised-button {\n  box-shadow: none;\n  border-radius: 2px;\n}\n#centrecertificate .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 120px;\n  height: 45px;\n  padding-left: 0px;\n  padding-right: 0px;\n  font-size: 15px;\n}\n#centrecertificate .cancelbtn {\n  min-width: 120px;\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  font-size: 15px;\n  box-shadow: none;\n}\n#centrecertificate .filter {\n  height: 45px;\n}\n#centrecertificate .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#centrecertificate .tabforclientelenew .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#centrecertificate .tabforclientelenew .manageoptions .mat-icon {\n  color: #acacac;\n}\n#centrecertificate .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#centrecertificate .receive {\n  color: #00a551 !important;\n}\n#centrecertificate .paid {\n  color: #0c4b9a !important;\n}\n#centrecertificate .over {\n  color: #ed1c27 !important;\n}\n#centrecertificate .pending {\n  color: #f4811f !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9yb3lhbHR5ZmVlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGludm9pY2VtYW5hZ2VtZW50XFxyb3lhbHR5ZmVlXFxyb3lhbHR5ZmVlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2ludm9pY2VtYW5hZ2VtZW50L3JveWFsdHlmZWUvcm95YWx0eWZlZS5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFDSTtFQUNJLFdBQUE7QUNBUjtBREVRO0VBQ0ksV0FBQTtBQ0FaO0FERVk7RUFDSSxZQUFBO0VBQ0Esa0JBQUE7RUFDQSxVQUFBO0VBQ0EsMEJBQUE7RUFDQSx1QkFBQTtFQUNBLDJCQUFBO0FDQWhCO0FERWdCO0VBUko7SUFTUSx1QkFBQTtFQ0NsQjtBQUNGO0FEQ2dCO0VBQ0ksYUFBQTtBQ0NwQjtBRENvQjtFQUhKO0lBSVEsc0JBQUE7RUNFdEI7QUFDRjtBREFvQjtFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxzQ0FBQTtBQ0V4QjtBREF3QjtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNFNUI7QURDd0I7RUFkSjtJQWVRLG1CQUFBO0VDRTFCO0FBQ0Y7QURFZ0I7RUFDSSxxQkFBQTtBQ0FwQjtBRE9nQjtFQUNJLFdBQUE7QUNMcEI7QURPb0I7RUFDSSxXQUFBO0FDTHhCO0FET3dCO0VBQ0ksWUFBQTtFQUNBLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLDBCQUFBO0VBQ0EsdUJBQUE7RUFDQSwyQkFBQTtFQUNBLHVCQUFBO0FDTDVCO0FETzRCO0VBVEo7SUFVUSx1QkFBQTtFQ0o5QjtBQUNGO0FETTRCO0VBQ0ksYUFBQTtBQ0poQztBRE1nQztFQUhKO0lBSVEsc0JBQUE7RUNIbEM7QUFDRjtBREtnQztFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxzQ0FBQTtBQ0hwQztBREtvQztFQVRKO0lBVVEsbUJBQUE7RUNGdEM7QUFDRjtBRElvQztFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNGeEM7QURPNEI7RUFDSSxxQkFBQTtBQ0xoQztBRGVJO0VBQ0ksa0JBQUE7RUFDQSw0QkFBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7QUNiUjtBRGVRO0VBQ0ksbUJBQUE7QUNiWjtBRGdCUTtFQUNJLHVCQUFBO0VBQUEsa0JBQUE7QUNkWjtBRGdCWTtFQUNJLG9DQUFBO0FDZGhCO0FEb0JRO0VBQ0ksY0FBQTtBQ2xCWjtBRHFCUTtFQUNJLHlCQUFBO0VBQ0EseUJBQUE7RUFDQSxlQUFBO0FDbkJaO0FEd0JRO0VBQ0ksV0FBQTtFQUNBLGVBQUE7QUN0Qlo7QUR5QlE7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQ3ZCWjtBRDBCUTtFQUNJLFdBQUE7RUFDQSxlQUFBO0VBQ0EsMkJBQUE7QUN4Qlo7QUQ0Qkk7O0VBRUksMkJBQUE7RUFDQSxZQUFBO0FDMUJSO0FENEJROztFQUNJLDJCQUFBO0VBQ0EsMkJBQUE7RUFDQSxtQkFBQTtBQ3pCWjtBRCtCWTtFQUNJLHVCQUFBO0FDN0JoQjtBRDhCZ0I7RUFGSjtJQUdRLHlCQUFBO0VDM0JsQjtBQUNGO0FENkJZO0VBQ0kseUJBQUE7RUFDQSxjQUFBO0FDM0JoQjtBRDZCZ0I7RUFDSSx5QkFBQTtBQzNCcEI7QUQ4QmdCO0VBUko7SUFTUSxzQkFBQTtFQzNCbEI7QUFDRjtBRGdDSTtFQUNJLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLGNBQUE7RUFDQSxnQkFBQTtFQUNBLHNCQUFBO0VBQ0EsdUJBQUE7QUM5QlI7QURnQ1E7RUFDSSxVQUFBO0VBQ0EsV0FBQTtBQzlCWjtBRGlDUTtFQUNJLG1CQUFBO0FDL0JaO0FEa0NRO0VBQ0ksZ0JBQUE7RUFDQSxrQkFBQTtBQ2hDWjtBRG1DUTtFQUNJLGdCQUFBO0FDakNaO0FEcUNJO0VBQ0ksc0JBQUE7RUFDQSx5QkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtFQUNBLGNBQUE7QUNuQ1I7QURzQ0k7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FDcENSO0FEdUNJO0VBQ0ksb0NBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0VBQ0EsWUFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxlQUFBO0FDckNSO0FEd0NJO0VBQ0ksZ0JBQUE7RUFDQSx1QkFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0VBQ0EsZUFBQTtFQUNBLGdCQUFBO0FDdENSO0FEMENJO0VBQ0ksWUFBQTtBQ3hDUjtBRDJDSTtFQUNJLHdCQUFBO0VBQ0EseUNBQUE7RUFDQSw4QkFBQTtBQ3pDUjtBRDhDWTtFQUNJLHlCQUFBO0FDNUNoQjtBRGlEWTtFQUNJLGNBQUE7QUMvQ2hCO0FEb0RRO0VBQ0ksYUFBQTtBQ2xEWjtBRHFESTtFQUNJLHlCQUFBO0FDbkRSO0FEc0RJO0VBQ0kseUJBQUE7QUNwRFI7QUR1REk7RUFDSSx5QkFBQTtBQ3JEUjtBRHdESTtFQUNJLHlCQUFBO0FDdERSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9yb3lhbHR5ZmVlL3JveWFsdHlmZWUuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjY2VudHJlY2VydGlmaWNhdGUge1xyXG4gICAgLmRhc2h0YWJzIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuXHJcbiAgICAgICAgLm1hdC10YWItaGVhZGVyIHtcclxuICAgICAgICAgICAgYm9yZGVyOiAwcHg7XHJcblxyXG4gICAgICAgICAgICAubWF0LXRhYi1saXN0IHtcclxuICAgICAgICAgICAgICAgIGZsZXgtZ3JvdzogMTtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgICAgICAgICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG5cclxuICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOjQ4MHB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC10YWItbGFiZWxzIHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo0ODBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC10YWItbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBvcGFjaXR5OiAxO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzNnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICYubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1pbmstYmFyIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtdGFiLWJvZHkge1xyXG4gICAgICAgICAgICAubWF0LXRhYi1ib2R5LWNvbnRlbnQge1xyXG4gICAgICAgICAgICAgICAgLmlubmVyZGFzaHRhYnMge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LXRhYi1oZWFkZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXI6IDBweDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtdGFiLWxpc3Qge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgZmxleC1ncm93OiAxO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDMwcHggIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo4MDBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtdGFiLWxhYmVscyB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtdGFiLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDogMjhweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo4MDBweCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJi5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtaW5rLWJhciB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAuYXdhcmVkdGFibGUge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDBweDtcclxuXHJcbiAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1yb3cge1xyXG4gICAgICAgICAgICB3aWR0aDogZml0LWNvbnRlbnQ7XHJcblxyXG4gICAgICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjUgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG5cclxuICAgICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzYyNjM2NiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtc2VsZWN0LXZhbHVlIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAjc2VhcmNocm93LFxyXG4gICAgI2ZpbHRlcnNob3cge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcblxyXG4gICAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweFxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo3NjhweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgQG1lZGlhKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5zY3JvbGxkYXRhIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgei1pbmRleDogMTtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDZweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNjY2M7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmV4cG9ydGJ0biB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZDdkY2UzO1xyXG4gICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XHJcbiAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnN1Ym1pdF9idG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcclxuICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1pbi13aWR0aDogMTIwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNhbmNlbGJ0biB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZThlOGU4O1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5maWx0ZXIge1xyXG4gICAgICAgIGhlaWdodDogNDVweDtcclxuICAgIH1cclxuXHJcbiAgICAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnRhYmZvcmNsaWVudGVsZW5ldyB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2FjYWNhYztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5tYXN0ZXJQYWdlVG9wIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnJlY2VpdmUge1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBhaWQge1xyXG4gICAgICAgIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLm92ZXIge1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBlbmRpbmcge1xyXG4gICAgICAgIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbn0iLCIjY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciB7XG4gIGJvcmRlcjogMHB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCB7XG4gIGZsZXgtZ3JvdzogMTtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBvcGFjaXR5OiAxO1xuICBtaW4td2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA0ODBweCkge1xuICAjY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IHtcbiAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDQ4MHB4KSB7XG4gICNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIHtcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICB9XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtdGFiLWxhYmVscyAubWF0LXRhYi1sYWJlbCB7XG4gIG9wYWNpdHk6IDE7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xuICBoZWlnaHQ6IDM2cHg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMgLm1hdC10YWItbGFiZWwubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogODAwcHgpIHtcbiAgI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMgLm1hdC10YWItbGFiZWwge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC1pbmstYmFyIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIge1xuICBib3JkZXI6IDBweDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3Qge1xuICBmbGV4LWdyb3c6IDE7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgb3BhY2l0eTogMTtcbiAgbWluLXdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGhlaWdodDogMzBweCAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDgwMHB4KSB7XG4gICNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3Qge1xuICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xuICB9XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmRhc2h0YWJzIC5tYXQtdGFiLWJvZHkgLm1hdC10YWItYm9keS1jb250ZW50IC5pbm5lcmRhc2h0YWJzIC5tYXQtdGFiLWhlYWRlciAubWF0LXRhYi1saXN0IC5tYXQtdGFiLWxhYmVscyB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG5AbWVkaWEgKG1heC13aWR0aDogODAwcHgpIHtcbiAgI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMge1xuICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XG4gIH1cbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIC5tYXQtdGFiLWxhYmVsIHtcbiAgb3BhY2l0eTogMTtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xuICBtYXJnaW4tcmlnaHQ6IDEwcHg7XG4gIGhlaWdodDogMjhweDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogODAwcHgpIHtcbiAgI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LXRhYi1sYWJlbHMgLm1hdC10YWItbGFiZWwge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZGFzaHRhYnMgLm1hdC10YWItYm9keSAubWF0LXRhYi1ib2R5LWNvbnRlbnQgLmlubmVyZGFzaHRhYnMgLm1hdC10YWItaGVhZGVyIC5tYXQtdGFiLWxpc3QgLm1hdC10YWItbGFiZWxzIC5tYXQtdGFiLWxhYmVsLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5kYXNodGFicyAubWF0LXRhYi1ib2R5IC5tYXQtdGFiLWJvZHktY29udGVudCAuaW5uZXJkYXNodGFicyAubWF0LXRhYi1oZWFkZXIgLm1hdC10YWItbGlzdCAubWF0LWluay1iYXIge1xuICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmF3YXJlZHRhYmxlIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBtYXJnaW46IDEwcHggMHB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSAubWFuYWdlb3B0aW9ucyB7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmF3YXJlZHRhYmxlIC5tYXQtcm93IHtcbiAgd2lkdGg6IGZpdC1jb250ZW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5hd2FyZWR0YWJsZSAubWF0LXJvdzpob3ZlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjUgIWltcG9ydGFudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuYXdhcmVkdGFibGUgLm1hdC1jZWxsIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmF3YXJlZHRhYmxlIC5tYXQtaGVhZGVyLWNlbGwge1xuICBjb2xvcjogIzYyNjM2NiAhaW1wb3J0YW50O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtc2VsZWN0LXZhbHVlIHtcbiAgY29sb3I6ICM2MjYzNjY7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBtYXJnaW46IDBweCAxMHB4ICFpbXBvcnRhbnQ7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgI3NlYXJjaHJvdyxcbiNjZW50cmVjZXJ0aWZpY2F0ZSAjZmlsdGVyc2hvdyB7XG4gIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiBub25lO1xufVxuI2NlbnRyZWNlcnRpZmljYXRlICNzZWFyY2hyb3cgLnNlcmFjaHJvdyxcbiNjZW50cmVjZXJ0aWZpY2F0ZSAjZmlsdGVyc2hvdyAuc2VyYWNocm93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4taGVpZ2h0OiA3M3B4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI2NlbnRyZWNlcnRpZmljYXRlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAjY2VudHJlY2VydGlmaWNhdGUgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5zY3JvbGxkYXRhIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAxO1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcbiAgd2lkdGg6IDZweDtcbiAgaGVpZ2h0OiA1cHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcbiAgYmFja2dyb3VuZDogI2YxZjFmMTtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAuZXhwb3J0YnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZGNlMztcbiAgaGVpZ2h0OiA0NXB4O1xuICBtaW4td2lkdGg6IDExMHB4O1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAubWF0LXJhaXNlZC1idXR0b24ge1xuICBib3gtc2hhZG93OiBub25lO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnN1Ym1pdF9idG4ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3ICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi13aWR0aDogMTIwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgcGFkZGluZy1sZWZ0OiAwcHg7XG4gIHBhZGRpbmctcmlnaHQ6IDBweDtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5jYW5jZWxidG4ge1xuICBtaW4td2lkdGg6IDEyMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2U4ZThlODtcbiAgY29sb3I6ICMyNjI2MjY7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xuICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5maWx0ZXIge1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC50YWJmb3JjbGllbnRlbGVuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC50YWJmb3JjbGllbnRlbGVuZXcgLm1hbmFnZW9wdGlvbnMgLm1hdC1pY29uIHtcbiAgY29sb3I6ICNhY2FjYWM7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5yZWNlaXZlIHtcbiAgY29sb3I6ICMwMGE1NTEgIWltcG9ydGFudDtcbn1cbiNjZW50cmVjZXJ0aWZpY2F0ZSAucGFpZCB7XG4gIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG59XG4jY2VudHJlY2VydGlmaWNhdGUgLm92ZXIge1xuICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xufVxuI2NlbnRyZWNlcnRpZmljYXRlIC5wZW5kaW5nIHtcbiAgY29sb3I6ICNmNDgxMWYgIWltcG9ydGFudDtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.ts":
  /*!******************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.ts ***!
    \******************************************************************************/

  /*! exports provided: RoyaltyfeeComponent */

  /***/
  function srcAppModulesInvoicemanagementRoyaltyfeeRoyaltyfeeComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "RoyaltyfeeComponent", function () {
      return RoyaltyfeeComponent;
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


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js"); //tab 1


    var TraingList_Data = [{
      position: 1,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      coursetitle: 'Rescue From Height',
      coursecate: 'Fire ans Safety',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      invoicemonth: 'Jan 2023',
      totallearner: '2',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 2,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      coursetitle: 'Rescue From Height',
      coursecate: 'Fire ans Safety',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      invoicemonth: 'Jan 2023',
      totallearner: '2',
      invoiceamount: '105.000',
      paymentstatus: 'O',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 3,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      coursetitle: 'Rescue From Height',
      coursecate: 'Fire ans Safety',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      invoicemonth: 'Jan 2023',
      totallearner: '2',
      invoiceamount: '105.000',
      paymentstatus: 'Paid',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 4,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      coursetitle: 'Rescue From Height',
      coursecate: 'Fire ans Safety',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      invoicemonth: 'Jan 2023',
      totallearner: '2',
      invoiceamount: '105.000',
      paymentstatus: 'P',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 5,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      trainingprovider: 'Ahmed Bin',
      coursetitle: 'Rescue From Height',
      coursecate: 'Fire ans Safety',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      invoicemonth: 'Jan 2023',
      totallearner: '2',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }]; //tab 2

    var TechnicalList_Data = [{
      position: 1,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      invoicemonth: 'Feb 2023',
      totallearner: '3',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 2,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      invoicemonth: 'Feb 2023',
      totallearner: '4',
      invoiceamount: '105.000',
      paymentstatus: 'P',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 3,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      invoicemonth: 'Feb 2023',
      totallearner: '6',
      invoiceamount: '105.000',
      paymentstatus: 'Paid',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 4,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      invoicemonth: 'Feb 2023',
      totallearner: '3',
      invoiceamount: '105.000',
      paymentstatus: 'O',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }, {
      position: 5,
      invoiceno: 'INV-999-CRI-2022-32',
      compannyname: 'Al Khelijan Techical service',
      centrename: 'KHDH',
      officetype: 'Main Branch',
      branchname: 'Direct Contract',
      opalmember: 'cyber Security',
      projectname: 'Roadworthiness Assurance',
      invoicemonth: 'Feb 2023',
      totallearner: '4',
      invoiceamount: '105.000',
      paymentstatus: 'R',
      invoicedate: '23-04-2024',
      invoiceage: '20 Days',
      paymentdate: 20 - 1 - 2023
    }];

    var RoyaltyfeeComponent = /*#__PURE__*/function () {
      function RoyaltyfeeComponent(translate, remoteService, toastr, cookieService) {
        _classCallCheck(this, RoyaltyfeeComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.toastr = toastr;
        this.cookieService = cookieService;
        this.mattab = 0;
        this.trainingevaluation = 'tabs'; // technicalevaluation = 'technicalgridlist';
        //tab 1

        this.TrainingListData = ['invoiceno', 'compannyname', 'trainingprovider', 'coursetitle', 'coursecate', 'officetype', 'branchname', 'opalmember', 'invoicemonth', 'totallearner', 'invoiceamount', 'paymentstatus', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
        this.TrainingData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](TraingList_Data); //tab 2

        this.TechnicalListData = ['invoiceno', 'compannyname', 'centrename', 'officetype', 'branchname', 'opalmember', 'projectname', 'invoicemonth', 'totallearner', 'invoiceamount', 'paymentstatus', 'invoicedate', 'invoiceage', 'paymentdate', 'action'];
        this.TechnicalData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](TechnicalList_Data);
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.page = 10;
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
        this.dir = "ltr"; //tab 1

        this.invoice_no = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.company_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.training_provider = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.course_title = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.course_cate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.office_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.bran_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.opal_membership = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.pay_status = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.pay_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoice_date = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoice_age = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.payment_date = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"](''); // tab 2

        this.invoiceno = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.companyname = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.centre_name = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.officetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.branname = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.opalmembership = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.Feetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.project_type = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paystatus = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoicedate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.invoiceage = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.paymentdate = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
      }

      _createClass(RoyaltyfeeComponent, [{
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this4 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this4.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect10 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect10.languagecode);
            this.dir = _toSelect10.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this4.translate.setDefaultLang(_this4.cookieService.get('languageCode'));

            if (_this4.cookieService.get('languageCookieId') && _this4.cookieService.get('languageCookieId') != undefined && _this4.cookieService.get('languageCookieId') != null) {
              var _toSelect11 = _this4.languagelist.find(function (c) {
                return c.id === _this4.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this4.translate.setDefaultLang(_toSelect11.languagecode);

              _this4.dir = _toSelect11.dir;
            } else {
              var _toSelect12 = _this4.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this4.translate.setDefaultLang(_toSelect12.languagecode);

              _this4.dir = _toSelect12.dir;
            }
          });
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

            var _id4 = document.getElementById('searchrow');

            _id4.style.display = 'flex';
          }
        }
      }, {
        key: "clickedEvent",
        value: function clickedEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = 'Show Filter';
            var id = document.getElementById('searchrow');
            id.style.display = 'none';
          } else {
            this.filtername = 'Hide Filter';

            var _id5 = document.getElementById('searchrow');

            _id5.style.display = 'flex';
          }
        }
      }, {
        key: "syncPrimaryPaginator",
        value: function syncPrimaryPaginator(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
        }
      }, {
        key: "syncPrimaryPaginators",
        value: function syncPrimaryPaginators(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
        }
      }, {
        key: "next",
        value: function next() {
          this.trainingevaluation = 'payment';
        }
      }, {
        key: "nextpayment",
        value: function nextpayment() {
          this.trainingevaluation = 'payment';
        }
      }]);

      return RoyaltyfeeComponent;
    }();

    RoyaltyfeeComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('MatTabGroup'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__["MatTabGroup"])], RoyaltyfeeComponent.prototype, "tabGroup", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__["MatPaginator"])], RoyaltyfeeComponent.prototype, "paginator", void 0);
    RoyaltyfeeComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-royaltyfee',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./royaltyfee.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./royaltyfee.component.scss */
      "./src/app/modules/invoicemanagement/royaltyfee/royaltyfee.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]])], RoyaltyfeeComponent);
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.scss":
  /*!****************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.scss ***!
    \****************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesInvoicemanagementRoyaltypaymentRoyaltypaymentComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#royalpayment .validet {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n  height: 45px;\n  min-width: 120px;\n  box-shadow: none;\n}\n#royalpayment .knowledgegrid {\n  background: #FFFFFF 0% 0% no-repeat padding-box;\n  box-shadow: 0px 0px 8px #0000001a;\n  border: 1px solid #D7DCE3;\n  border-radius: 4px;\n  opacity: 1;\n  padding: 10px;\n}\n#royalpayment .knowledgegrid .text-gray {\n  color: #848484;\n}\n#royalpayment .knowledgegrid .text-default {\n  color: #262626 !important;\n}\n#royalpayment .knowledgegrid .bold {\n  font-weight: 600;\n}\n#royalpayment .knowledgegrid .details .head {\n  justify-content: space-between;\n  align-items: center;\n  height: 40px;\n}\n#royalpayment .knowledgegrid .details .head .grade {\n  align-items: center;\n  color: #895B37;\n}\n#royalpayment .knowledgegrid .details .head .gold {\n  align-items: center;\n  color: #BA9666;\n}\n#royalpayment .knowledgegrid .details .head .silver {\n  align-items: center;\n  color: #B9BABC;\n}\n#royalpayment .knowledgegrid .details .application-detais {\n  border: 1px solid #D7DCE3;\n  padding: 5px;\n  margin-top: 10px !important;\n}\n#royalpayment .knowledgegrid .details .application-detais.status span:nth-child(1) {\n  color: #f4811f !important;\n}\n#royalpayment .knowledgegrid .details .application-detais.status span:nth-child(2) {\n  color: #0c4b9a !important;\n}\n#royalpayment .knowledgegrid .details .application-detais.status span:nth-child(3) {\n  color: #ed1c27 !important;\n}\n#royalpayment .knowledgegrid .details .application-detais.status span:nth-child(4) {\n  color: #00a551 !important;\n}\n#royalpayment .knowledgegrid .address {\n  justify-content: space-between;\n  width: 60%;\n}\n#royalpayment .knowledgegrid .address .add-details i {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #707070;\n}\n#royalpayment h4 {\n  color: #0C4B9A;\n}\n#royalpayment .feedetails .view_dtl p {\n  min-width: 222px;\n  color: #848484;\n  font-size: 16px;\n}\n@media (max-width: 768px) {\n  #royalpayment .feedetails .view_dtl p {\n    min-width: 178px;\n  }\n}\n#royalpayment .feedetails .view_dtl span {\n  color: #262626;\n  font-size: 16px;\n}\n#royalpayment .feedetails .view_dtl span .document {\n  width: 22px;\n  height: 28px;\n}\n#royalpayment .badge {\n  color: #fff;\n  padding: 3px 5px;\n  font-size: 15px;\n  border-radius: 3px;\n}\n#royalpayment .badge.pendings {\n  background-color: #0c4b9a;\n}\n#royalpayment .badge.update {\n  background-color: #0c4b9a;\n}\n#royalpayment .badge.appr {\n  background-color: #00a551;\n}\n#royalpayment .badge.decl {\n  background-color: #ed1c27;\n}\n#royalpayment .successcmd {\n  border: 1px solid #00a551;\n  border-radius: 3px;\n  padding: 15px 15px 10px 15px;\n  background-color: #f8fffb;\n}\n#royalpayment .successcmd .comment {\n  color: #00a551 !important;\n}\n#royalpayment .successcmd p {\n  color: #262626;\n}\n#royalpayment .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#royalpayment .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#royalpayment .awaredtable .mat-row {\n  width: -moz-fit-content;\n  width: fit-content;\n}\n#royalpayment .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#royalpayment .awaredtable .mat-cell {\n  color: #262626;\n}\n#royalpayment .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#royalpayment .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#royalpayment .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#royalpayment .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#royalpayment #searchrow,\n#royalpayment #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#royalpayment #searchrow .serachrow,\n#royalpayment #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#royalpayment .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n  padding: 0px !important;\n}\n@media (max-width: 768px) {\n  #royalpayment .footerpaginator .mat-paginator-outer-container .mat-paginator-container {\n    display: block !important;\n  }\n}\n#royalpayment .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#royalpayment .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n@media (max-width: 768px) {\n  #royalpayment .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n#royalpayment .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#royalpayment .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#royalpayment .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#royalpayment .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#royalpayment .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#royalpayment .filter {\n  height: 45px;\n}\n#royalpayment .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#royalpayment .tabforclientelenew .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#royalpayment .tabforclientelenew .manageoptions .mat-icon {\n  color: #acacac;\n}\n#royalpayment .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#royalpayment .receive {\n  color: #00a551 !important;\n}\n#royalpayment .paid {\n  color: #0c4b9a !important;\n}\n#royalpayment .over {\n  color: #ed1c27 !important;\n}\n#royalpayment .pending {\n  color: #f4811f !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9pbnZvaWNlbWFuYWdlbWVudC9yb3lhbHR5cGF5bWVudC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxpbnZvaWNlbWFuYWdlbWVudFxccm95YWx0eXBheW1lbnRcXHJveWFsdHlwYXltZW50LmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2ludm9pY2VtYW5hZ2VtZW50L3JveWFsdHlwYXltZW50L3JveWFsdHlwYXltZW50LmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUVRO0VBQ0ksb0NBQUE7RUFDQSxzQkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtFQUNBLGdCQUFBO0FDRFo7QURJSTtFQUNJLCtDQUFBO0VBQ0EsaUNBQUE7RUFDQSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLGFBQUE7QUNGUjtBRElRO0VBQ0ksY0FBQTtBQ0ZaO0FES1E7RUFDSSx5QkFBQTtBQ0haO0FETVE7RUFDSSxnQkFBQTtBQ0paO0FEU1k7RUFDSSw4QkFBQTtFQUNBLG1CQUFBO0VBQ0EsWUFBQTtBQ1BoQjtBRFNnQjtFQUNJLG1CQUFBO0VBQ0EsY0FBQTtBQ1BwQjtBRFVnQjtFQUNJLG1CQUFBO0VBQ0EsY0FBQTtBQ1JwQjtBRFdnQjtFQUNJLG1CQUFBO0VBQ0EsY0FBQTtBQ1RwQjtBRGFZO0VBQ0kseUJBQUE7RUFDQSxZQUFBO0VBQ0EsMkJBQUE7QUNYaEI7QURld0I7RUFDSSx5QkFBQTtBQ2I1QjtBRGdCd0I7RUFDSSx5QkFBQTtBQ2Q1QjtBRGlCd0I7RUFDSSx5QkFBQTtBQ2Y1QjtBRGtCd0I7RUFDSSx5QkFBQTtBQ2hCNUI7QUR3QlE7RUFDSSw4QkFBQTtFQUNBLFVBQUE7QUN0Qlo7QUR5QmdCO0VBRUksa0JBQUE7RUFDQSw4QkFBQTtFQUNBLGtDQUFBO0FDeEJwQjtBRCtCSTtFQUNJLGNBQUE7QUM3QlI7QURvQ1k7RUFDSSxnQkFBQTtFQUNBLGNBQUE7RUFDQSxlQUFBO0FDbENoQjtBRG9DZ0I7RUFMSjtJQU1RLGdCQUFBO0VDakNsQjtBQUNGO0FEb0NZO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QUNsQ2hCO0FEb0NnQjtFQUNJLFdBQUE7RUFDQSxZQUFBO0FDbENwQjtBRHdDSTtFQUNJLFdBQUE7RUFDQSxnQkFBQTtFQUNBLGVBQUE7RUFDQSxrQkFBQTtBQ3RDUjtBRHdDUTtFQUNJLHlCQUFBO0FDdENaO0FEeUNRO0VBQ0kseUJBQUE7QUN2Q1o7QUQwQ1E7RUFDSSx5QkFBQTtBQ3hDWjtBRDJDUTtFQUNJLHlCQUFBO0FDekNaO0FEOENJO0VBQ0kseUJBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7QUM1Q1I7QUQ4Q1E7RUFDSSx5QkFBQTtBQzVDWjtBRCtDUTtFQUNJLGNBQUE7QUM3Q1o7QURpREk7RUFDSSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0Esc0JBQUE7RUFDQSxnQkFBQTtBQy9DUjtBRGlEUTtFQUNJLG1CQUFBO0FDL0NaO0FEa0RRO0VBQ0ksdUJBQUE7RUFBQSxrQkFBQTtBQ2hEWjtBRGtEWTtFQUNJLG9DQUFBO0FDaERoQjtBRHNEUTtFQUNJLGNBQUE7QUNwRFo7QUR1RFE7RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBQ3JEWjtBRDBEUTtFQUNJLFdBQUE7RUFDQSxlQUFBO0FDeERaO0FEMkRRO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QUN6RFo7QUQ0RFE7RUFDSSxXQUFBO0VBQ0EsZUFBQTtFQUNBLDJCQUFBO0FDMURaO0FEOERJOztFQUVJLDJCQUFBO0VBQ0EsWUFBQTtBQzVEUjtBRDhEUTs7RUFDSSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsbUJBQUE7QUMzRFo7QURpRVk7RUFDSSx1QkFBQTtBQy9EaEI7QURpRWdCO0VBSEo7SUFJUSx5QkFBQTtFQzlEbEI7QUFDRjtBRGlFWTtFQUNJLHlCQUFBO0VBQ0EsY0FBQTtBQy9EaEI7QURpRWdCO0VBQ0kseUJBQUE7QUMvRHBCO0FEbUVnQjtFQVRKO0lBVVEsc0JBQUE7RUNoRWxCO0FBQ0Y7QURxRUk7RUFDSSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxjQUFBO0VBQ0EsZ0JBQUE7RUFDQSxzQkFBQTtFQUNBLHVCQUFBO0FDbkVSO0FEcUVRO0VBQ0ksVUFBQTtFQUNBLFdBQUE7QUNuRVo7QURzRVE7RUFDSSxtQkFBQTtBQ3BFWjtBRHVFUTtFQUNJLGdCQUFBO0VBQ0Esa0JBQUE7QUNyRVo7QUR3RVE7RUFDSSxnQkFBQTtBQ3RFWjtBRDBFSTtFQUNJLFlBQUE7QUN4RVI7QUQyRUk7RUFDSSx3QkFBQTtFQUNBLHlDQUFBO0VBQ0EsOEJBQUE7QUN6RVI7QUQ4RVk7RUFDSSx5QkFBQTtBQzVFaEI7QURpRlk7RUFDSSxjQUFBO0FDL0VoQjtBRHFGUTtFQUNJLGFBQUE7QUNuRlo7QUR1Rkk7RUFDSSx5QkFBQTtBQ3JGUjtBRHdGSTtFQUNJLHlCQUFBO0FDdEZSO0FEeUZJO0VBQ0kseUJBQUE7QUN2RlI7QUQwRkk7RUFDSSx5QkFBQTtBQ3hGUiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvaW52b2ljZW1hbmFnZW1lbnQvcm95YWx0eXBheW1lbnQvcm95YWx0eXBheW1lbnQuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjcm95YWxwYXltZW50IHtcclxuXHJcbiAgICAgICAgLnZhbGlkZXQge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICB9XHJcblxyXG4gICAgLmtub3dsZWRnZWdyaWQge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNGRkZGRkYgMCUgMCUgbm8tcmVwZWF0IHBhZGRpbmctYm94O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IDBweCAwcHggOHB4ICMwMDAwMDAxYTtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjRDdEQ0UzO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDRweDtcclxuICAgICAgICBvcGFjaXR5OiAxO1xyXG4gICAgICAgIHBhZGRpbmc6IDEwcHg7XHJcblxyXG4gICAgICAgIC50ZXh0LWdyYXkge1xyXG4gICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC50ZXh0LWRlZmF1bHQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNiAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmJvbGQge1xyXG4gICAgICAgICAgICBmb250LXdlaWdodDogNjAwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmRldGFpbHMge1xyXG5cclxuICAgICAgICAgICAgLmhlYWQge1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuXHJcbiAgICAgICAgICAgICAgICAuZ3JhZGUge1xyXG4gICAgICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4OTVCMzc7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLmdvbGQge1xyXG4gICAgICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNCQTk2NjY7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLnNpbHZlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0I5QkFCQztcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLmFwcGxpY2F0aW9uLWRldGFpcyB7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjRDdEQ0UzO1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogNXB4O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMTBweCAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgICAgICYuc3RhdHVzIHtcclxuICAgICAgICAgICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJjpudGgtY2hpbGQoMSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmNDgxMWYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgJjpudGgtY2hpbGQoMikge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgJjpudGgtY2hpbGQoMykge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAgICAgJjpudGgtY2hpbGQoNCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwMGE1NTEgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5hZGRyZXNzIHtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICB3aWR0aDogNjAlO1xyXG5cclxuICAgICAgICAgICAgLmFkZC1kZXRhaWxzIHtcclxuICAgICAgICAgICAgICAgIGkge1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS13aWR0aDogMXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2UtY29sb3I6ICM3MDcwNzA7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIGg0IHtcclxuICAgICAgICBjb2xvcjogIzBDNEI5QTtcclxuICAgIH1cclxuXHJcbiAgICAuZmVlZGV0YWlscyB7XHJcblxyXG5cclxuICAgICAgICAudmlld19kdGwge1xyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMjIycHg7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTZweDtcclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMTc4cHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE2cHg7XHJcblxyXG4gICAgICAgICAgICAgICAgLmRvY3VtZW50IHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMjJweDtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDI4cHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmJhZGdlIHtcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBwYWRkaW5nOiAzcHggNXB4O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcblxyXG4gICAgICAgICYucGVuZGluZ3Mge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi51cGRhdGUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5hcHByIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwYTU1MTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYuZGVjbCB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjc7XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAuc3VjY2Vzc2NtZCB7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgIzAwYTU1MTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICAgICAgcGFkZGluZzogMTVweCAxNXB4IDEwcHggMTVweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmZmZiO1xyXG5cclxuICAgICAgICAuY29tbWVudCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5hd2FyZWR0YWJsZSB7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBtYXJnaW46IDEwcHggMHB4O1xyXG5cclxuICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDE1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXJvdyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiBmaXQtY29udGVudDtcclxuXHJcbiAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNSAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgIC5tYXQtY2VsbCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1oZWFkZXItY2VsbCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1zZWxlY3QtdmFsdWUge1xyXG4gICAgICAgICAgICBjb2xvcjogIzYyNjM2NjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgICBtYXJnaW46IDBweCAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgICNzZWFyY2hyb3csXHJcbiAgICAjZmlsdGVyc2hvdyB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlcjogbm9uZTtcclxuXHJcbiAgICAgICAgLnNlcmFjaHJvdyB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5mb290ZXJwYWdpbmF0b3Ige1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo3NjhweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnNjcm9sbGRhdGEge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICB6LWluZGV4OiAxO1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgICAgICAgICB3aWR0aDogNnB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2YxZjFmMTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZmlsdGVyIHtcclxuICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC50YWJmb3JjbGllbnRlbGVuZXcge1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtaW5maXgge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogOHB4IDAgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNhY2FjYWM7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hc3RlclBhZ2VUb3Age1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnJlY2VpdmUge1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBhaWQge1xyXG4gICAgICAgIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLm92ZXIge1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBlbmRpbmcge1xyXG4gICAgICAgIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbn0iLCIjcm95YWxwYXltZW50IC52YWxpZGV0IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIG1pbi13aWR0aDogMTIwcHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4jcm95YWxwYXltZW50IC5rbm93bGVkZ2VncmlkIHtcbiAgYmFja2dyb3VuZDogI0ZGRkZGRiAwJSAwJSBuby1yZXBlYXQgcGFkZGluZy1ib3g7XG4gIGJveC1zaGFkb3c6IDBweCAwcHggOHB4ICMwMDAwMDAxYTtcbiAgYm9yZGVyOiAxcHggc29saWQgI0Q3RENFMztcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xuICBvcGFjaXR5OiAxO1xuICBwYWRkaW5nOiAxMHB4O1xufVxuI3JveWFscGF5bWVudCAua25vd2xlZGdlZ3JpZCAudGV4dC1ncmF5IHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jcm95YWxwYXltZW50IC5rbm93bGVkZ2VncmlkIC50ZXh0LWRlZmF1bHQge1xuICBjb2xvcjogIzI2MjYyNiAhaW1wb3J0YW50O1xufVxuI3JveWFscGF5bWVudCAua25vd2xlZGdlZ3JpZCAuYm9sZCB7XG4gIGZvbnQtd2VpZ2h0OiA2MDA7XG59XG4jcm95YWxwYXltZW50IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIHtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBoZWlnaHQ6IDQwcHg7XG59XG4jcm95YWxwYXltZW50IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIC5ncmFkZSB7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGNvbG9yOiAjODk1QjM3O1xufVxuI3JveWFscGF5bWVudCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuaGVhZCAuZ29sZCB7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGNvbG9yOiAjQkE5NjY2O1xufVxuI3JveWFscGF5bWVudCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuaGVhZCAuc2lsdmVyIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY29sb3I6ICNCOUJBQkM7XG59XG4jcm95YWxwYXltZW50IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5hcHBsaWNhdGlvbi1kZXRhaXMge1xuICBib3JkZXI6IDFweCBzb2xpZCAjRDdEQ0UzO1xuICBwYWRkaW5nOiA1cHg7XG4gIG1hcmdpbi10b3A6IDEwcHggIWltcG9ydGFudDtcbn1cbiNyb3lhbHBheW1lbnQgLmtub3dsZWRnZWdyaWQgLmRldGFpbHMgLmFwcGxpY2F0aW9uLWRldGFpcy5zdGF0dXMgc3BhbjpudGgtY2hpbGQoMSkge1xuICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xufVxuI3JveWFscGF5bWVudCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuYXBwbGljYXRpb24tZGV0YWlzLnN0YXR1cyBzcGFuOm50aC1jaGlsZCgyKSB7XG4gIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG59XG4jcm95YWxwYXltZW50IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5hcHBsaWNhdGlvbi1kZXRhaXMuc3RhdHVzIHNwYW46bnRoLWNoaWxkKDMpIHtcbiAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcbn1cbiNyb3lhbHBheW1lbnQgLmtub3dsZWRnZWdyaWQgLmRldGFpbHMgLmFwcGxpY2F0aW9uLWRldGFpcy5zdGF0dXMgc3BhbjpudGgtY2hpbGQoNCkge1xuICBjb2xvcjogIzAwYTU1MSAhaW1wb3J0YW50O1xufVxuI3JveWFscGF5bWVudCAua25vd2xlZGdlZ3JpZCAuYWRkcmVzcyB7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgd2lkdGg6IDYwJTtcbn1cbiNyb3lhbHBheW1lbnQgLmtub3dsZWRnZWdyaWQgLmFkZHJlc3MgLmFkZC1kZXRhaWxzIGkge1xuICBjb2xvcjogdHJhbnNwYXJlbnQ7XG4gIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDFweDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogIzcwNzA3MDtcbn1cbiNyb3lhbHBheW1lbnQgaDQge1xuICBjb2xvcjogIzBDNEI5QTtcbn1cbiNyb3lhbHBheW1lbnQgLmZlZWRldGFpbHMgLnZpZXdfZHRsIHAge1xuICBtaW4td2lkdGg6IDIyMnB4O1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gICNyb3lhbHBheW1lbnQgLmZlZWRldGFpbHMgLnZpZXdfZHRsIHAge1xuICAgIG1pbi13aWR0aDogMTc4cHg7XG4gIH1cbn1cbiNyb3lhbHBheW1lbnQgLmZlZWRldGFpbHMgLnZpZXdfZHRsIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuI3JveWFscGF5bWVudCAuZmVlZGV0YWlscyAudmlld19kdGwgc3BhbiAuZG9jdW1lbnQge1xuICB3aWR0aDogMjJweDtcbiAgaGVpZ2h0OiAyOHB4O1xufVxuI3JveWFscGF5bWVudCAuYmFkZ2Uge1xuICBjb2xvcjogI2ZmZjtcbiAgcGFkZGluZzogM3B4IDVweDtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG59XG4jcm95YWxwYXltZW50IC5iYWRnZS5wZW5kaW5ncyB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XG59XG4jcm95YWxwYXltZW50IC5iYWRnZS51cGRhdGUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xufVxuI3JveWFscGF5bWVudCAuYmFkZ2UuYXBwciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTE7XG59XG4jcm95YWxwYXltZW50IC5iYWRnZS5kZWNsIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNztcbn1cbiNyb3lhbHBheW1lbnQgLnN1Y2Nlc3NjbWQge1xuICBib3JkZXI6IDFweCBzb2xpZCAjMDBhNTUxO1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG4gIHBhZGRpbmc6IDE1cHggMTVweCAxMHB4IDE1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGZmZmI7XG59XG4jcm95YWxwYXltZW50IC5zdWNjZXNzY21kIC5jb21tZW50IHtcbiAgY29sb3I6ICMwMGE1NTEgIWltcG9ydGFudDtcbn1cbiNyb3lhbHBheW1lbnQgLnN1Y2Nlc3NjbWQgcCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3JveWFscGF5bWVudCAuYXdhcmVkdGFibGUge1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIG1hcmdpbjogMTBweCAwcHg7XG59XG4jcm95YWxwYXltZW50IC5hd2FyZWR0YWJsZSAubWFuYWdlb3B0aW9ucyB7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jcm95YWxwYXltZW50IC5hd2FyZWR0YWJsZSAubWF0LXJvdyB7XG4gIHdpZHRoOiBmaXQtY29udGVudDtcbn1cbiNyb3lhbHBheW1lbnQgLmF3YXJlZHRhYmxlIC5tYXQtcm93OmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNSAhaW1wb3J0YW50O1xufVxuI3JveWFscGF5bWVudCAuYXdhcmVkdGFibGUgLm1hdC1jZWxsIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jcm95YWxwYXltZW50IC5hd2FyZWR0YWJsZSAubWF0LWhlYWRlci1jZWxsIHtcbiAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI3JveWFscGF5bWVudCAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNyb3lhbHBheW1lbnQgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtc2VsZWN0LXZhbHVlIHtcbiAgY29sb3I6ICM2MjYzNjY7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNyb3lhbHBheW1lbnQgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xufVxuI3JveWFscGF5bWVudCAjc2VhcmNocm93LFxuI3JveWFscGF5bWVudCAjZmlsdGVyc2hvdyB7XG4gIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiBub25lO1xufVxuI3JveWFscGF5bWVudCAjc2VhcmNocm93IC5zZXJhY2hyb3csXG4jcm95YWxwYXltZW50ICNmaWx0ZXJzaG93IC5zZXJhY2hyb3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbn1cbiNyb3lhbHBheW1lbnQgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI3JveWFscGF5bWVudCAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNyb3lhbHBheW1lbnQgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI3JveWFscGF5bWVudCAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAjcm95YWxwYXltZW50IC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNyb3lhbHBheW1lbnQgLnNjcm9sbGRhdGEge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHotaW5kZXg6IDE7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBvdmVyZmxvdy14OiBhdXRvO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcbn1cbiNyb3lhbHBheW1lbnQgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcbiAgd2lkdGg6IDZweDtcbiAgaGVpZ2h0OiA1cHg7XG59XG4jcm95YWxwYXltZW50IC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG4jcm95YWxwYXltZW50IC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbn1cbiNyb3lhbHBheW1lbnQgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbn1cbiNyb3lhbHBheW1lbnQgLmZpbHRlciB7XG4gIGhlaWdodDogNDVweDtcbn1cbiNyb3lhbHBheW1lbnQgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI3JveWFscGF5bWVudCAudGFiZm9yY2xpZW50ZWxlbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgcGFkZGluZzogOHB4IDAgIWltcG9ydGFudDtcbn1cbiNyb3lhbHBheW1lbnQgLnRhYmZvcmNsaWVudGVsZW5ldyAubWFuYWdlb3B0aW9ucyAubWF0LWljb24ge1xuICBjb2xvcjogI2FjYWNhYztcbn1cbiNyb3lhbHBheW1lbnQgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI3JveWFscGF5bWVudCAucmVjZWl2ZSB7XG4gIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XG59XG4jcm95YWxwYXltZW50IC5wYWlkIHtcbiAgY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbn1cbiNyb3lhbHBheW1lbnQgLm92ZXIge1xuICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xufVxuI3JveWFscGF5bWVudCAucGVuZGluZyB7XG4gIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.ts":
  /*!**************************************************************************************!*\
    !*** ./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.ts ***!
    \**************************************************************************************/

  /*! exports provided: RoyaltypaymentComponent */

  /***/
  function srcAppModulesInvoicemanagementRoyaltypaymentRoyaltypaymentComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "RoyaltypaymentComponent", function () {
      return RoyaltypaymentComponent;
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


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @angular/material/tabs */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");

    var VehiclesList_Data = [{
      chassisnumber: 'INV-999-CRI-2022-32',
      vehiclenumber: '45788 AM',
      ownername: 'Ahmed Bin Al Rahman Ibrahim',
      feepaid: '130.000',
      royaltypaid: '50.000'
    }];

    var RoyaltypaymentComponent = /*#__PURE__*/function () {
      function RoyaltypaymentComponent(translate, remoteService, toastr, cookieService) {
        _classCallCheck(this, RoyaltypaymentComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.toastr = toastr;
        this.cookieService = cookieService;
        this.pending = false;
        this.reci = false;
        this.bronze = false;
        this.gold = false;
        this.VehicleListData = ['chassisnumber', 'vehiclenumber', 'ownername', 'feepaid', 'royaltypaid'];
        this.vehicleData = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](VehiclesList_Data);
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.page = 10;
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
        this.dir = "ltr"; //tab 1

        this.chass_numb = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.vehicle_numb = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
        this.vehicle_owner = new _angular_forms__WEBPACK_IMPORTED_MODULE_7__["FormControl"]('');
      }

      _createClass(RoyaltypaymentComponent, [{
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
            var _toSelect13 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect13.languagecode);
            this.dir = _toSelect13.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this5.translate.setDefaultLang(_this5.cookieService.get('languageCode'));

            if (_this5.cookieService.get('languageCookieId') && _this5.cookieService.get('languageCookieId') != undefined && _this5.cookieService.get('languageCookieId') != null) {
              var _toSelect14 = _this5.languagelist.find(function (c) {
                return c.id === _this5.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this5.translate.setDefaultLang(_toSelect14.languagecode);

              _this5.dir = _toSelect14.dir;
            } else {
              var _toSelect15 = _this5.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this5.translate.setDefaultLang(_toSelect15.languagecode);

              _this5.dir = _toSelect15.dir;
            }
          });
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

            var _id6 = document.getElementById('searchrow');

            _id6.style.display = 'flex';
          }
        }
      }, {
        key: "syncPrimaryPaginator",
        value: function syncPrimaryPaginator(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
        }
      }]);

      return RoyaltypaymentComponent;
    }();

    RoyaltypaymentComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('MatTabGroup'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_tabs__WEBPACK_IMPORTED_MODULE_9__["MatTabGroup"])], RoyaltypaymentComponent.prototype, "tabGroup", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_8__["MatPaginator"])], RoyaltypaymentComponent.prototype, "paginator", void 0);
    RoyaltypaymentComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-royaltypayment',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./royaltypayment.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./royaltypayment.component.scss */
      "./src/app/modules/invoicemanagement/royaltypayment/royaltypayment.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_toastr__WEBPACK_IMPORTED_MODULE_5__["ToastrService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]])], RoyaltypaymentComponent);
    /***/
  }
}]);
//# sourceMappingURL=modules-invoicemanagement-invoicemanagement-module-es5.js.map