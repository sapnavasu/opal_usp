import { Component, OnInit, ViewChild, ViewEncapsulation, QueryList, ɵConsole, Input, Output, EventEmitter } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from '@env/environment';
import { HttpClient } from '@angular/common/http';
import { Location } from '@angular/common';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import swal from 'sweetalert';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import { map } from 'rxjs/operators/map';
import { catchError } from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { DriveInput } from '@app/common/classes/driveInput';

@Component({
  selector: 'app-staffview',
  templateUrl: './staffview.component.html',
  styleUrls: ['./staffview.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class StaffviewComponent implements OnInit {
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginatorInspect") paginatorInspect: MatPaginator;
  @ViewChild("paginatortwo") paginatortwo: MatPaginator;
  @ViewChild("dataChkBox") dataChkBox: QueryList<any>;
  @ViewChild(MatSort) sort: MatSort;
  public inspectionListData: MatTableDataSource<any>;
  public appoct_status: any;
  public sir_idnumber: any;
  public sir_name_en: any;
  public sir_name_ar: any;
  public sir_emailid: any;
  public sir_dob: any;
  public age: any;
  public sir_gender: any;
  public sir_nationality: any;
  public appsit_mainrole: any;
  public appsit_jobtitle: any;
  public appsit_contracttype: any;
  public address: any;
  public educationLength: number;
  public page: number = 10;
  public ifarabic: boolean;;
  public workLength: number;
  public staffpopup: any;
  public assessForm: FormGroup;
  public approvalstatus: any;
  public comment: boolean = false;
  public approvedcmt: boolean = false;
  public applicable: boolean;
  public done: boolean;
  public report: DriveInput;
  length = '';
  editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  public aboutsuccess: boolean;
  public declinedmessage: boolean = true;
  public appsit_appdecon: any;
  public validated_by: any;
  public card_comments: any;
  public card_percentage: any;
  public card_mark: any;
  public staff_docs: any;
  public viewForm: boolean = false;

  tabtype: any;
  courseid: number;
  postParams: { 'courseid': any; 'pageSize': any; 'page': any; };
  postUrl: string;
  public fetchPageSize: number = 10;
  public fetchPage: number = 0;
  
  public arr = [];
  public arrayoffercourse = [];
  coursecategory: any;
  coursemst_pk = 3;
  coursetested_pk = 8;
  levelarray: any;
  interarray: any;
  coursearray: any;
  levelName: string = '';
  coursetestName: string = '';
  disableSubmitButton: boolean = false;
  mattab: any;
  staffdata: any = '';
  viewtype: any;
  coursetested: any;
  projectpk: any = 4;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  resultsLength: number;
  firstCount = 100
  public toggleopen: boolean = false;
  public validateComment: boolean = false;
  public validationPlaceholder: any = 'Validate';
  resultsLength5: any;
  
  rolename: any;
  assessmenttype: any;
  assessment: string;
  public reloadComponent: any;
  tblplaceholder: boolean;
  disableLoader: boolean;
  arvict_rascategorymst_fk: FormControl;
  arvict_status: FormControl;
  knowassessment: FormControl;
  practassessment: FormControl;
  getDatafromsubmit: any;
  fromview: string;
  isInspector: any;
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

  documentList = [
    {
      title: 'ID Card',
      images: [
        { type: 'pdf', url: '' },
      ],
    },
    {
      title: 'ROP Driver License',
      images: [
        { type: 'pdf', url: '' },
        { type: 'pdf', url: '' },
        { type: 'pdf', url: '' },],
    }, {
      title: 'MOL Employment Contract',
      images: [
        { type: 'pdf', url: '' },
        { type: 'pdf', url: '' },
        { type: 'pdf', url: '' },],
    }, {
      title: 'The Contract between the Vendor and the Employee',
      images: [
        { type: 'pdf', url: '' },
        { type: 'pdf', url: '' },
        { type: 'pdf', url: '' },],
    }, {
      title: 'Competency Certificate for IVMS Device Model',
      images: [

      ],
    },
  ];

  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private formBuilder: FormBuilder,
    private cookieService: CookieService,
    private routeid: ActivatedRoute,
    private http: HttpClient,
    private appservice: ApplicationService,
    private security: Encrypt,
    private _location: Location, private route: Router,
  ) {

    this.onValidation = this.onValidation.bind(this);
  }
  i18n(key) {
    return this.translate.instant(key);
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.ifarabic = false;
      } else {
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
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

        }
        else {
          this.ifarabic = true;

        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;

      }
    });
    this.routeid.params.subscribe(params => {
      this.tabtype = params['type'];
      this.courseid = params['id'];
      this.viewtype = params['viewtype'];
      this.assessmenttype = params['assessmenttype'];
      this.assessment = this.security.decrypt(params['assessmenttype']);
      this.fromview = this.security.decrypt(params['fromview']);
      console.log(this.assessment, 'popopop');


    });

    this.appservice.getsubcoursecategory().subscribe(data => {
      this.coursecategory = data.data.data;
    });


    this.appservice.getreferancemst(this.coursemst_pk).subscribe(data => {
      this.levelarray = data.data.data;

    });
    this.appservice.getreferancemst(this.coursetested_pk).subscribe(data => {
      this.coursetested = data.data.data;

    });
    this.appservice.getappintermst().subscribe(data => {
      this.interarray = data.data.data;
    });

    this.fetchStaffAcad(this.page);
    this.fetchStaffwrk(this.page);
    this.fetchStaffdata(this.page);
    this.appservice.getcoursetmp().subscribe(data => {
      this.coursearray = data.data.data;
    });
    this.assessmentForm();
    this.report = {
      fileMstPk: 3,
      selectedFilesPk: []
    };
  }

  educationPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchStaffAcad(this.page);
  }
  workPaginator(event: PageEvent) {
    this.page = event.pageSize;
    this.fetchStaffwrk(this.page);
  }


  fetchStaffAcad(page) {
    this.disableSubmitButton = true;
    this.postUrl = 'center/app-center/fetch-favourite-staffacd';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': page,
      'page': this.fetchPage,
    }
    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {

        this.staffacd = data['data'].data.favResult.data;
        this.educationLength = data['data'].data.favResult.totalcount;
      }.bind(this)
    );
  }

  fetchStaffdata(page) {
    this.postUrl = 'center/app-center/fetch-favourite-staffdata';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': page,
      'page': this.fetchPage,
    }
    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {

        this.staffdata = data['data'].data.favResult.data;
        console.log(this.staffdata, 'staffdata');
        this.sir_idnumber = this.staffdata[0]['sir_idnumber'];
        this.projectpk = this.staffdata[0]['appdt_projectmst_fk'];
        this.appdt_status = this.staffdata[0]['appdt_status'];
        this.sir_name_en = this.staffdata[0]['sir_name_en']
        this.sir_name_ar = this.staffdata[0]['sir_name_ar'];
        this.sir_emailid = this.staffdata[0]['sir_emailid'];
        this.sir_dob = this.staffdata[0]['sir_dob'];
        this.age = this.staffdata[0]['age'];
        this.sir_gender = this.staffdata[0]['sir_gender'];
        this.sir_nationality = this.staffdata[0]['sir_nationality'];
        this.sir_staffcv = this.staffdata[0]['sir_staffcv'];
        this.sir_opalstatemst_fk = this.staffdata[0]['sir_opalstatemst_fk'];
        this.sir_opalcitymst_fk = this.staffdata[0]['sir_opalcitymst_fk'];
        this.sir_addrline1 = this.staffdata[0]['sir_addrline1'];
        this.sir_addrline2 = this.staffdata[0]['sir_addrline2'];
        this.appsit_mainrole = this.staffdata[0]['appsit_mainrole'];
        this.appsit_jobtitle = this.staffdata[0]['appsit_jobtitle'];
        this.appsit_contracttype = this.staffdata[0]['appsit_contracttype'];
        this.appsit_appdeccomment = (this.staffdata[0]['appsit_appdeccomment']) ? this.staffdata[0]['appsit_appdeccomment'] : 'Nil';
        this.appsit_appdecon = this.staffdata[0]['appsit_appdecon'];
        this.appsit_appdecby = this.staffdata[0]['appsit_appdecby'];
        this.appsit_status = this.staffdata[0]['appsit_status'];
        this.documenttype = this.staffdata[0]['sir_moheridoc'];
        this.username1 = this.staffdata[0]['username'];
        this.mcfd_filetype = this.staffdata[0]['mcfd_filetype'];
        this.coverImg = this.staffdata[0]['coverImages'];
        this.coverImg1 = this.staffdata[0]['coverImages1'];
        this.coverImg2 = this.staffdata[0]['coverImages2'];
        this.civilfiletype = this.staffdata[0]['civilfiletype'];
        this.address = this.staffdata[0]['address'];
        this.licencefiletype = this.staffdata[0]['licencefiletype'];
        if (this.staffdata[0]['appsit_appoffercoursetmp_fk']) {
          this.arrayoffercourse = this.staffdata[0]['appsit_appoffercoursetmp_fk'].split(',');
        }
        console.log(this.staffdata[0]['appsit_apprasvehinspcattmp_fk'], 'jjjlll')
        this.disableSubmitButton = false;
      }.bind(this)
    );
  }

  fetchStaffwrk(page) {
    this.postUrl = 'center/app-center/fetch-favourite-staffwrk';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': this.page,
      'page': this.fetchPage,
    }

    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {
        this.staffwrk = data['data'].data.favResult.data;
        this.workLength = data['data'].data.favResult.totalcount;
      }.bind(this)
    );
  }



  onValidation(form, resetForm) {
    this.arr.push(this.security.decrypt(this.courseid));
    this.disableSubmitButton = true;
    if (form.value.select_valitate == 3) {
      if (!this.approvalstatus && this.projectpk == 4) {
        if (this.assessment == '1') {
          swal({
            title: 'You cannot Approve when the Knowledge Assessment status is Fail/ Pending.',
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then(() => {
            resetForm();

          });

        } else if (this.assessment == '2') {
          swal({
            title: 'You cannot Approve when the Practical Assessment status is Non- Competent/ Pending.',
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then(() => {
            resetForm();

          });

        }
        this.disableSubmitButton = false;
        return false;

      }
    }
    this.appservice.updateStaff(form.value, this.arr).subscribe(data => {
      this.disableSubmitButton = false;
      this.staffpopup = this.i18n('maincenter.staffview');
      swal({
        title: this.staffpopup,
        text: " ",
        icon: 'success',
        buttons: [false, this.i18n('uploadfile.ok')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        resetForm();
        this.route.navigate(['centrecertification/rasdesktopreview/' + this.security.encrypt(data.data.data.appsit_applicationdtlstmp_fk) + '/desktopreview/' + this.security.encrypt(1) + '/' + this.security.encrypt(this.projectpk)]);
        this.mattab = 2;
      });
      this.fetchStaffAcad(this.page);
      this.fetchStaffwrk(this.page);
      this.fetchStaffdata(this.page);


    });
  }

  staffCv(sir_staffcv) {
    window.open(environment.baseUrl + 'web/cv/' + sir_staffcv, "_blank");
  }
  goBack() {
    this.disableSubmitButton = true;

    this._location.back();
    this.mattab = 2;
    localStorage.setItem('mattab', this.mattab.toString()); // Save the selected tab index
  }

  clearFilter() {
    this.arvict_rascategorymst_fk.reset()
    this.arvict_status.reset()
    this.knowassessment.reset()
    this.practassessment.reset()
  }
  Upload() {
    this.route.navigate(['/centrecertification/uploadassessment']);
  }
  viewandUpdate(type, element) {
    if (type == 'View') {
      this.route.navigate(['/centrecertification/uploadassessmentView/' + this.security.encrypt(element.apprasvehinspcattmp_pk) + '/' + this.security.encrypt(element.appostaffinfotmp_pk) + '/' + this.security.encrypt(element.rascategorymst_pk) + '/' + this.assessmenttype]);
      localStorage.setItem('assessmentState', type);
    } else if (type == 'Upload') {
      this.route.navigate(['/centrecertification/uploadassessment/' + this.security.encrypt(element.apprasvehinspcattmp_pk) + '/' + this.security.encrypt(element.appostaffinfotmp_pk) + '/' + this.security.encrypt(element.rascategorymst_pk) + '/' + this.assessmenttype]);
      localStorage.setItem('assessmentState', type);
    } else if (type == 'Update') {
      this.route.navigate(['/centrecertification/uploadassessmentupdate/' + this.security.encrypt(element.apprasvehinspcattmp_pk) + '/' + this.security.encrypt(element.appostaffinfotmp_pk) + '/' + this.security.encrypt(element.rascategorymst_pk) + '/' + this.assessmenttype]);
      localStorage.setItem('assessmentState', type);
    }


  }
  recivedGetData(getData) {
    if (getData) {
      this.toggleopen = getData;
    } else {
      this.toggleopen = getData;
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


  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function (data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.arvict_rascategorymst_fk.toLowerCase().indexOf(searchTerms.arvict_rascategorymst_fk) !== -1 &&
        data.arvict_status.toLowerCase().indexOf(searchTerms.arvict_status) !== -1 &&
        data.arvict_createdon.toLowerCase().indexOf(searchTerms.arvict_createdon) !== -1 &&
        data.arvict_updatedon.toLowerCase().indexOf(searchTerms.arvict_updatedon) !== -1;

    }
    return filterFunction;
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

      this.assessForm.controls['comments'].clearValidators();
      
    } else if (value == 2) {
      this.approvalstatus = false;
      this.comment = true;
      this.applicable = false;
      this.approvedcmt = true;
      this.done = true;

    }
    else if (value == 3) {
      this.applicable = true;
      this.comment = true;
      this.approvalstatus = false;
      this.approvedcmt = true;
      this.done = true;

    }
    this.assessForm.controls['comment'].updateValueAndValidity();
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    console.log(fileId.selectedFilesPk);

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
   
  cancelbtn() {
    
  }
}



export class InspectionPagination {
  constructor(private http?: HttpClient,) {
  }

  InspectionGridUtil(sort: string, order: string, page: number, size: number, gridsearchValues?: string, appid?: string): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getinspectiondata';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}





