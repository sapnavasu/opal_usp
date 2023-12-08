import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-paymentsuccess',
  templateUrl: './paymentsuccess.component.html',
  styleUrls: ['./paymentsuccess.component.scss']
})
export class PaymentsuccessComponent implements OnInit {
  @Input() paymentDtl: any;
  constructor() { }

  ngOnInit() {
  }

}
