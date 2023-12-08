import { Component, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { MatTabGroup } from '@angular/material/tabs';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { Router } from '@angular/router';
import { MatPaginator } from '@angular/material/paginator';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import moment from 'moment';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { InternationalrecognitionComponent } from '../internationalrecognition/internationalrecognition.component';
import { DocumentrequiredComponent } from '../documentrequired/documentrequired.component';
import { CoursedetailsComponent } from '../coursedetails/coursedetails.component';
import { StaffapprovalComponent } from '../staffapproval/staffapproval.component';
@Component({
  selector: 'app-desktopreview',
  templateUrl: './desktopreview.component.html',
  styleUrls: ['./desktopreview.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class DesktopreviewComponent implements OnInit {
  centernaem: any;
  company_name: any;
  ifarabic: boolean;
  company_name_ar: any;
  traiprovname_ar: any;
  certification: any;
  app_ref_id: any;
  asd_date: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  paginationSet =
  BgiJsonconfigServices.bgiConfigData.configuration
    .enterpriseAdminPaginatonSet;

@ViewChild("paginator") paginator: MatPaginator;


staffnew:boolean = false;
traiprovname:any;
applirefno:any;
applytype:any;
courstype:any;
applstat:any;
certstat:any;
siteloca:any;
dateexoi:any;
addon:any;
lastupdat:any;
appdecon:any;
dateofexpiry:any;
id:any;
active:boolean= false;
decline:boolean= false;
new:boolean = false;
viewcertificate:boolean= true;



  bronze: boolean = false;
  gold: boolean = false;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild("mytab", { static: true }) mattab: any;
  @Input() approved;
disableSubmitButton: boolean = false
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private route: Router,   private activatedRoute: ActivatedRoute , private applicationservice :ApplicationService, protected security: Encrypt,) { }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }

  ngOnInit(): void {
    console.log(this.approved);

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
      this.ifarabic = false;

      } else {
      this.ifarabic = true;

      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.ifarabic = false;
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
        this.ifarabic = false;
      }
    });

    this.activatedRoute.queryParams.subscribe((params) => {
      this.app_ref_id = params['app_ref_id'];
      this.id = params['id'];
    
 
      if(params['viw'] == 1){
        this.mattab =3;
        this.route.navigate(['/standardcourseapproval/desktopreview'], { queryParams: {id: params['id'], app_ref_id: params['app_ref_id']} });

      }

      if(params['view'] && params['type'] == 1)
      {
 
        this.viewcertificate = false;
      } else
      {

        this.viewcertificate = true;
       
      }

      if(this.app_ref_id == '' || this.app_ref_id == undefined)
      {
        return true;
      }
      else{
        this.disableSubmitButton = true;
        this.applicationservice.setValueStandaradCustomizeApproval(this.app_ref_id).subscribe(res =>
          {
            this.disableSubmitButton = false;
           
            this.company_name =  res.data[0].omrm_companyname_en;
            this.company_name_ar = res.data[0].omrm_companyname_ar;
           
            this.traiprovname =   res.data[0].omrm_tpname_en;
            this.traiprovname_ar = res.data[0].omrm_tpname_ar;
           this.applirefno = res.data[0].applictionno;
           this.applytype = res.data[0].applytype;
           this.courstype = res.data[0].coursetype;
           this.applstat = res.data[0].applicationstatus;
           this.siteloca = res.data[0].sitelocan;
           this.addon = res.data[0].appdt_appdecon;
           this.lastupdat =res.data[0].appdt_updatedon;
          this.appdecon   =res.data[0].appdt_submittedon;
          this.dateofexpiry = res.data[0].appdt_certificateexpiry;
          this.certification = res.data[0].certification;
          this.asd_date = res.data[0].asd_date;
           const e = this.dateofexpiry;
            
         if(e == '' || e == null)
         {
          this.active= false;
          this.decline = false;
          this.new = true;
         }
         else if(e != '' || e != null)
         {
         
          this.new = false;
        
        
          const currdate = new Date();
          const expiry_date = new Date(e);
          if(currdate < expiry_date)
          {

            this.active= false;
            this.decline = true;
          } else if(currdate > expiry_date)
          {

            this.active= true;
            this.decline = false;
          } else 
          {
            this.active= true;
            this.decline = false;
        
          }

        
        
         }
           
        
        
           
          
          


           
          })
      }

    });

   this.overallbtnstatus(this.app_ref_id);
   

    
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
  next() {
    this.mattab = 1;
  }
  cancle() {
    swal({
      title: this.i18n('desktop.doyouwant'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('desktop.no'), this.i18n('desktop.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
       this.route.navigate(['/standardcourseapproval/approvaldetails']);
       setTimeout(() => {
        this.disableSubmitButton = false;
       }, 2000);
      }
    })
  }
  documentnext() {
    this.mattab = 3;
    console.log(0)
  }
  documentpre() {
    this.mattab = 1;
  }
  interprevious() {
    this.mattab = 0;
  }
  internext() {
    this.mattab = 2
  }
  @ViewChild('course') course:CoursedetailsComponent;
  @ViewChild('international') international:InternationalrecognitionComponent;
  @ViewChild('document') document:DocumentrequiredComponent;
  @ViewChild('staff') staff:StaffapprovalComponent;
  public approv: string = '';
  overallbtnstatus(value){
    this.applicationservice.checkallapprovedornot(this.app_ref_id).subscribe(res => {
      if (res.status == 200) {
        this.approv = res.data.retundata;
      }

    });
  }
  overallapprov(e)
  {
    this.overallbtnstatus(this.app_ref_id);
    // console.log('interapprovaltrue - '+this.course.courapp+' - '+this.international.interappo+' - '+this.document.docappro+' - '+this.staff.staffappro)
    // if(this.course.courapp != null && this.international.interappo !=null && this.document.docappro != null && this.staff.staffappro != null && this.course.courapp == "approved" && this.international.interappo =="approved" && this.document.docappro == "approved" && this.staff.staffappro == "approved")
    // {
    // this.approv = "approved";
   
   
    // }
    // else if(this.course.courapp != null && this.international.interappo !=null && this.document.docappro != null && this.staff.staffappro != null && (this.course.courapp == "decline" || this.international.interappo =="decline" || this.document.docappro == "decline" || this.staff.staffappro == "decline")){
    //   this.approv = 'declined';
    // }
    // if(this.staff.staffappro != null && this.staff.staffappro == "staffnew")
    // {
    //  this.staffnew = true;
    // }
  }
}
