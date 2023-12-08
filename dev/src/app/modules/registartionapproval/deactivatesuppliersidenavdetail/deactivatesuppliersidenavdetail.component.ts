import { Component, OnInit, Input, ViewChild, Output, EventEmitter } from '@angular/core';

import swal from 'sweetalert';

import {CdkTextareaAutosize} from '@angular/cdk/text-field';
import {NgZone} from '@angular/core';
import {take} from 'rxjs/operators';
import {startWith, map} from 'rxjs/operators';
import { Observable } from 'rxjs';
import { FormControl, FormGroup, Validators, FormBuilder } from '@angular/forms';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatDrawer } from '@angular/material/sidenav';
import { ApprovalService } from '../approval.service';
import { ToastrService } from 'ngx-toastr';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-deactivatesuppliersidenavdetail',
  templateUrl: './deactivatesuppliersidenavdetail.component.html',
  styleUrls: ['./deactivatesuppliersidenavdetail.component.scss'],
  animations: [SlideInOutAnimation],
})
export class DeactivatesuppliersidenavdetailComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  public deleteview:boolean = true;
  updateOptions: Observable<string[]>;
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  @Input('deactivatesupplierdrawer') deactivatesupplierdrawer: MatDrawer;
  @Output() isshowdeactivateslider: any = new EventEmitter<any>();  
  @Output('showLoader') showLoader: any = new EventEmitter<any>();
  @Output() reloadgrid: any = new EventEmitter<any>();  
  @Input('type') type: any;
  animationState3 = 'out';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public buttonname: string = 'Deactivate';
  public deactivateForm: FormGroup;
  confirmcnt:any='';
  constructor(private _ngZone: NgZone,private fb: FormBuilder,public approvalservice: ApprovalService,public toastr: ToastrService,private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }
  myControl = new FormControl();
  public supplierdata :any;
  disablebtn:boolean = false;

  updateoption: string[] = [
  this.i18n('tsdeactivatesuppliersidenavdetail.creaanewdimen'),
  this.i18n('tsdeactivatesuppliersidenavdetail.creatmeminthedim'),
  this.i18n('tsdeactivatesuppliersidenavdetail.somexamofappro'),
  this.i18n('tsdeactivatesuppliersidenavdetail.asingproptothe'),
  this.i18n('tsdeactivatesuppliersidenavdetail.enabsmartlist'),
  this.i18n('tsdeactivatesuppliersidenavdetail.usesmartlist'),
 ];

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
       this.buttonname = "Deactivate";
      }else{
        this.buttonname = "Deactivate";
      }
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.buttonname = "Deactivate";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if(toSelect.languagecode == 'en'){
          this.buttonname = "Deactivate";
         }else{
          this.buttonname = "Deactivate";
         }
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.buttonname = "Deactivate";
      }
	  
      });
    this.approvalservice.getstkdeactivatetemplate().subscribe(data => {
      this.updateoption = data['data'];
      this.updateOptions = this.myControl.valueChanges.pipe(
        startWith(''),
        map(value => this._filter(value))
      );
    });
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
  });
    
    this.deactivateForm = this.fb.group({
      comments:["",Validators.required],
      registrationid:["",Validators.required],
      status:["",Validators.required],
    });
    if(this.type==6){
      this.confirmcnt = this.i18n('tsdeactivatesuppliersidenavdetail.supli');
    }else{
      this.confirmcnt = this.i18n('tsdeactivatesuppliersidenavdetail.indusorg');
    }
  }
  
  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.updateoption.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }
  supplierdeactivatepatchvalue(data){
    this.supplierdata = data;
    this.deactivateForm.controls['registrationid'].setValue(data.registrationid);
    this.deactivateForm.controls['status'].setValue('BC');
    // this.loader = false;
    this.deleteview=false;
    this.showLoader.emit(false);
  }
  submitdata(){    
    swal({
      title: this.i18n('tsdeactivatesuppliersidenavdetail.doyouwantdeact')+this.confirmcnt+"?",
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('tsdeactivatesuppliersidenavdetail.No'), this.i18n('tsdeactivatesuppliersidenavdetail.Yes')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        if (this.deactivateForm.valid) {
          this.showLoader.emit(true);
          this.disablebtn = true;
          this.approvalservice.deactivateordeletesupplier(this.deactivateForm.value).subscribe(res => {
            if(res['data'].statuscode == 100){              
              this.deactivateForm.reset();
              this.deactivatesupplierdrawer.toggle();
              this.isshowdeactivateslider.emit(false);
              this.reloadgrid.emit(true);
              this.disablebtn = false;
              this.showLoader.emit(false);
              this.showTSuccess(this.confirmcnt+this.i18n('tsdeactivatesuppliersidenavdetail.deactsucc'));
            }else{
              this.showLoader.emit(false);
              this.disablebtn = false;
              this.showWSuccess(this.i18n('tsdeactivatesuppliersidenavdetail.somwentwrong'));
            }
          });
        }
      }
    }); 
    
  }
   Deactivatesupplieralert() {
     if(this.deactivateForm.touched){
      swal({
        title: this.i18n('tsdeactivatesuppliersidenavdetail.doyouwantthecabc')+this.confirmcnt+this.i18n('tsdeactivatesuppliersidenavdetail.acc'),
        text: this.i18n('tsdeactivatesuppliersidenavdetail.allthedatathat'),
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: [this.i18n('tsdeactivatesuppliersidenavdetail.canc'), this.i18n('tsdeactivatesuppliersidenavdetail.ok')],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          this.supplierdata = [];
          this.deactivateForm.reset();
          this.deactivatesupplierdrawer.toggle();
          this.isshowdeactivateslider.emit(false);
          this.animationState3 = 'out';
        }
      });
    }else{
      this.supplierdata = [];
      this.deactivateForm.reset();
      this.deactivatesupplierdrawer.toggle();
      this.isshowdeactivateslider.emit(false);
      this.animationState3 = 'out';
    }        
  }
  clearcomment(){
    this.deactivateForm.controls['comments'].reset();
  }
  Deactivateview(divName: string) {
    if (divName === 'deactivatelistview') {
      this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
    }
    
  }
  triggerResize() {
    this._ngZone.onStable.pipe(take(1))
        .subscribe(() => this.autosize.resizeToFitContent(true));
  }
  showTSuccess(data){
    this.toastr.success(data, this.i18n('tsdeactivatesuppliersidenavdetail.succ'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showWSuccess(data){
    this.toastr.warning(data, this.i18n('tsdeactivatesuppliersidenavdetail.warn'), {
        timeOut: 3000,
        closeButton: true,
    });
}
}
