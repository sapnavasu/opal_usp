import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { common_var } from '@env/common_veriables';

import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

import { ActivatedRoute, Router, RouterModule, Routes } from '@angular/router';

export interface Assessmentfeeinfo {
  page: string;
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
  {page:'',ianame:'Centre Certification', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
  {page:'',ianame:'Yet to Receive', iatotalinvoice: '05',iaamount: '500',iadueinvoice: '1',iatotamount: "500"},
  {page:'',ianame:'Confirmation Pending', iatotalinvoice: '10',iaamount: '2000',iadueinvoice: '1',iatotamount: "200"},
  {page:'',ianame:'Course Certification', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
  {page:'',ianame:'Yet to Receive', iatotalinvoice: '02',iaamount: '100',iadueinvoice: '4',iatotamount: "100"},
  {page:'',ianame:'Confirmation Pending', iatotalinvoice: '18',iaamount: '2800',iadueinvoice: '5',iatotamount: "280"},
];

const ROYALFEEELEMENT_DATA: Royalfeeinfo[] = [
  {rfname:'Yet to Receive', rftotalinvoice: '05',rfamount: '500',rfdueinvoice: '1',rftotamount: "500"},
  {rfname:'Acknowledgement Pending', rftotalinvoice: '10',rfamount: '2000',rfdueinvoice: '1',rftotamount: "200"}
];

@Component({
  selector: 'app-portalinvoicemngmnt',
  templateUrl: './portalinvoicemngmnt.component.html',
  styleUrls: ['./portalinvoicemngmnt.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class PortalinvoicemngmntComponent implements OnInit {

  

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  public invoiceManagement = common_var.maincentre.trainingEvaluationCentre.invoiceManagement;
assessfeedataSource: Assessmentfeeinfo[];
  royalfeedataSource:Royalfeeinfo[];
  isfocalpoint: number;
  centreinvoicereadaccess: boolean;
  courseinvoicereadaccess: boolean;
  royalityinvoicereadaccess: boolean;
  useraccess: any;
  sts: any;  constructor(private translate: TranslateService,
    private remoteService: RemoteService,

 private localstorage: AppLocalStorageServices,
    private cookieService: CookieService,
    private router: Router,
    public routeid: ActivatedRoute,) { }


    @Input('DashboardCounts') DashboardCounts: any;    assessfeedisplayedColumns: string[] = ['ianame', 'iatotalinvoice', 'iaamount', 'iadueinvoice', 'iatotamount'];
    // assessfeedataSource = ASSESSMENTFEEELEMENT_DATA;
  
    royalfeedisplayedColumns: string[] = ['rfname', 'rftotalinvoice', 'rfamount', 'rfdueinvoice', 'rftotamount'];
    // royalfeedataSource = ROYALFEEELEMENT_DATA;

    ngOnInit() { 

      this.useraccess = this.localstorage.getInLocal('uerpermission');
      this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
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

      if(this.isfocalpoint == 1){
        this.centreinvoicereadaccess = true;
        this.courseinvoicereadaccess = true;
        this.royalityinvoicereadaccess = true;
      }
  
      if(this.isfocalpoint == 2){
        let moduleid = this.localstorage.getaccessmoduleid(1, 'Invoice Management');
  
        let submodulecn = 13 ; //
        if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulecn] && this.useraccess[moduleid][submodulecn].read == 'Y'){
          this.centreinvoicereadaccess = true;
        }
        
        let submoduleco = 14 ; //
        if(this.useraccess[moduleid] && this.useraccess[moduleid][submoduleco] && this.useraccess[moduleid][submoduleco].read == 'Y'){
          this.courseinvoicereadaccess = true;
        }

        let submodulerl = 15 ; //
        if(this.useraccess[moduleid] && this.useraccess[moduleid][submodulerl] && this.useraccess[moduleid][submodulerl].read == 'Y'){
          this.royalityinvoicereadaccess = true;
        }
        
      }
      
      this.updatecounts();    }

updatecounts(){

      if(this.courseinvoicereadaccess && this.centreinvoicereadaccess)
      {
        this.assessfeedataSource = [
          {page:'1', ianame:'Centre Certification', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
          {page:'1', ianame:'Yet to Receive', iatotalinvoice: this.DashboardCounts['Yet_to_Receive_Centre'],iaamount:  this.DashboardCounts['Total_amount_YR_centre'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_YR_Centre'],iatotamount:  this.DashboardCounts['Due_amount_YR_centre']},
          {page:'1', ianame:'Confirmation Pending', iatotalinvoice: this.DashboardCounts['Confirmation_pending_Centre'],iaamount:  this.DashboardCounts['Total_amount_CP_Centre'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_CP_Centre'],iatotamount:  this.DashboardCounts['Due_amount_CP_Centre']},
          {page:'2', ianame:'Course Certification', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
          {page:'2', ianame:'Yet to Receive', iatotalinvoice:  this.DashboardCounts['Yet_to_Receive_Course'],iaamount: this.DashboardCounts['Total_amount_YR_course'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_YR_course'],iatotamount: this.DashboardCounts['Due_amount_YR_course']},
          {page:'2', ianame:'Confirmation Pending', iatotalinvoice:  this.DashboardCounts['Confirmation_pending_Course'],iaamount:  this.DashboardCounts['Total_amount_CP_Course'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_CP_Course'],iatotamount:  this.DashboardCounts['Due_amount_CP_Course']},
        ];
      }
      else if(this.centreinvoicereadaccess)
      {
        this.assessfeedataSource = [
          {page:'1', ianame:'Centre Certification', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
          {page:'1', ianame:'Yet to Receive', iatotalinvoice: this.DashboardCounts['Yet_to_Receive_Centre'],iaamount:  this.DashboardCounts['Total_amount_YR_centre'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_YR_Centre'],iatotamount:  this.DashboardCounts['Due_amount_YR_centre']},
          {page:'1', ianame:'Confirmation Pending', iatotalinvoice: this.DashboardCounts['Confirmation_pending_Centre'],iaamount:  this.DashboardCounts['Total_amount_CP_Centre'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_CP_Centre'],iatotamount:  this.DashboardCounts['Due_amount_CP_Centre']},
          
        ];
      }
      else if(this.courseinvoicereadaccess){
        this.assessfeedataSource = [
          {page:'2', ianame:'Course Certification', iatotalinvoice: '',iaamount: '',iadueinvoice: '',iatotamount: ""},
          {page:'2', ianame:'Yet to Receive', iatotalinvoice:  this.DashboardCounts['Yet_to_Receive_Course'],iaamount: this.DashboardCounts['Total_amount_YR_course'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_YR_course'],iatotamount: this.DashboardCounts['Due_amount_YR_course']},
          {page:'2', ianame:'Confirmation Pending', iatotalinvoice:  this.DashboardCounts['Confirmation_pending_Course'],iaamount:  this.DashboardCounts['Total_amount_CP_Course'],iadueinvoice:  this.DashboardCounts['Invoice_in_due_CP_Course'],iatotamount:  this.DashboardCounts['Due_amount_CP_Course']},
          
        ];
      }
      
      this.royalfeedataSource = [
        {rfname:'Yet to Receive', rftotalinvoice:  this.DashboardCounts['RF_Yet_to_Receive'],rfamount:  this.DashboardCounts['RF_totalamount_YR'],rfdueinvoice:  this.DashboardCounts['RF_Invoice_in_due_YR'],rftotamount:  this.DashboardCounts['RF_due_amount_YR']},
        // {rfname:'Acknowledgement Pending', rftotalinvoice:  this.DashboardCounts['RF_Confirmation_pending'],rfamount:  this.DashboardCounts['RF_totalamount_CP'],rfdueinvoice:  this.DashboardCounts['RF_Invoice_in_due_CP'],rftotamount:  this.DashboardCounts['RF_due_amount_CP']}
      ];

    }

    goListPage(data){
      this.sts = '';
      if(data.ianame == 'Yet to Receive'){
        this.sts = '1';
      }else if(data.ianame == 'Confirmation Pending'){
        this.sts = '2';
      }

      if(data.page == '1' && this.sts){
        this.router.navigate(['invoicemanagement/centrecertificate'],{ queryParams: { statusVal:this.sts }});
      } else if(data.page == '2' && this.sts){
        this.router.navigate(['invoicemanagement/coursecertificate'],{ queryParams: { statusVal:this.sts }});
      }
    }

    goListPageRay(data){
      this.sts = '';
      if(data.rfname == 'Yet to Receive'){
        this.sts = '1';
      }else if(data.rfname == 'Acknowledgement Pending'){
        this.sts = '2';
      }

      if(this.sts){
        this.router.navigate(['invoicemanagement/royaltyfee'],{ queryParams: { statusVal:this.sts }});
      }
    }
}
