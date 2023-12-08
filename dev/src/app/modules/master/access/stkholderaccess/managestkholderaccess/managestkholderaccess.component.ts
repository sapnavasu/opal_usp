import {Component, OnInit, ViewChild, ChangeDetectorRef} from '@angular/core';
import {FormBuilder, FormGroup, Validators, FormControl} from '@angular/forms';
import {Router, ActivatedRoute, Params} from '@angular/router';
import {MatSort, MatSortable, MatTableDataSource, MatPaginator, MatDrawer, PageEvent} from '@angular/material';
import {HttpClient} from '@angular/common/http';
import {atLeastOne} from './../../../../config_files/directives/atleastone';
import {merge} from 'rxjs/observable/merge';
import {of as observableOf} from 'rxjs/observable/of';
import {catchError} from 'rxjs/operators/catchError';
import {map} from 'rxjs/operators/map';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {SelectionModel} from '@angular/cdk/collections';
import {Observable} from 'rxjs';
import {environment} from '../../../../../../environments/environment';
import swal from 'sweetalert';
import {StkholderaccessService} from '../stkholderaccess.service';

@Component({
  selector: 'app-managestkholderaccess',
  templateUrl: './managestkholderaccess.component.html',
  styleUrls: ['./managestkholderaccess.component.scss']
})
export class ManagestkholderaccessComponent implements OnInit {

  public enabled;
  public editid = 0;
  stkholdtypelist: any[];
  basemodulelists: any[];
  @ViewChild(MatDrawer) drawer: any;
  createbutton = true;
  updatebutton = false;
  searchfilter = false;
  pageEvent: any;
  roleid = null;
  resultsLength = 0;
  perpage = 10;
  isRateLimitReached = false;
  displayedColumns = ['checkall', 'sham_stkholdertypmst_fk', 'sham_basemodulemst_fk', 'sham_order', 'actionsColumn'];
  displayNoRecords: boolean;
  exampleDatabase: ExampleHttpDao | null;
  dataSource = new MatTableDataSource();
  public showFilter = 'Show Filter';
  public stkholdtypename: any;
  public basemodulename: any;
  public order: any;
  public querystr = '';
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;

  constructor(private http: HttpClient, private fb: FormBuilder,
              private stkholdService: StkholderaccessService,
              protected router: Router,
              private changeDetector: ChangeDetectorRef
  ) {
  }

  ngOnInit() {
    this.getStkholdtype();
    this.getBaseModules();
  }

  ngAfterViewInit() {
    this.fetchData();
  }

  searchiconclick() {
    this.searchfilter = !this.searchfilter;
    this.showFilter = this.searchfilter ? 'Hide Filter' : 'Show Filter';
  }

  getStkholdtype() {
    this.stkholdService.getStkholderTypes().subscribe(
      data => {
        this.stkholdtypelist = data['data'];
      });
  }

  getBaseModules() {
    this.stkholdService.getBaseModules().subscribe(data => {
      this.basemodulelists = data['data'];
    });
  }

  /* FILTER FORM FIELD GROUPING */
  filterform = new FormGroup({
    basemodulename: new FormControl(''),
    stkholdtypename: new FormControl(''),
    order: new FormControl('')
  }, {validators: atLeastOne(Validators.required)});

