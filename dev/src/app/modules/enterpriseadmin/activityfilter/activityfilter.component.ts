import { ChangeDetectorRef, Component, ElementRef, EventEmitter, Input, OnInit, Output, Renderer2, ViewChild } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { ErrorStateMatcher } from '@angular/material/core';
import { Encrypt } from '@app/common/class/encrypt';
import { atLeastOne } from '@app/common/directives/atleastone';
import { CountryList } from '@app/common/interfaces/supplier';
import { ReplaySubject, Subject } from 'rxjs';
import 'rxjs/add/observable/of';
import { takeUntil } from 'rxjs/operators/takeUntil';
import { SlideInOutAnimation } from '../animation';
import { EnterpriseService } from '../enterprise.service';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';



@Component({
  selector: 'app-activityfilter',
  templateUrl: './activityfilter.component.html',
  styleUrls: ['./activityfilter.component.scss'],
  animations: [SlideInOutAnimation]
})
export class ActivityfilterComponent implements OnInit {
 i18n(key){
    return this.translate.instant(key);
  }
  selecteddata;
  statusdata = [
    {'id': 'A', 'label': 'Active'},
    {'id': 'I', 'label': 'Inactive'},
    {'id': 'Y', 'label': 'Yet to Approve'},
    {'id': 'E', 'label': 'Email Confirmation Pending'},
    {'id': 'YR', 'label': 'Yet to Register'},   
  ];
  public toppingListsec;
  animationState = 'out';
  animationState1 = 'out';
  filterform: FormGroup;
  searchModule: string = '';
  searchSubmodule: string = '';
  searchDivision: string = '';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  searchDepartment: string = '';

  @Input() filterFor: string;
  @Input() recentSearchType: any;
  @Input() filterType: number; /* 1 - UserActivty 2 - Enterprise Admin User */
  @Output() userFilterData: any = new EventEmitter<any>();
  @Output() moitorFilterData: any = new EventEmitter<any>();
  @Output() emitFilterData: any = new EventEmitter<any>();
  @Output() hideResponseLoader: any = new EventEmitter<any>();
  @Input() sortBy: string;
  public userSortBy: number = 1;
  public postParams: any;
  public postUrl: any;
  public departmentData: any;
  public oninitdepartmentdata: any;
  public departmentDataTemp: any = '';
  public moduleData: any;
  public moduleDataTemp: any = '';
  public submoduleData: any;
  public submoduleDataTemp: any = '';
  public businessUnitDataTemp: any = '';
  public branchNameDataTemp: any = '';
  public filterValue: any = 0;
  public search: any = '';
  public showSearchIcon: boolean = true;
  public showkeywordicon: boolean = true;
  public mainSubmodule: any = '';
  public filterCombination: any = [];
  public branchFilter: FormControl = new FormControl();
  public perpage = 9;
  public pageNo = 0;
  @Output('showLoaderview') showLoaderview: any = new EventEmitter<any>();
  public recentSearch: any = [];
  Department = new FormControl('');
  Module = new FormControl('');
  Submodule = new FormControl('');
  filtercount: number = 0;
  statusType: any = [];
  statusCount: number = 0;
  businessunitlist: any;
  oninitbusinessunitlist: any;
  viewcount: boolean = false;
  branchnamelist: any;
  showInvitedUser: boolean = false;
  checkedFilterArr: any = []
  filteredCountry: ReplaySubject<CountryList[]> = new ReplaySubject<CountryList[]>(1);
  private _onDestroy = new Subject<void>();
  @ViewChild("inputClickuser") inputClickuser: ElementRef;
  invitedFilterCheckBoxArr = [
    {
      value: '1',
      viewValue: 'Invited'
    },
    {
      value: '2',
      viewValue: 'Accepted'
    },
    {
      value: '0',
      viewValue: 'Expired'
    }
  ]

