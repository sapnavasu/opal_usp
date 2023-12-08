import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, ParamMap, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ServiceVehiclemanagementService } from '../service-vehiclemanagement.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

export const MY_FORMATS = {
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

@Component({
  selector: 'app-inspectiondetials',
  templateUrl: './inspectiondetials.component.html',
  styleUrls: ['./inspectiondetials.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class InspectiondetialsComponent implements OnInit {
  vehiclpk: string;
  inspectorlist: any;
  stktype: any;
  PageLoaders: boolean = false;
  isfocalpoint: any;
  useraccess: any;
  createaccess: boolean;
  i18n(key) {
    return this.translate.instant(key);
  }
  public fullPageLoader: boolean = false;
  submitted = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public inspectionDate: FormGroup;
  constructor(private fb: FormBuilder, 
    public toastr: ToastrService,
    public router: Router,
    private formBuilder: FormBuilder, 
    private el: ElementRef, 
    private security:Encrypt,
    private translate: TranslateService, 
    private remoteService: RemoteService, 
    private cookieService: CookieService,
    private vehicleService : ServiceVehiclemanagementService,
    private localstorage:AppLocalStorageServices,
    private activeRoute:ActivatedRoute,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();

  locale: LocaleConfig = {
    format: 'DD-MM-YYYY',
  }
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  ngOnInit(): void {

    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    if (this.isfocalpoint == 2) {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      console.log(this.useraccess);
      this.SetUseraccess();
    }

   

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
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
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
    this.formvalidated();
    this.activeRoute.paramMap.subscribe((params: ParamMap) => {
      console.log(params);
      let pk = params.get('vcl_id'); 
      this.vehiclpk = this.security.decrypt(pk);   
      // this.getInspectorlistByVehiclPk(pk);
    })
    if(!this.createaccess &&  this.isfocalpoint == 2)
    {
      this.Vehiclelist();
    }

    
  }
  formvalidated() {
    this.inspectionDate = this.formBuilder.group({
      odometer: ['', Validators.required],
      date_Inspect: ['', Validators.required],
      date_InspectString: ['', Validators.required],
      name_Inspect: ['', Validators.required],
      inspStarttime: ['', Validators.required],
      inspEndtime: ['', Validators.required],
      inspStarttimeString: ['', Validators.required],
      inspEndtimeString: ['', Validators.required],
    })
  }
  
  Vehicleregister() {
    if (this.inspectionDate.valid) {
      swal({
        title: this.i18n('Do you want to confirm submission of the Vehicle Registration for Renewal?'),
        text: '',
        icon: 'warning',
        buttons: [this.i18n('No'), this.i18n('Yes')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.PageLoaders = true;
          let data = {
            vehicleregPk : this.security.encrypt(this.vehiclpk),
            dateOfInsp : this.inspectionDate.controls['date_InspectString'].value,
            startTime : this.inspectionDate.controls['inspStarttimeString'].value,
            endTime : this.inspectionDate.controls['inspEndtimeString'].value, 
            inspector : this.inspectionDate.controls['name_Inspect'].value, 
            odometer : this.inspectionDate.controls['odometer'].value, 
            
          }
          this.vehicleService.renewVehicleRegistration(data).subscribe(res => {
            if(res.data.status == 1)
            {
              this.toastr.success(this.i18n('Vehicle Registration Form Submitted Successfully for Renewal'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
              this.Vehiclelist();
            }
            else{
              swal({
                title: this.i18n('Unable to apply renewal'),
                text: '',
                icon: 'warning',
                dangerMode: true,
                className: this.dir =='ltr'?'swalEng':'swalAr',
                closeOnClickOutside: false
              });
            }
            this.PageLoaders = true;
    
          })
         
        }
      });
    } else {
      this.focusInvalidInput(this.inspectionDate)
    }
  }

  setInspectionTime() {
    this.setIspectionDate(this.Form.date_Inspect.value);
    this.setstarttime(this.Form.inspStarttime.value);
    this.setendtime(this.Form.inspEndtime.value);
  }

  setIspectionDate(value) {
    let assessmentdate = moment(value).format('YYYY-MM-DD').toString();
    this.Form.date_InspectString.setValue(assessmentdate);

  }
  setstarttime(value) {
    if (this.Form.date_InspectString.value) {
      let timeStart = moment(value).format('HH:mm:00').toString();
      this.Form.inspStarttimeString.setValue(this.Form.date_InspectString.value + ' ' + timeStart);

    }

  }
  setendtime(value) {
    if (this.Form.date_InspectString.value) {
      let timeEnd = moment(value).format('HH:mm:00').toString();
      this.Form.inspEndtimeString.setValue(this.Form.date_InspectString.value + ' ' + timeEnd);
    }

  }

  getInspectorlistByVehiclPk()
  {
    this.setInspectionTime();
    
    if(this.Form.inspStarttime.valid &&  this.Form.inspEndtime.valid && this.Form.date_Inspect.valid)
    {
      let pk = this.security.encrypt(this.vehiclpk);
      let body = JSON.stringify({
        pk:pk,
        date:this.security.encrypt(this.inspectionDate.controls['date_InspectString'].value),
        startTime:this.security.encrypt(this.inspectionDate.controls['inspStarttimeString'].value),
        endTime:this.security.encrypt(this.inspectionDate.controls['inspEndtimeString'].value),
      });
      this.vehicleService.getInspectorlistByVehiclPk(body).subscribe(res => {
        if (res.data.status == 1) {
          this.inspectorlist = res.data.data;
        }
        else {
          this.inspectorlist = [];
          swal({
            title: this.i18n('There is no Inspector available at the Centre'),
            text: '',
            icon: 'warning',
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          });
        }
      });
    }
  
    
  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        // console.log(key);
        if (invalidControl)
        {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  get Form() { { return this.inspectionDate.controls; } }
  cancle(){
    if(this.inspectionDate.touched) {
     swal({
      title: this.i18n('Do you want to cancel submitting this Vehicle Renew Form?'),
      text: this.i18n('If yes, any unsaved data will be lost.'),
       icon: 'warning',
       buttons: [this.i18n('No'), this.i18n('Yes')],
       dangerMode: true,
       className: this.dir =='ltr'?'swalEng':'swalAr',
       closeOnClickOutside: false
     }).then((willGoBack) => {
       if (willGoBack) {
         this.inspectionDate.reset();
         this.Vehiclelist();

       }
     });
       
   }
   else {
     this.inspectionDate.reset();
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

SetUseraccess() {
  let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Vehicle Inspection and Approval');

  if (this.useraccess[moduleid] && this.useraccess[moduleid][27].create == 'Y') {
    this.createaccess = true;
  }

}
}
