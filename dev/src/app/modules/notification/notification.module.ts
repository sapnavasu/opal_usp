import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NotificationRoutingModule } from './notification-routing.module';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { FlexLayoutModule } from '@angular/flex-layout';
import { PopoverModule } from "ngx-smart-popover";
import { SharedModule } from '@app/@shared';
import { NotificationComponent } from './notification/notification.component';

@NgModule({
  declarations: [NotificationComponent],
  imports: [
    CommonModule,
    NotificationRoutingModule,
    CommonModule,
    ReactiveFormsModule,
    SharedModule,
    FlexLayoutModule,
    FormsModule,
    PopoverModule,
  ]
})
export class NotificationModule { }
