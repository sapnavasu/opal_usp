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
  selector: 'app-add',
  templateUrl: './add.component.html',
  styleUrls: ['./add.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class AddComponent implements OnInit {

  Vehiclesubcategory : FormGroup;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir: string = 'ltr';
  get form()  { return this.Vehiclesubcategory.controls; }
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

    // this.getinitialdata();
    console.log('this.pagetype', this.pagetype);
    this.Vehiclesubcategory = this.fb.group({
      Vehicle: ['', Validators.required],
      code: ['', Validators.required],
      subcategoty_en: ['', Validators.required],
      subcategoty_ar: ["", Validators.required]
    });

   
  }

  // getinitialdata(){
  //   this.services.getVehiclerelateddata().subscribe(res=>{
  //     console.log(res);
  //     let data = res.data.data;
  //     this.assessmentinlist = data.assessmentin;
  //     this.requestforlist = data.requestfor;
  //     this.Vehiclelevellist = data.VehicleLevel;
  //     this.Vehiclecategorylist = data.Vehiclecategory;
  //   })
  // }

  // getVehicle(id){
  //   this.disableSubmitButton = true;
  //   this.services.getCourse(id).subscribe(res=>{
  //     console.log('Vehicle', res);
  //     let data = res.data.data;
  //     console.log(data.scm_requestfor)
  //     let requestforarray = data.scm_requestfor.split(",");
  //     console.log(requestforarray);
  //     this.feesubscribedit = this.fb.group({
  //       title_en: [data.title, Validators.required],
  //       title_ar: [data.title_ar, Validators.required],
  //       assessmentin: [data.scm_assessmentin, Validators.required],
  //       requestfor: [requestforarray, Validators.required],
  //       Vehiclelevel: [data.scm_Vehiclelevel, Validators.required],
  //       Vehiclecategory: [data.scm_Vehiclecategorymst_fk, Validators.required],
  //       interreg:[data.scm_isintlreorgreq, Validators.required]
  //     });
  //     this.disableSubmitButton = false;
  //   })
  // }

  submit(data){
  //   if(this.pagetype == 'add'){
  //     this.services.saveCourse(data).subscribe(res=>{
  //       let data = res.data.data;
  //       console.log(data);
  //       this.toastr.success(this.i18n('Course added Successfully'), ''), {
  //         timeOut: 2000,
  //         closeButton: false,
  //       };
  //       swal({
  //         title: this.i18n('Do you want to configure the criteria for the Sub-Category?'),
  //         // text: 'You can still recover the file from the JSRS drive.',
  //         icon: "warning",
  //         buttons: [this.i18n('Cancel'), this.i18n('OK')],
  //         dangerMode: true,
  //         // className: "swal-delete",
  //         className: this.dir =='ltr'?'swalEng':'swalAr',
  //         closeOnClickOutside: false,
  //         closeOnEsc: false
  //       }).then((willGoBack) => {
  //         if(willGoBack){
  //           this.router.navigate(['/standardVehicleconfiguration/subcategory/add/1/'+data.standardVehiclemst_pk]);
  //         }else{
  //           this.router.navigate(['/standardVehicleconfiguration/sccgridlist']);
  //         }
  //       });
  //     },error=>{
  //       swal({
  //         title: error.statusText,
  //         text: '',
  //         icon: 'warning',
  //         buttons: [false, 'Ok'],
  //         dangerMode: true,
  //         className: this.dir =='ltr'?'swalEng':'swalAr',
  //         closeOnClickOutside: false
  //       })
  //     });
  //   }else{
  //     data.id = this.id;
  //     this.services.editCourse(data).subscribe(res=>{
  //       this.toastr.success(this.i18n('Course updated Successfully'), ''), {
  //         timeOut: 2000,
  //         closeButton: false,
  //       };
  //       this.router.navigate(['/standardVehicleconfiguration/sccgridlist']);
  //     },error=>{
  //       swal({
  //         title: error.statusText,
  //         text: '',
  //         icon: 'warning',
  //         buttons: [false, 'Ok'],
  //         dangerMode: true,
  //         className: this.dir =='ltr'?'swalEng':'swalAr',
  //         closeOnClickOutside: false
  //       })
  //     });
  //   }
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
    this.router.navigate(['/configuration/masterdataconfiguration/vehiclesubcategories']);
  }

}

