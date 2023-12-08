import { Component, OnInit } from '@angular/core';
import { AfterloginService } from '../afterlogin.service';

@Component({
  selector: 'app-invoicelistview',
  templateUrl: './invoicelistview.component.html',
  styleUrls: ['./invoicelistview.component.scss']
})
export class InvoicelistviewComponent implements OnInit {

  invoiceDtl: any;
  constructor(private afterloginService: AfterloginService) { }

  ngOnInit() {
    this.getInvoiceDetails();
  }

  getInvoiceDetails() {
    this.afterloginService.getInvoicedtls().subscribe(data => this.invoiceDtl = data['data']);
  }

}
