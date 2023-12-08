import { Component, Input, OnInit } from '@angular/core';
import { StandardcoursesComponent } from '@app/modules/standardcourses/standardcourses.component';

@Component({
  selector: 'app-coursepayment',
  templateUrl: './coursepayment.component.html',
  styleUrls: ['./coursepayment.component.scss']
})
export class CoursepaymentComponent implements OnInit {
  paymentinfo: any;
  paymentinfos: any;

  // @Input() payment :any;
  @Input() public set payment(value: any) {
    this.paymentinfo = value;
    
  }
  public get payment() {
    
    return this.paymentinfo;

  }
  @Input() public set record(value: any) {
    this.paymentinfos = value;
    
  }
  public get record() {
    
    return this.paymentinfos;

  }
  
  constructor() { }

  ngOnInit(): void {
   
  }

}
