import { SelectionModel } from '@angular/cdk/collections';
import { Component, OnInit, ViewChild, ViewEncapsulation, QueryList, Input } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator , PageEvent} from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Router, ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { MatSort } from '@angular/material/sort';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import { Encrypt } from '@app/common/class/encrypt';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import {of as observableOf} from 'rxjs/observable/of';
import { MatCheckbox } from '@angular/material/checkbox';
import { ApplicationService } from '@app/services/application.service';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
export interface Courserecorddata {
  coursetitle: any;
  courseduration:any;
  courselevel:any;
  coursecategory:any;
  coursetested:any;
  status:any;
  addedon:any;
  lastupdated:any;
}

// const courserecord_data: Courserecorddata[] = [
//   { coursetitle: 'Workshop or Laboratory Projects',courseduration:"1 Years",courselevel:"Level 1",coursecategory:"Fire and Safety",coursetested:"Fire and Safety",status:"A",addedon:"24-01-2023",lastupdated:"24-01-2023"},
//   { coursetitle: 'Workshop or Laboratory Projects',courseduration:"1 Years",courselevel:"Level 1",coursecategory:"Fire and Safety",coursetested:"Fire and Safety",status:"D",addedon:"24-01-2023",lastupdated:"24-01-2023"},
//   { coursetitle: 'Workshop or Laboratory Projects',courseduration:"1 Years",courselevel:"Level 1",coursecategory:"Fire and Safety",coursetested:"Fire and Safety",status:"A",addedon:"24-01-2023",lastupdated:"24-01-2023"},
//   { coursetitle: 'Workshop or Laboratory Projects',courseduration:"1 Years",courselevel:"Level 1",coursecategory:"Fire and Safety",coursetested:"Fire and Safety",status:"N",addedon:"24-01-2023",lastupdated:"24-01-2023"},
//   { coursetitle: 'Workshop or Laboratory Projects',courseduration:"2 Years",courselevel:"Level 1",coursecategory:"Fire and Safety",coursetested:"Fire and Safety",status:"U",addedon:"24-01-2023",lastupdated:"24-01-2023"}

// ];

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
  selector: 'app-coursetabdetail',
  templateUrl: './coursetabdetail.component.html',
  styleUrls: ['./coursetabdetail.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({ height: '*', display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
],
})
export class CoursetabdetailComponent implements OnInit {
  documentname = new FormControl('');
  GridDatas: CoursePagination;
  page: number = 10;
  ifarabic: boolean;
  appoct_status: any;
  levelarray: any;
  leveltested: any;
  coursecategory: any;
  type: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  documentprovided = new FormControl('');
  status = new FormControl('');
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild("dataChkBox") dataChkBox: QueryList<any>;
  @ViewChild("ChkBox") ChkBox: MatCheckbox;
  @Input() isValidated: boolean = false;

  expandedElement: boolean = false;