  constructor(
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,
    private cdr: ChangeDetectorRef,
    private renderer?: Renderer2,
    
    
  ) {
    this.renderer.listen("window", "click", (e: Event) => {
      if (e.target == this.inputClickuser.nativeElement) {
        this.animationState1 = "in";
        this.animationState = "out";
      }
      else {
        this.animationState1 = "out";
      }
    });
  }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr" 

  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.statusdata[0].label= 'Active';
        this.statusdata[1].label= 'Inactive';
        this.statusdata[2].label= 'Yet to Approve';
        this.statusdata[3].label= 'Email Confirmation Pending';
        this.statusdata[4].label= 'Yet to Register';
      }else {
        this.statusdata[0].label= 'نشط';
        this.statusdata[1].label= 'غير نشط';
        this.statusdata[2].label= 'لم يتم الموافقة بعد',
        this.statusdata[3].label= 'في انتظار تأكيد البريد الإلكتروني';
        this.statusdata[4].label= 'لم يتم التسجيل بعد';
      }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.statusdata[0].label= 'Active';
      this.statusdata[1].label= 'Inactive';
      this.statusdata[2].label= 'Yet to Approve';
      this.statusdata[3].label= 'Email Confirmation Pending';
      this.statusdata[4].label= 'Yet to Register';
      
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.statusdata[0].label= 'Active';
          this.statusdata[1].label= 'Inactive';
          this.statusdata[2].label= 'Yet to Approve';
          this.statusdata[3].label= 'Email Confirmation Pending';
          this.statusdata[4].label= 'Yet to Register';
        }else {
          this.statusdata[0].label= 'نشط';
          this.statusdata[1].label= 'غير نشط';
          this.statusdata[2].label= 'لم يتم الموافقة بعد',
          this.statusdata[3].label= 'في انتظار تأكيد البريد الإلكتروني';
          this.statusdata[4].label= 'لم يتم التسجيل بعد';
        }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.statusdata[0].label= 'Active';
          this.statusdata[1].label= 'Inactive';
          this.statusdata[2].label= 'Yet to Approve';
          this.statusdata[3].label= 'Email Confirmation Pending';
          this.statusdata[4].label= 'Yet to Register';
      }
  });
    this.filterform = this.formBuilder.group({
      Department: new FormControl([]),
      Designation: new FormControl([]),
      Module: new FormControl([]),
      Submodule: new FormControl([]),
      businessUnit: new FormControl([]),
      branchName: new FormControl([]),
      status: new FormControl([]),
      //skycard: new FormControl([]),
      showInvitedUser: new FormControl(false),
      Invited: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });

    this.postParams = {};
    this.initialFilterDetails(this.postParams);
    this.getBusinessList();
    //this.getBranchNameList();

    this.filterform.controls['showInvitedUser'].valueChanges.subscribe(data => {
      this.filterform.controls['Invited'].reset();
    })

    this.filterform.valueChanges.subscribe(data => {
      let count = 0;
      for (let i in data) {
        let type = typeof (data[i]);
        if ((type == "string" && data[i]) || (type == "boolean" && data[i]) || (data[i] !== null && type == "object" && data[i].length > 0)) {
          count++;
        }
      }
      this.filtercount = count;
    })

    this.filterform.controls['businessUnit'].valueChanges.subscribe(value => {
      if (value) {
        if (value.length == 0) {
          this.hideResponseLoader.emit(true);
          this.filterform.controls['Department'].reset();
          this.departmentData = this.oninitdepartmentdata;
          this.filtereddepartmentdata.next(this.departmentData.slice());
          this.hideResponseLoader.emit(false);
        } else {
          let index = this.businessunitlist.findIndex(x => x.SectorMst_Pk == value[0]);
          if (index !== -1) {
            this.businessUnitDataTemp = this.businessunitlist[index].SecM_SectorName;
          }
          this.postParams = {
            'bUnitPk': value
          };
          this.postUrl = 'ea/department/fetch-department-by-bunit';
          this.hideResponseLoader.emit(true);
          this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
            function (data) {
              if (data['data'].status == 100) {
                this.filterform.controls['Department'].reset();
                this.departmentData = data['data'].data.bunitDeptData;
                this.filtereddepartmentdata.next(this.departmentData.slice());
                this.hideResponseLoader.emit(false);
              } else {
                this.hideResponseLoader.emit(false);
              }
            }.bind(this)
          );
        }
      } else {
        this.businessUnitDataTemp = '';
      }
    });
    this.sectorFilter.valueChanges
      .subscribe(() => {
        this.filterSector();
      });
    this.departmentFilter.valueChanges
      .subscribe(() => {
        this.departmentFilters();
      });
    this.moduleFilter.valueChanges
      .subscribe(() => {
        this.moduleFilters();
      });
    this.filterform.controls['branchName'].valueChanges.subscribe(value => {
      if (value) {
        let index = this.branchnamelist.findIndex(x => x == value[0]);
        if (index !== -1) {
          this.branchNameDataTemp = this.branchnamelist[index];
        }
      } else {
        this.branchNameDataTemp = '';
      }
    })

    this.branchFilter.valueChanges
      .pipe(takeUntil(this._onDestroy))
      .subscribe(() => {
        this.filterCountry();
      });

    this.getRecentSearch();
  }

  getRecentSearch() {
    this.EnterpriseService.getRecentSearch('Enterprise Admin', this.recentSearchType).subscribe(data => {
      if (data.data.flag == 'S') {
        this.recentSearch = data.data.returndata;
      }
    });
  }

  addRecentData(searchText) {
    this.EnterpriseService.addRecentSearch('Enterprise Admin', this.recentSearchType, searchText).subscribe(data => {
      if (data.data.flag == 'S') {
        this.getRecentSearch();
      }
    });
  }
  recentDataSet(searchTxt) {
    this.search = searchTxt;
  }

  checkInvitedFilter(id: any) {
    if (this.checkedFilterArr.includes(id)) {
      let index = this.checkedFilterArr.indexOf(id);
      this.checkedFilterArr.splice(index, 1);
    } else {
      this.checkedFilterArr.push(id);
    }

    this.filtercount = (this.checkedFilterArr.length > 0) ? 1 : 0;
  }
  public filtereddepartmentdata: ReplaySubject<any> = new ReplaySubject<any>(1);
  public filteredmoduleData: ReplaySubject<any> = new ReplaySubject<any>(1);
  // public filteredsubmoduleData: ReplaySubject<any> = new ReplaySubject<any>(1);
  initialFilterDetails(postParams) {
    this.postUrl = 'ea/user/enterprise-filter-initial-data';
    this.EnterpriseService.enterpriseService(postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.oninitdepartmentdata = data['data'].data.departmentDetails;
          this.departmentData = data['data'].data.departmentDetails;
          this.filtereddepartmentdata.next(this.departmentData.slice());
          this.moduleData = data['data'].data.module;
          this.filteredmoduleData.next(this.moduleData.slice());
          this.submoduleData = data['data'].data.subModule;
          // this.filteredsubmoduleData.next(this.submoduleData.slice());
        }
      }.bind(this)
    );
  }
  public departmentFilter: FormControl = new FormControl();
  public moduleFilter: FormControl = new FormControl();
  // public submoduleFilter: FormControl = new FormControl();
  moduleFilters() {
    if (!this.moduleData) {
      return;
    }
    // get the search keyword
    let search = this.moduleFilter.value;
    if (!search) {
      this.filteredmoduleData.next(this.moduleData.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filteredmoduleData.next(
      this.moduleData.filter(modData => modData.moduleName.toLowerCase().indexOf(search) > -1)
    );
  }
  departmentFilters() {
    if (!this.departmentData) {
      return;
    }
    // get the search keyword
    let search = this.departmentFilter.value;
    if (!search) {
      this.filtereddepartmentdata.next(this.departmentData.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filtereddepartmentdata.next(
      this.departmentData.filter(deptData => deptData.deptName.toLowerCase().indexOf(search) > -1)
    );
  }
  fetchdivsions(event) {
    if (event.value.length == 0) {
      this.hideResponseLoader.emit(true);
      this.filterform.controls['businessUnit'].reset();
      this.businessunitlist = this.oninitbusinessunitlist;
      this.filteredSector.next(this.businessunitlist.slice());
      this.hideResponseLoader.emit(false);
    } else {
      this.hideResponseLoader.emit(true);
      this.postParams = {
        'department': event.value
      };
      this.postUrl = 'ea/user/filter-divisionbaseddept?uac=f9d6c6ad2e0f8bfded8c4c37e4140629&';
      this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
        function (data) {
          if (data['data'].status == 100) {
            this.filterform.controls['businessUnit'].reset();
            this.businessunitlist = data['data'].divsions;
            this.filteredSector.next(this.businessunitlist.slice());
            this.hideResponseLoader.emit(false);
          }
        }.bind(this)
      );
    }
  }
  fetchSubModule(event) {
    this.postParams = {
      'modulePk': event.value
    };
    this.postUrl = 'ea/user/filter-submodule?uac=f9d6c6ad2e0f8bfded8c4c37e4140629&';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
          this.submoduleData = data['data'].data.subModule;
          // this.filteredsubmoduleData.next(this.submoduleData.slice());
          this.mainSubmodule = data['data'].data.subModule;
        }
      }.bind(this)
    );
  }

  filterStatusChange(event) {
    const filterStatusVal = <FormArray>this.filterform.get('Status') as FormArray;

    if (event.checked) {
      filterStatusVal.push(new FormControl(event.source.value))
    } else {
      const i = filterStatusVal.controls.findIndex(x => x.value === event.source.value);
      filterStatusVal.removeAt(i);
    }
    this.statusType = filterStatusVal.value;
    // this.filtercount = filterStatusVal.length;
  }

  landingFilter(searchValue, searchType, isFilterClick = false) {

    if (searchType == 'status') {
      // const filterStatusVal = <FormArray>this.filterform.get('Status') as FormArray;
      // filterStatusVal.push(new FormControl(searchValue));
      // this.statusType = filterStatusVal.value;
      // this.filtercount = filterStatusVal.length;
      this.filterform.patchValue({
        status: searchValue.split(",")
      });
    } else if (searchType == 'department') {
      this.filterform.patchValue({
        Department: searchValue.split(",")
      });

      setTimeout(() => {
        this.departmentDataTemp = '';
        (this.departmentData).forEach((item, index) => {
          if (item.deptPk == searchValue) {
            this.departmentDataTemp = item.deptName;
          }
        });
      }, 2500);
    }

    this.advanceFilter('', this.userSortBy, this.perpage, 0, 'out',isFilterClick);
  }
  public sectorFilter: FormControl = new FormControl();
  public filteredSector: ReplaySubject<any> = new ReplaySubject<any>(1);
  searchdataactfilter(){
    if (this.search.length != null && this.search.length >= 3) {
      this.addRecentData(this.search);
      this.showLoaderview.emit(true);
      this.advanceFilter();
    }
    if (this.search.length != null && this.search.length == 0) {
      this.addRecentData(this.search);
      this.showLoaderview.emit(true);
      this.advanceFilter();
    }
  }
  advanceFilter(clear = '', sortBy = 1, pageSize = this.perpage, page = 0, fromFilter = 'in', isFilterClick = false) {
    this.userSortBy = sortBy;
    this.perpage = pageSize;
    this.pageNo = page;
    let keywordseacrhdata;
    if(!this.showkeywordicon){
      keywordseacrhdata = '';
    }else{
      keywordseacrhdata = this.search;
    }
    this.showLoaderview.emit(true);
    this.postParams = {
      'deptPks': this.filterform.controls['Department'].value,
      'modulePks': this.filterform.controls['Module'].value,
      'subModulePks': this.filterform.controls['Submodule'].value,
      'businessUnit': this.filterform.controls['businessUnit'].value,
      'branchName': this.filterform.controls['branchName'].value,
      'status': this.filterform.controls['status'].value,
      'keyWord': keywordseacrhdata,
      'filterType': this.filterType,
      'inviteToggle': this.showInvitedUser,
      'invited': this.checkedFilterArr,
      'sortby': this.userSortBy,
      'size': pageSize,
      'page': page
    };
  
    this.emitFilterData.emit(this.postParams);
    this.postUrl = 'ea/user/enterprise-filter';
    this.EnterpriseService.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data['data'].status == 100) {
  
          data['data']['resetPagination'] = false;
          if (this.filterType == 2) {
            if (isFilterClick) {
              data['data']['resetPagination'] = true;
            }
            this.userFilterData.emit(data['data']);
          }
          if (this.filterType == 1) {
            this.moitorFilterData.emit(data['data']);
          }
          if (clear == '') {
            this.animationState = 'out';
          }
          if (fromFilter == 'in') {
            if (this.filterType == 2) {
              this.filterValue = data['data'].totalcount;
            }
            if (this.filterType == 1) {
              let fromData = data['data'].data;
              this.filterValue = fromData.length;
            }
          } else {
            this.filterValue = 0;
          }
         
        }
      }.bind(this)
    );
    this.animationState1 = 'out';
    this.viewcount = true;
  }

  formreset() {    
    this.statusCount = 0;
    this.filtercount = 0;
    this.checkedFilterArr = [];
    const filterStatusVal = <FormArray>this.filterform.get('Status') as FormArray;
    if(filterStatusVal != null){
      let initialFilterStatusCount = filterStatusVal.length;
      for (let i = (initialFilterStatusCount - 1); i >= 0; i--) {
        this.clearFilter(i);
      }
    }
    this.filterform.reset();
    this.advanceFilter('yes', this.userSortBy, this.perpage, 0, 'out');
    this.filterCombination.length = 0;
  }

  clearFilter(index) {
    let filterStatusVal = <FormArray>this.filterform.get('Status') as FormArray;
    filterStatusVal.removeAt(index);
    this.statusType = filterStatusVal.value;
    this.filtercount = filterStatusVal.length;
  }

  getBranchNameList() {
    this.EnterpriseService.getbranchNameList().subscribe(data => {
      this.branchnamelist = data['data'].items;
      this.filteredCountry.next(this.branchnamelist.slice());
    })
  }

  getBusinessList() {
    this.EnterpriseService.getfilterBusinessList().subscribe(data => {
      this.oninitbusinessunitlist = data['data'].items;
      this.businessunitlist = data['data'].items;
      this.filteredSector.next(this.businessunitlist.slice());
    })
  }
  filterSector() {
    if (!this.businessunitlist) {
      return;
    }
    // get the search keyword
    let search = this.sectorFilter.value;
    if (!search) {
      this.filteredSector.next(this.businessunitlist.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filteredSector.next(
      this.businessunitlist.filter(sector => sector.SecM_SectorName.toLowerCase().indexOf(search) > -1)
    );
  }
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentfilter') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
      this.animationState1 = 'out';
    }
    else if (divName === 'searchhistorydropdown') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
      this.animationState = 'out';
    }
  }

  closethefilter() {
    this.filtercount = 0;
    this.filterform.reset();
  }

  monitorLogFilter(sortByData) {
    this.sortBy = sortByData;
    this.advanceFilter('', this.userSortBy, 8, 0, 'out');
  }

  filterModuleCountSelected(event) {
    if (event.isUserInput) {
      if (!event.source.selected) {

        let unselectedMod = event.source.value;
        let formval = this.filterform.controls['Submodule'].value;

        let tempCombinData = this.filterCombination;

        for (var i = tempCombinData.length - 1; i >= 0; --i) {
          if (tempCombinData[i].modPk == unselectedMod) {
            let ind: number = formval.indexOf(tempCombinData[i].subPk);
            if (ind !== -1) {
              this.filterform.controls['Submodule'].value.splice(ind, 1);
            }
            this.filterCombination.splice(i, 1);
          }
        }
        if (this.filterCombination.length > 0) {
          this.submoduleDataTemp = this.filterCombination[0].subName;
        } else {
          this.submoduleDataTemp = '';
        }
      } else {

      }
    }
  }

  filterCountry() {
    if (!this.branchnamelist) {
      return;
    }
    // get the search keyword
    let search = this.branchFilter.value;
    if (!search) {
      this.filteredCountry.next(this.branchnamelist.slice());
      return;
    } else {
      search = search.toLowerCase();
    }
    // filter the banks
    this.filteredCountry.next(
      this.branchnamelist.filter(branch => branch.toLowerCase().indexOf(search) > -1)
    );
  }

  onSelectSubMod(event, subName, modPk) {
    if (event.isUserInput) {
      let subPk = event.source.value;
      if (event.source.selected) {
        this.filterCombination.push({ "modPk": modPk, "subPk": subPk, "subName": subName });
      } else if (!event.source.selected) {
        (this.filterCombination).forEach((com, index) => {
          if (com.subPk == subPk) {
            this.filterCombination.splice(index, 1);
          }
        });
      }
    }
  }
  filterRadioSelected(event) {
    // if(event.source.checked && this.statusCount == 0){
    //   this.statusCount = 1;
    //   this.filtercount = this.filtercount + this.statusCount;
    // }
  }
  subModChange(event, type) {
    if (type == 1) {
      this.departmentDataTemp = '';
      (this.departmentData).forEach((item, index) => {
        if (item.deptPk == event.value[0]) {
          this.departmentDataTemp = item.deptName;
        }
      });
    } else if (type == 2) {
      this.moduleDataTemp = '';
      this.filterform.controls['Submodule'].value;
      (this.moduleData).forEach((item, index) => {
        if (item.modulePk == event.value[0]) {
          this.moduleDataTemp = item.moduleName;
        }
      });

    } else if (type == 3) {
      this.submoduleDataTemp = '';
      (this.submoduleData).forEach((item, index) => {
        (item.subModule).forEach((subItem, subi) => {
          if (subItem.subModulePk == event.value[0]) {
            this.submoduleDataTemp = subItem.subModuleName;
          }
        });

      });
    } 
  }


}
