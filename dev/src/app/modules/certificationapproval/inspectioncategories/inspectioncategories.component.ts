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
  arvict_rascategorymst_fk: any;
  arvict_status: any;
  arvict_createdon: any;
  arvict_updatedon: any;
}

@Component({
  selector: 'app-inspectioncategories',
  templateUrl: './inspectioncategories.component.html',
  styleUrls: ['./inspectioncategories.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({  display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None,
 
})
export class InspectioncategoriesComponent implements OnInit {
  appdst_documentdtlsmst_fk: FormControl;
  appdst_submissionstatus: FormControl;
  appdst_status: FormControl;
  appdst_updatedon: FormControl;
  appdst_createdon: FormControl;
  disableSubmitButton: boolean;
  i18n(key) {
    return this.translate.instant(key);
  }
  expandedElement: boolean = false;
  arvict_rascategorymst_fk: FormControl;
  arvict_status: FormControl;
  arvict_createdon: FormControl;
  arvict_updatedon: FormControl;
  appdt_apptype: any;
  apptype: any;
  type:any;
  updatevalidation: boolean = true;
  ifarabic: boolean = false;
  newone:boolean = false;
  update:boolean = false;
  tblplaceholder:boolean = false;
  approval:boolean = false;
  decline:boolean =  true;
  success:boolean = false;
  declinecmd:boolean = false;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  apptempPk: any;
  page: number = 10;
  resultsLength: number;
  paginationSet =
  BgiJsonconfigServices.bgiConfigData.configuration
    .enterpriseAdminPaginatonSet;

@ViewChild("paginator") paginator: MatPaginator;
@ViewChild("dataChkBox") dataChkBox: QueryList<any>;
@ViewChild("ChkBox") ChkBox: MatCheckbox;
@ViewChild(MatSort) sort: MatSort;
public inspectionListData: MatTableDataSource<any>;
GridDatas:  InspectionPagination;
@ViewChild('myPopover', { static: false }) pop: PopoverDirective;
@Input() element: any;
public overallstatus: any;
public disableloaderButton: boolean = false;
dataforcheckbox: any[];
public arr = [];
public appstatus = [];
// inspection
@ViewChild('showandhideChkbox') showandhideChkbox: MatCheckbox;
public selectAllInspection: boolean = true; 
 // table inspection start
 Documentrecordcolumn = [
  { inspectionColumn: "checkbox", filt: "row-first", label: "CheckBox", VisibleData: true, disinspect: true },
  { inspectionColumn: "arvict_rascategorymst_fk", filt: "row-second", label: "Inspection Categories", VisibleData: true, disinspect: true },
  { inspectionColumn: "arvict_status", filt: "row-three", label: "international.stat", VisibleData: true, disinspect: false },
  { inspectionColumn: "arvict_createdon", filt: "row-four", label: "international.addon", VisibleData: true, disinspect: false },
  { inspectionColumn: "action", filt: "row-six", label: "international.Action", VisibleData: true, disinspect: true },
];
// displayed column
getDocumentrecordcolumn(): string[] {
  return this.Documentrecordcolumn.filter(inspection_list => inspection_list.VisibleData).map(inspection_list => inspection_list.inspectionColumn);
}
// displayed search
getDocumentrecordcolumnsearch(): string[] {
  return this.Documentrecordcolumn.filter(inspection_list => inspection_list.VisibleData).map(inspection_list => inspection_list.filt);
}
// column edit function
selectAllDocumentrecordcolumnFun(event: any) {
  this.selectAllInspection = event.checked;
  this.Documentrecordcolumn.forEach(item => {
    item.VisibleData = this.selectAllInspection;
  });
  setTimeout(() => {
    $(".clear").trigger("click");
  }, 300);
}
// column edit function
updateSelectAllDocumentrecordcolumn(item: any) {
  const inspectChecked = this.Documentrecordcolumn.every(item => item.VisibleData);
  if (inspectChecked) {
    this.showandhideChkbox.checked = true;
  } else {
    this.showandhideChkbox.checked = false;
  }
  setTimeout(() => {
    $(".clear").trigger("click");
  }, 300);
}
  noData: any = '';

@Output() closeClick: EventEmitter<any> = new EventEmitter<any>();
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
     this.routeid.params.subscribe(params => {
      this.apptempPk = this.security.decrypt(params['id']);
      this.type = params['type'];
      });

    this.arvict_rascategorymst_fk = new FormControl('');
    this.arvict_status = new FormControl('');
     this.arvict_createdon = new FormControl('');
    this.arvict_updatedon = new FormControl('');

    this.arvict_rascategorymst_fk.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.fetchInspectiontData();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchInspectiontData();   
        }    
      }
    )
    this.arvict_status.valueChanges.debounceTime(400).subscribe(
    
      register => {  
        this.paginator.pageIndex = 0;      
        this.fetchInspectiontData();   
      }
    )
  
    this.arvict_createdon.valueChanges.debounceTime(400).subscribe(
    
      register => {  
  
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchInspectiontData();
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchInspectiontData();
        }    
      }
    )
    this.arvict_updatedon.valueChanges.debounceTime(400).subscribe(
    
      register => {  

        if (register != null) {
          this.paginator.pageIndex = 0;
          this.fetchInspectiontData();
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchInspectiontData();
        }    
      }
    )
    if(this.type == 'view'){
      this.Documentrecordcolumn = [
        // { inspectionColumn: "checkbox", filt: "row-first", label: "CheckBox", VisibleData: true, disinspect: true },
        { inspectionColumn: "arvict_rascategorymst_fk", filt: "row-second", label: "Inspection Categories", VisibleData: true, disinspect: true },
        { inspectionColumn: "arvict_status", filt: "row-three", label: "international.stat", VisibleData: true, disinspect: false },
        { inspectionColumn: "arvict_createdon", filt: "row-four", label: "international.addon", VisibleData: true, disinspect: false },
        { inspectionColumn: "action", filt: "row-six", label: "international.Action", VisibleData: true, disinspect: true },
      ];
    }
    }

    ngAfterViewInit(){
      this.fetchInspectiontData();
     }

     fetchInspectiontData() {
      // this.tblplaceholder = true;
      this.GridDatas = new InspectionPagination(this.http);
      this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
      var gridsearchvalue = {};
  
  
     gridsearchvalue = {arvict_rascategorymst_fk:this.arvict_rascategorymst_fk.value,arvict_status:this.arvict_status.value,arvict_createdon:this.arvict_createdon.value,arvict_updatedon:this.arvict_updatedon.value};
      merge(this.sort.sortChange)
        .pipe(
          startWith({}),
          switchMap(() => {
           
            return this.GridDatas.InspectionGridUtil(
              this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
               this.page,
              JSON.stringify(gridsearchvalue), this.apptempPk);
          }),
          map(data => {
            this.resultsLength = data['data'].data.totalcount;
            this.overallstatus  = data['data'].data.appstatus;
            this.appdt_apptype  = data['data'].data.appdt_apptype;
          
            if(this.appdt_apptype == 3 || this.appdt_apptype == undefined){
             //  this.updatevalidation = false;
            }
            return data['data'].data.data;
          }),
          catchError(() => {
            return observableOf([]);
          })
        ).subscribe(data => {
          this.inspectionListData = new MatTableDataSource<any>(data);
          this.inspectionListData.filterPredicate = this.createFilter();
          this.dataforcheckbox= Object.keys(data || {}).map(function(index){
            let dataList = data[index];
            return dataList;
         });
         this.appstatus= Object.keys(data || {}).map(function(index){
          let dataList = data[index];
          let status = dataList.appdst_status;
  
          return status;
          });
          
          this.noData = this.inspectionListData.connect().pipe(map(data => data.length === 0));
         // console.log(this.noData)
  
        
         });
  
      
  
        
    }
    filter_inspect = new FormControl('');
   filter_status = new FormControl('');
   filter_creat = new FormControl('');
   filter_update = new FormControl('');
    
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
               return data.arvict_rascategorymst_fk.toLowerCase().indexOf(searchTerms.arvict_rascategorymst_fk) !== -1 &&
               data.arvict_status.toLowerCase().indexOf(searchTerms.arvict_status) !== -1 &&
               data.arvict_createdon.toLowerCase().indexOf(searchTerms.arvict_createdon) !== -1 &&
               data.arvict_updatedon.toLowerCase().indexOf(searchTerms.arvict_updatedon) !== -1 ;
              
      }
    return filterFunction;    
    }
  
    syncPrimaryPaginator(event: PageEvent) {
      this.paginator.pageIndex = event.pageIndex;
      this.paginator.pageSize = event.pageSize;
      this.page = event.pageSize;
    }
    clearFilter() {
      this.filter_inspect.setValue("");
      this.filter_status.setValue("");
      this.filter_creat.setValue("");
      this.filter_update.setValue("");
      $(".clear").trigger("click");
    }
    toggleExpansion() {
      this.expandedElement = !this.expandedElement;
      // this.expandedElement = false;
    }
    selectAllFun(data){
      console.log(data , 'slslls');
      if(data == true){
        this.dataforcheckbox.forEach((data, index) => {
          this.arr.push(data.apprasvehinspcattmp_pk);
        })
      }else{
    
        this.dataforcheckbox.forEach((data, index) => {
          const PrdIndex = this.arr.indexOf(data.apprasvehinspcattmp_pk);
          this.arr.splice(PrdIndex, 1);
        })      
      }
    
      console.log(this.arr , 'arr'); 
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

    onValidation(form , resetForm){
      this.disableSubmitButton = true; 
  
      this.appservice.updateInspection(form.value,this.arr).subscribe(data => {
        if(data.data.msg == 'success'){
        this.disableSubmitButton = false; 
        swal({
          title:"The Inspection Categories required has been Validated and Submitted.",
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
       this.fetchInspectiontData();
  
      }else{
        this.disableSubmitButton = false; 
        swal({
          title:data.data.comments,
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.arr.length = 0;
          this.ChkBox.checked = false;
          resetForm();
        });
       this.fetchInspectiontData();
  
      }                     
      });
   }
}

export class InspectionPagination {
  constructor(private http?: HttpClient) {
  }

  InspectionGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string,appid?:number): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getinspection';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

