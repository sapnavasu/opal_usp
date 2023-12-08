import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatPaginator } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import moment from 'moment';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { BatchService } from '@app/services/batch.service';
import { Encrypt } from '@app/common/class/encrypt';
import { Location } from '@angular/common';
import { ActivatedRoute, ParamMap, Router } from '@angular/router';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { commentmodal } from '../modal/commentmodal';
import { MatDialog } from '@angular/material/dialog';
import { ToastrService } from 'ngx-toastr';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import swal from 'sweetalert';

export interface BatchtrainingData {
  selecteddate: any;
  status:any;
  statustime:any;
  start:any
  end:any
}
export interface BatchtrainingDatalist {
  selecteddate: any;
  status:any;
  statustime:any;
}

export const MY_FORMATS = {
  parse: {
      dateInput: 'DD-MM-YYYY',
  },
  display: {
      dateInput: 'DD-MM-YYYY',
      monthYearLabel: 'MMM YYYY',
      dateA11yLabel: 'LL',
      monthYearA11yLabel: 'MMMM YYYY',
  },
};


@Component({
  selector: 'app-batchviewpage',
  templateUrl: './batchviewpage.component.html',
  styleUrls: ['./batchviewpage.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})


export class BatchviewpageComponent implements OnInit {
  batchdetails: any = [];
  batchid: any ;
  disableSubmitButton: boolean = false;
  isfocalpoint: any;
  stktype: any;
  useraccess: any;
  isUserHaveDownAccess: boolean;
  regpk: any;
  learnerdownloadaccess: boolean = false;
  learnerreadaccess: boolean = false;
  learnercreateaccess: boolean= false;
  batchdeleteaccess: boolean= false;
  batchupdateaccess: boolean= false;
  batchcreateaccess: boolean= false;
  batchreadaccess: boolean= false;
  assesmentcrete: boolean;
  batchapproveaccess: boolean;
 
  
  i18n(key) {
    return this.translate.instant(key);
  }
  
  timeform: FormGroup;
  values = [];
  defaultValue = { hour: 13, minute: 30 };
  batchtraningdata_data: any = [];
  batchtraningdata_datalist : any = [];
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
 
  @ViewChild("paginator") paginator: MatPaginator;
  MRM_CreatedOn = new FormControl('');
  MRM_CreatedOnPract = new FormControl('');
  BatchtrainingData = ['selecteddate','dayscheduled','starttime','endtime','time'];
  batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);
  BatchtrainingDatalist = ['selecteddate','dayscheduled','starttime','endtime','time'];
  batchtrainingdatalist = new MatTableDataSource<BatchtrainingDatalist>(this.batchtraningdata_datalist);
  selected2 = moment();
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  resultsLength: number;
  alwaysShowCalendars: boolean;
  locale: LocaleConfig = {
    format:'DD-MM-YYYY',
  }
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  constructor( private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private batchService: BatchService,
    private router:Router,
    private dialog:MatDialog,
    private toastr:ToastrService,
    private activatedRoute: ActivatedRoute,
    private _location: Location,
    private localstorage:AppLocalStorageServices,
    private security: Encrypt) { }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
{ "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
dir = 'ltr';

  ngOnInit(): void {

    
    this.activatedRoute.paramMap.subscribe((params: ParamMap) => {
      this.batchid =  params.get('batch');  
    })


    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.regpk = this.localstorage.getInLocal('registerPk');

    this.useraccess = this.localstorage.getInLocal('uerpermission');

    if(this.isfocalpoint == 1){
      this.learnerdownloadaccess = true;
      this.learnerreadaccess = true;
      this.learnercreateaccess = true;
      this.batchdeleteaccess = true;
      this.batchupdateaccess = true; 
      this.batchcreateaccess = true;
      this.batchapproveaccess = true;
      this.batchreadaccess = true;
      this.assesmentcrete = true;
    }

    if(this.isfocalpoint == 2){
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
      let submodulebatch = this.stktype == 1 ? 4 : 21 ;
      let submodulelearner = this.stktype == 1 ? 5 : 22 ;
      let submodulelearnerdownload = this.stktype == 1 ? 6 : 23 ;
      let submodulelearnerassessment = this.stktype == 1 ? 7 : 24 ;

      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].read == 'Y'){
        this.batchreadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].create == 'Y'){
        this.batchcreateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].update == 'Y'){
        this.batchupdateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].delete == 'Y'){
        this.batchdeleteaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulebatch] && this.useraccess[moduleid][submodulebatch].approval == 'Y'){
        this.batchapproveaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerdownload] && this.useraccess[moduleid][submodulelearnerdownload].download == 'Y'){
        this.learnerdownloadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].read == 'Y'){
        this.learnerreadaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearner] && this.useraccess[moduleid][submodulelearner].create == 'Y'){
        this.learnercreateaccess = true;
      }
      if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulelearnerassessment] && this.useraccess[moduleid][submodulelearnerassessment].create == 'Y'){
        this.assesmentcrete = true;
    }
    }
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
    if(this.isfocalpoint==2){
      let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Batch Management');
      if(this.useraccess[moduleid] && this.useraccess[moduleid].download == 'Y'){
        this.isUserHaveDownAccess = true;
      }
    }
   
    this.getBatchdetails(this.batchid);
  }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      console.log('page-content')
    } catch (error) {
      // console.log('page-content')
    }
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('course.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('course.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  clickEventfilter() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('course.showfilt');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('course.hidefilt');
      const id = document.getElementById('filtershow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  getBatchdetails(bid)
  {

    let encbid = this.security.encrypt(bid);
    this.disableSubmitButton = true;
    this.batchService.fetchBatchdetails(encbid).subscribe(response => {
      if(response.status == 200)
      { 
        this.batchdetails = response.data;
        if(this.batchdetails.theoryslots)
        {
          this.batchdetails.theoryslots.forEach(element => {

            let obj = {
              selecteddate : element.selecteddate,
              dayscheduled : element.dayschedule,
              startendtime : element.schedule,
              start: element.start,
              end: element.end,
              diff:element.diff
            }
            this.batchtraningdata_data.push(obj);
          });
          this.batchtrainingdata = new MatTableDataSource<BatchtrainingData>(this.batchtraningdata_data);
        }
        if(this.batchdetails.practslots)
        {
          this.batchdetails.practslots.forEach(element => {

            let obj = {
              selecteddate : element.selecteddate,
              dayscheduled : element.dayschedule,
              startendtime : element.schedule,
              start: element.start,
              end: element.end,
              diff:element.diff
            }
            this.batchtraningdata_datalist.push(obj);
          });
          this.batchtrainingdatalist = new MatTableDataSource<BatchtrainingDatalist>(this.batchtraningdata_datalist);
        }
       
      }
      this.disableSubmitButton = false;

    });
   
  }

  CancelBatch(data)
  {
    
    this.disableSubmitButton = true ;
       this.batchService.ChangeBatchStatus(this.batchid,'cancel','Due to cancelled').subscribe(res => {
         if(res.data.status == 1)
         {
          this.getBatchdetails(this.batchid);
         
         }
        });
  }
  
  goBack() {
    this._location.back();
  }


  RegisterLearner(data)
  {
      this.router.navigate(['/candidatemanagement/learner-register/'+ this.batchid]);
  }
  ViewLearners(data)
  {
      this.router.navigate(['/candidatemanagement/viewlearner/'+ this.batchid]);
  }

  ChangeAssessor(data) {
    this.router.navigate(['/assessmentreport/changeassessor/'+data.batch_no+'/false']);
  }

  ChangeAssessorReq(data) {
    this.router.navigate(['/assessmentreport/changeassessor/'+data.batch_no+'/true']);
  }

  requesttrack(batchdata) {
    console.log(batchdata);
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field2', batchid: batchdata.batch_no },
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result.data) {
        this.Requestforbacktrack(batchdata, result.data.comments);
      }
    });
  }

  Requestforbacktrack(data, comments) {
   
    this.disableSubmitButton = true;
    this.batchService.Requestforbacktrack(data.batch_no, comments).subscribe(res => {
      if (res.data.status == 1) {
        this.toastr.success(this.i18n('common.request'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.getBatchdetails(this.batchid);
      }
        this.disableSubmitButton = false;
      
    });
  }

  updatestatus(batchdata) {
    let dialogRef = this.dialog.open(commentmodal, {
      disableClose: true, panelClass: 'commentfielsmodal',
      data: { fieldToShow: 'field3', batchid: batchdata.batch_no, currentstatus: batchdata.status},
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result.data) {
        this.UpdateStatus(batchdata, result.data.status);
      }
    });
  }
  
  UpdateStatus(data, newstatus) {
    this.batchService.ChangeBatchStatus(data.batch_no, newstatus).subscribe(res => {
      if (res.data.status == 1) {
        this.getBatchdetails(this.batchid);
        this.toastr.success(this.i18n('common.updatebatch'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });
  }

  downloadAttenance(data) {
    this.batchService.downloadattendance(data.batch_no).subscribe(res => {
      if (res.data.status == 1) {
        window.open(res.data.attend, '_blank');
      }
    });
  }

  MovebatchToTheory(batchdata) {
    swal({
      title: 'Do you want to Move this Batch to Teaching (Theory)?',
      icon: 'warning',
      buttons: [this.i18n('course.no'), this.i18n('course.yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.batchService.MovebatchToTheory(batchdata.batch_no).subscribe(res => {
          if (res.data.status == 1) {
            this.getBatchdetails(this.batchid);
            this.toastr.success(this.i18n('common.updatebatch'), ''), {
          timeOut: 2000,
          closeButton: false,
        };  
          }
        });
      }

    });

  }
     
}
