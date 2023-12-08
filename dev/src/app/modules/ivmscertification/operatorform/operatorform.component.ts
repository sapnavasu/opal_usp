import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormGroup,Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS } from '@angular/material/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { APP_DATE_FORMATS, AppDateAdapter } from '@app/@shared/format-datepicker';

export interface ResultOpr {
  rm_name_en: string;
}

@Component({
  selector: 'app-operatorform',
  templateUrl: './operatorform.component.html',
  styleUrls: ['./operatorform.component.scss'],
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class OperatorformComponent implements OnInit {
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @Output() senddatacomp = new EventEmitter<any>();
  @Input('viewForm') viewForm: boolean = false;
  public OperatorContractForm: FormGroup;
  public appdt_status: any
  public searchName: any;
  public updatedForms: boolean;
  public updatedon: any;
  public createdon: any;
  public previousFormValue: any=[];
  public cancelpopup: string;
  public submitpop: string;

  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  today = new Date();

  SearchResultOpr: ResultOpr[] = [
    { rm_name_en: 'hussa'},
    { rm_name_en: 'ibrah'},
    { rm_name_en: 'hafsa'},
    { rm_name_en: 'aisha'},
    { rm_name_en: 'amira'}
  ];

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

    this.OperatorContractForm = this.formBuilder.group({
      operator_name: ['', Validators.required],
      contract_typ: ['', Validators.required],
      cont_end: ['', Validators.required],
      cont_strt: ['', Validators.required],
    });

    this.previousFormValue = this.OperatorContractForm.value;
  }
  get operator() { return this.OperatorContractForm.controls; } 
  
  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.OperatorContractForm.value);
  }

  saveOperContr() {
    if(this.OperatorContractForm.valid) {
      this.senddatacomp.emit(this.OperatorContractForm.value);
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
      this.focusInvalidInput(this.OperatorContractForm);
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
    this.OperatorContractForm.reset();
  }
}
