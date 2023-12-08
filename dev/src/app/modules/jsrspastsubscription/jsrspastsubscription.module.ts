import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { JsrspastsubscriptionRoutingModule } from './jsrspastsubscription-routing.module';
import { ThankpastsubscriptionComponent } from './thankpastsubscription/thankpastsubscription.component';
import { SubscriptionlandingpageComponent } from './subscriptionlandingpage/subscriptionlandingpage.component';
import { FlexLayoutModule } from '@angular/flex-layout';
import { SharedModule } from '@app/@shared';


@NgModule({
  declarations: [ThankpastsubscriptionComponent, SubscriptionlandingpageComponent],
  imports: [
    CommonModule,
    JsrspastsubscriptionRoutingModule,
    SharedModule,
    FlexLayoutModule,
  ]
})
export class JsrspastsubscriptionModule { }
