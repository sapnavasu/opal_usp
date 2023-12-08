import { Component, ElementRef,ComponentFactoryResolver, EventEmitter, Injector, Input, OnInit, Output, ViewChild, ViewEncapsulation, Injectable } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { MatDatepicker, MatDatepickerInputEvent } from '@angular/material/datepicker';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { ToastrService } from 'ngx-toastr';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { RegistrationService } from '@app/modules/registration/registration.service';
import { ServiceVehiclemanagementService } from '../service-vehiclemanagement.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Encrypt } from '@app/common/class/encrypt';
import { BatchService } from '@app/services/batch.service';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { MomentDateAdapter, MAT_MOMENT_DATE_ADAPTER_OPTIONS,} from '@angular/material-moment-adapter';
import * as _moment from 'moment';
import { DatePipe } from '@angular/common';
import { default as _rollupMoment, Moment } from 'moment';
import { event } from 'jquery';
const moment = _rollupMoment || _moment;


@Injectable({
  providedIn: 'root',
})
export class DateFormatService {
  private customFormats = {
    parse: {
      dateInput: 'DD-MM-YYYY',
    },
    display: {
      dateInput: 'DD-MM-YYYY',
      monthYearLabel: 'MMM YYYY',
      dateA11yLabel: 'LL',
      monthYearA11yLabel: 'MMMM YYYY',
    },
  };

  private yearFormats = {
    parse: {
      dateInput: 'YYYY',
    },
    display: {
      dateInput: 'YYYY',
      monthYearLabel: 'YYYY',
      dateA11yLabel: 'LL',
      monthYearA11yLabel: 'YYYY',
    },
  };

  private useCustomFormat = true;

  constructor() {}

  getFormats() {
    return this.useCustomFormat ? this.customFormats : this.yearFormats;
  }

  setUseCustomFormat(useCustomFormat: boolean) {
    this.useCustomFormat = useCustomFormat;
  }
}
@Component({
  selector: 'app-vehicleregister',
  templateUrl: './vehicleregister.component.html',
  styleUrls: ['./vehicleregister.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {
      provide: DateAdapter,
      useClass: MomentDateAdapter,
      deps: [MAT_DATE_LOCALE, MAT_MOMENT_DATE_ADAPTER_OPTIONS],
    },
    {
      provide: MAT_DATE_FORMATS,
      useFactory: (dateFormatService: DateFormatService) => dateFormatService.getFormats(),
      deps: [DateFormatService],
    },
  ],
})
export class VehicleregisterComponent implements OnInit {
   providers: any[]
  technicalEvalutionCentrelist: any;
  regpk: any;
  mainoffappmainPk: any;
  searchRoadtype: any;
  searchcountry: any;
  searchVehicleCat: any;
  vehiclecatresult: any ;
  roadtyperesult: any ;
  intyperesult: any;
  branchlist: any = [];
  branchappmainPk: any;
  selectedTechCentr: any;
  categoryList: any =[];
  roadtypeList: any = [];
  disableSubmitButton: boolean;
  edit: boolean = false;

  ifarabic: boolean = false;
  ownerlist: any;
  inspectorlist: any=[];
  vehiclePk: string;
  chekchasisnumber: boolean = true;
  renewchasisnumber: any;
  stktype: any;
  issuspended: any;
  isoverdue: any;
  is_expired: any;
  textexpire: any;
  swaltext: string;
  textexpirebranch: any;
  mainofficeappl: boolean;
  isfocalpoint: any;
  isprimaycert: any;
  notetext: string;
  buttonarray: any[];
  vehiclenumber: any;
  // modelYearCntrl: any;

