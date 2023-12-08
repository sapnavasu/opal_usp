import { Component, ChangeDetectionStrategy, TemplateRef, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation, Injectable } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { CalendarDateFormatter, CalendarDateFormatterInterface, CalendarEvent, CalendarEventAction, CalendarEventTimesChangedEvent, CalendarEventTitleFormatter, CalendarView, DateFormatterParams, } from 'angular-calendar';
import { formatDate } from '@angular/common';
import { TrainingStaffService } from '@app/services/trainingStaff.service';
import { TechnicalstaffService } from '@app/services/technicalStaff.service';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

@Injectable()
export class CustomEventTitleFormatter extends CalendarEventTitleFormatter {
  month(events: CalendarEvent): string {
    return `${events.title}`;
  }
}
class CustomDateFormatter extends CalendarDateFormatter {
  public monthViewColumnHeader({ date, locale }: DateFormatterParams): string {
    return formatDate(date, 'EEE', locale);
  }

}

@Component({
  selector: 'app-approvalcalendarview',
  templateUrl: './approvalcalendarview.component.html',
  styleUrls: ['./approvalcalendarview.component.scss'],
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

export class ApprovalcalendarviewComponent implements OnInit {
  calenderResponse: any;
  StaffInfotmp: any;
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
  public bookId: string;
  public selectedYear: number;
  public timeDetails: string;
  public eventDetails: CalendarEvent<any>[];
  public tableplaceholder: boolean = false;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;
  @Input("data") data: any;
  @Input("technical") technical: any;
  @Output() setData: any = new EventEmitter<any>();
  constructor(private eventTitleFormatter: CalendarEventTitleFormatter,
    public toastr: ToastrService, public router: Router,
    private translate: TranslateService, private remoteService: RemoteService,
    private cookieService: CookieService, protected security: Encrypt,
    private localstorage: AppLocalStorageServices,
    private technicalStaff: TechnicalstaffService, private trainingstaff: TrainingStaffService, private activeroute: ActivatedRoute) {
    this.activeroute.queryParams.subscribe(params => {
      this.bookId = params['id'];
    });
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {

    this.useraccess = this.localstorage.getInLocal('uerpermission');
    console.log(this.useraccess, 'this.useraccess');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Staff Management');

    if (this.isfocalpoint == 1) {
      this.downloadaccess = true;
      this.readaccess = true;
      this.createaccess = true;
      this.updateaccess = true;
      this.deleteaccess = true;
    }
    let submodule = this.stktype == 1 ? 32 : 38;

    if (this.isfocalpoint == 2 && this.useraccess[moduleid] != undefined) {
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].download == 'Y') {
        this.downloadaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].read == 'Y') {
        this.readaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].create == 'Y') {
        this.createaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].update == 'Y') {
        this.updateaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].delete == 'Y') {
        this.deleteaccess = true;
      }
    }

    this.StaffInfotmp = this.data
    this.getbooklist();
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
    if (this.viewPerivious == true) {
      this.buttonName = 'View Previous Month'
    } else {
      this.buttonName = 'View Current Month'
    }
  }

  // patch start date and end date
  events: CalendarEvent[];


  // click date to open details
  dayClicked({ date, events }: { date: Date; events: CalendarEvent[] }): void {
    console.log(events.length);
    if (events.length > 0) {
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
    }
  }

  backToview() {
    this.dateWishView = false;
    this.setData.emit(this.dateWishView);
  }
  // Calender view
  getbooklist() {
    if (this.technical == true) {
      this.technicalStaff.calenderview(this.StaffInfotmp.staffinforepo_pk)
        .subscribe((data) => {
          var tempArr = [];
          data?.data.forEach((obj: any) => {
            tempArr.push(
              {
                id: obj?.appstaffscheddtls_pk,
                staffInfo: obj?.assd_appstaffinfotmp_fk,
                status_id: obj?.status_id,
                start: new Date(obj?.start),
                end: new Date(obj?.end),
                title: obj?.title,
                technical: true,
                rasvehicleregdtls_pk: obj?.rasvehicleregdtls_pk,
                cssClass: 'bookingColor',
              }
            )
          });
          this.events = tempArr;
          $(".cal-day-cell").trigger("click");
        });
    } else {
      this.trainingstaff.calenderview(this.StaffInfotmp.StaffInfotmp)
        .subscribe((data) => {
          var tempArr = [];
          data?.data.forEach((obj: any) => {
            tempArr.push(
              {
                id: obj?.appstaffscheddtls_pk,
                staffInfo: obj?.assd_appstaffinfotmp_fk,
                status_id: obj?.status_id,
                start: new Date(obj?.start),
                end: new Date(obj?.end),
                title: obj?.title,
                assd_date: obj?.assd_date,
                technical: false,
                cssClass: obj.cssClass,
                dtype: obj?.dtype,
                batchStatus: obj?.batchStatus
              }
            )
          });
          console.log(tempArr);
          
          this.events = tempArr;
          $(".cal-day-cell").trigger("click");
        });
    }
  }

  navigatebatch(pk, date) {
    let encregstaffinfotmppk = this.security.encrypt(pk);
    this.trainingstaff.getbatchids(pk, date).subscribe(res => {
      // this.disableSubmitButton = false;
      if (res.status == 200) {
        var batchpk = res.data.batchpk;
        this.router.navigate(['/batchindex/batchgridlisting'], { queryParams: { p: batchpk, t: 'fsgrid', d: date } });
      }
    });
  }

  edit(civil: any, id: any, staffpK: any, start: any, end: any,coursePk:any) {
    this.router.navigate(['/standardcourse/assessoravailability/edita'], { queryParams: { id: btoa(id), staffpK: btoa(staffpK) } });
    this.editbook(staffpK);
    localStorage.setItem('civil',btoa(civil))
    localStorage.setItem('course',btoa(coursePk))
  }
  editbook(staffpK: any) {
    this.trainingstaff.editBooking(staffpK).subscribe((data: any) => {
      if (data?.data?.status == true) {
        // this.toastr.success(data?.data?.message);
      } else {
        this.toastr.warning(data?.data?.message);
      }

    })
  }

  deleteBooking(id: any) {
    this.trainingstaff.deleteCalBooking(id).subscribe((data: any) => {
      if (data?.data?.status == true) {
        this.toastr.success(data?.data?.message);
        this.backToview();
        this.getbooklist();
      } else {
        this.toastr.warning(data?.data?.message);
      }

    })
  }
  // Update
  updateStatus(id: any, status: any) {
    this.trainingstaff.updateStatus(id, status).subscribe((data: any) => {
      if (data?.data?.status == true) {
        this.toastr.success(data?.data?.message);
        window.location.reload();
      } else {
        this.toastr.warning(data?.data?.message);
      }
    })
  }

  // Calender booked view Section on Technical center
  clickView(id) {
    let encregpk = this.security.encrypt(id);
    localStorage.setItem('civil', this.bookId)
    localStorage.setItem('schedule', '1')
    localStorage.removeItem('course')
    this.router.navigate(['/vehiclemanagement/vehicleinspectionstatus/view/bookdata'], { queryParams: { bc: 'spym', p: encregpk } });
  }
}