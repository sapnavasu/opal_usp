import { Component, OnInit, Input, ViewChild } from '@angular/core';
import swal from 'sweetalert';
import { FormGroup, Validators, FormBuilder, FormControl } from '@angular/forms';
import {CdkTextareaAutosize} from '@angular/cdk/text-field';
import {NgZone} from '@angular/core';
import {take, startWith, map} from 'rxjs/operators';
import { Observable } from 'rxjs';
import {ViewEncapsulation } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { ErrorStateMatcher } from '@angular/material/core';
import { DriveInput } from '@app/common/classes/driveInput';
import { Filee } from '@app/@shared/filee/filee';
import { CookieService } from 'ngx-cookie-service';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';

@Component({
  selector: 'app-temporaryloginsidenavdetail',
  templateUrl: './temporaryloginsidenavdetail.component.html',
  styleUrls: ['./temporaryloginsidenavdetail.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class TemporaryloginsidenavdetailComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  myControl = new FormControl();
  updateoption: string[] = [
    this.i18n('tstemporaryloginsidenavdetail.creanewdim'),
  this.i18n('tstemporaryloginsidenavdetail.crememinthedime'),
  this.i18n('tstemporaryloginsidenavdetail.somexamofappro'),
  this.i18n('tstemporaryloginsidenavdetail.assinrpoto'),
  this.i18n('tstemporaryloginsidenavdetail.enabsmartlisfor'),
  this.i18n('tstemporaryloginsidenavdetail.usesmartlist'),
 ];
  temporarycontactlists = [
    {contacttitle:'Khalsa Al Aghbari',contactsubtitle:"Sales Administrator",mobilenum:'+968 2416 6100',contactemail:"Khalsa_Al_Aghbari@gmail.com"},
  ];
  @ViewChild('trackhistorydrawer') trackhistorydrawer: MatDrawer;
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  updateOptions: Observable<string[]>;
  animationState5 = 'out';
  @Input('tempoparaylogindrawer') tempoparaylogindrawer: MatDrawer;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public temporaryForm: FormGroup;
  public drvInput:DriveInput;
  otpvalidityexp:boolean = false;
  public buttonname: string = 'Track History';
  @ViewChild('temporary') temporary: Filee;
  constructor(private fb: FormBuilder,private _ngZone: NgZone ,private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }

    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr"
  ngOnInit() {
    this.drvInput = {
      fileMstPk:81,
      selectedFilesPk:[] 
    };
    this.temporaryForm = this.fb.group({
      selectmodule:["",Validators.required],
      temporyloginFileUpload:["",Validators.required],
      comments:["",Validators.required],
      selectuser:["",Validators.required],
      otpsupplier:["",Validators.required],
    });
    this.updateOptions = this.myControl.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
  }
  
  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.updateoption.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }
  tempoparyloginlistalert() {
    swal({
      title: this.i18n('tstemporaryloginsidenavdetail.doyouwantocan'),
      text: this.i18n('tstemporaryloginsidenavdetail.areyousurwant'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('tstemporaryloginsidenavdetail.canc'), this.i18n('tstemporaryloginsidenavdetail.Ok')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.tempoparaylogindrawer.toggle();
      }
    });
    this.animationState5 = 'out';
  }
  temporarylistdropdown(divName: string) {
    if (divName === 'temporarylistview') {
      this.animationState5 = this.animationState5 === 'out' ? 'in' : 'out';
    }
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }

  triggerResize() {
    this._ngZone.onStable.pipe(take(1))
        .subscribe(() => this.autosize.resizeToFitContent(true));
  }

  otpvalidity(){
      this.otpvalidityexp =true;
  }

  otpvalidityreturn(){
    this.otpvalidityexp =false;
  }
}
