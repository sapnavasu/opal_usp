import { Component, OnInit, Input, ChangeDetectorRef } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import swal from 'sweetalert';
import { ManagebasemoduleComponent } from '../managebasemodule/managebasemodule.component';

/* Service Call */ 
import { BasemoduleService } from '../service/basemodule.service';
import { from } from 'rxjs';

@Component({
  selector: 'app-createbasemodule',
  templateUrl: './createbasemodule.component.html',
  styleUrls: ['./createbasemodule.component.scss']
})
export class CreatebasemoduleComponent implements OnInit {

  public editid:any;
  @Input() tog:any="";
  @Input() edit;
  @Input() rootModuleList: any = [];
  @Input() accessList: any = [];
  @Input() accessListTemp: any = [];
  accessListTemp2: any = [];
  dupsubmit:boolean=false;
   buttonname:string="Add";
  createbutton:boolean=true;
  updatebutton:boolean=false;
  disableCheckbox: boolean = false;
  statelists:any;
  formParms:any;
  checked:boolean=true;
  selectedValue:number;
  accessArr = [];
  searchbasemodule: string = '';
  showCheckBoxValidation: boolean = false;
  
  cityid = null; 
  public baseModuleForm: FormGroup;
  constructor(
    private fb: FormBuilder,
    protected router: Router,
    private routeid: ActivatedRoute,
    private moduleService: BasemoduleService,
    private mbc:ManagebasemoduleComponent,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnChanges(edit) {
    if(this.edit!=0) { 
         this.startEdit(this.edit);
       }
       
     }
  ngOnInit() {
    // Temp accessList for later use
    this.accessListTemp2 = this.accessListTemp;

    //Adding Root as the first index of the module arr
    this.rootModuleList = [
      {
        basemodulemst_pk: '0',
        bmm_name: 'Root',
      },
      ...this.rootModuleList
    ]

    /* Form Initialize */ 
    this.baseModuleForm = this.fb.group({
      modulePk:[null,''],
      moduleName:[null,Validators.compose([Validators.required,Validators.maxLength(50)])],
      parentModulePk:[null,Validators.compose([Validators.required])],
      domainType:[null,null],
      moduleAccess:[null,[Validators.required]],
      status:[null,null],
    });

    /* Fetching Value for module */
    this.formParms = {
      'status':1
    };


    this.routeid.params.subscribe(params => {
      if(params['id'])
      {
        this.startEdit(params['id'])
      }  
    }); 
  }
  toggle(){
    this.baseModuleForm.reset();
    this.uncheckAllAccess();
    this.tog.toggle();
  }
  startEdit(cid:number)
  {
    this.updatebutton=true;
    this.createbutton=false;
    var obj = { modulePk: cid };
    this.moduleService.fetchesBaseModuleAccess(obj).subscribe(
      data => { 
       this.setFormValue(data['data'].data['moduleData'],data['data'].data['accessMaster'])
      },
      err => console.error(err),
    );
  }
  setFormValue(moduleData: any, accessData: any)
  {
    this.baseModuleForm.controls['moduleAccess'].setValue("");
    moduleData.parentModulePk = (moduleData.parentModulePk == null) ? 0 : moduleData.parentModulePk;
      if(moduleData.status == 1)
      {
        this.checked=true;
      }
      else{
        this.checked=false;
      }
      this.baseModuleForm.patchValue({
        modulePk: moduleData.modulePk,
        moduleName: moduleData.moduleName,
        parentModulePk: String(moduleData.parentModulePk),
        domainType: moduleData.domainType,
        moduleAccess: "",
      });
      this.disableCheckbox = true;
      this.accessList = accessData;
      let accessPatch = this.accessList.map(x => {
        if(x.checked === 'true')
          return x.accessmaster_pk;
      });
      this.accessArr = accessPatch.filter(x => (x != null));
      this.baseModuleForm.controls['moduleAccess'].setValue(accessPatch.filter(x => (x != null)).join(","));
  } 
  

  pushCheckedAccess(pk){
    this.showCheckBoxValidation = true;
    var isAlreadyChecked = this.accessArr.includes(pk);
    if(isAlreadyChecked){
      this.uncheckAccess(pk);
      if(pk == "2"){
        this.uncheckAllAccess();
        //this.accessList = this.accessListTemp;
      }
    }else{
      this.checkAccess(pk);
      if(pk != "2"){
        if(this.accessArr.length == 1){
          this.checkAccess("2");
          this.checkReadandSpecificAccess(pk);
        }else{
          this.checkReadAccess(pk);
        }
      }
    }
    
    this.baseModuleForm.controls['moduleAccess'].setValue(this.accessArr.filter(x => (x != null)).join(", "));
  }

  checkAccess(pk){
    this.accessArr.push(pk);
  }

  uncheckAccess(pk){
    let index = this.accessArr.indexOf(pk);
    this.accessArr.splice(index,1);
  }

  checkReadandSpecificAccess(pk){
    this.accessList.forEach((val, key) => {
      if(val.accessmaster_pk == "2" || val.accessmaster_pk == pk){
        val.checked = 'true';
      }
    });
  }

  checkReadAccess(pk){
    this.accessList.forEach((val, key) => {
      if(val.accessmaster_pk == pk){
        val.checked = 'true';
      }
    });
  }

  uncheckAllAccess(fromForm?:string){
    this.accessList.forEach((val, key) => {
        val.checked = false;
    });
    this.accessArr = [];
    if(fromForm){
      this.showCheckBoxValidation = false;
    }
  }
  
  addBaseModule()
  {
    this.dupsubmit=true;
    this.formParms = {
      'formValues':this.baseModuleForm.value,
      'accessArr':this.accessArr
    };

    let accessType = 1;
    if(this.baseModuleForm.controls['modulePk'].value > 0){
      accessType = 3;
    }

    this.moduleService.saveBaseModule(this.formParms, accessType).subscribe(
      function(data){
        swal({
          text:data['data'].msg,
          icon:(data['data'].flag == "S") ? 'success' : 'warning',
        }).then((value)=>{
          if(data['data'].flag =="S")
          {
            this.accessArr = [];
            this.toggle();
            this.mbc.getRootModule();
            //this.router.navigate(['/access/manage-base-module']);
            }
            else {
              this.dupsubmit=false;
            }
        });
        this.mbc.fetchData();
      }.bind(this)
    );
  }

  moduleBasedAccess(){
    this.accessArr = [];
    this.baseModuleForm.controls['moduleAccess'].setValue("");
    this.disableCheckbox = true;
    let modulePk = this.baseModuleForm.controls['parentModulePk']['value'];
    this.changeRequiredTypes(modulePk);
    if(modulePk > 0){
      this.formParms = {
        'modulePk':modulePk
      }
      this.moduleService.getModuleBasedAccess(this.formParms).subscribe(
        function(data){
          this.accessList = data['data'].data.moduleAccess;
          let accessPatch = this.accessList.map(x => {
            if(x.checked === 'true')
              return x.accessmaster_pk;
          });
          this.accessArr = accessPatch;
          this.baseModuleForm.controls['moduleAccess'].setValue(accessPatch.filter(x => (x != null)).join(", "));
        }.bind(this)
      )
    }else{
      this.disableCheckbox = false;
      this.accessList = this.accessListTemp;
    }
  }

  changeRequiredTypes(value) {
    this.baseModuleForm.controls['domainType'].setValidators(null);
    this.baseModuleForm.controls['domainType'].updateValueAndValidity();
    if(value == 0){
      this.baseModuleForm.controls['domainType'].setValidators([Validators.required]);
      this.baseModuleForm.controls['domainType'].updateValueAndValidity();
    }
  }


  sweetalert(data)
  {
    swal({
      text:data.msg,
      icon:data.statusmsg,
    }).then((value)=>{
        if(data.flag =="S")
        {
          this.router.navigate(['/access/manage-base-module']);
        }
        else {
          this.dupsubmit=false;
        }
    });
  }

}
