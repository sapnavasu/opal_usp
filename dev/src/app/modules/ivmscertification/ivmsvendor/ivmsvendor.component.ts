import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
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
  selector: 'app-ivmsvendor',
  templateUrl: './ivmsvendor.component.html',
  styleUrls: ['./ivmsvendor.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class IvmsvendorComponent implements OnInit {

  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @Output() sendInformation = new EventEmitter<any>();
@Input('viewForm') viewForm: boolean = false; 
 public instituteform: FormGroup;
 @Input('appdata') appdata: any;  

  public commentBox: boolean = false;
  public responseInfor: any;
  public updatedForms: boolean;
  public cancelpopup: string;
  public submitpop: string;
  public searchinst_state: any;
  public search_City: any;
  public previousFormValue: any=[];
  
  matcher: ErrorStateMatcher = new ErrorStateMatcher();

  governoratelist: stateList[]
   = [
    { opalstatemst_pk: '1', osm_statename_en: 'One' },
    { opalstatemst_pk: '2', osm_statename_en: 'two' },
  ];

  wilayatlist: cityList[] = [
    { opalcitymst_pk: '1', ocim_cityname_en: 'One' },
    { opalcitymst_pk: '2', ocim_cityname_en: 'two' },
  ];
  apppk: any;
  instituedata: any;

  constructor(private translate: TranslateService, public toastr: ToastrService,private security: Encrypt,
    private remoteService: RemoteService,private formBuilder: FormBuilder, private el:ElementRef,
    private cookieService: CookieService,public routeid: ActivatedRoute, private route: Router,public ivmsservice:IvmsService,private profileService: ProfileService,) { }

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
    this.apppk = this.appdata;
    this.getivmsinstituedata();
    this.instituteform = this.formBuilder.group({
      offtype: ['', Validators.required],
      brancheng: ['', ''],
      brancharab: ['', ''],
      exp_a: ['', Validators.required],
      oma_n: ['', Validators.required],
      tot_oman: [''],
      oman_percen: [''],
      site_main: [''],
      inst_address1: ['', Validators.required],
      inst_address2: ['', ''],
      instgovernorate: ['',Validators.required],
      wila_yat: ['',Validators.required]
    })
    this.previousFormValue = this.instituteform.value;

    

  }

  get inst() {return this.instituteform.controls; }

  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.instituteform.value);
  }
  getGoverenoratelist() {
    this.profileService.getstatebyid(31).subscribe(data => {
      this.governoratelist = data.data;

    });
  }
  selectedGovernorate(value) {
    alert(value)
    if (this.governoratelist) {
      console.log('qqqqq')
      this.governoratelist.forEach(y => {
        if (y.opalstatemst_pk == value) {
          this.instituteform.controls['instgovernorate'].setValue(value);
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
  
  getivmsinstituedata(){
    this.ivmsservice.getivmsinstituedata(this.apppk).subscribe(res => {

        this.instituedata = res.data.res;

      this.instituteform.patchValue({
        exp_a: this.instituedata.appiit_noofexpat,
        oma_n: this.instituedata.appiit_noofomani,
        molpercent: this.instituedata.appiit_molpercent,
        site_main: this.instituedata.appiit_locmapurl,
        no_techstaff: this.instituedata.appiit_nooftechstaff,
        curr_learn: this.instituedata.appiit_noofcurlearners,
        trainprovmax: this.instituedata.appiit_maxcapacity,
        appinstinfotmp_pk: this.instituedata.appinstinfotmp_pk,
        brancheng: this.instituedata.appiit_branchname_en,
        brancharab: this.instituedata.appiit_branchname_ar,
        inst_address1: this.instituedata.appiit_addrline1,
        inst_address2: this.instituedata.appiit_addrline2,
        instgovernorate:this.instituedata.appiit_statemst_fk?Number(this.instituedata.appiit_statemst_fk):'',
        wila_yat: this.instituedata.appiit_citymst_fk?Number(this.instituedata.appiit_citymst_fk):'',
       });

       setTimeout(() => {
        this.selectedGovernorate(Number(this.instituedata.appiit_statemst_fk));

       }, 2000);



    });

  }
  saveInsFormDetails() {
       if(this.instituteform.valid) {
        this.sendInformation.emit(this.instituteform.value);
        this.ivmsservice.saveivmsinstitue(this.apppk,this.instituteform.value,'applicationtype').subscribe(res => {


        });
        if(this.updatedForms != false) {
          this.submitpop = this.i18n("IVMS Vendor Information added Successfully.")
        } else {
          this.submitpop = this.i18n("IVMS Vendor Information updated Successfully.")
        }
        this.toastr.success(this.submitpop, ''), {
          timeOut: 2000,
          closeButton: false,
        };
       } else {
        this.focusInvalidInput(this.instituteform);
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
        this.cancelpopup = this.i18n("maincenter.doyouwantupdatecour")
      } else {
        this.cancelpopup = this.i18n("maincenter.maincenter")
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

  addForm() {
    this.viewForm = false;
    this.updatedForms = false;
  }

  editForm(data: any,type) {
    this.responseInfor = data;
    if(type == 'Edit') {
      this.viewForm = false;
      this.updatedForms = true;
    } else {
      this.viewForm = true;
    }
    this.instituteform.patchValue({
      exp_a: this.responseInfor.appiit_noofexpat,
      oma_n: this.responseInfor.appiit_noofomani,
      molpercent: this.responseInfor.appiit_molpercent,
      site_main: this.responseInfor.appiit_locmapurl,
      no_techstaff: this.responseInfor.appiit_nooftechstaff,
      curr_learn: this.responseInfor.appiit_noofcurlearners,
      trainprovmax: this.responseInfor.appiit_maxcapacity,
      appinstinfotmp_pk: this.responseInfor.appinstinfotmp_pk,
      brancheng: this.responseInfor.appiit_branchname_en,
      brancharab: this.responseInfor.appiit_branchname_ar,
      inst_address1: this.responseInfor.appiit_addrline1,
      inst_address2: this.responseInfor.appiit_addrline2,
      instgovernorate:this.responseInfor.appiit_statemst_fk?Number(this.responseInfor.appiit_statemst_fk):'',
      wila_yat: this.responseInfor.appiit_citymst_fk?Number(this.responseInfor.appiit_citymst_fk):'',
     });
  }

  keyAutoCal(val) {
    const exp_aval = this.instituteform.get('exp_a').value;
    const oma_nval = this.instituteform.get('oma_n').value;
    const autocal = this.convertToInt(exp_aval) + this.convertToInt(oma_nval);
    const autocalper = this.convertToInt(oma_nval) / autocal * 100;
    this.instituteform.controls['tot_oman'].setValue(autocal);
    const roundedNum = autocalper.toFixed(2);
    this.instituteform.controls['oman_percen'].setValue(roundedNum + '%');
  }
  convertToInt(val) {
    if (val) {
      return parseInt(val);
    } else {
      return 0;
    }
  }

  officeTypes(Values) {
    if(Values == 1) {
      this.instituteform.controls.branch_name_en.setValidators([Validators.required]);
      this.instituteform.controls.branch_name_ar.setValidators([Validators.required]);
    } else {
      this.instituteform.controls.branch_name_en.clearValidators();
      this.instituteform.controls.branch_name_ar.clearValidators();
    }
     this.instituteform.controls.branch_name_en.updateValueAndValidity();
     this.instituteform.controls.branch_name_ar.updateValueAndValidity();
     this.instituteform.controls.branch_name_en.reset();
     this.instituteform.controls.branch_name_ar.reset();
  }

}
