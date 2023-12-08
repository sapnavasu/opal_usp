import { Component, OnInit } from '@angular/core';
import {ViewEncapsulation } from '@angular/core';
import { MatTableDataSource } from '@angular/material/table';
export interface Element {
  modulename: string;
  requestedby: string;
  requested_to: string;
  requestor_mobileno: string;
  otprequested: string;
  otpenteredon: string;
  loginstatus: string;
}

export interface Updatevalues {
  fieldname: string;
  previousvalue: string;
  updatedvalue: string;
}

const ELEMENT_DATA: Element[] = [

  {
    modulename: "Payment - Renewal",
    requestedby: "Yogesh Yogi",
    requested_to: "Ahmed Al Badi Syed Khan",
    requestor_mobileno: "+968 984773322",
    otprequested: "31-10-2020  10:00",
    otpenteredon: "31-10-2020  10:30",
    loginstatus: "statuslogin",
  },
 
];

const Update_value: Updatevalues[] = [

  {
    fieldname: "Feild 1",
    previousvalue: "Previous Value -1",
    updatedvalue: "Previous Value 1",
  },
  {
    fieldname: "Feild 2",
    previousvalue: "Previous Value -2",
    updatedvalue: "Previous Value 2",
  },
  {
    fieldname: "Feild 3",
    previousvalue: "Previous Value -3",
    updatedvalue: "Previous Value 3",
  },
  {
    fieldname: "Feild 4",
    previousvalue: "Previous Value -4",
    updatedvalue: "Previous Value 4",
  },
 
];
@Component({
  selector: 'app-temporaryaudittrail',
  templateUrl: './temporaryaudittrail.component.html',
  styleUrls: ['./temporaryaudittrail.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class TemporaryaudittrailComponent implements OnInit {
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  updatevalue = new MatTableDataSource<Updatevalues>(Update_value);
  displayedColumns = [
    "module",
    "requested_by",
    "requested_to",
    "requestor_mobileno",
    "otp_requested",
    "otp_entered",
    "login_status",
  ];

  displayaudittrail = [
    "Field_Name",
    "Previous_Value",
    "Updated_Value",
  ];
  constructor() { }

  ngOnInit() {
  }

}
