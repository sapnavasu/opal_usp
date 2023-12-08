import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LearnerfeedbackComponent } from './learnerfeedback/learnerfeedback.component';

const routes: Routes = [
  {path:'/:id', component:LearnerfeedbackComponent, data: {title:'Learner Feedback'},},
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class LearnerfeedbackRoutingModule { }
