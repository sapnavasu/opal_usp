(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-assessmentreport-assessmentreport-module"],{

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.html":
/*!*********************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.html ***!
  \*********************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayoutAlign=\"center\" id=\"assessmentreport\" class=\"assessmentreport\"  *ngIf=\"learnerData!=null && !formloading\">\r\n    <div class=\"batchheader clflex flex-column rwidth\">\r\n        <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n            <p>Batch No.: <span class=\"colblack\">{{learnerData.batchNo}}</span></p>\r\n            <p>Civil Number: <span class=\"colblack\">{{learnerData.civilNumber}}</span></p>\r\n        </div>\r\n        <div>\r\n            <p class=\"colblack\"><b>{{learnerData.name}}</b></p>\r\n        </div>\r\n        <div fxLayout=\"row \" class=\"clflex rwidth batchinnerdiv\">\r\n            <p>Status: <span class=\"colpurple\">{{getassessmentstatus(learnerData.status)}}</span></p>\r\n            <p *ngIf=\"learnerData.isknw == 1\">Knowledge Assessment: \r\n                <span [ngSwitch]=\"learnerData.kStatus\">\r\n                    <span *ngSwitchCase=\"'Pass'\" class=\"colgreen\">{{learnerData.kStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Fail'\" class=\"colred\">{{learnerData.kStatus}}</span>\r\n                    <span *ngSwitchDefault class=\"colorange\">Pending</span>\r\n                </span>\r\n            </p>\r\n            <p *ngIf=\"learnerData.ispra == 1\">Practical Assessment: \r\n                <span [ngSwitch]=\"learnerData.pStatus\">\r\n                    <span *ngSwitchCase=\"'Pass'\" class=\"colgreen\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Fail'\" class=\"colred\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Competent'\" class=\"colgreen\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Non-Competent'\" class=\"colred\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchDefault  class=\"colorange\">Pending</span>\r\n                </span>\r\n            </p>\r\n            <p> Email ID: <span class=\"colblack\">{{learnerData.emailId}}</span></p>\r\n            <p> Age: <span class=\"colblack\">{{learnerData.age}}</span></p>\r\n            <p>Gender: <span class=\"colblack\">{{learnerData.gender == 1 ? 'Male' : 'Female'}}</span></p>\r\n        </div>\r\n    </div>\r\n    <div class=\"qualitycheckstatus\" *ngIf=\"learnerData.comment !=null\">\r\n        <div class=\"qcinnerf\">\r\n            <p class=\"fpara\">Comments</p>\r\n            <p [innerHTML]=\"learnerData.comment\"></p>\r\n        </div>\r\n        <div class=\"qcinners clflex\">\r\n            <p>Last validation on: <span>{{learnerData.commentOn | date : 'dd-MM-YYYY'}}</span></p>\r\n            <p class=\"p-l-40\">Last validation By: <span>{{learnerData.commentBy}}</span></p>\r\n        </div>\r\n    </div>\r\n    <div class=\"assessment clflex flex-column   mat-tab-label\" fxFlex=\"60\" *ngIf=\"learnerData != null && learnerData.isknw == 1 && learnerData.ispra == 1\">\r\n        <div fxLayout=\"row\" fxLayoutGap=\"20px\" class=\"clflex\">\r\n            <button mat-flat-button class=\"btnbac\"    [ngClass]=\"btnactive ? '' : 'active'\" fxFlex=\"40\">Knowledge Assessement</button>\r\n            <button mat-flat-button class=\"btnbac\"   [ngClass]=\"!btnactive ? '' : 'active'\" fxFlex=\"40\">Practical Assessment</button>\r\n        </div>\r\n    </div>\r\n    <form [formGroup]=\"assessmentReportForm\" class=\"clflex flex-column \" (ngSubmit)=\"onSubmit('knowleadge')\" *ngIf=\"!btnactive && assessmentType == 'Knowleadge'\">\r\n        <!-- <div fxFlex=\"60\"  class=\"clflex \">\r\n            <div class=\"clflex flex-column  mat-tab-label\" fxFlex=\"60\">\r\n                <div class=\"selectupload clflex flex-column   mat-tab-label\" >\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Select Assessement type</mat-label> \r\n                        <mat-select [(ngModel)]=\"examType\"  formControlName=\"examType\" >\r\n                            <mat-option value=\"1\">Upload Scanned File(Physical)</mat-option>\r\n                            <mat-option value=\"2\">Online Assessement Form</mat-option> \r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </div>\r\n            </div>\r\n        </div> -->\r\n        <div class=\"uploadknowledgeassessment rwidth Report clflex flex-column\"  fxFlex=\"100\"  *ngIf=\"examType == 1 && !btnactive\">\r\n            <div >\r\n                <div class=\"clflex flex-column p-t-20\"  >\r\n                    <mat-label>Upload Assessment Report<span class=\"colred\">*</span></mat-label>\r\n                    <app-filee #kdoc [fileMstRef]=\"knw_file\"\r\n                                   (filesSelected)=\"fileeSelected($event,knw_file)\" formControlName=\"file\"\r\n                                   [notePosition]=\"'bottom'\">\r\n                                 </app-filee>\r\n                    <mat-hint>Only (1) JPG, JPEG, PNG, PDF are allowed up to 3MB in size</mat-hint>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row\" fxLayoutGap=\"20px\" class=\"clflex m-t-20\">\r\n                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                    <mat-label>Total Mark</mat-label>\r\n                    <input matInput  formControlName=\"mark\">\r\n                </mat-form-field>\r\n                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                    <mat-label>Percentage</mat-label>\r\n                    <input matInput  formControlName=\"percentage\">\r\n                </mat-form-field>\r\n            </div>\r\n        </div>\r\n        <div class=\"onlineknowledgeassessment Report clflex flex-column\"  *ngIf=\"examType == 2 && !btnactive\">\r\n            <div fxFlex=\"60\">\r\n                <div class=\"clflex flex-column m-b-20\"  fxFlex=\"60\">\r\n                    <p class=\"colblack\" fxFlex=\"60\">Fill the Assessment Report of the selected Learner.</p>\r\n                    <div  *ngFor=\"let item of questions; let i = index\" [value]=\"index\">\r\n                        <label id=\"example-radio-group-label\" >{{i+1}}. {{item.question}}</label>\r\n                            <mat-radio-group\r\n                            aria-labelledby=\"example-radio-group-label\"\r\n                            class=\"example-radio-group\"\r\n                            [(ngModel)]=\"favoriteSeason\">\r\n                            <mat-radio-button class=\"example-radio-button\" *ngFor=\"let answer of item.answers\" [value]=\"answer\">\r\n                                {{answer}}\r\n                            </mat-radio-button>\r\n                            </mat-radio-group>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row\" fxLayoutGap=\"20px\" class=\"clflex  \">\r\n                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                    <mat-label>Total Mark</mat-label>\r\n                    <input matInput value=\"20\">\r\n                </mat-form-field>\r\n                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                    <mat-label>Percentage</mat-label>\r\n                    <input matInput value=\"50%\">\r\n                </mat-form-field>\r\n            </div>\r\n\r\n        </div>\r\n        <div class=\"clflex flex-column\">\r\n            <mat-form-field class=\"comments colblack\" appearance=\"outline\">\r\n                <mat-label>Comments</mat-label>\r\n                <textarea matInput  formControlName=\"comments\" placeholder=\"Comments\"></textarea>\r\n                    <mat-hint class=\" clflex \">0/1000</mat-hint>\r\n            </mat-form-field>\r\n        </div>\r\n        <div class=\"buttonalign\">\r\n            <button mat-stroked-button class=\"btnwhite\">Cancel</button>\r\n            <button mat-raised-button class=\"btnred\" type=\"submit\"  *ngIf=\"learnerData != null && learnerData.isknw == 1 && learnerData.ispra == 1\" [disabled]=\"!assessmentReportForm.valid\">Save & Next</button>\r\n            <button mat-raised-button class=\"btnred\" type=\"submit\"  *ngIf=\"learnerData != null && learnerData.isknw == 1 && learnerData.ispra != 1\" [disabled]=\"!assessmentReportForm.valid\">Submit</button>\r\n        </div>\r\n    </form>\r\n    <form [formGroup]=\"assessmentReportPraticalForm\" class=\"clflex flex-column \" (ngSubmit)=\"onSubmit('pratical')\"  *ngIf=\"btnactive&& assessmentType == 'pratical'\">\r\n        <!-- <div fxFlex=\"60\"  class=\"clflex \">\r\n            <div class=\"clflex flex-column  mat-tab-label\" fxFlex=\"60\">\r\n                <div class=\"selectupload clflex flex-column   mat-tab-label\" >\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        \r\n                        <mat-label>Select Assessement type</mat-label> \r\n                        <mat-select [(ngModel)]=\"examType\"  formControlName=\"examType\" >\r\n                            <mat-option value=\"1\">Upload Scanned File(Physical)</mat-option>\r\n                             <mat-option value=\"2\">Online Assessement Form</mat-option> \r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </div>\r\n            </div>\r\n        </div> -->\r\n        <div class=\"uploadpraticalassessment Report clflex flex-column\"  *ngIf=\"examType == 1 && btnactive\">\r\n            <div >\r\n                <div class=\"clflex flex-column p-t-20\"  >\r\n                    <app-filee #pdoc [fileMstRef]=\"pra_file\"\r\n                    (filesSelected)=\"pfileeSelected($event,pra_file)\" formControlName=\"file\"\r\n                    [notePosition]=\"'bottom'\">\r\n                  </app-filee>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row\" fxLayoutGap=\"20px\" class=\"clflex \" *ngIf=\"learnerData.ispramark == 1\">\r\n                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                    <mat-label>Total Mark</mat-label>\r\n                    <input matInput  formControlName=\"mark\">\r\n                </mat-form-field>\r\n                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                    <mat-label>Percentage</mat-label>\r\n                    <input matInput  formControlName=\"percentage\">\r\n                </mat-form-field>\r\n            </div>\r\n            <div fxLayout=\"row\" fxLayoutGap=\"20px\" class=\"clflex  \"  *ngIf=\"learnerData.ispramark != 1\">\r\n                <div class=\"selectupload clflex flex-column   mat-tab-label\" fxFlex=\"50\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\" >\r\n                        <mat-label>Status</mat-label> \r\n                        <mat-select  formControlName=\"status\">\r\n                            <mat-option value=\"Competent\">Competent</mat-option>\r\n                            <mat-option value=\"Non Competent\">Non Competent</mat-option>\r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </div>\r\n            </div>\r\n    \r\n        </div>\r\n        <div class=\"onlineknowledgeassessment Report clflex flex-column\"  *ngIf=\"examType == 2 && btnactive\">\r\n            <div fxFlex=\"60\">\r\n                <div class=\"clflex flex-column m-b-20\"  fxFlex=\"60\">\r\n                    <p class=\"colblack\" fxFlex=\"60\">Fill the Assessment Report of the selected Learner.</p>\r\n                    <div  *ngFor=\"let item of questions; let i = index\" [value]=\"index\">\r\n                        <label id=\"example-radio-group-label\" >{{i+1}}. {{item.question}}</label>\r\n                            <mat-radio-group\r\n                            aria-labelledby=\"example-radio-group-label\"\r\n                            class=\"example-radio-group\"\r\n                            [(ngModel)]=\"favoriteSeason\">\r\n                            <mat-radio-button class=\"example-radio-button\" *ngFor=\"let answer of item.answers\" [value]=\"answer\">\r\n                                {{answer}}\r\n                            </mat-radio-button>\r\n                            </mat-radio-group>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div fxLayout=\"row\" fxLayoutGap=\"20px\" class=\"clflex  \">\r\n                <div class=\"selectupload clflex flex-column   mat-tab-label\" fxFlex=\"60\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>Status</mat-label> \r\n                        <mat-select  >\r\n                            <mat-option value=\"1\">Competent</mat-option>\r\n                            <mat-option value=\"2\">Non Competent</mat-option>\r\n                        </mat-select>\r\n                    </mat-form-field>\r\n                </div>\r\n            </div>\r\n    \r\n        </div>\r\n        <div class=\"clflex flex-column\">\r\n            <mat-form-field class=\"comments colblack\" appearance=\"outline\">\r\n                <mat-label>Comments</mat-label>\r\n                <textarea matInput  formControlName=\"comments\" placeholder=\"Comments\"></textarea>\r\n                    <mat-hint class=\" clflex \">0/1000</mat-hint>\r\n            </mat-form-field>\r\n        </div>\r\n        <div class=\"buttonalign\">\r\n            <button mat-stroked-button class=\"btnwhite\">Cancel</button>\r\n            <button mat-raised-button class=\"btnred\" type=\"submit\"  *ngIf=\"learnerData != null && learnerData.isknw == 1 && learnerData.ispra == 1\"  >Submit to Next Level Approval</button>\r\n            <button mat-raised-button class=\"btnred\" type=\"submit\"  *ngIf=\"learnerData != null && learnerData.isknw != 1 && learnerData.ispra == 1\"   >Submit</button>\r\n        </div>\r\n    </form>\r\n</div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/changeassessor/changeassessor.component.html":
/*!*****************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/changeassessor/changeassessor.component.html ***!
  \*****************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayoutAlign=\"center\" id=\"changeassessor\" class=\"changeassessor\" *ngIf=\"batchdata_data != null\">\r\n    <div class=\"assessorheader clflex flex-column rwidth\">\r\n        <div class=\"assessordetails flex-column\">\r\n            <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                <div fxLayout=\"row\" class=\"clflex rwidth \">\r\n                    <p>Batch No: <span class=\"colblack\">{{batchdata_data.batchNo}}</span></p>\r\n                    <p>Batch Type: <span class=\"colblack\">{{batchdata_data.batchType}}</span></p>\r\n                </div>\r\n                <p>\r\n                    <button mat-icon-button class=\"batchIcon\" [matMenuTriggerFor]=\"menu\"\r\n                        aria-label=\"Example icon-button with a menu\">\r\n                        <mat-icon>more_horiz</mat-icon>\r\n                    </button>\r\n                    <mat-menu class=\"topmenu\" #menu=\"matMenu\">\r\n                        <button mat-menu-item>\r\n                            <span>Edit</span>\r\n                        </button>\r\n                        <button mat-menu-item>\r\n                            <span>Delete</span>\r\n                        </button>\r\n                    </mat-menu>\r\n                </p>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                <p class=\"bor\">Status: <span class=\"colgreen\">{{getassessmentstatus(batchdata_data.status)}}</span></p>\r\n                <p class=\"bor\">Training Provider : <span>{{batchdata_data.branchName}}</span></p>\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"assessordetail1\" fxLayout=\"row\">\r\n            <div class=\" flex-column\">\r\n                <p>Total Learner</p>\r\n                <p class=\"fontblack colblack\">{{batchdata_data.totalLearners}}/{{batchdata_data.total}}</p>\r\n            </div>\r\n            <div class=\"flex-column \">\r\n                <p>Assessement Date & Time </p>\r\n                <p class=\"fontblack colblack\">{{batchdata_data.aDate  | date: 'dd-MM-yyyy'}} ({{batchdata_data.aStartTime | date: 'h:mm a'}} - {{batchdata_data.aendTime | date: 'h:mm a'}})</p>\r\n            </div>\r\n            <div class=\"flex-column\">\r\n                <p>Assessement Wilayat</p>\r\n                <p class=\"fontblack colblack\">{{batchdata_data.city_en}}</p>\r\n            </div>\r\n            <div class=\" flex-column\">\r\n                <p>Categories</p>\r\n                <p class=\"fontblack colblack\">{{batchdata_data.cat_en}}</p>\r\n            </div>\r\n            <div class=\"flex-column\">\r\n                <p>Language</p>\r\n                <p class=\"fontblack colblack\">{{batchdata_data.elang}}</p>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <form [formGroup]=\"assessorForm\" (ngSubmit)=\"submit()\">\r\n        <div class=\"clflx colgrey \">\r\n            <div class=\" example-full-width mat-tab-label\" fxFlex=\"50\">\r\n                <mat-form-field class=\"filter\" appearance=\"outline\" >\r\n                    <mat-label>Centre</mat-label>\r\n                    <mat-select matNativeControl required formControlName=\"centre\">\r\n                        <mat-option *ngFor=\"let option of centreOption\" [value]=\"option\">{{option.branchname}}</mat-option>\r\n                    </mat-select>\r\n                </mat-form-field>\r\n            </div>\r\n        </div>\r\n        <div class=\"clflx \">\r\n            <mat-form-field class=\"filter\" appearance=\"outline\" >\r\n                <mat-label>Select Assessor</mat-label>\r\n                <mat-select matNativeControl required formControlName=\"assessor\" (selectionChange)=\"changeassessor($event.value)\">\r\n                    <mat-option *ngFor=\"let option of assignassessorOption\"  [value]=\"option\">{{option.assessorname}}</mat-option>\r\n                </mat-select>\r\n            </mat-form-field>\r\n\r\n            <mat-form-field class=\"filter\" appearance=\"outline\" >\r\n                <mat-label>IV staff</mat-label>\r\n                <mat-select matNativeControl required formControlName=\"ivstaff\">\r\n                    <mat-option *ngFor=\"let option of ivstaffOption\" [value]=\"option\">{{option.ivstaffname}}</mat-option>\r\n                </mat-select>\r\n            </mat-form-field>\r\n        </div>\r\n        <div class=\"clflx colgrey \">\r\n            <div class=\" example-full-width mat-tab-label\" fxFlex=\"50\">\r\n                <mat-form-field class=\"filter\" appearance=\"outline\" >\r\n                    <mat-label>Select New Assessor</mat-label>\r\n                    <mat-select matNativeControl required formControlName=\"newassessor\">\r\n                        <mat-option value=\"1\">-</mat-option>\r\n                        <mat-option value=\"2\">N</mat-option>\r\n                    </mat-select>\r\n                </mat-form-field>\r\n            </div>\r\n    \r\n            <div>\r\n                <button mat-flat-button class=\"btnbac\" (click)=\"getcomments()\">Request OPAL to Allocate Assessor</button>\r\n                <mat-icon>error_outline</mat-icon>\r\n            </div>\r\n        </div>\r\n    </form>\r\n\r\n    <div class=\"buttonalign\">\r\n        <button mat-stroked-button class=\"btnwhite\">Cancel</button>\r\n        <button mat-raised-button class=\"btnred\" >Submit </button>\r\n    </div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.html":
/*!*******************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.html ***!
  \*******************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div id=\"learnerfeedback\" >\r\n  <ng-container *ngIf=\"alldata != null && !loading && !formcompleted\">\r\n\r\n    <div class=\"headertitle\">\r\n      <div class=\"backbtn\"><i class=\"fa fa-long-arrow-left  m-r-5\"></i> {{'learnerfdbck.back' | translate}}</div>\r\n      <div class=\"titlediv\">{{'learnerfdbck.lrnrfbk' | translate}}</div>\r\n    </div>\r\n\r\n    <div class=\"header\" fxLayout=\"column\" fxLayoutGap=\"18px\">\r\n      <div fxLayout=\"column\" fxLayoutGap=\"2px\">\r\n        <div class=\"colsand\" fxLayout=\"row\" fxLayoutAligmnet=\"space-between center\" fxLayoutGap=\"5px\">\r\n          <div fxFlex=\"25\">\r\n            <div class=\"txt-label\">{{'learnerfdbck.batchnno' | translate}}</div>\r\n            <div class=\"txt-value\">{{alldata.batchNo}}</div>\r\n          </div>\r\n          <div fxFlex=\"30\">            \r\n            <div class=\"txt-label\">{{'learnerfdbck.traingprvdr' | translate}}</div>\r\n            <div class=\"txt-value\">{{alldata.trainer}}</div>\r\n          </div>\r\n          <div fxFlex=\"30\">            \r\n            <div class=\"txt-label\">{{'learnerfdbck.assmntcntre' | translate}}</div>\r\n            <div class=\"txt-value\">{{alldata.assessor}}</div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n      <div fxLayout=\"column\" fxLayoutGap=\"2px\">\r\n        <div class=\"colsand\" fxLayout=\"row\" fxLayoutAligmnet=\"space-between center\" fxLayoutGap=\"5px\">\r\n            <div fxFlex=\"25\">\r\n              <div class=\"txt-label\">{{'learnerfdbck.lrnrname' | translate}}</div>\r\n              <div class=\"txt-value\">{{alldata.name}}</div>\r\n            </div>\r\n            <div fxFlex=\"30\">            \r\n              <div class=\"txt-label\">{{'learnerfdbck.cvlno' | translate}}</div>\r\n              <div class=\"txt-value\">{{alldata.civilnumber}}</div>\r\n            </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    <div class=\"trainfact\" fxLayout=\"column\">\r\n      <div fxLayout=\"column\" *ngFor=\"let question of questions ; index as j\">\r\n        <div class=\"colblue m-t-20\">\r\n          <p class=\"phadd\" >{{question.fdbkct_feedbacklist_en}} \r\n            <span *ngIf=\"question.fdbkct_feedbacklist_en == 'Assessment' && !alldata.isassessment\">(if applicable)</span></p>\r\n        </div>\r\n        <div class=\"colwh\" fxFlex=\"100\" fxLayout=\"row\" fxLayoutAlign=\"end \">\r\n          <p class=\"ppadd colsand\">{{'learnerfdbck.disagree' | translate}}</p>\r\n          <p class=\"ppadd colsand\">{{'learnerfdbck.agree' | translate}}</p>\r\n          <p class=\"ppadd colsand\">{{'learnerfdbck.strngagre' | translate}}</p>\r\n        </div>\r\n        <ng-container *ngFor=\"let procced of question.questions ; index as i\" >\r\n          <div>\r\n            <div [class]=\"j+1 == questions.length ? 'border' : i+1 !=question.questions.length ? 'border' : '' \" fxLayout=\"row\" fxLayoutAlign=\"space-between none\">\r\n              <p class=\"pstat colli\">{{procced.index}} . {{procced.fdbkqm_Question_en}}</p>\r\n              <mat-radio-group aria-label=\"Select an option\" (change)=\"onradioclick(j,i,$event)\">\r\n                <mat-radio-button class=\"pprdi colli\" value=\"1\"></mat-radio-button>\r\n                <mat-radio-button class=\"pprdi colli\" value=\"2\"></mat-radio-button>\r\n                <mat-radio-button class=\"pprdi colli\" value=\"3\"></mat-radio-button>\r\n              </mat-radio-group>\r\n            </div>\r\n          </div>\r\n        </ng-container>\r\n      </div>\r\n    </div>\r\n    <div class=\"m-t-30\">\r\n      <div>\r\n        <mat-form-field class=\"comments colblack\" appearance=\"outline\">\r\n          <textarea matInput  [(ngModel)]=\"comments\" placeholder=\"{{'learnerfdbck.entcomments' | translate}}\"></textarea>\r\n              <mat-hint class=\" clflex \">0/1000</mat-hint>\r\n        </mat-form-field>\r\n      </div>\r\n      <div class=\"cpat m-t-20\">\r\n        <p fxLayoutAlign=\"center\" class=\"colsand\"> {{'learnerfdbck.opalprotected' | translate}} <span class=\"colred\"> {{'learnerfdbck.pripolicy' | translate}} </span> {{'learnerfdbck.and' | translate}} <span class=\"colred\"> {{'learnerfdbck.termsservice' | translate}} </span> {{'learnerfdbck.apply' | translate}}. </p>\r\n      </div>\r\n    </div>\r\n    <div fxLayout=\"row\" fxLayoutAlign=\"end\"  class=\"m-t-40\">\r\n      <button mat-flat-button type=\"button\"  class=\"canbtn\">{{'learnerfdbck.cancel' | translate}}</button>\r\n      <button mat-flat-button  type=\"button\"  class=\"subbtn\" (click)=\"onSubmit()\">{{'learnerfdbck.submit' | translate}}</button>\r\n    </div>  \r\n  </ng-container>\r\n  <div fxLayout=\"row\" fxLayoutAlign=\"center\" *ngIf=\"formcompleted\">\r\n    <p class=\"errmsg\">Learner feedback form successfully submitted</p>\r\n  </div>\r\n  <div fxLayout=\"row\" fxLayoutAlign=\"center\">\r\n    <p class=\"errmsg\">{{errorMsg}}</p>\r\n  </div>\r\n  </div>  \r\n  <app-responseloader *ngIf=\"loading\"></app-responseloader>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.html":
/*!*****************************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.html ***!
  \*****************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div id=\"learnerfeedbacklist\" fxLayout=\"row wrap\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n        <div class=\"paginationwithfilter masterPageTop m-b-10\">\r\n            <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"page\"\r\n                [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n            <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-start center\">                \r\n                    <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"showFilter();\"\r\n                        class=\"filter height-45\">{{filter ? \"Show Filter\" : \"Hide Filter\"}}<i class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class=\"coursesinfotbale\">\r\n            <mat-table #table class=\"mat-courseinfo\"  [dataSource]=\"dataSource\" matSortActive=\"LearnerFdbkHdr_PK\" matSortDirection=\"desc\" matSort multiTemplateDataRows matSortDisableClear>\r\n            <!-- Position Column -->\r\n            <ng-container matColumnDef=\"sir_idnumber\">\r\n                <mat-header-cell mat-header-cell fxFlex=\"150px\" *matHeaderCellDef  mat-sort-header> {{'learnerfdbck.cvlno' | translate}} </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"150px\" *matCellDef=\"let element\"> {{element.idnumber}} </mat-cell>\r\n            </ng-container>\r\n        \r\n            <!-- Name Column -->\r\n            <ng-container matColumnDef=\"sir_name_en\">\r\n                <mat-header-cell mat-header-cell fxFlex=\"200px\" *matHeaderCellDef  mat-sort-header> {{'learnerfdbck.lrnrname' | translate}} </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"200px\" *matCellDef=\"let element\"> {{ifarabic == true ? element.learnername_ar != '' ? element.learnername_ar : element.learnername_en  : element.learnername_en}}</mat-cell>\r\n            </ng-container>\r\n        \r\n            <!-- Weight Column -->\r\n            <ng-container matColumnDef=\"bmd_Batchno\">\r\n                <mat-header-cell mat-header-cell fxFlex=\"150px\" *matHeaderCellDef  mat-sort-header> {{'learnerfdbck.batchnno' | translate}} </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"150px\" *matCellDef=\"let element\"> {{element.batchnumb}} </mat-cell>\r\n            </ng-container>\r\n        \r\n            <!-- Symbol Column -->\r\n            <ng-container matColumnDef=\"Tomrm_tpname_en\">\r\n                <mat-header-cell mat-header-cell fxFlex=\"200px\" *matHeaderCellDef  mat-sort-header> {{'learnerfdbck.traingprvdr' | translate}} </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"200px\" *matCellDef=\"let element\"> {{ifarabic == true ? element.trainerprovi_ar != '' ? element.trainerprovi_ar : element.trainerprovi_en : element.trainerprovi_en}} </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"Aomrm_tpname_en\">\r\n                <mat-header-cell mat-header-cell fxFlex=\"200px\" *matHeaderCellDef  mat-sort-header> {{'learnerfdbck.assmntcntre' | translate}} </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"200px\" *matCellDef=\"let element\"> {{ifarabic == true ? element.assessercentre_ar  != '' ? element.assessercentre_ar : element.assessercentre_en : element.assessercentre_en}} </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"feedback\">\r\n                <mat-header-cell mat-header-cell fxFlex=\"200px\" *matHeaderCellDef> {{'learnerfdbck.feedbck' | translate}} </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"200px\" *matCellDef=\"let element\"> {{element.feedbackcomments}} </mat-cell>\r\n            </ng-container>\r\n\r\n            <ng-container matColumnDef=\"action\">\r\n                <mat-header-cell mat-header-cell fxFlex=\"200px\" *matHeaderCellDef> {{'learnerfdbck.action' | translate}} </mat-header-cell>\r\n                <mat-cell mat-cell fxFlex=\"200px\" *matCellDef=\"let element\"> <a target=\"_blank\" [routerLink]=\"['/assessmentreport/learnerfeedbackview',element.lid]\">{{'learnerfdbck.view' | translate}}</a> </mat-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-one\">\r\n                <mat-header-cell fxFlex=\"150px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>{{'learnerfdbck.srch' | translate}}</mat-label>\r\n                        <input matInput [formControl]=\"civilnumber\">\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-two\">\r\n                <mat-header-cell fxFlex=\"200px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>{{'learnerfdbck.srch' | translate}}</mat-label>\r\n                        <input matInput [formControl]=\"learnername\">\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-three\">\r\n                <mat-header-cell fxFlex=\"150px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>{{'learnerfdbck.srch' | translate}}</mat-label>\r\n                        <input matInput [formControl]=\"batchnumber\">\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-four\">\r\n                <mat-header-cell fxFlex=\"200px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>{{'learnerfdbck.srch' | translate}}</mat-label>\r\n                        <input matInput [formControl]=\"trainingprovider\">\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-five\">\r\n                <mat-header-cell fxFlex=\"200px\" *matHeaderCellDef id=\"search\">\r\n                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                        <mat-label>{{'learnerfdbck.srch' | translate}}</mat-label>\r\n                        <input matInput [formControl]=\"assessmentcentre\">\r\n                    </mat-form-field>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-six\">\r\n                <mat-header-cell fxFlex=\"200px\" *matHeaderCellDef id=\"search\">\r\n                    &nbsp;\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <ng-container matColumnDef=\"row-seven\">\r\n                <mat-header-cell fxFlex=\"200px\" *matHeaderCellDef id=\"search\">\r\n                    <i class=\"fa fa-refresh m-l-15 cursorview\" (click)=\"clearFilter();filtersts=false;\"\r\n                    aria-hidden=\"true\" matTooltip=\"{{'table.refr' |translate}}\"></i>\r\n                </mat-header-cell>\r\n            </ng-container>\r\n            <tr mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"displayedColumns\"></tr>\r\n            <mat-header-row id=\"searchrow\"\r\n                *matHeaderRowDef=\"displaySearchColumns\">\r\n            </mat-header-row>\r\n            <tr mat-row *matRowDef=\"let element; columns: displayedColumns;\"\r\n                class=\"example-element-row\">\r\n            </tr>\r\n            <!-- <mat-header-row id=\"searchrow\" *matHeaderRowDef=\"displaySearchColumns\"></mat-header-row>\r\n            <mat-row *matRowDef=\"let row; columns: displayedColumns;\"></mat-row> -->\r\n            <ng-container matColumnDef=\"disclaimer\">\r\n                <td mat-footer-cell *matFooterCellDef colspan=\"11\">\r\n                    <div class=\"nofound\" fxLayoutAlign=\"center\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <div fxFlex=\"100\" fxLayout=\"column\" fxLayoutAlign=\"center center\">\r\n                            <img src=\"assets/images/opalimages/norecord.svg\" alt=\"norecord\">\r\n                            <p class=\"m-t-10 txt-gry3 fs-16\">{{'common.noreco' | translate}}</p>\r\n                </div>\r\n            </div>\r\n                </td>\r\n            </ng-container>\r\n            <ng-container>\r\n              \r\n                <mat-footer-row [style.display]=\"(resultsLength > 0) ? 'none' : 'block' \" \r\n                    *matFooterRowDef=\"['disclaimer']\" style=\"justify-content: center\">\r\n                </mat-footer-row>\r\n            </ng-container>\r\n            </mat-table>      \r\n        </div>\r\n        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                    class=\"masterPage masterbottom \" showFirstLastButtons [pageSize]=\"paginator?.pageSize\"\r\n                    (page)=\"syncPrimaryPaginator($event);\" [pageIndex]=\"paginator?.pageIndex\"\r\n                    [length]=\"paginator?.length\" [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                </mat-paginator>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.html":
/*!***************************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.html ***!
  \***************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div id=\"feedbackview\" *ngIf=\"alldata != null && !loading\">\r\n\r\n    <div class=\"header\" fxLayout=\"column\" fxLayoutGap=\"18px\">\r\n        <div fxLayout=\"column\" fxLayoutGap=\"2px\">\r\n          <div class=\"colsand\" fxLayout=\"row\" fxLayoutAligmnet=\"space-between center\" fxLayoutGap=\"5px\">\r\n            <div fxFlex=\"25\">\r\n              <div class=\"txt-label\">{{'learnerfdbck.batchnno' | translate}}</div>\r\n              <div class=\"txt-value\">{{alldata.batchNo}}</div>\r\n            </div>\r\n            <div fxFlex=\"30\">            \r\n              <div class=\"txt-label\">{{'learnerfdbck.traingprvdr' | translate}}</div>\r\n              <div class=\"txt-value\">{{alldata.trainer}}</div>\r\n            </div>\r\n            <div fxFlex=\"30\">            \r\n              <div class=\"txt-label\">{{'learnerfdbck.assmntcntre' | translate}}</div>\r\n              <div class=\"txt-value\">{{alldata.assessor}}</div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <div fxLayout=\"column\" fxLayoutGap=\"2px\">\r\n          <div class=\"colsand\" fxLayout=\"row\" fxLayoutAligmnet=\"space-between center\" fxLayoutGap=\"5px\">\r\n              <div fxFlex=\"25\">\r\n                <div class=\"txt-label\">{{'learnerfdbck.lrnrname' | translate}}</div>\r\n                <div class=\"txt-value\">{{alldata.name}}</div>\r\n              </div>\r\n              <div fxFlex=\"30\">            \r\n                <div class=\"txt-label\">{{'learnerfdbck.cvlno' | translate}}</div>\r\n                <div class=\"txt-value\">{{alldata.civilnumber}}</div>\r\n              </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    <div class=\"trainfact \" fxLayout=\"column\">\r\n      <div fxLayout=\"column\" *ngFor=\"let question of questions\">\r\n        <div class=\"colblue m-t-20\">\r\n          <p class=\"phadd\">{{question.fdbkct_feedbacklist_en}} </p>\r\n        </div>\r\n        <div class=\"colwh\" fxFlex=\"100\" fxLayout=\"row\" fxLayoutAlign=\"end \">\r\n            <p class=\"ppadd colsand\">{{'learnerfdbck.disagree' | translate}}</p>\r\n            <p class=\"ppadd colsand\">{{'learnerfdbck.agree' | translate}}</p>\r\n            <p class=\"ppadd colsand\">{{'learnerfdbck.strngagre' | translate}}</p>\r\n        </div>\r\n        <ng-container *ngFor=\"let procced of question.questions ; index as i\" >\r\n          <div>\r\n            <div [class]=\"j+1 == data.length ? 'border' : i+1 !=question.questions.length ? 'border' : '' \" fxLayout=\"row\" fxLayoutAlign=\"space-between none\">\r\n              <p class=\"pstat colli\">{{procced.index}} . {{procced.fdbkqm_Question_en}} </p>\r\n              <mat-radio-group aria-label=\"Select an option\">\r\n                <mat-radio-button class=\"pprdi colli \" [checked]=\"procced.value == 1 ? true : false\"  disabled=\"true\" value=1></mat-radio-button>\r\n                <mat-radio-button class=\"pprdi colli \" [checked]=\"procced.value == 2 ? true : false\" disabled=\"true\" value=2 ></mat-radio-button>\r\n                <mat-radio-button class=\"pprdi colli \" [checked]=\"procced.value == 3 ? true : false\"  disabled=\"true\" value=3 ></mat-radio-button>\r\n              </mat-radio-group>\r\n            </div>\r\n          </div>\r\n        </ng-container>\r\n      </div>\r\n    </div>\r\n    <div>\r\n      <br><br>\r\n      <div >\r\n        <!-- <input class=\"comments\"  placeholder=\"Enter Comments (if any)\"> -->\r\n        <p class=\"comlab\">{{'learnerfdbck.comments' | translate}}</p>\r\n        <p> {{alldata.comments}}</p>\r\n      </div>\r\n    </div>   \r\n  </div> \r\n  <app-responseloader *ngIf=\"loading\"></app-responseloader> \r\n\r\n  ");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.html":
/*!*****************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.html ***!
  \*****************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div id=\"learnerreglist\" #pageScroll>\r\n        <div class=\"learnerreglist\" fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n            <div fxFlex=\"90\">\r\n                <div class=\"knowledgegrid m-t-10 m-b-20\" fxLayout=\"column\">\r\n                    <div class=\"details pd-15\" fxFlex=\"100\">\r\n                        <div fxLayout=\"row wrap\" class=\"m-t-5\">\r\n                            <div class=\"add-details\" fxFlex.gt-sm=\"35\" fxFlex=\"50\">\r\n                                <p class=\"text-gray m-0 fs-15 \">Training Evaluation Centre:<span\r\n                                    class=\"text-default\"> CVN0076787</span></p>\r\n                            </div>\r\n                            <div class=\"add-details\" fxFlex.gt-sm=\"25\" fxFlex=\"50\">\r\n                                <p class=\"text-gray m-0 fs-15 \">Batch No.:<span\r\n                                    class=\"text-default\"> BID11232323</span></p>\r\n                            </div>\r\n                            <div class=\"add-details\" fxFlex.gt-sm=\"25\" fxFlex=\"50\">\r\n                                <p class=\"text-gray m-0 fs-15 \">Batch Type:<span\r\n                                    class=\"text-default\"> Initial</span></p>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"fs-13 m-t-5 m-b-5\" fxLayout=\"row wrap\">\r\n                            <p class=\"application-detais m-r-10 text-gray m-0\">Status:<span\r\n                                    class=\"text-default\">Print</span></p>\r\n                            <p class=\"application-detais m-r-10 text-gray m-0\">Office Type:<span\r\n                                    class=\"text-default\"> Branch Office</span></p>\r\n                            <p class=\"application-detais m-r-10 text-gray m-0\">Branch Name:<span\r\n                                    class=\"text-default\">South Zone Al Aradmoon Trading Co. LLC</span></p>\r\n                        </div>\r\n                        <button class=\"actionmenubtn\" mat-button [matMenuTriggerFor]=\"menu\"><mat-icon>more_horiz</mat-icon></button>\r\n                        <mat-menu #menu=\"matMenu\" class=\"actionmatmenu\">\r\n                            <button mat-menu-item>Menu 1</button>\r\n                            <button mat-menu-item>Menu 2</button>\r\n                            <button mat-menu-item>Menu 3</button>\r\n                        </mat-menu>  \r\n                    </div>\r\n                    <div class=\"address  p-l-15\" fxLayout=\"row wrap\" fxFlex.gt-sm=\"60\" fxFlex=\"100\">\r\n                        <div class=\"add-details\" fxFlex.gt-sm=\"25\" fxFlex=\"50\">\r\n                            <p class=\"text-gray fs-14\">Training Duration<br>\r\n                                <span class=\"text-default\">01-01-2023 to 08-01-2023</span>\r\n                            </p>\r\n                        </div>\r\n                        <div class=\"add-details\" fxFlex.gt-sm=\"20\" fxFlex=\"50\">\r\n                            <p class=\"text-gray fs-14\">Total Learners<br>\r\n                                <span class=\"text-default\">55/80</span>\r\n                            </p>\r\n                        </div>\r\n                        <div class=\"add-details\" fxFlex.gt-sm=\"25\" fxFlex=\"50\">\r\n                            <p class=\"text-gray fs-14\">Remaining Capacity<br>\r\n                                <span class=\"text-default\">25/80</span>\r\n                            </p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div fxFlex=\"90\">\r\n                <div class=\"learnerregdetails pd-15\">\r\n                    <div class=\"example-container learnerreglstcontainer m-t-30\">\r\n                        <div class=\"paginationwithfilter masterPageTop \">\r\n                            \r\n                            <div fxLayout=\"row\" class=\"toppagination\" fxLayoutAlign=\"space-between\">\r\n                                    <mat-paginator class=\"masterPage masterPageTop\" #paginator [pageSizeOptions]=\"[5, 10, 20]\"></mat-paginator>\r\n                                <div fxLayoutAlign=\"flex-start center\">\r\n                                    <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                                        class=\"filter height-45\">{{filtername}}<i class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <mat-table #table class=\"scheduletable scrolldata\" [dataSource]=\"learnerregdataSource\" matSort multiTemplateDataRows matSortDisableClear>\r\n                        \r\n                            <!-- sno Column -->\r\n                            <ng-container matColumnDef=\"sno\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header > \r\n                                <mat-checkbox class=\"example-margin\"></mat-checkbox>   \r\n                            </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> \r\n                                <mat-checkbox class=\"example-margin\"></mat-checkbox>  \r\n                             </mat-cell>\r\n                            </ng-container>\r\n                        \r\n                            <!-- cvlno Column -->\r\n                            <ng-container matColumnDef=\"civilno\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Civil No </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.civilno}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- learnername Column -->\r\n                            <ng-container matColumnDef=\"learnername\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Learner Name </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.learnername}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- email Column -->\r\n                            <ng-container matColumnDef=\"email\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Email </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.email}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- Age Column -->\r\n                            <ng-container matColumnDef=\"age\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Age </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.age}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- Gender Column -->\r\n                            <ng-container matColumnDef=\"gender\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Gender </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.gender}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- Theorytutor Column -->\r\n                            <ng-container matColumnDef=\"theorytutor\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Tutor/Trainer(Theory) </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.theorytutor}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- Practcltutor Column -->\r\n                            <ng-container matColumnDef=\"practltutor\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Tutor/Trainer(Practical) </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.practltutor}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- Theorytutor Column -->\r\n                            <ng-container matColumnDef=\"assessor\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Assessor </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.assessor}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- ivqastaff Column -->\r\n                            <ng-container matColumnDef=\"ivqastaff\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> IV/QA Staff </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> {{element.ivqastaff}} </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- feestatus Column -->\r\n                            <ng-container matColumnDef=\"feestatus\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header>Learner Fee Status </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> \r\n                                <p *ngIf=\"element.feestatus == 'Paid'\" class=\"paid flexaligntag\">Paid</p>  \r\n                                <p *ngIf=\"element.feestatus == 'Yet to Pay'\" class=\"yettopay flexaligntag\">Yet to Pay</p>      \r\n                            </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- Status Column -->\r\n                            <ng-container matColumnDef=\"status\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header>Status</mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\">\r\n                                <p *ngIf=\"element.status == 'New'\" class=\"new flexaligntag\">New</p>    \r\n                            </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- knowledgeassessmnt Column -->\r\n                            <ng-container matColumnDef=\"knowledgeassessmnt\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Knowledge Assessment </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> \r\n                                <p *ngIf=\"element.knowledgeassessmnt == 'Fail'\" class=\"fail flexaligntag\">Fail</p>\r\n                                <p *ngIf=\"element.knowledgeassessmnt == 'Pass'\"  class=\"pass flexaligntag\">Pass</p>\r\n                                <p *ngIf=\"element.knowledgeassessmnt == 'Pending'\"  class=\"pending flexaligntag\">Pending</p>\r\n                            </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!-- practicalassessmnt Column -->\r\n                            <ng-container matColumnDef=\"practicalassessmnt\">\r\n                            <mat-header-cell *matHeaderCellDef mat-sort-header> Practical Assessment </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> \r\n                                <p *ngIf=\"element.practicalassessmnt == 'Fail'\" class=\"fail flexaligntag\">Fail</p>\r\n                                <p *ngIf=\"element.practicalassessmnt == 'Pass'\"  class=\"pass flexaligntag\">Pass</p>\r\n                                <p *ngIf=\"element.practicalassessmnt == 'Pending'\"  class=\"pending flexaligntag\">Pending</p>\r\n                            </mat-cell>\r\n                            </ng-container>\r\n                        \r\n                            <!-- Action Column -->\r\n                            <ng-container matColumnDef=\"action\">\r\n                            <mat-header-cell  *matHeaderCellDef> Action </mat-header-cell>\r\n                            <mat-cell *matCellDef=\"let element\"> \r\n                                <button mat-button [matMenuTriggerFor]=\"menu\"><mat-icon>more_horiz</mat-icon></button>\r\n                                <mat-menu #menu=\"matMenu\" class=\"actionmatmenu\">                                    \r\n                                    <button mat-menu-item>Update Payment Status</button>\r\n                                    <button mat-menu-item>Mark as Present</button>\r\n                                    <button mat-menu-item>Mark as No Show</button>\r\n                                </mat-menu>\r\n                            </mat-cell>\r\n                            </ng-container>\r\n\r\n                            <!--search row-->\r\n                            <ng-container matColumnDef=\"row-first\">\r\n                            <mat-header-cell class=\"searchrow\" *matHeaderCellDef>\r\n                                <div class=\"checkholder\"></div>\r\n                            </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-second\">\r\n                                <mat-header-cell class=\"searchrow \" *matHeaderCellDef>\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>Search</mat-label>\r\n                                        <input matInput [formControl]=\"civilnosrch\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-three\">\r\n                                <mat-header-cell class=\"searchrow\" *matHeaderCellDef>\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>Search</mat-label>\r\n                                        <input matInput [formControl]=\"learnernamesrch\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-four\">\r\n                                <mat-header-cell class=\"searchrow dispnone\" *matHeaderCellDef>\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>Search</mat-label>\r\n                                        <input matInput [formControl]=\"emailsrch\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-five\">\r\n                            <mat-header-cell class=\"searchrow\" *matHeaderCellDef>\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>Search</mat-label>\r\n                                    <input matInput [formControl]=\"agesrch\">\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-six\">\r\n                                <mat-header-cell class=\"searchrow \" *matHeaderCellDef>\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>Search</mat-label>\r\n                                        <input matInput [formControl]=\"gendersrch\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-seven\">\r\n                                <mat-header-cell class=\"searchrow\" *matHeaderCellDef>\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>Search</mat-label>\r\n                                        <input matInput [formControl]=\"theorytutorsrch\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-eight\">\r\n                                <mat-header-cell class=\"searchrow dispnone\" *matHeaderCellDef>\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>Search</mat-label>\r\n                                        <input matInput [formControl]=\"practltutorsrch\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                            </ng-container>\r\n                            <ng-container matColumnDef=\"row-nine\">\r\n                                    <mat-header-cell class=\"searchrow dispnone\" *matHeaderCellDef>\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>Search</mat-label>\r\n                                            <input matInput [formControl]=\"assessorsrch\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-ten\">\r\n                                <mat-header-cell class=\"searchrow\" *matHeaderCellDef>\r\n                                    <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>Search</mat-label>\r\n                                        <input matInput [formControl]=\"ivqastaffsrch\">\r\n                                    </mat-form-field>\r\n                                </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-eleven\">\r\n                                    <mat-header-cell class=\"searchrow \" *matHeaderCellDef>\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>Search</mat-label>\r\n                                            <input matInput [formControl]=\"feestatussrch\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-twelve\">\r\n                                    <mat-header-cell class=\"searchrow\" *matHeaderCellDef>\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>Search</mat-label>\r\n                                            <input matInput [formControl]=\"statusrsrch\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-thirteen\">\r\n                                    <mat-header-cell class=\"searchrow dispnone\" *matHeaderCellDef>\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>Search</mat-label>\r\n                                            <input matInput [formControl]=\"knowledgeassessmntsrch\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-fourteen\">\r\n                                    <mat-header-cell class=\"searchrow dispnone\" *matHeaderCellDef>\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>Search</mat-label>\r\n                                            <input matInput [formControl]=\"practicalassessmntsrch\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-fifteen\">\r\n                                    <mat-header-cell class=\"searchrow dispnone\" *matHeaderCellDef>\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>Search</mat-label>\r\n                                            <input matInput [formControl]=\"actionsrch\">\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                        \r\n                            <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"displayedColumns\"></mat-header-row>\r\n                            <mat-header-row id=\"searchrow\"\r\n                            *matHeaderRowDef=\"['row-first','row-second','row-three','row-four','row-five','row-six','row-seven','row-eight','row-nine','row-ten','row-eleven','row-twelve','row-thirteen','row-fourteen','row-fifteen']\">\r\n                            </mat-header-row>\r\n                            <mat-row *matRowDef=\"let row; columns: displayedColumns;\"></mat-row>\r\n                        </mat-table>\r\n                    </div>\r\n\r\n                    <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator btmpagination\">\r\n                            <mat-paginator ngClass.xs=\"block\" ngClass.sm=\"block\" showFirstLastButtons class=\"masterPage masterbottom \"(page)=\"syncPrimaryPaginator($event)\" \r\n                            [pageSize]=\"paginator.pageSize\" [pageIndex]=\"paginator.pageIndex\"\r\n                            [length]=\"paginator.length\" [pageSizeOptions]=\"paginator.pageSizeOptions\">\r\n                            </mat-paginator>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                       \r\n            </div>\r\n        </div>\r\n    </div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.html":
/*!*****************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.html ***!
  \*****************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<p>learnerregstrn works!</p>\r\n");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/modal/changecommentmodal.html":
/*!**************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/modal/changecommentmodal.html ***!
  \**************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div id=\"commentbox\">\r\n    <div class=\"popup scrollerdata\" fxLayout=\"column\" >\r\n        <div class=\"header\" fxFlex=\"100\" fxLayout=\"row wrap\" fxLayoutAlign=\"space-between center\">\r\n            <h4 *ngIf=\"showField1 && !showField4\" class=\"fs-20 red m-0\">{{'batch.cancle' | translate}}</h4>\r\n            <h4 *ngIf=\"showField2 && !showField4 \" class=\"fs-20 red m-0\">{{'batch.request' | translate}}</h4>\r\n            <h4 *ngIf=\"showField3 && !showField4\" class=\"fs-20 red m-0\">{{'batch.updatebatch' | translate}}</h4>\r\n            <mat-icon class=\"fs-20 txt-gry\" matTooltip=\"{{'batch.close' | translate}}\" (click)=\"closeModalPopup()\">close</mat-icon>\r\n        </div>\r\n        <mat-divider class=\"m-t-5 m-b-15\"></mat-divider>\r\n\r\n        <div class=\"content\" fxLayout=\"column\" *ngIf=\"showField1 && !showField4\" >\r\n            <p class=\"fs-16 txt-gry m-0 p-b-5\">{{'batch.batchno' | translate}}</p>\r\n            <p class=\"fs-16 txt-gry3 m-0\">354435645</p>\r\n        </div>\r\n          <form  [formGroup]=\"validationForm\" >\r\n              <div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"p-b-10 m-l-25 m-r-25\" *ngIf=\"showField1 || showField2 || showField4\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                  <div fxLayout=\"row wrap\" (click)=\"editinfo()\" *ngIf=\"!edittechinfo\">\r\n                    <div class=\"m-t-10\" fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                      <div class=\"ckeditorborder\">\r\n                        <p class=\"editortitle importantfield txt-gry3\">{{'validation.comm' | translate}} <span class=\"error\" *ngIf=\"manditory\">*</span> </p>\r\n                        <div class=\"contenthere\" [innerHTML]='techinfo'>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"messagecount\" fxLayoutAlign=\"flex-end\">\r\n                        <p class=\"m-0 txt-gry\"> {{length_Of_ck}} / 1000</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                  <div fxLayout=\"row wrap\" *ngIf=\"edittechinfo\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"techapp m-b-10\">\r\n                      <div class=\"d-flex\">\r\n                        <span class=\"d-block ckeditortitle p-b-5 importantfield txt-gry\">{{'validation.comm' | translate}}<span class=\"error\" *ngIf=\"manditory\"> *</span></span>\r\n                      </div>\r\n                      <div class=\"ckeditror\">\r\n                        <ckeditor (change)=\"onChangeeditor($event)\" [(ngModel)]=\"contact\" (ready)=\"onReady($event)\"\r\n                        [editor]=\"Editor\" [config]=\"config\" [formControl]=\"validationForm.controls['comments']\"\r\n                        appAlphanumsymb></ckeditor>\r\n                        <!-- <ckeditor [ngClass]=\"{'is-invalid': f.comments.touched && f.comments.errors }\"\r\n                          (change)=\"onChangeeditor($event)\" [(ngModel)]=\"contact\" (ready)=\"onReady($event)\"\r\n                          [editor]=\"Editor\" [config]=\"config\" [formControl]=\"validationForm.controls['comments']\"\r\n                          appAlphanumsymb [required]=\"false\" #myEditor  (keydown)=\"ck.ckeditor_count(contact) >= 1000 ? $event.stopPropagation() : ''\" >\r\n                        </ckeditor>\r\n                      \r\n                      </div>\r\n                    \r\n                      <div class=\"messagecount txt-gry\" fxLayoutAlign=\"flex-end\">\r\n                        <p class=\"txt-gry m-0 m-t-5\"> {{length_Of_ck}}/1000</p>\r\n                      </div> -->\r\n                      <mat-hint *ngIf=\"length_Of_ck>1000\" class=\"error font-14\"\r\n                        align=\"start\">{{'validation.cannexcechar' | translate}}</mat-hint>\r\n                      <div *ngIf=\"(f.comments.touched && f.comments.errors?.required == true) \">\r\n                        <div class=\"error fs-13\" *ngIf=\"f.comments.touched &&  f.comments.errors\">\r\n                          {{'validation.entemess' | translate}}</div>\r\n                      </div>\r\n                      <div class=\"messagecount txt-gry\" fxLayoutAlign=\"flex-end\">\r\n                        <p class=\"txt-gry m-0 m-t-5\"> {{length_Of_ck}}/1000</p>\r\n                      </div> \r\n                      <div class=\"clearbut p-t-10 b-5\" fxLayoutAlign=\"flex-end\">\r\n                        <button type=\"button\" [disabled]=\"validationForm.controls['comments'].value?.length==0\"\r\n                          (click)=\"resinfo()\" mat-raised-button\r\n                          class=\"m-r-10 clearbutton button-40\">{{'validation.clear' | translate}}</button>\r\n                        <button mat-raised-button color=\"primary\" [disabled]=\"length_Of_ck>1000 || length_Of_ck == 0\"\r\n                          (click)=\"messagedone()\" class=\"button-40\">{{'validation.done' |\r\n                          translate}}</button>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </div>\r\n              </div>\r\n              <div fxLayout=\"row wrap\" fxLayoutAlign=\"center center\" class=\"m-t-20  m-l-25 m-r-25\" *ngIf=\"showField3 && !showField4\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                    <mat-form-field appearance=\"outline\">\r\n                        <mat-select  formControlName=\"status\"\r\n                            panelClass=\"select_with_search\" (selectionChange)=\"statusupdatevalue(f.status.value)\">\r\n                            <mat-option [value]=\"1\">{{'batch.app' | translate}}</mat-option>\r\n                            <mat-option [value]=\"2\">{{'batch.new' | translate}}</mat-option>\r\n                            <mat-option [value]=\"3\">{{'batch.fail' | translate}}</mat-option>\r\n                        </mat-select>\r\n                        <mat-label>{{'batch.selestatus' | translate}}</mat-label>\r\n                        <!-- <mat-error *ngIf=\"f.status.errors?.required || validationForm.submitted\">\r\n                            {{'batch.selectstatus' | translate}}\r\n                        </mat-error> -->\r\n                    </mat-form-field>\r\n                </div>\r\n                </div>\r\n              <div class=\"btngroup m-t-1ck-editor__main0 m-b-20 m-l-25 m-r-25\"  fxLayout=\"row\" fxLayoutAlign=\"flex-end\">\r\n                <button mat-raised-button class=\"cancel_btn\" (click)=\"close()\"   type=\"button\">{{'validation.canc' | translate}}</button>\r\n                <button mat-raised-button class=\"submitbtn m-l-20\" *ngIf=\"showField1 || showField2 || showField4\" color=\"primary\" (click)=\"submitted()\" [disabled]=\"length_Of_ck>1000 || done\" type=\"submit\" >{{'validation.sumb' | translate}}</button>\r\n                <button mat-raised-button class=\"submitbtn m-l-20\" *ngIf=\"showField3\"  color=\"primary\" (click)=\"submitted()\" [disabled]=\"statustrue\" type=\"submit\" >{{'validation.sumb' | translate}}</button>\r\n              </div>\r\n            </form>\r\n    </div>\r\n</div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.html":
/*!*****************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.html ***!
  \*****************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayoutAlign=\"center\" id=\"viewandapprove\" class=\"viewandapprove\" *ngIf=\"learnerData!=null\">\r\n    <div class=\"batchheader clflex flex-column rwidth\">\r\n        <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n            <p>Batch No.: <span class=\"colblack\">{{learnerData.batchNo}}</span></p>\r\n            <p>Civil Number: <span class=\"colblack\">{{learnerData.civilNumber}}</span></p>\r\n        </div>\r\n        <div>\r\n            <p class=\"colblack\"><b>{{learnerData.name}}</b></p>\r\n        </div>\r\n        <div fxLayout=\"row \" class=\"clflex rwidth batchinnerdiv\">\r\n            <p>Status: <span class=\"colgreen\">{{getassessmentstatus(learnerData.status)}}</span></p>\r\n            <p *ngIf=\"learnerData.isknw == 1\">Knowledge Assessment: \r\n                <span [ngSwitch]=\"learnerData.kStatus\">\r\n                    <span *ngSwitchCase=\"'Pass'\" class=\"colgreen\">{{learnerData.kStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Fail'\" class=\"colred\">{{learnerData.kStatus}}</span>\r\n                    <span *ngSwitchDefault class=\"colorange\">Pending</span>\r\n                </span>\r\n            </p>\r\n            <p *ngIf=\"learnerData.ispra == 1\">Practical Assessment: \r\n                <span [ngSwitch]=\"learnerData.pStatus\">\r\n                    <span *ngSwitchCase=\"'Pass'\" class=\"colgreen\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Fail'\" class=\"colred\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Competent'\" class=\"colgreen\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchCase=\"'Non-Competent'\" class=\"colred\">{{learnerData.pStatus}}</span>\r\n                    <span *ngSwitchDefault  class=\"colorange\">Pending</span>\r\n                </span>\r\n            </p>\r\n            <p> Email ID: <span class=\"colblack\">{{learnerData.emailId}}</span></p>\r\n            <p> Age: <span class=\"colblack\">{{learnerData.age}}</span></p>\r\n            <p>Gender: <span class=\"colblack\">{{learnerData.gender == 1 ? 'Male' : 'Female'}}</span></p>\r\n        </div>\r\n    </div>\r\n    <div class=\"just validatebtn \" *ngIf=\"validatebtn\" >\r\n        <!-- <button mat-raised-button class=\"btnbac\" (click)=\"openDialog()\" >Validate</button> -->\r\n        <app-viewvalidation [callbackFn]=\"onValidation\" [hidebtn]=\"true\" [isDisabled] = 'isValidated'  ></app-viewvalidation>\r\n    </div>\r\n    <div class=\"qualitycheckstatus\" *ngIf=\"learnerData.comment !=null\">\r\n        <div class=\"qcinnerf\">\r\n            <p class=\"fpara\">Comments</p>\r\n            <p [innerHTML]=\"learnerData.comment\"></p>\r\n        </div>\r\n        <div class=\"qcinners clflex\">\r\n            <p>Last validation on: <span>{{learnerData.commentOn}}</span></p>\r\n            <p class=\"p-l-40\">Last validation By: <span>{{learnerData.commentBy}}</span></p>\r\n        </div>\r\n    </div>\r\n\r\n    <div fxLayout=\"row\" fxLayoutGap=\"10px\" class=\" clflex  mat-tab-label\" fxFlex=\"60\">\r\n\r\n        <button mat-flat-button class=\"btnbac m-l-15\" *ngIf=\"learnerData.isknw == 1\"  (click)=\"changeassessment('knowleadge')\"\r\n            [ngClass]=\"btnactive ? '' : 'active'\" fxFlex=\"40\">Knowledge Assessement</button>\r\n        <button mat-flat-button class=\"btnbac\" *ngIf=\"learnerData.ispra == 1\" (click)=\"changeassessment('practical')\"\r\n            [ngClass]=\"!btnactive ? '' : 'active'\" fxFlex=\"40\">Practical Assessment</button>\r\n    </div>\r\n\r\n    <div class=\"approve clflex flex-column   mat-tab-label\" fxFlex=\"60\" *ngIf=\"kreport != null && !btnactive\">\r\n        <div class=\" clflex flex-column\">\r\n            <p class=\"col\">Upload Assessment Report</p>\r\n            <div class=\"cflex\" fxLayout=\"row\" style=\"align-items: center;\">\r\n                <img class=\"pdfimage\" src=\"assets/images/pdf.png\">\r\n                <p class=\"colblack\">View</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\">\r\n            <p class=\"col\" fxFlex=\"60\">Mark</p>\r\n            <p class=\"colblack\">{{kreport.lasmth_MarkSecured}}</p>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\">\r\n            <p class=\"col\" fxFlex=\"60\">Percentage</p>\r\n            <p class=\"colblack\">{{kreport.lasmth_percentage}}</p>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\">\r\n            <p class=\"col\" fxFlex=\"60\">Status</p>\r\n            <p class=\"colblack\">{{getstatus(kreport.lasmth_Status)}}</p>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\">\r\n            <p class=\"col\" fxFlex=\"60\">Comments</p>\r\n            <p class=\"colblack\">{{preport.lasmth_AppdecComments}}</p>\r\n        </div>\r\n    </div>\r\n    <div class=\"approve clflex flex-column   mat-tab-label\" fxFlex=\"60\" *ngIf=\"preport != null && btnactive\">\r\n        <div class=\" clflex flex-column\">\r\n            <p class=\"col\">Upload Assessment Report</p>\r\n            <div class=\"cflex\" fxLayout=\"row\" style=\"align-items: center;\">\r\n                <img class=\"pdfimage\" src=\"assets/images/pdf.png\">\r\n                <p class=\"colblack\">View</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\"  *ngIf=\"ispramark == 1\">\r\n            <p class=\"col\" fxFlex=\"60\">Mark</p>\r\n            <p class=\"colblack\">{{preport.lasmth_MarkSecured}}</p>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\" *ngIf=\"ispramark == 1\">\r\n            <p class=\"col\" fxFlex=\"60\">Percentage</p>\r\n            <p class=\"colblack\">{{preport.lasmth_percentage}}</p>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\" >\r\n            <p class=\"col\" fxFlex=\"60\">Status</p>\r\n            <p class=\"colblack\">{{getstatus(preport.lasmth_Status)}}</p>\r\n        </div>\r\n        <div class=\"approve clflex flex-column\">\r\n            <p class=\"col\" fxFlex=\"60\">Comments</p>\r\n            <p class=\"colblack\">{{preport.lasmth_AppdecComments}}</p>\r\n        </div>\r\n    </div>\r\n    <div class=\"buttonalign\">\r\n        <button mat-stroked-button class=\"btnwhite\" (click)=\"gotolist()\">Cancel</button>\r\n    </div>\r\n\r\n</div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/viewlearners/viewlearners.component.html":
/*!*************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/viewlearners/viewlearners.component.html ***!
  \*************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayoutAlign=\"center\" id=\"viewlearner\" class=\"viewlearner\">\r\n    <div class=\"batchheader clflex flex-column rwidth\" *ngIf=\"batchdata_data != null\">\r\n        <div class=\"batchdetails flex-column\">\r\n            <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                <div fxLayout=\"row\" class=\"clflex rwidth \">\r\n                    <p>Training Evaluation Center : <span>{{batchdata_data.traning_center}}</span></p>\r\n                    <p>Batch No.: <span>{{batchdata_data.batach_no}}</span></p>\r\n                    <p>Batch Type: <span>{{batchdata_data.batch_type}}</span></p>\r\n                </div>\r\n                <p>\r\n                    <button mat-icon-button class=\"batchIcon\" [matMenuTriggerFor]=\"menu\"\r\n                        aria-label=\"Example icon-button with a menu\">\r\n                        <mat-icon>more_horiz</mat-icon>\r\n                    </button>\r\n                    <mat-menu class=\"topmenu\" #menu=\"matMenu\">\r\n                        <button mat-menu-item>\r\n                            <span>Edit</span>\r\n                        </button>\r\n                        <button mat-menu-item>\r\n                            <span>Change Assessor</span>\r\n                        </button>\r\n                        <button mat-menu-item>\r\n                            <span>Download Attendence Report</span>\r\n                        </button>\r\n                        <button mat-menu-item>\r\n                            <span>Assessor Change Request to OPAL</span>\r\n                        </button>\r\n                        <button mat-menu-item>\r\n                            <span>Request for Back Track</span>\r\n                        </button>\r\n                        <button mat-menu-item>\r\n                            <span>Audit Log</span>\r\n                        </button>\r\n                    </mat-menu>\r\n                </p>\r\n            </div>\r\n            <div fxLayout=\"row\" class=\"clflex rwidth\">\r\n                <p class=\"bor\">status: <span class=\"colgreen\">{{getassessmentstatus(batchdata_data.status)}}</span></p>\r\n                <p class=\"bor\">Office Type : <span>{{batchdata_data.office_type==1 ? 'Main Office' : 'Branch Office'}}</span></p>\r\n                <p class=\"bor\">Branch Name: <span>{{batchdata_data.branch_name}}</span></p>\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"batchdetails1\" fxLayout=\"row\">\r\n            <div class=\"batchdetails1innerdiv clflex flex-column\">\r\n                <p>Traning Duration </p>\r\n                <p class=\"fontblack\">{{batchdata_data.start_date}} to {{batchdata_data.end_date}}</p>\r\n            </div>\r\n            <div class=\"batchdetails1innerdiv clflex flex-column\">\r\n                <p>Total Learner </p>\r\n                <p class=\"fontblack\">{{batchdata_data.total_learners}}/{{batchdata_data.total}}</p>\r\n            </div>\r\n            <div class=\" batchdetails1innerdiv clflex flex-column\">\r\n                <p>Remaining Capacity</p>\r\n                <p class=\"fontblack\">{{batchdata_data.reamaining_learners}}/{{batchdata_data.total}}</p>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"leanertable m-t-40\">\r\n        <div class=\"leanertable1 clflex flex-row m-b-20\">\r\n            <div class=\"clflex flex-row toppage\">\r\n                <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"5\"\r\n                    [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                <button mat-stroked-button>Move to Quality Check</button>\r\n            </div>\r\n            <button mat-flat-button color=\"primary\" (click)=\"clickEvent()\">{{hidefilder ? 'Hide Filter' : 'Show Filter'}} <i\r\n                    class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                    <!-- <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                            class=\"filter\">{{filtername}}<i class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n -->\r\n        </div>\r\n        <div class=\"example-container\">\r\n            <mat-table [dataSource]=\"dataSource\" matSort class=\"learnerList\">\r\n                <!-- Checkbox Column -->\r\n                <ng-container matColumnDef=\"select\">\r\n                    <mat-header-cell fxFlex=\"65px\" mat-header-cell *matHeaderCellDef>\r\n                        <mat-checkbox (change)=\"$event ? toggleAllRows() : null\"\r\n                            [checked]=\"selection.hasValue() && isAllSelected()\"\r\n                            [indeterminate]=\"selection.hasValue() && !isAllSelected()\" [aria-label]=\"checkboxLabel()\">\r\n                        </mat-checkbox>\r\n                    </mat-header-cell>\r\n                    <mat-cell data-label=\"select\" fxFlex=\"65px\" *matCellDef=\"let element\">\r\n                        <mat-checkbox (click)=\"$event.stopPropagation()\"\r\n                            (change)=\"$event ? selection.toggle(element) : null\"\r\n                            [checked]=\"selection.isSelected(element)\" [aria-label]=\"checkboxLabel(element)\">\r\n                        </mat-checkbox>\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <!-- civilNumber Column -->\r\n                <ng-container matColumnDef=\"civilNumber\">\r\n                    <mat-header-cell fxFlex=\"200px\" mat-header-cell *matHeaderCellDef mat-sort-header> Civil Number\r\n                    </mat-header-cell>\r\n                    <mat-cell fxFlex=\"200px\" *matCellDef=\"let element\"> {{element.civilNumber}} </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Name Column -->\r\n                <ng-container matColumnDef=\"learnerName\">\r\n                    <mat-header-cell fxFlex=\"150px\" class=\"exwid\" mat-header-cell *matHeaderCellDef mat-sort-header>\r\n                        Learner Name </mat-header-cell>\r\n                    <mat-cell fxFlex=\"200px\" *matCellDef=\"let element\"> {{element.learnerName}} </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Weight Column -->\r\n                <ng-container matColumnDef=\"emailID\">\r\n                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef mat-sort-header> Email ID\r\n                    </mat-header-cell>\r\n                    <mat-cell fxFlex=\"150px\" *matCellDef=\"let element\"> {{element.emailID}} </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Symbol Column -->\r\n                <ng-container matColumnDef=\"age\">\r\n                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef mat-sort-header> Age\r\n                    </mat-header-cell>\r\n                    <mat-cell fxFlex=\"150px\" *matCellDef=\"let element\"> {{element.age}} </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Symbol Column -->\r\n                <ng-container matColumnDef=\"gender\">\r\n                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef mat-sort-header> Gender\r\n                    </mat-header-cell>\r\n                    <mat-cell fxFlex=\"150px\" *matCellDef=\"let element\"> {{element.gender}} </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Status Column -->\r\n                <ng-container matColumnDef=\"status\">\r\n                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef mat-sort-header> Status\r\n                    </mat-header-cell>\r\n                    <mat-cell fxFlex=\"150px\" *matCellDef=\"let element\" [ngSwitch]=\"element.status\">\r\n                        <span *ngSwitchCase=\"'Assessment'\" class=\"colpurple\">{{element.status}}</span>\r\n                        <span *ngSwitchCase=\"'Completed'\" class=\"colgreen\">{{element.status}}</span>\r\n                        <span *ngSwitchCase=\"'Retake Assessment'\" class=\"colpurple\">{{element.status}}</span>\r\n                        <span *ngSwitchDefault>{{element.status}}</span>\r\n                    </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Knowledge Assessment Column -->\r\n                <ng-container matColumnDef=\"knowledgeAssessment\">\r\n                    <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"exwid\" *matHeaderCellDef mat-sort-header>\r\n                        Knowledge Assessment </mat-header-cell>\r\n                    <mat-cell fxFlex=\"150px\" *matCellDef=\"let element\" [ngSwitch]=\"element.knowledgeAssessment\">\r\n                        <span *ngSwitchCase=\"'Pending'\" class=\"colorange\">{{element.knowledgeAssessment}}</span>\r\n                        <span *ngSwitchCase=\"'Pass'\" class=\"colgreen\">{{element.knowledgeAssessment}}</span>\r\n                        <span *ngSwitchCase=\"'Fail'\" class=\"colred\">{{element.knowledgeAssessment}}</span>\r\n                        <span *ngSwitchDefault>{{element.knowledgeAssessment}}</span>\r\n                    </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Practical Assessment Column -->\r\n                <ng-container matColumnDef=\"practicalAssessment\">\r\n                    <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"exwid\" *matHeaderCellDef mat-sort-header>\r\n                        Practical Assessment </mat-header-cell>\r\n                    <mat-cell fxFlex=\"150px\" *matCellDef=\"let element\" [ngSwitch]=\"element.practicalAssessment\">\r\n                        <span *ngSwitchCase=\"'Pending'\" class=\"colorange\">{{element.practicalAssessment}}</span>\r\n                        <span *ngSwitchCase=\"'Pass'\" class=\"colgreen\">{{element.practicalAssessment}}</span>\r\n                        <span *ngSwitchCase=\"'Fail'\" class=\"colred\">{{element.practicalAssessment}}</span>\r\n                        <span *ngSwitchCase=\"'Competent'\" class=\"colgreen\">{{element.practicalAssessment}}</span>\r\n                        <span *ngSwitchCase=\"'Non-Competent'\" class=\"colred\">{{element.practicalAssessment}}</span>\r\n                        <span *ngSwitchDefault>{{element.practicalAssessment}}</span>\r\n                    </mat-cell>\r\n                </ng-container>\r\n\r\n                <!-- Action Column -->\r\n                <ng-container matColumnDef=\"Action\">\r\n                    <mat-header-cell fxFlex=\"150px\" mat-header-cell *matHeaderCellDef> Action </mat-header-cell>\r\n                    <mat-cell fxFlex=\"150px\" *matCellDef=\"let element\">\r\n                        <button mat-icon-button [matMenuTriggerFor]=\"menu\" aria-label=\"Example icon-button with a menu\">\r\n                            <mat-icon>more_horiz</mat-icon>\r\n                        </button>\r\n                        <mat-menu #menu=\"matMenu\" class=\"tablemenu\">\r\n                            <button mat-menu-item *ngFor=\"let item of actionOption; let i=index\">\r\n                                <span>{{item}}</span>\r\n                            </button>\r\n                        </mat-menu>\r\n\r\n                    </mat-cell>\r\n                </ng-container>\r\n                <div id =\"table_align\">\r\n                    <ng-container matColumnDef=\"row-first\">\r\n                        <mat-header-cell fxFlex=\"50px\" mat-header-cell class=\"serachrow\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <!-- <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                            <mat-label>search</mat-label>\r\n                            <input matInput [formControl]=\"Awarding\">\r\n                        </mat-form-field> -->\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-second\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-three\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow exwid\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-four\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-five\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-six\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-seven\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-eight\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow exwid\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                    <ng-container matColumnDef=\"row-nine\">\r\n                        <mat-header-cell fxFlex=\"150px\" mat-header-cell class=\"serachrow exwid\" *matHeaderCellDef\r\n                            style=\"text-align:center\">\r\n                            <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>search</mat-label>\r\n                                <input matInput [formControl]=\"Awarding\">\r\n                            </mat-form-field>\r\n                        </mat-header-cell>\r\n                    </ng-container>\r\n                </div>\r\n                    <mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"displayedColumns\"></mat-header-row>\r\n                    <mat-header-row id=\"searchrow\"\r\n                        *matHeaderRowDef=\"['row-first' , 'row-second'  , 'row-three' , 'row-four', 'row-five' , 'row-six' , 'row-seven', 'row-eight', 'row-nine']\"></mat-header-row>\r\n                    <mat-row *matRowDef=\"let row; columns: displayedColumns;\"></mat-row>\r\n            </mat-table>\r\n            <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                    <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\" class=\"masterPage masterbottom \"\r\n                        showFirstLastButtons [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                        [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                        [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                    </mat-paginator>\r\n                </div>\r\n            </div>\r\n    </div>\r\n</div>\r\n</div>");

/***/ }),

/***/ "./node_modules/rxjs-compat/_esm2015/operators/map.js":
/*!************************************************************!*\
  !*** ./node_modules/rxjs-compat/_esm2015/operators/map.js ***!
  \************************************************************/
/*! exports provided: map */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm2015/operators/index.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "map", function() { return rxjs_operators__WEBPACK_IMPORTED_MODULE_0__["map"]; });


//# sourceMappingURL=map.js.map

/***/ }),

/***/ "./src/app/modules/assessmentreport/assessmentreport-routing.module.ts":
/*!*****************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/assessmentreport-routing.module.ts ***!
  \*****************************************************************************/
/*! exports provided: AssessmentreportRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AssessmentreportRoutingModule", function() { return AssessmentreportRoutingModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/auth/auth.guard */ "./src/app/auth/auth.guard.ts");
/* harmony import */ var _assessmentreport_assessmentreport_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./assessmentreport/assessmentreport.component */ "./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.ts");
/* harmony import */ var _viewandapprove_viewandapprove_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./viewandapprove/viewandapprove.component */ "./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.ts");
/* harmony import */ var _changeassessor_changeassessor_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./changeassessor/changeassessor.component */ "./src/app/modules/assessmentreport/changeassessor/changeassessor.component.ts");
/* harmony import */ var _learnerfeedback_learnerfeedback_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./learnerfeedback/learnerfeedback.component */ "./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.ts");
/* harmony import */ var _learnerfeedbacktable_learnerfeedbacktable_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./learnerfeedbacktable/learnerfeedbacktable.component */ "./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.ts");
/* harmony import */ var _learnerfeedbackview_learnerfeedbackview_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./learnerfeedbackview/learnerfeedbackview.component */ "./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.ts");
/* harmony import */ var _learnerreglist_learnerreglist_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./learnerreglist/learnerreglist.component */ "./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.ts");
/* harmony import */ var _learnerregstrn_learnerregstrn_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./learnerregstrn/learnerregstrn.component */ "./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.ts");












const routes = [
    { path: '',
        children: [
            {
                path: 'assessmentreport/:id',
                component: _assessmentreport_assessmentreport_component__WEBPACK_IMPORTED_MODULE_4__["AssessmentreportComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'Assessment Report',
                    urls: [
                        {
                            title: 'Batch Management', url: '/batchindex/batchgridlisting'
                        },
                        // {
                        //   title:'View Learners', url:'/candidatemanagement/viewlearner/:batch'
                        // },
                        {
                            title: 'Assessment Report', url: '/assessmentreport/assessmentreport'
                        }
                    ],
                },
            },
            {
                path: 'viewandapprove/:id',
                component: _viewandapprove_viewandapprove_component__WEBPACK_IMPORTED_MODULE_5__["ViewandapproveComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'Assessment Report Approval',
                    urls: [
                        {
                            title: 'Batch Management', url: '/batchindex/batchgridlisting'
                        },
                        // {
                        //   title:'View Learners', url:'/candidatemanagement/viewlearner/:batch'
                        // },
                        {
                            title: 'View & Approve Assessment Report', url: '/assessmentreport/viewandapprove/:id'
                        },
                    ],
                },
            },
            {
                path: 'changeassessor/:batchNo', component: _changeassessor_changeassessor_component__WEBPACK_IMPORTED_MODULE_6__["ChangeassessorComponent"], canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'changeassessor',
                    breadcrumb: 'changeassessors'
                }
            },
            {
                path: 'learnerfeedback/:id',
                component: _learnerfeedback_learnerfeedback_component__WEBPACK_IMPORTED_MODULE_7__["LearnerfeedbackComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'Learner Feedback',
                    urls: [
                        {
                            title: 'Learner Feedback', url: '/learnerfeedback/:id'
                        }
                    ]
                },
            },
            {
                path: 'learnerfeedbacklist',
                component: _learnerfeedbacktable_learnerfeedbacktable_component__WEBPACK_IMPORTED_MODULE_8__["LearnerfeedbacktableComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'Learner Feedback',
                    urls: [
                        {
                            title: 'Learner Feedback', url: '/learnerfeedbacklist'
                        }
                    ]
                },
            },
            {
                path: 'learnerfeedbackview/:id',
                component: _learnerfeedbackview_learnerfeedbackview_component__WEBPACK_IMPORTED_MODULE_9__["LearnerfeedbackviewComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'Learner Feedback View',
                    urls: [
                        {
                            title: 'Learner Feedback View', url: '/learnerfeedbackview/:id'
                        }
                    ]
                },
            }, {
                path: 'learnerregistrationlist',
                component: _learnerreglist_learnerreglist_component__WEBPACK_IMPORTED_MODULE_10__["LearnerreglistComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'Learner Registration',
                    urls: [
                        {
                            title: 'Learner Registration', url: '/learnerregistrationlist'
                        }
                    ]
                },
            },
            {
                path: 'learnerregistration',
                component: _learnerregstrn_learnerregstrn_component__WEBPACK_IMPORTED_MODULE_11__["LearnerregstrnComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'Learner Registration',
                    urls: [
                        {
                            title: 'Learner Registration', url: '/learnerregistration'
                        }
                    ]
                },
            },
        ], data: {
            title: 'Batch Management',
            breadcrumb: 'Batch Management'
        } }
];
let AssessmentreportRoutingModule = class AssessmentreportRoutingModule {
};
AssessmentreportRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })
], AssessmentreportRoutingModule);



/***/ }),

/***/ "./src/app/modules/assessmentreport/assessmentreport.module.ts":
/*!*********************************************************************!*\
  !*** ./src/app/modules/assessmentreport/assessmentreport.module.ts ***!
  \*********************************************************************/
/*! exports provided: createTranslateLoader, AssessmentreportModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function() { return createTranslateLoader; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AssessmentreportModule", function() { return AssessmentreportModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
/* harmony import */ var _app_shared__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/@shared */ "./src/app/@shared/index.ts");
/* harmony import */ var _assessmentreport_routing_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./assessmentreport-routing.module */ "./src/app/modules/assessmentreport/assessmentreport-routing.module.ts");
/* harmony import */ var _viewlearners_viewlearners_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./viewlearners/viewlearners.component */ "./src/app/modules/assessmentreport/viewlearners/viewlearners.component.ts");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
/* harmony import */ var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/flex-layout */ "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _assessmentreport_assessmentreport_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./assessmentreport/assessmentreport.component */ "./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.ts");
/* harmony import */ var _viewandapprove_viewandapprove_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./viewandapprove/viewandapprove.component */ "./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.ts");
/* harmony import */ var _changeassessor_changeassessor_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./changeassessor/changeassessor.component */ "./src/app/modules/assessmentreport/changeassessor/changeassessor.component.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! @ngx-translate/http-loader */ "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _learnerfeedback_learnerfeedback_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./learnerfeedback/learnerfeedback.component */ "./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.ts");
/* harmony import */ var _learnerfeedbacktable_learnerfeedbacktable_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./learnerfeedbacktable/learnerfeedbacktable.component */ "./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.ts");
/* harmony import */ var _learnerfeedbackview_learnerfeedbackview_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./learnerfeedbackview/learnerfeedbackview.component */ "./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.ts");
/* harmony import */ var _learnerreglist_learnerreglist_component__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./learnerreglist/learnerreglist.component */ "./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.ts");
/* harmony import */ var _learnerregstrn_learnerregstrn_component__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./learnerregstrn/learnerregstrn.component */ "./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.ts");
/* harmony import */ var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! @angular/material/tabs */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _mat_select_search_mat_select_search_module__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ../mat-select-search/mat-select-search.module */ "./src/app/modules/mat-select-search/mat-select-search.module.ts");
/* harmony import */ var _angular_material_autocomplete__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! @angular/material/autocomplete */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/autocomplete.js");
/* harmony import */ var _angular_material_button__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! @angular/material/button */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/button.js");
/* harmony import */ var _angular_material_button_toggle__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! @angular/material/button-toggle */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/button-toggle.js");
/* harmony import */ var _angular_material_card__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! @angular/material/card */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/card.js");
/* harmony import */ var _angular_material_checkbox__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! @angular/material/checkbox */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/checkbox.js");
/* harmony import */ var _angular_material_chips__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(/*! @angular/material/chips */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/chips.js");
/* harmony import */ var _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(/*! @angular/material/datepicker */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/datepicker.js");
/* harmony import */ var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(/*! @angular/material/dialog */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
/* harmony import */ var _angular_material_expansion__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(/*! @angular/material/expansion */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/expansion.js");
/* harmony import */ var _angular_material_grid_list__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(/*! @angular/material/grid-list */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/grid-list.js");
/* harmony import */ var _angular_material_icon__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(/*! @angular/material/icon */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/icon.js");
/* harmony import */ var _angular_material_input__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(/*! @angular/material/input */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/input.js");
/* harmony import */ var _angular_material_list__WEBPACK_IMPORTED_MODULE_35__ = __webpack_require__(/*! @angular/material/list */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/list.js");
/* harmony import */ var _angular_material_menu__WEBPACK_IMPORTED_MODULE_36__ = __webpack_require__(/*! @angular/material/menu */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/menu.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_37__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_38__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _angular_material_progress_bar__WEBPACK_IMPORTED_MODULE_39__ = __webpack_require__(/*! @angular/material/progress-bar */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/progress-bar.js");
/* harmony import */ var _angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_40__ = __webpack_require__(/*! @angular/material/progress-spinner */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/progress-spinner.js");
/* harmony import */ var _angular_material_radio__WEBPACK_IMPORTED_MODULE_41__ = __webpack_require__(/*! @angular/material/radio */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/radio.js");
/* harmony import */ var _angular_material_select__WEBPACK_IMPORTED_MODULE_42__ = __webpack_require__(/*! @angular/material/select */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/select.js");
/* harmony import */ var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_43__ = __webpack_require__(/*! @angular/material/sidenav */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
/* harmony import */ var _angular_material_slider__WEBPACK_IMPORTED_MODULE_44__ = __webpack_require__(/*! @angular/material/slider */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/slider.js");
/* harmony import */ var _angular_material_slide_toggle__WEBPACK_IMPORTED_MODULE_45__ = __webpack_require__(/*! @angular/material/slide-toggle */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/slide-toggle.js");
/* harmony import */ var _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_46__ = __webpack_require__(/*! @angular/material/snack-bar */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/snack-bar.js");
/* harmony import */ var _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_47__ = __webpack_require__(/*! @angular/material/toolbar */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/toolbar.js");
/* harmony import */ var _angular_material_tooltip__WEBPACK_IMPORTED_MODULE_48__ = __webpack_require__(/*! @angular/material/tooltip */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tooltip.js");
/* harmony import */ var _angular_material_stepper__WEBPACK_IMPORTED_MODULE_49__ = __webpack_require__(/*! @angular/material/stepper */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/stepper.js");
/* harmony import */ var _modal_changecommentmodal__WEBPACK_IMPORTED_MODULE_50__ = __webpack_require__(/*! ./modal/changecommentmodal */ "./src/app/modules/assessmentreport/modal/changecommentmodal.ts");
/* harmony import */ var _ckeditor_ckeditor5_angular__WEBPACK_IMPORTED_MODULE_51__ = __webpack_require__(/*! @ckeditor/ckeditor5-angular */ "./node_modules/@ckeditor/ckeditor5-angular/__ivy_ngcc__/fesm2015/ckeditor-ckeditor5-angular.js");





















































function createTranslateLoader(http) {
    return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_13__["TranslateHttpLoader"](http, './assets/i18n/maincenter/', '.json');
}
let AssessmentreportModule = class AssessmentreportModule {
};
AssessmentreportModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        declarations: [_viewlearners_viewlearners_component__WEBPACK_IMPORTED_MODULE_5__["ViewlearnersComponent"], _assessmentreport_assessmentreport_component__WEBPACK_IMPORTED_MODULE_9__["AssessmentreportComponent"], _viewandapprove_viewandapprove_component__WEBPACK_IMPORTED_MODULE_10__["ViewandapproveComponent"], _changeassessor_changeassessor_component__WEBPACK_IMPORTED_MODULE_11__["ChangeassessorComponent"], _modal_changecommentmodal__WEBPACK_IMPORTED_MODULE_50__["changecommentmodal"], _learnerfeedback_learnerfeedback_component__WEBPACK_IMPORTED_MODULE_15__["LearnerfeedbackComponent"], _learnerfeedbacktable_learnerfeedbacktable_component__WEBPACK_IMPORTED_MODULE_16__["LearnerfeedbacktableComponent"], _learnerfeedbackview_learnerfeedbackview_component__WEBPACK_IMPORTED_MODULE_17__["LearnerfeedbackviewComponent"], _learnerreglist_learnerreglist_component__WEBPACK_IMPORTED_MODULE_18__["LearnerreglistComponent"], _learnerregstrn_learnerregstrn_component__WEBPACK_IMPORTED_MODULE_19__["LearnerregstrnComponent"]],
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"],
            _app_shared__WEBPACK_IMPORTED_MODULE_3__["SharedModule"],
            _assessmentreport_routing_module__WEBPACK_IMPORTED_MODULE_4__["AssessmentreportRoutingModule"],
            _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__["MatSortModule"],
            _angular_flex_layout__WEBPACK_IMPORTED_MODULE_7__["FlexLayoutModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_8__["ReactiveFormsModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_8__["FormsModule"],
            _angular_common_http__WEBPACK_IMPORTED_MODULE_14__["HttpClientModule"],
            _angular_material_tabs__WEBPACK_IMPORTED_MODULE_20__["MatTabsModule"],
            _angular_material_table__WEBPACK_IMPORTED_MODULE_21__["MatTableModule"],
            _mat_select_search_mat_select_search_module__WEBPACK_IMPORTED_MODULE_22__["MatSelectSearchModule"],
            _angular_material_autocomplete__WEBPACK_IMPORTED_MODULE_23__["MatAutocompleteModule"],
            _angular_material_button__WEBPACK_IMPORTED_MODULE_24__["MatButtonModule"],
            _angular_material_button_toggle__WEBPACK_IMPORTED_MODULE_25__["MatButtonToggleModule"],
            _angular_material_card__WEBPACK_IMPORTED_MODULE_26__["MatCardModule"],
            _angular_material_checkbox__WEBPACK_IMPORTED_MODULE_27__["MatCheckboxModule"],
            _angular_material_chips__WEBPACK_IMPORTED_MODULE_28__["MatChipsModule"],
            _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_29__["MatDatepickerModule"],
            _angular_material_dialog__WEBPACK_IMPORTED_MODULE_30__["MatDialogModule"],
            _angular_material_expansion__WEBPACK_IMPORTED_MODULE_31__["MatExpansionModule"],
            _angular_material_grid_list__WEBPACK_IMPORTED_MODULE_32__["MatGridListModule"],
            _angular_material_icon__WEBPACK_IMPORTED_MODULE_33__["MatIconModule"],
            _angular_material_input__WEBPACK_IMPORTED_MODULE_34__["MatInputModule"],
            _angular_material_list__WEBPACK_IMPORTED_MODULE_35__["MatListModule"],
            _angular_material_menu__WEBPACK_IMPORTED_MODULE_36__["MatMenuModule"],
            _angular_material_core__WEBPACK_IMPORTED_MODULE_37__["MatNativeDateModule"],
            _angular_material_paginator__WEBPACK_IMPORTED_MODULE_38__["MatPaginatorModule"],
            _angular_material_progress_bar__WEBPACK_IMPORTED_MODULE_39__["MatProgressBarModule"],
            _angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_40__["MatProgressSpinnerModule"],
            _angular_material_radio__WEBPACK_IMPORTED_MODULE_41__["MatRadioModule"],
            _angular_material_core__WEBPACK_IMPORTED_MODULE_37__["MatRippleModule"],
            _angular_material_select__WEBPACK_IMPORTED_MODULE_42__["MatSelectModule"],
            _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_43__["MatSidenavModule"],
            _angular_material_slider__WEBPACK_IMPORTED_MODULE_44__["MatSliderModule"],
            _angular_material_slide_toggle__WEBPACK_IMPORTED_MODULE_45__["MatSlideToggleModule"],
            _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_46__["MatSnackBarModule"],
            _angular_material_sort__WEBPACK_IMPORTED_MODULE_6__["MatSortModule"],
            _angular_material_table__WEBPACK_IMPORTED_MODULE_21__["MatTableModule"],
            _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_47__["MatToolbarModule"],
            _angular_material_tooltip__WEBPACK_IMPORTED_MODULE_48__["MatTooltipModule"],
            _angular_material_stepper__WEBPACK_IMPORTED_MODULE_49__["MatStepperModule"],
            _ckeditor_ckeditor5_angular__WEBPACK_IMPORTED_MODULE_51__["CKEditorModule"],
            _ngx_translate_core__WEBPACK_IMPORTED_MODULE_12__["TranslateModule"].forChild({
                loader: {
                    provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_12__["TranslateLoader"],
                    useFactory: createTranslateLoader,
                    deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_14__["HttpClient"]]
                }
            }),
        ],
    })
], AssessmentreportModule);



/***/ }),

/***/ "./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.scss":
/*!*******************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.scss ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#assessmentreport {\n  display: flex;\n  flex-direction: column !important;\n  color: #848484;\n  letter-spacing: normal;\n  font-style: normal;\n  letter-spacing: normal;\n}\n#assessmentreport .batchheader {\n  display: flex;\n  border: 1px solid lightgray;\n  width: 100%;\n  padding: 10px 20px;\n}\n#assessmentreport .batchheader p {\n  padding: 0px 8px;\n  margin: 4px 0;\n}\n#assessmentreport .batchheader .batchinnerdiv p {\n  border: 1px solid lightgray;\n  margin-left: 10px;\n}\n#assessmentreport .assessment p {\n  padding: 0px 8px;\n  margin: 2px 0;\n}\n#assessmentreport .assessment button.mat-menu-item {\n  width: 50%;\n}\n#assessmentreport .assessment .mat-tab-label {\n  opacity: 1;\n  border-radius: 0;\n  background-clip: padding-box;\n  margin-right: 10px;\n  height: 36px;\n  justify-content: flex-start !important;\n}\n#assessmentreport .assessment .mat-tab-label.mat-tab-label-active {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n@media (max-width: 800px) {\n  #assessmentreport .assessment .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#assessmentreport .selectupload {\n  padding: 20px 0px 0px 0px;\n  border-radius: none;\n}\n#assessmentreport .uploadknowledgeassessment .mat-hint {\n  font-size: 12px;\n}\n#assessmentreport .uploadassessment {\n  display: flex;\n  padding: 20px;\n  border-radius: 0%;\n}\n#assessmentreport .uploadassessment .uploadfile .ng-hide {\n  box-sizing: border-box;\n}\n#assessmentreport .uploadassessment mat-form-field {\n  border-radius: none;\n}\n#assessmentreport .filter, #assessmentreport .selectupload {\n  border-radius: none;\n}\n#assessmentreport .hinpad {\n  padding: 0px 0px 28px 0px;\n  border-radius: none;\n}\n#assessmentreport .clflex {\n  display: flex;\n}\n#assessmentreport .rwidth {\n  width: 100%;\n}\n#assessmentreport .buttonalign {\n  text-align: right;\n}\n#assessmentreport .colblack {\n  color: #000 !important;\n}\n#assessmentreport .colgreen {\n  color: #00a551 !important;\n}\n#assessmentreport .colorange {\n  color: #f4811f !important;\n}\n#assessmentreport .colred, #assessmentreport .mat-sort-header-arrow {\n  color: #ed1c27 !important;\n}\n#assessmentreport .colpurple {\n  color: #d160d9;\n}\n#assessmentreport .colblue {\n  color: #626366;\n}\n#assessmentreport .colgrey {\n  color: #4c4d52;\n}\n#assessmentreport .btnbac {\n  background-color: #f5f5f5;\n  padding: 8px 0px;\n  border-radius: 0%;\n}\n#assessmentreport .uploadborder {\n  border: 1px dashed;\n  padding: 10px;\n}\n#assessmentreport .uploadborder button {\n  background-color: #f5f5f5;\n  width: 100%;\n  padding: 10px;\n}\n#assessmentreport .assessment {\n  padding-top: 28px;\n}\n#assessmentreport .btnbac.active {\n  background-color: #0c4b9a !important;\n  color: white;\n}\n#assessmentreport .btnred {\n  background-color: #ed1c27;\n  color: #fff;\n  padding: 7px 26px;\n  margin-left: 15px;\n  border-radius: 0px;\n}\n#assessmentreport .btnwhite {\n  padding: 7px 26px;\n  border-radius: 0px;\n}\n#assessmentreport .example-radio-group {\n  display: flex;\n  flex-direction: column;\n  margin: 15px 0;\n  align-items: flex-start;\n  margin-left: 15px;\n}\n#assessmentreport .example-radio-button {\n  margin: 5px;\n}\n#assessmentreport #example-radio-group-label {\n  color: #000;\n}\n#assessmentreport .qualitycheckstatus {\n  border: 1px solid red;\n  padding: 10px 20px;\n  margin: 20px 0px;\n  background-color: #fff8f8;\n}\n#assessmentreport .fpara {\n  color: red;\n  font-weight: 600;\n}\n#assessmentreport .qcinnerf {\n  border-bottom: 1px solid #848484;\n  color: #000;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n#assessmentreport .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#assessmentreport .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#assessmentreport .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#assessmentreport .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#assessmentreport .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#assessmentreport .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#assessmentreport .mat-form-field.mat-focused.mat-primary .mat-select-arrow {\n  color: transparent !important;\n}\n#assessmentreport .mat-form-field.mat-form-field-invalid .mat-form-field-label {\n  color: #dc4c64 !important;\n}\n#assessmentreport .mat-form-field-suffix .mat-icon {\n  color: #848484;\n  cursor: pointer;\n}\n#assessmentreport .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: #d9d9d9 !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2Fzc2Vzc21lbnRyZXBvcnQvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcYXNzZXNzbWVudHJlcG9ydFxcYXNzZXNzbWVudHJlcG9ydFxcYXNzZXNzbWVudHJlcG9ydC5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2Fzc2Vzc21lbnRyZXBvcnQvYXNzZXNzbWVudHJlcG9ydC5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtFQUNJLGFBQUE7RUFDQSxpQ0FBQTtFQUNBLGNBQUE7RUFDQSxzQkFBQTtFQUNBLGtCQUFBO0VBQ0Esc0JBQUE7QUNDSjtBRENJO0VBQ0ksYUFBQTtFQUNBLDJCQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0FDQ1I7QURBUTtFQUNJLGdCQUFBO0VBQ0EsYUFBQTtBQ0VaO0FEQ1k7RUFDSSwyQkFBQTtFQUNBLGlCQUFBO0FDQ2hCO0FET1E7RUFDSSxnQkFBQTtFQUNBLGFBQUE7QUNMWjtBRE9RO0VBQ0ksVUFBQTtBQ0xaO0FEU1E7RUFDSSxVQUFBO0VBQ0EsZ0JBQUE7RUFDQSw0QkFBQTtFQUVBLGtCQUFBO0VBQ0EsWUFBQTtFQUNBLHNDQUFBO0FDUlo7QURTWTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNQaEI7QURTWTtFQVpKO0lBYVEsbUJBQUE7RUNOZDtBQUNGO0FEVUk7RUFDSSx5QkFBQTtFQUNBLG1CQUFBO0FDUlI7QURXSTtFQUNJLGVBQUE7QUNUUjtBRFdJO0VBQ0ksYUFBQTtFQUNBLGFBQUE7RUFDQSxpQkFBQTtBQ1RSO0FEV1k7RUFDSSxzQkFBQTtBQ1RoQjtBRGNJO0VBQ0ksbUJBQUE7QUNaUjtBRGVJO0VBQ0ksbUJBQUE7QUNiUjtBRGVJO0VBQ0kseUJBQUE7RUFDQSxtQkFBQTtBQ2JSO0FEZ0JJO0VBQ0ksYUFBQTtBQ2RSO0FEZ0JJO0VBQ0ksV0FBQTtBQ2RSO0FEZ0JJO0VBQ0ksaUJBQUE7QUNkUjtBRGdCSTtFQUNJLHNCQUFBO0FDZFI7QURnQkk7RUFDSSx5QkFBQTtBQ2RSO0FEZ0JJO0VBQ0kseUJBQUE7QUNkUjtBRGdCSTtFQUNJLHlCQUFBO0FDZFI7QURnQkk7RUFDSSxjQUFBO0FDZFI7QURnQkk7RUFDSSxjQUFBO0FDZFI7QURnQkk7RUFDSSxjQUFBO0FDZFI7QURnQkk7RUFDSSx5QkFBQTtFQUNBLGdCQUFBO0VBQ0EsaUJBQUE7QUNkUjtBRGdCRztFQUNDLGtCQUFBO0VBQ0EsYUFBQTtBQ2RKO0FEZUk7RUFDSSx5QkFBQTtFQUNBLFdBQUE7RUFDQSxhQUFBO0FDYlI7QURnQkc7RUFDQyxpQkFBQTtBQ2RKO0FEZ0JHO0VBQ0Msb0NBQUE7RUFDQSxZQUFBO0FDZEo7QURnQkc7RUFDSyx5QkFBQTtFQUNBLFdBQUE7RUFDQSxpQkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7QUNkUjtBRGlCRztFQUNDLGlCQUFBO0VBQ0Esa0JBQUE7QUNmSjtBRGtCRztFQUNDLGFBQUE7RUFDQSxzQkFBQTtFQUNBLGNBQUE7RUFDQSx1QkFBQTtFQUNBLGlCQUFBO0FDaEJKO0FEbUJFO0VBQ0UsV0FBQTtBQ2pCSjtBRG1CRTtFQUNFLFdBQUE7QUNqQko7QURtQkU7RUFDRSxxQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZ0JBQUE7RUFDQSx5QkFBQTtBQ2pCSjtBRG9CQTtFQUNJLFVBQUE7RUFDQSxnQkFBQTtBQ2xCSjtBRG9CQTtFQUNJLGdDQUFBO0VBQ0EsV0FBQTtBQ2xCSjtBRHVCSTtFQUVJLG9DQUFBO0FDdEJSO0FEMkJJO0VBQ0ksY0FBQTtBQ3pCUjtBRDRCSTtFQUNJLDBCQUFBO0FDMUJSO0FENkJJO0VBQ0ksMEJBQUE7QUMzQlI7QUQ4Qkk7RUFDSSxjQUFBO0FDNUJSO0FEK0JJO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDN0JSO0FEa0NRO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDaENaO0FEcUNnQjtFQUNJLGNBQUE7QUNuQ3BCO0FEMENRO0VBQ0kseUJBQUE7QUN4Q1o7QUQ4Q1E7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUM1Q1o7QURrRFk7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUNoRGhCO0FEa0RnQjtFQUNJLGNBQUE7QUNoRHBCO0FEb0RZO0VBQ0kscUJBQUE7QUNsRGhCO0FEMERZO0VBQ0ksNkJBQUE7QUN4RGhCO0FEZ0VRO0VBQ0kseUJBQUE7QUM5RFo7QURtRUk7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQ2pFUjtBRHFFSTtFQUNJLG9DQUFBO0FDbkVSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2Fzc2Vzc21lbnRyZXBvcnQvYXNzZXNzbWVudHJlcG9ydC5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIiNhc3Nlc3NtZW50cmVwb3J0e1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW4gIWltcG9ydGFudDtcclxuICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcclxuICAgIGZvbnQtc3R5bGU6IG5vcm1hbDtcclxuICAgIGxldHRlci1zcGFjaW5nOiBub3JtYWw7XHJcbiAgIFxyXG4gICAgLmJhdGNoaGVhZGVye1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIHBhZGRpbmc6IDEwcHggMjBweDtcclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgcGFkZGluZzogMHB4IDhweDtcclxuICAgICAgICAgICAgbWFyZ2luOiA0cHggMDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmJhdGNoaW5uZXJkaXZ7XHJcbiAgICAgICAgICAgIHB7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tbGVmdDogMTBweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYXNzZXNzbWVudHtcclxuICAgICAgICAvL3dpZHRoOiAxMDAlO1xyXG4gICAgICAgIC8vcGFkZGluZzogICAzMHB4IDBweDtcclxuICAgICAgICBwIHtcclxuICAgICAgICAgICAgcGFkZGluZzogMHB4IDhweDtcclxuICAgICAgICAgICAgbWFyZ2luOiAycHggMDtcclxuICAgICAgICB9XHJcbiAgICAgICAgYnV0dG9uLm1hdC1tZW51LWl0ZW17XHJcbiAgICAgICAgICAgIHdpZHRoOiA1MCU7XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuICAgICAgXHJcbiAgICAgICAgLm1hdC10YWItbGFiZWwge1xyXG4gICAgICAgICAgICBvcGFjaXR5OiAxO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAwO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgICAgIC8vIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiAzNnB4O1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDsgIFxyXG4gICAgICAgICAgICAmLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6ODAwcHgpe1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbToxMHB4O1xyXG4gICAgICAgICAgICAgfSAgIFxyXG4gICAgICAgIH1cclxuXHJcbiAgICB9XHJcbiAgICAuc2VsZWN0dXBsb2Fke1xyXG4gICAgICAgIHBhZGRpbmc6IDIwcHggMHB4IDBweCAwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogbm9uZTtcclxuICAgICAgICBcclxuICAgIH1cclxuICAgIC51cGxvYWRrbm93bGVkZ2Vhc3Nlc3NtZW50IC5tYXQtaGludHtcclxuICAgICAgICBmb250LXNpemU6IDEycHg7XHJcbiAgICB9XHJcbiAgICAudXBsb2FkYXNzZXNzbWVudHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHBhZGRpbmc6IDIwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMCU7XHJcbiAgICAgICAgLnVwbG9hZGZpbGV7XHJcbiAgICAgICAgICAgIC5uZy1oaWRle1xyXG4gICAgICAgICAgICAgICAgYm94LXNpemluZzogYm9yZGVyLWJveDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICBcclxuICAgIG1hdC1mb3JtLWZpZWxke1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IG5vbmU7XHJcbiAgICB9XHJcbiAgICB9XHJcbiAgICAuZmlsdGVyLC5zZWxlY3R1cGxvYWR7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogbm9uZTtcclxuICAgIH1cclxuICAgIC5oaW5wYWR7XHJcbiAgICAgICAgcGFkZGluZzowcHggMHB4IDI4cHggMHB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IG5vbmU7XHJcbiAgICAgICAgXHJcbiAgICB9XHJcbiAgICAuY2xmbGV4e1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICB9XHJcbiAgICAucndpZHRoe1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgfVxyXG4gICAgLmJ1dHRvbmFsaWdue1xyXG4gICAgICAgIHRleHQtYWxpZ246IHJpZ2h0O1xyXG4gICAgfVxyXG4gICAgLmNvbGJsYWNre1xyXG4gICAgICAgIGNvbG9yOiAjMDAwICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29sZ3JlZW57XHJcbiAgICAgICAgY29sb3I6ICMwMGE1NTEgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jb2xvcmFuZ2V7XHJcbiAgICAgICAgY29sb3I6ICNmNDgxMWYgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jb2xyZWQsIC5tYXQtc29ydC1oZWFkZXItYXJyb3d7XHJcbiAgICAgICAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5jb2xwdXJwbGV7XHJcbiAgICAgICAgY29sb3I6ICNkMTYwZDk7XHJcbiAgICB9IFxyXG4gICAgLmNvbGJsdWV7XHJcbiAgICAgICAgY29sb3I6IzYyNjM2NlxyXG4gICAgfVxyXG4gICAgLmNvbGdyZXl7XHJcbiAgICAgICAgY29sb3I6IzRjNGQ1MlxyXG4gICAgfVxyXG4gICAgLmJ0bmJhY3tcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7XHJcbiAgICAgICAgcGFkZGluZzogOHB4IDBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAwJTtcclxuICAgIH1cclxuICAgLnVwbG9hZGJvcmRlcntcclxuICAgIGJvcmRlcjogMXB4IGRhc2hlZDtcclxuICAgIHBhZGRpbmc6IDEwcHg7XHJcbiAgICBidXR0b257XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNTtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBwYWRkaW5nOiAxMHB4O1xyXG4gICAgfVxyXG4gICB9XHJcbiAgIC5hc3Nlc3NtZW50e1xyXG4gICAgcGFkZGluZy10b3A6IDI4cHg7XHJcbiAgIH1cclxuICAgLmJ0bmJhYy5hY3RpdmV7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICBjb2xvcjogd2hpdGU7XHJcbiAgIH1cclxuICAgLmJ0bnJlZHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3O1xyXG4gICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgIHBhZGRpbmc6IDdweCAyNnB4O1xyXG4gICAgICAgIG1hcmdpbi1sZWZ0OiAxNXB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICAgfVxyXG5cclxuICAgLmJ0bndoaXRle1xyXG4gICAgcGFkZGluZzogN3B4IDI2cHg7XHJcbiAgICBib3JkZXItcmFkaXVzOiAwcHg7XHJcbiAgIH1cclxuXHJcbiAgIC5leGFtcGxlLXJhZGlvLWdyb3VwIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xyXG4gICAgbWFyZ2luOiAxNXB4IDA7XHJcbiAgICBhbGlnbi1pdGVtczogZmxleC1zdGFydDtcclxuICAgIG1hcmdpbi1sZWZ0OiAxNXB4O1xyXG4gIH1cclxuICBcclxuICAuZXhhbXBsZS1yYWRpby1idXR0b24ge1xyXG4gICAgbWFyZ2luOiA1cHg7XHJcbiAgfVxyXG4gICNleGFtcGxlLXJhZGlvLWdyb3VwLWxhYmVse1xyXG4gICAgY29sb3I6ICMwMDA7XHJcbiAgfVxyXG4gIC5xdWFsaXR5Y2hlY2tzdGF0dXMge1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgcmVkO1xyXG4gICAgcGFkZGluZzogMTBweCAyMHB4O1xyXG4gICAgbWFyZ2luOiAyMHB4IDBweDtcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY4Zjg7XHJcbn1cclxuXHJcbi5mcGFyYXtcclxuICAgIGNvbG9yOiByZWQ7XHJcbiAgICBmb250LXdlaWdodDogNjAwO1xyXG59XHJcbi5xY2lubmVyZntcclxuICAgIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjODQ4NDg0O1xyXG4gICAgY29sb3I6ICMwMDA7XHJcbn1cclxuLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcblxyXG4gICAgLy8gJi5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICYubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xyXG4gICAgICAgIC8vIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA5YzNhICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgLy8gfVxyXG4gICAgICAgIC8vIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgY29sb3I6ICNkOWQ5ZDk7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgIGNvbG9yOiAjNmJhNWVjO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcblxyXG4gICAgfVxyXG5cclxuICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgJi5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcblxyXG4gICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLS45cmVtKSBzY2FsZSgwLjc1KTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcbi5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAmLm1hdC1wcmltYXJ5IHtcclxuICAgICAgICAgICAgLm1hdC1zZWxlY3QtYXJyb3cge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuXHJcbi5tYXQtZm9ybS1maWVsZCB7XHJcbiAgICAmLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcbi5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xyXG4gICAgLm1hdC1pY29uIHtcclxuICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICB9XHJcbn1cclxuLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IHtcclxuICAgIC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNkOWQ5ZDkgIWltcG9ydGFudDtcclxuICAgIH1cclxufVxyXG59XHJcbiIsIiNhc3Nlc3NtZW50cmVwb3J0IHtcbiAgZGlzcGxheTogZmxleDtcbiAgZmxleC1kaXJlY3Rpb246IGNvbHVtbiAhaW1wb3J0YW50O1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcbiAgZm9udC1zdHlsZTogbm9ybWFsO1xuICBsZXR0ZXItc3BhY2luZzogbm9ybWFsO1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmJhdGNoaGVhZGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xuICB3aWR0aDogMTAwJTtcbiAgcGFkZGluZzogMTBweCAyMHB4O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmJhdGNoaGVhZGVyIHAge1xuICBwYWRkaW5nOiAwcHggOHB4O1xuICBtYXJnaW46IDRweCAwO1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmJhdGNoaGVhZGVyIC5iYXRjaGlubmVyZGl2IHAge1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG4gIG1hcmdpbi1sZWZ0OiAxMHB4O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmFzc2Vzc21lbnQgcCB7XG4gIHBhZGRpbmc6IDBweCA4cHg7XG4gIG1hcmdpbjogMnB4IDA7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuYXNzZXNzbWVudCBidXR0b24ubWF0LW1lbnUtaXRlbSB7XG4gIHdpZHRoOiA1MCU7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuYXNzZXNzbWVudCAubWF0LXRhYi1sYWJlbCB7XG4gIG9wYWNpdHk6IDE7XG4gIGJvcmRlci1yYWRpdXM6IDA7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIG1hcmdpbi1yaWdodDogMTBweDtcbiAgaGVpZ2h0OiAzNnB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5hc3Nlc3NtZW50IC5tYXQtdGFiLWxhYmVsLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDgwMHB4KSB7XG4gICNhc3Nlc3NtZW50cmVwb3J0IC5hc3Nlc3NtZW50IC5tYXQtdGFiLWxhYmVsIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuc2VsZWN0dXBsb2FkIHtcbiAgcGFkZGluZzogMjBweCAwcHggMHB4IDBweDtcbiAgYm9yZGVyLXJhZGl1czogbm9uZTtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC51cGxvYWRrbm93bGVkZ2Vhc3Nlc3NtZW50IC5tYXQtaGludCB7XG4gIGZvbnQtc2l6ZTogMTJweDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC51cGxvYWRhc3Nlc3NtZW50IHtcbiAgZGlzcGxheTogZmxleDtcbiAgcGFkZGluZzogMjBweDtcbiAgYm9yZGVyLXJhZGl1czogMCU7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAudXBsb2FkYXNzZXNzbWVudCAudXBsb2FkZmlsZSAubmctaGlkZSB7XG4gIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAudXBsb2FkYXNzZXNzbWVudCBtYXQtZm9ybS1maWVsZCB7XG4gIGJvcmRlci1yYWRpdXM6IG5vbmU7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuZmlsdGVyLCAjYXNzZXNzbWVudHJlcG9ydCAuc2VsZWN0dXBsb2FkIHtcbiAgYm9yZGVyLXJhZGl1czogbm9uZTtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5oaW5wYWQge1xuICBwYWRkaW5nOiAwcHggMHB4IDI4cHggMHB4O1xuICBib3JkZXItcmFkaXVzOiBub25lO1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmNsZmxleCB7XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAucndpZHRoIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuYnV0dG9uYWxpZ24ge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5jb2xibGFjayB7XG4gIGNvbG9yOiAjMDAwICFpbXBvcnRhbnQ7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuY29sZ3JlZW4ge1xuICBjb2xvcjogIzAwYTU1MSAhaW1wb3J0YW50O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmNvbG9yYW5nZSB7XG4gIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuY29scmVkLCAjYXNzZXNzbWVudHJlcG9ydCAubWF0LXNvcnQtaGVhZGVyLWFycm93IHtcbiAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5jb2xwdXJwbGUge1xuICBjb2xvcjogI2QxNjBkOTtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5jb2xibHVlIHtcbiAgY29sb3I6ICM2MjYzNjY7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuY29sZ3JleSB7XG4gIGNvbG9yOiAjNGM0ZDUyO1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmJ0bmJhYyB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjU7XG4gIHBhZGRpbmc6IDhweCAwcHg7XG4gIGJvcmRlci1yYWRpdXM6IDAlO1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLnVwbG9hZGJvcmRlciB7XG4gIGJvcmRlcjogMXB4IGRhc2hlZDtcbiAgcGFkZGluZzogMTBweDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC51cGxvYWRib3JkZXIgYnV0dG9uIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNTtcbiAgd2lkdGg6IDEwMCU7XG4gIHBhZGRpbmc6IDEwcHg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuYXNzZXNzbWVudCB7XG4gIHBhZGRpbmctdG9wOiAyOHB4O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmJ0bmJhYy5hY3RpdmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiB3aGl0ZTtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5idG5yZWQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3O1xuICBjb2xvcjogI2ZmZjtcbiAgcGFkZGluZzogN3B4IDI2cHg7XG4gIG1hcmdpbi1sZWZ0OiAxNXB4O1xuICBib3JkZXItcmFkaXVzOiAwcHg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAuYnRud2hpdGUge1xuICBwYWRkaW5nOiA3cHggMjZweDtcbiAgYm9yZGVyLXJhZGl1czogMHB4O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmV4YW1wbGUtcmFkaW8tZ3JvdXAge1xuICBkaXNwbGF5OiBmbGV4O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uO1xuICBtYXJnaW46IDE1cHggMDtcbiAgYWxpZ24taXRlbXM6IGZsZXgtc3RhcnQ7XG4gIG1hcmdpbi1sZWZ0OiAxNXB4O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmV4YW1wbGUtcmFkaW8tYnV0dG9uIHtcbiAgbWFyZ2luOiA1cHg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAjZXhhbXBsZS1yYWRpby1ncm91cC1sYWJlbCB7XG4gIGNvbG9yOiAjMDAwO1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLnF1YWxpdHljaGVja3N0YXR1cyB7XG4gIGJvcmRlcjogMXB4IHNvbGlkIHJlZDtcbiAgcGFkZGluZzogMTBweCAyMHB4O1xuICBtYXJnaW46IDIwcHggMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmOGY4O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLmZwYXJhIHtcbiAgY29sb3I6IHJlZDtcbiAgZm9udC13ZWlnaHQ6IDYwMDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5xY2lubmVyZiB7XG4gIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjODQ4NDg0O1xuICBjb2xvcjogIzAwMDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA5YzNhICFpbXBvcnRhbnQ7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgY29sb3I6ICNkOWQ5ZDk7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcbiAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICM2YmE1ZWM7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYXNzZXNzbWVudHJlcG9ydCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0wLjlyZW0pIHNjYWxlKDAuNzUpO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5tYXQtZm9ybS1maWVsZC5tYXQtZm9jdXNlZC5tYXQtcHJpbWFyeSAubWF0LXNlbGVjdC1hcnJvdyB7XG4gIGNvbG9yOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xufVxuI2Fzc2Vzc21lbnRyZXBvcnQgLm1hdC1mb3JtLWZpZWxkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICNkYzRjNjQgIWltcG9ydGFudDtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5tYXQtZm9ybS1maWVsZC1zdWZmaXggLm1hdC1pY29uIHtcbiAgY29sb3I6ICM4NDg0ODQ7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNhc3Nlc3NtZW50cmVwb3J0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Q5ZDlkOSAhaW1wb3J0YW50O1xufSJdfQ== */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.ts":
/*!*****************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.ts ***!
  \*****************************************************************************************/
/*! exports provided: AssessmentreportComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AssessmentreportComponent", function() { return AssessmentreportComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/services/assessmentReport.service */ "./src/app/services/assessmentReport.service.ts");
/* harmony import */ var _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @app/@shared/filee/filee */ "./src/app/@shared/filee/filee.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! sweetalert */ "./node_modules/sweetalert/dist/sweetalert.min.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");











let AssessmentreportComponent = class AssessmentreportComponent {
    constructor(translate, fb, assessmentService, route, router, cookieService, remoteService) {
        this.translate = translate;
        this.fb = fb;
        this.assessmentService = assessmentService;
        this.route = route;
        this.router = router;
        this.cookieService = cookieService;
        this.remoteService = remoteService;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
        this.assessmentType = '';
        this.examType = 1;
        this.seasons = ['Winter', 'Spring', 'Summer', 'Autumn'];
        this.questions = [
            {
                question: "Pick your favorite season Test ?",
                answers: ['Winter', 'Spring', 'Summer', 'Autumn']
            },
            {
                question: "Pick your favorite season Test1 ?",
                answers: ['Winter', 'Spring', 'Summer', 'Autumn']
            },
            {
                question: "Pick your favorite season Test2 ?",
                answers: ['Winter', 'Spring', 'Summer', 'Autumn']
            },
            {
                question: "Pick your favorite season Test3 ?",
                answers: ['Winter', 'Spring', 'Summer', 'Autumn']
            },
        ];
        this.formloading = true;
    }
    i18n(key) {
        return this.translate.instant(key);
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
            }
        });
        this.id = this.route.snapshot.paramMap.get('id');
        this.getlearnerdata(this.id);
        this.knw_file = {
            fileMstPk: 5,
            selectedFilesPk: []
        };
        this.pra_file = {
            fileMstPk: 6,
            selectedFilesPk: []
        };
    }
    getlearnerdata(id) {
        this.assessmentService.getleanerdata(id).subscribe(data => {
            this.learnerData = data.data;
            if (this.learnerData.isknw == 1 && this.learnerData.ispra == 1 && this.learnerData.status == 6) {
                if (this.learnerData.kStatus == null) {
                    this.btnactive = false;
                    this.assessmentType = 'Knowleadge';
                }
                else if (this.learnerData.pStatus == null) {
                    this.btnactive = true;
                    this.assessmentType = 'pratical';
                }
            }
            else if (this.learnerData.isknw == 1 && this.learnerData.ispra != 1 && !this.learnerData.kStatus && this.learnerData.status == 6) {
                this.btnactive = false;
                this.assessmentType = 'Knowleadge';
            }
            else if (this.learnerData.isknw != 1 && this.learnerData.ispra == 1 && !this.learnerData.pStatus && this.learnerData.status == 6) {
                this.btnactive = true;
                this.assessmentType = 'pratical';
            }
            else if (this.learnerData.isknw == 1 && this.learnerData.ispra == 1 && this.learnerData.status == 8) {
                this.btnactive = false;
                this.assessmentType = 'Knowleadge';
            }
            else if (this.learnerData.isknw == 1 && this.learnerData.ispra != 1 && !this.learnerData.kStatus && this.learnerData.status == 8) {
                this.btnactive = false;
                this.assessmentType = 'Knowleadge';
            }
            else if (this.learnerData.isknw != 1 && this.learnerData.ispra == 1 && !this.learnerData.pStatus && this.learnerData.status == 8) {
                this.btnactive = true;
                this.assessmentType = 'pratical';
            }
            if (this.learnerData.status == 6) {
                this.assessmentReportForm = this.fb.group({
                    type: ["1", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    mark: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    percentage: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    comments: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    file: ["1", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
                });
                this.assessmentReportPraticalForm = this.fb.group({
                    type: ["1", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    comments: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    file: ["1", _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
                });
                this.formloading = false;
                if (this.learnerData.ispra == 1 && this.learnerData.ispramark == 1) {
                    this.assessmentReportPraticalForm.addControl('mark', new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required));
                    this.assessmentReportPraticalForm.addControl('percentage', new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required));
                }
                else if (this.learnerData.ispra == 1 && this.learnerData.ispramark != 1) {
                    this.assessmentReportPraticalForm.addControl('status', new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required));
                }
            }
            if (this.learnerData.status == 8) {
                this.getassessmentreport(this.learnerData.learnerPK);
            }
        });
    }
    getassessmentreport(id) {
        this.assessmentService.getassessmentreport(id).subscribe(data => {
            this.assessmentreport = data.data;
            let kreport = this.assessmentreport.filter(item => item.asmtm_InternalAsmt == 1);
            this.kreport = kreport ? kreport[0] : null;
            let preport = this.assessmentreport.filter(item => item.asmtm_InternalAsmt == 2);
            this.preport = preport ? preport[0] : null;
            console.log('this.kreport', this.kreport);
            console.log('this.preport', this.preport);
            if (this.kreport != null) {
                this.assessmentReportForm = this.fb.group({
                    type: [this.kreport.lasmth_AsmtType, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    mark: [this.kreport.lasmth_MarkSecured, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    percentage: [this.kreport.lasmth_percentage, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    comments: [this.kreport.lasmth_AppdecComments, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    file: [this.kreport.lasmth_AsmtUpload, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
                });
            }
            if (this.preport != null) {
                this.assessmentReportPraticalForm = this.fb.group({
                    type: [this.kreport.lasmth_AsmtType, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    comments: [this.kreport.lasmth_AppdecComments, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
                    file: [this.kreport.lasmth_AsmtUpload, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
                });
                if (this.learnerData.ispra == 1 && this.learnerData.ispramark == 1) {
                    this.assessmentReportPraticalForm.addControl('mark', new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](this.kreport.lasmth_MarkSecured, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required));
                    this.assessmentReportPraticalForm.addControl('percentage', new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](this.kreport.lasmth_percentage, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required));
                }
                else if (this.learnerData.ispra == 1 && this.learnerData.ispramark != 1) {
                    this.assessmentReportPraticalForm.addControl('status', new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"](this.learnerData.pStatus, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required));
                }
            }
            this.formloading = false;
        });
    }
    fileeSelected(file, fileId) {
        fileId.selectedFilesPk = file;
        this.assessmentReportForm.controls['file'].setValue(file[0]);
        this.kupload_name = fileId.selectedFilesPk[0];
    }
    pfileeSelected(file, fileId) {
        fileId.selectedFilesPk = file;
        this.assessmentReportPraticalForm.controls['file'].setValue(file[0]);
        this.pupload_name = fileId.selectedFilesPk[0];
    }
    changeassessment(type) {
        if (type == 'knowleadge') {
            this.btnactive = false;
            this.assessmentType = 'Knowleadge';
        }
        else {
            this.btnactive = true;
            this.assessmentType = 'pratical';
        }
    }
    onSubmit(type) {
        let data;
        if (type == 'knowleadge') {
            data = this.assessmentReportForm.value;
            data.status = this.learnerData.kminmark <= data.mark ? 'Pass' : 'Fail';
        }
        else {
            data = this.assessmentReportPraticalForm.value;
            if (this.learnerData.ispramark == 1) {
                data.status = this.learnerData.pminmark <= data.mark ? 'Pass' : 'Fail';
            }
        }
        data.learnerPK = this.learnerData.learnerPK;
        data.batckPK = this.learnerData.batckPK;
        data.batchassessor = this.learnerData.batchassessor;
        data.staffPK = this.learnerData.staffPK;
        data.standcoursePK = this.learnerData.standcoursePK;
        data.asmtstatus = 1;
        data.assessmentType = type == 'knowleadge' ? 1 : 2;
        if (this.learnerData.status == 8) {
            data.LearnerAsmtHdr_PK = type == 'knowleadge' ? this.kreport.LearnerAsmtHdr_PK : this.preport.LearnerAsmtHdr_PK;
        }
        console.log(data);
        this.assessmentService.saveassessmentreport(data).subscribe(res => {
            if (this.learnerData.isknw == 1 && this.learnerData.ispra == 1 && type == 'knowleadge') {
                this.changeassessment('partical');
            }
            else {
                this.updatestatus();
            }
        });
    }
    updatestatus() {
        this.assessmentService.updatelearnerstatus(this.id).subscribe(res => {
            sweetalert__WEBPACK_IMPORTED_MODULE_7___default()({
                title: 'Saved successfully',
                text: " ",
                icon: 'warning',
                buttons: [false, "Ok"],
                dangerMode: true,
                closeOnClickOutside: false
            }).then(() => {
                this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);
            });
        });
    }
    getassessmentstatus(no) {
        // 1-New, 2-Teaching(theory),3-Teaching(practical),4-No Show(theory),5-No Show(practical), 6-Assessment, 7-Quality Check,8-Declined during Quality Check,9-Resubmitted for Quality Check 10-Print
        if (no == 1) {
            return 'New';
        }
        else if (no == 2) {
            return 'Teaching(theory)';
        }
        else if (no == 3) {
            return 'Teaching(practical)';
        }
        else if (no == 4) {
            return 'No Show(theory)';
        }
        else if (no == 5) {
            return 'No Show(practical)';
        }
        else if (no == 6) {
            return 'Assessment';
        }
        else if (no == 7) {
            return 'Quality Check';
        }
        else if (no == 8) {
            return 'Declined during Quality Check';
        }
        else if (no == 9) {
            return 'Resubmitted for Quality Check';
        }
        else if (no == 10) {
            return 'Print';
        }
        else {
            return '';
        }
    }
};
AssessmentreportComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_5__["TranslateService"] },
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] },
    { type: _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_3__["AssessmentReportService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_6__["ActivatedRoute"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_6__["Router"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('kdoc'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_4__["Filee"])
], AssessmentreportComponent.prototype, "kdoc", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('pdoc'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_4__["Filee"])
], AssessmentreportComponent.prototype, "pdoc", void 0);
AssessmentreportComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-assessmentreport',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./assessmentreport.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./assessmentreport.component.scss */ "./src/app/modules/assessmentreport/assessmentreport/assessmentreport.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_5__["TranslateService"],
        _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_3__["AssessmentReportService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_6__["ActivatedRoute"],
        _angular_router__WEBPACK_IMPORTED_MODULE_6__["Router"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"]])
], AssessmentreportComponent);



/***/ }),

/***/ "./src/app/modules/assessmentreport/changeassessor/changeassessor.component.scss":
/*!***************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/changeassessor/changeassessor.component.scss ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#changeassessor {\n  display: flex;\n  flex-direction: column !important;\n  color: #848484;\n  padding: 0px 70px 0px 80px;\n}\n#changeassessor .assessorheader {\n  width: 95%;\n  padding-bottom: 6%;\n  -moz-column-gap: 70px;\n       column-gap: 70px;\n}\n#changeassessor .assessordetails {\n  width: 100%;\n  display: flex;\n  border: 1px solid lightgray;\n  padding-left: 20px;\n}\n#changeassessor .assessordetail1 {\n  display: flex;\n  width: 100%;\n  padding: 0px 20px 0px 21px;\n  border: 1px solid lightgray;\n  align-content: space-between;\n  -moz-column-gap: 70px;\n       column-gap: 70px;\n}\n#changeassessor .mat-icon {\n  vertical-align: middle;\n}\n#changeassessor th.mat-sort-header-sorted {\n  color: black;\n}\n#changeassessor .assessordetails .bor {\n  padding: 0px 2px;\n  border: 1px solid lightgray;\n  margin: 10px 5px;\n}\n#changeassessor .assessordetails p {\n  padding: 16px 7px 1px 0px;\n  margin: 1px 0;\n}\n#changeassessor .assessordetails span {\n  color: #262626;\n}\n#changeassessor .assessorupload {\n  padding: 20px 0px 0px 0px;\n  border-radius: none;\n}\n#changeassessor .uploadknowledgeassessment .mat-hint {\n  font-size: 12px;\n}\n#changeassessor .uploadassessment {\n  display: flex;\n  padding: 20px;\n  border-radius: 0%;\n}\n#changeassessor .uploadassessment .uploadfile .ng-hide {\n  box-sizing: border-box;\n}\n#changeassessor .uploadassessment mat-form-field {\n  border-radius: none;\n}\n#changeassessor .filter, #changeassessor .selectupload {\n  border-radius: none;\n}\n#changeassessor .hinpad {\n  padding: 0px 0px 28px 0px;\n  border-radius: none;\n}\n#changeassessor .clflex {\n  display: flex;\n}\n#changeassessor .clflx {\n  display: flex;\n  flex-direction: row;\n  gap: 1rem;\n  width: 100%;\n}\n#changeassessor .rwidth {\n  width: 100%;\n}\n#changeassessor .buttonalign {\n  text-align: right;\n  padding-top: 5%;\n}\n#changeassessor .colblack {\n  color: #000 !important;\n}\n#changeassessor .colgreen {\n  color: #00a551 !important;\n}\n#changeassessor .colorange {\n  color: #f4811f !important;\n}\n#changeassessor .colred, #changeassessor .mat-sort-header-arrow {\n  color: #ed1c27 !important;\n}\n#changeassessor .colpurple {\n  color: #d160d9;\n}\n#changeassessor .colblue {\n  color: #626366;\n}\n#changeassessor .colgrey {\n  color: #4c4d52;\n}\n#changeassessor .btnbac {\n  background-color: #0c4b9a !important;\n  color: white;\n  padding: 15px 57px;\n  padding: 0.5rem 1rem;\n  border-radius: 4px;\n  height: -moz-fit-content;\n  height: fit-content;\n}\n#changeassessor .btnred {\n  background-color: #ed1c27;\n  color: #fff;\n  padding: 7px 26px;\n  margin-left: 15px;\n  border-radius: 0px;\n}\n#changeassessor .btnwhite {\n  padding: 7px 26px;\n  border-radius: 0px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2NoYW5nZWFzc2Vzc29yL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFzc2Vzc21lbnRyZXBvcnRcXGNoYW5nZWFzc2Vzc29yXFxjaGFuZ2Vhc3Nlc3Nvci5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2NoYW5nZWFzc2Vzc29yL2NoYW5nZWFzc2Vzc29yLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0VBQ0ksYUFBQTtFQUNBLGlDQUFBO0VBQ0EsY0FBQTtFQUNDLDBCQUFBO0FDQ0w7QURBSTtFQUNJLFVBQUE7RUFDQSxrQkFBQTtFQUNBLHFCQUFBO09BQUEsZ0JBQUE7QUNFUjtBREFJO0VBQ0ksV0FBQTtFQUNBLGFBQUE7RUFDQSwyQkFBQTtFQUNBLGtCQUFBO0FDRVI7QURDSTtFQUNJLGFBQUE7RUFDQSxXQUFBO0VBQ0EsMEJBQUE7RUFDQSwyQkFBQTtFQUNBLDRCQUFBO0VBRUEscUJBQUE7T0FBQSxnQkFBQTtBQ0FSO0FER0s7RUFDRyxzQkFBQTtBQ0RSO0FESU07RUFDRSxZQUFBO0FDRlI7QURLSTtFQUNJLGdCQUFBO0VBQ0EsMkJBQUE7RUFDQSxnQkFBQTtBQ0hSO0FES0k7RUFDSSx5QkFBQTtFQUNBLGFBQUE7QUNIUjtBREtJO0VBQ0ksY0FBQTtBQ0hSO0FETUk7RUFDSSx5QkFBQTtFQUNBLG1CQUFBO0FDSlI7QURPSTtFQUNJLGVBQUE7QUNMUjtBRE9JO0VBQ0ksYUFBQTtFQUNBLGFBQUE7RUFDQSxpQkFBQTtBQ0xSO0FET1k7RUFDSSxzQkFBQTtBQ0xoQjtBRFFJO0VBQ0ksbUJBQUE7QUNOUjtBRFNJO0VBQ0ksbUJBQUE7QUNQUjtBRFNJO0VBQ0kseUJBQUE7RUFDQSxtQkFBQTtBQ1BSO0FEU0k7RUFDSSxhQUFBO0FDUFI7QURTSTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtFQUNBLFNBQUE7RUFDQSxXQUFBO0FDUFI7QURTSTtFQUNJLFdBQUE7QUNQUjtBRFNJO0VBQ0ksaUJBQUE7RUFDQSxlQUFBO0FDUFI7QURTSTtFQUNJLHNCQUFBO0FDUFI7QURTSTtFQUNJLHlCQUFBO0FDUFI7QURTSTtFQUNJLHlCQUFBO0FDUFI7QURTSTtFQUNJLHlCQUFBO0FDUFI7QURTSTtFQUNJLGNBQUE7QUNQUjtBRFNJO0VBQ0ksY0FBQTtBQ1BSO0FEU0k7RUFDSSxjQUFBO0FDUFI7QURTRztFQUNDLG9DQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0Esb0JBQUE7RUFDQSxrQkFBQTtFQUNBLHdCQUFBO0VBQUEsbUJBQUE7QUNQSjtBRFNHO0VBQ0sseUJBQUE7RUFDQSxXQUFBO0VBQ0EsaUJBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0FDUFI7QURTRztFQUNDLGlCQUFBO0VBQ0Esa0JBQUE7QUNQSiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYXNzZXNzbWVudHJlcG9ydC9jaGFuZ2Vhc3Nlc3Nvci9jaGFuZ2Vhc3Nlc3Nvci5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIiNjaGFuZ2Vhc3Nlc3NvcntcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBmbGV4LWRpcmVjdGlvbjogY29sdW1uICFpbXBvcnRhbnQ7XHJcbiAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgICBwYWRkaW5nOiAwcHggNzBweCAwcHggODBweDtcclxuICAgIC5hc3Nlc3NvcmhlYWRlcntcclxuICAgICAgICB3aWR0aDogOTUlO1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiA2JTtcclxuICAgICAgICBjb2x1bW4tZ2FwOiA3MHB4O1xyXG4gICAgfVxyXG4gICAgLmFzc2Vzc29yZGV0YWlsc3tcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGxpZ2h0Z3JheTtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDIwcHg7XHJcblxyXG4gICAgfVxyXG4gICAgLmFzc2Vzc29yZGV0YWlsMXtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAyMHB4IDBweCAyMXB4O1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIGxpZ2h0Z3JheTtcclxuICAgICAgICBhbGlnbi1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIFxyXG4gICAgICAgIGNvbHVtbi1nYXA6IDcwcHg7XHJcbiAgICB9XHJcbiAgICBcclxuICAgICAubWF0LWljb24ge1xyXG4gICAgICAgIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7XHJcbiAgICB9XHJcbiAgICAgIFxyXG4gICAgICB0aC5tYXQtc29ydC1oZWFkZXItc29ydGVkIHtcclxuICAgICAgICBjb2xvcjogYmxhY2s7XHJcbiAgICAgIH1cclxuICAgIFxyXG4gICAgLmFzc2Vzc29yZGV0YWlscyAgIC5ib3Ige1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAycHg7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xyXG4gICAgICAgIG1hcmdpbjogMTBweCA1cHg7XHJcbiAgICB9XHJcbiAgICAuYXNzZXNzb3JkZXRhaWxzIHAge1xyXG4gICAgICAgIHBhZGRpbmc6IDE2cHggN3B4IDFweCAwcHg7XHJcbiAgICAgICAgbWFyZ2luOiAxcHggMDtcclxuICAgIH1cclxuICAgIC5hc3Nlc3NvcmRldGFpbHMgc3BhbiB7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICB9XHJcbiAgICAgICAgICBcclxuICAgIC5hc3Nlc3NvcnVwbG9hZHtcclxuICAgICAgICBwYWRkaW5nOiAyMHB4IDBweCAwcHggMHB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IG5vbmU7XHJcbiAgICAgICAgXHJcbiAgICB9XHJcbiAgICAudXBsb2Fka25vd2xlZGdlYXNzZXNzbWVudCAubWF0LWhpbnR7XHJcbiAgICAgICAgZm9udC1zaXplOiAxMnB4O1xyXG4gICAgfVxyXG4gICAgLnVwbG9hZGFzc2Vzc21lbnR7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBwYWRkaW5nOiAyMHB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDAlO1xyXG4gICAgICAgIC51cGxvYWRmaWxle1xyXG4gICAgICAgICAgICAubmctaGlkZXtcclxuICAgICAgICAgICAgICAgIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICBtYXQtZm9ybS1maWVsZHtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiBub25lO1xyXG4gICAgfVxyXG4gICAgfVxyXG4gICAgLmZpbHRlciwuc2VsZWN0dXBsb2Fke1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IG5vbmU7XHJcbiAgICB9XHJcbiAgICAuaGlucGFke1xyXG4gICAgICAgIHBhZGRpbmc6MHB4IDBweCAyOHB4IDBweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiBub25lOyAgICBcclxuICAgIH1cclxuICAgIC5jbGZsZXh7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgIH1cclxuICAgIC5jbGZseHtcclxuICAgICAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdztcclxuICAgICAgICBnYXA6IDFyZW07XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgICAucndpZHRoe1xyXG4gICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgfVxyXG4gICAgLmJ1dHRvbmFsaWdue1xyXG4gICAgICAgIHRleHQtYWxpZ246IHJpZ2h0O1xyXG4gICAgICAgIHBhZGRpbmctdG9wOiA1JTtcclxuICAgIH1cclxuICAgIC5jb2xibGFja3tcclxuICAgICAgICBjb2xvcjogIzAwMCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmNvbGdyZWVue1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29sb3Jhbmdle1xyXG4gICAgICAgIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29scmVkLCAubWF0LXNvcnQtaGVhZGVyLWFycm93e1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29scHVycGxle1xyXG4gICAgICAgIGNvbG9yOiAjZDE2MGQ5O1xyXG4gICAgfSBcclxuICAgIC5jb2xibHVle1xyXG4gICAgICAgIGNvbG9yOiM2MjYzNjZcclxuICAgIH1cclxuICAgIC5jb2xncmV5e1xyXG4gICAgICAgIGNvbG9yOiM0YzRkNTJcclxuICAgIH1cclxuICAgLmJ0bmJhY3tcclxuICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcclxuICAgIGNvbG9yOiB3aGl0ZTtcclxuICAgIHBhZGRpbmc6IDE1cHggNTdweDtcclxuICAgIHBhZGRpbmc6IDAuNXJlbSAxcmVtO1xyXG4gICAgYm9yZGVyLXJhZGl1czogNHB4O1xyXG4gICAgaGVpZ2h0OiBmaXQtY29udGVudDtcclxuICAgfVxyXG4gICAuYnRucmVke1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDFjMjc7XHJcbiAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgcGFkZGluZzogN3B4IDI2cHg7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDE1cHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMHB4O1xyXG4gICB9XHJcbiAgIC5idG53aGl0ZXtcclxuICAgIHBhZGRpbmc6IDdweCAyNnB4O1xyXG4gICAgYm9yZGVyLXJhZGl1czogMHB4O1xyXG4gICB9XHJcbiAgIFxyXG59IiwiI2NoYW5nZWFzc2Vzc29yIHtcbiAgZGlzcGxheTogZmxleDtcbiAgZmxleC1kaXJlY3Rpb246IGNvbHVtbiAhaW1wb3J0YW50O1xuICBjb2xvcjogIzg0ODQ4NDtcbiAgcGFkZGluZzogMHB4IDcwcHggMHB4IDgwcHg7XG59XG4jY2hhbmdlYXNzZXNzb3IgLmFzc2Vzc29yaGVhZGVyIHtcbiAgd2lkdGg6IDk1JTtcbiAgcGFkZGluZy1ib3R0b206IDYlO1xuICBjb2x1bW4tZ2FwOiA3MHB4O1xufVxuI2NoYW5nZWFzc2Vzc29yIC5hc3Nlc3NvcmRldGFpbHMge1xuICB3aWR0aDogMTAwJTtcbiAgZGlzcGxheTogZmxleDtcbiAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xuICBwYWRkaW5nLWxlZnQ6IDIwcHg7XG59XG4jY2hhbmdlYXNzZXNzb3IgLmFzc2Vzc29yZGV0YWlsMSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHdpZHRoOiAxMDAlO1xuICBwYWRkaW5nOiAwcHggMjBweCAwcHggMjFweDtcbiAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xuICBhbGlnbi1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBjb2x1bW4tZ2FwOiA3MHB4O1xufVxuI2NoYW5nZWFzc2Vzc29yIC5tYXQtaWNvbiB7XG4gIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7XG59XG4jY2hhbmdlYXNzZXNzb3IgdGgubWF0LXNvcnQtaGVhZGVyLXNvcnRlZCB7XG4gIGNvbG9yOiBibGFjaztcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAuYXNzZXNzb3JkZXRhaWxzIC5ib3Ige1xuICBwYWRkaW5nOiAwcHggMnB4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG4gIG1hcmdpbjogMTBweCA1cHg7XG59XG4jY2hhbmdlYXNzZXNzb3IgLmFzc2Vzc29yZGV0YWlscyBwIHtcbiAgcGFkZGluZzogMTZweCA3cHggMXB4IDBweDtcbiAgbWFyZ2luOiAxcHggMDtcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAuYXNzZXNzb3JkZXRhaWxzIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAuYXNzZXNzb3J1cGxvYWQge1xuICBwYWRkaW5nOiAyMHB4IDBweCAwcHggMHB4O1xuICBib3JkZXItcmFkaXVzOiBub25lO1xufVxuI2NoYW5nZWFzc2Vzc29yIC51cGxvYWRrbm93bGVkZ2Vhc3Nlc3NtZW50IC5tYXQtaGludCB7XG4gIGZvbnQtc2l6ZTogMTJweDtcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAudXBsb2FkYXNzZXNzbWVudCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHBhZGRpbmc6IDIwcHg7XG4gIGJvcmRlci1yYWRpdXM6IDAlO1xufVxuI2NoYW5nZWFzc2Vzc29yIC51cGxvYWRhc3Nlc3NtZW50IC51cGxvYWRmaWxlIC5uZy1oaWRlIHtcbiAgYm94LXNpemluZzogYm9yZGVyLWJveDtcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAudXBsb2FkYXNzZXNzbWVudCBtYXQtZm9ybS1maWVsZCB7XG4gIGJvcmRlci1yYWRpdXM6IG5vbmU7XG59XG4jY2hhbmdlYXNzZXNzb3IgLmZpbHRlciwgI2NoYW5nZWFzc2Vzc29yIC5zZWxlY3R1cGxvYWQge1xuICBib3JkZXItcmFkaXVzOiBub25lO1xufVxuI2NoYW5nZWFzc2Vzc29yIC5oaW5wYWQge1xuICBwYWRkaW5nOiAwcHggMHB4IDI4cHggMHB4O1xuICBib3JkZXItcmFkaXVzOiBub25lO1xufVxuI2NoYW5nZWFzc2Vzc29yIC5jbGZsZXgge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuI2NoYW5nZWFzc2Vzc29yIC5jbGZseCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGZsZXgtZGlyZWN0aW9uOiByb3c7XG4gIGdhcDogMXJlbTtcbiAgd2lkdGg6IDEwMCU7XG59XG4jY2hhbmdlYXNzZXNzb3IgLnJ3aWR0aCB7XG4gIHdpZHRoOiAxMDAlO1xufVxuI2NoYW5nZWFzc2Vzc29yIC5idXR0b25hbGlnbiB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xuICBwYWRkaW5nLXRvcDogNSU7XG59XG4jY2hhbmdlYXNzZXNzb3IgLmNvbGJsYWNrIHtcbiAgY29sb3I6ICMwMDAgIWltcG9ydGFudDtcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAuY29sZ3JlZW4ge1xuICBjb2xvcjogIzAwYTU1MSAhaW1wb3J0YW50O1xufVxuI2NoYW5nZWFzc2Vzc29yIC5jb2xvcmFuZ2Uge1xuICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xufVxuI2NoYW5nZWFzc2Vzc29yIC5jb2xyZWQsICNjaGFuZ2Vhc3Nlc3NvciAubWF0LXNvcnQtaGVhZGVyLWFycm93IHtcbiAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAuY29scHVycGxlIHtcbiAgY29sb3I6ICNkMTYwZDk7XG59XG4jY2hhbmdlYXNzZXNzb3IgLmNvbGJsdWUge1xuICBjb2xvcjogIzYyNjM2Njtcbn1cbiNjaGFuZ2Vhc3Nlc3NvciAuY29sZ3JleSB7XG4gIGNvbG9yOiAjNGM0ZDUyO1xufVxuI2NoYW5nZWFzc2Vzc29yIC5idG5iYWMge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiB3aGl0ZTtcbiAgcGFkZGluZzogMTVweCA1N3B4O1xuICBwYWRkaW5nOiAwLjVyZW0gMXJlbTtcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xuICBoZWlnaHQ6IGZpdC1jb250ZW50O1xufVxuI2NoYW5nZWFzc2Vzc29yIC5idG5yZWQge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWQxYzI3O1xuICBjb2xvcjogI2ZmZjtcbiAgcGFkZGluZzogN3B4IDI2cHg7XG4gIG1hcmdpbi1sZWZ0OiAxNXB4O1xuICBib3JkZXItcmFkaXVzOiAwcHg7XG59XG4jY2hhbmdlYXNzZXNzb3IgLmJ0bndoaXRlIHtcbiAgcGFkZGluZzogN3B4IDI2cHg7XG4gIGJvcmRlci1yYWRpdXM6IDBweDtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/changeassessor/changeassessor.component.ts":
/*!*************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/changeassessor/changeassessor.component.ts ***!
  \*************************************************************************************/
/*! exports provided: ChangeassessorComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ChangeassessorComponent", function() { return ChangeassessorComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/services/assessmentReport.service */ "./src/app/services/assessmentReport.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _modal_changecommentmodal__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../modal/changecommentmodal */ "./src/app/modules/assessmentreport/modal/changecommentmodal.ts");
/* harmony import */ var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/material/dialog */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");








let ChangeassessorComponent = class ChangeassessorComponent {
    constructor(translate, assessmentService, fb, route, dialog) {
        this.translate = translate;
        this.assessmentService = assessmentService;
        this.fb = fb;
        this.route = route;
        this.dialog = dialog;
        this.type = 1;
    }
    i18n(key) {
        return this.translate.instant(key);
    }
    ngOnInit() {
        this.batchNo = this.route.snapshot.paramMap.get('batchNo');
        this.getbatchdtls(this.batchNo);
        this.getassessordata(this.batchNo);
        this.assessorForm = this.fb.group({
            centre: [{ value: "", disabled: true }, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required],
            assessor: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required],
            ivstaff: [{ value: "", disabled: true }, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required],
            newassessor: ["", _angular_forms__WEBPACK_IMPORTED_MODULE_5__["Validators"].required],
        });
    }
    getbatchdtls(batchno) {
        this.assessmentService.getbatchdetails(batchno).subscribe(data => {
            this.batchdata_data = data.data;
        });
    }
    getassessordata(batchno) {
        this.assessmentService.getassessordetails(batchno).subscribe(data => {
            this.assessorData = data.data.data;
            this.centreOption = this.assessorData;
            this.assignassessorOption = this.assessorData;
            this.ivstaffOption = this.assessorData;
        });
    }
    changeassessor(option) {
        this.assessorForm.controls['centre'].setValue(option);
        this.assessorForm.controls['ivstaff'].setValue(option);
    }
    submit() {
    }
    getassessmentstatus(no) {
        //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
        if (no == 1) {
            return 'New';
        }
        else if (no == 2) {
            return 'Teaching(theory)';
        }
        else if (no == 3) {
            return 'Teaching(practical)';
        }
        else if (no == 4) {
            return 'Assessment';
        }
        else if (no == 5) {
            return 'Requested for Back Track';
        }
        else if (no == 6) {
            return 'Quality Check';
        }
        else if (no == 7) {
            return 'Cancelled';
        }
        else if (no == 8) {
            return 'Print';
        }
        else if (no == 9) {
            return 'Requested for Assessor change';
        }
        else {
            return '';
        }
    }
    getcomments() {
        let dialogRef = this.dialog.open(_modal_changecommentmodal__WEBPACK_IMPORTED_MODULE_6__["changecommentmodal"], { disableClose: true, panelClass: 'commentfielsmodal',
            data: { fieldToShow: 'field4' },
        });
        dialogRef.afterClosed().subscribe(result => {
        });
    }
};
ChangeassessorComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"] },
    { type: _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_2__["AssessmentReportService"] },
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormBuilder"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"] },
    { type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_7__["MatDialog"] }
];
ChangeassessorComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-changeassessor',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./changeassessor.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/changeassessor/changeassessor.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./changeassessor.component.scss */ "./src/app/modules/assessmentreport/changeassessor/changeassessor.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"],
        _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_2__["AssessmentReportService"],
        _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormBuilder"],
        _angular_router__WEBPACK_IMPORTED_MODULE_4__["ActivatedRoute"], _angular_material_dialog__WEBPACK_IMPORTED_MODULE_7__["MatDialog"]])
], ChangeassessorComponent);



/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.scss":
/*!*****************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.scss ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#learnerfeedback {\n  padding-left: 10px;\n  font-size: 14px;\n}\n#learnerfeedback .colred {\n  color: red;\n}\n#learnerfeedback .colsand {\n  color: #989898;\n}\n#learnerfeedback .colblue {\n  background-color: #0c4b9a;\n  color: aliceblue;\n}\n#learnerfeedback .txt-label {\n  color: #888;\n  font-size: 13px;\n}\n#learnerfeedback .txt-value {\n  color: #000;\n}\n#learnerfeedback .colwh {\n  background-color: whitesmoke;\n}\n#learnerfeedback .colli {\n  color: #333;\n}\n#learnerfeedback .colred {\n  color: #ee6666;\n  text-shadow: 1px 1px 1px #ea9797;\n  padding: 0px 3px;\n}\n#learnerfeedback .cpat {\n  border: 0.001px solid #d3cdcd;\n}\n#learnerfeedback .canbtn.mat-flat-button {\n  background-color: #d6cdcd52;\n  color: #584f4f;\n  margin-right: 15px;\n  width: 140px;\n  height: 55px;\n  border-radius: 0px;\n}\n#learnerfeedback .subbtn.mat-flat-button {\n  background-color: #ed3323;\n  color: #ffff;\n  margin-right: 10px;\n  width: 140px;\n  height: 55px;\n  border-radius: 0px;\n}\n#learnerfeedback .headertitle {\n  display: flex;\n  padding: 15px 0;\n  justify-content: center;\n  background: #efefef;\n  margin-bottom: 25px;\n  position: relative;\n}\n#learnerfeedback .headertitle .titlediv {\n  text-transform: uppercase;\n  font-size: 18px;\n  color: #333;\n  font-family: \"opal_semibold\", sans-serif;\n}\n#learnerfeedback .headertitle .backbtn {\n  position: absolute;\n  left: 15px;\n  top: 18px;\n  color: #888;\n  cursor: pointer;\n}\n#learnerfeedback .p {\n  padding: 0px 30px 0px 0px;\n}\n#learnerfeedback .trainfact {\n  padding: 30px 10px 10px 0px;\n}\n#learnerfeedback .phadd .mat-body p, #learnerfeedback .mat-body-2 p, #learnerfeedback .mat-typography .mat-body p, #learnerfeedback .mat-typography .mat-body-2 p, #learnerfeedback .mat-typography p {\n  margin: 0 0 0px;\n}\n#learnerfeedback .ppadd {\n  padding: 0px 30px 0px 30px;\n}\n#learnerfeedback .phadd {\n  padding-left: 20px;\n}\n#learnerfeedback .pstat {\n  padding: 0px 20px 0px 20px;\n}\n#learnerfeedback .border {\n  border: 0px solid #e5dcdc;\n  margin: 1em 0;\n  border-bottom-width: 0.01ex;\n}\n#learnerfeedback .pprdi {\n  padding: 6px 55px 6px 32px;\n}\n#learnerfeedback .pprdi.colli.mat-radio-button.mat-accent .mat-radio-inner-circle {\n  background-color: #e20613 !important;\n}\n#learnerfeedback .pprdi.colli.mat-radio-button.mat-accent.mat-radio-checked .mat-radio-outer-circle {\n  border-color: #9f9f9f;\n}\n#learnerfeedback .errmsg {\n  font-size: 16px;\n}\n.rtl #learnerfeedback .phadd {\n  padding-left: 0;\n  padding-right: 20px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFjay9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxhc3Nlc3NtZW50cmVwb3J0XFxsZWFybmVyZmVlZGJhY2tcXGxlYXJuZXJmZWVkYmFjay5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFjay9sZWFybmVyZmVlZGJhY2suY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7RUFDSSxrQkFBQTtFQUNBLGVBQUE7QUNDSjtBREFJO0VBQ0ksVUFBQTtBQ0VSO0FEQUk7RUFDSSxjQUFBO0FDRVI7QURBSTtFQUNJLHlCQUFBO0VBQ0EsZ0JBQUE7QUNFUjtBREFJO0VBQ0ksV0FBQTtFQUNBLGVBQUE7QUNFUjtBREFJO0VBQ0ksV0FBQTtBQ0VSO0FEQUk7RUFFSSw0QkFBQTtBQ0NSO0FEQ0k7RUFDSSxXQUFBO0FDQ1I7QURDSTtFQUNJLGNBQUE7RUFDQSxnQ0FBQTtFQUNBLGdCQUFBO0FDQ1I7QURDSTtFQUNJLDZCQUFBO0FDQ1I7QURHSTtFQUNJLDJCQUFBO0VBQ0EsY0FBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtFQUNBLFlBQUE7RUFDQSxrQkFBQTtBQ0RSO0FER0k7RUFFSSx5QkFBQTtFQUNBLFlBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxZQUFBO0VBQ0Esa0JBQUE7QUNGUjtBRElJO0VBQ0ksYUFBQTtFQUNBLGVBQUE7RUFDQSx1QkFBQTtFQUNBLG1CQUFBO0VBQ0EsbUJBQUE7RUFDQSxrQkFBQTtBQ0ZSO0FER1E7RUFDSSx5QkFBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0VBQ0Esd0NBQUE7QUNEWjtBREdRO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsU0FBQTtFQUNBLFdBQUE7RUFDQSxlQUFBO0FDRFo7QURLSTtFQUNHLHlCQUFBO0FDSFA7QURNSTtFQUNJLDJCQUFBO0FDSlI7QURNSTtFQUNJLGVBQUE7QUNKUjtBRE1JO0VBQ0ksMEJBQUE7QUNKUjtBRE1JO0VBQ0ssa0JBQUE7QUNKVDtBRE1JO0VBQ0ksMEJBQUE7QUNKUjtBRE1JO0VBQ0kseUJBQUE7RUFDQSxhQUFBO0VBQ0EsMkJBQUE7QUNKUjtBRE1JO0VBQ0ksMEJBQUE7QUNKUjtBRE1JO0VBQ0ksb0NBQUE7QUNKUjtBRE1JO0VBQ0kscUJBQUE7QUNKUjtBRGNJO0VBQ0ksZUFBQTtBQ1pSO0FEa0JRO0VBQ0ksZUFBQTtFQUNBLG1CQUFBO0FDZloiLCJmaWxlIjoic3JjL2FwcC9tb2R1bGVzL2Fzc2Vzc21lbnRyZXBvcnQvbGVhcm5lcmZlZWRiYWNrL2xlYXJuZXJmZWVkYmFjay5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIiNsZWFybmVyZmVlZGJhY2t7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDEwcHg7XHJcbiAgICBmb250LXNpemU6IDE0cHg7XHJcbiAgICAuY29scmVke1xyXG4gICAgICAgIGNvbG9yOiByZWQ7XHJcbiAgICB9XHJcbiAgICAuY29sc2FuZHtcclxuICAgICAgICBjb2xvcjogIzk4OTg5ODtcclxuICAgIH1cclxuICAgIC5jb2xibHVle1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6IzBjNGI5YSA7XHJcbiAgICAgICAgY29sb3I6YWxpY2VibHVlOyAgXHJcbiAgICB9XHJcbiAgICAudHh0LWxhYmVse1xyXG4gICAgICAgIGNvbG9yOiM4ODg7XHJcbiAgICAgICAgZm9udC1zaXplOjEzcHg7XHJcbiAgICB9XHJcbiAgICAudHh0LXZhbHVle1xyXG4gICAgICAgIGNvbG9yOiMwMDA7XHJcbiAgICB9XHJcbiAgICAuY29sd2h7XHJcbiAgICAgICBcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiB3aGl0ZXNtb2tlO1xyXG4gICAgfVxyXG4gICAgLmNvbGxpe1xyXG4gICAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgfVxyXG4gICAgLmNvbHJlZHtcclxuICAgICAgICBjb2xvcjogcmdiKDIzOCwgMTAyLCAxMDIpO1xyXG4gICAgICAgIHRleHQtc2hhZG93OiAxcHggMXB4IDFweCByZ2IoMjM0LCAxNTEsIDE1MSk7XHJcbiAgICAgICAgcGFkZGluZzowcHggM3B4ICA7XHJcbiAgICB9XHJcbiAgICAuY3BhdHtcclxuICAgICAgICBib3JkZXIgOiAwLjAwMXB4IHNvbGlkIHJnYigyMTEsIDIwNSwgMjA1KTtcclxuICAgIH1cclxuXHJcblxyXG4gICAgLmNhbmJ0bi5tYXQtZmxhdC1idXR0b24ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNkNmNkY2Q1MiA7XHJcbiAgICAgICAgY29sb3I6ICM1ODRmNGY7XHJcbiAgICAgICAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIHdpZHRoOiAxNDBweDtcclxuICAgICAgICBoZWlnaHQ6IDU1cHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMHB4O1xyXG4gICAgfVxyXG4gICAgLnN1YmJ0bi5tYXQtZmxhdC1idXR0b24ge1xyXG4gICAgICAgIFxyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlZDMzMjMgO1xyXG4gICAgICAgIGNvbG9yOiAjZmZmZjtcclxuICAgICAgICBtYXJnaW4tcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgd2lkdGg6IDE0MHB4O1xyXG4gICAgICAgIGhlaWdodDogNTVweDtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAwcHg7XHJcbiAgICB9XHJcbiAgICAuaGVhZGVydGl0bGV7XHJcbiAgICAgICAgZGlzcGxheTpmbGV4O1xyXG4gICAgICAgIHBhZGRpbmc6MTVweCAwO1xyXG4gICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgIGJhY2tncm91bmQ6I2VmZWZlZjtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOjI1cHg7XHJcbiAgICAgICAgcG9zaXRpb246cmVsYXRpdmU7XHJcbiAgICAgICAgLnRpdGxlZGl2e1xyXG4gICAgICAgICAgICB0ZXh0LXRyYW5zZm9ybTp1cHBlcmNhc2U7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZToxOHB4O1xyXG4gICAgICAgICAgICBjb2xvcjojMzMzO1xyXG4gICAgICAgICAgICBmb250LWZhbWlseTonb3BhbF9zZW1pYm9sZCcsIHNhbnMtc2VyaWY7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5iYWNrYnRue1xyXG4gICAgICAgICAgICBwb3NpdGlvbjphYnNvbHV0ZTtcclxuICAgICAgICAgICAgbGVmdDoxNXB4O1xyXG4gICAgICAgICAgICB0b3A6MThweDtcclxuICAgICAgICAgICAgY29sb3I6Izg4ODtcclxuICAgICAgICAgICAgY3Vyc29yOnBvaW50ZXI7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgXHJcbiAgICAucHtcclxuICAgICAgIHBhZGRpbmc6ICAwcHggMzBweCAwcHggMHB4O1xyXG4gICAgfVxyXG4gICBcclxuICAgIC50cmFpbmZhY3R7XHJcbiAgICAgICAgcGFkZGluZzogMzBweCAxMHB4IDEwcHggMHB4O1xyXG4gICAgfVxyXG4gICAgLnBoYWRkIC5tYXQtYm9keSBwLCAubWF0LWJvZHktMiBwLCAubWF0LXR5cG9ncmFwaHkgLm1hdC1ib2R5IHAsIC5tYXQtdHlwb2dyYXBoeSAubWF0LWJvZHktMiBwLCAubWF0LXR5cG9ncmFwaHkgcCB7XHJcbiAgICAgICAgbWFyZ2luOiAwIDAgMHB4O1xyXG4gICAgfVxyXG4gICAgLnBwYWRke1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAzMHB4IDBweCAzMHB4O1xyXG4gICAgfVxyXG4gICAgLnBoYWRke1xyXG4gICAgICAgICBwYWRkaW5nLWxlZnQ6IDIwcHg7XHJcbiAgICB9XHJcbiAgICAucHN0YXR7XHJcbiAgICAgICAgcGFkZGluZyA6IDBweCAyMHB4IDBweCAyMHB4O1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcntcclxuICAgICAgICBib3JkZXI6IDBweCBzb2xpZCAjZTVkY2RjO1xyXG4gICAgICAgIG1hcmdpbjogMWVtIDA7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbS13aWR0aDogMC4wMWV4O1xyXG4gICAgfVxyXG4gICAgLnBwcmRpe1xyXG4gICAgICAgIHBhZGRpbmc6IDZweCA1NXB4IDZweCAzMnB4O1xyXG4gICAgfVxyXG4gICAgLnBwcmRpLmNvbGxpLm1hdC1yYWRpby1idXR0b24ubWF0LWFjY2VudCAubWF0LXJhZGlvLWlubmVyLWNpcmNsZXtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZTIwNjEzICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAucHByZGkuY29sbGkubWF0LXJhZGlvLWJ1dHRvbi5tYXQtYWNjZW50Lm1hdC1yYWRpby1jaGVja2VkIC5tYXQtcmFkaW8tb3V0ZXItY2lyY2xlIHtcclxuICAgICAgICBib3JkZXItY29sb3I6ICM5ZjlmOWY7XHJcbiAgICB9XHJcbiAgICAvLyAucHByZGkgLm1hdC1tZGMtcmFkaW8tYnV0dG9uLm1hdC1tZGMtcmFkaW8tY2hlY2tlZCAubWRjLXJhZGlvX19iYWNrZ3JvdW5kOjpiZWZvcmUgeyM5ZjlmOWZcclxuICAgIC8vICAgICBiYWNrZ3JvdW5kLWNvbG9yOiB2YXIoLS1tYXQtbWRjLXJhZGlvLWNoZWNrZWQtcmlwcGxlLWNvbG9yLCB0cmFuc3BhcmVudCk7XHJcbiAgICAvLyAgICAgYm9yZGVyLWNvbG9yOiNlYmU0ZTQ7XHJcbiAgICAvLyB9XHJcbiAgICAvLyAucHByZGkubWF0LW1kYy1yYWRpby1idXR0b24gLm1kYy1yYWRpbyAubWRjLXJhZGlvX19uYXRpdmUtY29udHJvbDplbmFibGVkOmNoZWNrZWQrLm1kYy1yYWRpb19fYmFja2dyb3VuZCAubWRjLXJhZGlvX19vdXRlci1jaXJjbGUge1xyXG4gICAgLy8gICAgIGJvcmRlci1jb2xvcjojNTk1NjU2ICAhaW1wb3J0YW50O1xyXG4gICAgLy8gfVxyXG5cclxuICAgIC5lcnJtc2d7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNnB4O1xyXG4gICAgfVxyXG59XHJcblxyXG4ucnRse1xyXG4gICAgI2xlYXJuZXJmZWVkYmFja3tcclxuICAgICAgICAucGhhZGR7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDowO1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OjIwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcbiIsIiNsZWFybmVyZmVlZGJhY2sge1xuICBwYWRkaW5nLWxlZnQ6IDEwcHg7XG4gIGZvbnQtc2l6ZTogMTRweDtcbn1cbiNsZWFybmVyZmVlZGJhY2sgLmNvbHJlZCB7XG4gIGNvbG9yOiByZWQ7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5jb2xzYW5kIHtcbiAgY29sb3I6ICM5ODk4OTg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5jb2xibHVlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcbiAgY29sb3I6IGFsaWNlYmx1ZTtcbn1cbiNsZWFybmVyZmVlZGJhY2sgLnR4dC1sYWJlbCB7XG4gIGNvbG9yOiAjODg4O1xuICBmb250LXNpemU6IDEzcHg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC50eHQtdmFsdWUge1xuICBjb2xvcjogIzAwMDtcbn1cbiNsZWFybmVyZmVlZGJhY2sgLmNvbHdoIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogd2hpdGVzbW9rZTtcbn1cbiNsZWFybmVyZmVlZGJhY2sgLmNvbGxpIHtcbiAgY29sb3I6ICMzMzM7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5jb2xyZWQge1xuICBjb2xvcjogI2VlNjY2NjtcbiAgdGV4dC1zaGFkb3c6IDFweCAxcHggMXB4ICNlYTk3OTc7XG4gIHBhZGRpbmc6IDBweCAzcHg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5jcGF0IHtcbiAgYm9yZGVyOiAwLjAwMXB4IHNvbGlkICNkM2NkY2Q7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5jYW5idG4ubWF0LWZsYXQtYnV0dG9uIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Q2Y2RjZDUyO1xuICBjb2xvcjogIzU4NGY0ZjtcbiAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xuICB3aWR0aDogMTQwcHg7XG4gIGhlaWdodDogNTVweDtcbiAgYm9yZGVyLXJhZGl1czogMHB4O1xufVxuI2xlYXJuZXJmZWVkYmFjayAuc3ViYnRuLm1hdC1mbGF0LWJ1dHRvbiB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlZDMzMjM7XG4gIGNvbG9yOiAjZmZmZjtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xuICB3aWR0aDogMTQwcHg7XG4gIGhlaWdodDogNTVweDtcbiAgYm9yZGVyLXJhZGl1czogMHB4O1xufVxuI2xlYXJuZXJmZWVkYmFjayAuaGVhZGVydGl0bGUge1xuICBkaXNwbGF5OiBmbGV4O1xuICBwYWRkaW5nOiAxNXB4IDA7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBiYWNrZ3JvdW5kOiAjZWZlZmVmO1xuICBtYXJnaW4tYm90dG9tOiAyNXB4O1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5oZWFkZXJ0aXRsZSAudGl0bGVkaXYge1xuICB0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlO1xuICBmb250LXNpemU6IDE4cHg7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LWZhbWlseTogXCJvcGFsX3NlbWlib2xkXCIsIHNhbnMtc2VyaWY7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5oZWFkZXJ0aXRsZSAuYmFja2J0biB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgbGVmdDogMTVweDtcbiAgdG9wOiAxOHB4O1xuICBjb2xvcjogIzg4ODtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuI2xlYXJuZXJmZWVkYmFjayAucCB7XG4gIHBhZGRpbmc6IDBweCAzMHB4IDBweCAwcHg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC50cmFpbmZhY3Qge1xuICBwYWRkaW5nOiAzMHB4IDEwcHggMTBweCAwcHg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5waGFkZCAubWF0LWJvZHkgcCwgI2xlYXJuZXJmZWVkYmFjayAubWF0LWJvZHktMiBwLCAjbGVhcm5lcmZlZWRiYWNrIC5tYXQtdHlwb2dyYXBoeSAubWF0LWJvZHkgcCwgI2xlYXJuZXJmZWVkYmFjayAubWF0LXR5cG9ncmFwaHkgLm1hdC1ib2R5LTIgcCwgI2xlYXJuZXJmZWVkYmFjayAubWF0LXR5cG9ncmFwaHkgcCB7XG4gIG1hcmdpbjogMCAwIDBweDtcbn1cbiNsZWFybmVyZmVlZGJhY2sgLnBwYWRkIHtcbiAgcGFkZGluZzogMHB4IDMwcHggMHB4IDMwcHg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5waGFkZCB7XG4gIHBhZGRpbmctbGVmdDogMjBweDtcbn1cbiNsZWFybmVyZmVlZGJhY2sgLnBzdGF0IHtcbiAgcGFkZGluZzogMHB4IDIwcHggMHB4IDIwcHg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5ib3JkZXIge1xuICBib3JkZXI6IDBweCBzb2xpZCAjZTVkY2RjO1xuICBtYXJnaW46IDFlbSAwO1xuICBib3JkZXItYm90dG9tLXdpZHRoOiAwLjAxZXg7XG59XG4jbGVhcm5lcmZlZWRiYWNrIC5wcHJkaSB7XG4gIHBhZGRpbmc6IDZweCA1NXB4IDZweCAzMnB4O1xufVxuI2xlYXJuZXJmZWVkYmFjayAucHByZGkuY29sbGkubWF0LXJhZGlvLWJ1dHRvbi5tYXQtYWNjZW50IC5tYXQtcmFkaW8taW5uZXItY2lyY2xlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2UyMDYxMyAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJmZWVkYmFjayAucHByZGkuY29sbGkubWF0LXJhZGlvLWJ1dHRvbi5tYXQtYWNjZW50Lm1hdC1yYWRpby1jaGVja2VkIC5tYXQtcmFkaW8tb3V0ZXItY2lyY2xlIHtcbiAgYm9yZGVyLWNvbG9yOiAjOWY5ZjlmO1xufVxuI2xlYXJuZXJmZWVkYmFjayAuZXJybXNnIHtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuXG4ucnRsICNsZWFybmVyZmVlZGJhY2sgLnBoYWRkIHtcbiAgcGFkZGluZy1sZWZ0OiAwO1xuICBwYWRkaW5nLXJpZ2h0OiAyMHB4O1xufSJdfQ== */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.ts":
/*!***************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.ts ***!
  \***************************************************************************************/
/*! exports provided: LearnerfeedbackComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LearnerfeedbackComponent", function() { return LearnerfeedbackComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _app_services_learnerfeedback_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/services/learnerfeedback.service */ "./src/app/services/learnerfeedback.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! sweetalert */ "./node_modules/sweetalert/dist/sweetalert.min.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_7__);








let LearnerfeedbackComponent = class LearnerfeedbackComponent {
    constructor(learnerfeedback, translate, remoteService, cookieService, route) {
        this.learnerfeedback = learnerfeedback;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.route = route;
        this.comments = '';
        this.questions = [];
        this.formcompleted = false;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
        this.errorMsg = '';
        this.loading = false;
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
            }
        });
        this.id = this.route.snapshot.paramMap.get('id');
        this.getfeedbackquestion();
    }
    getfeedbackquestion() {
        this.errorMsg = '';
        this.loading = true;
        this.learnerfeedback.getlearnerfeedbackquestion(this.id).subscribe(res => {
            console.log(res);
            if (!res.data.data) {
                this.alldata = res.data;
                this.questions = this.alldata.feedback;
                let i = 1;
                this.questions.forEach(item => {
                    item.questions.forEach(quess => {
                        quess.index = i++;
                        quess.value = 0;
                    });
                });
                this.loading = false;
                console.log('this.data', this.questions);
            }
            else {
                this.errorMsg = res.data.data;
                this.loading = false;
            }
        });
    }
    onradioclick(index, index1, event) {
        this.questions[index].questions[index1].value = event.value;
    }
    onSubmit() {
        let res;
        this.questions.forEach(item => {
            let arr = item.questions.filter(item => item.value == 0);
            if (arr.length > 0 && item.fdbkct_feedbacklist_en != 'Assessment') {
                res = true;
            }
            if (arr.length > 0 && item.fdbkct_feedbacklist_en == 'Assessment' && this.alldata.isassessment) {
                res = true;
            }
        });
        if (res) {
            sweetalert__WEBPACK_IMPORTED_MODULE_7___default()({
                title: 'Kindly anwser all the questions',
                text: " ",
                icon: 'warning',
                buttons: [false, "Ok"],
                dangerMode: true,
                closeOnClickOutside: false
            }).then(() => {
            });
        }
        else {
            let data = {
                "learnerId": this.id,
                "questions": this.questions,
                "comments": this.comments
            };
            console.log('data', data);
            this.learnerfeedback.savefeedbackquestion(data).subscribe(res => {
                this.formcompleted = true;
            });
        }
    }
};
LearnerfeedbackComponent.ctorParameters = () => [
    { type: _app_services_learnerfeedback_service__WEBPACK_IMPORTED_MODULE_5__["LearnerFeedbackService"] },
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_6__["ActivatedRoute"] }
];
LearnerfeedbackComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-learnerfeedback',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./learnerfeedback.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./learnerfeedback.component.scss */ "./src/app/modules/assessmentreport/learnerfeedback/learnerfeedback.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_services_learnerfeedback_service__WEBPACK_IMPORTED_MODULE_5__["LearnerFeedbackService"],
        _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_6__["ActivatedRoute"]])
], LearnerfeedbackComponent);



/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.scss":
/*!***************************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.scss ***!
  \***************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#learnerfeedbacklist table {\n  width: 100%;\n}\n#learnerfeedbacklist .coursesinfotbale {\n  display: block;\n  overflow-x: auto;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo {\n  width: 100%;\n  border-collapse: collapse;\n  justify-content: center;\n  overflow-x: auto;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-header-row {\n  background-color: #eaedf2;\n  border-bottom: 0px !important;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-row {\n  border-bottom: 0px !important;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo #searchrow.mat-header-row {\n  background-color: #f8f8f8 !important;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-header-cell:nth-child(1) {\n  text-align: center;\n  justify-content: center;\n  flex: 1 1 50px;\n  box-sizing: border-box;\n  max-width: 50px;\n  min-width: 50px;\n  padding-right: 10px;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-header-cell:nth-row(2) {\n  background-color: #fff !important;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-cell:nth-child(1) {\n  text-align: center;\n  justify-content: center;\n  flex: 1;\n  box-sizing: border-box;\n  max-width: 50px;\n  min-width: 50px;\n  padding-left: 0px;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo #searchrow {\n  background: #fff !important;\n  border: none;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo #searchrow .mat-header-cell {\n  background-color: #fff !important;\n  font-size: 15px;\n  min-height: 73px;\n  padding-right: 10px;\n  padding-top: 15px;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-header-cell {\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-header-cell:last-child {\n  justify-content: center;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-header-cell,\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-cell {\n  text-align: center;\n  flex: 1 1 200px;\n  box-sizing: border-box;\n  max-width: 200px;\n  min-width: 200px;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-cell {\n  border-bottom: 1px solid #ddd;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-cell:last-child {\n  justify-content: center;\n}\n#learnerfeedbacklist .coursesinfotbale .mat-courseinfo .mat-cell:last-child a {\n  color: #0c4b9a;\n  text-decoration: underline;\n}\n#learnerfeedbacklist .coursesinfotbale .date_box > div > div > div {\n  display: flex;\n  height: 55px;\n}\n#learnerfeedbacklist .coursesinfotbale .date_img > button {\n  position: relative;\n  bottom: 14px;\n}\n#learnerfeedbacklist .paginationwithfilter {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#learnerfeedbacklist .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#learnerfeedbacklist .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#learnerfeedbacklist .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#learnerfeedbacklist .mat-paginator-page-size-label {\n  margin: 0px !important;\n}\n#learnerfeedbacklist .mat-paginator-container {\n  padding: 0px !important;\n  justify-content: space-between;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFja3RhYmxlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFzc2Vzc21lbnRyZXBvcnRcXGxlYXJuZXJmZWVkYmFja3RhYmxlXFxsZWFybmVyZmVlZGJhY2t0YWJsZS5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFja3RhYmxlL2xlYXJuZXJmZWVkYmFja3RhYmxlLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUNJO0VBQ0ksV0FBQTtBQ0FSO0FER007RUFDRSxjQUFBO0VBQ0EsZ0JBQUE7QUNEUjtBREdRO0VBQ0ksV0FBQTtFQUNBLHlCQUFBO0VBQ0EsdUJBQUE7RUFDQSxnQkFBQTtBQ0RaO0FER1k7RUFDRSx5QkFBQTtFQUNBLDZCQUFBO0FDRGQ7QURHWTtFQUNJLDZCQUFBO0FDRGhCO0FESVk7RUFDRSxvQ0FBQTtBQ0ZkO0FES1k7RUFDSSxrQkFBQTtFQUNBLHVCQUFBO0VBQ0EsY0FBQTtFQUNBLHNCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7RUFFQSxtQkFBQTtBQ0poQjtBRFFZO0VBQ0ksaUNBQUE7QUNOaEI7QURVWTtFQUNJLGtCQUFBO0VBQ0EsdUJBQUE7RUFDQSxPQUFBO0VBQ0Esc0JBQUE7RUFDQSxlQUFBO0VBQ0EsZUFBQTtFQUNBLGlCQUFBO0FDUmhCO0FEV1k7RUFDSSwyQkFBQTtFQUNBLFlBQUE7QUNUaEI7QURVZ0I7RUFDSSxpQ0FBQTtFQUNBLGVBQUE7RUFDQSxnQkFBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7QUNScEI7QURZWTtFQUNJLHlCQUFBO0VBQ0EsZUFBQTtBQ1ZoQjtBRFdnQjtFQUNJLHVCQUFBO0FDVHBCO0FEYVk7O0VBRUksa0JBQUE7RUFFQSxlQUFBO0VBQ0Esc0JBQUE7RUFDQSxnQkFBQTtFQUNBLGdCQUFBO0FDWmhCO0FEY1k7RUFDSSw2QkFBQTtBQ1poQjtBRGFnQjtFQUNJLHVCQUFBO0FDWHBCO0FEWW9CO0VBQ0ksY0FBQTtFQUNBLDBCQUFBO0FDVnhCO0FEaUJRO0VBQ0ksYUFBQTtFQUNBLFlBQUE7QUNmWjtBRGtCUTtFQUNJLGtCQUFBO0VBQ0EsWUFBQTtBQ2hCWjtBRG9CSTtFQUNJLGFBQUE7RUFDQSw4QkFBQTtFQUNBLG1CQUFBO0FDbEJSO0FEc0JZO0VBQ0kseUJBQUE7RUFDQSxjQUFBO0FDcEJoQjtBRHNCZ0I7RUFDSSx5QkFBQTtBQ3BCcEI7QUQ0QlE7RUFDSSxhQUFBO0FDMUJaO0FEOEJJO0VBQ0ksc0JBQUE7QUM1QlI7QUQrQkk7RUFDSSx1QkFBQTtFQUNBLDhCQUFBO0FDN0JSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFja3RhYmxlL2xlYXJuZXJmZWVkYmFja3RhYmxlLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiI2xlYXJuZXJmZWVkYmFja2xpc3R7XHJcbiAgICB0YWJsZSB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5jb3Vyc2VzaW5mb3RiYWxlIHtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG5cclxuICAgICAgICAubWF0LWNvdXJzZWluZm8ge1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgICAgICAgYm9yZGVyLWNvbGxhcHNlOiBjb2xsYXBzZTtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcblxyXG4gICAgICAgICAgICAubWF0LWhlYWRlci1yb3d7XHJcbiAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICAgICAgICBib3JkZXItYm90dG9tOjBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtcm93e1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLWJvdHRvbTowcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgI3NlYXJjaHJvdy5tYXQtaGVhZGVyLXJvd3tcclxuICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGw6bnRoLWNoaWxkKDEpIHtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgZmxleDogMSAxIDUwcHg7XHJcbiAgICAgICAgICAgICAgICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xyXG4gICAgICAgICAgICAgICAgbWF4LXdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAvLyBwYWRkaW5nOiAyMHB4IDBweDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAvL3BhZGRpbmctdG9wOiAxNXB4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LWhlYWRlci1jZWxsOm50aC1yb3coMikge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1jZWxsOm50aC1jaGlsZCgxKSB7XHJcbiAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGZsZXg6IDE7XHJcbiAgICAgICAgICAgICAgICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xyXG4gICAgICAgICAgICAgICAgbWF4LXdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA1MHB4O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICNzZWFyY2hyb3cge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICAgICAgICAgICAgLm1hdC1oZWFkZXItY2VsbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgICAgICAgICBtaW4taGVpZ2h0OiA3M3B4O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy10b3A6IDE1cHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgICAgICY6bGFzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1oZWFkZXItY2VsbCxcclxuICAgICAgICAgICAgLm1hdC1jZWxsIHtcclxuICAgICAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIC8vanVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmbGV4OiAxIDEgMjAwcHg7XHJcbiAgICAgICAgICAgICAgICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xyXG4gICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAyMDBweDtcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMjAwcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1jZWxsIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1ib3R0b206MXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgICAgICAgICAmOmxhc3QtY2hpbGR7XHJcbiAgICAgICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgYXtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGF0ZV9ib3g+ZGl2PmRpdj5kaXYge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDU1cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGF0ZV9pbWc+YnV0dG9uIHtcclxuICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICBib3R0b206IDE0cHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgIH1cclxuICAgIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuICAgIC5mb290ZXJwYWdpbmF0b3Ige1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG5cclxuICAgICAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIFxyXG4gICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgfVxyXG59IiwiI2xlYXJuZXJmZWVkYmFja2xpc3QgdGFibGUge1xuICB3aWR0aDogMTAwJTtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIHtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG92ZXJmbG93LXg6IGF1dG87XG59XG4jbGVhcm5lcmZlZWRiYWNrbGlzdCAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8ge1xuICB3aWR0aDogMTAwJTtcbiAgYm9yZGVyLWNvbGxhcHNlOiBjb2xsYXBzZTtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIG92ZXJmbG93LXg6IGF1dG87XG59XG4jbGVhcm5lcmZlZWRiYWNrbGlzdCAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1oZWFkZXItcm93IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgYm9yZGVyLWJvdHRvbTogMHB4ICFpbXBvcnRhbnQ7XG59XG4jbGVhcm5lcmZlZWRiYWNrbGlzdCAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1yb3cge1xuICBib3JkZXItYm90dG9tOiAwcHggIWltcG9ydGFudDtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAjc2VhcmNocm93Lm1hdC1oZWFkZXItcm93IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmOCAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvIC5tYXQtaGVhZGVyLWNlbGw6bnRoLWNoaWxkKDEpIHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZmxleDogMSAxIDUwcHg7XG4gIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XG4gIG1heC13aWR0aDogNTBweDtcbiAgbWluLXdpZHRoOiA1MHB4O1xuICBwYWRkaW5nLXJpZ2h0OiAxMHB4O1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvIC5tYXQtaGVhZGVyLWNlbGw6bnRoLXJvdygyKSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAubWF0LWNlbGw6bnRoLWNoaWxkKDEpIHtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgZmxleDogMTtcbiAgYm94LXNpemluZzogYm9yZGVyLWJveDtcbiAgbWF4LXdpZHRoOiA1MHB4O1xuICBtaW4td2lkdGg6IDUwcHg7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvICNzZWFyY2hyb3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogbm9uZTtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAjc2VhcmNocm93IC5tYXQtaGVhZGVyLWNlbGwge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgbWluLWhlaWdodDogNzNweDtcbiAgcGFkZGluZy1yaWdodDogMTBweDtcbiAgcGFkZGluZy10b3A6IDE1cHg7XG59XG4jbGVhcm5lcmZlZWRiYWNrbGlzdCAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1oZWFkZXItY2VsbCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAubWF0LWhlYWRlci1jZWxsOmxhc3QtY2hpbGQge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIC5tYXQtY291cnNlaW5mbyAubWF0LWhlYWRlci1jZWxsLFxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvIC5tYXQtY2VsbCB7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgZmxleDogMSAxIDIwMHB4O1xuICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xuICBtYXgtd2lkdGg6IDIwMHB4O1xuICBtaW4td2lkdGg6IDIwMHB4O1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvIC5tYXQtY2VsbCB7XG4gIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGRkO1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmNvdXJzZXNpbmZvdGJhbGUgLm1hdC1jb3Vyc2VpbmZvIC5tYXQtY2VsbDpsYXN0LWNoaWxkIHtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG59XG4jbGVhcm5lcmZlZWRiYWNrbGlzdCAuY291cnNlc2luZm90YmFsZSAubWF0LWNvdXJzZWluZm8gLm1hdC1jZWxsOmxhc3QtY2hpbGQgYSB7XG4gIGNvbG9yOiAjMGM0YjlhO1xuICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIC5kYXRlX2JveCA+IGRpdiA+IGRpdiA+IGRpdiB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGhlaWdodDogNTVweDtcbn1cbiNsZWFybmVyZmVlZGJhY2tsaXN0IC5jb3Vyc2VzaW5mb3RiYWxlIC5kYXRlX2ltZyA+IGJ1dHRvbiB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgYm90dG9tOiAxNHB4O1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG59XG4jbGVhcm5lcmZlZWRiYWNrbGlzdCAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jbGVhcm5lcmZlZWRiYWNrbGlzdCAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJmZWVkYmFja2xpc3QgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2Vlbjtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.ts":
/*!*************************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.ts ***!
  \*************************************************************************************************/
/*! exports provided: LearnerfeedbacktableComponent, FeedbackdataPagination */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LearnerfeedbacktableComponent", function() { return LearnerfeedbacktableComponent; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "FeedbackdataPagination", function() { return FeedbackdataPagination; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/cdk/a11y */ "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/a11y.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _env_environment__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @env/environment */ "./src/environments/environment.ts");
/* harmony import */ var rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! rxjs/observable/merge */ "./node_modules/rxjs-compat/_esm2015/observable/merge.js");
/* harmony import */ var rxjs_observable_of__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! rxjs/observable/of */ "./node_modules/rxjs-compat/_esm2015/observable/of.js");
/* harmony import */ var rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! rxjs/operators/startWith */ "./node_modules/rxjs-compat/_esm2015/operators/startWith.js");
/* harmony import */ var rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! rxjs/operators/switchMap */ "./node_modules/rxjs-compat/_esm2015/operators/switchMap.js");
/* harmony import */ var rxjs_operators_map__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! rxjs/operators/map */ "./node_modules/rxjs-compat/_esm2015/operators/map.js");
/* harmony import */ var rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! rxjs/operators/catchError */ "./node_modules/rxjs-compat/_esm2015/operators/catchError.js");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");


















let LearnerfeedbacktableComponent = class LearnerfeedbacktableComponent {
    constructor(translate, remoteService, cookieService, _liveAnnouncer, http) {
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this._liveAnnouncer = _liveAnnouncer;
        this.http = http;
        this.displayedColumns = ['sir_idnumber', 'sir_name_en', 'bmd_Batchno', 'Tomrm_tpname_en', 'Aomrm_tpname_en', 'feedback', 'action'];
        this.displaySearchColumns = ['row-one', 'row-two', 'row-three', 'row-four', 'row-five', 'row-six', 'row-seven'];
        this.page = 10;
        this.filter = false;
        this.resultsLength = 0;
        this.ifarabic = false;
        this.noData = '';
        this.civilnumber = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.learnername = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.batchnumber = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.trainingprovider = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.assessmentcentre = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.filtersts = true;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
    }
    // ngAfterViewInit() {
    //   this.dataSource.paginator = this.paginator;
    // }
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
                if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'en') {
                    this.ifarabic = false;
                }
                else {
                    this.ifarabic = true;
                }
            }
            else {
                const toSelect = this.languagelist.find(c => c.id == '1');
                //this.patientCategory.get('patientCategory').setValue(toSelect);
                this.translate.setDefaultLang(toSelect.languagecode);
                this.dir = toSelect.dir;
                if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'en') {
                    this.ifarabic = false;
                }
                else {
                    this.ifarabic = true;
                }
            }
        });
        this.civilnumber = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.civilnumber.valueChanges.debounceTime(400).subscribe(cvnumb => {
            if (cvnumb != null) {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
            else if (cvnumb == '') {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
        });
        this.learnername = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.learnername.valueChanges.debounceTime(400).subscribe(lername => {
            if (lername != null) {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
            else if (lername == '') {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
        });
        this.batchnumber = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.batchnumber.valueChanges.debounceTime(400).subscribe(btnumb => {
            if (btnumb != null) {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
            else if (btnumb == '') {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
        });
        this.trainingprovider = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.trainingprovider.valueChanges.debounceTime(400).subscribe(trpro => {
            if (trpro != null) {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
            else if (trpro == '') {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
        });
        this.assessmentcentre = new _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormControl"]('');
        this.assessmentcentre.valueChanges.debounceTime(400).subscribe(asscent => {
            if (asscent != null) {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
            else if (asscent == '') {
                this.paginator.pageIndex = 0;
                this.getfeedbackdata();
            }
        });
    }
    ngAfterViewInit() {
        this.getfeedbackdata();
    }
    clearFilter() {
        this.civilnumber.setValue("");
        this.learnername.setValue("");
        this.batchnumber.setValue("");
        this.trainingprovider.setValue("");
        this.assessmentcentre.setValue("");
        this.getfeedbackdata();
    }
    getfeedbackdata() {
        var _a, _b;
        this.feedbackGridDatas = new FeedbackdataPagination(this.http);
        (_a = this.sort) === null || _a === void 0 ? void 0 : _a.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
        var gridsearchvalue = {};
        gridsearchvalue = { civil_numb: this.civilnumber.value, learner_name: this.learnername.value, batchnumber: this.batchnumber.value, trainingprovider: this.trainingprovider.value, assessmentcentre: this.assessmentcentre.value };
        Object(rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_11__["merge"])((_b = this.sort) === null || _b === void 0 ? void 0 : _b.sortChange)
            .pipe(Object(rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_13__["startWith"])({}), Object(rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_14__["switchMap"])(() => {
            this.querystr = '';
            return this.feedbackGridDatas.feedbackdGridUtil(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.page, JSON.stringify(gridsearchvalue));
        }), Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_15__["map"])(data => {
            this.resultsLength = data['data'].data.totalcount;
            return data['data'].data.data;
        }), Object(rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_16__["catchError"])(() => {
            return Object(rxjs_observable_of__WEBPACK_IMPORTED_MODULE_12__["of"])('failure');
        })).subscribe(data => {
            this.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_3__["MatTableDataSource"](data);
            this.filtersts = true;
            this.noData = this.dataSource.connect().pipe(Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_15__["map"])(data => data.length === 0));
        });
    }
    showFilter() {
        this.filter = !this.filter;
        if (!this.filter) {
            const id = document.getElementById('searchrow');
            id.style.display = 'flex';
        }
        else {
            const id = document.getElementById('searchrow');
            id.style.display = 'none';
        }
    }
    syncPrimaryPaginator(event) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.page = event.pageSize;
        this.getfeedbackdata();
    }
};
LearnerfeedbacktableComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"] },
    { type: _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_8__["LiveAnnouncer"] },
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_9__["HttpClient"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__["MatPaginator"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__["MatPaginator"])
], LearnerfeedbacktableComponent.prototype, "paginator", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_17__["MatSort"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_17__["MatSort"])
], LearnerfeedbacktableComponent.prototype, "sort", void 0);
LearnerfeedbacktableComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-learnerfeedbacktable',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./learnerfeedbacktable.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./learnerfeedbacktable.component.scss */ "./src/app/modules/assessmentreport/learnerfeedbacktable/learnerfeedbacktable.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"],
        _angular_cdk_a11y__WEBPACK_IMPORTED_MODULE_8__["LiveAnnouncer"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_9__["HttpClient"]])
], LearnerfeedbacktableComponent);

class FeedbackdataPagination {
    constructor(http) {
        this.http = http;
    }
    feedbackdGridUtil(sort, order, page, size, gridsearchValues) {
        const sign = (order === 'desc') ? '-' : '';
        const href = _env_environment__WEBPACK_IMPORTED_MODULE_10__["environment"].baseUrl + 'lf/learnerfeedback/getfeedbacklist';
        const requestUrl = `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
        return this.http.get(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}


/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.scss":
/*!*************************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.scss ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#feedbackview {\n  padding-left: 10px;\n  font-size: 14px;\n}\n#feedbackview .txt-label {\n  color: #888;\n  font-size: 13px;\n}\n#feedbackview .txt-value {\n  color: #000;\n}\n#feedbackview .colsand {\n  color: #989898;\n}\n#feedbackview .colblue {\n  background-color: #0c4b9a;\n  color: aliceblue;\n}\n#feedbackview .colwh {\n  background-color: whitesmoke;\n}\n#feedbackview .colli {\n  color: #858181;\n}\n#feedbackview .trainfact {\n  padding: 30px 0px 10px 0px;\n}\n#feedbackview .phadd .mat-body p, #feedbackview .mat-body-2 p, #feedbackview .mat-typography .mat-body p, #feedbackview .mat-typography .mat-body-2 p, #feedbackview .mat-typography p {\n  margin: 0 0 0px;\n}\n#feedbackview .ppadd {\n  padding: 0px 30px 0px 30px;\n}\n#feedbackview .phadd {\n  padding-left: 20px;\n}\n#feedbackview .pstat {\n  padding: 0px 20px 0px 20px;\n}\n#feedbackview .border {\n  border: 0px solid #e5dcdc;\n  margin: 1em 0;\n  border-bottom-width: 0.01ex;\n}\n#feedbackview .pprdi {\n  padding: 6px 55px 6px 32px;\n}\n#feedbackview .pprdi.colli.mat-radio-button.mat-accent .mat-radio-inner-circle {\n  background-color: #e20613 !important;\n}\n#feedbackview .pprdi.colli.mat-radio-button.mat-accent.mat-radio-checked .mat-radio-outer-circle {\n  border-color: #9f9f9f;\n}\n#feedbackview .comlab {\n  padding-bottom: 5px;\n  color: #989898;\n}\n.rtl #learnerfeedback .phadd {\n  padding-left: 0;\n  padding-right: 20px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFja3ZpZXcvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcYXNzZXNzbWVudHJlcG9ydFxcbGVhcm5lcmZlZWRiYWNrdmlld1xcbGVhcm5lcmZlZWRiYWNrdmlldy5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFja3ZpZXcvbGVhcm5lcmZlZWRiYWNrdmlldy5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtFQUNJLGtCQUFBO0VBQ0EsZUFBQTtBQ0NKO0FEQUk7RUFDSSxXQUFBO0VBQ0EsZUFBQTtBQ0VSO0FEQUk7RUFDSSxXQUFBO0FDRVI7QURBSTtFQUNJLGNBQUE7QUNFUjtBREFJO0VBQ0kseUJBQUE7RUFDQSxnQkFBQTtBQ0VSO0FEQUk7RUFDSSw0QkFBQTtBQ0VSO0FEQUk7RUFDSSxjQUFBO0FDRVI7QURBSTtFQUNJLDBCQUFBO0FDRVI7QURBSTtFQUNJLGVBQUE7QUNFUjtBREFJO0VBQ0ksMEJBQUE7QUNFUjtBREFJO0VBQ0ksa0JBQUE7QUNFUjtBREFJO0VBQ0ksMEJBQUE7QUNFUjtBREFJO0VBQ0kseUJBQUE7RUFDQSxhQUFBO0VBQ0EsMkJBQUE7QUNFUjtBREFJO0VBQ0ksMEJBQUE7QUNFUjtBRENJO0VBQ0ksb0NBQUE7QUNDUjtBRENJO0VBQ0kscUJBQUE7QUNDUjtBREVJO0VBQ0ksbUJBQUE7RUFDQSxjQUFBO0FDQVI7QURNUTtFQUNJLGVBQUE7RUFDQSxtQkFBQTtBQ0haIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJmZWVkYmFja3ZpZXcvbGVhcm5lcmZlZWRiYWNrdmlldy5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIiNmZWVkYmFja3ZpZXd7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDEwcHg7XHJcbiAgICBmb250LXNpemU6IDE0cHg7XHJcbiAgICAudHh0LWxhYmVse1xyXG4gICAgICAgIGNvbG9yOiM4ODg7XHJcbiAgICAgICAgZm9udC1zaXplOjEzcHg7XHJcbiAgICB9XHJcbiAgICAudHh0LXZhbHVle1xyXG4gICAgICAgIGNvbG9yOiMwMDA7XHJcbiAgICB9XHJcbiAgICAuY29sc2FuZHtcclxuICAgICAgICBjb2xvcjogIzk4OTg5ODtcclxuICAgIH1cclxuICAgIC5jb2xibHVle1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6IzBjNGI5YSA7XHJcbiAgICAgICAgY29sb3I6YWxpY2VibHVlOyAgXHJcbiAgICB9XHJcbiAgICAuY29sd2h7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogd2hpdGVzbW9rZTtcclxuICAgIH1cclxuICAgIC5jb2xsaXtcclxuICAgICAgICBjb2xvcjogIzg1ODE4MTtcclxuICAgIH1cclxuICAgIC50cmFpbmZhY3R7XHJcbiAgICAgICAgcGFkZGluZzogMzBweCAwcHggMTBweCAwcHg7XHJcbiAgICB9XHJcbiAgICAucGhhZGQgLm1hdC1ib2R5IHAsIC5tYXQtYm9keS0yIHAsIC5tYXQtdHlwb2dyYXBoeSAubWF0LWJvZHkgcCwgLm1hdC10eXBvZ3JhcGh5IC5tYXQtYm9keS0yIHAsIC5tYXQtdHlwb2dyYXBoeSBwIHtcclxuICAgICAgICBtYXJnaW46IDAgMCAwcHg7XHJcbiAgICB9XHJcbiAgICAucHBhZGR7XHJcbiAgICAgICAgcGFkZGluZzogMHB4IDMwcHggMHB4IDMwcHg7XHJcbiAgICB9XHJcbiAgICAucGhhZGR7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAyMHB4O1xyXG4gICB9XHJcbiAgICAucHN0YXR7XHJcbiAgICAgICAgcGFkZGluZyA6IDBweCAyMHB4IDBweCAyMHB4O1xyXG4gICAgfVxyXG4gICAgLmJvcmRlcntcclxuICAgICAgICBib3JkZXI6IDBweCBzb2xpZCAjZTVkY2RjO1xyXG4gICAgICAgIG1hcmdpbjogMWVtIDA7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbS13aWR0aDogMC4wMWV4O1xyXG4gICAgfVxyXG4gICAgLnBwcmRpe1xyXG4gICAgICAgIHBhZGRpbmc6IDZweCA1NXB4IDZweCAzMnB4O1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAucHByZGkuY29sbGkubWF0LXJhZGlvLWJ1dHRvbi5tYXQtYWNjZW50IC5tYXQtcmFkaW8taW5uZXItY2lyY2xle1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlMjA2MTMgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5wcHJkaS5jb2xsaS5tYXQtcmFkaW8tYnV0dG9uLm1hdC1hY2NlbnQubWF0LXJhZGlvLWNoZWNrZWQgLm1hdC1yYWRpby1vdXRlci1jaXJjbGUge1xyXG4gICAgICAgIGJvcmRlci1jb2xvcjogIzlmOWY5ZjtcclxuICAgIH1cclxuXHJcbiAgICAuY29tbGFie1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiA1cHg7XHJcbiAgICAgICAgY29sb3I6ICM5ODk4OTg7XHJcbiAgICB9XHJcbn1cclxuXHJcbi5ydGx7XHJcbiAgICAjbGVhcm5lcmZlZWRiYWNre1xyXG4gICAgICAgIC5waGFkZHtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OjA7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6MjBweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0iLCIjZmVlZGJhY2t2aWV3IHtcbiAgcGFkZGluZy1sZWZ0OiAxMHB4O1xuICBmb250LXNpemU6IDE0cHg7XG59XG4jZmVlZGJhY2t2aWV3IC50eHQtbGFiZWwge1xuICBjb2xvcjogIzg4ODtcbiAgZm9udC1zaXplOiAxM3B4O1xufVxuI2ZlZWRiYWNrdmlldyAudHh0LXZhbHVlIHtcbiAgY29sb3I6ICMwMDA7XG59XG4jZmVlZGJhY2t2aWV3IC5jb2xzYW5kIHtcbiAgY29sb3I6ICM5ODk4OTg7XG59XG4jZmVlZGJhY2t2aWV3IC5jb2xibHVlIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcbiAgY29sb3I6IGFsaWNlYmx1ZTtcbn1cbiNmZWVkYmFja3ZpZXcgLmNvbHdoIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogd2hpdGVzbW9rZTtcbn1cbiNmZWVkYmFja3ZpZXcgLmNvbGxpIHtcbiAgY29sb3I6ICM4NTgxODE7XG59XG4jZmVlZGJhY2t2aWV3IC50cmFpbmZhY3Qge1xuICBwYWRkaW5nOiAzMHB4IDBweCAxMHB4IDBweDtcbn1cbiNmZWVkYmFja3ZpZXcgLnBoYWRkIC5tYXQtYm9keSBwLCAjZmVlZGJhY2t2aWV3IC5tYXQtYm9keS0yIHAsICNmZWVkYmFja3ZpZXcgLm1hdC10eXBvZ3JhcGh5IC5tYXQtYm9keSBwLCAjZmVlZGJhY2t2aWV3IC5tYXQtdHlwb2dyYXBoeSAubWF0LWJvZHktMiBwLCAjZmVlZGJhY2t2aWV3IC5tYXQtdHlwb2dyYXBoeSBwIHtcbiAgbWFyZ2luOiAwIDAgMHB4O1xufVxuI2ZlZWRiYWNrdmlldyAucHBhZGQge1xuICBwYWRkaW5nOiAwcHggMzBweCAwcHggMzBweDtcbn1cbiNmZWVkYmFja3ZpZXcgLnBoYWRkIHtcbiAgcGFkZGluZy1sZWZ0OiAyMHB4O1xufVxuI2ZlZWRiYWNrdmlldyAucHN0YXQge1xuICBwYWRkaW5nOiAwcHggMjBweCAwcHggMjBweDtcbn1cbiNmZWVkYmFja3ZpZXcgLmJvcmRlciB7XG4gIGJvcmRlcjogMHB4IHNvbGlkICNlNWRjZGM7XG4gIG1hcmdpbjogMWVtIDA7XG4gIGJvcmRlci1ib3R0b20td2lkdGg6IDAuMDFleDtcbn1cbiNmZWVkYmFja3ZpZXcgLnBwcmRpIHtcbiAgcGFkZGluZzogNnB4IDU1cHggNnB4IDMycHg7XG59XG4jZmVlZGJhY2t2aWV3IC5wcHJkaS5jb2xsaS5tYXQtcmFkaW8tYnV0dG9uLm1hdC1hY2NlbnQgLm1hdC1yYWRpby1pbm5lci1jaXJjbGUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZTIwNjEzICFpbXBvcnRhbnQ7XG59XG4jZmVlZGJhY2t2aWV3IC5wcHJkaS5jb2xsaS5tYXQtcmFkaW8tYnV0dG9uLm1hdC1hY2NlbnQubWF0LXJhZGlvLWNoZWNrZWQgLm1hdC1yYWRpby1vdXRlci1jaXJjbGUge1xuICBib3JkZXItY29sb3I6ICM5ZjlmOWY7XG59XG4jZmVlZGJhY2t2aWV3IC5jb21sYWIge1xuICBwYWRkaW5nLWJvdHRvbTogNXB4O1xuICBjb2xvcjogIzk4OTg5ODtcbn1cblxuLnJ0bCAjbGVhcm5lcmZlZWRiYWNrIC5waGFkZCB7XG4gIHBhZGRpbmctbGVmdDogMDtcbiAgcGFkZGluZy1yaWdodDogMjBweDtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.ts":
/*!***********************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.ts ***!
  \***********************************************************************************************/
/*! exports provided: LearnerfeedbackviewComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LearnerfeedbackviewComponent", function() { return LearnerfeedbackviewComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _app_services_learnerfeedback_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/services/learnerfeedback.service */ "./src/app/services/learnerfeedback.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");







let LearnerfeedbackviewComponent = class LearnerfeedbackviewComponent {
    constructor(translate, remoteService, cookieService, learnerfeedback, route) {
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.learnerfeedback = learnerfeedback;
        this.route = route;
        this.data = [
            {
                title: 'TRAINING FACILITY',
                ques: [
                    {
                        question: 'Do you feel the site training facility enhances learning ?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do you feel the classroom is comfortable and appropriate for the course ?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do you feel the workshops/practical areas are well equipped and appropriate for the course ?',
                        answer: 1,
                        index: 0,
                    }
                ]
            },
            {
                title: 'PROGRESS',
                ques: [
                    {
                        question: ' Was the process of getting your qualification explained to you clearly?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: ' Throughout the course have you been set realistic targets?',
                        answer: 2,
                        index: 0,
                    },
                    {
                        question: ' Do you feel you are progressing well in accordance with the training plan?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: ' Do you receive a regular review/feedback of your progress throughout the course?',
                        answer: 1,
                        index: 0,
                    }
                ]
            },
            {
                title: ' TRAINING',
                ques: [
                    {
                        question: 'Do you feel the trainers are well prep ?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do you feel the trainers are knowledgeable in the subject area ?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do the trainers present information clearly and accurately ?',
                        answer: 3,
                        index: 0,
                    },
                    {
                        question: 'Do the trainers use a range of visual aids to aid learning ?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do the trainers use  real world scenarios from the Industry to aid learning ?',
                        answer: 2,
                        index: 0,
                    },
                    {
                        question: 'Do the trainers regularly invlove/encourage you by asking questions ?',
                        answer: 2,
                        index: 0,
                    },
                    {
                        question: 'Do the trainers are appropriate tests/exercises ?',
                        answer: 1,
                        index: 0,
                    }
                ]
            },
            {
                title: 'ASSESSEMENT (if applicable)',
                ques: [
                    {
                        question: 'Was the assessment plan explained to you clearly at the start of the course?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do you feel you have been given enough time to complete your assessments successfully?',
                        answer: 2,
                        index: 0,
                    },
                    {
                        question: 'Do you feel there is a good range of assessment methods used? ',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do you feel you are given constructive feedback following an assessment help you improve? ',
                        answer: 3,
                        index: 0,
                    }
                ]
            },
            {
                title: 'RIGHTS AND OPINIONS',
                ques: [
                    {
                        question: 'Do you feel that Learning is interesting and constructive?',
                        answer: 1,
                        index: 0,
                    },
                    {
                        question: 'Do you feel that this qualification will give you a good background in your career?',
                        answer: 3,
                        index: 0,
                    },
                    {
                        question: 'Was the appeals process explained to you clearly ate the start of course ? ',
                        answer: 2,
                        index: 0,
                    },
                    {
                        question: 'Does the level of support you have received meet your expectations? ',
                        answer: 2,
                        index: 0,
                    },
                    {
                        question: 'Do you feel you are being fairly treated? ',
                        answer: 1,
                        index: 0,
                    }
                ]
            }
        ];
        this.loading = false;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
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
            }
        });
        let i = 1;
        this.data.forEach(item => {
            item.ques.forEach(quess => {
                quess.index = i++;
            });
        });
        console.log('this.data', this.data);
        this.id = this.route.snapshot.paramMap.get('id');
        this.getfeedbackquestion();
    }
    getfeedbackquestion() {
        this.loading = true;
        this.learnerfeedback.getfeedbackquestionanswer(this.id).subscribe(res => {
            this.alldata = res.data;
            this.questions = res.data.feedback;
            this.answer = res.data.feedbackans;
            let i = 1;
            this.questions.forEach(item => {
                item.questions.forEach(quess => {
                    quess.index = i++;
                    let val = this.answer.filter(item => item.lfdbkansd_fdbkquestmst_fk == quess.FdbkQuestMst_PK);
                    quess.value = val[0].lfdbkansd_agree == 1 ? 1 : val[0].lfdbkansd_disagree == 1 ? 2 : val[0].lfdbkansd_stronglyagree == 1 ? 3 : 0;
                });
            });
            this.loading = false;
        });
    }
};
LearnerfeedbackviewComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"] },
    { type: _app_services_learnerfeedback_service__WEBPACK_IMPORTED_MODULE_5__["LearnerFeedbackService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_6__["ActivatedRoute"] }
];
LearnerfeedbackviewComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-learnerfeedbackview',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./learnerfeedbackview.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./learnerfeedbackview.component.scss */ "./src/app/modules/assessmentreport/learnerfeedbackview/learnerfeedbackview.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"],
        _app_services_learnerfeedback_service__WEBPACK_IMPORTED_MODULE_5__["LearnerFeedbackService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_6__["ActivatedRoute"]])
], LearnerfeedbackviewComponent);



/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.scss":
/*!***************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.scss ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#learnerreglist {\n  margin-bottom: 4%;\n}\n#learnerreglist .headcolor {\n  color: #0C4B9A;\n}\n#learnerreglist .knowledgegrid {\n  background: #FFFFFF 0% 0% no-repeat padding-box;\n  box-shadow: 0px 0px 8px #0000001a;\n  border: 1px solid #D7DCE3;\n  border-radius: 4px;\n  opacity: 1;\n}\n#learnerreglist .knowledgegrid .headcolor {\n  color: #0C4B9A;\n}\n#learnerreglist .knowledgegrid .text-gray {\n  color: #707070;\n}\n#learnerreglist .knowledgegrid .text-default {\n  color: #262626 !important;\n}\n#learnerreglist .knowledgegrid .bold {\n  font-weight: 600;\n}\n#learnerreglist .knowledgegrid .details {\n  border-bottom: 1px solid #D7DCE3;\n  position: relative;\n}\n#learnerreglist .knowledgegrid .details .head {\n  justify-content: space-between;\n  align-items: center;\n  height: 40px;\n}\n#learnerreglist .knowledgegrid .details .head .grade {\n  align-items: center;\n  color: #895B37;\n}\n#learnerreglist .knowledgegrid .details .head .gold {\n  align-items: center;\n  color: #BA9666;\n}\n#learnerreglist .knowledgegrid .details .head .silver {\n  align-items: center;\n  color: #B9BABC;\n}\n#learnerreglist .knowledgegrid .details .application-detais {\n  border: 1px solid #D7DCE3;\n  padding: 5px;\n  margin-top: 10px !important;\n}\n#learnerreglist .knowledgegrid .details .actionmenubtn {\n  position: absolute;\n  top: 10px;\n  right: 10px;\n}\n#learnerreglist .knowledgegrid .address {\n  justify-content: flex-start;\n}\n#learnerreglist .knowledgegrid .address .add-details i {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #707070;\n}\n#learnerreglist .knowledgegrid .pas.pending {\n  color: #0C4B9A;\n}\n#learnerreglist .btngroup .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 120px;\n  height: 45px;\n  padding-left: 0px;\n  padding-right: 0px;\n  font-size: 15px;\n}\n#learnerreglist .btngroup .cancelbtn {\n  min-width: 120px;\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  font-size: 15px;\n  box-shadow: none;\n}\n#learnerreglist .btngroup .mat-raised-button {\n  border-radius: 2px;\n}\n#learnerreglist .tabforclientelenew .mat-form-field-appearance-outline .mat-form-field-infix {\n  padding: 8px 0 !important;\n}\n#learnerreglist .tabforclientelenew .manageoptions .mat-icon {\n  color: #acacac;\n}\n#learnerreglist .mat-raised-button {\n  border-radius: 2px;\n  box-shadow: none;\n}\n#learnerreglist .menubtn {\n  min-width: 170px;\n}\n#learnerreglist .auditbtn {\n  background-color: #fff;\n  color: #262626;\n  height: 45px;\n  min-width: 120px;\n  border: 1px solid #d7dce3;\n}\n#learnerreglist .filelabel {\n  font-size: 13px;\n  color: rgba(0, 0, 0, 0.6);\n  margin-bottom: 10px;\n}\n#learnerreglist .filelabel .required {\n  color: #ff0000;\n  font-size: 13px;\n  margin-left: 3px;\n}\n#learnerreglist .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#learnerreglist .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#learnerreglist .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#learnerreglist .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#learnerreglist .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-form-field-disabled .mat-input-element {\n  color: #262626;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#learnerreglist .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#learnerreglist .savnxtbtn {\n  box-shadow: none;\n  min-width: 100px;\n  height: 40px;\n  background-color: #ED1C27;\n  color: #fff;\n}\n#learnerreglist .prevbtn {\n  border: 1px solid #ddd;\n  background: #fff;\n  min-width: 100px;\n}\n#learnerreglist .readonly {\n  border: 2px solid #eee;\n  background: #f8f8f8;\n  padding: 5px 8px;\n  border-radius: 1px;\n}\n#learnerreglist .uploadeddoc {\n  display: flex;\n  align-items: center;\n}\n#learnerreglist .uploadeddoc a {\n  color: #666;\n  font-size: 14px;\n}\n#learnerreglist .actionmatmenu {\n  background: #666;\n  border-radius: 0px;\n  min-width: 100px;\n}\n#learnerreglist .actionmatmenu .mat-menu-content button.mat-menu-item {\n  height: 28px;\n  color: #fff;\n  line-height: 28px;\n}\n#learnerreglist .validatebluebtn #validmsg .validet {\n  background: #0C4B9A;\n  color: #fff;\n}\n#learnerreglist .learnerregdetails {\n  border-bottom: 1px solid #D7DCE3;\n}\n#learnerreglist .learnerregdetails .addbtn, #learnerreglist .learnerregdetails .filterbtn {\n  min-width: 100px;\n}\n#learnerreglist .learnerregdetails .addbtn {\n  background: #ed1c27;\n  color: #fff;\n}\n#learnerreglist .learnerregdetails .filterbtn {\n  box-shadow: none;\n  border: 1px solid #ddd;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#learnerreglist .learnerregdetails .mat-form-field-appearance-outline .mat-form-field-suffix .mat-icon {\n  color: #888;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .available, #learnerreglist .learnerregdetails .learnerreglstcontainer .booked, #learnerreglist .learnerregdetails .learnerreglstcontainer .notavailable {\n  color: #00a551;\n  font-size: 0.9375rem;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .notavailable {\n  color: #ed1c27 !important;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .booked {\n  color: #0c4b9a !important;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable {\n  width: 100%;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-row, #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-row {\n  width: 100%;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n  white-space: nowrap;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-cell, #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-cell {\n  min-width: 20%;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-cell:first-child, #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-cell:nth-child(5), #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-cell:nth-child(6), #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-cell:first-child, #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-cell:nth-child(5), #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-cell:nth-child(6) {\n  min-width: 10%;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-cell:nth-child(12), #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-cell:nth-child(12) {\n  min-width: 15%;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-header-cell:last-child, #learnerreglist .learnerregdetails .learnerreglstcontainer .scheduletable .mat-cell:last-child {\n  min-width: 10%;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .mat-sort-header-arrow {\n  color: #ED1C27;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer #searchrow {\n  background: #fff;\n  padding: 5px 0;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer #searchrow .searchrow:last-child {\n  visibility: hidden;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer #searchrow .mat-header-cell {\n  color: #626366 !important;\n  background-color: #fff;\n  font-size: 15px;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer #searchrow .mat-header-cell .mat-form-field {\n  padding-right: 15px;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer #searchrow .mat-header-cell .mat-form-field .mat-form-field-wrapper {\n  padding: 0px;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .flexaligntag.fail, #learnerreglist .learnerregdetails .learnerreglstcontainer .flexaligntag.new, #learnerreglist .learnerregdetails .learnerreglstcontainer .flexaligntag.yettopay {\n  color: #ED1C27;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .flexaligntag.pass {\n  color: #00A551;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .flexaligntag.paid {\n  color: #5fcc32;\n}\n#learnerreglist .learnerregdetails .learnerreglstcontainer .flexaligntag.pending {\n  color: #f4811f;\n}\n#learnerreglist .learnerregdetails .btmpagination .masterbottom .mat-paginator-container {\n  justify-content: space-between;\n  font-size: 16px !important;\n}\n@media (max-width: 567px) {\n  #learnerreglist .learnerregdetails .btmpagination .masterbottom .mat-paginator-container {\n    flex-direction: row !important;\n  }\n}\n@media (max-width: 567px) {\n  #learnerreglist .learnerregdetails .btmpagination .masterbottom .mat-paginator-container .mat-paginator-page-size,\n#learnerreglist .learnerregdetails .btmpagination .masterbottom .mat-paginator-container .mat-paginator-range-actions {\n    width: 100% !important;\n  }\n}\n#learnerreglist .learnerregdetails .btmpagination .masterbottom .mat-paginator-container .mat-paginator-range-actions {\n  margin-top: 0px;\n}\n#learnerreglist .learnerregdetails .btmpagination .masterbottom .mat-paginator-range-actions .mat-paginator-range-label {\n  flex: auto;\n}\n#learnerreglist .learnerregdetails .toppagination {\n  margin-top: 8px;\n}\n#learnerreglist .learnerregdetails .toppagination .masterPageTop {\n  min-width: 50%;\n}\n#learnerreglist .learnerregdetails .toppagination .masterPageTop .mat-paginator-container {\n  justify-content: flex-start;\n  font-size: 15px !important;\n  flex-wrap: nowrap;\n}\n@media (min-width: 320px) and (max-width: 414px) {\n  #learnerreglist .learnerregdetails .toppagination .masterPageTop .mat-paginator-container {\n    flex-direction: row !important;\n  }\n}\n#learnerreglist .learnerregdetails .toppagination .masterPageTop .mat-paginator-container .mat-paginator-range-actions {\n  width: calc(100% - 200px);\n  margin-top: 0px;\n}\n#learnerreglist .learnerregdetails .toppagination .masterPageTop .mat-paginator-navigation-previous,\n#learnerreglist .learnerregdetails .toppagination .masterPageTop .mat-paginator-navigation-next {\n  display: none !important;\n}\n#learnerreglist .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#learnerreglist .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#learnerreglist .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#learnerreglist .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#learnerreglist .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n.actionmatmenu {\n  background: #666;\n  border-radius: 0px;\n  min-width: 100px;\n}\n.actionmatmenu .mat-menu-content button.mat-menu-item {\n  height: 28px;\n  color: #fff;\n  line-height: 28px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJyZWdsaXN0L0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFzc2Vzc21lbnRyZXBvcnRcXGxlYXJuZXJyZWdsaXN0XFxsZWFybmVycmVnbGlzdC5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJyZWdsaXN0L2xlYXJuZXJyZWdsaXN0LmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0VBQ0ksaUJBQUE7QUNDSjtBRENJO0VBQ0ksY0FBQTtBQ0NSO0FEQ0k7RUFDSSwrQ0FBQTtFQUNBLGlDQUFBO0VBQ0EseUJBQUE7RUFDQSxrQkFBQTtFQUNBLFVBQUE7QUNDUjtBRENRO0VBQ0ksY0FBQTtBQ0NaO0FERVE7RUFDSSxjQUFBO0FDQVo7QURHUTtFQUNJLHlCQUFBO0FDRFo7QURJUTtFQUNJLGdCQUFBO0FDRlo7QURLUTtFQUNJLGdDQUFBO0VBQ0Esa0JBQUE7QUNIWjtBRElZO0VBQ0ksOEJBQUE7RUFDQSxtQkFBQTtFQUNBLFlBQUE7QUNGaEI7QURJZ0I7RUFDSSxtQkFBQTtFQUNBLGNBQUE7QUNGcEI7QURLZ0I7RUFDSSxtQkFBQTtFQUNBLGNBQUE7QUNIcEI7QURNZ0I7RUFDSSxtQkFBQTtFQUNBLGNBQUE7QUNKcEI7QURRWTtFQUNJLHlCQUFBO0VBQ0EsWUFBQTtFQUNBLDJCQUFBO0FDTmhCO0FEU1k7RUFDSSxrQkFBQTtFQUNBLFNBQUE7RUFDQSxXQUFBO0FDUGhCO0FEWVE7RUFDSSwyQkFBQTtBQ1ZaO0FEYWdCO0VBRUksa0JBQUE7RUFDQSw4QkFBQTtFQUNBLGtDQUFBO0FDWnBCO0FEa0JRO0VBQ0ksY0FBQTtBQ2hCWjtBRHVCUTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtBQ3JCWjtBRHdCUTtFQUNJLGdCQUFBO0VBQ0EsdUJBQUE7RUFDQSx5QkFBQTtFQUNBLGNBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EsWUFBQTtFQUNBLGVBQUE7RUFDQSxnQkFBQTtBQ3RCWjtBRDBCUTtFQUNJLGtCQUFBO0FDeEJaO0FEOEJZO0VBQ0kseUJBQUE7QUM1QmhCO0FEaUNZO0VBQ0ksY0FBQTtBQy9CaEI7QURvQ0k7RUFDSSxrQkFBQTtFQUNBLGdCQUFBO0FDbENSO0FEcUNJO0VBQ0ksZ0JBQUE7QUNuQ1I7QURzQ0k7RUFDSSxzQkFBQTtFQUNBLGNBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSx5QkFBQTtBQ3BDUjtBRHNDSTtFQUNJLGVBQUE7RUFDQSx5QkFBQTtFQUNBLG1CQUFBO0FDcENSO0FEcUNRO0VBQ0ksY0FBQTtFQUNBLGVBQUE7RUFDQSxnQkFBQTtBQ25DWjtBRHVDUTtFQUNJLGNBQUE7QUNyQ1o7QUR3Q1E7RUFDSSwwQkFBQTtBQ3RDWjtBRHlDUTtFQUNJLDBCQUFBO0FDdkNaO0FEMENRO0VBQ0ksY0FBQTtBQ3hDWjtBRDJDUTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ3pDWjtBRDZDWTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQzNDaEI7QURnRG9CO0VBQ0ksY0FBQTtBQzlDeEI7QURxRFk7RUFDSSx5QkFBQTtBQ25EaEI7QURxRFk7RUFDSSxjQUFBO0FDbkRoQjtBRDBEWTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ3hEaEI7QUQ4RGdCO0VBQ0ksMENBQUE7RUFDQSxjQUFBO0FDNURwQjtBRDhEb0I7RUFDSSxjQUFBO0FDNUR4QjtBRGdFZ0I7RUFDSSxxQkFBQTtBQzlEcEI7QURtRUk7RUFDSSxnQkFBQTtFQUNBLGdCQUFBO0VBQ0EsWUFBQTtFQUNBLHlCQUFBO0VBQ0EsV0FBQTtBQ2pFUjtBRG1FSTtFQUNJLHNCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkFBQTtBQ2pFUjtBRG1FSTtFQUNJLHNCQUFBO0VBQ0EsbUJBQUE7RUFDQSxnQkFBQTtFQUNBLGtCQUFBO0FDakVSO0FEbUVJO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDakVSO0FEa0VRO0VBQ0ksV0FBQTtFQUNBLGVBQUE7QUNoRVo7QURtRUk7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZ0JBQUE7QUNqRVI7QURtRVk7RUFDSSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGlCQUFBO0FDakVoQjtBRHVFWTtFQUNJLG1CQUFBO0VBQ0EsV0FBQTtBQ3JFaEI7QUQyRUk7RUFDSSxnQ0FBQTtBQ3pFUjtBRDBFUTtFQUNJLGdCQUFBO0FDeEVaO0FEMEVRO0VBQ0ksbUJBQUE7RUFDQSxXQUFBO0FDeEVaO0FEMEVRO0VBQ0ksZ0JBQUE7RUFDQSxzQkFBQTtBQ3hFWjtBRDJFWTtFQUNJLGNBQUE7QUN6RWhCO0FENEVZO0VBQ0ksMEJBQUE7QUMxRWhCO0FENkVZO0VBQ0ksMEJBQUE7QUMzRWhCO0FEOEVZO0VBQ0ksY0FBQTtBQzVFaEI7QUQrRVk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUM3RWhCO0FEaUZnQjtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQy9FcEI7QURvRndCO0VBQ0ksY0FBQTtBQ2xGNUI7QUR5RmdCO0VBQ0kseUJBQUE7QUN2RnBCO0FENkZnQjtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQzNGcEI7QURpR29CO0VBQ0ksMENBQUE7RUFDQSxjQUFBO0FDL0Z4QjtBRGlHd0I7RUFDSSxjQUFBO0FDL0Y1QjtBRG1Hb0I7RUFDSSxxQkFBQTtBQ2pHeEI7QURzR2dCO0VBQ0ksV0FBQTtBQ3BHcEI7QUR5R1k7RUFDSSxjQUFBO0VBQ0Esb0JBQUE7QUN2R2hCO0FEMEdZO0VBRUkseUJBQUE7QUN6R2hCO0FENEdZO0VBRUkseUJBQUE7QUMzR2hCO0FENkdZO0VBQ0ksV0FBQTtBQzNHaEI7QUQ0R2dCO0VBQ0ksV0FBQTtBQzFHcEI7QUQ0R2dCO0VBQ0kseUJBQUE7RUFDQSx5QkFBQTtFQUNBLGVBQUE7RUFDQSxtQkFBQTtBQzFHcEI7QUQ0R2dCO0VBQ0ksY0FBQTtBQzFHcEI7QUQyR29CO0VBR0ksY0FBQTtBQzNHeEI7QUQ2R29CO0VBQ0ksY0FBQTtBQzNHeEI7QUQ2R29CO0VBQ0ksY0FBQTtBQzNHeEI7QUQrR1k7RUFDSSxjQUFBO0FDN0doQjtBRCtHWTtFQUNJLGdCQUFBO0VBQ0EsY0FBQTtBQzdHaEI7QUQrR29CO0VBQ0ksa0JBQUE7QUM3R3hCO0FEZ0hnQjtFQUNJLHlCQUFBO0VBQ0Esc0JBQUE7RUFDQSxlQUFBO0FDOUdwQjtBRCtHb0I7RUFDSSxtQkFBQTtBQzdHeEI7QUQ4R3dCO0VBQ0ksWUFBQTtBQzVHNUI7QURrSGdCO0VBQ0ksY0FBQTtBQ2hIcEI7QURrSGdCO0VBQ0ksY0FBQTtBQ2hIcEI7QURrSGdCO0VBQ0ksY0FBQTtBQ2hIcEI7QURrSGdCO0VBQ0ksY0FBQTtBQ2hIcEI7QURzSGdCO0VBQ0EsOEJBQUE7RUFDQSwwQkFBQTtBQ3BIaEI7QURzSGdCO0VBSkE7SUFLSSw4QkFBQTtFQ25IbEI7QUFDRjtBRHVIb0I7RUFGSjs7SUFHSSxzQkFBQTtFQ25IbEI7QUFDRjtBRHFIZ0I7RUFDSSxlQUFBO0FDbkhwQjtBRHdIZ0I7RUFDSSxVQUFBO0FDdEhwQjtBRDJIUTtFQUNJLGVBQUE7QUN6SFo7QUQwSFk7RUFDSSxjQUFBO0FDeEhoQjtBRHlIZ0I7RUFDQSwyQkFBQTtFQUNBLDBCQUFBO0VBQ0EsaUJBQUE7QUN2SGhCO0FEd0hnQjtFQUpBO0lBS0ksOEJBQUE7RUNySGxCO0FBQ0Y7QUR1SGdCO0VBQ0kseUJBQUE7RUFDQSxlQUFBO0FDckhwQjtBRHlIZ0I7O0VBRUEsd0JBQUE7QUN2SGhCO0FENEhJO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQzFIUjtBRDRIUTtFQUNJLFVBQUE7RUFDQSxXQUFBO0FDMUhaO0FENkhRO0VBQ0ksbUJBQUE7QUMzSFo7QUQ4SFE7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FDNUhaO0FEK0hRO0VBQ0ksZ0JBQUE7QUM3SFo7QURtSUE7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZ0JBQUE7QUNoSUo7QURrSVE7RUFDSSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGlCQUFBO0FDaElaIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L2xlYXJuZXJyZWdsaXN0L2xlYXJuZXJyZWdsaXN0LmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiI2xlYXJuZXJyZWdsaXN0IHtcclxuICAgIG1hcmdpbi1ib3R0b206IDQlOyAgICBcclxuXHJcbiAgICAuaGVhZGNvbG9yIHtcclxuICAgICAgICBjb2xvcjogIzBDNEI5QTtcclxuICAgIH1cclxuICAgIC5rbm93bGVkZ2VncmlkIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjRkZGRkZGIDAlIDAlIG5vLXJlcGVhdCBwYWRkaW5nLWJveDtcclxuICAgICAgICBib3gtc2hhZG93OiAwcHggMHB4IDhweCAjMDAwMDAwMWE7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI0Q3RENFMztcclxuICAgICAgICBib3JkZXItcmFkaXVzOiA0cHg7XHJcbiAgICAgICAgb3BhY2l0eTogMTtcclxuXHJcbiAgICAgICAgLmhlYWRjb2xvciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMEM0QjlBO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnRleHQtZ3JheSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNzA3MDcwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnRleHQtZGVmYXVsdCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYm9sZCB7XHJcbiAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiA2MDA7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuZGV0YWlscyB7XHJcbiAgICAgICAgICAgIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjRDdEQ0UzO1xyXG4gICAgICAgICAgICBwb3NpdGlvbjpyZWxhdGl2ZTtcclxuICAgICAgICAgICAgLmhlYWQge1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogNDBweDtcclxuXHJcbiAgICAgICAgICAgICAgICAuZ3JhZGUge1xyXG4gICAgICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4OTVCMzc7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLmdvbGQge1xyXG4gICAgICAgICAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNCQTk2NjY7XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLnNpbHZlciB7XHJcbiAgICAgICAgICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0I5QkFCQztcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLmFwcGxpY2F0aW9uLWRldGFpcyB7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjRDdEQ0UzO1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogNXB4O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLXRvcDogMTBweCAhaW1wb3J0YW50O1xyXG5cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAuYWN0aW9ubWVudWJ0bntcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOmFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgdG9wOjEwcHg7XHJcbiAgICAgICAgICAgICAgICByaWdodDoxMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmFkZHJlc3Mge1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcblxyXG4gICAgICAgICAgICAuYWRkLWRldGFpbHMge1xyXG4gICAgICAgICAgICAgICAgaSB7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiB0cmFuc3BhcmVudDtcclxuICAgICAgICAgICAgICAgICAgICAtd2Via2l0LXRleHQtc3Ryb2tlLXdpZHRoOiAxcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogIzcwNzA3MDtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAucGFze1xyXG4gICAgICAgICYucGVuZGluZ3tcclxuICAgICAgICAgICAgY29sb3I6ICMwQzRCOUE7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIH1cclxuXHJcbiAgICAuYnRuZ3JvdXAge1xyXG4gICAgICAgIC5zdWJtaXRfYnRuIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDEyMHB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5jYW5jZWxidG4ge1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6IDEyMHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2U4ZThlODtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG5cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcmFpc2VkLWJ1dHRvbiB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnRhYmZvcmNsaWVudGVsZW5ldyB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHggMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbiB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2FjYWNhYztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAubWF0LXJhaXNlZC1idXR0b24ge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgfVxyXG5cclxuICAgIC5tZW51YnRuIHtcclxuICAgICAgICBtaW4td2lkdGg6IDE3MHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5hdWRpdGJ0biB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZDdkY2UzO1xyXG4gICAgfVxyXG4gICAgLmZpbGVsYWJlbHtcclxuICAgICAgICBmb250LXNpemU6MTNweDtcclxuICAgICAgICBjb2xvcjpyZ2JhKDAsIDAsIDAsIDAuNik7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbToxMHB4O1xyXG4gICAgICAgIC5yZXF1aXJlZHtcclxuICAgICAgICAgICAgY29sb3I6I2ZmMDAwMDtcclxuICAgICAgICAgICAgZm9udC1zaXplOjEzcHg7XHJcbiAgICAgICAgICAgIG1hcmdpbi1sZWZ0OjNweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIHtcclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtaW5wdXQtZWxlbWVudCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuc2F2bnh0YnRue1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMDBweDtcclxuICAgICAgICBoZWlnaHQ6IDQwcHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNztcclxuICAgICAgICBjb2xvcjogI2ZmZjsgXHJcbiAgICB9XHJcbiAgICAucHJldmJ0bntcclxuICAgICAgICBib3JkZXI6MXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgYmFja2dyb3VuZDojZmZmO1xyXG4gICAgICAgIG1pbi13aWR0aDogMTAwcHg7XHJcbiAgICB9XHJcbiAgICAucmVhZG9ubHl7XHJcbiAgICAgICAgYm9yZGVyOjJweCBzb2xpZCAjZWVlO1xyXG4gICAgICAgIGJhY2tncm91bmQ6I2Y4ZjhmODtcclxuICAgICAgICBwYWRkaW5nOjVweCA4cHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czoxcHg7XHJcbiAgICB9XHJcbiAgICAudXBsb2FkZWRkb2N7XHJcbiAgICAgICAgZGlzcGxheTpmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgYXtcclxuICAgICAgICAgICAgY29sb3I6IzY2NjtcclxuICAgICAgICAgICAgZm9udC1zaXplOjE0cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmFjdGlvbm1hdG1lbnV7XHJcbiAgICAgICAgYmFja2dyb3VuZDogIzY2NjtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAwcHg7XHJcbiAgICAgICAgbWluLXdpZHRoOiAxMDBweDtcclxuICAgICAgICAubWF0LW1lbnUtY29udGVudHtcclxuICAgICAgICAgICAgYnV0dG9uLm1hdC1tZW51LWl0ZW17XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6MjhweDtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiNmZmY7XHJcbiAgICAgICAgICAgICAgICBsaW5lLWhlaWdodDoyOHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLnZhbGlkYXRlYmx1ZWJ0bntcclxuICAgICAgICAjdmFsaWRtc2d7XHJcbiAgICAgICAgICAgIC52YWxpZGV0e1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDojMEM0QjlBO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6I2ZmZjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0gICAgICAgICBcclxuICAgIH1cclxuXHJcbiAgICAvL3RhYmxlXHJcbiAgICAubGVhcm5lcnJlZ2RldGFpbHMge1xyXG4gICAgICAgIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjRDdEQ0UzO1xyXG4gICAgICAgIC5hZGRidG4sIC5maWx0ZXJidG57XHJcbiAgICAgICAgICAgIG1pbi13aWR0aDoxMDBweDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmFkZGJ0bntcclxuICAgICAgICAgICAgYmFja2dyb3VuZDojZWQxYzI3O1xyXG4gICAgICAgICAgICBjb2xvcjojZmZmO1xyXG4gICAgICAgIH1cclxuICAgICAgICAuZmlsdGVyYnRue1xyXG4gICAgICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgICAgICAgICBib3JkZXI6MXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2Q5ZDlkOTtcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjNmJhNWVjO1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NDtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtLjlyZW0pIHNjYWxlKDAuNzUpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgIFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4e1xyXG4gICAgICAgICAgICAgICAgLm1hdC1pY29ue1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiM4ODg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgLmxlYXJuZXJyZWdsc3Rjb250YWluZXJ7XHJcbiAgICAgICAgICAgIC5hdmFpbGFibGUge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwMGE1NTE7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAubm90YXZhaWxhYmxlIHtcclxuICAgICAgICAgICAgICAgIEBleHRlbmQgLmF2YWlsYWJsZTtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICAgICAgLmJvb2tlZCB7XHJcbiAgICAgICAgICAgICAgICBAZXh0ZW5kIC5hdmFpbGFibGU7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5zY2hlZHVsZXRhYmxle1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6MTAwJTtcclxuICAgICAgICAgICAgICAgIC5tYXQtaGVhZGVyLXJvdywgLm1hdC1yb3d7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6MTAwJTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC5tYXQtaGVhZGVyLWNlbGx7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xyXG4gICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgICAgICAgICB3aGl0ZS1zcGFjZTogbm93cmFwO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1hdC1oZWFkZXItY2VsbCwubWF0LWNlbGx7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjIwJTtcclxuICAgICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxkLFxyXG4gICAgICAgICAgICAgICAgICAgICY6bnRoLWNoaWxkKDUpLFxyXG4gICAgICAgICAgICAgICAgICAgICY6bnRoLWNoaWxkKDYpe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBtaW4td2lkdGg6MTAlO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAmOm50aC1jaGlsZCgxMil7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDoxNSU7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICY6bGFzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjEwJTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAjc2VhcmNocm93e1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDojZmZmO1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzo1cHggMDtcclxuICAgICAgICAgICAgICAgIC5zZWFyY2hyb3d7XHJcbiAgICAgICAgICAgICAgICAgICAgJjpsYXN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB2aXNpYmlsaXR5OmhpZGRlbjtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAubWF0LWhlYWRlci1jZWxse1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OjE1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC13cmFwcGVye1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZzowcHg7ICAgICAgICAgICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9ICAgICAgICAgICAgICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5mbGV4YWxpZ250YWd7XHJcbiAgICAgICAgICAgICAgICAmLmZhaWwsICYubmV3LCAmLnlldHRvcGF5e1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAmLnBhc3N7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6IzAwQTU1MTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICYucGFpZHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjojNWZjYzMyO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgJi5wZW5kaW5ne1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiNmNDgxMWY7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgLmJ0bXBhZ2luYXRpb24ge1xyXG4gICAgICAgICAgICAubWFzdGVyYm90dG9tIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE2cHggIWltcG9ydGFudDtcclxuICAgICAgICBcclxuICAgICAgICAgICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOjU2N3B4KSB7XHJcbiAgICAgICAgICAgICAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdyAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLFxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6NTY3cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6MHB4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgZmxleDogYXV0bztcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0gXHJcbiAgICAgICAgLnRvcHBhZ2luYXRpb24ge1xyXG4gICAgICAgICAgICBtYXJnaW4tdG9wOiA4cHg7XHJcbiAgICAgICAgICAgIC5tYXN0ZXJQYWdlVG9we1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOjUwJTtcclxuICAgICAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE1cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGZsZXgtd3JhcDogbm93cmFwO1xyXG4gICAgICAgICAgICAgICAgQG1lZGlhIChtaW4td2lkdGg6IDMyMHB4KSBhbmQgKG1heC13aWR0aDogNDE0cHgpIHtcclxuICAgICAgICAgICAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDIwMHB4KTtcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOjBweDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1uYXZpZ2F0aW9uLXByZXZpb3VzLFxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItbmF2aWdhdGlvbi1uZXh0IHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuc2Nyb2xsZGF0YSB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIHotaW5kZXg6IDE7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICAgICAgICAgIHdpZHRoOiA2cHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNjY2M7XHJcbiAgICAgICAgfVxyXG4gICAgfSAgIFxyXG4gICAgXHJcbn1cclxuXHJcbi5hY3Rpb25tYXRtZW51e1xyXG4gICAgYmFja2dyb3VuZDogIzY2NjtcclxuICAgIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICAgIG1pbi13aWR0aDogMTAwcHg7XHJcbiAgICAubWF0LW1lbnUtY29udGVudHtcclxuICAgICAgICBidXR0b24ubWF0LW1lbnUtaXRlbXtcclxuICAgICAgICAgICAgaGVpZ2h0OjI4cHg7XHJcbiAgICAgICAgICAgIGNvbG9yOiNmZmY7XHJcbiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OjI4cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59IiwiI2xlYXJuZXJyZWdsaXN0IHtcbiAgbWFyZ2luLWJvdHRvbTogNCU7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmhlYWRjb2xvciB7XG4gIGNvbG9yOiAjMEM0QjlBO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5rbm93bGVkZ2VncmlkIHtcbiAgYmFja2dyb3VuZDogI0ZGRkZGRiAwJSAwJSBuby1yZXBlYXQgcGFkZGluZy1ib3g7XG4gIGJveC1zaGFkb3c6IDBweCAwcHggOHB4ICMwMDAwMDAxYTtcbiAgYm9yZGVyOiAxcHggc29saWQgI0Q3RENFMztcbiAgYm9yZGVyLXJhZGl1czogNHB4O1xuICBvcGFjaXR5OiAxO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5rbm93bGVkZ2VncmlkIC5oZWFkY29sb3Ige1xuICBjb2xvcjogIzBDNEI5QTtcbn1cbiNsZWFybmVycmVnbGlzdCAua25vd2xlZGdlZ3JpZCAudGV4dC1ncmF5IHtcbiAgY29sb3I6ICM3MDcwNzA7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmtub3dsZWRnZWdyaWQgLnRleHQtZGVmYXVsdCB7XG4gIGNvbG9yOiAjMjYyNjI2ICFpbXBvcnRhbnQ7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmtub3dsZWRnZWdyaWQgLmJvbGQge1xuICBmb250LXdlaWdodDogNjAwO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIHtcbiAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNEN0RDRTM7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbiNsZWFybmVycmVnbGlzdCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuaGVhZCB7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgaGVpZ2h0OiA0MHB4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIC5ncmFkZSB7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGNvbG9yOiAjODk1QjM3O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5oZWFkIC5nb2xkIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgY29sb3I6ICNCQTk2NjY7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmtub3dsZWRnZWdyaWQgLmRldGFpbHMgLmhlYWQgLnNpbHZlciB7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gIGNvbG9yOiAjQjlCQUJDO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5rbm93bGVkZ2VncmlkIC5kZXRhaWxzIC5hcHBsaWNhdGlvbi1kZXRhaXMge1xuICBib3JkZXI6IDFweCBzb2xpZCAjRDdEQ0UzO1xuICBwYWRkaW5nOiA1cHg7XG4gIG1hcmdpbi10b3A6IDEwcHggIWltcG9ydGFudDtcbn1cbiNsZWFybmVycmVnbGlzdCAua25vd2xlZGdlZ3JpZCAuZGV0YWlscyAuYWN0aW9ubWVudWJ0biB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgdG9wOiAxMHB4O1xuICByaWdodDogMTBweDtcbn1cbiNsZWFybmVycmVnbGlzdCAua25vd2xlZGdlZ3JpZCAuYWRkcmVzcyB7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbn1cbiNsZWFybmVycmVnbGlzdCAua25vd2xlZGdlZ3JpZCAuYWRkcmVzcyAuYWRkLWRldGFpbHMgaSB7XG4gIGNvbG9yOiB0cmFuc3BhcmVudDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS13aWR0aDogMXB4O1xuICAtd2Via2l0LXRleHQtc3Ryb2tlLWNvbG9yOiAjNzA3MDcwO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5rbm93bGVkZ2VncmlkIC5wYXMucGVuZGluZyB7XG4gIGNvbG9yOiAjMEM0QjlBO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5idG5ncm91cCAuc3VibWl0X2J0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgbWluLXdpZHRoOiAxMjBweDtcbiAgaGVpZ2h0OiA0NXB4O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmJ0bmdyb3VwIC5jYW5jZWxidG4ge1xuICBtaW4td2lkdGg6IDEyMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2U4ZThlODtcbiAgY29sb3I6ICMyNjI2MjY7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xuICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5idG5ncm91cCAubWF0LXJhaXNlZC1idXR0b24ge1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLnRhYmZvcmNsaWVudGVsZW5ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIHBhZGRpbmc6IDhweCAwICFpbXBvcnRhbnQ7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLnRhYmZvcmNsaWVudGVsZW5ldyAubWFuYWdlb3B0aW9ucyAubWF0LWljb24ge1xuICBjb2xvcjogI2FjYWNhYztcbn1cbiNsZWFybmVycmVnbGlzdCAubWF0LXJhaXNlZC1idXR0b24ge1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLm1lbnVidG4ge1xuICBtaW4td2lkdGg6IDE3MHB4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5hdWRpdGJ0biB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIG1pbi13aWR0aDogMTIwcHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkN2RjZTM7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmZpbGVsYWJlbCB7XG4gIGZvbnQtc2l6ZTogMTNweDtcbiAgY29sb3I6IHJnYmEoMCwgMCwgMCwgMC42KTtcbiAgbWFyZ2luLWJvdHRvbTogMTBweDtcbn1cbiNsZWFybmVycmVnbGlzdCAuZmlsZWxhYmVsIC5yZXF1aXJlZCB7XG4gIGNvbG9yOiAjZmYwMDAwO1xuICBmb250LXNpemU6IDEzcHg7XG4gIG1hcmdpbi1sZWZ0OiAzcHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGNvbG9yOiAjZDlkOWQ5O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbiNsZWFybmVycmVnbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNsZWFybmVycmVnbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZC5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1pbnB1dC1lbGVtZW50IHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNsZWFybmVycmVnbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0wLjlyZW0pIHNjYWxlKDAuNzUpO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNsZWFybmVycmVnbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNsZWFybmVycmVnbGlzdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5zYXZueHRidG4ge1xuICBib3gtc2hhZG93OiBub25lO1xuICBtaW4td2lkdGg6IDEwMHB4O1xuICBoZWlnaHQ6IDQwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjc7XG4gIGNvbG9yOiAjZmZmO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5wcmV2YnRuIHtcbiAgYm9yZGVyOiAxcHggc29saWQgI2RkZDtcbiAgYmFja2dyb3VuZDogI2ZmZjtcbiAgbWluLXdpZHRoOiAxMDBweDtcbn1cbiNsZWFybmVycmVnbGlzdCAucmVhZG9ubHkge1xuICBib3JkZXI6IDJweCBzb2xpZCAjZWVlO1xuICBiYWNrZ3JvdW5kOiAjZjhmOGY4O1xuICBwYWRkaW5nOiA1cHggOHB4O1xuICBib3JkZXItcmFkaXVzOiAxcHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLnVwbG9hZGVkZG9jIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNsZWFybmVycmVnbGlzdCAudXBsb2FkZWRkb2MgYSB7XG4gIGNvbG9yOiAjNjY2O1xuICBmb250LXNpemU6IDE0cHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmFjdGlvbm1hdG1lbnUge1xuICBiYWNrZ3JvdW5kOiAjNjY2O1xuICBib3JkZXItcmFkaXVzOiAwcHg7XG4gIG1pbi13aWR0aDogMTAwcHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmFjdGlvbm1hdG1lbnUgLm1hdC1tZW51LWNvbnRlbnQgYnV0dG9uLm1hdC1tZW51LWl0ZW0ge1xuICBoZWlnaHQ6IDI4cHg7XG4gIGNvbG9yOiAjZmZmO1xuICBsaW5lLWhlaWdodDogMjhweDtcbn1cbiNsZWFybmVycmVnbGlzdCAudmFsaWRhdGVibHVlYnRuICN2YWxpZG1zZyAudmFsaWRldCB7XG4gIGJhY2tncm91bmQ6ICMwQzRCOUE7XG4gIGNvbG9yOiAjZmZmO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyB7XG4gIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjRDdEQ0UzO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAuYWRkYnRuLCAjbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5maWx0ZXJidG4ge1xuICBtaW4td2lkdGg6IDEwMHB4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAuYWRkYnRuIHtcbiAgYmFja2dyb3VuZDogI2VkMWMyNztcbiAgY29sb3I6ICNmZmY7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5maWx0ZXJidG4ge1xuICBib3gtc2hhZG93OiBub25lO1xuICBib3JkZXI6IDFweCBzb2xpZCAjZGRkO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgY29sb3I6ICNkOWQ5ZDk7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjMGM0YjlhO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjZGM0YzY0O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0wLjlyZW0pIHNjYWxlKDAuNzUpO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xuICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCAubWF0LWljb24ge1xuICBjb2xvcjogIzg4ODtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLmF2YWlsYWJsZSwgI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubGVhcm5lcnJlZ2xzdGNvbnRhaW5lciAuYm9va2VkLCAjbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5ub3RhdmFpbGFibGUge1xuICBjb2xvcjogIzAwYTU1MTtcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5ub3RhdmFpbGFibGUge1xuICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubGVhcm5lcnJlZ2xzdGNvbnRhaW5lciAuYm9va2VkIHtcbiAgY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUge1xuICB3aWR0aDogMTAwJTtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1oZWFkZXItcm93LCAjbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5zY2hlZHVsZXRhYmxlIC5tYXQtcm93IHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5zY2hlZHVsZXRhYmxlIC5tYXQtaGVhZGVyLWNlbGwge1xuICBjb2xvcjogIzYyNjM2NiAhaW1wb3J0YW50O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xuICBmb250LXNpemU6IDE1cHg7XG4gIHdoaXRlLXNwYWNlOiBub3dyYXA7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5zY2hlZHVsZXRhYmxlIC5tYXQtaGVhZGVyLWNlbGwsICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1jZWxsIHtcbiAgbWluLXdpZHRoOiAyMCU7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5zY2hlZHVsZXRhYmxlIC5tYXQtaGVhZGVyLWNlbGw6Zmlyc3QtY2hpbGQsICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1oZWFkZXItY2VsbDpudGgtY2hpbGQoNSksICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1oZWFkZXItY2VsbDpudGgtY2hpbGQoNiksICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1jZWxsOmZpcnN0LWNoaWxkLCAjbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5zY2hlZHVsZXRhYmxlIC5tYXQtY2VsbDpudGgtY2hpbGQoNSksICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1jZWxsOm50aC1jaGlsZCg2KSB7XG4gIG1pbi13aWR0aDogMTAlO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubGVhcm5lcnJlZ2xzdGNvbnRhaW5lciAuc2NoZWR1bGV0YWJsZSAubWF0LWhlYWRlci1jZWxsOm50aC1jaGlsZCgxMiksICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1jZWxsOm50aC1jaGlsZCgxMikge1xuICBtaW4td2lkdGg6IDE1JTtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLnNjaGVkdWxldGFibGUgLm1hdC1oZWFkZXItY2VsbDpsYXN0LWNoaWxkLCAjbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5zY2hlZHVsZXRhYmxlIC5tYXQtY2VsbDpsYXN0LWNoaWxkIHtcbiAgbWluLXdpZHRoOiAxMCU7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5tYXQtc29ydC1oZWFkZXItYXJyb3cge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgI3NlYXJjaHJvdyB7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG4gIHBhZGRpbmc6IDVweCAwO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubGVhcm5lcnJlZ2xzdGNvbnRhaW5lciAjc2VhcmNocm93IC5zZWFyY2hyb3c6bGFzdC1jaGlsZCB7XG4gIHZpc2liaWxpdHk6IGhpZGRlbjtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgI3NlYXJjaHJvdyAubWF0LWhlYWRlci1jZWxsIHtcbiAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubGVhcm5lcnJlZ2xzdGNvbnRhaW5lciAjc2VhcmNocm93IC5tYXQtaGVhZGVyLWNlbGwgLm1hdC1mb3JtLWZpZWxkIHtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgI3NlYXJjaHJvdyAubWF0LWhlYWRlci1jZWxsIC5tYXQtZm9ybS1maWVsZCAubWF0LWZvcm0tZmllbGQtd3JhcHBlciB7XG4gIHBhZGRpbmc6IDBweDtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLmZsZXhhbGlnbnRhZy5mYWlsLCAjbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5mbGV4YWxpZ250YWcubmV3LCAjbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5mbGV4YWxpZ250YWcueWV0dG9wYXkge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmxlYXJuZXJyZWdsc3Rjb250YWluZXIgLmZsZXhhbGlnbnRhZy5wYXNzIHtcbiAgY29sb3I6ICMwMEE1NTE7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5sZWFybmVycmVnbHN0Y29udGFpbmVyIC5mbGV4YWxpZ250YWcucGFpZCB7XG4gIGNvbG9yOiAjNWZjYzMyO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAubGVhcm5lcnJlZ2xzdGNvbnRhaW5lciAuZmxleGFsaWdudGFnLnBlbmRpbmcge1xuICBjb2xvcjogI2Y0ODExZjtcbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmJ0bXBhZ2luYXRpb24gLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gIGZvbnQtc2l6ZTogMTZweCAhaW1wb3J0YW50O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDU2N3B4KSB7XG4gICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmJ0bXBhZ2luYXRpb24gLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICAgIGZsZXgtZGlyZWN0aW9uOiByb3cgIWltcG9ydGFudDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDU2N3B4KSB7XG4gICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLmJ0bXBhZ2luYXRpb24gLm1hc3RlcmJvdHRvbSAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLFxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAuYnRtcGFnaW5hdGlvbiAubWFzdGVyYm90dG9tIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICB9XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5idG1wYWdpbmF0aW9uIC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICBtYXJnaW4tdG9wOiAwcHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC5idG1wYWdpbmF0aW9uIC5tYXN0ZXJib3R0b20gLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIGZsZXg6IGF1dG87XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC50b3BwYWdpbmF0aW9uIHtcbiAgbWFyZ2luLXRvcDogOHB4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAudG9wcGFnaW5hdGlvbiAubWFzdGVyUGFnZVRvcCB7XG4gIG1pbi13aWR0aDogNTAlO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5sZWFybmVycmVnZGV0YWlscyAudG9wcGFnaW5hdGlvbiAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xuICBmbGV4LXdyYXA6IG5vd3JhcDtcbn1cbkBtZWRpYSAobWluLXdpZHRoOiAzMjBweCkgYW5kIChtYXgtd2lkdGg6IDQxNHB4KSB7XG4gICNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLnRvcHBhZ2luYXRpb24gLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgICBmbGV4LWRpcmVjdGlvbjogcm93ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbiNsZWFybmVycmVnbGlzdCAubGVhcm5lcnJlZ2RldGFpbHMgLnRvcHBhZ2luYXRpb24gLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMjAwcHgpO1xuICBtYXJnaW4tdG9wOiAwcHg7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC50b3BwYWdpbmF0aW9uIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLW5hdmlnYXRpb24tcHJldmlvdXMsXG4jbGVhcm5lcnJlZ2xpc3QgLmxlYXJuZXJyZWdkZXRhaWxzIC50b3BwYWdpbmF0aW9uIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLW5hdmlnYXRpb24tbmV4dCB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cbiNsZWFybmVycmVnbGlzdCAuc2Nyb2xsZGF0YSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgei1pbmRleDogMTtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG92ZXJmbG93LXg6IGF1dG87XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xufVxuI2xlYXJuZXJyZWdsaXN0IC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhciB7XG4gIHdpZHRoOiA2cHg7XG4gIGhlaWdodDogNXB4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG4jbGVhcm5lcnJlZ2xpc3QgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI2xlYXJuZXJyZWdsaXN0IC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG59XG5cbi5hY3Rpb25tYXRtZW51IHtcbiAgYmFja2dyb3VuZDogIzY2NjtcbiAgYm9yZGVyLXJhZGl1czogMHB4O1xuICBtaW4td2lkdGg6IDEwMHB4O1xufVxuLmFjdGlvbm1hdG1lbnUgLm1hdC1tZW51LWNvbnRlbnQgYnV0dG9uLm1hdC1tZW51LWl0ZW0ge1xuICBoZWlnaHQ6IDI4cHg7XG4gIGNvbG9yOiAjZmZmO1xuICBsaW5lLWhlaWdodDogMjhweDtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.ts":
/*!*************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.ts ***!
  \*************************************************************************************/
/*! exports provided: MY_FORMATS, LearnerreglistComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MY_FORMATS", function() { return MY_FORMATS; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LearnerreglistComponent", function() { return LearnerreglistComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material-moment-adapter */ "./node_modules/@angular/material-moment-adapter/__ivy_ngcc__/esm2015/material-moment-adapter.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");







const MY_FORMATS = {
    parse: {
        dateInput: 'DD-MM-YYYY',
    },
    display: {
        dateInput: 'DD-MM-YYYY',
        monthYearLabel: 'MMM YYYY',
        dateA11yLabel: 'LL',
        monthYearA11yLabel: 'MMMM YYYY',
    },
};
const LEARNERREG_DATA = [
    { sno: '1', civilno: '10610795', learnername: 'Mohammed Hussain', email: 'muhammed@gmail.com', age: '35', gender: 'Male', theorytutor: 'Taj Ahmed Safar', practltutor: 'Ahmed Safar', assessor: 'Fareeqh Fahad', ivqastaff: 'Zahi Kateeb Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Pending', practicalassessmnt: 'Pending', action: '' },
    { sno: '1', civilno: '10610695', learnername: 'Mohammed Farq', email: 'farq@gmail.com', age: '40', gender: 'Male', theorytutor: 'Syed Ahmed Safar', practltutor: 'Syed Safar', assessor: 'Sayaf Ali', ivqastaff: 'Zahi Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Fail', action: '' },
    { sno: '1', civilno: '10610795', learnername: 'Ahmed Hussain', email: 'ahmed@gmail.com', age: '36', gender: 'Male', theorytutor: 'Ahmed Safar', practltutor: 'Safar Akbar', assessor: 'Fareeqh Fahad', ivqastaff: 'Asiyah Kateeb', feestatus: 'Yet to Pay', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Pass', action: '' },
    { sno: '1', civilno: '10610765', learnername: 'Aktar Hussain', email: 'aktar@gmail.com', age: '35', gender: 'Male', theorytutor: 'Aktar Safar', practltutor: 'Taj Ahmed Safar', assessor: 'Syed Khan', ivqastaff: 'Zahi Kateeb Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Fail', practicalassessmnt: 'Pass', action: '' },
    { sno: '1', civilno: '10610775', learnername: 'Safar Ali', email: 'safar@gmail.com', age: '39', gender: 'Male', theorytutor: 'Safar Akbar', practltutor: 'Noor Safarh', assessor: 'Fareeqh Fahad', ivqastaff: 'Kateeb Asiyah', feestatus: 'Yet to Pay', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Pass', action: '' },
    { sno: '1', civilno: '10610795', learnername: 'Mohammed Taj', email: 'taj@gmail.com', age: '45', gender: 'Male', theorytutor: 'Taj Ahmed Safar', practltutor: 'Aktar Safar', assessor: 'Ibrahm Syed', ivqastaff: 'Ali Asiyah', feestatus: 'Yet to Pay', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Fail', action: '' },
    { sno: '1', civilno: '10610794', learnername: 'Mohammed Noor', email: 'noor@gmail.com', age: '46', gender: 'Male', theorytutor: 'Noor Safar', practltutor: 'Syed Faris Atiyeh', assessor: 'Fareeqh Fahad', ivqastaff: 'Aktar Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Fail', practicalassessmnt: 'Pending', action: '' },
    { sno: '1', civilno: '10610791', learnername: 'Syed Hussain', email: 'syed@gmail.com', age: '34', gender: 'Male', theorytutor: 'Syed Safar', practltutor: 'Sajjad Faris Atiyeh', assessor: 'Fareeqh Fahad', ivqastaff: 'Akbar Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Pending', practicalassessmnt: 'Pass', action: '' },
];
let LearnerreglistComponent = class LearnerreglistComponent {
    constructor(formBuilder) {
        this.formBuilder = formBuilder;
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_4__["ErrorStateMatcher"]();
        this.resultsLength = 0;
        /*civilnosrch: new FormControl('');
        learnernamesrch: new FormControl('');
        emailsrch: new FormControl('');
        agesrch: new FormControl('');
        gendersrch: new FormControl('');
        theorytutorsrch: new FormControl('');
        practltutorsrch: new FormControl('');
        assessorsrch: new FormControl('');
        ivqastaffsrch: new FormControl('');
        feestatussrch: new FormControl('');
        statussrch: new FormControl('');
        knowledgeassessmntsrch: new FormControl('');
        practicalassessmntsrch: new FormControl('');
        actionsrch: new FormControl('');
      
        filterValues = {
        civilnosrch: ' ',
        learnernamesrch: ' ',
        emailsrch: ' ',
        agesrch: ' ',
        gendersrch: ' ',
        theorytutorsrch: ' ',
        practltutorsrch: ' ',
        assessorsrch: ' ',
        ivqastaffsrch: ' ',
        feestatussrch: ' ',
        statussrch: ' ',
        knowledgeassessmntsrch: ' ',
        practicalassessmntsrch: ' ',
        actionsrch: ' '
        };*/
        this.displayedColumns = ['sno', 'civilno', 'learnername', 'email', 'age', 'gender', 'theorytutor', 'practltutor', 'assessor', 'ivqastaff', 'feestatus', 'status', 'knowledgeassessmnt', 'practicalassessmnt', 'action'];
        this.learnerregdataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__["MatTableDataSource"](LEARNERREG_DATA);
    }
    ngOnInit() {
    }
    ngAfterViewInit() {
        this.learnerregdataSource.paginator = this.paginator;
    }
    syncPrimaryPaginator(event) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.paginator.page.emit(event);
    }
    clickEvent() {
        this.hidefilder = !this.hidefilder;
        if (!this.hidefilder) {
            this.filtername = "Show Filter";
            const id = document.getElementById('searchrow');
            id.style.display = 'none';
        }
        else {
            this.filtername = "Hide Filter";
            const id = document.getElementById('searchrow');
            id.style.display = 'flex';
        }
    }
};
LearnerreglistComponent.ctorParameters = () => [
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_paginator__WEBPACK_IMPORTED_MODULE_6__["MatPaginator"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_6__["MatPaginator"])
], LearnerreglistComponent.prototype, "paginator", void 0);
LearnerreglistComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-learnerreglist',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./learnerreglist.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        providers: [
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_4__["DateAdapter"], useClass: _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_3__["MomentDateAdapter"], deps: [_angular_material_core__WEBPACK_IMPORTED_MODULE_4__["MAT_DATE_LOCALE"]] },
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_4__["MAT_DATE_FORMATS"], useValue: MY_FORMATS },
        ],
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./learnerreglist.component.scss */ "./src/app/modules/assessmentreport/learnerreglist/learnerreglist.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"]])
], LearnerreglistComponent);



/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.scss":
/*!***************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.scss ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYXNzZXNzbWVudHJlcG9ydC9sZWFybmVycmVnc3Rybi9sZWFybmVycmVnc3Rybi5jb21wb25lbnQuc2NzcyJ9 */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.ts":
/*!*************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.ts ***!
  \*************************************************************************************/
/*! exports provided: LearnerregstrnComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LearnerregstrnComponent", function() { return LearnerregstrnComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");


let LearnerregstrnComponent = class LearnerregstrnComponent {
    constructor() { }
    ngOnInit() {
    }
};
LearnerregstrnComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-learnerregstrn',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./learnerregstrn.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.html")).default,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./learnerregstrn.component.scss */ "./src/app/modules/assessmentreport/learnerregstrn/learnerregstrn.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [])
], LearnerregstrnComponent);



/***/ }),

/***/ "./src/app/modules/assessmentreport/modal/changecommentmodal.scss":
/*!************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/modal/changecommentmodal.scss ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#commentbox {\n  min-width: 550px;\n  max-width: 550px;\n  height: auto;\n  /* Track */\n  /* Handle */\n  /* Handle on hover */\n}\n#commentbox .mat-icon {\n  cursor: pointer;\n}\n#commentbox .header {\n  padding: 15px 25px;\n}\n#commentbox .mat-divider {\n  width: 100%;\n  margin-left: 0px !important;\n  border-top-width: 1px;\n  border-color: #e8e8e8;\n}\n#commentbox .ck-content {\n  max-height: 110px;\n  font-size: 14px;\n}\n#commentbox .mat-divider-horizontal {\n  position: relative !important;\n}\n#commentbox .txt-gry {\n  color: #848484;\n}\n#commentbox .txt-gry3 {\n  color: #262626;\n}\n#commentbox .content {\n  padding: 15px 25px;\n}\n#commentbox .ckeditorborder {\n  max-height: 216px;\n  overflow: auto;\n  scroll-behavior: smooth;\n  height: auto;\n  border: 1px solid #d9d9d9;\n  cursor: text;\n  padding: 13px 10px;\n}\n#commentbox .ckeditorborder:hover {\n  border: 1px solid #6ba5ec;\n}\n#commentbox .ckeditorborder .editortitle {\n  color: #666;\n  cursor: text;\n}\n#commentbox .ckeditorborder p {\n  margin: 0;\n  padding-bottom: 5px;\n  cursor: text;\n}\n#commentbox .ckeditorborder figure img {\n  max-width: 100%;\n}\n#commentbox .ckeditorborder .contenthere p {\n  margin: 0 !important;\n  padding-bottom: 5px;\n  cursor: text;\n  word-break: break-word;\n}\n#commentbox .clearbutton {\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n}\n#commentbox .cancel_btn {\n  min-width: 120px;\n  background-color: #ffff;\n  border: 1px solid #e8e8e8;\n  color: #262626;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 40px;\n  font-size: 15px;\n  box-shadow: none;\n}\n#commentbox .error {\n  color: #dc4c64;\n}\n#commentbox .mat-raised-button {\n  box-shadow: none;\n  border-radius: 2px;\n  min-width: 90px;\n  font-size: 16px;\n}\n#commentbox ::-webkit-scrollbar {\n  width: 6px;\n}\n#commentbox ::-webkit-scrollbar-track {\n  box-shadow: inset 0 0 5px grey;\n  border-radius: 3px;\n}\n#commentbox ::-webkit-scrollbar-thumb {\n  background: #ED1C27;\n  border-radius: 3px;\n}\n#commentbox ::-webkit-scrollbar-thumb:hover {\n  background: #ED1C27;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-readonly {\n  background-color: #009c3a !important;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#commentbox .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#commentbox .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n.commentfielsmodal .mat-dialog-container {\n  padding: 0px !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L21vZGFsL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFzc2Vzc21lbnRyZXBvcnRcXG1vZGFsXFxjaGFuZ2Vjb21tZW50bW9kYWwuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L21vZGFsL2NoYW5nZWNvbW1lbnRtb2RhbC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0VBQ0ksZ0JBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7RUEwR0EsVUFBQTtFQU1BLFdBQUE7RUFNQSxvQkFBQTtBQ2xISjtBREhFO0VBQ0UsZUFBQTtBQ0tKO0FESEk7RUFDSSxrQkFBQTtBQ0tSO0FEREk7RUFDSSxXQUFBO0VBQ0EsMkJBQUE7RUFDQSxxQkFBQTtFQUNBLHFCQUFBO0FDR1I7QURESTtFQUNJLGlCQUFBO0VBQ0EsZUFBQTtBQ0dSO0FEREk7RUFDSSw2QkFBQTtBQ0dSO0FEQUk7RUFDSSxjQUFBO0FDRVI7QURDSTtFQUNJLGNBQUE7QUNDUjtBREVJO0VBQ0ksa0JBQUE7QUNBUjtBREdJO0VBQ0ksaUJBQUE7RUFDQSxjQUFBO0VBQ0EsdUJBQUE7RUFDQSxZQUFBO0VBQ0EseUJBQUE7RUFDQSxZQUFBO0VBQ0Esa0JBQUE7QUNEUjtBREdRO0VBQ0kseUJBQUE7QUNEWjtBRElRO0VBQ0ksV0FBQTtFQUNBLFlBQUE7QUNGWjtBRE9RO0VBQ0ksU0FBQTtFQUNBLG1CQUFBO0VBQ0EsWUFBQTtBQ0xaO0FEU1k7RUFDSSxlQUFBO0FDUGhCO0FEWVk7RUFDSSxvQkFBQTtFQUNBLG1CQUFBO0VBQ0EsWUFBQTtFQUNBLHNCQUFBO0FDVmhCO0FEY0k7RUFDSSx1QkFBQTtFQUNBLHlCQUFBO0VBQ0EsY0FBQTtBQ1pSO0FEY0k7RUFDSSxnQkFBQTtFQUNBLHVCQUFBO0VBQ0EseUJBQUE7RUFDQSxjQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxlQUFBO0VBQ0EsZ0JBQUE7QUNaUjtBRGVJO0VBQ0ksY0FBQTtBQ2JSO0FEZUk7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7QUNiUjtBRGVJO0VBQ0ksVUFBQTtBQ2JSO0FEaUJJO0VBQ0ksOEJBQUE7RUFDQSxrQkFBQTtBQ2ZSO0FEbUJJO0VBQ0ksbUJBQUE7RUFDQSxrQkFBQTtBQ2pCUjtBRHFCSTtFQUNJLG1CQUFBO0FDbkJSO0FEd0JRO0VBRUksb0NBQUE7QUN2Qlo7QUQ0QlE7RUFDSSxjQUFBO0FDMUJaO0FENkJRO0VBQ0ksMEJBQUE7QUMzQlo7QUQ4QlE7RUFDSSwwQkFBQTtBQzVCWjtBRCtCUTtFQUNJLGNBQUE7QUM3Qlo7QURnQ1E7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUM5Qlo7QURtQ1k7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNqQ2hCO0FEc0NvQjtFQUNJLGNBQUE7QUNwQ3hCO0FEMkNZO0VBQ0kseUJBQUE7QUN6Q2hCO0FEK0NZO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDN0NoQjtBRG1EZ0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUNqRHBCO0FEbURvQjtFQUNJLGNBQUE7QUNqRHhCO0FEcURnQjtFQUNJLHFCQUFBO0FDbkRwQjtBRDJESTtFQUNJLHVCQUFBO0FDeERSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L21vZGFsL2NoYW5nZWNvbW1lbnRtb2RhbC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiI2NvbW1lbnRib3gge1xyXG4gICAgbWluLXdpZHRoOiA1NTBweDtcclxuICAgIG1heC13aWR0aDogNTUwcHg7XHJcbiAgICBoZWlnaHQ6IGF1dG87XHJcbiAgLm1hdC1pY29uIHtcclxuICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICB9XHJcbiAgICAuaGVhZGVyIHtcclxuICAgICAgICBwYWRkaW5nOiAxNXB4IDI1cHg7XHJcblxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZGl2aWRlciB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGJvcmRlci10b3Atd2lkdGg6IDFweDtcclxuICAgICAgICBib3JkZXItY29sb3I6ICNlOGU4ZTg7XHJcbiAgICB9XHJcbiAgICAuY2stY29udGVudCB7XHJcbiAgICAgICAgbWF4LWhlaWdodDogMTEwcHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgfVxyXG4gICAgLm1hdC1kaXZpZGVyLWhvcml6b250YWwge1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC50eHQtZ3J5IHtcclxuICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgIH1cclxuXHJcbiAgICAudHh0LWdyeTMge1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb250ZW50IHtcclxuICAgICAgICBwYWRkaW5nOiAxNXB4IDI1cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNrZWRpdG9yYm9yZGVyIHtcclxuICAgICAgICBtYXgtaGVpZ2h0OiAyMTZweDtcclxuICAgICAgICBvdmVyZmxvdzogYXV0bztcclxuICAgICAgICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcclxuICAgICAgICBoZWlnaHQ6IGF1dG87XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q5ZDlkOTtcclxuICAgICAgICBjdXJzb3I6IHRleHQ7XHJcbiAgICAgICAgcGFkZGluZzogMTNweCAxMHB4O1xyXG5cclxuICAgICAgICAmOmhvdmVyIHtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgIzZiYTVlYztcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5lZGl0b3J0aXRsZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNjY2O1xyXG4gICAgICAgICAgICBjdXJzb3I6IHRleHQ7XHJcblxyXG5cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBtYXJnaW46IDA7XHJcbiAgICAgICAgICAgIHBhZGRpbmctYm90dG9tOiA1cHg7XHJcbiAgICAgICAgICAgIGN1cnNvcjogdGV4dDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGZpZ3VyZSB7XHJcbiAgICAgICAgICAgIGltZyB7XHJcbiAgICAgICAgICAgICAgICBtYXgtd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5jb250ZW50aGVyZSB7XHJcbiAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogNXB4O1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOiB0ZXh0O1xyXG4gICAgICAgICAgICAgICAgd29yZC1icmVhazogYnJlYWstd29yZDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5jbGVhcmJ1dHRvbiB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZmY7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2U4ZThlODtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgIH1cclxuICAgIC5jYW5jZWxfYnRuIHtcclxuICAgICAgICBtaW4td2lkdGg6IDEyMHB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmZmO1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNlOGU4ZTg7XHJcbiAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHg7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogMHB4O1xyXG4gICAgICAgIGhlaWdodDogNDBweDtcclxuICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuXHJcbiAgICB9XHJcbiAgICAuZXJyb3Ige1xyXG4gICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgfVxyXG4gICAgLm1hdC1yYWlzZWQtYnV0dG9uIHtcclxuICAgICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBtaW4td2lkdGg6IDkwcHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNnB4O1xyXG4gICAgfVxyXG4gICAgOjotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICAgICAgd2lkdGg6IDZweDtcclxuICAgIH1cclxuICAgIFxyXG4gICAgLyogVHJhY2sgKi9cclxuICAgIDo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgIGJveC1zaGFkb3c6IGluc2V0IDAgMCA1cHggZ3JleTsgXHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4O1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICAvKiBIYW5kbGUgKi9cclxuICAgIDo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNFRDFDMjc7IFxyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDNweDtcclxuICAgIH1cclxuICAgIFxyXG4gICAgLyogSGFuZGxlIG9uIGhvdmVyICovXHJcbiAgICA6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcclxuICAgICAgICBiYWNrZ3JvdW5kOiAjRUQxQzI3OyBcclxuICAgIH1cclxuICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG5cclxuICAgICAgICAvLyAmLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkge1xyXG4gICAgICAgICAgICAvLyAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDljM2EgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgLy8gfVxyXG4gICAgICAgICAgICAvLyB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICBjb2xvcjogIzZiYTVlYztcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb2N1c2VkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcblxyXG4gICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNkYzRjNjQ7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM4NDg0ODQ7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuXHJcbi5jb21tZW50ZmllbHNtb2RhbCB7XHJcbiAgICAubWF0LWRpYWxvZy1jb250YWluZXIge1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG59IiwiI2NvbW1lbnRib3gge1xuICBtaW4td2lkdGg6IDU1MHB4O1xuICBtYXgtd2lkdGg6IDU1MHB4O1xuICBoZWlnaHQ6IGF1dG87XG4gIC8qIFRyYWNrICovXG4gIC8qIEhhbmRsZSAqL1xuICAvKiBIYW5kbGUgb24gaG92ZXIgKi9cbn1cbiNjb21tZW50Ym94IC5tYXQtaWNvbiB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNjb21tZW50Ym94IC5oZWFkZXIge1xuICBwYWRkaW5nOiAxNXB4IDI1cHg7XG59XG4jY29tbWVudGJveCAubWF0LWRpdmlkZXIge1xuICB3aWR0aDogMTAwJTtcbiAgbWFyZ2luLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICBib3JkZXItdG9wLXdpZHRoOiAxcHg7XG4gIGJvcmRlci1jb2xvcjogI2U4ZThlODtcbn1cbiNjb21tZW50Ym94IC5jay1jb250ZW50IHtcbiAgbWF4LWhlaWdodDogMTEwcHg7XG4gIGZvbnQtc2l6ZTogMTRweDtcbn1cbiNjb21tZW50Ym94IC5tYXQtZGl2aWRlci1ob3Jpem9udGFsIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlICFpbXBvcnRhbnQ7XG59XG4jY29tbWVudGJveCAudHh0LWdyeSB7XG4gIGNvbG9yOiAjODQ4NDg0O1xufVxuI2NvbW1lbnRib3ggLnR4dC1ncnkzIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jY29tbWVudGJveCAuY29udGVudCB7XG4gIHBhZGRpbmc6IDE1cHggMjVweDtcbn1cbiNjb21tZW50Ym94IC5ja2VkaXRvcmJvcmRlciB7XG4gIG1heC1oZWlnaHQ6IDIxNnB4O1xuICBvdmVyZmxvdzogYXV0bztcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG4gIGhlaWdodDogYXV0bztcbiAgYm9yZGVyOiAxcHggc29saWQgI2Q5ZDlkOTtcbiAgY3Vyc29yOiB0ZXh0O1xuICBwYWRkaW5nOiAxM3B4IDEwcHg7XG59XG4jY29tbWVudGJveCAuY2tlZGl0b3Jib3JkZXI6aG92ZXIge1xuICBib3JkZXI6IDFweCBzb2xpZCAjNmJhNWVjO1xufVxuI2NvbW1lbnRib3ggLmNrZWRpdG9yYm9yZGVyIC5lZGl0b3J0aXRsZSB7XG4gIGNvbG9yOiAjNjY2O1xuICBjdXJzb3I6IHRleHQ7XG59XG4jY29tbWVudGJveCAuY2tlZGl0b3Jib3JkZXIgcCB7XG4gIG1hcmdpbjogMDtcbiAgcGFkZGluZy1ib3R0b206IDVweDtcbiAgY3Vyc29yOiB0ZXh0O1xufVxuI2NvbW1lbnRib3ggLmNrZWRpdG9yYm9yZGVyIGZpZ3VyZSBpbWcge1xuICBtYXgtd2lkdGg6IDEwMCU7XG59XG4jY29tbWVudGJveCAuY2tlZGl0b3Jib3JkZXIgLmNvbnRlbnRoZXJlIHAge1xuICBtYXJnaW46IDAgIWltcG9ydGFudDtcbiAgcGFkZGluZy1ib3R0b206IDVweDtcbiAgY3Vyc29yOiB0ZXh0O1xuICB3b3JkLWJyZWFrOiBicmVhay13b3JkO1xufVxuI2NvbW1lbnRib3ggLmNsZWFyYnV0dG9uIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZmY7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNlOGU4ZTg7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI2NvbW1lbnRib3ggLmNhbmNlbF9idG4ge1xuICBtaW4td2lkdGg6IDEyMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2U4ZThlODtcbiAgY29sb3I6ICMyNjI2MjY7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xuICBwYWRkaW5nLXJpZ2h0OiAwcHg7XG4gIGhlaWdodDogNDBweDtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI2NvbW1lbnRib3ggLmVycm9yIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG59XG4jY29tbWVudGJveCAubWF0LXJhaXNlZC1idXR0b24ge1xuICBib3gtc2hhZG93OiBub25lO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIG1pbi13aWR0aDogOTBweDtcbiAgZm9udC1zaXplOiAxNnB4O1xufVxuI2NvbW1lbnRib3ggOjotd2Via2l0LXNjcm9sbGJhciB7XG4gIHdpZHRoOiA2cHg7XG59XG4jY29tbWVudGJveCA6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcbiAgYm94LXNoYWRvdzogaW5zZXQgMCAwIDVweCBncmV5O1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG59XG4jY29tbWVudGJveCA6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZDogI0VEMUMyNztcbiAgYm9yZGVyLXJhZGl1czogM3B4O1xufVxuI2NvbW1lbnRib3ggOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XG4gIGJhY2tncm91bmQ6ICNFRDFDMjc7XG59XG4jY29tbWVudGJveCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLXJlYWRvbmx5IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwOWMzYSAhaW1wb3J0YW50O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGNvbG9yOiAjZDlkOWQ5O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1zdGFydCB7XG4gIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjNmJhNWVjO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjMGM0YjlhO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZC5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jY29tbWVudGJveCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjZGM0YzY0O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2NvbW1lbnRib3ggLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtMC45cmVtKSBzY2FsZSgwLjc1KTtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jY29tbWVudGJveCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNjb21tZW50Ym94IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xuICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XG59XG5cbi5jb21tZW50ZmllbHNtb2RhbCAubWF0LWRpYWxvZy1jb250YWluZXIge1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/modal/changecommentmodal.ts":
/*!**********************************************************************!*\
  !*** ./src/app/modules/assessmentreport/modal/changecommentmodal.ts ***!
  \**********************************************************************/
/*! exports provided: changecommentmodal */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "changecommentmodal", function() { return changecommentmodal; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material/dialog */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
/* harmony import */ var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @app/common/class/encrypt */ "./src/app/common/class/encrypt.ts");
/* harmony import */ var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/common/localstorage/applocalstorage.services */ "./src/app/common/localstorage/applocalstorage.services.ts");
/* harmony import */ var _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @app/modules/registration/registration.service */ "./src/app/modules/registration/registration.service.ts");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var ngx_toastr__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ngx-toastr */ "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
/* harmony import */ var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @ckeditor/ckeditor5-build-classic */ "./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js");
/* harmony import */ var _ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(_ckeditor_ckeditor5_build_classic__WEBPACK_IMPORTED_MODULE_11__);












let changecommentmodal = class changecommentmodal {
    constructor(dialogRef, toastr, security, regService, fb, applocalstorage, translate, remoteService, cookieService, data) {
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
        this.showField4 = true;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = "ltr";
        this.config = {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'blockquote',
                '|',
                'undo',
                'redo',
            ],
            image: {
                toolbar: [
                    'imageStyle:full',
                    'imageStyle:side',
                    'imageStyle:alignLeft',
                    'imageStyle:alignRight',
                    '|',
                    'imageTextAlternative'
                ],
                styles: [
                    // This option is equal to a situation where no style is applied.
                    'full',
                    'side',
                    // This represents an image aligned to the left.
                    'alignLeft',
                    // This represents an image aligned to the right.
                    'alignRight'
                ]
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties',]
            },
            placeholder: "Type the content here!"
        };
        if (data.fieldToShow === 'field1') {
            this.showField1 = true;
        }
        else if (data.fieldToShow === 'field2') {
            this.showField2 = true;
        }
        else if (data.fieldToShow === 'field3') {
            this.showField3 = true;
        }
        else if (data.fieldToShow === 'field4') {
            this.showField4 = true;
        }
    }
    i18n(key) {
        return this.translate.instant(key);
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
                this.translate.setDefaultLang(toSelect.languagecode);
                this.dir = toSelect.dir;
            }
            else {
                const toSelect = this.languagelist.find(c => c.id == '1');
                this.translate.setDefaultLang(toSelect.languagecode);
                this.dir = toSelect.dir;
            }
        });
        this.validForm();
    }
    onChangeeditor(event) {
        this.length_Of_ck = $(this.validationForm.controls['comments'].value).text().length;
        this.comments = $(this.validationForm.controls['comments'].value).text();
        if (this.length_Of_ck > 1000) {
            this.validationForm.setErrors({ 'invalid': true });
            this.validationForm.controls['comments'].setErrors({ 'incorrect': true });
            this.done = true;
        }
    }
    close() {
        this.validationForm.reset();
        this.techinfo = "";
        this.dialogRef.close({ data: true });
        this.validationForm.controls.status.reset();
    }
    resinfo() {
        this.validationForm.controls['comments'].setValue(``);
        this.techinfo = "";
        this.comments = ``;
    }
    validForm() {
        this.validationForm = this.fb.group({
            comments: [''],
            status: ['']
        });
    }
    get f() {
        return this.validationForm.controls;
    }
    editinfo() {
        this.edittechinfo = !this.edittechinfo;
    }
    closeModalPopup() {
        this.dialogRef.close({ data: true });
        this.resinfo();
        this.validationForm.controls.status.reset();
    }
    messagedone() {
        this.addinfo();
        this.editinfo();
        this.done = false;
    }
    addinfo() {
        this.techinfo = this.validationForm.controls['comments'].value;
    }
    submitted() {
        this.resinfo();
        this.dialogRef.close({ data: true });
        this.validationForm.controls.status.reset();
    }
    statusupdatevalue(value) {
        value = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
        if (value == value) {
            this.statustrue = false;
        }
        else {
            // console.log(23456789)
            this.statustrue = true;
        }
    }
};
changecommentmodal.ctorParameters = () => [
    { type: _angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialogRef"] },
    { type: ngx_toastr__WEBPACK_IMPORTED_MODULE_10__["ToastrService"] },
    { type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"] },
    { type: _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_6__["RegistrationService"] },
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] },
    { type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"] },
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"] },
    { type: undefined, decorators: [{ type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"], args: [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MAT_DIALOG_DATA"],] }] }
];
changecommentmodal = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: "changecommentmodal",
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./changecommentmodal.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/modal/changecommentmodal.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./changecommentmodal.scss */ "./src/app/modules/assessmentreport/modal/changecommentmodal.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__param"])(9, Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Inject"])(_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MAT_DIALOG_DATA"])),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_material_dialog__WEBPACK_IMPORTED_MODULE_3__["MatDialogRef"], ngx_toastr__WEBPACK_IMPORTED_MODULE_10__["ToastrService"],
        _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_4__["Encrypt"],
        _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_6__["RegistrationService"],
        _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_5__["AppLocalStorageServices"],
        _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_9__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"], Object])
], changecommentmodal);



/***/ }),

/***/ "./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.scss":
/*!***************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.scss ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#viewandapprove {\n  display: flex;\n  flex-direction: column !important;\n  color: #848484;\n  letter-spacing: normal;\n  font-style: normal;\n  letter-spacing: normal;\n  padding-left: 100px;\n  padding-right: 100px;\n  font-size: 12px;\n}\n#viewandapprove .batchheader {\n  display: flex;\n  border: 1px solid lightgray;\n  width: 100%;\n  padding: 10px 20px;\n  margin-bottom: 20px;\n}\n#viewandapprove .batchheader p {\n  padding: 0px 8px;\n  margin: 6px 0;\n}\n#viewandapprove .batchheader .batchinnerdiv p {\n  border: 1px solid lightgray;\n  margin-left: 10px;\n}\n#viewandapprove .approve {\n  padding: 0px 0px;\n}\n#viewandapprove .approve p {\n  padding: 0px 5px;\n  margin: 2px 0;\n}\n#viewandapprove .approve button.mat-menu-item {\n  width: 50%;\n}\n#viewandapprove .approve .mat-tab-label {\n  opacity: 1;\n  border-radius: 0;\n  background-clip: padding-box;\n  margin-right: 10px;\n  height: 36px;\n  justify-content: flex-start !important;\n}\n#viewandapprove .approve .mat-tab-label.mat-tab-label-active {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n}\n@media (max-width: 800px) {\n  #viewandapprove .approve .mat-tab-label {\n    margin-bottom: 10px;\n  }\n}\n#viewandapprove .just.validatebtn {\n  display: flex;\n  justify-content: end;\n  width: 100%;\n}\n#viewandapprove .just.validatebtn .validet {\n  background-color: #0c4b9a !important;\n  color: #fff !important;\n  height: 45px;\n  min-width: 120px;\n  border: 1px solid #d7dce3;\n  box-shadow: none;\n}\n#viewandapprove .just button {\n  padding: 5px 40px;\n  background-color: #0c4b9a;\n  color: #fff;\n  border-color: #0c4b9a;\n}\n#viewandapprove .topmenu {\n  width: 200%;\n  height: 200%;\n}\n#viewandapprove .filter {\n  box-sizing: content-box;\n}\n#viewandapprove .approveupload {\n  padding: 10px 0px 0px 0px;\n  border-radius: none;\n}\n#viewandapprove .btnwhite {\n  padding: 2px 30px;\n  border-radius: 0px;\n  border: 0.5px solid rgba(218, 211, 211, 0.556);\n  background-color: #fff;\n  color: #000;\n}\n#viewandapprove .mat-hint {\n  font-size: 12px;\n}\n#viewandapprove .uploadapprovereport {\n  display: flex;\n  padding: 10px;\n  border-radius: 0%;\n}\n#viewandapprove .uploadapprovereport .uploadfile .ng-hide {\n  box-sizing: border-box;\n}\n#viewandapprove .approve {\n  padding-top: 28px;\n}\n#viewandapprove .col {\n  color: #979292;\n}\n#viewandapprove .clflex {\n  display: flex;\n}\n#viewandapprove .rwidth {\n  width: 100%;\n}\n#viewandapprove .buttonalign {\n  text-align: right;\n}\n#viewandapprove .colblack {\n  color: #000 !important;\n}\n#viewandapprove .colgreen {\n  color: #00a551 !important;\n}\n#viewandapprove .colred, #viewandapprove .mat-sort-header-arrow {\n  color: #ed1c27 !important;\n}\n#viewandapprove .btnbac {\n  background-color: #f5f5f5;\n  padding: 8px 0px;\n  border-radius: 0%;\n}\n#viewandapprove .btnbac.active {\n  background-color: #0c4b9a !important;\n  color: white;\n}\n#viewandapprove .uploadapprovereport {\n  border: 1px dashed;\n  padding: 10px;\n}\n#viewandapprove .uploadapprovereport button {\n  background-color: #f5f5f5;\n  width: 100%;\n  padding: 10px;\n}\n#viewandapprove .pdfimage {\n  width: 56px;\n}\n#viewandapprove .qualitycheckstatus {\n  border: 1px solid red;\n  padding: 10px 20px;\n  margin: 20px 0px;\n  background-color: #fff8f8;\n}\n#viewandapprove .fpara {\n  color: red;\n  font-weight: 600;\n}\n#viewandapprove .qcinnerf {\n  border-bottom: 1px solid #848484;\n  color: #000;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L3ZpZXdhbmRhcHByb3ZlL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXGFzc2Vzc21lbnRyZXBvcnRcXHZpZXdhbmRhcHByb3ZlXFx2aWV3YW5kYXBwcm92ZS5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L3ZpZXdhbmRhcHByb3ZlL3ZpZXdhbmRhcHByb3ZlLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0VBQ0ksYUFBQTtFQUNBLGlDQUFBO0VBQ0EsY0FBQTtFQUNBLHNCQUFBO0VBQ0Esa0JBQUE7RUFDQSxzQkFBQTtFQUNBLG1CQUFBO0VBQ0Esb0JBQUE7RUFDQSxlQUFBO0FDQ0o7QURHSTtFQUNJLGFBQUE7RUFDQSwyQkFBQTtFQUNBLFdBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0FDRFI7QURFUTtFQUNJLGdCQUFBO0VBQ0EsYUFBQTtBQ0FaO0FER1k7RUFDSSwyQkFBQTtFQUNBLGlCQUFBO0FDRGhCO0FES0k7RUFDSSxnQkFBQTtBQ0hSO0FESVE7RUFDSSxnQkFBQTtFQUNBLGFBQUE7QUNGWjtBREtRO0VBQ0ksVUFBQTtBQ0haO0FEUVE7RUFDSSxVQUFBO0VBQ0EsZ0JBQUE7RUFDQSw0QkFBQTtFQUVBLGtCQUFBO0VBQ0EsWUFBQTtFQUNBLHNDQUFBO0FDUFo7QURRWTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7QUNOaEI7QURRWTtFQVpKO0lBYVEsbUJBQUE7RUNMZDtBQUNGO0FEV0k7RUFDSSxhQUFBO0VBQ0Esb0JBQUE7RUFDQSxXQUFBO0FDVFI7QURXUTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSx5QkFBQTtFQUNBLGdCQUFBO0FDVFo7QURZUTtFQUNRLGlCQUFBO0VBQ1IseUJBQUE7RUFDQSxXQUFBO0VBQ0EscUJBQUE7QUNWUjtBRGFJO0VBQ1ksV0FBQTtFQUNBLFlBQUE7QUNYaEI7QURhRztFQUNDLHVCQUFBO0FDWEo7QURhSTtFQUNJLHlCQUFBO0VBQ0EsbUJBQUE7QUNYUjtBRGFJO0VBQ0ksaUJBQUE7RUFDQSxrQkFBQTtFQUNBLDhDQUFBO0VBQ0Esc0JBQUE7RUFDQSxXQUFBO0FDWFI7QURhSTtFQUNJLGVBQUE7QUNYUjtBRGFJO0VBQ0ksYUFBQTtFQUNBLGFBQUE7RUFDQSxpQkFBQTtBQ1hSO0FEY1k7RUFDSSxzQkFBQTtBQ1poQjtBRG9CRztFQUNDLGlCQUFBO0FDbEJKO0FEb0JJO0VBQ0ksY0FBQTtBQ2xCUjtBRG9CSTtFQUNJLGFBQUE7QUNsQlI7QURvQkk7RUFDSSxXQUFBO0FDbEJSO0FEb0JJO0VBQ0ksaUJBQUE7QUNsQlI7QURvQkk7RUFDSSxzQkFBQTtBQ2xCUjtBRG9CSTtFQUNJLHlCQUFBO0FDbEJSO0FEb0JJO0VBQ0kseUJBQUE7QUNsQlI7QURxQkk7RUFDSSx5QkFBQTtFQUNBLGdCQUFBO0VBQ0EsaUJBQUE7QUNuQlI7QURxQkk7RUFDSSxvQ0FBQTtFQUNBLFlBQUE7QUNuQlI7QURxQkk7RUFDSSxrQkFBQTtFQUNBLGFBQUE7QUNuQlI7QURvQlE7RUFDSSx5QkFBQTtFQUNBLFdBQUE7RUFDQSxhQUFBO0FDbEJaO0FEcUJPO0VBQ0MsV0FBQTtBQ25CUjtBRHNCSTtFQUNJLHFCQUFBO0VBQ0Esa0JBQUE7RUFDQSxnQkFBQTtFQUNBLHlCQUFBO0FDcEJSO0FEdUJJO0VBQ0ksVUFBQTtFQUNBLGdCQUFBO0FDckJSO0FEdUJJO0VBQ0ksZ0NBQUE7RUFDQSxXQUFBO0FDckJSIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L3ZpZXdhbmRhcHByb3ZlL3ZpZXdhbmRhcHByb3ZlLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiI3ZpZXdhbmRhcHByb3Zle1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW4gIWltcG9ydGFudDtcclxuICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgbGV0dGVyLXNwYWNpbmc6IG5vcm1hbDtcclxuICAgIGZvbnQtc3R5bGU6IG5vcm1hbDtcclxuICAgIGxldHRlci1zcGFjaW5nOiBub3JtYWw7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDEwMHB4O1xyXG4gICAgcGFkZGluZy1yaWdodDogMTAwcHg7XHJcbiAgICBmb250LXNpemU6IDEycHg7XHJcblxyXG4gICBcclxuICAgXHJcbiAgICAuYmF0Y2hoZWFkZXJ7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgcGFkZGluZzogMTBweCAyMHB4O1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDIwcHg7XHJcbiAgICAgICAgcCB7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDBweCA4cHg7XHJcbiAgICAgICAgICAgIG1hcmdpbjogNnB4IDA7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5iYXRjaGlubmVyZGl2e1xyXG4gICAgICAgICAgICBwe1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDEwcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuYXBwcm92ZXtcclxuICAgICAgICBwYWRkaW5nOiAwcHggMHB4O1xyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBwYWRkaW5nOiAwcHggNXB4O1xyXG4gICAgICAgICAgICBtYXJnaW46IDJweCAwO1xyXG4gICAgICAgIH1cclxuICAgICAgIFxyXG4gICAgICAgIGJ1dHRvbi5tYXQtbWVudS1pdGVte1xyXG4gICAgICAgICAgICB3aWR0aDogNTAlO1xyXG5cclxuICAgICAgICAgICAgXHJcbiAgICAgICAgfVxyXG4gICAgICBcclxuICAgICAgICAubWF0LXRhYi1sYWJlbCB7XHJcbiAgICAgICAgICAgIG9wYWNpdHk6IDE7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDA7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgICAgICAgLy8gYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDM2cHg7XHJcbiAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50OyAgXHJcbiAgICAgICAgICAgICYubWF0LXRhYi1sYWJlbC1hY3RpdmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBAbWVkaWEgKG1heC13aWR0aDo4MDBweCl7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tYm90dG9tOjEwcHg7XHJcbiAgICAgICAgICAgICB9ICAgXHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgfVxyXG4gICAgXHJcbiAgICBcclxuICAgIC5qdXN0LnZhbGlkYXRlYnRue1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OmVuZDtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuXHJcbiAgICAgICAgLnZhbGlkZXQge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgICAgICAgbWluLXdpZHRoOiAxMjBweDtcclxuICAgICAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2Q3ZGNlMztcclxuICAgICAgICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAgICAgLmp1c3QgYnV0dG9ue1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogNXB4IDQwcHg7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXItY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICBcclxuICAgIC50b3BtZW51e1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDIwMCU7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDIwMCU7XHJcbiAgICAgICAgICAgICB9XHJcbiAgIC5maWx0ZXJ7XHJcbiAgICBib3gtc2l6aW5nOmNvbnRlbnQtYm94O1xyXG4gICB9XHJcbiAgICAuYXBwcm92ZXVwbG9hZHtcclxuICAgICAgICBwYWRkaW5nOiAxMHB4IDBweCAwcHggMHB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IG5vbmU7XHJcbiAgICB9XHJcbiAgICAuYnRud2hpdGV7XHJcbiAgICAgICAgcGFkZGluZzogMnB4IDMwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMHB4O1xyXG4gICAgICAgIGJvcmRlcjogMC41cHggc29saWQgcmdiYSgyMTgsIDIxMSwgMjExLCAwLjU1Nik7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICBjb2xvcjogIzAwMDtcclxuICAgICAgIH1cclxuICAgIC5tYXQtaGludHtcclxuICAgICAgICBmb250LXNpemU6IDEycHg7XHJcbiAgICB9XHJcbiAgICAudXBsb2FkYXBwcm92ZXJlcG9ydHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHBhZGRpbmc6IDEwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMCU7XHJcblxyXG4gICAgICAgIC51cGxvYWRmaWxle1xyXG4gICAgICAgICAgICAubmctaGlkZXtcclxuICAgICAgICAgICAgICAgIGJveC1zaXppbmc6IGJvcmRlci1ib3g7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgXHJcbiAgICB9XHJcbiAgICBcclxuICAgIFxyXG4gICAuYXBwcm92ZXtcclxuICAgIHBhZGRpbmctdG9wOiAyOHB4O1xyXG4gICB9XHJcbiAgICAuY29se1xyXG4gICAgICAgIGNvbG9yOiAjOTc5MjkyO1xyXG4gICAgfVxyXG4gICAgLmNsZmxleHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgfVxyXG4gICAgLnJ3aWR0aHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgIH1cclxuICAgIC5idXR0b25hbGlnbntcclxuICAgICAgICB0ZXh0LWFsaWduOiByaWdodDtcclxuICAgIH1cclxuICAgIC5jb2xibGFja3tcclxuICAgICAgICBjb2xvcjogIzAwMCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmNvbGdyZWVue1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29scmVkLCAubWF0LXNvcnQtaGVhZGVyLWFycm93e1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAgICAgXHJcbiAgICAuYnRuYmFje1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTtcclxuICAgICAgICBwYWRkaW5nOiA4cHggMHB4O1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDAlO1xyXG4gICAgfVxyXG4gICAgLmJ0bmJhYy5hY3RpdmV7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgICAgIGNvbG9yOiB3aGl0ZTtcclxuICAgIH1cclxuICAgIC51cGxvYWRhcHByb3ZlcmVwb3J0e1xyXG4gICAgICAgIGJvcmRlcjogMXB4IGRhc2hlZDtcclxuICAgICAgICBwYWRkaW5nOiAxMHB4O1xyXG4gICAgICAgIGJ1dHRvbntcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNTtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgfVxyXG4gICAgICAgLnBkZmltYWdle1xyXG4gICAgICAgIHdpZHRoOiA1NnB4O1xyXG4gICAgICAgfVxyXG5cclxuICAgIC5xdWFsaXR5Y2hlY2tzdGF0dXMge1xyXG4gICAgICAgIGJvcmRlcjogMXB4IHNvbGlkIHJlZDtcclxuICAgICAgICBwYWRkaW5nOiAxMHB4IDIwcHg7XHJcbiAgICAgICAgbWFyZ2luOiAyMHB4IDBweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmOGY4O1xyXG4gICAgfVxyXG5cclxuICAgIC5mcGFyYXtcclxuICAgICAgICBjb2xvcjogcmVkO1xyXG4gICAgICAgIGZvbnQtd2VpZ2h0OiA2MDA7XHJcbiAgICB9XHJcbiAgICAucWNpbm5lcmZ7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICM4NDg0ODQ7XHJcbiAgICAgICAgY29sb3I6ICMwMDA7XHJcbiAgICB9XHJcbiAgICAgICAgXHJcbn1cclxuXHJcblxyXG5cclxuXHJcbi8vIDo6bmctZGVlcCB7XHJcbi8vICAgICAubWF0LW1lbnUtcGFuZWwubXktY2xhc3Mge1xyXG4vLyAgICAgbWF4LXdpZHRoOiA3MDBweDtcclxuLy8gICAgIHdpZHRoOiA3MDBweDtcclxuLy8gICAgIG1heC1oZWlnaHQ6IDMwMHB4O1xyXG4vLyAgICAgaGVpZ2h0OiAyNzBweDtcclxuLy8gICAgIC5tYXQtbWVudS1jb250ZW50e1xyXG4vLyAgICAgICAgIHBhZGRpbmc6IDMwcHggIWltcG9ydGFudDtcclxuLy8gICAgIH1cclxuLy8gIH1cclxuXHJcbi8vIH1cclxuICAiLCIjdmlld2FuZGFwcHJvdmUge1xuICBkaXNwbGF5OiBmbGV4O1xuICBmbGV4LWRpcmVjdGlvbjogY29sdW1uICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjODQ4NDg0O1xuICBsZXR0ZXItc3BhY2luZzogbm9ybWFsO1xuICBmb250LXN0eWxlOiBub3JtYWw7XG4gIGxldHRlci1zcGFjaW5nOiBub3JtYWw7XG4gIHBhZGRpbmctbGVmdDogMTAwcHg7XG4gIHBhZGRpbmctcmlnaHQ6IDEwMHB4O1xuICBmb250LXNpemU6IDEycHg7XG59XG4jdmlld2FuZGFwcHJvdmUgLmJhdGNoaGVhZGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xuICB3aWR0aDogMTAwJTtcbiAgcGFkZGluZzogMTBweCAyMHB4O1xuICBtYXJnaW4tYm90dG9tOiAyMHB4O1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5iYXRjaGhlYWRlciBwIHtcbiAgcGFkZGluZzogMHB4IDhweDtcbiAgbWFyZ2luOiA2cHggMDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuYmF0Y2hoZWFkZXIgLmJhdGNoaW5uZXJkaXYgcCB7XG4gIGJvcmRlcjogMXB4IHNvbGlkIGxpZ2h0Z3JheTtcbiAgbWFyZ2luLWxlZnQ6IDEwcHg7XG59XG4jdmlld2FuZGFwcHJvdmUgLmFwcHJvdmUge1xuICBwYWRkaW5nOiAwcHggMHB4O1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5hcHByb3ZlIHAge1xuICBwYWRkaW5nOiAwcHggNXB4O1xuICBtYXJnaW46IDJweCAwO1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5hcHByb3ZlIGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcbiAgd2lkdGg6IDUwJTtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuYXBwcm92ZSAubWF0LXRhYi1sYWJlbCB7XG4gIG9wYWNpdHk6IDE7XG4gIGJvcmRlci1yYWRpdXM6IDA7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIG1hcmdpbi1yaWdodDogMTBweDtcbiAgaGVpZ2h0OiAzNnB4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuYXBwcm92ZSAubWF0LXRhYi1sYWJlbC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA4MDBweCkge1xuICAjdmlld2FuZGFwcHJvdmUgLmFwcHJvdmUgLm1hdC10YWItbGFiZWwge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cbn1cbiN2aWV3YW5kYXBwcm92ZSAuanVzdC52YWxpZGF0ZWJ0biB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZW5kO1xuICB3aWR0aDogMTAwJTtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuanVzdC52YWxpZGF0ZWJ0biAudmFsaWRldCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWEgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA0NXB4O1xuICBtaW4td2lkdGg6IDEyMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZDdkY2UzO1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5qdXN0IGJ1dHRvbiB7XG4gIHBhZGRpbmc6IDVweCA0MHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLWNvbG9yOiAjMGM0YjlhO1xufVxuI3ZpZXdhbmRhcHByb3ZlIC50b3BtZW51IHtcbiAgd2lkdGg6IDIwMCU7XG4gIGhlaWdodDogMjAwJTtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuZmlsdGVyIHtcbiAgYm94LXNpemluZzogY29udGVudC1ib3g7XG59XG4jdmlld2FuZGFwcHJvdmUgLmFwcHJvdmV1cGxvYWQge1xuICBwYWRkaW5nOiAxMHB4IDBweCAwcHggMHB4O1xuICBib3JkZXItcmFkaXVzOiBub25lO1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5idG53aGl0ZSB7XG4gIHBhZGRpbmc6IDJweCAzMHB4O1xuICBib3JkZXItcmFkaXVzOiAwcHg7XG4gIGJvcmRlcjogMC41cHggc29saWQgcmdiYSgyMTgsIDIxMSwgMjExLCAwLjU1Nik7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGNvbG9yOiAjMDAwO1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5tYXQtaGludCB7XG4gIGZvbnQtc2l6ZTogMTJweDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAudXBsb2FkYXBwcm92ZXJlcG9ydCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHBhZGRpbmc6IDEwcHg7XG4gIGJvcmRlci1yYWRpdXM6IDAlO1xufVxuI3ZpZXdhbmRhcHByb3ZlIC51cGxvYWRhcHByb3ZlcmVwb3J0IC51cGxvYWRmaWxlIC5uZy1oaWRlIHtcbiAgYm94LXNpemluZzogYm9yZGVyLWJveDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuYXBwcm92ZSB7XG4gIHBhZGRpbmctdG9wOiAyOHB4O1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5jb2wge1xuICBjb2xvcjogIzk3OTI5Mjtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuY2xmbGV4IHtcbiAgZGlzcGxheTogZmxleDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAucndpZHRoIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jdmlld2FuZGFwcHJvdmUgLmJ1dHRvbmFsaWduIHtcbiAgdGV4dC1hbGlnbjogcmlnaHQ7XG59XG4jdmlld2FuZGFwcHJvdmUgLmNvbGJsYWNrIHtcbiAgY29sb3I6ICMwMDAgIWltcG9ydGFudDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuY29sZ3JlZW4ge1xuICBjb2xvcjogIzAwYTU1MSAhaW1wb3J0YW50O1xufVxuI3ZpZXdhbmRhcHByb3ZlIC5jb2xyZWQsICN2aWV3YW5kYXBwcm92ZSAubWF0LXNvcnQtaGVhZGVyLWFycm93IHtcbiAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAuYnRuYmFjIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNTtcbiAgcGFkZGluZzogOHB4IDBweDtcbiAgYm9yZGVyLXJhZGl1czogMCU7XG59XG4jdmlld2FuZGFwcHJvdmUgLmJ0bmJhYy5hY3RpdmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiB3aGl0ZTtcbn1cbiN2aWV3YW5kYXBwcm92ZSAudXBsb2FkYXBwcm92ZXJlcG9ydCB7XG4gIGJvcmRlcjogMXB4IGRhc2hlZDtcbiAgcGFkZGluZzogMTBweDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAudXBsb2FkYXBwcm92ZXJlcG9ydCBidXR0b24ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1O1xuICB3aWR0aDogMTAwJTtcbiAgcGFkZGluZzogMTBweDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAucGRmaW1hZ2Uge1xuICB3aWR0aDogNTZweDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAucXVhbGl0eWNoZWNrc3RhdHVzIHtcbiAgYm9yZGVyOiAxcHggc29saWQgcmVkO1xuICBwYWRkaW5nOiAxMHB4IDIwcHg7XG4gIG1hcmdpbjogMjBweCAwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY4Zjg7XG59XG4jdmlld2FuZGFwcHJvdmUgLmZwYXJhIHtcbiAgY29sb3I6IHJlZDtcbiAgZm9udC13ZWlnaHQ6IDYwMDtcbn1cbiN2aWV3YW5kYXBwcm92ZSAucWNpbm5lcmYge1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgIzg0ODQ4NDtcbiAgY29sb3I6ICMwMDA7XG59Il19 */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.ts":
/*!*************************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.ts ***!
  \*************************************************************************************/
/*! exports provided: ViewandapproveComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ViewandapproveComponent", function() { return ViewandapproveComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/services/assessmentReport.service */ "./src/app/services/assessmentReport.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! sweetalert */ "./node_modules/sweetalert/dist/sweetalert.min.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_5__);







let ViewandapproveComponent = class ViewandapproveComponent {
    constructor(translate, assessmentService, route, router) {
        this.translate = translate;
        this.assessmentService = assessmentService;
        this.route = route;
        this.router = router;
        this.btnactive = false;
        this.assessmentType = 1;
        this.approveType = 1;
        this.assessmentreport = [];
        this.validatebtn = false;
        this.isValidated = false;
        this.onValidation = this.onValidation.bind(this);
    }
    i18n(key) {
        return this.translate.instant(key);
    }
    ngOnInit() {
        this.id = this.route.snapshot.paramMap.get('id');
        this.getlearnerdata(this.id);
        this.getassessmentreport(this.id);
        this.getlearnerstatus();
    }
    getlearnerdata(id) {
        this.assessmentService.getleanerdata(id).subscribe(data => {
            this.learnerData = data.data;
            if (this.learnerData.status == 7) {
                this.validatebtn = true;
            }
            else {
                this.validatebtn = false;
            }
        });
    }
    getassessmentreport(id) {
        this.assessmentService.getassessmentreport(id).subscribe(data => {
            this.assessmentreport = data.data;
            let kreport = this.assessmentreport.filter(item => item.asmtm_InternalAsmt == 1);
            this.kreport = kreport ? kreport[0] : null;
            let preport = this.assessmentreport.filter(item => item.asmtm_InternalAsmt == 2);
            this.preport = preport ? preport[0] : null;
            console.log('this.kreport', this.kreport);
            console.log('this.preport', this.preport);
            if ((this.kreport != null && this.preport != null) || (this.kreport != null && this.preport == null)) {
                this.btnactive = false;
            }
            else {
                this.btnactive = true;
            }
        });
    }
    getlearnerstatus() {
        this.assessmentService.getlearnerstatus().subscribe(data => {
            this.learnerstatus = data.data;
        });
    }
    getstatus(value) {
        let status = this.learnerstatus.filter(item => item.referencemst_pk == value);
        return status[0].rm_name_en;
    }
    changeassessment(type) {
        if (type == 'knowleadge') {
            this.btnactive = false;
        }
        else {
            this.btnactive = true;
        }
    }
    changepop(type) {
        if (type == 'know') {
            this.btnactive = false;
        }
        else {
            this.btnactive = true;
        }
    }
    getassessmentstatus(no) {
        // 1-New, 2-Teaching(theory),3-Teaching(practical),4-No Show(theory),5-No Show(practical), 6-Assessment, 7-Quality Check,8-Declined during Quality Check,9-Resubmitted for Quality Check 10-Print
        if (no == 1) {
            return 'New';
        }
        else if (no == 2) {
            return 'Teaching(theory)';
        }
        else if (no == 3) {
            return 'Teaching(practical)';
        }
        else if (no == 4) {
            return 'No Show(theory)';
        }
        else if (no == 5) {
            return 'No Show(practical)';
        }
        else if (no == 6) {
            return 'Assessment';
        }
        else if (no == 7) {
            return 'Quality Check';
        }
        else if (no == 8) {
            return 'Declined during Quality Check';
        }
        else if (no == 9) {
            return 'Resubmitted for Quality Check';
        }
        else if (no == 10) {
            return 'Print';
        }
        else {
            return '';
        }
    }
    gotolist() {
        this.router.navigate(['candidatemanagement/learnerlist/' + this.learnerData.batchNo]);
    }
    onValidation(form, resetForm) {
        console.log('dsfsdfdsf');
        console.log(resetForm);
        if (resetForm) {
            let data = {
                'learnerPK': this.learnerData.learnerPK,
                'status': form.value.select_valitate,
                'comments': form.value.comments
            };
            console.log('data', data);
            this.assessmentService.savequalitycheckstatus(data).subscribe(res => {
                this.getlearnerdata(this.id);
                this.validatebtn = false;
                sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
                    title: 'Saved successfully',
                    text: " ",
                    icon: 'warning',
                    buttons: [false, "Ok"],
                    dangerMode: true,
                    closeOnClickOutside: false
                }).then(() => {
                    resetForm();
                });
            });
        }
    }
};
ViewandapproveComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_4__["TranslateService"] },
    { type: _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_2__["AssessmentReportService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Boolean)
], ViewandapproveComponent.prototype, "isValidated", void 0);
ViewandapproveComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-viewandapprove',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./viewandapprove.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./viewandapprove.component.scss */ "./src/app/modules/assessmentreport/viewandapprove/viewandapprove.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_4__["TranslateService"], _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_2__["AssessmentReportService"], _angular_router__WEBPACK_IMPORTED_MODULE_3__["ActivatedRoute"],
        _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
], ViewandapproveComponent);



/***/ }),

/***/ "./src/app/modules/assessmentreport/viewlearners/viewlearners.component.scss":
/*!***********************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/viewlearners/viewlearners.component.scss ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#viewlearner {\n  display: flex;\n  flex-direction: column !important;\n  color: #848484;\n  font-size: 14px;\n  font-weight: 400;\n  font-style: normal;\n  letter-spacing: normal;\n  line-height: 22px;\n  text-align: left;\n  font-style: normal;\n  letter-spacing: normal;\n  width: 100%;\n}\n#viewlearner .batchheader {\n  width: 100%;\n  padding-left: 30px;\n}\n#viewlearner .batchdetails {\n  width: 80%;\n  display: flex;\n  border: 1px solid lightgray;\n  padding-left: 10px;\n}\n#viewlearner .batchdetails1 {\n  display: flex;\n  width: 80%;\n  padding: 0px 20px;\n  border: 1px solid lightgray;\n}\n#viewlearner table {\n  width: 100%;\n}\n#viewlearner th.mat-sort-header-sorted {\n  color: black;\n}\n#viewlearner .batchdetails .bor {\n  padding: 0px 10px;\n  border: 1px solid lightgray;\n  margin: 10px 5px;\n}\n#viewlearner .batchdetails p {\n  padding: 0px 8px;\n  margin: 2px 0;\n}\n#viewlearner .batchdetails span {\n  color: #262626;\n}\n#viewlearner .clflex {\n  display: flex;\n}\n#viewlearner .rwidth {\n  width: 100%;\n}\n#viewlearner .batchdetails1innerdiv {\n  padding: 10px 20px 10px 10px;\n}\n#viewlearner .batchdetails1innerdiv p {\n  margin: 0px;\n}\n#viewlearner .fontblack {\n  color: #262626;\n}\n#viewlearner .colgreen {\n  color: #00a551 !important;\n}\n#viewlearner .colorange {\n  color: #f4811f !important;\n}\n#viewlearner .colred, #viewlearner .mat-sort-header-arrow {\n  color: #ed1c27 !important;\n}\n#viewlearner .colpurple {\n  color: #d160d9;\n}\n#viewlearner .batchIcon {\n  height: 10px;\n}\n#viewlearner .leanertable1 {\n  width: 80%;\n  justify-content: space-between;\n}\n#viewlearner .tablemenu button.mat-menu-item {\n  color: #FFF !important;\n}\n#viewlearner .leanertable .leanertable1 .mat-flat-button .mat-button-wrapper i.fa {\n  color: transparent;\n  -webkit-text-stroke-width: 1px;\n  -webkit-text-stroke-color: #fff;\n}\n#viewlearner .toppage {\n  align-items: center;\n}\n#viewlearner .toppage .mat-paginator-container .mat-paginator-range-actions .mat-icon-button.mat-paginator-navigation-previous, #viewlearner .toppage .mat-paginator-container .mat-paginator-range-actions .mat-paginator-navigation-next {\n  display: none !important;\n}\n#viewlearner .footerpaginator .mat-paginator-container {\n  justify-content: flex-start;\n}\n#viewlearner .mat-header-cell {\n  color: #262626;\n  font-size: 14px;\n}\n#viewlearner .serachrow.mat-header-cell:first-of-type {\n  padding: 0px !important;\n}\n#viewlearner .topmenu .mat-menu-panel {\n  background-color: #616161 !important;\n}\n#viewlearner .topmenu .mat-menu-panel button.mat-menu-item {\n  line-height: 36px !important;\n  height: 31px !important;\n  color: #fff !important;\n}\n#viewlearner #batchcontainer .example-container {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#viewlearner .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#viewlearner #searchrow.mat-header-row {\n  background-color: #fff;\n}\n#viewlearner #searchrow .mat-form-field-wrapper {\n  padding-bottom: 0px;\n  width: 126px;\n}\n#viewlearner .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: gray;\n}\n#viewlearner .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#viewlearner .mat-paginator, #viewlearner .mat-paginator-page-size .mat-select-trigger {\n  font-size: 14px;\n}\n#viewlearner .learnerList {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#viewlearner .serachrow {\n  background-color: #fff;\n  padding: 20px;\n  box-sizing: border-box;\n  flex-direction: row;\n}\n.mat-menu-item {\n  line-height: 36px;\n  height: 31px;\n  color: #fff;\n}\n.mat-menu-content {\n  background: #616161 !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L3ZpZXdsZWFybmVycy9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxhc3Nlc3NtZW50cmVwb3J0XFx2aWV3bGVhcm5lcnNcXHZpZXdsZWFybmVycy5jb21wb25lbnQuc2NzcyIsInNyYy9hcHAvbW9kdWxlcy9hc3Nlc3NtZW50cmVwb3J0L3ZpZXdsZWFybmVycy92aWV3bGVhcm5lcnMuY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7RUFDSSxhQUFBO0VBQ0EsaUNBQUE7RUFDQSxjQUFBO0VBQ0EsZUFBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFDQSxzQkFBQTtFQUNBLGlCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLHNCQUFBO0VBQ0EsV0FBQTtBQ0NKO0FEQUk7RUFDSSxXQUFBO0VBQ0Esa0JBQUE7QUNFUjtBREFJO0VBQ0ksVUFBQTtFQUNBLGFBQUE7RUFDQSwyQkFBQTtFQUNBLGtCQUFBO0FDRVI7QURBSTtFQUNJLGFBQUE7RUFDQSxVQUFBO0VBQ0EsaUJBQUE7RUFDQSwyQkFBQTtBQ0VSO0FEQ0k7RUFDSSxXQUFBO0FDQ1I7QURFTTtFQUNFLFlBQUE7QUNBUjtBREdJO0VBQ0ksaUJBQUE7RUFDQSwyQkFBQTtFQUNBLGdCQUFBO0FDRFI7QURHSTtFQUNJLGdCQUFBO0VBQ0EsYUFBQTtBQ0RSO0FER0k7RUFDSSxjQUFBO0FDRFI7QURHSTtFQUNJLGFBQUE7QUNEUjtBREdJO0VBQ0ksV0FBQTtBQ0RSO0FER0k7RUFDSSw0QkFBQTtBQ0RSO0FER0k7RUFDSSxXQUFBO0FDRFI7QURHSTtFQUNJLGNBQUE7QUNEUjtBREdJO0VBQ0kseUJBQUE7QUNEUjtBREdJO0VBQ0kseUJBQUE7QUNEUjtBREdJO0VBQ0kseUJBQUE7QUNEUjtBREdJO0VBQ0ksY0FBQTtBQ0RSO0FER0k7RUFDSSxZQUFBO0FDRFI7QURHSTtFQUNJLFVBQUE7RUFDQSw4QkFBQTtBQ0RSO0FER0k7RUFDSSxzQkFBQTtBQ0RSO0FESUk7RUFLb0Isa0JBQUE7RUFDQSw4QkFBQTtFQUNBLCtCQUFBO0FDTnhCO0FEU0k7RUFDSSxtQkFBQTtBQ1BSO0FEVWdCO0VBQ0ksd0JBQUE7QUNScEI7QURjUTtFQUNJLDJCQUFBO0FDWlo7QURnQkk7RUFDSSxjQUFBO0VBSUEsZUFBQTtBQ2pCUjtBRHdCSTtFQUNJLHVCQUFBO0FDdEJSO0FEaUNRO0VBQ0ksb0NBQUE7QUMvQlo7QURpQ1k7RUFDSSw0QkFBQTtFQUNBLHVCQUFBO0VBQ0Esc0JBQUE7QUMvQmhCO0FEeUNNO0VBQ0Usa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQ3ZDUjtBRHlDSTtFQUNJLHlCQUFBO0VBQ0EseUJBQUE7RUFDQSxlQUFBO0FDdkNSO0FEeUNJO0VBQ0ksc0JBQUE7QUN2Q1I7QUR5Q0k7RUFDSSxtQkFBQTtFQUNBLFlBQUE7QUN2Q1I7QURrRFk7RUFDSSx5QkFBQTtFQUNBLFdBQUE7QUNoRGhCO0FEa0RnQjtFQUNJLHlCQUFBO0FDaERwQjtBRHNESTtFQUNJLGVBQUE7QUNwRFI7QURzREk7RUFDSSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxjQUFBO0VBQ0EsZ0JBQUE7RUFDQSxzQkFBQTtFQUNBLHVCQUFBO0FDcERSO0FEc0RJO0VBQ0ksc0JBQUE7RUFhQyxhQUFBO0VBQ0Esc0JBQUE7RUFDQSxtQkFBQTtBQ2hFVDtBRHFFQTtFQUNJLGlCQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7QUNsRUo7QURvRUE7RUFDSSw4QkFBQTtBQ2pFSiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvYXNzZXNzbWVudHJlcG9ydC92aWV3bGVhcm5lcnMvdmlld2xlYXJuZXJzLmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiI3ZpZXdsZWFybmVye1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW4gIWltcG9ydGFudDtcclxuICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgZm9udC13ZWlnaHQ6IDQwMDtcclxuICAgIGZvbnQtc3R5bGU6IG5vcm1hbDtcclxuICAgIGxldHRlci1zcGFjaW5nOiBub3JtYWw7XHJcbiAgICBsaW5lLWhlaWdodDogMjJweDtcclxuICAgIHRleHQtYWxpZ246IGxlZnQ7XHJcbiAgICBmb250LXN0eWxlOiBub3JtYWw7XHJcbiAgICBsZXR0ZXItc3BhY2luZzogbm9ybWFsO1xyXG4gICAgd2lkdGg6IDEwMCU7XHJcbiAgICAuYmF0Y2hoZWFkZXJ7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAzMHB4O1xyXG4gICAgfVxyXG4gICAgLmJhdGNoZGV0YWlsc3tcclxuICAgICAgICB3aWR0aDogODAlO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgbGlnaHRncmF5O1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMTBweDtcclxuICAgIH1cclxuICAgIC5iYXRjaGRldGFpbHMxe1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgd2lkdGg6IDgwJTtcclxuICAgICAgICBwYWRkaW5nOiAwcHggMjBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcbiAgICAgICBcclxuICAgIH1cclxuICAgIHRhYmxlIHtcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuICAgICAgfVxyXG4gICAgICBcclxuICAgICAgdGgubWF0LXNvcnQtaGVhZGVyLXNvcnRlZCB7XHJcbiAgICAgICAgY29sb3I6IGJsYWNrO1xyXG4gICAgICB9XHJcbiAgICBcclxuICAgIC5iYXRjaGRldGFpbHMgICAuYm9yIHtcclxuICAgICAgICBwYWRkaW5nOiAwcHggMTBweDtcclxuICAgICAgICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDVweDtcclxuICAgIH1cclxuICAgIC5iYXRjaGRldGFpbHMgcCB7XHJcbiAgICAgICAgcGFkZGluZzogMHB4IDhweDtcclxuICAgICAgICBtYXJnaW46IDJweCAwO1xyXG4gICAgfVxyXG4gICAgLmJhdGNoZGV0YWlscyBzcGFuIHtcclxuICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgIH1cclxuICAgIC5jbGZsZXh7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgIH1cclxuICAgIC5yd2lkdGh7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgICAuYmF0Y2hkZXRhaWxzMWlubmVyZGl2e1xyXG4gICAgICAgIHBhZGRpbmc6IDEwcHggMjBweCAxMHB4IDEwcHg7XHJcbiAgICB9XHJcbiAgICAuYmF0Y2hkZXRhaWxzMWlubmVyZGl2IHB7XHJcbiAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICB9XHJcbiAgICAuZm9udGJsYWNre1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG4gICAgLmNvbGdyZWVue1xyXG4gICAgICAgIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29sb3Jhbmdle1xyXG4gICAgICAgIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29scmVkLCAubWF0LXNvcnQtaGVhZGVyLWFycm93e1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuY29scHVycGxle1xyXG4gICAgICAgIGNvbG9yOiAjZDE2MGQ5O1xyXG4gICAgfVxyXG4gICAgLmJhdGNoSWNvbntcclxuICAgICAgICBoZWlnaHQ6IDEwcHg7XHJcbiAgICB9XHJcbiAgICAubGVhbmVydGFibGUxe1xyXG4gICAgICAgIHdpZHRoOiA4MCU7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuOyAgIFxyXG4gICAgfVxyXG4gICAgLnRhYmxlbWVudSBidXR0b24ubWF0LW1lbnUtaXRlbSB7XHJcbiAgICAgICAgY29sb3I6ICNGRkYgIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgXHJcbiAgICAubGVhbmVydGFibGVcclxuICAgICAgICAubGVhbmVydGFibGUxXHJcbiAgICAgICAgICAgIC5tYXQtZmxhdC1idXR0b25cclxuICAgICAgICAgICAgICAgIC5tYXQtYnV0dG9uLXdyYXBwZXJcclxuICAgICAgICAgICAgICAgICAgICBpLmZhIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IHRyYW5zcGFyZW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAtd2Via2l0LXRleHQtc3Ryb2tlLXdpZHRoOiAxcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC13ZWJraXQtdGV4dC1zdHJva2UtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG5cclxuICAgIC50b3BwYWdle1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVye1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25ze1xyXG4gICAgICAgICAgICAgICAgLm1hdC1pY29uLWJ1dHRvbi5tYXQtcGFnaW5hdG9yLW5hdmlnYXRpb24tcHJldmlvdXMsIC5tYXQtcGFnaW5hdG9yLW5hdmlnYXRpb24tbmV4dHtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAuZm9vdGVycGFnaW5hdG9ye1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lcntcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG5cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAubWF0LWhlYWRlci1jZWxse1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIC8vIG1pbi13aWR0aDogMTAwcHg7XHJcbiAgICAgICAgLy8gbWF4LXdpZHRoOiAxMDBweDtcclxuICAgICAgIC8vIG1hcmdpbjogMHB4IDEwcHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNHB4OyBcclxuICAgIH0gXHJcbiAgICBcclxuICAgIC5zZXJhY2hyb3cubWF0LWhlYWRlci1jZWxse1xyXG4gICAgICAgLy9tYXJnaW46IDBweCAxMHB4O1xyXG4gICAgICAgXHJcbiAgICB9IFxyXG4gICAgLnNlcmFjaHJvdy5tYXQtaGVhZGVyLWNlbGw6Zmlyc3Qtb2YtdHlwZXtcclxuICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC8vIC5tYXQtaGVhZGVyLWNlbGwuZXh3aWQsIC5zZXJhY2hyb3cubWF0LWhlYWRlci1jZWxsLmV4d2lke1xyXG4gICAgLy8gICAgIG1pbi13aWR0aDogMTcwcHg7XHJcbiAgICAvLyAgICAgbWF4LXdpZHRoOiAxNzBweDtcclxuICAgIC8vIH1cclxuICAgIC8vIC5tYXQtaGVhZGVyLWNlbGw6Zmlyc3Qtb2YtdHlwZXtcclxuICAgIC8vICAgICBtaW4td2lkdGg6IDYwcHg7XHJcbiAgICAvLyAgICAgbWF4LXdpZHRoOiA2MHB4O1xyXG4gICAgLy8gfVxyXG4gICAgLnRvcG1lbnV7XHJcbiAgICAgICAgLm1hdC1tZW51LXBhbmVse1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNjE2MTYxICFpbXBvcnRhbnQ7XHJcbiAgICAgICBcclxuICAgICAgICAgICAgYnV0dG9uLm1hdC1tZW51LWl0ZW17XHJcbiAgICAgICAgICAgICAgICBsaW5lLWhlaWdodDogMzZweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAzMXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSAgXHJcblxyXG4gICAgLy8gLmV4YW1wbGUtY29udGFpbmVyIHtcclxuICAgIC8vICAgICB3aWR0aDogMTIzMHB4O1xyXG4gICAgLy8gICAgIG1heC13aWR0aDogMTAwJTtcclxuICAgIC8vICAgICBvdmVyZmxvdzogYXV0bztcclxuICAgIC8vICAgfVxyXG4gICAgICAjYmF0Y2hjb250YWluZXIgLmV4YW1wbGUtY29udGFpbmVyIHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgei1pbmRleDogMTtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XHJcbiAgICB9XHJcbiAgICAubWF0LWhlYWRlci1jZWxse1xyXG4gICAgICAgIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICB9XHJcbiAgICAjc2VhcmNocm93Lm1hdC1oZWFkZXItcm93e1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICB9XHJcbiAgICAjc2VhcmNocm93IC5tYXQtZm9ybS1maWVsZC13cmFwcGVye1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAwcHg7XHJcbiAgICAgICAgd2lkdGg6MTI2cHg7XHJcbiAgICAgICAgLy8gYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gICAgICAgIC8vIGJvcmRlci1zcGFjaW5nOiA1cHg7XHJcbiAgICAgICAgLy8gYm9yZGVyLWNvbGxhcHNlOiBzZXBhcmF0ZTtcclxuICAgICAgICAvLyBib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7XHJcbiAgICAgICAgLy8gbWFyZ2luOiAxcmVtIGF1dG87XHJcbiAgICAgICAgLy8gYm9yZGVyIDogM3B4O1xyXG4gICAgfVxyXG4gICAgLmZvb3RlcnBhZ2luYXRvciB7XHJcbiAgICAgICAgXHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIHtcclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6IGdyYXk7XHJcblxyXG4gICAgICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcblxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgLm1hdC1wYWdpbmF0b3IsIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZSAubWF0LXNlbGVjdC10cmlnZ2Vye1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMTRweDtcclxuICAgIH1cclxuICAgIC5sZWFybmVyTGlzdHtcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgei1pbmRleDogMTtcclxuICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XHJcbiAgICB9XHJcbiAgICAuc2VyYWNocm93e1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgLy8gLy8gcGFkZGluZzogMHB4IDE1cHg7XHJcbiAgICAgICAgLy8gYmFja2dyb3VuZDojZmZmO1xyXG4gICAgICAgIC8vICBmbGV4OiAxIDEgMTYwcHg7XHJcbiAgICAgICAgLy8gLy8gbWluLWhlaWdodDogNzNweDtcclxuICAgICAgICAvLyAvLyBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIC8vIHBhZGRpbmc6MCBscHggIWltcG9ydGFudDtcclxuICAgICAgICAvLyBwYWRkaW5nLXRvcDogMC40ZW07XHJcbiAgICAgICAgLy8gd2lkdGg6IDE4MHB4O1xyXG4gICAgICAgIFxyXG4gICAgICAgIC8vIG1heC13aWR0aDogMTYwcHg7XHJcbiAgICAgICAgLy8gIG1pbi13aWR0aDogMTYwcHg7IFxyXG4gICAgICAgIC8vIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgcGFkZGluZzogMjBweDtcclxuICAgICAgICAgYm94LXNpemluZzogYm9yZGVyLWJveDtcclxuICAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdztcclxuICAgIH1cclxufVxyXG5cclxuXHJcbi5tYXQtbWVudS1pdGVtIHtcclxuICAgIGxpbmUtaGVpZ2h0OiAzNnB4O1xyXG4gICAgaGVpZ2h0OiAzMXB4O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbn1cclxuLm1hdC1tZW51LWNvbnRlbnR7XHJcbiAgICBiYWNrZ3JvdW5kOiAjNjE2MTYxICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbiIsIiN2aWV3bGVhcm5lciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGZsZXgtZGlyZWN0aW9uOiBjb2x1bW4gIWltcG9ydGFudDtcbiAgY29sb3I6ICM4NDg0ODQ7XG4gIGZvbnQtc2l6ZTogMTRweDtcbiAgZm9udC13ZWlnaHQ6IDQwMDtcbiAgZm9udC1zdHlsZTogbm9ybWFsO1xuICBsZXR0ZXItc3BhY2luZzogbm9ybWFsO1xuICBsaW5lLWhlaWdodDogMjJweDtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbiAgZm9udC1zdHlsZTogbm9ybWFsO1xuICBsZXR0ZXItc3BhY2luZzogbm9ybWFsO1xuICB3aWR0aDogMTAwJTtcbn1cbiN2aWV3bGVhcm5lciAuYmF0Y2hoZWFkZXIge1xuICB3aWR0aDogMTAwJTtcbiAgcGFkZGluZy1sZWZ0OiAzMHB4O1xufVxuI3ZpZXdsZWFybmVyIC5iYXRjaGRldGFpbHMge1xuICB3aWR0aDogODAlO1xuICBkaXNwbGF5OiBmbGV4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG4gIHBhZGRpbmctbGVmdDogMTBweDtcbn1cbiN2aWV3bGVhcm5lciAuYmF0Y2hkZXRhaWxzMSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHdpZHRoOiA4MCU7XG4gIHBhZGRpbmc6IDBweCAyMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG59XG4jdmlld2xlYXJuZXIgdGFibGUge1xuICB3aWR0aDogMTAwJTtcbn1cbiN2aWV3bGVhcm5lciB0aC5tYXQtc29ydC1oZWFkZXItc29ydGVkIHtcbiAgY29sb3I6IGJsYWNrO1xufVxuI3ZpZXdsZWFybmVyIC5iYXRjaGRldGFpbHMgLmJvciB7XG4gIHBhZGRpbmc6IDBweCAxMHB4O1xuICBib3JkZXI6IDFweCBzb2xpZCBsaWdodGdyYXk7XG4gIG1hcmdpbjogMTBweCA1cHg7XG59XG4jdmlld2xlYXJuZXIgLmJhdGNoZGV0YWlscyBwIHtcbiAgcGFkZGluZzogMHB4IDhweDtcbiAgbWFyZ2luOiAycHggMDtcbn1cbiN2aWV3bGVhcm5lciAuYmF0Y2hkZXRhaWxzIHNwYW4ge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiN2aWV3bGVhcm5lciAuY2xmbGV4IHtcbiAgZGlzcGxheTogZmxleDtcbn1cbiN2aWV3bGVhcm5lciAucndpZHRoIHtcbiAgd2lkdGg6IDEwMCU7XG59XG4jdmlld2xlYXJuZXIgLmJhdGNoZGV0YWlsczFpbm5lcmRpdiB7XG4gIHBhZGRpbmc6IDEwcHggMjBweCAxMHB4IDEwcHg7XG59XG4jdmlld2xlYXJuZXIgLmJhdGNoZGV0YWlsczFpbm5lcmRpdiBwIHtcbiAgbWFyZ2luOiAwcHg7XG59XG4jdmlld2xlYXJuZXIgLmZvbnRibGFjayB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI3ZpZXdsZWFybmVyIC5jb2xncmVlbiB7XG4gIGNvbG9yOiAjMDBhNTUxICFpbXBvcnRhbnQ7XG59XG4jdmlld2xlYXJuZXIgLmNvbG9yYW5nZSB7XG4gIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XG59XG4jdmlld2xlYXJuZXIgLmNvbHJlZCwgI3ZpZXdsZWFybmVyIC5tYXQtc29ydC1oZWFkZXItYXJyb3cge1xuICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xufVxuI3ZpZXdsZWFybmVyIC5jb2xwdXJwbGUge1xuICBjb2xvcjogI2QxNjBkOTtcbn1cbiN2aWV3bGVhcm5lciAuYmF0Y2hJY29uIHtcbiAgaGVpZ2h0OiAxMHB4O1xufVxuI3ZpZXdsZWFybmVyIC5sZWFuZXJ0YWJsZTEge1xuICB3aWR0aDogODAlO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG59XG4jdmlld2xlYXJuZXIgLnRhYmxlbWVudSBidXR0b24ubWF0LW1lbnUtaXRlbSB7XG4gIGNvbG9yOiAjRkZGICFpbXBvcnRhbnQ7XG59XG4jdmlld2xlYXJuZXIgLmxlYW5lcnRhYmxlIC5sZWFuZXJ0YWJsZTEgLm1hdC1mbGF0LWJ1dHRvbiAubWF0LWJ1dHRvbi13cmFwcGVyIGkuZmEge1xuICBjb2xvcjogdHJhbnNwYXJlbnQ7XG4gIC13ZWJraXQtdGV4dC1zdHJva2Utd2lkdGg6IDFweDtcbiAgLXdlYmtpdC10ZXh0LXN0cm9rZS1jb2xvcjogI2ZmZjtcbn1cbiN2aWV3bGVhcm5lciAudG9wcGFnZSB7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jdmlld2xlYXJuZXIgLnRvcHBhZ2UgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgLm1hdC1pY29uLWJ1dHRvbi5tYXQtcGFnaW5hdG9yLW5hdmlnYXRpb24tcHJldmlvdXMsICN2aWV3bGVhcm5lciAudG9wcGFnZSAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1uYXZpZ2F0aW9uLW5leHQge1xuICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XG59XG4jdmlld2xlYXJuZXIgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG59XG4jdmlld2xlYXJuZXIgLm1hdC1oZWFkZXItY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xuICBmb250LXNpemU6IDE0cHg7XG59XG4jdmlld2xlYXJuZXIgLnNlcmFjaHJvdy5tYXQtaGVhZGVyLWNlbGw6Zmlyc3Qtb2YtdHlwZSB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuI3ZpZXdsZWFybmVyIC50b3BtZW51IC5tYXQtbWVudS1wYW5lbCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICM2MTYxNjEgIWltcG9ydGFudDtcbn1cbiN2aWV3bGVhcm5lciAudG9wbWVudSAubWF0LW1lbnUtcGFuZWwgYnV0dG9uLm1hdC1tZW51LWl0ZW0ge1xuICBsaW5lLWhlaWdodDogMzZweCAhaW1wb3J0YW50O1xuICBoZWlnaHQ6IDMxcHggIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbn1cbiN2aWV3bGVhcm5lciAjYmF0Y2hjb250YWluZXIgLmV4YW1wbGUtY29udGFpbmVyIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAxO1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG59XG4jdmlld2xlYXJuZXIgLm1hdC1oZWFkZXItY2VsbCB7XG4gIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiN2aWV3bGVhcm5lciAjc2VhcmNocm93Lm1hdC1oZWFkZXItcm93IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbn1cbiN2aWV3bGVhcm5lciAjc2VhcmNocm93IC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcbiAgcGFkZGluZy1ib3R0b206IDBweDtcbiAgd2lkdGg6IDEyNnB4O1xufVxuI3ZpZXdsZWFybmVyIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xuICBjb2xvcjogZ3JheTtcbn1cbiN2aWV3bGVhcm5lciAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbn1cbiN2aWV3bGVhcm5lciAubWF0LXBhZ2luYXRvciwgI3ZpZXdsZWFybmVyIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZSAubWF0LXNlbGVjdC10cmlnZ2VyIHtcbiAgZm9udC1zaXplOiAxNHB4O1xufVxuI3ZpZXdsZWFybmVyIC5sZWFybmVyTGlzdCB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgei1pbmRleDogMTtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG92ZXJmbG93LXg6IGF1dG87XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xufVxuI3ZpZXdsZWFybmVyIC5zZXJhY2hyb3cge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBwYWRkaW5nOiAyMHB4O1xuICBib3gtc2l6aW5nOiBib3JkZXItYm94O1xuICBmbGV4LWRpcmVjdGlvbjogcm93O1xufVxuXG4ubWF0LW1lbnUtaXRlbSB7XG4gIGxpbmUtaGVpZ2h0OiAzNnB4O1xuICBoZWlnaHQ6IDMxcHg7XG4gIGNvbG9yOiAjZmZmO1xufVxuXG4ubWF0LW1lbnUtY29udGVudCB7XG4gIGJhY2tncm91bmQ6ICM2MTYxNjEgIWltcG9ydGFudDtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/assessmentreport/viewlearners/viewlearners.component.ts":
/*!*********************************************************************************!*\
  !*** ./src/app/modules/assessmentreport/viewlearners/viewlearners.component.ts ***!
  \*********************************************************************************/
/*! exports provided: ViewlearnersComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ViewlearnersComponent", function() { return ViewlearnersComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
/* harmony import */ var _angular_cdk_collections__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/cdk/collections */ "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/collections.js");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @app/services/assessmentReport.service */ "./src/app/services/assessmentReport.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");









const ELEMENT_DATA = [
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Completed', knowledgeAssessment: 'Pass', practicalAssessment: 'Pass' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Completed', knowledgeAssessment: 'Fail', practicalAssessment: 'Pass' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Completed', knowledgeAssessment: 'Pass', practicalAssessment: 'Fail' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Competent' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Non-Competent' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Retake Assessment', knowledgeAssessment: 'Fail', practicalAssessment: 'Fail' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
    { civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender: 'Male', status: 'Assessment', knowledgeAssessment: 'Pending', practicalAssessment: 'Pending' },
];
let ViewlearnersComponent = class ViewlearnersComponent {
    constructor(translate, assessmentService, route) {
        this.translate = translate;
        this.assessmentService = assessmentService;
        this.route = route;
        this.displayedColumns = ['select', 'civilNumber', 'learnerName', 'emailID', 'age', 'gender', 'status', 'knowledgeAssessment', 'practicalAssessment', 'Action'];
        this.dataSource = new _angular_material_table__WEBPACK_IMPORTED_MODULE_3__["MatTableDataSource"](ELEMENT_DATA);
        this.selection = new _angular_cdk_collections__WEBPACK_IMPORTED_MODULE_5__["SelectionModel"](true, []);
        this.actionOption = ['Update Assessment Report', 'Retake Assessment', 'View Card', 'Print Card', 'View & Approve'];
        this.page = 5;
        this.showfilter = false;
        this.hidefilder = true;
        this.filtername = "Hide Filter";
        this.resultsLength = 0;
    }
    i18n(key) {
        return this.translate.instant(key);
    }
    ngOnInit() {
        this.id = this.route.snapshot.paramMap.get('id');
        this.getbatchdtls(this.id);
        this.getleanersdtls(this.id);
    }
    ngAfterViewInit() {
        this.dataSource.paginator = this.paginator;
        this.dataSource.sort = this.sort;
    }
    getbatchdtls(id) {
        this.assessmentService.getbatchdtls(id).subscribe(data => {
            this.batchdata_data = data.data.data;
            console.log(this.batchdata_data);
        });
    }
    getleanersdtls(id) {
        this.assessmentService.getleanersdtls(id).subscribe(data => {
            this.leanerdata_data = data.data.data;
            console.log(this.leanerdata_data);
        });
    }
    clickEvent() {
        this.hidefilder = !this.hidefilder;
        if (!this.hidefilder) {
            this.filtername = this.i18n('course.showfilt');
            const id = document.getElementById('searchrow');
            id.style.display = 'none';
        }
        else {
            this.filtername = this.i18n('course.hidefilt');
            const id = document.getElementById('searchrow');
            id.style.display = 'flex';
        }
    }
    syncPrimaryPaginator(event) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.page = event.pageSize;
    }
    filter() {
        this.showfilter = !this.showfilter;
    }
    /** Whether the number of selected elements matches the total number of rows. */
    isAllSelected() {
        const numSelected = this.selection.selected.length;
        const numRows = this.dataSource.data.length;
        return numSelected === numRows;
    }
    /** Selects all rows if they are not all selected; otherwise clear selection. */
    toggleAllRows() {
        if (this.isAllSelected()) {
            this.selection.clear();
            return;
        }
        this.selection.select(...this.dataSource.data);
    }
    /** The label for the checkbox on the passed row */
    checkboxLabel(row) {
        if (!row) {
            return `${this.isAllSelected() ? 'deselect' : 'select'} all`;
        }
        return `${this.selection.isSelected(row) ? 'deselect' : 'select'} row ${row.civilNumber + 1}`;
    }
    getassessmentstatus(no) {
        //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
        if (no == 1) {
            return 'New';
        }
        else if (no == 2) {
            return 'Teaching(theory)';
        }
        else if (no == 3) {
            return 'Teaching(practical)';
        }
        else if (no == 4) {
            return 'Assessment';
        }
        else if (no == 5) {
            return 'Requested for Back Track';
        }
        else if (no == 6) {
            return 'Quality Check';
        }
        else if (no == 7) {
            return 'Cancelled';
        }
        else if (no == 8) {
            return 'Print';
        }
        else if (no == 9) {
            return 'Requested for Assessor change';
        }
        else {
            return '';
        }
    }
};
ViewlearnersComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"] },
    { type: _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_7__["AssessmentReportService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_8__["ActivatedRoute"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_2__["MatPaginator"])
], ViewlearnersComponent.prototype, "paginator", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_4__["MatSort"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_4__["MatSort"])
], ViewlearnersComponent.prototype, "sort", void 0);
ViewlearnersComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-viewlearners',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./viewlearners.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/assessmentreport/viewlearners/viewlearners.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./viewlearners.component.scss */ "./src/app/modules/assessmentreport/viewlearners/viewlearners.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"], _app_services_assessmentReport_service__WEBPACK_IMPORTED_MODULE_7__["AssessmentReportService"], _angular_router__WEBPACK_IMPORTED_MODULE_8__["ActivatedRoute"]])
], ViewlearnersComponent);



/***/ }),

/***/ "./src/app/services/learnerfeedback.service.ts":
/*!*****************************************************!*\
  !*** ./src/app/services/learnerfeedback.service.ts ***!
  \*****************************************************/
/*! exports provided: LearnerFeedbackService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LearnerFeedbackService", function() { return LearnerFeedbackService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");



let LearnerFeedbackService = class LearnerFeedbackService {
    constructor(http) {
        this.http = http;
        this._url = 'lf/learnerfeedback/';
    }
    getlearnerfeedbackquestion(learnerId) {
        return this.http.get(this._url + 'getfeedbackquestion?learnerId=' + learnerId).map(res => res.json());
    }
    savefeedbackquestion(data) {
        return this.http.post(this._url + 'savefeedbackquestion', data).map(res => res.json());
    }
    getfeedbackquestionanswer(learnerId) {
        return this.http.get(this._url + 'getfeedbackquestionanswer?learnerid=' + learnerId).map(res => res.json());
    }
};
LearnerFeedbackService.ctorParameters = () => [
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"] }
];
LearnerFeedbackService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
        providedIn: 'root'
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]])
], LearnerFeedbackService);



/***/ })

}]);
//# sourceMappingURL=modules-assessmentreport-assessmentreport-module-es2015.js.map