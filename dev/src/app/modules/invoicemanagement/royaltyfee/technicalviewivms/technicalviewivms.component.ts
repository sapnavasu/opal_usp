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
import { MatSort, Sort } from '@angular/material/sort';
import { ActivatedRoute, Router } from '@angular/router';
import { MatCheckbox } from '@angular/material/checkbox';
import { RoyaltytechService } from '@app/services/royaltytech.service';
import { Location } from '@angular/common';

export interface vehiclesData {
  chassisnumber: any;
  vehiclenumber: any;
  modelno: any;
  ownername: any;
  vehistatus: any;
  ownername_en: any;
  ownername_ar: any;
  status: any;
  royaltypaid: any;
}

const FILTERDATA = {
  chassisnumber: [],
  vehiclenumber: [],
  modelno: [],
  ownername: [],
  vehistatus: [],
  ownername_en: [],
  ownername_ar: [],
  status: [],
  royaltypaid: [],
}
// const VehiclesList_Data: vehiclesData[] = [
//   { chassisnumber: 'INV-999-CRI-2022-32' , vehiclenumber: '45788 AM' , ownername: 'Ahmed Bin Al Rahman Ibrahim' , feepaid: '130.000' , royaltypaid: '50.000'},
// ];
@Component({
  selector: 'app-technicalviewivms',
  templateUrl: './technicalviewivms.component.html',
  styleUrls: ['./technicalviewivms.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class TechnicalviewivmsComponent implements OnInit {
  filterDataPage: any = { sort: 'asc', order: '' };
  public loaderfortable: boolean = false;
  public approved: boolean = false;
  public fullpageloader: boolean = false;
  public gold: boolean = false;
  public resultsLength: number;

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
  public selectlistChkbox: boolean = true;
  @ViewChild('alllistChkBox') alllistChkBox: MatCheckbox;
  royaltyTechId: any;
  royaltyTech: any;
  isData: boolean = false;

  filterdata: {
    chassisnumber: [],
    vehiclenumber: [],
    modelno: [],
    ownername: [],
    vehistatus: [],
    ownername_en: [],
    ownername_ar: [],
    status: [],
    royaltypaid: [],
  }

  // table
  // VehicleListData = ['chassisnumber' , 'vehiclenumber' , 'ownername' , 'feepaid' , 'royaltypaid'];
  VehicleListData = [
    { vehiclelist: "chassisnumber", searchfltr: "row-first", label: "invoice.chasnumb", vehiclehide: true },
    { vehiclelist: "vehiclenumber", searchfltr: "row-second", label: "invoice.vehinumb", vehiclehide: true },
    { vehiclelist: "modelno", searchfltr: "row-model", label: "Model No.", vehiclehide: true },
    { vehiclelist: "ownername", searchfltr: "row-third", label: "invoice.ownenmae", vehiclehide: true },
    { vehiclelist: "status", searchfltr: "row-fourth", label: "invoice.vehistatus", vehiclehide: true },
    { vehiclelist: "royaltypaid", searchfltr: "row-fifth", label: "invoice.royalpaid", vehiclehide: true },
    { vehiclelist: "action", searchfltr: "row-refresh", label: "invoice.action", vehiclehide: true }
  ];
  // displayed column
  VehicleListDatafun(): string[] {
    return this.VehicleListData.filter(vehicleslist => vehicleslist.vehiclehide).map(vehicleslist => vehicleslist.vehiclelist);
  }
  // displayed search
  VehicleListDatasear(): string[] {
    return this.VehicleListData.filter(vehicleslist => vehicleslist.vehiclehide).map(vehicleslist => vehicleslist.searchfltr);
  }
  vehicleData = new MatTableDataSource<vehiclesData>();
  constructor(private translate: TranslateService, private service: RoyaltytechService,
    private remoteService: RemoteService, public toastr: ToastrService, private activeRoute: ActivatedRoute,
    private cookieService: CookieService,private _location:Location) { }

  i18n(key) {
    return this.translate.instant(key);
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  ngOnInit(): void {
    this.fullpageloader=true;
    this.activeRoute.queryParamMap.subscribe((data: any) => {
      this.royaltyTechId = data.get("roy_pk");
    })
    this.viewRoyalTech();
    this.getRoyalVehical(this.page, 0, "");

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
        this.ifarabic = false;
      } else {
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
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          this.ifarabic = false;
        } else {
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
  ngAfterViewInit() {
    this.vehicleData.sort = this.sort;
    // this.vehicleData.paginator = this.paginator;
  }
  // column edit function
  selecttablelable(event: any) {
    this.selectlistChkbox = event.checked;
    this.VehicleListData.forEach(item => {
      item.vehiclehide = this.selectlistChkbox;
    });
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // column edit function
  updateSelectAll(item: any) {
    const CheckedAll = this.VehicleListData.every(item => item.vehiclehide);
    if (CheckedAll) {
      this.alllistChkBox.checked = true;
    } else {
      this.alllistChkBox.checked = false;
    }
    setTimeout(() => {
      $(".clear").trigger("click");
     }, 
     500);
  }
  // clear filter function
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
    this.paginator.length = this.resultsLength;
    this.getRoyalVehical(this.page, event.pageIndex, this.filterdata)
  }

  preparedata(data,isReset:boolean=false) {
    let filterdata;
    if (!this.filterdata) {
      filterdata = FILTERDATA;
    }
    else {
      filterdata = this.filterdata;
    }

    Object.keys(filterdata).forEach(keys => {
      if(isReset){
        filterdata[keys] = "";
      }else if (keys == data['formcontrolname']) {
        filterdata[keys] = data['searckkey'];
      }
    });

    return filterdata;
  }

  //tab 1
  chassisnumber = new FormControl('');
  vehiclenumber = new FormControl('');
  modelno = new FormControl('');
  ownername = new FormControl('');
  vehistatus = new FormControl('');

  // filter clear
  clearFilter() {
    this.chassisnumber.reset()
    this.vehiclenumber.reset()
    this.modelno.reset()
    this.ownername.reset()
    this.vehistatus.reset()
    this.getRoyalVehical(this.page, 0, this.preparedata([],true));
    $(".clear").trigger("click");
    
  }

  // View Royal Tech
  viewRoyalTech() {
    this.service.viewRoyaltyTechIvms(atob(this.royaltyTechId)).subscribe((data: any) => {
      this.fullpageloader= false;
      this.royaltyTech = data.data.data
    })
  }


  // Vehicle details
  getRoyalVehical(limit: any, index: any, searchkey: any) {
    this.loaderfortable = true;
    this.service.ivmsvehicleDetails(atob(this.royaltyTechId), limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
      this.loaderfortable = false;
      let response = data.data?.data;
      this.resultsLength = data.data.totalcount;
      this.vehicleData.data = response
      if (response.length == 0) {
        console.log("response T", this.resultsLength);
        this.isData = true
      } else {
        console.log("response F", this.resultsLength);
        this.isData = false
      }
    })
  }

  // Search vichle details
  searchbatchgrid(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getRoyalVehical(this.page, this.paginator.pageIndex, this.filterdata)
  }
   // Office type search
   mltiSelectBranch(event: any, formcontrolname: any) {
    var data = {
      searckkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getRoyalVehical(this.page, this.paginator.pageIndex, this.filterdata)

  }

  download(id:any){
    this.service.downloadIvms(id).subscribe((data:any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    })
  }

  announceSortChange(sortState: Sort) {
    this.filterDataPage = {
      sortFiled: sortState.direction,
      order: sortState.active
    }
    this.getRoyalVehical(this.page, this.paginator.pageIndex, this.filterdata)
  }

  submitPayment(event:boolean){
    if(event){
      this.ngOnInit();
    }
  }
  goBack(event) {
    this._location.back(); 
    localStorage.setItem('matTab', event);
  }
}
