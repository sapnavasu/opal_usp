import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormControl, FormGroup,Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS } from '@angular/material/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { APP_DATE_FORMATS, AppDateAdapter } from '@app/@shared/format-datepicker';
import moment from 'moment';
import { MatTableDataSource } from '@angular/material/table';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatCheckbox, MatCheckboxChange } from '@angular/material/checkbox';
import { DriveInput } from '@app/common/classes/driveInput';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
export interface ResultOpr {
  rm_name_en: string;
}

export interface Element {
  sacd_institutename: string;
  sacd_degorcert: string;
  sacd_edulevel: string;
  sacd_enddate:string;
  certificatedoc: string;
  sacd_grade: string;
  sacd_createdon: string;
  sacd_updatedon: string;
}

const ELEMENT_DATA: Element[] = [
  {sacd_institutename:'OPAL-TP-BO-001',sacd_degorcert:'Main Office',sacd_edulevel:'Ubhar Capital',sacd_enddate:'FMB 120 device',certificatedoc:'Approved',sacd_grade:'24-03-2023',sacd_createdon:'sacd_createdon',sacd_updatedon: ''  },
];
@Component({
  selector: 'app-staffform',
  templateUrl: './staffform.component.html',
  styleUrls: ['./staffform.component.scss'],
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class StaffformComponent implements OnInit {

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

  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
   @ViewChild('DataChkbox') DataChkbox: MatCheckbox;
   @Input('viewForm') viewForm: boolean = false;
   public selectAllEducation: boolean = false;
   @ViewChild('chkWork') chkWork: MatCheckbox;
   public selectAllWork: boolean = false;
  public staffForm: FormGroup;
  public educationForm: FormGroup;
  public documentUploadForm: FormGroup;
  public staffworkexperienceForm: FormGroup;
  public appdt_status: any
  public searchName: any;
  public updatedForms: boolean;
  public updatedon: any;
  public createdon: any;
  public previousFormValue: any=[];
  public cancelpopup: string;
  public submitpop: string;
  public commentBox: boolean;
  public commentVlaues: string;
  public validationby: string;  
  public validation: string;
  public loaderform: boolean = false;
  public genderselect: string;
  public genderShow: boolean;
  public ageShow: boolean = true;
  public maxDate = new Date();
  public staffDetailsForm: boolean;
  public educationformshow: boolean = false;
  public workexpformshow: boolean = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  today = new Date();
  public resultsLengthStaffbas: number;
  public page: number = 10;
  public tblplaceholder: boolean = false;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild("paginatorseven") paginatorseven: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild(MatSort) sorted: MatSort;
  public hidefilder: boolean = true;
  public filternames = "Hide Filter";
  public filtername = "Hide Filter";
  public staffeduedit: boolean = false;
  public educationInput: DriveInput;
  public loaderformwork: boolean = false;
  public isCheckboxDisabled: boolean = false;
  public cleardate: boolean = false;
  public worktilled: boolean = true;
  public notallowed: boolean = false;
  public updatestaff: boolean = false;
  public workexperiencedrvInputed: DriveInput;
  public resultsLengthStaffwork: number;
  public staffworkedit: boolean = false;
  public selectedDate: any;
  public idcarddrvInputed: DriveInput;
  public ropLicensedrvInputed: DriveInput;
  public molEmploymentdrvInputed: DriveInput;
  public vendorEmployee: DriveInput;
  public ivmsmodel: DriveInput;
  public uploadDocument: boolean;
  SearchResultOpr: ResultOpr[] = [
    { rm_name_en: 'hussa'},
    { rm_name_en: 'ibrah'},
    { rm_name_en: 'hafsa'},
    { rm_name_en: 'aisha'},
    { rm_name_en: 'amira'}
  ];

  documentList = [
    {
      title: 'ID Card',
      images: [
        { type: 'pdf' , url: ''},
       ],
    },
    {
      title: 'ROP Driver License',
      images: [
         { type: 'pdf' , url: ''},
         { type: 'pdf' , url: ''},
         { type: 'pdf' , url: ''},      ],
    },{
      title: 'MOL Employment Contract',
      images: [
         { type: 'pdf' , url: ''},
         { type: 'pdf' , url: ''},
         { type: 'pdf' , url: ''},      ],
    },{
      title: 'The Contract between the Vendor and the Employee',
      images: [
         { type: 'pdf' , url: ''},
         { type: 'pdf' , url: ''},
         { type: 'pdf' , url: ''},      ],
    },{
      title: 'Competency Certificate for IVMS Device Model',
      images: [
        
      ],
    },
  ];

  interRecListDataStaffbas = new MatTableDataSource<Element>(ELEMENT_DATA);
  constructor(private translate: TranslateService, public toastr: ToastrService,private security: Encrypt,
    private remoteService: RemoteService,private formBuilder: FormBuilder, private el:ElementRef,
    private cookieService: CookieService,public routeid: ActivatedRoute, private route: Router,) { }

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

   this.formvalidated();
    this.previousFormValue = this.staffForm.value;
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

    this.educationInput = {
      fileMstPk: 1,
      selectedFilesPk: []
    };

    this.workexperiencedrvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    }

    this.idcarddrvInputed = {
      fileMstPk: 18,
      selectedFilesPk: []
    }
    this.ropLicensedrvInputed = {
      fileMstPk: 18,
      selectedFilesPk: []
    }
    this.molEmploymentdrvInputed = {
      fileMstPk: 18,
      selectedFilesPk: []
    }
    this.vendorEmployee = {
      fileMstPk: 18,
      selectedFilesPk: []
    }
    this.ivmsmodel = {
      fileMstPk: 18,
      selectedFilesPk: []
    }
  }

  ngAfterViewInit() {
    this.interRecListDataStaffbas.paginator = this.paginator;
    this.interRecListDataStaffbas.sort = this.sort;
    this.interRecListDataStaffbas.paginator = this.paginatorseven;
    this.interRecListDataStaffbas.sort = this.sorted;
  }

  formvalidated() {
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
      count_ry: ['',''],
      state: ['', Validators.required],
      city: ['', Validators.required],
     
    }),

    this.educationForm = this.formBuilder.group({
      institute_name: ['', Validators.required],
      degree_cert: ['', Validators.required],
      gpa_grade: ['', Validators.required],
      GradeDate: ['', Validators.required],
      edut_level: ['', Validators.required],
      education_files: ['', Validators.required],
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

    this.documentUploadForm = this.formBuilder.group({
      id_card: ['',Validators.required],
      file_ropLicense: ['',Validators.required],
      file_molEmployment: ['',Validators.required],
      file_vendor: ['',Validators.required],
      file_devicemodel: ['',Validators.required],
    })
    
  }

  get staf() { return this.staffForm.controls; } 
  get stafedu(){ return this.educationForm.controls;}
  get work(){ return this.staffworkexperienceForm.controls;}
  
  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.staffForm.value);
  }

  fileeSelectededucate(file, fileId) {
    fileId.selectedFilesPk = file;
    this.educationForm.controls['education_files'].setValue(file[0]);
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
  fileeSelectevendor(file, fileId) {
    fileId.selectedFilesPk = file;
    var length = file.length - 1;
    this.documentUploadForm.controls['file_vendor'].setValue(file[length]);
  }
  fileedevicemodel(file, fileId) {
    fileId.selectedFilesPk = file;
    var length = file.length - 1;
    this.documentUploadForm.controls['file_devicemodel'].setValue(file[length]);
  }

  saveOperContr() {
    if(this.staffForm.valid) {
      if(this.updatedForms != false) {
        this.submitpop = this.i18n("maincenter.opercont")
      } else {
        this.submitpop = this.i18n("maincenter.opercontdeta")
      }
      this.toastr.success(this.submitpop, ''), {
        timeOut: 2000,
        closeButton: false,
      };
      this.formReset();
     } else {
      this.focusInvalidInput(this.staffForm);
     }
  }

  cancelform() {
    if(this.isFormValueChanged) {
      if(this.updatedForms != false) {
        this.cancelpopup = this.i18n("maincenter.doyouwantupdatecour")
      } else {
        this.cancelpopup = this.i18n("maincenter.doyouwantaddcour")
      }
      swal({
        title: this.cancelpopup,
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.cancel.emit();
          this.formReset();
        }
      }); 
    } else {
      this.cancel.emit();
      this.formReset();
    }
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

  formReset() {
    this.staffForm.reset();
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
  
  deleteRow() {
    swal({
      title: this.i18n('maincenter.doyouwantdeleoper'),
      text: ' ',
      icon: "warning",
      buttons: [this.i18n('uploadfile.cancle'), this.i18n('uploadfile.ok')],
      dangerMode: true,
      // className: "swal-delete",
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        setTimeout(() => {
          this.toastr.success(this.i18n('maincenter.operdele'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }, 1000);
      }
    })
  }

  fifthPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }

  showhideeducationform(value) {
    this.educationformshow = value;
    this.staffeduedit = false;
  }

  institute = new FormControl('');
  degree = new FormControl('');
  year_join = new FormControl('');
  year_pass = new FormControl('');
  yearpass = new FormControl('');
  grade = new FormControl('');
  add_On = new FormControl('');
  Last_Date = new FormControl('');

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

  saveStaffedu() {
    if (this.educationForm.valid) {

      this.tblplaceholder = true;
      this.educationForm.value.GradeDate = moment(this.educationForm.value.GradeDate).format('YYYY-MM-DD').toString();
        this.educationformshow = false;
          this.educationForm.controls['institute_name'].reset();
          this.educationForm.controls['degree_cert'].reset();
          this.educationForm.controls['GradeDate'].reset();
          this.educationForm.controls['gpa_grade'].reset();
          this.educationForm.controls['edut_level'].reset();
          this.educationForm.controls['education_files'].reset();
          this.educationInput.selectedFilesPk = [];
          if (this.staffeduedit == true) {
            this.toastr.success(this.i18n('maincenter.educqualupda'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          } else {
            this.toastr.success(this.i18n('maincenter.educqualadde'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
    } else {
      this.focusInvalidInput(this.educationForm);
    }
  }

  cancelstaff() {
    if(this.educationForm.touched) {
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
          setTimeout(() => {
            this.educationForm.reset();
            this.educationInput.selectedFilesPk = [];
          }, 1000);
          this.educationformshow = false;
        }
      });
    } else {
      setTimeout(() => {
        this.educationForm.reset();
        this.educationInput.selectedFilesPk = [];
      }, 1000);
      this.educationformshow = false;
    }
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
        this.educationForm.controls['institute_name'].reset();
        this.educationForm.controls['degree_cert'].reset();
        this.educationForm.controls['GradeDate'].reset();
        this.educationForm.controls['gpa_grade'].reset();
        this.educationForm.controls['edut_level'].reset();
        this.educationForm.controls['education_files'].reset();
        this.educationForm.controls['staffacademics_pk'].reset();
        this.toastr.success(this.i18n('maincenter.educqual'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });
  }

  editStaffedu(element) {
    this.staffeduedit = true;
    this.educationformshow = true;
    this.educationInput.selectedFilesPk = [element.sacd_certupload];
    this.educationForm.patchValue({
      institute_name: element.sacd_institutename,
      degree_cert: element.sacd_degorcert,
      year_join: element.sacd_startdate,
      year_pass: element.sacd_enddate,
      gpa_grade: element.sacd_grade,
      edut_level: element.sacd_edulevel,
      institue_country: element.sacd_opalcountrymst_fk,
      inst_city: element.sacd_opalcitymst_fk,
      inst_state: element.sacd_opalstatemst_fk,
      education_files: element.memcompfiledtls_pk,
      staffacademics_pk: element.staffacademics_pk,
      GradeDate: element.gradedate
    });
  }

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

  sixthPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  
  cancelworkstaff() {
    if(this.staffworkexperienceForm.touched) {
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
          this.staffworkedit = false;
          this.workexpformshow = false;
        }
      });
    } else {
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
      this.staffworkedit = false;
      this.workexpformshow = false;
    }
  
  }

  showhideworkexpform(value) {
    this.workexpformshow = value;
    this.selectedDate = null;
    this.cleardate = false;
    this.isCheckboxDisabled = false;
    this.notallowed = false;
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
      this.tblplaceholder = true;
      this.staffworkexperienceForm.value.date_join = moment(this.staffworkexperienceForm.value.date_join).format('YYYY-MM-DD').toString();
      this.staffworkexperienceForm.value.workdate = moment(this.staffworkexperienceForm.value.workdate).format('YYYY-MM-DD').toString();
          this.loaderformwork = false;
          this.workexpformshow = false;
          this.selectedDate = null;
          this.workexperiencedrvInputed.selectedFilesPk = [];
          if (this.staffworkedit) {
            this.toastr.success(this.i18n('maincenter.workupdate'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
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
        this.tblplaceholder = false;
        this.staffworkedit = false;
           
    } else {
      this.focusInvalidInput(this.staffworkexperienceForm);
    }
  }

  oranisation = new FormControl('');
  date_joined = new FormControl('');
  work_till = new FormControl('');
  designation = new FormControl('');
  count_ryfil = new FormControl('');
  wila_filt = new FormControl ('')
  gover_filt = new FormControl('')
  add_edOn = new FormControl('');
  date_last = new FormControl('');

  clearFilterework() {
    this.oranisation.setValue("");
    this.date_joined.reset();
    this.work_till.reset();
    this.designation.setValue("");
    this.count_ryfil.reset();
    this.gover_filt.reset();
    this.wila_filt.reset();
    $(".clear").trigger("click");
  }
}
