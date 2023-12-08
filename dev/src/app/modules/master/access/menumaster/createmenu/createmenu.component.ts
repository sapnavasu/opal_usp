import { Component, OnInit, Input, ChangeDetectorRef, ViewChild, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormGroupDirective } from '@angular/forms';
import swal from 'sweetalert';
import { ManagemenuComponent } from '../managemenu/managemenu.component';
import {FormControl} from '@angular/forms';
import { EnterpriseService } from '@lypis_core/enterpriseadmin/enterprise.service';
import { Encrypt } from '@lypis_config/common/class/encrypt';
import { Filee } from '../../../../config_files/common_files/common/filee/filee';
import { DriveInput } from '@lypis_config/common_files/classes/driveInput';
import { MatDrawer } from '@angular/material';
import { ErrorStateMatcher } from '@angular/material/core';


@Component({
  selector: 'app-createmenu',
  templateUrl: './createmenu.component.html',
  styleUrls: ['./createmenu.component.scss']
})
export class CreatemenuComponent implements OnInit {
  matcher = new ErrorStateMatcher();
  menuTypes = new FormControl(['',Validators.required]);

  toppingList: string[] = ['Extra cheese', 'Mushroom', 'Onion', 'Pepperoni', 'Sausage', 'Tomato'];

  submitted= false;
  public editid:any;
  @Input() tog: MatDrawer;
  @Input() edit;
  createbutton:boolean=true;
  updatebutton:boolean=false;
  formParms:any;

  cityid = null; 
  public menuMasterForm: FormGroup;

  /* Sar Integration */
  public stakeholderType:any = [];
  public postParams:any;
  public postUrl:any;
  public buttonName:any;
  public titleName:any;
  public menuType:any = [
    {'typeValue':'L','typeName':'Left'},
    {'typeValue':'R','typeName':'Right'},
    {'typeValue':'T','typeName':'Top'},
    {'typeValue':'B','typeName':'Bottom'}
  ];
  public menuValues:any = {
    'L':'Left','R':'Right','T':'Top','B':'Bottom'
  };
  public rootMenu:any = [];
  public moduleData:any = [];
  @ViewChild(Filee) filee:Filee;
  @Output() menuAddData:any = new EventEmitter<any>();

  //Drive
  public drvInput:DriveInput;
  @ViewChild('menuReset') menuReset:FormGroupDirective;

  constructor(
    private fb: FormBuilder,
    private enterpriseService:EnterpriseService,
    private encrypt: Encrypt,
  ) {}

  ngOnInit() {
    /* Form Initialize */ 
    this.menuMasterForm = this.fb.group({
      menuPk:[null,null],
      moduleName:[null,Validators.compose([Validators.required,Validators.maxLength(50)])],
      menuName:[null,[Validators.required]],
      stkholderType:[null,[Validators.required]],
      rootMenu:[null,[Validators.required]],
      menuUrl:[null,null],
      menuOrder:[null,[Validators.required, Validators.min(1)]],
      menuTypenew:[null, [Validators.required]],
      menuTooltip:[null,null],
      menuIcon:['',''],
      menuStatus:[null,null],
    });
    this.initalData();
    this.buttonName = 'Add';
    this.titleName = 'Add Menu Master';

    this.drvInput = {
      fileMstPk:35,
      selectedFilesPk:[] //Already inserted pk
    };

  }
  get f() { return this.menuMasterForm.controls; }