  i18n(key) {
    return this.translate.instant(key);
  }
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public filtername = "Hide Filter";
  public vehicleForm: FormGroup;
  Submitted: boolean = true;
  public branchoffice: boolean = false;
  selectedYear: number;
  // modelYear = new FormControl();
  useCustomFormat  = false;
  public PageLoaders: boolean = false;
  SaveVehicleDtlsBtn: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    text: this.i18n('Submit'),
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };

  constructor(
  private _componentFactoryResolver: ComponentFactoryResolver,
  private fb: FormBuilder,public toastr: ToastrService,public router: Router,private dateFormatService: DateFormatService,
    private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService, private remoteService: RemoteService, private cookieService: CookieService,
    public routeid: ActivatedRoute , private regService : RegistrationService,private rasService : ServiceVehiclemanagementService,
    private injector: Injector,private localstorage:AppLocalStorageServices,private datePipe: DatePipe,private security:Encrypt, private batchService:BatchService,private dateAdapter: DateAdapter<MomentDateAdapter>  ) 
    { }
    
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();


  ngOnInit(): void {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.formvalidated();
    this.routeid.paramMap.subscribe((params: ParamMap) => {
      this.vehiclePk  = params.get('vcl_id');
      if(this.vehiclePk)
      {
       
        this.edit = true;
        this.PageLoaders = true ;
      } 
      
    })
    
    
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";

      } else {
        this.filtername = "إخفاء التصفية";

      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";

    }
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarabic = true
    }
    else {
      this.ifarabic = false;
    }

    this.regpk = this.localstorage.getInLocal('registerPk');
    this.remoteService.getLanguageCookie().subscribe(data => {
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          ;
        } else {
          this.filtername = "إخفاء التصفية";

        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarabic = true
      }
      else {
        this.ifarabic = false;
      }

    });

    this.PageLoaders = true;
   
    this.getTechnicalEvalutionCentres();
    this.getmasterlist();
    this.vehicleForm.controls['ropRegister'].valueChanges.debounceTime(400).subscribe(respdata => {
     this.Form.ropRegisterString.setValue(moment(respdata).format('YYYY-MM-DD').toString());
    });
    // this.vehicleForm.controls['ownName'].valueChanges.debounceTime(400).subscribe(respdata => {
    //   let searchData = respdata;
    //   if (searchData != null) {
    //     if (searchData.length >= 3 && searchData.length != null) {
    //       this.rasService.getPreviousOwnerList(1, searchData).subscribe(data => {
    //         if (data['data'].data) {
    //           this.ownerlist = data['data'].data;
    //           console.log( this.ownerlist);
    //         }
    //       })
    //     }
    //   }
    // });
    // this.vehicleForm.controls['ownNameArb'].valueChanges.debounceTime(400).subscribe(respdata => {
    //   let searchData = respdata;
    //   if (searchData != null) {
    //     if (searchData.length >= 3 && searchData.length != null) {
    //       this.rasService.getPreviousOwnerList(2, searchData).subscribe(data => {
    //         if (data['data'].data) {
    //           this.ownerlist = data['data'].data;
    //           console.log( this.ownerlist);
    //         }
    //       })
    //     }
    //   }
    // });
  }
  getVehicleRegDtlsByVclPk(encregpk: string,editrenewal = false) {
    this.PageLoaders = true ;
    this.rasService.getvehiclregdlsbyvhclpk(encregpk).subscribe(res=>{
      let response = res.data.data;

       if(this.edit == true)
    {
      this.Form.inspectionDate.clearValidators();
      this.Form.inspectionDate.updateValueAndValidity();
      
    }

      if(editrenewal == false)
      {
        this.vehicleForm.patchValue({
          registrationpk: response.rvrd_opalmemberregmst_fk,
          applicatiomainpk:response.appiim_applicationdtlsmain_fk,
          offtype:response.appiim_officetype,
          brancheng:response.appiim_applicationdtlsmain_fk,
          inspectionDate:response.rvrd_dateofinsp,
          inspStarttime:new Date(this.patchdates(response.rvrd_inspstarttime)),
          inspEndtime:new Date(this.patchdates(response.rvrd_inspendtime)),
          isedit:1,
        });
      }
      if(this.Form.offtype.value == 2)
      {
        this.selectedBranchDtl(Number(this.Form.applicatiomainpk.value));
        this.branchappmainPk =this.Form.brancheng.value;
      }
      this.selectOffice(this.Form.offtype.value);
      
      this.vehicleForm.patchValue({
        
        ownName:response.rvod_ownername_en,
        ownNameArb:response.rvod_ownername_ar,
        crNumber:response.rvod_crnumber,
        chassNumber: response.rvrd_chassisno,
        odometer:response.rvrd_odometerreading,
        inspectorName:response.rvrd_inspectorname,
        vehiclenumber:response.rvrd_vechicleregno,
        ivmsvendorname:response.rvrd_ivmsvendorname,
        ivmsdeviceno:response.rvrd_ivmsdevicemodel,
        ivmsNumber:response.rvrd_ivmsserialno,
        speedlimit:response.rvrd_speedlimitno,
        vehiclecat:response.rvrd_vechiclecat,
        fleetNumber:response.rvrd_vechiclefleetno,
        roadType:response.rvrd_roadtype,
        ropRegister:response.rvrd_firstropregdate,
        modelYear:response.rvrd_modelyear,
        batchrefno:response.rvrd_applicationrefno,
        
      });
      if(this.vehicleForm.controls.vehiclenumber.invalid && this.vehiclenumber)
      {
          this.vehicleForm.controls.vehiclenumber.setValue(this.vehiclenumber);
          this.vehiclenumber = null;
      }
      
      this.setInspectionTime();
      this.PageLoaders = false ;

    });
  }

  patchdates(value)
  {
    let start = new Date();
    let strattime = moment(start).format('YYYY-MM-DD').toString()+' '+moment(value).format('HH:mm:00').toString();
    return strattime;
  }
  formvalidated() {
    this.vehicleForm = this.formBuilder.group({
      registrationpk : ['',Validators.required],
      applicatiomainpk:['',Validators.required],
      offtype: ['', Validators.required],
      brancheng: ['',''],
      ownName: ['', Validators.required],
      ownNameArb: ['', Validators.required],
      crNumber: ['', Validators.required],
      vehiclenumber: ['', [Validators.required,Validators.pattern("^[0-9]+-[a-zA-Z]+$")]],
      chassNumber: ['', Validators.required],
      odometer: ['', Validators.required],
      ivmsvendorname: ['', Validators.required],
      ivmsdeviceno: ['', Validators.required],
      ivmsNumber: ['', Validators.required],
      speedlimit: ['', Validators.required],
      vehiclecat: ['', Validators.required],
      fleetNumber: ['', Validators.required],
      roadType: ['', Validators.required],
      ropRegister: ['', Validators.required],
      ropRegisterString: ['', Validators.required],
      modelYear: ['', Validators.required],
      inspectionDate: ['', Validators.required],
      inspStarttime:['',Validators.required],
      inspEndtime:['',Validators.required],
      inspectionDateString: ['', Validators.required],
      inspStarttimeString:['',Validators.required],
      inspEndtimeString:['',Validators.required],
      inspectorName: ['', ''],
      isrenewal: ['', ''],
      isedit: ['',''],
      batchrefno : ['','']
    })
    
  }

  setcrnumber(data,type) {
    if(data)
    {
      if(type == 1)
      {
        this.Form.ownNameArb.setValue(data.name_ar);
      }
      else
      {
        this.Form.ownName.setValue(data.name_en);
      }
      this.Form.crNumber.setValue(data.crnumber);
      
      // this.Form.ownName.setValue(data.name_en);
    }
    else
    {
      this.Form.crNumber.setValue(null);
      if(type == 1)
      {
        this.Form.ownNameArb.setValue(null);
      }
      else
      {
        this.Form.ownName.setValue(null);
      }
    }
    
  }

  getpreviouslist(respdata,type)
  {
    let searchData = respdata;
   
      if (searchData != null) {
        this.setcrnumber(null,type);
        if (searchData.length >= 3 && searchData.length != null) {
          this.rasService.getPreviousOwnerList(type, searchData).subscribe(data => {
            if (data['data'].data) {
              this.ownerlist = data['data'].data;
              console.log( this.ownerlist);
            }
          })
        }
      }
      else
      {
        this.setcrnumber(null,type);
      }
   
  }
 

  setInspectionTime() {
    this.setIspectionDate(this.Form.inspectionDate.value);
    this.setstarttime(this.Form.inspStarttime.value);
    this.setendtime(this.Form.inspEndtime.value);
  }

  setIspectionDate(value) {
   
    let assessmentdate = moment(value).format('YYYY-MM-DD').toString();
    this.Form.inspectionDateString.setValue(assessmentdate);

  }
  setstarttime(value) {
    
    if (this.Form.inspectionDateString.value) {
      let timeStart = moment(value).format('HH:mm:00').toString();
      this.Form.inspStarttimeString.setValue(this.Form.inspectionDateString.value + ' ' + timeStart);

    }

  }
  setendtime(value) {
    if (this.Form.inspectionDateString.value) {
      let timeEnd = moment(value).format('HH:mm:00').toString();
      this.Form.inspEndtimeString.setValue(this.Form.inspectionDateString.value + ' ' + timeEnd);
    }

  }

  Vehicleregister() {
    console.log(this.vehicleForm.value)
     if(this.edit == true)
    {
      this.Form.inspectionDate.clearValidators();
      this.Form.inspectionDate.updateValueAndValidity();
      
    }
   console.log(this.Form.offtype.value)
    if(this.Form.offtype.value == 2)
    {
      this.Form.brancheng.setValidators([Validators.required]);
    }
    else
    {
      this.Form.brancheng.reset();
      this.Form.brancheng.setValidators(null);
    }
    if(this.vehicleForm.valid) {
     
      swal({
        title: this.i18n('Do you want to confirm submission of the Vehicle Registration Form?'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('No'), this.i18n('Yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.submitData(this.vehicleForm.value);
          // this.toastr.success(this.i18n('Vehicle Registration Form Submitted Successfully.'), ''), {
          //   timeOut: 2000,
          //   closeButton: false,
            
          // };
         
        }
        else
        {
          // this.vehicleForm.enable();
        }
      });
      return;
      this.vehicleForm.enable();

     
      this.resetform();

    
    this.Vehiclelist();

    }else {
      
      this.focusInvalidInput(this.vehicleForm)
      // this.vehicleForm.enable();
    }
   
 }

 submitData(formvalue)
 {
  this.SaveVehicleDtlsBtn.active = true;
  this.PageLoaders = true ;
  this.rasService.saveVehicleDtls(formvalue).subscribe(data => {
    this.PageLoaders = false ;

 if(data.data.status == 1)
 {    
    
      this.SaveVehicleDtlsBtn.active = false;
      this.vehicleForm.reset();
      this.Vehiclelist();
      swal({
        title: this.i18n('Vehicle Registration Form Submitted Successfully.'),
        text: '',
        icon: 'success',
        buttons: [false, this.i18n('OK')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      })
  }else{
    swal({
      title: this.i18n('There was a problem while Registering Vehicle.'),
      text: data['data'].msg,
      icon: 'warning',
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    })
  }
     
  });
 }

 resetform()
 {
  this.vehicleForm.controls['offtype'].reset();
  this.vehicleForm.controls['brancheng'].reset();
  this.vehicleForm.controls['ownName'].reset();
  this.vehicleForm.controls['ownNameArb'].reset();
  this.vehicleForm.controls['crNumber'].reset();
  this.vehicleForm.controls['vehiclenumber'].reset();
  this.vehicleForm.controls['chassNumber'].reset();
  this.vehicleForm.controls['ivmsNumber'].reset();
  this.vehicleForm.controls['speedlimit'].reset();
  this.vehicleForm.controls['vehiclecat'].reset();
  this.vehicleForm.controls['fleetNumber'].reset();
  this.vehicleForm.controls['roadType'].reset();
  this.vehicleForm.controls['ropRegister'].reset();
  this.vehicleForm.controls['modelYear'].reset();
  this.vehicleForm.controls['inspectionDate'].reset();
  this.vehicleForm.controls['inspectorName'].reset();
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
  get Form() { { return this.vehicleForm.controls; } }
  
  cancle(){
     if(this.vehicleForm.touched) {
      swal({
        title: this.i18n('Do you want to cancel submitting this Vehicle Registration Form?'),
        text: this.i18n('If yes, any unsaved data will be lost.'),
        icon: 'warning',
        buttons: [this.i18n('No'), this.i18n('Yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.vehicleForm.reset();
          this.Vehiclelist();
          // this.toastr.success(this.i18n('This Vehicle Registration Form is Cancelled.'), ''), {
          //   timeOut: 2000,
          //   closeButton: false,
          // };
          swal({
            title: this.i18n('This Vehicle Registration Form is Cancelled.'),
            text: '',
            icon: 'success',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
        }
      });
        
    }
    else {
      this.vehicleForm.reset();
      this.Vehiclelist();

    }
     
  }
  Vehiclelist() {
    if(this.stktype == 1)
    {
      this.router.navigate(['/vehiclemanagement/list']);
    }
    this.router.navigate(['/vehiclemanagement/vehiclelisting']);
  }
  statustype(value) {
    if(value == 1) {
      this.branchoffice = false;
      this.vehicleForm.controls.brancheng.reset();
    }
    else  if(value == 2) {
      this.branchoffice = true;
    } 
  }

  checkvehicle():boolean
  {
    this.disableSubmitButton = true;
    this.rasService.checkVehicleRegistered(this.Form.vehiclenumber.value, this.regpk).subscribe(data => { 
      this.disableSubmitButton = false;
      if (data['data'].status == 2 ) {
        let response = data.data.available;

        if(response.status != 3 && response.status != 8)
        {
          this.inothercompanyinspection();
          this.vehicleForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });
          
        }
        else if(response.status == 3 && (response.nearing == 1 || response.expired == 1))
        {

          swal({
            title: this.i18n('This Vehicle already has a valid sticker, and we will accept it as a renewal form, Click on Proceed to proceed with the renewal process.'),
            text: '',
            icon: 'warning',
            buttons: [this.i18n('Proceed'), this.i18n('Cancel')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
             this.vehicleForm.controls['vehiclenumber'].reset();
             
            }
            else{
              this.vehiclenumber = this.vehicleForm.controls['vehiclenumber'].value;
            
              this.Form.isrenewal.setValue(true);
              this.Form.vehiclenumber.setErrors(null);
              this.renewchasisnumber = response.chasis;
              this.getVehicleRegDtlsByVclPk(this.security.encrypt(response.vehiclepk),true);  
              
              
            }
          });
          
         
        }
        else if(response.status == 3 && (response.nearing == 2 && response.expired == 2))
        {
          swal({
            title: this.i18n('This vehicle is already Registered with the following Centre "'+response.centre+'"'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          });
          this.vehicleForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });
        }
        else if(response.status == 8)
        {
          swal({
            title: this.i18n('The Inspection for this particular Vehicle was conducted at the following Centre "'+response.centre+'", and it was Rejected.'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          });
          this.vehicleForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });
        }

      }
      else{
        swal({
          title: this.i18n('This vehicle is already Registered with your Centre.'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('Ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        });
        this.vehicleForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });
      }
      
    });
    return true;
  }

  inothercompanyinspection()
  {
    swal({
      title: this.i18n('This Vehicle is already registered for inspection with another Centre.'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    });
  }
 
  checkByType(value: any, contorlName: string ,regpk = '1') {
    
    switch (contorlName) {
      case 'vehiclenumber':
        if(this.Form.vehiclenumber.valid){
        this.regService.checkVehicleNum(value, regpk).subscribe(data => { 
          if (data['data'].available && this.Form.vehiclenumber.valid) {
            if(this.checkvehicle())
            {
              return false;
            }
          }
          else{
            //  this.Form.isrenewal.setValue(null);
            //  this.renewchasisnumber = null;
            //  this.checkByType(this.Form.chassNumber.value,'chassNumber');
            this.rasService.getIvmsvehicledata(this.Form.vehiclenumber.value, this.regpk).subscribe(data => { 
              this.disableSubmitButton = false;
              console.log(data)
            });
           
          }
        });
        }
       
        break;
      case 'chassNumber':
      this.regService.checkChassNum(value, regpk).subscribe(data => {
        if (data['data'].available) {

          this.vehicleForm.controls[contorlName].markAsTouched();
          this.vehicleForm.controls[contorlName].setErrors({ alreadyavailable: true });
          
          if(this.renewchasisnumber == this.Form.chassNumber.value) 
          {
            this.vehicleForm.controls[contorlName].setErrors(null);
          }
          return false;
        }
        
      });
      break;
  }
}

getTechnicalEvalutionCentres() {
    let technical = false;
    this.mainofficeappl = false;
  this.rasService.getTechnicalEvalutionCentres(4).subscribe(response => {
    if (response.data.status == 1) {
    
      this.technicalEvalutionCentrelist = response.data.data;
      console.info(this.technicalEvalutionCentrelist)
      this.technicalEvalutionCentrelist.forEach(z => {
        if (z.regpk == this.regpk) {
          
          
          this.Form.applicatiomainpk.setValue(z.appmainpk);
          this.mainoffappmainPk = z.appmainpk;
          
          this.isprimaycert = z.isprimary ;
          technical = true;
          this.mainofficeappl = true;
          
          this.temppk = z.temppk;
          this.appstatus = z.status;
           
          this.notetext = "";
          this.buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
          if(this.isfocalpoint == 2)
            {
              this.notetext = "Note: Contact your Centre's Focal Point to renew the Centre Certification.";
              this.buttonarray = [false, this.i18n('Ok')];
            }

          if (z.issuspended == 1 || z.isOverdue == 1 ||  z.is_expired == 1) {
            this.mainoffappmainPk = null;
            
            
             if (z.issuspended == 1) {
              this.notetext = "";
              this.buttonarray = [false, this.i18n('Ok')];
              this.swaltext = "A Vehicle cannot be registered for this Centre as the Centre Certification has been Suspended..";
            }
            else if (z.isOverdue == 1) {
              this.notetext = "";
              this.buttonarray = [false, this.i18n('Ok')];
              this.swaltext = "A Vehicle cannot be registered for an inspection in the selected Centre's Location because the Royalty Fee Payment is Overdue.";
            }
            else if (z.is_expired == 1) {
              this.swaltext = "The 30 days grace period to renew your Centre Certification has expired. Hence, you cannot register Vehicle for an Inspection on the OPAL USP.";
            }
            else {
              this.swaltext = null;
            }
          }
            
          this.textexpire = null;
            if ((z.is_nearingexpiry == 1 || z.graceperiod == 1)&& z.renewed == 0) {
              if (z.graceperiod == 1) {
                this.textexpire = "The Centre Certification has expired. We have provided a grace period of 30 days to renew your Centre Certification. Kindly renew it on or before "+z.expireddate+". If not, you will be unable to register Vehicle for an Inspection on the OPAL USP until the Centre Certification is renewed.";
          }
              else if (z.is_nearingexpiry == 1) {
                this.textexpire = "The Centre Certification is going to expire on "+z.nearingdate+". Kindly renew your Centre Certification on or before the specified expiry date. If not, you will be unable to register Vehicle for an Inspection on the OPAL USP until the Centre Certification is renewed.";
              }
            }
         
          
         if(this.edit == true)
         {
          this.getVehicleRegDtlsByVclPk(this.vehiclePk);
         }
          
        }
        
      }); 
      this.getBranchlist(this.regpk);
      this.Form.registrationpk.setValue(this.regpk);
      this.PageLoaders = false;
    }
    else {

      this.technicalEvalutionCentrelist = [];
    }
    // if(technical == false)
    //     {
          
    //       swal({
    //         title: this.i18n('You cannot register a Vehicle for Vehicle Inspection as your Company has not applied for the Technical Evaluation Certification.'),
    //         text: '',
    //         icon: 'warning',
    //         buttons: [false, this.i18n('Ok')],
    //         dangerMode: true,
    //         className: this.dir =='ltr'?'swalEng':'swalAr',
    //         closeOnClickOutside: false
    //       }).then((willGoBack) => {
    //         if (willGoBack) {
    //           this.vehicleForm.reset();
    //           // this.Vehiclelist();
    //         }
    //       });
    //     }
  });
  
 

  console.log(this.mainofficeappl)
  
}

getBranchlist(regpk) {
  let encregpk = this.security.encrypt(regpk);
  this.rasService.getBranchlistbyregpk(encregpk,4).subscribe(response => {
    if (response.data.status == 1) {
      this.branchlist = response.data.data;
    }
    else {
      this.branchlist = [];
    }
  
  })
}

resetcategory()
{
  this.vehicleForm.controls['vehiclecat'].reset();
}
resetinspector()
{
  this.vehicleForm.controls['inspectorName'].reset();
}

selectedTechnicalCentre(value) {
  this.mainoffappmainPk = null;
  this.branchappmainPk = null;
  this.technicalEvalutionCentrelist.forEach(z => {
    if (z.regpk == value) {
      this.mainoffappmainPk = z.appmainpk;
      this.selectedTechCentr = z.compname_en;
      this.Form.applicatiomainpk.setValue(z.appmainpk);
      this.getBranchlist(value);
      this.getVehicleCat(z.appmainpk);
     
    }
  });
}

getVehicleCat(value) {
  if(value != undefined)
  {
    let encregpk = this.security.encrypt(value);
    this.categoryList = [];
    this.rasService.getVehicleCategoryByAppPk(encregpk).subscribe(response => {
      if (response.data.status == 1) {
        this.categoryList = response.data.data;
        if(this.Form.vehiclecat.value)
        {
          this.getInspectorname(true);
        }
      }
      else {
        this.categoryList = [];
        swal({
          title: this.i18n('No Categories Found'),
          text: '',
          icon: 'warning',
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        });
        this.resetcategory();
      }
     
    });
  } 
}

selectinspector(value)
{
  this.inspectorlist.forEach(z => {

    if(z.pk == value)
    {
    let notetext = "";
    let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
    if(this.isfocalpoint == 2)
      {
        notetext = "Note: Contact your Centre's Focal Point to renew the Staff’s Competency Card.";
        buttonarray = [false, this.i18n('Ok')];
      }
console.log(z);
    if (z.is_expired == 1) {
      let text = "The 30 days grace period given for renewing the Staff Competency Card has expired. Hence, you cannot assign the selected staff for this Vehicle Inspection on the OPAL USP.";
      swal({
        title: this.i18n(text),
        text: notetext,
        icon: 'warning',
        dangerMode: true,
        buttons: buttonarray,
        
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.Form['inspectorName'].setValue(null);
          this.Form['inspectorName'].updateValueAndValidity();
        }
        else
        {
          if(z.isprimary == 1)
          {
            this.router.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1),st: this.security.encrypt(z.status) }});
          }
          else
          {
            this.router.navigate(['trainingcentremanagement/rasbranchcentre/NA=='],{ queryParams: {renew: this.security.encrypt(1), ap: this.security.encrypt(z.temppk) , st: this.security.encrypt(z.status) }});
          }
         
        }
      });
    }
    else {
      let tutortext;
      if ((z.is_nearingexpiry == 1 || z.graceperiod == 1) && z.renewed == 0) {
        if (z.graceperiod == 1) {
          tutortext = "The Staff’s Competency Card has expired. We have provided a grace period of 30 days to renew the Staff Competency Card. Kindly renew it on or before "+z.expireddate+". If not, you cannot select the staff for Vehicle Inspection on the OPAL USP.";
        }
        else if (z.is_nearingexpiry == 1) {
          tutortext = "The selected Staff’s Competency Card is going to expire on "+z.nearingdate+". Kindly submit your RAS Inspection Centre Certification Form for the Competency Card renewal. If not, you will be unable to register Vehicle for an Inspection on the OPAL USP.";
        }
        swal({
            title: this.i18n(tutortext),
            text: notetext,
            icon: 'warning',
            dangerMode: true,
            buttons: buttonarray,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (!willGoBack) {
             
              if(this.Form.offtype.value == 1)
              {
                this.router.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1),st: this.security.encrypt(z.status), ap: this.security.encrypt(z.temppk) }});
              }
              else
              {
                this.router.navigate(['trainingcentremanagement/rasbranchcentre/NA=='],{ queryParams: {renew: this.security.encrypt(1),  ap: this.security.encrypt(z.temppk),st: this.security.encrypt(z.status)}});
              }
            }
          });
      }
    }
  }
  });
}

