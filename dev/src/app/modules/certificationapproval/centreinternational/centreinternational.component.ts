import { Component, OnInit, ViewChild, ViewEncapsulation, QueryList, ɵConsole, Input, Output, EventEmitter } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { CommoncommentsComponent } from '@app/@shared/commoncomments/commoncomments.component';
import { MatDialog } from '@angular/material/dialog';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { HttpClient } from '@angular/common/http';
import { MatSort } from '@angular/material/sort';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import {of as observableOf} from 'rxjs/observable/of';
import {switchMap} from 'rxjs/operators/switchMap';
import {startWith} from 'rxjs/operators/startWith';
import {merge} from 'rxjs/observable/merge';
import { environment } from '@env/environment';
import { Encrypt } from '@app/common/class/encrypt';
import { MatCheckbox } from '@angular/material/checkbox';
import { SelectionModel } from '@angular/cdk/collections';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { PopoverDirective } from 'ngx-smart-popover';

export interface Element {
  awarding: any;
  position: any;
  lastaudited: any;
  document: any;
  addedon: any;
  status: any;
  lastupdated: any;
}

// const ELEMENT_DATA: Element[] = [
//   { position: 1, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'A', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
//   { position: 2, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'D', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
//   { position: 3, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'U', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
//   { position: 4, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'N', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
// ];
@Component({
  selector: 'app-centreinternational',
  templateUrl: './centreinternational.component.html',
  styleUrls: ['./centreinternational.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({  display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None,
 
})
export class CentreinternationalComponent implements OnInit {
  apptype: any;
  updatevalidation: boolean = true;
  appdt_apptype: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  ifarabic: boolean = false;
  newone:boolean = false;
  update:boolean = false;
  approval:boolean = false;
  decline:boolean =  true;
  success:boolean = false;
  declinecmd:boolean = false;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page: number = 10;
  resultsLength: number;
  paginationSet =
  BgiJsonconfigServices.bgiConfigData.configuration
    .enterpriseAdminPaginatonSet;

@ViewChild("paginator") paginator: MatPaginator;
@ViewChild("dataChkBox") dataChkBox: QueryList<any>;
@ViewChild("ChkBox") ChkBox: MatCheckbox;
  // international
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  public selectAllVisible: boolean = false;
// table internatioanl start
displayedColumns = [
  { def: "checkbox", search: "row-first", label: "CheckBox", visible: true, disabled: true },
  { def: "irm_intlrecogname_en", search: "row-second", label: "international.awarorgan", visible: true, disabled: false },
  { def: "appintit_lastauditdate", search: "row-three", label: "international.lastaudi", visible: true, disabled: false },
  { def: "appintit_doc", search: "row-four", label: "international.document", visible: true, disabled: false },
  { def: "appintit_status", search: "row-five", label: "international.stat", visible: true, disabled: true },
  { def: "appintit_createdon", search: "row-six", label: "international.addon", visible: true, disabled: false },
  { def: "appintit_updatedon", search: "row-seven", label: "international.lastupdat", visible: false, disabled: true },
  { def: "action", search: "row-eight", label: "international.Action", visible: true, disabled: true },
];
// displayed column
getdisplayedColumns(): string[] {
  return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
}
// displayed search
getdisplayedsearch(): string[] {
  return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.search);
}
// column edit function
selectdisplayedAllFun(event: any) {
  this.selectAllVisible = event.checked;
  this.displayedColumns.forEach(item => {
    item.visible = this.selectAllVisible;
  });
  setTimeout(() => {
    $(".clear").trigger("click");
  }, 300);
}
// column edit function
updateSelectAllVisible(item: any) {
  const allChecked = this.displayedColumns.every(item => item.visible);
  if (allChecked) {
    this.editchkbox.checked = true;
  } else {
    this.editchkbox.checked = false;
  }
  setTimeout(() => {
    $(".clear").trigger("click");
  }, 300);
}

@ViewChild('myPopover', { static: false }) pop: PopoverDirective;
@Input() element: any;
@Output() closeClick: EventEmitter<any> = new EventEmitter<any>();
  apptempPk: any;
  dowloadlogdata: any[];
  dataSource: MatTableDataSource<any>;
  
  public perpage = 5;
  public fetchPageSize:number = 5;
  public fetchPage:number = 0;
  public postUrl:any;
  public postParams: any;
  public keywordSearchVal: any;
  supplierGridDatas: SupplierPagination;
  @ViewChild(MatSort) sort: MatSort;
  searchByValue: any;
  searchByText: any;
  private querystr: string;
  searchControl: FormControl = new FormControl('');
  irm_intlrecogname_en: any;
  appintit_lastauditdate: any;
  appintit_status: any;
  appintit_createdon: any;
  appintit_updatedon:any;
  public arr = [];
  dataforcheckbox: any[];
  form: any;
  public appstatus = [];
  public  status_update: boolean = false;
  overallstatus: number;
  @Input() isValidated: boolean = false;
  approved: boolean =  true;
  type: any;
  disableSubmitButton: boolean;
  noData: any ='';
  tblplaceholder: boolean = false;
  @Input() expanded: boolean;
  expandedElement: any = null;
constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private dialog: MatDialog,
    private cookieService: CookieService,public routeid: ActivatedRoute , private appservice : ApplicationService , private http: HttpClient,private security: Encrypt) {

       this.onValidation = this.onValidation.bind(this);
     }
     locale: LocaleConfig = {
      format:'DD-MM-YYYY',
    }
  
     ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
	// selected2 = moment();

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
  

  ngOnInit(): void {
    
   if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
      }else{
        this.filtername = "إخفاء التصفية";      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
          this.filtername = "Hide Filter";
     
        }
        else {
          this.ifarabic = true;
          this.filtername = "إخفاء التصفية";   
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
    });
    
      
      this.irm_intlrecogname_en = new FormControl('');
      this.appintit_lastauditdate = new FormControl('');
      this.appintit_status = new FormControl('');
      this.appintit_createdon = new FormControl('');
      this.appintit_updatedon = new FormControl('');


      this.irm_intlrecogname_en.valueChanges.debounceTime(400).subscribe(
      
        register => {  
          if (register != null && register.length >= 3) {
            this.paginator.pageIndex = 0;
            this.fetchSupplierData();
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchSupplierData();
          }    
        }
      )
      this.appintit_lastauditdate.valueChanges.debounceTime(400).subscribe(
      
        register => {  
          this.paginator.pageIndex = 0;      
          this.fetchSupplierData();   
        }
      )
      this.appintit_status.valueChanges.debounceTime(400).subscribe(
      
        type => {   
          this.paginator.pageIndex = 0;      
          this.fetchSupplierData(); 
        }
      )
      this.appintit_createdon.valueChanges.debounceTime(400).subscribe(
      
        register => {  
        
            this.paginator.pageIndex = 0;
            this.fetchSupplierData();
           
        }
      )
      this.appintit_updatedon.valueChanges.debounceTime(400).subscribe(
      
        register => {  
         
            this.paginator.pageIndex = 0;
            this.fetchSupplierData();
            
        }
      )
           
    
  }

  ngAfterViewInit(){
    this.fetchSupplierData();
    

   }

   
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('company.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('company.hitefil');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchSupplierData(); 
  }
  openComments() {
    let dialogRef = this.dialog.open(CommoncommentsComponent, { disableClose: true,   panelClass: 'commentpanel', });
    dialogRef.afterClosed().subscribe(result => {
    });
  }

  // onPaginateChange(event) {
  //   this.perpage = event.pageSize;
  // }

 
 
  fetchSupplierData() {
    this.tblplaceholder = true;
    this.supplierGridDatas = new SupplierPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
     var statusSelectId = [];
     var statusSelectObj = {};
    var gridsearchvalue = {};
    var gridSearch = {};

    this.routeid.params.subscribe(params => {
      this.apptempPk = this.security.decrypt(params['id']);
      this.type = params['type'];
      });


   statusSelectObj = {'certifiedFilterVal':statusSelectId};
    gridSearch = [{
      'searchby': this.searchByValue,
    'searchTxt': this.searchByText}];
    gridsearchvalue = {irm_intlrecogname_en:this.irm_intlrecogname_en.value,appintit_lastauditdate:this.appintit_lastauditdate.value,appintit_status:this.appintit_status.value,appintit_createdon:this.appintit_createdon.value,appintit_updatedon:this.appintit_updatedon.value};
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.supplierGridDatas.supplierGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page
            ,JSON.stringify(gridsearchvalue),this.apptempPk);

      
        }),
        map(data => {
          this.resultsLength = data['data'].data.data.totalcount;
          this.overallstatus  = data['data'].data.data.appstatus;
          this.appdt_apptype  = data['data'].data.data.appdt_apptype;
          if(this.appdt_apptype == 3 || this.appdt_apptype == undefined){
             this.updatevalidation = false;
          }
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.dataSource = new MatTableDataSource<any>(data['data']);
        this.dataSource.filterPredicate = this.createFilter();
        this.dataforcheckbox= Object.keys(data['data']).map(function(index){
           let dataList = data['data'][index];
           return dataList;
        });
        this.appstatus= Object.keys(data['data']).map(function(index){
        let dataList = data['data'][index];
        let status = dataList.appintit_status;
        return status;
        });

        this.noData = this.dataSource.connect().pipe(map(data => data.length === 0));
        // console.log(this.noData)
        this.tblplaceholder = false;
        // if(this.checkArrayEqualElements(this.appstatus) == true){

        // this.overallstatus = this.appstatus[0];
        // }else{
        //   if(this.appstatus.includes('1')){
        //     this.overallstatus = 1;

        //   }else if(this.appstatus.includes('2')){
        //     this.overallstatus = 2;
        //   }else{
        //       this.overallstatus = 4;
        //   }
        // }


       });

  
  }

   checkArrayEqualElements(_array)
{
    if(typeof _array !== 'undefined')    
    {
    var firstElement = _array[0];
    return _array.every(function(element)
    {
        return element === firstElement;
    });
    }
    return "Array is Undefined" ;
}

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.irm_intlrecogname_en.toLowerCase().indexOf(searchTerms.irm_intlrecogname_en) !== -1 &&
             data.appintit_lastauditdate.toLowerCase().indexOf(searchTerms.appintit_lastauditdate) !== -1 &&
             data.appintit_status.toLowerCase().indexOf(searchTerms.appintit_status) !== -1 &&
             data.appintit_createdon.toLowerCase().indexOf(searchTerms.appintit_createdon) !== -1 &&
             data.appintit_updatedon.toLowerCase().indexOf(searchTerms.appintit_updatedon) !== -1 ;
          
    }
  return filterFunction;    
}

