import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, FormGroupDirective, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE, MatOption } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { MatTabGroup } from '@angular/material/tabs';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { BgiJsonconfigServices } from "@app/config/BGIConfig/bgi-jsonconfig-services";
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { RegistrationService } from '@app/modules/registration/registration.service';
import { RemoteService } from '@app/remote.service';
import { ApplicationService } from '@app/services/application.service';
import { TranslateService, FakeMissingTranslationHandler } from '@ngx-translate/core';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { CookieService } from 'ngx-cookie-service';
import { ReplaySubject } from 'rxjs/internal/ReplaySubject';
import { HttpClient } from '@angular/common/http';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { environment } from '@env/environment';
import { Observable } from 'rxjs/Observable';
import { merge } from 'rxjs/observable/merge';
import { of as observableOf } from 'rxjs/observable/of';
import { catchError } from 'rxjs/operators/catchError';
import { map } from 'rxjs/operators/map';
import { startWith } from 'rxjs/operators/startWith';
import { switchMap } from 'rxjs/operators/switchMap';
import { ToastrService } from 'ngx-toastr';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { BgimapComponent } from '@app/@shared/bgimap/bgimap.component';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { ActivatedRoute, Router } from '@angular/router';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { Lccdivison } from '@env/common_veriables';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { empty } from 'rxjs';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { event } from 'jquery';
import { MatCheckbox, MatCheckboxChange } from '@angular/material/checkbox';
import { AnimationEvent } from '@angular/animations';
import { Encrypt } from '@app/common/class/encrypt';
import { pairwise } from 'rxjs/operators';
import { THIS_EXPR } from '@angular/compiler/src/output/output_ast';
import { Title } from '@angular/platform-browser';
import { filter, mergeMap } from 'rxjs/operators';
import { MatSelect } from '@angular/material/select';


export interface Element {
  Awarding: any;
  position: any;
  LastAudited: any;
  Document: any;
  Addedon: any;
  Status: any;
  LastUpdated: any;
}
export interface operatorList {
  operatorname: any;
  contracttype: any;
  position: any;
  contractstart: any;
  contractend: any;
  addedon: any;
  Statusone: any;
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
export function animateCallback(animationState: AnimationEvent): void {
  if (animationState.toState === 'expanded') {
    animationState.element.classList.add('my-class');
  } else if (animationState.toState === 'collapsed') {
    animationState.element.classList.remove('my-class');
  }
}
const second_Data: operatorList[] = [

];
const ELEMENT_DATA: Element[] = [

];
const Course_DATA: courseList[] = [

];
const staff_DATA: staffData[] = [


];

const Eduction_DATA: educationData[] = [
  { position: 1, institute: 'National Training Institute (NTI)', degree: 'BE', edu_level: '10-10-2012', grad_date: '10-10-2014', grade: 'A Grade', certificatedoc: '', addedu: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
];
const Work_DATA: workexperienceData[] = [
  { position: 1, organname: 'KHDA', datejoin: '10-10-2015', worktill: '10-10-2022', country: '', governate: '', wilayat: '', desig: 'Tutor', addedu: '10-10-2022', lastUpdated: '20-1-2023' },
];
const Inspect_DATA: inspectionData[] = [
  { inspect_values: 'Car', inspectstatus: '2', inspectcreatedon: '11-02-2011', inspectlastupdate: '15-04-2021' },
  { inspect_values: 'Bus', inspectstatus: '3', inspectcreatedon: '10-10-2015', inspectlastupdate: '04-03-2021' },

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
  selector: 'app-maincentre',
  templateUrl: './maincentre.component.html',
  styleUrls: ['./maincentre.component.scss'],
  encapsulation: ViewEncapsulation.None,

  animations: [
    trigger('fadeInOut', [
      state('void', style({ height: '0', opacity: 0 })),
      state('*', style({ height: '*', opacity: 1 })),
      transition(':enter', animate('300ms ease-out')),
      transition(':leave', animate('300ms ease-in')),
    ]),

  ],

  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})

export class MaincentreComponent implements OnInit {
  public inspectioncategory: any;
  public inpect_list: any;
  public wilayatlist1: any;
  public staffconfigstatus: any;
  public staffconfigmsg_ar: any;
  public staffconfigmsg_en: any;
  serach: { inspectcat_serch: any; InspectStatus_serch: any; inspectAddedon_serch: any; inpectLastUpdated_serch: any; };
  public genderselect: string;
  public genderShow: boolean;
  showotherdocument: boolean = true;
  regtype: any;
  oum_projectmst_fk: any;
  differntfoculpoint: string = 'no';
  [x: string]: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  public coursesubcate: any;
  public mainrole: any;
  public courseoptional: any;
  public updatedFields: any;
  // displayedColumns = ['irm_intlrecogname_en', 'appintit_lastauditdate', 'Document', 'appintit_status', 'appintit_createdon', 'appintit_updatedon', 'Action'];
  // operatorListData = ['appoprct_operatorname', 'appoprct_conttype', 'appoprct_contstartdate', 'appoprct_contenddate', 'appoprct_status', 'appoprct_createdon', 'appoprct_updatedon', 'action'];
  // courseListData = ['appoct_coursename_en', 'appoct_courseduration', 'appoct_courselevel', 'ccm_catname_en', 'appoct_coursetested', 'appoct_status', 'appoct_createdon', 'appoct_updatedon', 'action'];
  // staffListData = ['sir_idnumber', 'sir_name_en', 'sir_emailid', 'age', 'gender', 'ocym_countryname_en', 'rm_name_en', 'appsit_mainrole', 'appsit_status', 'created_on', 'updated_on', 'action'];


  // educationList = ['sacd_institutename', 'sacd_degorcert',  'sacd_edulevel', 'sacd_enddate', 'sacd_grade', 'certificatedoc', 'sacd_createdon', 'sacd_updatedon', 'action'];
  // workExperienceListe = ['sexp_employername', 'sexp_doj', 'sexp_currentlyworking', 'sexp_opalcountrymst_fk', 'sexp_opalstatemst_fk', 'sexp_opalcitymst_fk','sexp_designation', 'certificatedoc' ,'sexp_createdon', 'sexp_updatedon', 'action'];
  // inspectionListData = ['inspect_values', 'inspectstatus', 'inspectcreatedon', 'inspectlastupdate', 'inspectAction']