  /* FILTER FORM SUBMIT METHOD */
  onFilterSubmit() {
    const formvalues = this.filterform.value;
    this.stkholdtypename = '';
    this.basemodulename = '';
    this.order = '';
    if (formvalues.stkholdtypename) {
      this.stkholdtypename = formvalues.stkholdtypename.trim();
    }
    if (formvalues.basemodulename) {
      this.basemodulename = formvalues.basemodulename.trim();
    }
    if (formvalues.order) {
      this.order = formvalues.order.trim();
    }
    let filterpagestring = '';
    const perpage = 10;
    const filtersign = (this.sort.direction == 'desc') ? '-' : '';
    filterpagestring = `sort=${filtersign}${this.sort.active}&order=${this.sort.direction}&page=${this.paginator.pageIndex + 1}&size=${this.perpage}`;
    this.stkholdService.stkholdaccessfilter(filterpagestring, this.stkholdtypename, this.basemodulename, this.order).subscribe(res => {
      this.dataSource.data = res['data'].items;
      this.resultsLength = res['data'].total_count;
      this.dataSource.filter = '';
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
    this.displayNoRecords = false;
    this.exampleDatabase = new ExampleHttpDao(this.http);
    // If the user changes the sort order, reset back to the first page.
    this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
    merge(this.sort.sortChange, this.paginator.page)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';

          if (this.stkholdtypename && this.stkholdtypename != null) {
            this.querystr += `&stkholdtypename=${this.stkholdtypename}`;
          }
          if (this.basemodulename && this.basemodulename != null) {
            this.querystr += `&basemodulename=${this.basemodulename}`;
          }
          if (this.order && this.order != null) {
            this.querystr += `&moduleorder=${this.order}`;
          }

          //this.querystr += `&type=${'filter'}`;
          return this.exampleDatabase!.stkholddatas(
            this.sort.active, this.sort.direction, this.paginator.pageIndex, this.perpage, this.querystr);
        }),
        map(data => {
          // Flip flag to show that loading has finished.
          this.isRateLimitReached = false;
          this.resultsLength = data['data'].total_count;
          return data['data'].items;
        }),
        catchError(() => {
          //this.isLoadingResults = false;
          // Catch if the GitHub API has reached its rate limit. Return empty data.
          this.isRateLimitReached = true;
          return observableOf([]);
        })
      ).subscribe(data => this.dataSource.data = data);
  }

  /* MULTIPLE CHECKBOX ACTION METHOD */
  selection = new SelectionModel<string>(true, []);

  isAllSelected() {
    if (!this.dataSource) {
      return false;
    }
    if (this.selection.isEmpty()) {
      return false;
    }
    return this.selection.selected.length === this.dataSource.data.length;
  }

  masterToggle() {
    if (!this.dataSource) {
      return;
    }

    if (this.isAllSelected()) {
      this.selection.clear();
    } else {
      this.dataSource.data.forEach(data => {
        this.selection.select(data['stkholderaccessmst_pk']);
      });
    }
  }

  /* MULTIPLE ROW DELETE ACTION METHOD */
  multiplerowdel() {
    swal({
      title: 'Are you sure want to delete?',
      icon: 'warning',
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        const selectedpks = this.selection.selected.toString();
        this.stkholdService.deleteStkholderAccess(selectedpks).subscribe(datares => {
          if (datares) {
            swal('Successfully Deleted', {
              icon: 'success',
            });
            this.fetchData();
            this.selection.clear();
          }

        });
      }
    });
  }

  /* FILTER FORM RESET METHOD */
  formreset() {
    this.stkholdtypename = '';
    this.basemodulename = '';
    this.order = '';
    this.fetchData();
    this.reloadTree();
  }

  startEdit(stkholdaccessid: number) {
    this.reloadTree();
    this.editid = stkholdaccessid;
    this.drawer.toggle();
  }

  cancelOrDelete(stkholdaccessid) {
    const msg = 'Are you sure want to delete?';
    let flash;
    swal({
      title: msg,
      icon: 'warning',
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.stkholdService.deleteStkholderAccess(stkholdaccessid).subscribe(data => {
          if (data['data'].statusmsg == 'success') {
            flash = 'Deleted Successfully !';
            swal(flash, {
              icon: 'success',
            });
            this.ngAfterViewInit();
          } else {
            flash = 'Something went wrong';
            swal(flash, {
              icon: 'warning',
            });
          }

        });
      }
    });
  }

  onPaginateChange(event) {
    this.perpage = event.pageSize;
  }

  
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

}

export interface GithubApi {
  items: any[];
  total_count: number;
}

/** An example database that the data source uses to retrieve data for the table. */
export class ExampleHttpDao {
  constructor(private http: HttpClient) {
  }

  stkholddatas(sort: string, order: string, page: number, size: number, query: string): Observable<GithubApi> {
    const href = environment.baseUrl + 'acm/stkholderaccessmaster/getstkholderaccessdata';
    const sign = (order == 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&uac=f9d6c6ad2e0f8bfded8c4c37e4140629`;
    return this.http.get<GithubApi>(requestUrl);
  }

}