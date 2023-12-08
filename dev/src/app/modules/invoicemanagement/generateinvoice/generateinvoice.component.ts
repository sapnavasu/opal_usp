import { Component, ElementRef, OnInit, ViewChild, ViewEncapsulation, Input, Output, EventEmitter } from '@angular/core';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { PopoverDirective } from 'ngx-smart-popover';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Router } from '@angular/router';
import swal from 'sweetalert';
import { MomentDateAdapter, MAT_MOMENT_DATE_ADAPTER_OPTIONS, } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE, } from '@angular/material/core';
import { MatDatepicker } from '@angular/material/datepicker';
import * as _moment from 'moment';
import { default as _rollupMoment, Moment } from 'moment';

const moment = _rollupMoment || _moment;
export const MY_FORMATS = {
  parse: {
    dateInput: 'MMM YYYY',
  },
  display: {
    dateInput: 'MMM YYYY',
    monthYearLabel: 'MMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY',
  },
};

class DateClass {
  public getDate(x): moment.Moment {
      return moment(x);
  }
}
@Component({
  selector: 'app-generateinvoice',
  templateUrl: './generateinvoice.component.html',
  styleUrls: ['./generateinvoice.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', visibility: 'hidden' })),
    state('expanded', style({ height: '*', visibility: 'visible' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
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
export class GenerateinvoiceComponent implements OnInit {
  @ViewChild('picker') datepicker: MatDatepicker<any>;
  final: any;
  regenerate: boolean;
  previosmonthmoment: _moment.Moment;
  i18n(key) {
    return this.translate.instant(key);
  }
  public validationForm: FormGroup;
  @Input('invoiceplaceholder') invoiceplaceholder: any;
  public popoverIsOpen: any;
  @ViewChild('myPopover', { static: false }) pop: PopoverDirective;
  @Output() invoiceData = new EventEmitter();
  // @Output() formValue = new EventEmitter<any>();
  @Output() formValue: any = new EventEmitter<any>();
  currentDate = new Date();
  currentMonth = new Date();
  previousMonth: Date;
  previousMonthText = '';
  maxValueAssessment = new Date();
  minValueAssessment = new Date();
  maxValueDateRange = new Date();

  @Input()  setMonthandYear: number = 1;

  constructor(private formBuilder: FormBuilder, private remoteService: RemoteService, private appservice: ApplicationService,
    private translate: TranslateService, private route: Router,
    private cookieService: CookieService,
    private activatedRoute: ActivatedRoute, private el: ElementRef) {
      this.previousMonthandYear();
  }
  
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = 'ltr';
  ngOnInit(): void {
    this.getlastdayofmonth();
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
    this.validForm();
    this.validationForm.controls.selectDate.setValue(this.previosmonthmoment);
    this.chosenYearHandlers(moment(this.previosmonthmoment));
    this.chosenMonthHandlers(moment(this.previosmonthmoment));
  }

  validForm() {
    this.validationForm = this.formBuilder.group({
      selectDate: ['', Validators.required],
    })
  }

  get valid() {
    return this.validationForm.controls;
  }

  // cancel button
  close() {
    this.validationForm.controls.selectDate.setValue('');
    this.pop.hide();
  }

  onReady(event) {
    console.log(event);
  }
  // popover close and open
  togglePopover() {
    this.popoverIsOpen = !this.popoverIsOpen;
    this.previousMonthandYear()
    this.validationForm.controls.selectDate.setValue(this.previosmonthmoment);
    this.chosenYearHandlers(moment(this.previosmonthmoment));
    this.chosenMonthHandlers(moment(this.previosmonthmoment));
  }

  chosenYearHandlers(normalizedYear: Moment) {
    // this.validationForm.controls.selectDate.reset();
    const ctrlValue = this.validationForm.controls.selectDate.value || new DateClass(); 
    ctrlValue.set('year', normalizedYear.year());
    this.validationForm.controls.selectDate.setValue(ctrlValue);
  }

  chosenMonthHandlers(normalizedMonth: Moment) {
    const monthValue = this.validationForm.controls.selectDate.value;
    monthValue.month(normalizedMonth.month());
    this.validationForm.controls.selectDate.setValue(monthValue);
    this.datepicker?.close();

  }
  // submit button assessmentfee 
  submitForm() {
    if (this.validationForm.valid) {
      const selectDateValue = this.validationForm.value.selectDate;
      this.formValue.emit(selectDateValue);
      this.togglePopover();
      this.invoiceData.emit(true)
      setTimeout(() => {
        this.close();
      }, 1000);
    }else {
      this.focusInvalidInput(this.validationForm);
    }
  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        // console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  previousMonthandYear() {
    this.previousMonth = new Date(this.currentDate); 
    this.previousMonth.setMonth(this.currentDate.getMonth() - 1);
    const d = new DateClass();
     console.log(d.getDate(this.previousMonth));
     this.previosmonthmoment = d.getDate(this.previousMonth);
   
  }
  // ex if(want june){ this.setMonthandYear = 2} else if (want 3 month) {this.setMonthandYear = 3}
  getlastdayofmonth() {
    var date = new Date();
    var firstDay = new Date(date.getFullYear(), date.getMonth() - this.setMonthandYear, 1);
    var lastDay = new Date(date.getFullYear(), date.getMonth(),0); 
    this.maxValueAssessment =lastDay;
    this.minValueAssessment = firstDay;
   
  }

}

