import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
export interface Ivmsinspectionpending {
  ivmsvehicleno: string;
  ivmsownername: string;
  ivmsinspectiondate: string;
  ivmsassignedinspector: string;
  ivmsaction: string;
}

export interface Ivmsverificationpending {
  ivmsvvehicleno: string;
  ivmsvownername: string;
  ivmsvaction: string;
}

export interface Ivmsapprovalpending {
  ivmsavehicleno: string;
  ivmsaownername: string;
  ivmsaaction: string;
}


const IIPELEMENT_DATA: Ivmsinspectionpending[] = [
  {ivmsvehicleno:'TN 07 BF 8278', ivmsownername: 'Kuzhaimah Suus Abboudh',ivmsinspectiondate: '15-01-2023',ivmsassignedinspector: 'Muhibb Qutaibah Ba',ivmsaction: ''},
  {ivmsvehicleno:'TN 13 AC 0078', ivmsownername: 'Fareedh Amir Bishara',ivmsinspectiondate: '18-02-2023',ivmsassignedinspector: 'Emir Yassin Naasar',ivmsaction: ''},
  {ivmsvehicleno:'TN 07 BF 8278', ivmsownername: 'Kuzhaimah Suus Abboudh',ivmsinspectiondate: '15-01-2023',ivmsassignedinspector: 'Muhibb Qutaibah Ba',ivmsaction: ''},
  {ivmsvehicleno:'TN 13 AC 0078', ivmsownername: 'Fareedh Amir Bishara',ivmsinspectiondate: '18-02-2023',ivmsassignedinspector: 'Emir Yassin Naasar',ivmsaction: ''},
  {ivmsvehicleno:'TN 07 BF 8278', ivmsownername: 'Kuzhaimah Suus Abboudh',ivmsinspectiondate: '15-01-2023',ivmsassignedinspector: 'Muhibb Qutaibah Ba',ivmsaction: ''},
  {ivmsvehicleno:'TN 13 AC 0078', ivmsownername: 'Fareedh Amir Bishara',ivmsinspectiondate: '18-02-2023',ivmsassignedinspector: 'Emir Yassin Naasar',ivmsaction: ''},
  {ivmsvehicleno:'TN 07 BF 8278', ivmsownername: 'Kuzhaimah Suus Abboudh',ivmsinspectiondate: '15-01-2023',ivmsassignedinspector: 'Muhibb Qutaibah Ba',ivmsaction: ''},
  {ivmsvehicleno:'TN 13 AC 0078', ivmsownername: 'Fareedh Amir Bishara',ivmsinspectiondate: '18-02-2023',ivmsassignedinspector: 'Emir Yassin Naasar',ivmsaction: ''}
];

const IVPELEMENT_DATA: Ivmsverificationpending[] = [
  {ivmsvvehicleno:'TN 07 BF 8278', ivmsvownername: 'Kuzhaimah Suus Abboudh',ivmsvaction: ''},
  {ivmsvvehicleno:'TN 13 AC 0078', ivmsvownername: 'Fareedh Amir Bishara',ivmsvaction: ''},
  {ivmsvvehicleno:'TN 07 BF 8278', ivmsvownername: 'Kuzhaimah Suus Abboudh',ivmsvaction: ''},
  {ivmsvvehicleno:'TN 13 AC 0078', ivmsvownername: 'Fareedh Amir Bishara',ivmsvaction: ''},
  {ivmsvvehicleno:'TN 07 BF 8278', ivmsvownername: 'Kuzhaimah Suus Abboudh',ivmsvaction: ''},
  {ivmsvvehicleno:'TN 13 AC 0078', ivmsvownername: 'Fareedh Amir Bishara',ivmsvaction: ''},
  {ivmsvvehicleno:'TN 07 BF 8278', ivmsvownername: 'Kuzhaimah Suus Abboudh',ivmsvaction: ''},
  {ivmsvvehicleno:'TN 13 AC 0078', ivmsvownername: 'Fareedh Amir Bishara',ivmsvaction: ''}
];

const IAPELEMENT_DATA: Ivmsapprovalpending[] = [
  {ivmsavehicleno:'TN 07 BF 8278', ivmsaownername: 'Kuzhaimah Suus Abboudh',ivmsaaction: ''},
  {ivmsavehicleno:'TN 13 AC 0078', ivmsaownername: 'Fareedh Amir Bishara',ivmsaaction: ''},
  {ivmsavehicleno:'TN 07 BF 8278', ivmsaownername: 'Kuzhaimah Suus Abboudh',ivmsaaction: ''},
  {ivmsavehicleno:'TN 13 AC 0078', ivmsaownername: 'Fareedh Amir Bishara',ivmsaaction: ''},
  {ivmsavehicleno:'TN 07 BF 8278', ivmsaownername: 'Kuzhaimah Suus Abboudh',ivmsaaction: ''},
  {ivmsavehicleno:'TN 13 AC 0078', ivmsaownername: 'Fareedh Amir Bishara',ivmsaaction: ''},
  {ivmsavehicleno:'TN 07 BF 8278', ivmsaownername: 'Kuzhaimah Suus Abboudh',ivmsaaction: ''},
  {ivmsavehicleno:'TN 13 AC 0078', ivmsaownername: 'Fareedh Amir Bishara',ivmsaaction: ''}
];

@Component({
  selector: 'app-ivmspendinglistaccordion',
  templateUrl: './ivmspendinglistaccordion.component.html',
  styleUrls: ['./ivmspendinglistaccordion.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class IvmspendinglistaccordionComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService) { }

  ivmsipdisplayedColumns: string[] = ['ivmsvehicleno', 'ivmsownername', 'ivmsinspectiondate', 'ivmsassignedinspector', 'ivmsaction'];
  ivmsipdataSource = IIPELEMENT_DATA;

  ivmsvpdisplayedColumns: string[] = ['ivmsvvehicleno', 'ivmsvownername', 'ivmsvaction'];
  ivmsvpdataSource = IVPELEMENT_DATA;

  ivmsapdisplayedColumns: string[] = ['ivmsavehicleno', 'ivmsaownername', 'ivmsaaction'];
  ivmsapdataSource = IAPELEMENT_DATA;

  ngOnInit() { 
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
  }

}
