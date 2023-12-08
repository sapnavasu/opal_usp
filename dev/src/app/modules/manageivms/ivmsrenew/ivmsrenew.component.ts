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
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { IvmsdeviceService } from '@app/services/ivmsdev.service';

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
  selector: 'app-ivmsrenew',
  templateUrl: './ivmsrenew.component.html',
  styleUrls: ['./ivmsrenew.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class IvmsrenewComponent implements OnInit {
  devicePk: string;
  i18n(key) {
    return this.translate.instant(key);
  }
  public vehiclpk: string;
  public inspectorlist: any;
  public stktype: any;
  public PageLoaders: boolean = false;
  public isfocalpoint: any;
  public useraccess: any;
  public createaccess: boolean;
  public fullPageLoader: boolean = false;
  public submitted = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public inspectionDate: FormGroup;
  constructor(private fb: FormBuilder,
    public toastr: ToastrService,
    public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,
    private security: Encrypt,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private localstorage: AppLocalStorageServices,
    private ivmsService: IvmsdeviceService,
    private activeRoute: ActivatedRoute,) { }

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
    this.PageLoaders = true;
    this.activeRoute.paramMap.subscribe((params: ParamMap) => {
      console.log(params);
      let pk = params.get('dev_id');
      this.devicePk = this.security.decrypt(pk);
      // this.getInspectorlistByVehiclPk(pk);
       setTimeout(() => {
         this.PageLoaders = false;
        
       }, 2000);
    })
    if (!this.createaccess && this.isfocalpoint == 2) {
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
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.PageLoaders = true;
          let data = {
            vehicleregPk: this.security.encrypt(this.devicePk),
            dateOfInsp: this.inspectionDate.controls['date_InspectString'].value,
            startTime: this.inspectionDate.controls['inspStarttimeString'].value,
            endTime: this.inspectionDate.controls['inspEndtimeString'].value,
            inspector: this.inspectionDate.controls['name_Inspect'].value,
            odometer: this.inspectionDate.controls['odometer'].value,

          }
          this.ivmsService.renewIvmsVehicleRegistration(data).subscribe(res => {
            if(res.data.status == 1)
            {
              this.toastr.success(this.i18n('The Vehicle Registration form is submitted for Certification Renewal.'), ''), {
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


  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }

  get Form() { { return this.inspectionDate.controls; } }

  cancle() {
    if (this.inspectionDate.touched) {
      swal({
        title: this.i18n('Do you want to cancel the submission of Vehicle Registration form for Certification Renewal?'),
        text: this.i18n('If yes, any unsaved data will be lost.'),
        icon: 'warning',
        buttons: [this.i18n('No'), this.i18n('Yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.inspectionDate.reset();
          this.Vehiclelist();
          this.toastr.warning(this.i18n('The submission of Vehicle Registration form for Certification Renewal is cancelled.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }
      });
    }
    else {
      this.inspectionDate.reset();
      this.Vehiclelist();
    }
  }

  Vehiclelist() {
    if (this.stktype == 2) {
      this.router.navigate(['manageivms/ivmscentrelist']);
    }
    else{
      this.router.navigate(['/manageivms/ivmslist']);
    }
   
  }

  getInstallerlistByVehiclPk()
  {
    this.setInspectionTime();

    console.log(this.Form.inspStarttime.valid ,  this.Form.inspEndtime.valid , this.Form.date_Inspect.valid)
    
    if(this.Form.inspStarttime.valid &&  this.Form.inspEndtime.valid && this.Form.date_Inspect.valid)
    {
      let pk = this.security.encrypt(this.devicePk);
      let body = JSON.stringify({
        pk:pk,
        date:this.security.encrypt(this.inspectionDate.controls['date_InspectString'].value),
        startTime:this.security.encrypt(this.inspectionDate.controls['inspStarttimeString'].value),
        endTime:this.security.encrypt(this.inspectionDate.controls['inspEndtimeString'].value),
      });
      this.ivmsService.getInstallerlistByVehiclPk(body).subscribe(res => {
        if (res.data.status == 1) {
          this.inspectorlist = res.data.data;
        }
        else {
          this.inspectorlist = [];
          swal({
            title: this.i18n('There is no Installer available at the Centre'),
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

}
