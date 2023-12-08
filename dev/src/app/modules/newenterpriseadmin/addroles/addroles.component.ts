import { Component, ElementRef, EventEmitter, Input, OnInit, Output, SimpleChanges, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE, MatOption } from '@angular/material/core';
import { animate, state, style, transition, trigger } from '@angular/animations';
import { MatTableDataSource, MatTable } from '@angular/material/table';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { EnterpriseadminService } from '../enterpriseadmin.service';
import { ActivatedRoute, Router } from '@angular/router';
import { UserallocationComponent } from '@app/@shared/sidepanel/userallocation/userallocation.component';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';
import { HttpClient } from '@angular/common/http';
import { ToastrService } from 'ngx-toastr';
import { Observable } from 'rxjs/Observable';
import { environment } from '@env/environment';
import {of as observableOf} from 'rxjs/observable/of';
import {merge} from 'rxjs/observable/merge';
import { MatSort } from '@angular/material/sort';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import {map} from 'rxjs/operators/map'
import {catchError} from 'rxjs/operators/catchError';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { ApplicationService } from '@app/services/application.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import moment from 'moment';
import { MatSelect } from '@angular/material/select';
import { ReplaySubject } from 'rxjs';
// export interface ModuleElement {
//   id: number;
//   name: string;
//   create: string;
//   update: string;
//   delete: string;
//   approve: string;
//   download: string;
//   submodule?: SubmoduleElement[] | MatTableDataSource<SubmoduleElement>;
// }

// export interface SubmoduleElement {
//   sid: number;
//   sname: string;
//   screate: string;
//   supdate: string;
//   sdelete: string;
//   sapprove: string;
//   sdownload: string;
// }

// export interface Roledata {
//   // roleList: any;
//   stakeholdertype: any;
//   projectname_en:any;
//   rolename_en:any;
//   higherRole:any;
//   status:any;
//   addedOn:any;
//   updatedOn:any;
//   id:any;
// }

// export interface Roledata {
//   stktype: any;
//   civilnumber:any;
//   stafname:any;
//   emailid:any;
//   mobilenumber:any;
//   role:any;
//   thirdpartyagent:any;
//   status:any;
//   added_on:any;
//   lastupdated:any;

 
// }

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
  selector: 'app-addroles',
  templateUrl: './addroles.component.html',
  styleUrls: ['./addroles.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
],
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({ height: '0px', minHeight: '0' })),
      state('expanded', style({ height: '*' })),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ],
})
export class AddrolesComponent implements OnInit {
  centre_array_tech = [];
  showevaltechuser: boolean;
  centre_array_tech_ivms: any;
  centre_array_tech_ras: any;
  certificationmanditory: boolean = false;
  coursemanditory: boolean = false;
  certification_array_tech = [];
  alloc_project: any;
  isfocalpoint: any;
  useraccess: any;
  stktype: any;
  userdeleteaccess: boolean = false;
  userreadaccess: boolean = false;
  usercreateaccess: boolean = false;
  userupdateaccess: boolean = false;
  rolecreateaccess: boolean = false;
  rolereadaccess: boolean = false;
  roleupdateaccess: boolean = false;
  roledeleteaccess: boolean = false;
  disableSubmitButton: boolean;
  certification_array_insert = [];
  batchread: boolean =  false;
  project_str: any;

  i18n(key) {
    return this.translate.instant(key);
  }
  addroleform: FormGroup;
  adduserroleform: FormGroup;
  public userroleallocation:boolean = false;
  @ViewChild('addUpdateAccess') addUpdateAccess: UserallocationComponent;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('selectbox') selectbox: MatSelect;
  public Usersrecord: MatTableDataSource<any>;
  public addrolecreationpage: boolean = false;
  centreform: FormGroup;
  @Output() addrolecreation: any = new EventEmitter<any>();
  @Output() rolegridlistdata: any = new EventEmitter<any>();
  @Output() change: any = new EventEmitter<any>();
  public showrole: boolean = false;
  public addUserFromType:number = 1; 
  public allSelected : boolean = false;
  datachecked: number = 2
  public refname: any;
  roledatapatch = [];
  userdatapatch = [];
  centrepatch = [];
  public  userdataL :any= [];
  public  userCenter :any= [];
  public  staffuser :any= [];
  public  stkpk  :number=1;
  public tblplaceholder=false;
  public moduleicon:boolean=true;
  public moduleaccess: boolean = false;
  public showhighrole: boolean = false;
  public rolefiltersts: boolean = true;
  public userfiltersts: boolean = true;
  public centrefiltersts: boolean = true;
  public showhighupdate: boolean = false;
  public showevaltech: boolean = false;
  public opaladmindatashow: boolean = false;
  public opaladmincentreshow: boolean = false;
  public opaladminshowapproval: boolean = false;
  public showstandardcourse:boolean = false;
  public focalPoint: boolean = false;
  public nonEditPart: boolean = false;
  public  userdata :any= [];
  public  resultsLength :Number;
  public managenaming:string='';
  public assignModule:string='';
  public closeText:string='';
  add_btn:boolean=true;
  rolesrecordcolumn = ['omrm_stkholdertypmst_fk','omrm_companyname_en','oum_idnumber','oum_firstname','oum_emailid','oum_mobno','oum_isfocalpoint', 'rm_rolename_en','oum_isthirdpartyagent','oum_status','oum_createdon','oum_updatedon','action'];
  centerrecordcolumn = ['oum_idnumber','oum_firstname','oum_emailid','oum_mobno','role','oum_status','oum_createdon','oum_updatedon','action'];
  public centredatashow: boolean = false;
  public centredatashowtech: boolean = false;
  public thirdaprtyshowopal: boolean = false;
  userrecordcolumn = ['rm_opalstkholdertypmst_fk', 'pm_projectname_en','rm_rolename_en','higherRole','rm_status','rm_createdon','rm_updatedon','action'];
  UsersGridDatas: ManageRoleGlistPagination;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page:number=10;
  pageEvent: any;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public requiredtag: boolean = false;
  role_stktype = [];
  role_project = [];
  user_stktype = [];
  user_role = [];
  public higherrolefilter: any = [];
  public rolereDirection: any = '';
  centre_array = [];
  //role grid
  stktypesearch = new FormControl('');
  projectsearch = new FormControl('');
  rolesearch = new FormControl('');
  highrolesearch = new FormControl('');
  statussearch = new FormControl('');
  addedonsearch = new FormControl('');
  updatedonsearch = new FormControl('');
  //user grid and center
// centerName= new FormControl('');
stafName= new FormControl('');
emailid= new FormControl('');
focal_point= new FormControl('');
stakeholdertype= new FormControl('');
companynm= new FormControl('');
civilNo= new FormControl('');
mobilno= new FormControl('');
roleName_en= new FormControl('');
status= new FormControl('');
addedOn= new FormControl('');
lastUpdateOn= new FormControl('');
isthirdPartyAgent= new FormControl('');
  public showrolegrid:boolean = false;
  public viewRoleUserdis:boolean = false;
  public viewUserdis:boolean = false;
  public viewCenterUserdis:boolean = false;
  public viewBackBackbutton:boolean = false;
  public hidegrid:boolean = true;
  public usergrid:boolean = false;
  public hideusergrid:boolean = true;
  public hidecentergrid:boolean = true;
  public apptype='new';
  // filterValues = {
  //   stktypesearch: '',
  //   projectsearch: '',
  //   rolesearch: '',
  //   highrolesearch: '',
  //   statussearch: '',
  //   addedonsearch: '',
  //   updatedonsearch: '',
  // };
  @Input() popupContentPrefix: string;
  staffslist = [];
  staffslistcentre = [];
  ifarabic: boolean = false;
  highrollist: any;
  rollist: any;
  projist:any;
  courseist:any;
  // role_mstlist = [];
  cert_typelist    = [];
  standard_list   = [];
  highrolelist = [];
  today = new Date()
  columnsToDisplay = ['name', 'create', 'update', 'delete', 'approve', 'download'];
  innerDisplayedColumns = ['sname', 'screate', 'supdate', 'sdelete', 'sapprove', 'sdownload'];
  // expandedElement: ModuleElement | null;
  public swalData: any;
  public stkholdertype: any;
  @ViewChild('search') searchTextBox: ElementRef;
  public moduleData: any;

  selectFormControl = new FormControl();
  public moduleFilter: FormControl = new FormControl();
  public highFilter: FormControl = new FormControl();
  selectedValues = [];
  public filteredmoduleData: ReplaySubject<any> = new ReplaySubject<any>(1);
  public filterhighrole: ReplaySubject<any> = new ReplaySubject<any>(1);

  constructor(private formBuilder: FormBuilder,
    private translate: TranslateService,
    private router: Router,
    public routeid: ActivatedRoute,
    private enterprise: EnterpriseadminService,
    private encrypt: Encrypt,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private http: HttpClient,
    private localstorage: AppLocalStorageServices,
    public toastr: ToastrService,
    private appservice : ApplicationService,
    ) { 
      this.stkholdertype = this.localstorage.getInLocal('omrm_stkholdertypmst_fk');
    }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  arrolesControl = new FormControl();
  filteredOptions: Observable<any[]>;
  role_mstlist: any[] = []; 

