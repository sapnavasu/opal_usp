import { Component, OnInit, ViewChild, Input, ChangeDetectorRef, EventEmitter, Output, ElementRef } from '@angular/core';
import { environment } from 'environments/environment';
import { MatDrawer, MatPaginator, PageEvent, MatTabGroup, MatSelectionList } from '@angular/material';
import { Encrypt } from '@lypis_config/common/class/encrypt';
import { ProfileService } from '@lypis_core/profilemanagement/profile.service';
import swal from 'sweetalert';
import { AppLocalStorageServices } from '@lypis_config/common/localstorage/applocalstorage.services';
import { AddinguserComponent } from '@lypis_config/shared/addinguser/addinguser.component';
import { EnterpriseService } from '@lypis_core/enterpriseadmin/enterprise.service';
import { DeptComponent } from '../dept/dept.component';
import { FormControl } from '@angular/forms';
import { SlideInOutAnimation } from './../../animation';
import { AddcontactComponent } from '../addcontact/addcontact.component';
import { BgiJsonconfigServices } from 'app/lypis/BGIConfig/bgi-jsonconfig-services';

@Component({
  selector: 'app-panel',
  templateUrl: './panel.component.html',
  styleUrls: ['./panel.component.scss'],
  providers: [EnterpriseService],
  animations: [SlideInOutAnimation]
})
export class PanelComponent implements OnInit {
  animationState = 'out';
  @ViewChild('drawer') drawer: MatDrawer;
  @ViewChild('drawerdept') drawerdept: MatDrawer;
  @ViewChild('drawercontactallocation') drawercontactallocation: MatDrawer;
  @ViewChild('addcontact') addcontact: AddcontactComponent;
  panelOpenState: boolean = false;
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  @ViewChild('paginator') paginator: MatPaginator;
  public perpage = BgiJsonconfigServices.bgiConfigData.configuration.accordionPerpage;
  public paginationSet = BgiJsonconfigServices.bgiConfigData.configuration.accordionPaginationSet;
  @Input() resultsLength = 0;
  @Input() panelTitle: string;
  @Input() helpContent: string;
  @Input() noRecordContent: string;
  @Input() businessUnitPk: number;
  @Input() panelDataList: any;
  @Input() hidePreviousButton: boolean = false;
  @Input() hideNextButton: boolean = false;
  @ViewChild('addUpdateUser') addUpdateUser: AddinguserComponent;
  @ViewChild('addDepartmentData') addDepartmentData: DeptComponent;
  @ViewChild('user') user: MatSelectionList;
  @ViewChild('scrollDiv') scrollElement: ElementRef;
  @Input() panel: number;
  @Input() currentPanel: number;
  page: number = 1;
  companyname: string;
  lypisid: string;
  reg_pk: number;
  encryptedreg_pk: string;
  disableUserAddButton: boolean = true;
  disableDeptAddButton: boolean = true;
  selectedTab: number = 0;
  userbuttonname: string = 'Map';
  deptbuttonname: string = 'Add';
  search: string = '';
  postParams: Object = {};
  loadAddUserComponent: boolean = false;
  loadAddDeptComponent: boolean = false;
  showSearchIcon: boolean = true;
  editMode: boolean = false;
  searchControl: FormControl = new FormControl();
  selectedItem: number;
  selectedPk: number;
  @Input() logoUrl: string;
  lypisID: string;

  //map from here 
  @Input() userList: any = [];
  @Input() userListBackup: any = [];
  @Output() userMapped: any = new EventEmitter<any>();
  @Output() selectedPanel: any = new EventEmitter<any>();
  constructor(private encryptClass: Encrypt, private enterpriseService: EnterpriseService,
    private profileService: ProfileService,
    private localStorage: AppLocalStorageServices,
    private cdr: ChangeDetectorRef) { }


  ngOnInit() {
    this.lypisID = this.localStorage.getInLocal('lypis_id');
    this.reg_pk = this.localStorage.getInLocal('reg_pk');
    this.encryptedreg_pk = this.encryptClass.encrypt(this.reg_pk);
    this.companyname = this.localStorage.getInLocal('companyname');

  }


  onFilterSubmit() {
    this.contactInfoListByType(this.encryptedreg_pk, this.page, this.perpage, this.search);
  }



  clear() {
    if (this.addcontact.tab.selectedIndex == 0) {
      this.selectedItem = undefined;
      this.selectedPk = undefined;
    } else {
      this.addUpdateUser.clearForm();
      this.disableUserAddButton = true;
    }
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }

  onPaginateChange(event) {
    this.perpage = event.pageSize;
    this.page = parseInt(event.pageIndex) + 1;
    this.contactInfoListByType(this.encryptedreg_pk, this.page, this.perpage, this.search);
  }

  contactInfoListByType(regpk: string ,page?: number, perpage?: number, search: string = '') {
    this.profileService.getcontactinfo(regpk, this.businessUnitPk, page, perpage, search).subscribe(data => {
      this.panelDataList = data['data'].items.data;
      this.resultsLength = data['data'].items.count;
    })
  }

  openToggle() {
    this.addcontact.loadAddUserComponent = true;
    this.addcontact.drawer.toggle();
    this.addcontact.businessUnitFormControl.setValue(this.businessUnitPk);
    this.addcontact.businessUnitFormControl.disable();
    this.addcontact.getBusinessUnitList()
  }


  editUser(userPk: number) {
    this.addcontact.getBusinessUnitList();
    this.addcontact.businessUnitFormControl.setValue(this.businessUnitPk);
    this.addcontact.businessUnitFormControl.disable();
    this.addcontact.editUser(userPk);
  }

  deleteUser(userPk: number) {
    let usrPk = this.encryptClass.encrypt(userPk);
    this.addcontact.deleteUser(usrPk);
  }

  updateList(event) {
    this.postParams = {};
    if (this.panelDataList.length == 1) {
      this.page = this.page - 1;
      this.paginator.pageIndex = this.paginator.pageIndex - 1;
    }
    this.contactInfoListByType(this.encryptedreg_pk, this.page, this.perpage, this.search);
  }

  stakeholderUserDetails(postParam) {
    let postUrl = 'ea/user/users-by-dept';
    this.enterpriseService.enterpriseService(postParam, postUrl).subscribe(data => {
        if (data['data'].status == 100) {
            this.userList = data['data'].data;
            this.userListBackup = data['data'].data;
        }
    });
}

updateDeptUserList(event){
    if(event){
        this.stakeholderUserDetails({ fetchFor: 'map' });
    }
}

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentcontactinfo') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
}
