(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-newenterpriseadmin-newenterpriseadmin-module"],{

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/addroles/addroles.component.html":
/*!*******************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/addroles/addroles.component.html ***!
  \*******************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayout=\"row wrap\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"addroles\">\r\n        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"addrolesnew\">\r\n            <div *ngIf=\"refname == 1\" class=\"example-form\" id=\"manageroles\">\r\n                <div *ngIf=\"hidegrid\" class=\"paginationwithfilter masterPageTop \">\r\n                    <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                        [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-start center\">\r\n                            <button mat-raised-button type=\"button\" color=\"secondary\" (click)=\"evenadddata();\"\r\n                                [queryParams]=\"{type: 1}\" class=\"addbtn m-r-10 height-45\">{{'manageroles.add' |\r\n                                translate}}</button>\r\n                            <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                                class=\"filter height-45\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                    aria-hidden=\"true\"></i></button>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div *ngIf=\"hidegrid\" fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                        <div class=\"awaredtable\">\r\n                            <mat-table #table class=\"scrolldata\" [dataSource]=\"Usersrecord\" matSortActive=\"rolemst_pk\"\r\n                                matSortDirection=\"desc\" multiTemplateDataRows matSort matSortDisableClear>\r\n\r\n                                <ng-container matColumnDef=\"stakeholdertype\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.stactyp' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.stakeholdertype}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"projectname_en\">\r\n                                    <mat-header-cell fxFlex=\"330px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.proj' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"330px\" *matCellDef=\"let coursedata\">\r\n                                        {{((coursedata.projectname_en)?(coursedata.projectname_en):'-')}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"rolename_en\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.role' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.rolename_en}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"higherRole\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.highrol' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        {{(coursedata.higherRole?coursedata.higherRole:'-')}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"status\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.stat' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.branchname' |\r\n                                    translate}}\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        <p *ngIf=\"coursedata.status == 1\" class=\"print flexaligntag\">\r\n                                            {{'manageroles.activ' | translate}}</p>\r\n                                        <p *ngIf=\"coursedata.status == 2\" class=\"declined flexaligntag\">\r\n                                            {{'manageroles.inact' | translate}}</p>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"addedOn\">\r\n                                    <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.addon' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.addedOn}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"updatedOn\">\r\n                                    <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.lastadon' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.updatedOn}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"action\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageroles.actio' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        <button mat-button\r\n                                            [matMenuTriggerFor]=\"menu\"><mat-icon>more_horiz</mat-icon></button>\r\n                                        <mat-menu #menu=\"matMenu\" class=\"actionmatmenu\">\r\n                                            <button mat-menu-item (click)=\"viewRoleuser(coursedata,coursedata.rolemst_pk)\">{{'manageroles.view' |\r\n                                                translate}}</button>\r\n                                            <button mat-menu-item (click)=\"editData(coursedata,coursedata.rolemst_pk)\">Edit</button>\r\n                                            <button mat-menu-item\r\n                                                (click)=\"update(coursedata.rolemst_pk, coursedata.status)\"\r\n                                                *ngIf=\"coursedata.status == 2\">{{'manageroles.acti' |\r\n                                                translate}}</button>\r\n                                            <button mat-menu-item\r\n                                                (click)=\"update(coursedata.rolemst_pk, coursedata.status)\"\r\n                                                *ngIf=\"coursedata.status == 1\">{{'manageroles.deact' |\r\n                                                translate}}</button>\r\n                                        </mat-menu>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-first\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>Search</mat-label>\r\n                                            <mat-select [formControl]=\"stktypesearch\">\r\n                                                <mat-option value=\"Potal Admin (Super Admin)\">Potal Admin (Super\r\n                                                    Admin)</mat-option>\r\n                                                <mat-option value=\"Centre\">Centre</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-second\">\r\n                                    <mat-header-cell fxFlex=\"330px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"projectsearch\">\r\n                                                <mat-option\r\n                                                    value=\"Roadworthiness Assurance Standards (RAS)\">{{'manageroles.roadworthassu'\r\n                                                    | translate}}</mat-option>\r\n                                                <mat-option\r\n                                                    value=\"In-Vehicle Monitoring System (IVMS)\">{{'manageroles.invehmon'\r\n                                                    | translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-three\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"rolesearch\">\r\n                                                <mat-option value=\"Auditor\">{{'manageroles.audit' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Assessor\">{{'manageroles.asses' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Finance\">{{'manageroles.fina' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Authority\">{{'manageroles.authar' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Quality Manager\">{{'manageroles.qualmanag' |\r\n                                                    translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-four\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"highrolesearch\">\r\n                                                <mat-option value=\"Authority\">{{'manageroles.authar' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"CEO\">{{'manageroles.ceo' | translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-five\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"statussearch\">\r\n                                                <mat-option value=\"1\">{{'manageroles.activ' | translate}}</mat-option>\r\n                                                <mat-option value=\"2\">{{'manageroles.inact' | translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-six\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"addedonsearch\" (click)=\"addedon.open()\"\r\n                                                [matDatepicker]=\"addedon\">\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #addedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-seven\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"updatedonsearch\" (click)=\"updatedon.open()\"\r\n                                                [matDatepicker]=\"updatedon\">\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"updatedon\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #updatedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <tr mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"userrecordcolumn\"></tr>\r\n                                <mat-header-row id=\"searchrow\"\r\n                                    *matHeaderRowDef=\"['row-first','row-second','row-three' ,'row-four','row-five','row-six','row-seven']\">\r\n                                </mat-header-row>\r\n                                <tr mat-row *matRowDef=\"let element; columns: userrecordcolumn;\"\r\n                                    class=\"example-element-row\">\r\n                                </tr>\r\n                            </mat-table>\r\n                        </div>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                    class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                    [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                    [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                    [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                </mat-paginator>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <form *ngIf=\"showrolegrid\" [formGroup]=\"addroleform\">\r\n                    <div>\r\n                        <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addroles.stactyp' | translate}}</mat-label>\r\n                                    <mat-select [errorStateMatcher]=\"matcher\" required formControlName=\"stkholdertype\" [disabled]=\"viewRoleUserdis\"\r\n                                        (selectionChange)=\"selectedStktype(addrolform.stkholdertype.value)\">\r\n                                        <mat-option *ngFor=\"let roles of role_stktype\"\r\n                                            [value]=\"roles.opalstkholdertypmst_pk\">{{roles.oshm_stakeholdertype}}\r\n                                        </mat-option>\r\n                                    </mat-select>\r\n                                    <mat-error *ngIf=\"addrolform.stkholdertype.errors?.required\">{{'addroles.selstatyp'\r\n                                        |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <input type=\"hidden\" value=\"\" formControlName=\"rolerelpk\">\r\n                            <div *ngIf=\"showevaltech\" fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\"\r\n                                ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\"\r\n                                ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addroles.technicalevcen' | translate}}</mat-label>\r\n                                    <mat-select [errorStateMatcher]=\"matcher\" required formControlName=\"techeval\" [disabled]=\"viewRoleUserdis\">\r\n                                        <mat-option *ngFor=\"let rol of role_project\" [value]=\"rol.projectmst_pk\">\r\n                                            {{ifarabic == true ? rol.pm_projectname_ar : rol.pm_projectname_en}}\r\n                                        </mat-option>\r\n                                    </mat-select>\r\n                                    <mat-error *ngIf=\"addrolform.techeval.errors?.required\">{{'addroles.seltechevalcen'\r\n                                        |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                        <div *ngIf=\"showrole\" fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addroles.role' | translate}}</mat-label>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\" [disabled]=\"viewRoleUserdis\"\r\n                                        matInput app-restrict-input=\"english\" required formControlName=\"arrole\">\r\n                                    <mat-error *ngIf=\"addrolform.arrole.errors?.required\">Enter role in \r\n                                        english</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                                ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field appearance=\"outline\" class=\" arabiclanguage\">\r\n                                    <mat-label>{{'addroles.rolearbic' | translate}}</mat-label>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" app-restrict-input=\"arabic\" [disabled]=\"viewRoleUserdis\"\r\n                                        [errorStateMatcher]=\"matcher\" matInput required formControlName=\"rolearbic\">\r\n                                    <mat-error *ngIf=\"addrolform.rolearbic.errors?.required\">Enter role in\r\n                                        arabic</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                        <!-- <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                            <div *ngIf=\"!add_btn\" fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addroles.highrols' | translate}}</mat-label>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\"\r\n                                        matInput required formControlName=\"arrolehighupdate\">\r\n                                    <mat-icon matSuffix matTooltip=\"Lorem Ipsum is dummy text\">info_outline</mat-icon>\r\n                                    <mat-error *ngIf=\"addrolform.arrolehigh.errors?.required\">{{'addroles.selhighrol' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div> -->\r\n                        <div *ngIf=\"showhighrole\" fxLayout=\"row wrap\" class=\"p-t-15\"\r\n                            fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addroles.highrols' | translate}}</mat-label>\r\n                                    <mat-select   panelClass=\"select_with_search\" *ngIf=\"(highrolelist | filter : searchhighrole)\" [disabled]=\"viewRoleUserdis\"\r\n                                        [errorStateMatcher]=\"matcher\" [disableOptionCentering]=\"true\" required formControlName=\"arrolehigh\">\r\n                                        <div class=\"searchinmultiselect\">\r\n                                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                                class=\"searchselect\" type=\"Search\"\r\n                                                placeholder=\"{{'supplierreg.sear' | translate}} \"\r\n                                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchhighrole\"\r\n                                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"searchhighrole = ''\" class=\"reseticon\" matSuffix\r\n                                                *ngIf=\"searchhighrole !='' && searchhighrole !=null\">clear</mat-icon>\r\n                                        </div>\r\n                                        <div class=\"option-listing countryselectwithimage\">\r\n                                            <mat-option *ngFor=\"let highrole of highrolelist | filter: searchhighrole\"\r\n                                                [value]=\"highrole.rolemst_pk\">\r\n                                                {{highrole.rm_rolename_en}}\r\n                                            </mat-option>\r\n                                        </div>\r\n                                    </mat-select>\r\n                                    <mat-icon matSuffix matTooltip=\"Lorem Ipsum is dummy text\">info_outline</mat-icon>\r\n                                    <mat-error *ngIf=\"addrolform.arrolehigh.errors?.required\">{{'addroles.selhighrol' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n\r\n\r\n                        <div *ngIf=\"userroleallocation\">\r\n                            <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"aligncenter\">\r\n                                    {{'addroles.assignmod' | translate}} <span class=\"m-l-5 infoicon\"\r\n                                        matTooltip=\"Lorem Ipsum is the dummy text\"><mat-icon>info_outline</mat-icon></span>\r\n                                </div>\r\n                            </div>\r\n                            <app-userallocation [onlyview]=\"2\" #addUpdateAccess (userPermData)=\"userPermData($event)\"\r\n                                [currentUserPk]=\"currentUserPk\" *ngIf=\"!viewRoleUserdis\" [stkpk]=\"stkpk\"></app-userallocation>\r\n\r\n                            <app-userallocation [onlyview]=\"1\" #addUpdateAccess (userPermData)=\"userPermData($event)\"\r\n                                [currentUserPk]=\"currentUserPk\" *ngIf=\"viewRoleUserdis\"></app-userallocation>\r\n                            <div fxLayout=\"row wrap\" class=\"m-t-30\" fxLayoutAlign=\"end\">\r\n                                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-end center\">\r\n                                    <button mat-raised-button *ngIf=\"!viewBackBackbutton\" type=\"button\" color=\"secondary\"\r\n                                        class=\"filterbtn m-r-10 height-45\"\r\n                                        (click)=\"gotobackgrid();scrollTo('pagescroll')\">{{'addroles.canc' |\r\n                                        translate}}</button>\r\n                                        <button *ngIf=\"viewBackBackbutton\" mat-raised-button type=\"button\" color=\"secondary\"\r\n                                    class=\"filterbtn m-r-10 height-45\" (click)=\"gotobackgrid();\">Close</button>\r\n                                    <button mat-raised-button *ngIf=\"add_btn && !viewBackBackbutton\" [disabled]=\"isFormroleValid\"\r\n                                        [class.disabledsubmit]=\"isFormroleValid\" type=\"button\"\r\n                                        (click)=\"addrolesave()\" color=\"primary\"\r\n                                        class=\"addbtn height-45\">{{'addroles.subm' | translate}}</button>\r\n                                    <button mat-raised-button [class.disabledsubmit]=\"isFormroleValid\"\r\n                                        *ngIf=\"!add_btn &&!viewBackBackbutton\" [disabled]=\"isFormroleValid\" type=\"button\"\r\n                                        (click)=\"addrolesave()\" color=\"primary\" class=\"addbtn height-45\">Update</button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n\r\n\r\n\r\n                    </div>\r\n                </form>\r\n\r\n            </div>\r\n            <!-- users -->\r\n            <div id=\"manageusers\" *ngIf=\"refname == 2\" class=\"example-form\">\r\n                <div *ngIf=\"hideusergrid\" class=\"paginationwithfilter masterPageTop \">\r\n                    <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                        [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-start center\">\r\n                            <button mat-raised-button type=\"button\" color=\"secondary\" (click)=\"evenuseradddata();\"\r\n                                class=\"addbtn m-r-10 height-45\">{{'manageusers.add' | translate}}</button>\r\n                            <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                                class=\"filter height-45\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                    aria-hidden=\"true\"></i></button>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div *ngIf=\"hideusergrid\" fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                        <div class=\"awaredtable\">\r\n                            <mat-table #table class=\"scrolldata\" [dataSource]=\"Usersrecord\"\r\n                                matSortActive=\"opalusermst_pk\" matSortDirection=\"desc\" multiTemplateDataRows matSort\r\n                                matSortDisableClear>\r\n                                <ng-container matColumnDef=\"stk_type\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.staholtyp' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.stakeholdertype}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"civilnumber\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.civino' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.civilNo}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"stafName\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.stafnam' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.stafName}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"emailid\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.emaiid' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.emailid}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"mobilenumber\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.mobnum' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.mobilno}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"role\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.role' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.roleName_en}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"thirdpartyagent\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.thirdparagen' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.isthirdPartyAgent}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"status\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.stat' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.branchname' |translate}}\" fxFlex=\"160px\"\r\n                                        *matCellDef=\"let coursedata\">\r\n\r\n                                        <p *ngIf=\"coursedata.status == 'A'\" class=\"print flexaligntag\">\r\n                                            {{'manageusers.activ' | translate}}</p>\r\n                                        <p *ngIf=\"coursedata.status == 'I'\" class=\"declined flexaligntag\">\r\n                                            {{'manageusers.inactiv' | translate}}</p>\r\n                                        <p *ngIf=\"coursedata.status == 'E'\" class=\"pending flexaligntag\">\r\n                                            {{'manageusers.emaiconfpen' | translate}}</p>\r\n                                        <p *ngIf=\"coursedata.status == 'D'\" class=\"pending flexaligntag\">\r\n                                            {{'manageusers.deact' | translate}}</p>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"added_on\">\r\n                                    <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.addon' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.addedOn}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"lastupdated\">\r\n                                    <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.lasupdaon' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.lastUpdateOn}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"action\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.actio' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        <button mat-button\r\n                                            [matMenuTriggerFor]=\"menu\"><mat-icon>more_horiz</mat-icon></button>\r\n                                        <mat-menu #menu=\"matMenu\" class=\"actionmatmenu\">\r\n                                            <button mat-menu-item (click)=\"viewRoleuser(coursedata,coursedata.opalusermst_pk)\">{{'manageusers.view' |\r\n                                                translate}}</button>\r\n                                            <button mat-menu-item\r\n                                                (click)=\"edituserData(coursedata)\">{{'manageusers.edit' |\r\n                                                translate}}</button>\r\n                                            <button *ngIf=\"coursedata.status == 'I'\"\r\n                                                (click)=\"update(coursedata.opalusermst_pk,coursedata.status)\"\r\n                                                mat-menu-item>{{'manageusers.activ' | translate}}</button>\r\n                                            <button *ngIf=\"coursedata.status == 'A'\"\r\n                                                (click)=\"update(coursedata.opalusermst_pk,coursedata.status)\"\r\n                                                mat-menu-item>{{'manageusers.deact' | translate}} </button>\r\n                                        </mat-menu>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-first\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <!-- <mat-select [formControl]=\"stakeholdertype\">\r\n                                                <mat-option value=\"OPAL Admin\">{{'manageusers.opaladmin' | translate}}</mat-option>\r\n                                                <mat-option value=\"Training Evaluation Centre\">{{'manageusers.traievacen' | translate}}</mat-option>\r\n                                            </mat-select> -->\r\n                                            <mat-select [formControl]=\"stakeholdertype\">\r\n                                                <mat-option value=\"Potal Admin (Super Admin)\">Potal Admin (Super\r\n                                                    Admin)</mat-option>\r\n                                                <mat-option value=\"Centre\">Centre</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-second\">\r\n                                    <mat-header-cell fxFlex=\"220px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"civilNo\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-three\">\r\n                                    <mat-header-cell fxFlex=\"235px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"stafName\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-four\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"emailid\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-five\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"mobilno\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-six\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"roleName_en\">\r\n                                                <mat-option value=\"Auditor\">{{'manageusers.audi' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Assessor\">{{'manageusers.assrs' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Finance\">{{'manageusers.tuttrai' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Authority\">{{'manageusers.authar' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Quality Manager\">{{'manageusers.qualman' |\r\n                                                    translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell> </ng-container>\r\n                                <ng-container matColumnDef=\"row-seven\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"isthirdPartyAgent\">\r\n                                                <mat-option value=\"1\">Yes</mat-option>\r\n                                                <mat-option value=\"2\">No</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-eight\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"status\">\r\n                                                <mat-option value=\"A\">{{'manageusers.activ' | translate}}</mat-option>\r\n                                                <mat-option value=\"I\">{{'manageusers.inactiv' | translate}}</mat-option>\r\n                                                <mat-option value=\"E\">{{'manageusers.emaiconfpen' |\r\n                                                    translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <!-- <ng-container matColumnDef=\"row-nine\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"addedOn\" (click)=\"addedon.open()\"\r\n                                            [matDatepicker]=\"addedon\">\r\n                                        <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                        <mat-datepicker #addedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-ten\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                        <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                        <input matInput [formControl]=\"lastUpdateOn\" (click)=\"addedon.open()\"\r\n                                            [matDatepicker]=\"addedon\">\r\n                                        <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                        <mat-datepicker #addedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container> -->\r\n                                <ng-container matColumnDef=\"row-nine\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"addedOn\" (click)=\"addedon.open()\"\r\n                                                [matDatepicker]=\"addedon\">\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #addedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-ten\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"lastUpdateOn\" (click)=\"updatedon.open()\"\r\n                                                [matDatepicker]=\"updatedon\">\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"updatedon\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #updatedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n\r\n                                <tr mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"rolesrecordcolumn\"></tr>\r\n                                <mat-header-row id=\"searchrow\"\r\n                                    *matHeaderRowDef=\"['row-first','row-second','row-three','row-four','row-five','row-six','row-seven','row-eight','row-nine','row-ten']\">\r\n                                </mat-header-row>\r\n                                <tr mat-row *matRowDef=\"let element; columns: rolesrecordcolumn;\"\r\n                                    class=\"example-element-row\">\r\n                                </tr>\r\n                            </mat-table>\r\n                        </div>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                    class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                    [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                    [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                    [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                </mat-paginator>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <form *ngIf=\"usergrid\" class=\"example-form\" [formGroup]=\"adduserroleform\">\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <input type=\"hidden\"  value=\"\"  formControlName=\"opalusermstpk\">\r\n                            <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                <mat-label>{{'addroles.stactyp' | translate}}</mat-label>\r\n                                <mat-select (selectionChange)=\"selectedStktypeuser(adduserform.stkholdertypeuser.value)\"  [disabled]=\"viewUserdis\"\r\n                                    [errorStateMatcher]=\"matcher\" required formControlName=\"stkholdertypeuser\">\r\n                                    <mat-option *ngFor=\"let stk of user_stktype\" [value]=\"stk.opalstkholdertypmst_pk\">\r\n                                        {{stk.oshm_stakeholdertype}}\r\n                                    </mat-option>\r\n                                </mat-select>\r\n                                <mat-error *ngIf=\"adduserform.stkholdertypeuser.errors?.required\">{{'addroles.selstatyp'\r\n                                    |\r\n                                    translate}}</mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div *ngIf=\"centredatashow\" fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                <mat-label>Centre Name</mat-label>\r\n                                <mat-select (selectionChange)=\"selectciviliddata(adduserform.centrename.value)\" [disabled]=\"viewUserdis\"\r\n                                    *ngIf=\"(centre_array | filter : searchcentrename) as goverresult\"\r\n                                    panelClass=\"select_with_search\" [disableOptionCentering]=\"true\"\r\n                                    [errorStateMatcher]=\"matcher\" required formControlName=\"centrename\">\r\n                                    <div class=\"searchinmultiselect\">\r\n                                        <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                            class=\"searchselect\" type=\"Search\" placeholder=\"{{'supplierreg.sear' | translate}}\"\r\n                                            (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcentrename\"\r\n                                            [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                        <mat-icon (click)=\"searchcentrename = ''\" class=\"reseticon\" matSuffix\r\n                                            *ngIf=\"searchcentrename !='' && searchcentrename !=null\">clear</mat-icon>\r\n                                    </div>\r\n                                    <div class=\"option-listing countryselectwithimage\">\r\n                                        <mat-option *ngFor=\"let centre of centre_array | filter : searchcentrename\"\r\n                                            [value]=\"centre.opalmemberregmst_pk\">\r\n                                            {{centre.omrm_branch_en}}\r\n                                        </mat-option>\r\n                                    </div>\r\n                                </mat-select>\r\n                                <mat-error *ngIf=\"adduserform.centrename.errors?.required\">Select centre\r\n                                    name</mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <!-- <div *ngIf=\"centredatashow && !add_btn\" fxLayout=\"row wrap\" class=\"p-t-15\"\r\n                        fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                <mat-label>Centre Name</mat-label> -->\r\n                    <!-- <mat-select    (selectionChange)=\"selectciviliddata(adduserform.centrename.value)\"  *ngIf=\"(centre_array | filter : searchcentrename) as goverresult\" panelClass=\"select_with_search\" [disableOptionCentering]=\"true\"\r\n                            [errorStateMatcher]=\"matcher\" required formControlName=\"centrename\">\r\n                            <div class=\"searchinmultiselect\">\r\n                                <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                    class=\"searchselect\" type=\"Search\" placeholder=\"Search\"\r\n                                    (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchcentrename\"\r\n                                    [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                <mat-icon (click)=\"searchcentrename = ''\" class=\"reseticon\" matSuffix\r\n                                    *ngIf=\"searchcentrename !='' && searchcentrename !=null\">clear</mat-icon>\r\n                            </div>\r\n                             <div class=\"option-listing countryselectwithimage\">\r\n                                <mat-option *ngFor=\"let centre of centre_array | filter : searchcentrename\"\r\n                                [value]=\"centre.opalmemberregmst_pk\">{{centre.omrm_branch_en}}</mat-option>\r\n                            </div>\r\n                            </mat-select> -->\r\n                    <!-- <input matInput required formControlName=\"centreupdate\"> -->\r\n                    <!-- <mat-error *ngIf=\"adduserform.centrename.errors?.required\">Select centre name</mat-error> -->\r\n                    <!-- </mat-form-field>\r\n                        </div>\r\n                    </div> -->\r\n                    <div *ngIf=\"opaladmindatashow\">\r\n                        <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field [ngClass]=\"updated == true ? 'autofectlist' : ' '\"\r\n                                    class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addusers.civino' | translate}}</mat-label>\r\n                                    <input matInput [required]=\"requiredtag\" [readonly]=\"updated\" [disabled]=\"viewUserdis\"\r\n                                        formControlName=\"civilno\">\r\n                                    <mat-error *ngIf=\"adduserform.civilno.errors?.required\">{{'addusers.entcivino' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"50\" *ngIf=\"opaladmincentreshow\" fxFlex=\"100\" ngClass.xs=\"p-l-0\"\r\n                                ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\"\r\n                                ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addusers.stafnam' | translate}} </mat-label>\r\n                                    <input matInput [required]=\"requiredtag\" formControlName=\"stafName\" [disabled]=\"viewUserdis\">\r\n                                    <mat-error *ngIf=\"adduserform.stafName.errors?.required\">{{'addusers.entsatsnam' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <!-- <div fxFlex.gt-sm=\"50\" *ngIf=\"centredatashow && !add_btn\" fxFlex=\"100\" ngClass.xs=\"p-l-0\"\r\n                                ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\"\r\n                                ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addusers.stafnam' | translate}} </mat-label>\r\n                                    <input matInput required formControlName=\"stafnameupdate\">\r\n\r\n                                </mat-form-field>\r\n                            </div> -->\r\n                            <div fxFlex.gt-sm=\"50\" *ngIf=\"centredatashow\" fxFlex=\"100\" ngClass.xs=\"p-l-0\"\r\n                                ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\"\r\n                                ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addusers.stafnam' | translate}} </mat-label>\r\n                                    <mat-select panelClass=\"select_with_search\" [errorStateMatcher]=\"matcher\" [disabled]=\"viewUserdis\"\r\n                                        [disableOptionCentering]=\"true\"\r\n                                        *ngIf=\"(staffslist | filter : searchsfaffname) as goverresult\"\r\n                                        (selectionChange)=\"selectcivilid(adduserform.stafnamecentre.value)\" required\r\n                                        formControlName=\"stafnamecentre\">\r\n                                        <div class=\"searchinmultiselect\">\r\n                                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'supplierreg.sear' | translate}}\"\r\n                                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchsfaffname\"\r\n                                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"searchsfaffname = ''\" class=\"reseticon\" matSuffix\r\n                                                *ngIf=\"searchsfaffname !='' && searchsfaffname !=null\">clear</mat-icon>\r\n                                        </div>\r\n                                        <div class=\"option-listing countryselectwithimage\">\r\n                                            <mat-option *ngFor=\"let staff of staffslist | filter : searchsfaffname\"\r\n                                                value={{staff.staffinforepo_pk}}>{{staff.sir_name_en}}\r\n                                            </mat-option>\r\n                                            <div *ngIf=\"goverresult.length == 0\">No result found</div>\r\n                                        </div>\r\n\r\n                                    </mat-select>\r\n                                    <mat-error\r\n                                        *ngIf=\"adduserform.stafnamecentre.errors?.required\">{{'addusers.entsatsnam' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field [ngClass]=\"updated == true ? 'autofectlist' : ' '\" appearance=\"outline\">\r\n                                    <mat-label>{{'addusers.emaiid' | translate}}</mat-label>\r\n                                    <input  matInput [required]=\"requiredtag\" [disabled]=\"viewUserdis\"\r\n                                        pattern=\"[a-zA-Z0-9]{1,}@[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,}\"\r\n                                        formControlName=\"emailid\">\r\n                                    <mat-error *ngIf=\"adduserform.emailid.errors?.required\">{{'addusers.entemaiid' |\r\n                                        translate}}</mat-error>\r\n                                    <mat-error\r\n                                        *ngIf=\"adduserroleform.get('emailid').hasError('pattern')\">{{'addusers.entevaliemai'\r\n                                        | translate}}</mat-error>\r\n                                        <mat-error\r\n                                        *ngIf=\"adduserroleform.get('emailid').hasError('alreadyExist')\">Email id already exist</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                                ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"numberandcode\" [ngClass]=\"updated == true ? 'autofectlist' : ' '\"\r\n                                    floatLabel=\"always\" appearance=\"outline\">\r\n                                    <mat-label>{{'addusers.mobnum' | translate}}</mat-label>\r\n                                    <span ngClass.xs=\"p-r-0\" ngClass.sm=\"p-r-0\" class=\"p-r-5\">{{countrycode}}</span>\r\n                                    <input [readonly]=\"updated\" matInput [required]=\"requiredtag\"  [disabled]=\"viewUserdis\"\r\n                                        formControlName=\"mobilenumber\" [maxLength]=\"12\" numbersOnly>\r\n                                    <mat-error *ngIf=\"adduserform.mobilenumber.errors?.required\">Enter mobile\r\n                                        number</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                        <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" *ngIf=\"opaladmincentreshow\" fxFlex=\"100\"\r\n                                class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addroles.role' | translate}}</mat-label>\r\n                                    <mat-select panelClass=\"select_with_search\" [errorStateMatcher]=\"matcher\" [disabled]=\"viewUserdis\"\r\n                                        [disableOptionCentering]=\"true\" formControlName=\"arroles\"\r\n                                        *ngIf=\"(role_mstlist | filter : searchrole) as goverresult\" required>\r\n                                        <div class=\"searchinmultiselect\">\r\n                                            <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                            <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                                class=\"searchselect\" type=\"Search\" placeholder=\"{{'supplierreg.sear' | translate}}\"\r\n                                                (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchrole\"\r\n                                                [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                            <mat-icon (click)=\"searchrole = ''\" class=\"reseticon\" matSuffix\r\n                                                *ngIf=\"searchrole !='' && searchrole !=null\">clear</mat-icon>\r\n                                        </div>\r\n                                        <div class=\"option-listing countryselectwithimage\">\r\n                                            <mat-option *ngFor=\"let role of role_mstlist | filter : searchrole\"\r\n                                                [value]=\"role.rolemst_pk\">\r\n                                                {{ifarabic == true ? role.rm_rolename_ar : role.rm_rolename_en}}\r\n                                            </mat-option>\r\n                                        </div>\r\n\r\n                                    </mat-select>\r\n                                    <mat-error *ngIf=\"adduserform.arroles.errors?.required\">{{'addusers.selrol' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n\r\n                            </div>\r\n                            <!-- <div fxFlex.gt-sm=\"50\" *ngIf=\"opaladmincentreshow && !add_btn\" fxFlex=\"100\"\r\n                                class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                    <mat-label>{{'addroles.role' | translate}}</mat-label>\r\n                                    <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\"\r\n                                        matInput app-restrict-input=\"english\" required=\"{{requiredtag}}\"\r\n                                        formControlName=\"arrolescentre\">\r\n                                    <mat-error *ngIf=\"adduserform.arrolescentre.errors?.required\">{{'addusers.selrol' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n\r\n                            </div> -->\r\n                            <div fxFlex.gt-sm=\"50\" *ngIf=\"centredatashow\" fxFlex=\"100\" class=\"paddingspacing\"\r\n                           >\r\n                                <mat-form-field [ngClass]=\"updated == true ? 'autofectlist' : ' '\" appearance=\"outline\">\r\n                                    <mat-label>Role</mat-label>\r\n                                    <input [readonly]=\"updated\" (keydown.enter)=\"$event.preventDefault()\" [disabled]=\"viewUserdis\"\r\n                                        [errorStateMatcher]=\"matcher\" matInput app-restrict-input=\"english\"\r\n                                        [required]=\"requiredtag\" formControlName=\"rolecentre\">\r\n                                    <mat-error *ngIf=\"adduserform.rolecentre.errors?.required\">{{'addusers.selrol' |\r\n                                        translate}}</mat-error>\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div *ngIf=\"thirdaprtyshowopal\" fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\"\r\n                                ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\"\r\n                                ngClass.sm=\"m-0\">\r\n                                <mat-form-field appearance=\"outline\">\r\n                                    <mat-label>{{'addusers.isthidpart' | translate}} </mat-label>\r\n                                    <input formControlName=\"slider\" [errorStateMatcher]=\"matcher\" matInput [disabled]=\"viewUserdis\"\r\n                                        appAlphabetonly readonly required>\r\n                                    <span matSuffix>No\r\n                                        <mat-slide-toggle formControlName=\"slider\">Yes</mat-slide-toggle>\r\n                                    </span>\r\n                                    <!-- <mat-error *ngIf=\"addrolform.thirdpartyagent.errors?.required\">\r\n                                    {{'addusers.choosthurpart' | translate}} </mat-error> -->\r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n\r\n                    <div *ngIf=\"userroleallocation\" class=\"onlyviewallocate\">\r\n                        <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"aligncenter\">\r\n                                {{'addroles.assignmod' | translate}} <span class=\"m-l-5 infoicon\"\r\n                                    matTooltip=\"Lorem Ipsum is the dummy text\"><mat-icon>info_outline</mat-icon></span>\r\n                            </div>\r\n                        </div>\r\n                        <app-userallocation #addUpdateAccess (userPermData)=\"userPermData($event)\"\r\n                            [currentUserPk]=\"currentUserPk\"></app-userallocation>\r\n                        <!--permission access table-->\r\n                        <!--permission access table-->\r\n                        <div fxLayout=\"row wrap\" class=\"m-t-30\" fxLayoutAlign=\"end\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-end center\">\r\n                                <button mat-raised-button  *ngIf=\"!viewBackBackbutton\"type=\"button\" color=\"secondary\"\r\n                                    class=\"filterbtn m-r-10 height-45\" (click)=\"gotouserbackgrid();\">{{'addroles.canc' |\r\n                                    translate}}</button>\r\n                                <button mat-raised-button *ngIf=\"viewBackBackbutton\" type=\"button\" color=\"secondary\"\r\n                                    class=\"filterbtn m-r-10 height-45\" (click)=\"gotouserbackgrid();\">Close</button>\r\n                                <button *ngIf=\"add_btn && !viewBackBackbutton\" mat-raised-button [disabled]=\"isFormValid\"\r\n                                    [class.disabledsubmit]=\"isFormValid\" type=\"button\"\r\n                                    (click)=\"adduserdatasave()\" color=\"primary\"\r\n                                    class=\"addbtn height-45\">{{'addroles.subm' |\r\n                                    translate}}</button>\r\n                                <button *ngIf=\"!add_btn && !viewBackBackbutton\" mat-raised-button\r\n                                    [class.disabledsubmit]=\"isFormValid\" [disabled]=\"isFormValidss\"\r\n                                    type=\"button\" (click)=\"adduserdatasave()\" color=\"primary\"\r\n                                    class=\"addbtn height-45\">Update</button>\r\n                            </div>\r\n                        </div>\r\n\r\n                    </div>\r\n\r\n\r\n                </form>\r\n            </div>\r\n            <!-- ===== -->\r\n            <div id=\"manageusers\" *ngIf=\"refname == 3\" class=\"example-form\">\r\n                <div *ngIf=\"hidecentregrid\" class=\"paginationwithfilter masterPageTop \">\r\n                    <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                        [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n                    <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-start center\">\r\n                            <button mat-raised-button type=\"button\" color=\"secondary\" (click)=\"evenusercentredata();\"\r\n                                class=\"addbtn m-r-10 height-45\">{{'manageusers.add' | translate}}</button>\r\n                            <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                                class=\"filter height-45\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                                    aria-hidden=\"true\"></i></button>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div *ngIf=\"hidecentregrid\" fxLayout=\"row wrap\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                        <div class=\"awaredtable\">\r\n                            <mat-table #table class=\"scrolldata\" [dataSource]=\"Usersrecord\"\r\n                                matSortActive=\"opalusermst_pk\" matSortDirection=\"desc\" multiTemplateDataRows matSort\r\n                                matSortDisableClear>\r\n                                <ng-container matColumnDef=\"civilnumber\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.civino' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.civilNo}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"stafName\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.stafnam' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.stafName}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"emailid\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.emaiid' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.emailid}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"mobilenumber\">\r\n                                    <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.mobnum' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.mobilno}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"role\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.role' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.roleName_en}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"status\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.stat' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"{{'batch.branchname' |translate}}\" fxFlex=\"160px\"\r\n                                        *matCellDef=\"let coursedata\">\r\n\r\n                                        <p *ngIf=\"coursedata.status == 'A'\" class=\"print flexaligntag\">\r\n                                            {{'manageusers.activ' | translate}}</p>\r\n                                        <p *ngIf=\"coursedata.status == 'I'\" class=\"declined flexaligntag\">\r\n                                            {{'manageusers.inactiv' | translate}}</p>\r\n                                        <p *ngIf=\"coursedata.status == 'E'\" class=\"pending flexaligntag\">\r\n                                            {{'manageusers.emaiconfpen' | translate}}</p>\r\n                                        <p *ngIf=\"coursedata.status == 'D'\" class=\"pending flexaligntag\">\r\n                                            {{'manageusers.deact' | translate}}</p>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"added_on\">\r\n                                    <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.addon' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.addedOn}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"lastupdated\">\r\n                                    <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.lasupdaon' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                        {{coursedata.lastUpdateOn}} </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"action\">\r\n                                    <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                        mat-sort-header>{{'manageusers.actio' | translate}}</mat-header-cell>\r\n                                    <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                        <button mat-button\r\n                                            [matMenuTriggerFor]=\"menu\"><mat-icon>more_horiz</mat-icon></button>\r\n                                        <mat-menu #menu=\"matMenu\" class=\"actionmatmenu\">\r\n                                            <button mat-menu-item (click)=\"viewRoleuser(coursedata,coursedata.opalusermst_pk)\">{{'manageusers.view' |\r\n                                                translate}}</button>\r\n                                            <button mat-menu-item\r\n                                                (click)=\"editcentreData(coursedata)\">{{'manageusers.edit' |\r\n                                                translate}}</button>\r\n                                            <button *ngIf=\"coursedata.status == 'I'\"\r\n                                                (click)=\"update(coursedata.opalusermst_pk,coursedata.status)\"\r\n                                                mat-menu-item>{{'manageusers.activ' | translate}}</button>\r\n                                            <button *ngIf=\"coursedata.status == 'A'\"\r\n                                                (click)=\"update(coursedata.opalusermst_pk,coursedata.status)\"\r\n                                                mat-menu-item>{{'manageusers.deact' | translate}} </button>\r\n                                        </mat-menu>\r\n                                    </mat-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-one\">\r\n                                    <mat-header-cell fxFlex=\"220px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"civilNo\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-two\">\r\n                                    <mat-header-cell fxFlex=\"235px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"stafName\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-three\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"emailid\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-four\">\r\n                                    <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input [formControl]=\"mobilno\" matInput>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-five\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"roleName_en\">\r\n                                                <mat-option value=\"Auditor\">{{'manageusers.audi' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Assessor\">{{'manageusers.assrs' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Finance\">{{'manageusers.tuttrai' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Authority\">{{'manageusers.authar' |\r\n                                                    translate}}</mat-option>\r\n                                                <mat-option value=\"Quality Manager\">{{'manageusers.qualman' |\r\n                                                    translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-six\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"status\">\r\n                                                <mat-option value=\"A\">{{'manageusers.activ' | translate}}</mat-option>\r\n                                                <mat-option value=\"I\">{{'manageusers.inactiv' | translate}}</mat-option>\r\n                                                <mat-option value=\"E\">{{'manageusers.emaiconfpen' |\r\n                                                    translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <!-- <ng-container matColumnDef=\"row-seven\">\r\n                                    <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                            <mat-select [formControl]=\"addedOn\">\r\n                                                <mat-option value=\"1\">{{'manageusers.activ' | translate}}</mat-option>\r\n                                                <mat-option value=\"2\">{{'manageusers.inactiv' | translate}}</mat-option>\r\n                                            </mat-select>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container> -->\r\n                                <ng-container matColumnDef=\"row-seven\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"addedOn\" (click)=\"addedon.open()\"\r\n                                                [matDatepicker]=\"addedon\">\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #addedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"row-eight\">\r\n                                    <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                        style=\"text-align:center\">\r\n                                        <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                            <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                            <input matInput [formControl]=\"lastUpdateOn\" (click)=\"addedon.open()\"\r\n                                                [matDatepicker]=\"addedon\">\r\n                                            <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                            <mat-datepicker #addedon></mat-datepicker>\r\n                                        </mat-form-field>\r\n                                    </mat-header-cell>\r\n                                </ng-container>\r\n                                <tr mat-header-row id=\"headerrowcells\" *matHeaderRowDef=\"centerrecordcolumn\"></tr>\r\n                                <mat-header-row id=\"searchrow\"\r\n                                    *matHeaderRowDef=\"['row-one','row-two','row-three','row-four','row-five','row-six','row-seven','row-eight']\">\r\n                                </mat-header-row>\r\n                                <tr mat-row *matRowDef=\"let element; columns: centerrecordcolumn;\"\r\n                                    class=\"example-element-row\">\r\n                                </tr>\r\n                            </mat-table>\r\n                        </div>\r\n                        <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                                <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                                    class=\"masterPage masterbottom \" showFirstLastButtons\r\n                                    [pageSize]=\"paginator?.pageSize\" (page)=\"syncPrimaryPaginator($event);\"\r\n                                    [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\"\r\n                                    [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                                </mat-paginator>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <form id=\"manageusers\" *ngIf=\"centregrid\" class=\"example-form\" [formGroup]=\"centreform\">\r\n\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.sm=\"m-0\">\r\n                            <input type=\"hidden\"  value=\"\"  formControlName=\"opalusermstpk\">\r\n                            <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                                <mat-label>{{'addusers.stafnam' | translate}} </mat-label>\r\n                                <mat-select panelClass=\"select_with_search\" [errorStateMatcher]=\"matcher\" [disabled]=\"viewCenterUserdis\"\r\n                                    [disableOptionCentering]=\"true\"\r\n                                    *ngIf=\"(staffslistcentre | filter : searchsfaffnamecentre) as goverresult\"\r\n                                    (selectionChange)=\"selectcivilidcentre(cntreform.staffsnamecentre.value)\" required\r\n                                    formControlName=\"staffsnamecentre\">\r\n                                    <div class=\"searchinmultiselect\">\r\n                                        <mat-icon class=\"bgi bgi-search\">search</mat-icon>\r\n                                        <input (keydown.enter)=\"$event.preventDefault()\" appAlphanumsymb matInput\r\n                                            class=\"searchselect\" type=\"Search\" placeholder=\"{{'supplierreg.sear' | translate}}\"\r\n                                            (keydown)=\"$event.stopPropagation();\" [(ngModel)]=\"searchsfaffnamecentre\"\r\n                                            [ngModelOptions]=\"{standalone: true}\" autocomplete=\"off\">\r\n                                        <mat-icon (click)=\"searchsfaffnamecentre = ''\" class=\"reseticon\" matSuffix\r\n                                            *ngIf=\"searchsfaffnamecentre !='' && searchsfaffnamecentre !=null\">clear</mat-icon>\r\n                                    </div>\r\n                                    <div class=\"option-listing countryselectwithimage\">\r\n                                        <mat-option\r\n                                            *ngFor=\"let staflist of staffslistcentre | filter : searchsfaffnamecentre\"\r\n                                            value={{staflist.staffinforepo_pk}}> {{staflist.sir_name_en}}</mat-option>\r\n                                        <div *ngIf=\"goverresult.length == 0\">No result found</div>\r\n                                    </div>\r\n\r\n                                </mat-select>\r\n                                <mat-error *ngIf=\"cntreform.staffsnamecentre.errors?.required\">{{'addusers.entsatsnam' |\r\n                                    translate}}</mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                            ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field [ngClass]=\"updated == true ? 'autofectlist' : ' '\"\r\n                                class=\"example-full-width\" appearance=\"outline\">\r\n                                <mat-label>{{'addusers.civino' | translate}}</mat-label>\r\n                                <input [readonly]=\"updated\" matInput formControlName=\"civilnocentre\" [disabled]=\"viewCenterUserdis\">\r\n                                <mat-error *ngIf=\"cntreform.civilnocentre.errors?.required\">{{'addusers.entcivino' |\r\n                                    translate}}</mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field [ngClass]=\"updated == true ? 'autofectlist' : ' '\"\r\n                                class=\"example-full-width\" appearance=\"outline\">\r\n                                <mat-label>{{'addusers.emaiid' | translate}}</mat-label>\r\n                                <input [readonly]=\"updated\" matInput [disabled]=\"viewCenterUserdis\"\r\n                                    pattern=\"[a-zA-Z0-9]{1,}@[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,}\"\r\n                                    formControlName=\"emailidcentre\">\r\n                                <mat-error *ngIf=\"cntreform.emailidcentre.errors?.required\">{{'addusers.entemaiid' |\r\n                                    translate}}</mat-error>\r\n                                <mat-error\r\n                                    *ngIf=\"centreform.get('emailidcentre').hasError('pattern')\">{{'addusers.entevaliemai'\r\n                                    | translate}}</mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\" ngClass.md=\"p-l-30\"\r\n                            ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field [ngClass]=\"updated == true ? 'autofectlist' : ' '\" class=\"numberandcode\"\r\n                                floatLabel=\"always\" appearance=\"outline\">\r\n                                <mat-label>{{'addusers.mobnum' | translate}}</mat-label>\r\n                                <span ngClass.xs=\"p-r-0\" ngClass.sm=\"p-r-0\" class=\"p-r-5\">{{countrycode}}</span>\r\n                                <input [readonly]=\"updated\" matInput formControlName=\"mobilenumbercentre\" [disabled]=\"viewCenterUserdis\"\r\n                                    [maxLength]=\"12\" numbersOnly>\r\n                                <mat-error *ngIf=\"cntreform.mobilenumbercentre.errors?.required\">{{'addusers.selrol' |\r\n                                    translate}}</mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field [ngClass]=\"updated == true ? 'autofectlist' : ' '\"\r\n                                class=\"example-full-width\" appearance=\"outline\">\r\n                                <mat-label>Role</mat-label>\r\n                                <input [readonly]=\"updated\" (keydown.enter)=\"$event.preventDefault()\" [disabled]=\"viewCenterUserdis\"\r\n                                    [errorStateMatcher]=\"matcher\" matInput app-restrict-input=\"english\"\r\n                                    formControlName=\"rolescentre\">\r\n                                <mat-error *ngIf=\"cntreform.rolescentre.errors?.required\">{{'addusers.selrol' |\r\n                                    translate}}</mat-error>\r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"onlyviewallocate\">\r\n                        <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"aligncenter\">\r\n                                {{'addroles.assignmod' | translate}} <span class=\"m-l-5 infoicon\"\r\n                                    matTooltip=\"Lorem Ipsum is the dummy text\"><mat-icon>info_outline</mat-icon></span>\r\n                            </div>\r\n                        </div>\r\n                        <!--permission access table-->\r\n                        <app-userallocation #addUpdateAccess (userviewBackBackbuttonPermData)=\"userPermData($event)\"\r\n                            [currentUserPk]=\"currentUserPk\"></app-userallocation>\r\n                        <!--permission access table-->\r\n                        <div fxLayout=\"row wrap\" class=\"m-t-30\" fxLayoutAlign=\"end\">\r\n                            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-end center\">\r\n                                <button *ngIf=\"!viewBackBackbutton\" mat-raised-button type=\"button\" color=\"secondary\"\r\n                                    class=\"filterbtn m-r-10 height-45\" (click)=\"gotocentrebackgrid();\">{{'addroles.canc'\r\n                                    | translate}}</button>\r\n                                <button *ngIf=\"viewBackBackbutton\" mat-raised-button type=\"button\" color=\"secondary\"\r\n                                    class=\"filterbtn m-r-10 height-45\" (click)=\"gotocentrebackgrid();\">Close</button>\r\n                                <button *ngIf=\"add_btn && !viewBackBackbutton\" (click)=\"addcentredatasave();\" mat-raised-button\r\n                                    [disabled]=\"!centreform.valid\" [class.disabledsubmit]=\"!centreform.valid\"\r\n                                    type=\"button\" color=\"primary\" class=\"addbtn height-45\">{{'addroles.subm' |\r\n                                    translate}}</button>\r\n                                <button *ngIf=\"!add_btn && !viewBackBackbutton\" (click)=\"addcentredatasave();\" mat-raised-button\r\n                                    [disabled]=\"!centreform.valid\" [class.disabledsubmit]=\"!centreform.valid\"\r\n                                    type=\"button\" color=\"primary\" class=\"addbtn height-45\">Update</button>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n\r\n\r\n                </form>\r\n            </div>\r\n            <!-- ===== -->\r\n        </div>\r\n    </div>\r\n</div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/addusers/addusers.component.html":
/*!*******************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/addusers/addusers.component.html ***!
  \*******************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayout=\"row wrap\">\r\n    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"addusers\">\r\n        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"addusersnew\">\r\n                <form class=\"example-form\" [formGroup]=\"adduserroleform\" (ngSubmit)=\"adduserdatasave()\">\r\n            <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                    <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                        <mat-label>{{'addroles.stactyp' | translate}}</mat-label>\r\n                        <mat-select (selectionChange)=\"selectedStktype(addrolform.stkholdertype.value)\" [errorStateMatcher]=\"matcher\" required\r\n                            formControlName=\"stkholdertype\" >\r\n                            <mat-option [value]=\"1\">{{'addroles.opaladmi' | translate}}</mat-option>\r\n                            <mat-option [value]=\"2\">{{'addroles.trainevcen' | translate}}</mat-option>\r\n                            <mat-option [value]=\"3\">{{'addroles.techevcen' | translate}}</mat-option>\r\n                        </mat-select>\r\n                        <mat-error *ngIf=\"addrolform.stkholdertype.errors?.required\">{{'addroles.selstatyp' | translate}}</mat-error>\r\n                    </mat-form-field>\r\n                </div>\r\n            </div>\r\n            <div *ngIf=\"centredatashow\" fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                    <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                        <mat-label>Centre Name</mat-label>\r\n                        <mat-select [errorStateMatcher]=\"matcher\" required\r\n                            formControlName=\"centrename\" >\r\n                            <mat-option [value]=\"1\">United Nations Industrial Development Organization (UNIDO)</mat-option>\r\n                        </mat-select>\r\n                        <mat-error *ngIf=\"addrolform.centrename.errors?.required\">Select centre name</mat-error>\r\n                    </mat-form-field>\r\n                </div>\r\n            </div>\r\n            <div *ngIf=\"opaladmindatashow\">\r\n                <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                    <div  fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                        <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                            <mat-label>{{'addusers.civino' | translate}}</mat-label>\r\n                            <input matInput required formControlName=\"civilno\">\r\n                            <mat-error *ngIf=\"addrolform.civilno.errors?.required\">{{'addusers.entcivino' | translate}}</mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div  fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                    ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                    <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                        <mat-label>{{'addusers.stafnam' | translate}} </mat-label>\r\n                        <input matInput required formControlName=\"stafname\">\r\n                        <mat-error *ngIf=\"addrolform.stafname.errors?.required\">{{'addusers.entsatsnam' | translate}}</mat-error>\r\n                    </mat-form-field>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                    <div  fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                        <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                            <mat-label>{{'addusers.emaiid' | translate}}</mat-label>\r\n                            <input matInput required formControlName=\"emailid\">\r\n                            <mat-error *ngIf=\"addrolform.emailid.errors?.required\">{{'addusers.entemaiid' | translate}}</mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div  fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                    ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                    <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                        <mat-label>{{'addusers.mobnum' | translate}}</mat-label>\r\n                        <input matInput required formControlName=\"mobilenumber\" [maxLength]=\"12\" numbersOnly>\r\n                        <mat-error *ngIf=\"addrolform.mobilenumber.errors?.required\">{{'addusers.selrol' | translate}}</mat-error>\r\n                    </mat-form-field>\r\n                    </div>\r\n                </div>\r\n                <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                    <div  fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                        <mat-form-field class=\"example-full-width\" appearance=\"outline\">\r\n                            <mat-label>{{'addroles.role' | translate}}</mat-label>\r\n                            <mat-select [errorStateMatcher]=\"matcher\" required\r\n                                formControlName=\"arrole\">\r\n                                <mat-option [value]=\"1\">{{'addroles.audi' | translate}}</mat-option>\r\n                                <mat-option [value]=\"2\">{{'addroles.ceo' | translate}}</mat-option>\r\n                                <mat-option [value]=\"3\">{{'addroles.asses' | translate}}</mat-option>\r\n                                <mat-option [value]=\"4\">{{'addroles.fina' | translate}}</mat-option>\r\n                                <mat-option [value]=\"5\">{{'addroles.authr' | translate}}</mat-option>\r\n                            </mat-select>\r\n                            <mat-error *ngIf=\"addrolform.arrole.errors?.required\">{{'addusers.selrol' | translate}}</mat-error>\r\n                        </mat-form-field>\r\n                    </div>\r\n                    <div *ngIf=\"thirdaprtyshowopal\"  fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                    ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                    <mat-form-field appearance=\"outline\">\r\n                        <mat-label>{{'addusers.isthidpart' | translate}} </mat-label>\r\n                        <input (keydown.enter)=\"$event.preventDefault()\" [errorStateMatcher]=\"matcher\"\r\n                            matInput appAlphabetonly readonly required>\r\n                        <span matSuffix>No <mat-slide-toggle required\r\n                                formControlName=\"slider\">Yes</mat-slide-toggle></span>\r\n                        <!-- <mat-error *ngIf=\"addrolform.thirdpartyagent.errors?.required\">\r\n                            {{'addusers.choosthurpart' | translate}} </mat-error> -->\r\n                    </mat-form-field>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n          \r\n            <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"aligncenter\">\r\n                    {{'addroles.assignmod' | translate}} <span class=\"m-l-5 infoicon\" matTooltip=\"Lorem Ipsum is the dummy text\"><mat-icon>info_outline</mat-icon></span>\r\n                </div>\r\n            </div>\r\n\r\n            <!--permission access table-->\r\n            <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"permissiontable\">\r\n                    <table mat-table\r\n                    [dataSource]=\"dataSource\" multiTemplateDataRows\r\n                    class=\"mat-elevation-z8\">\r\n                        <ng-container matColumnDef=\"name\">\r\n                            <th mat-header-cell *matHeaderCellDef> \r\n                                {{'addroles.modulnam' | translate}} \r\n                            </th>\r\n                            <td mat-cell *matCellDef=\"let element\"> \r\n                                    <label class=\"checkcontainer\">\r\n                                        <input type=\"checkbox\">\r\n                                        <span class=\"checkmark\"></span>\r\n                                    </label> {{element.name}} \r\n                            </td>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"create\">\r\n                            <th mat-header-cell *matHeaderCellDef> \r\n                                {{'addroles.cret' | translate}} \r\n                            </th>\r\n                            <td mat-cell *matCellDef=\"let element\"> \r\n                                <label class=\"checkcontainer\">\r\n                                    <input type=\"checkbox\">\r\n                                    <span class=\"checkmark\"></span>\r\n                                </label> {{element.create}} \r\n                            </td>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"update\">\r\n                            <th mat-header-cell *matHeaderCellDef> \r\n                                {{'addroles.updat' | translate}} \r\n                            </th>\r\n                            <td mat-cell *matCellDef=\"let element\"> \r\n                                <label class=\"checkcontainer\">\r\n                                    <input type=\"checkbox\">\r\n                                    <span class=\"checkmark\"></span>\r\n                                </label>\r\n                                {{element.update}} \r\n                            </td>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"delete\">\r\n                            <th mat-header-cell *matHeaderCellDef> \r\n                                {{'addroles.dele' | translate}} \r\n                            </th>\r\n                            <td mat-cell *matCellDef=\"let element\"> \r\n                                <label class=\"checkcontainer\">\r\n                                    <input type=\"checkbox\">\r\n                                    <span class=\"checkmark\"></span>\r\n                                </label>\r\n                                {{element.delete}} \r\n                            </td>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"approve\">\r\n                            <th mat-header-cell *matHeaderCellDef> \r\n                                {{'addroles.appro' | translate}}\r\n                            </th>\r\n                            <td mat-cell *matCellDef=\"let element\"> \r\n                                <label class=\"checkcontainer\">\r\n                                    <input type=\"checkbox\">\r\n                                    <span class=\"checkmark\"></span>\r\n                                </label>\r\n                                {{element.approve}} \r\n                            </td>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"download\">\r\n                            <th mat-header-cell *matHeaderCellDef> \r\n                                {{'addroles.downl' | translate}} \r\n                            </th>\r\n                            <td mat-cell *matCellDef=\"let element\"> \r\n                                <label class=\"checkcontainer\">\r\n                                    <input type=\"checkbox\" disabled>\r\n                                    <span class=\"checkmark\"></span>\r\n                                </label>\r\n                                {{element.download}} \r\n                                <span \r\n                                class=\"example-element-row expandicon\"\r\n                                [class.example-expanded-row]=\"expandedElement === element\"\r\n                                (click)=\"expandedElement = expandedElement === element ? null : element\"><mat-icon>{{expandedElement === element? 'remove' : 'add'}}</mat-icon></span>\r\n                            </td>\r\n                        </ng-container>\r\n                        <!-- Expanded Content Column - The detail row is made up of this one column that spans across all columns -->\r\n                        <ng-container matColumnDef=\"expandedDetail\">\r\n                            <td class=\"nopaddingtd\" mat-cell *matCellDef=\"let element\" [attr.colspan]=\"columnsToDisplay.length\">\r\n                            <div class=\"example-element-detail\"\r\n                                    [@detailExpand]=\"element == expandedElement ? 'expanded' : 'collapsed'\">\r\n                                    <table #innerTables class=\"subtable\" mat-table [dataSource]=\"element.submodule\">\r\n                                            <ng-container matColumnDef=\"sname\">\r\n                                                    <th mat-header-cell *matHeaderCellDef></th>\r\n                                                    <td mat-cell *matCellDef=\"let element\"> <span class=\"p-l-30\">{{element.sname}} </span></td>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"screate\">\r\n                                                    <th mat-header-cell *matHeaderCellDef></th>\r\n                                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                                        <label class=\"checkcontainer\">\r\n                                                            <input type=\"checkbox\">\r\n                                                            <span class=\"checkmark\"></span>\r\n                                                        </label> \r\n                                                        {{element.screate}} \r\n                                                    </td>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"supdate\">\r\n                                                    <th mat-header-cell *matHeaderCellDef></th>\r\n                                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                                        <label class=\"checkcontainer\">\r\n                                                            <input type=\"checkbox\">\r\n                                                            <span class=\"checkmark\"></span>\r\n                                                        </label>\r\n                                                        {{element.supdate}} \r\n                                                    </td>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"sdelete\">\r\n                                                    <th mat-header-cell *matHeaderCellDef></th>\r\n                                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                                        <label class=\"checkcontainer\">\r\n                                                            <input type=\"checkbox\">\r\n                                                            <span class=\"checkmark\"></span>\r\n                                                        </label>\r\n                                                        {{element.sdelete}} \r\n                                                    </td>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"sapprove\">\r\n                                                    <th mat-header-cell *matHeaderCellDef></th>\r\n                                                    <td mat-cell *matCellDef=\"let element\">\r\n                                                        <label class=\"checkcontainer\">\r\n                                                            <input type=\"checkbox\">\r\n                                                            <span class=\"checkmark\"></span>\r\n                                                        </label>\r\n                                                        {{element.sapprove}}\r\n                                                     </td>\r\n                                                </ng-container>\r\n                                                <ng-container matColumnDef=\"sdownload\">\r\n                                                    <th mat-header-cell *matHeaderCellDef></th>\r\n                                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                                        <label class=\"checkcontainer\">\r\n                                                            <input type=\"checkbox\">\r\n                                                            <span class=\"checkmark\"></span>\r\n                                                        </label>\r\n                                                        {{element.sdownload}} \r\n                                                    </td>\r\n                                                </ng-container>\r\n                                        <tr mat-header-row *matHeaderRowDef=\"innerDisplayedColumns\"></tr>\r\n                                        <tr mat-row *matRowDef=\"let row; columns: innerDisplayedColumns;\"></tr>\r\n                                    </table>\r\n                            </div>\r\n                            </td>\r\n                        </ng-container>\r\n                        \r\n                        <tr mat-header-row *matHeaderRowDef=\"columnsToDisplay\"></tr>\r\n                        <tr mat-row *matRowDef=\"let element; columns: columnsToDisplay;\">\r\n                        </tr>\r\n                        <tr mat-row *matRowDef=\"let row; columns: ['expandedDetail']\" class=\"example-detail-row\"></tr>\r\n                    </table>\r\n                </div>\r\n            </div>            \r\n            <!--permission access table-->\r\n            <div fxLayout=\"row wrap\" class=\"m-t-30\" fxLayoutAlign=\"end\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-end center\">\r\n                    <button mat-raised-button type=\"button\" color=\"secondary\"\r\n                        class=\"filterbtn m-r-10 height-45\" (click)=\"gotoback();\">{{'addroles.canc' | translate}}</button>\r\n                    <button mat-raised-button   type=\"submit\" color=\"primary\"\r\n                        class=\"addbtn height-45\">{{'addroles.subm' | translate}}</button>\r\n                </div>\r\n            </div>\r\n\r\n            </form>\r\n            \r\n    </div>\r\n</div>\r\n</div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.html":
/*!*************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.html ***!
  \*************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayout=\"row wrap\">\r\n    <div *ngIf=\"!addrolecreationpage\" fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"manageroles\">\r\n        <div class=\"paginationwithfilter masterPageTop \">\r\n            <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n            <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-start center\">\r\n                    <button mat-raised-button type=\"button\" color=\"secondary\" [routerLink]=\"['/newenterpriseadmin/addroles']\"\r\n                    [queryParams]=\"{type: 1}\"  class=\"addbtn m-r-10 height-45\">{{'manageroles.add' | translate}}</button>\r\n                    <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                        class=\"filter height-45\">{{filtername}}<i class=\"fa fa-filter m-l-6\" aria-hidden=\"true\"></i></button>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                <div class=\"awaredtable\">\r\n                    <mat-table #table class=\"scrolldata\" [dataSource]=\"roledata.data\" multiTemplateDataRows matSort matSortDisableClear>\r\n                        \r\n                        <ng-container matColumnDef=\"stakeholdertype\">\r\n                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.stactyp' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.stakeholdertype}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"projectname_en\">\r\n                            <mat-header-cell fxFlex=\"330px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.proj' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch Type\" fxFlex=\"330px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.projectname_en}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"rolename_en\">\r\n                            <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.role' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                    {{coursedata.rolename_en}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"higherRole\">\r\n                            <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.highrol' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                    {{coursedata.higherRole}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"status\">\r\n                            <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.stat' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"{{'batch.branchname' |\r\n                            translate}}\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                            <p *ngIf=\"coursedata.status == 1\" class=\"print flexaligntag\">{{'manageroles.activ' | translate}}</p>\r\n                            <p *ngIf=\"coursedata.status == 2\"  class=\"declined flexaligntag\">{{'manageroles.inact' | translate}}</p>\r\n                            </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"addedOn\">\r\n                            <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.addon' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                    {{coursedata.addedOn}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"updatedOn\">\r\n                            <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.lastadon' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                    {{coursedata.updatedOn}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"action\">\r\n                            <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageroles.actio' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                    <button mat-button [matMenuTriggerFor]=\"menu\"><mat-icon>more_horiz</mat-icon></button>\r\n                                    <mat-menu #menu=\"matMenu\" class=\"actionmatmenu\">\r\n                                        <button mat-menu-item (click)=\"viewroute()\">{{'manageroles.view' | translate}}</button>\r\n                                        <button mat-menu-item (click)=\"editData(coursedata)\">Edit</button>\r\n                                        <button *ngIf=\"coursedata.status == 'I'\" mat-menu-item>{{'manageroles.acti' | translate}}</button>\r\n                                        <button *ngIf=\"coursedata.status == 'A'\" mat-menu-item>{{'manageroles.deact' | translate}}</button>\r\n                                    </mat-menu>   \r\n                                </mat-cell>\r\n                        </ng-container>  \r\n                        <ng-container matColumnDef=\"row-first\">\r\n                            <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>Search</mat-label>\r\n                                    <mat-select [formControl]=\"stktypesearch\">\r\n                                        <mat-option value=\"OPAL Admin\">{{'manageroles.opaladm' | translate}}</mat-option>\r\n                                        <mat-option value=\"Training Evaluation Centre\">{{'manageroles.traievalcen' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-second\">\r\n                            <mat-header-cell fxFlex=\"330px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"projectsearch\">\r\n                                        <mat-option value=\"Road Worthiness Assurance Standard (RAS)\">{{'manageroles.roadworthassu' | translate}}</mat-option>\r\n                                        <mat-option value=\"In-Vehicle Monitoring System (IVMS)\">{{'manageroles.invehmon' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-three\">\r\n                            <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageroles.sele' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"rolesearch\">\r\n                                        <mat-option value=\"Auditor\">{{'manageroles.audit' | translate}}</mat-option>\r\n                                        <mat-option value=\"Assessor\">{{'manageroles.asses' | translate}}</mat-option>\r\n                                        <mat-option value=\"Finance\">{{'manageroles.fina' | translate}}</mat-option>\r\n                                        <mat-option value=\"Authority\">{{'manageroles.authar' | translate}}</mat-option>\r\n                                        <mat-option value=\"Quality Manager\">{{'manageroles.qualmanag' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-four\">\r\n                            <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageroles.sele' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"highrolesearch\">\r\n                                        <mat-option value=\"Authority\">{{'manageroles.authar' | translate}}</mat-option>\r\n                                        <mat-option value=\"CEO\">{{'manageroles.ceo' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-five\">\r\n                            <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageroles.sele' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"statussearch\">\r\n                                        <mat-option value=\"1\">{{'manageroles.activ' | translate}}</mat-option>\r\n                                        <mat-option value=\"2\">{{'manageroles.inact' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-six\">\r\n                            <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                <input matInput [formControl]=\"addedonsearch\" (click)=\"addedon.open()\"\r\n                                    [matDatepicker]=\"addedon\">\r\n                                <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                <mat-datepicker #addedon></mat-datepicker>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-seven\">\r\n                            <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageroles.sear' | translate}}</mat-label>\r\n                                <input matInput [formControl]=\"updatedonsearch\" (click)=\"updatedon.open()\"\r\n                                    [matDatepicker]=\"updatedon\">\r\n                                <mat-datepicker-toggle matSuffix [for]=\"updatedon\"></mat-datepicker-toggle>\r\n                                <mat-datepicker #updatedon></mat-datepicker>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <tr mat-header-row  id=\"headerrowcells\" *matHeaderRowDef=\"rolesrecordcolumn\"></tr>\r\n                        <mat-header-row id=\"searchrow\"\r\n                            *matHeaderRowDef=\"['row-first','row-second','row-three' ,'row-four','row-five','row-six','row-seven']\">\r\n                        </mat-header-row>\r\n                        <tr mat-row *matRowDef=\"let element; columns: rolesrecordcolumn;\"\r\n                            class=\"example-element-row\">\r\n                        </tr>\r\n                    </mat-table>\r\n                </div>\r\n                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                        <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                            class=\"masterPage masterbottom \" showFirstLastButtons [pageSize]=\"paginator?.pageSize\"\r\n                            (page)=\"syncPrimaryPaginator($event);\" [pageIndex]=\"paginator?.pageIndex\"\r\n                            [length]=\"paginator?.length\" [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                        </mat-paginator>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n   </div>   \r\n</div>\r\n\r\n\r\n<app-addroles *ngIf=\"addrolecreationpage\" (rolegridlistdata)=\"gridlistdata($event)\" (addrolecreation)=\"addrolecreationdata($event)\"></app-addroles>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.html":
/*!*************************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.html ***!
  \*************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n    <div *ngIf=\"!addrolecreationpage\" fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"manageusers\">\r\n        <div class=\"paginationwithfilter masterPageTop \">\r\n            <mat-paginator class=\"masterPage masterPageTop\" #paginator [length]=\"resultsLength\" [pageSize]=\"10\"\r\n                [pageSizeOptions]=\"[5, 10, 25, 100]\" (page)=\"syncPrimaryPaginator($event);\"></mat-paginator>\r\n            <div fxLayout=\"row wrap\" fxLayoutAlign=\"end\">\r\n                <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-start center\">\r\n                    <button mat-raised-button type=\"button\" color=\"secondary\" (click)=\"routeToadduser();\"\r\n                        class=\"addbtn m-r-10 height-45\">{{'manageusers.add' | translate}}</button>\r\n                    <button mat-raised-button type=\"button\" color=\"primary\" (click)=\"clickEvent();\"\r\n                        class=\"filter height-45\">{{filtername}}<i class=\"fa fa-filter m-l-6\"\r\n                            aria-hidden=\"true\"></i></button>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div fxLayout=\"row wrap\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"tabforclientelenew\">\r\n                <div class=\"awaredtable\">\r\n                    <mat-table #table class=\"scrolldata\" [dataSource]=\"Usersrecord\" matSortActive=\"opalusermst_pk\"  matSortDirection=\"desc\" multiTemplateDataRows matSort\r\n                        matSortDisableClear>\r\n                        <ng-container matColumnDef=\"oshm_stakeholdertype\">\r\n                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.staholtyp' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.stakeholdertype}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"oum_idnumber\">\r\n                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.civino' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.civilNo}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"stafname\">\r\n                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.stafnam' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.stafName}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"emailid\">\r\n                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.emaiid' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.emailid}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"mobilenumber\">\r\n                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.mobnum' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.mobilno}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"role\">\r\n                            <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.role' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                    {{coursedata.roleName_en}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"thirdpartyagent\">\r\n                            <mat-header-cell fxFlex=\"230px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.thirdparagen' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"Batch No\" fxFlex=\"230px\" *matCellDef=\"let coursedata\">\r\n                                {{coursedata.isthirdPartyAgent}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"status\">\r\n                            <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.stat' | translate}}</mat-header-cell>\r\n                            <mat-cell data-label=\"{{'batch.branchname' |translate}}\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                            <p *ngIf=\"coursedata.status == 'A'\" class=\"print flexaligntag\">{{'manageusers.activ' | translate}}</p>\r\n                            <p *ngIf=\"coursedata.status == 'I'\"  class=\"declined flexaligntag\">{{'manageusers.inactiv' | translate}}</p>\r\n                            <p *ngIf=\"coursedata.status == 'E'\"  class=\"pending flexaligntag\">{{'manageusers.emaiconfpen' | translate}}</p>\r\n                            <p *ngIf=\"coursedata.status == 'D'\"  class=\"pending flexaligntag\">{{'manageusers.deact' | translate}}</p>\r\n                            </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"added_on\">\r\n                            <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.addon' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                    {{coursedata.addedOn}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"lastupdated\">\r\n                            <mat-header-cell fxFlex=\"180px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.lasupdaon' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"180px\" *matCellDef=\"let coursedata\">\r\n                                    {{coursedata.lastUpdateOn}} </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"action\">\r\n                            <mat-header-cell fxFlex=\"160px\" mat-header-cell *matHeaderCellDef\r\n                                mat-sort-header>{{'manageusers.actio' | translate}}</mat-header-cell>\r\n                                <mat-cell data-label=\"Batch Type\" fxFlex=\"160px\" *matCellDef=\"let coursedata\">\r\n                                    <button mat-button [matMenuTriggerFor]=\"menu\"><mat-icon>more_horiz</mat-icon></button>\r\n                                    <mat-menu #menu=\"matMenu\" class=\"actionmatmenu\">\r\n                                        <button mat-menu-item (click)=\"viewroute()\">{{'manageusers.view' | translate}}</button>\r\n                                        <button mat-menu-item>{{'manageusers.edit' | translate}}</button>\r\n                                        <button *ngIf=\"coursedata.status == 'I'\" mat-menu-item>{{'manageusers.activ' | translate}}</button>\r\n                                        <button *ngIf=\"coursedata.status == 'A'\" mat-menu-item>{{'manageusers.deact' | translate}}    </button>\r\n                                    </mat-menu>   \r\n                                </mat-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-first\">\r\n                            <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"stakeholdertype\">\r\n                                        <mat-option value=\"OPAL Admin\">{{'manageusers.opaladmin' | translate}}</mat-option>\r\n                                        <mat-option value=\"Training Evaluation Centre\">{{'manageusers.traievacen' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-second\">\r\n                            <mat-header-cell fxFlex=\"220px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                <input [formControl]=\"civilNo\" matInput>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-three\">\r\n                            <mat-header-cell fxFlex=\"235px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                <input [formControl]=\"stafName\" matInput>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-four\">\r\n                            <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                <input [formControl]=\"emailid\" matInput>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-five\">\r\n                            <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                <input [formControl]=\"mobilno\" matInput>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-six\">\r\n                            <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"roleName_en\">\r\n                                        <mat-option value=\"Auditor\">{{'manageusers.audi' | translate}}</mat-option>\r\n                                        <mat-option value=\"Assessor\">{{'manageusers.tuttrai' | translate}}</mat-option>\r\n                                        <mat-option value=\"Finance\">{{'manageusers.assrs' | translate}}</mat-option>\r\n                                        <mat-option value=\"Authority\">{{'manageusers.authar' | translate}}</mat-option>\r\n                                        <mat-option value=\"Quality Manager\">{{'manageusers.qualman' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-seven\">\r\n                            <mat-header-cell fxFlex=\"230px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                <input [formControl]=\"isthirdPartyAgent\" matInput>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-eight\">\r\n                            <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"status\">\r\n                                        <mat-option value=\"A\">{{'manageusers.activ' | translate}}</mat-option>\r\n                                        <mat-option value=\"I\">{{'manageusers.inactiv' | translate}}</mat-option>\r\n                                        <mat-option value=\"E\">{{'manageusers.emaiconfpen' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-nine\">\r\n                            <mat-header-cell fxFlex=\"160px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                    <mat-label>{{'manageusers.sele' | translate}}</mat-label>\r\n                                    <mat-select [formControl]=\"status\">\r\n                                        <mat-option value=\"1\">{{'manageusers.activ' | translate}}</mat-option>\r\n                                        <mat-option value=\"2\">{{'manageusers.inactiv' | translate}}</mat-option>\r\n                                    </mat-select>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                        <ng-container matColumnDef=\"row-ten\">\r\n                            <mat-header-cell fxFlex=\"180px\" class=\"serachrow\" *matHeaderCellDef\r\n                                style=\"text-align:center\">\r\n                                <mat-form-field class=\"filter\" appearance=\"outline\">\r\n                                <mat-label>{{'manageusers.searc' | translate}}</mat-label>\r\n                                <input matInput [formControl]=\"addedOn\" (click)=\"addedon.open()\"\r\n                                    [matDatepicker]=\"addedon\">\r\n                                <mat-datepicker-toggle matSuffix [for]=\"addedon\"></mat-datepicker-toggle>\r\n                                <mat-datepicker #addedon></mat-datepicker>\r\n                                </mat-form-field>\r\n                            </mat-header-cell>\r\n                        </ng-container>\r\n                       \r\n                        <tr mat-header-row  id=\"headerrowcells\" *matHeaderRowDef=\"rolesrecordcolumn\"></tr>\r\n                        <mat-header-row id=\"searchrow\"\r\n                            *matHeaderRowDef=\"['row-first','row-second','row-three','row-four','row-five','row-six','row-seven','row-eight','row-nine','row-ten']\">\r\n                        </mat-header-row>\r\n                        <tr mat-row *matRowDef=\"let element; columns: rolesrecordcolumn;\"\r\n                            class=\"example-element-row\">\r\n                        </tr>\r\n                    </mat-table>\r\n                </div>\r\n                <div fxLayout=\"row\" fxLayoutAlign=\"end\" class=\"m-b-15 m-t-30\">\r\n                    <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"footerpaginator\">\r\n                        <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                            class=\"masterPage masterbottom \" showFirstLastButtons [pageSize]=\"paginator?.pageSize\"\r\n                            (page)=\"syncPrimaryPaginator($event);\" [pageIndex]=\"paginator?.pageIndex\"\r\n                            [length]=\"paginator?.length\" [pageSizeOptions]=\"paginator?.pageSizeOptions\">\r\n                        </mat-paginator>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<app-addusers *ngIf=\"addrolecreationpage\" (rolegridlistdata)=\"gridlistdata($event)\" (addrolecreation)=\"addrolecreationdata($event)\"></app-addusers>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.html":
/*!*********************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.html ***!
  \*********************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayout=\"row wrap\">\r\n        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"viewroles\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"viewrolesnew\">\r\n                    <form class=\"example-form\" [formGroup]=\"viewroleform\">\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewroles.stactype' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"stkholdertype\" value=\"OPAL Admin\">\r\n                            </mat-form-field>\r\n                        </div>\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                        ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewroles.techevacen' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"techeval\" value=\"Road Worthiness Assurance Standard (RAS)\">                                \r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewroles.role' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"arrole\" value=\"CEO\">  \r\n                            </mat-form-field>\r\n                        </div>\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                        ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewroles.highrrole' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"arrolehigh\" value=\"Authority\"> \r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"aligncenter\">\r\n                            {{'viewroles.allomodulacce' | translate}}\r\n                        </div>\r\n                    </div>\r\n    \r\n                    <!--permission access table-->\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"permissiontable\">\r\n                            <table mat-table\r\n                            [dataSource]=\"dataSource\" multiTemplateDataRows\r\n                            class=\"mat-elevation-z8\">\r\n                                <ng-container matColumnDef=\"name\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewroles.modulname' | translate}}  \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                            {{element.name}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"create\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewroles.cret' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label> {{element.create}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"update\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewroles.updat' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.update}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"delete\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewroles.dele' | translate}}  \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.delete}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"approve\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewroles.approv' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.approve}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"download\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewroles.dowl' | translate}}\r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\" disabled>\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.download}} \r\n                                        <span \r\n                                        class=\"example-element-row expandicon\"\r\n                                        [class.example-expanded-row]=\"expandedElement === element\"\r\n                                        (click)=\"expandedElement = expandedElement === element ? null : element\"><mat-icon>{{expandedElement === element? 'remove' : 'add'}}</mat-icon></span>\r\n                                    </td>\r\n                                </ng-container>\r\n                                <!-- Expanded Content Column - The detail row is made up of this one column that spans across all columns -->\r\n                                <ng-container matColumnDef=\"expandedDetail\">\r\n                                    <td class=\"nopaddingtd\" mat-cell *matCellDef=\"let element\" [attr.colspan]=\"columnsToDisplay.length\">\r\n                                    <div class=\"example-element-detail\"\r\n                                            [@detailExpand]=\"element == expandedElement ? 'expanded' : 'collapsed'\">\r\n                                            <table #innerTables class=\"subtable\" mat-table [dataSource]=\"element.submodule\">\r\n                                                    <ng-container matColumnDef=\"sname\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> <span class=\"p-l-30\">{{element.sname}} </span></td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"screate\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label> \r\n                                                                {{element.screate}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"supdate\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.supdate}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"sdelete\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.sdelete}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"sapprove\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\">\r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.sapprove}}\r\n                                                             </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"sdownload\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.sdownload}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                <tr mat-header-row *matHeaderRowDef=\"innerDisplayedColumns\"></tr>\r\n                                                <tr mat-row *matRowDef=\"let row; columns: innerDisplayedColumns;\"></tr>\r\n                                            </table>\r\n                                    </div>\r\n                                    </td>\r\n                                </ng-container>\r\n                                \r\n                                <tr mat-header-row *matHeaderRowDef=\"columnsToDisplay\"></tr>\r\n                                <tr mat-row *matRowDef=\"let element; columns: columnsToDisplay;\">\r\n                                </tr>\r\n                                <tr mat-row *matRowDef=\"let row; columns: ['expandedDetail']\" class=\"example-detail-row\"></tr>\r\n                            </table>\r\n                        </div>\r\n                    </div>                \r\n                    <!--permission access table-->\r\n                    <div fxLayout=\"row wrap\" class=\"m-t-30\" fxLayoutAlign=\"end\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-end center\">\r\n                            <button mat-raised-button type=\"button\" color=\"secondary\"\r\n                                class=\"filterbtn height-45\">{{'viewroles.clos' | translate}}</button>\r\n                        </div>\r\n                    </div>\r\n    \r\n                    </form>\r\n            </div>\r\n        </div>\r\n    </div>");

/***/ }),

/***/ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.html":
/*!*********************************************************************************************************************!*\
  !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.html ***!
  \*********************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("<div fxLayout=\"row wrap\">\r\n        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" id=\"viewusers\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"viewusersnew\">\r\n                    <form class=\"example-form\" [formGroup]=\"viewuserform\">\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label> {{'viewusers.stactyp' | translate}} </mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"stkholdertype\" value=\"Project\">\r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewusers.centrnam' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"centrename\" value=\"United Nations Industrial Development Organization (UNIDO)\">                                \r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewusers.stafnam' | translate}}`</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"staffname\" value=\"Saleh Abdullah Kamel\">  \r\n                            </mat-form-field>\r\n                        </div>\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                        ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewusers.civilnam' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"civilnumber\" value=\"CVN007896\"> \r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewusers.emaiid' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"emailid\" value=\"salehabdullahkamel@gmail.com\">  \r\n                            </mat-form-field>\r\n                        </div>\r\n                        <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                        ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                            <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                <mat-label>{{'viewusers.mobnum' | translate}}</mat-label>\r\n                                <input matInput readonly=\"true\" formControlName=\"mobileno\" value=\"+968 2487 7683\"> \r\n                            </mat-form-field>\r\n                        </div>\r\n                    </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\" fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                    <mat-label>{{'viewusers.role' | translate}}</mat-label>\r\n                                    <input matInput readonly=\"true\" formControlName=\"role\" value=\"Auditor\">  \r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"aligncenter\">\r\n                            {{'viewusers.allomoduacc' | translate}}\r\n                        </div>\r\n                    </div>\r\n    \r\n                    <!--permission access table-->\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-15\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"permissiontable\">\r\n                            <table mat-table\r\n                            [dataSource]=\"dataSource\" multiTemplateDataRows\r\n                            class=\"mat-elevation-z8\">\r\n                                <ng-container matColumnDef=\"name\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewusers.modunam' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                            {{element.name}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"create\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewusers.cret' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label> {{element.create}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"update\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewusers.upda' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.update}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"delete\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewusers.dele' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.delete}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"approve\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewusers.appro' | translate}}\r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\">\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.approve}} \r\n                                    </td>\r\n                                </ng-container>\r\n                                <ng-container matColumnDef=\"download\">\r\n                                    <th mat-header-cell *matHeaderCellDef> \r\n                                        {{'viewusers.down' | translate}} \r\n                                    </th>\r\n                                    <td mat-cell *matCellDef=\"let element\"> \r\n                                        <label class=\"checkcontainer\">\r\n                                            <input type=\"checkbox\" disabled>\r\n                                            <span class=\"checkmark\"></span>\r\n                                        </label>\r\n                                        {{element.download}} \r\n                                        <span \r\n                                        class=\"example-element-row expandicon\"\r\n                                        [class.example-expanded-row]=\"expandedElement === element\"\r\n                                        (click)=\"expandedElement = expandedElement === element ? null : element\"><mat-icon>{{expandedElement === element? 'remove' : 'add'}}</mat-icon></span>\r\n                                    </td>\r\n                                </ng-container>\r\n                                <!-- Expanded Content Column - The detail row is made up of this one column that spans across all columns -->\r\n                                <ng-container matColumnDef=\"expandedDetail\">\r\n                                    <td class=\"nopaddingtd\" mat-cell *matCellDef=\"let element\" [attr.colspan]=\"columnsToDisplay.length\">\r\n                                    <div class=\"example-element-detail\"\r\n                                            [@detailExpand]=\"element == expandedElement ? 'expanded' : 'collapsed'\">\r\n                                            <table #innerTables class=\"subtable\" mat-table [dataSource]=\"element.submodule\">\r\n                                                    <ng-container matColumnDef=\"sname\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> <span class=\"p-l-30\">{{element.sname}} </span></td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"screate\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label> \r\n                                                                {{element.screate}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"supdate\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.supdate}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"sdelete\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.sdelete}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"sapprove\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\">\r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.sapprove}}\r\n                                                             </td>\r\n                                                        </ng-container>\r\n                                                        <ng-container matColumnDef=\"sdownload\">\r\n                                                            <th mat-header-cell *matHeaderCellDef></th>\r\n                                                            <td mat-cell *matCellDef=\"let element\"> \r\n                                                                <label class=\"checkcontainer\">\r\n                                                                    <input type=\"checkbox\">\r\n                                                                    <span class=\"checkmark\"></span>\r\n                                                                </label>\r\n                                                                {{element.sdownload}} \r\n                                                            </td>\r\n                                                        </ng-container>\r\n                                                <tr mat-header-row *matHeaderRowDef=\"innerDisplayedColumns\"></tr>\r\n                                                <tr mat-row *matRowDef=\"let row; columns: innerDisplayedColumns;\"></tr>\r\n                                            </table>\r\n                                    </div>\r\n                                    </td>\r\n                                </ng-container>\r\n                                \r\n                                <tr mat-header-row *matHeaderRowDef=\"columnsToDisplay\"></tr>\r\n                                <tr mat-row *matRowDef=\"let element; columns: columnsToDisplay;\">\r\n                                </tr>\r\n                                <tr mat-row *matRowDef=\"let row; columns: ['expandedDetail']\" class=\"example-detail-row\"></tr>\r\n                            </table>\r\n                        </div>\r\n                    </div>                \r\n                    <!--permission access table-->\r\n                    <div fxLayout=\"row wrap\" class=\"p-t-30\" fxLayoutAlign=\"space-between center\">\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" class=\"paddingspacing\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                    <mat-label>{{'viewusers.usernm' | translate}}</mat-label>\r\n                                    <input matInput readonly=\"true\" formControlName=\"username\" value=\"saleh\">\r\n                                </mat-form-field>\r\n                            </div>\r\n                            <div fxFlex.gt-sm=\"50\" fxFlex=\"100\" ngClass.xs=\"p-l-0\" ngClass.sm=\"p-l-0\"\r\n                            ngClass.md=\"p-l-30\" ngClass.lg=\"p-l-30\" ngClass.xl=\"p-l-30\" ngClass.sm=\"m-0\">\r\n                                <mat-form-field class=\"example-full-width mat-form-field-readonly\" appearance=\"outline\">\r\n                                    <mat-label>{{'viewusers.passw' | translate}}</mat-label>\r\n                                    <input matInput readonly=\"true\" formControlName=\"passwrd\" value=\"opal@5678\">                                \r\n                                </mat-form-field>\r\n                            </div>\r\n                        </div>\r\n                    <div fxLayout=\"row wrap\" class=\"m-t-30\" fxLayoutAlign=\"end\">\r\n                        <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" fxLayoutAlign=\"flex-end center\">\r\n                            <button mat-raised-button type=\"button\" color=\"secondary\"\r\n                                class=\"filterbtn height-45\">{{'viewusers.clos' | translate}}</button>\r\n                        </div>\r\n                    </div>\r\n    \r\n                    </form>\r\n            </div>\r\n        </div>\r\n    </div>");

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

/***/ "./src/app/modules/newenterpriseadmin/addroles/addroles.component.scss":
/*!*****************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/addroles/addroles.component.scss ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#addroles .disabledsubmit {\n  background: #ececec !important;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n}\n#addroles .arabiclanguage input,\n#addroles .arabiclanguage .mat-form-field-label {\n  text-align: right;\n}\n#addroles .arabiclanguage .mat-form-field-label {\n  text-align: right;\n}\n#addroles .arabiclanguage .mat-error {\n  text-align: right;\n}\n#addroles .addrolesnew {\n  padding: 0 30px;\n  margin-bottom: 50px;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#addroles .addrolesnew .mat-form-field-appearance-outline .mat-form-field-suffix .mat-icon {\n  color: #888;\n}\n#addroles .addrolesnew .aligncenter {\n  display: flex;\n  align-items: center;\n}\n#addroles .addrolesnew .aligncenter .mat-icon {\n  width: 16px;\n  height: 16px;\n  color: #666;\n  cursor: pointer;\n  font-size: 20px;\n  margin-top: 5px;\n}\n#addroles .addrolesnew .permissiontable {\n  width: 100%;\n  /* Hide the browser's default checkbox */\n  /* Create a custom checkbox */\n  /* On mouse-over, add a grey background color */\n  /* When the checkbox is checked, add a blue background */\n  /* When the checkbox is disabled, add a blue background */\n  /* Create the checkmark/indicator (hidden when not checked) */\n  /* Show the checkmark when checked */\n  /* Style the checkmark/indicator */\n}\n#addroles .addrolesnew .permissiontable table {\n  width: 100%;\n  box-shadow: none;\n}\n#addroles .addrolesnew .permissiontable tr.example-detail-row {\n  height: 0;\n}\n#addroles .addrolesnew .permissiontable tr.example-element-row:not(.example-expanded-row):hover {\n  background: whitesmoke;\n}\n#addroles .addrolesnew .permissiontable tr.example-element-row:not(.example-expanded-row):active {\n  background: #efefef;\n}\n#addroles .addrolesnew .permissiontable .example-element-row td {\n  border-bottom-width: 0;\n}\n#addroles .addrolesnew .permissiontable .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#addroles .addrolesnew .permissiontable .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#addroles .addrolesnew .permissiontable .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#addroles .addrolesnew .permissiontable .example-element-description {\n  padding: 16px;\n}\n#addroles .addrolesnew .permissiontable .example-element-description-attribution {\n  opacity: 0.5;\n}\n#addroles .addrolesnew .permissiontable table th {\n  background: #eaedf2;\n  font-size: 14px;\n  color: #333;\n  font-weight: 600;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#addroles .addrolesnew .permissiontable table th:first-child {\n  text-align: left;\n  min-width: 250px;\n}\n#addroles .addrolesnew .permissiontable table td {\n  position: relative;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#addroles .addrolesnew .permissiontable table td:first-child {\n  text-align: left;\n  min-width: 250px;\n  color: #0c4b9a;\n}\n#addroles .addrolesnew .permissiontable table td .expandicon {\n  position: absolute;\n  right: 20px;\n  top: 50%;\n  transform: translateY(-50%);\n}\n#addroles .addrolesnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n#addroles .addrolesnew .permissiontable table td .subtable tr th, #addroles .addrolesnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n#addroles .addrolesnew .permissiontable table td .subtable tr td {\n  position: relative;\n  text-align: center;\n  min-width: 72px;\n  max-width: 72px;\n}\n#addroles .addrolesnew .permissiontable table td .subtable tr td:first-child {\n  max-width: 240px;\n  min-width: 240px;\n  text-align: left;\n  color: #333333;\n}\n#addroles .addrolesnew .permissiontable .checkcontainer {\n  display: inline-block;\n  position: relative;\n  margin-bottom: 12px;\n  padding-left: 25px;\n  cursor: pointer;\n  font-size: 22px;\n  -webkit-user-select: none;\n  -moz-user-select: none;\n  user-select: none;\n}\n#addroles .addrolesnew .permissiontable .checkcontainer input {\n  position: absolute;\n  opacity: 0;\n  cursor: pointer;\n  height: 0;\n  width: 0;\n}\n#addroles .addrolesnew .permissiontable .checkmark {\n  position: absolute;\n  top: 0;\n  left: 0;\n  height: 16px;\n  width: 16px;\n  background-color: #fff;\n  border: 1px solid #bbb;\n}\n#addroles .addrolesnew .permissiontable .checkcontainer:hover input ~ .checkmark {\n  background-color: #ccc;\n}\n#addroles .addrolesnew .permissiontable .checkcontainer input:checked ~ .checkmark {\n  background-color: #0c4b9a;\n}\n#addroles .addrolesnew .permissiontable .checkcontainer input:disabled ~ .checkmark {\n  background-color: #ddd;\n  cursor: no-drop;\n}\n#addroles .addrolesnew .permissiontable .checkmark:after {\n  content: \"\";\n  position: absolute;\n  display: none;\n}\n#addroles .addrolesnew .permissiontable .checkcontainer input:checked ~ .checkmark:after {\n  display: block;\n}\n#addroles .addrolesnew .permissiontable .checkcontainer .checkmark:after {\n  left: 4px;\n  top: 1px;\n  width: 4px;\n  height: 7px;\n  border: solid white;\n  border-width: 0 2px 2px 0;\n  transform: rotate(45deg);\n}\n#addroles .addrolesnew .permissiontable .nopaddingtd {\n  padding: 0px !important;\n}\n#addroles .addrolesnew .addbtn, #addroles .addrolesnew .filterbtn {\n  min-width: 100px;\n}\n#addroles .addrolesnew .addbtn {\n  background: #ed1c27;\n  color: #fff;\n}\n@media (max-width: 768px) {\n  #addroles .addrolesnew .paddingspacing {\n    padding-right: 0px !important;\n    padding-left: 0px !important;\n  }\n  #addroles .addrolesnew .permissiontable {\n    overflow: auto;\n  }\n}\n[dir=rtl] #addroles .addrolesnew .permissiontable table th:first-child, .rtl #addroles .addrolesnew .permissiontable table th:first-child {\n  text-align: right;\n}\n[dir=rtl] #addroles .addrolesnew .permissiontable table td:first-child, .rtl #addroles .addrolesnew .permissiontable table td:first-child {\n  text-align: right;\n}\n[dir=rtl] #addroles .addrolesnew .permissiontable table td .expandicon, .rtl #addroles .addrolesnew .permissiontable table td .expandicon {\n  position: absolute;\n  left: 20px;\n  right: auto;\n  top: 50%;\n  transform: translateY(-50%);\n}\n[dir=rtl] #addroles .addrolesnew .permissiontable table td .expandicon .mat-icon, .rtl #addroles .addrolesnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n[dir=rtl] #addroles .addrolesnew .permissiontable table td .subtable tr th, [dir=rtl] #addroles .addrolesnew .permissiontable table td .subtable thead, .rtl #addroles .addrolesnew .permissiontable table td .subtable tr th, .rtl #addroles .addrolesnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n[dir=rtl] #addroles .addrolesnew .permissiontable table td .subtable tr td:first-child, .rtl #addroles .addrolesnew .permissiontable table td .subtable tr td:first-child {\n  text-align: right;\n}\n[dir=rtl] #addroles .addrolesnew .permissiontable .checkcontainer, .rtl #addroles .addrolesnew .permissiontable .checkcontainer {\n  padding-right: 25px;\n  padding-left: 0px;\n}\n.select_with_search {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 50px !important;\n  margin-bottom: 15px !important;\n}\n.select_with_option {\n  overflow: hidden !important;\n  max-height: 100% !important;\n  margin-top: 49px !important;\n  margin-bottom: 15px !important;\n}\n.searchinmultiselect {\n  display: flex;\n  align-items: center;\n  padding: 10px 10px;\n  background: #e9edf0;\n  margin: 10px;\n}\n.searchselect {\n  width: calc(100% - 25px) !important;\n  padding-left: 10px;\n}\n.mat-option.mat-active {\n  background: #fff;\n  color: rgba(0, 0, 0, 0.87);\n}\n.option-listing {\n  overflow-x: auto;\n  overflow-y: auto;\n  max-height: 290px;\n}\n.option-listing::-webkit-scrollbar {\n  width: 7px;\n}\n.numberandcode .mat-form-field-infix {\n  display: flex !important;\n}\n/* Track */\n.option-listing::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n/* Handle */\n.option-listing::-webkit-scrollbar-thumb {\n  background: #ED1C27;\n}\n/* hover */\n.option-listing::-webkit-scrollbar-thumb:hover {\n  background: #ED1C27;\n}\n.myPanelClass {\n  margin: 36px 0px;\n}\n#manageroles tr.mat-row,\n#manageroles tr.mat-footer-row {\n  height: auto !important;\n  border-bottom: 1px solid #ddd;\n}\n#manageroles tr.mat-row:last-child,\n#manageroles tr.mat-footer-row:last-child {\n  border-bottom: none !important;\n}\n#manageroles th.mat-header-cell,\n#manageroles td.mat-cell,\n#manageroles td.mat-footer-cell {\n  border-bottom-style: none !important;\n}\n#manageroles .example-element-row td {\n  border-bottom-width: 0;\n}\n#manageroles .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#manageroles .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#manageroles .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#manageroles .example-element-description {\n  padding: 16px;\n}\n#manageroles .example-element-description-attribution {\n  opacity: 0.5;\n}\n#manageroles .documentheader h4 {\n  color: #0c4b9a;\n}\n#manageroles .mat-paginator-page-size-label {\n  margin: 0px !important;\n}\n#manageroles .mat-paginator-container {\n  padding: 0px !important;\n}\n#manageroles .viewtextcolor {\n  color: #0c4b9a;\n}\n#manageroles .addbtn {\n  background: #ed1c27;\n  color: #fff;\n}\n#manageroles #searchrow,\n#manageroles #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#manageroles #searchrow .serachrow,\n#manageroles #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n  padding-top: 10px;\n}\n#manageroles .paginationwithfilter {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#manageroles .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#manageroles .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#manageroles .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#manageroles .showtextcolor {\n  color: #262626;\n}\n#manageroles .redTxt {\n  color: #626366;\n  cursor: pointer;\n}\n#manageroles .viewhaderpdf img {\n  width: 40px;\n}\n#manageroles .viewhaderpdf p {\n  color: #262626;\n}\n#manageroles .print, #manageroles .cancelled, #manageroles .requestedback, #manageroles .requestedaccess, #manageroles .assessment, #manageroles .qualitycheck, #manageroles .teaching, #manageroles .newtag {\n  color: #00a551;\n  font-size: 0.9375rem;\n}\n#manageroles .newtag {\n  color: #ed1c27 !important;\n}\n#manageroles .teaching {\n  color: #f4811f !important;\n}\n#manageroles .qualitycheck {\n  color: #0c4b9a !important;\n}\n#manageroles .flexaligntag {\n  display: flex;\n  align-items: center;\n}\n#manageroles .assessment {\n  color: #C330CE;\n}\n#manageroles .requestedaccess {\n  color: #109d98;\n}\n#manageroles .requestedaccess {\n  color: #109d98;\n}\n#manageroles .requestedback {\n  color: #b14428;\n}\n#manageroles .cancelled {\n  color: #ed1c27;\n}\n#manageroles .update {\n  color: #0c4b9a;\n}\n#manageroles .declined {\n  color: #ed1c27;\n}\n#manageroles .new {\n  color: #f4811f;\n}\n#manageroles .approcedtagalign {\n  display: flex;\n  align-items: center;\n}\n#manageroles .approcedtagalign img {\n  padding-left: 15px;\n}\n#manageroles .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#manageroles .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#manageroles .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#manageroles .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#manageroles .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#manageroles .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: #d9d9d9 !important;\n}\n#manageroles .mat-sort-header-arrow {\n  color: #ED1C27;\n}\n#manageroles .nofound {\n  margin-top: 5%;\n}\n#manageroles .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#manageroles .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#manageroles .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#manageroles .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#manageroles .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#manageroles .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#manageroles .awaredtable .mat-cell {\n  color: #262626;\n}\n#manageroles .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#manageroles .statustags {\n  background-color: #0c4b9a;\n  color: #fff;\n  border-radius: 2px;\n  padding: 3px 6px;\n}\n#manageroles .cancelbtn {\n  min-width: 110px;\n  background-color: #fff;\n  color: #333;\n  border: 1px solid #c4c4c4;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  box-shadow: none;\n}\n#manageroles .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 110px;\n  height: 45px;\n  box-shadow: none;\n}\n#manageroles .declinecmd {\n  border: 1px solid #ED1C27;\n  border-radius: 3px;\n  padding: 15px 15px 10px 15px;\n  background-color: #fff8f8;\n  height: auto;\n  width: 100%;\n}\n#manageroles .declinecmd .comment {\n  color: #ED1C27 !important;\n}\n#manageroles .declinecmd p {\n  color: #262626;\n}\n.actionmatmenu {\n  background: #666;\n  border-radius: 0px;\n  min-width: 100px;\n}\n.actionmatmenu .mat-menu-content button.mat-menu-item {\n  height: 28px;\n  color: #fff;\n  line-height: 28px;\n}\n@media (max-width: 768px) {\n  #manageroles .masterPageTop {\n    display: block !important;\n    justify-content: flex-start !important;\n  }\n  #manageroles .masterPageTop .mat-paginator-page-size-label {\n    margin: 0px !important;\n  }\n  #manageroles .masterPageTop .mat-paginator-container {\n    padding: 0px !important;\n    justify-content: flex-start !important;\n  }\n}\n@media (max-width: 767px) {\n  #manageroles .footerpaginator .mat-paginator-container {\n    display: block !important;\n  }\n  #manageroles .footerpaginator .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n#manageusers tr.mat-row,\n#manageusers tr.mat-footer-row {\n  height: auto !important;\n  border-bottom: 1px solid #ddd;\n}\n#manageusers tr.mat-row:last-child,\n#manageusers tr.mat-footer-row:last-child {\n  border-bottom: none !important;\n}\n#manageusers th.mat-header-cell,\n#manageusers td.mat-cell,\n#manageusers td.mat-footer-cell {\n  border-bottom-style: none !important;\n}\n#manageusers .example-element-row td {\n  border-bottom-width: 0;\n}\n#manageusers .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#manageusers .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#manageusers .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#manageusers .example-element-description {\n  padding: 16px;\n}\n#manageusers .example-element-description-attribution {\n  opacity: 0.5;\n}\n#manageusers .mat-paginator-page-size-label {\n  margin: 0px !important;\n}\n#manageusers .mat-paginator-container {\n  padding: 0px !important;\n}\n#manageusers .addbtn {\n  background: #ed1c27;\n  color: #fff;\n}\n#manageusers #searchrow,\n#manageusers #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#manageusers #searchrow .serachrow,\n#manageusers #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n  padding-top: 10px;\n}\n#manageusers .paginationwithfilter {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#manageusers .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#manageusers .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#manageusers .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#manageusers .autofectlist .mat-form-field-outline {\n  background-color: #f8f8f8 !important;\n  cursor: no-drop !important;\n}\n#manageusers .autofectlist input[readonly] {\n  cursor: no-drop !important;\n}\n#manageusers .print, #manageusers #manageroles .newtag, #manageroles #manageusers .newtag, #manageusers #manageroles .teaching, #manageroles #manageusers .teaching, #manageusers #manageroles .qualitycheck, #manageroles #manageusers .qualitycheck, #manageusers #manageroles .assessment, #manageroles #manageusers .assessment, #manageusers #manageroles .requestedaccess, #manageroles #manageusers .requestedaccess, #manageusers #manageroles .requestedback, #manageroles #manageusers .requestedback, #manageusers #manageroles .cancelled, #manageroles #manageusers .cancelled {\n  color: #00a551;\n  font-size: 0.9375rem;\n}\n#manageusers .flexaligntag {\n  display: flex;\n  align-items: center;\n}\n#manageusers .update {\n  color: #0c4b9a;\n}\n#manageusers .declined {\n  color: #ed1c27;\n}\n#manageusers .pending {\n  color: #F4811F;\n}\n#manageusers .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#manageusers .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#manageusers .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#manageusers .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#manageusers .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#manageusers .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: #d9d9d9 !important;\n}\n#manageusers .mat-sort-header-arrow {\n  color: #ED1C27;\n}\n#manageusers .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#manageusers .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#manageusers .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#manageusers .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#manageusers .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#manageusers .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#manageusers .awaredtable .mat-cell {\n  color: #262626;\n}\n#manageusers .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n.actionmatmenu {\n  background: #666;\n  border-radius: 0px;\n  min-width: 100px;\n}\n.actionmatmenu .mat-menu-content button.mat-menu-item {\n  height: 28px;\n  color: #fff;\n  line-height: 28px;\n}\n@media (max-width: 768px) {\n  #manageusers .masterPageTop {\n    display: block !important;\n    justify-content: flex-start !important;\n  }\n  #manageusers .masterPageTop .mat-paginator-page-size-label {\n    margin: 0px !important;\n  }\n  #manageusers .masterPageTop .mat-paginator-container {\n    padding: 0px !important;\n    justify-content: flex-start !important;\n  }\n}\n@media (max-width: 767px) {\n  #manageusers .footerpaginator .mat-paginator-container {\n    display: block !important;\n  }\n  #manageusers .footerpaginator .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n.onlyviewallocate .cursor_part {\n  cursor: no-drop;\n}\n.onlyviewallocate .cursor_part .innerpermission {\n  pointer-events: none;\n  opacity: 0.5;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vYWRkcm9sZXMvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcbmV3ZW50ZXJwcmlzZWFkbWluXFxhZGRyb2xlc1xcYWRkcm9sZXMuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL2FkZHJvbGVzL2FkZHJvbGVzLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUNFO0VBQ0UsOEJBQUE7RUFDQSxvQ0FBQTtFQUNBLHNCQUFBO0FDQUo7QURJSTs7RUFFSSxpQkFBQTtBQ0ZSO0FES0k7RUFDSSxpQkFBQTtBQ0hSO0FETUk7RUFDSSxpQkFBQTtBQ0pSO0FET0k7RUFDSSxlQUFBO0VBQ0EsbUJBQUE7QUNMUjtBRE9ZO0VBQ0ksY0FBQTtBQ0xoQjtBRFFZO0VBQ0ksMEJBQUE7QUNOaEI7QURTWTtFQUNJLDBCQUFBO0FDUGhCO0FEVVk7RUFDSSxjQUFBO0FDUmhCO0FEV1k7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNUaEI7QURhZ0I7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNYcEI7QURnQndCO0VBQ0ksY0FBQTtBQ2Q1QjtBRHFCZ0I7RUFDSSx5QkFBQTtBQ25CcEI7QUR5QmdCO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDdkJwQjtBRDZCb0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUMzQnhCO0FENkJ3QjtFQUNJLGNBQUE7QUMzQjVCO0FEK0JvQjtFQUNJLHFCQUFBO0FDN0J4QjtBRGtDZ0I7RUFDSSxXQUFBO0FDaENwQjtBRG9DUTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ2xDWjtBRG1DWTtFQUNJLFdBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0VBQ0EsZUFBQTtBQ2pDaEI7QURxQ1E7RUFDSSxXQUFBO0VBbUhFLHdDQUFBO0VBU0EsNkJBQUE7RUFXQSwrQ0FBQTtFQUtBLHdEQUFBO0VBSUEseURBQUE7RUFNQSw2REFBQTtFQU9BLG9DQUFBO0VBS0Esa0NBQUE7QUM3TGQ7QUQ0Qlk7RUFDSSxXQUFBO0VBQ0EsZ0JBQUE7QUMxQmhCO0FENkJjO0VBQ0UsU0FBQTtBQzNCaEI7QUQ4QmM7RUFDRSxzQkFBQTtBQzVCaEI7QUQrQmM7RUFDRSxtQkFBQTtBQzdCaEI7QURnQ2M7RUFDRSxzQkFBQTtBQzlCaEI7QURpQ2M7RUFDRSxnQkFBQTtFQUNBLGFBQUE7QUMvQmhCO0FEa0NjO0VBQ0UsZUFBQTtFQUNBLHVCQUFBO0VBQ0EsWUFBQTtFQUNBLG9CQUFBO0VBQ0EsYUFBQTtFQUNBLGFBQUE7QUNoQ2hCO0FEbUNjO0VBQ0UsaUJBQUE7RUFDQSxlQUFBO0VBQ0EsbUJBQUE7QUNqQ2hCO0FEb0NjO0VBQ0UsYUFBQTtBQ2xDaEI7QURxQ2M7RUFDRSxZQUFBO0FDbkNoQjtBRHFDYztFQUNJLG1CQUFBO0VBQ0EsZUFBQTtFQUNBLFdBQUE7RUFDQSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNFLGVBQUE7QUNuQ3BCO0FEb0NrQjtFQUNFLGdCQUFBO0VBQ0EsZ0JBQUE7QUNsQ3BCO0FEcUNjO0VBQ0ksa0JBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0FDbkNsQjtBRG9Da0I7RUFDRSxnQkFBQTtFQUNBLGdCQUFBO0VBQ0EsY0FBQTtBQ2xDcEI7QURvQ2tCO0VBQ0ksa0JBQUE7RUFDQSxXQUFBO0VBQ0EsUUFBQTtFQUNBLDJCQUFBO0FDbEN0QjtBRG1Dc0I7RUFDSSxXQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSxlQUFBO0FDakMxQjtBRHFDb0I7RUFDSSx3QkFBQTtBQ25DeEI7QURxQ29CO0VBQ0ksa0JBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0FDbkN4QjtBRG9Dd0I7RUFDRSxnQkFBQTtFQUNBLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxjQUFBO0FDbEMxQjtBRHVDYztFQUNFLHFCQUFBO0VBQ0Esa0JBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7RUFDQSx5QkFBQTtFQUNBLHNCQUFBO0VBRUEsaUJBQUE7QUNyQ2hCO0FEeUNjO0VBQ0Usa0JBQUE7RUFDQSxVQUFBO0VBQ0EsZUFBQTtFQUNBLFNBQUE7RUFDQSxRQUFBO0FDdkNoQjtBRDJDYztFQUNFLGtCQUFBO0VBQ0EsTUFBQTtFQUNBLE9BQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLHNCQUFBO0VBQ0Esc0JBQUE7QUN6Q2hCO0FENkNjO0VBQ0Usc0JBQUE7QUMzQ2hCO0FEK0NjO0VBQ0UseUJBQUE7QUM3Q2hCO0FEZ0RjO0VBQ0Usc0JBQUE7RUFDQSxlQUFBO0FDOUNoQjtBRGtEYztFQUNFLFdBQUE7RUFDQSxrQkFBQTtFQUNBLGFBQUE7QUNoRGhCO0FEb0RjO0VBQ0UsY0FBQTtBQ2xEaEI7QURzRGM7RUFDRSxTQUFBO0VBQ0EsUUFBQTtFQUNBLFVBQUE7RUFDQSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSx5QkFBQTtFQUdBLHdCQUFBO0FDcERoQjtBRHNEYztFQUNJLHVCQUFBO0FDcERsQjtBRHlEUTtFQUNJLGdCQUFBO0FDdkRaO0FEeURRO0VBQ0ksbUJBQUE7RUFDQSxXQUFBO0FDdkRaO0FEMERRO0VBQ0k7SUFDSSw2QkFBQTtJQUNBLDRCQUFBO0VDeERkO0VEMERVO0lBQ0ksY0FBQTtFQ3hEZDtBQUNGO0FEaUVvQjtFQUNFLGlCQUFBO0FDOUR0QjtBRGtFb0I7RUFDRSxpQkFBQTtBQ2hFdEI7QURrRW9CO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsV0FBQTtFQUNBLFFBQUE7RUFDQSwyQkFBQTtBQ2hFeEI7QURpRXdCO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0EsZUFBQTtBQy9ENUI7QURtRXNCO0VBQ0ksd0JBQUE7QUNqRTFCO0FEb0UwQjtFQUNFLGlCQUFBO0FDbEU1QjtBRHVFZ0I7RUFDSSxtQkFBQTtFQUNBLGlCQUFBO0FDckVwQjtBRDhFQTtFQUNFLDJCQUFBO0VBQ0EsMkJBQUE7RUFDQSwyQkFBQTtFQUNBLDhCQUFBO0FDM0VGO0FEOEVBO0VBQ0UsMkJBQUE7RUFDQSwyQkFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7QUMzRUY7QUQ4RUE7RUFDRSxhQUFBO0VBQ0EsbUJBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0EsWUFBQTtBQzNFRjtBRDhFQTtFQUNFLG1DQUFBO0VBQ0Esa0JBQUE7QUMzRUY7QUQrRUE7RUFDRSxnQkFBQTtFQUNBLDBCQUFBO0FDNUVGO0FEK0VBO0VBQ0UsZ0JBQUE7RUFDQSxnQkFBQTtFQUNBLGlCQUFBO0FDNUVGO0FEZ0ZBO0VBQ0UsVUFBQTtBQzdFRjtBRGdGRTtFQUNFLHdCQUFBO0FDN0VKO0FEZ0ZBLFVBQUE7QUFDQTtFQUNFLG1CQUFBO0FDN0VGO0FEZ0ZBLFdBQUE7QUFDQTtFQUNFLG1CQUFBO0FDN0VGO0FEZ0ZBLFVBQUE7QUFDQTtFQUNFLG1CQUFBO0FDN0VGO0FEZ0ZBO0VBQ0UsZ0JBQUE7QUM3RUY7QURrRkU7O0VBRUksdUJBQUE7RUFDQSw2QkFBQTtBQy9FTjtBRGlGTTs7RUFDSSw4QkFBQTtBQzlFVjtBRGtGRTs7O0VBR0ksb0NBQUE7QUNoRk47QURvRkU7RUFDSSxzQkFBQTtBQ2xGTjtBRHFGRTtFQUNJLGdCQUFBO0VBQ0EsYUFBQTtBQ25GTjtBRHNGRTtFQUNJLGVBQUE7RUFDQSx1QkFBQTtFQUNBLFlBQUE7RUFDQSxvQkFBQTtFQUNBLGFBQUE7RUFDQSxhQUFBO0FDcEZOO0FEdUZFO0VBQ0ksaUJBQUE7RUFDQSxlQUFBO0VBQ0EsbUJBQUE7QUNyRk47QUR3RkU7RUFDSSxhQUFBO0FDdEZOO0FEeUZFO0VBQ0ksWUFBQTtBQ3ZGTjtBRDJGTTtFQUNJLGNBQUE7QUN6RlY7QUQ2RkU7RUFDSSxzQkFBQTtBQzNGTjtBRDhGRTtFQUNJLHVCQUFBO0FDNUZOO0FEK0ZFO0VBQ0ksY0FBQTtBQzdGTjtBRCtGRTtFQUNJLG1CQUFBO0VBQ0EsV0FBQTtBQzdGTjtBRCtGRTs7RUFFSSwyQkFBQTtFQUNBLFlBQUE7QUM3Rk47QUQrRk07O0VBQ0ksMkJBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7QUM1RlY7QURnR0U7RUFDSSxhQUFBO0VBQ0EsOEJBQUE7RUFDQSxtQkFBQTtBQzlGTjtBRG1HVTtFQUNJLHlCQUFBO0VBQ0EsY0FBQTtBQ2pHZDtBRG1HYztFQUNJLHlCQUFBO0FDakdsQjtBRHlHTTtFQUNJLGFBQUE7QUN2R1Y7QUQyR0U7RUFDSSxjQUFBO0FDekdOO0FENEdFO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QUMxR047QUQ4R007RUFDSSxXQUFBO0FDNUdWO0FEK0dNO0VBQ0ksY0FBQTtBQzdHVjtBRGlIRTtFQUNJLGNBQUE7RUFDQSxvQkFBQTtBQy9HTjtBRGtIRTtFQUVJLHlCQUFBO0FDakhOO0FEb0hFO0VBRUkseUJBQUE7QUNuSE47QURzSEU7RUFFSSx5QkFBQTtBQ3JITjtBRHdIRTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ3RITjtBRHlIRTtFQUVJLGNBQUE7QUN4SE47QUQySEU7RUFFSSxjQUFBO0FDMUhOO0FENkhFO0VBRUksY0FBQTtBQzVITjtBRCtIRTtFQUVJLGNBQUE7QUM5SE47QURpSUU7RUFFSSxjQUFBO0FDaElOO0FEbUlFO0VBQ0ksY0FBQTtBQ2pJTjtBRG9JRTtFQUNJLGNBQUE7QUNsSU47QURxSUU7RUFDSSxjQUFBO0FDbklOO0FEc0lFO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDcElOO0FEc0lNO0VBQ0ksa0JBQUE7QUNwSVY7QUR3SUU7RUFDSSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxjQUFBO0VBQ0EsZ0JBQUE7RUFDQSxzQkFBQTtFQUNBLHVCQUFBO0FDdElOO0FEd0lNO0VBQ0ksVUFBQTtFQUNBLFdBQUE7QUN0SVY7QUR5SU07RUFDSSxtQkFBQTtBQ3ZJVjtBRDBJTTtFQUNJLGdCQUFBO0VBQ0Esa0JBQUE7QUN4SVY7QUQySU07RUFDSSxnQkFBQTtBQ3pJVjtBRDhJTTtFQUNJLG9DQUFBO0FDNUlWO0FEZ0pFO0VBQ0ksY0FBQTtBQzlJTjtBRGlKRTtFQUNJLGNBQUE7QUMvSU47QURtSk07RUFDSSxXQUFBO0VBQ0EsZUFBQTtBQ2pKVjtBRG9KTTtFQUNJLGNBQUE7RUFDQSxlQUFBO0FDbEpWO0FEcUpNO0VBQ0ksV0FBQTtFQUNBLGVBQUE7RUFDQSwyQkFBQTtBQ25KVjtBRHVKRTtFQUNJLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0FDckpOO0FEdUpNO0VBQ0ksbUJBQUE7QUNySlY7QUR3Sk07RUFDSSxvQ0FBQTtBQ3RKVjtBRDBKTTtFQUNJLGNBQUE7QUN4SlY7QUQySk07RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBQ3pKVjtBRDZKRTtFQUNJLHlCQUFBO0VBQ0EsV0FBQTtFQUNBLGtCQUFBO0VBQ0EsZ0JBQUE7QUMzSk47QUQ4SkU7RUFDSSxnQkFBQTtFQUNBLHNCQUFBO0VBQ0EsV0FBQTtFQUNBLHlCQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQzVKTjtBRCtKRTtFQUNJLG9DQUFBO0VBQ0Esc0JBQUE7RUFDQSxnQkFBQTtFQUNBLFlBQUE7RUFDQSxnQkFBQTtBQzdKTjtBRCtKRTtFQUNJLHlCQUFBO0VBQ0Esa0JBQUE7RUFDQSw0QkFBQTtFQUNBLHlCQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7QUM3Sk47QUQrSk07RUFDSSx5QkFBQTtBQzdKVjtBRGdLTTtFQUNJLGNBQUE7QUM5SlY7QURtS0E7RUFDRSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZ0JBQUE7QUNoS0Y7QURrS007RUFDSSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGlCQUFBO0FDaEtWO0FEdUtBO0VBRU07SUFDSSx5QkFBQTtJQUNBLHNDQUFBO0VDcktSO0VEc0tRO0lBQ08sc0JBQUE7RUNwS2Y7RURzS1E7SUFDSyx1QkFBQTtJQUNBLHNDQUFBO0VDcEtiO0FBQ0Y7QUQwS0E7RUFHVTtJQUNJLHlCQUFBO0VDMUtaO0VENEtPO0lBQ0Msc0JBQUE7RUMxS1I7QUFDRjtBRGlMRTs7RUFFSSx1QkFBQTtFQUNBLDZCQUFBO0FDL0tOO0FEaUxNOztFQUNJLDhCQUFBO0FDOUtWO0FEaUxFOzs7RUFHSSxvQ0FBQTtBQy9LTjtBRGlMRTtFQUNJLHNCQUFBO0FDL0tOO0FEa0xFO0VBQ0ksZ0JBQUE7RUFDQSxhQUFBO0FDaExOO0FEbUxFO0VBQ0ksZUFBQTtFQUNBLHVCQUFBO0VBQ0EsWUFBQTtFQUNBLG9CQUFBO0VBQ0EsYUFBQTtFQUNBLGFBQUE7QUNqTE47QURvTEU7RUFDSSxpQkFBQTtFQUNBLGVBQUE7RUFDQSxtQkFBQTtBQ2xMTjtBRHFMRTtFQUNJLGFBQUE7QUNuTE47QURzTEU7RUFDSSxZQUFBO0FDcExOO0FEc0xFO0VBQ0ksc0JBQUE7QUNwTE47QUR1TEU7RUFDSSx1QkFBQTtBQ3JMTjtBRHdMRTtFQUNJLG1CQUFBO0VBQ0EsV0FBQTtBQ3RMTjtBRHlMRTs7RUFFSSwyQkFBQTtFQUNBLFlBQUE7QUN2TE47QUR5TE07O0VBQ0ksMkJBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7QUN0TFY7QUQwTEU7RUFDSSxhQUFBO0VBQ0EsOEJBQUE7RUFDQSxtQkFBQTtBQ3hMTjtBRDZMVTtFQUNJLHlCQUFBO0VBQ0EsY0FBQTtBQzNMZDtBRDZMYztFQUNJLHlCQUFBO0FDM0xsQjtBRG1NTTtFQUNJLGFBQUE7QUNqTVY7QURzTUk7RUFDSSxvQ0FBQTtFQUNBLDBCQUFBO0FDcE1SO0FEdU1JO0VBQ0ksMEJBQUE7QUNyTVI7QUQ0TUU7RUFDSSxjQUFBO0VBQ0Esb0JBQUE7QUMxTU47QUQ2TUU7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7QUMzTU47QUQ2TUU7RUFDSSxjQUFBO0FDM01OO0FEOE1FO0VBQ0ksY0FBQTtBQzVNTjtBRCtNRTtFQUNJLGNBQUE7QUM3TU47QURnTkU7RUFDSSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxjQUFBO0VBQ0EsZ0JBQUE7RUFDQSxzQkFBQTtFQUNBLHVCQUFBO0FDOU1OO0FEZ05NO0VBQ0ksVUFBQTtFQUNBLFdBQUE7QUM5TVY7QURpTk07RUFDSSxtQkFBQTtBQy9NVjtBRGtOTTtFQUNJLGdCQUFBO0VBQ0Esa0JBQUE7QUNoTlY7QURtTk07RUFDSSxnQkFBQTtBQ2pOVjtBRHNOTTtFQUNJLG9DQUFBO0FDcE5WO0FEd05FO0VBQ0ksY0FBQTtBQ3ROTjtBRDJOTTtFQUNJLFdBQUE7RUFDQSxlQUFBO0FDek5WO0FENE5NO0VBQ0ksY0FBQTtFQUNBLGVBQUE7QUMxTlY7QUQ2Tk07RUFDSSxXQUFBO0VBQ0EsZUFBQTtFQUNBLDJCQUFBO0FDM05WO0FEK05FO0VBQ0ksa0JBQUE7RUFDQSw0QkFBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7QUM3Tk47QUQrTk07RUFDSSxtQkFBQTtBQzdOVjtBRGdPTTtFQUNJLG9DQUFBO0FDOU5WO0FEa09NO0VBQ0ksY0FBQTtBQ2hPVjtBRG1PTTtFQUNJLHlCQUFBO0VBQ0EseUJBQUE7RUFDQSxlQUFBO0FDak9WO0FEeU9BO0VBQ0UsZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLGdCQUFBO0FDdE9GO0FEeU9NO0VBQ0ksWUFBQTtFQUNBLFdBQUE7RUFDQSxpQkFBQTtBQ3ZPVjtBRDZPQTtFQUVNO0lBQ0kseUJBQUE7SUFDQSxzQ0FBQTtFQzNPUjtFRDZPUTtJQUNJLHNCQUFBO0VDM09aO0VEOE9RO0lBQ0ksdUJBQUE7SUFDQSxzQ0FBQTtFQzVPWjtBQUNGO0FEa1BBO0VBR1U7SUFDSSx5QkFBQTtFQ2xQWjtFRHFQUTtJQUNJLHNCQUFBO0VDblBaO0FBQ0Y7QUQwUFE7RUFDQSxlQUFBO0FDeFBSO0FEeVBRO0VBQ0ksb0JBQUE7RUFDQSxZQUFBO0FDdlBaIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vYWRkcm9sZXMvYWRkcm9sZXMuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjYWRkcm9sZXN7XHJcbiAgLmRpc2FibGVkc3VibWl0e1xyXG4gICAgYmFja2dyb3VuZDogI2VjZWNlYyAhaW1wb3J0YW50O1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI2VjZWNlYyAhaW1wb3J0YW50O1xyXG4gICAgY29sb3I6ICM5OTkgIWltcG9ydGFudDtcclxuICB9XHJcbiAgLmFyYWJpY2xhbmd1YWdlIHtcclxuICAgIFxyXG4gICAgaW5wdXQsXHJcbiAgICAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xyXG4gICAgICAgIHRleHQtYWxpZ246IHJpZ2h0O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogcmlnaHQ7XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1lcnJvciB7XHJcbiAgICAgICAgdGV4dC1hbGlnbjogcmlnaHQ7XHJcbiAgICB9XHJcbn1cclxuICAgIC5hZGRyb2xlc25ld3tcclxuICAgICAgICBwYWRkaW5nOjAgMzBweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOjUwcHg7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1zdWZmaXh7XHJcbiAgICAgICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6Izg4ODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAuYWxpZ25jZW50ZXJ7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6ZmxleDtcclxuICAgICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgICAgICAgICAgLm1hdC1pY29ue1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDE2cHg7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDE2cHg7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzY2NjtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMjBweDtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDVweDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLnBlcm1pc3Npb250YWJsZXtcclxuICAgICAgICAgICAgd2lkdGg6MTAwJTtcclxuICAgICAgICAgICAgdGFibGUge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICBib3gtc2hhZG93Om5vbmU7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIHRyLmV4YW1wbGUtZGV0YWlsLXJvdyB7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDA7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIHRyLmV4YW1wbGUtZWxlbWVudC1yb3c6bm90KC5leGFtcGxlLWV4cGFuZGVkLXJvdyk6aG92ZXIge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogd2hpdGVzbW9rZTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgdHIuZXhhbXBsZS1lbGVtZW50LXJvdzpub3QoLmV4YW1wbGUtZXhwYW5kZWQtcm93KTphY3RpdmUge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2VmZWZlZjtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1yb3cgdGQge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLWJvdHRvbS13aWR0aDogMDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1kZXRhaWwge1xyXG4gICAgICAgICAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGlhZ3JhbSB7XHJcbiAgICAgICAgICAgICAgICBtaW4td2lkdGg6IDgwcHg7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6IDJweCBzb2xpZCBibGFjaztcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDhweDtcclxuICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiBsaWdodGVyO1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiA4cHggMDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMTA0cHg7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtc3ltYm9sIHtcclxuICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiA0MHB4O1xyXG4gICAgICAgICAgICAgICAgbGluZS1oZWlnaHQ6IG5vcm1hbDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbiB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiAxNnB4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uLWF0dHJpYnV0aW9uIHtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDAuNTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgdGFibGUgdGh7XHJcbiAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6I2VhZWRmMjtcclxuICAgICAgICAgICAgICAgICAgZm9udC1zaXplOjE0cHg7XHJcbiAgICAgICAgICAgICAgICAgIGNvbG9yOiMzMzM7XHJcbiAgICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OjYwMDtcclxuICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjpjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDo3NXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIG1heC13aWR0aDo3NXB4O1xyXG4gICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246bGVmdDtcclxuICAgICAgICAgICAgICAgICAgICBtaW4td2lkdGg6MjUwcHg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgdGFibGUgdGR7XHJcbiAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOnJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjc1cHg7XHJcbiAgICAgICAgICAgICAgICAgIG1heC13aWR0aDo3NXB4O1xyXG4gICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246bGVmdDtcclxuICAgICAgICAgICAgICAgICAgICBtaW4td2lkdGg6MjUwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6IzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAuZXhwYW5kaWNvbntcclxuICAgICAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOmFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgcmlnaHQ6MjBweDtcclxuICAgICAgICAgICAgICAgICAgICAgIHRvcDo1MCU7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06dHJhbnNsYXRlWSgtNTAlKTtcclxuICAgICAgICAgICAgICAgICAgICAgIC5tYXQtaWNvbntcclxuICAgICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDoxOHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDoxOHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiM2NjY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgY3Vyc29yOnBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgLnN1YnRhYmxle1xyXG4gICAgICAgICAgICAgICAgICAgIHRyIHRoLCB0aGVhZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB0ciB0ZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246cmVsYXRpdmU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246Y2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBtaW4td2lkdGg6NzJweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWF4LXdpZHRoOjcycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICY6Zmlyc3QtY2hpbGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAyNDBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBtaW4td2lkdGg6IDI0MHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246bGVmdDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjojMzMzMzMzO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXIge1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luLWJvdHRvbTogMTJweDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDoyNXB4O1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgZm9udC1zaXplOiAyMnB4O1xyXG4gICAgICAgICAgICAgICAgLXdlYmtpdC11c2VyLXNlbGVjdDogbm9uZTtcclxuICAgICAgICAgICAgICAgIC1tb3otdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICAtbXMtdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICB1c2VyLXNlbGVjdDogbm9uZTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogSGlkZSB0aGUgYnJvd3NlcidzIGRlZmF1bHQgY2hlY2tib3ggKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXIgaW5wdXQge1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgb3BhY2l0eTogMDtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogMDtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAwO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAvKiBDcmVhdGUgYSBjdXN0b20gY2hlY2tib3ggKi9cclxuICAgICAgICAgICAgICAuY2hlY2ttYXJrIHtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgIHRvcDogMDtcclxuICAgICAgICAgICAgICAgIGxlZnQ6IDA7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDE2cHg7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMTZweDtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICBib3JkZXI6MXB4IHNvbGlkICNiYmI7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIE9uIG1vdXNlLW92ZXIsIGFkZCBhIGdyZXkgYmFja2dyb3VuZCBjb2xvciAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lcjpob3ZlciBpbnB1dCB+IC5jaGVja21hcmsge1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2NjYztcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogV2hlbiB0aGUgY2hlY2tib3ggaXMgY2hlY2tlZCwgYWRkIGEgYmx1ZSBiYWNrZ3JvdW5kICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0OmNoZWNrZWQgfiAuY2hlY2ttYXJrIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIC8qIFdoZW4gdGhlIGNoZWNrYm94IGlzIGRpc2FibGVkLCBhZGQgYSBibHVlIGJhY2tncm91bmQgKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXIgaW5wdXQ6ZGlzYWJsZWQgfiAuY2hlY2ttYXJrIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNkZGQ7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6bm8tZHJvcDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogQ3JlYXRlIHRoZSBjaGVja21hcmsvaW5kaWNhdG9yIChoaWRkZW4gd2hlbiBub3QgY2hlY2tlZCkgKi9cclxuICAgICAgICAgICAgICAuY2hlY2ttYXJrOmFmdGVyIHtcclxuICAgICAgICAgICAgICAgIGNvbnRlbnQ6IFwiXCI7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAvKiBTaG93IHRoZSBjaGVja21hcmsgd2hlbiBjaGVja2VkICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0OmNoZWNrZWQgfiAuY2hlY2ttYXJrOmFmdGVyIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAvKiBTdHlsZSB0aGUgY2hlY2ttYXJrL2luZGljYXRvciAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciAuY2hlY2ttYXJrOmFmdGVyIHtcclxuICAgICAgICAgICAgICAgIGxlZnQ6IDRweDtcclxuICAgICAgICAgICAgICAgIHRvcDogMXB4O1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDRweDtcclxuICAgICAgICAgICAgICAgIGhlaWdodDogN3B4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiBzb2xpZCB3aGl0ZTtcclxuICAgICAgICAgICAgICAgIGJvcmRlci13aWR0aDogMCAycHggMnB4IDA7XHJcbiAgICAgICAgICAgICAgICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKDQ1ZGVnKTtcclxuICAgICAgICAgICAgICAgIC1tcy10cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XHJcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIC5ub3BhZGRpbmd0ZHtcclxuICAgICAgICAgICAgICAgICAgcGFkZGluZzowcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAuYWRkYnRuLCAuZmlsdGVyYnRue1xyXG4gICAgICAgICAgICBtaW4td2lkdGg6MTAwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5hZGRidG57XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6I2VkMWMyNztcclxuICAgICAgICAgICAgY29sb3I6I2ZmZjtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIEBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkgeyAgICBcclxuICAgICAgICAgICAgLnBhZGRpbmdzcGFjaW5nIHtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAucGVybWlzc2lvbnRhYmxle1xyXG4gICAgICAgICAgICAgICAgb3ZlcmZsb3c6YXV0bztcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5bZGlyPVwicnRsXCJdLCAucnRse1xyXG4gICAgI2FkZHJvbGVze1xyXG4gICAgICAgIC5hZGRyb2xlc25ld3tcclxuICAgICAgICAgICAgLnBlcm1pc3Npb250YWJsZXtcclxuICAgICAgICAgICAgICAgIHRhYmxlIHRoe1xyXG4gICAgICAgICAgICAgICAgICAgICY6Zmlyc3QtY2hpbGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOnJpZ2h0O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIHRhYmxlIHRke1xyXG4gICAgICAgICAgICAgICAgICAgICY6Zmlyc3QtY2hpbGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOnJpZ2h0O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAuZXhwYW5kaWNvbntcclxuICAgICAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246YWJzb2x1dGU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGxlZnQ6MjBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcmlnaHQ6YXV0bztcclxuICAgICAgICAgICAgICAgICAgICAgICAgdG9wOjUwJTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOnRyYW5zbGF0ZVkoLTUwJSk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtaWNvbntcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOjE4cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiM2NjY7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjdXJzb3I6cG9pbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAuc3VidGFibGV7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0ciB0aCwgdGhlYWR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgdHIgdGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246cmlnaHQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6MjVweDtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6MHB4O1xyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0gXHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5cclxuXHJcbi5zZWxlY3Rfd2l0aF9zZWFyY2gge1xyXG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcclxuICBtYXgtaGVpZ2h0OiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgbWFyZ2luLXRvcDogNTBweCAhaW1wb3J0YW50O1xyXG4gIG1hcmdpbi1ib3R0b206IDE1cHggIWltcG9ydGFudDtcclxufVxyXG5cclxuLnNlbGVjdF93aXRoX29wdGlvbiB7XHJcbiAgb3ZlcmZsb3c6IGhpZGRlbiAhaW1wb3J0YW50O1xyXG4gIG1heC1oZWlnaHQ6IDEwMCUgIWltcG9ydGFudDtcclxuICBtYXJnaW4tdG9wOiA0OXB4ICFpbXBvcnRhbnQ7XHJcbiAgbWFyZ2luLWJvdHRvbTogMTVweCAhaW1wb3J0YW50O1xyXG59XHJcblxyXG4uc2VhcmNoaW5tdWx0aXNlbGVjdCB7XHJcbiAgZGlzcGxheTogZmxleDtcclxuICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gIHBhZGRpbmc6IDEwcHggMTBweDtcclxuICBiYWNrZ3JvdW5kOiAjZTllZGYwO1xyXG4gIG1hcmdpbjogMTBweDtcclxufVxyXG5cclxuLnNlYXJjaHNlbGVjdCB7XHJcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDI1cHgpICFpbXBvcnRhbnQ7XHJcbiAgcGFkZGluZy1sZWZ0OiAxMHB4O1xyXG5cclxufVxyXG5cclxuLm1hdC1vcHRpb24ubWF0LWFjdGl2ZSB7XHJcbiAgYmFja2dyb3VuZDogI2ZmZjtcclxuICBjb2xvcjogcmdiYSgwLCAwLCAwLCAwLjg3KTtcclxufVxyXG5cclxuLm9wdGlvbi1saXN0aW5nIHtcclxuICBvdmVyZmxvdy14OiBhdXRvO1xyXG4gIG92ZXJmbG93LXk6IGF1dG87XHJcbiAgbWF4LWhlaWdodDogMjkwcHg7XHJcblxyXG59XHJcblxyXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcclxuICB3aWR0aDogN3B4O1xyXG59XHJcbi5udW1iZXJhbmRjb2RlIHtcclxuICAubWF0LWZvcm0tZmllbGQtaW5maXgge1xyXG4gICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gIH1cclxufVxyXG4vKiBUcmFjayAqL1xyXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcclxuICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG59XHJcblxyXG4vKiBIYW5kbGUgKi9cclxuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgYmFja2dyb3VuZDogI0VEMUMyNztcclxufVxyXG5cclxuLyogaG92ZXIgKi9cclxuLm9wdGlvbi1saXN0aW5nOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgYmFja2dyb3VuZDogI0VEMUMyNztcclxufVxyXG5cclxuLm15UGFuZWxDbGFzcyB7XHJcbiAgbWFyZ2luOiAzNnB4IDBweDtcclxufVxyXG5cclxuI21hbmFnZXJvbGVzIHtcclxuXHJcbiAgdHIubWF0LXJvdyxcclxuICB0ci5tYXQtZm9vdGVyLXJvdyB7XHJcbiAgICAgIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcclxuXHJcbiAgICAgICY6bGFzdC1jaGlsZCB7XHJcbiAgICAgICAgICBib3JkZXItYm90dG9tOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgIH1cclxuICB9XHJcblxyXG4gIHRoLm1hdC1oZWFkZXItY2VsbCxcclxuICB0ZC5tYXQtY2VsbCxcclxuICB0ZC5tYXQtZm9vdGVyLWNlbGwge1xyXG4gICAgICBib3JkZXItYm90dG9tLXN0eWxlOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG5cclxuXHJcbiAgLmV4YW1wbGUtZWxlbWVudC1yb3cgdGQge1xyXG4gICAgICBib3JkZXItYm90dG9tLXdpZHRoOiAwO1xyXG4gIH1cclxuXHJcbiAgLmV4YW1wbGUtZWxlbWVudC1kZXRhaWwge1xyXG4gICAgICBvdmVyZmxvdzogaGlkZGVuO1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gIH1cclxuXHJcbiAgLmV4YW1wbGUtZWxlbWVudC1kaWFncmFtIHtcclxuICAgICAgbWluLXdpZHRoOiA4MHB4O1xyXG4gICAgICBib3JkZXI6IDJweCBzb2xpZCBibGFjaztcclxuICAgICAgcGFkZGluZzogOHB4O1xyXG4gICAgICBmb250LXdlaWdodDogbGlnaHRlcjtcclxuICAgICAgbWFyZ2luOiA4cHggMDtcclxuICAgICAgaGVpZ2h0OiAxMDRweDtcclxuICB9XHJcblxyXG4gIC5leGFtcGxlLWVsZW1lbnQtc3ltYm9sIHtcclxuICAgICAgZm9udC13ZWlnaHQ6IGJvbGQ7XHJcbiAgICAgIGZvbnQtc2l6ZTogNDBweDtcclxuICAgICAgbGluZS1oZWlnaHQ6IG5vcm1hbDtcclxuICB9XHJcblxyXG4gIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xyXG4gICAgICBwYWRkaW5nOiAxNnB4O1xyXG4gIH1cclxuXHJcbiAgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XHJcbiAgICAgIG9wYWNpdHk6IDAuNTtcclxuICB9XHJcblxyXG4gIC5kb2N1bWVudGhlYWRlciB7XHJcbiAgICAgIGg0IHtcclxuICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xyXG4gICAgICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xyXG4gIH1cclxuXHJcbiAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG5cclxuICAudmlld3RleHRjb2xvciB7XHJcbiAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gIH1cclxuICAuYWRkYnRue1xyXG4gICAgICBiYWNrZ3JvdW5kOiNlZDFjMjc7XHJcbiAgICAgIGNvbG9yOiNmZmY7XHJcbiAgfVxyXG4gICNzZWFyY2hyb3csXHJcbiAgI2ZpbHRlcnNob3cge1xyXG4gICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgIGJvcmRlcjogbm9uZTtcclxuXHJcbiAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweDtcclxuICAgICAgICAgIHBhZGRpbmctdG9wOiAxMHB4O1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgfVxyXG5cclxuICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIHtcclxuICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xyXG4gICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcbiAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcblxyXG4gICAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuXHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgIH1cclxuICB9XHJcblxyXG4gIC5zaG93dGV4dGNvbG9yIHtcclxuICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgfVxyXG5cclxuICAucmVkVHh0IHtcclxuICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICB9XHJcblxyXG4gIC52aWV3aGFkZXJwZGYge1xyXG4gICAgICBpbWcge1xyXG4gICAgICAgICAgd2lkdGg6IDQwcHg7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIHAge1xyXG4gICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgIH1cclxuICB9XHJcblxyXG4gIC5wcmludCB7XHJcbiAgICAgIGNvbG9yOiAjMDBhNTUxO1xyXG4gICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICB9XHJcblxyXG4gIC5uZXd0YWcge1xyXG4gICAgICBAZXh0ZW5kIC5wcmludDtcclxuICAgICAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcclxuICB9XHJcblxyXG4gIC50ZWFjaGluZyB7XHJcbiAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xyXG4gIH1cclxuXHJcbiAgLnF1YWxpdHljaGVjayB7XHJcbiAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICBjb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gIH1cclxuXHJcbiAgLmZsZXhhbGlnbnRhZyB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgfVxyXG5cclxuICAuYXNzZXNzbWVudCB7XHJcbiAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICBjb2xvcjogI0MzMzBDRTtcclxuICB9XHJcblxyXG4gIC5yZXF1ZXN0ZWRhY2Nlc3Mge1xyXG4gICAgICBAZXh0ZW5kIC5wcmludDtcclxuICAgICAgY29sb3I6ICMxMDlkOTg7XHJcbiAgfVxyXG5cclxuICAucmVxdWVzdGVkYWNjZXNzIHtcclxuICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgIGNvbG9yOiAjMTA5ZDk4O1xyXG4gIH1cclxuXHJcbiAgLnJlcXVlc3RlZGJhY2sge1xyXG4gICAgICBAZXh0ZW5kIC5wcmludDtcclxuICAgICAgY29sb3I6ICNiMTQ0Mjg7XHJcbiAgfVxyXG5cclxuICAuY2FuY2VsbGVkIHtcclxuICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgIGNvbG9yOiAjZWQxYzI3O1xyXG4gIH1cclxuXHJcbiAgLnVwZGF0ZSB7XHJcbiAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gIH1cclxuXHJcbiAgLmRlY2xpbmVkIHtcclxuICAgICAgY29sb3I6ICNlZDFjMjc7XHJcbiAgfVxyXG5cclxuICAubmV3IHtcclxuICAgICAgY29sb3I6ICNmNDgxMWY7XHJcbiAgfVxyXG5cclxuICAuYXBwcm9jZWR0YWdhbGlnbiB7XHJcbiAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcblxyXG4gICAgICBpbWcge1xyXG4gICAgICAgICAgcGFkZGluZy1sZWZ0OiAxNXB4O1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAuc2Nyb2xsZGF0YSB7XHJcbiAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgei1pbmRleDogMTtcclxuICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xyXG5cclxuICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgICAgICAgd2lkdGg6IDZweDtcclxuICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG4gICAgICB9XHJcblxyXG4gICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kge1xyXG4gICAgICAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcclxuICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNkOWQ5ZDkgIWltcG9ydGFudDtcclxuICAgICAgfVxyXG4gIH1cclxuXHJcbiAgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XHJcbiAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gIH1cclxuXHJcbiAgLm5vZm91bmQge1xyXG4gICAgICBtYXJnaW4tdG9wOiA1JTtcclxuICB9XHJcblxyXG4gIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XHJcbiAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLm1hdC1zZWxlY3QtdmFsdWUge1xyXG4gICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAuYXdhcmVkdGFibGUge1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgIG1hcmdpbjogMTBweCAwcHg7XHJcblxyXG4gICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAubWF0LXJvdzpob3ZlciB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICB9XHJcblxyXG4gICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgIH1cclxuICB9XHJcblxyXG4gIC5zdGF0dXN0YWdzIHtcclxuICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgcGFkZGluZzogM3B4IDZweDtcclxuICB9XHJcblxyXG4gIC5jYW5jZWxidG4ge1xyXG4gICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICBjb2xvcjogIzMzMztcclxuICAgICAgYm9yZGVyOiAxcHggc29saWQgI2M0YzRjNDtcclxuICAgICAgcGFkZGluZy1sZWZ0OiAwcHg7XHJcbiAgICAgIHBhZGRpbmctcmlnaHQ6IDBweDtcclxuICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICBib3gtc2hhZG93OiBub25lO1xyXG4gIH1cclxuXHJcbiAgLnN1Ym1pdF9idG4ge1xyXG4gICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3ICFpbXBvcnRhbnQ7XHJcbiAgICAgIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgIG1pbi13aWR0aDogMTEwcHg7XHJcbiAgICAgIGhlaWdodDogNDVweDtcclxuICAgICAgYm94LXNoYWRvdzogbm9uZTtcclxuICB9XHJcbiAgLmRlY2xpbmVjbWQge1xyXG4gICAgICBib3JkZXI6IDFweCBzb2xpZCAjRUQxQzI3O1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICAgIHBhZGRpbmc6IDE1cHggMTVweCAxMHB4IDE1cHg7XHJcbiAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY4Zjg7XHJcbiAgICAgIGhlaWdodDogYXV0bztcclxuICAgICAgd2lkdGg6IDEwMCU7XHJcblxyXG4gICAgICAuY29tbWVudCB7XHJcbiAgICAgICAgICBjb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcblxyXG4gICAgICBwIHtcclxuICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICB9XHJcbiAgfVxyXG59XHJcblxyXG4uYWN0aW9ubWF0bWVudXtcclxuICBiYWNrZ3JvdW5kOiAjNjY2O1xyXG4gIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICBtaW4td2lkdGg6IDEwMHB4O1xyXG4gIC5tYXQtbWVudS1jb250ZW50e1xyXG4gICAgICBidXR0b24ubWF0LW1lbnUtaXRlbXtcclxuICAgICAgICAgIGhlaWdodDoyOHB4O1xyXG4gICAgICAgICAgY29sb3I6I2ZmZjtcclxuICAgICAgICAgIGxpbmUtaGVpZ2h0OjI4cHg7XHJcbiAgICAgIH1cclxuICB9XHJcbn1cclxuXHJcblxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiAgI21hbmFnZXJvbGVze1xyXG4gICAgICAubWFzdGVyUGFnZVRvcHtcclxuICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcclxuICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbHtcclxuICAgICAgICAgICAgICAgICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgfVxyXG4gICAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVye1xyXG4gICAgICAgICAgICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgfVxyXG4gIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XHJcbiAgI21hbmFnZXJvbGVze1xyXG4gICAgICAuZm9vdGVycGFnaW5hdG9ye1xyXG4gICAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVye1xyXG4gICAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgIH1cclxuICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9uc3tcclxuICAgICAgICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgIH1cclxuICAgICAgIH1cclxuICB9XHJcbn1cclxuXHJcblxyXG4jbWFuYWdldXNlcnMge1xyXG4gIHRyLm1hdC1yb3csXHJcbiAgdHIubWF0LWZvb3Rlci1yb3cge1xyXG4gICAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkZGQ7XHJcblxyXG4gICAgICAmOmxhc3QtY2hpbGQge1xyXG4gICAgICAgICAgYm9yZGVyLWJvdHRvbTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgfVxyXG4gIHRoLm1hdC1oZWFkZXItY2VsbCxcclxuICB0ZC5tYXQtY2VsbCxcclxuICB0ZC5tYXQtZm9vdGVyLWNlbGwge1xyXG4gICAgICBib3JkZXItYm90dG9tLXN0eWxlOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG4gIC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcclxuICAgICAgYm9yZGVyLWJvdHRvbS13aWR0aDogMDtcclxuICB9XHJcblxyXG4gIC5leGFtcGxlLWVsZW1lbnQtZGV0YWlsIHtcclxuICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgICAgZGlzcGxheTogZmxleDtcclxuICB9XHJcblxyXG4gIC5leGFtcGxlLWVsZW1lbnQtZGlhZ3JhbSB7XHJcbiAgICAgIG1pbi13aWR0aDogODBweDtcclxuICAgICAgYm9yZGVyOiAycHggc29saWQgYmxhY2s7XHJcbiAgICAgIHBhZGRpbmc6IDhweDtcclxuICAgICAgZm9udC13ZWlnaHQ6IGxpZ2h0ZXI7XHJcbiAgICAgIG1hcmdpbjogOHB4IDA7XHJcbiAgICAgIGhlaWdodDogMTA0cHg7XHJcbiAgfVxyXG5cclxuICAuZXhhbXBsZS1lbGVtZW50LXN5bWJvbCB7XHJcbiAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICBmb250LXNpemU6IDQwcHg7XHJcbiAgICAgIGxpbmUtaGVpZ2h0OiBub3JtYWw7XHJcbiAgfVxyXG5cclxuICAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uIHtcclxuICAgICAgcGFkZGluZzogMTZweDtcclxuICB9XHJcblxyXG4gIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24tYXR0cmlidXRpb24ge1xyXG4gICAgICBvcGFjaXR5OiAwLjU7XHJcbiAgfVxyXG4gIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XHJcbiAgICAgIG1hcmdpbjogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgfVxyXG5cclxuICAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcclxuICB9XHJcblxyXG4gIC5hZGRidG4ge1xyXG4gICAgICBiYWNrZ3JvdW5kOiAjZWQxYzI3O1xyXG4gICAgICBjb2xvcjogI2ZmZjtcclxuICB9XHJcblxyXG4gICNzZWFyY2hyb3csXHJcbiAgI2ZpbHRlcnNob3cge1xyXG4gICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgIGJvcmRlcjogbm9uZTtcclxuXHJcbiAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgbWluLWhlaWdodDogNzNweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweDtcclxuICAgICAgICAgIHBhZGRpbmctdG9wOiAxMHB4O1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAucGFnaW5hdGlvbndpdGhmaWx0ZXIge1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgfVxyXG5cclxuICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIHtcclxuICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xyXG4gICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcbiAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcblxyXG4gICAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuXHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgIGRpc3BsYXk6IG5vbmU7XHJcbiAgICAgIH1cclxuICB9XHJcblxyXG4gIC5hdXRvZmVjdGxpc3R7XHJcbiAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmOCAhaW1wb3J0YW50O1xyXG4gICAgICAgIGN1cnNvcjogbm8tZHJvcCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIGlucHV0W3JlYWRvbmx5XSB7XHJcbiAgICAgICAgY3Vyc29yOiBuby1kcm9wICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgfVxyXG4gIH1cclxuICBcclxuXHJcblxyXG4gIC5wcmludCB7XHJcbiAgICAgIGNvbG9yOiAjMDBhNTUxO1xyXG4gICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICB9XHJcblxyXG4gIC5mbGV4YWxpZ250YWcge1xyXG4gICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gIH1cclxuICAudXBkYXRlIHtcclxuICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgfVxyXG5cclxuICAuZGVjbGluZWQge1xyXG4gICAgICBjb2xvcjogI2VkMWMyNztcclxuICB9XHJcblxyXG4gIC5wZW5kaW5nIHtcclxuICAgICAgY29sb3I6ICNGNDgxMUY7XHJcbiAgfVxyXG5cclxuICAuc2Nyb2xsZGF0YSB7XHJcbiAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgei1pbmRleDogMTtcclxuICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgIG92ZXJmbG93LXg6IGF1dG87XHJcbiAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xyXG5cclxuICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXIge1xyXG4gICAgICAgICAgd2lkdGg6IDZweDtcclxuICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG4gICAgICB9XHJcblxyXG4gICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kge1xyXG4gICAgICAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcclxuICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNkOWQ5ZDkgIWltcG9ydGFudDtcclxuICAgICAgfVxyXG4gIH1cclxuXHJcbiAgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XHJcbiAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gIH1cclxuXHJcblxyXG4gIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XHJcbiAgICAgICAgICBjb2xvcjogIzk5OTtcclxuICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgfVxyXG5cclxuICAgICAgLm1hdC1zZWxlY3QtdmFsdWUge1xyXG4gICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgIGNvbG9yOiAjOTk5O1xyXG4gICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgICAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICB9XHJcbiAgfVxyXG5cclxuICAuYXdhcmVkdGFibGUge1xyXG4gICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XHJcbiAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgIG1hcmdpbjogMTBweCAwcHg7XHJcblxyXG4gICAgICAubWFuYWdlb3B0aW9ucyB7XHJcbiAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICB9XHJcblxyXG4gICAgICAubWF0LXJvdzpob3ZlciB7XHJcbiAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICB9XHJcblxyXG4gICAgICAubWF0LWNlbGwge1xyXG4gICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgIH1cclxuXHJcbiAgICAgIC5tYXQtaGVhZGVyLWNlbGwge1xyXG4gICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XHJcbiAgICAgICAgICBmb250LXNpemU6IDE1cHg7XHJcbiAgICAgIH1cclxuICB9XHJcblxyXG5cclxuXHJcbn1cclxuXHJcbi5hY3Rpb25tYXRtZW51IHtcclxuICBiYWNrZ3JvdW5kOiAjNjY2O1xyXG4gIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICBtaW4td2lkdGg6IDEwMHB4O1xyXG5cclxuICAubWF0LW1lbnUtY29udGVudCB7XHJcbiAgICAgIGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcclxuICAgICAgICAgIGhlaWdodDogMjhweDtcclxuICAgICAgICAgIGNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgbGluZS1oZWlnaHQ6IDI4cHg7XHJcbiAgICAgIH1cclxuICB9XHJcbn1cclxuXHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAjbWFuYWdldXNlcnMge1xyXG4gICAgICAubWFzdGVyUGFnZVRvcCB7XHJcbiAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgICAgICAgICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgfVxyXG5cclxuICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICB9XHJcbiAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcclxuICAjbWFuYWdldXNlcnMge1xyXG4gICAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICAgICAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgfVxyXG59XHJcblxyXG5cclxuLm9ubHl2aWV3YWxsb2NhdGV7XHJcbiAgICAgICAgLmN1cnNvcl9wYXJ0e1xyXG4gICAgICAgIGN1cnNvcjogbm8tZHJvcDtcclxuICAgICAgICAuaW5uZXJwZXJtaXNzaW9ue1xyXG4gICAgICAgICAgICBwb2ludGVyLWV2ZW50czogbm9uZTtcclxuICAgICAgICAgICAgb3BhY2l0eTogMC41O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufSIsIiNhZGRyb2xlcyAuZGlzYWJsZWRzdWJtaXQge1xuICBiYWNrZ3JvdW5kOiAjZWNlY2VjICFpbXBvcnRhbnQ7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNlY2VjZWMgIWltcG9ydGFudDtcbiAgY29sb3I6ICM5OTkgIWltcG9ydGFudDtcbn1cbiNhZGRyb2xlcyAuYXJhYmljbGFuZ3VhZ2UgaW5wdXQsXG4jYWRkcm9sZXMgLmFyYWJpY2xhbmd1YWdlIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuI2FkZHJvbGVzIC5hcmFiaWNsYW5ndWFnZSAubWF0LWZvcm0tZmllbGQtbGFiZWwge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbiNhZGRyb2xlcyAuYXJhYmljbGFuZ3VhZ2UgLm1hdC1lcnJvciB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyB7XG4gIHBhZGRpbmc6IDAgMzBweDtcbiAgbWFyZ2luLWJvdHRvbTogNTBweDtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGNvbG9yOiAjZDlkOWQ5O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcbiAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcbiAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICM2YmE1ZWM7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvY3VzZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzBjNGI5YTtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZC5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWRpc2FibGVkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogI2RjNGM2NDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtMC45cmVtKSBzY2FsZSgwLjc1KTtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtbGFiZWwgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcbiAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1zdWZmaXggLm1hdC1pY29uIHtcbiAgY29sb3I6ICM4ODg7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5hbGlnbmNlbnRlciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5hbGlnbmNlbnRlciAubWF0LWljb24ge1xuICB3aWR0aDogMTZweDtcbiAgaGVpZ2h0OiAxNnB4O1xuICBjb2xvcjogIzY2NjtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBmb250LXNpemU6IDIwcHg7XG4gIG1hcmdpbi10b3A6IDVweDtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB7XG4gIHdpZHRoOiAxMDAlO1xuICAvKiBIaWRlIHRoZSBicm93c2VyJ3MgZGVmYXVsdCBjaGVja2JveCAqL1xuICAvKiBDcmVhdGUgYSBjdXN0b20gY2hlY2tib3ggKi9cbiAgLyogT24gbW91c2Utb3ZlciwgYWRkIGEgZ3JleSBiYWNrZ3JvdW5kIGNvbG9yICovXG4gIC8qIFdoZW4gdGhlIGNoZWNrYm94IGlzIGNoZWNrZWQsIGFkZCBhIGJsdWUgYmFja2dyb3VuZCAqL1xuICAvKiBXaGVuIHRoZSBjaGVja2JveCBpcyBkaXNhYmxlZCwgYWRkIGEgYmx1ZSBiYWNrZ3JvdW5kICovXG4gIC8qIENyZWF0ZSB0aGUgY2hlY2ttYXJrL2luZGljYXRvciAoaGlkZGVuIHdoZW4gbm90IGNoZWNrZWQpICovXG4gIC8qIFNob3cgdGhlIGNoZWNrbWFyayB3aGVuIGNoZWNrZWQgKi9cbiAgLyogU3R5bGUgdGhlIGNoZWNrbWFyay9pbmRpY2F0b3IgKi9cbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB7XG4gIHdpZHRoOiAxMDAlO1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRyLmV4YW1wbGUtZGV0YWlsLXJvdyB7XG4gIGhlaWdodDogMDtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0ci5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogd2hpdGVzbW9rZTtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0ci5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmFjdGl2ZSB7XG4gIGJhY2tncm91bmQ6ICNlZmVmZWY7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmV4YW1wbGUtZWxlbWVudC1yb3cgdGQge1xuICBib3JkZXItYm90dG9tLXdpZHRoOiAwO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5leGFtcGxlLWVsZW1lbnQtZGV0YWlsIHtcbiAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgZGlzcGxheTogZmxleDtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xuICBtaW4td2lkdGg6IDgwcHg7XG4gIGJvcmRlcjogMnB4IHNvbGlkIGJsYWNrO1xuICBwYWRkaW5nOiA4cHg7XG4gIGZvbnQtd2VpZ2h0OiBsaWdodGVyO1xuICBtYXJnaW46IDhweCAwO1xuICBoZWlnaHQ6IDEwNHB4O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5leGFtcGxlLWVsZW1lbnQtc3ltYm9sIHtcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XG4gIGZvbnQtc2l6ZTogNDBweDtcbiAgbGluZS1oZWlnaHQ6IG5vcm1hbDtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uIHtcbiAgcGFkZGluZzogMTZweDtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uLWF0dHJpYnV0aW9uIHtcbiAgb3BhY2l0eTogMC41O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRoIHtcbiAgYmFja2dyb3VuZDogI2VhZWRmMjtcbiAgZm9udC1zaXplOiAxNHB4O1xuICBjb2xvcjogIzMzMztcbiAgZm9udC13ZWlnaHQ6IDYwMDtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBtaW4td2lkdGg6IDc1cHg7XG4gIG1heC13aWR0aDogNzVweDtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0aDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG4gIG1pbi13aWR0aDogMjUwcHg7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgbWluLXdpZHRoOiA3NXB4O1xuICBtYXgtd2lkdGg6IDc1cHg7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQ6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiBsZWZ0O1xuICBtaW4td2lkdGg6IDI1MHB4O1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuZXhwYW5kaWNvbiB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgcmlnaHQ6IDIwcHg7XG4gIHRvcDogNTAlO1xuICB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoLTUwJSk7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24gLm1hdC1pY29uIHtcbiAgd2lkdGg6IDE4cHg7XG4gIGhlaWdodDogMThweDtcbiAgY29sb3I6ICM2NjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGgsICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdGhlYWQge1xuICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1pbi13aWR0aDogNzJweDtcbiAgbWF4LXdpZHRoOiA3MnB4O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0ciB0ZDpmaXJzdC1jaGlsZCB7XG4gIG1heC13aWR0aDogMjQwcHg7XG4gIG1pbi13aWR0aDogMjQwcHg7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG4gIGNvbG9yOiAjMzMzMzMzO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciB7XG4gIGRpc3BsYXk6IGlubGluZS1ibG9jaztcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBtYXJnaW4tYm90dG9tOiAxMnB4O1xuICBwYWRkaW5nLWxlZnQ6IDI1cHg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgZm9udC1zaXplOiAyMnB4O1xuICAtd2Via2l0LXVzZXItc2VsZWN0OiBub25lO1xuICAtbW96LXVzZXItc2VsZWN0OiBub25lO1xuICAtbXMtdXNlci1zZWxlY3Q6IG5vbmU7XG4gIHVzZXItc2VsZWN0OiBub25lO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciBpbnB1dCB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgb3BhY2l0eTogMDtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBoZWlnaHQ6IDA7XG4gIHdpZHRoOiAwO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja21hcmsge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHRvcDogMDtcbiAgbGVmdDogMDtcbiAgaGVpZ2h0OiAxNnB4O1xuICB3aWR0aDogMTZweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgYm9yZGVyOiAxcHggc29saWQgI2JiYjtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXI6aG92ZXIgaW5wdXQgfiAuY2hlY2ttYXJrIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2NjYztcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIgaW5wdXQ6Y2hlY2tlZCB+IC5jaGVja21hcmsge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciBpbnB1dDpkaXNhYmxlZCB+IC5jaGVja21hcmsge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZGRkO1xuICBjdXJzb3I6IG5vLWRyb3A7XG59XG4jYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrbWFyazphZnRlciB7XG4gIGNvbnRlbnQ6IFwiXCI7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgZGlzcGxheTogbm9uZTtcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIgaW5wdXQ6Y2hlY2tlZCB+IC5jaGVja21hcms6YWZ0ZXIge1xuICBkaXNwbGF5OiBibG9jaztcbn1cbiNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIgLmNoZWNrbWFyazphZnRlciB7XG4gIGxlZnQ6IDRweDtcbiAgdG9wOiAxcHg7XG4gIHdpZHRoOiA0cHg7XG4gIGhlaWdodDogN3B4O1xuICBib3JkZXI6IHNvbGlkIHdoaXRlO1xuICBib3JkZXItd2lkdGg6IDAgMnB4IDJweCAwO1xuICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKDQ1ZGVnKTtcbiAgLW1zLXRyYW5zZm9ybTogcm90YXRlKDQ1ZGVnKTtcbiAgdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5ub3BhZGRpbmd0ZCB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAuYWRkYnRuLCAjYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5maWx0ZXJidG4ge1xuICBtaW4td2lkdGg6IDEwMHB4O1xufVxuI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAuYWRkYnRuIHtcbiAgYmFja2dyb3VuZDogI2VkMWMyNztcbiAgY29sb3I6ICNmZmY7XG59XG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGFkZGluZ3NwYWNpbmcge1xuICAgIHBhZGRpbmctcmlnaHQ6IDBweCAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHtcbiAgICBvdmVyZmxvdzogYXV0bztcbiAgfVxufVxuXG5bZGlyPXJ0bF0gI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRoOmZpcnN0LWNoaWxkLCAucnRsICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0aDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuW2Rpcj1ydGxdICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCwgLnJ0bCAjYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQ6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbltkaXI9cnRsXSAjYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24sIC5ydGwgI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5leHBhbmRpY29uIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBsZWZ0OiAyMHB4O1xuICByaWdodDogYXV0bztcbiAgdG9wOiA1MCU7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtNTAlKTtcbn1cbltkaXI9cnRsXSAjYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24gLm1hdC1pY29uLCAucnRsICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuZXhwYW5kaWNvbiAubWF0LWljb24ge1xuICB3aWR0aDogMThweDtcbiAgaGVpZ2h0OiAxOHB4O1xuICBjb2xvcjogIzY2NjtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuW2Rpcj1ydGxdICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGgsIFtkaXI9cnRsXSAjYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRoZWFkLCAucnRsICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGgsIC5ydGwgI2FkZHJvbGVzIC5hZGRyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0aGVhZCB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cbltkaXI9cnRsXSAjYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkOmZpcnN0LWNoaWxkLCAucnRsICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGQ6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbltkaXI9cnRsXSAjYWRkcm9sZXMgLmFkZHJvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyLCAucnRsICNhZGRyb2xlcyAuYWRkcm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIge1xuICBwYWRkaW5nLXJpZ2h0OiAyNXB4O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbn1cblxuLnNlbGVjdF93aXRoX3NlYXJjaCB7XG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcbiAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiA1MHB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDE1cHggIWltcG9ydGFudDtcbn1cblxuLnNlbGVjdF93aXRoX29wdGlvbiB7XG4gIG92ZXJmbG93OiBoaWRkZW4gIWltcG9ydGFudDtcbiAgbWF4LWhlaWdodDogMTAwJSAhaW1wb3J0YW50O1xuICBtYXJnaW4tdG9wOiA0OXB4ICFpbXBvcnRhbnQ7XG4gIG1hcmdpbi1ib3R0b206IDE1cHggIWltcG9ydGFudDtcbn1cblxuLnNlYXJjaGlubXVsdGlzZWxlY3Qge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xuICBwYWRkaW5nOiAxMHB4IDEwcHg7XG4gIGJhY2tncm91bmQ6ICNlOWVkZjA7XG4gIG1hcmdpbjogMTBweDtcbn1cblxuLnNlYXJjaHNlbGVjdCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAyNXB4KSAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWxlZnQ6IDEwcHg7XG59XG5cbi5tYXQtb3B0aW9uLm1hdC1hY3RpdmUge1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xuICBjb2xvcjogcmdiYSgwLCAwLCAwLCAwLjg3KTtcbn1cblxuLm9wdGlvbi1saXN0aW5nIHtcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgb3ZlcmZsb3cteTogYXV0bztcbiAgbWF4LWhlaWdodDogMjkwcHg7XG59XG5cbi5vcHRpb24tbGlzdGluZzo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogN3B4O1xufVxuXG4ubnVtYmVyYW5kY29kZSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBkaXNwbGF5OiBmbGV4ICFpbXBvcnRhbnQ7XG59XG5cbi8qIFRyYWNrICovXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcbiAgYmFja2dyb3VuZDogI2YxZjFmMTtcbn1cblxuLyogSGFuZGxlICovXG4ub3B0aW9uLWxpc3Rpbmc6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZDogI0VEMUMyNztcbn1cblxuLyogaG92ZXIgKi9cbi5vcHRpb24tbGlzdGluZzo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjRUQxQzI3O1xufVxuXG4ubXlQYW5lbENsYXNzIHtcbiAgbWFyZ2luOiAzNnB4IDBweDtcbn1cblxuI21hbmFnZXJvbGVzIHRyLm1hdC1yb3csXG4jbWFuYWdlcm9sZXMgdHIubWF0LWZvb3Rlci1yb3cge1xuICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcbiAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkZGQ7XG59XG4jbWFuYWdlcm9sZXMgdHIubWF0LXJvdzpsYXN0LWNoaWxkLFxuI21hbmFnZXJvbGVzIHRyLm1hdC1mb290ZXItcm93Omxhc3QtY2hpbGQge1xuICBib3JkZXItYm90dG9tOiBub25lICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgdGgubWF0LWhlYWRlci1jZWxsLFxuI21hbmFnZXJvbGVzIHRkLm1hdC1jZWxsLFxuI21hbmFnZXJvbGVzIHRkLm1hdC1mb290ZXItY2VsbCB7XG4gIGJvcmRlci1ib3R0b20tc3R5bGU6IG5vbmUgIWltcG9ydGFudDtcbn1cbiNtYW5hZ2Vyb2xlcyAuZXhhbXBsZS1lbGVtZW50LXJvdyB0ZCB7XG4gIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XG59XG4jbWFuYWdlcm9sZXMgLmV4YW1wbGUtZWxlbWVudC1kZXRhaWwge1xuICBvdmVyZmxvdzogaGlkZGVuO1xuICBkaXNwbGF5OiBmbGV4O1xufVxuI21hbmFnZXJvbGVzIC5leGFtcGxlLWVsZW1lbnQtZGlhZ3JhbSB7XG4gIG1pbi13aWR0aDogODBweDtcbiAgYm9yZGVyOiAycHggc29saWQgYmxhY2s7XG4gIHBhZGRpbmc6IDhweDtcbiAgZm9udC13ZWlnaHQ6IGxpZ2h0ZXI7XG4gIG1hcmdpbjogOHB4IDA7XG4gIGhlaWdodDogMTA0cHg7XG59XG4jbWFuYWdlcm9sZXMgLmV4YW1wbGUtZWxlbWVudC1zeW1ib2wge1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgZm9udC1zaXplOiA0MHB4O1xuICBsaW5lLWhlaWdodDogbm9ybWFsO1xufVxuI21hbmFnZXJvbGVzIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xuICBwYWRkaW5nOiAxNnB4O1xufVxuI21hbmFnZXJvbGVzIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24tYXR0cmlidXRpb24ge1xuICBvcGFjaXR5OiAwLjU7XG59XG4jbWFuYWdlcm9sZXMgLmRvY3VtZW50aGVhZGVyIGg0IHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jbWFuYWdlcm9sZXMgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcbiAgbWFyZ2luOiAwcHggIWltcG9ydGFudDtcbn1cbiNtYW5hZ2Vyb2xlcyAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbn1cbiNtYW5hZ2Vyb2xlcyAudmlld3RleHRjb2xvciB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI21hbmFnZXJvbGVzIC5hZGRidG4ge1xuICBiYWNrZ3JvdW5kOiAjZWQxYzI3O1xuICBjb2xvcjogI2ZmZjtcbn1cbiNtYW5hZ2Vyb2xlcyAjc2VhcmNocm93LFxuI21hbmFnZXJvbGVzICNmaWx0ZXJzaG93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmU7XG59XG4jbWFuYWdlcm9sZXMgI3NlYXJjaHJvdyAuc2VyYWNocm93LFxuI21hbmFnZXJvbGVzICNmaWx0ZXJzaG93IC5zZXJhY2hyb3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbiAgcGFkZGluZy10b3A6IDEwcHg7XG59XG4jbWFuYWdlcm9sZXMgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI21hbmFnZXJvbGVzIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNtYW5hZ2Vyb2xlcyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbn1cbiNtYW5hZ2Vyb2xlcyAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jbWFuYWdlcm9sZXMgLnNob3d0ZXh0Y29sb3Ige1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNtYW5hZ2Vyb2xlcyAucmVkVHh0IHtcbiAgY29sb3I6ICM2MjYzNjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiNtYW5hZ2Vyb2xlcyAudmlld2hhZGVycGRmIGltZyB7XG4gIHdpZHRoOiA0MHB4O1xufVxuI21hbmFnZXJvbGVzIC52aWV3aGFkZXJwZGYgcCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI21hbmFnZXJvbGVzIC5wcmludCwgI21hbmFnZXJvbGVzIC5jYW5jZWxsZWQsICNtYW5hZ2Vyb2xlcyAucmVxdWVzdGVkYmFjaywgI21hbmFnZXJvbGVzIC5yZXF1ZXN0ZWRhY2Nlc3MsICNtYW5hZ2Vyb2xlcyAuYXNzZXNzbWVudCwgI21hbmFnZXJvbGVzIC5xdWFsaXR5Y2hlY2ssICNtYW5hZ2Vyb2xlcyAudGVhY2hpbmcsICNtYW5hZ2Vyb2xlcyAubmV3dGFnIHtcbiAgY29sb3I6ICMwMGE1NTE7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuI21hbmFnZXJvbGVzIC5uZXd0YWcge1xuICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIC50ZWFjaGluZyB7XG4gIGNvbG9yOiAjZjQ4MTFmICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLnF1YWxpdHljaGVjayB7XG4gIGNvbG9yOiAjMGM0YjlhICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLmZsZXhhbGlnbnRhZyB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jbWFuYWdlcm9sZXMgLmFzc2Vzc21lbnQge1xuICBjb2xvcjogI0MzMzBDRTtcbn1cbiNtYW5hZ2Vyb2xlcyAucmVxdWVzdGVkYWNjZXNzIHtcbiAgY29sb3I6ICMxMDlkOTg7XG59XG4jbWFuYWdlcm9sZXMgLnJlcXVlc3RlZGFjY2VzcyB7XG4gIGNvbG9yOiAjMTA5ZDk4O1xufVxuI21hbmFnZXJvbGVzIC5yZXF1ZXN0ZWRiYWNrIHtcbiAgY29sb3I6ICNiMTQ0Mjg7XG59XG4jbWFuYWdlcm9sZXMgLmNhbmNlbGxlZCB7XG4gIGNvbG9yOiAjZWQxYzI3O1xufVxuI21hbmFnZXJvbGVzIC51cGRhdGUge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNtYW5hZ2Vyb2xlcyAuZGVjbGluZWQge1xuICBjb2xvcjogI2VkMWMyNztcbn1cbiNtYW5hZ2Vyb2xlcyAubmV3IHtcbiAgY29sb3I6ICNmNDgxMWY7XG59XG4jbWFuYWdlcm9sZXMgLmFwcHJvY2VkdGFnYWxpZ24ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI21hbmFnZXJvbGVzIC5hcHByb2NlZHRhZ2FsaWduIGltZyB7XG4gIHBhZGRpbmctbGVmdDogMTVweDtcbn1cbiNtYW5hZ2Vyb2xlcyAuc2Nyb2xsZGF0YSB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgei1pbmRleDogMTtcbiAgZGlzcGxheTogYmxvY2s7XG4gIG92ZXJmbG93LXg6IGF1dG87XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xufVxuI21hbmFnZXJvbGVzIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhciB7XG4gIHdpZHRoOiA2cHg7XG4gIGhlaWdodDogNXB4O1xufVxuI21hbmFnZXJvbGVzIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10cmFjayB7XG4gIGJhY2tncm91bmQ6ICNmMWYxZjE7XG59XG4jbWFuYWdlcm9sZXMgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xufVxuI21hbmFnZXJvbGVzIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG59XG4jbWFuYWdlcm9sZXMgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2UtbGVnYWN5IC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZDlkOWQ5ICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI21hbmFnZXJvbGVzIC5ub2ZvdW5kIHtcbiAgbWFyZ2luLXRvcDogNSU7XG59XG4jbWFuYWdlcm9sZXMgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jbWFuYWdlcm9sZXMgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtc2VsZWN0LXZhbHVlIHtcbiAgY29sb3I6ICM2MjYzNjY7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNtYW5hZ2Vyb2xlcyAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBtYXJnaW46IDBweCAxMHB4ICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLmF3YXJlZHRhYmxlIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBtYXJnaW46IDEwcHggMHB4O1xufVxuI21hbmFnZXJvbGVzIC5hd2FyZWR0YWJsZSAubWFuYWdlb3B0aW9ucyB7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jbWFuYWdlcm9sZXMgLmF3YXJlZHRhYmxlIC5tYXQtcm93OmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIC5hd2FyZWR0YWJsZSAubWF0LWNlbGwge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNtYW5hZ2Vyb2xlcyAuYXdhcmVkdGFibGUgLm1hdC1oZWFkZXItY2VsbCB7XG4gIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNtYW5hZ2Vyb2xlcyAuc3RhdHVzdGFncyB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XG4gIGNvbG9yOiAjZmZmO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIHBhZGRpbmc6IDNweCA2cHg7XG59XG4jbWFuYWdlcm9sZXMgLmNhbmNlbGJ0biB7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIGNvbG9yOiAjMzMzO1xuICBib3JkZXI6IDFweCBzb2xpZCAjYzRjNGM0O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbiAgcGFkZGluZy1yaWdodDogMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4jbWFuYWdlcm9sZXMgLnN1Ym1pdF9idG4ge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjRUQxQzI3ICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi13aWR0aDogMTEwcHg7XG4gIGhlaWdodDogNDVweDtcbiAgYm94LXNoYWRvdzogbm9uZTtcbn1cbiNtYW5hZ2Vyb2xlcyAuZGVjbGluZWNtZCB7XG4gIGJvcmRlcjogMXB4IHNvbGlkICNFRDFDMjc7XG4gIGJvcmRlci1yYWRpdXM6IDNweDtcbiAgcGFkZGluZzogMTVweCAxNXB4IDEwcHggMTVweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjhmODtcbiAgaGVpZ2h0OiBhdXRvO1xuICB3aWR0aDogMTAwJTtcbn1cbiNtYW5hZ2Vyb2xlcyAuZGVjbGluZWNtZCAuY29tbWVudCB7XG4gIGNvbG9yOiAjRUQxQzI3ICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLmRlY2xpbmVjbWQgcCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuXG4uYWN0aW9ubWF0bWVudSB7XG4gIGJhY2tncm91bmQ6ICM2NjY7XG4gIGJvcmRlci1yYWRpdXM6IDBweDtcbiAgbWluLXdpZHRoOiAxMDBweDtcbn1cbi5hY3Rpb25tYXRtZW51IC5tYXQtbWVudS1jb250ZW50IGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcbiAgaGVpZ2h0OiAyOHB4O1xuICBjb2xvcjogI2ZmZjtcbiAgbGluZS1oZWlnaHQ6IDI4cHg7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAjbWFuYWdlcm9sZXMgLm1hc3RlclBhZ2VUb3Age1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIH1cbiAgI21hbmFnZXJvbGVzIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gICAgbWFyZ2luOiAwcHggIWltcG9ydGFudDtcbiAgfVxuICAjbWFuYWdlcm9sZXMgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XG4gICNtYW5hZ2Vyb2xlcyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuICAjbWFuYWdlcm9sZXMgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICB9XG59XG4jbWFuYWdldXNlcnMgdHIubWF0LXJvdyxcbiNtYW5hZ2V1c2VycyB0ci5tYXQtZm9vdGVyLXJvdyB7XG4gIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcbn1cbiNtYW5hZ2V1c2VycyB0ci5tYXQtcm93Omxhc3QtY2hpbGQsXG4jbWFuYWdldXNlcnMgdHIubWF0LWZvb3Rlci1yb3c6bGFzdC1jaGlsZCB7XG4gIGJvcmRlci1ib3R0b206IG5vbmUgIWltcG9ydGFudDtcbn1cbiNtYW5hZ2V1c2VycyB0aC5tYXQtaGVhZGVyLWNlbGwsXG4jbWFuYWdldXNlcnMgdGQubWF0LWNlbGwsXG4jbWFuYWdldXNlcnMgdGQubWF0LWZvb3Rlci1jZWxsIHtcbiAgYm9yZGVyLWJvdHRvbS1zdHlsZTogbm9uZSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcbiAgYm9yZGVyLWJvdHRvbS13aWR0aDogMDtcbn1cbiNtYW5hZ2V1c2VycyAuZXhhbXBsZS1lbGVtZW50LWRldGFpbCB7XG4gIG92ZXJmbG93OiBoaWRkZW47XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jbWFuYWdldXNlcnMgLmV4YW1wbGUtZWxlbWVudC1kaWFncmFtIHtcbiAgbWluLXdpZHRoOiA4MHB4O1xuICBib3JkZXI6IDJweCBzb2xpZCBibGFjaztcbiAgcGFkZGluZzogOHB4O1xuICBmb250LXdlaWdodDogbGlnaHRlcjtcbiAgbWFyZ2luOiA4cHggMDtcbiAgaGVpZ2h0OiAxMDRweDtcbn1cbiNtYW5hZ2V1c2VycyAuZXhhbXBsZS1lbGVtZW50LXN5bWJvbCB7XG4gIGZvbnQtd2VpZ2h0OiBib2xkO1xuICBmb250LXNpemU6IDQwcHg7XG4gIGxpbmUtaGVpZ2h0OiBub3JtYWw7XG59XG4jbWFuYWdldXNlcnMgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbiB7XG4gIHBhZGRpbmc6IDE2cHg7XG59XG4jbWFuYWdldXNlcnMgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XG4gIG9wYWNpdHk6IDAuNTtcbn1cbiNtYW5hZ2V1c2VycyAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5hZGRidG4ge1xuICBiYWNrZ3JvdW5kOiAjZWQxYzI3O1xuICBjb2xvcjogI2ZmZjtcbn1cbiNtYW5hZ2V1c2VycyAjc2VhcmNocm93LFxuI21hbmFnZXVzZXJzICNmaWx0ZXJzaG93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmU7XG59XG4jbWFuYWdldXNlcnMgI3NlYXJjaHJvdyAuc2VyYWNocm93LFxuI21hbmFnZXVzZXJzICNmaWx0ZXJzaG93IC5zZXJhY2hyb3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbiAgcGFkZGluZy10b3A6IDEwcHg7XG59XG4jbWFuYWdldXNlcnMgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI21hbmFnZXVzZXJzIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNtYW5hZ2V1c2VycyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbn1cbiNtYW5hZ2V1c2VycyAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jbWFuYWdldXNlcnMgLmF1dG9mZWN0bGlzdCAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4ZjggIWltcG9ydGFudDtcbiAgY3Vyc29yOiBuby1kcm9wICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdldXNlcnMgLmF1dG9mZWN0bGlzdCBpbnB1dFtyZWFkb25seV0ge1xuICBjdXJzb3I6IG5vLWRyb3AgIWltcG9ydGFudDtcbn1cbiNtYW5hZ2V1c2VycyAucHJpbnQsICNtYW5hZ2V1c2VycyAjbWFuYWdlcm9sZXMgLm5ld3RhZywgI21hbmFnZXJvbGVzICNtYW5hZ2V1c2VycyAubmV3dGFnLCAjbWFuYWdldXNlcnMgI21hbmFnZXJvbGVzIC50ZWFjaGluZywgI21hbmFnZXJvbGVzICNtYW5hZ2V1c2VycyAudGVhY2hpbmcsICNtYW5hZ2V1c2VycyAjbWFuYWdlcm9sZXMgLnF1YWxpdHljaGVjaywgI21hbmFnZXJvbGVzICNtYW5hZ2V1c2VycyAucXVhbGl0eWNoZWNrLCAjbWFuYWdldXNlcnMgI21hbmFnZXJvbGVzIC5hc3Nlc3NtZW50LCAjbWFuYWdlcm9sZXMgI21hbmFnZXVzZXJzIC5hc3Nlc3NtZW50LCAjbWFuYWdldXNlcnMgI21hbmFnZXJvbGVzIC5yZXF1ZXN0ZWRhY2Nlc3MsICNtYW5hZ2Vyb2xlcyAjbWFuYWdldXNlcnMgLnJlcXVlc3RlZGFjY2VzcywgI21hbmFnZXVzZXJzICNtYW5hZ2Vyb2xlcyAucmVxdWVzdGVkYmFjaywgI21hbmFnZXJvbGVzICNtYW5hZ2V1c2VycyAucmVxdWVzdGVkYmFjaywgI21hbmFnZXVzZXJzICNtYW5hZ2Vyb2xlcyAuY2FuY2VsbGVkLCAjbWFuYWdlcm9sZXMgI21hbmFnZXVzZXJzIC5jYW5jZWxsZWQge1xuICBjb2xvcjogIzAwYTU1MTtcbiAgZm9udC1zaXplOiAwLjkzNzVyZW07XG59XG4jbWFuYWdldXNlcnMgLmZsZXhhbGlnbnRhZyB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jbWFuYWdldXNlcnMgLnVwZGF0ZSB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI21hbmFnZXVzZXJzIC5kZWNsaW5lZCB7XG4gIGNvbG9yOiAjZWQxYzI3O1xufVxuI21hbmFnZXVzZXJzIC5wZW5kaW5nIHtcbiAgY29sb3I6ICNGNDgxMUY7XG59XG4jbWFuYWdldXNlcnMgLnNjcm9sbGRhdGEge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHotaW5kZXg6IDE7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBvdmVyZmxvdy14OiBhdXRvO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcbn1cbiNtYW5hZ2V1c2VycyAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogNnB4O1xuICBoZWlnaHQ6IDVweDtcbn1cbiNtYW5hZ2V1c2VycyAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xuICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xufVxuI21hbmFnZXVzZXJzIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbn1cbiNtYW5hZ2V1c2VycyAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xufVxuI21hbmFnZXVzZXJzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Q5ZDlkOSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5tYXQtc29ydC1oZWFkZXItYXJyb3cge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNtYW5hZ2V1c2VycyAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNtYW5hZ2V1c2VycyAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1zZWxlY3QtdmFsdWUge1xuICBjb2xvcjogIzYyNjM2NjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI21hbmFnZXVzZXJzIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDE1cHg7XG4gIG1hcmdpbjogMHB4IDEwcHggIWltcG9ydGFudDtcbn1cbiNtYW5hZ2V1c2VycyAuYXdhcmVkdGFibGUge1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGJhY2tncm91bmQtY2xpcDogcGFkZGluZy1ib3g7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG4gIG1hcmdpbjogMTBweCAwcHg7XG59XG4jbWFuYWdldXNlcnMgLmF3YXJlZHRhYmxlIC5tYW5hZ2VvcHRpb25zIHtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbn1cbiNtYW5hZ2V1c2VycyAuYXdhcmVkdGFibGUgLm1hdC1yb3c6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdldXNlcnMgLmF3YXJlZHRhYmxlIC5tYXQtY2VsbCB7XG4gIGNvbG9yOiAjMjYyNjI2O1xufVxuI21hbmFnZXVzZXJzIC5hd2FyZWR0YWJsZSAubWF0LWhlYWRlci1jZWxsIHtcbiAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuXG4uYWN0aW9ubWF0bWVudSB7XG4gIGJhY2tncm91bmQ6ICM2NjY7XG4gIGJvcmRlci1yYWRpdXM6IDBweDtcbiAgbWluLXdpZHRoOiAxMDBweDtcbn1cbi5hY3Rpb25tYXRtZW51IC5tYXQtbWVudS1jb250ZW50IGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcbiAgaGVpZ2h0OiAyOHB4O1xuICBjb2xvcjogI2ZmZjtcbiAgbGluZS1oZWlnaHQ6IDI4cHg7XG59XG5cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAjbWFuYWdldXNlcnMgLm1hc3RlclBhZ2VUb3Age1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIH1cbiAgI21hbmFnZXVzZXJzIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gICAgbWFyZ2luOiAwcHggIWltcG9ydGFudDtcbiAgfVxuICAjbWFuYWdldXNlcnMgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQgIWltcG9ydGFudDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XG4gICNtYW5hZ2V1c2VycyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgfVxuICAjbWFuYWdldXNlcnMgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xuICB9XG59XG4ub25seXZpZXdhbGxvY2F0ZSAuY3Vyc29yX3BhcnQge1xuICBjdXJzb3I6IG5vLWRyb3A7XG59XG4ub25seXZpZXdhbGxvY2F0ZSAuY3Vyc29yX3BhcnQgLmlubmVycGVybWlzc2lvbiB7XG4gIHBvaW50ZXItZXZlbnRzOiBub25lO1xuICBvcGFjaXR5OiAwLjU7XG59Il19 */");

/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/addroles/addroles.component.ts":
/*!***************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/addroles/addroles.component.ts ***!
  \***************************************************************************/
/*! exports provided: MY_FORMATS, AddrolesComponent, ManageRoleGlistPagination */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MY_FORMATS", function() { return MY_FORMATS; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AddrolesComponent", function() { return AddrolesComponent; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ManageRoleGlistPagination", function() { return ManageRoleGlistPagination; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_animations__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/animations */ "./node_modules/@angular/animations/__ivy_ngcc__/fesm2015/animations.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../enterpriseadmin.service */ "./src/app/modules/newenterpriseadmin/enterpriseadmin.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _app_shared_sidepanel_userallocation_userallocation_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @app/@shared/sidepanel/userallocation/userallocation.component */ "./src/app/@shared/sidepanel/userallocation/userallocation.component.ts");
/* harmony import */ var _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @angular/material-moment-adapter */ "./node_modules/@angular/material-moment-adapter/__ivy_ngcc__/esm2015/material-moment-adapter.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! sweetalert */ "./node_modules/sweetalert/dist/sweetalert.min.js");
/* harmony import */ var sweetalert__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(sweetalert__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! @app/common/class/encrypt */ "./src/app/common/class/encrypt.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _env_environment__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! @env/environment */ "./src/environments/environment.ts");
/* harmony import */ var rxjs_observable_of__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! rxjs/observable/of */ "./node_modules/rxjs-compat/_esm2015/observable/of.js");
/* harmony import */ var rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! rxjs/observable/merge */ "./node_modules/rxjs-compat/_esm2015/observable/merge.js");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
/* harmony import */ var rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! rxjs/operators/startWith */ "./node_modules/rxjs-compat/_esm2015/operators/startWith.js");
/* harmony import */ var rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! rxjs/operators/switchMap */ "./node_modules/rxjs-compat/_esm2015/operators/switchMap.js");
/* harmony import */ var rxjs_operators_map__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! rxjs/operators/map */ "./node_modules/rxjs-compat/_esm2015/operators/map.js");
/* harmony import */ var rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! rxjs/operators/catchError */ "./node_modules/rxjs-compat/_esm2015/operators/catchError.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _app_services_application_service__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! @app/services/application.service */ "./src/app/services/application.service.ts");
/* harmony import */ var _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! @app/common/localstorage/applocalstorage.services */ "./src/app/common/localstorage/applocalstorage.services.ts");



























// export interface ModuleElement {
//   id: number;
//   name: string;
//   create: string;
//   update: string;
//   delete: string;
//   approve: string;
//   download: string;
//   submodule?: SubmoduleElement[] | MatTableDataSource<SubmoduleElement>;
// }
// export interface SubmoduleElement {
//   sid: number;
//   sname: string;
//   screate: string;
//   supdate: string;
//   sdelete: string;
//   sapprove: string;
//   sdownload: string;
// }
// export interface Roledata {
//   // roleList: any;
//   stakeholdertype: any;
//   projectname_en:any;
//   rolename_en:any;
//   higherRole:any;
//   status:any;
//   addedOn:any;
//   updatedOn:any;
//   id:any;
// }
// export interface Roledata {
//   stktype: any;
//   civilnumber:any;
//   stafname:any;
//   emailid:any;
//   mobilenumber:any;
//   role:any;
//   thirdpartyagent:any;
//   status:any;
//   added_on:any;
//   lastupdated:any;
// }
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
let AddrolesComponent = class AddrolesComponent {
    constructor(formBuilder, translate, routeid, enterprise, encrypt, remoteService, cookieService, http, localstorage, appservice) {
        this.formBuilder = formBuilder;
        this.translate = translate;
        this.routeid = routeid;
        this.enterprise = enterprise;
        this.encrypt = encrypt;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.http = http;
        this.localstorage = localstorage;
        this.appservice = appservice;
        this.userroleallocation = false;
        this.addrolecreationpage = false;
        this.addrolecreation = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.rolegridlistdata = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.change = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.showrole = false;
        this.addUserFromType = 1;
        this.datachecked = 2;
        this.roledatapatch = [];
        this.userdatapatch = [];
        this.centrepatch = [];
        this.userdataL = [];
        this.userCenter = [];
        this.stkpk = 1;
        this.showhighrole = false;
        this.showhighupdate = false;
        this.showevaltech = false;
        this.opaladmindatashow = false;
        this.opaladmincentreshow = false;
        this.userdata = [];
        this.add_btn = true;
        this.rolesrecordcolumn = ['stk_type', 'civilnumber', 'stafName', 'emailid', 'mobilenumber', 'role', 'thirdpartyagent', 'status', 'added_on', 'lastupdated', 'action'];
        this.centerrecordcolumn = ['civilnumber', 'stafName', 'emailid', 'mobilenumber', 'role', 'status', 'added_on', 'lastupdated', 'action'];
        this.centredatashow = false;
        this.thirdaprtyshowopal = false;
        this.userrecordcolumn = ['stakeholdertype', 'projectname_en', 'rolename_en', 'higherRole', 'status', 'addedOn', 'updatedOn', 'action'];
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.page = 10;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_3__["ErrorStateMatcher"]();
        this.requiredtag = false;
        this.role_stktype = [];
        this.role_project = [];
        this.user_stktype = [];
        this.user_role = [];
        this.centre_array = [];
        //role grid
        this.stktypesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.projectsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.rolesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.highrolesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.statussearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.addedonsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.updatedonsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        //user grid and center
        // centerName= new FormControl('');
        this.stafName = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.emailid = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.stakeholdertype = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.civilNo = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.mobilno = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.roleName_en = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.status = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.addedOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.lastUpdateOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.isthirdPartyAgent = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.showrolegrid = false;
        this.viewRoleUserdis = false;
        this.viewUserdis = false;
        this.viewCenterUserdis = false;
        this.viewBackBackbutton = false;
        this.hidegrid = true;
        this.usergrid = false;
        this.hideusergrid = true;
        this.hidecentergrid = true;
        this.apptype = 'new';
        this.staffslist = [];
        this.staffslistcentre = [];
        this.ifarabic = false;
        this.role_mstlist = [];
        this.highrolelist = [];
        this.columnsToDisplay = ['name', 'create', 'update', 'delete', 'approve', 'download'];
        this.innerDisplayedColumns = ['sname', 'screate', 'supdate', 'sdelete', 'sapprove', 'sdownload'];
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
        this.userPermission = [];
        // }
        this.updated = false;
        this.roledata = [];
        this.currentUserPk = '';
        this.userPermissionsActivityLogs = [];
        this.previousFormValue = [];
        this.centregrid = false;
        this.hidecentregrid = true;
        this.noData = '';
        this.stkholdertype = this.localstorage.getInLocal('omrm_stkholdertypmst_fk');
    }
    ngOnInit() {
        this.initializeForm();
        this.routeid.queryParams.subscribe(params => {
            this.refname = params['type'];
        });
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
        if (this.refname == 1) {
            // this.centerName = new FormControl('');
            this.stktypesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.projectsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.rolesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.highrolesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.statussearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.addedonsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.updatedonsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.adduserroleform.controls['emailid'].valueChanges.debounceTime(400).subscribe(data => {
                var _a, _b;
                if ((((_a = this.adduserroleform.controls['emailid'].errors) === null || _a === void 0 ? void 0 : _a.pattern) == null || ((_b = this.adduserroleform.controls['emailid'].errors) === null || _b === void 0 ? void 0 : _b.pattern) == undefined)) {
                    this.chkValidemailId(data);
                }
            });
            this.stktypesearch.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
            });
            this.projectsearch.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
            });
            this.rolesearch.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
            });
            this.highrolesearch.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
            });
            this.statussearch.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
            });
            this.addedonsearch.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
            });
            this.updatedonsearch.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                }
            });
        }
        else if (this.refname == 2 || this.refname == 3) {
            this.stafName = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.emailid = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.stakeholdertype = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.civilNo = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.mobilno = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.roleName_en = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.status = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.addedOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.lastUpdateOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            this.isthirdPartyAgent = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
            // this.centerName.valueChanges.debounceTime(400).subscribe( 
            //   register => { 
            //     if (register != null ) {
            //       this.paginator.pageIndex = 0;
            //       this.getManageRolesDtls();   
            //     }else if(register == ''){
            //       this.paginator.pageIndex = 0;
            //       this.getManageRolesDtls();   
            //     }    
            //   }
            // )
            this.stafName.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.emailid.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.stakeholdertype.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.civilNo.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.mobilno.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.roleName_en.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.status.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.addedOn.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.lastUpdateOn.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
            this.isthirdPartyAgent.valueChanges.debounceTime(400).subscribe(register => {
                if (register != null) {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
                else if (register == '') {
                    this.paginator.pageIndex = 0;
                    this.getManageRolesDtls();
                    ;
                }
            });
        }
        this.roledatas();
        // this.getuserroledata();
        // this.getusercentergriddata();
        this.userdatas();
        this.highroledata();
        if (this.refname == 2) {
            this.centredata();
        }
        else if (this.refname == 3) {
            this.staffdatalist();
        }
        this.rolesmstata();
    }
    ngAfterViewInit() {
        this.getManageRolesDtls();
        // this.userdata.data.sort = this.sort;
        // this.userdata.data.paginator = this.paginator;
    }
    initializeForm() {
        this.addroleform = this.formBuilder.group({
            stkholdertype: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            techeval: [null, ''],
            arrole: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            rolearbic: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            arrolehigh: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            useraccess: [null, null],
            addusertypecontrol: [null, null],
            userPk: [null, null],
            rolerelpk: [null, null],
            arrolehighupdate: [null, null]
        });
        this.adduserroleform = this.formBuilder.group({
            stkholdertypeuser: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            civilno: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            stafName: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            emailid: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            mobilenumber: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            arroles: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            centrename: [null, ''],
            slider: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            rolecentre: [null],
            stafnamecentre: [null, ''],
            staffrepopk: [null],
            opalusermstpk: [null, null],
        });
        this.centreform = this.formBuilder.group({
            staffsnamecentre: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            civilnocentre: ['', ''],
            emailidcentre: ['', ''],
            mobilenumbercentre: ['', ''],
            rolescentre: ['', ''],
            staffcentrerepopk: [null],
            opalusermstpk: [null, null],
        });
    }
    get adduserform() {
        return this.adduserroleform.controls;
    }
    get addrolform() {
        return this.addroleform.controls;
    }
    get cntreform() {
        return this.centreform.controls;
    }
    chkValidemailId(dataValue) {
        let postData = {
            'emailid': dataValue,
            'usrid': this.adduserroleform.controls['userPk'].value,
            'stktype': this.stkholdertype
        };
        this.enterprise.checkEmailExistOrNot('ea/enterpriseadmin/check-email-exist', postData).subscribe(response => {
            var _a;
            if (response === null || response === void 0 ? void 0 : response.success) {
                if ((_a = response === null || response === void 0 ? void 0 : response.data) === null || _a === void 0 ? void 0 : _a.data) {
                    this.adduserroleform.controls.emailid.setErrors({ alreadyExist: true });
                }
                else {
                    this.adduserroleform.controls.emailid.setErrors(null);
                }
            }
        });
    }
    adduserdatasave() {
        if (this.adduserroleform.valid) {
            this.enterprise.saveuserdata(this.adduserroleform.value, this.apptype).subscribe(res => {
                if (res.status == 200) {
                    this.getManageRolesDtls();
                }
            });
            this.usergrid = false;
            this.hideusergrid = true;
            this.adduserroleform.reset();
        }
    }
    update(userPk, status) {
        let statMsg = '';
        let statSuccessMsg = '';
        if (status == 2) {
            statMsg = 'Do you want to activate this user?';
            statSuccessMsg = 'User activated successfully';
        }
        else if (status == "I") {
            statMsg = 'Do you want to activate this user?';
            statSuccessMsg = 'User activated successfully';
        }
        else {
            statMsg = 'Do you want to deactivate this user ?';
            statSuccessMsg = 'User deactivated successfully';
        }
        let usrPk = this.encrypt.encrypt(userPk);
        this.postParams = {
            "userPk": usrPk,
            "status": status
        };
        sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
            title: statMsg,
            icon: 'warning',
            buttons: ['No', 'Yes'],
            dangerMode: true,
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then((willDelete) => {
            if (willDelete) {
                if (this.refname == 1) {
                    this.postUrl = 'ea/enterpriseadmin/update-stakholder-users';
                }
                else {
                    this.postUrl = 'ea/enterpriseadmin/update-manageorcenter-users';
                }
                this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(function (data) {
                    this.getManageRolesDtls();
                    if (data['data'].status == 200) {
                        sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
                            title: statSuccessMsg,
                            icon: 'success',
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                    }
                    else {
                        sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
                            title: data['data'].msg,
                            icon: 'warning',
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                    }
                }.bind(this));
            }
        });
    }
    addcentredatasave() {
        if (this.centreform.valid) {
            this.enterprise.savecentredata(this.centreform.value, this.apptype).subscribe(res => {
                if (res.status == 200) {
                    // this.getusercentergriddata();
                    this.getManageRolesDtls();
                }
            });
            this.centregrid = false;
            this.hidecentregrid = true;
            this.adduserroleform.reset();
        }
    }
    get isFormValid() {
        let isValid = true;
        if ((this.adduserroleform.valid || !this.previousFormValue) || (this.previousFormValue && this.isFormsValueChanged)) {
            isValid = this.adduserroleform.invalid;
        }
        return isValid;
    }
    get isFormsValueChanged() {
        return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.adduserroleform.value);
    }
    get isFormroleValid() {
        let isValid = true;
        if ((this.addroleform.valid || !this.previousFormValue) || (this.previousFormValue && this.isFormsroleValueChanged)) {
            isValid = this.addroleform.invalid;
        }
        return isValid;
    }
    get isFormsroleValueChanged() {
        return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.addroleform.value);
    }
    addrolesave() {
        this.addUpdateAccess.savemodulepermissionallocation();
        this.addroleform.controls['useraccess'].setValue(this.userPermission);
        if (this.addroleform.valid) {
            this.enterprise.saverolesdata(this.addroleform.value, this.apptype).subscribe(res => {
                if (res.status == 200) {
                    this.getuserroledata();
                    this.getManageRolesDtls();
                    this.userPermission = [];
                }
            });
            this.showrolegrid = false;
            this.hidegrid = true;
            this.addroleform.reset();
        }
    }
    roledatas() {
        this.enterprise.getrolestktypedata().subscribe(data => {
            this.role_stktype = data.data.stktypedata;
            this.role_project = data.data.projectdata;
        });
    }
    rolesmstata() {
        this.enterprise.getroledtls().subscribe(data => {
            this.role_mstlist = data.data;
            this.relopk = data.data.rolemst_pk;
        });
    }
    userdatas() {
        this.enterprise.getstktypeuserddtls().subscribe(data => {
            this.user_stktype = data.data.stktypeuserdata;
            this.centre_array = data.data.userdatafetchlist;
            this.staffslist = data.data.stafffetchdata;
        });
    }
    centredata() {
        this.enterprise.getcentrelistdtls().subscribe(data => {
            this.staffslist = data.data.stafffcentretchdata;
        });
    }
    staffdatalist() {
        this.enterprise.getstafflistdata().subscribe(data => {
            this.staffslistcentre = data.data;
        });
    }
    staffdatalist1(rolepk) {
        this.enterprise.getstafflistdata1(rolepk).subscribe(data => {
            this.staffslistcentre = data.data;
        });
    }
    selectciviliddata(value) {
        this.enterprise.stafffetchdata(value).subscribe(data => {
            this.staffslist = data.data;
            if (this.staffslist.length == 0) {
                sweetalert__WEBPACK_IMPORTED_MODULE_13___default()({
                    title: "No staff available",
                    icon: 'warning',
                    dangerMode: true,
                    closeOnClickOutside: false
                });
            }
            this.adduserroleform.controls['civilno'].reset();
            this.adduserroleform.controls['emailid'].reset();
            this.adduserroleform.controls['mobilenumber'].reset();
            this.adduserroleform.controls['rolecentre'].reset();
        });
    }
    selectciviliddata1(value) {
        this.enterprise.stafffetchdata1(value).subscribe(data => {
            this.staffslist = data.data;
        });
    }
    // highselectciviliddata(value){
    //   this.enterprise.highrolefetchdata(value).subscribe(data => {
    //     this.highrolelist = data.data;
    //   });  
    // }
    highroledata() {
        this.enterprise.gethighrolefetchlist(this.relopk).subscribe(data => {
            this.highrolelist = data.data.highroledata;
        });
    }
    selectcivilid(value) {
        this.staffslist.forEach(z => {
            if (z.staffinforepo_pk == value) {
                this.adduserform.emailid.setValue(z.sir_emailid);
                this.adduserform.civilno.setValue(z.sir_idnumber);
                this.adduserform.rolecentre.setValue(z.rm_rolename_en);
                this.adduserform.mobilenumber.setValue(z.countrycode + z.sir_mobnum);
                this.adduserform.staffrepopk.setValue(z.staffinforepo_pk);
                this.adduserform.stafName.setValue(z.sir_name_en);
                console.log(z, this.adduserform.mobilenumber.setValue(z.countrycode + z.sir_mobnum) + "mobileno");
                this.updated = true;
            }
        });
    }
    selectcivilidcentre(value) {
        this.userroleallocation = true;
        this.staffslistcentre.forEach(a => {
            if (a.staffinforepo_pk == value) {
                this.cntreform.emailidcentre.setValue(a.sir_emailid);
                this.cntreform.civilnocentre.setValue(a.sir_idnumber);
                this.cntreform.rolescentre.setValue(a.rm_rolename_en);
                this.cntreform.staffcentrerepopk.setValue(a.staffinforepo_pk);
                this.cntreform.staffsnamecentre.setValue(a.staffinforepo_pk);
                this.cntreform.mobilenumbercentre.setValue(a.countrycode + a.sir_mobnum);
                this.updated = true;
            }
        });
    }
    gotoback() {
        this.rolegridlistdata.emit(true);
        this.addrolecreation.emit(false);
    }
    scrollTo(className) {
        try {
            const elementList = document.querySelectorAll('.' + className);
            const element = elementList[0];
            element.scrollIntoView({ behavior: 'smooth' });
            console.log('page-content');
        }
        catch (error) {
        }
    }
    getuserroledata() {
        this.enterprise.getrolegriddtls().subscribe(data => {
            if (data.status == 200) {
                this.roledata.data = data['data'].roleList;
                this.resultsLength = this.roledata.data.length;
            }
        });
    }
    selectedStktype(value) {
        if (value == 1) {
            this.showrole = true;
            this.stkpk = 1;
            this.showhighrole = true;
            this.showevaltech = false;
            this.addroleform.controls['techeval'].reset();
            this.addroleform.controls['techeval'].setValidators(null);
            this.addroleform.controls['techeval'].updateValueAndValidity();
            this.addroleform.controls['arrolehigh'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.addroleform.controls['arrolehigh'].updateValueAndValidity();
        }
        else {
            this.stkpk = 2;
            this.showrole = true;
            this.showhighrole = false;
            this.showevaltech = true;
            this.addroleform.controls['arrolehigh'].reset();
            this.addroleform.controls['arrolehigh'].setValidators(null);
            this.addroleform.controls['arrolehigh'].updateValueAndValidity();
            this.addroleform.controls['techeval'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.addroleform.controls['techeval'].updateValueAndValidity();
        }
    }
    selectedStktypeuser(value) {
        if (value == 1) {
            this.opaladmindatashow = true;
            this.thirdaprtyshowopal = true;
            this.opaladmincentreshow = true;
            this.centredatashow = false;
            this.requiredtag = true;
            this.userroleallocation = true;
            this.updated = false;
            this.adduserroleform.controls['stafName'].reset();
            this.adduserroleform.controls['civilno'].reset();
            this.adduserroleform.controls['mobilenumber'].reset();
            this.adduserroleform.controls['emailid'].reset();
            this.adduserroleform.controls['stafnamecentre'].setValidators(null);
            this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity();
            this.adduserroleform.controls['stafnamecentre'].reset();
            this.adduserroleform.controls['centrename'].setValidators(null);
            this.adduserroleform.controls['centrename'].updateValueAndValidity();
            this.adduserroleform.controls['centrename'].reset();
            this.adduserroleform.controls['rolecentre'].setValidators(null);
            this.adduserroleform.controls['rolecentre'].updateValueAndValidity(null);
        }
        else {
            this.opaladmindatashow = true;
            this.centredatashow = true;
            this.thirdaprtyshowopal = false;
            this.opaladmincentreshow = false;
            this.userroleallocation = true;
            this.requiredtag = false;
            this.adduserroleform.controls['centrename'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.adduserroleform.controls['centrename'].updateValueAndValidity();
            this.adduserroleform.controls['stafName'].setValidators(null);
            this.adduserroleform.controls['stafName'].updateValueAndValidity();
            this.adduserroleform.controls['stafName'].reset();
            this.adduserroleform.controls['emailid'].setValidators(null);
            this.adduserroleform.controls['emailid'].updateValueAndValidity();
            this.adduserroleform.controls['emailid'].reset();
            this.adduserroleform.controls['mobilenumber'].setValidators(null);
            this.adduserroleform.controls['mobilenumber'].updateValueAndValidity();
            this.adduserroleform.controls['mobilenumber'].reset();
            this.adduserroleform.controls['civilno'].setValidators(null);
            this.adduserroleform.controls['civilno'].updateValueAndValidity();
            this.adduserroleform.controls['civilno'].reset();
            this.adduserroleform.controls['slider'].setValidators(null);
            this.adduserroleform.controls['slider'].updateValueAndValidity();
            this.adduserroleform.controls['slider'].reset();
            this.adduserroleform.controls['arroles'].setValidators(null);
            this.adduserroleform.controls['arroles'].updateValueAndValidity();
            this.adduserroleform.controls['arroles'].reset();
            this.adduserroleform.controls['stafnamecentre'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity();
        }
    }
    get isFormValueChanged() {
        return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.addroleform.value);
    }
    get ismoduleValueChanged() {
        if (this.addUserFromType == 1) {
            if (this.userPermission.length > 0) {
                return JSON.stringify(this.previousmoduleValue) !== JSON.stringify(this.userPermission);
            }
            else {
                return false;
            }
        }
        else {
            return true;
        }
    }
    editData(value, rolepk) {
        console.log(value.opalstkholdertypmst_pk, 'value_value');
        this.hidegrid = false;
        this.showrolegrid = true;
        this.apptype = 'edit';
        this.userroleallocation = true;
        // this.addUpdateAccess?.userAccessModification(this.previousmoduleValue);
        // console.log(this.addUpdateAccess,'this.addUpdateAccess');
        if (this.addUpdateAccess) {
            this.addUpdateAccess.dataSourceforpermission = [];
        }
        let role_pk = this.encrypt.encrypt(rolepk);
        this.postParams = {
            "rolepk": role_pk,
            "stkpk": value.opalstkholdertypmst_pk
        };
        this.currentUserPk = rolepk;
        this.postUrl = 'ea/enterpriseadmin/stk-update-user-details';
        this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(function (data) {
            var _a, _b, _c;
            if (data['data'].status == 0) {
                this.showWSuccess(data['data'].msg);
            }
            else {
                (_a = this.addUpdateAccess) === null || _a === void 0 ? void 0 : _a.userAccessModification((_c = (_b = data['data']) === null || _b === void 0 ? void 0 : _b.data) === null || _c === void 0 ? void 0 : _c.baseModulesAccess);
                this.previousmoduleValue = data['data'].data.baseModulesAccess;
                this.userPermission = data['data'].data.checkedAccess;
                // ---
            }
        }.bind(this));
        this.add_btn = false;
        if (value == 1) {
            this.showrole = true;
            this.showevaltech = false;
            this.showhighrole = true;
        }
        else {
            this.showrole = true;
            this.showevaltech = true;
        }
        this.addroleform.patchValue({
            stkholdertype: value.stakeholdertype == 'Centre' ? '2' : '1',
            techeval: value.projectname_en == 'Roadworthiness Assurance Standards (RAS)' ? '4' : '5',
            arrole: value.rolename_en,
            rolearbic: value.rolename_ar,
            arrolehigh: value.higherRole,
            rolerelpk: value.rolemst_pk,
        });
    }
    moduleClear() {
        var _a;
        if (this.addUpdateAccess) {
            (_a = this.addUpdateAccess) === null || _a === void 0 ? void 0 : _a.fullMOduleCheck();
            this.addUpdateAccess.finalpermissiontempinitialarray = [];
            this.addUpdateAccess.finalpermissiontemparray = [];
            this.addUpdateAccess.finalpermissionarray = [];
            this.userPermission = [];
            this.userPermissionsActivityLogs = [];
        }
    }
    userPermData(event) {
        console.log('module data', event);
        this.userPermission = event;
        this.userPermissionsActivityLogs = [];
        this.userPermissionsActivityLogs.push(this.userPermission);
    }
    ngOnChanges(changes) {
        this.userPermissionsActivityLogs = [];
        // if (this.triggercountrymst == 2) {
        //   this.getCountryList();
        // }
    }
    edituserData(value) {
        this.hideusergrid = false;
        this.usergrid = true;
        this.apptype = 'edit';
        this.add_btn = false;
        this.selectciviliddata1(value.oum_opalmemberregmst_fk);
        this.userroleallocation = true;
        // if(this.addUpdateAccess) {
        //   this.addUpdateAccess.dataSourceforpermission = [];
        // }
        // let role_pk = this.encrypt.encrypt(rolepk);
        // this.postParams = {
        //   "rolepk": role_pk
        // }
        // this.currentUserPk = rolepk;
        // this.postUrl = 'ea/enterpriseadmin/stk-update-user-details';
        // this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(
        //   function (data) {
        //     if (data['data'].status == 0) {
        //       this.showWSuccess(data['data'].msg);
        //     } else {
        //       this.addUpdateAccess?.userAccessModification(data['data']?.data?.baseModulesAccess);
        //       this.previousmoduleValue = data['data'].data.baseModulesAccess
        //       this.userPermission = data['data'].data.checkedAccess;
        //       // ---
        //     }
        //   }.bind(this)
        // );
        console.log(value, "archi_value_edit");
        if (value.stakeholdertype == 'Potal Admin (Super Admin)' || value.stakeholdertype == '' || value.stakeholdertype == null) {
            this.opaladmindatashow = true;
            this.thirdaprtyshowopal = true;
            this.opaladmincentreshow = true;
            this.centredatashow = false;
            this.requiredtag = true;
            this.adduserroleform.patchValue({
                stkholdertypeuser: value.stakeholdertype == 'Centre' ? '2' : '1',
                civilno: value.civilNo,
                stafName: value.stafName,
                emailid: value.emailid,
                mobilenumber: value.mobilno,
                arroles: value.rolemst_pk,
                slider: value.thirdPartyAgent == 'No' ? '2' : '1',
                opalusermstpk: value.opalusermst_pk,
            });
        }
        else {
            this.opaladmindatashow = true;
            this.centredatashow = true;
            this.thirdaprtyshowopal = false;
            this.opaladmincentreshow = false;
            this.requiredtag = false;
            this.adduserroleform.controls['centrename'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.adduserroleform.controls['centrename'].updateValueAndValidity();
            this.adduserroleform.controls['stafName'].setValidators(null);
            this.adduserroleform.controls['stafName'].updateValueAndValidity();
            this.adduserroleform.controls['emailid'].setValidators(null);
            this.adduserroleform.controls['emailid'].updateValueAndValidity();
            this.adduserroleform.controls['mobilenumber'].setValidators(null);
            this.adduserroleform.controls['mobilenumber'].updateValueAndValidity();
            this.adduserroleform.controls['civilno'].setValidators(null);
            this.adduserroleform.controls['civilno'].updateValueAndValidity();
            this.adduserroleform.controls['slider'].setValidators(null);
            this.adduserroleform.controls['slider'].updateValueAndValidity();
            this.adduserroleform.controls['arroles'].setValidators(null);
            this.adduserroleform.controls['arroles'].updateValueAndValidity();
            this.adduserroleform.controls['stafnamecentre'].setValidators([_angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]);
            this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity();
            this.adduserroleform.patchValue({
                stkholdertypeuser: value.stakeholdertype == 'Centre' ? '2' : '1',
                civilno: value.sir_idnumber,
                stafnamecentre: value.staffinforepo_pk,
                centrename: value.opalmemberregmst_pk,
                emailid: value.sir_emailid,
                mobilenumber: value.sir_mobnum,
                rolecentre: value.roleName_en,
                stafName: value.stafName,
                opalusermstpk: value.opalusermst_pk,
            });
        }
        console.log(value, "stafflist");
        // this.userdatapatch.forEach(z => {
        //   if (z.opalusermst_pk == value) {
        //     this.adduserroleform.patchValue({
        //       stkholdertypeuser: z.oshm_stakeholdertype,
        //     });
        //   }
        // });
    }
    evenadddata() {
        this.showrolegrid = true;
        this.hidegrid = false;
        this.apptype = 'new';
        this.add_btn = true;
        this.addrolform.stkholdertype.setValue('1');
        this.showrole = true;
        this.showhighrole = true;
        this.userroleallocation = true;
        this.stkpk = 1;
        this.showevaltech = false;
    }
    gotobackgrid() {
        this.closeview();
        this.showrolegrid = false;
        this.hidegrid = true;
        this.addroleform.reset();
    }
    evenuseradddata() {
        this.usergrid = true;
        this.hideusergrid = false;
        this.apptype = 'new';
        this.add_btn = true;
        this.adduserform.stkholdertypeuser.setValue('1');
        this.opaladmindatashow = true;
        this.thirdaprtyshowopal = true;
        this.opaladmincentreshow = true;
        this.centredatashow = false;
        this.requiredtag = true;
        this.userroleallocation = true;
    }
    evenusercentredata() {
        this.centregrid = true;
        this.hidecentregrid = false;
        this.apptype = 'new';
        this.add_btn = true;
    }
    gotocentrebackgrid() {
        this.closeview();
        this.centregrid = false;
        this.hidecentregrid = true;
        this.centreform.reset();
    }
    gotouserbackgrid() {
        this.closeview();
        this.usergrid = false;
        this.hideusergrid = true;
        this.adduserroleform.reset();
    }
    closeview() {
        this.viewBackBackbutton = false;
        if (this.refname == 1) {
            this.viewRoleUserdis = false;
            this.addroleform.controls['arrole'].enable();
            this.addroleform.controls['rolearbic'].enable();
            this.addroleform.controls['rolearbic'].enable();
        }
        else if (this.refname == 2) {
            this.viewUserdis = false;
            this.adduserroleform.controls['civilno'].enable();
            this.adduserroleform.controls['stafName'].enable();
            this.adduserroleform.controls['emailid'].enable();
            this.adduserroleform.controls['mobilenumber'].enable();
            this.adduserroleform.controls['rolecentre'].enable();
            this.adduserroleform.controls['slider'].enable();
        }
        else if (this.refname == 3) {
            this.viewCenterUserdis = false;
            this.centreform.controls['civilnocentre'].enable();
            this.centreform.controls['emailidcentre'].enable();
            this.centreform.controls['rolescentre'].enable();
            this.centreform.controls['mobilenumbercentre'].enable();
        }
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
    // getusergriddata(){
    //   this.enterprise.getusersgriddtls().subscribe(data=>{
    //     if(data.status == 200){
    //       this.userdata.data = data['data'].userList;
    //       this.resultsLength = this.userdata.data.length;
    //     }
    //   });
    // }
    editcentreData(value) {
        this.hidecentregrid = false;
        this.centregrid = true;
        this.apptype = 'edit';
        this.add_btn = false;
        this.userroleallocation = true;
        console.log(value, "centredata");
        this.centreform.patchValue({
            civilnocentre: value.sir_idnumber,
            staffsnamecentre: value.staffinforepo_pk,
            emailidcentre: value.sir_emailid,
            mobilenumbercentre: value.sir_mobnum,
            rolescentre: value.roleName_en,
            opalusermstpk: value.opalusermst_pk,
        });
    }
    getusercentergriddata() {
        this.enterprise.getUserCenterlistDtls().subscribe(data => {
            if (data.status == 200) {
                this.userCenter.data = data['data'].centerList;
                this.resultsLength = this.userCenter.data.length;
            }
        });
    }
    getManageRolesDtls() {
        this.UsersGridDatas = new ManageRoleGlistPagination(this.http);
        this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
        var gridsearchvalue = {};
        if (this.refname == 1) {
            gridsearchvalue = {
                stktypesearch: this.stktypesearch.value,
                projectsearch: this.projectsearch.value,
                rolesearch: this.rolesearch.value,
                highrolesearch: this.highrolesearch.value,
                statussearch: this.statussearch.value,
                addedonsearch: this.addedonsearch.value,
                updatedonsearch: this.updatedonsearch.value
            };
            Object(rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_18__["merge"])(this.sort.sortChange)
                .pipe(Object(rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_20__["startWith"])({}), Object(rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_21__["switchMap"])(() => {
                return this.UsersGridDatas.rolesGridList(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.page, JSON.stringify(gridsearchvalue, this.refname));
            }), Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_22__["map"])(data => {
                this.resultsLength = data['data'].data.totalcount;
                return data['data'].data.data;
            }), Object(rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_23__["catchError"])(() => {
                return Object(rxjs_observable_of__WEBPACK_IMPORTED_MODULE_17__["of"])([]);
            })).subscribe(data => {
                this.Usersrecord = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__["MatTableDataSource"](data);
                this.Usersrecord.filterPredicate = this.createFilter();
                this.noData = this.Usersrecord.connect().pipe(Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_22__["map"])(data => data.length === 0));
            });
        }
        else if (this.refname == 2) {
            gridsearchvalue = { stafName: this.stafName.value,
                emailid: this.emailid.value,
                stakeholdertype: this.stakeholdertype.value,
                oum_idnumber: this.civilNo.value,
                mobilno: this.mobilno.value,
                roleName_en: this.roleName_en.value,
                status: this.status.value,
                isthirdPartyAgent: this.isthirdPartyAgent.value,
                addedOn: this.addedOn.value,
                lastUpdateOn: this.lastUpdateOn.value
            };
            Object(rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_18__["merge"])(this.sort.sortChange)
                .pipe(Object(rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_20__["startWith"])({}), Object(rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_21__["switchMap"])(() => {
                return this.UsersGridDatas.usersGridList(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.page, JSON.stringify(gridsearchvalue, this.refname));
            }), Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_22__["map"])(data => {
                this.resultsLength = data['data'].data.totalcount;
                return data['data'].data.data;
            }), Object(rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_23__["catchError"])(() => {
                return Object(rxjs_observable_of__WEBPACK_IMPORTED_MODULE_17__["of"])([]);
            })).subscribe(data => {
                this.Usersrecord = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__["MatTableDataSource"](data);
                this.Usersrecord.filterPredicate = this.createFilter();
                this.noData = this.Usersrecord.connect().pipe(Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_22__["map"])(data => data.length === 0));
            });
        }
        else if (this.refname == 3) {
            gridsearchvalue = {
                stafName: this.stafName.value,
                emailid: this.emailid.value,
                oum_idnumber: this.civilNo.value,
                mobilno: this.mobilno.value,
                roleName_en: this.roleName_en.value,
                status: this.status.value,
                addedOn: this.addedOn.value,
                lastUpdateOn: this.lastUpdateOn.value
            };
            Object(rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_18__["merge"])(this.sort.sortChange)
                .pipe(Object(rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_20__["startWith"])({}), Object(rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_21__["switchMap"])(() => {
                return this.UsersGridDatas.usersCenterGridList(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.page, JSON.stringify(gridsearchvalue, this.refname));
            }), Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_22__["map"])(data => {
                this.resultsLength = data['data'].data.totalcount;
                return data['data'].data.data;
            }), Object(rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_23__["catchError"])(() => {
                return Object(rxjs_observable_of__WEBPACK_IMPORTED_MODULE_17__["of"])([]);
            })).subscribe(data => {
                this.Usersrecord = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__["MatTableDataSource"](data);
                this.Usersrecord.filterPredicate = this.createFilter();
                this.noData = this.Usersrecord.connect().pipe(Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_22__["map"])(data => data.length === 0));
            });
        }
    }
    createFilter() {
        let filterFunction = function (data, filter) {
            if (this.refname == 1) {
                let searchTerms = JSON.parse(filter);
                return data.stakeholdertype.toLowerCase().indexOf(searchTerms.stakeholdertype) !== -1 &&
                    data.projectname_en.toLowerCase().indexOf(searchTerms.projectname_en) !== -1 &&
                    data.rolename_en.toLowerCase().indexOf(searchTerms.rolename_en) !== -1 &&
                    data.higherRole.toLowerCase().indexOf(searchTerms.higherRole) !== -1 &&
                    data.status.toLowerCase().indexOf(searchTerms.status) !== -1 &&
                    data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 &&
                    data.updatedOn.toLowerCase().indexOf(searchTerms.updatedOn) !== -1;
            }
            else if (this.refname == 2) {
                let searchTerms = JSON.parse(filter);
                return data.stafName.toLowerCase().indexOf(searchTerms.stafName) !== -1 &&
                    data.emailid.toLowerCase().indexOf(searchTerms.emailid) !== -1 &&
                    data.stakeholdertype.toLowerCase().indexOf(searchTerms.stakeholdertype) !== -1 &&
                    data.civilNo.toLowerCase().indexOf(searchTerms.civilNo) !== -1 &&
                    data.mobilno.toLowerCase().indexOf(searchTerms.mobilno) !== -1 &&
                    data.roleName_en.toLowerCase().indexOf(searchTerms.roleName_en) !== -1 &&
                    data.status.toLowerCase().indexOf(searchTerms.status) !== -1 &&
                    data.isthirdPartyAgent.toLowerCase().indexOf(searchTerms.isthirdPartyAgent) !== -1 &&
                    data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 &&
                    data.lastUpdateOn.toLowerCase().indexOf(searchTerms.lastUpdateOn) !== -1;
            }
            else if (this.refname == 3) {
                let searchTerms = JSON.parse(filter);
                return data.stafName.toLowerCase().indexOf(searchTerms.stafName) !== -1 &&
                    data.emailid.toLowerCase().indexOf(searchTerms.emailid) !== -1 &&
                    data.civilNo.toLowerCase().indexOf(searchTerms.civilNo) !== -1 &&
                    data.mobilno.toLowerCase().indexOf(searchTerms.mobilno) !== -1 &&
                    data.roleName_en.toLowerCase().indexOf(searchTerms.roleName_en) !== -1 &&
                    data.status.toLowerCase().indexOf(searchTerms.status) !== -1 &&
                    data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 &&
                    data.lastUpdateOn.toLowerCase().indexOf(searchTerms.lastUpdateOn) !== -1;
            }
        };
        return filterFunction;
    }
    // view fuction is for all Role,user and center.
    viewRoleuser(value, rolepk) {
        this.viewBackBackbutton = true;
        if (this.refname == 1) {
            this.editData(value, rolepk);
            this.viewRoleUserdis = true;
            if (this.viewRoleUserdis) {
                this.addroleform.controls['arrole'].disable();
                this.addroleform.controls['rolearbic'].disable();
            }
        }
        else if (this.refname == 2) {
            this.edituserData(value);
            this.viewUserdis = true;
            if (this.viewUserdis) {
                this.adduserroleform.controls['civilno'].disable();
                this.adduserroleform.controls['stafName'].disable();
                this.adduserroleform.controls['emailid'].disable();
                this.adduserroleform.controls['mobilenumber'].disable();
                this.adduserroleform.controls['rolecentre'].disable();
                this.adduserroleform.controls['slider'].disable();
            }
        }
        else {
            this.editcentreData(value);
            this.viewCenterUserdis = true;
            if (this.viewCenterUserdis) {
                this.centreform.controls['civilnocentre'].disable();
                this.centreform.controls['emailidcentre'].disable();
                this.centreform.controls['rolescentre'].disable();
                this.centreform.controls['mobilenumbercentre'].disable();
            }
        }
    }
    ifchange() {
        this.change.emit();
    }
};
AddrolesComponent.ctorParameters = () => [
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] },
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__["TranslateService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_10__["ActivatedRoute"] },
    { type: _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_9__["EnterpriseadminService"] },
    { type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__["Encrypt"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_6__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"] },
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_15__["HttpClient"] },
    { type: _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_26__["AppLocalStorageServices"] },
    { type: _app_services_application_service__WEBPACK_IMPORTED_MODULE_25__["ApplicationService"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('addUpdateAccess'),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _app_shared_sidepanel_userallocation_userallocation_component__WEBPACK_IMPORTED_MODULE_11__["UserallocationComponent"])
], AddrolesComponent.prototype, "addUpdateAccess", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_24__["MatPaginator"])
], AddrolesComponent.prototype, "paginator", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_19__["MatSort"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_19__["MatSort"])
], AddrolesComponent.prototype, "sort", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], AddrolesComponent.prototype, "addrolecreation", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], AddrolesComponent.prototype, "rolegridlistdata", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], AddrolesComponent.prototype, "change", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", String)
], AddrolesComponent.prototype, "popupContentPrefix", void 0);
AddrolesComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-addroles',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./addroles.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/addroles/addroles.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        providers: [
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_3__["DateAdapter"], useClass: _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_12__["MomentDateAdapter"], deps: [_angular_material_core__WEBPACK_IMPORTED_MODULE_3__["MAT_DATE_LOCALE"]] },
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_3__["MAT_DATE_FORMATS"], useValue: MY_FORMATS },
        ],
        animations: [
            Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["trigger"])('detailExpand', [
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '0px', minHeight: '0' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('expanded', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '*' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["transition"])('expanded <=> collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["animate"])('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
            ]),
        ],
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./addroles.component.scss */ "./src/app/modules/newenterpriseadmin/addroles/addroles.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _ngx_translate_core__WEBPACK_IMPORTED_MODULE_7__["TranslateService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_10__["ActivatedRoute"],
        _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_9__["EnterpriseadminService"],
        _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_14__["Encrypt"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_6__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_8__["CookieService"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_15__["HttpClient"],
        _app_common_localstorage_applocalstorage_services__WEBPACK_IMPORTED_MODULE_26__["AppLocalStorageServices"],
        _app_services_application_service__WEBPACK_IMPORTED_MODULE_25__["ApplicationService"]])
], AddrolesComponent);

class ManageRoleGlistPagination {
    constructor(http) {
        this.http = http;
    }
    rolesGridList(sort, order, page, size, gridsearchValues, refname) {
        const href = _env_environment__WEBPACK_IMPORTED_MODULE_16__["environment"].baseUrl + 'ea/enterpriseadmin/getrolesdtls';
        const sign = (order === 'desc') ? '-' : '';
        const requestUrl = `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
        return this.http.get(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
    usersGridList(sort, order, page, size, gridsearchValues, refname) {
        const href = _env_environment__WEBPACK_IMPORTED_MODULE_16__["environment"].baseUrl + 'ea/enterpriseadmin/getusersdtls';
        const sign = (order === 'desc') ? '-' : '';
        const requestUrl = `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
        return this.http.get(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
    usersCenterGridList(sort, order, page, size, gridsearchValues, refname) {
        const href = _env_environment__WEBPACK_IMPORTED_MODULE_16__["environment"].baseUrl + 'ea/enterpriseadmin/getusercenterlist';
        const sign = (order === 'desc') ? '-' : '';
        const requestUrl = `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
        return this.http.get(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}


/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/addusers/addusers.component.scss":
/*!*****************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/addusers/addusers.component.scss ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#addusers .disabledsubmit {\n  background: #ececec !important;\n  border: 1px solid #ececec !important;\n  color: #999 !important;\n}\n#addusers .addusersnew {\n  padding: 0 30px;\n  margin-bottom: 50px;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#addusers .addusersnew .mat-form-field-appearance-outline .mat-form-field-suffix .mat-icon {\n  color: #888;\n}\n#addusers .addusersnew .aligncenter {\n  display: flex;\n  align-items: center;\n}\n#addusers .addusersnew .aligncenter .mat-icon {\n  width: 16px;\n  height: 16px;\n  color: #666;\n  cursor: pointer;\n  font-size: 20px;\n  margin-top: 5px;\n}\n#addusers .addusersnew .permissiontable {\n  width: 100%;\n  /* Hide the browser's default checkbox */\n  /* Create a custom checkbox */\n  /* On mouse-over, add a grey background color */\n  /* When the checkbox is checked, add a blue background */\n  /* When the checkbox is disabled, add a blue background */\n  /* Create the checkmark/indicator (hidden when not checked) */\n  /* Show the checkmark when checked */\n  /* Style the checkmark/indicator */\n}\n#addusers .addusersnew .permissiontable table {\n  width: 100%;\n  box-shadow: none;\n}\n#addusers .addusersnew .permissiontable tr.example-detail-row {\n  height: 0;\n}\n#addusers .addusersnew .permissiontable tr.example-element-row:not(.example-expanded-row):hover {\n  background: whitesmoke;\n}\n#addusers .addusersnew .permissiontable tr.example-element-row:not(.example-expanded-row):active {\n  background: #efefef;\n}\n#addusers .addusersnew .permissiontable .example-element-row td {\n  border-bottom-width: 0;\n}\n#addusers .addusersnew .permissiontable .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#addusers .addusersnew .permissiontable .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#addusers .addusersnew .permissiontable .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#addusers .addusersnew .permissiontable .example-element-description {\n  padding: 16px;\n}\n#addusers .addusersnew .permissiontable .example-element-description-attribution {\n  opacity: 0.5;\n}\n#addusers .addusersnew .permissiontable table th {\n  background: #eaedf2;\n  font-size: 14px;\n  color: #333;\n  font-weight: 600;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#addusers .addusersnew .permissiontable table th:first-child {\n  text-align: left;\n  min-width: 250px;\n}\n#addusers .addusersnew .permissiontable table td {\n  position: relative;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#addusers .addusersnew .permissiontable table td:first-child {\n  text-align: left;\n  min-width: 250px;\n  color: #0c4b9a;\n}\n#addusers .addusersnew .permissiontable table td .expandicon {\n  position: absolute;\n  right: 20px;\n  top: 50%;\n  transform: translateY(-50%);\n}\n#addusers .addusersnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n#addusers .addusersnew .permissiontable table td .subtable tr th, #addusers .addusersnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n#addusers .addusersnew .permissiontable table td .subtable tr td {\n  position: relative;\n  text-align: center;\n  min-width: 72px;\n  max-width: 72px;\n}\n#addusers .addusersnew .permissiontable table td .subtable tr td:first-child {\n  max-width: 240px;\n  min-width: 240px;\n  text-align: left;\n  color: #333333;\n}\n#addusers .addusersnew .permissiontable .checkcontainer {\n  display: inline-block;\n  position: relative;\n  margin-bottom: 12px;\n  padding-left: 25px;\n  cursor: pointer;\n  font-size: 22px;\n  -webkit-user-select: none;\n  -moz-user-select: none;\n  user-select: none;\n}\n#addusers .addusersnew .permissiontable .checkcontainer input {\n  position: absolute;\n  opacity: 0;\n  cursor: pointer;\n  height: 0;\n  width: 0;\n}\n#addusers .addusersnew .permissiontable .checkmark {\n  position: absolute;\n  top: 0;\n  left: 0;\n  height: 16px;\n  width: 16px;\n  background-color: #fff;\n  border: 1px solid #bbb;\n}\n#addusers .addusersnew .permissiontable .checkcontainer:hover input ~ .checkmark {\n  background-color: #ccc;\n}\n#addusers .addusersnew .permissiontable .checkcontainer input:checked ~ .checkmark {\n  background-color: #0c4b9a;\n}\n#addusers .addusersnew .permissiontable .checkcontainer input:disabled ~ .checkmark {\n  background-color: #ddd;\n  cursor: no-drop;\n}\n#addusers .addusersnew .permissiontable .checkmark:after {\n  content: \"\";\n  position: absolute;\n  display: none;\n}\n#addusers .addusersnew .permissiontable .checkcontainer input:checked ~ .checkmark:after {\n  display: block;\n}\n#addusers .addusersnew .permissiontable .checkcontainer .checkmark:after {\n  left: 4px;\n  top: 1px;\n  width: 4px;\n  height: 7px;\n  border: solid white;\n  border-width: 0 2px 2px 0;\n  transform: rotate(45deg);\n}\n#addusers .addusersnew .permissiontable .nopaddingtd {\n  padding: 0px !important;\n}\n#addusers .addusersnew .addbtn, #addusers .addusersnew .filterbtn {\n  min-width: 100px;\n}\n#addusers .addusersnew .addbtn {\n  background: #ed1c27;\n  color: #fff;\n}\n@media (max-width: 768px) {\n  #addusers .addusersnew .paddingspacing {\n    padding-right: 0px !important;\n    padding-left: 0px !important;\n  }\n  #addusers .addusersnew .permissiontable {\n    overflow: auto;\n  }\n}\n#addusers .addusersnew .mat-slide-toggle.mat-checked .mat-slide-toggle-thumb {\n  background-color: #00a551;\n}\n#addusers .addusersnew .mat-slide-toggle.mat-checked .mat-slide-toggle-bar {\n  background-color: #00a55062;\n}\n[dir=rtl] #addusers .addusersnew .permissiontable table th:first-child, .rtl #addusers .addusersnew .permissiontable table th:first-child {\n  text-align: right;\n}\n[dir=rtl] #addusers .addusersnew .permissiontable table td:first-child, .rtl #addusers .addusersnew .permissiontable table td:first-child {\n  text-align: right;\n}\n[dir=rtl] #addusers .addusersnew .permissiontable table td .expandicon, .rtl #addusers .addusersnew .permissiontable table td .expandicon {\n  position: absolute;\n  left: 20px;\n  right: auto;\n  top: 50%;\n  transform: translateY(-50%);\n}\n[dir=rtl] #addusers .addusersnew .permissiontable table td .expandicon .mat-icon, .rtl #addusers .addusersnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n[dir=rtl] #addusers .addusersnew .permissiontable table td .subtable tr th, [dir=rtl] #addusers .addusersnew .permissiontable table td .subtable thead, .rtl #addusers .addusersnew .permissiontable table td .subtable tr th, .rtl #addusers .addusersnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n[dir=rtl] #addusers .addusersnew .permissiontable table td .subtable tr td:first-child, .rtl #addusers .addusersnew .permissiontable table td .subtable tr td:first-child {\n  text-align: right;\n}\n[dir=rtl] #addusers .addusersnew .permissiontable .checkcontainer, .rtl #addusers .addusersnew .permissiontable .checkcontainer {\n  padding-right: 25px;\n  padding-left: 0px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vYWRkdXNlcnMvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcbmV3ZW50ZXJwcmlzZWFkbWluXFxhZGR1c2Vyc1xcYWRkdXNlcnMuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL2FkZHVzZXJzL2FkZHVzZXJzLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUNFO0VBQ0UsOEJBQUE7RUFDQSxvQ0FBQTtFQUNBLHNCQUFBO0FDQUo7QURFSTtFQUNJLGVBQUE7RUFDQSxtQkFBQTtBQ0FSO0FERVk7RUFDSSxjQUFBO0FDQWhCO0FER1k7RUFDSSwwQkFBQTtBQ0RoQjtBRElZO0VBQ0ksMEJBQUE7QUNGaEI7QURLWTtFQUNJLGNBQUE7QUNIaEI7QURNWTtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ0poQjtBRFFnQjtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ05wQjtBRFd3QjtFQUNJLGNBQUE7QUNUNUI7QURnQmdCO0VBQ0kseUJBQUE7QUNkcEI7QURvQmdCO0VBQ0ksY0FBQTtFQUNBLHlCQUFBO0FDbEJwQjtBRHdCb0I7RUFDSSwwQ0FBQTtFQUNBLGNBQUE7QUN0QnhCO0FEd0J3QjtFQUNJLGNBQUE7QUN0QjVCO0FEMEJvQjtFQUNJLHFCQUFBO0FDeEJ4QjtBRDZCZ0I7RUFDSSxXQUFBO0FDM0JwQjtBRCtCUTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQzdCWjtBRDhCWTtFQUNJLFdBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0VBQ0EsZUFBQTtBQzVCaEI7QURnQ1E7RUFDSSxXQUFBO0VBbUhFLHdDQUFBO0VBU0EsNkJBQUE7RUFXQSwrQ0FBQTtFQUtBLHdEQUFBO0VBSUEseURBQUE7RUFNQSw2REFBQTtFQU9BLG9DQUFBO0VBS0Esa0NBQUE7QUN4TGQ7QUR1Qlk7RUFDSSxXQUFBO0VBQ0EsZ0JBQUE7QUNyQmhCO0FEd0JjO0VBQ0UsU0FBQTtBQ3RCaEI7QUR5QmM7RUFDRSxzQkFBQTtBQ3ZCaEI7QUQwQmM7RUFDRSxtQkFBQTtBQ3hCaEI7QUQyQmM7RUFDRSxzQkFBQTtBQ3pCaEI7QUQ0QmM7RUFDRSxnQkFBQTtFQUNBLGFBQUE7QUMxQmhCO0FENkJjO0VBQ0UsZUFBQTtFQUNBLHVCQUFBO0VBQ0EsWUFBQTtFQUNBLG9CQUFBO0VBQ0EsYUFBQTtFQUNBLGFBQUE7QUMzQmhCO0FEOEJjO0VBQ0UsaUJBQUE7RUFDQSxlQUFBO0VBQ0EsbUJBQUE7QUM1QmhCO0FEK0JjO0VBQ0UsYUFBQTtBQzdCaEI7QURnQ2M7RUFDRSxZQUFBO0FDOUJoQjtBRGdDYztFQUNJLG1CQUFBO0VBQ0EsZUFBQTtFQUNBLFdBQUE7RUFDQSxnQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNFLGVBQUE7QUM5QnBCO0FEK0JrQjtFQUNFLGdCQUFBO0VBQ0EsZ0JBQUE7QUM3QnBCO0FEZ0NjO0VBQ0ksa0JBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0FDOUJsQjtBRCtCa0I7RUFDRSxnQkFBQTtFQUNBLGdCQUFBO0VBQ0EsY0FBQTtBQzdCcEI7QUQrQmtCO0VBQ0ksa0JBQUE7RUFDQSxXQUFBO0VBQ0EsUUFBQTtFQUNBLDJCQUFBO0FDN0J0QjtBRDhCc0I7RUFDSSxXQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSxlQUFBO0FDNUIxQjtBRGdDb0I7RUFDSSx3QkFBQTtBQzlCeEI7QURnQ29CO0VBQ0ksa0JBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0FDOUJ4QjtBRCtCd0I7RUFDRSxnQkFBQTtFQUNBLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxjQUFBO0FDN0IxQjtBRGtDYztFQUNFLHFCQUFBO0VBQ0Esa0JBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7RUFDQSx5QkFBQTtFQUNBLHNCQUFBO0VBRUEsaUJBQUE7QUNoQ2hCO0FEb0NjO0VBQ0Usa0JBQUE7RUFDQSxVQUFBO0VBQ0EsZUFBQTtFQUNBLFNBQUE7RUFDQSxRQUFBO0FDbENoQjtBRHNDYztFQUNFLGtCQUFBO0VBQ0EsTUFBQTtFQUNBLE9BQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLHNCQUFBO0VBQ0Esc0JBQUE7QUNwQ2hCO0FEd0NjO0VBQ0Usc0JBQUE7QUN0Q2hCO0FEMENjO0VBQ0UseUJBQUE7QUN4Q2hCO0FEMkNjO0VBQ0Usc0JBQUE7RUFDQSxlQUFBO0FDekNoQjtBRDZDYztFQUNFLFdBQUE7RUFDQSxrQkFBQTtFQUNBLGFBQUE7QUMzQ2hCO0FEK0NjO0VBQ0UsY0FBQTtBQzdDaEI7QURpRGM7RUFDRSxTQUFBO0VBQ0EsUUFBQTtFQUNBLFVBQUE7RUFDQSxXQUFBO0VBQ0EsbUJBQUE7RUFDQSx5QkFBQTtFQUdBLHdCQUFBO0FDL0NoQjtBRGlEYztFQUNJLHVCQUFBO0FDL0NsQjtBRG9EUTtFQUNJLGdCQUFBO0FDbERaO0FEb0RRO0VBQ0ksbUJBQUE7RUFDQSxXQUFBO0FDbERaO0FEcURRO0VBQ0k7SUFDSSw2QkFBQTtJQUNBLDRCQUFBO0VDbkRkO0VEcURVO0lBQ0ksY0FBQTtFQ25EZDtBQUNGO0FEdURnQjtFQUNJLHlCQUFBO0FDckRwQjtBRHdEZ0I7RUFDSSwyQkFBQTtBQ3REcEI7QUR3RW9CO0VBQ0UsaUJBQUE7QUNyRXRCO0FEeUVvQjtFQUNFLGlCQUFBO0FDdkV0QjtBRHlFb0I7RUFDSSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxXQUFBO0VBQ0EsUUFBQTtFQUNBLDJCQUFBO0FDdkV4QjtBRHdFd0I7RUFDSSxXQUFBO0VBQ0EsWUFBQTtFQUNBLFdBQUE7RUFDQSxlQUFBO0FDdEU1QjtBRDBFc0I7RUFDSSx3QkFBQTtBQ3hFMUI7QUQyRTBCO0VBQ0UsaUJBQUE7QUN6RTVCO0FEOEVnQjtFQUNJLG1CQUFBO0VBQ0EsaUJBQUE7QUM1RXBCIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vYWRkdXNlcnMvYWRkdXNlcnMuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjYWRkdXNlcnN7XHJcbiAgLmRpc2FibGVkc3VibWl0e1xyXG4gICAgYmFja2dyb3VuZDogI2VjZWNlYyAhaW1wb3J0YW50O1xyXG4gICAgYm9yZGVyOiAxcHggc29saWQgI2VjZWNlYyAhaW1wb3J0YW50O1xyXG4gICAgY29sb3I6ICM5OTkgIWltcG9ydGFudDtcclxuICB9XHJcbiAgICAuYWRkdXNlcnNuZXd7XHJcbiAgICAgICAgcGFkZGluZzowIDMwcHg7XHJcbiAgICAgICAgbWFyZ2luLWJvdHRvbTo1MHB4O1xyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUge1xyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2Q5ZDlkOTtcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXN0YXJ0IHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDNweCAwIDAgM3B4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZW5kIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI0VEMUMyNztcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjNmJhNWVjO1xyXG4gICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICYubWF0LWZvY3VzZWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgXHJcbiAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcclxuICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2RjNGM2NDtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtLjlyZW0pIHNjYWxlKDAuNzUpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzg0ODQ4NDtcclxuICAgIFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtZ2FwIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtc3VmZml4e1xyXG4gICAgICAgICAgICAgICAgLm1hdC1pY29ue1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiM4ODg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgLmFsaWduY2VudGVye1xyXG4gICAgICAgICAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbntcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2NjY7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiA1cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5wZXJtaXNzaW9udGFibGV7XHJcbiAgICAgICAgICAgIHdpZHRoOjEwMCU7XHJcbiAgICAgICAgICAgIHRhYmxlIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgYm94LXNoYWRvdzpub25lO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICB0ci5leGFtcGxlLWRldGFpbC1yb3cge1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAwO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICB0ci5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6IHdoaXRlc21va2U7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIHRyLmV4YW1wbGUtZWxlbWVudC1yb3c6bm90KC5leGFtcGxlLWV4cGFuZGVkLXJvdyk6YWN0aXZlIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNlZmVmZWY7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGV0YWlsIHtcclxuICAgICAgICAgICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA4MHB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAycHggc29saWQgYmxhY2s7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHg7XHJcbiAgICAgICAgICAgICAgICBmb250LXdlaWdodDogbGlnaHRlcjtcclxuICAgICAgICAgICAgICAgIG1hcmdpbjogOHB4IDA7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDEwNHB4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LXN5bWJvbCB7XHJcbiAgICAgICAgICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogNDBweDtcclxuICAgICAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiBub3JtYWw7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMTZweDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XHJcbiAgICAgICAgICAgICAgICBvcGFjaXR5OiAwLjU7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIHRhYmxlIHRoe1xyXG4gICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZToxNHB4O1xyXG4gICAgICAgICAgICAgICAgICBjb2xvcjojMzMzO1xyXG4gICAgICAgICAgICAgICAgICBmb250LXdlaWdodDo2MDA7XHJcbiAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246Y2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICBtaW4td2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgICBtYXgtd2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjI1MHB4O1xyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIHRhYmxlIHRke1xyXG4gICAgICAgICAgICAgICAgICBwb3NpdGlvbjpyZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjpjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDo3NXB4O1xyXG4gICAgICAgICAgICAgICAgICBtYXgtd2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjI1MHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgLmV4cGFuZGljb257XHJcbiAgICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjphYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgICAgIHJpZ2h0OjIwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0b3A6NTAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOnRyYW5zbGF0ZVkoLTUwJSk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjojNjY2O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcjpwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIC5zdWJ0YWJsZXtcclxuICAgICAgICAgICAgICAgICAgICB0ciB0aCwgdGhlYWR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgdHIgdGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOnJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjcycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1heC13aWR0aDo3MnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIG1heC13aWR0aDogMjQwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOiAyNDBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IzMzMzMzMztcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEycHg7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6MjVweDtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMjJweDtcclxuICAgICAgICAgICAgICAgIC13ZWJraXQtdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICAtbW96LXVzZXItc2VsZWN0OiBub25lO1xyXG4gICAgICAgICAgICAgICAgLW1zLXVzZXItc2VsZWN0OiBub25lO1xyXG4gICAgICAgICAgICAgICAgdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIEhpZGUgdGhlIGJyb3dzZXIncyBkZWZhdWx0IGNoZWNrYm94ICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0IHtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDA7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDA7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogQ3JlYXRlIGEgY3VzdG9tIGNoZWNrYm94ICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDA7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiAwO1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDE2cHg7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOjFweCBzb2xpZCAjYmJiO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAvKiBPbiBtb3VzZS1vdmVyLCBhZGQgYSBncmV5IGJhY2tncm91bmQgY29sb3IgKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXI6aG92ZXIgaW5wdXQgfiAuY2hlY2ttYXJrIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNjY2M7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIFdoZW4gdGhlIGNoZWNrYm94IGlzIGNoZWNrZWQsIGFkZCBhIGJsdWUgYmFja2dyb3VuZCAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAvKiBXaGVuIHRoZSBjaGVja2JveCBpcyBkaXNhYmxlZCwgYWRkIGEgYmx1ZSBiYWNrZ3JvdW5kICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0OmRpc2FibGVkIH4gLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZGRkO1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOm5vLWRyb3A7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIENyZWF0ZSB0aGUgY2hlY2ttYXJrL2luZGljYXRvciAoaGlkZGVuIHdoZW4gbm90IGNoZWNrZWQpICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogU2hvdyB0aGUgY2hlY2ttYXJrIHdoZW4gY2hlY2tlZCAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogU3R5bGUgdGhlIGNoZWNrbWFyay9pbmRpY2F0b3IgKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXIgLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiA0cHg7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDFweDtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiA0cHg7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDdweDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogc29saWQgd2hpdGU7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItd2lkdGg6IDAgMnB4IDJweCAwO1xyXG4gICAgICAgICAgICAgICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XHJcbiAgICAgICAgICAgICAgICAtbXMtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gICAgICAgICAgICAgICAgdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAubm9wYWRkaW5ndGR7XHJcbiAgICAgICAgICAgICAgICAgIHBhZGRpbmc6MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLmFkZGJ0biwgLmZpbHRlcmJ0bntcclxuICAgICAgICAgICAgbWluLXdpZHRoOjEwMHB4O1xyXG4gICAgICAgIH1cclxuICAgICAgICAuYWRkYnRue1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiNlZDFjMjc7XHJcbiAgICAgICAgICAgIGNvbG9yOiNmZmY7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBAbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHsgICAgXHJcbiAgICAgICAgICAgIC5wYWRkaW5nc3BhY2luZyB7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLnBlcm1pc3Npb250YWJsZXtcclxuICAgICAgICAgICAgICAgIG92ZXJmbG93OmF1dG87XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgLm1hdC1zbGlkZS10b2dnbGUge1xyXG4gICAgICAgICAgICAmLm1hdC1jaGVja2VkIHtcclxuICAgICAgICAgICAgICAgIC5tYXQtc2xpZGUtdG9nZ2xlLXRodW1iIHtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDBhNTUxO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAubWF0LXNsaWRlLXRvZ2dsZS1iYXIge1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMGE1NTA2MjtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuLy8gICAgICAgICAudG9nZ2xle1xyXG4gICAgICAgICAgICBcclxuLy8gaGVpZ2h0OiA1OHB4O1xyXG4vLyBib3JkZXI6IDFweCBzb2xpZCAjRDlEOUQ5O1xyXG4vLyBib3JkZXItcmFkaXVzOiAycHg7XHJcbi8vIGNvbG9yOiM4NDg0ODQ7XHJcbi8vICAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcbltkaXI9XCJydGxcIl0sIC5ydGx7XHJcbiAgICAjYWRkdXNlcnN7XHJcbiAgICAgICAgLmFkZHVzZXJzbmV3e1xyXG4gICAgICAgICAgICAucGVybWlzc2lvbnRhYmxle1xyXG4gICAgICAgICAgICAgICAgdGFibGUgdGh7XHJcbiAgICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246cmlnaHQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgdGFibGUgdGR7XHJcbiAgICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246cmlnaHQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5leHBhbmRpY29ue1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjphYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbGVmdDoyMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICByaWdodDphdXRvO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0b3A6NTAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06dHJhbnNsYXRlWSgtNTAlKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1pY29ue1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDoxOHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IzY2NjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcjpwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5zdWJ0YWJsZXtcclxuICAgICAgICAgICAgICAgICAgICAgIHRyIHRoLCB0aGVhZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICB0ciB0ZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjpyaWdodDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDoyNXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDowcHg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSBcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0iLCIjYWRkdXNlcnMgLmRpc2FibGVkc3VibWl0IHtcbiAgYmFja2dyb3VuZDogI2VjZWNlYyAhaW1wb3J0YW50O1xuICBib3JkZXI6IDFweCBzb2xpZCAjZWNlY2VjICFpbXBvcnRhbnQ7XG4gIGNvbG9yOiAjOTk5ICFpbXBvcnRhbnQ7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IHtcbiAgcGFkZGluZzogMCAzMHB4O1xuICBtYXJnaW4tYm90dG9tOiA1MHB4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcbiAgY29sb3I6ICNkOWQ5ZDk7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xuICBib3JkZXItcmFkaXVzOiAwIDNweCAzcHggMDtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjMGM0YjlhO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWludmFsaWQubWF0LWZvcm0tZmllbGQtaW52YWxpZCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XG4gIGNvbG9yOiAjZGM0YzY0O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdC5tYXQtZm9ybS1maWVsZC1zaG91bGQtZmxvYXQgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0wLjlyZW0pIHNjYWxlKDAuNzUpO1xuICBjb2xvcjogIzg0ODQ4NDtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtY2FuLWZsb2F0Lm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xuICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCAubWF0LWljb24ge1xuICBjb2xvcjogIzg4ODtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLmFsaWduY2VudGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLmFsaWduY2VudGVyIC5tYXQtaWNvbiB7XG4gIHdpZHRoOiAxNnB4O1xuICBoZWlnaHQ6IDE2cHg7XG4gIGNvbG9yOiAjNjY2O1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGZvbnQtc2l6ZTogMjBweDtcbiAgbWFyZ2luLXRvcDogNXB4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHtcbiAgd2lkdGg6IDEwMCU7XG4gIC8qIEhpZGUgdGhlIGJyb3dzZXIncyBkZWZhdWx0IGNoZWNrYm94ICovXG4gIC8qIENyZWF0ZSBhIGN1c3RvbSBjaGVja2JveCAqL1xuICAvKiBPbiBtb3VzZS1vdmVyLCBhZGQgYSBncmV5IGJhY2tncm91bmQgY29sb3IgKi9cbiAgLyogV2hlbiB0aGUgY2hlY2tib3ggaXMgY2hlY2tlZCwgYWRkIGEgYmx1ZSBiYWNrZ3JvdW5kICovXG4gIC8qIFdoZW4gdGhlIGNoZWNrYm94IGlzIGRpc2FibGVkLCBhZGQgYSBibHVlIGJhY2tncm91bmQgKi9cbiAgLyogQ3JlYXRlIHRoZSBjaGVja21hcmsvaW5kaWNhdG9yIChoaWRkZW4gd2hlbiBub3QgY2hlY2tlZCkgKi9cbiAgLyogU2hvdyB0aGUgY2hlY2ttYXJrIHdoZW4gY2hlY2tlZCAqL1xuICAvKiBTdHlsZSB0aGUgY2hlY2ttYXJrL2luZGljYXRvciAqL1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHtcbiAgd2lkdGg6IDEwMCU7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdHIuZXhhbXBsZS1kZXRhaWwtcm93IHtcbiAgaGVpZ2h0OiAwO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRyLmV4YW1wbGUtZWxlbWVudC1yb3c6bm90KC5leGFtcGxlLWV4cGFuZGVkLXJvdyk6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiB3aGl0ZXNtb2tlO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRyLmV4YW1wbGUtZWxlbWVudC1yb3c6bm90KC5leGFtcGxlLWV4cGFuZGVkLXJvdyk6YWN0aXZlIHtcbiAgYmFja2dyb3VuZDogI2VmZWZlZjtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LXJvdyB0ZCB7XG4gIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmV4YW1wbGUtZWxlbWVudC1kZXRhaWwge1xuICBvdmVyZmxvdzogaGlkZGVuO1xuICBkaXNwbGF5OiBmbGV4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5leGFtcGxlLWVsZW1lbnQtZGlhZ3JhbSB7XG4gIG1pbi13aWR0aDogODBweDtcbiAgYm9yZGVyOiAycHggc29saWQgYmxhY2s7XG4gIHBhZGRpbmc6IDhweDtcbiAgZm9udC13ZWlnaHQ6IGxpZ2h0ZXI7XG4gIG1hcmdpbjogOHB4IDA7XG4gIGhlaWdodDogMTA0cHg7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmV4YW1wbGUtZWxlbWVudC1zeW1ib2wge1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgZm9udC1zaXplOiA0MHB4O1xuICBsaW5lLWhlaWdodDogbm9ybWFsO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xuICBwYWRkaW5nOiAxNnB4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24tYXR0cmlidXRpb24ge1xuICBvcGFjaXR5OiAwLjU7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGgge1xuICBiYWNrZ3JvdW5kOiAjZWFlZGYyO1xuICBmb250LXNpemU6IDE0cHg7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXdlaWdodDogNjAwO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1pbi13aWR0aDogNzVweDtcbiAgbWF4LXdpZHRoOiA3NXB4O1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRoOmZpcnN0LWNoaWxkIHtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbiAgbWluLXdpZHRoOiAyNTBweDtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCB7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgdGV4dC1hbGlnbjogY2VudGVyO1xuICBtaW4td2lkdGg6IDc1cHg7XG4gIG1heC13aWR0aDogNzVweDtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG4gIG1pbi13aWR0aDogMjUwcHg7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5leHBhbmRpY29uIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICByaWdodDogMjBweDtcbiAgdG9wOiA1MCU7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtNTAlKTtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuZXhwYW5kaWNvbiAubWF0LWljb24ge1xuICB3aWR0aDogMThweDtcbiAgaGVpZ2h0OiAxOHB4O1xuICBjb2xvcjogIzY2NjtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0ciB0aCwgI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0aGVhZCB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGQge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgbWluLXdpZHRoOiA3MnB4O1xuICBtYXgtd2lkdGg6IDcycHg7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkOmZpcnN0LWNoaWxkIHtcbiAgbWF4LXdpZHRoOiAyNDBweDtcbiAgbWluLXdpZHRoOiAyNDBweDtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbiAgY29sb3I6ICMzMzMzMzM7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyIHtcbiAgZGlzcGxheTogaW5saW5lLWJsb2NrO1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIG1hcmdpbi1ib3R0b206IDEycHg7XG4gIHBhZGRpbmctbGVmdDogMjVweDtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBmb250LXNpemU6IDIycHg7XG4gIC13ZWJraXQtdXNlci1zZWxlY3Q6IG5vbmU7XG4gIC1tb3otdXNlci1zZWxlY3Q6IG5vbmU7XG4gIC1tcy11c2VyLXNlbGVjdDogbm9uZTtcbiAgdXNlci1zZWxlY3Q6IG5vbmU7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyIGlucHV0IHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBvcGFjaXR5OiAwO1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGhlaWdodDogMDtcbiAgd2lkdGg6IDA7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrbWFyayB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgdG9wOiAwO1xuICBsZWZ0OiAwO1xuICBoZWlnaHQ6IDE2cHg7XG4gIHdpZHRoOiAxNnB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBib3JkZXI6IDFweCBzb2xpZCAjYmJiO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lcjpob3ZlciBpbnB1dCB+IC5jaGVja21hcmsge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjY2NjO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyayB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwYzRiOWE7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyIGlucHV0OmRpc2FibGVkIH4gLmNoZWNrbWFyayB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNkZGQ7XG4gIGN1cnNvcjogbm8tZHJvcDtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2ttYXJrOmFmdGVyIHtcbiAgY29udGVudDogXCJcIjtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBkaXNwbGF5OiBub25lO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyazphZnRlciB7XG4gIGRpc3BsYXk6IGJsb2NrO1xufVxuI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciAuY2hlY2ttYXJrOmFmdGVyIHtcbiAgbGVmdDogNHB4O1xuICB0b3A6IDFweDtcbiAgd2lkdGg6IDRweDtcbiAgaGVpZ2h0OiA3cHg7XG4gIGJvcmRlcjogc29saWQgd2hpdGU7XG4gIGJvcmRlci13aWR0aDogMCAycHggMnB4IDA7XG4gIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xuICAtbXMtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xuICB0cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLm5vcGFkZGluZ3RkIHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5hZGRidG4sICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLmZpbHRlcmJ0biB7XG4gIG1pbi13aWR0aDogMTAwcHg7XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5hZGRidG4ge1xuICBiYWNrZ3JvdW5kOiAjZWQxYzI3O1xuICBjb2xvcjogI2ZmZjtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wYWRkaW5nc3BhY2luZyB7XG4gICAgcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1sZWZ0OiAwcHggIWltcG9ydGFudDtcbiAgfVxuICAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUge1xuICAgIG92ZXJmbG93OiBhdXRvO1xuICB9XG59XG4jYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5tYXQtc2xpZGUtdG9nZ2xlLm1hdC1jaGVja2VkIC5tYXQtc2xpZGUtdG9nZ2xlLXRodW1iIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwYTU1MTtcbn1cbiNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLm1hdC1zbGlkZS10b2dnbGUubWF0LWNoZWNrZWQgLm1hdC1zbGlkZS10b2dnbGUtYmFyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogIzAwYTU1MDYyO1xufVxuXG5bZGlyPXJ0bF0gI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRoOmZpcnN0LWNoaWxkLCAucnRsICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0aDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuW2Rpcj1ydGxdICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCwgLnJ0bCAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQ6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbltkaXI9cnRsXSAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24sIC5ydGwgI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5leHBhbmRpY29uIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBsZWZ0OiAyMHB4O1xuICByaWdodDogYXV0bztcbiAgdG9wOiA1MCU7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtNTAlKTtcbn1cbltkaXI9cnRsXSAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24gLm1hdC1pY29uLCAucnRsICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuZXhwYW5kaWNvbiAubWF0LWljb24ge1xuICB3aWR0aDogMThweDtcbiAgaGVpZ2h0OiAxOHB4O1xuICBjb2xvcjogIzY2NjtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuW2Rpcj1ydGxdICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGgsIFtkaXI9cnRsXSAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRoZWFkLCAucnRsICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGgsIC5ydGwgI2FkZHVzZXJzIC5hZGR1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0aGVhZCB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cbltkaXI9cnRsXSAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkOmZpcnN0LWNoaWxkLCAucnRsICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGQ6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbltkaXI9cnRsXSAjYWRkdXNlcnMgLmFkZHVzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyLCAucnRsICNhZGR1c2VycyAuYWRkdXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIge1xuICBwYWRkaW5nLXJpZ2h0OiAyNXB4O1xuICBwYWRkaW5nLWxlZnQ6IDBweDtcbn0iXX0= */");

/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/addusers/addusers.component.ts":
/*!***************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/addusers/addusers.component.ts ***!
  \***************************************************************************/
/*! exports provided: AddusersComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AddusersComponent", function() { return AddusersComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_animations__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/animations */ "./node_modules/@angular/animations/__ivy_ngcc__/fesm2015/animations.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../enterpriseadmin.service */ "./src/app/modules/newenterpriseadmin/enterpriseadmin.service.ts");









const ELEMENT_DATA = [
    {
        id: 1,
        name: 'Module - 1',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 11,
                sname: 'SubModule - 1',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 12,
                sname: 'SubModule - 2',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 13,
                sname: 'SubModule - 3',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 2,
        name: 'Module - 2',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 21,
                sname: 'SubModule - 5',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 22,
                sname: 'SubModule - 6',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 23,
                sname: 'SubModule - 7',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 3,
        name: 'Module - 3',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 31,
                sname: 'SubModule - 7',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 32,
                sname: 'SubModule - 8',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 4,
        name: 'Module - 4',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 41,
                sname: 'SubModule - 9',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 42,
                sname: 'SubModule - 10',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }
];
let AddusersComponent = class AddusersComponent {
    constructor(formBuilder, translate, remoteService, cookieService, enterprise) {
        this.formBuilder = formBuilder;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.enterprise = enterprise;
        this.addrolecreation = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.rolegridlistdata = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
        this.Submitted = true;
        this.showrole = false;
        this.civilno = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.stafname = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.emailid = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.mobilenumber = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.filterValues = {
            civilno: '',
            stafname: '',
            emailid: '',
            mobilenumber: ''
        };
        // public showhighrole:boolean = true;
        // public showevaltech:boolean = true;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_3__["ErrorStateMatcher"]();
        this.dataSource = ELEMENT_DATA;
        this.opaladmindatashow = false;
        this.centredatashow = false;
        this.thirdaprtyshowopal = false;
        this.columnsToDisplay = ['name', 'create', 'update', 'delete', 'approve', 'download'];
        this.innerDisplayedColumns = ['sname', 'screate', 'supdate', 'sdelete', 'sapprove', 'sdownload'];
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
    }
    ngOnInit() {
        this.initializeForm();
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
    }
    initializeForm() {
        this.adduserroleform = this.formBuilder.group({
            stkholdertype: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            civilno: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            stafname: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            emailid: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            mobilenumber: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            thirdpartyagent: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            arrole: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            arrolehigh: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required],
            centrename: [null, _angular_forms__WEBPACK_IMPORTED_MODULE_2__["Validators"].required]
        });
    }
    selectedStktype(value) {
        if (value == 1) {
            this.opaladmindatashow = true;
            this.thirdaprtyshowopal = true;
            this.centredatashow = false;
        }
        else if (value == 2 || value == 3) {
            this.opaladmindatashow = true;
            this.centredatashow = true;
            this.thirdaprtyshowopal = false;
        }
        else {
            this.opaladmindatashow = false;
            this.centredatashow = false;
            this.thirdaprtyshowopal = false;
        }
    }
    scrollTo(className) {
        try {
            const elementList = document.querySelectorAll('.' + className);
            const element = elementList[0];
            element.scrollIntoView({ behavior: 'smooth' });
            console.log('page-content');
        }
        catch (error) {
            // console.log('page-content')
        }
    }
    gotoback() {
        this.rolegridlistdata.emit(true);
        this.addrolecreation.emit(false);
    }
    get addrolform() {
        return this.adduserroleform.controls;
    }
};
AddusersComponent.ctorParameters = () => [
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] },
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"] },
    { type: _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_8__["EnterpriseadminService"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], AddusersComponent.prototype, "addrolecreation", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", Object)
], AddusersComponent.prototype, "rolegridlistdata", void 0);
AddusersComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-addusers',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./addusers.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/addusers/addusers.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        animations: [
            Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["trigger"])('detailExpand', [
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '0px', minHeight: '0' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('expanded', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '*' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["transition"])('expanded <=> collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["animate"])('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
            ]),
        ],
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./addusers.component.scss */ "./src/app/modules/newenterpriseadmin/addusers/addusers.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"],
        _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_8__["EnterpriseadminService"]])
], AddusersComponent);



/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.scss":
/*!***********************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.scss ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#manageroles tr.mat-row,\n#manageroles tr.mat-footer-row {\n  height: auto !important;\n  border-bottom: 1px solid #ddd;\n}\n#manageroles tr.mat-row:last-child,\n#manageroles tr.mat-footer-row:last-child {\n  border-bottom: none !important;\n}\n#manageroles th.mat-header-cell,\n#manageroles td.mat-cell,\n#manageroles td.mat-footer-cell {\n  border-bottom-style: none !important;\n}\n#manageroles .example-element-row td {\n  border-bottom-width: 0;\n}\n#manageroles .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#manageroles .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#manageroles .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#manageroles .example-element-description {\n  padding: 16px;\n}\n#manageroles .example-element-description-attribution {\n  opacity: 0.5;\n}\n#manageroles .documentheader h4 {\n  color: #0c4b9a;\n}\n#manageroles .mat-paginator-page-size-label {\n  margin: 0px !important;\n}\n#manageroles .mat-paginator-container {\n  padding: 0px !important;\n}\n#manageroles .viewtextcolor {\n  color: #0c4b9a;\n}\n#manageroles .addbtn {\n  background: #ed1c27;\n  color: #fff;\n}\n#manageroles #searchrow,\n#manageroles #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#manageroles #searchrow .serachrow,\n#manageroles #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n  padding-top: 10px;\n}\n#manageroles .paginationwithfilter {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#manageroles .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#manageroles .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#manageroles .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#manageroles .showtextcolor {\n  color: #262626;\n}\n#manageroles .redTxt {\n  color: #626366;\n  cursor: pointer;\n}\n#manageroles .viewhaderpdf img {\n  width: 40px;\n}\n#manageroles .viewhaderpdf p {\n  color: #262626;\n}\n#manageroles .print, #manageroles .cancelled, #manageroles .requestedback, #manageroles .requestedaccess, #manageroles .assessment, #manageroles .qualitycheck, #manageroles .teaching, #manageroles .newtag {\n  color: #00a551;\n  font-size: 0.9375rem;\n}\n#manageroles .newtag {\n  color: #ed1c27 !important;\n}\n#manageroles .teaching {\n  color: #f4811f !important;\n}\n#manageroles .qualitycheck {\n  color: #0c4b9a !important;\n}\n#manageroles .flexaligntag {\n  display: flex;\n  align-items: center;\n}\n#manageroles .assessment {\n  color: #C330CE;\n}\n#manageroles .requestedaccess {\n  color: #109d98;\n}\n#manageroles .requestedaccess {\n  color: #109d98;\n}\n#manageroles .requestedback {\n  color: #b14428;\n}\n#manageroles .cancelled {\n  color: #ed1c27;\n}\n#manageroles .update {\n  color: #0c4b9a;\n}\n#manageroles .declined {\n  color: #ed1c27;\n}\n#manageroles .new {\n  color: #f4811f;\n}\n#manageroles .approcedtagalign {\n  display: flex;\n  align-items: center;\n}\n#manageroles .approcedtagalign img {\n  padding-left: 15px;\n}\n#manageroles .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#manageroles .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#manageroles .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#manageroles .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#manageroles .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#manageroles .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: #d9d9d9 !important;\n}\n#manageroles .mat-sort-header-arrow {\n  color: #ED1C27;\n}\n#manageroles .nofound {\n  margin-top: 5%;\n}\n#manageroles .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#manageroles .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#manageroles .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#manageroles .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#manageroles .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#manageroles .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#manageroles .awaredtable .mat-cell {\n  color: #262626;\n}\n#manageroles .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n#manageroles .statustags {\n  background-color: #0c4b9a;\n  color: #fff;\n  border-radius: 2px;\n  padding: 3px 6px;\n}\n#manageroles .cancelbtn {\n  min-width: 110px;\n  background-color: #fff;\n  color: #333;\n  border: 1px solid #c4c4c4;\n  padding-left: 0px;\n  padding-right: 0px;\n  height: 45px;\n  box-shadow: none;\n}\n#manageroles .submit_btn {\n  background-color: #ED1C27 !important;\n  color: #fff !important;\n  min-width: 110px;\n  height: 45px;\n  box-shadow: none;\n}\n#manageroles .declinecmd {\n  border: 1px solid #ED1C27;\n  border-radius: 3px;\n  padding: 15px 15px 10px 15px;\n  background-color: #fff8f8;\n  height: auto;\n  width: 100%;\n}\n#manageroles .declinecmd .comment {\n  color: #ED1C27 !important;\n}\n#manageroles .declinecmd p {\n  color: #262626;\n}\n.actionmatmenu {\n  background: #666;\n  border-radius: 0px;\n  min-width: 100px;\n}\n.actionmatmenu .mat-menu-content button.mat-menu-item {\n  height: 28px;\n  color: #fff;\n  line-height: 28px;\n}\n@media (max-width: 768px) {\n  #manageroles .masterPageTop {\n    display: block !important;\n    justify-content: flex-start !important;\n  }\n  #manageroles .masterPageTop .mat-paginator-page-size-label {\n    margin: 0px !important;\n  }\n  #manageroles .masterPageTop .mat-paginator-container {\n    padding: 0px !important;\n    justify-content: flex-start !important;\n  }\n}\n@media (max-width: 767px) {\n  #manageroles .footerpaginator .mat-paginator-container {\n    display: block !important;\n  }\n  #manageroles .footerpaginator .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vbWFuYWdlcm9sZXMvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcbmV3ZW50ZXJwcmlzZWFkbWluXFxtYW5hZ2Vyb2xlc1xcbWFuYWdlcm9sZXMuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL21hbmFnZXJvbGVzL21hbmFnZXJvbGVzLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUVJOztFQUVJLHVCQUFBO0VBQ0EsNkJBQUE7QUNEUjtBREdROztFQUNJLDhCQUFBO0FDQVo7QURJSTs7O0VBR0ksb0NBQUE7QUNGUjtBRE1JO0VBQ0ksc0JBQUE7QUNKUjtBRE9JO0VBQ0ksZ0JBQUE7RUFDQSxhQUFBO0FDTFI7QURRSTtFQUNJLGVBQUE7RUFDQSx1QkFBQTtFQUNBLFlBQUE7RUFDQSxvQkFBQTtFQUNBLGFBQUE7RUFDQSxhQUFBO0FDTlI7QURTSTtFQUNJLGlCQUFBO0VBQ0EsZUFBQTtFQUNBLG1CQUFBO0FDUFI7QURVSTtFQUNJLGFBQUE7QUNSUjtBRFdJO0VBQ0ksWUFBQTtBQ1RSO0FEYVE7RUFDSSxjQUFBO0FDWFo7QURlSTtFQUNJLHNCQUFBO0FDYlI7QURnQkk7RUFDSSx1QkFBQTtBQ2RSO0FEaUJJO0VBQ0ksY0FBQTtBQ2ZSO0FEaUJJO0VBQ0ksbUJBQUE7RUFDQSxXQUFBO0FDZlI7QURpQkk7O0VBRUksMkJBQUE7RUFDQSxZQUFBO0FDZlI7QURpQlE7O0VBQ0ksMkJBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7QUNkWjtBRGtCSTtFQUNJLGFBQUE7RUFDQSw4QkFBQTtFQUNBLG1CQUFBO0FDaEJSO0FEcUJZO0VBQ0kseUJBQUE7RUFDQSxjQUFBO0FDbkJoQjtBRHFCZ0I7RUFDSSx5QkFBQTtBQ25CcEI7QUQyQlE7RUFDSSxhQUFBO0FDekJaO0FENkJJO0VBQ0ksY0FBQTtBQzNCUjtBRDhCSTtFQUNJLGNBQUE7RUFDQSxlQUFBO0FDNUJSO0FEZ0NRO0VBQ0ksV0FBQTtBQzlCWjtBRGlDUTtFQUNJLGNBQUE7QUMvQlo7QURtQ0k7RUFDSSxjQUFBO0VBQ0Esb0JBQUE7QUNqQ1I7QURvQ0k7RUFFSSx5QkFBQTtBQ25DUjtBRHNDSTtFQUVJLHlCQUFBO0FDckNSO0FEd0NJO0VBRUkseUJBQUE7QUN2Q1I7QUQwQ0k7RUFDSSxhQUFBO0VBQ0EsbUJBQUE7QUN4Q1I7QUQyQ0k7RUFFSSxjQUFBO0FDMUNSO0FENkNJO0VBRUksY0FBQTtBQzVDUjtBRCtDSTtFQUVJLGNBQUE7QUM5Q1I7QURpREk7RUFFSSxjQUFBO0FDaERSO0FEbURJO0VBRUksY0FBQTtBQ2xEUjtBRHFESTtFQUNJLGNBQUE7QUNuRFI7QURzREk7RUFDSSxjQUFBO0FDcERSO0FEdURJO0VBQ0ksY0FBQTtBQ3JEUjtBRHdESTtFQUNJLGFBQUE7RUFDQSxtQkFBQTtBQ3REUjtBRHdEUTtFQUNJLGtCQUFBO0FDdERaO0FEMERJO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQ3hEUjtBRDBEUTtFQUNJLFVBQUE7RUFDQSxXQUFBO0FDeERaO0FEMkRRO0VBQ0ksbUJBQUE7QUN6RFo7QUQ0RFE7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FDMURaO0FENkRRO0VBQ0ksZ0JBQUE7QUMzRFo7QURnRVE7RUFDSSxvQ0FBQTtBQzlEWjtBRGtFSTtFQUNJLGNBQUE7QUNoRVI7QURtRUk7RUFDSSxjQUFBO0FDakVSO0FEcUVRO0VBQ0ksV0FBQTtFQUNBLGVBQUE7QUNuRVo7QURzRVE7RUFDSSxjQUFBO0VBQ0EsZUFBQTtBQ3BFWjtBRHVFUTtFQUNJLFdBQUE7RUFDQSxlQUFBO0VBQ0EsMkJBQUE7QUNyRVo7QUR5RUk7RUFDSSxrQkFBQTtFQUNBLDRCQUFBO0VBQ0Esc0JBQUE7RUFDQSxnQkFBQTtBQ3ZFUjtBRHlFUTtFQUNJLG1CQUFBO0FDdkVaO0FEMEVRO0VBQ0ksb0NBQUE7QUN4RVo7QUQ0RVE7RUFDSSxjQUFBO0FDMUVaO0FENkVRO0VBQ0kseUJBQUE7RUFDQSx5QkFBQTtFQUNBLGVBQUE7QUMzRVo7QUQrRUk7RUFDSSx5QkFBQTtFQUNBLFdBQUE7RUFDQSxrQkFBQTtFQUNBLGdCQUFBO0FDN0VSO0FEZ0ZJO0VBQ0ksZ0JBQUE7RUFDQSxzQkFBQTtFQUNBLFdBQUE7RUFDQSx5QkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7QUM5RVI7QURpRkk7RUFDSSxvQ0FBQTtFQUNBLHNCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxZQUFBO0VBQ0EsZ0JBQUE7QUMvRVI7QURpRkk7RUFDSSx5QkFBQTtFQUNBLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSx5QkFBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0FDL0VSO0FEaUZRO0VBQ0kseUJBQUE7QUMvRVo7QURrRlE7RUFDSSxjQUFBO0FDaEZaO0FEcUZBO0VBQ0ksZ0JBQUE7RUFDQSxrQkFBQTtFQUNBLGdCQUFBO0FDbEZKO0FEb0ZRO0VBQ0ksWUFBQTtFQUNBLFdBQUE7RUFDQSxpQkFBQTtBQ2xGWjtBRHdGQTtFQUVRO0lBQ0kseUJBQUE7SUFDQSxzQ0FBQTtFQ3RGVjtFRHVGVTtJQUNPLHNCQUFBO0VDckZqQjtFRHVGVTtJQUNLLHVCQUFBO0lBQ0Esc0NBQUE7RUNyRmY7QUFDRjtBRDJGQTtFQUdZO0lBQ0kseUJBQUE7RUMzRmQ7RUQ2RlM7SUFDQyxzQkFBQTtFQzNGVjtBQUNGIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vbWFuYWdlcm9sZXMvbWFuYWdlcm9sZXMuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjbWFuYWdlcm9sZXMge1xyXG5cclxuICAgIHRyLm1hdC1yb3csXHJcbiAgICB0ci5tYXQtZm9vdGVyLXJvdyB7XHJcbiAgICAgICAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkZGQ7XHJcblxyXG4gICAgICAgICY6bGFzdC1jaGlsZCB7XHJcbiAgICAgICAgICAgIGJvcmRlci1ib3R0b206IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgdGgubWF0LWhlYWRlci1jZWxsLFxyXG4gICAgdGQubWF0LWNlbGwsXHJcbiAgICB0ZC5tYXQtZm9vdGVyLWNlbGwge1xyXG4gICAgICAgIGJvcmRlci1ib3R0b20tc3R5bGU6IG5vbmUgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcblxyXG4gICAgLmV4YW1wbGUtZWxlbWVudC1yb3cgdGQge1xyXG4gICAgICAgIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XHJcbiAgICB9XHJcblxyXG4gICAgLmV4YW1wbGUtZWxlbWVudC1kZXRhaWwge1xyXG4gICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgIH1cclxuXHJcbiAgICAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xyXG4gICAgICAgIG1pbi13aWR0aDogODBweDtcclxuICAgICAgICBib3JkZXI6IDJweCBzb2xpZCBibGFjaztcclxuICAgICAgICBwYWRkaW5nOiA4cHg7XHJcbiAgICAgICAgZm9udC13ZWlnaHQ6IGxpZ2h0ZXI7XHJcbiAgICAgICAgbWFyZ2luOiA4cHggMDtcclxuICAgICAgICBoZWlnaHQ6IDEwNHB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5leGFtcGxlLWVsZW1lbnQtc3ltYm9sIHtcclxuICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICBmb250LXNpemU6IDQwcHg7XHJcbiAgICAgICAgbGluZS1oZWlnaHQ6IG5vcm1hbDtcclxuICAgIH1cclxuXHJcbiAgICAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uIHtcclxuICAgICAgICBwYWRkaW5nOiAxNnB4O1xyXG4gICAgfVxyXG5cclxuICAgIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24tYXR0cmlidXRpb24ge1xyXG4gICAgICAgIG9wYWNpdHk6IDAuNTtcclxuICAgIH1cclxuXHJcbiAgICAuZG9jdW1lbnRoZWFkZXIge1xyXG4gICAgICAgIGg0IHtcclxuICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XHJcbiAgICAgICAgbWFyZ2luOiAwcHggIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC52aWV3dGV4dGNvbG9yIHtcclxuICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgIH1cclxuICAgIC5hZGRidG57XHJcbiAgICAgICAgYmFja2dyb3VuZDojZWQxYzI3O1xyXG4gICAgICAgIGNvbG9yOiNmZmY7XHJcbiAgICB9XHJcbiAgICAjc2VhcmNocm93LFxyXG4gICAgI2ZpbHRlcnNob3cge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcblxyXG4gICAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweDtcclxuICAgICAgICAgICAgcGFkZGluZy10b3A6IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hc3RlclBhZ2VUb3Age1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnNob3d0ZXh0Y29sb3Ige1xyXG4gICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgfVxyXG5cclxuICAgIC5yZWRUeHQge1xyXG4gICAgICAgIGNvbG9yOiAjNjI2MzY2O1xyXG4gICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAudmlld2hhZGVycGRmIHtcclxuICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICB3aWR0aDogNDBweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHAge1xyXG4gICAgICAgICAgICBjb2xvcjogIzI2MjYyNjtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnByaW50IHtcclxuICAgICAgICBjb2xvcjogIzAwYTU1MTtcclxuICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgIH1cclxuXHJcbiAgICAubmV3dGFnIHtcclxuICAgICAgICBAZXh0ZW5kIC5wcmludDtcclxuICAgICAgICBjb2xvcjogI2VkMWMyNyAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC50ZWFjaGluZyB7XHJcbiAgICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgICAgY29sb3I6ICNmNDgxMWYgIWltcG9ydGFudDtcclxuICAgIH1cclxuXHJcbiAgICAucXVhbGl0eWNoZWNrIHtcclxuICAgICAgICBAZXh0ZW5kIC5wcmludDtcclxuICAgICAgICBjb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5mbGV4YWxpZ250YWcge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAuYXNzZXNzbWVudCB7XHJcbiAgICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgICAgY29sb3I6ICNDMzMwQ0U7XHJcbiAgICB9XHJcblxyXG4gICAgLnJlcXVlc3RlZGFjY2VzcyB7XHJcbiAgICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgICAgY29sb3I6ICMxMDlkOTg7XHJcbiAgICB9XHJcblxyXG4gICAgLnJlcXVlc3RlZGFjY2VzcyB7XHJcbiAgICAgICAgQGV4dGVuZCAucHJpbnQ7XHJcbiAgICAgICAgY29sb3I6ICMxMDlkOTg7XHJcbiAgICB9XHJcblxyXG4gICAgLnJlcXVlc3RlZGJhY2sge1xyXG4gICAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICAgIGNvbG9yOiAjYjE0NDI4O1xyXG4gICAgfVxyXG5cclxuICAgIC5jYW5jZWxsZWQge1xyXG4gICAgICAgIEBleHRlbmQgLnByaW50O1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3O1xyXG4gICAgfVxyXG5cclxuICAgIC51cGRhdGUge1xyXG4gICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgfVxyXG5cclxuICAgIC5kZWNsaW5lZCB7XHJcbiAgICAgICAgY29sb3I6ICNlZDFjMjc7XHJcbiAgICB9XHJcblxyXG4gICAgLm5ldyB7XHJcbiAgICAgICAgY29sb3I6ICNmNDgxMWY7XHJcbiAgICB9XHJcblxyXG4gICAgLmFwcHJvY2VkdGFnYWxpZ24ge1xyXG4gICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuXHJcbiAgICAgICAgaW1nIHtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAxNXB4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuc2Nyb2xsZGF0YSB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIHotaW5kZXg6IDE7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICAgICAgICAgIHdpZHRoOiA2cHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNjY2M7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNkOWQ5ZDkgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XHJcbiAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICB9XHJcblxyXG4gICAgLm5vZm91bmQge1xyXG4gICAgICAgIG1hcmdpbi10b3A6IDUlO1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtc2VsZWN0LXZhbHVlIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYXdhcmVkdGFibGUge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDBweDtcclxuXHJcbiAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1yb3c6aG92ZXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1jZWxsIHtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWhlYWRlci1jZWxsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuc3RhdHVzdGFncyB7XHJcbiAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzBjNGI5YTtcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgcGFkZGluZzogM3B4IDZweDtcclxuICAgIH1cclxuXHJcbiAgICAuY2FuY2VsYnRuIHtcclxuICAgICAgICBtaW4td2lkdGg6IDExMHB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgY29sb3I6ICMzMzM7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI2M0YzRjNDtcclxuICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweDtcclxuICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICB9XHJcblxyXG4gICAgLnN1Ym1pdF9idG4ge1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNFRDFDMjcgIWltcG9ydGFudDtcclxuICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIG1pbi13aWR0aDogMTEwcHg7XHJcbiAgICAgICAgaGVpZ2h0OiA0NXB4O1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICB9XHJcbiAgICAuZGVjbGluZWNtZCB7XHJcbiAgICAgICAgYm9yZGVyOiAxcHggc29saWQgI0VEMUMyNztcclxuICAgICAgICBib3JkZXItcmFkaXVzOiAzcHg7XHJcbiAgICAgICAgcGFkZGluZzogMTVweCAxNXB4IDEwcHggMTVweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmOGY4O1xyXG4gICAgICAgIGhlaWdodDogYXV0bztcclxuICAgICAgICB3aWR0aDogMTAwJTtcclxuXHJcbiAgICAgICAgLmNvbW1lbnQge1xyXG4gICAgICAgICAgICBjb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgcCB7XHJcbiAgICAgICAgICAgIGNvbG9yOiAjMjYyNjI2O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5cclxuLmFjdGlvbm1hdG1lbnV7XHJcbiAgICBiYWNrZ3JvdW5kOiAjNjY2O1xyXG4gICAgYm9yZGVyLXJhZGl1czogMHB4O1xyXG4gICAgbWluLXdpZHRoOiAxMDBweDtcclxuICAgIC5tYXQtbWVudS1jb250ZW50e1xyXG4gICAgICAgIGJ1dHRvbi5tYXQtbWVudS1pdGVte1xyXG4gICAgICAgICAgICBoZWlnaHQ6MjhweDtcclxuICAgICAgICAgICAgY29sb3I6I2ZmZjtcclxuICAgICAgICAgICAgbGluZS1oZWlnaHQ6MjhweDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuXHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcclxuICAgICNtYW5hZ2Vyb2xlc3tcclxuICAgICAgICAubWFzdGVyUGFnZVRvcHtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbHtcclxuICAgICAgICAgICAgICAgICAgIG1hcmdpbjogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVye1xyXG4gICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICBcclxuICAgICAgIH1cclxuICAgIH1cclxufVxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XHJcbiAgICAjbWFuYWdlcm9sZXN7XHJcbiAgICAgICAgLmZvb3RlcnBhZ2luYXRvcntcclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVye1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICB9XHJcbiAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9uc3tcclxuICAgICAgICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICAgICB9XHJcbiAgICAgICAgIH1cclxuICAgIH1cclxufSIsIiNtYW5hZ2Vyb2xlcyB0ci5tYXQtcm93LFxuI21hbmFnZXJvbGVzIHRyLm1hdC1mb290ZXItcm93IHtcbiAgaGVpZ2h0OiBhdXRvICFpbXBvcnRhbnQ7XG4gIGJvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZGRkO1xufVxuI21hbmFnZXJvbGVzIHRyLm1hdC1yb3c6bGFzdC1jaGlsZCxcbiNtYW5hZ2Vyb2xlcyB0ci5tYXQtZm9vdGVyLXJvdzpsYXN0LWNoaWxkIHtcbiAgYm9yZGVyLWJvdHRvbTogbm9uZSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIHRoLm1hdC1oZWFkZXItY2VsbCxcbiNtYW5hZ2Vyb2xlcyB0ZC5tYXQtY2VsbCxcbiNtYW5hZ2Vyb2xlcyB0ZC5tYXQtZm9vdGVyLWNlbGwge1xuICBib3JkZXItYm90dG9tLXN0eWxlOiBub25lICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLmV4YW1wbGUtZWxlbWVudC1yb3cgdGQge1xuICBib3JkZXItYm90dG9tLXdpZHRoOiAwO1xufVxuI21hbmFnZXJvbGVzIC5leGFtcGxlLWVsZW1lbnQtZGV0YWlsIHtcbiAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgZGlzcGxheTogZmxleDtcbn1cbiNtYW5hZ2Vyb2xlcyAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xuICBtaW4td2lkdGg6IDgwcHg7XG4gIGJvcmRlcjogMnB4IHNvbGlkIGJsYWNrO1xuICBwYWRkaW5nOiA4cHg7XG4gIGZvbnQtd2VpZ2h0OiBsaWdodGVyO1xuICBtYXJnaW46IDhweCAwO1xuICBoZWlnaHQ6IDEwNHB4O1xufVxuI21hbmFnZXJvbGVzIC5leGFtcGxlLWVsZW1lbnQtc3ltYm9sIHtcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XG4gIGZvbnQtc2l6ZTogNDBweDtcbiAgbGluZS1oZWlnaHQ6IG5vcm1hbDtcbn1cbiNtYW5hZ2Vyb2xlcyAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uIHtcbiAgcGFkZGluZzogMTZweDtcbn1cbiNtYW5hZ2Vyb2xlcyAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uLWF0dHJpYnV0aW9uIHtcbiAgb3BhY2l0eTogMC41O1xufVxuI21hbmFnZXJvbGVzIC5kb2N1bWVudGhlYWRlciBoNCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI21hbmFnZXJvbGVzIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gIG1hcmdpbjogMHB4ICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcbiAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdlcm9sZXMgLnZpZXd0ZXh0Y29sb3Ige1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNtYW5hZ2Vyb2xlcyAuYWRkYnRuIHtcbiAgYmFja2dyb3VuZDogI2VkMWMyNztcbiAgY29sb3I6ICNmZmY7XG59XG4jbWFuYWdlcm9sZXMgI3NlYXJjaHJvdyxcbiNtYW5hZ2Vyb2xlcyAjZmlsdGVyc2hvdyB7XG4gIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcbiAgYm9yZGVyOiBub25lO1xufVxuI21hbmFnZXJvbGVzICNzZWFyY2hyb3cgLnNlcmFjaHJvdyxcbiNtYW5hZ2Vyb2xlcyAjZmlsdGVyc2hvdyAuc2VyYWNocm93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4taGVpZ2h0OiA3M3B4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG4gIHBhZGRpbmctdG9wOiAxMHB4O1xufVxuI21hbmFnZXJvbGVzIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNtYW5hZ2Vyb2xlcyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jbWFuYWdlcm9sZXMgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XG4gIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XG59XG4jbWFuYWdlcm9sZXMgLm1hc3RlclBhZ2VUb3AgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyBidXR0b24ge1xuICBkaXNwbGF5OiBub25lO1xufVxuI21hbmFnZXJvbGVzIC5zaG93dGV4dGNvbG9yIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jbWFuYWdlcm9sZXMgLnJlZFR4dCB7XG4gIGNvbG9yOiAjNjI2MzY2O1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4jbWFuYWdlcm9sZXMgLnZpZXdoYWRlcnBkZiBpbWcge1xuICB3aWR0aDogNDBweDtcbn1cbiNtYW5hZ2Vyb2xlcyAudmlld2hhZGVycGRmIHAge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNtYW5hZ2Vyb2xlcyAucHJpbnQsICNtYW5hZ2Vyb2xlcyAuY2FuY2VsbGVkLCAjbWFuYWdlcm9sZXMgLnJlcXVlc3RlZGJhY2ssICNtYW5hZ2Vyb2xlcyAucmVxdWVzdGVkYWNjZXNzLCAjbWFuYWdlcm9sZXMgLmFzc2Vzc21lbnQsICNtYW5hZ2Vyb2xlcyAucXVhbGl0eWNoZWNrLCAjbWFuYWdlcm9sZXMgLnRlYWNoaW5nLCAjbWFuYWdlcm9sZXMgLm5ld3RhZyB7XG4gIGNvbG9yOiAjMDBhNTUxO1xuICBmb250LXNpemU6IDAuOTM3NXJlbTtcbn1cbiNtYW5hZ2Vyb2xlcyAubmV3dGFnIHtcbiAgY29sb3I6ICNlZDFjMjcgIWltcG9ydGFudDtcbn1cbiNtYW5hZ2Vyb2xlcyAudGVhY2hpbmcge1xuICBjb2xvcjogI2Y0ODExZiAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIC5xdWFsaXR5Y2hlY2sge1xuICBjb2xvcjogIzBjNGI5YSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIC5mbGV4YWxpZ250YWcge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI21hbmFnZXJvbGVzIC5hc3Nlc3NtZW50IHtcbiAgY29sb3I6ICNDMzMwQ0U7XG59XG4jbWFuYWdlcm9sZXMgLnJlcXVlc3RlZGFjY2VzcyB7XG4gIGNvbG9yOiAjMTA5ZDk4O1xufVxuI21hbmFnZXJvbGVzIC5yZXF1ZXN0ZWRhY2Nlc3Mge1xuICBjb2xvcjogIzEwOWQ5ODtcbn1cbiNtYW5hZ2Vyb2xlcyAucmVxdWVzdGVkYmFjayB7XG4gIGNvbG9yOiAjYjE0NDI4O1xufVxuI21hbmFnZXJvbGVzIC5jYW5jZWxsZWQge1xuICBjb2xvcjogI2VkMWMyNztcbn1cbiNtYW5hZ2Vyb2xlcyAudXBkYXRlIHtcbiAgY29sb3I6ICMwYzRiOWE7XG59XG4jbWFuYWdlcm9sZXMgLmRlY2xpbmVkIHtcbiAgY29sb3I6ICNlZDFjMjc7XG59XG4jbWFuYWdlcm9sZXMgLm5ldyB7XG4gIGNvbG9yOiAjZjQ4MTFmO1xufVxuI21hbmFnZXJvbGVzIC5hcHByb2NlZHRhZ2FsaWduIHtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbiNtYW5hZ2Vyb2xlcyAuYXBwcm9jZWR0YWdhbGlnbiBpbWcge1xuICBwYWRkaW5nLWxlZnQ6IDE1cHg7XG59XG4jbWFuYWdlcm9sZXMgLnNjcm9sbGRhdGEge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHotaW5kZXg6IDE7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBvdmVyZmxvdy14OiBhdXRvO1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBzY3JvbGwtYmVoYXZpb3I6IHNtb290aDtcbn1cbiNtYW5hZ2Vyb2xlcyAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXIge1xuICB3aWR0aDogNnB4O1xuICBoZWlnaHQ6IDVweDtcbn1cbiNtYW5hZ2Vyb2xlcyAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xuICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xufVxuI21hbmFnZXJvbGVzIC5zY3JvbGxkYXRhOjotd2Via2l0LXNjcm9sbGJhci10aHVtYiB7XG4gIGJhY2tncm91bmQ6ICNjY2M7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbn1cbiNtYW5hZ2Vyb2xlcyAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWI6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xufVxuI21hbmFnZXJvbGVzIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Q5ZDlkOSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIC5tYXQtc29ydC1oZWFkZXItYXJyb3cge1xuICBjb2xvcjogI0VEMUMyNztcbn1cbiNtYW5hZ2Vyb2xlcyAubm9mb3VuZCB7XG4gIG1hcmdpbi10b3A6IDUlO1xufVxuI21hbmFnZXJvbGVzIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xufVxuI21hbmFnZXJvbGVzIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciAubWF0LXNlbGVjdC12YWx1ZSB7XG4gIGNvbG9yOiAjNjI2MzY2O1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jbWFuYWdlcm9sZXMgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgY29sb3I6ICM5OTk7XG4gIGZvbnQtc2l6ZTogMTVweDtcbiAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIC5hd2FyZWR0YWJsZSB7XG4gIGJvcmRlci1yYWRpdXM6IDJweDtcbiAgYmFja2dyb3VuZC1jbGlwOiBwYWRkaW5nLWJveDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgbWFyZ2luOiAxMHB4IDBweDtcbn1cbiNtYW5hZ2Vyb2xlcyAuYXdhcmVkdGFibGUgLm1hbmFnZW9wdGlvbnMge1xuICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xufVxuI21hbmFnZXJvbGVzIC5hd2FyZWR0YWJsZSAubWF0LXJvdzpob3ZlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmNWY1ZjUgIWltcG9ydGFudDtcbn1cbiNtYW5hZ2Vyb2xlcyAuYXdhcmVkdGFibGUgLm1hdC1jZWxsIHtcbiAgY29sb3I6ICMyNjI2MjY7XG59XG4jbWFuYWdlcm9sZXMgLmF3YXJlZHRhYmxlIC5tYXQtaGVhZGVyLWNlbGwge1xuICBjb2xvcjogIzYyNjM2NiAhaW1wb3J0YW50O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZWFlZGYyO1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jbWFuYWdlcm9sZXMgLnN0YXR1c3RhZ3Mge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xuICBjb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBwYWRkaW5nOiAzcHggNnB4O1xufVxuI21hbmFnZXJvbGVzIC5jYW5jZWxidG4ge1xuICBtaW4td2lkdGg6IDExMHB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBjb2xvcjogIzMzMztcbiAgYm9yZGVyOiAxcHggc29saWQgI2M0YzRjNDtcbiAgcGFkZGluZy1sZWZ0OiAwcHg7XG4gIHBhZGRpbmctcmlnaHQ6IDBweDtcbiAgaGVpZ2h0OiA0NXB4O1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI21hbmFnZXJvbGVzIC5zdWJtaXRfYnRuIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBtaW4td2lkdGg6IDExMHB4O1xuICBoZWlnaHQ6IDQ1cHg7XG4gIGJveC1zaGFkb3c6IG5vbmU7XG59XG4jbWFuYWdlcm9sZXMgLmRlY2xpbmVjbWQge1xuICBib3JkZXI6IDFweCBzb2xpZCAjRUQxQzI3O1xuICBib3JkZXItcmFkaXVzOiAzcHg7XG4gIHBhZGRpbmc6IDE1cHggMTVweCAxMHB4IDE1cHg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY4Zjg7XG4gIGhlaWdodDogYXV0bztcbiAgd2lkdGg6IDEwMCU7XG59XG4jbWFuYWdlcm9sZXMgLmRlY2xpbmVjbWQgLmNvbW1lbnQge1xuICBjb2xvcjogI0VEMUMyNyAhaW1wb3J0YW50O1xufVxuI21hbmFnZXJvbGVzIC5kZWNsaW5lY21kIHAge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cblxuLmFjdGlvbm1hdG1lbnUge1xuICBiYWNrZ3JvdW5kOiAjNjY2O1xuICBib3JkZXItcmFkaXVzOiAwcHg7XG4gIG1pbi13aWR0aDogMTAwcHg7XG59XG4uYWN0aW9ubWF0bWVudSAubWF0LW1lbnUtY29udGVudCBidXR0b24ubWF0LW1lbnUtaXRlbSB7XG4gIGhlaWdodDogMjhweDtcbiAgY29sb3I6ICNmZmY7XG4gIGxpbmUtaGVpZ2h0OiAyOHB4O1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI21hbmFnZXJvbGVzIC5tYXN0ZXJQYWdlVG9wIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB9XG4gICNtYW5hZ2Vyb2xlcyAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICAgIG1hcmdpbjogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgI21hbmFnZXJvbGVzIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xuICAjbWFuYWdlcm9sZXMgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbiAgI21hbmFnZXJvbGVzIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxufSJdfQ== */");

/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.ts":
/*!*********************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.ts ***!
  \*********************************************************************************/
/*! exports provided: MY_FORMATS, ManagerolesComponent, ManageRoleGlistPagination */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MY_FORMATS", function() { return MY_FORMATS; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ManagerolesComponent", function() { return ManagerolesComponent; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ManageRoleGlistPagination", function() { return ManageRoleGlistPagination; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material-moment-adapter */ "./node_modules/@angular/material-moment-adapter/__ivy_ngcc__/esm2015/material-moment-adapter.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../enterpriseadmin.service */ "./src/app/modules/newenterpriseadmin/enterpriseadmin.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _env_environment__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! @env/environment */ "./src/environments/environment.ts");
/* harmony import */ var rxjs_observable_of__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! rxjs/observable/of */ "./node_modules/rxjs-compat/_esm2015/observable/of.js");
/* harmony import */ var rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! rxjs/observable/merge */ "./node_modules/rxjs-compat/_esm2015/observable/merge.js");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
/* harmony import */ var rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! rxjs/operators/startWith */ "./node_modules/rxjs-compat/_esm2015/operators/startWith.js");
/* harmony import */ var rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! rxjs/operators/switchMap */ "./node_modules/rxjs-compat/_esm2015/operators/switchMap.js");
/* harmony import */ var rxjs_operators_map__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! rxjs/operators/map */ "./node_modules/rxjs-compat/_esm2015/operators/map.js");
/* harmony import */ var rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! rxjs/operators/catchError */ "./node_modules/rxjs-compat/_esm2015/operators/catchError.js");
/* harmony import */ var _app_services_application_service__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! @app/services/application.service */ "./src/app/services/application.service.ts");























// const roledata_data: Roledata[] = [
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Auditor",highrole:"CEO",status:"A",addedon:"24-01-2023",lastupdated:"24-03-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Assessor",highrole:"CEO",status:"I",addedon:"24-01-2023",lastupdated:"24-02-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Finance",highrole:"-",status:"A",addedon:"26-01-2023",lastupdated:"24-02-2023"},
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Authority",highrole:"Authority, CEO",status:"I",addedon:"24-01-2023",lastupdated:"29-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"Road Worthiness Assurance Standard (RAS)",role:"-",highrole:"Fire and Safety",status:"A",addedon:"24-01-2023",lastupdated:"28-01-2023"},
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Auditor",highrole:"CEO",status:"A",addedon:"24-01-2023",lastupdated:"27-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Assessor",highrole:"CEO",status:"I",addedon:"28-01-2023",lastupdated:"29-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"In-Vehicle Monitoring System (IVMS)",role:"Finance",highrole:"-",status:"A",addedon:"24-01-2023",lastupdated:"28-01-2023"},
//   { stktype: 'OPAL Admin',project:"Road Worthiness Assurance Standard (RAS)",role:"Authority",highrole:"Authority, CEO",status:"I",addedon:"26-01-2023",lastupdated:"27-01-2023"},
//   { stktype: 'Training Evaluation Centre',project:"Road Worthiness Assurance Standard (RAS)",role:"-",highrole:"Fire and Safety",status:"A",addedon:"24-01-2023",lastupdated:"28-01-2023"}
// ];
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
let ManagerolesComponent = class ManagerolesComponent {
    constructor(translate, remoteService, cookieService, enterprise, router, routeid, http, appservice) {
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.enterprise = enterprise;
        this.router = router;
        this.routeid = routeid;
        this.http = http;
        this.appservice = appservice;
        this.stktypesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.projectsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.rolesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.highrolesearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.statussearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.addedonsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.updatedonsearch = new _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormControl"]('');
        this.filterValues = {
            stktypesearch: '',
            projectsearch: '',
            rolesearch: '',
            highrolesearch: '',
            statussearch: '',
            addedonsearch: '',
            updatedonsearch: '',
        };
        this.rolesrecordcolumn = ['stakeholdertype', 'projectname_en', 'rolename_en', 'higherRole', 'status', 'addedOn', 'updatedOn', 'action'];
        // Rolesrecord: MatTableDataSource<Roledata>;
        // roledata : Roledata[];
        this.filtername = "Hide Filter";
        this.hidefilder = true;
        this.page = 10;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
        this.addrolecreationpage = false;
        this.rolegridlistpage = true;
        this.roledata = [];
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
        this.getuserroledata();
    }
    routeToroledata() {
        //this.router.navigate(['newenterpriseadmin/manageroles']);   
        this.addrolecreationpage = true;
    }
    viewroute() {
        this.router.navigate(['newenterpriseadmin/viewroles']);
    }
    gridlistdata(event) {
        this.rolegridlistpage = event;
    }
    addrolecreationdata(event) {
        this.addrolecreationpage = event;
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
    syncPrimaryPaginator(event) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.page = event.pageSize;
    }
    editBusinessSourceList() {
        this.router.navigate(['/newenterpriseadmin/addroles'], { queryParams: { type: 1 } });
    }
    scrollTo(className) {
        try {
            const elementList = document.querySelectorAll('.' + className);
            const element = elementList[0];
            element.scrollIntoView({ behavior: 'smooth' });
            console.log('page-content');
        }
        catch (error) {
            // console.log('page-content')
        }
    }
    onPaginateChange(event) {
        this.page = event.pageSize;
    }
    getuserroledata() {
        this.enterprise.getrolegriddtls().subscribe(data => {
            this.roledata.data = data['data'].roleList;
            this.resultsLength = this.roledata.data.length;
        });
    }
    editData(data) {
        this.roledata.forEach(roledata => {
            if (roledata.id == data.id) {
                console.log('sdfsdsd' + data.id);
            }
        });
    }
    getManageUserDtls() {
        this.UsersGridDatas = new ManageRoleGlistPagination(this.http);
        this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
        var gridsearchvalue = {};
        // gridsearchvalue = {stafName:this.stafName.value,
        //   emailid:this.emailid.value,
        //   stakeholdertype:this.stakeholdertype.value,
        //   civilNo:this.civilNo.value,
        //   mobilno:this.mobilno.value,
        //   roleName_en:this.roleName_en.value,
        //   status:this.status.value,
        //   isthirdPartyAgent:this.isthirdPartyAgent.value,
        //   addedOn:this.status.value,
        //   lastUpdateOn:this.status.value
        // };
        console.log(gridsearchvalue, 'Archana12');
        Object(rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_15__["merge"])(this.sort.sortChange)
            .pipe(Object(rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_17__["startWith"])({}), Object(rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_18__["switchMap"])(() => {
            return this.UsersGridDatas.rolesGridList(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.page, JSON.stringify(gridsearchvalue));
        }), Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_19__["map"])(data => {
            this.resultsLength = data['data'].data.totalcount;
            console.log(data['data'].data.data, 'data.data.data123');
            return data['data'].data.data;
        }), Object(rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_20__["catchError"])(() => {
            return Object(rxjs_observable_of__WEBPACK_IMPORTED_MODULE_14__["of"])([]);
        })).subscribe(data => {
            this.rolesrecord = new _angular_material_table__WEBPACK_IMPORTED_MODULE_6__["MatTableDataSource"](data);
            // this.Usersrecord.filterPredicate = this.createFilter();
        });
    }
};
ManagerolesComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_7__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__["CookieService"] },
    { type: _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_11__["EnterpriseadminService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_10__["Router"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_10__["ActivatedRoute"] },
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_12__["HttpClient"] },
    { type: _app_services_application_service__WEBPACK_IMPORTED_MODULE_21__["ApplicationService"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("MatPaginator"),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_5__["MatPaginator"])
], ManagerolesComponent.prototype, "paginator", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_16__["MatSort"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_16__["MatSort"])
], ManagerolesComponent.prototype, "sort", void 0);
ManagerolesComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-manageroles',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./manageroles.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        providers: [
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_4__["DateAdapter"], useClass: _angular_material_moment_adapter__WEBPACK_IMPORTED_MODULE_3__["MomentDateAdapter"], deps: [_angular_material_core__WEBPACK_IMPORTED_MODULE_4__["MAT_DATE_LOCALE"]] },
            { provide: _angular_material_core__WEBPACK_IMPORTED_MODULE_4__["MAT_DATE_FORMATS"], useValue: MY_FORMATS },
        ],
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./manageroles.component.scss */ "./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_8__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_7__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_9__["CookieService"],
        _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_11__["EnterpriseadminService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_10__["Router"],
        _angular_router__WEBPACK_IMPORTED_MODULE_10__["ActivatedRoute"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_12__["HttpClient"],
        _app_services_application_service__WEBPACK_IMPORTED_MODULE_21__["ApplicationService"]])
], ManagerolesComponent);

class ManageRoleGlistPagination {
    constructor(http) {
        this.http = http;
    }
    rolesGridList(sort, order, page, size, gridsearchValues) {
        const href = _env_environment__WEBPACK_IMPORTED_MODULE_13__["environment"].baseUrl + 'ea/enterpriseadmin/getrolesdtls';
        const sign = (order === 'desc') ? '-' : '';
        const requestUrl = `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
        return this.http.get(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}


/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.scss":
/*!***********************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.scss ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#manageusers tr.mat-row,\n#manageusers tr.mat-footer-row {\n  height: auto !important;\n  border-bottom: 1px solid #ddd;\n}\n#manageusers tr.mat-row:last-child,\n#manageusers tr.mat-footer-row:last-child {\n  border-bottom: none !important;\n}\n#manageusers th.mat-header-cell,\n#manageusers td.mat-cell,\n#manageusers td.mat-footer-cell {\n  border-bottom-style: none !important;\n}\n#manageusers .example-element-row td {\n  border-bottom-width: 0;\n}\n#manageusers .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#manageusers .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#manageusers .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#manageusers .example-element-description {\n  padding: 16px;\n}\n#manageusers .example-element-description-attribution {\n  opacity: 0.5;\n}\n#manageusers .mat-paginator-page-size-label {\n  margin: 0px !important;\n}\n#manageusers .mat-paginator-container {\n  padding: 0px !important;\n}\n#manageusers .addbtn {\n  background: #ed1c27;\n  color: #fff;\n}\n#manageusers #searchrow,\n#manageusers #filtershow {\n  background: #fff !important;\n  border: none;\n}\n#manageusers #searchrow .serachrow,\n#manageusers #filtershow .serachrow {\n  background: #fff !important;\n  min-height: 73px !important;\n  padding-right: 15px;\n  padding-top: 10px;\n}\n#manageusers .paginationwithfilter {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\n#manageusers .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions {\n  width: calc(100% - 186px);\n  color: #0c4b9a;\n}\n#manageusers .footerpaginator .mat-paginator-outer-container .mat-paginator-range-actions .mat-paginator-range-label {\n  width: calc(100% - 186px);\n}\n#manageusers .masterPageTop .mat-paginator-range-actions button {\n  display: none;\n}\n#manageusers .print {\n  color: #00a551;\n  font-size: 0.9375rem;\n}\n#manageusers .flexaligntag {\n  display: flex;\n  align-items: center;\n}\n#manageusers .update {\n  color: #0c4b9a;\n}\n#manageusers .declined {\n  color: #ed1c27;\n}\n#manageusers .pending {\n  color: #F4811F;\n}\n#manageusers .scrolldata {\n  position: relative;\n  z-index: 1;\n  display: block;\n  overflow-x: auto;\n  background-color: #fff;\n  scroll-behavior: smooth;\n}\n#manageusers .scrolldata::-webkit-scrollbar {\n  width: 6px;\n  height: 5px;\n}\n#manageusers .scrolldata::-webkit-scrollbar-track {\n  background: #f1f1f1;\n}\n#manageusers .scrolldata::-webkit-scrollbar-thumb {\n  background: #ccc;\n  border-radius: 2px;\n}\n#manageusers .scrolldata::-webkit-scrollbar-thumb:hover {\n  background: #ccc;\n}\n#manageusers .mat-form-field-appearance-legacy .mat-form-field-underline {\n  background-color: #d9d9d9 !important;\n}\n#manageusers .mat-sort-header-arrow {\n  color: #ED1C27;\n}\n#manageusers .mat-paginator-container .mat-paginator-page-size-label {\n  color: #999;\n  font-size: 15px;\n}\n#manageusers .mat-paginator-container .mat-select-value {\n  color: #626366;\n  font-size: 15px;\n}\n#manageusers .mat-paginator-container .mat-paginator-range-label {\n  color: #999;\n  font-size: 15px;\n  margin: 0px 10px !important;\n}\n#manageusers .awaredtable {\n  border-radius: 2px;\n  background-clip: padding-box;\n  background-color: #fff;\n  margin: 10px 0px;\n}\n#manageusers .awaredtable .manageoptions {\n  padding-right: 15px;\n}\n#manageusers .awaredtable .mat-row:hover {\n  background-color: #f5f5f5 !important;\n}\n#manageusers .awaredtable .mat-cell {\n  color: #262626;\n}\n#manageusers .awaredtable .mat-header-cell {\n  color: #626366 !important;\n  background-color: #eaedf2;\n  font-size: 15px;\n}\n.actionmatmenu {\n  background: #666;\n  border-radius: 0px;\n  min-width: 100px;\n}\n.actionmatmenu .mat-menu-content button.mat-menu-item {\n  height: 28px;\n  color: #fff;\n  line-height: 28px;\n}\n@media (max-width: 768px) {\n  #manageusers .masterPageTop {\n    display: block !important;\n    justify-content: flex-start !important;\n  }\n  #manageusers .masterPageTop .mat-paginator-page-size-label {\n    margin: 0px !important;\n  }\n  #manageusers .masterPageTop .mat-paginator-container {\n    padding: 0px !important;\n    justify-content: flex-start !important;\n  }\n}\n@media (max-width: 767px) {\n  #manageusers .footerpaginator .mat-paginator-container {\n    display: block !important;\n  }\n  #manageusers .footerpaginator .mat-paginator-range-actions {\n    width: auto !important;\n  }\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vbWFuYWdldXNlcnMvQzpcXGplbmtpbnNcXHdvcmtzcGFjZVxcT1BBTCAtIERldiBCdWlsZCAyMDBcXGRldi9zcmNcXGFwcFxcbW9kdWxlc1xcbmV3ZW50ZXJwcmlzZWFkbWluXFxtYW5hZ2V1c2Vyc1xcbWFuYWdldXNlcnMuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL21hbmFnZXVzZXJzL21hbmFnZXVzZXJzLmNvbXBvbmVudC5zY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUNJOztFQUVJLHVCQUFBO0VBQ0EsNkJBQUE7QUNBUjtBREVROztFQUNJLDhCQUFBO0FDQ1o7QURFSTs7O0VBR0ksb0NBQUE7QUNBUjtBREVJO0VBQ0ksc0JBQUE7QUNBUjtBREdJO0VBQ0ksZ0JBQUE7RUFDQSxhQUFBO0FDRFI7QURJSTtFQUNJLGVBQUE7RUFDQSx1QkFBQTtFQUNBLFlBQUE7RUFDQSxvQkFBQTtFQUNBLGFBQUE7RUFDQSxhQUFBO0FDRlI7QURLSTtFQUNJLGlCQUFBO0VBQ0EsZUFBQTtFQUNBLG1CQUFBO0FDSFI7QURNSTtFQUNJLGFBQUE7QUNKUjtBRE9JO0VBQ0ksWUFBQTtBQ0xSO0FET0k7RUFDSSxzQkFBQTtBQ0xSO0FEUUk7RUFDSSx1QkFBQTtBQ05SO0FEU0k7RUFDSSxtQkFBQTtFQUNBLFdBQUE7QUNQUjtBRFVJOztFQUVJLDJCQUFBO0VBQ0EsWUFBQTtBQ1JSO0FEVVE7O0VBQ0ksMkJBQUE7RUFDQSwyQkFBQTtFQUNBLG1CQUFBO0VBQ0EsaUJBQUE7QUNQWjtBRFdJO0VBQ0ksYUFBQTtFQUNBLDhCQUFBO0VBQ0EsbUJBQUE7QUNUUjtBRGNZO0VBQ0kseUJBQUE7RUFDQSxjQUFBO0FDWmhCO0FEY2dCO0VBQ0kseUJBQUE7QUNacEI7QURvQlE7RUFDSSxhQUFBO0FDbEJaO0FEc0JJO0VBQ0ksY0FBQTtFQUNBLG9CQUFBO0FDcEJSO0FEdUJJO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDckJSO0FEdUJJO0VBQ0ksY0FBQTtBQ3JCUjtBRHdCSTtFQUNJLGNBQUE7QUN0QlI7QUR5Qkk7RUFDSSxjQUFBO0FDdkJSO0FEMEJJO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0VBQ0Esc0JBQUE7RUFDQSx1QkFBQTtBQ3hCUjtBRDBCUTtFQUNJLFVBQUE7RUFDQSxXQUFBO0FDeEJaO0FEMkJRO0VBQ0ksbUJBQUE7QUN6Qlo7QUQ0QlE7RUFDSSxnQkFBQTtFQUNBLGtCQUFBO0FDMUJaO0FENkJRO0VBQ0ksZ0JBQUE7QUMzQlo7QURnQ1E7RUFDSSxvQ0FBQTtBQzlCWjtBRGtDSTtFQUNJLGNBQUE7QUNoQ1I7QURxQ1E7RUFDSSxXQUFBO0VBQ0EsZUFBQTtBQ25DWjtBRHNDUTtFQUNJLGNBQUE7RUFDQSxlQUFBO0FDcENaO0FEdUNRO0VBQ0ksV0FBQTtFQUNBLGVBQUE7RUFDQSwyQkFBQTtBQ3JDWjtBRHlDSTtFQUNJLGtCQUFBO0VBQ0EsNEJBQUE7RUFDQSxzQkFBQTtFQUNBLGdCQUFBO0FDdkNSO0FEeUNRO0VBQ0ksbUJBQUE7QUN2Q1o7QUQwQ1E7RUFDSSxvQ0FBQTtBQ3hDWjtBRDRDUTtFQUNJLGNBQUE7QUMxQ1o7QUQ2Q1E7RUFDSSx5QkFBQTtFQUNBLHlCQUFBO0VBQ0EsZUFBQTtBQzNDWjtBRG1EQTtFQUNJLGdCQUFBO0VBQ0Esa0JBQUE7RUFDQSxnQkFBQTtBQ2hESjtBRG1EUTtFQUNJLFlBQUE7RUFDQSxXQUFBO0VBQ0EsaUJBQUE7QUNqRFo7QUR1REE7RUFFUTtJQUNJLHlCQUFBO0lBQ0Esc0NBQUE7RUNyRFY7RUR1RFU7SUFDSSxzQkFBQTtFQ3JEZDtFRHdEVTtJQUNJLHVCQUFBO0lBQ0Esc0NBQUE7RUN0RGQ7QUFDRjtBRDREQTtFQUdZO0lBQ0kseUJBQUE7RUM1RGQ7RUQrRFU7SUFDSSxzQkFBQTtFQzdEZDtBQUNGIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vbWFuYWdldXNlcnMvbWFuYWdldXNlcnMuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjbWFuYWdldXNlcnMge1xyXG4gICAgdHIubWF0LXJvdyxcclxuICAgIHRyLm1hdC1mb290ZXItcm93IHtcclxuICAgICAgICBoZWlnaHQ6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcclxuXHJcbiAgICAgICAgJjpsYXN0LWNoaWxkIHtcclxuICAgICAgICAgICAgYm9yZGVyLWJvdHRvbTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIHRoLm1hdC1oZWFkZXItY2VsbCxcclxuICAgIHRkLm1hdC1jZWxsLFxyXG4gICAgdGQubWF0LWZvb3Rlci1jZWxsIHtcclxuICAgICAgICBib3JkZXItYm90dG9tLXN0eWxlOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAuZXhhbXBsZS1lbGVtZW50LXJvdyB0ZCB7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbS13aWR0aDogMDtcclxuICAgIH1cclxuXHJcbiAgICAuZXhhbXBsZS1lbGVtZW50LWRldGFpbCB7XHJcbiAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgfVxyXG5cclxuICAgIC5leGFtcGxlLWVsZW1lbnQtZGlhZ3JhbSB7XHJcbiAgICAgICAgbWluLXdpZHRoOiA4MHB4O1xyXG4gICAgICAgIGJvcmRlcjogMnB4IHNvbGlkIGJsYWNrO1xyXG4gICAgICAgIHBhZGRpbmc6IDhweDtcclxuICAgICAgICBmb250LXdlaWdodDogbGlnaHRlcjtcclxuICAgICAgICBtYXJnaW46IDhweCAwO1xyXG4gICAgICAgIGhlaWdodDogMTA0cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmV4YW1wbGUtZWxlbWVudC1zeW1ib2wge1xyXG4gICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgIGZvbnQtc2l6ZTogNDBweDtcclxuICAgICAgICBsaW5lLWhlaWdodDogbm9ybWFsO1xyXG4gICAgfVxyXG5cclxuICAgIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xyXG4gICAgICAgIHBhZGRpbmc6IDE2cHg7XHJcbiAgICB9XHJcblxyXG4gICAgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XHJcbiAgICAgICAgb3BhY2l0eTogMC41O1xyXG4gICAgfVxyXG4gICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcblxyXG4gICAgLmFkZGJ0biB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2VkMWMyNztcclxuICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgIH1cclxuXHJcbiAgICAjc2VhcmNocm93LFxyXG4gICAgI2ZpbHRlcnNob3cge1xyXG4gICAgICAgIGJhY2tncm91bmQ6ICNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICBib3JkZXI6IG5vbmU7XHJcblxyXG4gICAgICAgIC5zZXJhY2hyb3cge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMTVweDtcclxuICAgICAgICAgICAgcGFkZGluZy10b3A6IDEwcHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5wYWdpbmF0aW9ud2l0aGZpbHRlciB7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxuICAgIH1cclxuXHJcbiAgICAuZm9vdGVycGFnaW5hdG9yIHtcclxuICAgICAgICAubWF0LXBhZ2luYXRvci1vdXRlci1jb250YWluZXIge1xyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSAxODZweCk7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuXHJcbiAgICAgICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1sYWJlbCB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hc3RlclBhZ2VUb3Age1xyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMgYnV0dG9uIHtcclxuICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLnByaW50IHtcclxuICAgICAgICBjb2xvcjogIzAwYTU1MTtcclxuICAgICAgICBmb250LXNpemU6IDAuOTM3NXJlbTtcclxuICAgIH1cclxuXHJcbiAgICAuZmxleGFsaWdudGFnIHtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICB9XHJcbiAgICAudXBkYXRlIHtcclxuICAgICAgICBjb2xvcjogIzBjNGI5YTtcclxuICAgIH1cclxuXHJcbiAgICAuZGVjbGluZWQge1xyXG4gICAgICAgIGNvbG9yOiAjZWQxYzI3O1xyXG4gICAgfVxyXG5cclxuICAgIC5wZW5kaW5nIHtcclxuICAgICAgICBjb2xvcjogI0Y0ODExRjtcclxuICAgIH1cclxuXHJcbiAgICAuc2Nyb2xsZGF0YSB7XHJcbiAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgIHotaW5kZXg6IDE7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2s7XHJcbiAgICAgICAgb3ZlcmZsb3cteDogYXV0bztcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIHNjcm9sbC1iZWhhdmlvcjogc21vb3RoO1xyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhciB7XHJcbiAgICAgICAgICAgIHdpZHRoOiA2cHg7XHJcbiAgICAgICAgICAgIGhlaWdodDogNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdHJhY2sge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjFmMWYxO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgJjo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjY2NjO1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAmOjotd2Via2l0LXNjcm9sbGJhci10aHVtYjpob3ZlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNjY2M7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWxlZ2FjeSB7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNkOWQ5ZDkgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLm1hdC1zb3J0LWhlYWRlci1hcnJvdyB7XHJcbiAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICB9XHJcblxyXG5cclxuICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgLm1hdC1wYWdpbmF0b3ItcGFnZS1zaXplLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtc2VsZWN0LXZhbHVlIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2MjYzNjY7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM5OTk7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMTVweDtcclxuICAgICAgICAgICAgbWFyZ2luOiAwcHggMTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICAuYXdhcmVkdGFibGUge1xyXG4gICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XHJcbiAgICAgICAgbWFyZ2luOiAxMHB4IDBweDtcclxuXHJcbiAgICAgICAgLm1hbmFnZW9wdGlvbnMge1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAxNXB4O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1yb3c6aG92ZXIge1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjVmNWY1ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgLm1hdC1jZWxsIHtcclxuICAgICAgICAgICAgY29sb3I6ICMyNjI2MjY7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAubWF0LWhlYWRlci1jZWxsIHtcclxuICAgICAgICAgICAgY29sb3I6ICM2MjYzNjYgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2VhZWRmMjtcclxuICAgICAgICAgICAgZm9udC1zaXplOiAxNXB4O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcblxyXG5cclxufVxyXG5cclxuLmFjdGlvbm1hdG1lbnUge1xyXG4gICAgYmFja2dyb3VuZDogIzY2NjtcclxuICAgIGJvcmRlci1yYWRpdXM6IDBweDtcclxuICAgIG1pbi13aWR0aDogMTAwcHg7XHJcblxyXG4gICAgLm1hdC1tZW51LWNvbnRlbnQge1xyXG4gICAgICAgIGJ1dHRvbi5tYXQtbWVudS1pdGVtIHtcclxuICAgICAgICAgICAgaGVpZ2h0OiAyOHB4O1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDI4cHg7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiAgICAjbWFuYWdldXNlcnMge1xyXG4gICAgICAgIC5tYXN0ZXJQYWdlVG9wIHtcclxuICAgICAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcblxyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIHtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcclxuICAgICNtYW5hZ2V1c2VycyB7XHJcbiAgICAgICAgLmZvb3RlcnBhZ2luYXRvciB7XHJcbiAgICAgICAgICAgIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiBhdXRvICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0iLCIjbWFuYWdldXNlcnMgdHIubWF0LXJvdyxcbiNtYW5hZ2V1c2VycyB0ci5tYXQtZm9vdGVyLXJvdyB7XG4gIGhlaWdodDogYXV0byAhaW1wb3J0YW50O1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcbn1cbiNtYW5hZ2V1c2VycyB0ci5tYXQtcm93Omxhc3QtY2hpbGQsXG4jbWFuYWdldXNlcnMgdHIubWF0LWZvb3Rlci1yb3c6bGFzdC1jaGlsZCB7XG4gIGJvcmRlci1ib3R0b206IG5vbmUgIWltcG9ydGFudDtcbn1cbiNtYW5hZ2V1c2VycyB0aC5tYXQtaGVhZGVyLWNlbGwsXG4jbWFuYWdldXNlcnMgdGQubWF0LWNlbGwsXG4jbWFuYWdldXNlcnMgdGQubWF0LWZvb3Rlci1jZWxsIHtcbiAgYm9yZGVyLWJvdHRvbS1zdHlsZTogbm9uZSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcbiAgYm9yZGVyLWJvdHRvbS13aWR0aDogMDtcbn1cbiNtYW5hZ2V1c2VycyAuZXhhbXBsZS1lbGVtZW50LWRldGFpbCB7XG4gIG92ZXJmbG93OiBoaWRkZW47XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jbWFuYWdldXNlcnMgLmV4YW1wbGUtZWxlbWVudC1kaWFncmFtIHtcbiAgbWluLXdpZHRoOiA4MHB4O1xuICBib3JkZXI6IDJweCBzb2xpZCBibGFjaztcbiAgcGFkZGluZzogOHB4O1xuICBmb250LXdlaWdodDogbGlnaHRlcjtcbiAgbWFyZ2luOiA4cHggMDtcbiAgaGVpZ2h0OiAxMDRweDtcbn1cbiNtYW5hZ2V1c2VycyAuZXhhbXBsZS1lbGVtZW50LXN5bWJvbCB7XG4gIGZvbnQtd2VpZ2h0OiBib2xkO1xuICBmb250LXNpemU6IDQwcHg7XG4gIGxpbmUtaGVpZ2h0OiBub3JtYWw7XG59XG4jbWFuYWdldXNlcnMgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbiB7XG4gIHBhZGRpbmc6IDE2cHg7XG59XG4jbWFuYWdldXNlcnMgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XG4gIG9wYWNpdHk6IDAuNTtcbn1cbiNtYW5hZ2V1c2VycyAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICBtYXJnaW46IDBweCAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5hZGRidG4ge1xuICBiYWNrZ3JvdW5kOiAjZWQxYzI3O1xuICBjb2xvcjogI2ZmZjtcbn1cbiNtYW5hZ2V1c2VycyAjc2VhcmNocm93LFxuI21hbmFnZXVzZXJzICNmaWx0ZXJzaG93IHtcbiAgYmFja2dyb3VuZDogI2ZmZiAhaW1wb3J0YW50O1xuICBib3JkZXI6IG5vbmU7XG59XG4jbWFuYWdldXNlcnMgI3NlYXJjaHJvdyAuc2VyYWNocm93LFxuI21hbmFnZXVzZXJzICNmaWx0ZXJzaG93IC5zZXJhY2hyb3cge1xuICBiYWNrZ3JvdW5kOiAjZmZmICFpbXBvcnRhbnQ7XG4gIG1pbi1oZWlnaHQ6IDczcHggIWltcG9ydGFudDtcbiAgcGFkZGluZy1yaWdodDogMTVweDtcbiAgcGFkZGluZy10b3A6IDEwcHg7XG59XG4jbWFuYWdldXNlcnMgLnBhZ2luYXRpb253aXRoZmlsdGVyIHtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI21hbmFnZXVzZXJzIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3Itb3V0ZXItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWFjdGlvbnMge1xuICB3aWR0aDogY2FsYygxMDAlIC0gMTg2cHgpO1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNtYW5hZ2V1c2VycyAuZm9vdGVycGFnaW5hdG9yIC5tYXQtcGFnaW5hdG9yLW91dGVyLWNvbnRhaW5lciAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIC5tYXQtcGFnaW5hdG9yLXJhbmdlLWxhYmVsIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDE4NnB4KTtcbn1cbiNtYW5hZ2V1c2VycyAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1yYW5nZS1hY3Rpb25zIGJ1dHRvbiB7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jbWFuYWdldXNlcnMgLnByaW50IHtcbiAgY29sb3I6ICMwMGE1NTE7XG4gIGZvbnQtc2l6ZTogMC45Mzc1cmVtO1xufVxuI21hbmFnZXVzZXJzIC5mbGV4YWxpZ250YWcge1xuICBkaXNwbGF5OiBmbGV4O1xuICBhbGlnbi1pdGVtczogY2VudGVyO1xufVxuI21hbmFnZXVzZXJzIC51cGRhdGUge1xuICBjb2xvcjogIzBjNGI5YTtcbn1cbiNtYW5hZ2V1c2VycyAuZGVjbGluZWQge1xuICBjb2xvcjogI2VkMWMyNztcbn1cbiNtYW5hZ2V1c2VycyAucGVuZGluZyB7XG4gIGNvbG9yOiAjRjQ4MTFGO1xufVxuI21hbmFnZXVzZXJzIC5zY3JvbGxkYXRhIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAxO1xuICBkaXNwbGF5OiBibG9jaztcbiAgb3ZlcmZsb3cteDogYXV0bztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgc2Nyb2xsLWJlaGF2aW9yOiBzbW9vdGg7XG59XG4jbWFuYWdldXNlcnMgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyIHtcbiAgd2lkdGg6IDZweDtcbiAgaGVpZ2h0OiA1cHg7XG59XG4jbWFuYWdldXNlcnMgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRyYWNrIHtcbiAgYmFja2dyb3VuZDogI2YxZjFmMTtcbn1cbiNtYW5hZ2V1c2VycyAuc2Nyb2xsZGF0YTo6LXdlYmtpdC1zY3JvbGxiYXItdGh1bWIge1xuICBiYWNrZ3JvdW5kOiAjY2NjO1xuICBib3JkZXItcmFkaXVzOiAycHg7XG59XG4jbWFuYWdldXNlcnMgLnNjcm9sbGRhdGE6Oi13ZWJraXQtc2Nyb2xsYmFyLXRodW1iOmhvdmVyIHtcbiAgYmFja2dyb3VuZDogI2NjYztcbn1cbiNtYW5hZ2V1c2VycyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1sZWdhY3kgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNkOWQ5ZDkgIWltcG9ydGFudDtcbn1cbiNtYW5hZ2V1c2VycyAubWF0LXNvcnQtaGVhZGVyLWFycm93IHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jbWFuYWdldXNlcnMgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtcGFnaW5hdG9yLXBhZ2Utc2l6ZS1sYWJlbCB7XG4gIGNvbG9yOiAjOTk5O1xuICBmb250LXNpemU6IDE1cHg7XG59XG4jbWFuYWdldXNlcnMgLm1hdC1wYWdpbmF0b3ItY29udGFpbmVyIC5tYXQtc2VsZWN0LXZhbHVlIHtcbiAgY29sb3I6ICM2MjYzNjY7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cbiNtYW5hZ2V1c2VycyAubWF0LXBhZ2luYXRvci1jb250YWluZXIgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtbGFiZWwge1xuICBjb2xvcjogIzk5OTtcbiAgZm9udC1zaXplOiAxNXB4O1xuICBtYXJnaW46IDBweCAxMHB4ICFpbXBvcnRhbnQ7XG59XG4jbWFuYWdldXNlcnMgLmF3YXJlZHRhYmxlIHtcbiAgYm9yZGVyLXJhZGl1czogMnB4O1xuICBiYWNrZ3JvdW5kLWNsaXA6IHBhZGRpbmctYm94O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBtYXJnaW46IDEwcHggMHB4O1xufVxuI21hbmFnZXVzZXJzIC5hd2FyZWR0YWJsZSAubWFuYWdlb3B0aW9ucyB7XG4gIHBhZGRpbmctcmlnaHQ6IDE1cHg7XG59XG4jbWFuYWdldXNlcnMgLmF3YXJlZHRhYmxlIC5tYXQtcm93OmhvdmVyIHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y1ZjVmNSAhaW1wb3J0YW50O1xufVxuI21hbmFnZXVzZXJzIC5hd2FyZWR0YWJsZSAubWF0LWNlbGwge1xuICBjb2xvcjogIzI2MjYyNjtcbn1cbiNtYW5hZ2V1c2VycyAuYXdhcmVkdGFibGUgLm1hdC1oZWFkZXItY2VsbCB7XG4gIGNvbG9yOiAjNjI2MzY2ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNlYWVkZjI7XG4gIGZvbnQtc2l6ZTogMTVweDtcbn1cblxuLmFjdGlvbm1hdG1lbnUge1xuICBiYWNrZ3JvdW5kOiAjNjY2O1xuICBib3JkZXItcmFkaXVzOiAwcHg7XG4gIG1pbi13aWR0aDogMTAwcHg7XG59XG4uYWN0aW9ubWF0bWVudSAubWF0LW1lbnUtY29udGVudCBidXR0b24ubWF0LW1lbnUtaXRlbSB7XG4gIGhlaWdodDogMjhweDtcbiAgY29sb3I6ICNmZmY7XG4gIGxpbmUtaGVpZ2h0OiAyOHB4O1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgI21hbmFnZXVzZXJzIC5tYXN0ZXJQYWdlVG9wIHtcbiAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xuICAgIGp1c3RpZnktY29udGVudDogZmxleC1zdGFydCAhaW1wb3J0YW50O1xuICB9XG4gICNtYW5hZ2V1c2VycyAubWFzdGVyUGFnZVRvcCAubWF0LXBhZ2luYXRvci1wYWdlLXNpemUtbGFiZWwge1xuICAgIG1hcmdpbjogMHB4ICFpbXBvcnRhbnQ7XG4gIH1cbiAgI21hbmFnZXVzZXJzIC5tYXN0ZXJQYWdlVG9wIC5tYXQtcGFnaW5hdG9yLWNvbnRhaW5lciB7XG4gICAgcGFkZGluZzogMHB4ICFpbXBvcnRhbnQ7XG4gICAganVzdGlmeS1jb250ZW50OiBmbGV4LXN0YXJ0ICFpbXBvcnRhbnQ7XG4gIH1cbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjdweCkge1xuICAjbWFuYWdldXNlcnMgLmZvb3RlcnBhZ2luYXRvciAubWF0LXBhZ2luYXRvci1jb250YWluZXIge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbiAgI21hbmFnZXVzZXJzIC5mb290ZXJwYWdpbmF0b3IgLm1hdC1wYWdpbmF0b3ItcmFuZ2UtYWN0aW9ucyB7XG4gICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcbiAgfVxufSJdfQ== */");

/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.ts":
/*!*********************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.ts ***!
  \*********************************************************************************/
/*! exports provided: ManageusersComponent, ManageUserGlistPagination */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ManageusersComponent", function() { return ManageusersComponent; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ManageUserGlistPagination", function() { return ManageUserGlistPagination; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");
/* harmony import */ var _angular_material_table__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/material/table */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/table.js");
/* harmony import */ var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/material/paginator */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
/* harmony import */ var _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../enterpriseadmin.service */ "./src/app/modules/newenterpriseadmin/enterpriseadmin.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _env_environment__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @env/environment */ "./src/environments/environment.ts");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var rxjs_observable_of__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! rxjs/observable/of */ "./node_modules/rxjs-compat/_esm2015/observable/of.js");
/* harmony import */ var rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! rxjs/observable/merge */ "./node_modules/rxjs-compat/_esm2015/observable/merge.js");
/* harmony import */ var _angular_material_sort__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! @angular/material/sort */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/sort.js");
/* harmony import */ var rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! rxjs/operators/startWith */ "./node_modules/rxjs-compat/_esm2015/operators/startWith.js");
/* harmony import */ var rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! rxjs/operators/switchMap */ "./node_modules/rxjs-compat/_esm2015/operators/switchMap.js");
/* harmony import */ var rxjs_operators_map__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! rxjs/operators/map */ "./node_modules/rxjs-compat/_esm2015/operators/map.js");
/* harmony import */ var rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! rxjs/operators/catchError */ "./node_modules/rxjs-compat/_esm2015/operators/catchError.js");
/* harmony import */ var _app_services_application_service__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! @app/services/application.service */ "./src/app/services/application.service.ts");




















// const roledata_data: Roledata[] = [
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Abdul Aziz Al Ghurair',emailid:'Abdulaziz@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Mohammed Al Issa',emailid:'mohammedal@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'yes',status:'I',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saif Ahmed Belhasa',emailid:'saifahmed@gmail.com',mobilenumber:'+968 78754655',role:'Tutor/Trainer',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Mohamed Mansour',emailid:'mohamed@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'No',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saleh Abdullah Kamel',emailid:'abdullahkamel@gmail.com',mobilenumber:'+968 78754655',role:'Tutor/Trainer',thirdpartyagent:'yes',status:'P',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Aziz Akhannouch',emailid:'akhannouch@gmail.com',mobilenumber:'+968 78754655',role:'Auditor',thirdpartyagent:'No',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saif Al Ghurair',emailid:'saifalghurair@gmail.com',mobilenumber:'+968 78754655',role:'Tutor',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Saif Al Ghurair',emailid:'abdulla@gmail.com',mobilenumber:'+968 78754655',role:'Assessor',thirdpartyagent:'No',status:'I',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'OPAL Admin',civilnumber:'CVN007896',stafname:'Majid Al Futtaim',emailid:'majidal@gmail.com',mobilenumber:'+968 78754655',role:'Tutor/Trainer',thirdpartyagent:'yes',status:'I',added_on:'12-12-2023',lastupdated:'21-05-2023'},
//   { stktype: 'Training Evaluation Centre',civilnumber:'CVN007896',stafname:'Mohamed Al Fayed',emailid:'mohamed@gmail.com',mobilenumber:'+968 78754655',role:'Assessor',thirdpartyagent:'yes',status:'A',added_on:'12-12-2023',lastupdated:'21-05-2023'}
// ];
let ManageusersComponent = class ManageusersComponent {
    constructor(translate, remoteService, cookieService, enterprise, routeid, http, appservice) {
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.enterprise = enterprise;
        this.routeid = routeid;
        this.http = http;
        this.appservice = appservice;
        this.addrolecreationpage = false;
        this.rolegridlistpage = true;
        this.userdata = [];
        this.userCenter = [];
        this.refnameCenter = true;
        // Usersrecord: MatTableDataSource<Userdata>;
        // public userdata : Userdata[];
        this.rolesrecordcolumn = ['oshm_stakeholdertype', 'oum_idnumber', 'stafname', 'emailid', 'mobilenumber', 'role', 'thirdpartyagent', 'status', 'added_on', 'lastupdated', 'action'];
        // Rolesrecord = new MatTableDataSource<Roledata>(this.userdata);
        // resultsLength = this.Rolesrecord.data.length;
        this.hidefilder = true;
        this.filtername = "Hide Filter";
        this.page = 10;
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
        this.noData = '';
    }
    i18n(key) {
        return this.translate.instant(key);
    }
    ngOnInit() {
        // this.routeid.queryParams.subscribe(params => {
        //   this.refname = params['type'];
        // });
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
        if (this.refname == 3) {
            this.getusercentergriddata();
            // this.refnameCenter =true;
        }
        else {
            // this.getusergriddata();
        }
        this.stafName = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.emailid = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.stakeholdertype = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.civilNo = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.mobilno = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.roleName_en = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.status = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.addedOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.lastUpdateOn = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.isthirdPartyAgent = new _angular_forms__WEBPACK_IMPORTED_MODULE_11__["FormControl"]('');
        this.stafName.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.emailid.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.stakeholdertype.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.civilNo.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.mobilno.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.roleName_en.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.status.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.addedOn.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.lastUpdateOn.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
        this.isthirdPartyAgent.valueChanges.debounceTime(400).subscribe(register => {
            if (register != null) {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
            else if (register == '') {
                this.paginator.pageIndex = 0;
                this.getManageUserDtls();
            }
        });
    }
    ngAfterViewInit() {
        this.getManageUserDtls();
        this.Usersrecord.sort = this.sort;
        this.Usersrecord.paginator = this.paginator;
    }
    syncPrimaryPaginator(event) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.page = event.pageSize;
    }
    gridlistdata(event) {
        this.rolegridlistpage = event;
    }
    addrolecreationdata(event) {
        this.addrolecreationpage = event;
    }
    routeToadduser() {
        this.addrolecreationpage = true;
    }
    scrollTo(className) {
        try {
            const elementList = document.querySelectorAll('.' + className);
            const element = elementList[0];
            element.scrollIntoView({ behavior: 'smooth' });
            console.log('page-content');
        }
        catch (error) {
            // console.log('page-content')
        }
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
    // getusergriddata(){
    //   this.enterprise.getusersgriddtls().subscribe(data=>{
    //     this.userdata.data = data['data'].userList;
    //     // this.Rolesrecord = new MatTableDataSource<Roledata>(this.userdata);
    //     // this.resultsLength = this.userdata.data.length;
    //   });
    // }
    getusercentergriddata() {
        this.enterprise.getUserCenterlistDtls().subscribe(data => {
            this.userCenter.data = data['data'].centerList;
            this.resultsLength = this.userCenter.data.length;
        });
    }
    getManageUserDtls() {
        this.UsersGridDatas = new ManageUserGlistPagination(this.http);
        this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
        var gridsearchvalue = {};
        gridsearchvalue = { stafName: this.stafName.value,
            emailid: this.emailid.value,
            oshm_stakeholdertype: this.stakeholdertype.value,
            oum_idnumber: this.civilNo.value,
            mobilno: this.mobilno.value,
            roleName_en: this.roleName_en.value,
            status: this.status.value,
            isthirdPartyAgent: this.isthirdPartyAgent.value,
            addedOn: this.status.value,
            lastUpdateOn: this.status.value
        };
        Object(rxjs_observable_merge__WEBPACK_IMPORTED_MODULE_13__["merge"])(this.sort.sortChange)
            .pipe(Object(rxjs_operators_startWith__WEBPACK_IMPORTED_MODULE_15__["startWith"])({}), Object(rxjs_operators_switchMap__WEBPACK_IMPORTED_MODULE_16__["switchMap"])(() => {
            return this.UsersGridDatas.usersGridList(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.page, JSON.stringify(gridsearchvalue));
        }), Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_17__["map"])(data => {
            this.resultsLength = data['data'].data.totalcount;
            // console.log(data['data'].data.data,'data.data.data123');
            return data['data'].data.data;
        }), Object(rxjs_operators_catchError__WEBPACK_IMPORTED_MODULE_18__["catchError"])(() => {
            return Object(rxjs_observable_of__WEBPACK_IMPORTED_MODULE_12__["of"])([]);
        })).subscribe(data => {
            this.Usersrecord = new _angular_material_table__WEBPACK_IMPORTED_MODULE_5__["MatTableDataSource"](data);
            this.Usersrecord.filterPredicate = this.createFilter();
            this.noData = this.Usersrecord.connect().pipe(Object(rxjs_operators_map__WEBPACK_IMPORTED_MODULE_17__["map"])(data => data.length === 0));
            console.log(this.noData);
            // console.log(this.Usersrecord,'this.Usersrecord');
        });
    }
    createFilter() {
        let filterFunction = function (data, filter) {
            let searchTerms = JSON.parse(filter);
            return data.stafName.toLowerCase().indexOf(searchTerms.stafName) !== -1 &&
                data.emailid.toLowerCase().indexOf(searchTerms.emailid) !== -1 &&
                data.stakeholdertype.toLowerCase().indexOf(searchTerms.stakeholdertype) !== -1 &&
                data.civilNo.toLowerCase().indexOf(searchTerms.civilNo) !== -1 &&
                data.mobilno.toLowerCase().indexOf(searchTerms.mobilno) !== -1 &&
                data.roleName_en.toLowerCase().indexOf(searchTerms.roleName_en) !== -1 &&
                data.status.toLowerCase().indexOf(searchTerms.status) !== -1 &&
                data.isthirdPartyAgent.toLowerCase().indexOf(searchTerms.isthirdPartyAgent) !== -1 &&
                data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 &&
                data.lastUpdateOn.toLowerCase().indexOf(searchTerms.lastUpdateOn) !== -1;
        };
        return filterFunction;
    }
};
ManageusersComponent.ctorParameters = () => [
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"] },
    { type: _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_7__["EnterpriseadminService"] },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_8__["ActivatedRoute"] },
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_9__["HttpClient"] },
    { type: _app_services_application_service__WEBPACK_IMPORTED_MODULE_19__["ApplicationService"] }
];
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])("paginator"),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_6__["MatPaginator"])
], ManageusersComponent.prototype, "paginator", void 0);
Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_sort__WEBPACK_IMPORTED_MODULE_14__["MatSort"]),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_sort__WEBPACK_IMPORTED_MODULE_14__["MatSort"])
], ManageusersComponent.prototype, "sort", void 0);
ManageusersComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-manageusers',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./manageusers.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./manageusers.component.scss */ "./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_ngx_translate_core__WEBPACK_IMPORTED_MODULE_3__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_4__["CookieService"],
        _enterpriseadmin_service__WEBPACK_IMPORTED_MODULE_7__["EnterpriseadminService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_8__["ActivatedRoute"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_9__["HttpClient"],
        _app_services_application_service__WEBPACK_IMPORTED_MODULE_19__["ApplicationService"]])
], ManageusersComponent);

class ManageUserGlistPagination {
    constructor(http) {
        this.http = http;
    }
    usersGridList(sort, order, page, size, gridsearchValues) {
        const href = _env_environment__WEBPACK_IMPORTED_MODULE_10__["environment"].baseUrl + 'ea/enterpriseadmin/getusersdtls';
        const sign = (order === 'desc') ? '-' : '';
        const requestUrl = `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
        return this.http.get(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}


/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/newenterpriseadmin-routing.module.ts":
/*!*********************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/newenterpriseadmin-routing.module.ts ***!
  \*********************************************************************************/
/*! exports provided: NewenterpriseadminRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "NewenterpriseadminRoutingModule", function() { return NewenterpriseadminRoutingModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _manageroles_manageroles_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./manageroles/manageroles.component */ "./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.ts");
/* harmony import */ var _manageusers_manageusers_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./manageusers/manageusers.component */ "./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.ts");
/* harmony import */ var _addroles_addroles_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./addroles/addroles.component */ "./src/app/modules/newenterpriseadmin/addroles/addroles.component.ts");
/* harmony import */ var _addusers_addusers_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./addusers/addusers.component */ "./src/app/modules/newenterpriseadmin/addusers/addusers.component.ts");
/* harmony import */ var _viewroles_viewroles_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./viewroles/viewroles.component */ "./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.ts");
/* harmony import */ var _viewusers_viewusers_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./viewusers/viewusers.component */ "./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.ts");
/* harmony import */ var _app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @app/auth/auth.guard */ "./src/app/auth/auth.guard.ts");










const routes = [
    {
        path: '',
        children: [
            {
                path: 'manageroles',
                component: _manageroles_manageroles_component__WEBPACK_IMPORTED_MODULE_3__["ManagerolesComponent"],
                data: {
                    title: 'Manage Roles',
                    urls: [
                        { title: 'Manage Roles', url: '/manageroles' }
                    ]
                }, canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_9__["AuthGuard"]]
            },
            {
                path: 'addroles',
                component: _addroles_addroles_component__WEBPACK_IMPORTED_MODULE_5__["AddrolesComponent"],
                data: {
                    title: 'Add Roles',
                    formid: 1,
                    urls: [
                        { title: 'Add Roles', url: '/addroles' }
                    ]
                }, canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_9__["AuthGuard"]]
            },
            {
                path: 'viewroles',
                component: _viewroles_viewroles_component__WEBPACK_IMPORTED_MODULE_7__["ViewrolesComponent"],
                data: {
                    title: 'View Roles',
                    urls: [
                        { title: 'View Roles', url: '/viewroles' }
                    ]
                },
            },
            {
                path: 'manageusers',
                component: _manageusers_manageusers_component__WEBPACK_IMPORTED_MODULE_4__["ManageusersComponent"],
                data: {
                    title: 'Manage Users',
                    formid: 2,
                    urls: [
                        { title: 'Manage Users', url: '/manageusers' }
                    ]
                }, canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_9__["AuthGuard"]]
            },
            {
                path: 'addusers',
                component: _addusers_addusers_component__WEBPACK_IMPORTED_MODULE_6__["AddusersComponent"],
                data: {
                    title: 'Add Users',
                    urls: [
                        { title: 'Add Users', url: '/addusers' }
                    ]
                }
            },
            {
                path: 'viewusers',
                component: _viewusers_viewusers_component__WEBPACK_IMPORTED_MODULE_8__["ViewusersComponent"],
                data: {
                    title: 'View Users',
                    urls: [
                        { title: 'View Users', url: '/viewusers' }
                    ]
                }
            }
        ]
    }
];
let NewenterpriseadminRoutingModule = class NewenterpriseadminRoutingModule {
};
NewenterpriseadminRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })
], NewenterpriseadminRoutingModule);



/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/newenterpriseadmin.module.ts":
/*!*************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/newenterpriseadmin.module.ts ***!
  \*************************************************************************/
/*! exports provided: createTranslateLoader, NewenterpriseadminModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createTranslateLoader", function() { return createTranslateLoader; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "NewenterpriseadminModule", function() { return NewenterpriseadminModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
/* harmony import */ var _app_shared__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/@shared */ "./src/app/@shared/index.ts");
/* harmony import */ var _newenterpriseadmin_routing_module__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./newenterpriseadmin-routing.module */ "./src/app/modules/newenterpriseadmin/newenterpriseadmin-routing.module.ts");
/* harmony import */ var _manageroles_manageroles_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./manageroles/manageroles.component */ "./src/app/modules/newenterpriseadmin/manageroles/manageroles.component.ts");
/* harmony import */ var _manageusers_manageusers_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./manageusers/manageusers.component */ "./src/app/modules/newenterpriseadmin/manageusers/manageusers.component.ts");
/* harmony import */ var _angular_material_tabs__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/material/tabs */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/tabs.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @ngx-translate/http-loader */ "./node_modules/@ngx-translate/http-loader/fesm2015/ngx-translate-http-loader.mjs");
/* harmony import */ var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @angular/flex-layout */ "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
/* harmony import */ var _addroles_addroles_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./addroles/addroles.component */ "./src/app/modules/newenterpriseadmin/addroles/addroles.component.ts");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _addusers_addusers_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./addusers/addusers.component */ "./src/app/modules/newenterpriseadmin/addusers/addusers.component.ts");
/* harmony import */ var _viewroles_viewroles_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./viewroles/viewroles.component */ "./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.ts");
/* harmony import */ var _viewusers_viewusers_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./viewusers/viewusers.component */ "./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.ts");
/* harmony import */ var _angular_material_button__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! @angular/material/button */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/button.js");


















function createTranslateLoader(http) {
    return new _ngx_translate_http_loader__WEBPACK_IMPORTED_MODULE_10__["TranslateHttpLoader"](http, './assets/i18n/certificationapproval/', '.json');
}
let NewenterpriseadminModule = class NewenterpriseadminModule {
};
NewenterpriseadminModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
        declarations: [_manageroles_manageroles_component__WEBPACK_IMPORTED_MODULE_5__["ManagerolesComponent"], _manageusers_manageusers_component__WEBPACK_IMPORTED_MODULE_6__["ManageusersComponent"], _addroles_addroles_component__WEBPACK_IMPORTED_MODULE_12__["AddrolesComponent"], _addusers_addusers_component__WEBPACK_IMPORTED_MODULE_14__["AddusersComponent"], _viewroles_viewroles_component__WEBPACK_IMPORTED_MODULE_15__["ViewrolesComponent"], _viewusers_viewusers_component__WEBPACK_IMPORTED_MODULE_16__["ViewusersComponent"]],
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"],
            _app_shared__WEBPACK_IMPORTED_MODULE_3__["SharedModule"],
            _newenterpriseadmin_routing_module__WEBPACK_IMPORTED_MODULE_4__["NewenterpriseadminRoutingModule"],
            _angular_material_tabs__WEBPACK_IMPORTED_MODULE_7__["MatTabsModule"],
            _angular_flex_layout__WEBPACK_IMPORTED_MODULE_11__["FlexLayoutModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_13__["ReactiveFormsModule"],
            _angular_forms__WEBPACK_IMPORTED_MODULE_13__["FormsModule"],
            _angular_material_button__WEBPACK_IMPORTED_MODULE_17__["MatButtonModule"],
            _ngx_translate_core__WEBPACK_IMPORTED_MODULE_9__["TranslateModule"].forChild({
                loader: {
                    provide: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_9__["TranslateLoader"],
                    useFactory: createTranslateLoader,
                    deps: [_angular_common_http__WEBPACK_IMPORTED_MODULE_8__["HttpClient"]]
                }
            })
        ]
    })
], NewenterpriseadminModule);



/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.scss":
/*!*******************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.scss ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#viewroles .viewrolesnew {\n  padding: 0 30px;\n  margin-bottom: 50px;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#viewroles .viewrolesnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#viewroles .viewrolesnew .mat-form-field-readonly .mat-form-field-flex .mat-form-field-outline {\n  background: #eaedf2;\n}\n#viewroles .viewrolesnew .aligncenter {\n  display: flex;\n  align-items: center;\n}\n#viewroles .viewrolesnew .aligncenter .mat-icon {\n  width: 16px;\n  height: 16px;\n  color: #666;\n  cursor: pointer;\n  font-size: 20px;\n  margin-top: 5px;\n}\n#viewroles .viewrolesnew .permissiontable {\n  width: 100%;\n  /* Hide the browser's default checkbox */\n  /* Create a custom checkbox */\n  /* On mouse-over, add a grey background color */\n  /* When the checkbox is checked, add a blue background */\n  /* When the checkbox is disabled, add a blue background */\n  /* Create the checkmark/indicator (hidden when not checked) */\n  /* Show the checkmark when checked */\n  /* Style the checkmark/indicator */\n}\n#viewroles .viewrolesnew .permissiontable table {\n  width: 100%;\n  box-shadow: none;\n}\n#viewroles .viewrolesnew .permissiontable tr.example-detail-row {\n  height: 0;\n}\n#viewroles .viewrolesnew .permissiontable tr.example-element-row:not(.example-expanded-row):hover {\n  background: whitesmoke;\n}\n#viewroles .viewrolesnew .permissiontable tr.example-element-row:not(.example-expanded-row):active {\n  background: #efefef;\n}\n#viewroles .viewrolesnew .permissiontable .example-element-row td {\n  border-bottom-width: 0;\n}\n#viewroles .viewrolesnew .permissiontable .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#viewroles .viewrolesnew .permissiontable .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#viewroles .viewrolesnew .permissiontable .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#viewroles .viewrolesnew .permissiontable .example-element-description {\n  padding: 16px;\n}\n#viewroles .viewrolesnew .permissiontable .example-element-description-attribution {\n  opacity: 0.5;\n}\n#viewroles .viewrolesnew .permissiontable table th {\n  background: #eaedf2;\n  font-size: 14px;\n  color: #333;\n  font-weight: 600;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#viewroles .viewrolesnew .permissiontable table th:first-child {\n  text-align: left;\n  min-width: 250px;\n}\n#viewroles .viewrolesnew .permissiontable table td {\n  position: relative;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#viewroles .viewrolesnew .permissiontable table td:first-child {\n  text-align: left;\n  min-width: 250px;\n  color: #0c4b9a;\n}\n#viewroles .viewrolesnew .permissiontable table td .expandicon {\n  position: absolute;\n  right: 20px;\n  top: 50%;\n  transform: translateY(-50%);\n}\n#viewroles .viewrolesnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n#viewroles .viewrolesnew .permissiontable table td .subtable tr th, #viewroles .viewrolesnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n#viewroles .viewrolesnew .permissiontable table td .subtable tr td {\n  position: relative;\n  text-align: center;\n  min-width: 72px;\n  max-width: 72px;\n}\n#viewroles .viewrolesnew .permissiontable table td .subtable tr td:first-child {\n  max-width: 240px;\n  min-width: 240px;\n  text-align: left;\n  color: #333333;\n}\n#viewroles .viewrolesnew .permissiontable .checkcontainer {\n  display: inline-block;\n  position: relative;\n  margin-bottom: 12px;\n  padding-left: 25px;\n  cursor: pointer;\n  font-size: 22px;\n  -webkit-user-select: none;\n  -moz-user-select: none;\n  user-select: none;\n}\n#viewroles .viewrolesnew .permissiontable .checkcontainer input {\n  position: absolute;\n  opacity: 0;\n  cursor: pointer;\n  height: 0;\n  width: 0;\n}\n#viewroles .viewrolesnew .permissiontable .checkmark {\n  position: absolute;\n  top: 0;\n  left: 0;\n  height: 16px;\n  width: 16px;\n  background-color: #fff;\n  border: 1px solid #bbb;\n}\n#viewroles .viewrolesnew .permissiontable .checkcontainer:hover input ~ .checkmark {\n  background-color: #ccc;\n}\n#viewroles .viewrolesnew .permissiontable .checkcontainer input:checked ~ .checkmark {\n  background-color: #0c4b9a;\n}\n#viewroles .viewrolesnew .permissiontable .checkcontainer input:disabled ~ .checkmark {\n  background-color: #ddd;\n  cursor: no-drop;\n}\n#viewroles .viewrolesnew .permissiontable .checkmark:after {\n  content: \"\";\n  position: absolute;\n  display: none;\n}\n#viewroles .viewrolesnew .permissiontable .checkcontainer input:checked ~ .checkmark:after {\n  display: block;\n}\n#viewroles .viewrolesnew .permissiontable .checkcontainer .checkmark:after {\n  left: 4px;\n  top: 1px;\n  width: 4px;\n  height: 7px;\n  border: solid white;\n  border-width: 0 2px 2px 0;\n  transform: rotate(45deg);\n}\n#viewroles .viewrolesnew .permissiontable .nopaddingtd {\n  padding: 0px !important;\n}\n@media (max-width: 768px) {\n  #viewroles .viewrolesnew .paddingspacing {\n    padding-right: 0px !important;\n    padding-left: 0px !important;\n  }\n  #viewroles .viewrolesnew .permissiontable {\n    overflow: auto;\n  }\n}\n[dir=rtl] #viewroles .viewrolesnew .permissiontable table th:first-child, .rtl #viewroles .viewrolesnew .permissiontable table th:first-child {\n  text-align: right;\n}\n[dir=rtl] #viewroles .viewrolesnew .permissiontable table td:first-child, .rtl #viewroles .viewrolesnew .permissiontable table td:first-child {\n  text-align: right;\n}\n[dir=rtl] #viewroles .viewrolesnew .permissiontable table td .expandicon, .rtl #viewroles .viewrolesnew .permissiontable table td .expandicon {\n  position: absolute;\n  left: 20px;\n  right: auto;\n  top: 50%;\n  transform: translateY(-50%);\n}\n[dir=rtl] #viewroles .viewrolesnew .permissiontable table td .expandicon .mat-icon, .rtl #viewroles .viewrolesnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n[dir=rtl] #viewroles .viewrolesnew .permissiontable table td .subtable tr th, [dir=rtl] #viewroles .viewrolesnew .permissiontable table td .subtable thead, .rtl #viewroles .viewrolesnew .permissiontable table td .subtable tr th, .rtl #viewroles .viewrolesnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n[dir=rtl] #viewroles .viewrolesnew .permissiontable table td .subtable tr td:first-child, .rtl #viewroles .viewrolesnew .permissiontable table td .subtable tr td:first-child {\n  text-align: right;\n}\n[dir=rtl] #viewroles .viewrolesnew .permissiontable .checkcontainer, .rtl #viewroles .viewrolesnew .permissiontable .checkcontainer {\n  padding-right: 25px;\n  padding-left: 0px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vdmlld3JvbGVzL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXG5ld2VudGVycHJpc2VhZG1pblxcdmlld3JvbGVzXFx2aWV3cm9sZXMuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL3ZpZXdyb2xlcy92aWV3cm9sZXMuY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0k7RUFDSSxlQUFBO0VBQ0EsbUJBQUE7QUNBUjtBREVZO0VBQ0ksY0FBQTtBQ0FoQjtBREdZO0VBQ0ksMEJBQUE7QUNEaEI7QURJWTtFQUNJLDBCQUFBO0FDRmhCO0FES1k7RUFDSSxjQUFBO0FDSGhCO0FETVk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNKaEI7QURRZ0I7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNOcEI7QURXd0I7RUFDSSxjQUFBO0FDVDVCO0FEZ0JnQjtFQUNJLHlCQUFBO0FDZHBCO0FEb0JnQjtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ2xCcEI7QUR3Qm9CO0VBQ0ksMENBQUE7RUFDQSxjQUFBO0FDdEJ4QjtBRHdCd0I7RUFDSSxjQUFBO0FDdEI1QjtBRDBCb0I7RUFDSSxxQkFBQTtBQ3hCeEI7QUQrQmdCO0VBQ0ksbUJBQUE7QUM3QnBCO0FEaUNRO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDL0JaO0FEZ0NZO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0FDOUJoQjtBRGtDUTtFQUNJLFdBQUE7RUFtSEUsd0NBQUE7RUFTQSw2QkFBQTtFQVdBLCtDQUFBO0VBS0Esd0RBQUE7RUFJQSx5REFBQTtFQU1BLDZEQUFBO0VBT0Esb0NBQUE7RUFLQSxrQ0FBQTtBQzFMZDtBRHlCWTtFQUNJLFdBQUE7RUFDQSxnQkFBQTtBQ3ZCaEI7QUQwQmM7RUFDRSxTQUFBO0FDeEJoQjtBRDJCYztFQUNFLHNCQUFBO0FDekJoQjtBRDRCYztFQUNFLG1CQUFBO0FDMUJoQjtBRDZCYztFQUNFLHNCQUFBO0FDM0JoQjtBRDhCYztFQUNFLGdCQUFBO0VBQ0EsYUFBQTtBQzVCaEI7QUQrQmM7RUFDRSxlQUFBO0VBQ0EsdUJBQUE7RUFDQSxZQUFBO0VBQ0Esb0JBQUE7RUFDQSxhQUFBO0VBQ0EsYUFBQTtBQzdCaEI7QURnQ2M7RUFDRSxpQkFBQTtFQUNBLGVBQUE7RUFDQSxtQkFBQTtBQzlCaEI7QURpQ2M7RUFDRSxhQUFBO0FDL0JoQjtBRGtDYztFQUNFLFlBQUE7QUNoQ2hCO0FEa0NjO0VBQ0ksbUJBQUE7RUFDQSxlQUFBO0VBQ0EsV0FBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFDQSxlQUFBO0VBQ0UsZUFBQTtBQ2hDcEI7QURpQ2tCO0VBQ0UsZ0JBQUE7RUFDQSxnQkFBQTtBQy9CcEI7QURrQ2M7RUFDSSxrQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7QUNoQ2xCO0FEaUNrQjtFQUNFLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxjQUFBO0FDL0JwQjtBRGlDa0I7RUFDSSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxRQUFBO0VBQ0EsMkJBQUE7QUMvQnRCO0FEZ0NzQjtFQUNJLFdBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGVBQUE7QUM5QjFCO0FEa0NvQjtFQUNJLHdCQUFBO0FDaEN4QjtBRGtDb0I7RUFDSSxrQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7QUNoQ3hCO0FEaUN3QjtFQUNFLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkFBQTtFQUNBLGNBQUE7QUMvQjFCO0FEb0NjO0VBQ0UscUJBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxlQUFBO0VBQ0EsZUFBQTtFQUNBLHlCQUFBO0VBQ0Esc0JBQUE7RUFFQSxpQkFBQTtBQ2xDaEI7QURzQ2M7RUFDRSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxlQUFBO0VBQ0EsU0FBQTtFQUNBLFFBQUE7QUNwQ2hCO0FEd0NjO0VBQ0Usa0JBQUE7RUFDQSxNQUFBO0VBQ0EsT0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0Esc0JBQUE7RUFDQSxzQkFBQTtBQ3RDaEI7QUQwQ2M7RUFDRSxzQkFBQTtBQ3hDaEI7QUQ0Q2M7RUFDRSx5QkFBQTtBQzFDaEI7QUQ2Q2M7RUFDRSxzQkFBQTtFQUNBLGVBQUE7QUMzQ2hCO0FEK0NjO0VBQ0UsV0FBQTtFQUNBLGtCQUFBO0VBQ0EsYUFBQTtBQzdDaEI7QURpRGM7RUFDRSxjQUFBO0FDL0NoQjtBRG1EYztFQUNFLFNBQUE7RUFDQSxRQUFBO0VBQ0EsVUFBQTtFQUNBLFdBQUE7RUFDQSxtQkFBQTtFQUNBLHlCQUFBO0VBR0Esd0JBQUE7QUNqRGhCO0FEbURjO0VBQ0ksdUJBQUE7QUNqRGxCO0FEc0RRO0VBQ0k7SUFDSSw2QkFBQTtJQUNBLDRCQUFBO0VDcERkO0VEc0RVO0lBQ0ksY0FBQTtFQ3BEZDtBQUNGO0FEOERvQjtFQUNFLGlCQUFBO0FDM0R0QjtBRCtEb0I7RUFDRSxpQkFBQTtBQzdEdEI7QUQrRG9CO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsV0FBQTtFQUNBLFFBQUE7RUFDQSwyQkFBQTtBQzdEeEI7QUQ4RHdCO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0EsZUFBQTtBQzVENUI7QURnRXNCO0VBQ0ksd0JBQUE7QUM5RDFCO0FEaUUwQjtFQUNFLGlCQUFBO0FDL0Q1QjtBRG9FZ0I7RUFDSSxtQkFBQTtFQUNBLGlCQUFBO0FDbEVwQiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL3ZpZXdyb2xlcy92aWV3cm9sZXMuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjdmlld3JvbGVze1xyXG4gICAgLnZpZXdyb2xlc25ld3tcclxuICAgICAgICBwYWRkaW5nOjAgMzBweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOjUwcHg7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZWFkb25seXtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWZsZXh7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZXtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0gICAgICAgICAgICBcclxuICAgICAgICB9XHJcbiAgICAgICAgLmFsaWduY2VudGVye1xyXG4gICAgICAgICAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbntcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2NjY7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiA1cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5wZXJtaXNzaW9udGFibGV7XHJcbiAgICAgICAgICAgIHdpZHRoOjEwMCU7XHJcbiAgICAgICAgICAgIHRhYmxlIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgYm94LXNoYWRvdzpub25lO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICB0ci5leGFtcGxlLWRldGFpbC1yb3cge1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAwO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICB0ci5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6IHdoaXRlc21va2U7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIHRyLmV4YW1wbGUtZWxlbWVudC1yb3c6bm90KC5leGFtcGxlLWV4cGFuZGVkLXJvdyk6YWN0aXZlIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNlZmVmZWY7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGV0YWlsIHtcclxuICAgICAgICAgICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA4MHB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAycHggc29saWQgYmxhY2s7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHg7XHJcbiAgICAgICAgICAgICAgICBmb250LXdlaWdodDogbGlnaHRlcjtcclxuICAgICAgICAgICAgICAgIG1hcmdpbjogOHB4IDA7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDEwNHB4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LXN5bWJvbCB7XHJcbiAgICAgICAgICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogNDBweDtcclxuICAgICAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiBub3JtYWw7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMTZweDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XHJcbiAgICAgICAgICAgICAgICBvcGFjaXR5OiAwLjU7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIHRhYmxlIHRoe1xyXG4gICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZToxNHB4O1xyXG4gICAgICAgICAgICAgICAgICBjb2xvcjojMzMzO1xyXG4gICAgICAgICAgICAgICAgICBmb250LXdlaWdodDo2MDA7XHJcbiAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246Y2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICBtaW4td2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgICBtYXgtd2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjI1MHB4O1xyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIHRhYmxlIHRke1xyXG4gICAgICAgICAgICAgICAgICBwb3NpdGlvbjpyZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjpjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDo3NXB4O1xyXG4gICAgICAgICAgICAgICAgICBtYXgtd2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjI1MHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgLmV4cGFuZGljb257XHJcbiAgICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjphYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgICAgIHJpZ2h0OjIwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0b3A6NTAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOnRyYW5zbGF0ZVkoLTUwJSk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjojNjY2O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcjpwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIC5zdWJ0YWJsZXtcclxuICAgICAgICAgICAgICAgICAgICB0ciB0aCwgdGhlYWR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgdHIgdGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOnJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjcycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1heC13aWR0aDo3MnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIG1heC13aWR0aDogMjQwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOiAyNDBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IzMzMzMzMztcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEycHg7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6MjVweDtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMjJweDtcclxuICAgICAgICAgICAgICAgIC13ZWJraXQtdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICAtbW96LXVzZXItc2VsZWN0OiBub25lO1xyXG4gICAgICAgICAgICAgICAgLW1zLXVzZXItc2VsZWN0OiBub25lO1xyXG4gICAgICAgICAgICAgICAgdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIEhpZGUgdGhlIGJyb3dzZXIncyBkZWZhdWx0IGNoZWNrYm94ICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0IHtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDA7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDA7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogQ3JlYXRlIGEgY3VzdG9tIGNoZWNrYm94ICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDA7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiAwO1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDE2cHg7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOjFweCBzb2xpZCAjYmJiO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAvKiBPbiBtb3VzZS1vdmVyLCBhZGQgYSBncmV5IGJhY2tncm91bmQgY29sb3IgKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXI6aG92ZXIgaW5wdXQgfiAuY2hlY2ttYXJrIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNjY2M7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIFdoZW4gdGhlIGNoZWNrYm94IGlzIGNoZWNrZWQsIGFkZCBhIGJsdWUgYmFja2dyb3VuZCAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAvKiBXaGVuIHRoZSBjaGVja2JveCBpcyBkaXNhYmxlZCwgYWRkIGEgYmx1ZSBiYWNrZ3JvdW5kICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0OmRpc2FibGVkIH4gLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZGRkO1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOm5vLWRyb3A7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIENyZWF0ZSB0aGUgY2hlY2ttYXJrL2luZGljYXRvciAoaGlkZGVuIHdoZW4gbm90IGNoZWNrZWQpICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogU2hvdyB0aGUgY2hlY2ttYXJrIHdoZW4gY2hlY2tlZCAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogU3R5bGUgdGhlIGNoZWNrbWFyay9pbmRpY2F0b3IgKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXIgLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiA0cHg7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDFweDtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiA0cHg7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDdweDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogc29saWQgd2hpdGU7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItd2lkdGg6IDAgMnB4IDJweCAwO1xyXG4gICAgICAgICAgICAgICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XHJcbiAgICAgICAgICAgICAgICAtbXMtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gICAgICAgICAgICAgICAgdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAubm9wYWRkaW5ndGR7XHJcbiAgICAgICAgICAgICAgICAgIHBhZGRpbmc6MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7ICAgIFxyXG4gICAgICAgICAgICAucGFkZGluZ3NwYWNpbmcge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5wZXJtaXNzaW9udGFibGV7XHJcbiAgICAgICAgICAgICAgICBvdmVyZmxvdzphdXRvO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5bZGlyPVwicnRsXCJdLCAucnRse1xyXG4gICAgI3ZpZXdyb2xlc3tcclxuICAgICAgICAudmlld3JvbGVzbmV3e1xyXG4gICAgICAgICAgICAucGVybWlzc2lvbnRhYmxle1xyXG4gICAgICAgICAgICAgICAgdGFibGUgdGh7XHJcbiAgICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246cmlnaHQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgdGFibGUgdGR7XHJcbiAgICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246cmlnaHQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5leHBhbmRpY29ue1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjphYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbGVmdDoyMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICByaWdodDphdXRvO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0b3A6NTAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06dHJhbnNsYXRlWSgtNTAlKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1pY29ue1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDoxOHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IzY2NjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcjpwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5zdWJ0YWJsZXtcclxuICAgICAgICAgICAgICAgICAgICAgIHRyIHRoLCB0aGVhZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICB0ciB0ZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjpyaWdodDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDoyNXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDowcHg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSBcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0iLCIjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcge1xuICBwYWRkaW5nOiAwIDMwcHg7XG4gIG1hcmdpbi1ib3R0b206IDUwcHg7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGNvbG9yOiAjZDlkOWQ5O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbiN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZC5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtMC45cmVtKSBzY2FsZSgwLjc1KTtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkgLm1hdC1mb3JtLWZpZWxkLWZsZXggLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kOiAjZWFlZGYyO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5hbGlnbmNlbnRlciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLmFsaWduY2VudGVyIC5tYXQtaWNvbiB7XG4gIHdpZHRoOiAxNnB4O1xuICBoZWlnaHQ6IDE2cHg7XG4gIGNvbG9yOiAjNjY2O1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGZvbnQtc2l6ZTogMjBweDtcbiAgbWFyZ2luLXRvcDogNXB4O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUge1xuICB3aWR0aDogMTAwJTtcbiAgLyogSGlkZSB0aGUgYnJvd3NlcidzIGRlZmF1bHQgY2hlY2tib3ggKi9cbiAgLyogQ3JlYXRlIGEgY3VzdG9tIGNoZWNrYm94ICovXG4gIC8qIE9uIG1vdXNlLW92ZXIsIGFkZCBhIGdyZXkgYmFja2dyb3VuZCBjb2xvciAqL1xuICAvKiBXaGVuIHRoZSBjaGVja2JveCBpcyBjaGVja2VkLCBhZGQgYSBibHVlIGJhY2tncm91bmQgKi9cbiAgLyogV2hlbiB0aGUgY2hlY2tib3ggaXMgZGlzYWJsZWQsIGFkZCBhIGJsdWUgYmFja2dyb3VuZCAqL1xuICAvKiBDcmVhdGUgdGhlIGNoZWNrbWFyay9pbmRpY2F0b3IgKGhpZGRlbiB3aGVuIG5vdCBjaGVja2VkKSAqL1xuICAvKiBTaG93IHRoZSBjaGVja21hcmsgd2hlbiBjaGVja2VkICovXG4gIC8qIFN0eWxlIHRoZSBjaGVja21hcmsvaW5kaWNhdG9yICovXG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB7XG4gIHdpZHRoOiAxMDAlO1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdHIuZXhhbXBsZS1kZXRhaWwtcm93IHtcbiAgaGVpZ2h0OiAwO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdHIuZXhhbXBsZS1lbGVtZW50LXJvdzpub3QoLmV4YW1wbGUtZXhwYW5kZWQtcm93KTpob3ZlciB7XG4gIGJhY2tncm91bmQ6IHdoaXRlc21va2U7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0ci5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmFjdGl2ZSB7XG4gIGJhY2tncm91bmQ6ICNlZmVmZWY7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LXJvdyB0ZCB7XG4gIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRldGFpbCB7XG4gIG92ZXJmbG93OiBoaWRkZW47XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xuICBtaW4td2lkdGg6IDgwcHg7XG4gIGJvcmRlcjogMnB4IHNvbGlkIGJsYWNrO1xuICBwYWRkaW5nOiA4cHg7XG4gIGZvbnQtd2VpZ2h0OiBsaWdodGVyO1xuICBtYXJnaW46IDhweCAwO1xuICBoZWlnaHQ6IDEwNHB4O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmV4YW1wbGUtZWxlbWVudC1zeW1ib2wge1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgZm9udC1zaXplOiA0MHB4O1xuICBsaW5lLWhlaWdodDogbm9ybWFsO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbiB7XG4gIHBhZGRpbmc6IDE2cHg7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uLWF0dHJpYnV0aW9uIHtcbiAgb3BhY2l0eTogMC41O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGgge1xuICBiYWNrZ3JvdW5kOiAjZWFlZGYyO1xuICBmb250LXNpemU6IDE0cHg7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXdlaWdodDogNjAwO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1pbi13aWR0aDogNzVweDtcbiAgbWF4LXdpZHRoOiA3NXB4O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGg6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiBsZWZ0O1xuICBtaW4td2lkdGg6IDI1MHB4O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgbWluLXdpZHRoOiA3NXB4O1xuICBtYXgtd2lkdGg6IDc1cHg7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG4gIG1pbi13aWR0aDogMjUwcHg7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24ge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHJpZ2h0OiAyMHB4O1xuICB0b3A6IDUwJTtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC01MCUpO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24gLm1hdC1pY29uIHtcbiAgd2lkdGg6IDE4cHg7XG4gIGhlaWdodDogMThweDtcbiAgY29sb3I6ICM2NjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0ciB0aCwgI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRoZWFkIHtcbiAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1pbi13aWR0aDogNzJweDtcbiAgbWF4LXdpZHRoOiA3MnB4O1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkOmZpcnN0LWNoaWxkIHtcbiAgbWF4LXdpZHRoOiAyNDBweDtcbiAgbWluLXdpZHRoOiAyNDBweDtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbiAgY29sb3I6ICMzMzMzMzM7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIge1xuICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgbWFyZ2luLWJvdHRvbTogMTJweDtcbiAgcGFkZGluZy1sZWZ0OiAyNXB4O1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGZvbnQtc2l6ZTogMjJweDtcbiAgLXdlYmtpdC11c2VyLXNlbGVjdDogbm9uZTtcbiAgLW1vei11c2VyLXNlbGVjdDogbm9uZTtcbiAgLW1zLXVzZXItc2VsZWN0OiBub25lO1xuICB1c2VyLXNlbGVjdDogbm9uZTtcbn1cbiN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciBpbnB1dCB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgb3BhY2l0eTogMDtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBoZWlnaHQ6IDA7XG4gIHdpZHRoOiAwO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrbWFyayB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgdG9wOiAwO1xuICBsZWZ0OiAwO1xuICBoZWlnaHQ6IDE2cHg7XG4gIHdpZHRoOiAxNnB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBib3JkZXI6IDFweCBzb2xpZCAjYmJiO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyOmhvdmVyIGlucHV0IH4gLmNoZWNrbWFyayB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNjY2M7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIgaW5wdXQ6Y2hlY2tlZCB+IC5jaGVja21hcmsge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xufVxuI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyIGlucHV0OmRpc2FibGVkIH4gLmNoZWNrbWFyayB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNkZGQ7XG4gIGN1cnNvcjogbm8tZHJvcDtcbn1cbiN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja21hcms6YWZ0ZXIge1xuICBjb250ZW50OiBcIlwiO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIgaW5wdXQ6Y2hlY2tlZCB+IC5jaGVja21hcms6YWZ0ZXIge1xuICBkaXNwbGF5OiBibG9jaztcbn1cbiN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciAuY2hlY2ttYXJrOmFmdGVyIHtcbiAgbGVmdDogNHB4O1xuICB0b3A6IDFweDtcbiAgd2lkdGg6IDRweDtcbiAgaGVpZ2h0OiA3cHg7XG4gIGJvcmRlcjogc29saWQgd2hpdGU7XG4gIGJvcmRlci13aWR0aDogMCAycHggMnB4IDA7XG4gIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xuICAtbXMtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xuICB0cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XG59XG4jdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSAubm9wYWRkaW5ndGQge1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBhZGRpbmdzcGFjaW5nIHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG4gICN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHtcbiAgICBvdmVyZmxvdzogYXV0bztcbiAgfVxufVxuXG5bZGlyPXJ0bF0gI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGg6Zmlyc3QtY2hpbGQsIC5ydGwgI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGg6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbltkaXI9cnRsXSAjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCwgLnJ0bCAjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuW2Rpcj1ydGxdICN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5leHBhbmRpY29uLCAucnRsICN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5leHBhbmRpY29uIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBsZWZ0OiAyMHB4O1xuICByaWdodDogYXV0bztcbiAgdG9wOiA1MCU7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtNTAlKTtcbn1cbltkaXI9cnRsXSAjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuZXhwYW5kaWNvbiAubWF0LWljb24sIC5ydGwgI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24gLm1hdC1pY29uIHtcbiAgd2lkdGg6IDE4cHg7XG4gIGhlaWdodDogMThweDtcbiAgY29sb3I6ICM2NjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbltkaXI9cnRsXSAjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGgsIFtkaXI9cnRsXSAjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdGhlYWQsIC5ydGwgI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRoLCAucnRsICN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0aGVhZCB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cbltkaXI9cnRsXSAjdmlld3JvbGVzIC52aWV3cm9sZXNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGQ6Zmlyc3QtY2hpbGQsIC5ydGwgI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkOmZpcnN0LWNoaWxkIHtcbiAgdGV4dC1hbGlnbjogcmlnaHQ7XG59XG5bZGlyPXJ0bF0gI3ZpZXdyb2xlcyAudmlld3JvbGVzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyLCAucnRsICN2aWV3cm9sZXMgLnZpZXdyb2xlc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciB7XG4gIHBhZGRpbmctcmlnaHQ6IDI1cHg7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xufSJdfQ== */");

/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.ts":
/*!*****************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.ts ***!
  \*****************************************************************************/
/*! exports provided: ViewrolesComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ViewrolesComponent", function() { return ViewrolesComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_animations__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/animations */ "./node_modules/@angular/animations/__ivy_ngcc__/fesm2015/animations.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");








const ELEMENT_DATA = [
    {
        id: 1,
        name: 'Module - 1',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 11,
                sname: 'SubModule - 1',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 12,
                sname: 'SubModule - 2',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 13,
                sname: 'SubModule - 3',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 2,
        name: 'Module - 2',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 21,
                sname: 'SubModule - 5',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 22,
                sname: 'SubModule - 6',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 23,
                sname: 'SubModule - 7',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 3,
        name: 'Module - 3',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 31,
                sname: 'SubModule - 7',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 32,
                sname: 'SubModule - 8',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 4,
        name: 'Module - 4',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 41,
                sname: 'SubModule - 9',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 42,
                sname: 'SubModule - 10',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }
];
let ViewrolesComponent = class ViewrolesComponent {
    constructor(formBuilder, translate, remoteService, cookieService) {
        this.formBuilder = formBuilder;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_3__["ErrorStateMatcher"]();
        this.dataSource = ELEMENT_DATA;
        this.columnsToDisplay = ['name', 'create', 'update', 'delete', 'approve', 'download'];
        this.innerDisplayedColumns = ['sname', 'screate', 'supdate', 'sdelete', 'sapprove', 'sdownload'];
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
    }
    ngOnInit() {
        this.initializeForm();
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
    }
    initializeForm() {
        this.viewroleform = this.formBuilder.group({
            stkholdertype: [null],
            techeval: [null],
            arrole: [null],
            arrolehigh: [null]
        });
    }
    get viewrolform() {
        return this.viewroleform.controls;
    }
};
ViewrolesComponent.ctorParameters = () => [
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] },
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"] }
];
ViewrolesComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-viewroles',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./viewroles.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        animations: [
            Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["trigger"])('detailExpand', [
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '0px', minHeight: '0' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('expanded', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '*' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["transition"])('expanded <=> collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["animate"])('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
            ]),
        ],
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./viewroles.component.scss */ "./src/app/modules/newenterpriseadmin/viewroles/viewroles.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"]])
], ViewrolesComponent);



/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.scss":
/*!*******************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.scss ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("#viewusers .viewusersnew {\n  padding: 0 30px;\n  margin-bottom: 50px;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline .mat-form-field-outline {\n  color: #d9d9d9;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline .mat-form-field-outline-start {\n  border-radius: 3px 0 0 3px;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline .mat-form-field-outline-end {\n  border-radius: 0 3px 3px 0;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline .mat-form-field-outline-thick {\n  color: #6ba5ec;\n  background-color: #f8f8f8;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline.mat-focused .mat-form-field-outline-thick {\n  color: #0c4b9a;\n  background-color: #f8f8f8;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline.mat-focused.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  color: #0c4b9a;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline.mat-form-field-disabled .mat-form-field-outline {\n  background-color: #f8f8f8;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline.mat-form-field-invalid.mat-form-field-invalid .mat-form-field-outline-thick {\n  color: #dc4c64;\n  background-color: #f8f8f8;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label {\n  transform: translateY(-0.9rem) scale(0.75);\n  color: #848484;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-label .mat-form-field-required-marker {\n  color: #ED1C27;\n}\n#viewusers .viewusersnew .mat-form-field-appearance-outline.mat-form-field-can-float.mat-form-field-should-float .mat-form-field-outline-gap {\n  width: 0px !important;\n}\n#viewusers .viewusersnew .mat-form-field-readonly .mat-form-field-flex .mat-form-field-outline {\n  background: #eaedf2;\n}\n#viewusers .viewusersnew .aligncenter {\n  display: flex;\n  align-items: center;\n}\n#viewusers .viewusersnew .aligncenter .mat-icon {\n  width: 16px;\n  height: 16px;\n  color: #666;\n  cursor: pointer;\n  font-size: 20px;\n  margin-top: 5px;\n}\n#viewusers .viewusersnew .permissiontable {\n  width: 100%;\n  /* Hide the browser's default checkbox */\n  /* Create a custom checkbox */\n  /* On mouse-over, add a grey background color */\n  /* When the checkbox is checked, add a blue background */\n  /* When the checkbox is disabled, add a blue background */\n  /* Create the checkmark/indicator (hidden when not checked) */\n  /* Show the checkmark when checked */\n  /* Style the checkmark/indicator */\n}\n#viewusers .viewusersnew .permissiontable table {\n  width: 100%;\n  box-shadow: none;\n}\n#viewusers .viewusersnew .permissiontable tr.example-detail-row {\n  height: 0;\n}\n#viewusers .viewusersnew .permissiontable tr.example-element-row:not(.example-expanded-row):hover {\n  background: whitesmoke;\n}\n#viewusers .viewusersnew .permissiontable tr.example-element-row:not(.example-expanded-row):active {\n  background: #efefef;\n}\n#viewusers .viewusersnew .permissiontable .example-element-row td {\n  border-bottom-width: 0;\n}\n#viewusers .viewusersnew .permissiontable .example-element-detail {\n  overflow: hidden;\n  display: flex;\n}\n#viewusers .viewusersnew .permissiontable .example-element-diagram {\n  min-width: 80px;\n  border: 2px solid black;\n  padding: 8px;\n  font-weight: lighter;\n  margin: 8px 0;\n  height: 104px;\n}\n#viewusers .viewusersnew .permissiontable .example-element-symbol {\n  font-weight: bold;\n  font-size: 40px;\n  line-height: normal;\n}\n#viewusers .viewusersnew .permissiontable .example-element-description {\n  padding: 16px;\n}\n#viewusers .viewusersnew .permissiontable .example-element-description-attribution {\n  opacity: 0.5;\n}\n#viewusers .viewusersnew .permissiontable table th {\n  background: #eaedf2;\n  font-size: 14px;\n  color: #333;\n  font-weight: 600;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#viewusers .viewusersnew .permissiontable table th:first-child {\n  text-align: left;\n  min-width: 250px;\n}\n#viewusers .viewusersnew .permissiontable table td {\n  position: relative;\n  text-align: center;\n  min-width: 75px;\n  max-width: 75px;\n}\n#viewusers .viewusersnew .permissiontable table td:first-child {\n  text-align: left;\n  min-width: 250px;\n  color: #0c4b9a;\n}\n#viewusers .viewusersnew .permissiontable table td .expandicon {\n  position: absolute;\n  right: 20px;\n  top: 50%;\n  transform: translateY(-50%);\n}\n#viewusers .viewusersnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n#viewusers .viewusersnew .permissiontable table td .subtable tr th, #viewusers .viewusersnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n#viewusers .viewusersnew .permissiontable table td .subtable tr td {\n  position: relative;\n  text-align: center;\n  min-width: 72px;\n  max-width: 72px;\n}\n#viewusers .viewusersnew .permissiontable table td .subtable tr td:first-child {\n  max-width: 240px;\n  min-width: 240px;\n  text-align: left;\n  color: #333333;\n}\n#viewusers .viewusersnew .permissiontable .checkcontainer {\n  display: inline-block;\n  position: relative;\n  margin-bottom: 12px;\n  padding-left: 25px;\n  cursor: pointer;\n  font-size: 22px;\n  -webkit-user-select: none;\n  -moz-user-select: none;\n  user-select: none;\n}\n#viewusers .viewusersnew .permissiontable .checkcontainer input {\n  position: absolute;\n  opacity: 0;\n  cursor: pointer;\n  height: 0;\n  width: 0;\n}\n#viewusers .viewusersnew .permissiontable .checkmark {\n  position: absolute;\n  top: 0;\n  left: 0;\n  height: 16px;\n  width: 16px;\n  background-color: #fff;\n  border: 1px solid #bbb;\n}\n#viewusers .viewusersnew .permissiontable .checkcontainer:hover input ~ .checkmark {\n  background-color: #ccc;\n}\n#viewusers .viewusersnew .permissiontable .checkcontainer input:checked ~ .checkmark {\n  background-color: #0c4b9a;\n}\n#viewusers .viewusersnew .permissiontable .checkcontainer input:disabled ~ .checkmark {\n  background-color: #ddd;\n  cursor: no-drop;\n}\n#viewusers .viewusersnew .permissiontable .checkmark:after {\n  content: \"\";\n  position: absolute;\n  display: none;\n}\n#viewusers .viewusersnew .permissiontable .checkcontainer input:checked ~ .checkmark:after {\n  display: block;\n}\n#viewusers .viewusersnew .permissiontable .checkcontainer .checkmark:after {\n  left: 4px;\n  top: 1px;\n  width: 4px;\n  height: 7px;\n  border: solid white;\n  border-width: 0 2px 2px 0;\n  transform: rotate(45deg);\n}\n#viewusers .viewusersnew .permissiontable .nopaddingtd {\n  padding: 0px !important;\n}\n@media (max-width: 768px) {\n  #viewusers .viewusersnew .paddingspacing {\n    padding-right: 0px !important;\n    padding-left: 0px !important;\n  }\n  #viewusers .viewusersnew .permissiontable {\n    overflow: auto;\n  }\n}\n[dir=rtl] #viewusers .viewusersnew .permissiontable table th:first-child, .rtl #viewusers .viewusersnew .permissiontable table th:first-child {\n  text-align: right;\n}\n[dir=rtl] #viewusers .viewusersnew .permissiontable table td:first-child, .rtl #viewusers .viewusersnew .permissiontable table td:first-child {\n  text-align: right;\n}\n[dir=rtl] #viewusers .viewusersnew .permissiontable table td .expandicon, .rtl #viewusers .viewusersnew .permissiontable table td .expandicon {\n  position: absolute;\n  left: 20px;\n  right: auto;\n  top: 50%;\n  transform: translateY(-50%);\n}\n[dir=rtl] #viewusers .viewusersnew .permissiontable table td .expandicon .mat-icon, .rtl #viewusers .viewusersnew .permissiontable table td .expandicon .mat-icon {\n  width: 18px;\n  height: 18px;\n  color: #666;\n  cursor: pointer;\n}\n[dir=rtl] #viewusers .viewusersnew .permissiontable table td .subtable tr th, [dir=rtl] #viewusers .viewusersnew .permissiontable table td .subtable thead, .rtl #viewusers .viewusersnew .permissiontable table td .subtable tr th, .rtl #viewusers .viewusersnew .permissiontable table td .subtable thead {\n  display: none !important;\n}\n[dir=rtl] #viewusers .viewusersnew .permissiontable table td .subtable tr td:first-child, .rtl #viewusers .viewusersnew .permissiontable table td .subtable tr td:first-child {\n  text-align: right;\n}\n[dir=rtl] #viewusers .viewusersnew .permissiontable .checkcontainer, .rtl #viewusers .viewusersnew .permissiontable .checkcontainer {\n  padding-right: 25px;\n  padding-left: 0px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9uZXdlbnRlcnByaXNlYWRtaW4vdmlld3VzZXJzL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXG5ld2VudGVycHJpc2VhZG1pblxcdmlld3VzZXJzXFx2aWV3dXNlcnMuY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL3ZpZXd1c2Vycy92aWV3dXNlcnMuY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQ0k7RUFDSSxlQUFBO0VBQ0EsbUJBQUE7QUNBUjtBREVZO0VBQ0ksY0FBQTtBQ0FoQjtBREdZO0VBQ0ksMEJBQUE7QUNEaEI7QURJWTtFQUNJLDBCQUFBO0FDRmhCO0FES1k7RUFDSSxjQUFBO0FDSGhCO0FETVk7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNKaEI7QURRZ0I7RUFDSSxjQUFBO0VBQ0EseUJBQUE7QUNOcEI7QURXd0I7RUFDSSxjQUFBO0FDVDVCO0FEZ0JnQjtFQUNJLHlCQUFBO0FDZHBCO0FEb0JnQjtFQUNJLGNBQUE7RUFDQSx5QkFBQTtBQ2xCcEI7QUR3Qm9CO0VBQ0ksMENBQUE7RUFDQSxjQUFBO0FDdEJ4QjtBRHdCd0I7RUFDSSxjQUFBO0FDdEI1QjtBRDBCb0I7RUFDSSxxQkFBQTtBQ3hCeEI7QUQrQmdCO0VBQ0ksbUJBQUE7QUM3QnBCO0FEaUNRO0VBQ0ksYUFBQTtFQUNBLG1CQUFBO0FDL0JaO0FEZ0NZO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7RUFDQSxlQUFBO0FDOUJoQjtBRGtDUTtFQUNJLFdBQUE7RUFtSEUsd0NBQUE7RUFTQSw2QkFBQTtFQVdBLCtDQUFBO0VBS0Esd0RBQUE7RUFJQSx5REFBQTtFQU1BLDZEQUFBO0VBT0Esb0NBQUE7RUFLQSxrQ0FBQTtBQzFMZDtBRHlCWTtFQUNJLFdBQUE7RUFDQSxnQkFBQTtBQ3ZCaEI7QUQwQmM7RUFDRSxTQUFBO0FDeEJoQjtBRDJCYztFQUNFLHNCQUFBO0FDekJoQjtBRDRCYztFQUNFLG1CQUFBO0FDMUJoQjtBRDZCYztFQUNFLHNCQUFBO0FDM0JoQjtBRDhCYztFQUNFLGdCQUFBO0VBQ0EsYUFBQTtBQzVCaEI7QUQrQmM7RUFDRSxlQUFBO0VBQ0EsdUJBQUE7RUFDQSxZQUFBO0VBQ0Esb0JBQUE7RUFDQSxhQUFBO0VBQ0EsYUFBQTtBQzdCaEI7QURnQ2M7RUFDRSxpQkFBQTtFQUNBLGVBQUE7RUFDQSxtQkFBQTtBQzlCaEI7QURpQ2M7RUFDRSxhQUFBO0FDL0JoQjtBRGtDYztFQUNFLFlBQUE7QUNoQ2hCO0FEa0NjO0VBQ0ksbUJBQUE7RUFDQSxlQUFBO0VBQ0EsV0FBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7RUFDQSxlQUFBO0VBQ0UsZUFBQTtBQ2hDcEI7QURpQ2tCO0VBQ0UsZ0JBQUE7RUFDQSxnQkFBQTtBQy9CcEI7QURrQ2M7RUFDSSxrQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7QUNoQ2xCO0FEaUNrQjtFQUNFLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxjQUFBO0FDL0JwQjtBRGlDa0I7RUFDSSxrQkFBQTtFQUNBLFdBQUE7RUFDQSxRQUFBO0VBQ0EsMkJBQUE7QUMvQnRCO0FEZ0NzQjtFQUNJLFdBQUE7RUFDQSxZQUFBO0VBQ0EsV0FBQTtFQUNBLGVBQUE7QUM5QjFCO0FEa0NvQjtFQUNJLHdCQUFBO0FDaEN4QjtBRGtDb0I7RUFDSSxrQkFBQTtFQUNBLGtCQUFBO0VBQ0EsZUFBQTtFQUNBLGVBQUE7QUNoQ3hCO0FEaUN3QjtFQUNFLGdCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxnQkFBQTtFQUNBLGNBQUE7QUMvQjFCO0FEb0NjO0VBQ0UscUJBQUE7RUFDQSxrQkFBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxlQUFBO0VBQ0EsZUFBQTtFQUNBLHlCQUFBO0VBQ0Esc0JBQUE7RUFFQSxpQkFBQTtBQ2xDaEI7QURzQ2M7RUFDRSxrQkFBQTtFQUNBLFVBQUE7RUFDQSxlQUFBO0VBQ0EsU0FBQTtFQUNBLFFBQUE7QUNwQ2hCO0FEd0NjO0VBQ0Usa0JBQUE7RUFDQSxNQUFBO0VBQ0EsT0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0Esc0JBQUE7RUFDQSxzQkFBQTtBQ3RDaEI7QUQwQ2M7RUFDRSxzQkFBQTtBQ3hDaEI7QUQ0Q2M7RUFDRSx5QkFBQTtBQzFDaEI7QUQ2Q2M7RUFDRSxzQkFBQTtFQUNBLGVBQUE7QUMzQ2hCO0FEK0NjO0VBQ0UsV0FBQTtFQUNBLGtCQUFBO0VBQ0EsYUFBQTtBQzdDaEI7QURpRGM7RUFDRSxjQUFBO0FDL0NoQjtBRG1EYztFQUNFLFNBQUE7RUFDQSxRQUFBO0VBQ0EsVUFBQTtFQUNBLFdBQUE7RUFDQSxtQkFBQTtFQUNBLHlCQUFBO0VBR0Esd0JBQUE7QUNqRGhCO0FEbURjO0VBQ0ksdUJBQUE7QUNqRGxCO0FEc0RRO0VBQ0k7SUFDSSw2QkFBQTtJQUNBLDRCQUFBO0VDcERkO0VEc0RVO0lBQ0ksY0FBQTtFQ3BEZDtBQUNGO0FEOERvQjtFQUNFLGlCQUFBO0FDM0R0QjtBRCtEb0I7RUFDRSxpQkFBQTtBQzdEdEI7QUQrRG9CO0VBQ0ksa0JBQUE7RUFDQSxVQUFBO0VBQ0EsV0FBQTtFQUNBLFFBQUE7RUFDQSwyQkFBQTtBQzdEeEI7QUQ4RHdCO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxXQUFBO0VBQ0EsZUFBQTtBQzVENUI7QURnRXNCO0VBQ0ksd0JBQUE7QUM5RDFCO0FEaUUwQjtFQUNFLGlCQUFBO0FDL0Q1QjtBRG9FZ0I7RUFDSSxtQkFBQTtFQUNBLGlCQUFBO0FDbEVwQiIsImZpbGUiOiJzcmMvYXBwL21vZHVsZXMvbmV3ZW50ZXJwcmlzZWFkbWluL3ZpZXd1c2Vycy92aWV3dXNlcnMuY29tcG9uZW50LnNjc3MiLCJzb3VyY2VzQ29udGVudCI6WyIjdmlld3VzZXJze1xyXG4gICAgLnZpZXd1c2Vyc25ld3tcclxuICAgICAgICBwYWRkaW5nOjAgMzBweDtcclxuICAgICAgICBtYXJnaW4tYm90dG9tOjUwcHg7XHJcbiAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSB7XHJcbiAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjZDlkOWQ5O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogM3B4IDAgMCAzcHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1lbmQge1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMCAzcHggM3B4IDA7XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjRUQxQzI3O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2YmE1ZWM7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9jdXNlZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS10aGljayB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQge1xyXG4gICAgICAgICAgICAgICAgICAgICYubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1kaXNhYmxlZCB7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICBcclxuICAgICAgICAgICAgJi5tYXQtZm9ybS1maWVsZC1pbnZhbGlkLm1hdC1mb3JtLWZpZWxkLWludmFsaWQge1xyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjZGM0YzY0O1xyXG4gICAgICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLWNhbi1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAmLm1hdC1mb3JtLWZpZWxkLXNob3VsZC1mbG9hdCB7XHJcbiAgICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWxhYmVsIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC0uOXJlbSkgc2NhbGUoMC43NSk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjODQ4NDg0O1xyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZXF1aXJlZC1tYXJrZXIge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNFRDFDMjc7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICBcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZS1nYXAge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtZm9ybS1maWVsZC1yZWFkb25seXtcclxuICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWZsZXh7XHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtb3V0bGluZXtcclxuICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0gICAgICAgICAgICBcclxuICAgICAgICB9XHJcbiAgICAgICAgLmFsaWduY2VudGVye1xyXG4gICAgICAgICAgICBkaXNwbGF5OmZsZXg7XHJcbiAgICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XHJcbiAgICAgICAgICAgIC5tYXQtaWNvbntcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICM2NjY7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDIwcHg7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiA1cHg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIC5wZXJtaXNzaW9udGFibGV7XHJcbiAgICAgICAgICAgIHdpZHRoOjEwMCU7XHJcbiAgICAgICAgICAgIHRhYmxlIHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgYm94LXNoYWRvdzpub25lO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICB0ci5leGFtcGxlLWRldGFpbC1yb3cge1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAwO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICB0ci5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmhvdmVyIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6IHdoaXRlc21va2U7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIHRyLmV4YW1wbGUtZWxlbWVudC1yb3c6bm90KC5leGFtcGxlLWV4cGFuZGVkLXJvdyk6YWN0aXZlIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICNlZmVmZWY7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtcm93IHRkIHtcclxuICAgICAgICAgICAgICAgIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGV0YWlsIHtcclxuICAgICAgICAgICAgICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA4MHB4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOiAycHggc29saWQgYmxhY2s7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiA4cHg7XHJcbiAgICAgICAgICAgICAgICBmb250LXdlaWdodDogbGlnaHRlcjtcclxuICAgICAgICAgICAgICAgIG1hcmdpbjogOHB4IDA7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDEwNHB4O1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAuZXhhbXBsZS1lbGVtZW50LXN5bWJvbCB7XHJcbiAgICAgICAgICAgICAgICBmb250LXdlaWdodDogYm9sZDtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogNDBweDtcclxuICAgICAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiBub3JtYWw7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC5leGFtcGxlLWVsZW1lbnQtZGVzY3JpcHRpb24ge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMTZweDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbi1hdHRyaWJ1dGlvbiB7XHJcbiAgICAgICAgICAgICAgICBvcGFjaXR5OiAwLjU7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIHRhYmxlIHRoe1xyXG4gICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiNlYWVkZjI7XHJcbiAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZToxNHB4O1xyXG4gICAgICAgICAgICAgICAgICBjb2xvcjojMzMzO1xyXG4gICAgICAgICAgICAgICAgICBmb250LXdlaWdodDo2MDA7XHJcbiAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246Y2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICBtaW4td2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgICBtYXgtd2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjI1MHB4O1xyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIHRhYmxlIHRke1xyXG4gICAgICAgICAgICAgICAgICBwb3NpdGlvbjpyZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjpjZW50ZXI7XHJcbiAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDo3NXB4O1xyXG4gICAgICAgICAgICAgICAgICBtYXgtd2lkdGg6NzVweDtcclxuICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjI1MHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiMwYzRiOWE7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgLmV4cGFuZGljb257XHJcbiAgICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjphYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgICAgIHJpZ2h0OjIwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICB0b3A6NTAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgdHJhbnNmb3JtOnRyYW5zbGF0ZVkoLTUwJSk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBoZWlnaHQ6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjojNjY2O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcjpwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIC5zdWJ0YWJsZXtcclxuICAgICAgICAgICAgICAgICAgICB0ciB0aCwgdGhlYWR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgdHIgdGR7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBvc2l0aW9uOnJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmNlbnRlcjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOjcycHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIG1heC13aWR0aDo3MnB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIG1heC13aWR0aDogMjQwcHg7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgbWluLXdpZHRoOiAyNDBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICB0ZXh0LWFsaWduOmxlZnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IzMzMzMzMztcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIHtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcclxuICAgICAgICAgICAgICAgIG1hcmdpbi1ib3R0b206IDEycHg7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6MjVweDtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMjJweDtcclxuICAgICAgICAgICAgICAgIC13ZWJraXQtdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgICAtbW96LXVzZXItc2VsZWN0OiBub25lO1xyXG4gICAgICAgICAgICAgICAgLW1zLXVzZXItc2VsZWN0OiBub25lO1xyXG4gICAgICAgICAgICAgICAgdXNlci1zZWxlY3Q6IG5vbmU7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIEhpZGUgdGhlIGJyb3dzZXIncyBkZWZhdWx0IGNoZWNrYm94ICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0IHtcclxuICAgICAgICAgICAgICAgIHBvc2l0aW9uOiBhYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgIG9wYWNpdHk6IDA7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDA7XHJcbiAgICAgICAgICAgICAgICB3aWR0aDogMDtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogQ3JlYXRlIGEgY3VzdG9tIGNoZWNrYm94ICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDA7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiAwO1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAxNnB4O1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDE2cHg7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyOjFweCBzb2xpZCAjYmJiO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAvKiBPbiBtb3VzZS1vdmVyLCBhZGQgYSBncmV5IGJhY2tncm91bmQgY29sb3IgKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXI6aG92ZXIgaW5wdXQgfiAuY2hlY2ttYXJrIHtcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNjY2M7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIFdoZW4gdGhlIGNoZWNrYm94IGlzIGNoZWNrZWQsIGFkZCBhIGJsdWUgYmFja2dyb3VuZCAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAvKiBXaGVuIHRoZSBjaGVja2JveCBpcyBkaXNhYmxlZCwgYWRkIGEgYmx1ZSBiYWNrZ3JvdW5kICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrY29udGFpbmVyIGlucHV0OmRpc2FibGVkIH4gLmNoZWNrbWFyayB7XHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZGRkO1xyXG4gICAgICAgICAgICAgICAgY3Vyc29yOm5vLWRyb3A7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgIC8qIENyZWF0ZSB0aGUgY2hlY2ttYXJrL2luZGljYXRvciAoaGlkZGVuIHdoZW4gbm90IGNoZWNrZWQpICovXHJcbiAgICAgICAgICAgICAgLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBjb250ZW50OiBcIlwiO1xyXG4gICAgICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZTtcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogU2hvdyB0aGUgY2hlY2ttYXJrIHdoZW4gY2hlY2tlZCAqL1xyXG4gICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciBpbnB1dDpjaGVja2VkIH4gLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcclxuICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgLyogU3R5bGUgdGhlIGNoZWNrbWFyay9pbmRpY2F0b3IgKi9cclxuICAgICAgICAgICAgICAuY2hlY2tjb250YWluZXIgLmNoZWNrbWFyazphZnRlciB7XHJcbiAgICAgICAgICAgICAgICBsZWZ0OiA0cHg7XHJcbiAgICAgICAgICAgICAgICB0b3A6IDFweDtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiA0cHg7XHJcbiAgICAgICAgICAgICAgICBoZWlnaHQ6IDdweDtcclxuICAgICAgICAgICAgICAgIGJvcmRlcjogc29saWQgd2hpdGU7XHJcbiAgICAgICAgICAgICAgICBib3JkZXItd2lkdGg6IDAgMnB4IDJweCAwO1xyXG4gICAgICAgICAgICAgICAgLXdlYmtpdC10cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XHJcbiAgICAgICAgICAgICAgICAtbXMtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gICAgICAgICAgICAgICAgdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xyXG4gICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAubm9wYWRkaW5ndGR7XHJcbiAgICAgICAgICAgICAgICAgIHBhZGRpbmc6MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7ICAgIFxyXG4gICAgICAgICAgICAucGFkZGluZ3NwYWNpbmcge1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5wZXJtaXNzaW9udGFibGV7XHJcbiAgICAgICAgICAgICAgICBvdmVyZmxvdzphdXRvO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG59XHJcblxyXG5bZGlyPVwicnRsXCJdLCAucnRse1xyXG4gICAgI3ZpZXd1c2Vyc3tcclxuICAgICAgICAudmlld3VzZXJzbmV3e1xyXG4gICAgICAgICAgICAucGVybWlzc2lvbnRhYmxle1xyXG4gICAgICAgICAgICAgICAgdGFibGUgdGh7XHJcbiAgICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246cmlnaHQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgdGFibGUgdGR7XHJcbiAgICAgICAgICAgICAgICAgICAgJjpmaXJzdC1jaGlsZHtcclxuICAgICAgICAgICAgICAgICAgICAgIHRleHQtYWxpZ246cmlnaHQ7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5leHBhbmRpY29ue1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjphYnNvbHV0ZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbGVmdDoyMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICByaWdodDphdXRvO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0b3A6NTAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0cmFuc2Zvcm06dHJhbnNsYXRlWSgtNTAlKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLm1hdC1pY29ue1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6MThweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGhlaWdodDoxOHB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6IzY2NjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1cnNvcjpwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIC5zdWJ0YWJsZXtcclxuICAgICAgICAgICAgICAgICAgICAgIHRyIHRoLCB0aGVhZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICB0ciB0ZHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAmOmZpcnN0LWNoaWxke1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgdGV4dC1hbGlnbjpyaWdodDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIC5jaGVja2NvbnRhaW5lciB7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1yaWdodDoyNXB4O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDowcHg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSBcclxuICAgICAgICB9XHJcbiAgICB9XHJcbn0iLCIjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcge1xuICBwYWRkaW5nOiAwIDMwcHg7XG4gIG1hcmdpbi1ib3R0b206IDUwcHg7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZSAubWF0LWZvcm0tZmllbGQtb3V0bGluZSB7XG4gIGNvbG9yOiAjZDlkOWQ5O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtc3RhcnQge1xuICBib3JkZXItcmFkaXVzOiAzcHggMCAwIDNweDtcbn1cbiN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWVuZCB7XG4gIGJvcmRlci1yYWRpdXM6IDAgM3B4IDNweCAwO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLXJlcXVpcmVkLW1hcmtlciB7XG4gIGNvbG9yOiAjRUQxQzI3O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUtdGhpY2sge1xuICBjb2xvcjogIzZiYTVlYztcbiAgYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODtcbn1cbiN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1vdXRsaW5lLm1hdC1mb2N1c2VkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICMwYzRiOWE7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9jdXNlZC5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtZGlzYWJsZWQgLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjhmOGY4O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLW91dGxpbmUubWF0LWZvcm0tZmllbGQtaW52YWxpZC5tYXQtZm9ybS1maWVsZC1pbnZhbGlkIC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLXRoaWNrIHtcbiAgY29sb3I6ICNkYzRjNjQ7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCB7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtMC45cmVtKSBzY2FsZSgwLjc1KTtcbiAgY29sb3I6ICM4NDg0ODQ7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1sYWJlbCAubWF0LWZvcm0tZmllbGQtcmVxdWlyZWQtbWFya2VyIHtcbiAgY29sb3I6ICNFRDFDMjc7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLm1hdC1mb3JtLWZpZWxkLWFwcGVhcmFuY2Utb3V0bGluZS5tYXQtZm9ybS1maWVsZC1jYW4tZmxvYXQubWF0LWZvcm0tZmllbGQtc2hvdWxkLWZsb2F0IC5tYXQtZm9ybS1maWVsZC1vdXRsaW5lLWdhcCB7XG4gIHdpZHRoOiAwcHggIWltcG9ydGFudDtcbn1cbiN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAubWF0LWZvcm0tZmllbGQtcmVhZG9ubHkgLm1hdC1mb3JtLWZpZWxkLWZsZXggLm1hdC1mb3JtLWZpZWxkLW91dGxpbmUge1xuICBiYWNrZ3JvdW5kOiAjZWFlZGYyO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5hbGlnbmNlbnRlciB7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLmFsaWduY2VudGVyIC5tYXQtaWNvbiB7XG4gIHdpZHRoOiAxNnB4O1xuICBoZWlnaHQ6IDE2cHg7XG4gIGNvbG9yOiAjNjY2O1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGZvbnQtc2l6ZTogMjBweDtcbiAgbWFyZ2luLXRvcDogNXB4O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUge1xuICB3aWR0aDogMTAwJTtcbiAgLyogSGlkZSB0aGUgYnJvd3NlcidzIGRlZmF1bHQgY2hlY2tib3ggKi9cbiAgLyogQ3JlYXRlIGEgY3VzdG9tIGNoZWNrYm94ICovXG4gIC8qIE9uIG1vdXNlLW92ZXIsIGFkZCBhIGdyZXkgYmFja2dyb3VuZCBjb2xvciAqL1xuICAvKiBXaGVuIHRoZSBjaGVja2JveCBpcyBjaGVja2VkLCBhZGQgYSBibHVlIGJhY2tncm91bmQgKi9cbiAgLyogV2hlbiB0aGUgY2hlY2tib3ggaXMgZGlzYWJsZWQsIGFkZCBhIGJsdWUgYmFja2dyb3VuZCAqL1xuICAvKiBDcmVhdGUgdGhlIGNoZWNrbWFyay9pbmRpY2F0b3IgKGhpZGRlbiB3aGVuIG5vdCBjaGVja2VkKSAqL1xuICAvKiBTaG93IHRoZSBjaGVja21hcmsgd2hlbiBjaGVja2VkICovXG4gIC8qIFN0eWxlIHRoZSBjaGVja21hcmsvaW5kaWNhdG9yICovXG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB7XG4gIHdpZHRoOiAxMDAlO1xuICBib3gtc2hhZG93OiBub25lO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdHIuZXhhbXBsZS1kZXRhaWwtcm93IHtcbiAgaGVpZ2h0OiAwO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdHIuZXhhbXBsZS1lbGVtZW50LXJvdzpub3QoLmV4YW1wbGUtZXhwYW5kZWQtcm93KTpob3ZlciB7XG4gIGJhY2tncm91bmQ6IHdoaXRlc21va2U7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0ci5leGFtcGxlLWVsZW1lbnQtcm93Om5vdCguZXhhbXBsZS1leHBhbmRlZC1yb3cpOmFjdGl2ZSB7XG4gIGJhY2tncm91bmQ6ICNlZmVmZWY7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LXJvdyB0ZCB7XG4gIGJvcmRlci1ib3R0b20td2lkdGg6IDA7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRldGFpbCB7XG4gIG92ZXJmbG93OiBoaWRkZW47XG4gIGRpc3BsYXk6IGZsZXg7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRpYWdyYW0ge1xuICBtaW4td2lkdGg6IDgwcHg7XG4gIGJvcmRlcjogMnB4IHNvbGlkIGJsYWNrO1xuICBwYWRkaW5nOiA4cHg7XG4gIGZvbnQtd2VpZ2h0OiBsaWdodGVyO1xuICBtYXJnaW46IDhweCAwO1xuICBoZWlnaHQ6IDEwNHB4O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmV4YW1wbGUtZWxlbWVudC1zeW1ib2wge1xuICBmb250LXdlaWdodDogYm9sZDtcbiAgZm9udC1zaXplOiA0MHB4O1xuICBsaW5lLWhlaWdodDogbm9ybWFsO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmV4YW1wbGUtZWxlbWVudC1kZXNjcmlwdGlvbiB7XG4gIHBhZGRpbmc6IDE2cHg7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuZXhhbXBsZS1lbGVtZW50LWRlc2NyaXB0aW9uLWF0dHJpYnV0aW9uIHtcbiAgb3BhY2l0eTogMC41O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGgge1xuICBiYWNrZ3JvdW5kOiAjZWFlZGYyO1xuICBmb250LXNpemU6IDE0cHg7XG4gIGNvbG9yOiAjMzMzO1xuICBmb250LXdlaWdodDogNjAwO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1pbi13aWR0aDogNzVweDtcbiAgbWF4LXdpZHRoOiA3NXB4O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGg6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiBsZWZ0O1xuICBtaW4td2lkdGg6IDI1MHB4O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgbWluLXdpZHRoOiA3NXB4O1xuICBtYXgtd2lkdGg6IDc1cHg7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IGxlZnQ7XG4gIG1pbi13aWR0aDogMjUwcHg7XG4gIGNvbG9yOiAjMGM0YjlhO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24ge1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIHJpZ2h0OiAyMHB4O1xuICB0b3A6IDUwJTtcbiAgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC01MCUpO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24gLm1hdC1pY29uIHtcbiAgd2lkdGg6IDE4cHg7XG4gIGhlaWdodDogMThweDtcbiAgY29sb3I6ICM2NjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbiN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0ciB0aCwgI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRoZWFkIHtcbiAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkIHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gIG1pbi13aWR0aDogNzJweDtcbiAgbWF4LXdpZHRoOiA3MnB4O1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkOmZpcnN0LWNoaWxkIHtcbiAgbWF4LXdpZHRoOiAyNDBweDtcbiAgbWluLXdpZHRoOiAyNDBweDtcbiAgdGV4dC1hbGlnbjogbGVmdDtcbiAgY29sb3I6ICMzMzMzMzM7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIge1xuICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG4gIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgbWFyZ2luLWJvdHRvbTogMTJweDtcbiAgcGFkZGluZy1sZWZ0OiAyNXB4O1xuICBjdXJzb3I6IHBvaW50ZXI7XG4gIGZvbnQtc2l6ZTogMjJweDtcbiAgLXdlYmtpdC11c2VyLXNlbGVjdDogbm9uZTtcbiAgLW1vei11c2VyLXNlbGVjdDogbm9uZTtcbiAgLW1zLXVzZXItc2VsZWN0OiBub25lO1xuICB1c2VyLXNlbGVjdDogbm9uZTtcbn1cbiN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciBpbnB1dCB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgb3BhY2l0eTogMDtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBoZWlnaHQ6IDA7XG4gIHdpZHRoOiAwO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrbWFyayB7XG4gIHBvc2l0aW9uOiBhYnNvbHV0ZTtcbiAgdG9wOiAwO1xuICBsZWZ0OiAwO1xuICBoZWlnaHQ6IDE2cHg7XG4gIHdpZHRoOiAxNnB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xuICBib3JkZXI6IDFweCBzb2xpZCAjYmJiO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyOmhvdmVyIGlucHV0IH4gLmNoZWNrbWFyayB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNjY2M7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIgaW5wdXQ6Y2hlY2tlZCB+IC5jaGVja21hcmsge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMGM0YjlhO1xufVxuI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyIGlucHV0OmRpc2FibGVkIH4gLmNoZWNrbWFyayB7XG4gIGJhY2tncm91bmQtY29sb3I6ICNkZGQ7XG4gIGN1cnNvcjogbm8tZHJvcDtcbn1cbiN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja21hcms6YWZ0ZXIge1xuICBjb250ZW50OiBcIlwiO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIGRpc3BsYXk6IG5vbmU7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAuY2hlY2tjb250YWluZXIgaW5wdXQ6Y2hlY2tlZCB+IC5jaGVja21hcms6YWZ0ZXIge1xuICBkaXNwbGF5OiBibG9jaztcbn1cbiN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciAuY2hlY2ttYXJrOmFmdGVyIHtcbiAgbGVmdDogNHB4O1xuICB0b3A6IDFweDtcbiAgd2lkdGg6IDRweDtcbiAgaGVpZ2h0OiA3cHg7XG4gIGJvcmRlcjogc29saWQgd2hpdGU7XG4gIGJvcmRlci13aWR0aDogMCAycHggMnB4IDA7XG4gIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xuICAtbXMtdHJhbnNmb3JtOiByb3RhdGUoNDVkZWcpO1xuICB0cmFuc2Zvcm06IHJvdGF0ZSg0NWRlZyk7XG59XG4jdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSAubm9wYWRkaW5ndGQge1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbn1cbkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkge1xuICAjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBhZGRpbmdzcGFjaW5nIHtcbiAgICBwYWRkaW5nLXJpZ2h0OiAwcHggIWltcG9ydGFudDtcbiAgICBwYWRkaW5nLWxlZnQ6IDBweCAhaW1wb3J0YW50O1xuICB9XG4gICN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHtcbiAgICBvdmVyZmxvdzogYXV0bztcbiAgfVxufVxuXG5bZGlyPXJ0bF0gI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGg6Zmlyc3QtY2hpbGQsIC5ydGwgI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGg6Zmlyc3QtY2hpbGQge1xuICB0ZXh0LWFsaWduOiByaWdodDtcbn1cbltkaXI9cnRsXSAjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCwgLnJ0bCAjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZDpmaXJzdC1jaGlsZCB7XG4gIHRleHQtYWxpZ246IHJpZ2h0O1xufVxuW2Rpcj1ydGxdICN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5leHBhbmRpY29uLCAucnRsICN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5leHBhbmRpY29uIHtcbiAgcG9zaXRpb246IGFic29sdXRlO1xuICBsZWZ0OiAyMHB4O1xuICByaWdodDogYXV0bztcbiAgdG9wOiA1MCU7XG4gIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgtNTAlKTtcbn1cbltkaXI9cnRsXSAjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuZXhwYW5kaWNvbiAubWF0LWljb24sIC5ydGwgI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLmV4cGFuZGljb24gLm1hdC1pY29uIHtcbiAgd2lkdGg6IDE4cHg7XG4gIGhlaWdodDogMThweDtcbiAgY29sb3I6ICM2NjY7XG4gIGN1cnNvcjogcG9pbnRlcjtcbn1cbltkaXI9cnRsXSAjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGgsIFtkaXI9cnRsXSAjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdGhlYWQsIC5ydGwgI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRoLCAucnRsICN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIHRhYmxlIHRkIC5zdWJ0YWJsZSB0aGVhZCB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cbltkaXI9cnRsXSAjdmlld3VzZXJzIC52aWV3dXNlcnNuZXcgLnBlcm1pc3Npb250YWJsZSB0YWJsZSB0ZCAuc3VidGFibGUgdHIgdGQ6Zmlyc3QtY2hpbGQsIC5ydGwgI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgdGFibGUgdGQgLnN1YnRhYmxlIHRyIHRkOmZpcnN0LWNoaWxkIHtcbiAgdGV4dC1hbGlnbjogcmlnaHQ7XG59XG5bZGlyPXJ0bF0gI3ZpZXd1c2VycyAudmlld3VzZXJzbmV3IC5wZXJtaXNzaW9udGFibGUgLmNoZWNrY29udGFpbmVyLCAucnRsICN2aWV3dXNlcnMgLnZpZXd1c2Vyc25ldyAucGVybWlzc2lvbnRhYmxlIC5jaGVja2NvbnRhaW5lciB7XG4gIHBhZGRpbmctcmlnaHQ6IDI1cHg7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xufSJdfQ== */");

/***/ }),

/***/ "./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.ts":
/*!*****************************************************************************!*\
  !*** ./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.ts ***!
  \*****************************************************************************/
/*! exports provided: ViewusersComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ViewusersComponent", function() { return ViewusersComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_material_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/material/core */ "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_animations__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/animations */ "./node_modules/@angular/animations/__ivy_ngcc__/fesm2015/animations.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");
/* harmony import */ var _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ngx-translate/core */ "./node_modules/@ngx-translate/core/__ivy_ngcc__/fesm2015/ngx-translate-core.js");
/* harmony import */ var ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ngx-cookie-service */ "./node_modules/ngx-cookie-service/__ivy_ngcc__/fesm2015/ngx-cookie-service.js");








const ELEMENT_DATA = [
    {
        id: 1,
        name: 'Module - 1',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 11,
                sname: 'SubModule - 1',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 12,
                sname: 'SubModule - 2',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 13,
                sname: 'SubModule - 3',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 2,
        name: 'Module - 2',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 21,
                sname: 'SubModule - 5',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 22,
                sname: 'SubModule - 6',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 23,
                sname: 'SubModule - 7',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 3,
        name: 'Module - 3',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 31,
                sname: 'SubModule - 7',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 32,
                sname: 'SubModule - 8',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }, {
        id: 4,
        name: 'Module - 4',
        create: '',
        update: '',
        delete: '',
        approve: '',
        download: '',
        submodule: [
            {
                sid: 41,
                sname: 'SubModule - 9',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            },
            {
                sid: 42,
                sname: 'SubModule - 10',
                screate: '',
                supdate: '',
                sdelete: '',
                sapprove: '',
                sdownload: '',
            }
        ]
    }
];
let ViewusersComponent = class ViewusersComponent {
    constructor(formBuilder, translate, remoteService, cookieService) {
        this.formBuilder = formBuilder;
        this.translate = translate;
        this.remoteService = remoteService;
        this.cookieService = cookieService;
        this.matcher = new _angular_material_core__WEBPACK_IMPORTED_MODULE_3__["ErrorStateMatcher"]();
        this.dataSource = ELEMENT_DATA;
        this.columnsToDisplay = ['name', 'create', 'update', 'delete', 'approve', 'download'];
        this.innerDisplayedColumns = ['sname', 'screate', 'supdate', 'sdelete', 'sapprove', 'sdownload'];
        this.languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
            { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
        this.dir = 'ltr';
    }
    ngOnInit() {
        this.initializeForm();
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
    }
    initializeForm() {
        this.viewuserform = this.formBuilder.group({
            stkholdertype: [null],
            centrename: [null],
            staffname: [null],
            civilnumber: [null],
            emailid: [null],
            mobileno: [null],
            role: [null],
            username: [null],
            passwrd: [null]
        });
    }
    get viewusrform() {
        return this.viewuserform.controls;
    }
};
ViewusersComponent.ctorParameters = () => [
    { type: _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"] },
    { type: _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"] },
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"] },
    { type: ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"] }
];
ViewusersComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-viewusers',
        template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! raw-loader!./viewusers.component.html */ "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.html")).default,
        encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
        animations: [
            Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["trigger"])('detailExpand', [
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '0px', minHeight: '0' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["state"])('expanded', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["style"])({ height: '*' })),
                Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["transition"])('expanded <=> collapsed', Object(_angular_animations__WEBPACK_IMPORTED_MODULE_4__["animate"])('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
            ]),
        ],
        styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(/*! ./viewusers.component.scss */ "./src/app/modules/newenterpriseadmin/viewusers/viewusers.component.scss")).default]
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormBuilder"],
        _ngx_translate_core__WEBPACK_IMPORTED_MODULE_6__["TranslateService"],
        _app_remote_service__WEBPACK_IMPORTED_MODULE_5__["RemoteService"],
        ngx_cookie_service__WEBPACK_IMPORTED_MODULE_7__["CookieService"]])
], ViewusersComponent);



/***/ })

}]);
//# sourceMappingURL=modules-newenterpriseadmin-newenterpriseadmin-module-es2015.js.map