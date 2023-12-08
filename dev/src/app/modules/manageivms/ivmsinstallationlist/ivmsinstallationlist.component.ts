import { Component, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { DateAdapter, MAT_DATE_FORMATS } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { MatCheckbox } from '@angular/material/checkbox';
import { IvmsdeviceService } from '@app/services/ivmsdev.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { environment } from '@env/environment';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';

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

export interface Element {
  centre_name: any,
  office_type: any,
  owner_name: any,
  vehichle_reg: any,
  chasis_number: any,
  ivms_device: any,
  device_number: any,
  installer_name: any,
  installationdate_time: any,
  applicant_type: any,
  installation_status: any,
  certi_status: any,
  dateofexp: any,
}


const ELEMENT_DATA: Element[] = [
  {
    centre_name: 'Test',
    office_type: 'Main',
    owner_name: 'Test',
    vehichle_reg: '1234',
    chasis_number: '321',
    ivms_device: '12',
    device_number: '123',
    installer_name: 'Test',
    installationdate_time: '-',
    applicant_type: '-',
    installation_status: 'Active',
    certi_status: 'True',
    dateofexp: '-',
  },
];

const FILTERDATA = {
  centreName:[],
  officeType: [],
  ownerName: [],
  vehichleReg: [],
  chasisNumber: [],
  ivmsDevice: [],
  deviceNumber:[],
  installerName: [],
  installationDate: [],
  applicantType: [],
  installationStatus: [],
  installCertiStatus: [],
  expiryDate: [],
  branchName: [],
  crnumber: [],
  contactPerson: [],
  deviceIMEI: [],
  vechileCate: [],
  vechileSubCate: []
}

@Component({
  selector: 'app-ivmsinstallationlist',
  templateUrl: './ivmsinstallationlist.component.html',
  styleUrls: ['./ivmsinstallationlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class IvmsinstallationlistComponent implements OnInit {
  tableplaceholder: boolean = false;
  griddata: any =[];
  isfocalpoint: any;
  userPk: any;
  roles: any;
  stktype: any;
  filterdata: any;
  url: string;
  isInstaller: boolean;
  isSeniorTech: boolean;
  useraccess: any;
  approvalaccess: boolean;
  readaccess: boolean;
  createaccess: boolean;
  updateaccess: boolean;
  printcertificateaccess: boolean;
  admincreateaccess: boolean;
  adminreadaccess: boolean;
  adminupdateaccess: boolean;
  admindownloadaccess: boolean;
  viewcertificateaccess: boolean;
  index: number;
  sorting: { dir: any; key: any; };
  version: number = 0;
  downloadaccess: boolean;
  count1: any;
  i18n(key) {
    return this.translate.instant(key);
  }

  search: {
    centreName:any,
  officeType: any,
  ownerName: any,
  vehichleReg: any,
  chasisNumber: any,
  ivmsDevice: any,
  deviceNumber:any,
  installerName: any,
  installationDate: any,
  applicantType: any,
  installationStatus: any,
  installCertiStatus: any,
  expiryDate: any,
  branchName: any,
  crnumber: any,
  contactPerson: any,
  deviceIMEI: any,
  vechileCate: any,
  vechileSubCate: any
  };

  public PageLoaders: boolean = false;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  public selectAllVisible: boolean;
  page: number = 10;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  public clearClose: boolean = false;
  displayedColumns = [
    { def: "centre_name", search: "one", label: "Centre Name", visible: true, disabled: true },
    { def: "office_type", search: "two", label: "Office Type", visible: true, disabled: true },
    { def: "branch_name", search: "three", label: "Branch Name", visible: false, disabled: false },
    { def: "cr_number", search: "three-one", label: "CR Number", visible: false, disabled: false },
    { def: "owner_name", search: "four", label: "Owner Name", visible: true, disabled: false },
    { def: "contact_person", search: "five", label: "Contact Person Email ID", visible: false, disabled: false },
    { def: "vehichle_reg", search: "six", label: "Vehicle Reg. Number", visible: true, disabled: false },
    { def: "chasis_number", search: "seven", label: "Chassis Number", visible: true, disabled: true },
    { def: "ivms_device", search: "eight", label: "IVMS Device Model Number", visible: true, disabled: false },
    { def: "device_number", search: "nine", label: "Device Serial Number", visible: true, disabled: true },
    { def: "device_IMEI", search: "ten", label: "Device IMEI", visible: false, disabled: true },
    { def: "vechile_cate", search: "eleven", label: "Vehicle Category", visible: false, disabled: true },
    { def: "vechile_Subcate", search: "twelve", label: "Vehicle Sub Category", visible: false, disabled: true },
    { def: "installer_name", search: "thirteen", label: "Installer Name", visible: true, disabled: false },
    { def: "installationdate_time", search: "fouteen", label: "Installation Date & Time", visible: true, disabled: true },
    { def: "applicant_type", search: "fifteen", label: "Applicant Type", visible: true, disabled: false },
    { def: "installation_status", search: "sixteen", label: "Installation Status", visible: true, disabled: false },
    { def: "certi_status", search: "seventeen", label: "Installation Certificate Status", visible: true, disabled: false },
    { def: "dateofexp", search: "eighteen", label: "Date of Expiry", visible: true, disabled: false },
    { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }];


  constructor(
    public router: Router,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private ivmsService: IvmsdeviceService,
    private toastr:ToastrService,
    private localstorage: AppLocalStorageServices,
    protected security: Encrypt,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();

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
  public ifarbic: boolean = false;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
      } else {
        this.filtername = "إخفاء التصفية";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
    }

    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          ;
        } else {
          this.filtername = "إخفاء التصفية";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
    });
    this.url = environment.baseUrl;
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.roles = this.localstorage.getInLocal('role');
    this.userPk = this.localstorage.getInLocal('userPk');
    this.stktype = this.localstorage.getInLocal('stktype');
    console.log(this.roles);
    if(this.isfocalpoint == 2)
     {
      console.log(this.roles);
      if(this.roles.includes(20))
      {
        this.isInstaller = true;
      }
      if(this.roles.includes(19))
      {
        this.isSeniorTech = true;
      }
      
     }
     if(this.isfocalpoint == 2)
     {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      console.log(this.useraccess);
      this.SetUseraccess();
     }

   
    this.setDisplayedColumns();
    this.clearFilter();
      this.PageLoaders = true;
      this.getivmsdevicegriddata(this.page, this.index, null);
    setTimeout(() => {
      this.updateAllVisible();
    }, 1000);
  }
  centreName = new FormControl('');
  officeType = new FormControl('');
  ownerName = new FormControl('');
  vehichleReg = new FormControl('');
  chasisNumber = new FormControl('');
  ivmsDevice = new FormControl('');
  deviceNumber = new FormControl('');
  installerName = new FormControl('');
  installationDate = new FormControl('');
  applicantType = new FormControl('');
  installationStatus = new FormControl('');
  installCertiStatus = new FormControl('');
  expiryDate = new FormControl('');
  branchName = new FormControl('');
  crnumber = new FormControl('');
  contactPerson = new FormControl('');
  deviceIMEI = new FormControl('');
  vechileCate = new FormControl('');
  vechileSubCate = new FormControl('');

  SetUseraccess()
  {
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'IVMS Device Installation and Approval');
    
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].approval == 'Y'){
      this.approvalaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].read == 'Y'){
      this.readaccess = true;
    }
    
    if(this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].create == 'Y'){
      this.createaccess = true;
      console.log(this.createaccess);
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].update == 'Y'){
      this.updateaccess = true;
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].download == 'Y'){
      this.downloadaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][37] && this.useraccess[moduleid][37].create == 'Y'){
      this.printcertificateaccess = true;
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][37] && this.useraccess[moduleid][37].read == 'Y'){
      this.viewcertificateaccess = true;
    }
    
    let moduleidadmin = this.localstorage.getaccessmoduleid(this.stktype, 'Manage IVMS Device Installed Vehicles');
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31]  && this.useraccess[moduleidadmin][31].create == 'Y'){
      this.admincreateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31] && this.useraccess[moduleidadmin][31].read == 'Y'){
      this.adminreadaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31] && this.useraccess[moduleidadmin][31].update == 'Y'){
      this.adminupdateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31] && this.useraccess[moduleidadmin][31].download == 'Y'){
      this.admindownloadaccess = true;
    }

    
    
    if(!this.adminreadaccess && !this.readaccess && this.isfocalpoint==2)
     {
      this.PageLoaders = true;
      swal({
            title: "You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
            icon: 'warning',
            closeOnClickOutside: false,
            closeOnEsc: false
          }).then((willGoBack) => {
            
            if (willGoBack) {
              this.PageLoaders = false;
              if (this.stktype == 1) {
                this.router.navigate(['dashboard/portaladmin']);
              }
              else {
                this.router.navigate(['vehiclemanagement/vehiclelisting']);
              }
            }
     });
    }
    
  }
  clickEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';
    } else {
      this.filtername = this.i18n('table.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';
    }
  }


  clearfilterdata() {
    let value = {
      centreName:[] = [],
  officeType: [] = [],
  ownerName: [] = [],
  vehichleReg: [] = [],
  chasisNumber: [] = [],
  ivmsDevice: [] = [],
  deviceNumber:[] = [],
  installerName: [] = [],
  installationDate: [] = [],
  applicantType: [] = [],
  installationStatus: [] = [],
  installCertiStatus: [] = [],
  expiryDate: [] = [],
  branchName: [] = [],
  crnumber: [] = [],
  contactPerson: [] = [],
  deviceIMEI: [] = [],
  vechileCate: [] = [],
  vechileSubCate: [] = []
    };
    this.filterdata = value ;
  }

  clearFilter() {
    this.clearfilterdata();
    this.centreName.reset();
    this.officeType.reset();
    this.ownerName.reset();
    this.vehichleReg.reset();
    this.chasisNumber.reset();
    this.ivmsDevice.reset();
    this.deviceNumber.reset();
    this.installerName.reset();
    this.installationDate.reset();
    this.applicantType.reset();
    this.installationStatus.reset();
    this.installCertiStatus.reset();
    this.expiryDate.reset();
    this.branchName.reset();
    this.crnumber.reset();
    this.contactPerson.reset();
    this.deviceIMEI.reset();
    this.vechileCate.reset();
    this.vechileSubCate.reset();
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
    setTimeout(() => {
      this.getivmsdevicegriddata(this.page, this.index, this.filterdata);
    }, 2000);
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.index = event.pageIndex;
    this.getivmsdevicegriddata(this.paginator.pageSize, this.paginator.pageIndex, this.search)
    this.dataSource.sort = this.sort;
  }

  getivmsdevicegriddata(limit,page,searchkey,sorting=null){
    this.tableplaceholder = true;
    this.ivmsService.getivmsdevicegriddata(limit,page,searchkey,sorting).subscribe(res => {
      if (res.status == 200) {
      this.resultsLength = res['data']['dataset']['totalcount'];
      this.griddata = res['data']['dataset']['griddata'];
      this.dataSource = new MatTableDataSource<Element>(this.griddata);
      this.tableplaceholder = false;
      this.dataSource.sort = this.sort;
      // this.roadtype = res['data']['dataset']['roadtype'];
      }
      this.PageLoaders = false;
    });
  }


  

  generatesticker(element)
  {
    this.version = this.version +1;
    let encpk = this.security.encrypt(element.devicePk);
    this.tableplaceholder = true;
    swal({
      title: this.i18n("Do you want to Re-Generate the IVMS Certificate ?"),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.ivmsService.ivmscertificate(encpk,1).subscribe(res => {
      
          if(res.data.status == 1)
          {
            this.toastr.success(this.i18n('The IVMS Certificate is Re-Generated'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.getivmsdevicegriddata(this.page, this.index, this.filterdata);
          }
          else if(res.data.status == 3)
         {
          swal({
            title: this.i18n("Centre Logo is not available to generate the IVMS Certificate. Kindly inform your Centre's Focal Point to upload Logo."),
            icon: 'warning',
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          });
          this.getivmsdevicegriddata(this.page, this.index, this.filterdata);
         }
          else
          {
            swal({
              title: this.i18n('There was a problem while generating Certificate.'),
              icon: 'warning',
              className: this.dir =='ltr'?'swalEng':'swalAr',
              closeOnClickOutside: false
            });
            this.getivmsdevicegriddata(this.page, this.index, this.filterdata);
          }
        });
        
      } else {
        this.tableplaceholder = false;
      }
    });
    
    
  }

  sortingfunc(event,key){

    this.sorting = {
      'dir':event.direction,
      'key':event.active
    }
    this.tableplaceholder=true;
    setTimeout(() => {
      this.getivmsdevicegriddata(this.page, this.index, this.filterdata, this.sorting);
     
    }, 2000);
// console.log(event)
  }

  ivmsgridfilter(searckkey, formcontrolname) {
this.count1 = this.count1 + 1 ;
console.log(this.count1)
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    console.log(data)
    if(this.paginator?.pageIndex)
    {
      this.paginator.pageIndex = 0;
      this.index = 0;
    }
    this.filterdata = this.preparedata(data);
    this.getivmsdevicegriddata(this.page, this.index, this.filterdata,this.sorting)
  }

  changeDateInsp(serch, key)
  {
    var assessmentdata;
    if (serch.startDate) {
      assessmentdata = {
        startDate: moment(serch.startDate._d).format('YYYY-MM-DD'),
        endDate: moment(serch.endDate._d).format('YYYY-MM-DD')
      };
    }
    else
    {
      assessmentdata  = [];
    }

    this.ivmsgridfilter(assessmentdata, key);

  }

  preparedata(data) {

    let filterdata;
    if(!this.filterdata)
    {
      filterdata = FILTERDATA;
    }
    else{
      filterdata = this.filterdata;
    }
    
    Object.keys(filterdata).forEach(keys => {
      if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searckkey'];
      }
    });

    return filterdata;
  }

  // displayed column
  getdisplayedColumn(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
 
  }
  // displayed search
  getdisplayedsearch(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.search);
  }

  setDisplayedColumns()
  {
    if(this.stktype == 1)
    {
      this.displayedColumns = [
        { def: "centre_name", search: "one", label: "Centre Name", visible: true, disabled: true },
        { def: "office_type", search: "two", label: "Office Type", visible: true, disabled: true },
    { def: "branch_name", search: "three", label: "Branch Name", visible: false, disabled: false },
    { def: "cr_number", search: "three-one", label: "CR Number", visible: false, disabled: false },
    { def: "owner_name", search: "four", label: "Owner Name", visible: true, disabled: false },
    { def: "contact_person", search: "five", label: "Contact Person Email ID", visible: false, disabled: false },
    { def: "vehichle_reg", search: "six", label: "Vehicle Reg. Number", visible: true, disabled: false },
    { def: "chasis_number", search: "seven", label: "Chassis Number", visible: true, disabled: true },
    { def: "ivms_device", search: "eight", label: "IVMS Device Model Number", visible: true, disabled: false },
    { def: "device_number", search: "nine", label: "Device Serial Number", visible: true, disabled: true },
    { def: "device_IMEI", search: "ten", label: "Device IMEI", visible: false, disabled: true },
    { def: "vechile_cate", search: "eleven", label: "Vehicle Category", visible: false, disabled: true },
    { def: "vechile_Subcate", search: "twelve", label: "Vehicle Sub Category", visible: false, disabled: true },
    { def: "installer_name", search: "thirteen", label: "Installer Name", visible: true, disabled: false },
    { def: "installationdate_time", search: "fouteen", label: "Installation Date & Time", visible: true, disabled: true },
    { def: "applicant_type", search: "fifteen", label: "Applicant Type", visible: true, disabled: false },
    { def: "installation_status", search: "sixteen", label: "Installation Status", visible: true, disabled: false },
    { def: "certi_status", search: "seventeen", label: "Installation Certificate Status", visible: true, disabled: false },
    { def: "dateofexp", search: "eighteen", label: "Date of Expiry", visible: true, disabled: false },
    { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }];
    }
    else{
      this.displayedColumns = [
        
        { def: "office_type", search: "two", label: "Office Type", visible: true, disabled: true },
    { def: "branch_name", search: "three", label: "Branch Name", visible: false, disabled: false },
    { def: "cr_number", search: "three-one", label: "CR Number", visible: false, disabled: false },
    { def: "owner_name", search: "four", label: "Owner Name", visible: true, disabled: false },
    { def: "contact_person", search: "five", label: "Contact Person Email ID", visible: false, disabled: false },
    { def: "vehichle_reg", search: "six", label: "Vehicle Reg. Number", visible: true, disabled: false },
    { def: "chasis_number", search: "seven", label: "Chassis Number", visible: true, disabled: true },
    { def: "ivms_device", search: "eight", label: "IVMS Device Model Number", visible: true, disabled: false },
    { def: "device_number", search: "nine", label: "Device Serial Number", visible: true, disabled: true },
    { def: "device_IMEI", search: "ten", label: "Device IMEI", visible: false, disabled: true },
    { def: "vechile_cate", search: "eleven", label: "Vehicle Category", visible: false, disabled: true },
    { def: "vechile_Subcate", search: "twelve", label: "Vehicle Sub Category", visible: false, disabled: true },
    { def: "installer_name", search: "thirteen", label: "Installer Name", visible: true, disabled: false },
    { def: "installationdate_time", search: "fouteen", label: "Installation Date & Time", visible: true, disabled: true },
    { def: "applicant_type", search: "fifteen", label: "Applicant Type", visible: true, disabled: false },
    { def: "installation_status", search: "sixteen", label: "Installation Status", visible: true, disabled: false },
    { def: "certi_status", search: "seventeen", label: "Installation Certificate Status", visible: true, disabled: false },
    { def: "dateofexp", search: "eighteen", label: "Date of Expiry", visible: true, disabled: false },
    { def: "action", search: "row-action", label: "Action", visible: true, disabled: true }];
    }
  }

  // column edit function
  selectAllFun(event: any) {
    this.selectAllVisible = event.checked;
    this.displayedColumns.forEach(item => {
      item.visible = this.selectAllVisible;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
  }
  // column edit function
  updateAllVisible() {
    const allChecked = this.displayedColumns.every(item => item.visible);
    if (allChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 50);
  }

  // Move to Aother Page like View, Print etc.
  viewButton(type) {
    if (type == 'viewDetails') {
      this.router.navigate(['/manageivms/view']);
      localStorage.setItem('typeView', type)
    } else if (type == 'viewCerti') {
      this.router.navigate(['/manageivms/import-view']);
      localStorage.setItem('typeView', type)
    } 
    // else {
    //   this.router.navigate(['/']);
    //   localStorage.setItem('typeView', type)
    // }
  }

  importVehicleData()
  {
    this.router.navigate(['/manageivms/importexcel']);
  }

  installationreport(event,data) {
    let encregpk = this.security.encrypt(data.devicePk);
    if(event == 'upload') {
      this.router.navigate(['/manageivms/uploadreports/'+encregpk]);
    } else {
      this.router.navigate(['/manageivms/updatereports/'+encregpk]);
    }
  }

  viewandapprove(dataType,data) {
    let encregpk = this.security.encrypt(data.devicePk);
    if(dataType == 'View') {
      localStorage.setItem('typeView', dataType)
      this.router.navigate(['/manageivms/viewapprove/'+encregpk]);
    }
    else{
      localStorage.setItem('typeView', dataType)
      this.router.navigate(['/manageivms/viewandapproved/'+encregpk]);
    }
    
  }
  

  renew(element) {
    let encregpk = this.security.encrypt(element.devicePk);
    this.router.navigate(['/manageivms/ivmsrenewnow/'+encregpk]);
  }

  schedule(element) {
    let encregpk = this.security.encrypt(element.devicePk);
    this.router.navigate(['/manageivms/sheducledevice/'+encregpk]);
    localStorage.setItem('schedule', 'scheduledevice')
  }

  removedevice(element,type)
  {
    let encpk = this.security.encrypt(element.devicePk);
    this.tableplaceholder = true;
    swal({
      title: this.i18n("Do you want to update the status as 'Cancel (Removed Device)'?"),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.ivmsService.removedevice(encpk).subscribe(res => {
          this.tableplaceholder = false;
          if(res.data.status == 1)
          {
            this.getivmsdevicegriddata(this.page, this.index, this.filterdata);
            swal({
              title: this.i18n("The Vehicle Status is updated as 'Cancel (Removed Device)'."),
              text: '',
              icon: 'warning',
              buttons: [this.i18n('No'), this.i18n('Yes')],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        });
      } else {
        this.tableplaceholder = false;
      }
    });
    
  }

  printorviewcertificate(element,type)
  {
    let encpk = this.security.encrypt(element.devicePk);
    this.tableplaceholder = true;
    this.ivmsService.printorviewcertificate(encpk,type).subscribe(res => {
      if(res.data.status == 1)
      {
        this.getivmsdevicegriddata(this.page, this.index, this.filterdata);
      }
    });
  }

  getRemovedivicecondition(data)
  {
    if((data.installation_status == 7 || data.installation_status == 3) && data.applicant_type == 1 )
    {
      return true;
    }
    if((data.installation_status == 7 || data.installation_status == 3 || data.installation_status == 2) && (data.applicant_type == 3 || data.applicant_type ==2) )
    {
      return true;
    }
    else{
      return false;
    }
  }

  editdevicedetails(data)
  {
    let encregpk = this.security.encrypt(data.devicePk);
    this.router.navigate(['/manageivms/editivmsvehicle/'+encregpk]);
  }

  cancelregistration(data)
  {
    let encpk = this.security.encrypt(data.devicePk);
    this.tableplaceholder = true;
    swal({
      title: this.i18n('Do you want to Cancel the Device Registration?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.tableplaceholder = false;
        this.ivmsService.cancelRegistration(encpk).subscribe(res => {
          if(res.data.status == 1)
          {
            this.getivmsdevicegriddata(this.page, 0, this.filterdata);
          }
        });
      }
      else
      {
        this.tableplaceholder = false;
      }
    });
  }

  exportIvmsGridData()
  {
    this.PageLoaders = true;
    let visiblearray = [];
    this.displayedColumns.forEach(element => {
      if(element.visible == true)
      {
        visiblearray.push(element.def)
      }
    });
    this.ivmsService.exportIvmsGridData(null, null, this.filterdata,visiblearray).subscribe(res => {
      
      if (res.data.status == 1) {
        window.open(res.data.attend, '_blank');
        this.PageLoaders = false;
      }

    });
  }

  
}

