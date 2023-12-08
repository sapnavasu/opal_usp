import { Component,ElementRef, OnInit, ViewEncapsulation, ViewChild} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import {MatTableDataSource} from '@angular/material/table';
import {MatPaginator, PageEvent} from '@angular/material/paginator';
import { DatePipe } from '@angular/common';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import moment from 'moment';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { MatSort } from '@angular/material/sort';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ApplicationService } from '@app/services/application.service';
import {map} from 'rxjs/operators/map'
import {catchError} from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import {of as observableOf} from 'rxjs/observable/of';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { Location } from '@angular/common';
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

export interface Schedule {
  staffname: string;
  availdate: string;
  status: string;
  action: string;
}

const SCHEDULE_DATA: Schedule[] = [
  {staffname: 'Ghadeer Ali Hilali Jahir Hussain', availdate: '10-02-2023', status: 'available', action:''},
  {staffname: 'Marwan Al-Alawai', availdate: '20-02-2023', status: 'booked', action:''},
  {staffname: 'Khalid Al Hadi', availdate: '21-02-2023', status: 'notavailable', action:''},
  {staffname: 'Kalim Azar', availdate: '22-02-2023', status: 'booked', action:''},
  {staffname: 'Mohammed Basheer', availdate: '20-02-2023', status: 'available', action:''},
  {staffname: 'Marwan Al-Alawai', availdate: '21-02-2023', status: 'notavailable', action:''},
  {staffname: 'Khalid Al Hadi', availdate: '12-02-2023', status: 'available', action:''},
  {staffname: 'Kalim Azar', availdate: '22-02-2023', status: 'booked', action:''},
  {staffname: 'Ghadeer Ali Hilali', availdate: '12-02-2023', status: 'notavailable', action:''},
  {staffname: 'Marwan Al-Alawai', availdate: '21-02-2023', status: 'booked', action:''}
];

