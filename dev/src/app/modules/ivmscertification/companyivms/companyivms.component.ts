import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { Filee } from '@app/@shared/filee/filee';
import { ToastrService } from 'ngx-toastr';
import { DriveInput } from '@app/common/classes/driveInput';
import { FormBuilder, FormGroup,Validators } from '@angular/forms';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS } from '@angular/material/core';
import { MatTabGroup } from '@angular/material/tabs';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { APP_DATE_FORMATS, AppDateAdapter } from '@app/@shared/format-datepicker';
import { IvmsService } from '../ivms.service';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';

export interface stateList {
  opalstatemst_pk: string;
  osm_statename_en: string;
}

export interface cityList {
  opalcitymst_pk: string;
  ocim_cityname_en: string;
}
@Component({
  selector: 'app-companyivms',
  templateUrl: './companyivms.component.html',
  styleUrls: ['./companyivms.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class CompanyivmsComponent implements OnInit {

  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @Output() senddatacomp = new EventEmitter<any>();
  @Output() sendapplicationdata = new EventEmitter<any>(); @Input('viewForm') viewForm: boolean = false;  public validation: any;
  public validationby: any;
  public commentVlaues: any;
  public updated: boolean = true;
  public drv_logo: DriveInput;
  public comanydetialsform: FormGroup;
  
  public commentBox: boolean = false;
  public centreName: boolean = false;
  public centreNameAr: boolean = false;
  public trainingProviderName: boolean = false;
  public trainingProviderNameAr: boolean = false;
  public notRequired: boolean = true;
  public searchinst_state: any = '';
  public searchCity: any = '';
  public searchmoh: any = '';
  public editOption: boolean = true;
  public crinfo: boolean = true;
  public crverified: boolean = false;
  public opalverified: boolean = false;
  public opalmemberinfo: boolean = false;
  public cractivitydrvInputed: DriveInput;
  public companydtls: any;
  public formedit: boolean;
  public updatedForms: boolean;
  public cancelpopup: string;
  public submitpop: string;
  public previousFormValue: any=[];
  @ViewChild('logo') logo: Filee;
  @ViewChild('cractivity') cractivity: Filee;
  governoratelist: stateList[] = [
    { opalstatemst_pk: '1', osm_statename_en: 'One' },
    { opalstatemst_pk: '2', osm_statename_en: 'two' },
  ];

  wilayatlist: cityList[] = [
    { opalcitymst_pk: '1', ocim_cityname_en: 'One' },
    { opalcitymst_pk: '2', ocim_cityname_en: 'two' },
  ];

  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  today = new Date();

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

  spinnerButtonverified: MatProgressButtonOptions = {
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

  spinnerButtoncr: MatProgressButtonOptions = {
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
  apppk: any;

  constructor(private translate: TranslateService, public toastr: ToastrService,private security: Encrypt,
    private remoteService: RemoteService,private formBuilder: FormBuilder, private el:ElementRef,
    private cookieService: CookieService,public routeid: ActivatedRoute, private route: Router,public ivmsservice:IvmsService,private profileService: ProfileService,
    ) { 

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
    this.getGoverenoratelist();
    this.ivmsservice.getmaincertificaterecored().subscribe(res => {
       
      this.apppk = res.data.data1.applicationdtlstmp_pk;
     this.sendapplicationdata.emit(this.apppk)
        this.getcompanydtls();
    })
   
    this.comanydetialsform = this.formBuilder.group({
      opal_memb_no: ['', ''],
      opal_memb_expiry: ['', null],
      comp_cr_no: ['', ''],
      comp_cr_expiry: [''],
      company_name_en: ['', ''],
      company_name_ar: ['', ''],
      cn_name_en: ['', ''],
      cn_name_ar: ['', ''],
      branch_name_en: ['', ''],
      branch_name_ar: ['', ''],
      file_cractivity: ['', Validators.required],
      governorate: ['', Validators.required],
      wilayat: ['', Validators.required],
      address1: ['', Validators.required],
      address2: ['', ''],
      gm_name: ['', Validators.required],
      gm_emailid: ['', [Validators.required, Validators.pattern('^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$')]],
      gm_mobnum: ['', Validators.required],
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
    });

    
    this.drv_logo = {
      fileMstPk: 8,
      selectedFilesPk: []
    };

    this.cractivitydrvInputed = {
      fileMstPk: 9,
      selectedFilesPk: []
    };

    this.previousFormValue = this.comanydetialsform.value;
  }

  get form() {return this.comanydetialsform.controls; }

  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.comanydetialsform.value);
  }
  getGoverenoratelist() {
    this.profileService.getstatebyid(31).subscribe(data => {
      this.governoratelist = data.data;

    });
  }
    selectedGovernorate(value) {
    if (this.governoratelist) {
      this.governoratelist.forEach(y => {
        if (y.opalstatemst_pk == value) {
          this.comanydetialsform.controls['governorate'].setValue(value);
          this.getwilayatbyid(31, value);
        }
      });
    }
  }
  getwilayatbyid(country, state) {
    this.profileService.getcity(country, state).subscribe(data => {
      this.wilayatlist = data.data;
    });
  }
  getcompanydtls(){
    this.ivmsservice.getcompanydetails(this.apppk).subscribe(res => {

      this.companydtls = res.data;

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
      this.comanydetialsform.patchValue({

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

      this.comanydetialsform.patchValue({
        focalpoint_name: this.companydtls.name,
        focalpoint_desig: this.companydtls.desig,
        focalpoint_emailid: this.companydtls.emailid,
        focalpoint_mobno: this.companydtls.mob_no,
      });
        
      this.selectedGovernorate(Number(this.companydtls.omrm_opalstatemst_fk));

    })
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }

  fileeSelectedcractivity(file, fileId) {
    fileId.selectedFilesPk = file;
  }

  deleteLogo(event: any) {
    swal({
      title: this.i18n('uploadfile.doyouimage'),
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
        this.drv_logo.selectedFilesPk = [];
        setTimeout(() => {
          this.toastr.success(this.i18n('maincenter.imgdele'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }, 1000);
      }
    })
  }

  companyDetails() {
       if(this.comanydetialsform.valid) {
        this.senddatacomp.emit(this.comanydetialsform.value);
        this.editOption = true;
        this.ivmsservice.saveivmscompaydtls(this.apppk,this.comanydetialsform.value,'applicationtype').subscribe(res => {


        });

        if(this.updatedForms != false) {
          this.submitpop = this.i18n("Company Details added Successfully.")
        } else {
          this.submitpop = this.i18n("Company Details updated Successfully.")
        }
        this.toastr.success(this.submitpop, ''), {
          timeOut: 2000,
          closeButton: false,
        };
       } else {
        this.focusInvalidInput(this.comanydetialsform);
       }
  }

  verifybtn(type: any) {
    if(type == 'crNumber') {
        this.crverified = true;
    } else {
      this.opalverified = true;
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

  cancelform() {
    if(this.isFormValueChanged) {
      if(this.updatedForms != false) {
        this.cancelpopup = this.i18n("Do you want to cancel update this Company's Details?")
      } else {
        this.cancelpopup = this.i18n("Do you want to cancel adding this Company's Details?")
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
        }
      }); 
    } else {
      this.cancel.emit();
    }
  }

  editfocal(type) {
    if(type == true) {
        this.editOption = false;
    } else {
      this.route.navigate(['/accountsettings/home'],{ queryParams: { id: this.security.encrypt(3)} });
      localStorage.setItem('projectPk', 'IVMS');
    }
  }

  addForm() {
    this.viewForm = false;
    this.updated = true;
    this.centreName = true;
    this.editOption = true;
    this.centreNameAr = false;
    this.updatedForms = false;
    this.formedit = false;
  }

  editForm(data: any,type) {
    this.companydtls = data;
    if(type == 'Edit') {
      this.formedit = false;
      this.viewForm = false;
      this.updated = true;
      this.centreName = true;
      this.editOption = true;
      this.centreNameAr = false;
      this.updatedForms = true;
    } else {
      this.formedit = true;
      this.viewForm = true;
      this.updated = true;
      this.centreName = true;
      this.editOption = true;
      this.centreNameAr = true;
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
      focalpoint_name: this.companydtls.name,
      focalpoint_desig: this.companydtls.desig,
      focalpoint_emailid: this.companydtls.emailid,
      focalpoint_mobno: this.companydtls.mob_no,
     });
  }
}
