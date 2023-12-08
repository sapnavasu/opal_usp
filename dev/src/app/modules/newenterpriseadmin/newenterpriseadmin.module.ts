import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from '@app/@shared';
import { NewenterpriseadminRoutingModule } from './newenterpriseadmin-routing.module';
import { ManagerolesComponent } from './manageroles/manageroles.component';
import { ManageusersComponent } from './manageusers/manageusers.component';
import { MatTabsModule } from '@angular/material/tabs'; 
import { HttpClient } from '@angular/common/http';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { FlexLayoutModule } from '@angular/flex-layout';
import { AddrolesComponent } from './addroles/addroles.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { AddusersComponent } from './addusers/addusers.component';
import { ViewrolesComponent } from './viewroles/viewroles.component';
import { ViewusersComponent } from './viewusers/viewusers.component';
import { MatButtonModule } from '@angular/material/button';
import { PopoverModule } from 'ngx-smart-popover';
import { MatSelectSearchModule } from '../mat-select-search/mat-select-search.module';

export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/certificationapproval/', '.json');
}

@NgModule({
  declarations: [ManagerolesComponent, ManageusersComponent, AddrolesComponent, AddusersComponent, ViewrolesComponent, ViewusersComponent],
  imports: [
    CommonModule,
    SharedModule,
    NewenterpriseadminRoutingModule,
    MatTabsModule,
    FlexLayoutModule,
    ReactiveFormsModule,
    FormsModule,
    MatButtonModule,
    PopoverModule,
    MatSelectSearchModule,
    TranslateModule.forChild({
      loader: {
          provide: TranslateLoader,
          useFactory: createTranslateLoader,
          deps: [HttpClient]
      }
  })
  ]
})
export class NewenterpriseadminModule { }
