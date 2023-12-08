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
import {MatSortModule} from '@angular/material/sort';
import { MatCheckboxChange } from '@angular/material/checkbox';
import { Location, DatePipe  } from '@angular/common';
import { MatRadioChange } from '@angular/material/radio';
import { LearnerCardService } from '@app/services/learnerCard.service';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import { LearnerService } from '@app/services/learner.service';
import { Observable } from 'rxjs';
import { startWith, map, debounceTime, tap, switchMap, finalize, distinctUntilChanged, filter } from 'rxjs/operators';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

export interface Element {
  lcd_subcategoryname: any;
  lcd_isprinted: any;
  lcd_cardexpiry: any;
  bmd_Batchno: any;
  omrm_tpname_en: any;
}
const FILTERDATA = { 
  subcourse: [],
  isprint: [], 
  expirydate: [],
  batchno: '',
  centre: '',
  };

@Component({
  selector: 'app-learnercardreg',
  templateUrl: './learnercardreg.component.html',
  styleUrls: ['./learnercardreg.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class LearnercardregComponent implements OnInit {

  natioanl_search;
  subcate_search;
  traning_search;
  selectedDate: any;
  refname: any;
  requiredfield: boolean = true;
  selectedradio: number;
  showsubcate: boolean = false;
  addshowbtn: boolean = false;
  param: any;
  ifarabic: boolean;
  popcontent: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  public fullPageLoaders: boolean = false;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  public cardregistrationform: FormGroup;
  public logostatus: boolean = true;
  maxDate = new Date();
   public editOption: boolean = true;
   availabelDate:  FormGroup;
  page: number = 10;
  TrainingDate = ['bmd_Batchno','omrm_tpname_en','lcd_subcategoryname', 'lcd_isprinted', 'lcd_cardexpiry', 'action'];
  dataSource :MatTableDataSource<Element>;
  public viewpoint: boolean= true;
  learnerdata;
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
    public updated: boolean = false;
    drv_logo: DriveInput;
    ageShow:boolean = true;
    deleteicon: boolean = true;
    viewform: boolean = true;
    croplic: DriveInput;
    worktilled: boolean = true;
    public notallowed: boolean = false;
    public viewpage: boolean = false;
    public editpage: boolean = false;
    public addpage: boolean = false;
    public showlicense: boolean = false;
    staffid;
    courseid;
    pipe = new DatePipe('en-US'); // Use your own locale
    @ViewChild('logo') logo: Filee;
  @ViewChild('cividoc') cividoc: Filee;
  trainingData;
  index = 0;
  filterdata : { subcourse: any[]; isprint: any[]; expirydate: any[]; batchno: any; centre: any; }
  datalength = 0;
  tblplaceholder = false;
  subcategory;
  get form()  { return this.cardregistrationform.controls; } 
   get forme()  { return this.availabelDate.controls; } 
   isCheckboxDisabled: boolean = false;
  cleardate: boolean = false;
  cate_filter = new FormControl('');
  addeddate = new FormControl('');
  expirydate = new FormControl('');
  batchno = new FormControl('');
  centre = new FormControl('');
  public allowadd: boolean = false;
  nationality;
  cardupdatedetails:any[] = [];
  carddetailsdata:any[];
  public requiredshow: boolean = true;
  batchlist = [];
  tranincenterlist=[];
  batchControl = new FormControl();
  filteredOptions: Observable<any[]>;
  filteredbatch: any;
  isLoading = false;
  errorMsg!: string;
  minLengthTerm = 3;
  selectedbatch: any = "";
  courselist =[];
  newcard = [];
  stktype;
  isfocalpoint;
  useraccess;
  createaccess = false;
  viewacess = false;
  updateaccess = false;
  downloadaccess = false;
  viewbatchaccess = false;
 public uploadfiles = false;
  constructor( private fb: FormBuilder,
    public routeid: ActivatedRoute,
    public router: Router,
    private _location:Location,
    private formBuilder: FormBuilder, 
    private el: ElementRef, 
    private translate: TranslateService, 
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private appservice: ApplicationService,
    private localstorage: AppLocalStorageServices,
    private toastr: ToastrService, 
    protected security: Encrypt,
    private service : LearnerCardService,
    private assessmentService: AssessmentReportService,
    private learnerService : LearnerService) { 
      this.stktype = this.localstorage.getInLocal('stktype');
      this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
      this.useraccess = this.localstorage.getInLocal('uerpermission');
    }
    

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
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.filtername = "Hide Filter";
          this.ifarabic = false;
        ;
         }else{
          this.filtername = "إخفاء التصفية";
          this.ifarabic = true;
       
         }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
          this.ifarabic = false;
      }
      // if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      //   this.ifarbic = true
      // }
      // else {
      //   this.ifarbic = false;
      // }
      
    });

    if(this.isfocalpoint == 1 && this.stktype == 1){
      this.createaccess = true;
      this.viewacess = true;
      this.updateaccess = true;
      this.downloadaccess = true;
      this.viewbatchaccess = true;
    };
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
    //let batchmoduleid = this.useraccess.filter(item => item.modules == "Batch Management");
    let batchmoduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[batchmoduleid]?.read == 'Y'){
      this.viewbatchaccess = true;
    }



    this.croplic = {
      fileMstPk: 13,
      selectedFilesPk: []
    }
    this.learnregistrationform()
    this.drv_logo = {
      fileMstPk: 17,
      selectedFilesPk: []
    };
    this.maxDate.setFullYear(new Date().getFullYear() - 18);
        this.getnationality();
        //this.getbatchnumber();
        this.gettraningcenter();
        this.refname = this.routeid.snapshot.paramMap.get('id');
        if(this.refname == 2) {
        this.staffid = this.routeid.snapshot.paramMap.get('staffid');
        this.courseid = this.routeid.snapshot.paramMap.get('courseid');
        this.getintialdata();
        this.carddetails(this.staffid, this.courseid, this.page, this.index, this.filterdata);
        this.viewpage = false;
        this.editpage = true;
        this.addpage = false;
        this.cardregistrationform.controls['date_birth'].enable();
        this.cardregistrationform.controls['category'].setValidators(null);
      this.cardregistrationform.controls['category'].updateValueAndValidity();


      }else if (this.refname == 3) {
        this.staffid = this.routeid.snapshot.paramMap.get('staffid');
        this.courseid = this.routeid.snapshot.paramMap.get('courseid');
        this.getintialdata();
        this.carddetails(this.staffid, this.courseid, this.page, this.index, this.filterdata);
        this.cardregistrationform.disable();
        this.availabelDate.disable();
        this.viewpoint = false;
        this.deleteicon = false;
        this.viewpage = true;
        this.editpage = false;
        this.addpage = false;
        this.requiredfield = false;
        this.cardregistrationform.controls['category'].setValidators(null);
      this.cardregistrationform.controls['category'].updateValueAndValidity();
      }else if (this.refname == 1) {
        this.viewpage = false;
        this.editpage = false;
        this.addpage = true;
        this.selectedradio = 2;
      }
      this.getcourse();
      this.filteredOptions = this.availabelDate.controls['batch'].valueChanges.pipe(
        startWith(''),
        map(value => this.filterBatch(value))
      );

      // this.availabelDate.controls['batch'].valueChanges
      // .pipe(
      //   filter(res => {
      //     return res !== null && res.length >= this.minLengthTerm
      //   }),
      //   distinctUntilChanged(),
      //   debounceTime(1000),
      //   tap(() => {
      //     this.errorMsg = "";
      //     this.filteredbatch = [];
      //     this.isLoading = true;
      //   }),
      //   switchMap(value => this.remoteService.get('lc/learnercard/getbatchnumber?batchno='+this.selectedbatch+'&courseid='+this.courseid).map(res => res.json())
      //     .pipe(
      //       finalize(() => {
      //         this.isLoading = false
      //       }),
      //     )
      //   )
      // )
      // .subscribe((data: any) => {
      //   if (data.data == null) {
      //     this.errorMsg = 'No data avaliable';
      //     this.filteredbatch = [];
      //   } else {
      //     this.errorMsg = "";
      //     this.filteredbatch = data.data;
      //   }
      //   console.log('filteredbatch',this.filteredbatch);
      // });

      
  }

  getcourse(){
    this.service.getstandardcourse().subscribe(res=>{
      this.courselist = res.data.standcourse;

    })
  }

  onSelected() {
    console.log(this.selectedbatch);
    this.selectedbatch = this.selectedbatch;
  }

  displayWith(value: any) {
    return value?.bmd_Batchno;
  }

  clearSelection() {
    this.availabelDate.controls['batch'].reset();
    this.selectedbatch = "";
    this.filteredbatch = [];
  }

  getintialdata(){
    this.fullPageLoaders = true;
    this.service.getsinglelearnercard(this.staffid, this.courseid).subscribe(res=>{
     this.fullPageLoaders = false;

      console.log(res);
      this.learnerdata = res.data;
      let data = res.data;
      this.getsubcourse(data.standardcoursemst_pk);
      let age;
      console.log('this.learnerdata.sir_nationality', this.learnerdata.sir_nationality)
    if (data.sir_dob) {
      var timeDiff = Math.abs(Date.now() - new Date(data.sir_dob).getTime());
      age = Math.floor(timeDiff / (1000 * 3600 * 24) / 365.25);
      }
     console.log('data.sld_ROPlicense', data.sld_ROPlicense);
      this.selectedradio = data.sld_ROPlicense ? 1 : 2;
      this.showlicense = data.sld_ROPlicense? true : false;
      console.log('selectedradio', this.selectedradio);

      //this.drv_logo.selectedFilesPk = (data.sir_photo !== null) ? data.sir_photo.split(',') : null;
        //setTimeout(() => this.logo?.triggerChange(), 500);
        if(data.sir_photo) {
          this.drv_logo.selectedFilesPk = [data.sir_photo]
        }else {
          this.drv_logo.selectedFilesPk = []
        }
        this.croplic.selectedFilesPk = (data.sld_ROPlicenseupload !== null) ? data.sld_ROPlicenseupload.split(',') : null;
        if(this.croplic.selectedFilesPk){
          setTimeout(() => this.cividoc?.triggerChange(), 500);
        }
        this.staffid = this.learnerdata.staffinforepo_pk;
      this.cardregistrationform = this.formBuilder.group({
        uploaded: [data.sir_photo,''],
        crNumber: [data.sir_idnumber,Validators.required],
        learname: [data.sir_name_en, Validators.required],
        learnamearabic: [data.sir_name_ar, Validators.required],
        date_birth: [data.sir_dob, Validators.required],
        age: [age,''],
        gender:[data.sir_gender, Validators.required],
        national: [data.sir_nationality, Validators.required],
        selectValues: [data.sld_ROPlicense? 1 : 2, Validators.required],
        ropnumber: [data.sld_ROPlicense, ''],
        roplicen_se: [data.sld_ROPlicenseupload, ''],
        verifiednumber: [data.lcd_verificationno],
        coursetype: [data.pm_projectname_en],
        category: [data.scm_coursename_en],
        last_date: [{value: this.pipe.transform(data.lastissued, 'yyyy-MM-dd'), disabled: true}],
     })
    //  if(this.cardregistrationform.controls.selectValues.value != 1) {
    //   this.addpage = true;
    //  }
     
    })
  }

  carddetails(staffid, courseid, limit, index, filterdata){
    this.tblplaceholder = true;
    this.service.carddetails(staffid, courseid, limit, index, filterdata).subscribe(res=>{
      this.tblplaceholder = false;
      this.carddetailsdata = res.data.cards;
      this.dataSource = new MatTableDataSource<Element>(res.data.cards);
      this.dataSource.sort = this.sort;
      this.datalength = res.data.totalcount;
    })
  }

  getsubcourse(courseid){
    this.courseid = courseid;
    this.service.getsubcategories(courseid).subscribe(res=>{
      console.log(res);
      this.subcategory = res.data;
    })
  }

  getnationality(){
    this.service.getnationality().subscribe(res=>{
      console.log('tt',res);
      
      this.nationality = res.data;
    })
  }

  getbatchnumber(){
    if(this.selectedbatch.length >= 3){
      this.service.getbatchnumber(this.selectedbatch,this.courseid).subscribe(res=>{
      console.log('tt',res);
      
      this.batchlist = res.data;

        if (res.data == null) {
          this.errorMsg = 'No data avaliable';
          this.filteredbatch = [];
        } else {
          this.errorMsg = "";
          this.filteredbatch = res.data;
        }
    })

    }
  }

  gettraningcenter(batchid=null){
    let data = batchid ? batchid.batchmgmtdtls_pk : batchid
    this.service.gettrainingcenter(data).subscribe(res=>{
      console.log('tt',res);
      
      this.tranincenterlist = res.data;
    })
  }

  searchbatchgrid(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    console.log('search', data)
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.carddetails(this.staffid ,this.courseid, this.page, this.index, this.filterdata)
    
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

  serachdate(event, formcontrolname) {
    var expirydate;
    if (event.startDate) {
      expirydate = {
        start: moment(event.startDate._d).format('YYYY-MM-DD'),
        end: moment(event.endDate._d).format('YYYY-MM-DD')
      };
    }
    else
    {
      expirydate  = [];
    }
      
      this.searchbatchgrid(expirydate, formcontrolname);
    

  }

  deleteLogo(event: any) {
  
    swal({
      title: this.i18n('Do you want to delete this image?'),
      // text: 'You can still recover the file from the JSRS drive.',
      icon: "warning",
      buttons: [this.i18n('Cancel'), this.i18n('OK')],
      dangerMode: true,
      // className: "swal-delete",
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willGoBack) => {
      if (willGoBack) { 
        this.appservice.saveLogo([]).subscribe(data => {
          if (data.data.status == 1) {
            this.drv_logo.selectedFilesPk = [];
            this.logo?.triggerChange();
            setTimeout(() => {
             
              this.toastr.success(this.i18n('Deleted Successfully.'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
            }, 1000);
          }
        })
      }
      
    })
  }

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    //this.comanydetialsform.controls[fileId].setValue(file.toString());
    //this.awaredForm.controls['file_award'].setValue(file);
    //this.upload_name = fileId.selectedFilesPk[0];
    //this.upload_mohr = fileId.selectedFilesPk;
    
   }
   
  fileeSelecteddouble(file, fileId) {
    console.log('file', file)
    console.log('fileId', fileId)
    fileId.selectedFilesPk = file;
  }

  learnregistrationform() {
    this.cardregistrationform = this.formBuilder.group({
      uploaded: ['',''],
      crNumber: ['',Validators.required],
      learname: ['', Validators.required],
      learnamearabic: ['', Validators.required],
      date_birth: ['', Validators.required],
      age: ['',''],
      gender:['', Validators.required],
      national: ['', Validators.required],
      selectValues: ['2', Validators.required],
      ropnumber: ['', ''],
      roplicen_se: ['', ''],
      verifiednumber: [''],
      coursetype: [''],
      category: [''],
      last_date: [''],
   }),
   this.availabelDate= this.formBuilder.group({
    batch: [''],
    training: [''],
    subcate: ['',Validators.required],
    mentioned: ['', Validators.required],
    workdate: [''],
    noexipry: [''],
    id: [''],

   })
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.dataSource.sort = this.sort;
    this.carddetails(this.staffid, this.courseid, this.paginator.pageSize, this.paginator.pageIndex, this.filterdata);
  }

  clear() {
    if(this.availabelDate.touched) {
      if(this.allowadd == true) {
          this.popcontent = this.i18n('Do you want cancel this Add?')
      }else {
        this.popcontent = this.i18n('Do you want cancel this Update?')

      }
      swal({
        title: this.i18n('The data entered will not be saved or retained.'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('No'), this.i18n('Yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.availabelDate.reset();
          this.gettraningcenter();
          this.showsubcate = false;
        }
      });
    }else {
      this.availabelDate.reset();
      this.showsubcate = false;
      // this._location.back();
      // this.ageShow= true;
    }
  }

  clearreg(){
    if(this.viewpage){
      this.router.navigate(['/learnercardmanagement/learnergridlist']);
    }else if(this.editpage){

      if(this.cardregistrationform.touched || this.availabelDate.touched) {
        swal({
          title: this.i18n('Do you want to Cancel editing the Information of this Learner?'),
          text: this.i18n('If yes, any unsaved data will be lost.'),
          icon: 'warning',
          buttons: [this.i18n('No'), this.i18n('Yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.cardregistrationform.reset();
            // this._location.back();
            this.ageShow= true;
            this.router.navigate(['/learnercardmanagement/learnergridlist']);
          }
        });
      }else {
      this.cardregistrationform.reset();
      // this._location.back();
      // this.showsubcate = false;
      this.ageShow= true;
      this.router.navigate(['/learnercardmanagement/learnergridlist']);
      }
    }else {
      if(this.cardregistrationform.touched || this.availabelDate.touched) {
        swal({
          title: this.i18n('Do you want to Cancel Adding the Information of this Learner?'),
          text: this.i18n('If yes, any unsaved data will be lost.'),
          icon: 'warning',
          buttons: [this.i18n('No'), this.i18n('Yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.cardregistrationform.reset();
            // this._location.back();
            this.ageShow= true;
            this.router.navigate(['/learnercardmanagement/learnergridlist']);
          }
        });
      }else {
      this.cardregistrationform.reset();
      // this._location.back();
      // this.showsubcate = false;
      this.ageShow= true;
      this.router.navigate(['/learnercardmanagement/learnergridlist']);
      }
    }
  }

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

  reset() {
    this.availabelDate.reset();
    this.selectedDate = null;

  }

  onCheckboxChange(event: MatCheckboxChange) {
    if (event.checked) {
     this.notallowed = true;
     this.availabelDate.controls['workdate'].reset();
     this.worktilled = false;
     this.availabelDate.controls['workdate'].setValidators(null);
    } else {
      this.notallowed = false;
      this.availabelDate.controls['workdate'].setValidators(Validators.required);
      this.worktilled = true;
      this.availabelDate.controls['noexipry'].setValidators(null);

    }
  }

  dateSelected(event: MatDatepickerInputEvent<Date>) {
    const selectedDate: Date = event.value;
    if (selectedDate) {
     this.isCheckboxDisabled = true;
     this.cleardate = true;
     this.worktilled = true;
    }
  }

  clearData() {
   this.availabelDate.controls.workdate.reset();
   this.isCheckboxDisabled = false;
   this.cleardate = false;
  }

  clearFiltersecound(){
    this.cate_filter.reset()
    this.addeddate.reset()
    this.expirydate.reset()
    this.batchno.reset()
    this.centre.reset()
    this.paginator.pageIndex = 0;
    this.paginator.pageSize = 10;
    this.filterdata = { 
      subcourse: [],
      isprint: [], 
      expirydate: [],
      batchno: '',
      centre: '',
      };
    this.carddetails(this.staffid, this.courseid, this.paginator.pageSize, this.paginator.pageIndex, this.filterdata);
  }

  onOptionChange(event: MatRadioChange) {
    if(event.value == '1' ) {
      this.cardregistrationform.controls['ropnumber'].setValidators([Validators.required]);
      this.cardregistrationform.controls['ropnumber'].updateValueAndValidity();
      this.croplic.selectedFilesPk = [];
      this.cividoc?.triggerChange()
      this.cardregistrationform.controls['roplicen_se'].setValidators([Validators.required]);
      this.cardregistrationform.controls['roplicen_se'].updateValueAndValidity();
      this.showlicense = true;
      this.scrollTo('pagescroll');
    } else {
      this.cardregistrationform.controls['ropnumber'].reset()
       this.croplic.selectedFilesPk = [];
       this.cividoc?.triggerChange()
      this.cardregistrationform.controls['roplicen_se'].setValidators(null);
      this.cardregistrationform.controls['roplicen_se'].setValue([]);
      this.cardregistrationform.controls['roplicen_se'].updateValueAndValidity();
      this.cardregistrationform.controls['ropnumber'].setValidators(null);
      this.cardregistrationform.controls['ropnumber'].updateValueAndValidity();
      this.showlicense = false;
    }
  }

  editsubcate(data) {
    console.log(data);
    this.showsubcate = true;
    this.addshowbtn = true;
    this.allowadd = false;
    let id = this.tranincenterlist.filter(item => item.omrm_tpname_en == data.omrm_tpname_en);

    console.log('ddd',id)
     this.availabelDate = this.formBuilder.group({
      batch: [data.bmd_Batchno],
      training: [id.length != 0 ? id[0].opalmemberregmst_pk : null],
      subcate: [data.lcd_subcategoryname,Validators.required],
      mentioned: [data.lcd_isprinted, Validators.required],
      workdate: [data.lcd_cardexpiry],
      noexipry:[data.lcd_cardexpiry ? false : true],
      id: [data.learnercarddtls_pk],
     })
     this.worktilled = data.lcd_cardexpiry ? true : false;
     if(!data.lcd_cardexpiry) {
      this.notallowed = true;
      this.availabelDate.controls.workdate.reset();
      this.worktilled = false;
      this.availabelDate.controls['workdate'].setErrors(null);
      this.isCheckboxDisabled = false;
      this.cleardate = false;
      this.worktilled = false;
     } else {
       this.notallowed = false;
       this.availabelDate.controls['workdate'].setErrors({'incorrect': true });
       this.worktilled = true;
       this.isCheckboxDisabled = true;
       this.cleardate = true;
       this.worktilled = true;
     }
     console.log("rr", this.availabelDate.value)
  }

  clickToadd() {
    this.showsubcate = true;
    this.addshowbtn = false;
    this.allowadd = true;
    this.availabelDate.reset()
    this.notallowed = false;
    this.isCheckboxDisabled = false;
    this.cleardate = false;
    this.scrollTo('pagescrollform');
    this.clearSelection()
    this.availabelDate.controls['noexipry'].setValidators(null);
    this.availabelDate.controls['noexipry'].reset();
    this.worktilled = true;
  }

  viewbatch(id){
    this.router.navigate(['/batchindex/batchviewpage/'+id]);
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
      console.log(pdfUrl)
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

  checkCivilNum(cno){
    let civilnum: any = this.cardregistrationform.controls['crNumber'].value;
    if(this.refname == 1){
      this.service.getstaffdata(civilnum).subscribe(res=>{
        console.log(res);
        if(res.data){
          let data = res.data;
          this.staffid = data.staffinforepo_pk;
          let age;
          if (data.sir_dob) {
            var timeDiff = Math.abs(Date.now() - new Date(data.sir_dob).getTime());
            age = Math.floor(timeDiff / (1000 * 3600 * 24) / 365.25);
          }
          this.selectedradio = 2
          this.selectedradio = data.sld_ROPlicense ? 1 : 2;
          this.showlicense = data.sld_ROPlicense? true : false;

          this.drv_logo.selectedFilesPk = (data.sir_photo !== null) ? data.sir_photo.split(',') : null;
          if(this.drv_logo.selectedFilesPk){
            setTimeout(() => this.logo?.triggerChange(), 500);
          }
          this.croplic.selectedFilesPk = (data.sld_ROPlicenseupload !== null) ? data.sld_ROPlicenseupload.split(',') : null;
          if(this.croplic.selectedFilesPk){
            setTimeout(() => this.cividoc?.triggerChange(), 500);
          }
          this.cardregistrationform = this.formBuilder.group({
            uploaded: [data.sir_photo,''],
            crNumber: [data.sir_idnumber,Validators.required],
            learname: [data.sir_name_en, Validators.required],
            learnamearabic: [data.sir_name_ar, Validators.required],
            date_birth: [data.sir_dob, Validators.required],
            age: [age,''],
            gender:[data.sir_gender, Validators.required],
            national: [data.sir_nationality, Validators.required],
            selectValues: [data.sld_ROPlicense ? 1 : 2, Validators.required],
            ropnumber: [data.sld_ROPlicense, ''],
            roplicen_se: [data.sld_ROPlicenseupload, ''],
            verifiednumber: [''],
            coursetype: [''],
            category: ['', Validators.required],
            last_date: [''],
         })
        }else{
          
         // this.cardregistrationform.reset();
         this.resetform();
       setTimeout(() => {
        this.selectedradio = 2;
       }, 100);
          this.showlicense = false;
          this.staffid = null;
        }
      })
    }else{
      // console.log(civilnum);
      // this.service.existcivilnumber(civilnum).subscribe(res=>{
      //   if(res.data.data){
      //     console.log('exist')
      //     swal({
      //       title: this.i18n('This Civil Number already exists.'),
      //       text: " ",
      //       icon: 'warning',
      //       buttons: [false, this.i18n('uploadfile.ok')],
      //       dangerMode: true,
      //       className: this.dir =='ltr'?'swalEng':'swalAr',
      //       closeOnClickOutside: false
      //     })
      //     // this.cardregistrationform.controls['crNumber'].setValue('');
      //   }else{
      //     console.log('not exist')
      //   }
      // })
    }
  }

  resetform(){

    this.cardregistrationform.controls['uploaded'].reset();
    this.drv_logo.selectedFilesPk = [];
    this.cardregistrationform.controls['learname'].reset();
    this.cardregistrationform.controls['learnamearabic'].reset();
    this.cardregistrationform.controls['date_birth'].reset();
    this.cardregistrationform.controls['age'].reset();
    this.cardregistrationform.controls['gender'].reset();
    this.cardregistrationform.controls['national'].reset();
    this.cardregistrationform.controls['selectValues'].reset();
    this.cardregistrationform.controls['ropnumber'].reset();
    this.cardregistrationform.controls['roplicen_se'].reset();
    this.cardregistrationform.controls['verifiednumber'].reset();
    this.cardregistrationform.controls['coursetype'].reset();
    this.cardregistrationform.controls['category'].reset();
    this.cardregistrationform.controls['last_date'].reset();
      this.drv_logo.selectedFilesPk = [];
      this.logo?.triggerChange();
  }

  updatedata() {
    const learnerdata  = this.cardregistrationform.value;
      let cc =this.courselist.filter(item => item.scm_coursename_en == 'Defensive driving')
      if(!learnerdata.uploaded || learnerdata.uploaded?.length == 0){
        swal({
          title: this.i18n("Please upload the Profile image of the Learner."),
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          closeOnClickOutside: false
        }).then(() => {})
      }else if((learnerdata.category == cc[0].standardcoursemst_pk || learnerdata.category == cc[0].scm_coursename_en) && !learnerdata.ropnumber){
          swal({
            title: this.i18n("Enter the ROP Licence Number."),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(() => {})
       }else if(this.availabelDate.valid) {
        this.fullPageLoaders = true;
        console.log('this.availabelDate.value',this.availabelDate.value);
        let data = this.availabelDate.value;
        data.profileimg = learnerdata.uploaded;
        data.ropnumber = learnerdata.ropnumber;
        data.roplicen_se = learnerdata.roplicen_se;
        data.workdate = data.workdate ? moment(data.workdate).format('YYYY-MM-DD').toString() : null;
        console.log('data', data);
        this.service.editcard(data).subscribe(res=>{
          console.log('edit',res);
          this.availabelDate.reset();
          this.showsubcate = false;
          this.getintialdata();
          this.carddetails(this.staffid, this.courseid, this.page, this.index, this.filterdata);
          this.toastr.success(this.i18n('The Sub-Categories has been updated and the card is  re-generated successfully.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.fullPageLoaders = false;
          
        })
    }else {
     this.focusInvalidInput(this.availabelDate);
    }
  }

  savedata() {

    if(this.editpage){
      const learnerdata  = this.cardregistrationform.value;
      let cc =this.courselist.filter(item => item.scm_coursename_en == 'Defensive driving')
      if(!learnerdata.uploaded || learnerdata.uploaded?.length == 0){
        swal({
          title: this.i18n("Please upload the Profile image of the Learner."),
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          closeOnClickOutside: false
        }).then(() => {})
      }else if((learnerdata.category == cc[0].standardcoursemst_pk || learnerdata.category == cc[0].scm_coursename_en) && !learnerdata.ropnumber){
          swal({
            title: this.i18n("Enter the ROP Licence Number."),
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(() => {})
       }else if(this.availabelDate.valid) {
        this.fullPageLoaders = true;
        let data = this.availabelDate.value;
        data.staffid= this.staffid;
        data.batchno = data.batch ? data.batch.bmd_Batchno ? data.batch.bmd_Batchno : this.selectedbatch : this.selectedbatch;
        data.workdate =data.workdate ?  moment(data.workdate).format('YYYY-MM-DD').toString() : null;
        data.profileimg = learnerdata.uploaded;
        data.ropnumber = learnerdata.ropnumber;
        data.roplicen_se = learnerdata.roplicen_se;
        this.service.addsubcategory(data).subscribe(res=>{
          this.availabelDate.reset();
          this.showsubcate = false;
          this.getintialdata();
          this.carddetails(this.staffid, this.courseid, this.page, this.index, this.filterdata);
          this.toastr.success(this.i18n('The Sub-categories has been added and the card is generated successfully.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.fullPageLoaders = false;
          this.showsubcate = false;
        this.gettraningcenter();
        this.availabelDate.reset();
        })
        if(this.availabelDate.get('noexipry').value == 1) {
          this.availabelDate.controls['noexipry'].setErrors(null);
          this.notallowed = true;
          this.availabelDate.controls.workdate.reset();
          this.worktilled = false;
          this.availabelDate.controls['workdate'].setErrors(null);
        } else {
          if(!this.availabelDate.controls['workdate'].valid){
          this.notallowed = false;
          this.availabelDate.controls['workdate'].setErrors({'incorrect': true });
          this.worktilled = true;
          }
          this.availabelDate.controls['noexipry'].setErrors(null);
        }
      }
      else {
      this.focusInvalidInput(this.availabelDate);
      }
    }else{
    console.log(324324322222222);
      if(this.availabelDate.valid) {
        this.hidefilder = false;
        const id = document.getElementById('searchrow') as HTMLElement;
        id.style.display = 'none';
        let data = this.availabelDate.value;
        data.batchno = data.batch ? data.batch.bmd_Batchno ? data.batch.bmd_Batchno : this.selectedbatch : this.selectedbatch;
        console.log('data.workdate', data.workdate);
        data.workdate = data.workdate ?  moment(data.workdate).format('YYYY-MM-DD').toString() : null;
        data.staffid = this.staffid;
        this.newcard.push(data);
        console.log('newcard',this.newcard);
        let subcate = this.subcategory.filter(item => item.standardcoursedtls_pk == data.subcate);
        let traning = this.tranincenterlist.filter(item => item.opalmemberregmst_pk == data.training);
        let cdata = {
          lcd_subcategoryname : subcate[0].ccm_catname_en,
          lcd_isprinted : data.mentioned,
          lcd_cardexpiry : data.workdate ?  data.workdate : null,
          bmd_Batchno : data.batch?.bmd_Batchno,
          omrm_tpname_en : traning[0]?.omrm_tpname_en,
        }
        console.log('cdata', cdata)
        this.carddetailsdata.push(cdata)
        this.dataSource = new MatTableDataSource<Element>(this.carddetailsdata);
        this.datalength = this.carddetailsdata.length;
        console.log('this.cardupdatedetails', this.cardupdatedetails);
        this.showsubcate = false;
        this.gettraningcenter();
        this.availabelDate.reset();
        
        if(this.availabelDate.get('noexipry').value == 1) {
          this.availabelDate.controls['noexipry'].setErrors(null);
          this.notallowed = true;
          this.availabelDate.controls.workdate.reset();
          this.worktilled = false;
          this.availabelDate.controls['workdate'].setErrors(null);
        } else {
          if(!this.availabelDate.controls['workdate'].valid){
          this.notallowed = false;
          this.availabelDate.controls['workdate'].setErrors({'incorrect': true });
          this.worktilled = true;
          }
          this.availabelDate.controls['noexipry'].setErrors(null);
          
        }
      }else {
      this.focusInvalidInput(this.availabelDate);
      }
    }

     
  }

  savereg() {
    console.log('this.cardregistrationform.valid', this.cardregistrationform.valid)
    console.log('this.cardregistrationform', this.cardregistrationform)
    // this.onOptionChange();
    if(this.cardregistrationform.valid) {
      let data  = this.cardregistrationform.value;
      data.batchno = this.selectedbatch;
      data.date_birth = moment(data.date_birth).format('YYYY-MM-DD').toString();
      if(!data.uploaded || data.uploaded?.length == 0){
        swal({
          title: this.i18n("Please upload the Profile image of the Learner."),
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          closeOnClickOutside: false
        }).then(() => {})
          
  
      }else{
        let cc =this.courselist.filter(item => item.scm_coursename_en == 'Defensive driving')
        if(data.category == cc[0].standardcoursemst_pk || data.category == cc[0].scm_coursename_en){
          if(data.ropnumber){
            data.staffid = this.staffid;;
            data.courseid = this.learnerdata?.standardcoursemst_pk
            data.newcard = this.newcard;
              console.log(data);
              if(this.editpage){
                this.fullPageLoaders = true
                this.service.saveandgeneratercard(data).subscribe(res=>{
                  console.log("res", res);
                  this.fullPageLoaders = false;
                  setTimeout(() => {
                    
                    this.toastr.success(this.i18n('The Learner Information has been updated and the card is re-generated successfully.'), ''), {
                      timeOut: 2000,
                      closeButton: false,
                    };
                  }, 1000);
                  this.router.navigate(['/learnercardmanagement/learnergridlist']);
                })
              }else if(this.addpage && this.staffid){
                if(this.newcard.length == 0){
                  swal({
                    title: this.i18n("Sub category is mandatory"),
                    text: " ",
                    icon: 'warning',
                    buttons: [false, this.i18n('uploadfile.ok')],
                    dangerMode: true,
                    closeOnClickOutside: false
                  }).then(() => {})
                }else{
                  this.fullPageLoaders = true
                  console.log('submitdata',data);
                  this.service.addLearnerwithnewcatergory(data).subscribe(res=>{
                    console.log(res);
                    console.log("res", res);
                    this.fullPageLoaders = false
                    setTimeout(() => {
                       
                      this.toastr.success(this.i18n('The Learner Information has been added and the card is generated successfully.'), ''), {
                        timeOut: 2000,
                        closeButton: false,
                      };
                    }, 1000);
                    this.router.navigate(['/learnercardmanagement/learnergridlist']);
                  })
                }
              }else{
                if(this.newcard.length == 0){
                  swal({
                    title:this.i18n( "Sub category is mandatory"),
                    text: " ",
                    icon: 'warning',
                    buttons: [false, this.i18n('uploadfile.ok')],
                    dangerMode: true,
                    closeOnClickOutside: false
                  }).then(() => {})
                }else{
                  this.fullPageLoaders = true
                  console.log('submitdata',data);
                  this.service.addstaff(data).subscribe(res=>{
                    console.log(res);
                    console.log("res", res);
                    this.fullPageLoaders = false
                    setTimeout(() => {
                       
                      this.toastr.success(this.i18n('The Learner Information has been added and the card is generated successfully.'), ''), {
                        timeOut: 2000,
                        closeButton: false,
                      };
                    }, 1000);
                    this.router.navigate(['/learnercardmanagement/learnergridlist']);
                  })
                }
              }
          }else{
            swal({
              title: this.i18n("Enter the ROP Licence Number."),
              text: " ",
              icon: 'warning',
              buttons: [false, this.i18n('uploadfile.ok')],
              dangerMode: true,
              closeOnClickOutside: false
            }).then(() => {})
          }

        }else{

          data.staffid = this.staffid;;
          data.courseid = this.learnerdata?.standardcoursemst_pk
          data.newcard = this.newcard;
          console.log(data);
          if(this.editpage){
            this.fullPageLoaders = true
            this.service.saveandgeneratercard(data).subscribe(res=>{
              console.log("res", res);
              this.fullPageLoaders = false
              setTimeout(() => {
                 
                this.toastr.success(this.i18n('The Learner Information has been updated and the card is re-generated successfully.'), ''), {
                  timeOut: 2000,
                  closeButton: false,
                };
              }, 1000);
              this.router.navigate(['/learnercardmanagement/learnergridlist']);
            })
          }else if(this.addpage && this.staffid){
            if(this.newcard.length == 0){
              swal({
                title: this.i18n("Sub category is mandatory"),
                text: " ",
                icon: 'warning',
                buttons: [false, this.i18n('uploadfile.ok')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(() => {})
            }else{
              this.fullPageLoaders = true
              console.log('submitdata',data);
              this.service.addLearnerwithnewcatergory(data).subscribe(res=>{
                console.log(res);
                console.log("res", res);
                this.fullPageLoaders = false
                setTimeout(() => {
                  this.toastr.success(this.i18n('The Learner Information has been added and the card is generated successfully.'), ''), {
                    timeOut: 2000,
                    closeButton: false,
                  };
                }, 1000);
                this.router.navigate(['/learnercardmanagement/learnergridlist']);
              })
            }
          }else{
            if(this.newcard.length == 0){
              swal({
                title: this.i18n("Sub category is mandatory"),
                text: " ",
                icon: 'success',
                buttons: [false, this.i18n('uploadfile.ok')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(() => {})
            }else{
              this.fullPageLoaders = true
                console.log('submitdata',data);
                this.service.addstaff(data).subscribe(res=>{
                  console.log(res);
                  console.log("res", res);
                  this.fullPageLoaders = false
                  setTimeout(() => {
                    this.toastr.success(this.i18n('The Learner Information has been added and the card is generated successfully.'), ''), {
                      timeOut: 2000,
                      closeButton: false,
                    };
                  }, 1000);
                  this.router.navigate(['/learnercardmanagement/learnergridlist']);
                })
            }
          }
        }

      }
     }else {
      this.focusInvalidInput(this.cardregistrationform)
      this.uploadfiles = true;
    //  setTimeout(() => {
    //   Object.values(this.form.controls).forEach(control => {
    //     control.markAsTouched();
    //   });
    //  }, 1000);
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

  alreadyexistcategory(categoryid){
    console.log('categoryid', categoryid);
    if(this.learnerdata?.staffinforepo_pk){
      this.service.alreadyexistsubcategorycard(this.learnerdata.staffinforepo_pk,categoryid).subscribe(res=>{
        if(res.data){
          this.availabelDate.controls['subcate'].setValue('');
          swal({
            title: this.i18n("The selected Sub-Category has already been added. Please select a different sub-category."),
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(() => {})
        }else{
          let batch = this.availabelDate.controls['batch'].value;
          if(batch){
            let batchno = batch ? batch.bmd_Batchno ? batch.bmd_Batchno : this.selectedbatch : this.selectedbatch;
            console.log('batchno', batchno);
            this.service.alreadybatchnoexist(batchno, categoryid).subscribe(res=>{
              console.log(res);
              if(res.data.flag == 'F'){
                this.availabelDate.controls['subcate'].setValue('');
                swal({
                  title: this.i18n("The provided batch number has already been added with a different category. Please enter a new batch number."),
                  text: " ",
                  icon: 'success',
                  buttons: [false, this.i18n('uploadfile.ok')],
                  dangerMode: true,
                  closeOnClickOutside: false
                }).then(() => {})
              }
            })
          }
        }

      })

    }else if(this.staffid != null){
      this.service.alreadyexistsubcategorycard(this.staffid,categoryid).subscribe(res=>{
        if(res.data){
          this.availabelDate.controls['subcate'].setValue('');
          swal({
            title: this.i18n("The selected Sub-Category has already been added. Please select a different sub-category."),
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(() => {})
        }else{
          let batch = this.availabelDate.controls['batch'].value;
          if(batch){
            let batchno = batch ? batch.bmd_Batchno ? batch.bmd_Batchno : this.selectedbatch : this.selectedbatch;
            console.log('batchno', batchno);
            this.service.alreadybatchnoexist(batchno, categoryid).subscribe(res=>{
              console.log(res);
              if(res.data.flag == 'F'){
                this.availabelDate.controls['subcate'].setValue('');
                swal({
                  title: this.i18n("The provided batch number has already been added with a different category. Please enter a new batch number."),
                  text: " ",
                  icon: 'success',
                  buttons: [false, this.i18n('uploadfile.ok')],
                  dangerMode: true,
                  closeOnClickOutside: false
                }).then(() => {})
              }
            })
          }
        }

      })
    } else{
      console.log('this.newcard', this.newcard);
      let subcate = this.newcard.filter(item => item.subcate == categoryid);
      console.log("subcate.length", subcate.length);
      if(subcate.length > 0){
        console.log(3423423)
        this.availabelDate.controls['subcate'].setValue('');
        swal({
          title: this.i18n("The selected Sub-Category has already been added. Please select a different sub-category."),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          closeOnClickOutside: false
        }).then(() => {})
      }else{
        let batch = this.availabelDate.controls['batch'].value;
        if(batch){
          let batchno = batch ? batch.bmd_Batchno ? batch.bmd_Batchno : this.selectedbatch : this.selectedbatch;
          console.log('batchno', batchno);
          this.service.alreadybatchnoexist(batchno, categoryid).subscribe(res=>{
            console.log(res);
            if(res.data.flag == 'F'){
              this.availabelDate.controls['subcate'].setValue('');
              swal({
                title: this.i18n("The provided batch number has already been added with a different category. Please enter a new batch number."),
                text: " ",
                icon: 'success',
                buttons: [false, this.i18n('uploadfile.ok')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(() => {})
            }
          })

        }
      }
      console.log(subcate);
    }
  }

  calculateage(value){
    var timeDiff = Math.abs(Date.now() - new Date(value).getTime());
    var age = Math.floor(timeDiff / (1000 * 3600 * 24) / 365.25);
    this.cardregistrationform.controls['age'].setValue(age);
  }

  filterBatch(value: string): any[] {
    const filterValue = value.toLowerCase();
    return this.batchlist.filter(option => option.bmd_Batchno.toLowerCase().includes(filterValue));
  }

  getcarddetails(data){
    console.log(data);
    if(this.staffid && data){
      console.log('based category')
      this.carddetails(this.staffid,data, this.page, this.index, this.filterdata);
    }
    this.getsubcourse(data);
  }

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      // console.log(123)
    } catch (error) {
      console.log('page-content')
    }
  }

  onMenuButtonClick(event: Event) {
    const button = event.target as HTMLButtonElement;
    const isMenuButton = button.classList.contains('menubutton');
  
    if (isMenuButton) {
      event.stopPropagation();
    }
    event.stopPropagation();

  }

  deactivatecard(cardid){

      swal({
        title: this.i18n('Do you want to Deactivate the Learner Card?'),
        icon: 'warning',
        buttons: [this.i18n('No'),this.i18n('Yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        console.log(willGoBack);
        if (willGoBack) {
      this.fullPageLoaders = true
      this.service.deactivecard(cardid).subscribe(res=>{
        this.fullPageLoaders = false;
        this.carddetails(this.staffid,this.courseid, this.page, this.index, this.filterdata);
        setTimeout(() => {
          this.toastr.success(this.i18n('The Learner Card has been Deactivated.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }, 1000);
      })
        }
    })
  }
}
