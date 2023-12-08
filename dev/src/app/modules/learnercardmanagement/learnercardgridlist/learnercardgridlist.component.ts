import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort,Sort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { Router, ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { environment } from '@env/environment';
import { LearnerCardService } from '@app/services/learnerCard.service';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { E } from '@angular/cdk/keycodes';
export interface LearnercardDetails {
  lcd_verificationno: any;
  sld_ROPlicense: any;
  sir_idnumber: any;
  sir_name_ar: any;
  sir_name_en: any;
  cat_count: any;
  pm_projectname_ar: any;
  pm_projectname_en: any;
  scm_coursename_ar: any;
  scm_coursename_en: any;
  exp_count: any;
  lcd_createdon: any;
  lcd_standardcoursemst_fk: any;
  lcd_staffinforepo_fk: any;
}

const FILTERDATA = { 
  verficationno: '',
  roplicenseno: '', 
  idnumber: '',
  name: '', 
  course: [],
  category: [], 
  date: '',
  };


@Component({
  selector: 'app-learnercardgridlist',
  templateUrl: './learnercardgridlist.component.html',
  styleUrls: ['./learnercardgridlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class LearnercardgridlistComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  public fullPageLoaders: boolean = false;
  tblplaceholder = false;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  page: number = 10;
  filterdata : { verficationno: any; roplicenseno: any; idnumber: any; name: any; course: any[]; category: any[]; date: any; };
  index = 0;
  dataSource : MatTableDataSource<LearnercardDetails>;
  project;
  standcourse;
  stktype;
  isfocalpoint;
  useraccess;
  createaccess = false;
  viewacess = false;
  updateaccess = false;
  downloadaccess = false;
  start = true;
  refresh = false;

  
  // displayedColumns = ['owner', 'vreg_num', 'chassnumb', 'vType', 'rType', 'inspectorname', 'inspectionDate','application','insStatus','perStatus', 'Dateofexp', 'action'];
  displayedColumns = ['lcd_verificationno', 'sld_ROPlicense' , 'sir_idnumber' ,'sir_name_en', 'pm_projectname_en', 'scm_coursename_en', 'cat_count', 'exp_count', 'lcd_createdon',  'action'];
  constructor( private fb: FormBuilder,
    public router: Router,
    private formBuilder: FormBuilder, 
    private el: ElementRef, 
    private translate: TranslateService, 
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private appservice: ApplicationService,
    private assessmentService: AssessmentReportService, 
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService, 
    protected security: Encrypt, 
    private learnercardsevice : LearnerCardService) {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
     }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
    today = new Date();

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
    @ViewChild(MatSort) sort: MatSort;
    public ifarbic: boolean = false;
    learnercarddata_data;
    learnercard_length;
    

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
     
       }else{
        this.filtername = "إخفاء التصفية";
       
       }
       
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
     
    }
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.filtername = "Hide Filter";
        ;
         }else{
          this.filtername = "إخفاء التصفية";
       
         }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }
    });
    //this.getlearnercard(this.page, this.index, this.filterdata);
    this.clearFilter();
    this.tblplaceholder = false;
    this.getstandardcourse();
    if(this.isfocalpoint == 1 && this.stktype == 1){
      this.createaccess = true;
      this.viewacess = true;
      this.updateaccess = true;
      this.downloadaccess = true;
    };
    console.log('this.isfocalpoint', this.isfocalpoint);
    console.log('this.stktype', this.stktype);
    console.log('this.useraccess', this.useraccess);
    //let moduleid = this.useraccess.filter(item => item.modules == "Learner Card Log");
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Learner Card Log');
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][18] && this.useraccess[moduleid][18].create == 'Y'){
      this.createaccess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][18] && this.useraccess[moduleid][18].read == 'Y'){
      this.viewacess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][18] && this.useraccess[moduleid][18].update == 'Y'){
      this.updateaccess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][18] && this.useraccess[moduleid][18].download == 'Y'){
      this.downloadaccess = true;
    }

    if (!this.viewacess) {
      swal({
        title: "You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if (this.stktype == 1) {
            this.router.navigate(['dashboard/portaladmin']);
          }
          else {
            this.router.navigate(['dashboard/centre']);
          }
        }

      });

    }
  }

  
  verificateno = new FormControl('');
  license_no = new FormControl('');
  civil_number = new FormControl('');
  lear_name = new FormControl('');
  cate_filter = new FormControl('');
  no_categories = new FormControl('');
  expiries = new FormControl('');
  lastUpdated = new FormControl('');
  course_type = new FormControl('');


  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.show');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('table.hide');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  clearFilter(){
    if(this.paginator){
      this.paginator.pageIndex = 0;
      this.paginator.pageSize = 10;
    }
    this.start = true;
    this.refresh = true;
    this.verificateno.reset();
    this.license_no.reset();
    this.civil_number.reset();
    this.lear_name.reset();
    this.cate_filter.reset();
    this.no_categories.reset();
    this.expiries.reset();
    this.lastUpdated.reset();
    this.course_type.reset();
    this.filterdata = { 
      verficationno: '',
      roplicenseno: '', 
      idnumber: '',
      name: '', 
      course: [],
      category: [], 
      date: '',
    };      
    this.dataSource = new MatTableDataSource<LearnercardDetails>([]);
    this.tblplaceholder = false;
    
    this.learnercard_length = 0;
      //this.getlearnercard(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
      
    }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    console.log(1);
    this.getlearnercard(this.paginator.pageSize, this.paginator.pageIndex, this.filterdata)
  }

  registerNow() {
    this.router.navigate(['/learnercardmanagement/learnercardreg/add/1/']);
  }

  edit(staffid, courseid) {
    this.router.navigate(['/learnercardmanagement/learnercardreg/edit/2/'+staffid+'/'+courseid]);
  } 

  view(staffid, courseid) {
    this.router.navigate(['/learnercardmanagement/learnercardreg/view/3/'+staffid+'/'+courseid]);
  }

  getlearnercard(limit, index, searchkey){
    console.log("getlearnercard", searchkey);
    if(searchkey.category.length > 0 || searchkey.course.length > 0 || searchkey.date.length > 0 || searchkey.date?.start || searchkey.idnumber != '' || searchkey.name != '' || searchkey.roplicenseno != '' || searchkey.verficationno != '' ){
      this.tblplaceholder = true;
      this.learnercardsevice.getlearnercard(limit, index, searchkey).subscribe(res=>{
        this.tblplaceholder = false;
        this.start = false;
        this.refresh = false;
        this.learnercarddata_data = res.data.learnerscards;
        this.dataSource = new MatTableDataSource<LearnercardDetails>(this.learnercarddata_data);
        this.dataSource.sort = this.sort;
        this.learnercard_length = res.data.totalcount;  
      })

    }else{
      this.clearFilter();
    }
  }

  serachdate(event, formcontrolname) {
    var expirydate;
    if (event.startDate) {
      expirydate = {
        start: moment(event.startDate._d).format('YYYY-MM-DD'),
        end: moment(event.endDate._d).format('YYYY-MM-DD')
      };
      this.refresh = false;
    }
    else
    {
      expirydate  = [];
    }
    console.log('expirydate', expirydate);
    console.log('refresh', this.refresh);
    if(!this.refresh){
      this.searchbatchgrid(expirydate, formcontrolname);
    }
  }

  searchbatchgrid(searckkey, formcontrolname) {
    console.log(2);
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    if(formcontrolname == 'verficationno' ||  formcontrolname == 'roplicenseno' || formcontrolname == 'idnumber' || formcontrolname == 'name'){
      if(searckkey.length >= 3 || searckkey.length==0){
        console.log(21);
        this.getlearnercard(this.page, this.index, this.filterdata)
      }
    }else{
      console.log(22);
        this.getlearnercard(this.page, this.index, this.filterdata)
    }
  }

  preparedata(data) {

    let filterdata;
    if(!this.filterdata)
    {
      filterdata = FILTERDATA;
    }
    else{
      filterdata = this.filterdata;
    }
    
   
    Object.keys(filterdata).forEach(keys => {
      if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searckkey'];
      }
    });

    return filterdata;
  }

  getstandardcourse(){
    this.fullPageLoaders = true;
    this.learnercardsevice.getstandardcourse().subscribe(res=>{
      this.fullPageLoaders = false;
      this.project = res.data.project;
      this.standcourse = res.data.standcourse;
    })
  }

  serachTrainingTimePract(event, formcontrolname) {
    if (event) {

      var trainigtime = moment(event.value).format('YYYY-MM-DD');
      this.searchbatchgrid(trainigtime, formcontrolname);
    }
  }



  opendialogprintsetup(id) {
      this.assessmentService.printcard('11',id).subscribe(data => {
        let pdfUrl = data.data.data;
        window.open(pdfUrl, '_blank');
      },error=>{
        swal({
          title: error.statusText,
          icon: 'warning',
          buttons: [false, 'OK'],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        })
      });
  }

  viewcard(id) {
    this.assessmentService.viewcard(id).subscribe(data => {
      let pdfUrl = data.data.data;
      window.open(pdfUrl, '_blank');
    },error=>{
      swal({
        title: error.statusText,
        icon: 'warning',
        buttons: [false, 'OK'],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      })
    });
   
  }

  seperatedata(data, type){
    if(data){
      if(type == 'print'){
        let aa = data.split(',');
        return aa[0] ? true : false;
      }
      if(type == 'view'){
        let aa = data.split(',');
        return aa[1] ? true : false;
      }
      if(type == 'learnerid'){
        let aa = data.split(',');
        return aa[2];
      }
      if(type == 'date'){
        let aa = data.split(',');
        return aa[3];
      }
    } else{
      return null;
    }
  }
}