  ngOnInit(): void {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.routeid.queryParams.subscribe(params => {
      this.refname = this.encrypt.decrypt(params['type']);     
      if (((this.refname == 3) && this.stktype == 1)) {
        this.router.navigate(['dashboard/portaladmin']);
      }
      else if (((this.refname == 1 || this.refname == 2) && this.stktype == 2)) {
        this.router.navigate(['dashboard/centre']);
      }
      
       this.rolereDirection = params['id'];
       if(this.rolereDirection =='rd'){
        var idName = this.encrypt.decrypt(params['role']);
        this.roleName_en.setValue(idName);
        this.status.setValue("A");
      }
    });
    
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
      } else {
        this.filtername = "إخفاء التصفية";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.filtername = "Hide Filter";
        } else {
          this.filtername = "إخفاء التصفية";
        }
        if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'en') {
          this.ifarabic = false;
        }
        else {
          this.ifarabic = true;
        }
        
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'en') {
          this.ifarabic = false;
        }
        else {
          this.ifarabic = true;
        }
      }
    }); 
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    

    if (this.isfocalpoint == 2) {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      
      this.SetUseraccess();
      
     }
    else {
      this.userdeleteaccess = true;
      this.userreadaccess = true;
      this.usercreateaccess = true;
      this.userupdateaccess = true;
      this.rolecreateaccess = true;
      this.rolereadaccess = true;
      this.roleupdateaccess = true;
      this.roledeleteaccess = true;
     }

    
    if((this.refname == 1 || this.refname == 2 || this.refname == 3) && (this.rolereadaccess || this.userreadaccess)){
      this.initializeForm();
      if(this.refname==1 && this.rolereadaccess){
        this.adduserroleform.controls['emailid'].valueChanges.debounceTime(400).subscribe(data => {
          if ( (this.adduserroleform.controls['emailid'].errors?.pattern==null || this.adduserroleform.controls['emailid'].errors?.pattern==undefined)) {
            this.chkValidemailId(data);
          }
        });
        this.stktypesearch.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.projectsearch.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.rolesearch.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.highrolesearch.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.statussearch.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.addedonsearch.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.updatedonsearch.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.addroleform.controls['arrolehigh'].valueChanges.subscribe(value => {
          if (value) {
            let index = this.highrolelist.findIndex(x => x.rolemst_pk == value[0]);
            if (index !== -1) {
              this.highrollist = this.highrolelist[index].rm_rolename_en;

            }
          } else {
            this.highrollist = '';
          }
        });

      }else if((this.refname==2||this.refname==3) && this.userreadaccess ){
        if(this.refname==3 ){
          this.stkpk = 2;
          this.cntreform.emailidcentre.disable();
          this.cntreform.civilnocentre.disable();
          this.cntreform.rolescentre.disable();
          // this.cntreform.rolescentreid.disable();
          this.cntreform.staffcentrerepopk.disable();
          // this.cntreform.staffsnamecentrename.disable();
          // this.cntreform.mobilenumbercentre.disable();
        }
        this.stafName.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.emailid.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.stakeholdertype.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.companynm.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }
            else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.civilNo.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }
            else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.mobilno.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.focal_point.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.roleName_en.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.status.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.addedOn.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.lastUpdateOn.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.isthirdPartyAgent.valueChanges.debounceTime(400).subscribe( 
          register => { 
            if (register != null ) {
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }else if(register == ''){
              this.paginator.pageIndex = 0;
              this.getManageRolesDtls();   
            }    
          }
        )
        this.adduserroleform.controls['arroles'].valueChanges.subscribe(value => {
          if (value) {
            let index = this.role_mstlist.findIndex(x => x.rolemst_pk == value[0]);
            if (index !== -1) {
              this.rollist = this.role_mstlist[index].rm_rolename_en;
      
            }
          } else {
            this.rollist = '';
          }
        });
  this.adduserroleform.controls['arproject'].valueChanges.subscribe(value => {
          if (value) {
            let index = this.cert_typelist.findIndex(x => x.projectmst_pk == value[0]);
            if (index !== -1) {
              this.projist = this.cert_typelist[index].pm_certificationname_en;
      
      }
          } else {
            this.projist = '';
          }
        });
        this.adduserroleform.controls['arcourse'].valueChanges.subscribe(value => {
          if (value) {
            let index = this.standard_list.findIndex(x => x.standardcoursemst_pk == value[0]);
            if (index !== -1) {
              this.courseist = this.standard_list[index].scm_coursename_en;
      
            }
          } else {
            this.courseist = '';
          }
        });
      }
      else if ((this.refname==2||this.refname==3) && !this.userreadaccess ){
        this.noaccess();
      }
      else if ((this.refname==1) && !this.rolereadaccess ){
        this.noaccess();
      }
      this.roledatas();
      this.gethigerroledata();
      this.userdatas();
      this.highroledata();
      if(this.refname == 2 ){
        this.managenaming ='Users';
        this.centredata();
      }
      else if(this.refname == 3){
        this.managenaming ='Center users';
         this.staffdatalist();
      }else{
        this.managenaming ='Roles';
      }
      this.rolesmstata();
      this.standardmstdata();
    } else if ((this.refname == 1 || this.refname == 2 || this.refname == 3) && (!this.rolereadaccess && !this.userreadaccess)) {
      this.noaccess();
    }
    else {
      this.router.navigate(['admin/login']);
    }
    this.moduleFilter.valueChanges
      .subscribe(() => {
        this.moduleFilters();
      });

    this.highFilter.valueChanges
      .subscribe(() => {
        this.highRolesFilters();
      });
  }
  moduleFilters() {
    if (!this.role_mstlist) {
      return;
    }
    // get the search keyword
    let search = this.moduleFilter.value;
    if (!search) {
      this.filteredmoduleData.next(this.role_mstlist.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filteredmoduleData.next(
      this.role_mstlist.filter(role => role.rm_rolename_en.toLowerCase().indexOf(search) > -1)
    );
  }
  highRolesFilters() {
    if (!this.highrolelist) {
      return;
    }
    // get the search keyword
    let search = this.highFilter.value;
    if (!search) {
      this.filterhighrole.next(this.highrolelist.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filterhighrole.next(
      this.highrolelist.filter(highrole => highrole.rm_rolename_en.toLowerCase().indexOf(search) > -1)
    );
  }

  noaccess() {
    swal({
      title:"You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
      icon:'warning',
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willGoBack) => {
      if (willGoBack) {
        if (this.stktype == 1) {
      this.router.navigate(['dashboard/portaladmin']);
    }
    else{
      this.router.navigate(['dashboard/centre']);
    }
  }

    });

  }
  gethigerroledata(){
    this.enterprise.gethigherrolesdtls().subscribe(data => {
      this.higherrolefilter = data.data.data;
  });
  }
  ngAfterViewInit():void {
    this.getManageRolesDtls();
   }

  SetUseraccess() {
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Manage Users');
    let submodid = this.stktype == 1 ? 3 : 20;
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][submodid] && this.useraccess[moduleid][submodid].delete == 'Y'){
      this.userdeleteaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][submodid] && this.useraccess[moduleid][submodid].read == 'Y'){
      this.userreadaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][submodid] && this.useraccess[moduleid][submodid].create == 'Y'){
      this.usercreateaccess = true;
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][submodid] && this.useraccess[moduleid][submodid].update == 'Y'){
      this.userupdateaccess = true;
    }

    let moduleidadmin = this.localstorage.getaccessmoduleid(this.stktype, 'Manage Roles');
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][2]  && this.useraccess[moduleidadmin][2].create == 'Y'){
      this.rolecreateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][2] && this.useraccess[moduleidadmin][2].read == 'Y'){
      this.rolereadaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][2] && this.useraccess[moduleidadmin][2].update == 'Y'){
      this.roleupdateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][2] && this.useraccess[moduleidadmin][2].delete == 'Y'){
      this.roledeleteaccess = true;
    }
  }


  initializeForm() {
    this.addroleform = this.formBuilder.group({
      stkholdertype: [null, Validators.required],
      techeval: [null,''],
      arrole: [null,Validators.required],
      rolearbic: [null, Validators.required],
      arrolehigh: [null, Validators.required],
      useraccess:[null, null],
      addusertypecontrol:[null, null],
      userPk: [null, null],
      rolerelpk:[null,null],
      arrolehighupdate:[null, null]
    });
    this.adduserroleform = this.formBuilder.group({
      stkholdertypeuser: [null, Validators.required],
      techevaluser: [null,''],
      civilno: [null, Validators.required],
      stafName: [null, Validators.required],
      emailid: [null, Validators.required],
      mobilenumber: [null, Validators.required],
      arroles: [null, Validators.required],
      centrename: [null, ''],
      slider: [null, Validators.required],
      rolecentre: [null],
      stafnamecentre: [null, ''],
      staffrepopk: [null],
      opalusermstpk:[null,null],
      username:[null,null],
      password:[null,null],
      arproject:[null,null],
      arcourse:[null,null],
      arprojectpk:[null,null],
    });
    this.centreform = this.formBuilder.group({
      staffsnamecentre: [null, Validators.required],
      civilnocentre: ['', ''],
      emailidcentre: ['', ''],
      mobilenumbercentre: ['', ''],
      rolescentre: ['', ''],
      rolescentreid: ['', ''],
      staffsnamecentrename: ['', ''],
      staffcentrerepopk:[null],
      opalusermstpk:[null,null],
      username:[null,null],
      password:[null,null],
    });
   

  }
  get adduserform() {
    return this.adduserroleform.controls;
  }
  get addrolform() {
    return this.addroleform.controls;
  }
  get cntreform() {
    return this.centreform.controls;
  }

  chkValidemailId(dataValue) {
    let postData = {
      'emailid': dataValue,
      'usrid':this.adduserroleform.controls['userPk'].value,
      'stktype':this.stkholdertype
    }
    this.enterprise.checkEmailExistOrNot('ea/enterpriseadmin/check-email-exist', postData).subscribe(response => {
      if (response?.success) {
        if (response?.data?.data) {
          this.adduserroleform.controls.emailid.setErrors({ alreadyExist: true });  
        } else {
          this.adduserroleform.controls.emailid.setErrors(null);
        }
      }
    })
  }
  adduserdatasave() {
    if (this.adduserroleform.valid) {
      this.adduserroleform.enable();
      this.disableSubmitButton = true;
      this.project_str = this.adduserroleform.controls['arproject'].value;
      if (this.batchread && this.project_str.indexOf("2") === -1) {
        this.disableSubmitButton = false;
        swal({
          title: this.i18n("You are allocating Batch Management access to this User. It is mandatory to select the 'Certification Type' as 'Standard Course Certification'."),
          text: '',
          icon: 'warning',
          buttons: [false,this.i18n('Ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then((willGoBack) => {
          if (willGoBack) {
          }
        });
        this.moduleAllocation(this.adduserroleform.value.arroles,1);
         return false;
      }
      this.enterprise.saveuserdata(this.adduserroleform.value, this.apptype).subscribe(res => {
        if (res.data == 'failed') {
         this.disableSubmitButton = false;
            swal({
              title: this.i18n("The user cannot be added to the following Certification Type with Approval access, as the role is not mapped in the Approval workflow."),
              text: '',
              icon: 'warning',
              buttons: [false,this.i18n('Ok')],
              dangerMode: true,
              className: this.dir =='ltr'?'swalEng':'swalAr',
              closeOnClickOutside: false
            }).then((willGoBack) => {
              if (willGoBack) {
              }
            });
            this.moduleAllocation(this.adduserroleform.value.arroles,1);
         return false;
        }
        else {
          if(res.data == 'new') {
            this.toastr.success(this.i18n('addroles.theuserhasbeen'), ''), {
              timeOut: 2000,
              closeButton: false,
            };

          } else {
            this.toastr.success(this.i18n('addroles.theuserhasupda'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          this.disableSubmitButton = false;
           this.usergrid=false;
      this.hideusergrid=true;
      this.adduserroleform.reset();
         setTimeout(() => {
           this.getManageRolesDtls();
         }, 500);
        }
      });
     
    }
  
  }
  public postUrl:any;
  update(userPk, status){
    let statMsg = '';
    let statMsgU = '';
    let statSuccessMsg = '';
    if(status == 2){
      statMsg = 'Do you want to Activate this Role?';
      statMsgU = 'Do you want to Activate this User?';
      // statSuccessMsg = 'The Role has been Activated.';
    }else if(status == "I"){
      statMsg = 'Do you want to Activate this Role?';
      statMsgU = 'Do you want to Activate this User?';
      // statSuccessMsg = 'The Role has been Activated.';
    }else{
      statMsg = 'Do you want to Deactivate this Role?';
      statMsgU = 'Do you want to Deactivate this User?';
      // statSuccessMsg = 'The Role has been Deactivated.';
    }
    let usrPk = this.encrypt.encrypt(userPk);
    this.postParams = {
      "userPk":usrPk,
      "status":status
    };
    swal({
      title:(this.refname==1)?statMsg:statMsgU,
      icon:'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if(willDelete){
        if(this.refname==1){
          this.postUrl = 'ea/enterpriseadmin/update-stakholder-users';
        }else{
          this.postUrl = 'ea/enterpriseadmin/update-manageorcenter-users';
        }
        this.enterprise.enterpriseService(this.postParams,this.postUrl).subscribe(
          function(data){
            this.getManageRolesDtls();
            if(data['data'].status == 200){
              swal({
                title:statSuccessMsg,
                icon:'success',
                closeOnClickOutside: false,
                closeOnEsc: false
              });
            }else{
              swal({
                title: data['data'].msg,
                icon:'success',
                closeOnClickOutside: false,
                closeOnEsc: false
              });
            }
          }.bind(this)
        );
      }
    });   
}

  addcentredatasave() {
    if (this.centreform.valid) {
      this.centreform.enable();
      this.enterprise.savecentredata(this.centreform.value,this.apptype).subscribe(res => {
        if(res.status == 200){
          // this.getusercentergriddata();
          this.getManageRolesDtls();
       }
      });
      this.centregrid=false;
      this.hidecentregrid=true;
      this.adduserroleform.reset();
    }
  }
  get isFormValid() {
    let isValid = true;
    if ((this.adduserroleform.valid || !this.previousFormValue) || (this.previousFormValue && this.isFormsValueChanged)) {
      isValid = this.adduserroleform.invalid;
    }
    return isValid;
  }

  get isFormsValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.adduserroleform.value);
  }

  get isFormroleValid() {
    let isValid = true;
    if ((this.add_btn && this.addroleform.valid && this.userPermission.length > 0) || (!this.add_btn && this.previousFormValue && this.isFormsroleValueChanged && this.userPermission.length > 0)) {
        isValid = false;
    }
    return isValid;
  }

  get isFormsroleValueChanged() {
    return this.previousFormValue !== JSON.stringify(this.addroleform.value);
  }

 
  public userPermission: any = [];
  public postParams: any;

  addrolesave(){
    console.log(this.userPermission,'this.userPermission');
    this.scrollTo('addrolesnew');
    this.addUpdateAccess.savemodulepermissionallocation();    
    this.disableSubmitButton = true;
    this.addroleform.controls['useraccess'].setValue(this.userPermission);
    if (this.addroleform.valid) {
      this.enterprise.saverolesdata(this.addroleform.value, this.apptype).subscribe(res => {
        if (res.data == 'failed') {
          this.userPermission = [];
          this.disableSubmitButton = false;
        //  this.add_btn = false;
             swal({
               title: this.i18n("You cannot give the Approval Access for a new role. Please remove and proceed."),
               text: '',
               icon: 'warning',
               buttons: [false,this.i18n('Ok')],
               dangerMode: true,
               className: this.dir =='ltr'?'swalEng':'swalAr',
               closeOnClickOutside: false
             }).then((willGoBack) => {
               if (willGoBack) {
               }
             });
           
          return false;
         }
         
        else{
          this.disableSubmitButton = false;
          if(res.data == 'new') {
            this.toastr.success(this.i18n('addroles.therolhascred'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }else{
            this.toastr.success(this.i18n('addroles.therolhasupdat'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }

          this.showrolegrid = false;
          this.hidegrid = true;
          this.addroleform.reset();
          this.gethigerroledata();
          this.getuserroledata();
          this.getManageRolesDtls();
          this.userPermission = [];

         
        }
      });
    
    }
    
  }

  roledatas() {
    this.enterprise.getrolestktypedata().subscribe(data => {
      this.role_stktype = data.data.stktypedata;
      this.role_project = data.data.projectdata;
    });
  }
  public relopk;
  rolesmstata() {
    this.enterprise.getroledtls(1).subscribe(data => {
      this.role_mstlist = data.data;
      this.relopk = data.data.rolemst_pk;
      this.filteredmoduleData.next(this.role_mstlist.slice());
    });
  }

  projectmstdata(){
    this.enterprise.getprojectdtls(this.certification_array_tech).subscribe(data => {
      console.log(data.data.projectList , 'projectlist');
      this.cert_typelist = data.data.projectList;
      if(!this.cert_typelist){
        this.opaladminshowapproval  = false;
      }
      if(this.cert_typelist){
        this.opaladminshowapproval  = true;
      }
     this.relopk = data.data.rolemst_pk;
    });
    
  }

  standardmstdata(){
    this.enterprise.getcoursetls().subscribe(data => {
      console.log(data.data.courseList , 'courselist');
      this.standard_list = data.data.courseList;
    });
    
  }
  userdatas() {
    this.enterprise.getstktypeuserddtls().subscribe(data => {
      this.user_stktype = data.data.stktypeuserdata;
      this.centre_array = data.data.userdatafetchlist;
      this.centre_array_tech_ras = data.data.userdatafetchlisttechras;
      this.centre_array_tech_ivms = data.data.userdatafetchlisttechivms;
      // this.staffslist = data.data.stafffetchdata;
    });
  }
  
  selectCentrelist(value)
  {
    this.centre_array_tech = null;
    if(value == 4)
    {
      this.centre_array_tech = this.centre_array_tech_ras;
    }
    if(value == 5)
    {
      this.centre_array_tech = this.centre_array_tech_ivms;
    }

    if(this.centre_array_tech == null)
    {
      swal({
        title: this.i18n('No Centres Available'),
        icon: 'warning',
        dangerMode: true,
        closeOnClickOutside: false
      })
    }

  }
  
  centredata() {
    this.enterprise.getcentrelistdtls().subscribe(data => {
      this.staffslist = data.data.stafffcentretchdata;
    });
  }
  staffdatalist(){
    this.enterprise.getstafflistdata().subscribe(data => {
      this.staffslistcentre = data.data;
    });
  }
  staffdatalist1(rolepk){
    this.enterprise.getstafflistdata1(rolepk).subscribe(data => {
      this.staffslistcentre = data.data;
    });
  }
  selectciviliddata(value){
    
    this.adduserroleform.controls['stafName'].enable();
    this.adduserroleform.controls['civilno'].enable();
    this.adduserroleform.controls['mobilenumber'].enable();
    this.adduserroleform.controls['emailid'].enable();
    this.adduserroleform.controls['rolecentre'].enable();
    this.adduserroleform.controls['slider'].enable();
    this.adduserroleform.controls['stafnamecentre'].enable();
    this.enterprise.stafffetchdata(value).subscribe(data => {
      this.staffslist = data.data;
      if(this.staffslist.length == 0){
        swal({
          title: this.i18n('addroles.nostafavail'),
          icon: 'warning',
          dangerMode: true,
          closeOnClickOutside: false
        })
      }
      this.adduserroleform.controls['civilno'].reset();
      this.adduserroleform.controls['emailid'].reset();
      this.adduserroleform.controls['mobilenumber'].reset();
      this.adduserroleform.controls['rolecentre'].reset();
    });  
  }
  selectciviliddata1(value){
    this.enterprise.stafffetchdata1(value).subscribe(data => {
      this.staffslist = data.data;
    });  
  }
  // highselectciviliddata(value){
  //   this.enterprise.highrolefetchdata(value).subscribe(data => {
  //     this.highrolelist = data.data;
      
  //   });  
  // }
   highroledata() {
  this.enterprise.gethighrolefetchlist(this.relopk).subscribe(data => {
      this.highrolelist = data.data.highroledata;
      this.filterhighrole.next(this.highrolelist.slice());

    });
  }
  // }
  public updated:boolean = false;
  selectcivilid(value) {
    this.enterprise.checkstaffuser(value).subscribe(res => {
        this.staffuser = res.data['data'];
        if(!this.staffuser){
          this.staffslist.forEach(z => {
            if (z.staffinforepo_pk == value) {
              this.moduleAllocation(z.appsim_roleforcourse,2);
              this.adduserform.emailid.setValue(z.sir_emailid);
              this.adduserform.civilno.setValue(z.sir_idnumber);
              this.adduserform.rolecentre.setValue(z.rm_rolename_en);
              this.adduserform.arroles.setValue((z.appsim_roleforcourse !== null) ? z.appsim_roleforcourse.split(',') : null);
              this.adduserform.mobilenumber.setValue(z.sir_mobnum);
              this.adduserform.staffrepopk.setValue(z.staffinforepo_pk);
              this.adduserform.stafName.setValue(z.sir_name_en);
              this.updated=true;
            }
          });
        }else{
          swal({
            title: this.i18n('addroles.theuserisalredcred'),
            icon:'warning',
            closeOnClickOutside: false,
            closeOnEsc: false
          });
          this.adduserform.stafnamecentre.reset();
          this.adduserform.emailid.reset();
          this.adduserform.civilno.reset();
          this.adduserform.rolecentre.reset();
          this.adduserform.arroles.reset();
          this.adduserform.mobilenumber.reset();
          this.adduserform.stafName.reset();
          // this.adduserroleform.controls.stafnamecentre.setErrors(null);
        }
    });
    
  }

  selectcivilidcentre(value) {
  
    this.userroleallocation =true;
    this.enterprise.checkstaffuser(value).subscribe(res => {
      this.staffuser = res.data['data'];
      if(!this.staffuser){
        
        this.staffslistcentre.forEach(a => {
          if (a.staffinforepo_pk == value) {
            this.moduleAllocation(a.appsim_roleforcourse,2);
            this.cntreform.emailidcentre.setValue(a.sir_emailid);
            this.cntreform.civilnocentre.setValue(a.sir_idnumber);
            this.cntreform.rolescentre.setValue(a.rm_rolename_en);
            this.cntreform.rolescentreid.setValue((a.appsim_roleforcourse !== null) ? a.appsim_roleforcourse.split(',') : null);
            this.cntreform.staffcentrerepopk.setValue(a.staffinforepo_pk);
            this.cntreform.staffsnamecentrename.setValue(a.sir_name_en);
            this.cntreform.mobilenumbercentre.setValue(a.sir_mobnum);
    
            this.updated=true;
          }
        });
      }else{
        swal({
          title: this.i18n('addroles.thisuseralredmap'),
          icon:'warning',
          closeOnClickOutside: false,
          closeOnEsc: false
        });
        this.cntreform.staffsnamecentre.reset();
        this.cntreform.emailidcentre.reset();
        this.cntreform.civilnocentre.reset();
        this.cntreform.rolescentre.reset();
        this.cntreform.rolescentreid.reset();
        this.cntreform.staffcentrerepopk.reset();
        this.cntreform.staffsnamecentrename.reset();
        this.cntreform.mobilenumbercentre.reset();
          // this.adduserroleform.controls.stafnamecentre.setErrors(null);
      }
    });


  
    
   
  }
  gotoback() {
    this.rolegridlistdata.emit(true);
    this.addrolecreation.emit(false);
  }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
    } catch (error) {
    }
  }
  
  public  roledata :any= [];
  getuserroledata(){
    this.enterprise.getrolegriddtls().subscribe(data=>{
      if(data.status == 200){
        this.roledata.data = data['data'].roleList;
        this.resultsLength = this.roledata.data.length;
      }
    });
  }
  selectedStktype(value) {
    this.addroleform.controls['arrole'].reset();
    this.addroleform.controls['rolearbic'].reset();
    this.addUpdateAccess.getuseraccess(value);
    if (value == 1) {
      this.showrole = true;
      this.stkpk = 1;
      this.showhighrole = true;
      this.showevaltech = false;
      this.addroleform.controls['techeval'].reset();
      this.addroleform.controls['techeval'].setValidators(null);
      this.addroleform.controls['techeval'].updateValueAndValidity();
      this.addroleform.controls['arrolehigh'].setValidators([Validators.required]);
      this.addroleform.controls['arrolehigh'].updateValueAndValidity();
    } else if (value == 2) {
      this.stkpk = 2;
      this.showrole = true;
      this.showhighrole = false;
      this.showevaltech = false;
      this.addroleform.controls['arrolehigh'].reset();
      this.addroleform.controls['arrolehigh'].setValidators(null);
      this.addroleform.controls['arrolehigh'].updateValueAndValidity();
      this.addroleform.controls['techeval'].reset();
      this.addroleform.controls['techeval'].setValidators(null);
      this.addroleform.controls['techeval'].updateValueAndValidity();
    }
    else {
      this.stkpk = 2;
      this.showrole = true;
      this.showhighrole = false;
      this.showevaltech = true;
      this.addroleform.controls['arrolehigh'].reset();
      this.addroleform.controls['arrolehigh'].setValidators(null);
      this.addroleform.controls['arrolehigh'].updateValueAndValidity();
      this.addroleform.controls['techeval'].setValidators([Validators.required]);
      this.addroleform.controls['techeval'].updateValueAndValidity();
    }
  }
  selectedStktypeuser(value) {
    console.log(this.adduserroleform.controls['arroles'].value);
    this.addUpdateAccess.getuseraccess(value);
    if (value == 1) {
      this.stkpk =1;
      this.opaladmindatashow = true;
      this.thirdaprtyshowopal = true;
      this.showevaltechuser = false;
      this.opaladmincentreshow = true;
      this.centredatashow = false;
      this.centredatashowtech = false;
      this.requiredtag = true;
      this.userroleallocation = true;
      this.updated=false;
      this.adduserroleform.controls['stafName'].enable();
      this.adduserroleform.controls['civilno'].enable();
      this.adduserroleform.controls['mobilenumber'].enable();
      this.adduserroleform.controls['emailid'].enable();
      this.adduserroleform.controls['rolecentre'].enable();
      this.adduserroleform.controls['slider'].enable();
      this.adduserroleform.controls['stafnamecentre'].enable();
      this.adduserroleform.controls['stafName'].reset();
      this.adduserroleform.controls['civilno'].reset();
      this.adduserroleform.controls['mobilenumber'].reset();
      this.adduserroleform.controls['emailid'].reset();
      this.adduserroleform.controls['stafnamecentre'].setValidators(null);
      this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity();
      this.adduserroleform.controls['stafnamecentre'].reset();
      this.adduserroleform.controls['centrename'].setValidators(null);
      this.adduserroleform.controls['centrename'].updateValueAndValidity();
      this.adduserroleform.controls['centrename'].reset();
      this.adduserroleform.controls['rolecentre'].reset();
      this.adduserroleform.controls['rolecentre'].setValidators(null);
      this.adduserroleform.controls['rolecentre'].updateValueAndValidity();
      this.addroleform.controls['techevaluser'].reset();
      this.addroleform.controls['techevaluser'].setValidators(null);
      this.addroleform.controls['techevaluser'].updateValueAndValidity();
      
    }
    else {
      this.stkpk =2;
      this.opaladmindatashow = true;
      this.opaladmincentreshow = false;
      if(value == 3)
      {
        this.centredatashowtech = true;
        this.showevaltechuser = true;
        this.centredatashow = false;
        this.addroleform.controls['techevaluser'].reset();
      this.addroleform.controls['techevaluser'].setValidators([Validators.required]);
      this.addroleform.controls['techevaluser'].updateValueAndValidity();
      }
      else{
        this.centredatashow = true;
        this.centredatashowtech = false;
        this.showevaltechuser = false;
        this.addroleform.controls['techevaluser'].reset();
      this.addroleform.controls['techevaluser'].setValidators(null);
      this.addroleform.controls['techevaluser'].updateValueAndValidity();
      }
     
      
      this.thirdaprtyshowopal = false;
     
      this.userroleallocation = true;
      this.requiredtag = false;
      this.adduserroleform.controls['stafnamecentre'].disable();
      this.adduserroleform.controls['civilno'].disable();
      this.adduserroleform.controls['mobilenumber'].disable();
      this.adduserroleform.controls['emailid'].disable();
      this.adduserroleform.controls['rolecentre'].disable();
      this.adduserroleform.controls['slider'].disable();
      this.adduserroleform.controls['centrename'].setValidators([Validators.required]);
      this.adduserroleform.controls['centrename'].updateValueAndValidity(); 
      this.adduserroleform.controls['stafName'].setValidators(null);
      this.adduserroleform.controls['stafName'].updateValueAndValidity();
      this.adduserroleform.controls['stafName'].reset();
      this.adduserroleform.controls['emailid'].setValidators(null);
      this.adduserroleform.controls['emailid'].updateValueAndValidity();
      this.adduserroleform.controls['emailid'].reset();
      this.adduserroleform.controls['mobilenumber'].setValidators(null);
      this.adduserroleform.controls['mobilenumber'].updateValueAndValidity();
      this.adduserroleform.controls['mobilenumber'].reset();
      this.adduserroleform.controls['civilno'].setValidators(null);
      this.adduserroleform.controls['civilno'].updateValueAndValidity();
      this.adduserroleform.controls['civilno'].reset();
      this.adduserroleform.controls['slider'].setValidators(null);
      this.adduserroleform.controls['slider'].updateValueAndValidity();
      this.adduserroleform.controls['slider'].reset();
      this.adduserroleform.controls['arroles'].setValidators(null);
      this.adduserroleform.controls['arroles'].updateValueAndValidity();
      this.adduserroleform.controls['arroles'].reset();
      this.adduserroleform.controls['stafnamecentre'].setValidators([Validators.required]);
      this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity(); 
      this.opaladminshowapproval = false;
    }

  }
  public currentUserPk: any = '';
  previousmoduleValue: any;
  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.addroleform.value);
  }
  get ismoduleValueChanged() {
    if (this.addUserFromType == 1) {
      if (this.userPermission.length > 0) {
        return JSON.stringify(this.previousmoduleValue) !== JSON.stringify(this.userPermission);
      } else {
        return false;
      }
    } else {
      return true;
    }
  }
  //edit data For Role
  // Do you want to cancel updating this Role?
  editData(value,rolepk) {
    this.closeText='updating'
    // this.moduleicon=true;
    this.moduleaccess=true;
    this.nonEditPart=true
    this.hidegrid=false;
    this.showrolegrid=true;
    this.apptype = 'edit';
    this.userroleallocation = true;
    if(this.addUpdateAccess) {
      this.addUpdateAccess.dataSourceforpermission = [];
    }
    let role_pk = this.encrypt.encrypt(rolepk);
    this.postParams = {
      "rolepk": role_pk,
      "stkpk": value.stakeholdertype
    }
    this.currentUserPk = rolepk;
    this.postUrl = 'ea/enterpriseadmin/stk-update-user-details';
    this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 0) {
          this.showWSuccess(data['data'].msg);

        } else {
          this.addUpdateAccess?.userAccessModification(data['data']?.data);
          this.previousmoduleValue = data['data'].data.baseModulesAccess
          this.userPermission = data['data'].data.checkedAccess;
          
        }
      }.bind(this)
    );
    
    this.add_btn = false;
    if(value.stakeholdertype == 1){
      this.showrole = true;
      this.showevaltech = false;
      this.showhighrole = true;
    } else if(value.stakeholdertype == 2 && value.rm_projectmst_fk == null){
      this.showrole = true;
      this.showevaltech = false;
      this.showhighrole = false;
    } else if(value.stakeholdertype == 2 && value.rm_projectmst_fk != null){
      this.showrole = true;
      this.showevaltech = false;
      this.showhighrole = false;
    }
    else{
      this.showhighrole = false;
      this.showrole = true;
      this.showevaltech = true;
    }
    if(value.stakeholdertype == 1){
      this.addroleform.patchValue({
        stkholdertype :1, 
        arrole:value.rolename_en,
        rolearbic:value.rolename_ar,
        arrolehigh:value.higherRolearr,
        rolerelpk: value.rolemst_pk,
      });
    }else{
      if (value.projecttype == 4 || value.projecttype == 5) {
        this.addroleform.controls['arrolehigh'].setValidators(null);
        this.addroleform.controls['arrolehigh'].updateValueAndValidity();
        this.addroleform.patchValue({
          stkholdertype :3, 
          techeval :(value.projectname_en != null) ? value.projectname_en == 'Roadworthiness Assurance Standards (RAS)' ? '4':'5' : null,
          arrole:value.rolename_en,
          rolearbic:value.rolename_ar,
          rolerelpk: value.rolemst_pk,
        });
        this.showevaltech = true;
      }
      else{
        this.addroleform.controls['arrolehigh'].setValidators(null);
        this.addroleform.controls['arrolehigh'].updateValueAndValidity();
        this.addroleform.patchValue({
          stkholdertype :2, 
          // techeval :value.projectname_en == 'Roadworthiness Assurance Standards (RAS)' ? '4':'5',
          arrole:value.rolename_en,
          rolearbic:value.rolename_ar,
          rolerelpk: value.rolemst_pk,
        });
        this.showevaltech = false;
      }
      
    }
    this.previousFormValue = JSON.stringify(this.addroleform.value);
  }
  moduleAllocation(rolepk, stk_type){
    
    this.userroleallocation = true;
    if(this.addUpdateAccess) {
      this.addUpdateAccess.dataSourceforpermission = [];
    }
    let role_pk = this.encrypt.encrypt(rolepk);
    this.postParams = {
      "rolepk": role_pk,
      "stkpk": stk_type
    }
    this.currentUserPk = rolepk;
    this.postUrl = 'ea/enterpriseadmin/stk-update-user-details';
    this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 0) {
          this.showWSuccess(data['data'].msg);

        } else {
          this.addUpdateAccess?.userAccessModification(data['data']?.data);
          this.previousmoduleValue = data['data'].data.baseModulesAccess;
          this.userPermission = data['data'].data.checkedAccess;
          this.setcertificationoption(this.previousmoduleValue);
         
          // ---
        }
      }.bind(this)
    );
  }
  
  setcertificationoption(userPermission){
    this.batchread= false;
   this.certificationmanditory = false;
   this.adduserroleform.controls['arproject'].clearValidators();
   this.certification_array_tech = [];
   this.certification_array_insert = [];
   console.log(userPermission , 'userpermission');
    if(this.userPermission != undefined && userPermission.length != 0){
    userPermission.forEach(data => {
        if(data.module_id == '6_10' && (data.read == "Y" || data.approval== "Y" )){
        if(data.approval== "Y"){
          this.certification_array_insert.push(1);
          }
        this.certificationmanditory = true; 
        this.certification_array_tech.push(1);
        this.adduserroleform.controls['arproject'].setValidators([Validators.required]);
        }
      if(data.module_id == '6_11' && (data.read == "Y"  || data.approval == "Y" )){
        if(data.approval== "Y"){
          this.certification_array_insert.push(2);
          this.certification_array_insert.push(3);
          }
      this.certification_array_tech.push(2);
      this.certification_array_tech.push(3);
      this.certificationmanditory = true; 
      this.adduserroleform.controls['arproject'].setValidators([Validators.required]);
      }
      if(data.module_id == '6_12' && (data.read == "Y"  || data.approval == "Y" )){
        if(data.approval== "Y"){
          this.certification_array_insert.push(4);

          }
        this.certification_array_tech.push(4);
        this.certificationmanditory = true; 
        this.adduserroleform.controls['arproject'].setValidators([Validators.required]);
       }
      if((data.module_id == '4_4' && data.read == "Y")){
        this.certification_array_tech.push(2);
       // this.certification_array_tech.push(3);
        // this.certification_array_insert.push(2);
        // this.certification_array_insert.push(3);
        this.certificationmanditory = true; 
        this.batchread = true;
        this.adduserroleform.controls['arproject'].setValidators([Validators.required]);
      }

    });
   }
    this.adduserroleform.controls['arprojectpk'].setValue( this.certification_array_insert);
    this.projectmstdata();
   this.adduserroleform.controls['arproject'].updateValueAndValidity();
  }

  

  userPermissionsActivityLogs: any[] = [];
  previousFormValue: any;
  moduleClear() {
    if (this.addUpdateAccess) {
      this.addUpdateAccess?.fullMOduleCheck();
      this.addUpdateAccess.finalpermissiontempinitialarray = [];
      this.addUpdateAccess.finalpermissiontemparray = [];
      this.addUpdateAccess.finalpermissionarray = [];
      this.userPermission = [];
      this.userPermissionsActivityLogs = [];
    }
  }

 
  userPermData(event) {
    this.userPermission = event;
    this.userPermissionsActivityLogs = [];
    this.userPermissionsActivityLogs.push(this.userPermission);
    this.addroleform.controls['useraccess'].setValue(this.userPermission);
  }
 public ngOnChanges(changes: SimpleChanges) {
    this.userPermissionsActivityLogs = [];
  }
  toggledata:boolean=false;

  //edit data for user
  edituserData(value) {
    this.moduleicon = true;
    this.nonEditPart = true;
    this.closeText = 'updating';
    this.assignModule = 'Assigned Module Access'
    this.adduserroleform.controls['civilno'].disable();
    this.adduserroleform.controls['stafName'].disable();
    this.hideusergrid=false;
    this.usergrid=true;
    this.apptype = 'edit';
    this.add_btn = false;
    // this.selectciviliddata1(value.oum_opalmemberregmst_fk);
    this.userroleallocation = true;
    // this.moduleAllocation( rolepk, stk_type);
     this.alloc_project =  value.oum_allocatedproject;
    
    
    if(this.alloc_project){
      this.certification_array_tech = this.alloc_project.split(','); 
     }
     this.projectmstdata();
  
    if(value.stakeholdertype == 1 || value.stakeholdertype == '' || value.stakeholdertype == null){
     if(value.oum_isfocalpoint==1){
      // console.log('focal popnt');
      this.opaladmindatashow = true;
      this.thirdaprtyshowopal = true;
      this.opaladmincentreshow = true;
      this.centredatashow = false;
      this.requiredtag = true;
      this.toggledata = value.thirdPartyAgent == '1' ? true : false;
        this.adduserroleform.patchValue({
          stkholdertypeuser :1,
          civilno: value.civilNo,
          stafName: value.stafName,
          emailid: value.emailid,
          mobilenumber: value.mobilno,
          arroles:"Focal Point",
          // slider: value.thirdPartyAgent,
          opalusermstpk:value.opalusermst_pk,
          username:value.oum_loginId,
          password:((value.oum_password !== null)?this.encrypt.aesdecrypt(value.oum_password):'Yet to set'),
        });
     }else{
      // console.log('focal point2');
      this.opaladmindatashow = true;
      this.thirdaprtyshowopal = true;
      this.opaladmincentreshow = true;
      this.centredatashow = false;
      this.requiredtag = true;
      this.toggledata = value.thirdPartyAgent == '1' ? true : false;
      this.adduserroleform.controls['stafnamecentre'].setValidators(null);
      this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity();
      this.adduserroleform.controls['centrename'].setValidators(null);
      this.adduserroleform.controls['centrename'].updateValueAndValidity();
        this.adduserroleform.patchValue({
          stkholdertypeuser :1,
          civilno: value.civilNo,
          stafName: value.stafName,
          emailid: value.emailid,
          mobilenumber: value.mobilno,
          arroles:(value.oum_rolemst_fk !== null) ? value.oum_rolemst_fk.split(',') : null,
          // slider: value.thirdPartyAgent,
          opalusermstpk:value.opalusermst_pk,
          username:value.oum_loginId,
          password:((value.oum_password !== null)?this.encrypt.aesdecrypt(value.oum_password):'Yet to set'),
          arproject:(value.oum_allocatedproject !== null) ? value.oum_allocatedproject.split(',') : null,
          arcourse:(value.oum_standcoursemst_fk !== null) ? value.oum_standcoursemst_fk.split(',') : null,
        });
       // this.opaladminshowapproval = true;
     }
     
      this.moduleAllocation(value.oum_rolemst_fk,1);
      if(value.oum_allocatedproject){
        this.opaladminshowapproval = true;
      if(value.oum_allocatedproject.split(',').includes('2')){
        this.coursemanditory = true;
        this.showstandardcourse = true;
        this.adduserroleform.controls['arcourse'].setValidators([Validators.required]);
        
      }else{
        this.showstandardcourse = false;
        this.coursemanditory = false;
        this.adduserform.arcourse.setValue("");
        this.adduserroleform.controls['arcourse'].clearValidators();
      }
      this.adduserroleform.controls['arcourse'].updateValueAndValidity();
    }
    }
    else{
      if(value.oum_isfocalpoint==1){
        // console.log('focal point3');
     this.opaladmindatashow = true;
      this.centredatashow = true;
      this.thirdaprtyshowopal = false;
      this.opaladmincentreshow = false;
      this.requiredtag = false;
      this.adduserroleform.controls['centrename'].setValidators([Validators.required]);
      this.adduserroleform.controls['centrename'].updateValueAndValidity(); 
      this.adduserroleform.controls['stafName'].setValidators(null);
      this.adduserroleform.controls['stafName'].updateValueAndValidity();
      this.adduserroleform.controls['emailid'].setValidators(null);
      this.adduserroleform.controls['emailid'].updateValueAndValidity();
      this.adduserroleform.controls['mobilenumber'].setValidators(null);
      this.adduserroleform.controls['mobilenumber'].updateValueAndValidity();
      this.adduserroleform.controls['civilno'].setValidators(null);
      this.adduserroleform.controls['civilno'].updateValueAndValidity();
      this.adduserroleform.controls['slider'].setValidators(null);
      this.adduserroleform.controls['slider'].updateValueAndValidity();
      this.adduserroleform.controls['arroles'].setValidators(null);
      this.adduserroleform.controls['arroles'].updateValueAndValidity();
      this.adduserroleform.controls['stafnamecentre'].setValidators([Validators.required]);
      this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity(); 
      this.adduserroleform.patchValue({
        stkholdertypeuser :2,
        civilno: value.oum_idnumber,
        stafnamecentre:value.stafName,
        arroles:(value.oum_rolemst_fk !== null) ? value.oum_rolemst_fk.split(',') : null,
        centrename:value.omrm_companyname_en,
        emailid: value.emailid,
        mobilenumber: value.mobilno,
        rolecentre: "Focal Point",
        stafName: value.oum_firstname,//staff name
        opalusermstpk:value.opalusermst_pk,
        username:value.oum_loginId,
        password:((value.oum_password !== null)?this.encrypt.aesdecrypt(value.oum_password):'Yet to set'),
        arproject:(value.oum_allocatedproject !== null) ? value.oum_allocatedproject.split(',') : null,
        arcourse:(value.oum_standcoursemst_fk !== null) ? value.oum_standcoursemst_fk.split(',') : null,
      });
      }else{
        this.enterprise.stafffetchdata(value.opalmemberregmst_pk).subscribe(data => {
          this.staffslist = data.data;
        });  
        // console.log('focal point4');
      this.opaladmindatashow = true;
      this.centredatashow = true;
      this.thirdaprtyshowopal = false;
      this.opaladmincentreshow = false;
      this.requiredtag = false;
      this.adduserroleform.controls['centrename'].setValidators([Validators.required]);
      this.adduserroleform.controls['centrename'].updateValueAndValidity(); 
      this.adduserroleform.controls['stafName'].setValidators(null);
      this.adduserroleform.controls['stafName'].updateValueAndValidity();
      this.adduserroleform.controls['emailid'].setValidators(null);
      this.adduserroleform.controls['emailid'].updateValueAndValidity();
      this.adduserroleform.controls['mobilenumber'].setValidators(null);
      this.adduserroleform.controls['mobilenumber'].updateValueAndValidity();
      this.adduserroleform.controls['civilno'].setValidators(null);
      this.adduserroleform.controls['civilno'].updateValueAndValidity();
      this.adduserroleform.controls['slider'].setValidators(null);
      this.adduserroleform.controls['slider'].updateValueAndValidity();
      this.adduserroleform.controls['arroles'].setValidators(null);
      this.adduserroleform.controls['arroles'].updateValueAndValidity();
      this.adduserroleform.controls['stafnamecentre'].setValidators([Validators.required]);
      this.adduserroleform.controls['stafnamecentre'].updateValueAndValidity(); 
        this.centredatashow=true;
        this.adduserroleform.patchValue({
          stkholdertypeuser :2,
          civilno: value.sir_idnumber,
          stafnamecentre:value.staffinforepo_pk,
          arroles:(value.oum_rolemst_fk !== null) ? value.oum_rolemst_fk.split(',') : null,
          centrename:value.opalmemberregmst_pk,
          emailid: value.sir_emailid,
          mobilenumber: value.mobilno,
          rolecentre: value.roleName_en,
          stafName: value.stafName,
          opalusermstpk:value.opalusermst_pk,
          username:value.oum_loginId,
          password:((value.oum_password !== null)?this.encrypt.aesdecrypt(value.oum_password):'Yet to set'),
          arproject:(value.oum_allocatedproject !== null) ? value.oum_allocatedproject.split(',') : null,
          arcourse:(value.oum_standcoursemst_fk !== null) ? value.oum_standcoursemst_fk.split(',') : null,
        });
      }
       
      this.moduleAllocation(value.oum_rolemst_fk,2);
    }    
  }
  centreclearFilter(){
    this.stafName.setValue("");
    this.emailid.setValue("");
    this.civilNo.setValue("");
    this.mobilno.setValue("");
    this.lastUpdateOn.setValue("");
    this.status.setValue("");
    this.addedOn.setValue("");
    this.roleName_en.setValue("");
    this.getManageRolesDtls(); 
  }
  userclearFilter(){
    this.stakeholdertype.setValue("");
    this.stafName.setValue("");
    this.emailid.setValue("");
    this.civilNo.setValue("");
    this.companynm.setValue("");
    this.mobilno.setValue("");
    this.lastUpdateOn.setValue("");
    this.status.setValue("");
    this.isthirdPartyAgent.setValue("");
    this.focal_point.setValue("");
    this.addedOn.setValue("");
    this.roleName_en.setValue("");
    this.getManageRolesDtls(); 
  }
  roleclearFilter(){
    this.stktypesearch.setValue("");
    this.projectsearch.setValue("");
    this.rolesearch.setValue("");
    this.highrolesearch.setValue("");
    this.statussearch.setValue("");
    this.addedonsearch.setValue("");
    this.updatedonsearch.setValue("");
    this.getManageRolesDtls(); 
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getManageRolesDtls(); 
  }
  evenadddata(){
    this.nonEditPart=false;
    this.closeText='adding';
    this.assignModule ='Assign Module Access'
      this.showrolegrid=true;
      this.hidegrid=false;
      this.apptype = 'new';
      this.add_btn = true;
      // this.addrolform.stkholdertype.setValue('1');
      this.showrole = true;
      this.showhighrole = true;
      this.userroleallocation = true;
      this.stkpk = 1;
      this.showevaltech = false;
  }
  gotobackgrid(){ 
    if((this.addroleform.touched && !this.viewRoleUserdis)|| (this.previousFormValue !== JSON.stringify(this.addroleform.value)&& !this.viewRoleUserdis)){
      swal({
        title:this.i18n('addroles.doyouwantcan')+this.closeText+this.i18n('addroles.thisrol'),
        text:this.i18n('addroles.isyesany'),
        icon:'warning',
        buttons:[this.i18n('addroles.no'),this.i18n('addroles.yes')],
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willDelete) => {
        if (willDelete) {
          this.closeview();
          this.showrolegrid=false;
          this.hidegrid=true;
          this.addroleform.reset()
        }
      });
    }else if(this.viewRoleUserdis){
      this.closeview();
      this.showrolegrid=false;
      this.hidegrid=true;
      this.addroleform.reset()
    }
    else{
      this.closeview();
      this.showrolegrid=false;
      this.hidegrid=true;
      this.addroleform.reset()
    }
  }
  evenuseradddata(){
    this.closeText='adding';
    this.nonEditPart=false;
    this.assignModule ='Assign Module Access';
    this.usergrid=true;
    this.hideusergrid=false;
    this.apptype = 'new';
    this.add_btn = true;
    // this.adduserform.stkholdertypeuser.setValue('1');
    this.opaladmindatashow = true;
    this.thirdaprtyshowopal = true;
    this.opaladmincentreshow = true;
    this.centredatashow = false;
    this.requiredtag = true;
    this.userroleallocation = true;
    this.opaladminshowapproval  = false;
    this.showstandardcourse = false;
}
public centregrid:boolean = false;
public hidecentregrid:boolean = true;
evenusercentredata(){
  this.closeText='adding'
  this.centregrid=true;
  this.hidecentregrid=false;
  this.apptype = 'new';
  this.add_btn = true;
}
gotocentrebackgrid(){
  if(this.centreform.touched){
    swal({
      title:this.i18n('addroles.doyouwantcan')+this.closeText+this.i18n('addroles.thisuser'),
      text:this.i18n('addroles.isyesany'),
      icon:'warning',
      buttons:['No','Yes'],
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        this.closeview();
        this.centregrid=false;
        this.hidecentregrid=true;
        this.centreform.reset();
      }
    });
  }else{
    this.closeview();
    this.centregrid=false;
    this.hidecentregrid=true;
    this.centreform.reset();
  }
}
gotouserbackgrid(){
  // Do you want to cancel adding this User?
  if(this.adduserroleform.touched){
    swal({
      title:this.i18n('addroles.doyouwantcan')+this.closeText+this.i18n('addroles.thisuser'),
      text:this.i18n('addroles.isyesany'),
      icon:'warning',
      buttons:[this.i18n('addroles.no'),this.i18n('addroles.yes')],
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        this.closeview();
        this.usergrid=false;
        this.hideusergrid=true;
        this.adduserroleform.reset();
      }
    });
  }else{
       this.closeview();
        this.usergrid=false;
        this.hideusergrid=true;
        this.adduserroleform.reset();
  }
}
closeview(){
  this.viewBackBackbutton = false;
  if(this.refname ==1){
    this.viewRoleUserdis=false;
    this.addroleform.controls['arrole'].enable();
    this.addroleform.controls['rolearbic'].enable();
    this.addroleform.controls['rolearbic'].enable();
  }else if(this.refname ==2){
    this.focalPoint=false;
      this.viewUserdis=false;
      this.adduserroleform.controls['civilno'].enable();
      this.adduserroleform.controls['stafName'].enable();
      this.adduserroleform.controls['emailid'].enable();
      this.adduserroleform.controls['mobilenumber'].enable();
      this.adduserroleform.controls['rolecentre'].enable();
      this.adduserroleform.controls['slider'].enable();
      this.adduserroleform.controls['centrename'].enable();
      this.adduserroleform.controls['stafnamecentre'].enable();
  }else if(this.refname==3){
        this.viewCenterUserdis=false;
        this.centreform.controls['civilnocentre'].enable();
        this.centreform.controls['emailidcentre'].enable();
        this.centreform.controls['rolescentre'].enable();
        this.centreform.controls['mobilenumbercentre'].enable();
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
  // getusergriddata(){
  //   this.enterprise.getusersgriddtls().subscribe(data=>{
  //     if(data.status == 200){
  //       this.userdata.data = data['data'].userList;
  //       this.resultsLength = this.userdata.data.length;
  //     }
   
  //   });
  // }
  editcentreData(value) {
    this.closeText='updating';
    this.hidecentregrid=false;
    this.centregrid=true;
    this.apptype = 'edit';
    this.add_btn = false;
    this.userroleallocation = true;
    this.centreform.patchValue({
      civilnocentre: value.sir_idnumber,
      staffsnamecentre: value.staffinforepo_pk,
      emailidcentre: value.sir_emailid,
      mobilenumbercentre: value.sir_mobnum,
      // username: value.oum_loginId,
      password: ((value.oum_password !== null)?this.encrypt.aesdecrypt(value.oum_password):''),
      rolescentre: value.roleName_en,
      opalusermstpk:value.opalusermst_pk,
    });
    this.moduleAllocation(value.oum_rolemst_fk,2);
  }
  getusercentergriddata(){
    this.enterprise.getUserCenterlistDtls().subscribe(data=>{
      if(data.status == 200){
        this.userCenter.data = data['data'].centerList;
        this.resultsLength = this.userCenter.data.length;
      }
     
    });
  }
  noData: any = '';
  getManageRolesDtls() {
    this.UsersGridDatas = new ManageRoleGlistPagination(this.http);
    this.sort.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
    var gridsearchvalue = {};
    if(this.refname==1){
      this.tblplaceholder = true;
      gridsearchvalue = {
        stktypesearch:this.stktypesearch.value,
        projectsearch:this.projectsearch.value,
        rolesearch:this.rolesearch.value,
        highrolesearch:this.highrolesearch.value,
        statussearch:this.statussearch.value,
        addedonsearch: this.addedonsearch.value ? moment(this.addedonsearch.value).format('YYYY-MM-DD').toString() :this.addedonsearch.value ,
        updatedonsearch: this.updatedonsearch.value ?  moment(this.updatedonsearch.value).format('YYYY-MM-DD').toString() : this.updatedonsearch.value
      };
      merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.UsersGridDatas.rolesGridList(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue),this.refname);
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.Usersrecord = new MatTableDataSource<any>(data);
        this.rolefiltersts= true;
        this.Usersrecord.filterPredicate = this.createFilter();
        this.noData = this.Usersrecord.connect().pipe(map(data => data.length === 0));
        this.tblplaceholder = false;

       
       });

    }else if(this.refname==2){
      gridsearchvalue = {
        stafName: this.stafName.value,
        emailid:this.emailid.value,
        stakeholdertype:this.stakeholdertype.value,
        oum_idnumber:this.civilNo.value,
        omrm_companyname_en:this.companynm.value,
        mobilno:this.mobilno.value,
        roleName_en:this.roleName_en.value,
        status:this.status.value,
        isthirdPartyAgent:this.isthirdPartyAgent.value,
        isfocalpoint:this.focal_point.value,
        addedOn:  this.addedOn.value ? moment(this.addedOn.value).format('YYYY-MM-DD').toString() :this.addedOn.value ,
        lastUpdateOn: this.lastUpdateOn.value ? moment(this.lastUpdateOn.value).format('YYYY-MM-DD').toString() :this.lastUpdateOn.value
      };
      merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.UsersGridDatas.usersGridList(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue,this.refname));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {  
          return observableOf([]);
        })
      ).subscribe(data => {
        this.Usersrecord = new MatTableDataSource<any>(data);
        this.userfiltersts = true;
        this.Usersrecord.filterPredicate = this.createFilter();
        this.noData = this.Usersrecord.connect().pipe(map(data => data.length === 0));

      
       }); 

    }else if(this.refname==3){
      gridsearchvalue = {
        stafName:this.stafName.value,
        emailid:this.emailid.value,
        oum_idnumber:this.civilNo.value,
        mobilno:this.mobilno.value,
        roleName_en:this.roleName_en.value,
        status:this.status.value,
        addedOn: this.addedOn.value ? moment(this.addedOn.value).format('YYYY-MM-DD').toString() :this.addedOn.value ,
        lastUpdateOn:this.lastUpdateOn.value ? moment(this.lastUpdateOn.value).format('YYYY-MM-DD').toString() :this.lastUpdateOn.value
      };
      merge(this.sort.sortChange)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.UsersGridDatas.usersCenterGridList(
            this.sort.active, this.sort.direction, this.paginator.pageIndex - 1,
             this.page,
            JSON.stringify(gridsearchvalue,this.refname));
        }),
        map(data => {
          this.resultsLength = data['data'].data.totalcount;
          return data['data'].data.data;
        }),
        catchError(() => {
          return observableOf([]);
        })
      ).subscribe(data => {
        this.Usersrecord = new MatTableDataSource<any>(data);
        this.centrefiltersts = true;
        this.Usersrecord.filterPredicate = this.createFilter();
        this.noData = this.Usersrecord.connect().pipe(map(data => data.length === 0));
       });
    }
  }
  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function(data, filter): boolean {
      if(this.refname==1){
        let searchTerms = JSON.parse(filter);
        return data.stakeholdertype.toLowerCase().indexOf(searchTerms.stakeholdertype) !== -1 &&
        data.projectname_en.toLowerCase().indexOf(searchTerms.projectname_en) !== -1 &&
        data.rolename_en.toLowerCase().indexOf(searchTerms.rolename_en) !== -1 &&
        data.higherRole.toLowerCase().indexOf(searchTerms.higherRole) !== -1 && 
        data.status.toLowerCase().indexOf(searchTerms.status) !== -1 && 
        data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 && 
        data.updatedOn.toLowerCase().indexOf(searchTerms.updatedOn) !== -1 ;   
      }else if(this.refname==2){
        let searchTerms = JSON.parse(filter);
        return data.stafName.toLowerCase().indexOf(searchTerms.stafName) !== -1 &&
        data.emailid.toLowerCase().indexOf(searchTerms.emailid) !== -1 &&
        data.stakeholdertype.toLowerCase().indexOf(searchTerms.stakeholdertype) !== -1 &&
        data.civilNo.toLowerCase().indexOf(searchTerms.civilNo) !== -1 &&
        data.companynm.toLowerCase().indexOf(searchTerms.companynm) !== -1 &&
        data.mobilno.toLowerCase().indexOf(searchTerms.mobilno) !== -1 && 
       data.roleName_en.toLowerCase().indexOf(searchTerms.roleName_en) !== -1 && 
       data.status.toLowerCase().indexOf(searchTerms.status) !== -1 && 
       data.isthirdPartyAgent.toLowerCase().indexOf(searchTerms.isthirdPartyAgent) !== -1 && 
       data.isfocalpoint.toLowerCase().indexOf(searchTerms.isfocalpoint) !== -1 && 
       data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 && 
       data.lastUpdateOn.toLowerCase().indexOf(searchTerms.lastUpdateOn) !== -1 ;
   
      }else if(this.refname==3){
        let searchTerms = JSON.parse(filter);
        return data.stafName.toLowerCase().indexOf(searchTerms.stafName) !== -1 &&
        data.emailid.toLowerCase().indexOf(searchTerms.emailid) !== -1 &&
        data.oum_idnumber.toLowerCase().indexOf(searchTerms.oum_idnumber) !== -1 &&
        data.mobilno.toLowerCase().indexOf(searchTerms.mobilno) !== -1 && 
       data.roleName_en.toLowerCase().indexOf(searchTerms.roleName_en) !== -1 && 
       data.status.toLowerCase().indexOf(searchTerms.status) !== -1 && 
       data.addedOn.toLowerCase().indexOf(searchTerms.addedOn) !== -1 && 
       data.lastUpdateOn.toLowerCase().indexOf(searchTerms.lastUpdateOn) !== -1 ;
    
      }
    }
  return filterFunction;    
  }
  // view fuction is for all Role,user and center.
  viewRoleuser(value,rolepk){
    this.moduleicon=false;
    this.viewBackBackbutton=true;
    if(this.refname==1){
      this.editData(value,rolepk);
      this.viewRoleUserdis=true;
      if(this.viewRoleUserdis){
        this.addroleform.controls['arrole'].disable();
        this.addroleform.controls['rolearbic'].disable();
      }
    }else if(this.refname==2){
      //  this.userdatas();
        this.edituserData(value);
         if(value.oum_isfocalpoint==1){
          this.userroleallocation=false;
          this.focalPoint=true;
         }
         else{
          this.focalPoint=false;
          this.userroleallocation=true;
         }
      this.viewUserdis=true;
      if(this.viewUserdis){
        this.adduserroleform.controls['civilno'].disable();
        this.adduserroleform.controls['stafName'].disable();
        this.adduserroleform.controls['emailid'].disable();
        this.adduserroleform.controls['mobilenumber'].disable();
        this.adduserroleform.controls['rolecentre'].disable();
        this.adduserroleform.controls['slider'].disable();
        this.adduserroleform.controls['username'].disable();
        this.adduserroleform.controls['password'].disable();
        this.adduserroleform.controls['stafnamecentre'].disable();
        this.adduserroleform.controls['centrename'].disable();
    }else{
      this.adduserroleform.controls['civilno'].enable();
      this.adduserroleform.controls['stafName'].enable();
      this.adduserroleform.controls['emailid'].enable();
      this.adduserroleform.controls['mobilenumber'].enable();
      this.adduserroleform.controls['rolecentre'].enable();
      this.adduserroleform.controls['slider'].enable();
      this.adduserroleform.controls['username'].enable();
      this.adduserroleform.controls['password'].enable();
      this.adduserroleform.controls['stafnamecentre'].enable();
      this.adduserroleform.controls['centrename'].enable();
    }
  }else{
      this.editcentreData(value);
      this.viewCenterUserdis=true;
      if(this.viewCenterUserdis){
        this.centreform.controls['civilnocentre'].disable();
        this.centreform.controls['emailidcentre'].disable();
        this.centreform.controls['rolescentre'].disable();
        this.centreform.controls['mobilenumbercentre'].disable();
        // this.adduserroleform.controls['username'].disable();
        this.adduserroleform.controls['password'].disable();
      }
    }
  }
  ifchange() {
    this.change.emit();
  }
  checkByRole(value: any, contorlName: string) {
    switch (contorlName) {
      case 'arrole':
        this.enterprise.checkRoleName(value, this.addrolform.stkholdertype.value, 'arrole').subscribe(data => {
          if (data['data'].available) {
            this.addroleform.controls[contorlName].setErrors({ alreadyavailable: true });
            return false;
          }
        });
        break;
      case 'rolearbic':
        this.enterprise.checkRoleName(value, this.addrolform.stkholdertype.value,'rolearbic').subscribe(data => {
          if (data['data'].available) {
            this.addroleform.controls[contorlName].setErrors({ alreadyavailable: true });
            return false;
          }
        });
        break;
      }
}

