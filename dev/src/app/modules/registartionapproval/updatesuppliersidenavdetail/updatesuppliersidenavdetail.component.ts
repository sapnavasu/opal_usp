import { Component, OnInit, Input, ViewChild, SimpleChanges, Output, EventEmitter, Inject, ViewEncapsulation } from '@angular/core';
import swal from 'sweetalert';
import { FormGroup, Validators, FormBuilder, FormControl } from '@angular/forms';
import {CdkTextareaAutosize} from '@angular/cdk/text-field';
import {NgZone} from '@angular/core';
import {take, startWith, map} from 'rxjs/operators';
import { Observable } from 'rxjs';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { ErrorStateMatcher } from '@angular/material/core';
import { Filee } from '@app/@shared/filee/filee';
import { AfterloginService } from '@app/modules/accountsettings/afterlogin.service';
import { EnterpriseService } from '@app/modules/enterpriseadmin/enterprise.service';
import { CustomValidators } from 'ng2-validation';
import { UserallocationComponent } from '@app/@shared/sidepanel/userallocation/userallocation.component';
import { PaymentmapuserComponent } from '../paymentmapuser/paymentmapuser.component';
import { Encrypt } from '@app/common/class/encrypt';
import { DOCUMENT } from '@angular/common';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-updatesuppliersidenavdetail',
  templateUrl: './updatesuppliersidenavdetail.component.html',
  styleUrls: ['./updatesuppliersidenavdetail.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class UpdatesuppliersidenavdetailComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @Output('showLoader') showLoader: any = new EventEmitter<any>();
  public updatesupplierinfo = false;
  public accountsettingForm: FormGroup;
  animationState: string = "out";
  @ViewChild('drawer') drawer: MatDrawer;
  @ViewChild('addUpdateAccess') addUpdateAccess: UserallocationComponent;
  @ViewChild('draweruserallocation') draweruserallocation: MatDrawer;
  @Input() settingsData: any;
  contentObj: any = {
    sideNavHeading: this.i18n('tsupdatesupplierreg.seluser'),
    firstTabSubmitButtonName: this.i18n('tsupdatesupplierreg.map'),
    secondTabSubmitButtonName: this.i18n('tsupdatesupplierreg.add'),
    infoIconText: this.i18n('tsupdatesupplierreg.tranyouadmrol'),
    firstTabSubText: this.i18n('tsupdatesupplierreg.mapanexiuser'),
    secondTabSubText: this.i18n('tsupdatesupplierreg.addnewuser'),
    clearText:this.i18n('tsupdatesupplierreg.clear') 
  }
  ischangeadmin:any;
  public userPermission:any = [];
  myControl = new FormControl();
  updateoption: string[] = [
    this.i18n('tsupdatesupplierreg.creatanewdimwith'),
    this.i18n('tsupdatesupplierreg.creameminthdim') ,
    this.i18n('tsupdatesupplierreg.somexaofappove') ,
    this.i18n('tsupdatesupplierreg.assinproptothesmart'),
    this.i18n('tsupdatesupplierreg.enabsmartlist'),
    this.i18n('tsupdatesupplierreg.usesmartlist'),
 ];
  
  animationState1 = 'out';
  updatecontacts:any;
  classificationDtl:any;
  public buttonname: string = this.i18n('tsupdatesupplierreg.updat');
  public showChangeclassification: boolean = false;
  @Input('updatesupplierdrawer') updatesupplierdrawer: MatDrawer;
  @Input('compdetails') compdetails: any;
  @Output('refeshgrid') refeshgrid: any = new EventEmitter<any>();
  // @Input('drawer') drawer: MatDrawer;
  @ViewChild('updateinfo') updateinfo: Filee;
  @ViewChild('mapuserpriymary') mapuserpriymary:PaymentmapuserComponent;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  @Input('type') type: any;
  confirmcnt:any='';
  public updateinfoForm: FormGroup;
  updateOptions: Observable<string[]>;
  drvInput: { fileMstPk: number; selectedFilesPk: any[]; };
  constructor(private fb: FormBuilder,private _ngZone: NgZone,private profileService: ProfileService,private afterloginService:AfterloginService,private enterpriseService:EnterpriseService, private encryptClass: Encrypt, @Inject(DOCUMENT) private _document: Document,
  private translate: TranslateService,
  private remoteService: RemoteService,
  private cookieService: CookieService,) { }
  headcount:any;
  annualSale:any;
  enterpriseClass:any;
  enterpriseClassfyclass:any;
  currrency:any;
  totalamount:any;
  selectheadcount:any;
  selectsubscriptfee:any='';
  selectannual:any;
  selectackage:any;
  memcompk:any;
  userList:any;
  userListBackup:any;
  selectuserpk:any;
  regpk:any;
  userpk:any;
  stktype:any;
  compdetail:any;
  disablebtn:boolean=false;
  incorpstylelist: any=[];
  isRenewalTemp: number = 0;

  

  ngOnChanges(changes: SimpleChanges): void {
    this.updateCompanyDetails(this.compdetails);
  }
  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
  });
    this.drvInput = {
      fileMstPk:81,
      selectedFilesPk:[] 
    };
    this.updateinfoForm = this.fb.group({
      companyname:["",Validators.required],
      companyname_ar:["",null],
      companyemail: ["", Validators.required],
      headcount:["",null],
      annualsale:["",null],
      subscriptionfee:["",null],
      updatein:["",null],
      incorpstyle:["",null],
      amount:["",null],
      year:["",null],
      updatefileupload:["",null],
      //comments:["",Validators.required],
      comments:["",Validators.required],
      compk:["",null],
      userpk:["",null],
      classificationpk:["",null],
      subcriptionpk:["",null],
      classify:["",null],
      depart:["",null],
      permission:["",null],
      exuserpk:["",null],
    });
    this.updateOptions = this.myControl.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
    this.getClassificationDtl();
    if(this.type==6){
      this.confirmcnt = this.i18n('tsupdatesupplierreg.suppli');
    }else{
      this.confirmcnt = this.i18n('tsupdatesupplierreg.indusorg');
    }
  }
  get f1() { return this.updateinfoForm.controls; }

  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.updateoption.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }
  onFocusOutEventcomp(event){
    if (event.target.value.length != 0 && event.target.value != null) {
      let encregpk = this.encryptClass.encrypt(this.regpk);
      this.afterloginService.checkcompanynameandemailvalid(event.target.value,encregpk,1,this.stktype).subscribe(data => {
        if(data['data'].status == 1){
          this.updateinfoForm.controls.companyname.setErrors({duplicateValue:true}); 
        }else{
          this.updateinfoForm.controls.companyname.setErrors(null);  
        }
      });
    }    
  }
  onFocusOutEventemail(event){
    if (event.target.value.length != 0 && event.target.value != null) {
      let encregpk = this.encryptClass.encrypt(this.userpk);
      this.afterloginService.checkcompanynameandemailvalid(event.target.value,encregpk,2,this.stktype).subscribe(data => {
        if(data['data'].status == 1){
          this.updateinfoForm.controls.companyemail.setErrors({duplicateValue:true}); 
        }else{
          this.updateinfoForm.controls.companyemail.setErrors(null);  
        }
      });
    }    
  }
  updateCompanyDetails(compdetail){
    this.showChangeclassification = false;
    this.compdetail = compdetail; 
   
    
  }

  getClassificationDtl() {
    this.afterloginService.getClassificationDetails().subscribe(data => {
      this.classificationDtl = data['data'].classification;
    })
  }
  checkRenewalTemp(comppk) {
    this.afterloginService.getrenewtemp(comppk).subscribe(data => {
      this.isRenewalTemp = data['data'].status;
    })
  }
  getIncorpStyleList(countrypk, stakeholderType?: any) {
    this.profileService.getincorpstyle(countrypk, stakeholderType).subscribe(data =>{
      this.incorpstylelist = data['data'].items;
    });
  }
  
  triggerResize() {
    this._ngZone.onStable.pipe(take(1))
        .subscribe(() => this.autosize.resizeToFitContent(true));
  }
  showSweetupdatesupplieralert() {
    if(this.updateinfoForm.touched){
      swal({
        title:this.i18n('tsupdatesupplierreg.doyouwanttocan')+ this.confirmcnt +this.i18n('tsupdatesupplierreg.info'),
        text: this.i18n('tsupdatesupplierreg.allthedatathat'),
        icon:'warning',
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: [this.i18n('tsupdatesupplierreg.canc'), this.i18n('tsupdatesupplierreg.ok')],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {        
          this.cancelupdatebtn();
          this.animationState1 = 'out';
        }
      });
    }else{
      this.cancelupdatebtn();
      this.animationState1 = 'out';
    }   
  }
  cancelupdatebtn(){   
    this.updateinfoForm.controls['headcount'].reset();
    this.updateinfoForm.controls['annualsale'].reset();
    this.updateinfoForm.controls['annualsale'].setValidators(null);
    this.updateinfoForm.controls['annualsale'].updateValueAndValidity();
    this.updateinfoForm.controls['headcount'].setValidators(null);
    this.updateinfoForm.controls['headcount'].updateValueAndValidity();
    this.updateinfoForm.reset();
    this.mapuserpriymary.selectedPk = '';
    this.selectsubscriptfee = '';
    this.drvInput.selectedFilesPk= [];
    setTimeout(()=> this.updateinfo.triggerChange(),500);
    this.updatesupplierdrawer.toggle();
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }
  updatesupplierdropdown(divName: string) {
    if (divName === 'updatelistview') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
    
  }
  onSelection(event)
  {
    this.selectheadcount=this.updateinfoForm.controls['headcount'].value;
    this.selectannual=this.updateinfoForm.controls['annualsale'].value;
    this.getPackageDtls();
  }  
  mandatorycheck(type){
    if(type == 1){
      this.updateinfoForm.controls['annualsale'].setValidators([Validators.required]);
      this.updateinfoForm.controls['annualsale'].updateValueAndValidity();
      this.updateinfoForm.controls['subscriptionfee'].setValidators([Validators.required]);
      this.updateinfoForm.controls['subscriptionfee'].updateValueAndValidity();
    }else{
      this.updateinfoForm.controls['headcount'].setValidators([Validators.required]);
      this.updateinfoForm.controls['headcount'].updateValueAndValidity();
      this.updateinfoForm.controls['subscriptionfee'].setValidators([Validators.required]);
      this.updateinfoForm.controls['subscriptionfee'].updateValueAndValidity();
    }  
    // this.updateinfoForm.controls['comment'].setValidators(null);
  }
  submitform(){    
    swal({
      title: this.i18n('tsupdatesupplierreg.doyouwanttoupdat') +this.confirmcnt + this.i18n('tsupdatesupplierreg.sinfo'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('tsupdatesupplierreg.no'), this.i18n('tsupdatesupplierreg.yes')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {        
        this.updatesupplierinfo=true;
        this.showLoader.emit(true);
        this.disablebtn = true;
        this.afterloginService.formsubmit(this.updateinfoForm.value).subscribe(data => {
          this.getPackageDtls();
          this.updateinfoForm.reset();
          this.drvInput = {
            fileMstPk:81,
            selectedFilesPk:[] 
          };
          setTimeout(() => {
            this.updateinfo.triggerChange();
          }, 1000);
          this.refeshgrid.emit(false);
          swal(this.i18n('tsupdatesupplierreg.succ'),this.i18n('tsupdatesupplierreg.compdetupdat'), this.i18n('tsupdatesupplierreg.succ'));
          this.disablebtn = false;
          this.updatesupplierdrawer.toggle();
          this.showLoader.emit(false);
          this.updatesupplierinfo=false;
          this._document.defaultView.location.reload();
        });
      }
    });       
  }
  getPackageDtls() {
    if(this.selectheadcount && this.selectannual) {
      this.showChangeclassification = true;
      this.afterloginService.getPackageBystktype(this.selectheadcount, this.selectannual,this.stktype).subscribe(data => {
        this.selectackage = data['data'];
        this.updateinfoForm.controls['classificationpk'].patchValue(this.selectackage.classicationPk);
        this.updateinfoForm.controls['subcriptionpk'].patchValue(this.selectackage.subscription.subscriptionPk);
        this.updateinfoForm.controls['amount'].patchValue(this.selectackage.subscription.packageBasePrice);
        this.updateinfoForm.controls['year'].patchValue(this.selectackage.subscription.duration.Years);
        this.updateinfoForm.controls['classify'].patchValue(this.selectackage.classificationName);
        this.selectsubscriptfee = this.selectackage.subscription.packageBasePrice;
      });
    }
  }
  stakeholderUserDetails(compk) {
    let postUrl = 'ea/user/users-by-deptbackend';
    let postParam = [{compk:compk }];
    this.enterpriseService.enterpriseService(postParam, postUrl).subscribe(data => {
      if (data['data'].status == 100) {
        this.userList = data['data'].data;
        this.mapuserpriymary.paymentuserloader=false;
        this.userListBackup = data['data'].data;
      }
    });
  }
  selectuser($event)
  {    
    this.afterloginService.getuserdtls($event[0]).subscribe(data => {
      this.updatecontacts = [
        {contacttitle:data['data'].firstName,contactsubtitle:data['data'].designation,mobilenum:data['data'].mobile,contactemail:data['data'].emailId,userdp:data['data'].userdp},
      ];
      this.updateinfoForm.controls['companyemail'].patchValue(data['data'].emailId);
      this.updateinfoForm.controls['userpk'].patchValue(data['data'].userpk);
      this.updateinfoForm.controls['depart'].patchValue($event[1]);
      this.updateinfoForm.controls['permission'].patchValue($event[2]);
      this.userpk = data['data'].userpk;
    });
  }

  showLoaderOutput(event) {
    this.showLoader.emit(event);
  }
  userdata(){
    this.mapuserpriymary.paymentuserloader=true;
    this.drawer.toggle();        
    setTimeout(() => {
      this.mapuserpriymary.searchUserOrDept();
    }, 500);  
  }
}
