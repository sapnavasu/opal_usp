import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import moment from 'moment';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import { ApplicationService } from '@app/services/application.service';
import { HttpClient } from '@angular/common/http';
import { environment } from '@env/environment';
import { Observable, merge } from 'rxjs';
import { catchError, map, startWith, switchMap } from 'rxjs/operators';
import { of as observableOf } from 'rxjs/observable/of';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { CookieService } from 'ngx-cookie-service';
export interface Element {
  scm_coursename_en: string;
  rm_name_en: string;
  appdm_certificateexpiry: string;
}
export interface ofrcourdtls {
  appocm_coursename_en: string;
  appocm_courseduration: string;
  ccm_catname_en: string;
}

const ELEMENT_DATA: Element[] = [
  {
    scm_coursename_en: "Defensive Driving",
    rm_name_en: "Training & Assessment",
    appdm_certificateexpiry: "30-03-2022",
  },
];


@Component({
  selector: 'app-viewmaincentre',
  templateUrl: './viewmaincentre.component.html',
  styleUrls: ['./viewmaincentre.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewmaincentreComponent implements OnInit {
  alwaysShowCalendars: boolean;
  title = new FormControl('');
  expirydate = new FormControl('');
  approvedfor = new FormControl('');

  titleofr = new FormControl('');
  expirydateofr = new FormControl('');
  approvedforofr = new FormControl('');
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('table2') sort1: MatSort;
  

  locale: LocaleConfig = {
    format:'DD-MM-YYYY',
  }
  drvInputed: DriveInput;
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  displayedColumns = [
    "scm_coursename_en",
    "rm_name_en",
    "appdm_certificateexpiry",
  ];
  displayedColumn = [
    "appocm_coursename_en",
    "appocm_courseduration",
    "ccm_catname_en",
    "levelone",
    "type"
  ];
  public enabled: boolean = true;
  public userList: any;
  @ViewChild('awarddoc') awarddocFilee: Filee;
  // centreviewdataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  public mapMarkerLocation: string = '';
  public trainingprovform: FormGroup;
  public latitude: number;
  public longitude: number;
  mainIntrGridDatasStaff: MainStaffPagination;
  mainIntrGridDatasStaffwork: MainStaffworkPagination;
  http: HttpClient;
  @ViewChild('table1', {read: MatSort}) sortWork: MatSort;
  @ViewChild('table2', {read: MatSort}) sortStaff: MatSort;
  private querystr: string;
  page: number = 10;
  searchControl: FormControl = new FormControl('');
  resultsLengthStaff: number;
  resultsLengthStaffwork: number;
  public interRecListDataStaff: MatTableDataSource<any>;
  public interRecListDataStaffwork: MatTableDataSource<any>;
  noDatafour:  any = '';
  noDatafive:  any = '';
  filtersts:boolean = true;
  public compdtls: any;
  public ofrcourdtls: any;
  public ofrcourdtls_cat: any;
  public stdcourdtls: any;
  public appstatus:any;
  public offdtls: any;
  drv_logo: DriveInput;
  @ViewChild('logo') logo: Filee;
  @ViewChild('changebannerlogo') changebannerlogo: Filee;
  public isChangebanneredit :boolean = true;
  @ViewChild(Filee) filees: Filee;
  @ViewChild("paginator") paginator: MatPaginator;
  ifarabic: any;
  //emptyimgenable  :boolean = true;
  // @ViewChild(MatPaginator) paginator: MatPaginator;
  emptyimgenable  :boolean = true;

  constructor(
    private appservice : ApplicationService,
    private fb: FormBuilder,
    public routeid: ActivatedRoute,private route: Router, private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    ) { }
    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){ 
        this.ifarabic = false;
      }else {
        this.ifarabic = true;
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.ifarabic = false;
    
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){ 
          this.ifarabic = false;
        }else {
          this.ifarabic = true;
        }
      
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.ifarabic = false;
       
      }
     
    });
    this.trainingprovform = this.fb.group({
      Upload: ['', ''],
      lat: ['', ''],
      lang: ['', ''],
    });
    this.drvInputed = {
      fileMstPk: 15,
      selectedFilesPk: []
    };

    this.drv_logo = {
      fileMstPk: 8,
      selectedFilesPk: []
    };

    this.routeid.queryParams.subscribe(params => {
      if(params['app_pk']){
        
        this.appservice.getviewdetails(params['app_pk']).subscribe(data => {
          this.stdcourdtls=data.data.data.stdcour;
          this.stdcourdtls = new MatTableDataSource<any>(data.data.data.stdcour);
          this.stdcourdtls.sort=this.sort;
          this.ofrcourdtls=data.data.data.ofrcour;
          this.ofrcourdtls_cat=data.data.data.ofrcour;
          this.ofrcourdtls = new MatTableDataSource<any>(data.data.data.ofrcour);
          this.ofrcourdtls.sort=this.sort1;
          this.compdtls=data.data.data.comp;
          this.appstatus=data.data.data.appstatus;
          
          if(this.appstatus == 19){
            this.isChangebanneredit = false;
          }
          
          if(this.compdtls.omrm_cmplogo && this.compdtls.omrm_cmplogo != 'null'){
            this.drv_logo.selectedFilesPk = [this.compdtls.omrm_cmplogo];
            setTimeout(() => {
              this.logo.triggerChange();
            }, 1000);
          }
           
          if(this.compdtls.omrm_cmpbanner && this.compdtls.omrm_cmpbanner != 'null'){
            
            this.drvInputed.selectedFilesPk = [this.compdtls.omrm_cmpbanner];
            this.emptyimgenable = false;
            setTimeout(() => {
              this.changebannerlogo.triggerChange();
            }, 1000);
          }

        })

        
       
      }
   });

    

    // this.appservice.getviewdetails().subscribe(data => {
    //   this.stdcourdtls="";
   
    // })

    // this.appservice.getviewdetails().subscribe(data => {
    //   this.ofrcourdtls="";
    // })

    
    // this.title = new FormControl('');
    // this.title.valueChanges.debounceTime(400).subscribe(
    //   register => {  
    //     if (register != null ) {
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();   
    //     }else if(register == ''){
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }    
    //   }
    // )

    // this.approvedfor = new FormControl('');
    // this.approvedfor.valueChanges.debounceTime(400).subscribe(
    //   register => {  
    //     if (register != null ) {
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }else if(register == ''){
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }    
    //   }
    // )

    // this.expirydate = new FormControl('');
    // this.expirydate.valueChanges.debounceTime(400).subscribe(
    //   register => {  
    //     if (register != null ) {
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }else if(register == ''){
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }    
    //   }
    // )

    // ///////////////////////////

    // this.titleofr = new FormControl('');
    // this.titleofr.valueChanges.debounceTime(400).subscribe(
    //   register => {  
    //     if (register != null ) {
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();   
    //     }else if(register == ''){
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }    
    //   }
    // )

    // this.approvedforofr = new FormControl('');
    // this.approvedforofr.valueChanges.debounceTime(400).subscribe(
    //   register => {  
    //     if (register != null ) {
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }else if(register == ''){
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }    
    //   }
    // )

    // this.expirydateofr = new FormControl('');
    // this.expirydateofr.valueChanges.debounceTime(400).subscribe(
    //   register => {  
    //     if (register != null ) {
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }else if(register == ''){
    //       //this.paginator.pageIndex = 0;
    //       this.getStdCour();
    //     }    
    //   }
    // )

    
    
  }

  

  getLocationDetails(value) {
    this.trainingprovform.controls['lat'].setValue(100);
    this.trainingprovform.controls['lang'].setValue(200);
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
    this.appservice.savebannerimg(file,).subscribe(data => {
      if(data['data'].status == 1){
        this.emptyimgenable = false;
      }
    })
    setTimeout(() => {
      this.changebannerlogo.triggerChange();
    }, 1000);
    
   }

   deletebanner(){
    this.drvInputed.selectedFilesPk = [];
    setTimeout(() => {
      this.changebannerlogo.triggerChange();
    }, 1000);
    this.appservice.deletebannerimg().subscribe(data => {
      if(data['data'].status == 1){
        this.emptyimgenable = true;
        //this.slidesStore = [{ imagepath: "assets/images/Jsrsbannernew.jpg" }];
      }
    })
  }

  //  getStdCour() {
  //   this.mainIntrGridDatasStaffwork = new MainStaffworkPagination(this.http);
  //   this.sortWork?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
  //   var gridsearchvalue = {};
  //   gridsearchvalue = {};
    
  //   merge(this.sortWork?.sortChange)
  //     .pipe(
  //       startWith({}),
  //       switchMap(() => {
  //         this.querystr = '';
  //           return this.mainIntrGridDatasStaffwork.interStaffworkGridUtil('', '',  0,
  //             this.page, this.querystr, this.searchControl.value,JSON.stringify(gridsearchvalue));
  //       }),
  //       map(data => {
  //         this.resultsLengthStaffwork = data['data'].data.totalcount;
  //         return data['data'].data.data;
  //       }),
  //       catchError(() => {
  //         return observableOf('failure');
  //       })
  //     ).subscribe(data => {
  //       this.interRecListDataStaffwork = new MatTableDataSource(data);
  //       this.interRecListDataStaffwork.filterPredicate = this.createFilter();
  //       //this.Contentplaceloader = false;
  //       this.filtersts = true;
  //       this.noDatafour = this.interRecListDataStaffwork.connect().pipe(map(data => data.length === 0));
        
  //     });
  // }

  // getOfrCour() {
    
  //   this.mainIntrGridDatasStaff = new MainStaffPagination(this.http);
  //   this.sortStaff?.sortChange.debounceTime(400).subscribe(() => this.paginator.pageIndex = 0);
  //   var gridsearchvalue = {};
  //   gridsearchvalue = {};
  //   //alert(this.paginator.pageIndex - 1);
  //   merge(this.sortStaff?.sortChange)
  //     .pipe(
  //       startWith({}),
  //       switchMap(() => {
  //         this.querystr = '';
  //           return this.mainIntrGridDatasStaff.interStaffGridUtil(this.sortStaff.active, this.sortStaff.direction,  this.paginator.pageIndex - 1,
  //             this.page, this.querystr, this.searchControl.value,JSON.stringify(gridsearchvalue));
  //       }),
  //       map(data => {
  //         this.resultsLengthStaff = data['data'].data.totalcount;
  //         return data['data'].data.data;
  //       }),
  //       catchError(() => {
  //         return observableOf('failure');
  //       })
  //     ).subscribe(data => {
  //       this.interRecListDataStaff = new MatTableDataSource(data);
  //       this.interRecListDataStaff.filterPredicate = this.createFilter();
  //       //this.Contentplaceloader = false;
  //       this.filtersts = true;
  //       this.noDatafive = this.interRecListDataStaff.connect().pipe(map(data => data.length === 0));
  //       //this.tblplaceholder = false;
  //     });
  // }

  createFilter(): (data: any, filter: string) => boolean {
    let filterFunction = function (data, filter): boolean {
      let searchTerms = JSON.parse(filter);
      return data.mcm_RegistrationNo.toLowerCase().indexOf(searchTerms.mcm_RegistrationNo) !== -1 &&
        data.MCM_SupplierCode.toLowerCase().indexOf(searchTerms.MCM_SupplierCode) !== -1 &&
        data.MCM_CompanyName.toLowerCase().indexOf(searchTerms.MCM_CompanyName) !== -1 &&
        data.CyM_CountryName_en.toLowerCase().indexOf(searchTerms.CyM_CountryName_en) !== -1 &&
        //data.MRM_RenewalStatus.toLowerCase().indexOf(searchTerms.MRM_RenewalStatus) !== -1 &&
        data.UM_EmailID.toLowerCase().indexOf(searchTerms.UM_EmailID) !== -1 &&
        data.MRM_CreatedOn.toLowerCase().indexOf(searchTerms.MRM_CreatedOn) !== -1 &&
        data.invoicedays.toLowerCase().indexOf(searchTerms.invoicedays) !== -1 &&
        data.membersts.toLowerCase().indexOf(searchTerms.membersts) !== -1 &&
        data.subscriptionstatus.toLowerCase().indexOf(searchTerms.subscriptionstatus) !== -1 &&
        data.mcpd_pymtapprovalstatus.toLowerCase().indexOf(searchTerms.mcpd_pymtapprovalstatus) !== -1;
    }
    return filterFunction;
  }
  opendrive(data) {
    this.filees.openDrive(data)
  }
}


export class MainStaffPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffGridUtil(sort: string, order: string, page: number, 
      size: number, query: string, search?: string,gridsearchValues?:string): Observable<any> { 
    const sign = (order === 'desc') ? '-' : '';    
    const href = environment.baseUrl + 'center/app-center/getstaff';
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}

export class MainStaffworkPagination {
  constructor(private http?: HttpClient) {
  }
  interStaffworkGridUtil(sort: string, order: string, page: number, 
      size: number, query: string, search?: string,gridsearchValues?:string): Observable<any> { 
    const sign = (order === 'desc') ? '-' : '';    
    const href = environment.baseUrl + 'center/app-center/getstaffwork';
    const requestUrl =
    `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}&search=${search}&gridsearchValues=${gridsearchValues}`;
    return this.http.get<any>(requestUrl, { headers: { Authorization: 'Bearer ' + localStorage.getItem('v3logindata') } });
  }
}