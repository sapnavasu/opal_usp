import { Component, OnInit, Input } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import swal from 'sweetalert';
import { MatTableDataSource } from '@angular/material/table';
import { ToastrService } from 'ngx-toastr'
export interface PeriodicElement {
  name: string;
  type: number;
}

const ELEMENT_DATA: PeriodicElement[] = [
  { name: 'Enterprise Admin', type: 1 },
  { name: 'Divisions', type: 2 },
  { name: 'Departments', type: 2 },
  { name: 'User Creation', type: 2 },
  { name: 'Accounts Settings', type: 1 },
  { name: 'General Settings', type: 2 },
  { name: 'Manage Subscription', type: 2 },
  { name: 'Email Preference', type: 2 },
  { name: 'Master Company Profile', type: 1 },
  { name: 'Company Information', type: 2 },
  { name: 'About Company', type: 2 },
  { name: 'Accomplishments', type: 2 },
  { name: 'Market Presence', type: 2 },
  { name: 'Web Presence', type: 2 },
  { name: 'Board Members and Management Team', type: 2 },
  { name: 'Domain Profile', type: 1 },
  { name: 'Business Source', type: 2 },
  { name: 'Product Catalog', type: 2 },
  { name: 'Service Catalog', type: 2 },
  { name: 'jSearch', type: 1 },
  { name: 'Internal Search', type: 2 },
  { name: 'Domain Search', type: 2 },
  { name: 'JSRS Search', type: 2 },
  { name: 'Supplier Certification Management', type: 1 },
];

@Component({
  selector: 'app-viewpermissionsidenav',
  templateUrl: './viewpermissionsidenav.component.html',
  styleUrls: ['./viewpermissionsidenav.component.scss']
})
export class ViewpermissionsidenavComponent implements OnInit {
  public basicdata:any;
  displayedColumns: string[] = ['module', 'create', 'update', 'read', 'delete', 'approval', 'download'];
  dataSource = ELEMENT_DATA;
  public buttonname: string = 'Request Access';
  public changeuserloader: boolean = false;
  dataSourceforpermission: any;
  animationState1 = 'out';
  constructor(public toastr: ToastrService) { }
  @Input('viewpermissionsidenav') viewpermissionsidenav: MatDrawer;
  ngOnInit(): void {
  }

  showSweetjsrscertificatealert() {
    this.animationState1 = 'out';
    this.viewpermissionsidenav.toggle();
  }
  
  public showResponsiveLoader = false;

  usedatamoduleaccess(userDetails){
    this.basicdata = userDetails; 
  }
  toggleShowDivviewpermission(divName: string) {
    if (divName === 'permission') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }
}
