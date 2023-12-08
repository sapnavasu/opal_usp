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
  selector: 'app-deletesuppliersidenavdetail',
  templateUrl: './deletesuppliersidenavdetail.component.html',
  styleUrls: ['./deletesuppliersidenavdetail.component.scss'],
  animations: [SlideInOutAnimation],
})
export class DeletesuppliersidenavdetailComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  updateOptions: Observable<string[]>;
  public deleteview:boolean = true;
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  @Input('deletesupplierdrawer') deletesupplierdrawer: MatDrawer;
  @Output() isshowdeleteslider: any = new EventEmitter<any>();  
  @Output() reloadgrid: any = new EventEmitter<any>();  
  @Output('showLoader') showLoader: any = new EventEmitter<any>();
  animationState3 = 'out';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public buttonname: string = 'Delete';
  public deleteForm: FormGroup;
  constructor(private _ngZone: NgZone,private fb: FormBuilder,public approvalservice: ApprovalService,public toastr: ToastrService,
  private translate: TranslateService,
  private remoteService: RemoteService,
  private cookieService: CookieService,) { }
  myControl = new FormControl();
  public supplierdata :any;
  @Input('type') type: any;
  confirmcnt:any='';
  disablebtn:boolean = false;
  updateoption: string[] = [
  this.i18n('tsdeletesuppliersidenavdetail.creatnewdimen'),
  this.i18n('tsdeletesuppliersidenavdetail.creatmeminthedim'),
  this.i18n('tsdeletesuppliersidenavdetail.somexaofappro'),
  this.i18n('tsdeletesuppliersidenavdetail.assinproptothesmart'),
  this.i18n('tsdeletesuppliersidenavdetail.enabsmarlistfordata'),
  this.i18n('tsdeletesuppliersidenavdetail.usesmartlistvalu'),
 ];
  ngOnInit(){
    this.approvalservice.getstkdeletetemplate().subscribe(data => {
      this.updateoption = data['data'];
      this.updateOptions = this.myControl.valueChanges.pipe(
        startWith(''),
        map(value => this._filter(value))
      );
    });
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
    });
    
    this.deleteForm = this.fb.group({
      comments:["",Validators.required],
      registrationid:["",Validators.required],
      status:["",Validators.required],
    });
    if(this.type==6){
      this.confirmcnt = this.i18n('tsdeletesuppliersidenavdetail.suppl');
    }else{
      this.confirmcnt = this.i18n('tsdeletesuppliersidenavdetail.indusorg');
    }
  }
  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();
    return this.updateoption.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }
  deletesupplierdata(data){
    this.supplierdata = data;
    this.deleteForm.controls['registrationid'].setValue(data.registrationid);
    this.deleteForm.controls['status'].setValue('D');
    this.deleteview=false;
    this.showLoader.emit(false);
  }
  submitdata(){
    swal({
      title: this.i18n('tsdeletesuppliersidenavdetail.doyouwanttocan')+this.confirmcnt+"?",
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('tsdeletesuppliersidenavdetail.No'), this.i18n('tsdeletesuppliersidenavdetail.demo')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        if (this.deleteForm.valid) {
          this.showLoader.emit(true);
          this.disablebtn = true;
          this.approvalservice.deletesupplier(this.deleteForm.value).subscribe(res => {
            if(res['data'].statuscode == 100){             
              this.deleteForm.reset();
              this.deletesupplierdrawer.toggle();
              this.isshowdeleteslider.emit(false);
              this.reloadgrid.emit(true);
              this.disablebtn = false;
              this.showLoader.emit(false);
              this.showTSuccess(this.confirmcnt+this.i18n('tsdeletesuppliersidenavdetail.delsucc'));
            }else{
              this.showLoader.emit(false);
              this.showWSuccess(this.i18n('tsdeletesuppliersidenavdetail.somtwenwron'));
              this.disablebtn = false;
            }
          });
        }
      }
    });     
  }
  Deactivatesupplieralert() {
    if(this.deleteForm.touched){
      swal({
        title: this.i18n('tsdeletesuppliersidenavdetail.doyouwantcancthi')+this.confirmcnt+this.i18n('tsdeletesuppliersidenavdetail.acc'),
        text: this.i18n('tsdeletesuppliersidenavdetail.allthedataente'),
        icon: 'warning',
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: [this.i18n('tsdeletesuppliersidenavdetail.canc'), this.i18n('tsdeletesuppliersidenavdetail.Ok')],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          this.supplierdata = [];
          this.deleteForm.reset();
          this.deletesupplierdrawer.toggle();
          this.isshowdeleteslider.emit(false);
          this.animationState3 = 'out';
        }
      });
    }else{
      this.supplierdata = [];
      this.deleteForm.reset();
      this.deletesupplierdrawer.toggle();
      this.isshowdeleteslider.emit(false);
      this.animationState3 = 'out';
    }   
  }
  clearcomment(){
    this.deleteForm.controls['comments'].reset();
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
    this.toastr.success(data, this.i18n('tsdeletesuppliersidenavdetail.succ'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showWSuccess(data){
    this.toastr.warning(data, this.i18n('tsdeletesuppliersidenavdetail.warn'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
}