getInspectorname(edit=false) {
  this.inspectorlist = [];
  this.Form.inspectorName.setValue(null);
  this.setInspectionTime();
  if(this.Form.vehiclecat.valid && this.Form.applicatiomainpk.valid  && this.Form.registrationpk.valid && this.Form.inspectionDate.valid && this.Form.inspStarttime.valid  && this.Form.inspEndtime.valid )
  {
    let body = JSON.stringify({
      vehiclecat: this.vehicleForm.controls['vehiclecat'].value,
      registrationpk :  this.security.encrypt(this.vehicleForm.controls['registrationpk'].value),
      applicatiomainpk:this.security.encrypt(this.vehicleForm.controls['applicatiomainpk'].value),
      categoryPk:this.security.encrypt(this.vehicleForm.controls['vehiclecat'].value),
      date:this.security.encrypt(this.vehicleForm.controls['inspectionDateString'].value),
      startTime:this.security.encrypt(this.vehicleForm.controls['inspStarttimeString'].value),
      endTime:this.security.encrypt(this.vehicleForm.controls['inspEndtimeString'].value),
      ifedit:edit,
    });
    this.rasService.getInspectorname(body).subscribe(response => {
      if (response.data.status == 1) {
        this.inspectorlist = response.data.data;
      }
      else {
        this.inspectorlist = [];
        this.resetinspector();
        // swal({
        //   title: this.i18n('There is no Inspector available at the Centre'),
        //   text: '',
        //   icon: 'warning',
        //   dangerMode: true,
        //   className: this.dir =='ltr'?'swalEng':'swalAr',
        //   closeOnClickOutside: false
        // });
      }
      
    });
  }
 
}



