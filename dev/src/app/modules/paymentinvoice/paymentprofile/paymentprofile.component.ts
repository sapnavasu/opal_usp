import { Component, OnInit,ViewChild,ViewEncapsulation} from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from 'ngx-toastr';
import { ApplicationService } from '@app/services/application.service';
import { ActivatedRoute,Route } from '@angular/router';
import swal from 'sweetalert';
import { Router } from '@angular/router';
import { Alert } from 'selenium-webdriver';
import { Encrypt } from '@app/common/class/encrypt';
import { Location } from '@angular/common';
import moment from 'moment';
interface status {
  value: string;
  viewValue: string;

}
@Component({
  selector: 'app-paymentprofile',
  templateUrl: './paymentprofile.component.html',
  styleUrls: ['./paymentprofile.component.scss'],
  encapsulation:ViewEncapsulation.None
})
export class PaymentprofileComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  [x: string]: any;
  pending: boolean = false;
  recivied: boolean = true;
  bronze: boolean = false;
  gold:boolean = false;
  approvedcmd:boolean = false;
  validationstatus: boolean = false;
  public disableloader:boolean;
  notpayment: boolean = false;
  staffva:any=0;
  noofstaff:any=0;
  apptempPk: any;
  response:any;
  appiit_officetype :any;
  appdt_apptype   :any;
  appdt_certificateexpiry :any;
  appdt_certificategenon :any;
  appdt_submittedon :any;
  appdt_updatedon :any;
  apppdt_appdeccomment :any;
  apppdt_appdecon  :any;
  apppdt_appdecby :any;
  gm_gradename_en   :any;
  appiit_branchname_en  :any;
  omrm_companyname_en     :any;
  omrm_tpname_en   :any;
  apid_raisedon  :any;
  isexpired :any;
  appiit_loclatitude :any;
  appiit_loclongitude :any;
  apppdt_vatchrgs :any;
  apppdt_vatpercent :any;
  apppdt_amount :any;
  apppdt_currency :any;
  totalamt :any;
  apppdt_bankname :any;
  apppdt_dateofpymt :any;
  apppdt_transuniqueId :any;
  apppdt_offlinerefno :any;
  oum_firstname :any;
  apppdt_orderrefno :any;
  apid_invoiceno :any;
  apppdt_status:any;
  days :any;
  apppdt_paymentmode:any;
  fileurl :any;
  filetype :any;
  total_amount:any='0';
  projectmst_fk:any='';
  appiit_locmapurl:any='';
  staffval:any=0;
  schdate:any;
  constructor(private translate: TranslateService,private _location:Location,
    private remoteService: RemoteService, public toastr: ToastrService, 
    private cookieService: CookieService,public routeid: ActivatedRoute,public route: Router,
    private appservice : ApplicationService, public security: Encrypt) {
      this.onValidation = this.onValidation.bind(this);

     }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
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
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
     
        }
        else {
          this.ifarabic = true;
        }
      }
    });
    this.disableloader = true;


  

 
   
    this.viewinvoice();
    // if(this.refname == 1) {
    //   this.notpayment = false;
    // } 
    // if(this.refname == 2) {
    //   this.notpayment = true;
    // }
    // if(this.refname == 3) {
    //   this.notpayment = true;
    //   this.paymentcondition = true;
    //   this.validationstatus = true;
    //   this.condition = true;
    // }
    this.paymentdata();
  }


  paymentdata(){
        if(this.refname) {
          // this.disableSubmitButton = true;
          this.appservice.getpayment(this.refname).subscribe(data => {
           this.disableloader = false;
            // this.disableSubmitButton = false;
            this.response = data.data.data.appdt_projectmst_fk;

          console.log(data.data , 'paymentdata');
          this.appdt_apptype= data.data.data.appdt_apptype;
          if(data.data.data.appdt_projectmst_fk != 1)
          {
            this.noofstaff = data.data.data.apppdt_noofstaffeval;
            this.staffval = data.data.data.apppdt_staffevafee;
         
          }
          
           
            this.projectmst_fk = data.data.data.appdt_projectmst_fk;
            this.total_amount = data.data.data.total_amount;
            this.appdt_appreferno = data.data.data.appdt_appreferno;
            this.appdt_status     =  data.data.data.appdt_status;
            if(this.appdt_status == 6){
                   this.notpayment = true;

            }else{
              this.notpayment = false;

            }
            this.appiit_officetype  = (data.data.data.appiit_officetype == 1)?this.i18n('invoice.main'):this.i18n('invoice.branch');
            this.appdt_apptype     =   (data.data.data.appdt_apptype == 1)?'Initial' : (data.data.data.appdt_apptype == 2)?this.i18n('invoice.renew'): this.i18n('invoice.upda');
            this.appdt_certificateexpiry =     data.data.data.appdt_certificateexpiry;
            this.appdt_certificategenon =      data.data.data.appdt_certificategenon;
            this.appdt_submittedon = data.data.data.appdt_submittedon;
            this.appdt_updatedon = data.data.data.appdt_updatedon;
            this.apppdt_appdeccomment = data.data.data.apppdt_appdeccomment;
            this.apppdt_appdecon = data.data.data.apppdt_appdecon;
            this.apppdt_appdecby = data.data.data.apppdt_appdecby;
            this.gm_gradename_en        =      (this.arabic == true)?data.data.data.gm_gradename_ar:data.data.data.gm_gradename_en;
            this.appiit_branchname_en   =  (this.arabic == true)?data.data.data.appiit_branchname_ar:data.data.data.appiit_branchname_en;
            this.omrm_companyname_en        =      (this.arabic == true)?data.data.data.omrm_companyname_ar:data.data.data.omrm_companyname_en;
            this.omrm_tpname_en   =  (this.arabic == true)?data.data.data.omrm_tpname_ar:data.data.data.omrm_tpname_en;
            this.omrm_branch_en   =  (this.arabic == true)?data.data.data.omrm_branch_ar:data.data.data.omrm_branch_en;
            this.apid_raisedon = data.data.data.apid_raisedon;
            var current_date = new Date();
            var specific_date = new Date(data.data.data.appdt_certificateexpiry_new); //Year, Month, Date   
            var specific_date1  = new Date(data.data.data.apid_raisedonO); 
            // if (current_date.toDateString() > specific_date.toDateString()) {    
            // this.isexpired = 1; 
            // }else {    
            //   this.isexpired = 0;   
            // }
            this.isexpired =  moment(current_date).isAfter(specific_date, 'day') ? 1 : 0; 
            this.appiit_loclatitude =     data.data.data.appiit_loclatitude;
            this.appiit_loclongitude =      data.data.data.appiit_loclongitude; 
             this.appiit_locmapurl = data.data.data.appiit_locmapurl; 
            this.apppdt_vatchrgs =  data.data.data.apppdt_vatchrgs;
            this.apppdt_vatpercent =  data.data.data.apppdt_vatpercent;
            this.apppdt_amount =  data.data.data.apppdt_amount;
            this.apppdt_currency =  data.data.data.apppdt_currency;
            this.totalamt = Number(this.apppdt_amount) + Number(this.apppdt_vatchrgs);
            this.apppdt_bankname = data.data.data.apppdt_bankname;
            this.apppdt_dateofpymt = data.data.data.apppdt_dateofpymt;
            this.apppdt_transuniqueId = data.data.data.apppdt_transuniqueId;
            this.apppdt_offlinerefno = data.data.data.apppdt_offlinerefno;
            this.oum_firstname = data.data.data.oum_firstname;
            this.apppdt_orderrefno = data.data.data.apppdt_orderrefno;
            this.apid_invoiceno = data.data.data.apid_invoiceno;
            this.apppdt_status = data.data.data.apppdt_status;
            const daysfun = (date_1, date_2) =>{
              let difference = date_1.getTime() - date_2.getTime();
              let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
              return TotalDays;
          }
           this.age = daysfun(current_date , specific_date1);
           this.days =   (this.age == 1)?'Day':'Days';
           this.apppdt_paymentmode = (data.data.data.apppdt_paymentmode == 1)?'Cheque' : (data.data.data.apppdt_paymentmode == 2)?'Bank Transfer': 'Cash';
           this.apppdt_appdeccomment =  (data.data.data.apppdt_appdeccomment)?data.data.data.apppdt_appdeccomment:'Nil';
           this.fileurl = data.data.fileurl;
           this.filetype = data.data.filetype;
           this.schdate = data.data.schdate;
          });
        }

  }





  receiveData(data: boolean) {
    this.validationstatus = data;
  }
 viewinvoice() {
  this.routeid.queryParams.subscribe(params => {
    this.refname = params['id'];
    this.apptempPk = params['id'];
  });
 }


 
 onValidation(form , resetForm){
  this.disableloader = true; 
   this.appservice.updatePayment(form.value , this.refname).subscribe(data => {
    this.disableloader = false;
     if(data.data.msg == 'false'){
      resetForm();
        swal({
          title: this.i18n('invoice.somwenwro'),
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('invoice.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
         // this.standardTemplate = 'MainCentre';
        })
      }else{
        if(form.value.select_valitate == 3) {
          this.popupcontent = this.i18n('The Payment has been Validated and Approved.');
          this.popup = 'success'
        }else if (form.value.select_valitate == 4) {
          this.popupcontent = this.i18n('The Payment has been Validated and Declined.');
          this.popup = 'success'
        }
        swal({
          title: this.popupcontent,
          text: " ",
          icon: this.popup,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          buttons: [false, this.i18n('invoice.ok')],
          dangerMode: true,
          closeOnClickOutside: false
        }).then(() => {
          this.apppdt_status =         data.data.data.apppdt_status;
          this.apppdt_appdecon =       data.data.data.apppdt_appdecon;
          this.apppdt_appdecby	 =       data.data.data.apppdt_appdecby	;
          this.apppdt_appdeccomment =  (data.data.data.apppdt_appdeccomment)?data.data.data.apppdt_appdeccomment:'Nil';
       
        if(this.projectmst_fk == 1) {
          this.route.navigate(['centrecertification/home/'+this.security.encrypt(this.projectmst_fk)]);

        } else  if(this.projectmst_fk == 2) {
          this.route.navigate(['standardcourseapproval/approvaldetails']);
        } else  if(this.projectmst_fk == 3) {
          this.route.navigate(['standardcourseapproval/approvaldetails']);
        }
        else if(this.projectmst_fk == 4) {
          this.route.navigate(['centrecertification/rashome/'+this.security.encrypt(this.projectmst_fk)]);
        }
        })
      }  
      });
   }
   goBack() {
    this._location.back(); 
  }
}