import { Component, OnInit, ViewChild, AfterViewInit, Input, ChangeDetectorRef} from '@angular/core';
import { CountryService } from '../../newcountry/service/country.service';
import { StateService} from '../../state/service/state.service';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Router, ActivatedRoute, Params  } from '@angular/router';
import {DataSource} from '@angular/cdk/collections';
import { State } from '../models/State';
import {MatSort, MatSortable, MatTableDataSource, MatPaginator, MatDrawer} from '@angular/material';
import {MatIconModule} from '@angular/material/icon';
import {merge} from 'rxjs/observable/merge';
import {of as observableOf} from 'rxjs/observable/of';
import {catchError} from 'rxjs/operators/catchError';
import {map} from 'rxjs/operators/map';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {HttpClient} from '@angular/common/http';
import swal from 'sweetalert';
import { atLeastOne } from './../../../../config_files/directives/atleastone';
import { SelectionModel } from '@angular/cdk/collections';
import { GoogleAnalyticsService } from 'angular-ga';
import { environment } from '../../../../../../environments/environment';
import { Encrypt } from '@lypis_config/common/class/encrypt';
let countrylist: Object;
@Component({
    selector: 'app-managestate',
    templateUrl: './managestate.component.html',
    styleUrls: ['./managestate.component.css']
})
export class ManagestateComponent implements AfterViewInit {
      public editid = 0;
      public enabled;
  @ViewChild(MatDrawer) drawer: any;
    createbutton = true;
    updatebutton = false;
    searchfilter = false;
    breadcrums = [
        {
            'url': '/mastermaintance/manage country', 'params': '', 'label': 'manage state'
        }
    ];
    sid = null;
    pageEvent: any;
    displayedColumns = ['checkall', 'SM_StateName_en', 'CyM_CountryName_en', 'SM_Status', 'actionsColumn'];
    displayNoRecords: boolean;
    perpage = 10;
    exampleDatabase: ExampleHttpDao | null;
    dataSource = new MatTableDataSource();
    public showFilter = 'Show Filter';
    public countryname = '';
    public statename = '';
    public status = '';
    public querystr = '';
    moduleID: any;
    readonly READ_ACCESS_TYPE = this.security.encrypt(2);
    readonly UPDATE_ACCESS_TYPE = this.security.encrypt(3);
    readonly DELETE_ACCESS_TYPE = this.security.encrypt(4);

    resultsLength = 0;
    isRateLimitReached = false;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;
    /* FILTER FORM FIELD GROUPING */
    filterform = new FormGroup({
        statename: new FormControl(''),
        countryname: new FormControl(''),
        statestatus: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });

    /* MULTIPLE CHECKBOX CHECK METHOD */
    selection = new SelectionModel<string>(true, []);
    constructor(private http: HttpClient, private fb: FormBuilder,
                private countryservice: CountryService,
                private stateservice: StateService,
                protected router: Router,
                protected security: Encrypt,
                protected activatedRoute: ActivatedRoute,
                private gaService: GoogleAnalyticsService,
                private changeDetector: ChangeDetectorRef
    ) {}
    ngAfterViewInit() {
        this.moduleID = this.security.encrypt(this.activatedRoute.snapshot.data.accessmodule);
        this.fetchData();
        this.gaService.configure('UA-120075477-1');
    }
    searchiconclick() {
        this.searchfilter = !this.searchfilter;
        this.showFilter = this.searchfilter ? 'Hide Filter' : 'Show Filter';
    }

    /* FILTER FORM SUBMIT METHOD */
    onFilterSubmit() {
        let formvalues = this.filterform.value;
        this.statename = '';
        this.countryname = '';
        this.status = '';
        if (formvalues.statename) {
            this.statename = formvalues.statename.trim();
        }
        if (formvalues.countryname) {
            this.countryname    =   formvalues.countryname.trim();
        }
        if (formvalues.statestatus) {
            this.status    =   formvalues.statestatus.trim();
        }
        let filterpagestring   =    '';
        let  perpage           =    10;
        const filtersign = (this.sort.direction == 'desc') ? '-' : '';
        filterpagestring = `sort=${filtersign}${this.sort.active}&order=${this.sort.direction}&page=${this.paginator.pageIndex + 1}&size=${this.perpage}`;
        this.stateservice.statetablefilter(filterpagestring, this.countryname, this.statename, this.status).subscribe(stateresponse => {
            this.gaService.event.emit({
                category: 'superadmin/mm',
                action: 'Search State'
            });
            this.dataSource.data = stateresponse.data.items;
            this.resultsLength = stateresponse.data.total_count;
        });
    }
    reloadTree() {

        this.enabled = false;
        this.changeDetector.detectChanges();
        this.enabled = true;
      }
    resetEditid() {
        this.editid = 0;
    }

