import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TransactionstatusRoutingModule } from './transactionstatus-routing.module';
import { SharedModule } from '@app/@shared';
import { TransactionlandingpageComponent } from './transactionlandingpage/transactionlandingpage.component';
import { TransactionsucessComponent } from './transactionsucess/transactionsucess.component';
import { FlexLayoutModule } from '@angular/flex-layout';


@NgModule({
  declarations: [TransactionlandingpageComponent, TransactionsucessComponent],  
  imports: [
    CommonModule,
    TransactionstatusRoutingModule,
    SharedModule,
    FlexLayoutModule,
  ]
})
export class TransactionstatusModule { }
