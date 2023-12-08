import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA, MatDialog } from "@angular/material/dialog";
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from "ngx-toastr";
import swal from "sweetalert";
import { MatTableDataSource } from '@angular/material/table';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTabGroup } from '@angular/material/tabs';
import { MatSort } from '@angular/material/sort';
import { MatCheckbox } from '@angular/material/checkbox';
export interface trainingOperator {
  batchnum: any;
  civilnum: any;
  learnername: any;
  emailid: any;
  mobilnum:any;
  traingfee: any;
}
const TrainingoperatorList_Data: trainingOperator[] = [
  { batchnum: 'INV-999-CRI-2022-32' , civilnum: '45788' , learnername: 'Ahmed Bin Al Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6123' , traingfee: '130.000' },
  { batchnum: 'IVV-999-CRI-2022-32' , civilnum: '111' , learnername: 'Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6888' , traingfee: '10.000'},
 

];
@Component({
  selector: 'app-trainingoperatorpayment',
  templateUrl: './trainingoperatorpayment.component.html',
  styleUrls: ['./trainingoperatorpayment.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class TrainingoperatorpaymentComponent implements OnInit {

  public pending: boolean = false;
  public reci: boolean = false;
  public bronze: boolean = false;
  public gold: boolean =  false;
  public resultsLength: number;
  public fullpageloader: boolean = false;
  filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public page: number = 10;
  public ifarabic: boolean;
  @ViewChild(MatSort) sort: MatSort;
  public comments: boolean = false;
  public tablelodaer: boolean = false;
  public selectpayChkbox: boolean = true;
  @ViewChild('allpayChkBox') allpayChkBox: MatCheckbox;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService, public toastr: ToastrService,
    private cookieService: CookieService,) { this.operatorFeeData = new MatTableDataSource<trainingOperator>(TrainingoperatorList_Data); }
    
    i18n(key) {
      return this.translate.instant(key);
    }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
//  table column
  // operatorViewListData = ['batchnum' , 'civilnum' , 'learnername' , 'emailid' , 'mobilnum', 'traingfee'];
  operatorFeeData = new MatTableDataSource<trainingOperator>(TrainingoperatorList_Data);
  operatorViewListData = [
    { operatlist: "batchnum", searchfltr: "row-first", label: "Batch Number", operatehide: true },
    { operatlist: "civilnum", searchfltr: "row-second", label: "Civil Number", operatehide: true },
    { operatlist: "learnername", searchfltr: "row-third", label: "Learner Name", operatehide: true },
    { operatlist: "emailid", searchfltr: "row-fourth", label: "Email ID", operatehide: true },
    { operatlist: "mobilnum", searchfltr: "row-fifth", label: "Mobile Number", operatehide: true },
    { operatlist: "traingfee", searchfltr: "row-sixth", label: "Training Fee (OMR)", operatehide: true },
    { operatlist: "action", searchfltr: "row-refresh", label: "invoice.action", operatehide: true },


  ];
  // displayed column
  operatorViewListDatafun(): string[] {
    return this.operatorViewListData.filter(operator => operator.operatehide).map(operator => operator.operatlist);
  }
  // displayed search
  operatorViewListDatasear(): string[] {
    return this.operatorViewListData.filter(operator => operator.operatehide).map(operator => operator.searchfltr);
  }
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.filtername = "Hide Filter";
        this.ifarabic = false;
       }else{
        this.filtername = "إخفاء التصفية";
         this.ifarabic = true;
       }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
      this.ifarabic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.filtername = "Hide Filter";
          this.ifarabic = false;
         }else{
          this.filtername = "إخفاء التصفية";
           this.ifarabic = true;
         }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      }
    
    });
    this.operatorFeeData.sort = this.sort;
    this.operatorFeeData.paginator = this.paginator;
  }
   // column edit function
   selecttablelable(event: any) {
    this.selectpayChkbox = event.checked;
    this.operatorViewListData.forEach(item => {
      item.operatehide = this.selectpayChkbox;
    });
  }
  // column edit function
  updateSelectAll(item: any) {
    const CheckedAll = this.operatorViewListData.every(item => item.operatehide);
    if (CheckedAll) {
      this.allpayChkBox.checked = true;
    } else {
      this.allpayChkBox.checked = false;
    }
  }
  // search filter form control
  batch_number = new FormControl('');
  civil_number = new FormControl('');
  learner_name = new FormControl('');
  vehicle_owner = new FormControl('');
  email_number = new FormControl('');
  mobil_num = new FormControl('');

// filter hide show
  clickedEvent() {
    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('Show Filter');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('Hide Filter');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  // paginator
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  // filter clear
  clearFilter() {
    this.batch_number.reset()
    this.civil_number.reset()
    this.learner_name.reset()
    this.vehicle_owner.reset()
    this.email_number.reset()
    this.mobil_num.reset()
    
    }
}
