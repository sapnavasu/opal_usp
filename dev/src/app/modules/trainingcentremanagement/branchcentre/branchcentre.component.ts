import { Component, ViewEncapsulation, OnInit, Inject, ElementRef, ViewChild, Input, EventEmitter, Output, AfterViewInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl, FormGroupDirective, RequiredValidator, FormArray } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE, MatOption } from '@angular/material/core';
import { ReplaySubject } from 'rxjs/internal/ReplaySubject';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { MatInput } from '@angular/material/input';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { BgiJsonconfigServices } from "@app/config/BGIConfig/bgi-jsonconfig-services";
import { MatTabGroup } from '@angular/material/tabs';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { ApplicationService } from '@app/services/application.service';
import { RegistrationService } from '@app/modules/registration/registration.service';
import swal from 'sweetalert';
import { THIS_EXPR } from '@angular/compiler/src/output/output_ast';
import { value } from '@app/@shared/global.model';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import moment from 'moment';
import { BgimapComponent } from '@app/@shared/bgimap/bgimap.component';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Lccdivison } from '@env/common_veriables';
import { ToastrService } from 'ngx-toastr';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { Observable } from 'rxjs/Observable';
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { map } from 'rxjs/operators/map';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import { ActivatedRoute, Router } from '@angular/router';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { MatCheckbox, MatCheckboxChange } from '@angular/material/checkbox';
import { AnimationEvent } from '@angular/animations';
import { Encrypt } from '@app/common/class/encrypt';
import { empty } from 'rxjs';
import { MatSelect } from '@angular/material/select';
import { MatRadioChange } from '@angular/material/radio';

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
export interface BranchData {
  applictionno: any;
  branchname: any;
  position: any;
  applicationstatus: any;
  certification: any;
  addedon: any;
  appdt_certificateexpiry: any;
  lastUpdated: any;
}
export interface courseList {
  coursetitle: any;
  courseduration: any;
  position: any;
  courselevel: any;
  coursetest: any;
  add: any;
  status: any;
  coursecat: any;
  lastUpdated: any;
}
export interface staffData {
  civilnumb: any;
  staffname: any;
  position: any;
  emailid: any;
  age: any;
  gender: any;
  mainrole: any;
  conttype: any;
  add: any;
  nation: any;
  status: any;
  coursecat: any;
  lastUpdated: any;
}

export interface educationData {
  institute: any;
  degree: any;
  position: any;
  edu_level: any;
  grad_date: any;
  grade: any;
  certificatedoc: any;
  addedu: any;
  lastUpdated: any;
}
export interface workexperienceData {
  organname: any;
  datejoin: any;
  position: any;
  worktill: any;
  country: any;
  governate: any;
  wilayat: any;
  desig: any;
  addedu: any;
  lastUpdated: any;
}
export interface inspectionData {
  inspect_values: any;
  inspectstatus: any;
  inspectcreatedon: any;
  inspectlastupdate: any;
}
const BranchList_Data: BranchData[] = [

];

const Course_DATA: courseList[] = [

];
const staff_DATA: staffData[] = [

];

const Eduction_DATA: educationData[] = [
];
const Work_DATA: workexperienceData[] = [
];
@Component({
  selector: 'app-branchcentre',
  templateUrl: './branchcentre.component.html',
  styleUrls: ['./branchcentre.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', display: 'none' })),
    state('expanded', style({ height: '*', display: 'block' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ]
})
export class BranchcentreComponent implements OnInit, AfterViewInit {
  public officetype: boolean = true;
  public educationformshow: any = false;
  public workexpformshow: any = false;
  public applystatus: any;
  public LoaderForNorecord: boolean = false;
  public LoaderForNorecords: boolean = false;
  public Norecordsloader: boolean = false;
  public Norecordsloadereducte: boolean = false;
  public Norecordsloaderwork: boolean = false;
  mainofficeapplied: any;
  res_inspectioncategory: any;
  rolerascatcategory: any[]=[];
  rolerascategory_remove: any;
  LengthofInspection: any = 0;
  inspectionSource: MatTableDataSource<inspectionData>;
  inpect_list: any;
  rolesinstaff: any;
  staffconfigstatus: any;
  staffconfigmsg_ar: any;
  staffconfigmsg_en: any;
  serach: { inspectcat_serch: any; InspectStatus_serch: any; inspectAddedon_serch: any; inpectLastUpdated_serch: any; };
  aleradycerified: any;
  applied: any;
  dataapp: any;
  popupContent: any;
  staffallvaild: any;
  res_inspectioncategory1: any;
  registertype: any;
  aleradycerified_center: any;
  applied_center: any;
 elemeentadata: any;rascategorylenth = 0;  i18n(key) {
    return this.translate.instant(key);
  }
  // tables branch
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  public selectAllbranch: boolean = false;
  // course table
  @ViewChild('showChkbox') showChkbox: MatCheckbox;
  public selectAllCourse: boolean = false;
  // inspection
  @ViewChild('showandhideChkbox') showandhideChkbox: MatCheckbox;
  public selectAllInspection: boolean = true; 
  // staff
  @ViewChild('staffChkbox') staffChkbox: MatCheckbox;
  public selectAllStaff: boolean = false;
  // education
  @ViewChild('DataChkbox') DataChkbox: MatCheckbox;
  public selectAllEducation: boolean = false;
  // work
  @ViewChild('chkWork') chkWork: MatCheckbox;
  public selectAllWork: boolean = false;

