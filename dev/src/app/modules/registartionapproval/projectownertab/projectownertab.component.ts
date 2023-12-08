import { Component, OnInit, ViewChild } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import {of as observableOf} from 'rxjs/observable/of';
import { Router } from '@angular/router';
import {ViewEncapsulation } from '@angular/core';
import { environment } from '@env/environment';
import { Encrypt } from '@app/common/class/encrypt';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
@Component({
  selector: 'app-projectownertab',
  templateUrl: './projectownertab.component.html',
  styleUrls: ['./projectownertab.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ProjectownertabComponent implements OnInit {
  displayedColumns = ['mcm_referenceno', 'mrm_projownerid', 'MCM_CompanyName', 'prjt_referenceno','prjt_projname','prjt_sectormst_fk','CyM_CountryName_en', 'prjt_submittedon','MRM_CreatedOn','MRM_MemberStatus','Action'];
  resultsLength = 0;
  perpage: any;
  page: number;
  searchControl: FormControl = new FormControl('');
  projOwnListData: MatTableDataSource<any>;
  projOwnGridDatas: ProjectOwner;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('paginator') paginator: MatPaginator;
  querystr: string;
  filterList = [{'id':2,'name':'Posted for validation'},{'id':3,'name':'Received'},{'id':4,'name':'Declined'},{'id':5,'name':'Re-submitted'}];
  supplierStatusFilterFormGroup: FormGroup;
  constructor(private http: HttpClient,private router:Router, private security:Encrypt, private filterFormBuilder: FormBuilder) { }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

  onPaginateChange(event) {
    this.perpage = event.pageSize;
    this.page = parseInt(event.pageIndex) + 1;
  }

  ngOnInit() {
    this.supplierStatusFilterFormGroup = this.filterFormBuilder.group({
      certifiedFilterVal:  this.filterFormBuilder.array([]) 
     });
  }
  clearFilter(){
    this.searchControl.setValue('');
    this.fetchProjOwnData();
  }
  filterChange(event){
    const filterselectedValues = <FormArray>this.supplierStatusFilterFormGroup.get('certifiedFilterVal') as FormArray;
    if(event.checked){
      filterselectedValues.push(new FormControl(event.source.value)) 
    }else{
      var i = filterselectedValues.controls.findIndex(x => x.value === event.source.value);
      filterselectedValues.removeAt(i);
    }
  }

  ngAfterViewInit(){
    this.fetchProjOwnData()
  }
  viewpage(regpk){
    if(regpk){
      this.router.navigate(['/regapproval/viewandvalidate/',this.security.encrypt(regpk),2]);
    }
  }

  fetchProjOwnData() {
    this.projOwnGridDatas = new ProjectOwner(this.http);
    this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
    merge(this.sort.sortChange, this.paginator.page)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.projOwnGridDatas.projOwnGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.perpage, this.querystr, this.searchControl.value,JSON.stringify(this.supplierStatusFilterFormGroup.value));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => this.projOwnListData = new MatTableDataSource(data));
  }


}

export class ProjectOwner {
  constructor(private http?: HttpClient) {
  }

  projOwnGridUtil(sort: string, order: string, page: number, size: number, query: string, search?: string,projFilter?:string): Observable<any> {
    const href = environment.baseUrl + 'apr/approval/projectregdata';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&projFilter=${search}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
