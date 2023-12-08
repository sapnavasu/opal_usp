import { Component, OnInit, ViewChild, ViewEncapsulation, Output, EventEmitter, Input } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';

@Component({
  selector: 'app-vendorinformation',
  templateUrl: './vendorinformation.component.html',
  styleUrls: ['./vendorinformation.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class VendorinformationComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  @Output() cancel = new EventEmitter<any>();
  @Output() next = new EventEmitter<void>();
  @Input() isValidated: boolean = false;
  @Output() appdata = new EventEmitter<any>();
  @Output() schdata = new EventEmitter<any>();
  public total: any;
  public appiit_branchname_ar: any;
  public appiit_branchname_en: any;
  public officetype: any;
  public address1: any;
  public address2: any;
  public osm_statename_en: any;
  public osm_statename_ar: any;
  public ocim_cityname_en: any;
  public ocim_cityname_ar: any;
  public appdt_apptype: any;
  public updatevalidation: boolean = true;
  public hisstatus: any;
  public projectpk: any;
  public newone:boolean = false;
  public update:boolean = false;
  public approval:boolean = true;
  public decline:boolean =  false;
  public successcmd:boolean = false; 
  public declinecmd:boolean = false;
  public apptempPk: any;
  public appiit_officetype: any;
  public appiit_noofexpat: any;
  public appiit_noofomani: any;
  public appiit_molpercent: any;
  public appiit_nooftechstaff: any;
  public appiit_maxcapacity: any;
  public appiit_status: any;
  public appiit_appdeccomment: any;
  public appiit_updatedon: any;
  public appiit_updatedby: any;
  public autocalper: any;
  public autocal: number;
  public autocalrat: any;
  public appiit_noofcurlearners: any;
  public appiit_locmapurl: any;
  public appiit_loclatitude: any;
  public appiit_loclongitude: any;
  public appiit_appdecon: any;
  public appiit_appdecby: any;
  public oum_firstname: any;
  public type: any;
  public disableSubmitButton: boolean;
  public ifarabic: boolean = false;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,protected security: Encrypt, private cookieService: CookieService,public routeid: ActivatedRoute,private appservice : ApplicationService) {
    this.onValidation = this.onValidation.bind(this);
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
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });


    this.routeid.params.subscribe(params => {
      this.apptempPk = params['id'];
      this.type = params['type'];
      this.projectpk = this.security.decrypt(params['projectpk']);

      if(this.apptempPk){
       this.appservice.getInsInforDtl(this.apptempPk , this.projectpk).subscribe(responseInfor => {
        this.disableSubmitButton = false;
         this.hisstatus = responseInfor.data.hisstatus;
         this.schdata.emit(responseInfor.data.scheduledate);
         this.appdata.emit(responseInfor.data.data);
         this.appdt_apptype =  responseInfor.data.data.appdt_apptype;
        if(this.appdt_apptype == 3 || this.appdt_apptype == undefined){
          this.updatevalidation = false;
          console.log( this.appdt_apptype , 'apptypeproj');
         }
       
         if(responseInfor.data.data){
           this.appdt_apptype =  responseInfor.data.data.appdt_apptype;
           this.appiit_officetype = ( responseInfor.data.data. appiit_officetype == 1)?this.i18n('table.main'):this.i18n('table.branch');
           this.appiit_noofexpat =  responseInfor.data.data.appiit_noofexpat;
           this.appiit_noofomani =  responseInfor.data.data.appiit_noofomani;
           this.appiit_molpercent =  this.convertToInt(responseInfor.data.data.appiit_molpercent).toFixed(2);
           this.appiit_nooftechstaff =  responseInfor.data.data.appiit_nooftechstaff;
           this.appiit_maxcapacity =  responseInfor.data.data.appiit_maxcapacity;
           this.appiit_status =  responseInfor.data.data.appiit_status;
           this.appiit_appdeccomment = (responseInfor.data.data.appiit_appdeccomment)?responseInfor.data.data.appiit_appdeccomment:'Nil';
           this.appiit_updatedon =  responseInfor.data.data.appiit_updatedon;
           this.appiit_updatedby =  responseInfor.data.data.appiit_updatedby;
           this.appiit_noofcurlearners =  responseInfor.data.data.appiit_noofcurlearners;
           this.appiit_locmapurl =  responseInfor.data.data.appiit_locmapurl;
           this.appiit_loclatitude =  responseInfor.data.data.appiit_loclatitude;
           this.appiit_loclongitude =  responseInfor.data.data.appiit_loclongitude;
           this.oum_firstname = responseInfor.data.data.oum_firstname;
           this.appiit_appdecon =     responseInfor.data.data.appiit_appdecon;
           this.total = (parseInt(this.appiit_noofexpat) + parseInt(this.appiit_noofomani));
           this.autocalper =  ( parseInt(this.appiit_noofomani) / this.total ) * 100 ;
           this.autocalper =  this.autocalper.toFixed(2);
           this.appiit_branchname_ar =  responseInfor.data.data.appiit_branchname_ar;
           this.appiit_branchname_en =  responseInfor.data.data.appiit_branchname_en;
            this.officetype =  responseInfor.data.data. appiit_officetype;
           if(this.appiit_noofcurlearners && this.appiit_nooftechstaff){
            this.autocalrat = this.convertToInt(this.appiit_noofcurlearners) / this.convertToInt(this.appiit_nooftechstaff);
            this.autocalrat =  '1:' + Math.floor(this.autocalrat);
          }
          this.address1 =  responseInfor.data.data.appiit_addrline1;
          this.address2 =  responseInfor.data.data.appiit_addrline2;
          this.osm_statename_en = responseInfor.data.data.osm_statename_en;
          this.osm_statename_ar = responseInfor.data.data.osm_statename_ar;
          this.ocim_cityname_en= responseInfor.data.data.ocim_cityname_en;
          this.ocim_cityname_ar= responseInfor.data.data.ocim_cityname_ar;
        
         }
       });
      }
      });
   }

   convertToInt(val){
    if(val){
      return parseInt(val);
    } else {
      return 0;
    }
  }

   calculateRatio(num_1, num_2){
    
  
}

   onValidation(form ,resetForm){
    this.disableSubmitButton = true; 
    this.appservice.updateInstitute(form.value , this.apptempPk).subscribe(data => {
      this.disableSubmitButton = false; 
       this.appiit_status =       (data.data.data.appiit_status)?data.data.data.appiit_status:'Nil';
       this.appiit_appdecon =     this.convertDate(data.data.data.appiit_appdecon);
       this.appiit_appdecby =     data.data.data.appiit_appdecby;
       this.appiit_appdeccomment = (data.data.data.appiit_appdeccomment)?data.data.data.appiit_appdeccomment:'Nil';
       this.oum_firstname =       data.data.username;
       swal({
        title: this.i18n('company.infovalidation'),
        text: " ",
        icon: 'success',
        buttons: [false, this.i18n('company.ok')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        resetForm(); 
      });                       
    });
}

convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat)
  return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-')
}
  
  


}
