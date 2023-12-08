import { Component, OnInit, ViewChild, ViewEncapsulation, QueryList, Input, Output, EventEmitter } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { SelectionModel } from '@angular/cdk/collections';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { MatSort } from '@angular/material/sort';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import { FormControl,FormArray,FormBuilder,FormGroup } from '@angular/forms';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import {of as observableOf} from 'rxjs/observable/of';
import { ActivatedRoute } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { MatCheckbox } from '@angular/material/checkbox';
import { ApplicationService } from '@app/services/application.service';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';

export const MY_FORMATS = {
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

@Component({
  selector: 'app-ivmsoperator',
  templateUrl: './ivmsoperator.component.html',
  styleUrls: ['./ivmsoperator.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({ height: '*', display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
  encapsulation: ViewEncapsulation.None,
})

export class IvmsoperatorComponent implements OnInit {
 
  i18n(key) {
    return this.translate.instant(key);
  }

    // Operators
    @ViewChild('hideChkbox') hideChkbox: MatCheckbox;
    public selectAlloperate: boolean = false;

  // table operator start
  operatorListData = [
    { operatorcolumn: "checkbox", operatsrch: "row-first", label: "CheckBox", showVisible: true, disoperate: true },
    { operatorcolumn: "appoprct_operatorname", operatsrch: "row-second", label: "operatorcontact.opername", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_conttype", operatsrch: "row-three", label: "operatorcontact.conttype", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_contstartdate", operatsrch: "row-four", label: "operatorcontact.contstartdate", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_contenddate", operatsrch: "row-five", label: "operatorcontact.contenddate", showVisible: true, disoperate: true },
    { operatorcolumn: "appoprct_status", operatsrch: "row-six", label: "operatorcontact.stat", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_createdon", operatsrch: "row-seven", label: "operatorcontact.addon", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_updatedon", operatsrch: "row-eight", label: "operatorcontact.lastupdat", showVisible: true, disoperate: true },
    { operatorcolumn: "action", operatsrch: "row-nine", label: "operatorcontact.Action", showVisible: true, disoperate: true },
  ];
  // displayed column
  getoperatorListData(): string[] {
    return this.operatorListData.filter(operator_list => operator_list.showVisible).map(operator_list => operator_list.operatorcolumn);
  }
  // displayed search
  getoperatorListDatasearch(): string[] {
    return this.operatorListData.filter(operator_list => operator_list.showVisible).map(operator_list => operator_list.operatsrch);
  }
  // column edit function
  selectAlloperatorListDataFun(event: any) {
    this.selectAlloperate = event.checked;
    this.operatorListData.forEach(item => {
      item.showVisible = this.selectAlloperate;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
  }
  // column edit function
  updateSelectAlloperatorListData(item: any) {
    const OperatChecked = this.operatorListData.every(item => item.showVisible);
    if (OperatChecked) {
      this.hideChkbox.checked = true;
    } else {
      this.hideChkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
  }
  // table operator end
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("dataChkBox") dataChkBox: QueryList<any>;
  @ViewChild("ChkBox") ChkBox: MatCheckbox;
  @Input() isValidated: boolean = false;
  public supplierListData: MatTableDataSource<any>;
  public GridDatas: OperatorPagination;
  public page: number = 10;
  public newone:boolean = false;
  public update:boolean = true;
  public approval:boolean = false;
  public decline:boolean =  false;
  public success:boolean = false;
  public declinecmd:boolean = false;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  public resultsLength: number;
  public noData:any = '';
  public apptempPk: any;
  public appoprct_operatorname: any;
  public appoprct_conttype: any;
  public appoprct_contstartdate: any;
  public appoprct_contenddate: any;
  public appoprct_status: any;
  public appoprct_createdon: any;
  public appoprct_updatedon: any;
  public operatorData: MatTableDataSource<{}>;
  public searchByText: any;
  public searchByValue: any;
  public ifarabic: boolean = false;
  public arr = [];
  public dataforcheckbox: any[];
  public appstatus = [];
  public overallstatus: any;
  public disableSubmitButton: boolean;
  public tblplaceholder: boolean =  false;
  public expandedElement: boolean = false;
  public apptype: any;
  public updatevalidation: boolean = true;
  public appdt_apptype: any;
  public paginationSet =
  BgiJsonconfigServices.bgiConfigData.configuration
    .enterpriseAdminPaginatonSet;
    @ViewChild(MatSort) sort: MatSort;
    private querystr: string;
    searchControl: FormControl = new FormControl('');
 
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
  type: any;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private http: HttpClient,public routeid: ActivatedRoute ,private security: Encrypt , private appservice : ApplicationService ) {

    this.onValidation = this.onValidation.bind(this);
   }
 languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
      }else{
        this.filtername = "إخفاء التصفية";      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
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
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
    });
    this.appoprct_operatorname = new FormControl('');
    this.appoprct_conttype = new FormControl('');
    this.appoprct_contstartdate = new FormControl('');
    this.appoprct_contenddate = new FormControl('');
    this.appoprct_status = new FormControl('');
    this.appoprct_createdon = new FormControl('');
    this.appoprct_updatedon = new FormControl('');

    this.appoprct_operatorname.valueChanges.debounceTime(400).subscribe(
      register => {  
    
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();   
        }    
      }
    )
    this.appoprct_conttype.valueChanges.debounceTime(400).subscribe(
      register => {  
        this.paginator.pageIndex = 0;      
        this.fetchOperatorData();   
      }
    )
    this.appoprct_contstartdate.valueChanges.debounceTime(400).subscribe(
      type => {   
        this.paginator.pageIndex = 0;      
        this.fetchOperatorData(); 
      }
    )
    this.appoprct_contenddate.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }    
      }
    )
    this.appoprct_status.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }    
      }
    )
    this.appoprct_createdon.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }    
      }
    )
    this.appoprct_updatedon.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchOperatorData();
        }    
      }
    )
  }
  ngAfterViewInit(){
    this.fetchOperatorData();
   }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchOperatorData(); 
  }

  selectAllFun(data){
    if(data == true){
      this.dataforcheckbox.forEach((data, index) => {
        this.arr.push(data.appoprcontracttmp_pk);
      })
    }else{
  
      this.dataforcheckbox.forEach((data, index) => {
        const PrdIndex = this.arr.indexOf(data.appoprcontracttmp_pk);
        this.arr.splice(PrdIndex, 1);
      })      
    }
  }

  onValidation(form , resetForm){
    this.disableSubmitButton = true; 
    this.appservice.updateContract(form.value,this.arr).subscribe(data => {
      if(data.data.msg == 'success'){
        this.disableSubmitButton = false; 
        swal({
          title: this.i18n('company.opervalidation'),
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
         
        this.fetchOperatorData();
      } else{
        this.disableSubmitButton = false; 
        swal({
          title: data.data.comments,
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
         
        this.fetchOperatorData();
      }
                         
    });
}

  fetchOperatorData() {
    this.tblplaceholder = true;
      this.GridDatas = new OperatorPagination(this.http);
      this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
      var gridsearchvalue = {};
  

     gridsearchvalue = {appoprct_operatorname:this.appoprct_operatorname.value,appoprct_conttype:this.appoprct_conttype.value,appoprct_contstartdate:this.appoprct_contstartdate.value,appoprct_contenddate:this.appoprct_contenddate.value,appoprct_status:this.appoprct_status.value, appoprct_createdon:this.appoprct_createdon.value,appoprct_updatedon:this.appoprct_updatedon.value};
      merge(this.sort.sortChange)
        .pipe(
          startWith({}),
          switchMap(() => {
           
            return this.GridDatas.operatorGridUtil(
              this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
               this.page,
              JSON.stringify(gridsearchvalue),this.apptempPk);
          }),
          map(data => {
            this.resultsLength = data['data'].data.totalcount;
            this.overallstatus  = data['data'].data.appstatus;
            this.appdt_apptype  = data['data'].data.appdt_apptype;
            if(this.appdt_apptype == 3 || this.appdt_apptype == undefined){
               this.updatevalidation = false;
            }
            return data['data'].data.data;
          }),
          catchError(() => {
            return observableOf([]);
          })
        ).subscribe(data => {
        
          this.supplierListData = new MatTableDataSource<any>(data);
          this.supplierListData.filterPredicate = this.createFilter();
          this.dataforcheckbox= Object.keys(data || {}).map(function(index){
            let dataList = data[index];
            return dataList;
          });
          this.tblplaceholder =false;
          this.noData = this.supplierListData.connect().pipe(map(data => data.length === 0));
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

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      let searchTerms = JSON.parse(filter);
             return data.appoprct_operatorname.toLowerCase().indexOf(searchTerms.appoprct_operatorname) !== -1 &&
             data.appoprct_conttype.toLowerCase().indexOf(searchTerms.appoprct_conttype) !== -1 &&
             data.appoprct_contstartdate.toLowerCase().indexOf(searchTerms.appoprct_contstartdate) !== -1 &&
             data.appoprct_contenddate.toLowerCase().indexOf(searchTerms.appoprct_contenddate) !== -1 &&
             data.appoprct_status.toLowerCase().indexOf(searchTerms.appoprct_status) !== -1 &&
             data.appoprct_createdon.toLowerCase().indexOf(searchTerms.appoprct_createdon) !== -1 &&
             data.appoprct_contenddate.toLowerCase().indexOf(searchTerms.appoprct_contenddate) !== -1 ;
            
    }
  return filterFunction;    
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
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
  }
  clearFilter() {
    this.appoprct_operatorname.setValue("");
    this.appoprct_conttype.setValue("");
    this.appoprct_contstartdate.setValue("");
    this.appoprct_contenddate.setValue("");
    this.appoprct_status.setValue("");
    this.appoprct_createdon.setValue(""); 
    this.appoprct_updatedon.setValue("");
  this.fetchOperatorData();
  $(".clear").trigger("click");
  }
}

export class OperatorPagination {
  constructor(private http?: HttpClient) {
  }

  operatorGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string,appid?:number): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getoperator';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