    /* DATA TABLE FETCH METHOD */
    fetchData() {
        this.exampleDatabase = new ExampleHttpDao(this.http, this.moduleID);
        // If the user changes the sort order, reset back to the first page.
        this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
        merge(this.sort.sortChange, this.paginator.page)
            .pipe(
                startWith({}),
                switchMap(() => {
                    this.querystr = '';
                    /* this.statename = '';
                     this.countryname = '';
                     this.status='';*/
                    if (this.countryname && this.countryname != null) {
                        this.querystr += `&CyM_CountryName_en=${this.countryname}`;
                    }
                    if (this.statename && this.statename != null) {
                        this.querystr += `&SM_StateName_en=${this.statename}`;
                    }

                    if (this.status && this.status != null) {
                        this.querystr += `&SM_Status=${this.status}`;
                    }
                    this.querystr += `&type=${'filter'}`;
                    return this.exampleDatabase!.statedatas(
                        this.sort.active, this.sort.direction, this.paginator.pageIndex, this.perpage, this.querystr);
                }),
                map(data => {
                    // Flip flag to show that loading has finished.
                    if (data.data.status == 0) {
                        swal({
                          title: 'Warning',
                          text: data.data.msg,
                          icon: 'warning',
                        });
                        return [];
                      } else {
                          this.isRateLimitReached = false;
                          this.resultsLength = data.data.total_count;
                          return data.data.items;
                      }
                }),
                catchError(() => {
                    // this.isLoadingResults = false;
                    // Catch if the GitHub API has reached its rate limit. Return empty data.
                    this.isRateLimitReached = true;
                    return observableOf([]);
                })
            ).subscribe(data => this.dataSource.data = data);
    }
    isAllSelected() {
        if (!this.dataSource) { return false; }
        if (this.selection.isEmpty()) { return false; }
        return this.selection.selected.length == this.dataSource.data.length;
    }
    masterToggle() {
        if (!this.dataSource) { return; }

        if (this.isAllSelected()) {
            this.selection.clear();
        } else {
            this.dataSource.data.forEach(data => { this.selection.select(data.StateMst_Pk); });
        }
    }
    /* MULTIPLE ROW DELETED METHOD */
    multiplerowdel() {
        let del_ids = this.selection.selected.length;
        swal({
            title: 'Are you sure want to delete?',
            icon: 'warning',
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    this.selection.selected.forEach(dataids => {
                        this.stateservice.deletestate(dataids, this.moduleID, this.DELETE_ACCESS_TYPE).subscribe(datares => {
                            if (datares.data.status == 0) {
                                swal({
                                  title: 'Warning',
                                  text: datares.data.msg,
                                  icon: 'warning',
                                });
                              } else {
                                  if (datares) {
                                      swal('Success!', 'Deleted Successfully', {
                                          icon: 'success',
                                      });
                                      this.fetchData();
                                      this.selection.clear();
                                  }
                              }

                        });
                    });
                }
            });
    }
    /* FILTER FORM RESET METHOD */
    formreset() {
        this.statename = '';
        this.countryname = '';
        this.status = '';
        this.fetchData();
    }
    startEdit(cid: number) {    this.reloadTree();
        // this.router.navigate(['/mastermaintance/state/createstate/',cid]);
         this.editid = cid;
         this.drawer.toggle();
    }
    cancelOrDelete(row) {
      let msg = 'Are you sure want to delete?';
      let flash = 'Deleted Successfully';
      swal({
          title: msg,
          icon: 'warning',
          buttons: ['Cancel', 'Ok'],
          dangerMode: true,
      }).then((willDelete) => {
          if (willDelete) {
            this.stateservice.deletestate(row, this.moduleID, this.DELETE_ACCESS_TYPE).subscribe( data => {
                if (data.data.status == 0) {
                    swal({
                      title: 'Warning',
                      text: data.data.msg,
                      icon: 'warning',
                    });
                  } else {
                      if (data) {
                          swal('Success!', flash, {
                              icon: 'success',
                          });
                          this.ngAfterViewInit() ;
                      }
                  }

              });
          }
      });
}
    onPaginateChange(event) {
        this.perpage = event.pageSize;
    }
    changestatus(id, currentstatus) {
        let msg = (currentstatus == 'I') ? 'Are you sure want to Activate?' : 'Are you sure want to Deactivate?';
        let flash = (currentstatus == 'A') ? 'Deactivated Successfully' : 'Activated Successfully';
        swal({
            title: msg,
            icon: 'warning',
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    this.stateservice.updatestatus(id, this.moduleID, this.UPDATE_ACCESS_TYPE).subscribe( data => {
                        if (data.data.status == 0) {
                            swal({
                              title: 'Warning',
                              text: data.data.msg,
                              icon: 'warning',
                            });
                          } else {
                              if (data) {
                                  swal(flash, {
                                      icon: 'success',
                                  });
                                  this.ngAfterViewInit() ;
                              }
                          }
                    });
                }
            });
    }
}
export interface GithubApi {
    items: State[];
    total_count: number;
}
/** An example database that the data source uses to retrieve data for the table. */
export class ExampleHttpDao {
    moduleID: any;
    constructor(private http: HttpClient, moduleID: any) { this.moduleID = moduleID; }
    statedatas(sort: string, order: string, page: number, size: number, query: string): Observable<GithubApi> {
        const href = environment.baseUrl + 'mst/statemaster/index';
        const sign = (order == 'desc') ? '-' : '';
        const requestUrl =
            `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&uac=f3f86bb473399a2239202c31420a1ee1&uam=${this.moduleID}`;
        return this.http.get<GithubApi>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}
