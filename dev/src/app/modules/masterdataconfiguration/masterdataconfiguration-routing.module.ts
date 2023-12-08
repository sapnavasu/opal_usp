import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: 'feesubscribtion',
        loadChildren: () => import('./feesubscription/feesubscription.module').then(m => m.FeesubscriptionModule),
      },
      {
        path: 'coursecategory',
        loadChildren: () => import('./coursecategory/coursecategory.module').then(m => m.CoursecategoryModule),
      },
      {
        path: 'coursesubcategory',
        loadChildren: () => import('./coursesubcategory/coursesubcategory.module').then(m => m.CoursesubcategoryModule),
      },
      {
        path: 'moherigrading',
        loadChildren: () => import('./moherigrading/moherigrading.module').then(m => m.MoherigradingModule),
      },
      {
        path: 'educationlevel',
        loadChildren: () => import('./educationlevel/educationlevel.module').then(m => m.EducationlevelModule),
      },
      {
        path: 'courselevel',
        loadChildren: () => import('./courselevel/courselevel.module').then(m => m.CourselevelModule),
      },
      {
        path: 'requestfor',
        loadChildren: () => import('./requestfor/requestfor.module').then(m => m.RequestforModule),
      },
      {
        path: 'assessmentin',
        loadChildren: () => import('./assessmentin/assessmentin.module').then(m => m.AssessmentinModule),
      },
      {
        path: 'roadtype',
        loadChildren: () => import('./roadtype/roadtype.module').then(m => m.RoadtypeModule),
      },
      {
        path: 'vehiclecategories',
        loadChildren: () => import('./vehiclecategories/vehiclecategories.module').then(m => m.VehiclecategoriesModule),
      },
      {
        path: 'vehiclesubcategories',
        loadChildren: () => import('./vehiclesubcategories/vehiclesubcategories.module').then(m => m.VehiclesubcategoriesModule),
      },
      {
        path: 'vehiclemanufacturers',
        loadChildren: () => import('./vehiclemanufacturers/vehiclemanufacturers.module').then(m => m.VehiclemanufacturersModule),
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class MasterdataconfigurationRoutingModule { }
