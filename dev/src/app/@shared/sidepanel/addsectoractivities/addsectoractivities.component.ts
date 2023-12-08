import { ChangeDetectorRef, Component, ElementRef, EventEmitter, Input, OnInit, Output, Renderer2, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatSelectionList } from '@angular/material/list';
import { MatDrawer } from '@angular/material/sidenav';
import { MatTableDataSource } from '@angular/material/table';
import { MatTabGroup } from '@angular/material/tabs';
import { ActivatedRoute } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { DeptComponent } from '@app/modules/profilemanagement/contactinfo/dept/dept.component';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { AddinguserComponent } from '@shared/addinguser/addinguser.component';
import { CdkTextareaAutosize } from '@angular/cdk/text-field';
import { NgZone } from '@angular/core';
import { take } from 'rxjs/operators';
import swal from 'sweetalert';
import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { MatSnackBar } from '@angular/material/snack-bar';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { ToastrService } from 'ngx-toastr';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

const ELEMENT_DATA: Element[] = [
  {position: 'BU-CO-00001', name: 'Community', weight: 'Aricent Group'},
  {position: 'BU-CO-00001', name: 'Automotive', weight: 'Blue Scope Steel'},
  {position: 'BU-CO-00001', name: 'Fishing', weight: 'Aricent Group'},
];
export interface Element {
  name: string;
  position: string;
  weight: string;
}

@Component({
  selector: 'app-addsectoractivities',
  templateUrl: './addsectoractivities.component.html',
  styleUrls: ['./addsectoractivities.component.scss'],
  animations: [SlideInOutAnimation]
})


export class AddsectoractivitiesComponent implements OnInit {
  