    // course
    @ViewChild('showChkbox') showChkbox: MatCheckbox;
    public selectAllCourse: boolean = false;
   // table course start
   courseListData = [
    { courseColumn: "checkbox", filtsearch: "row-first", label: "CheckBox", HideVisible: true, disoperate: true },
    { courseColumn: "appoct_coursename_en", filtsearch: "row-second", label: "course.courtitle", HideVisible: true, disoperate: true },
    { courseColumn: "appoct_courseduration", filtsearch: "row-three", label: "course.courdura", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_courselevel", filtsearch: "row-four", label: "course.courlevel", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_coursecategorymst_fk", filtsearch: "row-five", label: "course.courcate", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_coursetested", filtsearch: "row-six", label: "course.courtest", HideVisible: false, disoperate: true },
    { courseColumn: "appoct_status", filtsearch: "row-seven", label: "course.stat", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_createdon", filtsearch: "row-eight", label: "course.addon", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_updatedon", filtsearch: "row-nine", label: "course.lastupdat", HideVisible: false, disoperate: false },
    { courseColumn: "action", filtsearch: "row-ten", label: "course.Action", HideVisible: true, disoperate: true },
  ];
  // displayed column
  getcourseListData(): string[] {
    return this.courseListData.filter(course_list => course_list.HideVisible).map(course_list => course_list.courseColumn);
  }
  // displayed search
  getcourseListDatasearch(): string[] {
    return this.courseListData.filter(course_list => course_list.HideVisible).map(course_list => course_list.filtsearch);
  }
  // column edit function
  selectAllcourseListDataFun(event: any) {
    this.selectAllCourse = event.checked;
    this.courseListData.forEach(item => {
      item.HideVisible = this.selectAllCourse;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllcourseListData(item: any) {
    const courseChecked = this.courseListData.every(item => item.HideVisible);
    if (courseChecked) {
      this.showChkbox.checked = true;
    } else {
      this.showChkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // table course end
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  resultsLength: number;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  course = 'coursedetails'
  apptempPk: any;
  appoct_coursename_en: any;
  appoct_courseduration: any;
  appoct_courselevel: any;
  appoct_coursecategorymst_fk: any;
  appoct_coursetested: any;
  appoct_createdon: any;
  appoct_updatedon: any;
  appoct_foundationprog:any;
  public CourseListData: MatTableDataSource<any>;
  public arr = [];
  dataforcheckbox: any[];
  overallstatus: any;
  coursemst_pk = 3;
  coursetest_pk = 8;
  public appstatus = [];
  disableSubmitButton: boolean;
  noData: any = '';
  tblplaceholder: boolean = false;
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
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private route: Router,private http: HttpClient,public routeid: ActivatedRoute,private security: Encrypt, private appservice : ApplicationService
  ) { 

    this.onValidation = this.onValidation.bind(this);
  }

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




    this.appoct_coursename_en = new FormControl('');
    this.appoct_courseduration = new FormControl('');
    this.appoct_courselevel = new FormControl('');
    this.appoct_coursecategorymst_fk = new FormControl('');
    this.appoct_coursetested = new FormControl('');
    this.appoct_createdon = new FormControl('');
    this.appoct_updatedon = new FormControl('');
    this.appoct_status = new FormControl('');


      this.appoct_coursename_en.valueChanges.debounceTime(400).subscribe(
        register => {  
          if (register != null ) {
            this.paginator.pageIndex = 0;
            this.fetchCourceData();   
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchCourceData();   
          }    
        }
      )
      this.appoct_courseduration.valueChanges.debounceTime(400).subscribe(
      
        register => {  
          this.paginator.pageIndex = 0;      
          this.fetchCourceData();   
        }
      )
    
      this.appoct_courselevel.valueChanges.debounceTime(400).subscribe(
      
        register => {  
    
          if (register != null) {
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }    
        }
      )
      this.appoct_coursecategorymst_fk.valueChanges.debounceTime(400).subscribe(
      
        register => {  
  
          if (register != null) {
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }    
        }
      )
      this.appoct_coursetested.valueChanges.debounceTime(400).subscribe(
      
        register => {
         
          if (register != null) {
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }    
        }
      )

      this.appoct_createdon.valueChanges.debounceTime(400).subscribe(
      
        register => {
         
          if (register != null) {
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }    
        }
      )
      this.appoct_status.valueChanges.debounceTime(400).subscribe(
      
        register => {
         
          if (register != null) {
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }    
        }
      )
      this.appoct_updatedon.valueChanges.debounceTime(400).subscribe(
      
        register => {
         
          if (register != null) {
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }else if(register == ''){
            this.paginator.pageIndex = 0;
            this.fetchCourceData();
          }    
        }
      )
       
      this.getCourseLevel();
  }

  ngAfterViewInit(){
    this.fetchCourceData();
   }

   getCourseLevel() {
      this.appservice.getreferancemst(this.coursemst_pk).subscribe(data => {
        this.levelarray = data.data.data;
      });
      this.appservice.getreferancemst(this.coursetest_pk).subscribe(data => {
        this.leveltested = data.data.data;
        
      });
    this.appservice.getcoursecategory().subscribe(data => {
        this.coursecategory = data.data.data;
      });
    
   }
    


   onValidation(form , resetForm){
    this.disableSubmitButton = true; 
    this.appservice.updateCourse(form.value,this.arr).subscribe(data => {
      this.disableSubmitButton = false; 
      if(data.data.msg == 'success'){
        swal({
          title: this.i18n('company.courvalidation'),
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
        this.fetchCourceData();
      }else{
        swal({
          title: data.data.comments,
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
        this.fetchCourceData();

      }
                            
    });

  

}
   fetchCourceData() {
    this.tblplaceholder = true;
    this.GridDatas = new CoursePagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};


   gridsearchvalue = {appoct_coursename_en:this.appoct_coursename_en.value,appoct_courseduration:this.appoct_courseduration.value,appoct_courselevel:this.appoct_courselevel.value,appoct_coursecategorymst_fk:this.appoct_coursecategorymst_fk.value,appoct_coursetested:this.appoct_coursetested.value, appoct_status:this.appoct_status.value,appoct_createdon:this.appoct_createdon.value,appoct_updatedon:this.appoct_updatedon.value};
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
         
          return this.GridDatas.courseGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue),this.apptempPk);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;;
          this.overallstatus  = data['data'].data.appstatus;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
      
        this.CourseListData = new MatTableDataSource<any>(data);
        this.CourseListData.filterPredicate = this.createFilter();
        this.dataforcheckbox= Object.keys(data || {}).map(function(index){
          let dataList = data[index];
          return dataList;
       });

       this.appstatus= Object.keys(data || {}).map(function(index){
        let dataList = data[index];
        let status = dataList.appoct_status;
        return status;
        });
        this.noData = this.CourseListData.connect().pipe(map(data => data.length === 0));
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

      syncPrimaryPaginator(event: PageEvent) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.page = event.pageSize;
         this.fetchCourceData();
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
  

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      console.log('page-content')
    } catch (error) {
      // console.log('page-content')
    }
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
  action(id , type) {
    //this.route.navigate(['/trainingcentremanagement/courseview']);
    this.disableSubmitButton = true;
    this.route.navigate(['trainingcentremanagement/courseviewtab/'+this.security.encrypt(id)+'/course/'+type]);
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 5000);
  }

  selectAllFun(data){
    if(data == true){
      this.dataforcheckbox.forEach((data, index) => {
        this.arr.push(data.appoffercoursetmp_pk);
      })
    }else{
  
      this.dataforcheckbox.forEach((data, index) => {
        const PrdIndex = this.arr.indexOf(data.MemCompProdDtls_Pk);
        this.arr.splice(PrdIndex, 1);
      })      
    }
  
  
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
    // this.expandedElement = false;
  }
  clearFilter() {
    this.appoct_coursename_en.setValue("");
    this.appoct_courseduration.setValue("");
    this.appoct_courselevel.setValue("");
    this.appoct_coursecategorymst_fk.setValue("");
    this.appoct_coursetested.setValue(""); 
    this.appoct_status.setValue("");
    this.appoct_createdon.setValue("");
    this.appoct_updatedon.setValue("");
  this.fetchCourceData();
  $(".clear").trigger("click");
  }
}


export class CoursePagination {
  constructor(private http?: HttpClient) {
  }

  courseGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string,appid?:number): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getcourse';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
