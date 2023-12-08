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
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment from 'moment';
import { MatSort } from '@angular/material/sort';
import { ActivatedRoute, Router } from '@angular/router';
import { MatCheckbox } from '@angular/material/checkbox';
import { RoyaltyService } from '@app/services/royalty.service';
import { Location } from '@angular/common';

export interface royaltytrainFee {
  BatchNumber: any;
  civilnum: any;
  LearnerName: any;
  LearnerEmail: any;
  LearnerNumber:any;
  trainingFee: any;
  royaltytrainfee: any;
  rasf_appdecon:any;
  rasf_appdecComments:any;
  oum_firstname:any;

}
const FILTERDATA = {
  batch_number: [],
  civil_number: [],
  learner_name: [],
  status: [],
  email_number: [],
  mobil_num: [],
}
// const royaltytrainfeeList_Data: royaltytrainFee[] = [
//   { batchnum: 'INV-999-CRI-2022-32' , civilnum: '45788' , learnername: 'Ahmed Bin Al Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6123' , traingfee: '130.000' , royaltytrainfee: '50.000'},
//   { batchnum: 'IVV-999-CRI-2022-32' , civilnum: '111' , learnername: 'Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6888' , traingfee: '10.000' , royaltytrainfee: '10.000'},
//   { batchnum: 'INV-999-CRI-2022-32' , civilnum: '45788' , learnername: 'Ahmed Bin Al Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6123' , traingfee: '130.000' , royaltytrainfee: '50.000'},
//   { batchnum: 'IVV-999-CRI-2022-32' , civilnum: '111' , learnername: 'Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6888' , traingfee: '10.000' , royaltytrainfee: '10.000'},
//   { batchnum: 'INV-999-CRI-2022-32' , civilnum: '45788' , learnername: 'Ahmed Bin Al Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6123' , traingfee: '130.000' , royaltytrainfee: '50.000'},
//   { batchnum: 'IVV-999-CRI-2022-32' , civilnum: '111' , learnername: 'Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6888' , traingfee: '10.000' , royaltytrainfee: '10.000'},
//   { batchnum: 'INV-999-CRI-2022-32' , civilnum: '45788' , learnername: 'Ahmed Bin Al Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6123' , traingfee: '130.000' , royaltytrainfee: '50.000'},
//   { batchnum: 'IVV-999-CRI-2022-32' , civilnum: '111' , learnername: 'Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6888' , traingfee: '10.000' , royaltytrainfee: '10.000'},
//   { batchnum: 'INV-999-CRI-2022-32' , civilnum: '45788' , learnername: 'Ahmed Bin Al Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6123' , traingfee: '130.000' , royaltytrainfee: '50.000'},
//   { batchnum: 'IVV-999-CRI-2022-32' , civilnum: '111' , learnername: 'Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6888' , traingfee: '10.000' , royaltytrainfee: '10.000'},
//   { batchnum: 'INV-999-CRI-2022-32' , civilnum: '45788' , learnername: 'Ahmed Bin Al Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6123' , traingfee: '130.000' , royaltytrainfee: '50.000'},
//   { batchnum: 'IVV-999-CRI-2022-32' , civilnum: '111' , learnername: 'Rahman Ibrahim' , emailid: 'rahman@gmail.com' , mobilnum: '+968 2416 6888' , traingfee: '10.000' , royaltytrainfee: '10.000'},
 

