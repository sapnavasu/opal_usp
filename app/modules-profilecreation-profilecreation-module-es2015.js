(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-profilecreation-profilecreation-module"],{

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.html":
/*!**************************************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.html ***!
  \**************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"m-t-0 p-b-0\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\" selectproductheaderwithclose\">\r\n    <div class=\"titletext\">\r\n      <div class=\"closeandadd\">\r\n        <i mat-button matTooltip=\"{{'mapcommunicte.clos' | translate}}\" aria-label=\"Displays a tooltip\" matTooltipClass=\"custom-tooltip\"\r\n          (click)=\"mappingAlert()\" class=\"bgi bgi-close p-l-5 fs-14\"></i>\r\n        <h5 class=\"m-0 p-l-20 tt\">{{'mapcommunicte.mapcommunicte' | translate}}<i class=\"bgi bgi-info\"\r\n            (click)=\"mapcommincatelistview('mappinglistview')\"></i></h5>\r\n      </div>\r\n      <div class=\"clearandaddbutton\">\r\n        <button type=\"button\" [disabled]=\"!addressmap.value\" (click)=\"clearformadd()\" mat-raised-button color=\"primary\"\r\n          class=\"clearbutton height-35 m-r-10 p-l-20 p-r-20\">{{'mapcommunicte.clea' | translate}}</button>\r\n        <button color=\"preview\" [disabled]=\"!addressmap.valid\" (click)=\"onSubmitcommunicadd(buttonname)\" type=\"submit\" mat-raised-button ngClass.xs=\" m-r-15\" ngClass.sm=\" m-r-15\"\r\n          class=\"addbutton height-35 p-l-20 p-r-20\">{{buttonname}}</button>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\" class=\"p-t-0 mappinglistview\" [@slideInOut]=\"animationState3\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\">\r\n    <mat-card class=\"headerinformationtext sidenavinfotext m-r-0\">\r\n      <mat-card-header>\r\n        <div class=\"titletext\" fxFlex.xs=\"100\" fxFlex.sm=\"80\" fxFlex.md=\"100\" fxFlex.lg=\"100\" fxFlex.xl=\"100\">\r\n          <mat-card-subtitle class=\"informationtext fs-14\">\r\n            {{'mapcommunicte.selethecommu' | translate}} \r\n          </mat-card-subtitle>\r\n        </div>\r\n        <div class=\"selectforward m-r-0\">\r\n          <div class=\"p-l-15 gotit\">\r\n            <span (click)=\"mapcommincatelistview('mappinglistview')\" mat-raised-button\r\n              color=\"primary\">{{'mapcommunicte.okgotit' | translate}} </span>\r\n          </div>\r\n        </div>\r\n      </mat-card-header>\r\n    </mat-card>\r\n  </div>\r\n</div>\r\n<div class=\"innnerpartofdrwer\">\r\n  <div fxLayout=\"row wrap\" id=\"regofflistview\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"regofficelistview\">\r\n      <mat-radio-group [formControl]=\"addressmap\" [(ngModel)]=\"selectedStatus\" aria-label=\"Select an option\">\r\n        <div *ngIf=\"registedoffice\" class=\"offeredview\">\r\n          <div class=\"regofficetextcolor\">\r\n            <h2>{{'mapcommunicte.regioffi' | translate}}</h2>\r\n          </div>\r\n          <div class=\"alignchecking\" *ngFor=\"let registoff of registedoffice\">\r\n            <mat-radio-button [value]=\"registoff.value\" class=\"m-t-10\"></mat-radio-button>\r\n            <div class=\"noteintercolor\">\r\n              <h2>{{registoff.officename}}</h2>\r\n              <p><span class=\"txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.branid' | translate}}</span> <span class=\"txt-black lypisfont-regular fs-15\">{{registoff.branchid}}</span></p>\r\n              <div class=\"officeaddresscolor p-t-10\">\r\n                <span class=\"p-b-10 txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.offiaddre' | translate}}</span>\r\n                <p class=\"txt-black lypisfont-regular fs-15\">{{registoff.officeaddress}}</p>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <div *ngIf=\"headoffice\" class=\"offeredview\">\r\n          <div class=\"regofficetextcolor p-t-10\">\r\n            <h2>{{'mapcommunicte.corphead' | translate}}</h2>\r\n          </div>\r\n          <div class=\"alignchecking\" *ngFor=\"let headoff of headoffice\">\r\n            <mat-radio-button [value]=\"headoff.value\" class=\"m-t-10\"></mat-radio-button>\r\n            <div class=\"noteintercolor\">\r\n              <h2>{{headoff.officename}}</h2>\r\n              <p><span class=\"p-b-10 txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.branid' | translate}}</span> <span class=\"txt-black lypisfont-regular fs-15\">{{headoff.branchid}}</span></p>\r\n              <div class=\"officeaddresscolor p-t-10\">\r\n                <span class=\"p-b-10 txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.offiaddre' | translate}}</span>\r\n                <p class=\"txt-black lypisfont-regular fs-15\">{{headoff.officeaddress}}</p>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <div *ngIf=\"branchoffice\" class=\"offeredview p-t-10\">\r\n          <div class=\"regofficetextcolor \">\r\n            <h2>{{'mapcommunicte.branoffi' | translate}}</h2>\r\n          </div>\r\n          <div class=\"alignchecking\" *ngFor=\"let branchoff of branchoffice\">\r\n            <mat-radio-button [value]=\"branchoff.value\" class=\"m-t-10\"></mat-radio-button>\r\n            <div class=\"noteintercolor\">\r\n              <h2>{{branchoff.officename}}</h2>\r\n              <p><span class=\"p-b-10 txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.branid' | translate}}</span> <span  class=\"txt-black lypisfont-regular fs-15\">{{branchoff.branchid}}</span></p>\r\n              <div class=\"officeaddresscolor p-t-10\">\r\n                <span class=\"p-b-10 txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.offiaddre' | translate}}</span>\r\n                <p class=\"txt-black lypisfont-regular fs-15\">{{branchoff.officeaddress}}</p>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n        <div *ngIf=\"representativeoff\" class=\"offeredview\">\r\n          <div class=\"regofficetextcolor p-t-10\">\r\n            <h2>{{'mapcommunicte.reproffi' | translate}}</h2>\r\n          </div>\r\n          <div class=\"alignchecking\" *ngFor=\"let repoff of representativeoff\">\r\n            <mat-radio-button [value]=\"repoff.value\" class=\"m-t-10\"></mat-radio-button>\r\n            <div class=\"noteintercolor\">\r\n              <h2>{{repoff.officename}}</h2>\r\n              <p><span class=\"p-b-10 txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.branid' | translate}}</span> <span class=\"txt-black lypisfont-regular fs-15\">{{repoff.branchid}}</span></p>\r\n              <div class=\"officeaddresscolor p-t-10\">\r\n                <span class=\"p-b-10 txt-blue lypisfont-regular fs-14\">{{'mapcommunicte.offiaddre' | translate}}</span>\r\n                <p class=\"txt-black lypisfont-regular fs-15\">{{repoff.officeaddress}}</p>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </mat-radio-group>\r\n    </div>\r\n  </div>\r\n</div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.html":
/*!**************************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.html ***!
  \**************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div *ngIf=\"Contentplaceloader\" fxLayout=\"row wrap\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n    <div fxLayout=\"row wrap\" class=\"page  m-t-20\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n        <div class=\"justify m-b-40 m-l-20 m-r-20\">\r\n          <h1 class=\"pagetitle\"></h1>\r\n          <h1 class=\"pagetitle\"></h1>\r\n        </div>\r\n        <div class=\"approvalalign\">\r\n          <div class=\"m-t-30\">\r\n            <h1 class=\"accordionwidth\"></h1>\r\n            <h1 class=\"accordionwidth\"></h1>\r\n            <h1 class=\"accordionwidth\"></h1>\r\n            <h1 class=\"accordionwidth\"></h1>\r\n            <h1 class=\"accordionwidth\"></h1>\r\n          </div>\r\n          <div class=\"alignend\">\r\n            <h1 class=\"pagetitle m-r-12\"></h1>\r\n            <h1 class=\"pagetitle\"></h1>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div *ngIf=\"!Contentplaceloader\" fxLayout=\"row wrap\" class=\"profileviewlist\">\r\n  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n    <div fxLayout=\"row wrap\">\r\n      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n        <div class=\"topheadermain\">\r\n          <div class=\"imagewithtext\">\r\n            <h4 class=\"mat-pagetitle-1\">{{'profilecreationlist.userprof' | translate}}</h4>\r\n          </div>\r\n         \r\n        </div>\r\n      </div>\r\n    </div>\r\n    <div fxLayout=\"row wrap\" fxLayoutAlign=\"center\" class=\" organizationdetail\" id=\"mastercompanydetail\" class=\"m-t-40\">\r\n      <div fxFlex.gt-sm=\"83.33\" fxFlex=\"100\" class=\"marginspace p-b-30\">\r\n\r\n        <form [formGroup]=\"basicinfoForm\" (ngSubmit)=\"onSubmitbasic()\">\r\n          <div fxLayout=\"row wrap\" class=\"listbasicinfo\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"alignfileds\">\r\n                <div class=\"innerside\">\r\n                  <div class=\"backgrounduploadbasicinfo m-r-30 m-t-25\">\r\n                    <app-filee class=\"viewheight\" #logo logoType=\"profile\" isLogo=true isDelete=\"true\"\r\n                      [fileMstRef]=\"drv_companylogo\" (filesSelected)=\"fileeSelected($event,drv_companylogo)\"\r\n                      (deleteImageID)=\"deleteLogo($event)\" formControlName=\"upload\">\r\n                    </app-filee>\r\n\r\n                  </div>\r\n                  <div class=\"acceptedcolor\">\r\n                    <p class=\"p-b-10\"> {{'profilecreationlist.uployourprof' | translate}}\r\n                    </p>\r\n                    <p> {{'profilecreationlist.acceimagform' | translate}} <br>\r\n                      {{'profilecreationlist.maxifilesize' | translate}}  <br>\r\n                    </p>\r\n                  </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" class=\"alignitems\">\r\n                  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <div class=\"progressandhistory alignpreview p-b-15\">\r\n                          <div class=\"pagetitlenew\">\r\n                            <h4 class=\"mat-pagetitle-2 textorgange\">{{'profilecreationlist.corpinfo' | translate}}</h4>\r\n                          </div>\r\n                          <div class=\"manageprofile\">\r\n                            <button type=\"button\" [routerLink]=\"'/profilecreation/profilelistview'\" mat-raised-button\r\n                              color=\"preview\" class=\"button-30 lineheight\">\r\n                              {{'profilecreationlist.viewprof' | translate}}\r\n                            </button>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-10\">\r\n                        <div fxLayout=\"row wrap\">\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                            <mat-form-field>\r\n                              <input  (keyup)=\"upadtebtn();\" required [errorStateMatcher]=\"matcher\" appAlphabetonly matInput maxlength=\"50\" formControlName=\"firstname\"\r\n                                placeholder=\"{{'profilecreationlist.firsname' | translate}}\"\r\n                                app-restrict-input=\"firstspace\" />\r\n                                <mat-error\r\n                                *ngIf=\"basicinfoForm.controls['firstname'].errors?.required && basicinfoForm.controls['firstname'].touched\"\r\n                                class=\"text-danger font-14\">\r\n                                 Enter firstname\r\n                              </mat-error>\r\n                            </mat-form-field>\r\n                          </div>\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                            ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\">\r\n                            <mat-form-field>\r\n                              <input (keyup)=\"upadtebtn();\" [errorStateMatcher]=\"matcher\" appAlphabetonly maxlength=\"50\" formControlName=\"middlename\" matInput\r\n                                placeholder=\"{{'profilecreationlist.middname' | translate}}\"\r\n                                app-restrict-input=\"firstspace\" />\r\n                            </mat-form-field>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                      <!-- <div fxFlex.gt-sm=\"30\" fxFlex=\"100\" ngClass.xs=\"p-l-0 rightsidedetails\"\r\n                        ngClass.sm=\"p-l-0 rightsidedetails\" ngClass.md=\"p-l-30 rightsidedetails\"\r\n                        ngClass.lg=\"p-l-30 rightsidedetails\" ngClass.xl=\"p-l-30 rightsidedetails\"> -->\r\n                        <!-- <p>{{'profilecreationlist.uployourprof' | translate}}.\r\n                        </p> -->\r\n\r\n                      <!-- </div> -->\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"70\" fxFlex=\"100\" class=\"p-b-10\">\r\n                        <div fxLayout=\"row wrap\">\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                            <mat-form-field>\r\n                              <input (keyup)=\"upadtebtn();\" required [errorStateMatcher]=\"matcher\" appAlphabetonly maxlength=\"50\" matInput formControlName=\"lastname\"\r\n                                placeholder=\"{{'profilecreationlist.lastname' | translate}}\"\r\n                                app-restrict-input=\"firstspace\" />\r\n                                <mat-error\r\n                                *ngIf=\"basicinfoForm.controls['lastname'].errors?.required && basicinfoForm.controls['lastname'].touched\"\r\n                                class=\"text-danger font-14\">\r\n                                 Enter lastname\r\n                              </mat-error>\r\n                            </mat-form-field>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-15\">\r\n                        <div fxLayout=\"row wrap\">\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                            <mat-form-field>\r\n                              <input (keyup)=\"upadtebtn();\" [errorStateMatcher]=\"matcher\" matInput formControlName=\"employeeid\"\r\n                                placeholder=\"{{'profilecreationlist.emplid' | translate}}\"\r\n                                app-restrict-input=\"firstspace\" required />\r\n                                <mat-error\r\n                                *ngIf=\"basicinfoForm.controls['employeeid'].errors?.required && basicinfoForm.controls['employeeid'].touched\"\r\n                                class=\"text-danger font-14\">\r\n                                {{'profilecreationlist.enteemplid' | translate}}\r\n                              </mat-error>\r\n                            </mat-form-field>\r\n                          </div>\r\n                          <div  fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                            ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\">\r\n                            <mat-form-field>\r\n                              <input  matInput [max]=\"maxDate\" (click)=\"picker2.open();upadtebtn();\" required formControlName=\"dateofjoining\"\r\n                                [errorStateMatcher]=\"matcher\"\r\n                                placeholder=\"{{'profilecreationlist.dateofjoin' | translate}}\" [matDatepicker]=\"picker2\"\r\n                                readonly>\r\n                              <mat-datepicker-toggle   matSuffix [for]=\"picker2\" ></mat-datepicker-toggle>\r\n                              <mat-datepicker #picker2></mat-datepicker>\r\n                              <mat-error\r\n                                *ngIf=\"basicinfoForm.controls['dateofjoining'].errors?.required && basicinfoForm.controls['dateofjoining'].touched\"\r\n                                class=\"text-danger font-14\">\r\n                                {{'profilecreationlist.seledateofjoin' | translate}}\r\n                              </mat-error>\r\n                            </mat-form-field>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-10\">\r\n                        <div fxLayout=\"row wrap\" id=\"select_valuetrigger\">\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                            <mat-form-field>                           \r\n                              <mat-select (selectionChange)='divisionChange($event.value)'   placeholder=\"{{'profilecreationlist.divi' | translate}}\"\r\n                                [disableOptionCentering]=\"false\" required formControlName=\"division\" multiple>\r\n                                <mat-select-trigger>\r\n                                  {{basicinfoForm.controls['division'].value ? businessUnitDataTemp : ''}}\r\n                                  <span *ngIf=\"basicinfoForm.controls['division'].value?.length > 1\" class=\"example-additional-selection\">\r\n                                    (+{{basicinfoForm.controls['division'].value.length - 1}}\r\n                                    {{basicinfoForm.controls['division'].value?.length === 2 ? 'other' : 'others'}})\r\n                                  </span>\r\n                                </mat-select-trigger>\r\n                                <mat-option [disabled]=\"optionvalue\" (click)=\"upadtebtn();\"  *ngFor=\"let divisionviewlist of businesssource\"\r\n                                  [value]=\"divisionviewlist.bunitPk\">{{divisionviewlist.bunitName }}\r\n                                </mat-option>\r\n                              \r\n                              </mat-select>\r\n                              <mat-error\r\n                              *ngIf=\"basicinfoForm.controls['division'].errors?.required && basicinfoForm.controls['division'].touched\"\r\n                              class=\"text-danger font-14\">\r\n                              Select division\r\n                            </mat-error>\r\n                            <button *ngIf=\"usertype == 'U'\" mat-button (click)=\"$event.stopPropagation();\" type=\"button\"\r\n                            matTooltip=\"Kindly contact your company admin to update your Divisions and Departments.\"\r\n                            matTooltipPosition=\"above\" matTooltipClass=\"allow-cr\" matSuffix mat-icon-button\r\n                            aria-label=\"Clear\">\r\n                            <i class=\"inputinfoicon bgi bgi-infonew\"></i>\r\n                          </button>\r\n                            </mat-form-field>\r\n                            <div *ngIf=\"usertype == 'A'\" class=\"mdepsapce\">\r\n                              <mat-hint  align=\"end\" *ngIf=\"businesssource?.length < 10\"\r\n                              (click)=\"addbusinessunitmcp.toggle();getbusinessInput();\">\r\n                              <div class=\"addingdepartment indexmdespace\">\r\n                                <span>{{'profilecreationlist.adddivi' | translate}}</span>\r\n                              </div>\r\n                            </mat-hint>\r\n                            </div>\r\n                          </div>\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                            ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\">\r\n                            <mat-form-field>\r\n                              <mat-select (selectionChange)='valueChanged($event.value)' multiple placeholder=\"{{'profilecreationlist.depa' | translate}}\"\r\n                                [disableOptionCentering]=\"true\" required formControlName=\"department\">\r\n                                <mat-select-trigger>\r\n                                  {{basicinfoForm.controls['department'].value ? deptDataTemp : ''}}\r\n                                  <span *ngIf=\"basicinfoForm.controls['department'].value?.length > 1\" class=\"example-additional-selection\">\r\n                                    (+{{basicinfoForm.controls['department'].value.length - 1}}\r\n                                    {{basicinfoForm.controls['department'].value?.length === 2 ? 'other' : 'others'}})\r\n                                  </span>\r\n                                </mat-select-trigger>\r\n                                <mat-option [disabled]=\"optionvalue\"  (click)=\"upadtebtn();\" *ngFor=\"let departmentviewlist of Deptartment\"\r\n                                  [value]=\"departmentviewlist.deptPk\">{{departmentviewlist.deptName }}  \r\n                                </mat-option>\r\n                              \r\n                              </mat-select>\r\n                              <mat-error\r\n                              *ngIf=\"basicinfoForm.controls['department'].errors?.required && basicinfoForm.controls['department'].touched\"\r\n                              class=\"text-danger font-14\">\r\n                              Select department\r\n                            </mat-error>\r\n                           \r\n                             \r\n                            </mat-form-field>\r\n                            <div *ngIf=\"usertype == 'A'\" class=\"mdepsapce\">\r\n                              <mat-hint align=\"end\" >\r\n                                <div class=\"addingdepartment indexmdespace\" (click)=\"openDeptSide();this.drawerdepartment.toggle();\">\r\n                                <span>{{'profilecreationlist.adddepa' | translate}} </span>\r\n                              </div>\r\n                            </mat-hint>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-10\">\r\n                        <div fxLayout=\"row wrap\">\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                            <mat-form-field>\r\n                              <input  (keyup)=\"upadtebtn();\" maxlength=\"50\"  matInput formControlName=\"designation\"\r\n                                placeholder=\"{{'profilecreationlist.desi' | translate}}\"\r\n                                app-restrict-input=\"firstspace\" required />\r\n                                <mat-error\r\n                                *ngIf=\"basicinfoForm.controls['designation'].errors?.required && basicinfoForm.controls['designation'].touched\"\r\n                                class=\"text-danger font-14\">\r\n                                {{'profilecreationlist.entedesi' | translate}}\r\n                              </mat-error>\r\n                            </mat-form-field>\r\n                          </div>\r\n                          <!-- <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                            ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\">\r\n                            <mat-form-field>\r\n                              <mat-select matInput formControlName=\"designationlevel\" [disableOptionCentering]=\"true\"\r\n                                placeholder=\"{{'profilecreationlist.desileve' | translate}}\">\r\n                                <mat-option *ngFor=\"let desiglevl of designlevel\" [value]=\"desiglevl.value\">\r\n                                  {{desiglevl.viewValue}}\r\n                                </mat-option>\r\n                              </mat-select>\r\n                            </mat-form-field>\r\n                          </div> -->\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <!-- <div fxLayout=\"row wrap\"> -->\r\n                      <!-- <div fxFlex.gt-sm=\"70\" fxFlex=\"100\">\r\n                        <div fxLayout=\"row wrap\" class=\"pos-relative checkevenchild\">\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                            <mat-form-field>\r\n                              <mat-select [disableOptionCentering]=\"true\" [errorStateMatcher]=\"matcher\"\r\n                                formControlName=\"reportingto\"\r\n                                placeholder=\"{{'profilecreationlist.repoto' | translate}}\">\r\n                                <mat-option *ngFor=\"let report of reportedto\" [value]=\"report.value\">\r\n                                  {{report.viewValue}}\r\n                                </mat-option>\r\n                              </mat-select> -->\r\n                              <!-- <mat-error\r\n                                *ngIf=\"basicinfoForm.controls['reportingto'].errors?.required && basicinfoForm.controls['reportingto'].touched\"\r\n                                class=\"text-danger font-14\">\r\n                                Select reporting authority\r\n                              </mat-error> -->\r\n                            <!-- </mat-form-field>\r\n                          </div>\r\n                          <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                            ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" formArrayName=\"gdp\"\r\n                            *ngFor=\"let control of gdpControl;let i = index\">\r\n                            <div fxLayout=\"row wrap\" [formGroupName]=\"i\">\r\n                              <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"alignremove\">\r\n                                <mat-form-field>\r\n                                  <mat-select (selectionChange)=\"changesuppervisor($event,i)\"\r\n                                    [disableOptionCentering]=\"true\" *ngIf=\"addsupervise\" [errorStateMatcher]=\"matcher\"\r\n                                    formControlName=\"supervisor\"\r\n                                    placeholder=\"{{'profilecreationlist.supe' | translate}}\">\r\n                                    <mat-option *ngFor=\"let Supervisorval of addsupervise\"\r\n                                      [value]=\"Supervisorval.value\">{{Supervisorval.viewValue}}\r\n                                    </mat-option>\r\n                                  </mat-select>\r\n                                </mat-form-field>\r\n                                <span class=\"p-l-15 bt-delete\" matSuffix (click)=\"removeGDP(i)\" mat-icon-button>\r\n                                  <i class=\"bgi bgi-delete\"></i>\r\n                                </span>\r\n                              </div>\r\n                            </div>\r\n                          </div> -->\r\n                          <!-- <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" style=\"position: relative;\">\r\n                            <div class=\"suptextcolor\" *ngIf=\"reportedto?.length > 0\">\r\n                              <p *ngIf=\"gdpControl.length < 3\" (click)=\"addGDP()\">{{'profilecreationlist.addsupe' |\r\n                                translate}}</p>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                      </div> -->\r\n                      <!-- <div fxFlex.gt-sm=\"30\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                        ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\">\r\n                        <div class=\"supervisortextcolor\">\r\n                          <p>{{'profilecreationlist.youcanadd' | translate}}<br>\r\n                            {{'profilecreationlist.supetowa' | translate}}</p>\r\n                        </div>\r\n                      </div>\r\n                    </div> -->\r\n                    <div fxLayout=\"row wrap\" class=\"m-t-20\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-10\">\r\n                        <div fxLayout=\"row wrap\">\r\n                          <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                            <mat-form-field>\r\n                              <textarea (keyup)=\"upadtebtn();\" matInput #profileview minlength=\"1\" maxlength=\"1000\"\r\n                                formControlName=\"briefprofile\"\r\n                                placeholder=\"{{'profilecreationlist.brieprof' | translate}}\" cdkTextareaAutosize\r\n                                #autosize=\"cdkTextareaAutosize\" cdkAutosizeMinRows=\"1\"\r\n                                cdkAutosizeMaxRows=\"9\"></textarea>\r\n                              <!-- appAlphanumsymb -->\r\n                              <mat-hint align=\"end\" class=\"p-t-3\">{{profileview.value.length}} / 1000</mat-hint>\r\n                            </mat-form-field>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <div fxLayout=\"row wrap\">\r\n                          <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                            <mat-form-field>\r\n                              <textarea (keyup)=\"upadtebtn();\" matInput #message minlength=\"1\" maxlength=\"1000\" formControlName=\"Roles\"\r\n                                placeholder=\"{{'profilecreationlist.role' | translate}}\" cdkTextareaAutosize\r\n                                #autosize=\"cdkTextareaAutosize\" cdkAutosizeMinRows=\"1\"\r\n                                cdkAutosizeMaxRows=\"9\"></textarea>\r\n                              <mat-hint align=\"end\" class=\"p-t-3\">{{message.value.length}} / 1000</mat-hint>\r\n                            </mat-form-field>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\">\r\n                      <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                        <form [formGroup]=\"communicationinfoForm\" (ngSubmit)=\"onSubmitcommunic()\">\r\n                          <div fxLayout=\"row wrap\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n                              <div class=\"pagetitlenew p-b-40 p-t-40\">\r\n                                <h4 class=\"mat-pagetitle-2 textorgange\">{{'profilecreationlist.comminfo' | translate}}</h4>\r\n                              </div>\r\n                              <div fxLayout=\"row wrap\" class=\"p-b-12 userprofilmailidmail\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.md=\"p-r-0\" ngClass.lg=\"p-r-0 paddingspace\"\r\n                                  ngClass.sm=\"p-r-0\" ngClass.xs=\"p-r-0\" ngClass.xl=\"p-r-0\">\r\n                                  <div fxLayout=\"row wrap\" class=\"p-b-15\">\r\n                                    <div fxFlex.gt-sm=\"15\" fxFlex=\"100\">\r\n                                      <mat-form-field class=\"country-flag\">\r\n                                        <mat-select [(value)]=\"mobile_country_code_flag\" (closed)=\"searchMobileCC = ''\"\r\n                                          formControlName=\"code\"\r\n                                          (selectionChange)=\"setcountryFlag($event.value,'mobile');\"\r\n                                          [disableOptionCentering]=\"true\" panelClass=\"select_with_search\" [disabled]=\"codeselect\"\r\n                                          *ngIf=\"(countrylist | searchFilter : searchMobileCC:'CyM_CountryName_en') as cntryresult\">\r\n                                          <div class=\"searchinmultiselect\">\r\n                                            <i class=\"bgi bgi-search\"></i>\r\n                                            <input appAlphanumsymb matInput class=\"searchselect\" type=\"Search\"\r\n                                              placeholder=\"{{'profilecreationlist.sear' | translate}}\"\r\n                                              (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchMobileCC\"\r\n                                              [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"searchMobileCC = ''\" class=\"reseticon\" matSuffix\r\n                                              *ngIf=\"searchMobileCC !='' && searchMobileCC !=null\">clear</mat-icon>\r\n                                          </div>\r\n                                          <mat-select-trigger class=\"flagwithcode\">\r\n                                            <img src=\"assets/images/flags/{{mobile_country_code_flag}}.png\"\r\n                                              alt=\"Country Flag\">\r\n                                          </mat-select-trigger>\r\n                                          <div class=\"option-listing\">\r\n                                            <mat-option class=\"countrynameselect\"\r\n                                              *ngFor=\"let country of countrylist | searchFilter : searchMobileCC:'CyM_CountryName_en'\"\r\n                                              [value]=\"country.CountryMst_Pk\">\r\n                                              <img class=\"widthimg\"\r\n                                                src=\"assets/images/flags/{{country.CountryMst_Pk}}.png\"\r\n                                                alt=\"Country Flag\">\r\n                                              {{country.CyM_CountryName_en}} ({{country.dialcode}})\r\n                                            </mat-option>\r\n                                          </div>\r\n                                        </mat-select>\r\n                                      </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"85\" fxFlex=\"100\" ngClass.md=\"p-l-15 paddingspace\"\r\n                                      ngClass.lg=\"p-l-15 paddingspace\" ngClass.sm=\"p-l-0\" ngClass.xs=\"p-l-0\"\r\n                                      ngClass.xl=\"p-l-15 paddingspace\">\r\n                                      <mat-form-field class=\"numberandcode\" floatLabel=\"always\">\r\n                                        <span ngClass.xs=\"p-r-0\" ngClass.sm=\"p-r-0\"\r\n                                          class=\"p-r-5 countrycodecolor\">{{mobilecode}}</span>\r\n                                        <input (keyup)=\"mobilenumchange();\" minlength=\"5\" [maxlength]=\"mobile_country_code_flag == 31? 8 : 20\" matInput appNumberonly minlength=\"1\" maxlength=\"20\"\r\n                                          formControlName=\"mobileno\" [errorStateMatcher]=\"matcher\"\r\n                                          placeholder=\"{{'profilecreationlist.mobi' | translate}}\" required>\r\n                                        <input matInput hidden='true' formControlName=\"mobilecc\"\r\n                                          placeholder=\"{{'profilecreationlist.phoncode' | translate}}\">\r\n                                        <mat-error \r\n                                          *ngIf=\"communicationinfoForm.controls.mobileno.errors?.required  && (communicationinfoForm.controls.mobileno.touched)\"\r\n                                          class=\"text-danger nowrap \">{{'profilecreationlist.entemobinumb' | translate}}\r\n                                        </mat-error>\r\n                                        <mat-error\r\n                                          *ngIf=\"communicationinfoForm.controls.mobileno.errors?.minlength && (communicationinfoForm.controls.mobileno.touched)\"\r\n                                          class=\"text-danger nowrap \">{{'profilecreationlist.enteminidigi' | translate}}\r\n                                        </mat-error>\r\n                                        <mat-error\r\n                                        *ngIf=\"communicationinfoForm.controls.mobileno.errors?.minlength && (communicationinfoForm.controls.mobileno.touched) && mobile_country_code_flag != 31\"\r\n                                        class=\"text-danger nowrap \">{{'profilecreationlist.enteminidigi' | translate}}\r\n                                      </mat-error>\r\n                                      <mat-error *ngIf=\"communicationinfoForm.controls.mobileno.errors?.samemobno\" class=\"text-danger\">{{'This mobile number is already verified'}}</mat-error>\r\n                                        <mat-error\r\n                                          *ngIf=\"communicationinfoForm.controls.mobileno.errors?.alreadyavailable\">\r\n                                          {{'profilecreationlist.mobinumbalre' | translate}}</mat-error>\r\n                                        <i  *ngIf=\"showeditbtnmobile\" (click)=\"editdatamobileotp();\" class=\"bgi bgi-edit1 p-l-15\" matTooltip=\"{{'profilecreationlist.edit' | translate}}\"></i>\r\n                                      </mat-form-field>\r\n                                    </div>\r\n                                  </div>\r\n                                </div>\r\n                                <div *ngIf=\"verifyshowfield\" fxFlex.gt-sm=\"50\" fxFlex=\"100\"\r\n                                  class=\"paddingspacing userprofilmailidmail\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                  ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\">\r\n                                  <div fxLayout=\"row wrap\" id=\"emailotpspinner\">\r\n                                    <div fxFlex.gt-sm=\"100\"  fxFlex=\"100\" id=\"mobileverifyspace\">\r\n                                      <mat-spinner-button  type=\"button\" *ngIf=\"mobnumverifybtn && verfiymobile && f1.mobileno.valid\"\r\n                                        (click)=\"otpshowdatamobiledata()\" class=\"submitbtnedit verifytop\"\r\n                                        [options]=\"spinnerButtonOptionsmobile\">\r\n                                      </mat-spinner-button>\r\n                                      <div *ngIf=\"otpshowmobile && divshow\" fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"paddingspacing\">\r\n                                        <div    class=\"otpheader_reg\">\r\n                                          <p class=\"m-0 fs-14 txt-gray6 importantfield\">{{'commoncontactinfo.enteotp' |\r\n                                            translate}}</p>\r\n                                          <div class=\"alignflex divouter\">\r\n                                            <div id=\"divOuter\">\r\n                                              <div id=\"divInner\">\r\n                                                <input formControlName=\"mobileotp\" required matinput (keyup)=\"otplengthcheck()\" \r\n                                                  onpaste=\"return false;\" (keydown.space)=\"$event.preventDefault();\"\r\n                                                  id=\"partitioneduserprofile\" type=\"text\" maxlength=\"6\">\r\n                                              </div>\r\n                                            </div>\r\n                                           \r\n                                            <a mat-raised-button color=\"primary\"  (click)=\"submitdatamobile()\"  \r\n                                              class=\"button-30 submitwrap m-l-20\">{{'commoncontactinfo.subm' |\r\n                                              translate}} </a>\r\n                                              <a mat-raised-button color=\"primary\" (click)=\"cancelmobilever()\" class=\"button-30 previous fs-13 m-l-5\">{{'Cancel'}}</a>\r\n                                          </div>\r\n                                          <!-- <div class=\"p-t-8\">\r\n                <mat-error *ngIf=\"mobileotp.errors?.expiredOTP\"\r\n                  class=\"fs-13 colorotp lowercaseremove\">{{'commoncontactinfo.expiotp' |\r\n                  translate}}\r\n                </mat-error>\r\n                <mat-error *ngIf=\"mobileotp.errors?.invalidOTP\"\r\n                  class=\"fs-13 colorotp lowercaseremove\">{{'commoncontactinfo.invaotp' |\r\n                  translate}}\r\n                </mat-error>\r\n              </div> -->\r\n                                          <div fxLayoutAlign=\"flex-start\" class=\"p-t-8\">\r\n                                            <!-- <p class=\"fs-13 m-0 txt-gray3\"  *ngIf=\"!iferrorotp\" >{{'commoncontactinfo.otpvalionlyfor' |\r\n                  translate}}</p> -->\r\n                                            <mat-error class=\"fs-13 m-0 red\" *ngIf=\"iferrorotp\">{{'profilecreationlist.invaliotp' | translate}}</mat-error>\r\n                                            <!-- <a href=\"javascript:void(0)\"\r\n                  class=\"resendotpcolor fs-13 p-l-30\">{{'commoncontactinfo.reseotp' |\r\n                  translate}}\r\n                </a> -->\r\n                                            <div class=\"p-t-0 resendotp d-flex\">\r\n                                              <button type=\"button\" [disabled]=\"this.disableResendmob == true\"\r\n                                                (click)=\"submitdatamobile()\">{{'commoncontactinfo.reseotp' |\r\n                                                translate}}</button>\r\n                                              <span>{{countDownMob}}</span>\r\n                                            </div>\r\n                                          </div>\r\n                                        </div>\r\n                                      </div>\r\n                                      <span *ngIf=\"verfiedtagshowmobile\" class=\"verifiedcontentbtn\">\r\n                                        <i class=\"bgi bgi-tick fs-12\"></i>\r\n                                        <span class=\"p-l-8\">{{'commoncontactinfo.verified' | translate}}</span>\r\n                                      </span>\r\n                                    </div>\r\n                                  </div>\r\n                                </div>\r\n                              </div>\r\n                              <div fxLayout=\"row wrap\" class=\"p-b-15\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"flagwidthspend\">\r\n                                  <div fxLayout=\"row wrap\">\r\n                                    <div fxFlex.gt-sm=\"15\" fxFlex=\"100\" class=\"flagimage code paddingright\">\r\n                                      <mat-form-field class=\"country-flag\">\r\n                                        <mat-select [(value)]=\"landline_country_code_flag\"\r\n                                          (closed)=\"searchMobileCC = ''\" formControlName=\"coumtrycode\"\r\n                                          (selectionChange)=\"setcountryFlag($event.value,'landline');\"\r\n                                          [disableOptionCentering]=\"true\" panelClass=\"select_with_search\"\r\n                                          *ngIf=\"(countrylist | searchFilter : searchMobileCC:'CyM_CountryName_en') as cntryresult\">\r\n                                          <div class=\"searchinmultiselect\">\r\n                                            <i class=\"bgi bgi-search\"></i>\r\n                                            <input appAlphanumsymb matInput class=\"searchselect\" type=\"Search\"\r\n                                              placeholder=\"{{'profilecreationlist.sear' | translate}}\"\r\n                                              (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchMobileCC\"\r\n                                              [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"searchMobileCC = ''\" class=\"reseticon\" matSuffix\r\n                                              *ngIf=\"searchMobileCC !='' && searchMobileCC !=null\">clear</mat-icon>\r\n                                          </div>\r\n                                          <mat-select-trigger class=\"flagwithcode\">\r\n                                            <img src=\"assets/images/flags/{{landline_country_code_flag}}.png\"\r\n                                              alt=\"Country Flag\">\r\n                                          </mat-select-trigger>\r\n                                          <div class=\"option-listing\">\r\n                                            <mat-option class=\"countrynameselect\"\r\n                                              *ngFor=\"let country of countrylist | searchFilter : searchMobileCC:'CyM_CountryName_en'\"\r\n                                              [value]=\"country.CountryMst_Pk\">\r\n                                              <img class=\"widthimg\"\r\n                                                src=\"assets/images/flags/{{country.CountryMst_Pk}}.png\"\r\n                                                alt=\"Country Flag\">\r\n                                              {{country.CyM_CountryName_en}} ({{country.dialcode}})\r\n                                            </mat-option>\r\n                                          </div>\r\n                                        </mat-select>\r\n                                      </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"64\" fxFlex=\"100\" ngClass.md=\"p-l-15 paddingspace\"\r\n                                      ngClass.lg=\"p-l-15 paddingspace\" ngClass.sm=\"p-l-0\" ngClass.xs=\"p-l-0\"\r\n                                      ngClass.xl=\"p-l-15 paddingspace\">\r\n                                      <mat-form-field class=\"numberandcode\" floatLabel=\"always\">\r\n                                        <span class=\"p-r-5 countrycodecolor\">{{landlinecode}}</span>\r\n                                        <input  (keyup)=\"upadtebtn();\" id=\"landlineno\" [maxlength]=\"landline_country_code_flag== 31? 8 : 20\"  minlength=\"5\" #landlinenumber matInput [errorStateMatcher]=\"matcher\"\r\n                                          minlength=\"1\"  appNumberonly formControlName=\"landlineno\"\r\n                                          placeholder=\"{{'profilecreationlist.landline' | translate}}\">\r\n                                        <input matInput hidden='true' formControlName=\"landlinecc\"\r\n                                          placeholder=\"{{'profilecreationlist.phoncode' | translate}}\">\r\n                                      </mat-form-field>\r\n                                    </div>\r\n                                    <div fxFlex.gt-sm=\"21\" fxFlex=\"100\" ngClass.md=\"p-l-15 paddingspace\"\r\n                                      ngClass.lg=\"p-l-15 paddingspace\" ngClass.sm=\"p-l-0\" ngClass.xs=\"p-l-0\"\r\n                                      ngClass.xl=\"p-l-15 paddingspace\">\r\n                                      <mat-form-field>\r\n                                        <input matInput maxlength=\"5\" app-restrict-input=\"firstspace\" formControlName=\"extn\"\r\n                                          placeholder=\"{{'profilecreationlist.extn' | translate}}\" NumberOnly>\r\n                                      </mat-form-field>\r\n                                    </div>\r\n                                  </div>\r\n                                </div>\r\n\r\n                              </div>\r\n                              <div fxLayout=\"row wrap\" class=\"userprofilmailidmail\">\r\n                                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                  <mat-form-field class=\"numberandcode\" floatLabel=\"always\">\r\n                                    <input matInput required\r\n                                      placeholder=\"{{'profilecreationlist.workemaiid' | translate}}\" required\r\n                                      [errorStateMatcher]=\"matcher\" app-restrict-input=\"firstspace\"\r\n                                      formControlName=\"workemialid\" (ngModelChange)=\"checksamemailid();\"  (keyup)=\"emailcheck()\">\r\n                                    <mat-error\r\n                                      *ngIf=\"communicationinfoForm.controls['workemialid'].errors?.required && communicationinfoForm.controls['workemialid'].touched\"\r\n                                      class=\"text-danger font-14\">\r\n                                      {{'profilecreationlist.entethework' | translate}}\r\n                                    </mat-error>\r\n                                    <mat-error *ngIf=\"f1.workemialid.errors?.pattern\" class=\"text-danger\">{{'profilecreationlist.entevaliemai' | translate}}</mat-error>\r\n                                    <mat-error *ngIf=\"f1.workemialid.errors?.alreadyExist\" class=\"text-danger\">{{'profilecreationlist.emaiidalreexis' | translate}}</mat-error>\r\n                                    <mat-error *ngIf=\"f1.workemialid.errors?.samemailid\" class=\"text-danger\">{{'This email id is already verified'}}</mat-error>\r\n                                    <i *ngIf=\"showeditbtn\" (click)=\"editdataotp();\" class=\"bgi bgi-edit1 p-l-15\" matTooltip=\"{{'profilecreationlist.edit' | translate}}\"></i>\r\n                                  </mat-form-field>\r\n                                </div>\r\n                                <div *ngIf=\"emailview\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                                ngClass.lg=\"p-l-30\" id=\"emailotpspinner\" ngClass.xl=\"p-l-30\" fxFlex=\"50\" fxFlex.xs=\"100\" fxFlex.sm=\"50\" fxFlex.md=\"50\" fxFlex.lg=\"50\" fxFlex.xl=\"50\"  class=\"userprofilmailidmail p-t-0 p-b-0\">\r\n\r\n                                  <mat-spinner-button   type=\"button\" *ngIf=\"verfiy && f1.workemialid.valid\" (click)=\"otpshowdata()\"  class=\"submitbtnedit\"\r\n                                  [options]=\"spinnerButtonOptions\">\r\n                                </mat-spinner-button>\r\n                                <div id=\"verifyemailtop\">\r\n                                  <div *ngIf=\"otpviewfield\" fxFlex.gt-sm=\"100\" fxFlex=\"100\"  class=\"paddingspacing\">\r\n                                    <div *ngIf=\"divshowemail\" class=\"otpheader_reg verifyemailspaced\">\r\n                                      <p class=\"m-0 fs-14 txt-gray6 importantfield\">{{'commoncontactinfo.enteotp' |\r\n                                        translate}}</p>\r\n                                      <div class=\"alignflex divouter\">\r\n                                        <div id=\"divOuter\">\r\n                                          <div id=\"divInner\">\r\n                                            <input formControlName=\"emailotp\" matinput onpaste=\"return false;\" required\r\n                                              (keydown.space)=\"$event.preventDefault();\" id=\"partitioneduserprofile\" type=\"text\"\r\n                                              maxlength=\"6\">\r\n                                          </div>\r\n                                        </div>\r\n                                        <a mat-raised-button color=\"primary\" (click)=\"submitdtataotp()\"\r\n                                          class=\"button-30 submitwrap m-l-20\">{{'commoncontactinfo.subm' | translate}}</a>\r\n                                          <a mat-raised-button color=\"primary\" (click)=\"cancelmailver()\" class=\"button-30 fs-13 m-l-5 previous\">{{'Cancel'}}</a>\r\n                                        <!-- <a mat-raised-button color=\"primary\" (click)=\"otpshowdata()\"\r\n                                          class=\"button-30 fs-13 m-l-15\">Resend</a> -->\r\n                                      </div>\r\n                                        <!-- <div class=\"p-t-8\">  -->\r\n                                         <!-- <mat-error *ngIf=\"emailotp.errors?.expiredOTP\"\r\n                                          class=\"fs-13 colorotp lowercaseremove\">{{'commoncontactinfo.expiotp' |\r\n                                          translate}}\r\n                                        </mat-error>  -->\r\n                                       <!-- <mat-error *ngIf=\"emailotp.errors?.invalidOTP\"\r\n                                          class=\"fs-13 colorotp lowercaseremove\">{{'commoncontactinfo.invaotp' |\r\n                                          translate}}\r\n                                        </mat-error> -->\r\n                                        <mat-error class=\"fs-13 m-0 red\"  *ngIf=\"iferrorotpmail\">{{'profilecreationlist.invaliotp' | translate}}</mat-error>\r\n                                      <!-- </div>  -->\r\n                                      <div fxLayoutAlign=\"flex-start\" class=\"p-t-5\">\r\n                                      <div class=\"p-t-0 resendotp d-flex\">\r\n                                      <button type=\"button\" (click)=\"submitdtataotp()\" [disabled]=\"disableResendemail == true\">{{'commoncontactinfo.reseotp' | translate}}</button>\r\n                                      <span>{{countDown}}</span>\r\n                                      </div>\r\n                                      </div> \r\n                                    </div>\r\n                                  </div>\r\n                                  <span *ngIf=\"verfiedtagshow\" class=\"verifiedcontentbtn verifytagtop\">\r\n                                    <i class=\"bgi bgi-tick fs-12\"></i>\r\n                                    <span class=\"p-l-8\">{{'profilecreationlist.veri' | translate}}</span>\r\n                                  </span>\r\n                                </div>\r\n                                \r\n                                </div>\r\n                              </div>\r\n                              <!-- <mat-card *ngIf=\"addressists.length == 0\" class=\"shadowcard m-t-10\"\r\n                                (click)=\"mappingdrawer.toggle()\">\r\n                                <mat-card-header class=\"p-r-14\">\r\n                                  <mat-card-title class=\"suppliertextcolor\">\r\n                                    <span>{{'profilecreationlist.addyouroffic' | translate}}</span>\r\n                                  </mat-card-title>\r\n                                  <mat-card-subtitle class=\"selectjsrtext fs-14\">\r\n                                    <p>{{'profilecreationlist.addiyourcommuinfo' | translate}}\r\n                                    </p>\r\n                                  </mat-card-subtitle>\r\n                                  <div class=\"selectforward\">\r\n                                    <i class=\"bgi bgi-dropdown\"></i>\r\n                                  </div>\r\n                                </mat-card-header>\r\n                              </mat-card> -->\r\n                              <!-- <div *ngIf=\"addressists.length != 0\" class=\"officetext\">\r\n                                <div class=\"changealign\">\r\n                                  <h2>{{addressists.officeloc}}</h2>\r\n                                  <p (click)=\"changecomadd(addressists.value)\">{{'profilecreationlist.chan' | translate}}</p>\r\n                                </div>\r\n                                <div class=\"papernotecolor\">\r\n                                  <h2>{{addressists.officename}}</h2>\r\n                                  <p><span class=\"txt-blue lypisfont-regular fs-14\">{{'profilecreationlist.branid' | translate}}:</span> <span class=\"txt-black lypisfont-regular fs-15\">{{addressists.branchid}}</span></p>\r\n                                </div>\r\n                                <div class=\"addresscolor p-t-15\">\r\n                                  <p class=\"txt-blue lypisfont-regular fs-14\">{{'profilecreationlist.offiaddr' | translate}}</p>\r\n                                  <span class=\"txt-black lypisfont-regular fs-15\">{{addressists.officeaddress}}</span>\r\n                                </div>\r\n                              </div> -->\r\n                            </div>\r\n                          </div>\r\n                          <div fxLayout=\"row wrap\" class=\"p-t-30\" fxLayoutAlign=\"end\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"alignnext\">\r\n                              <button mat-raised-button color=\"primary\" type=\"button\" class=\"button-40 previous m-r-10\"\r\n                                (click)=\"cancelprocess()\">{{'profilecreationlist.prev' | translate}}</button>\r\n                              <button mat-raised-button color=\"primary\" type=\"submit\" class=\"button-40 saveandnext\"\r\n                               \r\n                                [disabled]=\"!upadtebtnn || !communicationinfoForm.valid || !basicinfoForm.valid\">{{'profilecreationlist.saveandnext' |\r\n                                translate}}</button>\r\n                            </div>\r\n                          </div>\r\n                        </form>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <!-- <div fxLayout=\"row wrap\" class=\"p-t-30\" fxLayoutAlign=\"end\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"alignnext\">\r\n              <button mat-raised-button type=\"submit\" class=\"button-40 saveandnext\" color=\"primary\"\r\n                [class.previous]=\"!basicinfoForm.valid\" [disabled]=\"!basicinfoForm.valid\"\r\n                (click)=\"panelUpdate(2)\">{{'profilecreationlist.saveandnext' | translate}}</button>\r\n            </div>\r\n          </div> -->\r\n        </form>\r\n\r\n        <!-- <mat-accordion class=\"commonexpandandcollapse profileaccordion\"> -->\r\n        <!-- <div fxLayout=\"row wrap\" class=\"triggeredto\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <mat-expansion-panel class=\"required\" (opened)=\"setOpen(1)\" [expanded]=\"panel === 1\">\r\n                <mat-expansion-panel-header (click)=\"scrollTo('page-content')\" [collapsedHeight]=\"customCollapsedHeight\"\r\n                  [expandedHeight]=\"customExpandedHeight\">\r\n                  <mat-panel-title>\r\n                    <div class=\"accrodianheader\">\r\n                      <p class=\"header m-0 fs-15\">\r\n                        <span class=\"pagenumbercolorblank\" [class.completed]=\"basicinfoForm.valid\">1</span>\r\n                        <span>{{'profilecreationlist.userinfo' | translate}}</span>\r\n                      </p>\r\n                    </div>\r\n                  </mat-panel-title>\r\n                </mat-expansion-panel-header>\r\n              \r\n              </mat-expansion-panel>\r\n            </div>\r\n          </div> -->\r\n        <!-- <div fxLayout=\"row wrap\" class=\"triggeredto\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <mat-expansion-panel (opened)=\"panel = 2\" [expanded]=\"panel === 2\">\r\n                <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                  [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                  <mat-panel-title>\r\n                    <div class=\"accrodianheader\">\r\n                      <p class=\"header m-0 fs-15\">\r\n                        <span class=\"pagenumbercolorblank m-r-10\" [class.completed]=\"certificatecnt > 0\">2</span>\r\n                        <span>{{'profilecreationlist.certs' | translate}}</span>\r\n                      </p>\r\n                    </div>\r\n                  </mat-panel-title>\r\n                </mat-expansion-panel-header>\r\n                <div fxLayout=\"row wrap\" class=\"alignpublish\">\r\n                  <div fxFlex.gt-sm=\"70\" fxFlex=\"100\" class=\"certificatewidth\">\r\n                    <p class=\"venuecolor\">{{'profilecreationlist.certs' | translate}}:\r\n                      <span>{{(certificatecnt > 0)?certificatecnt:''}}</span>\r\n                    </p>\r\n                    <div>\r\n                      <mat-paginator\r\n                        [style.visibility]=\"(certificatecnt > 3 || overallcertificatecnt > 3) ? 'visible' : 'hidden' \"\r\n                        class=\"masterPage masterPageTop\" #paginator [length]=\"overallcertificatecnt\"\r\n                        [pageSize]=\"perpage\" (page)=\"pageEvent = $event; onPaginateChange($event)\"\r\n                        [pageSizeOptions]=\"paginationSet\">\r\n                      </mat-paginator>\r\n                    </div>\r\n                  </div>\r\n                  <div fxFlex.gt-sm=\"30\" fxFlex=\"100\" class=\"venuewidth\">\r\n                    <mat-form-field *ngIf=\"overallcertificatecnt > 3 || searchcertificatetitle\" class=\"m-r-15\">\r\n                      <input autocomplete=\"off\" placeholder=\"{{'profilecreationlist.sear' | translate}}\" matInput [(ngModel)]=\"searchcertificatetitle\">\r\n                      <button mat-button matSuffix mat-icon-button aria-label=\"Search\"\r\n                        (click)=\"oncertififiltersubmit()\">\r\n                        <mat-icon matSuffix>search</mat-icon>\r\n                      </button>\r\n                      <button mat-button matSuffix mat-icon-button aria-label=\"Clear\"\r\n                        (click)=\"searchcertificatetitle = '';oncertififiltersubmit()\">\r\n                        <mat-icon>close</mat-icon>\r\n                      </button>\r\n                    </mat-form-field>\r\n                    <div class=\"alignvenue m-b-0\">\r\n                      <button color=\"preview\" (click)=\"addcertificatedraw()\" type=\"button\" mat-raised-button\r\n                        class=\"addbutton height-35 p-l-20 p-r-20 lineheight\">\r\n                        <span>{{'profilecreationlist.add' | translate}}</span>\r\n                      </button>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div *ngIf=\"certificatelists\" fxLayout=\"row wrap\" class=\"m-t-30\">\r\n                  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"creationlist\">\r\n                    <div class=\"addedcertificate p-l-20\" *ngFor=\"let certificatelist of certificatelists\">\r\n                      <div fxLayout=\"row wrap\" class=\"certificates\">\r\n                        <div class=\"imgalignflex\">\r\n                          <img src=\"{{certificatelist.certuploadurl}}\"\r\n                            onError=\"this.src = 'assets/images/NoimageJPG.jpg'\" alt=\"NoimageJPG\">\r\n                        </div>\r\n                        <div class=\"companyandofficeinfo p-l-20\">\r\n                          <h3 class=\"name \" *ngIf=\"certificatelist.title.length < 60\">{{certificatelist.title |\r\n                            truncate:[60,'...']}}</h3>\r\n                          <h3 class=\"name pointer\" *ngIf=\"certificatelist.title.length > 60\"\r\n                            popover=\"{{certificatelist?.title}}\" popoverTitle=\"\" popoverPlacement=\"bottom-right\"\r\n                            [popoverOnHover]=\"true\" [popoverCloseOnClickOutside]=\"true\"\r\n                            [popoverCloseOnMouseOutside]=\"false\" [popoverDisabled]=\"false\" [popoverAnimation]=\"true\">\r\n                            {{certificatelist.title |\r\n                            truncate:[60,'...']}}</h3>\r\n                          <div fxLayout=\"row wrap\" class=\"countryandcrinfo\">\r\n                            <div class=\"eachitem countrywidth\">\r\n                              <p><span class=\"lypisfont-regular fs-14\">{{'profilecreationlist.dateofissu' | translate}}</span></p>\r\n                              <div class=\"flexoman\">\r\n                                <span class=\"txt-black lypisfont-regular fs-15\">{{certificatelist.dateofissue}}</span>\r\n                              </div>\r\n                            </div>\r\n                            <div *ngIf=\"certificatelist.relateddocurl.length > 0\" class=\"eachitem countrywidth\">\r\n                              <p><span class=\"lablename\">{{'profilecreationlist.reladocu' | translate}}\r\n                                </span></p>\r\n                              <span *ngFor=\"let reldoc of certificatelist.relateddocurl\"><a href=\"{{reldoc.fileurl}}\"\r\n                                  target=\"_blank\">\r\n                                  <img src=\"assets/images/{{reldoc.fileType}}_new.svg\" alt=\"pdfsmallimage.png\">\r\n                                </a></span>\r\n                            </div>\r\n                          </div>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"editanddelete p-r-20\">\r\n                        <span matTooltip=\"{{'profilecreationlist.edit' | translate}}\" (click)=\"editcert(certificatelist)\" class=\"edit m-r-20\">\r\n                          <i class=\"bgi bgi-edit1\"></i>\r\n                        </span>\r\n                        <span matTooltip=\"{{'profilecreationlist.dele' | translate}}\" (click)=\"deletecert(certificatelist.id)\" class=\"delete m-r-15\">\r\n                          <i class=\"bgi bgi-delete\"></i>\r\n                        </span>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"noducumentaddedyet\" *ngIf=\"certificatecnt == 0\" style=\"text-align:center\">\r\n                  <img src=\"./assets/images/Add.svg\" alt=\"nocollateral.png\">\r\n                  <p class=\"fs-16 lypisfont-bold txt-tropaz header m-0 lh-25 p-t-20\">{{'profilecreationlist.thernothinhere' | translate}}</p>\r\n                </div>\r\n                <mat-paginator\r\n                  [style.visibility]=\" (certificatecnt > 3 || overallcertificatecnt > 3) ? 'visible' : 'hidden' \"\r\n                  class=\"masterPage masterbottom\" showFirstLastButtons\r\n                  (page)=\"pageEvent = $event; onPaginateChange($event);syncPrimaryPaginator($event);\"\r\n                  [pageSize]=\"paginator?.pageSize\" [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                  [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                </mat-paginator>\r\n                <div fxLayout=\"row wrap\" class=\"p-t-30\" fxLayoutAlign=\"end\">\r\n                  <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"alignnext\">\r\n                    <button mat-raised-button color=\"primary\" type=\"button\" class=\"button-40 previous m-r-15\"\r\n                      (click)=\"panelUpdate(1)\">{{'profilecreationlist.prev' | translate}}</button>\r\n                    <button mat-raised-button color=\"primary\" type=\"button\" class=\"button-40 saveandnext\"\r\n                      (click)=\"panelUpdate(3)\">{{'profilecreationlist.next' | translate}}</button>\r\n                  </div>\r\n                </div>\r\n              </mat-expansion-panel>\r\n            </div>\r\n          </div> -->\r\n        <!-- <div fxLayout=\"row wrap\" class=\"triggeredto\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <mat-expansion-panel class=\"required\" (opened)=\"panel = 3\" [expanded]=\"panel === 3\">\r\n                <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                  [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                  <mat-panel-title>\r\n                    <div class=\"accrodianheader alignblock\">\r\n                      <p class=\"header m-0 fs-15\">\r\n                        <span class=\"pagenumbercolorblank m-r-10\" [class.completed]=\"communicationinfoForm.valid\">3</span>\r\n                        <span>{{'profilecreationlist.comminfo' | translate}} </span>\r\n                      </p>\r\n                    </div>\r\n                  </mat-panel-title>\r\n                </mat-expansion-panel-header>\r\n              \r\n              </mat-expansion-panel>\r\n            </div>\r\n          </div> -->\r\n        <!-- <div fxLayout=\"row wrap\" class=\"triggeredto p-b-40\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <mat-expansion-panel (opened)=\"panel = 4\" [expanded]=\"panel === 4\">\r\n                <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                  [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                  <mat-panel-title>\r\n                    <div class=\"accrodianheader\">\r\n                      <p class=\"header m-0 fs-15\">\r\n                        <span class=\"pagenumbercolorblank m-r-10\" [class.completed]=\"socialmediaForm.valid\">4</span>\r\n                        <span>{{'profilecreationlist.webpresandsoci' | translate}}</span>\r\n                      </p>\r\n                    </div>\r\n                  </mat-panel-title>\r\n                </mat-expansion-panel-header>\r\n                <form [formGroup]=\"socialmediaForm\" (ngSubmit)=\"onSubmitsocialmed()\">\r\n                  <div fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"70\" fxFlex=\"100\">\r\n                      <div class=\"webtextcolor\">\r\n                        <h2>{{'profilecreationlist.webpres' | translate}}</h2>\r\n                      </div>\r\n                      <div class=\"eachsociallink\">\r\n                        <img src=\"./assets/images/skypeimage.png\" alt=\"Skype\">\r\n                        <p class=\"p-l-10\">{{'profilecreationlist.skyp' | translate}}</p>\r\n                        <div class=\"alignremove\">\r\n                          <mat-form-field>\r\n                            <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb minlength=\"1\" maxlength=\"250\" formControlName=\"Skype\"\r\n                              placeholder=\"{{'profilecreationlist.enteskypid' | translate}}\">\r\n                            <mat-error *ngIf=\"socialmediaForm.controls['Skype'].errors?.pattern\">\r\n                              {{'profilecreationlist.invaurl' | translate}} \r\n                            </mat-error>\r\n                          </mat-form-field>\r\n                          <span *ngIf=\"socialmediaForm.controls['Skype'].value\" matTooltip=\"{{'profilecreationlist.dele' | translate}}\"\r\n                            (click)=\"deletewebprese(1,'Skype')\" class=\"p-l-15 bt-delete\" matSuffix>\r\n                            <i class=\"bgi bgi-delete\"></i>\r\n                          </span>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"eachsociallink\">\r\n                        <img src=\"./assets/images/zoom.png\" alt=\"Zoom\">\r\n                        <p class=\"p-l-10\">{{'profilecreationlist.zoom' | translate}}</p>\r\n                        <div class=\"alignremove\">\r\n                          <mat-form-field>\r\n                            <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb minlength=\"1\" maxlength=\"250\" formControlName=\"Zoom\"\r\n                              placeholder=\"{{'profilecreationlist.entezoomid' | translate}}\">\r\n                            <mat-error *ngIf=\"socialmediaForm.controls['Zoom'].errors?.pattern\">\r\n                              {{'profilecreationlist.invaurl' | translate}}\r\n                            </mat-error>\r\n                          </mat-form-field>\r\n                          <span *ngIf=\"socialmediaForm.controls['Zoom'].value\" matTooltip=\"{{'profilecreationlist.dele' | translate}}\"\r\n                            (click)=\"deletewebprese(2,'Zoom')\" class=\"p-l-15 bt-delete\" matSuffix>\r\n                            <i class=\"bgi bgi-delete\"></i>\r\n                          </span>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"eachsociallink\">\r\n                        <img src=\"./assets/images/gmeet.png\" alt=\"Google Meet\">\r\n                        <p class=\"p-l-10\">{{'profilecreationlist.googmeet' | translate}}</p>\r\n                        <div class=\"alignremove\">\r\n                          <mat-form-field>\r\n                            <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb minlength=\"1\" maxlength=\"250\" formControlName=\"GoogleMeet\"\r\n                              placeholder=\"{{'profilecreationlist.entegoogmeet' | translate}}\">\r\n                            <mat-error *ngIf=\"socialmediaForm.controls['GoogleMeet'].errors?.pattern\">\r\n                              {{'profilecreationlist.invaurl' | translate}}\r\n                            </mat-error>\r\n                          </mat-form-field>\r\n                          <span *ngIf=\"socialmediaForm.controls['GoogleMeet'].value\" matTooltip=\"{{'profilecreationlist.dele' | translate}}\"\r\n                            (click)=\"deletewebprese(3,'GoogleMeet')\" class=\"p-l-15 bt-delete\" matSuffix>\r\n                            <i class=\"bgi bgi-delete\"></i>\r\n                          </span>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"webtextcolor\">\r\n                        <h2 class=\"m-0\">{{'profilecreationlist.socimedihand' | translate}}</h2>\r\n                      </div>\r\n                      <div class=\"eachsociallink\">\r\n                        <img src=\"./assets/images/Facebookweb.svg\" alt=\"Facebook\">\r\n                        <p class=\"p-l-10\">{{'profilecreationlist.face' | translate}}</p>\r\n                        <div class=\"alignremove\">\r\n                          <mat-form-field>\r\n                            <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb minlength=\"1\" maxlength=\"250\" formControlName=\"facebook\"\r\n                              placeholder=\"{{'profilecreationlist.enteurl' | translate}}\">\r\n                            <mat-error *ngIf=\"socialmediaForm.controls['facebook'].errors?.pattern\">\r\n                              {{'profilecreationlist.invaurl' | translate}}\r\n                            </mat-error>\r\n                          </mat-form-field>\r\n                          <span *ngIf=\"socialmediaForm.controls['facebook'].value\" matTooltip=\"{{'profilecreationlist.dele' | translate}}\"\r\n                            (click)=\"deletesocialmed(1,'facebook')\" class=\"p-l-15 bt-delete\" matSuffix>\r\n                            <i class=\"bgi bgi-delete\"></i>\r\n                          </span>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"eachsociallink\">\r\n                        <img src=\"./assets/images/Twitterweb.svg\" alt=\"Twiiter\">\r\n                        <p class=\"p-l-10\">{{'profilecreationlist.twit' | translate}}</p>\r\n                        <div class=\"alignremove\">\r\n                          <mat-form-field>\r\n                            <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb minlength=\"1\" maxlength=\"250\" formControlName=\"twitter\"\r\n                              placeholder=\"{{'profilecreationlist.enteurl' | translate}}\">\r\n                            <mat-error *ngIf=\"socialmediaForm.controls['twitter'].errors?.pattern\">\r\n                              {{'profilecreationlist.invaurl' | translate}}\r\n                            </mat-error>\r\n                          </mat-form-field>\r\n                          <span *ngIf=\"socialmediaForm.controls['twitter'].value\" matTooltip=\"{{'profilecreationlist.dele' | translate}}\"\r\n                            (click)=\"deletesocialmed(2,'twitter')\" class=\"p-l-15 bt-delete\" matSuffix>\r\n                            <i class=\"bgi bgi-delete\"></i>\r\n                          </span>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"eachsociallink\">\r\n                        <img src=\"./assets/images/Instagramweb.svg\" alt=\"Instagram\">\r\n                        <p class=\"p-l-10\">{{'profilecreationlist.insta' | translate}}</p>\r\n                        <div class=\"alignremove\">\r\n                          <mat-form-field>\r\n                            <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb minlength=\"1\" maxlength=\"250\" formControlName=\"instagram\"\r\n                              placeholder=\"{{'profilecreationlist.enteurl' | translate}}\">\r\n                            <mat-error *ngIf=\"socialmediaForm.controls['instagram'].errors?.pattern\">\r\n                              {{'profilecreationlist.invaurl' | translate}}\r\n                            </mat-error>\r\n                          </mat-form-field>\r\n                          <span *ngIf=\"socialmediaForm.controls['instagram'].value\" matTooltip=\"{{'profilecreationlist.dele' | translate}}\"\r\n                            (click)=\"deletesocialmed(3,'instagram')\" class=\"p-l-15 bt-delete\" matSuffix>\r\n                            <i class=\"bgi bgi-delete\"></i>\r\n                          </span>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"eachsociallink\">\r\n                        <img src=\"./assets/images/Linkedinweb.svg\" alt=\"Linked In\">\r\n                        <p class=\"p-l-10\">{{'profilecreationlist.link' | translate}}</p>\r\n                        <div class=\"alignremove\">\r\n                          <mat-form-field>\r\n                            <input matInput app-restrict-input=\"firstspace\" appAlphanumsymb minlength=\"1\" maxlength=\"250\" formControlName=\"linkedin\"\r\n                              placeholder=\"{{'profilecreationlist.enteurl' | translate}}\">\r\n                            <mat-error *ngIf=\"socialmediaForm.controls['linkedin'].errors?.pattern\">\r\n                              {{'profilecreationlist.invaurl' | translate}} \r\n                            </mat-error>\r\n                          </mat-form-field>\r\n                          <span *ngIf=\"socialmediaForm.controls['linkedin'].value\" matTooltip=\"{{'profilecreationlist.dele' | translate}}\"\r\n                            (click)=\"deletesocialmed(4,'linkedin')\" class=\"p-l-15 bt-delete\" matSuffix>\r\n                            <i class=\"bgi bgi-delete\"></i>\r\n                          </span>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                  <div fxLayout=\"row wrap\" class=\"p-t-30\" fxLayoutAlign=\"end\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"alignnext\">\r\n                      <button mat-raised-button color=\"primary\" type=\"button\" class=\"button-40 previous m-r-15\"\r\n                        (click)=\"panelUpdate(3)\">{{'profilecreationlist.prev' | translate}}</button>\r\n                      <button mat-raised-button color=\"primary\" type=\"submit\" [class.previous]=\"!socialmediaForm.valid\"\r\n                        [disabled]=\"socialmediaForm.invalid\" class=\"button-40 saveandnext\">{{'profilecreationlist.save' | translate}}</button>\r\n                    </div>\r\n                  </div>\r\n                </form>\r\n              </mat-expansion-panel>\r\n            </div>\r\n          </div> -->\r\n        <!-- </mat-accordion> -->\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<mat-drawer-container class=\"example-container targetwidth\">\r\n  <mat-drawer #certificatesdrawer disableClose class=\"example-sidenav sidenavsamewidthall\" mode=\"over\" position=\"end\">\r\n    <form [formGroup]=\"certificatelistForm\" (ngSubmit)=\"onSubmitcertifi()\">\r\n      <div fxLayout=\"row wrap\" class=\"tabforclientelenew\">\r\n        <div fxFlex=\"100\" class=\"tabsection\">\r\n          <div fxLayout=\"row wrap\" fxFlexAlign=\"center\" class=\"m-t-0 p-b-0 w-100\">\r\n            <!-- column -->\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\" selectproductheaderwithclose\">\r\n              <div class=\"titletext\">\r\n                <div class=\"closeandadd\">\r\n                  <i mat-button matTooltip=\"{{'profilecreationlist.clos' | translate}}\" aria-label=\"Displays a tooltip\"\r\n                    matTooltipClass=\"custom-tooltip\" (click)=\"showSweetAlert()\" class=\"bgi bgi-close p-l-5 fs-14\"></i>\r\n                  <h5 class=\"m-0 p-l-20 tt\"> {{'profilecreationlist.certs' | translate}}<i class=\"bgi bgi-info\"\r\n                      (click)=\"toggleShowDiv('descriptionnonjsrs');;this.animationState6 = 'out'\"></i></h5>\r\n                </div>\r\n                <div class=\"clearandaddbutton\">\r\n                  <div class=\"infosteplist\" (click)=\"infolisting('infoview');this.animationState = 'out'\">\r\n                    <i class=\"bgi bgi-question cursor-pointer\"\r\n                      matTooltip=\"{{'profilecreationlist.help' | translate}}\"></i>\r\n                  </div>\r\n                  <button type=\"button\" (click)=\"clearformcert()\" mat-raised-button color=\"primary\"\r\n                    class=\"clearbutton height-35 m-r-10 p-l-20 p-r-20\">{{'profilecreationlist.clea' |\r\n                    translate}}</button>\r\n                  <button color=\"preview\" [disabled]=\"certificatelistForm.invalid\" type=\"submit\" mat-raised-button\r\n                    ngClass.xs=\" m-r-15\" ngClass.sm=\" m-r-15\"\r\n                    class=\"addbutton height-35 p-l-20 p-r-20\">{{buttonname}}</button>\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\" class=\"p-t-0 descriptionnonjsrs\"\r\n            [@slideInOut]=\"animationState\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\">\r\n              <mat-card class=\"headerinformationtext sidenavinfotext m-r-0\">\r\n                <mat-card-header>\r\n                  <div class=\"titletext\" fxFlex.xs=\"100\" fxFlex.sm=\"80\" fxFlex.md=\"100\" fxFlex.lg=\"100\" fxFlex.xl=\"100\">\r\n                    <mat-card-subtitle class=\"informationtext fs-14\">\r\n                      {{'profilecreationlist.uplothecert' | translate}}\r\n                    </mat-card-subtitle>\r\n                  </div>\r\n                  <div class=\"selectforward m-r-0\">\r\n                    <div class=\"p-l-15 gotit\">\r\n                      <span (click)=\"toggleShowDiv('descriptionnonjsrs')\" mat-raised-button\r\n                        color=\"primary\">{{'profilecreationlist.okgotit' | translate}} </span>\r\n                    </div>\r\n                  </div>\r\n                </mat-card-header>\r\n              </mat-card>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" fxLayoutAlign=\"flex-start\" class=\"p-t-0 infoview\" [@slideInOut]=\"animationState6\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-0\" id=\"withClear_certficate\">\r\n              <mat-card class=\"headerinformationtext sidenavinfotext m-r-0 infosteps_certficate\">\r\n                <mat-card-header>\r\n                  <div class=\"titletext\">\r\n                    <mat-card-subtitle class=\"informationtext fs-14\">\r\n                      <div>\r\n                        <strong>{{'profilecreationlist.steptoadd' | translate}}</strong>\r\n                        <ul>\r\n                          <li>{{'profilecreationlist.enteyourcert' | translate}}</li>\r\n                          <li>{{'profilecreationlist.seletheissudate' | translate}}</li>\r\n                          <li>{{'profilecreationlist.uploasoft' | translate}}</li>\r\n                          <li>{{'profilecreationlist.uplodocurela' | translate}}</li>\r\n                          <li>{{'profilecreationlist.clickontheaddbutt' | translate}}</li>\r\n                        </ul>\r\n                      </div>\r\n                    </mat-card-subtitle>\r\n                  </div>\r\n                  <div class=\"selectforward m-r-0\">\r\n                    <div class=\"p-l-15 gotit\">\r\n                      <span (click)=\"infolisting('infoview')\" mat-raised-button\r\n                        color=\"primary\">{{'profilecreationlist.okgotit' | translate}} </span>\r\n                    </div>\r\n                  </div>\r\n                </mat-card-header>\r\n              </mat-card>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n      <app-responseloader class=\"aftersearchloaders\" *ngIf=\"initSpinner\"></app-responseloader>\r\n      <div class=\"innnerpartofdrwer\">\r\n\r\n        <div fxLayout=\"row wrap\">\r\n          <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n            <div fxLayout=\"row wrap\">\r\n              <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"p-b-10\">\r\n                <mat-form-field>\r\n                  <input [errorStateMatcher]=\"matcher\" minlength=\"1\" maxlength=\"250\" matInput\r\n                    formControlName=\"certificatetitle\" placeholder=\"{{'profilecreationlist.certtitl' | translate}}\"\r\n                    app-restrict-input=\"firstspace\" required />\r\n                  <mat-error\r\n                    *ngIf=\"certificatelistForm.controls['certificatetitle'].errors?.required && certificatelistForm.controls['certificatetitle'].touched\"\r\n                    class=\"text-danger font-14\">\r\n                    {{'profilecreationlist.entecerttitl' | translate}}\r\n                  </mat-error>\r\n                </mat-form-field>\r\n              </div>\r\n            </div>\r\n            <div class=\"alignfiledscertificate\">\r\n              <div class=\"widthemp\">\r\n                <mat-form-field>\r\n                  <input matInput [max]=\"maxDate\" formControlName=\"dateofissue\"\r\n                    placeholder=\"{{'profilecreationlist.dateofissu' | translate}}\" [matDatepicker]=\"picker1\" readonly\r\n                    required>\r\n                  <mat-datepicker-toggle matSuffix [for]=\"picker1\"></mat-datepicker-toggle>\r\n                  <mat-datepicker #picker1></mat-datepicker>\r\n                  <mat-error\r\n                    *ngIf=\"certificatelistForm.controls['dateofissue'].errors?.required && certificatelistForm.controls['dateofissue'].touched\"\r\n                    class=\"text-danger font-14\">\r\n                    {{'profilecreationlist.seledateofissu' | translate}}\r\n                  </mat-error>\r\n                </mat-form-field>\r\n              </div>\r\n            </div>\r\n            <div class=\"uploadlabel letterfieldmand\">\r\n              <h4 class=\"fs-15 m-b-20 m-t-20 importantfield\">{{'profilecreationlist.uplocert' | translate}}</h4>\r\n            </div>\r\n            <app-filee #certificateFile [notePosition]=\"'bottom'\" [fileMstRef]=\"drvInput\"\r\n              (filesSelected)=\"fileeSelected($event,drvInput)\" formControlName=\"certificateFileUpload\">\r\n            </app-filee>\r\n            <div class=\"uploadlabel letterfieldmand m-t-30\">\r\n              <h4 class=\"fs-15 m-b-20\">{{'profilecreationlist.reladocu' | translate}}</h4>\r\n            </div>\r\n            <app-filee #relateddocument [notePosition]=\"'bottom'\" [fileMstRef]=\"relateddoc\"\r\n              (filesSelected)=\"fileeSelected($event,relateddoc)\" formControlName=\"relateddocument\">\r\n            </app-filee>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </form>\r\n  </mat-drawer>\r\n</mat-drawer-container>\r\n\r\n\r\n\r\n<mat-drawer-container class=\"example-container mappingwidth\">\r\n  <mat-drawer #mappingdrawer disableClose class=\"example-sidenav sidenavsamewidthall mappingsidenavwidth\" mode=\"over\"\r\n    position=\"end\">\r\n    <app-mapcommunicateaddresslist (valueChange)='updatecommunadd($event)' [addressid]=\"addressid\"\r\n      [mappingdrawer]=\"mappingdrawer\">\r\n    </app-mapcommunicateaddresslist>\r\n  </mat-drawer>\r\n</mat-drawer-container>\r\n\r\n<mat-drawer-container class=\"example-container\">\r\n  <mat-drawer disableClose #addbusinessunitmcp class=\"example-sidenav sidenavsamewidthall\" mode=\"over\" position=\"end\">\r\n    <app-addsectoractivities #refBusinessunit [dataSource]=\"dataSource2\" [drawer]=\"addbusinessunitmcp\"\r\n      (bunitReload)=\"bunitReload($event)\"></app-addsectoractivities>\r\n  </mat-drawer>\r\n</mat-drawer-container>\r\n\r\n<mat-drawer-container class=\"example-container\">\r\n  <mat-drawer disableClose #drawerdepartment class=\"example-sidenav sidenavsamewidthall\" mode=\"over\" position=\"end\">\r\n    <app-adddepartment #refBunitDept [drawerdepartment]=\"drawerdepartment\" (deptReload)=\"deptReload($event)\">\r\n    </app-adddepartment>\r\n  </mat-drawer>\r\n</mat-drawer-container>");

/***/ }),

/***/ "./src/app/common/city/service/city.service.ts":
/*!*****************************************************!*\
  !*** ./src/app/common/city/service/city.service.ts ***!
  \*****************************************************/
/*! exports provided: CityService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "CityService", function() { return CityService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/http */ "./node_modules/@angular/http/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var rxjs_add_observable_of__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/add/observable/of */ "./node_modules/rxjs-compat/_esm2015/add/observable/of.js");





let _url;
let CityService = class CityService {
    constructor(_http) {
        this._http = _http;
        this._url = 'mst/citymaster/';
        this.filterurl = 'mst/citymaster/index';
    }
    createcity(formvalues, moduleID, accessType) {
        const body = JSON.stringify({ 'citymaster': formvalues });
        return this._http.post(this._url + 'newcity' + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
    }
    updatecity(id, formvalues, moduleID, accessType) {
        const body = JSON.stringify({ 'citymaster': formvalues });
        return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
    }
    getcity() {
        return this._http.get(this._url + 'citylist').map(res => res.json());
    }
    getcitybyid(id, moduleID, accessType) {
        return this._http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
    }
    getcitybystateid(id, moduleID, accessType) {
        return this._http.get(this._url + 'getcitybystateid?stateid=' + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
    }
    editcity(id, moduleID, accessType) {
        return this._http.get(this._url + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
    }
    updatestatus(id, moduleID, accessType) {
        const body = JSON.stringify({ 'updatestatus': id });
        return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
    }
    deletecity(id, moduleID, accessType) {
        return this._http.delete(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
    }
    citytablefilter(filterpagestring, name, status) {
        const options = new _angular_http__WEBPACK_IMPORTED_MODULE_2__["RequestOptions"]({
            headers: new _angular_http__WEBPACK_IMPORTED_MODULE_2__["Headers"]({})
        });
        const url_params = `${this.filterurl}?${filterpagestring}&CM_CityName_en=${name}&type=${'filter'}&CM_Status=${status}`;
        return this._http.get(url_params, options).map(res => res.json());
    }
    citylist() {
        return this._http.get(this._url + 'citylist').map(res => res.json());
    }
};
CityService.ctorParameters = () => [
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"] }
];
CityService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]])
], CityService);



/***/ }),

/***/ "./src/app/common/directives/atleastone.ts":
/*!*************************************************!*\
  !*** ./src/app/common/directives/atleastone.ts ***!
  \*************************************************/
/*! exports provided: atLeastOne */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "atLeastOne", function() { return atLeastOne; });
const atLeastOne = (validator, controls) => (formgroup) => {
    if (!controls) {
        controls = Object.keys(formgroup.controls);
    }
    const hasAtLeastOne = formgroup && formgroup.controls && controls
        .some(k => !validator(formgroup.controls[k]));
    return hasAtLeastOne ? null : {
        atLeastOne: true,
    };
};


/***/ }),

/***/ "./src/app/common/state/service/state.service.ts":
/*!*******************************************************!*\
  !*** ./src/app/common/state/service/state.service.ts ***!
  \*******************************************************/
/*! exports provided: StateService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "StateService", function() { return StateService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/http */ "./node_modules/@angular/http/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var rxjs_add_observable_of__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/add/observable/of */ "./node_modules/rxjs-compat/_esm2015/add/observable/of.js");





let StateService = class StateService {
    constructor(_http) {
        this._http = _http;
        this._url = 'mst/statemaster/';
        this.filterurl = 'mst/statemaster/index';
    }
    createState(formvalues, moduleID, accessType) {
        const body = JSON.stringify({ 'statemaster': formvalues });
        return this._http.post(this._url + 'newstate' + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
    }
    updateState(id, formvalues, moduleID, accessType) {
        const body = JSON.stringify({ 'statemaster': formvalues });
        return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body).map(res => res.json());
    }
    getState(offset, pageindex) {
        this._url = 'http://' + window.location.hostname + '/bgiv3/server/api/web/v1/statemsttbls?offset=' + offset + '&pageindex=' + pageindex;
        return this._http.get(this._url).map(res => res.json());
    }
    getstatebyid(id, moduleID, accessType) {
        return this._http.get(this._url + 'statelistbycountry?countryid=' + id + '&uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
    }
    editState(id, moduleID, accessType) {
        return this._http.get(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType).map(res => res.json());
    }
    updatestatus(id, moduleID, accessType) {
        const body = JSON.stringify({ 'updatestatus': id });
        return this._http.put(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType, body);
    }
    deletestate(id, moduleID, accessType) {
        return this._http.delete(this._url + id + '?uac=f3f86bb473399a2239202c31420a1ee1&uam=' + moduleID + '&uat=' + accessType);
    }
    statetablefilter(filterpagestring, countryname, statename, status) {
        const options = new _angular_http__WEBPACK_IMPORTED_MODULE_2__["RequestOptions"]({
            headers: new _angular_http__WEBPACK_IMPORTED_MODULE_2__["Headers"]({})
        });
        const urlparams = `${this.filterurl}?${filterpagestring}&CyM_CountryName_en=${countryname}&SM_StateName_en=${statename}&SM_Status=${status}&type=${'filter'}`;
        return this._http.get(urlparams, options).map(res => res.json());
    }
};
StateService.ctorParameters = () => [
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"] }
];
StateService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]])
], StateService);



/***/ }),

/***/ "./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.scss":
/*!************************************************************************************************************!*\
  !*** ./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.scss ***!
  \************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#regofflistview .regofficelistview .countryalign {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n}\n#regofflistview .regofficelistview .countryalign .countrytextcolor {\n  min-width: 230px;\n}\n#regofflistview .regofficelistview .countryalign p, #regofflistview .regofficelistview .countryalign .offeredview .alignchecking .officeaddresscolor span, #regofflistview .regofficelistview .offeredview .alignchecking .officeaddresscolor .countryalign span, #regofflistview .regofficelistview .countryalign .offeredview .alignchecking .noteintercolor p span, #regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor p .countryalign span {\n  color: #666666 !important;\n  margin: 0px;\n  font-size: 14px !important;\n}\n#regofflistview .regofficelistview .countryalign span {\n  color: #333333;\n  margin: 0px;\n  font-size: 0.9375rem;\n}\n#regofflistview .regofficelistview .offeredview {\n  border-bottom: 1px solid #dadada;\n}\n#regofflistview .regofficelistview .offeredview .regofficetextcolor h2 {\n  font-size: 0.9375rem;\n  color: #333333;\n  margin: 0px;\n}\n#regofflistview .regofficelistview .offeredview .alignchecking {\n  display: flex;\n  justify-content: flex-start;\n  padding-bottom: 20px;\n}\n#regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor {\n  padding-left: 10px;\n}\n#regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor h2 {\n  font-size: 1rem;\n  color: #333333;\n  margin: 0px;\n}\n#regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor p, #regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor .officeaddresscolor span, #regofflistview .regofficelistview .offeredview .alignchecking .officeaddresscolor .noteintercolor span, #regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor p span {\n  margin: 0px;\n}\n#regofflistview .regofficelistview .offeredview .alignchecking .officeaddresscolor p, #regofflistview .regofficelistview .offeredview .alignchecking .officeaddresscolor span, #regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor .officeaddresscolor span span, #regofflistview .regofficelistview .offeredview .alignchecking .officeaddresscolor .noteintercolor span span, #regofflistview .regofficelistview .offeredview .alignchecking .officeaddresscolor .noteintercolor p span, #regofflistview .regofficelistview .offeredview .alignchecking .noteintercolor p .officeaddresscolor span {\n  margin: 0px;\n}\n@media (max-width: 767px) {\n  #regofflistview .alignchecking {\n    display: block !important;\n  }\n  #regofflistview .alignchecking .noteintercolor {\n    padding-left: 0px !important;\n  }\n  #regofflistview .countryalign {\n    display: block !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9wcm9maWxlY3JlYXRpb24vbWFwY29tbXVuaWNhdGVhZGRyZXNzbGlzdC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxwcm9maWxlY3JlYXRpb25cXG1hcGNvbW11bmljYXRlYWRkcmVzc2xpc3RcXG1hcGNvbW11bmljYXRlYWRkcmVzc2xpc3QuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvcHJvZmlsZWNyZWF0aW9uL21hcGNvbW11bmljYXRlYWRkcmVzc2xpc3QvbWFwY29tbXVuaWNhdGVhZGRyZXNzbGlzdC5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUE0QlE7RUFuQkosYUFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7QUNQSjtBRDBCWTtFQUNJLGdCQUFBO0FDeEJoQjtBRDBCWTtFQUNJLHlCQUFBO0VBQ0EsV0FBQTtFQUNBLDBCQUFBO0FDeEJoQjtBRDBCWTtFQUNJLGNBQUE7RUFDQSxXQUFBO0VBQ0Esb0JBQUE7QUN4QmhCO0FEMkJRO0VBQ0ksZ0NBQUE7QUN6Qlo7QUQyQmdCO0VBQ0ksb0JBQUE7RUFDQSxjQUFBO0VBQ0EsV0FBQTtBQ3pCcEI7QUQ0Qlk7RUFDTSxhQUFBO0VBQ0EsMkJBQUE7RUFDQSxvQkFBQTtBQzFCbEI7QUQyQmtCO0VBQ0ksa0JBQUE7QUN6QnRCO0FEMEJ1QjtFQUNFLGVBQUE7RUFDQSxjQUFBO0VBQ0EsV0FBQTtBQ3hCekI7QUQwQnVCO0VBRUcsV0FBQTtBQ3pCMUI7QURnQ3NCO0VBQ0UsV0FBQTtBQzlCeEI7QUQyQ0E7RUFFUTtJQUNJLHlCQUFBO0VDMUNWO0VEMkNXO0lBQ0csNEJBQUE7RUN6Q2Q7RUQ0Q007SUFDSSx5QkFBQTtFQzFDVjtBQUNGIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9wcm9maWxlY3JlYXRpb24vbWFwY29tbXVuaWNhdGVhZGRyZXNzbGlzdC9tYXBjb21tdW5pY2F0ZWFkZHJlc3NsaXN0LmNvbXBvbmVudC5zY3NzIiwic291cmNlc0NvbnRlbnQiOlsiXHJcblxyXG5AbWl4aW4gZmxleGNlbnRlciB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbkBtaXhpbiBmbGV4c3RhcnQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIGZsZXhlbmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuXHJcbkBtaXhpbiBzcGFjZWJldHdlZW4ge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbn1cclxuXHJcbiNyZWdvZmZsaXN0dmlld3tcclxuICAgIC5yZWdvZmZpY2VsaXN0dmlld3tcclxuICAgICAgICAuY291bnRyeWFsaWdue1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgICAgICAgICAgLmNvdW50cnl0ZXh0Y29sb3J7XHJcbiAgICAgICAgICAgICAgICBtaW4td2lkdGg6IDIzMHB4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIHB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzY2NjY2NiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDE0cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBzcGFue1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5vZmZlcmVkdmlld3tcclxuICAgICAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkYWRhZGE7XHJcbiAgICAgICAgICAgIC5yZWdvZmZpY2V0ZXh0Y29sb3J7XHJcbiAgICAgICAgICAgICAgICBoMntcclxuICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAuYWxpZ25jaGVja2luZ3tcclxuICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICAgICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMjBweDtcclxuICAgICAgICAgICAgICAgICAgLm5vdGVpbnRlcmNvbG9ye1xyXG4gICAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAxMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgIGgye1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAxcmVtO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICAgcHtcclxuICAgICAgICAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBtYXJnaW46IDBweDsgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgc3BhbntcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQGV4dGVuZCBwO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgLm9mZmljZWFkZHJlc3Njb2xvcntcclxuICAgICAgICAgICAgICAgICAgICAgIHB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbjogMHB4OyAgXHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICBzcGFue1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIEBleHRlbmQgcDtcclxuICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgXHJcbiAgICB9XHJcbn1cclxuXHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpe1xyXG4gICAgI3JlZ29mZmxpc3R2aWV3e1xyXG4gICAgICAgIC5hbGlnbmNoZWNraW5ne1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgLm5vdGVpbnRlcmNvbG9ye1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAuY291bnRyeWFsaWdue1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufSIsIiNyZWdvZmZsaXN0dmlldyAucmVnb2ZmaWNlbGlzdHZpZXcgLmNvdW50cnlhbGlnbiB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAuY291bnRyeWFsaWduIC5jb3VudHJ5dGV4dGNvbG9yIHtcbiAgbWluLXdpZHRoOiAyMzBweDtcbn1cbiNyZWdvZmZsaXN0dmlldyAucmVnb2ZmaWNlbGlzdHZpZXcgLmNvdW50cnlhbGlnbiBwLCAjcmVnb2ZmbGlzdHZpZXcgLnJlZ29mZmljZWxpc3R2aWV3IC5jb3VudHJ5YWxpZ24gLm9mZmVyZWR2aWV3IC5hbGlnbmNoZWNraW5nIC5vZmZpY2VhZGRyZXNzY29sb3Igc3BhbiwgI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm9mZmljZWFkZHJlc3Njb2xvciAuY291bnRyeWFsaWduIHNwYW4sICNyZWdvZmZsaXN0dmlldyAucmVnb2ZmaWNlbGlzdHZpZXcgLmNvdW50cnlhbGlnbiAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm5vdGVpbnRlcmNvbG9yIHAgc3BhbiwgI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm5vdGVpbnRlcmNvbG9yIHAgLmNvdW50cnlhbGlnbiBzcGFuIHtcbiAgY29sb3I6ICM2NjY2NjYgIWltcG9ydGFudDtcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMTRweCAhaW1wb3J0YW50O1xufVxuI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAuY291bnRyeWFsaWduIHNwYW4ge1xuICBjb2xvcjogIzMzMzMzMztcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcge1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RhZGFkYTtcbn1cbiNyZWdvZmZsaXN0dmlldyAucmVnb2ZmaWNlbGlzdHZpZXcgLm9mZmVyZWR2aWV3IC5yZWdvZmZpY2V0ZXh0Y29sb3IgaDIge1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgY29sb3I6ICMzMzMzMzM7XG4gIG1hcmdpbjogMHB4O1xufVxuI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIHBhZGRpbmctYm90dG9tOiAyMHB4O1xufVxuI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm5vdGVpbnRlcmNvbG9yIHtcbiAgcGFkZGluZy1sZWZ0OiAxMHB4O1xufVxuI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm5vdGVpbnRlcmNvbG9yIGgyIHtcbiAgZm9udC1zaXplOiAxcmVtO1xuICBjb2xvcjogIzMzMzMzMztcbiAgbWFyZ2luOiAwcHg7XG59XG4jcmVnb2ZmbGlzdHZpZXcgLnJlZ29mZmljZWxpc3R2aWV3IC5vZmZlcmVkdmlldyAuYWxpZ25jaGVja2luZyAubm90ZWludGVyY29sb3IgcCwgI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm5vdGVpbnRlcmNvbG9yIC5vZmZpY2VhZGRyZXNzY29sb3Igc3BhbiwgI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm9mZmljZWFkZHJlc3Njb2xvciAubm90ZWludGVyY29sb3Igc3BhbiwgI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm5vdGVpbnRlcmNvbG9yIHAgc3BhbiB7XG4gIG1hcmdpbjogMHB4O1xufVxuI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm9mZmljZWFkZHJlc3Njb2xvciBwLCAjcmVnb2ZmbGlzdHZpZXcgLnJlZ29mZmljZWxpc3R2aWV3IC5vZmZlcmVkdmlldyAuYWxpZ25jaGVja2luZyAub2ZmaWNlYWRkcmVzc2NvbG9yIHNwYW4sICNyZWdvZmZsaXN0dmlldyAucmVnb2ZmaWNlbGlzdHZpZXcgLm9mZmVyZWR2aWV3IC5hbGlnbmNoZWNraW5nIC5ub3RlaW50ZXJjb2xvciAub2ZmaWNlYWRkcmVzc2NvbG9yIHNwYW4gc3BhbiwgI3JlZ29mZmxpc3R2aWV3IC5yZWdvZmZpY2VsaXN0dmlldyAub2ZmZXJlZHZpZXcgLmFsaWduY2hlY2tpbmcgLm9mZmljZWFkZHJlc3Njb2xvciAubm90ZWludGVyY29sb3Igc3BhbiBzcGFuLCAjcmVnb2ZmbGlzdHZpZXcgLnJlZ29mZmljZWxpc3R2aWV3IC5vZmZlcmVkdmlldyAuYWxpZ25jaGVja2luZyAub2ZmaWNlYWRkcmVzc2NvbG9yIC5ub3RlaW50ZXJjb2xvciBwIHNwYW4sICNyZWdvZmZsaXN0dmlldyAucmVnb2ZmaWNlbGlzdHZpZXcgLm9mZmVyZWR2aWV3IC5hbGlnbmNoZWNraW5nIC5ub3RlaW50ZXJjb2xvciBwIC5vZmZpY2VhZGRyZXNzY29sb3Igc3BhbiB7XG4gIG1hcmdpbjogMHB4O1xufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XG4gICNyZWdvZmZsaXN0dmlldyAuYWxpZ25jaGVja2luZyB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuICAjcmVnb2ZmbGlzdHZpZXcgLmFsaWduY2hlY2tpbmcgLm5vdGVpbnRlcmNvbG9yIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG4gICNyZWdvZmZsaXN0dmlldyAuY291bnRyeWFsaWduIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICB9XG59Il19 */");

/***/ }),

/***/ "./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.ts":
/*!**********************************************************************************************************!*\
  !*** ./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.ts ***!
  \**********************************************************************************************************/
/*! exports provided: MapcommunicateaddresslistComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MapcommunicateaddresslistComponent", function() { return MapcommunicateaddresslistComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! sweetalert */ "./node_modules/sweetalert/dist/sweetalert.min.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/material/sidenav */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
/* harmony import */ var _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/modules/profilemanagement/profile.service */ "./src/app/modules/profilemanagement/profile.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");









let MapcommunicateaddresslistComponent = class MapcommunicateaddresslistComponent {
    constructor(translate, remoteService, cookieService, profileservice) {
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.profileservice = profileservice;
        this.animationState3 = 'out';
        this.buttonname = this.i18n('mapcommunicte.map');
        this.headoffice = [];
        this.branchoffice = [];
        this.registedoffice = [];
        this.representativeoff = [];
        this.valueChange = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.addressmap = new _angular_forms__WEBPACK_IMPORTED_MODULE_3__["FormControl"]('', _angular_forms__WEBPACK_IMPORTED_MODULE_3__["Validators"].required);
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = "ltr";
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
        this.profileservice.getcommunicadd().subscribe(returndata => {
            this.headoffice = returndata.data['headquoff'];
            this.branchoffice = returndata.data['branchoff'];
            this.registedoffice = returndata.data['registedoff'];
            this.representativeoff = returndata.data['represetiveoff'];
        });
    }
    ngOnChanges() {
        if (this.addressid) {
            this.buttonname = this.i18n('mapcommunicte.upda');
            this.selectedStatus = this.addressid;
            this.addressmap.setValue(this.addressid);
        }
    }
    mapcommincatelistview(divName) {
        if (divName === 'mappinglistview') {
            this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
        }
    }
    onSubmitcommunicadd(type) {
        if (this.addressmap.valid || type == 'Update') {
            this.profileservice.savecommunadduserinfo(this.addressmap.value).subscribe(resdata => {
                this.buttonname = this.i18n('mapcommunicte.map');
                this.resultmsg = resdata.data['statusmsg'];
                if (this.resultmsg == "success") {
                    this.valueChange.emit(resdata.data['returndata']);
                    this.mappingdrawer.toggle();
                }
            });
        }
    }
    clearformadd() {
        this.addressmap.reset();
    }
    mappingAlert() {
        sweetalert__WEBPACK_IMPORTED_MODULE_2___default()({
            title: this.i18n('mapcommunicte.doyouwantcommaddr'),
            text: this.i18n('mapcommunicte.allthedata'),
            icon: 'warning',
            closeOnClickOutside: false,
            closeOnEsc: false,
            buttons: [this.i18n('mapcommunicte.canc'), this.i18n('mapcommunicte.okbutton')],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                if (this.addressid) {
                    this.selectedStatus = this.addressid;
                    this.addressmap.setValue(this.addressid);
                }
                this.mappingdrawer.toggle();
            }
        });
        this.animationState3 = 'out';
    }
};
MapcommunicateaddresslistComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_7__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"] },
    { type: _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_5__["ProfileService"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])('mappingdrawer'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_4__["MatDrawer"])
], MapcommunicateaddresslistComponent.prototype, "mappingdrawer", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], MapcommunicateaddresslistComponent.prototype, "resultmsg", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)
], MapcommunicateaddresslistComponent.prototype, "addressid", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], MapcommunicateaddresslistComponent.prototype, "valueChange", void 0);
MapcommunicateaddresslistComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-mapcommunicateaddresslist',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./mapcommunicateaddresslist.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.html")).default,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./mapcommunicateaddresslist.component.scss */ "./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_7__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"], _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_5__["ProfileService"]])
], MapcommunicateaddresslistComponent);



/***/ }),

/***/ "./src/app/modules/profilecreation/profilecreation-routing.module.ts":
/*!***************************************************************************!*\
  !*** ./src/app/modules/profilecreation/profilecreation-routing.module.ts ***!
  \***************************************************************************/
/*! exports provided: ProfilecreationRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ProfilecreationRoutingModule", function() { return ProfilecreationRoutingModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/auth/auth.guard */ "./src/app/auth/auth.guard.ts");
/* harmony import */ var _profilecreationlist_profilecreationlist_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./profilecreationlist/profilecreationlist.component */ "./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.ts");
/* harmony import */ var _profilelistview_profilelistview_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./profilelistview/profilelistview.component */ "./src/app/modules/profilecreation/profilelistview/profilelistview.component.ts");






const routes = [
    {
        path: '',
        children: [
            {
                path: 'profilecreationlist',
                component: _profilecreationlist_profilecreationlist_component__WEBPACK_IMPORTED_MODULE_4__["ProfilecreationlistComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'User Profile | OPAL',
                },
            },
            {
                path: 'profilelistview',
                component: _profilelistview_profilelistview_component__WEBPACK_IMPORTED_MODULE_5__["ProfilelistviewComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
                data: {
                    title: 'User Profile | OPAL',
                },
            },
            {
                path: 'profilelistview/:id',
                component: _profilelistview_profilelistview_component__WEBPACK_IMPORTED_MODULE_5__["ProfilelistviewComponent"],
                canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]]
            },
        ]
    }
];
let ProfilecreationRoutingModule = class ProfilecreationRoutingModule {
};
ProfilecreationRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })
], ProfilecreationRoutingModule);



/***/ }),

/***/ "./src/app/modules/profilecreation/profilecreation.module.ts":
/*!*******************************************************************!*\
  !*** ./src/app/modules/profilecreation/profilecreation.module.ts ***!
  \*******************************************************************/
/*! exports provided: createTranslateLoader, ProfilecreationModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function() { return createTranslateLoader; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ProfilecreationModule", function() { return ProfilecreationModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
/* harmony import */ var ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ngx-perfect-scrollbar */ "./node_modules/ngx-perfect-scrollbar/__ivy_ngcc__/dist/ngx-perfect-scrollbar.es5.js");
/* harmony import */ var _profilecreation_routing_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./profilecreation-routing.module */ "./src/app/modules/profilecreation/profilecreation-routing.module.ts");
/* harmony import */ var _profilecreationlist_profilecreationlist_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./profilecreationlist/profilecreationlist.component */ "./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.ts");
/* harmony import */ var _mapcommunicateaddresslist_mapcommunicateaddresslist_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./mapcommunicateaddresslist/mapcommunicateaddresslist.component */ "./src/app/modules/profilecreation/mapcommunicateaddresslist/mapcommunicateaddresslist.component.ts");
/* harmony import */ var _app_shared__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @app/@shared */ "./src/app/@shared/index.ts");
/* harmony import */ var _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/material/datepicker */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/datepicker.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @angular/material/snack-bar */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/snack-bar.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_tooltip__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @angular/material/tooltip */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tooltip.js");
/* harmony import */ var _profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../profilemanagement/profile.service */ "./src/app/modules/profilemanagement/profile.service.ts");
/* harmony import */ var _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! @app/common/state/service/state.service */ "./src/app/common/state/service/state.service.ts");
/* harmony import */ var _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! @app/common/city/service/city.service */ "./src/app/common/city/service/city.service.ts");
/* harmony import */ var _app_shared_util__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! @app/@shared/util */ "./src/app/@shared/util.ts");
/* harmony import */ var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! @angular/flex-layout */ "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
/* harmony import */ var _angular_material_autocomplete__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! @angular/material/autocomplete */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/autocomplete.js");
/* harmony import */ var _angular_material_button__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! @angular/material/button */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/button.js");
/* harmony import */ var _angular_material_button_toggle__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! @angular/material/button-toggle */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/button-toggle.js");
/* harmony import */ var _angular_material_card__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! @angular/material/card */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/card.js");
/* harmony import */ var _angular_material_checkbox__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! @angular/material/checkbox */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/checkbox.js");
/* harmony import */ var _angular_material_chips__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! @angular/material/chips */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/chips.js");
/* harmony import */ var _angular_material_dialog__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! @angular/material/dialog */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/dialog.js");
/* harmony import */ var _angular_material_expansion__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! @angular/material/expansion */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/expansion.js");
/* harmony import */ var _angular_material_grid_list__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! @angular/material/grid-list */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/grid-list.js");
/* harmony import */ var _angular_material_icon__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! @angular/material/icon */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/icon.js");
/* harmony import */ var _angular_material_list__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(/*! @angular/material/list */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/list.js");
/* harmony import */ var _angular_material_input__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(/*! @angular/material/input */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/input.js");
/* harmony import */ var _angular_material_menu__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(/*! @angular/material/menu */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/menu.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_material_progress_bar__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(/*! @angular/material/progress-bar */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/progress-bar.js");
/* harmony import */ var _angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(/*! @angular/material/progress-spinner */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/progress-spinner.js");
/* harmony import */ var _angular_material_radio__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(/*! @angular/material/radio */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/radio.js");
/* harmony import */ var _angular_material_select__WEBPACK_IMPORTED_MODULE_35__ = __webpack_require__(/*! @angular/material/select */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/select.js");
/* harmony import */ var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_36__ = __webpack_require__(/*! @angular/material/sidenav */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
/* harmony import */ var _angular_material_slider__WEBPACK_IMPORTED_MODULE_37__ = __webpack_require__(/*! @angular/material/slider */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/slider.js");
/* harmony import */ var _angular_material_slide_toggle__WEBPACK_IMPORTED_MODULE_38__ = __webpack_require__(/*! @angular/material/slide-toggle */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/slide-toggle.js");
/* harmony import */ var _angular_material_stepper__WEBPACK_IMPORTED_MODULE_39__ = __webpack_require__(/*! @angular/material/stepper */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/stepper.js");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_40__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_41__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_42__ = __webpack_require__(/*! @angular/material/tabs */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
/* harmony import */ var _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_43__ = __webpack_require__(/*! @angular/material/toolbar */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/toolbar.js");
/* harmony import */ var ngx_smart_popover__WEBPACK_IMPORTED_MODULE_44__ = __webpack_require__(/*! ngx-smart-popover */ "./node_modules/ngx-smart-popover/__ivy_ngcc__/fesm2015/ngx-smart-popover.js");
/* harmony import */ var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_45__ = __webpack_require__(/*! @ngx-translate/http-loader */ "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_46__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_47__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var mat_progress_buttons__WEBPACK_IMPORTED_MODULE_48__ = __webpack_require__(/*! mat-progress-buttons */ "./node_modules/mat-progress-buttons/__ivy_ngcc__/fesm2015/mat-progress-buttons.js");





const DEFAULT_PERFECT_SCROLLBAR_CONFIG = {
    suppressScrollX: true
};













































function createTranslateLoader(http) {
    return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_45__["TranslateHttpLoader"](http, './assets/i18n/dashboard/', '.json');
}
let ProfilecreationModule = class ProfilecreationModule {
};
ProfilecreationModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        declarations: [_profilecreationlist_profilecreationlist_component__WEBPACK_IMPORTED_MODULE_5__["ProfilecreationlistComponent"], _mapcommunicateaddresslist_mapcommunicateaddresslist_component__WEBPACK_IMPORTED_MODULE_6__["MapcommunicateaddresslistComponent"]],
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"],
            _app_shared__WEBPACK_IMPORTED_MODULE_7__["SharedModule"],
            ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_3__["PerfectScrollbarModule"],
            _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"],
            ngx_smart_popover__WEBPACK_IMPORTED_MODULE_44__["PopoverModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_11__["ReactiveFormsModule"],
            _profilecreation_routing_module__WEBPACK_IMPORTED_MODULE_4__["ProfilecreationRoutingModule"],
            _angular_flex_layout__WEBPACK_IMPORTED_MODULE_17__["FlexLayoutModule"],
            _angular_material_autocomplete__WEBPACK_IMPORTED_MODULE_18__["MatAutocompleteModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormsModule"],
            _angular_material_button__WEBPACK_IMPORTED_MODULE_19__["MatButtonModule"],
            _angular_material_button_toggle__WEBPACK_IMPORTED_MODULE_20__["MatButtonToggleModule"],
            _angular_material_card__WEBPACK_IMPORTED_MODULE_21__["MatCardModule"],
            _angular_material_checkbox__WEBPACK_IMPORTED_MODULE_22__["MatCheckboxModule"],
            _angular_material_chips__WEBPACK_IMPORTED_MODULE_23__["MatChipsModule"],
            _angular_material_datepicker__WEBPACK_IMPORTED_MODULE_8__["MatDatepickerModule"],
            _angular_material_dialog__WEBPACK_IMPORTED_MODULE_24__["MatDialogModule"],
            _angular_material_expansion__WEBPACK_IMPORTED_MODULE_25__["MatExpansionModule"],
            _angular_material_grid_list__WEBPACK_IMPORTED_MODULE_26__["MatGridListModule"],
            _angular_material_icon__WEBPACK_IMPORTED_MODULE_27__["MatIconModule"],
            _angular_material_input__WEBPACK_IMPORTED_MODULE_29__["MatInputModule"],
            _angular_material_list__WEBPACK_IMPORTED_MODULE_28__["MatListModule"],
            _angular_material_menu__WEBPACK_IMPORTED_MODULE_30__["MatMenuModule"],
            _angular_material_core__WEBPACK_IMPORTED_MODULE_31__["MatNativeDateModule"],
            _angular_material_paginator__WEBPACK_IMPORTED_MODULE_9__["MatPaginatorModule"],
            _angular_material_progress_bar__WEBPACK_IMPORTED_MODULE_32__["MatProgressBarModule"],
            _angular_material_progress_spinner__WEBPACK_IMPORTED_MODULE_33__["MatProgressSpinnerModule"],
            _angular_material_radio__WEBPACK_IMPORTED_MODULE_34__["MatRadioModule"],
            _angular_material_core__WEBPACK_IMPORTED_MODULE_31__["MatRippleModule"],
            _angular_material_select__WEBPACK_IMPORTED_MODULE_35__["MatSelectModule"],
            _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_36__["MatSidenavModule"],
            _angular_material_slider__WEBPACK_IMPORTED_MODULE_37__["MatSliderModule"],
            _angular_material_slide_toggle__WEBPACK_IMPORTED_MODULE_38__["MatSlideToggleModule"],
            _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_10__["MatSnackBarModule"],
            _angular_material_sort__WEBPACK_IMPORTED_MODULE_40__["MatSortModule"],
            _angular_material_table__WEBPACK_IMPORTED_MODULE_41__["MatTableModule"],
            _angular_material_tabs__WEBPACK_IMPORTED_MODULE_42__["MatTabsModule"],
            _angular_material_toolbar__WEBPACK_IMPORTED_MODULE_43__["MatToolbarModule"],
            _angular_material_tooltip__WEBPACK_IMPORTED_MODULE_12__["MatTooltipModule"],
            _angular_material_stepper__WEBPACK_IMPORTED_MODULE_39__["MatStepperModule"],
            mat_progress_buttons__WEBPACK_IMPORTED_MODULE_48__["MatProgressButtonsModule"],
            _ngx_translate_core__WEBPACK_IMPORTED_MODULE_47__["TranslateModule"].forChild({
                loader: {
                    provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_47__["TranslateLoader"],
                    useFactory: createTranslateLoader,
                    deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_46__["HttpClient"]]
                }
            }),
        ],
        providers: [
            {
                provide: ngx_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_3__["PERFECT_SCROLLBAR_CONFIG"],
                useValue: DEFAULT_PERFECT_SCROLLBAR_CONFIG,
            },
            _profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_13__["ProfileService"],
            _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_14__["StateService"],
            _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_15__["CityService"],
            _app_shared_util__WEBPACK_IMPORTED_MODULE_16__["Util"],
        ],
    })
], ProfilecreationModule);



/***/ }),

/***/ "./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.scss":
/*!************************************************************************************************!*\
  !*** ./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.scss ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (".pointer {\n  cursor: pointer;\n}\n\n.select_with_search {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 40px !important;\n  margin-bottom: 15px !important;\n}\n\n.widthimg {\n  width: 24px;\n  height: 16px;\n  margin-right: 5px;\n}\n\n#withClear_certficate .infosteps_certficate::after {\n  right: 204px !important;\n  left: auto !important;\n}\n\n.profileviewlist {\n  background: linear-gradient(to bottom, #fff 183px, #fff 145px 40%) !important;\n}\n\n.profileviewlist .addingdepartment {\n  color: #E0AD67;\n  font-size: 0.75rem;\n  cursor: pointer;\n}\n\n.profileviewlist .indexmdespace {\n  z-index: 9;\n}\n\n.profileviewlist .mdepsapce {\n  margin-top: -16px;\n}\n\n.profileviewlist .mdepsapce span {\n  cursor: pointer;\n}\n\n.profileviewlist .bt-delete {\n  cursor: pointer;\n  position: absolute;\n  top: 35px;\n  right: 0px;\n  font-size: 0.75rem;\n}\n\n.profileviewlist .filedborder .mat-form-field-underline {\n  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.42) 0%, rgba(0, 0, 0, 0.42) 33%, transparent 0%);\n  background-size: 4px 100%;\n  background-repeat: repeat-x;\n  background-color: transparent;\n}\n\n.profileviewlist .commonexpandandcollapse mat-expansion-panel.mat-expanded {\n  margin-bottom: 30px !important;\n  margin-top: 30px !important;\n}\n\n.profileviewlist .textorgange {\n  color: #dfad66 !important;\n}\n\n.profileviewlist .alignremovewidth {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n  width: 100%;\n}\n\n.profileviewlist .alignremovewidth span {\n  cursor: pointer;\n}\n\n.profileviewlist .alignremove {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n  width: 100%;\n}\n\n.profileviewlist .alignremove .mat-form-field-appearance-legacy .mat-form-field-underline {\n  height: 1px;\n  background: #c9cbd7;\n}\n\n.profileviewlist .venuewidth {\n  display: flex;\n  justify-content: flex-end;\n}\n\n.profileviewlist .numberandcode .mat-form-field-infix {\n  display: flex !important;\n  align-items: center;\n}\n\n.profileviewlist .alignitems {\n  align-items: center;\n  width: 77%;\n}\n\n@media (max-width: 768px) {\n  .profileviewlist .alignitems {\n    width: 100%;\n  }\n}\n\n.profileviewlist .supervisortextcolor {\n  position: relative;\n}\n\n.profileviewlist .supervisortextcolor p, .profileviewlist .supervisortextcolor .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .supervisortextcolor span {\n  color: #666666;\n  margin: 0px;\n  font-size: 0.875rem;\n}\n\n.profileviewlist .imgalignflex img {\n  width: 70px;\n  height: 70px;\n  -o-object-fit: cover;\n     object-fit: cover;\n  border: 1px solid #d6dbe3;\n  border-radius: 4px;\n}\n\n.profileviewlist .officetext {\n  padding-top: 20px;\n}\n\n.profileviewlist .officetext .changealign {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n}\n\n.profileviewlist .officetext .changealign h2 {\n  color: #333333;\n  font-size: 0.9375rem;\n  margin: 0px;\n}\n\n.profileviewlist .officetext .changealign p, .profileviewlist .officetext .changealign .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .changealign span {\n  font-size: 0.8125rem;\n  cursor: pointer;\n  margin: 0px;\n  color: #f4811f;\n}\n\n.profileviewlist .officetext .papernotecolor h2 {\n  color: #333333;\n  margin: 0px;\n  font-size: 1rem;\n}\n\n.profileviewlist .officetext .papernotecolor p, .profileviewlist .officetext .papernotecolor p span {\n  margin: 0px;\n}\n\n.profileviewlist .officetext .papernotecolor p span {\n  color: #4aa1ac !important;\n}\n\n.profileviewlist .officetext .addresscolor p, .profileviewlist .officetext .addresscolor .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .addresscolor span {\n  margin: 0px;\n  color: #4aa1ac;\n}\n\n.profileviewlist .officetext .addresscolor span {\n  font-size: 0.9375rem;\n}\n\n.profileviewlist .shadowcard {\n  background-color: #fff;\n  border: solid 1px #e2e4e8;\n  box-shadow: none;\n  border-radius: 0;\n  padding: 15px;\n  cursor: pointer;\n}\n\n.profileviewlist .shadowcard .suppliertextcolor span {\n  color: #006cb7;\n  font-size: 1rem;\n  font-weight: bold;\n}\n\n.profileviewlist .shadowcard .mat-card-header {\n  display: flex;\n  width: 100%;\n  align-items: center;\n  justify-content: space-between;\n  padding: 0px;\n}\n\n.profileviewlist .shadowcard .selectjsrtext p, .profileviewlist .shadowcard .selectjsrtext .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .shadowcard .selectjsrtext span {\n  color: #333333;\n  padding-top: 5px;\n  margin: 0px;\n}\n\n.profileviewlist .shadowcard .selectforward {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center;\n}\n\n.profileviewlist .shadowcard .selectforward i {\n  transform: rotate(270deg);\n  color: #777;\n  font-size: 0.875rem;\n}\n\n.profileviewlist .searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 6px 10px;\n  background: #e9edf0;\n}\n\n.profileviewlist .searchinmultiselect input::-webkit-input-placeholder {\n  color: #7f8fa3 !important;\n}\n\n.profileviewlist .searchinmultiselect i {\n  color: #7f8fa3 !important;\n  padding-right: 6px;\n}\n\n.profileviewlist .searchinmultiselect .searchselect {\n  width: calc(100% - 25px) !important;\n}\n\n.profileviewlist .searchinmultiselect .reseticon {\n  cursor: pointer;\n}\n\n.profileviewlist .option-listing {\n  overflow-x: auto;\n  overflow-y: auto;\n  max-height: 290px;\n}\n\n.profileviewlist .flagwithcode img {\n  max-width: 24px;\n  height: 16px;\n}\n\n.profileviewlist .countrynameselect {\n  line-height: 40px !important;\n  height: 40px !important;\n}\n\n.profileviewlist .suptextcolor p, .profileviewlist .suptextcolor .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .suptextcolor span {\n  cursor: pointer;\n  font-size: 0.8125rem;\n  margin: 0px;\n  color: #4aa1ac;\n  text-align: end;\n}\n\n.profileviewlist .alignpublish {\n  display: flex !important;\n}\n\n.profileviewlist .venuecolor {\n  color: #4aa1ac;\n  font-size: 0.875rem;\n}\n\n.profileviewlist .editanddelete {\n  display: inline-flex;\n  margin-bottom: 10px;\n}\n\n.profileviewlist .editanddelete .edit {\n  color: #999;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n\n.profileviewlist .editanddelete i {\n  font-size: 1rem;\n}\n\n.profileviewlist .editanddelete span {\n  opacity: 0;\n  width: 35px;\n  height: 35px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  cursor: pointer;\n}\n\n.profileviewlist .alignvenue {\n  display: flex;\n  justify-content: flex-end;\n}\n\n.profileviewlist #creationlist .certificateimage i {\n  color: #006cb7;\n}\n\n.profileviewlist #creationlist .addedcertificate {\n  border-bottom: 1px solid #ddd;\n  padding: 20px;\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n\n.profileviewlist #creationlist .addedcertificate:hover .certificateimage {\n  background: #006cb7;\n}\n\n.profileviewlist #creationlist .addedcertificate:hover .certificateimage i {\n  color: #fff;\n}\n\n.profileviewlist #creationlist .addedcertificate:hover .editanddelete span {\n  opacity: 1;\n  background: #fff;\n  color: #5f5353;\n  border-radius: 50%;\n}\n\n.profileviewlist #creationlist .addedcertificate:hover .lablename {\n  color: #006cb7 !important;\n}\n\n.profileviewlist #creationlist .addedcertificate:hover .name {\n  color: #4aa1ac;\n}\n\n.profileviewlist #creationlist .addedcertificate:focus {\n  border: 1px dotted #ddd;\n}\n\n.profileviewlist #creationlist .addedcertificate:active {\n  border: 1px dotted #ddd;\n}\n\n.profileviewlist #creationlist .certificates {\n  display: flex;\n}\n\n.profileviewlist #creationlist .certificateinfo {\n  padding-left: 20px;\n  line-height: 1.8;\n}\n\n.profileviewlist #creationlist .certificateinfo p, .profileviewlist #creationlist .certificateinfo .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p #creationlist .certificateinfo span {\n  font-size: 0.875rem;\n  margin: 0;\n  color: #000;\n  padding-bottom: 10px;\n}\n\n.profileviewlist #creationlist .certificateinfo .cerlabel {\n  color: #999;\n}\n\n.profileviewlist #creationlist .certificateinfo .header {\n  color: #333;\n  font-size: 1.125rem;\n  font-weight: bold;\n  padding-bottom: 15px;\n}\n\n.profileviewlist #creationlist .alignspace {\n  display: flex;\n  justify-content: flex-end;\n}\n\n.profileviewlist #creationlist .companyandofficeinfo p, .profileviewlist #creationlist .companyandofficeinfo .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p #creationlist .companyandofficeinfo span {\n  margin: 0;\n}\n\n.profileviewlist #creationlist .companyandofficeinfo .crandbranchids {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n  padding-top: 10px;\n  padding-bottom: 10px;\n}\n\n.profileviewlist #creationlist .companyandofficeinfo .crandbranchids .count {\n  font-family: \"cairosemibold\";\n}\n\n.profileviewlist #creationlist .companyandofficeinfo .title {\n  color: #999;\n  font-size: 0.75rem;\n  margin: 0;\n  line-height: 0.9;\n  padding-bottom: 6px;\n}\n\n.profileviewlist #creationlist .companyandofficeinfo .lablename {\n  color: #999;\n  font-size: 0.75rem;\n}\n\n.profileviewlist #creationlist .companyandofficeinfo .flexoman span {\n  font-size: 0.9375rem;\n}\n\n.profileviewlist #creationlist .companyandofficeinfo .name {\n  color: #333333;\n  font-size: 0.9375rem;\n  margin: 0px;\n  margin-bottom: 10px;\n  line-height: 22px;\n}\n\n.profileviewlist #creationlist .officeaddressdetail {\n  padding-top: 20px;\n}\n\n.profileviewlist #creationlist .officeaddressdetail .addressinfo {\n  font-size: 0.9375rem;\n}\n\n.profileviewlist #creationlist .certificateimage {\n  position: relative;\n  width: 80px;\n  height: 80px;\n  background: #e5eefe;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n\n.profileviewlist #creationlist .certificateimage img {\n  max-width: 100%;\n}\n\n.profileviewlist #creationlist .countryandcrinfo {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n}\n\n.profileviewlist #creationlist .countryandcrinfo .eachitem {\n  padding-right: 40px;\n}\n\n.profileviewlist #creationlist .countryandcrinfo .eachitem img {\n  width: 22px;\n  padding-right: 8px;\n}\n\n.profileviewlist #creationlist .countryandcrinfo .eachitem:last-child {\n  padding-right: 0;\n}\n\n.profileviewlist #creationlist .countryandcrinfo .eachitem p span, .profileviewlist .officetext .papernotecolor p #creationlist .countryandcrinfo .eachitem span span {\n  color: #4aa1ac !important;\n}\n\n.profileviewlist #creationlist .phonewidth {\n  min-width: 165px;\n}\n\n.profileviewlist #creationlist .countrywidth {\n  min-width: 170px;\n}\n\n.profileviewlist #creationlist .mailwidth {\n  min-width: 210px;\n}\n\n.profileviewlist .eachsociallink {\n  display: flex;\n  align-items: center;\n  padding-bottom: 12px;\n}\n\n.profileviewlist .eachsociallink img {\n  width: 16px;\n  height: 16px;\n}\n\n.profileviewlist .eachsociallink p, .profileviewlist .eachsociallink .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .eachsociallink span {\n  color: #333;\n  margin: 0;\n  min-width: 130px;\n}\n\n.profileviewlist .webtextcolor h2 {\n  color: #341f44;\n  font-size: 0.9375rem;\n  margin: 0px;\n  padding-bottom: 20px;\n}\n\n.profileviewlist .urlalign .mat-form-field-infix {\n  display: flex;\n}\n\n.profileviewlist .lineheight {\n  line-height: 1;\n}\n\n.profileviewlist .alignpreview {\n  display: flex;\n  align-items: center;\n}\n\n.profileviewlist .completed {\n  border: 1px solid #fff;\n  height: 20px;\n  width: 20px;\n  color: #fff;\n  border-radius: 100%;\n  background: #71c114 !important;\n  font-size: 0.6875rem;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  margin-right: 10px;\n}\n\n.profileviewlist .pagenumbercolorblank {\n  border: 1px solid #fff;\n  height: 20px;\n  width: 20px;\n  color: #fff;\n  border-radius: 100%;\n  background: #999999;\n  font-size: 0.6875rem;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n}\n\n.profileviewlist .cancelandpublish {\n  display: flex;\n  justify-content: flex-end;\n  align-items: center !important;\n}\n\n.profileviewlist .saveandnext {\n  background: #4aa1ac;\n  border-radius: 2px;\n  color: #fff !important;\n  font-size: 0.9375rem;\n  min-width: 100px;\n}\n\n.profileviewlist .previous {\n  background: #ececec;\n  border-radius: 2px;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n  font-size: 15px !important;\n  width: auto;\n  min-width: 80px;\n}\n\n.profileviewlist .addbtncolor {\n  background: #ececec;\n  border-radius: 2px;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n  font-size: 15px !important;\n  width: auto;\n}\n\n.profileviewlist .alignnext {\n  display: flex;\n  justify-content: flex-end;\n}\n\n.profileviewlist .publish {\n  min-width: 150px;\n  height: 40px;\n  border-radius: 2px !important;\n}\n\n.profileviewlist .cancel {\n  color: #777;\n  border: 1px solid #cbcbcb;\n  border-radius: 2px !important;\n}\n\n.profileviewlist .countryselectwithimage .mat-option {\n  margin-right: 7px;\n}\n\n.profileviewlist .countryselectwithimage .mat-option-text {\n  display: flex;\n  align-items: center;\n}\n\n.profileviewlist .listbasicinfo .widthfileds {\n  width: 70%;\n}\n\n.profileviewlist .listbasicinfo .widthemp {\n  width: 50%;\n}\n\n.profileviewlist .listbasicinfo .alignfileds {\n  display: flex;\n  justify-content: flex-start;\n}\n\n.profileviewlist .listbasicinfo .backgrounduploadbasicinfo {\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  height: 126px;\n  width: 135px;\n  text-align: center;\n  margin: 2px;\n  padding-top: 20px;\n  padding-bottom: 20px;\n}\n\n.profileviewlist .listbasicinfo .backgrounduploadbasicinfo .viewheight {\n  max-height: 100%;\n}\n\n.profileviewlist .listbasicinfo .backgrounduploadbasicinfo p, .profileviewlist .listbasicinfo .backgrounduploadbasicinfo .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .listbasicinfo .backgrounduploadbasicinfo span {\n  color: #999999;\n  font-size: 0.75rem;\n}\n\n.profileviewlist .listbasicinfo .innerside {\n  padding: 5px;\n  border-radius: 2px;\n  cursor: pointer;\n  width: 23%;\n}\n\n@media (max-width: 768px) {\n  .profileviewlist .listbasicinfo .innerside {\n    width: 100%;\n  }\n}\n\n.targetwidth .alignfiledscertificate {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center;\n}\n\n.targetwidth .alignfiledscertificate .widthemp {\n  width: 50%;\n}\n\n.targetwidth .uploadlabel {\n  position: relative;\n  display: flex;\n  align-items: center;\n}\n\n.targetwidth .uploadlabel h4 {\n  color: #333;\n  margin: 0px;\n}\n\n@media (max-width: 1366px) and (min-width: 1280px) {\n  .mappingwidth .mappingsidenavwidth {\n    width: 75% !important;\n  }\n}\n\n@media (max-width: 1024px) and (min-width: 769px) {\n  .mappingwidth .mappingsidenavwidth {\n    width: 90% !important;\n  }\n}\n\n@media (max-width: 768px) {\n  .supervisortextcolor {\n    position: relative;\n    top: 0px !important;\n  }\n\n  .certificatewidth {\n    max-width: 70% !important;\n  }\n\n  .venuewidth {\n    max-width: 30% !important;\n  }\n\n  .checkevenchild div:nth-of-type(even) {\n    padding-left: 0px !important;\n  }\n  .checkevenchild div:nth-of-type(even) .suptextcolor {\n    position: relative;\n    left: 0;\n    top: 0;\n    display: flex;\n  }\n\n  .lineheight {\n    margin-bottom: 15px !important;\n  }\n\n  .mappingwidth .mappingsidenavwidth {\n    width: 95% !important;\n  }\n\n  .topheadermain {\n    display: flex !important;\n    justify-content: space-between !important;\n  }\n\n  .pagetitlenew {\n    margin-bottom: 10px;\n  }\n\n  .imagealignspace {\n    padding-right: 0px !important;\n  }\n\n  .widthemp {\n    width: 100% !important;\n  }\n\n  .urlalign {\n    padding-left: 0px !important;\n  }\n\n  .alignspace {\n    margin-left: 15px !important;\n  }\n\n  .targetwidth .sidenavsamewidthall {\n    position: fixed !important;\n    min-width: 730px !important;\n  }\n\n  .certificates {\n    display: flex !important;\n  }\n\n  .venuewidthnuber {\n    min-width: 70% !important;\n  }\n\n  .venuewidth {\n    min-width: 30% !important;\n    display: flex;\n  }\n}\n\n@media (max-width: 767px) {\n  .alignblock {\n    display: block !important;\n  }\n\n  .certificatewidth {\n    max-width: 100% !important;\n  }\n\n  .venuewidth {\n    max-width: 100% !important;\n  }\n\n  .marginspace {\n    margin-left: 15px;\n    margin-right: 15px;\n  }\n\n  .profileaccordion .supervisortextcolor {\n    top: 4px !important;\n  }\n  .profileaccordion .bt-delete {\n    top: 50px !important;\n  }\n  .profileaccordion .innerside {\n    padding-left: 0px !important;\n  }\n  .profileaccordion .acceptedcolor {\n    padding-bottom: 10px;\n  }\n  .profileaccordion .alignremove {\n    padding-top: 15px;\n  }\n\n  .red {\n    color: red;\n  }\n\n  .alignblock::after {\n    content: \"(* Required)\";\n    font-size: 0.6875rem;\n    position: relative;\n    top: -2px !important;\n    left: 30px !important;\n    right: 0;\n    color: #ff0000;\n  }\n\n  .backgrounduploadbasicinfo {\n    background: #fff !important;\n  }\n\n  .mappingwidth .mappingsidenavwidth {\n    width: 100% !important;\n  }\n  .mappingwidth .mappingsidenavwidth .selectproductheaderwithclose {\n    height: auto !important;\n  }\n  .mappingwidth .mappingsidenavwidth .selectproductheaderwithclose .titletext {\n    display: block !important;\n  }\n  .mappingwidth .mappingsidenavwidth .selectproductheaderwithclose .closeandadd {\n    margin-bottom: 10px;\n  }\n  .mappingwidth .mappingsidenavwidth .spacing {\n    padding-right: 10px !important;\n  }\n\n  .topheadermain {\n    display: block !important;\n    justify-content: space-between !important;\n  }\n\n  .eachsociallink {\n    display: block !important;\n  }\n\n  .alignfiledscertificate {\n    display: block !important;\n    align-items: center;\n  }\n\n  .eachsociallink p, .eachsociallink .profileviewlist .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .eachsociallink span {\n    padding-left: 0px !important;\n  }\n\n  .alignspace {\n    margin-left: 10px;\n  }\n\n  .addbutton {\n    margin-right: 0px !important;\n  }\n\n  .listbasicinfo .alignfileds {\n    display: block !important;\n    justify-content: flex-start;\n    align-items: center;\n  }\n\n  .topheadermain .imagewithtext {\n    display: flex !important;\n    justify-content: flex-start !important;\n    align-items: center !important;\n    padding-left: 10px;\n    padding-bottom: 10px;\n  }\n\n  .backgrounduploadbasicinfo {\n    width: 100% !important;\n  }\n\n  .alignwidth {\n    display: block !important;\n  }\n\n  .imagealignspace {\n    padding-right: 0px !important;\n  }\n\n  .widthfileds {\n    margin-left: 0px !important;\n  }\n\n  .widthemp {\n    margin-left: 0px !important;\n    width: 100% !important;\n  }\n\n  .spacemargin {\n    margin-right: 0px !important;\n  }\n\n  .topbreadcrumb {\n    padding-left: 10px !important;\n    display: flex;\n  }\n\n  .spancolor {\n    padding-left: 10px !important;\n  }\n\n  .paddingright {\n    padding-right: 12px;\n  }\n\n  .marginright {\n    margin-right: 12px;\n  }\n\n  .companyandofficeinfo {\n    padding-left: 0px !important;\n  }\n\n  .targetwidth .innnerpartofdrwer {\n    padding-bottom: 70px !important;\n    max-height: calc(100vh - 140px) !important;\n    overflow-x: hidden;\n    overflow-y: auto;\n    height: 100%;\n  }\n\n  .targetwidth .sidenavsamewidthall {\n    position: fixed !important;\n    min-width: 300px !important;\n  }\n\n  .selectproductheaderwithclose {\n    height: auto !important;\n  }\n\n  .selectproductheaderwithclose .titletext {\n    display: block !important;\n  }\n\n  .selectproductheaderwithclose .closeandadd {\n    margin-bottom: 10px;\n  }\n\n  .spacing {\n    padding-right: 10px !important;\n  }\n\n  .addedcertificate {\n    padding: 20px;\n    display: block !important;\n    justify-content: space-between;\n    align-items: center;\n    border-bottom: 1px solid #ddd;\n  }\n\n  .editanddelete {\n    display: inline-flex;\n    margin-bottom: 10px;\n    margin-top: 10px;\n  }\n}\n\n.pagetitle {\n  height: 50px;\n  width: 100px;\n  background: #000;\n  position: relative;\n  animation-duration: 1.7s;\n  animation-fill-mode: forwards;\n  animation-iteration-count: infinite;\n  animation-timing-function: linear;\n  animation-name: pagetitleAnimate;\n  background: #f6f7f8;\n  background: linear-gradient(to right, #eee 2%, #ddd 18%, #eee 33%);\n  background-size: 1300px;\n}\n\n@keyframes pagetitleAnimate {\n  0% {\n    background-position: -650px 0;\n  }\n  100% {\n    background-position: 650px 0;\n  }\n}\n\n.skycardloaderitem {\n  height: 50px;\n  width: 210px;\n  background: #000;\n  position: relative;\n  animation-duration: 1.7s;\n  animation-fill-mode: forwards;\n  animation-iteration-count: infinite;\n  animation-timing-function: linear;\n  animation-name: pagetitleAnimate;\n  background: #f6f7f8;\n  background: linear-gradient(to right, #eee 2%, #ddd 18%, #eee 33%);\n  background-size: 1300px;\n}\n\n.skycardloaderitem .skycardloaderitem:before {\n  width: inherit;\n  height: inherit;\n  content: \"\";\n  position: absolute;\n}\n\n@keyframes skycardloaderitemAnimate {\n  0% {\n    background-position: -650px 0;\n  }\n  100% {\n    background-position: 650px 0;\n  }\n}\n\n.placeholdercenter {\n  height: 50px;\n  width: 100%;\n  background: #000;\n  position: relative;\n  animation-duration: 1.7s;\n  animation-fill-mode: forwards;\n  animation-iteration-count: infinite;\n  animation-timing-function: linear;\n  animation-name: pagetitleAnimate;\n  background: #f6f7f8;\n  background: linear-gradient(to right, #eee 1%, #ddd 18%, #eee 33%);\n  background-size: 1300px;\n}\n\n.placeholdercenter .placeholdercenter:before {\n  width: inherit;\n  height: inherit;\n  content: \"\";\n  position: absolute;\n}\n\n@keyframes placeholdercenterAnimate {\n  0% {\n    background-position: -650px 0;\n  }\n  100% {\n    background-position: 650px 0;\n  }\n}\n\n.justify {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n\n.approvalalign {\n  width: 83.33%;\n  margin-left: auto;\n  margin-right: auto;\n}\n\n.cardleftwidth {\n  width: 100%;\n}\n\n.aligncard {\n  display: flex;\n  justify-content: space-between;\n}\n\n.accordionwidth {\n  width: 100%;\n  height: 50px;\n  background: #000;\n  position: relative;\n  animation-duration: 1.7s;\n  animation-fill-mode: forwards;\n  animation-iteration-count: infinite;\n  animation-timing-function: linear;\n  animation-name: pagetitleAnimate;\n  background: #f6f7f8;\n  background: linear-gradient(to right, #eee 1%, #ddd 18%, #eee 33%);\n  background-size: 1300px;\n}\n\n.accordionwidth .accordionwidth:before {\n  width: inherit;\n  height: inherit;\n  content: \"\";\n  position: absolute;\n}\n\n@keyframes accordionwidthAnimate {\n  0% {\n    background-position: -650px 0;\n  }\n  100% {\n    background-position: 650px 0;\n  }\n}\n\n.alignend {\n  display: flex;\n  justify-content: flex-end;\n  align-items: center !important;\n  margin-top: 20px;\n}\n\n@media (min-width: 768px) {\n  .marginspace {\n    margin-left: 15px;\n    margin-right: 15px;\n  }\n\n  .checkevenchild div:nth-of-type(even) {\n    padding-left: 30px;\n  }\n  .checkevenchild div:nth-of-type(even) .alignremove {\n    margin-bottom: 10px;\n  }\n  .checkevenchild div:nth-of-type(even) .suptextcolor {\n    position: relative;\n    left: 15px;\n    top: 15px;\n    display: flex;\n  }\n  .checkevenchild div:nth-of-type(odd) {\n    padding-left: 0px !important;\n  }\n  .checkevenchild div:nth-of-type(odd) .suptextcolor {\n    position: relative;\n    left: 0;\n    top: 0;\n    display: flex;\n  }\n}\n\n.alignremove {\n  position: relative;\n}\n\n.rightsidedetails p, .rightsidedetails .profileviewlist .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .rightsidedetails span {\n  color: #333;\n  font-size: 0.875rem;\n  margin: 0;\n  padding-bottom: 10px;\n}\n\n.acceptedcolor {\n  padding-top: 50px;\n}\n\n.acceptedcolor p, .acceptedcolor .profileviewlist .officetext .papernotecolor p span, .profileviewlist .officetext .papernotecolor p .acceptedcolor span {\n  color: #333;\n  font-size: 0.875rem;\n  margin: 0;\n}\n\n.acceptedcolor span {\n  color: #333;\n  font-size: 0.875rem;\n}\n\n[dir=rtl] .profileviewlist .bt-delete {\n  left: 0px !important;\n  right: 90% !important;\n}\n\n[dir=rtl] .profileviewlist #creationlist .countryandcrinfo .eachitem {\n  padding-right: 0px !important;\n}\n\n[dir=rtl] .checkevenchild div:nth-of-type(even) {\n  padding-left: 0px !important;\n  padding-right: 30px !important;\n}\n\n[dir=rtl] .checkevenchild div:nth-of-type(odd) {\n  padding-left: 0px !important;\n  padding-right: 0px !important;\n}\n\n[dir=rtl] .userprofilmailidmail .mat-form-field-infix {\n  display: flex;\n  align-items: center;\n}\n\n[dir=rtl] .userprofilmailidmail .otpheader_reg #partitioneduserprofile {\n  min-width: 239px !important;\n}\n\n.resendotp button {\n  background: none;\n  border: none;\n  text-decoration: underline;\n  color: #4ca2ac;\n  font-size: 14px;\n  font-family: \"cairoregular\";\n  margin-bottom: 60px;\n  cursor: pointer;\n}\n\n.userprofilmailidmail .mat-form-field-infix {\n  display: flex;\n  align-items: center;\n}\n\n.userprofilmailidmail .otpheader_reg {\n  margin-top: -20px;\n}\n\n.userprofilmailidmail .otpheader_reg .resendotpcolor {\n  color: #4aa2ac !important;\n  text-decoration: underline;\n}\n\n.userprofilmailidmail .otpheader_reg #partitioneduserprofile {\n  letter-spacing: 30px;\n  padding-left: 15px;\n  border: 0;\n  width: 350;\n  min-width: 350px;\n  outline: none;\n  background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);\n  background-position: bottom;\n  background-size: 37px 1px;\n  background-repeat: repeat-x;\n  background-position-x: 35px;\n  outline: none;\n  max-width: 412px;\n}\n\n.userprofilmailidmail .otpheader_reg #divInner {\n  left: 0;\n  position: sticky;\n}\n\n.userprofilmailidmail .otpheader_reg #divOuter {\n  width: 223px;\n  overflow: hidden;\n}\n\n.userprofilmailidmail .otpheader_reg .alignflex {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n  width: 402px;\n}\n\n.userprofilmailidmail .verifiedcontentbtn {\n  background: #63a126;\n  min-width: 86px;\n  max-width: 86px;\n  height: 26px;\n  color: #fff;\n  border-radius: 3px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  font-size: 14px;\n  margin-top: 8px;\n}\n\n.userprofilmailidmail .verifiedcontentbtn i {\n  width: 18px;\n  height: 18px;\n  background: #fff;\n  border-radius: 50%;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  color: #63a126;\n}\n\n.userprofilmailidmail #mobileverifyspace .verifytop {\n  margin-top: 8px;\n}\n\n.userprofilmailidmail .submitwrap .mat-button-wrapper {\n  font-size: 15px;\n}\n\n.userprofilmailidmail .submitbtnedit {\n  border-radius: 2px;\n  background-color: #4aa1ac;\n  color: #fff;\n  border: none;\n  display: inline-block;\n  margin-top: 8px;\n}\n\n.userprofilmailidmail .submitbtnedit span.button-text {\n  font-size: 15px !important;\n}\n\n.userprofilmailidmail .submitbtnedit button {\n  line-height: 1;\n}\n\n.userprofilmailidmail .submitbtnedit:hover {\n  background-color: #E0AD67;\n}\n\n#select_valuetrigger .mat-select-disabled .mat-select-value {\n  cursor: no-drop;\n}\n\n#emailotpspinner button .spinner {\n  position: absolute;\n  top: auto !important;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9wcm9maWxlY3JlYXRpb24vcHJvZmlsZWNyZWF0aW9ubGlzdC9DOlxcamVua2luc1xcd29ya3NwYWNlXFxPUEFMIC0gRGV2IEJ1aWxkIDIwMFxcZGV2L3NyY1xcYXBwXFxtb2R1bGVzXFxwcm9maWxlY3JlYXRpb25cXHByb2ZpbGVjcmVhdGlvbmxpc3RcXHByb2ZpbGVjcmVhdGlvbmxpc3QuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvcHJvZmlsZWNyZWF0aW9uL3Byb2ZpbGVjcmVhdGlvbmxpc3QvcHJvZmlsZWNyZWF0aW9ubGlzdC5jb21wb25lbnQuc2NzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUEyQkE7RUFDRyxlQUFBO0FDMUJIOztBRDRCQTtFQUNFLDJCQUFBO0VBQ0EsMkJBQUE7RUFDQSwyQkFBQTtFQUNBLDhCQUFBO0FDekJGOztBRDJCQTtFQUNFLFdBQUE7RUFDQSxZQUFBO0VBQ0EsaUJBQUE7QUN4QkY7O0FENkJJO0VBQ0UsdUJBQUE7RUFDQSxxQkFBQTtBQzFCTjs7QUQ4QkE7RUF3Q0UsNkVBQUE7QUNsRUY7O0FEMkJFO0VBQ0UsY0FBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtBQ3pCSjs7QUQyQkU7RUFDRSxVQUFBO0FDekJKOztBRDJCRTtFQUNFLGlCQUFBO0FDekJKOztBRDBCSTtFQUNHLGVBQUE7QUN4QlA7O0FEMkJFO0VBQ0UsZUFBQTtFQUNBLGtCQUFBO0VBQ0EsU0FBQTtFQUNBLFVBQUE7RUFDQSxrQkFBQTtBQ3pCSjs7QUQ2Qkk7RUFDRSw0R0FBQTtFQUNBLHlCQUFBO0VBQ0EsMkJBQUE7RUFDQSw2QkFBQTtBQzNCTjs7QUQrQkk7RUFDRSw4QkFBQTtFQUNBLDJCQUFBO0FDN0JOOztBRGdDRTtFQUNJLHlCQUFBO0FDOUJOOztBRGlDRTtFQXBGQSxhQUFBO0VBQ0EsMkJBQUE7RUFDQSw4QkFBQTtFQW9GRSxXQUFBO0FDN0JKOztBRDhCSTtFQUNFLGVBQUE7QUM1Qk47O0FEK0JFO0VBM0ZBLGFBQUE7RUFDQSwyQkFBQTtFQUNBLDhCQUFBO0VBMkZFLFdBQUE7QUMzQko7O0FENEJJO0VBQ0UsV0FBQTtFQUNBLG1CQUFBO0FDMUJOOztBRDZCRTtFQUNHLGFBQUE7RUFDQSx5QkFBQTtBQzNCTDs7QUQ4Qkk7RUFDRSx3QkFBQTtFQUNBLG1CQUFBO0FDNUJOOztBRCtCRTtFQUNFLG1CQUFBO0VBQ0EsVUFBQTtBQzdCSjs7QUQ4Qkk7RUFIRjtJQUlJLFdBQUE7RUMzQko7QUFDRjs7QUQ2QkU7RUFDRSxrQkFBQTtBQzNCSjs7QUQ0Qkk7RUFDRSxjQUFBO0VBQ0EsV0FBQTtFQUNBLG1CQUFBO0FDMUJOOztBRDhCSTtFQUNFLFdBQUE7RUFDQSxZQUFBO0VBQ0Esb0JBQUE7S0FBQSxpQkFBQTtFQUNBLHlCQUFBO0VBQ0Esa0JBQUE7QUM1Qk47O0FEZ0NFO0VBQ0UsaUJBQUE7QUM5Qko7O0FEK0JJO0VBeElGLGFBQUE7RUFDQSwyQkFBQTtFQUNBLDhCQUFBO0FDNEdGOztBRDRCTTtFQUNFLGNBQUE7RUFDQSxvQkFBQTtFQUNBLFdBQUE7QUMxQlI7O0FENEJNO0VBQ0Usb0JBQUE7RUFDQSxlQUFBO0VBQ0EsV0FBQTtFQUNBLGNBQUE7QUMxQlI7O0FEK0JNO0VBQ0UsY0FBQTtFQUNBLFdBQUE7RUFDQSxlQUFBO0FDN0JSOztBRCtCTTtFQUNFLFdBQUE7QUM3QlI7O0FEOEJRO0VBRUUseUJBQUE7QUM3QlY7O0FEa0NNO0VBQ0UsV0FBQTtFQUNBLGNBQUE7QUNoQ1I7O0FEa0NNO0VBQ0Usb0JBQUE7QUNoQ1I7O0FEb0NFO0VBQ0Usc0JBQUE7RUFDQSx5QkFBQTtFQUNBLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxhQUFBO0VBQ0EsZUFBQTtBQ2xDSjs7QURvQ007RUFDRSxjQUFBO0VBQ0EsZUFBQTtFQUNBLGlCQUFBO0FDbENSOztBRHFDSTtFQUNFLGFBQUE7RUFDQSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSw4QkFBQTtFQUNBLFlBQUE7QUNuQ047O0FEc0NNO0VBQ0UsY0FBQTtFQUNBLGdCQUFBO0VBQ0EsV0FBQTtBQ3BDUjs7QUR3Q0k7RUFDRSxhQUFBO0VBQ0EsMkJBQUE7RUFDQSxtQkFBQTtBQ3RDTjs7QUR1Q007RUFDRSx5QkFBQTtFQUNBLFdBQUE7RUFDQSxtQkFBQTtBQ3JDUjs7QUR5Q0U7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxpQkFBQTtFQUNBLG1CQUFBO0FDdkNKOztBRHlDSTtFQUNFLHlCQUFBO0FDdkNOOztBRDBDSTtFQUNFLHlCQUFBO0VBQ0Esa0JBQUE7QUN4Q047O0FEMkNJO0VBQ0UsbUNBQUE7QUN6Q047O0FENENJO0VBQ0UsZUFBQTtBQzFDTjs7QUQ2Q0U7RUFDRSxnQkFBQTtFQUNBLGdCQUFBO0VBQ0EsaUJBQUE7QUMzQ0o7O0FEOENJO0VBQ0UsZUFBQTtFQUNBLFlBQUE7QUM1Q047O0FEK0NFO0VBQ0UsNEJBQUE7RUFDQSx1QkFBQTtBQzdDSjs7QURnREk7RUFDRSxlQUFBO0VBQ0Esb0JBQUE7RUFDQSxXQUFBO0VBQ0EsY0FBQTtFQUNBLGVBQUE7QUM5Q047O0FEaURFO0VBQ0Usd0JBQUE7QUMvQ0o7O0FEaURFO0VBQ0UsY0FBQTtFQUNBLG1CQUFBO0FDL0NKOztBRGtERTtFQUNFLG9CQUFBO0VBQ0EsbUJBQUE7QUNoREo7O0FEa0RJO0VBQ0UsV0FBQTtFQXpSSixhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtBQzBPRjs7QURnREk7RUFDRSxlQUFBO0FDOUNOOztBRGdESTtFQUNFLFVBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQWxTSixhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtFQWtTSSxlQUFBO0FDNUNOOztBRGdERTtFQUNFLGFBQUE7RUFDQSx5QkFBQTtBQzlDSjs7QURrRE07RUFDRSxjQUFBO0FDaERSOztBRG1ESTtFQUNFLDZCQUFBO0VBQ0EsYUFBQTtFQTlSSixhQUFBO0VBQ0EsOEJBQUE7RUFDQSxtQkFBQTtBQzhPRjs7QURrRFE7RUFDRSxtQkFBQTtBQ2hEVjs7QURpRFU7RUFDRSxXQUFBO0FDL0NaOztBRGtEUTtFQUNFLFVBQUE7RUFDQSxnQkFBQTtFQUNBLGNBQUE7RUFDQSxrQkFBQTtBQ2hEVjs7QURtRFE7RUFDRSx5QkFBQTtBQ2pEVjs7QURvRFE7RUFDRSxjQUFBO0FDbERWOztBRHFETTtFQUNFLHVCQUFBO0FDbkRSOztBRHFETTtFQUNFLHVCQUFBO0FDbkRSOztBRHNESTtFQUNFLGFBQUE7QUNwRE47O0FEdURJO0VBQ0Usa0JBQUE7RUFDQSxnQkFBQTtBQ3JETjs7QURzRE07RUFDRSxtQkFBQTtFQUNBLFNBQUE7RUFDQSxXQUFBO0VBQ0Esb0JBQUE7QUNwRFI7O0FEc0RNO0VBQ0UsV0FBQTtBQ3BEUjs7QURzRE07RUFDRSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSxpQkFBQTtFQUNBLG9CQUFBO0FDcERSOztBRHVESTtFQUNFLGFBQUE7RUFDQSx5QkFBQTtBQ3JETjs7QUR3RE07RUFDRSxTQUFBO0FDdERSOztBRHdETTtFQTdXSixhQUFBO0VBQ0EsMkJBQUE7RUFDQSw4QkFBQTtFQTZXTSxpQkFBQTtFQUNBLG9CQUFBO0FDcERSOztBRHFEUTtFQUNFLDRCQUFBO0FDbkRWOztBRHVETTtFQUNFLFdBQUE7RUFDQSxrQkFBQTtFQUNBLFNBQUE7RUFDQSxnQkFBQTtFQUNBLG1CQUFBO0FDckRSOztBRHVETTtFQUNFLFdBQUE7RUFDQSxrQkFBQTtBQ3JEUjs7QUR3RFE7RUFDRyxvQkFBQTtBQ3REWDs7QUR5RE07RUFDRSxjQUFBO0VBQ0Esb0JBQUE7RUFDQSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSxpQkFBQTtBQ3ZEUjs7QUQwREk7RUFDRSxpQkFBQTtBQ3hETjs7QUQwRE07RUFDRSxvQkFBQTtBQ3hEUjs7QUQ0REk7RUFDRSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxZQUFBO0VBQ0EsbUJBQUE7RUFoYUosYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7QUN1V0Y7O0FEeURNO0VBQ0UsZUFBQTtBQ3ZEUjs7QUQwREk7RUFoYUYsYUFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7QUN5V0Y7O0FEdURNO0VBQ0UsbUJBQUE7QUNyRFI7O0FEc0RRO0VBQ0UsV0FBQTtFQUNBLGtCQUFBO0FDcERWOztBRHNEUTtFQUNFLGdCQUFBO0FDcERWOztBRHVEVTtFQUNFLHlCQUFBO0FDckRaOztBRDRESTtFQUNFLGdCQUFBO0FDMUROOztBRDZESTtFQUNFLGdCQUFBO0FDM0ROOztBRDhESTtFQUNFLGdCQUFBO0FDNUROOztBRGdFRTtFQUNFLGFBQUE7RUFDQSxtQkFBQTtFQUNBLG9CQUFBO0FDOURKOztBRCtESTtFQUNFLFdBQUE7RUFDQSxZQUFBO0FDN0ROOztBRCtESTtFQUNFLFdBQUE7RUFDQSxTQUFBO0VBQ0EsZ0JBQUE7QUM3RE47O0FEbUVJO0VBQ0UsY0FBQTtFQUNBLG9CQUFBO0VBQ0EsV0FBQTtFQUNBLG9CQUFBO0FDakVOOztBRG9FRTtFQUNFLGFBQUE7QUNsRUo7O0FEb0VFO0VBQ0UsY0FBQTtBQ2xFSjs7QURxRUU7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7QUNuRUo7O0FEcUVFO0VBQ0Usc0JBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLFdBQUE7RUFDQSxtQkFBQTtFQUNBLDhCQUFBO0VBQ0Esb0JBQUE7RUFqZkYsYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7RUFpZkUsa0JBQUE7QUNqRUo7O0FEb0VFO0VBQ0Usc0JBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLFdBQUE7RUFDQSxtQkFBQTtFQUNBLG1CQUFBO0VBQ0Esb0JBQUE7RUE3ZkYsYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7QUM0YkY7O0FEb0VFO0VBdGZBLGFBQUE7RUFDQSx5QkFBQTtFQUNBLDhCQUFBO0FDcWJGOztBRG1FRTtFQUNFLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxzQkFBQTtFQUNBLG9CQUFBO0VBQ0EsZ0JBQUE7QUNqRUo7O0FEbUVFO0VBQ0UsbUJBQUE7RUFDQSxrQkFBQTtFQUNBLG9DQUFBO0VBQ0Esc0JBQUE7RUFDQSwwQkFBQTtFQUVBLFdBQUE7RUFDQSxlQUFBO0FDbEVKOztBRHFFRTtFQUNFLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxvQ0FBQTtFQUNBLHNCQUFBO0VBQ0EsMEJBQUE7RUFDQSxXQUFBO0FDbkVKOztBRHFFRTtFQUNFLGFBQUE7RUFDQSx5QkFBQTtBQ25FSjs7QURzRUU7RUFDRSxnQkFBQTtFQUNBLFlBQUE7RUFDQSw2QkFBQTtBQ3BFSjs7QURzRUU7RUFDRSxXQUFBO0VBQ0EseUJBQUE7RUFDQSw2QkFBQTtBQ3BFSjs7QUR3RUk7RUFDRSxpQkFBQTtBQ3RFTjs7QUR3RUk7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7QUN0RU47O0FEMkVJO0VBQ0UsVUFBQTtBQ3pFTjs7QUQ0RUk7RUFDRSxVQUFBO0FDMUVOOztBRDZFSTtFQUNFLGFBQUE7RUFDQSwyQkFBQTtBQzNFTjs7QUQ2RUk7RUF2a0JGLGFBQUE7RUFDQSx1QkFBQTtFQUNBLDhCQUFBO0VBMGtCSSxhQUFBO0VBQ0EsWUFBQTtFQUNBLGtCQUFBO0VBQ0EsV0FBQTtFQUNBLGlCQUFBO0VBQ0Esb0JBQUE7QUM1RU47O0FEbUVNO0VBQ0ksZ0JBQUE7QUNqRVY7O0FEMEVNO0VBQ0UsY0FBQTtFQUNBLGtCQUFBO0FDeEVSOztBRDJFSTtFQUNFLFlBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxVQUFBO0FDekVOOztBRDBFTTtFQUxGO0lBTUksV0FBQTtFQ3ZFTjtBQUNGOztBRDRFRTtFQUNFLGFBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0FDekVKOztBRDBFSTtFQUNFLFVBQUE7QUN4RU47O0FEMkVFO0VBQ0Usa0JBQUE7RUFDQSxhQUFBO0VBQ0EsbUJBQUE7QUN6RUo7O0FEMEVJO0VBQ0UsV0FBQTtFQUNBLFdBQUE7QUN4RU47O0FENkVBO0VBQ0U7SUFDRSxxQkFBQTtFQzFFRjtBQUNGOztBRDZFQTtFQUNFO0lBQ0UscUJBQUE7RUMzRUY7QUFDRjs7QUQ2RUE7RUFDRTtJQUNFLGtCQUFBO0lBQ0EsbUJBQUE7RUMzRUY7O0VENkVBO0lBQ0sseUJBQUE7RUMxRUw7O0VENEVBO0lBQ0sseUJBQUE7RUN6RUw7O0VENEVFO0lBQ0UsNEJBQUE7RUN6RUo7RUQwRUk7SUFDRSxrQkFBQTtJQUNBLE9BQUE7SUFDQSxNQUFBO0lBQ0EsYUFBQTtFQ3hFTjs7RUQ2RUE7SUFDRSw4QkFBQTtFQzFFRjs7RUQ0RUE7SUFDRSxxQkFBQTtFQ3pFRjs7RUQyRUE7SUFDRSx3QkFBQTtJQUNBLHlDQUFBO0VDeEVGOztFRDJFQTtJQUNFLG1CQUFBO0VDeEVGOztFRDJFQTtJQUNFLDZCQUFBO0VDeEVGOztFRDJFQTtJQUNFLHNCQUFBO0VDeEVGOztFRDBFQTtJQUNFLDRCQUFBO0VDdkVGOztFRHlFQTtJQUNFLDRCQUFBO0VDdEVGOztFRHdFQTtJQUNFLDBCQUFBO0lBQ0EsMkJBQUE7RUNyRUY7O0VEd0VBO0lBQ0Usd0JBQUE7RUNyRUY7O0VEeUVBO0lBQ0UseUJBQUE7RUN0RUY7O0VEd0VBO0lBQ0UseUJBQUE7SUFDQSxhQUFBO0VDckVGO0FBQ0Y7O0FEd0VBO0VBQ0U7SUFDSSx5QkFBQTtFQ3RFSjs7RUR3RUE7SUFDRSwwQkFBQTtFQ3JFRjs7RUR1RUE7SUFDRSwwQkFBQTtFQ3BFRjs7RURzRUE7SUFDRSxpQkFBQTtJQUNBLGtCQUFBO0VDbkVGOztFRHNFRTtJQUNJLG1CQUFBO0VDbkVOO0VEcUVFO0lBQ0ksb0JBQUE7RUNuRU47RURxRUU7SUFDSSw0QkFBQTtFQ25FTjtFRHFFRTtJQUNHLG9CQUFBO0VDbkVMO0VEcUVFO0lBQ0ksaUJBQUE7RUNuRU47O0VEc0VEO0lBQ0MsVUFBQTtFQ25FQTs7RURxRUE7SUFDRSx1QkFBQTtJQUNBLG9CQUFBO0lBQ0Esa0JBQUE7SUFDQSxvQkFBQTtJQUNBLHFCQUFBO0lBQ0EsUUFBQTtJQUNBLGNBQUE7RUNsRUY7O0VEcUVBO0lBQ0UsMkJBQUE7RUNsRUY7O0VEb0VBO0lBQ0Usc0JBQUE7RUNqRUY7RURtRUU7SUFDRSx1QkFBQTtFQ2pFSjtFRG1FRTtJQUNFLHlCQUFBO0VDakVKO0VEbUVFO0lBQ0UsbUJBQUE7RUNqRUo7RURtRUU7SUFDRSw4QkFBQTtFQ2pFSjs7RURvRUE7SUFDRSx5QkFBQTtJQUNBLHlDQUFBO0VDakVGOztFRG1FQTtJQUNFLHlCQUFBO0VDaEVGOztFRG1FQTtJQUNFLHlCQUFBO0lBQ0EsbUJBQUE7RUNoRUY7O0VEbUVBO0lBQ0UsNEJBQUE7RUNoRUY7O0VEa0VBO0lBQ0UsaUJBQUE7RUMvREY7O0VEa0VBO0lBQ0UsNEJBQUE7RUMvREY7O0VEaUVBO0lBQ0UseUJBQUE7SUFDQSwyQkFBQTtJQUNBLG1CQUFBO0VDOURGOztFRGdFQTtJQUNFLHdCQUFBO0lBQ0Esc0NBQUE7SUFDQSw4QkFBQTtJQUNBLGtCQUFBO0lBQ0Esb0JBQUE7RUM3REY7O0VEK0RBO0lBQ0Usc0JBQUE7RUM1REY7O0VEK0RBO0lBQ0UseUJBQUE7RUM1REY7O0VEOERBO0lBQ0UsNkJBQUE7RUMzREY7O0VENkRBO0lBQ0UsMkJBQUE7RUMxREY7O0VENERBO0lBQ0UsMkJBQUE7SUFDQSxzQkFBQTtFQ3pERjs7RUQyREE7SUFDRSw0QkFBQTtFQ3hERjs7RUQwREE7SUFDRSw2QkFBQTtJQUNBLGFBQUE7RUN2REY7O0VEeURBO0lBQ0UsNkJBQUE7RUN0REY7O0VEd0RBO0lBQ0UsbUJBQUE7RUNyREY7O0VEdURBO0lBQ0Usa0JBQUE7RUNwREY7O0VEc0RBO0lBQ0ksNEJBQUE7RUNuREo7O0VEcURBO0lBQ0UsK0JBQUE7SUFDQSwwQ0FBQTtJQUNBLGtCQUFBO0lBQ0EsZ0JBQUE7SUFDQSxZQUFBO0VDbERGOztFRG9EQTtJQUNFLDBCQUFBO0lBQ0EsMkJBQUE7RUNqREY7O0VEbURBO0lBQ0UsdUJBQUE7RUNoREY7O0VEa0RBO0lBQ0UseUJBQUE7RUMvQ0Y7O0VEaURBO0lBQ0UsbUJBQUE7RUM5Q0Y7O0VEZ0RBO0lBQ0UsOEJBQUE7RUM3Q0Y7O0VEZ0RBO0lBQ0UsYUFBQTtJQUNBLHlCQUFBO0lBQ0EsOEJBQUE7SUFDQSxtQkFBQTtJQUNBLDZCQUFBO0VDN0NGOztFRCtDQTtJQUNFLG9CQUFBO0lBQ0EsbUJBQUE7SUFDQSxnQkFBQTtFQzVDRjtBQUNGOztBRCtDQTtFQUNFLFlBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtFQUdBLHdCQUFBO0VBQ0EsNkJBQUE7RUFDQSxtQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxtQkFBQTtFQUNBLGtFQUFBO0VBQ0EsdUJBQUE7QUMvQ0Y7O0FEaURBO0VBQ0U7SUFDRSw2QkFBQTtFQzlDRjtFRGdEQTtJQUNFLDRCQUFBO0VDOUNGO0FBQ0Y7O0FEZ0RBO0VBQ0UsWUFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtFQUNBLGtCQUFBO0VBR0Esd0JBQUE7RUFDQSw2QkFBQTtFQUNBLG1DQUFBO0VBQ0EsaUNBQUE7RUFDQSxnQ0FBQTtFQUNBLG1CQUFBO0VBQ0Esa0VBQUE7RUFDQSx1QkFBQTtBQ2hERjs7QURpREU7RUFDRSxjQUFBO0VBQ0EsZUFBQTtFQUNBLFdBQUE7RUFDQSxrQkFBQTtBQy9DSjs7QURtREE7RUFDRTtJQUNFLDZCQUFBO0VDaERGO0VEa0RBO0lBQ0UsNEJBQUE7RUNoREY7QUFDRjs7QURtREE7RUFDRSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFHQSx3QkFBQTtFQUNBLDZCQUFBO0VBQ0EsbUNBQUE7RUFDQSxpQ0FBQTtFQUNBLGdDQUFBO0VBQ0EsbUJBQUE7RUFDQSxrRUFBQTtFQUNBLHVCQUFBO0FDbkRGOztBRG9ERTtFQUNFLGNBQUE7RUFDQSxlQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0FDbERKOztBRHNEQTtFQUNFO0lBQ0UsNkJBQUE7RUNuREY7RURxREE7SUFDRSw0QkFBQTtFQ25ERjtBQUNGOztBRHNEQTtFQXI3QkUsYUFBQTtFQUNBLDhCQUFBO0VBQ0EsbUJBQUE7QUNrNEJGOztBRG9EQTtFQUNFLGFBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0FDakRGOztBRG1EQTtFQUNFLFdBQUE7QUNoREY7O0FEbURBO0VBQ0UsYUFBQTtFQUNBLDhCQUFBO0FDaERGOztBRG1EQTtFQUNFLFdBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtFQUVBLHdCQUFBO0VBQ0EsNkJBQUE7RUFDQSxtQ0FBQTtFQUNBLGlDQUFBO0VBQ0EsZ0NBQUE7RUFDQSxtQkFBQTtFQUNBLGtFQUFBO0VBQ0EsdUJBQUE7QUNqREY7O0FEa0RFO0VBQ0UsY0FBQTtFQUNBLGVBQUE7RUFDQSxXQUFBO0VBQ0Esa0JBQUE7QUNoREo7O0FEb0RBO0VBQ0U7SUFDRSw2QkFBQTtFQ2pERjtFRG1EQTtJQUNFLDRCQUFBO0VDakRGO0FBQ0Y7O0FEbURBO0VBOStCRSxhQUFBO0VBQ0EseUJBQUE7RUFDQSw4QkFBQTtFQTgrQkEsZ0JBQUE7QUMvQ0Y7O0FEa0RBO0VBQ0U7SUFDRSxpQkFBQTtJQUNBLGtCQUFBO0VDL0NGOztFRGtERTtJQUNFLGtCQUFBO0VDL0NKO0VEZ0RJO0lBRUUsbUJBQUE7RUMvQ047RURpREk7SUFDRSxrQkFBQTtJQUNBLFVBQUE7SUFDQSxTQUFBO0lBQ0EsYUFBQTtFQy9DTjtFRGtERTtJQUNFLDRCQUFBO0VDaERKO0VEaURJO0lBQ0Usa0JBQUE7SUFDQSxPQUFBO0lBQ0EsTUFBQTtJQUNBLGFBQUE7RUMvQ047QUFDRjs7QURvREE7RUFDRSxrQkFBQTtBQ2xERjs7QURzREE7RUFDRSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSxTQUFBO0VBQ0Esb0JBQUE7QUNuREY7O0FEc0RBO0VBQ0UsaUJBQUE7QUNuREY7O0FEb0RFO0VBQ0UsV0FBQTtFQUNBLG1CQUFBO0VBQ0EsU0FBQTtBQ2xESjs7QURvREU7RUFDRSxXQUFBO0VBQ0EsbUJBQUE7QUNsREo7O0FEdURJO0VBQ0Usb0JBQUE7RUFDQSxxQkFBQTtBQ3BETjs7QUR1RE07RUFDRSw2QkFBQTtBQ3JEUjs7QUQwREk7RUFDSSw0QkFBQTtFQUNBLDhCQUFBO0FDeERSOztBRDBESztFQUNDLDRCQUFBO0VBQ0EsNkJBQUE7QUN4RE47O0FENERJO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDMURSOztBRDZETTtFQUNFLDJCQUFBO0FDM0RSOztBRG9FQTtFQUNFLGdCQUFBO0VBQ0EsWUFBQTtFQUNBLDBCQUFBO0VBQ0EsY0FBQTtFQUNBLGVBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0VBQ0EsZUFBQTtBQ2pFRjs7QURxRUk7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7QUNsRVI7O0FEb0VJO0VBQ0UsaUJBQUE7QUNsRU47O0FEbUVNO0VBQ00seUJBQUE7RUFDQSwwQkFBQTtBQ2pFWjs7QURvRU07RUFDSSxvQkFBQTtFQUNBLGtCQUFBO0VBQ0EsU0FBQTtFQUNBLFVBQUE7RUFDQSxnQkFBQTtFQUNBLGFBQUE7RUFDQSxnRkFBQTtFQUNBLDJCQUFBO0VBQ0EseUJBQUE7RUFDQSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsYUFBQTtFQUNBLGdCQUFBO0FDbEVWOztBRHFFUTtFQUNFLE9BQUE7RUFDQSxnQkFBQTtBQ25FVjs7QURzRVE7RUFDRSxZQUFBO0VBQ0EsZ0JBQUE7QUNwRVY7O0FEc0VRO0VBdG9DTixhQUFBO0VBQ0EsMkJBQUE7RUFDQSw4QkFBQTtFQXNvQ1MsWUFBQTtBQ2xFWDs7QUR1RUk7RUFDRSxtQkFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSxrQkFBQTtFQXpwQ0osYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7RUF5cENJLGVBQUE7RUFDQSxlQUFBO0FDbkVOOztBRG9FTTtFQUNJLFdBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7RUFDQSxrQkFBQTtFQWpxQ1IsYUFBQTtFQUNBLHVCQUFBO0VBQ0EsOEJBQUE7RUFpcUNRLGNBQUE7QUNoRVY7O0FEeUVJO0VBQ0UsZUFBQTtBQ3ZFTjs7QUQyRUk7RUFDTSxlQUFBO0FDekVWOztBRDRFSTtFQUNFLGtCQUFBO0VBQ0EseUJBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNBLHFCQUFBO0VBQ0EsZUFBQTtBQzFFTjs7QUQyRU07RUFDRSwwQkFBQTtBQ3pFUjs7QUQyRU07RUFDSyxjQUFBO0FDekVYOztBRDJFTTtFQUNFLHlCQUFBO0FDekVSOztBRGdGSTtFQUNFLGVBQUE7QUM3RU47O0FEcUZJO0VBQ0Usa0JBQUE7RUFDQSxvQkFBQTtBQ2xGTiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvcHJvZmlsZWNyZWF0aW9uL3Byb2ZpbGVjcmVhdGlvbmxpc3QvcHJvZmlsZWNyZWF0aW9ubGlzdC5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIkBtaXhpbiBmbGV4Y2VudGVyIHtcclxuICBkaXNwbGF5OiBmbGV4O1xyXG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5cclxuQG1peGluIGZsZXhzdGFydCB7XHJcbiAgZGlzcGxheTogZmxleDtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcblxyXG5AbWl4aW4gZmxleGVuZCB7XHJcbiAgZGlzcGxheTogZmxleDtcclxuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xyXG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG4vLyAubWF0LXNlbGVjdC1hcnJvdzo6YWZ0ZXIge1xyXG4vLyAgIGJvcmRlcjogbm9uZSAgIWltcG9ydGFudDtcclxuLy8gIGNvbG9yOiB3aGl0ZSAhaW1wb3J0YW50O1xyXG4vLyB9XHJcblxyXG5AbWl4aW4gc3BhY2ViZXR3ZWVuIHtcclxuICBkaXNwbGF5OiBmbGV4O1xyXG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcclxuICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG59XHJcbi5wb2ludGVye1xyXG4gICBjdXJzb3I6IHBvaW50ZXI7XHJcbn1cclxuLnNlbGVjdF93aXRoX3NlYXJjaCB7XHJcbiAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xyXG4gIG1heC1oZWlnaHQ6IDEwMCUgIWltcG9ydGFudDtcclxuICBtYXJnaW4tdG9wOiA0MHB4ICFpbXBvcnRhbnQ7XHJcbiAgbWFyZ2luLWJvdHRvbTogMTVweCAhaW1wb3J0YW50O1xyXG59XHJcbi53aWR0aGltZyB7XHJcbiAgd2lkdGg6IDI0cHg7XHJcbiAgaGVpZ2h0OiAxNnB4O1xyXG4gIG1hcmdpbi1yaWdodDogNXB4O1xyXG59XHJcblxyXG4jd2l0aENsZWFyX2NlcnRmaWNhdGUge1xyXG4gIC5pbmZvc3RlcHNfY2VydGZpY2F0ZSB7XHJcbiAgICAmOjphZnRlciB7XHJcbiAgICAgIHJpZ2h0OiAyMDRweCAhaW1wb3J0YW50O1xyXG4gICAgICBsZWZ0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcbi5wcm9maWxldmlld2xpc3Qge1xyXG4gIC5hZGRpbmdkZXBhcnRtZW50IHtcclxuICAgIGNvbG9yOiAjRTBBRDY3O1xyXG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gIH1cclxuICAuaW5kZXhtZGVzcGFjZXtcclxuICAgIHotaW5kZXg6IDk7XHJcbiAgfVxyXG4gIC5tZGVwc2FwY2V7XHJcbiAgICBtYXJnaW4tdG9wOiAtMTZweDtcclxuICAgIHNwYW57XHJcbiAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5idC1kZWxldGV7XHJcbiAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICB0b3A6IDM1cHg7XHJcbiAgICByaWdodDogMHB4O1xyXG4gICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gIH1cclxuICBcclxuICAuZmlsZWRib3JkZXJ7XHJcbiAgICAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5le1xyXG4gICAgICBiYWNrZ3JvdW5kLWltYWdlOiBsaW5lYXItZ3JhZGllbnQodG8gcmlnaHQsIHJnYmEoMCwgMCwgMCwgMC40MikgMCUsIHJnYmEoMCwgMCwgMCwgMC40MikgMzMlLCB0cmFuc3BhcmVudCAwJSk7XHJcbiAgICAgIGJhY2tncm91bmQtc2l6ZTogNHB4IDEwMCU7XHJcbiAgICAgIGJhY2tncm91bmQtcmVwZWF0OiByZXBlYXQteDtcclxuICAgICAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5jb21tb25leHBhbmRhbmRjb2xsYXBzZSB7XHJcbiAgICBtYXQtZXhwYW5zaW9uLXBhbmVsLm1hdC1leHBhbmRlZCB7XHJcbiAgICAgIG1hcmdpbi1ib3R0b206IDMwcHggIWltcG9ydGFudDtcclxuICAgICAgbWFyZ2luLXRvcDogMzBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIH0gXHJcbiAgLnRleHRvcmdhbmdle1xyXG4gICAgICBjb2xvcjogI2RmYWQ2NiAhaW1wb3J0YW50O1xyXG4gIH1cclxuICBiYWNrZ3JvdW5kOiBsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjZmZmIDE4M3B4LCAjZmZmIDE0NXB4IDQwJSkgIWltcG9ydGFudDtcclxuICAuYWxpZ25yZW1vdmV3aWR0aCB7XHJcbiAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgc3BhbiB7XHJcbiAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgIH1cclxuICB9XHJcbiAgLmFsaWducmVtb3ZlIHtcclxuICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgd2lkdGg6IDEwMCU7XHJcbiAgICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XHJcbiAgICAgIGhlaWdodDogMXB4O1xyXG4gICAgICBiYWNrZ3JvdW5kOiAjYzljYmQ3O1xyXG4gICB9XHJcbiAgfVxyXG4gIC52ZW51ZXdpZHRoIHtcclxuICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgfVxyXG4gIC5udW1iZXJhbmRjb2RlIHtcclxuICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuICB9XHJcbiAgLmFsaWduaXRlbXMge1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIHdpZHRoOiA3NyU7XHJcbiAgICBAbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5zdXBlcnZpc29ydGV4dGNvbG9yIHtcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgIHAge1xyXG4gICAgICBjb2xvcjogIzY2NjY2NjtcclxuICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5pbWdhbGlnbmZsZXgge1xyXG4gICAgaW1nIHtcclxuICAgICAgd2lkdGg6IDcwcHg7XHJcbiAgICAgIGhlaWdodDogNzBweDtcclxuICAgICAgb2JqZWN0LWZpdDogY292ZXI7XHJcbiAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNkNmRiZTM7XHJcbiAgICAgIGJvcmRlci1yYWRpdXM6IDRweDtcclxuICAgIH1cclxuICB9XHJcblxyXG4gIC5vZmZpY2V0ZXh0IHtcclxuICAgIHBhZGRpbmctdG9wOiAyMHB4O1xyXG4gICAgLmNoYW5nZWFsaWduIHtcclxuICAgICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICAgIGgyIHtcclxuICAgICAgICBjb2xvcjogIzMzMzMzMztcclxuICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgfVxyXG4gICAgICBwIHtcclxuICAgICAgICBmb250LXNpemU6IDAuODEyNXJlbTtcclxuICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgY29sb3I6ICNmNDgxMWY7XHJcbiAgICAgICAgLy8gcGFkZGluZy1sZWZ0OiAyMHB4O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICAucGFwZXJub3RlY29sb3Ige1xyXG4gICAgICBoMiB7XHJcbiAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgbWFyZ2luOiAwcHg7XHJcbiAgICAgICAgZm9udC1zaXplOiAxcmVtO1xyXG4gICAgICB9XHJcbiAgICAgIHAge1xyXG4gICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgIHNwYW4ge1xyXG4gICAgICAgICAgQGV4dGVuZCBwO1xyXG4gICAgICAgICAgY29sb3I6ICM0YWExYWMgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIC5hZGRyZXNzY29sb3Ige1xyXG4gICAgICBwIHtcclxuICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgICBjb2xvcjogIzRhYTFhYztcclxuICAgICAgfVxyXG4gICAgICBzcGFuIHtcclxuICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH1cclxuICAuc2hhZG93Y2FyZCB7XHJcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgYm9yZGVyOiBzb2xpZCAxcHggI2UyZTRlODtcclxuICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICBib3JkZXItcmFkaXVzOiAwO1xyXG4gICAgcGFkZGluZzogMTVweDtcclxuICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgIC5zdXBwbGllcnRleHRjb2xvciB7XHJcbiAgICAgIHNwYW4ge1xyXG4gICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMXJlbTtcclxuICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gICAgLm1hdC1jYXJkLWhlYWRlciB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgIHBhZGRpbmc6IDBweDtcclxuICAgIH1cclxuICAgIC5zZWxlY3Rqc3J0ZXh0IHtcclxuICAgICAgcCB7XHJcbiAgICAgICAgY29sb3I6ICMzMzMzMzM7XHJcbiAgICAgICAgcGFkZGluZy10b3A6IDVweDtcclxuICAgICAgICBtYXJnaW46IDBweDtcclxuICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5zZWxlY3Rmb3J3YXJkIHtcclxuICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICBpIHtcclxuICAgICAgICB0cmFuc2Zvcm06IHJvdGF0ZSgyNzBkZWcpO1xyXG4gICAgICAgIGNvbG9yOiAjNzc3O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICBwYWRkaW5nOiA2cHggMTBweDtcclxuICAgIGJhY2tncm91bmQ6ICNlOWVkZjA7XHJcblxyXG4gICAgaW5wdXQ6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXIge1xyXG4gICAgICBjb2xvcjogIzdmOGZhMyAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIGkge1xyXG4gICAgICBjb2xvcjogIzdmOGZhMyAhaW1wb3J0YW50O1xyXG4gICAgICBwYWRkaW5nLXJpZ2h0OiA2cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLnNlYXJjaHNlbGVjdCB7XHJcbiAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5yZXNldGljb24ge1xyXG4gICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC5vcHRpb24tbGlzdGluZyB7XHJcbiAgICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gICAgb3ZlcmZsb3cteTogYXV0bztcclxuICAgIG1heC1oZWlnaHQ6IDI5MHB4O1xyXG4gIH1cclxuICAuZmxhZ3dpdGhjb2RlIHtcclxuICAgIGltZyB7XHJcbiAgICAgIG1heC13aWR0aDogMjRweDtcclxuICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgfVxyXG4gIH1cclxuICAuY291bnRyeW5hbWVzZWxlY3Qge1xyXG4gICAgbGluZS1oZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcclxuICAgIGhlaWdodDogNDBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuc3VwdGV4dGNvbG9yIHtcclxuICAgIHAge1xyXG4gICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgIGZvbnQtc2l6ZTogMC44MTI1cmVtO1xyXG4gICAgICBtYXJnaW46IDBweDtcclxuICAgICAgY29sb3I6ICM0YWExYWM7XHJcbiAgICAgIHRleHQtYWxpZ246IGVuZDtcclxuICAgIH1cclxuICB9XHJcbiAgLmFsaWducHVibGlzaCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC52ZW51ZWNvbG9yIHtcclxuICAgIGNvbG9yOiAjNGFhMWFjO1xyXG4gICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICB9XHJcblxyXG4gIC5lZGl0YW5kZGVsZXRlIHtcclxuICAgIGRpc3BsYXk6IGlubGluZS1mbGV4O1xyXG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuXHJcbiAgICAuZWRpdCB7XHJcbiAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICB9XHJcbiAgICBpIHtcclxuICAgICAgZm9udC1zaXplOiAxcmVtO1xyXG4gICAgfVxyXG4gICAgc3BhbiB7XHJcbiAgICAgIG9wYWNpdHk6IDA7XHJcbiAgICAgIHdpZHRoOiAzNXB4O1xyXG4gICAgICBoZWlnaHQ6IDM1cHg7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgfVxyXG4gIH1cclxuXHJcbiAgLmFsaWdudmVudWUge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgfVxyXG4gICNjcmVhdGlvbmxpc3Qge1xyXG4gICAgLmNlcnRpZmljYXRlaW1hZ2Uge1xyXG4gICAgICBpIHtcclxuICAgICAgICBjb2xvcjogIzAwNmNiNztcclxuICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmFkZGVkY2VydGlmaWNhdGUge1xyXG4gICAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcclxuICAgICAgcGFkZGluZzogMjBweDtcclxuICAgICAgQGluY2x1ZGUgc3BhY2ViZXR3ZWVuKCk7XHJcbiAgICAgICY6aG92ZXIge1xyXG4gICAgICAgIC8vIGJhY2tncm91bmQ6ICNlMWVmZmY7XHJcbiAgICAgICAgLmNlcnRpZmljYXRlaW1hZ2Uge1xyXG4gICAgICAgICAgYmFja2dyb3VuZDogIzAwNmNiNztcclxuICAgICAgICAgIGkge1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgLmVkaXRhbmRkZWxldGUgc3BhbiB7XHJcbiAgICAgICAgICBvcGFjaXR5OiAxO1xyXG4gICAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgICAgICAgIGNvbG9yOiAjNWY1MzUzO1xyXG4gICAgICAgICAgYm9yZGVyLXJhZGl1czogNTAlO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmxhYmxlbmFtZSB7XHJcbiAgICAgICAgICBjb2xvcjogIzAwNmNiNyAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm5hbWUge1xyXG4gICAgICAgICAgY29sb3I6ICM0YWExYWM7XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICAgICY6Zm9jdXMge1xyXG4gICAgICAgIGJvcmRlcjogMXB4IGRvdHRlZCAjZGRkO1xyXG4gICAgICB9XHJcbiAgICAgICY6YWN0aXZlIHtcclxuICAgICAgICBib3JkZXI6IDFweCBkb3R0ZWQgI2RkZDtcclxuICAgICAgfVxyXG4gICAgfVxyXG4gICAgLmNlcnRpZmljYXRlcyB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICB9XHJcblxyXG4gICAgLmNlcnRpZmljYXRlaW5mbyB7XHJcbiAgICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgICAgbGluZS1oZWlnaHQ6IDEuODtcclxuICAgICAgcCB7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgICAgICBtYXJnaW46IDA7XHJcbiAgICAgICAgY29sb3I6ICMwMDA7XHJcbiAgICAgICAgcGFkZGluZy1ib3R0b206IDEwcHg7XHJcbiAgICAgIH1cclxuICAgICAgLmNlcmxhYmVsIHtcclxuICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgfVxyXG4gICAgICAuaGVhZGVyIHtcclxuICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgIHBhZGRpbmctYm90dG9tOiAxNXB4O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICAuYWxpZ25zcGFjZSB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgICB9XHJcbiAgICAuY29tcGFueWFuZG9mZmljZWluZm8ge1xyXG4gICAgICBwIHtcclxuICAgICAgICBtYXJnaW46IDA7XHJcbiAgICAgIH1cclxuICAgICAgLmNyYW5kYnJhbmNoaWRzIHtcclxuICAgICAgICBAaW5jbHVkZSBmbGV4c3RhcnQoKTtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMTBweDtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgICAgICAuY291bnQge1xyXG4gICAgICAgICAgZm9udC1mYW1pbHk6ICdjYWlyb3NlbWlib2xkJztcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgLy8gcGFkZGluZy1sZWZ0OiAyMHB4O1xyXG4gICAgICAudGl0bGUge1xyXG4gICAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgICAgICBtYXJnaW46IDA7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDAuOTtcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogNnB4O1xyXG4gICAgICB9XHJcbiAgICAgIC5sYWJsZW5hbWUge1xyXG4gICAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC43NXJlbTtcclxuICAgICAgfVxyXG4gICAgICAuZmxleG9tYW57XHJcbiAgICAgICAgc3BhbntcclxuICAgICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgICAgLm5hbWUge1xyXG4gICAgICAgIGNvbG9yOiAjMzMzMzMzO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IDIycHg7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIC5vZmZpY2VhZGRyZXNzZGV0YWlsIHtcclxuICAgICAgcGFkZGluZy10b3A6IDIwcHg7XHJcblxyXG4gICAgICAuYWRkcmVzc2luZm8ge1xyXG4gICAgICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLmNlcnRpZmljYXRlaW1hZ2Uge1xyXG4gICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgIHdpZHRoOiA4MHB4O1xyXG4gICAgICBoZWlnaHQ6IDgwcHg7XHJcbiAgICAgIGJhY2tncm91bmQ6ICNlNWVlZmU7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgICAgaW1nIHtcclxuICAgICAgICBtYXgtd2lkdGg6IDEwMCU7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIC5jb3VudHJ5YW5kY3JpbmZvIHtcclxuICAgICAgQGluY2x1ZGUgZmxleHN0YXJ0KCk7XHJcbiAgICAgIC5lYWNoaXRlbSB7XHJcbiAgICAgICAgcGFkZGluZy1yaWdodDogNDBweDtcclxuICAgICAgICBpbWcge1xyXG4gICAgICAgICAgd2lkdGg6IDIycHg7XHJcbiAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiA4cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgICY6bGFzdC1jaGlsZCB7XHJcbiAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwO1xyXG4gICAgICAgIH1cclxuICAgICAgICBwe1xyXG4gICAgICAgICAgc3BhbntcclxuICAgICAgICAgICAgY29sb3I6ICM0YWExYWMgIWltcG9ydGFudDsgXHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnBob25ld2lkdGgge1xyXG4gICAgICBtaW4td2lkdGg6IDE2NXB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5jb3VudHJ5d2lkdGgge1xyXG4gICAgICBtaW4td2lkdGg6IDE3MHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYWlsd2lkdGgge1xyXG4gICAgICBtaW4td2lkdGg6IDIxMHB4O1xyXG4gICAgfVxyXG4gIH1cclxuXHJcbiAgLmVhY2hzb2NpYWxsaW5rIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgcGFkZGluZy1ib3R0b206IDEycHg7XHJcbiAgICBpbWcge1xyXG4gICAgICB3aWR0aDogMTZweDtcclxuICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgfVxyXG4gICAgcCB7XHJcbiAgICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgICBtYXJnaW46IDA7XHJcbiAgICAgIG1pbi13aWR0aDogMTMwcHg7XHJcbiAgICAgIC8vIHBhZGRpbmctbGVmdDogMTBweDtcclxuICAgIH1cclxuICB9XHJcblxyXG4gIC53ZWJ0ZXh0Y29sb3Ige1xyXG4gICAgaDIge1xyXG4gICAgICBjb2xvcjogIzM0MWY0NDtcclxuICAgICAgZm9udC1zaXplOiAwLjkzNzVyZW07XHJcbiAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgICBwYWRkaW5nLWJvdHRvbTogMjBweDtcclxuICAgIH1cclxuICB9XHJcbiAgLnVybGFsaWduIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxuICAubGluZWhlaWdodCB7XHJcbiAgICBsaW5lLWhlaWdodDogMTtcclxuICB9XHJcblxyXG4gIC5hbGlnbnByZXZpZXcge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgfVxyXG4gIC5jb21wbGV0ZWQge1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI2ZmZjtcclxuICAgIGhlaWdodDogMjBweDtcclxuICAgIHdpZHRoOiAyMHB4O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMDAlO1xyXG4gICAgYmFja2dyb3VuZDogIzcxYzExNCAhaW1wb3J0YW50O1xyXG4gICAgZm9udC1zaXplOiAwLjY4NzVyZW07XHJcbiAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICBtYXJnaW4tcmlnaHQ6IDEwcHg7XHJcbiAgfVxyXG5cclxuICAucGFnZW51bWJlcmNvbG9yYmxhbmsge1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI2ZmZjtcclxuICAgIGhlaWdodDogMjBweDtcclxuICAgIHdpZHRoOiAyMHB4O1xyXG4gICAgY29sb3I6ICNmZmY7XHJcbiAgICBib3JkZXItcmFkaXVzOiAxMDAlO1xyXG4gICAgYmFja2dyb3VuZDogIzk5OTk5OTtcclxuICAgIGZvbnQtc2l6ZTogMC42ODc1cmVtO1xyXG4gICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgLy8gbWFyZ2luLXJpZ2h0OiAxMHB4O1xyXG4gIH1cclxuXHJcbiAgLmNhbmNlbGFuZHB1Ymxpc2gge1xyXG4gICAgQGluY2x1ZGUgZmxleGVuZCgpO1xyXG4gIH1cclxuXHJcbiAgLnNhdmVhbmRuZXh0IHtcclxuICAgIGJhY2tncm91bmQ6ICM0YWExYWMgO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcclxuICAgIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xyXG4gICAgbWluLXdpZHRoOiAxMDBweDtcclxuICB9XHJcbiAgLnByZXZpb3VzIHtcclxuICAgIGJhY2tncm91bmQ6ICNlY2VjZWM7XHJcbiAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICBib3JkZXI6IDFweCBzb2xpZCAjZWNlY2VjICFpbXBvcnRhbnQ7XHJcbiAgICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xyXG4gICAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAvLyBtYXJnaW4tcmlnaHQ6IDE1cHg7XHJcbiAgICB3aWR0aDogYXV0bztcclxuICAgIG1pbi13aWR0aDogODBweDtcclxuICB9XHJcblxyXG4gIC5hZGRidG5jb2xvciB7XHJcbiAgICBiYWNrZ3JvdW5kOiAjZWNlY2VjO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI2VjZWNlYyAhaW1wb3J0YW50O1xyXG4gICAgY29sb3I6ICM5OTkgIWltcG9ydGFudDtcclxuICAgIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xyXG4gICAgd2lkdGg6IGF1dG87XHJcbiAgfVxyXG4gIC5hbGlnbm5leHQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgfVxyXG5cclxuICAucHVibGlzaCB7XHJcbiAgICBtaW4td2lkdGg6IDE1MHB4O1xyXG4gICAgaGVpZ2h0OiA0MHB4O1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5jYW5jZWwge1xyXG4gICAgY29sb3I6ICM3Nzc7XHJcbiAgICBib3JkZXI6IDFweCBzb2xpZCAjY2JjYmNiO1xyXG4gICAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG5cclxuICAuY291bnRyeXNlbGVjdHdpdGhpbWFnZSB7XHJcbiAgICAubWF0LW9wdGlvbiB7XHJcbiAgICAgIG1hcmdpbi1yaWdodDogN3B4O1xyXG4gICAgfVxyXG4gICAgLm1hdC1vcHRpb24tdGV4dCB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICB9XHJcbiAgfVxyXG5cclxuICAubGlzdGJhc2ljaW5mbyB7XHJcbiAgICAud2lkdGhmaWxlZHMge1xyXG4gICAgICB3aWR0aDogNzAlO1xyXG4gICAgfVxyXG5cclxuICAgIC53aWR0aGVtcCB7XHJcbiAgICAgIHdpZHRoOiA1MCU7XHJcbiAgICB9XHJcblxyXG4gICAgLmFsaWduZmlsZWRzIHtcclxuICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgfVxyXG4gICAgLmJhY2tncm91bmR1cGxvYWRiYXNpY2luZm8ge1xyXG4gICAgICAudmlld2hlaWdodHtcclxuICAgICAgICAgIG1heC1oZWlnaHQ6IDEwMCU7XHJcbiAgICAgIH1cclxuICAgICAgQGluY2x1ZGUgZmxleGNlbnRlcigpO1xyXG4gICAgICBoZWlnaHQ6IDEyNnB4O1xyXG4gICAgICB3aWR0aDogMTM1cHg7XHJcbiAgICAgIHRleHQtYWxpZ246IGNlbnRlcjtcclxuICAgICAgbWFyZ2luOiAycHg7XHJcbiAgICAgIHBhZGRpbmctdG9wOiAyMHB4O1xyXG4gICAgICBwYWRkaW5nLWJvdHRvbTogMjBweDtcclxuICAgICAgcCB7XHJcbiAgICAgICAgY29sb3I6ICM5OTk5OTk7XHJcbiAgICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICAuaW5uZXJzaWRlIHtcclxuICAgICAgcGFkZGluZzogNXB4O1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgd2lkdGg6IDIzJTtcclxuICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbn1cclxuLnRhcmdldHdpZHRoIHtcclxuICAuYWxpZ25maWxlZHNjZXJ0aWZpY2F0ZSB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIC53aWR0aGVtcCB7XHJcbiAgICAgIHdpZHRoOiA1MCU7XHJcbiAgICB9XHJcbiAgfVxyXG4gIC51cGxvYWRsYWJlbCB7XHJcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIGg0IHtcclxuICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgIG1hcmdpbjogMHB4O1xyXG4gICAgfVxyXG4gIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDEzNjZweCkgYW5kIChtaW4td2lkdGg6IDEyODBweCkge1xyXG4gIC5tYXBwaW5nd2lkdGggLm1hcHBpbmdzaWRlbmF2d2lkdGgge1xyXG4gICAgd2lkdGg6IDc1JSAhaW1wb3J0YW50O1xyXG4gIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDEwMjRweCkgYW5kIChtaW4td2lkdGg6IDc2OXB4KSB7XHJcbiAgLm1hcHBpbmd3aWR0aCAubWFwcGluZ3NpZGVuYXZ3aWR0aCB7XHJcbiAgICB3aWR0aDogOTAlICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG59XHJcbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xyXG4gIC5zdXBlcnZpc29ydGV4dGNvbG9yIHtcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgIHRvcDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5jZXJ0aWZpY2F0ZXdpZHRoe1xyXG4gICAgICAgbWF4LXdpZHRoOiA3MCUgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLnZlbnVld2lkdGh7XHJcbiAgICAgICBtYXgtd2lkdGg6IDMwJSAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuY2hlY2tldmVuY2hpbGQge1xyXG4gICAgZGl2Om50aC1vZi10eXBlKGV2ZW4pIHtcclxuICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgLnN1cHRleHRjb2xvciB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIGxlZnQ6IDA7XHJcbiAgICAgICAgdG9wOiAwO1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9XHJcbiAgXHJcbiAgLmxpbmVoZWlnaHQge1xyXG4gICAgbWFyZ2luLWJvdHRvbTogMTVweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAubWFwcGluZ3dpZHRoIC5tYXBwaW5nc2lkZW5hdndpZHRoIHtcclxuICAgIHdpZHRoOiA5NSUgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLnRvcGhlYWRlcm1haW4ge1xyXG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG5cclxuICAucGFnZXRpdGxlbmV3IHtcclxuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XHJcbiAgfVxyXG5cclxuICAuaW1hZ2VhbGlnbnNwYWNlIHtcclxuICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuXHJcbiAgLndpZHRoZW1wIHtcclxuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC51cmxhbGlnbiB7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuYWxpZ25zcGFjZSB7XHJcbiAgICBtYXJnaW4tbGVmdDogMTVweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAudGFyZ2V0d2lkdGggLnNpZGVuYXZzYW1ld2lkdGhhbGwge1xyXG4gICAgcG9zaXRpb246IGZpeGVkICFpbXBvcnRhbnQ7XHJcbiAgICBtaW4td2lkdGg6IDczMHB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG5cclxuICAuY2VydGlmaWNhdGVzIHtcclxuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcclxuICB9XHJcblxyXG5cclxuICAudmVudWV3aWR0aG51YmVyIHtcclxuICAgIG1pbi13aWR0aDogNzAlICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC52ZW51ZXdpZHRoIHtcclxuICAgIG1pbi13aWR0aDogMzAlICFpbXBvcnRhbnQ7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XHJcbiAgLmFsaWduYmxvY2t7XHJcbiAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5jZXJ0aWZpY2F0ZXdpZHRoe1xyXG4gICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgIH1cclxuICAudmVudWV3aWR0aHtcclxuICAgIG1heC13aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICB9XHJcbiAgLm1hcmdpbnNwYWNle1xyXG4gICAgbWFyZ2luLWxlZnQ6IDE1cHg7XHJcbiAgICBtYXJnaW4tcmlnaHQ6IDE1cHg7XHJcbiAgIH1cclxuICAucHJvZmlsZWFjY29yZGlvbntcclxuICAgIC5zdXBlcnZpc29ydGV4dGNvbG9yIHtcclxuICAgICAgICB0b3A6IDRweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLmJ0LWRlbGV0ZXtcclxuICAgICAgICB0b3A6IDUwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5pbm5lcnNpZGUge1xyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuYWNjZXB0ZWRjb2xvciB7XHJcbiAgICAgICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxuICAgIH1cclxuICAgIC5hbGlnbnJlbW92ZXtcclxuICAgICAgICBwYWRkaW5nLXRvcDogMTVweDtcclxuICAgIH1cclxuICB9XHJcbiAucmVke1xyXG4gIGNvbG9yOiByZWQ7XHJcbiB9XHJcbiAgLmFsaWduYmxvY2s6OmFmdGVyIHtcclxuICAgIGNvbnRlbnQ6IFwiKCogUmVxdWlyZWQpXCI7XHJcbiAgICBmb250LXNpemU6IDAuNjg3NXJlbTtcclxuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgIHRvcDogLTJweCAhaW1wb3J0YW50O1xyXG4gICAgbGVmdDogMzBweCAhaW1wb3J0YW50O1xyXG4gICAgcmlnaHQ6IDA7XHJcbiAgICBjb2xvcjogI2ZmMDAwMDtcclxuIH1cclxuXHJcbiAgLmJhY2tncm91bmR1cGxvYWRiYXNpY2luZm8ge1xyXG4gICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAubWFwcGluZ3dpZHRoIC5tYXBwaW5nc2lkZW5hdndpZHRoIHtcclxuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2Uge1xyXG4gICAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC50aXRsZXRleHQge1xyXG4gICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLmNsb3NlYW5kYWRkIHtcclxuICAgICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgIH1cclxuICAgIC5zcGFjaW5nIHtcclxuICAgICAgcGFkZGluZy1yaWdodDogMTBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gIH1cclxuICAudG9waGVhZGVybWFpbiB7XHJcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5lYWNoc29jaWFsbGluayB7XHJcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gIH1cclxuXHJcbiAgLmFsaWduZmlsZWRzY2VydGlmaWNhdGUge1xyXG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgfVxyXG5cclxuICAuZWFjaHNvY2lhbGxpbmsgcCB7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuYWxpZ25zcGFjZSB7XHJcbiAgICBtYXJnaW4tbGVmdDogMTBweDtcclxuICB9XHJcblxyXG4gIC5hZGRidXR0b24ge1xyXG4gICAgbWFyZ2luLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcclxuICB9XHJcbiAgLmxpc3RiYXNpY2luZm8gLmFsaWduZmlsZWRzIHtcclxuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gIH1cclxuICAudG9waGVhZGVybWFpbiAuaW1hZ2V3aXRodGV4dCB7XHJcbiAgICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxuICAgIHBhZGRpbmctbGVmdDogMTBweDtcclxuICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gIH1cclxuICAuYmFja2dyb3VuZHVwbG9hZGJhc2ljaW5mbyB7XHJcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gIH1cclxuXHJcbiAgLmFsaWdud2lkdGgge1xyXG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLmltYWdlYWxpZ25zcGFjZSB7XHJcbiAgICBwYWRkaW5nLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcclxuICB9XHJcbiAgLndpZHRoZmlsZWRzIHtcclxuICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICB9XHJcbiAgLndpZHRoZW1wIHtcclxuICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5zcGFjZW1hcmdpbiB7XHJcbiAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAudG9wYnJlYWRjcnVtYiB7XHJcbiAgICBwYWRkaW5nLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgfVxyXG4gIC5zcGFuY29sb3Ige1xyXG4gICAgcGFkZGluZy1sZWZ0OiAxMHB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5wYWRkaW5ncmlnaHQge1xyXG4gICAgcGFkZGluZy1yaWdodDogMTJweDtcclxuICB9XHJcbiAgLm1hcmdpbnJpZ2h0IHtcclxuICAgIG1hcmdpbi1yaWdodDogMTJweDtcclxuICB9XHJcbiAgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIHtcclxuICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICB9XHJcbiAgLnRhcmdldHdpZHRoIC5pbm5uZXJwYXJ0b2ZkcndlciB7XHJcbiAgICBwYWRkaW5nLWJvdHRvbTogNzBweCAhaW1wb3J0YW50O1xyXG4gICAgbWF4LWhlaWdodDogY2FsYygxMDB2aCAtIDE0MHB4KSAhaW1wb3J0YW50O1xyXG4gICAgb3ZlcmZsb3cteDogaGlkZGVuO1xyXG4gICAgb3ZlcmZsb3cteTogYXV0bztcclxuICAgIGhlaWdodDogMTAwJTtcclxuICB9XHJcbiAgLnRhcmdldHdpZHRoIC5zaWRlbmF2c2FtZXdpZHRoYWxsIHtcclxuICAgIHBvc2l0aW9uOiBmaXhlZCAhaW1wb3J0YW50O1xyXG4gICAgbWluLXdpZHRoOiAzMDBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSB7XHJcbiAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcclxuICB9XHJcbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLnRpdGxldGV4dCB7XHJcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gIH1cclxuICAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAuY2xvc2VhbmRhZGQge1xyXG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICB9XHJcbiAgLnNwYWNpbmcge1xyXG4gICAgcGFkZGluZy1yaWdodDogMTBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuXHJcbiAgLmFkZGVkY2VydGlmaWNhdGUge1xyXG4gICAgcGFkZGluZzogMjBweDtcclxuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkZGQ7XHJcbiAgfVxyXG4gIC5lZGl0YW5kZGVsZXRlIHtcclxuICAgIGRpc3BsYXk6IGlubGluZS1mbGV4O1xyXG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcclxuICAgIG1hcmdpbi10b3A6IDEwcHg7XHJcbiAgfVxyXG59XHJcblxyXG4ucGFnZXRpdGxlIHtcclxuICBoZWlnaHQ6IDUwcHg7XHJcbiAgd2lkdGg6IDEwMHB4O1xyXG4gIGJhY2tncm91bmQ6ICMwMDA7XHJcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG5cclxuICAvLyBBbmltYXRpb25cclxuICBhbmltYXRpb24tZHVyYXRpb246IDEuN3M7XHJcbiAgYW5pbWF0aW9uLWZpbGwtbW9kZTogZm9yd2FyZHM7XHJcbiAgYW5pbWF0aW9uLWl0ZXJhdGlvbi1jb3VudDogaW5maW5pdGU7XHJcbiAgYW5pbWF0aW9uLXRpbWluZy1mdW5jdGlvbjogbGluZWFyO1xyXG4gIGFuaW1hdGlvbi1uYW1lOiBwYWdldGl0bGVBbmltYXRlO1xyXG4gIGJhY2tncm91bmQ6ICNmNmY3Zjg7IC8vIEZhbGxiYWNrXHJcbiAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KHRvIHJpZ2h0LCAjZWVlIDIlLCAjZGRkIDE4JSwgI2VlZSAzMyUpO1xyXG4gIGJhY2tncm91bmQtc2l6ZTogMTMwMHB4OyAvLyBBbmltYXRpb24gQXJlYVxyXG59XHJcbkBrZXlmcmFtZXMgcGFnZXRpdGxlQW5pbWF0ZSB7XHJcbiAgMCUge1xyXG4gICAgYmFja2dyb3VuZC1wb3NpdGlvbjogLTY1MHB4IDA7XHJcbiAgfVxyXG4gIDEwMCUge1xyXG4gICAgYmFja2dyb3VuZC1wb3NpdGlvbjogNjUwcHggMDtcclxuICB9XHJcbn1cclxuLnNreWNhcmRsb2FkZXJpdGVtIHtcclxuICBoZWlnaHQ6IDUwcHg7XHJcbiAgd2lkdGg6IDIxMHB4O1xyXG4gIGJhY2tncm91bmQ6ICMwMDA7XHJcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG5cclxuICAvLyBBbmltYXRpb25cclxuICBhbmltYXRpb24tZHVyYXRpb246IDEuN3M7XHJcbiAgYW5pbWF0aW9uLWZpbGwtbW9kZTogZm9yd2FyZHM7XHJcbiAgYW5pbWF0aW9uLWl0ZXJhdGlvbi1jb3VudDogaW5maW5pdGU7XHJcbiAgYW5pbWF0aW9uLXRpbWluZy1mdW5jdGlvbjogbGluZWFyO1xyXG4gIGFuaW1hdGlvbi1uYW1lOiBwYWdldGl0bGVBbmltYXRlO1xyXG4gIGJhY2tncm91bmQ6ICNmNmY3Zjg7IC8vIEZhbGxiYWNrXHJcbiAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KHRvIHJpZ2h0LCAjZWVlIDIlLCAjZGRkIDE4JSwgI2VlZSAzMyUpO1xyXG4gIGJhY2tncm91bmQtc2l6ZTogMTMwMHB4OyAvLyBBbmltYXRpb24gQXJlYVxyXG4gIC5za3ljYXJkbG9hZGVyaXRlbTpiZWZvcmUge1xyXG4gICAgd2lkdGg6IGluaGVyaXQ7XHJcbiAgICBoZWlnaHQ6IGluaGVyaXQ7XHJcbiAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gIH1cclxufVxyXG5cclxuQGtleWZyYW1lcyBza3ljYXJkbG9hZGVyaXRlbUFuaW1hdGUge1xyXG4gIDAlIHtcclxuICAgIGJhY2tncm91bmQtcG9zaXRpb246IC02NTBweCAwO1xyXG4gIH1cclxuICAxMDAlIHtcclxuICAgIGJhY2tncm91bmQtcG9zaXRpb246IDY1MHB4IDA7XHJcbiAgfVxyXG59XHJcblxyXG4ucGxhY2Vob2xkZXJjZW50ZXIge1xyXG4gIGhlaWdodDogNTBweDtcclxuICB3aWR0aDogMTAwJTtcclxuICBiYWNrZ3JvdW5kOiAjMDAwO1xyXG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuXHJcbiAgLy8gQW5pbWF0aW9uXHJcbiAgYW5pbWF0aW9uLWR1cmF0aW9uOiAxLjdzO1xyXG4gIGFuaW1hdGlvbi1maWxsLW1vZGU6IGZvcndhcmRzO1xyXG4gIGFuaW1hdGlvbi1pdGVyYXRpb24tY291bnQ6IGluZmluaXRlO1xyXG4gIGFuaW1hdGlvbi10aW1pbmctZnVuY3Rpb246IGxpbmVhcjtcclxuICBhbmltYXRpb24tbmFtZTogcGFnZXRpdGxlQW5pbWF0ZTtcclxuICBiYWNrZ3JvdW5kOiAjZjZmN2Y4OyAvLyBGYWxsYmFja1xyXG4gIGJhY2tncm91bmQ6IGxpbmVhci1ncmFkaWVudCh0byByaWdodCwgI2VlZSAxJSwgI2RkZCAxOCUsICNlZWUgMzMlKTtcclxuICBiYWNrZ3JvdW5kLXNpemU6IDEzMDBweDsgLy8gQW5pbWF0aW9uIEFyZWFcclxuICAucGxhY2Vob2xkZXJjZW50ZXI6YmVmb3JlIHtcclxuICAgIHdpZHRoOiBpbmhlcml0O1xyXG4gICAgaGVpZ2h0OiBpbmhlcml0O1xyXG4gICAgY29udGVudDogXCJcIjtcclxuICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICB9XHJcbn1cclxuXHJcbkBrZXlmcmFtZXMgcGxhY2Vob2xkZXJjZW50ZXJBbmltYXRlIHtcclxuICAwJSB7XHJcbiAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiAtNjUwcHggMDtcclxuICB9XHJcbiAgMTAwJSB7XHJcbiAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiA2NTBweCAwO1xyXG4gIH1cclxufVxyXG5cclxuLmp1c3RpZnkge1xyXG4gIEBpbmNsdWRlIHNwYWNlYmV0d2VlbigpO1xyXG59XHJcbi5hcHByb3ZhbGFsaWduIHtcclxuICB3aWR0aDogODMuMzMlO1xyXG4gIG1hcmdpbi1sZWZ0OiBhdXRvO1xyXG4gIG1hcmdpbi1yaWdodDogYXV0bztcclxufVxyXG4uY2FyZGxlZnR3aWR0aCB7XHJcbiAgd2lkdGg6IDEwMCU7XHJcbn1cclxuXHJcbi5hbGlnbmNhcmQge1xyXG4gIGRpc3BsYXk6IGZsZXg7XHJcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG59XHJcblxyXG4uYWNjb3JkaW9ud2lkdGgge1xyXG4gIHdpZHRoOiAxMDAlO1xyXG4gIGhlaWdodDogNTBweDtcclxuICBiYWNrZ3JvdW5kOiAjMDAwO1xyXG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAvLyBBbmltYXRpb25cclxuICBhbmltYXRpb24tZHVyYXRpb246IDEuN3M7XHJcbiAgYW5pbWF0aW9uLWZpbGwtbW9kZTogZm9yd2FyZHM7XHJcbiAgYW5pbWF0aW9uLWl0ZXJhdGlvbi1jb3VudDogaW5maW5pdGU7XHJcbiAgYW5pbWF0aW9uLXRpbWluZy1mdW5jdGlvbjogbGluZWFyO1xyXG4gIGFuaW1hdGlvbi1uYW1lOiBwYWdldGl0bGVBbmltYXRlO1xyXG4gIGJhY2tncm91bmQ6ICNmNmY3Zjg7IC8vIEZhbGxiYWNrXHJcbiAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KHRvIHJpZ2h0LCAjZWVlIDElLCAjZGRkIDE4JSwgI2VlZSAzMyUpO1xyXG4gIGJhY2tncm91bmQtc2l6ZTogMTMwMHB4OyAvLyBBbmltYXRpb24gQXJlYVxyXG4gIC5hY2NvcmRpb253aWR0aDpiZWZvcmUge1xyXG4gICAgd2lkdGg6IGluaGVyaXQ7XHJcbiAgICBoZWlnaHQ6IGluaGVyaXQ7XHJcbiAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gIH1cclxufVxyXG5cclxuQGtleWZyYW1lcyBhY2NvcmRpb253aWR0aEFuaW1hdGUge1xyXG4gIDAlIHtcclxuICAgIGJhY2tncm91bmQtcG9zaXRpb246IC02NTBweCAwO1xyXG4gIH1cclxuICAxMDAlIHtcclxuICAgIGJhY2tncm91bmQtcG9zaXRpb246IDY1MHB4IDA7XHJcbiAgfVxyXG59XHJcbi5hbGlnbmVuZCB7XHJcbiAgQGluY2x1ZGUgZmxleGVuZCgpO1xyXG4gIG1hcmdpbi10b3A6IDIwcHg7XHJcbn1cclxuXHJcbkBtZWRpYSAobWluLXdpZHRoOiA3NjhweCkge1xyXG4gIC5tYXJnaW5zcGFjZXtcclxuICAgIG1hcmdpbi1sZWZ0OiAxNXB4O1xyXG4gICAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xyXG4gIH1cclxuICAuY2hlY2tldmVuY2hpbGQge1xyXG4gICAgZGl2Om50aC1vZi10eXBlKGV2ZW4pIHtcclxuICAgICAgcGFkZGluZy1sZWZ0OiAzMHB4IDtcclxuICAgICAgLmFsaWducmVtb3ZlXHJcbiAgICAgIHtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xyXG4gICAgICB9XHJcbiAgICAgIC5zdXB0ZXh0Y29sb3Ige1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICBsZWZ0OiAxNXB4O1xyXG4gICAgICAgIHRvcDogMTVweDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgICBkaXY6bnRoLW9mLXR5cGUob2RkKSB7XHJcbiAgICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIC5zdXB0ZXh0Y29sb3Ige1xyXG4gICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICBsZWZ0OiAwO1xyXG4gICAgICAgIHRvcDogMDtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG4gIFxyXG59XHJcbi5hbGlnbnJlbW92ZXtcclxuICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbn1cclxuXHJcblxyXG4ucmlnaHRzaWRlZGV0YWlscyBwIHtcclxuICBjb2xvcjogIzMzMztcclxuICBmb250LXNpemU6IDAuODc1cmVtO1xyXG4gIG1hcmdpbjogMDtcclxuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcclxufVxyXG5cclxuLmFjY2VwdGVkY29sb3J7XHJcbiAgcGFkZGluZy10b3A6IDUwcHg7XHJcbiAgcHtcclxuICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICAgIG1hcmdpbjogMDtcclxuICB9XHJcbiAgc3BhbntcclxuICAgIGNvbG9yOiAjMzMzO1xyXG4gICAgZm9udC1zaXplOiAwLjg3NXJlbTtcclxuICB9XHJcbn1cclxuW2Rpcj1ydGxdeyBcclxuICAucHJvZmlsZXZpZXdsaXN0IHtcclxuICAgIC5idC1kZWxldGUge1xyXG4gICAgICBsZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgcmlnaHQ6IDkwJSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG4gICAgICNjcmVhdGlvbmxpc3Qge1xyXG4gICAgICAuY291bnRyeWFuZGNyaW5mbyAuZWFjaGl0ZW0ge1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICAgfVxyXG4gIH1cclxuICAuY2hlY2tldmVuY2hpbGQge1xyXG4gICAgZGl2Om50aC1vZi10eXBlKGV2ZW4pIHtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDMwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuICAgICBkaXY6bnRoLW9mLXR5cGUob2RkKSB7XHJcbiAgICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgIH1cclxuICB9XHJcbiAgLnVzZXJwcm9maWxtYWlsaWRtYWlse1xyXG4gICAgLm1hdC1mb3JtLWZpZWxkLWluZml4e1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuICAgIC5vdHBoZWFkZXJfcmVne1xyXG4gICAgICAjcGFydGl0aW9uZWR1c2VycHJvZmlsZSB7XHJcbiAgICAgICAgbWluLXdpZHRoOiAyMzlweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfVxyXG59XHJcblxyXG5cclxuXHJcblxyXG4ucmVzZW5kb3RwIGJ1dHRvbiB7XHJcbiAgYmFja2dyb3VuZDogbm9uZTtcclxuICBib3JkZXI6IG5vbmU7XHJcbiAgdGV4dC1kZWNvcmF0aW9uOiB1bmRlcmxpbmU7XHJcbiAgY29sb3I6ICM0Y2EyYWM7XHJcbiAgZm9udC1zaXplOiAxNHB4O1xyXG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvcmVndWxhclwiO1xyXG4gIG1hcmdpbi1ib3R0b206IDYwcHg7XHJcbiAgY3Vyc29yOiBwb2ludGVyO1xyXG59XHJcblxyXG4udXNlcnByb2ZpbG1haWxpZG1haWx7XHJcbiAgICAubWF0LWZvcm0tZmllbGQtaW5maXh7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgfVxyXG4gICAgLm90cGhlYWRlcl9yZWd7XHJcbiAgICAgIG1hcmdpbi10b3A6IC0yMHB4O1xyXG4gICAgICAucmVzZW5kb3RwY29sb3J7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjNGFhMmFjICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIHRleHQtZGVjb3JhdGlvbjogdW5kZXJsaW5lO1xyXG4gICAgICB9XHJcbiAgICBcclxuICAgICAgI3BhcnRpdGlvbmVkdXNlcnByb2ZpbGUge1xyXG4gICAgICAgICAgbGV0dGVyLXNwYWNpbmc6IDMwcHg7XHJcbiAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDE1cHg7XHJcbiAgICAgICAgICBib3JkZXI6IDA7XHJcbiAgICAgICAgICB3aWR0aDogMzUwO1xyXG4gICAgICAgICAgbWluLXdpZHRoOiAzNTBweDtcclxuICAgICAgICAgIG91dGxpbmU6IG5vbmU7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kLWltYWdlOiBsaW5lYXItZ3JhZGllbnQodG8gbGVmdCwgYmxhY2sgNzAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDApIDAlKTtcclxuICAgICAgICAgIGJhY2tncm91bmQtcG9zaXRpb246IGJvdHRvbTtcclxuICAgICAgICAgIGJhY2tncm91bmQtc2l6ZTogMzdweCAxcHg7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kLXJlcGVhdDogcmVwZWF0LXg7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uLXg6IDM1cHg7IFxyXG4gICAgICAgICAgb3V0bGluZTogbm9uZTtcclxuICAgICAgICAgIG1heC13aWR0aDogNDEycHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgICNkaXZJbm5lciB7XHJcbiAgICAgICAgICBsZWZ0OiAwO1xyXG4gICAgICAgICAgcG9zaXRpb246IHN0aWNreTtcclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgI2Rpdk91dGVyIHtcclxuICAgICAgICAgIHdpZHRoOiAyMjNweDtcclxuICAgICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5hbGlnbmZsZXgge1xyXG4gICAgICAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgICAgICAgIHdpZHRoOiA0MDJweDtcclxuICAgICAgICB9IFxyXG4gICAgICB9XHJcblxyXG4gICBcclxuICAgIC52ZXJpZmllZGNvbnRlbnRidG57XHJcbiAgICAgIGJhY2tncm91bmQ6ICM2M2ExMjY7XHJcbiAgICAgIG1pbi13aWR0aDogODZweDtcclxuICAgICAgbWF4LXdpZHRoOiA4NnB4O1xyXG4gICAgICBoZWlnaHQ6IDI2cHg7XHJcbiAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICAgIEBpbmNsdWRlIGZsZXhjZW50ZXIoKTtcclxuICAgICAgZm9udC1zaXplOiAxNHB4O1xyXG4gICAgICBtYXJnaW4tdG9wOiA4cHg7XHJcbiAgICAgIGl7XHJcbiAgICAgICAgICB3aWR0aDogMThweDtcclxuICAgICAgICAgIGhlaWdodDogMThweDtcclxuICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgICBib3JkZXItcmFkaXVzOiA1MCU7XHJcbiAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgICAgICBjb2xvcjogIzYzYTEyNjtcclxuICAgICAgfVxyXG4gIH1cclxuLy8gI3ZlcmlmeWVtYWlsdG9we1xyXG4vLyAgICAgLnZlcmlmeXRhZ3RvcHtcclxuLy8gICAgICAgLy8gbWFyZ2luLXRvcDogMTZweDtcclxuLy8gICAgIH1cclxuLy8gfVxyXG4gICNtb2JpbGV2ZXJpZnlzcGFjZXtcclxuICAgIC52ZXJpZnl0b3B7XHJcbiAgICAgIG1hcmdpbi10b3A6IDhweDtcclxuICAgIH1cclxuICAgfVxyXG4gICAuc3VibWl0d3JhcHtcclxuICAgIC5tYXQtYnV0dG9uLXdyYXBwZXJ7XHJcbiAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICB9XHJcbiAgIH1cclxuICAgIC5zdWJtaXRidG5lZGl0IHtcclxuICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjNGFhMWFjO1xyXG4gICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgYm9yZGVyOiBub25lO1xyXG4gICAgICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XHJcbiAgICAgIG1hcmdpbi10b3A6IDhweDtcclxuICAgICAgc3Bhbi5idXR0b24tdGV4dCB7XHJcbiAgICAgICAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICAgICAgYnV0dG9ue1xyXG4gICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxO1xyXG4gICAgICB9XHJcbiAgICAgICY6aG92ZXJ7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI0UwQUQ2NztcclxuICAgICAgfVxyXG4gICAgfSBcclxufVxyXG5cclxuI3NlbGVjdF92YWx1ZXRyaWdnZXJ7XHJcbiAgLm1hdC1zZWxlY3QtZGlzYWJsZWR7XHJcbiAgICAubWF0LXNlbGVjdC12YWx1ZSB7XHJcbiAgICAgIGN1cnNvcjogbm8tZHJvcDtcclxuICAgfVxyXG4gIH0gICAgIFxyXG59XHJcbiNlbWFpbG90cHNwaW5uZXJ7XHJcbiAgIFxyXG4gIGJ1dHRvblxyXG4gIHtcclxuICAgIC5zcGlubmVye1xyXG4gICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgIHRvcDphdXRvICFpbXBvcnRhbnQ7XHJcbiAgIH1cclxuICB9XHJcbn0iLCIucG9pbnRlciB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cblxuLnNlbGVjdF93aXRoX3NlYXJjaCB7XG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcbiAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiA0MHB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDE1cHggIWltcG9ydGFudDtcbn1cblxuLndpZHRoaW1nIHtcbiAgd2lkdGg6IDI0cHg7XG4gIGhlaWdodDogMTZweDtcbiAgbWFyZ2luLXJpZ2h0OiA1cHg7XG59XG5cbiN3aXRoQ2xlYXJfY2VydGZpY2F0ZSAuaW5mb3N0ZXBzX2NlcnRmaWNhdGU6OmFmdGVyIHtcbiAgcmlnaHQ6IDIwNHB4ICFpbXBvcnRhbnQ7XG4gIGxlZnQ6IGF1dG8gIWltcG9ydGFudDtcbn1cblxuLnByb2ZpbGV2aWV3bGlzdCB7XG4gIGJhY2tncm91bmQ6IGxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICNmZmYgMTgzcHgsICNmZmYgMTQ1cHggNDAlKSAhaW1wb3J0YW50O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuYWRkaW5nZGVwYXJ0bWVudCB7XG4gIGNvbG9yOiAjRTBBRDY3O1xuICBmb250LXNpemU6IDAuNzVyZW07XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi5wcm9maWxldmlld2xpc3QgLmluZGV4bWRlc3BhY2Uge1xuICB6LWluZGV4OiA5O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAubWRlcHNhcGNlIHtcbiAgbWFyZ2luLXRvcDogLTE2cHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5tZGVwc2FwY2Ugc3BhbiB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi5wcm9maWxldmlld2xpc3QgLmJ0LWRlbGV0ZSB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IDM1cHg7XG4gIHJpZ2h0OiAwcHg7XG4gIGZvbnQtc2l6ZTogMC43NXJlbTtcbn1cbi5wcm9maWxldmlld2xpc3QgLmZpbGVkYm9yZGVyIC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xuICBiYWNrZ3JvdW5kLWltYWdlOiBsaW5lYXItZ3JhZGllbnQodG8gcmlnaHQsIHJnYmEoMCwgMCwgMCwgMC40MikgMCUsIHJnYmEoMCwgMCwgMCwgMC40MikgMzMlLCB0cmFuc3BhcmVudCAwJSk7XG4gIGJhY2tncm91bmQtc2l6ZTogNHB4IDEwMCU7XG4gIGJhY2tncm91bmQtcmVwZWF0OiByZXBlYXQteDtcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5jb21tb25leHBhbmRhbmRjb2xsYXBzZSBtYXQtZXhwYW5zaW9uLXBhbmVsLm1hdC1leHBhbmRlZCB7XG4gIG1hcmdpbi1ib3R0b206IDMwcHggIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMzBweCAhaW1wb3J0YW50O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAudGV4dG9yZ2FuZ2Uge1xuICBjb2xvcjogI2RmYWQ2NiAhaW1wb3J0YW50O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuYWxpZ25yZW1vdmV3aWR0aCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICB3aWR0aDogMTAwJTtcbn1cbi5wcm9maWxldmlld2xpc3QgLmFsaWducmVtb3Zld2lkdGggc3BhbiB7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi5wcm9maWxldmlld2xpc3QgLmFsaWducmVtb3ZlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiAxMDAlO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuYWxpZ25yZW1vdmUgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xuICBoZWlnaHQ6IDFweDtcbiAgYmFja2dyb3VuZDogI2M5Y2JkNztcbn1cbi5wcm9maWxldmlld2xpc3QgLnZlbnVld2lkdGgge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAubnVtYmVyYW5kY29kZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5hbGlnbml0ZW1zIHtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgd2lkdGg6IDc3JTtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAucHJvZmlsZXZpZXdsaXN0IC5hbGlnbml0ZW1zIHtcbiAgICB3aWR0aDogMTAwJTtcbiAgfVxufVxuLnByb2ZpbGV2aWV3bGlzdCAuc3VwZXJ2aXNvcnRleHRjb2xvciB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cbi5wcm9maWxldmlld2xpc3QgLnN1cGVydmlzb3J0ZXh0Y29sb3IgcCwgLnByb2ZpbGV2aWV3bGlzdCAuc3VwZXJ2aXNvcnRleHRjb2xvciAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIC5zdXBlcnZpc29ydGV4dGNvbG9yIHNwYW4ge1xuICBjb2xvcjogIzY2NjY2NjtcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5pbWdhbGlnbmZsZXggaW1nIHtcbiAgd2lkdGg6IDcwcHg7XG4gIGhlaWdodDogNzBweDtcbiAgb2JqZWN0LWZpdDogY292ZXI7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNkNmRiZTM7XG4gIGJvcmRlci1yYWRpdXM6IDRweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQge1xuICBwYWRkaW5nLXRvcDogMjBweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQgLmNoYW5nZWFsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5jaGFuZ2VhbGlnbiBoMiB7XG4gIGNvbG9yOiAjMzMzMzMzO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgbWFyZ2luOiAwcHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5jaGFuZ2VhbGlnbiBwLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5jaGFuZ2VhbGlnbiAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIC5jaGFuZ2VhbGlnbiBzcGFuIHtcbiAgZm9udC1zaXplOiAwLjgxMjVyZW07XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjZjQ4MTFmO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgaDIge1xuICBjb2xvcjogIzMzMzMzMztcbiAgbWFyZ2luOiAwcHg7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbn1cbi5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQgLnBhcGVybm90ZWNvbG9yIHAsIC5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQgLnBhcGVybm90ZWNvbG9yIHAgc3BhbiB7XG4gIG1hcmdpbjogMHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuIHtcbiAgY29sb3I6ICM0YWExYWMgIWltcG9ydGFudDtcbn1cbi5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQgLmFkZHJlc3Njb2xvciBwLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5hZGRyZXNzY29sb3IgLnBhcGVybm90ZWNvbG9yIHAgc3BhbiwgLnByb2ZpbGV2aWV3bGlzdCAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCAuYWRkcmVzc2NvbG9yIHNwYW4ge1xuICBtYXJnaW46IDBweDtcbiAgY29sb3I6ICM0YWExYWM7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5hZGRyZXNzY29sb3Igc3BhbiB7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuc2hhZG93Y2FyZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGJvcmRlcjogc29saWQgMXB4ICNlMmU0ZTg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG4gIGJvcmRlci1yYWRpdXM6IDA7XG4gIHBhZGRpbmc6IDE1cHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbi5wcm9maWxldmlld2xpc3QgLnNoYWRvd2NhcmQgLnN1cHBsaWVydGV4dGNvbG9yIHNwYW4ge1xuICBjb2xvcjogIzAwNmNiNztcbiAgZm9udC1zaXplOiAxcmVtO1xuICBmb250LXdlaWdodDogYm9sZDtcbn1cbi5wcm9maWxldmlld2xpc3QgLnNoYWRvd2NhcmQgLm1hdC1jYXJkLWhlYWRlciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIHdpZHRoOiAxMDAlO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gIHBhZGRpbmc6IDBweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLnNoYWRvd2NhcmQgLnNlbGVjdGpzcnRleHQgcCwgLnByb2ZpbGV2aWV3bGlzdCAuc2hhZG93Y2FyZCAuc2VsZWN0anNydGV4dCAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIC5zaGFkb3djYXJkIC5zZWxlY3Rqc3J0ZXh0IHNwYW4ge1xuICBjb2xvcjogIzMzMzMzMztcbiAgcGFkZGluZy10b3A6IDVweDtcbiAgbWFyZ2luOiAwcHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5zaGFkb3djYXJkIC5zZWxlY3Rmb3J3YXJkIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuc2hhZG93Y2FyZCAuc2VsZWN0Zm9yd2FyZCBpIHtcbiAgdHJhbnNmb3JtOiByb3RhdGUoMjcwZGVnKTtcbiAgY29sb3I6ICM3Nzc7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5zZWFyY2hpbm11bHRpc2VsZWN0IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgcGFkZGluZzogNnB4IDEwcHg7XG4gIGJhY2tncm91bmQ6ICNlOWVkZjA7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5zZWFyY2hpbm11bHRpc2VsZWN0IGlucHV0Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVyIHtcbiAgY29sb3I6ICM3ZjhmYTMgIWltcG9ydGFudDtcbn1cbi5wcm9maWxldmlld2xpc3QgLnNlYXJjaGlubXVsdGlzZWxlY3QgaSB7XG4gIGNvbG9yOiAjN2Y4ZmEzICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctcmlnaHQ6IDZweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLnNlYXJjaGlubXVsdGlzZWxlY3QgLnNlYXJjaHNlbGVjdCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuc2VhcmNoaW5tdWx0aXNlbGVjdCAucmVzZXRpY29uIHtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAub3B0aW9uLWxpc3Rpbmcge1xuICBvdmVyZmxvdy14OiBhdXRvO1xuICBvdmVyZmxvdy15OiBhdXRvO1xuICBtYXgtaGVpZ2h0OiAyOTBweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLmZsYWd3aXRoY29kZSBpbWcge1xuICBtYXgtd2lkdGg6IDI0cHg7XG4gIGhlaWdodDogMTZweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLmNvdW50cnluYW1lc2VsZWN0IHtcbiAgbGluZS1oZWlnaHQ6IDQwcHggIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA0MHB4ICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5zdXB0ZXh0Y29sb3IgcCwgLnByb2ZpbGV2aWV3bGlzdCAuc3VwdGV4dGNvbG9yIC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIHNwYW4sIC5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQgLnBhcGVybm90ZWNvbG9yIHAgLnN1cHRleHRjb2xvciBzcGFuIHtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBmb250LXNpemU6IDAuODEyNXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIGNvbG9yOiAjNGFhMWFjO1xuICB0ZXh0LWFsaWduOiBlbmQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5hbGlnbnB1Ymxpc2gge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC52ZW51ZWNvbG9yIHtcbiAgY29sb3I6ICM0YWExYWM7XG4gIGZvbnQtc2l6ZTogMC44NzVyZW07XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5lZGl0YW5kZGVsZXRlIHtcbiAgZGlzcGxheTogaW5saW5lLWZsZXg7XG4gIG1hcmdpbi1ib3R0b206IDEwcHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5lZGl0YW5kZGVsZXRlIC5lZGl0IHtcbiAgY29sb3I6ICM5OTk7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5lZGl0YW5kZGVsZXRlIGkge1xuICBmb250LXNpemU6IDFyZW07XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5lZGl0YW5kZGVsZXRlIHNwYW4ge1xuICBvcGFjaXR5OiAwO1xuICB3aWR0aDogMzVweDtcbiAgaGVpZ2h0OiAzNXB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5hbGlnbnZlbnVlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY2VydGlmaWNhdGVpbWFnZSBpIHtcbiAgY29sb3I6ICMwMDZjYjc7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmFkZGVkY2VydGlmaWNhdGUge1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcbiAgcGFkZGluZzogMjBweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5hZGRlZGNlcnRpZmljYXRlOmhvdmVyIC5jZXJ0aWZpY2F0ZWltYWdlIHtcbiAgYmFja2dyb3VuZDogIzAwNmNiNztcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuYWRkZWRjZXJ0aWZpY2F0ZTpob3ZlciAuY2VydGlmaWNhdGVpbWFnZSBpIHtcbiAgY29sb3I6ICNmZmY7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgLmVkaXRhbmRkZWxldGUgc3BhbiB7XG4gIG9wYWNpdHk6IDE7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG4gIGNvbG9yOiAjNWY1MzUzO1xuICBib3JkZXItcmFkaXVzOiA1MCU7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgLmxhYmxlbmFtZSB7XG4gIGNvbG9yOiAjMDA2Y2I3ICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmFkZGVkY2VydGlmaWNhdGU6aG92ZXIgLm5hbWUge1xuICBjb2xvcjogIzRhYTFhYztcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuYWRkZWRjZXJ0aWZpY2F0ZTpmb2N1cyB7XG4gIGJvcmRlcjogMXB4IGRvdHRlZCAjZGRkO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5hZGRlZGNlcnRpZmljYXRlOmFjdGl2ZSB7XG4gIGJvcmRlcjogMXB4IGRvdHRlZCAjZGRkO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5jZXJ0aWZpY2F0ZXMge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5jZXJ0aWZpY2F0ZWluZm8ge1xuICBwYWRkaW5nLWxlZnQ6IDIwcHg7XG4gIGxpbmUtaGVpZ2h0OiAxLjg7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNlcnRpZmljYXRlaW5mbyBwLCAucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNlcnRpZmljYXRlaW5mbyAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwICNjcmVhdGlvbmxpc3QgLmNlcnRpZmljYXRlaW5mbyBzcGFuIHtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgbWFyZ2luOiAwO1xuICBjb2xvcjogIzAwMDtcbiAgcGFkZGluZy1ib3R0b206IDEwcHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNlcnRpZmljYXRlaW5mbyAuY2VybGFiZWwge1xuICBjb2xvcjogIzk5OTtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY2VydGlmaWNhdGVpbmZvIC5oZWFkZXIge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAxLjEyNXJlbTtcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XG4gIHBhZGRpbmctYm90dG9tOiAxNXB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5hbGlnbnNwYWNlIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY29tcGFueWFuZG9mZmljZWluZm8gcCwgLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5jb21wYW55YW5kb2ZmaWNlaW5mbyAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwICNjcmVhdGlvbmxpc3QgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIHNwYW4ge1xuICBtYXJnaW46IDA7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIC5jcmFuZGJyYW5jaGlkcyB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXRvcDogMTBweDtcbiAgcGFkZGluZy1ib3R0b206IDEwcHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIC5jcmFuZGJyYW5jaGlkcyAuY291bnQge1xuICBmb250LWZhbWlseTogXCJjYWlyb3NlbWlib2xkXCI7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIC50aXRsZSB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDAuNzVyZW07XG4gIG1hcmdpbjogMDtcbiAgbGluZS1oZWlnaHQ6IDAuOTtcbiAgcGFkZGluZy1ib3R0b206IDZweDtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY29tcGFueWFuZG9mZmljZWluZm8gLmxhYmxlbmFtZSB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDAuNzVyZW07XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIC5mbGV4b21hbiBzcGFuIHtcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNvbXBhbnlhbmRvZmZpY2VpbmZvIC5uYW1lIHtcbiAgY29sb3I6ICMzMzMzMzM7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xuICBtYXJnaW46IDBweDtcbiAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgbGluZS1oZWlnaHQ6IDIycHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLm9mZmljZWFkZHJlc3NkZXRhaWwge1xuICBwYWRkaW5nLXRvcDogMjBweDtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAub2ZmaWNlYWRkcmVzc2RldGFpbCAuYWRkcmVzc2luZm8ge1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY2VydGlmaWNhdGVpbWFnZSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgd2lkdGg6IDgwcHg7XG4gIGhlaWdodDogODBweDtcbiAgYmFja2dyb3VuZDogI2U1ZWVmZTtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY2VydGlmaWNhdGVpbWFnZSBpbWcge1xuICBtYXgtd2lkdGg6IDEwMCU7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNvdW50cnlhbmRjcmluZm8ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY291bnRyeWFuZGNyaW5mbyAuZWFjaGl0ZW0ge1xuICBwYWRkaW5nLXJpZ2h0OiA0MHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5jb3VudHJ5YW5kY3JpbmZvIC5lYWNoaXRlbSBpbWcge1xuICB3aWR0aDogMjJweDtcbiAgcGFkZGluZy1yaWdodDogOHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5jb3VudHJ5YW5kY3JpbmZvIC5lYWNoaXRlbTpsYXN0LWNoaWxkIHtcbiAgcGFkZGluZy1yaWdodDogMDtcbn1cbi5wcm9maWxldmlld2xpc3QgI2NyZWF0aW9ubGlzdCAuY291bnRyeWFuZGNyaW5mbyAuZWFjaGl0ZW0gcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwICNjcmVhdGlvbmxpc3QgLmNvdW50cnlhbmRjcmluZm8gLmVhY2hpdGVtIHNwYW4gc3BhbiB7XG4gIGNvbG9yOiAjNGFhMWFjICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLnBob25ld2lkdGgge1xuICBtaW4td2lkdGg6IDE2NXB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5jb3VudHJ5d2lkdGgge1xuICBtaW4td2lkdGg6IDE3MHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAjY3JlYXRpb25saXN0IC5tYWlsd2lkdGgge1xuICBtaW4td2lkdGg6IDIxMHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuZWFjaHNvY2lhbGxpbmsge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBwYWRkaW5nLWJvdHRvbTogMTJweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLmVhY2hzb2NpYWxsaW5rIGltZyB7XG4gIHdpZHRoOiAxNnB4O1xuICBoZWlnaHQ6IDE2cHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5lYWNoc29jaWFsbGluayBwLCAucHJvZmlsZXZpZXdsaXN0IC5lYWNoc29jaWFsbGluayAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIC5lYWNoc29jaWFsbGluayBzcGFuIHtcbiAgY29sb3I6ICMzMzM7XG4gIG1hcmdpbjogMDtcbiAgbWluLXdpZHRoOiAxMzBweDtcbn1cbi5wcm9maWxldmlld2xpc3QgLndlYnRleHRjb2xvciBoMiB7XG4gIGNvbG9yOiAjMzQxZjQ0O1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbiAgbWFyZ2luOiAwcHg7XG4gIHBhZGRpbmctYm90dG9tOiAyMHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAudXJsYWxpZ24gLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5wcm9maWxldmlld2xpc3QgLmxpbmVoZWlnaHQge1xuICBsaW5lLWhlaWdodDogMTtcbn1cbi5wcm9maWxldmlld2xpc3QgLmFsaWducHJldmlldyB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5jb21wbGV0ZWQge1xuICBib3JkZXI6IDFweCBzb2xpZCAjZmZmO1xuICBoZWlnaHQ6IDIwcHg7XG4gIHdpZHRoOiAyMHB4O1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMTAwJTtcbiAgYmFja2dyb3VuZDogIzcxYzExNCAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDAuNjg3NXJlbTtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXJpZ2h0OiAxMHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAucGFnZW51bWJlcmNvbG9yYmxhbmsge1xuICBib3JkZXI6IDFweCBzb2xpZCAjZmZmO1xuICBoZWlnaHQ6IDIwcHg7XG4gIHdpZHRoOiAyMHB4O1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMTAwJTtcbiAgYmFja2dyb3VuZDogIzk5OTk5OTtcbiAgZm9udC1zaXplOiAwLjY4NzVyZW07XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5jYW5jZWxhbmRwdWJsaXNoIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBmbGV4LWVuZDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAuc2F2ZWFuZG5leHQge1xuICBiYWNrZ3JvdW5kOiAjNGFhMWFjO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xuICBtaW4td2lkdGg6IDEwMHB4O1xufVxuLnByb2ZpbGV2aWV3bGlzdCAucHJldmlvdXMge1xuICBiYWNrZ3JvdW5kOiAjZWNlY2VjO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNlY2VjZWMgIWltcG9ydGFudDtcbiAgY29sb3I6ICM5OTkgIWltcG9ydGFudDtcbiAgZm9udC1zaXplOiAxNXB4ICFpbXBvcnRhbnQ7XG4gIHdpZHRoOiBhdXRvO1xuICBtaW4td2lkdGg6IDgwcHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5hZGRidG5jb2xvciB7XG4gIGJhY2tncm91bmQ6ICNlY2VjZWM7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYm9yZGVyOiAxcHggc29saWQgI2VjZWNlYyAhaW1wb3J0YW50O1xuICBjb2xvcjogIzk5OSAhaW1wb3J0YW50O1xuICBmb250LXNpemU6IDE1cHggIWltcG9ydGFudDtcbiAgd2lkdGg6IGF1dG87XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5hbGlnbm5leHQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAucHVibGlzaCB7XG4gIG1pbi13aWR0aDogMTUwcHg7XG4gIGhlaWdodDogNDBweDtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5jYW5jZWwge1xuICBjb2xvcjogIzc3NztcbiAgYm9yZGVyOiAxcHggc29saWQgI2NiY2JjYjtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5jb3VudHJ5c2VsZWN0d2l0aGltYWdlIC5tYXQtb3B0aW9uIHtcbiAgbWFyZ2luLXJpZ2h0OiA3cHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5jb3VudHJ5c2VsZWN0d2l0aGltYWdlIC5tYXQtb3B0aW9uLXRleHQge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAubGlzdGJhc2ljaW5mbyAud2lkdGhmaWxlZHMge1xuICB3aWR0aDogNzAlO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAubGlzdGJhc2ljaW5mbyAud2lkdGhlbXAge1xuICB3aWR0aDogNTAlO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAubGlzdGJhc2ljaW5mbyAuYWxpZ25maWxlZHMge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5saXN0YmFzaWNpbmZvIC5iYWNrZ3JvdW5kdXBsb2FkYmFzaWNpbmZvIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiAxMjZweDtcbiAgd2lkdGg6IDEzNXB4O1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1hcmdpbjogMnB4O1xuICBwYWRkaW5nLXRvcDogMjBweDtcbiAgcGFkZGluZy1ib3R0b206IDIwcHg7XG59XG4ucHJvZmlsZXZpZXdsaXN0IC5saXN0YmFzaWNpbmZvIC5iYWNrZ3JvdW5kdXBsb2FkYmFzaWNpbmZvIC52aWV3aGVpZ2h0IHtcbiAgbWF4LWhlaWdodDogMTAwJTtcbn1cbi5wcm9maWxldmlld2xpc3QgLmxpc3RiYXNpY2luZm8gLmJhY2tncm91bmR1cGxvYWRiYXNpY2luZm8gcCwgLnByb2ZpbGV2aWV3bGlzdCAubGlzdGJhc2ljaW5mbyAuYmFja2dyb3VuZHVwbG9hZGJhc2ljaW5mbyAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIC5saXN0YmFzaWNpbmZvIC5iYWNrZ3JvdW5kdXBsb2FkYmFzaWNpbmZvIHNwYW4ge1xuICBjb2xvcjogIzk5OTk5OTtcbiAgZm9udC1zaXplOiAwLjc1cmVtO1xufVxuLnByb2ZpbGV2aWV3bGlzdCAubGlzdGJhc2ljaW5mbyAuaW5uZXJzaWRlIHtcbiAgcGFkZGluZzogNXB4O1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgd2lkdGg6IDIzJTtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAucHJvZmlsZXZpZXdsaXN0IC5saXN0YmFzaWNpbmZvIC5pbm5lcnNpZGUge1xuICAgIHdpZHRoOiAxMDAlO1xuICB9XG59XG5cbi50YXJnZXR3aWR0aCAuYWxpZ25maWxlZHNjZXJ0aWZpY2F0ZSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi50YXJnZXR3aWR0aCAuYWxpZ25maWxlZHNjZXJ0aWZpY2F0ZSAud2lkdGhlbXAge1xuICB3aWR0aDogNTAlO1xufVxuLnRhcmdldHdpZHRoIC51cGxvYWRsYWJlbCB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi50YXJnZXR3aWR0aCAudXBsb2FkbGFiZWwgaDQge1xuICBjb2xvcjogIzMzMztcbiAgbWFyZ2luOiAwcHg7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiAxMzY2cHgpIGFuZCAobWluLXdpZHRoOiAxMjgwcHgpIHtcbiAgLm1hcHBpbmd3aWR0aCAubWFwcGluZ3NpZGVuYXZ3aWR0aCB7XG4gICAgd2lkdGg6IDc1JSAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogMTAyNHB4KSBhbmQgKG1pbi13aWR0aDogNzY5cHgpIHtcbiAgLm1hcHBpbmd3aWR0aCAubWFwcGluZ3NpZGVuYXZ3aWR0aCB7XG4gICAgd2lkdGg6IDkwJSAhaW1wb3J0YW50O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgLnN1cGVydmlzb3J0ZXh0Y29sb3Ige1xuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgICB0b3A6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmNlcnRpZmljYXRld2lkdGgge1xuICAgIG1heC13aWR0aDogNzAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAudmVudWV3aWR0aCB7XG4gICAgbWF4LXdpZHRoOiAzMCUgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jaGVja2V2ZW5jaGlsZCBkaXY6bnRoLW9mLXR5cGUoZXZlbikge1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgLmNoZWNrZXZlbmNoaWxkIGRpdjpudGgtb2YtdHlwZShldmVuKSAuc3VwdGV4dGNvbG9yIHtcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gICAgbGVmdDogMDtcbiAgICB0b3A6IDA7XG4gICAgZGlzcGxheTogZmxleDtcbiAgfVxuXG4gIC5saW5laGVpZ2h0IHtcbiAgICBtYXJnaW4tYm90dG9tOiAxNXB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWFwcGluZ3dpZHRoIC5tYXBwaW5nc2lkZW5hdndpZHRoIHtcbiAgICB3aWR0aDogOTUlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAudG9waGVhZGVybWFpbiB7XG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbiAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnBhZ2V0aXRsZW5ldyB7XG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgfVxuXG4gIC5pbWFnZWFsaWduc3BhY2Uge1xuICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoZW1wIHtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnVybGFsaWduIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmFsaWduc3BhY2Uge1xuICAgIG1hcmdpbi1sZWZ0OiAxNXB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAudGFyZ2V0d2lkdGggLnNpZGVuYXZzYW1ld2lkdGhhbGwge1xuICAgIHBvc2l0aW9uOiBmaXhlZCAhaW1wb3J0YW50O1xuICAgIG1pbi13aWR0aDogNzMwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5jZXJ0aWZpY2F0ZXMge1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgfVxuXG4gIC52ZW51ZXdpZHRobnViZXIge1xuICAgIG1pbi13aWR0aDogNzAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAudmVudWV3aWR0aCB7XG4gICAgbWluLXdpZHRoOiAzMCUgIWltcG9ydGFudDtcbiAgICBkaXNwbGF5OiBmbGV4O1xuICB9XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcbiAgLmFsaWduYmxvY2sge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuY2VydGlmaWNhdGV3aWR0aCB7XG4gICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAudmVudWV3aWR0aCB7XG4gICAgbWF4LXdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAubWFyZ2luc3BhY2Uge1xuICAgIG1hcmdpbi1sZWZ0OiAxNXB4O1xuICAgIG1hcmdpbi1yaWdodDogMTVweDtcbiAgfVxuXG4gIC5wcm9maWxlYWNjb3JkaW9uIC5zdXBlcnZpc29ydGV4dGNvbG9yIHtcbiAgICB0b3A6IDRweCAhaW1wb3J0YW50O1xuICB9XG4gIC5wcm9maWxlYWNjb3JkaW9uIC5idC1kZWxldGUge1xuICAgIHRvcDogNTBweCAhaW1wb3J0YW50O1xuICB9XG4gIC5wcm9maWxlYWNjb3JkaW9uIC5pbm5lcnNpZGUge1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgLnByb2ZpbGVhY2NvcmRpb24gLmFjY2VwdGVkY29sb3Ige1xuICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xuICB9XG4gIC5wcm9maWxlYWNjb3JkaW9uIC5hbGlnbnJlbW92ZSB7XG4gICAgcGFkZGluZy10b3A6IDE1cHg7XG4gIH1cblxuICAucmVkIHtcbiAgICBjb2xvcjogcmVkO1xuICB9XG5cbiAgLmFsaWduYmxvY2s6OmFmdGVyIHtcbiAgICBjb250ZW50OiBcIigqIFJlcXVpcmVkKVwiO1xuICAgIGZvbnQtc2l6ZTogMC42ODc1cmVtO1xuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgICB0b3A6IC0ycHggIWltcG9ydGFudDtcbiAgICBsZWZ0OiAzMHB4ICFpbXBvcnRhbnQ7XG4gICAgcmlnaHQ6IDA7XG4gICAgY29sb3I6ICNmZjAwMDA7XG4gIH1cblxuICAuYmFja2dyb3VuZHVwbG9hZGJhc2ljaW5mbyB7XG4gICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICB9XG5cbiAgLm1hcHBpbmd3aWR0aCAubWFwcGluZ3NpZGVuYXZ3aWR0aCB7XG4gICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgfVxuICAubWFwcGluZ3dpZHRoIC5tYXBwaW5nc2lkZW5hdndpZHRoIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIHtcbiAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxuICAubWFwcGluZ3dpZHRoIC5tYXBwaW5nc2lkZW5hdndpZHRoIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC50aXRsZXRleHQge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbiAgLm1hcHBpbmd3aWR0aCAubWFwcGluZ3NpZGVuYXZ3aWR0aCAuc2VsZWN0cHJvZHVjdGhlYWRlcndpdGhjbG9zZSAuY2xvc2VhbmRhZGQge1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gIH1cbiAgLm1hcHBpbmd3aWR0aCAubWFwcGluZ3NpZGVuYXZ3aWR0aCAuc3BhY2luZyB7XG4gICAgcGFkZGluZy1yaWdodDogMTBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnRvcGhlYWRlcm1haW4ge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuZWFjaHNvY2lhbGxpbmsge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWxpZ25maWxlZHNjZXJ0aWZpY2F0ZSB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICB9XG5cbiAgLmVhY2hzb2NpYWxsaW5rIHAsIC5lYWNoc29jaWFsbGluayAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIHNwYW4sIC5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQgLnBhcGVybm90ZWNvbG9yIHAgLmVhY2hzb2NpYWxsaW5rIHNwYW4ge1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWxpZ25zcGFjZSB7XG4gICAgbWFyZ2luLWxlZnQ6IDEwcHg7XG4gIH1cblxuICAuYWRkYnV0dG9uIHtcbiAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLmxpc3RiYXNpY2luZm8gLmFsaWduZmlsZWRzIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICB9XG5cbiAgLnRvcGhlYWRlcm1haW4gLmltYWdld2l0aHRleHQge1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1sZWZ0OiAxMHB4O1xuICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xuICB9XG5cbiAgLmJhY2tncm91bmR1cGxvYWRiYXNpY2luZm8ge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWxpZ253aWR0aCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5pbWFnZWFsaWduc3BhY2Uge1xuICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLndpZHRoZmlsZWRzIHtcbiAgICBtYXJnaW4tbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAud2lkdGhlbXAge1xuICAgIG1hcmdpbi1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNwYWNlbWFyZ2luIHtcbiAgICBtYXJnaW4tcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnRvcGJyZWFkY3J1bWIge1xuICAgIHBhZGRpbmctbGVmdDogMTBweCAhaW1wb3J0YW50O1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gIH1cblxuICAuc3BhbmNvbG9yIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDEwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC5wYWRkaW5ncmlnaHQge1xuICAgIHBhZGRpbmctcmlnaHQ6IDEycHg7XG4gIH1cblxuICAubWFyZ2lucmlnaHQge1xuICAgIG1hcmdpbi1yaWdodDogMTJweDtcbiAgfVxuXG4gIC5jb21wYW55YW5kb2ZmaWNlaW5mbyB7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuXG4gIC50YXJnZXR3aWR0aCAuaW5ubmVycGFydG9mZHJ3ZXIge1xuICAgIHBhZGRpbmctYm90dG9tOiA3MHB4ICFpbXBvcnRhbnQ7XG4gICAgbWF4LWhlaWdodDogY2FsYygxMDB2aCAtIDE0MHB4KSAhaW1wb3J0YW50O1xuICAgIG92ZXJmbG93LXg6IGhpZGRlbjtcbiAgICBvdmVyZmxvdy15OiBhdXRvO1xuICAgIGhlaWdodDogMTAwJTtcbiAgfVxuXG4gIC50YXJnZXR3aWR0aCAuc2lkZW5hdnNhbWV3aWR0aGFsbCB7XG4gICAgcG9zaXRpb246IGZpeGVkICFpbXBvcnRhbnQ7XG4gICAgbWluLXdpZHRoOiAzMDBweCAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2Uge1xuICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xuICB9XG5cbiAgLnNlbGVjdHByb2R1Y3RoZWFkZXJ3aXRoY2xvc2UgLnRpdGxldGV4dCB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuXG4gIC5zZWxlY3Rwcm9kdWN0aGVhZGVyd2l0aGNsb3NlIC5jbG9zZWFuZGFkZCB7XG4gICAgbWFyZ2luLWJvdHRvbTogMTBweDtcbiAgfVxuXG4gIC5zcGFjaW5nIHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAxMHB4ICFpbXBvcnRhbnQ7XG4gIH1cblxuICAuYWRkZWRjZXJ0aWZpY2F0ZSB7XG4gICAgcGFkZGluZzogMjBweDtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGRkO1xuICB9XG5cbiAgLmVkaXRhbmRkZWxldGUge1xuICAgIGRpc3BsYXk6IGlubGluZS1mbGV4O1xuICAgIG1hcmdpbi1ib3R0b206IDEwcHg7XG4gICAgbWFyZ2luLXRvcDogMTBweDtcbiAgfVxufVxuLnBhZ2V0aXRsZSB7XG4gIGhlaWdodDogNTBweDtcbiAgd2lkdGg6IDEwMHB4O1xuICBiYWNrZ3JvdW5kOiAjMDAwO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGFuaW1hdGlvbi1kdXJhdGlvbjogMS43cztcbiAgYW5pbWF0aW9uLWZpbGwtbW9kZTogZm9yd2FyZHM7XG4gIGFuaW1hdGlvbi1pdGVyYXRpb24tY291bnQ6IGluZmluaXRlO1xuICBhbmltYXRpb24tdGltaW5nLWZ1bmN0aW9uOiBsaW5lYXI7XG4gIGFuaW1hdGlvbi1uYW1lOiBwYWdldGl0bGVBbmltYXRlO1xuICBiYWNrZ3JvdW5kOiAjZjZmN2Y4O1xuICBiYWNrZ3JvdW5kOiBsaW5lYXItZ3JhZGllbnQodG8gcmlnaHQsICNlZWUgMiUsICNkZGQgMTglLCAjZWVlIDMzJSk7XG4gIGJhY2tncm91bmQtc2l6ZTogMTMwMHB4O1xufVxuXG5Aa2V5ZnJhbWVzIHBhZ2V0aXRsZUFuaW1hdGUge1xuICAwJSB7XG4gICAgYmFja2dyb3VuZC1wb3NpdGlvbjogLTY1MHB4IDA7XG4gIH1cbiAgMTAwJSB7XG4gICAgYmFja2dyb3VuZC1wb3NpdGlvbjogNjUwcHggMDtcbiAgfVxufVxuLnNreWNhcmRsb2FkZXJpdGVtIHtcbiAgaGVpZ2h0OiA1MHB4O1xuICB3aWR0aDogMjEwcHg7XG4gIGJhY2tncm91bmQ6ICMwMDA7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgYW5pbWF0aW9uLWR1cmF0aW9uOiAxLjdzO1xuICBhbmltYXRpb24tZmlsbC1tb2RlOiBmb3J3YXJkcztcbiAgYW5pbWF0aW9uLWl0ZXJhdGlvbi1jb3VudDogaW5maW5pdGU7XG4gIGFuaW1hdGlvbi10aW1pbmctZnVuY3Rpb246IGxpbmVhcjtcbiAgYW5pbWF0aW9uLW5hbWU6IHBhZ2V0aXRsZUFuaW1hdGU7XG4gIGJhY2tncm91bmQ6ICNmNmY3Zjg7XG4gIGJhY2tncm91bmQ6IGxpbmVhci1ncmFkaWVudCh0byByaWdodCwgI2VlZSAyJSwgI2RkZCAxOCUsICNlZWUgMzMlKTtcbiAgYmFja2dyb3VuZC1zaXplOiAxMzAwcHg7XG59XG4uc2t5Y2FyZGxvYWRlcml0ZW0gLnNreWNhcmRsb2FkZXJpdGVtOmJlZm9yZSB7XG4gIHdpZHRoOiBpbmhlcml0O1xuICBoZWlnaHQ6IGluaGVyaXQ7XG4gIGNvbnRlbnQ6IFwiXCI7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbn1cblxuQGtleWZyYW1lcyBza3ljYXJkbG9hZGVyaXRlbUFuaW1hdGUge1xuICAwJSB7XG4gICAgYmFja2dyb3VuZC1wb3NpdGlvbjogLTY1MHB4IDA7XG4gIH1cbiAgMTAwJSB7XG4gICAgYmFja2dyb3VuZC1wb3NpdGlvbjogNjUwcHggMDtcbiAgfVxufVxuLnBsYWNlaG9sZGVyY2VudGVyIHtcbiAgaGVpZ2h0OiA1MHB4O1xuICB3aWR0aDogMTAwJTtcbiAgYmFja2dyb3VuZDogIzAwMDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBhbmltYXRpb24tZHVyYXRpb246IDEuN3M7XG4gIGFuaW1hdGlvbi1maWxsLW1vZGU6IGZvcndhcmRzO1xuICBhbmltYXRpb24taXRlcmF0aW9uLWNvdW50OiBpbmZpbml0ZTtcbiAgYW5pbWF0aW9uLXRpbWluZy1mdW5jdGlvbjogbGluZWFyO1xuICBhbmltYXRpb24tbmFtZTogcGFnZXRpdGxlQW5pbWF0ZTtcbiAgYmFja2dyb3VuZDogI2Y2ZjdmODtcbiAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KHRvIHJpZ2h0LCAjZWVlIDElLCAjZGRkIDE4JSwgI2VlZSAzMyUpO1xuICBiYWNrZ3JvdW5kLXNpemU6IDEzMDBweDtcbn1cbi5wbGFjZWhvbGRlcmNlbnRlciAucGxhY2Vob2xkZXJjZW50ZXI6YmVmb3JlIHtcbiAgd2lkdGg6IGluaGVyaXQ7XG4gIGhlaWdodDogaW5oZXJpdDtcbiAgY29udGVudDogXCJcIjtcbiAgcG9zaXRpb246IGFic29sdXRlO1xufVxuXG5Aa2V5ZnJhbWVzIHBsYWNlaG9sZGVyY2VudGVyQW5pbWF0ZSB7XG4gIDAlIHtcbiAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiAtNjUwcHggMDtcbiAgfVxuICAxMDAlIHtcbiAgICBiYWNrZ3JvdW5kLXBvc2l0aW9uOiA2NTBweCAwO1xuICB9XG59XG4uanVzdGlmeSB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cblxuLmFwcHJvdmFsYWxpZ24ge1xuICB3aWR0aDogODMuMzMlO1xuICBtYXJnaW4tbGVmdDogYXV0bztcbiAgbWFyZ2luLXJpZ2h0OiBhdXRvO1xufVxuXG4uY2FyZGxlZnR3aWR0aCB7XG4gIHdpZHRoOiAxMDAlO1xufVxuXG4uYWxpZ25jYXJkIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xufVxuXG4uYWNjb3JkaW9ud2lkdGgge1xuICB3aWR0aDogMTAwJTtcbiAgaGVpZ2h0OiA1MHB4O1xuICBiYWNrZ3JvdW5kOiAjMDAwO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGFuaW1hdGlvbi1kdXJhdGlvbjogMS43cztcbiAgYW5pbWF0aW9uLWZpbGwtbW9kZTogZm9yd2FyZHM7XG4gIGFuaW1hdGlvbi1pdGVyYXRpb24tY291bnQ6IGluZmluaXRlO1xuICBhbmltYXRpb24tdGltaW5nLWZ1bmN0aW9uOiBsaW5lYXI7XG4gIGFuaW1hdGlvbi1uYW1lOiBwYWdldGl0bGVBbmltYXRlO1xuICBiYWNrZ3JvdW5kOiAjZjZmN2Y4O1xuICBiYWNrZ3JvdW5kOiBsaW5lYXItZ3JhZGllbnQodG8gcmlnaHQsICNlZWUgMSUsICNkZGQgMTglLCAjZWVlIDMzJSk7XG4gIGJhY2tncm91bmQtc2l6ZTogMTMwMHB4O1xufVxuLmFjY29yZGlvbndpZHRoIC5hY2NvcmRpb253aWR0aDpiZWZvcmUge1xuICB3aWR0aDogaW5oZXJpdDtcbiAgaGVpZ2h0OiBpbmhlcml0O1xuICBjb250ZW50OiBcIlwiO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG59XG5cbkBrZXlmcmFtZXMgYWNjb3JkaW9ud2lkdGhBbmltYXRlIHtcbiAgMCUge1xuICAgIGJhY2tncm91bmQtcG9zaXRpb246IC02NTBweCAwO1xuICB9XG4gIDEwMCUge1xuICAgIGJhY2tncm91bmQtcG9zaXRpb246IDY1MHB4IDA7XG4gIH1cbn1cbi5hbGlnbmVuZCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luLXRvcDogMjBweDtcbn1cblxuQG1lZGlhIChtaW4td2lkdGg6IDc2OHB4KSB7XG4gIC5tYXJnaW5zcGFjZSB7XG4gICAgbWFyZ2luLWxlZnQ6IDE1cHg7XG4gICAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xuICB9XG5cbiAgLmNoZWNrZXZlbmNoaWxkIGRpdjpudGgtb2YtdHlwZShldmVuKSB7XG4gICAgcGFkZGluZy1sZWZ0OiAzMHB4O1xuICB9XG4gIC5jaGVja2V2ZW5jaGlsZCBkaXY6bnRoLW9mLXR5cGUoZXZlbikgLmFsaWducmVtb3ZlIHtcbiAgICBtYXJnaW4tYm90dG9tOiAxMHB4O1xuICB9XG4gIC5jaGVja2V2ZW5jaGlsZCBkaXY6bnRoLW9mLXR5cGUoZXZlbikgLnN1cHRleHRjb2xvciB7XG4gICAgcG9zaXRpb246IHJlbGF0aXZlO1xuICAgIGxlZnQ6IDE1cHg7XG4gICAgdG9wOiAxNXB4O1xuICAgIGRpc3BsYXk6IGZsZXg7XG4gIH1cbiAgLmNoZWNrZXZlbmNoaWxkIGRpdjpudGgtb2YtdHlwZShvZGQpIHtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG4gIC5jaGVja2V2ZW5jaGlsZCBkaXY6bnRoLW9mLXR5cGUob2RkKSAuc3VwdGV4dGNvbG9yIHtcbiAgICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gICAgbGVmdDogMDtcbiAgICB0b3A6IDA7XG4gICAgZGlzcGxheTogZmxleDtcbiAgfVxufVxuLmFsaWducmVtb3ZlIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xufVxuXG4ucmlnaHRzaWRlZGV0YWlscyBwLCAucmlnaHRzaWRlZGV0YWlscyAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIHNwYW4sIC5wcm9maWxldmlld2xpc3QgLm9mZmljZXRleHQgLnBhcGVybm90ZWNvbG9yIHAgLnJpZ2h0c2lkZWRldGFpbHMgc3BhbiB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xuICBtYXJnaW46IDA7XG4gIHBhZGRpbmctYm90dG9tOiAxMHB4O1xufVxuXG4uYWNjZXB0ZWRjb2xvciB7XG4gIHBhZGRpbmctdG9wOiA1MHB4O1xufVxuLmFjY2VwdGVkY29sb3IgcCwgLmFjY2VwdGVkY29sb3IgLnByb2ZpbGV2aWV3bGlzdCAub2ZmaWNldGV4dCAucGFwZXJub3RlY29sb3IgcCBzcGFuLCAucHJvZmlsZXZpZXdsaXN0IC5vZmZpY2V0ZXh0IC5wYXBlcm5vdGVjb2xvciBwIC5hY2NlcHRlZGNvbG9yIHNwYW4ge1xuICBjb2xvcjogIzMzMztcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgbWFyZ2luOiAwO1xufVxuLmFjY2VwdGVkY29sb3Igc3BhbiB7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXNpemU6IDAuODc1cmVtO1xufVxuXG5bZGlyPXJ0bF0gLnByb2ZpbGV2aWV3bGlzdCAuYnQtZGVsZXRlIHtcbiAgbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIHJpZ2h0OiA5MCUgIWltcG9ydGFudDtcbn1cbltkaXI9cnRsXSAucHJvZmlsZXZpZXdsaXN0ICNjcmVhdGlvbmxpc3QgLmNvdW50cnlhbmRjcmluZm8gLmVhY2hpdGVtIHtcbiAgcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XG59XG5bZGlyPXJ0bF0gLmNoZWNrZXZlbmNoaWxkIGRpdjpudGgtb2YtdHlwZShldmVuKSB7XG4gIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctcmlnaHQ6IDMwcHggIWltcG9ydGFudDtcbn1cbltkaXI9cnRsXSAuY2hlY2tldmVuY2hpbGQgZGl2Om50aC1vZi10eXBlKG9kZCkge1xuICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbn1cbltkaXI9cnRsXSAudXNlcnByb2ZpbG1haWxpZG1haWwgLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbltkaXI9cnRsXSAudXNlcnByb2ZpbG1haWxpZG1haWwgLm90cGhlYWRlcl9yZWcgI3BhcnRpdGlvbmVkdXNlcnByb2ZpbGUge1xuICBtaW4td2lkdGg6IDIzOXB4ICFpbXBvcnRhbnQ7XG59XG5cbi5yZXNlbmRvdHAgYnV0dG9uIHtcbiAgYmFja2dyb3VuZDogbm9uZTtcbiAgYm9yZGVyOiBub25lO1xuICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcbiAgY29sb3I6ICM0Y2EyYWM7XG4gIGZvbnQtc2l6ZTogMTRweDtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9yZWd1bGFyXCI7XG4gIG1hcmdpbi1ib3R0b206IDYwcHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cblxuLnVzZXJwcm9maWxtYWlsaWRtYWlsIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4udXNlcnByb2ZpbG1haWxpZG1haWwgLm90cGhlYWRlcl9yZWcge1xuICBtYXJnaW4tdG9wOiAtMjBweDtcbn1cbi51c2VycHJvZmlsbWFpbGlkbWFpbCAub3RwaGVhZGVyX3JlZyAucmVzZW5kb3RwY29sb3Ige1xuICBjb2xvcjogIzRhYTJhYyAhaW1wb3J0YW50O1xuICB0ZXh0LWRlY29yYXRpb246IHVuZGVybGluZTtcbn1cbi51c2VycHJvZmlsbWFpbGlkbWFpbCAub3RwaGVhZGVyX3JlZyAjcGFydGl0aW9uZWR1c2VycHJvZmlsZSB7XG4gIGxldHRlci1zcGFjaW5nOiAzMHB4O1xuICBwYWRkaW5nLWxlZnQ6IDE1cHg7XG4gIGJvcmRlcjogMDtcbiAgd2lkdGg6IDM1MDtcbiAgbWluLXdpZHRoOiAzNTBweDtcbiAgb3V0bGluZTogbm9uZTtcbiAgYmFja2dyb3VuZC1pbWFnZTogbGluZWFyLWdyYWRpZW50KHRvIGxlZnQsIGJsYWNrIDcwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwKSAwJSk7XG4gIGJhY2tncm91bmQtcG9zaXRpb246IGJvdHRvbTtcbiAgYmFja2dyb3VuZC1zaXplOiAzN3B4IDFweDtcbiAgYmFja2dyb3VuZC1yZXBlYXQ6IHJlcGVhdC14O1xuICBiYWNrZ3JvdW5kLXBvc2l0aW9uLXg6IDM1cHg7XG4gIG91dGxpbmU6IG5vbmU7XG4gIG1heC13aWR0aDogNDEycHg7XG59XG4udXNlcnByb2ZpbG1haWxpZG1haWwgLm90cGhlYWRlcl9yZWcgI2RpdklubmVyIHtcbiAgbGVmdDogMDtcbiAgcG9zaXRpb246IHN0aWNreTtcbn1cbi51c2VycHJvZmlsbWFpbGlkbWFpbCAub3RwaGVhZGVyX3JlZyAjZGl2T3V0ZXIge1xuICB3aWR0aDogMjIzcHg7XG4gIG92ZXJmbG93OiBoaWRkZW47XG59XG4udXNlcnByb2ZpbG1haWxpZG1haWwgLm90cGhlYWRlcl9yZWcgLmFsaWduZmxleCB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICB3aWR0aDogNDAycHg7XG59XG4udXNlcnByb2ZpbG1haWxpZG1haWwgLnZlcmlmaWVkY29udGVudGJ0biB7XG4gIGJhY2tncm91bmQ6ICM2M2ExMjY7XG4gIG1pbi13aWR0aDogODZweDtcbiAgbWF4LXdpZHRoOiA4NnB4O1xuICBoZWlnaHQ6IDI2cHg7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG4gIGZvbnQtc2l6ZTogMTRweDtcbiAgbWFyZ2luLXRvcDogOHB4O1xufVxuLnVzZXJwcm9maWxtYWlsaWRtYWlsIC52ZXJpZmllZGNvbnRlbnRidG4gaSB7XG4gIHdpZHRoOiAxOHB4O1xuICBoZWlnaHQ6IDE4cHg7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG4gIGJvcmRlci1yYWRpdXM6IDUwJTtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgY29sb3I6ICM2M2ExMjY7XG59XG4udXNlcnByb2ZpbG1haWxpZG1haWwgI21vYmlsZXZlcmlmeXNwYWNlIC52ZXJpZnl0b3Age1xuICBtYXJnaW4tdG9wOiA4cHg7XG59XG4udXNlcnByb2ZpbG1haWxpZG1haWwgLnN1Ym1pdHdyYXAgLm1hdC1idXR0b24td3JhcHBlciB7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbi51c2VycHJvZmlsbWFpbGlkbWFpbCAuc3VibWl0YnRuZWRpdCB7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzRhYTFhYztcbiAgY29sb3I6ICNmZmY7XG4gIGJvcmRlcjogbm9uZTtcbiAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xuICBtYXJnaW4tdG9wOiA4cHg7XG59XG4udXNlcnByb2ZpbG1haWxpZG1haWwgLnN1Ym1pdGJ0bmVkaXQgc3Bhbi5idXR0b24tdGV4dCB7XG4gIGZvbnQtc2l6ZTogMTVweCAhaW1wb3J0YW50O1xufVxuLnVzZXJwcm9maWxtYWlsaWRtYWlsIC5zdWJtaXRidG5lZGl0IGJ1dHRvbiB7XG4gIGxpbmUtaGVpZ2h0OiAxO1xufVxuLnVzZXJwcm9maWxtYWlsaWRtYWlsIC5zdWJtaXRidG5lZGl0OmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0UwQUQ2Nztcbn1cblxuI3NlbGVjdF92YWx1ZXRyaWdnZXIgLm1hdC1zZWxlY3QtZGlzYWJsZWQgLm1hdC1zZWxlY3QtdmFsdWUge1xuICBjdXJzb3I6IG5vLWRyb3A7XG59XG5cbiNlbWFpbG90cHNwaW5uZXIgYnV0dG9uIC5zcGlubmVyIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICB0b3A6IGF1dG8gIWltcG9ydGFudDtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.ts":
/*!**********************************************************************************************!*\
  !*** ./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.ts ***!
  \**********************************************************************************************/
/*! exports provided: MY_FORMATS, ProfilecreationlistComponent, BusinessUnitDetails */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MY_FORMATS", function() { return MY_FORMATS; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ProfilecreationlistComponent", function() { return ProfilecreationlistComponent; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "BusinessUnitDetails", function() { return BusinessUnitDetails; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_cdk_text_field__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/cdk/text-field */ "./node_modules/@angular/cdk/__ivy_ngcc__/fesm2015/text-field.js");
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/operators */ "./node_modules/rxjs/_esm2015/operators/index.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! sweetalert */ "./node_modules/sweetalert/dist/sweetalert.min.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/material-moment-adapter */ "./node_modules/@angular/material-moment-adapter/__ivy_ngcc__/esm2015/material-moment-adapter.js");
/* harmony import */ var _env_environment__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @env/environment */ "./src/environments/environment.ts");
/* harmony import */ var _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @app/@shared/filee/filee */ "./src/app/@shared/filee/filee.ts");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @app/config/BGIConfig/bgi-jsonconfig-services */ "./src/app/config/BGIConfig/bgi-jsonconfig-services.ts");
/* harmony import */ var _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! @angular/material/sidenav */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sidenav.js");
/* harmony import */ var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! @app/common/class/encrypt */ "./src/app/common/class/encrypt.ts");
/* harmony import */ var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! @app/common/localstorage/applocalstorage.services */ "./src/app/common/localstorage/applocalstorage.services.ts");
/* harmony import */ var _app_common_directives_atleastone__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! @app/common/directives/atleastone */ "./src/app/common/directives/atleastone.ts");
/* harmony import */ var _app_services_drive_service__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! @app/services/drive.service */ "./src/app/services/drive.service.ts");
/* harmony import */ var _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! @app/modules/profilemanagement/profile.service */ "./src/app/modules/profilemanagement/profile.service.ts");
/* harmony import */ var _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! @app/common/state/service/state.service */ "./src/app/common/state/service/state.service.ts");
/* harmony import */ var _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! @app/common/city/service/city.service */ "./src/app/common/city/service/city.service.ts");
/* harmony import */ var _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! @angular/material/snack-bar */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/snack-bar.js");
/* harmony import */ var ngx_toastr__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ngx-toastr */ "./node_modules/ngx-toastr/__ivy_ngcc__/fesm2015/ngx-toastr.js");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! @app/modules/registration/registration.service */ "./src/app/modules/registration/registration.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _app_modules_enterpriseadmin_enterprise_service__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(/*! @app/modules/enterpriseadmin/enterprise.service */ "./src/app/modules/enterpriseadmin/enterprise.service.ts");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
/* harmony import */ var _app_shared_adddepartment_adddepartment_component__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(/*! @app/@shared/adddepartment/adddepartment.component */ "./src/app/@shared/adddepartment/adddepartment.component.ts");
/* harmony import */ var rxjs_internal_operators_map__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(/*! rxjs/internal/operators/map */ "./node_modules/rxjs/internal/operators/map.js");
/* harmony import */ var rxjs_internal_operators_map__WEBPACK_IMPORTED_MODULE_31___default = /*#__PURE__*/__webpack_require__.n(rxjs_internal_operators_map__WEBPACK_IMPORTED_MODULE_31__);
/* harmony import */ var rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(/*! rxjs/observable/merge */ "./node_modules/rxjs-compat/_esm2015/observable/merge.js");
/* harmony import */ var rxjs_observable_of__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(/*! rxjs/observable/of */ "./node_modules/rxjs-compat/_esm2015/observable/of.js");
/* harmony import */ var rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(/*! rxjs/operators/catchError */ "./node_modules/rxjs-compat/_esm2015/operators/catchError.js");
/* harmony import */ var rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_35__ = __webpack_require__(/*! rxjs/operators/startWith */ "./node_modules/rxjs-compat/_esm2015/operators/startWith.js");
/* harmony import */ var rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_36__ = __webpack_require__(/*! rxjs/operators/switchMap */ "./node_modules/rxjs-compat/_esm2015/operators/switchMap.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_37__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");









































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
let ProfilecreationlistComponent = class ProfilecreationlistComponent {
    constructor(translate, remoteService, el, cookieService, encryptClass, localStorage, driveService, fb, _ngZone, profileservice, stateService, cityService, snackBar, toastr, regService, EnterpriseService, http, encrypt, router) {
        this.translate = translate;
        this.remoteService = remoteService;
        this.el = el;
        this.cookieService = cookieService;
        this.encryptClass = encryptClass;
        this.localStorage = localStorage;
        this.driveService = driveService;
        this.fb = fb;
        this._ngZone = _ngZone;
        this.profileservice = profileservice;
        this.stateService = stateService;
        this.cityService = cityService;
        this.snackBar = snackBar;
        this.toastr = toastr;
        this.regService = regService;
        this.EnterpriseService = EnterpriseService;
        this.http = http;
        this.encrypt = encrypt;
        this.router = router;
        this.dataSource2 = new _angular_material_table__WEBPACK_IMPORTED_MODULE_37__["MatTableDataSource"]();
        this.spinnerButtonOptions = {
            active: false,
            text: 'Verify',
            spinnerSize: 15,
            raised: false,
            stroked: false,
            buttonColor: 'primary',
            spinnerColor: 'warn',
            fullWidth: true,
            disabled: false,
            mode: 'indeterminate',
            type: 'button'
        };
        this.spinnerButtonOptionsmobile = {
            active: false,
            text: 'Verify',
            spinnerSize: 15,
            raised: false,
            stroked: false,
            buttonColor: 'primary',
            spinnerColor: 'warn',
            fullWidth: true,
            disabled: false,
            mode: 'indeterminate',
            type: 'button'
        };
        this.division = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]();
        this.department = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]();
        this.toppingList = ['Ui Developer', 'PHP Developer', 'Design Lead', 'Tester', 'Product Management', 'Associate'];
        this.supervisorList = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]();
        this.landline_country_code_flag = 31;
        this.mobile_country_code_flag = 31;
        this.maxDate = new Date();
        this.landlinecode = '+968';
        this.mobilecode = '+968';
        this.Contentplaceloader = true;
        this.reportedto = [];
        this.addsupervise = [];
        this.Deptartment = [];
        this.countrylist = [];
        this.statelist = [];
        this.citylist = [];
        this.designlevel = [];
        this.businesssource = [];
        this.totalCount = 5;
        this.codeselect = true;
        this.certificatelists = [];
        this.addressists = [];
        this.optionvalue = true;
        this.initSpinner = false;
        this.countDown = '00:00';
        this.countDownMob = '00:00';
        this.disableResendemail = false;
        this.showeditbtn = true;
        this.disableupdatebutton = false;
        this.verfiy = false;
        this.disableupdatebutton1 = false;
        this.showeditbtnmobile = true;
        this.verfiymobile = false;
        this.iseditdisable1 = false;
        this.otpshowmobile = false;
        this.iferrorotp = false;
        this.iferrorotpmail = false;
        this.disableResendmob = false;
        this.divshow = true;
        this.divshowemail = false;
        this.verifyshowfield = false;
        this.emailview = false;
        this.otpviewfield = false;
        this.formSubmitted = false;
        this.socialmedia = [
            { listtitle: "Skype", image: "skypeimage.png", },
            { listtitle: "Facebook", image: "Facebookweb.svg", },
            { listtitle: "Twitter", image: "Twitterweb.svg", },
            { listtitle: "Instagram", image: "Instagramweb.svg", },
        ];
        this.customCollapsedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_9__["environment"].customCollapsedHeight;
        this.customExpandedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_9__["environment"].customExpandedHeight;
        this.panelOpenState = false;
        this.disableloader = true;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_6__["ErrorStateMatcher"]();
        this.panel = 1;
        this.animationState6 = 'out';
        this.samemobno = false;
        this.animationState = 'out';
        this.buttonname = this.i18n('profilecreationlist.add');
        this.managementperpage = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__["BgiJsonconfigServices"].bgiConfigData.configuration.accordionPerpage;
        this.minimumPaginationValue = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__["BgiJsonconfigServices"].bgiConfigData.configuration.accordionPerpage;
        this.paginationSet = _app_config_BGIConfig_bgi_jsonconfig_services__WEBPACK_IMPORTED_MODULE_12__["BgiJsonconfigServices"].bgiConfigData.configuration.accordionPaginationSet;
        this.warnUserBeforeLeavingPage = true;
        this.perpage = 3;
        this.email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        this.page = 0;
        this.searchcertificatetitle = "";
        this.search = "";
        this.mobsubmitbtn = true;
        this.verfiedtagshow = false;
        this.verfiedtagshowmobile = false;
        this.openDeptSideNav = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = "ltr";
        this.upadtebtnn = false;
    }
    i18n(key) {
        this.translate.get(key).subscribe({
            next: (text) => ('Text translated: ' + text)
        });
        return this.translate.instant(key);
    }
    unloadHandler(event) {
        if (this.warnUserBeforeLeavingPage) {
            event.returnValue = false;
        }
    }
    ngOnInit() {
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
        this.getCountryList();
        this.certid = '';
        this.mobile_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
        this.landline_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
        this.user_pk = this.localStorage.getInLocal('userPk');
        this.usertype = this.localStorage.getInLocal('usertype');
        // setTimeout(() => { this.Contentplaceloader = false }, 800);
        this.drv_companylogo = {
            fileMstPk: 95,
            selectedFilesPk: []
        };
        this.basicinfoForm = this.fb.group({
            middlename: ['', ''],
            firstname: ['', ''],
            lastname: ['', ''],
            employeeid: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            dateofjoining: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            division: ['', ''],
            department: ['', ''],
            designation: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            reportingto: [''],
            supervisor: ['', ''],
            briefprofile: ['', ''],
            Roles: ['', ''],
            upload: ['', ''],
            gdp: this.fb.array([this.createGDP()])
        });
        this.certificatelistForm = this.fb.group({
            certificatetitle: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            dateofissue: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            relateddocument: [null, ''],
            certificateFileUpload: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
        });
        this.socialmediaForm = this.fb.group({
            facebook: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/(?:www\.)?facebook\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
            instagram: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/(?:www\.)?instagram\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
            twitter: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/(?:www\.)?twitter\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
            linkedin: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/(?:www\.)?linkedin\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
            Skype: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)],
            Zoom: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)],
            GoogleMeet: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)],
        }, { validators: Object(_app_common_directives_atleastone__WEBPACK_IMPORTED_MODULE_16__["atLeastOne"])(_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required) });
        this.communicationinfoForm = this.fb.group({
            code: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            mobileno: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            landlinecc: ['', ''],
            mobilecc: ['', ''],
            coumtrycode: ['', ''],
            landlineno: [''],
            extn: ['', _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(5)],
            mobileotp: ['', ''],
            emailotp: ['', ''],
            workemialid: ['', [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].pattern(this.email)]],
        });
        this.getCountryList();
        this.getReportedtoData();
        this.drvInput = {
            fileMstPk: 98,
            selectedFilesPk: [] //Already inserted pk
        };
        this.relateddoc = {
            fileMstPk: 99,
            selectedFilesPk: [] //Already inserted pk
        };
        this.getbusinessInput();
        this.getDivisionData();
        this.communicationinfoForm.controls['workemialid'].valueChanges.debounceTime(400).subscribe(data => {
            if (data && data != null && data.length != 0) {
                this.chkValidemailId(data);
            }
        });
    }
    divisionChange(value) {
        if (value) {
            let index = this.businesssource.findIndex(x => x.bunitPk == value[0]);
            if (index !== -1) {
                this.businessUnitDataTemp = this.businesssource[index].bunitName;
            }
            this.postParams = {
                'bUnitPk': value
            };
            this.postUrl = 'ea/department/fetch-department-by-bunit';
            this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(function (data) {
                if (data['data'].status == 100) {
                    this.division = (value['data'] && value['data'].data && value['data'].data.businessUnit !== null) ? value['data'].data.businessUnit.split(",") : [];
                    this.Deptartment = data['data'].data.bunitDeptData;
                    this.valueChanged(null);
                    this.contentinputloader = false;
                }
                else {
                    this.contentinputloader = false;
                }
            }.bind(this));
        }
        else {
            this.businessUnitDataTemp = '';
        }
    }
    chkValidemailId(dataValue) {
        let postData = {
            'email': dataValue,
            'usrid': this.user_pk,
            'stktype': this.stkholdertype
        };
    }
    checksamemailid() {
        let postData = {
            'email': this.communicationinfoForm.controls.workemialid.value,
            'usrid': this.user_pk,
            'stktype': this.stkholdertype
        };
        this.EnterpriseService.checksamemailid('ea/user/checksamemaild', postData).subscribe(response => {
            var _a;
            if (response === null || response === void 0 ? void 0 : response.success) {
                if ((_a = response === null || response === void 0 ? void 0 : response.data) === null || _a === void 0 ? void 0 : _a.data) {
                    this.communicationinfoForm.controls.workemialid.setErrors({ samemailid: true });
                }
            }
        });
    }
    emailcheck() {
        if (this.f1.workemialid.valid) {
            this.verfiy = true;
        }
        else {
            this.verfiy = false;
        }
    }
    getbusinessInput() {
        this.getSectorDtls(this.encrypt.encrypt(this.companypk));
    }
    openDeptSide() {
        this.refBunitDept.triggerdivisionlisit();
        this.openDeptSideNav.emit(true);
    }
    changesuppervisor(chkevent, index) {
        if (this.superarr.includes(chkevent.value)) {
            this.gdpControl[index].get('supervisor').reset();
            sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
                title: this.i18n('profilecreationlist.thismembisalre'),
                icon: 'warning'
            });
        }
        else {
            this.superarr.push(chkevent.value);
        }
    }
    createGDP() {
        return this.fb.group({
            supervisor: [],
        });
    }
    get f1() { return this.communicationinfoForm.controls; }
    syncPrimaryPaginator(event) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.paginator.page.emit(event);
    }
    valueChanged(value) {
        if (this.basicinfoForm.controls['department'].value) {
            let index = this.Deptartment.findIndex(x => x.deptPk == this.basicinfoForm.controls['department'].value[0]);
            if (index !== -1) {
                this.deptDataTemp = this.Deptartment[index].deptName;
            }
        }
    }
    onPaginateChange(event) {
        this.perpage = event.pageSize;
        this.page = parseInt(event.pageIndex) + 1;
        this.search = this.searchcertificatetitle;
        this.getcertification(this.page, this.perpage, this.search);
    }
    oncertififiltersubmit() {
        this.search = this.searchcertificatetitle;
        this.getcertification(this.page, this.perpage, this.search);
    }
    getcertification(page, perpage, search) {
        this.profileservice.getcertifcapagindata(page, perpage, search).subscribe((returndata) => {
            this.certificatelists = returndata.data['certificatedata'];
            this.certificatecnt = returndata.data['certificatecnt'];
            this.overallcertificatecnt = returndata.data['overallcertificatecnt'];
        });
    }
    addGDP() {
        this.gdp = this.basicinfoForm.get('gdp');
        this.gdp.push(this.createGDP());
    }
    removeGDP(index) {
        this.gdp = this.basicinfoForm.get('gdp');
        const indes = this.superarr.indexOf(this.gdp.value[index].supervisor);
        this.superarr.splice(indes, 1);
        setTimeout(() => {
            this.gdp.removeAt(index);
        }, 1000);
    }
    get gdpControl() {
        return this.basicinfoForm.get('gdp').controls;
    }
    getCountryList() {
        this.profileservice.getcountrylist().subscribe(data => this.countrylist = data['data']);
    }
    getStateList(countrypk) {
        this.stateService.getstatebyid(countrypk).subscribe(data => {
            this.statelist = data['data'];
        });
    }
    getCityList(statepk) {
        this.cityService.getcitybystateid(statepk).subscribe(data => {
            this.citylist = data['data'];
        });
    }
    getReportedtoData() {
        this.profileservice.getReportedMaster().subscribe(returndata => {
            this.reportedto = returndata.data['data'];
            this.addsupervise = returndata.data['data'];
            this.deptlist = returndata.data['deptlist'];
            this.designlevel = returndata.data['degnlevel'];
            this.masterdata = returndata.data['mstdata'];
            this.certificatelists = returndata.data['certificatedata'];
            this.certificatecnt = returndata.data['certificatecnt'];
            this.overallcertificatecnt = returndata.data['overallcertificatecnt'];
            this.addressists = returndata.data['addressists'];
            if (this.masterdata.userdp.length > 0) {
                this.drv_companylogo.selectedFilesPk = this.masterdata.userdp;
                setTimeout(() => {
                    this.logo.triggerChange();
                    this.disableloader = false;
                }, 1000);
            }
            else {
                this.disableloader = false;
            }
            this.basicinfoForm.patchValue({
                'firstname': this.masterdata.name,
                'middlename': this.masterdata.midlename,
                'lastname': this.masterdata.lastname,
                'employeeid': this.masterdata.employeid,
                'dateofjoining': this.masterdata.doj,
                'designation': this.masterdata.designat,
                'designationlevel': this.masterdata.designatlevl,
                'reportingto': this.masterdata.reportto,
                'briefprofile': this.masterdata.breifprof,
                'Roles': this.masterdata.rolesresp,
                'division': (this.masterdata.division !== null) ? this.masterdata.division.split(",") : [],
                'department': (this.deptlist !== null) ? this.deptlist.split(",") : [],
            });
            this.divisionChange((this.masterdata.division !== null) ? this.masterdata.division.split(",") : []);
            this.superarr = this.masterdata.superv;
            let rows = this.basicinfoForm.get('gdp');
            while (rows.length !== 0) {
                rows.removeAt(0);
            }
            this.masterdata.superv.forEach(data => {
                rows.push(this.fb.group({
                    supervisor: data,
                }));
            });
            this.socialmediaForm.patchValue({
                'facebook': this.masterdata.facebook,
                'instagram': this.masterdata.instragram,
                'twitter': this.masterdata.twitter,
                'linkedin': this.masterdata.linkedin,
                'Skype': this.masterdata.Skype,
                'Zoom': this.masterdata.Zoom,
                'GoogleMeet': this.masterdata.GoogleMeet,
            });
            this.mobilecode = this.masterdata.mobilecode;
            this.landlinecode = this.masterdata.landlinecode;
            if (this.masterdata.mobilecntypcode != '') {
                this.mobile_country_code_flag = Number(this.masterdata.mobilecntypcode);
            }
            else {
                this.mobile_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
            }
            if (this.masterdata.landlinecntypcode != '') {
                this.landline_country_code_flag = Number(this.masterdata.landlinecntypcode);
            }
            else {
                this.landline_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
            }
            if (this.masterdata.primarynocc != 31) {
                this.verfiedtagshowmobile = false;
            }
            else {
                if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
                    this.verfiedtagshowmobile = true;
                }
            }
            this.communicationinfoForm.patchValue({
                'code': this.masterdata.primarynocc,
                'mobileno': this.masterdata.primaryno,
                'coumtrycode': this.masterdata.landlinenocc,
                'landlineno': this.masterdata.landlineno,
                'extn': this.masterdata.landlinenoext,
                'workemialid': this.masterdata.priemailid,
            });
            if (this.masterdata.verifiedemail == 1) {
                this.verfiedtagshow = true;
                this.emailview = true;
            }
            if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
                this.verifyshowfield = true;
                this.verfiedtagshowmobile = true;
            }
            else {
                this.verfiedtagshowmobile = false;
                this.mobnumverifybtn = true;
                this.verfiymobile = true;
                this.verifyshowfield = true;
                this.showeditbtnmobile = true;
                if (this.focusmobile) {
                    this.editdatamobileotp();
                    this.mobnumverifybtn = true;
                }
            }
            setTimeout(() => {
                this.Contentplaceloader = false;
            }, 800);
        });
        this.basicinfoForm.controls['middlename'].disable();
        this.basicinfoForm.controls['firstname'].disable();
        this.basicinfoForm.controls['lastname'].disable();
        this.basicinfoForm.controls['department'].enable();
        this.basicinfoForm.controls['division'].enable();
        this.communicationinfoForm.controls['workemialid'].disable();
        this.communicationinfoForm.controls['mobileno'].disable();
        if (this.usertype == 'A') {
            this.optionvalue = false;
            this.basicinfoForm.controls['middlename'].enable();
            this.basicinfoForm.controls['firstname'].enable();
            this.basicinfoForm.controls['lastname'].enable();
        }
        this.focusmobile = window.history.state.focus;
        if (this.focusmobile) {
            this.editdatamobileotp();
            this.mobnumverifybtn = true;
        }
    }
    addcertificatedraw() {
        this.buttonname = this.i18n('profilecreationlist.add');
        this.certificatesdrawer.toggle();
    }
    updatecommunadd(value) {
        this.addressists = value;
    }
    changecomadd(addid) {
        this.addressid = addid;
        this.mappingdrawer.toggle();
    }
    clearformcert() {
        this.certificatelistForm.controls['certificatetitle'].reset();
        this.certificatelistForm.controls['dateofissue'].reset();
        this.certificatelistForm.controls['relateddocument'].reset();
        this.certificatelistForm.controls['certificateFileUpload'].reset();
        this.drvInput.selectedFilesPk = [];
        setTimeout(() => {
            this.certificateFile.triggerChange();
            this.disableloader = false;
        }, 1000);
        this.relateddoc.selectedFilesPk = [];
        setTimeout(() => {
            this.relateddocument.triggerChange();
            this.disableloader = false;
        }, 1000);
    }
    deletewebprese(type, formfieldname) {
        sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
            title: this.i18n('profilecreationlist.doyouantwebpres'),
            icon: 'warning',
            closeOnClickOutside: false,
            closeOnEsc: false,
            buttons: [this.i18n('profilecreationlist.nobutton'), this.i18n('profilecreationlist.yesbutton')],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                this.profileservice.deletewebpresence(type).subscribe(returndata => {
                    this.resultmsg = returndata.data['statusmsg'];
                    if (this.resultmsg == "success") {
                        if (returndata.data['retdata'] == 1) {
                            this.socialmediaForm.controls['Skype'].reset();
                        }
                        else if (returndata.data['retdata'] == 2) {
                            this.socialmediaForm.controls['Zoom'].reset();
                        }
                        else {
                            this.socialmediaForm.controls['GoogleMeet'].reset();
                        }
                        this.showWSuccess();
                    }
                });
            }
        });
    }
    showWSuccess() {
        this.toastr.success(this.i18n('profilecreationlist.delesucc'), this.i18n('profilecreationlist.succ'), {
            timeOut: 3000,
            closeButton: true,
        });
    }
    deletesocialmed(type, formfieldname) {
        sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
            title: this.i18n('profilecreationlist.doyouantsocimedi'),
            icon: 'warning',
            closeOnClickOutside: false,
            closeOnEsc: false,
            buttons: [this.i18n('profilecreationlist.nobutton'), this.i18n('profilecreationlist.yesbutton')],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                this.profileservice.deletesocialmedia(type).subscribe(returndata => {
                    this.resultmsg = returndata.data['statusmsg'];
                    if (this.resultmsg == "success") {
                        if (returndata.data['retdata'] == 1) {
                            this.socialmediaForm.controls['facebook'].reset();
                        }
                        else if (returndata.data['retdata'] == 2) {
                            this.socialmediaForm.controls['twitter'].reset();
                        }
                        else if (returndata.data['retdata'] == 3) {
                            this.socialmediaForm.controls['instagram'].reset();
                        }
                        else {
                            this.socialmediaForm.controls['linkedin'].reset();
                        }
                        this.showWSuccess();
                    }
                });
            }
        });
    }
    deletecert(certid) {
        sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
            title: this.i18n('profilecreationlist.doyouantcert'),
            icon: 'warning',
            closeOnClickOutside: false,
            closeOnEsc: false,
            buttons: [this.i18n('profilecreationlist.nobutton'), this.i18n('profilecreationlist.yesbutton')],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                let ids = this.encryptClass.encrypt(certid);
                this.profileservice.deletecertif(ids).subscribe(returndata => {
                    this.resultmsg = returndata.data['statusmsg'];
                    if (this.resultmsg == "success") {
                        this.search = this.searchcertificatetitle;
                        this.getcertification(this.page, this.perpage, this.search);
                        this.showWSuccess();
                    }
                });
            }
        });
    }
    deleteLogo(event) {
        if (event) {
            sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
                title: this.i18n('profilecreationlist.doyouwantimage'),
                text: this.i18n('profilecreationlist.youcanstilreco'),
                icon: "warning",
                buttons: [this.i18n('profilecreationlist.canc'), this.i18n('profilecreationlist.okbutton')],
                dangerMode: true,
                className: "swal-delete",
                closeOnClickOutside: false,
                closeOnEsc: false
            }).then((willDelete) => {
                if (willDelete) {
                    this.profileservice.saveLogo([]).subscribe(data => {
                        if (data['data'].status == 1) {
                            this.drv_companylogo.selectedFilesPk = [];
                            setTimeout(() => {
                                this.logo.triggerChange();
                                this.showWSuccess();
                                this.upadtebtn();
                            }, 1000);
                        }
                    });
                }
            });
        }
    }
    editcert(cerdata) {
        if (cerdata.certupload.length > 0) {
            this.drvInput.selectedFilesPk = cerdata.certupload;
            setTimeout(() => {
                this.certificateFile.triggerChange();
                this.disableloader = false;
            }, 1000);
        }
        else {
            this.disableloader = false;
        }
        if (cerdata.relateddoc.length > 0) {
            this.relateddoc.selectedFilesPk = cerdata.relateddoc;
            setTimeout(() => {
                this.relateddocument.triggerChange();
                this.disableloader = false;
            }, 1000);
        }
        else {
            this.disableloader = false;
        }
        this.certificatelistForm.patchValue({
            certificatetitle: cerdata.title,
            dateofissue: cerdata.dateofissuedit,
        });
        this.buttonname = this.i18n('profilecreationlist.upda');
        this.certid = cerdata.id;
        this.certificatesdrawer.toggle();
    }
    panelUpdate(panelNo) {
        this.panel = panelNo;
    }
    setOpen(i) {
        this.panel = i;
    }
    fileeSelected(file, fileId) {
        fileId.selectedFilesPk = file;
        this.upadtebtn();
    }
    onSubmitbasic() {
        if (this.basicinfoForm.valid) {
            this.profileservice.saveBasicuserinfo(this.basicinfoForm.value).subscribe(resdata => {
                this.resultmsg = resdata.data['statusmsg'];
            });
        }
    }
    upadtebtn() {
        if (this.basicinfoForm.controls.lastname.value != '' && this.basicinfoForm.controls.firstname.value != '' && this.basicinfoForm.controls.division.value.length != 0 && this.basicinfoForm.controls.department.value.length != 0) {
            this.upadtebtnn = true;
        }
        else {
            this.upadtebtnn = false;
        }
    }
    mobilenumchange() {
        if (this.communicationinfoForm.controls.code.value == 31 && this.communicationinfoForm.controls.mobileno.value.length == 8) {
            let postData = {
                'mobilenum': this.communicationinfoForm.controls.mobileno.value,
                'usrid': this.user_pk,
                'stktype': this.stkholdertype
            };
            /*   this.EnterpriseService.aleadyverifiedmob('ea/user/aleadyverifiedmob', postData).subscribe(response => {
                if (response?.success) {
                  if (response?.data?.data) {
                   
                    this.communicationinfoForm.controls.mobileno.setErrors({ samemobno: true });
                   
                  }
             
                }
              })
       */
            this.upadtebtnn = false;
            this.mobnumverifybtn = true;
        }
        else {
            this.upadtebtnn = true;
        }
    }
    otplengthcheck() {
        if (this.communicationinfoForm.controls.mobileotp.value.length == 6) {
            this.mobsubmitbtn = false;
        }
        // else{
        //   this.mobsubmitbtn = true;
        // }
    }
    onSubmitcommunic() {
        this.communicationinfoForm.controls.code.enable();
        this.communicationinfoForm.controls.mobileno.enable();
        this.communicationinfoForm.controls.workemialid.enable();
        this.basicinfoForm.controls.middlename.enable();
        this.basicinfoForm.controls.firstname.enable();
        this.basicinfoForm.controls.lastname.enable();
        this.onSubmitbasic();
        if (this.communicationinfoForm.valid) {
            this.profileservice.savecommunuserinfo(this.communicationinfoForm.value).subscribe(resdata => {
                if (resdata.data['twofwarning']) {
                    sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
                        title: 'Update Configuration for Two Factor Authentication',
                        text: 'Please note that since you have changed the Country Code for your Mobile Number from National (Omani) to International, the Two Factor Authentication has been disabled. You can configure Two Factor Authentication preference as email via ‘Account Settings’.',
                        icon: 'warning',
                        buttons: [false, 'Ok']
                    });
                }
                this.resultmsg = resdata.data['statusmsg'];
            });
        }
        this.router.navigate(['/profilecreation/profilelistview']);
    }
    onSubmitcertifi() {
        if (this.certificatelistForm.valid) {
            this.initSpinner = true;
            if (this.certid != '') {
                this.textmsg = this.i18n('profilecreationlist.certupdat');
            }
            else {
                this.textmsg = this.i18n('profilecreationlist.certadded');
            }
            this.profileservice.savecertifinfo(this.certificatelistForm.value, this.certid).subscribe(resdata => {
                this.resultmsg = resdata.data['statusmsg'];
                this.certid = '';
                this.buttonname = this.i18n('profilecreationlist.add');
                if (this.resultmsg == "success") {
                    localStorage.setItem('mobileverified', '1');
                    this.initSpinner = false;
                    this.search = this.searchcertificatetitle;
                    this.getcertification(this.page, this.perpage, this.search);
                    this.clearformcert();
                    this.certificatesdrawer.toggle();
                    this.showTSuccess(this.textmsg);
                }
            });
        }
        else {
            this.initSpinner = false;
        }
    }
    onSubmitsocialmed() {
        if (this.socialmediaForm.valid) {
            this.profileservice.savesocialmednfo(this.socialmediaForm.value).subscribe(resdata => {
                this.resultmsg = resdata.data['statusmsg'];
                if (this.resultmsg == "success") {
                    this.snackBar.open(this.i18n('profilecreationlist.certadded'), '', {
                        duration: 10000,
                        panelClass: ['success'],
                        verticalPosition: 'top'
                    });
                }
            });
        }
    }
    showTSuccess(data) {
        this.toastr.success(data, this.i18n('profilecreationlist.succ'), {
            timeOut: 3000,
            closeButton: true,
        });
    }
    triggerResize() {
        this._ngZone.onStable.pipe(Object(rxjs_operators__WEBPACK_IMPORTED_MODULE_4__["take"])(1))
            .subscribe(() => this.autosize.resizeToFitContent(true));
    }
    infolisting(divName) {
        if (divName === 'infoview') {
            this.animationState6 = this.animationState6 === 'out' ? 'in' : 'out';
        }
    }
    showSweetAlert() {
        if (((this.certificatelistForm.controls.dateofissue.touched && this.certificatelistForm.controls.dateofissue.value != null) ||
            (this.certificatelistForm.controls.relateddocument.touched && this.certificatelistForm.controls.relateddocument.value.length != 0 || (this.certificatelistForm.controls.certificatetitle.touched && this.certificatelistForm.controls.certificatetitle.value != null) ||
                (this.certificatelistForm.controls.certificateFileUpload.touched && this.certificatelistForm.controls.certificateFileUpload.value != null && this.certificatelistForm.controls.certificateFileUpload.value.length != 0)))) {
            sweetalert__WEBPACK_IMPORTED_MODULE_5___default()({
                title: this.i18n('profilecreationlist.doyouwantaddicert'),
                text: this.i18n('profilecreationlist.allthedatthat'),
                icon: 'warning',
                closeOnClickOutside: false,
                closeOnEsc: false,
                buttons: [this.i18n('profilecreationlist.canc'), this.i18n('profilecreationlist.okbutton')],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    this.clearformcert();
                    this.certificatesdrawer.toggle();
                }
            });
        }
        else {
            this.clearformcert();
            this.certificatesdrawer.toggle();
        }
        this.animationState = 'out';
    }
    toggleShowDiv(divName) {
        if (divName === 'descriptionnonjsrs') {
            this.animationState = this.animationState === 'out' ? 'in' : 'out';
        }
    }
    scrollTo(className) {
        try {
            const elementList = document.querySelectorAll('.' + className);
            const element = elementList[0];
            element.scrollIntoView({ behavior: 'smooth' });
        }
        catch (error) {
            console.log('page-content');
        }
    }
    editdataotp() {
        this.showeditbtn = false;
        this.verfiy = false;
        this.emailview = true;
        this.communicationinfoForm.controls.workemialid.enable();
        this.otpviewfield = false;
        this.verfiedtagshow = false;
    }
    editdatamobileotp() {
        this.verfiedtagshowmobile = false;
        this.verifyshowfield = true;
        this.communicationinfoForm.controls.mobileno.enable();
        this.disableupdatebutton1 = true;
        this.verfiymobile = true;
        this.iseditdisable1 = false;
        this.codeselect = false;
        this.showeditbtnmobile = false;
        this.mobnumverifybtn = false;
        // if(this.communicationinfoForm.controls.code.value == 31 || this.focusmobile){
        //   this.mobnumverifybtn = true; 
        // }else{
        //   this.mobnumverifybtn = false;
        // }
        return true;
    }
    otpshowdatamobiledata() {
        this.divshow = true;
        this.communicationinfoForm.controls.mobileno.disable();
        this.communicationinfoForm.controls.code.disable();
        this.spinnerButtonOptionsmobile.active = true;
        this.sendverifyotp(this.communicationinfoForm.controls.mobileno.value, 'mobile', this.encrypt.encrypt(this.user_pk));
    }
    timer(minute, type) {
        let seconds = minute * 60;
        let textSec = "0";
        let statSec = 60;
        const prefix = minute < 10 ? "0" : "";
        this.timeremail = setInterval(() => {
            seconds--;
            if (statSec != 0)
                statSec--;
            else
                statSec = 59;
            if (statSec < 10) {
                textSec = "0" + statSec;
            }
            else
                textSec = statSec;
            if (type == 'mobile') {
                this.countDownMob = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
            }
            else {
                this.countDown = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
            }
            if (seconds == 0) {
                if (type == 'mobile') {
                    this.disableResendmob = false;
                }
                else {
                    this.disableResendemail = false;
                }
                clearInterval(this.timeremail);
            }
        }, 1000);
    }
    timermob(minute, type) {
        // let minute = 1;
        let seconds = minute * 60;
        let textSec = "0";
        let statSec = 60;
        const prefix = minute < 10 ? "0" : "";
        this.timermobile = setInterval(() => {
            seconds--;
            if (statSec != 0)
                statSec--;
            else
                statSec = 59;
            if (statSec < 10) {
                textSec = "0" + statSec;
            }
            else
                textSec = statSec;
            if (type == 'mobile') {
                this.countDownMob = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
            }
            else {
                this.countDown = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
            }
            if (seconds == 0) {
                if (type == 'mobile') {
                    this.disableResendmob = false;
                }
                else {
                    this.disableResendemail = false;
                }
                clearInterval(this.timermobile);
            }
        }, 1000);
    }
    submitdtataotp() {
        this.verifyotpdata(this.communicationinfoForm.controls.workemialid.value, this.communicationinfoForm.controls.emailotp.value, 'email', this.encrypt.encrypt(this.user_pk));
    }
    verifyotpdata(value, otp, type, usrPk) {
        this.regService.verifyotpdatadb(value, otp, type, usrPk).subscribe(data => {
            if (data.data.flag == 1) {
                if (type == 'email') {
                    this.verfiedtagshow = true;
                    this.disableupdatebutton = true;
                    this.otpviewfield = false;
                    this.countDown = '00:00';
                    this.disableResendemail = false;
                    this.communicationinfoForm.controls.workemialid.disable();
                    this.upadtebtn();
                    // if(this.verfiymobile != true && this.otpshowmobile != true){
                    //   this.addUserData.emit(1);
                    // }
                }
                if (type == 'mobile') {
                    this.otpshowmobile = false;
                    this.verfiedtagshowmobile = true;
                    this.disableupdatebutton1 = false;
                    // this.addreadonly = true;
                    this.disableResendmob = false;
                    this.countDown = '00:00';
                    this.communicationinfoForm.controls.mobileno.disable();
                    this.upadtebtn();
                    if (this.verfiy != true && this.otpviewfield != true) {
                        // this.addUserData.emit(1);
                    }
                }
            }
            else {
                if (type == 'email') {
                    this.iferrorotpmail = true;
                    this.communicationinfoForm.controls.emailotp.setErrors({ invalidOTP: true });
                }
                if (type == 'mobile') {
                    this.iferrorotp = true;
                    this.communicationinfoForm.controls.mobileotp.setErrors({ invalidOTP: true });
                }
            }
        });
    }
    otpshowdata() {
        // this.otpviewfield = true;
        // this.verfiy = false;
        // return false
        // this.timer(15,'mobile');
        this.divshowemail = true;
        this.spinnerButtonOptions.active = true;
        this.communicationinfoForm.controls.workemialid.disable();
        this.sendverifyotp(this.communicationinfoForm.controls.workemialid.value, 'email', this.encrypt.encrypt(this.user_pk));
        // this.formSubmitted = false;
    }
    sendverifyotp(value, type, pk) {
        this.regService.sendverifyotpdb(value, type, pk).subscribe(data => {
            // this.adduserForm.controls.email.disable();
            // this.duration = data.data.duration;
            this.timer(15, type);
            if (type == 'email') {
                this.verfiy = false;
                this.disableResendemail = true;
                this.otpviewfield = true;
                this.spinnerButtonOptions.active = false;
                this.disableupdatebutton = true;
            }
            if (type == 'mobile') {
                this.verfiymobile = false;
                this.disableResendmob = true;
                this.otpshowmobile = true;
                this.spinnerButtonOptionsmobile.active = false;
                this.iseditdisable1 = true;
            }
        });
    }
    submitdatamobile() {
        this.verifyotpdata(this.communicationinfoForm.controls.mobileno.value, this.communicationinfoForm.controls.mobileotp.value, 'mobile', this.encrypt.encrypt(this.user_pk));
    }
    bunitReload(event) {
        this.getDivisionData();
        this.getSectorDtls(this.encrypt.encrypt(this.companypk));
        this.refBunitDept.initiateBusinessUnit();
    }
    getDivisionData() {
        if (this.stkholdertype == 1) {
            this.postParams = {
                "compPk": this.encrypt.encrypt(this.compid)
            };
        }
        else {
            this.postParams = {};
        }
        this.postUrl = 'ea/businessunit/fetch-bunit-data';
        this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(function (data) {
            if (data['data'].status == 100) {
                this.businesssource = data['data'].data.bunitData;
            }
        }.bind(this));
    }
    getSectorDtls(companypk) {
        this.businessUnitDetails = new BusinessUnitDetails(this.http, companypk);
        Object(rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_32__["merge"])()
            .pipe(Object(rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_35__["startWith"])({}), Object(rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_36__["switchMap"])(() => {
            return this.businessUnitDetails.businessUnitData();
        }), Object(rxjs_internal_operators_map__WEBPACK_IMPORTED_MODULE_31__["map"])(data => {
            this.resultsLength = data['data'].items.totalcount;
            return data['data'].items.data;
        }), Object(rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_34__["catchError"])(() => {
            return Object(rxjs_observable_of__WEBPACK_IMPORTED_MODULE_33__["of"])([]);
        })).subscribe(data => {
            this.dataSource2.data = data;
        });
    }
    deptReload(event) {
        this.postParams = {
            "bUnitPk": this.basicinfoForm.controls['division'].value,
        };
        this.postUrl = 'ea/department/fetch-department-by-bunit';
        this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(function (data) {
            if (data['data'].status == 100) {
                this.Deptartment = data['data'].data.bunitDeptData;
            }
        }.bind(this));
    }
    cancelmailver() {
        this.divshowemail = false;
        this.disableupdatebutton = true;
        this.otpviewfield = false;
        this.countDown = '00:00';
        this.countDownMob = '00:00';
        this.disableResendemail = false;
        this.disableResendmob = false;
        this.disableupdatebutton1 = false;
        this.showeditbtn = true;
        this.showeditbtnmobile = true;
        this.iferrorotpmail = false;
        this.communicationinfoForm.controls.emailotp.reset();
        this.communicationinfoForm.controls.workemialid.setValue(this.masterdata.priemailid);
        clearInterval(this.timermobile);
        clearInterval(this.timeremail);
        if (this.masterdata.verifiedemail == 1) {
            this.verfiedtagshow = true;
            this.emailview = true;
        }
    }
    cancelmobilever() {
        this.divshow = false;
        // this.disableupdatebutton = true;
        // this.otpviewfield = false;
        this.countDown = '00:00';
        this.communicationinfoForm.controls.mobileotp.reset();
        clearInterval(this.timermobile);
        clearInterval(this.timeremail);
        // this.disableResendemail = false;
        // this.disableResendmob = false;
        this.iferrorotp = false;
        this.disableupdatebutton1 = false;
        this.showeditbtn = true;
        this.showeditbtnmobile = true;
        this.communicationinfoForm.controls.mobileno.setValue(this.masterdata.primaryno);
        if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
            this.verifyshowfield = true;
            this.verfiedtagshowmobile = true;
        }
    }
    cancelprocess() {
        this.ngOnInit();
        this.divshow = false;
        this.disableupdatebutton = true;
        this.otpviewfield = false;
        this.countDown = '00:00';
        this.disableResendemail = false;
        this.disableResendmob = false;
        this.disableupdatebutton1 = false;
        this.showeditbtn = true;
        this.showeditbtnmobile = true;
    }
    setcountryFlag(value, type) {
        if (type == 'mobile') {
            this.communicationinfoForm.controls.mobileno.reset();
            this.verfiedtagshowmobile = false;
            this.mobile_country_code_flag = value;
            if (this.mobile_country_code_flag != 31) {
                this.communicationinfoForm.controls['mobileno'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(5), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(20)]);
            }
            else {
                this.communicationinfoForm.controls['mobileno'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(8), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(8)]);
            }
            this.communicationinfoForm.controls['mobileno'].updateValueAndValidity();
            this.countrylist.forEach(x => {
                if (x.CountryMst_Pk == value) {
                    this.mobilecode = x.dialcode;
                }
            });
        }
        else {
            this.landline_country_code_flag = value;
            if (this.landline_country_code_flag != 31) {
                this.communicationinfoForm.controls['landlineno'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(5), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(20)]);
            }
            else {
                this.communicationinfoForm.controls['landlineno'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].minLength(8), _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].maxLength(8)]);
            }
            this.communicationinfoForm.controls['landlineno'].updateValueAndValidity();
            this.countrylist.forEach(x => {
                if (x.CountryMst_Pk == value) {
                    this.landlinecode = x.dialcode;
                }
            });
        }
        if (value != 31) {
            this.mobnumverifybtn = false;
            this.verfiedtagshowmobile = false;
            this.upadtebtnn = true;
        }
        else {
            if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
                this.upadtebtnn = false;
                // this.verfiedtagshowmobile = true;
                // this.showeditbtnmobile =true;
                // this.communicationinfoForm.controls.mobileno.disable();
            }
        }
    }
};
ProfilecreationlistComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_23__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_24__["RemoteService"] },
    { type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_25__["CookieService"] },
    { type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__["Encrypt"] },
    { type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_15__["AppLocalStorageServices"] },
    { type: _app_services_drive_service__WEBPACK_IMPORTED_MODULE_17__["DriveService"] },
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] },
    { type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["NgZone"] },
    { type: _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_18__["ProfileService"] },
    { type: _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_19__["StateService"] },
    { type: _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_20__["CityService"] },
    { type: _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_21__["MatSnackBar"] },
    { type: ngx_toastr__WEBPACK_IMPORTED_MODULE_22__["ToastrService"] },
    { type: _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_26__["RegistrationService"] },
    { type: _app_modules_enterpriseadmin_enterprise_service__WEBPACK_IMPORTED_MODULE_28__["EnterpriseService"] },
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_27__["HttpClient"] },
    { type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__["Encrypt"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_7__["Router"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], ProfilecreationlistComponent.prototype, "stkholdertype", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_29__["MatSort"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_29__["MatSort"])
], ProfilecreationlistComponent.prototype, "sort", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('refBunitDept'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_adddepartment_adddepartment_component__WEBPACK_IMPORTED_MODULE_30__["AdddepartmentComponent"])
], ProfilecreationlistComponent.prototype, "refBunitDept", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], ProfilecreationlistComponent.prototype, "compid", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('autosize'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_cdk_text_field__WEBPACK_IMPORTED_MODULE_3__["CdkTextareaAutosize"])
], ProfilecreationlistComponent.prototype, "autosize", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Number)
], ProfilecreationlistComponent.prototype, "panelNo", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], ProfilecreationlistComponent.prototype, "masterdata", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], ProfilecreationlistComponent.prototype, "result", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], ProfilecreationlistComponent.prototype, "resultmsg", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('certificateFile'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_10__["Filee"])
], ProfilecreationlistComponent.prototype, "certificateFile", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('relateddocument'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_10__["Filee"])
], ProfilecreationlistComponent.prototype, "relateddocument", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('logo'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_filee_filee__WEBPACK_IMPORTED_MODULE_10__["Filee"])
], ProfilecreationlistComponent.prototype, "logo", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('paginator'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_11__["MatPaginator"])
], ProfilecreationlistComponent.prototype, "paginator", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('certificatesdrawer'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_13__["MatDrawer"])
], ProfilecreationlistComponent.prototype, "certificatesdrawer", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('mappingdrawer'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_13__["MatDrawer"])
], ProfilecreationlistComponent.prototype, "mappingdrawer", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('mobilefocus'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])
], ProfilecreationlistComponent.prototype, "mobilefocus", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("addbusinessunitmcp"),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_13__["MatDrawer"])
], ProfilecreationlistComponent.prototype, "addbusinessunitmcp", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("drawerdepartment"),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sidenav__WEBPACK_IMPORTED_MODULE_13__["MatDrawer"])
], ProfilecreationlistComponent.prototype, "drawerdepartment", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], ProfilecreationlistComponent.prototype, "openDeptSideNav", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["HostListener"])("window:beforeunload", ["$event"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Function),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [Event]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:returntype", void 0)
], ProfilecreationlistComponent.prototype, "unloadHandler", null);
ProfilecreationlistComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-profilecreationlist',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./profilecreationlist.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        providers: [
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_6__["DateAdapter"], useClass: _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_8__["MomentDateAdapter"], deps: [_angular_material_core__WEBPACK_IMPORTED_MODULE_6__["MAT_DATE_LOCALE"]] },
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_6__["MAT_DATE_FORMATS"], useValue: MY_FORMATS },
        ],
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./profilecreationlist.component.scss */ "./src/app/modules/profilecreation/profilecreationlist/profilecreationlist.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_23__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_24__["RemoteService"],
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_25__["CookieService"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__["Encrypt"], _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_15__["AppLocalStorageServices"], _app_services_drive_service__WEBPACK_IMPORTED_MODULE_17__["DriveService"], _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"], _angular_core__WEBPACK_IMPORTED_MODULE_1__["NgZone"], _app_modules_profilemanagement_profile_service__WEBPACK_IMPORTED_MODULE_18__["ProfileService"], _app_common_state_service_state_service__WEBPACK_IMPORTED_MODULE_19__["StateService"], _app_common_city_service_city_service__WEBPACK_IMPORTED_MODULE_20__["CityService"], _angular_material_snack_bar__WEBPACK_IMPORTED_MODULE_21__["MatSnackBar"], ngx_toastr__WEBPACK_IMPORTED_MODULE_22__["ToastrService"],
        _app_modules_registration_registration_service__WEBPACK_IMPORTED_MODULE_26__["RegistrationService"],
        _app_modules_enterpriseadmin_enterprise_service__WEBPACK_IMPORTED_MODULE_28__["EnterpriseService"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_27__["HttpClient"],
        _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__["Encrypt"], _angular_router__WEBPACK_IMPORTED_MODULE_7__["Router"]])
], ProfilecreationlistComponent);

class BusinessUnitDetails {
    constructor(http, companypk) {
        this.http = http;
        this.companypk = companypk;
    }
    businessUnitData() {
        const href = _env_environment__WEBPACK_IMPORTED_MODULE_9__["environment"].baseUrl + "mcp/mastercompanyprofile/businessunit?companypk=" + this.companypk;
        const sign = 'desc';
        const requestUrl = `${href}&sort=${sign}-MemCompSecDtls_Pk&order=${sign}`;
        return this.http.get(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}


/***/ })

}]);
//# sourceMappingURL=modules-profilecreation-profilecreation-module-es2015.js.map