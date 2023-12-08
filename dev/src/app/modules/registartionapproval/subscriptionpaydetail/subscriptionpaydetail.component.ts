import { Component, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatDrawer } from '@angular/material/sidenav';
import { DriveInput } from '@app/common/classes/driveInput';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';

export const MY_FORMATS = {
  parse: {
      dateInput: 'DD-MM-YYYY',
  },
  display: {
      dateInput: 'DD-MM-YYYY',
      monthYearLabel: 'MMM YYYY',
      dateA11yLabel: 'LL',
      monthYearA11yLabel: 'MMMM YYYY',
  },
};
@Component({
  selector: 'app-subscriptionpaydetail',
  templateUrl: './subscriptionpaydetail.component.html',
  styleUrls: ['./subscriptionpaydetail.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ]
})
export class SubscriptionpaydetailComponent implements OnInit {
  checkform: FormGroup;
  @Input('subcriptionpaytracker') subcriptionpaytracker: MatDrawer;
  @Input('subcriptionpaydetail') subcriptionpaydetail: MatDrawer;
  animationState6 = 'out';
  maxDate = new Date();
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  drv_proofdoc: DriveInput;
  constructor(private formBuilder: FormBuilder, private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"

  ngOnInit(): void {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
   if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
	  
      });
    this.checkform = this.formBuilder.group({
      bankName: ['', Validators.required],
      transcdate: ['', Validators.required],
      checkno:['', Validators.required],
      paymentmode:['', Validators.required],
      proofdoc:['', Validators.required],
    });
    this.drv_proofdoc = {
      fileMstPk: 52,
      selectedFilesPk: []
    };
  }
  subcriptionpayclosedrawer(){
    this.subcriptionpaydetail.toggle();
    this.animationState6 = 'out';
}

subpaydetaillist(divName: string) {
  if (divName === 'subscriptiondetaillist') {
    this.animationState6 = this.animationState6 === 'out' ? 'in' : 'out';
  }
}

fileeSelected(file, fileId) {
  fileId.selectedFilesPk = file;
}
}
