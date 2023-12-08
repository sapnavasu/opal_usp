import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/auth/auth.guard';
import { VehiclelistingComponent } from './vehiclelisting/vehiclelisting.component';
import { VehicleregisterComponent } from './vehicleregister/vehicleregister.component';
import { VehicleinspectionComponent } from './vehicleinspection/vehicleinspection.component';
import { InspectiondetialsComponent } from './inspectiondetials/inspectiondetials.component';
import { ViewapprovalComponent } from './viewapproval/viewapproval.component';
import { VehicleimportComponent } from './vehicleimport/vehicleimport.component';


const routes: Routes = [{
  path: '',
  children: [
    {
      path: 'vehiclelisting',
      component: VehiclelistingComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Inspection and Approval',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehiclelisting' }
        ]
      },
    },
    {
      path: 'list',
      component: VehiclelistingComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'RAS Vehicle Management',
        urls: [
          { title: 'RAS Vehicle Management', url: '/vehiclemanagement/list' }
        ]
      },
    },
    {
      path: 'vehicleregister',
      component: VehicleregisterComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Registration Form',
        urls: [
          { title: 'Vehicle Registration Form', url: '/vehiclemanagement/vehicleregister' }
        ]
      },
    },
    {
      path: 'editVehicle/:vcl_id',
      component: VehicleregisterComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit - Vehicle Registration Form',
        urls: [
          { title: 'Edit - Vehicle Registration Form', url: '/vehiclemanagement/editVehicle/:vcl_id' }
        ]
      },
    },
    {
      path: 'importexcel',
      component: VehicleimportComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Edit - Vehicle Registration Form',
        urls: [
          { title: 'Import - Vehicle Data', url: '/vehiclemanagement/importexcel' }
        ]
      },
    },
    {
      path: 'vehicleinspection/:vcl_id',
      component: VehicleinspectionComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Inspection and Approval',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehiclelisting' },
          { title: 'Inspect Now', url: '/vehiclemanagement/vehicleinspection/:vcl_id' }
        ]
      },
    },
    {
      path: 'vehicleinspection/:type/:vcl_id',
      component: VehicleinspectionComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Inspection and Approval',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehiclelisting' },
          { title: 'Update Inspection Report', url: '/vehiclemanagement/vehicleinspection/edit/:vcl_id' }
        ]
      },
    },
    {
      path: 'vehicleinspection_info/:vcl_id',
      component: InspectiondetialsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Inspection and Approval',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehiclelisting' },
          { title: 'Renew Now', url: '/vehiclemanagement/vehicleinspection_info' }
        ]
      },
    },
    {
      path: 'vehicleinspection_info',
      component: InspectiondetialsComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Inspection and Approval',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehicleinspection_info' },
          { title: 'Renew Now', url: '/vehiclemanagement/vehicleinspection_info' }
        ]
      },
    },
    {
      path: 'vehicleinspectionstatus',
      component: ViewapprovalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Inspection and Approval',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehicleinspectionstatus' }
        ]
      },
    },
    {
      path: 'vehicleinspectionstatus/view',
      component: ViewapprovalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle Inspection and Approval',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehiclelisting' },
          { title: 'View Details', url: '/vehiclemanagement/vehicleinspectionstatus' }
        ]
      },
    },
    {
      path: 'vehicleinspectionstatus/approved',
      component: ViewapprovalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'Vehicle View & Approve',
        urls: [
          { title: 'Vehicle Inspection and Approval', url: '/vehiclemanagement/vehiclelisting' },
          { title: 'View & Approve', url: '/vehiclemanagement/vehicleinspectionstatus' }
        ]
      },
    },
    // Technical Staff - Booking Details - View Routing Start
    {
      path: 'vehicleinspectionstatus/view/:type',
      component: ViewapprovalComponent,
      canActivate: [AuthGuard],
      data: {
        title: 'View Booking',
        urls: [
          { title: 'Technical Evaluation Centre', url: '/approvalstaffmanagement/technicalcentre' },
          { title: 'View Schedule', url: '/approvalstaffmanagement/technicalviewschedule',id:true },
          { title: 'View Booking', url: '' }
        ]
      },
    },
    // Technical Staff - Booking Details - View Routing End

  ],

},];
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class VehiclemanagementRoutingModule { }