  initalData(){
    this.postParams = {};
    this.postUrl = 'acm/stkholderaccessmaster/getstkholdertypes?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
    this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        if(data.status == 200){
          this.stakeholderType = data.data;
        }
      }.bind(this)
    );
  }

  menuEditData(menuPk){
    
    this.postParams = {
      'menuPk': this.encrypt.encrypt(menuPk)
    };
    this.postUrl = 'mst/menumaster/fetch-menu-detail';
    this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        if(data['data'].status == 100){
          this.stakeholderType = data['data'].data.stkholderTypeDetails;
          this.rootMenu = data['data'].data.menuDetails;
          this.moduleData = data['data'].data.modSmodDetails;
          this.menuMasterForm.patchValue({
            'menuPk':data['data'].data.menuDetail.menuPk,
            'stkholderType':data['data'].data.menuDetail.stkholderType,
            'menuName':data['data'].data.menuDetail.menuName,
            'rootMenu':(data['data'].data.menuDetail.menuFk > 0)?data['data'].data.menuDetail.menuFk:'Root',
            'moduleName':data['data'].data.menuDetail.modulePk,
            'menuUrl':data['data'].data.menuDetail.menuUrl,
            'menuOrder':data['data'].data.menuDetail.order,
            'menuTooltip':data['data'].data.menuDetail.toolTip,
            'menuIcon':data['data'].data.menuDetail.menuIcon,
            'menuStatus':(data['data'].data.menuDetail.status == 1)?true:false,
            'menuTypenew':data['data'].data.menuDetail.menuType
          });
          //this.menuTypes.setValue(data['data'].data.menuDetail.menuType);
          this.buttonName = 'Update';
          this.titleName = 'Update Menu Master';
          this.drvInput ={
            fileMstPk:35,
            selectedFilesPk:data['data'].data.menuDetail.menuIcon //Already inserted pk
          };
          setTimeout(()=> this.filee.triggerChange(),1000);
          this.tog.toggle();
        }else{
          swal({
            text:data['data'].msg,
            icon:'warning',
          });
        }
      }.bind(this)
    );
  }

  stkChange(event){
    this.menuMasterForm.controls['moduleName'].reset();
    this.menuMasterForm.controls['rootMenu'].reset();

    this.postParams = {
      'stkholderType': this.encrypt.encrypt(event.value)
    };
    this.postUrl = 'mst/menumaster/get-menu-modules';
    this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        if(data['data'].status == 100){
          this.rootMenu = data['data'].data.menuDetails;
          this.moduleData = data['data'].data.modSmodDetails;
        }
      }.bind(this)
    );
  }

  submitMenu(){
    if(this.menuMasterForm.valid){
      let updateTxt = 'Created Successfully';
      if(this.menuMasterForm.controls['menuPk'].value > 0){
        updateTxt = 'Updated Successfully';
      }
      let menuPkId = this.menuMasterForm.controls['menuPk'].value;
      this.postParams = {
        'menuPk':this.encrypt.encrypt(this.menuMasterForm.controls['menuPk'].value),
        'stakeholderType': this.menuMasterForm.controls['stkholderType'].value,
        'menuName': this.menuMasterForm.controls['menuName'].value,
        'modSubModFk': this.menuMasterForm.controls['moduleName'].value,
        'rootMenu': (this.menuMasterForm.controls['rootMenu'].value == 'Root')?0:this.menuMasterForm.controls['rootMenu'].value,
        'menuUrl': this.menuMasterForm.controls['menuUrl'].value,
        'menuOrder': this.menuMasterForm.controls['menuOrder'].value,
        'menuType': this.menuMasterForm.controls['menuTypenew'].value,
        'menuToolTip': this.menuMasterForm.controls['menuTooltip'].value,
        'menuStatus': this.menuMasterForm.controls['menuStatus'].value,
        'menuIcon': this.menuMasterForm.controls['menuIcon'].value,
      };
      this.postUrl = 'mst/menumaster/save-menu';
      this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
          if(data['data'].status == 100){
            // this.swalData = {
            //   "msg":updateTxt,
            //   "status":'success'
            // }
            swal({
              title: 'Success!',
              text:updateTxt,
              icon:'success',
            });
            this.menuReset.resetForm();
            //this.menuTypes.setValue('');
            this.drvInput ={
              fileMstPk:35,
              selectedFilesPk:[] //Already inserted pk
            };
            setTimeout(()=> this.filee.triggerChange(),1000);
            this.tog.toggle();
            this.buttonName = 'Add';
            this.titleName = 'Add Menu Master';
            if(menuPkId > 0){
              this.menuAddData.emit('2');
            }else{
              this.menuAddData.emit('1');
            }
          }else{
            swal({
              text:data['data'].msg,
              icon:'warning',
            });
          }
        }.bind(this)
      );
    }
  }

  claseCreatTab(){

  }

  toggle(){
    this.menuMasterForm.reset();
    this.tog.toggle();
  }

  sweetalert(data)
  {
    swal({
      text:data.msg,
      icon:data.statusmsg,
    }).then((value)=>{
        if(data.flag =="S")
        {
          
        }
        else {
        }
    });
  }

  /* DRIVE upload Starts */
  fileeSelected(file,fileId){
    fileId.selectedFilesPk = file;
  }

  clearMenuForm(){
    let menuPk = this.menuMasterForm.controls['menuPk'].value;
    this.menuReset.resetForm();
    this.menuMasterForm.controls['menuPk'].setValue(menuPk);
    //this.menuTypes.setValue('');
    this.drvInput ={
      fileMstPk:35,
      selectedFilesPk:[] //Already inserted pk
    };
    setTimeout(()=> this.filee.triggerChange(),1000);
  }

  closeMenuTab(){
    if(this.menuMasterForm.touched){
      swal({
        text:'Are you sure you want to cancel? If yes all the data will be lost',
        icon: 'warning',
        buttons: ['Cancel', 'Ok'],
        dangerMode: true,
      }).then((willGoBack) => {
        if(willGoBack){
          this.menuReset.resetForm();
          //this.menuTypes.setValue('');
          this.drvInput ={
            fileMstPk:35,
            selectedFilesPk:[] //Already inserted pk
          };
          setTimeout(()=> this.filee.triggerChange(),1000);
          this.tog.toggle();
          this.buttonName = 'Add';
          this.titleName = 'Add Menu Master';
        }
      });
    }else{
      this.tog.toggle();
      this.buttonName = 'Add';
      this.titleName = 'Add Menu Master';
    }
  }

}
