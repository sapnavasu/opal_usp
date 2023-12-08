import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FlexLayoutModule } from '@angular/flex-layout';
import { AccessRoutingModule } from './access-routing.module';
import { ManagebasemoduleComponent } from './basemodule/managebasemodule/managebasemodule.component';
import { CreatebasemoduleComponent } from './basemodule/createbasemodule/createbasemodule.component';
import { ManagemenuComponent } from './menumaster/managemenu/managemenu.component';
import { CreatemenuComponent } from './menumaster/createmenu/createmenu.component';
 import { CreatestkholderaccessComponent } from './stkholderaccess/createstkholderaccess/createstkholderaccess.component';
 import { ManagestkholderaccessComponent } from './stkholderaccess/managestkholderaccess/managestkholderaccess.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { MaterialModule } from '../../config_files/common/material-module/material-module';
import {SharedModule} from "@lypis_config/shared/shared.module";
import { StkholdregComponent } from './stkholdreg/stkholdreg.component';
import { CreatestkholdregComponent } from './stkholdreg/createstkholdreg/createstkholdreg.component';
import { ModalDialogReginfo } from './stkholdreg/Modal/reginfo';
import { MatBottomSheetModule } from '@angular/material';
import { BottomsheetComponent } from './stkholdreg/Modal/bottom-sheet';

@NgModule({
  declarations: [
	 ManagebasemoduleComponent, 
	 CreatebasemoduleComponent,
	 CreatestkholderaccessComponent,
   ManagestkholderaccessComponent,
   StkholdregComponent,
   CreatestkholdregComponent,
   ModalDialogReginfo,
   BottomsheetComponent,
   ManagemenuComponent,
   CreatemenuComponent
  ],
  imports: [
    CommonModule,
    AccessRoutingModule,
    ReactiveFormsModule,
    MaterialModule,
    SharedModule,
    FlexLayoutModule,
    FormsModule,
    MatBottomSheetModule
  ],
  entryComponents:[ModalDialogReginfo,BottomsheetComponent]
})
export class AccessModule { }
