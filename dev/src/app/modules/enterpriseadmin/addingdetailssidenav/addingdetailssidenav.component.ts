import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { MatDrawer } from '@angular/material/sidenav';
import { MatTabGroup } from '@angular/material/tabs';
import { AdddepartmentComponent } from '@app/@shared/adddepartment/adddepartment.component';
import { AddinguserComponent } from '@app/@shared/addinguser/addinguser.component';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import 'rxjs/add/observable/of';
import swal from 'sweetalert';
import { SlideInOutAnimation } from '../animation';


interface status {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-addingdetailssidenav',
  templateUrl: './addingdetailssidenav.component.html',
  styleUrls: ['./addingdetailssidenav.component.scss'],
  animations: [SlideInOutAnimation]
})
export class AddingdetailssidenavComponent implements OnInit {
  status: status[] = [
    { value: 'active', viewValue: 'Active' },
    { value: 'inactive', viewValue: 'Inactive' },
  ];
  @Input('draweruseranddepartment') draweruseranddepartment: MatDrawer;
  adddepartmentForm: FormGroup;
  departmentname: string;
  animationState = 'out';
  public addDisable:boolean = true;
  public saveKey:number;
  @ViewChild('addUpdateUser') addUpdateUser:AddinguserComponent;
  @ViewChild('addDepartmentData') addDepartmentData:AdddepartmentComponent;
  @ViewChild(MatTabGroup) tabGroup: MatTabGroup;
  @Output() reloadGrid:any = new EventEmitter<any>();
  public companyName:any = '-';
  public companyId:any = '-';
  public addUpdateText = 'Add';
  public updateUserPk:any = '';
  public updateDeptPk:any = '';
  showResponsiveLoader: boolean = false;
  lypisID: string;
  @Input() logoUrl: string;

  constructor(private formBuilder: FormBuilder,
    private localstorage: AppLocalStorageServices) { }

  ngOnInit() {
    this.lypisID = this.localstorage.getInLocal('lypis_id');
  }
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentuserrole') {
        this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
}

  addUserData(event){
    if(event == 'I'){
      this.addDisable = true;
      this.saveKey = 0;
    }else{
      this.addDisable = false;
      this.saveKey = event;
    }
  }

  commonSubmit(){
    this.showResponsiveLoader = true;
    if(this.saveKey == 1){
      this.addUpdateUser.onSubmit();
    }
    if(this.saveKey == 2){
      this.addDepartmentData.onSubmit();
    }
  }

  stakehlderUserUpdateDetails(userPk){
    this.addDisable = true;
    this.addUpdateText = 'Add';
    this.tabGroup.selectedIndex = 0;
    this.updateUserPk = userPk;
    this.addUpdateUser.stkUpdateUserDetails(userPk);
  }

  reloadUserDepartment(){
    this.tabGroup.selectedIndex = 0;
    this.saveKey = 1;
    this.addUpdateText = 'Add';
    this.addUpdateUser.getUserDepartmentList();
  }

  addDeptData(event){
    this.addDisable = false;
    this.saveKey = event;
    if(this.updateDeptPk > 0){
      this.addUpdateText = 'Add';
    }else{
      this.addUpdateText = 'Add';
    }
  }

  closeUserSIdeNav(event){
    if(event){
      this.showResponsiveLoader = false;
      this.updateUserPk = '';
      this.updateDeptPk = '';
      this.draweruseranddepartment.toggle();
      this.reloadGrid.emit(true);
      this.clearForm();
    }
  }

  clearForm(){
    this.addUpdateUser.clearForm();
    this.addDepartmentData.clearForm();
  }

  editDeptData(event){
    this.tabGroup.selectedIndex = 1;
    this.saveKey = 2;
    this.addUpdateText = 'Add';
    this.updateDeptPk = event;
    this.addDepartmentData.editDeptData(event);
  }
  public triggercountryser:number =1;
  tabCheck(event){
    if (event === 1) {
      this.triggercountryser = 2;
    }
    this.saveKey = event;
  }

  companyUserDetails(cmpName, cmpId){
    this.companyName = cmpName;
    this.companyId = cmpId;
    this.addDepartmentData.companyDeptDetails(cmpName, cmpId, this.logoUrl);
  }

  closeform(){
    if(this.addUpdateUser.userCloseCheck() || this.addDepartmentData.departmentCloseCheck()){
      swal({
        title:'Do you want to cancel adding this user details',
        text: 'All the data you entered will be lost',
        icon: 'warning',
        buttons: ['No', 'Yes'],
        dangerMode: true,
      }).then((willGoBack) => {
        if(willGoBack){
          this.clearForm();
          this.draweruseranddepartment.toggle();
          this.updateUserPk = '';
          this.updateDeptPk = '';
        }
      });
    }else{
      this.clearForm();
      this.draweruseranddepartment.toggle();
      this.updateUserPk = '';
      this.updateDeptPk = '';
    }
  }
}
