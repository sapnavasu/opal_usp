import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatPaginator } from '@angular/material/paginator';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import 'rxjs/add/observable/of';
import swal from 'sweetalert';

@Component({
  selector: 'app-dept',
  templateUrl: './dept.component.html',
  styleUrls: ['./dept.component.scss']
})
export class DeptComponent implements OnInit {
  @Input('drawerdepartment') drawerdepartment: MatDrawer;
  adddepartmentForm: FormGroup;
  @Output() addDeptData:any = new EventEmitter<any>();
  @Output() closeSideNav:any = new EventEmitter<any>();
  public postParams:any;
  public postUrl:any;
  public mcpPk:any;
  public departmentPermission:any = [];
  public swalData:any;

  ///

  @Input() tog: any = "";
  dataSourceforpermission: any;
  permissionarray: any;
  finalpermissionarray: any = [];
  @Input('drawerdepartmentallocation') drawerdepartmentallocation: MatDrawer;
  @ViewChild('paginator') paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  public companyName:any = '-';
  public companyId:any = '-';
  public tempStoring:any;
  

  checked = true;
  indeterminate = false;
  labelPosition = 'after';
  disabled = false;

  public moduleIdsArr:any = [];

  constructor(
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private localstorage: AppLocalStorageServices,
    private encrypt: Encrypt
  ) { }
  isExtendedRow = (index, item) => item.extend;
  ngOnInit() {
    this.mcpPk = this.encrypt.encrypt(this.localstorage.getInLocal('comp_pk'));
    this.adddepartmentForm = this.formBuilder.group({
      departmentPk:[null, null],
      departmentName: ['', Validators.required],
    });
    this.initialDetailsFetch();
  }

  get f() { return this.adddepartmentForm.controls; }

