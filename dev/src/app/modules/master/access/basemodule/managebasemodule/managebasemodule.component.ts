import { Component, OnInit, AfterViewInit, ViewChild, ChangeDetectorRef } from '@angular/core';
import { MatDrawer, MatTableDataSource, MatPaginator, MatSort, PageEvent } from '@angular/material';
import { HttpClient } from '@angular/common/http';
import { FormBuilder, FormGroup, FormControl, Validators } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { atLeastOne } from '@lypis_config/directives/atleastone';

/* mostly required imports */
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { map } from 'rxjs/operators/map';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import swal from 'sweetalert';
import { environment } from '../../../../../../environments/environment';
import { SelectionModel } from '@angular/cdk/collections';
import { Observable, from } from 'rxjs';

/* Service Call */
import { BasemoduleService } from '../service/basemodule.service';

@Component({
    selector: 'app-managebasemodule',
    templateUrl: './managebasemodule.component.html',
    styleUrls: ['./managebasemodule.component.scss']
})
export class ManagebasemoduleComponent implements OnInit, AfterViewInit {
    public enabled;
    public editid: number = 0;
    @ViewChild(MatDrawer) drawer: any;
    createbutton: boolean = true;
    updatebutton: boolean = false;
    searchfilter: boolean = false;
    pageEvent: any;
    text:boolean=true;
    roleid = null;
    resultsLength = 0;
    perpage = 10;
    isRateLimitReached = false;
    displayedColumns = ['checkall', 'bmm_name', 'bmm_basemodulemst_fk', 'bmm_status', 'actionsColumn'];
    displayNoRecords: boolean;
    exampleDatabase: ExampleHttpDao | null;
    dataSource = new MatTableDataSource();
    public showFilter = 'Show Filter';
    public moduleName = '';
    public subModuleName = '';
    public querystr = '';
    public formParms: any;
    public status = '';
    public type = '';
    public rootModuleList: any;
    public accessList: any;
    public accessListTemp: any;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    /* MegaMenu Vaarible*/
    public menuModulePk:any;

    constructor(private http: HttpClient, private fb: FormBuilder,
        protected router: Router,
        private changeDetector: ChangeDetectorRef,
        private moduleService: BasemoduleService,
        private route:ActivatedRoute
    ) { }

    ngOnInit() {
        this.getRootModule();

        this.route.paramMap.pipe((data) => {
            this.menuModulePk = window.history.state.menuModulePk;
            if(this.menuModulePk > 0){
              this.startEdit(this.menuModulePk);
              this.menuModulePk = '';
            }
            return Observable.from([])
        });
    }

    getRootModule() {
        this.moduleService.getRootModuleIniDatas(this.formParms).subscribe(
            function (data) {
                this.rootModuleList = data['data'].data.module;
                this.accessList = data['data'].data.accessMaster;
                this.accessListTemp = data['data'].data.accessMaster;
            }.bind(this)
        );
    }

