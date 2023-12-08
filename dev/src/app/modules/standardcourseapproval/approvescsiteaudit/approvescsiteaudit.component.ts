import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, FormArray, Validators, FormControl, FormGroupDirective, RequiredValidator } from '@angular/forms';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import moment from 'moment';
@Component({
  selector: 'app-approvescsiteaudit',
  templateUrl: './approvescsiteaudit.component.html',
  styleUrls: ['./approvescsiteaudit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ApprovescsiteauditComponent implements OnInit {

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';


  auditscore: any = [
   {name:'Yes', checked:'true'},
   {name:'No', checked:'false'}
  ];
  public approveAuditscoreForm: FormGroup;

  constructor(private formBuilder: FormBuilder,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    this.formvalidated();
  }

  formvalidated() {
    this.approveAuditscoreForm = this.formBuilder.group({
      saradio1: [''],
      saradio2: [''],
      saradio3: [''],
      saradio4: [''],
      saradio5: [''],
      saradio6: [''],
      saradio7: [''],
      saradio8: [''],
      saradio9: [''],
      saradio10: [''],
      saradio11: [''],
      saradio12: [''],
      saradio13: [''],
      saradio14: [''],
      saradio15: [''],
      saradio16: [''],

      acommentbox_1: [''],
      acommentbox_2: [''],
      acommentbox_3: [''],
      acommentbox_4: [''],  
      acommentbox_5: [''],  
      acommentbox_6: [''],  
      acommentbox_7: [''],  
      acommentbox_8: [''],  
      acommentbox_9: [''],
      acommentbox_10: [''], 
      acommentbox_11: [''], 
      acommentbox_12: [''], 
      acommentbox_13: [''], 
      acommentbox_14: [''], 
      acommentbox_15: [''], 
      acommentbox_16: [''],   

    })
  }

  get form() { return this.approveAuditscoreForm.controls; }

}