  BranchListData = [
    { branchColumn: "appdt_appreferno", filtsearch: "row-first", label: "branch.applform", HideVisible: true, disoperate: true },
    { branchColumn: "appiit_branchname_en", filtsearch: "row-second", label: "branch.branchname", HideVisible: true, disoperate: false },
    { branchColumn: "appdt_status", filtsearch: "row-three", label: "branch.applstat", HideVisible: true, disoperate: false },
    { branchColumn: "certification", filtsearch: "row-four", label: "branch.certstat", HideVisible: true, disoperate: false },
    { branchColumn: "appdt_certificateexpiry", filtsearch: "row-five", label: "branch.dateofexpi", HideVisible: false, disoperate: true },
    { branchColumn: "addedon", filtsearch: "row-six", label: "branch.addedon", HideVisible: true, disoperate: false },
    { branchColumn: "lastUpdated", filtsearch: "row-seven", label: "branch.lastupdat", HideVisible: false, disoperate: false },
    { branchColumn: "action", filtsearch: "row-eight", label: "branch.action", HideVisible: false, disoperate: false },
    // { branchColumn: "action", filtsearch: "row-nine", label: "course.courtitleAction", HideVisible: true, disoperate: true },
  ];
  // displayed column
  getBranchListData(): string[] {
    return this.BranchListData.filter(branch_list => branch_list.HideVisible).map(branch_list => branch_list.branchColumn);
  }
  // displayed search
  getBranchListDatasearch(): string[] {
    return this.BranchListData.filter(branch_list => branch_list.HideVisible).map(branch_list => branch_list.filtsearch);
  }
  // column edit function
  selectAllBranchListDataFun(event: any) {
    this.selectAllbranch = event.checked;
    this.BranchListData.forEach(item => {
      item.HideVisible = this.selectAllbranch;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllBranchListData(item: any) {
    const courseChecked = this.BranchListData.every(item => item.HideVisible);
    if (courseChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // branch end 
  // table course start
  courseListData = [
    { courseColumn: "appoct_coursename_en", filtsearch: "row-first", label: "course.courtitle", HideandVisible: true, disoperate: true },
    { courseColumn: "appoct_courseduration", filtsearch: "row-second", label: "course.courdura", HideandVisible: true, disoperate: false },
    { courseColumn: "appoct_courselevel", filtsearch: "row-three", label: "course.courlevel", HideandVisible: true, disoperate: false },
    { courseColumn: "ccm_catname_en", filtsearch: "row-four", label: "course.courcate", HideandVisible: true, disoperate: false },
    { courseColumn: "appoct_coursetested", filtsearch: "row-five", label: "course.courtest", HideandVisible: false, disoperate: true },
    { courseColumn: "appoct_status", filtsearch: "row-six", label: "course.stat", HideandVisible: true, disoperate: false },
    { courseColumn: "appoct_createdon", filtsearch: "row-seven", label: "course.addon", HideandVisible: true, disoperate: false },
    { courseColumn: "appoct_updatedon", filtsearch: "row-eight", label: "course.lastupdat", HideandVisible: false, disoperate: false },
    { courseColumn: "action", filtsearch: "row-nine", label: "course.Action", HideandVisible: true, disoperate: true },
  ]; 
  // displayed column
  getcourseListData(): string[] { 
    return this.courseListData.filter(course_list => course_list.HideandVisible).map(course_list => course_list.courseColumn);
  }
  // displayed search
  getcourseListDatasearch(): string[] {
    return this.courseListData.filter(course_list => course_list.HideandVisible).map(course_list => course_list.filtsearch);
  }
  // column edit function
  selectAllcourseListDataFun(event: any) {
    this.selectAllCourse = event.checked;
    this.courseListData.forEach(item => {
      item.HideandVisible = this.selectAllCourse;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllcourseListData(item: any) {
    const courseChecked = this.courseListData.every(item => item.HideandVisible);
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
  // table inspection start
  inspectionListData = [
    { inspectionColumn: "inspect_values", filt: "row-first", label: "Inspection Categories", VisibleData: true, disinspect: true },
    { inspectionColumn: "inspectstatus", filt: "row-second", label: "international.stat", VisibleData: true, disinspect: false },
    { inspectionColumn: "inspectcreatedon", filt: "row-three", label: "international.addon", VisibleData: true, disinspect: false },
    // { inspectionColumn: "inspectlastupdate", filt: "row-four", label: "international.lastupdat", VisibleData: false, disinspect: false },
    { inspectionColumn: "inspectAction", filt: "row-five", label: "international.Action", VisibleData: true, disinspect: true },
  ];
  // displayed column
  getinspectionListData(): string[] {
    return this.inspectionListData.filter(inspection_list => inspection_list.VisibleData).map(inspection_list => inspection_list.inspectionColumn);
  }
  // displayed search
  getinspectionListDatasearch(): string[] {
    return this.inspectionListData.filter(inspection_list => inspection_list.VisibleData).map(inspection_list => inspection_list.filt);
  }
  // column edit function
  selectAllinspectionListDataFun(event: any) {
    this.selectAllInspection = event.checked;
    this.inspectionListData.forEach(item => {
      item.VisibleData = this.selectAllInspection;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllinspectionListData(item: any) {
    const inspectChecked = this.inspectionListData.every(item => item.VisibleData);
    if (inspectChecked) {
      this.showandhideChkbox.checked = true;
    } else {
      this.showandhideChkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // table inspection end
  // table stafff start
  staffListData = [
    { staffcolumn: "sir_idnumber", srchFilt: "row-first", label: "staff.civinumb", DataVisible: true, disoperate: true },
    { staffcolumn: "sir_name_en", srchFilt: "row-second", label: "staff.staffname", DataVisible: true, disoperate: false },
    { staffcolumn: "sir_emailid", srchFilt: "row-three", label: "staff.email", DataVisible: false, disoperate: false },
    { staffcolumn: "age", srchFilt: "row-four", label: "staff.age", DataVisible: false, disoperate: false },
    { staffcolumn: "gender", srchFilt: "row-five", label: "staff.gender", DataVisible: true, disoperate: true },
    { staffcolumn: "ocym_countryname_en", srchFilt: "row-six", label: "staff.nation", DataVisible: true, disoperate: false },
    { staffcolumn: "rm_name_en", srchFilt: "row-seven", label: "staff.conttype", DataVisible: false, disoperate: false },
    { staffcolumn: "appsit_mainrole", srchFilt: "row-eight", label: "staff.mainrole", DataVisible: true, disoperate: false },
    // { staffcolumn: "inspection_categories",srchFilt: "row-typetwo", label: "Inspection Categories", DataVisible: false,disoperate: false },
    { staffcolumn: "appsit_status", srchFilt: "row-nine", label: "staff.stat", DataVisible: true, disoperate: true },
    { staffcolumn: "created_on", srchFilt: "row-ten", label: "staff.addon", DataVisible: false, disoperate: false },
    { staffcolumn: "updated_on", srchFilt: "row-eleven", label: "staff.lastupdat", DataVisible: false, disoperate: false },
    { staffcolumn: "action", srchFilt: "row-twelve", label: "staff.Action", DataVisible: true, disoperate: true },
  ];
  // displayed column
  getstaffListData(): string[] {
    return this.staffListData.filter(staff_list => staff_list.DataVisible).map(staff_list => staff_list.staffcolumn);
  }
  // displayed search
  getstaffListDatasearch(): string[] {
    return this.staffListData.filter(staff_list => staff_list.DataVisible).map(staff_list => staff_list.srchFilt);
  }
  // column edit function
  selectAllstaffListDataFun(event: any) {
    this.selectAllStaff = event.checked;
    this.staffListData.forEach(item => {
      item.DataVisible = this.selectAllStaff;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllstaffListData(item: any) {
    const staffChecked = this.staffListData.every(item => item.DataVisible);
    if (staffChecked) {
      this.staffChkbox.checked = true;
    } else {
      this.staffChkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // table staff end
  // table education start
  educationList = [
    { educateColumn: "sacd_institutename", srch: "row-first", label: "staff.instname", EduVisible: true, disoperate: true },
    { educateColumn: "sacd_degorcert", srch: "row-second", label: "staff.degecert", EduVisible: true, disoperate: false },
    { educateColumn: "sacd_edulevel", srch: "row-three", label: "staff.educlevel", EduVisible: true, disoperate: false },
    { educateColumn: "sacd_enddate", srch: "row-four", label: "staff.graddate", EduVisible: true, disoperate: false },
    { educateColumn: "certificatedoc", srch: "row-six", label: "staff.uploadcertifiacte", EduVisible: false, disoperate: true },
    { educateColumn: "sacd_grade", srch: "row-five", label: "staff.gpagrad", EduVisible: true, disoperate: false },
    { educateColumn: "sacd_createdon", srch: "row-seven", label: "staff.addon", EduVisible: false, disoperate: false },
    { educateColumn: "sacd_updatedon", srch: "row-eight", label: "staff.lastupdat", EduVisible: false, disoperate: false },
    { educateColumn: "action", srch: "row-nine", label: "staff.Action", EduVisible: true, disoperate: true },
  ];
  // displayed column
  geteducationList(): string[] {
    return this.educationList.filter(educate_list => educate_list.EduVisible).map(educate_list => educate_list.educateColumn);
  }
  // displayed search
  geteducationListsearch(): string[] {
    return this.educationList.filter(educate_list => educate_list.EduVisible).map(educate_list => educate_list.srch);
  }
  // column edit function
  selectAlleducationListFun(event: any) {
    this.selectAllEducation = event.checked;
    this.educationList.forEach(item => {
      item.EduVisible = this.selectAllEducation;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAlleducationList(item: any) {
    const EducateChecked = this.educationList.every(item => item.EduVisible);
    if (EducateChecked) {
      this.DataChkbox.checked = true;
    } else {
      this.DataChkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // table work end
  workExperienceList = [
    { workexperienceClm: "sexp_employername", workSrch: "row-first", label: "staff.empl", hideShow: true, disoperate: true },
    { workexperienceClm: "sexp_doj", workSrch: "row-second", label: "staff.datejoin", hideShow: true, disoperate: false },
    { workexperienceClm: "sexp_currentlyworking", workSrch: "row-three", label: "staff.worktill", hideShow: true, disoperate: false },
    { workexperienceClm: "sexp_opalcountrymst_fk", workSrch: "row-four", label: "staff.count", hideShow: true, disoperate: false },
    { workexperienceClm: "sexp_opalstatemst_fk", workSrch: "row-five", label: "staff.gove", hideShow: false, disoperate: true },
    { workexperienceClm: "sexp_opalcitymst_fk", workSrch: "row-six", label: "staff.wila", hideShow: true, disoperate: false },
    { workexperienceClm: "sexp_designation", workSrch: "row-seven", label: "staff.jobtitl", hideShow: false, disoperate: false },
    { workexperienceClm: "certificatedoc", workSrch: "row-document", label: "Uploaded Document", hideShow: false, disoperate: false },
    { workexperienceClm: "sexp_createdon", workSrch: "row-eight", label: "staff.addon", hideShow: false, disoperate: false },
    { workexperienceClm: "sexp_updatedon", workSrch: "row-nine", label: "staff.lastupdat", hideShow: false, disoperate: false },
    { workexperienceClm: "action", workSrch: "row-ten", label: "staff.Action", hideShow: true, disoperate: true },
  ];
  // displayed column
  getworkExperienceList(): string[] {
    return this.workExperienceList.filter(wrk => wrk.hideShow).map(wrk => wrk.workexperienceClm);
  }
  // displayed search
  getworkExperienceListsearch(): string[] {
    return this.workExperienceList.filter(wrk => wrk.hideShow).map(wrk => wrk.workSrch);
  }
  // column edit function
  selectAllworkExperienceListFun(event: any) {
    this.selectAllWork = event.checked;
    this.workExperienceList.forEach(item => {
      item.hideShow = this.selectAllWork;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllworkExperienceList(item: any) {
    const workChk = this.workExperienceList.every(item => item.hideShow);
    if (workChk) {
      this.chkWork.checked = true;
    } else {
      this.chkWork.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // table education end
  // courseListData = ['appoct_coursename_en', 'appoct_courseduration', 'appoct_courselevel', 'ccm_catname_en', 'appoct_coursetested', 'appoct_status', 'appoct_createdon', 'appoct_updatedon', 'action'];
  // staffListData = ['sir_idnumber', 'sir_name_en', 'sir_emailid', 'age', 'gender', 'ocym_countryname_en', 'rm_name_en', 'appsit_mainrole', 'appsit_status', 'created_on', 'updated_on', 'action'];
  // educationList = ['sacd_institutename', 'sacd_degorcert', 'sacd_edulevel', 'sacd_enddate', 'sacd_grade', 'certificatedoc', 'sacd_createdon', 'sacd_updatedon', 'action'];
  // workExperienceList = ['sexp_employername', 'sexp_doj', 'sexp_currentlyworking', 'sexp_opalcountrymst_fk', 'sexp_opalstatemst_fk', 'sexp_opalcitymst_fk', 'sexp_designation', 'certificatedoc', 'sexp_createdon', 'sexp_updatedon', 'action'];
  // inspectionListData = ['inspect_values', 'inspectstatus', 'inspectcreatedon', 'inspectAction'];
  public comanydetialsform: FormGroup;
  public instituteform: FormGroup;
  public awaredForm: FormGroup;
  public OperatorContractForm: FormGroup;
  public documentForm: FormGroup;
  public CourseForm: FormGroup;
  public staffForm: FormGroup;
  public staffFormedu: FormGroup;
  public staffworkexperienceForm: FormGroup;
  public courseselectForm: FormGroup;
  public dynamicForm: FormGroup;
  public matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  public sectorFilter: FormControl = new FormControl();
  public filteredBussrc: ReplaySubject<any> = new ReplaySubject<any>(1);
  public bussrcFilter: FormControl = new FormControl();
  public governoratelist: any;
  public wilayatlist: any;
  public memshpverify: boolean;
  public ShowHide: boolean = true;
  public operatcont: boolean = false;
  public international: boolean = false;
  public courses: boolean = false;
  public shownotetext: boolean = true;
  public selectedEstGovernorate: any;
  public autocal: any;
  public autocalper: any;
  public appdtlstmp_id: any;
  public staffrep_id: any;
  public appinterrec: any;
  public selectedEstGovernorateAr: any;
  public Submitted: boolean = true;
  public renewal: boolean = false;
  public decline: boolean = true;
  public staffformshow: boolean = false;
  public maxDate = new Date();
  public scrollTop: number;
  public resultsLength: number;
  public resultsLengthOpr: number;
  public resultsLengthCour: number;
  public resultsLengthStaffbas: number;
  public resultsLengthStaff: number;
  public resultsLengthStaffwork: number;
  public pageEvent: any;
  public filtername = "Hide Filter";
  public filternames = "Hide Filter";
  public selectoffice = '2';
  public selectofficePk: any;
  public selectcountry = '1';
  public hidefilder: boolean = true;
  public selected = "1";
  public length = '';
  public second = '';
  public third = '';
  public four = '';
  public payment: any = [];
  public record: any = [];
  public appstatus: any = '';
  public app_type: any = '';
  public prodpk: any = '';
  public apptemppk: any = '';
  public editOption: boolean = true;
  public updated: boolean = true;
  public isValid: boolean = true;
  public isValided: boolean = true;
  public valided: boolean = true;
  public validture: boolean = true;
  public checkboxdisable: boolean = false;
  perpage =
    BgiJsonconfigServices.bgiConfigData.configuration.enterpriseAdminPerpage;
  public pages: any;
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  @Input() tog: any = "";
  public dataSourceforpermission: any;
  public projectName: string
  public permissionarray: any;
  public finalpermissionarray: any = [];
  public page: number = 10;
  con = console;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
  @ViewChild('formFocus') scrollElement: ElementRef;
  @ViewChild('companylogo') companylogoFilee: Filee;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild('table', { read: MatSort }) sort: MatSort;
  @ViewChild('table1', { read: MatSort }) sortOpr: MatSort;
  @ViewChild('table2', { read: MatSort }) sortCour: MatSort;
  @ViewChild('table4', { read: MatSort }) sortStaff: MatSort;
  @ViewChild('table5', { read: MatSort }) sortEdu: MatSort;
  @ViewChild('table6', { read: MatSort }) sortWork: MatSort;
  FormMainTemplate = 'FormData';
  exp_aval = 0;
  oma_nval = 0;
  curr_learnval = 0;
  no_techstaffval = 0;
  autocalrat = 0;
  public memReg: any;
  public appdtlssavetmp_id: any;
  public insinfirtmp_Pk: any;
  public insinfirtmp_data: any;
  public intnatrecogmst_list: any;
  public contype_list: any;
  public selectedaward_organ: any;
  public selectedaward_organAr: any;
  public drvInputed: DriveInput;
  public drvInputedCom: DriveInput;
  public mogerInputed: DriveInput;
  public educationInput: DriveInput;
  public centreRequiredDocs: DriveInput[];
  public center_status: boolean = false;
  public aprdec_status: boolean = false;
  public notallowedone: boolean = false;
  public course_staff_status: boolean = false;
  public doc_id: any;
  public docmnt_list: any;
  public dynamicSelect: any = [];
  public flag: any = [];
  @ViewChild('awarddoc') awarddocFilee: Filee;
  @ViewChild('logo') logo: Filee;
  @ViewChild('complogo') compLogoFilee: Filee;
  @ViewChild('map') map: BgimapComponent;
  public mapMarkerLocation: string = '';
  public formGroup: FormGroup;
  @Input() locationType: number;
  @Output() private validation = new EventEmitter<any>();
  public enabled: boolean = true;
  public latitude: number;
  public longitude: number;
  public edit_arard: boolean = false;
  public edit_opr: boolean = false;
  public edit_cour: boolean = false;
  public edit_staff: boolean = false;
  public civil_num_val: any;
  public ageShow: boolean = true;
  public compdtls: any;
  public courseoptional: any;
  public coursesubcate: any;
  public mainrole: any;
  spinnerButtonOption: MatProgressButtonOptions = {
    active: false,
    text: 'Verified',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  public companyLogoFilee: any;
  public unitcodeForm: FormGroup;
  public drv_logo: DriveInput;
  public drv_logomain: DriveInput;
  @Input() mattab: number = 0;
  public companydtls: any;
  public configurationlist: any;
  public crnumverify: boolean;
  public moherigradinglist: any;
  public disableSubmitButton: boolean = false;
  // pagination search start
  public interRecListData: MatTableDataSource<any>;
  public interRecListDataOpr: MatTableDataSource<any>;
  public interRecListDataCour: MatTableDataSource<any>;
  public interRecListDataStaffbas: MatTableDataSource<any>;
  public interRecListDataStaffwork: MatTableDataSource<any>;
  public interRecListDataStaff: MatTableDataSource<any>;
  public Contentplaceloader: boolean = false;
  public tblplaceholder: boolean = false;
  public noData: any = '';
  public filtersts: boolean = true;
  public updatesupplierinfo: boolean = false;
  public mainIntrGridDatas: MainInsPagination;
  public mainIntrGridDatasOpr: MainOprPagination;
  public mainIntrGridDatasCour: MainCourPagination;
  public mainIntrGridDatasStaffbas: MainStaffbasPagination;
  public mainIntrGridDatasStaffwork: MainStaffworkPagination;
  public mainIntrGridDatasStaff: MainStaffPagination;
  private querystr: string;
  public searchControl: FormControl = new FormControl('');
  public ifarabic: boolean = false;
  public SearchResultOpr: any;
  public level_list: any;
  public courtest_list: any;
  public contrtype_list: any;
  public role_list: any;
  public rec_list: any;
  public cat_list: any;
  public subcat_list: any;
  public country_list: any;
  public state_list: any;
  public city_list: any;
  public state_tut_list: any;
  public city_tut_list: any;
  public state_work_list: any;
  public city_work_list: any;
  public stafflevel_list: any;
  public offercour_list: any;
  public courunt_list: any;
  public doc_list: any;
  public upload_name: any;
  public upload_mohr: any;
  public maximumdate = moment();
  public oman: boolean = true;
  public nonoman: boolean = true;
  //ifarabic: boolean = false;
  public companytmpdtls: any;
  public appintit_status: any;
  public appintit_appdecComments: any;
  public appintit_appdeccomment: any;
  public appoprct_status: any;
  public appoprct_appdeccomment: any;
  public appoct_status: any;
  public appoct_appdecComments: any;
  public appoct_appdeccomment: any;
  public resubmit_status: any;
  public decline_status: boolean = false;
  public appsit_status: any;
  public appsit_appdeccomment: any;
  public staffeduedit: boolean = false;
  public staffworkedit: boolean = false;
  public repocv: any;
  public omancountry: boolean = true;
  public norecord: boolean = false;
  public noDataone: any = '';
  public noDatatwo: any = '';
  public noDatathree: any = '';
  public noDatafour: any = '';
  public noDatafive: any = '';
  public businessUnitDataTemp: any;
  // pagination search end
  public expandedElement: boolean = false;
  public expandedElements: boolean = false;
  public worktilled: boolean = true;
  public noedit: boolean;
  public courread: boolean = false;
  public deleteicon: boolean = true;
  public workdeleteicon: boolean = true;
  expandedClass = 'expanded-class';
  // BranchListData = ['appdt_appreferno', 'appiit_branchname_en', 'appdt_status', 'certification', 'appdt_certificateexpiry', 'addedon', 'lastUpdated', 'action'];
  //TrainingBranchData = new MatTableDataSource<BranchData>(BranchList_Data);
  courseData = new MatTableDataSource<courseList>(Course_DATA);
  StaffList = new MatTableDataSource<staffData>(staff_DATA);
  education = new MatTableDataSource<educationData>(Eduction_DATA);
  workExperience = new MatTableDataSource<workexperienceData>(Work_DATA);
  @ViewChild("inspectPaginator") inspectPaginator: MatPaginator;

  FormTemplate = 'MainCentre';
  public staffform: boolean = false;
  public countryselect = '1';
  public genderselect: string = '';
  public genderShow: boolean = false;
  showotherdocument:boolean = true;
  public agefieldShow: boolean = false;
  //@ViewChild(MatSort) sort: MatSort;
  public ageinput: boolean = false;
  today = new Date();
  public drv_companylogo: DriveInput;
  public appdtls: any;
  public appmaindtls: any;
  public appmaindtlsprofile: any;
  public appstatusdtls: any;
  public addres: void;
  public appdtlssavetmpbranch_id: any;
  public ins_status: any;
  public dtlsmain: any;
  public dtlstmp: any;
  public mainres: any;
  public cert_path: any;
  public loaderform: boolean = false;
  public loaderformwork: boolean = false;
  public loaderformeducation: boolean = false;
  public getcurbranch: any;
  public web_url: any;
  public defaultofficetype: boolean = true;
  public finalsubmitbtn: boolean = true;
  public selectedDate: any;
  public diabledclass = true;
  public fileeducation = false;
  public fileemoheri = false;
  public countrydisable = true;
  public setexpiryrange = false;
  public rolesubcategory: any[] = [];
  public rolecategory_remove: any;
  public mainRoleListforPopup = [];
  public intlrecogname = [];
  public workexperiencedrvInputed: DriveInput;
  public idcarddrvInputed: DriveInput;
  public ropLicensedrvInputed: DriveInput;
  public molEmploymentdrvInputed: DriveInput;
  newDate = moment();
  newDate2 = moment().add(30, 'days');
  public projectpk: any;
  public InpectionCategary: boolean = false;
  public InpectionForm: FormGroup;
  public allSelected: boolean;
  @ViewChild('selectbox') selectbox: MatSelect;
  public selectedOption1: boolean = true;
  public selectedOption2: boolean = false;
  public requiredFordoc: boolean = true;
  public documentUploadForm: FormGroup;
  public tblplaceholders: boolean = false;
  public noEdit: boolean = false;
  public requiredwork: boolean = false;
  constructor(private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService,
    private remoteService: RemoteService,private profileService: ProfileService,private cookieService: CookieService,
    private appservice: ApplicationService,private regService: RegistrationService,private localStorage: AppLocalStorageServices,
    public toastr: ToastrService,private http: HttpClient,private fb: FormBuilder,private security: Encrypt, public routeid: ActivatedRoute, private route: Router,
) { }
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  spinnerButtonOptionsmem: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };

  spinnerButtonOptionscr: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
    this.remoteService.breadcrumCookieValueoutput(10);

    this.routeid.params.subscribe(params => {
      this.projectpk = this.security.decrypt(params['pkValue']);
      // alert(this.count)
      console.log('params' + this.projectpk)

      });
      if(this.projectpk == 1){
      var breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre',last:'true' },
          ]   
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
    }else{
      var breadCrumb ={
          title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
          urls: [
            { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre' ,last:'true' }
          ]
      };
    this.remoteService.breadcrumCookieValue(breadCrumb);
    }
      this.remoteService.getbreadcrumCookieoutput().subscribe(data => {
       
      if(data == 1){
        this.FormTemplate = 'MainCentre';
        this.clearFilterone();
      }
      if(data == 2){
       
        this.canclcourse();

      }
      if(data == 3){
       this.canclstaff();
      }
      //ras
      if(data == 4){
        this.CancelInpection();
       }
      });
    this.routeid.queryParams.subscribe(params => {
      if (params['type']) {
        if (params['type'] == 'apply') {
          this.appl_status.setValue(['1']);
        }

        if (params['type'] == 'yettocert') {
          this.appl_status.setValue([1, 2, 3]);
        }

        if (params['type'] == 'act') {
          this.appl_status.setValue([1, 2, 3]);
        }

      }
      if(params['p']) {
        this.projectpk = this.security.decrypt(params['p']);
      }
      var renew =this.security.decrypt(params['renew']);
      var ap = this.security.decrypt(params['ap']);
      var status = Number(this.security.decrypt(params['st']));
      if(renew == '1' && status == 17){
        var element ={appiit_applicationdtlstmp_fk : ap};
        this.editbranch(element,1)
      }else if(renew == '1' && (status == 2 || status == 4|| status ==7|| status == 19)){
        var element ={appiit_applicationdtlstmp_fk : ap};
        this.editbranch(element,3)
      }else if(renew == '1' && status == 3){
        var element ={appiit_applicationdtlstmp_fk : ap};
        this.editbranch(element,2)
      }else if(renew == '1' && ((status >= 5 && status <= 14) ||status == 18 )){
        var element ={appiit_applicationdtlstmp_fk : ap};
        this.makepayment(element,1,2,status)
      }
    });
   
    this.appservice.checkmainofficealreadyapplied().subscribe(res => {
      this.mainofficeapplied = res.data.checked;
      this.aleradycerified = res.data.aleradycerified;
      this.applied = res.data.applied;
      var datas =res.data.applieddata;

      this.aleradycerified_center = res.data.aleradycerified_center;
      this.applied_center = res.data.applied_center;
      var datas_center =res.data.applieddata_center;
       // this.registertype  1-opal star, 2.technical assessment, 3-both'
       this.registertype = this.localStorage.getInLocal("regtype");
      
     if(this.registertype == 1 && this.projectpk == 4){ 
       if(this.aleradycerified == 'no' && this.applied == 1){
        swal({
          title: this.i18n('Do you want to apply for Technical Inspection Centre Certification?'),
          text: '',
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.route.navigate(['vehiclemanagement/rascentre'],{ queryParams: { p: this.security.encrypt(4),s: this.security.encrypt(1)}});
          }else{
            this.route.navigate(['/dashboard/centre']);
          }
        });
       }else if(this.aleradycerified == 'yes'){

       }else if(this.applied == 5 || this.applied == 6 || this.applied == 7 || this.applied ==  8 || this.applied ==   9 || this.applied ==  18){
        this.route.navigate(['vehiclemanagement/rascentre'], { queryParams: { p: this.security.encrypt(datas.appdt_projectmst_fk), t: this.security.encrypt(datas.appdt_apptype), s: this.security.encrypt(datas.appdt_status), at: this.security.encrypt(datas.applicationdtlstmp_pk), bc: 'paycnt', f: 'mc'} });                              

       }else{
        this.route.navigate(['vehiclemanagement/rascentre'],{ queryParams: { p: this.security.encrypt(4),s: this.security.encrypt(1)}});
       }
      }else if(this.registertype == 2 && this.projectpk == 1){
        if(this.aleradycerified_center == 'no' && this.applied_center == 1){
          swal({
            title: this.i18n('Do you want to apply for Training Centre Certification?'),
            text: '',
            icon: 'warning',
            buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
              this.route.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { p: this.security.encrypt(1),s: this.security.encrypt(1)}});
            }else{
              this.route.navigate(['/dashboard/centre']);
            }
          });
         }else if(this.aleradycerified_center == 'yes'){
  
         }else if(this.applied_center == 5 || this.applied_center == 6 || this.applied_center == 7 || this.applied_center ==  8 || this.applied_center ==   9 || this.applied_center ==  18){
          this.route.navigate(['trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(datas_center.appdt_projectmst_fk), t: this.security.encrypt(datas_center.appdt_apptype), s: this.security.encrypt(datas_center.appdt_status), at: this.security.encrypt(datas_center.applicationdtlstmp_pk), bc: 'paycnt', f: 'mc'} });                              
  
         }else{
          this.route.navigate(['trainingcentremanagement/maincentre'],{ queryParams: { p: this.security.encrypt(1),s: this.security.encrypt(1)}});
         }
      }
    });

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
        this.filternames = "Hide Filter";
        this.ifarabic = false;
      } else {
        this.filtername = "إخفاء التصفية";
        this.filternames = "إخفاء التصفية";
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.filternames = "Hide Filter";
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
          this.filternames = "Hide Filter";
          this.ifarabic = false;
        } else {
          this.filtername = "إخفاء التصفية";
          this.filternames = "إخفاء التصفية";
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.filternames = "Hide Filter";
        this.ifarabic = false;
      }
    });
    this.getrasinspectioncategory();
    this.getrasrole();
    this.checkQueryParams();
    this.formvalidated();
    this.getGoverenoratelist();
    this.getconfigurations();
    this.getMoherigradinglist();
    if (this.ReferralsFormArr.length == 10) {
      this.ReferralsFormArr.push(
        this.formBuilder.group({
          unit_titl: ['', Validators.required],
          unit_code: ['', Validators.required],
        })
      );
    }

    this.memReg = this.localStorage.getInLocal('reg_pk');
    //this.getCompDtls();
    this.formvalidated();
    this.getGoverenoratelist();
    this.getconfigurations();
    this.getMoherigradinglist();
    //this.getRegAppDtls();
    this.getRegAppDtls();
    this.getintrtrlist();
    this.leveldropdown();
    this.catdropdown();
    //this.subcatdropdown(1);
    this.courtestdropdown();
    this.countrydropdown();
    this.contrtyprdropdown();
    this.roledropdown();
    this.staffleveldropdown();
    this.onoffice();
    // this.instituteform.controls['offtype'].setValue(2);
    if (this.projectpk == 1) {
      this.instituteform.controls['offtype'].setValue(2);
    } 
    // else {
    //   this.selectoffice = '';
    // }
    this.mogerInputed = {
      fileMstPk: 3,
      selectedFilesPk: []
    };

    this.drv_logo = {
      fileMstPk: 8,
      selectedFilesPk: []
    };

    this.educationInput = {
      fileMstPk: 1,
      selectedFilesPk: []
    };
    this.workexperiencedrvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    }
    this.idcarddrvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    }
    this.ropLicensedrvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    }
    this.molEmploymentdrvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    }
  
   
    this.maxDate.setFullYear(new Date().getFullYear() - 18);
    //this.onbranch();

    this.staffForm.controls['count_ry'].setValue('31');
    this.statedropdown(31);

    // do stuff
    this.CourseForm.controls['cousesub_category'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.subcat_list.findIndex(x => x.coursecategorymst_pk == value[0]);
        if (index !== -1) {
          this.coursesubcate = this.subcat_list[index].ccm_catname_en;

        }
      } else {
        this.coursesubcate = '';
      }
    });
    this.staffForm.controls['role'].valueChanges.subscribe(value => {
      this.mainRoleListforPopup = [];
      if (value) {
        let index = this.role_list.findIndex(x => x.rolemst_pk == value[0]);
        if (index !== -1) {
          this.mainrole = this.role_list[index].rm_rolename_en;

        }
        if (value.length > 1) {
          value.forEach(element => {
            let indexnew = this.role_list.findIndex(x => x.rolemst_pk == element);
            if (indexnew !== 0) {
              this.mainRoleListforPopup.push(this.role_list[indexnew].rm_rolename_en);
            }
          });
        }
        else {
          this.mainRoleListforPopup = [];
        }
      } else {
        this.mainrole = '';
        this.mainRoleListforPopup = [];

      }
    });
    this.staffForm.controls['role'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.rolesinstaff.findIndex(x => x.rolemst_pk == value[0]);
        // console.log(index + '34')
        if (index !== -1) {
          this.mainrole = this.rolesinstaff[index].rm_rolename_en;
 
        }
      } else {
        this.mainrole = '';
      }
    });
    this.CourseForm.controls['inter_organ'].valueChanges.subscribe(value => {
      this.intlrecogname = [];

      if (value) {
        let index = this.rec_list.findIndex(x => x.appintrecogtmp_pk == value[0]);
        if (index !== -1) {
          this.courseoptional = this.rec_list[index].irm_intlrecogname_ar;
        }
        if (value.length > 1) {
          value.forEach(element => {
            let indexnew = this.rec_list.findIndex(x => x.appintrecogtmp_pk == element);
            if (indexnew !== 0) {
              this.intlrecogname.push(this.rec_list[indexnew].irm_intlrecogname_ar);
            }
          });
        }
        else {
          this.intlrecogname = [];
        }
      } else {
        this.courseoptional = '';
        this.intlrecogname = [];
      }
    });

    this.staffForm.controls['gend_er'].valueChanges.subscribe(value => {
      if (this.staffForm.controls.gend_er.value == 1) {
        this.genderselect = '1';
        this.genderShow = true;
        this.staffForm.controls.gender_address.setValue(this.i18n('staff.mr'))
      }
      else if (this.staffForm.controls.gend_er.value == 2) {
        this.genderselect = '2';
        this.genderShow = true;
        this.staffForm.controls.gender_address.setValue(this.i18n('staff.ms'))
      }
      else {
        this.genderselect = ' ';
      }
    });

    //Awarding Search starts here
    this.appl_form = new FormControl('');
    this.appl_form.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        }
      }
    )

    this.bran_name = new FormControl('');
    this.bran_name.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        }
      }
    )

    this.appl_status = new FormControl('');
    this.appl_status.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        }
      }
    )

    this.cert = new FormControl('');
    this.cert.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        }
      }
    )

    this.date_expiry = new FormControl('');
    this.date_expiry.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        }
      }
    )

    this.addedon_branch = new FormControl('');
    this.addedon_branch.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        }
      }
    )

    this.lastUpdated_branch = new FormControl('');
    this.lastUpdated_branch.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getInterRecDtls();
        }
      }
    )
    //Awarding Search Ends here

    //Staff 6 th tab Search starts here
    this.course_title = new FormControl('');
    this.course_title.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )

    this.course_dura = new FormControl('');
    this.course_dura.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )

    this.course_level = new FormControl('');
    this.course_level.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )

    this.course_cate = new FormControl('');
    this.course_cate.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )

    this.course_test = new FormControl('');
    this.course_test.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )

    this.StatusCour = new FormControl('');
    this.StatusCour.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )

    this.adddoncour = new FormControl('');
    this.adddoncour.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )

    this.LastUpdatedcour = new FormControl('');
    this.LastUpdatedcour.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getCourDtls();
        }
      }
    )
    //Staff 6 th tab Search Ends here

    //Staff 7 th tab Search starts here
    this.civil_numb = new FormControl('');
    this.civil_numb.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    this.staff_name = new FormControl('');
    this.staff_name.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    this.email_id = new FormControl('');
    this.email_id.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    this.gender = new FormControl('');
    this.gender.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    // this.dob = new FormControl('');
    // this.dob.valueChanges.debounceTime(400).subscribe(
    //   register => {  
    //     if (register != null ) {
    //       this.paginator.pageIndex = 0;
    //       this.getStaffDtls();   
    //     }else if(register == ''){
    //       this.paginator.pageIndex = 0;
    //       this.getStaffDtls();   
    //     }    
    //   }
    // )

    this.Nation = new FormControl('');
    this.Nation.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    this.cont_type = new FormControl('');
    this.cont_type.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    this.main_role = new FormControl('');
    this.main_role.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )


    this.status_cour = new FormControl('');
    this.status_cour.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    this.addd_oncour = new FormControl('');
    this.addd_oncour.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )

    this.LastUpdatedstaff = new FormControl('');
    this.LastUpdatedstaff.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffDtls();
        }
      }
    )
    //Staff 7 th tab Search Ends here

    //Staff Edu th tab Search starts here
    this.institute = new FormControl('');
    this.institute.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        }
      }
    )

    this.degree = new FormControl('');
    this.degree.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        }
      }
    )

    this.year_join = new FormControl('');
    this.year_join.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        }
      }
    )

    this.year_pass = new FormControl('');
    this.year_pass.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        }
      }
    )

    this.grade = new FormControl('');
    this.grade.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        }
      }
    )

    this.add_On = new FormControl('');
    this.add_On.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        }
      }
    )

    this.Last_Date = new FormControl('');
    this.Last_Date.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffbasDtls(this.staffrep_id);
        }
      }
    )
    //Staff Edu th tab Search Ends here

    //Staff Work th tab Search starts here
    this.oranisation = new FormControl('');
    this.oranisation.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        }
      }
    )

    this.date_joined = new FormControl('');
    this.date_joined.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        }
      }
    )

    this.work_till = new FormControl('');
    this.work_till.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        }
      }
    )

    this.designation = new FormControl('');
    this.designation.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        }
      }
    )

    this.add_edOn = new FormControl('');
    this.add_edOn.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        }
      }
    )

    this.add_On = new FormControl('');
    this.add_On.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        }
      }
    )

    this.date_last = new FormControl('');
    this.date_last.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getStaffworkDtls(this.staffrep_id);
        }
      }
    )
    //Staff Work th tab Search Ends here

    this.maxDate.setFullYear(new Date().getFullYear() - 18);
   
    this.staffForm.controls['date_birth'].valueChanges.subscribe(value => {
    
      let m = moment();
      let years = m.diff(value, 'years');
      m.add(-years, 'years');
      let months = m.diff(value, 'months');
      m.add(-months, 'months');
      let days = m.diff(value, 'days');
      this.ageShow = false;
      this.staffForm.controls.age.setValue(years)

    })
    this.staffForm.controls['gend_er'].valueChanges.subscribe(value => {
      if (this.staffForm.controls.gend_er.value == 1) {
        this.genderselect = '1';
        this.genderShow = true;
        this.staffForm.controls.gender_address.setValue(this.i18n('staff.mr'))
      }
      else if (this.staffForm.controls.gend_er.value == 2) {
        this.genderselect = '2';
        this.genderShow = true;
        this.staffForm.controls.gender_address.setValue(this.i18n('staff.ms'))
      }
      else {
        this.genderselect = ' ';
      }
    });

    this.viewinvoice();

    this.onchangecount();
    if (this.projectpk == 1) {
      this.BranchListData = [
        { branchColumn: "appdt_appreferno", filtsearch: "row-first", label: "branch.applform", HideVisible: true, disoperate: true },
        { branchColumn: "appiit_branchname_en", filtsearch: "row-second", label: "branch.branchname", HideVisible: false, disoperate: false },
        { branchColumn: "appdt_status", filtsearch: "row-three", label: "branch.applstat", HideVisible: true, disoperate: false },
        { branchColumn: "certification", filtsearch: "row-four", label: "branch.certstat", HideVisible: true, disoperate: false },
        { branchColumn: "appdt_certificateexpiry", filtsearch: "row-five", label: "branch.dateofexpi", HideVisible: true, disoperate: true },
        { branchColumn: "addedon", filtsearch: "row-six", label: "branch.addon", HideVisible: true, disoperate: true },
        { branchColumn: "lastUpdated", filtsearch: "row-seven", label: "branch.lastupdat", HideVisible: false, disoperate: false },
        { branchColumn: "action", filtsearch: "row-eight", label: "branch.action", HideVisible: true, disoperate: false },
      ];
     this.staffListData = [
        { staffcolumn: "sir_idnumber", srchFilt: "row-first", label: "staff.civinumb", DataVisible: true, disoperate: true },
        { staffcolumn: "sir_name_en", srchFilt: "row-second", label: "staff.staffname", DataVisible: true, disoperate: false },
        { staffcolumn: "sir_emailid", srchFilt: "row-three", label: "staff.email", DataVisible: false, disoperate: false },
        { staffcolumn: "age", srchFilt: "row-four", label: "staff.age", DataVisible: false, disoperate: false },
        { staffcolumn: "gender", srchFilt: "row-five", label: "staff.gender", DataVisible: true, disoperate: true },
        { staffcolumn: "ocym_countryname_en", srchFilt: "row-six", label: "staff.nation", DataVisible: true, disoperate: false },
        { staffcolumn: "rm_name_en", srchFilt: "row-seven", label: "staff.conttype", DataVisible: false, disoperate: false },
        { staffcolumn: "appsit_mainrole", srchFilt: "row-eight", label: "staff.mainrole", DataVisible: true, disoperate: false },
        // { staffcolumn: "inspection_categories",srchFilt: "row-typetwo", label: "Inspection Categories", DataVisible: false,disoperate: false },
        { staffcolumn: "appsit_status", srchFilt: "row-nine", label: "staff.stat", DataVisible: true, disoperate: true },
        { staffcolumn: "created_on", srchFilt: "row-ten", label: "staff.addon", DataVisible: false, disoperate: false },
        { staffcolumn: "updated_on", srchFilt: "row-eleven", label: "staff.lastupdat", DataVisible: false, disoperate: false },
        { staffcolumn: "action", srchFilt: "row-twelve", label: "staff.Action", DataVisible: true, disoperate: true },
      ];
    } else {
      this.BranchListData = [
        { branchColumn: "appdt_appreferno", filtsearch: "row-first", label: "branch.applform", HideVisible: true, disoperate: true },
        { branchColumn: "appdt_officeType", filtsearch: "row-officetype", label: "institute.offitype", HideVisible: true, disoperate: true },
        { branchColumn: "appiit_branchname_en", filtsearch: "row-second", label: "branch.branchname", HideVisible: false, disoperate: false },
        { branchColumn: "appdt_status", filtsearch: "row-three", label: "branch.applstat", HideVisible: true, disoperate: false },
        { branchColumn: "certification", filtsearch: "row-four", label: "branch.certstat", HideVisible: true, disoperate: false },
        { branchColumn: "appdt_certificateexpiry", filtsearch: "row-five", label: "branch.dateofexpi", HideVisible: true, disoperate: true },
        { branchColumn: "addedon", filtsearch: "row-six", label: "branch.addon", HideVisible: true, disoperate: false },
        { branchColumn: "lastUpdated", filtsearch: "row-seven", label: "branch.lastupdat", HideVisible: false, disoperate: false },
        { branchColumn: "action", filtsearch: "row-eight", label: "branch.action", HideVisible: true, disoperate: false },
      ];
      this.staffListData = [
        { staffcolumn: "sir_idnumber", srchFilt: "row-first", label: "staff.civinumb", DataVisible: true, disoperate: true },
        { staffcolumn: "sir_name_en", srchFilt: "row-second", label: "staff.staffname", DataVisible: true, disoperate: false },
        { staffcolumn: "sir_emailid", srchFilt: "row-three", label: "staff.email", DataVisible: false, disoperate: false },
        { staffcolumn: "age", srchFilt: "row-four", label: "staff.age", DataVisible: false, disoperate: false },
        { staffcolumn: "gender", srchFilt: "row-five", label: "staff.gender", DataVisible: true, disoperate: true },
        { staffcolumn: "ocym_countryname_en", srchFilt: "row-six", label: "staff.nation", DataVisible: true, disoperate: false },
        { staffcolumn: "rm_name_en", srchFilt: "row-seven", label: "staff.conttype", DataVisible: false, disoperate: false },
        { staffcolumn: "appsit_mainrole", srchFilt: "row-eight", label: "Roles", DataVisible: true, disoperate: false },
        { staffcolumn: "appsit_apprasvehinspcattmp_fk", srchFilt: "row-typetwo", label: "Inspection Categories", DataVisible: true, disoperate: false },
        { staffcolumn: "appsit_status", srchFilt: "row-nine", label: "staff.stat", DataVisible: true, disoperate: true },
        { staffcolumn: "appsit_compcard", srchFilt: "row-compcard", label: "Competency Card", DataVisible: false, disoperate: true },
        { staffcolumn: "created_on", srchFilt: "row-ten", label: "staff.addon", DataVisible: false, disoperate: false },
        { staffcolumn: "updated_on", srchFilt: "row-eleven", label: "staff.lastupdat", DataVisible: false, disoperate: false },
        { staffcolumn: "action", srchFilt: "row-twelve", label: "staff.Action", DataVisible: true, disoperate: true },
      ];
    }
    this.checkValidation();
    this.breadCrumb()
  }
  // ngonint end

  getage(value) {
    let m = moment();
    let years = m.diff(value, 'years');
    m.add(-years, 'years');
    let months = m.diff(value, 'months');
    m.add(-months, 'months');
    let days = m.diff(value, 'days');

    return years;
  }



  ngAfterViewInit() {

    this.routeid.queryParams.subscribe(params => {
      if (params['type']) {
        if (params['type'] == 'apply') {
          // this.appl_status.setValue(['1']);
          this.appl_status.setValue(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '20']);
        }

        if (params['type'] == 'yettocert') {
          this.cert.setValue(['1']);
          //   this.appl_status.setValue(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16']);
        }

        if (params['type'] == 'act') {
          this.cert.setValue(['2']);
          // this.appl_status.setValue(['17']);
        }

        if (params['type'] == 'NearingExpiry') {
          this.cert.setValue(['2']);

          this.setexpiryrange = true;
          // this.appl_status.setValue(['17']);
        }
        if (params['type'] == 'expired') {
          this.cert.setValue(['3']);
        }
        if (params['type'] == 'suspended') {
          this.appl_status.setValue(['19']);
        }

      }
    });

    this.checkQueryParams();
  }
  //check query params to redirect the pament page & site audit page   
  checkQueryParams() {
    this.routeid.queryParams.subscribe(params => {
      this.appstatus = this.security.decrypt(params['s']);
      this.app_type = this.security.decrypt(params['t']);
      this.prodpk = this.security.decrypt(params['p']);
      this.apptemppk = this.security.decrypt(params['at']);
      
      if (this.appstatus == 5 || this.appstatus == 6 || this.appstatus == 7 || this.appstatus == 8 || this.appstatus == 9 || this.appstatus == 18) {
        this.disableSubmitButton = true;
       
        this.appservice.getpaymentinfo(this.apptemppk, 1).subscribe(res => {
          if (res.status == 200) {
            setTimeout(() => {
          if(this.projectpk == 1){
            if(this.appstatus == 5 || this.appstatus == 6 ||  this.appstatus == 18){
              var breadCrumb ={
                title: 'Training Centre Certification',
                urls: [
                  { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) },
                  { title: 'Payment', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
                ]
            };
          }else{
            var breadCrumb ={
              title: 'Training Centre Certification',
              urls: [
                { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) },
                { title: 'Site Audit', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
              ]
          };
          }
            this.remoteService.breadcrumCookieValue(breadCrumb);
          }else{
            if(this.appstatus == 5 || this.appstatus == 6 ||  this.appstatus == 18){
            var breadCrumb ={
              title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
              urls: [
                { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre/'+this.security.encrypt(4) },
                { title: 'Payment', url: 'vehiclemanagement/rasbranchcentre'+this.security.encrypt(4),last:'true' }
              ]
          };
          }else{
            var breadCrumb ={
              title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
              urls: [
                { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre/'+this.security.encrypt(4) },
                { title: 'Site Audit', url: 'vehiclemanagement/rasbranchcentre'+this.security.encrypt(4),last:'true' }
              ]
          };
          }
          this.remoteService.breadcrumCookieValue(breadCrumb);
          }
              this.payment = res.data.payment;
              this.record = res.data.record;
              this.FormTemplate = 'payment';
              this.disableSubmitButton = false;
            }, 1000);
          }
        });
      } else {
        this.getRegAppDtls();
        this.FormTemplate = 'MainCentre';
      }
    });

  }

  getRegAppDtls() {
    this.disableSubmitButton = true;
    this.appservice.getappregdtls(this.projectpk).subscribe(response => {
      if (response.data.status == 1) {
        this.companydtls = response.data.data;

        if (this.companydtls.omrm_cmplogo) {
          this.drv_logo.selectedFilesPk = [this.companydtls.omrm_cmplogo];
          setTimeout(() => {
            this.logo.triggerChange();
          }, 1000);
        }
        this.web_url = response.data.web_url;

        this.appservice.getComDtls(this.memReg,this.projectpk).subscribe(datares => {

          if (datares.data.data) {
            this.compdtls = this.compdtls = datares.data.data;
            this.appdtlssavetmpbranch_id = datares.data.data.applicationdtlstmp_pk;
            this.appstatusdtls = datares.data.appStatus;
            this.appdtls = datares.data.data;
            console.log(datares.data.data, 'regdata');
            this.recdropdown();
            this.appservice.getAppMainDtls(this.appdtlssavetmpbranch_id, '1').subscribe(dataresmain => {
              this.disableSubmitButton = false;
              if (dataresmain.data.data) {
                this.appmaindtls = dataresmain.data.data;
              }
            });

          } else {
            this.disableSubmitButton = false;
          }
        });

        this.getInterRecDtls();

      }
    });
  
  }

  getInterRecDtls() {
    this.tblplaceholder = true;
   
    this.LoaderForNorecord = true;
    this.mainIntrGridDatas = new MainInsPagination(this.http);
    this.sort?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { appl_form: this.appl_form.value, bran_name: this.bran_name.value, appl_status: this.appl_status.value, cert: this.cert.value, date_expiry: this.date_expiry.value, addedon_branch: this.addedon_branch.value, lastUpdated_branch: this.lastUpdated_branch.value, };

    merge(this.sort?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';

          return this.mainIntrGridDatas.interRecGridUtil(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.memReg,this.projectpk);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        console.log('branch data', data);
        this.interRecListData = new MatTableDataSource(data);
        this.interRecListData.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noData = this.interRecListData.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
        this.LoaderForNorecord = false;
      });
  }



  saveInsFormDetails() {

    if (this.instituteform.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveinsdtls(this.instituteform.value, this.appdtlssavetmpbranch_id,this.projectpk).subscribe(data => {
        // this.insinfirtmp_Pk = data.data.data;

        this.appdtlssavetmp_id = data.data.data.appiit_applicationdtlstmp_fk;
        this.insinfirtmp_Pk = data.data.data.appinstinfotmp_pk;
        this.getCurBranch(this.appdtlssavetmp_id);
        this.instituteform.controls['appinstinfotmp_pk'].setValue(this.insinfirtmp_Pk);
        this.instituteform.controls['appdtlstmp_pk'].setValue(this.appdtlssavetmp_id);
        this.getCenterStatus(this.appdtlssavetmp_id);
        this.getDeclinedStatus(this.appdtlssavetmp_id);
        this.getRegAppDtls();
        this.center_status = true;
        this.toastr.success(this.i18n('maincenter.instinfosave'), ''), {
          timeOut: 2000,
          closeButton: false,
        };

        this.mattab = 1;
        this.scrollTo('pagescroll');
        
        this.disableSubmitButton = false;
      });
    } else {
      this.focusInvalidInput(this.instituteform);
    }

  }

  getCurBranch(value) {
    this.appservice.getCurBranch(value).subscribe(data => {
      this.getcurbranch = data.data;
      console.log("this.getcurbranch", this.getcurbranch);
    });

  }

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    
  }

  fileeSelectedDoc(file, fileId) {
    fileId.selectedFilesPk = file;

  }

  fileeSelectedLogo(file, fileId) {
    fileId.selectedFilesPk = file;
    this.comanydetialsform.controls['upload'].setValue(file);

  }
  fileeSelectededucate(file, fileId) {
    fileId.selectedFilesPk = file;
    this.staffFormedu.controls['education_files'].setValue(file[0]);

  }
  fileeSelectedwork(file, fileId) {
    fileId.selectedFilesPk = file;
    var length = file.length - 1;
    this.staffworkexperienceForm.controls['file_workexperience'].setValue(file[length]);
  }
  fileeSelectedCard(file, fileId) {
    fileId.selectedFilesPk = file;
    var length = file.length - 1;
    this.documentUploadForm.controls['id_card'].setValue(file[length]);
  }
  fileeSelectedRop(file, fileId) {
    fileId.selectedFilesPk = file;
    var length = file.length - 1;
    this.documentUploadForm.controls['file_ropLicense'].setValue(file[length]);
  }
  fileeSelectedmol(file, fileId) {
    fileId.selectedFilesPk = file;
    var length = file.length - 1;
    this.documentUploadForm.controls['file_molEmployment'].setValue(file[length]);
  }
  getLocationDetails(value) {
    this.instituteform.controls['lat'].setValue(100);
    this.instituteform.controls['lang'].setValue(200);
    //this.setAutoFetchedLocations(value.countryName, value.stateName, value.cityName);
  }

  get form() { if (this.comanydetialsform != undefined) { return this.comanydetialsform.controls; } }
  get inst() { if (this.instituteform != undefined) { return this.instituteform.controls; } }
  get awar() { if (this.awaredForm != undefined) { return this.awaredForm.controls; } }
  get operator() { if (this.OperatorContractForm != undefined) { return this.OperatorContractForm.controls; } }
  get mark() { if (this.documentForm != undefined) { return this.documentForm.controls; } }
  get cour() { if (this.CourseForm != undefined) { return this.CourseForm.controls; } }
  get staf() { if (this.staffForm != undefined) { return this.staffForm.controls; } }
  get stafedu() { if (this.staffFormedu != undefined) { return this.staffFormedu.controls; } }
  get work() { if (this.staffworkexperienceForm != undefined) { return this.staffworkexperienceForm.controls; } }
  get course() { if (this.courseselectForm != undefined) { return this.courseselectForm.controls; } }
  get inspect()  { return this.InpectionForm.controls;  } 


  roundedNum: any = '';
  getAutoCal(exp_aval, oma_nval) {
    this.autocal = this.convertToInt(exp_aval) + this.convertToInt(oma_nval);
    this.autocalper = this.convertToInt(oma_nval) / this.autocal * 100;

    this.instituteform.controls['tot_oman'].setValue(this.autocal);
    this.instituteform.controls['oman_percen'].setValue(this.autocalper + '%');
    console.log(this.roundedNum);
  }

  getAutoRatCal(curr_learnval, no_techstaffval) {
    this.autocalrat = this.convertToInt(curr_learnval) / this.convertToInt(no_techstaffval);
    this.instituteform.controls['ratio_tech'].setValue('1:' + Math.floor(this.autocalrat));
    //}
  }

  getCompDtls() {
    // this.memReg = this.localStorage.getInLocal('reg_pk');
    // this.appservice.getComDtls(this.memReg).subscribe(response => {
    //    if(response.data.data){
    //     this.appdtlssavetmp_id= response.data.data.applicationdtlstmp_pk;

    //       if(this.appdtlssavetmp_id){
    //         this.getCenterStatus(this.appdtlssavetmp_id);
    //         this.center_status = true;
    //         this.appservice.getInsInforDtls(this.appdtlssavetmp_id, '1').subscribe(responseInfor => {

    //           if(responseInfor.data.data){
    //             this.insinfirtmp_Pk= responseInfor.data.data.appinstinfotmp_pk;
    //             this.insinfirtmp_data = responseInfor.data.data;

    //             this.instituteform.patchValue({
    //               exp_a: responseInfor.data.data.appiit_noofexpat,
    //               oma_n: responseInfor.data.data.appiit_noofomani,
    //               molpercent: responseInfor.data.data.appiit_molpercent,
    //               no_techstaff: responseInfor.data.data.appiit_nooftechstaff,
    //               curr_learn: responseInfor.data.data.appiit_noofcurlearners,
    //               trainprovmax: responseInfor.data.data.appiit_maxcapacity,
    //               appinstinfotmp_pk: responseInfor.data.data.appinstinfotmp_pk,
    //              });
    //             this.getAutoCal(responseInfor.data.data.appiit_noofexpat, responseInfor.data.data.appiit_noofomani);
    //             this.getAutoRatCal(responseInfor.data.data.appiit_noofcurlearners,responseInfor.data.data.appiit_nooftechstaff);




    //           }
    //         });

    //         this.appservice.getCompanyDtls(this.appdtlssavetmp_id).subscribe(datacomp => {

    //           if(datacomp.data.data){
    //             this.companytmpdtls = datacomp.data.data;
    //           }
    //         });

    //         this.getInterRecDtls();

    //         this.getOprContrDtls();

    //         this.recdropdown();

    //         this.getCourDtls();

    //         //this.getStaffbasDtls();

    //         //this.getStaffworkDtls();

    //         this.getStaffDtls();

    //         this.opercourdropdown(this.appdtlssavetmp_id);                

    //       }
    //   }
    //       this.getdoc(this.appdtlssavetmp_id);
    // });


  }

  getdoc(appdtlssavetmp_id) {


  }


  getOprContrDtls() {
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo = false;
    this.mainIntrGridDatasOpr = new MainOprPagination(this.http);
    this.sortOpr?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { operatorname: this.operatorname.value, contracttype: this.contracttype.value, contractstart: this.contractstart.value, contractend: this.contractend.value, addedon: this.addedon.value, lastUpdated: this.lastUpdated.value, Statusone: this.Statusone.value };
    merge(this.sortOpr?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.mainIntrGridDatasOpr.interOprGridUtil(this.sortOpr.active, this.sortOpr.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.appdtlssavetmp_id);
        }),
        map(data => {
          this.resultsLengthOpr = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListDataOpr = new MatTableDataSource(data);
        this.interRecListDataOpr.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noDataone = this.interRecListDataOpr.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;

      });
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getInterRecDtls();
    this.Contentplaceloader = true;
    
  }

  getCourDtls() {
    this.LoaderForNorecords = true;
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo = false;
    this.mainIntrGridDatasCour = new MainCourPagination(this.http);
    this.sortCour?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { course_title: this.course_title.value, course_dura: this.course_dura.value, course_level: this.course_level.value, course_cate: this.course_cate.value, course_test: this.course_test.value, StatusCour: this.StatusCour.value, adddoncour: this.adddoncour.value, LastUpdatedcour: this.LastUpdatedcour.value, LastUpdatedstaffdate: this.LastUpdatedstaffdate.value };
    merge(this.sortCour?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.mainIntrGridDatasCour.interCourGridUtil(this.sortCour.active, this.sortCour.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.appdtlssavetmp_id);
        }),
        map(data => {
          this.resultsLengthCour = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListDataCour = new MatTableDataSource(data);
        this.interRecListDataCour.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noDatatwo = this.interRecListDataCour.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
        this.LoaderForNorecords = false;

      });
  }

  getStaffbasDtls(stfrepo) {
    this.Norecordsloadereducte = true;
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo = false;
    this.mainIntrGridDatasStaffbas = new MainStaffbasPagination(this.http);
    this.sortEdu?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { institute: this.institute.value, degree: this.degree.value, year_join: this.year_join.value, year_pass: this.year_pass.value, grade: this.grade.value, add_On: this.add_On.value, Last_Date: this.Last_Date.value };

    merge(this.sortEdu?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';

          return this.mainIntrGridDatasStaffbas.interStaffbasGridUtil(this.sortEdu.active, this.sortEdu.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.appdtlssavetmp_id, this.memReg, stfrepo);
        }),
        map(data => {
          this.resultsLengthStaffbas = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListDataStaffbas = new MatTableDataSource(data);
        this.interRecListDataStaffbas.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noDatathree = this.interRecListDataStaffbas.connect().pipe(map(data => data.length === 0));
        this.Norecordsloadereducte = false;
        this.tblplaceholder = false;

      });
  }

  getStaffworkDtls(stfrepo) {
    this.Norecordsloaderwork = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo = false;
    this.mainIntrGridDatasStaffwork = new MainStaffworkPagination(this.http);
    this.sortWork?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { oranisation: this.oranisation.value, date_joined: this.date_joined.value, work_till: this.work_till.value, designation: this.designation.value, add_edOn: this.add_edOn.value, date_last: this.date_last.value };
    merge(this.sortWork?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.mainIntrGridDatasStaffwork.interStaffworkGridUtil(this.sortWork.active, this.sortWork.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.appdtlssavetmp_id, this.memReg, stfrepo);
        }),
        map(data => {
          this.resultsLengthStaffwork = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListDataStaffwork = new MatTableDataSource(data);
        this.interRecListDataStaffwork.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noDatafour = this.interRecListDataStaffwork.connect().pipe(map(data => data.length === 0));
        this.Norecordsloaderwork = false;

      });
  }

  getStaffDtls() {
    this.Norecordsloader = true;
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo = false;
    this.mainIntrGridDatasStaff = new MainStaffPagination(this.http);
    this.sortStaff?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { civil_numb: this.civil_numb.value, staff_name: this.staff_name.value, email_id: this.email_id.value, gender: this.gender.value, Nation: this.Nation.value, cont_type: this.cont_type.value, main_role: this.main_role.value, status_cour: this.status_cour.value, addd_oncour: this.addd_oncour.value, LastUpdatedstaff: this.LastUpdatedstaff.value };
    merge(this.sortStaff?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.mainIntrGridDatasStaff.interStaffGridUtil(this.sortStaff.active, this.sortStaff.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.appdtlssavetmp_id, this.memReg,this.projectpk);
        }),
        map(data => {
          this.resultsLengthStaff = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListDataStaff = new MatTableDataSource(data);
        this.interRecListDataStaff.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noDatafive = this.interRecListDataStaff.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
        this.Norecordsloader = false;

      });
  }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function (data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.mcm_RegistrationNo.toLowerCase().indexOf(searchTerms.mcm_RegistrationNo) !== -1 &&
        data.MCM_SupplierCode.toLowerCase().indexOf(searchTerms.MCM_SupplierCode) !== -1 &&
        data.MCM_CompanyName.toLowerCase().indexOf(searchTerms.MCM_CompanyName) !== -1 &&
        data.CyM_CountryName_en.toLowerCase().indexOf(searchTerms.CyM_CountryName_en) !== -1 &&
        //data.MRM_RenewalStatus.toLowerCase().indexOf(searchTerms.MRM_RenewalStatus) !== -1 &&
        data.UM_EmailID.toLowerCase().indexOf(searchTerms.UM_EmailID) !== -1 &&
        data.MRM_CreatedOn.toLowerCase().indexOf(searchTerms.MRM_CreatedOn) !== -1 &&
        data.invoicedays.toLowerCase().indexOf(searchTerms.invoicedays) !== -1 &&
        data.membersts.toLowerCase().indexOf(searchTerms.membersts) !== -1 &&
        data.subscriptionstatus.toLowerCase().indexOf(searchTerms.subscriptionstatus) !== -1 &&
        data.mcpd_pymtapprovalstatus.toLowerCase().indexOf(searchTerms.mcpd_pymtapprovalstatus) !== -1;
    }
    return filterFunction;
  }



  selectedType(type) {
    if (type == 1) {
      this.form.branch_name_en.setValidators(null);
      this.form.branch_name_ar.setValidators(null);
      this.form.cr_activity.setValidators(null);
      this.form.moheri_grade.setValidators([Validators.required]);
      this.form.tp_name_ar.setValidators([Validators.required]);
      this.form.tp_name_en.setValidators([Validators.required]);
    }
    if (type == 2) {
      this.form.moheri_grade.setValidators(null);
      this.form.tp_name_ar.setValidators(null);
      this.form.tp_name_en.setValidators(null);
      this.form.branch_name_en.setValidators([Validators.required]);
      this.form.branch_name_ar.setValidators([Validators.required]);
      this.form.cr_activity.setValidators([Validators.required]);
    }
    this.form.moheri_grade.updateValueAndValidity();
    this.form.branch_name_en.updateValueAndValidity();
    this.form.branch_name_ar.updateValueAndValidity();
    this.form.tp_name_ar.updateValueAndValidity();
    this.form.tp_name_en.updateValueAndValidity();
    this.form.cr_activity.updateValueAndValidity();
  }



  getconfigurations() {
    this.regService.getConfiguration().subscribe(res => {
      this.configurationlist = res.data;
      this.crnumverify = (this.configurationlist['CR Integration'] == 'A') ? true : false;
      this.memshpverify = (this.configurationlist['OPAL Membership Integration'] == 'A') ? true : false;

    });
  }

  fileData() {
    this.companyLogoFilee = {
      fileName: 'Company Logo',
      fileNote: '',
      fileFormat: 'jpg, jpeg',
      fileSize: '1 MB',
      fileMaxCount: 1,
      fileData: '',
      selectedFiles: [],
    };
  }

  ChangeValue(valid: boolean, index) {
    console.log('index', index)
    this.dynamicSelect[index] = valid;
  }
  keyAutoCal(val) {

    this.exp_aval = this.instituteform.get('exp_a').value;
    this.oma_nval = this.instituteform.get('oma_n').value;
    this.autocal = this.convertToInt(this.exp_aval) + this.convertToInt(this.oma_nval);
    this.autocalper = this.convertToInt(this.oma_nval) / this.autocal * 100;
    this.instituteform.controls['tot_oman'].setValue(this.autocal);
    this.roundedNum = this.autocalper.toFixed(2);
    this.instituteform.controls['oman_percen'].setValue(this.roundedNum + '%');
  }

  keyCalRat(val) {

    this.curr_learnval = this.instituteform.get('curr_learn').value;
    this.no_techstaffval = this.instituteform.get('no_techstaff').value;
    this.autocalrat = this.convertToInt(this.curr_learnval) / this.convertToInt(this.no_techstaffval);
    let num = Math.floor(this.autocalrat)
    if (isNaN(num)) num = 0;
    if (num) {
      this.instituteform.controls['ratio_tech'].setValue('1:' + num);
    } else {
      this.instituteform.controls['ratio_tech'].setValue('0');
    }

  }

  convertToInt(val) {
    if (val) {
      return parseInt(val);
    } else {
      return 0;
    }
  }
  private getDocs() {
    return this.formBuilder.group({
      fileName: ['', Validators.required],
      provided: ['', [Validators.required]],
      keymap: ['', [Validators.required]]
    });
  }
  formvalidated() {

      this.instituteform = this.formBuilder.group({
        offtype: ['', Validators.required],
        brancheng: [''],
        brancharab: [''],
        exp_a: ['', Validators.required],
        oma_n: ['', Validators.required],
        tot_oman: [''],
        oman_percen: [''],
        site_search: [''],
        site_main: [''],
        molpercent: ['0.0', ''],
        no_techstaff: ['', ''],
        curr_learn: ['', ''],
        ratio_tech: [''],
        trainprovmax: ['', ''],
        address1br: ['', Validators.required],
        address2br: ['', ''],
        governoratebr: ['', Validators.required],
        wilayatbr: ['', Validators.required],
        lat: ['12.9895', ''],
        lang: ['80.2505', ''],
        appinstinfotmp_pk: ['', ''],
        appdtlstmp_pk: ['', ''],

      }),
      this.CourseForm = this.formBuilder.group({
        course_titleen: ['', Validators.required],
        course_titlear: ['', Validators.required],
        course_durat: ['', Validators.required],
        cour_cate: ['', Validators.required],
        slider: ['', ''],
        cour_level: ['', Validators.required],
        inter_organ: [''],
        unit_pk: ['', ''],
        del_pk: ['', ''],
        cousesub_category: ['', Validators.required],
        cour_tested: ['', Validators.required],
        appoffercoursetmp_pk: ['', ''],
        Referrals: this.fb.array([this.createContact()])
      }),
      this.staffForm = this.formBuilder.group({
        civil_num: ['', Validators.required],
        staffeng: ['', Validators.required],
        staffarab: ['', Validators.required],
        email_id: ['', [Validators.required, Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$')]],
        age: [''],
        date_birth: ['', Validators.required],
        gend_er: [''],
        gender_address: [''],
        national: ['', Validators.required],
        role: ['', ''],
        inspect_Vtype: ['', ''],
        job_title: ['', ''],
        cont_type: ['', ''],
        house: [''],
        houseadd: [''],
        count_ry: ['', Validators.required],
        state: ['', Validators.required],
        city: ['', Validators.required],
        staffinforepo_pk: ['', ''],
        appostaffinfotmp_pk: ['', ''],
      }),

      this.staffFormedu = this.formBuilder.group({
        institute_name: ['', Validators.required],
        degree_cert: ['', Validators.required],
        edut_level: ['', Validators.required],
        GradeDate: ['', Validators.required],
        gpa_grade: ['', Validators.required],
        education_files: ['', Validators.required],
        stfrepo: ['', ''],
        staffacademics_pk: ['', ''],

      }),

      this.staffworkexperienceForm = this.formBuilder.group({
        oragn_name: ['', Validators.required],
        date_join: ['', null],
        workdate: ['', ''],
        curr_work: ['', ''],
        employ_country: ['', Validators.required],
        employ_state: ['', null],
        employ_city: ['', null],
        designat: ['', Validators.required],
        file_workexperience: ['', ''],
        sexp_staffinforepo_fk: ['', ''],
        staffworkexp_pk: ['', ''],
      }),
      this.courseselectForm = this.formBuilder.group({
        selectcourses: ['',''],
        filemoher: ['', ''],
        staff_repo: ['', ''],
      }),
      this.InpectionForm = this.formBuilder.group({
        inspectionSelect: ['', Validators.required],
      }),
      this.documentUploadForm = this.formBuilder.group({
        id_card: ['',''],
        file_ropLicense: ['',''],
        file_molEmployment: ['',''],
      })
  }

  get ReferralsFormArr(): FormArray {
    return this.CourseForm.get('Referrals') as FormArray;
  }
  getReferralsFormArr(index): FormGroup {
    const formGroup = this.ReferralsFormArr.controls[index] as FormGroup;
    return formGroup;
  }
  createContact(): FormGroup {
    return this.fb.group({
      unit_titl: ['', Validators.required],
      unit_code: ['', Validators.required]
    });
  }
  addReferral(): void {
    this.ReferralsFormArr.push(
      this.createContact()
    );

  }

  removeReferral(index) {
    this.ReferralsFormArr.removeAt(index);
  }

  saveStaff() {

    if (this.staffForm.valid) {
      this.loaderform = true;
      this.staffForm.controls['civil_num'].enable();
      this.staffForm.controls['staffeng'].enable();
      this.staffForm.controls['staffarab'].enable();
      this.staffForm.controls['date_birth'].enable();
      this.staffForm.controls['gend_er'].enable();
      this.appservice.saveStaff(this.staffForm.value, this.appdtlssavetmp_id,this.projectpk).subscribe(data => {
        this.staffrep_id = data['data'].data;
        this.loaderform = false;
        this.edit_staff = false;
        this.courseselectForm.controls['staff_repo'].setValue(this.staffrep_id);
        if (data.data.status == '1') {
          this.ins_status = 0;
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
          setTimeout(() => {
            this.getStaffbasDtls(this.staffrep_id);
            this.getStaffworkDtls(this.staffrep_id);
          }, 2000);
          if (this.staffForm.get('staffinforepo_pk').value) {
            this.toastr.success(this.i18n('maincenter.staffupdate'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('maincenter.staffadded'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }

        }

        this.mattab = 7;
        this.disableSubmitButton = false;
        this.shownotetext = false;
        this.countrydisable = false;
        this.scrollTo('pagescroll');
        
      });
    } else {
      this.focusInvalidInput(this.staffForm);
    }
  }

  saveStaffedu() {
    if (this.staffFormedu.valid) {
      this.loaderformeducation = true;
      this.staffFormedu.value.GradeDate = moment(this.staffFormedu.value.GradeDate).format('YYYY-MM-DD').toString();
      this.appservice.saveStaffedu(this.staffFormedu.value, this.appdtlssavetmp_id, this.staffrep_id).subscribe(data => {
        this.loaderformeducation = false;

        this.staffFormedu.controls['stfrepo'].setValue(this.staffrep_id);

        if (data.data.status == '1') {
          this.educationformshow = false;
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.staffeduedit = false;
          this.staffFormedu.controls['institute_name'].reset();
          this.staffFormedu.controls['degree_cert'].reset();
          this.staffFormedu.controls['GradeDate'].reset();
          this.staffFormedu.controls['gpa_grade'].reset();
          this.staffFormedu.controls['edut_level'].reset();
          this.staffFormedu.controls['education_files'].reset();
          this.educationInput.selectedFilesPk = [];
          if (this.staffFormedu.get('staffacademics_pk').value) {
            this.toastr.success(this.i18n('maincenter.educqualupda'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.staffFormedu.controls['staffacademics_pk'].reset();
          } else {
            this.toastr.success(this.i18n('maincenter.educqualadde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }

          setTimeout(() => {
            // if(this.staffrep_id){
            //   this.getStaffbasDtls(this.staffFormedu.get('stfrepo').value);
            // }else{
            this.getStaffbasDtls(this.staffrep_id);
            // }

          }, 2000);

          //this.staffFormedu.reset();

        }
        this.scrollTo('education');
        
        this.mattab = 7;
        this.fileeducation = false;
        
      });
    } else {
      this.focusInvalidInput(this.staffFormedu);
      this.fileeducation = true;
    }
  }

  saveWorkExp() {

    if (this.staffworkexperienceForm.get('curr_work').value == 1) {
      this.staffworkexperienceForm.controls['curr_work'].setErrors(null);
      this.notallowed = true;
      this.staffworkexperienceForm.controls.workdate.reset();
      this.worktilled = false;
      this.staffworkexperienceForm.controls['workdate'].setErrors(null);
    } else {
      if (!this.staffworkexperienceForm.controls['workdate'].valid) {
        this.notallowed = false;
        this.staffworkexperienceForm.controls['workdate'].setErrors({ 'incorrect': true });
        this.worktilled = true;
      }
      this.staffworkexperienceForm.controls['curr_work'].setErrors(null);

    }

    if (this.staffworkexperienceForm.valid) {
      this.loaderformwork = true;

      this.staffworkexperienceForm.value.date_join = moment(this.staffworkexperienceForm.value.date_join).format('YYYY-MM-DD').toString();
      this.staffworkexperienceForm.value.workdate = moment(this.staffworkexperienceForm.value.workdate).format('YYYY-MM-DD').toString();
      this.appservice.saveWorkExp(this.staffworkexperienceForm.value, this.staffrep_id, this.appdtlssavetmp_id).subscribe(data => {
        //this.appdtlstmp_id = data['data'].data;
        this.staffworkexperienceForm.controls['sexp_staffinforepo_fk'].setValue(this.staffrep_id);
        this.loaderformwork = false;
        this.workexpformshow = false;
        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
          this.staffworkedit = false;
          this.staffworkexperienceForm.controls['oragn_name'].reset();
          this.staffworkexperienceForm.controls['workdate'].reset();
          this.staffworkexperienceForm.controls['designat'].reset();
          this.staffworkexperienceForm.controls['date_join'].reset();
          this.staffworkexperienceForm.controls['curr_work'].reset();
          this.staffworkexperienceForm.controls['employ_country'].reset();
          this.staffworkexperienceForm.controls['employ_state'].reset();
          this.staffworkexperienceForm.controls['employ_city'].reset();
          this.selectedDate = null;
          this.workexperiencedrvInputed.selectedFilesPk = [];

          if (this.staffworkexperienceForm.get('staffworkexp_pk').value) {
            this.toastr.success(this.i18n('maincenter.workupdate'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.staffworkexperienceForm.controls['staffworkexp_pk'].reset();
          } else {
            this.toastr.success(this.i18n('maincenter.workadde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          setTimeout(() => {
            this.getStaffworkDtls(this.staffrep_id)
          }, 2000);

        }
        this.mattab = 7;
        
        this.scrollTo('workgrid');
                      
      });
    } else {
      this.focusInvalidInput(this.staffworkexperienceForm);
    }
  }

  saveStaffCourmoher() {

    this.getStaffbasDtls(this.staffrep_id);
    this.getStaffworkDtls(this.staffrep_id);

    if (this.courseselectForm.valid && this.staffForm.valid && this.documentUploadForm.valid) {
      if(this.projectpk == 1){
        var breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
            { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' },  
          ]
      };
      }else{
        var breadCrumb ={
          title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
          urls: [
            { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
            { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' },  
          ]
      };
      }
      this.remoteService.breadcrumCookieValue(breadCrumb);
      this.disableSubmitButton = true;
      this.staffForm.controls['civil_num'].enable();
      this.staffForm.controls['staffeng'].enable();
      this.staffForm.controls['staffarab'].enable();
      this.staffForm.controls['date_birth'].enable();
      this.staffForm.controls['gend_er'].enable();
      this.checkboxdisable = false;
      this.staffForm.value.date_birth = moment(this.staffForm.value.date_birth).format('YYYY-MM-DD').toString();
      this.appservice.saveStaffCourmoher(this.courseselectForm.value, this.staffrep_id, this.staffForm.value, this.appdtlssavetmp_id,this.projectpk,this.documentUploadForm.value).subscribe(data => {
        this.staffconfigurationcheckinras();
        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
          this.mogerInputed.selectedFilesPk = [];
          if (!this.staffForm.get('appostaffinfotmp_pk').value) {
            this.toastr.success(this.i18n('maincenter.staffcouradde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('Staff Updated Successfully'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          setTimeout(() => {
            this.getStaffDtls();
          }, 2000);
          this.ShowHide = true;
          this.staffformshow = false;
          this.mattab = 6;

        }
        this.scrollTo('pagescroll');
        setTimeout(() => {
          this.disableSubmitButton = false;

        }, 2000);
                 
      });


    } else {
      this.focusInvalidInput(this.staffForm);
      this.focusInvalidInput(this.courseselectForm);
      this.focusInvalidInput(this.documentUploadForm);

      this.fileemoheri = true;
    }
  }

  saveCompanyFormDetails() {
   
    if (this.comanydetialsform.valid) {
      this.disableSubmitButton = true;
      this.appservice.savecompdtls(this.comanydetialsform.value, this.appdtlssavetmp_id).subscribe(data => {
        this.appdtlstmp_id = data['data'].data;
        this.getCenterStatus(this.appdtlstmp_id);
        this.getCompDtls();
        this.toastr.success(this.i18n('maincenter.compdetasave'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.appdtlssavetmp_id = this.appdtlstmp_id;
        this.getDeclinedStatus(this.appdtlssavetmp_id);
        if (this.appdtlssavetmp_id) {
          this.center_status = true;
        }
        this.disableSubmitButton = false;
        this.mattab = 1;
        this.scrollTo('pagescroll');
        
      });
    } else {
      this.focusInvalidInput(this.comanydetialsform);
    }
  }

  saveInternational() {

    let awarderror = this.awaredForm.get('file_award').value;
    if (this.awaredForm.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveInternational(this.awaredForm.value, this.appdtlssavetmp_id).subscribe(data => {

        this.ShowHide = true;
        this.international = false;
        this.mattab = 2;

        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.awaredForm.reset();
          this.edit_arard = false;
          this.drvInputed.selectedFilesPk = [];
          if (this.awaredForm.get('appintrecogtmp_pk').value) {
            this.toastr.success(this.i18n('maincenter.interecoupdat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('maincenter.interecoadde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }

          setTimeout(() => {
            this.getInterRecDtls();
          }, 2000);

          this.awaredForm.reset();
          this.scrollTo('pagescroll');
          
          this.disableSubmitButton = false;
        }
      });
    } else {
      this.focusInvalidInput(this.awaredForm);
    }
  }

  clearaward() {
    this.awar.award_organ.setValue('');
    this.awar.last_audit.setValue('');
    this.awar.file_award.setValue('');
    this.awar.appintit_applicationdtlstmp_fk.setValue('');
    this.awar.appintrecogtmp_pk.setValue('');
  }

  editbranch(element, type) {
    if(this.projectpk == 1){
    var breadCrumb ={
        title: 'Training Centre Certification',
        urls: [
          { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
          { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
        ] 
    };
    this.remoteService.breadcrumCookieValue(breadCrumb);
    }else{
      const breadCrumb ={
        title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
          urls: [
            { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
            { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }

          ]
    };
    this.remoteService.breadcrumCookieValue(breadCrumb);
    }
  this.appservice.getappliacationdtls(element.appiit_applicationdtlstmp_fk).subscribe(elementdata=>{
        this.elemeentadata  = elementdata.data.data;

   var element = this.elemeentadata;
  //  console.log(element)
    this.applystatus = type;
    this.renewal = false;
    this.dtlsmain = '';
    this.dtlstmp = '';
    this.mainres = '';
    this.noEdit = true;
    this.appservice.usertranbranchdtls(element.appiit_applicationdtlstmp_fk).subscribe(data => {
      this.dataapp =data.data.dataTmp; 
      if (data.data.status == '1') {
        this.renewal = true;
        this.dtlsmain = data.data.data;
        this.dtlstmp = data.data.dataTmp;
        this.mainres = data.data.response;
        console.log(this.dtlstmp, 'mainresponse');
      }
    });

    this.disableSubmitButton = true;
    this.FormTemplate = 'branchFroms';
    this.ins_status = element.appiit_status;
    setTimeout(() => {
      if (element.appiit_status == '4') {
        if (element.appiit_appdeccomment != "") {
          document.getElementById('aprdeccmddec').innerHTML = element.appiit_appdeccomment;
        } else {
          document.getElementById('aprdeccmddec').innerHTML = "Nil";
        }

      }

      if (element.appiit_status == '3') {
        if (element.appiit_appdeccomment != "") {
          document.getElementById('aprdeccmdapr').innerHTML = element.appiit_appdeccomment;
        } else {
          document.getElementById('aprdeccmdapr').innerHTML = "Nil";
        }
      }
    }, 3000);

    this.insinfirtmp_Pk = element.appinstinfotmp_pk;

    this.getGoverenoratelist();
    this.getwilayatbyid(31, element.appiit_statemst_fk);
    this.getAppStatus(element.appiit_applicationdtlstmp_fk);
    this.getDeclinedStatus(element.appiit_applicationdtlstmp_fk);
    this.instituteform.patchValue({
      brancheng: element.appiit_branchname_en,
      brancharab: element.appiit_branchname_ar,
      exp_a: element.appiit_noofexpat,
      oma_n: element.appiit_noofomani,
      molpercent: element.appiit_molpercent,
      no_techstaff: element.appiit_nooftechstaff,
      curr_learn: element.appiit_noofcurlearners,
      site_main: element.appiit_locmapurl,
      trainprovmax: element.appiit_maxcapacity,
      appinstinfotmp_pk: element.appinstinfotmp_pk,
      appdtlstmp_pk: element.appiit_applicationdtlstmp_fk,
      address1br: element.appiit_addrline1,
      address2br: element.appiit_addrline2,
      governoratebr: element.appiit_statemst_fk?Number(element.appiit_statemst_fk):'',
      wilayatbr: element.appiit_citymst_fk?Number(element.appiit_citymst_fk):'',
    });
      if(this.projectpk == 4){
        // alert(element.appiit_officetype) Number(element.appiit_officetype)
      
      if(element.appiit_officetype == 1) {
        this.selectofficePk = '1';
      }else if (element.appiit_officetype == 2) {
        this.selectofficePk = '2';
      }
      }
    this.getAutoCal(element.appiit_noofexpat, element.appiit_noofomani);
    this.getAutoRatCal(element.appiit_noofcurlearners, element.appiit_nooftechstaff);
    this.appdtlssavetmp_id = element.appiit_applicationdtlstmp_fk;
    this.staffconfigurationcheckinras();

    if (this.appdtlssavetmp_id) {
      this.center_status = true;
    }

    setTimeout(() => {
      this.getCenterStatus(this.appdtlssavetmp_id);
      this.getRegAppDtls();
      this.getCourDtls();
      this.getStaffDtls();
      this.onoffice();
      this.disableSubmitButton = false;
    }, 2000);
    this.getrascategorydata(10,0,null);
    this.scrollTo('pagescroll');
  });
  }

  editRec(element) {
    this.disableSubmitButton = true;
    this.ShowHide = false;
    this.international = true;
    this.selectedawardorgan(element.appintit_intnatrecogmst_fk);
    if (element.appintit_doc) {
      this.drvInputed.selectedFilesPk = [element.appintit_doc];
    } else {
      this.drvInputed.selectedFilesPk = [];
    }
    //this.drvInputed.selectedFilesPk = [element.appintit_doc];
    this.appintit_status = element.appintit_status;
    this.appintit_appdeccomment = element.appintit_appdeccomment;


    this.awaredForm.patchValue({
      appintrecogtmp_pk: element.appintrecogtmp_pk,
      last_audit: element.appintit_lastauditdate,
      file_award: element.appintit_doc,
    });
    this.edit_arard = true;
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }

  delRec(element) {
    this.appservice.deleteInternational(element).subscribe(data => {
      swal({
        title: this.i18n('maincenter.doyouwantbranchgrid'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if (data.data.status == '1') {
            this.disableSubmitButton = true;
            this.toastr.success(this.i18n('maincenter.griddele'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            setTimeout(() => {
              this.getDeclinedStatus(element.appintit_applicationdtlstmp_fk);
              this.getInterRecDtls();
              this.disableSubmitButton = false;
            }, 2000);
          }
        }
      });

    });
  }

  deleteStaff(element) {
    swal({
      title: this.i18n('maincenter.doyouwantbranchgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteStaff(element).subscribe(data => {
          this.staffconfigurationcheckinras();
          if (data.data.status == '1') {
            this.disableSubmitButton = true;
            this.getCenterStatus(this.appdtlssavetmp_id);
            this.toastr.success(this.i18n('maincenter.satffdele'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            setTimeout(() => {
              this.getDeclinedStatus(element.appsit_applicationdtlstmp_fk);
              this.getStaffDtls();
              this.disableSubmitButton = false;
            }, 2000);
          }
        });

      }
    });
  }

  delOpr(element) {

    this.appservice.deleteOpr(element).subscribe(data => {
      swal({
        title: this.i18n('maincenter.doyouwantbranchgrid'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if (data.data.status == '1') {
            this.disableSubmitButton = true;
            this.toastr.success(this.i18n('maincenter.griddele'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            setTimeout(() => {
              this.getDeclinedStatus(element.appoprct_applicationdtlstmp_fk);
              this.getOprContrDtls();
              this.disableSubmitButton = false;
            }, 2000);
          }
        }
      });

    });
  }

  editStaff(element) {
    if(this.projectpk == 1){
    var breadCrumb ={
      title: 'Training Centre Certification',
      urls: [
        { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
        { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),page:3 },
        { title: 'Staff', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }

      ]
  };
  }else{
    var breadCrumb ={
      title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
      urls: [
        { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
        { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),page:3 },
        { title: 'Staff', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }

      ]
  };
  }

this.remoteService.breadcrumCookieValue(breadCrumb);
  this.remoteService.breadcrumCookieValue(breadCrumb);
    this.staffForm.enable();
    this.repocv = element.sir_staffcv;
    this.disableSubmitButton = true;
    this.ShowHide = false;
    this.staffformshow = true;
    this.edit_staff = true;
   
    if (element.sir_moheridoc) {
      this.mogerInputed.selectedFilesPk = [element.sir_moheridoc];
    } else {
      this.mogerInputed.selectedFilesPk = [];
    }
    if (element.sir_moheridoc) {
      this.molEmploymentdrvInputed.selectedFilesPk = [element.sir_moheridoc];
    } else {
      this.molEmploymentdrvInputed.selectedFilesPk = [];
    }
    if (element.sld_ROPlicenseupload) {
      this.ropLicensedrvInputed.selectedFilesPk = [element.sld_ROPlicenseupload];
    } else {
      this.ropLicensedrvInputed.selectedFilesPk = [];
    }
    if (element.sir_civilidfront) {
      this.idcarddrvInputed.selectedFilesPk = [element.sir_civilidfront];
    } else {
      this.idcarddrvInputed.selectedFilesPk = [];
    }
    this.documentUploadForm.controls['file_molEmployment'].setValue(element.sir_moheridoc);
    this.documentUploadForm.controls['file_ropLicense'].setValue(element.sld_ROPlicenseupload);
    this.documentUploadForm.controls['id_card'].setValue(element.sir_civilidfront);
    this.statedropdown(31);
    this.citydropdown(element.sir_opalstatemst_fk, 31);
    this.opercourdropdown(this.appdtlssavetmp_id)
    this.appsit_status = element.appsit_status;
    this.appsit_appdeccomment = element.appsit_appdeccomment;

    this.staffForm.patchValue({
      civil_num: element.sir_idnumber,
      staffeng: element.sir_name_en,
      staffarab: element.sir_name_ar,
      email_id: element.sir_emailid,
      date_birth: element.sir_dob,
      gend_er: element.sir_gender,
      national: element.sir_nationality,
      // role: (element.appsit_mainrole !== null) ? element.appsit_mainrole.split(",") : [],
      job_title: element.appsit_jobtitle,
      cont_type: element.appsit_contracttype,
      house: element.sir_addrline1,
      houseadd: element.sir_addrline2,
      count_ry: '31',
      state: element.sir_opalstatemst_fk,
      city: element.sir_opalcitymst_fk,
      staffinforepo_pk: element.staffinforepo_pk,
      appostaffinfotmp_pk: element.appostaffinfotmp_pk,

      //file_award : element.appintit_doc,
    });
    if(element.sir_dob == '0000-00-00'){

      this.staffForm.controls['date_birth'].setValue("");

}
    if (this.projectpk == 1) {
      this.staffForm.patchValue({
        role: (element.appsit_mainrole !== null) ? element.appsit_mainrole.split(",") : [],

      });
    } else {
      this.staffForm.patchValue({
        role: (element.appsit_roleforcourse !== null) ? element.appsit_roleforcourse.split(",") : [],
        inspect_Vtype: (element.appsit_apprasvehinspcattmp_fk !== null) ? element.appsit_apprasvehinspcattmp_fk.split(",") : [],
      });
    }
    if (this.projectpk == 4) {
    this.rasrolecheck(element.appsit_roleforcourse.split(","));
    }
    if (this.course_staff_status == true || (element.appsit_status == '3' && this.applystatus == '2')) {
      this.staffForm.controls['civil_num'].disable();
      this.staffForm.controls['date_birth'].disable();
      this.staffForm.controls['gend_er'].disable();
    }

    if (this.applystatus == '1') {
      this.staffForm.controls['civil_num'].disable();
      this.staffForm.controls['date_birth'].enable();
      this.staffForm.controls['gend_er'].enable();
    }

    if (this.aprdec_status == false) {
      this.staffForm.disable();
    }

    this.staffFormedu.controls['stfrepo'].setValue(element.staffinforepo_pk);
    this.staffworkexperienceForm.controls['sexp_staffinforepo_fk'].setValue(element.staffinforepo_pk);
    this.courseselectForm.controls['staff_repo'].setValue(element.staffinforepo_pk);
    this.courseselectForm.controls['selectcourses'].setValue((element.appsit_appoffercoursetmp_fk !== null) ? element.appsit_appoffercoursetmp_fk.split(",") : []);
    this.courseselectForm.controls['filemoher'].setValue(element.sir_moheridoc);

    setTimeout(() => {
      this.getStaffbasDtls(element.staffinforepo_pk);
    }, 2000);

    setTimeout(() => {
      this.getStaffworkDtls(element.staffinforepo_pk)
    }, 2000);

    this.staffrep_id = element.staffinforepo_pk;
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }

  editStaffedu(element) {
    this.staffeduedit = true;
    this.educationformshow = true;
    this.disableSubmitButton = true;
    this.ShowHide = false;
    this.staffformshow = true;
    this.staffleveldropdown();
    this.statetutdropdown(element.sacd_opalcountrymst_fk);
    this.citytutdropdown(element.sacd_opalstatemst_fk, element.sacd_opalcountrymst_fk);

    this.educationInput.selectedFilesPk = [element.memcompfiledtls_pk];
    this.staffFormedu.patchValue({
      //cont_type: ['', Validators.required],
      institute_name: element.sacd_institutename,
      degree_cert: element.sacd_degorcert,
      year_join: element.sacd_startdate,
      year_pass: element.sacd_enddate,
      gpa_grade: element.sacd_grade,
      // instute_locate:  ['', Validators.required],
      edut_level: element.sacd_edulevel,
      institue_country: element.sacd_opalcountrymst_fk,
      inst_city: element.sacd_opalcitymst_fk,
      inst_state: element.sacd_opalstatemst_fk,
      staffacademics_pk: element.staffacademics_pk,
      education_files: element.staffacademics_pk,
      GradeDate: element.gradedate
      //file_award : element.appintit_doc,
    });
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
    this.pageScrolltopeduform()
  }

  editStaffwork(element) {
    console.log(element, 'testdata');

    this.staffworkedit = true;
    this.workexpformshow = true;
    this.disableSubmitButton = true;
    this.ShowHide = false;
    this.staffformshow = true;
    //this.staffleveldropdown();
    this.stateworkdropdown(element.sexp_opalcountrymst_fk);
    this.cityworkdropdown(element.sexp_opalstatemst_fk, element.sexp_opalcountrymst_fk);
    this.workexperiencedrvInputed.selectedFilesPk = [element.sexp_profdocupload];
    this.staffworkexperienceForm.patchValue({
      oragn_name: element.sexp_employername,
      workdate: element.sexp_eod,
      designat: element.sexp_designation,
      date_join: element.sexp_doj,
      curr_work: element.sexp_currentlyworking,
      employ_country: element.sexp_opalcountrymst_fk,
      employ_state: element.sexp_opalstatemst_fk,
      employ_city: element.sexp_opalcitymst_fk,
      //sexp_staffinforepo_fk: element.test,
      staffworkexp_pk: element.staffworkexp_pk,
      file_workexperience: element.file_workexperience,
    });
    if (element.sexp_currentlyworking == 1) {
      this.staffworkexperienceForm.controls['curr_work'].setValue(1);
      this.staffworkexperienceForm.controls['workdate'].reset();
      this.staffworkexperienceForm.controls['workdate'].setValidators(null);
      this.notallowed = true;
      this.worktilled = false;
      this.selectedDate = null;
      this.cleardate = false;
      this.isCheckboxDisabled = false;
      if (this.staffworkexperienceForm.disabled) {
        this.worktilled = true;
      }
    } else {
      this.staffworkexperienceForm.controls['workdate'].setValue(element.sexp_eod);
      this.staffworkexperienceForm.controls['curr_work'].setValue(null);
      this.notallowed = false;
      this.worktilled = true;
      this.cleardate = true;
      this.selectedDate = element.sexp_eod;
      this.isCheckboxDisabled = true;
      if (this.staffworkexperienceForm.disabled) {
        this.cleardate = false;
      }

    }
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);

  }

  editOpr(element) {
    this.disableSubmitButton = true;
    this.ShowHide = false;
    this.operatcont = true;
    this.selectedoprtype(element.appoprct_conttype);
    this.appoprct_status = element.appoprct_status;
    this.appoprct_appdeccomment = element.appoprct_appdeccomment;

    this.OperatorContractForm.patchValue({
      operator_name: this.ifarabic == true ? element.rm_name_ar : element.rm_name_en,
      //c: element.,
      cont_strt: element.appoprct_contstartdate,
      cont_end: element.appoprct_contenddate,
      appoprcontracttmp_pk: element.appoprcontracttmp_pk,
      opername_id: element.appoprct_operatorname
    });
    this.edit_opr = true;
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }

  editCour(element) {
    var breadCrumb ={
      title: 'Training Centre Certification',
      urls: [
        { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
        { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),page:2 },
        { title: 'Course', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }

      ]
  };
  this.remoteService.breadcrumCookieValue(breadCrumb);

    this.edit_cour = true;
    this.disableSubmitButton = true;
    this.ShowHide = false;
    this.courses = true;
    this.subcatdropdown(element.appoct_coursecategorymst_fk);
    this.appoct_status = element.appoct_status;
    this.appoct_appdeccomment = element.appoct_appdeccomment;

    this.appservice.getcourunt(element.appoffercoursetmp_pk).subscribe(data => {
      if (data) {
        this.courunt_list = data.data.data;
        if (this.courunt_list) {
          if (this.courunt_list.length > 0) {
            const speccontrol = <FormArray>this.CourseForm.controls.Referrals;

            while (speccontrol.length !== 0) {
              speccontrol.removeAt(0);
            }
            this.courunt_list.forEach(x => {
              speccontrol.push(this.fb.group({
                unit_code: x.appocut_unitcode,
                unit_titl: x.appocut_unittitle,
                unit_pk: x.appoffercourseunittmp_pk,
              }));
            });
            if (this.aprdec_status == false) {
              //speccontrol.disable();
              //this.CourseForm.disable();
            }
            if (this.aprdec_status == false) {
              speccontrol.disable();
            }

          }
        }
      }

    });
    setTimeout(() => {
      this.CourseForm.patchValue({
        appoffercoursetmp_pk: element.appoffercoursetmp_pk,
        course_titleen: element.appoct_coursename_en,
        course_titlear: element.appoct_coursename_ar,
        course_durat: element.appoct_courseduration,
        cour_cate: element.appoct_coursecategorymst_fk,
        cour_level: element.appoct_courselevel,
        cousesub_category: element.appoct_coursesubcategorymst_fk,
        cour_tested: element.appoct_coursetested,
        inter_organ: (element.appoct_appintrecogtmp_fk !== null) ? element.appoct_appintrecogtmp_fk.split(",") : [],

      });
    }, 2000);


    this.onSelectionChangeyes(element.appoct_foundationprog);
    this.courread = true;



    if (this.course_staff_status == true || (element.appoct_status == '3' && this.applystatus == '2')) {
      this.CourseForm.controls['course_titleen'].disable();
      this.CourseForm.controls['cour_cate'].disable();
    }

    if (this.applystatus == '1') {
      this.CourseForm.controls['course_titleen'].enable();
      this.CourseForm.controls['course_titlear'].enable();
      this.CourseForm.controls['cour_cate'].enable();
    }
    if (this.aprdec_status == false && this.course_staff_status == false) {
      this.CourseForm.disable();
    }

    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);

  }

  delCour(element) {

    swal({
      title: this.i18n('maincenter.doyouwantbranchgrid'),
      text: '',
      icon: 'warning',
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteCour(element).subscribe(data => {
          if (data.data.data == 'mapped_staff') {
            this.toastr.warning(this.i18n('You cannot delete this because it is mapped with a Staff.'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else if (data.data.data == 'mapped_course') {
            this.toastr.warning(this.i18n('You cannot delete this because it is mapped with a customizeded course.'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            if (data.data.status == '1') {
              this.checkboxdisable = false;
              this.disableSubmitButton = true;
              this.getDeclinedStatus(element.appoct_applicationdtlstmp_fk);
              this.getCenterStatus(this.appdtlssavetmp_id);
              this.opercourdropdown(this.appdtlssavetmp_id);
              this.toastr.success(this.i18n('Course Details Deleted Successfully.'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
              setTimeout(() => {
                this.getCourDtls();
              }, 2000);
              setTimeout(() => {
                this.disableSubmitButton = false;
              }, 2000);
            }
          }
        });
      }
    });
  }

  deleteStaffedu(element) {
    swal({
      title: this.i18n('maincenter.doyouwantbranchgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteStaffedu(element, this.appdtlssavetmp_id).subscribe(data => {

          if (data.data.status == '1') {
            this.disableSubmitButton = true;
            this.getDeclinedStatus(this.appdtlssavetmp_id);
            this.getCenterStatus(this.appdtlssavetmp_id);
            this.staffFormedu.controls['institute_name'].reset();
            this.staffFormedu.controls['degree_cert'].reset();
            this.staffFormedu.controls['GradeDate'].reset();
            this.staffFormedu.controls['gpa_grade'].reset();
            this.staffFormedu.controls['edut_level'].reset();
            this.staffFormedu.controls['education_files'].reset();
            this.staffFormedu.controls['staffacademics_pk'].reset();
            this.staffeduedit = false;
            this.toastr.success(this.i18n('maincenter.educqual'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            setTimeout(() => {
              this.getStaffbasDtls(element.sacd_staffinforepo_fk);
            }, 2000);
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
          }
        });
      }
    });

  }
  cancelstaff() {
    this.staffFormedu.reset();
    this.educationformshow = false;
    this.educationInput.selectedFilesPk = [];
    this.fileeducation = false;
    this.edit_staff = false;

  }
  cancelworkstaff() {
    this.staffworkexperienceForm.reset();
    this.workexpformshow = false;
    this.workexperiencedrvInputed.selectedFilesPk = [];

  }
  deleteStaffwork(element) {

    swal({
      title: this.i18n('maincenter.doyouwantbranchgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteStaffwork(element, this.appdtlssavetmp_id).subscribe(data => {
          if (data.data.status == '1') {
            this.disableSubmitButton = true;
            this.getCenterStatus(this.appdtlssavetmp_id);
            this.staffworkedit = false;
            this.staffworkexperienceForm.controls['oragn_name'].reset();
            this.staffworkexperienceForm.controls['workdate'].reset();
            this.staffworkexperienceForm.controls['designat'].reset();
            this.staffworkexperienceForm.controls['date_join'].reset();
            this.staffworkexperienceForm.controls['curr_work'].reset();
            this.staffworkexperienceForm.controls['employ_country'].reset();
            this.staffworkexperienceForm.controls['employ_state'].reset();
            this.staffworkexperienceForm.controls['employ_city'].reset();
            this.staffworkexperienceForm.controls['staffworkexp_pk'].reset();
            this.toastr.success(this.i18n('maincenter.workexpeir'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            setTimeout(() => {
              this.getDeclinedStatus(this.appdtlssavetmp_id);
              this.getStaffworkDtls(element.sexp_staffinforepo_fk);
            }, 2000);
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
          }
        });
      }
    });

  }

  selectedoprtype(value) {
    this.OperatorContractForm.controls['contract_typ'].setValue(value);
  }

  selectedawardorgan(value) {
    this.awaredForm.controls['award_organ'].setValue(Number(value));
  }

  saveOperContr() {
    if (this.OperatorContractForm.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveOperContr(this.OperatorContractForm.value, this.appdtlssavetmp_id).subscribe(data => {

        if (data.data.status == '1') {
          this.edit_opr = false;
          if (this.OperatorContractForm.get('appoprcontracttmp_pk').value) {
            this.toastr.success(this.i18n('maincenter.opercont'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('maincenter.opercontdeta'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }

          setTimeout(() => {
            this.getOprContrDtls();
          }, 2000);
          this.scrollTo('pagescroll');
          this.OperatorContractForm.reset();

        }
        this.mattab = 3;
        this.operatcont = false;
        this.ShowHide = true;
        this.disableSubmitButton = false;
        this.scrollTo('pagescroll');
      });
    } else {
      this.focusInvalidInput(this.OperatorContractForm);
    }
  }

  clearOpr() {
    this.OperatorContractForm.controls['opername_id'].setValue("");
  }

  setoprid(data) {
    this.OperatorContractForm.controls['opername_id'].setValue(data.referencemst_pk);
  }

  saveCourse() {

    if (this.CourseForm.valid) {
      this.disableSubmitButton = true;
      this.CourseForm.controls['course_titleen'].enable();
      this.CourseForm.controls['course_titlear'].enable();
      this.CourseForm.controls['cour_cate'].enable();
      this.checkboxdisable = false;
      this.appservice.saveCourse(this.CourseForm.value, this.appdtlssavetmp_id, this.memReg).subscribe(data => {
        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
          this.opercourdropdown(this.appdtlssavetmp_id);
          this.edit_cour = false;
          if (this.CourseForm.get('appoffercoursetmp_pk').value) {
            this.toastr.success(this.i18n('maincenter.courupdat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('maincenter.couradde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          this.disableSubmitButton = false;
          setTimeout(() => {
            this.getCourDtls();
          }, 2000);
        }

        this.CourseForm.reset();
        this.ReferralsFormArr.reset();
        this.id = '0';
        this.value = '';
        this.courses = false;
        this.ShowHide = true;
        this.mattab = 1;
        
        this.scrollTo('pagescroll');
      });
    } else {
      this.focusInvalidInput(this.CourseForm);
    }

  }

  //filterformcontral name
  Awarding = new FormControl('');
  LastAudited = new FormControl('');
  Status = new FormControl('');
  Addedon = new FormControl('')
  LastUpdated = new FormControl('');
  doc = new FormControl('');
  addon = new FormControl('');

  operatorname = new FormControl('');
  contracttype = new FormControl('');
  contractstart = new FormControl('');
  contractend = new FormControl('');
  addedon = new FormControl('');
  lastUpdated = new FormControl('');
  Statusone = new FormControl('');

  course_title = new FormControl('');
  course_dura = new FormControl('');
  course_level = new FormControl('');
  course_cate = new FormControl('');
  course_test = new FormControl('');
  StatusCour = new FormControl('');
  adddoncour = new FormControl('');
  LastUpdatedcour = new FormControl('');
  LastUpdatedstaffdate = new FormControl('');
  civil_numb = new FormControl('');
  staff_name = new FormControl('');
  email_id = new FormControl('');
  age = new FormControl('');
  gender = new FormControl('');
  Nation = new FormControl('');
  cont_type = new FormControl('');
  main_role = new FormControl('');
  status_cour = new FormControl('');
  addd_oncour = new FormControl('');
  LastUpdatedstaff = new FormControl('');

  institute = new FormControl('');
  degree = new FormControl('');
  year_join = new FormControl('');
  year_pass = new FormControl('');
  yearpass = new FormControl('');
  grade = new FormControl('');
  add_On = new FormControl('');
  Last_Date = new FormControl('');

  oranisation = new FormControl('');
  date_joined = new FormControl('');
  work_till = new FormControl('');
  count = new FormControl('');
  gover = new FormControl('');
  wilaya = new FormControl('');
  designation = new FormControl('');
  add_edOn = new FormControl('');
  date_last = new FormControl('');


  frstNext() {
    this.mattab = 1;
    this.scrollTo('pagescroll');
  }
  scndNext() {
    this.mattab = 2;
    this.scrollTo('pagescroll');
  }

  nextstaff() {
    this.mattab = 2;
    this.pageScrolltop();
  }

  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  dirtyControls() {
    return Object.keys(this.form).filter(control => {
      if (control !== 'inv_identity' && this.comanydetialsform.controls[control].touched) {
        return control;
      }
    })
  }

  getMoherigradinglist() {
    this.regService.getMoherigradinglist().subscribe(data => {
      this.moherigradinglist = data.data;

    });
  }
  getGoverenoratelist() {
    this.profileService.getstatebyid(31).subscribe(data => {
      this.governoratelist = data.data;

    });
  }

  getintrtrlist() {
    this.appservice.getintrtr().subscribe(data => {
      this.intnatrecogmst_list = data.data;
    });
  }

  leveldropdown() {
    this.appservice.getref(3).subscribe(data => {
      this.level_list = data.data;
      //this.level_list = this.level_list.pipe(map(level_list => level_list.sort((a,b) => a > b)));
    });
  }

  courtestdropdown() {
    this.appservice.getref(8).subscribe(data => {
      this.courtest_list = data.data;
    });
  }

  contrtyprdropdown() {
    this.appservice.getref(7).subscribe(data => {
      this.contrtype_list = data.data;
    });
  }

  staffleveldropdown() {
    this.appservice.getref(12).subscribe(data => {
      this.stafflevel_list = data.data;
    });
  }

  getdocumentdtl() {

  }

  getdocumentdtledit() {

  }

  opercourdropdown(appdtlssavetmp_id) {
    this.appservice.offercour(appdtlssavetmp_id).subscribe(data => {
      this.offercour_list = data.data;

    });
  }

  getDeclinedStatus(appdtlssavetmp_id) {
    this.decline_status = false;
    this.appservice.getDecStatus(appdtlssavetmp_id).subscribe(data => {
      if (data.data.status == 1) {
        this.decline_status = true;
      }
    });
  }

  getCenterStatus(appdtlssavetmp) {
    this.appservice.getCenterStatus(appdtlssavetmp).subscribe(data => {

      if (data.data) {
        this.resubmit_status = data.data.appdt_status;
      }

      if (data.data.appdt_status == 1) {
        this.aprdec_status = true;
        this.notallowedone = true;

        //
        this.deleteicon = true;
        this.instituteform.enable();
        // this.instituteform.controls['offtype'].setValue(2);
        // this.instituteform.get('offtype').disable();
        this.CourseForm.enable();
        this.staffForm.enable();
        this.staffFormedu.enable();
        this.staffworkexperienceForm.enable();
        this.courseselectForm.enable();
        this.deleteicon = true;
        this.workdeleteicon = true;
        //this.instituteform.controls['offtype'].disable();
        //
      } else if (data.data.appdt_status == 3) {
        this.aprdec_status = true;
        this.notallowedone = true;
        //
        this.deleteicon = true;
        this.workdeleteicon = true;
        this.instituteform.enable();
        this.CourseForm.enable();
        this.staffForm.enable();
        this.staffFormedu.enable();
        this.staffworkexperienceForm.enable();
        this.courseselectForm.enable();
        //this.instituteform.controls['offtype'].disable();
        //
      } else if (data.data.appdt_status == 5 || data.data.appdt_status == 6 || data.data.appdt_status == 18) {
        this.appservice.getpaymentinfo(appdtlssavetmp, 1).subscribe(res => {
          if (res.status == 200) {
            this.FormMainTemplate = 'payMent';
            this.payment = res.data.payment;
            this.record = res.data.record;
          }
        });
      }
      // enable edit app
      if (data.data.appdt_status >= 5 && this.applystatus != '3') {
        this.course_staff_status = true;
      }

      if (data.data.appdt_status >= 5) {
        this.instituteform.disable();
        this.CourseForm.disable();
        this.staffForm.disable();
        this.staffFormedu.disable();
        this.staffworkexperienceForm.disable();
        this.courseselectForm.disable();
        this.deleteicon = false;
        this.workdeleteicon = false;
      }

      // alert(this.aprdec_status)
      // alert()
      if (data.data.appdt_status == 2 || data.data.appdt_status == 4 || this.applystatus == 3) {
        this.aprdec_status = false;
        this.notallowedone = false;
        this.CourseForm.disable();
        this.staffForm.disable();
        this.staffFormedu.disable();
        this.staffworkexperienceForm.disable();
        this.courseselectForm.disable();
      }

      if (data.data.appdt_status == 2 || data.data.appdt_status == 4) {
        // this.comanydetialsform.disable();
        this.deleteicon = false;
        this.workdeleteicon = false;
        this.instituteform.disable();
        this.awaredForm.disable();
        this.OperatorContractForm.disable();
        this.workdeleteicon = false;
        //this.documentForm.disable();
        //this.dynamicForm.disable();
      }

      if (this.aprdec_status == false) {
        // this.comanydetialsform.disable();
        // this.deleteicon = false;
        // this.instituteform.disable();
        // this.awaredForm.disable();
        // this.OperatorContractForm.disable();
        // this.documentForm.disable();
        //this.dynamicForm.disable();
      }

      if (this.applystatus === 1) {
        this.aprdec_status = true;
        this.notallowedone = true;
        this.deleteicon = true;
        this.workdeleteicon = true;
        this.instituteform.enable();
        this.CourseForm.enable();
       
        this.staffForm.enable();
        this.staffFormedu.enable();
        this.staffworkexperienceForm.enable();
        this.courseselectForm.enable();

      }
      if (this.applystatus === 2) {
        this.aprdec_status = true;
        this.notallowedone = true;
        this.deleteicon = true;
        this.workdeleteicon = true;
        this.instituteform.disable();
        this.CourseForm.enable();
        if (data.data.appdt_status == '3') {
          this.CourseForm.controls['course_titleen'].disable();
          //  this.CourseForm.controls['course_titlear'].disable();
          this.CourseForm.controls['cour_cate'].disable();
        }
        this.staffForm.enable();
        this.staffFormedu.enable();
        this.staffworkexperienceForm.enable();
        this.courseselectForm.enable();

      }

      if (this.applystatus === 5) {
        this.aprdec_status = true;
        this.notallowedone = true;
        this.deleteicon = true;
        this.workdeleteicon = true;
        this.instituteform.enable();
        this.CourseForm.enable();
        if (data.data.appdt_status == '3') {
          this.CourseForm.controls['course_titleen'].disable();
          //this.CourseForm.controls['course_titlear'].disable();
          this.CourseForm.controls['cour_cate'].disable();
        }
        this.staffForm.enable();
        this.staffFormedu.enable();
        this.staffworkexperienceForm.enable();
        this.courseselectForm.enable();

      }

      //this.offercour_list = data.data;

    });
  }

  getAppStatus(appdtlssavetmp_id) {
    this.appservice.getAppStatus(appdtlssavetmp_id).subscribe(data => {
      console.log(data.data, 'branchcentre');
      if (data.data.appoct_status == 1) {
        this.checkboxdisable = false;
      } else if (data.data.appoct_status == 2) {
        this.checkboxdisable = false;
      } else if (data.data.appsit_status == 1) {
        this.checkboxdisable = false;
      } else if (data.data.appsit_status == 2) {
        this.checkboxdisable = false;
      } else {
        this.checkboxdisable = true;
      }

    });
    console.log(this.checkboxdisable, 'kkskk');
  }

  roledropdown() {
    this.appservice.getrole().subscribe(data => {
      this.role_list = data.data;
    });
  }

  recdropdown() {

    this.appservice.getrec(this.appdtlssavetmpbranch_id).subscribe(data => {
      this.rec_list = data.data;
    });
  }
  //get category starts
  catdropdown() {
    this.appservice.getcat().subscribe(data => {
      this.cat_list = data.data;
    });
  }
  //get category ends

  //get sub category starts
  selectedcat(value) {
    this.subcatdropdown(value);
  }
  subcatdropdown(cat) {
    this.appservice.getsubcat(cat).subscribe(data => {
      this.subcat_list = data.data;
    });
  }
  //get sub category ends

  //get country starts
  countrydropdown() {
    this.appservice.getcountry().subscribe(data => {
      this.country_list = data.data;
    });
  }
  //get country ends

  //get state starts
  statedropdown(param) {
    this.appservice.getstate(param).subscribe(data => {
      this.state_list = data.data;
    });
  }
  //get state ends

  //get city starts
  citydropdown(state, country) {
    this.appservice.getcity(state, country).subscribe(data => {
      this.city_list = data.data;
    });
  }
  //get city ends

  //get state tut starts
  statetutdropdown(param) {
    this.appservice.getstate(param).subscribe(data => {
      this.state_tut_list = data.data;
    });
  }
  //get state tut ends

  //get city tut starts
  citytutdropdown(state, country) {
    this.appservice.getcity(state, country).subscribe(data => {
      this.city_tut_list = data.data;
    });
  }
  //get city tut ends

  //get state tut starts
  stateworkdropdown(param) {
    this.appservice.getstate(param).subscribe(data => {
      this.state_work_list = data.data;
    });
  }
  //get state tut ends

  //get city tut starts
  cityworkdropdown(state, country) {
    this.appservice.getcity(state, country).subscribe(data => {
      this.city_work_list = data.data;
    });
  }
  //get city tut ends

  getwilayatbyid(country, state) {
    this.profileService.getcity(country, state).subscribe(data => this.wilayatlist = data.data);
  }
  selectedGovernorate(value) {
    if (this.governoratelist) {
      //alert(value)
      this.governoratelist.forEach(y => {
        if (y.opalstatemst_pk == value) {
          // this.comanydetialsform.controls['governorate'].setValue(value);
          this.selectedEstGovernorate = y.osm_statename_en;
          this.selectedEstGovernorateAr = y.osm_statename_ar;
          this.getwilayatbyid(31, value);
        }
      });
    }
    else {
      this.getRegAppDtls();
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
  clickfilterEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filternames = this.i18n('table.shows');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filternames = this.i18n('table.hides');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  //previous button
  prev() {
    this.disableSubmitButton = true;
    this.mattab = -1;
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
  }
  //institute detials
  addinstite() {
    if (this.appdtlssavetmp_id) {
      this.disableSubmitButton = true;
      this.mattab = 1;
      
      this.scrollTo('pagescroll');
      this.disableSubmitButton = false;
    } else {
      swal({
        title: this.i18n('maincenter.kindfill'),
        text: " ",
        icon: 'success',
        buttons: [false, "Ok"],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      })
    }

  }
  //International Recognition
  awardcancel() {
    if (this.awaredForm.touched) {
      if (this.awaredForm.get('appintrecogtmp_pk').value) {
        swal({
          title: this.i18n('maincenter.doyouwantupdate'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.awaredForm.reset();
            this.drvInputed.selectedFilesPk = [0];
            this.edit_arard = false;
            this.disableSubmitButton = true;
            this.ShowHide = true;
            this.international = false;
            this.mattab = 2;
            this.pageScrolltop();
            this.scrollTo('pagescroll');
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
            setTimeout(() => {
              this.getStaffDtls();

            }, 1000);
          }
        });
      } else {
        swal({
          title: this.i18n('maincenter.doyouwantadd'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.awaredForm.reset();
            this.drvInputed.selectedFilesPk = [0];
            this.edit_arard = false;
            this.disableSubmitButton = true;
            this.ShowHide = true;
            this.international = false;
            this.mattab = 2;
            this.pageScrolltop();
            this.scrollTo('pagescroll');
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
            setTimeout(() => {
              this.getStaffDtls();

            }, 1000);
          }
        });
      }

    }
    else {
      this.disableSubmitButton = true;
      this.awaredForm.reset();
      this.drvInputed.selectedFilesPk = [0];
      this.edit_arard = false;
      this.disableSubmitButton = true;
      this.ShowHide = true;
      this.international = false;
      this.mattab = 2;
      this.pageScrolltop();
      this.scrollTo('pagescroll');
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);
      setTimeout(() => {
        this.getStaffDtls();

      }, 1000);
    }


  }

  nextOperate() {
    this.disableSubmitButton = true;
    this.mattab = 3;
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
  }
  previnst() {
    this.disableSubmitButton = true;
    this.mattab = 1;
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
  }
  //tabshowhide
  sHowhide() {
    this.ShowHide = false;
    this.international = true;
    this.scrollTo('pagescroll');
    
  }

  sHowhideoperater() {
    this.disableSubmitButton = true;
    this.operatcont = true;
    this.ShowHide = false;
    this.scrollTo('pagescroll');
    
    this.disableSubmitButton = false;
  }
  previnter() {
    this.disableSubmitButton = true;
    this.mattab = 2;
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
  }
  nextDocument() {
    this.disableSubmitButton = true;
    this.mattab = 4;
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
  }
  operCancel() {
    if (this.OperatorContractForm.touched) {
      if (this.OperatorContractForm.get('appoprcontracttmp_pk').value) {
        swal({
          title: this.i18n('maincenter.doyouwantupdatecour'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.edit_opr = false;
            this.disableSubmitButton = true;
            this.mattab = 3;
            this.pageScrolltop();
            this.operatcont = false;
            this.ShowHide = true;
            this.scrollTo('pagescroll');
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
          }
        });
      } else {
        swal({
          title: this.i18n('maincenter.doyouwantaddcour'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.edit_opr = false;
            this.disableSubmitButton = true;
            this.mattab = 3;
            this.pageScrolltop();
            this.operatcont = false;
            this.ShowHide = true;
            this.scrollTo('pagescroll');
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
          }
        });
      }

    }
    else {
      this.disableSubmitButton = true;
      this.edit_opr = false;
      this.disableSubmitButton = true;
      this.mattab = 3;
      
      this.operatcont = false;
      this.ShowHide = true;
      this.scrollTo('pagescroll');
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);
    }


  }
  //document
  nextOperator() {
    this.mattab = 3;
    
    this.scrollTo('pagescroll');
  }
  prevoperat() {
    this.disableSubmitButton = true;
    this.mattab = 3;
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
  }

  saveDocument() {
   
    this.disableSubmitButton = true;
    this.appservice.saveDocuments(this.documentForm.value, this.appdtlssavetmp_id, this.doc_id).subscribe(data => {
      this.doc_id = data['data'].data;
     
      if (data.data.status == '1') {
        this.getCompDtls();
        //if(this.staffForm.get('staffinforepo_pk').value){
        this.toastr.success(this.i18n('maincenter.docureqsave'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        // }else{
        //   this.toastr.success('Staff Added Successfully.', ''), {
        //     timeOut: 2000,
        //     closeButton: false,
        //   };
        // }

        setTimeout(() => {
          this.getdoc(this.appdtlssavetmp_id)
        }, 2000);

        //this.awaredForm.reset();

      }
      this.mattab = 5;
      
      this.scrollTo('pagescroll');
      // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course';       
      this.disableSubmitButton = false;
    });
    // }else{
    //   this.focusInvalidInput(this.documentForm);
    // }
  }
  
  //course
  showHidecourse() {
    var breadCrumb ={
      title: 'Training Centre Certification',
      urls: [
        { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
        { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),page:2 },
        { title: 'Course', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }

      ]
  };
  this.remoteService.breadcrumCookieValue(breadCrumb);
    this.disableSubmitButton = true;
    this.courses = true;
    this.ShowHide = false;
    this.disableSubmitButton = false;
    this.id = '0';
    this.value = 'none';
    
    // this.mattab = 5;
  }
  courseAdd() {
    // if (this.CourseForm.valid) {
    //   this.courses = false;
    // this.ShowHide = true;
    // this.mattab = 5;
    // }

  }
  canclcourse() {

    if (this.CourseForm.touched) {
      if (this.CourseForm.get('appoffercoursetmp_pk').value) {
        swal({
          title: this.i18n('maincenter.doyouwantcourse'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.CourseForm.reset();
            this.CourseForm.controls['course_titleen'].enable();
            this.CourseForm.controls['course_titlear'].enable();
            this.CourseForm.controls['cour_cate'].enable();
            this.edit_cour = false;
            this.disableSubmitButton = true;
            this.courses = false;
            this.ShowHide = true;
            this.mattab = 1;
            
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);

          }
        });
      } else {
        swal({
          title: this.i18n('maincenter.doyouwantcourseadd'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          closeOnClickOutside: false,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.CourseForm.reset();
            this.CourseForm.controls['course_titleen'].enable();
            this.CourseForm.controls['course_titlear'].enable();
            this.CourseForm.controls['cour_cate'].enable();
            this.edit_cour = false;
            this.disableSubmitButton = true;
            this.courses = false;
            this.ShowHide = true;
            this.mattab = 1;
            
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);

          }
        });
      }

    }
    else {
      this.disableSubmitButton = true;
      this.CourseForm.reset();
      this.CourseForm.controls['course_titleen'].enable();
      this.CourseForm.controls['course_titlear'].enable();
      this.CourseForm.controls['cour_cate'].enable();
      this.edit_cour = false;
      this.disableSubmitButton = true;
      this.courses = false;
      this.ShowHide = true;
      this.mattab = 1;
      
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);

    }


  }

  prevdocument() {
    this.disableSubmitButton = true;
    this.mattab = 0;
    this.disableSubmitButton = false;

  }

  subdesk() {
    if (this.projectpk == 4) {
      if (this.staffconfigstatus == 'notok') {
        swal({
          // title: this.i18n('Kindly add the Minimum required Staff for all the selected Course Sub-categories to Submit for Desktop Review.'),
          title: '',
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false,
          content: {
            element: 'div',
            attributes: {
              innerHTML: this.staffconfigmsg_en
            }
          }
        });
        return false;
      }
      if(this.staffallvaild == 'no'){
        swal({
          title: 'Please add all document for inspector',
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('uploadfile.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        return false;
      }
    }
    if(this.projectpk == 1) {
      this.popupContent = this.i18n('maincenter.doyousubmtbranch')
    } else {
      this.popupContent = this.i18n('Do you want to confirm submission of the RAS Inspection Certification Form?')
    }
    swal({
      title: this.popupContent,
      // text: 'You can still recover the file from the JSRS drive.',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.appservice.savesubdesk(this.appdtlssavetmp_id, this.applystatus,this.projectpk,'','no').subscribe(data => {

          this.FormTemplate = 'success';
          this.renewal = false;
          this.getCurBranch(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
          this.getRegAppDtls();
          if(this.projectpk == 1) {
            this.toastr.success(this.i18n('maincenter.popsubmit'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }else {
            this.toastr.success(this.i18n('RAS Inspection Certification Form Submitted Successfully.'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          setTimeout(() => {
            this.disableSubmitButton = false;
          }, 2000);

        })
      }
    });
  }


  checkCivilNum() {

    let repo = this.staffForm.get('staffinforepo_pk').value;

    this.civil_num_val = this.staffForm.get('civil_num').value;
    this.appservice.checkcivilnumval(this.civil_num_val, repo).subscribe(data => {

      if (data.data.status == 1) {

        if (data.data.data.appdt_projectmst_fk == 1) {
          swal({
            title: this.i18n('The Staff is added in different location of your centre. You cannot add the staff from your different Centre’s Location'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
              this.staffForm.controls['civil_num'].setErrors({ 'incorrect': true });
              this.staffForm.controls['staffeng'].setValue("");
              this.staffForm.controls['staffarab'].setValue("");
              this.staffForm.controls['gend_er'].setValue("");
              this.staffForm.controls['national'].setValue("");
              this.staffForm.controls['house'].setValue("");
              this.staffForm.controls['houseadd'].setValue("");
              this.staffForm.controls['state'].setValue("");
              this.staffForm.controls['city'].setValue("");
              this.staffForm.controls['staffinforepo_pk'].setValue("");
              this.staffForm.controls['date_birth'].setValue("");
              this.staffForm.controls['email_id'].setValue("");
              this.staffrep_id = '';
              this.genderShow = false;
              this.ageShow = true;
              return false;
            }
          });
          //   return false;
        } else if (data.data.data.appiit_officetype == 1) {
          swal({
            title: this.i18n('You cannot add this Staff as the Staff (with the provided Civil Number) is already registered with your Centre at a different location'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
              this.staffForm.controls['civil_num'].setErrors({ 'incorrect': true });
              this.staffForm.controls['staffeng'].setValue("");
              this.staffForm.controls['staffarab'].setValue("");
              this.staffForm.controls['gend_er'].setValue("");
              this.staffForm.controls['national'].setValue("");
              this.staffForm.controls['house'].setValue("");
              this.staffForm.controls['houseadd'].setValue("");
              this.staffForm.controls['state'].setValue("");
              this.staffForm.controls['city'].setValue("");
              this.staffForm.controls['staffinforepo_pk'].setValue("");
              this.staffForm.controls['date_birth'].setValue("");
              this.staffForm.controls['email_id'].setValue("");
              this.staffrep_id = '';
              this.genderShow = false;
              this.ageShow = true;
              return false;
            }
          });
        } else {
          this.statedropdown(31);
          this.citydropdown(data.data.data.sir_opalstatemst_fk, 31);
          this.opercourdropdown(this.appdtlssavetmp_id);
          this.staffForm.patchValue({
            civil_num: data.data.data.sir_idnumber,
            staffeng: data.data.data.sir_name_en,
            staffarab: data.data.data.sir_name_ar,
            email_id: data.data.data.sir_emailid,
            gend_er: data.data.data.sir_gender,
            national: data.data.data.sir_nationality,
            house: data.data.data.sir_addrline1,
            houseadd: data.data.data.sir_addrline2,
            state: data.data.data.sir_opalstatemst_fk,
            city: data.data.data.sir_opalcitymst_fk,
            staffinforepo_pk: data.data.data.staffinforepo_pk,
            date_birth: data.data.data.sir_dob,
          });

          this.staffFormedu.enable();
          this.staffworkexperienceForm.enable();
          if (data.data.data.sir_moheridoc) {
            this.mogerInputed.selectedFilesPk = [data.data.data.sir_moheridoc];
          } else {
            this.mogerInputed.selectedFilesPk = [];
          }
          setTimeout(() => {
            this.getStaffbasDtls(data.data.data.staffinforepo_pk);
          }, 2000);
          setTimeout(() => {
            this.getStaffworkDtls(data.data.data.staffinforepo_pk)
          }, 2000);
          this.staffrep_id = data.data.data.staffinforepo_pk;

        }
      } else if (data.data.status == 3) {
        if (data.data.data.appdt_projectmst_fk) {
          swal({
            title: this.i18n('The Staff is added in different centre. You cannot add the staff who is already added in different centre'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
              this.staffForm.controls['civil_num'].setErrors({ 'incorrect': true });
              this.staffForm.controls['staffeng'].setValue("");
              this.staffForm.controls['staffarab'].setValue("");
              this.staffForm.controls['gend_er'].setValue("");
              this.staffForm.controls['national'].setValue("");
              this.staffForm.controls['house'].setValue("");
              this.staffForm.controls['houseadd'].setValue("");
              this.staffForm.controls['state'].setValue("");
              this.staffForm.controls['city'].setValue("");
              this.staffForm.controls['staffinforepo_pk'].setValue("");
              this.staffForm.controls['date_birth'].setValue("");
              this.staffForm.controls['email_id'].setValue("");
              this.staffrep_id = '';
              this.genderShow = false;
              this.ageShow = true;
              return false;
            }
          });
        }else{
          this.statedropdown(31);
          this.citydropdown(data.data.data.sir_opalstatemst_fk, 31);
          this.opercourdropdown(this.appdtlssavetmp_id);
          this.staffForm.patchValue({
            civil_num: data.data.data.sir_idnumber,
            staffeng: data.data.data.sir_name_en,
            staffarab: data.data.data.sir_name_ar,
            email_id: data.data.data.sir_emailid,
            gend_er: data.data.data.sir_gender,
            national: data.data.data.sir_nationality,
            house: data.data.data.sir_addrline1,
            houseadd: data.data.data.sir_addrline2,
            state: data.data.data.sir_opalstatemst_fk,
            city: data.data.data.sir_opalcitymst_fk,
            staffinforepo_pk: data.data.data.staffinforepo_pk,
            date_birth: data.data.data.sir_dob,
          });

          this.staffFormedu.enable();
          this.staffworkexperienceForm.enable();
          if (data.data.data.sir_moheridoc) {
            this.mogerInputed.selectedFilesPk = [data.data.data.sir_moheridoc];
          } else {
            this.mogerInputed.selectedFilesPk = [];
          }
          setTimeout(() => {
            this.getStaffbasDtls(data.data.data.staffinforepo_pk);
          }, 2000);
          setTimeout(() => {
            this.getStaffworkDtls(data.data.data.staffinforepo_pk)
          }, 2000);
          this.staffrep_id = data.data.data.staffinforepo_pk;
        }

        // this.staffForm.controls['civil_num'].setErrors({ 'incorrect': true });
        // this.staffForm.controls['staffeng'].setValue("");
        // this.staffForm.controls['staffarab'].setValue("");
        // this.staffForm.controls['gend_er'].setValue("");
        // this.staffForm.controls['national'].setValue("");
        // this.staffForm.controls['house'].setValue("");
        // this.staffForm.controls['houseadd'].setValue("");
        // this.staffForm.controls['state'].setValue("");
        // this.staffForm.controls['city'].setValue("");
        // this.staffForm.controls['staffinforepo_pk'].setValue("");
        // this.staffForm.controls['date_birth'].setValue("");
        // this.staffForm.controls['email_id'].setValue("");
        // this.staffrep_id = '';
        // this.genderShow = false;
        // this.ageShow = true;
        // return false;

      } else if (data.data.status == 2) {
        if (this.staffForm.get('civil_num').value) {
          this.staffForm.controls['staffeng'].setValue("");
          this.staffForm.controls['staffarab'].setValue("");
          this.staffForm.controls['gend_er'].setValue("");
          this.staffForm.controls['national'].setValue("");
          this.staffForm.controls['house'].setValue("");
          this.staffForm.controls['houseadd'].setValue("");
          this.staffForm.controls['state'].setValue("");
          this.staffForm.controls['city'].setValue("");
          this.staffForm.controls['staffinforepo_pk'].setValue("");
          this.staffForm.controls['date_birth'].setValue("");
          this.staffForm.controls['email_id'].setValue("");
          this.mogerInputed.selectedFilesPk = [];
          this.staffrep_id = '';
          this.ageShow = true;
          this.genderShow = false;
          return false;

        }

      }

      if(data.data.data.sir_dob == '0000-00-00'){

                this.staffForm.controls['date_birth'].setValue("");

      }

    });
    
  }
  //staff
  canclstaff() {
    if(this.projectpk == 1){
      var breadCrumb ={
        title: 'Training Centre Certification',
        urls: [
          { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
          { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' },  
        ]
    };
    }else{
      var breadCrumb ={
        title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
          { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' },  
        ]
    };
    }
    this.remoteService.breadcrumCookieValue(breadCrumb);

    if (this.staffForm.touched || this.courseselectForm.touched) {
      if (this.staffForm.get('staffinforepo_pk').value) {
        swal({
          title: this.i18n('maincenter.doyouwantdelestaffupdate'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.staffForm.controls['civil_num'].enable();
            this.staffForm.controls['staffeng'].enable();
            this.staffForm.controls['staffarab'].enable();
            this.staffForm.controls['date_birth'].enable();
            this.staffForm.controls['gend_er'].enable();
            this.fileemoheri = false;
            this.mattab = 6;
            this.pageScrolltop();
            this.staffformshow = false;
            this.ShowHide = true;

            this.staffForm.reset();
            this.staffFormedu.reset();
            this.staffworkexperienceForm.reset();
            this.courseselectForm.reset();
            this.staffrep_id = "";
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);

          }
        });
      } else {
        swal({
          title: this.i18n('maincenter.doyouwantdelestaffadd'),
          text: this.i18n('maincenter.doyouwantnote'),
          icon: 'warning',
          buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true;
            this.staffForm.controls['civil_num'].enable();
            this.staffForm.controls['staffeng'].enable();
            this.staffForm.controls['staffarab'].enable();
            this.staffForm.controls['date_birth'].enable();
            this.staffForm.controls['gend_er'].enable();
            this.fileemoheri = false;

            this.mattab = 6;
            this.pageScrolltop();
            this.staffformshow = false;
            this.ShowHide = true;

            this.staffForm.reset();
            this.staffFormedu.reset();
            this.staffworkexperienceForm.reset();
            this.courseselectForm.reset();
            this.staffrep_id = "";
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);

          }
        });
      }

    }
    else {
      this.disableSubmitButton = true;
      this.staffForm.controls['civil_num'].enable();
      this.staffForm.controls['staffeng'].enable();
      this.staffForm.controls['staffarab'].enable();
      this.staffForm.controls['date_birth'].enable();
      this.staffForm.controls['gend_er'].enable();
      this.fileemoheri = false;

      this.mattab = 6;
      this.pageScrolltop();
      this.staffformshow = false;
      this.ShowHide = true;

      this.staffForm.reset();
      this.staffFormedu.reset();
      this.staffworkexperienceForm.reset();
      this.courseselectForm.reset();
      this.staffrep_id = "";
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);
    }
    this.staffconfigurationcheckinras();

  }
 
  showHidestaff() {
    if(this.projectpk == 1){
      var breadCrumb ={
        title: 'Training Centre Certification',
        urls: [
          { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
          { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),page:3 },
          { title: 'Staff', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
  
        ]
    };
    }else{
      var breadCrumb ={
        title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
          { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),page:3 },
          { title: 'Staff', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
  
        ]
    };
    }
    this.remoteService.breadcrumCookieValue(breadCrumb);

    this.staffrep_id = '';
    this.staffForm.reset();
    this.staffFormedu.reset();
    this.staffworkexperienceForm.reset();
    this.courseselectForm.reset();
    this.documentUploadForm.reset();
    this.interRecListDataStaffbas = new MatTableDataSource([]);
    this.interRecListDataStaffwork = new MatTableDataSource([]);
    this.mogerInputed.selectedFilesPk = [];
    this.molEmploymentdrvInputed.selectedFilesPk = [];
    this.ropLicensedrvInputed.selectedFilesPk = [];
    this.idcarddrvInputed.selectedFilesPk = [];

    this.disableSubmitButton = true;
    this.staffformshow = true;
    this.ShowHide = false;
    this.disableSubmitButton = false;
    this.ageShow = true;
    this.pageScrolltop();
    this.onchangecount();
  }
  prevcourse() {
    this.disableSubmitButton = true;
    this.mattab = 1;
    this.disableSubmitButton = false;
  }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      console.log(elementList)
    } catch (error) {
      console.log('page-content')
    }
  }
  pageonScroll(event: any) {
    if (event.target.scrollTop <= 1) {
      //this.isShowBtnScrollTop = false;
    } else {
      //this.isShowBtnScrollTop = true;
    }
  }
  fileeSelectedlogo(file, fileId) {
    this.disableSubmitButton = true;
    fileId.selectedFilesPk = file;
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }
  deleteLogo(event: any) {

    swal({
      title: this.i18n('uploadfile.doyouimage'),
      // text: 'You can still recover the file from the JSRS drive.',
      icon: "warning",
      buttons: [this.i18n('uploadfile.cancle'), this.i18n('uploadfile.ok')],
      dangerMode: true,
      // className: "swal-delete",
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {

    })
  }
  
  onTabSelect(event: any) {
    // const index = event.index;
    // this.tabClickFunctions[index]();
  }
  
  locale: LocaleConfig = {
    format: 'DD-MM-YYYY',
  }

  omancont() {
    this.staffForm.controls.gender_address.setValue(this.i18n('staff.oman'))
  }
  cityselect(country) {
    if (country == 31) {
      this.oman = true;
      console.log(true)
    }
    else if (country = 31) {
      this.oman = false;
    }
  }
  cityselecttwo(countrytwo) {
    if (countrytwo == 31) {
      this.nonoman = true;
    }
    else if (countrytwo != 31) {
      this.nonoman = false;
    }
  }
  dateFltrChange(event) {
    // let stDate = '';
    // let edDate = '';
    // this.dateFilterSt = '';
    // this.dateFilterEd = '';
    // if (this.opal_memb_expiry.value) {
    //   stDate = (this.opal_memb_expiry.value.startDate) ? moment(this.opal_memb_expiry.value.startDate).format('YYYY/MM/DD') : '';
    //   edDate = (this.opal_memb_expiry.value.endDate) ? moment(this.opal_memb_expiry.value.endDate).format('YYYY/MM/DD') : '';
    //   this.dateFilterSt = (this.opal_memb_expiry.value.startDate) ? moment(this.opal_memb_expiry.value.startDate).format('DD-MM-YYYY') : '';
    //   this.dateFilterEd = (this.opal_memb_expiry.value.endDate) ? moment(this.opal_memb_expiry.value.endDate).format('DD-MM-YYYY') : '';
    // }
  }

  secondaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getOprContrDtls();
    this.Contentplaceloader = true;

  }
  thirdPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getCourDtls();
    this.Contentplaceloader = true;

  }
  fourthPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getStaffDtls();
    this.Contentplaceloader = true;

  }
  fifthPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getStaffbasDtls(this.staffrep_id);
    this.Contentplaceloader = true;

  }
  sixthPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getStaffworkDtls(this.staffrep_id);
    this.Contentplaceloader = true;

  }
  seventhPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;

  }
  cancelreg() {
    swal({
      title: this.i18n('maincenter.doyouwanttoback'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.route.navigate(['/dashboard/supplier']);
        this.pageScrolltop();
        setTimeout(() => {
          this.disableSubmitButton = false;
        }, 2000);
      }
    });


  }
  clearFilterone() {
    this.appl_form.reset("");
    this.appl_office.reset()
    this.bran_name.reset("");
    this.appl_status.reset("");
    this.Addedon.reset();
    this.cert.reset();
    this.date_expiry.reset("");
    this.addedon_branch.reset("");
    this.lastUpdated_branch.reset("");
    this.getInterRecDtls();
    $(".clear").trigger("click");
  }
  clearFilter() {
    this.Awarding.setValue("");
    this.LastAudited.setValue("");
    this.Status.setValue("");
    this.Addedon.reset();
    this.LastUpdated.reset();
    this.addedon_branch.setValue("");
    this.lastUpdated_branch.setValue("");
    this.getInterRecDtls();
    $(".clear").trigger("click");
  }
  clearFiltersecound() {
    this.operatorname.setValue("");
    this.contracttype.setValue("");
    this.contractstart.setValue("");
    this.contractend.setValue("");
    this.Statusone.setValue("");
    this.addon.setValue("");
    this.lastUpdated.reset();
    this.getOprContrDtls();
    $(".clear").trigger("click");
  }
  clearFilterthird() {
    this.course_title.setValue("");
    this.course_dura.setValue("");
    this.course_level.setValue("");
    this.course_cate.setValue("");
    this.course_test.setValue("");
    this.StatusCour.setValue('');
    this.adddoncour.setValue("");
    this.LastUpdatedcour.setValue("");
    this.getCourDtls();
    $(".clear").trigger("click");
  }
  clearFilterfour() {
    this.civil_numb.setValue("");
    this.staff_name.setValue("");
    this.email_id.setValue("");
    this.age.setValue("");
    this.gender.setValue("");
    this.Nation.setValue("");
    this.cont_type.setValue("");
    this.main_role.setValue("");
    this.status_cour.setValue("");
    this.addd_oncour.setValue("");
    this.LastUpdatedstaff.setValue("");
    this.LastUpdatedstaffdate.setValue("")
    $(".clear").trigger("click");
  }
  clearFiltereducation() {
    this.institute.setValue("");
    this.degree.setValue("");
    this.year_join.setValue("");
    this.year_pass.setValue("");
    this.grade.setValue("");
    this.add_On.reset();
    this.Last_Date.reset();
    $(".clear").trigger("click");
  }
  clearFilterework() {
    this.oranisation.setValue("");
    this.date_joined.reset();
    this.work_till.reset();
    this.count.setValue("");
    this.gover.setValue("");
    this.wilaya.setValue("");
    this.designation.setValue("");
    this.add_edOn.setValue("");
    this.date_last.reset();
    $(".clear").trigger("click");
  }
  public options = Lccdivison.switchoption
  id: any = "";
  value = "none";
  yesno: boolean = false;
  onSelectionChange(entry, value) {
    this.id = entry;
    this.value = value;
    if (this.id == 0) {
      this.value = 'No';
      this.yesno = true;
      this.CourseForm.controls['slider'].setValue(2);
    }
    else {
      this.value = 'Yes';
      this.yesno = true;
      this.CourseForm.controls['slider'].setValue(1);
    }
  }
  onSelectionChangeyes(entry) {
    this.id = entry;
    if (this.id == 2) {
      this.value = 'No';
      this.yesno = true;
      this.CourseForm.controls['slider'].setValue(2);
    }
    else {
      this.value = 'Yes';
      this.yesno = true;
      this.CourseForm.controls['slider'].setValue(1);
    }
  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
    // this.expandedElement = false;
  }
  animateCallback = (animationState: AnimationEvent) => {
    // if (animationState.toState === 'expanded') {
    //   animationState.element.classList.add('my-class');
    // } else if (animationState.toState === 'collapsed') {
    //   animationState.element.classList.remove('my-class');
    // }
  };

  viewinvoice() {
    this.routeid.queryParams.subscribe(params => {
      //this.refname = params['id'];
    });
  }
  public uploadlength = [];
  onModelChange(textValue: string, index): void {
    this.uploadlength[index] = textValue.length;
  }
  isCheckboxDisabled: boolean = false;
  cleardate: boolean = false;
  dateSelected(event: MatDatepickerInputEvent<Date>) {
    const selectedDate: Date = event.value;
    if (selectedDate) {
      this.isCheckboxDisabled = true;
      this.cleardate = true;
      this.worktilled = true;
    }
  }
  clearDate() {
    this.staffworkexperienceForm.controls.workdate.reset();
    this.isCheckboxDisabled = false;
    this.cleardate = false;
  }
  notallowed: boolean;
  onCheckboxChange(event: MatCheckboxChange) {
    if (event.checked) {
      this.notallowed = true;
      this.staffworkexperienceForm.controls.workdate.reset();
      this.worktilled = false;
      this.staffworkexperienceForm.controls['workdate'].setErrors(null);
    } else {
      this.notallowed = false;
      this.staffworkexperienceForm.controls['workdate'].setErrors({ 'incorrect': true });
      this.worktilled = true;
    }
  }

  staffCv(sir_staffcv) {
    this.disableSubmitButton = true;
    window.open(environment.baseUrl + 'web/cv/' + sir_staffcv, "_blank");
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }

  onselect() {
    if (this.staffForm.controls.gend_er.value == 1) {
      this.genderselect = '1';
      this.genderShow = true;
    }
    else if (this.staffForm.controls.gend_er.value == 2) {
      this.genderselect = '2';
      this.genderShow = true;
    }
    else {
      this.genderselect = ' ';
    }
  }

  //filterformcontral name

  appl_form = new FormControl('');
  appl_office = new FormControl('')
  bran_name = new FormControl('');
  appl_status = new FormControl('');
  cert = new FormControl('');
  date_expiry = new FormControl('');
  addedon_branch = new FormControl('');
  lastUpdated_branch = new FormControl('');
  lastUpdated_cour = new FormControl('');
  stat_cour = new FormControl('');
  lastUpdatedcour = new FormControl('');

  pageScrolltop() {
    console.log("no")
    document.getElementById('branchcenter_container').scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest"

    });
  }

  finished() {
    this.FormTemplate = 'MainCentre';
  }

  //apply certificate
  applycertificate() {
    if(this.projectpk == 1){
      var breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre/'+this.security.encrypt(1) ,page:1},
            { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
          ] 
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      }else{
        const breadCrumb ={
          title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
            urls: [
              { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
              { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
  
            ]
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
      }

    this.instituteform.reset();
    this.selectofficePk = null;
    this.instituteform.enable();
    this.disableSubmitButton = true;
    this.aprdec_status = false;
    this.notallowedone = true;
    this.appdtlssavetmp_id = 0;
    this.course_staff_status = false;
    this.applystatus = '';
    this.noEdit = false;
    //this.instituteform.controls['offtype'].disable();
    this.FormTemplate = 'branchFroms';
    setTimeout(() => {
      this.getCourDtls();
      this.getStaffDtls();
      this.disableSubmitButton = false;
    }, 2000);
  }

  canc() {
    if (this.instituteform.touched) {
      // if(this.applystatus==1) {
      swal({
        title: this.i18n('maincenter.doyouwantedit'),
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          this.ins_status = 0;
          setTimeout(() => {
            this.getCenterStatus(this.appdtlssavetmp_id);
            this.getRegAppDtls();
            this.FormTemplate = 'MainCentre';
          }, 1000);
          
        }
      });
    }

    else {
      swal({
        title: this.i18n('Do you want to go back'),
        text: ' ',
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          this.ins_status = 0;
          setTimeout(() => {
            this.getCenterStatus(this.appdtlssavetmp_id);
            this.getRegAppDtls();
            this.FormTemplate = 'MainCentre';

          }, 1000);
          
        }
      });
    }

    if(this.projectpk == 1){
      var breadCrumb ={
          title: 'Training Centre Certification',
          urls: [
            { title: 'Training Centre Certification', url: '/trainingcentremanagement/branchcentre',last:'true' },
          ]   
      };
      this.remoteService.breadcrumCookieValue(breadCrumb);
    }else{
      var breadCrumb ={
          title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
          urls: [
            { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre' ,last:'true' }
          ]
      };
    this.remoteService.breadcrumCookieValue(breadCrumb);
    }
  }

  onchangecount() {
    this.staffForm.controls['count_ry'].enable();
    this.omancountry = false;
    this.staffForm.controls['count_ry'].setValue('31');
    this.staffForm.controls['count_ry'].disable();
    this.statedropdown(31);
    this.omancountry = true;

  }
  redirect() {
    location.reload();
  }

  makepayment(apppk, apptye, appstage, appsts) {

    this.disableSubmitButton = true;
    console.log('encrypt data', apptye, appstage, appsts, apppk);

    if (apptye == 2) {
      if(this.projectpk == 1) {
        this.route.navigate(['trainingcentremanagement/branchcentre'],

        { queryParams: { p: this.security.encrypt(apptye), t: this.security.encrypt(appstage), s: this.security.encrypt(appsts), at: this.security.encrypt(apppk), f: 'bc', bc: 'tnbc', nwrn: 'rnj' } });
      } else {
        this.route.navigate(['trainingcentremanagement/rasbranchcentre'],

        { queryParams: { p: this.security.encrypt(apptye), t: this.security.encrypt(appstage), s: this.security.encrypt(appsts), at: this.security.encrypt(apppk), f: 'bc', bc: 'tnbc', nwrn: 'rnj' } });
      }
     
    } else {
      if(this.projectpk == 1) {
        this.route.navigate(['trainingcentremanagement/branchcentre'],

        { queryParams: { p: this.security.encrypt(apptye), t: this.security.encrypt(appstage), s: this.security.encrypt(appsts), at: this.security.encrypt(apppk), f: 'bc', bc: 'tnbc' } });
      } else {
        this.route.navigate(['trainingcentremanagement/rasbranchcentre'],

        { queryParams: { p: this.security.encrypt(apptye), t: this.security.encrypt(appstage), s: this.security.encrypt(appsts), at: this.security.encrypt(apppk), f: 'bc', bc: 'tnbc' } });
      }
     
    }
 
  }

  openCert(value) {
    const pdfUrl = value;
    window.open(pdfUrl, '_blank');
  }


  gomain() {
    if(this.projectpk == 1) {
      this.route.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(1),renew: this.security.encrypt(3) } });
    }else {
      this.route.navigate(['vehiclemanagement/rascentre'],{ queryParams: { p: this.security.encrypt(4),renew: this.security.encrypt(3)}});    }
  
  }
  gomainedit() {
    if(this.projectpk == 1) {
      this.route.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(1),renew: this.security.encrypt(2) } });
    }else {
      this.route.navigate(['/vehiclemanagement/rascentre'], { queryParams: { p: this.security.encrypt(4),renew: this.security.encrypt(2) } });
    }
  }

  dynlink(appdtls) {
    if (appdtls.appdt_status == '3') {
      if(this.projectpk == 1) {
       this.route.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(1),renew: this.security.encrypt(1) } });
      }else {
        this.route.navigate(['/vehiclemanagement/rascentre'], { queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1) } });
      }
      } else {
        if(this.projectpk == 1)  {
          this.route.navigate(['trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(appdtls.appdt_projectmst_fk), t: this.security.encrypt(appdtls.appdt_apptype), s: this.security.encrypt(appdtls.appdt_status), at: this.security.encrypt(appdtls.applicationdtlstmp_pk), bc: 'paycnt', f: 'mc', nwrn: 'rnj' } });
        }else {
          this.route.navigate(['vehiclemanagement/rascentre'], { queryParams: { p: this.security.encrypt(appdtls.appdt_projectmst_fk), t: this.security.encrypt(appdtls.appdt_apptype), s: this.security.encrypt(appdtls.appdt_status), at: this.security.encrypt(appdtls.applicationdtlstmp_pk), bc: 'paycnt', f: 'mc', nwrn: 'rnj' } });

        }
    }
  }

  showprofile(app_pk) {
    //window.open('trainingcentremanagement/ViewMaincentre?app_pk='+app_pk);
    this.route.navigate(['/trainingcentremanagement/ViewMaincentre'], { queryParams: { app_pk: this.security.encrypt(app_pk) } });
  }

  showprofileview(app_pk, status) {

    this.appservice.getAppMainDtls(app_pk, '2').subscribe(dataresmain => {
      if (dataresmain.data.data) {
        this.appmaindtlsprofile = dataresmain.data.data;
        //window.open('trainingcentremanagement/ViewMaincentre?app_pk='+this.appmaindtlsprofile.dataall.appdm_applicationdtlstmp_fk);
        this.route.navigate(['/trainingcentremanagement/ViewMaincentre'], { queryParams: { app_pk: this.security.encrypt(this.appmaindtlsprofile.dataall.applicationdtlsmain_pk) } });
      }
    });


  }
  showprofileviewras(app_pk, status) {

    // this.appservice.getAppMainDtlsras(app_pk, '2').subscribe(dataresmain => {
    //   if (dataresmain.data.data) {
    //     this.appmaindtlsprofile = dataresmain.data.data; 
        //window.open('trainingcentremanagement/ViewMaincentre?app_pk='+this.appmaindtlsprofile.dataall.appdm_applicationdtlstmp_fk);
        this.route.navigate(['/trainingcentremanagement/viewras'], { queryParams: { app_pk: this.security.encrypt(app_pk) } });
    //   }
    // });


  }

  onoffice() {
    // this.instituteform.controls['offtype'].enable();
    // this.instituteform.controls['offtype'].setValue(2);
    // this.instituteform.controls['offtype'].disable();
    // console.log('345')
  }
  showhideeducationform(value) {
    this.educationformshow = value;
    this.staffeduedit = false;
  }
  showhideworkexpform(value) {
    this.workexpformshow = value;
    this.selectedDate = null;
    this.cleardate = false;
    this.isCheckboxDisabled = false;
    this.notallowed = false;
    this.staffworkedit = false;
  }
  renew() {
    if(this.projectpk == 1) {
      this.route.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.security.encrypt(1),renew: this.security.encrypt(1) } });
    }else {
      this.route.navigate(['/vehiclemanagement/rascentre'], { queryParams: { p: this.security.encrypt(4),renew: this.security.encrypt(1) } });
    }
  }

  renewbranch() {
    this.disableSubmitButton = true;
    this.aprdec_status = true;
    this.notallowedone = true;
    this.deleteicon = true;
    this.workdeleteicon = true;
    this.instituteform.enable();
    this.CourseForm.enable();
    this.staffForm.enable();
    this.staffFormedu.enable();
    this.staffworkexperienceForm.enable();
    this.courseselectForm.enable();
    this.applystatus = 1;
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 1000);
    console.log(this.applystatus, 'status');

  }
  oncHeckenable(event: MatCheckboxChange) {
    if (event.checked) {
      this.finalsubmitbtn = false;
    } else {
      this.finalsubmitbtn = true;
    }
  }
  splitRoleFunction(data) {
    if (data && typeof data === 'string') {
    this.rolesubcategory = data.split(',');
    this.rolecategory_remove = data.split(',');
    this.rolecategory_remove.shift();
    return this.rolesubcategory[0];
    }else{
      return '';
    }
  }
  splitRascatFunction(data) {
    if (data && typeof data === 'string') {
    this.rolerascatcategory = data.split(',');
    this.rolerascategory_remove = data.split(',');
    this.rolerascategory_remove.shift();
    return this.rolerascatcategory[0];
    }else{
      return '';
    }
  }
  JoinList(value): string {
    return value.join('\n');
  }
  sHowInpection() {
   
  const breadCrumb ={
    title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
      urls: [
        { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
        { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),page:4 },
        { title: 'Inspection Categories', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }
      ]
};

this.remoteService.breadcrumCookieValue(breadCrumb);
    this.InpectionCategary = true;
    this.ShowHide = false;
  }
  checkValidation() {
    if (this.projectpk == 1) {
      this.instituteform.controls['no_techstaff'].setValidators([Validators.required]);
      this.instituteform.controls['curr_learn'].setValidators([Validators.required]);
      this.instituteform.controls['trainprovmax'].setValidators([Validators.required]);
      this.staffForm.controls['inspect_Vtype'].clearValidators();
      this.courseselectForm.controls['filemoher'].setValidators([Validators.required]);
      this.courseselectForm.controls['selectcourses'].setValidators([Validators.required]);
      this.documentUploadForm.controls['id_card'].clearValidators();
      this.documentUploadForm.controls['file_ropLicense'].clearValidators();
      this.documentUploadForm.controls['file_molEmployment'].clearValidators();
    } else {
      this.instituteform.controls['no_techstaff'].clearValidators();
      this.instituteform.controls['curr_learn'].clearValidators();
      this.instituteform.controls['trainprovmax'].clearValidators();
      this.staffForm.controls['inspect_Vtype'].setValidators([Validators.required]);
      this.courseselectForm.controls['filemoher'].clearValidators();
      this.courseselectForm.controls['selectcourses'].clearValidators();
      this.documentUploadForm.controls['id_card'].setValidators([Validators.required]);
      this.documentUploadForm.controls['file_ropLicense'].setValidators([Validators.required]);
      this.documentUploadForm.controls['file_molEmployment'].setValidators([Validators.required]);
    }
    this.instituteform.controls['no_techstaff'].updateValueAndValidity();
    this.instituteform.controls['curr_learn'].updateValueAndValidity();
    this.instituteform.controls['trainprovmax'].updateValueAndValidity();
    this.staffForm.controls['inspect_Vtype'].updateValueAndValidity();
    this.courseselectForm.controls['filemoher'].updateValueAndValidity();
    this.courseselectForm.controls['selectcourses'].updateValueAndValidity();
    this.documentUploadForm.controls['id_card'].updateValueAndValidity();
    this.documentUploadForm.controls['file_ropLicense'].updateValueAndValidity();
    this.documentUploadForm.controls['file_molEmployment'].updateValueAndValidity();
  }
  saveInpectionForm() {
    const breadCrumb ={
      title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
          { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }

        ]
  };
  this.remoteService.breadcrumCookieValue(breadCrumb);
    if(this.InpectionForm.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveinspectioncategory(this.InpectionForm.value,this.appdtlssavetmp_id).subscribe(data => {
        this.disableSubmitButton = false;
        if(data.status == 200){
          // this.res_inspectioncategory = data.data;

          this.InpectionForm.reset();
          this.mattab = 1;
          this.ShowHide = true;
          this.InpectionCategary = false;
          this.scrollTo('pagescroll');
          this.getrascategorydata(10,0,null);
          this.staffconfigurationcheckinras();
          this.toastr.success(this.i18n('Inspection Categories Added Successfully'), ''), {
            timeOut: 2000,
            closeButton: false,
          }; 
         
        }
      
      });
         
        }
    else {
      this.focusInvalidInput(this.InpectionForm)
    }
   
  }
  CancelInpection() {
    const breadCrumb ={
      title: 'RAS Inspection Centre Certification Form (Other Office Certification)',
        urls: [
          { title: 'RAS Inspection Centre Certification Form (Other Office Certification)', url: 'vehiclemanagement/rasbranchcentre',page:1 },
          { title: 'Certification Form ', url: '/trainingcentremanagement/branchcentre'+this.security.encrypt(1),last:'true' }

        ]
  };
  this.remoteService.breadcrumCookieValue(breadCrumb);
    if(this.InpectionForm.touched) {
      swal({
        title: this.i18n('Do you want to cancel adding this Inspection Categories?'),
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.InpectionForm.reset();
          this.mattab = 1;
          this.ShowHide = true;
          this.InpectionCategary = false;
          this.scrollTo('pagescroll');
        }
      });
    }else {
      this.disableSubmitButton = true;
      this.mattab = 1;
      this.ShowHide = true;
      this.InpectionCategary = false;
      setTimeout(() => {
        this.disableSubmitButton = false;
        },2000);
    }
  }
  toggleAllSelection() {
    if (this.allSelected) {
      this.selectbox.options.forEach((item: MatOption) => item.select());
    } else {
      this.selectbox.options.forEach((item: MatOption) => item.deselect());
    }
  }
  getrasinspectioncategory(){
    this.appservice.getrasinspectioncategory(this.projectpk).subscribe(data => {
      if(data.status == 200){
         this.res_inspectioncategory = data.data;
        this.res_inspectioncategory1 = data.data;
        this.rascategorylenth = data.data.length;
        this.res_inspectioncategory1 = data.data;      }

    });
  }
  getrasrole(){
    this.appservice.getrasrole(this.projectpk).subscribe(data => {
      if(data.status == 200){
        this.rolesinstaff = data.data.role;
      }

    });
  }
  getrascategorydata(limit,page,search){
    this.tblplaceholders = true;
    this.appservice.getrascategorydata(limit, page, search,this.appdtlssavetmp_id).subscribe(res => {
      this.tblplaceholders = false;

      if (res.status == 200) {
        this.LengthofInspection = res['data']['record']['totalcount'];

        this.inspectionSource = new MatTableDataSource<inspectionData>(res['data']['record']['applydata']);
        this.inspectionSource.sort = this.sort;
        const newArray1 = this.res_inspectioncategory.filter(item => !res['data']['record']['rascaregory'].includes(item.rascategorymst_pk));
        this.res_inspectioncategory1 = newArray1;
        // this.InpectionForm.controls['inspectionSelect'].setValue(res['data']['record']['rascaregory']);
        this.inpect_list = res['data']['record']['applydata'];
      }
    });
  }
  inspectcat = new FormControl();
  InspectStatus = new FormControl();
  inspectAddedon = new FormControl();
  inpectLastUpdated = new FormControl();
  syncPaginator(event: PageEvent) {
    this.inspectPaginator.pageIndex = event.pageIndex;
    this.inspectPaginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  clearInspection() {
    this.inspectcat.reset();
    this.InspectStatus.reset();
    this.inspectAddedon.reset();
    this.inpectLastUpdated.reset();
    this.getrascategorydata(10, 0, null)
  }
  rasrolecheck(rolevalue){
    //16-Inspector 17-Verifier 18-Supervisor
   if (rolevalue.includes('16') ) {
  this.documentUploadForm.controls['id_card'].setValidators([Validators.required]);
     this.documentUploadForm.controls['file_ropLicense'].setValidators([Validators.required]);
     this.documentUploadForm.controls['file_molEmployment'].setValidators([Validators.required]);
     this.showotherdocument = true;
     this.requiredFordoc = true;
      this.requiredwork = true;
     this.staffworkexperienceForm.controls['file_workexperience'].clearValidators();
   } else {
     this.showotherdocument = false;
     this.requiredFordoc = false;
     this.documentUploadForm.controls['id_card'].clearValidators();
     this.documentUploadForm.controls['file_ropLicense'].clearValidators();
     this.documentUploadForm.controls['file_molEmployment'].clearValidators();
     this.idcarddrvInputed.selectedFilesPk = []
     this.ropLicensedrvInputed.selectedFilesPk = []
     this.molEmploymentdrvInputed.selectedFilesPk = []
     this.requiredwork = false;
     this.staffworkexperienceForm.controls['file_workexperience'].clearValidators();
   }
   this.documentUploadForm.controls['id_card'].updateValueAndValidity();
   this.documentUploadForm.controls['file_ropLicense'].updateValueAndValidity();
   this.documentUploadForm.controls['file_molEmployment'].updateValueAndValidity();
   this.staffworkexperienceForm.controls['file_workexperience'].updateValueAndValidity();
 }
  rasinspectonserch() {
    this.serach = {
      inspectcat_serch: this.inspectcat.value,
      InspectStatus_serch: this.InspectStatus.value,
      inspectAddedon_serch: this.inspectAddedon.value,
      inpectLastUpdated_serch: this.inpectLastUpdated.value
    }
    this.getrascategorydata(10, 0, this.serach)
  }
  deleteinspect(rascategorypk){
    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
      this.appservice.rascheckvehicalcateforymap(this.appdtlssavetmp_id,rascategorypk,this.projectpk).subscribe(res => {
        if(res.data.mapped == 'yes'){
          swal({
            title: this.i18n('Please remove the Staff Members from their respective Inspection Categories to exclude the categories from the Inspection Categories section.'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('uploadfile.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          
        }else{
          this.toastr.success(this.i18n('Inspection Category Deleted Successfully.'), ''), {
            timeOut: 2000,
            closeButton: false,
           }
           this.getrascategorydata(10,0,null);    
           this.getrasinspectioncategory();
           this.staffconfigurationcheckinras();
          this.allSelected = false;
            }

      });
    }
      
    });
  }
  staffconfigurationcheckinras() {
    this.appservice.staffconfigurationcheckinras(this.appdtlssavetmp_id, this.projectpk).subscribe(res => {
      this.staffconfigstatus = res.data.status;
      this.staffconfigmsg_ar = res.data.msg_ar;
      this.staffconfigmsg_en = res.data.msg_en;
      this.staffallvaild = res.data.allfilled;
    });
  }
   optionClick() {
    let newStatus = true;
    this.selectbox.options.forEach((item: MatOption) => {
      if (!item.selected) {
        newStatus = false;
      }
    });
    this.allSelected = newStatus;
  }
  radioButtonGroupChange(data: MatRadioChange) {
    if (data.value == 1) { 
    }
  }
  breadCrumb() {
      const breadClass = document.getElementById('breadCrubHide') as HTMLElement;
      breadClass.style.display = 'block';
      const pageTitle = document.querySelector('.page-title');
      pageTitle.classList.remove('modified-page-title');
  }
  openReport(value) {
    const pdfUrl = value;
    var modifiedUrlString = pdfUrl.replace(/\+\+\+.*/, '');
     var  url = modifiedUrlString+'original.pdf';
    window.open(pdfUrl, '_blank');
  }
  mainofficalreadyapplied(value){
    if(value == 1){
       if(this.mainofficeapplied == 'yes'){
        swal({
          title: this.i18n('Main Office already applied'),
          text: " ",
          icon: 'success',
          buttons: [false, "Ok"],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        })
        this.instituteform.controls.offtype.reset();
       }
    }

  }
  pageScrolltopeduform() {
    document.getElementById('education').scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest"

    });
  }
}
export class MainInsPagination {
  constructor(private http?: HttpClient) {
  }
  interRecGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string, mem_reg?: number,projectype?: number): Observable<any> {

    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getappcenterdtls';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&mem_reg=${mem_reg}&projectype=${projectype}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainOprPagination {
  constructor(private http?: HttpClient) {
  }
  interOprGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string, appdtlssavetmp_id?: number): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getoprdtls';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainCourPagination {
  constructor(private http?: HttpClient) {
  }
  interCourGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string, appdtlssavetmp_id?: number): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getcourdtls';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainStaffbasPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffbasGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string, appdtlssavetmp_id?: number, memregPk?: number, stfrepo?: number): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getstaffbas';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}&memRegPk=${memregPk}&stfrepo=${stfrepo}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainStaffworkPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffworkGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string, appdtlssavetmp_id?: number, memregPk?: number, stfrepo?: number): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getstaffwork';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}&memRegPk=${memregPk}&stfrepo=${stfrepo}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainStaffPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string, appdtlssavetmp_id?: number, memregPk?: number,projectType?: number): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getstaff';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}&memRegPk=${memregPk}&projecttype=${projectType}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}