import { Component, OnInit, ViewChild, Input, Output, EventEmitter, ChangeDetectorRef, ElementRef } from '@angular/core';
import { AddinguserComponent } from '@lypis_config/shared/addinguser/addinguser.component';
import { DeptComponent } from '../dept/dept.component';
import { MatTabGroup, MatSelectionList, MatDrawer } from '@angular/material';
import swal from 'sweetalert';
import { environment } from 'environments/environment';
import { EnterpriseService } from '@lypis_core/enterpriseadmin/enterprise.service';
import { ProfileService } from '@lypis_core/profilemanagement/profile.service';
import { FormControl, Validators } from '@angular/forms';
import { AppLocalStorageServices } from '@lypis_config/common/localstorage/applocalstorage.services';
import { SlideInOutAnimation } from '@lypis_core/profilemanagement/animation';
import { MapuserComponent } from '../../../../config_files/shared/mapuser/mapuser.component';

@Component({
  selector: 'app-addcontact',
  templateUrl: './addcontact.component.html',
  styleUrls: ['./addcontact.component.scss'],
  animations: [SlideInOutAnimation]
})
export class AddcontactComponent implements OnInit {

  @ViewChild('drawer') drawer: MatDrawer;
  @ViewChild('drawerdept') drawerdept: MatDrawer;
  @ViewChild('drawercontactallocation') drawercontactallocation: MatDrawer;
  @ViewChild('addUpdateUser') addUpdateUser: AddinguserComponent;
  @ViewChild('addDepartmentData') addDepartmentData: DeptComponent;
  @ViewChild('tab') tab: MatTabGroup;
  @ViewChild('user') user: MatSelectionList;
  @ViewChild('scrollDiv') scrollElement: ElementRef;
  @Input() resultsLength = 0;
  @Input() panelTitle: string;
  @Input() helpContent: string;
  @Input() noRecordContent: string;
  @Input() contactType: number;
  @Input() forContact: boolean = false;
  @Input() panelDataList: any;
  @Input() userList: any = [];
  @Input() userListBackup: any = [];
  @Output() userMapped: any = new EventEmitter<any>();
  @Output() selectedPanel: any = new EventEmitter<any>();
  @Output() userAdded: any = new EventEmitter<any>();
  @Output() userDeleted: any = new EventEmitter<any>();
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  searchControl: FormControl = new FormControl();
  disableUserAddButton: boolean = true;
  disableDeptAddButton: boolean = true;
  selectedTab: number = 0;
  @Input() logoUrl: string;
  lypisID: string;
  userbuttonname: string = 'Map';
  deptbuttonname: string = 'Add';
  companyname: string;
  lypisid: string;
  reg_pk: number;
  encryptedreg_pk: string;
  selectedPk: number;
  loadAddUserComponent: boolean = false;
  loadAddDeptComponent: boolean = false;
  showSearchIcon: boolean = true;
  editMode: boolean = false;
  selectedItem: number;
  animationState = 'out';
  perpage: number = 10;
  page: number = 1;
  businessunitlist: any = [];
  searchBusunit: string;
  businessUnitFormControl: FormControl = new FormControl('', Validators.required);
  selectedUserName: string;
  usertabname: string = 'Create';
  @ViewChild('mapuser') mapuser: MapuserComponent;
  @Input() popupContentPrefix: any;
  constructor(private enterpriseService: EnterpriseService,
    private profileService: ProfileService,
    private cdr: ChangeDetectorRef,
    private localStorage: AppLocalStorageServices) { }

  ngOnInit() {
    this.lypisID = this.localStorage.getInLocal('lypis_id');
    this.companyname = this.localStorage.getInLocal('companyname');

    this.searchControl.valueChanges.subscribe(searchterm => {
      if (searchterm) {
        searchterm = searchterm.toLowerCase().toString();
        let finalArr = [];
        this.userListBackup.forEach(val => {
          let ul = {};
          if (val.deptName.toLowerCase().toString().includes(searchterm)) {
            ul['deptPk'] = val.deptPk;
            ul['deptName'] = val.deptName;
            ul['userList'] = val.userList.filter(x => x.fullName.toLowerCase().includes(searchterm));
            if (ul['userList'].length > 0) {
              finalArr.push(ul);
            }
          } else {
            ul['deptPk'] = val.deptPk;
            ul['deptName'] = val.deptName;
            ul['userList'] = val.userList.filter(x => x.fullName.toLowerCase().includes(searchterm));
            if (ul['userList'].length > 0) {
              finalArr.push(ul);
            }
          }
          this.userList = finalArr;
        });
      } else {
        this.userList = this.userListBackup;
      }
    });
  }

