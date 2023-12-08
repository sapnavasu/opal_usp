import { Component, OnInit, Input } from '@angular/core';
import swal from 'sweetalert';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { MatTableDataSource } from '@angular/material/table';
export interface Element {
  module: string;
  requestedby: string;
  requested_to: string;
  requestor_mobileno: string;
  otprequested: string;
  otpenteredon: string;
  loginstatus: string;
}

const ELEMENT_DATA: Element[] = [

  {
    module: "Payment",
    requestedby: "Yogesh Yogi",
    requested_to: "Ahmed Al Badi Syed Khan",
    requestor_mobileno: "+968 984773322",
    otprequested: "31-10-2020  10:00",
    otpenteredon: "31-10-2020  10:30",
    loginstatus: "statuslogin",
  },
  {
    module: "Payment",
    requestedby: "Yogesh Yogi",
    requested_to: "Ahmed Al Badi Syed Khan",
    requestor_mobileno: "+968 984773322",
    otprequested: "28-10-2020  10:10",
    otpenteredon: "30-10-2020  21:00",
    loginstatus: "statuslogin",
  },
  {
    module: "GCC Tenders Subscription",
    requestedby: "Melunie Singh",
    requested_to: "Khalsa Al Aghbari",
    requestor_mobileno: "+968 662355201",
    otprequested: "30-09-2020  22:00",
    otpenteredon: "30-09-2020  22:30",
    loginstatus: "expired",
  },
  {
    module: "Payment",
    requestedby: "Melunie Singh",
    requested_to: "Khalsa Al Aghbari",
    requestor_mobileno: "+968 662355201",
    otprequested: "28-08-2020  13:00",
    otpenteredon: "28-08-2020  14:30",
    loginstatus: "statuslogin",
  },
];

@Component({
  selector: 'app-trackhistorylistview',
  templateUrl: './trackhistorylistview.component.html',
  styleUrls: ['./trackhistorylistview.component.scss'],
  animations: [SlideInOutAnimation],
})
export class TrackhistorylistviewComponent implements OnInit {
  @Input('trackhistorydrawer') trackhistorydrawer: MatDrawer;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  animationState2 = 'out';
  displayedColumns = [
    "module",
    "requested_by",
    "requested_to",
    "requestor_mobileno",
    "otp_requested",
    "otp_entered",
    "login_status",
    "Action",
  ];
  constructor() { }

  ngOnInit() {
  }
  trackhistorylistalert() {
    swal({
      title: "Do you want to cancel creating this Track History of Temporary Login",
      text: 'Are you sure you want to cancel? If yes all the data will be lost',
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.trackhistorydrawer.toggle();
      }
    });
    this.animationState2 = 'out';
  }
  trackhistorylistdropdown(divName: string) {
    if (divName === 'trackhistorylist') {
      this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
  }
}