  validationCheck(){
    if(this.adddepartmentForm.valid){
      this.addDeptData.emit(2);
    } else {
      this.addDeptData.emit('invalid');
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
      let successMsg = 'Department created Successfully';
      if(this.adddepartmentForm.controls['departmentPk'].value > 0){
        successMsg = 'Department updated Successfully';
      }
      this.postUrl = 'ea/department/save-department';
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
          function(data){
              if(data['data'].status == 100){
                this.swalData = {
                  'title': 'Success!',
                  "msg":successMsg,
                  "status":'success'
                }
                this.adddepartmentForm.reset();
                this.departmentPermission = [];
                this.closeSideNav.emit(data['data'].data.deptPk);
              }else{
                this.swalData = {
                  "msg":data['data'].msg,
                  "status":(data['data'].status == '100')?'success':'warning'
                }
              }
              this.sweetalert(this.swalData);
          }.bind(this)
      );
    }else{
      this.swalData = {
        "msg":'Please select department module access',
        "status":'warning'
      }
      this.sweetalert(this.swalData);
    }
  }

  departmentPermData(event){
    this.departmentPermission = event;
  }

  sweetalert(data)
  {
    swal({
      text:data.msg,
      icon:data.status,
    }).then((value)=>{
        
    });
  }

  clearForm(){
    this.adddepartmentForm.reset();
    this.departmentPermission = [];
  }

  editDeptData(dptPK){
    this.postParams = {
      "deptPk": dptPK
    };
    this.postUrl = 'ea/department/update-department-details';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
          this.adddepartmentForm.patchValue({
            departmentPk:data['data'].data.deptDet.deptPk,
            departmentName:data['data'].data.deptDet.deptName
          });
          this.userAccessModification(data['data'].data.baseModulesAccess);
          this.departmentPermission = data['data'].data.checkedAccess;
        }.bind(this)
    );
  }

  // companyDeptDetails(cmpName, cmpId){
  //   this.addUpdateDeptAccess.companyDeptDetails(cmpName, cmpId);
  // }

  initialDetailsFetch(){
    this.postParams = {};
    this.postUrl = 'ea/department/fetch-department-details';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
            if(data['data'].status == 100){
              this.dataSourceforpermission = new MatTableDataSource(data['data'].data.baseModules);
              this.moduleIdsArr = data['data'].data.modSubModIds;
              this.tempStoring = data['data'].data.baseModules;
            }
        }.bind(this)
    );
  }

  saveModulePermission() {
    const moduleForm = (<HTMLFormElement>document.getElementById("modulecheckform"));
    const formdata = new FormData(moduleForm);
    const permissionarray = [];
    formdata.forEach((item, index) => {
      const splitdata = index.split('_');
      const typeofoperation = (typeof splitdata[3] != 'undefined') ? splitdata[3] : 'All';
      const submoduleoperation = (typeof splitdata[2] != 'undefined') ? splitdata[2] : 'All';
      const mainmoduleoperation = (typeof splitdata[1] != 'undefined') ? splitdata[1] : 'All';
      const booleanvalue = 1;
      const permissionobj = {
                name: index, value: booleanvalue,
                module: mainmoduleoperation,
                submodule: submoduleoperation,
                type: typeofoperation
         };
      permissionarray.push(permissionobj);
    });
    if(permissionarray.length > 0){
      this.finalpermissionarray = permissionarray;
      this.departmentPermData(permissionarray);
    }else{
      this.swalData = {
        "msg":'Please select atleast one module access',
        "status":'warning'
      }
      this.sweetalert(this.swalData);
    }
  }

  animationState = 'out';
  animationState1 = 'out';

  toggle() {
    this.tog.toggle();
  }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontent') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
    else if (divName === 'documentinformationanimate') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
    else if (divName === 'coc') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }

  moduleToggle(event, module_id, accessType){
    if(event.checked == true){
      let activeReadCnt = 0;
      let totalCnt = 0;
      this.moduleIdsArr[module_id].forEach((item, index) => {
        totalCnt = totalCnt + 1;
        if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType))){
          (<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType)).checked = true;
        }

        if((<HTMLInputElement>document.getElementById("module_" + item + "_2"))){
          (<HTMLInputElement>document.getElementById("module_" + item + "_2")).checked = true;
          activeReadCnt = activeReadCnt + 1;
        }
      });

      if(activeReadCnt == totalCnt){
        var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+module_id+'-2');
        tgleReadChked.classList.add("mat-checked");
      }
    }else{
      this.moduleIdsArr[module_id].forEach((item, index) => {
        if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType))){
          (<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType)).checked = false;
        }
        if(accessType == 2){
          for(let i=1; i<=6;i++){
            if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;
            }
            var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+module_id+'-'+i);
            tgleReadChked.classList.remove("mat-checked");
          }
        }
      });
    }
  }

  checkBoxCheck(event, module_id, accessType){
    let splitModule = module_id.split('_');
    let activeCnt = 0;
    let activeReadCnt = 0;
    let totalCnt = 0;
    if(event.target.checked == true){
      if((<HTMLInputElement>document.getElementById("module_" + module_id + "_2"))){
        (<HTMLInputElement>document.getElementById("module_" + module_id + "_2")).checked = true;
      }

      this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
        totalCnt = totalCnt + 1;
        if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType))){
          if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType)).checked == true){
            activeCnt = activeCnt + 1;
          }
        }
        if((<HTMLInputElement>document.getElementById("module_" + item + "_2"))){
          if((<HTMLInputElement>document.getElementById("module_" + item + "_2")).checked == true){
            activeReadCnt = activeReadCnt + 1;
          }
        }
      });

      if(activeCnt == totalCnt){
        var tgle = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+accessType);
        tgle.classList.add("mat-checked");
        var tgleReadChecked = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2');
        tgleReadChecked.classList.add("mat-checked");
      }
      if(activeReadCnt == totalCnt){
        var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2');
        tgleReadChked.classList.add("mat-checked");
      }
    }else{
      const enToggle = (<HTMLInputElement>document.getElementById("mm-"+splitModule[0]+"-"+accessType));
      enToggle.classList.remove("mat-checked");

      if(accessType == 2){
        this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
          if(module_id == item){
            for(let i=1; i<=6;i++){
              if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
                (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;
              }

              const allToggle = (<HTMLInputElement>document.getElementById("mm-"+splitModule[0]+"-"+i));
              allToggle.classList.remove("mat-checked");
            }
          }
        });
      }
    }
  }

  fullMOduleCheck(event){
    let modArr = this.moduleIdsArr;
    let convertArr = Object.keys(modArr).map(function(key){
      return [modArr[key]];
    });

    let convertModArr = Object.keys(modArr).map(function(key){
      return [key];
    });
    if(event.target.checked== true){
      convertArr.forEach((subModArr,mainIndex) => {
        subModArr[0].forEach((item,subIndex) => {
          for(let i=1;i<=6;i++){
            
            if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = true;
            }
          }
        });
      });

      convertModArr.forEach((index) =>{
        for(let i=1;i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+index+'-'+i);
          tgleReadChked.classList.add("mat-checked");
        }
        if((<HTMLInputElement>document.getElementById("module_" + index))){
          (<HTMLInputElement>document.getElementById("module_" + index)).checked = true;
        }
      });
    }else{
      convertArr.forEach((subModArr,mainIndex) => {
        subModArr[0].forEach((item,subIndex) => {
          for(let i=1;i<=6;i++){
            var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+item+'-'+i);
            tgleReadChked.classList.remove("mat-checked");

            if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;
            }
          }
        });
      });
      convertModArr.forEach((index) =>{
        for(let i=1;i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+index+'-'+i);
          tgleReadChked.classList.remove("mat-checked");
          
        }
        if((<HTMLInputElement>document.getElementById("module_" + index))){
          (<HTMLInputElement>document.getElementById("module_" + index)).checked = false;
        }
      });
    }
  }

  checkAllModule(event,moduleId){
    if(event.target.checked == true){
      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for(let i=1; i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i);
            tgleReadChked.classList.add("mat-checked");
          if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
            (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = true;
          }
        }
      });
    }else{
      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for(let i=1; i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i);
            tgleReadChked.classList.remove("mat-checked");
          if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
            (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;
          }
        }
      });
    }
  }

  userAccessModification(deptAccess){
    this.dataSourceforpermission = new MatTableDataSource(deptAccess);
    this.tempStoring = deptAccess;
  }

  companyDeptDetails(cmpName, cmpId){
    this.companyName = cmpName;
    this.companyId = cmpId;
  }

  
}
