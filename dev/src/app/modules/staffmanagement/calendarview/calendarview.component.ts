import { Component, ChangeDetectionStrategy,TemplateRef,ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation, Injectable } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { CalendarDateFormatter, CalendarDateFormatterInterface, CalendarEvent,CalendarEventAction,CalendarEventTimesChangedEvent,CalendarEventTitleFormatter,CalendarView,DateFormatterParams, } from 'angular-calendar';
import { formatDate } from '@angular/common';
import { startOfDay, endOfDay,subDays,addDays,endOfMonth,isSameDay,isSameMonth,addHours} from 'date-fns';

@Injectable()
export class CustomEventTitleFormatter extends CalendarEventTitleFormatter {
  month(events: CalendarEvent): string {
    return `${events.title}`;
  }
}
class CustomDateFormatter extends CalendarDateFormatter {
  public monthViewColumnHeader({date, locale}: DateFormatterParams): string {
    return formatDate(date, 'EEE', locale); 
  }

}

@Component({
  selector: 'app-calendarview',
  templateUrl: './calendarview.component.html',
  styleUrls: ['./calendarview.component.scss'],
  encapsulation: ViewEncapsulation.None,
  changeDetection: ChangeDetectionStrategy.OnPush,
  providers: [
    {
      provide: CalendarEventTitleFormatter,
      useClass: CustomEventTitleFormatter
    },
    {
    provide: CalendarDateFormatter,
    useClass: CustomDateFormatter
  },
  
],
})

export class CalendarviewComponent implements OnInit  {
  i18n(key) {
    return this.translate.instant(key);
  } 
  public monthText: any;
  public buttonName: string = 'View Previous Month';
  public viewPerivious: boolean = true;
  public activeDayIsOpen: boolean = false;
  viewDate = new Date();
  view: CalendarView = CalendarView.Month;
  dayStartHour: number = 10;
  dayEndHour: number = 17;
  public dateWishView = false;
  public selectedDay: number;
  public selectedMonth: string;
  public selectedDates: string;
  public selectedYear: number;
  public timeDetails: string;
  public eventDetails: CalendarEvent<any>[];
  public tableplaceholder: boolean = false;
  @Output() setData: any = new EventEmitter<any>();
  constructor(private eventTitleFormatter: CalendarEventTitleFormatter, public router: Router,private translate: TranslateService,private remoteService: RemoteService,private cookieService: CookieService,protected security: Encrypt) {
   
   }
   
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
  }
  // month view btn
  monthSelectButton() {
    this.viewPerivious = !this.viewPerivious;
    if(this.viewPerivious == true) {
      this.buttonName = 'View Previous Month'
    } else {
      this.buttonName = 'View Current Month'
    }
  }

  // patch start date and end date
  events: CalendarEvent[] = [
    {
      id: '1',
      start: new Date('2023-07-17T10:00:00'),
      end: new Date('2023-07-17T12:00:00'),
      title: '10:30AM - 11:30AM',
      cssClass: 'availableColor',
    },
    {
      id: '1',
      start: new Date('2023-07-17T10:00:00'),
      end: new Date('2023-07-17T12:00:00'),
      title: '10:30AM - 11:30AM',
      cssClass: 'notColor',
    },
    {
      id: '1',
      start: new Date('2023-08-17T09:00:00'),
      end: new Date('2023-08-17T12:00:00'),
      title: '10:30AM - 11:30AM',
      cssClass: 'availableColor',
    },
    {
      id: '1',
      start: new Date('2023-08-17T09:00:00'),
      end: new Date('2023-08-17T09:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'bookingColor',
    },
    {
      id: '1',
      start: new Date('2023-08-02T07:00:00'),
      end: new Date('2023-08-02T07:00:00'),
      title: 'Holiday',
      cssClass: 'holidayColor',
    },
    {
      id: '1',
      start: new Date('2023-08-07T02:00:00'),
      end: new Date('2023-08-07T02:00:00'),
      title: 'Holiday',
      cssClass: 'holidayColor',
    },
   
    {
      id: '1',
      start: new Date('2023-08-15T09:00:00'),
      end: new Date('2023-08-15T10:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'bookingColor',
    }, 
    {
      id: '1',
      start: new Date('2023-08-01T09:00:00'),
      end: new Date('2023-08-01T10:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'bookingColor',
    },
    {
      id: '1',
      start: new Date('2023-08-09T010:00:00'),
      end: new Date('2023-08-09T110:00:00'),
      title: '01:30AM - 02:30AM',
      cssClass: 'availableColor',
    },
    {
      id: '1',
      start: new Date('2023-08-09T11:00:00'),
      end: new Date('2023-08-09T12:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'bookingColor',
    },  {
      id: '1',
      start: new Date('2023-08-09T12:00:00'),
      end: new Date('2023-08-09T01:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'availableColor',
    },  {
      id: '1',
      start: new Date('2023-08-09T01:00:00'),
      end: new Date('2023-08-09T02:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'bookingColor',
    },  {
      id: '1',
      start: new Date('2023-08-09T09:00:00'),
      end: new Date('2023-08-09T10:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'notColor',
    },  {
      id: '1',
      start: new Date('2023-08-09T22:00:00'),
      end: new Date('2023-08-09T23:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'bookingColor',
    },  {
      id: '1',
      start: new Date('2023-07-17T22:00:00'),
      end: new Date('2023-07-17T23:00:00'),
      title: '11:30AM - 12:30AM',
      cssClass: 'availableColor',
    }, 
  ];

  // click date to open details
  dayClicked({ date, events }: { date: Date; events: CalendarEvent[] }): void {
    if(events.length > 2) {
      this.selectedDay = date.getDate();
    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    this.selectedDates = dayNames[date.getDay()]
        const monthNames = [
      'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December'
    ];
    this.selectedMonth = monthNames[date.getMonth()];
    this.selectedYear = date.getFullYear();
    this.dateWishView = true;
    this.eventDetails = events;
    this.setData.emit(this.dateWishView);
    console.log(this.eventDetails)
    }
  }
   
  backToview() {
    this.dateWishView = false;
    this.setData.emit(this.dateWishView);
  }
}

