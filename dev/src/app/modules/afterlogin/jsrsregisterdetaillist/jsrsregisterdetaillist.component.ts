import { Component, OnInit, Input, ViewChild, Output, EventEmitter} from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { AfterloginService } from '../afterlogin.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

@Component({
  selector: 'app-jsrsregisterdetaillist',
  templateUrl: './jsrsregisterdetaillist.component.html',
  styleUrls: ['./jsrsregisterdetaillist.component.scss']
})
export class JsrsregisterdetaillistComponent implements OnInit {
  @ViewChild('drawercontactus') drawercontactus: MatDrawer;
  @ViewChild('changeclassifydrawer') changeclassifydrawer: MatDrawer;
  @Input('paymentDetails') paymentDetails: any;
  @Input('paymentMode') paymentMode: any;
  @Input('contactusData') contactusData: any;
  @Output('updatePayment') updatePayment: any = new EventEmitter<any>();
  @Input('hideChangeSubscription') hideChangeSubscription: boolean = false;
  public paymentStatus:any;
  contactussubjectext: string='Change in Enterprise Classification';  
  public compPk:number;
  constructor(private afterloginService: AfterloginService, private localstorageservice: AppLocalStorageServices) { }

  ngOnInit() {
      
  }
  ngOnChanges() {
    this.paymentStatus = this.paymentDetails? this.paymentDetails?.payStatus: '';
    this.compPk = this.localstorageservice.getInLocal('companyPk');
    this.afterloginService.checkforeignclassification(this.compPk).subscribe(data => {
      if (data['data'].status == 1) {
        this.hideChangeSubscription = true;
      }
    });
  }

  updatePaymentDetails(event) {
    if(event) {
      this.updatePayment.emit(true);
    }
  }
}
