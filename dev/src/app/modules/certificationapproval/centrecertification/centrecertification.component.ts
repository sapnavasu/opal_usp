import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ApplicationService } from '@app/services/application.service';
import {  Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { MatSort } from '@angular/material/sort';
import { MatCheckbox } from '@angular/material/checkbox';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import {merge} from 'rxjs/observable/merge';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import { ActivatedRoute } from '@angular/router';
import {map} from 'rxjs/operators/map'
import {catchError} from 'rxjs/operators/catchError';
import { Observable } from 'rxjs/Observable';
import {of as observableOf} from 'rxjs/observable/of';
import swal from 'sweetalert';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { P } from '@angular/cdk/keycodes';
import { THIS_EXPR } from '@angular/compiler/src/output/output_ast';
export interface BranchData {
  applictionno: any;
  offictype: any;
  compname: any;
  trainprovname:any;
  branchname: any;
  sitelocan:any;
  applytype: any;
  grade: any;
 
 
  
  position: any;
  applicationstatus: any;
  certification: any;
  addedon: any;
  dateofexpiry: any;
  lastUpdated: any;
}
// const BranchList_Data: BranchData[] = [
//   { position: 1, applictionno: 'General Electric', offictype: 'Main Branch', compname: 'IMA',trainprovname:'knowledge grid academy', branchname: 'Direct Contract', sitelocan:'Site location',applytype: 'Standard' ,applicationstatus: 'A',  certification: 'A', grade: 'cyber Security' ,dateofexpiry: '23-04-2024',addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 2, applictionno: 'General Electric', offictype: 'Main Branch', compname: 'IMA',trainprovname:'knowledge grid academy', branchname: 'Direct Contract', sitelocan:'Site location',applytype: 'Standard' ,applicationstatus: 'Y',  certification: 'E', grade: 'cyber Security' ,dateofexpiry: '23-04-2024',addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 3, applictionno: 'General Electric', offictype: 'Main Branch', compname: 'IMA',trainprovname:'knowledge grid academy', branchname: 'Direct Contract', sitelocan:'Site location',applytype: 'Standard' ,applicationstatus: 'P',  certification: 'Y', grade: 'cyber Security' ,dateofexpiry: '23-04-2024',addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 4, applictionno: 'General Electric', offictype: 'Main Branch', compname: 'IMA',trainprovname:'knowledge grid academy', branchname: 'Direct Contract', sitelocan:'Site location',applytype: 'Standard' ,applicationstatus: 'PV', certification: 'E', grade: 'cyber Security' ,dateofexpiry: '23-04-2024',addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 5, applictionno: 'General Electric', offictype: 'Main Branch', compname: 'IMA',trainprovname:'knowledge grid academy', branchname: 'Direct Contract', sitelocan:'Site location',applytype: 'Standard' ,applicationstatus: 'S',  certification: 'Y', grade: 'cyber Security' ,dateofexpiry: '23-04-2024',addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },
//   { position: 6, applictionno: 'General Electric', offictype: 'Main Branch', compname: 'IMA',trainprovname:'knowledge grid academy', branchname: 'Direct Contract', sitelocan:'Site location',applytype: 'Standard' ,applicationstatus: 'D',  certification: 'A', grade: 'cyber Security' ,dateofexpiry: '23-04-2024',addedon: '10-1-2023', lastUpdated: 20 - 1 - 2023 },

// ];
@Component({
  selector: 'app-centrecertification',
  templateUrl: './centrecertification.component.html',
  styleUrls: ['./centrecertification.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class CentrecertificationComponent implements OnInit {
  projectid: number;
  accessauditor: true;
  accessadmin : true;
  accessqualitymanager:true;
  appcontent: string;
  content: string;
  memReg: any;
  regpk: any;
  userPk: any;
  stktype: any;
  role: any;
  isfocalpoint: any;
  useraccess: any;
  approvalaccess: boolean = false;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean  = false;
  projectpk: any;
  accessauditor_i: any;
  accessqualitymanager_i: any;
  accessauditor_up: any;
  accessauditor_r: any;
  accessqualitymanager_up: any;
  accessqualitymanager_u: any;
  accessqualitymanager_r: any;
  accesssuperadmin: any;
  accessproject: any = false;
  accessAuthority_i:any;
  accessceo_i:any;
  apparray = [];
  auditreportapproval: boolean = false;
  i18n(key) {
    return this.translate.instant(key);

  }
  resultsLength: number;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page: number = 10;
  // resultsLength: number;
  @ViewChild("paginator") paginator: MatPaginator;
  public appListData: MatTableDataSource<any>;
  GridDatas: AppTempPagination;
  @ViewChild(MatSort) sort: MatSort;
  private querystr: string;
  exportlink:string;
  popupnoaccsite: any;
   // work
   @ViewChild('chkWork') chkWork: MatCheckbox;
   public selectAllWork: boolean = false;
  // BranchListData = ['appdt_appreferno', 'appiit_officetype', 'omrm_companyname_en' ,'omrm_tpname_en', 'appiit_branchname_en',
  // 'sitelocan' ,'appdt_apptype' , 'appdt_status' , 'appdt_certificategenon','appdt_grademst_fk' , 'asd_date' , 'appdt_certificateexpiry' , 'appdt_submittedon', 'appdt_updatedon', 'action'];
  BranchListData = [
    { dispalycolum: "appdt_appreferno", workSrch: "row-first", label: "branch.applform", hideShow: true, disoperate: true },
    { dispalycolum: "appiit_officetype", workSrch: "row-second", label: "branch.offitype", hideShow: true, disoperate: false },
    { dispalycolum: "omrm_companyname_en", workSrch: "row-three", label: "branch.compname", hideShow: true, disoperate: false },
    { dispalycolum: "omrm_tpname_en", workSrch: "row-four", label: "branch.trainprovname", hideShow: true, disoperate: false },
    { dispalycolum: "appiit_branchname_en", workSrch: "row-five", label: "branch.branchname", hideShow: false, disoperate: true },
    { dispalycolum: "sitelocan", workSrch: "row-six", label: "branch.sitelocan", hideShow: true, disoperate: false },
    { dispalycolum: "appdt_apptype", workSrch: "row-seven", label: "branch.applytype", hideShow: true, disoperate: false },
    { dispalycolum: "appdt_status", workSrch: "row-eight", label: "branch.applstat", hideShow: true, disoperate: false },
    { dispalycolum: "appdt_certificategenon", workSrch: "row-nine", label: "branch.certstat", hideShow: false, disoperate: false },
    { dispalycolum: "appdt_grademst_fk", workSrch: "row-ten", label: "branch.grad", hideShow: false, disoperate: false },
    { dispalycolum: "asd_date", workSrch: "row-new", label: "Site Audit Scheduled on", hideShow: true, disoperate: true },
    { dispalycolum: "appdt_certificateexpiry", workSrch: "row-eleven", label: "branch.dateofexpi", hideShow: true, disoperate: true },
    { dispalycolum: "appdt_submittedon", workSrch: "row-twelve", label: "branch.addon", hideShow: true, disoperate: true },
    { dispalycolum: "appdt_updatedon", workSrch: "row-thrideen", label: "branch.lastupdat", hideShow: false, disoperate: true },
    { dispalycolum: "action", workSrch: "row-fourteen", label: "branch.action", hideShow: true, disoperate: true },
  ];
  // displayed column
  getworkExperienceList(): string[] {
    return this.BranchListData.filter(wrk => wrk.hideShow).map(wrk => wrk.dispalycolum);
  }
  // displayed search
  getBranchListDatasearch(): string[] {
    return this.BranchListData.filter(wrk => wrk.hideShow).map(wrk => wrk.workSrch);
  }
  // column edit function
  selectAllworkExperienceListFun(event: any) {
    this.selectAllWork = event.checked;
    this.BranchListData.forEach(item => {
      item.hideShow = this.selectAllWork;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);

  }
  // column edit function
  updateSelectAllworkExperienceList(item: any) {
    const workChk = this.BranchListData.every(item => item.hideShow);
    if (workChk) {
      this.chkWork.checked = true;
    } else {
      this.chkWork.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 300);
  }
  appdt_appreferno:  FormControl;
  appiit_officetype:  FormControl;
  omrm_companyname_en:  FormControl;
  omrm_centrename:  FormControl;
  omrm_branch_en:  FormControl;
  appdt_apptype:  FormControl;
  omrm_tpname_en:  FormControl;
  FormControl:  FormControl;
  appl_status:  FormControl;
  cert_status:  FormControl;
  grade:  FormControl;
  expirydate:  FormControl;
  appdt_status: FormControl;
  appdt_certificateexpiry:FormControl;
  appdt_submittedon:FormControl;
  appdt_updatedon:FormControl;
  appdt_grademst_fk:FormControl;
  certificatestatus: number;
  appdt_siteaudit: FormControl;
  appiit_branchname_en :FormControl;
  asd_date:FormControl;
  noData: any = '';
  popupcontent: any;
  buttoncont: any;
 // TrainingBranchData = new MatTableDataSource<BranchData>(BranchList_Data);
 disableSubmitButton: boolean = false;
//  selected2 = moment();
  tblplaceholder: boolean = false;
  popupnoaccinvoice: any;
  popupnoacc: any;
  popupnoaccpaym: any;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,private localstorage: AppLocalStorageServices,
    private cookieService: CookieService,private appservice : ApplicationService,private route: Router,private security: Encrypt,private http: HttpClient,public routeid: ActivatedRoute  ) { }
    ifarabic: boolean = false;
    ifarabicpop: boolean = false;
    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
    locale: LocaleConfig = {
      format: 'DD-MM-YYYY',
    }
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  dataSource;
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
        this.ifarabicpop = false;
      }else{
        this.filtername = "إخ�?اء التص�?ية";

        this.ifarabicpop = true;  }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;
      this.ifarabicpop = false; 
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
          this.filtername = "Hide Filter";
          this.ifarabicpop = false; 
        }
        else {
          this.ifarabic = true;
          this.filtername = "إخ�?اء التص�?ية";

          this.ifarabicpop = true; 
        }

      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabicpop = false; 
      }
    });
   
    this.routeid.params.subscribe(params => {
      this.projectpk = this.security.decrypt(params['id']);
      });

    this.memReg = this.localstorage.getInLocal('reg_pk');
    this.regpk = this.localstorage.getInLocal('registerPk');
    this.userPk = this.localstorage.getInLocal('userPk');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.role = this.localstorage.getInLocal('role');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.useraccess = this.localstorage.getInLocal('uerpermission');
    console.log(this.useraccess , 'userpermission');
  //   console.log('regpk',this.regpk)
  //   console.log('userPk',this.userPk)
  //   console.log('stktype',this.stktype)
    console.log('role',this.role)
  //   console.log('isfocalpoint',this.isfocalpoint)
  //  console.log('useraccess',this.useraccess[6][10])
      if(this.isfocalpoint == 1){
        this.approvalaccess = true;
        this.downloadaccess = true;
        this.readaccess = true;
        this.createaccess = true;
        this.updateaccess = true;

      }

       if(this.isfocalpoint == 2){
        let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Approval Management');
       if(this.projectpk  == 1){
        if(this.useraccess[moduleid]  && this.useraccess[moduleid][10]?.submodules == 'Training Evaluation Centre Approval' && this.useraccess[moduleid][10].approval == 'Y'){
          this.approvalaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][10]?.submodules == 'Training Evaluation Centre Approval' && this.useraccess[moduleid][10].download == 'Y'){
          this.downloadaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][10]?.submodules == 'Training Evaluation Centre Approval' && this.useraccess[moduleid][10].read == 'Y'){
          this.readaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][10]?.submodules == 'Training Evaluation Centre Approval' && this.useraccess[moduleid][10].create == 'Y'){
          this.createaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][10]?.submodules == 'Training Evaluation Centre Approval' && this.useraccess[moduleid][10].update == 'Y'){
          this.updateaccess = true;
        }
       } 
       if(this.projectpk  == 4){
        if(this.useraccess[moduleid]  && this.useraccess[moduleid][12]?.submodules == 'Technical Inspection Centre Approval' && this.useraccess[moduleid][12].approval == 'Y'){
          this.approvalaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][12]?.submodules == 'Technical Inspection Centre Approval' && this.useraccess[moduleid][12].download == 'Y'){
          this.downloadaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][12]?.submodules == 'Technical Inspection Centre Approval' && this.useraccess[moduleid][12].read == 'Y'){
          this.readaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][12]?.submodules == 'Technical Inspection Centre Approval' && this.useraccess[moduleid][12].create == 'Y'){
          this.createaccess = true;
        }
        if(this.useraccess[moduleid] && this.useraccess[moduleid][12]?.submodules == 'Technical Inspection Centre Approval' && this.useraccess[moduleid][12].update == 'Y'){
          this.updateaccess = true;
        }
       }
       console.log( this.approvalaccess , 'read');
     }

     if(this.readaccess == false){
           
      swal({
        title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
        text: '',
        icon: 'warning',
        buttons: [false,this.i18n('Ok')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.route.navigate(['/dashboard/portaladmin']);
        }
      });
    }

    this.appdt_appreferno = new FormControl('');
    this.appiit_officetype = new FormControl('');
    this.omrm_companyname_en = new FormControl('');
    this.omrm_centrename = new FormControl('');
    this.omrm_branch_en = new FormControl('');
    this.appdt_apptype = new FormControl('');
    this.omrm_tpname_en = new FormControl('');
    this.appdt_status = new FormControl('');
    this.appdt_grademst_fk= new FormControl('');
    this.cert_status = new FormControl('');
    this.appdt_certificateexpiry = new FormControl('');
    this.appdt_submittedon = new FormControl('');
    this.appdt_updatedon = new FormControl('');
    this.appdt_siteaudit = new FormControl('');
    this.asd_date = new FormControl('');
    this.appiit_branchname_en = new FormControl('');
    this.disableSubmitButton = true; 
  //  this.getAppTempDtls();
   setTimeout(() => {
    this.disableSubmitButton = false;
   }, 2000);
    this.appdt_appreferno.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.appiit_officetype.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    
    this.omrm_companyname_en.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )
    this.omrm_branch_en.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )
    
    this.appiit_branchname_en.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )
    this.appdt_apptype.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.omrm_tpname_en.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.omrm_branch_en.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.appdt_apptype.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.appdt_status.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.appdt_certificateexpiry.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.appdt_submittedon.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )
    this.appdt_updatedon.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    

    this.appdt_grademst_fk.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )

    this.cert_status.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )
    this.asd_date.valueChanges.debounceTime(400).subscribe( 
      register => { 
        if (register != null ) {
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }else if(register == ''){
          this.paginator.pageIndex = 0;
          this.getAppTempDtls();   
        }    
      }
    )
    if(this.projectpk == '1') {
      this.BranchListData  = [
        { dispalycolum: "appdt_appreferno", workSrch: "row-first", label: "branch.applform", hideShow: true, disoperate: true },
        { dispalycolum: "appiit_officetype", workSrch: "row-second", label: "branch.offitype", hideShow: true, disoperate: false },
        { dispalycolum: "omrm_companyname_en", workSrch: "row-three", label: "branch.compname", hideShow: true, disoperate: false },
        { dispalycolum: "omrm_tpname_en", workSrch: "row-four", label: "branch.trainprovname", hideShow: true, disoperate: false },
        { dispalycolum: "appiit_branchname_en", workSrch: "row-five", label: "branch.branchname", hideShow: false, disoperate: true },
        { dispalycolum: "sitelocan", workSrch: "row-six", label: "branch.sitelocan", hideShow: true, disoperate: false },
        { dispalycolum: "appdt_apptype", workSrch: "row-seven", label: "branch.applytype", hideShow: true, disoperate: false },
        { dispalycolum: "appdt_status", workSrch: "row-eight", label: "branch.applstat", hideShow: true, disoperate: false },
        { dispalycolum: "appdt_certificategenon", workSrch: "row-nine", label: "branch.certstat", hideShow: false, disoperate: false },
        { dispalycolum: "appdt_grademst_fk", workSrch: "row-ten", label: "branch.grad", hideShow: false, disoperate: false },
        { dispalycolum: "asd_date", workSrch: "row-new", label: "Site Audit Scheduled on", hideShow: true, disoperate: true },
        { dispalycolum: "appdt_certificateexpiry", workSrch: "row-eleven", label: "branch.dateofexpi", hideShow: true, disoperate: true },
        { dispalycolum: "appdt_submittedon", workSrch: "row-twelve", label: "branch.addon", hideShow: true, disoperate: true },
        { dispalycolum: "appdt_updatedon", workSrch: "row-thrideen", label: "branch.lastupdat", hideShow: false, disoperate: true },
        { dispalycolum: "action", workSrch: "row-fourteen", label: "branch.action", hideShow: true, disoperate: true },
      ];
    }else {
      this.BranchListData =  [
        { dispalycolum: "appdt_appreferno", workSrch: "row-first", label: "branch.applform", hideShow: true, disoperate: true },
        { dispalycolum: "appiit_officetype", workSrch: "row-second", label: "branch.offitype", hideShow: true, disoperate: false },
        { dispalycolum: "omrm_companyname_en", workSrch: "row-three", label: "branch.compname", hideShow: true, disoperate: false },
        { dispalycolum: "omrm_branch_en", workSrch: "row-centrename", label: "addroles.centrenam", hideShow: true, disoperate: false },
        { dispalycolum: "appiit_branchname_en", workSrch: "row-five", label: "branch.branchname", hideShow: false, disoperate: true },
        { dispalycolum: "sitelocan", workSrch: "row-six", label: "branch.sitelocan", hideShow: true, disoperate: false },
        { dispalycolum: "appdt_apptype", workSrch: "row-seven", label: "branch.applytype", hideShow: true, disoperate: false },
        { dispalycolum: "appdt_status", workSrch: "row-eight", label: "branch.applstat", hideShow: true, disoperate: false },
        { dispalycolum: "appdt_certificategenon", workSrch: "row-nine", label: "branch.certstat", hideShow: false, disoperate: false },
        // { dispalycolum: "appdt_grademst_fk", workSrch: "row-ten", label: "branch.grad", hideShow: false, disoperate: false },
        { dispalycolum: "asd_date", workSrch: "row-new", label: "Site Audit Scheduled on", hideShow: true, disoperate: true },
        { dispalycolum: "appdt_certificateexpiry", workSrch: "row-eleven", label: "branch.dateofexpi", hideShow: true, disoperate: true },
        { dispalycolum: "appdt_submittedon", workSrch: "row-twelve", label: "branch.addon", hideShow: true, disoperate: true },
        { dispalycolum: "appdt_updatedon", workSrch: "row-thrideen", label: "branch.lastupdat", hideShow: false, disoperate: true },
        { dispalycolum: "action", workSrch: "row-fourteen", label: "branch.action", hideShow: true, disoperate: true },
      ];
    }
    this.getaccessproject();
  }

  ngAfterViewInit(){
    console.log(this.security.encrypt(4) , 'four');
    
      this.routeid.queryParams.subscribe(params => {
        if(params['type']){
         if(params['type'] == 'review'){
           this.appdt_status.setValue(['2','4','20']);
         }
   
         if(params['type'] == 'payment'){
           this.appdt_status.setValue(['6']);
         }
   
         if(params['type'] == 'audit'){
           this.appdt_status.setValue(['9','13']);
         }

         if(params['type'] == 'approval'){
         if(this.isfocalpoint == 1){
            this.appdt_status.setValue(['10','11','12','14','15','16']);
         }else{
          if (this.role.indexOf("3") !== -1) {
            this.apparray.push("10");
            this.apparray.push("14");
          }
          if (this.role.indexOf("4") !== -1) {
            this.apparray.push("11");
            this.apparray.push("15");
          }
          if (this.role.indexOf("7") !== -1) {
            this.apparray.push("12");
            this.apparray.push("16");
          }
          this.appdt_status.setValue(this.apparray);
         }
         
        }
         
       }
     });
    if(this.localstorage.getInLocal('omrm_stkholdertypmst_fk') == '1'){
      this.getAppTempDtls();
    }else{
      this.popupcontent = this.ifarabicpop == true?'No access':'No access';
      this.buttoncont = this.ifarabicpop == true?'OK':'OK';
      this.route.navigate(['/admin/login']);

      swal({
        title: this.popupcontent,
        text: " ",
        icon: 'warning',
        buttons: [false,this.buttoncont ],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        this.disableSubmitButton = true;
        setTimeout(() => {
          this.disableSubmitButton = false;
        }, 2000);
      }); 
      return false;
    }
    // alert(this.projectpk )
   
   }



  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('company.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('company.hitefil');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  syncPrimaryPaginator(event: PageEvent) {
    console.log("dafas",event)
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getAppTempDtls();
  }

  // getAppTempDtls(){
  //   this.appservice.getallappdtls().subscribe(dataRes => {
  //     this.dowloadlogdata = dataRes.data.data;
  //     this.dataSource = new MatTableDataSource<any>(this.dowloadlogdata);
  //     })

  // }

  goToDesktopview(id , access) {
    this.disableSubmitButton = true;
    if(access == true){
      if(this.projectpk == 1) {
    this.route.navigate(['centrecertification/desktopreview/'+this.security.encrypt(id)+'/desktopreview/'+this.security.encrypt(1)+'/'+this.security.encrypt(this.projectpk)]);
      }else {
    this.route.navigate(['centrecertification/rasdesktopreview/'+this.security.encrypt(id)+'/desktopreview/'+this.security.encrypt(1)+'/'+this.security.encrypt(this.projectpk)]);

      }
  }else{
      this.popupnoacc = this.ifarabicpop == true?'No access for desktop review':'No access for desktop review';
      this.buttoncont = this.ifarabicpop == true?'OK':'OK';
      if(this.projectpk == 1) {  
        this.route.navigate(['centrecertification/home/MQ==']);
          }else {
            this.route.navigate(['centrecertification/rashome/NA==']);      
          }
      swal({
        title: this.popupnoacc,
        text: " ",
        icon: 'warning',
        buttons: [false, this.buttoncont],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        
        
      }); 
      return false;  
   }
   this.disableSubmitButton = false;

  }
  goToView(id , approval) {
    this.disableSubmitButton = true;

    if(this.projectpk == 1) {
      this.route.navigate(['centrecertification/desktopreview/'+this.security.encrypt(id)+'/view/'+this.security.encrypt(approval)+'/'+this.security.encrypt(this.projectpk)]);
    }else {
      this.route.navigate(['centrecertification/rasdesktopreview/'+this.security.encrypt(id)+'/view/'+this.security.encrypt(approval)+'/'+this.security.encrypt(this.projectpk)]);
  
        }
  }

  supsendaction(appid,status,companyname){

    if(this.projectpk == 4) {
    if(status == '19'){
      this.appcontent = 'Do you want to confirm suspend the  RAS Inspection Centre Certification of '+companyname+'?';
      this.content = 'The  RAS Inspection Centre Certification has been Suspended.';
    } else{
       this.appcontent = 'Do you want to confirm Activate the  RAS Inspection Centre Certification of '+companyname+'?';
       this.content = 'The  RAS Inspection Centre Certification has been Re-activated.';
    }
  }
  if(this.projectpk == 1) {
    if(status == '19'){
      this.appcontent = 'Do you want to confirm suspend the Centre Certification of '+companyname+'?';
      this.content = 'The Centre Certification has been Suspended.';
    } else{
       this.appcontent = 'Do you want to confirm Activate the Centre Certification of '+companyname+'?';
       this.content = 'The Centre Certification has been Re-activated.';
    }
  }
      
        

        swal({
          title: this.appcontent,
          text: '',
          icon: 'success',
          buttons: [this.i18n('No'), this.i18n('Yes')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
            this.disableSubmitButton = true; 
            this.appservice.updateSuspend(appid,status).subscribe(data => {
              this.disableSubmitButton = false; 
              this.disableSubmitButton = false; 
               swal({
                title:this.content,
                text: " ",
                icon: 'success',
                buttons: [false, this.i18n('company.ok')],
                dangerMode: true,
                className: this.dir =='ltr'?'swalEng':'swalAr',
                closeOnClickOutside: false
              }).then(() => {
                this.getAppTempDtls();   
              });       
            });
 
          }
        });

  }

  getAppTempDtls() {
    // this.disableSubmitButton = true;
    this.tblplaceholder = true;

    this.GridDatas = new AppTempPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};


   gridsearchvalue = {appdt_appreferno:this.appdt_appreferno.value,
    appiit_officetype:this.appiit_officetype.value,
    omrm_companyname_en:this.omrm_companyname_en.value
    ,omrm_branch_en:this.omrm_branch_en.value,appiit_branchname_en:this.appiit_branchname_en.value,
    appdt_apptype:this.appdt_apptype.value,
    appdt_status:this.appdt_status.value,appdt_grademst_fk:this.appdt_grademst_fk.value,cert_status:this.cert_status.value,
    omrm_tpname_en:this.omrm_tpname_en.value, appdt_certificateexpiry:this.appdt_certificateexpiry.value, appdt_submittedon:this.appdt_submittedon.value, appdt_updatedon:this.appdt_updatedon.value,asd_date:this.asd_date.value,};
    merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
         
          return this.GridDatas.appGridUtil(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue),this.projectpk);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          this.accessauditor_i = data['data'].data.accessauditor_i;
          this.accessqualitymanager_i = data['data'].data.accessqualitymanager_i;
          this.accessAuthority_i = data['data'].data.accessAuthority_i;
          this.accessceo_i = data['data'].data.accessceo_i;
          this.accessadmin =  data['data'].data.accessadmin;
          this.accesssuperadmin =  data['data'].data.accesssuperadmin;
          this.accessproject =  data['data'].data.accessproject;
          if(this.accessauditor_i || this.accessqualitymanager_i || this.accessAuthority_i || this.accessceo_i){
          this.auditreportapproval = true;
          }
          if(this.isfocalpoint == 1){
              this.auditreportapproval = true;
          }
          console.log(this.auditreportapproval , 'lpppp');
          // if(this.accessproject == false){

          //   swal({
          //     title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
          //     text: '',
          //     icon: 'warning',
          //     buttons: [false,this.i18n('Ok')],
          //     dangerMode: true,
          //     className: this.dir =='ltr'?'swalEng':'swalAr',
          //     closeOnClickOutside: false
          //   }).then((willGoBack) => {
          //     if (willGoBack) {
          //       this.route.navigate(['/dashboard/portaladmin'])        
          //     }
          //   });
          // }
        // console.log(this.resultsLength , 'lenk');
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.appListData = new MatTableDataSource<any>(data);
        this.appListData.filterPredicate = this.createFilter();
        this.noData = this.appListData.connect().pipe(map(data => data.length === 0));
          this.tblplaceholder = false;
        
        console.log(this.noData )
       });
  }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      let searchTerms = JSON.parse(filter);
             return data.appdt_appreferno.toLowerCase().indexOf(searchTerms.appdt_appreferno) !== -1 &&
             data.appiit_officetype.toLowerCase().indexOf(searchTerms.appiit_officetype) !== -1 &&
             data.omrm_companyname_en.toLowerCase().indexOf(searchTerms.omrm_companyname_en) !== -1 &&
             data.omrm_tpname_en.toLowerCase().indexOf(searchTerms.omrm_tpname_en) !== -1 &&
             data.omrm_branch_en.toLowerCase().indexOf(searchTerms.omrm_branch_en) !== -1 && 
             data.appiit_branchname_en.toLowerCase().indexOf(searchTerms.appiit_branchname_en) !== -1 && 
             
            data.appdt_apptype.toLowerCase().indexOf(searchTerms.appdt_apptype) !== -1 && 
            data.appdt_status.toLowerCase().indexOf(searchTerms.appdt_status) !== -1 && 
            data.appdt_certificategenon.toLowerCase().indexOf(searchTerms.appdt_certificategenon) !== -1 && 
            data.appdt_grademst_fk.toLowerCase().indexOf(searchTerms.appdt_grademst_fk) !== -1 && 
            data.cert_status.toLowerCase().indexOf(searchTerms.cert_status) !== -1 &&
            data.appdt_submittedon.toLowerCase().indexOf(searchTerms.appdt_submittedon) !== -1 && 
            data.appdt_updatedon.toLowerCase().indexOf(searchTerms.appdt_updatedon) !== -1 && 
            data.asd_date.toLowerCase().indexOf(searchTerms.asd_date) !== -1;
        
    }
  return filterFunction;    
  }
  schedule() {
    this.disableSubmitButton = true;
    if(this.projectpk == 1){
      this.route.navigate(['/centrecertification/schedulesiteaudit'],{ queryParams: { id: this.security.encrypt(this.projectpk) }});
    }else{
      this.route.navigate(['/centrecertification/rasschedulesiteaudit'],{ queryParams: { id: this.security.encrypt(this.projectpk) }});
    }
  }
  siteaudit(appid ,access) {
    this.disableSubmitButton = true;
    if(access == true){
      if(this.projectpk == 1){
        this.route.navigate(['/centrecertification/siteaudit'] ,{ queryParams: { id: this.security.encrypt(appid) }});
      }else{
        this.route.navigate(['/standardcourseapproval/rassiteaudit'] ,{ queryParams: { id: this.security.encrypt(appid) }});
      }
      
     
    // setTimeout(() => {
    //   this.disableSubmitButton = false;
    // }, 2000);
    }else{
        this.disableSubmitButton = false;
        this.popupnoaccsite = this.ifarabicpop == true?'No access to siteaudit':'No access to siteaudit';
        this.buttoncont = this.ifarabicpop == true?'OK':'OK';
        if(this.projectpk == 1) {  
          this.route.navigate(['centrecertification/home/MQ==']);
            }else {
              this.route.navigate(['centrecertification/rashome/NA==']);      
            }
        swal({
          title:  this.popupnoaccsite ,
          text: " ",
          icon: 'warning',
          buttons: [false, this.buttoncont],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          
        }); 
        return false;  
     }
    
  }
  auditlog(data) {
    this.disableSubmitButton = true;
    if(this.projectpk == 1) {
      this.route.navigate(['centrecertification/auditlog/'+this.security.encrypt(data.applicationdtlstmp_pk)+'/'+this.security.encrypt(data.appdt_projectmst_fk)]);
    }else {
      this.route.navigate(['centrecertification/auditlogras/'+this.security.encrypt(data.applicationdtlstmp_pk)+'/'+this.security.encrypt(data.appdt_projectmst_fk)]);
    }
  }
  viewinvoice(appid ,access) {
    this.disableSubmitButton = true;

    if(access == true){
      if(this.projectpk == 1) {  
        this.route.navigate(['/paymentinvoiceindex/invoice'] ,{ queryParams: { id: this.security.encrypt(appid) }});

          }else {
            this.route.navigate(['/paymentinvoiceindex/rasinvoice'] ,{ queryParams: { id: this.security.encrypt(appid) }});
      
          }
      // setTimeout(() => {
      //   this.disableSubmitButton = false;
      // }, 2000);
    }else{
        this.disableSubmitButton = false;
        this.popupnoaccinvoice = this.ifarabicpop == true?'No access to view invoice':'No access to view invoice';
        this.buttoncont = this.ifarabicpop == true?'OK':'OK';
        if(this.projectpk == 1) {  
          this.route.navigate(['centrecertification/home/MQ==']);
            }else {
              this.route.navigate(['centrecertification/rashome/NA==']);      
            }
        swal({
          title: this.popupnoaccinvoice,
          text: " ",
          icon: 'warning',
          buttons: [false, this.buttoncont],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          
        }); 
        return false;  
     }
     
    }
  paymentdetials(appid ,access) {
    this.disableSubmitButton = true;
    if(1){
      if(this.projectpk == 1) {
        this.route.navigate(['/paymentinvoiceindex/invoice/details'] ,{ queryParams: { id: this.security.encrypt(appid) }});
      } else {
        this.route.navigate(['/paymentinvoiceindex/invoice/rasdetails'] ,{ queryParams: { id: this.security.encrypt(appid) }});
      }
    // setTimeout(() => {
    //   this.disableSubmitButton = false;
    // }, 2000);
    }else{
        this.disableSubmitButton = false;
        this.popupnoaccpaym = this.ifarabicpop == true?'No access to view payment':'No access to view payment';
        this.buttoncont = this.ifarabicpop == true?'OK':'OK';
        swal({
          title:  this.popupnoaccpaym,
          text: " ",
          icon: 'warning',
          buttons: [false,  this.buttoncont],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          if(this.projectpk == 1) {  
            this.route.navigate(['centrecertification/home/MQ==']);
              }else {
                this.route.navigate(['centrecertification/rashome/NA==']);      
              }
        }); 
        return false;  
     }
  }
  viewpayment(appid) {
    this.disableSubmitButton = true;
    if(this.projectpk == 1) {
      this.route.navigate(['/paymentinvoiceindex/invoice'] ,{ queryParams: { id:  this.security.encrypt(appid) }});
    } else {
      this.route.navigate(['/paymentinvoiceindex/rasinvoice'] ,{ queryParams: { id:  this.security.encrypt(appid) }});
    }
    // setTimeout(() => {
    //   this.disableSubmitButton = false;
    // }, 2000);
  }

  saveexportdet(projectpk){
  this.disableSubmitButton = true;
  const showCol = [];
  this.BranchListData.forEach((col) => {
    if (col.hideShow) {
      showCol.push(col.dispalycolum)
    }
  });

  this.exportlink =  environment.baseUrl + 'center/app-center/downloadlist'+`?appdt_appreferno=${this.appdt_appreferno.value}&appiit_officetype=${this.appiit_officetype.value}&omrm_companyname_en=${this.omrm_companyname_en.value}&omrm_branch_en=${this.omrm_branch_en.value}&appdt_apptype=${this.appdt_apptype.value}&appdt_status=${this.appdt_status.value}&appdt_grademst_fk=${this.appdt_grademst_fk.value}&cert_status=${this.cert_status.value}&omrm_tpname_en=${this.omrm_tpname_en.value}&appdt_certificateexpiry_start=${(this.appdt_certificateexpiry.value && this.appdt_certificateexpiry.value.startDate != undefined )?this.appdt_certificateexpiry.value.startDate.toJSON():' '}&appdt_certificateexpiry_end=${(this.appdt_certificateexpiry.value && this.appdt_certificateexpiry.value.endDate != undefined)?this.appdt_certificateexpiry.value.endDate.toJSON():' '}&appdt_submittedon_start=${(this.appdt_submittedon.value && this.appdt_submittedon.value.startDate != undefined )?this.appdt_submittedon.value.startDate.toJSON():' '}&appdt_submittedon_end=${(this.appdt_submittedon.value && this.appdt_submittedon.value.endDate != undefined)?this.appdt_submittedon.value.endDate.toJSON():' '}&appdt_updatedon_start=${(this.appdt_updatedon.value && this.appdt_updatedon.value.startDate != undefined )?this.appdt_updatedon.value.startDate.toJSON():' '}&appdt_updatedon_end=${(this.appdt_updatedon.value && this.appdt_updatedon.value.endDate != undefined)?this.appdt_updatedon.value.endDate.toJSON():' '}&asd_date_end=${(this.asd_date.value && this.asd_date.value.endDate != undefined)?this.asd_date.value.endDate.toJSON():' '}&asd_date_start=${(this.asd_date.value && this.asd_date.value.startDate != undefined)?this.asd_date.value.startDate.toJSON():' '}&showCol=${showCol}&projectpk=${projectpk}`;
  window.open(this.exportlink,'_self');
  setTimeout(() => {
  this.disableSubmitButton = false;
  }, 1000);
  }


  clearFilter() {
    this.appdt_appreferno.reset();
    this.appiit_officetype.reset();
    this.omrm_companyname_en.reset();
    this.omrm_tpname_en.reset();
    this.omrm_centrename.reset()
    this.omrm_branch_en.reset();
    this.appiit_branchname_en.reset();
    this.appdt_apptype.reset();
    this.appdt_status.reset();
    this.cert_status.reset();
    this.appdt_grademst_fk.reset();
    this.appdt_certificateexpiry.reset();
    this.appdt_submittedon.reset();
    this.appdt_updatedon.reset();
    this.appdt_siteaudit.reset();
    this.asd_date.reset();
    // this.getAppTempDtls();
    console.log(this.appdt_certificateexpiry)
    // console.log(this.LastAudited)
    $(".clear").trigger("click");
  }
  goToviewsiteaudit(data ,viewid ,access) {
    this.disableSubmitButton = true;
    this.projectid = 1;
    if(access == true){
      if(this.projectpk == 1){
        this.route.navigate(['/centrecertification/siteaudit'],{ queryParams: { id: this.security.encrypt(data.applicationdtlstmp_pk),view: this.security.encrypt(viewid) }});
      }else{
        if(viewid == 6) {
          this.route.navigate(['/standardcourseapproval/rassiteauditview'] ,{ queryParams: { id: this.security.encrypt(data.applicationdtlstmp_pk),view: this.security.encrypt(viewid) }});
        }else {
          this.route.navigate(['/standardcourseapproval/rassiteaudit'] ,{ queryParams: { id: this.security.encrypt(data.applicationdtlstmp_pk),view: this.security.encrypt(viewid) }});
        }
        //this.route.navigate(['/standardcourseapproval/desktopreview'], { queryParams: {id: this.security.encrypt(data.applicationdtlstmp_pk), app_ref_id: data.appdt_appreferno,view: 'viewcourse',type:2 } } );
      }
      
      // setTimeout(() => {
      // this.disableSubmitButton = false;
      // }, 2000);
    }else{

        this.disableSubmitButton = false;
        this.popupnoacc = this.ifarabicpop == true?'No access':'No access';
        this.buttoncont = this.ifarabicpop == true?'OK':'OK';
        if(this.projectpk == 1) {  
          this.route.navigate(['centrecertification/home/MQ==']);
            }else {
              this.route.navigate(['centrecertification/rashome/NA==']);      
            }
        swal({
          title: this.popupnoacc,
          text: " ",
          icon: 'warning',
          buttons: [false, this.buttoncont],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
         
        }); 
        return false;  
     }
    
  }

  viewcertificate(appdt_certificatepath , memregid){
    this.disableSubmitButton = true;
    window.open(environment.baseUrl + appdt_certificatepath, "_blank");
    setTimeout(() => {
      this.disableSubmitButton = false;
      },2000);
  }


  // ontype() {
  //   if(this.appiit_officetype == 1) {
      
  //   }
  // }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      // console.log(123)
    } catch (error) {
      console.log('page-content')
    }
  }
downLoadPdf(value){
    this.disableSubmitButton = true;
    window.open(environment.baseUrl + value, "_blank");
    setTimeout(() => {
      this.disableSubmitButton = false;
      },2000);
  }

  getaccessproject( ) {
    this.appservice.getaccessproject(this.projectpk).subscribe((res:any) => {
      this.accessproject = res.data;
        if(this.isfocalpoint == 1){
        this.accessproject = true;
        }


        if(this.readaccess == false || this.accessproject  == false){
          swal({
            title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
            text: '',
            icon: 'warning',
            buttons: [false,this.i18n('Ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            if (willGoBack) {
              this.route.navigate(['/dashboard/portaladmin'])        
            }
          });
        }
    });
  }


}

 


export class AppTempPagination {
  constructor(private http?: HttpClient) {
  }

  appGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string, projectpk?:number): Observable<any> {
    const href = environment.baseUrl + 'center/app-center/getdesktop';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&projectpk=${projectpk}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
