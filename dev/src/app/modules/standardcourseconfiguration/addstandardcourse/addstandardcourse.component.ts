import { Component, ElementRef, OnInit, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { Router, ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { StandardCourseConfigurationService } from '@app/services/standard-course-configuration.services';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

@Component({
  selector: 'app-addstandardcourse',
  templateUrl: './addstandardcourse.component.html',
  styleUrls: ['./addstandardcourse.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class AddstandardcourseComponent implements OnInit {

  standardcourseform : FormGroup;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir: string = 'ltr';
  get form()  { return this.standardcourseform.controls; }
  assessmentinlist = [];
  requestforlist = [];
  courselevellist = [];
  coursecategorylist = [];
  i18n(key) {
    return this.translate.instant(key);
  }
  pagetype = '';
  disableSubmitButton = false;
  id;
  courselevel_search = '';
  coursecategory_search = '';
  stktype;
  isfocalpoint;
  useraccess;
  createaccess = false;
  viewacess = false;
  updateaccess = false;
  feelist;

  main_cfi;
  main_cfr;
  main_sefi;
  main_srefi;
  main_sefu;
  main_srefu;
  branch_cfi;
  branch_cfr;
  branch_sefi;
  branch_srefi;
  branch_sefu;
  branch_srefu;
  isroyal = "2";
  royal;

  constructor(
    private translate: TranslateService, 
    private remoteService: RemoteService,
    private cookieService: CookieService,
    public fb: FormBuilder, 
    private router: Router,
    private security:Encrypt,
    private toastr: ToastrService,private localstorage:AppLocalStorageServices,
    private route: ActivatedRoute,
    private services: StandardCourseConfigurationService,
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

    if(this.isfocalpoint == 1 && this.stktype == 1){
      this.createaccess = true;
      this.viewacess = true;
      this.updateaccess = true;
    };
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Configuration');
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].create == 'Y'){
      this.createaccess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].read == 'Y'){
      this.viewacess = true;
    }
    if(this.isfocalpoint != 1 && this.stktype == 1 && this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].update == 'Y'){
      this.updateaccess = true;
    }
    this.getinitialdata();
    this.pagetype = this.route.snapshot.paramMap.get('type');
    console.log('this.pagetype', this.pagetype);
    this.standardcourseform = this.fb.group({
      title_en: ['', Validators.required],
      title_ar: ['', Validators.required],
      assessmentin: ["", Validators.required],
      requestfor: ["", Validators.required],
      courselevel: ["", Validators.required],
      coursecategory: ["", Validators.required],
      interreg:["", Validators.required],
      main_cfi:["", Validators.required],
      main_cfr:["", Validators.required],
      main_sefi:["", Validators.required],
      main_srefi:["", Validators.required],
      main_sefu:["", Validators.required],
      main_srefu:["", Validators.required],
      branch_cfi:["", Validators.required],
      branch_cfr:["", Validators.required],
      branch_sefi:["", Validators.required],
      branch_srefi:["", Validators.required],
      branch_sefu:["", Validators.required],
      branch_srefu:["", Validators.required],
      isroyal:["", Validators.required],
      royal:[""],
      samefee:[false]
    });
    if(this.pagetype == 'add'){
      
      
    }
    if(this.pagetype == 'edit'){
      this.id = this.route.snapshot.paramMap.get('id');
      this.getcourse(this.id);
    }

   
  }

  isroyalty(value){
    if(value == 1){
      this.standardcourseform.controls['royal'].setValidators([Validators.required, Validators.min(1)]);
      this.standardcourseform.controls['royal'].updateValueAndValidity();
      
    }else{
      this.standardcourseform.controls['royal'].setValidators(null);
      this.standardcourseform.controls['royal'].setValue(null);
     
    }
  }

  issamefee(value){
      if(value){
        this.standardcourseform.controls['branch_cfi'].setValue(this.standardcourseform.controls['main_cfi'].value);
        this.standardcourseform.controls['branch_cfr'].setValue(this.standardcourseform.controls['main_cfr'].value);
        this.standardcourseform.controls['branch_sefi'].setValue(this.standardcourseform.controls['main_sefi'].value);
        this.standardcourseform.controls['branch_srefi'].setValue(this.standardcourseform.controls['main_srefi'].value);
        this.standardcourseform.controls['branch_sefu'].setValue(this.standardcourseform.controls['main_sefu'].value);
        this.standardcourseform.controls['branch_srefu'].setValue(this.standardcourseform.controls['main_srefu'].value);
      }else{
        this.standardcourseform.controls['branch_cfi'].reset();
        this.standardcourseform.controls['branch_cfr'].reset();
        this.standardcourseform.controls['branch_sefi'].reset();
        this.standardcourseform.controls['branch_srefi'].reset();
        this.standardcourseform.controls['branch_sefu'].reset();
        this.standardcourseform.controls['branch_srefu'].reset();
      }
  }

  getinitialdata(){
    this.services.getcourserelateddata().subscribe(res=>{
      console.log(res);
      let data = res.data.data;
      this.assessmentinlist = data.assessmentin;
      this.requestforlist = data.requestfor;
      this.courselevellist = data.courseLevel;
      this.coursecategorylist = data.coursecategory;
    })
  }

  getcourse(id){
    this.disableSubmitButton = true;
    this.services.getCourse(id).subscribe(res=>{
      console.log('course', res);
      let data = res.data.data.course;
      this.feelist = res.data.data.fee;
      let requestforarray = data.scm_requestfor.split(",");
      let samefee = false;
      let fee_main_cfi = this.feelist.filter((item)=>(item.fsm_feestype == 1 && item.fsm_applicationtype == 1))
      if(fee_main_cfi.length > 1){
        let main_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 1);
        let branch_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 2);
        this.main_cfi = Math.floor(main_cfi_ar[0]?.fsm_fee);
        this.branch_cfi = Math.floor(branch_cfi_ar[0]?.fsm_fee);
      }else if(fee_main_cfi.length == 1){
        samefee = true;
        let main_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 3);
        this.main_cfi = Math.floor(main_cfi_ar[0]?.fsm_fee);
        this.branch_cfi = Math.floor(main_cfi_ar[0]?.fsm_fee);
      }

      let fee_main_cfr = this.feelist.filter((item)=>(item.fsm_feestype == 1 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2) ))
      if(fee_main_cfr.length > 1){
        let main_cfr_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 1);
        let branch_cfr_ar = fee_main_cfr.filter((item)=>item.fsm_officetype == 2);
        this.main_cfr = Math.floor(main_cfr_ar[0]?.fsm_fee);
        this.branch_cfr = Math.floor(branch_cfr_ar[0]?.fsm_fee);
      }else if(fee_main_cfr.length == 1){
        let main_cfr_ar = fee_main_cfr.filter((item)=>item.fsm_officetype == 3);
        this.main_cfr = Math.floor(main_cfr_ar[0]?.fsm_fee);
        this.branch_cfr = Math.floor(main_cfr_ar[0]?.fsm_fee);
      }

      let fee_main_sefi = this.feelist.filter((item)=>(item.fsm_feestype == 2 && item.fsm_applicationtype == 1))
      
      if(fee_main_sefi.length > 1){
        let main_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 1);
        let branch_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 2);
        this.main_sefi = Math.floor(main_sefi_ar[0]?.fsm_fee);
        this.branch_sefi = Math.floor(branch_sefi_ar[0]?.fsm_fee);
      }else if(fee_main_sefi.length == 1){
        let main_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 3);
        this.main_sefi = Math.floor(main_sefi_ar[0]?.fsm_fee);
        this.branch_sefi = Math.floor(main_sefi_ar[0]?.fsm_fee);
      }

      let fee_main_sefu = this.feelist.filter((item)=>(item.fsm_feestype == 2 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2)))
      if(fee_main_sefi.length > 1){
        let main_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 1);
        let branch_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 2);
        this.main_sefu = Math.floor(main_sefu_ar[0]?.fsm_fee);
        this.branch_sefu = Math.floor(branch_sefu_ar[0]?.fsm_fee);
      }else if(fee_main_sefi.length == 1){
        let main_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 3);
        this.main_sefu = Math.floor(main_sefu_ar[0]?.fsm_fee);
        this.branch_sefu = Math.floor(main_sefu_ar[0]?.fsm_fee);
      }

      let fee_main_srefi = this.feelist.filter((item)=>(item.fsm_feestype == 6 && item.fsm_applicationtype == 1))
      if(fee_main_srefi.length > 1){
        let main_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 1);
        let branch_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 2);
        this.main_srefi = Math.floor(main_srefi_ar[0]?.fsm_fee);
        this.branch_srefi = Math.floor(branch_srefi_ar[0]?.fsm_fee);
      }else if(fee_main_srefi.length == 1){
        let main_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 3);
        this.main_srefi = Math.floor(main_srefi_ar[0]?.fsm_fee);
        this.branch_srefi = Math.floor(main_srefi_ar[0]?.fsm_fee);
      }

      let fee_main_srefu = this.feelist.filter((item)=>(item.fsm_feestype == 6 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2)))
      if(fee_main_srefu.length > 1){
        let main_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 1);
        let branch_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 2);
        this.main_srefu = Math.floor(main_srefu_ar[0]?.fsm_fee);
        this.branch_srefu = Math.floor(branch_srefu_ar[0]?.fsm_fee);
      }else if(fee_main_srefu.length == 1){
        let main_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 3);
        this.main_srefu = Math.floor(main_srefu_ar[0]?.fsm_fee);
        this.branch_srefu = Math.floor(main_srefu_ar[0]?.fsm_fee);
      }

      let royal = this.feelist.filter((item)=>(item.fsm_feestype == 3))
      if(royal.length >= 1){
        this.isroyal = "1";
        this.royal = Math.floor(royal[0]?.fsm_fee);
      }

      this.standardcourseform = this.fb.group({
        title_en: [data.title, Validators.required],
        title_ar: [data.title_ar, Validators.required],
        assessmentin: [data.scm_assessmentin, Validators.required],
        requestfor: [requestforarray, Validators.required],
        courselevel: [data.scm_courselevel, Validators.required],
        coursecategory: [data.scm_coursecategorymst_fk, Validators.required],
        interreg:[data.scm_isintlreorgreq, Validators.required],
        main_cfi:[this.main_cfi, [Validators.required, Validators.min(0)]],
        main_cfr:[this.main_cfr, [Validators.required, Validators.min(0)]],
        main_sefi:[this.main_sefi, [Validators.required, Validators.min(0)]],
        main_srefi:[this.main_srefi, [Validators.required, Validators.min(0)]],
        main_sefu:[this.main_sefu, [Validators.required, Validators.min(0)]],
        main_srefu:[this.main_srefu, [Validators.required, Validators.min(0)]],
        branch_cfi:[this.branch_cfi, [Validators.required, Validators.min(0)]],
        branch_cfr:[this.branch_cfr, [Validators.required, Validators.min(0)]],
        branch_sefi:[this.branch_sefi, [Validators.required, Validators.min(0)]],
        branch_srefi:[this.branch_srefi, [Validators.required, Validators.min(0)]],
        branch_sefu:[this.branch_sefu, [Validators.required, Validators.min(0)]],
        branch_srefu:[this.branch_srefu, [Validators.required, Validators.min(0)]],
        isroyal:[this.isroyal, Validators.required],
        royal:[this.royal, Validators.min(1)],
        samefee:[samefee]
      });
      this.disableSubmitButton = false;
    })
  }

  submit(data){
    this.disableSubmitButton = true;
    console.log('data',data);
    if(this.pagetype == 'add'){
      this.services.saveCourse(data).subscribe(res=>{
        let data = res.data.data;
        console.log(data);
        this.disableSubmitButton = false;
        this.toastr.success(this.i18n('Course added Successfully'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        swal({
          title: this.i18n('Do you want to configure the criteria for the Sub-Category?'),
          // text: 'You can still recover the file from the JSRS drive.',
          icon: "warning",
          buttons: [this.i18n('Cancel'), this.i18n('OK')],
          dangerMode: true,
          // className: "swal-delete",
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false,
          closeOnEsc: false
        }).then((willGoBack) => {
          if(willGoBack){
            this.router.navigate(['/standardcourseconfiguration/subcategory/add/1/'+data.standardcoursemst_pk]);
          }else{
            this.router.navigate(['/standardcourseconfiguration/sccgridlist']);
          }
        });
      },error=>{
        this.disableSubmitButton = false;
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
    }else{
      let feechange = false;
      if(this.main_cfi != data.main_cfi || this.main_cfr != data.main_cfr || this.main_sefi != data.main_sefi || this.main_srefi != data.main_srefi || this.main_sefu != data.main_sefu || this.main_srefu != data.main_srefu || this.branch_cfi != data.branch_cfi || this.branch_cfr != data.branch_cfr || this.branch_sefi != data.branch_sefi || this.branch_srefi != data.branch_srefi || this.branch_sefu != data.branch_sefu || this.branch_srefu != data.branch_srefu || this.isroyal != data.isroyal || this.royal != data.royal ){
        feechange = true;
      }
      console.log('feechange',feechange);
      data.id = this.id;
      data.feechange = feechange;
      this.services.editCourse(data).subscribe(res=>{
        this.disableSubmitButton = false;
        this.toastr.success(this.i18n('Course updated Successfully'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.router.navigate(['/standardcourseconfiguration/sccgridlist']);
      },error=>{
        this.disableSubmitButton = false;
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
    this.router.navigate(['/standardcourseconfiguration/sccgridlist']);
  }

}