onValidation(form ,   resetForm){
  this.disableSubmitButton = true; 
    this.appservice.updateInternational(form.value,this.arr).subscribe(data => {
      this.disableSubmitButton = false; 
      if(data.data.msg == 'success'){
        swal({
         title: this.i18n('company.intervalidation'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.arr.length = 0;
          this.ChkBox.checked = false;
          resetForm();
          
        });
        this.fetchSupplierData();
      }else{
        swal({
          title:data.data.comments,
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.arr.length = 0;
          this.ChkBox.checked = false;
          resetForm();
          
        });

        this.fetchSupplierData();

      }   
                     
    });

  

}


  focusInvalidInput(form: any) {
    throw new Error("Method not implemented.");
  }
validationcheck($event, intpk) {
  if($event.checked == true){
    if(!this.arr.includes(intpk)){
      this.arr.push(intpk)
    }
  }else{
    const index1 = this.arr.indexOf(intpk);
    if (index1 > -1) {
      this.arr.splice(index1, 1);
    }
  }
  if(this.arr.length == this.dataforcheckbox.length){
    this.ChkBox.checked = true;
  }else{
    this.ChkBox.checked = false;
  }
}

selectAllFun(data){
  if(data == true){
    this.dataforcheckbox.forEach((data, index) => {
      this.arr.push(data.appintrecogtmp_pk);
    })
  }else{

    this.dataforcheckbox.forEach((data, index) => {
      const PrdIndex = this.arr.indexOf(data.MemCompProdDtls_Pk);
      this.arr.splice(PrdIndex, 1);
    })      
  }


}
toggleExpansion() {
  if (this.element == this.expandedElement) {
    this.expandedElement = null;
    this.closeClick.emit();
  } else {
    this.expandedElement = this.element;
  }
}
selection = new SelectionModel<Element>(true, []);
  isAllSelected() {
    const numSelected = this.selection.selected.length;
    const numRows = this.dataSource.data.length;
    return numSelected === numRows;
  }
  /** Selects all rows if they are not all selected; otherwise clear selection. */
  masterToggle() {
    this.isAllSelected() ?
        this.selection.clear() :
        this.dataSource.data.forEach(row => this.selection.select(row));
  }
  clearFilter() {
    this.irm_intlrecogname_en.setValue("");
    this.appintit_lastauditdate.setValue("");
    this.appintit_status.setValue("");
    this.appintit_createdon.setValue("");
    this.appintit_updatedon.setValue("");
  this.fetchSupplierData();
  $(".clear").trigger("click");
  }

}

export class SupplierPagination {
  constructor(private http?: HttpClient) {
  }

  supplierGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string,appid?:string): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getintenational';
    const sign = (order === 'desc') ? '-' : '';
    // const requestUrl =
    //   `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&statusFilter=${filterVals}&payfilter=${paymentfilter}&searchValues=${searchValues}&gridsearchValues=${gridsearchValues}&appid=${gridsearchValues}`;
    // return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
  return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
    
  
}
}
