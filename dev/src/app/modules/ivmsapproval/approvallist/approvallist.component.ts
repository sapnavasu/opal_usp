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

@Component({
  selector: 'app-approvallist',
  templateUrl: './approvallist.component.html',
  styleUrls: ['./approvallist.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class ApprovallistComponent implements OnInit {

  i18n(key) {
    return this.translate.instant(key);
  }

  public projectid: number;
  public accessauditor: true;
  public accessadmin : true;
  public accessqualitymanager:true;
  public appcontent: string;
  public content: string;
  public memReg: any;
  public regpk: any;
  public userPk: any;
  public stktype: any;
  public role: any;
  public isfocalpoint: any;
  public useraccess: any;
  public approvalaccess: boolean = false;
  public downloadaccess: boolean = false;
  public readaccess: boolean = false;
  public createaccess: boolean = false;
  public updateaccess: boolean  = false;
  public projectpk: any;
  public accessauditor_i: any;
  public accessqualitymanager_i: any;
  public accessauditor_up: any;
  public accessauditor_r: any;
  public accessqualitymanager_up: any;
  public accessqualitymanager_u: any;
  public accessqualitymanager_r: any;
  public accesssuperadmin: any;
  public resultsLength: number;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  public page: number = 10;
  public appdt_appreferno:  FormControl;
  public appiit_officetype:  FormControl;
  public omrm_companyname_en:  FormControl;
  public omrm_centrename:  FormControl;
  public omrm_branch_en:  FormControl;
  public appdt_apptype:  FormControl;
  public ivmsmodel:  FormControl;
  public FormControl:  FormControl;
  public appl_status:  FormControl;
  public cert_status:  FormControl;
  public grade:  FormControl;
  public expirydate:  FormControl;
  public appdt_status: FormControl;
  public appdt_certificateexpiry:FormControl;
  public appdt_submittedon:FormControl;
  public appdt_updatedon:FormControl;
  public appdt_grademst_fk:FormControl;
  public certificatestatus: number;
  public appdt_siteaudit: FormControl;
  public appiit_branchname_en :FormControl;
  public registrtaion_date:FormControl;
  public noData: any = '';
  public popupcontent: any;
  public buttoncont: any;
  public disableSubmitButton: boolean = false;
  public tblplaceholder: boolean = false;
  public popupnoaccinvoice: any;
  public popupnoacc: any;
  public popupnoaccpaym: any;
  @ViewChild("paginator") paginator: MatPaginator;
  public appListData: MatTableDataSource<any>;
  GridDatas: AppTempPagination;
  @ViewChild(MatSort) sort: MatSort;
  private querystr: string;
  public exportlink:string;
  public popupnoaccsite: any;
   // work
   @ViewChild('chkWork') chkWork: MatCheckbox;
   public selectAllWork: boolean = false;
  
  BranchListData = [
    { dispalycolum: "appdt_appreferno", workSrch: "row-first", label: "branch.applform", hideShow: true, disoperate: true },
    { dispalycolum: "omrm_branch_en", workSrch: "row-second", label: "addroles.centrenam", hideShow: true, disoperate: false },
    { dispalycolum: "appiit_officetype", workSrch: "row-three", label: "branch.offitype", hideShow: true, disoperate: false },
    { dispalycolum: "appiit_branchname_en", workSrch: "row-four", label: "branch.branchname", hideShow: true, disoperate: false },
    { dispalycolum: "sitelocan", workSrch: "row-six", label: "branch.sitelocan", hideShow: true, disoperate: false },
    { dispalycolum: "ivms_model", workSrch: "row-five", label: "Ivms Device Model No.", hideShow: false, disoperate: true },
    { dispalycolum: "appdt_apptype", workSrch: "row-seven", label: "branch.applytype", hideShow: true, disoperate: false },
    { dispalycolum: "appdt_status", workSrch: "row-eight", label: "branch.applstat", hideShow: true, disoperate: false },
    { dispalycolum: "appdt_certificategenon", workSrch: "row-nine", label: "branch.certstat", hideShow: false, disoperate: false },
    { dispalycolum: "reg_date", workSrch: "row-ten", label: "Registration Date", hideShow: false, disoperate: false },
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
    }, 50);

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
    }, 50);
  }
  
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
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabicpop = false; 
      }
    });

    this.appdt_appreferno = new FormControl('');
    this.appiit_officetype = new FormControl('');
    this.omrm_companyname_en = new FormControl('');
    this.omrm_centrename = new FormControl('');
    this.omrm_branch_en = new FormControl('');
    this.appdt_apptype = new FormControl('');
    this.ivmsmodel = new FormControl('');
    this.appdt_status = new FormControl('');
    this.appdt_grademst_fk= new FormControl('');
    this.cert_status = new FormControl('');
    this.appdt_certificateexpiry = new FormControl('');
    this.appdt_submittedon = new FormControl('');
    this.appdt_updatedon = new FormControl('');
    this.appdt_siteaudit = new FormControl('');
    this.registrtaion_date = new FormControl('');
    this.appiit_branchname_en = new FormControl('');
   
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

    this.ivmsmodel.valueChanges.debounceTime(400).subscribe( 
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
    this.registrtaion_date.valueChanges.debounceTime(400).subscribe( 
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
   

  }

  ngAfterViewInit(){
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
          this.appdt_status.setValue(['10','11','12','14','15','16']);
        }
         
       }
     });
      this.projectpk = 'NQ==';
     if(this.localstorage.getInLocal('omrm_stkholdertypmst_fk') == '1'){
      this.getAppTempDtls();
    }else{
      this.popupcontent = this.ifarabicpop == true?'No access':'No access';
      this.buttoncont = this.ifarabicpop == true?'OK':'OK';
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
        this.route.navigate(['/admin/login']);
        setTimeout(() => {
          this.disableSubmitButton = false;
        }, 2000);
      }); 
      return false;
    }
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

  getAppTempDtls() {
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
    omrm_tpname_en:this.ivmsmodel.value, appdt_certificateexpiry:this.appdt_certificateexpiry.value, appdt_submittedon:this.appdt_submittedon.value, appdt_updatedon:this.appdt_updatedon.value,asd_date:this.registrtaion_date.value,};
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
          this.accessauditor_up = data['data'].data.accessauditor_up;
          this.accessauditor_r = data['data'].data.accessauditor_r;
          this.accessqualitymanager_i = data['data'].data.accessqualitymanager_i;
          this.accessqualitymanager_up = data['data'].data.accessqualitymanager_up;
          this.accessqualitymanager_u = data['data'].data.accessqualitymanager_u;
          this.accessqualitymanager_r = data['data'].data.accessqualitymanager_r;
          this.accessadmin =  data['data'].data.accessadmin;
          this.accesssuperadmin =  data['data'].data.accesssuperadmin;
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
 
  saveexportdet(projectpk){
  this.disableSubmitButton = true;
  const showCol = [];
  this.BranchListData.forEach((col) => {
    if (col.hideShow) {
      showCol.push(col.dispalycolum)
    }
  });

  // this.exportlink =  environment.baseUrl + 'center/app-center/downloadlist'+`?appdt_appreferno=${this.appdt_appreferno.value}&appiit_officetype=${this.appiit_officetype.value}&omrm_companyname_en=${this.omrm_companyname_en.value}&omrm_branch_en=${this.omrm_branch_en.value}&appdt_apptype=${this.appdt_apptype.value}&appdt_status=${this.appdt_status.value}&appdt_grademst_fk=${this.appdt_grademst_fk.value}&cert_status=${this.cert_status.value}&omrm_tpname_en=${this.ivmsmodel.value}&appdt_certificateexpiry_start=${(this.appdt_certificateexpiry.value.startDate != undefined )?this.appdt_certificateexpiry.value.startDate.toJSON():' '}&appdt_certificateexpiry_end=${(this.appdt_certificateexpiry.value.endDate != undefined)?this.appdt_certificateexpiry.value.endDate.toJSON():' '}&appdt_submittedon_start=${(this.appdt_submittedon.value.startDate != undefined )?this.appdt_submittedon.value.startDate.toJSON():' '}&appdt_submittedon_end=${(this.appdt_submittedon.value.endDate != undefined)?this.appdt_submittedon.value.endDate.toJSON():' '}&appdt_updatedon_start=${(this.appdt_updatedon.value.startDate != undefined )?this.appdt_updatedon.value.startDate.toJSON():' '}&appdt_updatedon_end=${(this.appdt_updatedon.value.endDate != undefined)?this.appdt_updatedon.value.endDate.toJSON():' '}&asd_date_end=${(this.asd_date.value.endDate != undefined)?this.asd_date.value.endDate.toJSON():' '}&asd_date_start=${(this.asd_date.value.startDate != undefined)?this.registrtaion_date.value.startDate.toJSON():' '}&showCol=${showCol}&projectpk=${projectpk}`;
  window.open(this.exportlink,'_blank');
  setTimeout(() => {
  this.disableSubmitButton = false;
  }, 1000);
  }


  clearFilter() {
    this.appdt_appreferno.reset();
    this.appiit_officetype.reset();
    this.omrm_companyname_en.reset();
    this.ivmsmodel.reset();
    this.omrm_centrename.reset()
    this.omrm_branch_en.reset();
    this.appiit_branchname_en.reset();
    this.appdt_apptype.reset();
    this.appdt_status.reset();
    this.cert_status.reset();
    this.appdt_grademst_fk.reset();
    this.appdt_certificateexpiry.reset();
    $(".clear").trigger("click");
  }
 
  viewcertificate(appdt_certificatepath , memregid){
    this.disableSubmitButton = true;
    window.open(environment.baseUrl + appdt_certificatepath, "_blank");
    setTimeout(() => {
      this.disableSubmitButton = false;
      },2000);
  }

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
      window.open(environment.baseUrl + value, "_blank");
    }
  }

 


export class AppTempPagination {
  constructor(private http?: HttpClient) {
  }

  appGridUtil(sort: string, order: string, page: number, size: number,gridsearchValues?:string, projectpk?:number): Observable<any> {
    const href = environment.baseUrl + 'ivmsbackend/ivms-backend/getdesktop';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}&projectpk=${projectpk}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
