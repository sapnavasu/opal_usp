import { Component, Inject, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
@Component({
  selector: 'app-commonpopdesign',
  templateUrl: './commonpopdesign.component.html',
  styleUrls: ['./commonpopdesign.component.scss']
})
export class CommonpopdesignComponent implements OnInit {
  public expdate: any;
  public expdays: any;
  public beforeexpdays: any;
  public renewalstatus: any;
  public gracedays: any;
  public graceperiod:number = 10;
  public graceperiodend:number = 11;
  constructor(public dialogRef: MatDialogRef<CommonpopdesignComponent>, @Inject(MAT_DIALOG_DATA) public data: any, private router: Router) { }

  ngOnInit() {
    this.expdate = this.data.renewalDate;
    this.expdays = this.data.expdays;
    this.beforeexpdays = this.data.beforeexpdays;
    this.renewalstatus = this.data.renewalstatus;
    this.graceperiod = this.data.graceperiod;
    this.graceperiodend = this.data.graceperiodend;
    if(this.renewalstatus=='NE' || this.renewalstatus=='E' || this.renewalstatus=='D'){
      if(this.beforeexpdays){
        this.gracedays = (this.beforeexpdays==1)? 'Today is the last day to renew': this.beforeexpdays + ' Days';
      }else{
        let gracedaysleft = Number(this.graceperiodend - this.expdays);
        this.gracedays = gracedaysleft + ' of ' + this.graceperiod + ' Days'; 
      }
    }
  }
  closedialog(): void {
    this.dialogRef.close();
  }

  goTo() {
    this.closedialog();
    this.router.navigate(['/accountsettings'], { queryParams: { tab: "subscription", nav: "yes"} });
  }
}
