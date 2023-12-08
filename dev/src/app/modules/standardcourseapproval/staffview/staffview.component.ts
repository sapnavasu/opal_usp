import { Component, ElementRef, EventEmitter, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { COMMA, ENTER } from '@angular/cdk/keycodes';
import moment from 'moment';
import { ActivatedRoute, Router } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { environment } from '@env/environment';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';

export interface daterecorddata {
  selecteddate: any;
  status: any;
  starttime: any;
  // endtime: any;
  // totaltime: any;
}

const availablerecord_data: daterecorddata[] = [
  { selecteddate: 'sun 01 -jan - 2023', status: '1', starttime: '9:34',},

];
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
  selector: 'app-staffview',
  templateUrl: './staffview.component.html',
  styleUrls: ['./staffview.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class StaffviewComponent implements OnInit {
  [x: string]: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  Daterecordcolumn = ['selecteddate', 'starttime', 'status'];
  DateDATA = new MatTableDataSource<daterecorddata>();
  lists = ['item 1', 'item 2', 'item 3', 'item 4'];
  detialscard = ['item 1', 'item 2'];
  detialscardsecond = ['item 1', 'item 2'];
  locationed = ['item 1', 'item 2'];
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginator2") paginator2: MatPaginator;
  @ViewChild("paginator3") paginator3: MatPaginator;
  @ViewChild("paginator4") paginator4: MatPaginator;
  @Output() cancle = new EventEmitter<void>();

  page: number;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
  resultsLength: number;
  secondaryLength: number;
  thirdLength: number;
  locationLength: number;
  applicationopk:any;
  apprefnum :any;
  filtername = "Hide Filter";
  hidefilder: boolean;
  selectdate_filter = new FormControl('');
  state_filter = new FormControl('');
  approval: boolean = false;
  assessForm: FormGroup;
  approvalstatus: boolean = false;
  done: boolean = true;
  applicable: boolean = false;
  public ck = new InptLang_Ctrl();
  readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  @ViewChild('ccInput', { static: false }) ccInput: ElementRef<HTMLInputElement>;
  @ViewChild('inputElement') inputElement: ElementRef;
  length = '';
  editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  comment: boolean = false;
  commentsandforms = 'formsComments';
  declinedmessage: boolean = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  report: DriveInput;
  deleteicon: boolean = true;
  approvedcmt: boolean = true;
  constructor(private translate: TranslateService, private formBuilder: FormBuilder,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private activatedRoute: ActivatedRoute,
    private applicationservice: ApplicationService,
    private security: Encrypt,
    private myRoute: Router

  ) { }
  decline: boolean = false;
  appro: boolean = false;
  decline_btn: boolean = false;
  fail_btn: boolean = false;
  approval_btn: boolean = false;
  hide:boolean = false;
  staff_id: any;
  civilnum: any;
  staffname: any;
  staffname_ar: any;
  email_id: any;
  dob: any;
  age: any;
  gender: any;
  nationality: any;
  roleofcourse: any;
  mohericard: any;
mohericard_type: any;showaccessorloc ='no';  ranges: any = {
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
  config = {
    toolbar: [
      'heading',
      '|',
      'bold',
      'italic',
      '|',
      'bulletedList',
      'numberedList',
      '|',
      'blockquote',
      '|',
      'undo',
      'redo',
    ],
    image: {
      toolbar: [
        'imageStyle:full',
        'imageStyle:side',
        'imageStyle:alignLeft',
        'imageStyle:alignRight',

        '|',
        'imageTextAlternative'
      ],
      styles: [
        // This option is equal to a situation where no style is applied.
        'full',

        'side',

        // This represents an image aligned to the left.
        'alignLeft',

        // This represents an image aligned to the right.
        'alignRight'
      ]
    },
    table: {
      contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties',]
    },
    placeholder: "Type the content here!"
  }

  responses: any;
  currentItemsToShow = [];
  workexperience = [];
  assessorAvailability = [];
  accesor_avilable_date_min: any;
  accesor_avilable_date_man: any;
  total_days: any;
  accesor_state: any;
  accesor_city: any;
  totaltime: any;

  onPageChange(event) {
    this.currentItemsToShow = this.responses.slice(event.pageIndex * event.pageSize, event.pageIndex * event.pageSize + event.pageSize);
    console.log(this.currentItemsToShow);

  }
  onPageoneChange(event: PageEvent) {
    this.currentItemsToShowone = this.responses.slice(event.pageIndex * event.pageSize, event.pageIndex * event.pageSize + event.pageSize);
    //   console.log(this.currentItemsToShow);
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

  public filterValues = {
    select_date: '',
    state: '',


  };
  assecorlocares: any;
  assecorlocareslocation = []
  thirdlength: any;
  staffinfotmp_pk: any;
  staffData: any;

  staff_doc: any;
  card_percentage: any;
  card_mark: any;
  staff_docs: any;
  appsit_appdecon: any;
  validated_by: any;
  eduresponse: any;
  workresponse: any;
  appsit_iscarddetails : any;
  status : any;
  appdt_apptype : any;
  ifarabic:boolean = false;
  ngOnInit(): void {



    this.activatedRoute.queryParams.subscribe((params) => {
      this.staff_id = params['staff_id'];
      this.asit_id = params['asit'];

      this.staffinfotmp_pk = this.security.decrypt(this.asit_id);

      if (this.staff_id == '' || this.staff_id == undefined) {
        return false;
      }
      else {

        this.disableSubmitButton = true;

        this.applicationservice.getworkexp(this.staff_id, this.asit_id,).subscribe(res => {

          this.workresponse = res.data;
          this.secondaryLength = this.workresponse.length;
          this.workexperience = this.workresponse.slice(0, 10);
        })

        this.applicationservice.geteducationqulification(this.staff_id,this.asit_id).subscribe(res => {
          this.eduresponse = res.data;
          this.resultsLength = res.data.length;
          this.currentItemsToShow = this.eduresponse.slice(0, 10);
          

        })

        this.applicationservice.setvalueaccseorloca(this.staff_id,this.asit_id).subscribe(res => {

          this.assecorlocares = res.data;
          this.assecorlocareslocation = this.assecorlocares.slice(0, 10)
          this.locationLength = res.data.length;

        })

        this.applicationservice.setvaluestaffavailabledate(this.staff_id,this.asit_id).subscribe(res => { 
          this.DateDATA = new MatTableDataSource<daterecorddata>(res.data);
          this.DateDATA.paginator = this.paginator3;
          if(res.data.lenght>0){
          const Asser_starttime = res.data[0].starttime;
          const Asser_endtime = res.data[0].endtime;

          const date1 = new Date(Asser_starttime);
          const date2 = new Date(Asser_endtime);
          const diffInMsss = date2.getTime() - date1.getTime();
          this.totaltime = diffInMsss / (1000 * 60);
          this.thirdlength = res.data.length;


          this.accesor_avilable_date_min = res.data[0].min;
          this.accesor_avilable_date_man = res.data[0].max;
          // console.log(this.accesor_avilable_date_min);
          // console.log(this.accesor_avilable_date_man);

          const ONE_DAY_MS = 1000 * 60 * 60 * 24;
          const start = new Date(this.accesor_avilable_date_min);
          const end = new Date(this.accesor_avilable_date_man);
          const diffInMss = Math.abs(end.getTime() - start.getTime());
          this.total_days = Math.floor(diffInMss / ONE_DAY_MS) + 1;
          }
        })


        this.applicationservice.setValuestaffview(this.staff_id, this.asit_id).subscribe(res => {
          this.disableSubmitButton = false;
          this.responses = res.data;
          this.currentItemsToShowone = res.data.slice(0, 5);

          
          this.staffData = res.data[0][0].sir_staffcv;
          this.applicationopk= res.data[0][0].appsit_applicationdtlstmp_fk;
          this.apprefnum = res.data[0][0].appdt_appreferno;
          this.civilnum = res.data[0][0].civilnumber;
          this.staffname = res.data[0][0].staffname;
          this.staffname_ar = res.data[0][0].sir_name_ar;
          this.email_id = res.data[0][0].sir_emailid;
          this.dob = res.data[0][0].sir_dob;
          this.appsit_jobtitle = res.data[0][0].appsit_jobtitle;
          this.showaccessorloc = res.data[0][0].showaccessorloc;

          const birthDate = new Date(this.dob);
          const currentDate = new Date();
          const diffInMs = currentDate.getTime() - birthDate.getTime();
          const ageDate = new Date(diffInMs);
          const years = Math.floor(diffInMs / (1000 * 60 * 60 * 24 * 365.25));
          const months = Math.floor((diffInMs % (1000 * 60 * 60 * 24 * 365.25)) / (1000 * 60 * 60 * 24 * 30.44));
          const days = Math.floor((diffInMs % (1000 * 60 * 60 * 24 * 30.44)) / (1000 * 60 * 60 * 24));

          this.age = years;

          this.language = res.data[0][0].lang;

          this.gender = res.data[0][0].sir_gender;
          this.nationality = res.data[0][0].ocym_countryname_en;
          this.mainrole = res.data[0][0].mainrole;
          this.contract_type = res.data[0][0].rm_name_en;
          this.roleofcourse = res.data[0][0].mainrole;
          this.roleforcourse = res.data[0][0].roleforcourse;
          this.appsit_iscarddetails = res.data[0][0].appsit_iscarddetails;
          this.status = res.data[0][0].status;
          this.appdt_apptype = res.data[0][0].appdt_apptype;

          this.mohericard = res.data[0][0].doc;
          this.mohericard_type = res.data[0][0].doc_type;
          this.lan_en = res.data[0][0].lan_en;

          this.coursesubcate = res.data[0][0].coursesubcate;

          this.staffinfotmp_pk = res.data[0][0].staffinfotmp_pk;

          if (res.data[1].status == 3) // approved
          {
            this.commentsandforms = 'commenttype';

            this.appro = true;
            this.declinedmessage = false;
            this.decline = false;

            this.approval_btn = true;
            this.decline_btn = false;
            this.fail_btn = false;

            this.staff_docs = res.data[1].staff_doc;

            this.card_percentage = res.data[1].set_percentage
            this.card_mark = res.data[1].set_marksecured;

            this.card_comments = res.data[1].appsit_appdeccomment;
            this.appsit_appdecon = res.data[1].appsit_appdecon;
            this.validated_by = res.data[1].updat_by;

          }
          else if (res.data[1].status == 4)  // delined 
          {
         //   this.commentsandforms = 'commenttype';

            this.decline = true;
            this.declinedmessage = false;


            this.approval_btn = false;
            this.decline_btn = true;
            this.fail_btn = false;
            this.card_comments = res.data[1].appsit_appdeccomment;
            this.appsit_appdecon = res.data[1].appsit_appdecon;
            this.validated_by = res.data[1].updat_by;

          }

          else if (res.data[1].status == 5) // fail
          {
           // this.commentsandforms = 'commenttype';

            this.appro = true;
            this.declinedmessage = true;
            this.decline = false;
            this.fail = true;

            this.approval_btn = false;
            this.decline_btn = false;
            this.fail_btn = true;
            this.staff_docs = res.data[1].staff_doc;

            this.card_percentage = res.data[1].set_percentage
            this.card_mark = res.data[1].set_marksecured;

            this.card_comments = res.data[1].appsit_appdeccomment;
            this.appsit_appdecon = res.data[1].appsit_appdecon;
            this.validated_by = res.data[1].updat_by;

          }

        })
      }

    });



    this.selectdate_filter.valueChanges
      .subscribe(
        select_date => {
          this.filterValues.select_date = select_date;
          this.DateDATA.filter = JSON.stringify(this.filterValues);
          this.DateDATA.filterPredicate = this.createFilter();
        }
      )

    this.state_filter.valueChanges
      .subscribe(
        state => {
          this.filterValues.state = state;
          console.log(state);
          this.DateDATA.filter = JSON.stringify(this.filterValues);
          this.DateDATA.filterPredicate = this.createFilter();
      }
    )

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.ifarabic = false;
        this.filtername = "Hide Filter";
      } else {
        this.ifarabic = true;
        this.filtername = "sh Filter";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;

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
        } else {
          this.ifarabic = true;
          this.filtername = "sh Filter";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;

      }
    });
    this.assessmentForm();
    this.report = {
      fileMstPk: 3,
      selectedFilesPk: []
    };
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.paginator.page.emit(event)

  }
  secondaryPaginator(event: PageEvent) {
    this.workexperience = this.responses.slice(event.pageIndex * event.pageSize, event.pageIndex * event.pageSize + event.pageSize);
  }
  secondarysubPaginator(event: PageEvent) {
    this.paginator2.pageIndex = event.pageIndex;
    this.paginator2.pageSize = event.pageSize;
    this.paginator2.page.emit(event)

  }
  AvailablePaginator(event: PageEvent) {
    this.paginator3.pageIndex = event.pageIndex;
    this.paginator3.pageSize = event.pageSize;
    this.paginator3.page.emit(event)
  }
  locationPaginator(event: PageEvent) {
    this.assecorlocareslocation = this.responses.slice(event.pageIndex * event.pageSize, event.pageIndex * event.pageSize + event.pageSize);
  }
  locationsubPaginator(event: PageEvent) {
    this.paginator4.pageIndex = event.pageIndex;
    this.paginator4.pageSize = event.pageSize;
    this.paginator4.page.emit(event)
    
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('staff.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('staff.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  assessmentForm() {

    this.assessForm = this.formBuilder.group({
      status: ['', Validators.required],
      status_info: ['', Validators.required],
      reportdocument: ['', Validators.required],
      mark: ['', Validators.required],
      percentage: ['', Validators.required],
      comments: [''],
    })

  }
  get form() {
    return this.assessForm.controls;
  }
  statustype(value) {
    if (value == 1) {
      this.assessForm.controls.status_info.reset();
      this.approvalstatus = true;
      this.applicable = false;
      this.approvedcmt = false;
      this.done = false;
      this.comment = false;

      if(this.appdt_apptype == 3 ){
     
        if(this.appsit_iscarddetails == 2 && this.status == 2){
          this.approvalstatus = false;
          this.comment = true;
       }else if(this.appsit_iscarddetails == 1 || this.appsit_iscarddetails == 3){
        this.approvalstatus = true;
       }else if(this.appsit_iscarddetails == 2 && this.status == 1){
        this.approvalstatus = true;
        this.comment = false;
       }else if(this.appsit_iscarddetails == 2 && this.status == 1){
        this.approvalstatus = true;
        this.comment = false;
       }else{
        this.approvalstatus = false;
          this.comment = true;
       }

      }
      this.assessForm.controls['comments'].clearValidators(); 

      // this.comment = false;
      // this.applicable = false;
    } else if (value == 2) {
      this.approvalstatus = false;
      this.comment = true;
      this.applicable = false;
      this.approvedcmt = true;
      this.documentForm.controls['comment'].setValidators(Validators.required);
      this.done = true;

    }
    else if (value == 3) {
      this.applicable = true;
      this.comment = true;
      this.approvalstatus = false;
      this.approvedcmt = true;
      this.done = true;
      this.documentForm.controls['comment'].setValidators(Validators.required);

    }
    this.assessForm.controls['comment'].updateValueAndValidity(); 
  }
  onInput(event: Event): void {
    const input = event.target as HTMLTextAreaElement;
    input.style.height = 'auto';
    input.style.height = input.scrollHeight + 'px';
  }
  editinfo() {
    this.edittechinfo = !this.edittechinfo;
  }
  get f() { return this.assessForm.controls; }
  resinfo() {
    this.assessForm.controls['comments'].reset();
    this.techinfo = "";
  }
  addinfo() {
    this.techinfo = this.assessForm.controls['comments'].value;
  }
  messagedone() {
    this.addinfo();
    this.editinfo();
    this.aboutsuccess = true;
    this.done = false;
  }
  onChangeeditor(event) {
    this.length_Of_ck = $(this.assessForm.controls['comments'].value).text().length;
    this.comments = $(this.assessForm.controls['comments'].value).text();
    if (this.length_Of_ck > 1000) {
      this.assessForm.setErrors({ 'invalid': true });
      this.assessForm.controls['comments'].setErrors({ 'incorrect': true });
      this.aboutsuccess = false;
    }

  }
  applicabled(value) {
    if (value == 1) {
      this.applicable = true;
      this.comment = true;
    } else if (value == 2) {
      this.applicable = false;
      this.comment = true;
    }
    else if (value == 3) {
      this.applicable = false;
      this.comment = true;
    }
  }

  staffCv() {

    this.disableSubmitButton = true;
    window.open(environment.baseUrl + 'web/cv/' + this.staffData, "_blank");
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }

  createFilter(): (data: any, filter: string) => boolean {

    let filterFunction = function (data, filter): boolean {

      let searchTerms = JSON.parse(filter);

      console.log(data.maxdate);
      var expchanged_date = moment(data.selecteddate).format('DD-MM-YYYY');
      // var dateofeox_date =  moment(data.dateofexpiry).format('DD-MM-YYYY');
      // var lastup =  moment(data.;lastUpdated).format('DD-MM-YYYY');
      console.log(expchanged_date);

      return (searchTerms?.select_date == undefined || searchTerms?.select_date == '' || searchTerms?.select_date == expchanged_date) &&
        data?.status?.toLowerCase().indexOf(searchTerms.state) !== -1

      // (searchTerms?.date_expiry == dateofeox_date  ) 

    }
    return filterFunction;
  }


  applyaddondateFilter(dateVal) {
    if (dateVal._isValid) {
      dateVal = moment(dateVal).format('DD-MM-YYYY').toString();

      this.filterValues.select_date = dateVal.toString().trim().toLowerCase();
      this.DateDATA.filter = JSON.stringify(this.filterValues);
    }
    else {
      this.filterValues.select_date = '';
      this.DateDATA.filter = JSON.stringify(this.filterValues);
    }

  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    console.log(fileId.selectedFilesPk);

  }

  submit() {

    const status = this.assessForm.controls['status'].value;
    const status_info = this.assessForm.controls['status_info'].value;
    
    const reportdocument = this.assessForm.controls['reportdocument'].value;
    const percentage = this.assessForm.controls['percentage'].value;
    const mark = this.assessForm.controls['mark'].value;
    const comments = this.assessForm.controls['comments'].value;

    this.disableSubmitButton = true;

    this.applicationservice.staffapproved(this.asit_id, this.staff_id, status, status_info, reportdocument, percentage, mark, comments).subscribe(res => {
      this.disableSubmitButton = false;
      console.log('response data', res.data);

      this.commentsandforms = 'commenttype';

      if (res.data.appsit_status == 3) // approved
      {
        this.appro = true;
        this.declinedmessage = false;
        this.decline = false;

        this.approval_btn = true;
        this.decline_btn = false;
        this.fail_btn = false;

        this.staff_docs = res.data.staff_doc;
        console.log(this.staff_docs);
        this.card_percentage = res.data.set_percentage
        this.card_mark = res.data.set_marksecured;

        this.card_comments = res.data.appsit_appdeccomment;
        this.appsit_appdecon = res.data.appsit_appdecon;
        this.validated_by = res.data.updat_by;
      }
      else if (res.data.appsit_status == 4)  // delined 
      {
        this.decline = true;
        this.declinedmessage = false;
        this.approval_btn = false;
        this.decline_btn = true;
        this.fail_btn = false;
        this.card_comments = res.data.appsit_appdeccomment;
        this.appsit_appdecon = res.data.appsit_appdecon;
        this.validated_by = res.data.updat_by;

      }

      else if (res.data.appsit_status == 5) // fail
      {
        this.appro = true;
        this.declinedmessage = true;
        this.decline = false;
        this.fail = true;

        this.approval_btn = false;
        this.decline_btn = false;
        this.fail_btn = true;
        this.staff_docs = res.data.staff_doc;
        console.log(this.staff_docs);
        this.card_percentage = res.data.set_percentage
        this.card_mark = res.data.set_marksecured;

        this.card_comments = res.data.appsit_appdeccomment;
        this.appsit_appdecon = res.data.appsit_appdecon;
        this.validated_by = res.data.updat_by;
        console.log('fail');
      }
    })
    this.myRoute.navigate(['/standardcourseapproval/desktopreview'], { queryParams: {id: this.security.encrypt(this.applicationopk), app_ref_id: this.apprefnum,viw: 1} }); 
  }
  clearFilter() {
    this.selectdate_filter.setValue("");
    this.state_filter.setValue("");

  }
  cancel() {
    if (this.assessForm.touched) {
      swal({
        title: this.i18n('desktop.pffline'),
        text: this.i18n('desktop.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('desktop.no'), this.i18n('desktop.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((cancelPayment) => {
        if (cancelPayment) {
          this.approvalstatus = false;
          this.comment = false;
          this.applicable = false;
          this.assessForm.reset()
        }
      });

    } else {
      this.assessForm.reset()
      this.approvalstatus = false;
      this.comment = false;
      this.applicable = false;
    }
  }
  cancelbtn(){
    if(this.assessForm.touched) {
      swal({
        title: this.i18n('Do you want to back?'),
        text: this.i18n('desktop.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('desktop.no'), this.i18n('desktop.yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.myRoute.navigate(['/standardcourseapproval/desktopreview'], { queryParams: {id: this.security.encrypt(this.applicationopk), app_ref_id: this.apprefnum,viw: 1} });
        }
      })
    }else {
    this.myRoute.navigate(['/standardcourseapproval/desktopreview'], { queryParams: {id: this.security.encrypt(this.applicationopk), app_ref_id: this.apprefnum,viw: 1} });

    }

   }
}
