import { Component, OnInit, ViewChild } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import {of as observableOf} from 'rxjs/observable/of';
import { FormArray, FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import {ViewEncapsulation } from '@angular/core';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { environment } from '@env/environment';
import { Encrypt } from '@app/common/class/encrypt';
const ELEMENT_DATA: any[] = [
  {position: 'LY0451', name: 'IN001415', email:'Business Gateways International',type:'Corporate Investor',incorp:'Private Sector',status:'Explore', country: 'Oman',register:'15-05-2020',validated:'15-05-2020',},
  {position:'LY0451', name: 'IN001415', email:'Business Gateways International', type:'Corporate Investor' ,incorp:'Private Sector', status:'Champion',  country: 'Libya',register:'15-05-2020',validated:'-',},
  {position: 'LY0451', name: 'IN001415', email:'Business Gateways International',type:'Individual Investor' , incorp:'Private Sector',status:'Family',   country: 'Oman', register:'15-05-2020',validated:'15-05-2020',}
];
@Component({
  selector: 'app-suppliertab',
  templateUrl: './suppliertab.component.html',
  styleUrls: ['./suppliertab.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class SuppliertabComponent implements OnInit {
  displayedColumns = ['mcm_referenceno', 'mrm_investorid', 'MCM_CompanyName', 'mrm_invidentity','ISM_IncorpStyleBrief','mcm_stakeholderstatus','CyM_CountryName_en','MRM_CreatedOn','MRM_MemberStatus','Action'];
  searchControl: FormControl = new FormControl('');
  resultsLength = 0;
  perpage: any;
  page: number;
  investorListData: MatTableDataSource<any>;
  investorGridDatas: Investor;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('paginator') paginator: MatPaginator;
  querystr: string;
  filterList = [{'id':1,'name':'Yet to Validate'},{'id':2,'name':'Active'},{'id':3,'name':'Inactive'}];
  supplierStatusFilterFormGroup: FormGroup;
  
  constructor(private http: HttpClient,private router: Router, private security:Encrypt,private filterFormBuilder: FormBuilder) { }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

  onPaginateChange(event) {
    this.perpage = event.pageSize;
    this.page = parseInt(event.pageIndex) + 1;
  }
  ngAfterViewInit(){
    this.fetchInvestorData()
  }
  viewpage(regpk){
    if(regpk){
      this.router.navigate(['/regapproval/viewandvalidate/',this.security.encrypt(regpk),1]);
    }
  }
  ngOnInit() {
    this.supplierStatusFilterFormGroup = this.filterFormBuilder.group({
      certifiedFilterVal:  this.filterFormBuilder.array([]) 
     });
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

  fetchInvestorData() {
    this.investorGridDatas = new Investor(this.http);
    this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
    merge(this.sort.sortChange, this.paginator.page)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.investorGridDatas.investorGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.perpage, this.querystr, this.searchControl.value,JSON.stringify(this.supplierStatusFilterFormGroup.value));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => this.investorListData = new MatTableDataSource(data));
  }

}

export class Investor {
  constructor(private http?: HttpClient) {
  }

  investorGridUtil(sort: string, order: string, page: number, size: number, query: string, search?: string,statusfilter?:string): Observable<any> {
    const href = environment.baseUrl + 'apr/approval/investorregdata';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&statuFilter=${statusfilter}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
