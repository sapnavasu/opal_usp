import { Component, OnInit, Input, ViewEncapsulation } from '@angular/core';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import { ActivatedRoute } from '@angular/router';
import { TranslateService } from '@ngx-translate/core';
import swal from 'sweetalert';
import { Router } from "@angular/router";
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
@Component({
  selector: 'app-viewandapprove',
  templateUrl: './viewandapprove.component.html',
  styleUrls: ['./viewandapprove.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewandapproveComponent implements OnInit {

  i18n(key) {
    return this.translate.instant(key);
  }
  btnactive = false;
  assessmentType = 1;
  approveType = 1;
  learnerData;
  id;
  assessmentreport = [];
  learnerstatus;
  kreport;
  preport;
  validatebtn = false;
  @Input() isValidated: boolean = false;
  stktype;
  role;
  isfocalpoint;
  useraccess;
  isacess;
  formloading = true;
  type;
  regpk;


  constructor(private translate: TranslateService, private assessmentService: AssessmentReportService,private route: ActivatedRoute, 
    protected router: Router,private localstorage: AppLocalStorageServices, private cookieService: CookieService,
    private remoteService: RemoteService){
    this.onValidation = this.onValidation.bind(this);
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    })
    this.regpk = this.localstorage.getInLocal('registerPk');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.role = this.localstorage.getInLocal('role');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    this.id = this.route.snapshot.paramMap.get('id');
    this.type = this.route.snapshot.paramMap.get('type');
    this.getlearnerdata(this.id);
    this.getassessmentreport(this.id);
    this.getlearnerstatus();
    if(this.isfocalpoint==2){
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
      console.log('this.useraccess',this.useraccess);
      console.log('moduleid',moduleid);
      if(this.useraccess[moduleid] && this.useraccess[moduleid].submodules == 'Learner Assessment' && this.useraccess[moduleid].approval == 'Y'){
        this.isacess = true;
      }
    }
    if(this.isfocalpoint==1 ||  this.stktype == 1){
      this.isacess = true;
    }
    this.formloading = false;
  }

  getlearnerdata(id)
  {
    this.formloading = true;
    this.assessmentService.getleanerdata(id).subscribe(data=>{
      this.formloading = false;
      this.learnerData = data.data;
      if(this.learnerData.commentBy){
        this.assessmentService.getuser(this.learnerData.commentBy).subscribe(res=>{
          this.learnerData.commentByname = res.data.oum_firstname;
        })
      }
      if(this.learnerData.status == 7 || this.learnerData.status == 9){
        this.validatebtn = true
      }else{ 
        this.validatebtn = false
      }
    });
  }

  getassessmentreport(id)
  {
    this.assessmentService.getassessmentreport(id).subscribe(data=>{
      this.assessmentreport = data.data;
      let kreport = this.assessmentreport.filter(item => item.data.asmtm_InternalAsmt == 1)
      this.kreport = kreport.length != 0 ? kreport[0].data : null
      if(this.kreport){
        this.kreport.url = kreport[0].url
        this.kreport.filetype = kreport[0].filetype
      }
      let preport = this.assessmentreport.filter(item => item.data.asmtm_InternalAsmt == 2)
      this.preport = preport.length != 0 ? preport[0].data : null
      if(this.preport){
        this.preport.url = preport[0].url
        this.preport.filetype = preport[0].filetype

      }
      if((this.kreport != null && this.preport != null) || (this.kreport != null && this.preport == null) ){
        this.btnactive = false
      } else{
        this.btnactive = true
      }
    });
  }

  viewfile(url){
    window.open(url, '_blank');
  }

  getlearnerstatus()
  {
    this.assessmentService.getlearnerstatus().subscribe(data=>{
      this.learnerstatus = data.data;
    });
  }

  getstatus(value){
    let status =  this.learnerstatus.filter(item=> item.referencemst_pk == value);
    return status[0].rm_name_en;
  }

  changeassessment(type){
    if(type == 'knowleadge'){
      this.btnactive = false
    } else{
      this.btnactive = true
    }
  }
  changepop(type){
    if(type == 'know'){
      this.btnactive = false
    }else {
      this.btnactive = true
    }
  }

  getassessmentstatus(no){
    // 1-New, 2-Teaching(theory),3-Teaching(practical),4-No Show(theory),5-No Show(practical), 6-Assessment, 7-Quality Check,8-Declined during Quality Check,9-Resubmitted for Quality Check 10-Print
     if(no == 1){
       return 'New'
     } else if(no == 2){
       return 'Teaching(theory)'
     }
     else if(no == 3){
       return 'Teaching(practical)'
     }
     else if(no == 4){
       return 'No Show(theory)'
     }
     else if(no == 5){
       return 'No Show(practical)'
     }
     else if(no == 6){
       return 'Assessment'
     }
     else if(no == 7){
       return 'Quality Check'
     }
     else if(no == 8){
       return 'Declined during Quality Check'
     }
     else if(no == 9){
       return 'Resubmitted for Quality Check'
     }
     else if(no == 10){
       return 'Print'
     }
     else{
       return ''
     }
   }
   gotolist(){
    this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);
   }

   onValidation(form , resetForm){
    let error1;
    let error2;
    if(this.regpk == this.learnerData.regpk){
      error1 = "The Learner's Photo is mandatory. Please inform your Training Centre's Focal Point to upload the photo of the Learner to proceed further.";
      error2 = "The ROP License No is mandatory. Please inform your Training Centre's Focal Point to provide the ROP License No of the Learner to proceed further.";
    }else{
      error1 = "The Learner's Photo is mandatory. Please inform the Training Centre's Focal Point to upload the photo of the Learner to proceed further.";
      error2 = "The ROP License No is mandatory. Please inform the Training Centre's Focal Point to provide the ROP License No of the Learner to proceed further.";
    }
    
    console.log('dsfsdfdsf')
    console.log(resetForm)
    if(form.value.select_valitate == 3){
      if(this.learnerData?.profileurl){
        if(this.learnerData?.maincourse == "Defensive driving"){
          if(this.learnerData?.stafflince){
            this.formloading = true;
            if(resetForm){
    
              let data = {
                'learnerPK' : this.learnerData.learnerPK,
                'status': form.value.select_valitate,
                'comments': form.value.comments,
                'pStatus':this.learnerData.pStatus,
                'kStatus':this.learnerData.kStatus
              }
              console.log('data', data)
              this.assessmentService.savequalitycheckstatus(data).subscribe(res=>{ 
                //this.getlearnerdata(this.id);
                this.validatebtn = false;
                this.formloading = false;
                swal({
                  title: this.i18n('assesmentport.savesucc'),
                  text: " ",
                  icon: 'success',
                  buttons: [false, this.i18n('assesmentport.ok')],
                  dangerMode: true,
                  closeOnClickOutside: false
                }).then(() => {
                  resetForm();
                
                  this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);
    
                });
              });
            } 
          } else{ 
            swal({
              title: error2,
              text: " ",
              icon: 'success',
              buttons: [false, this.i18n('assesmentport.ok')],
              dangerMode: true,
              closeOnClickOutside: false
            }).then(() => {
              
      
            });
          }
        } else{
          this.formloading = true;
          if(resetForm){
    
            let data = {
              'learnerPK' : this.learnerData.learnerPK,
              'status': form.value.select_valitate,
              'comments': form.value.comments,
              'pStatus':this.learnerData.pStatus,
              'kStatus':this.learnerData.kStatus
            }
            console.log('data', data)
            this.assessmentService.savequalitycheckstatus(data).subscribe(res=>{ 
              //this.getlearnerdata(this.id);
              this.validatebtn = false;
              this.formloading = false;
              swal({
                title: this.i18n('assesmentport.savesucc'),
                text: " ",
                icon: 'success',
                buttons: [false, this.i18n('assesmentport.ok')],
                dangerMode: true,
                closeOnClickOutside: false
              }).then(() => {
                resetForm();
              
                this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);
  
              });
            });
          } 
        }
  
      } else{
        swal({
          title: error1,
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('assesmentport.ok')],
          dangerMode: true,
          closeOnClickOutside: false
        }).then(() => {
          
  
        });
      }
    }else{
      if(resetForm){
    
        let data = {
          'learnerPK' : this.learnerData.learnerPK,
          'status': form.value.select_valitate,
          'comments': form.value.comments,
          'pStatus':this.learnerData.pStatus,
          'kStatus':this.learnerData.kStatus
        }
        console.log('data', data)
        this.assessmentService.savequalitycheckstatus(data).subscribe(res=>{ 
          //this.getlearnerdata(this.id);
          this.validatebtn = false;
          this.formloading = false;
          swal({
            title: this.i18n('assesmentport.savesucc'),
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('assesmentport.ok')],
            dangerMode: true,
            closeOnClickOutside: false
          }).then(() => {
            resetForm();
          
            this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);

          });
        });
      } 
    }
     
  }
}
