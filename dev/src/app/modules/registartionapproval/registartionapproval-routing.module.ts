import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RegistrationapprovalComponent } from './registrationapproval/registrationapproval.component';
import { SupplierapprovaltabComponent } from './supplierapprovaltab/supplierapprovaltab.component';
import { ViewandvalidateComponent } from './viewandvalidate/viewandvalidate.component';
import { ProjectownertabComponent } from './projectownertab/projectownertab.component';
import { SuppliertabComponent } from './suppliertab/suppliertab.component';
import { ProjectownercardComponent } from './projectownercard/projectownercard.component';
//import {ViewResolverService} from './view.resolver.service';
import { PaymenttrackerComponent } from './paymenttracker/paymenttracker.component';
import { TemporaryaudittrailComponent } from './temporaryaudittrail/temporaryaudittrail.component';
import { RenewalhistorylistviewComponent } from './renewalhistorylistview/renewalhistorylistview.component';
import { ContractsuccessfeeapprovalComponent } from '@app/modules/registartionapproval/contractsuccessfeeapproval/contractsuccessfeeapproval.component';
const routes: Routes = [
  {
    path:'',
    children: [
      {
        path: 'registrationapproval',
        component: RegistrationapprovalComponent,
        
      },
      {
        path: 'supplierapprovaltab',
        component: SupplierapprovaltabComponent,
        data:{
          title: 'Registration Approval | OPAL',
        },
      },
      {
        path: 'viewandvalidate/:id/:tabindex',
        component: ViewandvalidateComponent,
        //resolve:{listData:ViewResolverService}
        data:{
          title: 'Viewandvalidate | OPAL',
        },
      },
     {
        path: 'suppliertab',
        component: SuppliertabComponent,
       
      },
      {
        path: 'projectownertab',
        component: ProjectownertabComponent,
       
      },
      {
        path: 'projectownercard',
        component: ProjectownercardComponent,
       
      },
      {
        path: 'paymenttracker',
        component: PaymenttrackerComponent,
       
      },
      {
        path: 'temporaryaudittrail',
        component: TemporaryaudittrailComponent,
       
      },
      {
        path: 'renewal',
        component: RenewalhistorylistviewComponent,
       
      },
      {
        path: 'contractapproval',
        component: ContractsuccessfeeapprovalComponent,
       
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class RegistartionapprovalRoutingModule { }
