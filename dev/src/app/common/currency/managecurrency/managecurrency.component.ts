import { Component, OnInit, ViewChild, AfterViewInit, Input, ChangeDetectionStrategy, ChangeDetectorRef} from '@angular/core';
import { CurrrencyService } from '../createcurrency/currrency.service';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { DataSource } from '@angular/cdk/collections';
import { Currency } from '../models/currency';
import { MatSort, MatSortable, MatTableDataSource, MatPaginator, MatDrawer } from '@angular/material';
import { MatIconModule } from '@angular/material/icon';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { map } from 'rxjs/operators/map';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import { atLeastOne } from './../../../../config_files/directives/atleastone';
import { SelectionModel } from '@angular/cdk/collections';
import { GoogleAnalyticsService } from 'angular-ga';
import { environment } from '../../../../../../environments/environment';
import { Encrypt } from '@lypis_config/common/class/encrypt';
import { data } from 'highcharts';
declare let swal: any;
@Component({
    selector: 'app-managecurrency',
    templateUrl: './managecurrency.component.html',
    styleUrls: ['./managecurrency.component.css'],
    changeDetection: ChangeDetectionStrategy.OnPush
})
export class ManagecurrencyComponent implements AfterViewInit {
    public enabled;
    public editid = 0;
    @ViewChild(MatDrawer) drawer: any;

    createbutton = true;
    updatebutton = false;
    searchfilter = false;
    resultsLength = 0;
    perpage = 10;
    pageEvent: any;
    breadcrums = [
        {
            'url': '/mastermaintance/currency/managecurrency', 'params': '', 'label': 'manage currency'
        }
    ];
    cid = null;
    moduleID: any;
    readonly READ_ACCESS_TYPE = this.security.encrypt(2);
    readonly DELETE_ACCESS_TYPE = this.security.encrypt(4);

    displayNoRecords: boolean;
    isRateLimitReached = false;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;
    displayedColumns = ['checkall',  'CurM_CurrSymbol', 'CurM_CurrencyName_en',
        'CurM_Status', 'actionsColumn'];
    exampleDatabase: ExampleHttpDao | null;
    dataSource = new MatTableDataSource();
    public showFilter = 'Show Filter';
    public symbol = '';
    public name = '';
    public status = '';
    public querystr = '';
    /* FILTER FORM GROUP */
    filterform = new FormGroup({
        currencysymbol: new FormControl(''),
        currencyname: new FormControl(''),
        currencystatus: new FormControl(''),
     },
     { validators: atLeastOne(Validators.required) });

    /* MULTIPLE CHECKBOX METHOD */
    selection = new SelectionModel<string>(true, []);
    constructor(private fb: FormBuilder,
                private currencyservice: CurrrencyService,
                protected router: Router,
                private http: HttpClient,
                private security: Encrypt,
                private route: ActivatedRoute,
                private gaService: GoogleAnalyticsService,
                private changeDetector: ChangeDetectorRef
    ) { }
    ngAfterViewInit() {
        this.moduleID = this.security.encrypt(this.route.snapshot.data.accessmodule);
        this.fetchData();
        this.gaService.configure('UA-120075477-1');
    }
    reloadTree() {
        this.editid = 0;
        this.enabled = false;
        this.changeDetector.detectChanges();
        this.enabled = true;
    }
      resetEditid() {
        this.editid = 0;
      }
    searchiconclick() {
        this.searchfilter = !this.searchfilter;
        this.showFilter = this.searchfilter ? 'Hide Filter' : 'Show Filter';
    }

    /* FILTER FORM SUBMIT METHOD */
    onFilterSubmit() {
        const formvalues = this.filterform.value;
        this.symbol = '';
        this.name = '';
        this.status = '';

        if (formvalues.currencysymbol) {
            this.symbol = formvalues.currencysymbol.trim();
        }
        if (formvalues.currencyname) {
            this.name = formvalues.currencyname.trim();
        }
        if (formvalues.currencystatus) {
            this.status = formvalues.currencystatus.trim();
        }
        let filterpagestring = '';
        const perpage = 10;
        const filtersign = (this.sort.direction == 'desc') ? '-' : '';
        this.paginator.pageIndex = 0;
        filterpagestring = `sort=${filtersign}${this.sort.active}&order=${this.sort.direction}&page=${this.paginator.pageIndex + 1}&size=${this.perpage}`;
        this.currencyservice.filtertable(filterpagestring, this.symbol, this.name, this.status).subscribe(currencyfilter => {
            this.gaService.event.emit({
                category: 'superadmin/mm',
                action: 'Search Currency'
            });
            this.dataSource.data = currencyfilter.data.items;
            this.resultsLength = currencyfilter.data.total_count;
        });
    }

