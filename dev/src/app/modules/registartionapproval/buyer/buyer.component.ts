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
import { environment } from '@env/environment';
import { Encrypt } from '@app/common/class/encrypt';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import { MatPaginator, PageEvent } from '@angular/material/paginator';

const ELEMENT_DATA: any[] = [
  {position: 1, name: 'Business Gateways International', email:'vijay@businessgateways.com', country: 'Oman',register:'15-05-2020',validated:'15-05-2020',mode:'Online'},
  {position: 2, name: 'Business Gateways International', email:'joseph@businessgateways.com', country: 'Libya',register:'15-05-2020',validated:'-',mode:'Online'},
  {position: 3, name: 'Business Gateways International', email:'raj@businessgateways.com', country: 'Oman', register:'15-05-2020',validated:'15-05-2020',mode:'Online'},
 
];
@Component({
  selector: 'app-buyer',
  templateUrl: './buyer.component.html',
  styleUrls: ['./buyer.component.scss']
})
export class BuyerComponent implements OnInit {
  displayedColumns = ['mcm_referenceno', 'mrm_buyerid','MCM_CompanyName', 'CyM_CountryName_en', 'UM_EmailID','mrm_sectormst_fk','MRM_CreatedOn','mcpd_appdeclon','MRM_MemberStatus','Action',];
  searchControl: FormControl = new FormControl('');
  perpage: any;
  filterList = [{'id':1,'name':'Yet to Validate'},{'id':2,'name':'Active'},{'id':3,'name':'Inactive'}];
  supplierStatusFilterFormGroup: FormGroup;

  buyerListData: MatTableDataSource<any>;
  buyerGridDatas: Buyer;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('paginator') paginator: MatPaginator;
  querystr: string;
  resultsLength = 0;
  constructor(private http: HttpClient,private router:Router,private security:Encrypt,private filterFormBuilder:FormBuilder) { }

  onPaginateChange(event) {
     this.perpage = event.pageSize;
     // this.page = parseInt(event.pageIndex) + 1;
   }
   viewpage(regpk){
    if(regpk){
      this.router.navigate(['/regapproval/viewandvalidate/',this.security.encrypt(regpk),3]);
    }
  }
  clearFilter(){
    this.searchControl.setValue('');
	this.fetchBuyerData();
  }
   syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
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

  ngAfterViewInit(){
    this.fetchBuyerData();
  }


  fetchBuyerData() {
    this.buyerGridDatas = new Buyer(this.http);
    this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
    merge(this.sort.sortChange, this.paginator.page)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.buyerGridDatas.investorGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1, this.perpage, this.querystr, this.searchControl.value,JSON.stringify(this.supplierStatusFilterFormGroup.value));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => this.buyerListData = new MatTableDataSource(data));
  }
}

export class Buyer {
  constructor(private http?: HttpClient) {
  }

  investorGridUtil(sort: string, order: string, page: number, size: number, query: string, search?: string,buyerFilter?: string): Observable<any> {
    const href = environment.baseUrl + 'apr/approval/buyerregdata';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&buyerFilter=${buyerFilter}`;
    return this.http.get<any>(requestUrl);
  }
}
