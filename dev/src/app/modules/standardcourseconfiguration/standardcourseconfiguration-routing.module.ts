import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AuthGuard } from '@app/auth/auth.guard';

import { SccgridlistComponent } from './sccgridlist/sccgridlist.component';
import { ViewcoursegridlistComponent } from './viewcoursegridlist/viewcoursegridlist.component';
import { AddstandardcourseComponent } from './addstandardcourse/addstandardcourse.component';
import { AddsubcategoryComponent } from './addsubcategory/addsubcategory.component';
import { AddconfiguredocumentComponent } from './addconfiguredocument/addconfiguredocument.component';

const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'sccgridlist',
      component: SccgridlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Standard Course Configuration',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' }
        ]
      },
    },
    {
      path: 'viewcourse/:id',
      component: ViewcoursegridlistComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Course',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'View Course', url: '' }
        ]
      },
    },
    {
      path: 'course/:type',
      component: AddstandardcourseComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Standard Course',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Add Standard Course', url: '/standardcourseconfiguration/course/add' }
        ]
      },
    },
    {
      path: 'course/:type/:id',
      component: AddstandardcourseComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit Standard Course',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Edit Standard Course', url: '/standardcourseconfiguration/course/edit/:id' }
        ]
      },
    },
    {
      path: 'subcategory/add/:type/:id',
      component: AddsubcategoryComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Sub-Category',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Add Sub-Category', url: '/standardcourseconfiguration/subcategory/add/1/:id' }
        ]
      },
    },
    {
      path: 'subcategorys/add/:type/:id',
      component: AddsubcategoryComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Add Sub-Category',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'View Course', url: '/standardcourseconfiguration/viewcourse' },
          { title: 'Add Sub-Category', url: '/standardcourseconfiguration/subcategory/add/1/:id' }
        ]
      },
    },
    {
      path: 'subcategory/edit/:type/:id',
      component: AddsubcategoryComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit Sub-Category',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Edit Sub-Category', url: '/standardcourseconfiguration/subcategory/edit/2/:id' }
        ]
      },
    },
    {
      path: 'subcategory/view/:type/:id',
      component: AddsubcategoryComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Sub-Category',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'View Sub-Category', url: '/standardcourseconfiguration/subcategory/View/3/:id' }
        ]
      },
    },
    {
      path: 'coursedocument/:id',
      component: AddconfiguredocumentComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Configure Documents Required',
        urls: [
          { title: 'Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Standard Course Configuration', url: '/standardcourseconfiguration/sccgridlist' },
          { title: 'Configure Documents Required', url: '/standardcourseconfiguration/coursedocument/id' }
        ]
      },
    },
  ]
}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StandardcourseconfigurationRoutingModule { }
