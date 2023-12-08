import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { extract } from '@app/i18n';
import { LoginComponent } from './login.component';
import { ResetpasswordComponent } from './resetpassword/resetpassword.component';
import { SetpasswordComponent } from './setpassword/setpassword.component';
import { LearnerfeedbackModule } from '@app/learnerfeedback/learnerfeedback.module';
import { LearnerfeedbackComponent } from '@app/learnerfeedback/learnerfeedback/learnerfeedback.component';

const routes: Routes = [
    {path:'',redirectTo:'admin/login', pathMatch: 'full' },
    { path: 'login', component: LoginComponent, data: { title: extract('OPAL - Login') } },
    {
      path: 'setpassword', 
      component: SetpasswordComponent,
      data:{title:"OPAL - Set Password",'module':'login'}   
    },
    {
      path: 'resetpassword/:id/:pk',
      component: ResetpasswordComponent,
      data: { title: "{projectName} reset password" }
    },
    {
      path: 'LearnerfeedbackComponent/:id',
      component: LearnerfeedbackComponent,
      data: { title: "Learner feedback" }
    }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
  providers: []
})
export class AuthRoutingModule { }
