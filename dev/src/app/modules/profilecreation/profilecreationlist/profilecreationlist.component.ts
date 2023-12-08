import { Component, OnInit, Input, ViewChild, HostListener, Output, EventEmitter, ElementRef } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray, AbstractControl } from '@angular/forms';
import { CdkTextareaAutosize } from '@angular/cdk/text-field';
import { NgZone } from '@angular/core';
import { take } from 'rxjs/operators';
import * as moment from 'moment';
import swal from 'sweetalert'; 
import { ViewEncapsulation } from '@angular/core';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { Router, ActivatedRoute } from '@angular/router';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { FormControl } from '@angular/forms';
import { environment } from '@env/environment';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { MatDrawer } from '@angular/material/sidenav';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { atLeastOne } from '@app/common/directives/atleastone';
import { DriveService } from '@app/services/drive.service';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { StateService } from '@app/common/state/service/state.service';
import { CityService } from '@app/common/city/service/city.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ToastrService } from 'ngx-toastr'
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { RegistrationService } from '@app/modules/registration/registration.service';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { MatSort } from '@angular/material/sort';
import { AdddepartmentComponent } from '@app/@shared/adddepartment/adddepartment.component';
import { map } from 'rxjs/internal/operators/map';
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import { MatTableDataSource } from '@angular/material/table';
export interface Deptartment {
  value: string;
  viewValue: string;
}
export interface reportedto {
  value: string;
  viewValue: string;
}
export interface addsupervise {
  value: string;
  viewValue: string;
}
export interface designlevel {
  value: string;
  viewValue: string;
}
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
  selector: 'app-profilecreationlist',
  templateUrl: './profilecreationlist.component.html',
  styleUrls: ['./profilecreationlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class ProfilecreationlistComponent implements OnInit {
  public postParams: any;
  public postUrl: any;
  @Input() stkholdertype: any;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('refBunitDept') refBunitDept: AdddepartmentComponent;
  businessUnitDetails: BusinessUnitDetails;
  resultsLength: any;
  companypk: any;
  @Input() compid: any;
  public dataSource2 = new MatTableDataSource();
  businessUnitDataTemp: any;
  deptlist: any;
  spinnerButtonOptions: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  spinnerButtonOptionsmobile: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  focusmobile: any;
  i18n(key) {
    this.translate.get(key).subscribe({
      next: (text: string) => ('Text translated: ' + text)
    })
    return this.translate.instant(key);
  }
  division = new FormControl();
  department = new FormControl();

  toppingList: string[] = ['Ui Developer', 'PHP Developer', 'Design Lead', 'Tester', 'Product Management', 'Associate'];
  supervisorList = new FormControl();
  selectedsupervisor;
  landline_country_code_flag = 31;
  mobile_country_code_flag = 31;
  searchCountryFlag: string;
  tryFormGroup: any;
  country_code_flag: any;
  phonecode: any;
  maxDate = new Date();
  public searchCountry: string;
  mobnumverifybtn:boolean;
  defaultCountryPk: any;
  landlinecode = '+968';
  mobilecode = '+968'
  searchMobileCC: any;

  phonecodefax: any;
  country_code_flag_fax: any;
  Contentplaceloader: boolean = true;
  reportedto: any = [];
  addsupervise: any = [];
  Deptartment: any = [];
  countrylist: any = [];
  statelist: any[] = [];
  citylist: any[] = [];
  designlevel: any = [];
  businesssource: any = [];
  totalCount = 5;
  codeselect :boolean=true;
  certificatelists = [];
  certificatecnt: number;
  overallcertificatecnt: number;
  addressists: any = [];
  optionvalue:boolean=true;
  public initSpinner: boolean = false;
  public countDown: any = '00:00';
  public countDownMob: any = '00:00';
  disableResendemail: boolean = false;
  public showeditbtn: boolean = true;
  public disableupdatebutton: boolean = false;
  verfiy: boolean = false;
  public disableupdatebutton1: boolean = false;
  public showeditbtnmobile: boolean = true;
  verfiymobile: boolean = false;
  iseditdisable1: boolean = false;
  otpshowmobile: boolean = false;
  iferrorotp: boolean = false;
  iferrorotpmail: boolean = false;
  disableResendmob: boolean = false;
  divshow:boolean=true;
  divshowemail:boolean=false;
  verifyshowfield: boolean = false;
  emailview: boolean = false;
  otpviewfield: boolean = false;
  public formSubmitted = false;

  socialmedia = [
    { listtitle: "Skype", image: "skypeimage.png", },
    { listtitle: "Facebook", image: "Facebookweb.svg", },
    { listtitle: "Twitter", image: "Twitterweb.svg", },
    { listtitle: "Instagram", image: "Instagramweb.svg", },

  ];
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  panelOpenState: boolean = false;
  public disableloader: boolean = true;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  panel: number = 1;
  @Input() panelNo: number;
  @Input() masterdata: any;
  @Input() result: any;
  @Input() resultmsg: any;
  animationState6: string = 'out';
  public condition: string;
  @ViewChild('certificateFile') certificateFile: Filee;
  @ViewChild('relateddocument') relateddocument: Filee;
  @ViewChild('logo') logo: Filee;
  public drvInput: DriveInput;
  public relateddoc: DriveInput;
  basicinfoForm: FormGroup;
  corporateinfoForm: FormGroup;
  socialmediaForm: FormGroup;
  certificatelistForm: FormGroup;
  communicationinfoForm: FormGroup;
  samemobno:boolean =false
  animationState = 'out';
  @ViewChild('paginator') paginator: MatPaginator;
  public buttonname: string = this.i18n('profilecreationlist.add');
  public certid: any;
  public addressid: number;
  public previousval: number;
  public superarr: any;
  drv_companylogo: DriveInput;
  public managementperpage =
    BgiJsonconfigServices.bgiConfigData.configuration.accordionPerpage;
  public minimumPaginationValue =
    BgiJsonconfigServices.bgiConfigData.configuration.accordionPerpage;
  public paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration.accordionPaginationSet;
  @ViewChild('certificatesdrawer') certificatesdrawer: MatDrawer;
  @ViewChild('mappingdrawer') mappingdrawer: MatDrawer;
  @ViewChild('mobilefocus') mobilefocus: ElementRef;
  @ViewChild("addbusinessunitmcp") addbusinessunitmcp: MatDrawer;
  @ViewChild("drawerdepartment") drawerdepartment: MatDrawer;
  formBuilder: any;
  selected: any;
  warnUserBeforeLeavingPage = true;
  perpage = 3;
  public email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  page = 0;
  searchcertificatetitle: string = "";
  search: string = "";
  gdp: FormArray;
  textmsg: string;
  public timeremail;
  public timermobile;
  public user_pk;
  public usertype;
  deptDataTemp: any;
  mobsubmitbtn:boolean=true;
  verfiedtagshow: boolean = false;
  verfiedtagshowmobile: boolean = false;
  @Output() openDeptSideNav: any = new EventEmitter<any>();
  @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
    if (this.warnUserBeforeLeavingPage) {
      event.returnValue = false;
    }
  }
  pageEvent: PageEvent;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private el: ElementRef,
    private cookieService: CookieService, private encryptClass: Encrypt, private localStorage: AppLocalStorageServices, public driveService: DriveService, private fb: FormBuilder, private _ngZone: NgZone, private profileservice: ProfileService, private stateService: StateService, private cityService: CityService, private snackBar: MatSnackBar, public toastr: ToastrService,
    protected regService: RegistrationService,
    private EnterpriseService: EnterpriseService,
    private http: HttpClient,
    private encrypt: Encrypt, public router: Router) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  ngOnInit() {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    this.getCountryList();
    this.certid = '';
    this.mobile_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
    this.landline_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
    this.user_pk =  this.localStorage.getInLocal('userPk');
    this.usertype =  this.localStorage.getInLocal('usertype');
    
    // setTimeout(() => { this.Contentplaceloader = false }, 800);
    this.drv_companylogo = {
      fileMstPk: 95,
      selectedFilesPk: []
    }
    this.basicinfoForm = this.fb.group({
      middlename: ['', ''],
      firstname: ['', ''],
      lastname: ['', ''],
      employeeid: ['', Validators.required],
      dateofjoining: ['', Validators.required],
      division: ['', ''],
      department: ['', ''],
      designation: ['', Validators.required],
      reportingto: [''],
      supervisor: ['', ''],
      briefprofile: ['', ''],
      Roles: ['', ''],
      upload: ['', ''],
      gdp: this.fb.array([this.createGDP()])
    });
    this.certificatelistForm = this.fb.group({
      certificatetitle: ['', Validators.required],
      dateofissue: ['', Validators.required],
      relateddocument: [null, ''],
      certificateFileUpload: [null, Validators.required],
    });

    this.socialmediaForm = this.fb.group({
      facebook: ['', Validators.pattern(/(?:www\.)?facebook\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
      instagram: ['', Validators.pattern(/(?:www\.)?instagram\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
      twitter: ['', Validators.pattern(/(?:www\.)?twitter\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
      linkedin: ['', Validators.pattern(/(?:www\.)?linkedin\.com\/(\d+|[A-Za-z0-9\.]+)\/?/)],
      Skype: ['', Validators.pattern(/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)],
      Zoom: ['', Validators.pattern(/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)],
      GoogleMeet: ['', Validators.pattern(/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/)],
    }, { validators: atLeastOne(Validators.required) });
    this.communicationinfoForm = this.fb.group({
      code: ['', Validators.required],
      mobileno: ['', Validators.required],
      landlinecc: ['', ''],
      mobilecc: ['', ''],
      coumtrycode: ['', ''],
      landlineno: [''],
      extn: ['', Validators.maxLength(5)],
      mobileotp: ['', ''],
      emailotp: ['', ''],
      workemialid: ['', [Validators.required, Validators.pattern(this.email)]],
    });
    this.getCountryList();
    this.getReportedtoData();

    this.drvInput = {
      fileMstPk: 98,
      selectedFilesPk: [] //Already inserted pk
    };
    this.relateddoc = {
      fileMstPk: 99,
      selectedFilesPk: [] //Already inserted pk
    };
    this.getbusinessInput();
    this.getDivisionData();
    this.communicationinfoForm.controls['workemialid'].valueChanges.debounceTime(400).subscribe(data => {
      
      if (data && data != null && data.length != 0) {
       
        this.chkValidemailId(data);
        
      }
    });
  }

  divisionChange(value) {
    if (value) {
 
      let index = this.businesssource.findIndex(x => x.bunitPk == value[0]);
      if (index !== -1) {
        this.businessUnitDataTemp = this.businesssource[index].bunitName;
     
      }
      this.postParams = {
        'bUnitPk': value
      };
      this.postUrl = 'ea/department/fetch-department-by-bunit';
      this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(function (data) {
        if (data['data'].status == 100) {
          this.division = (value['data'] && value['data'].data && value['data'].data.businessUnit !== null) ? value['data'].data.businessUnit.split(",") : [];
          this.Deptartment = data['data'].data.bunitDeptData;
          this.valueChanged(null)
          this.contentinputloader = false;
        } else {
          this.contentinputloader = false;
        }
      }.bind(this)
      );
    } else {
      this.businessUnitDataTemp = '';
    }
  }
  chkValidemailId(dataValue) {
    let postData = {
      'email': dataValue,
      'usrid':this.user_pk,
      'stktype':this.stkholdertype
    }
   
  }
  checksamemailid() {
    let postData = {
      'email': this.communicationinfoForm.controls.workemialid.value,
      'usrid':this.user_pk,
      'stktype':this.stkholdertype
    }
    this.EnterpriseService.checksamemailid('ea/user/checksamemaild', postData).subscribe(response => {
      if (response?.success) {
        if (response?.data?.data) {
          
          this.communicationinfoForm.controls.workemialid.setErrors({ samemailid: true });
         
        } 
       
      }
    })
  }
  emailcheck(){
    if(this.f1.workemialid.valid){
      this.verfiy =true;
    }else{
      this.verfiy =false;
    }
  }
  getbusinessInput() {
    this.getSectorDtls(this.encrypt.encrypt(this.companypk));
  }

  openDeptSide() {
    this.refBunitDept.triggerdivisionlisit();
    this.openDeptSideNav.emit(true);
  }

  changesuppervisor(chkevent, index) {
    if (this.superarr.includes(chkevent.value)) {
      this.gdpControl[index].get('supervisor').reset();
      swal({
        title: this.i18n('profilecreationlist.thismembisalre'),
        icon: 'warning'
      });
    } else {
      this.superarr.push(chkevent.value);
    }
  }
  createGDP() {
    return this.fb.group({
      supervisor: [],
    })
  }
  get f1() { return this.communicationinfoForm.controls; }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

  valueChanged(value) {
    if (this.basicinfoForm.controls['department'].value) {
      let index = this.Deptartment.findIndex(x => x.deptPk == this.basicinfoForm.controls['department'].value[0]);
      if (index !== -1) {
      
        this.deptDataTemp = this.Deptartment[index].deptName;
      }
    }
  }
  onPaginateChange(event) {
    this.perpage = event.pageSize;
    this.page = parseInt(event.pageIndex) + 1;
    this.search = this.searchcertificatetitle;
    this.getcertification(this.page, this.perpage, this.search);
  }
  oncertififiltersubmit() {
    this.search = this.searchcertificatetitle;
    this.getcertification(this.page,this.perpage,this.search);
  }
  getcertification(page, perpage, search) {
    this.profileservice.getcertifcapagindata(page, perpage, search).subscribe((returndata) => {
      this.certificatelists = returndata.data['certificatedata'];
      this.certificatecnt = returndata.data['certificatecnt'];
      this.overallcertificatecnt = returndata.data['overallcertificatecnt'];
    });
  }
  addGDP() {
    this.gdp = this.basicinfoForm.get('gdp') as FormArray;
    this.gdp.push(this.createGDP());
  }

  removeGDP(index: number) {
    this.gdp = this.basicinfoForm.get('gdp') as FormArray;
    const indes: number = this.superarr.indexOf(this.gdp.value[index].supervisor);
    this.superarr.splice(indes, 1);
    setTimeout(() => {
      this.gdp.removeAt(index);
    }, 1000);
  }

  get gdpControl() {
    return (this.basicinfoForm.get('gdp') as FormArray).controls;
  }


  getCountryList() {
    this.profileservice.getcountrylist().subscribe(data => this.countrylist = data['data']);
  }
  getStateList(countrypk: number) {
    this.stateService.getstatebyid(countrypk).subscribe(data => {
      this.statelist = data['data'];
    })
  }
  getCityList(statepk: number) {
    this.cityService.getcitybystateid(statepk).subscribe(data => {
      this.citylist = data['data'];
    })
  }

  getReportedtoData() {
    this.profileservice.getReportedMaster().subscribe(returndata => {
      this.reportedto = returndata.data['data'];
      this.addsupervise = returndata.data['data'];
      this.deptlist = returndata.data['deptlist'];
      this.designlevel = returndata.data['degnlevel'];
      this.masterdata = returndata.data['mstdata'];
      this.certificatelists = returndata.data['certificatedata'];
      this.certificatecnt = returndata.data['certificatecnt'];
      this.overallcertificatecnt = returndata.data['overallcertificatecnt'];
      this.addressists = returndata.data['addressists'];
      if (this.masterdata.userdp.length > 0) {
        this.drv_companylogo.selectedFilesPk = this.masterdata.userdp;
        setTimeout(() => {
          this.logo.triggerChange();
          this.disableloader = false;
        }, 1000);
      } else {
        this.disableloader = false;
      }
      this.basicinfoForm.patchValue({
        'firstname': this.masterdata.name,
        'middlename': this.masterdata.midlename,
        'lastname': this.masterdata.lastname,
        'employeeid': this.masterdata.employeid,
        'dateofjoining': this.masterdata.doj,
        'designation': this.masterdata.designat,
        'designationlevel': this.masterdata.designatlevl,
        'reportingto': this.masterdata.reportto,
        'briefprofile': this.masterdata.breifprof,
        'Roles': this.masterdata.rolesresp,
        'division':(this.masterdata.division !== null) ? this.masterdata.division.split(",") : [],
        'department':(this.deptlist !== null)?this.deptlist.split(","):[],
      });
      this.divisionChange((this.masterdata.division !== null) ? this.masterdata.division.split(",") : [])
      this.superarr = this.masterdata.superv;
      let rows = this.basicinfoForm.get('gdp') as FormArray;
      while (rows.length !== 0) {
        rows.removeAt(0);
      }
      this.masterdata.superv.forEach(data => {
        rows.push(this.fb.group({
          supervisor: data,
        }))
      })

      this.socialmediaForm.patchValue({
        'facebook': this.masterdata.facebook,
        'instagram': this.masterdata.instragram,
        'twitter': this.masterdata.twitter,
        'linkedin': this.masterdata.linkedin,
        'Skype': this.masterdata.Skype,
        'Zoom': this.masterdata.Zoom,
        'GoogleMeet': this.masterdata.GoogleMeet,
      });
      this.mobilecode = this.masterdata.mobilecode;
      this.landlinecode = this.masterdata.landlinecode;
      if (this.masterdata.mobilecntypcode != '') {
        this.mobile_country_code_flag = Number(this.masterdata.mobilecntypcode);
      } else {
        this.mobile_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
      }
      if (this.masterdata.landlinecntypcode != '') {
        this.landline_country_code_flag = Number(this.masterdata.landlinecntypcode);
      } else {
        this.landline_country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
      }
    if(this.masterdata.primarynocc != 31){
        this.verfiedtagshowmobile = false;
      }else{
        if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
       
          this.verfiedtagshowmobile = true;
        }
      
      }
     
      this.communicationinfoForm.patchValue({
        'code': this.masterdata.primarynocc,
        'mobileno': this.masterdata.primaryno,
        'coumtrycode': this.masterdata.landlinenocc,
        'landlineno': this.masterdata.landlineno,
        'extn': this.masterdata.landlinenoext,
        'workemialid': this.masterdata.priemailid,

      });

      if (this.masterdata.verifiedemail == 1 ) {
        this.verfiedtagshow = true;
        this.emailview = true;

      }
      if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
        this.verifyshowfield = true;
        this.verfiedtagshowmobile = true;
      }
      else{
        this.verfiedtagshowmobile = false;
        this.mobnumverifybtn = true;
        this.verfiymobile = true;
        this.verifyshowfield = true;
        this.showeditbtnmobile = true;
        if(this.focusmobile)
        {
          this.editdatamobileotp()
          this.mobnumverifybtn = true; 
        }
      }
      
      setTimeout(() => {
        this.Contentplaceloader = false;
      }, 800);
      
    });
    this.basicinfoForm.controls['middlename'].disable();
    this.basicinfoForm.controls['firstname'].disable();
    this.basicinfoForm.controls['lastname'].disable();
    this.basicinfoForm.controls['department'].enable();
    this.basicinfoForm.controls['division'].enable();
    this.communicationinfoForm.controls['workemialid'].disable();
    this.communicationinfoForm.controls['mobileno'].disable();
    if (this.usertype == 'A') {
      this.optionvalue = false;
      this.basicinfoForm.controls['middlename'].enable();
      this.basicinfoForm.controls['firstname'].enable();
      this.basicinfoForm.controls['lastname'].enable();
    }
    this.focusmobile = window.history.state.focus;
    if (this.focusmobile) {
      
      this.editdatamobileotp();
      this.mobnumverifybtn = true; 
    }
  }

  addcertificatedraw() {
    this.buttonname = this.i18n('profilecreationlist.add');
    this.certificatesdrawer.toggle();
  }
  updatecommunadd(value) {
    this.addressists = value;
  }
  changecomadd(addid) {
    this.addressid = addid;
    this.mappingdrawer.toggle();
  }
  clearformcert() {
    this.certificatelistForm.controls['certificatetitle'].reset();
    this.certificatelistForm.controls['dateofissue'].reset();
    this.certificatelistForm.controls['relateddocument'].reset();
    this.certificatelistForm.controls['certificateFileUpload'].reset();
    this.drvInput.selectedFilesPk = [];
    setTimeout(() => {
      this.certificateFile.triggerChange();
      this.disableloader = false;
    }, 1000);
    this.relateddoc.selectedFilesPk = [];
    setTimeout(() => {
      this.relateddocument.triggerChange();
      this.disableloader = false;
    }, 1000);
  }
  deletewebprese(type: number, formfieldname) {
    swal({
      title: this.i18n('profilecreationlist.doyouantwebpres'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('profilecreationlist.nobutton'), this.i18n('profilecreationlist.yesbutton')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.profileservice.deletewebpresence(type).subscribe(returndata => {
          this.resultmsg = returndata.data['statusmsg'];
          if (this.resultmsg == "success") {
            if (returndata.data['retdata'] == 1) {
              this.socialmediaForm.controls['Skype'].reset();
            } else if (returndata.data['retdata'] == 2) {
              this.socialmediaForm.controls['Zoom'].reset();
            } else {
              this.socialmediaForm.controls['GoogleMeet'].reset();
            }
            this.showWSuccess();
          }
        });
      }
    });
  }

  showWSuccess() {
    this.toastr.success(this.i18n('profilecreationlist.delesucc'), this.i18n('profilecreationlist.succ'), {
      timeOut: 3000,
      closeButton: true,
    });
  }
  deletesocialmed(type: number, formfieldname) {
    swal({
      title: this.i18n('profilecreationlist.doyouantsocimedi'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('profilecreationlist.nobutton'), this.i18n('profilecreationlist.yesbutton')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.profileservice.deletesocialmedia(type).subscribe(returndata => {
          this.resultmsg = returndata.data['statusmsg'];
          if (this.resultmsg == "success") {
            if (returndata.data['retdata'] == 1) {
              this.socialmediaForm.controls['facebook'].reset();
            } else if (returndata.data['retdata'] == 2) {
              this.socialmediaForm.controls['twitter'].reset();
            } else if (returndata.data['retdata'] == 3) {
              this.socialmediaForm.controls['instagram'].reset();
            } else {
              this.socialmediaForm.controls['linkedin'].reset();
            }
            this.showWSuccess();
          }
        });
      }
    });
  }
  deletecert(certid: number) {
    swal({
      title: this.i18n('profilecreationlist.doyouantcert'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('profilecreationlist.nobutton'), this.i18n('profilecreationlist.yesbutton')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        let ids = this.encryptClass.encrypt(certid);
        this.profileservice.deletecertif(ids).subscribe(returndata => {
          this.resultmsg = returndata.data['statusmsg'];
          if (this.resultmsg == "success") {
            this.search = this.searchcertificatetitle;
            this.getcertification(
              this.page,
              this.perpage,
              this.search
            );
            this.showWSuccess();
          }
        });
      }
    });
  }
  deleteLogo(event: any) {
    if (event) {
      swal({
        title: this.i18n('profilecreationlist.doyouwantimage'),
        text: this.i18n('profilecreationlist.youcanstilreco'),
        icon: "warning",
        buttons: [this.i18n('profilecreationlist.canc'), this.i18n('profilecreationlist.okbutton')],
        dangerMode: true,
        className: "swal-delete",
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willDelete) => {
        if (willDelete) {
          this.profileservice.saveLogo([]).subscribe(data => {
            if (data['data'].status == 1) {
              this.drv_companylogo.selectedFilesPk = [];
              setTimeout(() => {
                this.logo.triggerChange();
                this.showWSuccess();
                this.upadtebtn();
              }, 1000);
            }
          })

        }
      })
    }
  }

  editcert(cerdata) {
    if (cerdata.certupload.length > 0) {
      this.drvInput.selectedFilesPk = cerdata.certupload;
      setTimeout(() => {
        this.certificateFile.triggerChange();
        this.disableloader = false;
      }, 1000);
    } else {
      this.disableloader = false;
    }
    if (cerdata.relateddoc.length > 0) {
      this.relateddoc.selectedFilesPk = cerdata.relateddoc;
      setTimeout(() => {
        this.relateddocument.triggerChange();
        this.disableloader = false;
      }, 1000);
    } else {
      this.disableloader = false;
    }
    this.certificatelistForm.patchValue({
      certificatetitle: cerdata.title,
      dateofissue: cerdata.dateofissuedit,
    });
    this.buttonname = this.i18n('profilecreationlist.upda');
    this.certid = cerdata.id;
    this.certificatesdrawer.toggle();
  }
  panelUpdate(panelNo) {
    this.panel = panelNo;
  }
  setOpen(i) {
    this.panel = i;
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    this.upadtebtn()
  }
  onSubmitbasic() {
    if (this.basicinfoForm.valid) {
      this.profileservice.saveBasicuserinfo(this.basicinfoForm.value).subscribe(resdata => {
        this.resultmsg = resdata.data['statusmsg'];
      });
    }
  }

  public upadtebtnn: boolean = false;
  upadtebtn() {

    if(this.basicinfoForm.controls.lastname.value !='' && this.basicinfoForm.controls.firstname.value != '' &&  this.basicinfoForm.controls.division.value.length != 0 && this.basicinfoForm.controls.department.value.length != 0){
      this.upadtebtnn = true;
    }else{
      this.upadtebtnn = false;
    } 
   
  }
  mobilenumchange(){
   
    if(this.communicationinfoForm.controls.code.value == 31  &&  this.communicationinfoForm.controls.mobileno.value.length == 8){
     
        let postData = {
          'mobilenum': this.communicationinfoForm.controls.mobileno.value,
          'usrid':this.user_pk,
          'stktype':this.stkholdertype
        }
      /*   this.EnterpriseService.aleadyverifiedmob('ea/user/aleadyverifiedmob', postData).subscribe(response => {
          if (response?.success) {
            if (response?.data?.data) {
             
              this.communicationinfoForm.controls.mobileno.setErrors({ samemobno: true });
             
            } 
       
          }
        })
 */
      this.upadtebtnn = false;
      this.mobnumverifybtn = true;
    }else{
    
      this.upadtebtnn = true;
    
    }

  }
  otplengthcheck(){

    if(this.communicationinfoForm.controls.mobileotp.value.length == 6){
      this.mobsubmitbtn = false;
    }
    // else{
    //   this.mobsubmitbtn = true;
    // }
  }
  onSubmitcommunic() {
    this.communicationinfoForm.controls.code.enable();
    this.communicationinfoForm.controls.mobileno.enable();
    this.communicationinfoForm.controls.workemialid.enable();

    this.basicinfoForm.controls.middlename.enable();
    this.basicinfoForm.controls.firstname.enable();
    this.basicinfoForm.controls.lastname.enable();

    this.onSubmitbasic()
    if (this.communicationinfoForm.valid) {
      this.profileservice.savecommunuserinfo(this.communicationinfoForm.value).subscribe(resdata => {
       
        if(resdata.data['twofwarning'])
              {
                 swal({
                 title:  'Update Configuration for Two Factor Authentication',
                 text: 'Please note that since you have changed the Country Code for your Mobile Number from National (Omani) to International, the Two Factor Authentication has been disabled. You can configure Two Factor Authentication preference as email via ‘Account Settings’.',
                 icon: 'warning',
                 buttons: [false,'Ok']
               })
              }
        this.resultmsg = resdata.data['statusmsg'];
      });
    }
    this.router.navigate(['/profilecreation/profilelistview']);
  }
  onSubmitcertifi() {
    if (this.certificatelistForm.valid) {
      this.initSpinner = true;
      if (this.certid != '') {
        this.textmsg = this.i18n('profilecreationlist.certupdat');
      } else {
        this.textmsg = this.i18n('profilecreationlist.certadded');
      }
      this.profileservice.savecertifinfo(this.certificatelistForm.value, this.certid).subscribe(resdata => {
        this.resultmsg = resdata.data['statusmsg'];
        this.certid = '';
        this.buttonname = this.i18n('profilecreationlist.add');
        if (this.resultmsg == "success") {
          localStorage.setItem('mobileverified', '1');
          this.initSpinner = false;
          this.search = this.searchcertificatetitle;
          this.getcertification(
            this.page,
            this.perpage,
            this.search
          );
          this.clearformcert();
          this.certificatesdrawer.toggle();
          this.showTSuccess(this.textmsg);
        }
      });
    } else {
      this.initSpinner = false;
    }
  }
  onSubmitsocialmed() {
    if (this.socialmediaForm.valid) {
      this.profileservice.savesocialmednfo(this.socialmediaForm.value).subscribe(resdata => {
        this.resultmsg = resdata.data['statusmsg'];
        if (this.resultmsg == "success") {
          this.snackBar.open(this.i18n('profilecreationlist.certadded'), '', {
            duration: 10000,
            panelClass: ['success'],
            verticalPosition: 'top'
          });
        }
      });
    }
  }

  showTSuccess(data) {
    this.toastr.success(data, this.i18n('profilecreationlist.succ'), {
      timeOut: 3000,
      closeButton: true,
    });
  }

  triggerResize() {
    this._ngZone.onStable.pipe(take(1))
      .subscribe(() => this.autosize.resizeToFitContent(true));
  }

  infolisting(divName: string) {
    if (divName === 'infoview') {
      this.animationState6 = this.animationState6 === 'out' ? 'in' : 'out';
    }
  }
  showSweetAlert() {
    if (((this.certificatelistForm.controls.dateofissue.touched && this.certificatelistForm.controls.dateofissue.value != null) ||
      (this.certificatelistForm.controls.relateddocument.touched && this.certificatelistForm.controls.relateddocument.value.length != 0 || (this.certificatelistForm.controls.certificatetitle.touched && this.certificatelistForm.controls.certificatetitle.value != null) ||
        (this.certificatelistForm.controls.certificateFileUpload.touched && this.certificatelistForm.controls.certificateFileUpload.value != null && this.certificatelistForm.controls.certificateFileUpload.value.length != 0)
      ))) {
      swal({
        title: this.i18n('profilecreationlist.doyouwantaddicert'),
        text: this.i18n('profilecreationlist.allthedatthat'),
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: [this.i18n('profilecreationlist.canc'), this.i18n('profilecreationlist.okbutton')],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          this.clearformcert();
          this.certificatesdrawer.toggle();
        }
      });
    }
    else {
      this.clearformcert();
      this.certificatesdrawer.toggle();
    }

    this.animationState = 'out';
  }
  toggleShowDiv(divName: string) {
    if (divName === 'descriptionnonjsrs') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
    } catch (error) {
      console.log('page-content')
    }
  }

  editdataotp() {
    this.showeditbtn = false;
    this.verfiy = false;
    this.emailview = true;
    this.communicationinfoForm.controls.workemialid.enable();
    this.otpviewfield = false;
    this.verfiedtagshow = false;
  }
  editdatamobileotp() {
    this.verfiedtagshowmobile = false;
    this.verifyshowfield = true;
    this.communicationinfoForm.controls.mobileno.enable();
    this.disableupdatebutton1 = true;
    this.verfiymobile = true;
    this.iseditdisable1 = false;
    this.codeselect = false;
    this.showeditbtnmobile = false;
    this.mobnumverifybtn = false;
    // if(this.communicationinfoForm.controls.code.value == 31 || this.focusmobile){
    //   this.mobnumverifybtn = true; 
    // }else{
    //   this.mobnumverifybtn = false;
    // }
    return true;
  }
  otpshowdatamobiledata() {
    this.divshow=true;
    this.communicationinfoForm.controls.mobileno.disable();
    this.communicationinfoForm.controls.code.disable();
    this.spinnerButtonOptionsmobile.active = true;
    this.sendverifyotp(this.communicationinfoForm.controls.mobileno.value, 'mobile', this.encrypt.encrypt(this.user_pk));
  }

  timer(minute, type) {
    let seconds: number = minute * 60;
    let textSec: any = "0";
    let statSec: number = 60;

    const prefix = minute < 10 ? "0" : "";
    this.timeremail = setInterval(() => {
      seconds--;
      if (statSec != 0) statSec--;
      else statSec = 59;

      if (statSec < 10) {
        textSec = "0" + statSec;
      } else textSec = statSec;

      if (type == 'mobile') {
        this.countDownMob = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
      }
      else {
        this.countDown = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
      }


      if (seconds == 0) {
        if (type == 'mobile') {
          this.disableResendmob = false;
        }
        else {
          this.disableResendemail = false;
        }

        clearInterval(this.timeremail);
      }
    }, 1000);
  }

  timermob(minute, type) {
    // let minute = 1;
    let seconds: number = minute * 60;
    let textSec: any = "0";
    let statSec: number = 60;

    const prefix = minute < 10 ? "0" : "";
    this.timermobile = setInterval(() => {
      seconds--;
      if (statSec != 0) statSec--;
      else statSec = 59;

      if (statSec < 10) {
        textSec = "0" + statSec;
      } else textSec = statSec;

      if (type == 'mobile') {
        this.countDownMob = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
      }
      else {
        this.countDown = `${prefix}${Math.floor(seconds / 60)}:${textSec}`;
      }


      if (seconds == 0) {
        if (type == 'mobile') {
          this.disableResendmob = false;
        }
        else {
          this.disableResendemail = false;
        }

        clearInterval(this.timermobile);
      }
    }, 1000);
  }
  submitdtataotp() {
    this.verifyotpdata(this.communicationinfoForm.controls.workemialid.value, this.communicationinfoForm.controls.emailotp.value, 'email', this.encrypt.encrypt(this.user_pk));
  }
  verifyotpdata(value, otp, type, usrPk) {
    this.regService.verifyotpdatadb(value, otp, type, usrPk).subscribe(data => {
      if (data.data.flag == 1) {
        if (type == 'email') {
          this.verfiedtagshow = true;
          this.disableupdatebutton = true;
          this.otpviewfield = false;
          this.countDown = '00:00';
          this.disableResendemail = false;
          this.communicationinfoForm.controls.workemialid.disable();
          this.upadtebtn();
          // if(this.verfiymobile != true && this.otpshowmobile != true){
          //   this.addUserData.emit(1);
          // }
        }
        if (type == 'mobile') {
          this.otpshowmobile = false;
          this.verfiedtagshowmobile = true;
          this.disableupdatebutton1 = false;
          // this.addreadonly = true;
          this.disableResendmob = false;
          this.countDown = '00:00';
          this.communicationinfoForm.controls.mobileno.disable();
          this.upadtebtn()
          if (this.verfiy != true && this.otpviewfield != true) {
            // this.addUserData.emit(1);
          }
        }
      }
      else {
        if (type == 'email') {
         
          this.iferrorotpmail = true;
          this.communicationinfoForm.controls.emailotp.setErrors({ invalidOTP: true });
        }
        if (type == 'mobile') {
          this.iferrorotp = true;
          this.communicationinfoForm.controls.mobileotp.setErrors({ invalidOTP: true });
        }

      }
    });
  }

  otpshowdata() {
    // this.otpviewfield = true;
    // this.verfiy = false;

    // return false
    // this.timer(15,'mobile');
   
    this.divshowemail=true
    this.spinnerButtonOptions.active = true;
    this.communicationinfoForm.controls.workemialid.disable();
    this.sendverifyotp(this.communicationinfoForm.controls.workemialid.value, 'email', this.encrypt.encrypt(this.user_pk));
    // this.formSubmitted = false;
  }
  sendverifyotp(value: any, type: any, pk: any) {

    this.regService.sendverifyotpdb(value, type, pk).subscribe(data => {

      // this.adduserForm.controls.email.disable();
      // this.duration = data.data.duration;
      this.timer(15, type);
      if (type == 'email') {
        this.verfiy = false;
        this.disableResendemail = true;
        this.otpviewfield = true;
        this.spinnerButtonOptions.active = false;
        this.disableupdatebutton = true;
      }
      if (type == 'mobile') {
        this.verfiymobile = false;
        this.disableResendmob = true;
        this.otpshowmobile = true;
        this.spinnerButtonOptionsmobile.active = false;
        this.iseditdisable1 = true;
      }


    });

  }
  submitdatamobile() {
    this.verifyotpdata(this.communicationinfoForm.controls.mobileno.value, this.communicationinfoForm.controls.mobileotp.value, 'mobile', this.encrypt.encrypt(this.user_pk));
  }

  bunitReload(event) {
    this.getDivisionData();
    this.getSectorDtls(this.encrypt.encrypt(this.companypk));
    this.refBunitDept.initiateBusinessUnit();
  }
  getDivisionData() {
    if (this.stkholdertype == 1) {
      this.postParams = {
        "compPk": this.encrypt.encrypt(this.compid)
      };
    } else {
      this.postParams = {};
    }
    this.postUrl = 'ea/businessunit/fetch-bunit-data';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.businesssource = data['data'].data.bunitData;
        }
      }.bind(this)
    );
  }
  getSectorDtls(companypk) {
    this.businessUnitDetails = new BusinessUnitDetails(this.http, companypk);
    merge()
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.businessUnitDetails!.businessUnitData();
        }),
        map(data => {
          this.resultsLength = data['data'].items.totalcount;
          return data['data'].items.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.dataSource2.data = data;
      });
  }

  deptReload(event) {
    this.postParams = {
      "bUnitPk": this.basicinfoForm.controls['division'].value,
    };
    this.postUrl = 'ea/department/fetch-department-by-bunit';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.Deptartment = data['data'].data.bunitDeptData;
        }
      }.bind(this)
    );
  }
  cancelmailver(){
    this.divshowemail=false;
    this.disableupdatebutton = true;
    this.otpviewfield = false;
    this.countDown = '00:00';
    this.countDownMob ='00:00';
    this.disableResendemail = false;
    this.disableResendmob = false;
    this.disableupdatebutton1 = false;
    this.showeditbtn =true;
    this.showeditbtnmobile = true; 
    this.iferrorotpmail=false;
    this.communicationinfoForm.controls.emailotp.reset();
    this.communicationinfoForm.controls.workemialid.setValue(this.masterdata.priemailid);
    clearInterval(this.timermobile);
    clearInterval(this.timeremail);
    
    if (this.masterdata.verifiedemail == 1 ) {
      this.verfiedtagshow = true;
      this.emailview = true;

    }
   
  }
  cancelmobilever(){
    this.divshow=false;
    // this.disableupdatebutton = true;
    // this.otpviewfield = false;
    this.countDown = '00:00';
    this.communicationinfoForm.controls.mobileotp.reset();
    clearInterval(this.timermobile);
    clearInterval(this.timeremail);
    // this.disableResendemail = false;
    // this.disableResendmob = false;
    this.iferrorotp=false;
    this.disableupdatebutton1 = false;
    this.showeditbtn =true;
    this.showeditbtnmobile = true;
    this.communicationinfoForm.controls.mobileno.setValue(this.masterdata.primaryno);
    if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
      this.verifyshowfield = true;
      this.verfiedtagshowmobile = true;
    }
    
  }
  cancelprocess(){
 
    this.ngOnInit();
    this.divshow=false;
    this.disableupdatebutton = true;
    this.otpviewfield = false;
    this.countDown = '00:00';
    this.disableResendemail = false;
    this.disableResendmob = false;
    this.disableupdatebutton1 = false;
    this.showeditbtn =true;
    this.showeditbtnmobile = true;
    
  }
 
  setcountryFlag(value, type?: string) {
    
    if (type == 'mobile') {
      this.communicationinfoForm.controls.mobileno.reset();
      this.verfiedtagshowmobile=false;
      this.mobile_country_code_flag = value;
      if (this.mobile_country_code_flag != 31) {
        this.communicationinfoForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(5), Validators.maxLength(20)])
      } else {
            this.communicationinfoForm.controls['mobileno'].setValidators([Validators.required, Validators.minLength(8), Validators.maxLength(8)])
      }
      this.communicationinfoForm.controls['mobileno'].updateValueAndValidity();
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.mobilecode = x.dialcode;
        }
      });
    } else {
      this.landline_country_code_flag = value;
      if (this.landline_country_code_flag != 31) {
        this.communicationinfoForm.controls['landlineno'].setValidators([Validators.minLength(5), Validators.maxLength(20)])
      } else {
        this.communicationinfoForm.controls['landlineno'].setValidators([Validators.required, Validators.minLength(8), Validators.maxLength(8)])
      }
      this.communicationinfoForm.controls['landlineno'].updateValueAndValidity();
      this.countrylist.forEach(x => {
        if (x.CountryMst_Pk == value) {
          this.landlinecode = x.dialcode;
        }
      });
    }
    if(value != 31){
      this.mobnumverifybtn =false
      this.verfiedtagshowmobile = false;
      this.upadtebtnn = true;
    }else{
      if (this.masterdata.verifiedmobile == 1 && this.masterdata.primarynocc == 31) {
        this.upadtebtnn = false;
        // this.verfiedtagshowmobile = true;
        // this.showeditbtnmobile =true;
        // this.communicationinfoForm.controls.mobileno.disable();
      }
   
    }
  }
}


export class BusinessUnitDetails {
  companypk: any;
  constructor(private http: HttpClient, companypk: any) {
    this.companypk = companypk;
  }

  businessUnitData(): Observable<any> {
    const href = environment.baseUrl + "mcp/mastercompanyprofile/businessunit?companypk=" + this.companypk;
    const sign = 'desc';
    const requestUrl =
      `${href}&sort=${sign}-MemCompSecDtls_Pk&order=${sign}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }


}