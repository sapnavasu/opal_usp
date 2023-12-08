import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

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

@Component({
  selector: 'app-portaltechbatchmngmnt',
  templateUrl: './portaltechbatchmngmnt.component.html',
  styleUrls: ['./portaltechbatchmngmnt.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class PortaltechbatchmngmntComponent implements OnInit {

  
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  
  assessfeedataSource: Assessmentfeeinfo[]; 
  royalfeedataSource: Royalfeeinfo[]; 
  
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService) { }
    @Input('Invoicecounts') Invoicecounts: any;
    assessfeedisplayedColumns: string[] = ['ianame', 'iatotalinvoice', 'iaamount', 'iadueinvoice', 'iatotamount'];
    
  
    royalfeedisplayedColumns: string[] = ['rfname', 'rftotalinvoice', 'rfamount', 'rfdueinvoice', 'rftotamount'];
    

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
      this.updatecounts();
    }

    updatecounts()
    {

      console.log(this.Invoicecounts);
      this.assessfeedataSource = [
        {ianame:'Centre Certification', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
        {ianame:'Yet to Receive', iatotalinvoice: this.Invoicecounts['Yet_to_Receive_Centre'],iaamount: this.Invoicecounts['Total_amount_YR_centre'],iadueinvoice: this.Invoicecounts['Invoice_in_due_YR_Centre'],iatotamount: this.Invoicecounts['Due_amount_YR_centre']},
        {ianame:'Confirmation Pending', iatotalinvoice: this.Invoicecounts['Confirmation_pending_Centre'],iaamount: this.Invoicecounts['Total_amount_CP_Centre'],iadueinvoice: this.Invoicecounts['Invoice_in_due_CP_Centre'],iatotamount: this.Invoicecounts['Due_amount_CP_Centre']}
      ];

      this.royalfeedataSource = [
        {rfname:'Yet to Receive', rftotalinvoice: this.Invoicecounts['RF_Yet_to_Receive'],rfamount: this.Invoicecounts['RF_totalamount_YR'],rfdueinvoice: this.Invoicecounts['RF_Invoice_in_due_YR'],rftotamount: this.Invoicecounts['RF_due_amount_YR']},
        {rfname:'Acknowledgement Pending', rftotalinvoice: this.Invoicecounts['RF_Confirmation_pending'],rfamount: this.Invoicecounts['RF_totalamount_CP'],rfdueinvoice: this.Invoicecounts['RF_Invoice_in_due_CP'],rftotamount: this.Invoicecounts['RF_due_amount_CP']}
      ];

     
    } 

    

}
