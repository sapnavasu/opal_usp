import { Component, ElementRef, OnInit, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { Router, ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MasterDataConfigurationService } from '@app/services/master-data-configuration.services';
@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class EditComponent implements OnInit {

  requestfor : FormGroup;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir: string = 'ltr';
  get form()  { return this.requestfor.controls; }
  i18n(key) {
    return this.translate.instant(key);
  }
  pagetype = '';
  disableSubmitButton = false;
  id;
  stktype;
  isfocalpoint;
  useraccess;
  createaccess = false;
  viewacess = false;
  updateaccess = false;

  mastertype = 13;

  constructor(
    private translate: TranslateService, 
      private remoteService: RemoteService,
      private cookieService: CookieService,
      public fb: FormBuilder, 
      private router: Router,
      private security:Encrypt,
      private toastr: ToastrService,
      private localstorage:AppLocalStorageServices,
      private route: ActivatedRoute,
      private service: MasterDataConfigurationService,
      private el: ElementRef,
  ) {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
   }

  ngOnInit(): void {

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    this.id = this.route.snapshot.paramMap.get('id');
    this.getrefer(this.id);
  }


  getrefer(id){
    this.disableSubmitButton = true;
    this.service.getreference(id).subscribe(res=>{
      let data = res.data;
      this.requestfor = this.fb.group({
        name_en: [data.rm_name_en, Validators.required],
        name_ar: [data.rm_name_ar, Validators.required]
      });
      this.disableSubmitButton = false;
    })
  }


  submit(data){
    data.mastertype = this.mastertype
    data.id = this.id;
    this.service.editreference(data).subscribe(res=>{
      this.toastr.success(this.i18n('Request For updated Successfully'), ''), {
        timeOut: 2000,
        closeButton: false,
      };
      this.router.navigate(['/configuration/masterdataconfiguration/requestfor']);
    },error=>{
      swal({
        title: error.statusText,
        text: '',
        icon: 'warning',
        buttons: [false, 'Ok'],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      })
    });
  }

  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
       
        console.log(key);
        if (invalidControl)
        {
          invalidControl.focus();
        }
        break;
      }
    }
  }

  cancel(){
    this.router.navigate(['/configuration/masterdataconfiguration/requestfor']);
  }

}


