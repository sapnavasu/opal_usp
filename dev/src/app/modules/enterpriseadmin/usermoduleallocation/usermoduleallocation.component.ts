import { Component, OnInit, Input, ViewChild, EventEmitter, Output, ChangeDetectorRef} from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import 'rxjs/add/observable/of';
import { EnterpriseService } from '../enterprise.service';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';
import { MatDrawer } from '@angular/material/sidenav';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import {ToastrService} from 'ngx-toastr';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
@Component({
  selector: 'app-usermoduleallocation',
  templateUrl: './usermoduleallocation.component.html',
  styleUrls: ['./usermoduleallocation.component.scss']
})

export  class UsermoduleallocationComponent implements OnInit {
  @Input() tog: any = "";
  dataSourceforpermission: any;
  permissionarray: any;
  finalpermissionarray: any = [];
  @Input('draweruserlallocationnew') draweruserlallocationnew: MatDrawer;
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
  public userPk:any;

  constructor(
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private EnterpriseService: EnterpriseService,
    private encrypt: Encrypt,
    private cdr: ChangeDetectorRef,
    public toastr: ToastrService
  ) {
   }
  isExtendedRow = (index, item) => item.extend;
  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
  });  
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
    this.cdr.detectChanges();
    const moduleForm = (<HTMLFormElement>document.getElementById("moduleaccesscheckform"));
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
      let accessModulePk = this.encrypt.encrypt('7');
      let accessType = this.encrypt.encrypt('1,3');
      this.postUrl = 'ea/user/save-user-module?uac=f3f86bb473399a2239202c31420a1ee1&uam='+accessModulePk+'&uat='+accessType;
      this.postParams = {
        'userPk':this.encrypt.encrypt(this.userPk),
        'userAccess':permissionarray
      };
      this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
          if(data['data'].status == 0){
            swal({
              title: 'Warning',
              text: data['data'].msg,
              icon: 'warning',
            });
          }else{
            if(data['data'].status == 100){
              // this.swalData = {
              //   "msg":'User details updated successfully',
              //   "status":'success'
              // }
              this.showSuccess();
              this.draweruserlallocationnew.toggle();
            }else{
              this.hideResponseLoader.emit(false);
              this.swalData = {
                "msg":data['data'].msg,
                "status":(data['data'].status == '100')?'success':'warning'
              }
            }
            if(!this.hideUserSuccessPopup){
              this.sweetalert(this.swalData);
            }
          }
        }.bind(this)
      );

      // this.finalpermissionarray = permissionarray;
      // this.departmentPermData.emit(permissionarray);
      // this.draweruserlallocationnew.toggle();
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
  animationState2 = 'out';
  animationState3 = 'out';
  showSuccess(){
    this.toastr.success('everything is broken', 'Success !', {
        timeOut: 3000,
    });
  }
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
      this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
    else if (divName === 'userroleallocation') {
      this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
  }
  }

  moduleToggle(event, module_id, accessType){
    if(event.checked == true){
      let activeReadCnt = 0;
      let totalCnt = 0;
      this.moduleIdsArr[module_id].forEach((item, index) => {
        totalCnt = totalCnt + 1;
        if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+accessType))){
          (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+accessType)).checked = true;
        }

        if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_2"))){
          (<HTMLInputElement>document.getElementById("uamodule_" + item + "_2")).checked = true;
          activeReadCnt = activeReadCnt + 1;
        }
      });

      if(activeReadCnt == totalCnt){
        var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+module_id+'-2');
        tgleReadChked.classList.add("mat-checked");
      }
    }else{
      this.moduleIdsArr[module_id].forEach((item, index) => {
        if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+accessType))){
          (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+accessType)).checked = false;
        }
        if(accessType == 2){
          for(let i=1; i<=6;i++){
            if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i)).checked = false;
            }
            var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+module_id+'-'+i);
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
      if((<HTMLInputElement>document.getElementById("uamodule_" + module_id + "_2"))){
        (<HTMLInputElement>document.getElementById("uamodule_" + module_id + "_2")).checked = true;
      }
      this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
        totalCnt = totalCnt + 1;
        if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+accessType))){
          if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+accessType)).checked == true){
            activeCnt = activeCnt + 1;
          }
        }
        if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_2"))){
          if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_2")).checked == true){
            activeReadCnt = activeReadCnt + 1;
          }
        }
      });

      if(activeCnt == totalCnt){
        var tgle = <HTMLInputElement>document.getElementById('uamm-'+splitModule[0]+'-'+accessType);
        tgle.classList.add("mat-checked");
        var tgleReadChecked = <HTMLInputElement>document.getElementById('uamm-'+splitModule[0]+'-2');
        tgleReadChecked.classList.add("mat-checked");
      }
      if(activeReadCnt == totalCnt){
        var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+splitModule[0]+'-2');
        tgleReadChked.classList.add("mat-checked");
      }
    }else{
      const enToggle = (<HTMLInputElement>document.getElementById("uamm-"+splitModule[0]+"-"+accessType));
      enToggle.classList.remove("mat-checked");

      if(accessType == 2){
        this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
          if(module_id == item){
            for(let i=1; i<=6;i++){
              if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i))){
                (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i)).checked = false;
              }

              const allToggle = (<HTMLInputElement>document.getElementById("uamm-"+splitModule[0]+"-"+i));
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
            
            if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i)).checked = true;
            }
          }
        });
      });

      convertModArr.forEach((index) =>{
        for(let i=1;i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+index+'-'+i);
          tgleReadChked.classList.add("mat-checked");
        }
        if((<HTMLInputElement>document.getElementById("uamodule_" + index))){
          (<HTMLInputElement>document.getElementById("uamodule_" + index)).checked = true;
        }
      });
    }else{
      convertArr.forEach((subModArr,mainIndex) => {
        subModArr[0].forEach((item,subIndex) => {
          for(let i=1;i<=6;i++){
            var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+item+'-'+i);
            tgleReadChked.classList.remove("mat-checked");

            if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i)).checked = false;
            }
          }
        });
      });
      convertModArr.forEach((index) =>{
        for(let i=1;i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+index+'-'+i);
          tgleReadChked.classList.remove("mat-checked");
          
        }
        if((<HTMLInputElement>document.getElementById("uamodule_" + index))){
          (<HTMLInputElement>document.getElementById("uamodule_" + index)).checked = false;
        }
      });
    }
  }

  checkAllModule(event,moduleId){
    if(event.target.checked == true){
      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for(let i=1; i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+moduleId+'-'+i);
            tgleReadChked.classList.add("mat-checked");
          if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i))){
            (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i)).checked = true;
          }
        }
      });
    }else{
      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for(let i=1; i<=6;i++){
          var tgleReadChked = <HTMLInputElement>document.getElementById('uamm-'+moduleId+'-'+i);
            tgleReadChked.classList.remove("mat-checked");
          if((<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i))){
            (<HTMLInputElement>document.getElementById("uamodule_" + item + "_"+i)).checked = false;
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

  sweetalert(data)
  {
    swal({
      text:data.msg,
      icon:data.status,
    }).then((value)=>{
        
    });
  }

  userModuleAccess(UserId, moduleId){
    this.userPk = UserId;
    this.postParams = {
      'userPk':this.encrypt.encrypt(UserId)
    };
    this.postUrl = 'ea/user/stk-update-user-details?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
            if(data['data'].status == 100){
              this.dataSourceforpermission = new MatTableDataSource(data['data'].data.baseModulesAccess);
              this.moduleIdsArr = data['data'].data.modSubModIds;
              this.tempStoring = data['data'].data.baseModulesAccess;
            }
        }.bind(this)
    );
  }

}
