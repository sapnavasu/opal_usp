import { Component, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { MatTabGroup } from '@angular/material/tabs';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute } from '@angular/router';
import { CentreinstituteinfoComponent } from '../centreinstituteinfo/centreinstituteinfo.component';
import swal from 'sweetalert';
import { Router } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import moment from 'moment';
import { Location } from '@angular/common';
@Component({
  selector: 'app-centredesktopreview',
  templateUrl: './centredesktopreview.component.html',
  styleUrls: ['./centredesktopreview.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class CentredesktopreviewComponent implements OnInit {
  bronze: boolean = false;
  gold: boolean = false;
  isValidated: boolean = false;
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @Input() mattab: number = 0;
  apptempPk: any;
  condition: boolean = true;
  tp_name: any;
  company_name: any;
  appdt_appreferno: any;
  appdt_submittedon: any;
  appdt_status: any;
  expandedElement: string;
  appdt_grademst_fk: any;
  type: any;
  appdt_certificategenon: any;
  appdt_certificateexpiry: any;
  isexpired: number;
  appiit_loclatitude: any;
  appiit_loclongitude: any;
  disableSubmitButton: boolean;
  appiit_officetype: string;
  appdt_apptype: string;
  appiit_officetypeid = 1;

  maincentre: boolean = false;
  officetype: any;
  appiit_locmapurl: any;
  approval: any;
  tabnumber: string;
  finaltab: any;
  appdt_updatedon: any;
  scheduledate: any;
  appdt_projectmst_fk: any;
  rascenter: boolean = false;
  projectpk: string;
  branch_name: any;
  appdt_isprimarycert: any;
  partAfterFourthSlash: string;
  i18n(key) {
    return this.translate.instant(key);
  }
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,private _location: Location, 
    private cookieService: CookieService,public routeid: ActivatedRoute,private route: Router,private appservice : ApplicationService, protected security: Encrypt) {
      this.onValidation = this.onValidation.bind(this);
     

     }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
  
  ngOnInit(): void {
  this.disableSubmitButton = true;
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
    const url = window.location.href;
    const parts = url.split('/');
    if (parts) {
      this.partAfterFourthSlash = parts[7];
    }
    this.routeid.params.subscribe(params => {
      this.apptempPk = params['id'];
      this.type = params['type'];
      this.approval = this.security.decrypt(params['approval']);
      this.projectpk = this.security.decrypt(params['projectpk']); 
      });
      
  }


  nexttab() {
    this.mattab = 1;
    
  }
  nextsecondtab() {
    this.mattab = 2;
  }
  previous() {
    this.mattab = 0;
  }
  previoustab() {
    this.mattab = 1;
  }
  nextthirdtab() {
    this.mattab =3;
  }
  previousfourtab() {
    this.mattab = 2;
  }
  nextfourtab(){
    this.mattab =4;
  }
  previousfifthtab(){
    this.mattab =3;
  }
  nextfifthtab(){
    this.mattab =5;
  }
  previoussixtab(){
    this.mattab =4;
  }
  nextsixtab(){
    this.mattab =6;
  }
  previousseventab(){
    this.mattab =5;
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
        // this.disableSubmitButton = true;
        // if(this.projectpk == '1') {
        //   this.route.navigate(['centrecertification/home/:id']);
        //   }else {
        //   this.route.navigate(['centrecertification/rashome/:id']);
  
        //   }
        // setTimeout(() => {
        //   this.disableSubmitButton = false;
        // }, 2000);
        this._location.back()
      }
    })
  }

  onValidation(form, resetForm){
    this.disableSubmitButton = true; 
    if(this.projectpk == '1'){
    this.appservice.updateapplication(form.value , this.apptempPk).subscribe(data => {
      this.disableSubmitButton = false; 
      console.log(data.data.flag ,'flag');
      if(data.data.flag == 4){
        resetForm();
          swal({
            title:this.i18n('company.declpop') ,
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then(() => {
            this.disableSubmitButton = true;
            this.route.navigate(['/centrecertification/home/'+this.security.encrypt(this.projectpk)]);
             this.disableSubmitButton = false;
          })
        }else if(data.data.flag == 5){

          resetForm();
          swal({
            title:data.data.comments,
            text: " ",
            icon: 'warning',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false

          }).then(() => {
            this.disableSubmitButton = false;
            //this.route.navigate(['/centrecertification/home']);
            setTimeout(() => {
             this.disableSubmitButton = false;
           }, 5000);
          })
        }
        
        else{
          this.isValidated = true;  
          swal({
            title: this.i18n('company.succvali') ,
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then(() => {
            this.disableSubmitButton = true;
            this.route.navigate(['/centrecertification/home/'+this.security.encrypt(this.projectpk)]);
              this.disableSubmitButton = false;
           
          })
        }
                     
    });
     }else{
      this.appservice.updaterasapplication(form.value , this.apptempPk).subscribe(data => {
        this.disableSubmitButton = false; 
        if(data.data.flag == 4){
          resetForm();
            swal({
              title:this.i18n('company.declpop') ,
              text: " ",
              icon: 'warning',
              buttons: [false, this.i18n('company.ok')],
              dangerMode: true,
              className: this.dir =='ltr'?'swalEng':'swalAr',
              closeOnClickOutside: false
            }).then(() => {
              this.disableSubmitButton = true;
              this.route.navigate(['/centrecertification/rashome/'+this.security.encrypt(this.projectpk)]);
               this.disableSubmitButton = false;
            })
          }else if(data.data.flag == 5){
  
            resetForm();
            swal({
              title:data.data.comments,
              text: " ",
              icon: 'warning',
              buttons: [false, this.i18n('company.ok')],
              dangerMode: true,
              className: this.dir =='ltr'?'swalEng':'swalAr',
              closeOnClickOutside: false
  
            }).then(() => {
              this.disableSubmitButton = false;
              //this.route.navigate(['/centrecertification/home']);
              setTimeout(() => {
               this.disableSubmitButton = false;
             }, 5000);
            })
          }
          
          else{
            this.isValidated = true;  
            swal({
              title: this.i18n('company.succvali') ,
              text: " ",
              icon: 'success',
              buttons: [false, this.i18n('company.ok')],
              dangerMode: true,
              className: this.dir =='ltr'?'swalEng':'swalAr',
              closeOnClickOutside: false
            }).then(() => {
              this.disableSubmitButton = true;
              this.route.navigate(['/centrecertification/rashome/'+this.security.encrypt(this.projectpk)]);
                this.disableSubmitButton = false;
             
            })
          }
                       
      });

     }
   
    // this.disableSubmitButton = false;
}



getchilddata(data){
// this.tp_name = data.tpname_en;
// this.company_name = data.compname_en;


}

getappdata(data){
  console.log(data , 'testapp');
  this.appdt_appreferno = data.appdt_appreferno;
  this.appiit_locmapurl = data.appiit_locmapurl;
  this.appdt_submittedon = data.appdt_submittedon;
  this.appdt_updatedon   = data.appdt_updatedon;
  this.appdt_status =  data.appdt_status;
  this.appdt_grademst_fk =  data.appdt_grademst_fk;
  this.appdt_certificategenon = data.appdt_certificategenon;
  this.appiit_officetype  = (data.appiit_officetype == 1)? this.i18n('Main Office'):this.i18n('Branch Office');
  this.officetype = data.appiit_officetype;
  this.appdt_projectmst_fk = data.appdt_projectmst_fk;
  this.appdt_apptype     =   (data.appdt_apptype == 1)?'Initial' : (data.appdt_apptype == 2)?this.i18n('table.renewal'): this.i18n('company.update'); 
//  this.appdt_certificateexpiry = data.appdt_certificateexpiry;
  this.appiit_loclatitude=  data.appiit_loclatitude;
  this.appiit_loclongitude = data.appiit_loclongitude;
  this.appdt_certificateexpiry= (data.appdt_certificateexpiry)?data.appdt_certificateexpiry:'-';
  console.log(this.appdt_certificateexpiry,'sate');
  var current_date = new Date();
  var specific_date = new Date(data.appdt_certificateexpiry_new); //Year, Month, Date    
  // console.log(current_date,'current date');
  // console.log(specific_date,'specific date');
  console.log(moment(current_date).isAfter(specific_date, 'day'));
  this.isexpired =  moment(current_date).isAfter(specific_date, 'day') ? 1 : 0; 
  this.tp_name = data.omrm_tpname_en;
  this.branch_name = data.omrm_branch_en;
  this.company_name = data.omrm_companyname_en;
  this.appdt_isprimarycert = data.appdt_isprimarycert
  console.log(this.appdt_isprimarycert , 'offtype1');
  this.ontabs();
  }
  getschdata(data){
    this.scheduledate = data;
 
  }
 
  onTabSelect(event: any) {
    // const index = event.index;
    // this.tabClickFunctions[index]();
  }
  ontabs() {
     console.log(this.appdt_projectmst_fk , 'offtype');
    if(this.officetype == 1 && this.appdt_projectmst_fk == 1) {
      this.maincentre = false;
    }else if(this.officetype == 2 && this.appdt_projectmst_fk == 1)  {
      this.maincentre = true;
    }else if(this.appdt_isprimarycert == 1 && this.appdt_projectmst_fk == 4)  {
         this.rascenter =     false;

    }else if(this.appdt_isprimarycert != 1 && this.appdt_projectmst_fk == 4)  {
         this.rascenter =     true;
    }

    console.log(this.rascenter , 'ras');
    console.log( this.maincentre , 'main');
    const savedTabIndex = localStorage.getItem('mattab');
      if (savedTabIndex) {
        this.tabnumber = savedTabIndex;
       if(this.projectpk == '1') {
        if(this.officetype == 1 && this.tabnumber == '1') {
          this.finaltab = 5;
        }else if(this.officetype == 1 && this.tabnumber == '2') {
       
          if(this.projectpk == '1') {
            this.finaltab = 7;
          }else { 
            this.finaltab = 4;
          }
        }else if(this.officetype == 2 && this.tabnumber == '1') {
          this.finaltab = 1;
        }else {
          this.finaltab = 2;
        }
       }
       else {
       if(this.appdt_isprimarycert == 1 && this.tabnumber == '2') {
            this.finaltab = 4;
       }else {
          this.finaltab = 2;
       }
      }
        this.mattab = this.finaltab;
        localStorage.removeItem('mattab'); 
      }
      setTimeout(() => {
        this.disableSubmitButton = false;
      }, 4000);
  }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      // console.log(123)
    } catch (error) {
      console.log('page-content')
    }
  }
}
