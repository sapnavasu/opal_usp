import { Component, OnInit, Input, ViewEncapsulation, EventEmitter, Output } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { ActivatedRoute, Router } from '@angular/router';
import swal from 'sweetalert';
@Component({
  selector: 'app-centrecompanydtl',
  templateUrl: './centrecompanydtl.component.html',
  styleUrls: ['./centrecompanydtl.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class CentrecompanydtlComponent implements OnInit {
  logo: any;
  appdt_apptype: any;
  updatevalidation: boolean = true;
  hisstatus: any;
  projectpk: any;
  crImage: any;
  mcfd_filetype: any;
  omrm_branch_en: any;
  omrm_branch_ar: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  newone:boolean = true;
  update:boolean = false;
  approval:boolean = false;
  decline:boolean =  false;
  successcmd:boolean = false;
  declinecmd:boolean = false;
  public apptempPk: any;
  companydtls: any;
  company_name_en:any;
  company_name_ar:any;
  tp_name_en:any;
  tp_name_ar:any;
  opal_memb_no:any;
  opal_memb_expiry:any;
  comp_cr_no:any;
  comp_cr_expiry:any;
  address1:any;
  address2:any;
  governorate:any;
  wilayat:any;
  governoratelist: any;
  wilayatlist: any;
  selectedEstGovernorate:any;
  selectedEstGovernorateAr: any;
  ifarabic: boolean = false;
  ocim_cityname_ar : any;
  ocim_cityname_en :any;
  gm_name :any;
  gm_emailid :any;
  gm_mobnum :any;
  moheri_grade :any;
  focalpoint_name :any;
  focalpoint_desig :any;
  focalpoint_emailid :any;
  focalpoint_mobno :any;
  acdt_status: any;
  acdt_appdecon: any;
  acdt_appdecby: any;
  acdt_appdecComments: any;
  appdt_appreferno: any;
  acdt_gmname: any;
  acdt_gmemailid: any;
  acdt_gmmobileno: any;
  acdt_gmmoherigrading: number;
  acdt_addrline1: any;
  acdt_addrline2: any;
  @Input() isValidated: boolean = false;
  @Output() maindata = new EventEmitter<any>();
  @Output() appdata = new EventEmitter<any>();
  oum_firstname: any;
  type: any;
  omgm_gradename_ar: any;
  omgm_gradename_en: any;
  disableSubmitButton: boolean;
  osm_statename_en: any;
  osm_statename_ar: any;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private appservice : ApplicationService,private security: Encrypt,private profileService: ProfileService,public routeid: ActivatedRoute , ) {

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
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
     
        }
        else {
          this.ifarabic = true;
        }

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
    // alert(this.projectpk)
      if (this.apptempPk) {
        this.disableSubmitButton = true;
        this.appservice.getcompany(this.apptempPk , this.projectpk).subscribe(data => {
          this.disableSubmitButton = false;
         this.appdt_appreferno = data.data.data.appdt_appreferno;
         this.acdt_status =        data.data.data.acdt_status
          this.acdt_appdecon =      data.data.data.acdt_appdecon;
          this.acdt_appdecby =      data.data.data.acdt_appdecby;
          this.acdt_appdecComments =     (data.data.data.acdt_appdecComments)?data.data.data.acdt_appdecComments:'Nil';
          this.gm_name =  data.data.data.acdt_gmname;
          this.gm_emailid = data.data.data.acdt_gmemailid;
          this.gm_mobnum =  data.data.data.acdt_gmmobileno;
          this.moheri_grade =  Number( data.data.data.acdt_gmmoherigrading);
          this.address1 =  data.data.data.acdt_addrline1;
          this.address2 =  data.data.data.acdt_addrline2;
          this.oum_firstname = data.data.data.oum_firstname;
          this.omgm_gradename_ar= data.data.data.omgm_gradename_ar;
          this.omgm_gradename_en= data.data.data.omgm_gradename_en;
          this.osm_statename_en = data.data.data.osm_statename_en;
          this.osm_statename_ar = data.data.data.osm_statename_ar;
          this.ocim_cityname_en= data.data.data.ocim_cityname_en;
          this.ocim_cityname_ar= data.data.data.ocim_cityname_ar;
          this.company_name_en =  data.data.data.omrm_companyname_en;
          this.company_name_ar = data.data.data.omrm_companyname_ar;
          this.omrm_branch_en =  data.data.data.omrm_branch_en;
          this.omrm_branch_ar = data.data.data.omrm_branch_ar;
          this.tp_name_en =  data.data.data.omrm_tpname_en;
          this.tp_name_ar =  data.data.data.omrm_tpname_ar;
          this.opal_memb_no = data.data.data.omrm_opalmembershipregnumber;
          this.opal_memb_expiry =  (data.data.data.omrm_opalmembershipregexpiredate)?this.format(data.data.data.omrm_opalmembershipregexpiredate):'-';
          this.comp_cr_no =  data.data.data.omrm_crnumber;
          this.comp_cr_expiry = (data.data.data.omrm_crregistrationexpiry)?this.format(data.data.data.omrm_crregistrationexpiry):'-';
          this.focalpoint_name = (data.data.user)?data.data.user.oum_firstname:'-';
          this.focalpoint_desig = (data.data.user)?data.data.user.odsg_opaldesignationname:'-';
          this.focalpoint_emailid = (data.data.user)? data.data.user.oum_emailid:'-';
          this.focalpoint_mobno =  (data.data.user)?data.data.user.oum_mobno:'-';
          this.logo =  data.data.logo;
          this.crImage =  data.data.crImage;
          this.mcfd_filetype =  data.data.data.mcfd_filetype;
          this.appdt_apptype = data.data.data.appdt_apptype;
          console.log(this.appdt_apptype , 'apptype');
          if(this.appdt_apptype == 3 || this.appdt_apptype == undefined){
              this.updatevalidation = false;
          }
          this.hisstatus = data.data.hisstatus;
     
         
        })
      }
    });

  


  }

  getRegAppDtls() {
    this.disableSubmitButton = true;
    this.appservice.getappregdtls(this.projectpk).subscribe(response => {
      this.disableSubmitButton = false;

       if(response.data.status == 1)
       {
        this.companydtls = response.data.data;
          //  this.opal_memb_no = this.companydtls.opalmem_no;
          //  this.opal_memb_expiry =  this.format(this.companydtls.opalmem_expiry);
          //  this.comp_cr_no =  this.companydtls.cr_no;
          //  this.comp_cr_expiry = this.format(this.companydtls.cr_expiry);
          //  this.company_name_en =  this.companydtls.compname_en;
          //  this.company_name_ar = this.companydtls.compname_ar;
          //  this.tp_name_en =  this.companydtls.tpname_en;
          //  this.tp_name_ar =  this.companydtls.tpname_ar;
          //  this.focalpoint_name = this.companydtls.name;
          //  this.focalpoint_desig =  this.companydtls.desig;
          //  this.focalpoint_emailid =  this.companydtls.emailid;
          //  this.focalpoint_mobno =  this.companydtls.mob_no;
         // this.selectedGovernorate(Number(this.companydtls.omrm_opalstatemst_fk));
          this.maindata.emit(this.companydtls);

        
       }
    });
  }

   format(inputDate) {
    var datePart = inputDate.match(/\d+/g),
    year = datePart[0], // get only two digits
    month = datePart[1], day = datePart[2];
    return day+'-'+month+'-'+year;
  }

  

  selectedGovernorate(value) {

    if(this.governoratelist)
    {
     // let value = 3870;
      this.governoratelist.forEach(y => {
        if (y.opalstatemst_pk == value) {
          this.selectedEstGovernorate = y.osm_statename_en;
          this.selectedEstGovernorateAr = y.osm_statename_ar;
          this.getwilayatbyid(1, value);
        }
      });
    }
    else{
      this.getRegAppDtls();
    }
    
    
  }

  getwilayatbyid(country, state) {
    this.profileService.getcity(country, state).subscribe(data => {
      this.ocim_cityname_ar = data.data[0].ocim_cityname_ar;
      this.ocim_cityname_en = data.data[0].ocim_cityname_en;
     } );
  }

  getGoverenoratelist() {
    this.profileService.getstatebyid(1).subscribe(data => {
      this.governoratelist = data.data;
    });
  }




  onValidation(form , resetForm){
    this.disableSubmitButton = true; 
    this.appservice.updateCompany(form.value , this.apptempPk).subscribe(data => {
      this.disableSubmitButton = false; 
       this.acdt_status =         data.data.data.acdt_status
       this.acdt_appdecon =       this.convertDate(data.data.data.acdt_appdecon);
       this.acdt_appdecby =       data.data.data.acdt_appdecby;
       this.oum_firstname =       data.data.username;
       this.acdt_appdecComments =  (data.data.data.acdt_appdecComments)?data.data.data.acdt_appdecComments:'Nil';
       swal({
        title: this.i18n('company.compvalidation'),
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