    /* DATA TABLE FETCH METOD */
    fetchData() {
        this.exampleDatabase = new ExampleHttpDao(this.http, this.moduleID);
        // If the user changes the sort order, reset back to the first page.
        this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
        merge(this.sort.sortChange, this.paginator.page)
            .pipe(
                startWith({}),
                switchMap(() => {
                    this.querystr = '';
                    if (this.symbol && this.symbol != null) {
                        this.querystr += '&CurM_CurrSymbol=' + this.symbol;
                    }
                    if (this.name && this.name != null) {
                        this.querystr += '&CurM_CurrencyName_en=' + this.name;
                    }
                    if (this.status && this.status != null) {
                        this.querystr += '&CurM_Status=' + this.status;
                    }
                    this.querystr += '&type=filter';
                    return this.exampleDatabase!.currencydatas(
                        this.sort.active, this.sort.direction, this.paginator.pageIndex, this.perpage, this.querystr);
                }),
                map(data => {
                    // Flip flag to show that loading has finished.
                    this.isRateLimitReached = false;
                    if (data.data.status == 0) {
                        swal({
                          title: 'Warning',
                          text: data.data.msg,
                          icon: 'warning',
                        });
                        return [];
                      } else {
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

        const d = this.dataSource.data.filter(x => {
            return x.CurM_Status == 'I';
        });
        return this.selection.selected.length == d.length;
    }
    masterToggle() {
        if (!this.dataSource) { return; }

        if (this.isAllSelected()) {
            this.selection.clear();
        } else {
            const d = this.dataSource.data.filter(x => {
                return x.CurM_Status == 'I';
            });
            d.forEach(data => { this.selection.select(data.CurrencyMst_Pk); });
        }
    }

    /* MULTIPLE DATA DELETE METHOD */
    multiplerowdel() {
        const del_ids = this.selection.selected.length;
        swal({
            title: 'Are you sure want to delete?',
            icon: 'warning',
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    this.selection.selected.forEach(dataids => {
                        this.currencyservice.deletecurrency(dataids, this.moduleID, this.DELETE_ACCESS_TYPE).subscribe(data => {
                            if (data.data.status == 0) {
                                swal({
                                  title: 'Warning',
                                  text: data.data.msg,
                                  icon: 'warning',
                                });
                              } else {
                                swal('Successfully Deleted', {
                                    icon: 'success',
                                });
                                this.fetchData();
                                this.selection.clear();
                              }
                        }, (error: HttpErrorResponse) => {
                            swal('This currency is mapped somewhere else, So can\'t able to delete', {
                              icon: 'warning',
                            });
                            this.ngAfterViewInit() ;
                        });
                    });
                }
            });
    }

    /* RESET FORM DATA TABLE */
    formreset() {
        this.symbol = '';
        this.name = '';
        this.status = '';
        this.fetchData();
    }

    startEdit(cid: number) {
        this.reloadTree();
        // this.router.navigate(['/mastermaintance/currency/createcurrency/', cid]);
        this.editid = cid;
        this.drawer.toggle();
    }
    cancelOrDelete(row) {
      const msg = 'Are you sure want to delete?';
      const flash = 'Successfully Deleted';
      swal({
          title: msg,
          icon: 'warning',
          buttons: ['Cancel', 'Ok'],
          dangerMode: true,
      }).then((willDelete) => {
          if (willDelete) {
            this.currencyservice.deletecurrency(row, this.moduleID, this.DELETE_ACCESS_TYPE).subscribe( data => {
                if (data.data.status == 0) {
                    swal({
                      title: 'Warning',
                      text: data.data.msg,
                      icon: 'warning',
                    });
                  } else {
                    swal(flash, {
                        icon: 'success',
                    });
                    this.ngAfterViewInit() ;
                  }
              }, (error: HttpErrorResponse) => {
                swal('This currency is mapped somewhere else, So can\'t able to delete', {
                  icon: 'warning',
                });
                this.ngAfterViewInit() ;
              });
          }
      });
}

    onPaginateChange(event) {
        this.perpage = event.pageSize;
    }

    syncPrimaryPaginator(event) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.paginator.page.emit(event);
    }

    changestatus(id, currentstatus) {
        const msg = (currentstatus == 'I') ? 'Are you sure want to Activate?' : 'Are you sure want to Deactivate?';
        const flash = (currentstatus == 'A') ? 'Deactivated Successfully' : 'Activated Successfully';
        swal({
            title: msg,
            icon: 'warning',
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    this.currencyservice.updatestatus(id).subscribe(data => {
                        if (data) {
                            swal(flash, {
                                icon: 'success',
                            });
                            this.ngAfterViewInit();
                        }

                    });
                }
            });
    }
}
export interface GithubApi {
    items: Currency[];
    total_count: number;
}
/** An example database that the data source uses to retrieve data for the table. */
export class ExampleHttpDao {
    moduleID: any;
    constructor(private http: HttpClient, moduleID: any) { this.moduleID = moduleID; }
    currencydatas(sort: string, order: string, page: number, size: number, query: string): Observable<GithubApi> {
        const href = environment.baseUrl + 'mst/currencymaster/index';
        const sign = (order == 'desc') ? '-' : '';
        const requestUrl =
            `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&uac=f3f86bb473399a2239202c31420a1ee1&uam=${this.moduleID}`;
        return this.http.get<GithubApi>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    }
}



