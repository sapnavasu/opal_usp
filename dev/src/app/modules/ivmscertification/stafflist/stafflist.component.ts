import { Component, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
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
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr';

export interface Element {
  sir_idnumber: string;
  sir_name_en: string;
  sir_emailid: string;
  age:string;
  gender: string;
  ocym_countryname_en:string;
  appsit_mainrole: string;
  appsit_status: string;
  appsit_compcard: string;
  created_on: string;
  updated_on: string;
}

const ELEMENT_DATA: Element[] = [
  {sir_idnumber:'OPAL-TP-BO-001',sir_name_en:'Main Office',sir_emailid:'Ubhar Capital',age:'FMB 120 device',gender:'Approved',ocym_countryname_en:'Active',appsit_mainrole:'23-03-2033',appsit_status:'24-03-2023',appsit_compcard:'appsit_compcard',created_on:'02-3-2022',updated_on:'04-3-2024'  },
  {sir_idnumber:'OPAL-TP-BO-001',sir_name_en:'Main Office',sir_emailid:'Ubhar Capital',age:'FMB 120 device',gender:'Approved',ocym_countryname_en:'Active',appsit_mainrole:'23-03-2033',appsit_status:'24-03-2023',appsit_compcard:'appsit_compcard',created_on:'02-3-2022',updated_on:'04-3-2024'  },
  {sir_idnumber:'OPAL-TP-BO-001',sir_name_en:'Branch Office',sir_emailid:'Ubhar Capital',age:'FMB 120 device',gender:'Approved',ocym_countryname_en:'Active',appsit_mainrole:'23-03-2033',appsit_status:'24-03-2023',appsit_compcard:'appsit_compcard',created_on:'02-3-2022',updated_on:'04-3-2024'  }
];

@Component({
  selector: 'app-stafflist',
  templateUrl: './stafflist.component.html',
  styleUrls: ['./stafflist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class StafflistComponent implements OnInit {

  i18n(key) {
    return this.translate.instant(key);
  }

  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('chckAll') chckAll: MatCheckbox;
  @ViewChild('DaterangepickerDirective' , { static: false }) dateofexpiry: DaterangepickerDirective;
  @Input('viewForm') viewForm: boolean = false;
  public resultsLength: number;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  public page: number = 10;
  public selectcheckbox: boolean;
  public  ifarabic: boolean = false;
  public pageLoader: boolean = false;
  public tblplaceholder: boolean = false;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);

  staffListData = [
    { staffcolumn: "sir_idnumber", srchFilt: "row-first", label: "staff.civinumb", DataVisible: true, disoperate: true },
    { staffcolumn: "sir_name_en", srchFilt: "row-second", label: "staff.staffname", DataVisible: true, disoperate: false },
    { staffcolumn: "sir_emailid", srchFilt: "row-three", label: "staff.email", DataVisible: false, disoperate: false },
    { staffcolumn: "age", srchFilt: "row-four", label: "staff.age", DataVisible: false, disoperate: false },
    { staffcolumn: "gender", srchFilt: "row-five", label: "staff.gender", DataVisible: true, disoperate: true },
    { staffcolumn: "ocym_countryname_en", srchFilt: "row-six", label: "staff.nation", DataVisible: true, disoperate: false },
    { staffcolumn: "appsit_mainrole", srchFilt: "row-seven", label: "staff.mainrole", DataVisible: true, disoperate: false },
    { staffcolumn: "appsit_status", srchFilt: "row-eight", label: "staff.stat", DataVisible: true, disoperate: true },
    { staffcolumn: "appsit_compcard", srchFilt: "row-comp", label: "Competency Card", DataVisible: true, disoperate: true },
    { staffcolumn: "created_on", srchFilt: "row-nine", label: "staff.addon", DataVisible: false, disoperate: false },
    { staffcolumn: "updated_on", srchFilt: "row-ten", label: "staff.lastupdat", DataVisible: false, disoperate: false },
    { staffcolumn: "action", srchFilt: "row-last", label: "staff.Action", DataVisible: true, disoperate: true },
  ];
  
   // displayed column
   getworkExperienceList(): string[] {
    return this.staffListData.filter(id => id.DataVisible).map(id => id.staffcolumn);
  }

  // displayed search
  getBranchListDatasearch(): string[] {
    return this.staffListData.filter(id => id.DataVisible).map(id => id.srchFilt);
  }

  // column edit function
  selectAll(event: any) {
    this.selectcheckbox = event.checked;
    this.staffListData.forEach(item => {
      item.DataVisible = this.selectcheckbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 100);

  }

  // column edit function
  checkFlt() {
    const workChk = this.staffListData.every(item => item.DataVisible);
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
    public toastr: ToastrService, private cookieService: CookieService,private route: Router,private security: Encrypt,public routeid: ActivatedRoute  ) { }

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
  civil_numb = new FormControl('');
  staff_name = new FormControl('');
  email_id = new FormControl('');
  gender = new FormControl('');
  Nation = new FormControl('');
  main_role = new FormControl('');
  status_cour = new FormControl('');
  comp_card = new FormControl('');
  addd_oncour = new FormControl('');
  LastUpdatedstaffdate = new FormControl('');

  clearFilter() {
    this.civil_numb.setValue("");
    this.staff_name.setValue("");
    this.email_id.setValue("");
    this.gender.setValue("");
    this.Nation.setValue("");
    this.main_role.setValue("");
    this.status_cour.setValue("");
    this.comp_card.reset()
    $(".clear").trigger("click");
  }

  addInformation() {
    // this.tabactions.addForm();
  }

  deleteRow() {
    swal({
      title: this.i18n('maincenter.doyouwantdelestaff'),
      text: ' ',
      icon: "warning",
      buttons: [this.i18n('uploadfile.cancle'), this.i18n('uploadfile.ok')],
      dangerMode: true,
      // className: "swal-delete",
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        setTimeout(() => {
          this.toastr.success(this.i18n('maincenter.satffdele'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }, 1000);
      }
    })
  }
}
