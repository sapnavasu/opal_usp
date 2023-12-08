import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { MatDatepicker, MatDatepickerInputEvent } from '@angular/material/datepicker';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { Router, ActivatedRoute } from '@angular/router';
import { MomentDateAdapter, MAT_MOMENT_DATE_ADAPTER_OPTIONS, } from '@angular/material-moment-adapter';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';
const moment = _rollupMoment || _moment;

export const MY_FORMATS = {
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
export const YEAR_ONLY_FORMAT = {
  parse: {
    dateInput: 'YYYY',
  },
  display: {
    dateInput: 'YYYY',
    monthYearLabel: 'YYYY',
    dateA11yLabel: 'YYYY',
    monthYearA11yLabel: 'YYYY',
  },
};
class DateClass {
  public getDate(x): moment.Moment {
    return moment(x);
  }
}

@Component({
  selector: 'app-yearlypicker',
  templateUrl: './yearlypicker.component.html',
  styleUrls: ['./yearlypicker.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {
      provide: DateAdapter,
      useClass: MomentDateAdapter,
      deps: [MAT_DATE_LOCALE, MAT_MOMENT_DATE_ADAPTER_OPTIONS],
    },

    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class YearlypickerComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  previosmonthmoment: _moment.Moment;
  @ViewChild('picker') datepicker: MatDatepicker<any>;
  validationForm: FormGroup;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  currentDate = new Date();
  currentMonth = new Date();
  previousMonth: Date;
  previousMonthText = '';
  maxValueAssessment = new Date();
  minValueAssessment = new Date();
  maxValueDateRange = new Date();
  @Output() emidData = new EventEmitter();
  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService, private remoteService: RemoteService, private cookieService: CookieService,
    public routeid: ActivatedRoute
  ) { }
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
    this.validationForm = this.formBuilder.group({
      date: ['', Validators.required],
    })
  }
   
  get form() {
    return this.validationForm.controls
  }
  chosenYearHandler(normalizedYear: Moment, dp: any) {
    const ctrlValue = this.validationForm.controls.date.value;
    ctrlValue.year(normalizedYear.year());
    this.validationForm.controls.date.setValue(ctrlValue);
    dp.close();
    console.log(this.validationForm.controls.date.value, ctrlValue);
  }

  addbutton () {
    this.Vehicleregister()
  }
  Vehicleregister() {
    if(this.validationForm.valid) {
      this.emidData.emit(this.validationForm.value);
     setTimeout(() => {
      this.validationForm.controls.date.reset()
     }, 200);
    } else {
      $(".subMit").trigger("click");
    }
  }
  
   cancel() {
    setTimeout(() => {
      this.validationForm.controls.date.reset()
     }, 200);
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
}
