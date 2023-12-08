import { HttpClient } from "@angular/common/http";
import { ChangeDetectorRef, Component, ElementRef, HostListener, Input, OnInit, Renderer2, ViewChild, ViewEncapsulation } from "@angular/core";
import { FormArray, FormBuilder, FormControl, FormGroup } from "@angular/forms";
import { MatPaginator, PageEvent } from "@angular/material/paginator";
import { MatDrawer } from "@angular/material/sidenav";
import { MatSort } from "@angular/material/sort";
import { MatTableDataSource } from "@angular/material/table";
import { Router } from "@angular/router";
import { Encrypt } from "@app/common/class/encrypt";
import { AppLocalStorageServices } from "@app/common/localstorage/applocalstorage.services";
import { merge } from "rxjs/observable/merge";
import { map } from "rxjs/operators/map";
import { startWith } from "rxjs/operators/startWith";
import { switchMap } from "rxjs/operators/switchMap";
import swal from "sweetalert";
import { environment } from "../../../../environments/environment";
import { SlideInOutAnimation } from "../animation";
import { EnterpriseService } from "../enterprise.service";
import { InviteuserComponent } from "../inviteuser/inviteuser.component";
import { UsereachcountsComponent } from '../usereachcounts/usereachcounts.component';
import {ToastrService} from 'ngx-toastr';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: "app-inviteusermanagement",
  templateUrl: "./inviteusermanagement.component.html",
  styleUrls: ["./inviteusermanagement.component.scss"],
  encapsulation: ViewEncapsulation.Emulated,
  animations: [SlideInOutAnimation],
})
export class InviteusermanagementComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  warnUserBeforeLeavingPage = true;
  @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
    if (this.warnUserBeforeLeavingPage) {
      event.returnValue = false;
    }
  }
  public text:boolean=false;
  public resultsLength: any = 0;
  public perpage: any = 10;
  public showSearchIcon: boolean = true;
  public search: any = "";
  @Input() tog: any = "";
  @ViewChild(MatPaginator) paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild("inviteuser") inviteuser: MatDrawer;
  disableResendBtn: boolean = false;
  showResponsiveLoader: boolean = false;
  public userinfo: any = [];
  public noDataAvailable: string = this.i18n('enterpriseadmin.thernoth')
  exampleDatabase: ExampleHttpDao | null;
  onsortpk: number = 1;
  animationState = "out";
  animationState1 = "out";
  dataSource = new MatTableDataSource();
  filtercount: number = 0;
  filtercountVal: number = 0;
  statusType: any = [];
  public recentSearch: any = [];
  @ViewChild("inputClickbus") inputClickbus: ElementRef;
  @ViewChild('refUserCount') refUserCount:UsereachcountsComponent;
  searchform: FormGroup;
  public stkholdertype: any;
  public redirectToggle:any = '';
  inviteuserloader:boolean = false;
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    public toastr: ToastrService,
    private fb: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,
    private _detector: ChangeDetectorRef,
    private http: HttpClient,
    private localstorage: AppLocalStorageServices,
    protected router: Router,
    private renderer?: Renderer2,
    
    
  ) {
    this.stkholdertype = this.localstorage.getInLocal('reg_type');
    this.renderer.listen("window", "click", (e: Event) => {
      if (e.target == this.inputClickbus.nativeElement) {
        this.animationState1 = "in";
        this.animationState = "out";
      } else {
        this.animationState1 = "out";
      }
    });
  }
  
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr" 

  isExtendedRow = (index, item) => item.extend;
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
  });
    this.dataSource.paginator = this.paginator;

    this.searchform = this.fb.group({
      searchname: new FormControl(""),
      Status: this.fb.array([]),
    });

    this.searchform.controls["searchname"].valueChanges
      .debounceTime(400)
      .subscribe((data) => {
        if (data != null) {
        this.search=data;
        } 
      });

    this.fetchRecentSearchData();
    this.fetchData();

    this.redirectToggle = window.history.state.redirectToggle;
    if(this.redirectToggle == 'yes'){
      setTimeout(() => {
        this.inviteuser.toggle();
        this.openSidenav()
      }, 1500);
    }else{
      this.redirectToggle  = '';
    }
  }

  dashboardRedirect(){
    if(this.stkholdertype == 1){
      this.router.navigate(['dashboard/portaladmin']);
    }else if(this.stkholdertype == 6){
      this.router.navigate(['dashboard/supplier']);
    }else if(this.stkholdertype == 7){
      this.router.navigate(['dashboard/operator']);
    }
  }

  fetchRecentSearchData() {
    this.EnterpriseService.getRecentSearch("Enterprise Admin", 4).subscribe(
      (data) => {
        if (data.data.flag == "S") {
          this.recentSearch = data.data.returndata;
        }
      }
    );
  }

  ngOnDestroy() {
    if (this.dataSource) {
      this.dataSource.disconnect();
    }
  }
  addRecentData(searchText) {
    this.EnterpriseService.addRecentSearch(
      "Enterprise Admin",
      4,
      searchText
    ).subscribe((data) => {
      if (data.data.flag == "S") {
      }
    });
  }
  recentDataSet(searchTxt) {
    this.searchform.controls["searchname"].setValue(searchTxt);
  }
 
  fetchData() {
    this._detector.detectChanges();
    this.exampleDatabase = new ExampleHttpDao(this.http);
    let searchTxt = this.searchform.controls["searchname"].value;
    this.filtercount = this.filtercountVal;
    this.animationState1 = 'out';
  
    if (searchTxt) {
      this.showResponsiveLoader=false;
      this.inviteuserloader=true;
    } else {
      searchTxt = "";
    }
    this.showResponsiveLoader=true;
    let accessModulePk = this.encrypt.encrypt("7");
    merge(this.paginator.page)
      .pipe(
        startWith({}),
        switchMap(() => {
          return this.exampleDatabase!.eventdatas(
            this.paginator.pageIndex,
            this.perpage,
            searchTxt,
            this.onsortpk,
            accessModulePk,
            this.statusType
          );
        }),
        map((data) => {
          this.resultsLength = data["data"].totalcount;
          this.userinfo = data["data"].data;
          this.fetchRecentSearchData();
      
          this.showResponsiveLoader=false;
          this.inviteuserloader=false;
          return data["data"].data;
        })
      )
      .subscribe((data) => {});
  }
  searchdata(){
      let searchTxt = this.searchform.controls["searchname"].value;
    if (searchTxt.length != null && searchTxt.length >= 3) {
      this.addRecentData(searchTxt);
      this.inviteuserloader=true;
      this.showResponsiveLoader=false;
      
      this._detector.detectChanges();
      this.exampleDatabase = new ExampleHttpDao(this.http);
      this.filtercount = this.filtercountVal;
      this.animationState1 = 'out';
    
      if (searchTxt) {
      } else {
        searchTxt = "";
      }
      let accessModulePk = this.encrypt.encrypt("7");
      merge(this.paginator.page)
        .pipe(
          startWith({}),
          switchMap(() => {
            return this.exampleDatabase!.eventdatas(
              this.paginator.pageIndex,
              this.perpage,
              searchTxt,
              this.onsortpk,
              accessModulePk,
              this.statusType
            );
          }),
          map((data) => {
            this.resultsLength = data["data"].totalcount;
            this.userinfo = data["data"].data;
            this.fetchRecentSearchData();
            this.inviteuserloader=false;
            return data["data"].data;
          })
        )
        .subscribe((data) => {});
    }
    if (searchTxt.length != null && searchTxt.length == 0) {
      this.addRecentData(searchTxt);
      this.inviteuserloader=true;
      this.showResponsiveLoader=false;
      this._detector.detectChanges();
      this.exampleDatabase = new ExampleHttpDao(this.http);
      this.filtercount = this.filtercountVal;
      this.animationState1 = 'out';
    
      if (searchTxt) {
      } else {
        searchTxt = "";
      }
      let accessModulePk = this.encrypt.encrypt("7");
      merge(this.paginator.page)
        .pipe(
          startWith({}),
          switchMap(() => {
            return this.exampleDatabase!.eventdatas(
              this.paginator.pageIndex,
              this.perpage,
              searchTxt,
              this.onsortpk,
              accessModulePk,
              this.statusType
            );
          }),
          map((data) => {
            this.resultsLength = data["data"].totalcount;
            this.userinfo = data["data"].data;
            this.fetchRecentSearchData();
            this.inviteuserloader=false;
            return data["data"].data;
          })
        )
        .subscribe((data) => {});
    }
  }
  onSort(event) {
    this.onsortpk = event;
    this.fetchData();
  }
  onPaginateChange(event) {
    this.perpage = event.pageSize;
    this.fetchData();
  }

  clearData() {
    this.searchform.controls["searchname"].setValue(null);
    this.filtercount = 0;
    this.filtercountVal = 0;
    this.fetchData();
    this.inviteuserloader=true;
  }
  filterRadioSelected(event, data) {
    this.statusType = data;
    this.filtercountVal = 1;
    this.filtercount = 1;
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }
  filterReset() {
    this.filtercount = 0;
    this.filtercountVal = 0;
    let  filterStatVal = <FormArray>this.searchform.get('Status') as FormArray;
    let initialFilterStatusCount = filterStatVal.length;
    for (let i = (initialFilterStatusCount - 1); i >= 0; i--){
      this.clearFilter(i);
    }
    this.fetchData();
  }

  clearFilter(index){
    let  filterStatVal = <FormArray>this.searchform.get('Status') as FormArray;
    filterStatVal.removeAt(index);

    this.statusType = filterStatVal.value;
    this.filtercountVal = filterStatVal.length;
    this.filtercount = filterStatVal.length;
  }

  toggle() {
    this.tog.toggle();
  }
  openSidenav() {
    this.animationState = "out";
    this.animationState1 = "out";
  }
  clearForm() {
    this.filtercount = 0;
    this.animationState = "out";
    this.animationState1 = "out";
    this.searchform.reset();
 
  }
  applyButton() {
    if (this.filtercountVal !== 0) {
      this.animationState = "out";
    }
  }
  toggleShowDiv(divName: string) {
    if (divName === "descriptioncontentfilter") {
      this.animationState = this.animationState === "out" ? "in" : "out";
      this.animationState1 = "out";
    }
    if (divName === "searchhistorydropdown") {
      this.animationState1 = this.animationState1 === "out" ? "in" : "out";
      this.animationState = "out";
    }
  }

  resendMail(pk: number, status: string) {
    this.disableResendBtn = this.showResponsiveLoader = true;
    this.EnterpriseService.resendInviteMail(this.encrypt.encrypt(pk)).subscribe(
      (data) => {
        let msg = data["data"].status == 2 ? data["data"].msg : data["data"].status == 1 ? this.i18n('enterpriseadmin.mailresesucc') : this.i18n('enterpriseadmin.somewentwron');
        let icon = data["data"].status == 2 ? "warning" : data["data"].status == 1 ? "success" : "warning";
        if(icon == "warning"){
          this.showWSuccess(msg);
        }else{
          this.showTSuccess(msg);
        }
        // swal({
        //   title:
        //     data["data"].status == 2
        //       ? data["data"].msg
        //       : data["data"].status == 1
        //       ? "Mail Resent Successfully"
        //       : "Something went wrong",
        //   icon:
        //     data["data"].status == 2
        //       ? "warning"
        //       : data["data"].status == 1
        //       ? "success"
        //       : "warning",
        //   closeOnClickOutside: false,
        //   closeOnEsc: false,
        // });
        this.disableResendBtn = this.showResponsiveLoader = false;
        if (data["data"].status == 1) this.fetchData();
      }
    );
  }

  deleteInvite(userpk: any) {
    swal({
      title: this.i18n('enterpriseadmin.doyouwant'),
      icon: "warning",
      buttons: [this.i18n('enterpriseadmin.nomodal'), this.i18n('enterpriseadmin.yesmodal')],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false,
    }).then((willDelete) => {
      if (willDelete) {
        this.showResponsiveLoader=true;
        this.EnterpriseService.deleteInvite(userpk).subscribe((data) => {
          this.showTSuccess(data["data"].msg)
          this.showResponsiveLoader=false;
            this.filterReset();
            this.fetchData();
          // swal({
          //   title: data["data"].msg,
          //   icon: data["data"].status == 1 ? "success" : "warning",
          //   closeOnClickOutside: false,
          // }).then(() => {
            
          // });
        });
      }
    });
  }
  showSuccess(data){
    this.toastr.success(data, this.i18n('enterpriseadmin.succ'),{
        timeOut: 3000,        
    });
  }  
  showTSuccess(data){
    this.toastr.success(data, this.i18n('enterpriseadmin.succ'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showWSuccess(data){
    this.toastr.warning(data, this.i18n('enterpriseadmin.warn'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  closeAddSlider(event) {
    this.refUserCount.enterpriseCount();
    this.fetchData();
  }

  filterStatusChange(event){
    const filterStatusVal = <FormArray>this.searchform.get('Status') as FormArray;

    if(event.checked) {
      filterStatusVal.push(new FormControl(event.source.value))
    } else {
      const i = filterStatusVal.controls.findIndex(x => x.value === event.source.value);
      filterStatusVal.removeAt(i);
    }
    this.statusType = filterStatusVal.value;
    this.filtercountVal = filterStatusVal.length;
    this.filtercount = filterStatusVal.length;
  }
}
export class ExampleHttpDao {
  constructor(private http: HttpClient) {}
  eventdatas(
    page: number,
    size: number,
    searchValue: any,
    sort: any,
    accessModulePk: any,
    statusType: any
  ) {
    const href = environment.baseUrl + "ea/user/list-invited-user";
    const requestUrl = `${href}?page=${
      page + 1
    }&size=${size}&sort=${sort}&searchTxt=${searchValue}&statusType=${statusType}`;
    return this.http.get(requestUrl, {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("v3logindata"),
      },
    });
  }
}