 i18n(key){
  return this.translate.instant(key);
}
  
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  displayedColumns = ['mcsd_referenceno', 'mcsd_businessunitrefname', 'secm_sectorname'];
  @Input() dataSource = new MatTableDataSource<any>();
  @Input('addbusinessunitmcp') addbusinessunitmcp: MatDrawer;
  @ViewChild('toggleButton') toggleButton: ElementRef;
  @ViewChild('menu') menu: ElementRef;
  animationState = 'out';
  animationState1 = 'out';
  animationState2 = 'out';
  resultsLength : number = 10;
  animationState3 = 'out';
  animationState4 = 'out';
  animationState5 = 'out';
  businessunitForm: FormGroup;
  categoryarray = [{ value: 1, display: 'Sector' }, { value: 2, display: 'Industry' }, { value: 3, display: 'Activities' }];
  sectorlist: any = [];
  industrylist: any = [];
  activitylist: any = [];
  searchResultactivity: any = [];
  sectorpk: number;
  industrypk: number;
  activitypk: number;
  secactbuttonname ='Add';
  searchSector = '';
  matcher = new ErrorStateMatcher();
  searchbyplaceholder = 'Search by Sector';
  @Input() companypk: number;
  @Input() companyname: string;
  @Input() lypisid: string;
  @Input() logourl: string;
  @Input() drawer: MatDrawer;
  @Input('addbusinessunit') addbusinessunit: MatDrawer;
  @Output() updateSectorActivityList: any = new EventEmitter<any>();
  @Output() reqfrombs: any = new EventEmitter<any>();
  @Output() reqfrombr: any = new EventEmitter<any>();
  @ViewChild('addUpdateUser') addUpdateUser: AddinguserComponent;
  @ViewChild('addDepartmentData') addDepartmentData: DeptComponent;
  @ViewChild('tab') tab: MatTabGroup;
  @ViewChild('user') user: MatSelectionList;
  @ViewChild('drawerdept') drawerdept: MatDrawer;
  @ViewChild('drawercontactallocation') drawercontactallocation: MatDrawer;
  @ViewChild('formDirective') formDirective: FormGroupDirective;
  @ViewChild('scrollDiv') scrollElement: ElementRef;
  selectedTab = 0;
  userbuttonname = 'Map';
  deptbuttonname = 'Add';
  editMode = true;
  editbtn = false;
  searchControl: FormControl = new FormControl();
  selectedItem: number;
  selectedPk: number;
  deptUserList: any = [];
  userListBackup: any = [];
  disableUserAddButton = true;
  disableDeptAddButton = true;
  loadAddUserComponent = false;
  loadAddDeptComponent = false;
  showSearchIcon = true;
  btnstate = false;
  slideToggle: FormControl = new FormControl(false);
  @Input() hideToggle = false;
  isbtnclicked = false;
  previousFormValue: any;
  public req_from;
  @Output() bunitReload: any = new EventEmitter<any>();
  public ck = new InptLang_Ctrl(); /* Language controller */
  public Editor = ClassicEditorBuild; /* CK Editor */
  public sample = '';
  public snackBar;
  public showprojlstcreate = false;
  public sellangcode:any;
  public config = {
    toolbar: ['heading', '|', 'bold', 'italic', 'bulletedlist', 'numberedlist', 'blockquote', 'undo', 'redo'],
    placeholder: 'Type the content here!'
  }
  infotoggle: boolean = false;
  constructor(private fb: FormBuilder,
              private profileService: ProfileService,
              public cdr: ChangeDetectorRef,
              private encryptClass: Encrypt,
              private enterpriseService: EnterpriseService,
              private renderer: Renderer2,
              private routeid: ActivatedRoute,private _ngZone: NgZone,public toastr: ToastrService,snackBar: MatSnackBar,
              private translate: TranslateService,
              private remoteService: RemoteService,
              private cookieService: CookieService,
  ) {
    this.renderer.listen('window', 'click', (e: Event) => {

     if (e.target !== this.toggleButton.nativeElement && e.target !== this.menu.nativeElement) {
         this.animationState = 'out';
     }
 });
  }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr" 
  /*InfoToggle = false;
  Infochange() {
    this.InfoToggle = !this.InfoToggle;
    this.animationState2 = 'out';
  }*/
  despchange() {
    this.infotoggle = !this.infotoggle;
    this.animationState2 = 'out';
  }
  closedespchange() {
    this.infotoggle = false;
  }
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if(toSelect.languagecode == 'en'){
        this.secactbuttonname = 'Add';
        this.secactbuttonname = 'Update'; 
        this.userbuttonname = 'Map';
        this.deptbuttonname = 'Add';
        this.searchbyplaceholder = 'Search by Sector';
      }else{
        this.secactbuttonname = 'إضافة';
        this.secactbuttonname = 'تحديث';
        this.userbuttonname = 'Map';
        this.deptbuttonname = 'إضافة';
        this.searchbyplaceholder = 'Search by Sector';
      
      }
      
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.secactbuttonname = 'Add';
      this.userbuttonname = 'Map';
      this.deptbuttonname = 'Add';
      this.searchbyplaceholder = 'Search by Sector';
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      
   if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
    const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
   this.translate.setDefaultLang(toSelect.languagecode);
    this.dir = toSelect.dir;
    if(toSelect.languagecode == 'en'){
      this.secactbuttonname = 'Add';
      this.userbuttonname = 'Map';
      this.deptbuttonname = 'Add';
      this.searchbyplaceholder = 'Search by Sector';
    }else{
      this.secactbuttonname = 'إضافة';
      this.userbuttonname = 'Map';
      this.deptbuttonname = 'إضافة';
      this.searchbyplaceholder = 'Search by Sector';
    }
    
     
  }else{      
    const toSelect = this.languagelist.find(c => c.id == '1');
    this.translate.setDefaultLang(toSelect.languagecode);
    this.dir = toSelect.dir;
    this.secactbuttonname = 'Add';
    this.userbuttonname = 'Map';
    this.deptbuttonname = 'Add';
    this.searchbyplaceholder = 'Search by Sector';
  }
  });
    this.initializeBusinessUnitForm();
    this.getSectorList();
    const postParams = { fetchFor: 'map' };
    this.stakeholderUserDetails(postParams);
    this.searchControl.valueChanges.subscribe(searchterm => {
      if (searchterm) {
        searchterm = searchterm.toLowerCase().toString();
        const finalArr = [];
        this.userListBackup.forEach(val => {
          const ul:any = {};
          if (val.deptName.toLowerCase().toString().includes(searchterm)) {
            ul.deptPk = val.deptPk;
            ul.deptName = val.deptName;
            ul.userList = val.userList.filter(x => x.fullName.toLowerCase().includes(searchterm));
            if (ul.userList.length > 0) {
              finalArr.push(ul);
            }
          } else {
            ul.deptPk = val.deptPk;
            ul.deptName = val.deptName;
            ul.userList = val.userList.filter(x => x.fullName.toLowerCase().includes(searchterm));
            if (ul.userList.length > 0) {
              finalArr.push(ul);
            }
          }
          this.deptUserList = finalArr;
        });
      } else {
        this.deptUserList = this.userListBackup;
      }
    });

    this.sellangcode=this.cookieService.get('languageCode');
  }

  setlang(){
    this.sellangcode=this.cookieService.get('languageCode');
  }
  toggleShowDiv(divName: string) {
    if (divName === 'businessunitinfo') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
      this.infotoggle = false;
    }
  }
  infolisting(divName: string) {
    if (divName === 'infoview') {
      this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
      this.infotoggle = false;
    }
}

  initializeBusinessUnitForm() {
    this.businessunitForm = this.fb.group({
      sector: [null, Validators.required],
      unit_name: [null, Validators.required],
      unit_desc: [null, null],
      companypk: [this.companypk, null],
      sector_pk: [null, null],
      unitnameupd: [null, null],
      sector_name: [null, null]
    });
  }

  submitBusinessUnitdetails(formGroupDirective: FormGroupDirective) {

    if (this.businessunitForm.valid) {
      this.isbtnclicked = true;
      this.showprojlstcreate=true;
      this.profileService.saveBusinessUnit(this.businessunitForm.value).subscribe(data => {
        this.isbtnclicked = false;
        this.showprojlstcreate=false;
        if (data.data.flag == 'warning') {
          this.showprojlstcreate=false;
          this.showWSuccess(data.data.msg);
          // swal({
          //   title: data.data.msg,
          //   icon: data.data.flag,
          //   closeOnClickOutside: false,
          //   closeOnEsc: false
          // }).then((value) => {

          // });
        } else if (data.data.flag == 'success') {
          this.showprojlstcreate=false;
          this.drawer.toggle();
          this.bunitReload.emit(true);
          this.showTSuccess(data.data.msg);
          if (!this.hideToggle && this.loadAddUserComponent && data.data.businessunitpk) {
            this.addUpdateUser.adduserForm.controls.businessunit.setValue([data.data.businessunitpk]);
            this.addUpdateUser.onSubmit();
          } else if (!this.hideToggle && this.selectedPk) {
            this.mapContact(this.selectedPk.toString(), data.data.businessunitpk);
          } else {
            this.updateSectorActivityList.emit(true);
          }
          // swal({
          //   title: data.data.msg,
          //   icon: data.data.flag,
          //   closeOnClickOutside: false,
          //   closeOnEsc: false
          // }).then((value) => {
           
          // });
          this.businessunitForm.reset();
          formGroupDirective.resetForm();
          this.secactbuttonname = this.i18n('enterpriseadmin.add');
          this.hideToggle = true;
          this.businessunitForm.controls['unit_desc'].reset();
          this.businessunitForm.controls['unit_name'].enable();
          this.sample ="";
          this.techinfo = '';
          this.btnstate=false;
          this.routeid.queryParams.subscribe(params => {
            if (params.from) {
                this.req_from = params.from;
            }
        });

          if (this.req_from == 'bs') {
            this.reqfrombs.emit({'result': true, 'pk': data.data.businessunitpk});
          } else if(this.req_from == 'br'){
            this.reqfrombr.emit({'result': true});
          }

        }
      });
    }
    this.btnstate=true;
  }

  showSweetAlert(formDirective: FormGroupDirective, showFor?: string) {
    this.animationState = 'out';
    this.animationState2 = 'out';
    this.routeid.queryParams.subscribe(params => {
        if (params.from) {
            this.req_from = params.from;
        }
    });
    if ((
      (this.businessunitForm.controls.sector.touched && this.businessunitForm.controls.sector.value != null) ||
      (this.businessunitForm.controls.unit_name.touched && this.businessunitForm.controls.unit_name.value != null) ||
      (this.businessunitForm.controls.unit_desc.touched && this.businessunitForm.controls.unit_desc.value != null) ||
      (this.businessunitForm.controls.companypk.touched && this.businessunitForm.controls.companypk.value != null) ||
      (this.businessunitForm.controls.sector_pk.touched && this.businessunitForm.controls.sector_pk.value != null) ||
      (this.businessunitForm.controls.sector_name.touched && this.businessunitForm.controls.sector_name.value != null) ||
      showFor == 'sector' && ((this.secactbuttonname == 'Add' && this.businessunitForm.valid) || (this.secactbuttonname == 'Update' &&  (this.businessunitForm.valid && this.businessunitForm.dirty && JSON.stringify(this.previousFormValue && this.businessunitForm.dirty) !=JSON.stringify(this.businessunitForm.value != null)) || (this.businessunitForm.invalid && this.businessunitForm.dirty && JSON.stringify(this.previousFormValue && this.businessunitForm.valid) !=JSON.stringify(this.businessunitForm.value != null)))) || (this.addUpdateUser && this.addUpdateUser.adduserForm
        ))) {
      swal({
        title:  this.i18n('enterpriseadmin.doyouwantdivi'),
        text: this.i18n('enterpriseadmin.ifyesany'),
        icon: 'warning',
        buttons: [this.i18n('enterpriseadmin.no'), this.i18n('enterpriseadmin.yes')],
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.drawer.toggle();
          this.businessunitForm.reset();
          formDirective.resetForm();
          this.searchSector = '';
          this.secactbuttonname = this.i18n('enterpriseadmin.add');
          this.resetAll();
          this.edittechinfo = false;
          this.businessunitForm.controls['unit_desc'].reset();
          this.businessunitForm.controls['unit_name'].enable();
          if (this.req_from == 'bs') {
            this.reqfrombs.emit({'result': false});
          } else if(this.req_from == 'br'){
            this.reqfrombr.emit({'result': true});
          }
          this.sample ="";    
          this.techinfo = '';
        }
      });
    } else {
      this.drawer.toggle();
      this.searchSector = '';
      this.businessunitForm.reset();
      formDirective.resetForm();
      this.secactbuttonname = this.i18n('enterpriseadmin.add')
      this.resetAll();
      this.businessunitForm.controls['unit_desc'].reset();
      this.businessunitForm.controls['unit_name'].enable();
      if (this.req_from == 'bs') {
        this.reqfrombs.emit({'result': false});
      } else if(this.req_from == 'br'){
        this.reqfrombr.emit({'result': true});
      }
      this.sample ="";
      this.techinfo = '';
    }

  }


  patchBusinessUnitDetails(patchdata) {
    this.hideToggle = true;
    this.businessunitForm.patchValue({
        sector: (patchdata.SectorMst_Fk != '') ? patchdata.SectorMst_Fk.split(',') : [],
        unit_name: patchdata.unit_name,
        unit_desc: patchdata.desc,
        companypk: this.companypk,
        sector_pk: patchdata.sectordtls_pk,
        unitnameupd: patchdata.unit_name,
      
    });
    this.showprojlstcreate=false;
    this.techinfo = patchdata.desc;
    this.sample = patchdata.desc;
    this.previousFormValue = this.businessunitForm.value;
    if(patchdata.unit_name != null){
      this.businessunitForm.controls.unit_name.disable()
    }
}



  getSectorList() {
    this.profileService.getsectorlist('P').subscribe(data => {
      this.sectorlist = data.data.items;
      this.resultsLength = data.data.totalcount;
    });
  }

  get businessunitFormControl() {
    return this.businessunitForm.controls;
  }

  reset(formDirective: FormGroupDirective, type?: string) {
    
    if (this.businessunitFormControl.sector_pk.value || this.businessunitFormControl.unitnameupd.value ) {
      const sector_pk = this.businessunitFormControl.sector_pk.value;
      const unitnameupd = this.businessunitFormControl.unitnameupd.value;
      const sector = this.businessunitFormControl.sector.value;
      //this.businessunitForm.reset();
      //formDirective.resetForm();
      this.businessunitForm.controls['unit_desc'].reset();
      this.sample ="";
      this.techinfo = '';
      this.businessunitFormControl.sector_pk.setValue(sector_pk);
      this.businessunitFormControl.unitnameupd.setValue(unitnameupd);
      this.businessunitFormControl.sector.setValue(sector);
    } else {
      this.businessunitForm.reset();
      this.businessunitForm.controls['unit_desc'].reset();
      this.sample ="";
      this.techinfo = '';
      formDirective.resetForm();
    }
    this.hideToggle = true;
  }

  set sectorname(name: string) {
    this.businessunitForm.controls.sector_name.setValue(name);
  }

  tabChange(event) {
    if (event.index == 0) {
      this.userbuttonname = this.i18n('enterpriseadmin.map');
      this.loadAddUserComponent = false;
    } else if (this.editMode) {
      this.selectedPk = undefined;
      this.loadAddUserComponent = true;
      this.userbuttonname = this.i18n('enterpriseadmin.upda');
    } else {
      this.selectedPk = undefined;
      this.loadAddUserComponent = true;
      this.userbuttonname = this.i18n('enterpriseadmin.add');
    }
  }

  stakeholderUserDetails(postParam) {
    const postUrl = 'ea/user/users-by-dept';
    this.enterpriseService.enterpriseService(postParam, postUrl).subscribe(data => {
        if (data.data.status == 100) {
            this.deptUserList = data.data.data;
            this.userListBackup = data.data.data;
        }
    });
  }

  addUserData(event) {
    if (event == 'I') {
      this.disableUserAddButton = true;
    } else {
      this.disableUserAddButton = false;
    }
  }

  closeSideNav(event, closeFor?: string) {
    if (event) {
      if (closeFor == 'user') {
        this.resetAll();
        this.businessunitForm.reset();
        this.formDirective.resetForm();
        this.secactbuttonname = this.i18n('enterpriseadmin.add');
        this.updateSectorActivityList.emit(true);
        this.businessunitForm.controls['unit_desc'].reset();
        this.sample ="";
        this.techinfo = '';
      } else {
        this.addUpdateUser.loadUserAllocation = true;
        this.drawerdept.toggle();
        this.addUpdateUser.getUserDepartmentList();
        this.addUpdateUser.adduserForm.controls.departmentId.setValue(String(event));
        this.loadUserAccess();
        this.addUpdateUser.addUpdateAccess.allocationUSerDetails(this.addUpdateUser.adduserForm.controls.firstName.value, this.addUpdateUser.adduserForm.controls.lastName.value, this.addUpdateUser.adduserForm.controls.designation.value);
      }
    }
  }

  loadUserAccess() {
    this.addUpdateUser.getDepartmentAccess();
  }

  editDeptData(event) {
    this.loadAddDeptComponent = true;
    this.cdr.detectChanges();
    this.deptbuttonname = this.i18n('enterpriseadmin.upda');
    this.drawerdept.toggle();
    this.disableDeptAddButton = false;
    this.addDepartmentData.editDeptData(event);
  }

  openDeptSideNav(event) {
    if (event) {
      this.loadAddDeptComponent = true;
      this.drawerdept.toggle();
    }
  }

  resetAll() {
    if (this.tab) {
      this.tab.selectedIndex = 0;
    }
    this.userbuttonname = this.i18n('enterpriseadmin.map');
    this.editMode = false;
    this.hideToggle = true;
    this.slideToggle.reset();
    if (this.loadAddUserComponent) {
      this.addUpdateUser.clearForm();
    }
    this.selectedItem = this.selectedPk = undefined;
    this.loadAddUserComponent = false;
    this.loadAddDeptComponent = false;
    this.searchControl.reset();
    this.scrollElement.nativeElement.scrollTo(0, 0);
    this.techinfo = "";
    this.businessunitForm.controls['unit_desc'].reset();
    this.sample ="";
  }

  mapContact(pk: string, businessUnitPk: any) {
    const postUrl = 'ea/user/map-user-as-contact';
    const postParam = { userPk: pk, businessUnitPk };
    this.enterpriseService.enterpriseService(postParam, postUrl).subscribe(data => {
            if (data.data.status == 100) {
                this.resetAll();
                this.businessunitForm.reset();
                this.formDirective.resetForm();
                this.secactbuttonname = this.i18n('enterpriseadmin.add');
                this.updateSectorActivityList.emit(true);
                this.businessunitForm.controls['unit_desc'].reset();
                this.sample ="";
                this.techinfo = '';
            }
        });
  }

  updateDeptUserList(event) {
    if (event) {
        this.stakeholderUserDetails({ fetchFor: 'map' });
    }
  }

  showSweetAlertForDept() {
    if (this.addDepartmentData.adddepartmentForm.touched) {
      swal({
        title: this.i18n('enterpriseadmin.doyouwantdepa'),
        text: this.i18n('enterpriseadmin.ifyesany'),
        icon: 'warning',
        buttons: [this.i18n('enterpriseadmin.canc'), this.i18n('enterpriseadmin.ok')],
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.drawerdept.toggle();
          this.loadAddDeptComponent = false;
          this.addUpdateUser.loadUserAllocation = true;
          this.loadUserAccess();
          this.addUpdateUser.addUpdateAccess.allocationUSerDetails(this.addUpdateUser.adduserForm.controls.firstName.value, this.addUpdateUser.adduserForm.controls.lastName.value, this.addUpdateUser.adduserForm.controls.designation.value);
        }
      });
    } else {
      this.drawerdept.toggle();
      this.loadAddDeptComponent = false;
      this.addUpdateUser.loadUserAllocation = true;
      this.loadUserAccess();
      this.addUpdateUser.addUpdateAccess.allocationUSerDetails(this.addUpdateUser.adduserForm.controls.firstName.value, this.addUpdateUser.adduserForm.controls.lastName.value, this.addUpdateUser.adduserForm.controls.designation.value);
    }
  }

  addDeptData() {
    this.disableDeptAddButton = false;
  }

  get disableBtn() {
    if (!this.previousFormValue) {
      return (this.businessunitForm.invalid && !this.loadAddUserComponent)
      || (this.slideToggle.value && this.addUpdateUser && this.addUpdateUser.adduserForm.touched
        && this.addUpdateUser.adduserForm.invalid);
      } else {
        return (this.businessunitForm.valid && !this.previousFormValue) || (this.previousFormValue && this.isFormValueChanged) ? this.businessunitForm.invalid : true;
    }
  }

  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.businessunitForm.value);
  }
  triggerResize() {
    this._ngZone.onStable.pipe(take(1))
      .subscribe(() => this.autosize.resizeToFitContent(true));
  }
  public edittechinfo = false;
  public techinfo = "";
  editinfo() {
    this.edittechinfo = !this.edittechinfo;
    
}
editinfocont(){
  this.editbtn =true;
}
addinfo() {
    this.techinfo = this.businessunitForm.controls['unit_desc'].value;
    this.editbtn =false;
}

aboutcompanydata() {
  this.businessunitForm.controls['unit_desc'].reset();
  this.techinfo = "";
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
}
