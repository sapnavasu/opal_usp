import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { AddinguserComponent } from '@app/@shared/addinguser/addinguser.component';
import swal from "sweetalert";
import { SlideInOutAnimation } from '../animation';
import { Router } from '@angular/router';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { AccountsettingsService } from '@app/modules/accountsettings/accountsettings.service';


@Component({
  selector: 'app-addusersidenav',
  templateUrl: './addusersidenav.component.html',
  styleUrls: ['./addusersidenav.component.scss'],
  animations: [SlideInOutAnimation]
})
export class AddusersidenavComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  animationState = 'out';
  animationState2 = 'out';
  public disableuserformval:boolean = false;
  @Input('draweraddinguser') draweraddinguser: MatDrawer;
  @Output() addusersidenav:any  = new EventEmitter<any>();
  /*Sar Starts*/
  public addDisable:boolean = true;
  public isdisableclosebtn:boolean = true;
  public addUpdateText = 'Add';
  @ViewChild('addUpdateUser') addUpdateUser:AddinguserComponent;
  @ViewChild('addupdateemailuser') addupdateemailuser:AddinguserComponent;

  showResponsiveLoader: boolean = false;
  public saveKey:number;
  @Output() reloadGrid:any = new EventEmitter<any>();
  @Input() addUserFromType:number = 1;
  @Input() triggercountrymst:number = 1;
  @Input() hideComponentHeader : boolean = false;
  @Input() routeRedirectFrom : any = '';
  @Input() lusrtpye:any;
  @Input() fromwhere:number=2;
  @Input() fromwheremobile:number=2;
  addupdateProgressing:boolean = false;
  constructor(private router: Router, private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService, private accSettingsService: AccountsettingsService) { 

    }
    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr";
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.addUpdateText = 'Add';
      }else{
        this.addUpdateText = 'إضافة';
      }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.addUpdateText = 'Add';
        }else{
          this.addUpdateText = 'إضافة';
        }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
  });
  }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentuserrole') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }else if (divName === 'infoview') {
        this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
  }
  showSweetAlert() {
    this.animationState = "out";
    this.animationState2="out";
    if(this.routeRedirectFrom=='acc'){
      this.router.navigate(['/accountsettings'], { queryParams: { tab: "subscription", nav: "yes"} });
    }
    //this.draweraddinguser.toggle();
    if(this.isdisableclosebtn){
      if(this.addUpdateUser.adduserForm.dirty){
        if ((this.addUserFromType == 1 && this.addUpdateUser.adduserForm.dirty) || (this.addUserFromType == 2 && (this.addUpdateUser.adduserForm.valid && JSON.stringify(this.addUpdateUser.previousFormValue) !=JSON.stringify(this.addUpdateUser.adduserForm.value)) || (this.addUpdateUser.adduserForm.invalid))){
          swal({
            title:  this.i18n('enterpriseadmin.doyouwantcanccreatuser'),
            text:  this.i18n('enterpriseadmin.ifyesany'),
            icon: "warning",
            buttons: [this.i18n('enterpriseadmin.nomodal'), this.i18n('enterpriseadmin.yesmodal')],
            dangerMode: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
          }).then((willDelete) => {

            if (willDelete) {
              this.draweraddinguser.toggle();
              this.addUpdateUser.currentUserPk = '';
              
              this.resetForm();
              this.addUpdateUser.timerStopEmail();
              this.addUpdateUser.timerStopMobile();
              this.addUpdateUser.countDownMob = '00.00';
              this.addUpdateUser.countDown    = '00.00';
            }
              
            
          });
       
        } else {
          this.draweraddinguser.toggle();
          this.addUpdateUser.currentUserPk = '';
        
          this.resetForm();
          // this.addUpdateUser.timerStopEmail();
          // this.addUpdateUser.timerStopMobile();
          // this.addUpdateUser.countDownMob = '00.00';
          // this.addUpdateUser.countDown    = '00.00';
        }
        this.addUpdateUser.currentUserPk = '';
          
      }else{
        this.draweraddinguser.toggle();
        this.resetForm();
    
        this.addUpdateUser.timerStopEmail();
        this.addUpdateUser.timerStopMobile();
        this.addUpdateUser.countDownMob = '00.00';
        this.addUpdateUser.countDown    = '00.00';
  
      }
    
    }   
  }
  resetFormCustomForClearData() {
    this.addUpdateUser.departmentList = [];
    this.disableuserformval = true;
    if(this.addUserFromType===2) {
      this.addUpdateUser.adduserForm.controls['userPk'].setValue('');
      this.addUpdateUser.adduserForm.controls['employeeid'].setValue('');
      this.addUpdateUser.adduserForm.controls['username'].setValue('');
      this.addUpdateUser.adduserForm.controls['firstName'].setValue('');
      this.addUpdateUser.adduserForm.controls['lastName'].setValue('');
      this.addUpdateUser.adduserForm.controls['middleName'].setValue('');
      this.addUpdateUser.adduserForm.controls['departmentId'].setValue('');
      this.addUpdateUser.adduserForm.controls['designation'].setValue('');
      this.addUpdateUser.adduserForm.controls['designationLevel'].setValue('');
      this.addUpdateUser.adduserForm.controls['businessunit'].setValue('');
      this.addUpdateUser.adduserForm.controls['branchname'].setValue('');
      this.addUpdateUser.adduserForm.controls['timezone'].setValue('');
    } else {
      
      this.emptyDataModuleForm();
      this.addUpdateUser.currentUserPk = '';
      this.addUpdateUser.adduserForm.reset();
      this.addUpdateUser.setcountryFlag(31,'mobile');
    }

    this.addUpdateUser.setcountryFlag(31);
    this.addUpdateUser.moduleClear();
  }
  emptyDataModuleForm() {
    this.addUpdateUser.previousmoduleValue = [];
    if(this.addUpdateUser.userPermission.length>0) {
      this.addUpdateUser.addUpdateAccess.finalpermissiontempinitialarray = [];
      this.addUpdateUser.addUpdateAccess.finalpermissiontemparray = [];
      this.addUpdateUser.addUpdateAccess.finalpermissionarray = [];
    }
    this.addUpdateUser.userPermission = [];
    this.addUpdateUser.userPermissionsActivityLogs = [];
  }
  resetForm()
  {
    this.disableuserformval = true;
    this.addUpdateUser.departmentList = [];
    this.addUpdateUser.adduserForm.reset();
    this.addUpdateUser.setcountryFlag(31,'mobile');
    this.addUpdateUser.setcountryFlag(31);
    this.addUpdateUser.moduleClear();
    this.addUpdateUser.currentUserPk = '';
    
  }
 @Output()closeFlag = new EventEmitter(false);
  onCloseClick(){
    if(!this.addupdateProgressing) {
      this.showSweetAlert();
      this.closeFlag.emit(true);
    }
  }
  commonSubmit(){
    this.animationState = "out";
    this.animationState2="out";
    this.addDisable = true;
    // this.showResponsiveLoader = true;
    if(this.saveKey == 1){
      this.addupdateProgressing = true;
      this.addUpdateUser.onSubmit(this.addUserFromType);
      this.reloadGrid.emit(true)

    }
    this.addUpdateUser.timerStopEmail();
    this.addUpdateUser.timerStopMobile();
    this.addUpdateUser.countDownMob = '00.00';
    this.addUpdateUser.countDown    = '00.00'
    this.addDisable = false;
  }

  addUserData(event){
    
    if(event == 'I'){
      this.addDisable = true;
      this.saveKey = 0;
      this.addupdateProgressing = false
    }else{
      this.addDisable = false;
      this.saveKey = event;
    }
  }

  closeUserSIdeNav(event){

    if(event){

       this.showResponsiveLoader = false;
       this.draweraddinguser.toggle();
       this.reloadGrid.emit(true);
      if(this.routeRedirectFrom=='acc'){
        this.router.navigate(['/accountsettings'], { queryParams: { tab: "subscription", nav: "yes"} });
      }
    }
  }

  userstkholder(){
    this.addUpdateUser.userType='';
  }
  stakehlderUserUpdateDetails(userPk){

    this.addDisable = true;
    this.addUpdateText = this.i18n('enterpriseadmin.add');
    //this.updateUserPk = userPk;
    this.addUpdateUser.stkUpdateUserDetails(userPk);
    // this.contentinputloader=false;
     this.addUpdateUser.contentinputloader=true;
     this.addDisable = false;
  }
  disableuserform(event){
    this.showResponsiveLoader = event;
  }
  responsiveLoder(event){
    this.showResponsiveLoader = event;
  }

  ngOnDestroy() {
      this.addUpdateUser.adduserForm.reset();
  }
}
