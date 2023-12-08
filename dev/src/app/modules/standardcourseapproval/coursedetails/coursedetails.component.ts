import { Component, EventEmitter, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import moment from 'moment';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
@Component({
  selector: 'app-coursedetails',
  templateUrl: './coursedetails.component.html',
  styleUrls: ['./coursedetails.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class CoursedetailsComponent implements OnInit {
  public newone: boolean = false;
  public approval: boolean = false;
  public update: boolean = false;
  public decline: boolean = true;
  declinecmd: boolean = false;
  successcmd: boolean = false;
  page: number = 10;
  last_updated: any;

  data = 'course';
  last_updated_by:any = '';


  unitcards = ['item 1', 'item 2', 'item 3', 'item 4'];
  lists = ['item 1', 'item 2', 'item 3', 'item 4'];
  disableSubmitButton: boolean;
  applicationstatus: any;
  applytype: any;
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private activatedRoute: ActivatedRoute,
    private applicationservice: ApplicationService
  ) { }
  @Output() coursebutton = new EventEmitter<void>();
  @Output() courseprevious = new EventEmitter<void>();
  @Output() courseapprovetrue = new EventEmitter<any>();
  public courapp = null;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;





  status: any;
  offitype: any;
  courtitl: any;
  courcate: any;
  coursubcate: [];
  courlevel: any;
  request: any;
  comment: any;
  compnameeng: any;


  @ViewChild("paginator") paginator: MatPaginator;
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
  d = 10;
  viewcertificate = true;
  ngOnInit(): void {

    this.activatedRoute.queryParams.subscribe((params) => {
      let app_ref_id = params['app_ref_id'];

      if(params['view'])
      {
 
        this.viewcertificate = false;
      } else
      {
   
        this.viewcertificate = true;
       
      }
   

      if (app_ref_id == '' || app_ref_id == undefined) {
        return false;
      }
      else {

       this.disableSubmitButton = true;
        this.applicationservice.setValueStandaradCustomizeApproval(app_ref_id).subscribe(res => {
         setTimeout(() => {
          this.disableSubmitButton = false;
         }, 2000);
          this.offitype = res.data[0].offictype;
          this.courtitl = res.data[0].coursetitle;
          this.courcate = res.data[0].coursecate;
          this.coursubcate = res.data[0].coursesubcate.split("**");
          this.courlevel = res.data[0].courselevel;
          this.request = res.data[0].requestfor;
          this.comment = res.data[0].appctt_appdeccomment;
          this.compnameeng = res.data[0].branchname;
          this.last_updated = res.data[0].appcdt_appdecon;
          this.last_updated_by = res.data[0].oum_firstname;
          this.applytype = res.data[0].applytype;
         

          this.status = res.data[0].appcdt_status;
          console.log(this.status);
          if (this.status == 3) {
            this.declinecmd = false;
            this.successcmd = true;
            this.newone = false;
            this.courapp = "approved";
            this.courseapprovetrue.emit("approved")



          } else if (this.status == 4) {

            this.declinecmd = true;
            this.successcmd = false;
            this.newone = false;

            this.courapp = 'decline';
            this.courseapprovetrue.emit(null)


          }else if(this.status == 1 || this.status == 2)

          {
            this.newone = true;
            this.declinecmd = false;
            this.successcmd = false;
            this.courapp = "new";
          }


        })
      }

    });





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

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }

  approvedvalue(e) {

    const approvedcard = e;
   console.log(e[0].appcdt_appdecon);
  
    this.status =  e[0].appcdt_status;
    this.last_updated_by =e[1].updat_by; 
    if (this.status == 3) {
      this.declinecmd = false;
      this.successcmd = true;
      this.newone = false;
      this.comment = e[0].appcdt_appdeccomment;
      this.last_updated = e[0].appcdt_appdecon;
      this.status = 3;
      this.courapp = "approved";

      this.courseapprovetrue.emit("approved")


    }
    else if (this.status == 4) {

      this.declinecmd = true;
      this.successcmd = false;
      this.newone = false;
      this.comment =  e[0].appcdt_appdeccomment;
      this.status = 4;
      this.last_updated = e[0].appcdt_updatedon;
      this.courapp = 'decline';

      this.courseapprovetrue.emit(null)




    }else if(this.status == 1 || this.status == 2)

    {
      this.newone = true;
      this.declinecmd = false;
      this.successcmd = false;
      this.courapp = "new";
    }
  }
  onBooleanValue(value: boolean) {
      this.disableSubmitButton = value;
  }
}
