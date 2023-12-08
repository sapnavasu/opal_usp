import { Component, OnInit, ViewChild, AfterViewInit, Input, ChangeDetectionStrategy, ChangeDetectorRef} from '@angular/core';
import { CountryService } from '../../newcountry/service/country.service';
import { StateService} from '../../state/service/state.service';
import { CityService} from '../service/city.service';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Router, ActivatedRoute, Params  } from '@angular/router';
import {DataSource} from '@angular/cdk/collections';
import { City } from '../models/city';
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
// import { MultipleCheckbox } from '../../../multiplecheckbox';
import { SelectionModel } from '@angular/cdk/collections';
import { GoogleAnalyticsService } from 'angular-ga';
import { environment } from '../../../../../../environments/environment';
import { Encrypt } from '@lypis_config/common/class/encrypt';

let countrylist: Object;

@Component({
    selector: 'app-managecity',
    templateUrl: './managecity.component.html',
    styleUrls: ['./managecity.component.css'],
    changeDetection: ChangeDetectionStrategy.OnPush
})
export class ManagecityComponent implements AfterViewInit {
    public enabled;
    public editid = 0;
    @ViewChild(MatDrawer) drawer: any;
    createbutton = true;
    updatebutton = false;
    searchfilter = false;
    pageEvent: any;
    breadcrums = [
        {
            'url': '/mastermaintance/managecity', 'params': '', 'label': 'manage city'
        }
    ];
    roleid = null;
    resultsLength = 0;
    perpage = 10;
    isRateLimitReached = false;
    displayedColumns = ['checkall', 'CM_CityName_en', 'CM_Status', 'actionsColumn'];
    displayNoRecords: boolean;
    exampleDatabase: ExampleHttpDao | null;
    dataSource = new MatTableDataSource();
    public showFilter = 'Show Filter';
    public name = '';
    public querystr = '';
    public status = '';
    moduleID: any;
    readonly READ_ACCESS_TYPE = this.security.encrypt(2);
    readonly UPDATE_ACCESS_TYPE = this.security.encrypt(3);
    readonly DELETE_ACCESS_TYPE = this.security.encrypt(4);
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;
    /* FILTER FORM FIELD GROUPING */
    filterform = new FormGroup({
        cityname: new FormControl(''),
        citystatus: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });
    /* MULTIPLE CHECKBOX ACTION METHOD */
    selection = new SelectionModel<string>(true, []);
    constructor(private http: HttpClient, private fb: FormBuilder,
                private countryservice: CountryService,
                private stateservice: StateService,
                private cityservice: CityService,
                protected router: Router,
                protected security: Encrypt,
                protected activatedRoute: ActivatedRoute,
                private gaService: GoogleAnalyticsService,
                private changeDetector: ChangeDetectorRef,
    ) {}

    ngAfterViewInit() {
        this.fetchData();
        this.gaService.configure('UA-120075477-1');
    }

    searchiconclick() {
        this.moduleID = this.security.encrypt(this.activatedRoute.snapshot.data.accessmodule);
        this.searchfilter = !this.searchfilter;
        this.showFilter = this.searchfilter ? 'Hide Filter' : 'Show Filter';
    }

    /* FILTER FORM SUBMIT METHOD */
    onFilterSubmit() {
        let formvalues = this.filterform.value;
        this.name   =   '';
        this.status = '';
        if (formvalues.cityname) {
            this.name = formvalues.cityname.trim();
        }
        if (formvalues.citystatus) {
            this.status = formvalues.citystatus.trim();
        }
        let filterpagestring   =    '';
        let  perpage           =    10;
        const filtersign = (this.sort.direction == 'desc') ? '-' : '';
        filterpagestring = `sort=${filtersign}${this.sort.active}&order=${this.sort.direction}&page=${this.paginator.pageIndex + 1}&size=${this.perpage}`;
        this.cityservice.citytablefilter(filterpagestring, this.name, this.status).subscribe(cityres => {
            this.gaService.event.emit({
                category: 'superadmin/mm',
                action: 'Search City'
            });
            this.dataSource.data = cityres.data.items;
            this.resultsLength = cityres.data.total_count;
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
    /* DATA TABLE FIELD FETCH */
    fetchData() {
        this.exampleDatabase = new ExampleHttpDao(this.http, this.moduleID);
        // If the user changes the sort order, reset back to the first page.
        this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
        merge(this.sort.sortChange, this.paginator.page)
            .pipe(
                startWith({}),
                switchMap(() => {
                    this.querystr = '';

                    if (this.name && this.name != null) {
                        this.querystr += `&CM_CityName_en=${this.name}`;
                    }

                    if (this.status && this.status != null) {
                        this.querystr += `&CM_Status=${this.status}`;
                    }
                    this.querystr += `&type=${'filter'}`;
                    return this.exampleDatabase!.citydatas(
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
            this.dataSource.data.forEach(data => { this.selection.select(data.CityMst_Pk); });
        }
    }

    /* MULTIPLE ROW DELETE ACTION METHOD */
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
        this.name   =   '';
        this.status = '';
        this.fetchData();
    }
    startEdit(cid: number) {   this.reloadTree();
        // this.router.navigate(['/mastermaintance/city/createcity/',cid]);
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
            this.cityservice.deletecity(row, this.moduleID, this.DELETE_ACCESS_TYPE).subscribe( data => {
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
                    this.cityservice.updatestatus(id, this.moduleID, this.UPDATE_ACCESS_TYPE).subscribe( data => {
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
    items: City[];
    total_count: number;
}
/** An example database that the data source uses to retrieve data for the table. */
export class ExampleHttpDao {
    moduleID: any;
    constructor(private http: HttpClient, moduleID: any) { this.moduleID = moduleID; }
    citydatas(sort: string, order: string, page: number, size: number, query: string): Observable<GithubApi> {
        const href = environment.baseUrl + 'mst/citymaster/index';
        const sign = (order == 'desc') ? '-' : '';
        const requestUrl =
            `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&uac=f3f86bb473399a2239202c31420a1ee1&uam=${this.moduleID}`;
        return this.http.get<GithubApi>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}
