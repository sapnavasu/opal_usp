import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatCheckbox } from '@angular/material/checkbox';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import moment from 'moment';
import { CookieService } from 'ngx-cookie-service';
import { DaterangepickerDirective, LocaleConfig, NgxDaterangepickerMd } from 'ngx-daterangepicker-material';
import { IvmstabComponent } from './ivmstab/ivmstab.component';
import { IvmsService } from '../ivms.service';

export interface Element {
  appdt_appreferno: string;
  appiit_officetype: string;
  appiit_branchname_en: string;
  devicemodel:string;
  appdt_status: string;
  certifi_status:string;
  date_expiry: string;
  date_added: string;
  date_updated: string;
}

const ELEMENT_DATA: Element[] = [
  {appdt_appreferno:'OPAL-TP-BO-001',appiit_officetype:'Main Office',appiit_branchname_en:'Ubhar Capital',devicemodel:'FMB 120 device',appdt_status:'Approved',certifi_status:'Active',date_expiry:'23-03-2033',date_added:'24-03-2023',date_updated:'date_updated'  },
  {appdt_appreferno:'OPAL-TP-BO-001',appiit_officetype:'Main Office',appiit_branchname_en:'Ubhar Capital',devicemodel:'FMB 120 device',appdt_status:'Approved',certifi_status:'Active',date_expiry:'23-03-2033',date_added:'24-03-2023',date_updated:'date_updated'  },
  {appdt_appreferno:'OPAL-TP-BO-001',appiit_officetype:'Main Office',appiit_branchname_en:'Ubhar Capital',devicemodel:'FMB 120 device',appdt_status:'Approved',certifi_status:'Active',date_expiry:'23-03-2033',date_added:'24-03-2023',date_updated:'date_updated'  }
];