@Component({
  selector: 'app-schedulesiteaudit',
  templateUrl: './schedulesiteaudit.component.html',
  styleUrls: ['./schedulesiteaudit.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [DatePipe,
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class SchedulesiteauditComponent implements OnInit {
  staffArray: any;
  projectid: any;
 
  i18n(key) {
    return this.translate.instant(key);
  }
  disableSubmitButton: boolean;

  staffsearch = new FormControl('');
  availdatesearch = new FormControl('');
  statussearch = new FormControl('');
  filterValues = {
    staffname: '',
    availdate: '',
    status: ''
  };
  public tblplaceholder: boolean = false;
  public scheduleData: MatTableDataSource<any>;
  scheduleForm: FormGroup;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  resultsLength = 0;
  page: number = 10;
  PageEvent:any;
  selected2 = moment();
  noData: any = '';
  GridDatas: SchedulePagination;
  displayedColumns = ['asd_opalusermst_fk', 'asd_date', 'asd_isavailable', 'action'];
  scheduledataSource = new MatTableDataSource<Schedule>(SCHEDULE_DATA);
  asd_opalusermst_fk: any;
  asd_date: any;
  asd_isavailable: any;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild(MatPaginator) paginator: MatPaginator;

  constructor(private formBuilder: FormBuilder,public datepipe: DatePipe,protected router: Router,private translate: TranslateService,
    private remoteService: RemoteService,private _location:Location,
    private cookieService: CookieService,  public toastr: ToastrService, private el: ElementRef,private http: HttpClient,private route: Router,public routeid: ActivatedRoute ,private security: Encrypt , private appservice : ApplicationService) { 
    this.scheduledataSource.filterPredicate = this.createFilter();
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
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  ngOnInit(): void {
    this.initializeForm();

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
          this.filtername = "Hide Filter";
     
        }
        else {
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

    this.asd_opalusermst_fk = new FormControl('');
    this.asd_date = new FormControl('');
    this.asd_isavailable = new FormControl('');


    this.asd_opalusermst_fk.valueChanges.debounceTime(400).subscribe(
     
  
      register => {  
    
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.fetchScheduledate();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchScheduledate();   
        }    
      }
    )
    this.asd_date.valueChanges.debounceTime(400).subscribe(
     
  
      register => {  
    
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.fetchScheduledate();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchScheduledate();   
        }    
      }
    )
    this.asd_isavailable.valueChanges.debounceTime(400).subscribe(
      register => {  
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.fetchScheduledate();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.fetchScheduledate();   
        }    
      }
    )

    this.routeid.queryParams.subscribe(params => {
      this.projectid = params['id'];
    });
    this.disableSubmitButton = false;
  }
  ngAfterViewInit() {
    //this.scheduledataSource.paginator = this.paginator;
    this.fetchScheduledate();
  }

  fetchScheduledate() {
    this.tblplaceholder = true;
    this.GridDatas = new SchedulePagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};

    let datestringstart = null;
    let datestringend = null;

    let datestring = {
      'startDate' : null,
      'endDate' : null,
    };
    if(this.asd_date.value.startDate && this.asd_date.value.endDate )
    {
      datestringstart = moment(this.asd_date.value.startDate).format('DD-MM-YYYY').toString();
      datestringend = moment(this.asd_date.value.endDate).format('DD-MM-YYYY').toString();
      datestring = {
        'startDate' : datestringstart,
        'endDate' : datestringend
      };
    }
    

   

 gridsearchvalue = {asd_opalusermst_fk:this.asd_opalusermst_fk.value,asd_date:datestring,asd_isavailable:this.asd_isavailable.value};
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
         
          return this.GridDatas.staffGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue) ,this.projectid);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          this.staffArray =  data['data'].data.staffdata;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.scheduleData = new MatTableDataSource<any>(data);
        this.scheduleData.filterPredicate = this.createFilter();
        this.noData = this.scheduleData.connect().pipe(map(data => data.length === 0));
        datestringstart = null;
        datestringend = null;
        datestring = {
        'startDate' : null,
        'endDate' : null
      }
        this.tblplaceholder = false;
       });
      
  }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      let searchTerms = JSON.parse(filter);
             return data.asd_opalusermst_fk.toLowerCase().indexOf(searchTerms.asd_opalusermst_fk) !== -1 &&
             data.asd_date.toLowerCase().indexOf(searchTerms.asd_date) !== -1 &&
             data.asd_isavailable.toLowerCase().indexOf(searchTerms.asd_isavailable) !== -1  ;
             
            
    }
  return filterFunction;    
  }

  savestaff(){

    if(this.scheduleForm.controls['availabledate'].value.startDate == null || this.scheduleForm.controls['availabledate'].value.endDate == null){
      this.scheduleForm.controls['availabledate'].setErrors({required:true});
       }
    
    if(this.scheduleForm.controls['availabledate'].value.startDate == null || this.scheduleForm.controls['availabledate'].value.endDate == null){
   this.scheduleForm.controls['availabledate'].setErrors({required:true});
    }
    
    
    this.scheduleForm.controls['startString'].setValue(moment(this.scheduleForm.controls['availabledate'].value.startDate).format('YYYY-MM-DD').toString());
    this.scheduleForm.controls['endString'].setValue(moment(this.scheduleForm.controls['availabledate'].value.endDate).format('YYYY-MM-DD').toString());
    console.log(this.scheduleForm.value);
    if(this.scheduleForm.valid){
      this.disableSubmitButton = true;
      this.appservice.savescheduledate(this.scheduleForm.value , this.projectid).subscribe(data => {
        this.disableSubmitButton = false;
        if(data.data.status =='1'){
          
          swal({
          title: this.i18n('company.addsucc'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
          }).then(() => {
            this.fetchScheduledate(); 
           setTimeout(() => {
            $(".clear").trigger("click");
            this.scheduleForm.reset();
            this.scheduleForm.get('startString').reset();
            this.scheduleForm.get('endString').reset();
           }, 500);
          }); 
     
        }
        else
        {
          swal({
            title: this.i18n('This Auditor has already been scheduled for the selected date. Please choose a different date.'),
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
            }).then(() => {
              this.fetchScheduledate(); 
              setTimeout(() => {
                $(".clear").trigger("click");
                this.scheduleForm.reset();
                this.scheduleForm.get('startString').reset();
                this.scheduleForm.get('endString').reset();
               }, 500);
            });
        }
                
      });
    }else{
      this.focusInvalidInput(this.scheduleForm);
      console.log(this.scheduleForm.value);
    }
  }

  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        console.log(key);
        if (invalidControl)
        {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  
  initializeForm() {
    this.scheduleForm = this.formBuilder.group({
      staffname: ['', Validators.required],
      availabledate: ['', Validators.required],
      startString: ['', Validators.required],
      endString: ['', Validators.required],
    });

  }
  get schform() { 
    return this.scheduleForm.controls;
  }
  resetschform() {
    setTimeout(() => {
      $(".clear").trigger("click");
      this.scheduleForm.reset();
      this.scheduleForm.get('startString').reset();
      this.scheduleForm.get('endString').reset();
     }, 500);
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchScheduledate(); 
  }
  routeTochangestaff(id){
    this.route.navigate(['centrecertification/changestaff'] ,{ queryParams: { id: id }});
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

  changestatus(id , status){
    this.disableSubmitButton = true;
    this.appservice.changestatus(id,status).subscribe(data => {
      this.disableSubmitButton = false;
      if(data.data.status=='1'){
        swal({
          title: this.i18n('company.updatsucc'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
          }).then(() => {
            this.fetchScheduledate(); 
          }); 
      }
    });
  }
  goBack() {
    this._location.back();
  }
  clearFilterthird() {
    this.asd_opalusermst_fk.reset()
    this.asd_date.reset()
    this.asd_isavailable.reset()
  }
}
export class SchedulePagination {
  constructor(private http?: HttpClient) {
  }

  staffGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string,projectid?:string): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getstaffschedule';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&projectid=${projectid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
