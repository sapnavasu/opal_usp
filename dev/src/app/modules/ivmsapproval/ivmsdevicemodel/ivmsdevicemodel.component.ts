import { Component, OnInit, ViewEncapsulation, EventEmitter, Output, Input } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { ActivatedRoute, Router } from '@angular/router';
import swal from 'sweetalert';
@Component({
  selector: 'app-ivmsdevicemodel',
  templateUrl: './ivmsdevicemodel.component.html',
  styleUrls: ['./ivmsdevicemodel.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class IvmsdevicemodelComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }

  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  public ivmsmanufact: any;
  public devicemodel: any;
  public softversion: any;
  public country: any;
  public tracertificate: any;
  public travalidity: any;
  public tradocument: any;
  public vendorname: any;
  public ifarabic: boolean;
  public disableSubmitButton: boolean = false;
  public acdt_status: any;
  public projectpk: any = 'IVMS'
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService, private appservice: ApplicationService, private security: Encrypt, private profileService: ProfileService, public routeid: ActivatedRoute,) {

  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;

    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;

        }
        else {
          this.ifarabic = true;
        }

      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });

    this.routeid.params.subscribe(params => {

      // if (this.apptempPk) {
      //   this.disableSubmitButton = true;
      //   this.appservice.getcompany(this.apptempPk, this.projectpk).subscribe(data => {
      //     this.disableSubmitButton = false;
      //     this.ivmsmanufact = data.data.data.appdt_appreferno;
      //     this.devicemodel = data.data.data.acdt_status
      //     this.softversion = data.data.data.acdt_appdecon;
      //     this.country = data.data.data.acdt_appdecby;
      //     this.tracertificate = data.data.data.acdt_gmname;
      //     this.travalidity = (data.data.data.acdt_gmemailid) ? this.format(data.data.data.acdt_gmemailid) : '-';
      //     this.tradocument = data.data.data.acdt_gmmobileno;
      //     this.vendorname = data.data.data.acdt_addrline1;
      //     this.acdt_status = data.data.data.acdt_addrline2;

      //   })
      // }
    });
  }

  getRegAppDtls() {
    this.disableSubmitButton = true;
    this.appservice.getappregdtls(this.projectpk).subscribe(response => {
      this.disableSubmitButton = false;

      // if (response.data.status == 1) {
      //   this.companydtls = response.data.data;
      //   this.maindata.emit(this.companydtls);
      // }
    });
  }

  format(inputDate) {
    var datePart = inputDate.match(/\d+/g),
      year = datePart[0],
      month = datePart[1], day = datePart[2];
    return day + '-' + month + '-' + year;
  }



  convertDate(inputFormat) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date(inputFormat)
    return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('-')
  }

}
