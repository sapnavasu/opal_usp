import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { common_var } from '@env/common_veriables';
export interface Assessmentfeeinfo {
  ianame: string;
  iatotalinvoice: string;
  iaamount: string;
  iadueinvoice: string;
  iatotamount: string;
}

export interface Royalfeeinfo {
  rfname: string;
  rftotalinvoice: string;
  rfamount: string;
  rfdueinvoice: string;
  rftotamount: string;
}

const ASSESSMENTFEEELEMENT_DATA: Assessmentfeeinfo[] = [
  {ianame:'As Training Centre', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
  {ianame:'Yet to Pay', iatotalinvoice: '05',iaamount: '500',iadueinvoice: '1',iatotamount: "500"},
  {ianame:'Acknowledgement Pending', iatotalinvoice: '10',iaamount: '2000',iadueinvoice: '1',iatotamount: "200"},
  {ianame:'As Training Centre', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
  {ianame:'Yet to Receive', iatotalinvoice: '02',iaamount: '100',iadueinvoice: '4',iatotamount: "100"},
  {ianame:'Acknowledgement Pending', iatotalinvoice: '18',iaamount: '2800',iadueinvoice: '5',iatotamount: "280"},
];

const ROYALFEEELEMENT_DATA: Royalfeeinfo[] = [
  {rfname:'As Training Centre', rftotalinvoice: '',rfamount: '',rfdueinvoice: '',rftotamount: ""},
  {rfname:'Yet to Pay', rftotalinvoice: '05',rfamount: '500',rfdueinvoice: '1',rftotamount: "500"},
  {rfname:'Acknowledgement Pending', rftotalinvoice: '10',rfamount: '2000',rfdueinvoice: '1',rftotamount: "200"}
];

@Component({
  selector: 'app-invoicemanagment',
  templateUrl: './invoicemanagment.component.html',
  styleUrls: ['./invoicemanagment.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class InvoicemanagmentComponent implements OnInit {
  
  /** Front end Control**/
  public invoiceManagement = common_var.maincentre.trainingEvaluationCentre.invoiceManagement;

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  public commignsoon = true;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService) { }

  assessfeedisplayedColumns: string[] = ['ianame', 'iatotalinvoice', 'iaamount', 'iadueinvoice', 'iatotamount'];
  assessfeedataSource = ASSESSMENTFEEELEMENT_DATA;

  royalfeedisplayedColumns: string[] = ['rfname', 'rftotalinvoice', 'rfamount', 'rfdueinvoice', 'rftotamount'];
  royalfeedataSource = ROYALFEEELEMENT_DATA;

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