checkBycivilIdOrEmail(value: any, contorlName: string) {
  switch (contorlName) {
    case 'civilno':
      this.enterprise.checkUserscivilOremailId(value, this.adduserform.stkholdertypeuser.value, 'civilno').subscribe(data => {
        if (data['data'].available) {
          this.adduserroleform.controls[contorlName].setErrors({ alreadyavailable: true });
          return false;
        }
      });
      break;
    case 'emailid':
      this.enterprise.checkUserscivilOremailId(value, this.adduserform.stkholdertypeuser.value,'emailid').subscribe(data => {
        if (data['data'].available) {
          this.adduserroleform.controls[contorlName].setErrors({ alreadyavailable: true });
          return false;
        }
      });
      break;
  }
}


fetchByRole(event,stkpk){
  this.adduserroleform.controls['arproject'].setValue("");
  this.adduserroleform.controls['arcourse'].setValue("");
  this.showstandardcourse = false;
  let value = event.value;
  if(value && this.refname==2){
    this.moduleAllocation(value,stkpk);
  }else{
    this.moduleAllocation(value,stkpk);
  }
}
  
showcourse(value){
if(value.includes('2')){
  this.coursemanditory = true;
  this.showstandardcourse = true;
  this.adduserroleform.controls['arcourse'].setValidators([Validators.required]);
}else{
  this.coursemanditory = false;
  this.showstandardcourse = false;
  this.adduserform.arcourse.setValue("");
  this.adduserroleform.controls['arcourse'].clearValidators();
}
this.adduserroleform.controls['arcourse'].updateValueAndValidity();
}
  optionClick() {
    let newStatus = true;
    this.selectbox.options.forEach((item: MatOption) => {
      if (!item.selected) {
        newStatus = false;
      }
    });
    this.allSelected = newStatus;
  }
  toggleAllSelection() {
    if (this.allSelected) {
      this.selectbox.options.forEach((item: MatOption) => item.select());
    } else {
      this.selectbox.options.forEach((item: MatOption) => item.deselect());
    }
  }
  private _filter(value: string): any[] {
    const filterValue = value.toLowerCase();
    this.setSelectedValues();
    this.adduserroleform.controls['arroles'].patchValue(this.selectedValues);
    return this.role_mstlist.filter(role => role.rm_rolename_en.toLowerCase().includes(filterValue));
  }
  setSelectedValues() {
    console.log('selectFormControl', this.adduserroleform.controls['arroles'].value);
    if (this.adduserroleform.controls['arroles'].value && this.adduserroleform.controls['arroles'].value.length > 0) {
      this.adduserroleform.controls['arroles'].value.forEach((e) => {
        if (this.selectedValues.indexOf(e) == -1) {
          this.selectedValues.push(e);
        }
      });
    }
  }
}
export class ManageRoleGlistPagination {
  constructor(private http?: HttpClient) {
  }

rolesGridList(sort: string, order: string, page: number, size: number,gridsearchValues?:string,refname?:any): Observable<any> {
  const href = environment.baseUrl + 'ea/enterpriseadmin/getrolesdtls';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
usersGridList(sort: string, order: string, page: number, size: number,gridsearchValues?:string,refname?:any): Observable<any> {
  const href = environment.baseUrl + 'ea/enterpriseadmin/getusersdtls';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
usersCenterGridList(sort: string, order: string, page: number, size: number,gridsearchValues?:string,refname?:any): Observable<any> {
  const href = environment.baseUrl + 'ea/enterpriseadmin/getusercenterlist';
    const sign = (order === 'desc') ? '-' : '';
    const requestUrl =
      `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}
