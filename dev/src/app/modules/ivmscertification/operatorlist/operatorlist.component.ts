import { Component, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
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
import { ToastrService } from 'ngx-toastr';
import swal from 'sweetalert';
import { IvmsService } from '../ivms.service';

export interface Element {
  appoprct_operatorname: string;
  appoprct_conttype: string;
  appoprct_contstartdate: string;
  appoprct_contenddate:string;
  appdt_status: string;
  date_added: string;
  date_updated: string;
}

const ELEMENT_DATA: Element[] = [
  {appoprct_operatorname:'OPAL-TP-BO-001',appoprct_conttype:'Main Office',appoprct_contstartdate:'Ubhar Capital',appoprct_contenddate:'FMB 120 device',appdt_status:'Approved',date_added:'24-03-2023',date_updated:'date_updated'  },
  {appoprct_operatorname:'OPAL-TP-BO-001',appoprct_conttype:'Main Office',appoprct_contstartdate:'Ubhar Capital',appoprct_contenddate:'FMB 120 device',appdt_status:'Approved',date_added:'24-03-2023',date_updated:'date_updated'  },
  {appoprct_operatorname:'OPAL-TP-BO-001',appoprct_conttype:'Main Office',appoprct_contstartdate:'Ubhar Capital',appoprct_contenddate:'FMB 120 device',appdt_status:'Approved',date_added:'24-03-2023',date_updated:'date_updated'  }
];

@Component({
  selector: 'app-operatorlist',
  templateUrl: './operatorlist.component.html',
  styleUrls: ['./operatorlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class OperatorlistComponent implements OnInit {
  apppk: any;

  i18n(key) {
    return this.translate.instant(key);
  }
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild('chckAll') chckAll: MatCheckbox;
  @ViewChild('DaterangepickerDirective' , { static: false }) dateofexpiry: DaterangepickerDirective;
@Input('viewForm') viewForm: boolean = false;
@Input('appdata') appdata: any;  
public resultsLength: number;
  public filtername = "Hide Filter";
  public hidefilder: boolean = true;
  public page: number = 10;
  public selectcheckbox: boolean;
  public ifarabic: boolean = false;
  public pageLoader: boolean = false;
  public placeholder: boolean = false;
  public responseInfor: any;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);

  operatorData = [
    { dispalycolum: "appoprct_operatorname", searchcolm: "row-first", label: "operatorcontact.opername", hideShow: true, disoperate: true },
    { dispalycolum: "appoprct_conttype", searchcolm: "row-second", label: "operatorcontact.conttype", hideShow: true, disoperate: false },
    { dispalycolum: "appoprct_contstartdate", searchcolm: "row-three", label: "operatorcontact.contstartdate", hideShow: true, disoperate: false },
    { dispalycolum: "appoprct_contenddate", searchcolm: "row-four", label: "operatorcontact.contenddate", hideShow: true, disoperate: false },
    { dispalycolum: "appdt_status", searchcolm: "row-five", label: "operatorcontact.stat", hideShow: false, disoperate: true },
    { dispalycolum: "date_added", searchcolm: "row-six", label: "branch.addon", hideShow: true, disoperate: false },
    { dispalycolum: "date_updated", searchcolm: "row-seven", label: "branch.lastupdat", hideShow: false, disoperate: false },
    { dispalycolum: "action", searchcolm: "row-eight", label: "branch.action", hideShow: true, disoperate: true },
  ];
  
   // displayed column
   getoperatorDataList(): string[] {
    return this.operatorData.filter(id => id.hideShow).map(id => id.dispalycolum);
  }

  // displayed search
  getoperatorDatasearch(): string[] {
    return this.operatorData.filter(id => id.hideShow).map(id => id.searchcolm);
  }

  // column edit function
  selectAll(event: any) {
    this.selectcheckbox = event.checked;
    this.operatorData.forEach(item => {
      item.hideShow = this.selectcheckbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
    }, 100);

  }

  // column edit function
  checkFlt() {
    const workChk = this.operatorData.every(item => item.hideShow);
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
    public toastr: ToastrService, private cookieService: CookieService,private route: Router,private security: Encrypt,public routeid: ActivatedRoute,public ivmsservice:IvmsService ) { }

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
    this.apppk = this.appdata;
    // this.checkFlt();
    this.getivmsoperatorgrid(0,10,null,null)

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
  operatorname = new FormControl('');
  contracttype = new FormControl('');
  contractstart = new FormControl('');
  appoprct_contenddate = new FormControl('')
  contractend = new FormControl('');
  Statusone = new FormControl('');
  dateexp = new FormControl('');
  addon = new FormControl('');
  updateon = new FormControl('');

  clearFilter() {
    this.operatorname.reset();
    this.contracttype.reset()
    this.appoprct_contenddate.reset();
    this.Statusone.reset();
    $(".clear").trigger("click");
  }

  getivmsoperatorgrid(page,limit,search,sort){
    this.ivmsservice.getivmsoperatorgrid(this.apppk,page,limit,search,sort).subscribe(res => {

      
    })
  }
  addForm() {
    this.viewForm = false;
  }

  editForm(data: any,type) {
    this.responseInfor = data;
    if(type == 'Edit') {
      this.viewForm = false;
    } else {
      this.viewForm = true;
    }
  }

  deleteRow() {
    swal({
      title: this.i18n('maincenter.doyouwantdeleoper'),
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
          this.toastr.success(this.i18n('maincenter.operdele'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }, 1000);
      }
    })
  }
}
