import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { SuperadminlayoutComponent } from './@shared/layouts/superadmin/superadminlayout.component';
import { PageNotFoundComponent } from './@shared/pagenotfound/pagenotfound.component';
import { LoginlayoutComponent } from './auth/layouts/login/loginlayout.component';
import { LoginComponent } from './auth/login.component';
import { BlanklayoutComponent } from './layouts/blanklayout/blanklayout.component';
import { TranslateModule, TranslateService, TranslatePipe, TranslateLoader } from '@ngx-translate/core';
import { AccountsettingsComponent } from './modules/accountsettings/accountsettings.component';
import { TwofactorauthComponent } from './modules/accountsettings/twofactorauth/twofactorauth.component';

//import { m } from './modules/trainingcentremanagement/'
// import { StandardcourseComponent } from './modules/standardcustomizedcourse/standardcourse/standardcourse.component';
const routes: Routes =
  [


    {
      path: '',
      component: LoginlayoutComponent,
      children: [
        {
          path: '',
          component: LoginComponent,
          loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule)
        }
      ]
    },
    {
      path: 'home',
      component: LoginlayoutComponent,
      loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule)
    },
    {
      path: 'admin',
      component: LoginlayoutComponent,
      loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule)
    },
    {
      path: 'learnerfeedback',
      component: LoginlayoutComponent,
      // loadChildren: () => import('./learnerfeedback/learnerfeedback.module').then(m => m.LearnerfeedbackModule)
      loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule)
    },
    {
      path: 'dashboard',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/dashboard/dashboard.module').then(m => m.DashboardModule)
    },
    {
      path: 'profilemanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/profilemanagement/profilemanagement.module').then(m => m.ProfilemanagementModule)
    },
    {
      path: 'assessmentreport',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/assessmentreport/assessmentreport.module').then(m => m.AssessmentreportModule),
      data: {
        title: 'View Learners',
        breadcrumb: 'View Learners'
      }
    },
    {
      path: 'candidatemanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/candidatemanagement/candidatemanagement.module').then(m => m.CandidatemanagementModule),
      data: {
        title: 'Learners List',
        breadcrumb: 'Learners List'
      }
    },
    {
      path: 'candidatemanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/candidatemanagement/candidatemanagement.module').then(m => m.CandidatemanagementModule),
      data: {
        title: 'Learners Register',
        breadcrumb: 'Learners Register'
        // title: 'Batch Management',
        // breadcrumb: 'Batch Management'
      }
    },
    {
      path: 'enterpriseadmin',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/enterpriseadmin/enterpriseadmin.module').then(m => m.EnterpriseadminModule),
      data: {
        title: 'Enterprise Admin',
        breadcrumb: 'Enterprise Admin'
      }
    },
    {
      path: 'newenterpriseadmin',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/newenterpriseadmin/newenterpriseadmin.module').then(m => m.NewenterpriseadminModule),
      data: {
        title: 'Enterprise Admin',
        breadcrumb: 'Enterprise Admin'
      }
    },
    {
      path: 'trainingcentremanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/trainingcentremanagement/trainingcentremanagement.module').then(m => m.TrainingcentremanagementModule),
      data: {
        title: 'Training Centre Management',
        breadcrumb: 'Training Centre Management'
      }
    },
    {
      path: 'standardcourse',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/standardcourses/standardcourses.module').then(m => m.StandardcoursesModule),
      data: {
        title: 'Standard & Customized Course',
        breadcrumb: 'Standard & Customized Course'
      }
    },
    {
      path: 'standardcourseapproval',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/standardcourseapproval/standardcourseapproval.module').then(m => m.StandardcourseapprovalModule),
      data: {
        title: 'Standard & Customized Course Approval',
        breadcrumb: 'Standard & Customized Course Approval'
      }
    },
    {
      path: 'centrecertification',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/certificationapproval/certificationapproval.module').then(m => m.CertificationapprovalModule),
      data: {
        title: 'Training Evaluation Centre Approval',
        breadcrumb: 'Training Evaluation Centre Approval'
      }
    },
    {
      path: 'batchindex',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/batch/batch.module').then(m => m.BatchModule),
      data: {
        title: 'Batch Management',
        breadcrumb: 'Batch Management'
      }
    },
    {
      path: 'profilecreation',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/profilecreation/profilecreation.module').then(m => m.ProfilecreationModule)
    },
    {
      path: 'invoicemanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/invoicemanagement/invoicemanagement.module').then(m => m.InvoicemanagementModule)
    },

    {
      path: 'accountsettings',
      component: SuperadminlayoutComponent,
      loadChildren: () => import("./modules/accountsettings/accountsettings.module").then(m => m.AccountsettingsModule)
    },

    {
      path: 'twofactorauth',
      component: SuperadminlayoutComponent,
      loadChildren: () => import("./modules/accountsettings/accountsettings.module").then(m => m.AccountsettingsModule)
    },
    {
      path: 'regapproval',
      component: SuperadminlayoutComponent,
      loadChildren: () => import("./modules/registartionapproval/registartionapproval.module").then(m => m.RegistartionapprovalModule)
    },
    {
      path: 'registration',
      component: BlanklayoutComponent,
      loadChildren: () => import("./modules/registration/registration.module").then(m => m.RegistrationModule)
    },

    {
      path: 'afterlogin',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/afterlogin/afterlogin.module').then(m => m.AfterloginModule)
    },
    {
      path: 'afterlogin',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/afterlogin/afterlogin.module').then(m => m.AfterloginModule)
    },

    {
      path: '',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/notification/notification.module').then(m => m.NotificationModule)
    },
    {
      path: 'regapproval',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/registartionapproval/registartionapproval.module').then(m => m.RegistartionapprovalModule)
    },
    {
      path: 'thankyou',
      loadChildren: () => import('./modules/thankyou/thankyou.module').then(m => m.ThankyouModule)
    },
    {
      path: 'transaction',
      loadChildren: () => import('./modules/transactionstatus/transactionstatus.module').then(m => m.TransactionstatusModule)
    },
    {
      path: 'thanksubscription',
      loadChildren: () => import('./modules/jsrspastsubscription/jsrspastsubscription.module').then(m => m.JsrspastsubscriptionModule)
    },
    {
      path: 'paymentinvoiceindex',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/paymentinvoice/paymentinvoice.module').then(m => m.PaymentinvoiceModule),
      data: {
        title: 'view invoice',
        breadcrumb: 'view invoice'
      }
    },
    {
      path: 'vehiclemanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/vehiclemanagement/vehiclemanagement.module').then(m => m.VehiclemanagementModule),
      // data: {
      //   title: 'view invoice',
      //   breadcrumb: 'view invoice'
      // }
    },
    {
      path: 'learnercardmanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/learnercardmanagement/learnercardmanagement.module').then(m => m.LearnercardmanagementModule),
     
    },
    {
      path: 'ivmscertification',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/ivmscertification/ivmscertification.module').then(m => m.IvmscertificationModule),
     
    },
    {
      path: 'ivmsapproval',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/ivmsapproval/ivmsapproval.module').then(m => m.IvmsapprovalModule),
     
 },
    {
      path: 'staffmanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/staffmanagement/staffmanagement.module').then(m => m.StaffmanagementModule),
     
    },
    {
      path: 'approvalstaffmanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/approvalstaffmanagement/approvalstaffmanagement.module').then(m => m.ApprovalstaffmanagementModule),
    },
    {
      path: 'configuration',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/configuration/configuration.module').then(m => m.ConfigurationModule),

    },
    {
      path: 'gradeconfiguration',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/gradeconfiguration/gradeconfiguration.module').then(m => m.GradeconfigurationModule),

    },
    {
      path: 'standardcourseconfiguration',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/standardcourseconfiguration/standardcourseconfiguration.module').then(m => m.StandardcourseconfigurationModule),
      data: {
        title: 'Standard Course Configuration',
        breadcrumb: 'Standard Course Configuration'
      }
    },
    {
      path: 'configuration/masterdataconfiguration',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/masterdataconfiguration/masterdataconfiguration.module').then(m => m.MasterdataconfigurationModule),
     
    },
    {
      path: 'vehiclemanagement',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/trainingcentremanagement/trainingcentremanagement.module').then(m => m.TrainingcentremanagementModule),
      
    },
    {
      path: 'manageivms',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/manageivms/manageivms.module').then(m => m.ManageivmsModule),
      
    },
    {
      path: 'configuration',
      component: SuperadminlayoutComponent,
      loadChildren: () => import('./modules/configuration/configuration.module').then(m => m.ConfigurationModule),
      data: {
        title: 'Configuration',
        breadcrumb: 'Configuration'
      }
    },
  ];

@NgModule({
  // imports: [RouterModule.forRoot(routes, { useHash: true })],
  exports: [RouterModule],
  //providers: []
  imports: [RouterModule.forChild(routes), RouterModule.forRoot(routes), TranslateModule],
  //exports: [TranslatePipe],
  providers: [TranslateModule]
})
export class AppRoutingModule { }