// ];
@Component({
  selector: 'app-royaltypayment',
  templateUrl: './royaltypayment.component.html',
  styleUrls: ['./royaltypayment.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class RoyaltypaymentComponent implements OnInit {
  public pending: boolean = false;
  public approved: boolean = false;
  public bronze: boolean = false;
  public gold: boolean =  false;
  public resultsLength: number;
  public royalpageloader: boolean = false;
  royaltyFeePaymentId:any;
  royalFreePaymentDetails:any;
  isData:boolean = false;
  learnerDetails:any;
  filtername = "Hide Filter";
  public hidefilder: boolean = true;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("paginator") paginator: MatPaginator;
  public pageEvent: any;
  public page: number = 10;
  public ifarabic: boolean;
  @ViewChild(MatSort) sort: MatSort;
  public comments: boolean = false;
  public tableplaceloader: boolean = false;
  public selectpayChkbox: boolean = true;
  @ViewChild('allpayChkBox') allpayChkBox: MatCheckbox;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService, public toastr: ToastrService,
    private activatedRoute : ActivatedRoute,
    private service: RoyaltyService,
    private cookieService: CookieService,private _location:Location) { this.royaltytrainfeeData = new MatTableDataSource<royaltytrainFee>(); }
    
    i18n(key) {
      return this.translate.instant(key);
    }

    filterdata : {
      invoiceno: [],
      training_provider: [],
      officetype: [],
      branchname: [],
      assessmentcentre: [],
      assessorofficetype: [],
      assessorbranch: [],
      invoicemonth: [],
      totallearner: [],
      invoiceamount: [],
      paymentstatus: [],
      invoiceage: [],
      invoicedate: [],
      paymentdate:[],
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
//  table column
  // royaltytrainfeeListData = ['batchnum' , 'civilnum' , 'learnername' , 'emailid' , 'mobilnum', 'traingfee' , 'royaltytrainfee'];
  royaltytrainfeeData = new MatTableDataSource<royaltytrainFee>();
  royaltytrainfeeListData = [
    { royalpay: "batchnum", searchfltr: "row-first", label: "Batch Number", paymenthide: true },
    { royalpay: "civilnum", searchfltr: "row-second", label: "Civil Number", paymenthide: true },
    { royalpay: "learnername", searchfltr: "row-third", label: "Learner Name", paymenthide: true },
    { royalpay: "status", searchfltr: "row-fourth", label: "Status", paymenthide: true },
    { royalpay: "emailid", searchfltr: "row-fifth", label: "Email ID", paymenthide: true },
    { royalpay: "mobilnum", searchfltr: "row-sixth", label: "Mobile Number", paymenthide: true },
    { royalpay: "traingfee", searchfltr: "row-seventh", label: "Training Fee (OMR)", paymenthide: true },
    { royalpay: "royaltytrainfee", searchfltr: "row-eighth", label: "Royalty Fee (OMR)", paymenthide: true },
    { royalpay: "action", searchfltr: "row-refresh", label: "invoice.action", paymenthide: true },
  ];
  // displayed column
  royaltytrainfeeListDatafun(): string[] {
    return this.royaltytrainfeeListData.filter(paylist => paylist.paymenthide).map(paylist => paylist.royalpay);
  }
  // displayed search
  royaltytrainfeeListDatasear(): string[] {
    return this.royaltytrainfeeListData.filter(paylist => paylist.paymenthide).map(paylist => paylist.searchfltr);
  }
  getRoyalitySevice(){
    this.service.viewInvoice(atob(this.royaltyFeePaymentId)).subscribe((data:any) => {
      this.royalFreePaymentDetails = data.data.data
    })
  }
  // Learner details
  getlearnerDetails(limit:any,index:any,searchkey:any){
      this.tableplaceloader = true;
    this.service.lernerDetailsView(atob(this.royaltyFeePaymentId),limit, index, searchkey).subscribe((data:any) => {
      this.royalpageloader = false;
      this.tableplaceloader = false;
      let response = data.data?.data;
      this.resultsLength = data.data.totalcount;
      
      this.royaltytrainfeeData.data = response
      if(response.length!=0){
        this.isData = true
      }else{
        this.isData = false
      }
    })
  }

  searchbatchgrid(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getlearnerDetails(this.page,this.paginator.pageIndex,this.filterdata)
  }

  preparedata(data, isReset: boolean = false) {
    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTERDATA;
    }
    else {
      filterdata = this.filterdata;
    }

    Object.keys(filterdata).forEach(keys => {
      if (isReset) {
        filterdata[keys] = "";
      } else if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searckkey'];
      }
    });

    return filterdata;
  }
  
  ngOnInit(): void {
    this.royalpageloader = true;
    this.activatedRoute.queryParamMap.subscribe((data:any) => {
      this.royaltyFeePaymentId = data.get("roy_pk")
    })
    this.getRoyalitySevice();
    this.getlearnerDetails(this.page,0,"");
    
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
  }
  // column edit function
  selecttablelable(event: any) {
    this.selectpayChkbox = event.checked;
    this.royaltytrainfeeListData.forEach(item => {
      item.paymenthide = this.selectpayChkbox;
    });
  }
  // column edit function
  updateSelectAll(item: any) {
    const CheckedAll = this.royaltytrainfeeListData.every(item => item.paymenthide);
    if (CheckedAll) {
      this.allpayChkBox.checked = true;
    } else {
      this.allpayChkBox.checked = false;
    }
  }
  ngAfterViewInit() {
    this.royaltytrainfeeData.sort = this.sort;
    // this.royaltytrainfeeData.paginator = this.paginator;
  }
  // search filter form control
  batch_number = new FormControl('');
  civil_number = new FormControl('');
  learner_name = new FormControl('');
  status = new FormControl('');
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
    console.log(event);
    this.paginator.length = event.length;
    this.page = event.pageSize;

    this.getlearnerDetails(this.page,event.pageIndex,this.filterdata)
  }
  // filter clear
  clearFilter() {
    this.batch_number.reset()
    this.civil_number.reset()
    this.learner_name.reset()
    this.status.reset()
    this.vehicle_owner.reset()
    this.email_number.reset()
    this.mobil_num.reset()
    this.getlearnerDetails(this.page, 0, this.preparedata([], true));
    }
    statusForPayment(event:any){
      console.log("Event", event); 
    }

  mltiSelectBranch(event: any, formcontrolname: any) {
    var data = {
      searckkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getlearnerDetails(this.page,event.pageIndex,this.filterdata)
  }

  download(id:any){
    this.service.downloadList(id).subscribe((data:any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    })
  }
  
  submitPayment(event:boolean){
    if(event){
      this.ngOnInit();
    }
  }
  goBack() {
    this._location.back(); 
  }
}