selectOffice(value) {
  console.log(this.mainoffappmainPk)
  console.log(this.isprimaycert);
  let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
  if(this.isfocalpoint == 2)
  {
    buttonarray = [false, this.i18n('Ok')]
  }
  if (value == 1) {
    if(!this.mainoffappmainPk)
    {
      
      swal({
        title: this.swaltext,
        text: this.notetext,
        icon: 'warning',
        buttons: this.buttonarray,
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.Form.offtype.setValue(null);
          this.Form.brancheng.setValue(null);
          this.Form.brancheng.setValidators(null);
        }
        else
        {
          console.log(this.temppk)
          if(this.isprimaycert == '2')
                  {
                    this.router.navigate(['trainingcentremanagement/rasbranchcentre/NA=='],{ queryParams: {renew: this.security.encrypt(1), ap: this.security.encrypt(this.temppk) ,st: this.security.encrypt(this.appstatus)}});
                  }
                  else
                  {
                    this.router.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1),st: this.security.encrypt(this.appstatus) , ap: this.security.encrypt(this.temppk)}});
                  }
        }
      });
     
    }
    else{
      if (this.textexpire) {
        swal({
          title: this.i18n(this.textexpire),
          text: '',
          icon: 'warning',
          buttons: this.buttonarray,
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (!willGoBack) {
            if(this.isprimaycert == '2')
                  {
                    this.router.navigate(['trainingcentremanagement/rasbranchcentre/NA=='],{ queryParams: {renew: this.security.encrypt(1), ap: this.security.encrypt(this.temppk),st: this.security.encrypt(this.appstatus) }});
                  }
                  else
                  {
                    this.router.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1),st: this.security.encrypt(this.appstatus) , ap: this.security.encrypt(this.temppk)}});
                  }
          }
          
        });
      }
      this.getVehicleCat(this.mainoffappmainPk);
      this.Form.applicatiomainpk.setValue(this.mainoffappmainPk);

      
    }
   
  }
  else {
    if (this.branchappmainPk  && this.branchappmainPk != undefined) {
      this.getVehicleCat(this.branchappmainPk);
      this.Form.applicatiomainpk.setValue(this.branchappmainPk);
    }

  }
}
  appstatus(appstatus: any): any {
    throw new Error('Method not implemented.');
  }
  temppk(temppk: any): any {
    throw new Error('Method not implemented.');
  }