@Component({
  selector: 'app-ivmscentrelist',
  templateUrl: './ivmscentrelist.component.html',
  styleUrls: ['./ivmscentrelist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class IvmscentrelistComponent implements OnInit {
  searchdata: { application_no: any; officetype: any; branch_name: any; device_model: any; appli_status: any; cert_status: any; dateexp_startDate: string; dateexp_enddate: string; addon_startDate: string; addon_enddate: string; updateon_startDate: string; updateon_enddate: string; };

  i18n(key) {
    return this.translate.instant(key);
  }

  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('chckAll') chckAll: MatCheckbox;
  @ViewChild('tabactions') tabactions: IvmstabComponent;
  @ViewChild('DaterangepickerDirective' , { static: false }) dateofexpiry: DaterangepickerDirective;
  public resultsLength: number;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  public page: number = 10;
  public selectcheckbox: boolean;
  public  ifarabic: boolean = false;
  public pageLoader: boolean = false;
  public tblplaceholder: boolean = false;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);

  BranchListData = [
    { dispalycolum: "appdt_appreferno", searchcolm: "row-first", label: "branch.applform", hideShow: true, disoperate: true },
    { dispalycolum: "appiit_officetype", searchcolm: "row-second", label: "institute.offitype", hideShow: true, disoperate: false },
    { dispalycolum: "appiit_branchname_en", searchcolm: "row-three", label: "branch.branchname", hideShow: true, disoperate: false },
    { dispalycolum: "devicemodel", searchcolm: "row-four", label: "Device Model Number", hideShow: true, disoperate: false },
    { dispalycolum: "appdt_status", searchcolm: "row-five", label: "branch.applstat", hideShow: false, disoperate: true },
    { dispalycolum: "certifi_status", searchcolm: "row-six", label: "branch.certstat", hideShow: true, disoperate: false },
    { dispalycolum: "date_expiry", searchcolm: "row-seven", label: "branch.dateexoi", hideShow: true, disoperate: false },
    { dispalycolum: "date_added", searchcolm: "row-eight", label: "branch.addon", hideShow: true, disoperate: false },
    { dispalycolum: "date_updated", searchcolm: "row-nine", label: "branch.lastupdat", hideShow: false, disoperate: false },
    { dispalycolum: "action", searchcolm: "row-ten", label: "branch.action", hideShow: true, disoperate: true },
  ];
  
   // displayed column
   getworkExperienceList(): string[] {
    return this.BranchListData.filter(id => id.hideShow).map(id => id.dispalycolum);
  }

  // displayed search
  getBranchListDatasearch(): string[] {
    return this.BranchListData.filter(id => id.hideShow).map(id => id.searchcolm);
  }

  // column edit function
  selectAll(event: any) {
    this.selectcheckbox = event.checked;
    this.BranchListData.forEach(item => {
      item.hideShow = this.selectcheckbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 100);

  }

  // column edit function
  checkFlt() {
    const workChk = this.BranchListData.every(item => item.hideShow);
    if (workChk) {
      this.chckAll.checked = true;
    } else {
      this.chckAll.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 100);
  }

  // range  label
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
  
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  constructor(private translate: TranslateService,private remoteService: RemoteService,private localstorage: AppLocalStorageServices,
    private cookieService: CookieService,private route: Router,private security: Encrypt,public routeid: ActivatedRoute ,public ivmsservice:IvmsService ) { }

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
   setTimeout(() => {
    this.checkFlt();
   }, 200);
   this.getivmsgrid(0,10,null,null)
  }
  
  ngAfterViewInit() {
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
  }
  
  syncPrimaryPaginator(event: PageEvent) {
    console.log("dafas",event)
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
   
  clickEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.show');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';
    } else {
      this.filtername = this.i18n('table.hide');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';
    }
  }
  
  //filterformcontral name
  application_no = new FormControl('');
  officetype = new FormControl('');
  branch_name = new FormControl('');
  device_model = new FormControl('')
  appli_status = new FormControl('');
  cert_status = new FormControl('');
  dateexp = new FormControl('');
  addon = new FormControl('');
  updateon = new FormControl('');

  searchgrid(){
    if(this.dateexp.value?.startDate != 'undefind' && this.dateexp.value?.startDate != 'Invalid date' && this.dateexp.value?.startDate != 'null' && this.dateexp.value?.startDate != null){
      var dateexp_startDate =  moment(this.dateexp.value?.startDate).format('YYYY-MM-DD').toString();
      var dateexp_enddate =  moment(this.dateexp.value?.endDate).format('YYYY-MM-DD').toString();
      }
    if(this.addon.value?.startDate != 'undefind' && this.addon.value?.startDate != 'Invalid date' && this.addon.value?.startDate != 'null' && this.addon.value?.startDate != null){
      var addon_startDate =  moment(this.addon.value?.startDate).format('YYYY-MM-DD').toString();
      var addon_enddate =  moment(this.addon.value?.endDate).format('YYYY-MM-DD').toString();
      }
    if(this.updateon.value?.startDate != 'undefind' && this.updateon.value?.startDate != 'Invalid date' && this.updateon.value?.startDate != 'null' && this.updateon.value?.startDate != null){
      var updateon_startDate =  moment(this.updateon.value?.startDate).format('YYYY-MM-DD').toString();
      var updateon_enddate =  moment(this.updateon.value?.endDate).format('YYYY-MM-DD').toString();
      }
    this.searchdata ={
      application_no : this.application_no.value,
      officetype  : this.officetype.value,
      branch_name : this.branch_name.value,
      device_model : this.device_model.value,
      appli_status : this.appli_status.value,
      cert_status : this.cert_status.value,
      dateexp_startDate:dateexp_startDate,
      dateexp_enddate:dateexp_enddate,
      addon_startDate:addon_startDate,
      addon_enddate:addon_enddate,
      updateon_startDate:updateon_startDate,
      updateon_enddate:updateon_enddate
    }
  }
  clearFilter() {
    this.application_no.reset();
    this.officetype.reset()
    this.branch_name.reset();
    this.device_model.reset();
    this.appli_status.reset();
    this.cert_status.reset();
    $(".clear").trigger("click");
  }

  addInformation() {
    // this.tabactions.addForm();
  }

  getivmsgrid(page,limit,search,sort){
      this.ivmsservice.getivmsgrid(page,limit,search,sort).subscribe(res => {

        
      })
  }
}
