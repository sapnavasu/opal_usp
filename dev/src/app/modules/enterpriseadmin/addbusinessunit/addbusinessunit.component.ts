import { ChangeDetectorRef, Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatDrawer } from '@angular/material/sidenav';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import 'rxjs/add/observable/of';
import swal from 'sweetalert';
import { SlideInOutAnimation } from '../animation';
import { DepartmentallocationComponent } from '../departmentallocation/departmentallocation.component';
import { EnterpriseService } from '../enterprise.service';
import {ToastrService} from 'ngx-toastr'
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';

export interface Businessunit {
  value: string;
  viewValue: string;
}
@Component({
  selector: 'app-addbusinessunit',
  templateUrl: './addbusinessunit.component.html',
  styleUrls: ['./addbusinessunit.component.scss'],
  animations: [SlideInOutAnimation]
})
export class AddbusinessunitComponent implements OnInit {
  animationState = 'out';
  searchSector: string = '';
  @Input('addbusinessunit') addbusinessunit: MatDrawer;
  businessunitlist: Businessunit[] = [
    {value: 'value-0', viewValue: 'Agriculture'},
    {value: 'value-1', viewValue: 'Basic Metal Production'},
    {value: 'value-2', viewValue: 'Chemical Industries'},
    {value: 'value-2', viewValue: 'Commerce'},
    {value: 'value-2', viewValue: 'Construction'},
    {value: 'value-2', viewValue: 'Education'},
  ];
  @Input('drawerdepartment') drawerdepartment: MatDrawer;
  addBunitForm: FormGroup;
  @Output() addDeptData:any = new EventEmitter<any>();
  @Output() closeSideNav:any = new EventEmitter<any>();
  @ViewChild('addUpdateDeptAccess') addUpdateDeptAccess:DepartmentallocationComponent;
  public postParams:any;
  public postUrl:any;
  public mcpPk:any;
  public departmentPermission:any = [];
  public swalData:any;
  @Input() logoUrl: any;

  /*Sar Starts*/
  matcher = new ErrorStateMatcher();
  @ViewChild('bunitReset') bunitReset:FormGroupDirective;
  public buttonName:any = 'Add';
  @Output() bunitReload: any = new EventEmitter<any>();
  sectorlist: any = [];

  constructor(
    private formBuilder: FormBuilder,
    private EnterpriseService: EnterpriseService,
    private localstorage: AppLocalStorageServices,
    private encrypt: Encrypt,
    private cdr:ChangeDetectorRef,
    private profileService: ProfileService,
    public toastr: ToastrService,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    
  ) { 
  }

  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
  }); 
    this.mcpPk = this.encrypt.encrypt(this.localstorage.getInLocal('comp_pk'));

    this.addBunitForm = this.formBuilder.group({
      bunitPk:['', ''],
      bunitSector:['', Validators.required],
      bunitName:['',Validators.required],
      bunitDesc:['',Validators.required]
    });

    this.getSectorData();
  }
  
  get f() { return this.addBunitForm.controls; }

  getSectorData(){
    this.postParams = {
    };

    this.profileService.getsectorlist('P').subscribe(data => {
      this.sectorlist = data['data'].items
    })
  }

  toggleShowDiv(divName: string) {
    if(divName === 'descriptioncontentuserrole') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  onSubmit(){
    this.postParams = {
      'bunitPk': this.encrypt.encrypt(this.addBunitForm.controls['bunitPk'].value),
      'bunitSector': this.addBunitForm.controls['bunitSector'].value,
      'bunitName': this.addBunitForm.controls['bunitName'].value,
      'bunitDesc': this.addBunitForm.controls['bunitDesc'].value,
    };
    let bunitPk = this.addBunitForm.controls['bunitPk'].value;
    let alertMsg = 'Business unit created successfully';
    if(bunitPk > 0){
      alertMsg = 'Business unit updated successfully';
    }
    this.postUrl = 'ea/businessunit/save-bunit';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        if(data['data'].status == 100){
          this.showSuccess();
          this.bunitReset.resetForm();
          this.addbusinessunit.toggle();
          this.bunitReload.emit(data['data'].data.bunitPk);
          this.buttonName = 'Add';
        }else{
          swal({
            text:data['data'].msg,
            icon:'warning',
          });
        }
      }.bind(this)
    );
  }

  fetchBunit(bunitPk){
    this.postParams = {
      "bunitPk": this.encrypt.encrypt(bunitPk)
    };
    this.postUrl = 'ea/businessunit/fetch-bunit-detail';
    this.EnterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
      function(data){
        this.addBunitForm.patchValue({
          'bunitPk':data['data'].data.bunitData.bunitPk,
          'bunitSector':data['data'].data.bunitData.bunitSectorFk,
          'bunitName':data['data'].data.bunitData.bunitName,
          'bunitDesc':data['data'].data.bunitData.bunitDesc,
        });
        this.buttonName = 'Update';
      }.bind(this)
    );
  }

  closeBunit(){
    swal({
      text:'Are you sure you want to cancel? If yes all the data will be lost',
      icon: 'warning',
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((beforeClose) => {
      if (beforeClose) {
        this.bunitReset.resetForm();
        this.addbusinessunit.toggle();
        this.buttonName = 'Add';
      }
    }); 
    this.animationState='out';
  }

  clearBunitData(){
    this.bunitReset.resetForm();
  }
  showSuccess(){
    this.toastr.success('everything is broken', 'Success !', {
        timeOut: 3000,
    });
  }
}
