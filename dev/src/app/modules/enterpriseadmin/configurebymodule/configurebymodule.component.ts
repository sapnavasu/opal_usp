import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatDrawer } from '@angular/material/sidenav';
import { AddinguserComponent } from '@app/@shared/addinguser/addinguser.component';
import 'rxjs/add/observable/of';
import { UsermoduleallocationComponent } from '../usermoduleallocation/usermoduleallocation.component';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';



@Component({
  selector: 'app-configurebymodule',
  templateUrl: './configurebymodule.component.html',
  styleUrls: ['./configurebymodule.component.scss']
})
export class ConfigurebymoduleComponent implements OnInit {
  @Input('configurebymodule') configurebymodule: MatDrawer;
  @ViewChild('addUpdateDeptAccess') addUpdateDeptAccess:UsermoduleallocationComponent;
  @Input() moduleUserDetails:any;
  @Input() menuModuleId:any;
  @Output() deptUserSearch: any = new EventEmitter<any>();
  @Output() closeConfigureModule: any = new EventEmitter<any>();
  @ViewChild('draweruserlallocationnew') draweruserlallocationnew: MatDrawer;
  @ViewChild('addUpdateUser') addUpdateUser:AddinguserComponent;
  @Output() reloadGrid:any = new EventEmitter<any>();
  public showResponsiveLoader: boolean = false;
  public addDisable:boolean = true;
  public saveKey:number;
  
  searchControl: FormControl = new FormControl();
  selectedPk:any;
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
  ) { }
  public triggercountryser:number =1;
  tabChange(event) {
    if (event === 0) {
      this.triggercountryser = 2;
    }
  }
  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
  });
  }

  moduleUserSearch(){
    if(this.searchControl.value){
      this.deptUserSearch.emit(this.searchControl.value);
    }
  }

  resetModuleUSerSearch(){
    this.searchControl.reset();
    this.deptUserSearch.emit(this.searchControl.value);
  }

  moduleUserAllocation(userPk){
    this.draweruserlallocationnew.toggle();
    this.addUpdateDeptAccess.userModuleAccess(userPk, this.menuModuleId);
  }

  closeConfigModule(){
    this.closeConfigureModule.emit(1);
    this.configurebymodule.toggle();
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
  }

  closeUserSIdeNav(event){
    if(event){
      this.showResponsiveLoader = false;
      this.closeConfigModule();
      this.reloadGrid.emit(true);
    }
  }
}
