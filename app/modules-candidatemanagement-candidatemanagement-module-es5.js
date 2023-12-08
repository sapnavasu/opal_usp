function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-candidatemanagement-candidatemanagement-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learner-register/learner-register.component.html":
  /*!************************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learner-register/learner-register.component.html ***!
    \************************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesCandidatemanagementLearnerRegisterLearnerRegisterComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"coursesinfo\" class=\"flex-column coursesinfo\">\r\n    <div class=\"coursesinfotbale\">\r\n        <div class=\"batchheader clflex flex-column rwidth\" *ngIf=\"batchdata_data !=null\">\r\n            <div class=\"batchdetails flex-column\">\r\n                <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                    <div fxLayout=\"row\" class=\"clflex rwidth \">\r\n                        <p>Training Evaluation Centre : <span>{{batchdata_data.traning_center}}</span></p>\r\n                        <p>Batch No.: <span>{{batchdata_data.batach_no}}</span></p>\r\n                        <p>Batch Type: <span>{{batchdata_data.batch_type}}</span></p>\r\n                    </div>\r\n                    <p>\r\n                        <button mat-icon-button class=\"batchIcon\" [matMenuTriggerFor]=\"menu\"\r\n                            aria-label=\"Example icon-button with a menu\">\r\n                            <mat-icon>more_horiz</mat-icon>\r\n                        </button>\r\n                        <mat-menu class=\"topmenu\" #menu=\"matMenu\">\r\n                            <button mat-menu-item>\r\n                                <span>Edit</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Change Assessor</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Download Attendence Report</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Assessor Change Request to OPAL</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Request for Back Track</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Audit Log</span>\r\n                            </button>\r\n                        </mat-menu>\r\n                    </p>\r\n                </div>\r\n                <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                    <p class=\"bor\">Status: <span class=\"colgreen\">{{getassessmentstatus(batchdata_data.status)}}</span>\r\n                    </p>\r\n                    <p class=\"bor\">Office Type : <span>{{batchdata_data.office_type==1 ? 'Main Office' : 'Branch\r\n                            Office'}}</span></p>\r\n                    <p class=\"bor\">Branch Name: <span>{{batchdata_data.branch_name}}</span></p>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"batchdetails1\" fxLayout=\"row\">\r\n                <div class=\"batchdetails1innerdiv clflex flex-column\">\r\n                    <p>Traning Duration </p>\r\n                    <p class=\"fontblack\">{{batchdata_data.start_date}} to {{batchdata_data.end_date}}</p>\r\n                </div>\r\n                <div class=\"batchdetails1innerdiv clflex flex-column\">\r\n                    <p>Total Learner </p>\r\n                    <p class=\"fontblack\">{{batchdata_data.total_learners}}/{{batchdata_data.total}}</p>\r\n                </div>\r\n                <div class=\" batchdetails1innerdiv clflex flex-column\">\r\n                    <p>Remaining Capacity</p>\r\n                    <p class=\"fontblack\">{{batchdata_data.reamaining_learners}}/{{batchdata_data.total}}</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <h6 class=\"color-default fs-16\">{{'basics.learner_reg_form' | translate}}</h6>\r\n    <form [formGroup]=\"formGroup\" (ngSubmit)=\"submitForm(formGroup.value)\">\r\n        <div class=\"batchdetails2 flex-column\">\r\n\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class=\"table_wid\">\r\n                    <mat-label>{{'reg.civil_num' | translate}}</mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"sir_idnumber\" (input)=\"checkCivilNum($event)\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['sir_idnumber'].errors?.required || formGroup.submitted\">{{'errors.civil_num_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <div class=\"table_wid\"></div>\r\n            </div>\r\n\r\n\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'reg.learn_english' | translate}}</mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"sir_name_en\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['sir_name_en'].errors?.required || formGroup.submitted\">{{'errors.learner_name_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid text-right'>\r\n                    <mat-label>{{'reg.learn_arabic' | translate}}</mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"sir_name_ar\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['sir_name_ar'].errors?.required || formGroup.submitted\">{{'errors.learner_name_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label name=\"email\" type=\"email\">{{'reg.email' | translate}}</mat-label>\r\n                    <input type=\"email\" matInput formControlName=\"sir_emailid\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['sir_emailid'].errors?.required || formGroup.submitted\">{{'errors.email_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <div class=\"table_wid\"></div>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'reg.mobile' | translate}}</mat-label>\r\n                    <input type=\"number\" matInput formControlName=\"mnumber\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['mnumber'].errors?.required  || formGroup.submitted\">{{'errors.mobile_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'reg.alt_mobile' | translate}}</mat-label>\r\n                    <input type=\"number\" matInput formControlName=\"mnumber2\">\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n\r\n                <mat-form-field appearance=\"outline\" class=\"date_box\">\r\n                    <mat-label>{{'reg.dob' | translate}}</mat-label>\r\n                    <input matInput [max]=\"maxDate\" [matDatepicker]=\"picker\" (dateChange)=\"getage($event)\"\r\n                        formControlName=\"sir_dob\" required>\r\n                    \r\n                    <mat-datepicker-toggle matIcon [for]=\"picker\" class=\"date_img\"></mat-datepicker-toggle>\r\n                    <mat-datepicker #picker></mat-datepicker>\r\n                    <mat-error *ngIf=\"formGroup.controls['sir_dob'].errors?.required  || formGroup.submitted\">{{'errors.dob_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\">\r\n                    <mat-label>{{'reg.age' | translate}}</mat-label>\r\n                    <input type=\"number\" readonly=\"readonly\" matInput formControlName=\"age\">\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\">\r\n                    <mat-label>{{'reg.gender' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"sir_gender\" (selectionChange)=\"changeFormAddress($event)\" required>\r\n                        <mat-option></mat-option>\r\n                        <mat-option value=\"1\">Male</mat-option>\r\n                        <mat-option value=\"2\">Female</mat-option>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['sir_gender'].errors?.required  || formGroup.submitted\">{{'errors.gender_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\">\r\n                    <mat-label>{{'reg.form_of' | translate}} </mat-label>\r\n                    <input type=\"text\" readonly=\"readonly\" matInput formControlName=\"form_address\">\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\">\r\n                    <mat-label>{{'reg.nationality' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"sir_nationality\" read\r\n                        *ngIf=\"(countrylist | filter : searchcountry) as countryresult\">\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">{{'basics.search' | translate}}</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcountry\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchcountry = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchcountry !='' && searchcountry !=null\">clear</mat-icon>\r\n                        </div>\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let list of countrylist | filter : searchcountry\"\r\n                                [value]=\"list.opalcountrymst_pk\">\r\n                                {{ifarabic == true ? list.ocym_countryname_ar :\r\n                                list.ocym_countryname_en}}\r\n                            </mat-option>\r\n                        </div>\r\n                    </mat-select>\r\n                </mat-form-field>\r\n            </div>\r\n\r\n            <div class=\"content\">\r\n                <div class=\"content\">\r\n                    <label for=\"profile\" color=\"gray\">\r\n                        {{'reg.profile_photo' | translate}}\r\n                    </label>\r\n                </div>\r\n                <div class=\"content\">\r\n                    <app-filee #awarddoc [fileMstRef]=\"profilePhoto\"\r\n                        (filesSelected)=\"fileeSelected($event,profilePhoto)\" formControlName=\"sir_photo\"\r\n                        [notePosition]=\"'bottom'\">\r\n                    </app-filee>\r\n                </div>\r\n            </div>\r\n            <div class=\"content\">\r\n                <div class=\"content\">\r\n                    <label for=\"profile\" color=\"gray\">\r\n                        {{'reg.civil_id' | translate}}\r\n                    </label>\r\n                </div>\r\n\r\n                <div class=\"content\">\r\n                    <app-filee #awarddoc [fileMstRef]=\"cividId\" (filesSelected)=\"fileeSelected($event,cividId)\"\r\n                        formControlName=\"sir_civilidfront\" [notePosition]=\"'bottom'\">\r\n                    </app-filee>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"content m-t-30\">\r\n                <div class=\"text-left fs-16 color-default\">\r\n                    <p>{{'reg.royal_oman' | translate}}</p>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"content mb-2\">\r\n                <div class=\"col-12 text-left\">\r\n                    \r\n                    <p>{{'reg.has_license' | translate}}<span class=\"text-danger\">*</span>\r\n                        <mat-radio-group formControlName=\"radion_button\"  aria-label=\"Select an option\"\r\n                            style=\"padding-left: 20px;\">\r\n                            <mat-radio-button  value=\"1\" class=\"mr-1\">Yes</mat-radio-button>\r\n                            <mat-radio-button  value=\"0\"> No</mat-radio-button>\r\n                        </mat-radio-group>\r\n                    </p>\r\n                </div>\r\n            </div>\r\n\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'reg.license' | translate}}</mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"license_number\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['license_number'].errors?.required || formGroup.submitted\">{{'errors.license_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <div class=\"table_wid\"></div>\r\n            </div>\r\n\r\n            <div class=\"content\">\r\n                <div class=\"content\">\r\n                    <label for=\"profile\" color=\"gray\">\r\n                        {{'reg.lic_card' | translate}}\r\n                    </label>\r\n                </div>\r\n                <div class=\"content\">\r\n                    <app-filee #awarddoc [fileMstRef]=\"licenseCard\" (filesSelected)=\"fileeSelected($event,licenseCard)\"\r\n                        formControlName=\"license_card\" [notePosition]=\"'bottom'\">\r\n                    </app-filee>\r\n                </div>\r\n            </div>\r\n\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <p class=\"license\">{{'reg.light_license' | translate}}<span class=\"text-danger\">*</span>\r\n                    <mat-radio-group aria-label=\"Select an option\" formControlName=\"light_license\"\r\n                        style=\"padding-left: 20px;\">\r\n                        <mat-radio-button value=\"1\" class=\"mr-1\">Yes</mat-radio-button>\r\n                        <mat-radio-button value=\"2\"> No</mat-radio-button>\r\n                    </mat-radio-group>\r\n                </p>\r\n                <p class=\"license\">{{'reg.heavy_license' | translate}}<span class=\"text-danger\">*</span>\r\n                    <mat-radio-group aria-label=\"Select an option\" formControlName=\"heavy_license\"\r\n                        style=\"padding-left: 20px;\">\r\n                        <mat-radio-button value=\"1\" class=\"mr-1\">Yes</mat-radio-button>\r\n                        <mat-radio-button value=\"2\"> No</mat-radio-button>\r\n                    </mat-radio-group>\r\n                </p>\r\n            </div>\r\n\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid date_box'>\r\n                    <mat-label>{{'reg.issue_date' | translate}}</mat-label>\r\n                    <input matInput [max]=\"issueDate\" [matDatepicker]=\"picker1\" formControlName=\"light_issue_date\">\r\n                    <mat-datepicker-toggle [for]=\"picker1\" class=\"date_img\"></mat-datepicker-toggle>\r\n                    <mat-datepicker #picker1></mat-datepicker>\r\n                    <mat-error *ngIf=\"formGroup.controls['light_license'].value==1 || formGroup.submitted\">{{'errors.light_license_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid date_box'>\r\n                    <mat-label>{{'reg.issue_date' | translate}}</mat-label>\r\n                    <input matInput [max]=\"issueDate\" [matDatepicker]=\"picker2\" formControlName=\"heavy_issue_date\">\r\n                    <mat-datepicker-toggle [for]=\"picker2\" class=\"date_img\"></mat-datepicker-toggle>\r\n                    <mat-datepicker #picker2></mat-datepicker>\r\n                    <mat-error *ngIf=\"formGroup.controls['heavy_license'].value==1 || formGroup.submitted\">{{'errors.heavy_license_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n\r\n            <div class=\"content text-left\">\r\n                <h5 class=\"color-default fs-16\">Permanent Residence</h5>\r\n            </div>\r\n\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'reg.house' | translate}}<span class=\"text-danger\"></span><span\r\n                            class=\"text-danger\">*</span></mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"sir_addrline1\">\r\n                    <mat-error *ngIf=\"formGroup.controls['sir_addrline1'].errors?.required || formGroup.submitted\">{{'errors.address_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'reg.house2' | translate}}</mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"sir_addrline2\">\r\n                </mat-form-field>\r\n            </div>\r\n\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'basics.country' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"country\" disabled (selectionChange)=\"getState($event)\"\r\n                        *ngIf=\"(countrylist | filter : searchcountry) as countryresult\" required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcountry\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchcountry = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchcountry !='' && searchcountry !=null\">clear</mat-icon>\r\n                        </div>\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let list of countrylist | filter : searchcountry\"\r\n                                [value]=\"list.opalcountrymst_pk\">\r\n                                {{ifarabic == true ? list.ocym_countryname_ar :\r\n                                list.ocym_countryname_en}}\r\n                            </mat-option>\r\n                        </div>\r\n                    </mat-select>\r\n                   \r\n                </mat-form-field>\r\n                <div class=\"table_wid\"></div>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'basics.state' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"state\"\r\n                        (selectionChange)=\"getCity($event,formGroup.controls['country'].value)\"\r\n                        *ngIf=\"(stateList | filter : searchstate) as stateresult\" required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchstate\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchstate = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchstate !='' && searchstate !=null\">clear</mat-icon>\r\n                        </div>\r\n\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let stat of stateList | filter : searchstate\"\r\n                                [value]=\"stat\">\r\n                                {{ifarabic == true ? stat.osm_statename_ar :\r\n                                stat.osm_statename_en}}\r\n                            </mat-option>\r\n                            <div *ngIf=\"stateresult.length == 0\">No result found</div>\r\n                        </div>\r\n\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['state'].errors?.required || formGroup.submitted\">{{'errors.state_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'basics.city' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"city\" *ngIf=\"(cityList | filter : searchcity) as cityresult\"\r\n                        [disableOptionCentering]=\"true\" required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcity\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchcity = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchcity !='' && searchcity !=null\">clear</mat-icon>\r\n                        </div>\r\n\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let cty of cityList | filter : searchcity\" [value]=\"cty\">\r\n                                {{ifarabic == true ? cty.ocim_cityname_ar :\r\n                                cty.ocim_cityname_en}}\r\n                            </mat-option>\r\n                            <div *ngIf=\"cityresult.length == 0\">No result found</div>\r\n                        </div>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['city'].errors?.required || formGroup.submitted\">{{'errors.city_req' | translate}}</mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n\r\n            <div fxLayout=\"row\" class=\"clflex rwidth fbutton\">\r\n                <button type=\"reset\" class=\"clear-btn fs-16\">{{'basics.clear' | translate}}</button>\r\n                <button class=\"add-btn fs-16\"> {{formGroup.controls['staffworkexp_pk'].value ? \"Update\" :\r\n                    \"Add\"}}</button>\r\n            </div>\r\n        </div>\r\n    </form>\r\n\r\n\r\n    <h5 class=\"color-default fs-16\"> {{'education.qualification' | translate}}</h5>\r\n    <div class=\"batchdetails flex-column education-background\">\r\n        <form [formGroup]=\"formGroup\" (ngSubmit)=\"academicSubmit(formGroup.value)\">\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid date_box'>\r\n                    <mat-label>{{'education.start_date' | translate}}</mat-label>\r\n                    <input matInput formControlName=\"year_join\" [matDatepicker]=\"picker3\" required>\r\n                    \r\n                    <mat-datepicker-toggle [for]=\"picker3\" class=\"date_img\"></mat-datepicker-toggle>\r\n                    <mat-datepicker #picker3></mat-datepicker>\r\n                    <mat-error *ngIf=\"formGroup.controls['year_join'].errors?.required || formGroup.submitted\">{{'errors.year_join_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid date_box'>\r\n                    <mat-label>{{'education.end_date' | translate}}</mat-label>\r\n                    <input matInput formControlName=\"year_pass\" [matDatepicker]=\"picker4\" required>\r\n                    \r\n                    <mat-datepicker-toggle [for]=\"picker4\" class=\"date_img\"></mat-datepicker-toggle>\r\n                    <mat-datepicker #picker4></mat-datepicker>\r\n                    <mat-error *ngIf=\"formGroup.controls['year_join'].errors?.required || formGroup.submitted\">{{'errors.year_pass_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'education.institute' | translate}}</mat-label>\r\n                    <input matInput formControlName=\"institute_name\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['institute_name'].errors?.required || formGroup.submitted\">{{'errors.inst_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'basics.country' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"institue_country\" (selectionChange)=\"egetState($event)\"\r\n                        *ngIf=\"(countrylist | filter : esearchcountry) as ecountryresult\" required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcountry\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchcountry = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchcountry !='' && searchcountry !=null\">clear</mat-icon>\r\n                        </div>\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let list of countrylist | filter : searchcountry\"\r\n                                [value]=\"list.opalcountrymst_pk\">\r\n                                {{ifarabic == true ? list.ocym_countryname_ar :\r\n                                list.ocym_countryname_en}}\r\n                            </mat-option>\r\n                        </div>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['institue_country'].errors?.required || formGroup.submitted\">{{'errors.country_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'basics.state' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"inst_state\"\r\n                        (selectionChange)=\"egetCity($event,formGroup.controls['institue_country'].value)\"\r\n                        *ngIf=\"(eStateList | filter : esearchstate) as estateresult\" required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchstate\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchstate = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"esearchstate !='' && esearchstate !=null\">clear</mat-icon>\r\n                        </div>\r\n\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let stat of eStateList | filter : searchstate\" [value]=\"stat\">\r\n                                {{ifarabic == true ? stat.osm_statename_ar :\r\n                                stat.osm_statename_en}}\r\n                            </mat-option>\r\n                            <div *ngIf=\"estateresult.length == 0\">No result found</div>\r\n                        </div>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['city'].errors?.required || formGroup.submitted\">{{'errors.state_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'basics.city' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"inst_city\" *ngIf=\"(eCityList | filter : esearchcity) as ecityresult\"\r\n                        required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcity\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchcity = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"esearchcity !='' && esearchcity !=null\">clear</mat-icon>\r\n                        </div>\r\n\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let cty of eCityList | filter : searchcity\" [value]=\"cty\">\r\n                                {{ifarabic == true ? cty.ocim_cityname_ar :\r\n                                cty.ocim_cityname_en}}\r\n                            </mat-option>\r\n                            <div *ngIf=\"ecityresult.length == 0\">No result found</div>\r\n                        </div>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['city'].errors?.required || formGroup.submitted\">{{'errors.city_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'education.edut_level' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"edut_level\" required>\r\n                        <mat-option value=\"\">{{'education.edut_level' | translate}}</mat-option>\r\n                        <mat-option *ngFor=\"let level of stafflevel_list\" [value]=\"level.referencemst_pk\">\r\n                            {{ifarabic == true ? level.rm_name_ar :\r\n                                level.rm_name_en}}\r\n                        </mat-option>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['edut_level'].errors?.required || formGroup.submitted\">{{'errors.edut_level_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'education.degree' | translate}}</mat-label>\r\n                    <input matInput formControlName=\"degree_cert\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['degree_cert'].errors?.required || formGroup.submitted\">{{'errors.degree_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'education.grade' | translate}}</mat-label>\r\n                    <input matInput formControlName=\"gpa_grade\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['gpa_grade'].errors?.required || formGroup.submitted\">{{'errors.gpa_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n                <div class=\"table_wid\"></div>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex rwidth fbutton\">\r\n                <button type=\"reset\" class=\"clear-btn fs-16\">{{'basics.clear' | translate}}</button>\r\n                <button type=\"submit\" class=\"add-btn fs-16\">\r\n                    {{formGroup.controls['staffacademics_pk'].value ? \"Update\" : \"Add\"}}\r\n                </button>\r\n            </div>\r\n\r\n\r\n        </form>\r\n\r\n    </div>\r\n    <div class=\"paginator-add-filter\">\r\n        <mat-grid-list cols=\"6\" rowHeight=\"100px\">\r\n            <mat-grid-tile [colspan]=\"4\" class=\"pagination\" [rowspan]=\"1\">\r\n                <mat-paginator #edu_paginator length=\"educationdata.length\" pageSize=\"5\" pageIndex=\"0\"\r\n                    [pageSizeOptions]=\"[5,10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"\r\n                    aria-label=\"Select page of periodic elements\">\r\n                </mat-paginator>\r\n            </mat-grid-tile>\r\n            <mat-grid-tile [colspan]=\"2\" class=\"add-filter-button\" [rowspan]=\"1\">\r\n                <div fxlayout=\"row wrap\" ng-reflect-fx-layout=\"row wrap\">\r\n                    <div fxflex.gt-sm=\"100\" fxflex=\"100\" ng-reflect-fx-flex.gt-sm=\"100\" ng-reflect-fx-flex=\"100\"\r\n                        style=\"flex: 1 1 100%; box-sizing: border-box; max-width: 100%;\">\r\n                        <button (click)=\"showEduFilter()\" class=\"filter-btn fs-15\">\r\n                            {{edufilter ? \"Show Filter\" : \"Hide Filter\"}}<i aria-hidden=\"true\"\r\n                                class=\"fa fa-filter m-l-6\"></i>\r\n\r\n                        </button>\r\n                    </div>\r\n                </div>\r\n            </mat-grid-tile>\r\n        </mat-grid-list>\r\n    </div>\r\n\r\n    <!-- <mat-divider></mat-divider> -->\r\n\r\n    <div class=\"coursesinfotbale\">\r\n        <mat-table mat-table [dataSource]=\"educationdata\" matSort (matSortChange)=\"announceSortChange($event)\"\r\n            class=\"mat-courseinfo\">\r\n\r\n            <ng-container matColumnDef=\"sacd_institutename\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'education.institute' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sacd_institutename}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sacd_degorcert\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'education.degree' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sacd_degorcert}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sacd_startdate\">\r\n                <mat-header-cell  *matHeaderCellDef mat-sort-header>{{'education.start_date' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell  *matCellDef=\"let element\"> {{getDate(element.sacd_startdate)}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sacd_enddate\">\r\n                <mat-header-cell *matHeaderCellDef  mat-sort-header>{{'education.end_date' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\" > {{getDate(element.sacd_enddate)}} </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"sacd_grade\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'education.grade' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sacd_grade}} </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"added_on\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'education.added_on' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{getDate(element.sacd_createdon)}} </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"last_updated_on\">\r\n                <mat-header-cell *matHeaderCellDef  mat-sort-header>{{'education.last_update' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\" > {{getDate(element.sacd_updatedon)}} </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"action\" class=\"suspended\">\r\n                <mat-header-cell *matHeaderCellDef> {{'education.action' | translate}} </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\">\r\n                    <button mat-icon-button [matMenuTriggerFor]=\"menu\" aria-label=\"Example icon-button with a menu\">\r\n                        <mat-icon>more_horiz</mat-icon>\r\n                    </button>\r\n                    <mat-menu #menu=\"matMenu\" style=\"background-color: gray;\">\r\n                        <button mat-menu-item (click)=\"editEduList(element)\">\r\n                            Edit\r\n                        </button>\r\n                        <button mat-menu-item (click)=\"delEduList(element)\">\r\n                            Delete\r\n                        </button>\r\n                    </mat-menu>\r\n                </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"row-first\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"example-form-field\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput type=\"text\" (keyup)=\"applyFilterEdu($event)\">\r\n                        \r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-second\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"example-form-field\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput type=\"text\" (keyup)=\"applyFilterEdu($event)\">\r\n                        \r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-three\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef  id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" [(value)]=\"sel_sacd_startdate\"  formControlName=\"sacd_startdate\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-four\"  [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" [(value)]=\"sel_sacd_enddate\"  formControlName=\"sacd_enddate\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"row-five\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"example-form-field\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput type=\"text\" (keyup)=\"applyFilterEdu($event)\">\r\n                        \r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"row-six\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef  id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" [(value)]=\"sel_added_on\" formControlName=\"added_on\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"row-seven\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\" >\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" [(value)]=\"sel_last_updated_on\" formControlName=\"last_updated_on\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"row-eight\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <i class=\"fa fa-refresh m-l-15 cursorview\" aria-hidden=\"true\" matTooltip=\"Refresh\"></i>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n\r\n\r\n            <mat-header-row *matHeaderRowDef=\"displayEducation\"></mat-header-row>\r\n            <mat-header-row id=\"edusearchrow\"\r\n                *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six','row-seven','row-eight']\">\r\n            </mat-header-row>\r\n            <mat-row *matRowDef=\"let row; columns: displayEducation;\"></mat-row>\r\n        </mat-table>\r\n        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                <mat-paginator #edu_paginator [pageSize]=\"paginator?.pageSize\" showFirstLastButtons\r\n                    (page)=\"syncPrimaryPaginator($event);\" [pageIndex]=\"edu_paginator?.pageIndex\"\r\n                    [length]=\"edu_paginator?.length\" [pageSizeOptions]=\"edu_paginator?.pageSizeOptions\">\r\n                </mat-paginator>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <h5 class=\"color-default fs-16\">Work Experience</h5>\r\n\r\n    <div class=\"batchdetails flex-column education-background\">\r\n        <form [formGroup]=\"formGroup\" (ngSubmit)=\"submitForm2(formGroup.value)\">\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>Employer</mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"sexp_employername\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['sexp_employername'].errors?.required || formGroup.submitted\">{{'errors.employ_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>Job Title</mat-label>\r\n                    <input type=\"text\" matInput formControlName=\"sexp_designation\" required>\r\n                    <mat-error *ngIf=\"formGroup.controls['sexp_designation'].errors?.required || formGroup.submitted\">{{'errors.design_req' | translate}}\r\n                    </mat-error>\r\n                </mat-form-field>\r\n                \r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid date_box'>\r\n                    <mat-label>Date of Joining<span class=\"text-danger\">*</span></mat-label>\r\n                    <input matInput [matDatepicker]=\"picker5\" formControlName=\"sexp_doj\">\r\n                    <mat-datepicker-toggle [for]=\"picker5\" class=\"date_img\"></mat-datepicker-toggle>\r\n                    <mat-datepicker #picker5></mat-datepicker>\r\n                    <mat-error *ngIf=\"formGroup.controls['sexp_doj'].errors?.required || formGroup.submitted\">{{'errors.doj_req' | translate}} </mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid_new date_box'>\r\n                    <mat-label>Worked Till</mat-label>\r\n                    <input matInput [matDatepicker]=\"picker6\" formControlName=\"sexp_eod\">\r\n                    <mat-datepicker-toggle [for]=\"picker6\" [disabled]=\"notAllow\"\r\n                        class=\"date_img\"></mat-datepicker-toggle>\r\n                    <mat-datepicker #picker6></mat-datepicker>\r\n                </mat-form-field>\r\n                <mat-checkbox value=\"1\" formControlName=\"sexp_currentlyworking\" (change)=\"currentlyWorking($event)\"\r\n                    class=\"check_table_box\">Currently\r\n                    Working</mat-checkbox>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>Country</mat-label>\r\n                    <mat-select formControlName=\"sexp_opalcountrymst_fk\" (selectionChange)=\"expgetState($event)\"\r\n                        *ngIf=\"(countrylist | filter : searchcountry) as countryresult\" required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcountry\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchcountry = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchcountry !='' && searchcountry !=null\">clear</mat-icon>\r\n                        </div>\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let list of countrylist | filter : searchcountry\" [value]=\"list\"\r\n                                [selected]=\"1\">\r\n                                {{ifarabic == true ? list.ocym_countryname_ar :\r\n                                list.ocym_countryname_en}}\r\n                            </mat-option>\r\n                        </div>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['sexp_opalcountrymst_fk'].errors?.required || formGroup.submitted\">{{'errors.country_req' | translate}} </mat-error>\r\n                </mat-form-field>\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>{{'basics.state' | translate}}</mat-label>\r\n                    <mat-select formControlName=\"sexp_opalstatemst_fk\"\r\n                        (selectionChange)=\"expgetCity($event,formGroup.controls['sexp_opalcountrymst_fk'].value)\"\r\n                        *ngIf=\"(expStateList | filter : searchstate) as stateresult\" required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchstate\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchstate = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchstate !='' && searchstate !=null\">clear</mat-icon>\r\n                        </div>\r\n\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let stat of expStateList | filter : searchstate\"\r\n                                [value]=\"stat\">\r\n                                {{ifarabic == true ? stat.osm_statename_ar :\r\n                                stat.osm_statename_en}}\r\n                            </mat-option>\r\n                            <div *ngIf=\"stateresult.length == 0\">No result found</div>\r\n                        </div>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['sexp_opalstatemst_fk'].errors?.required || formGroup.submitted\">\r\n                        {{'errors.state_req' | translate}} </mat-error>\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex swidth\">\r\n                <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                    <mat-label>City</mat-label>\r\n                    <mat-select formControlName=\"sexp_opalcitymst_fk\"\r\n                        *ngIf=\"(expCityList | filter : searchcity) as cityresult\" [disableOptionCentering]=\"true\"\r\n                        required>\r\n                        <div class=\"searchinmultiselect\">\r\n                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'course.sear' | translate}} \"\r\n                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcity\"\r\n                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                            <mat-icon (click)=\"searchcity = ''\" class=\"reseticon\" matSuffix\r\n                                *ngIf=\"searchcity !='' && searchcity !=null\">clear</mat-icon>\r\n                        </div>\r\n\r\n                        <div class=\"option-listing countryselectwithimage\">\r\n                            <mat-option *ngFor=\"let cty of expCityList | filter : searchcity\"\r\n                                [value]=\"cty\">\r\n                                {{ifarabic == true ? cty.ocim_cityname_ar :\r\n                                cty.ocim_cityname_en}}\r\n                            </mat-option>\r\n                            <div *ngIf=\"cityresult.length == 0\">No result found</div>\r\n                        </div>\r\n                    </mat-select>\r\n                    <mat-error *ngIf=\"formGroup.controls['sexp_opalstatemst_fk'].errors?.required || formGroup.submitted\">\r\n                        {{'errors.city_req' | translate}} </mat-error>\r\n                </mat-form-field>\r\n                <div class='table_wid'></div>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"fbutton\">\r\n                <button type=\"reset\" class=\"clear-btn fs-16\">{{'basics.clear' | translate}}</button>\r\n                <button type=\"submit\" class=\"add-btn fs-16\">\r\n                    {{formGroup.controls['staffworkexp_pk'].value ? \"Update\" : \"Add\"}}\r\n                </button>\r\n            </div>\r\n        </form>\r\n\r\n    </div>\r\n    <div class=\"paginator-add-filter\">\r\n        <mat-grid-list cols=\"6\" rowHeight=\"100px\">\r\n            <mat-grid-tile [colspan]=\"4\" class=\"pagination\"  [rowspan]=\"1\">\r\n                <mat-paginator #exppaginator length=\"educationdata.length\" pageSize=\"5\" pageIndex=\"0\"\r\n                    [pageSizeOptions]=\"[5,10, 25, 100]\" (page)=\"syncExperiencePaginator($event);\"\r\n                    aria-label=\"Select page of periodic elements\">\r\n                </mat-paginator>\r\n            </mat-grid-tile>\r\n            <mat-grid-tile [colspan]=\"2\" class=\"add-filter-button\" [rowspan]=\"1\">\r\n                <div fxlayout=\"row wrap\" ng-reflect-fx-layout=\"row wrap\">\r\n                    <div fxflex.gt-sm=\"100\" fxflex=\"100\" ng-reflect-fx-flex.gt-sm=\"100\" ng-reflect-fx-flex=\"100\">\r\n                        <button class=\"filter-btn fs-15\" (click)=\"showExpFilter()\">\r\n                            {{expFilter ? \"Show Filter\" : \"Hide Filter\"}}<i aria-hidden=\"true\"\r\n                                class=\"fa fa-filter m-l-6\"></i>\r\n                        </button>\r\n                    </div>\r\n                </div>\r\n            </mat-grid-tile>\r\n        </mat-grid-list>\r\n    </div>\r\n\r\n    <div class=\"coursesinfotbale\">\r\n\r\n        <table mat-table [dataSource]=\"learnerdata\" matSort class=\"mat-courseinfo\"\r\n            (matSortChange)=\"experienceSortChange($event)\">\r\n\r\n            <ng-container matColumnDef=\"sexp_employername\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'work.employer' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sexp_employername}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sexp_doj\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'work.doj' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sexp_doj}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sexp_currentlyworking\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'work.worked_till' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sexp_currentlyworking==1 ? \"Currently Working\" :\r\n                    element.sexp_eod}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sexp_designation\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'work.job_title' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sexp_designation}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sexp_createdon\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header >{{'work.added_on' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\" > {{element.sexp_createdon}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sexp_updatedon\">\r\n                <mat-header-cell *matHeaderCellDef mat-sort-header>{{'work.last_update' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"> {{element.sexp_updatedon}} </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"action\" class=\"suspended\">\r\n                <mat-header-cell *matHeaderCellDef> {{'work.action' | translate}} </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\">\r\n                    <button mat-icon-button [matMenuTriggerFor]=\"menu\" aria-label=\"Example icon-button with a menu\">\r\n                        <mat-icon>more_horiz</mat-icon>\r\n                    </button>\r\n                    <mat-menu #menu=\"matMenu\" style=\"background-color: gray;\">\r\n                        <button mat-menu-item (click)=\"editExpList(element)\">\r\n                            Edit\r\n                        </button>\r\n                        <button mat-menu-item (click)=\"delExpList(element)\">\r\n                            Delete\r\n                        </button>\r\n                    </mat-menu>\r\n                </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"row-first\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"example-form-field\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput type=\"text\" (keyup)=\"applyFilter($event)\">\r\n                        <button *ngIf=\"value\" matSuffix mat-icon-button aria-label=\"Clear\" (click)=\"value=''\">\r\n                            <mat-icon>close</mat-icon>\r\n                        </button>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-second\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-three\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-four\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"example-form-field\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput type=\"text\" (keyup)=\"applyFilter($event)\">\r\n                        <button *ngIf=\"value\" matSuffix mat-icon-button aria-label=\"Clear\" (click)=\"value=''\">\r\n                            <mat-icon>close</mat-icon>\r\n                        </button>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-five\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-six\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <div class=\"drpicker\" id=\"regapp\">\r\n                            <input id=\"login_session\" #pickers matInput type=\"text\" autocomplete=\"off\" ngxDaterangepickerMd  [showCustomRangeLabel]=\"true\"  [alwaysShowCalendars]=\"true\" [ranges]=\"ranges\"  [locale]=\"locale\" [linkedCalendars]=\"true\"  [showClearButton]=\"true\"  [maxDate]='selected2'  readonly class=\"form-control\" [max]=\"today\"/>\r\n                            <div class=\"closeanddateicon\">\r\n                                <mat-datepicker-toggle matSuffix >\r\n                                </mat-datepicker-toggle>\r\n                            </div>\r\n                        </div>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-seven\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <i class=\"fa fa-refresh m-l-15 cursorview\" aria-hidden=\"true\" matTooltip=\"Refresh\"></i>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n\r\n\r\n            <mat-header-row *matHeaderRowDef=\"displayedColumns2\"></mat-header-row>\r\n            <mat-header-row id=\"searchrow\"\r\n                *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six','row-seven']\">\r\n            </mat-header-row>\r\n            <mat-row *matRowDef=\"let row; columns: displayedColumns2;\"></mat-row>\r\n        </table>\r\n        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                <mat-paginator #exppaginator [pageSize]=\"exppaginator?.pageSize\" showFirstLastButtons\r\n                    (page)=\"syncExperiencePaginator($event);\" [pageIndex]=\"exppaginator?.pageIndex\"\r\n                    [length]=\"exppaginator?.length\" [pageSizeOptions]=\"exppaginator?.pageSizeOptions\">\r\n                </mat-paginator>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"batchdetails2 flex-column\" style=\"margin-top: 2.5rem;\">\r\n        <div fxLayout=\"row\" class=\"clflex swidth\">\r\n            <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                <mat-label>Total Years of Experience</mat-label>\r\n                <input matInput>\r\n            </mat-form-field>\r\n            <mat-form-field appearance=\"outline\"  class='table_wid'>\r\n                <mat-label>Learner Fee</mat-label>\r\n                <input matInput [value]=\"learner_fees\" readonly formControlName=\"learner_fee\">\r\n            </mat-form-field>\r\n        </div>\r\n        <div fxLayout=\"row\" class=\"clflex swidth\">\r\n            <mat-form-field appearance=\"outline\"  class='table_wid'>\r\n                <mat-label>Leaner fee status</mat-label>\r\n                <input matInput formControlName=\"learner_fee_status\">\r\n            </mat-form-field>\r\n            <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                <mat-label>Payment to be done by</mat-label>\r\n                <mat-select formControlName=\"paid_by\">\r\n                    <mat-option>Learner</mat-option>\r\n                    <mat-option>Opal</mat-option>\r\n                    <mat-option>Operator</mat-option>\r\n                </mat-select>\r\n            </mat-form-field>\r\n        </div>\r\n        <div fxLayout=\"row\" class=\"clflex swidth\">\r\n            <mat-form-field appearance=\"outline\" class='table_wid'>\r\n                <mat-label>Company Name</mat-label>\r\n                <mat-select>\r\n                    <mat-option>National Institute</mat-option>\r\n                    <mat-option>Opal Institute</mat-option>\r\n                    <mat-option>Oxford University</mat-option>\r\n                </mat-select>\r\n            </mat-form-field>\r\n        </div>\r\n    </div>\r\n\r\n    <h5 class=\"color-default fs-15\">Opal Certified Details</h5>\r\n    <div class=\"paginator-add-filter batchdetails flex-column bor\">\r\n        <mat-grid-list cols=\"6\" rowHeight=\"100px\">\r\n            <mat-grid-tile [colspan]=\"4\" class=\"pagination\" [rowspan]=\"1\">\r\n                <!-- <mat-paginator [pageSizeOptions]=\"[5, 10, 25, 100]\" aria-label=\"Select page of periodic elements\">\r\n                </mat-paginator> -->\r\n            </mat-grid-tile>\r\n            <mat-grid-tile [colspan]=\"2\" class=\"add-filter-button\" [rowspan]=\"1\">\r\n                <div fxlayout=\"row wrap\" ng-reflect-fx-layout=\"row wrap\">\r\n                    <div fxflex.gt-sm=\"100\" fxflex=\"100\" ng-reflect-fx-flex.gt-sm=\"100\" ng-reflect-fx-flex=\"100\"\r\n                        style=\"flex: 1 1 100%; box-sizing: border-box; max-width: 100%;\">\r\n                        <button class=\"filter-btn fs-15\">\r\n                            {{filter ? \"Hide Filter\" : \"Show Filter\"}}<i aria-hidden=\"true\"\r\n                                class=\"fa fa-filter m-l-6\"></i>\r\n\r\n                        </button>\r\n                    </div>\r\n                </div>\r\n            </mat-grid-tile>\r\n        </mat-grid-list>\r\n\r\n        <div class=\"learnerdata\">\r\n\r\n        </div>\r\n    </div>\r\n\r\n    <div fxLayout=\"row\" class=\"clflex rwidth fbutton mt-1\">\r\n        <button type=\"reset\" class=\"clear-btn fs-16\">{{'basics.clear' | translate}}</button>\r\n        <button class=\"add-btn fs-16\"> {{formGroup.controls['staffworkexp_pk'].value ? \"Update\" :\r\n            \"Submit\"}}</button>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learnerslist/dialog-box.component.html":
  /*!**************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learnerslist/dialog-box.component.html ***!
    \**************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesCandidatemanagementLearnerslistDialogBoxComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div id=\"dialog-box\">\r\n  <mat-grid-list cols=\"2\" rowHeight=\"50px\">\r\n    <mat-grid-tile colspan=\"1\" class=\"text-left\">\r\n      <mat-card-title class=\"m-0\">Print Card</mat-card-title>\r\n    </mat-grid-tile>\r\n    <mat-grid-tile colspan=\"1\" class=\"text-right\">\r\n      <span class=\"F-s\" mat-dialog-close=\"\">&times;</span>\r\n    </mat-grid-tile>\r\n  </mat-grid-list>\r\n\r\n  <mat-grid-list cols=\"4\" rowHeight=\"50px\">\r\n    <mat-grid-tile colspan=\"1\" class=\"text-right\">\r\n      <p class=\"s-no\">Serial number</p>\r\n    </mat-grid-tile>\r\n    <mat-grid-tile colspan=\"2\" class=\"text-right\">\r\n      <mat-form-field appearance=\"outline\" style=\"width: 100%;\">\r\n        <input matInput>\r\n      </mat-form-field>\r\n    </mat-grid-tile>\r\n  </mat-grid-list>\r\n\r\n  <mat-grid-list cols=\"2\" rowHeight=\"50px\" class=\"text-right\">\r\n    <mat-grid-tile colspan=\"1\">\r\n      \r\n    </mat-grid-tile>\r\n    <mat-grid-tile colspan=\"1\">\r\n      <button mat-raised-button=\"\">Clear</button>\r\n      <button mat-raised-button=\"\" color=\"warn\">Print</button>\r\n    </mat-grid-tile>\r\n  </mat-grid-list>\r\n\r\n</div>\r\n<!-- <div fxLayout=\"row\" class=\"clflex rwidth\"\r\n  style=\"flex-flow: row wrap; box-sizing: border-box; display: flex;padding-left: 80%;\">\r\n  <button mat-raised-button=\"\" color=\"\" type=\"button\"\r\n    class=\"mat-focus-indicator ShowHidefs-15 submit_btn m-r-10 mat-raised-button mat-button-base\"\r\n    ng-reflect-color=\"\"><span class=\"mat-button-wrapper\">Clear\r\n    </span>\r\n    <div matripple=\"\" class=\"mat-ripple mat-button-ripple\" ng-reflect-disabled=\"false\" ng-reflect-centered=\"false\"\r\n      ng-reflect-trigger=\"[object HTMLButtonElement]\"></div>\r\n    <div class=\"mat-button-focus-overlay\"></div>\r\n  </button>\r\n  <button mat-raised-button=\"\" color=\"warn\" type=\"button\"\r\n    class=\"mat-focus-indicator ShowHidefs-15 submit_btn m-r-10 mat-raised-button mat-button-base mat-primary\"\r\n    ng-reflect-color=\"warn\"><span class=\"mat-button-wrapper\">Print\r\n    </span>\r\n    <div matripple=\"\" class=\"mat-ripple mat-button-ripple\" ng-reflect-disabled=\"false\" ng-reflect-centered=\"false\"\r\n      ng-reflect-trigger=\"[object HTMLButtonElement]\"></div>\r\n    <div class=\"mat-button-focus-overlay\"></div>\r\n  </button>\r\n</div> -->";
    /***/
  },

  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.html":
  /*!****************************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.html ***!
    \****************************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesCandidatemanagementLearnerslistLearnerslistComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"learnerlisting\" class=\"flex-column coursesinfo\">\r\n\r\n    <div class=\"coursesinfotbale\">\r\n        <div class=\"batchheader clflex flex-column rwidth\" *ngIf=\"batchdata_data !=null\">\r\n            <div class=\"batchdetails flex-column\">\r\n                <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                    <div fxLayout=\"row\" class=\"clflex rwidth \">\r\n                        <p>Training Evaluation Centre: <span>{{batchdata_data.traning_center}}</span></p>\r\n                        <p>Batch No.: <span>{{batchdata_data.batach_no}}</span></p>\r\n                        <p>Batch Type: <span>{{batchdata_data.batch_type}}</span></p>\r\n                    </div>\r\n                    <p>\r\n                        <button mat-icon-button class=\"batchIcon\" [matMenuTriggerFor]=\"menu\"\r\n                            aria-label=\"Example icon-button with a menu\">\r\n                            <mat-icon>more_horiz</mat-icon>\r\n                        </button>\r\n                        <mat-menu class=\"topmenu\" #menu=\"matMenu\">\r\n                            <button mat-menu-item>\r\n                                <span>Edit</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Change Assessor</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Download Attendence Report</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Assessor Change Request to OPAL</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Request for Back Track</span>\r\n                            </button>\r\n                            <button mat-menu-item>\r\n                                <span>Audit Log</span>\r\n                            </button>\r\n                        </mat-menu>\r\n                    </p>\r\n                </div>\r\n                <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                    <p class=\"bor\">Status: <span class=\"colgreen\">{{getassessmentstatus(batchdata_data.status)}}</span>\r\n                    </p>\r\n                    <p class=\"bor\">Office Type: <span>{{batchdata_data.office_type==1 ? 'Main Office' : 'Branch\r\n                            Office'}}</span></p>\r\n                    <p class=\"bor\">Branch Name: <span>{{batchdata_data.branch_name}}</span></p>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"batchdetails1\" fxLayout=\"row\">\r\n                <div class=\"batchdetails1innerdiv clflex flex-column\">\r\n                    <p>Traning Duration</p>\r\n                    <p class=\"fontblack\">{{batchdata_data.start_date}} to {{batchdata_data.end_date}}</p>\r\n                </div>\r\n                <div class=\"batchdetails1innerdiv clflex flex-column\">\r\n                    <p>Total Learners</p>\r\n                    <p class=\"fontblack\">{{batchdata_data.total_learners}}/{{batchdata_data.total}}</p>\r\n                </div>\r\n                <div class=\" batchdetails1innerdiv clflex flex-column\">\r\n                    <p>Remaining Capacity</p>\r\n                    <p class=\"fontblack\">{{batchdata_data.reamaining_learners}}/{{batchdata_data.total}}</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n\r\n    <div class=\"paginator-add-filter\">\r\n        <mat-grid-list cols=\"6\" rowHeight=\"100px\">\r\n            <mat-grid-tile [colspan]=\"5\" class=\"pagination\" [rowspan]=\"1\">\r\n                <mat-paginator #paginator length=\"learnerdata.length\" pageSize=\"5\" pageIndex=\"0\"   [pageSizeOptions]=\"[5,10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                <div class=\"example-button-row\">\r\n                    <button mat-stroked-button  type=\"button\" *ngIf=\"attendance_data.length > 0\" class=\"mr-1 btn-no-rad\" (click)=\"bulkAttendance(1)\">{{'basics.present' | translate}}</button>\r\n                    <button mat-stroked-button type=\"button\" *ngIf=\"attendance_data.length > 0\" class=\"mr-1 btn-no-rad\" (click)=\"bulkAttendance(2)\">{{'basics.absent' | translate}}</button>\r\n                    <button mat-stroked-button type=\"button\" *ngIf=\"attendance_data.length > 0\" class=\"mr-1 btn-no-rad\"  (click)=\"moveStatus(3)\">{{'basics.mtraining' | translate}}</button>\r\n                    <button mat-stroked-button type=\"button\" *ngIf=\"attendance_data.length > 0\" class=\"mr-1 btn-no-rad\"   (click)=\"moveStatus(6)\">{{'basics.massessment' | translate}}</button>\r\n                </div>\r\n            </mat-grid-tile>\r\n            <mat-grid-tile [colspan]=\"1\" class=\"add-filter-button\" [rowspan]=\"1\">\r\n                <div fxlayout=\"row wrap\" ng-reflect-fx-layout=\"row wrap\"\r\n                    style=\"flex-flow: row wrap; box-sizing: border-box; display: flex;\">\r\n                    <div fxflex.gt-sm=\"100\" fxflex=\"100\" ng-reflect-fx-flex.gt-sm=\"100\" ng-reflect-fx-flex=\"100\"\r\n                        style=\"flex: 1 1 100%; box-sizing: border-box; max-width: 100%;\">\r\n                        <button mat-raised-button=\"\" color=\"danger\" type=\"button\" *ngIf=\" batchdata_data != null && batchdata_data.total_learners < batchdata_data.total && batchdata_data.status == 1\"\r\n                            class=\"mat-focus-indicator btn btn-danger ShowHidefs-15 submit_btn m-r-10 mat-raised-button mat-button-base mat-danger\"\r\n                            ng-reflect-color=\"primary\" (click)=\"registerPage()\"><span class=\"mat-button-wrapper\">Add\r\n                            </span>\r\n                            <div matripple=\"\" class=\"mat-ripple mat-button-ripple\" ng-reflect-disabled=\"false\"\r\n                                ng-reflect-centered=\"false\" ng-reflect-trigger=\"[object HTMLButtonElement]\"></div>\r\n                            <div class=\"mat-button-focus-overlay\"></div>\r\n                        </button>\r\n                        <button mat-raised-button=\"\" type=\"button\" color=\"primary\"\r\n                            class=\"mat-focus-indicator btn-primary filter mat-raised-button mat-button-base mat-primary\"\r\n                            ng-reflect-color=\"primary\"><span class=\"mat-button-wrapper\" (click)=\"showFilter()\">\r\n                                {{filter ? \"Show Filter\" : \"Hide Filter\"}}<i aria-hidden=\"true\"\r\n                                    class=\"fa fa-filter m-l-6\"></i></span>\r\n                            <div matripple=\"\" class=\"mat-ripple mat-button-ripple\" ng-reflect-disabled=\"false\"\r\n                                ng-reflect-centered=\"false\" ng-reflect-trigger=\"[object HTMLButtonElement]\"></div>\r\n                            <div class=\"mat-button-focus-overlay\"></div>\r\n                        </button>\r\n                    </div>\r\n                </div>\r\n            </mat-grid-tile>\r\n        </mat-grid-list>\r\n    </div>\r\n    <mat-divider></mat-divider>\r\n\r\n    <div class=\"coursesinfotbale\">\r\n\r\n        <mat-table [dataSource]=\"learnerdata\" matSort class=\"mat-courseinfo\"\r\n            (matSortChange)=\"announceSortChange($event)\">\r\n            <ng-container matColumnDef=\"checkbox\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef>\r\n                    <mat-checkbox class=\"example-margin\" (change)=\"isAllSelected($event)\"></mat-checkbox>\r\n                </mat-header-cell>\r\n                <mat-cell *matCellDef=\"let element\"><mat-checkbox class=\"example-margin\" [checked]=\"selectAll\"\r\n                        (change)=\"selectCheckbox($event,element)\"></mat-checkbox></mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sir_idnumber\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.civil_num' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.sir_idnumber}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sir_name_en\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.learn_english'\r\n                    |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.sir_name_en}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sir_emailid\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.email' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.sir_emailid}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sir_dob\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.age' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{getage(element.sir_dob)}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"sir_gender\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.gender' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.sir_gender==1 ? \"Male\" : \"Female\"\r\n                    }}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"th_tutor\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.th_tutor' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.th_tutor || 'N/A'}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"pra_tutor\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.pra_tutor' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.pra_tutor || 'N/A'}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"asmt_staff\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.asmt_staff' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.asmt_staff || 'N/A'}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"ivqastaff\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.ivqastaff' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">{{element.ivqastaff || 'N/A'}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"lrhd_feestatus\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.lrhd_feestatus'\r\n                    |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\"\r\n                    class=\"{{element.lrhd_feestatus==1 ? 'text-success' : 'text-danger'}}\">{{element.lrhd_feestatus==1\r\n                    ? \"Paid\" : \"Yet to pay\"}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"rm_status_en\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.knowledge' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\" \r\n                    class=\"{{element.rm_status_en ? element.rm_status_en=='Pass' ? 'text-success' : 'text-danger' : 'colorange'}}\">{{element.rm_status_en ? element.rm_status_en : 'Pending'}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"rm_status_ar\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'reg.practical' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\"\r\n                    class=\"{{element.rm_status_ar ? element.rm_status_ar=='Pass' || element.rm_status_ar=='Competent' ? 'text-success' : 'text-danger' : 'colorange'}}\">{{element.rm_status_ar ? element.rm_status_ar : 'Pending'}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"lrhd_status\">\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef mat-sort-header>{{'Status' |\r\n                    translate}}</mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\"\r\n                    style=\"{{'color:'+getstatuscolor(element.lrhd_status)}}\">{{getstatus(element.lrhd_status)}}</mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"action\" class=\"suspended\" stickyEnd>\r\n                <mat-header-cell fxFlex=\"250px\" mat-header-cell *matHeaderCellDef> {{'basics.action' | translate}}\r\n                </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"250px\" *matCellDef=\"let element\">\r\n                    <button mat-icon-button [matMenuTriggerFor]=\"menu\" aria-label=\"Example icon-button with a menu\">\r\n                        <mat-icon>more_horiz</mat-icon>\r\n                    </button>\r\n                    <mat-menu #menu=\"matMenu\" style=\"background-color: gray;\">\r\n                        <button mat-menu-item *ngIf=\"element.lrhd_feestatus!=1\">\r\n                            Update Payment Status\r\n                        </button>\r\n                        \r\n                        <button mat-menu-item *ngIf=\"element.lrhd_status < 6\" (click)=\"markAttendance(1,element)\">\r\n                            <span>Mark as Present</span>\r\n                        </button>\r\n                        \r\n                        <button mat-menu-item  *ngIf=\"element.lrhd_status < 6\" (click)=\"markAttendance(2,element)\">\r\n                            <span>Mark as No Show</span>\r\n                        </button>\r\n                        <button mat-menu-item *ngIf=\"element.lrhd_status == 6 || element.lrhd_status == 8\">\r\n                            <span (click)=\"actionRoute(element.tad_learnerreghrddtls_fk, 'assessment')\">Update Assessment Report</span>\r\n                        </button>\r\n                        <!-- <button mat-menu-item *ngIf=\"element.lrhd_status == 6 || element.lrhd_status == 8\">\r\n                            <span>Retake Assessment</span>\r\n                        </button> -->\r\n                        <button mat-menu-item *ngIf=\"element.lrhd_status == 7 \">\r\n                            <span (click)=\"actionRoute(element.tad_learnerreghrddtls_fk, 'view&approvel')\">View & Approve</span>\r\n                        </button>\r\n                        <button mat-menu-item *ngIf=\"element.lrhd_status == 8 \">\r\n                            <span>View Assessment Report</span>\r\n                        </button>\r\n                        <button mat-menu-item *ngIf=\"element.lrhd_status == 11 && batchdata_data.printcard == 1\">\r\n                            <span>View Card</span>\r\n                        </button>\r\n                        <a mat-menu-item target=\"_blank\" *ngIf=\"element.lrhd_status == 11 && batchdata_data.printcard == 1\" href=\"http://192.168.1.38/opal_usp/api/ar/assessmentreport/generatecard?serialno=100000001&learnerid=2\">\r\n                            <span>Print Card</span>\r\n                        </a>\r\n                    </mat-menu>\r\n                </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"row-first\">\r\n                <mat-header-cell fxFlex=\"250px\" *matHeaderCellDef id=\"search\">\r\n                    &nbsp;\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-second\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell fxFlex=\"250px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput formControlName=\"sir_idnumber\">\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-three\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell fxFlex=\"250px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput formControlName=\"sir_name_en\">\r\n\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-four\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell fxFlex=\"250px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput formControlName=\"sir_emailid\">\r\n\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-five\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    &nbsp;\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-six\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Select</mat-label>\r\n                        <mat-select [(value)]=\"gen_selection\" formControlName=\"sir_gender\" multiple>\r\n                            <mat-option value=\"1\">Male</mat-option>\r\n                            <mat-option value=\"2\">Female</mat-option>\r\n                        </mat-select>\r\n\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-seven\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput formControlName=\"th_tutor\">\r\n\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-eight\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput formControlName=\"pra_tutor\">\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-nine\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput formControlName=\"asmt_staff\">\r\n\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-ten\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Search</mat-label>\r\n                        <input matInput formControlName=\"ivqastaff\">\r\n\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-eleven\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Select</mat-label>\r\n                        <mat-select [(value)]=\"learner_selection\" formControlName=\"lrhd_feestatus\" multiple>\r\n                            <mat-option value=\"0\">Yet to pay</mat-option>\r\n                            <mat-option value=\"1\">Paid</mat-option>\r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-twelve\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Select</mat-label>\r\n                        <mat-select [(value)]=\"knowledge_selection\" formControlName=\"rm_status_en\" multiple>\r\n                            <mat-option value=\"Pass\">Pass</mat-option>\r\n                            <mat-option value=\"Fail\">Fail</mat-option>\r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-thirteen\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Select</mat-label>\r\n                        <mat-select [(value)]=\"practical_selection\" formControlName=\"rm_status_ar\" multiple>\r\n                            <mat-option value=\"Pass\">Pass</mat-option>\r\n                            <mat-option value=\"Fail\">Fail</mat-option>\r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-fourteen\" [formGroup]=\"filterForm\">\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Select</mat-label>\r\n                        <mat-select [(value)]=\"status_selection\" multiple formControlName=\"lrhd_status\">\r\n                            <mat-option value=\"1\">New</mat-option>\r\n                            <mat-option value=\"2\">Teaching(theory)</mat-option>\r\n                            <mat-option value=\"3\">Teaching(practical)</mat-option>\r\n                            <mat-option value=\"4\">No Show(theory)</mat-option>\r\n                            <mat-option value=\"5\">No Show(practical)</mat-option>\r\n                            <mat-option value=\"6\">Assessment</mat-option>\r\n                            <mat-option value=\"7\">Quality Check</mat-option>\r\n                            <mat-option value=\"8\">Declined during Quality Check</mat-option>\r\n                            <mat-option value=\"9\">Resubmitted for Quality Check</mat-option>\r\n                            <mat-option value=\"10\">Print</mat-option>\r\n                            <mat-option value=\"11\">Completed</mat-option>\r\n                            <mat-option value=\"12\">Re-take Assesment</mat-option>\r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-fifteen\" stickyEnd>\r\n                <mat-header-cell *matHeaderCellDef id=\"search\">\r\n                    <i class=\"fa fa-refresh m-l-15 cursorview\" aria-hidden=\"true\" matTooltip=\"Refresh\"></i>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <mat-header-row *matHeaderRowDef=\"displayedColumns\"></mat-header-row>\r\n            <mat-header-row id=\"searchrow\" *matHeaderRowDef=\"displaySearchColumns\"></mat-header-row>\r\n            <mat-row *matRowDef=\"let row; columns: displayedColumns;\"></mat-row>\r\n        </mat-table>\r\n        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                <mat-paginator #paginator [pageSize]=\"paginator?.pageSize\" showFirstLastButtons\r\n                    (page)=\"syncPrimaryPaginator($event);\" [pageIndex]=\"paginator?.pageIndex\"\r\n                    [length]=\"paginator?.length\" [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                </mat-paginator>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>";
    /***/
  },

  /***/
  "./src/app/modules/candidatemanagement/candidatemanagement-routing.module.ts":
  /*!***********************************************************************************!*\
    !*** ./src/app/modules/candidatemanagement/candidatemanagement-routing.module.ts ***!
    \***********************************************************************************/

  /*! exports provided: CandidatemanagementRoutingModule */

  /***/
  function srcAppModulesCandidatemanagementCandidatemanagementRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "CandidatemanagementRoutingModule", function () {
      return CandidatemanagementRoutingModule;
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


    var _learnerslist_learnerslist_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./learnerslist/learnerslist.component */
    "./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.ts");
    /* harmony import */


    var _app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @app/auth/auth.guard */
    "./src/app/auth/auth.guard.ts");
    /* harmony import */


    var _learner_register_learner_register_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./learner-register/learner-register.component */
    "./src/app/modules/candidatemanagement/learner-register/learner-register.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'learnerlist',
        component: _learnerslist_learnerslist_component__WEBPACK_IMPORTED_MODULE_3__["LearnerslistComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_4__["AuthGuard"]],
        data: {
          title: 'View Learners',
          breadcrumb: 'View Learners',
          urls: [{
            title: 'View Learners',
            url: '/candidatemanagement/learnerlist'
          }]
        }
      }, // {
      //   path: 'learnerlist/:batch', component: LearnerslistComponent, canActivate: [AuthGuard],
      //   data: {
      //     title: 'View Learners',
      //     urls: [
      //       { title: 'View Learners', url: '/candidatemanagement/learnerlist' },
      //     ]
      //   }
      // },
      {
        path: 'viewlearner/:batch',
        component: _learnerslist_learnerslist_component__WEBPACK_IMPORTED_MODULE_3__["LearnerslistComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_4__["AuthGuard"]],
        data: {
          title: 'View Learners',
          urls: [{
            title: 'Batch Management',
            url: '/batchindex/batchgridlisting'
          }, {
            title: 'View Learners',
            url: '/candidatemanagement/viewlearner/:batch'
          }]
        }
      }, {
        path: 'learner-register/:batch',
        component: _learner_register_learner_register_component__WEBPACK_IMPORTED_MODULE_5__["LearnerRegisterComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_4__["AuthGuard"]],
        data: {
          title: 'Learner Registration',
          urls: [{
            title: 'Learner Registration',
            url: '/candidatemanagement/learner-register/:batch'
          }]
        }
      }, {
        path: 'learner-detail/:id',
        component: _learner_register_learner_register_component__WEBPACK_IMPORTED_MODULE_5__["LearnerRegisterComponent"],
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_4__["AuthGuard"]],
        data: {
          title: 'Learners Detail',
          breadcrumb: 'Learners Detail'
        }
      }],
      data: {
        title: 'Batch Management',
        breadcrumb: 'Batch Management'
      }
    }];

    var CandidatemanagementRoutingModule = /*#__PURE__*/_createClass(function CandidatemanagementRoutingModule() {
      _classCallCheck(this, CandidatemanagementRoutingModule);
    });

    CandidatemanagementRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [],
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], CandidatemanagementRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/candidatemanagement/candidatemanagement.module.ts":
  /*!***************************************************************************!*\
    !*** ./src/app/modules/candidatemanagement/candidatemanagement.module.ts ***!
    \***************************************************************************/

  /*! exports provided: createTranslateLoader, CandidatemanagementModule */

  /***/
  function srcAppModulesCandidatemanagementCandidatemanagementModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function () {
      return createTranslateLoader;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "CandidatemanagementModule", function () {
      return CandidatemanagementModule;
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


    var _app_shared__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var _candidatemanagement_routing_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./candidatemanagement-routing.module */
    "./src/app/modules/candidatemanagement/candidatemanagement-routing.module.ts");
    /* harmony import */


    var _learnerslist_learnerslist_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! ./learnerslist/learnerslist.component */
    "./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.ts");
    /* harmony import */


    var _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/sort */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
    /* harmony import */


    var _learner_register_learner_register_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! ./learner-register/learner-register.component */
    "./src/app/modules/candidatemanagement/learner-register/learner-register.component.ts");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @ngx-translate/http-loader */
    "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @angular/material/datepicker */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/datepicker.js"); //import { MatFileUploadModule } from 'angular-material-fileupload';


    function createTranslateLoader(http) {
      return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_9__["TranslateHttpLoader"](http, './assets/i18n/candidatemanagement/', '.json');
    }

    var CandidatemanagementModule = /*#__PURE__*/_createClass(function CandidatemanagementModule() {
      _classCallCheck(this, CandidatemanagementModule);
    });

    CandidatemanagementModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_learnerslist_learnerslist_component__WEBPACK_IMPORTED_MODULE_5__["DialogBox"], _learnerslist_learnerslist_component__WEBPACK_IMPORTED_MODULE_5__["LearnerslistComponent"], _learner_register_learner_register_component__WEBPACK_IMPORTED_MODULE_7__["LearnerRegisterComponent"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _app_shared__WEBPACK_IMPORTED_MODULE_3__["SharedModule"], _candidatemanagement_routing_module__WEBPACK_IMPORTED_MODULE_4__["CandidatemanagementRoutingModule"], _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__["MatSortModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_8__["ReactiveFormsModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormsModule"], _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_12__["MatDatepickerModule"], //MatFileUploadModule,
      _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__["TranslateModule"].forChild({
        loader: {
          provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_11__["TranslateLoader"],
          useFactory: createTranslateLoader,
          deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_10__["HttpClient"]]
        }
      })]
    })], CandidatemanagementModule);
    /***/
  },

  /***/
  "./src/app/modules/candidatemanagement/learner-register/learner-register.component.scss":
  /*!**********************************************************************************************!*\
    !*** ./src/app/modules/candidatemanagement/learner-register/learner-register.component.scss ***!
    \**********************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesCandidatemanagementLearnerRegisterLearnerRegisterComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".clear-btn {\n  width: 110px;\n  height: 45px;\n  background: #FFFFFF 0% 0% no-repeat padding-box;\n  border: 1px solid #C4C4C4;\n  border-radius: 2px;\n}\n\n.add-btn {\n  width: 110px;\n  height: 45px;\n  color: #fff;\n  background: #ED1C27 0% 0% no-repeat padding-box;\n  border-radius: 2px;\n  border: none;\n}\n\n.filter-btn {\n  width: 118px;\n  height: 45px;\n  color: #fff;\n  border: none;\n  background: #0C4B9A 0% 0% no-repeat padding-box;\n  border-radius: 2px;\n}\n\n#coursesinfo .color-default {\n  color: #262626;\n}\n\n#coursesinfo .titleinfolink {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n}\n\n#coursesinfo .titleinfolink .viewalllink {\n  font-size: 13px;\n  color: #666;\n  cursor: pointer;\n}\n\n#coursesinfo .titleinfolink .viewalllink:hover {\n  color: #333;\n}\n\n#coursesinfo .buttonalign {\n  text-align: right;\n}\n\n#coursesinfo .text-right {\n  text-align: right;\n}\n\n#coursesinfo .paginator-add-filter .mat-paginator-range-actions .mat-focus-indicator {\n  display: none;\n}\n\n#coursesinfo .paginator-add-filter .top-pagination .mat-paginator-range-actions {\n  display: flex;\n}\n\n#coursesinfo .paginator-add-filter .top-pagination .mat-paginator-range-actions .mat-focus-indicator {\n  display: none;\n}\n\n#coursesinfo .paginator-add-filter .mat-figure {\n  margin: 0;\n  justify-content: flex-start;\n}\n\n#coursesinfo .paginator-add-filter .add-filter-button {\n  justify-content: end !important;\n}\n\n#coursesinfo .paginator-add-filter .add-filter-button > figure {\n  justify-content: end;\n}\n\n#coursesinfo .mat-sort-header-container {\n  justify-content: center;\n}\n\n#coursesinfo .coursesinfotbale {\n  display: block;\n  overflow-x: auto;\n}\n\n#coursesinfo .coursesinfotbale .mat-courseinfo {\n  width: 100%;\n  border-collapse: collapse;\n  border: 1px solid #ddd;\n  justify-content: center;\n  overflow-x: auto;\n}\n\n#coursesinfo .coursesinfotbale .mat-courseinfo .mat-header-cell:nth-row(2) {\n  background-color: #f8f8f8 !important;\n}\n\n#coursesinfo .coursesinfotbale .mat-courseinfo #searchrow .mat-header-cell {\n  font-size: 15px;\n}\n\n#coursesinfo .coursesinfotbale .mat-courseinfo #search.mat-header-cell {\n  padding-top: 10px;\n}\n\n#coursesinfo .coursesinfotbale .mat-courseinfo .mat-header-cell,\n#coursesinfo .coursesinfotbale .mat-courseinfo .mat-cell {\n  text-align: center;\n  justify-content: center;\n  box-sizing: border-box;\n}\n\n#coursesinfo .coursesinfotbale .mat-courseinfo .mat-form-field-outline {\n  background: #fff !important;\n}\n\n#coursesinfo .coursesinfotbale .date_box > div > div > div {\n  display: flex;\n  height: 55px;\n}\n\n#coursesinfo .coursesinfotbale .date_img > button {\n  position: relative;\n  bottom: 14px;\n}\n\n#coursesinfo .single-row {\n  margin-left: 8px;\n}\n\n#coursesinfo {\n  display: flex;\n  flex-direction: column;\n  color: #848484;\n  font-size: 14px;\n  font-weight: 400;\n  font-style: normal;\n  letter-spacing: normal;\n  line-height: 22px;\n  text-align: left;\n  margin: 0%;\n  font-style: normal;\n  letter-spacing: normal;\n}\n\n#coursesinfo .batchheader {\n  width: 100%;\n}\n\n#coursesinfo .batchdetails {\n  width: 100%;\n  display: flex;\n  border: 1px solid lightgray;\n  padding: 10px;\n}\n\n#coursesinfo .license {\n  width: 90%;\n  display: flex;\n  padding-left: 20px;\n}\n\n#coursesinfo .batchdetails1 {\n  display: flex;\n  width: 100%;\n  padding: 0 10px;\n  border: 1px solid lightgray;\n}\n\n#coursesinfo .batchdetails2 {\n  width: 100%;\n  display: flex;\n  align-items: center;\n}\n\n#coursesinfo .batchdetails .bor {\n  padding: 0px 10px;\n  padding-top: 2px;\n  border: 1px solid lightgray;\n  margin: 10px 5px;\n}\n\n#coursesinfo .mdc-text-field {\n  will-change: unset;\n}\n\n#coursesinfo table {\n  width: 100%;\n}\n\n#coursesinfo .mat-paginator {\n  width: 100%;\n}\n\n#coursesinfo .mat-paginator-container {\n  justify-content: start;\n}\n\n#coursesinfo th.mat-sort-header-sorted {\n  color: black;\n}\n\n#coursesinfo .batchdetails .bor {\n  padding: 0px 10px;\n  border: 1px solid lightgray;\n  margin: 5px 5px;\n}\n\n#coursesinfo .mat-paginator-range-label {\n  margin: 0;\n}\n\n#coursesinfo .batchdetails p {\n  padding: 0px 8px;\n  margin: 2px 0;\n}\n\n#coursesinfo .batchdetails span {\n  color: #262626;\n}\n\n#coursesinfo .batchdetails span .add {\n  color: #FFF;\n  background-color: #f52d00;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background {\n  background-color: #f3f4f6;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-input-element {\n  color: #262626;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n  background-color: #fff;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 0px 0 0 0px;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 0px 0px 0;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .mat-checkbox-checked.mat-accent .mat-checkbox-background {\n  background-color: #ED1C27 !important;\n}\n\n#coursesinfo .batchdetails.flex-column.education-background .read_only input[readonly] {\n  cursor: no-drop;\n}\n\n#coursesinfo .clflex {\n  display: flex;\n}\n\n#coursesinfo .rwidth {\n  width: 100%;\n}\n\n#coursesinfo .swidth {\n  width: 100%;\n  gap: 1.5rem;\n  padding-bottom: 8px;\n}\n\n#coursesinfo .mat-form-field-infix {\n  width: -moz-fit-content;\n  width: fit-content;\n}\n\n#coursesinfo .fbutton {\n  width: 100%;\n  display: flex;\n  justify-content: end;\n  gap: 10px;\n}\n\n#coursesinfo .fbutton .clear-btn {\n  width: 110px;\n  height: 45px;\n  background: #FFFFFF 0% 0% no-repeat padding-box;\n  border: 1px solid #C4C4C4;\n  border-radius: 2px;\n}\n\n#coursesinfo .fbutton .add-btn {\n  width: 110px;\n  height: 45px;\n  color: #fff;\n  background: #ED1C27 0% 0% no-repeat padding-box;\n  border-radius: 2px;\n  border: none;\n}\n\n#coursesinfo .table_wid {\n  width: 50%;\n}\n\n#coursesinfo .table_wid_new {\n  width: 30% !important;\n}\n\n#coursesinfo .check_table_box {\n  width: 18%;\n  display: flex;\n  align-items: center;\n}\n\n#coursesinfo .check_table_box .mat-checkbox-frame {\n  border-color: #0c4b9a !important;\n}\n\n#coursesinfo .date_box > div > div > div {\n  display: flex;\n  height: 55px;\n}\n\n#coursesinfo .date_img > button {\n  position: relative;\n  bottom: 14px;\n}\n\n#coursesinfo .batchdetails1innerdiv {\n  padding: 10px 20px 10px 10px;\n}\n\n#coursesinfo .batchdetails1innerdiv p {\n  margin: 0px;\n}\n\n#coursesinfo .fontblack {\n  color: #262626;\n}\n\n#coursesinfo .colgreen {\n  color: #00a551 !important;\n}\n\n#coursesinfo .colorange {\n  color: #f4811f !important;\n}\n\n#coursesinfo .colred,\n#coursesinfo .mat-sort-header-arrow {\n  color: #ed1c27 !important;\n}\n\n#coursesinfo .colpurple {\n  color: #d160d9;\n}\n\n#coursesinfo .batchIcon {\n  height: 10px;\n}\n\n#coursesinfo .leanertable1 {\n  width: 80%;\n  justify-content: space-between;\n}\n\n#coursesinfo .tablemenu button.mat-menu-item {\n  color: #FFF !important;\n}\n\n#coursesinfo .leanertable .leanertable1 .mat-flat-button .mat-button-wrapper i.fa {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #fff;\n}\n\n#coursesinfo .toppage {\n  align-items: center;\n}\n\n#coursesinfo .toppage .mat-paginator-container .mat-paginator-range-actions .mat-icon-button.mat-paginator-navigation-previous,\n#coursesinfo .toppage .mat-paginator-container .mat-paginator-range-actions .mat-paginator-navigation-next {\n  display: none !important;\n}\n\n#coursesinfo .footerpaginator .mat-paginator-container {\n  justify-content: flex-start;\n}\n\n#coursesinfo .mt-1 {\n  margin-top: 1em;\n}\n\n#coursesinfo .mat-header-cell {\n  color: #262626;\n  margin: 0px 10px;\n  font-size: 14px;\n}\n\n#coursesinfo .date-row {\n  min-width: 263px;\n}\n\n#coursesinfo .serachrow.mat-header-cell {\n  margin: 0px 10px;\n}\n\n#coursesinfo .serachrow.mat-header-cell:first-of-type {\n  padding: 0px !important;\n}\n\n#coursesinfo .mat-header-cell.exwid,\n#coursesinfo .serachrow.mat-header-cell.exwid {\n  min-width: 170px;\n  max-width: 170px;\n}\n\n#coursesinfo .topmenu .mat-menu-panel {\n  background-color: #616161 !important;\n}\n\n#coursesinfo .topmenu .mat-menu-panel button.mat-menu-item {\n  line-height: 36px !important;\n  height: 31px !important;\n  color: #fff !important;\n}\n\n#coursesinfo #batchcontainer .example-container {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n\n#coursesinfo .mat-header-row:nth-child(1) {\n  background-color: #eaedf2;\n}\n\n#coursesinfo .mat-header-row, #coursesinfo .mat-row {\n  display: flex;\n}\n\n#coursesinfo #searchrow.mat-header-row {\n  background-color: #fff;\n}\n\n#coursesinfo #searchrow .mat-form-field-wrapper {\n  padding-bottom: 0px;\n}\n\n#coursesinfo .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: gray;\n}\n\n#coursesinfo .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n\n#coursesinfo .mat-form-field-appearance-legacy .mat-form-field-underline {\n  height: 0px;\n}\n\n#coursesinfo .mat-icon-button + .mat-datepicker-input-container {\n  float: left;\n  margin-top: 7px;\n}\n\n#coursesinfo .mat-paginator,\n#coursesinfo .mat-paginator-page-size .mat-select-trigger {\n  font-size: 14px;\n}\n\n#coursesinfo .mat-menu-item {\n  line-height: 36px;\n  height: 31px;\n  color: #fff;\n}\n\n#coursesinfo .mat-menu-content {\n  background: #616161 !important;\n}\n\n#coursesinfo .single-row {\n  display: flex;\n  align-items: flex-start;\n}\n\n#coursesinfo .border-dashed {\n  border: 3px dotted black;\n}\n\n#coursesinfo .pb-0,\n#coursesinfo .pb-0 .mat-form-field-wrapper {\n  padding-bottom: 0px !important;\n}\n\n#coursesinfo .mr-1 {\n  margin-right: 1em;\n}\n\n#coursesinfo .close-btn {\n  border: none;\n  padding: 0px;\n  font-size: x-small;\n  position: relative;\n  bottom: 2em;\n  left: 3em;\n  z-index: 1;\n}\n\n#coursesinfo .position-relative {\n  position: relative;\n}\n\n#coursesinfo .mr-2 {\n  margin-right: 2em;\n}\n\n#coursesinfo .mb-2 {\n  margin-bottom: 2em;\n}\n\n#coursesinfo .content {\n  width: 100%;\n  float: left;\n  display: block;\n}\n\n#coursesinfo .col-12 {\n  width: 100%;\n}\n\n#coursesinfo .col-6 {\n  width: 50%;\n}\n\n#coursesinfo .col-5 {\n  width: 20%;\n}\n\n#coursesinfo .col-4 {\n  width: 25%;\n}\n\n#coursesinfo .col-3 {\n  width: 33.33%;\n}\n\n#coursesinfo .col-2 {\n  width: 20%;\n}\n\n#coursesinfo .col-1 {\n  width: 100%;\n}\n\n#coursesinfo .text-danger {\n  color: red;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n\n#coursesinfo .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n\n#coursesinfo .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n\n#coursesinfo .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n\n#coursesinfo .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#coursesinfo .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#coursesinfo .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n\n#coursesinfo .mat-form-field-infix {\n  padding: 10px 0 !important;\n  border-top: 0.5em solid transparent;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-input-element {\n  color: #262626;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 0px 0 0 0px;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 0px 0px 0;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .mat-checkbox-checked.mat-accent .mat-checkbox-background {\n  background-color: #ED1C27 !important;\n}\n\n#coursesinfo .batchdetails2 .clflex.swidth .read_only input[readonly] {\n  cursor: no-drop;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9jYW5kaWRhdGVtYW5hZ2VtZW50L2xlYXJuZXItcmVnaXN0ZXIvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcY2FuZGlkYXRlbWFuYWdlbWVudFxcbGVhcm5lci1yZWdpc3RlclxcbGVhcm5lci1yZWdpc3Rlci5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9jYW5kaWRhdGVtYW5hZ2VtZW50L2xlYXJuZXItcmVnaXN0ZXIvbGVhcm5lci1yZWdpc3Rlci5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtFQUNJLFlBQUE7RUFDQSxZQUFBO0VBQ0EsK0NBQUE7RUFDQSx5QkFBQTtFQUNBLGtCQUFBO0FDQ0o7O0FEQ0E7RUFDSSxZQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSwrQ0FBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtBQ0VKOztBREFBO0VBQ0ksWUFBQTtFQUNKLFlBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLCtDQUFBO0VBQ0Esa0JBQUE7QUNHQTs7QURBSTtFQUNJLGNBQUE7QUNHUjs7QURESTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLDhCQUFBO0FDR1I7O0FERFE7RUFDSSxlQUFBO0VBQ0EsV0FBQTtFQUNBLGVBQUE7QUNHWjs7QUREWTtFQUNJLFdBQUE7QUNHaEI7O0FERUk7RUFDSSxpQkFBQTtBQ0FSOztBREVJO0VBRUksaUJBQUE7QUNEUjs7QURLUTtFQUVJLGFBQUE7QUNKWjs7QURRWTtFQUVJLGFBQUE7QUNQaEI7O0FEU1k7RUFDSSxhQUFBO0FDUGhCOztBRFVRO0VBQ0ksU0FBQTtFQUNBLDJCQUFBO0FDUlo7O0FEV1E7RUFDSSwrQkFBQTtBQ1RaOztBRFdRO0VBQ0ksb0JBQUE7QUNUWjs7QURhSTtFQUNJLHVCQUFBO0FDWFI7O0FEY0k7RUFDSSxjQUFBO0VBQ0EsZ0JBQUE7QUNaUjs7QURlUTtFQUNJLFdBQUE7RUFDQSx5QkFBQTtFQUNBLHNCQUFBO0VBQ0EsdUJBQUE7RUFDQSxnQkFBQTtBQ2JaOztBRGVZO0VBQ0ksb0NBQUE7QUNiaEI7O0FEaUJnQjtFQUNJLGVBQUE7QUNmcEI7O0FEbUJZO0VBQ0ksaUJBQUE7QUNqQmhCOztBRG9CWTs7RUFFSSxrQkFBQTtFQUNBLHVCQUFBO0VBQ0Esc0JBQUE7QUNsQmhCOztBRHFCWTtFQUNJLDJCQUFBO0FDbkJoQjs7QUR3QlE7RUFDSSxhQUFBO0VBQ0EsWUFBQTtBQ3RCWjs7QUR5QlE7RUFDSSxrQkFBQTtFQUNBLFlBQUE7QUN2Qlo7O0FENkJJO0VBQ0ksZ0JBQUE7QUMzQlI7O0FEaUNBO0VBQ0ksYUFBQTtFQUNBLHNCQUFBO0VBQ0EsY0FBQTtFQUNBLGVBQUE7RUFDQSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0Esc0JBQUE7RUFDQSxpQkFBQTtFQUNBLGdCQUFBO0VBQ0EsVUFBQTtFQUNBLGtCQUFBO0VBQ0Esc0JBQUE7QUM5Qko7O0FEb0NJO0VBQ0ksV0FBQTtBQ2xDUjs7QURxQ0k7RUFDSSxXQUFBO0VBQ0EsYUFBQTtFQUNBLDJCQUFBO0VBQ0EsYUFBQTtBQ25DUjs7QURzQ0k7RUFDSSxVQUFBO0VBQ0EsYUFBQTtFQUNBLGtCQUFBO0FDcENSOztBRHVDSTtFQUNJLGFBQUE7RUFDQSxXQUFBO0VBQ0EsZUFBQTtFQUNBLDJCQUFBO0FDckNSOztBRHlDSTtFQUNJLFdBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUN2Q1I7O0FENENJO0VBQ0ksaUJBQUE7RUFDQSxnQkFBQTtFQUNBLDJCQUFBO0VBQ0EsZ0JBQUE7QUMxQ1I7O0FENkNJO0VBQ0ksa0JBQUE7QUMzQ1I7O0FEOENJO0VBQ0ksV0FBQTtBQzVDUjs7QUQ4Q0k7RUFDSSxXQUFBO0FDNUNSOztBRDhDSTtFQUNJLHNCQUFBO0FDNUNSOztBRDhDSTtFQUNJLFlBQUE7QUM1Q1I7O0FEK0NJO0VBQ0ksaUJBQUE7RUFDQSwyQkFBQTtFQUNBLGVBQUE7QUM3Q1I7O0FEK0NJO0VBQ0ksU0FBQTtBQzdDUjs7QUQrQ0k7RUFDSSxnQkFBQTtFQUNBLGFBQUE7QUM3Q1I7O0FEZ0RJO0VBQ0ksY0FBQTtBQzlDUjs7QURpREk7RUFDSSxXQUFBO0VBQ0EseUJBQUE7QUMvQ1I7O0FEaURJO0VBQ0kseUJBQUE7QUMvQ1I7O0FEZ0RRO0VBQ0ksY0FBQTtBQzlDWjs7QURrRFk7RUFDRSxjQUFBO0VBQ0Esc0JBQUE7QUNoRGQ7O0FEbURZO0VBQ0UsMEJBQUE7QUNqRGQ7O0FEb0RZO0VBQ0UsMEJBQUE7QUNsRGQ7O0FEcURZO0VBQ0UsY0FBQTtBQ25EZDs7QURzRFk7RUFDRSxjQUFBO0VBQ0EseUJBQUE7QUNwRGQ7O0FEd0RjO0VBQ0UsY0FBQTtFQUNBLHlCQUFBO0FDdERoQjs7QUQyRGtCO0VBQ0UsY0FBQTtBQ3pEcEI7O0FEZ0VjO0VBQ0UseUJBQUE7QUM5RGhCOztBRG9FYztFQUNFLGNBQUE7RUFDQSx5QkFBQTtBQ2xFaEI7O0FEd0VnQjtFQUNFLDBDQUFBO0VBQ0EsY0FBQTtBQ3RFbEI7O0FEd0VrQjtFQUNFLGNBQUE7QUN0RXBCOztBRDBFZ0I7RUFDRSxxQkFBQTtBQ3hFbEI7O0FEZ0ZjO0VBQ0Usb0NBQUE7QUM5RWhCOztBRG9GWTtFQUNFLGVBQUE7QUNsRmQ7O0FEdUZJO0VBQ0ksYUFBQTtBQ3JGUjs7QUR3Rkk7RUFDSSxXQUFBO0FDdEZSOztBRHlGSTtFQUNJLFdBQUE7RUFDQSxXQUFBO0VBQ0EsbUJBQUE7QUN2RlI7O0FEMEZJO0VBQ0ksdUJBQUE7RUFBQSxrQkFBQTtBQ3hGUjs7QUQyRkk7RUFDSSxXQUFBO0VBQ0EsYUFBQTtFQUNBLG9CQUFBO0VBQ0EsU0FBQTtBQ3pGUjs7QUQwRlE7RUFDSSxZQUFBO0VBQ0EsWUFBQTtFQUNBLCtDQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtBQ3hGWjs7QUQwRlE7RUFDSSxZQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSwrQ0FBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtBQ3hGWjs7QUQ0Rkk7RUFDSSxVQUFBO0FDMUZSOztBRCtGSTtFQUNJLHFCQUFBO0FDN0ZSOztBRGdHSTtFQUNJLFVBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUM5RlI7O0FEK0ZRO0VBQ0ksZ0NBQUE7QUM3Rlo7O0FEaUdJO0VBQ0ksYUFBQTtFQUNBLFlBQUE7QUMvRlI7O0FEa0dJO0VBQ0ksa0JBQUE7RUFDQSxZQUFBO0FDaEdSOztBRG1HSTtFQUNJLDRCQUFBO0FDakdSOztBRG9HSTtFQUNJLFdBQUE7QUNsR1I7O0FEcUdJO0VBQ0ksY0FBQTtBQ25HUjs7QURzR0k7RUFDSSx5QkFBQTtBQ3BHUjs7QUR1R0k7RUFDSSx5QkFBQTtBQ3JHUjs7QUR3R0k7O0VBRUkseUJBQUE7QUN0R1I7O0FEeUdJO0VBQ0ksY0FBQTtBQ3ZHUjs7QUQwR0k7RUFDSSxZQUFBO0FDeEdSOztBRDJHSTtFQUNJLFVBQUE7RUFDQSw4QkFBQTtBQ3pHUjs7QUQ0R0k7RUFDSSxzQkFBQTtBQzFHUjs7QUQ2R0k7RUFDSSxrQkFBQTtFQUNBLDhCQUFBO0VBQ0EsK0JBQUE7QUMzR1I7O0FEbUhJO0VBQ0ksbUJBQUE7QUNqSFI7O0FEc0hnQjs7RUFFSSx3QkFBQTtBQ3BIcEI7O0FEMkhRO0VBQ0ksMkJBQUE7QUN6SFo7O0FEOEhJO0VBQ0ksZUFBQTtBQzVIUjs7QUQrSEk7RUFDSSxjQUFBO0VBQ0EsZ0JBQUE7RUFDQSxlQUFBO0FDN0hSOztBRGdJSTtFQUNJLGdCQUFBO0FDOUhSOztBRGlJSTtFQUNJLGdCQUFBO0FDL0hSOztBRG1JSTtFQUNJLHVCQUFBO0FDaklSOztBRG9JSTs7RUFFSSxnQkFBQTtFQUNBLGdCQUFBO0FDbElSOztBRHNJUTtFQUNJLG9DQUFBO0FDcElaOztBRHNJWTtFQUNJLDRCQUFBO0VBQ0EsdUJBQUE7RUFDQSxzQkFBQTtBQ3BJaEI7O0FEOElJO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQzVJUjs7QUQrSUk7RUFDSSx5QkFBQTtBQzdJUjs7QURpSkk7RUFDSSxhQUFBO0FDL0lSOztBRGtKSTtFQUNJLHNCQUFBO0FDaEpSOztBRG1KSTtFQUNJLG1CQUFBO0FDakpSOztBRHVKWTtFQUNJLHlCQUFBO0VBQ0EsV0FBQTtBQ3JKaEI7O0FEdUpnQjtFQUNJLHlCQUFBO0FDckpwQjs7QUQ0Skk7RUFDSSxXQUFBO0FDMUpSOztBRGlLSTtFQUNJLFdBQUE7RUFDQSxlQUFBO0FDL0pSOztBRGtLSTs7RUFFSSxlQUFBO0FDaEtSOztBRG9LSTtFQUNJLGlCQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7QUNsS1I7O0FEcUtJO0VBQ0ksOEJBQUE7QUNuS1I7O0FEc0tJO0VBRUksYUFBQTtFQUNBLHVCQUFBO0FDcktSOztBRHdLSTtFQUNJLHdCQUFBO0FDdEtSOztBRHlLSTs7RUFFSSw4QkFBQTtBQ3ZLUjs7QUQwS0k7RUFDSSxpQkFBQTtBQ3hLUjs7QUQyS0k7RUFDSSxZQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0Esa0JBQUE7RUFDQSxXQUFBO0VBQ0EsU0FBQTtFQUNBLFVBQUE7QUN6S1I7O0FENEtJO0VBQ0ksa0JBQUE7QUMxS1I7O0FENktJO0VBQ0ksaUJBQUE7QUMzS1I7O0FEOEtJO0VBQ0ksa0JBQUE7QUM1S1I7O0FEK0tJO0VBQ0ksV0FBQTtFQUNBLFdBQUE7RUFDQSxjQUFBO0FDN0tSOztBRGdMSTtFQUNJLFdBQUE7QUM5S1I7O0FEaUxJO0VBQ0ksVUFBQTtBQy9LUjs7QURrTEk7RUFDSSxVQUFBO0FDaExSOztBRG1MSTtFQUNJLFVBQUE7QUNqTFI7O0FEb0xJO0VBQ0ksYUFBQTtBQ2xMUjs7QURxTEk7RUFDSSxVQUFBO0FDbkxSOztBRHNMSTtFQUNJLFdBQUE7QUNwTFI7O0FEdUxJO0VBQ0ksVUFBQTtBQ3JMUjs7QUQyTFE7RUFFSSxvQ0FBQTtBQzFMWjs7QUQrTFE7RUFDSSxjQUFBO0FDN0xaOztBRGdNUTtFQUNJLDBCQUFBO0FDOUxaOztBRGlNUTtFQUNJLDBCQUFBO0FDL0xaOztBRGtNUTtFQUNJLGNBQUE7QUNoTVo7O0FEbU1RO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDak1aOztBRHNNWTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ3BNaEI7O0FEME1vQjtFQUNJLGNBQUE7QUN4TXhCOztBRCtNWTtFQUNJLHlCQUFBO0FDN01oQjs7QURtTlk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNqTmhCOztBRHVOZ0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUNyTnBCOztBRHVOb0I7RUFDSSxjQUFBO0FDck54Qjs7QUQwTmdCO0VBQ0kscUJBQUE7QUN4TnBCOztBRDhOSTtFQUNJLDBCQUFBO0VBQ0EsbUNBQUE7QUM1TlI7O0FEaU9ZO0VBQ0ksY0FBQTtBQy9OaEI7O0FEbU9nQjtFQUNFLGNBQUE7QUNqT2xCOztBRG9PZ0I7RUFDRSwwQkFBQTtBQ2xPbEI7O0FEcU9nQjtFQUNFLDBCQUFBO0FDbk9sQjs7QURzT2dCO0VBQ0UsY0FBQTtBQ3BPbEI7O0FEdU9nQjtFQUNFLGNBQUE7RUFDQSx5QkFBQTtBQ3JPbEI7O0FEeU9rQjtFQUNFLGNBQUE7RUFDQSx5QkFBQTtBQ3ZPcEI7O0FENE9zQjtFQUNFLGNBQUE7QUMxT3hCOztBRGlQa0I7RUFDRSx5QkFBQTtBQy9PcEI7O0FEcVBrQjtFQUNFLGNBQUE7RUFDQSx5QkFBQTtBQ25QcEI7O0FEeVBvQjtFQUNFLDBDQUFBO0VBQ0EsY0FBQTtBQ3ZQdEI7O0FEeVBzQjtFQUNFLGNBQUE7QUN2UHhCOztBRDJQb0I7RUFDRSxxQkFBQTtBQ3pQdEI7O0FEaVFrQjtFQUNFLG9DQUFBO0FDL1BwQjs7QURxUWdCO0VBQ0UsZUFBQTtBQ25RbEIiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL2NhbmRpZGF0ZW1hbmFnZW1lbnQvbGVhcm5lci1yZWdpc3Rlci9sZWFybmVyLXJlZ2lzdGVyLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLmNsZWFyLWJ0bntcclxuICAgIHdpZHRoOiAxMTBweDtcclxuICAgIGhlaWdodDogNDVweDtcclxuICAgIGJhY2tncm91bmQ6ICNGRkZGRkYgMCUgMCUgbm8tcmVwZWF0IHBhZGRpbmctYm94O1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI0M0QzRDNDtcclxuICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxufVxyXG4uYWRkLWJ0bntcclxuICAgIHdpZHRoOiAxMTBweDtcclxuICAgIGhlaWdodDogNDVweDtcclxuICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgYmFja2dyb3VuZDogI0VEMUMyNyAwJSAwJSBuby1yZXBlYXQgcGFkZGluZy1ib3g7XHJcbiAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICBib3JkZXI6IG5vbmU7XHJcbn1cclxuLmZpbHRlci1idG57XHJcbiAgICB3aWR0aDogMTE4cHg7XHJcbmhlaWdodDogNDVweDtcclxuY29sb3I6ICNmZmY7XHJcbmJvcmRlcjogbm9uZTtcclxuYmFja2dyb3VuZDogIzBDNEI5QSAwJSAwJSBuby1yZXBlYXQgcGFkZGluZy1ib3g7XHJcbmJvcmRlci1yYWRpdXM6IDJweDtcclxufVxyXG4jY291cnNlc2luZm8ge1xyXG4gICAgLmNvbG9yLWRlZmF1bHR7XHJcbiAgICAgICAgY29sb3I6IzI2MjYyNlxyXG4gICAgfVxyXG4gICAgLnRpdGxlaW5mb2xpbmsge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcblxyXG4gICAgICAgIC52aWV3YWxsbGluayB7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTNweDtcclxuICAgICAgICAgICAgY29sb3I6ICM2NjY7XHJcbiAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuXHJcbiAgICAgICAgICAgICY6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmJ1dHRvbmFsaWduIHtcclxuICAgICAgICB0ZXh0LWFsaWduOiByaWdodDtcclxuICAgIH1cclxuICAgIC50ZXh0LXJpZ2h0XHJcbiAgICB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogcmlnaHQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnBhZ2luYXRvci1hZGQtZmlsdGVyIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtZm9jdXMtaW5kaWNhdG9yXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgIH1cclxuICAgICAgICAudG9wLXBhZ2luYXRpb25cclxuICAgICAgICB7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnNcclxuICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtZm9jdXMtaW5kaWNhdG9ye1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAubWF0LWZpZ3VyZSB7XHJcbiAgICAgICAgICAgIG1hcmdpbjogMDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmFkZC1maWx0ZXItYnV0dG9uIHtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBlbmQgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmFkZC1maWx0ZXItYnV0dG9uPmZpZ3VyZXtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBlbmQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtc29ydC1oZWFkZXItY29udGFpbmVyIHtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAuY291cnNlc2luZm90YmFsZSB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuXHJcbiAgICAgICBcclxuICAgICAgICAubWF0LWNvdXJzZWluZm8ge1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgYm9yZGVyLWNvbGxhcHNlOiBjb2xsYXBzZTtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcblxyXG4gICAgICAgICAgICAubWF0LWhlYWRlci1jZWxsOm50aC1yb3coMikge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmOCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAjc2VhcmNocm93IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgI3NlYXJjaC5tYXQtaGVhZGVyLWNlbGx7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXRvcDogMTBweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgLm1hdC1oZWFkZXItY2VsbCxcclxuICAgICAgICAgICAgLm1hdC1jZWxsIHtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgYm94LXNpemluZzogYm9yZGVyLWJveDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBcclxuICAgICAgICB9XHJcbiAgICAgICAgLmRhdGVfYm94PmRpdj5kaXY+ZGl2IHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA1NXB4O1xyXG4gICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgIC5kYXRlX2ltZz5idXR0b24ge1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgIGJvdHRvbTogMTRweDtcclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5zaW5nbGUtcm93IHtcclxuICAgICAgICBtYXJnaW4tbGVmdDogOHB4O1xyXG4gICAgICAgIC8vIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgLy8gYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQ7XHJcbiAgICB9XHJcbn1cclxuXHJcbiNjb3Vyc2VzaW5mbyB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgZmxleC1kaXJlY3Rpb246IGNvbHVtbjtcclxuICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgZm9udC13ZWlnaHQ6IDQwMDtcclxuICAgIGZvbnQtc3R5bGU6IG5vcm1hbDtcclxuICAgIGxldHRlci1zcGFjaW5nOiBub3JtYWw7XHJcbiAgICBsaW5lLWhlaWdodDogMjJweDtcclxuICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbiAgICBtYXJnaW46IDAlO1xyXG4gICAgZm9udC1zdHlsZTogbm9ybWFsO1xyXG4gICAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcclxuXHJcbiAgICAvLyAgLnBhZ2Utd3JhcHBlciAucGVyZmVjdHNjcm9sbCB7XHJcbiAgICAvLyAgICAgaGVpZ2h0OiAwO1xyXG4gICAgLy8gfVxyXG5cclxuICAgIC5iYXRjaGhlYWRlciB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcblxyXG4gICAgLmJhdGNoZGV0YWlscyB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcbiAgICAgICAgcGFkZGluZzogMTBweDtcclxuICAgIH1cclxuXHJcbiAgICAubGljZW5zZSB7XHJcbiAgICAgICAgd2lkdGg6IDkwJTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgIH1cclxuXHJcbiAgICAuYmF0Y2hkZXRhaWxzMSB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBwYWRkaW5nOiAwIDEwcHg7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xyXG5cclxuICAgIH1cclxuXHJcbiAgICAuYmF0Y2hkZXRhaWxzMiB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIC8vIHBhZGRpbmc6IDQwcHggMCAyMHB4IDA7XHJcbiAgICAgICAgLy8gcGFkZGluZzogMCAwIDAgMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5iYXRjaGRldGFpbHMgLmJvciB7XHJcbiAgICAgICAgcGFkZGluZzogMHB4IDEwcHg7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDJweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDVweDtcclxuICAgIH1cclxuXHJcbiAgICAubWRjLXRleHQtZmllbGQge1xyXG4gICAgICAgIHdpbGwtY2hhbmdlOiB1bnNldDtcclxuICAgIH1cclxuXHJcbiAgICB0YWJsZSB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgICAubWF0LXBhZ2luYXRvcntcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgIH1cclxuICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lcntcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHN0YXJ0O1xyXG4gICAgfVxyXG4gICAgdGgubWF0LXNvcnQtaGVhZGVyLXNvcnRlZCB7XHJcbiAgICAgICAgY29sb3I6IGJsYWNrO1xyXG4gICAgfVxyXG5cclxuICAgIC5iYXRjaGRldGFpbHMgLmJvciB7XHJcbiAgICAgICAgcGFkZGluZzogMHB4IDEwcHg7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xyXG4gICAgICAgIG1hcmdpbjogNXB4IDVweDtcclxuICAgIH1cclxuICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVse1xyXG4gICAgICAgIG1hcmdpbjogMDtcclxuICAgIH1cclxuICAgIC5iYXRjaGRldGFpbHMgcCB7XHJcbiAgICAgICAgcGFkZGluZzogMHB4IDhweDtcclxuICAgICAgICBtYXJnaW46IDJweCAwO1xyXG4gICAgfVxyXG5cclxuICAgIC5iYXRjaGRldGFpbHMgc3BhbiB7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICB9XHJcblxyXG4gICAgLmJhdGNoZGV0YWlscyBzcGFuIC5hZGQge1xyXG4gICAgICAgIGNvbG9yOiAjRkZGO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6IHJnYigyNDUsIDQ1LCAwKTtcclxuICAgIH1cclxuICAgIC5iYXRjaGRldGFpbHMuZmxleC1jb2x1bW4uZWR1Y2F0aW9uLWJhY2tncm91bmR7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2YzZjRmNjtcclxuICAgICAgICAubWF0LWlucHV0LWVsZW1lbnQge1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgY29sb3I6ICNkOWQ5ZDk7XHJcbiAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XHJcbiAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMHB4IDAgMCAwcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcclxuICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAwIDBweCAwcHggMDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCB7XHJcbiAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgLm1hdC1jaGVja2JveC1jaGVja2VkIHtcclxuICAgICAgICAgICAgJi5tYXQtYWNjZW50IHtcclxuICAgICAgICAgICAgICAubWF0LWNoZWNrYm94LWJhY2tncm91bmQge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgLnJlYWRfb25seSB7XHJcbiAgICAgICAgICAgIGlucHV0W3JlYWRvbmx5XSB7XHJcbiAgICAgICAgICAgICAgY3Vyc29yOiBuby1kcm9wO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNsZmxleCB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgIH1cclxuXHJcbiAgICAucndpZHRoIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgIH1cclxuXHJcbiAgICAuc3dpZHRoIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBnYXA6IDEuNXJlbTtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogOHB4O1xyXG4gICAgICAgIFxyXG4gICAgfVxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLWluZml4e1xyXG4gICAgICAgIHdpZHRoOiBmaXQtY29udGVudDtcclxuICAgIH1cclxuXHJcbiAgICAuZmJ1dHRvbiB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGVuZDtcclxuICAgICAgICBnYXA6IDEwcHg7XHJcbiAgICAgICAgLmNsZWFyLWJ0bntcclxuICAgICAgICAgICAgd2lkdGg6IDExMHB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNGRkZGRkYgMCUgMCUgbm8tcmVwZWF0IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjQzRDNEM0O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5hZGQtYnRue1xyXG4gICAgICAgICAgICB3aWR0aDogMTEwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNFRDFDMjcgMCUgMCUgbm8tcmVwZWF0IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgICAgIGJvcmRlcjogbm9uZTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnRhYmxlX3dpZCB7XHJcbiAgICAgICAgd2lkdGg6IDUwJTtcclxuICAgICAgICAvLyBtaW4td2lkdGg6IDU1MHB4O1xyXG4gICAgICAgIC8vIG1heC13aWR0aDogNTUwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnRhYmxlX3dpZF9uZXcge1xyXG4gICAgICAgIHdpZHRoOiAzMCUgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuY2hlY2tfdGFibGVfYm94IHtcclxuICAgICAgICB3aWR0aDogMTglO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAubWF0LWNoZWNrYm94LWZyYW1le1xyXG4gICAgICAgICAgICBib3JkZXItY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmRhdGVfYm94PmRpdj5kaXY+ZGl2IHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGhlaWdodDogNTVweDtcclxuICAgIH1cclxuXHJcbiAgICAuZGF0ZV9pbWc+YnV0dG9uIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgYm90dG9tOiAxNHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5iYXRjaGRldGFpbHMxaW5uZXJkaXYge1xyXG4gICAgICAgIHBhZGRpbmc6IDEwcHggMjBweCAxMHB4IDEwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmJhdGNoZGV0YWlsczFpbm5lcmRpdiBwIHtcclxuICAgICAgICBtYXJnaW46IDBweDtcclxuICAgIH1cclxuXHJcbiAgICAuZm9udGJsYWNrIHtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgIH1cclxuXHJcbiAgICAuY29sZ3JlZW4ge1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbG9yYW5nZSB7XHJcbiAgICAgICAgY29sb3I6ICNmNDgxMWYgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuY29scmVkLFxyXG4gICAgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XHJcbiAgICAgICAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuY29scHVycGxlIHtcclxuICAgICAgICBjb2xvcjogI2QxNjBkOTtcclxuICAgIH1cclxuXHJcbiAgICAuYmF0Y2hJY29uIHtcclxuICAgICAgICBoZWlnaHQ6IDEwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmxlYW5lcnRhYmxlMSB7XHJcbiAgICAgICAgd2lkdGg6IDgwJTtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICB9XHJcblxyXG4gICAgLnRhYmxlbWVudSBidXR0b24ubWF0LW1lbnUtaXRlbSB7XHJcbiAgICAgICAgY29sb3I6ICNGRkYgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAubGVhbmVydGFibGUgLmxlYW5lcnRhYmxlMSAubWF0LWZsYXQtYnV0dG9uIC5tYXQtYnV0dG9uLXdyYXBwZXIgaS5mYSB7XHJcbiAgICAgICAgY29sb3I6IHRyYW5zcGFyZW50O1xyXG4gICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDFweDtcclxuICAgICAgICAtd2Via2l0LXRleHQtc3Ryb2tlLWNvbG9yOiAjZmZmO1xyXG4gICAgfVxyXG5cclxuICAgIC8vICAgIC5tYXQtZmxhdC1idXR0b257XHJcbiAgICAvLyAgICAgICAgIGJhY2tncm91bmQtY29sb3I6cmdiKDIxOCwgMzksIDM5KTtcclxuICAgIC8vICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAvLyAgICAgfSBcclxuXHJcbiAgICAudG9wcGFnZSB7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1pY29uLWJ1dHRvbi5tYXQtcGFnaW5hdG9yLW5hdmlnYXRpb24tcHJldmlvdXMsXHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1uYXZpZ2F0aW9uLW5leHQge1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcblxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubXQtMXtcclxuICAgICAgICBtYXJnaW4tdG9wOiAxZW07XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1oZWFkZXItY2VsbCB7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgbWFyZ2luOiAwcHggMTBweDtcclxuICAgICAgICBmb250LXNpemU6IDE0cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmRhdGUtcm93e1xyXG4gICAgICAgIG1pbi13aWR0aDogMjYzcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnNlcmFjaHJvdy5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgIG1hcmdpbjogMHB4IDEwcHg7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5zZXJhY2hyb3cubWF0LWhlYWRlci1jZWxsOmZpcnN0LW9mLXR5cGUge1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtaGVhZGVyLWNlbGwuZXh3aWQsXHJcbiAgICAuc2VyYWNocm93Lm1hdC1oZWFkZXItY2VsbC5leHdpZCB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxNzBweDtcclxuICAgICAgICBtYXgtd2lkdGg6IDE3MHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC50b3BtZW51IHtcclxuICAgICAgICAubWF0LW1lbnUtcGFuZWwge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNjE2MTYxICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICBidXR0b24ubWF0LW1lbnUtaXRlbSB7XHJcbiAgICAgICAgICAgICAgICBsaW5lLWhlaWdodDogMzZweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAzMXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC8vIC5leGFtcGxlLWNvbnRhaW5lciB7XHJcbiAgICAvLyAgICAgd2lkdGg6IDEyMzBweDtcclxuICAgIC8vICAgICBtYXgtd2lkdGg6IDEwMCU7XHJcbiAgICAvLyAgICAgb3ZlcmZsb3c6IGF1dG87XHJcbiAgICAvLyAgIH1cclxuICAgICNiYXRjaGNvbnRhaW5lciAuZXhhbXBsZS1jb250YWluZXIge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICB6LWluZGV4OiAxO1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWhlYWRlci1yb3c6bnRoLWNoaWxkKDEpIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgIFxyXG4gICAgfVxyXG4gIFxyXG4gICAgLm1hdC1oZWFkZXItcm93LCAubWF0LXJvd3tcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgfVxyXG5cclxuICAgICNzZWFyY2hyb3cubWF0LWhlYWRlci1yb3cge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICB9XHJcblxyXG4gICAgI3NlYXJjaHJvdyAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDBweDtcclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuXHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIHtcclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6IGdyYXk7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcclxuICAgICAgICBoZWlnaHQ6IDBweDtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQge1xyXG4gICAgICAgIC8vIHdpZHRoOiA1MCU7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1pY29uLWJ1dHRvbisubWF0LWRhdGVwaWNrZXItaW5wdXQtY29udGFpbmVyIHtcclxuICAgICAgICBmbG9hdDogbGVmdDtcclxuICAgICAgICBtYXJnaW4tdG9wOiA3cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1wYWdpbmF0b3IsXHJcbiAgICAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUgLm1hdC1zZWxlY3QtdHJpZ2dlciB7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgfVxyXG5cclxuXHJcbiAgICAubWF0LW1lbnUtaXRlbSB7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDM2cHg7XHJcbiAgICAgICAgaGVpZ2h0OiAzMXB4O1xyXG4gICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtbWVudS1jb250ZW50IHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjNjE2MTYxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnNpbmdsZS1yb3cge1xyXG4gICAgICAgIC8vIG1hcmdpbi1sZWZ0OiA4cHg7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcclxuICAgIH1cclxuXHJcbiAgICAuYm9yZGVyLWRhc2hlZCB7XHJcbiAgICAgICAgYm9yZGVyOiAzcHggZG90dGVkIGJsYWNrO1xyXG4gICAgfVxyXG5cclxuICAgIC5wYi0wLFxyXG4gICAgLnBiLTAgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAubXItMSB7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAxZW07XHJcbiAgICB9XHJcblxyXG4gICAgLmNsb3NlLWJ0biB7XHJcbiAgICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICAgIHBhZGRpbmc6IDBweDtcclxuICAgICAgICBmb250LXNpemU6IHgtc21hbGw7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIGJvdHRvbTogMmVtO1xyXG4gICAgICAgIGxlZnQ6IDNlbTtcclxuICAgICAgICB6LWluZGV4OiAxO1xyXG4gICAgfVxyXG5cclxuICAgIC5wb3NpdGlvbi1yZWxhdGl2ZSB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgfVxyXG5cclxuICAgIC5tci0yIHtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDJlbTtcclxuICAgIH1cclxuXHJcbiAgICAubWItMiB7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTogMmVtO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb250ZW50IHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBmbG9hdDogbGVmdDtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIH1cclxuXHJcbiAgICAuY29sLTEyIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgIH1cclxuXHJcbiAgICAuY29sLTYge1xyXG4gICAgICAgIHdpZHRoOiA1MCU7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbC01IHtcclxuICAgICAgICB3aWR0aDogMjAlO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb2wtNCB7XHJcbiAgICAgICAgd2lkdGg6IDI1JTtcclxuICAgIH1cclxuXHJcbiAgICAuY29sLTMge1xyXG4gICAgICAgIHdpZHRoOiAzMy4zMyU7XHJcbiAgICB9XHJcblxyXG4gICAgLmNvbC0yIHtcclxuICAgICAgICB3aWR0aDogMjAlO1xyXG4gICAgfVxyXG5cclxuICAgIC5jb2wtMSB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcblxyXG4gICAgLnRleHQtZGFuZ2VyIHtcclxuICAgICAgICBjb2xvcjogcmVkO1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG5cclxuICAgICAgICAvLyAmLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xyXG4gICAgICAgICAgICAvLyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgLy8gfVxyXG4gICAgICAgICAgICAvLyB9XHJcbiAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBjb2xvcjogI2Q5ZDlkOTtcclxuICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xyXG4gICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNmJhNWVjO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgXHJcbiAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgXHJcbiAgICBcclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLS45cmVtKSBzY2FsZSgwLjc1KTtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgIFxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgIFxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICBcclxuICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgcGFkZGluZzogMTBweCAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYm9yZGVyLXRvcDogMC41ZW0gc29saWQgdHJhbnNwYXJlbnQ7XHJcbiAgICAgfVxyXG5cclxuICAgIC5iYXRjaGRldGFpbHMye1xyXG4gICAgICAgIC5jbGZsZXguc3dpZHRoe1xyXG4gICAgICAgICAgICAubWF0LWlucHV0LWVsZW1lbnQge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgY29sb3I6ICNkOWQ5ZDk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAwcHggMCAwIDBweDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAwIDBweCAwcHggMDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLS45cmVtKSBzY2FsZSgwLjc1KTtcclxuICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgICAubWF0LWNoZWNrYm94LWNoZWNrZWQge1xyXG4gICAgICAgICAgICAgICAgJi5tYXQtYWNjZW50IHtcclxuICAgICAgICAgICAgICAgICAgLm1hdC1jaGVja2JveC1iYWNrZ3JvdW5kIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5yZWFkX29ubHkge1xyXG4gICAgICAgICAgICAgICAgaW5wdXRbcmVhZG9ubHldIHtcclxuICAgICAgICAgICAgICAgICAgY3Vyc29yOiBuby1kcm9wO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0iLCIuY2xlYXItYnRuIHtcbiAgd2lkdGg6IDExMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJhY2tncm91bmQ6ICNGRkZGRkYgMCUgMCUgbm8tcmVwZWF0IHBhZGRpbmctYm94O1xuICBib3JkZXI6IDFweCBzb2xpZCAjQzRDNEM0O1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG5cbi5hZGQtYnRuIHtcbiAgd2lkdGg6IDExMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGNvbG9yOiAjZmZmO1xuICBiYWNrZ3JvdW5kOiAjRUQxQzI3IDAlIDAlIG5vLXJlcGVhdCBwYWRkaW5nLWJveDtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3JkZXI6IG5vbmU7XG59XG5cbi5maWx0ZXItYnRuIHtcbiAgd2lkdGg6IDExOHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXI6IG5vbmU7XG4gIGJhY2tncm91bmQ6ICMwQzRCOUEgMCUgMCUgbm8tcmVwZWF0IHBhZGRpbmctYm94O1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG5cbiNjb3Vyc2VzaW5mbyAuY29sb3ItZGVmYXVsdCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2NvdXJzZXNpbmZvIC50aXRsZWluZm9saW5rIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xufVxuI2NvdXJzZXNpbmZvIC50aXRsZWluZm9saW5rIC52aWV3YWxsbGluayB7XG4gIGZvbnQtc2l6ZTogMTNweDtcbiAgY29sb3I6ICM2NjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNjb3Vyc2VzaW5mbyAudGl0bGVpbmZvbGluayAudmlld2FsbGxpbms6aG92ZXIge1xuICBjb2xvcjogIzMzMztcbn1cbiNjb3Vyc2VzaW5mbyAuYnV0dG9uYWxpZ24ge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbiNjb3Vyc2VzaW5mbyAudGV4dC1yaWdodCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuI2NvdXJzZXNpbmZvIC5wYWdpbmF0b3ItYWRkLWZpbHRlciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtZm9jdXMtaW5kaWNhdG9yIHtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNjb3Vyc2VzaW5mbyAucGFnaW5hdG9yLWFkZC1maWx0ZXIgLnRvcC1wYWdpbmF0aW9uIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuI2NvdXJzZXNpbmZvIC5wYWdpbmF0b3ItYWRkLWZpbHRlciAudG9wLXBhZ2luYXRpb24gLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LWZvY3VzLWluZGljYXRvciB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jY291cnNlc2luZm8gLnBhZ2luYXRvci1hZGQtZmlsdGVyIC5tYXQtZmlndXJlIHtcbiAgbWFyZ2luOiAwO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG59XG4jY291cnNlc2luZm8gLnBhZ2luYXRvci1hZGQtZmlsdGVyIC5hZGQtZmlsdGVyLWJ1dHRvbiB7XG4gIGp1c3RpZnktY29udGVudDogZW5kICFpbXBvcnRhbnQ7XG59XG4jY291cnNlc2luZm8gLnBhZ2luYXRvci1hZGQtZmlsdGVyIC5hZGQtZmlsdGVyLWJ1dHRvbiA+IGZpZ3VyZSB7XG4gIGp1c3RpZnktY29udGVudDogZW5kO1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtc29ydC1oZWFkZXItY29udGFpbmVyIHtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4jY291cnNlc2luZm8gLmNvdXJzZXNpbmZvdGJhbGUge1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbn1cbiNjb3Vyc2VzaW5mbyAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8ge1xuICB3aWR0aDogMTAwJTtcbiAgYm9yZGVyLWNvbGxhcHNlOiBjb2xsYXBzZTtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIG92ZXJmbG93LXg6IGF1dG87XG59XG4jY291cnNlc2luZm8gLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvIC5tYXQtaGVhZGVyLWNlbGw6bnRoLXJvdygyKSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4ZjggIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VzaW5mbyAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gI3NlYXJjaHJvdyAubWF0LWhlYWRlci1jZWxsIHtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2NvdXJzZXNpbmZvIC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAjc2VhcmNoLm1hdC1oZWFkZXItY2VsbCB7XG4gIHBhZGRpbmctdG9wOiAxMHB4O1xufVxuI2NvdXJzZXNpbmZvIC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAubWF0LWhlYWRlci1jZWxsLFxuI2NvdXJzZXNpbmZvIC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAubWF0LWNlbGwge1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xufVxuI2NvdXJzZXNpbmZvIC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VzaW5mbyAuY291cnNlc2luZm90YmFsZSAuZGF0ZV9ib3ggPiBkaXYgPiBkaXYgPiBkaXYge1xuICBkaXNwbGF5OiBmbGV4O1xuICBoZWlnaHQ6IDU1cHg7XG59XG4jY291cnNlc2luZm8gLmNvdXJzZXNpbmZvdGJhbGUgLmRhdGVfaW1nID4gYnV0dG9uIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBib3R0b206IDE0cHg7XG59XG4jY291cnNlc2luZm8gLnNpbmdsZS1yb3cge1xuICBtYXJnaW4tbGVmdDogOHB4O1xufVxuXG4jY291cnNlc2luZm8ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBmb250LXdlaWdodDogNDAwO1xuICBmb250LXN0eWxlOiBub3JtYWw7XG4gIGxldHRlci1zcGFjaW5nOiBub3JtYWw7XG4gIGxpbmUtaGVpZ2h0OiAyMnB4O1xuICB0ZXh0LWFsaWduOiBsZWZ0O1xuICBtYXJnaW46IDAlO1xuICBmb250LXN0eWxlOiBub3JtYWw7XG4gIGxldHRlci1zcGFjaW5nOiBub3JtYWw7XG59XG4jY291cnNlc2luZm8gLmJhdGNoaGVhZGVyIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlscyB7XG4gIHdpZHRoOiAxMDAlO1xuICBkaXNwbGF5OiBmbGV4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG4gIHBhZGRpbmc6IDEwcHg7XG59XG4jY291cnNlc2luZm8gLmxpY2Vuc2Uge1xuICB3aWR0aDogOTAlO1xuICBkaXNwbGF5OiBmbGV4O1xuICBwYWRkaW5nLWxlZnQ6IDIwcHg7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlsczEge1xuICBkaXNwbGF5OiBmbGV4O1xuICB3aWR0aDogMTAwJTtcbiAgcGFkZGluZzogMCAxMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlsczIge1xuICB3aWR0aDogMTAwJTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzIC5ib3Ige1xuICBwYWRkaW5nOiAwcHggMTBweDtcbiAgcGFkZGluZy10b3A6IDJweDtcbiAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xuICBtYXJnaW46IDEwcHggNXB4O1xufVxuI2NvdXJzZXNpbmZvIC5tZGMtdGV4dC1maWVsZCB7XG4gIHdpbGwtY2hhbmdlOiB1bnNldDtcbn1cbiNjb3Vyc2VzaW5mbyB0YWJsZSB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtcGFnaW5hdG9yIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jY291cnNlc2luZm8gLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAganVzdGlmeS1jb250ZW50OiBzdGFydDtcbn1cbiNjb3Vyc2VzaW5mbyB0aC5tYXQtc29ydC1oZWFkZXItc29ydGVkIHtcbiAgY29sb3I6IGJsYWNrO1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMgLmJvciB7XG4gIHBhZGRpbmc6IDBweCAxMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG4gIG1hcmdpbjogNXB4IDVweDtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIG1hcmdpbjogMDtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzIHAge1xuICBwYWRkaW5nOiAwcHggOHB4O1xuICBtYXJnaW46IDJweCAwO1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMgc3BhbiB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMgc3BhbiAuYWRkIHtcbiAgY29sb3I6ICNGRkY7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmNTJkMDA7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlscy5mbGV4LWNvbHVtbi5lZHVjYXRpb24tYmFja2dyb3VuZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmM2Y0ZjY7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlscy5mbGV4LWNvbHVtbi5lZHVjYXRpb24tYmFja2dyb3VuZCAubWF0LWlucHV0LWVsZW1lbnQge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAwcHggMCAwIDBweDtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyLXJhZGl1czogMCAwcHggMHB4IDA7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlscy5mbGV4LWNvbHVtbi5lZHVjYXRpb24tYmFja2dyb3VuZCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzBjNGI5YTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMuZmxleC1jb2x1bW4uZWR1Y2F0aW9uLWJhY2tncm91bmQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzLmZsZXgtY29sdW1uLmVkdWNhdGlvbi1iYWNrZ3JvdW5kIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMuZmxleC1jb2x1bW4uZWR1Y2F0aW9uLWJhY2tncm91bmQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlscy5mbGV4LWNvbHVtbi5lZHVjYXRpb24tYmFja2dyb3VuZCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMuZmxleC1jb2x1bW4uZWR1Y2F0aW9uLWJhY2tncm91bmQgLm1hdC1jaGVja2JveC1jaGVja2VkLm1hdC1hY2NlbnQgLm1hdC1jaGVja2JveC1iYWNrZ3JvdW5kIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMuZmxleC1jb2x1bW4uZWR1Y2F0aW9uLWJhY2tncm91bmQgLnJlYWRfb25seSBpbnB1dFtyZWFkb25seV0ge1xuICBjdXJzb3I6IG5vLWRyb3A7XG59XG4jY291cnNlc2luZm8gLmNsZmxleCB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jY291cnNlc2luZm8gLnJ3aWR0aCB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2NvdXJzZXNpbmZvIC5zd2lkdGgge1xuICB3aWR0aDogMTAwJTtcbiAgZ2FwOiAxLjVyZW07XG4gIHBhZGRpbmctYm90dG9tOiA4cHg7XG59XG4jY291cnNlc2luZm8gLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgd2lkdGg6IGZpdC1jb250ZW50O1xufVxuI2NvdXJzZXNpbmZvIC5mYnV0dG9uIHtcbiAgd2lkdGg6IDEwMCU7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZW5kO1xuICBnYXA6IDEwcHg7XG59XG4jY291cnNlc2luZm8gLmZidXR0b24gLmNsZWFyLWJ0biB7XG4gIHdpZHRoOiAxMTBweDtcbiAgaGVpZ2h0OiA0NXB4O1xuICBiYWNrZ3JvdW5kOiAjRkZGRkZGIDAlIDAlIG5vLXJlcGVhdCBwYWRkaW5nLWJveDtcbiAgYm9yZGVyOiAxcHggc29saWQgI0M0QzRDNDtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2NvdXJzZXNpbmZvIC5mYnV0dG9uIC5hZGQtYnRuIHtcbiAgd2lkdGg6IDExMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGNvbG9yOiAjZmZmO1xuICBiYWNrZ3JvdW5kOiAjRUQxQzI3IDAlIDAlIG5vLXJlcGVhdCBwYWRkaW5nLWJveDtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBib3JkZXI6IG5vbmU7XG59XG4jY291cnNlc2luZm8gLnRhYmxlX3dpZCB7XG4gIHdpZHRoOiA1MCU7XG59XG4jY291cnNlc2luZm8gLnRhYmxlX3dpZF9uZXcge1xuICB3aWR0aDogMzAlICFpbXBvcnRhbnQ7XG59XG4jY291cnNlc2luZm8gLmNoZWNrX3RhYmxlX2JveCB7XG4gIHdpZHRoOiAxOCU7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jY291cnNlc2luZm8gLmNoZWNrX3RhYmxlX2JveCAubWF0LWNoZWNrYm94LWZyYW1lIHtcbiAgYm9yZGVyLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG59XG4jY291cnNlc2luZm8gLmRhdGVfYm94ID4gZGl2ID4gZGl2ID4gZGl2IHtcbiAgZGlzcGxheTogZmxleDtcbiAgaGVpZ2h0OiA1NXB4O1xufVxuI2NvdXJzZXNpbmZvIC5kYXRlX2ltZyA+IGJ1dHRvbiB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgYm90dG9tOiAxNHB4O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMxaW5uZXJkaXYge1xuICBwYWRkaW5nOiAxMHB4IDIwcHggMTBweCAxMHB4O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMxaW5uZXJkaXYgcCB7XG4gIG1hcmdpbjogMHB4O1xufVxuI2NvdXJzZXNpbmZvIC5mb250YmxhY2sge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNjb3Vyc2VzaW5mbyAuY29sZ3JlZW4ge1xuICBjb2xvcjogIzAwYTU1MSAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5jb2xvcmFuZ2Uge1xuICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5jb2xyZWQsXG4jY291cnNlc2luZm8gLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XG4gIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XG59XG4jY291cnNlc2luZm8gLmNvbHB1cnBsZSB7XG4gIGNvbG9yOiAjZDE2MGQ5O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaEljb24ge1xuICBoZWlnaHQ6IDEwcHg7XG59XG4jY291cnNlc2luZm8gLmxlYW5lcnRhYmxlMSB7XG4gIHdpZHRoOiA4MCU7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2Vlbjtcbn1cbiNjb3Vyc2VzaW5mbyAudGFibGVtZW51IGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcbiAgY29sb3I6ICNGRkYgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VzaW5mbyAubGVhbmVydGFibGUgLmxlYW5lcnRhYmxlMSAubWF0LWZsYXQtYnV0dG9uIC5tYXQtYnV0dG9uLXdyYXBwZXIgaS5mYSB7XG4gIGNvbG9yOiB0cmFuc3BhcmVudDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS13aWR0aDogMXB4O1xuICAtd2Via2l0LXRleHQtc3Ryb2tlLWNvbG9yOiAjZmZmO1xufVxuI2NvdXJzZXNpbmZvIC50b3BwYWdlIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNjb3Vyc2VzaW5mbyAudG9wcGFnZSAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LWljb24tYnV0dG9uLm1hdC1wYWdpbmF0b3ItbmF2aWdhdGlvbi1wcmV2aW91cyxcbiNjb3Vyc2VzaW5mbyAudG9wcGFnZSAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1uYXZpZ2F0aW9uLW5leHQge1xuICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XG59XG4jY291cnNlc2luZm8gLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG59XG4jY291cnNlc2luZm8gLm10LTEge1xuICBtYXJnaW4tdG9wOiAxZW07XG59XG4jY291cnNlc2luZm8gLm1hdC1oZWFkZXItY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBtYXJnaW46IDBweCAxMHB4O1xuICBmb250LXNpemU6IDE0cHg7XG59XG4jY291cnNlc2luZm8gLmRhdGUtcm93IHtcbiAgbWluLXdpZHRoOiAyNjNweDtcbn1cbiNjb3Vyc2VzaW5mbyAuc2VyYWNocm93Lm1hdC1oZWFkZXItY2VsbCB7XG4gIG1hcmdpbjogMHB4IDEwcHg7XG59XG4jY291cnNlc2luZm8gLnNlcmFjaHJvdy5tYXQtaGVhZGVyLWNlbGw6Zmlyc3Qtb2YtdHlwZSB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtaGVhZGVyLWNlbGwuZXh3aWQsXG4jY291cnNlc2luZm8gLnNlcmFjaHJvdy5tYXQtaGVhZGVyLWNlbGwuZXh3aWQge1xuICBtaW4td2lkdGg6IDE3MHB4O1xuICBtYXgtd2lkdGg6IDE3MHB4O1xufVxuI2NvdXJzZXNpbmZvIC50b3BtZW51IC5tYXQtbWVudS1wYW5lbCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICM2MTYxNjEgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VzaW5mbyAudG9wbWVudSAubWF0LW1lbnUtcGFuZWwgYnV0dG9uLm1hdC1tZW51LWl0ZW0ge1xuICBsaW5lLWhlaWdodDogMzZweCAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDMxcHggIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VzaW5mbyAjYmF0Y2hjb250YWluZXIgLmV4YW1wbGUtY29udGFpbmVyIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAxO1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG59XG4jY291cnNlc2luZm8gLm1hdC1oZWFkZXItcm93Om50aC1jaGlsZCgxKSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG59XG4jY291cnNlc2luZm8gLm1hdC1oZWFkZXItcm93LCAjY291cnNlc2luZm8gLm1hdC1yb3cge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuI2NvdXJzZXNpbmZvICNzZWFyY2hyb3cubWF0LWhlYWRlci1yb3cge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xufVxuI2NvdXJzZXNpbmZvICNzZWFyY2hyb3cgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMHB4O1xufVxuI2NvdXJzZXNpbmZvIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xuICBjb2xvcjogZ3JheTtcbn1cbiNjb3Vyc2VzaW5mbyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XG4gIGhlaWdodDogMHB4O1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtaWNvbi1idXR0b24gKyAubWF0LWRhdGVwaWNrZXItaW5wdXQtY29udGFpbmVyIHtcbiAgZmxvYXQ6IGxlZnQ7XG4gIG1hcmdpbi10b3A6IDdweDtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LXBhZ2luYXRvcixcbiNjb3Vyc2VzaW5mbyAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUgLm1hdC1zZWxlY3QtdHJpZ2dlciB7XG4gIGZvbnQtc2l6ZTogMTRweDtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LW1lbnUtaXRlbSB7XG4gIGxpbmUtaGVpZ2h0OiAzNnB4O1xuICBoZWlnaHQ6IDMxcHg7XG4gIGNvbG9yOiAjZmZmO1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtbWVudS1jb250ZW50IHtcbiAgYmFja2dyb3VuZDogIzYxNjE2MSAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5zaW5nbGUtcm93IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQ7XG59XG4jY291cnNlc2luZm8gLmJvcmRlci1kYXNoZWQge1xuICBib3JkZXI6IDNweCBkb3R0ZWQgYmxhY2s7XG59XG4jY291cnNlc2luZm8gLnBiLTAsXG4jY291cnNlc2luZm8gLnBiLTAgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXIge1xuICBwYWRkaW5nLWJvdHRvbTogMHB4ICFpbXBvcnRhbnQ7XG59XG4jY291cnNlc2luZm8gLm1yLTEge1xuICBtYXJnaW4tcmlnaHQ6IDFlbTtcbn1cbiNjb3Vyc2VzaW5mbyAuY2xvc2UtYnRuIHtcbiAgYm9yZGVyOiBub25lO1xuICBwYWRkaW5nOiAwcHg7XG4gIGZvbnQtc2l6ZTogeC1zbWFsbDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBib3R0b206IDJlbTtcbiAgbGVmdDogM2VtO1xuICB6LWluZGV4OiAxO1xufVxuI2NvdXJzZXNpbmZvIC5wb3NpdGlvbi1yZWxhdGl2ZSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbiNjb3Vyc2VzaW5mbyAubXItMiB7XG4gIG1hcmdpbi1yaWdodDogMmVtO1xufVxuI2NvdXJzZXNpbmZvIC5tYi0yIHtcbiAgbWFyZ2luLWJvdHRvbTogMmVtO1xufVxuI2NvdXJzZXNpbmZvIC5jb250ZW50IHtcbiAgd2lkdGg6IDEwMCU7XG4gIGZsb2F0OiBsZWZ0O1xuICBkaXNwbGF5OiBibG9jaztcbn1cbiNjb3Vyc2VzaW5mbyAuY29sLTEyIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jY291cnNlc2luZm8gLmNvbC02IHtcbiAgd2lkdGg6IDUwJTtcbn1cbiNjb3Vyc2VzaW5mbyAuY29sLTUge1xuICB3aWR0aDogMjAlO1xufVxuI2NvdXJzZXNpbmZvIC5jb2wtNCB7XG4gIHdpZHRoOiAyNSU7XG59XG4jY291cnNlc2luZm8gLmNvbC0zIHtcbiAgd2lkdGg6IDMzLjMzJTtcbn1cbiNjb3Vyc2VzaW5mbyAuY29sLTIge1xuICB3aWR0aDogMjAlO1xufVxuI2NvdXJzZXNpbmZvIC5jb2wtMSB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2NvdXJzZXNpbmZvIC50ZXh0LWRhbmdlciB7XG4gIGNvbG9yOiByZWQ7XG59XG4jY291cnNlc2luZm8gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1yZWFkb25seSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgY29sb3I6ICNkOWQ5ZDk7XG59XG4jY291cnNlc2luZm8gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XG59XG4jY291cnNlc2luZm8gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jY291cnNlc2luZm8gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjNmJhNWVjO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzBjNGI5YTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jY291cnNlc2luZm8gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jY291cnNlc2luZm8gLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0wLjlyZW0pIHNjYWxlKDAuNzUpO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNjb3Vyc2VzaW5mbyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIHBhZGRpbmc6IDEwcHggMCAhaW1wb3J0YW50O1xuICBib3JkZXItdG9wOiAwLjVlbSBzb2xpZCB0cmFuc3BhcmVudDtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzMiAuY2xmbGV4LnN3aWR0aCAubWF0LWlucHV0LWVsZW1lbnQge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzMiAuY2xmbGV4LnN3aWR0aCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgY29sb3I6ICNkOWQ5ZDk7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlsczIgLmNsZmxleC5zd2lkdGggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDBweCAwIDAgMHB4O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMyIC5jbGZsZXguc3dpZHRoIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyLXJhZGl1czogMCAwcHggMHB4IDA7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlsczIgLmNsZmxleC5zd2lkdGggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlsczIgLmNsZmxleC5zd2lkdGggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjNmJhNWVjO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMyIC5jbGZsZXguc3dpZHRoIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzBjNGI5YTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzMiAuY2xmbGV4LnN3aWR0aCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlsczIgLmNsZmxleC5zd2lkdGggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jY291cnNlc2luZm8gLmJhdGNoZGV0YWlsczIgLmNsZmxleC5zd2lkdGggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzMiAuY2xmbGV4LnN3aWR0aCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0wLjlyZW0pIHNjYWxlKDAuNzUpO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzMiAuY2xmbGV4LnN3aWR0aCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzMiAuY2xmbGV4LnN3aWR0aCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2NvdXJzZXNpbmZvIC5iYXRjaGRldGFpbHMyIC5jbGZsZXguc3dpZHRoIC5tYXQtY2hlY2tib3gtY2hlY2tlZC5tYXQtYWNjZW50IC5tYXQtY2hlY2tib3gtYmFja2dyb3VuZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcbn1cbiNjb3Vyc2VzaW5mbyAuYmF0Y2hkZXRhaWxzMiAuY2xmbGV4LnN3aWR0aCAucmVhZF9vbmx5IGlucHV0W3JlYWRvbmx5XSB7XG4gIGN1cnNvcjogbm8tZHJvcDtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/candidatemanagement/learner-register/learner-register.component.ts":
  /*!********************************************************************************************!*\
    !*** ./src/app/modules/candidatemanagement/learner-register/learner-register.component.ts ***!
    \********************************************************************************************/

  /*! exports provided: LearnerRegisterComponent */

  /***/
  function srcAppModulesCandidatemanagementLearnerRegisterLearnerRegisterComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "LearnerRegisterComponent", function () {
      return LearnerRegisterComponent;
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


    var _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/cdk/a11y */
    "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/a11y.js");
    /* harmony import */


    var _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! @angular/material/sort */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
    /* harmony import */


    var _angular_cdk_collections__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/cdk/collections */
    "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/collections.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _app_services_learner_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/services/learner.service */
    "./src/app/services/learner.service.ts");
    /* harmony import */


    var rxjs__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! rxjs */
    "./node_modules/rxjs/_esm2015/index.js");
    /* harmony import */


    var _app_shared_shared_service__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @app/@shared/shared.service */
    "./src/app/@shared/shared.service.ts");
    /* harmony import */


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _app_services_application_service__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @app/services/application.service */
    "./src/app/services/application.service.ts");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_15__);
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(
    /*! @app/services/assessmentReport.service */
    "./src/app/services/assessmentReport.service.ts");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(
    /*! moment */
    "./node_modules/moment/moment.js");
    /* harmony import */


    var moment__WEBPACK_IMPORTED_MODULE_18___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_18__);
    /* harmony import */


    var ngx_toastr__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(
    /*! ngx-toastr */
    "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js"); // import { MatFileUploadQueueComponent } from 'angular-material-fileupload';
    // export interface workInfo {
    // }


    var today = new Date();
    var month = today.getMonth();
    var year = today.getFullYear();
    var ELEMENT_DATA = [// { coursename: 'Standard Courses', ctotal: '18', ccertify: '07', cactive: '14', cnearingexpiry: '08', cexpired: '03', csuspended: '' },
      //   { coursename: 'Customized Courses', ctotal: '12', ccertify: '04', cactive: '10', cnearingexpiry: '04', cexpired: '02', csuspended: '' },
      //   { coursename: 'Customized Courses', ctotal: '12', ccertify: '04', cactive: '10', cnearingexpiry: '04', cexpired: '02', csuspended: '' }
    ];

    var LearnerRegisterComponent = /*#__PURE__*/function () {
      function LearnerRegisterComponent(translate, remoteService, cookieService, _liveAnnouncer, formBuilder, learnerService, sharedservice, appService, route, assessmentService, routes, toastr) {
        _classCallCheck(this, LearnerRegisterComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this._liveAnnouncer = _liveAnnouncer;
        this.formBuilder = formBuilder;
        this.learnerService = learnerService;
        this.sharedservice = sharedservice;
        this.appService = appService;
        this.route = route;
        this.assessmentService = assessmentService;
        this.routes = routes;
        this.toastr = toastr;
        this.displayedColumns2 = ['sexp_employername', 'sexp_doj', 'sexp_currentlyworking', 'sexp_designation', 'sexp_createdon', 'sexp_updatedon', 'action'];
        this.displayEducation = ['sacd_institutename', 'sacd_degorcert', 'sacd_startdate', 'sacd_enddate', 'sacd_grade', 'added_on', 'last_updated_on', 'action'];
        this.destroy$ = new rxjs__WEBPACK_IMPORTED_MODULE_10__["Subject"]();
        this.ifarabic = false;
        this.searchcountry = '';
        this.stafflevel_list = [];
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
        this.tiles = [{
          text: 'Training Evaluation Center: National Training Institute',
          cols: 1,
          rows: 1,
          color: 'lightblue'
        }, {
          text: 'Batch No: 126465',
          cols: 1,
          rows: 1,
          color: 'lightpink'
        }, {
          text: 'Batch Type: Initial',
          cols: 1,
          rows: 1,
          color: '#DDBDF1'
        }];
        this.batchdata_data = null;
        this.search = [{
          text: '',
          cols: 1,
          rows: 1,
          color: 'lightblue'
        }, {
          text: '',
          cols: 1,
          rows: 1,
          color: 'lightpink'
        }, {
          text: '',
          cols: 1,
          rows: 1,
          color: '#DDBDF1'
        }];
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
        this.filter = false;
        this.expFilter = false;
        this.edufilter = false;
        this.countrylist = [];
        this.stateList = [];
        this.cityList = [];
        this.eStateList = [];
        this.expStateList = [];
        this.eCityList = [];
        this.expCityList = [];
        this.searchstate = '';
        this.searchcity = '';
        this.esearchcountry = '';
        this.esearchstate = '';
        this.esearchcity = '';
        this.edu_page = 5;
        this.exp_page = 5;
        this.notAllow = false;
        this.selection = new _angular_cdk_collections__WEBPACK_IMPORTED_MODULE_7__["SelectionModel"](true, []);
        this.maxDate = new Date();
        this.issueDate = new Date();
        this.learner_fees = "";
        this.filterValues = {
          sacd_enddate: "",
          sacd_startdate: "",
          added_on: "",
          last_updated_on: ""
        };
        this.sel_sacd_startdate = "";
        this.sel_sacd_enddate = "";
        this.sel_added_on = "";
        this.sel_last_updated_on = "";
        this.filterForm = new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormGroup"]({
          sacd_institutename: new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormControl"](),
          sacd_degorcert: new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormControl"](),
          sacd_startdate: new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormControl"](),
          sacd_enddate: new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormControl"](),
          sacd_grade: new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormControl"](),
          added_on: new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormControl"](),
          last_updated_on: new _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormControl"]()
        });
      }

      _createClass(LearnerRegisterComponent, [{
        key: "fileeSelected",
        value: function fileeSelected(file, fileId) {
          fileId.selectedFilesPk = file;
        }
      }, {
        key: "sacd_startdate",
        get: function get() {
          return this.filterForm.get('sacd_startdate');
        }
      }, {
        key: "sacd_enddate",
        get: function get() {
          return this.filterForm.get('sacd_enddate');
        }
      }, {
        key: "added_on",
        get: function get() {
          return this.filterForm.get('added_on');
        }
      }, {
        key: "sacd_updatedon",
        get: function get() {
          return this.filterForm.get('sacd_updatedon');
        }
      }, {
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
          this.reactiveForm();
          this.profilePhoto = {
            fileMstPk: 12,
            selectedFilesPk: []
          };
          this.cividId = {
            fileMstPk: 13,
            selectedFilesPk: []
          };
          this.licenseCard = {
            fileMstPk: 13,
            selectedFilesPk: []
          };
          this.getCountry();
          this.getbranchinfo();
          this.routes.paramMap.subscribe(function (params) {
            var param = {
              bid: params.get('batch')
            };

            _this.getbatchdtls(params.get('batch'));

            _this.getLearnerCourseFee(param);

            _this.learnerService.getbranchinfo(param).subscribe(function (data) {
              // this.batchDetail = data.data.data
              _this.company = data.data.data.branch_info.omrm_companyname_en;
              _this.batch_no = data.data.data.batch_info.bmd_Batchno;
              _this.batchmgmtdtls = data.data.data.batch_info.batchmgmtdtls_pk;
            });
          });
          this.maxDate.setFullYear(new Date().getFullYear() - 18);
          this.issueDate.setFullYear(new Date().getFullYear());
          this.getState(31);
          this.egetState(31);
          this.formSubscribe(); // this.getEduList(293);
          // this.getExpList(293);

          this.staffleveldropdown();
        }
      }, {
        key: "getLearnerCourseFee",
        value: function getLearnerCourseFee(data) {
          var _this2 = this;

          this.learnerService.learnercoursefee(data).subscribe(function (data) {
            console.log("data", data.data.data.fsm_fee);
            _this2.learner_fees = data.data.data.fsm_fee;

            _this2.formGroup.controls['learner_fee'].setValue(data.data.data.fsm_fee);
          });
        }
      }, {
        key: "getbatchdtls",
        value: function getbatchdtls(id) {
          var _this3 = this;

          this.assessmentService.getbatchdtls(id).subscribe(function (data) {
            _this3.batchdata_data = data.data.data;
          });
        }
      }, {
        key: "currentlyWorking",
        value: function currentlyWorking(event) {
          // console.log("events",event.checked);
          if (event.checked == true) {
            console.log("true");
            this.notAllow = true;
            this.formGroup.controls['sexp_eod'].setValue(' ');
          } else if (event.checked == false) {
            console.log("false");
            this.notAllow = false;
          }
        }
      }, {
        key: "checkCivilNum",
        value: function checkCivilNum() {
          var _this4 = this;

          var repo = "";
          var civilnum = this.formGroup.controls['sir_idnumber'].value; // this.civil_num_val = this.staffForm.get('civil_num').value;

          this.learnerService.checkLearner(civilnum, repo).subscribe(function (data) {
            if (data.data.status == 1) {
              // console.log(data.data.data[0])
              var lrnr_data = data.data.data[0];

              _this4.formGroup.controls['sir_idnumber'].setErrors({
                alreadyavailable: true
              });

              _this4.formGroup.controls['sir_emailid'].setValue(lrnr_data.sir_emailid);

              _this4.formGroup.controls['sir_name_en'].setValue(lrnr_data.sir_name_en);

              _this4.formGroup.controls['mnumber'].setValue(lrnr_data.sir_mobnum);

              _this4.formGroup.controls['mnumber2'].setValue(lrnr_data.sir_altmobnum);

              _this4.formGroup.controls['sir_gender'].setValue(lrnr_data.sir_gender);

              _this4.formGroup.controls['sir_name_ar'].setValue(lrnr_data.sir_name_ar);

              _this4.formGroup.controls['sir_dob'].setValue(lrnr_data.sir_dob);

              _this4.formGroup.controls['sir_nationality'].setValue(lrnr_data.sir_nationality);

              _this4.formGroup.controls['sir_addrline1'].setValue(lrnr_data.sir_addrline1);

              _this4.formGroup.controls['sir_addrline2'].setValue(lrnr_data.sir_addrline2);

              _this4.formGroup.controls['state'].setValue(lrnr_data.sir_opalstatemst_fk);

              _this4.formGroup.controls['city'].setValue(lrnr_data.sir_opalcitymst_fk);

              _this4.formGroup.controls['learner_fee'].setValue(lrnr_data.lrhd_learnerfee);

              _this4.formGroup.controls['learner_fee_status'].setValue(lrnr_data.lrhd_feestatus);

              _this4.formGroup.controls['paid_by'].setValue(lrnr_data.lrhd_paidby);

              _this4.getEduList(lrnr_data.staffinforepo_pk);

              _this4.getExpList(lrnr_data.staffinforepo_pk);

              _this4.changeFormAddress(lrnr_data.sir_gender);

              _this4.getage(lrnr_data.sir_dob);
            } else {
              var _lrnr_data = data.data.data[0];

              _this4.formGroup.controls['sir_idnumber'].setErrors({
                alreadyavailable: true
              });

              _this4.formGroup.controls['sir_emailid'].setValue('');

              _this4.formGroup.controls['sir_name_en'].setValue('');

              _this4.formGroup.controls['mnumber'].setValue('');

              _this4.formGroup.controls['mnumber2'].setValue('');

              _this4.formGroup.controls['sir_gender'].setValue('');

              _this4.formGroup.controls['sir_name_ar'].setValue('');

              _this4.formGroup.controls['sir_dob'].setValue('');

              _this4.formGroup.controls['sir_nationality'].setValue('31');

              _this4.formGroup.controls['country'].setValue('31');

              _this4.formGroup.controls['sir_addrline1'].setValue('');

              _this4.formGroup.controls['sir_addrline2'].setValue('');

              _this4.formGroup.controls['state'].setValue('');

              _this4.formGroup.controls['city'].setValue('');

              _this4.formGroup.controls['learner_fee'].setValue('');

              _this4.formGroup.controls['learner_fee_status'].setValue('');

              _this4.formGroup.controls['paid_by'].setValue('');

              _this4.getEduList('');

              _this4.getExpList('');

              _this4.changeFormAddress('');

              _this4.getage('');
            } //this.FormMainTemplate='success';
            // this.mattab = 6;

          });
        }
      }, {
        key: "syncPrimaryPaginator",
        value: function syncPrimaryPaginator(event) {
          this.edu_paginator.pageIndex = event.pageIndex;
          this.edu_paginator.pageSize = event.pageSize;
          this.edu_page = event.pageSize;
        }
      }, {
        key: "syncExperiencePaginator",
        value: function syncExperiencePaginator(event) {
          // exppaginator
          this.exppaginator.pageIndex = event.pageIndex;
          this.exppaginator.pageSize = event.pageSize;
          this.edu_page = event.pageSize;
        }
      }, {
        key: "getbranchinfo",
        value: function getbranchinfo() {// this.learnerService.getbranhinfo().subscribe(data=>{
          //   console.log("details", data);
          // })
        }
      }, {
        key: "getEduList",
        value: function getEduList(id) {
          var _this5 = this;

          var data = {
            id: id
          };
          this.learnerService.getEduList(data).subscribe(function (res) {
            // console.log("education details", data.data.data);
            _this5.educationdata_data = res.data.data;
            _this5.educationdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_12__["MatTableDataSource"](res.data.data);
            _this5.educationdata.paginator = _this5.edu_paginator;
            _this5.educationdata.sort = _this5.edusort;
            console.log("testung education", _this5.educationdata);
            console.log("testung educationdata_data", _this5.educationdata_data);

            _this5.getFormsValue();
          });
        }
      }, {
        key: "getExpList",
        value: function getExpList(id) {
          var _this6 = this;

          var data = {
            id: id
          };
          this.learnerService.getExpList(data).subscribe(function (res) {
            _this6.learnerdata_data = res.data.data;
            _this6.learnerdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_12__["MatTableDataSource"](res.data.data);
            _this6.learnerdata.paginator = _this6.exppaginator;
            _this6.learnerdata.sort = _this6.expsort;

            _this6.getFormsValue();
          });
        }
      }, {
        key: "announceSortChange",
        value: function announceSortChange(sortState) {
          console.log(sortState.direction, "sorting");

          if (sortState.direction) {
            this._liveAnnouncer.announce("Sorted ".concat(sortState.direction, "ending"));
          } else {
            this._liveAnnouncer.announce('Sorting cleared');
          }
        }
      }, {
        key: "applyFilterEdu",
        value: function applyFilterEdu(event) {
          var filterValue = event.target.value;
          this.educationdata.filter = filterValue.trim().toLowerCase();
        }
      }, {
        key: "experienceSortChange",
        value: function experienceSortChange(sortState) {
          console.log(sortState.direction, "sorting");

          if (sortState.direction) {
            this._liveAnnouncer.announce("Sorted ".concat(sortState.direction, "ending"));
          } else {
            this._liveAnnouncer.announce('Sorting cleared');
          }
        }
      }, {
        key: "applyFilter",
        value: function applyFilter(event) {
          var filterValue = event.target.value;
          this.learnerdata.filter = filterValue.trim().toLowerCase();
        }
      }, {
        key: "getCountry",
        value: function getCountry() {
          var _this7 = this;

          this.appService.getcountry().subscribe(function (data) {
            // console.log("country",data.data);
            _this7.countrylist = data.data;
          });
        }
      }, {
        key: "staffleveldropdown",
        value: function staffleveldropdown() {
          var _this8 = this;

          this.appService.getref(12).subscribe(function (data) {
            _this8.stafflevel_list = data.data;
          });
        }
      }, {
        key: "getState",
        value: function getState(event) {
          var _this9 = this;

          // console.log(event.value);
          event = event.value ? event.value : event;
          this.appService.getstate(event).subscribe(function (data) {
            // console.log("states",data.data);
            _this9.stateList = data.data;
          });
        }
      }, {
        key: "getCity",
        value: function getCity(event, city) {
          var _this10 = this;

          event = event.value ? event.value.opalstatemst_pk : event;
          console.log(event.value, "get city events");
          this.appService.getcity(event, city).subscribe(function (data) {
            _this10.cityList = data.data;
          });
        }
      }, {
        key: "egetState",
        value: function egetState(event) {
          var _this11 = this;

          event = event.value ? event.value : event;
          this.appService.getstate(event).subscribe(function (data) {
            // console.log("states",data.data);
            _this11.eStateList = data.data;
          });
        }
      }, {
        key: "egetCity",
        value: function egetCity(event, city) {
          var _this12 = this;

          event = event.value ? event.value.opalstatemst_pk : event;
          this.appService.getcity(event, city).subscribe(function (data) {
            _this12.eCityList = data.data;
          });
        }
      }, {
        key: "expgetState",
        value: function expgetState(event) {
          var _this13 = this;

          console.log("exp events", event);
          event = event.value ? event.value.opalcountrymst_pk : event;
          this.appService.getstate(event).subscribe(function (data) {
            // console.log("states",data.data);
            _this13.expStateList = data.data;
          });
        }
      }, {
        key: "expgetCity",
        value: function expgetCity(event, city) {
          var _this14 = this;

          console.log(city, "exp city events");
          event = event.value ? event.value.opalstatemst_pk : event;
          this.appService.getcity(event, city.opalcountrymst_pk).subscribe(function (data) {
            console.log("city", data.data);
            _this14.expCityList = data.data;
          });
        }
      }, {
        key: "reactiveForm",
        value: function reactiveForm() {
          this.formGroup = this.formBuilder.group({
            'sir_idnumber': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sir_name_en': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sir_name_ar': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sir_emailid': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sir_gender': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sir_dob': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sir_nationality': ['31', _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'form_address': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            "age": [null],
            "sir_photo": [null],
            "sir_civilidfront": [null],
            'sir_addrline1': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sir_addrline2': [null],
            'country': ['31'],
            'state': [null],
            'city': [null],
            'sacd_staffinforepo_fk': [null],
            'staffacademics_pk': [null],
            'year_join': [null],
            'year_pass': [null],
            'institute_name': [null],
            'institue_country': ['31'],
            'inst_state': [null],
            'inst_city': [null],
            'edut_level': [null],
            'degree_cert': [null],
            'gpa_grade': [null],
            'sir_createdby': [null],
            'mnumber': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'mnumber2': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'picker': [null],
            'radion_button': [null],
            "license_card": [null],
            'license_number': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'light_license': [null],
            'heavy_license': [null],
            'light_issue_date': [null],
            'heavy_issue_date': [null],
            'staffworkexp_pk': [null],
            'sexp_employername': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sexp_doj': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sexp_currentlyworking': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sexp_eod': [null],
            'sexp_designation': [null, _angular_forms__WEBPACK_IMPORTED_MODULE_8__["Validators"].required],
            'sexp_opalcountrymst_fk': [null],
            'sexp_opalstatemst_fk': [null],
            'sexp_opalcitymst_fk': [null],
            'staffinforepo_fk': [null],
            'learner_fee_status': [null],
            'paid_by': [null],
            'learner_fee': [5000]
          });
        }
      }, {
        key: "getage",
        value: function getage(dob) {
          dob = dob.target ? dob.target.value : dob;
          var date1 = new Date();
          var date2 = new Date(dob);
          var diff = Math.floor(date1.getTime() - date2.getTime());
          var day = 1000 * 60 * 60 * 24;
          var days = Math.floor(diff / day);
          var months = Math.floor(days / 31);
          var years = Math.floor(months / 12);
          var message = years;
          console.log(message, "dob");
          this.formGroup.controls['age'].setValue(message); // this.formGroup.patchValue({
          //   'age':message
          // });
        }
      }, {
        key: "changeFormAddress",
        value: function changeFormAddress(event) {
          console.log("gender", event.value);

          if (event.value == 1) {
            this.formGroup.controls['form_address'].setValue('Mr');
          } else {
            this.formGroup.controls['form_address'].setValue('Miss');
          }
        }
      }, {
        key: "submitForm",
        value: function submitForm(value) {
          var _this15 = this;

          var postParams = {
            sir_idnumber: value.sir_idnumber,
            sir_name_en: value.sir_name_en,
            sir_name_ar: value.sir_name_ar,
            sir_emailid: value.sir_emailid,
            sir_gender: value.sir_gender,
            sir_nationality: value.sir_nationality,
            country: value.country,
            state: value.state.opalstatemst_pk,
            city: value.city.opalcitymst_pk,
            mnumber: value.mnumber,
            mnumber2: value.mnumber2,
            picker: value.picker,
            sir_dob: value.sir_dob,
            form_address: value.form_address,
            driving_license: value.driving_license,
            age: value.age,
            sir_photo: value.sir_photo,
            sir_civilidfront: value.sir_civilidfront,
            license_card: value.license_card,
            light_license: value.light_license,
            heavy_license: value.heavy_license,
            light_issue_date: value.light_issue_date,
            heavy_issue_date: value.heavy_issue_date,
            license_number: value.license_number,
            sir_addrline1: value.sir_addrline1,
            sir_addrline2: value.sir_addrline2,
            learner_fee: value.learner_fee,
            learner_fee_status: value.learner_fee_status,
            paid_by: value.paid_by,
            batchmgmtdtls: this.batchmgmtdtls
          };
          this.learnerService.registerLearner(postParams).subscribe(function (res) {
            if (res.success) {
              console.log("staff", res.data.data);
              console.log("staff", res.data);
              var data = res.data.data;

              _this15.formGroup.controls['staffinforepo_fk'].setValue(data); // swal(
              //   'Learner data saved Successfully',
              //   'Success'
              // )


              _this15.toastr.success('Learner Added Successfully.', ''), {
                timeOut: 2000,
                closeButton: false
              };

              _this15.formGroup.patchValue({
                sir_idnumber: '',
                sir_name_en: '',
                sir_name_ar: '',
                sir_emailid: '',
                sir_gender: '',
                mnumber: "",
                mnumber2: "",
                sir_nationality: '',
                country: '',
                state: '',
                city: '',
                light_issue_date: '',
                heavy_issue_date: '',
                light_license: '',
                heavy_license: '',
                sir_addrline1: '',
                sir_addrline2: '',
                license_number: '',
                learner_fee_status: '',
                paid_by: ''
              });
            }
          });
        }
      }, {
        key: "academicSubmit",
        value: function academicSubmit(value) {
          var _this16 = this;

          var learner_id = this.formGroup.controls['staffinforepo_fk'].value;
          var postParams = {
            staffacademics_pk: this.formGroup.controls['staffacademics_pk'].value,
            sacd_staffinforepo_fk: learner_id,
            year_join: value.year_join,
            year_pass: value.year_pass,
            institute_name: value.institute_name,
            institue_country: value.institue_country,
            inst_state: value.inst_state.opalstatemst_pk,
            inst_city: value.inst_city.opalcitymst_pk,
            edut_level: value.edut_level,
            degree_cert: value.degree_cert,
            gpa_grade: value.gpa_grade
          };
          console.log("academics", postParams);
          this.learnerService.saveAcademics(postParams).subscribe(function (res) {
            if (res.success) {
              _this16.formGroup.patchValue({
                staffacademics_pk: '',
                sacd_staffinforepo_fk: '',
                year_join: '',
                year_pass: '',
                institute_name: '',
                institue_country: '',
                inst_state: '',
                inst_city: '',
                edut_level: '',
                degree_cert: '',
                gpa_grade: ''
              });

              _this16.getEduList(learner_id);

              sweetalert__WEBPACK_IMPORTED_MODULE_15___default()('Academics data submitted Successfully', 'Success');
            }
          });
        }
      }, {
        key: "editEduList",
        value: function editEduList(data) {
          this.formGroup.patchValue({
            staffacademics_pk: data.staffacademics_pk,
            sacd_staffinforepo_fk: data.sacd_staffinforepo_fk,
            year_join: data.sacd_startdate,
            year_pass: data.sacd_enddate,
            institute_name: data.sacd_institutename,
            institue_country: Number(data.sacd_opalcountrymst_fk),
            inst_state: Number(data.sacd_opalstatemst_fk),
            inst_city: Number(data.sacd_opalcitymst_fk),
            edut_level: data.sacd_edulevel,
            degree_cert: data.sacd_degorcert,
            gpa_grade: data.sacd_grade
          });
        }
      }, {
        key: "delEduList",
        value: function delEduList(data) {}
      }, {
        key: "hasLicense",
        value: function hasLicense(event) {
          console.log("events", event.value);
        }
      }, {
        key: "submitForm2",
        value: function submitForm2(value) {
          var _this17 = this;

          var learner_id = this.formGroup.controls['staffinforepo_fk'].value;
          var postParams2 = {
            staffworkexp_pk: this.formGroup.controls['staffworkexp_pk'].value,
            stafrep_id: learner_id,
            oragn_name: value.sexp_employername,
            date_join: value.sexp_doj,
            curr_work: value.sexp_currentlyworking,
            workdate: value.sexp_eod,
            employ_country: value.sexp_opalcountrymst_fk.opalcountrymst_pk,
            employ_state: value.sexp_opalstatemst_fk.opalstatemst_pk,
            employ_city: value.sexp_opalcitymst_fk.opalcitymst_pk,
            designat: value.sexp_designation
          };
          this.learnerService.saveWorkexp(postParams2).subscribe(function (res) {
            if (res.success) {
              _this17.formGroup.controls["staffworkexp_pk"].setValue('');

              _this17.formGroup.controls['sexp_employername'].setValue('');

              _this17.formGroup.controls['sexp_doj'].setValue('');

              _this17.formGroup.controls['sexp_currentlyworking'].setValue('');

              _this17.formGroup.controls['sexp_eod'].setValue('');

              _this17.formGroup.controls['sexp_opalcountrymst_fk'].setValue('');

              _this17.formGroup.controls['sexp_opalstatemst_fk'].setValue('');

              _this17.formGroup.controls['sexp_opalcitymst_fk'].setValue('');

              _this17.formGroup.controls['sexp_designation'].setValue('');

              _this17.getExpList(learner_id);

              sweetalert__WEBPACK_IMPORTED_MODULE_15___default()('Experience data submitted Successfully', 'Success');
            }
          });
        }
      }, {
        key: "getassessmentstatus",
        value: function getassessmentstatus(no) {
          //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
          if (no == 1) {
            return 'New';
          } else if (no == 2) {
            return 'Teaching(theory)';
          } else if (no == 3) {
            return 'Teaching(practical)';
          } else if (no == 4) {
            return 'Assessment';
          } else if (no == 5) {
            return 'Requested for Back Track';
          } else if (no == 6) {
            return 'Quality Check';
          } else if (no == 7) {
            return 'Cancelled';
          } else if (no == 8) {
            return 'Print';
          } else if (no == 9) {
            return 'Requested for Assessor change';
          } else {
            return '';
          }
        }
      }, {
        key: "editExpList",
        value: function editExpList(data) {
          var value = this.countrylist.filter(function (item) {
            return item.opalcountrymst_pk == data.sexp_opalcountrymst_fk;
          });
          var eod = data.sexp_currentlyworking == 1 ? "" : data.sexp_eod;
          console.log("country", data.sexp_opalcountrymst_fk);
          console.log("state", data.sexp_opalstatemst_fk);
          console.log("city", data.sexp_opalcitymst_fk);
          var state = this.egetState(data.sexp_opalcountrymst_fk);
          var selectState = this.eStateList.filter(function (item) {
            return item.opalstatemst_pk == data.sexp_opalstatemst_fk;
          });
          this.formGroup.controls['sexp_opalstatemst_fk'].setValue(selectState[0]);
          var city = this.egetCity(data.sexp_opalcountrymst_fk, data.sexp_opalstatemst_fk);
          var selectCity = this.eCityList.filter(function (item) {
            return item.opalcitymst_pk == data.sexp_opalcitymst_fk;
          });
          this.formGroup.controls['sexp_opalcitymst_fk'].setValue(selectCity[0]);
          this.formGroup.controls["staffworkexp_pk"].setValue(data.staffworkexp_pk);
          this.formGroup.controls['sexp_employername'].setValue(data.sexp_employername);
          this.formGroup.controls['sexp_doj'].setValue(data.sexp_doj);
          this.formGroup.controls['sexp_currentlyworking'].setValue(data.sexp_currentlyworking);
          this.formGroup.controls['sexp_eod'].setValue(eod); // this.formGroup.controls['sexp_opalcountrymst_fk'].setValue(data.sexp_opalcountrymst_fk);

          this.formGroup.controls['sexp_opalcountrymst_fk'].setValue(value[0]);
          this.formGroup.controls['sexp_designation'].setValue(data.sexp_designation);
        }
      }, {
        key: "delExpList",
        value: function delExpList(data) {}
      }, {
        key: "formSubscribe",
        value: function formSubscribe() {
          var _this18 = this;

          this.sacd_startdate.valueChanges.subscribe(function (positionValue) {
            _this18.filterValues['sacd_startdate'] = positionValue;
            _this18.educationdata.filter = JSON.stringify(_this18.filterValues);
          });
        }
      }, {
        key: "getDate",
        value: function getDate(date) {
          if (date) {
            date = date.split(" ");
            return date[0];
          }

          return;
        }
      }, {
        key: "getFormsValue",
        value: function getFormsValue() {
          this.educationdata.filterPredicate = function (data, filter) {
            var _a;

            var searchString = JSON.parse(filter); // let isPositionAvailable = false;

            console.log("filters check", searchString); /////trst
            // if (this.gen_selection.length > 0) {
            //   isPositionAvailable = this.gen_selection.some(version => version == data.sir_gender);
            // }
            // else if (this.learner_selection.length > 0) {
            //   isPositionAvailable = this.learner_selection.some(version => version == data.lrhd_feestatus);
            // }
            // else if (this.knowledge_selection.length) {
            //   isPositionAvailable = this.knowledge_selection.some(version => version == data.rm_status_en);
            // }
            // else if (this.practical_selection.length) {
            //   isPositionAvailable = this.practical_selection.some(version => version == data.rm_status_ar);
            // }
            // else if (this.status_selection.length) {
            //   isPositionAvailable = this.status_selection.some(version => version == data.lrhd_status);
            // }
            // else {
            //   isPositionAvailable = true;
            // }

            console.log("data.sacd_startdate", data.sacd_startdate);
            console.log("start date picker", searchString.sacd_startdate.startDate);
            console.log("moment conversion start", moment__WEBPACK_IMPORTED_MODULE_18___default()(searchString.sacd_startdate.startDate).format("YYYY-MM-DD, h:mm:ss"));
            console.log("end date picker", searchString.sacd_startdate.endDate);
            console.log("moment conversion end", moment__WEBPACK_IMPORTED_MODULE_18___default()(searchString.sacd_startdate.endDate).format("YYYY-MM-DD, h:mm:ss"));
            console.log("xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx", data.sacd_startdate >= moment__WEBPACK_IMPORTED_MODULE_18___default()(searchString.sacd_startdate.startDate).format("YYYY-MM-DD, h:mm:ss") && data.sacd_startdate <= moment__WEBPACK_IMPORTED_MODULE_18___default()(searchString.sacd_startdate.endDate).format("YYYY-MM-DD, HH:mm:ss"));
            var resultValue; // isPositionAvailable && 
            // data.sacd_startdate.includes(searchString.sacd_startdate)

            if ((_a = searchString.sacd_startdate) === null || _a === void 0 ? void 0 : _a.startDate) {
              resultValue = moment__WEBPACK_IMPORTED_MODULE_18___default()(data.sacd_startdate).format("YYYY-MM-DD, h:mm:ss") >= moment__WEBPACK_IMPORTED_MODULE_18___default()(searchString.sacd_startdate.startDate).format("YYYY-MM-DD, h:mm:ss") && moment__WEBPACK_IMPORTED_MODULE_18___default()(data.sacd_startdate).format("YYYY-MM-DD, h:mm:ss") <= moment__WEBPACK_IMPORTED_MODULE_18___default()(searchString.sacd_startdate.endDate).format("YYYY-MM-DD, HH:mm:ss");
            } else {
              resultValue = true;
            } //   &&
            // data.sir_emailid
            //   .toString()
            //   .trim()
            //   .toLowerCase()
            //   .indexOf(searchString.sir_emailid.toLowerCase()) !== -1
            // &&
            // data.sir_idnumber
            //   .toString()
            //   .trim()
            //   .toLowerCase()
            //   .indexOf(searchString.sir_idnumber?.toLowerCase()) !== -1
            // &&
            // data.sir_name_en
            //   .toString()
            //   .trim()
            //   .toLowerCase()
            //   .indexOf(searchString.sir_name_en?.toLowerCase()) !== -1
            // &&
            // data.th_tutor
            //   .toString()
            //   .trim()
            //   .toLowerCase()
            //   .indexOf(searchString.th_tutor?.toLowerCase()) !== -1
            // &&
            // data.pra_tutor
            //   .toString()
            //   .trim()
            //   .toLowerCase()
            //   .indexOf(searchString.pra_tutor?.toLowerCase()) !== -1
            // &&
            // data.asmt_staff
            //   .toString()
            //   .trim()
            //   .toLowerCase()
            //   .indexOf(searchString.asmt_staff?.toLowerCase()) !== -1
            // &&
            // data.ivqastaff
            //   .toString()
            //   .trim()
            //   .toLowerCase()
            //   .indexOf(searchString.ivqastaff?.toLowerCase()) !== -1


            return resultValue; ////ytdy
          }; // this.learnerdata.filter = JSON.stringify(this.filterValues);

        }
        /**
         * This functions is show filter display and hide
         */

      }, {
        key: "showExpFilter",
        value: function showExpFilter() {
          this.expFilter = !this.expFilter;

          if (!this.expFilter) {
            var id = document.getElementById('searchrow');
            id.style.display = 'flex';
          } else {
            var _id = document.getElementById('searchrow');

            _id.style.display = 'none';
          }
        }
      }, {
        key: "showEduFilter",
        value: function showEduFilter() {
          this.edufilter = !this.edufilter;

          if (!this.edufilter) {
            var id = document.getElementById('edusearchrow');
            id.style.display = 'flex';
          } else {
            var _id2 = document.getElementById('edusearchrow');

            _id2.style.display = 'none';
          }
        }
      }, {
        key: "isAllSelected",
        value: function isAllSelected() {
          var _a;

          var numSelected = this.selection.selected.length;
          var numRows = (_a = this.learnerdata_data) === null || _a === void 0 ? void 0 : _a.length;
          return numSelected === numRows;
        }
      }, {
        key: "toggleAllRows",
        value: function toggleAllRows() {
          var _this$selection;

          if (this.isAllSelected()) {
            this.selection.clear();
            return;
          }

          (_this$selection = this.selection).select.apply(_this$selection, _toConsumableArray(this.learnerdata_data));
        }
      }]);

      return LearnerRegisterComponent;
    }();

    LearnerRegisterComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"]
      }, {
        type: _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_5__["LiveAnnouncer"]
      }, {
        type: _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormBuilder"]
      }, {
        type: _app_services_learner_service__WEBPACK_IMPORTED_MODULE_9__["LearnerService"]
      }, {
        type: _app_shared_shared_service__WEBPACK_IMPORTED_MODULE_11__["SharedService"]
      }, {
        type: _app_services_application_service__WEBPACK_IMPORTED_MODULE_14__["ApplicationService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_16__["ActivatedRoute"]
      }, {
        type: _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_17__["AssessmentReportService"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_16__["ActivatedRoute"]
      }, {
        type: ngx_toastr__WEBPACK_IMPORTED_MODULE_19__["ToastrService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('exppaginator'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_13__["MatPaginator"])], LearnerRegisterComponent.prototype, "exppaginator", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('edu_paginator'), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_13__["MatPaginator"])], LearnerRegisterComponent.prototype, "edu_paginator", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_6__["MatSort"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__["MatSort"])], LearnerRegisterComponent.prototype, "edusort", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('table1', {
      read: _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__["MatSort"],
      "static": true
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__["MatSort"])], LearnerRegisterComponent.prototype, "expsort", void 0);
    LearnerRegisterComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-learner-register',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./learner-register.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learner-register/learner-register.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./learner-register.component.scss */
      "./src/app/modules/candidatemanagement/learner-register/learner-register.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_2__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"], _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_5__["LiveAnnouncer"], _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormBuilder"], _app_services_learner_service__WEBPACK_IMPORTED_MODULE_9__["LearnerService"], _app_shared_shared_service__WEBPACK_IMPORTED_MODULE_11__["SharedService"], _app_services_application_service__WEBPACK_IMPORTED_MODULE_14__["ApplicationService"], _angular_router__WEBPACK_IMPORTED_MODULE_16__["ActivatedRoute"], _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_17__["AssessmentReportService"], _angular_router__WEBPACK_IMPORTED_MODULE_16__["ActivatedRoute"], ngx_toastr__WEBPACK_IMPORTED_MODULE_19__["ToastrService"]])], LearnerRegisterComponent);
    /***/
  },

  /***/
  "./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.scss":
  /*!**************************************************************************************!*\
    !*** ./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.scss ***!
    \**************************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesCandidatemanagementLearnerslistLearnerslistComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "#learnerlisting .titleinfolink {\n  display: flex;\n  align-items: center;\n  justify-content: space-between;\n}\n#learnerlisting .titleinfolink .viewalllink {\n  font-size: 13px;\n  color: #666;\n  cursor: pointer;\n}\n#learnerlisting .titleinfolink .viewalllink:hover {\n  color: #333;\n}\n#learnerlisting .buttonalign {\n  text-align: right;\n}\n#learnerlisting .paginator-add-filter .mat-paginator-container {\n  justify-content: start;\n}\n#learnerlisting .paginator-add-filter .example-button-row {\n  display: flex;\n}\n#learnerlisting .paginator-add-filter .mat-paginator-range-actions .mat-focus-indicator {\n  display: none;\n}\n#learnerlisting .paginator-add-filter .btn-no-rad {\n  border-radius: 0%;\n  height: 45px;\n}\n#learnerlisting .paginator-add-filter .add-filter-button {\n  justify-content: end !important;\n}\n#learnerlisting .paginator-add-filter .add-filter-button .btn-danger {\n  background-color: #ED1C27;\n  color: white;\n  border-radius: 0%;\n  height: 45px;\n}\n#learnerlisting .paginator-add-filter .add-filter-button .btn-primary {\n  border-radius: 0%;\n  height: 45px;\n}\n#learnerlisting .coursesinfotbale {\n  display: block;\n  overflow-x: auto;\n}\n#learnerlisting .coursesinfotbale .mat-courseinfo {\n  width: 100%;\n  border-collapse: collapse;\n  border: 1px solid #ddd;\n  justify-content: center;\n  overflow-x: auto;\n}\n#learnerlisting .coursesinfotbale .mat-courseinfo .mat-header-cell:nth-child(1) {\n  text-align: center;\n  justify-content: center;\n  flex: 1 1 50px;\n  box-sizing: border-box;\n  max-width: 50px;\n  min-width: 50px;\n  padding: 20px 0px;\n}\n#learnerlisting .coursesinfotbale .mat-courseinfo .mat-header-cell:nth-row(2) {\n  background-color: #f8f8f8 !important;\n}\n#learnerlisting .coursesinfotbale .mat-courseinfo .mat-cell:nth-child(1) {\n  text-align: center;\n  justify-content: center;\n  flex: 1;\n  box-sizing: border-box;\n  max-width: 50px;\n  min-width: 50px;\n  padding-left: 0px;\n}\n#learnerlisting .coursesinfotbale .mat-courseinfo #searchrow .mat-header-cell {\n  background-color: #f8f8f8 !important;\n  font-size: 15px;\n  min-height: 73px;\n}\n#learnerlisting .coursesinfotbale .mat-courseinfo .mat-header-cell {\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#learnerlisting .coursesinfotbale .mat-courseinfo .mat-header-cell,\n#learnerlisting .coursesinfotbale .mat-courseinfo .mat-cell {\n  text-align: center;\n  justify-content: center;\n  flex: 1 1 200px;\n  box-sizing: border-box;\n  max-width: 200px;\n  min-width: 200px;\n}\n#learnerlisting .coursesinfotbale .date_box > div > div > div {\n  display: flex;\n  height: 55px;\n}\n#learnerlisting .coursesinfotbale .date_img > button {\n  position: relative;\n  bottom: 14px;\n}\n.mat-sort-header-container {\n  justify-content: center;\n}\n.pagination > .mat-paginator > div > div {\n  justify-content: space-between;\n}\n.mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n.mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n.mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n.mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n.mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n.mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n.mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n.mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n.mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n.mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n.mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n.mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n.mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n.mat-form-field-infix {\n  padding: 10px 0 !important;\n  border-top: 0.5em solid transparent;\n}\n#learnerlisting {\n  display: flex;\n  flex-direction: column;\n  color: #848484;\n  font-size: 14px;\n  font-weight: 400;\n  font-style: normal;\n  letter-spacing: normal;\n  line-height: 22px;\n  font-style: normal;\n  letter-spacing: normal;\n}\n#learnerlisting .mr-1 {\n  margin-right: 0.5em;\n}\n#learnerlisting .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: gray;\n}\n#learnerlisting .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#learnerlisting .batchheader {\n  width: 100%;\n  padding-left: 30px;\n}\n#learnerlisting .batchdetails {\n  width: 100%;\n  display: flex;\n  border: 1px solid lightgray;\n  padding-left: 10px;\n}\n#learnerlisting .batchdetails1 {\n  display: flex;\n  width: 100%;\n  padding: 0px 20px;\n  border: 1px solid lightgray;\n}\n#learnerlisting table {\n  width: 100%;\n}\n#learnerlisting th.mat-sort-header-sorted {\n  color: black;\n}\n#learnerlisting .batchdetails .bor {\n  padding: 0px 10px;\n  border: 1px solid lightgray;\n  margin: 10px 5px;\n}\n#learnerlisting .batchdetails p {\n  padding: 0px 8px;\n  margin: 2px 0;\n}\n#learnerlisting .batchdetails span {\n  color: #262626;\n}\n#learnerlisting .clflex {\n  display: flex;\n}\n#learnerlisting .rwidth {\n  width: 100%;\n}\n#learnerlisting .batchdetails1innerdiv {\n  padding: 10px 20px 10px 10px;\n}\n#learnerlisting .batchdetails1innerdiv p {\n  margin: 0px;\n}\n#learnerlisting .fontblack {\n  color: #262626;\n}\n#learnerlisting .colgreen {\n  color: #00a551 !important;\n}\n#learnerlisting .colorange {\n  color: #f4811f !important;\n}\n#learnerlisting .colred,\n#learnerlisting .mat-sort-header-arrow {\n  color: #ed1c27 !important;\n}\n#learnerlisting .colpurple {\n  color: #d160d9;\n}\n#learnerlisting .batchIcon {\n  height: 10px;\n}\n#learnerlisting .leanertable1 {\n  width: 80%;\n  justify-content: space-between;\n}\n#learnerlisting .tablemenu button.mat-menu-item {\n  color: #FFF !important;\n}\n#learnerlisting .leanertable .leanertable1 .mat-flat-button .mat-button-wrapper i.fa {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #fff;\n}\n#learnerlisting .serachrow.mat-header-cell {\n  margin: 0px 10px;\n}\n#learnerlisting .serachrow.mat-header-cell:first-of-type {\n  padding: 0px !important;\n}\n#learnerlisting .mat-header-cell.exwid,\n#learnerlisting .serachrow.mat-header-cell.exwid {\n  min-width: 170px;\n  max-width: 170px;\n}\n#learnerlisting .topmenu .mat-menu-panel {\n  background-color: #616161 !important;\n}\n#learnerlisting .topmenu .mat-menu-panel button.mat-menu-item {\n  line-height: 36px !important;\n  height: 31px !important;\n  color: #fff !important;\n}\n#learnerlisting #batchcontainer .example-container {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#learnerlisting .mat-header-row:nth-child(1) {\n  background-color: #eaedf2;\n}\n#learnerlisting #searchrow .mat-form-field-wrapper {\n  padding-bottom: 0px;\n  padding-right: 35px;\n}\n#learnerlisting .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: gray;\n}\n#learnerlisting .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#learnerlisting .mat-paginator,\n#learnerlisting .mat-paginator-page-size .mat-select-trigger {\n  font-size: 14px;\n  width: 100%;\n}\n#dialog-box .text-left {\n  align-items: left;\n}\n#dialog-box .text-right {\n  align-items: end;\n}\n#dialog-box .mat-grid-tile .mat-figure {\n  display: block !important;\n}\n#dialog-box .m-0 {\n  padding: 0px;\n  margin: 0px;\n}\n#dialog-box .F-s {\n  font-size: 25px;\n  cursor: pointer;\n}\n#dialog-box .s-no {\n  color: #848484;\n  padding-right: 20px;\n}\n.mat-menu-item {\n  line-height: 36px;\n  height: 31px;\n  color: #fff;\n}\n.mat-menu-content {\n  background: #616161 !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9jYW5kaWRhdGVtYW5hZ2VtZW50L2xlYXJuZXJzbGlzdC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxjYW5kaWRhdGVtYW5hZ2VtZW50XFxsZWFybmVyc2xpc3RcXGxlYXJuZXJzbGlzdC5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9jYW5kaWRhdGVtYW5hZ2VtZW50L2xlYXJuZXJzbGlzdC9sZWFybmVyc2xpc3QuY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0k7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSw4QkFBQTtBQ0FSO0FERVE7RUFDSSxlQUFBO0VBQ0EsV0FBQTtFQUNBLGVBQUE7QUNBWjtBREVZO0VBQ0ksV0FBQTtBQ0FoQjtBREtJO0VBQ0ksaUJBQUE7QUNIUjtBRE9RO0VBQ0ksc0JBQUE7QUNMWjtBRFFRO0VBQ0ksYUFBQTtBQ05aO0FEU1E7RUFDSSxhQUFBO0FDUFo7QURVUTtFQUNJLGlCQUFBO0VBQ0EsWUFBQTtBQ1JaO0FEV1E7RUFDSSwrQkFBQTtBQ1RaO0FEV1k7RUFDSSx5QkFBQTtFQUNBLFlBQUE7RUFDQSxpQkFBQTtFQUNBLFlBQUE7QUNUaEI7QURZWTtFQUNJLGlCQUFBO0VBQ0EsWUFBQTtBQ1ZoQjtBRGVJO0VBQ0ksY0FBQTtFQUNBLGdCQUFBO0FDYlI7QURlUTtFQUNJLFdBQUE7RUFDQSx5QkFBQTtFQUNBLHNCQUFBO0VBQ0EsdUJBQUE7RUFDQSxnQkFBQTtBQ2JaO0FEZVk7RUFDSSxrQkFBQTtFQUNBLHVCQUFBO0VBQ0EsY0FBQTtFQUNBLHNCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7RUFDQSxpQkFBQTtBQ2JoQjtBRGdCWTtFQUNJLG9DQUFBO0FDZGhCO0FEaUJZO0VBQ0ksa0JBQUE7RUFDQSx1QkFBQTtFQUNBLE9BQUE7RUFDQSxzQkFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0VBQ0EsaUJBQUE7QUNmaEI7QURtQmdCO0VBQ0ksb0NBQUE7RUFDQSxlQUFBO0VBQ0EsZ0JBQUE7QUNqQnBCO0FEcUJZO0VBQ0kseUJBQUE7RUFDQSxlQUFBO0FDbkJoQjtBRHNCWTs7RUFFSSxrQkFBQTtFQUNBLHVCQUFBO0VBQ0EsZUFBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkFBQTtBQ3BCaEI7QUR5QlE7RUFDSSxhQUFBO0VBQ0EsWUFBQTtBQ3ZCWjtBRDBCUTtFQUNJLGtCQUFBO0VBQ0EsWUFBQTtBQ3hCWjtBRDhCQTtFQUNJLHVCQUFBO0FDM0JKO0FEOEJBO0VBQ0ksOEJBQUE7QUMzQko7QURpQ0k7RUFFSSxvQ0FBQTtBQy9CUjtBRG9DSTtFQUNJLGNBQUE7QUNsQ1I7QURxQ0k7RUFDSSwwQkFBQTtBQ25DUjtBRHNDSTtFQUNJLDBCQUFBO0FDcENSO0FEdUNJO0VBQ0ksY0FBQTtBQ3JDUjtBRHdDSTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ3RDUjtBRDJDUTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ3pDWjtBRCtDZ0I7RUFDSSxjQUFBO0FDN0NwQjtBRG9EUTtFQUNJLHlCQUFBO0FDbERaO0FEd0RRO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDdERaO0FENERZO0VBQ0ksMENBQUE7RUFDQSxjQUFBO0FDMURoQjtBRDREZ0I7RUFDSSxjQUFBO0FDMURwQjtBRCtEWTtFQUNJLHFCQUFBO0FDN0RoQjtBRG1FQTtFQUNJLDBCQUFBO0VBQ0EsbUNBQUE7QUNoRUo7QURvRUE7RUFDSSxhQUFBO0VBQ0Esc0JBQUE7RUFDQSxjQUFBO0VBQ0EsZUFBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFDQSxzQkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxzQkFBQTtBQ2pFSjtBRG1FSTtFQUNJLG1CQUFBO0FDakVSO0FEdUVZO0VBQ0kseUJBQUE7RUFDQSxXQUFBO0FDckVoQjtBRHVFZ0I7RUFDSSx5QkFBQTtBQ3JFcEI7QUQ0RUk7RUFDSSxXQUFBO0VBQ0Esa0JBQUE7QUMxRVI7QUQ2RUk7RUFDSSxXQUFBO0VBQ0EsYUFBQTtFQUNBLDJCQUFBO0VBQ0Esa0JBQUE7QUMzRVI7QUQ4RUk7RUFDSSxhQUFBO0VBQ0EsV0FBQTtFQUNBLGlCQUFBO0VBQ0EsMkJBQUE7QUM1RVI7QURnRkk7RUFDSSxXQUFBO0FDOUVSO0FEaUZJO0VBQ0ksWUFBQTtBQy9FUjtBRGtGSTtFQUNJLGlCQUFBO0VBQ0EsMkJBQUE7RUFDQSxnQkFBQTtBQ2hGUjtBRG1GSTtFQUNJLGdCQUFBO0VBQ0EsYUFBQTtBQ2pGUjtBRG9GSTtFQUNJLGNBQUE7QUNsRlI7QURxRkk7RUFDSSxhQUFBO0FDbkZSO0FEc0ZJO0VBQ0ksV0FBQTtBQ3BGUjtBRHVGSTtFQUNJLDRCQUFBO0FDckZSO0FEd0ZJO0VBQ0ksV0FBQTtBQ3RGUjtBRHlGSTtFQUNJLGNBQUE7QUN2RlI7QUQwRkk7RUFDSSx5QkFBQTtBQ3hGUjtBRDJGSTtFQUNJLHlCQUFBO0FDekZSO0FENEZJOztFQUVJLHlCQUFBO0FDMUZSO0FENkZJO0VBQ0ksY0FBQTtBQzNGUjtBRDhGSTtFQUNJLFlBQUE7QUM1RlI7QUQrRkk7RUFDSSxVQUFBO0VBQ0EsOEJBQUE7QUM3RlI7QURnR0k7RUFDSSxzQkFBQTtBQzlGUjtBRGlHSTtFQUNJLGtCQUFBO0VBQ0EsOEJBQUE7RUFDQSwrQkFBQTtBQy9GUjtBRHFHSTtFQUNJLGdCQUFBO0FDbkdSO0FEdUdJO0VBQ0ksdUJBQUE7QUNyR1I7QUR3R0k7O0VBRUksZ0JBQUE7RUFDQSxnQkFBQTtBQ3RHUjtBRDBHUTtFQUNJLG9DQUFBO0FDeEdaO0FEMEdZO0VBQ0ksNEJBQUE7RUFDQSx1QkFBQTtFQUNBLHNCQUFBO0FDeEdoQjtBRGtISTtFQUNJLGtCQUFBO0VBQ0EsVUFBQTtFQUNBLGNBQUE7RUFDQSxnQkFBQTtFQUNBLHNCQUFBO0VBQ0EsdUJBQUE7QUNoSFI7QURtSEk7RUFDSSx5QkFBQTtBQ2pIUjtBRHNISTtFQUNJLG1CQUFBO0VBQ0EsbUJBQUE7QUNwSFI7QUQwSFk7RUFDSSx5QkFBQTtFQUNBLFdBQUE7QUN4SGhCO0FEMEhnQjtFQUNJLHlCQUFBO0FDeEhwQjtBRCtISTs7RUFFSSxlQUFBO0VBQ0EsV0FBQTtBQzdIUjtBRG1JSTtFQUNJLGlCQUFBO0FDaElSO0FEbUlJO0VBQ0ksZ0JBQUE7QUNqSVI7QURvSUk7RUFDSSx5QkFBQTtBQ2xJUjtBRHFJSTtFQUNJLFlBQUE7RUFDQSxXQUFBO0FDbklSO0FEc0lJO0VBQ0ksZUFBQTtFQUNBLGVBQUE7QUNwSVI7QUR1SUk7RUFDSSxjQUFBO0VBQ0EsbUJBQUE7QUNySVI7QUQ4SUE7RUFDSSxpQkFBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0FDNUlKO0FEK0lBO0VBQ0ksOEJBQUE7QUM1SUoiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL2NhbmRpZGF0ZW1hbmFnZW1lbnQvbGVhcm5lcnNsaXN0L2xlYXJuZXJzbGlzdC5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIiNsZWFybmVybGlzdGluZyB7XHJcbiAgICAudGl0bGVpbmZvbGluayB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuXHJcbiAgICAgICAgLnZpZXdhbGxsaW5rIHtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxM3B4O1xyXG4gICAgICAgICAgICBjb2xvcjogIzY2NjtcclxuICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG5cclxuICAgICAgICAgICAgJjpob3ZlciB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYnV0dG9uYWxpZ24ge1xyXG4gICAgICAgIHRleHQtYWxpZ246IHJpZ2h0O1xyXG4gICAgfVxyXG5cclxuICAgIC5wYWdpbmF0b3ItYWRkLWZpbHRlciB7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzdGFydDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5leGFtcGxlLWJ1dHRvbi1yb3cge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LWZvY3VzLWluZGljYXRvciB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYnRuLW5vLXJhZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAlO1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYWRkLWZpbHRlci1idXR0b24ge1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGVuZCAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgLmJ0bi1kYW5nZXIge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgIGNvbG9yOiB3aGl0ZTtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAlO1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAuYnRuLXByaW1hcnkge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMCU7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNvdXJzZXNpbmZvdGJhbGUge1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcblxyXG4gICAgICAgIC5tYXQtY291cnNlaW5mbyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICBib3JkZXItY29sbGFwc2U6IGNvbGxhcHNlO1xyXG4gICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuXHJcbiAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGw6bnRoLWNoaWxkKDEpIHtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgZmxleDogMSAxIDUwcHg7XHJcbiAgICAgICAgICAgICAgICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xyXG4gICAgICAgICAgICAgICAgbWF4LXdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMjBweCAwcHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGw6bnRoLXJvdygyKSB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtY2VsbDpudGgtY2hpbGQoMSkge1xyXG4gICAgICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmbGV4OiAxO1xyXG4gICAgICAgICAgICAgICAgYm94LXNpemluZzogYm9yZGVyLWJveDtcclxuICAgICAgICAgICAgICAgIG1heC13aWR0aDogNTBweDtcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogNTBweDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAjc2VhcmNocm93IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4ZjggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLWhlaWdodDogNzNweDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1oZWFkZXItY2VsbCB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWhlYWRlci1jZWxsLFxyXG4gICAgICAgICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmbGV4OiAxIDEgMjAwcHg7XHJcbiAgICAgICAgICAgICAgICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xyXG4gICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAyMDBweDtcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMjAwcHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGF0ZV9ib3g+ZGl2PmRpdj5kaXYge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDU1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGF0ZV9pbWc+YnV0dG9uIHtcclxuICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICBib3R0b206IDE0cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxufVxyXG5cclxuLm1hdC1zb3J0LWhlYWRlci1jb250YWluZXIge1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbn1cclxuXHJcbi5wYWdpbmF0aW9uPi5tYXQtcGFnaW5hdG9yPmRpdj5kaXYge1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG59XHJcblxyXG4ubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuXHJcbiAgICAvLyAmLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgJi5tYXQtZm9ybS1maWVsZC1yZWFkb25seSB7XHJcbiAgICAgICAgLy8gLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcclxuICAgICAgICAvLyB9XHJcbiAgICAgICAgLy8gfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICBjb2xvcjogI2Q5ZDlkOTtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuXHJcbiAgICB9XHJcblxyXG4gICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICB9XHJcblxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgJi5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcblxyXG4gICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLS45cmVtKSBzY2FsZSgwLjc1KTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5cclxuLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcclxuICAgIHBhZGRpbmc6IDEwcHggMCAhaW1wb3J0YW50O1xyXG4gICAgYm9yZGVyLXRvcDogMC41ZW0gc29saWQgdHJhbnNwYXJlbnQ7XHJcbiB9XHJcblxyXG5cclxuI2xlYXJuZXJsaXN0aW5nIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xyXG4gICAgY29sb3I6ICM4NDg0ODQ7XHJcbiAgICBmb250LXNpemU6IDE0cHg7XHJcbiAgICBmb250LXdlaWdodDogNDAwO1xyXG4gICAgZm9udC1zdHlsZTogbm9ybWFsO1xyXG4gICAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcclxuICAgIGxpbmUtaGVpZ2h0OiAyMnB4O1xyXG4gICAgZm9udC1zdHlsZTogbm9ybWFsO1xyXG4gICAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcclxuXHJcbiAgICAubXItMSB7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAwLjVlbTtcclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuXHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIHtcclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6IGdyYXk7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5iYXRjaGhlYWRlciB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAzMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5iYXRjaGRldGFpbHMge1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMTBweDtcclxuICAgIH1cclxuXHJcbiAgICAuYmF0Y2hkZXRhaWxzMSB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBwYWRkaW5nOiAwcHggMjBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIHRhYmxlIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgIH1cclxuXHJcbiAgICB0aC5tYXQtc29ydC1oZWFkZXItc29ydGVkIHtcclxuICAgICAgICBjb2xvcjogYmxhY2s7XHJcbiAgICB9XHJcblxyXG4gICAgLmJhdGNoZGV0YWlscyAuYm9yIHtcclxuICAgICAgICBwYWRkaW5nOiAwcHggMTBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDVweDtcclxuICAgIH1cclxuXHJcbiAgICAuYmF0Y2hkZXRhaWxzIHAge1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCA4cHg7XHJcbiAgICAgICAgbWFyZ2luOiAycHggMDtcclxuICAgIH1cclxuXHJcbiAgICAuYmF0Y2hkZXRhaWxzIHNwYW4ge1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG5cclxuICAgIC5jbGZsZXgge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICB9XHJcblxyXG4gICAgLnJ3aWR0aCB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcblxyXG4gICAgLmJhdGNoZGV0YWlsczFpbm5lcmRpdiB7XHJcbiAgICAgICAgcGFkZGluZzogMTBweCAyMHB4IDEwcHggMTBweDtcclxuICAgIH1cclxuXHJcbiAgICAuYmF0Y2hkZXRhaWxzMWlubmVyZGl2IHAge1xyXG4gICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5mb250YmxhY2sge1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb2xncmVlbiB7XHJcbiAgICAgICAgY29sb3I6ICMwMGE1NTEgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAuY29sb3JhbmdlIHtcclxuICAgICAgICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb2xyZWQsXHJcbiAgICAubWF0LXNvcnQtaGVhZGVyLWFycm93IHtcclxuICAgICAgICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb2xwdXJwbGUge1xyXG4gICAgICAgIGNvbG9yOiAjZDE2MGQ5O1xyXG4gICAgfVxyXG5cclxuICAgIC5iYXRjaEljb24ge1xyXG4gICAgICAgIGhlaWdodDogMTBweDtcclxuICAgIH1cclxuXHJcbiAgICAubGVhbmVydGFibGUxIHtcclxuICAgICAgICB3aWR0aDogODAlO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgIH1cclxuXHJcbiAgICAudGFibGVtZW51IGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcclxuICAgICAgICBjb2xvcjogI0ZGRiAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5sZWFuZXJ0YWJsZSAubGVhbmVydGFibGUxIC5tYXQtZmxhdC1idXR0b24gLm1hdC1idXR0b24td3JhcHBlciBpLmZhIHtcclxuICAgICAgICBjb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS13aWR0aDogMXB4O1xyXG4gICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2UtY29sb3I6ICNmZmY7XHJcbiAgICB9XHJcblxyXG5cclxuXHJcblxyXG4gICAgLnNlcmFjaHJvdy5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgIG1hcmdpbjogMHB4IDEwcHg7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5zZXJhY2hyb3cubWF0LWhlYWRlci1jZWxsOmZpcnN0LW9mLXR5cGUge1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtaGVhZGVyLWNlbGwuZXh3aWQsXHJcbiAgICAuc2VyYWNocm93Lm1hdC1oZWFkZXItY2VsbC5leHdpZCB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxNzBweDtcclxuICAgICAgICBtYXgtd2lkdGg6IDE3MHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC50b3BtZW51IHtcclxuICAgICAgICAubWF0LW1lbnUtcGFuZWwge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNjE2MTYxICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICBidXR0b24ubWF0LW1lbnUtaXRlbSB7XHJcbiAgICAgICAgICAgICAgICBsaW5lLWhlaWdodDogMzZweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAzMXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC8vIC5leGFtcGxlLWNvbnRhaW5lciB7XHJcbiAgICAvLyAgICAgd2lkdGg6IDEyMzBweDtcclxuICAgIC8vICAgICBtYXgtd2lkdGg6IDEwMCU7XHJcbiAgICAvLyAgICAgb3ZlcmZsb3c6IGF1dG87XHJcbiAgICAvLyAgIH1cclxuICAgICNiYXRjaGNvbnRhaW5lciAuZXhhbXBsZS1jb250YWluZXIge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICB6LWluZGV4OiAxO1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LWhlYWRlci1yb3c6bnRoLWNoaWxkKDEpIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgfVxyXG5cclxuXHJcblxyXG4gICAgI3NlYXJjaHJvdyAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDBweDtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAzNXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5mb290ZXJwYWdpbmF0b3Ige1xyXG5cclxuICAgICAgICAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogZ3JheTtcclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1wYWdpbmF0b3IsXHJcbiAgICAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUgLm1hdC1zZWxlY3QtdHJpZ2dlciB7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgfVxyXG59XHJcblxyXG4jZGlhbG9nLWJveCB7XHJcblxyXG4gICAgLnRleHQtbGVmdCB7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGxlZnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLnRleHQtcmlnaHQge1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBlbmQ7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1ncmlkLXRpbGUgLm1hdC1maWd1cmUge1xyXG4gICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLm0tMCB7XHJcbiAgICAgICAgcGFkZGluZzogMHB4O1xyXG4gICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5GLXMge1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMjVweDtcclxuICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICB9XHJcblxyXG4gICAgLnMtbm8ge1xyXG4gICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDIwcHg7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1ncmlkLXRpbGUgLm1hdC1maWd1cmUge1xyXG4gICAgICAgIC8vIHBhZGRpbmctYm90dG9tOiAyMHB4O1xyXG4gICAgfVxyXG59XHJcblxyXG5cclxuLm1hdC1tZW51LWl0ZW0ge1xyXG4gICAgbGluZS1oZWlnaHQ6IDM2cHg7XHJcbiAgICBoZWlnaHQ6IDMxcHg7XHJcbiAgICBjb2xvcjogI2ZmZjtcclxufVxyXG5cclxuLm1hdC1tZW51LWNvbnRlbnQge1xyXG4gICAgYmFja2dyb3VuZDogIzYxNjE2MSAhaW1wb3J0YW50O1xyXG59IiwiI2xlYXJuZXJsaXN0aW5nIC50aXRsZWluZm9saW5rIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xufVxuI2xlYXJuZXJsaXN0aW5nIC50aXRsZWluZm9saW5rIC52aWV3YWxsbGluayB7XG4gIGZvbnQtc2l6ZTogMTNweDtcbiAgY29sb3I6ICM2NjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNsZWFybmVybGlzdGluZyAudGl0bGVpbmZvbGluayAudmlld2FsbGxpbms6aG92ZXIge1xuICBjb2xvcjogIzMzMztcbn1cbiNsZWFybmVybGlzdGluZyAuYnV0dG9uYWxpZ24ge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbiNsZWFybmVybGlzdGluZyAucGFnaW5hdG9yLWFkZC1maWx0ZXIgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAganVzdGlmeS1jb250ZW50OiBzdGFydDtcbn1cbiNsZWFybmVybGlzdGluZyAucGFnaW5hdG9yLWFkZC1maWx0ZXIgLmV4YW1wbGUtYnV0dG9uLXJvdyB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jbGVhcm5lcmxpc3RpbmcgLnBhZ2luYXRvci1hZGQtZmlsdGVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgLm1hdC1mb2N1cy1pbmRpY2F0b3Ige1xuICBkaXNwbGF5OiBub25lO1xufVxuI2xlYXJuZXJsaXN0aW5nIC5wYWdpbmF0b3ItYWRkLWZpbHRlciAuYnRuLW5vLXJhZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAlO1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jbGVhcm5lcmxpc3RpbmcgLnBhZ2luYXRvci1hZGQtZmlsdGVyIC5hZGQtZmlsdGVyLWJ1dHRvbiB7XG4gIGp1c3RpZnktY29udGVudDogZW5kICFpbXBvcnRhbnQ7XG59XG4jbGVhcm5lcmxpc3RpbmcgLnBhZ2luYXRvci1hZGQtZmlsdGVyIC5hZGQtZmlsdGVyLWJ1dHRvbiAuYnRuLWRhbmdlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjc7XG4gIGNvbG9yOiB3aGl0ZTtcbiAgYm9yZGVyLXJhZGl1czogMCU7XG4gIGhlaWdodDogNDVweDtcbn1cbiNsZWFybmVybGlzdGluZyAucGFnaW5hdG9yLWFkZC1maWx0ZXIgLmFkZC1maWx0ZXItYnV0dG9uIC5idG4tcHJpbWFyeSB7XG4gIGJvcmRlci1yYWRpdXM6IDAlO1xuICBoZWlnaHQ6IDQ1cHg7XG59XG4jbGVhcm5lcmxpc3RpbmcgLmNvdXJzZXNpbmZvdGJhbGUge1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbn1cbiNsZWFybmVybGlzdGluZyAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8ge1xuICB3aWR0aDogMTAwJTtcbiAgYm9yZGVyLWNvbGxhcHNlOiBjb2xsYXBzZTtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIG92ZXJmbG93LXg6IGF1dG87XG59XG4jbGVhcm5lcmxpc3RpbmcgLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvIC5tYXQtaGVhZGVyLWNlbGw6bnRoLWNoaWxkKDEpIHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZmxleDogMSAxIDUwcHg7XG4gIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XG4gIG1heC13aWR0aDogNTBweDtcbiAgbWluLXdpZHRoOiA1MHB4O1xuICBwYWRkaW5nOiAyMHB4IDBweDtcbn1cbiNsZWFybmVybGlzdGluZyAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1oZWFkZXItY2VsbDpudGgtcm93KDIpIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmOCAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAubWF0LWNlbGw6bnRoLWNoaWxkKDEpIHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZmxleDogMTtcbiAgYm94LXNpemluZzogYm9yZGVyLWJveDtcbiAgbWF4LXdpZHRoOiA1MHB4O1xuICBtaW4td2lkdGg6IDUwcHg7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAjc2VhcmNocm93IC5tYXQtaGVhZGVyLWNlbGwge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4ICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgbWluLWhlaWdodDogNzNweDtcbn1cbiNsZWFybmVybGlzdGluZyAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1oZWFkZXItY2VsbCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNsZWFybmVybGlzdGluZyAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1oZWFkZXItY2VsbCxcbiNsZWFybmVybGlzdGluZyAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1jZWxsIHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZmxleDogMSAxIDIwMHB4O1xuICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xuICBtYXgtd2lkdGg6IDIwMHB4O1xuICBtaW4td2lkdGg6IDIwMHB4O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5jb3Vyc2VzaW5mb3RiYWxlIC5kYXRlX2JveCA+IGRpdiA+IGRpdiA+IGRpdiB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGhlaWdodDogNTVweDtcbn1cbiNsZWFybmVybGlzdGluZyAuY291cnNlc2luZm90YmFsZSAuZGF0ZV9pbWcgPiBidXR0b24ge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGJvdHRvbTogMTRweDtcbn1cblxuLm1hdC1zb3J0LWhlYWRlci1jb250YWluZXIge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cblxuLnBhZ2luYXRpb24gPiAubWF0LXBhZ2luYXRvciA+IGRpdiA+IGRpdiB7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2Vlbjtcbn1cblxuLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1yZWFkb25seSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBjb2xvcjogI2Q5ZDlkOTtcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XG59XG4ubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzBjNGI5YTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbi5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTAuOXJlbSkgc2NhbGUoMC43NSk7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4ubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuXG4ubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBwYWRkaW5nOiAxMHB4IDAgIWltcG9ydGFudDtcbiAgYm9yZGVyLXRvcDogMC41ZW0gc29saWQgdHJhbnNwYXJlbnQ7XG59XG5cbiNsZWFybmVybGlzdGluZyB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW47XG4gIGNvbG9yOiAjODQ4NDg0O1xuICBmb250LXNpemU6IDE0cHg7XG4gIGZvbnQtd2VpZ2h0OiA0MDA7XG4gIGZvbnQtc3R5bGU6IG5vcm1hbDtcbiAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcbiAgbGluZS1oZWlnaHQ6IDIycHg7XG4gIGZvbnQtc3R5bGU6IG5vcm1hbDtcbiAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcbn1cbiNsZWFybmVybGlzdGluZyAubXItMSB7XG4gIG1hcmdpbi1yaWdodDogMC41ZW07XG59XG4jbGVhcm5lcmxpc3RpbmcgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG4gIGNvbG9yOiBncmF5O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xufVxuI2xlYXJuZXJsaXN0aW5nIC5iYXRjaGhlYWRlciB7XG4gIHdpZHRoOiAxMDAlO1xuICBwYWRkaW5nLWxlZnQ6IDMwcHg7XG59XG4jbGVhcm5lcmxpc3RpbmcgLmJhdGNoZGV0YWlscyB7XG4gIHdpZHRoOiAxMDAlO1xuICBkaXNwbGF5OiBmbGV4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG4gIHBhZGRpbmctbGVmdDogMTBweDtcbn1cbiNsZWFybmVybGlzdGluZyAuYmF0Y2hkZXRhaWxzMSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHdpZHRoOiAxMDAlO1xuICBwYWRkaW5nOiAwcHggMjBweDtcbiAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xufVxuI2xlYXJuZXJsaXN0aW5nIHRhYmxlIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jbGVhcm5lcmxpc3RpbmcgdGgubWF0LXNvcnQtaGVhZGVyLXNvcnRlZCB7XG4gIGNvbG9yOiBibGFjaztcbn1cbiNsZWFybmVybGlzdGluZyAuYmF0Y2hkZXRhaWxzIC5ib3Ige1xuICBwYWRkaW5nOiAwcHggMTBweDtcbiAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xuICBtYXJnaW46IDEwcHggNXB4O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5iYXRjaGRldGFpbHMgcCB7XG4gIHBhZGRpbmc6IDBweCA4cHg7XG4gIG1hcmdpbjogMnB4IDA7XG59XG4jbGVhcm5lcmxpc3RpbmcgLmJhdGNoZGV0YWlscyBzcGFuIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jbGVhcm5lcmxpc3RpbmcgLmNsZmxleCB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jbGVhcm5lcmxpc3RpbmcgLnJ3aWR0aCB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2xlYXJuZXJsaXN0aW5nIC5iYXRjaGRldGFpbHMxaW5uZXJkaXYge1xuICBwYWRkaW5nOiAxMHB4IDIwcHggMTBweCAxMHB4O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5iYXRjaGRldGFpbHMxaW5uZXJkaXYgcCB7XG4gIG1hcmdpbjogMHB4O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5mb250YmxhY2sge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNsZWFybmVybGlzdGluZyAuY29sZ3JlZW4ge1xuICBjb2xvcjogIzAwYTU1MSAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5jb2xvcmFuZ2Uge1xuICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5jb2xyZWQsXG4jbGVhcm5lcmxpc3RpbmcgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XG4gIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XG59XG4jbGVhcm5lcmxpc3RpbmcgLmNvbHB1cnBsZSB7XG4gIGNvbG9yOiAjZDE2MGQ5O1xufVxuI2xlYXJuZXJsaXN0aW5nIC5iYXRjaEljb24ge1xuICBoZWlnaHQ6IDEwcHg7XG59XG4jbGVhcm5lcmxpc3RpbmcgLmxlYW5lcnRhYmxlMSB7XG4gIHdpZHRoOiA4MCU7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2Vlbjtcbn1cbiNsZWFybmVybGlzdGluZyAudGFibGVtZW51IGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcbiAgY29sb3I6ICNGRkYgIWltcG9ydGFudDtcbn1cbiNsZWFybmVybGlzdGluZyAubGVhbmVydGFibGUgLmxlYW5lcnRhYmxlMSAubWF0LWZsYXQtYnV0dG9uIC5tYXQtYnV0dG9uLXdyYXBwZXIgaS5mYSB7XG4gIGNvbG9yOiB0cmFuc3BhcmVudDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS13aWR0aDogMXB4O1xuICAtd2Via2l0LXRleHQtc3Ryb2tlLWNvbG9yOiAjZmZmO1xufVxuI2xlYXJuZXJsaXN0aW5nIC5zZXJhY2hyb3cubWF0LWhlYWRlci1jZWxsIHtcbiAgbWFyZ2luOiAwcHggMTBweDtcbn1cbiNsZWFybmVybGlzdGluZyAuc2VyYWNocm93Lm1hdC1oZWFkZXItY2VsbDpmaXJzdC1vZi10eXBlIHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG59XG4jbGVhcm5lcmxpc3RpbmcgLm1hdC1oZWFkZXItY2VsbC5leHdpZCxcbiNsZWFybmVybGlzdGluZyAuc2VyYWNocm93Lm1hdC1oZWFkZXItY2VsbC5leHdpZCB7XG4gIG1pbi13aWR0aDogMTcwcHg7XG4gIG1heC13aWR0aDogMTcwcHg7XG59XG4jbGVhcm5lcmxpc3RpbmcgLnRvcG1lbnUgLm1hdC1tZW51LXBhbmVsIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzYxNjE2MSAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJsaXN0aW5nIC50b3BtZW51IC5tYXQtbWVudS1wYW5lbCBidXR0b24ubWF0LW1lbnUtaXRlbSB7XG4gIGxpbmUtaGVpZ2h0OiAzNnB4ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogMzFweCAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJsaXN0aW5nICNiYXRjaGNvbnRhaW5lciAuZXhhbXBsZS1jb250YWluZXIge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHotaW5kZXg6IDE7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBvdmVyZmxvdy14OiBhdXRvO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcbn1cbiNsZWFybmVybGlzdGluZyAubWF0LWhlYWRlci1yb3c6bnRoLWNoaWxkKDEpIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbn1cbiNsZWFybmVybGlzdGluZyAjc2VhcmNocm93IC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcbiAgcGFkZGluZy1ib3R0b206IDBweDtcbiAgcGFkZGluZy1yaWdodDogMzVweDtcbn1cbiNsZWFybmVybGlzdGluZyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbiAgY29sb3I6IGdyYXk7XG59XG4jbGVhcm5lcmxpc3RpbmcgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG59XG4jbGVhcm5lcmxpc3RpbmcgLm1hdC1wYWdpbmF0b3IsXG4jbGVhcm5lcmxpc3RpbmcgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplIC5tYXQtc2VsZWN0LXRyaWdnZXIge1xuICBmb250LXNpemU6IDE0cHg7XG4gIHdpZHRoOiAxMDAlO1xufVxuXG4jZGlhbG9nLWJveCAudGV4dC1sZWZ0IHtcbiAgYWxpZ24taXRlbXM6IGxlZnQ7XG59XG4jZGlhbG9nLWJveCAudGV4dC1yaWdodCB7XG4gIGFsaWduLWl0ZW1zOiBlbmQ7XG59XG4jZGlhbG9nLWJveCAubWF0LWdyaWQtdGlsZSAubWF0LWZpZ3VyZSB7XG4gIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG59XG4jZGlhbG9nLWJveCAubS0wIHtcbiAgcGFkZGluZzogMHB4O1xuICBtYXJnaW46IDBweDtcbn1cbiNkaWFsb2ctYm94IC5GLXMge1xuICBmb250LXNpemU6IDI1cHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNkaWFsb2ctYm94IC5zLW5vIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG4gIHBhZGRpbmctcmlnaHQ6IDIwcHg7XG59XG4ubWF0LW1lbnUtaXRlbSB7XG4gIGxpbmUtaGVpZ2h0OiAzNnB4O1xuICBoZWlnaHQ6IDMxcHg7XG4gIGNvbG9yOiAjZmZmO1xufVxuXG4ubWF0LW1lbnUtY29udGVudCB7XG4gIGJhY2tncm91bmQ6ICM2MTYxNjEgIWltcG9ydGFudDtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.ts":
  /*!************************************************************************************!*\
    !*** ./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.ts ***!
    \************************************************************************************/

  /*! exports provided: LearnerslistComponent, DialogBox */

  /***/
  function srcAppModulesCandidatemanagementLearnerslistLearnerslistComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "LearnerslistComponent", function () {
      return LearnerslistComponent;
    });
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "DialogBox", function () {
      return DialogBox;
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


    var _angular_material_table__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @angular/material/table */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
    /* harmony import */


    var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @ngx-translate/core */
    "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ngx-cookie-service */
    "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
    /* harmony import */


    var _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @angular/cdk/a11y */
    "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/a11y.js");
    /* harmony import */


    var _angular_material_sort__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! @angular/material/sort */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
    /* harmony import */


    var _app_services_learner_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(
    /*! @app/services/learner.service */
    "./src/app/services/learner.service.ts");
    /* harmony import */


    var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(
    /*! @angular/material/dialog */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
    /* harmony import */


    var _angular_router__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(
    /*! @app/services/assessmentReport.service */
    "./src/app/services/assessmentReport.service.ts");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(
    /*! sweetalert */
    "./node_modules/sweetalert/dist/sweetalert.min.js");
    /* harmony import */


    var sweetalert__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_13__);
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");

    var LearnerslistComponent = /*#__PURE__*/function () {
      function LearnerslistComponent(translate, remoteService, cookieService, _liveAnnouncer, learnerService, dialog, router, routes, assessmentService) {
        _classCallCheck(this, LearnerslistComponent);

        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this._liveAnnouncer = _liveAnnouncer;
        this.learnerService = learnerService;
        this.dialog = dialog;
        this.router = router;
        this.routes = routes;
        this.assessmentService = assessmentService;
        this.displayedColumns = ['checkbox', 'sir_idnumber', 'sir_name_en', 'sir_emailid', 'sir_dob', 'sir_gender', 'th_tutor', 'pra_tutor', 'asmt_staff', 'ivqastaff', 'lrhd_feestatus', 'rm_status_en', 'rm_status_ar', 'lrhd_status', 'action'];
        this.displaySearchColumns = ['row-first', 'row-second', 'row-three', 'row-four', 'row-five', 'row-six', 'row-seven', 'row-eight', 'row-nine', 'row-ten', 'row-eleven', 'row-twelve', 'row-thirteen', 'row-fourteen', 'row-fifteen'];
        this.tiles = [{
          text: 'Training Evaluation Center: National Training Institute',
          cols: 1,
          rows: 1,
          color: 'lightblue'
        }, {
          text: 'Batch No: 126465',
          cols: 1,
          rows: 1,
          color: 'lightpink'
        }, {
          text: 'Batch Type: Initial',
          cols: 1,
          rows: 1,
          color: '#DDBDF1'
        }];
        this.search = [{
          text: '',
          cols: 1,
          rows: 1,
          color: 'lightblue'
        }, {
          text: '',
          cols: 1,
          rows: 1,
          color: 'lightpink'
        }, {
          text: '',
          cols: 1,
          rows: 1,
          color: '#DDBDF1'
        }];
        this.batchdata_data = null;
        this.attendance_data = [];
        this.attendance_other_data = [];
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
        this.filter = false;
        this.gen_selection = [];
        this.learner_selection = [];
        this.knowledge_selection = [];
        this.practical_selection = [];
        this.status_selection = []; // none value

        this.filterValues = {
          sir_gender: [],
          sir_emailid: '',
          sir_idnumber: '',
          sir_name_en: '',
          th_tutor: '',
          pra_tutor: '',
          asmt_staff: '',
          ivqastaff: '',
          lrhd_feestatus: [],
          rm_status_en: [],
          rm_status_ar: [],
          lrhd_status: []
        };
        this.selectAll = false;
        this.actionOption = ['Update Assessment Report', 'Retake Assessment', 'View Card', 'Print Card', 'View & Approve'];
        this.page = 5;
        this.filterForm = new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormGroup"]({
          sir_gender: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          sir_emailid: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          sir_idnumber: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          sir_name_en: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          th_tutor: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          pra_tutor: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          asmt_staff: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          ivqastaff: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          lrhd_feestatus: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          rm_status_en: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          rm_status_ar: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"](),
          lrhd_status: new _angular_forms__WEBPACK_IMPORTED_MODULE_14__["FormControl"]()
        });
      }

      _createClass(LearnerslistComponent, [{
        key: "openDialog",
        value: function openDialog() {
          this.dialog.open(DialogBox, {
            width: '40%',
            height: '30%'
          });
        }
      }, {
        key: "registerPage",
        value: function registerPage() {
          this.router.navigate(['/candidatemanagement/learner-register']);
        }
      }, {
        key: "actionRoute",
        value: function actionRoute(id, type) {
          if (type == 'assessment') {
            this.router.navigate(['/assessmentreport/assessmentreport/' + id]);
          } else {
            this.router.navigate(['/assessmentreport/viewandapprove/' + id]);
          }
        }
      }, {
        key: "sir_gender",
        get: function get() {
          return this.filterForm.get('sir_gender');
        }
      }, {
        key: "sir_emailid",
        get: function get() {
          return this.filterForm.get('sir_emailid');
        }
      }, {
        key: "sir_idnumber",
        get: function get() {
          return this.filterForm.get('sir_idnumber');
        }
      }, {
        key: "sir_name_en",
        get: function get() {
          return this.filterForm.get('sir_name_en');
        }
      }, {
        key: "th_tutor",
        get: function get() {
          return this.filterForm.get('th_tutor');
        }
      }, {
        key: "pra_tutor",
        get: function get() {
          return this.filterForm.get('pra_tutor');
        }
      }, {
        key: "asmt_staff",
        get: function get() {
          return this.filterForm.get('asmt_staff');
        }
      }, {
        key: "ivqastaff",
        get: function get() {
          return this.filterForm.get('ivqastaff');
        }
      }, {
        key: "lrhd_feestatus",
        get: function get() {
          return this.filterForm.get('lrhd_feestatus');
        }
      }, {
        key: "rm_status_en",
        get: function get() {
          return this.filterForm.get('rm_status_en');
        }
      }, {
        key: "rm_status_ar",
        get: function get() {
          return this.filterForm.get('rm_status_ar');
        }
      }, {
        key: "lrhd_status",
        get: function get() {
          return this.filterForm.get('lrhd_status');
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this19 = this;

          if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
            var toSelect = this.languagelist.find(function (c) {
              return c.id === _this19.cookieService.get('languageCookieId');
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
            _this19.translate.setDefaultLang(_this19.cookieService.get('languageCode'));

            if (_this19.cookieService.get('languageCookieId') && _this19.cookieService.get('languageCookieId') != undefined && _this19.cookieService.get('languageCookieId') != null) {
              var _toSelect5 = _this19.languagelist.find(function (c) {
                return c.id === _this19.cookieService.get('languageCookieId');
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this19.translate.setDefaultLang(_toSelect5.languagecode);

              _this19.dir = _toSelect5.dir;
            } else {
              var _toSelect6 = _this19.languagelist.find(function (c) {
                return c.id == '1';
              }); //this.patientCategory.get('patientCategory').setValue(toSelect);


              _this19.translate.setDefaultLang(_toSelect6.languagecode);

              _this19.dir = _toSelect6.dir;
            }
          });
          this.routes.paramMap.subscribe(function (params) {
            // console.log("params",);
            var param = {
              bid: params.get('batch')
            };

            _this19.getbatchdtls(params.get('batch'));

            _this19.learnerService.getbranchinfo(param).subscribe(function (data) {
              // this.batchDetail = data.data.data
              _this19.company = data.data.data.branch_info.omrm_companyname_en;
              _this19.batch_no = data.data.data.batch_info.bmd_Batchno;
            });

            _this19.learnerService.getLearnerList(param).subscribe(function (data) {
              _this19.learnerdata_data = data.data.data;
              _this19.learnerdata = new _angular_material_table__WEBPACK_IMPORTED_MODULE_3__["MatTableDataSource"](data.data.data);
              console.log('this.learnerdata', _this19.learnerdata);
              _this19.learnerdata.paginator = _this19.paginator;
              _this19.learnerdata.sort = _this19.sort;
              console.log("test,", _this19.learnerdata_data);

              _this19.getFormsValue();
            });
          });
          this.formSubscribe(); // this.getFormsValue();
        } // form subscribe

      }, {
        key: "formSubscribe",
        value: function formSubscribe() {
          var _this20 = this;

          this.sir_gender.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['sir_gender'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.sir_emailid.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['sir_emailid'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.sir_idnumber.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['sir_idnumber'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.sir_name_en.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['sir_name_en'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.th_tutor.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['th_tutor'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.pra_tutor.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['pra_tutor'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.asmt_staff.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['asmt_staff'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.ivqastaff.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['ivqastaff'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.lrhd_feestatus.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['lrhd_feestatus'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.rm_status_en.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['rm_status_en'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.rm_status_ar.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['rm_status_ar'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
          this.lrhd_status.valueChanges.subscribe(function (positionValue) {
            _this20.filterValues['lrhd_status'] = positionValue;
            _this20.learnerdata.filter = JSON.stringify(_this20.filterValues);
          });
        } // create filter

      }, {
        key: "getFormsValue",
        value: function getFormsValue() {
          var _this21 = this;

          this.learnerdata.filterPredicate = function (data, filter) {
            var _a, _b, _c, _d, _e, _f, _g;

            var searchString = JSON.parse(filter);
            var isPositionAvailable = false;

            if (_this21.gen_selection.length > 0) {
              isPositionAvailable = _this21.gen_selection.some(function (version) {
                return version == data.sir_gender;
              });
            } else if (_this21.learner_selection.length > 0) {
              isPositionAvailable = _this21.learner_selection.some(function (version) {
                return version == data.lrhd_feestatus;
              });
            } else if (_this21.knowledge_selection.length) {
              isPositionAvailable = _this21.knowledge_selection.some(function (version) {
                return version == data.rm_status_en;
              });
            } else if (_this21.practical_selection.length) {
              isPositionAvailable = _this21.practical_selection.some(function (version) {
                return version == data.rm_status_ar;
              });
            } else if (_this21.status_selection.length) {
              isPositionAvailable = _this21.status_selection.some(function (version) {
                return version == data.lrhd_status;
              });
            } else {
              isPositionAvailable = true;
            }

            var resultValue = isPositionAvailable && data.sir_name_en.toString().trim().toLowerCase().indexOf((_a = searchString.sir_name_en) === null || _a === void 0 ? void 0 : _a.toLowerCase()) !== -1 && data.sir_emailid.toString().trim().toLowerCase().indexOf(searchString.sir_emailid.toLowerCase()) !== -1 && data.sir_idnumber.toString().trim().toLowerCase().indexOf((_b = searchString.sir_idnumber) === null || _b === void 0 ? void 0 : _b.toLowerCase()) !== -1 && data.sir_name_en.toString().trim().toLowerCase().indexOf((_c = searchString.sir_name_en) === null || _c === void 0 ? void 0 : _c.toLowerCase()) !== -1 && data.th_tutor.toString().trim().toLowerCase().indexOf((_d = searchString.th_tutor) === null || _d === void 0 ? void 0 : _d.toLowerCase()) !== -1 && data.pra_tutor.toString().trim().toLowerCase().indexOf((_e = searchString.pra_tutor) === null || _e === void 0 ? void 0 : _e.toLowerCase()) !== -1 && data.asmt_staff.toString().trim().toLowerCase().indexOf((_f = searchString.asmt_staff) === null || _f === void 0 ? void 0 : _f.toLowerCase()) !== -1 && data.ivqastaff.toString().trim().toLowerCase().indexOf((_g = searchString.ivqastaff) === null || _g === void 0 ? void 0 : _g.toLowerCase()) !== -1;
            return resultValue;
          };

          this.learnerdata.filter = JSON.stringify(this.filterValues);
        } //   applyFilter() {
        //     this.learnerdata.filter = 'only used to trigger filter';
        //  // console.log(dataSource) 
        //   if (this.learnerdata.paginator) {
        //     this.learnerdata.paginator.firstPage();
        //   }
        // }

      }, {
        key: "syncPrimaryPaginator",
        value: function syncPrimaryPaginator(event) {
          this.paginator.pageIndex = event.pageIndex;
          this.paginator.pageSize = event.pageSize;
          this.page = event.pageSize;
        }
      }, {
        key: "getbatchdtls",
        value: function getbatchdtls(id) {
          var _this22 = this;

          this.assessmentService.getbatchdtls(id).subscribe(function (data) {
            _this22.batchdata_data = data.data.data;
          });
        }
      }, {
        key: "getassessmentstatus",
        value: function getassessmentstatus(no) {
          //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
          if (no == 1) {
            return 'New';
          } else if (no == 2) {
            return 'Teaching(theory)';
          } else if (no == 3) {
            return 'Teaching(practical)';
          } else if (no == 4) {
            return 'Assessment';
          } else if (no == 5) {
            return 'Requested for Back Track';
          } else if (no == 6) {
            return 'Quality Check';
          } else if (no == 7) {
            return 'Cancelled';
          } else if (no == 8) {
            return 'Print';
          } else if (no == 9) {
            return 'Requested for Assessor change';
          } else {
            return '';
          }
        } // applyFilter(event: any) {
        //   console.log("filter",event);
        //   const filterValue = event.value;
        //   console.log("filter",filterValue);
        //   this.learnerdata.filter = filterValue.trim().toLowerCase();
        // }

        /**
          * This functions is show filter display and hide
          */

      }, {
        key: "showFilter",
        value: function showFilter() {
          this.filter = !this.filter;

          if (!this.filter) {
            var id = document.getElementById('searchrow');
            id.style.display = 'flex';
          } else {
            var _id3 = document.getElementById('searchrow');

            _id3.style.display = 'none';
          }
        }
      }, {
        key: "getage",
        value: function getage(dob) {
          var date1 = new Date();
          var date2 = new Date(dob);
          var diff = Math.floor(date1.getTime() - date2.getTime());
          var day = 1000 * 60 * 60 * 24;
          var days = Math.floor(diff / day);
          var months = Math.floor(days / 31);
          var years = Math.floor(months / 12);
          var message = years;
          return message;
        }
      }, {
        key: "getstatus",
        value: function getstatus(key) {
          key = parseInt(key);

          switch (key) {
            case 1:
              return 'New';
              break;

            case 2:
              return 'Teaching(theory)';
              break;

            case 3:
              return 'Teaching(practical)';
              break;

            case 4:
              return 'No Show(theory)';
              break;

            case 5:
              return 'No Show(practical)';
              break;

            case 6:
              return 'Assessment';
              break;

            case 7:
              return 'Quality Check';
              break;

            case 8:
              return 'Declined during Quality Check';
              break;

            case 9:
              return 'Resubmitted for Quality Check';
              break;

            case 10:
              return 'Print';
              break;

            case 11:
              return 'Completed';
              break;

            case 12:
              return 'Re-take Assesment';
              break;

            default:
              break;
          }
        }
      }, {
        key: "getstatuscolor",
        value: function getstatuscolor(key) {
          key = parseInt(key);

          switch (key) {
            case 1:
              return '#F4811F';
              break;

            case 2:
              return '#F4811F';
              break;

            case 3:
              return '#F4811F';
              break;

            case 4:
              return '#242E2E';
              break;

            case 5:
              return '#242E2E';
              break;

            case 6:
              return '#C330CE';
              break;

            case 7:
              return '#0C4B9A';
              break;

            case 8:
              return '#0C4B9A';
              break;

            case 9:
              return '#0C4B9A';
              break;

            case 10:
              return '#0C4B9A';
              break;

            case 11:
              return '#00A551';
              break;

            case 12:
              return '#0C4B9A';
              break;

            default:
              break;
          }
        }
      }, {
        key: "announceSortChange",
        value: function announceSortChange(sortState) {
          if (sortState.direction) {
            this._liveAnnouncer.announce("Sorted ".concat(sortState.direction, "ending"));
          } else {
            this._liveAnnouncer.announce('Sorting cleared');
          }
        }
      }, {
        key: "isAllSelected",
        value: function isAllSelected(event) {
          if (event.checked == true) {
            this.selectAll = true;
            var learner = this.attendance_data.length > 0 ? this.attendance_data : [];
            var attendance = this.attendance_other_data.length > 0 ? this.attendance_other_data : [];
            var data = this.learnerdata_data.map(function (value, key) {
              if (value.tad_learnerreghrddtls_fk) {
                learner[key] = value.tad_learnerreghrddtls_fk;
                attendance[key] = value;
              }
            });
            this.attendance_data = learner;
            this.attendance_other_data = attendance;
          } else {
            this.selectAll = false;
            this.attendance_data = [];
            this.attendance_other_data = [];
          }
        }
      }, {
        key: "markAttendance",
        value: function markAttendance(Status, data) {
          // console.log("status",Status+lid);
          var post_data = {
            tad_attended: Status,
            tad_trngdate: new Date(),
            tad_learnerreghrddtls_fk: [data.tad_learnerreghrddtls_fk],
            tad_batchmgmtthyhdr_fk: data.tad_batchmgmtthyhdr_fk,
            tad_batchmgmtpracthdr_fk: data.tad_batchmgmtpracthdr_fk,
            tad_batchmgmtdtls_fk: data.tad_batchmgmtdtls_fk,
            tad_batchmgmtdurationdtls_fk: data.tad_batchmgmtdurationdtls_fk
          };
          this.attendanceEndPoint(post_data);
        }
      }, {
        key: "selectCheckbox",
        value: function selectCheckbox(event, data) {
          var learner = this.attendance_data.length > 0 ? this.attendance_data : [];
          var attendance = this.attendance_other_data.length > 0 ? this.attendance_other_data : [];

          if (event.checked == true) {
            learner.push(data.tad_learnerreghrddtls_fk);
            attendance.push(data);
          } else if (event.checked == false) {
            learner = learner.filter(function (value) {
              if (value !== data.tad_learnerreghrddtls_fk) {
                return value;
              }
            });
            attendance = attendance.length > 0 && attendance.filter(function (value) {
              if (value.tad_learnerreghrddtls_fk !== data.tad_learnerreghrddtls_fk) {
                return value;
              }
            });
          }

          this.attendance_data = learner;
          this.attendance_other_data = attendance;
        }
      }, {
        key: "bulkAttendance",
        value: function bulkAttendance(status) {
          var data = this.attendance_other_data;

          if (data.length > 0) {
            var post_data = {
              tad_attended: status,
              tad_trngdate: new Date(),
              tad_learnerreghrddtls_fk: this.attendance_data,
              tad_batchmgmtthyhdr_fk: data[0].tad_batchmgmtthyhdr_fk,
              tad_batchmgmtpracthdr_fk: data[0].tad_batchmgmtpracthdr_fk,
              tad_batchmgmtdtls_fk: data[0].tad_batchmgmtdtls_fk,
              tad_batchmgmtdurationdtls_fk: data[0].tad_batchmgmtdurationdtls_fk
            };
            this.attendanceEndPoint(post_data);
          } else {
            sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
              title: 'Oops...',
              text: 'Please select atleas one user'
            });
          }
        }
      }, {
        key: "attendanceEndPoint",
        value: function attendanceEndPoint(post_data) {
          this.learnerService.markattendance(post_data).subscribe(function (res) {
            if (res.data.msg == "success") {
              sweetalert__WEBPACK_IMPORTED_MODULE_13___default()('Attendance submitted Successfully', 'Success');
            } else {
              sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
                title: 'Oops...',
                text: 'Attendance already registered'
              });
            }
          });
        }
      }, {
        key: "moveStatus",
        value: function moveStatus(status) {
          var post_data = {
            learnerreghrddtls_pk: this.attendance_data,
            lrhd_status: status
          };
          this.statusEndPoint(post_data);
        }
      }, {
        key: "statusEndPoint",
        value: function statusEndPoint(post_data) {
          this.learnerService.learnerMoveStatus(post_data).subscribe(function (res) {
            if (res.data.msg == "success") {
              sweetalert__WEBPACK_IMPORTED_MODULE_13___default()('Status update Successfully', 'Success');
            } else {
              sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
                title: 'Oops...',
                text: 'Status not updated Successfully'
              });
            }
          });
        }
      }, {
        key: "printcard",
        value: function printcard() {//   swal({
          //     title: "An input!",
          //     text: "Write something interesting:",
          //     input: 'text',
          //     buttons:['Clear', 'Print'],
          //   }).then(() => {
          //     //this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);
          //   });
          // swal({  
          //   title: "Add input!",  
          //   text: "Some text add:",  
          //   type: "input",  
          //   buttons:['Clear', 'Print'],
          //   inputPlaceholder: "Write text"  
          // }, function (inputValue) {  
          //   if (inputValue === false) return false;  
          //   if (inputValue === "") {  
          //     swal.showInputError("Some need to write!");  
          //     return false  
          //   }  
          //   swal("GOOD!", "You wrote: " + inputValue, "confirm success");  
          // });  
        }
      }]);

      return LearnerslistComponent;
    }();

    LearnerslistComponent.ctorParameters = function () {
      return [{
        type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_4__["TranslateService"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"]
      }, {
        type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__["CookieService"]
      }, {
        type: _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_7__["LiveAnnouncer"]
      }, {
        type: _app_services_learner_service__WEBPACK_IMPORTED_MODULE_9__["LearnerService"]
      }, {
        type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_10__["MatDialog"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_11__["Router"]
      }, {
        type: _angular_router__WEBPACK_IMPORTED_MODULE_11__["ActivatedRoute"]
      }, {
        type: _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_12__["AssessmentReportService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__["MatPaginator"])], LearnerslistComponent.prototype, "paginator", void 0);
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_8__["MatSort"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_8__["MatSort"])], LearnerslistComponent.prototype, "sort", void 0);
    LearnerslistComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-learnerslist',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./learnerslist.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./learnerslist.component.scss */
      "./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_4__["TranslateService"], _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"], ngx_cookie_service__WEBPACK_IMPORTED_MODULE_6__["CookieService"], _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_7__["LiveAnnouncer"], _app_services_learner_service__WEBPACK_IMPORTED_MODULE_9__["LearnerService"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_10__["MatDialog"], _angular_router__WEBPACK_IMPORTED_MODULE_11__["Router"], _angular_router__WEBPACK_IMPORTED_MODULE_11__["ActivatedRoute"], _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_12__["AssessmentReportService"]])], LearnerslistComponent);

    var DialogBox = /*#__PURE__*/_createClass(function DialogBox() {
      _classCallCheck(this, DialogBox);
    });

    DialogBox = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'dialog-box',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./dialog-box.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/candidatemanagement/learnerslist/dialog-box.component.html"))["default"],
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./learnerslist.component.scss */
      "./src/app/modules/candidatemanagement/learnerslist/learnerslist.component.scss"))["default"]]
    })], DialogBox);
    /***/
  },

  /***/
  "./src/app/services/learner.service.ts":
  /*!*********************************************!*\
    !*** ./src/app/services/learner.service.ts ***!
    \*********************************************/

  /*! exports provided: LearnerService */

  /***/
  function srcAppServicesLearnerServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "LearnerService", function () {
      return LearnerService;
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

    var LearnerService = /*#__PURE__*/function () {
      function LearnerService(http) {
        _classCallCheck(this, LearnerService);

        this.http = http;
        this.url = 'bm/batchmanagement/';
      }

      _createClass(LearnerService, [{
        key: "getLearnerList",
        value: function getLearnerList(bid) {
          // return this.http.get(this.url + 'get-staff-detail').map(res => res.json());
          return this.http.post(this.url + 'getlearnerlist', bid).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "registerLearner",
        value: function registerLearner(data) {
          return this.http.post(this.url + 'learner-register', data).map(function (response) {
            return response.json();
          });
          ;
        }
      }, {
        key: "saveAcademics",
        value: function saveAcademics(data) {
          return this.http.post(this.url + 'learneracademics', data).map(function (response) {
            return response.json();
          });
        }
      }, {
        key: "saveWorkexp",
        value: function saveWorkexp(data) {
          return this.http.post(this.url + 'saveworkexplist', data).map(function (response) {
            return response.json();
          });
        }
      }, {
        key: "getEduList",
        value: function getEduList(data) {
          return this.http.post(this.url + 'getlearneredulist', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getExpList",
        value: function getExpList(data) {
          return this.http.post(this.url + 'getworkexplist', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getbranchinfo",
        value: function getbranchinfo(data) {
          return this.http.post(this.url + 'getbranchinfo', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "markattendance",
        value: function markattendance(data) {
          return this.http.post(this.url + 'learnerattendance', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "learnerMoveStatus",
        value: function learnerMoveStatus(data) {
          return this.http.post(this.url + 'learnermovestatus', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "learnercoursefee",
        value: function learnercoursefee(data) {
          return this.http.post(this.url + 'getlearnerfee', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "checkLearner",
        value: function checkLearner(civilnumval, repo) {
          //checklearner
          var body = JSON.stringify({
            'civilnumval': civilnumval,
            'repo': repo
          });
          return this.http.post(this.url + "checklearner", body).map(function (res) {
            return res.json();
          });
        }
      }]);

      return LearnerService;
    }();

    LearnerService.ctorParameters = function () {
      return [{
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]
      }];
    };

    LearnerService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]])], LearnerService);
    /***/
  }
}]);
//# sourceMappingURL=modules-candidatemanagement-candidatemanagement-module-es5.js.map