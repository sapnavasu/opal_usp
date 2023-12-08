import {Component, OnInit, ViewEncapsulation } from '@angular/core';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { BatchService } from '@app/services/batch.service';
import { changecommentmodal } from '../modal/changecommentmodal';
import { MatDialog } from '@angular/material/dialog';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';


@Component({
  selector: 'app-changeassessor',
  templateUrl: './changeassessor.component.html',
  styleUrls: ['./changeassessor.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ChangeassessorComponent implements  OnInit {
    disableSubmitButton: boolean = false;
  assessorlist: any;
  newassessordata: any;
  stktype: any;
  centretype: any;
  registerPk: any;
  reqassessor: boolean;
  id: string;
  reqtype: any;
  dir: string = 'ltr';
  assignediv: boolean = false;
  ivqastafflist: any = []; 
 
    i18n(key){
      return this.translate.instant(key);
    }
    batchdata_data;
    batchNo;
    assessorData;
    type = 1
    centreOption;
    assignassessorOption;
    ivstaffOption;
    assessorForm : FormGroup;

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
 

    constructor(private translate: TranslateService, 
      private remoteService: RemoteService,
      private cookieService: CookieService,
      private assessmentService: AssessmentReportService,
      public fb: FormBuilder, 
      private batchService: BatchService,
      private router: Router,
      private security:Encrypt,
      private toastr: ToastrService,private localstorage:AppLocalStorageServices,
      private route: ActivatedRoute,private dialog: MatDialog) {}
  

  
    ngOnInit(){
 this.batchNo = this.route.snapshot.paramMap.get('batch');
      this.reqtype = this.route.snapshot.paramMap.get('req');
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
      });

      //this.route.queryParams.subscribe(data => {
      //  this.batchNo = data.id;
      //  this.reqtype = data.req;
      //});
      this.disableSubmitButton = true;
      this.registerPk = this.localstorage.getInLocal('registerPk');
      this.stktype = this.localstorage.getInLocal('stktype');
      this.centretype = this.localstorage.getInLocal('regtype');
      this.getbatchdtls(this.batchNo);
       this.getassessordata(this.batchNo);
      this.assessorForm = this.fb.group({
        centre: [{value:"", disabled: true}, Validators.required],
        assessor: ["", Validators.required],
        ivstaff: ["", Validators.required],
        newassessor: ["", Validators.required],
        comments: ["", Validators.required],
        newivqa:["", Validators.required]
      });

      if(this.stktype==1 && this.reqtype == 1)
      {
        this.disableSubmitButton = true;
        this.getchangeassesorReq();
      }
     
      
    }

   

    getIvQastaff(value) {
      let encpk = this.security.encrypt(value.assesorpk);
      let body = JSON.stringify({
        pk: encpk,
        coursepk: this.batchdata_data.coursepk,
        subcate: this.batchdata_data.subcate,
        language: this.batchdata_data.lang,
        wilayat: this.batchdata_data.wilayat,
      });
      this.batchService.getIVQAStaffByAssessor(body).subscribe(response => {
        this.ivqastafflist =[];
        if (response.data.status == 1) {
          this.ivqastafflist = response.data.data;
          console.log(this.ivqastafflist);
          this.assignediv =true;
         
        }
        else if (response.data.status == 3) {
          this.ivqastafflist.push(response.data.data);
          console.log(this.ivqastafflist);
          this.assignediv =true;
         
        }
        else {
          swal({
            title:  this.i18n('No IVQA Staff Found for the Selected Assessor'),
            icon: 'warning',
            buttons: [ false, this.i18n('changeassesor.yes') ],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
          this.ivqastafflist = [];
          this.assignediv =false;
         
         
        }
      });
    }

    getchangeassesorReq()
    {
      this.batchService.getchangeassesorReq(this.batchNo).subscribe(res=>{
        this.assessorData = res.data.data;
        this.centreOption=this.assessorData;
        this.assignassessorOption=this.assessorData;
        this.ivstaffOption=this.assessorData;
        
        console.log(this.assessorData)
      });
    }
 
    getbatchdtls(batchno)
    {
      this.disableSubmitButton = true;
      this.assessmentService.getbatchdetails(batchno).subscribe(data=>{
        
        this.batchdata_data = data.data;
        
        if(this.batchdata_data.trainingcentre == this.batchdata_data.assesmentcentre && this.registerPk)
        {
          
           this.getassessordata(this.batchNo);
        } 
        else if(this.stktype== 1)
        {
            this.getchangeassesorReq();
        }
        else{
          this.getassessordata(this.batchNo);
        }
        console.log(this.batchdata_data);
     
        
      });
    }

    getassessordata(batchno){
      this.disableSubmitButton = true;
      this.assessmentService.getassessordetails(batchno).subscribe(res=>{
        this.assessorData = res.data.data;
        this.centreOption=this.assessorData;
        this.assignassessorOption=this.assessorData;
        this.ivstaffOption=this.assessorData;
        
        this.changeassessor(res.data.data[0]);
      });
    }

    changeassessor(option){
      this.disableSubmitButton = true;
      this.batchService.getassessorlistbybatchpk(this.batchNo,option,this.batchdata_data.assessmentcentre).subscribe(res => {
       if(res.data.status == 1)
       {
         this.newassessordata = res.data.data;
         this.reqassessor = false;
         console.log(this.newassessordata);
       }
       else
       {
        if(this.batchdata_data.assType == 17)
        {
          this.reqassessor = true;
          if(this.stktype == 1)
          {
           swal({
             title: this.i18n('changeassesor.noassareavail'),
             text: '',
             icon: 'warning',
             dangerMode: true,
             className: this.dir =='ltr'?'swalEng':'swalAr',
             closeOnClickOutside: false
           });
          }
        }
        else
        {
          this.reqassessor = false;
           swal({
             title: this.i18n('No Assessor Available in your Centre.'),
             text: '',
             icon: 'warning',
             dangerMode: true,
             className: this.dir =='ltr'?'swalEng':'swalAr',
             closeOnClickOutside: false
           }).then((willGoBack) => {
            if (willGoBack) {
              
              this.router.navigate(['batchindex/batchgridlisting']);
            }
          });
        }
       }
      });
      this.assessorForm.controls['centre'].setValue(option);
      this.assessorForm.controls['assessor'].setValue(option);
      this.assessorForm.controls['ivstaff'].setValue(option);
      this.disableSubmitButton = false;
    }

    submitRequest(){
      this.disableSubmitButton = true;
      this.batchService.requesttochangeassesor(this.batchNo,this.assessorForm.controls['assessor'].value,this.assessorForm.controls['comments'].value).subscribe(res => {
        
        this.disableSubmitButton = false;
        if(res.data.status == 1)
        {
          this.toastr.success(this.i18n('changeassesor.chanrequsub'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.router.navigate(['batchindex/batchgridlisting']);
        }
      });

    }
    submit(){
      this.disableSubmitButton = true;
      this.batchService.changeassesor(this.batchNo,this.assessorForm.controls['assessor'].value,this.assessorForm.controls['newassessor'].value,this.assessorForm.controls['comments'].value,this.assessorForm.controls['newivqa'].value).subscribe(res => {
        if(res.data.status == 1)
        {
          this.toastr.success(this.i18n('changeassesor.assechan'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.router.navigate(['batchindex/batchgridlisting']);
        }
      });
      this.disableSubmitButton = false;

    }
   
    getassessmentstatus(no){
      //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
      if(no == 1){
        return 'New';
      } else if(no == 2){
        return 'Teaching(theory)';
      }
      else if(no == 3){
        return 'Teaching(practical)';
      }
      else if(no == 4){
        return 'Assessment';
      }
      else if(no == 5){
        return 'Requested for Back Track';
      }
      else if(no == 6){
        return 'Quality Check';
      }
      else if(no == 7){
        return 'Cancelled';
      }
      else if(no == 8){
        return 'Print';
      }
      else if(no == 9){
        return 'Requested for Assessor change';
      }
      else{
        return '';
      }
    }
    getcomments() {
      
      let dialogRef = this.dialog.open(changecommentmodal, { disableClose: true,   panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field4' },
       });
      dialogRef.afterClosed().subscribe(result => {
         if(result.data)
         {
          this.assessorForm.controls['comments'].setValue(result.data);
          this.submitRequest();
         }
      });
    }

    backtolist()
    {
      swal({
        title:  this.i18n('changeassesor.doyouwanttocanc'),
        text:  this.i18n('changeassesor.ifyesanyunsav'),
        icon: 'warning',
        buttons: [ this.i18n('changeassesor.no'), this.i18n('changeassesor.yes') ],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          
          this.router.navigate(['batchindex/batchgridlisting']);
        }
      });
     
    }

  }
