import { Component, OnInit, Output, EventEmitter, Input, SimpleChanges, ViewChild } from '@angular/core';
import { FormControl } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import swal from 'sweetalert';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { UserallocationComponent } from '@app/@shared/sidepanel/userallocation/userallocation.component';
import {ApprovalService} from '@app/modules/registartionapproval/approval.service';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-paymentmapuser',
  templateUrl: './paymentmapuser.component.html',
  styleUrls: ['./paymentmapuser.component.scss'],
  animations: [SlideInOutAnimation],
})
export class PaymentmapuserComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @ViewChild('draweruserallocation') draweruserallocation: MatDrawer;
  @ViewChild('drawer2') drawer2: MatDrawer;
  @Output('showLoader') showLoader: any = new EventEmitter<any>();
  @Output('compDetails') compDetails: any = new EventEmitter<any>();
  public userPermission:any = [];
  @ViewChild('addUpdateAccess') addUpdateAccess:UserallocationComponent;
  @Input() sideNavHeading: string = 'Select User';
  @Input("userList") userList:any;
  @Input("regpk") regpk:any;
  @Input("userpk") userpk:any;
  @Input("userListBackup") userListBackup:any;
  animationState1 = 'out';
  searchControl: FormControl = new FormControl(null);
  public showreseticon:boolean = false;
  public paymentuserloader:boolean = false;
  selectedPk: any='';
  departmentpk:any='';
  public selectedPkArr: any = [];
  public selectedPkdtls: any = [];
  public selectedPkArr_onload: any = [];
  selectedUserName: string;
  @Output() selectedUsers: any = new EventEmitter<any>();
  @Output() getSelectedUserName: any = new EventEmitter<any>();
  @Input() multiple_select: boolean;
  @Input() showContactDet: boolean = false;
  @Input() contactMapLimit: Number = 0;
  @Input('drawer') drawer: MatDrawer;
  public buttonname: string = 'Change';
  public addDisable: boolean = true;
  public showChangebtn: boolean = false;
  disableloader:boolean = false;
  
  @Input() public set selectedPkArr_input(value: any) {  
   // this.selectedPkArr = value;
    if (Array.isArray(value) && this.multiple_select) {
      value.forEach(val => {
        const find_index = this.selectedPkArr.indexOf(val);
        if (find_index === -1) {
          this.selectedPkArr.push(val);
        }
      })
    } else {
      this.selectedPk = value;
      this.selectedPkArr.push(value);
    }
  }
  clearMappedPk() {
    this.selectedPkArr = [];
   // this.selectedPkArr_onload = [];
    this.selectedPk = '';
  }
  public get selectedPkArr_input() {
    return this.selectedPkArr;
  }

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private enterpriseService: EnterpriseService, public router: Router, private approvalService:ApprovalService) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"


  ngOnInit() {
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
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
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
	  
      });
  }
  ngOnChanges(changes: SimpleChanges): void {
    this.paymentuserloader = true;
    this.searchUserOrDept();
  }

  searchUserOrDept() {
    this.searchControl.valueChanges.subscribe(searchterm => {
      if (searchterm) {
        searchterm = searchterm.toLowerCase().toString();
        let finalArr = [];
        this.showreseticon = true;
        this.userListBackup.forEach(val => {
          let ul = {};
          if (val.deptName.toLowerCase().toString().includes(searchterm)) {
            ul['deptPk'] = val.deptPk;
            ul['deptName'] = val.deptName;
            ul['userList'] = val.userList;
            finalArr.push(ul);
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
    this.paymentuserloader=false;
  }

  userPermData(event) {
    this.showLoader.emit(true);
    this.userPermission = event;
    this.changeAdmin();
    
  }

  // changeAdmin() {
  //   // const { pk, departmentPk } = this.settingsData.primaryContact;
  //   // this.accSettingsService.changeUser(this.mapuser.selectedPk, this.userPermission, departmentPk, pk).subscribe(data => {
  //   //   if (data['data'].status == 1) {
  //   //     this.showLoader.emit(false);
  //   //     this.drawer.toggle();
  //   //     swal({
  //   //       title: "The JSRS Admin role will be transferred to " +this.mapuser.selectedUserName+ ", after you approve the Authorisation link sent to your registered email ID.",
  //   //       text: "Note: The authorisation link will be valid for 7 days.",
  //   //       icon: "success",
  //   //     }).then(() => {
  //   //       this.profileService.logout().subscribe(d => this.router.navigate(['admin/login']));
  //   //     });
  //   //   }
  //   // });
  // }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentmember') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
    
  }
  public searchterm: any = '';
  showSweetAlert() {
    let showPopup = false;
    this.animationState1 = 'out';
    if (this.selectedPk != ''  || this.searchControl.value != null){
      showPopup = true;
      
    }
    if(showPopup){
     
      swal({
        title: this.i18n('paymentmapuser.doyouwanttocanc'),
        text: this.i18n('paymentmapuser.areyousure'),
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: [this.i18n('paymentmapuser.canc'), this.i18n('paymentmapuser.ok')],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          this.drawer.toggle();
          this.addDisable=true;
          this.selectedPk = '';
          this.searchControl.reset();
        }
      });
    }
    else{
      this.drawer.toggle();
      this.addDisable=true;
      this.selectedPk = '';
      this.searchControl.reset();
    }
 
  
  }
  emitSelectedPks(selectedPk,departmentpk) {
    this.showChangebtn=true;
    this.addDisable=false;
      this.selectedPk=selectedPk;
      this.departmentpk=departmentpk;
    
  }
  changeAdmin()
  {
    swal({
      title: this.i18n('paymentmapuser.areyousureyouwant'),
      text: this.i18n('paymentmapuser.pleaconfif'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('paymentmapuser.canc'), this.i18n('paymentmapuser.canf')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.paymentuserloader=true;
        // this.approvalService.changeUser(this.selectedPk, this.regpk, this.userpk).subscribe(data => {
        //   if (data['data'].status == 1) {
        //     this.disableloader=false;
        //   }else{
        //     this.disableloader=false;
        //   }
        // });        
        this.selectedPkdtls.push(this.selectedPk);
        this.selectedPkdtls.push(this.departmentpk);
        this.selectedPkdtls.push(this.userPermission);
        this.selectedUsers.emit(this.selectedPkdtls);
        this.addDisable=true;
        this.selectedPkdtls = [];
        this.selectedPk = '';
        let compinfo;
        this.approvalService.getcompdetails(this.regpk).subscribe(res=>{
          compinfo = res['data'];          
        });
        setTimeout(function(){
          this.compDetails.emit(compinfo)
        }, 1000);
        this.paymentuserloader=false;
        this.drawer.toggle();        
      }
    });
    
  }
}
