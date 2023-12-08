import { Component, ElementRef, ComponentFactoryResolver, EventEmitter, Injector, Input, OnInit, Output, ViewChild, ViewEncapsulation, Injectable } from '@angular/core';
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
import { ServiceVehiclemanagementService } from '@app/modules/vehiclemanagement/service-vehiclemanagement.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Encrypt } from '@app/common/class/encrypt';
import { BatchService } from '@app/services/batch.service';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { MomentDateAdapter, MAT_MOMENT_DATE_ADAPTER_OPTIONS, } from '@angular/material-moment-adapter';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';
import { event } from 'jquery';
import { YearlypickerComponent } from '../yearlypicker/yearlypicker.component';
import { IvmsdeviceService } from '@app/services/ivmsdev.service';
const moment = _rollupMoment || _moment;


@Injectable({
  providedIn: 'root',
})

@Component({
  selector: 'app-deviceregistration',
  templateUrl: './deviceregistration.component.html',
  styleUrls: ['./deviceregistration.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class DeviceregistrationComponent implements OnInit {
  providers: any[]
  technicalEvalutionCentrelist: any;
  regpk: any;
  mainoffappmainPk: any;
  searchRoadtype: any;
  searchcountry: any;
  searchVehicleCat: any;
  vehiclecatresult: any;
  roadtyperesult: any;
  intyperesult: any;
  branchlist: any = [];
  branchappmainPk: any;
  selectedTechCentr: any;
  categoryList: any = [];
  roadtypeList: any = [];
  disableSubmitButton: boolean;
  edit: boolean = false;
  ifarabic: boolean = false;
  ownerlist: any;
  inspectorlist: any = [];
  vehiclePk: string;
  chekchasisnumber: boolean = true;
  renewchasisnumber: any;
  searchdevicemodel: any = '';
  searchvechicelmanufact: any = '';
  searchvechicletype: any = '';
  searchsimprovider : any = '';
  vechicelmanufactresult : any;
  devicemodelresult : any;
  vechicletyperesult : any;
  simproviderList: any = [];
  stktype: any;
  issuspended: any;
  isoverdue: any;
  mainofficeappl: boolean;
  viewForm: boolean = false;
  @ViewChild('addandupdate') addandupdate: YearlypickerComponent;
  modelyear: any;
  manufaturersList: any;
  devicemodelnolist: any[];
  subcategoryList: any;
  schdulereplace: boolean;
  devicePk: string;
  editvehicle: boolean;
  simproviderresult: any[];

  i18n(key) {
    return this.translate.instant(key);
  }
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public filtername = "Hide Filter";
  // public vehicleForm: FormGroup;
  public  deviceForm: FormGroup;

  Submitted: boolean = true;
  public branchoffice: boolean = false;
  selectedYear: number;
  useCustomFormat = false;
  public PageLoaders: boolean = false;

  constructor(
    public toastr: ToastrService, public router: Router,
    private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService, private remoteService: RemoteService, private cookieService: CookieService,
    public routeid: ActivatedRoute, private regService: RegistrationService, private rasService: ServiceVehiclemanagementService, private ivmsService: IvmsdeviceService,
    private localstorage: AppLocalStorageServices, private security: Encrypt,private activeRoute: ActivatedRoute) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();


  ngOnInit(): void {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.formvalidated();
    this.routeid.paramMap.subscribe((params: ParamMap) => {
      this.devicePk = params.get('dev_id');
      

    })
    this.getType();


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
    this.deviceForm.controls['ropRegister'].valueChanges.debounceTime(400).subscribe(respdata => {
      this.Form.ropRegisterString.setValue(moment(respdata).format('YYYY-MM-DD').toString());
    });

    this.checkreg();
  }

  getType() {
    if(this.activeRoute.snapshot.url[0].path == 'sheducledevice') {
       this.schdulereplace = true;
       this.editvehicle = false;
    }
    else if(this.activeRoute.snapshot.url[0].path == 'editivmsvehicle') {
      this.editvehicle = true;
      this.schdulereplace = false;
    } else {
      this.schdulereplace = false;
      this.editvehicle = false;
    }
    console.log(this.activeRoute.snapshot.url[0].path)
  }
  getVehicleRegDtlsByVclPk(encregpk: string, editrenewal = false) {
    this.PageLoaders = true;
    this.ivmsService.getivmsvehiclregdlsbyvhclpk(encregpk).subscribe(res => {
      let response = res.data.data;

      if (this.editvehicle == true) {
        this.Form.installDate.clearValidators();
        this.Form.installDate.updateValueAndValidity();
        this.Form.isedit.setValue(1);

      }

      if (editrenewal == false) {
        this.deviceForm.patchValue({
          registrationpk: response.ivrd_opalmemberregmst_fk,
          applicatiomainpk: response.appiim_applicationdtlsmain_fk,
          offtype: response.appiim_officetype,
          brancheng: response.appiim_applicationdtlsmain_fk,
          installDate: response.ivrd_installationdate,
          inspStarttime: new Date(this.patchdates(response.ivrd_inststarttime)),
          inspEndtime: new Date(this.patchdates(response.ivrd_instendtime)),
          
        });
      }
      if(!this.schdulereplace)
      {
        this.deviceForm.patchValue({
          
          ivmsdevicemodel: response.ivrd_appdeviceinfomain_fk,
          softVersion: response.ivrd_softwareversion,
          
        });
      }
      if(this.schdulereplace)
      {
        this.Form.isschedule.setValue(1);
        this.getDeviceInfo(response.appiim_applicationdtlsmain_fk,response.ivrd_appdeviceinfomain_fk);
      }
      if (this.Form.offtype.value == 2) {
        this.selectedBranchDtl(Number(this.Form.applicatiomainpk.value));
        this.branchappmainPk = this.Form.brancheng.value;
      }
      this.selectOffice(this.Form.offtype.value);
      this.getvehiclesubcatList(response.ivrd_vechiclecat);
      this.deviceForm.patchValue({

        ownName: response.rvod_ownername_en,
        ownNameArb: response.rvod_ownername_ar,
        crNumber: response.rvod_crnumber,
        gm_emailid:response.ivrd_contpermailid,
        gm_mobnum:response.ivrd_contpermobno,
        chassNumber: response.ivrd_chassisno,
        odometer: response.ivrd_odometerreading,
        installName: response.ivrd_Installername,
        vehiclenumber: response.ivrd_vechicleregno,
      vechicelmanufact: response.ivrd_vehiclemanufname,
      deviceserial:response.ivrd_ivmsserialno,
      deviceimei: response.ivrd_deviceimeino,
      vehiclecat: response.ivrd_vechiclecat,
      vechicletype: response.ivrd_vehiclesubcat,
      devfatigsysmdl: response.ivrd_driverfatiguemgmtsysmodel,
      devfatigsysnum: response.ivrd_driverfatiguemgmtsysserialno,
      simnmber: response.ivrd_simcardno,
      simprovider: response.ivrd_simserviceprvdr,
      simproviderother: response.ivrd_simserviceprvdrothr,
      primaryspeed: response.ivrd_primyspeedsource,
      secondaryspeed: response.ivrd_secndryspeedsource,
      speedlimit: response.ivrd_spdlimtseriealno,
      vehiclefleet: response.ivrd_vehiclefleetno,
      ropRegister: response.ivrd_firstropregdate,
      modelYear: response.ivrd_modelyear,
      });
      if(response.ivrd_simserviceprvdr == null)
      {
         this.Form.simprovider.setValue('other');
         this.Form.simprovider.updateValueAndValidity();
      }

      if(this.Form.installDate.invalid)
      {
        this.Form.installDate.reset();
        this.Form.inspEndtime.reset();
        this.Form.inspStarttime.reset();
      }
      this.setInstallTime();
      this.getInspectorname(true);

      this.PageLoaders = false;

      if(this.schdulereplace)
      {
        this.Form.vehiclenumber.clearValidators();
        this.Form.vehiclenumber.updateValueAndValidity();
      }

    });
  }

  patchdates(value) {
    let start = new Date();
    let strattime = moment(start).format('YYYY-MM-DD').toString() + ' ' + moment(value).format('HH:mm:00').toString();
    return strattime;
  }
  formvalidated() {
    this.deviceForm = this.formBuilder.group({
      registrationpk : ['',Validators.required],
      applicatiomainpk:['',Validators.required],
      offtype: ['', Validators.required],
      brancheng: ['', ''],
      ownName: ['', Validators.required],
      ownNameArb: ['', Validators.required],
      crNumber: ['', Validators.required],
      gm_emailid: ['',''],
      gm_mobnum: ['', ''],
      vehiclenumber: ['', [Validators.required, Validators.pattern("^[0-9]+-[a-zA-Z]+$")]],
      chassNumber: ['', Validators.required],
      ivmsdevicemodel: ['', Validators.required],
      softVersion: ['', ''],
      vechicelmanufact: ['', Validators.required],
      odometer: ['', Validators.required],
      deviceserial: ['', Validators.required],
      deviceimei: ['', Validators.required],
      vehiclecat: ['', Validators.required],
      vechicletype: ['', Validators.required],
      devfatigsysmdl: ['', ''],
      devfatigsysnum: ['', ''],
      simnmber: ['', Validators.required],
      simprovider: ['', Validators.required],
      simproviderother: ['', Validators.required],
      primaryspeed: ['', Validators.required],
      secondaryspeed: ['', Validators.required],
      speedlimit: ['', Validators.required],
      vehiclefleet: ['', Validators.required],
      modelYear: ['', Validators.required],
      ropRegister: ['', Validators.required],
      ropRegisterString: ['', Validators.required],
      installDate: ['', Validators.required],
      inspStarttime: ['', Validators.required],
      inspEndtime: ['', Validators.required],
      installDateString: ['', Validators.required],
      inspStarttimeString:['',Validators.required],
      inspEndtimeString:['',Validators.required],
      installName: ['', Validators.required],
      isschedule:['',''],
      isedit:['','']
    })

  }

  setcrnumber(data, type) {
    if (data) {
      if (type == 1) {
        this.Form.ownNameArb.setValue(data.name_ar);
      }
      else {
        this.Form.ownName.setValue(data.name_en);
      }
      this.Form.crNumber.setValue(data.crnumber);
    }
    else {
      this.Form.crNumber.setValue(null);
      if (type == 1) {
        this.Form.ownNameArb.setValue(null);
      }
      else {
        this.Form.ownName.setValue(null);
      }
    }

  }

  getpreviouslist(respdata, type) {
    let searchData = respdata;

    if (searchData != null) {
      this.setcrnumber(null, type);
      if (searchData.length >= 3 && searchData.length != null) {
        this.rasService.getPreviousOwnerList(type, searchData).subscribe(data => {
          if (data['data'].data) {
            this.ownerlist = data['data'].data;
            console.log(this.ownerlist);
          }
        })
      }
    }
    else {
      this.setcrnumber(null, type);
    }

  }


  setInstallTime() {
    this.setIspectionDate(this.Form.installDate.value);
    this.setstarttime(this.Form.inspStarttime.value);
    this.setendtime(this.Form.inspEndtime.value);
  }

  setIspectionDate(value) {

    let assessmentdate = moment(value).format('YYYY-MM-DD').toString();
    this.Form.installDateString.setValue(assessmentdate);

  }
  setstarttime(value) {

    if (this.Form.installDateString.value) {
      let timeStart = moment(value).format('HH:mm:00').toString();
      this.Form.inspStarttimeString.setValue(this.Form.installDateString.value + ' ' + timeStart);

    }

  }
  setendtime(value) {
    if (this.Form.installDateString.value) {
      let timeEnd = moment(value).format('HH:mm:00').toString();
      this.Form.inspEndtimeString.setValue(this.Form.installDateString.value + ' ' + timeEnd);
    }

  }

  getData(data) {
    this.modelyear = data;
  }
  Deviceregister() {
    console.log(this.deviceForm.value)
    if (this.editvehicle == true) {
      this.Form.installDate.clearValidators();
      this.Form.installDate.updateValueAndValidity();

    }
    if (this.Form.simprovider.value == 'other' ) {
      this.Form.simprovider.clearValidators();
      this.Form.simproviderother.setValidators([Validators.required]);
      this.Form.simprovider.updateValueAndValidity();
      this.Form.simproviderother.updateValueAndValidity();
    }
    else
    {
      this.Form.simproviderother.clearValidators();
      this.Form.simprovider.setValidators([Validators.required]);
      this.Form.simprovider.updateValueAndValidity();
      this.Form.simproviderother.updateValueAndValidity();
    }
  
    if (this.Form.offtype.value == 2) {
      this.Form.brancheng.setValidators([Validators.required]);
    }
    else {
      this.Form.brancheng.reset();
      this.Form.brancheng.setValidators(null);
    }
    this.Form.brancheng.updateValueAndValidity();
    if (this.deviceForm.valid ) {
        let conform = this.i18n('Do you want to confirm submission of the Vehicle Registration Form?');
     if(this.editvehicle == true){
      conform = this.i18n('Do you want to confirm updating the Vehicle Registration Form?');
     }
     if(this.schdulereplace == true){
      conform = this.i18n('Do you want to confirm submission for Device Replacement?');
     }
      
        swal({
          title: conform,
          text: '',
          icon: 'warning',
          buttons: [this.i18n('No'), this.i18n('Yes')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {   
            this.submitData(this.deviceForm.value);
           
          }
          else {
            this.submitData(this.deviceForm.value);

          }
        });
       
      return;
      this.deviceForm.enable();


      this.resetform();


      this.Vehiclelist();

    } else {

      this.focusInvalidInput(this.deviceForm)
    }
    //  this.addandupdate.addbutton();
  }

  submitData(formvalue) {
    this.PageLoaders = true;
    this.ivmsService.saveDeviceVehicleDtls(formvalue).subscribe(data => {
      this.PageLoaders = false;

      if (data.data.status == 1) {

        this.deviceForm.reset();
        this.Vehiclelist();
        let conform = this.i18n('Vehicle Registration Form Submitted Successfully.');
        if(this.editvehicle == true) {  
        conform = this.i18n('Vehicle Registration Form Updated Successfully.');

        }
        // if(this.editvehicle == true) {
        // conform = this.i18n('Vehicle Registration Form Updated Successfully.');

        // }
        if(!this.schdulereplace) {
          swal({
            title: conform,
            text: '',
            icon: 'success',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          })
        }
        else {
          this.toastr.success(this.i18n('The Vehicle Registration form is submitted for Device Replacement.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }
      } else {
        swal({
          title: this.i18n('There was a problem while Registering Vehicle.'),
          text: data['data'].msg,
          icon: 'warning',
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        })
      }

    });
  }

  resetform() {
    this.deviceForm.controls['offtype'].reset();
    this.deviceForm.controls['brancheng'].reset();
    this.deviceForm.controls['ownName'].reset();
    this.deviceForm.controls['ownNameArb'].reset();
    this.deviceForm.controls['crNumber'].reset();
    this.deviceForm.controls['vehiclenumber'].reset();
    this.deviceForm.controls['chassNumber'].reset();
    this.deviceForm.controls['ivmsNumber'].reset();
    this.deviceForm.controls['speedlimit'].reset();
    this.deviceForm.controls['vehiclecat'].reset();
    this.deviceForm.controls['fleetNumber'].reset();
    this.deviceForm.controls['roadType'].reset();
    this.deviceForm.controls['ropRegister'].reset();
    this.deviceForm.controls['modelYear'].reset();
    this.deviceForm.controls['inspectionDate'].reset();
    this.deviceForm.controls['inspectinstallNameorName'].reset();
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
  get Form() { { return this.deviceForm.controls; } }

  cancle() {
    if (this.deviceForm.touched) {
      let text = this.i18n('Do you want to cancel submitting this Vehicle Registration Form?');
      if(this.editvehicle)
      {
        text = this.i18n('Do you want to cancel updating this Vehicle Registration Form?');
      }
      if(this.schdulereplace)
      {
        text = this.i18n('Do you want to cancel the submission of Vehicle Registration form for Device Replacement?');
      }
      swal({
        title: text,
        text: this.i18n('If yes, any unsaved data will be lost.'),
        icon: 'warning',
        buttons: [this.i18n('No'), this.i18n('Yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.deviceForm.reset();
          this.Vehiclelist();
          this.addandupdate.cancel()
          let caltext = this.i18n('This Vehicle Registration Form is Cancelled.');
          if(this.editvehicle)
          {
            caltext = this.i18n('This Vehicle Registration Form is Cancelled.');
          }
          if(this.schdulereplace)
          {
            caltext = this.i18n('This schedule device replacemnt Form is Cancelled.');
          }
         if(!this.schdulereplace) {
          swal({
            title: caltext,
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          })
         } else {
          this.toastr.warning((caltext), ''), {
            timeOut: 2000,
            closeButton: false,
          };
         }
        }
      });
       
    }
    else {
      this.deviceForm.reset();
      this.Vehiclelist();
      this.addandupdate.cancel()
    }

  }
  Vehiclelist() {
    if (this.stktype == 1) {
      this.router.navigate(['/manageivms/ivmslist']);
    }
    else{
      this.router.navigate(['/manageivms/ivmscentrelist']);
    }
    
  }
  statustype(value) {
    if (value == 1) {
      this.branchoffice = false;
      this.deviceForm.controls.brancheng.reset();
    }
    else if (value == 2) {
      this.branchoffice = true;
    }
  }

  checkvehicle(): boolean {
    
    this.ivmsService.checkVehicleRegistered(this.Form.vehiclenumber.value, this.regpk).subscribe(data => {
      if (data['data'].status == 2) {
        let response = data.data.available;
        

        if (response.status != 3 && response.status != 8) {
          this.inothercompanyinspection();
          this.deviceForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });

        }
        // else if (response.status == 3 && (response.nearing == 1 || response.expired == 1)) {

        //   swal({
        //     title: this.i18n('This Vehicle already has a valid sticker, and we will accept it as a renewal form, Click on Proceed to proceed with the renewal process.'),
        //     text: '',
        //     icon: 'warning',
        //     buttons: [this.i18n('Proceed'), this.i18n('Cancel')],
        //     dangerMode: true,
        //     className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        //     closeOnClickOutside: false
        //   }).then((willGoBack) => {
        //     if (willGoBack) {
        //       this.deviceForm.controls['vehiclenumber'].reset();

        //     }
        //     else {

        //       // this.Form.isrenewal.setValue(true);
        //       this.Form.vehiclenumber.setErrors(null);
        //       this.renewchasisnumber = response.chasis;
        //       this.getVehicleRegDtlsByVclPk(this.security.encrypt(response.vehiclepk), true);


        //     }
        //   });


        // }
        else if (response.status == 3) {
          swal({
            title: this.i18n('This vehicle is already Registered with the following Centre "' + response.centre + '"'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.deviceForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });
        }
        else if (response.status == 8) {
          swal({
            title: this.i18n('The Inspection for this particular Vehicle was conducted at the following Centre "' + response.centre + '", and it was Rejected.'),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.deviceForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });
        }

      }
      else {
        swal({
          title: this.i18n('This vehicle is already Registered with your Centre.'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('Ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.deviceForm.controls['vehiclenumber'].setErrors({ alreadyavailable: true });
      }

    });
    return true;
  }

  inothercompanyinspection() {
    swal({
      title: this.i18n('This Vehicle Registration Number is already registered with another Centre for Device Installation.'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    });
  }

  checkByType(value: any, contorlName: string, regpk = '1') {

    switch (contorlName) {
      case 'vehiclenumber':
        if(!this.schdulereplace)
        {

        this.ivmsService.checkVehicleNum(value, regpk).subscribe(data => {
          if (data['data'].available && this.Form.vehiclenumber.valid) {
            if (this.checkvehicle()) {
              return false;
            }
          }
          else {
            // this.Form.isrenewal.setValue(null);
            // this.renewchasisnumber = null;
            this.checkByType(this.Form.chassNumber.value, 'chassNumber');

          }
        });
      }
        break;
      case 'chassNumber':
        if(!this.schdulereplace)
        {
        this.ivmsService.checkChassNum(value, regpk).subscribe(data => {
          if (data['data'].available) {

            this.deviceForm.controls[contorlName].markAsTouched();
            this.deviceForm.controls[contorlName].setErrors({ alreadyavailable: true });

            if (this.renewchasisnumber == this.Form.chassNumber.value) {
              this.deviceForm.controls[contorlName].setErrors(null);
            }
            return false;
          }

        });
      }
        break;
    }
  }

  getTechnicalEvalutionCentres() {
    let technical = false;
    this.mainofficeappl = false;
    this.rasService.getTechnicalEvalutionCentres(5).subscribe(response => {
      if (response.data.status == 1) {

        this.technicalEvalutionCentrelist = response.data.data;
        console.info(this.technicalEvalutionCentrelist)
        this.technicalEvalutionCentrelist.forEach(z => {
          if (z.regpk == this.regpk) {

            this.Form.registrationpk.setValue(this.regpk);
            this.Form.applicatiomainpk.setValue(z.appmainpk);

            this.mainoffappmainPk = z.appmainpk;
            technical = true;
            this.mainofficeappl = true;
            // if (z.isOverdue == 1) {
            //   this.mainoffappmainPk = null;
            //   this.issuspended = z.issuspended;
            //   this.isoverdue = z.isOverdue;

            // }
            if (this.editvehicle == true) {
              this.getVehicleRegDtlsByVclPk(this.devicePk);
            }
            if (this.schdulereplace == true) {
              
              this.getVehicleRegDtlsByVclPk(this.devicePk);
            }

          }

        });
        this.getBranchlist(this.regpk);
        this.PageLoaders = false;
      }
      else {

        this.technicalEvalutionCentrelist = [];
        swal({
          title: this.i18n('No Centres Found'),
          text: '',
          icon: 'warning',
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.Vehiclelist();
      }

    });



    console.log(this.mainofficeappl)

  }

  getBranchlist(regpk) {
    let encregpk = this.security.encrypt(regpk);
    this.rasService.getBranchlistbyregpk(encregpk,5).subscribe(response => {
      if (response.data.status == 1) {
        this.branchlist = response.data.data;
      }
      else {
        this.branchlist = [];
      }

    })
  }

  resetcategory() {
    this.deviceForm.controls['vehiclecat'].reset();
  }
  resetsubcategory() {
    this.deviceForm.controls['vechicletype'].reset();
  }
  resetdeviceinfo() {
    this.deviceForm.controls['ivmsdevicemodel'].reset();
    this.deviceForm.controls['softVersion'].reset();
  }
  resetinspector() {
    this.deviceForm.controls['installName'].reset();
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
        this.getDeviceInfo(z.appmainpk);

      }
    });
  }


  getDeviceInfo(value,pk=null) {
    if (value != undefined) {
      let encregpk = this.security.encrypt(value);
      this.devicemodelnolist = [];
      this.ivmsService.getDeviceInfoByAppPk(encregpk,pk).subscribe(response => {
        if (response.data.status == 1) {
          this.devicemodelnolist = response.data.data;
          if (this.Form.ivmsdevicemodel.value) {
            this.getInspectorname(true);
          }
        }
        else {
          this.devicemodelnolist = [];
          swal({
            title: this.i18n('No Device Found'),
            text: '',
            icon: 'warning',
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.resetdeviceinfo();
        }

      });
    }
  }

  updateSftwVersion(value)
  {
    this.Form.softVersion.setValue(null);
    this.devicemodelnolist.forEach(z => {
      if (z.devicePk === value) {
        this.Form.softVersion.setValue(z.softversion);
      }

    });
  }

  getVehicleCat(value) {
    if (value != undefined) {
      let encregpk = this.security.encrypt(value);
      this.categoryList = [];
      this.ivmsService.getVehicleCategoryIVMS().subscribe(response => {
        if (response.data.status == 1) {
          this.categoryList = response.data.data;
          // if (this.Form.vehiclecat.value) {
          //   this.getInspectorname(true);
          // }
        }
        else {
          this.categoryList = [];
          swal({
            title: this.i18n('No Categories Found'),
            text: '',
            icon: 'warning',
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.resetcategory();
        }

      });
    }
  }

  getvehiclesubcatList(value)
  {
    
    if (value != undefined) {
      let encCatPk = this.security.encrypt(value);
      this.subcategoryList = [];
      this.ivmsService.getvehiclesubcatList(encCatPk).subscribe(response => {
        if (response.data.status == 1) {
          this.subcategoryList = response.data.data;
          
        }
        else {
          this.subcategoryList = [];
          swal({
            title: this.i18n('No Sub Categories Found'),
            text: '',
            icon: 'warning',
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.resetsubcategory();
        }

      });
    }
  }

  

  getInspectorname(edit = false) {
    this.inspectorlist = [];
    this.setInstallTime();
    console.log(this.Form.ivmsdevicemodel.valid , this.Form.applicatiomainpk.valid , this.Form.registrationpk.valid , this.Form.installDate.valid , this.Form.inspStarttime.valid , this.Form.inspEndtime.valid)
    if (this.Form.ivmsdevicemodel.valid && this.Form.applicatiomainpk.valid && this.Form.registrationpk.valid && this.Form.installDate.valid && this.Form.inspStarttime.valid && this.Form.inspEndtime.valid) {
      let body = JSON.stringify({
        registrationpk: this.security.encrypt(this.deviceForm.controls['registrationpk'].value),
        applicatiomainpk: this.security.encrypt(this.deviceForm.controls['applicatiomainpk'].value),
        ivmsdevicemodel: this.security.encrypt(this.deviceForm.controls['ivmsdevicemodel'].value),
        date: this.security.encrypt(this.deviceForm.controls['installDateString'].value),
        startTime: this.security.encrypt(this.deviceForm.controls['inspStarttimeString'].value),
        endTime: this.security.encrypt(this.deviceForm.controls['inspEndtimeString'].value),
        ifedit: edit,
      });
      this.ivmsService.getInstallationTechnician(body).subscribe(response => {
        if (response.data.status == 1) {
          this.inspectorlist = response.data.data;
        }
        else {
          this.inspectorlist = [];
          swal({
            title: this.i18n('There is no Installer available at the Centre.'),
            text: '',
            icon: 'warning',
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          });
          this.resetinspector();

        }

      });
    }

  }



  selectOffice(value) {
    if (value == 1) {
      if (!this.mainoffappmainPk && (this.isoverdue == 1 || this.issuspended == 1)) {
        let text;

        if (this.isoverdue == 1) {
          text = this.i18n("A Vehicle cannot be registered for an inspection in the selected Centre's Location because the Royalty Fee Payment is Overdue.");
        }
        else if (this.issuspended == 1) {
          text = this.i18n("A Vehicle cannot be registered for this Centre as the Centre Certification has been Suspended.");
        }

        swal({
          title: text,
          text: '',
          icon: 'warning',
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.Form.offtype.setValue(null);
        this.Form.brancheng.setValue(null);
        this.Form.brancheng.setValidators(null);
      }
      else {
        this.getVehicleCat(this.mainoffappmainPk);
        if(!this.schdulereplace)
        {
          this.getDeviceInfo(this.mainoffappmainPk);
        }
        
        this.Form.applicatiomainpk.setValue(this.mainoffappmainPk);
      }

    }
    else {
      if (this.branchappmainPk && this.branchappmainPk != undefined) {
        this.getVehicleCat(this.branchappmainPk);
        if(!this.schdulereplace)
        {
          this.getDeviceInfo(this.branchappmainPk);
        }
        this.Form.applicatiomainpk.setValue(this.branchappmainPk);
      }

    }
  }

  selectedBranchDtl(value) {
    this.branchlist.forEach(z => {

      if (z.appmainpk === value) {
        this.Form.applicatiomainpk.setValue(z.appmainpk);
        this.branchappmainPk = z.appmainpk;
        if (z.issuspended == 1 || z.isOverdue == 1) {
          this.branchappmainPk = null;
          if (!this.branchappmainPk) {

            let suspended = this.i18n("A Vehicle cannot be registered for this Centre as the Centre Certification has been Suspended.");
            let overdue = this.i18n("A Vehicle cannot be registered for an inspection in the selected Centre's Location because the Royalty Fee Payment is Overdue.");

            var text = z.issuspended == 1 ? suspended : overdue;
            swal({
              title: text,
              text: '',
              icon: 'warning',
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            });
            this.Form.offtype.setValue(null);
            this.Form.brancheng.setValue(null);
            this.Form.brancheng.setValidators(null);
          }
        }
        this.selectOffice(2);
      }

    });

  }

  getmasterlist() {
    // this.rasService.getmasterlistbyType(16).subscribe(response => {
    //   if (response.data.status == 1) {
    //     this.roadtypeList = response.data.data.list;

    //   }
    //   else {
    //     this.roadtypeList = [];
    //   }
    // });
    this.rasService.getmasterlistbyType(17).subscribe(response => {
      if (response.data.status == 1) {
        this.manufaturersList = response.data.data.list;

      }
      else {
        this.manufaturersList = [];
      }
    });
    this.rasService.getmasterlistbyType(18).subscribe(response => {
      if (response.data.status == 1) {
        this.simproviderList = response.data.data.list;

      }
      else {
        this.simproviderList = [];
      }
    });
  }
  parseDate(ctrlValue: any, format: any): Date {
    const date = new Date(ctrlValue);
    return date;
  }

  checkYear(value) {
    let currentYear = moment().format('YYYY');
    if (Number(currentYear) < Number(value)) {
      this.Form.modelYear.setValue(null);
      this.Form.modelYear.setErrors({ futureYear: true })
    }
  }

  Verifier() {

    swal({
      title: this.i18n('This Vehicle Form has been moved to the Verifier.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.deviceForm.reset();
        this.Vehiclelist();
      }
    });
  }
  reject() {

    swal({
      title: this.i18n('This Vehicle Form has been Rejected.'),
      text: '',
      icon: 'warning',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.deviceForm.reset();
        this.Vehiclelist();
      }
    });
  }
  moved() {

    swal({
      title: this.i18n('This Vehicle Form has been moved to the Supervisor.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.deviceForm.reset();
        this.Vehiclelist();
      }
    });
  }
  sticker() {
    swal({
      title: this.i18n('The Sticker has been Issued for the Vehicle.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.deviceForm.reset();
        this.Vehiclelist();
      }
    });
  }
  movetoinspect() {
    swal({
      title: this.i18n('The Vehicle Form has been moved to the Inspector.'),
      text: '',
      icon: 'success',
      buttons: [false, this.i18n('Ok')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.deviceForm.reset();
        this.Vehiclelist();
      }
    });
  }

  checkreg() {
    //  if(localStorage.getItem('schedule') == 'scheduledevice') {
    //   this.viewForm = true;
    //  } else {
    //   this.viewForm = false;
    //  }
    //  this.localstorage.removeItem('schedule')
  }
}





