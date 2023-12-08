import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import moment from 'moment';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import swal from 'sweetalert';
import { Location } from '@angular/common';

@Component({
  selector: 'app-scsiteaudit',
  templateUrl: './scsiteaudit.component.html',
  styleUrls: ['./scsiteaudit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ScsiteauditComponent implements OnInit {
  app_sts: any;
  tab: any;
  appdt_appdeccomment: any='';
  appdt_appdecon: any='-';
  firstname: string='';
  disableMatSelection:boolean=false;
  accessqualitymanager:boolean=false;
  accessAuthority: boolean=false;
  accessauditor: boolean=false;
  arrDoc: any = [];
  appdec_by: any='';
  appdecComments: any='';
  appdecon: any='';
  status: any='';
  isUserViewAcccess: boolean = false;
  isUserApprovalAccess: boolean;
  isUserUpdateAccess: boolean;
  isUserReadAccess: boolean;
  isUserDownloadAccess: boolean;
  isUserDeleteAccess: boolean;
  isUserCreateAccess: boolean;
  appdt_apptype: any;
  asd_date: any;
  accessceo: any;
  viewpage: any='';
  vievalidation: boolean= true;
  i18n(key) {
    return this.translate.instant(key);
  }
  viewapproveaudit:boolean = true;
  viewapproveaudit1:boolean = true;
  mattab: number = 0;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  siteAuditRes: any;
  applicationStatus: any = {};
  appdt_certificateexpiry: any;
  appiit_loclatitude: any;
  appiit_loclongitude: any;
  isexpired: number;
  ifarabic: boolean = false;
  appasdt_auditscheddtls_fk: any;
  application_id: any;
  enableNextAprrovalBtn: any;
  disableSubmitButton:boolean= false;
  appdt_status: any = '';
  appapprovalStatus: any='';
  clickDisable: boolean;
  stktype: any;
  isfocalpoint: any;
  useraccess: any;
  isUserHaveApprAccess: boolean = true;
  appauditschedtmp_pk: string;
  role: any;
  approvalDetails: any='';
  projectPk: string = '';
  constructor( private translate: TranslateService,private router: Router,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private appservice : ApplicationService,private _location:Location,
    private security: Encrypt,
    public toastr: ToastrService,public route: ActivatedRoute,
    private localstorage: AppLocalStorageServices) { }
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  ngOnInit(): void {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    if(this.isfocalpoint==2){
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
     
      if(this.useraccess[moduleid] && this.useraccess[moduleid].approval == 'Y') {
        this.isUserApprovalAccess = true;
        this.isUserViewAcccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid].update == 'Y') {
        this.isUserUpdateAccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid].read == 'Y') {
        this.isUserReadAccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid].download == 'Y') {
        this.isUserDownloadAccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid].delete == 'Y') {
        this.isUserDeleteAccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid].create == 'Y') {
        this.isUserCreateAccess = true;
      }
    }
  

    if(this.isfocalpoint==1){
      this.isUserViewAcccess = true;
    }
    this.route.queryParams.subscribe(params => {
      this.application_id = params['id'];
      this.viewpage =this.security.decrypt( params['view']);
      console.log(this.viewpage , 'viewpage');
      this.tab = params['tab'];
      if(this.tab != null) {
        this.mattab = 1;
      }
    });
    if(this.viewpage == 6) {
      this.vievalidation = false;
      setTimeout(() => {
        this.mattab = 0;
      }, 4000);

    }
    
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.ifarabic = false;
      } else {
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.ifarabic = false;

    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
        } else {
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.ifarabic = false;

      }
    });

    this.getstandcustcourseapprstat();
    const savedTabIndex = localStorage.getItem('mattab');
    if (savedTabIndex) {
     setTimeout(() => {
      
      this.mattab = 1;
      localStorage.removeItem('mattab'); 
     }, 4050);
    }
  }
  getstandcustcourseapprstat() {
    this.disableSubmitButton = true;
    if(this.application_id) {
      let temppk = this.application_id;
      this.appservice.getstandcustcourseapprstatus(temppk).subscribe((res:any) => {
        console.log(res);    
        this.disableSubmitButton = false;

        if(res['success']) {
          if(res['data']['data'] != "") {

          this.applicationStatus = res['data']['data'][0];
          if(this.applicationStatus) {
            
          this.appdt_certificateexpiry =  this.applicationStatus.appdt_certificateexpiry;
          // this.appdt_certificategenon =      data.data.data[0].appdt_certificategenon;
          // this.appdt_submittedon    = data.data.data[0].appdt_submittedon;
          // this.appdt_updatedon     = data.data.data[0].appdt_updatedon;
          this.appdt_apptype     = this.applicationStatus.appdt_apptype;
         
          this.appdt_appdeccomment =  (this.applicationStatus.appdt_appdeccomment)?this.applicationStatus.appdt_appdeccomment:'Nil';
          this.appdt_status = this.applicationStatus.appdt_status; 
          this.appdt_appdecon = this.applicationStatus.appdt_appdecon;
          this.firstname = res['data']['data']['firstname'];
          if(((this.appdt_status == 9) || (this.appdt_status == 13))) {        
            this.disableMatSelection = true;
            this.viewapproveaudit = false;
            this.viewapproveaudit1 = false;
            if(this.viewpage == 6) {
              this.viewapproveaudit = true;
              this.viewapproveaudit1 = true;
              this.disableMatSelection = false;
            }
            if(this.appdt_apptype == 3 && this.appdt_status == 9) {
              this.viewapproveaudit = true;
              this.viewapproveaudit1 = false;
              this.disableMatSelection = false;
            }
            if(this.appdt_apptype == 3 && this.appdt_status == 13) {
              this.viewapproveaudit = true;
              this.viewapproveaudit1 = false;
              this.disableMatSelection = false;
            } 
          } else {
            this.disableMatSelection = false;
            this.viewapproveaudit = true;
            this.viewapproveaudit1 = true;
          }
          this.appauditschedtmp_pk = this.security.encrypt(this.applicationStatus.appauditschedtmp_pk);
          this.projectPk =  this.security.encrypt(this.applicationStatus.appdt_projectmst_fk);
          this.appasdt_auditscheddtls_fk = this.security.encrypt(this.applicationStatus.appasdt_auditscheddtls_fk);
          this.appiit_loclatitude =  this.applicationStatus.appiit_loclatitude;
          this.appiit_loclongitude =  this.applicationStatus.appiit_loclongitude; 
          var current_date = new Date();
          var specific_date = new Date(this.appdt_certificateexpiry); //Year, Month, Date 
          
          if(this.appdt_certificateexpiry == null) {
            this.app_sts = 1;
          } else if(current_date.toISOString() <= specific_date.toISOString()) {
            this.app_sts = 2;
          } else  if (current_date.toISOString()> specific_date.toISOString()) {
            this.app_sts = 3;
          }
          if (current_date.getTime() > specific_date.getTime()) {    
          this.isexpired = 1; 
          }else {    
            this.isexpired = 0;   
          }
          this.asd_date = this.applicationStatus.asd_date;
          this.getapprovalsitedata(this.application_id);
          this.getSiteAudit(this.appauditschedtmp_pk,this.appdt_status);
          this.getappapprovalhrd(this.application_id,this.security.encrypt(this.appdt_status));
         }
        }
        }
      })
    }

  }

  getapprovalsitedata(app_id) {
    //1 = new, 2 = update, 3= Updated(changes), 4 renewal
    let form_sts = 1;
    if(this.appdt_apptype == '1') {
      form_sts = 1;
    } else if(this.appdt_apptype == '2') {
      form_sts = 4;
    } else if(this.appdt_apptype == '3') {
      form_sts = 2;
    } 
   
    let data = {'project_id':this.projectPk,'formstatus':form_sts}

    this.appservice.getapprovalsitedata(app_id,data).subscribe((res:any) => {
      console.log(res , 'resdata');
      if(res['data']) {
        this.approvalDetails = res['data']['data'];
        console.log(this.approvalDetails , 'approvalsetails')
        this.accessqualitymanager = this.approvalDetails['accessqualitymanager'];
        this.accessAuthority = this.approvalDetails['accessAuthority'];
        this.accessauditor = this.approvalDetails['accessauditor'];
        this.accessceo = this.approvalDetails['accessceo'];
      }

    })
  }
  getappapprovalhrd(app_id,app_status) {
    this.appservice.getappapprovalhrd(app_id,app_status).subscribe((res:any) => {
      console.log(res , 'res');
      if(res['data']) {
        this.appapprovalStatus = res['data']['data'];
        this.appdec_by = this.appapprovalStatus['appdec_by'];
        this.appdecComments = this.appapprovalStatus['aah_appdecComments'];
        if(this.appdecComments == null) {
          this.appdecComments = 'Nil';
        }
        this.appdecon = this.appapprovalStatus['aah_appdecon'];
        this.status = this.appapprovalStatus['aah_status'];

      }

    })
  }
  getSiteAudit(id,sts) {
    this.appservice.getstandardcourselist(id,sts).subscribe((res:any) => {   
      if(res['status'] == 200 && res['success']) {

        this.siteAuditRes = res['data']['data'];
        this.appservice.setLocalSiteAuditList("siteAuditRes",this.siteAuditRes);
        
        this.siteAuditRes.forEach(quest => {
          if(quest['ques'] != null)
              quest['ques'].forEach(ques => {
                if(ques['isselected'] != "") {
                  this.disableMatSelection = false;
                } 
                this.arrDoc.push(ques['isselected']);
              });
        });
        this.disableMatSelection = this.arrDoc.includes("");
      }
    })
  }
  selected(data) {
    console.log(data);
    this.appservice.savestandcustcourse(data).subscribe((res:any) => {
      // console.log(res);
      this.clickDisable = false;

      if(res['status'] == 200 && res['success']) {
        this.disableMatSelection = false;
        this.mattab = 1;
      }
    })
  }
  previousButton(event) {
    if(event) {
      this.mattab = 0;
      this.clickDisable = false;
    }
  }
  deleteSelectedTabDetails(event) {
    console.log(event);
    let categoryId = this.security.encrypt(event.cattmp_pk);
    this.appservice.deleteCategoryWithQuestions(categoryId).subscribe((res:any) => {
      // console.log(res);     
      if(res['status'] == 200 && res['success']) {
        this.showTSuccess('Category deleted!');
      }
    });
  }
  deleteSelectedQuestion(event) {
    console.log(event);
    let questionId = this.security.encrypt(event.questionmst_pk);
    this.appservice.deleteQuestionWithRelatedAnswers(questionId).subscribe((res:any) => {
      // console.log(res);      
      if(res['status'] == 200 && res['success']) {
        this.showTSuccess('Question and Answer deleted!');
      }
    });
  }

  // appapprovalhdr_pk
  siteauditapprovalChanges(event) {
    console.log(event,this.approvalDetails,this.approvalDetails);
    let app_id = this.application_id;
    let role_id = ''
    if((this.appdt_status == 9) && (this.appdt_status == 13)) {
      role_id = '5';
    } else  if((this.appdt_status == 10) && (this.appdt_status == 14)) {
      role_id = '3';
    }else  if((this.appdt_status == 11) && (this.appdt_status == 15)) {
      role_id = '4';
    }
    let data = {};
    if((this.approvalDetails['hrd_fk'] != null) && (this.approvalDetails['workflowdtls_fk'] != null) && (this.approvalDetails['workflowuserdtls_fk'] != null)) {
       data = {'appapprovalstatus':event.select_valitate,'comments':event.comments,'role_id':role_id,'course_type':this.projectPk,'hrd_fk':this.approvalDetails['hrd_fk'],"dtls_fk":this.approvalDetails['workflowdtls_fk'],"userdtls_fk":this.approvalDetails['workflowuserdtls_fk']};
    } else {
      data = {'appapprovalstatus':event.select_valitate,'comments':event.comments,'role_id':role_id,'course_type':this.projectPk,'hrd_fk':"4","dtls_fk":"16","userdtls_fk":"16"};
    }
   this.disableSubmitButton = true;
    this.appservice.changeSiteAuditStatus(app_id,data).subscribe((res:any) => {
      this.disableSubmitButton = false;
      console.log(res);
      if(res['success'] && res["data"]["msg"] == "Success") {
      if(this.security.decrypt(this.projectPk) == '4'){
        swal({
          title:'Status updated successfully',
          text: "",
          icon: 'success',
          // buttons: ['ok',true],
          // dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then((willDelete) => {
              this.router.navigate(['centrecertification/rashome/'+this.projectPk]);           
        }); 
      }else{

        swal({
          title: event.select_valitate=='3'?this.i18n('staffpractical.siteaudvalid'):this.i18n('staffpractical.siteaudapprov'),
          text: "",
          icon: 'success',
          // buttons: ['ok',true],
          // dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then((willDelete) => {
              this.router.navigate(['standardcourseapproval/approvaldetails']);
           
        }); 
      }
        //  this.getstandcustcourseapprstat(); 

      }
    })
  }
  // enableNextAprroval(event) {
  //   console.log(event);
  //   if(event) {
  //     this.enableNextAprrovalBtn = event;
  //   }
  // }
  sweetalert(data)
  {
    swal({
      text:data.msg,
      icon:data.status,
    }).then((value)=>{
        
    });
  }
  nextLevelApprovalPending(event) {
    let role_id='';
    if((this.appdt_status == 9) && (this.appdt_status == 13)) {
      role_id = '3';
    }
    let data;
    if(this.approvalDetails && (this.approvalDetails['hrd_fk'] != null) && (this.approvalDetails['workflowdtls_fk'] != null) && (this.approvalDetails['workflowuserdtls_fk'] != null)) {

    if(this.appdt_status == 9) {
      data = {type:10,role_id:role_id,'course_type':this.projectPk,'hrd_fk':Number(this.approvalDetails['hrd_fk']),"dtls_fk":Number(this.approvalDetails['workflowdtls_fk']),"userdtls_fk":Number(this.approvalDetails['workflowuserdtls_fk'])};
    }
    if(this.appdt_status == 13) {
      data = {type:14,role_id:role_id,'course_type':this.projectPk,'hrd_fk':Number(this.approvalDetails['hrd_fk']),"dtls_fk":Number(this.approvalDetails['workflowdtls_fk']),"userdtls_fk":Number(this.approvalDetails['workflowuserdtls_fk'])};
    }

    if(event) {
      this.disableSubmitButton = true;
      this.appservice.saveAppApprovalNextLevel(this.application_id,data).subscribe((res:any) => {
        this.disableSubmitButton = false;
      if(res) {
          if(this.security.decrypt(this.projectPk) != '4'){       
          swal({
          title: this.appdt_status == 9?this.i18n('staffpractical.applicastatchabgtoqua'):this.i18n('staffpractical.applistatchan'),
          text: "",
          icon: 'success',
          // buttons: ['ok'],
          // dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
          }).then((willDelete) => {
          this.router.navigate(['standardcourseapproval/approvaldetails']);

          });   
          }
          if(this.security.decrypt(this.projectPk) == '4'){ 
          swal({
            title: 'This application is submitted to the Next level Approval',
            text: "",
            icon: 'success',
            // buttons: ['ok'],
            // dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then((willDelete) => {
               this.router.navigate(['centrecertification/rashome/'+this.projectPk]);
              
          });
        }

        }
    })
    }
  }  else {
    this.showWSuccess("Please Check the Access!");
  }
  }
  showTSuccess(data){
    this.toastr.show(data, 'success', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showWSuccess(data){
    this.toastr.show(data, 'warning', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  goBack() {
    this._location.back(); 
  }
}
