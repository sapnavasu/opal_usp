import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';
import { FormArray, FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS } from '@angular/material/core';
import { MatTabGroup } from '@angular/material/tabs';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { APP_DATE_FORMATS, AppDateAdapter } from '@app/@shared/format-datepicker';
import { animate, state, style, transition, trigger } from '@angular/animations';
import { event } from 'jquery';
import { DriveInput } from '@app/common/classes/driveInput';

interface Document {
  title: string;
  createdon: string | null;
  updatedon: string | null;
  appdst_status: number;
  appdst_appdeccomment: string;
}

@Component({
  selector: 'app-companydocument',
  templateUrl: './companydocument.component.html',
  styleUrls: ['./companydocument.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ],
  animations: [
    trigger('fadeInOut', [
      state('void', style({ height: '0', opacity: 0 })),
      state('*', style({ height: '*', opacity: 1 })),
      transition(':enter', animate('300ms ease-out')),
      transition(':leave', animate('300ms ease-in')),
    ]),
  ],
})
export class CompanydocumentComponent implements OnInit {

  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @Output() sendInformation = new EventEmitter<any>();
  public documentForm: FormGroup;
  public viewForm: boolean = false;
  public commentBox: boolean = false;
  public responseInfor: any;
  public updatedForms: boolean;
  public cancelpopup: string;
  public submitpop: string;
  public isopen: any = [];
  public fileUpload: any = [];
  public selectedOption: any;
  public selectedOption2: boolean = false;
  public selectedOption1: boolean = true;
  public cractivitydrvInputed: DriveInput;
  documentList: Document[] = [
    {
      title: 'Document',
      createdon: '2023-09-20',
      updatedon: '2023-09-22',
      appdst_status: 4,
      appdst_appdeccomment: 'test'
    },
    {
      title: 'Document',
      createdon: null,
      updatedon: '2023-09-25',
      appdst_status: 3,
      appdst_appdeccomment: 'test'
    },
  ];
  matcher: ErrorStateMatcher = new ErrorStateMatcher();

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

    this.documentForm = this.formBuilder.group({
      documentArray: this.formBuilder.array([])
    })
    this.cractivitydrvInputed = {
      fileMstPk: 9,
      selectedFilesPk: []
    }
    this.buildForm();
  }

  get inst() {return this.documentForm.controls; }

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }

  saveInsFormDetails() {
       if(this.documentForm.valid) {
        this.sendInformation.emit(this.documentForm.value);
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
        this.focusInvalidInput(this.documentForm);
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
    if(this.documentForm.touched) {
      if(this.updatedForms != false) {
        this.cancelpopup = this.i18n("Do you want to cancel update this IVMS Vendor Information")
      } else {
        this.cancelpopup = this.i18n("Do you want to cancel adding this IVMS Vendor Information")
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
    this.documentForm.patchValue({
    });
  }

  toggle(index: number): void {
    this.isopen[index] = !this.isopen[index];
  }

  ChangeValue(event,index) {
   
    if(event.value == '1') {
      this.fileUpload[index] = true;
      this.updateValidation(true)
    } else {
      this.fileUpload[index] = false;
      this.updateValidation(false)
    }
    this.buildForm()
  }

  buildForm() {
    const controlArray = this.documentForm.get('documentArray') as FormArray;
      controlArray.push(
        this.formBuilder.group({
          checkBox:['', ''],
          startDate:['', ''],
          endDate:['', ''],
          file_qa:['', ''],
          remark_fst:['', '']
        })
      )
  }
 
  updateValidation (validator) {
    const Checklistarray = this.documentForm.get('documentArray') as FormArray;
    if(validator) {
      Checklistarray.controls.forEach((formGroup: FormGroup) => {
        formGroup.controls['file_qa'].setValidators([Validators.required]);
        formGroup.controls['remark_fst'].clearValidators();
      })
    } else {
      Checklistarray.controls.forEach((formGroup: FormGroup) => {
        formGroup.controls['remark_fst'].setValidators([Validators.required]);
        formGroup.controls['file_qa'].clearValidators();
      })
    }
    Checklistarray.controls.forEach((formGroup: FormGroup) => {
      formGroup.controls['file_qa'].updateValueAndValidity();
      formGroup.controls['remark_fst'].updateValueAndValidity();
    })
  }
  getChecklistForm(i) {
    const Checklistarray = this.documentForm.get('documentArray') as FormArray;
    const formgroup = Checklistarray.controls[i] as FormGroup;
    return formgroup;
  }
}
