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
import { MatCheckbox } from '@angular/material/checkbox';
import { AssessmentFeeService } from '@app/services/assessmentFee.service';
import { ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';
export interface assessmentFee {
  BatchNumber: any;
  civilnum: any;
  LearnerName: any;
  status: any;
  LearnerEmail: any;
  LearnerNumber: any;
  trainingFee: any;
  assessmentfee: any;
}

const FILTERDATA = {
  BatchNumber: [],
  civilnum: [],
  LearnerName: [],
  status: [],
  LearnerEmail: [],
  LearnerNumber: [],
  traingfee: [],
  assessmentfee: []
}
@Component({
  selector: 'app-asseeementfee',
  templateUrl: './asseeementfee.component.html',
  styleUrls: ['./asseeementfee.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class AsseeementfeeComponent implements OnInit {
  filterDataPage: any = { sort: 'asc', order: '' };
  public pending: boolean = false;
  public reci: boolean = false;
  public bronze: boolean = false;
  public gold: boolean = false;
  public resultsLength: number;
  public pagefullloader: boolean = false;
  assmentFeeId: any;
  assmentFeePaymentDetails: any;
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
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  @ViewChild('columnchkbox') columnchkbox: MatCheckbox;
  selectAllVisible = true;
  isData: boolean = false;
  filterdata: {
    BatchNumber: [],
    civilnum: [],
    LearnerName: [],
    status: [],
    LearnerEmail: [],
    LearnerNumber: [],
    traingfee: [],
    assessmentfee: []
  }
  constructor(private translate: TranslateService,
    private service: AssessmentFeeService,
    private remoteService: RemoteService, public toastr: ToastrService,
    private activeRoute: ActivatedRoute,private _location:Location,
    private cookieService: CookieService,) { }

  i18n(key) {
    return this.translate.instant(key);
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  //  table column
  // assessmentfeeListData = ['batchnum' , 'civilnum' , 'learnername' , 'emailid' , 'mobilnum', 'traingfee' , 'assessmentfee'];
  assessmentfeeData = new MatTableDataSource<assessmentFee>();
  assessmentfeeListData = [
    { def: "batchnum", search: "row-first", label: "Batch Number", visible: true },
    { def: "civilnum", search: "row-second", label: "Civil Number", visible: true },
    { def: "learnername", search: "row-third", label: "Learner Name", visible: true },
    { def: "status", search: "row-fourth", label: "Status", visible: true },
    { def: "emailid", search: "row-fifth", label: "Email ID", visible: true },
    { def: "mobilnum", search: "row-sixth", label: "Mobile Number", visible: true },
    { def: "traingfee", search: "row-seventh", label: "Training Fee (OMR)", visible: true },
    { def: "assessmentfee", search: "row-eight", label: "Assessment Fee (OMR)", visible: true },
    { def: "action", search: "row-refresh", label: "invoice.action", visible: true },
  ];
  getDisplayedColumns(): string[] {
    return this.assessmentfeeListData.filter(cd => cd.visible).map(cd => cd.def);
  }
  getDisplayedColumn(): string[] {
    return this.assessmentfeeListData.filter(cd => cd.visible).map(cd => cd.search);
  }

  getAssementFee() {
    this.service.viewAssessmentFee(atob(this.assmentFeeId)).subscribe((data: any) => {
      this.assmentFeePaymentDetails = data.data.data
    })
  }

  // Learner Details List searching start
  getData(assmentFeeId: any, limit: any, index: any, searchkey: any) {
    this.tableplaceloader = true;
    this.service.learnerListview(atob(assmentFeeId), limit, index, searchkey, this.filterDataPage).subscribe((data: any) => {
    this.tableplaceloader = false;

      this.pagefullloader = false;
      let response = data.data.data;
      this.resultsLength = data.data.totalcount;
      console.log("responseresponse ", response);

      this.assessmentfeeData.data = response;

      if (response.length == 0) {
        this.isData = true;
      } else {
        this.isData = false;
      }
    });
  }

  searchbatchgrid(searckkey, formcontrolname) {
    var data = {
      searckkey: searckkey,
      formcontrolname: formcontrolname
    };
    console.log(data);
    this.filterdata = this.preparedata(data);
    this.getData(this.assmentFeeId, this.page, this.paginator.pageIndex, this.filterdata)
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

  // Learner Details List searching End
  ngOnInit(): void {
    this.pagefullloader = true;
    this.activeRoute.queryParamMap.subscribe((data: any) => {
      this.assmentFeeId = data.get("asmnt_pk");
    })
    this.getData(this.assmentFeeId, this.page, 0, "");

    this.getAssementFee();
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
    this.editchkbox.checked = true;
  }

  selectAllFun(event: any) {
    this.selectAllVisible = event.checked;
    this.assessmentfeeListData.forEach(item => {
      item.visible = this.selectAllVisible;
    });
  }
  updateSelectAllVisible(item: any) {
    const allChecked = this.assessmentfeeListData.every(item => item.visible);
    if (allChecked) {
      this.editchkbox.checked = true;
    } else {
      this.editchkbox.checked = false;
    }
  }
  ngAfterViewInit() {
    this.assessmentfeeData.sort = this.sort;
    // this.assessmentfeeData.paginator = this.paginator;
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
    this.paginator.length = event.length;
    this.page = event.pageSize;

    this.getData(this.assmentFeeId, this.page, event.pageIndex, this.filterdata);

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
    this.getData(this.assmentFeeId, this.page, 0, this.preparedata([], true));
  }

  mltiSelectBranch(event: any, formcontrolname: any) {
    var data = {
      searckkey: event.value,
      formcontrolname: formcontrolname
    };
    this.filterdata = this.preparedata(data);
    this.getData(this.assmentFeeId, this.page, event.pageIndex, this.filterdata);
  }

  
  // For sorting
  announceSortChange(sortState: Sort) {
    this.filterDataPage = {
      sortFiled: sortState.direction,
      order: sortState.active
    }
    this.getData(this.assmentFeeId, this.page, this.filterdata, this.paginator.pageIndex);

  }
// Export
  export(id:any){
    this.service.downloadList(id).subscribe((data:any) => {
      let response = data.data.attend;
      var link = document.createElement('a');
      link.href = response
      link.click();
    })
  }

//View after confirm payment 
  submitPayment(event:boolean){
    if(event){
      this.ngOnInit();
    }
  }
  goBack() {
    this._location.back(); 
  }
}
