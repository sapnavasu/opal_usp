import { Component, OnInit, ViewEncapsulation } from '@angular/core';
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
import { GradeConfigurationService } from '@app/services/grade-configuration.service';


@Component({
  selector: 'app-editgradeconfiguration',
  templateUrl: './editgradeconfiguration.component.html',
  styleUrls: ['./editgradeconfiguration.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class EditgradeconfigurationComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  gradeconfiguration : FormGroup;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir: string = 'ltr';
  get form()  { return this.gradeconfiguration.controls; }
  gradeid;
  disableSubmitButton:boolean = false;
  stktype;
  isfocalpoint;
  useraccess;
  viewacess;
  updateaccess;

  constructor(
    private translate: TranslateService, 
      private remoteService: RemoteService,
      private cookieService: CookieService,
      public fb: FormBuilder, 
      public routeid: ActivatedRoute,
      private router: Router,
      private security:Encrypt,
      private toastr: ToastrService,private localstorage:AppLocalStorageServices,
      private route: ActivatedRoute,
    private service: GradeConfigurationService
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

    if(this.isfocalpoint == 1 && this.stktype == 1){
      this.viewacess = true;
      this.updateaccess = true;
    };
    console.log('this.isfocalpoint', this.isfocalpoint);
    console.log('this.stktype', this.stktype);
    console.log('this.useraccess', this.useraccess);
    //let moduleid = this.useraccess.filter(item => item.modules == "Learner Card Log");
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Configuration');
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][35] && this.useraccess[moduleid][35].read == 'Y'){
      this.viewacess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][35] && this.useraccess[moduleid][35].update == 'Y'){
      this.updateaccess = true;
    }

    if (!this.updateaccess) {
      swal({
        title: "You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if (this.stktype == 1) {
            this.router.navigate(['dashboard/portaladmin']);
          }
          else {
            this.router.navigate(['dashboard/centre']);
          }
        }

      });

    }else{

      this.gradeid = this.routeid.snapshot.paramMap.get('id');
      this.gradeconfiguration = this.fb.group({
        grade: ["", Validators.required],
        percentageFromTotalValue: ["", [Validators.required,Validators.max(100),Validators.min(0)]],
        toPercentage: ["", [Validators.required,Validators.min(0),Validators.max(100)]],
        fromPercentage: ["", [Validators.required,Validators.min(0)]],
      });
      this.getgrade(this.gradeid);
    }
    
  }

  percentagevalidation(type){
    let to = this.gradeconfiguration.controls['toPercentage'].value;
    let from = this.gradeconfiguration.controls['fromPercentage'].value;
    if(type == 'from'){
      this.gradeconfiguration.controls['fromPercentage'].setValidators([Validators.required,Validators.max(to),Validators.min(0)]);
      this.gradeconfiguration.controls['toPercentage'].setValue('');
      this.gradeconfiguration.controls['toPercentage'].setValidators([Validators.required,Validators.min(from),Validators.max(100)])
    }else{
      this.gradeconfiguration.controls['toPercentage'].setValidators([Validators.required,Validators.min(from),Validators.max(100)])
    }
  }

  getgrade(id){
    this.disableSubmitButton = true;
    this.service.getgrade(id).subscribe(res=>{
      let data = res.data.data;
      console.log(data);
      this.gradeconfiguration = this.fb.group({
        grade: [data.gm_gradename_en, Validators.required],
        percentageFromTotalValue: [data.gm_scoreinpercent, [Validators.required,Validators.max(100),Validators.min(0)]],
        fromPercentage: [data.gm_scorefrom, [Validators.required,Validators.max(100),Validators.min(0)]],
        toPercentage: [data.gm_scoreto, [Validators.required,Validators.max(100),Validators.min(0)]],
      });
      this.gradeconfiguration.controls['fromPercentage'].setValidators([Validators.required,Validators.max(data.gm_scoreto),Validators.min(0)])
      this.gradeconfiguration.controls['toPercentage'].setValidators([Validators.required,Validators.min(data.gm_scorefrom),Validators.max(100)])
      this.disableSubmitButton = false;
    })
  }

  cancel(){
    this.router.navigate(['/gradeconfiguration/gradelist']);
  }

  submit(data){
    this.disableSubmitButton = true;
    data.id = this.gradeid;
    this.service.savegrade(data).subscribe(res=>{
      this.disableSubmitButton = false;
      this.router.navigate(['/gradeconfiguration/gradelist']);
      this.toastr.success(this.i18n('Grade Configuration updated successfully'), ''), {
        timeOut: 2000,
        closeButton: false,
      };
    });
  }

}
