import { ChangeDetectorRef, Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatDrawer } from '@angular/material/sidenav';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { DepartmentallocationComponent } from '@app/modules/enterpriseadmin/departmentallocation/departmentallocation.component';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import 'rxjs/add/observable/of';
import swal from 'sweetalert';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import {ToastrService} from 'ngx-toastr'
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';



export interface Businessunit {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-adddepartment',
  templateUrl: './adddepartment.component.html',
  styleUrls: ['./adddepartment.component.scss'],
  animations: [SlideInOutAnimation]
})
export class AdddepartmentComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  searchSector: string = '';
  sectorlist: any = [];
  public showprojlstcreate = false;
  animationState = 'out';
  businessunitlist: Businessunit[] = [
    {value: 'value-0', viewValue: 'Agriculture'},
    {value: 'value-1', viewValue: 'Basic Metal Production'},
    {value: 'value-2', viewValue: 'Chemical Industries'},
    {value: 'value-2', viewValue: 'Commerce'},
    {value: 'value-2', viewValue: 'Construction'},
    {value: 'value-2', viewValue: 'Education'},
  ];
  @Input('drawerdepartment') drawerdepartment: MatDrawer;
  adddepartmentForm: FormGroup;
  @Output() addDeptData:any = new EventEmitter<any>();
  @Output() closeSideNav:any = new EventEmitter<any>();
  @ViewChild('addUpdateDeptAccess') addUpdateDeptAccess:DepartmentallocationComponent;
  public postParams:any;
  public postUrl:any;
  public mcpPk:any;
  public departmentPermission:any = [];
  public swalData:any;
  @Input() logoUrl: any;

  /* Sar Starts*/
  public bunitData:any = [];
  @ViewChild('deptReset') deptReset:FormGroupDirective;
  @Output() deptReload: any = new EventEmitter<any>();
  public buttonName:any = 'Add';
  showResponsiveLoader: boolean = false;
  constructor(
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private formBuilder: FormBuilder,
    public toastr: ToastrService,
    private EnterpriseService: EnterpriseService,
    private localstorage: AppLocalStorageServices,
    private encrypt: Encrypt,
    private cdr:ChangeDetectorRef
  ) { 
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
          this.buttonName = 'Add';
        }else{
          this.buttonName = 'إضافة';
        }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.buttonName = 'Add';
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.buttonName = 'Add';
        }else{
          this.buttonName = 'إضافة';
        }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.buttonName = 'Add';
      }
  });
    this.mcpPk = this.encrypt.encrypt(this.localstorage.getInLocal('comp_pk'));
    this.adddepartmentForm = this.formBuilder.group({
      departmentPk:['', ''],
      departmentName:['', Validators.required],
      deptBunit:['',Validators.required]
    });

    // this.adddepartmentForm.valueChanges.subscribe(
    //   function(data){
    //     this.validationCheck()
    //   }.bind(this)
    // );

    this.initiateBusinessUnit();
  }
  initiateBusinessUnit(){
    this.postParams = {};
    this.postUrl = 'ea/department/fetch-business-unit';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        this.bunitData = data['data'].data.bunitData;
      }.bind(this)
    );
  }
  
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentuserrole') {
        this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  get f() { return this.adddepartmentForm.controls; }

  validationCheck(){
    if(this.adddepartmentForm.valid){
      this.addDeptData.emit(2);
    }
  }

  onSubmit(){
    if(this.departmentPermission.length > 0){
      this.postParams = {
        "mcpPk": this.mcpPk,
        "deptName":this.adddepartmentForm.controls['departmentName'].value,
        "deptStatus":1,
        "deptAccess":this.departmentPermission,
        "deptPk":this.adddepartmentForm.controls['departmentPk'].value,
      };
      let successMsg = this.i18n('enterpriseadmin.depacreatsucc');
      if(this.adddepartmentForm.controls['departmentPk'].value > 0){
        successMsg = this.i18n('enterpriseadmin.depaupdasucc');
      }
      let accessModulePk = this.encrypt.encrypt('7');
      let accessType = this.encrypt.encrypt('1,3');
      this.postUrl = 'ea/department/save-department?uac=f3f86bb473399a2239202c31420a1ee1&uam='+accessModulePk+'&uat='+accessType;
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
          function(data){
            if(data['data'].status == 0){
              swal({
                title: this.i18n('enterpriseadmin.warntitle'),
                text: data['data'].msg,
                icon: 'warning',
                closeOnClickOutside: false,
                closeOnEsc: false
              });
            }else{
              if(data['data'].status == 100){
                this.adddepartmentForm.reset();
                this.departmentPermission = [];
                this.closeSideNav.emit(true);
                this.showTSuccess(successMsg);
                // this.swalData = {
                //   "msg":successMsg,
                //   "status":'success',
                //   closeOnClickOutside: false,
                //   closeOnEsc: false
                // }
               
              }else{
                this.showTSuccess(data['data'].msg);
                // this.swalData = {
                //   "msg":data['data'].msg,
                //   "status":(data['data'].status == '100')?'success':'warning'
                // }
              }
              // this.sweetalert(this.swalData);
            }
          }.bind(this)
      );
    }else{
      this.showWSuccess(this.i18n('enterpriseadmin.pleaseledepa'));
      // this.swalData = {
      //   "msg":'Please select department module access',
      //   "status":'warning'
      // }
      // this.sweetalert(this.swalData);
    }
  }

  departmentPermData(event){
    this.departmentPermission = event;
    this.validationCheck();
  }

  sweetalert(data)
  {
    swal({
      text:data.msg,
      icon:data.status,
    }).then((value)=>{
        
    });
  }

  departmentCloseCheck(){
    return this.adddepartmentForm.touched;
  }

  clearForm(){
    this.adddepartmentForm.reset();
    this.departmentPermission = [];
    this.cdr.detectChanges();
    this.addUpdateDeptAccess.initialDetailsFetch();
  }

  editDeptData(dptPK){
    this.postParams = {
      "deptPk": dptPK
    };
    let accessModulePk = this.encrypt.encrypt('7');
    let accessType = this.encrypt.encrypt('1,3');
    this.postUrl = 'ea/department/update-department-details?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
          this.adddepartmentForm.patchValue({
            departmentPk:data['data'].data.deptDet.deptPk,
            departmentName:data['data'].data.deptDet.deptName
          });
          this.addUpdateDeptAccess.userAccessModification(data['data'].data.baseModulesAccess);
          this.departmentPermission = data['data'].data.checkedAccess;
        }.bind(this)
    );
  }

  companyDeptDetails(cmpName, cmpId, logoUrl){
    this.addUpdateDeptAccess.companyDeptDetails(cmpName, cmpId, logoUrl);
  }

  /* Sar Starts */
  addBunitDept(){
    this.showprojlstcreate=true;
    this.postParams = {
      'deptPk': this.encrypt.encrypt(this.adddepartmentForm.controls['departmentPk'].value),
      'deptName': this.adddepartmentForm.controls['departmentName'].value,
      'deptBunit': this.adddepartmentForm.controls['deptBunit'].value,
    };
    let departmentPk = this.adddepartmentForm.controls['departmentPk'].value;
    let alertMsg = this.i18n('enterpriseadmin.depacreatsucc');
    if(departmentPk > 0){
    
      alertMsg = this.i18n('enterpriseadmin.depaupdasucc');
     
    }
    this.postUrl = 'ea/department/save-bunit-department';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        this.showprojlstcreate=false;
        
        if(data['data'].status == 100){
          this.showTSuccess(alertMsg);
          // swal({
           
          //   title:alertMsg,
          //   icon:'success',
          // });
          this.adddepartmentForm.reset();
          // this.deptReset.resetForm();
          this.drawerdepartment.toggle();
          this.deptReload.emit(data['data'].data.deptPk);
          this.buttonName = this.i18n('enterpriseadmin.add');
        }else{
          this.showWSuccess(data['data'].msg);
          // swal({
          //   text:data['data'].msg,
          //   icon:'warning',
          // });
        }
      }.bind(this)
    );
  }

  clearDeptForm(){
    this.deptReset.resetForm();
  }

  closeDeptForm(){
    this.animationState='out'; 
    if(this.adddepartmentForm.dirty){
      swal({
        title:this.i18n('enterpriseadmin.doyouwantcancdepa'),
        text:this.i18n('enterpriseadmin.ifyesany') ,
        icon: 'warning',
        buttons: [this.i18n('enterpriseadmin.no'), this.i18n('enterpriseadmin.yes')],
        dangerMode: true,
      }).then((beforeClose) => {
        if (beforeClose) {
          this.deptReset.resetForm();
          this.drawerdepartment.toggle()
          this.buttonName = this.i18n('enterpriseadmin.add');
        }
      }); 
    }
    else{
      this.deptReset.resetForm();
      this.drawerdepartment.toggle()
    }
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

  fetchBunitDept(deptPk){
    this.postParams = {
      "deptPk": this.encrypt.encrypt(deptPk)
    };
    this.postUrl = 'ea/department/fetch-bunit-department';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        this.adddepartmentForm.patchValue({
          'departmentPk':data['data'].data.bunitDeptData.deptPk,
          'departmentName':data['data'].data.bunitDeptData.deptName,
          'deptBunit':data['data'].data.bunitDeptData.bunitFks,
        });
      
        this.tempobject=this.adddepartmentForm.value;
        this.showprojlstcreate=false; 
        this.drawerdepartment.toggle();
        this.buttonName = this.i18n('enterpriseadmin.upda');
      }.bind(this)
    );
  
  }
  triggerdivisionlisit(){
    this.initiateBusinessUnit();
  }
  tempobject:any;
  get isFormValueChanged() {
    return JSON.stringify(this.tempobject) !== JSON.stringify(this.adddepartmentForm.value);
  }
  get isFormValid() {
    let isValid = true;
    if ((this.adddepartmentForm.valid && !this.tempobject) || (this.tempobject && this.isFormValueChanged)) {
      isValid = this.adddepartmentForm.invalid;
    }
    return isValid;
  }
}
