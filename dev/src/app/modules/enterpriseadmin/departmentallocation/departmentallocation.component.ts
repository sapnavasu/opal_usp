import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import 'rxjs/add/observable/of';
import swal from 'sweetalert';
import { EnterpriseService } from '../enterprise.service';


@Component({
  selector: 'app-departmentallocation',
  templateUrl: './departmentallocation.component.html',
  styleUrls: ['./departmentallocation.component.scss']
})
export class DepartmentallocationComponent implements OnInit {
  @Input() tog: any = "";
  dataSourceforpermission: any;
  permissionarray: any;
  finalpermissionarray: any = [];
  @Input('drawerdepartmentallocation') drawerdepartmentallocation: MatDrawer;
  @ViewChild('paginator') paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  public companyName:any = '-';
  public companyId:any = '-';
  

  checked = true;
  indeterminate = false;
  labelPosition = 'after';
  disabled = false;

  public postParams:any;
  public postUrl:any;
  public moduleIdsArr:any = [];
  @Output() departmentPermData:any = new EventEmitter<any>();
  public swalData:any;
  public tempStoring:any;
  @Input() logoUrl: any;

  constructor(
    private EnterpriseService: EnterpriseService,
  ) { 
  }

  isExtendedRow = (index, item) => item.extend;
  ngOnInit() {
    this.initialDetailsFetch();
  }

  initialDetailsFetch(){
    this.postParams = {};
    this.postUrl = 'ea/department/fetch-department-details?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
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
      this.departmentPermData.emit(permissionarray);
      this.drawerdepartmentallocation.toggle();
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

  companyDeptDetails(cmpName, cmpId, logoUrl){
    this.companyName = cmpName;
    this.companyId = cmpId;
  }

  sweetalert(data)
  {
    swal({
      text:data.msg,
      icon:data.status,
    }).then((value)=>{
        
    });
  }
}