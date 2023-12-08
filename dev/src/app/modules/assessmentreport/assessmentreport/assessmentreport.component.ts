import { Component, OnInit,  ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import { DriveInput } from '@app/common/classes/driveInput';
import { Filee } from '@app/@shared/filee/filee';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute } from '@angular/router';
import { Router } from "@angular/router";
import swal from 'sweetalert';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';

@Component({
  selector: 'app-assessmentreport',
  templateUrl: './assessmentreport.component.html',
  styleUrls: ['./assessmentreport.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class AssessmentreportComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  fileeselecterror = false;
  length = '';
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  btnactive : boolean
  deleteicon = true;
  assessmentType = '';
  examType =1;
  favoriteSeason: string;
  seasons: string[] = ['Winter', 'Spring', 'Summer', 'Autumn'];
  questions = [
    {
      question : "Pick your favorite season Test ?",
      answers :['Winter', 'Spring', 'Summer', 'Autumn']
    },
    {
      question : "Pick your favorite season Test1 ?",
      answers :['Winter', 'Spring', 'Summer', 'Autumn']
    },
    {
      question : "Pick your favorite season Test2 ?",
      answers :['Winter', 'Spring', 'Summer', 'Autumn']
    },
    {
      question : "Pick your favorite season Test3 ?",
      answers :['Winter', 'Spring', 'Summer', 'Autumn']
    },
  ];
  knw_file: DriveInput;
  pra_file: DriveInput;
  assessmentReportForm : FormGroup;
  assessmentReportPraticalForm : FormGroup;
  learnerData;
  filemstPk;
  kupload_name;
  pupload_name;
  @ViewChild('kdoc') kdoc: Filee;
  @ViewChild('pdoc') pdoc: Filee;
  id;
  assessmentreport;
  kreport;
  preport;
  formloading = true;
  pracomments = '';
  knwcomments = '';

  constructor(private translate: TranslateService,
    public fb: FormBuilder, 
    private assessmentService: AssessmentReportService, 
    private route: ActivatedRoute,
    protected router: Router,
    private cookieService: CookieService,
    private remoteService: RemoteService,
    ){}

  

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


    this.id = this.route.snapshot.paramMap.get('id');
    this.getlearnerdata(this.id);
    
    this.knw_file = {
      fileMstPk: 5,
      selectedFilesPk: []
    }
    this.pra_file = {
      fileMstPk: 6,
      selectedFilesPk: []
    }
  }

  getlearnerdata(id)
  {
    this.assessmentService.getleanerdata(id).subscribe(data=>{
      this.learnerData = data.data;
      if(this.learnerData.isknw == 1 && this.learnerData.ispra == 1 && this.learnerData.status == 6){
        if(this.learnerData.kStatus == null){
          this.btnactive = false;
          this.assessmentType = 'Knowleadge'
        } 
        else if(this.learnerData.pStatus == null){
          this.btnactive = true;
          this.assessmentType = 'pratical'
        } 
      }
      if(this.learnerData.isknw == 1 && this.learnerData.ispra == 1 && (this.learnerData.status == 6 || this.learnerData.status == 8)){
        if(this.learnerData.kStatus != null && this.learnerData.pStatus != null){
          this.btnactive = false;
          this.assessmentType = 'Knowleadge'
        } 
      }
       else if(this.learnerData.isknw == 1 && this.learnerData.ispra != 1 && !this.learnerData.kStatus && this.learnerData.status == 6){
        this.btnactive = false;
        this.assessmentType = 'Knowleadge'
      } else if(this.learnerData.isknw != 1 && this.learnerData.ispra == 1 && !this.learnerData.pStatus && this.learnerData.status == 6){
        this.btnactive = true;
        this.assessmentType = 'pratical'
      } else if(this.learnerData.isknw == 1 && this.learnerData.ispra == 1 && this.learnerData.status == 8){
        this.btnactive = false;
        this.assessmentType = 'Knowleadge'
      }  else if(this.learnerData.isknw == 1 && this.learnerData.ispra != 1 && this.learnerData.kStatus && this.learnerData.status == 8){
        this.btnactive = false;
        this.assessmentType = 'Knowleadge'
      } else if(this.learnerData.isknw != 1 && this.learnerData.ispra == 1 && this.learnerData.pStatus && this.learnerData.status == 8){
        this.btnactive = true;
        this.assessmentType = 'pratical'
      }

      if(this.learnerData.status == 6 && (((this.learnerData.isknw == 1 && this.learnerData.ispra == 1) && (!this.learnerData.kStatus || !this.learnerData.pStatus)) || ((this.learnerData.isknw != 1 && this.learnerData.ispra == 1) && !this.learnerData.pStatus) || (this.learnerData.isknw == 1 && this.learnerData.ispra != 1) && !this.learnerData.kStatus ) ){
        this.assessmentReportForm = this.fb.group({
          type: ["1"],
          totalmark: [this.learnerData.ktotalmark],
          mark: ["", [Validators.required,Validators.maxLength(3), Validators.min(0), Validators.max(this.learnerData?.ktotalmark)]],
          percentage: [""],
          comments: [""],
          file: ["", Validators.required]
        });
        this.assessmentReportPraticalForm = this.fb.group({
          type: ["1"],
          comments: [""],
          file: ["", Validators.required]
        });
        this.formloading = false;
        if(this.learnerData.ispra == 1 && this.learnerData.ispramark == 1){
          this.assessmentReportPraticalForm.addControl('totalmark',new FormControl(this.learnerData.ptotalmark));
          this.assessmentReportPraticalForm.addControl('mark',new FormControl('', [Validators.required,Validators.maxLength(3),Validators.min(0), Validators.max(this.learnerData?.ptotalmark)]));
          this.assessmentReportPraticalForm.addControl('percentage',new FormControl(''));
        } else if(this.learnerData.ispra == 1 && this.learnerData.ispramark != 1){
          this.assessmentReportPraticalForm.addControl('status',new FormControl('', Validators.required));
        }
      } 

      if(this.learnerData.status == 8 || (this.learnerData.status == 6 && (((this.learnerData.isknw == 1 && this.learnerData.ispra == 1) && (this.learnerData.kStatus && this.learnerData.pStatus)) || ((this.learnerData.isknw != 1 && this.learnerData.ispra == 1) && this.learnerData.pStatus) || (this.learnerData.isknw == 1 && this.learnerData.ispra != 1) && this.learnerData.kStatus ) )){
          this.getassessmentreport(this.learnerData.learnerPK)
      } 
      if(this.learnerData.commentBy){
        this.assessmentService.getuser(this.learnerData.commentBy).subscribe(res=>{
          this.learnerData.commentByname = res.data.oum_firstname;
        })

      }
      
    });
  }

  getassessmentreport(id)
  {
    this.assessmentService.getassessmentreport(id).subscribe(data=>{
      this.assessmentreport = data.data;
      let kreport = this.assessmentreport.filter(item => item.data.asmtm_InternalAsmt == 1)
      this.kreport = kreport.length > 0 ? kreport[0].data : null
      let preport = this.assessmentreport.filter(item => item.data.asmtm_InternalAsmt == 2)
      this.preport = preport.length > 0 ? preport[0].data : null
      if(this.kreport != null){
        this.assessmentReportForm = this.fb.group({
          type: [this.kreport.lasmth_AsmtType, Validators.required],
          totalmark: [Math.trunc(this.kreport.lasmth_TotalMarks)],
          mark: [Math.trunc(this.kreport.lasmth_MarkSecured), [Validators.required, Validators.maxLength(3), Validators.min(0), Validators.max(this.learnerData?.ktotalmark)]],
          percentage: [Math.trunc(this.kreport.lasmth_percentage)],
          comments: [this.kreport.lasmth_AppdecComments],
          file: [this.kreport.lasmth_AsmtUpload, Validators.required]
        });
        this.knwcomments = this.kreport.lasmth_AppdecComments;
        this.knw_file.selectedFilesPk = (this.kreport?.lasmth_AsmtUpload !== null) ? this.kreport.lasmth_AsmtUpload.split(',') : null;
        setTimeout(() => this.kdoc?.triggerChange(), 500);
      }      
      if(this.preport != null){
        this.assessmentReportPraticalForm = this.fb.group({
          type: [this.preport.lasmth_AsmtType, Validators.required],
          comments: [this.preport.lasmth_AppdecComments],
          file: [this.preport.lasmth_AsmtUpload, Validators.required]
        });
        if(this.learnerData.ispra == 1 && this.learnerData.ispramark == 1){
          this.assessmentReportPraticalForm.addControl('totalmark',new FormControl(Math.trunc(this.preport.lasmth_TotalMarks)));
          this.assessmentReportPraticalForm.addControl('mark',new FormControl(Math.trunc(this.preport.lasmth_MarkSecured), [Validators.required, Validators.maxLength(3), Validators.min(0), Validators.max(this.learnerData?.ptotalmark)]));
          this.assessmentReportPraticalForm.addControl('percentage',new FormControl(Math.trunc(this.preport.lasmth_percentage)));
        } else if(this.learnerData.ispra == 1 && this.learnerData.ispramark != 1){
          this.assessmentReportPraticalForm.addControl('status',new FormControl(this.learnerData.pStatus, Validators.required));
        }
        this.pracomments = this.preport.lasmth_AppdecComments;
        this.pra_file.selectedFilesPk = (this.preport?.lasmth_AsmtUpload !== null) ? this.preport.lasmth_AsmtUpload.split(',') : null;
        setTimeout(() => this.pdoc?.triggerChange(), 500);
      }      
      this.formloading = false;
    });
  }

  // get form() { return this.assessmentReportForm.controls; }

  isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }


  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    this.assessmentReportForm.controls['file'].setValue(file[0]);
    this.kupload_name = fileId.selectedFilesPk[0];
   }

   pfileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;

    this.assessmentReportPraticalForm.controls['file'].setValue(file[0]);
    this.pupload_name = fileId.selectedFilesPk[0];
   }


  changeassessment(type){
    if(type == 'knowleadge'){
      this.btnactive = false
      this.assessmentType = 'Knowleadge'
    } else{
      this.btnactive = true
      this.assessmentType = 'pratical'
    }
  }

  calculatedpercentage(type){
    if(type == 'knowleadge'){
      let perc = Math. round(( +this.assessmentReportForm.controls['mark'].value / this.learnerData.ktotalmark) * 100);
      this.assessmentReportForm.controls['percentage'].setValue(perc);
    } else{
      if(this.learnerData.ispra == 1 && this.learnerData.ispramark == 1){
        let perc = Math. round(( +this.assessmentReportPraticalForm.controls['mark'].value / +this.learnerData.ptotalmark) * 100);
        this.assessmentReportPraticalForm.controls['percentage'].setValue(perc);
      }
    }
    
  }

  onSubmit(type){
    console.log("this.assessmentReportPraticalForm", this.assessmentReportPraticalForm);
   if((this.assessmentReportForm?.valid && this.assessmentType == 'Knowleadge') || (this.assessmentReportPraticalForm?.valid && this.assessmentType == 'pratical')){

     this.formloading = true;
     let data;
     if(type == 'knowleadge' ){
       data = this.assessmentReportForm.value;
       data.status = this.learnerData.kminmark <= +data.mark ? 'Pass' : 'Fail';
     } else{
       data = this.assessmentReportPraticalForm.value;
       if(this.learnerData.ispramark == 1){
         data.status = this.learnerData.pminmark <= +data.mark ? 'Pass' : 'Fail';
       }
     }
     
     data.learnerPK = this.learnerData.learnerPK;
     data.batckPK = this.learnerData.batckPK;
     data.batchassessor = this.learnerData.batchassessor;
     data.staffPK = this.learnerData.staffPK;
     data.standcoursePK = this.learnerData.standcoursePK;
     data.asmtstatus = 1;
     data.assessmentType = type == 'knowleadge' ? 1 : 2;
     //data.type = 1;
     if(type == 'knowleadge' && this.kreport?.LearnerAsmtHdr_PK){
       data.LearnerAsmtHdr_PK = this.kreport.LearnerAsmtHdr_PK;
     }
     if(type != 'knowleadge' && this.preport?.LearnerAsmtHdr_PK){
       data.LearnerAsmtHdr_PK = this.preport.LearnerAsmtHdr_PK
     }
     
     
     this.assessmentService.saveassessmentreport(data).subscribe(res=>{
 
       if(this.learnerData.isknw == 1 && this.learnerData.ispra == 1 && type == 'knowleadge'){
         this.changeassessment('partical')
         this.formloading = false;
       } else{
         this.updatestatus();
         this.formloading = false;
       }
     })
   } else{
    this.fileeselecterror = true
   }


  }

  updatestatus(){
    this.assessmentService.updatelearnerstatus(this.id).subscribe(res=>{
      swal({
        title: this.i18n('assesmentport.savesucc'),
        text: " ",
        icon: 'success',
        buttons: [false, this.i18n('assesmentport.ok')],
        dangerMode: true,
        closeOnClickOutside: false
      }).then(() => {
        this.formloading = false;
        this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);
      });
    })
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
   cancle() {
    
    this.knw_file.selectedFilesPk = [];
    this.kdoc?.triggerChange();
    this.pra_file.selectedFilesPk = [];
    this.pdoc?.triggerChange();
    this.knwcomments = '';
    this.pracomments = '';
    this.assessmentReportForm?.reset();
    this.assessmentReportPraticalForm?.reset()
    this.assessmentReportForm?.controls['type']?.setValue(1);
    this.assessmentReportForm?.controls['totalmark']?.setValue(this.learnerData.ktotalmark);
     this.assessmentReportPraticalForm.controls['type']?.setValue(1);
   this.assessmentReportPraticalForm.controls['totalmark']?.setValue(this.learnerData.ptotalmark);
    //location.reload()
    this.router.navigate(['candidatemanagement/viewlearner/' + this.learnerData.batchNo]);
    
   }

}

