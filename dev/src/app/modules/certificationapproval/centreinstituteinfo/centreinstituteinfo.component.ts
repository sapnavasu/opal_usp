import { Component, OnInit, ViewChild, ViewEncapsulation, Output, EventEmitter, Input } from '@angular/core';

import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import swal from 'sweetalert';
import { Encrypt } from '@app/common/class/encrypt';

@Component({
  selector: 'app-centreinstituteinfo',
  templateUrl: './centreinstituteinfo.component.html',
  styleUrls: ['./centreinstituteinfo.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class CentreinstituteinfoComponent implements OnInit {
  total: any;
  appiit_branchname_ar: any;
  appiit_branchname_en: any;
  officetype: any;
  address1: any;
  address2: any;
  osm_statename_en: any;
  osm_statename_ar: any;
  ocim_cityname_en: any;
  ocim_cityname_ar: any;
  appdt_apptype: any;
  updatevalidation: boolean = true;
  hisstatus: any;
  projectpk: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  newone:boolean = false;
  update:boolean = false;
  approval:boolean = true;
  decline:boolean =  false;
  successcmd:boolean = false; 
  declinecmd:boolean = false;
  apptempPk: any;
  appiit_officetype: any;
  appiit_noofexpat: any;
  appiit_noofomani: any;
  appiit_molpercent: any;
  appiit_nooftechstaff: any;
  appiit_maxcapacity: any;
  appiit_status: any;
  appiit_appdeccomment: any;
  appiit_updatedon: any;
  appiit_updatedby: any;
  @Input() isValidated: boolean = false;
  @Output() appdata = new EventEmitter<any>();
  @Output() schdata = new EventEmitter<any>();
  autocalper: any;
  autocal: number;
  autocalrat: any;
  appiit_noofcurlearners: any;
  appiit_locmapurl: any;
  appiit_loclatitude: any;
  appiit_loclongitude: any;
  appiit_appdecon: any;
  appiit_appdecby: any;
  oum_firstname: any;
  type: any;
  disableSubmitButton: boolean;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,protected security: Encrypt,
  private cookieService: CookieService,public routeid: ActivatedRoute,private appservice : ApplicationService) {
    this.onValidation = this.onValidation.bind(this);

     }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
  

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
         //  this.autocalrat = this.convertToInt(this.appiit_nooftechstaff)/this.convertToInt(this.appiit_noofcurlearners);
            this.officetype =  responseInfor.data.data. appiit_officetype;
           //this.autocalrat = this.calculateRatio(this.appiit_noofcurlearners ,this.appiit_nooftechstaff);
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
    //  var num;
    // for(num=num_2; num>1; num--) {
    //     if((num_1 % num) == 0 && (num_2 % num) == 0) {
    //         num_1=num_1/num;
    //         num_2=num_2/num;
    //     }
    // }
    // var ratio = num_1+":"+num_2;
    // return ratio;
  
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