  getBusinessUnitList() {
    this.enterpriseService.getBusinessList().subscribe(data => {
      this.businessunitlist = data['data'].items;
    })
  }

  showSweetAlert() {
    this.animationState = 'out'
    if (!this.addUpdateUser) {
      this.drawer.toggle();
      this.selectedItem = this.selectedPk = this.selectedUserName = undefined;
      this.loadAddUserComponent = false;
      this.loadAddDeptComponent = false;
      this.businessUnitFormControl.reset();
    } else if (this.selectedPk || this.addUpdateUser.adduserForm.touched || this.businessUnitFormControl.value) {
      swal({
        title: 'Do you want to cancel adding this contact?',
        text: 'If yes, any unsaved data will be lost.',
        icon: 'warning',
        buttons: ['No', 'Yes'],
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.resetAll();
        }
      });
    } else {
      this.resetAll();
    }
  }

  showSweetAlertForDept() {
    if (this.addDepartmentData.adddepartmentForm.touched) {
      swal({
        title: 'Do you want to cancel adding this department?',
        text: 'If yes, any unsaved data will be lost.',
        icon: 'warning',
        buttons: ['No', 'Yes'],
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.drawerdept.toggle();
          this.loadAddDeptComponent = false;
          this.addUpdateUser.loadUserAllocation = true;
          this.loadUserAccess();
          this.addUpdateUser.addUpdateAccess.allocationUSerDetails(this.addUpdateUser.adduserForm.controls['firstName'].value, this.addUpdateUser.adduserForm.controls['lastName'].value, this.addUpdateUser.adduserForm.controls['designation'].value);
        }
      });
    } else {
      this.drawerdept.toggle();
      this.loadAddDeptComponent = false;
      this.addUpdateUser.loadUserAllocation = true;
      this.loadUserAccess();
      this.addUpdateUser.addUpdateAccess.allocationUSerDetails(this.addUpdateUser.adduserForm.controls['firstName'].value, this.addUpdateUser.adduserForm.controls['lastName'].value, this.addUpdateUser.adduserForm.controls['designation'].value);
    }
  }

  loadUserAccess() {
    this.addUpdateUser.getDepartmentAccess();
  }

  editUser(userPk: number) {
    this.usertabname = 'Update';
    this.drawer.toggle();
    this.loadAddUserComponent = true;
    this.cdr.detectChanges();
    this.disableUserAddButton = false;
    this.tab.selectedIndex = 1;
    this.editMode = true;
    this.addUpdateUser.stkUpdateUserDetails(userPk);
  }

  deleteUser(userPk: string) {
    swal({
      title: 'Do you want to delete this Contact?',
      icon: 'warning',
      buttons: ['No','Yes'],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        let postParams = {
          "userPk": userPk,
          "status": 'D',
          "businessUnit": this.panelTitle
        };
        let postUrl = 'ea/user/update-stakholder-users';
        this.enterpriseService.enterpriseService(postParams, postUrl).subscribe(data => {
          if (data['data'].status == 100) {
            swal({
              title: 'Contact deleted successfully.',
              icon: 'success',
              closeOnClickOutside: false,
              closeOnEsc: false
            });
            this.userDeleted.emit(true);
          }
        });
      }
    });
  }

  resetAll() {
    this.usertabname = 'Create';
    this.drawer.toggle();
    this.tab.selectedIndex = 0;
    this.userbuttonname = 'Map';
    this.editMode = false;
    this.addUpdateUser.clearForm();
    this.selectedItem = this.selectedPk = this.selectedUserName = undefined;
    this.loadAddUserComponent = false;
    this.loadAddDeptComponent = false;
    this.businessUnitFormControl.reset();
    this.searchControl.reset();
    this.scrollElement.nativeElement.scrollTo(0, 0);
  }

  tabChange(event) {
    if (event.index == 0) {
      this.userbuttonname = 'Map';
      this.disableUserAddButton = true;
      if(this.selectedPk){
      this.disableUserAddButton = false;
      }
    } else if (this.editMode) {
      this.userbuttonname = 'Update';
      this.disableUserAddButton = true;
    } else {
      this.userbuttonname = 'Add';
      this.disableUserAddButton = true;
    }
  }

  clear() {
    if (this.tab.selectedIndex == 0) {
      this.searchControl.reset();
      this.selectedItem = this.selectedPk = this.selectedUserName = undefined;
      this.mapuser.selectedPk = undefined;
    } else {
      this.addUpdateUser.clearForm();
    }
    this.disableUserAddButton = true;
  }

  onSubmit(submitFor) {
    if (submitFor == 1) {
      if (this.tab.selectedIndex == 0) {
        //TODO Map user
        this.mapContact(this.selectedPk.toString(), this.selectedUserName);
      } else {
        this.addUpdateUser.onSubmit();
      }
    } else {
      this.addDepartmentData.onSubmit();
    }
  }
  mapContact(pk: string, uname: string) {
    let postUrl = 'ea/user/map-user-as-contact';
    let postParam = { userPk: pk, businessUnitPk: this.businessUnitFormControl.value };
    this.enterpriseService.enterpriseService(postParam, postUrl).subscribe(data => {
      if (data['data'].status == 100) {
        swal({
          title: this.popupContentPrefix + data['data'].data,
          icon: data['data'].icon,
          closeOnClickOutside: false,
          closeOnEsc: false
        }).then(val => {
          this.userAdded.emit(true);
          this.resetAll();
          this.userMapped.emit(true);
        })
      } else if (data['data'].status == 102) {
        swal({
          title: `${uname}'s contact details has already been mapped to ${this.panelTitle}.`,
          icon: data['data'].icon,
          closeOnClickOutside: false,
          closeOnEsc: false
        })
      }
    });
  }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentcontactinfo') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  contactInfoListByType(regpk: string, type?: any, page?: number, perpage?: number, search: string = '') {
    this.profileService.getcontactinfo(regpk, type, page, perpage, search).subscribe(data => {
      this.panelDataList = data['data'].items.data;
      this.resultsLength = data['data'].items.count;
    })
  }

  closeSideNav(event, closeFor?: string) {
    if (event) {
      if (closeFor == 'user') {
        this.resetAll();
        if (!this.forContact) {
          this.contactInfoListByType(this.encryptedreg_pk, 0, this.page, this.perpage);
        }
      } else {
        this.addUpdateUser.loadUserAllocation = true;
        this.drawerdept.toggle();
        this.addUpdateUser.getUserDepartmentList();
        this.addUpdateUser.adduserForm.controls['departmentId'].setValue(String(event));
        this.loadUserAccess();
        this.addUpdateUser.addUpdateAccess.allocationUSerDetails(this.addUpdateUser.adduserForm.controls['firstName'].value, this.addUpdateUser.adduserForm.controls['lastName'].value, this.addUpdateUser.adduserForm.controls['designation'].value);
      }
    }
  }

  editDeptData(event) {
    this.loadAddDeptComponent = true;
    this.cdr.detectChanges();
    this.deptbuttonname = 'Update';
    this.drawerdept.toggle();
    this.disableDeptAddButton = false;
    this.addDepartmentData.editDeptData(event);
  }

  openDeptSideNav(event) {
    if (event) {
      this.loadAddDeptComponent = true;
      this.cdr.detectChanges();
      this.drawerdept.toggle();
    }
  }

  reloadContactList(event) {
    this.userAdded.emit(true);
  }

  addDeptData() {
    this.disableDeptAddButton = false;
  }

  addUserData(event) {
    if (event == 'I') {
      this.disableUserAddButton = true;
    } else {
      this.disableUserAddButton = false;
    }
  }

}
