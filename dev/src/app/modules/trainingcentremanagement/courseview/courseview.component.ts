import { Component, OnInit, ViewChild, ViewEncapsulation , QueryList, ɵConsole, Input, Output, EventEmitter } from '@angular/core';
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
import { FormControl } from '@angular/forms';
import { MatSort } from '@angular/material/sort';
import {map} from 'rxjs/operators/map';
import {catchError} from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import {of as observableOf} from 'rxjs/observable/of';
import {switchMap} from 'rxjs/operators/switchMap';
import {startWith} from 'rxjs/operators/startWith';
import {merge} from 'rxjs/observable/merge';
export interface StaffrecorddataList {
  inspect_cate: any;
  inspect_role: any;
  knowassessment: any;
  practassessment: any;
  action: any;
}

const staffrecord_data: StaffrecorddataList[] = [
  { inspect_cate: '10610796', inspect_role: '', knowassessment: "Ahmed Bin Al Rahman", practassessment: "ahmedbinal@gmail.com",action: 'View' },
  { inspect_cate: '10610796', inspect_role: '', knowassessment: "Ahmed Bin Al Rahman", practassessment: "ahmedbinal@gmail.com",action: 'update' },
  { inspect_cate: '10610796', inspect_role: '', knowassessment: "Ahmed Bin Al Rahman", practassessment: "ahmedbinal@gmail.com" ,action: 'upload'},

];
@Component({
  selector: 'app-courseview',
  templateUrl: './courseview.component.html',
  styleUrls: ['./courseview.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class CourseviewComponent implements OnInit {
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginatorInspect") paginatorInspect: MatPaginator;
  @ViewChild("paginatortwo") paginatortwo: MatPaginator;

  @ViewChild("dataChkBox") dataChkBox: QueryList<any>;
  @ViewChild(MatSort) sort: MatSort;
  public inspectionListData: MatTableDataSource<any>;
  GridDatas:  InspectionPagination;
  resultsLength1: number;
  resultsLength2: number;
  resultsLength3: number;
  page: number = 10;
  tabtype:any;
  courseid: number;
  postParams: { 'courseid': any; 'pageSize': any; 'page': any; };
  postUrl: string;
  public fetchPageSize: number = 10;
  public fetchPage: number = 0;
  ifarabic: boolean;
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
  // public ViewAssessment: boolean = true;
  noData: any = '';
  approvalstatus: any;
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
  address:any;
  fromview: string;
  isInspector: any;
  staffpopup: any;
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,

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
  staffDataList = ['arvict_rascategorymst_fk', 'arvict_status', 'knowassessment', 'practassessment', 'action'];
  staffrecorddata = new MatTableDataSource<StaffrecorddataList>(staffrecord_data);
  ngOnInit(): void {
    // this.reloaded()

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      } else {
        this.filtername = "إخفاء التصفية";
        this.ifarabic = true;
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
          this.filtername = "Hide Filter";
          this.ifarabic = false;

        }
        else {
          this.filtername = "إخفاء التصفية";
          this.ifarabic = true;

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
    this.routeid.params.subscribe(params => {
      this.tabtype = params['type'];
      this.courseid = params['id'];
      this.viewtype = params['viewtype'];
      this.assessmenttype =  params['assessmenttype'];
      this.assessment =  this.security.decrypt(params['assessmenttype']);
      this.fromview =   this.security.decrypt(params['fromview']);
      console.log(this.assessment , 'popopop');


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

    if (this.tabtype == 'course') {
      this.fetchCourceData(this.page);
      this.fetchCourcetempData(this.page);
    }
    if (this.tabtype == 'staff') {
      this.disableSubmitButton = true;
      this.fetchStaffAcad(this.page);
      this.fetchStaffwrk(this.page);
      this.fetchStaffdata(this.page);
     // this.fetchInspectiondata(this.page);
      
      this.appservice.getcoursetmp().subscribe(data => {
        this.coursearray = data.data.data;
      });
      setTimeout(() => {
        this.fetchInspectiontData();
         this.statusUpdated();

      }, 1000);
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 10000);
    }

    
    this.arvict_rascategorymst_fk = new FormControl('');
    this.arvict_status = new FormControl('');
    this.knowassessment = new FormControl('');
    this.practassessment = new FormControl('');
    // this.appdst_createdon = new FormControl('');


    this.arvict_rascategorymst_fk.valueChanges.debounceTime(400).subscribe(
      register => {  
        console.log("sjsjjsjjsjs");
        if (register != null ) {
          this.paginatortwo.pageIndex = 0;
          this.fetchInspectiontData();
        }else if(register == ''){
          this.paginatortwo.pageIndex = 0;
          this.fetchInspectiontData();  
        }    
      }
    )
    this.arvict_status.valueChanges.debounceTime(400).subscribe(
    
      register => {  
        this.paginatortwo.pageIndex = 0;      
        this.fetchInspectiontData();   
      }
    )
  
    this.knowassessment.valueChanges.debounceTime(400).subscribe(
    
      register => {  
  
        if (register != null) {
          this.paginatortwo.pageIndex = 0;
          this.fetchInspectiontData();
        }else if(register == ''){
          this.paginatortwo.pageIndex = 0;
          this.fetchInspectiontData();
        }    
      }
    )
    this.practassessment.valueChanges.debounceTime(400).subscribe(
    
      register => {  

        if (register != null) {
          this.paginatortwo.pageIndex = 0;
          this.fetchInspectiontData();
        }else if(register == ''){
          this.paginatortwo.pageIndex = 0;
          this.fetchInspectiontData();
        }    
      }
    )
  }
  
  ngAfterViewInit(){
    // alert()
    setTimeout(() => {
      this.fetchInspectiontData();
    }, 1000);
   }
   
   syncPrimaryInspect(event: PageEvent) {
    this.paginatortwo.pageIndex = event.pageIndex;
    this.paginatortwo.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.fetchInspectiondata(this.page)
  }
  syncPrimaryPaginator1(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    if (this.tabtype == 'course') {
      this.fetchCourceData(this.page);
      this.fetchCourcetempData(this.page);
    }
  }
  syncPrimaryPaginator2(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    if (this.tabtype == 'staff') {
      this.fetchStaffAcad(this.page);
    }
  }
  syncPrimaryPaginator3(event: PageEvent) {
    this.page = event.pageSize;
    if (this.tabtype == 'staff') {
      this.fetchStaffwrk(this.page);
    }
  }

  fetchCourceData(page) {
    this.disableSubmitButton = true;
    this.postUrl = 'center/app-center/fetch-favourite-result';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': this.page,
      'page': this.fetchPage,
    }
    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {
        this.courseunit = data['data'].data.favResult.data;
        console.log(this.courseunit, 'unituuuuu');
        this.resultsLength1 = data['data'].data.favResult.totalcount;
        this.disableSubmitButton = false;

      }.bind(this)
    );
  }

  fetchCourcetempData(page) {
    this.disableSubmitButton = true;
    this.postUrl = 'center/app-center/fetch-favourite-temp';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': this.page,
      'page': this.fetchPage,
    }
    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {
        this.courseunittemp = data['data'].data.favResult.data;
        this.appdt_status = this.courseunittemp[0]['appdt_status'];
        this.courcename = (this.ifarabic = true) ? this.courseunittemp[0]['appoct_coursename_en'] : this.courseunittemp[0]['appoct_coursename_ar'];
        this.appoct_courseduration = this.courseunittemp[0]['appoct_courseduration'];
        this.appoct_courselevel = this.courseunittemp[0]['appoct_courselevel'];
        this.levelName = this.levelarray.find((level: any) => level.referencemst_pk === this.appoct_courselevel).rm_name_en
        this.appoct_foundationprog = (this.courseunittemp[0]['appoct_foundationprog'] = 1) ? true : false;
        this.appoct_coursecategorymst_fk = (this.ifarabic = true) ? this.courseunittemp[0]['ccm_catname_en'] : this.courseunittemp[0]['ccm_catname_ar'];
        const rawSubCategoryArray = this.courseunittemp[0]['appoct_coursesubcategorymst_fk'].split(',');
        this.array = rawSubCategoryArray.map(subPk => this.coursecategory.find(cat => cat.coursecategorymst_pk === subPk))
        this.appoct_coursesubcategorymst_fk = this.courseunittemp[0]['appoct_coursesubcategorymst_fk'];
        this.appoct_coursetested = this.courseunittemp[0]['appoct_coursetested'];
        this.coursetestName = this.coursetested.find((pk: any) => pk.referencemst_pk === this.appoct_coursetested).rm_name_en;
        this.appoct_appintrecogtmp_fk = this.courseunittemp[0]['appoct_appintrecogtmp_fk'];
        if (this.courseunittemp[0]['appoct_appintrecogtmp_fk']) {
          this.intreg = this.courseunittemp[0]['appoct_appintrecogtmp_fk'].split(',');
        }
        //  console.log(this.courseunittemp[0]['appoct_appintrecogtmp_fk'] , 'originial');
        //  console.log(this.intreg , 'intersss');
        //  console.log(this.intreg.length , 'inter');
        this.appoct_appdeccomment = (this.courseunittemp[0]['appoct_appdeccomment']) ? this.courseunittemp[0]['appoct_appdeccomment'] : 'Nil';
        this.appoct_appdecon = this.courseunittemp[0]['appoct_appdecon'];
        this.appoct_appdecby = this.courseunittemp[0]['appoct_appdecby'];
        this.username = this.courseunittemp[0]['username'];
        this.appoct_status = this.courseunittemp[0]['appoct_status'];
        this.resultsLength1 = data['data'].data.favResult.totalcount;
        this.disableSubmitButton = false;

      }.bind(this)
    );
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
        this.resultsLength2 = data['data'].data.favResult.totalcount;
        //  this.disableSubmitButton = false;
      }.bind(this)
    );
  }
  fetchInspectiondata(page) {
    // this.disableSubmitButton = true;
    this.postUrl = 'center/app-center/fetch-favourite-inspectiondata';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': this.page,
      'page': this.fetchPage,
    }
    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {
        this.staffinspection = data['data'].data.favResult.data;
        this.resultsLength4 = data['data'].data.favResult.totalcount;
        //  this.disableSubmitButton = false;

      }.bind(this)
    );
  }
  fetchStaffdata(page) {
    // this.disableSubmitButton = true;
    this.postUrl = 'center/app-center/fetch-favourite-staffdata';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': page,
      'page': this.fetchPage,
    }
    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {

        this.staffdata = data['data'].data.favResult.data;
        console.log(this.staffdata , 'staffdata');
        this.sir_idnumber = this.staffdata[0]['sir_idnumber'];
        this.projectpk =  this.staffdata[0]['appdt_projectmst_fk'];
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
        console.log(this.staffdata[0]['appsit_apprasvehinspcattmp_fk'] , 'jjjlll')
        // this.resultsLength2 = data['data'].data.favResult.totalcount;
        this.disableSubmitButton = false;
      }.bind(this)
    );
  }

  fetchStaffwrk(page) {
    // this.disableSubmitButton = true;
    this.postUrl = 'center/app-center/fetch-favourite-staffwrk';
    this.postParams = {
      'courseid': this.courseid,
      'pageSize': this.page,
      'page': this.fetchPage,
    }
    
    this.appservice.AppSearhService(this.postParams, this.postUrl).subscribe(
      function (data) {
        this.staffwrk = data['data'].data.favResult.data;
        this.resultsLength3 = data['data'].data.favResult.totalcount;
        //  this.disableSubmitButton = false;

      }.bind(this)
    );
  }

  

  onValidation(form, resetForm) {
    this.arr.push(this.security.decrypt(this.courseid));
    this.disableSubmitButton = true;
    if (this.tabtype == 'course') {
      this.appservice.updateCourse(form.value, this.arr).subscribe(data => {
        this.disableSubmitButton = false;
        swal({
          title: this.i18n('maincenter.courseview'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          resetForm();

        });
        this.fetchCourceData(this.page);
        this.fetchCourcetempData(this.page);
      });

    }


    if (this.tabtype == 'staff') {
      if(form.value.select_valitate == 3){
      if(!this.approvalstatus && this.projectpk == 4){
        if(this.assessment == '1'){
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

        }else if(this.assessment == '2'){
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
        if(this.projectpk == 1) {
          this.staffpopup = this.i18n('maincenter.staffview');
        } else {
          this.staffpopup = this.i18n('The Staff has been Validated and Submitted');
        }
        swal({
          title:  this.staffpopup,
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          resetForm();
          this.route.navigate(['centrecertification/rasdesktopreview/'+this.security.encrypt(data.data.data.appsit_applicationdtlstmp_fk)+'/desktopreview/'+this.security.encrypt(1)+'/'+this.security.encrypt(this.projectpk)]);
          if (this.tabtype == 'course') {
            this.mattab = 1;
          } else {
            this.mattab = 2; 
          }
          localStorage.setItem('mattab', this.mattab.toString());
        });
        this.fetchStaffAcad(this.page);
        this.fetchStaffwrk(this.page);
        this.fetchStaffdata(this.page);


      });
    }

  }

  staffCv(sir_staffcv) {
    window.open(environment.baseUrl + 'web/cv/' + sir_staffcv, "_blank");
  }
  goBack() {
    this.disableSubmitButton = true;

    this._location.back();
    if (this.tabtype == 'course') {
      this.mattab = 1;
    } else {
      this.mattab = 2;
    }
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
    //  this.disableLoader = true;
    if(type == 'View') {
      this.route.navigate(['/centrecertification/uploadassessmentView/'+this.security.encrypt(element.apprasvehinspcattmp_pk) + '/' + this.security.encrypt(element.appostaffinfotmp_pk) + '/' + this.security.encrypt(element.rascategorymst_pk) +'/'+this.assessmenttype]);
      localStorage.setItem('assessmentState', type);
    }else if(type == 'Upload') {
      this.route.navigate(['/centrecertification/uploadassessment/'+this.security.encrypt(element.apprasvehinspcattmp_pk) + '/' + this.security.encrypt(element.appostaffinfotmp_pk)+ '/' + this.security.encrypt(element.rascategorymst_pk) +'/'+this.assessmenttype] );
      localStorage.setItem('assessmentState', type);
    }else if(type == 'Update') {
      this.route.navigate(['/centrecertification/uploadassessmentupdate/'+this.security.encrypt(element.apprasvehinspcattmp_pk) + '/' + this.security.encrypt(element.appostaffinfotmp_pk)+ '/' + this.security.encrypt(element.rascategorymst_pk) +'/'+this.assessmenttype]);
      localStorage.setItem('assessmentState', type);
    }


  }
  recivedGetData(getData) {
    if (getData) {
      this.toggleopen = getData;
    } else {
      this.toggleopen = getData;
      // alert(this.toggleopen)
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

  fetchInspectiontData() {  
    this.tblplaceholder = true;
    this.GridDatas = new InspectionPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginatortwo.pageIndex = 0);
    var gridsearchvalue = {};

  //  alert(this.arvict_rascategorymst_fk)
   gridsearchvalue = {arvict_rascategorymst_fk:this.arvict_rascategorymst_fk.value,arvict_status:this.arvict_status.value,knowledge_assessment:this.knowassessment.value,pract_assessment:this.practassessment.value};
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.GridDatas.InspectionGridUtil(
            this.sort.active, this.sort.direction, this.paginatortwo.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue), this.security.decrypt(this.courseid));
        }),
        map(data => {

          this.resultsLength5 = data['data'].data.totalcount;
          this.approvalstatus = data['data'].data.approvalstatus;
          this.rolename = data['data'].data.rolename;
          this.isInspector = data['data'].data.isInspector;
          console.log( this.resultsLength5 , 'rolename');
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.tblplaceholder = false;
        this.inspectionListData = new MatTableDataSource<any>(data);
        this.inspectionListData.filterPredicate = this.createFilter();
        this.noData = this.inspectionListData.connect().pipe(map(data => data.length === 0));
       });
      
  }
// reloaded() {
//     this.reloadComponent = localStorage.getItem('reloadComponent');
//     if(this.reloadComponent == 'Reload') {
//       this.fetchInspectiontData()['']
//     }
//   }
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
  statusUpdated() {
   this.getDatafromsubmit = localStorage.getItem('sendSubmitData');
   if(this.getDatafromsubmit) {
   setTimeout(() => {
    this.fetchInspectiontData();
    
   }, 1000);
   localStorage.removeItem('sendSubmitData')

   }


  }
  
}



export class InspectionPagination {
  constructor(private http?: HttpClient,) {
  }

  InspectionGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string,appid?:string): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getinspectiondata';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&appid=${appid}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}





