import { Component, OnInit , ViewEncapsulation } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import moment from 'moment';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Location } from '@angular/common';
@Component({
  selector: 'app-viewassessment',
  templateUrl: './viewassessment.component.html',
  styleUrls: ['./viewassessment.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewassessmentComponent implements OnInit {
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  staffevaluation_pk: any='';
  staffAssessmentValues: any;
  disableSubmitButton: boolean = false;
  application_id: any='';
  appstaffinfotmp_id: any='';
  mattab: any;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private _location:Location, 
    private applicationService: ApplicationService,
    private route: ActivatedRoute) { }

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
    this.route.queryParams.subscribe(param => {
      this.staffevaluation_pk = param['id'];
      this.application_id = param['a'];
      this.appstaffinfotmp_id = param['b'];
      console.log(this.staffevaluation_pk);
      
    })
    if(this.staffevaluation_pk != null) {
      this.getStaffAssessmentStatus();
    }
  }
  getStaffAssessmentStatus() {
    this.disableSubmitButton = true;
    let set_id = this.staffevaluation_pk;
    let app_id = this.application_id;
    let asit_id = this.appstaffinfotmp_id;
    this.applicationService.getStaffAssessmentStatus(set_id,app_id,asit_id).subscribe((res:any) => {
      console.log(res);
      this.disableSubmitButton = false;

      this.staffAssessmentValues = res['data']['data'];
    })
  }
  backTopayment() {
    this._location.back()
    // this.mattab = 1;
    // localStorage.setItem('mattab', this.mattab.toString());
  }
}
