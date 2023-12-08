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
import { StandardCourseConfigurationService } from '@app/services/standard-course-configuration.services';

@Component({
  selector: 'app-addsubcategory',
  templateUrl: './addsubcategory.component.html',
  styleUrls: ['./addsubcategory.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class AddsubcategoryComponent implements OnInit {

  i18n(key) {
    return this.translate.instant(key);
  }
  subcategoryform : FormGroup;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir: string = 'ltr';
  get form()  { return this.subcategoryform.controls; }
  get markprecFormArr(): FormArray {
    return this.subcategoryform.get('markpercent') as FormArray;
  }
  public aprdec_status: boolean = false;
  getmarkperceFormArr(index): FormGroup {
    const formGroup = this.markprecFormArr.controls[index] as FormGroup;
    return formGroup;
  }
  pagetype;
  smstid ;
  coursedata;
  subcourselist;
  prereqlist = [];
  public ifarbic: boolean = false;
  fullPageLoaders = false;
  subcid;
  isreadonly:boolean = false;
  subcategorydata;
  stktype;
  isfocalpoint;
  useraccess;
  createaccess = false;
  viewacess = false;
  updateaccess = false;
  feedetails;
  public hideviewfee: boolean = true;
  viewname = 'View Fee Subscription';
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
  subfeedetails;
  inti_ltf;
  inti_laf;
  ref_ltf;
  ref_laf

  constructor(
    private translate: TranslateService, 
      private remoteService: RemoteService,
      private cookieService: CookieService,
      public fb: FormBuilder, 
      private router: Router,
      private security:Encrypt,
      private toastr: ToastrService,private localstorage:AppLocalStorageServices,
      private route: ActivatedRoute,
      private services: StandardCourseConfigurationService
  ) {
    
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
   }

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
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }

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

    this.pagetype = this.route.snapshot.paramMap.get('type');
   
    this.subcategoryform = this.fb.group({
      subcourse: ['', Validators.required],
      onjobtraining: ['', Validators.required],
      printfinalpermitcard: ["", Validators.required],
      limitoflearner: ["", Validators.required],
      isthyclass: [""], 
      thyclasslimit: [null],
      ispratclass:[null],
      practclasslimit:[null],
      asmtbatchlimit:[""],
      ispratclassrefresher:[null],
      hasagelimit:["", Validators.required],
      agelimit:[""],
      prerequesit:[null],
      iscertexpiry:["", Validators.required],
      iscertexpirybasedonmarks:[""],
      markpercent:this.fb.array([]),
      certexpiryinmonths:[null],
      isknwlasmt:["", Validators.required],
      minmarkfrknwlasmt:[""],
      totalmarkfrknwlasmt:[""],
      ispratasmt:["", Validators.required],
      ispartasmtmark:[""],
      partasmtminmark:[null],
      partasmttotalmark:[null],
      istutorrole:["", Validators.required],
      tutorlimit:[""],
      isassessorrole:["", Validators.required],
      assessorlimit:[""],
      tutor_assessorlimt:["", Validators.required],
      pmlimit:["", Validators.required],
      inti_ltf:["", Validators.required],
      inti_laf:["", Validators.required],
      ref_ltf:["", Validators.required],
      ref_laf:["", Validators.required],
    });
    if(this.pagetype == 1){
      this.smstid = this.route.snapshot.paramMap.get('id');
      this.getcourse();
      this.getprereqlist();
    }
    console.log('this.pagetype', this.pagetype)
    if(this.pagetype == 2 || this.pagetype == 3){
      this.subcid = this.route.snapshot.paramMap.get('id');
      console.log('this.subcid', this.subcid);
      this.getsubcoursedtls();
    }

    if(this.pagetype == 3){
      this.isreadonly = true;
    }

  }

  createmarkpert(): FormGroup {
    return this.fb.group({
      max:  ['',Validators.required],
      min:  ['',Validators.required],
      expinmonth:  ['',Validators.required]
    });
  }

  addmarkprec(): void {
      this.markprecFormArr.push(
        this.createmarkpert()
        );
  }

  removemarkprec(index) {
    this.markprecFormArr.removeAt(index);
  }

  learnerlimit(value){
    if(value == 1){
      this.subcategoryform.controls['isthyclass'].setValidators([Validators.required]);
      this.subcategoryform.controls['isthyclass'].updateValueAndValidity();
      this.subcategoryform.controls['ispratclass'].setValidators([Validators.required]);
      this.subcategoryform.controls['ispratclass'].updateValueAndValidity();
      this.subcategoryform.controls['asmtbatchlimit'].setValidators([Validators.required]);
      this.subcategoryform.controls['asmtbatchlimit'].updateValueAndValidity();
    }else{
      this.subcategoryform.controls['isthyclass'].setValidators(null);
      this.subcategoryform.controls['isthyclass'].setValue(null);
      this.subcategoryform.controls['ispratclass'].setValidators(null);
      this.subcategoryform.controls['ispratclass'].setValue(null);
      this.subcategoryform.controls['asmtbatchlimit'].setValidators(null);
      this.subcategoryform.controls['asmtbatchlimit'].setValue(null);
    }
  }

  thylimit(value){
    if(value == 1){
      this.subcategoryform.controls['thyclasslimit'].setValidators([Validators.required]);
      this.subcategoryform.controls['thyclasslimit'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['thyclasslimit'].setValidators(null);
      this.subcategoryform.controls['thyclasslimit'].setValue(null);
     
    }
  }

  pralimit(value){
    if(value == 1){
      this.subcategoryform.controls['practclasslimit'].setValidators([Validators.required]);
      this.subcategoryform.controls['practclasslimit'].updateValueAndValidity();
      this.subcategoryform.controls['ispratclassrefresher'].setValidators([Validators.required]);
      this.subcategoryform.controls['ispratclassrefresher'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['practclasslimit'].setValidators(null);
      this.subcategoryform.controls['practclasslimit'].setValue(null);
      this.subcategoryform.controls['ispratclassrefresher'].setValidators(null);
      this.subcategoryform.controls['ispratclassrefresher'].setValue(null);
     
    }
  }

  agelimit(value){
    if(value == 1){
      this.subcategoryform.controls['agelimit'].setValidators([Validators.required]);
      this.subcategoryform.controls['agelimit'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['agelimit'].setValidators(null);
      this.subcategoryform.controls['agelimit'].setValue(null);
     
    }
  }

  isexpiry(value){
    if(value == 1){
      this.subcategoryform.controls['iscertexpirybasedonmarks'].setValidators([Validators.required]);
      this.subcategoryform.controls['iscertexpirybasedonmarks'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['iscertexpirybasedonmarks'].setValidators(null);
      this.subcategoryform.controls['iscertexpirybasedonmarks'].setValue(null);
     
    }
  }

  expirymonth(value){
    if(value == 2){
      this.subcategoryform.controls['certexpiryinmonths'].setValidators([Validators.required]);
      this.subcategoryform.controls['certexpiryinmonths'].updateValueAndValidity();
      console.log(this.subcategoryform.controls['markpercent']['controls'].length);
      
      while (this.subcategoryform.controls['markpercent']['controls'].length !== 0) {
        const control = <FormArray>this.subcategoryform.controls['markpercent'];
        control.removeAt(0)
      }
    }else{
      this.addmarkprec();
      this.subcategoryform.controls['certexpiryinmonths'].setValidators(null);
      this.subcategoryform.controls['certexpiryinmonths'].setValue(null);
     
    }
  }

  validatepercentage(index){

    let max = this.subcategoryform.controls['markpercent']['controls'][index]['controls'].max.value;
    let min = this.subcategoryform.controls['markpercent']['controls'][index]['controls'].min.value;

    if(max == ''){
      this.markprecFormArr.controls[index]['controls'].min.setValidators([Validators.required,Validators.max(100),Validators.min(0)]);
      this.markprecFormArr.controls[index]['controls'].min.updateValueAndValidity();
    }else{
      this.markprecFormArr.controls[index]['controls'].min.setValidators([Validators.required,Validators.max(max),Validators.min(0)]);
      this.markprecFormArr.controls[index]['controls'].min.updateValueAndValidity();
    }
    

    if(min== ''){
      this.markprecFormArr.controls[index]['controls'].max.setValidators([Validators.required,Validators.max(100),Validators.min(0)]);
      this.markprecFormArr.controls[index]['controls'].max.updateValueAndValidity();
    }else if(max > 100){
      this.markprecFormArr.controls[index]['controls'].max.setValidators([Validators.required,Validators.max(100),Validators.min(0)]);
      this.markprecFormArr.controls[index]['controls'].max.updateValueAndValidity();
    }else{
      this.markprecFormArr.controls[index]['controls'].max.setValidators([Validators.required,Validators.max(100),Validators.min(min)]);
      this.markprecFormArr.controls[index]['controls'].max.updateValueAndValidity();
    }
    
    
  }

  knwassem(value){
    if(value == 1){
      this.subcategoryform.controls['minmarkfrknwlasmt'].setValidators([Validators.required]);
      this.subcategoryform.controls['minmarkfrknwlasmt'].updateValueAndValidity();
      this.subcategoryform.controls['totalmarkfrknwlasmt'].setValidators([Validators.required]);
      this.subcategoryform.controls['totalmarkfrknwlasmt'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['minmarkfrknwlasmt'].setValidators(null);
      this.subcategoryform.controls['minmarkfrknwlasmt'].setValue(null);
      this.subcategoryform.controls['totalmarkfrknwlasmt'].setValidators(null);
      this.subcategoryform.controls['totalmarkfrknwlasmt'].setValue(null);
     
    }
  }

  pratasmt(value){
    if(value == 1){
      this.subcategoryform.controls['ispartasmtmark'].setValidators([Validators.required]);
      this.subcategoryform.controls['ispartasmtmark'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['ispartasmtmark'].setValidators(null);
      this.subcategoryform.controls['ispartasmtmark'].setValue(null);
     
    }
  }

  pramark(value){
    if(value == 1){
      this.subcategoryform.controls['partasmtminmark'].setValidators([Validators.required]);
      this.subcategoryform.controls['partasmtminmark'].updateValueAndValidity();
      this.subcategoryform.controls['partasmttotalmark'].setValidators([Validators.required]);
      this.subcategoryform.controls['partasmttotalmark'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['partasmtminmark'].setValidators(null);
      this.subcategoryform.controls['partasmtminmark'].setValue(null);
      this.subcategoryform.controls['partasmttotalmark'].setValidators(null);
      this.subcategoryform.controls['partasmttotalmark'].setValue(null);
     
    }
  }

  tutorrole(value){
    if(value == 1){
      this.subcategoryform.controls['tutorlimit'].setValidators([Validators.required]);
      this.subcategoryform.controls['tutorlimit'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['tutorlimit'].setValidators(null);
      this.subcategoryform.controls['tutorlimit'].setValue(null);
     
    }
  }

  astrole(value){
    if(value == 1){
      this.subcategoryform.controls['assessorlimit'].setValidators([Validators.required]);
      this.subcategoryform.controls['assessorlimit'].updateValueAndValidity();
      
    }else{
      this.subcategoryform.controls['assessorlimit'].setValidators(null);
      this.subcategoryform.controls['assessorlimit'].setValue(null);
     
    }
  }

  getcourse(){
    this.services.getCourse(this.smstid).subscribe(res=>{
      this.coursedata = res.data.data.course;
      this.feedetails = res.data.data.fee;
      console.log('coursedata', this.coursedata);
      console.log('feedetails', this.feedetails);
      let fee_main_cfi = this.feedetails.filter((item)=>(item.fsm_feestype == 1 && item.fsm_applicationtype == 1))
      if(fee_main_cfi.length > 1){
        let main_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 1);
        let branch_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 2);
        this.main_cfi = main_cfi_ar[0]?.fsm_fee
        this.branch_cfi = branch_cfi_ar[0]?.fsm_fee
      }else if(fee_main_cfi.length == 1){
        let main_cfi_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 3);
        this.main_cfi = main_cfi_ar[0]?.fsm_fee
        this.branch_cfi = main_cfi_ar[0]?.fsm_fee
      }

      let fee_main_cfr = this.feedetails.filter((item)=>(item.fsm_feestype == 1 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2) ))
      if(fee_main_cfr.length > 1){
        let main_cfr_ar = fee_main_cfi.filter((item)=>item.fsm_officetype == 1);
        let branch_cfr_ar = fee_main_cfr.filter((item)=>item.fsm_officetype == 2);
        this.main_cfr = main_cfr_ar[0]?.fsm_fee;
        this.branch_cfr = branch_cfr_ar[0]?.fsm_fee;
      }else if(fee_main_cfr.length == 1){
        let main_cfr_ar = fee_main_cfr.filter((item)=>item.fsm_officetype == 3);
        this.main_cfr = main_cfr_ar[0]?.fsm_fee;
        this.branch_cfr = main_cfr_ar[0]?.fsm_fee;
      }

      let fee_main_sefi = this.feedetails.filter((item)=>(item.fsm_feestype == 2 && item.fsm_applicationtype == 1))
      
      if(fee_main_sefi.length > 1){
        let main_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 1);
        let branch_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 2);
        this.main_sefi = main_sefi_ar[0]?.fsm_fee;
        this.branch_sefi = branch_sefi_ar[0]?.fsm_fee;
      }else if(fee_main_sefi.length == 1){
        let main_sefi_ar = fee_main_sefi.filter((item)=>item.fsm_officetype == 3);
        this.main_sefi = main_sefi_ar[0]?.fsm_fee;
        this.branch_sefi = main_sefi_ar[0]?.fsm_fee;
      }

      let fee_main_sefu = this.feedetails.filter((item)=>(item.fsm_feestype == 2 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2)))
      if(fee_main_sefi.length > 1){
        let main_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 1);
        let branch_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 2);
        this.main_sefu = main_sefu_ar[0]?.fsm_fee;
        this.branch_sefu = branch_sefu_ar[0]?.fsm_fee;
      }else if(fee_main_sefi.length == 1){
        let main_sefu_ar = fee_main_sefu.filter((item)=>item.fsm_officetype == 3);
        this.main_sefu = main_sefu_ar[0]?.fsm_fee;
        this.branch_sefu = main_sefu_ar[0]?.fsm_fee;
      }

      let fee_main_srefi = this.feedetails.filter((item)=>(item.fsm_feestype == 6 && item.fsm_applicationtype == 1))
      if(fee_main_srefi.length > 1){
        let main_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 1);
        let branch_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 2);
        this.main_srefi = main_srefi_ar[0]?.fsm_fee;
        this.branch_srefi = branch_srefi_ar[0]?.fsm_fee;
      }else if(fee_main_srefi.length == 1){
        let main_srefi_ar = fee_main_srefi.filter((item)=>item.fsm_officetype == 3);
        this.main_srefi = main_srefi_ar[0]?.fsm_fee;
        this.branch_srefi = main_srefi_ar[0]?.fsm_fee;
      }

      let fee_main_srefu = this.feedetails.filter((item)=>(item.fsm_feestype == 6 && (item.fsm_applicationtype == 3 ||item.fsm_applicationtype == 2)))
      if(fee_main_srefu.length > 1){
        let main_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 1);
        let branch_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 2);
        this.main_srefu = main_srefu_ar[0]?.fsm_fee;
        this.branch_srefu = branch_srefu_ar[0]?.fsm_fee;
      }else if(fee_main_srefu.length == 1){
        let main_srefu_ar = fee_main_srefu.filter((item)=>item.fsm_officetype == 3);
        this.main_srefu = main_srefu_ar[0]?.fsm_fee;
        this.branch_srefu = main_srefu_ar[0]?.fsm_fee;
      }

      let royal = this.feedetails.filter((item)=>(item.fsm_feestype == 3))
      if(royal.length >= 1){
        this.isroyal = "1";
        this.royal = royal[0]?.fsm_fee;
      }
      this.services.getallsubcourse(this.smstid, this.coursedata.scm_coursecategorymst_fk).subscribe(res=>{
        this.subcourselist = res.data.data;
        console.log('subcourselist', this.subcourselist);
        if(this.subcategorydata){
          this.subcourselist.push({
            'ccm_catcode' : this.subcategorydata.ccm_catcode,
            'ccm_catname_ar' : this.subcategorydata.ccm_catname_ar,
            'ccm_catname_en' : this.subcategorydata.ccm_catname_en,
            'ccm_coursecategorymst_pk' : this.subcategorydata.ccm_coursecategorymst_pk,
            'ccm_createdby' : this.subcategorydata.ccm_createdby,
            'ccm_createdon' : this.subcategorydata.ccm_createdon,
            'ccm_status' : this.subcategorydata.ccm_status,
            'ccm_subcatcode' : this.subcategorydata.ccm_subcatcode,
            'ccm_updatedby' : this.subcategorydata.ccm_updatedby,
            'ccm_updatedon' : this.subcategorydata.ccm_updatedon,
            'coursecategorymst_pk' : this.subcategorydata.coursecategorymst_pk
          })

        }
      })
    })

  }
  
  viewfee() {

    this.hideviewfee = !this.hideviewfee;
    if (!this.hideviewfee) {
      this.viewname = this.ifarbic ? 'Hide Fee Subscription' : 'Hide Fee Subscription';
      const id = document.getElementById('feediv') as HTMLElement;
      id.style.display = 'block';
    } else {
      this.viewname = this.ifarbic ? 'View Fee Subscription' : 'View Fee Subscription';
      const id = document.getElementById('feediv') as HTMLElement;
      id.style.display = 'none';

    }
  }


  getprereqlist(){
    this.services.getprereqlist(this.smstid).subscribe(res=>{
      this.prereqlist = res.data.data;
      console.log('getprereqlist', this.prereqlist);
    })
  }

  getsubcoursedtls(){
    this.services.getsubcourse(this.subcid).subscribe(res=>{
      let data = res.data.data.course;
      this.subcategorydata = data;
      this.subfeedetails = res.data.data.fee;
      console.log('this.subfeedetails ',this.subfeedetails);
      this.smstid = data.scd_standardcoursemst_fk;
      this.getcourse();
      this.getprereqlist();

      let ltf = this.subfeedetails.filter((item)=>(item.fsm_feestype == 4 && item.fsm_applicationtype == 1));
      if(ltf){
        this.inti_ltf = Math.floor(ltf[0]?.fsm_fee);
      }
      let laf = this.subfeedetails.filter((item)=>(item.fsm_feestype == 5 && item.fsm_applicationtype == 1));
      if(laf){
        this.inti_laf = Math.floor(laf[0]?.fsm_fee);
      }
      let rltf = this.subfeedetails.filter((item)=>(item.fsm_feestype == 4 && item.fsm_applicationtype == 4));
      if(rltf){
        this.ref_ltf = Math.floor(rltf[0]?.fsm_fee);
      }
      let rlaf = this.subfeedetails.filter((item)=>(item.fsm_feestype == 5 && item.fsm_applicationtype == 4));
      if(rltf){
        this.ref_laf = Math.floor(rlaf[0]?.fsm_fee);
      }
 
      console.log('sdfsdfds', this.prereqlist);
      console.log('subcoures', res);
      let prerequesit = data.scd_prerequesit?.split(",");
      let obj = JSON.parse(data.scd_markpercent);
      let isturole = data.sccm_trainer ? "1" : "2";
      let isassrole = data.sccm_trainer ? "1" : "2";
      this.subcategoryform = this.fb.group({
         subcourse: [data.scd_subcoursecategorymst_fk, Validators.required],
         onjobtraining: [data.scd_onjobtraining, Validators.required],
         printfinalpermitcard: [data.scd_printfinalpermitcard, Validators.required],
         limitoflearner: [data.scd_limitoflearner, Validators.required],
         isthyclass: [data.scd_isthyclass], 
         thyclasslimit: [data.scd_thyclasslimit],
         ispratclass:[data.scd_ispratclass],
         practclasslimit:[data.scd_practclasslimit],
         asmtbatchlimit:[data.scd_asmtbatchlimit],
         ispratclassrefresher:[data.scd_ispratclassrefresher],
         hasagelimit:[data.scd_hasagelimit, Validators.required],
         agelimit:[data.scd_agelimit],
         prerequesit:[prerequesit],
         iscertexpiry:[data.scd_iscertexpiry, Validators.required],
         iscertexpirybasedonmarks:[data.scd_iscertexpirybasedonmarks],
         markpercent:this.fb.array([]),
         certexpiryinmonths:[data.scd_certexpiryinmonths],
         isknwlasmt:[data.scd_isknwlasmt, Validators.required],
         minmarkfrknwlasmt:[data.scd_minmarkfrknwlasmt],
         totalmarkfrknwlasmt:[data.scd_totalmarkfrknwlasmt],
         ispratasmt:[data.scd_ispratasmt, Validators.required],
         ispartasmtmark:[data.scd_ispartasmtmark],
         partasmtminmark:[data.scd_partasmtminmark],
         partasmttotalmark:[data.scd_partasmttotalmark],
         istutorrole:[isturole, Validators.required],
         tutorlimit:[data.sccm_trainer],
         isassessorrole:[isassrole, Validators.required],
         assessorlimit:[data.sccm_assessor],
         tutor_assessorlimt:[data.sccm_trainerandassessor, Validators.required],
         pmlimit:[data.sccm_programmanager, Validators.required],
         inti_ltf:[this.inti_ltf, Validators.required],
        inti_laf:[this.inti_laf, Validators.required],
        ref_ltf:[this.ref_ltf, Validators.required],
        ref_laf:[this.ref_laf, Validators.required],
       });
       obj.forEach(element => {
         this.markprecFormArr.push(
          this.fb.group({
            max:  [element.max,Validators.required],
            min:  [element.min,Validators.required],
            expinmonth:  [element.expinmonth,Validators.required]
          })
          )
        
       });


    })
  }

  submit(data){
    this.fullPageLoaders = true;
    data.courseId = this.smstid;
    if(data.markpercent?.length == 0){
      data.markpercent = null;
    }
    data.isthyclass = !data.isthyclass ? 2 : data.isthyclass;
    data.ispratclass = !data.ispratclass ? 2 : data.ispratclass;
    data.ispratclassrefresher = !data.ispratclassrefresher ? 2 : data.ispratclassrefresher;
    data.iscertexpirybasedonmarks = !data.iscertexpirybasedonmarks ? 2 : data.iscertexpirybasedonmarks;
    data.ispartasmtmark = !data.ispartasmtmark ? 2 : data.ispartasmtmark;
    if(this.pagetype == 1){
      console.log('submit', data);
      this.services.saveSubCourse(data).subscribe(res=>{
        console.log(res);
        this.fullPageLoaders = false;
        this.toastr.success(this.i18n('Sub Course added Successfully'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.router.navigate(['/standardcourseconfiguration/viewcourse/'+this.smstid]);
      },error=>{
        this.fullPageLoaders = false;
      });
    }
    if(this.pagetype == 2){
      data.subid = this.subcid;
      console.log('submit', data);
      this.services.editSubCourse(data).subscribe(res=>{
        console.log(res);
        this.fullPageLoaders = false;
        this.toastr.success(this.i18n('Sub Course updated Successfully'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.router.navigate(['/standardcourseconfiguration/viewcourse/'+this.smstid]);
      },error=>{
        this.fullPageLoaders = false;
      });
    }
  }

  cancel(){
    this.router.navigate(['/standardcourseconfiguration/sccgridlist']);
  }

}
