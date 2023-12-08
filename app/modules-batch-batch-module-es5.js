function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-batch-batch-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchcreationpage/batchcreationpage.component.html":
  /*!************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchcreationpage/batchcreationpage.component.html ***!
    \************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesBatchBatchcreationpageBatchcreationpageComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" fxLayoutAlign=\"center\" id=\"batchcreationlist\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n        <form autocomplete=\"off\" [formGroup]=\"batchform\">\r\n            <div class=\"formcontainer m-t-15\">\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.trainingevlocenter' | translate}} </mat-label>\r\n                            <mat-select formControlName=\"trainingevlocenter\" [errorStateMatcher]=\"matcher\"\r\n                                panelClass=\"myPanelClass\" (closed)=\"searchTrainingCentre = ''\"\r\n                                (selectionChange)=\"selectedTrainingCentre(cour.trainingevlocenter.value);selectedTrCentr = $event.source.triggerValue;\"\r\n                              *ngIf=\"(trainingEvalutionCentrelist | filter: searchTrainingCentre ) as trainingresult\" panelClass=\"select_with_search\">\r\n                                <div class=\"searchinmultiselect\">\r\n                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                        class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}}\"\r\n                                        (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchTrainingCentre\"\r\n                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                    <mat-icon (click)=\"searchTrainingCentre = ''\" class=\"reseticon\" matSuffix\r\n                                        *ngIf=\"searchTrainingCentre !='' && searchTrainingCentre !=null\">clear\r\n                                    </mat-icon>\r\n                                </div>\r\n                                <div class=\"option-listing\">\r\n                                    <mat-option\r\n                                        *ngFor=\"let list of trainingEvalutionCentrelist | filter: searchTrainingCentre\"\r\n                                        [value]=\"list.regpk\">\r\n                                        {{list.compname_en}}\r\n                                    </mat-option>\r\n                                    <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"trainingresult.length == 0\">\r\n                                        No results found\r\n                                    </div>\r\n                                </div>\r\n                            </mat-select>\r\n                            <mat-error\r\n                                *ngIf=\"cour.trainingevlocenter.errors?.required || cour.trainingevlocenter.touched\"\r\n                                class=\"text-danger font-14\">\r\n                                {{'course.trainingevloerror' | translate}}\r\n                            </mat-error>\r\n                        </mat-form-field>\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.offtype' | translate}} </mat-label>\r\n                            <mat-select required formControlName=\"office_type\"\r\n                                (selectionChange)=\"selectOffice(cour.office_type.value)\" required\r\n                                panelClass=\"select_with_search\">\r\n                                <mat-option [value]=\"1\">Main office</mat-option>\r\n                                <mat-option [value]=\"2\">Branch office</mat-option>\r\n                            </mat-select>\r\n                            <mat-error *ngIf=\"cour.office_type.errors?.required || batchform.submitted\">\r\n                                {{'course.selectofftype' | translate}} </mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\"\r\n                    *ngIf=\"cour.office_type.value == 2\">\r\n                    <div fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.branchname' | translate}}</mat-label>\r\n                            <mat-select formControlName=\"bran_ch\" [errorStateMatcher]=\"matcher\"\r\n                                panelClass=\"myPanelClass\" (closed)=\"searchBranch = ''\" required\r\n                                (selectionChange)=\"selectedBranch= $event.source.triggerValue;selectedBranchDtl(cour.bran_ch.value)\"\r\n                                *ngIf=\"(branchlist | filter: searchBranch ) as branchresult\"\r\n                                panelClass=\"select_with_search\">\r\n                                <div class=\"searchinmultiselect\">\r\n                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                        class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}}\"\r\n                                        (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchBranch\"\r\n                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                    <mat-icon (click)=\"searchBranch = ''\" class=\"reseticon\" matSuffix\r\n                                        *ngIf=\"searchBranch !='' && searchBranch !=null\">clear</mat-icon>\r\n                                </div>\r\n                                <div class=\"option-listing\">\r\n                                    <mat-option *ngFor=\"let list of branchlist | filter: searchBranch\"\r\n                                        [value]=\"list.appmainpk\">\r\n                                        {{list.branchname_en}}\r\n                                    </mat-option>\r\n                                    <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"branchresult.length == 0\">\r\n                                        No results found\r\n                                    </div>\r\n                                </div>\r\n                            </mat-select>\r\n                            <mat-error *ngIf=\"cour.bran_ch.errors?.required || batchform.submitted\">\r\n                                {{'course.selectbranchname' | translate}} </mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.courtitl' | translate}}</mat-label>\r\n                            <mat-select formControlName=\"stdcoursedtlsmstpk\" [errorStateMatcher]=\"matcher\"\r\n                                panelClass=\"myPanelClass\" (closed)=\"searchCourse = ''\" required\r\n                                (selectionChange)=\"selectedCourseDtls(cour.stdcoursedtlsmstpk.value);selectedCourse = $event.source.triggerValue;\"\r\n                                *ngIf=\"(courselist | filter: searchCourse ) as courseresult\"\r\n                                panelClass=\"select_with_search\">\r\n                                <div class=\"searchinmultiselect\">\r\n                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                        class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}}\"\r\n                                        (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchCourse\"\r\n                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                    <mat-icon (click)=\"searchCourse = ''\" class=\"reseticon\" matSuffix\r\n                                        *ngIf=\"searchCourse !='' && searchCourse !=null\">clear</mat-icon>\r\n                                </div>\r\n                                <div class=\"option-listing\">\r\n                                    <mat-option *ngFor=\"let list of courselist | filter: searchCourse\"\r\n                                        [value]=\"list.pk\">\r\n                                        {{list.course_en}}\r\n                                    </mat-option>\r\n                                    <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"courseresult.length == 0\">\r\n                                        No results found\r\n                                    </div>\r\n                                </div>\r\n                            </mat-select>\r\n                            <mat-error\r\n                                *ngIf=\"cour.stdcoursedtlsmstpk.errors?.required || cour.stdcoursedtlsmstpk.touched\"\r\n                                class=\"text-danger font-14\">\r\n                                {{'course.entecourengl' | translate}}\r\n                            </mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                        ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.courcate' | translate}}</mat-label>\r\n                            <mat-select formControlName=\"cour_cate\" [errorStateMatcher]=\"matcher\"\r\n                                panelClass=\"myPanelClass\" (closed)=\"searchCate = ''\" disabled\r\n                                (selectionChange)=\"selectedCategory(cour.cour_cate.value);selectedCate= $event.source.triggerValue;\"\r\n                                *ngIf=\"(categorylist | filter: searchCate ) as catcourseresult\"\r\n                                panelClass=\"select_with_search\">\r\n                                <div class=\"searchinmultiselect\">\r\n                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                        class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}}\"\r\n                                        (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchCate\"\r\n                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                    <mat-icon (click)=\"searchCate = ''\" class=\"reseticon\" matSuffix\r\n                                        *ngIf=\"searchCate !='' && searchCate !=null\">clear</mat-icon>\r\n                                </div>\r\n                                <div class=\"option-listing\">\r\n                                    <mat-option *ngFor=\"let list of categorylist | filter: searchCate\"\r\n                                        [value]=\"list.coursecategorymst_pk\">\r\n                                        {{list.ccm_catname_en}}\r\n                                    </mat-option>\r\n                                    <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"catcourseresult.length == 0\">\r\n                                        No results found\r\n                                    </div>\r\n                                </div>\r\n                            </mat-select>\r\n                            <mat-error *ngIf=\"cour.cour_subcate.errors?.required || cour.cour_subcate.touched\"\r\n                                class=\"text-danger font-14\">\r\n                                {{'course.selecourcate' | translate}}\r\n                            </mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.coursubcate' | translate}}</mat-label>\r\n                            <mat-select formControlName=\"cour_subcate\" [errorStateMatcher]=\"matcher\"\r\n                                panelClass=\"myPanelClass\" (closed)=\"searchSubcate = ''\" required\r\n                                (selectionChange)=\"selectedSubCategory = $event.source.triggerValue;selectedSubCat(cour.cour_subcate.value)\"\r\n                                *ngIf=\"(subcategorylist | filter: searchSubcate ) as subcourseresult\"\r\n                                panelClass=\"select_with_search\">\r\n                                <div class=\"searchinmultiselect\">\r\n                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                        class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}}\"\r\n                                        (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchSubcate\"\r\n                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                    <mat-icon (click)=\"searchSubcate = ''\" class=\"reseticon\" matSuffix\r\n                                        *ngIf=\"searchSubcate !='' && searchSubcate !=null\">clear</mat-icon>\r\n                                </div>\r\n                                <div class=\"option-listing\">\r\n                                    <mat-option *ngFor=\"let list of subcategorylist | filter: searchSubcate\"\r\n                                        [value]=\"list.coursecategorymst_pk\">\r\n                                        {{list.ccm_catname_en}}\r\n                                    </mat-option>\r\n                                    <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"subcourseresult.length == 0\">\r\n                                        No results found\r\n                                    </div>\r\n                                </div>\r\n                            </mat-select>\r\n                            <mat-error *ngIf=\"cour.cour_subcate.errors?.required || cour.cour_subcate.touched\"\r\n                                class=\"text-danger font-14\">\r\n                                {{'course.selectthesub' | translate}}\r\n                            </mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                        ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-select required formControlName=\"batchtype\" panelClass=\"select_with_search\">\r\n\r\n                                <mat-option *ngFor=\"let list of batchtypelist\" [value]=\"list.pk\">\r\n                                    {{list.name_en}}\r\n                                </mat-option>\r\n                            </mat-select>\r\n                            <mat-label>{{'course.courbatchtype' | translate}}</mat-label>\r\n                            <mat-error *ngIf=\"cour.batchtype.errors?.required || batchform.submitted\">\r\n                                {{'course.batchtypeerror' | translate}}\r\n                            </mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                </div>\r\n                <div class=\"courebox m-t-15\">\r\n                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 units\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n\r\n                            <mat-form-field appearance=\"outline\">\r\n                                <mat-label>{{'course.courtutorasslang' | translate}} </mat-label>\r\n                                <mat-select required formControlName=\"assmntlanauge\" panelClass=\"select_with_search\">\r\n                                    <mat-option *ngFor=\"let list of tutorlanglist\" [value]=\"list.pk\">\r\n                                        {{list.name_en}}\r\n                                    </mat-option>\r\n                                </mat-select>\r\n                                <mat-error *ngIf=\"cour.assmntlanauge.errors?.required || batchform.submitted\">\r\n                                    {{'course.tutorinassesslanerror' | translate}} </mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"timeduration_contain p-t-40 p-b-20\">\r\n                    <p class=\"trainingdurationtitle m-0\">{{'course.learcapa' | translate}} <mat-icon matSuffix\r\n                            class=\"m-l-15 fs-20\">info_outline</mat-icon>\r\n                    </p>\r\n                </div>\r\n                <div class=\"courebox m-t-15\">\r\n                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 units\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                            <mat-form-field appearance=\"outline\">\r\n                                <mat-label>{{'course.traintheo' | translate}}</mat-label>\r\n                                <input (keydown.enter)=\"$event.preventDefault()\" matInput\r\n                                appNumberonly formControlName=\"theorybatchlimit\" readonly>\r\n\r\n                            </mat-form-field>\r\n                        </div>\r\n                        <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                            ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                            <mat-form-field appearance=\"outline\">\r\n                                <mat-label>{{'course.traintheop' | translate}}</mat-label>\r\n                                <input (keydown.enter)=\"$event.preventDefault()\" matInput\r\n                                appNumberonly formControlName=\"particalbatchlimit\" readonly>\r\n\r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15 units\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.asse' | translate}}</mat-label>\r\n                                <input (keydown.enter)=\"$event.preventDefault()\" matInput\r\n                                appNumberonly formControlName=\"assesmentbatchlimit\" readonly>\r\n\r\n                        </mat-form-field>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"timeduration_contain p-t-40 p-b-20\">\r\n                    <p class=\"trainingdurationtitle m-0\">{{'course.courtrainingdur' | translate}} <mat-icon matSuffix\r\n                            class=\"m-l-15 fs-20\">info_outline</mat-icon></p>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" class=\"dateformfieldrange datepickerrangeform\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"m-t-20 maincontainertable\">\r\n                        <div fxLayout=\"row wrap\" class=\"drpickerhader \">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"datepickerrangeform\">\r\n                                <mat-form-field class=\"filter daterangetime\" appearance=\"outline\">\r\n                                    <mat-label>{{'course.courstartdate' | translate}}</mat-label>\r\n                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                        <input matInput type=\"text\" id=\"login_session\" [formControl]=\"daterange\"\r\n                                            required ngxDaterangepickerMd [showCustomRangeLabel]=\"true\"\r\n                                            [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\" [locale]=\"locale\"\r\n                                            [linkedCalendars]=\"true\" (datesUpdated)=\"dateFltrChange($event)\"\r\n                                            [showClearButton]=\"true\" [showClearButton]=\"true\" readonly\r\n                                            class=\"form-control\" />\r\n                                        <div class=\"closeanddateicomax\">\r\n                                            <mat-datepicker-toggle matSuffix></mat-datepicker-toggle>\r\n                                        </div>\r\n\r\n                                    </div>\r\n\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                <div class=\"total_header\" fxLayoutAlign=\"space-between center\">\r\n                                    <p class=\"fs-18 p-l-20\" >\r\n                                        <span *ngIf=\"batchform.controls['days'].value > 0\">\r\n                                            {{'course.totalcount' |\r\n                                            translate}}:&nbsp;{{batchform.controls['days'].value}}&nbsp;{{'course.dayscount'\r\n                                            | translate}}\r\n                                        </span>\r\n                                        </p>\r\n                                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\" class=\"cancelandpublish\">\r\n                                        <button mat-raised-button class=\"cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                            (click)=\"cleartable()\">\r\n                                            {{'course.courclear' | translate}}\r\n                                        </button>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"pd-20 tabletopconatiner\">\r\n                                <div class=\"paginationwithfilter masterPageTop p-b-10\">\r\n                                    <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\"\r\n                                        [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                        (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                            <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                                (click)=\"scrollTo('pagescroll');opendialogquicksetup()\"\r\n                                                class=\"quicksetup fs-15 m-r-10\">\r\n                                                {{'course.courquicketup' | translate}}\r\n                                            </button>\r\n                                            <button mat-raised-button color=\"primary\"\r\n                                                (click)=\"getTutorAvailabilityList()\"\r\n                                                class=\"ShowHidefs-15 submit_btn m-r-10\">{{'course.coursave' |\r\n                                                translate}}\r\n                                            </button>\r\n                                            <button mat-raised-button type=\"button\" color=\"primary\"\r\n                                                (click)=\"clickEvent();\"\r\n                                                class=\"filter height-45 filterbtn\">{{filtername}}<i\r\n                                                    class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"awaredtable\">\r\n                                    <mat-table #table class=\"scrolldata\" [dataSource]=\"batchtrainingdata\" matSort\r\n                                        matSortDisableClear>\r\n                                        <ng-container matColumnDef=\"selecteddate\">\r\n                                            <mat-header-cell fxFlex=\"260px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'course.courseleteddate' |\r\n                                                translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"Selected Date\" fxFlex=\"260px\"\r\n                                                *matCellDef=\"let BatchData\">\r\n                                                <span>\r\n                                                    {{BatchData.selecteddate}}\r\n                                                </span>\r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"schedule\">\r\n                                            <mat-header-cell fxFlex=\"210px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>{{'course.courdayschdeule' |\r\n                                                translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"210px\"\r\n                                                *matCellDef=\"let BatchData\">\r\n                                                <mat-form-field class=\"filter\">\r\n                                                    <mat-label>{{'course.couravailable' | translate}}</mat-label>\r\n                                                    <mat-select formControlName=\"available\"\r\n                                                        (selectionChange)=\"checkData(BatchData.id, this.cour.available.value ,'theory')\">\r\n                                                        <mat-option *ngFor=\"let list of dayschedulelist\"\r\n                                                            [value]=\"list.pk\">\r\n                                                            {{list.name_en}}\r\n                                                        </mat-option>\r\n                                                    </mat-select>\r\n                                                </mat-form-field>\r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"startendtime\">\r\n                                            <mat-header-cell fxFlex=\"700px\" class=\"p-l-15\" mat-header-cell\r\n                                                *matHeaderCellDef mat-sort-header>{{'course.courstarttime' |\r\n                                                translate}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{'course.courendtime'\r\n                                                | translate}}</mat-header-cell>\r\n                                            <mat-cell id=\"{{z}}\" data-label=\"{{'batch.officetype' | translate}}\"\r\n                                                fxFlex=\"700px\" *matCellDef=\"let BatchData;let z = index;\">\r\n                                                <div fxLayoutAlign=\"space-between\" class=\"w-100\">\r\n                                                    <div fxLayoutAlign=\"flex-start\">\r\n                                                        <div fxLayoutAlign=\"flex-start center\"\r\n                                                            class=\"slottag borderslot p-l-20\">\r\n                                                            <form *ngIf=\"BatchData.subarr.length > 0\" class=\"usrfrm\"\r\n                                                                [formGroup]=\"userForm\">\r\n                                                                <div\r\n                                                                    *ngFor=\"let phone of BatchData.subarr; let i = index\">\r\n                                                                    <mat-form-field class=\"w-150 m-l-15\">\r\n                                                                        <input matTimepicker #t=\"matTimepicker\"\r\n                                                                            [minDate]=\"minValue\" [maxDate]=\"maxValue\"\r\n                                                                            [strict]=\"false\"\r\n                                                                            formControlName=\"sstartdata\"\r\n                                                                            id=\"form{{z}}{{i}}\"\r\n                                                                            [required]=\"BatchData.schedule == availablepk\"\r\n                                                                            required>\r\n                                                                        <mat-icon matSuffix (click)=\"t.showDialog()\">\r\n                                                                            access_time</mat-icon>\r\n                                                                    </mat-form-field>\r\n                                                                    <mat-form-field class=\"w-150 m-l-15\">\r\n                                                                        <input matTimepicker #et=\"matTimepicker\"\r\n                                                                            [minDate]=\"minValue\"\r\n                                                                            [required]=\"BatchData.schedule == availablepk\"\r\n                                                                            [maxDate]=\"maxValue\" [strict]=\"false\"\r\n                                                                            formControlName=\"senddata\" id=\"to{{z}}{{i}}\"\r\n                                                                            (timeChange)=\"calculateTimeDifference(z,i,BatchData.id)\"\r\n                                                                            required>\r\n                                                                        <mat-icon matSuffix (click)=\"et.showDialog()\">\r\n                                                                            access_time</mat-icon>\r\n                                                                    </mat-form-field>\r\n                                                                    <span class=\"fs-12 hrstag m-l-15\"><span\r\n                                                                            id=\"difference{{z}}{{i}}\">{{formattedTime}}</span>\r\n                                                                        Hr(s)</span>\r\n                                                                    <!-- <button class=\"m-l-15\" (click)=\"removePhone(i, z)\"><mat-icon>remove</mat-icon></button>   -->\r\n                                                                </div>\r\n                                                            </form>\r\n                                                            <button class=\"m-l-15 m-b-22\" (click)=\"addPhone(z)\"\r\n                                                                *ngIf=\"BatchData.schedule == availablepk\">\r\n                                                                <mat-icon>add</mat-icon>\r\n                                                            </button>\r\n                                                        </div>\r\n                                                    </div>\r\n\r\n                                                </div>\r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-first\">\r\n                                            <mat-header-cell fxFlex=\"260px\" class=\"serachrow datepickerrangeform\"\r\n                                                *matHeaderCellDef style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                                        <input id=\"login_session\" [formControl]=\"date\" #pickers matInput\r\n                                                            type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd\r\n                                                            [showCustomRangeLabel]=\"true\" [alwaysShowCalendars]=\"true\"\r\n                                                            [ranges]=\"ranges\" [locale]=\"locale\" [linkedCalendars]=\"true\"\r\n                                                            [showClearButton]=\"true\" [maxDate]='selected2' readonly\r\n                                                            class=\"form-control\" [max]=\"today\" />\r\n                                                        <div class=\"closeanddateicon\">\r\n                                                            <mat-datepicker-toggle matSuffix>\r\n                                                            </mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                    <div fxLayoutAlign=\"flex-start\">\r\n                                                        <button mat-raised-button class=\"m-r-10 clearbtn ShowHide fs-15\"\r\n                                                            (click)=\"clearRecordData(BatchData.id)\"\r\n                                                            type=\"button\">{{'course.courclear' | translate}}\r\n                                                        </button>\r\n                                                    </div>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n\r\n                                        </ng-container>\r\n                                        \r\n                                        <ng-container matColumnDef=\"row-second\">\r\n                                            <mat-header-cell fxFlex=\"210px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'course.courselect' | translate}}</mat-label>\r\n                                                    <mat-select [formControl]=\"select\" multiple>\r\n                                                        <mat-option value=\"1\">{{'batchview.availa' | translate}}\r\n                                                        </mat-option>\r\n                                                        <mat-option value=\"2\">{{'batchview.notavai' | translate}}\r\n                                                        </mat-option>\r\n                                                        <mat-option value=\"3\">{{'batchview.holi' | translate}}\r\n                                                        </mat-option>\r\n                                                        <mat-option value=\"4\">{{'batchview.week' | translate}}\r\n                                                        </mat-option>\r\n                                                    </mat-select>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-third\">\r\n                                            <mat-header-cell fxFlex=\"700px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <mat-header-row id=\"headerrowcells\"\r\n                                            *matHeaderRowDef=\"BatchtrainingData;sticky: true\">\r\n                                        </mat-header-row>\r\n                                        <mat-header-row id=\"searchrow\"\r\n                                            *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-third']\">\r\n                                        </mat-header-row>\r\n                                        <mat-row mat-row *matRowDef=\"let row; columns: BatchtrainingData;\"></mat-row>\r\n                                        <ng-container matColumnDef=\"disclaimer\">\r\n                                            <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n\r\n                                                <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\"\r\n                                                    fxFlex=\"100\" *ngIf=\"batchtraningdata_data.length <= 0\">\r\n                                                    <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                        <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                        <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}\r\n                                                        </p>\r\n                                                    </div>\r\n                                                </div>\r\n                                            </td>\r\n                                        </ng-container>\r\n                                        <ng-container>\r\n                                            <mat-footer-row [style.display]=\"(resultsLength > 0) ? 'none' : 'block' \"\r\n                                                *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                            </mat-footer-row>\r\n                                        </ng-container>\r\n\r\n                                    </mat-table>\r\n                                </div>\r\n                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                        <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                            class=\"masterPage masterbottom w-100\" showFirstLastButtons\r\n                                            [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                            [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                            [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                        </mat-paginator>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <!--Practical-->\r\n                <div class=\"timeduration_contain p-t-40 p-b-20\">\r\n                    <p class=\"trainingdurationtitle m-0\">{{'course.courtrainingdurpart' | translate}} <mat-icon\r\n                            matSuffix class=\"m-l-15 fs-20\">info_outline</mat-icon>\r\n                    </p>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" class=\"dateformfieldrange\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"m-t-20 maincontainertable\">\r\n                        <div fxLayout=\"row wrap\" class=\"drpickerhader datepickerrangeform\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                <mat-form-field class=\"filter daterangetime\" appearance=\"outline\">\r\n                                    <mat-label>{{'course.courstartdate' | translate}}</mat-label>\r\n                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                        <input matInput type=\"text\" id=\"login_session\"\r\n                                            [formControl]=\"daterangepractical\" ngxDaterangepickerMd\r\n                                            [showCustomRangeLabel]=\"true\" [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"\r\n                                            [locale]=\"locale\" [linkedCalendars]=\"true\"\r\n                                            (datesUpdated)=\"dateFltrChangepractical($event)\" [showClearButton]=\"true\"\r\n                                            [showClearButton]=\"true\" readonly class=\"form-control\" />\r\n                                        <div class=\"closeanddateicomax\">\r\n                                            <mat-datepicker-toggle matSuffix></mat-datepicker-toggle>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <!-- <mat-error\r\n                                        *ngIf=\"batchform.controls['daterange'].touched || batchform.submitted\">\r\n                                        {{'course.startdateerror' | translate}} </mat-error> -->\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                <div class=\"total_header\" fxLayoutAlign=\"space-between center\">\r\n                                    <p class=\"fs-18 p-l-20\" >\r\n                                        <span *ngIf=\"batchform.controls['dayspract'].value > 0\">\r\n                                            {{'course.totalcount' |\r\n                                            translate}}:&nbsp;{{batchform.controls['dayspract'].value}}&nbsp;{{'course.dayscount'\r\n                                            | translate}}\r\n                                        </span>\r\n                                        </p>\r\n                                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\" class=\"cancelandpublish\">\r\n                                        <button mat-raised-button class=\"cancelbtn ShowHidefs-15\" type=\"button\"\r\n                                            (click)=\"cleartablepractical()\">\r\n                                            {{'course.courclear' | translate}}\r\n                                        </button>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"pd-20 tabletopconatiner\">\r\n                                <div class=\"paginationwithfilter masterPageTop p-b-10\">\r\n                                    <mat-paginator class=\"masterPage masterPageTop\" #paginator\r\n                                        [length]=\"resultsLengthtwo\" [pageSize]=\"10\" [pageSizeOptions]=\"[5, 10, 25, 100]\"\r\n                                        (page)=\"syncPrimaryPaginator($event);\">\r\n                                    </mat-paginator>\r\n                                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                                            <button mat-raised-button color=\"primary\" type=\"button\"\r\n                                                (click)=\"scrollTo('pagescroll');opendialogquicksetup()\"\r\n                                                class=\"quicksetup fs-15 m-r-10\">\r\n                                                {{'course.courquicketup' | translate}}\r\n                                            </button>\r\n                                            <button mat-raised-button color=\"primary\" type=\"submit\"\r\n                                                class=\"ShowHidefs-15 submit_btn m-r-10\">{{'course.coursave' |\r\n                                                translate}}\r\n                                            </button>\r\n                                            <button mat-raised-button type=\"button\" color=\"primary\"\r\n                                                (click)=\"clickEvent();\"\r\n                                                class=\"filter height-45 filterbtn\">{{filtername}}<i\r\n                                                    class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"awaredtable\">\r\n                                    <mat-table #tablepract class=\"scrolldata\" [dataSource]=\"batchtrainingdatapract\"\r\n                                        matSort matSortDisableClear>\r\n                                        <ng-container matColumnDef=\"selecteddate\">\r\n                                            <mat-header-cell fxFlex=\"260px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>\r\n                                                {{'course.courseleteddate' |\r\n                                                translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"Selected Date\" fxFlex=\"260px\"\r\n                                                *matCellDef=\"let BatchDatapract\">\r\n                                                <span>\r\n                                                    {{BatchDatapract.selecteddate}}\r\n                                                </span>\r\n                                            </mat-cell>\r\n\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"schedule\">\r\n                                            <mat-header-cell fxFlex=\"210px\" mat-header-cell *matHeaderCellDef\r\n                                                mat-sort-header>\r\n                                                {{'course.courdayschdeule' |\r\n                                                translate}}</mat-header-cell>\r\n                                            <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"210px\"\r\n                                                *matCellDef=\"let BatchDatapract\">\r\n                                                <mat-form-field class=\"filter\">\r\n                                                    <mat-label>{{'course.couravailable' | translate}}</mat-label>\r\n                                                    <mat-select formControlName=\"availabledates\"\r\n                                                        (selectionChange)=\"checkData(BatchDatapract.id, this.cour.availabledates.value,'pract')\">\r\n                                                        <mat-option *ngFor=\"let list of dayschedulelist\"\r\n                                                            [value]=\"list.pk\">\r\n                                                            {{list.name_en}}\r\n                                                        </mat-option>\r\n                                                    </mat-select>\r\n                                                </mat-form-field>\r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"startendtime\">\r\n                                            <mat-header-cell fxFlex=\"700px\" class=\"p-l-15\" mat-header-cell\r\n                                                *matHeaderCellDef mat-sort-header>{{'course.courstarttime' |\r\n                                                translate}}</mat-header-cell>\r\n                                            <mat-cell id=\"{{p}}\" data-label=\"{{'batch.officetype' | translate}}\"\r\n                                                fxFlex=\"700px\" *matCellDef=\"let BatchDatapract;let p = index;\">\r\n\r\n                                                <div fxLayoutAlign=\"space-between\" class=\"w-100\">\r\n                                                    <div fxLayoutAlign=\"flex-start\">\r\n                                                        <div fxLayoutAlign=\"flex-start center\"\r\n                                                            class=\"slottag borderslot p-l-20\">\r\n                                                            <form *ngIf=\"BatchDatapract.subarrpract.length > 0\"\r\n                                                                class=\"usrfrm\" [formGroup]=\"userpractForm\">\r\n                                                                <div\r\n                                                                    *ngFor=\"let pract of BatchDatapract.subarrpract; let i = index\">\r\n                                                                    <mat-form-field class=\"w-150 m-l-15\">\r\n                                                                        <input matTimepicker #p=\"matTimepicker\"\r\n                                                                            [minDate]=\"minValue\" [maxDate]=\"maxValue\"\r\n                                                                            [strict]=\"false\"\r\n                                                                            formControlName=\"sstarttimepract\"\r\n                                                                            id=\"form{{p}}{{i}}\" required>\r\n                                                                        <mat-icon matSuffix (click)=\"p.showDialog()\">\r\n                                                                            access_time\r\n                                                                        </mat-icon>\r\n                                                                    </mat-form-field>\r\n                                                                    <mat-form-field class=\"w-150 m-l-15\">\r\n                                                                        <input matTimepicker #ep=\"matTimepicker\"\r\n                                                                            [minDate]=\"minValue\" [maxDate]=\"maxValue\"\r\n                                                                            [strict]=\"false\"\r\n                                                                            formControlName=\"sendtimepract\"\r\n                                                                            id=\"to{{p}}{{i}}\"\r\n                                                                            (timeChange)=\"calculateTimeDifferencepract(p,i,BatchDatapract.id)\"\r\n                                                                            required>\r\n                                                                        <mat-icon matSuffix (click)=\"ep.showDialog()\">\r\n                                                                            access_time\r\n                                                                        </mat-icon>\r\n                                                                    </mat-form-field>\r\n                                                                    <span class=\"fs-12 hrstag m-l-15\"><span\r\n                                                                            id=\"difference{{p}}{{i}}\">{{formattedTimed}}</span>\r\n                                                                        Hr(s)</span>\r\n                                                                    <!-- <button class=\"m-l-15\" (click)=\"removePract(i, p)\"><mat-icon>remove</mat-icon></button>   -->\r\n                                                                </div>\r\n                                                            </form>\r\n                                                            <button class=\"m-l-15 m-b-22\" (click)=\"addPract(p)\"\r\n                                                                *ngIf=\"BatchDatapract.schedule == availablepk\">\r\n                                                                <mat-icon>add</mat-icon>\r\n                                                            </button>\r\n\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </div>\r\n\r\n                                            </mat-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-first\">\r\n                                            <mat-header-cell fxFlex=\"260px\" class=\"serachrow datepickerrangeform\"\r\n                                                *matHeaderCellDef style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <div class=\"drpicker\" id=\"regapp\">\r\n                                                        <input id=\"login_session\" [formControl]=\"dateexpiry\" #pickers\r\n                                                            matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd\r\n                                                            [showCustomRangeLabel]=\"true\" [alwaysShowCalendars]=\"true\"\r\n                                                            [ranges]=\"ranges\" [locale]=\"locale\" [linkedCalendars]=\"true\"\r\n                                                            [showClearButton]=\"true\" [maxDate]='selected2' readonly\r\n                                                            class=\"form-control\" [max]=\"today\" />\r\n                                                        <div class=\"closeanddateicon\">\r\n                                                            <mat-datepicker-toggle matSuffix>\r\n                                                            </mat-datepicker-toggle>\r\n                                                        </div>\r\n                                                    </div>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-second\">\r\n                                            <mat-header-cell fxFlex=\"210px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n                                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                                    <mat-label>{{'course.courselect' | translate}}</mat-label>\r\n                                                    <mat-select [formControl]=\"select\" multiple>\r\n                                                        <mat-option value=\"1\">{{'batchview.availa' | translate}}\r\n                                                        </mat-option>\r\n                                                        <mat-option value=\"2\">{{'batchview.notavai' | translate}}\r\n                                                        </mat-option>\r\n                                                        <mat-option value=\"3\">{{'batchview.holi' | translate}}\r\n                                                        </mat-option>\r\n                                                        <mat-option value=\"4\">{{'batchview.week' | translate}}\r\n                                                        </mat-option>\r\n                                                    </mat-select>\r\n                                                </mat-form-field>\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <ng-container matColumnDef=\"row-third\">\r\n                                            <mat-header-cell fxFlex=\"700px\" class=\"serachrow\" *matHeaderCellDef\r\n                                                style=\"text-align:center\">\r\n\r\n                                            </mat-header-cell>\r\n                                        </ng-container>\r\n                                        <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"BatchtrainingData\">\r\n                                        </mat-header-row>\r\n                                        <mat-header-row id=\"searchrow\"\r\n                                            *matHeaderRowDef=\"['row-first' , 'row-second' , 'row-third']\">\r\n                                        </mat-header-row>\r\n                                        <mat-row mat-row *matRowDef=\"let row; columns: BatchtrainingData;\"></mat-row>\r\n                                        <ng-container matColumnDef=\"disclaimer\">\r\n                                            <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n\r\n                                                <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\"\r\n                                                    fxFlex=\"100\" *ngIf=\"batchtraningdata_data.length <= 0\">\r\n                                                    <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                        <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                        <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}\r\n                                                        </p>\r\n                                                    </div>\r\n                                                </div>\r\n                                            </td>\r\n                                        </ng-container>\r\n                                        <ng-container>\r\n                                            <mat-footer-row [style.display]=\"(resultsLengthtwo > 0) ? 'none' : 'block' \"\r\n                                                *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                            </mat-footer-row>\r\n                                        </ng-container>\r\n                                    </mat-table>\r\n                                </div>\r\n                                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                        <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                            class=\"masterPage masterbottom w-100\" showFirstLastButtons\r\n                                            [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                            [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                            [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                        </mat-paginator>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <!---end-->\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\" class=\"m-t-25 dateformfieldrange\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.courassesdate' | translate}}</mat-label>\r\n                            <input formControlName=\"assessmentdate\" required matInput (click)=\"dateexpiry.open();\"\r\n                                (dateChange)=\"checkassessoravailabilty(cour.assessmentdate.value)\"\r\n                                [matDatepicker]=\"dateexpiry\">\r\n                            <mat-datepicker-toggle matSuffix [for]=\"dateexpiry\"></mat-datepicker-toggle>\r\n                            <mat-datepicker #dateexpiry></mat-datepicker>\r\n                            <mat-error *ngIf=\"cour.assessmentdate.errors?.required || batchform.submitted\">\r\n                                {{'course.courseasseserror' | translate}} </mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                        ngClass.xl=\"p-l-30\" fxFlex=\"100\" class=\"drpickerhader\">\r\n                        <div class=\"drpickerasset timeaddpicker\">\r\n                            <div fxLayoutAlign=\"flex-start\" class=\"pos-relative\">\r\n                                <div class=\"drpickerstartend borderbrfore\">\r\n                                    <mat-label>Start time</mat-label>\r\n                                    <mat-form-field class=\"beforrshow\">\r\n                                        <!-- The timepicker input -->\r\n\r\n                                        <input matTimepicker #t=\"matTimepicker\" [minDate]=\"minValue\"\r\n                                            [maxDate]=\"maxValue\" [strict]=\"false\" formControlName=\"starttimeassessment\"\r\n                                            required>\r\n                                        <mat-icon matSuffix (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                                        <mat-error class=\"m-t-10\"\r\n                                            *ngIf=\"cour.starttimeassessment.errors?.required || batchform.submitted\">\r\n                                            {{'course.starttime' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                                <div class=\"drpickerstartend m-l-40\">\r\n                                    <mat-label>End time</mat-label>\r\n                                    <mat-form-field>\r\n                                        <input matTimepicker #t=\"matTimepicker\"\r\n                                            [minDate]=\"cour.starttimeassessment.value\" [maxDate]=\"maxValue\"\r\n                                            [strict]=\"false\" formControlName=\"endtimeasssessment\" required>\r\n                                        <mat-icon matSuffix (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                                        <mat-error class=\"m-t-10\"\r\n                                            *ngIf=\"cour.endtimeasssessment.errors?.required || batchform.submitted\">\r\n                                            {{'course.endtime' | translate}} </mat-error>\r\n                                    </mat-form-field>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <mat-error\r\n                            *ngIf=\"cour.endtimeasssessment.errors?.minDate && batchform.controls['endtimeasssessment'].touched || batchform.submitted\">\r\n                            Value can't be above something </mat-error>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.courstutortheo' | translate}}</mat-label>\r\n                            <mat-select formControlName=\"tutor\" [errorStateMatcher]=\"matcher\" panelClass=\"myPanelClass\"\r\n                                (closed)=\"searchTutor = ''\" *ngIf=\"(tutorlist | filter: searchTutor ) as tutorresult\"\r\n                                panelClass=\"select_with_search\">\r\n                                <div class=\"searchinmultiselect\">\r\n                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                        class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}}\"\r\n                                        (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchTutor\"\r\n                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                    <mat-icon (click)=\"searchTutor = ''\" class=\"reseticon\" matSuffix\r\n                                        *ngIf=\"searchTutor !='' && searchTutor !=null\">clear</mat-icon>\r\n                                </div>\r\n                                <div class=\"option-listing\">\r\n                                    <mat-option *ngFor=\"let list of tutorlist | filter: searchTutor\" [value]=\"list.pk\">\r\n                                        {{list.staffname_en}} From {{list.companyname_en}} _ {{list.pk}}\r\n                                    </mat-option>\r\n                                    <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"tutorresult.length == 0\">\r\n                                        No results found\r\n                                    </div>\r\n                                </div>\r\n                            </mat-select>\r\n                            <mat-error *ngIf=\"cour.tutor.errors?.required || batchform.submitted\">\r\n                                {{'course.tutorerror' | translate}} </mat-error>\r\n                        </mat-form-field>\r\n\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                        ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                        <mat-form-field appearance=\"outline\">\r\n                            <mat-label>{{'course.courstutorpract' | translate}}</mat-label>\r\n                            <mat-select formControlName=\"tutorone\" [errorStateMatcher]=\"matcher\" multiple\r\n                                panelClass=\"myPanelClass\" (closed)=\"searchTutor = ''\"\r\n                                *ngIf=\"(tutorlist | filter: searchTutor ) as tutorresult\"\r\n                                panelClass=\"select_with_search\">\r\n                                <div class=\"searchinmultiselect\">\r\n                                    <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                        class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}}\"\r\n                                        (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchTutor\"\r\n                                        [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                    <mat-icon (click)=\"searchTutor = ''\" class=\"reseticon\" matSuffix\r\n                                        *ngIf=\"searchTutor !='' && searchTutor !=null\">clear</mat-icon>\r\n                                </div>\r\n                                <div class=\"option-listing\">\r\n                                    <mat-option *ngFor=\"let list of tutorlist | filter: searchTutor\"\r\n                                        [disabled]=\"this.cour.tutorone.value.length >= tutorcount || tutorcount <=0\"\r\n                                        [value]=\"list.pk\">\r\n                                        {{list.staffname_en}} From {{list.companyname_en}} _ {{list.pk}}\r\n                                    </mat-option>\r\n                                    <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"tutorresult.length == 0\">\r\n                                        No results found\r\n                                    </div>\r\n                                </div>\r\n                            </mat-select>\r\n                            <mat-error *ngIf=\"cour.tutorone.errors?.required || batchform.submitted\">\r\n                                {{'course.tutorerrortheo' | translate}} </mat-error>\r\n                        </mat-form-field>\r\n                        <mat-hint *ngIf=\"tutorcount > 1\">Note: Number of Tutor/Trainer Required {{tutorcount}}\r\n                        </mat-hint>\r\n\r\n                    </div>\r\n                </div>\r\n\r\n\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-15\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <div formArrayName=\"assessorarr\"\r\n                            *ngFor=\"let a of batchform.get('assessorarr').controls; let i = index\">\r\n                            <div [formGroupName]=\"i\" style=\"margin-bottom: 10px;\">\r\n\r\n                                <mat-form-field appearance=\"outline\">\r\n                                    <mat-label>{{'course.coursassesso' | translate}} <span\r\n                                            *ngIf=\"assessorcount >= 2\">{{i+1}}</span>\r\n                                    </mat-label>\r\n                                    <mat-select formControlName=\"assessor\" [errorStateMatcher]=\"matcher\"\r\n                                        panelClass=\"myPanelClass\" (closed)=\"searchAssessor = ''\"\r\n                                        (selectionChange)=\"selectedAssessor = $event.source.triggerValue;selectIVQAStaff($event.value,i)\"\r\n                                        *ngIf=\"(accessorslist | filter: searchAssessor ) as assessorresult\"\r\n                                        panelClass=\"select_with_search\">\r\n                                        <div class=\"searchinmultiselect\">\r\n                                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                                class=\"searchselect\" type=\"Search\"\r\n                                                placeholder=\"{{'course.sear' | translate}}\"\r\n                                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchAssessor\"\r\n                                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"searchAssessor = ''\" class=\"reseticon\" matSuffix\r\n                                                *ngIf=\"searchAssessor !='' && searchAssessor !=null\">clear</mat-icon>\r\n                                        </div>\r\n                                        <div class=\"option-listing\">\r\n                                            <mat-option *ngFor=\"let list of accessorslist | filter: searchAssessor\"\r\n                                                [value]=\"list.pk\">\r\n                                                {{list.staffname_en}} _ {{list.pk}}\r\n                                            </mat-option>\r\n                                            <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"assessorresult.length == 0\">\r\n                                                No results found\r\n                                            </div>\r\n                                        </div>\r\n                                    </mat-select>\r\n                                    <mat-error *ngIf=\"cour.assessor.errors?.required || batchform.submitted\">\r\n                                        {{'course.coursassessoerror' | translate}} </mat-error>\r\n                                </mat-form-field>\r\n                                <br><br>\r\n\r\n                                <mat-form-field appearance=\"outline\">\r\n                                    <mat-select formControlName=\"IVQAStaff\" [errorStateMatcher]=\"matcher\"\r\n                                        panelClass=\"select_with_search\" (closed)=\"searchIVQAStaff = ''\"\r\n                                        (selectionChange)=\"selectedAssessor = $event.source.triggerValue;\"\r\n                                        *ngIf=\"(ivqastafflist | filter: searchIVQAStaff ) as ivqastafflist\"\r\n                                        panelClass=\"select_with_search\">\r\n                                        <div class=\"searchinmultiselect\">\r\n                                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                                class=\"searchselect\" type=\"Search\"\r\n                                                placeholder=\"{{'course.sear' | translate}}\"\r\n                                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchIVQAStaff\"\r\n                                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"searchIVQAStaff = ''\" class=\"reseticon\" matSuffix\r\n                                                *ngIf=\"searchIVQAStaff !='' && searchIVQAStaff !=null\">clear</mat-icon>\r\n                                        </div>\r\n                                        <div class=\"option-listing\">\r\n                                            <mat-option *ngFor=\"let list of ivqastafflist | filter: searchIVQAStaff\"\r\n                                                [value]=\"list.pk\">\r\n                                                {{list.staffname_en}} _ {{list.pk}}\r\n                                            </mat-option>\r\n                                            <div class=\"p-t-10 p-l-16 p-b-5\" *ngIf=\"ivqastafflist.length == 0\">\r\n                                                No results found\r\n                                            </div>\r\n                                        </div>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-30\">\r\n                        <button mat-raised-button class=\"m-r-10 cancelbtn ShowHidefs-15\" (click)=\"backdata()\"\r\n                            type=\"button\">{{'course.canc' | translate}}\r\n                        </button>\r\n                        <button mat-raised-button color=\"primary\" type=\"submit\" [disable]=\"disableSubmitButton\"\r\n                            class=\"ShowHidefs-15 submit_btn m-l-10\" (click)=\"batchAdd()\">{{'course.submit' | translate}}\r\n                        </button>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </form>\r\n    </div>\r\n</div>\r\n<app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchcreationpage/modalquicksetup.html":
  /*!************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchcreationpage/modalquicksetup.html ***!
    \************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesBatchBatchcreationpageModalquicksetupHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div [formGroup]=\"batchform\" id=\"traininglistpopup\">\r\n    <div class=\"trainingdurationhead\" fxLayoutAlign=\"space-between center\">\r\n        <h2 class=\"m-0 fs-16\">{{'course.trainingdurset' | translate}}</h2>\r\n        <mat-icon (click)=\"closedialog()\" class=\"cursor-pointer\">close</mat-icon>\r\n    </div>\r\n    <div class=\"pd-25\">\r\n        <div fxLayout=\"row wrap\" class=\"coursesubtitle\" fxLayoutAlign=\"flex-start center\">\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                <p class=\"fs-14 m-0\">{{'course.coursetitle' | translate}}</p>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <span class=\"fs-14 complantag\">Computer Programming Languages</span>\r\n            </div>  \r\n         \r\n        </div>\r\n        <div fxLayout=\"row wrap\">\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                 &nbsp;\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\" class=\"p-t-35\" fxLayoutAlign=\"flex-start\">\r\n                <div class=\"totalleanerheader mindaterangewidth\">\r\n                    <p class=\"fs-14 m-0\">{{'course.daterange' | translate}}</p>\r\n                    <span class=\"fs-16\">1-1-2023 to 1-3-2023</span>\r\n                </div>\r\n                <div class=\"totalleanerheader\">\r\n                    <p class=\"fs-14 m-0\">{{'course.totaldays' | translate}}</p>\r\n                    <span class=\"fs-16\">90</span>\r\n                </div>\r\n            </div>  \r\n         \r\n        </div>\r\n        <div fxLayout=\"row wrap\" >\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                 &nbsp;\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <div class=\"conftiming\">\r\n                    <h4 class=\"fs-14\">{{'course.configtiming' | translate}}</h4>\r\n               </div>\r\n            </div>  \r\n        </div>\r\n       \r\n        <div fxLayout=\"row wrap\" >\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n               \r\n                <div fxLayout=\"row wrap\" class=\"coursesubtitle p-b-20\" fxLayoutAlign=\"flex-start center\">\r\n                    <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                        <p class=\"fs-14 m-0\">{{'course.from' | translate}}</p>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                        <div fxLayoutAlign=\"flex-start\">\r\n                            <div class=\"timepickerwidth\">\r\n                                <mat-form-field >\r\n                                    <!-- The timepicker input -->\r\n                                    <input matTimepicker #t=\"matTimepicker\" [minDate]=\"minValue\"\r\n                                        [maxDate]=\"maxValue\" [strict]=\"false\"\r\n                                        formControlName=\"starttime\"\r\n                                        required>\r\n                                    <mat-icon matSuffix\r\n                                        (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                                     \r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxLayoutAlign=\"flex-start center\" class=\"slottag p-l-15\">\r\n                                <mat-icon>add</mat-icon>\r\n                                <span class=\"fs-14 p-l-8\">{{'course.addslot' | translate}}</span>\r\n                            </div>\r\n                        </div>\r\n                        <mat-error *ngIf=\"cour.starttime.errors?.required || batchform.submitted\">\r\n                            {{'course.starttime' | translate}} </mat-error>\r\n                    </div>  \r\n                </div>\r\n                \r\n            </div>\r\n         \r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"coursesubtitle p-b-30\" fxLayoutAlign=\"flex-start center\">\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\">\r\n                <p class=\"fs-14 m-0\">{{'course.to' | translate}}</p>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <div class=\"timepickerwidth\"> \r\n                    <mat-form-field >\r\n                        <!-- The timepicker input -->\r\n                        <input matTimepicker #t=\"matTimepicker\" [minDate]=\"minValue\"\r\n                            [maxDate]=\"maxValue\" [strict]=\"false\"\r\n                            formControlName=\"endtime\"\r\n                            required>\r\n                        <mat-icon matSuffix\r\n                            (click)=\"t.showDialog()\">access_time</mat-icon>\r\n                          \r\n                    </mat-form-field>\r\n                </div>\r\n                <mat-error *ngIf=\"cour.endtime.errors?.required || batchform.submitted\">\r\n                    {{'course.endtime' | translate}} </mat-error>\r\n            </div>  \r\n        </div>\r\n        <div fxLayout=\"row wrap\" >\r\n            <div fxFlex.gt-sm=\"13\" fxFlex=\"100\" class=\"coursesubtitle\">\r\n                <p class=\"fs-14 m-0\">{{'course.setweekedned' | translate}}</p>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"87\" fxFlex=\"100\">\r\n                <mat-table class=\"summarytablelist\" #table [dataSource]=\"quicksetupdatalist\" \r\n                matSortDisableClear>\r\n                <ng-container matColumnDef=\"days\">\r\n                    <mat-header-cell rowspan=\"2\" fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                       ></mat-header-cell>\r\n                    <mat-cell rowspan=\"2\"  data-label=\"Selected Date\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                      <div class=\"daytopalign\">\r\n                            <h4 class=\"m-0 fs-14\">{{'course.days' | translate}}</h4>\r\n                      </div> \r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"sunday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                     >{{'course.sunday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"monday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.monday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"tuesday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                       >{{'course.tuesday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"wednesday\">\r\n                    <mat-header-cell fxFlex=\"95px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.wednesday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"95px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"thursday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                       >{{'course.thursday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"friday\">\r\n                    <mat-header-cell fxFlex=\"80px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.friday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"80px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <ng-container matColumnDef=\"saturday\">\r\n                    <mat-header-cell fxFlex=\"115px\" mat-header-cell *matHeaderCellDef\r\n                        >{{'course.saturday' | translate}}</mat-header-cell>\r\n                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"115px\"\r\n                        *matCellDef=\"let quickdata\">\r\n                        <mat-checkbox > \r\n                         \r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <mat-header-row *matHeaderRowDef=\"quicksetupcolumn\"></mat-header-row>\r\n                <mat-row *matRowDef=\"let row; columns: quicksetupcolumn;\"></mat-row>\r\n            </mat-table>\r\n            </div>  \r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\" class=\"cancelandpublish m-t-40\">\r\n            <button mat-raised-button class=\"m-r-10 clearbtn ShowHide fs-15\" type=\"button\">{{'course.courclear' | translate}}\r\n            </button>\r\n            <button mat-raised-button  type=\"submit\"\r\n                class=\"ShowHidefs-15 savebtn m-l-10\">{{'course.coursave' | translate}}\r\n            </button>\r\n        </div>\r\n    </div>\r\n   \r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchgridlisting/batchgridlisting.component.html":
  /*!**********************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchgridlisting/batchgridlisting.component.html ***!
    \**********************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesBatchBatchgridlistingBatchgridlistingComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div *ngIf=\"creationpageshow\" #pageScroll>\r\n    <div id=\"batchcontainer\" fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n        <div fxFlex=\"100\" class=\"branches p-t-20\">\r\n            <div class=\"paginationwithfilter masterPageTop \">\r\n                <!-- [style.visibility]=\"(resultsLength > 5) ? 'visible' : 'hidden' \" -->\r\n                <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                    [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <button mat-raised-button color=\"primary\" type=\"button\"\r\n                            (click)=\"creationpageshowdata();scrollTo('pagescroll')\"\r\n                            class=\"ShowHidefs-15 submit_btn m-r-10\">{{'international.add' | translate}}\r\n                        </button>\r\n                        <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                            class=\"filter\">{{filtername}}<i class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row wrap\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                    <div class=\"awaredtable\">\r\n                        <mat-table #table class=\"scrolldata\" [dataSource]=\"batchdata\" matSort matSortDisableClear>\r\n                            <ng-container matColumnDef=\"checkbox\">\r\n                                <mat-header-cell fxFlex=\"65px\" mat-header-cell *matHeaderCellDef><mat-checkbox\r\n                                        class=\"example-margin\"></mat-checkbox>\r\n                                </mat-header-cell>\r\n                                <mat-cell data-label=\"checkbox\" fxFlex=\"65px\" *matCellDef=\"let BatchData\">\r\n                                    <mat-checkbox class=\"example-margin\"></mat-checkbox>\r\n                                </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"batchno\">\r\n                                <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'batch.batchno' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.batchno' | translate}}\" fxFlex=\"150px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.batch_no}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"batchtype\">\r\n                                <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'batch.batchtype' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"150px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.batch_type}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"officetype\">\r\n                                <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'batch.officetype' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"160px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.office_type}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"branchname\">\r\n                                <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'batch.branchname' |\r\n                                    translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.branchname' |\r\n                                translate}}\" fxFlex=\"180px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.branch_name ? BatchData.branch_name : '-'}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"asssessmentcenter\">\r\n                                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.assessmentcenter' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.assessmentcenter' | translate}}\" fxFlex=\"250px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.assessment_centre_en ? BatchData.assessment_centre_en : \"-\"}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"totalleaners\">\r\n                                <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                    mat-sort-header>{{'batch.totalleaners' | translate}}\r\n                                </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.totalleaners' | translate}}\" fxFlex=\"180px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.totallearners}} / {{BatchData.theorybatchcount}}</mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"remainingcapacity\">\r\n                                <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.remainingcapacity' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.remainingcapacity' | translate}}\" fxFlex=\"180px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.theorybatchcount - BatchData.totallearners}} / {{BatchData.theorybatchcount}}</mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"trainingdurationth\">\r\n                                <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.trainingduration' | translate}}(theory) </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.trainingdurationth' | translate}} \" fxFlex=\"263px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.traintheorystart}} - {{BatchData.traintheoryend}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"trainingdurationpr\">\r\n                                <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.trainingduration' | translate}} (practical)</mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.trainingdurationpr' | translate}} \" fxFlex=\"263px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.trainpractstart}} - {{BatchData.trainpractend}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"assessmentdatetime\">\r\n                                <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.assessmentdatetime' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.assessmentdatetime' | translate}} \" fxFlex=\"263px\" *matCellDef=\"let BatchData\">\r\n                                    <span *ngIf=\"BatchData.assessmentdate && BatchData.assessmentstart && BatchData.assessmentend\">\r\n {{BatchData.assessmentdate}}   ({{BatchData.assessmentstart}} - {{BatchData.assessmentend}})\r\n                                    </span>\r\n                                    <span  *ngIf=\"!(BatchData.assessmentdate && BatchData.assessmentstart && BatchData.assessmentend)\">\r\n                                       -\r\n                                    </span>\r\n                                    </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"assessmentwilayat\">\r\n                                <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.assessmentwilayats' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.assessmentwilayats' | translate}}\" fxFlex=\"180px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.wilayat}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"categories\">\r\n                                <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.categories' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.categories' | translate}}\" fxFlex=\"160px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.category_en}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"language\">\r\n                                <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.language' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.language' | translate}}\" fxFlex=\"160px\" *matCellDef=\"let BatchData\">\r\n                                    {{BatchData.language}} </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"status\">\r\n                                <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                                    {{'batch.status' | translate}} </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.status' | translate}}\" fxFlex=\"150px\"\r\n                                    *matCellDef=\"let BatchData\">\r\n                                    <span class=\"green\" *ngIf=\"BatchData.status == '8'\">Print</span>\r\n                                    <span class=\"red\" *ngIf=\"BatchData.status == '1'\">New</span>\r\n                                    <span class=\"liteorange\" *ngIf=\"BatchData.status == '2'\">Teaching (Theory)</span>\r\n                                    <span class=\"liteorange\" *ngIf=\"BatchData.status == '3'\">Teaching (Practical)</span>\r\n                                    <span class=\"blue\" *ngIf=\"BatchData.status == '6'\">Quality Check</span>\r\n                                    <span class=\"green\" *ngIf=\"BatchData.status == '4'\">Assessment</span>\r\n                                    <span class=\"litered\" *ngIf=\"BatchData.status == '7'\"> Cancelled </span>\r\n                                </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"action\" stickyEnd>\r\n                                <mat-header-cell fxFlex=\"100px\" mat-header-cell *matHeaderCellDef>{{'batch.action'\r\n                                    | translate}}\r\n                                </mat-header-cell>\r\n                                <mat-cell data-label=\"{{'batch.action'\r\n                                | translate}}\" fxFlex=\"100px\" *matCellDef=\"let BatchData\">\r\n                                    <div class=\"manageoptions\">\r\n                                        <button class=\"menubutton\" mat-icon-button [matMenuTriggerFor]=\"actionmenu\"\r\n                                            aria-label=\"Example icon-button with a menu\">\r\n                                            <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                                        </button>\r\n                                        <mat-menu #actionmenu=\"matMenu\" class=\"master-menu whentootltipadded\">\r\n                                            <button type=\"button\" *ngIf=\"BatchData.status != 1\" (click)=\"ViewBatch(BatchData)\" mat-menu-item><span>View </span></button>\r\n                                            <button type=\"button\" *ngIf=\"BatchData.status == 1\"(click)=\"editData(BatchData)\" mat-menu-item><span>{{'table.edit' |\r\n                                                    translate}} </span></button>\r\n                                            <button type=\"button\" *ngIf=\"BatchData.status == 1\" (click)=\"CancelBatch(BatchData)\" mat-menu-item><span>{{'table.cancel' |\r\n                                                    translate}}</span></button>\r\n                                            <button type=\"button\"  *ngIf=\"BatchData.status == 1\" (click)=\"RegisterLearner(BatchData)\" mat-menu-item><span>{{'table.registerlearner' |\r\n                                                    translate}}</span></button>\r\n                                        <button type=\"button\"   (click)=\"ViewLearners(BatchData)\" mat-menu-item><span>{{'table.viewlearner' |\r\n                                                    translate}}</span></button>\r\n                                            <button type=\"button\" (click)=\"ChangeAssessor(BatchData)\"   mat-menu-item><span>{{'table.changeassessor' |\r\n                                                    translate}}</span></button>\r\n                                            <button type=\"button\" mat-menu-item  (click)=\"downloadAttenance(BatchData)\"><span>{{'table.downloadattendancereport' | translate}}</span></button>\r\n                                            <button type=\"button\" mat-menu-item *ngIf=\"BatchData.req_status == 2 && (BatchData.status != 4 && BatchData.status != 6)\" ><span>{{'table.assessorchangerequest'\r\n                                                    |\r\n                                                    translate}}</span></button>\r\n                                            <button type=\"button\" mat-menu-item *ngIf=\"BatchData.status != 1 && BatchData.req_status != 1\" (click)=\"requesttrack()\"><span>{{'table.requestforbacktrack'\r\n                                                    |\r\n                                                    translate}}</span></button>\r\n                                            <!-- <button type=\"button\" mat-menu-item><span>{{'table.auditlog'\r\n                                                    |\r\n                                                    translate}}</span></button> -->\r\n                                                    <button type=\"button\" mat-menu-item (click)=\"updatestatus()\"><span>{{'batch.updatestatus'\r\n                                                        |\r\n                                                        translate}}</span></button> \r\n                                        </mat-menu>\r\n                                    </div>\r\n                                </mat-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-first\">\r\n                                <mat-header-cell fxFlex=\"65px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-second\">\r\n                                <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"batchno\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-three\">\r\n                                <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"batchtype\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-four\">\r\n                                <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'batchview.sele' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"officetype\" multiple>\r\n                                            <mat-option value=\"1\">{{'table.main' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'table.branch' |translate}}</mat-option>\r\n                                            <!-- <mat-option value=\"3\">{{'table.new' |translate}}</mat-option>\r\n                                            <mat-option value=\"4\">{{'table.decl' |translate}}</mat-option> -->\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-five\">\r\n                                <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'batchview.sele' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"branchname\" multiple>\r\n                                            <mat-option value=\"1\">{{'table.approv' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'table.updated' |translate}}</mat-option>\r\n                                            <mat-option value=\"3\">{{'table.new' |translate}}</mat-option>\r\n                                            <mat-option value=\"4\">{{'table.decl' |translate}}</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-six\">\r\n                                <mat-header-cell fxFlex=\"250px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"asssessmentcenter\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n\r\n                            <ng-container matColumnDef=\"row-seven\">\r\n                                <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"totallearning\">\r\n                                     \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-eight\">\r\n                                <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"remainingcapacity\">\r\n                                      \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-nine\">\r\n                                <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <div class=\"drpicker\" id=\"regapp\">\r\n                                            <input id=\"login_session\" [formControl]=\"trainingduration\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" />\r\n                                            <div class=\"closeanddateicon\">\r\n                                                <mat-datepicker-toggle matSuffix >\r\n                                                </mat-datepicker-toggle>\r\n                                            </div>\r\n                                        </div>\r\n                                      \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-ten\">\r\n                                <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <div class=\"drpicker\" id=\"regapp\">\r\n                                            <input id=\"login_session\" [formControl]=\"coursepartical\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" />\r\n                                            <div class=\"closeanddateicon\">\r\n                                                <mat-datepicker-toggle matSuffix >\r\n                                                </mat-datepicker-toggle>\r\n                                            </div>\r\n                                        </div>\r\n                                      \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-eleven\">\r\n                                <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <div class=\"drpicker\" id=\"regapp\">\r\n                                            <input id=\"login_session\" [formControl]=\"assessmentdatetime\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" />\r\n                                            <div class=\"closeanddateicon\">\r\n                                                <mat-datepicker-toggle matSuffix >\r\n                                                </mat-datepicker-toggle>\r\n                                            </div>\r\n                                        </div>\r\n                                      \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-twelve\">\r\n                                <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"assessmentwilayat\">\r\n                                      \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-thirteen\">\r\n                                <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"categories\">\r\n                                      \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-fourteen\">\r\n                                <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'batchview.sele' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"language\" multiple>\r\n                                            <mat-option value=\"1\">{{'table.eng' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'table.arb' |translate}}</mat-option>\r\n                                        </mat-select>\r\n                                      \r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-fifteen\">\r\n                                <mat-header-cell fxFlex=\"150px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'batchview.sele' |\r\n                                            translate}}</mat-label>\r\n                                        <mat-select [formControl]=\"branchname\" multiple>\r\n                                            <mat-option value=\"1\">{{'table.new' |translate}}</mat-option>\r\n                                            <mat-option value=\"2\">{{'table.Print' |translate}}</mat-option>\r\n                                            <mat-option value=\"3\">{{'table.Teaching' |translate}}</mat-option>\r\n                                            <mat-option value=\"4\">{{'table.QualityCheck' |translate}}</mat-option>\r\n                                            <mat-option value=\"4\">{{'table.Cancelled' |translate}}</mat-option>\r\n                                        </mat-select>\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-sixteen\" stickyEnd>\r\n                                <mat-header-cell fxFlex=\"100px\" class=\"serachrow\" *matHeaderCellDef\r\n                                    style=\"text-align:center\">\r\n    \r\n                                    <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"clearFilter();filtersts=false;\"\r\n                                        aria-hidden=\"true\" matTooltip=\"Refresh\"></i>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"BatchData;sticky: true\">\r\n                            </mat-header-row>\r\n                            <mat-header-row id=\"searchrow\"\r\n                                *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six' , 'row-seven','row-eight','row-nine','row-ten','row-eleven','row-twelve','row-thirteen','row-fourteen' , 'row-fifteen' , 'row-sixteen']\">\r\n                            </mat-header-row>\r\n                            <mat-row mat-row *matRowDef=\"let row; columns: BatchData;\"></mat-row>\r\n                            <ng-container matColumnDef=\"disclaimer\">\r\n                                <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n                                   \r\n                                        <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\" *ngIf=\"!batchdata_data\">\r\n                                                    <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                        <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                        <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                            </div>\r\n                                        </div>\r\n                                </td>\r\n                            </ng-container>\r\n                            <ng-container>\r\n                                <mat-footer-row [style.display]=\"(resultsLength > 0) ? 'none' : 'block' \" \r\n                                    *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                </mat-footer-row>\r\n                            </ng-container>\r\n                        </mat-table>\r\n                    </div>\r\n                    <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                            <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                class=\"masterPage masterbottom \" showFirstLastButtons [pageSize]=\"paginator?.pageSize\"\r\n                                (page)=\"syncPrimaryPaginator($event);\" [pageIndex]=\"paginator?.pageIndex\"\r\n                                [length]=\"paginator?.length\" [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                            </mat-paginator>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<app-batchcreationpage *ngIf=\"companyinfocert\" (supplieregdata)=\"reglandingpagedata($event)\" [batchid]=\"batchid\" (certificatehide)=\"certifyhidedata($event)\"></app-batchcreationpage>\r\n<app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchviewpage/batchviewpage.component.html":
  /*!****************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchviewpage/batchviewpage.component.html ***!
    \****************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesBatchBatchviewpageBatchviewpageComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"viewpagelist\">\r\n        <div class=\"mainboxbatchview\">\r\n            <div class=\"batchfirstcontent\">\r\n                <div class=\"batchtitleheader\" fxLayoutAlign=\"space-between center\">\r\n                    <p class=\"fs-15 m-0\">{{'batchview.batchno' | translate}}:&nbsp;<span>{{batchid}}</span></p>\r\n                    <button mat-icon-button [matMenuTriggerFor]=\"actionmenu\"\r\n                        aria-label=\"Example icon-button with a menu\">\r\n                        <mat-icon class=\"moremenucolor\">more_horiz</mat-icon>\r\n                    </button>\r\n                    <mat-menu #actionmenu=\"matMenu\" class=\"master-menu whentootltipadded\">\r\n                        <button type=\"button\" *ngIf=\"batchdetails.status == 1\" (click)=\"editData(batchdetails)\"\r\n                            mat-menu-item><span>{{'table.edit' |\r\n                                translate}} </span></button>\r\n                        <button type=\"button\" *ngIf=\"batchdetails.status == 1\" (click)=\"CancelBatch(batchdetails)\"\r\n                            mat-menu-item><span>{{'table.cancel' |\r\n                                translate}}</span></button>\r\n                        <button type=\"button\" *ngIf=\"batchdetails.status == 1\" (click)=\"RegisterLearner(batchdetails)\"\r\n                            mat-menu-item><span>{{'table.registerlearner' |\r\n                                translate}}</span></button>\r\n                        <button type=\"button\" (click)=\"ViewLearners(batchdetails)\"\r\n                            mat-menu-item><span>{{'table.viewlearner' |\r\n                                translate}}</span></button>\r\n                        <button type=\"button\"  (click)=\"ChangeAssessor(batchdetails)\" mat-menu-item><span>{{'table.changeassessor' |\r\n                                translate}}</span></button>\r\n                        <button type=\"button\" mat-menu-item><span>{{'table.downloadattendancereport'\r\n                                |\r\n                                translate}}</span></button>\r\n                        <button type=\"button\" mat-menu-item\r\n                            *ngIf=\"batchdetails.req_status == 2 && (batchdetails.status != 4 && batchdetails.status != 6)\"><span>{{'table.assessorchangerequest'\r\n                                |\r\n                                translate}}</span></button>\r\n                        <button type=\"button\" mat-menu-item\r\n                            *ngIf=\"batchdetails.status != 1 && batchdetails.req_status != 1\"><span>{{'table.requestforbacktrack'\r\n                                |\r\n                                translate}}</span></button>\r\n                        <!-- <button type=\"button\" mat-menu-item><span>{{'table.auditlog'\r\n                                                    |\r\n                                                    translate}}</span></button> -->\r\n                    </mat-menu>\r\n                </div>\r\n                <div class=\"statusheader\">\r\n                    <span class=\"fs-15 statustext\">{{'batchview.stat' | translate}}:&nbsp;<span\r\n                            class=\"statuscolor\">{{batchdetails.status}}</span></span>\r\n                </div>\r\n            </div>\r\n            <div fxLayoutAlign=\"flex-start\" class=\"p-t-15 p-b-15 p-l-25 p-r-25\">\r\n                <div class=\"totalleanerheader leanerwidth\">\r\n                    <p class=\"fs-14 m-0\">{{'batchview.totalear' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.totallearners}}/{{batchdetails.batchcount}}</span>\r\n                </div>\r\n                <div class=\"totalleanerheader\">\r\n                    <p class=\"fs-14 m-0\">{{'batchview.remacapa' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.batchcount -\r\n                        batchdetails.totallearners}}/{{batchdetails.batchcount}}</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"m-t-30 p-b-30\">\r\n            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'batchview.offitype' | translate}}</p>\r\n                    <span class=\"fs-16\" *ngIf=\"batchdetails.office_type == 1\">Main Office</span>\r\n                    <span class=\"fs-16\" *ngIf=\"batchdetails.office_type == 2\">Branch Office</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\" *ngIf=\"batchdetails.office_type == 2\">\r\n            <div fxFlex=\"100\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'batchview.branchname' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.appiim_branchname_en}}</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'course.courtitl' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.scm_coursename_en}}</span>\r\n                </div>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'course.courcate' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.category}}</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'batchview.batcsubcate' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.subcategory}}</span>\r\n                </div>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'batchview.batctype' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.batchtype}}</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class=\"courebox m-t-15\">\r\n            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"units\">\r\n                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                    <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                        <p class=\"fs-14 m-0\">{{'batchview.tutoasselang' | translate}}</p>\r\n                        <span class=\"fs-16\">{{batchdetails.language}}</span>\r\n                    </div>\r\n                </div>\r\n                <!-- <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                    ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                    <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                        <p class=\"fs-14 m-0\">{{'batchview.tutoasselang' | translate}}</p>\r\n                        <span class=\"fs-16\">English</span>\r\n                    </div>\r\n                </div> -->\r\n            </div>\r\n        </div>\r\n        <div class=\"timeduration_contain p-t-40 p-b-20\">\r\n            <p class=\"trainingdurationtitle m-0\">{{'course.learcapa' | translate}} <mat-icon matSuffix\r\n                    class=\"m-l-15 fs-20\">info_outline</mat-icon>\r\n            </p>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'course.traintheo' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.theorycount}}</span>\r\n                </div>\r\n            </div>\r\n            <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'course.traintheop' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.practcount}}</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'course.asse' | translate}}</p>\r\n                    <span class=\"fs-16\">{{batchdetails.assessorArray?.asscount}}</span>\r\n                </div>\r\n            </div>\r\n            <!-- <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                    <p class=\"fs-14 m-0\">{{'batchview.batctype' | translate}}</p>\r\n                    <span class=\"fs-16\">Refresher</span>\r\n                </div>\r\n            </div> -->\r\n        </div>\r\n        <div class=\"timeduration_contain p-t-40 p-b-20\">\r\n            <p class=\"trainingdurationtitle m-0\">{{'course.courtrainingdur' | translate}}<mat-icon matSuffix\r\n                    class=\"m-l-15 fs-20\">info_outline</mat-icon>\r\n            </p>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"dateformfieldrange\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"m-t-20 maincontainertable\">\r\n                <div fxLayout=\"row wrap\" class=\"drpickerhader datepickerrangeform\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field class=\"filter daterangetime\" appearance=\"outline\">\r\n                            <mat-label>{{'batchview.stardateanddate' | translate}}</mat-label>\r\n                            <div class=\"drpicker\" id=\"regappview\">\r\n                                <input matInput type=\"text\" id=\"login_session\" [formControl]=\"MRM_CreatedOn\"\r\n                                    value=\"{{batchdetails.theorydaterande}}\" readonly class=\"form-control\" />\r\n\r\n                            </div>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <div class=\"total_header\" fxLayoutAlign=\"space-between center\">\r\n                            <p class=\"fs-18 p-l-20\">{{'batchview.total' | translate}}: {{batchdetails.theorydayscount}}\r\n                                {{'batchview.days' | translate}}</p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"pd-20 tabletopconatiner\">\r\n\r\n                        <div class=\"awaredtable\">\r\n                            <mat-table #table class=\"scrolldata\" [dataSource]=\"batchtrainingdata\">\r\n                                <ng-container matColumnDef=\"selecteddate\">\r\n                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef>\r\n                                        {{'batchview.seledate' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Selected Date\" fxFlex=\"263px\" *matCellDef=\"let BatchData\">\r\n                                        {{BatchData.selecteddate}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"dayscheduled\">\r\n                                    <mat-header-cell fxFlex=\"210px\" mat-header-cell *matHeaderCellDef>\r\n                                        {{'batchview.daysche' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"210px\"\r\n                                        *matCellDef=\"let BatchData\">\r\n                                        <span class=\"availabletxtcolor fs-14\">{{BatchData.dayscheduled}}</span>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"starttime\">\r\n                                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef>Start Time\r\n                                    </mat-header-cell>\r\n                                    <mat-cell data-label=\"hello\" fxFlex=\"150px\" *matCellDef=\"let BatchData\">\r\n                                        <p *ngIf=\"BatchData.startendtime == 64\" class=\"timepicker m-0\"><span\r\n                                                class=\"fs-14\">{{BatchData.start}}</span></p>\r\n                                        <span *ngIf=\"BatchData.startendtime == 30\"\r\n                                            class=\"fs-12 weekededtag\">{{'batchview.week' | translate}}</span>\r\n                                        <span *ngIf=\"BatchData.startendtime == 29\"\r\n                                            class=\"fs-12 weekededtag\">{{'batchview.notavai' | translate}}</span>\r\n                                        <span *ngIf=\"BatchData.startendtime == 31\"\r\n                                            class=\"fs-12 weekededtag\">{{'batchview.holi' | translate}}</span>\r\n\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"endtime\">\r\n                                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef>End Time\r\n                                    </mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.officetype' | translate}}\" fxFlex=\"150px\"\r\n                                        *matCellDef=\"let BatchData\">\r\n                                        <p *ngIf=\"BatchData.startendtime == 64\" class=\"timepicker m-0\"><span\r\n                                                class=\"fs-14\">{{BatchData.end}}</span></p>\r\n\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"time\">\r\n                                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef></mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.officetype' | translate}}\" fxFlex=\"150px\"\r\n                                        *matCellDef=\"let BatchData\">\r\n                                        <p *ngIf=\"BatchData.startendtime == 64\" class=\"timepicker m-0\"><span\r\n                                                class=\"fs-14\">{{BatchData.diff}}</span> <span\r\n                                                *ngIf=\"BatchData.diff\">&nbsp;Hr(s)</span></p>\r\n\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-first\">\r\n                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                            <input matInput type=\"text\" [formControl]=\"dateexpiry\" ngxDaterangepickerMd\r\n                                                [showCustomRangeLabel]=\"true\" [alwaysShowCalendars]=\"true\"\r\n                                                [ranges]=\"ranges\" [locale]=\"locale\" [linkedCalendars]=\"true\"\r\n                                                (datesUpdated)=\"dateFltrChange($event)\" [showClearButton]=\"true\"\r\n                                                [minDate]=\"selected2\" [showClearButton]=\"true\" readonly\r\n                                                class=\"form-control\" />\r\n                                            <mat-datepicker-toggle matSuffix></mat-datepicker-toggle>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-second\">\r\n                                    <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'batchview.sele' | translate}}</mat-label>\r\n                                            <mat-select multiple>\r\n                                                <mat-option value=\"1\">{{'batchview.availa' | translate}}</mat-option>\r\n                                                <mat-option value=\"2\">{{'batchview.notavai' | translate}}</mat-option>\r\n                                                <mat-option value=\"3\">{{'batchview.holi' | translate}}</mat-option>\r\n                                                <mat-option value=\"4\">{{'batchview.week' | translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"BatchtrainingData;sticky: true\">\r\n                                </mat-header-row>\r\n\r\n                                <mat-row mat-row *matRowDef=\"let row; columns: BatchtrainingData;\"></mat-row>\r\n                                <ng-container matColumnDef=\"disclaimer\">\r\n                                    <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n\r\n                                        <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\"\r\n                                            *ngIf=\"!batchtraningdata_data\">\r\n                                            <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                            </div>\r\n                                        </div>\r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container>\r\n                                    <mat-footer-row [style.display]=\"(resultsLength > 0) ? 'none' : 'block' \"\r\n                                        *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                    </mat-footer-row>\r\n                                </ng-container>\r\n                            </mat-table>\r\n                        </div>\r\n\r\n                    </div>\r\n                </div>\r\n\r\n            </div>\r\n        </div>\r\n        <div class=\"timeduration_contain p-t-40 p-b-20\">\r\n            <p class=\"trainingdurationtitle m-0\">{{'course.courtrainingdurp' | translate}}<mat-icon matSuffix\r\n                    class=\"m-l-15 fs-20\">info_outline</mat-icon>\r\n            </p>\r\n        </div>\r\n        <div fxLayout=\"row wrap\" class=\"dateformfieldrange\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"m-t-20 maincontainertable\">\r\n                <div fxLayout=\"row wrap\" class=\"drpickerhader datepickerrangeform\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <mat-form-field class=\"filter daterangetime\" appearance=\"outline\">\r\n                            <mat-label>{{'batchview.stardateanddate' | translate}}</mat-label>\r\n                            <div class=\"drpicker\" id=\"regappview\">\r\n                                <input matInput type=\"text\" id=\"login_session\" [formControl]=\"MRM_CreatedOnPract\"\r\n                                    readonly value=\"{{batchdetails.practdaterande}}\" class=\"form-control\" />\r\n\r\n                            </div>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                        <div class=\"total_header\" fxLayoutAlign=\"space-between center\">\r\n                            <p class=\"fs-18 p-l-20\">{{'batchview.total' | translate}}: {{batchdetails.practdayscount}}\r\n                                {{'batchview.days' | translate}}</p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"pd-20 tabletopconatiner\">\r\n                        <div class=\"paginationwithfilter masterPageTop p-b-10\">\r\n\r\n                            <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"awaredtable\">\r\n                            <mat-table #table class=\"scrolldata\" [dataSource]=\"batchtrainingdatalist\">\r\n\r\n                                <ng-container matColumnDef=\"selecteddate\">\r\n                                    <mat-header-cell fxFlex=\"263px\" mat-header-cell *matHeaderCellDef>\r\n                                        {{'batchview.seledate' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Selected Date\" fxFlex=\"263px\" *matCellDef=\"let BatchDatalist\">\r\n                                        {{BatchDatalist.selecteddate}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"dayscheduled\">\r\n                                    <mat-header-cell fxFlex=\"210px\" mat-header-cell *matHeaderCellDef>\r\n                                        {{'batchview.daysche' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.batchtype' | translate}}\" fxFlex=\"210px\"\r\n                                        *matCellDef=\"let BatchData\">\r\n                                        <span class=\"availabletxtcolor fs-14\">{{BatchData.dayscheduled}}</span>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"starttime\">\r\n                                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef>Start Time\r\n                                    </mat-header-cell>\r\n                                    <mat-cell data-label=\"hello\" fxFlex=\"150px\" *matCellDef=\"let BatchData\">\r\n                                        <p *ngIf=\"BatchData.startendtime == 64\" class=\"timepicker m-0\"><span\r\n                                                class=\"fs-14\">{{BatchData.start}}</span></p>\r\n                                        <span *ngIf=\"BatchData.startendtime == 30\"\r\n                                            class=\"fs-12 weekededtag\">{{'batchview.week' | translate}}</span>\r\n                                        <span *ngIf=\"BatchData.startendtime == 29\"\r\n                                            class=\"fs-12 weekededtag\">{{'batchview.notavai' | translate}}</span>\r\n                                        <span *ngIf=\"BatchData.startendtime == 31\"\r\n                                            class=\"fs-12 weekededtag\">{{'batchview.holi' | translate}}</span>\r\n\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"endtime\">\r\n                                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef>End Time\r\n                                    </mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.officetype' | translate}}\" fxFlex=\"150px\"\r\n                                        *matCellDef=\"let BatchData\">\r\n                                        <p *ngIf=\"BatchData.startendtime == 64\" class=\"timepicker m-0\"><span\r\n                                                class=\"fs-14\">{{BatchData.end}}</span></p>\r\n\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"time\">\r\n                                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef></mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.officetype' | translate}}\" fxFlex=\"150px\"\r\n                                        *matCellDef=\"let BatchData\">\r\n                                        <p *ngIf=\"BatchData.startendtime == 64\" class=\"timepicker m-0\"><span\r\n                                                class=\"fs-14\">{{BatchData.diff}}</span></p>\r\n\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-first\">\r\n                                    <mat-header-cell fxFlex=\"263px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'table.search' |translate}}</mat-label>\r\n                                            <input matInput type=\"text\" [formControl]=\"dateexpiry\" ngxDaterangepickerMd\r\n                                                [showCustomRangeLabel]=\"true\" [alwaysShowCalendars]=\"true\"\r\n                                                [ranges]=\"ranges\" [locale]=\"locale\" [linkedCalendars]=\"true\"\r\n                                                (datesUpdated)=\"dateFltrChange($event)\" [showClearButton]=\"true\"\r\n                                                [minDate]=\"selected2\" [showClearButton]=\"true\" readonly\r\n                                                class=\"form-control\" />\r\n                                            <mat-datepicker-toggle matSuffix></mat-datepicker-toggle>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-second\">\r\n                                    <mat-header-cell fxFlex=\"200px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'batchview.sele' | translate}}</mat-label>\r\n                                            <mat-select multiple>\r\n                                                <mat-option value=\"1\">{{'batchview.availa' | translate}}</mat-option>\r\n                                                <mat-option value=\"2\">{{'batchview.notavai' | translate}}</mat-option>\r\n                                                <mat-option value=\"3\">{{'batchview.holi' | translate}}</mat-option>\r\n                                                <mat-option value=\"4\">{{'batchview.week' | translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"BatchtrainingData\">\r\n                                </mat-header-row>\r\n                                <mat-header-row id=\"searchrow\" *matHeaderRowDef=\"['row-first' , 'row-second']\">\r\n                                </mat-header-row>\r\n                                <mat-row mat-row *matRowDef=\"let row; columns: BatchtrainingData;\"></mat-row>\r\n                                <ng-container matColumnDef=\"disclaimer\">\r\n                                    <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n\r\n                                        <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\"\r\n                                            *ngIf=\"!batchtraningdata_datalist\">\r\n                                            <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                                                <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                                                <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                                            </div>\r\n                                        </div>\r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container>\r\n                                    <mat-footer-row [style.display]=\"(resultsLengthTWO > 0) ? 'none' : 'block' \"\r\n                                        *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                                    </mat-footer-row>\r\n                                </ng-container>\r\n                            </mat-table>\r\n                        </div>\r\n\r\n                    </div>\r\n                </div>\r\n\r\n            </div>\r\n        </div>\r\n        <div class=\"p-t-40\">\r\n            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                    <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                        <p class=\"fs-14 m-0\">{{'batchview.assesdate' | translate}}</p>\r\n                        <span class=\"fs-16\">{{batchdetails.assessorArray?.assessmentdate}}</span>\r\n                    </div>\r\n                </div>\r\n                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                    ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                    <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                        <p class=\"fs-14 m-0\">{{'batchview.assesstart' | translate}} </p>\r\n                        <span class=\"fs-16\">{{batchdetails.assessorArray?.starttime}} -\r\n                            {{batchdetails.assessorArray?.endtime}}</span>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                    <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                        <p class=\"fs-14 m-0\">{{'course.courstutortheo' | translate}}</p>\r\n                        <span class=\"fs-16\">{{batchdetails.theory_tutor}}</span>\r\n                    </div>\r\n                </div>\r\n\r\n                <div fxFlex.gt-sm=\"50\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\"\r\n                    ngClass.xl=\"p-l-30\" fxFlex=\"100\">\r\n                    <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                        <p class=\"fs-14 m-0\">{{'course.courstutorpract' | translate}}</p>\r\n                        <span class=\"fs-16\">{{batchdetails.tutorpract}}</span>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div *ngFor=\"let data of batchdetails?.assessorArray?.assessornames;let i = index\">\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                        <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                            <p class=\"fs-14 m-0\">{{'course.coursassesso' | translate}} <span\r\n                                    *ngIf=\"batchdetails?.assessorArray?.assessornames.length > 0\"></span>{{i + 1}}</p>\r\n                            <span class=\"fs-16\">{{data.sir_name_en}} From {{data.omrm_companyname_en}}</span>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <div *ngFor=\"let data of batchdetails?.assessorArray?.ivqastaffnames;let i = index\">\r\n                <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start center\" class=\"p-b-30\">\r\n                    <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"batchbottomspace\">\r\n                        <div class=\"totalleanerheader p-t-8 p-b-8 p-l-15 p-r-15 bottomcardremaining\">\r\n                            <p class=\"fs-14 m-0\">{{'batchview.ivqa' | translate}} <span\r\n                                    *ngIf=\"batchdetails?.assessorArray?.ivqastaffnames.length > 0\"></span>{{i + 1}}</p>\r\n                            <span class=\"fs-16\">{{data.sir_name_en}} From {{data.omrm_companyname_en}}</span>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n        </div>\r\n    </div>\r\n    <app-responseloader *ngIf=\"disableSubmitButton\"></app-responseloader>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/modal/commentmodal.html":
  /*!*********************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/modal/commentmodal.html ***!
    \*********************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesBatchModalCommentmodalHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div id=\"commentbox\">\r\n    <div class=\"popup scrollerdata\" fxLayout=\"column\" >\r\n        <div class=\"header\" fxFlex=\"100\" fxLayout=\"row wrap\" fxLayoutAlign=\"space-between center\">\r\n            <h4 *ngIf=\"showField1\" class=\"fs-20 red m-0\">{{'batch.cancle' | translate}}</h4>\r\n            <h4 *ngIf=\"showField2\" class=\"fs-20 red m-0\">{{'batch.request' | translate}}</h4>\r\n            <h4 *ngIf=\"showField3\" class=\"fs-20 red m-0\">{{'batch.updatebatch' | translate}}</h4>\r\n            <mat-icon class=\"fs-20 txt-gry\" matTooltip=\"{{'batch.close' | translate}}\" (click)=\"closeModalPopup()\">close</mat-icon>\r\n        </div>\r\n        <mat-divider class=\"m-t-5 m-b-15\"></mat-divider>\r\n\r\n        <div class=\"content\" fxLayout=\"column\">\r\n            <p class=\"fs-16 txt-gry m-0 p-b-5\">{{'batch.batchno' | translate}}</p>\r\n            <p class=\"fs-16 txt-gry3 m-0\">354435645</p>\r\n        </div>\r\n          <form  [formGroup]=\"validationForm\" >\r\n              <div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"p-b-10 m-l-25 m-r-25\" *ngIf=\"showField1 || showField2\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                  <div fxLayout=\"row wrap\" (click)=\"editinfo()\" *ngIf=\"!edittechinfo\">\r\n                    <div class=\"m-t-10\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                      <div class=\"ckeditorborder\">\r\n                        <p class=\"editortitle importantfield txt-gry3\">{{'validation.comm' | translate}} <span class=\"error\" *ngIf=\"manditory\">*</span> </p>\r\n                        <div class=\"contenthere\" [innerHTML]='techinfo'>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"messagecount\" fxLayoutAlign=\"flex-end\">\r\n                        <p class=\"m-0 txt-gry\"> {{length_Of_ck}} / 1000</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                  <div fxLayout=\"row wrap\" *ngIf=\"edittechinfo\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"techapp m-b-10\">\r\n                      <div class=\"d-flex\">\r\n                        <span class=\"d-block ckeditortitle p-b-5 importantfield txt-gry\">{{'validation.comm' | translate}}<span class=\"error\" *ngIf=\"manditory\"> *</span></span>\r\n                      </div>\r\n                      <div class=\"ckeditror\">\r\n                        <ckeditor (change)=\"onChangeeditor($event)\" [(ngModel)]=\"contact\" (ready)=\"onReady($event)\"\r\n                        [editor]=\"Editor\" [config]=\"config\" [formControl]=\"validationForm.controls['comments']\"\r\n                        appAlphanumsymb></ckeditor>\r\n                        <!-- <ckeditor [ngClass]=\"{'is-invalid': f.comments.touched && f.comments.errors }\"\r\n                          (change)=\"onChangeeditor($event)\" [(ngModel)]=\"contact\" (ready)=\"onReady($event)\"\r\n                          [editor]=\"Editor\" [config]=\"config\" [formControl]=\"validationForm.controls['comments']\"\r\n                          appAlphanumsymb [required]=\"false\" #myEditor  (keydown)=\"ck.ckeditor_count(contact) >= 1000 ? $event.stopPropagation() : ''\" >\r\n                        </ckeditor>\r\n                      \r\n                      </div>\r\n                    \r\n                      <div class=\"messagecount txt-gry\" fxLayoutAlign=\"flex-end\">\r\n                        <p class=\"txt-gry m-0 m-t-5\"> {{length_Of_ck}}/1000</p>\r\n                      </div> -->\r\n                      <mat-hint *ngIf=\"length_Of_ck>1000\" class=\"error font-14\"\r\n                        align=\"start\">{{'validation.cannexcechar' | translate}}</mat-hint>\r\n                      <div *ngIf=\"(f.comments.touched && f.comments.errors?.required == true) \">\r\n                        <div class=\"error fs-13\" *ngIf=\"f.comments.touched &&  f.comments.errors\">\r\n                          {{'validation.entemess' | translate}}</div>\r\n                      </div>\r\n                      <div class=\"messagecount txt-gry\" fxLayoutAlign=\"flex-end\">\r\n                        <p class=\"txt-gry m-0 m-t-5\"> {{length_Of_ck}}/1000</p>\r\n                      </div> \r\n                      <div class=\"clearbut p-t-10 b-5\" fxLayoutAlign=\"flex-end\">\r\n                        <button type=\"button\" [disabled]=\"validationForm.controls['comments'].value?.length==0\"\r\n                          (click)=\"resinfo()\" mat-raised-button\r\n                          class=\"m-r-10 clearbutton button-40\">{{'validation.clear' | translate}}</button>\r\n                        <button mat-raised-button color=\"primary\" [disabled]=\"length_Of_ck>1000 || length_Of_ck == 0\"\r\n                          (click)=\"messagedone()\" class=\"button-40\">{{'validation.done' |\r\n                          translate}}</button>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n              </div>\r\n              <div fxLayout=\"row wrap\" fxLayoutAlign=\"center center\" class=\"m-t-20  m-l-25 m-r-25\" *ngIf=\"showField3\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                    <mat-form-field appearance=\"outline\">\r\n                        <mat-select  formControlName=\"status\"\r\n                            panelClass=\"select_with_search\" (selectionChange)=\"statusupdatevalue(f.status.value)\">\r\n                            <mat-option [value]=\"1\">{{'batch.app' | translate}}</mat-option>\r\n                            <mat-option [value]=\"2\">{{'batch.new' | translate}}</mat-option>\r\n                            <mat-option [value]=\"3\">{{'batch.fail' | translate}}</mat-option>\r\n                        </mat-select>\r\n                        <mat-label>{{'batch.selestatus' | translate}}</mat-label>\r\n                        <!-- <mat-error *ngIf=\"f.status.errors?.required || validationForm.submitted\">\r\n                            {{'batch.selectstatus' | translate}}\r\n                        </mat-error> -->\r\n                    </mat-form-field>\r\n                </div>\r\n                </div>\r\n              <div class=\"btngroup m-t-1ck-editor__main0 m-b-20 m-l-25 m-r-25\"  fxLayout=\"row\" fxLayoutAlign=\"flex-end\">\r\n                <button mat-raised-button class=\"cancel_btn\" (click)=\"close()\"   type=\"button\">{{'validation.canc' | translate}}</button>\r\n                <button mat-raised-button class=\"submitbtn m-l-20\" *ngIf=\"showField1 || showField2\" color=\"primary\" (click)=\"submitted()\" [disabled]=\"length_Of_ck>1000 || done\" type=\"submit\" >{{'validation.sumb' | translate}}</button>\r\n                <button mat-raised-button class=\"submitbtn m-l-20\" *ngIf=\"showField3\"  color=\"primary\" (click)=\"submitted()\" [disabled]=\"statustrue\" type=\"submit\" >{{'validation.sumb' | translate}}</button>\r\n              </div>\r\n            </form>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./src/app/modules/batch/batch-routing.module.ts":
  /*!*******************************************************!*\
    !*** ./src/app/modules/batch/batch-routing.module.ts ***!
    \*******************************************************/

  /*! exports provided: BatchRoutingModule */

  /***/
  function srcAppModulesBatchBatchRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "BatchRoutingModule", function () {
      return BatchRoutingModule;
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


    var _batchgridlisting_batchgridlisting_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./batchgridlisting/batchgridlisting.component */
    "./src/app/modules/batch/batchgridlisting/batchgridlisting.component.ts");
    /* harmony import */


    var _batchviewpage_batchviewpage_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./batchviewpage/batchviewpage.component */
    "./src/app/modules/batch/batchviewpage/batchviewpage.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'batchgridlisting',
        component: _batchgridlisting_batchgridlisting_component__WEBPACK_IMPORTED_MODULE_3__["BatchgridlistingComponent"],
        data: {
          title: 'Batch Management',
          urls: [{
            title: 'Batch Management',
            url: '/batchindex/batchgridlisting'
          }]
        }
      }, {
        path: 'batchviewpage',
        component: _batchviewpage_batchviewpage_component__WEBPACK_IMPORTED_MODULE_4__["BatchviewpageComponent"],
        data: {
          title: 'Batch Management',
          urls: [{
            title: 'Batch Management',
            url: '/batchindex/batchviewpage'
          }]
        }
      }]
    }];

    var BatchRoutingModule = /*#__PURE__*/_createClass(function BatchRoutingModule() {
      _classCallCheck(this, BatchRoutingModule);
    });

    BatchRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], BatchRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/batch/batch.module.ts":
  /*!***********************************************!*\
    !*** ./src/app/modules/batch/batch.module.ts ***!
    \***********************************************/

  /*! exports provided: createTranslateLoader, BatchModule */

  /***/
  function srcAppModulesBatchBatchModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function () {
      return createTranslateLoader;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "BatchModule", function () {
      return BatchModule;
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


    var _batch_routing_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./batch-routing.module */
    "./src/app/modules/batch/batch-routing.module.ts");
    /* harmony import */


    var _batchcreationpage_batchcreationpage_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./batchcreationpage/batchcreationpage.component */
    "./src/app/modules/batch/batchcreationpage/batchcreationpage.component.ts");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
    /* harmony import */


    var _app_shared__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var ngx_owl_carousel_o__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ngx-owl-carousel-o */
    "./node_modules/ngx-owl-carousel-o/__ivy_ngcc__/fesm2015/ngx-owl-carousel-o.js");
    /* harmony import */


    var ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! ngx-perfect-scrollbar */
    "./node_modules/ngx-perfect-scrollbar/__ivy_ngcc__/dist/ngx-perfect-scrollbar.es5.js");
    /* harmony import */


    var ngx_smart_popover__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! ngx-smart-popover */
    "./node_modules/ngx-smart-popover/__ivy_ngcc__/fesm2015/ngx-smart-popover.js");
    /* harmony import */


    var _ngx_gallery_core__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @ngx-gallery/core */
    "./node_modules/@ngx-gallery/core/__ivy_ngcc__/fesm2015/ngx-gallery-core.js");
    /* harmony import */


    var ng5_slider__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! ng5-slider */
    "./node_modules/ng5-slider/__ivy_ngcc__/esm2015/ng5-slider.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! @ngx-translate/http-loader */
    "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
    /* harmony import */


    var _batchviewpage_batchviewpage_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! ./batchviewpage/batchviewpage.component */
    "./src/app/modules/batch/batchviewpage/batchviewpage.component.ts");
    /* harmony import */


    var _batchgridlisting_batchgridlisting_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! ./batchgridlisting/batchgridlisting.component */
    "./src/app/modules/batch/batchgridlisting/batchgridlisting.component.ts");
    /* harmony import */


    var _modal_commentmodal__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! ./modal/commentmodal */
    "./src/app/modules/batch/modal/commentmodal.ts");
    /* harmony import */


    var _app_common_ckeditor__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! @app/common/ckeditor */
    "./src/app/common/ckeditor/index.ts");

    function createTranslateLoader(http) {
      return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_15__["TranslateHttpLoader"](http, './assets/i18n/batch/', '.json');
    }

    var BatchModule = /*#__PURE__*/_createClass(function BatchModule() {
      _classCallCheck(this, BatchModule);
    });

    BatchModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_batchgridlisting_batchgridlisting_component__WEBPACK_IMPORTED_MODULE_17__["BatchgridlistingComponent"], _batchcreationpage_batchcreationpage_component__WEBPACK_IMPORTED_MODULE_4__["BatchcreationpageComponent"], _batchviewpage_batchviewpage_component__WEBPACK_IMPORTED_MODULE_16__["BatchviewpageComponent"], _batchcreationpage_batchcreationpage_component__WEBPACK_IMPORTED_MODULE_4__["Modalquicksetup"], _modal_commentmodal__WEBPACK_IMPORTED_MODULE_18__["commentmodal"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _batch_routing_module__WEBPACK_IMPORTED_MODULE_3__["BatchRoutingModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__["ReactiveFormsModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormsModule"], _angular_common_http__WEBPACK_IMPORTED_MODULE_6__["HttpClientModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__["FlexLayoutModule"], _app_shared__WEBPACK_IMPORTED_MODULE_8__["SharedModule"], ngx_owl_carousel_o__WEBPACK_IMPORTED_MODULE_9__["CarouselModule"], ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_10__["PerfectScrollbarModule"], ngx_smart_popover__WEBPACK_IMPORTED_MODULE_11__["PopoverModule"], _ngx_gallery_core__WEBPACK_IMPORTED_MODULE_12__["GalleryModule"], ng5_slider__WEBPACK_IMPORTED_MODULE_13__["Ng5SliderModule"], _app_common_ckeditor__WEBPACK_IMPORTED_MODULE_19__["CKEditorModule"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_14__["TranslateModule"].forChild({
        loader: {
          provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_14__["TranslateLoader"],
          useFactory: createTranslateLoader,
          deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_6__["HttpClient"]]
        }
      })],
      entryComponents: [_batchcreationpage_batchcreationpage_component__WEBPACK_IMPORTED_MODULE_4__["Modalquicksetup"], _modal_commentmodal__WEBPACK_IMPORTED_MODULE_18__["commentmodal"]],
      exports: [_batchcreationpage_batchcreationpage_component__WEBPACK_IMPORTED_MODULE_4__["Modalquicksetup"]]
    })], BatchModule);
    /***/
  },

  /***/
  "./src/app/modules/batch/batchcreationpage/batchcreationpage.component.scss":
  /*!**********************************************************************************!*\
    !*** ./src/app/modules/batch/batchcreationpage/batchcreationpage.component.scss ***!
    \**********************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesBatchBatchcreationpageBatchcreationpageComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#batchcreationlist .addbtn {\n  background: none;\n  border: none;\n  display: flex;\n  align-items: center;\n  font-size: 16px;\n}\n#batchcreationlist .mat-raised-button {\n  border-radius: 2px;\n  box-shadow: none;\n  font-size: 16px;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n#batchcreationlist .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#batchcreationlist .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#batchcreationlist .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#batchcreationlist .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#batchcreationlist .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#batchcreationlist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#batchcreationlist .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#batchcreationlist .date_exp .mat-form-field-appearance-outline .mat-form-field-suffix {\n  display: flex;\n  align-items: center;\n}\n#batchcreationlist .mat-form-field-outline-thick[ng-reflect-state=readonly] {\n  background-color: #d9d9d9;\n}\n#batchcreationlist input[readonly] {\n  cursor: pointer;\n}\n#batchcreationlist .mat-form-field.mat-focused.mat-primary .mat-select-arrow {\n  color: transparent !important;\n}\n#batchcreationlist .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n#batchcreationlist .timeduration_contain .trainingdurationtitle {\n  color: #333;\n  font-size: 1.125rem;\n  display: flex;\n  align-items: center;\n}\n#batchcreationlist .timeduration_contain .trainingdurationtitle .mat-icon {\n  color: #848484;\n  margin-top: 6px;\n}\n#batchcreationlist .total_header p {\n  color: #333;\n}\n#batchcreationlist #regapp .closeanddateicomax {\n  top: 14px !important;\n}\n#batchcreationlist .timepickerwidth {\n  max-width: 85px;\n}\n#batchcreationlist .timepickerwidth .mat-icon {\n  font-size: 20px;\n  color: #848484;\n}\n#batchcreationlist .datepickerrangeform .md-drppicker {\n  right: auto !important;\n  left: 0px !important;\n}\n#batchcreationlist #assesttimedate {\n  display: flex;\n  align-items: center;\n  position: relative;\n  padding-bottom: 10px;\n}\n#batchcreationlist #assesttimedate .md-drppicker.double {\n  width: 650px;\n  right: 0 !important;\n  margin-top: 20px;\n  left: -120px !important;\n}\n#batchcreationlist .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 110px;\n  height: 45px;\n  box-shadow: none;\n}\n#batchcreationlist .serachrow .mat-form-field-outline .mat-form-field-label {\n  margin-top: -0.55em !important;\n}\n#batchcreationlist #searchrow,\n#batchcreationlist #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#batchcreationlist #searchrow .serachrow,\n#batchcreationlist #filtershow .serachrow {\n  background: #f8f8f8 !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n  padding-top: 10px;\n}\n#batchcreationlist #searchrow .serachrow .mat-form-field-outline,\n#batchcreationlist #filtershow .serachrow .mat-form-field-outline {\n  background-color: #fff !important;\n}\n#batchcreationlist #searchrow .serachrow .mat-form-field-outline .mat-form-field-label,\n#batchcreationlist #filtershow .serachrow .mat-form-field-outline .mat-form-field-label {\n  top: -0.55em !important;\n}\n#batchcreationlist .tabletopconatiner .mat-paginator-container {\n  justify-content: space-between !important;\n  width: 100%;\n}\n#batchcreationlist .tabletopconatiner .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .manageoptions .mat-icon {\n  color: #acacac;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .mat-row {\n  border-bottom: transparent !important;\n  padding-bottom: 10px;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .mat-cell {\n  color: #262626;\n}\n#batchcreationlist .tabletopconatiner .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#batchcreationlist .timeaddpicker {\n  max-height: 65px;\n  min-height: 65px;\n  border: 1px solid #ddd;\n  padding: 10px;\n  border-radius: 4px;\n}\n#batchcreationlist .timeaddpicker .drpickerstartend .mat-icon {\n  color: #848484;\n  margin-top: -12px;\n}\n#batchcreationlist .timeaddpicker .drpickerstartend .mat-form-field-wrapper {\n  margin-top: 0px !important;\n}\n#batchcreationlist .timeaddpicker .drpickerstartend .mat-form-field-underline {\n  display: none;\n}\n#batchcreationlist .timeaddpicker .drpickerstartend .mat-form-field-infix {\n  margin-top: 0px !important;\n  padding-top: 0px !important;\n  padding-bottom: 0px !important;\n  border: none;\n}\n#batchcreationlist .timeaddpicker .drpickerstartend .beforrshow::before {\n  content: \"\";\n  position: absolute;\n  width: 1px;\n  right: -20px;\n  top: -17px;\n  background-color: #ddd;\n  height: 90%;\n}\n#batchcreationlist .paginationwithfilter {\n  display: flex;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#batchcreationlist .maincontainertable {\n  border: 1px solid #ddd;\n}\n#batchcreationlist .maincontainertable .drpickerhader {\n  background-color: #fbfbfb;\n  padding: 20px;\n  padding-bottom: 0px;\n}\n#batchcreationlist .maincontainertable .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#batchcreationlist .maincontainertable .quicksetup {\n  background-color: #848484;\n  min-width: 180px;\n  color: #fff;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  box-shadow: none;\n}\n#batchcreationlist .clearbtn {\n  min-width: 65px !important;\n  height: 30px !important;\n  line-height: 1;\n}\n#batchcreationlist .cancelbtn, #batchcreationlist .clearbtn {\n  min-width: 110px;\n  background-color: #fff;\n  color: #333;\n  border: 1px solid #c4c4c4;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  box-shadow: none;\n}\n#batchcreationlist .borderslot {\n  border-left: 1px solid #ddd;\n  align-items: flex-end !important;\n}\n#batchcreationlist .hrstag {\n  padding: 5px 10px;\n  border: 1px solid #ddd;\n  border-radius: 6px;\n  margin-left: 15px;\n}\n#batchcreationlist .slottag .mat-icon {\n  color: #848484;\n}\n#batchcreationlist .slottag span {\n  color: #262626;\n}\n#batchcreationlist .closeanddateicon {\n  display: flex !important;\n  align-items: center !important;\n}\n#batchcreationlist .w-150 {\n  width: 150px;\n}\n#batchcreationlist .usrfrm {\n  display: flex;\n  flex-direction: column !important;\n}\n@media (max-width: 767px) {\n  .filterbtn {\n    margin-top: 10px;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9iYXRjaC9iYXRjaGNyZWF0aW9ucGFnZS9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxiYXRjaFxcYmF0Y2hjcmVhdGlvbnBhZ2VcXGJhdGNoY3JlYXRpb25wYWdlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2JhdGNoL2JhdGNoY3JlYXRpb25wYWdlL2JhdGNoY3JlYXRpb25wYWdlLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQVlJO0VBQ0ksZ0JBQUE7RUFDQSxZQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsZUFBQTtBQ1hSO0FEYUk7RUFDSSxrQkFBQTtFQUNBLGdCQUFBO0VBQ0EsZUFBQTtBQ1hSO0FEZ0JRO0VBRUksb0NBQUE7QUNmWjtBRG9CUTtFQUNJLGNBQUE7QUNsQlo7QURxQlE7RUFDSSwwQkFBQTtBQ25CWjtBRHNCUTtFQUNJLDBCQUFBO0FDcEJaO0FEdUJRO0VBQ0ksY0FBQTtBQ3JCWjtBRHdCUTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ3RCWjtBRDJCWTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ3pCaEI7QUQ4Qm9CO0VBQ0ksY0FBQTtBQzVCeEI7QURtQ1k7RUFDSSx5QkFBQTtBQ2pDaEI7QUR1Q1k7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNyQ2hCO0FEMkNnQjtFQUNJLDBDQUFBO0VBQ0EsY0FBQTtBQ3pDcEI7QUQyQ29CO0VBQ0ksY0FBQTtBQ3pDeEI7QUQ2Q2dCO0VBQ0kscUJBQUE7QUMzQ3BCO0FEaURJO0VBQ0ksd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0FDL0NSO0FEb0RZO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDbERoQjtBRHVESTtFQUNJLHlCQUFBO0FDckRSO0FEd0RJO0VBQ0ksZUFBQTtBQ3REUjtBRDZEZ0I7RUFDSSw2QkFBQTtBQzNEcEI7QURtRVk7RUFDSSx5QkFBQTtBQ2pFaEI7QUR1RVE7RUFDSSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUNyRVo7QURzRVk7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQ3BFaEI7QUR5RVM7RUFDSSxXQUFBO0FDdkViO0FEMkVRO0VBQ0ksb0JBQUE7QUN6RVo7QUQ0RUk7RUFDSyxlQUFBO0FDMUVUO0FEMkVTO0VBQ0csZUFBQTtFQUNBLGNBQUE7QUN6RVo7QUQ2RVE7RUFDSSxzQkFBQTtFQUNBLG9CQUFBO0FDM0VaO0FEOEVJO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxvQkFBQTtBQzVFUjtBRDZFUTtFQUNJLFlBQUE7RUFDQSxtQkFBQTtFQUNBLGdCQUFBO0VBQ0EsdUJBQUE7QUMzRVo7QUQrRUk7RUFDSSxvQ0FBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7QUM3RVI7QURpRlk7RUFDSSw4QkFBQTtBQy9FaEI7QURvRkk7O0VBRUksMkJBQUE7RUFDQSxZQUFBO0FDbEZSO0FEb0ZROztFQUNJLDhCQUFBO0VBQ0EsMkJBQUE7RUFDQSxtQkFBQTtFQUNBLGlCQUFBO0FDakZaO0FEa0ZZOztFQUNJLGlDQUFBO0FDL0VoQjtBRGdGZ0I7O0VBQ0ksdUJBQUE7QUM3RXBCO0FEbUZRO0VBQ0kseUNBQUE7RUFDQSxXQUFBO0FDakZaO0FEbUZRO0VBQ0ksa0JBQUE7RUFDQSw0QkFBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7QUNqRlo7QURtRm9CO0VBQ0kseUJBQUE7QUNqRnhCO0FEcUZvQjtFQUNJLGNBQUE7QUNuRnhCO0FEc0ZZO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQ3BGaEI7QURzRmdCO0VBQ0ksVUFBQTtFQUNBLFdBQUE7QUNwRnBCO0FEdUZnQjtFQUNJLG1CQUFBO0FDckZwQjtBRHdGZ0I7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FDdEZwQjtBRHlGZ0I7RUFDSSxnQkFBQTtBQ3ZGcEI7QUQwRlk7RUFDSSxtQkFBQTtBQ3hGaEI7QUQwRlk7RUFDSSxxQ0FBQTtFQUNBLG9CQUFBO0FDeEZoQjtBRDJGWTtFQUNJLGNBQUE7QUN6RmhCO0FENEZZO0VBQ0kseUJBQUE7RUFDQSx5QkFBQTtFQUNBLGVBQUE7QUMxRmhCO0FEOEZJO0VBQ0ksZ0JBQUE7RUFDQSxnQkFBQTtFQUNBLHNCQUFBO0VBQ0EsYUFBQTtFQUNBLGtCQUFBO0FDNUZSO0FEOEZZO0VBQ08sY0FBQTtFQUNBLGlCQUFBO0FDNUZuQjtBRDhGWTtFQUNPLDBCQUFBO0FDNUZuQjtBRDhGWTtFQUNLLGFBQUE7QUM1RmpCO0FEOEZZO0VBQ0ksMEJBQUE7RUFDQSwyQkFBQTtFQUNBLDhCQUFBO0VBQ0EsWUFBQTtBQzVGaEI7QUQ4Rlk7RUFDSSxXQUFBO0VBQ0Esa0JBQUE7RUFDQSxVQUFBO0VBQ0EsWUFBQTtFQUNBLFVBQUE7RUFDQSxzQkFBQTtFQUNBLFdBQUE7QUM1RmhCO0FEaUdJO0VBQ0ksYUFBQTtFQUNBLHlDQUFBO0VBQ0EsOEJBQUE7QUMvRlI7QURpR0k7RUFDSyxzQkFBQTtBQy9GVDtBRGdHUztFQUNHLHlCQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0FDOUZaO0FEa0dRO0VBQ0ksYUFBQTtBQ2hHWjtBRG1HUTtFQUNLLHlCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxXQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQ2pHYjtBRG9HSTtFQUVJLDBCQUFBO0VBQ0EsdUJBQUE7RUFDQSxjQUFBO0FDbkdSO0FEcUdJO0VBQ0ksZ0JBQUE7RUFDQSxzQkFBQTtFQUNBLFdBQUE7RUFDQSx5QkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7QUNuR1I7QURxR0k7RUFDSywyQkFBQTtFQUNBLGdDQUFBO0FDbkdUO0FEcUdJO0VBQ0ksaUJBQUE7RUFDQSxzQkFBQTtFQUNBLGtCQUFBO0VBQ0EsaUJBQUE7QUNuR1I7QURzR1E7RUFDRyxjQUFBO0FDcEdYO0FEc0dRO0VBQ0ksY0FBQTtBQ3BHWjtBRHdHTTtFQUVFLHdCQUFBO0VBQ0EsOEJBQUE7QUN2R1I7QUR5R007RUFDSSxZQUFBO0FDdkdWO0FEeUdNO0VBQ0ksYUFBQTtFQUNBLGlDQUFBO0FDdkdWO0FEMkdBO0VBQ0k7SUFDSyxnQkFBQTtFQ3hHUDtBQUNGIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9iYXRjaC9iYXRjaGNyZWF0aW9ucGFnZS9iYXRjaGNyZWF0aW9ucGFnZS5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIlxyXG5cclxuI2JhdGNoY3JlYXRpb25saXN0e1xyXG4gICAgLmRhdGVmb3JtZmllbGRyYW5nZXtcclxuICAgICAgICAuZGF0ZXJhbmdldGltZXtcclxuICAgICAgICAvLyAgICAgLm1hdC1mb3JtLWZpZWxkLWluZml4e1xyXG4gICAgICAgIC8vICAgICAgICAgcGFkZGluZy10b3A6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIC8vICAgICAgICAgcGFkZGluZy1ib3R0b206IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIC8vICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICBcclxuICAgIH1cclxuICAgIC5hZGRidG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQ6IG5vbmU7XHJcbiAgICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBmb250LXNpemU6IDE2cHg7XHJcbiAgICB9XHJcbiAgICAubWF0LXJhaXNlZC1idXR0b24ge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTZweDtcclxuICAgIH1cclxuICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG5cclxuICAgICAgICAvLyAmLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xyXG4gICAgICAgICAgICAvLyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgLy8gfVxyXG4gICAgICAgICAgICAvLyB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5kYXRlX2V4cCB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2tbbmctcmVmbGVjdC1zdGF0ZT1cInJlYWRvbmx5XCJdIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgfVxyXG5cclxuICAgIGlucHV0W3JlYWRvbmx5XSB7XHJcbiAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG5cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAmLm1hdC1wcmltYXJ5IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtc2VsZWN0LWFycm93IHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC50aW1lZHVyYXRpb25fY29udGFpbntcclxuICAgICAgICAudHJhaW5pbmdkdXJhdGlvbnRpdGxle1xyXG4gICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgICAgZm9udC1zaXplOiBcdDEuMTI1cmVtO1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiA2cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAudG90YWxfaGVhZGVye1xyXG4gICAgICAgICBwe1xyXG4gICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgIH1cclxuICAgIH1cclxuICAgICAjcmVnYXBwe1xyXG4gICAgICAgIC5jbG9zZWFuZGRhdGVpY29tYXgge1xyXG4gICAgICAgICAgICB0b3A6IDE0cHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAudGltZXBpY2tlcndpZHRoe1xyXG4gICAgICAgICBtYXgtd2lkdGg6IDg1cHg7XHJcbiAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMjBweDtcclxuICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmRhdGVwaWNrZXJyYW5nZWZvcm0ge1xyXG4gICAgICAgIC5tZC1kcnBwaWNrZXIge1xyXG4gICAgICAgICAgICByaWdodDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBsZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAjYXNzZXN0dGltZWRhdGV7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgICAubWQtZHJwcGlja2VyLmRvdWJsZXtcclxuICAgICAgICAgICAgd2lkdGg6IDY1MHB4O1xyXG4gICAgICAgICAgICByaWdodDogMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBtYXJnaW4tdG9wOjIwcHg7XHJcbiAgICAgICAgICAgIGxlZnQ6IC0xMjBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIFxyXG4gICAgLnN1Ym1pdF9idG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcclxuICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1pbi13aWR0aDogMTEwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICB9XHJcbiAgICAuc2VyYWNocm93IHtcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAtMC41NWVtICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiBcclxuICAgICNzZWFyY2hyb3csXHJcbiAgICAjZmlsdGVyc2hvdyB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlcjogbm9uZTtcclxuXHJcbiAgICAgICAgLnNlcmFjaHJvdyB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmOGY4ZjggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXRvcDogMTBweDtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICB0b3A6IC0wLjU1ZW0gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC50YWJsZXRvcGNvbmF0aW5lcntcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1jb250YWluZXJ7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmF3YXJlZHRhYmxlIHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICBtYXJnaW46IDEwcHggMHB4OyBcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDhweCAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjYWNhY2FjO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnNjcm9sbGRhdGEge1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgei1pbmRleDogMTtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcclxuICAgICAgICBcclxuICAgICAgICAgICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogNnB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtcm93IHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1ib3R0b206IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWhlYWRlci1jZWxsIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSAgIFxyXG4gICAgLnRpbWVhZGRwaWNrZXJ7XHJcbiAgICAgICAgbWF4LWhlaWdodDogNjVweDtcclxuICAgICAgICBtaW4taGVpZ2h0OiA2NXB4O1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgcGFkZGluZzogMTBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgLmRycGlja2Vyc3RhcnRlbmR7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbntcclxuICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogLTEycHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXJ7XHJcbiAgICAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5le1xyXG4gICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy10b3A6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5iZWZvcnJzaG93OjpiZWZvcmV7XHJcbiAgICAgICAgICAgICAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDFweDtcclxuICAgICAgICAgICAgICAgIHJpZ2h0OiAtMjBweDtcclxuICAgICAgICAgICAgICAgIHRvcDogLTE3cHg7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZGRkO1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiA5MCU7XHJcbiAgICAgICAgICAgIH0gIFxyXG4gICAgICAgfVxyXG4gICAgfVxyXG4gICBcclxuICAgIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleCA7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLm1haW5jb250YWluZXJ0YWJsZXtcclxuICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgICAgLmRycGlja2VyaGFkZXJ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmYmZiZmI7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDIwcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctYm90dG9tOiAwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIC5tYXN0ZXJQYWdlVG9wIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAucXVpY2tzZXR1cHtcclxuICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgICAgICBtaW4td2lkdGg6IDE4MHB4O1xyXG4gICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweDtcclxuICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmNsZWFyYnRuIHtcclxuICAgICAgICBAZXh0ZW5kIC5jYW5jZWxidG47XHJcbiAgICAgICAgbWluLXdpZHRoOiA2NXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgaGVpZ2h0OiAzMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgfVxyXG4gICAgLmNhbmNlbGJ0biB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMTBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNjNGM0YzQ7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHg7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogMHB4O1xyXG4gICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcnNsb3R7XHJcbiAgICAgICAgIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2RkZDtcclxuICAgICAgICAgYWxpZ24taXRlbXM6IGZsZXgtZW5kICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuaHJzdGFne1xyXG4gICAgICAgIHBhZGRpbmc6IDVweCAxMHB4O1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogNnB4O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAxNXB4O1xyXG4gICAgfVxyXG4gICAgLnNsb3R0YWd7XHJcbiAgICAgICAgLm1hdC1pY29ue1xyXG4gICAgICAgICAgIGNvbG9yOiAjODQ4NDg0OyAgIFxyXG4gICAgICAgIH1cclxuICAgICAgICBzcGFue1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgXHJcbiAgICAgIC5jbG9zZWFuZGRhdGVpY29uXHJcbiAgICAgIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICAgIC53LTE1MHtcclxuICAgICAgICAgIHdpZHRoOjE1MHB4O1xyXG4gICAgICB9XHJcbiAgICAgIC51c3Jmcm17XHJcbiAgICAgICAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICAgICAgICBmbGV4LWRpcmVjdGlvbjpjb2x1bW4gIWltcG9ydGFudDtcclxuICAgICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcclxuICAgIC5maWx0ZXJidG57XHJcbiAgICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICB9XHJcbn0iLCIjYmF0Y2hjcmVhdGlvbmxpc3QgLmFkZGJ0biB7XG4gIGJhY2tncm91bmQ6IG5vbmU7XG4gIGJvcmRlcjogbm9uZTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5tYXQtcmFpc2VkLWJ1dHRvbiB7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYm94LXNoYWRvdzogbm9uZTtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA5YzNhICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGNvbG9yOiAjZDlkOWQ5O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZC5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtMC45cmVtKSBzY2FsZSgwLjc1KTtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLmRhdGVfZXhwIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2tbbmctcmVmbGVjdC1zdGF0ZT1yZWFkb25seV0ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZDlkOWQ5O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IGlucHV0W3JlYWRvbmx5XSB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAubWF0LWZvcm0tZmllbGQubWF0LWZvY3VzZWQubWF0LXByaW1hcnkgLm1hdC1zZWxlY3QtYXJyb3cge1xuICBjb2xvcjogdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAubWF0LWZvcm0tZmllbGQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogI2RjNGM2NCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC50aW1lZHVyYXRpb25fY29udGFpbiAudHJhaW5pbmdkdXJhdGlvbnRpdGxlIHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMS4xMjVyZW07XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnRpbWVkdXJhdGlvbl9jb250YWluIC50cmFpbmluZ2R1cmF0aW9udGl0bGUgLm1hdC1pY29uIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG4gIG1hcmdpbi10b3A6IDZweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudG90YWxfaGVhZGVyIHAge1xuICBjb2xvcjogIzMzMztcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAjcmVnYXBwIC5jbG9zZWFuZGRhdGVpY29tYXgge1xuICB0b3A6IDE0cHggIWltcG9ydGFudDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGltZXBpY2tlcndpZHRoIHtcbiAgbWF4LXdpZHRoOiA4NXB4O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC50aW1lcGlja2Vyd2lkdGggLm1hdC1pY29uIHtcbiAgZm9udC1zaXplOiAyMHB4O1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAuZGF0ZXBpY2tlcnJhbmdlZm9ybSAubWQtZHJwcGlja2VyIHtcbiAgcmlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgI2Fzc2VzdHRpbWVkYXRlIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAjYXNzZXN0dGltZWRhdGUgLm1kLWRycHBpY2tlci5kb3VibGUge1xuICB3aWR0aDogNjUwcHg7XG4gIHJpZ2h0OiAwICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi10b3A6IDIwcHg7XG4gIGxlZnQ6IC0xMjBweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5zdWJtaXRfYnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4td2lkdGg6IDExMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnNlcmFjaHJvdyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBtYXJnaW4tdG9wOiAtMC41NWVtICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgI3NlYXJjaHJvdyxcbiNiYXRjaGNyZWF0aW9ubGlzdCAjZmlsdGVyc2hvdyB7XG4gIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiBub25lO1xufVxuI2JhdGNoY3JlYXRpb25saXN0ICNzZWFyY2hyb3cgLnNlcmFjaHJvdyxcbiNiYXRjaGNyZWF0aW9ubGlzdCAjZmlsdGVyc2hvdyAuc2VyYWNocm93IHtcbiAgYmFja2dyb3VuZDogI2Y4ZjhmOCAhaW1wb3J0YW50O1xuICBtaW4taGVpZ2h0OiA3M3B4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG4gIHBhZGRpbmctdG9wOiAxMHB4O1xufVxuI2JhdGNoY3JlYXRpb25saXN0ICNzZWFyY2hyb3cgLnNlcmFjaHJvdyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSxcbiNiYXRjaGNyZWF0aW9ubGlzdCAjZmlsdGVyc2hvdyAuc2VyYWNocm93IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuI2JhdGNoY3JlYXRpb25saXN0ICNzZWFyY2hyb3cgLnNlcmFjaHJvdyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSAubWF0LWZvcm0tZmllbGQtbGFiZWwsXG4jYmF0Y2hjcmVhdGlvbmxpc3QgI2ZpbHRlcnNob3cgLnNlcmFjaHJvdyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0b3A6IC0wLjU1ZW0gIWltcG9ydGFudDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGFibGV0b3Bjb25hdGluZXIgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUge1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIG1hcmdpbjogMTBweCAwcHg7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIHBhZGRpbmc6IDhweCAwICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAubWFuYWdlb3B0aW9ucyAubWF0LWljb24ge1xuICBjb2xvcjogI2FjYWNhYztcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGFibGV0b3Bjb25hdGluZXIgLmF3YXJlZHRhYmxlIC5zY3JvbGxkYXRhIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAxO1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogNnB4O1xuICBoZWlnaHQ6IDVweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGFibGV0b3Bjb25hdGluZXIgLmF3YXJlZHRhYmxlIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLm1hbmFnZW9wdGlvbnMge1xuICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLm1hdC1yb3cge1xuICBib3JkZXItYm90dG9tOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGFibGV0b3Bjb25hdGluZXIgLmF3YXJlZHRhYmxlIC5tYXQtY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLm1hdC1oZWFkZXItY2VsbCB7XG4gIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGltZWFkZHBpY2tlciB7XG4gIG1heC1oZWlnaHQ6IDY1cHg7XG4gIG1pbi1oZWlnaHQ6IDY1cHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG4gIHBhZGRpbmc6IDEwcHg7XG4gIGJvcmRlci1yYWRpdXM6IDRweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGltZWFkZHBpY2tlciAuZHJwaWNrZXJzdGFydGVuZCAubWF0LWljb24ge1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgbWFyZ2luLXRvcDogLTEycHg7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLnRpbWVhZGRwaWNrZXIgLmRycGlja2Vyc3RhcnRlbmQgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBtYXJnaW4tdG9wOiAwcHggIWltcG9ydGFudDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGltZWFkZHBpY2tlciAuZHJwaWNrZXJzdGFydGVuZCAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGltZWFkZHBpY2tlciAuZHJwaWNrZXJzdGFydGVuZCAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBtYXJnaW4tdG9wOiAwcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy10b3A6IDBweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWJvdHRvbTogMHB4ICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogbm9uZTtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudGltZWFkZHBpY2tlciAuZHJwaWNrZXJzdGFydGVuZCAuYmVmb3Jyc2hvdzo6YmVmb3JlIHtcbiAgY29udGVudDogXCJcIjtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB3aWR0aDogMXB4O1xuICByaWdodDogLTIwcHg7XG4gIHRvcDogLTE3cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNkZGQ7XG4gIGhlaWdodDogOTAlO1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1haW5jb250YWluZXJ0YWJsZSB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1haW5jb250YWluZXJ0YWJsZSAuZHJwaWNrZXJoYWRlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmYmZiZmI7XG4gIHBhZGRpbmc6IDIwcHg7XG4gIHBhZGRpbmctYm90dG9tOiAwcHg7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1haW5jb250YWluZXJ0YWJsZSAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLm1haW5jb250YWluZXJ0YWJsZSAucXVpY2tzZXR1cCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICM4NDg0ODQ7XG4gIG1pbi13aWR0aDogMTgwcHg7XG4gIGNvbG9yOiAjZmZmO1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLmNsZWFyYnRuIHtcbiAgbWluLXdpZHRoOiA2NXB4ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogMzBweCAhaW1wb3J0YW50O1xuICBsaW5lLWhlaWdodDogMTtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAuY2FuY2VsYnRuLCAjYmF0Y2hjcmVhdGlvbmxpc3QgLmNsZWFyYnRuIHtcbiAgbWluLXdpZHRoOiAxMTBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgY29sb3I6ICMzMzM7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNjNGM0YzQ7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xuICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgYm94LXNoYWRvdzogbm9uZTtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAuYm9yZGVyc2xvdCB7XG4gIGJvcmRlci1sZWZ0OiAxcHggc29saWQgI2RkZDtcbiAgYWxpZ24taXRlbXM6IGZsZXgtZW5kICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjcmVhdGlvbmxpc3QgLmhyc3RhZyB7XG4gIHBhZGRpbmc6IDVweCAxMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xuICBib3JkZXItcmFkaXVzOiA2cHg7XG4gIG1hcmdpbi1sZWZ0OiAxNXB4O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5zbG90dGFnIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC5zbG90dGFnIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAuY2xvc2VhbmRkYXRlaWNvbiB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI2JhdGNoY3JlYXRpb25saXN0IC53LTE1MCB7XG4gIHdpZHRoOiAxNTBweDtcbn1cbiNiYXRjaGNyZWF0aW9ubGlzdCAudXNyZnJtIHtcbiAgZGlzcGxheTogZmxleDtcbiAgZmxleC1kaXJlY3Rpb246IGNvbHVtbiAhaW1wb3J0YW50O1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcbiAgLmZpbHRlcmJ0biB7XG4gICAgbWFyZ2luLXRvcDogMTBweDtcbiAgfVxufSJdfQ== */";
    /***/
  },

  /***/
  "./src/app/modules/batch/batchcreationpage/batchcreationpage.component.ts":
  /*!********************************************************************************!*\
    !*** ./src/app/modules/batch/batchcreationpage/batchcreationpage.component.ts ***!
    \********************************************************************************/

  /*! exports provided: BatchcreationpageComponent, Modalquicksetup */

  /***/
  function srcAppModulesBatchBatchcreationpageBatchcreationpageComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "BatchcreationpageComponent", function () {
      return BatchcreationpageComponent;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "Modalquicksetup", function () {
      return Modalquicksetup;
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


    var _angular_material_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/core */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/config/BGIConfig/bgi-jsonconfig-services */
    "./src/app/config/BGIConfig/bgi-jsonconfig-services.ts");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _app_services_batch_service__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @app/services/batch.service */
    "./src/app/services/batch.service.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! moment */
    "./node_modules/moment/moment.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_14__);
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_17__);

    var BatchcreationpageComponent = /*#__PURE__*/function () {
      function BatchcreationpageComponent(fb, translate, remoteService, cookieService, activatedRoute, security, batchService, el, dialog, toastr, localstorage) {
        _classCallCheck(this, BatchcreationpageComponent);

        this.fb = fb;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.activatedRoute = activatedRoute;
        this.security = security;
        this.batchService = batchService;
        this.el = el;
        this.dialog = dialog;
        this.toastr = toastr;
        this.localstorage = localstorage;
        this.dateDayArray = [];
        this.disableSubmitButton = false;
        this.assigned = false;
        this.submited = false;
        this.supplieregdata = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.certificatehide = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.values = [];
        this.defaultValue = {
          hour: 13,
          minute: 30
        };
        this.paginationSet = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_10__["BgiJsonconfigServices"].bgiConfigData.configuration.enterpriseAdminPaginatonSet;
        this.MRM_CreatedOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.batchtraningdata_data = [];
        this.batchtraningdatapract_data = [];
        this.BatchtrainingData = ['selecteddate', 'schedule', 'startendtime'];
        this.availablepk = 64;
        this.BatchtrainingDatapract = ['selecteddate', 'schedule', 'startendtime'];
        this.selected2 = moment__WEBPACK_IMPORTED_MODULE_14___default()();
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        /* Override the label of the ok button. */

        this.okLabel = 'Ok';
        /* Override the label of the cancel button. */

        this.cancelLabel = 'Cancel';
        /** Override the ante meridiem abbreviation. */

        this.anteMeridiemAbbreviation = 'am';
        /** Override the post meridiem abbreviation. */

        this.postMeridiemAbbreviation = 'pm';
        /* Sets the clock mode, 12-hour or 24-hour clocks are supported. */

        this.mode = '24h';
        /* Set the color of the timepicker control */

        this.color = 'primary';
        /* Set the value of the timepicker control */

        /* ⚠️(when using template driven forms then you should use [ngModel]="someValue")⚠️ */

        this.value = new Date();
        /* Disables the dialog open when clicking the input field */

        this.disableDialogOpenOnClick = false;
        /* Strict mode checks the full date (Day/Month/Year Hours:Minutes) when doing the minDate maxDate validation. If you need to check only the Hours:Minutes then you can set it to false */

        this.strict = true;
        /* Emits when time has changed */

        this.timeChange = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        /* Emits when the input is invalid */

        this.invalidInput = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.locale = {
          format: 'DD-MM-YYYY'
        };
        this.ranges = {
          'Today': [moment__WEBPACK_IMPORTED_MODULE_14___default()(), moment__WEBPACK_IMPORTED_MODULE_14___default()()],
          'Yesterday': [moment__WEBPACK_IMPORTED_MODULE_14___default()().subtract(1, 'days'), moment__WEBPACK_IMPORTED_MODULE_14___default()().subtract(1, 'days')],
          'Last 7 Days': [moment__WEBPACK_IMPORTED_MODULE_14___default()().subtract(6, 'days'), moment__WEBPACK_IMPORTED_MODULE_14___default()()],
          'Last 30 Days': [moment__WEBPACK_IMPORTED_MODULE_14___default()().subtract(29, 'days'), moment__WEBPACK_IMPORTED_MODULE_14___default()()],
          'This Month': [moment__WEBPACK_IMPORTED_MODULE_14___default()().startOf('month'), moment__WEBPACK_IMPORTED_MODULE_14___default()().endOf('month')],
          'Last Month': [moment__WEBPACK_IMPORTED_MODULE_14___default()().subtract(1, 'month').startOf('month'), moment__WEBPACK_IMPORTED_MODULE_14___default()().subtract(1, 'month').endOf('month')]
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
        this.dir = 'ltr';
        this.date = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.select = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.startDate = new Date('2023-02-23');
        this.endDate = new Date('2023-02-28');
        this.days2 = ['Sunday', 'Wednesday'];
        this.startTime = '10:30';
        this.endTime = '11:30';
        this.formattedTime = '00:00';
        this.dateFilterSt = '';
        this.dateFilterEd = '';
        this.daterange = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required);
        this.dateFilterStpractical = '';
        this.dateFilterEdpractical = '';
        this.daterangepractical = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required);
        this.formattedTimed = '00:00';
        this.alwaysShowCalendars = true;
        this.timeform = this.fb.group({
          employees: this.fb.array([this.newEmployee()])
        });
        this.userForm = this.fb.group({
          phones: this.fb.array([this.fb.control(null)])
        });
        this.userpractForm = this.fb.group({
          pract: this.fb.array([this.fb.control(null)])
        });
      }

      _createClass(BatchcreationpageComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this = this;

          this.batchform = this.fb.group({
            office_type: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            bran_ch: ['', ''],
            stdcoursedtlsmstpk: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            stdcoursedtlsdltspk: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            coursedtlmainpk: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            stdcoursedtlsmainpk: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            trainingevlocenter: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            applicatiomainpk: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            cour_cate: ['', ''],
            cour_subcate: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            batchtype: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            assmntlanauge: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            theorybatchlimit: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            particalbatchlimit: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            assesmentbatchlimit: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            days: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            dayspract: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            assessmentdate: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            tutor: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            tutorone: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            assessor: ['', ''],
            assessorarr: this.fb.array([this.createItem()]),
            ivqastaff: ['', ''],
            starttimeassessment: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            endtimeasssessment: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            slots: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            practslots: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            available: ['', ''],
            availabledates: ['', '']
          });
          this.userForm = this.fb.group({
            sstartdata: [''],
            senddata: ['']
          });
          this.userpractForm = this.fb.group({
            sstarttimepract: [''],
            sendtimepract: ['']
          });
          this.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](this.batchtraningdata_data);
          this.batchtrainingdatapract = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](this.batchtraningdatapract_data);

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
          this.stktype = this.localstorage.getInLocal('omrm_stkholdertypmst_fk');
          this.regtype = this.localstorage.getInLocal('regtype');
          this.regpk = this.localstorage.getInLocal('registerPk');
          this.getTrainingEvalutionCentres();
          this.getCoursesCatagories();
          this.getTutorslist();
          this.getmasterlist();

          if (this.batchid) {
            this.getBatchdetails(this.batchid);
          }
        }
      }, {
        key: "createItem",
        value: function createItem() {
          return this.fb.group({
            assessor: [''],
            IVQAStaff: ['']
          });
        }
      }, {
        key: "addItem",
        value: function addItem() {
          this.arr = this.batchform.get('assessorarr');
          this.arr.push(this.createItem());
        }
      }, {
        key: "addPhone",
        value: function addPhone(rowindex) {
          var dataArray = this.batchtrainingdata.data;
          var selectedindex = dataArray[rowindex];
          selectedindex.subarr.push({
            sstartdata: null,
            senddata: null
          });
          this.batchtrainingdata.data = dataArray;
          this.table.renderRows();
        }
      }, {
        key: "removePhone",
        value: function removePhone(index, rowindex) {
          var dataArray = this.batchtrainingdata.data;
          var selectedindex = dataArray[rowindex];
          var subselectedindex = selectedindex.subarr; // console.log('subarrayindex',selectedindex,subselectedindex);

          selectedindex.subarr.splice(index, 1);
          this.batchtrainingdata.data = dataArray;
          this.table.renderRows();
        }
      }, {
        key: "getPhonesFormControls",
        value: function getPhonesFormControls() {
          return this.userForm.get('phones').controls;
        }
      }, {
        key: "calculateTimeDifference",
        value: function calculateTimeDifference(z, i, id) {
          var excel = this.batchtraningdata_data;
          setTimeout(function () {
            var endMilliseconds = document.getElementById('to' + z + i).value;
            var startMilliseconds = document.getElementById('form' + z + i).value;
            document.getElementById('difference' + z + i).innerHTML = '00:00';
            var timeParts = startMilliseconds.split(':');
            var timetwo = endMilliseconds.split(':'); // console.log(timeParts)
            // console.log(timetwo);

            var startTime = new Date();
            startTime.setHours(parseInt(timeParts[0], 10));
            startTime.setMinutes(parseInt(timeParts[1], 10));
            var endTime = new Date();
            endTime.setHours(parseInt(timetwo[0], 10));
            endTime.setMinutes(parseInt(timetwo[1], 10));
            var totalMilliseconds = endTime.getTime() - startTime.getTime();
            var hours = Math.floor(totalMilliseconds / 3600000);
            var minutes = Math.floor(totalMilliseconds % 3600000 / 60000);
            this.formattedTime = "".concat(hours, ":").concat(minutes);
            document.getElementById('difference' + z + i).innerHTML = this.formattedTime;
            excel[id - 1].subarr[i].sstartdata = startTime.getTime();
            excel[id - 1].subarr[i].senddata = endTime.getTime();
            this.batchtraningdata_data = excel;
            console.log(this.batchtraningdata_data);
            return false;
          }, 300);
        }
      }, {
        key: "cour",
        get: function get() {
          return this.batchform.controls;
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
          } catch (error) {// // console.log('page-content')
          }
        }
        /*createPtGroup() {
          return this.fb.group({
            date:[null],
            available: [null],
            starttime: [null],
          });
        }*/

      }, {
        key: "checkData",
        value: function checkData(id, value, type) {
          if (type == 'theory') {
            this.batchtraningdata_data[id - 1].schedule = value;
            this.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](this.batchtraningdata_data);
            this.table.renderRows();
          }

          if (type == 'pract') {
            this.batchtraningdatapract_data[id - 1].schedule = value;
            this.batchtrainingdatapract = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](this.batchtraningdatapract_data);
            this.tablepract.renderRows();
          }
        }
      }, {
        key: "employees",
        value: function employees(value) {
          return this.timeform.get('employees');
        }
      }, {
        key: "newEmployee",
        value: function newEmployee() {
          return this.fb.group({
            pslabel: [null]
          });
        }
      }, {
        key: "addEmployee",
        value: function addEmployee(value) {
          // console.log(value);
          this.employees(value).push(this.newEmployee());
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

          for (var _i = 0, _arr = arr; _i < _arr.length; _i++) {
            var val = _arr[_i];
            var fullDateFormat = val;
            var obj = {
              date: fullDateFormat.getTime(),
              day: val.toLocaleDateString('en-US', {
                weekday: 'long'
              }),
              selecteddate: val.toLocaleDateString('en-US', {
                weekday: 'short'
              }) + ' ' + moment__WEBPACK_IMPORTED_MODULE_14___default()(fullDateFormat).format('DD-MM-YYYY'),
              id: i,
              schedule: 1,
              subarr: []
            };
            this.batchtraningdata_data.push(obj);
            this.cour.slots.setValue(this.batchtraningdata_data); // console.log(this.batchtraningdata_data);

            i++;
          }

          this.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](this.batchtraningdata_data);
          this.batchform.controls['days'].setValue(this.batchtraningdata_data.length);
          this.cour.slots.setValue(this.batchtraningdata_data);
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
        }
      }, {
        key: "getBatchdetails",
        value: function getBatchdetails(bid) {
          var _this2 = this;

          var encbid = this.security.encrypt(bid);
          this.batchService.fetchBatchdetails(encbid).subscribe(function (response) {
            if (response.data.status) {
              _this2.regpk = response.data.trainingevlocenter;

              _this2.selectedTrainingCentre(_this2.regpk);

              _this2.batchform.patchValue({
                office_type: Number(response.data.office_type),
                bran_ch: response.data.branchpk,
                stdcoursedtlsmstpk: response.data.stdcoursedtlsmstpk,
                stdcoursedtlsdltspk: response.data.stdcoursedtlsdltspk,
                coursedtlmainpk: response.data.coursedtlmainpk,
                stdcoursedtlsmainpk: response.data.stdcoursedtlsmainpk,
                trainingevlocenter: response.data.trainingevlocenter,
                applicatiomainpk: response.data.applicatiomainpk,
                cour_cate: response.data.cour_cate,
                cour_subcate: response.data.cour_subcate,
                days: response.data.days,
                dayspract: response.data.dayspract,
                batchtype: response.data.bmd_batchtype,
                assmntlanauge: response.data.assmntlanauge,
                assessmentdate: response.data.assessmentdate,
                tutor: response.data.tutor
              });

              _this2.getsubcategorylist(response.data.cour_cate);
            }
          });
          console.log(this.batchform.value);
        }
      }, {
        key: "lessons",
        get: function get() {
          return this.batchform.controls["lessons"];
        }
      }, {
        key: "addLesson",
        value: function addLesson(i, event) {
          // console.log(event + "valuearray");
          this.batchform.get('lessons').at(i).get('title').setValue(event.value);
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
            this.batchtraningdata_data = [];
            var startvaldate = new Date(moment__WEBPACK_IMPORTED_MODULE_14___default()(this.daterange.value.startDate).format('YYYY-MM-DD'));
            var endvaldate = new Date(moment__WEBPACK_IMPORTED_MODULE_14___default()(this.daterange.value.endDate).format('YYYY-MM-DD'));
            this.getDateArray(startvaldate, endvaldate);
          }
        }
      }, {
        key: "cleartable",
        value: function cleartable() {
          this.batchtraningdata_data = [];
        }
      }, {
        key: "backdata",
        value: function backdata() {
          var _this3 = this;

          sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
            title: this.i18n('course.doyouwantbatch'),
            text: '',
            icon: 'warning',
            buttons: [this.i18n('course.no'), this.i18n('course.yes')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(function (willGoBack) {
            if (willGoBack) {
              _this3.scrollTo('pagescroll');

              _this3.supplieregdata.emit(true);

              _this3.certificatehide.emit(false);
            }
          });
        }
      }, {
        key: "getmasterlist",
        value: function getmasterlist() {
          var _this4 = this;

          this.batchService.getmasterlist().subscribe(function (response) {
            if (response.data.status == 1) {
              _this4.batchtypelist = response.data.data.batch;
              _this4.tutorlanglist = response.data.data.lang;
              _this4.dayschedulelist = response.data.data.dayschedule;

              _this4.dayschedulelist.forEach(function (element) {
                if (element.name_en == 'Available') _this4.availablepk = element.pk;
              });
            } else {
              _this4.batchtypelist = null;
              _this4.tutorlanglist = null;
              _this4.dayschedulelist = null;
            }
          });
        }
      }, {
        key: "getTutorslist",
        value: function getTutorslist() {
          var _this5 = this;

          var encregpk = this.security.encrypt(this.regpk);
          this.batchService.gettutorlist(encregpk).subscribe(function (response) {
            if (response.data.status == 1) {
              _this5.tutorlist = response.data.data.tutors;
              _this5.accessorslist = response.data.data.accessors;
            } else {
              _this5.tutorlist = null;
              _this5.accessorslist = null;
            }
          });
        }
      }, {
        key: "getTutorAvailabilityList",
        value: function getTutorAvailabilityList() {
          var _this6 = this;

          var body = JSON.stringify({
            language: this.cour.assmntlanauge.value,
            subcategory: this.cour.cour_subcate.value,
            duration: this.cour.slots.value
          });
          this.batchService.gettutoravailabilitylist(body).subscribe(function (response) {
            if (response.data.status == 1) {
              _this6.tutorlist = response.data.data.tutors;
            }
          });
        }
      }, {
        key: "selectIVQAStaff",
        value: function selectIVQAStaff(value, key) {
          var _this7 = this;

          console.log(value + '   ' + key);
          var encregpk = this.security.encrypt(value);
          this.batchService.getIVQAStaffByAssessor(encregpk).subscribe(function (response) {
            if (response.data.status == 1) {
              _this7.ivqastafflist = response.data.data;
              _this7.assigned = false;
            } else if (response.data.status == 3) {
              console.log(response.data.data);
              var array = _this7.cour.assessorarr.value;
              Object.keys(array).forEach(function (keys) {
                if (keys == key) {
                  array[key].IVQAStaff = response.data.data.pk;
                  _this7.assigned = true;
                }
              });

              _this7.cour.assessorarr.setValue(array);
            } else {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: 'No IVQA Staff found for the selected accessor',
                text: '',
                icon: 'warning',
                dangerMode: true,
                closeOnClickOutside: false
              });
              _this7.assigned = false;
            }
          });
        }
      }, {
        key: "batchAdd",
        value: function batchAdd() {
          var _this8 = this;

          this.submited = true;

          if (this.batchform.valid) {
            sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
              title: this.i18n('course.doyouwantsubm'),
              text: '',
              icon: 'warning',
              buttons: [this.i18n('course.no'), this.i18n('course.yes')],
              dangerMode: true,
              closeOnClickOutside: false
            }).then(function (willGoBack) {
              if (willGoBack) {
                _this8.submitData(_this8.batchform.value);
              }
            });
            return;
          }

          this.scrollTo('pagescroll');
        }
      }, {
        key: "clearRecordData",
        value: function clearRecordData(value) {
          var _this9 = this;

          this.batchtraningdata_data.forEach(function (z) {
            if (z.id === value) {
              console.log('fgfgs');

              _this9.batchtraningdata_data.splice(value - 1, 1);

              var obj = {
                date: z.date,
                day: z.day,
                selecteddate: z.selecteddate,
                id: value,
                schedule: '',
                subarr: []
              };

              _this9.batchtraningdata_data.splice(value - 1, 0, obj);

              _this9.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](_this9.batchtraningdata_data);

              _this9.batchform.controls['days'].setValue(_this9.batchtraningdata_data.length);

              _this9.cour.slots.setValue(_this9.batchtraningdata_data);

              console.log(_this9.batchtraningdata_data);

              _this9.getSelectedDayArray();
            }
          });
        }
      }, {
        key: "submitData",
        value: function submitData(formvalue) {
          var _this10 = this;

          this.cour.slots.setValue(this.batchtraningdata_data);
          this.cour.practslots.setValue(this.batchtraningdatapract_data); // this.disableSubmitButton = true ;

          this.batchService.saveBatchData(formvalue).subscribe(function (data) {
            if (data.data.status == 2) {
              _this10.toastr.success('Batch created successfully', ''), {
                timeOut: 2000,
                closeButton: false
              };
            }

            _this10.disableSubmitButton = false;
          });
        }
      }, {
        key: "getCoursesCatagories",
        value: function getCoursesCatagories() {
          var _this11 = this;

          this.batchService.getcatlist().subscribe(function (response) {
            if (response.data.status == 1) {
              _this11.categorylist = response.data.data;
            } else {
              _this11.categorylist = null;
            }
          });
        }
      }, {
        key: "getTrainingEvalutionCentres",
        value: function getTrainingEvalutionCentres() {
          var _this12 = this;

          this.batchService.getTrainingEvalutionCentres().subscribe(function (response) {
            if (response.data.status == 1) {
              _this12.trainingEvalutionCentrelist = response.data.data;

              _this12.trainingEvalutionCentrelist.forEach(function (z) {
                if (z.regpk == _this12.regpk) {
                  _this12.cour.trainingevlocenter.setValue(_this12.regpk);

                  _this12.cour.applicatiomainpk.setValue(z.appmainpk);

                  _this12.getBranchlist(_this12.regpk);

                  _this12.mainoffappmainPk = z.appmainpk;

                  _this12.cour.office_type.setValue(1);

                  _this12.selectOffice(1);
                }
              });
            } else {
              _this12.trainingEvalutionCentrelist = null;
            }
          });
        }
      }, {
        key: "selectedBranchDtl",
        value: function selectedBranchDtl(value) {
          var _this13 = this;

          this.branchlist.forEach(function (z) {
            if (z.appmainpk === value) {
              _this13.cour.applicatiomainpk.setValue(z.appmainpk);

              _this13.branchappmainPk = z.appmainpk;

              _this13.selectOffice(2);
            }
          });
        }
      }, {
        key: "selectOffice",
        value: function selectOffice(value) {
          if (value == 1) {
            this.getStdCourses(this.mainoffappmainPk);
            this.cour.applicatiomainpk.setValue(this.mainoffappmainPk);
          } else {
            if (this.branchappmainPk) {
              this.getStdCourses(this.branchappmainPk);
              this.cour.applicatiomainpk.setValue(this.branchappmainPk);
            }
          }
        }
      }, {
        key: "getBranchlist",
        value: function getBranchlist(regpk) {
          var _this14 = this;

          var encregpk = this.security.encrypt(regpk);
          this.batchService.getBranchlistbyregpk(encregpk).subscribe(function (response) {
            if (response.data.status == 1) {
              _this14.branchlist = response.data.data;
            } else {
              _this14.branchlist = null;
            }
          });
        }
      }, {
        key: "getStdCourses",
        value: function getStdCourses(value) {
          var _this15 = this;

          var encregpk = this.security.encrypt(value);
          this.batchService.getStdCoursesByAppPk(encregpk).subscribe(function (response) {
            if (response.data.status == 1) {
              _this15.courselist = response.data.data;
              console.log(_this15.courselist);
            } else {
              _this15.courselist = null;
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: 'No course Found for the application',
                text: '',
                icon: 'warning',
                dangerMode: true,
                closeOnClickOutside: false
              });
            }
          });
        }
      }, {
        key: "selectedCourseDtls",
        value: function selectedCourseDtls(value) {
          var _this16 = this;

          this.courselist.forEach(function (z) {
            if (z.pk == value) {
              _this16.selectedTrCentr = z.course_en;

              _this16.cour.coursedtlmainpk.setValue(z.appcoursemainpk);

              _this16.cour.stdcoursedtlsmainpk.setValue(z.stdcoursedtlsmainpk);

              _this16.cour.cour_cate.setValue(z.scm_coursecategorymst_fk);

              _this16.getsubcategorylist(z.scm_coursecategorymst_fk);
            }
          });
        }
      }, {
        key: "getsubcategorylist",
        value: function getsubcategorylist(value) {
          var _this17 = this;

          var catPk = this.security.encrypt(value);
          this.batchService.getsubcatlistbycatpk(catPk).subscribe(function (response) {
            if (response.data.status == 1) {
              _this17.subcategorylist = response.data.data;

              if (_this17.cour.cour_cate.value) {
                _this17.selectedSubCat(_this17.cour.cour_cate.value);
              }
            } else {
              _this17.subcategorylist = null;
            }
          });
        }
      }, {
        key: "selectedSubCat",
        value: function selectedSubCat(value) {
          var _this18 = this;

          console.log(this.subcategorylist);
          this.subcategorylist.forEach(function (z) {
            if (z.coursecategorymst_pk == value) {
              _this18.cour.cour_subcate.setValue(value);

              _this18.getcoursedtls(value);
            }
          });
        }
      }, {
        key: "getcoursedtls",
        value: function getcoursedtls(subcatpk) {
          var _this19 = this;

          var ensubcatpk = this.security.encrypt(subcatpk);
          this.batchService.getCourseDtlsbysubcatpk(ensubcatpk).subscribe(function (res) {
            if (res.data.status == 1) {
              _this19.cour.stdcoursedtlsdltspk.setValue(res.data.data.pk);

              var theorylimit = Number(res.data.data.thyclasslimit);
              var practcallimit = Number(res.data.data.practclasslimit);
              var assessmentlimit = Number(res.data.data.asmtbatchlimit);

              _this19.batchform.patchValue({
                stdcoursedtlsdltspk: res.data.data.pk,
                theorybatchlimit: theorylimit,
                particalbatchlimit: practcallimit,
                assesmentbatchlimit: assessmentlimit
              });

              if (theorylimit / assessmentlimit != 1) {
                _this19.assessorcount = theorylimit % assessmentlimit == 0 ? theorylimit / assessmentlimit : theorylimit / assessmentlimit + 1;

                for (var i = 1; i < _this19.assessorcount; i++) {
                  _this19.addItem();
                }
              }

              if (theorylimit / assessmentlimit != 1) {
                _this19.tutorcount = theorylimit % practcallimit == 0 ? theorylimit / practcallimit : theorylimit / practcallimit + 1;

                if (_this19.tutorcount > _this19.tutorlist.length) {
                  sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                    title: 'The no. of available tutors is less the the required no. of tutors.',
                    text: '',
                    icon: 'warning',
                    dangerMode: true,
                    closeOnClickOutside: false
                  });
                }
              }
            } else {
              sweetalert__WEBPACK_IMPORTED_MODULE_17___default()({
                title: 'No course found for the selected subcatecory',
                text: '',
                icon: 'warning',
                dangerMode: true,
                closeOnClickOutside: false
              });
            }
          });
        }
      }, {
        key: "selectedTrainingCentre",
        value: function selectedTrainingCentre(value) {
          var _this20 = this;

          this.trainingEvalutionCentrelist.forEach(function (z) {
            if (z.regpk == value) {
              _this20.selectedTrCentr = z.compname_en;

              _this20.cour.applicatiomainpk.setValue(z.appmainpk);

              _this20.getBranchlist(value);

              _this20.getStdCourses(z.appmainpk);
            }
          });
        }
      }, {
        key: "addbatchdatatime",
        value: function addbatchdatatime(data, ps) {// console.log(ps);
        }
      }, {
        key: "clickEvent",
        value: function clickEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = this.i18n('course.showfilt');
            var id = document.getElementById('searchrow');
            id.style.display = 'none';
          } else {
            this.filtername = this.i18n('course.hidefilt');

            var _id = document.getElementById('searchrow');

            _id.style.display = 'flex';
          }
        }
      }, {
        key: "opendialogquicksetup",
        value: function opendialogquicksetup() {
          var dialogRef = this.dialog.open(Modalquicksetup, {
            disableClose: true,
            panelClass: 'quicksetuplist'
          }); //dialogRef.componentInstance.drawer = this.drawercontactus;

          dialogRef.afterClosed().subscribe(function (result) {});
        } //practical

      }, {
        key: "getDateArraypract",
        value: function getDateArraypract(startvaldatepract, endvaldatepract) {
          // console.log('testfunction')
          var arr = [];
          var dt = new Date(startvaldatepract);

          while (dt <= endvaldatepract) {
            arr.push(new Date(dt));
            dt.setDate(dt.getDate() + 1);
          }

          var i = 1;

          for (var _i2 = 0, _arr2 = arr; _i2 < _arr2.length; _i2++) {
            var val = _arr2[_i2];
            var fullDateFormat = val;
            var obj = {
              date: fullDateFormat.getTime(),
              day: val.toLocaleDateString('en-US', {
                weekday: 'long'
              }),
              selecteddate: val.toLocaleDateString('en-US', {
                weekday: 'short'
              }) + ' ' + moment__WEBPACK_IMPORTED_MODULE_14___default()(fullDateFormat).format('DD-MM-YYYY'),
              id: i,
              schedule: 1,
              subarrpract: []
            };
            this.batchtraningdatapract_data.push(obj);
            this.cour.practslots.setValue(this.batchtraningdatapract_data);
            i++;
          } // console.log(this.batchtraningdatapract_data, 'test')


          this.batchtrainingdatapract = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](this.batchtraningdatapract_data);
          this.batchform.controls['dayspract'].setValue(this.batchtraningdatapract_data.length);
          this.cour.practslots.setValue(this.batchtraningdatapract_data);
          this.getSelectedDayArraypract();
        }
      }, {
        key: "getSelectedDayArraypract",
        value: function getSelectedDayArraypract() {
          // console.log(this.batchtraningdatapract_data);
          var selectedDayArray = [];

          var _iterator3 = _createForOfIteratorHelper(this.days2),
              _step3;

          try {
            for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
              var day = _step3.value;

              var _iterator4 = _createForOfIteratorHelper(this.batchtraningdatapract_data),
                  _step4;

              try {
                for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
                  var val = _step4.value;

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
                _iterator4.e(err);
              } finally {
                _iterator4.f();
              }
            } // console.log(selectedDayArray);

          } catch (err) {
            _iterator3.e(err);
          } finally {
            _iterator3.f();
          }
        }
      }, {
        key: "dateFltrChangepractical",
        value: function dateFltrChangepractical(event) {
          // console.log('datepickertest')
          var stDate = '';
          var edDate = '';
          this.dateFilterStpractical = '';
          this.dateFilterEdpractical = '';

          if (this.daterangepractical.value) {
            // console.log('works')
            this.batchtraningdatapract_data = [];
            var startvaldatepract = new Date(moment__WEBPACK_IMPORTED_MODULE_14___default()(this.daterangepractical.value.startDate).format('YYYY-MM-DD'));
            var endvaldatepract = new Date(moment__WEBPACK_IMPORTED_MODULE_14___default()(this.daterangepractical.value.endDate).format('YYYY-MM-DD'));
            this.getDateArraypract(startvaldatepract, endvaldatepract);
          }
        }
      }, {
        key: "cleartablepractical",
        value: function cleartablepractical() {
          this.batchtraningdatapract_data = [];
        }
      }, {
        key: "calculateTimeDifferencepract",
        value: function calculateTimeDifferencepract(p, i, id) {
          var excelpract = this.batchtraningdatapract_data;
          setTimeout(function () {
            var endMilliseconds = document.getElementById('to' + p + i).value;
            var startMilliseconds = document.getElementById('form' + p + i).value;
            document.getElementById('difference' + p + i).innerHTML = '00:00';
            var timeParts = startMilliseconds.split(':');
            var timetwo = endMilliseconds.split(':'); // console.log(timeParts)
            // console.log(timetwo);

            var startTime = new Date();
            startTime.setHours(parseInt(timeParts[0], 10));
            startTime.setMinutes(parseInt(timeParts[1], 10));
            var endTime = new Date();
            endTime.setHours(parseInt(timetwo[0], 10));
            endTime.setMinutes(parseInt(timetwo[1], 10));
            var totalMilliseconds = endTime.getTime() - startTime.getTime();
            var hours = Math.floor(totalMilliseconds / 3600000);
            var minutes = Math.floor(totalMilliseconds % 3600000 / 60000);
            this.formattedTimed = "".concat(hours, ":").concat(minutes);
            document.getElementById('difference' + p + i).innerHTML = this.formattedTimed;
            excelpract[id - 1].subarrpract[i].sstartdata = startTime.getTime();
            excelpract[id - 1].subarrpract[i].senddata = endTime.getTime();
            this.batchtraningdatapract_data = excelpract;
            return false;
          }, 300);
        }
      }, {
        key: "addPract",
        value: function addPract(rowindex) {
          var dataArray = this.batchtrainingdatapract.data;
          var selectedindex = dataArray[rowindex];
          selectedindex.subarrpract.push({
            sstartdata: null,
            senddata: null
          });
          this.batchtrainingdatapract.data = dataArray;
          this.tablepract.renderRows();
        }
      }, {
        key: "removePract",
        value: function removePract(index, rowindex) {
          var dataArray = this.batchtrainingdatapract.data;
          var selectedindex = dataArray[rowindex];
          var subselectedindex = selectedindex.subarrpract; // console.log('subarrayindex',selectedindex,subselectedindex);

          selectedindex.subarrpract.splice(index, 1);
          this.batchtrainingdatapract.data = dataArray;
          this.tablepract.renderRows();
        }
      }, {
        key: "getpractFormControls",
        value: function getpractFormControls() {
          return this.userpractForm.get('pract').controls;
        }
      }, {
        key: "checkassessoravailabilty",
        value: function checkassessoravailabilty(date) {
          var _this21 = this;

          var encdate = this.security.encrypt(date.getTime());
          console.log(encdate);
          this.batchService.checkassessoravailabilty(encdate, this.cour.coursedtlmainpk.value, this.cour.assmntlanauge.value).subscribe(function (response) {
            if (response.data.status == 1) {
              _this21.accessorslist = response.data.data;
            } else {
              _this21.accessorslist = null;
            }
          });
        }
      }]);

      return BatchcreationpageComponent;
    }();

    BatchcreationpageComponent.ctorParameters = function () {
      return [{
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_11__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_15__["CookieService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_7__["ActivatedRoute"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__["Encrypt"]
      }, {
        type: _app_services_batch_service__WEBPACK_IMPORTED_MODULE_12__["BatchService"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_4__["MatDialog"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_16__["ToastrService"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('batchid'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], BatchcreationpageComponent.prototype, "batchid", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "supplieregdata", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "certificatehide", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_5__["MatPaginator"])], BatchcreationpageComponent.prototype, "paginator", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTable"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTable"])], BatchcreationpageComponent.prototype, "table", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTable"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTable"])], BatchcreationpageComponent.prototype, "tablepract", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "okLabel", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "cancelLabel", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "anteMeridiemAbbreviation", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "postMeridiemAbbreviation", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], BatchcreationpageComponent.prototype, "mode", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)], BatchcreationpageComponent.prototype, "color", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Date)], BatchcreationpageComponent.prototype, "value", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Date)], BatchcreationpageComponent.prototype, "minDate", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Date)], BatchcreationpageComponent.prototype, "maxDate", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "disableDialogOpenOnClick", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_core__WEBPACK_IMPORTED_MODULE_3__["ErrorStateMatcher"])], BatchcreationpageComponent.prototype, "errorStateMatcher", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "strict", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"])], BatchcreationpageComponent.prototype, "timeChange", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"])], BatchcreationpageComponent.prototype, "invalidInput", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)], BatchcreationpageComponent.prototype, "startDateInput", void 0);
    BatchcreationpageComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-batchcreationpage',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./batchcreationpage.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchcreationpage/batchcreationpage.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./batchcreationpage.component.scss */
      "./src/app/modules/batch/batchcreationpage/batchcreationpage.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_11__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_15__["CookieService"], _angular_router__WEBPACK_IMPORTED_MODULE_7__["ActivatedRoute"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__["Encrypt"], _app_services_batch_service__WEBPACK_IMPORTED_MODULE_12__["BatchService"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_4__["MatDialog"], ngx_toastr__WEBPACK_IMPORTED_MODULE_16__["ToastrService"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"]])], BatchcreationpageComponent);
    var quickset_data = [{
      position: 1
    }];

    var Modalquicksetup = /*#__PURE__*/function () {
      function Modalquicksetup(dialogRef, remoteService, el, translate, cookieService, fb, data) {
        _classCallCheck(this, Modalquicksetup);

        this.dialogRef = dialogRef;
        this.remoteService = remoteService;
        this.el = el;
        this.translate = translate;
        this.cookieService = cookieService;
        this.fb = fb;
        this.data = data;
        this.quicksetupdatalist = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](quickset_data);
        this.quicksetupcolumn = ['days', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        this.lang = '1';
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

      _createClass(Modalquicksetup, [{
        key: "cour",
        get: function get() {
          return this.batchform.controls;
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this22 = this;

          this.batchform = this.fb.group({
            starttime: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            endtime: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            employees: ['', '']
          });

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this22.cookieService.get('languageCookieId');
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
        }
      }, {
        key: "employees",
        value: function employees() {
          return this.batchform.get('employees');
        }
      }, {
        key: "newEmployee",
        value: function newEmployee() {
          return this.fb.group({
            starttime: [null, ''],
            endtime: [null, ''],
            weekend: ['', '']
          });
        }
      }, {
        key: "closedialog",
        value: function closedialog() {
          this.dialogRef.close();
        }
      }, {
        key: "addEmployee",
        value: function addEmployee() {
          this.employees().push(this.newEmployee());
        }
      }, {
        key: "removeEmployee",
        value: function removeEmployee(empIndex) {
          this.employees().removeAt(empIndex);
        }
      }]);

      return Modalquicksetup;
    }();

    Modalquicksetup.ctorParameters = function () {
      return [{
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_4__["MatDialogRef"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_11__["RemoteService"]
      }, {
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__["TranslateService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_15__["CookieService"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: undefined,
        decorators: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"],
          args: [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_4__["MAT_DIALOG_DATA"]]
        }]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('scroll', {
      read: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])], Modalquicksetup.prototype, "scroll", void 0);
    Modalquicksetup = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'modalquicksetup',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./modalquicksetup.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchcreationpage/modalquicksetup.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./modalquicksetup.scss */
      "./src/app/modules/batch/batchcreationpage/modalquicksetup.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__param"])(6, Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"])(_angular_material_dialog__WEBPACK_IMPORTED_MODULE_4__["MAT_DIALOG_DATA"])), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_4__["MatDialogRef"], _app_remote_service__WEBPACK_IMPORTED_MODULE_11__["RemoteService"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_13__["TranslateService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_15__["CookieService"], _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], Object])], Modalquicksetup);

    function getDay() {
      throw new Error('Function not implemented.');
    }
    /***/

  },

  /***/
  "./src/app/modules/batch/batchcreationpage/modalquicksetup.scss":
  /*!**********************************************************************!*\
    !*** ./src/app/modules/batch/batchcreationpage/modalquicksetup.scss ***!
    \**********************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesBatchBatchcreationpageModalquicksetupScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".quicksetuplist .mat-dialog-container {\n  padding: 0px !important;\n}\n.quicksetuplist #traininglistpopup .clearbtn, .quicksetuplist #traininglistpopup .savebtn {\n  min-width: 65px;\n  background-color: #fff;\n  color: #333;\n  border: 1px solid #c4c4c4;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 30px;\n  box-shadow: none;\n  line-height: 1;\n}\n.quicksetuplist #traininglistpopup .timepickerwidth {\n  max-width: 85px;\n}\n.quicksetuplist #traininglistpopup .timepickerwidth .mat-icon {\n  font-size: 20px;\n  color: #848484;\n}\n.quicksetuplist #traininglistpopup .slottag .mat-icon {\n  color: #848484;\n}\n.quicksetuplist #traininglistpopup .slottag span {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .mindaterangewidth {\n  min-width: 230px;\n}\n.quicksetuplist #traininglistpopup .savebtn {\n  background-color: #ed1c27 !important;\n  color: #fff !important;\n  border: none !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist {\n  border-top: 1px solid #ddd;\n  border-left: 1px solid #ddd;\n  border-right: 1px solid #ddd;\n}\n.quicksetuplist #traininglistpopup .summarytablelist mat-cell, .quicksetuplist #traininglistpopup .summarytablelist mat-header-cell, .quicksetuplist #traininglistpopup .summarytablelist mat-footer-cell {\n  flex: 1;\n  display: flex;\n  align-items: center;\n  overflow: inherit !important;\n  word-wrap: break-word;\n  min-height: inherit;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-row, .quicksetuplist #traininglistpopup .summarytablelist .mat-row {\n  min-height: 36px !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .daytopalign {\n  width: 100px;\n  background: #fff;\n  position: relative;\n  top: -18px;\n  overflow: inherit;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .daytopalign h4 {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .summarytablelist mat-cell:first-of-type, .quicksetuplist #traininglistpopup .summarytablelist mat-header-cell:first-of-type, .quicksetuplist #traininglistpopup .summarytablelist mat-footer-cell:first-of-type {\n  padding-left: 0px !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-cell {\n  font-size: 14px;\n  color: #262626 !important;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-cell, .quicksetuplist #traininglistpopup .summarytablelist .mat-cell {\n  text-align: center;\n  border-left: 1px solid #ddd;\n  justify-content: center;\n}\n.quicksetuplist #traininglistpopup .summarytablelist .mat-header-cell:first-child, .quicksetuplist #traininglistpopup .summarytablelist .mat-cell:first-child {\n  border-left: 0 !important;\n}\n.quicksetuplist #traininglistpopup .trainingdurationhead {\n  padding: 10px 25px;\n  background-color: #0c4b9a;\n  border-radius: 3px;\n}\n.quicksetuplist #traininglistpopup .trainingdurationhead .mat-icon {\n  color: #fff;\n}\n.quicksetuplist #traininglistpopup .trainingdurationhead h2 {\n  color: #fff;\n}\n.quicksetuplist #traininglistpopup .conftiming h4 {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .totalleanerheader p {\n  color: #848484;\n  padding-bottom: 4px;\n}\n.quicksetuplist #traininglistpopup .totalleanerheader span {\n  color: #262626;\n}\n.quicksetuplist #traininglistpopup .coursesubtitle .complantag {\n  border: 1px solid #ddd;\n  padding: 8px 10px;\n}\n.quicksetuplist #traininglistpopup .coursesubtitle p {\n  color: #848484;\n}\n.quicksetuplist #traininglistpopup .coursesubtitle span {\n  color: #262626;\n}\n@media (max-width: 699px) {\n  .rangewidthdateres {\n    display: block !important;\n  }\n\n  .mindaterangewidth {\n    padding-bottom: 10px;\n  }\n\n  .widthlangtitle {\n    padding-top: 15px;\n  }\n}\n@media (max-width: 768px) {\n  .summarytablelist {\n    position: relative;\n    z-index: 1;\n    display: block;\n    overflow-x: auto;\n    overflow-y: hidden;\n    background-color: #fff;\n    scroll-behavior: smooth;\n  }\n  .summarytablelist::-webkit-scrollbar {\n    width: 6px;\n    height: 5px;\n  }\n  .summarytablelist::-webkit-scrollbar-track {\n    background: #f1f1f1;\n  }\n  .summarytablelist::-webkit-scrollbar-thumb {\n    background: #ccc;\n    border-radius: 2px;\n  }\n  .summarytablelist::-webkit-scrollbar-thumb:hover {\n    background: #ccc;\n  }\n}\n@media (max-width: 768px) and (min-width: 766px) {\n  .widthrestitle {\n    max-width: 13% !important;\n  }\n\n  .widthlangtitle {\n    max-width: 87% !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9iYXRjaC9iYXRjaGNyZWF0aW9ucGFnZS9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxiYXRjaFxcYmF0Y2hjcmVhdGlvbnBhZ2VcXG1vZGFscXVpY2tzZXR1cC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2JhdGNoL2JhdGNoY3JlYXRpb25wYWdlL21vZGFscXVpY2tzZXR1cC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUVFO0VBQ0UsdUJBQUE7QUNESjtBRElRO0VBQ0ksZUFBQTtFQUNBLHNCQUFBO0VBQ0EsV0FBQTtFQUNBLHlCQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtFQUNBLGNBQUE7QUNGWjtBRElTO0VBQ0csZUFBQTtBQ0ZaO0FER1k7RUFDSSxlQUFBO0VBQ0EsY0FBQTtBQ0RoQjtBREthO0VBQ0csY0FBQTtBQ0hoQjtBREthO0VBQ0ksY0FBQTtBQ0hqQjtBRE1TO0VBQ0ksZ0JBQUE7QUNKYjtBRE1TO0VBRUcsb0NBQUE7RUFDQSxzQkFBQTtFQUNBLHVCQUFBO0FDTFo7QURRUTtFQUNJLDBCQUFBO0VBQ0EsMkJBQUE7RUFDQSw0QkFBQTtBQ05aO0FET1k7RUFDSSxPQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0VBQ0EsNEJBQUE7RUFDQSxxQkFBQTtFQUNBLG1CQUFBO0FDTGhCO0FET1U7RUFDRywyQkFBQTtBQ0xiO0FET1U7RUFDRSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxpQkFBQTtBQ0xaO0FETVk7RUFDSyxjQUFBO0FDSmpCO0FET1U7RUFDRSw0QkFBQTtBQ0xaO0FET1U7RUFDTSxlQUFBO0VBQ0EseUJBQUE7QUNMaEI7QURPVTtFQUNJLGtCQUFBO0VBQ0EsMkJBQUE7RUFDQSx1QkFBQTtBQ0xkO0FETWM7RUFDRyx5QkFBQTtBQ0pqQjtBRFNRO0VBQ0ksa0JBQUE7RUFDQSx5QkFBQTtFQUNBLGtCQUFBO0FDUFo7QURRWTtFQUNLLFdBQUE7QUNOakI7QURRWTtFQUNLLFdBQUE7QUNOakI7QURVVztFQUNDLGNBQUE7QUNSWjtBRFlRO0VBQ0csY0FBQTtFQUNBLG1CQUFBO0FDVlg7QURZUTtFQUNLLGNBQUE7QUNWYjtBRGNRO0VBQ00sc0JBQUE7RUFDQSxpQkFBQTtBQ1pkO0FEY1c7RUFDSyxjQUFBO0FDWmhCO0FEY1c7RUFDRSxjQUFBO0FDWmI7QURvQkE7RUFDRTtJQUNJLHlCQUFBO0VDakJKOztFRG1CQTtJQUNHLG9CQUFBO0VDaEJIOztFRGtCQTtJQUVFLGlCQUFBO0VDaEJGO0FBQ0Y7QURvQkE7RUFFRTtJQUNFLGtCQUFBO0lBQ0EsVUFBQTtJQUNBLGNBQUE7SUFDQSxnQkFBQTtJQUNBLGtCQUFBO0lBQ0Esc0JBQUE7SUFDQSx1QkFBQTtFQ25CRjtFRG9CRTtJQUNJLFVBQUE7SUFDQSxXQUFBO0VDbEJOO0VEcUJFO0lBQ0ksbUJBQUE7RUNuQk47RURzQkU7SUFDSSxnQkFBQTtJQUNBLGtCQUFBO0VDcEJOO0VEdUJFO0lBQ0ksZ0JBQUE7RUNyQk47QUFDRjtBRDBCQTtFQUNLO0lBQ0cseUJBQUE7RUN4Qk47O0VEMEJHO0lBQ0MseUJBQUE7RUN2Qko7QUFDRiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYmF0Y2gvYmF0Y2hjcmVhdGlvbnBhZ2UvbW9kYWxxdWlja3NldHVwLnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyJcclxuLnF1aWNrc2V0dXBsaXN0e1xyXG4gIC5tYXQtZGlhbG9nLWNvbnRhaW5lciB7XHJcbiAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgfVxyXG4gICAgI3RyYWluaW5nbGlzdHBvcHVwe1xyXG4gICAgICAgIC5jbGVhcmJ0biB7XHJcbiAgICAgICAgICAgIG1pbi13aWR0aDogNjVweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNjNGM0YzQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogMzBweDtcclxuICAgICAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDE7XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgLnRpbWVwaWNrZXJ3aWR0aHtcclxuICAgICAgICAgICAgbWF4LXdpZHRoOiA4NXB4O1xyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgIH1cclxuICAgICAgICAgLnNsb3R0YWd7XHJcbiAgICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDsgICBcclxuICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICB9XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgLm1pbmRhdGVyYW5nZXdpZHRoe1xyXG4gICAgICAgICAgICAgbWluLXdpZHRoOiAyMzBweDtcclxuICAgICAgICAgfVxyXG4gICAgICAgICAuc2F2ZWJ0bntcclxuICAgICAgICAgICAgQGV4dGVuZCAuY2xlYXJidG47XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICB9XHJcbiAgICAgICAgLnN1bW1hcnl0YWJsZWxpc3R7XHJcbiAgICAgICAgICAgIGJvcmRlci10b3A6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICBib3JkZXItbGVmdDogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgICAgIGJvcmRlci1yaWdodDogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgICAgIG1hdC1jZWxsLCBtYXQtaGVhZGVyLWNlbGwsIG1hdC1mb290ZXItY2VsbCB7XHJcbiAgICAgICAgICAgICAgICBmbGV4OiAxO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBvdmVyZmxvdzogaW5oZXJpdCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgd29yZC13cmFwOiBicmVhay13b3JkO1xyXG4gICAgICAgICAgICAgICAgbWluLWhlaWdodDogaW5oZXJpdDtcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIC5tYXQtaGVhZGVyLXJvdywgLm1hdC1yb3d7XHJcbiAgICAgICAgICAgICBtaW4taGVpZ2h0OiAzNnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgIC5kYXl0b3BhbGlnbntcclxuICAgICAgICAgICAgd2lkdGg6IDEwMHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmO1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgIHRvcDogLTE4cHg7XHJcbiAgICAgICAgICAgIG92ZXJmbG93OiBpbmhlcml0O1xyXG4gICAgICAgICAgICBoNHtcclxuICAgICAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgICAgbWF0LWNlbGw6Zmlyc3Qtb2YtdHlwZSwgbWF0LWhlYWRlci1jZWxsOmZpcnN0LW9mLXR5cGUsIG1hdC1mb290ZXItY2VsbDpmaXJzdC1vZi10eXBlIHtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDsgXHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgICAubWF0LWhlYWRlci1jZWxse1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNHB4IDtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwsIC5tYXQtY2VsbHtcclxuICAgICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICAgICY6Zmlyc3QtY2hpbGR7XHJcbiAgICAgICAgICAgICAgICAgYm9yZGVyLWxlZnQ6IDAgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICBcclxuICAgICAgICAudHJhaW5pbmdkdXJhdGlvbmhlYWR7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDEwcHggMjVweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4O1xyXG4gICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgaDJ7XHJcbiAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgIH1cclxuICAgICAgIC5jb25mdGltaW5ne1xyXG4gICAgICAgICAgIGg0e1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgIH0gICBcclxuICAgICAgIH1cclxuICAgICAgIC50b3RhbGxlYW5lcmhlYWRlcntcclxuICAgICAgICBwe1xyXG4gICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgIHBhZGRpbmctYm90dG9tOiA0cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgIC5jb3Vyc2VzdWJ0aXRsZXtcclxuICAgICAgICAuY29tcGxhbnRhZ3tcclxuICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICAgIHBhZGRpbmc6IDhweCAxMHB4O1xyXG4gICAgICAgIH1cclxuICAgICAgICAgICBwe1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICAgICAgICAgfVxyXG4gICAgICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICB9XHJcbiAgICAgICB9XHJcbiAgICAgICBcclxuICAgIH1cclxufVxyXG5cclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOiA2OTlweCkge1xyXG4gIC5yYW5nZXdpZHRoZGF0ZXJlc3tcclxuICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLm1pbmRhdGVyYW5nZXdpZHRoe1xyXG4gICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gIH1cclxuICAud2lkdGhsYW5ndGl0bGV7XHJcblxyXG4gICAgcGFkZGluZy10b3A6IDE1cHg7XHJcbiAgfVxyXG59XHJcblxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiBcclxuICAuc3VtbWFyeXRhYmxlbGlzdCB7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICB6LWluZGV4OiAxO1xyXG4gICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgb3ZlcmZsb3cteTogaGlkZGVuO1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoOyBcclxuICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICAgICAgICB3aWR0aDogNnB4O1xyXG4gICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgfVxyXG4gIFxyXG4gICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XHJcbiAgICB9XHJcbiAgXHJcbiAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICB9XHJcbiAgXHJcbiAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgIH1cclxuICB9XHJcbn1cclxuXHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIGFuZCAobWluLXdpZHRoOiA3NjZweCkge1xyXG4gICAgIC53aWR0aHJlc3RpdGxle1xyXG4gICAgICAgIG1heC13aWR0aDogMTMlICFpbXBvcnRhbnQ7XHJcbiAgICAgfVxyXG4gICAgIC53aWR0aGxhbmd0aXRsZXtcclxuICAgICAgbWF4LXdpZHRoOiA4NyUgIWltcG9ydGFudDtcclxuICAgfVxyXG59IiwiLnF1aWNrc2V0dXBsaXN0IC5tYXQtZGlhbG9nLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuY2xlYXJidG4sIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnNhdmVidG4ge1xuICBtaW4td2lkdGg6IDY1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGNvbG9yOiAjMzMzO1xuICBib3JkZXI6IDFweCBzb2xpZCAjYzRjNGM0O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDMwcHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG4gIGxpbmUtaGVpZ2h0OiAxO1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudGltZXBpY2tlcndpZHRoIHtcbiAgbWF4LXdpZHRoOiA4NXB4O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudGltZXBpY2tlcndpZHRoIC5tYXQtaWNvbiB7XG4gIGZvbnQtc2l6ZTogMjBweDtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zbG90dGFnIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc2xvdHRhZyBzcGFuIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5taW5kYXRlcmFuZ2V3aWR0aCB7XG4gIG1pbi13aWR0aDogMjMwcHg7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zYXZlYnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3Qge1xuICBib3JkZXItdG9wOiAxcHggc29saWQgI2RkZDtcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xuICBib3JkZXItcmlnaHQ6IDFweCBzb2xpZCAjZGRkO1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCBtYXQtY2VsbCwgLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCBtYXQtaGVhZGVyLWNlbGwsIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgbWF0LWZvb3Rlci1jZWxsIHtcbiAgZmxleDogMTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgb3ZlcmZsb3c6IGluaGVyaXQgIWltcG9ydGFudDtcbiAgd29yZC13cmFwOiBicmVhay13b3JkO1xuICBtaW4taGVpZ2h0OiBpbmhlcml0O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWhlYWRlci1yb3csIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgLm1hdC1yb3cge1xuICBtaW4taGVpZ2h0OiAzNnB4ICFpbXBvcnRhbnQ7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zdW1tYXJ5dGFibGVsaXN0IC5kYXl0b3BhbGlnbiB7XG4gIHdpZHRoOiAxMDBweDtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0b3A6IC0xOHB4O1xuICBvdmVyZmxvdzogaW5oZXJpdDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgLmRheXRvcGFsaWduIGg0IHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zdW1tYXJ5dGFibGVsaXN0IG1hdC1jZWxsOmZpcnN0LW9mLXR5cGUsIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgbWF0LWhlYWRlci1jZWxsOmZpcnN0LW9mLXR5cGUsIC5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgbWF0LWZvb3Rlci1jZWxsOmZpcnN0LW9mLXR5cGUge1xuICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWhlYWRlci1jZWxsIHtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBjb2xvcjogIzI2MjYyNiAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWhlYWRlci1jZWxsLCAucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5zdW1tYXJ5dGFibGVsaXN0IC5tYXQtY2VsbCB7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgYm9yZGVyLWxlZnQ6IDFweCBzb2xpZCAjZGRkO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnN1bW1hcnl0YWJsZWxpc3QgLm1hdC1oZWFkZXItY2VsbDpmaXJzdC1jaGlsZCwgLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAuc3VtbWFyeXRhYmxlbGlzdCAubWF0LWNlbGw6Zmlyc3QtY2hpbGQge1xuICBib3JkZXItbGVmdDogMCAhaW1wb3J0YW50O1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudHJhaW5pbmdkdXJhdGlvbmhlYWQge1xuICBwYWRkaW5nOiAxMHB4IDI1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XG4gIGJvcmRlci1yYWRpdXM6IDNweDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnRyYWluaW5nZHVyYXRpb25oZWFkIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjZmZmO1xufVxuLnF1aWNrc2V0dXBsaXN0ICN0cmFpbmluZ2xpc3Rwb3B1cCAudHJhaW5pbmdkdXJhdGlvbmhlYWQgaDIge1xuICBjb2xvcjogI2ZmZjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLmNvbmZ0aW1pbmcgaDQge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnRvdGFsbGVhbmVyaGVhZGVyIHAge1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgcGFkZGluZy1ib3R0b206IDRweDtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLnRvdGFsbGVhbmVyaGVhZGVyIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbi5xdWlja3NldHVwbGlzdCAjdHJhaW5pbmdsaXN0cG9wdXAgLmNvdXJzZXN1YnRpdGxlIC5jb21wbGFudGFnIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbiAgcGFkZGluZzogOHB4IDEwcHg7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5jb3Vyc2VzdWJ0aXRsZSBwIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4ucXVpY2tzZXR1cGxpc3QgI3RyYWluaW5nbGlzdHBvcHVwIC5jb3Vyc2VzdWJ0aXRsZSBzcGFuIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA2OTlweCkge1xuICAucmFuZ2V3aWR0aGRhdGVyZXMge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWluZGF0ZXJhbmdld2lkdGgge1xuICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLndpZHRobGFuZ3RpdGxlIHtcbiAgICBwYWRkaW5nLXRvcDogMTVweDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XG4gIC5zdW1tYXJ5dGFibGVsaXN0IHtcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gICAgei1pbmRleDogMTtcbiAgICBkaXNwbGF5OiBibG9jaztcbiAgICBvdmVyZmxvdy14OiBhdXRvO1xuICAgIG92ZXJmbG93LXk6IGhpZGRlbjtcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xuICB9XG4gIC5zdW1tYXJ5dGFibGVsaXN0Ojotd2Via2l0LXNjcm9sbGJhciB7XG4gICAgd2lkdGg6IDZweDtcbiAgICBoZWlnaHQ6IDVweDtcbiAgfVxuICAuc3VtbWFyeXRhYmxlbGlzdDo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xuICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XG4gIH1cbiAgLnN1bW1hcnl0YWJsZWxpc3Q6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgICBiYWNrZ3JvdW5kOiAjY2NjO1xuICAgIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgfVxuICAuc3VtbWFyeXRhYmxlbGlzdDo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICAgIGJhY2tncm91bmQ6ICNjY2M7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkgYW5kIChtaW4td2lkdGg6IDc2NnB4KSB7XG4gIC53aWR0aHJlc3RpdGxlIHtcbiAgICBtYXgtd2lkdGg6IDEzJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRobGFuZ3RpdGxlIHtcbiAgICBtYXgtd2lkdGg6IDg3JSAhaW1wb3J0YW50O1xuICB9XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/batch/batchgridlisting/batchgridlisting.component.scss":
  /*!********************************************************************************!*\
    !*** ./src/app/modules/batch/batchgridlisting/batchgridlisting.component.scss ***!
    \********************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesBatchBatchgridlistingBatchgridlistingComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "@charset \"UTF-8\";\n#batchcontainer .approved {\n  color: #00a551;\n}\n#batchcontainer .print, #batchcontainer .cancelled, #batchcontainer .requestedback, #batchcontainer .requestedaccess, #batchcontainer .assessment, #batchcontainer .qualitycheck, #batchcontainer .teaching, #batchcontainer .newtag {\n  color: #00a551;\n  font-size: 0.9375rem;\n}\n#batchcontainer .newtag {\n  color: #ed1c27 !important;\n}\n#batchcontainer .teaching {\n  color: #f4811f !important;\n}\n#batchcontainer .qualitycheck {\n  color: #0c4b9a !important;\n}\n#batchcontainer .assessment {\n  color: #C330CE;\n}\n#batchcontainer .requestedaccess {\n  color: #109d98;\n}\n#batchcontainer .requestedaccess {\n  color: #109d98;\n}\n#batchcontainer .requestedback {\n  color: #b14428;\n}\n#batchcontainer .cancelled {\n  color: #ed1c27;\n}\n#batchcontainer .update {\n  color: #0c4b9a;\n}\n#batchcontainer .declined {\n  color: #ed1c27;\n}\n#batchcontainer .new {\n  color: #f4811f;\n}\n#batchcontainer .requiredfiels h4 {\n  color: #262626;\n}\n#batchcontainer .requiredfiels .yesno {\n  display: flex;\n  align-items: center;\n}\n#batchcontainer .requiredfiels .yesno p {\n  color: #848484;\n}\n#batchcontainer .requiredfiels .yesno p span {\n  color: #dc4c64;\n}\n#batchcontainer .txt-gry {\n  color: #848484;\n}\n#batchcontainer .txt-gry3 {\n  color: #262626;\n}\n#batchcontainer mat-footer-row {\n  min-height: auto !important;\n}\n#batchcontainer #profile .hint {\n  width: 168px;\n  word-break: break-word;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field {\n  width: 162px !important;\n  height: 162px !important;\n}\n#batchcontainer #profile #uploaded .filers input.mat-input-element {\n  margin-top: 0rem !important;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #999999;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-flex {\n  padding: 0px !important;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 0 2px !important;\n  border-top: 0.4em solid transparent !important;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border: 1px solid currentcolor !important;\n  border-radius: 1px !important;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border: 1px solid currentcolor !important;\n  border-radius: 1px !important;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field-appearance-outline .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n#batchcontainer #profile #uploaded .filers mat-label {\n  color: #999999;\n}\n#batchcontainer #profile #uploaded .filers mat-label span {\n  color: #ED1C27;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field label {\n  text-align: center;\n  margin-top: 1px;\n}\n#batchcontainer #profile #uploaded .filers input.mat-input-element {\n  background-color: #fff;\n  text-align: center;\n  height: 162px !important;\n  width: 162px !important;\n  margin-bottom: 2px !important;\n}\n#batchcontainer #profile #uploaded .filers .mat-form-field-suffix {\n  top: -0.75em;\n}\n#batchcontainer #profile #uploaded .document mat-label {\n  color: #999999;\n}\n#batchcontainer #profile #uploaded .document img {\n  width: 20px;\n}\n#batchcontainer #profile #uploaded .document mat-icon {\n  color: #999999;\n}\n#batchcontainer #profile #uploaded .document .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n#batchcontainer #profile #uploaded .document .mat-form-field-outline-start {\n  border: none !important;\n  border-radius: 1px !important;\n}\n#batchcontainer #profile #uploaded .document .mat-form-field-outline-end {\n  border: none !important;\n  border-radius: 1px !important;\n}\n#batchcontainer .mat-radio-button .mat-radio-outer-circle {\n  border-color: #d9d9d9;\n}\n#batchcontainer .mat-radio-button.mat-accent .mat-radio-inner-circle {\n  background-color: #e20613;\n}\n#batchcontainer .mat-radio-button.mat-accent.mat-radio-checked .mat-radio-outer-circle {\n  border-color: #d9d9d9;\n}\n#batchcontainer .mat-radio-label-content {\n  color: #000000cc;\n  font-size: 16px;\n}\n#batchcontainer .mat-cell {\n  color: #262626;\n}\n#batchcontainer .mat-cell .document_img {\n  width: 32px;\n}\n#batchcontainer .mat-cell .viewdocument {\n  cursor: pointer;\n}\n#batchcontainer .mat-raised-button {\n  border-radius: 2px;\n  box-shadow: none;\n}\n#batchcontainer .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 110px;\n  height: 45px;\n}\n#batchcontainer .cancelbtn {\n  min-width: 110px;\n  background-color: #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n}\n#batchcontainer .mat-ink-bar {\n  width: 0px !important;\n}\n#batchcontainer .mat-tab-header {\n  border: 0px;\n}\n#batchcontainer .mat-tab-label-active {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n#batchcontainer .mat-tab-label-active .contentcircle {\n  color: #fff !important;\n  border: 1px solid #fff !important;\n}\n#batchcontainer .mat-tab-label-active p {\n  color: #fff !important;\n}\n#batchcontainer .file_upload #uploaded {\n  display: flex;\n}\n@media (max-width: 1279px) {\n  #batchcontainer .file_upload #uploaded {\n    display: block;\n  }\n}\n#batchcontainer .file_upload #uploaded .filers {\n  width: 50%;\n}\n@media (max-width: 1279px) {\n  #batchcontainer .file_upload #uploaded .filers {\n    width: 100%;\n  }\n}\n#batchcontainer .file_upload #uploaded .document {\n  width: 50%;\n  padding-left: 30px;\n}\n#batchcontainer .file_upload #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  display: none;\n}\n#batchcontainer .file_upload #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  display: none;\n}\n#batchcontainer .file_upload #uploaded .document .mat-form-field-appearance-outline .mat-form-field-suffix {\n  left: -239px;\n}\n@media (max-width: 1279px) {\n  #batchcontainer .file_upload #uploaded .document {\n    width: 100%;\n    padding-left: 0px;\n  }\n}\n#batchcontainer .file_upload #uploaded .document .close_icons {\n  display: block;\n}\n#batchcontainer .file_upload #uploaded .document .delete_icon {\n  display: none;\n}\n#batchcontainer .file_upload #uploaded .document .view_btn {\n  display: block;\n  color: #848484;\n}\n#batchcontainer .workcheckbox {\n  display: flex;\n  align-items: center;\n}\n#batchcontainer .workcheckbox .mat-checkbox-inner-container {\n  width: 20px;\n  height: 20px;\n}\n#batchcontainer .workcheckbox .mat-checkbox-checked.mat-accent .mat-checkbox-background {\n  background-color: #0c4b9a !important;\n}\n#batchcontainer .workcheckbox .mat-checkbox-frame {\n  border: 1px solid #c4c4c4;\n}\n#batchcontainer .mat-slide-toggle.mat-checked .mat-slide-toggle-thumb {\n  background-color: #00a551;\n}\n#batchcontainer .mat-slide-toggle.mat-checked .mat-slide-toggle-bar {\n  background-color: #00a55062;\n}\n#batchcontainer .mat-tab-label {\n  opacity: 1;\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #eaedf2;\n  margin-right: 20px;\n  height: 80px;\n  justify-content: flex-start !important;\n}\n#batchcontainer .mat-tab-list {\n  opacity: 1;\n  min-width: auto !important;\n  padding: 0px !important;\n  justify-content: flex-start;\n}\n#batchcontainer .mat-card {\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  position: relative;\n}\n#batchcontainer .mat-card .mat-card-content img {\n  width: 100px;\n  height: 100px;\n}\n#batchcontainer .mat-card .mat-card-content .cardinfo h4 {\n  color: #262626;\n}\n#batchcontainer .mat-card .mat-card-content .cardinfo .centre_info {\n  gap: 30px;\n}\n#batchcontainer .mat-card .mat-card-content .cardinfo .centre_info p {\n  color: #848484;\n}\n#batchcontainer .mat-card .mat-card-content .cardinfo .centre_info p span {\n  color: #262626;\n}\n#batchcontainer .mat-card .cardbtn {\n  position: absolute;\n  margin-top: -34px;\n  width: 93%;\n  border-radius: 20px;\n  display: flex;\n  align-items: baseline;\n  justify-content: end;\n}\n#batchcontainer .mat-card .cardbtn button {\n  border-radius: 20px;\n}\n#batchcontainer .tabscontent {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#batchcontainer .tabscontent .contentcircle {\n  width: 28px;\n  height: 28px;\n  border-radius: 50%;\n  display: flex;\n  justify-content: center !important;\n  align-items: center !important;\n  background-clip: padding-box;\n  background-color: transparent;\n  color: #848484;\n  box-shadow: 0 0 8px rgba(51, 51, 51, 0.15);\n  border: 1px solid #848484;\n}\n#batchcontainer .tabscontent .tabtitle p {\n  color: #262626;\n}\n#batchcontainer .subtitleform {\n  font-weight: 700;\n}\n#batchcontainer .title h4 {\n  color: #0c4b9a;\n}\n#batchcontainer .title .subtitle h4 {\n  color: #262626;\n}\n#batchcontainer .title .line {\n  flex: 4;\n}\n#batchcontainer .title .line .mat-divider {\n  width: 12%;\n  border-top-width: 3px;\n  border-color: #ED1C27;\n}\n#batchcontainer .mat-input-element {\n  color: #262626;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#batchcontainer .paginationwithfilter {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#batchcontainer .date_exp .mat-form-field-appearance-outline .mat-form-field-suffix {\n  display: flex;\n  align-items: center;\n}\n#batchcontainer input[readonly] {\n  cursor: no-drop;\n}\n#batchcontainer .mat-form-field.mat-focused.mat-primary .mat-select-arrow {\n  color: transparent !important;\n}\n#batchcontainer .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n#batchcontainer .filter {\n  height: 45px;\n}\n#batchcontainer .userimg {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#batchcontainer .userimg img {\n  width: 168px;\n  height: 168px;\n}\n#batchcontainer .userimg img:hover {\n  transform: scale(1.1);\n}\n#batchcontainer .userimg span {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  width: 32px;\n  height: 32px;\n  border-radius: 20px;\n  background-color: #c4c4c4;\n  position: relative;\n  top: 33px;\n  left: -44px;\n  opacity: 0.5;\n}\n#batchcontainer .userimg span:hover {\n  background-color: #ed1c2770;\n  transform: scale(1.1);\n}\n#batchcontainer .userimg span:hover .mat-icon {\n  color: #ED1C27;\n}\n#batchcontainer .mat-icon {\n  cursor: pointer;\n}\n#batchcontainer .mat-form-field-suffix .mat-icon {\n  color: #848484;\n  cursor: pointer;\n}\n#batchcontainer .arabiclanguage input,\n#batchcontainer .arabiclanguage .mat-form-field-label {\n  text-align: right;\n}\n#batchcontainer .arabiclanguage .mat-form-field-label {\n  text-align: right;\n}\n#batchcontainer .arabiclanguage .mat-error {\n  text-align: right;\n}\n#batchcontainer .editbtn {\n  background-color: transparent;\n  cursor: pointer;\n  padding: 4px;\n}\n#batchcontainer .editbtn:hover {\n  background-color: #ED1C27;\n  color: #fff;\n  border-radius: 2px;\n}\n#batchcontainer .courebox {\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  padding: 5px 10px;\n}\n#batchcontainer .icongroup .mat-icon {\n  background-color: #fff;\n  border: 1px solid #d9d9d9;\n  width: 40px;\n  height: 40px;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  font-size: 30px;\n}\n#batchcontainer .icongroup .mat-icon:nth-child(1) {\n  background-color: #0c4b9a;\n  color: #fff;\n}\n#batchcontainer #documents #uploaded,\n#batchcontainer .documents #uploaded {\n  display: flex;\n}\n@media (max-width: 959px) {\n  #batchcontainer #documents #uploaded,\n#batchcontainer .documents #uploaded {\n    display: block;\n  }\n}\n#batchcontainer #documents #uploaded .filers,\n#batchcontainer .documents #uploaded .filers {\n  width: 50%;\n}\n@media (max-width: 959px) {\n  #batchcontainer #documents #uploaded .filers,\n#batchcontainer .documents #uploaded .filers {\n    width: 100%;\n  }\n}\n#batchcontainer #documents #uploaded .document,\n#batchcontainer .documents #uploaded .document {\n  width: 50%;\n  padding-left: 30px;\n}\n#batchcontainer #documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-start,\n#batchcontainer .documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  display: none;\n}\n#batchcontainer #documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-end,\n#batchcontainer .documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  display: none;\n}\n#batchcontainer #documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-suffix,\n#batchcontainer .documents #uploaded .document .mat-form-field-appearance-outline .mat-form-field-suffix {\n  left: -239px;\n}\n@media (max-width: 959px) {\n  #batchcontainer #documents #uploaded .document,\n#batchcontainer .documents #uploaded .document {\n    width: 100%;\n    padding-left: 0px;\n  }\n}\n#batchcontainer #documents #uploaded .document .close_icons,\n#batchcontainer .documents #uploaded .document .close_icons {\n  display: block;\n}\n#batchcontainer #documents #uploaded .document .delete_icon,\n#batchcontainer .documents #uploaded .document .delete_icon {\n  display: none;\n}\n#batchcontainer #documents #uploaded .document .view_btn,\n#batchcontainer .documents #uploaded .document .view_btn {\n  display: block;\n  color: #848484;\n}\n#batchcontainer .masterPageTop {\n  display: flex;\n}\n#batchcontainer .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#batchcontainer .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#batchcontainer .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#batchcontainer .awaredtable .mat-cell {\n  color: #262626;\n}\n#batchcontainer .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#batchcontainer .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#batchcontainer .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#batchcontainer .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#batchcontainer .renewal {\n  display: flex;\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  padding: 15px;\n  justify-content: space-between;\n  align-items: center;\n}\n#batchcontainer .renewal .renewal_info {\n  gap: 30px;\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#batchcontainer .renewal .renewal_info .mat-divider {\n  height: 51px;\n}\n#batchcontainer .renewal .renewal_info .mat-divider .mat-divider-vertical {\n  border-right-color: #c4c4c4;\n  border-right-width: 2px !important;\n}\n#batchcontainer .renewal .renewal_info p {\n  color: #848484;\n}\n#batchcontainer .renewal .renewal_info p span {\n  color: #262626;\n}\n#batchcontainer .renewal .renewal_info .remainder {\n  border: 1px solid #ED1C27;\n  border-radius: 2px;\n  padding: 8px;\n}\n#batchcontainer .renewal .renewal_info .remainder p {\n  color: #ED1C27;\n}\n#batchcontainer .renewal .renewal_info .remainder p span {\n  color: #ED1C27;\n}\n#batchcontainer .renewal .viewbtn {\n  background-color: #0c4b9a;\n  color: #fff;\n}\n#batchcontainer .success .centercontent {\n  height: 71vh;\n}\n#batchcontainer .success .success_icon {\n  width: 72px;\n  height: 72px;\n  border-radius: 50px;\n  background-color: #fff;\n  border: 3px solid #00a551;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n}\n#batchcontainer .success .success_icon .mat-icon {\n  font-size: 50px;\n  color: #00a551;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n}\n#batchcontainer .success .succes_msg h4 {\n  color: #00a551;\n}\n#batchcontainer .success .succes_msg p {\n  color: #262626;\n}\n#batchcontainer .success .succes_msg .viewform {\n  background-color: #ED1C27;\n  color: #fff;\n}\n#batchcontainer .decline {\n  border: 1px solid #ED1C27;\n  border-radius: 3px;\n  padding: 15px;\n  background-color: #fff8f8;\n}\n#batchcontainer .decline h4 {\n  color: #ED1C27;\n}\n#batchcontainer .decline p {\n  color: #262626;\n}\n#batchcontainer .mat-raised-button {\n  border-radius: 2px;\n  box-shadow: none;\n  font-size: 16px;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#batchcontainer .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#batchcontainer .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#batchcontainer .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#batchcontainer .date_exp .mat-form-field-appearance-outline .mat-form-field-suffix {\n  display: flex;\n  align-items: center;\n}\n#batchcontainer .mat-form-field-outline-thick[ng-reflect-state=readonly] {\n  background-color: #d9d9d9;\n}\n#batchcontainer input[readonly] {\n  cursor: pointer;\n}\n#batchcontainer .mat-form-field.mat-focused.mat-primary .mat-select-arrow {\n  color: transparent !important;\n}\n#batchcontainer .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n#batchcontainer .card {\n  box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);\n  padding: 15px;\n}\n#batchcontainer #searchrow,\n#batchcontainer #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#batchcontainer #searchrow .serachrow,\n#batchcontainer #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#batchcontainer .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#batchcontainer .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#batchcontainer .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#batchcontainer .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#batchcontainer .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#batchcontainer .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#batchcontainer .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#batchcontainer .tabforclientelenew .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#batchcontainer .tabforclientelenew .manageoptions .mat-icon {\n  color: #acacac;\n}\n#batchcontainer .master-menu .mat-menu-content {\n  background-color: #000;\n  color: #fff;\n}\n#batchcontainer .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#batchcontainer .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: #d9d9d9 !important;\n}\n#batchcontainer .mat-sort-header-arrow {\n  color: #ED1C27;\n}\n#batchcontainer .nofound {\n  margin-top: 5%;\n}\n.mat-menu-panel {\n  background-color: #666666 !important;\n}\n.mat-menu-item {\n  line-height: 36px;\n  height: 31px;\n  color: #fff;\n}\n.searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 6px 10px;\n  background: #e9edf0;\n}\n.searchinmultiselect input::-webkit-input-placeholder {\n  color: #7f8fa3 !important;\n}\n.searchinmultiselect i {\n  color: #7f8fa3 !important;\n  padding-right: 6px;\n}\n.searchinmultiselect .searchselect {\n  width: calc(100% - 25px) !important;\n}\n.searchinmultiselect .reseticon {\n  cursor: pointer;\n}\n.select_with_search {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 40px !important;\n  margin-bottom: 15px !important;\n}\n.select_with_option {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 49px !important;\n  margin-bottom: 15px !important;\n}\n.searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 10px 10px;\n  background: #e9edf0;\n  margin: 10px;\n}\n.searchselect {\n  width: calc(100% - 25px) !important;\n  padding-left: 10px;\n}\n.mat-option.mat-active {\n  background: #fff;\n  color: rgba(0, 0, 0, 0.87);\n}\n.option-listing {\n  overflow-x: auto;\n  overflow-y: auto;\n  max-height: 290px;\n}\n.option-listing::-webkit-scrollbar {\n  width: 7px;\n}\n/* Track */\n.option-listing::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n/* Handle */\n.option-listing::-webkit-scrollbar-thumb {\n  background: #ED1C27;\n}\n/* hover */\n.option-listing::-webkit-scrollbar-thumb:hover {\n  background: #ED1C27;\n}\n.myPanelClass {\n  margin: 36px 0px;\n}\n.mat-select-arrow {\n  color: transparent !important;\n}\n.mat-select-arrow:before {\n  content: \"\";\n  speak: none;\n  font-style: normal;\n  font-weight: normal;\n  font-variant: normal;\n  text-transform: none;\n  line-height: 1;\n  -webkit-font-smoothing: antialiased;\n  font-size: 10px !important;\n  position: absolute;\n  height: 25px;\n  width: 25px;\n  right: 0px;\n  display: flex;\n  align-items: flex-end;\n  bottom: 4px;\n  justify-content: center;\n  font-family: \"FontAwesome\";\n  color: rgba(0, 0, 0, 0.54);\n}\n@media (max-width: 768px) {\n  .masterPageTop {\n    display: block !important;\n    justify-content: flex-start !important;\n  }\n  .masterPageTop .mat-paginator-page-size-label {\n    margin: 0px !important;\n  }\n  .masterPageTop .mat-paginator-container {\n    padding: 0px !important;\n    justify-content: flex-start !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9iYXRjaC9iYXRjaGdyaWRsaXN0aW5nL2JhdGNoZ3JpZGxpc3RpbmcuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvYmF0Y2gvYmF0Y2hncmlkbGlzdGluZy9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxiYXRjaFxcYmF0Y2hncmlkbGlzdGluZ1xcYmF0Y2hncmlkbGlzdGluZy5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxnQkFBZ0I7QUNFWjtFQUNJLGNBQUE7QURBUjtBQ0dJO0VBQ0ssY0FBQTtFQUNBLG9CQUFBO0FERFQ7QUNHSTtFQUVHLHlCQUFBO0FERlA7QUNJSTtFQUVJLHlCQUFBO0FESFI7QUNLSTtFQUVJLHlCQUFBO0FESlI7QUNNSTtFQUVJLGNBQUE7QURMUjtBQ09JO0VBRUksY0FBQTtBRE5SO0FDUUk7RUFFSSxjQUFBO0FEUFI7QUNTSTtFQUVJLGNBQUE7QURSUjtBQ1VJO0VBRUksY0FBQTtBRFRSO0FDWUk7RUFDSSxjQUFBO0FEVlI7QUNhSTtFQUNJLGNBQUE7QURYUjtBQ2NJO0VBQ0ksY0FBQTtBRFpSO0FDZ0JRO0VBQ0ksY0FBQTtBRGRaO0FDaUJRO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FEZlo7QUNpQlk7RUFDSSxjQUFBO0FEZmhCO0FDaUJnQjtFQUNJLGNBQUE7QURmcEI7QUNzQkk7RUFDSSxjQUFBO0FEcEJSO0FDdUJJO0VBQ0ksY0FBQTtBRHJCUjtBQ3VCSTtFQUNJLDJCQUFBO0FEckJSO0FDd0JRO0VBQ0ksWUFBQTtFQUNBLHNCQUFBO0FEdEJaO0FDMkJnQjtFQUNJLHVCQUFBO0VBQ0Esd0JBQUE7QUR6QnBCO0FDNEJnQjtFQUNJLDJCQUFBO0FEMUJwQjtBQzhCb0I7RUFDSSxjQUFBO0FENUJ4QjtBQytCb0I7RUFDSSx1QkFBQTtBRDdCeEI7QUNnQ29CO0VBQ0kseUJBQUE7RUFDQSw4Q0FBQTtBRDlCeEI7QUNpQ29CO0VBQ0kseUNBQUE7RUFDQSw2QkFBQTtBRC9CeEI7QUNrQ29CO0VBQ0kseUNBQUE7RUFDQSw2QkFBQTtBRGhDeEI7QUNtQ29CO0VBQ0ksbUJBQUE7QURqQ3hCO0FDcUNnQjtFQUNJLGNBQUE7QURuQ3BCO0FDcUNvQjtFQUNJLGNBQUE7QURuQ3hCO0FDdUNnQjtFQUNJLGtCQUFBO0VBQ0EsZUFBQTtBRHJDcEI7QUN5Q29CO0VBQ0ksc0JBQUE7RUFDQSxrQkFBQTtFQUNBLHdCQUFBO0VBQ0EsdUJBQUE7RUFDQSw2QkFBQTtBRHZDeEI7QUMyQ2dCO0VBQ0ksWUFBQTtBRHpDcEI7QUM4Q2dCO0VBQ0ksY0FBQTtBRDVDcEI7QUMrQ2dCO0VBQ0ksV0FBQTtBRDdDcEI7QUNnRGdCO0VBQ0ksY0FBQTtBRDlDcEI7QUNpRGdCO0VBQ0ksbUJBQUE7QUQvQ3BCO0FDa0RnQjtFQUNJLHVCQUFBO0VBQ0EsNkJBQUE7QURoRHBCO0FDbURnQjtFQUNJLHVCQUFBO0VBQ0EsNkJBQUE7QURqRHBCO0FDeURRO0VBQ0kscUJBQUE7QUR2RFo7QUM0RFk7RUFDSSx5QkFBQTtBRDFEaEI7QUM4RGdCO0VBQ0kscUJBQUE7QUQ1RHBCO0FDbUVJO0VBQ0ksZ0JBQUE7RUFDQSxlQUFBO0FEakVSO0FDb0VJO0VBQ0ksY0FBQTtBRGxFUjtBQ29FUTtFQUNJLFdBQUE7QURsRVo7QUNxRVE7RUFDSSxlQUFBO0FEbkVaO0FDdUVJO0VBQ0ksa0JBQUE7RUFDQSxnQkFBQTtBRHJFUjtBQ3dFSTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7QUR0RVI7QUN5RUk7RUFDSSxnQkFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0FEdkVSO0FDMEVJO0VBQ0kscUJBQUE7QUR4RVI7QUMyRUk7RUFDSSxXQUFBO0FEekVSO0FDNEVJO0VBQ0ksb0NBQUE7RUFDQSxzQkFBQTtBRDFFUjtBQzRFUTtFQUNJLHNCQUFBO0VBQ0EsaUNBQUE7QUQxRVo7QUM2RVE7RUFDSSxzQkFBQTtBRDNFWjtBQ2dGUTtFQUNJLGFBQUE7QUQ5RVo7QUNnRlk7RUFISjtJQUlRLGNBQUE7RUQ3RWQ7QUFDRjtBQytFWTtFQUNJLFVBQUE7QUQ3RWhCO0FDK0VnQjtFQUhKO0lBSVEsV0FBQTtFRDVFbEI7QUFDRjtBQytFWTtFQUNJLFVBQUE7RUFDQSxrQkFBQTtBRDdFaEI7QUNnRm9CO0VBQ0ksYUFBQTtBRDlFeEI7QUNpRm9CO0VBQ0ksYUFBQTtBRC9FeEI7QUNrRm9CO0VBQ0ksWUFBQTtBRGhGeEI7QUNvRmdCO0VBbEJKO0lBbUJRLFdBQUE7SUFDQSxpQkFBQTtFRGpGbEI7QUFDRjtBQ21GZ0I7RUFDSSxjQUFBO0FEakZwQjtBQ29GZ0I7RUFDSSxhQUFBO0FEbEZwQjtBQ3FGZ0I7RUFDSSxjQUFBO0VBQ0EsY0FBQTtBRG5GcEI7QUN5Rkk7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7QUR2RlI7QUN5RlE7RUFDSSxXQUFBO0VBQ0EsWUFBQTtBRHZGWjtBQzRGZ0I7RUFDSSxvQ0FBQTtBRDFGcEI7QUMrRlE7RUFDSSx5QkFBQTtBRDdGWjtBQ21HWTtFQUNJLHlCQUFBO0FEakdoQjtBQ29HWTtFQUNJLDJCQUFBO0FEbEdoQjtBQ3VHSTtFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxzQ0FBQTtBRHJHUjtBQ3lHSTtFQUNJLFVBQUE7RUFDQSwwQkFBQTtFQUNBLHVCQUFBO0VBQ0EsMkJBQUE7QUR2R1I7QUMwR0k7RUFDSSxzQ0FBQTtFQUNBLGtCQUFBO0FEeEdSO0FDMkdZO0VBQ0ksWUFBQTtFQUNBLGFBQUE7QUR6R2hCO0FDNkdnQjtFQUNJLGNBQUE7QUQzR3BCO0FDOEdnQjtFQUNJLFNBQUE7QUQ1R3BCO0FDOEdvQjtFQUNJLGNBQUE7QUQ1R3hCO0FDOEd3QjtFQUNJLGNBQUE7QUQ1RzVCO0FDbUhRO0VBQ0ksa0JBQUE7RUFDQSxpQkFBQTtFQUNBLFVBQUE7RUFDQSxtQkFBQTtFQUNBLGFBQUE7RUFDQSxxQkFBQTtFQUNBLG9CQUFBO0FEakhaO0FDbUhZO0VBQ0ksbUJBQUE7QURqSGhCO0FDc0hJO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0VBQ0EsdUJBQUE7QURwSFI7QUNzSFE7RUFDSSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0EsYUFBQTtFQUNBLGtDQUFBO0VBQ0EsOEJBQUE7RUFDQSw0QkFBQTtFQUNBLDZCQUFBO0VBQ0EsY0FBQTtFQUNBLDBDQUFBO0VBQ0EseUJBQUE7QURwSFo7QUN3SFk7RUFDSSxjQUFBO0FEdEhoQjtBQzJISTtFQUNJLGdCQUFBO0FEekhSO0FDNkhRO0VBQ0ksY0FBQTtBRDNIWjtBQytIWTtFQUNJLGNBQUE7QUQ3SGhCO0FDaUlRO0VBQ0ksT0FBQTtBRC9IWjtBQ2lJWTtFQUNJLFVBQUE7RUFDQSxxQkFBQTtFQUNBLHFCQUFBO0FEL0hoQjtBQ29JSTtFQUNJLGNBQUE7QURsSVI7QUNzSVE7RUFDSSxjQUFBO0FEcElaO0FDdUlRO0VBQ0ksMEJBQUE7QURySVo7QUN3SVE7RUFDSSwwQkFBQTtBRHRJWjtBQ3lJUTtFQUNJLGNBQUE7QUR2SVo7QUMwSVE7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUR4SVo7QUM0SVk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUQxSWhCO0FDK0lvQjtFQUNJLGNBQUE7QUQ3SXhCO0FDb0pZO0VBQ0kseUJBQUE7QURsSmhCO0FDd0pZO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FEdEpoQjtBQzRKZ0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUQxSnBCO0FDNEpvQjtFQUNJLGNBQUE7QUQxSnhCO0FDOEpnQjtFQUNJLHFCQUFBO0FENUpwQjtBQ2tLSTtFQUNJLGFBQUE7RUFDQSw4QkFBQTtFQUNBLG1CQUFBO0FEaEtSO0FDcUtZO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FEbktoQjtBQ3dLSTtFQUNJLGVBQUE7QUR0S1I7QUM0S2dCO0VBQ0ksNkJBQUE7QUQxS3BCO0FDa0xZO0VBQ0kseUJBQUE7QURoTGhCO0FDcUxJO0VBQ0ksWUFBQTtBRG5MUjtBQ3NMSTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FEcExSO0FDc0xRO0VBQ0ksWUFBQTtFQUNBLGFBQUE7QURwTFo7QUNzTFk7RUFDSSxxQkFBQTtBRHBMaEI7QUN3TFE7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSx1QkFBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0EsbUJBQUE7RUFDQSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsU0FBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0FEdExaO0FDd0xZO0VBQ0ksMkJBQUE7RUFDQSxxQkFBQTtBRHRMaEI7QUN3TGdCO0VBQ0ksY0FBQTtBRHRMcEI7QUM0TEk7RUFDSSxlQUFBO0FEMUxSO0FDOExRO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QUQ1TFo7QUNrTVE7O0VBRUksaUJBQUE7QURoTVo7QUNtTVE7RUFDSSxpQkFBQTtBRGpNWjtBQ29NUTtFQUNJLGlCQUFBO0FEbE1aO0FDc01JO0VBQ0ksNkJBQUE7RUFDQSxlQUFBO0VBQ0EsWUFBQTtBRHBNUjtBQ3NNUTtFQUNJLHlCQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0FEcE1aO0FDd01JO0VBQ0ksc0NBQUE7RUFDQSxpQkFBQTtBRHRNUjtBQzBNUTtFQUNJLHNCQUFBO0VBQ0EseUJBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsZUFBQTtBRHhNWjtBQzBNWTtFQUNJLHlCQUFBO0VBQ0EsV0FBQTtBRHhNaEI7QUNnTlE7O0VBQ0ksYUFBQTtBRDdNWjtBQytNWTtFQUhKOztJQUlRLGNBQUE7RUQzTWQ7QUFDRjtBQzZNWTs7RUFDSSxVQUFBO0FEMU1oQjtBQzRNZ0I7RUFISjs7SUFJUSxXQUFBO0VEeE1sQjtBQUNGO0FDMk1ZOztFQUNJLFVBQUE7RUFDQSxrQkFBQTtBRHhNaEI7QUMyTW9COztFQUNJLGFBQUE7QUR4TXhCO0FDMk1vQjs7RUFDSSxhQUFBO0FEeE14QjtBQzJNb0I7O0VBQ0ksWUFBQTtBRHhNeEI7QUM0TWdCO0VBbEJKOztJQW1CUSxXQUFBO0lBQ0EsaUJBQUE7RUR4TWxCO0FBQ0Y7QUMwTWdCOztFQUNJLGNBQUE7QUR2TXBCO0FDME1nQjs7RUFDSSxhQUFBO0FEdk1wQjtBQzBNZ0I7O0VBQ0ksY0FBQTtFQUNBLGNBQUE7QUR2TXBCO0FDOE1JO0VBQ0ksYUFBQTtBRDVNUjtBQytNSTtFQUNJLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0FEN01SO0FDK01RO0VBQ0ksbUJBQUE7QUQ3TVo7QUNnTlE7RUFDSSxvQ0FBQTtBRDlNWjtBQ2tOUTtFQUNJLGNBQUE7QURoTlo7QUNtTlE7RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBRGpOWjtBQ3NOUTtFQUNJLFdBQUE7RUFDQSxlQUFBO0FEcE5aO0FDdU5RO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QURyTlo7QUN3TlE7RUFDSSxXQUFBO0VBQ0EsZUFBQTtFQUNBLDJCQUFBO0FEdE5aO0FDME5JO0VBQ0ksYUFBQTtFQUNBLHNDQUFBO0VBQ0EsYUFBQTtFQUNBLDhCQUFBO0VBQ0EsbUJBQUE7QUR4TlI7QUMwTlE7RUFDSSxTQUFBO0VBQ0EsYUFBQTtFQUNBLDhCQUFBO0VBQ0EsbUJBQUE7QUR4Tlo7QUMwTlk7RUFDSSxZQUFBO0FEeE5oQjtBQzBOZ0I7RUFDSSwyQkFBQTtFQUNBLGtDQUFBO0FEeE5wQjtBQzROWTtFQUNJLGNBQUE7QUQxTmhCO0FDNE5nQjtFQUNJLGNBQUE7QUQxTnBCO0FDOE5ZO0VBQ0kseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7QUQ1TmhCO0FDOE5nQjtFQUNJLGNBQUE7QUQ1TnBCO0FDOE5vQjtFQUNJLGNBQUE7QUQ1TnhCO0FDa09RO0VBQ0kseUJBQUE7RUFDQSxXQUFBO0FEaE9aO0FDc09RO0VBQ0ksWUFBQTtBRHBPWjtBQ3VPUTtFQUNJLFdBQUE7RUFDQSxZQUFBO0VBQ0EsbUJBQUE7RUFDQSxzQkFBQTtFQUNBLHlCQUFBO0VBQ0EsYUFBQTtFQUNBLHVCQUFBO0VBQ0EsbUJBQUE7QURyT1o7QUN1T1k7RUFDSSxlQUFBO0VBQ0EsY0FBQTtFQUNBLGFBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0FEck9oQjtBQzBPWTtFQUNJLGNBQUE7QUR4T2hCO0FDMk9ZO0VBQ0ksY0FBQTtBRHpPaEI7QUM0T1k7RUFDSSx5QkFBQTtFQUNBLFdBQUE7QUQxT2hCO0FDK09JO0VBQ0kseUJBQUE7RUFDQSxrQkFBQTtFQUNBLGFBQUE7RUFDQSx5QkFBQTtBRDdPUjtBQytPUTtFQUNJLGNBQUE7QUQ3T1o7QUNnUFE7RUFDSSxjQUFBO0FEOU9aO0FDZ1BNO0VBQ0Usa0JBQUE7RUFDQSxnQkFBQTtFQUNBLGVBQUE7QUQ5T1I7QUNtUFE7RUFFSSxvQ0FBQTtBRGxQWjtBQ3VQUTtFQUNJLGNBQUE7QURyUFo7QUN3UFE7RUFDSSwwQkFBQTtBRHRQWjtBQ3lQUTtFQUNJLDBCQUFBO0FEdlBaO0FDMFBRO0VBQ0ksY0FBQTtBRHhQWjtBQzJQUTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBRHpQWjtBQzhQWTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBRDVQaEI7QUNpUW9CO0VBQ0ksY0FBQTtBRC9QeEI7QUNzUVk7RUFDSSx5QkFBQTtBRHBRaEI7QUMwUVk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUR4UWhCO0FDOFFnQjtFQUNJLDBDQUFBO0VBQ0EsY0FBQTtBRDVRcEI7QUM4UW9CO0VBQ0ksY0FBQTtBRDVReEI7QUNnUmdCO0VBQ0kscUJBQUE7QUQ5UXBCO0FDb1JJO0VBQ0ksd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0FEbFJSO0FDdVJZO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FEclJoQjtBQzBSSTtFQUNJLHlCQUFBO0FEeFJSO0FDMlJJO0VBQ0ksZUFBQTtBRHpSUjtBQ2dTZ0I7RUFDSSw2QkFBQTtBRDlScEI7QUNzU1k7RUFDSSx5QkFBQTtBRHBTaEI7QUMwU0k7RUFDSSxzQ0FBQTtFQUNBLGFBQUE7QUR4U1I7QUNpVEk7O0VBRUksMkJBQUE7RUFDQSxZQUFBO0FEL1NSO0FDaVRROztFQUNJLDJCQUFBO0VBQ0EsMkJBQUE7RUFDQSxtQkFBQTtBRDlTWjtBQ29UWTtFQUNJLHlCQUFBO0VBQ0EsY0FBQTtBRGxUaEI7QUNvVGdCO0VBQ0kseUJBQUE7QURsVHBCO0FDeVRJO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBRHZUUjtBQ3lUUTtFQUNJLFVBQUE7RUFDQSxXQUFBO0FEdlRaO0FDMFRRO0VBQ0ksbUJBQUE7QUR4VFo7QUMyVFE7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FEelRaO0FDNFRRO0VBQ0ksZ0JBQUE7QUQxVFo7QUNnVVk7RUFDSSx5QkFBQTtBRDlUaEI7QUNtVVk7RUFDSSxjQUFBO0FEalVoQjtBQ3VVUTtFQUNJLHNCQUFBO0VBQ0EsV0FBQTtBRHJVWjtBQzBVUTtFQUNJLGFBQUE7QUR4VVo7QUM2VVE7RUFDSSxvQ0FBQTtBRDNVWjtBQytVSTtFQUNJLGNBQUE7QUQ3VVI7QUNnVkk7RUFDSSxjQUFBO0FEOVVSO0FDbVZBO0VBQ0ksb0NBQUE7QURoVko7QUNvVkE7RUFDSSxpQkFBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0FEalZKO0FDb1ZBO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7RUFDQSxtQkFBQTtBRGpWSjtBQ21WSTtFQUNJLHlCQUFBO0FEalZSO0FDb1ZJO0VBQ0kseUJBQUE7RUFDQSxrQkFBQTtBRGxWUjtBQ3FWSTtFQUNJLG1DQUFBO0FEblZSO0FDc1ZJO0VBQ0ksZUFBQTtBRHBWUjtBQ3dWQTtFQUNJLDJCQUFBO0VBQ0EsMkJBQUE7RUFDQSwyQkFBQTtFQUNBLDhCQUFBO0FEclZKO0FDd1ZBO0VBQ0ksMkJBQUE7RUFDQSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7QURyVko7QUN3VkE7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0EsWUFBQTtBRHJWSjtBQ3dWQTtFQUNJLG1DQUFBO0VBQ0Esa0JBQUE7QURyVko7QUN5VkE7RUFDSSxnQkFBQTtFQUNBLDBCQUFBO0FEdFZKO0FDeVZBO0VBQ0ksZ0JBQUE7RUFDQSxnQkFBQTtFQUNBLGlCQUFBO0FEdFZKO0FDMFZBO0VBQ0ksVUFBQTtBRHZWSjtBQzBWQSxVQUFBO0FBQ0E7RUFDSSxtQkFBQTtBRHZWSjtBQzBWQSxXQUFBO0FBQ0E7RUFDSSxtQkFBQTtBRHZWSjtBQzBWQSxVQUFBO0FBQ0E7RUFDSSxtQkFBQTtBRHZWSjtBQzBWQTtFQUNJLGdCQUFBO0FEdlZKO0FDMFZBO0VBQ0ksNkJBQUE7QUR2Vko7QUMwVkE7RUFDSSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxvQkFBQTtFQUNBLG9CQUFBO0VBQ0EsY0FBQTtFQUNBLG1DQUFBO0VBQ0EsMEJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0EsVUFBQTtFQUNBLGFBQUE7RUFDQSxxQkFBQTtFQUNBLFdBQUE7RUFDQSx1QkFBQTtFQUNBLDBCQUFBO0VBQ0EsMEJBQUE7QUR2Vko7QUMyVkE7RUFDSTtJQUNLLHlCQUFBO0lBQ0Esc0NBQUE7RUR4VlA7RUN5Vk87SUFDTyxzQkFBQTtFRHZWZDtFQ3lWTztJQUNLLHVCQUFBO0lBQ0Esc0NBQUE7RUR2Vlo7QUFDRiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYmF0Y2gvYmF0Y2hncmlkbGlzdGluZy9iYXRjaGdyaWRsaXN0aW5nLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiQGNoYXJzZXQgXCJVVEYtOFwiO1xuI2JhdGNoY29udGFpbmVyIC5hcHByb3ZlZCB7XG4gIGNvbG9yOiAjMDBhNTUxO1xufVxuI2JhdGNoY29udGFpbmVyIC5wcmludCwgI2JhdGNoY29udGFpbmVyIC5jYW5jZWxsZWQsICNiYXRjaGNvbnRhaW5lciAucmVxdWVzdGVkYmFjaywgI2JhdGNoY29udGFpbmVyIC5yZXF1ZXN0ZWRhY2Nlc3MsICNiYXRjaGNvbnRhaW5lciAuYXNzZXNzbWVudCwgI2JhdGNoY29udGFpbmVyIC5xdWFsaXR5Y2hlY2ssICNiYXRjaGNvbnRhaW5lciAudGVhY2hpbmcsICNiYXRjaGNvbnRhaW5lciAubmV3dGFnIHtcbiAgY29sb3I6ICMwMGE1NTE7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuI2JhdGNoY29udGFpbmVyIC5uZXd0YWcge1xuICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC50ZWFjaGluZyB7XG4gIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjb250YWluZXIgLnF1YWxpdHljaGVjayB7XG4gIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjb250YWluZXIgLmFzc2Vzc21lbnQge1xuICBjb2xvcjogI0MzMzBDRTtcbn1cbiNiYXRjaGNvbnRhaW5lciAucmVxdWVzdGVkYWNjZXNzIHtcbiAgY29sb3I6ICMxMDlkOTg7XG59XG4jYmF0Y2hjb250YWluZXIgLnJlcXVlc3RlZGFjY2VzcyB7XG4gIGNvbG9yOiAjMTA5ZDk4O1xufVxuI2JhdGNoY29udGFpbmVyIC5yZXF1ZXN0ZWRiYWNrIHtcbiAgY29sb3I6ICNiMTQ0Mjg7XG59XG4jYmF0Y2hjb250YWluZXIgLmNhbmNlbGxlZCB7XG4gIGNvbG9yOiAjZWQxYzI3O1xufVxuI2JhdGNoY29udGFpbmVyIC51cGRhdGUge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNiYXRjaGNvbnRhaW5lciAuZGVjbGluZWQge1xuICBjb2xvcjogI2VkMWMyNztcbn1cbiNiYXRjaGNvbnRhaW5lciAubmV3IHtcbiAgY29sb3I6ICNmNDgxMWY7XG59XG4jYmF0Y2hjb250YWluZXIgLnJlcXVpcmVkZmllbHMgaDQge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNiYXRjaGNvbnRhaW5lciAucmVxdWlyZWRmaWVscyAueWVzbm8ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI2JhdGNoY29udGFpbmVyIC5yZXF1aXJlZGZpZWxzIC55ZXNubyBwIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jYmF0Y2hjb250YWluZXIgLnJlcXVpcmVkZmllbHMgLnllc25vIHAgc3BhbiB7XG4gIGNvbG9yOiAjZGM0YzY0O1xufVxuI2JhdGNoY29udGFpbmVyIC50eHQtZ3J5IHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jYmF0Y2hjb250YWluZXIgLnR4dC1ncnkzIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jYmF0Y2hjb250YWluZXIgbWF0LWZvb3Rlci1yb3cge1xuICBtaW4taGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjb250YWluZXIgI3Byb2ZpbGUgLmhpbnQge1xuICB3aWR0aDogMTY4cHg7XG4gIHdvcmQtYnJlYWs6IGJyZWFrLXdvcmQ7XG59XG4jYmF0Y2hjb250YWluZXIgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkIHtcbiAgd2lkdGg6IDE2MnB4ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogMTYycHggIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAjcHJvZmlsZSAjdXBsb2FkZWQgLmZpbGVycyBpbnB1dC5tYXQtaW5wdXQtZWxlbWVudCB7XG4gIG1hcmdpbi10b3A6IDByZW0gIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAjcHJvZmlsZSAjdXBsb2FkZWQgLmZpbGVycyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICM5OTk5OTk7XG59XG4jYmF0Y2hjb250YWluZXIgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtZmxleCB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgcGFkZGluZzogMCAycHggIWltcG9ydGFudDtcbiAgYm9yZGVyLXRvcDogMC40ZW0gc29saWQgdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAjcHJvZmlsZSAjdXBsb2FkZWQgLmZpbGVycyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcbiAgYm9yZGVyOiAxcHggc29saWQgY3VycmVudGNvbG9yICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyOiAxcHggc29saWQgY3VycmVudGNvbG9yICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMHB4O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIG1hdC1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5OTk5O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIG1hdC1sYWJlbCBzcGFuIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYmF0Y2hjb250YWluZXIgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgLm1hdC1mb3JtLWZpZWxkIGxhYmVsIHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBtYXJnaW4tdG9wOiAxcHg7XG59XG4jYmF0Y2hjb250YWluZXIgI3Byb2ZpbGUgI3VwbG9hZGVkIC5maWxlcnMgaW5wdXQubWF0LWlucHV0LWVsZW1lbnQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIGhlaWdodDogMTYycHggIWltcG9ydGFudDtcbiAgd2lkdGg6IDE2MnB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDJweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZmlsZXJzIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xuICB0b3A6IC0wLjc1ZW07XG59XG4jYmF0Y2hjb250YWluZXIgI3Byb2ZpbGUgI3VwbG9hZGVkIC5kb2N1bWVudCBtYXQtbGFiZWwge1xuICBjb2xvcjogIzk5OTk5OTtcbn1cbiNiYXRjaGNvbnRhaW5lciAjcHJvZmlsZSAjdXBsb2FkZWQgLmRvY3VtZW50IGltZyB7XG4gIHdpZHRoOiAyMHB4O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZG9jdW1lbnQgbWF0LWljb24ge1xuICBjb2xvcjogIzk5OTk5OTtcbn1cbiNiYXRjaGNvbnRhaW5lciAjcHJvZmlsZSAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcbiAgcGFkZGluZy1ib3R0b206IDBweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAjcHJvZmlsZSAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcbiAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyICNwcm9maWxlICN1cGxvYWRlZCAuZG9jdW1lbnQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtcmFkaW8tYnV0dG9uIC5tYXQtcmFkaW8tb3V0ZXItY2lyY2xlIHtcbiAgYm9yZGVyLWNvbG9yOiAjZDlkOWQ5O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtcmFkaW8tYnV0dG9uLm1hdC1hY2NlbnQgLm1hdC1yYWRpby1pbm5lci1jaXJjbGUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZTIwNjEzO1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtcmFkaW8tYnV0dG9uLm1hdC1hY2NlbnQubWF0LXJhZGlvLWNoZWNrZWQgLm1hdC1yYWRpby1vdXRlci1jaXJjbGUge1xuICBib3JkZXItY29sb3I6ICNkOWQ5ZDk7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1yYWRpby1sYWJlbC1jb250ZW50IHtcbiAgY29sb3I6ICMwMDAwMDBjYztcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtY2VsbCAuZG9jdW1lbnRfaW1nIHtcbiAgd2lkdGg6IDMycHg7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1jZWxsIC52aWV3ZG9jdW1lbnQge1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI2JhdGNoY29udGFpbmVyIC5zdWJtaXRfYnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4td2lkdGg6IDExMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jYmF0Y2hjb250YWluZXIgLmNhbmNlbGJ0biB7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlOGU4ZTg7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1pbmstYmFyIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtdGFiLWhlYWRlciB7XG4gIGJvcmRlcjogMHB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LXRhYi1sYWJlbC1hY3RpdmUgLmNvbnRlbnRjaXJjbGUge1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZmZmICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC10YWItbGFiZWwtYWN0aXZlIHAge1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDEyNzlweCkge1xuICAjYmF0Y2hjb250YWluZXIgLmZpbGVfdXBsb2FkICN1cGxvYWRlZCB7XG4gICAgZGlzcGxheTogYmxvY2s7XG4gIH1cbn1cbiNiYXRjaGNvbnRhaW5lciAuZmlsZV91cGxvYWQgI3VwbG9hZGVkIC5maWxlcnMge1xuICB3aWR0aDogNTAlO1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDEyNzlweCkge1xuICAjYmF0Y2hjb250YWluZXIgLmZpbGVfdXBsb2FkICN1cGxvYWRlZCAuZmlsZXJzIHtcbiAgICB3aWR0aDogMTAwJTtcbiAgfVxufVxuI2JhdGNoY29udGFpbmVyIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQgLmRvY3VtZW50IHtcbiAgd2lkdGg6IDUwJTtcbiAgcGFkZGluZy1sZWZ0OiAzMHB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2JhdGNoY29udGFpbmVyIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNiYXRjaGNvbnRhaW5lciAuZmlsZV91cGxvYWQgI3VwbG9hZGVkIC5kb2N1bWVudCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xuICBsZWZ0OiAtMjM5cHg7XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTI3OXB4KSB7XG4gICNiYXRjaGNvbnRhaW5lciAuZmlsZV91cGxvYWQgI3VwbG9hZGVkIC5kb2N1bWVudCB7XG4gICAgd2lkdGg6IDEwMCU7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHg7XG4gIH1cbn1cbiNiYXRjaGNvbnRhaW5lciAuZmlsZV91cGxvYWQgI3VwbG9hZGVkIC5kb2N1bWVudCAuY2xvc2VfaWNvbnMge1xuICBkaXNwbGF5OiBibG9jaztcbn1cbiNiYXRjaGNvbnRhaW5lciAuZmlsZV91cGxvYWQgI3VwbG9hZGVkIC5kb2N1bWVudCAuZGVsZXRlX2ljb24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2JhdGNoY29udGFpbmVyIC5maWxlX3VwbG9hZCAjdXBsb2FkZWQgLmRvY3VtZW50IC52aWV3X2J0biB7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNiYXRjaGNvbnRhaW5lciAud29ya2NoZWNrYm94IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNiYXRjaGNvbnRhaW5lciAud29ya2NoZWNrYm94IC5tYXQtY2hlY2tib3gtaW5uZXItY29udGFpbmVyIHtcbiAgd2lkdGg6IDIwcHg7XG4gIGhlaWdodDogMjBweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAud29ya2NoZWNrYm94IC5tYXQtY2hlY2tib3gtY2hlY2tlZC5tYXQtYWNjZW50IC5tYXQtY2hlY2tib3gtYmFja2dyb3VuZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAud29ya2NoZWNrYm94IC5tYXQtY2hlY2tib3gtZnJhbWUge1xuICBib3JkZXI6IDFweCBzb2xpZCAjYzRjNGM0O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtc2xpZGUtdG9nZ2xlLm1hdC1jaGVja2VkIC5tYXQtc2xpZGUtdG9nZ2xlLXRodW1iIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwYTU1MTtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LXNsaWRlLXRvZ2dsZS5tYXQtY2hlY2tlZCAubWF0LXNsaWRlLXRvZ2dsZS1iYXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDBhNTUwNjI7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC10YWItbGFiZWwge1xuICBvcGFjaXR5OiAxO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIG1hcmdpbi1yaWdodDogMjBweDtcbiAgaGVpZ2h0OiA4MHB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LXRhYi1saXN0IHtcbiAgb3BhY2l0eTogMTtcbiAgbWluLXdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1jYXJkIHtcbiAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWNhcmQgLm1hdC1jYXJkLWNvbnRlbnQgaW1nIHtcbiAgd2lkdGg6IDEwMHB4O1xuICBoZWlnaHQ6IDEwMHB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtY2FyZCAubWF0LWNhcmQtY29udGVudCAuY2FyZGluZm8gaDQge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWNhcmQgLm1hdC1jYXJkLWNvbnRlbnQgLmNhcmRpbmZvIC5jZW50cmVfaW5mbyB7XG4gIGdhcDogMzBweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWNhcmQgLm1hdC1jYXJkLWNvbnRlbnQgLmNhcmRpbmZvIC5jZW50cmVfaW5mbyBwIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1jYXJkIC5tYXQtY2FyZC1jb250ZW50IC5jYXJkaW5mbyAuY2VudHJlX2luZm8gcCBzcGFuIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1jYXJkIC5jYXJkYnRuIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBtYXJnaW4tdG9wOiAtMzRweDtcbiAgd2lkdGg6IDkzJTtcbiAgYm9yZGVyLXJhZGl1czogMjBweDtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGJhc2VsaW5lO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGVuZDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWNhcmQgLmNhcmRidG4gYnV0dG9uIHtcbiAgYm9yZGVyLXJhZGl1czogMjBweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAudGFic2NvbnRlbnQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNiYXRjaGNvbnRhaW5lciAudGFic2NvbnRlbnQgLmNvbnRlbnRjaXJjbGUge1xuICB3aWR0aDogMjhweDtcbiAgaGVpZ2h0OiAyOHB4O1xuICBib3JkZXItcmFkaXVzOiA1MCU7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XG4gIGNvbG9yOiAjODQ4NDg0O1xuICBib3gtc2hhZG93OiAwIDAgOHB4IHJnYmEoNTEsIDUxLCA1MSwgMC4xNSk7XG4gIGJvcmRlcjogMXB4IHNvbGlkICM4NDg0ODQ7XG59XG4jYmF0Y2hjb250YWluZXIgLnRhYnNjb250ZW50IC50YWJ0aXRsZSBwIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jYmF0Y2hjb250YWluZXIgLnN1YnRpdGxlZm9ybSB7XG4gIGZvbnQtd2VpZ2h0OiA3MDA7XG59XG4jYmF0Y2hjb250YWluZXIgLnRpdGxlIGg0IHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jYmF0Y2hjb250YWluZXIgLnRpdGxlIC5zdWJ0aXRsZSBoNCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2JhdGNoY29udGFpbmVyIC50aXRsZSAubGluZSB7XG4gIGZsZXg6IDQ7XG59XG4jYmF0Y2hjb250YWluZXIgLnRpdGxlIC5saW5lIC5tYXQtZGl2aWRlciB7XG4gIHdpZHRoOiAxMiU7XG4gIGJvcmRlci10b3Atd2lkdGg6IDNweDtcbiAgYm9yZGVyLWNvbG9yOiAjRUQxQzI3O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtaW5wdXQtZWxlbWVudCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcbiAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICM2YmE1ZWM7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjMGM0YjlhO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjZGM0YzY0O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xuICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjb250YWluZXIgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI2JhdGNoY29udGFpbmVyIC5kYXRlX2V4cCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI2JhdGNoY29udGFpbmVyIGlucHV0W3JlYWRvbmx5XSB7XG4gIGN1cnNvcjogbm8tZHJvcDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQubWF0LWZvY3VzZWQubWF0LXByaW1hcnkgLm1hdC1zZWxlY3QtYXJyb3cge1xuICBjb2xvcjogdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogI2RjNGM2NCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5maWx0ZXIge1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jYmF0Y2hjb250YWluZXIgLnVzZXJpbWcge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNiYXRjaGNvbnRhaW5lciAudXNlcmltZyBpbWcge1xuICB3aWR0aDogMTY4cHg7XG4gIGhlaWdodDogMTY4cHg7XG59XG4jYmF0Y2hjb250YWluZXIgLnVzZXJpbWcgaW1nOmhvdmVyIHtcbiAgdHJhbnNmb3JtOiBzY2FsZSgxLjEpO1xufVxuI2JhdGNoY29udGFpbmVyIC51c2VyaW1nIHNwYW4ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgd2lkdGg6IDMycHg7XG4gIGhlaWdodDogMzJweDtcbiAgYm9yZGVyLXJhZGl1czogMjBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2M0YzRjNDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0b3A6IDMzcHg7XG4gIGxlZnQ6IC00NHB4O1xuICBvcGFjaXR5OiAwLjU7XG59XG4jYmF0Y2hjb250YWluZXIgLnVzZXJpbWcgc3Bhbjpob3ZlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjc3MDtcbiAgdHJhbnNmb3JtOiBzY2FsZSgxLjEpO1xufVxuI2JhdGNoY29udGFpbmVyIC51c2VyaW1nIHNwYW46aG92ZXIgLm1hdC1pY29uIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1pY29uIHtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1zdWZmaXggLm1hdC1pY29uIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNiYXRjaGNvbnRhaW5lciAuYXJhYmljbGFuZ3VhZ2UgaW5wdXQsXG4jYmF0Y2hjb250YWluZXIgLmFyYWJpY2xhbmd1YWdlIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuI2JhdGNoY29udGFpbmVyIC5hcmFiaWNsYW5ndWFnZSAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbiNiYXRjaGNvbnRhaW5lciAuYXJhYmljbGFuZ3VhZ2UgLm1hdC1lcnJvciB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuI2JhdGNoY29udGFpbmVyIC5lZGl0YnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgcGFkZGluZzogNHB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5lZGl0YnRuOmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAuY291cmVib3gge1xuICBib3gtc2hhZG93OiAwIDAgNHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbiAgcGFkZGluZzogNXB4IDEwcHg7XG59XG4jYmF0Y2hjb250YWluZXIgLmljb25ncm91cCAubWF0LWljb24ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBib3JkZXI6IDFweCBzb2xpZCAjZDlkOWQ5O1xuICB3aWR0aDogNDBweDtcbiAgaGVpZ2h0OiA0MHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZm9udC1zaXplOiAzMHB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5pY29uZ3JvdXAgLm1hdC1pY29uOm50aC1jaGlsZCgxKSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XG4gIGNvbG9yOiAjZmZmO1xufVxuI2JhdGNoY29udGFpbmVyICNkb2N1bWVudHMgI3VwbG9hZGVkLFxuI2JhdGNoY29udGFpbmVyIC5kb2N1bWVudHMgI3VwbG9hZGVkIHtcbiAgZGlzcGxheTogZmxleDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA5NTlweCkge1xuICAjYmF0Y2hjb250YWluZXIgI2RvY3VtZW50cyAjdXBsb2FkZWQsXG4jYmF0Y2hjb250YWluZXIgLmRvY3VtZW50cyAjdXBsb2FkZWQge1xuICAgIGRpc3BsYXk6IGJsb2NrO1xuICB9XG59XG4jYmF0Y2hjb250YWluZXIgI2RvY3VtZW50cyAjdXBsb2FkZWQgLmZpbGVycyxcbiNiYXRjaGNvbnRhaW5lciAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZmlsZXJzIHtcbiAgd2lkdGg6IDUwJTtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA5NTlweCkge1xuICAjYmF0Y2hjb250YWluZXIgI2RvY3VtZW50cyAjdXBsb2FkZWQgLmZpbGVycyxcbiNiYXRjaGNvbnRhaW5lciAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZmlsZXJzIHtcbiAgICB3aWR0aDogMTAwJTtcbiAgfVxufVxuI2JhdGNoY29udGFpbmVyICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCxcbiNiYXRjaGNvbnRhaW5lciAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQge1xuICB3aWR0aDogNTAlO1xuICBwYWRkaW5nLWxlZnQ6IDMwcHg7XG59XG4jYmF0Y2hjb250YWluZXIgI2RvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQsXG4jYmF0Y2hjb250YWluZXIgLmRvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2JhdGNoY29udGFpbmVyICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCxcbiNiYXRjaGNvbnRhaW5lciAuZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2JhdGNoY29udGFpbmVyICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgsXG4jYmF0Y2hjb250YWluZXIgLmRvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCB7XG4gIGxlZnQ6IC0yMzlweDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA5NTlweCkge1xuICAjYmF0Y2hjb250YWluZXIgI2RvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50LFxuI2JhdGNoY29udGFpbmVyIC5kb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCB7XG4gICAgd2lkdGg6IDEwMCU7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHg7XG4gIH1cbn1cbiNiYXRjaGNvbnRhaW5lciAjZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLmNsb3NlX2ljb25zLFxuI2JhdGNoY29udGFpbmVyIC5kb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAuY2xvc2VfaWNvbnMge1xuICBkaXNwbGF5OiBibG9jaztcbn1cbiNiYXRjaGNvbnRhaW5lciAjZG9jdW1lbnRzICN1cGxvYWRlZCAuZG9jdW1lbnQgLmRlbGV0ZV9pY29uLFxuI2JhdGNoY29udGFpbmVyIC5kb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAuZGVsZXRlX2ljb24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2JhdGNoY29udGFpbmVyICNkb2N1bWVudHMgI3VwbG9hZGVkIC5kb2N1bWVudCAudmlld19idG4sXG4jYmF0Y2hjb250YWluZXIgLmRvY3VtZW50cyAjdXBsb2FkZWQgLmRvY3VtZW50IC52aWV3X2J0biB7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWFzdGVyUGFnZVRvcCB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jYmF0Y2hjb250YWluZXIgLmF3YXJlZHRhYmxlIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBtYXJnaW46IDEwcHggMHB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5hd2FyZWR0YWJsZSAubWFuYWdlb3B0aW9ucyB7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jYmF0Y2hjb250YWluZXIgLmF3YXJlZHRhYmxlIC5tYXQtcm93OmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNSAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5hd2FyZWR0YWJsZSAubWF0LWNlbGwge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNiYXRjaGNvbnRhaW5lciAuYXdhcmVkdGFibGUgLm1hdC1oZWFkZXItY2VsbCB7XG4gIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1zZWxlY3QtdmFsdWUge1xuICBjb2xvcjogIzYyNjM2NjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDE1cHg7XG4gIG1hcmdpbjogMHB4IDEwcHggIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAucmVuZXdhbCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGJveC1zaGFkb3c6IDAgMCA0cHggcmdiYSgwLCAwLCAwLCAwLjIpO1xuICBwYWRkaW5nOiAxNXB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jYmF0Y2hjb250YWluZXIgLnJlbmV3YWwgLnJlbmV3YWxfaW5mbyB7XG4gIGdhcDogMzBweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI2JhdGNoY29udGFpbmVyIC5yZW5ld2FsIC5yZW5ld2FsX2luZm8gLm1hdC1kaXZpZGVyIHtcbiAgaGVpZ2h0OiA1MXB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5yZW5ld2FsIC5yZW5ld2FsX2luZm8gLm1hdC1kaXZpZGVyIC5tYXQtZGl2aWRlci12ZXJ0aWNhbCB7XG4gIGJvcmRlci1yaWdodC1jb2xvcjogI2M0YzRjNDtcbiAgYm9yZGVyLXJpZ2h0LXdpZHRoOiAycHggIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAucmVuZXdhbCAucmVuZXdhbF9pbmZvIHAge1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNiYXRjaGNvbnRhaW5lciAucmVuZXdhbCAucmVuZXdhbF9pbmZvIHAgc3BhbiB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2JhdGNoY29udGFpbmVyIC5yZW5ld2FsIC5yZW5ld2FsX2luZm8gLnJlbWFpbmRlciB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNFRDFDMjc7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgcGFkZGluZzogOHB4O1xufVxuI2JhdGNoY29udGFpbmVyIC5yZW5ld2FsIC5yZW5ld2FsX2luZm8gLnJlbWFpbmRlciBwIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYmF0Y2hjb250YWluZXIgLnJlbmV3YWwgLnJlbmV3YWxfaW5mbyAucmVtYWluZGVyIHAgc3BhbiB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2JhdGNoY29udGFpbmVyIC5yZW5ld2FsIC52aWV3YnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcbiAgY29sb3I6ICNmZmY7XG59XG4jYmF0Y2hjb250YWluZXIgLnN1Y2Nlc3MgLmNlbnRlcmNvbnRlbnQge1xuICBoZWlnaHQ6IDcxdmg7XG59XG4jYmF0Y2hjb250YWluZXIgLnN1Y2Nlc3MgLnN1Y2Nlc3NfaWNvbiB7XG4gIHdpZHRoOiA3MnB4O1xuICBoZWlnaHQ6IDcycHg7XG4gIGJvcmRlci1yYWRpdXM6IDUwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJvcmRlcjogM3B4IHNvbGlkICMwMGE1NTE7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI2JhdGNoY29udGFpbmVyIC5zdWNjZXNzIC5zdWNjZXNzX2ljb24gLm1hdC1pY29uIHtcbiAgZm9udC1zaXplOiA1MHB4O1xuICBjb2xvcjogIzAwYTU1MTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4jYmF0Y2hjb250YWluZXIgLnN1Y2Nlc3MgLnN1Y2Nlc19tc2cgaDQge1xuICBjb2xvcjogIzAwYTU1MTtcbn1cbiNiYXRjaGNvbnRhaW5lciAuc3VjY2VzcyAuc3VjY2VzX21zZyBwIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jYmF0Y2hjb250YWluZXIgLnN1Y2Nlc3MgLnN1Y2Nlc19tc2cgLnZpZXdmb3JtIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcbiAgY29sb3I6ICNmZmY7XG59XG4jYmF0Y2hjb250YWluZXIgLmRlY2xpbmUge1xuICBib3JkZXI6IDFweCBzb2xpZCAjRUQxQzI3O1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG4gIHBhZGRpbmc6IDE1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY4Zjg7XG59XG4jYmF0Y2hjb250YWluZXIgLmRlY2xpbmUgaDQge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNiYXRjaGNvbnRhaW5lciAuZGVjbGluZSBwIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3gtc2hhZG93OiBub25lO1xuICBmb250LXNpemU6IDE2cHg7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1yZWFkb25seSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgY29sb3I6ICNkOWQ5ZDk7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjNmJhNWVjO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzBjNGI5YTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0wLjlyZW0pIHNjYWxlKDAuNzUpO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XG4gIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbiNiYXRjaGNvbnRhaW5lciAuZGF0ZV9leHAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNiYXRjaGNvbnRhaW5lciAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGlja1tuZy1yZWZsZWN0LXN0YXRlPXJlYWRvbmx5XSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNkOWQ5ZDk7XG59XG4jYmF0Y2hjb250YWluZXIgaW5wdXRbcmVhZG9ubHldIHtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC5tYXQtZm9jdXNlZC5tYXQtcHJpbWFyeSAubWF0LXNlbGVjdC1hcnJvdyB7XG4gIGNvbG9yOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjZGM0YzY0ICFpbXBvcnRhbnQ7XG59XG4jYmF0Y2hjb250YWluZXIgLmNhcmQge1xuICBib3gtc2hhZG93OiAwIDAgNHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtcbiAgcGFkZGluZzogMTVweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAjc2VhcmNocm93LFxuI2JhdGNoY29udGFpbmVyICNmaWx0ZXJzaG93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmU7XG59XG4jYmF0Y2hjb250YWluZXIgI3NlYXJjaHJvdyAuc2VyYWNocm93LFxuI2JhdGNoY29udGFpbmVyICNmaWx0ZXJzaG93IC5zZXJhY2hyb3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jYmF0Y2hjb250YWluZXIgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG59XG4jYmF0Y2hjb250YWluZXIgLnNjcm9sbGRhdGEge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHotaW5kZXg6IDE7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBvdmVyZmxvdy14OiBhdXRvO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcbn1cbiNiYXRjaGNvbnRhaW5lciAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogNnB4O1xuICBoZWlnaHQ6IDVweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xuICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xufVxuI2JhdGNoY29udGFpbmVyIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbn1cbiNiYXRjaGNvbnRhaW5lciAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xufVxuI2JhdGNoY29udGFpbmVyIC50YWJmb3JjbGllbnRlbGVuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC50YWJmb3JjbGllbnRlbGVuZXcgLm1hbmFnZW9wdGlvbnMgLm1hdC1pY29uIHtcbiAgY29sb3I6ICNhY2FjYWM7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hc3Rlci1tZW51IC5tYXQtbWVudS1jb250ZW50IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwMDtcbiAgY29sb3I6ICNmZmY7XG59XG4jYmF0Y2hjb250YWluZXIgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Q5ZDlkOSAhaW1wb3J0YW50O1xufVxuI2JhdGNoY29udGFpbmVyIC5tYXQtc29ydC1oZWFkZXItYXJyb3cge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNiYXRjaGNvbnRhaW5lciAubm9mb3VuZCB7XG4gIG1hcmdpbi10b3A6IDUlO1xufVxuXG4ubWF0LW1lbnUtcGFuZWwge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjNjY2NjY2ICFpbXBvcnRhbnQ7XG59XG5cbi5tYXQtbWVudS1pdGVtIHtcbiAgbGluZS1oZWlnaHQ6IDM2cHg7XG4gIGhlaWdodDogMzFweDtcbiAgY29sb3I6ICNmZmY7XG59XG5cbi5zZWFyY2hpbm11bHRpc2VsZWN0IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgcGFkZGluZzogNnB4IDEwcHg7XG4gIGJhY2tncm91bmQ6ICNlOWVkZjA7XG59XG4uc2VhcmNoaW5tdWx0aXNlbGVjdCBpbnB1dDo6LXdlYmtpdC1pbnB1dC1wbGFjZWhvbGRlciB7XG4gIGNvbG9yOiAjN2Y4ZmEzICFpbXBvcnRhbnQ7XG59XG4uc2VhcmNoaW5tdWx0aXNlbGVjdCBpIHtcbiAgY29sb3I6ICM3ZjhmYTMgIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogNnB4O1xufVxuLnNlYXJjaGlubXVsdGlzZWxlY3QgLnNlYXJjaHNlbGVjdCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xufVxuLnNlYXJjaGlubXVsdGlzZWxlY3QgLnJlc2V0aWNvbiB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cblxuLnNlbGVjdF93aXRoX3NlYXJjaCB7XG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcbiAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiA0MHB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDE1cHggIWltcG9ydGFudDtcbn1cblxuLnNlbGVjdF93aXRoX29wdGlvbiB7XG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcbiAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiA0OXB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDE1cHggIWltcG9ydGFudDtcbn1cblxuLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBwYWRkaW5nOiAxMHB4IDEwcHg7XG4gIGJhY2tncm91bmQ6ICNlOWVkZjA7XG4gIG1hcmdpbjogMTBweDtcbn1cblxuLnNlYXJjaHNlbGVjdCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWxlZnQ6IDEwcHg7XG59XG5cbi5tYXQtb3B0aW9uLm1hdC1hY3RpdmUge1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xuICBjb2xvcjogcmdiYSgwLCAwLCAwLCAwLjg3KTtcbn1cblxuLm9wdGlvbi1saXN0aW5nIHtcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgb3ZlcmZsb3cteTogYXV0bztcbiAgbWF4LWhlaWdodDogMjkwcHg7XG59XG5cbi5vcHRpb24tbGlzdGluZzo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogN3B4O1xufVxuXG4vKiBUcmFjayAqL1xuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG5cbi8qIEhhbmRsZSAqL1xuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XG4gIGJhY2tncm91bmQ6ICNFRDFDMjc7XG59XG5cbi8qIGhvdmVyICovXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogI0VEMUMyNztcbn1cblxuLm15UGFuZWxDbGFzcyB7XG4gIG1hcmdpbjogMzZweCAwcHg7XG59XG5cbi5tYXQtc2VsZWN0LWFycm93IHtcbiAgY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XG59XG5cbi5tYXQtc2VsZWN0LWFycm93OmJlZm9yZSB7XG4gIGNvbnRlbnQ6IFwi74G4XCI7XG4gIHNwZWFrOiBub25lO1xuICBmb250LXN0eWxlOiBub3JtYWw7XG4gIGZvbnQtd2VpZ2h0OiBub3JtYWw7XG4gIGZvbnQtdmFyaWFudDogbm9ybWFsO1xuICB0ZXh0LXRyYW5zZm9ybTogbm9uZTtcbiAgbGluZS1oZWlnaHQ6IDE7XG4gIC13ZWJraXQtZm9udC1zbW9vdGhpbmc6IGFudGlhbGlhc2VkO1xuICBmb250LXNpemU6IDEwcHggIWltcG9ydGFudDtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBoZWlnaHQ6IDI1cHg7XG4gIHdpZHRoOiAyNXB4O1xuICByaWdodDogMHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogZmxleC1lbmQ7XG4gIGJvdHRvbTogNHB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZm9udC1mYW1pbHk6IFwiRm9udEF3ZXNvbWVcIjtcbiAgY29sb3I6IHJnYmEoMCwgMCwgMCwgMC41NCk7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAubWFzdGVyUGFnZVRvcCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgfVxuICAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICAgIG1hcmdpbjogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgfVxufSIsIiNiYXRjaGNvbnRhaW5lciB7XHJcbiAgXHJcbiAgICAuYXBwcm92ZWQge1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxO1xyXG4gICAgfVxyXG5cclxuICAgIC5wcmludHtcclxuICAgICAgICAgY29sb3I6ICMwMGE1NTE7XHJcbiAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgfVxyXG4gICAgLm5ld3RhZ3tcclxuICAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDsgIFxyXG4gICAgfVxyXG4gICAgLnRlYWNoaW5ne1xyXG4gICAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICAgIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7ICBcclxuICAgIH1cclxuICAgIC5xdWFsaXR5Y2hlY2t7XHJcbiAgICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgICAgY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDsgIFxyXG4gICAgfVxyXG4gICAgLmFzc2Vzc21lbnR7XHJcbiAgICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgICAgY29sb3I6ICNDMzMwQ0U7XHJcbiAgICB9XHJcbiAgICAucmVxdWVzdGVkYWNjZXNze1xyXG4gICAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICAgIGNvbG9yOiAjMTA5ZDk4O1xyXG4gICAgfVxyXG4gICAgLnJlcXVlc3RlZGFjY2Vzc3tcclxuICAgICAgICBAZXh0ZW5kIC5wcmludDtcclxuICAgICAgICBjb2xvcjogIzEwOWQ5ODtcclxuICAgIH1cclxuICAgIC5yZXF1ZXN0ZWRiYWNre1xyXG4gICAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICAgIGNvbG9yOiAjYjE0NDI4O1xyXG4gICAgfVxyXG4gICAgLmNhbmNlbGxlZHtcclxuICAgICAgICBAZXh0ZW5kIC5wcmludDtcclxuICAgICAgICBjb2xvcjogI2VkMWMyNztcclxuICAgIH1cclxuXHJcbiAgICAudXBkYXRlIHtcclxuICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgIH1cclxuXHJcbiAgICAuZGVjbGluZWQge1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3O1xyXG4gICAgfVxyXG5cclxuICAgIC5uZXcge1xyXG4gICAgICAgIGNvbG9yOiAjZjQ4MTFmO1xyXG4gICAgfVxyXG5cclxuICAgIC5yZXF1aXJlZGZpZWxzIHtcclxuICAgICAgICBoNCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnllc25vIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC50eHQtZ3J5IHtcclxuICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgIH1cclxuXHJcbiAgICAudHh0LWdyeTMge1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG4gICAgbWF0LWZvb3Rlci1yb3cge1xyXG4gICAgICAgIG1pbi1oZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgICNwcm9maWxlIHtcclxuICAgICAgICAuaGludCB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxNjhweDtcclxuICAgICAgICAgICAgd29yZC1icmVhazogYnJlYWstd29yZDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICN1cGxvYWRlZCB7XHJcbiAgICAgICAgICAgIC5maWxlcnMge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTYycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6IDE2MnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgaW5wdXQubWF0LWlucHV0LWVsZW1lbnQge1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDByZW0gIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWZsZXgge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDAgMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlci10b3A6IDAuNGVtIHNvbGlkIHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGN1cnJlbnRjb2xvciAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAxcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGN1cnJlbnRjb2xvciAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAxcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDBweDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgbWF0LWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzk5OTk5OTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgc3BhbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQgbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAxcHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgaW5wdXQge1xyXG4gICAgICAgICAgICAgICAgICAgICYubWF0LWlucHV0LWVsZW1lbnQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDogMTYycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDE2MnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgICAgICAgICB0b3A6IC0wLjc1ZW07XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5kb2N1bWVudCB7XHJcbiAgICAgICAgICAgICAgICBtYXQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgbWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjOTk5OTk5O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXI6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAxcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlcjogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDFweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LXJhZGlvLWJ1dHRvbiB7XHJcbiAgICAgICAgLm1hdC1yYWRpby1vdXRlci1jaXJjbGUge1xyXG4gICAgICAgICAgICBib3JkZXItY29sb3I6ICNkOWQ5ZDk7XHJcblxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5tYXQtYWNjZW50IHtcclxuICAgICAgICAgICAgLm1hdC1yYWRpby1pbm5lci1jaXJjbGUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2UyMDYxMztcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgJi5tYXQtcmFkaW8tY2hlY2tlZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LXJhZGlvLW91dGVyLWNpcmNsZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYm9yZGVyLWNvbG9yOiAjZDlkOWQ5O1xyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LXJhZGlvLWxhYmVsLWNvbnRlbnQge1xyXG4gICAgICAgIGNvbG9yOiAjMDAwMDAwY2M7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNnB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtY2VsbCB7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcblxyXG4gICAgICAgIC5kb2N1bWVudF9pbWcge1xyXG4gICAgICAgICAgICB3aWR0aDogMzJweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC52aWV3ZG9jdW1lbnQge1xyXG4gICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICB9XHJcblxyXG4gICAgLnN1Ym1pdF9idG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcclxuICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1pbi13aWR0aDogMTEwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5jYW5jZWxidG4ge1xyXG4gICAgICAgIG1pbi13aWR0aDogMTEwcHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2U4ZThlODtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweDtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtaW5rLWJhciB7XHJcbiAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtdGFiLWhlYWRlciB7XHJcbiAgICAgICAgYm9yZGVyOiAwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuXHJcbiAgICAgICAgLmNvbnRlbnRjaXJjbGUge1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmZpbGVfdXBsb2FkIHtcclxuICAgICAgICAjdXBsb2FkZWQge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG5cclxuICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDEyNzlweCkge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5maWxlcnMge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDUwJTtcclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogMTI3OXB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5kb2N1bWVudCB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogNTAlO1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAzMHB4O1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbGVmdDogLTIzOXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogMTI3OXB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLmNsb3NlX2ljb25zIHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuZGVsZXRlX2ljb24ge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLnZpZXdfYnRuIHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAud29ya2NoZWNrYm94IHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgIC5tYXQtY2hlY2tib3gtaW5uZXItY29udGFpbmVyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDIwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogMjBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtY2hlY2tib3gtY2hlY2tlZCB7XHJcbiAgICAgICAgICAgICYubWF0LWFjY2VudCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWNoZWNrYm94LWJhY2tncm91bmQge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1jaGVja2JveC1mcmFtZSB7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNjNGM0YzQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtc2xpZGUtdG9nZ2xlIHtcclxuICAgICAgICAmLm1hdC1jaGVja2VkIHtcclxuICAgICAgICAgICAgLm1hdC1zbGlkZS10b2dnbGUtdGh1bWIge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwYTU1MTtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1zbGlkZS10b2dnbGUtYmFyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTA2MjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LXRhYi1sYWJlbCB7XHJcbiAgICAgICAgb3BhY2l0eTogMTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgIG1hcmdpbi1yaWdodDogMjBweDtcclxuICAgICAgICBoZWlnaHQ6IDgwcHg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtdGFiLWxpc3Qge1xyXG4gICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgbWluLXdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtY2FyZCB7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG5cclxuICAgICAgICAubWF0LWNhcmQtY29udGVudCB7XHJcbiAgICAgICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMTAwcHg7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDEwMHB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAuY2FyZGluZm8ge1xyXG4gICAgICAgICAgICAgICAgaDQge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5jZW50cmVfaW5mbyB7XHJcbiAgICAgICAgICAgICAgICAgICAgZ2FwOiAzMHB4O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuY2FyZGJ0biB7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgbWFyZ2luLXRvcDogLTM0cHg7XHJcbiAgICAgICAgICAgIHdpZHRoOiA5MyU7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDIwcHg7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBiYXNlbGluZTtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBlbmQ7XHJcblxyXG4gICAgICAgICAgICBidXR0b24ge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMjBweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAudGFic2NvbnRlbnQge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgLmNvbnRlbnRjaXJjbGUge1xyXG4gICAgICAgICAgICB3aWR0aDogMjhweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiAyOHB4O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiA1MCU7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiAwIDAgOHB4IHJnYig1MSA1MSA1MSAvIDE1JSk7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICM4NDg0ODQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAudGFidGl0bGUge1xyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5zdWJ0aXRsZWZvcm0ge1xyXG4gICAgICAgIGZvbnQtd2VpZ2h0OiA3MDA7XHJcbiAgICB9XHJcblxyXG4gICAgLnRpdGxlIHtcclxuICAgICAgICBoNCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnN1YnRpdGxlIHtcclxuICAgICAgICAgICAgaDQge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5saW5lIHtcclxuICAgICAgICAgICAgZmxleDogNDtcclxuXHJcbiAgICAgICAgICAgIC5tYXQtZGl2aWRlciB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMTIlO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXRvcC13aWR0aDogM3B4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLWNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtaW5wdXQtZWxlbWVudCB7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBjb2xvcjogI2Q5ZDlkOTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4IDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAuZGF0ZV9leHAge1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIGlucHV0W3JlYWRvbmx5XSB7XHJcbiAgICAgICAgY3Vyc29yOiBuby1kcm9wO1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgICYubWF0LXByaW1hcnkge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1zZWxlY3QtYXJyb3cge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmZpbHRlciB7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC51c2VyaW1nIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcblxyXG4gICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxNjhweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiAxNjhweDtcclxuXHJcbiAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjEpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBzcGFuIHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIHdpZHRoOiAzMnB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDMycHg7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDIwcHg7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNjNGM0YzQ7XHJcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgdG9wOiAzM3B4O1xyXG4gICAgICAgICAgICBsZWZ0OiAtNDRweDtcclxuICAgICAgICAgICAgb3BhY2l0eTogMC41O1xyXG5cclxuICAgICAgICAgICAgJjpob3ZlciB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3NzA7XHJcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHNjYWxlKDEuMSk7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWljb24ge1xyXG4gICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYXJhYmljbGFuZ3VhZ2Uge1xyXG5cclxuICAgICAgICBpbnB1dCxcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICB0ZXh0LWFsaWduOiByaWdodDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgIHRleHQtYWxpZ246IHJpZ2h0O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1lcnJvciB7XHJcbiAgICAgICAgICAgIHRleHQtYWxpZ246IHJpZ2h0O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZWRpdGJ0biB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgIHBhZGRpbmc6IDRweDtcclxuXHJcbiAgICAgICAgJjpob3ZlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5jb3VyZWJveCB7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XHJcbiAgICAgICAgcGFkZGluZzogNXB4IDEwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmljb25ncm91cCB7XHJcbiAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q5ZDlkOTtcclxuICAgICAgICAgICAgd2lkdGg6IDQwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMzBweDtcclxuXHJcbiAgICAgICAgICAgICY6bnRoLWNoaWxkKDEpIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAjZG9jdW1lbnRzLFxyXG4gICAgLmRvY3VtZW50cyB7XHJcblxyXG4gICAgICAgICN1cGxvYWRlZCB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcblxyXG4gICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogOTU5cHgpIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAuZmlsZXJzIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiA1MCU7XHJcblxyXG4gICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDk1OXB4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5kb2N1bWVudCB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogNTAlO1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAzMHB4O1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbGVmdDogLTIzOXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogOTU5cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweDtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAuY2xvc2VfaWNvbnMge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5kZWxldGVfaWNvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICAudmlld19idG4ge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgIH1cclxuXHJcbiAgICAuYXdhcmVkdGFibGUge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDBweDtcclxuXHJcbiAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1yb3c6aG92ZXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1jZWxsIHtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWhlYWRlci1jZWxsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXNlbGVjdC12YWx1ZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNjI2MzY2O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgICAgIG1hcmdpbjogMHB4IDEwcHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnJlbmV3YWwge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XHJcbiAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgLnJlbmV3YWxfaW5mbyB7XHJcbiAgICAgICAgICAgIGdhcDogMzBweDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG5cclxuICAgICAgICAgICAgLm1hdC1kaXZpZGVyIHtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNTFweDtcclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LWRpdmlkZXItdmVydGljYWwge1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlci1yaWdodC1jb2xvcjogI2M0YzRjNDtcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXItcmlnaHQtd2lkdGg6IDJweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG5cclxuICAgICAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAucmVtYWluZGVyIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHg7XHJcblxyXG4gICAgICAgICAgICAgICAgcCB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC52aWV3YnRuIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAuc3VjY2VzcyB7XHJcbiAgICAgICAgLmNlbnRlcmNvbnRlbnQge1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDcxdmg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuc3VjY2Vzc19pY29uIHtcclxuICAgICAgICAgICAgd2lkdGg6IDcycHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNzJweDtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNTBweDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgYm9yZGVyOiAzcHggc29saWQgIzAwYTU1MTtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwMGE1NTE7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuc3VjY2VzX21zZyB7XHJcbiAgICAgICAgICAgIGg0IHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMDBhNTUxO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAudmlld2Zvcm0ge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5kZWNsaW5lIHtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjRUQxQzI3O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDNweDtcclxuICAgICAgICBwYWRkaW5nOiAxNXB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY4Zjg7XHJcblxyXG4gICAgICAgIGg0IHtcclxuICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgfVxyXG4gICAgfSAubWF0LXJhaXNlZC1idXR0b24ge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTZweDtcclxuICAgIH1cclxuICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG5cclxuICAgICAgICAvLyAmLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xyXG4gICAgICAgICAgICAvLyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgLy8gfVxyXG4gICAgICAgICAgICAvLyB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5kYXRlX2V4cCB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2tbbmctcmVmbGVjdC1zdGF0ZT1cInJlYWRvbmx5XCJdIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgfVxyXG5cclxuICAgIGlucHV0W3JlYWRvbmx5XSB7XHJcbiAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG5cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAmLm1hdC1wcmltYXJ5IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtc2VsZWN0LWFycm93IHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuXHJcbiAgICAuY2FyZCB7XHJcbiAgICAgICAgYm94LXNoYWRvdzogMCAwIDRweCByZ2JhKDAsIDAsIDAsIDAuMik7XHJcbiAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgIH1cclxuXHJcbiAgICAvLyAuZmEge1xyXG4gICAgLy8gICAgIGNvbG9yOiB0cmFuc3BhcmVudDtcclxuICAgIC8vICAgICAtd2Via2l0LXRleHQtc3Ryb2tlLXdpZHRoOiAxcHg7XHJcbiAgICAvLyAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogI2ZmZjtcclxuICAgIC8vIH1cclxuXHJcbiAgICAjc2VhcmNocm93LFxyXG4gICAgI2ZpbHRlcnNob3cge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcblxyXG4gICAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweFxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnNjcm9sbGRhdGEge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICB6LWluZGV4OiAxO1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgICAgICAgICB3aWR0aDogNnB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2YxZjFmMTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAudGFiZm9yY2xpZW50ZWxlbmV3IHtcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDhweCAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYW5hZ2VvcHRpb25zIHtcclxuICAgICAgICAgICAgLm1hdC1pY29uIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjYWNhY2FjO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXN0ZXItbWVudSB7XHJcbiAgICAgICAgLm1hdC1tZW51LWNvbnRlbnQge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDAwO1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hc3RlclBhZ2VUb3Age1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IHtcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Q5ZDlkOSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LXNvcnQtaGVhZGVyLWFycm93IHtcclxuICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgIH1cclxuXHJcbiAgICAubm9mb3VuZCB7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogNSU7XHJcbiAgICB9XHJcblxyXG59XHJcblxyXG4ubWF0LW1lbnUtcGFuZWwge1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogIzY2NjY2NiAhaW1wb3J0YW50O1xyXG5cclxufVxyXG5cclxuLm1hdC1tZW51LWl0ZW0ge1xyXG4gICAgbGluZS1oZWlnaHQ6IDM2cHg7XHJcbiAgICBoZWlnaHQ6IDMxcHg7XHJcbiAgICBjb2xvcjogI2ZmZjtcclxufVxyXG5cclxuLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICBwYWRkaW5nOiA2cHggMTBweDtcclxuICAgIGJhY2tncm91bmQ6ICNlOWVkZjA7XHJcblxyXG4gICAgaW5wdXQ6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXIge1xyXG4gICAgICAgIGNvbG9yOiAjN2Y4ZmEzICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgaSB7XHJcbiAgICAgICAgY29sb3I6ICM3ZjhmYTMgIWltcG9ydGFudDtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiA2cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnNlYXJjaHNlbGVjdCB7XHJcbiAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDI1cHgpICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnJlc2V0aWNvbiB7XHJcbiAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgfVxyXG59XHJcblxyXG4uc2VsZWN0X3dpdGhfc2VhcmNoIHtcclxuICAgIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcclxuICAgIG1heC1oZWlnaHQ6IDEwMCUgIWltcG9ydGFudDtcclxuICAgIG1hcmdpbi10b3A6IDQwcHggIWltcG9ydGFudDtcclxuICAgIG1hcmdpbi1ib3R0b206IDE1cHggIWltcG9ydGFudDtcclxufVxyXG5cclxuLnNlbGVjdF93aXRoX29wdGlvbiB7XHJcbiAgICBvdmVyZmxvdzogaGlkZGVuICFpbXBvcnRhbnQ7XHJcbiAgICBtYXgtaGVpZ2h0OiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICBtYXJnaW4tdG9wOiA0OXB4ICFpbXBvcnRhbnQ7XHJcbiAgICBtYXJnaW4tYm90dG9tOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbi5zZWFyY2hpbm11bHRpc2VsZWN0IHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgcGFkZGluZzogMTBweCAxMHB4O1xyXG4gICAgYmFja2dyb3VuZDogI2U5ZWRmMDtcclxuICAgIG1hcmdpbjogMTBweDtcclxufVxyXG5cclxuLnNlYXJjaHNlbGVjdCB7XHJcbiAgICB3aWR0aDogY2FsYygxMDAlIC0gMjVweCkgIWltcG9ydGFudDtcclxuICAgIHBhZGRpbmctbGVmdDogMTBweDtcclxuXHJcbn1cclxuXHJcbi5tYXQtb3B0aW9uLm1hdC1hY3RpdmUge1xyXG4gICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgIGNvbG9yOiByZ2JhKDAsIDAsIDAsIDAuODcpO1xyXG59XHJcblxyXG4ub3B0aW9uLWxpc3Rpbmcge1xyXG4gICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgIG92ZXJmbG93LXk6IGF1dG87XHJcbiAgICBtYXgtaGVpZ2h0OiAyOTBweDtcclxuXHJcbn1cclxuXHJcbi5vcHRpb24tbGlzdGluZzo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgd2lkdGg6IDdweDtcclxufVxyXG5cclxuLyogVHJhY2sgKi9cclxuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG59XHJcblxyXG4vKiBIYW5kbGUgKi9cclxuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjRUQxQzI3O1xyXG59XHJcblxyXG4vKiBob3ZlciAqL1xyXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcclxuICAgIGJhY2tncm91bmQ6ICNFRDFDMjc7XHJcbn1cclxuXHJcbi5teVBhbmVsQ2xhc3Mge1xyXG4gICAgbWFyZ2luOiAzNnB4IDBweDtcclxufVxyXG5cclxuLm1hdC1zZWxlY3QtYXJyb3cge1xyXG4gICAgY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbi5tYXQtc2VsZWN0LWFycm93OmJlZm9yZSB7XHJcbiAgICBjb250ZW50OiBcIlxcZjA3OFwiO1xyXG4gICAgc3BlYWs6IG5vbmU7XHJcbiAgICBmb250LXN0eWxlOiBub3JtYWw7XHJcbiAgICBmb250LXdlaWdodDogbm9ybWFsO1xyXG4gICAgZm9udC12YXJpYW50OiBub3JtYWw7XHJcbiAgICB0ZXh0LXRyYW5zZm9ybTogbm9uZTtcclxuICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgLXdlYmtpdC1mb250LXNtb290aGluZzogYW50aWFsaWFzZWQ7XHJcbiAgICBmb250LXNpemU6IDEwcHggIWltcG9ydGFudDtcclxuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgIGhlaWdodDogMjVweDtcclxuICAgIHdpZHRoOiAyNXB4O1xyXG4gICAgcmlnaHQ6IDBweDtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogZmxleC1lbmQ7XHJcbiAgICBib3R0b206IDRweDtcclxuICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgZm9udC1mYW1pbHk6ICdGb250QXdlc29tZSc7XHJcbiAgICBjb2xvcjogcmdiYSgwLCAwLCAwLCAwLjU0KTtcclxufVxyXG5cclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgLm1hc3RlclBhZ2VUb3B7XHJcbiAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWx7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICB9XHJcbiAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lcntcclxuICAgICAgICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgICAgfVxyXG4gICAgfVxyXG4gXHJcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/batch/batchgridlisting/batchgridlisting.component.ts":
  /*!******************************************************************************!*\
    !*** ./src/app/modules/batch/batchgridlisting/batchgridlisting.component.ts ***!
    \******************************************************************************/

  /*! exports provided: BatchgridlistingComponent */

  /***/
  function srcAppModulesBatchBatchgridlistingBatchgridlistingComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "BatchgridlistingComponent", function () {
      return BatchgridlistingComponent;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_cdk_collections__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/cdk/collections */
    "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/collections.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_sort__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/material/sort */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/config/BGIConfig/bgi-jsonconfig-services */
    "./src/app/config/BGIConfig/bgi-jsonconfig-services.ts");
    /* harmony import */


    var _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @app/modules/profilemanagement/profile.service */
    "./src/app/modules/profilemanagement/profile.service.ts");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _app_services_batch_service__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @app/services/batch.service */
    "./src/app/services/batch.service.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! moment */
    "./node_modules/moment/moment.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_15__);
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _modal_commentmodal__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! ../modal/commentmodal */
    "./src/app/modules/batch/modal/commentmodal.ts");

    var BatchgridlistingComponent = /*#__PURE__*/function () {
      function BatchgridlistingComponent(el, translate, remoteService, profileService, cookieService, batchService, router, localstorage, security, dialog) {
        _classCallCheck(this, BatchgridlistingComponent);

        this.el = el;
        this.translate = translate;
        this.remoteService = remoteService;
        this.profileService = profileService;
        this.cookieService = cookieService;
        this.batchService = batchService;
        this.router = router;
        this.localstorage = localstorage;
        this.security = security;
        this.dialog = dialog;
        this.disableSubmitButton = false;
        this.BatchData = ['checkbox', 'batchno', 'batchtype', 'officetype', 'branchname', 'asssessmentcenter', 'totalleaners', 'remainingcapacity', 'trainingdurationth', 'trainingdurationpr', 'assessmentdatetime', 'assessmentwilayat', 'categories', 'language', 'status', 'action'];
        this.creationpageshow = true;
        this.selection = new _angular_cdk_collections__WEBPACK_IMPORTED_MODULE_1__["SelectionModel"](true, []);
        this.ShowHide = true;
        this.operatcont = false;
        this.international = false;
        this.courses = false;
        this.staffform = false;
        this.Submitted = true;
        this.renewal = true;
        this.decline = true;
        this.maxDate = new Date();
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.length = '';
        this.second = '';
        this.third = '';
        this.four = '';
        this.editOption = true;
        this.updated = true;
        this.isValid = true;
        this.isValided = true;
        this.valided = true;
        this.validture = true;
        this.perpage = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_10__["BgiJsonconfigServices"].bgiConfigData.configuration.enterpriseAdminPerpage;
        this.bgiConfigJson = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_10__["BgiJsonconfigServices"].bgiConfigData.configuration;
        this.finalpermissionarray = [];
        this.page = 10;
        this.companyinfocert = false;
        this.reglandingpage = true;
        this.paginationSet = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_10__["BgiJsonconfigServices"].bgiConfigData.configuration.enterpriseAdminPaginatonSet; //filterformcontral name

        this.batchno = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.batchtype = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.officetype = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.branchname = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.asssessmentcenter = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.totallearning = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.remainingcapacity = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.trainingduration = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.coursepartical = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.assessmentdatetime = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.assessmentwilayat = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.categories = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.language = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('');
        this.status = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"](''); // selected2 = moment();

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
        this.ranges = {
          'Today': [moment__WEBPACK_IMPORTED_MODULE_15___default()(), moment__WEBPACK_IMPORTED_MODULE_15___default()()],
          'Yesterday': [moment__WEBPACK_IMPORTED_MODULE_15___default()().subtract(1, 'days'), moment__WEBPACK_IMPORTED_MODULE_15___default()().subtract(1, 'days')],
          'Last 7 Days': [moment__WEBPACK_IMPORTED_MODULE_15___default()().subtract(6, 'days'), moment__WEBPACK_IMPORTED_MODULE_15___default()()],
          'Last 30 Days': [moment__WEBPACK_IMPORTED_MODULE_15___default()().subtract(29, 'days'), moment__WEBPACK_IMPORTED_MODULE_15___default()()],
          'This Month': [moment__WEBPACK_IMPORTED_MODULE_15___default()().startOf('month'), moment__WEBPACK_IMPORTED_MODULE_15___default()().endOf('month')],
          'Last Month': [moment__WEBPACK_IMPORTED_MODULE_15___default()().subtract(1, 'month').startOf('month'), moment__WEBPACK_IMPORTED_MODULE_15___default()().subtract(1, 'month').endOf('month')]
        };
      }

      _createClass(BatchgridlistingComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this23 = this;

          if (localStorage.getItem('v3logindata') == null) {
            this.router.navigate(['/admin/login']);
          }

          this.regpk = this.localstorage.getInLocal('registerPk');
          this.userPk = this.localstorage.getInLocal('userPk');
          this.stktype = this.localstorage.getInLocal('stktype');
          this.role = this.localstorage.getInLocal('role');

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this23.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect5 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect5.languagecode);
            this.dir = _toSelect5.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this23.translate.setDefaultLang(_this23.cookieService.get('languageCode'));

            if (_this23.cookieService.get('languageCookieId') && _this23.cookieService.get('languageCookieId') != undefined && _this23.cookieService.get('languageCookieId') != null) {
              var _toSelect6 = _this23.languagelist.find(function (c) {
                return c.id === _this23.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this23.translate.setDefaultLang(_toSelect6.languagecode);

              _this23.dir = _toSelect6.dir;
            } else {
              var _toSelect7 = _this23.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this23.translate.setDefaultLang(_toSelect7.languagecode);

              _this23.dir = _toSelect7.dir;
            }
          });
          this.getbatchdtls();
        }
      }, {
        key: "isAllSelected",
        value: function isAllSelected() {
          var numSelected = this.selection.selected.length;
          var numRows = this.batchdata.data.length;
          return numSelected === numRows;
        }
      }, {
        key: "creationpageshowdata",
        value: function creationpageshowdata() {
          this.creationpageshow = false;
          this.companyinfocert = true;
          this.scrollTo('pagescroll');
        }
        /** Selects all rows if they are not all selected; otherwise clear selection. */

      }, {
        key: "masterToggle",
        value: function masterToggle() {
          var _this24 = this;

          this.isAllSelected() ? this.selection.clear() : this.batchdata.data.forEach(function (row) {
            return _this24.selection.select(row);
          });
        }
      }, {
        key: "clickEvent",
        value: function clickEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = this.i18n('course.showfilt');
            var id = document.getElementById('searchrow');
            id.style.display = 'none';
          } else {
            this.filtername = this.i18n('course.hidefilt');

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
        key: "scrollTo",
        value: function scrollTo(className) {
          try {
            var elementList = document.querySelectorAll('.' + className);
            var element = elementList[0];
            element.scrollIntoView({
              behavior: 'smooth'
            });
            console.log('page-content');
          } catch (error) {// console.log('page-content')
          }
        }
      }, {
        key: "clickfilterEvent",
        value: function clickfilterEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = this.i18n('course.showfilt');
            var id = document.getElementById('filtershow');
            id.style.display = 'none';
          } else {
            this.filtername = this.i18n('course.hidefilt');

            var _id3 = document.getElementById('filtershow');

            _id3.style.display = 'flex';
          }
        }
      }, {
        key: "reglandingpagedata",
        value: function reglandingpagedata(event) {
          this.creationpageshow = event;
        }
      }, {
        key: "certifyhidedata",
        value: function certifyhidedata(event) {
          this.companyinfocert = event;
        }
      }, {
        key: "getbatchdtls",
        value: function getbatchdtls() {
          var _this25 = this;

          var enRegPk = this.security.encrypt(this.regpk);
          this.disableSubmitButton = true;
          this.batchService.getbatchdtls(enRegPk).subscribe(function (data) {
            _this25.batchdata_data = data.data;
            _this25.batchdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](_this25.batchdata_data);
            _this25.disableSubmitButton = false;
          });
        }
      }, {
        key: "editData",
        value: function editData(data) {
          var _this26 = this;

          this.batchdata_data.forEach(function (y) {
            if (y.id == data.id) {
              _this26.batchid = data.batch_no;

              _this26.creationpageshowdata();
            }
          });
        }
      }, {
        key: "downloadAttenance",
        value: function downloadAttenance(data) {
          this.batchService.downloadattendance(data.batch_no).subscribe(function (res) {
            if (res.data.status == 1) {
              window.open(res.data.attend, '_blank');
            }
          });
        }
      }, {
        key: "RegisterLearner",
        value: function RegisterLearner(data) {
          this.router.navigate(['/candidatemanagement/learner-register/' + data.batch_no]);
        }
      }, {
        key: "ViewLearners",
        value: function ViewLearners(data) {
          this.router.navigate(['/candidatemanagement/viewlearner/' + data.batch_no]);
        }
      }, {
        key: "ChangeAssessor",
        value: function ChangeAssessor(data) {
          this.router.navigate(['/assessmentreport/changeassessor/' + data.batch_no]);
        }
      }, {
        key: "ViewBatch",
        value: function ViewBatch(data) {
          var _this27 = this;

          this.batchdata_data.forEach(function (y) {
            if (y.id == data.id) {
              _this27.router.navigate(['/batchindex/batchviewpage'], {
                queryParams: {
                  id: data.batch_no
                }
              });
            }
          });
        }
      }, {
        key: "CancelBatch",
        value: function CancelBatch(data) {
          var _this28 = this;

          var dialogRef = this.dialog.open(_modal_commentmodal__WEBPACK_IMPORTED_MODULE_18__["commentmodal"], {
            disableClose: true,
            panelClass: 'commentfielsmodal',
            data: {
              fieldToShow: 'field1'
            }
          });
          dialogRef.afterClosed().subscribe(function (result) {});
          this.batchdata_data.forEach(function (y) {
            if (y.id == data.id) {
              _this28.disableSubmitButton = true;

              _this28.batchService.ChangeBatchStatus(data.batch_no, 'cancel', 'Due to cancelled').subscribe(function (res) {
                if (res.data.status == 1) {
                  _this28.getbatchdtls();
                }
              });
            }
          });
        }
      }, {
        key: "requesttrack",
        value: function requesttrack() {
          var dialogRef = this.dialog.open(_modal_commentmodal__WEBPACK_IMPORTED_MODULE_18__["commentmodal"], {
            disableClose: true,
            panelClass: 'commentfielsmodal',
            data: {
              fieldToShow: 'field2'
            }
          });
          dialogRef.afterClosed().subscribe(function (result) {});
        }
      }, {
        key: "updatestatus",
        value: function updatestatus() {
          var dialogRef = this.dialog.open(_modal_commentmodal__WEBPACK_IMPORTED_MODULE_18__["commentmodal"], {
            disableClose: true,
            panelClass: 'commentfielsmodal',
            data: {
              fieldToShow: 'field3'
            }
          });
          dialogRef.afterClosed().subscribe(function (result) {});
        }
      }]);

      return BatchgridlistingComponent;
    }();

    BatchgridlistingComponent.ctorParameters = function () {
      return [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_2__["ElementRef"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_14__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_12__["RemoteService"]
      }, {
        type: _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_11__["ProfileService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_16__["CookieService"]
      }, {
        type: _app_services_batch_service__WEBPACK_IMPORTED_MODULE_13__["BatchService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_7__["Router"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__["Encrypt"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_17__["MatDialog"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_4__["MatPaginator"])], BatchgridlistingComponent.prototype, "paginator", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_5__["MatSort"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_5__["MatSort"])], BatchgridlistingComponent.prototype, "sort", void 0);
    BatchgridlistingComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_2__["Component"])({
      selector: 'app-batchgridlisting',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./batchgridlisting.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchgridlisting/batchgridlisting.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_2__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./batchgridlisting.component.scss */
      "./src/app/modules/batch/batchgridlisting/batchgridlisting.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_core__WEBPACK_IMPORTED_MODULE_2__["ElementRef"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_14__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_12__["RemoteService"], _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_11__["ProfileService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_16__["CookieService"], _app_services_batch_service__WEBPACK_IMPORTED_MODULE_13__["BatchService"], _angular_router__WEBPACK_IMPORTED_MODULE_7__["Router"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_9__["AppLocalStorageServices"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_8__["Encrypt"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_17__["MatDialog"]])], BatchgridlistingComponent);
    /***/
  },

  /***/
  "./src/app/modules/batch/batchviewpage/batchviewpage.component.scss":
  /*!**************************************************************************!*\
    !*** ./src/app/modules/batch/batchviewpage/batchviewpage.component.scss ***!
    \**************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesBatchBatchviewpageBatchviewpageComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#viewpagelist {\n  padding-top: 20px;\n}\n#viewpagelist .bottomcardremaining {\n  border: 1px solid #ddd;\n  background-color: #f8f8f8;\n}\n#viewpagelist .timepicker {\n  color: #262626;\n}\n#viewpagelist .mat-raised-button {\n  border-radius: 2px;\n  box-shadow: none;\n  font-size: 16px;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n#viewpagelist .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#viewpagelist .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#viewpagelist .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#viewpagelist .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#viewpagelist .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#viewpagelist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#viewpagelist .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#viewpagelist .date_exp .mat-form-field-appearance-outline .mat-form-field-suffix {\n  display: flex;\n  align-items: center;\n}\n#viewpagelist .mat-form-field-outline-thick[ng-reflect-state=readonly] {\n  background-color: #d9d9d9;\n}\n#viewpagelist input[readonly] {\n  cursor: pointer;\n}\n#viewpagelist .mat-form-field.mat-focused.mat-primary .mat-select-arrow {\n  color: transparent !important;\n}\n#viewpagelist .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n#viewpagelist .hrstag, #viewpagelist .weekededtag {\n  padding: 5px 10px;\n  border: 1px solid #ddd;\n  border-radius: 6px;\n  margin-left: 15px;\n}\n#viewpagelist .weekededtag {\n  color: #ffbc6e;\n  border: 1px solid #ffbc6e !important;\n  margin-left: 0px !important;\n}\n#viewpagelist .closeanddateicon {\n  display: flex !important;\n  align-items: center !important;\n}\n#viewpagelist .availabletxtcolor {\n  color: #262626;\n}\n#viewpagelist .timeduration_contain .trainingdurationtitle {\n  color: #333;\n  font-size: 1.125rem;\n  display: flex;\n  align-items: center;\n}\n#viewpagelist .timeduration_contain .trainingdurationtitle .mat-icon {\n  color: #848484;\n  margin-top: 6px;\n}\n#viewpagelist .dateformfieldrange .daterangetime .mat-form-field-infix {\n  padding-bottom: 0px !important;\n}\n#viewpagelist #searchrow,\n#viewpagelist #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#viewpagelist #searchrow .serachrow,\n#viewpagelist #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n}\n#viewpagelist .tabletopconatiner .mat-paginator-container {\n  justify-content: space-between !important;\n  width: 100%;\n}\n#viewpagelist .tabletopconatiner .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#viewpagelist .tabletopconatiner .awaredtable .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#viewpagelist .tabletopconatiner .awaredtable .manageoptions .mat-icon {\n  color: #acacac;\n}\n#viewpagelist .tabletopconatiner .awaredtable .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#viewpagelist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#viewpagelist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#viewpagelist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#viewpagelist .tabletopconatiner .awaredtable .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#viewpagelist .tabletopconatiner .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#viewpagelist .tabletopconatiner .awaredtable .mat-row {\n  border-bottom: transparent !important;\n  padding-bottom: 10px;\n}\n#viewpagelist .tabletopconatiner .awaredtable .mat-cell {\n  color: #262626;\n}\n#viewpagelist .tabletopconatiner .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#viewpagelist .paginationwithfilter {\n  display: flex !important;\n  justify-content: space-between !important;\n  align-items: center !important;\n}\n#viewpagelist #regapp .closeanddateicomax {\n  top: 14px !important;\n}\n#viewpagelist .maincontainertable {\n  border: 1px solid #ddd;\n}\n#viewpagelist .maincontainertable .drpickerhader {\n  background-color: #fbfbfb;\n  padding: 20px;\n  padding-bottom: 0px;\n}\n#viewpagelist .maincontainertable .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#viewpagelist .totalleanerheader p {\n  color: #848484;\n  padding-bottom: 4px;\n}\n#viewpagelist .totalleanerheader span {\n  color: #262626;\n}\n#viewpagelist .mainboxbatchview {\n  border: 1px solid #ddd;\n}\n#viewpagelist .mainboxbatchview .batchfirstcontent {\n  border-bottom: 1px solid #ddd;\n  padding: 20px 25px;\n}\n#viewpagelist .mainboxbatchview .leanerwidth {\n  min-width: 150px;\n}\n#viewpagelist .mainboxbatchview .batchtitleheader {\n  padding-bottom: 12px;\n}\n#viewpagelist .mainboxbatchview .batchtitleheader .mat-icon {\n  color: #848484;\n}\n#viewpagelist .mainboxbatchview .batchtitleheader p {\n  color: #848484;\n}\n#viewpagelist .mainboxbatchview .batchtitleheader p span {\n  color: #262626;\n}\n#viewpagelist .mainboxbatchview .statusheader .statustext {\n  color: #848484;\n  padding: 4px 10px;\n  border: 1px solid #ddd;\n}\n#viewpagelist .mainboxbatchview .statusheader .statustext .statuscolor {\n  color: #00a551;\n}\n@media (max-width: 768px) {\n  .batchbottomspace {\n    margin-bottom: 10px;\n  }\n}\n@media (max-width: 767px) {\n  .filterbtn {\n    margin-top: 10px;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9iYXRjaC9iYXRjaHZpZXdwYWdlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGJhdGNoXFxiYXRjaHZpZXdwYWdlXFxiYXRjaHZpZXdwYWdlLmNvbXBvbmVudC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2JhdGNoL2JhdGNodmlld3BhZ2UvYmF0Y2h2aWV3cGFnZS5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFFQTtFQUNJLGlCQUFBO0FDREo7QURFSTtFQUNJLHNCQUFBO0VBQ0EseUJBQUE7QUNBUjtBREVJO0VBQ0ssY0FBQTtBQ0FUO0FERUk7RUFDSSxrQkFBQTtFQUNBLGdCQUFBO0VBQ0EsZUFBQTtBQ0FSO0FES1E7RUFFSSxvQ0FBQTtBQ0paO0FEU1E7RUFDSSxjQUFBO0FDUFo7QURVUTtFQUNJLDBCQUFBO0FDUlo7QURXUTtFQUNJLDBCQUFBO0FDVFo7QURZUTtFQUNJLGNBQUE7QUNWWjtBRGFRO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDWFo7QURnQlk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNkaEI7QURtQm9CO0VBQ0ksY0FBQTtBQ2pCeEI7QUR3Qlk7RUFDSSx5QkFBQTtBQ3RCaEI7QUQ0Qlk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUMxQmhCO0FEZ0NnQjtFQUNJLDBDQUFBO0VBQ0EsY0FBQTtBQzlCcEI7QURnQ29CO0VBQ0ksY0FBQTtBQzlCeEI7QURrQ2dCO0VBQ0kscUJBQUE7QUNoQ3BCO0FEc0NJO0VBQ0ksd0JBQUE7RUFDQSx5Q0FBQTtFQUNBLDhCQUFBO0FDcENSO0FEeUNZO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDdkNoQjtBRDRDSTtFQUNJLHlCQUFBO0FDMUNSO0FENkNJO0VBQ0ksZUFBQTtBQzNDUjtBRGtEZ0I7RUFDSSw2QkFBQTtBQ2hEcEI7QUR3RFk7RUFDSSx5QkFBQTtBQ3REaEI7QUQyREk7RUFDSSxpQkFBQTtFQUNBLHNCQUFBO0VBQ0Esa0JBQUE7RUFDQSxpQkFBQTtBQ3pEUjtBRDJESTtFQUVJLGNBQUE7RUFDQSxvQ0FBQTtFQUNBLDJCQUFBO0FDMURSO0FENERJO0VBRUUsd0JBQUE7RUFDQSw4QkFBQTtBQzNETjtBRDZESTtFQUNLLGNBQUE7QUMzRFQ7QUQ4RE07RUFDSSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUM1RFY7QUQ2RFU7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQzNEZDtBRGtFWTtFQUNJLDhCQUFBO0FDaEVoQjtBRHFFSTs7RUFFSSwyQkFBQTtFQUNBLFlBQUE7QUNuRVI7QURxRVE7O0VBQ0ksMkJBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0FDbEVaO0FEc0VRO0VBQ0kseUNBQUE7RUFDQSxXQUFBO0FDcEVaO0FEc0VRO0VBQ0ksa0JBQUE7RUFDQSw0QkFBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7QUNwRVo7QURzRW9CO0VBQ0kseUJBQUE7QUNwRXhCO0FEd0VvQjtFQUNJLGNBQUE7QUN0RXhCO0FEeUVZO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQ3ZFaEI7QUR5RWdCO0VBQ0ksVUFBQTtFQUNBLFdBQUE7QUN2RXBCO0FEMEVnQjtFQUNJLG1CQUFBO0FDeEVwQjtBRDJFZ0I7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FDekVwQjtBRDRFZ0I7RUFDSSxnQkFBQTtBQzFFcEI7QUQ2RVk7RUFDSSxtQkFBQTtBQzNFaEI7QUQ4RVk7RUFDRyxxQ0FBQTtFQUNBLG9CQUFBO0FDNUVmO0FEK0VZO0VBQ0ksY0FBQTtBQzdFaEI7QURnRlk7RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBQzlFaEI7QURrRkk7RUFDSSx3QkFBQTtFQUNBLHlDQUFBO0VBQ0EsOEJBQUE7QUNoRlI7QURtRlE7RUFDSSxvQkFBQTtBQ2pGWjtBRG9GSTtFQUNLLHNCQUFBO0FDbEZUO0FEbUZTO0VBQ0cseUJBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUNqRlo7QURxRlE7RUFDSSxhQUFBO0FDbkZaO0FEeUZRO0VBQ0csY0FBQTtFQUNBLG1CQUFBO0FDdkZYO0FEeUZRO0VBQ0ssY0FBQTtBQ3ZGYjtBRDBGSTtFQUNBLHNCQUFBO0FDeEZKO0FEeUZJO0VBQ0ssNkJBQUE7RUFDQSxrQkFBQTtBQ3ZGVDtBRHlGSTtFQUNLLGdCQUFBO0FDdkZUO0FEMkZBO0VBQ0ksb0JBQUE7QUN6Rko7QUQwRkk7RUFDSyxjQUFBO0FDeEZUO0FEMEZHO0VBQ0ssY0FBQTtBQ3hGUjtBRHlGUTtFQUNJLGNBQUE7QUN2Rlo7QUQ2Rkk7RUFDRyxjQUFBO0VBQ0EsaUJBQUE7RUFDQSxzQkFBQTtBQzNGUDtBRDRGTztFQUNDLGNBQUE7QUMxRlI7QURpR0E7RUFDSTtJQUNJLG1CQUFBO0VDOUZOO0FBQ0Y7QURpR0E7RUFDSTtJQUNLLGdCQUFBO0VDL0ZQO0FBQ0YiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL2JhdGNoL2JhdGNodmlld3BhZ2UvYmF0Y2h2aWV3cGFnZS5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIlxyXG5cclxuI3ZpZXdwYWdlbGlzdHtcclxuICAgIHBhZGRpbmctdG9wOiAyMHB4O1xyXG4gICAgLmJvdHRvbWNhcmRyZW1haW5pbmd7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgfVxyXG4gICAgLnRpbWVwaWNrZXJ7XHJcbiAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG4gICAgLm1hdC1yYWlzZWQtYnV0dG9uIHtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICBmb250LXNpemU6IDE2cHg7XHJcbiAgICB9XHJcbiAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuXHJcbiAgICAgICAgLy8gJi5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXJlYWRvbmx5IHtcclxuICAgICAgICAgICAgLy8gLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA5YzNhICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIC8vIH1cclxuICAgICAgICAgICAgLy8gfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBjb2xvcjogI2Q5ZDlkOTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcblxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtLjlyZW0pIHNjYWxlKDAuNzUpO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuZGF0ZV9leHAge1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrW25nLXJlZmxlY3Qtc3RhdGU9XCJyZWFkb25seVwiXSB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Q5ZDlkOTtcclxuICAgIH1cclxuXHJcbiAgICBpbnB1dFtyZWFkb25seV0ge1xyXG4gICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuXHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkIHtcclxuICAgICAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAgICAgJi5tYXQtcHJpbWFyeSB7XHJcbiAgICAgICAgICAgICAgICAubWF0LXNlbGVjdC1hcnJvdyB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkIHtcclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuaHJzdGFne1xyXG4gICAgICAgIHBhZGRpbmc6IDVweCAxMHB4O1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogNnB4O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAxNXB4O1xyXG4gICAgfVxyXG4gICAgLndlZWtlZGVkdGFne1xyXG4gICAgICAgIEBleHRlbmQgLmhyc3RhZztcclxuICAgICAgICBjb2xvcjogI2ZmYmM2ZTtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZmZiYzZlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmNsb3NlYW5kZGF0ZWljb25cclxuICAgIHtcclxuICAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYXZhaWxhYmxldHh0Y29sb3J7XHJcbiAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG4gIC50aW1lZHVyYXRpb25fY29udGFpbntcclxuICAgICAgLnRyYWluaW5nZHVyYXRpb250aXRsZXtcclxuICAgICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICAgICAgZm9udC1zaXplOiBcdDEuMTI1cmVtO1xyXG4gICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAubWF0LWljb24ge1xyXG4gICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICAgIG1hcmdpbi10b3A6IDZweDtcclxuICAgICAgICAgIH1cclxuICAgICAgfVxyXG4gIH1cclxuICBcclxuICAgIC5kYXRlZm9ybWZpZWxkcmFuZ2V7XHJcbiAgICAgICAgLmRhdGVyYW5nZXRpbWV7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeHtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctYm90dG9tOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgXHJcbiAgICB9XHJcbiAgICAjc2VhcmNocm93LFxyXG4gICAgI2ZpbHRlcnNob3cge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcblxyXG4gICAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweFxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC50YWJsZXRvcGNvbmF0aW5lcntcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1jb250YWluZXJ7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmF3YXJlZHRhYmxlIHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICBtYXJnaW46IDEwcHggMHB4OyBcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDhweCAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjYWNhY2FjO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnNjcm9sbGRhdGEge1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgei1pbmRleDogMTtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcclxuICAgICAgICBcclxuICAgICAgICAgICAgICAgICY6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogNnB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmMWYxZjE7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2NjYztcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1yb3cge1xyXG4gICAgICAgICAgICAgICBib3JkZXItYm90dG9tOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgIC5tYXQtY2VsbCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9ICAgXHJcbiAgICAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAjcmVnYXBwe1xyXG4gICAgICAgIC5jbG9zZWFuZGRhdGVpY29tYXgge1xyXG4gICAgICAgICAgICB0b3A6IDE0cHggIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAubWFpbmNvbnRhaW5lcnRhYmxle1xyXG4gICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAuZHJwaWNrZXJoYWRlcntcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZiZmJmYjtcclxuICAgICAgICAgICAgcGFkZGluZzogMjBweDtcclxuICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDBweDtcclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgLm1hc3RlclBhZ2VUb3Age1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgXHJcbiAgICAudG90YWxsZWFuZXJoZWFkZXJ7XHJcbiAgICAgICAgcHtcclxuICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogNHB4O1xyXG4gICAgICAgIH1cclxuICAgICAgICBzcGFue1xyXG4gICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLm1haW5ib3hiYXRjaHZpZXd7XHJcbiAgICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgLmJhdGNoZmlyc3Rjb250ZW50e1xyXG4gICAgICAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgICAgcGFkZGluZzogMjBweCAyNXB4O1xyXG4gICAgfVxyXG4gICAgLmxlYW5lcndpZHRoe1xyXG4gICAgICAgICBtaW4td2lkdGg6IDE1MHB4O1xyXG4gICAgfVxyXG5cclxuXHJcbi5iYXRjaHRpdGxlaGVhZGVye1xyXG4gICAgcGFkZGluZy1ib3R0b206IDEycHg7XHJcbiAgICAubWF0LWljb257XHJcbiAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgfVxyXG4gICBwe1xyXG4gICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgIHNwYW57XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIH1cclxuICAgfVxyXG59XHJcblxyXG4uc3RhdHVzaGVhZGVye1xyXG4gICAgLnN0YXR1c3RleHR7XHJcbiAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgIHBhZGRpbmc6IDRweCAxMHB4O1xyXG4gICAgICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgIC5zdGF0dXNjb2xvcntcclxuICAgICAgICBjb2xvcjogIzAwYTU1MTtcclxuICAgICAgICB9IFxyXG4gICAgfVxyXG4gICB9XHJcbiB9XHJcbn0gICBcclxuXHJcbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gICAgLmJhdGNoYm90dG9tc3BhY2V7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcclxuICAgIC5maWx0ZXJidG57XHJcbiAgICAgICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgICB9XHJcbn0iLCIjdmlld3BhZ2VsaXN0IHtcbiAgcGFkZGluZy10b3A6IDIwcHg7XG59XG4jdmlld3BhZ2VsaXN0IC5ib3R0b21jYXJkcmVtYWluaW5nIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiN2aWV3cGFnZWxpc3QgLnRpbWVwaWNrZXIge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiN2aWV3cGFnZWxpc3QgLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3gtc2hhZG93OiBub25lO1xuICBmb250LXNpemU6IDE2cHg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA5YzNhICFpbXBvcnRhbnQ7XG59XG4jdmlld3BhZ2VsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbn1cbiN2aWV3cGFnZWxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xufVxuI3ZpZXdwYWdlbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI3ZpZXdwYWdlbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiN2aWV3cGFnZWxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjNmJhNWVjO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI3ZpZXdwYWdlbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiN2aWV3cGFnZWxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3ZpZXdwYWdlbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiN2aWV3cGFnZWxpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiN2aWV3cGFnZWxpc3QgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI3ZpZXdwYWdlbGlzdCAuZGF0ZV9leHAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtc3VmZml4IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiN2aWV3cGFnZWxpc3QgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2tbbmctcmVmbGVjdC1zdGF0ZT1yZWFkb25seV0ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZDlkOWQ5O1xufVxuI3ZpZXdwYWdlbGlzdCBpbnB1dFtyZWFkb25seV0ge1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4jdmlld3BhZ2VsaXN0IC5tYXQtZm9ybS1maWVsZC5tYXQtZm9jdXNlZC5tYXQtcHJpbWFyeSAubWF0LXNlbGVjdC1hcnJvdyB7XG4gIGNvbG9yOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xufVxuI3ZpZXdwYWdlbGlzdCAubWF0LWZvcm0tZmllbGQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogI2RjNGM2NCAhaW1wb3J0YW50O1xufVxuI3ZpZXdwYWdlbGlzdCAuaHJzdGFnLCAjdmlld3BhZ2VsaXN0IC53ZWVrZWRlZHRhZyB7XG4gIHBhZGRpbmc6IDVweCAxMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xuICBib3JkZXItcmFkaXVzOiA2cHg7XG4gIG1hcmdpbi1sZWZ0OiAxNXB4O1xufVxuI3ZpZXdwYWdlbGlzdCAud2Vla2VkZWR0YWcge1xuICBjb2xvcjogI2ZmYmM2ZTtcbiAgYm9yZGVyOiAxcHggc29saWQgI2ZmYmM2ZSAhaW1wb3J0YW50O1xuICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jdmlld3BhZ2VsaXN0IC5jbG9zZWFuZGRhdGVpY29uIHtcbiAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4jdmlld3BhZ2VsaXN0IC5hdmFpbGFibGV0eHRjb2xvciB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3ZpZXdwYWdlbGlzdCAudGltZWR1cmF0aW9uX2NvbnRhaW4gLnRyYWluaW5nZHVyYXRpb250aXRsZSB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDEuMTI1cmVtO1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI3ZpZXdwYWdlbGlzdCAudGltZWR1cmF0aW9uX2NvbnRhaW4gLnRyYWluaW5nZHVyYXRpb250aXRsZSAubWF0LWljb24ge1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgbWFyZ2luLXRvcDogNnB4O1xufVxuI3ZpZXdwYWdlbGlzdCAuZGF0ZWZvcm1maWVsZHJhbmdlIC5kYXRlcmFuZ2V0aW1lIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIHBhZGRpbmctYm90dG9tOiAwcHggIWltcG9ydGFudDtcbn1cbiN2aWV3cGFnZWxpc3QgI3NlYXJjaHJvdyxcbiN2aWV3cGFnZWxpc3QgI2ZpbHRlcnNob3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogbm9uZTtcbn1cbiN2aWV3cGFnZWxpc3QgI3NlYXJjaHJvdyAuc2VyYWNocm93LFxuI3ZpZXdwYWdlbGlzdCAjZmlsdGVyc2hvdyAuc2VyYWNocm93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4taGVpZ2h0OiA3M3B4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jdmlld3BhZ2VsaXN0IC50YWJsZXRvcGNvbmF0aW5lciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW4gIWltcG9ydGFudDtcbiAgd2lkdGg6IDEwMCU7XG59XG4jdmlld3BhZ2VsaXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUge1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIG1hcmdpbjogMTBweCAwcHg7XG59XG4jdmlld3BhZ2VsaXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xufVxuI3ZpZXdwYWdlbGlzdCAudGFibGV0b3Bjb25hdGluZXIgLmF3YXJlZHRhYmxlIC5tYW5hZ2VvcHRpb25zIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjYWNhY2FjO1xufVxuI3ZpZXdwYWdlbGlzdCAudGFibGV0b3Bjb25hdGluZXIgLmF3YXJlZHRhYmxlIC5zY3JvbGxkYXRhIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAxO1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG59XG4jdmlld3BhZ2VsaXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcbiAgd2lkdGg6IDZweDtcbiAgaGVpZ2h0OiA1cHg7XG59XG4jdmlld3BhZ2VsaXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcbiAgYmFja2dyb3VuZDogI2YxZjFmMTtcbn1cbiN2aWV3cGFnZWxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jdmlld3BhZ2VsaXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbn1cbiN2aWV3cGFnZWxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAubWFuYWdlb3B0aW9ucyB7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jdmlld3BhZ2VsaXN0IC50YWJsZXRvcGNvbmF0aW5lciAuYXdhcmVkdGFibGUgLm1hdC1yb3cge1xuICBib3JkZXItYm90dG9tOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbiN2aWV3cGFnZWxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAubWF0LWNlbGwge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiN2aWV3cGFnZWxpc3QgLnRhYmxldG9wY29uYXRpbmVyIC5hd2FyZWR0YWJsZSAubWF0LWhlYWRlci1jZWxsIHtcbiAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI3ZpZXdwYWdlbGlzdCAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4jdmlld3BhZ2VsaXN0ICNyZWdhcHAgLmNsb3NlYW5kZGF0ZWljb21heCB7XG4gIHRvcDogMTRweCAhaW1wb3J0YW50O1xufVxuI3ZpZXdwYWdlbGlzdCAubWFpbmNvbnRhaW5lcnRhYmxlIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbn1cbiN2aWV3cGFnZWxpc3QgLm1haW5jb250YWluZXJ0YWJsZSAuZHJwaWNrZXJoYWRlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmYmZiZmI7XG4gIHBhZGRpbmc6IDIwcHg7XG4gIHBhZGRpbmctYm90dG9tOiAwcHg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYWluY29udGFpbmVydGFibGUgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI3ZpZXdwYWdlbGlzdCAudG90YWxsZWFuZXJoZWFkZXIgcCB7XG4gIGNvbG9yOiAjODQ4NDg0O1xuICBwYWRkaW5nLWJvdHRvbTogNHB4O1xufVxuI3ZpZXdwYWdlbGlzdCAudG90YWxsZWFuZXJoZWFkZXIgc3BhbiB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3ZpZXdwYWdlbGlzdCAubWFpbmJveGJhdGNodmlldyB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkZGQ7XG59XG4jdmlld3BhZ2VsaXN0IC5tYWluYm94YmF0Y2h2aWV3IC5iYXRjaGZpcnN0Y29udGVudCB7XG4gIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGRkO1xuICBwYWRkaW5nOiAyMHB4IDI1cHg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYWluYm94YmF0Y2h2aWV3IC5sZWFuZXJ3aWR0aCB7XG4gIG1pbi13aWR0aDogMTUwcHg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYWluYm94YmF0Y2h2aWV3IC5iYXRjaHRpdGxlaGVhZGVyIHtcbiAgcGFkZGluZy1ib3R0b206IDEycHg7XG59XG4jdmlld3BhZ2VsaXN0IC5tYWluYm94YmF0Y2h2aWV3IC5iYXRjaHRpdGxlaGVhZGVyIC5tYXQtaWNvbiB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI3ZpZXdwYWdlbGlzdCAubWFpbmJveGJhdGNodmlldyAuYmF0Y2h0aXRsZWhlYWRlciBwIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jdmlld3BhZ2VsaXN0IC5tYWluYm94YmF0Y2h2aWV3IC5iYXRjaHRpdGxlaGVhZGVyIHAgc3BhbiB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3ZpZXdwYWdlbGlzdCAubWFpbmJveGJhdGNodmlldyAuc3RhdHVzaGVhZGVyIC5zdGF0dXN0ZXh0IHtcbiAgY29sb3I6ICM4NDg0ODQ7XG4gIHBhZGRpbmc6IDRweCAxMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xufVxuI3ZpZXdwYWdlbGlzdCAubWFpbmJveGJhdGNodmlldyAuc3RhdHVzaGVhZGVyIC5zdGF0dXN0ZXh0IC5zdGF0dXNjb2xvciB7XG4gIGNvbG9yOiAjMDBhNTUxO1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgLmJhdGNoYm90dG9tc3BhY2Uge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xuICAuZmlsdGVyYnRuIHtcbiAgICBtYXJnaW4tdG9wOiAxMHB4O1xuICB9XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/batch/batchviewpage/batchviewpage.component.ts":
  /*!************************************************************************!*\
    !*** ./src/app/modules/batch/batchviewpage/batchviewpage.component.ts ***!
    \************************************************************************/

  /*! exports provided: BatchviewpageComponent */

  /***/
  function srcAppModulesBatchBatchviewpageBatchviewpageComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "BatchviewpageComponent", function () {
      return BatchviewpageComponent;
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


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/config/BGIConfig/bgi-jsonconfig-services */
    "./src/app/config/BGIConfig/bgi-jsonconfig-services.ts");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! moment */
    "./node_modules/moment/moment.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_6__);
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _app_services_batch_service__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @app/services/batch.service */
    "./src/app/services/batch.service.ts");
    /* harmony import */


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");

    var BatchviewpageComponent = /*#__PURE__*/function () {
      function BatchviewpageComponent(translate, remoteService, cookieService, batchService, router, activatedRoute, security) {
        _classCallCheck(this, BatchviewpageComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.batchService = batchService;
        this.router = router;
        this.activatedRoute = activatedRoute;
        this.security = security;
        this.batchdetails = [];
        this.batchid = 'LVI-2023-027';
        this.values = [];
        this.defaultValue = {
          hour: 13,
          minute: 30
        };
        this.batchtraningdata_data = [];
        this.batchtraningdata_datalist = [];
        this.paginationSet = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_5__["BgiJsonconfigServices"].bgiConfigData.configuration.enterpriseAdminPaginatonSet;
        this.MRM_CreatedOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.BatchtrainingData = ['selecteddate', 'dayscheduled', 'starttime', 'endtime', 'time'];
        this.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_4__["MatTableDataSource"](this.batchtraningdata_data);
        this.BatchtrainingDatalist = ['selecteddate', 'dayscheduled', 'starttime', 'endtime', 'time'];
        this.batchtrainingdatalist = new _angular_material_table__WEBPACK_IMPORTED_MODULE_4__["MatTableDataSource"](this.batchtraningdata_datalist);
        this.selected2 = moment__WEBPACK_IMPORTED_MODULE_6___default()();
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.locale = {
          format: 'DD-MM-YYYY'
        };
        this.ranges = {
          'Today': [moment__WEBPACK_IMPORTED_MODULE_6___default()(), moment__WEBPACK_IMPORTED_MODULE_6___default()()],
          'Yesterday': [moment__WEBPACK_IMPORTED_MODULE_6___default()().subtract(1, 'days'), moment__WEBPACK_IMPORTED_MODULE_6___default()().subtract(1, 'days')],
          'Last 7 Days': [moment__WEBPACK_IMPORTED_MODULE_6___default()().subtract(6, 'days'), moment__WEBPACK_IMPORTED_MODULE_6___default()()],
          'Last 30 Days': [moment__WEBPACK_IMPORTED_MODULE_6___default()().subtract(29, 'days'), moment__WEBPACK_IMPORTED_MODULE_6___default()()],
          'This Month': [moment__WEBPACK_IMPORTED_MODULE_6___default()().startOf('month'), moment__WEBPACK_IMPORTED_MODULE_6___default()().endOf('month')],
          'Last Month': [moment__WEBPACK_IMPORTED_MODULE_6___default()().subtract(1, 'month').startOf('month'), moment__WEBPACK_IMPORTED_MODULE_6___default()().subtract(1, 'month').endOf('month')]
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
        this.dir = 'ltr';
      }

      _createClass(BatchviewpageComponent, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this29 = this;

          this.activatedRoute.queryParams.subscribe(function (data) {
            _this29.batchid = data.id;
          });

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this29.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect8 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect8.languagecode);
            this.dir = _toSelect8.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this29.translate.setDefaultLang(_this29.cookieService.get('languageCode'));

            if (_this29.cookieService.get('languageCookieId') && _this29.cookieService.get('languageCookieId') != undefined && _this29.cookieService.get('languageCookieId') != null) {
              var _toSelect9 = _this29.languagelist.find(function (c) {
                return c.id === _this29.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this29.translate.setDefaultLang(_toSelect9.languagecode);

              _this29.dir = _toSelect9.dir;
            } else {
              var _toSelect10 = _this29.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this29.translate.setDefaultLang(_toSelect10.languagecode);

              _this29.dir = _toSelect10.dir;
            }
          });
          this.getBatchdetails(this.batchid);
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
            console.log('page-content');
          } catch (error) {// console.log('page-content')
          }
        }
      }, {
        key: "clickEvent",
        value: function clickEvent() {
          this.hidefilder = !this.hidefilder;

          if (!this.hidefilder) {
            this.filtername = this.i18n('course.showfilt');
            var id = document.getElementById('searchrow');
            id.style.display = 'none';
          } else {
            this.filtername = this.i18n('course.hidefilt');

            var _id4 = document.getElementById('searchrow');

            _id4.style.display = 'flex';
          }
        }
      }, {
        key: "getBatchdetails",
        value: function getBatchdetails(bid) {
          var _this30 = this;

          var encbid = this.security.encrypt(bid);
          this.disableSubmitButton = true;
          this.batchService.fetchBatchdetails(encbid).subscribe(function (response) {
            if (response.status == 200) {
              _this30.disableSubmitButton = false;
              _this30.batchdetails = response.data;
              console.log(_this30.batchdetails.assessorArray.assessornames);

              if (_this30.batchdetails.theoryslots) {
                _this30.batchdetails.theoryslots.forEach(function (element) {
                  var obj = {
                    selecteddate: element.selecteddate,
                    dayscheduled: element.dayschedule,
                    startendtime: element.schedule,
                    start: element.start,
                    end: element.end,
                    diff: element.diff
                  };

                  _this30.batchtraningdata_data.push(obj);
                });

                _this30.batchtrainingdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_4__["MatTableDataSource"](_this30.batchtraningdata_data);
              }

              if (_this30.batchdetails.practslots) {
                _this30.batchdetails.practslots.forEach(function (element) {
                  var obj = {
                    selecteddate: element.selecteddate,
                    dayscheduled: element.dayschedule,
                    startendtime: element.schedule,
                    start: element.start,
                    end: element.end
                  };

                  _this30.batchtraningdata_datalist.push(obj);
                });

                _this30.batchtrainingdatalist = new _angular_material_table__WEBPACK_IMPORTED_MODULE_4__["MatTableDataSource"](_this30.batchtraningdata_datalist);
              }
            }
          });
        } // editData(data)
        // {
        //    this.batchid = data.batch_no;
        //    this.creationpageshowdata();
        // }

      }, {
        key: "CancelBatch",
        value: function CancelBatch(data) {
          var _this31 = this;

          this.disableSubmitButton = true;
          this.batchService.ChangeBatchStatus(this.batchid, 'cancel', 'Due to cancelled').subscribe(function (res) {
            if (res.data.status == 1) {
              _this31.getBatchdetails(_this31.batchid);
            }
          });
        }
      }, {
        key: "RegisterLearner",
        value: function RegisterLearner(data) {
          this.router.navigate(['/candidatemanagement/learner-register/' + this.batchid]);
        }
      }, {
        key: "ViewLearners",
        value: function ViewLearners(data) {
          this.router.navigate(['/candidatemanagement/viewlearner/' + this.batchid]);
        }
      }, {
        key: "ChangeAssessor",
        value: function ChangeAssessor(data) {
          this.router.navigate(['/assessmentreport/changeassessor/' + this.batchid]);
        }
      }]);

      return BatchviewpageComponent;
    }();

    BatchviewpageComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_7__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__["CookieService"]
      }, {
        type: _app_services_batch_service__WEBPACK_IMPORTED_MODULE_10__["BatchService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_12__["Router"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_12__["ActivatedRoute"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_11__["Encrypt"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_3__["MatPaginator"])], BatchviewpageComponent.prototype, "paginator", void 0);
    BatchviewpageComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-batchviewpage',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./batchviewpage.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/batchviewpage/batchviewpage.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./batchviewpage.component.scss */
      "./src/app/modules/batch/batchviewpage/batchviewpage.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_7__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__["CookieService"], _app_services_batch_service__WEBPACK_IMPORTED_MODULE_10__["BatchService"], _angular_router__WEBPACK_IMPORTED_MODULE_12__["Router"], _angular_router__WEBPACK_IMPORTED_MODULE_12__["ActivatedRoute"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_11__["Encrypt"]])], BatchviewpageComponent);
    /***/
  },

  /***/
  "./src/app/modules/batch/modal/commentmodal.scss":
  /*!*******************************************************!*\
    !*** ./src/app/modules/batch/modal/commentmodal.scss ***!
    \*******************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesBatchModalCommentmodalScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#commentbox {\n  min-width: 550px;\n  max-width: 550px;\n  height: auto;\n  /* Track */\n  /* Handle */\n  /* Handle on hover */\n}\n#commentbox .mat-icon {\n  cursor: pointer;\n}\n#commentbox .header {\n  padding: 15px 25px;\n}\n#commentbox .mat-divider {\n  width: 100%;\n  margin-left: 0px !important;\n  border-top-width: 1px;\n  border-color: #e8e8e8;\n}\n#commentbox .ck-content {\n  max-height: 110px;\n  font-size: 14px;\n}\n#commentbox .mat-divider-horizontal {\n  position: relative !important;\n}\n#commentbox .txt-gry {\n  color: #848484;\n}\n#commentbox .txt-gry3 {\n  color: #262626;\n}\n#commentbox .content {\n  padding: 15px 25px;\n}\n#commentbox .ckeditorborder {\n  max-height: 216px;\n  overflow: auto;\n  scroll-behavior: smooth;\n  height: auto;\n  border: 1px solid #d9d9d9;\n  cursor: text;\n  padding: 13px 10px;\n}\n#commentbox .ckeditorborder:hover {\n  border: 1px solid #6ba5ec;\n}\n#commentbox .ckeditorborder .editortitle {\n  color: #666;\n  cursor: text;\n}\n#commentbox .ckeditorborder p {\n  margin: 0;\n  padding-bottom: 5px;\n  cursor: text;\n}\n#commentbox .ckeditorborder figure img {\n  max-width: 100%;\n}\n#commentbox .ckeditorborder .contenthere p {\n  margin: 0 !important;\n  padding-bottom: 5px;\n  cursor: text;\n  word-break: break-word;\n}\n#commentbox .clearbutton {\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n}\n#commentbox .cancel_btn {\n  min-width: 120px;\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 40px;\n  font-size: 15px;\n  box-shadow: none;\n}\n#commentbox .error {\n  color: #dc4c64;\n}\n#commentbox .mat-raised-button {\n  box-shadow: none;\n  border-radius: 2px;\n  min-width: 90px;\n  font-size: 16px;\n}\n#commentbox ::-webkit-scrollbar {\n  width: 6px;\n}\n#commentbox ::-webkit-scrollbar-track {\n  box-shadow: inset 0 0 5px grey;\n  border-radius: 3px;\n}\n#commentbox ::-webkit-scrollbar-thumb {\n  background: #ED1C27;\n  border-radius: 3px;\n}\n#commentbox ::-webkit-scrollbar-thumb:hover {\n  background: #ED1C27;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n.commentfielsmodal .mat-dialog-container {\n  padding: 0px !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9iYXRjaC9tb2RhbC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxiYXRjaFxcbW9kYWxcXGNvbW1lbnRtb2RhbC5zY3NzIiwic3JjL2FwcC9tb2R1bGVzL2JhdGNoL21vZGFsL2NvbW1lbnRtb2RhbC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0VBQ0ksZ0JBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7RUEwR0EsVUFBQTtFQU1BLFdBQUE7RUFNQSxvQkFBQTtBQ2xISjtBREhFO0VBQ0UsZUFBQTtBQ0tKO0FESEk7RUFDSSxrQkFBQTtBQ0tSO0FEREk7RUFDSSxXQUFBO0VBQ0EsMkJBQUE7RUFDQSxxQkFBQTtFQUNBLHFCQUFBO0FDR1I7QURESTtFQUNJLGlCQUFBO0VBQ0EsZUFBQTtBQ0dSO0FEREk7RUFDSSw2QkFBQTtBQ0dSO0FEQUk7RUFDSSxjQUFBO0FDRVI7QURDSTtFQUNJLGNBQUE7QUNDUjtBREVJO0VBQ0ksa0JBQUE7QUNBUjtBREdJO0VBQ0ksaUJBQUE7RUFDQSxjQUFBO0VBQ0EsdUJBQUE7RUFDQSxZQUFBO0VBQ0EseUJBQUE7RUFDQSxZQUFBO0VBQ0Esa0JBQUE7QUNEUjtBREdRO0VBQ0kseUJBQUE7QUNEWjtBRElRO0VBQ0ksV0FBQTtFQUNBLFlBQUE7QUNGWjtBRE9RO0VBQ0ksU0FBQTtFQUNBLG1CQUFBO0VBQ0EsWUFBQTtBQ0xaO0FEU1k7RUFDSSxlQUFBO0FDUGhCO0FEWVk7RUFDSSxvQkFBQTtFQUNBLG1CQUFBO0VBQ0EsWUFBQTtFQUNBLHNCQUFBO0FDVmhCO0FEY0k7RUFDSSx1QkFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtBQ1pSO0FEY0k7RUFDSSxnQkFBQTtFQUNBLHVCQUFBO0VBQ0EseUJBQUE7RUFDQSxjQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxlQUFBO0VBQ0EsZ0JBQUE7QUNaUjtBRGVJO0VBQ0ksY0FBQTtBQ2JSO0FEZUk7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7QUNiUjtBRGVJO0VBQ0ksVUFBQTtBQ2JSO0FEaUJJO0VBQ0ksOEJBQUE7RUFDQSxrQkFBQTtBQ2ZSO0FEbUJJO0VBQ0ksbUJBQUE7RUFDQSxrQkFBQTtBQ2pCUjtBRHFCSTtFQUNJLG1CQUFBO0FDbkJSO0FEd0JRO0VBRUksb0NBQUE7QUN2Qlo7QUQ0QlE7RUFDSSxjQUFBO0FDMUJaO0FENkJRO0VBQ0ksMEJBQUE7QUMzQlo7QUQ4QlE7RUFDSSwwQkFBQTtBQzVCWjtBRCtCUTtFQUNJLGNBQUE7QUM3Qlo7QURnQ1E7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUM5Qlo7QURtQ1k7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNqQ2hCO0FEc0NvQjtFQUNJLGNBQUE7QUNwQ3hCO0FEMkNZO0VBQ0kseUJBQUE7QUN6Q2hCO0FEK0NZO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDN0NoQjtBRG1EZ0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUNqRHBCO0FEbURvQjtFQUNJLGNBQUE7QUNqRHhCO0FEcURnQjtFQUNJLHFCQUFBO0FDbkRwQjtBRDJESTtFQUNJLHVCQUFBO0FDeERSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9iYXRjaC9tb2RhbC9jb21tZW50bW9kYWwuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIiNjb21tZW50Ym94IHtcclxuICAgIG1pbi13aWR0aDogNTUwcHg7XHJcbiAgICBtYXgtd2lkdGg6IDU1MHB4O1xyXG4gICAgaGVpZ2h0OiBhdXRvO1xyXG4gIC5tYXQtaWNvbiB7XHJcbiAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgfVxyXG4gICAgLmhlYWRlciB7XHJcbiAgICAgICAgcGFkZGluZzogMTVweCAyNXB4O1xyXG5cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWRpdmlkZXIge1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItdG9wLXdpZHRoOiAxcHg7XHJcbiAgICAgICAgYm9yZGVyLWNvbG9yOiAjZThlOGU4O1xyXG4gICAgfVxyXG4gICAgLmNrLWNvbnRlbnQge1xyXG4gICAgICAgIG1heC1oZWlnaHQ6IDExMHB4O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTRweDtcclxuICAgIH1cclxuICAgIC5tYXQtZGl2aWRlci1ob3Jpem9udGFsIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmUgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAudHh0LWdyeSB7XHJcbiAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnR4dC1ncnkzIHtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgIH1cclxuXHJcbiAgICAuY29udGVudCB7XHJcbiAgICAgICAgcGFkZGluZzogMTVweCAyNXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5ja2VkaXRvcmJvcmRlciB7XHJcbiAgICAgICAgbWF4LWhlaWdodDogMjE2cHg7XHJcbiAgICAgICAgb3ZlcmZsb3c6IGF1dG87XHJcbiAgICAgICAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XHJcbiAgICAgICAgaGVpZ2h0OiBhdXRvO1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkOWQ5ZDk7XHJcbiAgICAgICAgY3Vyc29yOiB0ZXh0O1xyXG4gICAgICAgIHBhZGRpbmc6IDEzcHggMTBweDtcclxuXHJcbiAgICAgICAgJjpob3ZlciB7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICM2YmE1ZWM7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZWRpdG9ydGl0bGUge1xyXG4gICAgICAgICAgICBjb2xvcjogIzY2NjtcclxuICAgICAgICAgICAgY3Vyc29yOiB0ZXh0O1xyXG5cclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogNXB4O1xyXG4gICAgICAgICAgICBjdXJzb3I6IHRleHQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBmaWd1cmUge1xyXG4gICAgICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuY29udGVudGhlcmUge1xyXG4gICAgICAgICAgICBwIHtcclxuICAgICAgICAgICAgICAgIG1hcmdpbjogMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDVweDtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogdGV4dDtcclxuICAgICAgICAgICAgICAgIHdvcmQtYnJlYWs6IGJyZWFrLXdvcmQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuY2xlYXJidXR0b24ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmZmO1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNlOGU4ZTg7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICB9XHJcbiAgICAuY2FuY2VsX2J0biB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZThlOGU4O1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgICBoZWlnaHQ6IDQwcHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcblxyXG4gICAgfVxyXG4gICAgLmVycm9yIHtcclxuICAgICAgICBjb2xvcjogI2RjNGM2NDtcclxuICAgIH1cclxuICAgIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XHJcbiAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgbWluLXdpZHRoOiA5MHB4O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTZweDtcclxuICAgIH1cclxuICAgIDo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgICAgIHdpZHRoOiA2cHg7XHJcbiAgICB9XHJcbiAgICBcclxuICAgIC8qIFRyYWNrICovXHJcbiAgICA6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcclxuICAgICAgICBib3gtc2hhZG93OiBpbnNldCAwIDAgNXB4IGdyZXk7IFxyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDNweDtcclxuICAgIH1cclxuICAgIFxyXG4gICAgLyogSGFuZGxlICovXHJcbiAgICA6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjRUQxQzI3OyBcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICB9XHJcbiAgICBcclxuICAgIC8qIEhhbmRsZSBvbiBob3ZlciAqL1xyXG4gICAgOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI0VEMUMyNzsgXHJcbiAgICB9XHJcbiAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuXHJcbiAgICAgICAgLy8gJi5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXJlYWRvbmx5IHtcclxuICAgICAgICAgICAgLy8gLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA5YzNhICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIC8vIH1cclxuICAgICAgICAgICAgLy8gfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBjb2xvcjogI2Q5ZDlkOTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcblxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtLjlyZW0pIHNjYWxlKDAuNzUpO1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG5cclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG4uY29tbWVudGZpZWxzbW9kYWwge1xyXG4gICAgLm1hdC1kaWFsb2ctY29udGFpbmVyIHtcclxuICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxufSIsIiNjb21tZW50Ym94IHtcbiAgbWluLXdpZHRoOiA1NTBweDtcbiAgbWF4LXdpZHRoOiA1NTBweDtcbiAgaGVpZ2h0OiBhdXRvO1xuICAvKiBUcmFjayAqL1xuICAvKiBIYW5kbGUgKi9cbiAgLyogSGFuZGxlIG9uIGhvdmVyICovXG59XG4jY29tbWVudGJveCAubWF0LWljb24ge1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4jY29tbWVudGJveCAuaGVhZGVyIHtcbiAgcGFkZGluZzogMTVweCAyNXB4O1xufVxuI2NvbW1lbnRib3ggLm1hdC1kaXZpZGVyIHtcbiAgd2lkdGg6IDEwMCU7XG4gIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgYm9yZGVyLXRvcC13aWR0aDogMXB4O1xuICBib3JkZXItY29sb3I6ICNlOGU4ZTg7XG59XG4jY29tbWVudGJveCAuY2stY29udGVudCB7XG4gIG1heC1oZWlnaHQ6IDExMHB4O1xuICBmb250LXNpemU6IDE0cHg7XG59XG4jY29tbWVudGJveCAubWF0LWRpdmlkZXItaG9yaXpvbnRhbCB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZSAhaW1wb3J0YW50O1xufVxuI2NvbW1lbnRib3ggLnR4dC1ncnkge1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNjb21tZW50Ym94IC50eHQtZ3J5MyB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2NvbW1lbnRib3ggLmNvbnRlbnQge1xuICBwYWRkaW5nOiAxNXB4IDI1cHg7XG59XG4jY29tbWVudGJveCAuY2tlZGl0b3Jib3JkZXIge1xuICBtYXgtaGVpZ2h0OiAyMTZweDtcbiAgb3ZlcmZsb3c6IGF1dG87XG4gIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xuICBoZWlnaHQ6IGF1dG87XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkOWQ5ZDk7XG4gIGN1cnNvcjogdGV4dDtcbiAgcGFkZGluZzogMTNweCAxMHB4O1xufVxuI2NvbW1lbnRib3ggLmNrZWRpdG9yYm9yZGVyOmhvdmVyIHtcbiAgYm9yZGVyOiAxcHggc29saWQgIzZiYTVlYztcbn1cbiNjb21tZW50Ym94IC5ja2VkaXRvcmJvcmRlciAuZWRpdG9ydGl0bGUge1xuICBjb2xvcjogIzY2NjtcbiAgY3Vyc29yOiB0ZXh0O1xufVxuI2NvbW1lbnRib3ggLmNrZWRpdG9yYm9yZGVyIHAge1xuICBtYXJnaW46IDA7XG4gIHBhZGRpbmctYm90dG9tOiA1cHg7XG4gIGN1cnNvcjogdGV4dDtcbn1cbiNjb21tZW50Ym94IC5ja2VkaXRvcmJvcmRlciBmaWd1cmUgaW1nIHtcbiAgbWF4LXdpZHRoOiAxMDAlO1xufVxuI2NvbW1lbnRib3ggLmNrZWRpdG9yYm9yZGVyIC5jb250ZW50aGVyZSBwIHtcbiAgbWFyZ2luOiAwICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctYm90dG9tOiA1cHg7XG4gIGN1cnNvcjogdGV4dDtcbiAgd29yZC1icmVhazogYnJlYWstd29yZDtcbn1cbiNjb21tZW50Ym94IC5jbGVhcmJ1dHRvbiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmZmO1xuICBib3JkZXI6IDFweCBzb2xpZCAjZThlOGU4O1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNjb21tZW50Ym94IC5jYW5jZWxfYnRuIHtcbiAgbWluLXdpZHRoOiAxMjBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZmY7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNlOGU4ZTg7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDQwcHg7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgYm94LXNoYWRvdzogbm9uZTtcbn1cbiNjb21tZW50Ym94IC5lcnJvciB7XG4gIGNvbG9yOiAjZGM0YzY0O1xufVxuI2NvbW1lbnRib3ggLm1hdC1yYWlzZWQtYnV0dG9uIHtcbiAgYm94LXNoYWRvdzogbm9uZTtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBtaW4td2lkdGg6IDkwcHg7XG4gIGZvbnQtc2l6ZTogMTZweDtcbn1cbiNjb21tZW50Ym94IDo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogNnB4O1xufVxuI2NvbW1lbnRib3ggOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJveC1zaGFkb3c6IGluc2V0IDAgMCA1cHggZ3JleTtcbiAgYm9yZGVyLXJhZGl1czogM3B4O1xufVxuI2NvbW1lbnRib3ggOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XG4gIGJhY2tncm91bmQ6ICNFRDFDMjc7XG4gIGJvcmRlci1yYWRpdXM6IDNweDtcbn1cbiNjb21tZW50Ym94IDo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjRUQxQzI3O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1yZWFkb25seSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XG59XG4jY29tbWVudGJveCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzBjNGI5YTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jY29tbWVudGJveCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuXG4uY29tbWVudGZpZWxzbW9kYWwgLm1hdC1kaWFsb2ctY29udGFpbmVyIHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG59Il19 */";
    /***/
  },

  /***/
  "./src/app/modules/batch/modal/commentmodal.ts":
  /*!*****************************************************!*\
    !*** ./src/app/modules/batch/modal/commentmodal.ts ***!
    \*****************************************************/

  /*! exports provided: commentmodal */

  /***/
  function srcAppModulesBatchModalCommentmodalTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "commentmodal", function () {
      return commentmodal;
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


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/common/localstorage/applocalstorage.services */
    "./src/app/common/localstorage/applocalstorage.services.ts");
    /* harmony import */


    var _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @app/modules/registration/registration.service */
    "./src/app/modules/registration/registration.service.ts");
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


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
    /* harmony import */


    var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @ckeditor/ckeditor5-build-classic */
    "./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js");
    /* harmony import */


    var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(_ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_11__);

    var commentmodal = /*#__PURE__*/function () {
      function commentmodal(dialogRef, toastr, security, regService, fb, applocalstorage, translate, remoteService, cookieService, data) {
        _classCallCheck(this, commentmodal);

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
        this.length = '';
        this.editerfield = false;
        this.Editor = _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_11__;
        this.edittechinfo = false;
        this.techinfo = "";
        this.length_Of_ck = 0;
        this.comments = '';
        this.done = true;
        this.showField1 = false;
        this.showField2 = false;
        this.showField3 = false;
        this.statustrue = true;
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
        this.config = {
          toolbar: ['heading', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'blockquote', '|', 'undo', 'redo'],
          image: {
            toolbar: ['imageStyle:full', 'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignRight', '|', 'imageTextAlternative'],
            styles: [// This option is equal to a situation where no style is applied.
            'full', 'side', // This represents an image aligned to the left.
            'alignLeft', // This represents an image aligned to the right.
            'alignRight']
          },
          table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
          },
          placeholder: "Type the content here!"
        };

        if (data.fieldToShow === 'field1') {
          this.showField1 = true;
        } else if (data.fieldToShow === 'field2') {
          this.showField2 = true;
        } else {
          this.showField3 = true;
        }
      }

      _createClass(commentmodal, [{
        key: "i18n",
        value: function i18n(key) {
          return this.translate.instant(key);
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this32 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this32.cookieService.get('languageCookieId');
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);

            this.translate.setDefaultLang(toSelect.languagecode);
            this.dir = toSelect.dir;
          } else {
            var _toSelect11 = this.languagelist.find(function (c) {
              return c.id == '1';
            }); //this.patientCategory.get('patientCategory').setValue(toSelect);


            this.translate.setDefaultLang(_toSelect11.languagecode);
            this.dir = _toSelect11.dir;
          }

          this.remoteService.getLanguageCookie().subscribe(function (data) {
            _this32.translate.setDefaultLang(_this32.cookieService.get('languageCode'));

            if (_this32.cookieService.get('languageCookieId') && _this32.cookieService.get('languageCookieId') != undefined && _this32.cookieService.get('languageCookieId') != null) {
              var _toSelect12 = _this32.languagelist.find(function (c) {
                return c.id === _this32.cookieService.get('languageCookieId');
              });

              _this32.translate.setDefaultLang(_toSelect12.languagecode);

              _this32.dir = _toSelect12.dir;
            } else {
              var _toSelect13 = _this32.languagelist.find(function (c) {
                return c.id == '1';
              });

              _this32.translate.setDefaultLang(_toSelect13.languagecode);

              _this32.dir = _toSelect13.dir;
            }
          });
          this.validForm();
        }
      }, {
        key: "onChangeeditor",
        value: function onChangeeditor(event) {
          this.length_Of_ck = $(this.validationForm.controls['comments'].value).text().length;
          this.comments = $(this.validationForm.controls['comments'].value).text();

          if (this.length_Of_ck > 1000) {
            this.validationForm.setErrors({
              'invalid': true
            });
            this.validationForm.controls['comments'].setErrors({
              'incorrect': true
            });
            this.done = true;
          }
        }
      }, {
        key: "close",
        value: function close() {
          this.validationForm.reset();
          this.techinfo = "";
          this.dialogRef.close({
            data: true
          });
          this.validationForm.controls.status.reset();
        }
      }, {
        key: "resinfo",
        value: function resinfo() {
          this.validationForm.controls['comments'].setValue("");
          this.techinfo = "";
          this.comments = "";
        }
      }, {
        key: "validForm",
        value: function validForm() {
          this.validationForm = this.fb.group({
            comments: [''],
            status: ['']
          });
        }
      }, {
        key: "f",
        get: function get() {
          return this.validationForm.controls;
        }
      }, {
        key: "editinfo",
        value: function editinfo() {
          this.edittechinfo = !this.edittechinfo;
        }
      }, {
        key: "closeModalPopup",
        value: function closeModalPopup() {
          this.dialogRef.close({
            data: true
          });
          this.resinfo();
          this.validationForm.controls.status.reset();
        }
      }, {
        key: "messagedone",
        value: function messagedone() {
          this.addinfo();
          this.editinfo();
          this.done = false;
        }
      }, {
        key: "addinfo",
        value: function addinfo() {
          this.techinfo = this.validationForm.controls['comments'].value;
        }
      }, {
        key: "submitted",
        value: function submitted() {
          this.resinfo();
          this.dialogRef.close({
            data: true
          });
          this.validationForm.controls.status.reset();
        }
      }, {
        key: "statusupdatevalue",
        value: function statusupdatevalue(value) {
          value = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

          if (value == value) {
            this.statustrue = false;
          } else {
            // console.log(23456789)
            this.statustrue = true;
          }
        }
      }]);

      return commentmodal;
    }();

    commentmodal.ctorParameters = function () {
      return [{
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialogRef"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_10__["ToastrService"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"]
      }, {
        type: _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_6__["RegistrationService"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]
      }, {
        type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"]
      }, {
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"]
      }, {
        type: undefined,
        decorators: [{
          type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"],
          args: [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MAT_DIALOG_DATA"]]
        }]
      }];
    };

    commentmodal = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: "commentmodal",
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./commentmodal.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/batch/modal/commentmodal.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./commentmodal.scss */
      "./src/app/modules/batch/modal/commentmodal.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__param"])(9, Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"])(_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MAT_DIALOG_DATA"])), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialogRef"], ngx_toastr__WEBPACK_IMPORTED_MODULE_10__["ToastrService"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"], _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_6__["RegistrationService"], _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"], _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"], Object])], commentmodal);
    /***/
  }
}]);
//# sourceMappingURL=modules-batch-batch-module-es5.js.map