selectedBranchDtl(value) {
  this.branchlist.forEach(z => {
    
    if (z.appmainpk === value) {
      this.Form.applicatiomainpk.setValue(z.appmainpk);
      this.branchappmainPk = z.appmainpk;
      let buttonarray = [this.i18n('Renew Now'), this.i18n('Renew later')];
      let notetext = "";
      if(this.isfocalpoint == 2)
      {
        notetext = "Note: Contact your Centre's Focal Point to renew the Centre Certification.";
        buttonarray = [false, this.i18n('Ok')];
      }
      if(z.issuspended == 1 || z.isOverdue == 1 || z.is_expired == 1)
      {
        
        this.branchappmainPk = null;
        if(!this.branchappmainPk)
          {
            let suspended = "A Vehicle cannot be registered for this Centre as the Centre Certification has been Suspended.";
            let expired = "The 30 days grace period to renew your Centre Certification has expired. Hence, you cannot register Vehicle for an Inspection on the OPAL USP.";
            let overdue = "A Vehicle cannot be registered for an inspection in the selected Centre's Location because the Royalty Fee Payment is Overdue.";

            var text = z.issuspended == 1 ? this.i18n(suspended) : (z.isOverdue == 1 ? this.i18n(overdue) : this.i18n(expired) );
            notetext = (z.issuspended == 2 && z.isOverdue == 2) ? notetext : "";
            buttonarray = (z.issuspended == 2 && z.isOverdue == 2) ? buttonarray : [false, this.i18n('Ok')];
            swal({
              title: text,
              text: notetext,
              icon: 'warning',
              buttons: buttonarray,
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            }).then((willGoBack) => {
              if (willGoBack) {
                this.Form.offtype.setValue(null);
                this.Form.brancheng.setValue(null);
                this.Form.brancheng.setValidators(null);
              }
              else
              {
                if(z.isprimary == 2)
                  {
                    this.router.navigate(['trainingcentremanagement/rasbranchcentre/NA=='],{ queryParams: {renew: this.security.encrypt(1),  ap: this.security.encrypt(z.temppk),st: this.security.encrypt(z.status)}});
                  }
                  else
                  {
                    this.router.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1),st: this.security.encrypt(z.status) , ap: this.security.encrypt(z.temppk)}});
                  }
              }
            });
         
          }
      }
      else{
        this.textexpirebranch = null;
          if ((z.is_nearingexpiry == 1 || z.graceperiod == 1) && z.renewed == 0) {
            if (z.graceperiod == 1) {
              this.textexpirebranch = "The Centre Certification has expired. We have provided a grace period of 30 days to renew your Centre Certification. Kindly renew it on or before "+z.expireddate+". If not, you will be unable to register Vehicle for an Inspection on the OPAL USP until the Centre Certification is renewed.";
            }
            else if (z.is_nearingexpiry == 1) {
              this.textexpirebranch = "The Centre Certification is going to expire on "+z.nearingdate+". Kindly renew your Centre Certification on or before the specified expiry date. If not, you will be unable to register Vehicle for an Inspection on the OPAL USP until the Centre Certification is renewed.";
            }
            if (this.textexpirebranch) {
              swal({
                title: this.i18n(this.textexpirebranch),
                text: notetext,
                icon: 'warning',
                buttons: buttonarray,
                dangerMode: true,
                className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
                closeOnClickOutside: false
              }).then((willGoBack) => {
                if (!willGoBack) {
                  if(z.isprimary == 2)
                  {
                    this.router.navigate(['trainingcentremanagement/rasbranchcentre/NA=='],{ queryParams: {renew: this.security.encrypt(1),  ap: this.security.encrypt(z.temppk),st: this.security.encrypt(z.status)}});
                  }
                  else
                  {
                    this.router.navigate(['/trainingcentremanagement/rascentre'] ,{ queryParams: {p: this.security.encrypt(4), renew: this.security.encrypt(1),st: this.security.encrypt(z.status), ap: this.security.encrypt(z.temppk) }});
                  }
                }
                
              });
              this.selectOffice(2);
            }
          }
      }
      
     
    }
   
  });

}