    syncPrimaryPaginator(event: PageEvent) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.paginator.page.emit(event);
    }

    ngAfterViewInit() {
        // this.fetchData();
        setTimeout(() => this.text = false,200);
        setTimeout(() => this.fetchData(),300);
    }

    searchiconclick() {
        this.searchfilter = !this.searchfilter;
        this.showFilter = this.searchfilter ? 'Hide Filter' : 'Show Filter';
    }
    /* FILTER FORM FIELD GROUPING */
    filterform = new FormGroup({
        moduleName: new FormControl(''),
        subModuleName: new FormControl(''),
        status: new FormControl(''),
        type: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });

    /* FILTER FORM SUBMIT METHOD */
    onFilterSubmit() {
        var formvalues = this.filterform.value;

        this.moduleName = formvalues.moduleName ? formvalues.moduleName.trim() : '';
        this.subModuleName = formvalues.subModuleName ? formvalues.subModuleName.trim() : '';
        this.status = formvalues.status ? formvalues.status.trim() : '';
        this.type = formvalues.type ? formvalues.type.trim() : '';

        this.formParms = {
            'size': this.perpage,
            'page': 0,
            'moduleName': this.moduleName,
            'subModuleName': this.subModuleName,
            'status': this.status,
            'stype': this.type
        };

        this.moduleService.moduleFilter(this.formParms).subscribe(
            function (data) {
                this.dataSource.data = data['data'].data;
                this.resultsLength = data['data'].totalcount;
                this.dataSource.filter = '';
            }.bind(this)
        );
    }
    reloadTree() {

        this.enabled = false;
        this.changeDetector.detectChanges();
        this.enabled = true;
    }

    resetEditid() {
        this.editid = 0;
    }
    /* DATA TABLE FIELD FETCH */
    fetchData() {
        this.exampleDatabase = new ExampleHttpDao(this.http);
        // If the user changes the sort order, reset back to the first page.
        this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
        merge(this.sort.sortChange, this.paginator.page)
            .pipe(
                startWith({}),
                switchMap(() => {
                    this.formParms = {
                        'size': this.perpage,
                        'page': this.paginator.pageIndex,
                        'moduleName': this.moduleName,
                        'subModuleName': this.subModuleName,
                        'status': this.status,
                        'stype': this.type,
                        'column': this.sort.active,
                        'direction': this.sort.direction
                    }
                    return this.exampleDatabase!.basemodulelist(this.formParms);
                }),
                map(data => {
                    // Flip flag to show that loading has finished.
                    this.isRateLimitReached = false;
                    this.resultsLength = data['data'].totalcount;
                    return data['data'];
                }),
                catchError(() => {
                    //this.isLoadingResults = false;
                    // Catch if the GitHub API has reached its rate limit. Return empty data.
                    this.isRateLimitReached = true;
                    return observableOf([]);
                })
            ).subscribe(data => this.dataSource.data = data['data']);
    }
    /* MULTIPLE CHECKBOX ACTION METHOD */
    selection = new SelectionModel<string>(true, []);
    isAllSelected() {
        if (!this.dataSource) { return false; }
        if (this.selection.isEmpty()) { return false; }

        let d = this.dataSource.data.filter(x => {
            return x['checked'] === false;
        })

        return this.selection.selected.length == d.length;
    }
    masterToggle() {
        if (!this.dataSource) { return; }

        if (this.isAllSelected()) {
            this.selection.clear();
        } else {
            let d = this.dataSource.data.filter(x => {
                return x['checked'] === false;
            })
            d.forEach(data => { this.selection.select(data['modulePk']) });
        }
    }

    /* MULTIPLE ROW DELETE ACTION METHOD */
    multiplerowdel() {
        swal({
            title: "Are you sure want to delete?",
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    const selectedpks = this.selection.selected.toString();
                    var obj = { modulePk: selectedpks, changeStatus: 3 };
                    this.moduleService.deleteBaseModuleAccess(obj).subscribe(datares => {
                        if (datares['data'].flag == "S") {
                            var flash = "Deleted Successfully !";
                            swal(flash, {
                                icon: "success",
                            });
                            this.fetchData();
                            this.selection.clear();
                        }
                        else if (datares['data'].flag == "C") {
                            swal(datares['data'].msg, {
                                icon: "warning",
                                buttons: ['Cancel', 'Ok'],
                                dangerMode: true
                            }).then((result) => {
                                if (result) {
                                    let obj = { modulePk: selectedpks, changeStatus: 3, isConfirmed: true };
                                    this.moduleService.changeStatusBaseModuleAccess(obj).subscribe(data => {
                                        if (data) {
                                            flash = "Deleted Successfully !";
                                            let icon = "success";
                                            if (data['data'].flag == "E") {
                                                flash = data['data'].msg;
                                                icon = "warning";
                                            }
                                            swal(flash, {
                                                icon: icon,
                                            });
                                            this.fetchData();
                                            this.selection.clear();
                                        }
                                    });
                                } else {

                                }
                            });
                            return false;
                        }
                         else {
                            var flash = "Something went wrong";
                            swal(flash, {
                                icon: "warning",
                            });
                        }

                    });
                }
            });
    }
    /* FILTER FORM RESET METHOD */
    formreset() {
        this.moduleName = '';
        this.subModuleName = '';
        this.status = '';
        this.type = '';
        this.fetchData();
    }
    startEdit(cid: number) {
        this.reloadTree();
        // this.router.navigate(['/mastermaintance/city/createcity/',cid]);
        this.editid = cid;
        this.drawer.toggle();
    }
    cancelOrDelete(row) {
        var msg = "Are you sure want to delete?";
        swal({
            title: msg,
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var obj = { modulePk: row, changeStatus: 3 };
                this.moduleService.deleteBaseModuleAccess(obj).subscribe(data => {
                    if (data) {
                        let flash = "Deleted Successfully !";
                        let icon = "success";
                        if (data['data'].flag == "E") {
                            flash = data['data'].msg;
                            icon = "warning";
                        }
                        else if (data['data'].flag == "C") {
                            swal(data['data'].msg, {
                                icon: "warning",
                                buttons: ['Cancel', 'Ok'],
                                dangerMode: true
                            }).then((result) => {
                                if (result) {
                                    let obj = { modulePk: row, changeStatus: 3, isConfirmed: true };
                                    this.moduleService.changeStatusBaseModuleAccess(obj).subscribe(data => {
                                        if (data) {
                                            flash = "Deleted Successfully !";
                                            let icon = "success";
                                            if (data['data'].flag == "E") {
                                                flash = data['data'].msg;
                                                icon = "warning";
                                            }
                                            swal(flash, {
                                                icon: icon,
                                            });
                                            this.fetchData();
                                            this.selection.clear();
                                        }
                                    });
                                } else {

                                }
                            });
                            return false;
                        }
                        swal(flash, {
                            icon: icon,
                        });
                        this.fetchData();
                        this.selection.clear();
                    }

                });
            }
        });
    }
    onPaginateChange(event) {
        this.perpage = event.pageSize;
    }
    changestatus(id, currentstatus) {
        var msg = (currentstatus == 2) ? "Are you sure want to Activate?" : "Are you sure want to Deactivate?";
        var statusToChange = (currentstatus == 2) ? 1 : 2;
        swal({
            title: msg,
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var obj = { modulePk: id, changeStatus: statusToChange };
                    this.moduleService.changeStatusBaseModuleAccess(obj).subscribe(data => {
                        if (data) {
                            let flash = (currentstatus == 1 && data['data'].flag == "S") ? "Deactivated Successfully" : "Activated Successfully";
                            let icon = "success";
                            if (data['data'].flag == "E") {
                                flash = data['data'].msg;
                                icon = "warning";
                            }
                            else if (data['data'].flag == "C") {
                                swal(data['data'].msg, {
                                    icon: "warning",
                                    buttons: ['Cancel', 'Ok'],
                                    dangerMode: true
                                }).then((result) => {
                                    if (result) {
                                        let obj = { modulePk: id, changeStatus: statusToChange, isConfirmed: true };
                                        this.moduleService.changeStatusBaseModuleAccess(obj).subscribe(data => {
                                            if (data) {
                                                let flash = (currentstatus == 1 && data['data'].flag == "S") ? "Deactivated Successfully" : "Activated Successfully";
                                                let icon = "success";
                                                if (data['data'].flag == "E") {
                                                    flash = data['data'].msg;
                                                    icon = "warning";
                                                }
                                                swal(flash, {
                                                    icon: icon,
                                                });
                                                this.ngAfterViewInit();
                                                this.selection.clear();
                                                this. getRootModule();
                                            }
                                        });
                                    } else {

                                    }
                                });
                                return false;
                            }
                            swal(flash, {
                                icon: icon,
                            });
                            this.ngAfterViewInit();
                            this.selection.clear();
                            this. getRootModule();
                        }

                    });
                }
            });
    }
}

/** An example database that the data source uses to retrieve data for the table. */
export class ExampleHttpDao {
    constructor(private http?: HttpClient) { }

    basemodulelist(formParms) {
        let formParam = JSON.stringify({ 'postParams': formParms });
        const href = environment.baseUrl + 'acm/basemodule/base-modules-list?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
        return this.http.post(href, formParam);
    }
}