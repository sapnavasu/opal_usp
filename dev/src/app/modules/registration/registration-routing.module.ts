import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RegsitrationComponent } from './regsitration.component';
import { InvalidpageComponent } from './invalidpage/invalidpage.component';
import { registerwithopalComponent } from './registerwithopal/registerwithopal.component';
import { InvestorregresolverService } from './corporatereg/investorregresolver.service';
import { ViewOfflineRegdataComponent } from './view-offline-regdata/view-offline-regdata.component';
import {AuthGuard} from '@app/auth/auth.guard';
import { UserdetailsComponent } from './userreg/userreg.component';
import { DirtyCheckGuard } from './supplierreg/dirty-check.guard';



const routes: Routes = [
  {
    path:'',
    children: [
      {
        path: 'user',
        component: UserdetailsComponent,
        data:{
          title: 'User Registration',
          breadcrumb: 'User Registration'
        }
      },
      {
        path: 'invalidpage',
        component: InvalidpageComponent,
        data:{
          title: 'Invalid',
          breadcrumb: 'Invalid'
        }
      },
      {
        path: 'invalidpage/:type',
        component: InvalidpageComponent,
        data:{
          title: 'Invalid',
          breadcrumb: 'Invalid'
        }
      },
      {
        path: 'index',
        component: registerwithopalComponent,
        canDeactivate: [DirtyCheckGuard],
        // resolve: {
        //   data: InvestorregresolverService
        // },
        data:{
          title: 'Registration OPAL',
          breadcrumb: 'Registration'
        }
      },
      {
        path: 'viewofflineregdata',
        component: ViewOfflineRegdataComponent,
        canActivate: [AuthGuard],
        data:{
          title: 'Registration Offline Data',
          breadcrumb: 'Registration Offline Data'
        }
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class RegistrationRoutingModule { }
