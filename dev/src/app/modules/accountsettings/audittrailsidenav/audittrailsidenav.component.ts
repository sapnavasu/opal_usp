import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import moment from 'moment';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import swal from 'sweetalert';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { MatTableDataSource } from '@angular/material/table';
export interface PeriodicElement {
  s_no: any;
  date_time: any;
  module: any;
}


const ELEMENT_DATA: any[] = [
  {
    sno: "1",
    datetime: "30-10-2020  10:00",
    modulename: "Contract Management System (CMS)",
  },
  {
    sno: "2",
    datetime: "30-10-2021  10:10",
    modulename: "Master Company Profile (MCP)",
  },
  {
    sno: "3",
    datetime: "30-10-2019  10:15",
    modulename: "Supplier Certification form (SCF)",
  },
];

@Component({
  selector: 'app-audittrailsidenav',
  templateUrl: './audittrailsidenav.component.html',
  styleUrls: ['./audittrailsidenav.component.scss'],
  animations: [SlideInOutAnimation,trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', visibility: 'hidden' })),
    state('expanded', style({ height: '*', visibility: 'visible' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None
})
export class AudittrailsidenavComponent implements OnInit {
  companydataview = [
    {profiletitle:"To be notified when user contacts from the external Profile",profilesubtitlte:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",status:"on"},
    {profiletitle:"To receive audit log on a weekly basis",profilesubtitlte:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",status:"off"},
  ];
  
  @Input('audittraillview') audittraillview: MatDrawer;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  expandedElement: PeriodicElement | null;
  columnsToDisplay = ['s_no','date_time','module'];
  animationState = 'out';
  public dateFilter: FormControl = new FormControl();
  selected2 = moment();
  public date: Date;
  locale: LocaleConfig = {
    customRangeLabel: ' - ',
    separator: ' to ',
    applyLabel: 'Apply',
    cancelLabel: 'Cancel',
    clearLabel: 'Clear',
    format:'DD-MM-YYYY',
    daysOfWeek: moment.weekdaysMin(),
    monthNames: moment.monthsShort(),
    firstDay: moment.localeData().firstDayOfWeek(),
  }
  constructor() { }

  ngOnInit(): void {
  }
  auditalert() {
    swal({
      title: "Do you want to cancel Audit Trail?",
      text: 'All the Data that you have entered will be lost.',
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.audittraillview.toggle();
      }
    });
    this.animationState = 'out';
  }

  audittraildropdown(divName: string) {
    if (divName === 'audittraillist') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  clearDatelogin(event) {
    event.stopPropagation();
    this.date = null;
    this.dateFilter.reset();
  }
}