getmasterlist() {
  this.rasService.getmasterlistbyType(16).subscribe(response => {
    if (response.data.status == 1) {
      this.roadtypeList  = response.data.data.list;
      
    }
    else {
      this.roadtypeList = [];
    }
  });
}

//fgyt


parseDate(ctrlValue: any, format: any): Date {
  const date = new Date(ctrlValue);
  return date;
}

checkYear(value)
{
  let currentYear = moment().format('YYYY');
  if(Number(currentYear) < Number(value))
  {
    this.Form.modelYear.setValue(null);
    this.Form.modelYear.setErrors({futureYear:true})
  }
}

Verifier(){
          
    swal({
      title: this.i18n('This Vehicle Form has been moved to the Verifier.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.vehicleForm.reset();
        this.Vehiclelist();
      }
    });
  }
  reject(){
          
    swal({
      title: this.i18n('This Vehicle Form has been Rejected.'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.vehicleForm.reset();
        this.Vehiclelist();
      }
    });
  }
  moved(){
          
    swal({
      title: this.i18n('This Vehicle Form has been moved to the Supervisor.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.vehicleForm.reset();
        this.Vehiclelist();
      }
    });
  }
  sticker(){
    swal({
      title: this.i18n('The Sticker has been Issued for the Vehicle.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.vehicleForm.reset();
        this.Vehiclelist();
      }
    });
  }
  movetoinspect(){
    swal({
      title: this.i18n('The Vehicle Form has been moved to the Inspector.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.vehicleForm.reset();
        this.Vehiclelist();
      }
    });
  }
}