  // table internatioanl start
  displayedColumns = [
    { def: "irm_intlrecogname_en", search: "row-first", label: "international.awarorgan", visible: true, disabled: true },
    { def: "appintit_lastauditdate", search: "row-second", label: "international.lastaudi", visible: true, disabled: false },
    { def: "Document", search: "row-three", label: "international.document", visible: true, disabled: false },
    { def: "appintit_status", search: "row-four", label: "international.stat", visible: true, disabled: false },
    { def: "appintit_createdon", search: "row-five", label: "international.addon", visible: true, disabled: true },
    { def: "appintit_updatedon", search: "row-six", label: "international.lastupdat", visible: false, disabled: false },
    { def: "Action", search: "row-seven", label: "international.Action", visible: true, disabled: true },
  ];
  // displayed column
  getdisplayedColumns(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
  }
  // displayed search
  getdisplayedsearch(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.search);
  }
  // column edit function
  selectAllFun(event: any) {
    this.selectAllVisible = event.checked;
    this.displayedColumns.forEach(item => {
      item.visible = this.selectAllVisible;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAllVisible(item: any) {
    const allChecked = this.displayedColumns.every(item => item.visible);
    if (allChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // table internatioanl end
  // table course start
  courseListData = [
    { courseColumn: "appoct_coursename_en", filtsearch: "row-first", label: "course.courtitle", HideVisible: true, disoperate: true },
    { courseColumn: "appoct_courseduration", filtsearch: "row-second", label: "course.courdura", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_courselevel", filtsearch: "row-three", label: "course.courlevel", HideVisible: true, disoperate: false },
    { courseColumn: "ccm_catname_en", filtsearch: "row-four", label: "course.courcate", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_coursetested", filtsearch: "row-five", label: "course.courtest", HideVisible: false, disoperate: true },
    { courseColumn: "appoct_status", filtsearch: "row-six", label: "course.stat", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_createdon", filtsearch: "row-seven", label: "course.addon", HideVisible: true, disoperate: false },
    { courseColumn: "appoct_updatedon", filtsearch: "row-eight", label: "course.lastupdat", HideVisible: false, disoperate: false },
    { courseColumn: "action", filtsearch: "row-nine", label: "course.Action", HideVisible: true, disoperate: true },
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
  // table operator start
  operatorListData = [
    { operatorcolumn: "appoprct_operatorname", operatsrch: "row-first", label: "operatorcontact.opername", showVisible: true, disoperate: true },
    { operatorcolumn: "appoprct_conttype", operatsrch: "row-second", label: "operatorcontact.conttype", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_contstartdate", operatsrch: "row-three", label: "operatorcontact.contstartdate", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_contenddate", operatsrch: "row-four", label: "operatorcontact.contenddate", showVisible: true, disoperate: false },
    { operatorcolumn: "appoprct_status", operatsrch: "row-five", label: "operatorcontact.stat", showVisible: true, disoperate: true },
    { operatorcolumn: "appoprct_createdon", operatsrch: "row-six", label: "operatorcontact.addon", showVisible: false, disoperate: false },
    { operatorcolumn: "appoprct_updatedon", operatsrch: "row-seven", label: "operatorcontact.lastupdat", showVisible: false, disoperate: false },
    { operatorcolumn: "action", operatsrch: "row-eight", label: "operatorcontact.Action", showVisible: true, disoperate: true },
  ];
  // displayed column
  getoperatorListData(): string[] {
    return this.operatorListData.filter(operator_list => operator_list.showVisible).map(operator_list => operator_list.operatorcolumn);
  }
  // displayed search
  getoperatorListDatasearch(): string[] {
    return this.operatorListData.filter(operator_list => operator_list.showVisible).map(operator_list => operator_list.operatsrch);
  }
  // column edit function
  selectAlloperatorListDataFun(event: any) {
    this.selectAlloperate = event.checked;
    this.operatorListData.forEach(item => {
      item.showVisible = this.selectAlloperate;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // column edit function
  updateSelectAlloperatorListData(item: any) {
    const OperatChecked = this.operatorListData.every(item => item.showVisible);
    if (OperatChecked) {
      this.hideChkbox.checked = true;
    } else {
      this.hideChkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  // table operator end
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
  public comanydetialsform: FormGroup;
  public instituteform: FormGroup;
  public awaredForm: FormGroup;
  public OperatorContractForm: FormGroup;
  public documentForm: FormGroup;
  public loaderformeducation: boolean = false;
  public CourseForm: FormGroup;
  public staffForm: FormGroup;
  public staffFormedu: FormGroup;
  public staffworkexperienceForm: FormGroup;
  public courseselectForm: FormGroup;
  public documentUploadForm: FormGroup;
  public dynamicForm: FormGroup;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  sectorFilter: FormControl = new FormControl();
  filteredBussrc: ReplaySubject<any> = new ReplaySubject<any>(1);
  bussrcFilter: FormControl = new FormControl();
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
  maxDate = new Date();
  public scrollTop: number;
  public resultsLength: number;
  public resultsLengthOpr: number;
  public resultsLengthCour: number;
  public resultsLengthStaffbas: number;
  public resultsLengthStaff: number;
  public resultsLengthStaffwork: number;
  public pageEvent: any;
  public filternames = "Hide Filter";
  public filtername = "Hide Filter";
  public selectoffice = '1';
  public selectcountry = '1';
  public hidefilder: boolean = true;
  selected = "1";
  length = '';
  second = '';
  third = '';
  four = '';
  public payment: any = [];
  public record: any = [];
  public editOption: boolean = true;
  public updated: boolean = true;
  public isValid: boolean = true;
  public isValided: boolean = true;
  public valided: boolean = true;
  public validture: boolean = true;
  public educationformshow: any = false;
  public workexpformshow: any = false;
  public companydtl: any = false;
  public interreccount: any = false;
  public renewalaction: any;
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
  @ViewChild("inspectPaginator") inspectPaginator: MatPaginator;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  //@ViewChild(MatSort) sortOpr: MatSort;
  @ViewChild('table1', { read: MatSort }) sortOpr: MatSort;
  @ViewChild('table2', { read: MatSort }) sortCour: MatSort;
  @ViewChild('table4', { read: MatSort }) sortStaff: MatSort;
  @ViewChild('table5', { read: MatSort }) sortEdu: MatSort;
  @ViewChild('table6', { read: MatSort }) sortWork: MatSort;
  public FormMainTemplate = 'FormData';
  exp_aval = 0;
  oma_nval = 0;
  curr_learnval = 0;
  no_techstaffval = 0;
  autocalrat = 0;
  public memReg: any;
  public appdtlssavetmp_id: any;
  public insinfirtmp_Pk: any;
  public appiit_noofexpat: any;
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
  public cractivitydrvInputed: DriveInput;
  public center_status: boolean = false;
  public aprdec_status: boolean = false;
  public notallowedone: boolean = false;
  public textareastatus: boolean = false;
  public resubmit_status: any;
  public decline_status: boolean = false;
  public course_staff_status: boolean = false;
  public logostatus: boolean = false;
  public noneditdocument: boolean = true;
  public noteditablefield: boolean = true;
  public checkappstatus: boolean = false;
  public doc_id: any;
  public docmnt_list: any;
  public dynamicSelect: any = [];
  public dynamicFileError: any = [];
  public flag: any = [];

  @ViewChild('awarddoc') awarddocFilee: Filee;
  @ViewChild('logo') logo: Filee;
  @ViewChild('cractivity') cractivity: Filee;
  @ViewChild('uploadid') uploadid: Filee;
  @ViewChild('uploaddrivelic') uploaddrivelic: Filee;
  @ViewChild('uploadmoldoc') uploadmoldoc: Filee;
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
  public compdtls: any;
  public dtlsmain: any;
  public dtlstmp: any;
  public mainres: any;
  public arabicrtl: any;
  spinnerButtonOption: MatProgressButtonOptions = {
    active: false,
    text: 'Verified',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };
  public companyLogoFilee: any;
  public unitcodeForm: FormGroup;
  public drv_logo: DriveInput;
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
  public NorecordedLoader: boolean = false;
  public noData: any = '';
  public filtersts: boolean = true;
  public updatesupplierinfo: boolean = false;
  mainIntrGridDatas: MainInsPagination;
  mainIntrGridDatasOpr: MainOprPagination;
  mainIntrGridDatasCour: MainCourPagination;
  mainIntrGridDatasStaffbas: MainStaffbasPagination;
  mainIntrGridDatasStaffwork: MainStaffworkPagination;
  mainIntrGridDatasStaff: MainStaffPagination;
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
  maximumdate = moment();
  public oman: boolean = true;
  public nonoman: boolean = true;
  //ifarabic: boolean = false;
  public companytmpdtls: any;
  public appintit_status: any;
  public appintit_appdecComments: any;
  public appoprct_status: any;
  public appoprct_appdeccomment: any;
  public appoct_status: any;
  public appoct_appdecComments: any;
  public appsit_status: any;
  public appsit_appdeccomment: any;
  public staffeduedit: boolean = false;
  public staffworkedit: boolean = false;
  public repocv: any;
  public omancountry: boolean = true;
  public orecord: boolean = false;
  noDataone: any = '';
  noDatatwo: any = '';
  noDatathree: any = '';
  noDatafour: any = '';
  noDatafive: any = '';
  // noDatasix: any; 
  // noDataone: any;
  public businessUnitDataTemp: any;
  // pagination search end
  public expandedElement: boolean = false;
  public expandedElements: boolean = false;
  public worktilled: boolean = true;
  public noedit: boolean = false;
  public courread: boolean = false;
  public deleteicon: boolean = true;
  public documentdeleteicon: boolean = true;
  public thirddeleteicon: boolean = true;
  public checkboxdisable: boolean = false;
  public ageShow: boolean = true;
  public expandedClass = 'expanded-class';
  public added: boolean = false;
  public appstatus: any = '';
  public apptype: any = '';
  public prodpk: any = '';
  public apptemppk: any = '';
  public finalsubmitbtn: boolean = true;
  public LoaderForNorecord: boolean = false;
  public requiredfieldshow: boolean = true;
  public fileeaward: boolean = false;
  public fileemoher: boolean = false;
  public educationdocument: boolean = false;
  @ViewChild('staffWorkExperienceFormReset') staffWorkExperienceFormReset: FormGroupDirective;
  rolesubcategory: any[] = [];
  rolecategory_remove: any;
  rolerascatcategory: any[] = [];
  rolerascategory_remove: any;
  res_inspectioncategory = [];
  res_inspectioncategory1 = [];
  public updatestaff: boolean = false;
  public isopen: any = {};
  public requiredwork: boolean = false;
  public workdeleteicon: boolean = true;
  public workexperiencedrvInputed: DriveInput;
  public InpectionForm: FormGroup;
  public LengthofInspection: number;
  public projectType: any;
  public InpectionCategary: boolean = false;
  public rolesinstaff: any;
  public staffworkFile: boolean = false;
  // international
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  public selectAllVisible: boolean = false;
  // Operators
  @ViewChild('hideChkbox') hideChkbox: MatCheckbox;
  public selectAlloperate: boolean = false;
  // course
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
  @ViewChild('selectbox') selectbox: MatSelect;
  public loaderform: boolean = false;
  public loaderformwork: boolean = false;
  public idcarddrvInputed: DriveInput;
  public ropLicensedrvInputed: DriveInput;
  public molEmploymentdrvInputed: DriveInput;
  public centreName: boolean = false;
  public centreNameAr: boolean = false;
  public requiredFordoc: boolean = true;
  public branchNamediable: boolean;
  public trainingProviderName: boolean;
  public trainingProviderNameAr: boolean;
  constructor(private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService,
    private remoteService: RemoteService,
    private profileService: ProfileService,
    private cookieService: CookieService,
    private appservice: ApplicationService,
    private regService: RegistrationService,
    private http: HttpClient,
    private localStorage: AppLocalStorageServices,
    private fb: FormBuilder,
    private security: Encrypt,
    private titleService: Title,
    public toastr: ToastrService, public routeid: ActivatedRoute, private route: Router, private secuirty: Encrypt
  ) {

  }

  spinnerButtonOptionsmem: MatProgressButtonOptions = {
    active: false,
    text: 'Verify',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
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
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();

  ngOnInit(): void {
    this.checkQueryParams();
    this.routeid.queryParams.subscribe(params => {
      this.projectType = this.security.decrypt(params['p']);
      this.firstUrl = this.security.decrypt(params['s']);

    });
    this.routeid.params.subscribe(params => {
      this.count = this.security.decrypt(params['pkValue']);
      // alert(this.count)
      console.log('params' + params)

    });

    this.memReg = this.localStorage.getInLocal('reg_pk');
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
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
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.filternames = "Hide Filter";
      this.arabicrtl = true;
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
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
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.filternames = "Hide Filter";
        this.arabicrtl = false;
        this.ifarabic = false;
      }

    });

    this.drvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    };

    this.drvInputedCom = {
      fileMstPk: 1,
      selectedFilesPk: []
    };

    this.mogerInputed = {
      fileMstPk: 3,
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
    this.cractivitydrvInputed = {
      fileMstPk: 9,
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
    this.getrasinspectioncategory();
    this.getrasrole();
    this.getMainDetails();
    this.getCompDtls();
    this.formvalidated();
    this.getGoverenoratelist();
    this.getconfigurations();
    this.getMoherigradinglist();
    this.getRegAppDtls();
    if (this.projectType == 1) {
      this.instituteform.controls['offtype'].setValue(1);
    } else {
      this.instituteform.controls['offtype'].setValue(1);
    }


    this.getintrtrlist();
    this.leveldropdown();
    this.catdropdown();
    this.courtestdropdown();
    this.countrydropdown();
    this.contrtyprdropdown();
    this.roledropdown();
    this.staffleveldropdown();

    this.OperatorContractForm.controls['operator_name'].valueChanges.debounceTime(400).subscribe(respdata => {
      let searchData = respdata;
      if (searchData != null) {
        if (searchData.length >= 3 && searchData.length != null) {
          this.appservice.getoperatordata(1, searchData).subscribe(data => {
            if (data['data']) {
              this.SearchResultOpr = data['data'];
            }
          })
        }
      }
    });

    this.dynamicForm = this.formBuilder.group({
      tickets: new FormArray([])
    });
    this.drv_logo = {
      fileMstPk: 8,
      selectedFilesPk: []
    };

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
      if (value) {
        let index = this.role_list.findIndex(x => x.rolemst_pk == value[0]);
        if (index !== -1) {
          this.mainrole = this.role_list[index].rm_rolename_en;

        }
      } else {
        this.mainrole = '';
      }
    });
    this.staffForm.controls['role'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.rolesinstaff.findIndex(x => x.rolemst_pk == value[0]);
        if (index !== -1) {
          this.mainrole = this.rolesinstaff[index].rm_rolename_en;

        }
      } else {
        this.mainrole = '';
      }
    });
    this.CourseForm.controls['inter_organ'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.rec_list.findIndex(x => x.appintrecogtmp_pk == value[0]);
        if (index !== -1) {
          this.courseoptional = this.rec_list[index].irm_intlrecogname_en;
        }
      } else {
        this.courseoptional = '';
      }
    });
    //Awarding Search starts here
    this.Awarding = new FormControl('');
    this.Awarding.valueChanges.debounceTime(400).subscribe(
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

    this.LastAudited = new FormControl('');
    this.LastAudited.valueChanges.debounceTime(400).subscribe(
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

    this.Status = new FormControl('');
    this.Status.valueChanges.debounceTime(400).subscribe(
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

    this.Addedon = new FormControl('');
    this.Addedon.valueChanges.debounceTime(400).subscribe(
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

    this.LastUpdated = new FormControl('');
    this.LastUpdated.valueChanges.debounceTime(400).subscribe(
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

    //Operator 4 th tab Search starts here
    this.operatorname = new FormControl('');
    this.operatorname.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        }
      }
    )

    this.contracttype = new FormControl('');
    this.contracttype.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        }
      }
    )

    this.contractstart = new FormControl('');
    this.contractstart.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        }
      }
    )

    this.contractend = new FormControl('');
    this.contractend.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        }
      }
    )

    this.addedon = new FormControl('');
    this.addedon.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        }
      }
    )
    this.lastUpdated = new FormControl('');
    this.lastUpdated.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        }
      }
    )
    this.Statusone = new FormControl('');
    this.Statusone.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        } else if (register == '') {
          this.paginator.pageIndex = 0;
          this.getOprContrDtls();
        }
      }
    )
    //Operator 4 th tab Search Ends here

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

    this.LastUpdatedstaffdate = new FormControl('');
    this.LastUpdatedstaffdate.valueChanges.debounceTime(400).subscribe(
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

    this.dob = new FormControl('');
    this.dob.valueChanges.debounceTime(400).subscribe(
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

    this.inspect_cat = new FormControl('');
    this.inspect_cat.valueChanges.debounceTime(400).subscribe(
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

    this.OperatorContractForm.controls['cont_strt'].valueChanges.subscribe(data => {
      this.OperatorContractForm.controls['cont_end'].setValue(null);
    });

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
    this.routeid.queryParams.subscribe(params => {
      this.projectType = this.security.decrypt(params['p']);
      let status = Number(this.security.decrypt(params['st']));
      let application = this.security.decrypt(params['ap']);

      if ((this.security.decrypt(params['renew']) == '1') && (status == 2 || status == 4 || status == 7 || status == 19)) {
        this.renewalaction = this.security.decrypt(3);
      }
      if ((this.security.decrypt(params['renew']) == '1') && status == 3) {
        this.renewalaction = this.security.decrypt(2);
      }
      else if ((this.security.decrypt(params['renew']) == '1') && ((status >= 5 && status <= 14) || status == 18)) {
        if (this.projectType == 4) {
          this.route.navigate(['trainingcentremanagement/rascentre'], { queryParams: { p: this.security.encrypt(4), t: this.security.encrypt(2), s: this.security.encrypt(status), at: this.security.encrypt(application), bc: 'paycnt', f: 'mc', nwrn: 'rnj' } });
        }
        else if (this.projectType == 1) {
          this.route.navigate(['trainingcentremanagement/maincentre'], {
            queryParams: {
              p: this.security.encrypt(1), t: this.security.encrypt(2), s: this.security.encrypt(status), at:
                this.security.encrypt(application), bc: 'paycnt', f: 'mc', nwrn: 'rnj'
            }
          });
        }
      }
      else if ((this.security.decrypt(params['renew']) == '1') && status == 17) {
        this.renewalaction = this.security.decrypt(params['renew']);
      } else if ((this.security.decrypt(params['renew']) != '1')) {
        this.renewalaction = this.security.decrypt(params['renew']);
      } else {
        this.renewalaction = 0;
      }





    });
    if (this.projectType == 1) {

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
      this.updatedFields = true;
    } else {

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
      this.updatedFields = false;
    }
    this.checkValidation();
    this.breadCrumb();
  }

  // ngonint end here
  renew() {
    if (this.projectType == 1) {
      this.route.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.secuirty.encrypt(1), renew: this.security.encrypt(1) } });
    } else {
      this.route.navigate(['/trainingcentremanagement/rascentre'], { queryParams: { p: this.secuirty.encrypt(4), renew: this.security.encrypt(1) } });
    }
    setTimeout(function () {
      location.reload()
    }, 100);
  }
  getage(value) {
    let m = moment();
    let years = m.diff(value, 'years');
    m.add(-years, 'years');
    let months = m.diff(value, 'months');
    m.add(-months, 'months');
    let days = m.diff(value, 'days');

    return years;
  }

  //check query params to redirect the pament page & site audit page   
  checkQueryParams() {
    this.routeid.queryParams.subscribe(params => {
      this.appstatus = this.secuirty.decrypt(params['s']);
      this.apptype = this.secuirty.decrypt(params['t']);
      this.prodpk = this.secuirty.decrypt(params['p']);
      this.apptemppk = this.secuirty.decrypt(params['at']);
      this.id = this.secuirty.decrypt(params['id']);

      if (this.appstatus == 5 || this.appstatus == 6 || this.appstatus == 7 || this.appstatus == 8 || this.appstatus == 9 || this.appstatus == 18 || this.appstatus == 10 || this.appstatus == 11 || this.appstatus == 12 || this.appstatus == 13) {
        this.disableSubmitButton = true;
        this.appservice.getpaymentinfo(this.apptemppk, 1).subscribe(res => {
          if (res.status == 200) {
            this.payment = res.data.payment;
            this.record = res.data.record;
            this.FormMainTemplate = 'payMent';
            this.disableSubmitButton = false;
          }
        });
      } else {
        this.getCompDtls();
        this.FormMainTemplate = 'FormData';
      }
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
  fileeSelectedcractivity(file, fileId) {
    fileId.selectedFilesPk = file;
  }
  getLocationDetails(value) {
    this.instituteform.controls['lat'].setValue(100);
    this.instituteform.controls['lang'].setValue(200);
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
  get f() { return this.dynamicForm.controls; }
  get t() { return this.f.tickets as FormArray; }
  get inspect() { return this.InpectionForm.controls; }

  roundedNum: any = '';
  getAutoCal(exp_aval, oma_nval) {
    this.autocal = this.convertToInt(exp_aval) + this.convertToInt(oma_nval);
    this.autocalper = this.convertToInt(oma_nval) / this.autocal * 100;
    this.instituteform.controls['tot_oman'].setValue(this.autocal);
    this.instituteform.controls['oman_percen'].setValue(this.autocalper + '%');

  }

  getAutoRatCal(curr_learnval, no_techstaffval) {
    this.autocalrat = this.convertToInt(curr_learnval) / this.convertToInt(no_techstaffval);
    this.instituteform.controls['ratio_tech'].setValue('1:' + Math.floor(this.autocalrat));
  }

  getMainDetails() {
    this.appservice.userterevedtls(this.memReg, this.projectType).subscribe(data => {
      if (data.data.status == '1') {
        this.renewal = true;
        this.dtlsmain = data.data.data;
        this.dtlstmp = data.data.dataTmp;
        this.mainres = data.data.response;
        console.log(this.mainres, 'test1212');
      }
    });
  }

  getCompDtls() {

    this.disableSubmitButton = true;
    this.memReg = this.localStorage.getInLocal('reg_pk');
    this.appservice.getComDtls(this.memReg, this.projectType).subscribe(response => {
      if (response.data.data) {
        this.compdtls = response.data.data;
        this.appdtlssavetmp_id = response.data.data.applicationdtlstmp_pk;
        this.getrascategorydata(10, 0, null);
        this.staffconfigurationcheckinras();
        if (this.appdtlssavetmp_id) {
          this.getCenterStatus(this.appdtlssavetmp_id);
          this.getAppStatus(this.appdtlssavetmp_id);
          this.center_status = true;
          this.appservice.getInsInforDtls(this.appdtlssavetmp_id, '1').subscribe(responseInfor => {
            if (responseInfor.data.data) {
              this.insinfirtmp_Pk = responseInfor.data.data.appinstinfotmp_pk;
              this.appiit_noofexpat = responseInfor.data.data.appiit_noofexpat;
              this.insinfirtmp_data = responseInfor.data.data;
              this.instituteform.patchValue({
                exp_a: responseInfor.data.data.appiit_noofexpat,
                oma_n: responseInfor.data.data.appiit_noofomani,
                molpercent: responseInfor.data.data.appiit_molpercent,
                site_main: responseInfor.data.data.appiit_locmapurl,
                no_techstaff: responseInfor.data.data.appiit_nooftechstaff,
                curr_learn: responseInfor.data.data.appiit_noofcurlearners,
                trainprovmax: responseInfor.data.data.appiit_maxcapacity,
                appinstinfotmp_pk: responseInfor.data.data.appinstinfotmp_pk,
              });
              this.instituteform.patchValue({
                brancheng: responseInfor.data.data.appiit_branchname_en,
                brancharab: responseInfor.data.data.appiit_branchname_ar,
                inst_address1: responseInfor.data.data.appiit_addrline1,
                inst_address2: responseInfor.data.data.appiit_addrline2,
                instgovernorate: responseInfor.data.data.appiit_statemst_fk ? Number(responseInfor.data.data.appiit_statemst_fk) : '',
                wila_yat: responseInfor.data.data.appiit_citymst_fk ? Number(responseInfor.data.data.appiit_citymst_fk) : '',

              });
              this.instituteform.controls['offtype'].setValue(responseInfor.data.data.appiit_officetype);
              this.selectedGovernorate1(Number(responseInfor.data.data.appiit_statemst_fk));
              this.getAutoCal(responseInfor.data.data.appiit_noofexpat, responseInfor.data.data.appiit_noofomani);
              this.getAutoRatCal(responseInfor.data.data.appiit_noofcurlearners, responseInfor.data.data.appiit_nooftechstaff);
              if (this.instituteform.controls['brancheng'].value) {
                this.branchNamediable = true;
              } else {
                this.branchNamediable = false;
              }

            }
          });

          this.appservice.getCompanyDtls(this.appdtlssavetmp_id).subscribe(datacomp => {

            if (datacomp.data.data) {
              this.companydtl = true;
              this.companytmpdtls = datacomp.data.data;
            }
          });

          this.getInterRecDtls();

          this.getOprContrDtls();

          this.recdropdown();

          this.getCourDtls();

          this.getStaffDtls();

          this.opercourdropdown(this.appdtlssavetmp_id);
          setTimeout(() => {
            this.getdoc(this.appdtlssavetmp_id);

          }, 1000);
          this.getDeclinedStatus(this.appdtlssavetmp_id);

        }
      }
    });

  }
  getrasinspectioncategory() {
    this.appservice.getrasinspectioncategory(this.projectType).subscribe(data => {
      if (data.status == 200) {
        this.res_inspectioncategory = data.data;

        console.log('########')
        console.log(this.res_inspectioncategory)
      }

    });
  }
  getrasrole() {
    this.appservice.getrasrole(this.projectType).subscribe(data => {
      if (data.status == 200) {
        this.rolesinstaff = data.data.role;
        console.log('-------------------------', this.rolesinstaff)
      }

    });
  }

  getdoc(appdtlssavetmp_id) {

    if (appdtlssavetmp_id && appdtlssavetmp_id != "undefined") {
      // this.disableSubmitButton = true;
      this.appservice.getdoc(appdtlssavetmp_id).subscribe(response => {
        if (response.data.status == 1) {
          this.doc_list = [];
          this.doc_list = response.data.data;
          this.doc_id = response.data.status;
          if (this.t.length < this.doc_list.length) {
            let careerRequiredDocs = [];
            let careerRequiredDocsValidation: any[] = [];

            const control = <FormArray>this.documentForm.controls['documents'];
            control.clear();
            for (let i = this.t.length; i < this.doc_list.length; i++) {

              if (this.doc_list[i].appdst_submissionstatus == 1) {
                this.dynamicSelect[i] = true;
                this.flag[i] = 1;
              } else {
                this.dynamicSelect[i] = false;
                this.flag[i] = 2;
              }

              if (this.doc_list[i].appdst_memcompfiledtls_fk) {
                careerRequiredDocs.push({
                  fileMstPk: 4,
                  selectedFilesPk: [this.doc_list[i].appdst_memcompfiledtls_fk]
                });
              } else {
                careerRequiredDocs.push({
                  fileMstPk: 4,
                  selectedFilesPk: []
                });
              }

              control.push(

                this.formBuilder.group({
                  fileName: [this.doc_list[i].appdst_memcompfiledtls_fk, [Validators.required]],
                  provided: [this.doc_list[i].appdst_submissionstatus, [Validators.required]],
                  keymap: [this.doc_list[i].appdst_documentdtlsmst_fk, [Validators.required]],
                  remark_fst: [this.doc_list[i].appdst_remarks, ''],
                  appdocsubmissiontmp_pk: [this.doc_list[i].appdocsubmissiontmp_pk, '']
                })
              );

            }
            this.applyValidatorsOnInit();
            this.initiateFormValidation();


            this.centreRequiredDocs = careerRequiredDocs;
            this.formBuilder.group(careerRequiredDocsValidation);

            for (let i = this.t.length; i < this.doc_list.length; i++) {
              this.onModelChange(this.doc_list[i].appdst_remarks, i);
            }
          }
          this.disableSubmitButton = false;
          // document update ends
        } else {
          if (this.projectType == 4) {
            var projectpk = 4;
          } else {
            var projectpk = 1;
          }
          this.doc_list = [];
          this.appservice.getdocumentdtl(projectpk).subscribe(data => {
            this.doc_list = data.data.data;
            // document update starts
            if (this.t.length < this.doc_list.length) {
              let careerRequiredDocs = [];
              let careerRequiredDocsValidation: any[] = [];

              const control = <FormArray>this.documentForm.controls['documents'];
              control.clear();
              for (let i = this.t.length; i < this.doc_list.length; i++) {

                // if(this.doc_list[i].appdst_submissionstatus == 1){
                this.dynamicSelect[i] = true;

                if (this.doc_list[i].appdst_memcompfiledtls_fk) {
                  careerRequiredDocs.push({
                    fileMstPk: 4,
                    selectedFilesPk: [this.doc_list[i].appdst_memcompfiledtls_fk]
                  });
                } else {
                  careerRequiredDocs.push({
                    fileMstPk: 4,
                    selectedFilesPk: []
                  });
                }

                control.push(
                  this.formBuilder.group({
                    fileName: ['', Validators.required],
                    provided: ['1', [Validators.required]],
                    keymap: [this.doc_list[i].documentdtlsmst_pk, [Validators.required]],
                    remark_fst: [this.doc_list[i].appdst_remarks, Validators.required],
                    appdocsubmissiontmp_pk: ['', '']
                  })
                );
              }

              this.applyValidatorsOnInit();
              this.initiateFormValidation();
              for (let i = this.t.length; i < this.doc_list.length; i++) {
                //this.onModelChange(this.doc_list[i].appdst_remarks, i);
              }
              this.centreRequiredDocs = careerRequiredDocs;
              this.formBuilder.group(careerRequiredDocsValidation);
            }
            // document update ends

          });
          this.disableSubmitButton = false;
        }
      });
    } else {
      if (this.projectType == 4) {
        var projectpk = 4;
      } else {
        var projectpk = 1;
      }
      this.doc_list = [];
      this.disableSubmitButton = true;
      this.appservice.getdocumentdtl(projectpk).subscribe(data => {
        this.doc_list = data.data.data;
        // document update starts
        if (this.t.length < this.doc_list.length) {
          let careerRequiredDocs = [];
          let careerRequiredDocsValidation: any[] = [];

          const control = <FormArray>this.documentForm.controls['documents'];
          control.clear();
          for (let i = this.t.length; i < this.doc_list.length; i++) {

            this.dynamicSelect[i] = true;
            if (this.doc_list[i].appdst_memcompfiledtls_fk) {
              careerRequiredDocs.push({
                fileMstPk: 4,
                selectedFilesPk: [this.doc_list[i].appdst_memcompfiledtls_fk]
              });
            } else {
              careerRequiredDocs.push({
                fileMstPk: 4,
                selectedFilesPk: []
              });
            }
            //const control = <FormArray>this.documentForm.controls['documents'];
            control.push(
              this.formBuilder.group({
                fileName: ['', Validators.required],
                provided: ['1', [Validators.required]],
                keymap: [this.doc_list[i].documentdtlsmst_pk, [Validators.required]],
                remark_fst: ['', Validators.required],
                appdocsubmissiontmp_pk: ['', '']
              })
            );
          }

          this.applyValidatorsOnInit();
          this.initiateFormValidation();

          this.centreRequiredDocs = careerRequiredDocs;
          this.formBuilder.group(careerRequiredDocsValidation);
        }
        // document update ends

      });
      this.disableSubmitButton = false;
    }
  }

  initiateFormValidation() {
    this.documentForm.get('documents').valueChanges.pipe(
      pairwise()
    ).subscribe(([prevDocs, currentDocs]) => {
      // loop through each form control in the current docs array
      currentDocs.forEach((currentDoc, i) => {
        const prevDoc = prevDocs[i];
        if (prevDoc != undefined) {
          const documentsArray = this.documentForm.get('documents') as FormArray;
          const prevProvided = prevDoc.provided;
          const currentProvided = currentDoc.provided;
          if (prevProvided !== currentProvided) {

            const currentRemarksformControl = documentsArray.controls[i].get('remark_fst');
            const currentFileformControl = documentsArray.controls[i].get('fileName');
            if (currentProvided == 2) {
              currentRemarksformControl.setValidators([Validators.required]);
              currentFileformControl.clearValidators();
            } else {
              currentRemarksformControl.clearValidators();
              currentFileformControl.setValidators([Validators.required]);
            }
            currentRemarksformControl.updateValueAndValidity();
            currentFileformControl.updateValueAndValidity();
          }

          const fileNameControl = documentsArray.controls[i].get('fileName');
          const prevFileName = prevDoc.fileName;
          const currentFileName = currentDoc.fileName;

          if (prevFileName !== currentFileName) {
            // file name value has changed
            // console.log(`File name value for document ${i} has changed from ${prevFileName} to ${currentFileName}`);

          }
          const remarkControl = documentsArray.controls[i].get('remark_fst');
          const prevRemark = prevDoc.remark_fst;
          const currentRemark = currentDoc.remark_fst;

          if (prevRemark !== currentRemark) {
            // remark value has changed
            // console.log(`Remark value for document ${i} has changed from ${prevRemark} to ${currentRemark}`);
          }

          const keymapControl = documentsArray.controls[i].get('keymap');
          const keymapprevRemark = prevDoc.keymap;
          const keymapcurrentRemark = currentDoc.keymap;

          if (keymapprevRemark !== keymapcurrentRemark) {
            // remark value has changed
            // console.log(`Remark value for document ${i} has changed from ${keymapprevRemark} to ${keymapcurrentRemark}`);
            // console.log(documentsArray.controls[i])

          }
        }

      });
    });

  }
  applyValidatorsOnInit() {
    const documentsArray = this.documentForm.get('documents') as FormArray;
    documentsArray.controls.forEach((formGroup: FormGroup) => {
      const currentProvided = formGroup.controls['provided'].value;
      const currentRemarksformControl = formGroup.controls['remark_fst'];
      const currentFileformControl = formGroup.controls['fileName'];

      if (currentProvided == 2) {
        currentRemarksformControl.setValidators([Validators.required]);
        currentFileformControl.clearValidators();
      } else {
        currentRemarksformControl.clearValidators();
        currentFileformControl.setValidators([Validators.required]);
      }

      currentRemarksformControl.updateValueAndValidity();
      currentFileformControl.updateValueAndValidity();
    });
  }

  getInterRecDtls() {
    this.tblplaceholder = true;
    this.LoaderForNorecord = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo = false;
    this.mainIntrGridDatas = new MainInsPagination(this.http);
    this.sort?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { Awarding: this.Awarding.value, LastAudited: this.LastAudited.value, Status: this.Status.value, Addedon: this.Addedon.value, LastUpdated: this.LastUpdated.value };
    merge(this.sort?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.mainIntrGridDatas.interRecGridUtil(this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.appdtlssavetmp_id);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          if (this.resultsLength != 0) {
            this.interreccount = true;
          }
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf('failure');
        })
      ).subscribe(data => {
        this.interRecListData = new MatTableDataSource(data);
        this.interRecListData.filterPredicate = this.createFilter();
        this.Contentplaceloader = false;
        this.filtersts = true;
        this.noData = this.interRecListData.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;
        this.LoaderForNorecord = false;
      });
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
      });
  }

  getStaffbasDtls(stfrepo) {

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
        this.tblplaceholder = false;
      });
  }

  getStaffworkDtls(stfrepo) {

    this.NorecordedLoader = true;
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
        this.NorecordedLoader = false;
      });
  }

  getStaffDtls() {
    this.tblplaceholder = true;
    this.Contentplaceloader = true;
    this.updatesupplierinfo = false;
    this.mainIntrGridDatasStaff = new MainStaffPagination(this.http);
    this.sortStaff?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    gridsearchvalue = { civil_numb: this.civil_numb.value, staff_name: this.staff_name.value, email_id: this.email_id.value, gender: this.gender.value, Nation: this.Nation.value, cont_type: this.cont_type.value, main_role: this.main_role.value, inspect_cat: this.inspect_cat.value, status_cour: this.status_cour.value, addd_oncour: this.addd_oncour.value, LastUpdatedstaff: this.LastUpdatedstaff.value };
    merge(this.sortStaff?.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          this.querystr = '';
          return this.mainIntrGridDatasStaff.interStaffGridUtil(this.sortStaff.active, this.sortStaff.direction, this.paginator.pageIndex - 1,
            this.page, this.querystr, this.searchControl.value, JSON.stringify(gridsearchvalue), this.appdtlssavetmp_id, this.memReg, this.projectType);
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

  getRegAppDtls() {
    this.appservice.getappregdtls(this.projectType).subscribe(response => {
      if (response.data.status == 1) {
        this.companydtls = response.data.data;
        this.selectedType(Number(this.companydtls.regas));

        if (this.companydtls.omrm_cmplogo) {
          this.drv_logo.selectedFilesPk = [this.companydtls.omrm_cmplogo];
          setTimeout(() => {
            this.logo.triggerChange();
          }, 1000);
        } else {
          this.drv_logo.selectedFilesPk = [];
        }
        if (this.companydtls.omrm_cractivity) {
          this.cractivitydrvInputed.selectedFilesPk = [this.companydtls.omrm_cractivity];
          setTimeout(() => {
            this.cractivity.triggerChange();
          }, 1000);
        } else {
          this.cractivitydrvInputed.selectedFilesPk = [];
        }
        this.regtype = this.companydtls.regas;
        this.oum_projectmst_fk = this.companydtls.oum_projectmst_fk
        if (this.regtype == 2) {
          this.centreName = true;
          this.centreNameAr = true;
        } else {
          if (this.comanydetialsform.controls.branch_name_en.value && this.comanydetialsform.controls.branch_name_ar.value) {
            this.centreName = true;
            this.centreNameAr = true;
            // alert(9)
          }
          else if (this.comanydetialsform.controls.branch_name_en.value) {
            this.centreName = true;
          } else if (this.comanydetialsform.controls.branch_name_ar.value) {
            this.centreNameAr = true;
          }
          else {
            this.centreName = false;
            this.centreNameAr = false;
          }
        }
        if (this.regtype == 1) {
          this.trainingProviderName = true;
          this.trainingProviderNameAr = true;
        } else {
          if (this.comanydetialsform.controls.tp_name_en.value && this.comanydetialsform.controls.tp_name_ar.value) {
            this.trainingProviderName = true;
            this.trainingProviderNameAr = true;
            // alert(9)
          }
          else if (this.comanydetialsform.controls.tp_name_en.value) {
            this.trainingProviderName = true;
          } else if (this.comanydetialsform.controls.tp_name_ar.value) {
            this.trainingProviderNameAr = true;
          }
          else {
            this.trainingProviderName = false;
            this.trainingProviderNameAr = false;
          }
        }
        this.comanydetialsform.patchValue({
          stktyp: this.companydtls.stkpk,
          registeras: this.companydtls.regas,
          opal_memb_no: this.companydtls.opalmem_no,
          opal_memb_expiry: this.companydtls.opalmem_expiry,
          comp_cr_no: this.companydtls.cr_no,
          comp_cr_expiry: this.companydtls.cr_expiry,
          company_name_en: this.companydtls.compname_en,
          company_name_ar: this.companydtls.compname_ar,
          tp_name_en: this.companydtls.tpname_en,
          tp_name_ar: this.companydtls.tpname_ar,
          branch_name_en: this.companydtls.branchname_en,
          branch_name_ar: this.companydtls.branchname_ar,
          governorate: Number(this.companydtls.omrm_opalstatemst_fk),
          wilayat: Number(this.companydtls.omrm_opalcitymst_fk),
          address1: this.companydtls.address1,
          address2: this.companydtls.address2,
          gm_name: this.companydtls.gmname,
          gm_emailid: this.companydtls.gmaemailid,
          gm_mobnum: this.companydtls.gmmobileno,
          moheri_grade: Number(this.companydtls.omrm_opalmoherigradingmst_pk),

          upload: this.companydtls.omrm_cmplogo,
        });
        if (this.projectType == 4) {
          if (this.differntfoculpoint == 'yes') {
            this.comanydetialsform.controls['focalpoint_name'].enable();
            this.comanydetialsform.controls['focalpoint_desig'].enable();
            this.comanydetialsform.controls['focalpoint_emailid'].enable();
            this.comanydetialsform.controls['focalpoint_mobno'].enable();
          } else {
            this.comanydetialsform.patchValue({
              focalpoint_name: this.companydtls.name,
              focalpoint_desig: this.companydtls.desig,
              focalpoint_emailid: this.companydtls.emailid,
              focalpoint_mobno: this.companydtls.mob_no,
            });
          }
        } else {
          this.comanydetialsform.patchValue({
            focalpoint_name: this.companydtls.name,
            focalpoint_desig: this.companydtls.desig,
            focalpoint_emailid: this.companydtls.emailid,
            focalpoint_mobno: this.companydtls.mob_no,
          });
        }

        this.selectedGovernorate(Number(this.companydtls.omrm_opalstatemst_fk));

      }
    });
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

  ChangeValue(event, index) {
    const documentsArray = this.documentForm.get('documents') as FormArray;
    if (event.value == '1') {
      documentsArray.controls[index].get('remark_fst').setValue("");
      this.dynamicSelect[index] = true;
      this.dynamicFileError[index] = true;
    } else {
      documentsArray.controls[index].get('fileName').setValue("");
      this.centreRequiredDocs[index].selectedFilesPk = [];
      this.dynamicSelect[index] = false;
      this.dynamicFileError[index] = false;
    }
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
    this.comanydetialsform = this.formBuilder.group({

      opal_memb_no: ['', ''],
      opal_memb_expiry: ['', null],
      comp_cr_no: ['', ''],
      comp_cr_expiry: [''],
      company_name_en: ['', ''],
      company_name_ar: ['', ''],
      tp_name_en: ['', ''],
      tp_name_ar: ['', ''],
      cn_name_en: ['', ''],
      cn_name_ar: ['', ''],
      branch_name_en: ['', ''],
      branch_name_ar: ['', ''],
      file_cractivity: ['', ''],
      governorate: ['', Validators.required],
      wilayat: ['', Validators.required],
      address1: ['', Validators.required],
      address2: ['', ''],
      gm_name: ['', Validators.required],
      gm_emailid: ['', [Validators.required, Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$')]],
      gm_mobnum: ['', Validators.required],
      moheri_grade: ['', ''],
      focalpoint_name: ['',],
      focalpoint_desig: ['',],
      focalpoint_emailid: [''],
      focalpoint_mobno: ['',],
      company_logo: ['', ''],
      cr_activity: ['1', Validators.required],
      files: ['', ''],
      isCompNameSame: [''],
      ifFpSameAsGm: ['', ''],
      companylogo: [''],
      upload: ['', ''],
      file_award: ['', '']
    }),

      this.instituteform = this.formBuilder.group({
        offtype: ['', Validators.required],
        brancheng: ['', ''],
        brancharab: ['', ''],
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
        instgovernorate: ['',],
        wila_yat: [''],
        inst_address1: ['', ''],
        inst_address2: ['', ''],
        lat: ['12.9895', ''],
        lang: ['80.2505', ''],
        appinstinfotmp_pk: ['', ''],

      }),

      this.awaredForm = this.formBuilder.group({
        award_organ: ['', Validators.required],
        last_audit: ['', Validators.required],
        file_award: ['', Validators.required],
        appintit_applicationdtlstmp_fk: ['', ''],
        appintrecogtmp_pk: ['', ''],

      }),
      this.OperatorContractForm = this.formBuilder.group({
        operator_name: ['', Validators.required],
        contract_typ: ['', Validators.required],
        cont_end: ['', Validators.required],
        cont_strt: ['', Validators.required],
        appoprcontracttmp_pk: ['', ''],
        opername_id: ['', ''],
      })

    this.documentForm = this.formBuilder.group({
      documents: this.formBuilder.array([
      ])

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
        job_title: ['', ''],
        cont_type: ['', ''],
        house: [''],
        houseadd: [''],
        count_ry: ['', Validators.required],
        state: ['', Validators.required],
        city: ['', Validators.required],
        inspect_Vtype: ['', ''],
        staffinforepo_pk: ['', ''],
        appostaffinfotmp_pk: ['', ''],
      }),

      this.staffFormedu = this.formBuilder.group({
        institute_name: ['', Validators.required],
        degree_cert: ['', Validators.required],
        gpa_grade: ['', Validators.required],
        GradeDate: ['', Validators.required],
        edut_level: ['', Validators.required],
        education_files: ['', Validators.required],
        stfrepo: ['', ''],
        staffacademics_pk: ['', ''],

      }),

      this.staffworkexperienceForm = this.formBuilder.group({
        oragn_name: ['', Validators.required],
        workdate: ['', ''],
        designat: ['', Validators.required],
        date_join: ['', null],
        curr_work: [''],
        employ_country: ['', Validators.required],
        employ_state: ['', null],
        employ_city: ['', null],
        sexp_staffinforepo_fk: ['', ''],
        staffworkexp_pk: ['', ''],
        file_workexperience: ['', ''],
      }),
      this.courseselectForm = this.formBuilder.group({
        selectcourses: ['', Validators.required],
        filemoher: ['', Validators.required],
        staff_repo: ['', ''],
      }),
      this.InpectionForm = this.formBuilder.group({
        inspectionSelect: ['', Validators.required],
      }),
      this.documentUploadForm = this.formBuilder.group({
        id_card: ['', ''],
        file_ropLicense: ['', ''],
        file_molEmployment: ['', ''],
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

  addChildInput(index) {
    this.childArray.push({ index });
    this.childLoopLength = this.childArray.length;
  }

  removeReferral(index) {
    // console.log('before data', this.ReferralsFormArr, index);
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
      this.appservice.saveStaff(this.staffForm.value, this.appdtlssavetmp_id, this.projectType).subscribe(data => {
        this.staffrep_id = data['data'].data;
        this.loaderform = false;
        this.checkboxdisable = false;
        this.courseselectForm.controls['staff_repo'].setValue(this.staffrep_id);
        if (data.data.status == '1') {
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
          this.oncHeckenableauto(false);
        }

        this.mattab = 7;
        this.checkboxdisable = false;
      });
    } else {
      this.focusInvalidInput(this.staffForm);
    }

  }
  saveStaffduplicate() {
    if (this.staffForm.valid) {
      this.loaderform = true;
      this.staffForm.controls['civil_num'].enable();
      this.staffForm.controls['staffeng'].enable();
      this.staffForm.controls['staffarab'].enable();
      this.staffForm.controls['date_birth'].enable();
      this.staffForm.controls['gend_er'].enable();
      this.appservice.saveStaff(this.staffForm.value, this.appdtlssavetmp_id, this.projectType).subscribe(data => {
        this.staffrep_id = data['data'].data;
        this.loaderform = false;
        this.checkboxdisable = false;
        this.staffconfigurationcheckinras();
        this.courseselectForm.controls['staff_repo'].setValue(this.staffrep_id);
        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
          this.mogerInputed.selectedFilesPk = [];
          if (this.staffForm.get('appostaffinfotmp_pk').value) {
            this.toastr.success(this.i18n('Staff Updated Successfully'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          else {
            this.toastr.success(this.i18n('maincenter.staffcouradde'), ''), {
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

      });
    } else {
      this.focusInvalidInput(this.staffForm);
    }


  }
  staffconfigurationcheckinras() {
    this.appservice.staffconfigurationcheckinras(this.appdtlssavetmp_id, this.projectType).subscribe(res => {
      this.staffconfigstatus = res.data.status;
      this.staffconfigmsg_ar = res.data.msg_ar;
      this.staffconfigmsg_en = res.data.msg_en;
    });
  }
  cancelstaff() {
    setTimeout(() => {
      this.staffFormedu.reset();
      this.educationInput.selectedFilesPk = [];
    }, 1000);
    this.educationformshow = false;
    this.educationdocument = false;

  }
  saveStaffedu() {
    if (this.staffFormedu.valid) {

      this.loaderformeducation = true;
      this.tblplaceholder = true;
      this.staffFormedu.value.GradeDate = moment(this.staffFormedu.value.GradeDate).format('YYYY-MM-DD').toString();
      this.appservice.saveStaffedu(this.staffFormedu.value, this.appdtlssavetmp_id, this.staffrep_id).subscribe(data => {
        this.loaderformeducation = false;
        this.educationformshow = false;
        this.staffFormedu.controls['stfrepo'].setValue(this.staffrep_id);

        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
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
            this.getStaffbasDtls(this.staffrep_id);
          }, 2000);

        }
        this.tblplaceholder = false;
        this.mattab = 7;
        this.educationdocument = false;
      });
    } else {
      this.focusInvalidInput(this.staffFormedu);
      this.educationdocument = true;

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
      this.added = true;

      this.tblplaceholder = true;
      this.spinnerButtonOptionsverified.active = true;
      this.staffworkexperienceForm.value.date_join = moment(this.staffworkexperienceForm.value.date_join).format('YYYY-MM-DD').toString();
      this.staffworkexperienceForm.value.workdate = moment(this.staffworkexperienceForm.value.workdate).format('YYYY-MM-DD').toString();
      this.appservice.saveWorkExp(this.staffworkexperienceForm.value, this.staffrep_id, this.appdtlssavetmp_id).subscribe(data => {
        this.staffworkexperienceForm.controls['sexp_staffinforepo_fk'].setValue(this.staffrep_id);
        if (data.data.status == '1') {
          this.loaderformwork = false;
          this.workexpformshow = false;
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);


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
            this.staffworkexperienceForm.controls['oragn_name'].reset();
            this.staffworkexperienceForm.controls['workdate'].reset();
            this.staffworkexperienceForm.controls['designat'].reset();
            this.staffworkexperienceForm.controls['date_join'].reset();
            this.staffworkexperienceForm.controls['curr_work'].reset();
            this.staffworkexperienceForm.controls['employ_country'].reset();
            this.staffworkexperienceForm.controls['employ_state'].reset();
            this.staffworkexperienceForm.controls['employ_city'].reset();
            this.staffworkexperienceForm.controls['file_workexperience'].reset();

          }, 2000);
          setTimeout(() => {
            this.getStaffworkDtls(this.staffrep_id)
          }, 2000);

        }
        this.staffworkFile = false;
        this.mattab = 7;
        this.scrollTo('workgrid');
        this.tblplaceholder = false;
        this.staffworkedit = false;

      });
    } else {
      this.focusInvalidInput(this.staffworkexperienceForm);
      this.staffworkFile = true;
    }
  }

  saveStaffCourmoher() {
    this.getStaffbasDtls(this.staffrep_id);
    this.getStaffworkDtls(this.staffrep_id);

    if (this.courseselectForm.valid && this.staffForm.valid && this.documentUploadForm.valid) {
      this.disableSubmitButton = true;
      this.staffForm.controls['civil_num'].enable();
      this.staffForm.controls['staffeng'].enable();
      this.staffForm.controls['staffarab'].enable();
      this.staffForm.controls['date_birth'].enable();
      this.staffForm.controls['gend_er'].enable();
      this.checkboxdisable = false;
      this.staffForm.value.date_birth = moment(this.staffForm.value.date_birth).format('YYYY-MM-DD').toString();
      this.appservice.saveStaffCourmoher(this.courseselectForm.value, this.staffrep_id, this.staffForm.value, this.appdtlssavetmp_id, this.projectType, this.documentUploadForm.value).subscribe(data => {
        this.disableSubmitButton = false;
        this.staffconfigurationcheckinras();
        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCenterStatus(this.appdtlssavetmp_id);
          this.mogerInputed.selectedFilesPk = [];
          if (this.staffForm.get('appostaffinfotmp_pk').value) {
            this.toastr.success(this.i18n('Staff Updated Successfully'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          else {
            this.toastr.success(this.i18n('maincenter.staffcouradde'), ''), {
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
        this.updatestaff = false;
      });


    } else {
      this.focusInvalidInput(this.staffForm);
      this.focusInvalidInput(this.courseselectForm);
      this.focusInvalidInput(this.documentUploadForm);
      this.fileemoher = true;
    }
  }

  saveCompanyFormDetails() {

    if (this.comanydetialsform.valid) {
      this.disableSubmitButton = true;

      this.comanydetialsform.value.comp_cr_expiry = moment(this.comanydetialsform.value.comp_cr_expiry).format('YYYY-MM-DD').toString();

      this.appservice.savecompdtls(this.comanydetialsform.value, this.appdtlssavetmp_id).subscribe(data => {
        this.checkboxdisable = false;
        this.appdtlstmp_id = data['data'].data;
        this.getCenterStatus(this.appdtlstmp_id);
        this.getCompDtls();
        this.toastr.success(this.i18n('maincenter.compdetasave'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.appdtlssavetmp_id = this.appdtlstmp_id;
        if (this.appdtlssavetmp_id) {
          this.center_status = true;
          this.getDeclinedStatus(this.appdtlssavetmp_id);
        }
        //this.disableSubmitButton = false;
        this.editOption = true;
        this.mattab = 1;
        this.scrollTo('pagescroll');

      });
    } else {
      this.focusInvalidInput(this.comanydetialsform);
    }
    // }
  }

  saveInsFormDetails() {

    if (this.instituteform.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveinsdtls(this.instituteform.value, this.appdtlssavetmp_id, this.projectType).subscribe(data => {
        this.checkboxdisable = false;
        this.insinfirtmp_Pk = data.data.data;
        this.getDeclinedStatus(this.appdtlssavetmp_id);
        this.getCompDtls();
        this.toastr.success(this.i18n('maincenter.instinfosave'), ''), {
          timeOut: 2000,
          closeButton: false,
        };

        this.mattab = 2;
        this.scrollTo('pagescroll');

      });
    } else {
      this.focusInvalidInput(this.instituteform);

    }
    // }

  }

  saveInternational() {

    let awarderror = this.awaredForm.get('file_award').value;

    if (this.awaredForm.valid) {
      this.disableSubmitButton = true;
      this.awaredForm.value.last_audit = moment(this.awaredForm.value.last_audit).format('YYYY-MM-DD').toString();
      this.appservice.saveInternational(this.awaredForm.value, this.appdtlssavetmp_id).subscribe(data => {

        this.ShowHide = true;
        this.international = false;
        this.mattab = 2;
        this.checkboxdisable = false;

        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.recdropdown();
          this.edit_arard = false;
          this.drvInputed.selectedFilesPk = [];
          if (this.awaredForm.get('appintrecogtmp_pk').value) {
            this.toastr.success(this.i18n('maincenter.interecoupdat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.awaredForm.reset();

          } else {
            this.toastr.success(this.i18n('maincenter.interecoadde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.awaredForm.reset();

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
      this.fileeaward = true;
    }
  }

  clearaward() {

    this.awar.award_organ.setValue('');
    this.awar.last_audit.setValue('');
    this.awar.file_award.setValue('');
    this.awar.appintit_applicationdtlstmp_fk.setValue('');
    this.awar.appintrecogtmp_pk.setValue('');
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

    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteInternational(element).subscribe(data => {
          if (data.data.data == 'mapped_course') {
            this.toastr.warning(this.i18n('You cannot delete this because it is mapped with a Course.'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            if (data.data.status == '1') {
              this.disableSubmitButton = true;
              this.toastr.success(this.i18n('maincenter.interreco'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
              setTimeout(() => {
                this.getDeclinedStatus(element.appintit_applicationdtlstmp_fk);
                this.getInterRecDtls();
                this.recdropdown();
                this.disableSubmitButton = false;
              }, 2000);
            }
          }

        });

      }
    });

  }

  deleteStaff(element) {
    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
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
        title: this.i18n('maincenter.doyouwantgrid'),
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

            this.toastr.success(this.i18n('maincenter.operdele'), ''), {
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
    console.log(element)
    this.staffForm.enable();
    this.updatestaff = true;
    if (element.approval == '1' && this.renewalaction == '2') {
      this.staffForm.controls['civil_num'].disable();
      this.staffForm.controls['date_birth'].disable();
      this.staffForm.controls['gend_er'].disable();

    }
    this.staffFormedu.enable();
    this.staffworkexperienceForm.enable();
    this.courseselectForm.enable();
    this.repocv = element.sir_staffcv;
    this.disableSubmitButton = true;
    this.ShowHide = false;
    this.staffformshow = true;

    if (element.sir_moheridoc) {
      this.mogerInputed.selectedFilesPk = [element.sir_moheridoc];
    } else {
      this.mogerInputed.selectedFilesPk = [];
    }

    if (element.sir_moheridoc) {
      this.molEmploymentdrvInputed.selectedFilesPk = [element.sir_moheridoc];
      setTimeout(() => {
        // this.uploadmoldoc.triggerChange();
      }, 1000);
    } else {
      this.molEmploymentdrvInputed.selectedFilesPk = [];
      this.documentUploadForm.controls['file_molEmployment'].setValue('');
    }
    if (element.sld_ROPlicenseupload) {
      this.ropLicensedrvInputed.selectedFilesPk = [element.sld_ROPlicenseupload];
      setTimeout(() => {
        // this.uploaddrivelic.triggerChange();
      }, 1000);
    } else {
      this.ropLicensedrvInputed.selectedFilesPk = [];
      this.documentUploadForm.controls['file_ropLicense'].setValue('');

    }
    if (element.sir_civilidfront) {
      this.idcarddrvInputed.selectedFilesPk = [element.sir_civilidfront];
      setTimeout(() => {
        // this.uploadid.triggerChange();
      }, 1000);
    } else {
      this.idcarddrvInputed.selectedFilesPk = [];
      this.documentUploadForm.controls['id_card'].setValue('');
    }

    this.documentUploadForm.controls['file_molEmployment'].setValue(element.sir_moheridoc);
    this.documentUploadForm.controls['file_ropLicense'].setValue(element.sld_ROPlicenseupload);
    this.documentUploadForm.controls['id_card'].setValue(element.sir_civilidfront);
    this.statedropdown(31);
    this.citydropdown(element.sir_opalstatemst_fk, 31);
    this.appsit_status = element.appsit_status;
    this.appsit_appdeccomment = element.appsit_appdeccomment;
    this.staffForm.patchValue({
      civil_num: element.sir_idnumber,
      staffeng: element.sir_name_en,
      staffarab: element.sir_name_ar,
      email_id: element.sir_emailid,
      //age: element.test,
      date_birth: element.sir_dob,
      gend_er: element.sir_gender,
      national: element.sir_nationality,
      //role: element.test,
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
    if (this.projectType == 1) {
      this.staffForm.patchValue({
        role: (element.appsit_mainrole !== null) ? element.appsit_mainrole.split(",") : [],

      });
    } else {
      this.staffForm.patchValue({
        role: (element.appsit_roleforcourse !== null) ? element.appsit_roleforcourse.split(",") : [],
        inspect_Vtype: (element.appsit_apprasvehinspcattmp_fk !== null) ? element.appsit_apprasvehinspcattmp_fk.split(",") : [],
      });
    }
    if (this.projectType == 4) {
      this.rasrolecheck(element.appsit_roleforcourse.split(","));
    }
    if (this.aprdec_status == false) {
      this.staffForm.disable();
      this.staffFormedu.disable();
      this.staffworkexperienceForm.disable();
      this.courseselectForm.disable();
    }


    if (this.course_staff_status == true || (element.approval == '1' && this.renewalaction == '2')) {
      this.staffForm.enable();
      this.staffForm.controls['civil_num'].disable();
      this.staffForm.controls['staffeng'].disable();
      this.staffForm.controls['date_birth'].disable();
      this.staffForm.controls['gend_er'].disable();

    }

    if (this.renewalaction == '1') {
      this.staffForm.controls['civil_num'].disable();
      this.staffForm.controls['staffeng'].enable();
      this.staffForm.controls['staffarab'].enable();
      this.staffForm.controls['date_birth'].enable();
      this.staffForm.controls['gend_er'].enable();
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
    // this.disableSubmitButton = true;
    this.ShowHide = false;
    this.staffformshow = true;
    this.staffleveldropdown();
    this.statetutdropdown(element.sacd_opalcountrymst_fk);
    this.citytutdropdown(element.sacd_opalstatemst_fk, element.sacd_opalcountrymst_fk);

    this.educationInput.selectedFilesPk = [element.sacd_certupload];

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
      education_files: element.memcompfiledtls_pk,
      staffacademics_pk: element.staffacademics_pk,
      GradeDate: element.gradedate
      //file_award : element.appintit_doc,
    });
    setTimeout(() => {
      // this.disableSubmitButton = false;
    }, 2000);
    this.pageScrolltopeduform()
  }

  editStaffwork(element) {
    this.staffworkedit = true;
    this.ShowHide = false;
    this.workexpformshow = true;
    this.staffformshow = true;
    this.added = false;
    //this.staffleveldropdown();

    this.stateworkdropdown(element.sexp_opalcountrymst_fk);
    this.cityworkdropdown(element.sexp_opalstatemst_fk, element.sexp_opalcountrymst_fk);
    this.workexperiencedrvInputed.selectedFilesPk = [element.sexp_profdocupload];
    this.staffworkexperienceForm.patchValue({
      oragn_name: element.sexp_employername,
      // workdate: element.sexp_eod,
      designat: element.sexp_designation,
      date_join: element.sexp_doj,
      // curr_work: element.sexp_currentlyworking,
      employ_country: element.sexp_opalcountrymst_fk,
      employ_state: element.sexp_opalstatemst_fk,
      employ_city: element.sexp_opalcitymst_fk,
      //sexp_staffinforepo_fk: element.test,
      staffworkexp_pk: element.staffworkexp_pk,
      file_workexperience: element.sexp_profdocupload,


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
    this.CourseForm.enable();

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
            if (this.course_staff_status == true) {
              //speccontrol.disable();
            }

            if (this.aprdec_status == false) {
              speccontrol.disable();
            }

            if (this.course_staff_status == true) {
              speccontrol.enable();
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
    if (this.aprdec_status == false) {
      this.CourseForm.disable();
    }

    if (this.course_staff_status == true || (element.approval == '1' && this.renewalaction == '2')) {
      this.CourseForm.enable();
      this.CourseForm.controls['course_titleen'].disable();
      this.CourseForm.controls['cour_cate'].disable();
    }
    if (this.renewalaction == '1') {
      this.CourseForm.controls['course_titleen'].enable();
      this.CourseForm.controls['course_titlear'].enable();
      this.CourseForm.controls['cour_cate'].enable();
    }

    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
  }

  delCour(element) {

    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.deleteCour(element).subscribe(data => {
          if (data.data.data == 'mapped_staff') {
            this.toastr.warning(this.i18n('You cannot delete this because it is mapped with a Staff.'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            if (data.data.status == '1') {
              this.checkboxdisable = false;
              this.disableSubmitButton = true;
              this.getCenterStatus(this.appdtlssavetmp_id);
              this.opercourdropdown(this.appdtlssavetmp_id);
              this.toastr.success(this.i18n('Inspection Category Deleted Successfully.'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
              setTimeout(() => {
                this.getDeclinedStatus(element.appoct_applicationdtlstmp_fk);
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
      title: this.i18n('maincenter.doyouwantgrid'),
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
            // this.staffFormedu.controls['year_join'].reset();
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

    // });
  }
  cancelworkstaff() {
    setTimeout(() => {
      this.staffworkexperienceForm.controls['oragn_name'].reset();
      this.staffworkexperienceForm.controls['workdate'].reset();
      this.staffworkexperienceForm.controls['designat'].reset();
      this.staffworkexperienceForm.controls['date_join'].reset();
      this.staffworkexperienceForm.controls['curr_work'].reset();
      this.staffworkexperienceForm.controls['employ_country'].reset();
      this.staffworkexperienceForm.controls['employ_state'].reset();
      this.staffworkexperienceForm.controls['employ_city'].reset();
      this.staffworkexperienceForm.controls['file_workexperience'].reset();
      this.workexperiencedrvInputed.selectedFilesPk = [];

    }, 1000);
    this.staffworkFile = false;
    this.staffworkedit = false;
    this.workexpformshow = false;


  }
  deleteStaffwork(element) {

    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
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
            this.getDeclinedStatus(this.appdtlssavetmp_id);
            this.getCenterStatus(this.appdtlssavetmp_id);
            this.staffworkexperienceForm.controls['oragn_name'].reset();
            this.staffworkexperienceForm.controls['workdate'].reset();
            this.staffworkexperienceForm.controls['designat'].reset();
            this.staffworkexperienceForm.controls['date_join'].reset();
            this.staffworkexperienceForm.controls['curr_work'].reset();
            this.staffworkexperienceForm.controls['employ_country'].reset();
            this.staffworkexperienceForm.controls['employ_state'].reset();
            this.staffworkexperienceForm.controls['employ_city'].reset();
            this.staffworkexperienceForm.controls['staffworkexp_pk'].reset();
            this.staffworkedit = false;

            this.toastr.success(this.i18n('maincenter.workexpeir'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            setTimeout(() => {
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
      this.OperatorContractForm.value.cont_strt = moment(this.OperatorContractForm.value.cont_strt).format('YYYY-MM-DD').toString();
      this.OperatorContractForm.value.cont_end = moment(this.OperatorContractForm.value.cont_end).format('YYYY-MM-DD').toString();
      this.appservice.saveOperContr(this.OperatorContractForm.value, this.appdtlssavetmp_id).subscribe(data => {
        this.checkboxdisable = false;
        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
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
      });
    } else {
      this.focusInvalidInput(this.OperatorContractForm);
    }
  }

  doStuff(event, control) {
    // alert(event.option['value'])
    // this.OperatorContractForm.patchValue({
    //   opername_id: event.option['value']
    // })
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
      // this.disableSubmitButton = true;        
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
        this.mattab = 5;
        this.checkboxdisable = false;

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
  dob = new FormControl('');
  email_id = new FormControl('');
  age = new FormControl('');
  gender = new FormControl('');
  Nation = new FormControl('');
  cont_type = new FormControl('');
  main_role = new FormControl('');
  inspect_cat = new FormControl('');
  status_cour = new FormControl('');
  addd_oncour = new FormControl('');
  LastUpdatedstaff = new FormControl('');
  comp_card = new FormControl('');

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
  designation = new FormControl('');
  count_ryfil = new FormControl('');
  wila_filt = new FormControl('')
  gover_filt = new FormControl('')
  add_edOn = new FormControl('');
  date_last = new FormControl('');


  frstNext() {
    this.mattab = 1;
  }
  scndNext() {
    this.mattab = 2;
  }

  nextstaff() {
    this.mattab = 6;

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
    if (this.projectType == 4) {
      var projectpk = 4;
    } else {
      var projectpk = 1;
    }
    this.disableSubmitButton = true;
    this.appservice.getdocumentdtl(projectpk).subscribe(data => {
      this.doc_list = data.data.data;
      if (this.t.length < this.doc_list.length) {
        let careerRequiredDocs = [];
        let careerRequiredDocsValidation: any[] = [];
        for (let i = this.t.length; i < this.doc_list.length; i++) {
          this.dynamicSelect[i] = true;
          careerRequiredDocs.push({
            fileMstPk: 1,
            selectedFilesPk: []
          });
          const control = <FormArray>this.documentForm.controls['documents'];
          control.push(
            this.formBuilder.group({
              fileName: ['', Validators.required],
              provided: [1, [Validators.required]],
              keymap: [this.doc_list[i].documentdtlsmst_pk, [Validators.required]],
              remark_fst: ['', ''],
              appdocsubmissiontmp_pk: ['', '']
            })
          );

        }

        this.centreRequiredDocs = careerRequiredDocs;
        this.formBuilder.group(careerRequiredDocsValidation);
      }

    });
    this.disableSubmitButton = false;
  }

  getdocumentdtledit() {
    if (this.t.length < this.docmnt_list.length) {
      let careerRequiredDocs = [];
      let careerRequiredDocsValidation: any[] = [];
      for (let i = this.t.length; i < this.docmnt_list.length; i++) {
        this.dynamicSelect[i] = true;
        careerRequiredDocs.push({
          fileMstPk: 1,
          selectedFilesPk: []
        });
        const control = <FormArray>this.documentForm.controls['documents'];
        control.push(
          this.formBuilder.group({
            fileName: ['', Validators.required],
            provided: [1, [Validators.required]],
            keymap: [this.doc_list[i].documentdtlsmst_pk, [Validators.required]],
            remark_fst: ['', Validators.required],
            appdocsubmissiontmp_pk: ['', '']
          })
        );

      }

      this.centreRequiredDocs = careerRequiredDocs;
      this.formBuilder.group(careerRequiredDocsValidation);
    }
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

  getCenterStatus(appdtlssavetmp_id) {
    this.appservice.getCenterStatus(appdtlssavetmp_id).subscribe(data => {
      //alert(data.data.appdt_status)
      if (data.data) {
        this.resubmit_status = data.data.appdt_status;
      }
      if (data.data.appdt_status == 1) {

        this.aprdec_status = true;
        this.notallowedone = true;
      } else if (data.data.appdt_status == 3) {
        this.aprdec_status = true;
        this.notallowedone = true;

      }

      this.routeid.queryParams.subscribe(params => {
        if (this.security.decrypt(params['renew'])) {
          this.apptype = this.security.decrypt(params['renew']);

          if (this.apptype) {
            if (this.apptype == '1' && data.data.appdt_status != 2 && data.data.appdt_status != 4) {
              this.aprdec_status = true;
              this.notallowedone = true;
            }
          }

          if (this.apptype) {
            if (this.apptype == '3') {
              this.aprdec_status = false;
              this.notallowedone = false;
              this.course_staff_status = false;
              this.deleteicon = false;
              this.documentdeleteicon = false;
              this.thirddeleteicon = false;
              this.workdeleteicon = false;
              this.requiredfieldshow = false;

            }
          }
          if (this.apptype) {
            if (this.apptype == '2') {
              this.aprdec_status = true;
              this.comanydetialsform.disable();
              this.instituteform.disable();
              this.awaredForm.disable();
              this.OperatorContractForm.disable();
              this.documentForm.disable();
              console.log(data.data, 'renew');
              this.noneditdocument = false;
              this.noteditablefield = false;
              this.documentdeleteicon = false;
              this.thirddeleteicon = false;
            }
          }
        }
      });      // enable to edit App

      if (data.data.appdt_status >= 5 && this.renewalaction != '3') {
        this.course_staff_status = true;
      }
      if (data.data.appdt_status == 20) {
        this.course_staff_status = false;
      }

      if (data.data.appdt_status == 2 || data.data.appdt_status == 4) {
        this.CourseForm.disable();
        this.staffForm.disable();
        this.staffFormedu.disable();
        this.staffworkexperienceForm.disable();
        this.courseselectForm.disable();
      }

      if (this.aprdec_status == false) {
        this.comanydetialsform.disable();
        this.deleteicon = false;
        this.documentdeleteicon = false;
        this.thirddeleteicon = false;
        this.workdeleteicon = false;
        this.instituteform.disable();
        this.awaredForm.disable();
        this.OperatorContractForm.disable();
        this.documentForm.disable();
        this.dynamicForm.disable();

      }

      if (this.center_status == true && this.aprdec_status == false) {
        this.textareastatus = true;
      }

      if ((!appdtlssavetmp_id && this.aprdec_status == false) || (this.center_status == true && this.aprdec_status == true)) {
        this.logostatus = true;
      }

    });
  }

  getAppStatus(appdtlssavetmp_id) {
    this.appservice.getAppStatus(appdtlssavetmp_id).subscribe(data => {
      if (data.data.appoct_status == '1') {
        this.checkboxdisable = false;
      } else if (data.data.appoct_status == '2') {
        this.checkboxdisable = false;
      } else if (data.data.appsit_status == '1') {
        this.checkboxdisable = false;
      } else if (data.data.appsit_status == '2') {
        this.checkboxdisable = false;
      } else if (data.data.appintit_status == '1') {
        this.checkboxdisable = false;
      } else if (data.data.appintit_status == '2') {
        this.checkboxdisable = false;
      } else if (data.data.acdt_status == '1') {
        this.checkboxdisable = false;
      } else if (data.data.acdt_status == '2') {
        this.checkboxdisable = false;
      } else if (data.data.appiit_status == '1') {
        this.checkboxdisable = false;
      } else if (data.data.appiit_status == '2') {
        this.checkboxdisable = false;
      } else if (data.data.appdst_status == '1') {
        this.checkboxdisable = false;
      } else if (data.data.appdst_status == '2') {
        this.checkboxdisable = false;
      } else if (data.data.appoprct_status == '1') {
        this.checkboxdisable = false;
      } else if (data.data.appoprct_status == '2') {
        this.checkboxdisable = false;
      } else {
        this.checkboxdisable = true;
      }

    });
  }

  roledropdown() {
    this.appservice.getrole().subscribe(data => {
      this.role_list = data.data;
    });
  }


  recdropdown() {
    this.appservice.getrec(this.appdtlssavetmp_id).subscribe(data => {
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
    this.profileService.getcity(country, state).subscribe(data => {
      this.wilayatlist = data.data;
      //this.disableSubmitButton = false;
    });
  }
  getwilayatbyid1(country, state) {
    this.profileService.getcity(country, state).subscribe(data => {
      this.wilayatlist1 = data.data;
      //this.disableSubmitButton = false;
    });
  }
  selectedGovernorate(value) {
    if (this.governoratelist) {
      //alert(value)
      this.governoratelist.forEach(y => {
        if (y.opalstatemst_pk == value) {
          this.comanydetialsform.controls['governorate'].setValue(value);
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
  selectedGovernorate1(value) {
    if (this.governoratelist) {
      //alert(value)
      this.governoratelist.forEach(y => {
        if (y.opalstatemst_pk == value) {
          this.comanydetialsform.controls['governorate'].setValue(value);
          this.selectedEstGovernorate = y.osm_statename_en;
          this.selectedEstGovernorateAr = y.osm_statename_ar;
          this.getwilayatbyid1(31, value);
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
      this.filternames = this.i18n('table.show');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filternames = this.i18n('table.hide');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

  editfocal(type, pkType) {

    this.route.navigate(['/accountsettings/home'], { queryParams: { id: this.security.encrypt(3), type: this.security.encrypt(type) } });
    localStorage.setItem('projectPk', pkType);

  }
  editdifffocl(Value) {
    swal({
      title: this.i18n('Are you want to change Different Focal Point?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        if (Value == true) {
          this.differntfoculpoint = 'yes';
          this.editOption = false;
          this.comanydetialsform.controls['focalpoint_emailid'].setValidators([Validators.required, Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$')]);
          this.comanydetialsform.controls['focalpoint_emailid'].updateValueAndValidity();
        }

      }
    });

  }
  //company detials

  //previous button
  prev() {
    this.disableSubmitButton = true;
    this.mattab = -1;
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
  }
  //institute detials
  addinstite() {
    this.disableSubmitButton = true;
    this.mattab = 2;
    // this.pageScrolltop();
    this.scrollTo('pagescroll');
    this.disableSubmitButton = false;
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
            this.fileeaward = false;
            this.mattab = 2;
            // this.pageScrolltop();
            this.scrollTo('pagescroll');
            setTimeout(() => {
              this.disableSubmitButton = false;
            }, 2000);
            setTimeout(() => {
              this.getStaffDtls();

            }, 1000);
            // this.pageScrolltop();

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
            // this.pageScrolltop();
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
      //// this.pageScrolltop();
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
  //opearator contact
  addoperatData() {
    // if (this.OperatorContractForm.valid) {
    //   this.mattab = 3;
    // this.operatcont = false;
    // this.ShowHide = true;
    // }

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
    if (this.projectType == 1) {
      this.mattab = 3;
      this.scrollTo('pagescroll');
    }
    else {
      this.mattab = 1;
      this.scrollTo('pagescroll');
    }


  }
  saveDocument() {

    if (this.documentForm.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveDocuments(this.documentForm.value, this.appdtlssavetmp_id, this.doc_id).subscribe(data => {
        this.doc_id = data['data'].data;
        if (data.data.status == '1') {
          this.getDeclinedStatus(this.appdtlssavetmp_id);
          this.getCompDtls();
          this.toastr.success(this.i18n('maincenter.docureqsave'), ''), {
            timeOut: 2000,
            closeButton: false,
          };


          setTimeout(() => {
            this.getdoc(this.appdtlssavetmp_id)
          }, 2000);


        }
        if (this.projectType == 1) {
          this.mattab = 5;
        } else {
          this.mattab = 3;

        }
        this.scrollTo('pagescroll');

      });
    } else {
      this.focusInvalidInput(this.documentForm);
    }
  }
  nextInspect() {
    if (this.projectType == 1) {
      this.mattab = 5;
    }
    else {
      this.mattab = 3;
    }
  }

  //course
  showHidecourse() {
    this.disableSubmitButton = true;
    if (this.ReferralsFormArr.length > 1) {
      const formArray = this.ReferralsFormArr;
      formArray.clear();
      this.addReferral()
    }

    this.courses = true;
    this.ShowHide = false;
    this.disableSubmitButton = false;
    this.id = '0';
    this.value = '';
    this.appoct_status = '';
    this.value = 'none';
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
            this.mattab = 5;
            // this.pageScrolltop();
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
            this.mattab = 5;
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
      this.mattab = 5;
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);

    }


  }

  prevdocument() {
    this.disableSubmitButton = true;
    this.mattab = 4;
    this.disableSubmitButton = false;

  }

  subdesk() {
    if (this.projectType == 4) {

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
              innerHTML: this.staffconfigmsg_en,
            }
          }

        });
        return false;
      }
    }
    if (this.projectType == 1) {
      this.subContent = this.i18n('maincenter.doyousubmt');
    } else {
      this.subContent = this.i18n('Do you want to confirm submission of the RAS Inspection Centre Certification Form?');
    }
    swal({
      title: this.subContent,
      // text: 'You can still recover the file from the JSRS drive.',
      icon: 'success',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;

        this.appservice.savesubdesk(this.appdtlssavetmp_id, this.renewalaction, this.projectType, this.comanydetialsform.value, this.differntfoculpoint).subscribe(data => {
          this.FormMainTemplate = 'success';
          this.renewal = false;
          this.getCenterStatus(this.appdtlssavetmp_id);
          if (this.projectType == 1) {
            this.toastr.success(this.i18n('maincenter.popsubmit'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('RAS Centre Certification Form Submitted Successfully.'), ''), {
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

        } else if (data.data.data.appiit_officetype == 2) {
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
              this.staffForm.controls['email_id'].setValue("");
              this.ageShow = true;
              this.staffrep_id = '';
              this.genderShow = false;
              return false;
            }
          });

        } else {
          this.statedropdown(31);
          this.citydropdown(data.data.data.sir_opalstatemst_fk, 31);
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
        } else {
          this.statedropdown(31);
          this.citydropdown(data.data.data.sir_opalstatemst_fk, 31);
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
          this.genderShow = false;
          this.ageShow = true;
          return false;

        }

      }


    });
  }
  //staff
  canclstaff() {
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

            this.mattab = 6;
            this.staffformshow = false;
            this.ShowHide = true;

            this.staffForm.reset();
            this.staffFormedu.reset();
            this.staffworkexperienceForm.reset();
            this.courseselectForm.reset();
            this.staffrep_id = "";
            this.fileemoher = false;
            this.updatestaff = false;
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

            this.mattab = 6;
            this.staffformshow = false;
            this.ShowHide = true;

            this.staffForm.reset();
            this.staffFormedu.reset();
            this.staffworkexperienceForm.reset();
            this.courseselectForm.reset();
            this.staffrep_id = "";
            this.fileemoher = false;
            this.updatestaff = false;
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

      this.mattab = 6;
      this.staffformshow = false;
      this.ShowHide = true;

      this.staffForm.reset();
      this.staffFormedu.reset();
      this.staffworkexperienceForm.reset();
      this.courseselectForm.reset();
      this.staffrep_id = "";
      this.updatestaff = false;
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);
    }


  }

  showHidestaff() {
    this.staffrep_id = '';
    this.staffForm.reset();
    this.staffFormedu.reset();
    this.staffworkexperienceForm.reset();
    this.courseselectForm.reset();
    this.documentUploadForm.reset();
    this.interRecListDataStaffbas = new MatTableDataSource([]);
    this.interRecListDataStaffwork = new MatTableDataSource([]);
    this.disableSubmitButton = true;
    this.staffformshow = true;
    this.ShowHide = false;
    this.disableSubmitButton = false;
    this.appsit_status = "";
    this.appsit_appdeccomment = "";
    this.ageShow = true;
    this.onchangecount();
    this.idcarddrvInputed.selectedFilesPk = [];
    this.ropLicensedrvInputed.selectedFilesPk = [];
    this.molEmploymentdrvInputed.selectedFilesPk = [];



  }
  prevcourse() {
    if (this.projectType == 1) {
      this.mattab = 5;
    } else {
      this.mattab = 3;
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
      if (willDelete) {
        this.appservice.saveLogo([]).subscribe(data => {
          if (data.data.status == 1) {
            this.drv_logo.selectedFilesPk = [];
            setTimeout(() => {
              this.logo.triggerChange();
              //this.showWSuccess();
              //this.upadtebtn();
              this.toastr.success(this.i18n('maincenter.imgdele'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
            }, 1000);
          }
        })
      }
    })
  }

  onTabSelect(event: any) {
    // const index = event.index;
    // this.tabClickFunctions[index]();
  }

  locale: LocaleConfig = {
    format: 'DD-MM-YYYY',
  }
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }

  omancont() {
    this.staffForm.controls.gender_address.setValue(this.i18n('staff.oman'))
  }
  cityselect(country) {
    if (country == 31) {
      this.oman = true;
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
    let stDate = '';
    let edDate = '';
    this.dateFilterSt = '';
    this.dateFilterEd = '';
    if (this.opal_memb_expiry.value) {
      stDate = (this.opal_memb_expiry.value.startDate) ? moment(this.opal_memb_expiry.value.startDate).format('YYYY/MM/DD') : '';
      edDate = (this.opal_memb_expiry.value.endDate) ? moment(this.opal_memb_expiry.value.endDate).format('YYYY/MM/DD') : '';
      this.dateFilterSt = (this.opal_memb_expiry.value.startDate) ? moment(this.opal_memb_expiry.value.startDate).format('DD-MM-YYYY') : '';
      this.dateFilterEd = (this.opal_memb_expiry.value.endDate) ? moment(this.opal_memb_expiry.value.endDate).format('DD-MM-YYYY') : '';
    }
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


    if (this.renewalaction == 2) {
      swal({
        title: this.i18n('maincenter.doyoucomp'),
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          if (this.renewal == true) {
            if (this.projectType == 1) {
              this.route.navigate(['trainingcentremanagement/branchcentre/MQ==']);
            } else {
              this.route.navigate(['trainingcentremanagement/rasbranchcentre/NA==']);
            }
          }
          else {
            this.renewal = false;
          }
          setTimeout(() => {
            this.disableSubmitButton = false;
          }, 2000);
        }
      });
    } else if (this.renewalaction == 1) {
      swal({
        title: this.i18n("Do you want to cancel adding this Company's Details?"),
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          if (this.renewal == true) {
            if (this.projectType == 1) {
              this.route.navigate(['trainingcentremanagement/branchcentre/MQ==']);
            } else {
              this.route.navigate(['trainingcentremanagement/rasbranchcentre/NA==']);
            }
          }
          else {
            this.renewal = false;
          }
          setTimeout(() => {
            this.disableSubmitButton = false;
          }, 2000);
        }
      });
    }
    else {
      swal({
        title: this.i18n('Do you want to go back'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          if (this.renewal == true) {
            if (this.projectType == 1) {
              this.route.navigate(['trainingcentremanagement/branchcentre/MQ==']);
            } else {
              this.route.navigate(['trainingcentremanagement/rasbranchcentre/NA==']);
            }
          }
          else {
            this.renewal = false;
          }
          setTimeout(() => {
            this.disableSubmitButton = false;
          }, 2000);
        }
      });
    }


  }
  clearFilter() {
    this.Awarding.setValue("");
    this.LastAudited.setValue("");
    this.Status.setValue("");
    this.Addedon.reset();
    this.LastUpdated.reset;
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
    this.inspect_cat.reset();
    this.status_cour.setValue("");
    this.comp_card.reset()
    this.addd_oncour.setValue("");
    this.LastUpdatedstaffdate.setValue("");
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
    this.designation.setValue("");
    this.count_ryfil.reset();
    this.gover_filt.reset();
    this.wila_filt.reset();
    this.add_edOn.setValue("");
    this.add_On.reset();
    this.date_last.reset();
    $(".clear").trigger("click");
  }
  public options = Lccdivison.switchoption
  id: any = "";
  value: any = "";
  yesno: boolean = false;
  onSelectionChange(entry, value) {
    this.id = entry;
    this.value = value;
    if (this.id == 0) {
      this.yesno = true;
      this.value = 'No';
      this.CourseForm.controls['slider'].setValue(2);
    }
    else {
      this.yesno = true;
      this.value = 'Yes';
      this.CourseForm.controls['slider'].setValue(1);
    }
  }
  onSelectionChangeyes(entry) {
    this.id = entry;

    if (this.id == 2) {
      this.yesno = true;
      this.value = 'No';
      this.CourseForm.controls['slider'].setValue(2);
    }
    else {
      this.yesno = true;
      this.value = 'Yes';
      this.CourseForm.controls['slider'].setValue(1);
    }
  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
  }
  animateCallback = (animationState: AnimationEvent) => {
    if (animationState.toState === 'expanded') {
      animationState.element.classList.add('my-class');
    } else if (animationState.toState === 'collapsed') {
      animationState.element.classList.remove('my-class');
    }
  };
  redirect() {
    this.disableSubmitButton = true;
    if (this.projectType == 1) {
      this.route.navigate(['/trainingcentremanagement/maincentre'], { queryParams: { p: this.secuirty.encrypt(1), renew: this.security.encrypt(3) } });
    } else {
      this.route.navigate(['/trainingcentremanagement/rascentre'], { queryParams: { p: this.secuirty.encrypt(4), renew: this.security.encrypt(3) } });
    }
    setTimeout(() => {
      this.disableSubmitButton = false;
    }, 2000);
    this.mattab = 0;
  }
  viewinvoice() {
    this.routeid.queryParams.subscribe(params => {
      this.refname = this.secuirty.decrypt(params['id']);
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
  notallowed: boolean = false;
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

  pageScrolltopwork() {
    document.getElementById('workgrid').scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest"

    });
  }
  pageScrolltopedu() {
    document.getElementById('edugrid').scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest"

    });
  }
  pageScrolltopeduform() {
    document.getElementById('education').scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest"

    });
  }
  onchangecount() {
    this.staffForm.controls['count_ry'].enable();
    this.omancountry = false;
    this.staffForm.controls['count_ry'].setValue('31');
    this.staffForm.controls['count_ry'].disable();
    this.statedropdown(31);
    this.omancountry = true;
  }
  spinnerButtonOptionsverified: MatProgressButtonOptions = {
    active: false,
    text: 'Add',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    type: 'button',
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: true,
    mode: 'indeterminate'
  };
  spinnerButtonOptionsedu: MatProgressButtonOptions = {
    active: false,
    text: 'Add',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    type: 'button',
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: true,
    mode: 'indeterminate'
  };

  openCert(value) {
    const pdfUrl = value;
    window.open(pdfUrl, '_blank');
  }
  openReport(value) {
    const pdfUrl = value;
    var modifiedUrlString = pdfUrl.replace(/\+\+\+.*/, '');
    var url = modifiedUrlString + 'original.pdf';
    window.open(pdfUrl, '_blank');
  }
  breadcrub() {
    document.querySelector('.breadcrumb-item.active').innerHTML = 'Institute Information';
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
  }
  oncHeckenable(event: MatCheckboxChange) {
    if (event.checked) {
      this.finalsubmitbtn = false;
    } else {
      this.finalsubmitbtn = true;
    }
  }
  oncHeckenableauto(event) {
    if (event) {
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
    } else {
      return '';
    }
  }
  splitRascatFunction(data) {
    if (data && typeof data === 'string') {
      this.rolerascatcategory = data.split(',');
      this.rolerascategory_remove = data.split(',');
      this.rolerascategory_remove.shift();
      return this.rolerascatcategory[0];
    } else {
      return '';
    }
  }
  toggle(index: number): void {
    this.isopen[index] = !this.isopen[index];
  }
  previousDocument() {
    this.mattab = 2;
  }
  nexttoStaff() {
    this.mattab = 4;
  }
  sHowInpection() {
    this.InpectionCategary = true;
    this.ShowHide = false;
  }

  saveInpectionForm() {
    if (this.InpectionForm.valid) {
      this.disableSubmitButton = true;
      this.appservice.saveinspectioncategory(this.InpectionForm.value, this.appdtlssavetmp_id).subscribe(data => {
        this.disableSubmitButton = false;
        if (data.status == 200) {
          // this.res_inspectioncategory = data.data;

          this.InpectionForm.reset();
          this.mattab = 3;
          this.ShowHide = true;
          this.InpectionCategary = false;
          this.scrollTo('pagescroll');
          this.getrascategorydata(10, 0, null);
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
    if (this.InpectionForm.touched) {
      swal({
        title: this.i18n('Do you want to cancel adding this Inspection Categories?'),
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.disableSubmitButton = true;
          this.InpectionForm.reset();
          this.mattab = 3;
          this.ShowHide = true;
          this.InpectionCategary = false;
          this.scrollTo('pagescroll');
          setTimeout(() => {
            this.disableSubmitButton = false;
          }, 2000);

        }
      });
    } else {
      this.disableSubmitButton = true;
      this.mattab = 3;
      this.ShowHide = true;
      this.InpectionCategary = false;
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 2000);
    }
  }
  getrascategorydata(limit, page, search) {
    this.tblplaceholders = true;
    this.appservice.getrascategorydata(limit, page, search, this.appdtlssavetmp_id).subscribe(res => {
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
  rasinspectonserch() {
    this.serach = {
      inspectcat_serch: this.inspectcat.value,
      InspectStatus_serch: this.InspectStatus.value,
      inspectAddedon_serch: this.inspectAddedon.value,
      inpectLastUpdated_serch: this.inpectLastUpdated.value
    }
    this.getrascategorydata(10, 0, this.serach)
  }
  syncPaginator(event: PageEvent) {
    this.inspectPaginator.pageIndex = event.pageIndex;
    this.inspectPaginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  inspectcat = new FormControl();
  InspectStatus = new FormControl();
  inspectAddedon = new FormControl();
  inpectLastUpdated = new FormControl();

  clearInspection() {
    this.inspectcat.reset();
    this.InspectStatus.reset();
    this.inspectAddedon.reset();
    this.inpectLastUpdated.reset();
    this.getrascategorydata(10, 0, null)
  }
  rasrolecheck(rolevalue) {
    //16-Inspector 17-Verifier 18-Supervisor
    if (rolevalue.includes('16')) {
      this.documentUploadForm.controls['id_card'].setValidators([Validators.required]);
      this.documentUploadForm.controls['file_ropLicense'].setValidators([Validators.required]);
      this.documentUploadForm.controls['file_molEmployment'].setValidators([Validators.required]);
      this.showotherdocument = true;
      this.requiredFordoc = true;
      // this.requiredwork = true;
      // alert(1)
      // this.staffworkexperienceForm.controls['file_workexperience'].setValidators([Validators.required]);
    } else {
      // alert(2)
      this.showotherdocument = false;
      this.requiredFordoc = false;
      this.documentUploadForm.controls['id_card'].clearValidators();
      this.documentUploadForm.controls['file_ropLicense'].clearValidators();
      this.documentUploadForm.controls['file_molEmployment'].clearValidators();
      this.idcarddrvInputed.selectedFilesPk = []
      this.ropLicensedrvInputed.selectedFilesPk = []
      this.molEmploymentdrvInputed.selectedFilesPk = []
      // this.requiredwork = false;
      this.workexperiencedrvInputed.selectedFilesPk = []
      // this.staffworkexperienceForm.controls['file_workexperience'].clearValidators();
    }
    this.documentUploadForm.controls['id_card'].updateValueAndValidity();
    this.documentUploadForm.controls['file_ropLicense'].updateValueAndValidity();
    this.documentUploadForm.controls['file_molEmployment'].updateValueAndValidity();
    // this.staffworkexperienceForm.controls['file_workexperience'].updateValueAndValidity();
  }
  editInspect() {
    this.InpectionCategary = true;
    this.ShowHide = false;
  }
  deleteinspect(rascategorypk) {
    swal({
      title: this.i18n('maincenter.doyouwantgrid'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.appservice.rascheckvehicalcateforymap(this.appdtlssavetmp_id, rascategorypk, this.projectType).subscribe(res => {
          if (res.data.mapped == 'yes') {
            swal({
              title: this.i18n('Please remove the Staff members from their respective Inspection Categories to exclude the Categories from the Inspection Categories section.'),
              text: '',
              icon: 'warning',
              buttons: [false, this.i18n('uploadfile.ok')],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            });

          } else {
            this.toastr.success(this.i18n('Inspection Category Deleted Successfully.'), ''), {
              timeOut: 2000,
              closeButton: false,
            }
            this.getrascategorydata(10, 0, null);
            this.getrasinspectioncategory();
            this.staffconfigurationcheckinras();
            this.allSelected = false;
          }

        });
      }
    });
  }
  toggleAllSelection() {
    if (this.allSelected) {
      this.selectbox.options.forEach((item: MatOption) => item.select());
    } else {
      this.selectbox.options.forEach((item: MatOption) => item.deselect());
    }
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
  checkValidation() {
    if (this.projectType == 1) {
      this.comanydetialsform.controls['moheri_grade'].setValidators([Validators.required]);
      this.comanydetialsform.controls['file_cractivity'].clearValidators();
      this.instituteform.controls['no_techstaff'].setValidators([Validators.required]);
      this.instituteform.controls['curr_learn'].setValidators([Validators.required]);
      this.instituteform.controls['trainprovmax'].setValidators([Validators.required]);
      this.instituteform.controls['instgovernorate'].clearValidators();
      this.instituteform.controls['wila_yat'].clearValidators();
      this.instituteform.controls['inst_address1'].clearValidators();
      this.staffForm.controls['inspect_Vtype'].clearValidators();
      this.courseselectForm.controls['filemoher'].setValidators([Validators.required]);
      this.courseselectForm.controls['selectcourses'].setValidators([Validators.required]);
      this.documentUploadForm.controls['id_card'].clearValidators();
      this.documentUploadForm.controls['file_ropLicense'].clearValidators();
      this.documentUploadForm.controls['file_molEmployment'].clearValidators();
    } else {
      this.comanydetialsform.controls['moheri_grade'].clearValidators();
      this.comanydetialsform.controls['file_cractivity'].setValidators([Validators.required]);
      this.instituteform.controls['no_techstaff'].clearValidators();
      this.instituteform.controls['curr_learn'].clearValidators();
      this.instituteform.controls['trainprovmax'].clearValidators();
      this.instituteform.controls['instgovernorate'].setValidators([Validators.required]);
      this.instituteform.controls['wila_yat'].setValidators([Validators.required]);
      this.instituteform.controls['inst_address1'].setValidators([Validators.required]);
      this.staffForm.controls['inspect_Vtype'].setValidators([Validators.required]);
      this.courseselectForm.controls['filemoher'].clearValidators();
      this.courseselectForm.controls['selectcourses'].clearValidators();
      this.documentUploadForm.controls['id_card'].setValidators([Validators.required]);
      this.documentUploadForm.controls['file_ropLicense'].setValidators([Validators.required]);
      this.documentUploadForm.controls['file_molEmployment'].setValidators([Validators.required]);
    }
    this.comanydetialsform.controls['moheri_grade'].updateValueAndValidity();
    this.comanydetialsform.controls['file_cractivity'].updateValueAndValidity();
    this.instituteform.controls['no_techstaff'].updateValueAndValidity();
    this.instituteform.controls['curr_learn'].updateValueAndValidity();
    this.instituteform.controls['trainprovmax'].updateValueAndValidity();
    this.instituteform.controls['instgovernorate'].updateValueAndValidity();
    this.instituteform.controls['wila_yat'].updateValueAndValidity();
    this.instituteform.controls['inst_address1'].updateValueAndValidity();
    this.staffForm.controls['inspect_Vtype'].updateValueAndValidity();
    this.courseselectForm.controls['filemoher'].updateValueAndValidity();
    this.courseselectForm.controls['selectcourses'].updateValueAndValidity();
    this.documentUploadForm.controls['id_card'].updateValueAndValidity();
    this.documentUploadForm.controls['file_ropLicense'].updateValueAndValidity();
    this.documentUploadForm.controls['file_molEmployment'].updateValueAndValidity();
  }
  breadCrumb() {
    if (this.firstUrl == 1) {
      const breadClass = document.getElementById('breadCrubHide') as HTMLElement;
      breadClass.style.display = 'none';
      const pageTitle = document.querySelector('.page-title');
      pageTitle.classList.add('modified-page-title');

    } else {
      const breadClass = document.getElementById('breadCrubHide') as HTMLElement;
      breadClass.style.display = 'block';
      const pageTitle = document.querySelector('.page-title');
      pageTitle.classList.remove('modified-page-title');
    }
  }
  onPaste($event: ClipboardEvent) {
    $event.preventDefault();
    return false;
  }
}


export class MainInsPagination {
  constructor(private http?: HttpClient) {
  }
  interRecGridUtil(sort: string, order: string, page: number,
    size: number, query: string, search?: string, gridsearchValues?: string, appdtlssavetmp_id?: number): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getinterrecdtls';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}`;
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
    size: number, query: string, search?: string, gridsearchValues?: string, appdtlssavetmp_id?: number, memregPk?: number, projectType?: number): Observable<any> {
    const sign = (order === 'desc') ? '-' : '';
    const href = environment.baseUrl + 'center/app-center/getstaff';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}&appdtlssavetmp_id=${appdtlssavetmp_id}&memRegPk=${memregPk}&projecttype=${projectType}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

