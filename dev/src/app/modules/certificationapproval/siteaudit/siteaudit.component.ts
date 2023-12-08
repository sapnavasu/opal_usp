import { Component, OnInit, ViewChild, ViewEncapsulation ,EventEmitter, Output} from '@angular/core';
import { MatTabGroup } from '@angular/material/tabs';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { FormBuilder, FormGroup,FormArray, Validators, FormControl, FormGroupDirective, RequiredValidator } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { ApplicationService } from '@app/services/application.service';
import { ActivatedRoute,Route, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import swal from 'sweetalert';
import { Location } from '@angular/common';
import moment from 'moment';
import { forkJoin } from 'rxjs';
@Component({
  selector: 'app-siteaudit',
  templateUrl: './siteaudit.component.html',
  styleUrls: ['./siteaudit.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class SiteauditComponent implements OnInit {
  appiit_locmapurl: any;
  schdate: any;
  commentsview: any;
  appdt_projectmst_fk: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  mattab = 0;
  disableSubmit: boolean;
  hideforedites: boolean;
  hideforeditdata: boolean;
  appid: any;
  viewpage: any;
  appdt_appreferno: any;
  appiit_officetype: string;
  appdt_apptype: string;
  appdt_certificateexpiry: any;
  appdt_certificategenon: any;
  appdt_submittedon: any;
  appdt_updatedon: any;
  appdt_status: any;
  appiit_loclatitude: any;
  appiit_loclongitude: any;
  isexpired: number;
  ifarabic: boolean;
  omrm_companyname_en: any;
  omrm_tpname_en: any;
  sitecategory: any[];
  finaltabdata:any[];
  sitecategoryname: any[];
  sitequestions: any;
  questiondtls: any;
  questArr: any;
  ansArr: any;
  multichoisecount: any;
  gradedata: any;
  bronzepercentage: any;
  bronzescorefrom: any;
  silverpercentage: any;
  silverscorefrom: any;
  silverscoreto: any;
  goldscorefrom: any;
  bronzescoreto: any;
  goldpercentage: any;
  goldscoreto: any;
  bronzeper: number;
  vievalidation: boolean = false;
  viewcomments: boolean = false;
  categorygrade: any;
  appdt_gradingreason: any;
  viewcommentsbox: boolean = false;
  appdt_appdecby: any;
  appdt_appdeccomment: any;
  appdt_appdecon: any;
  firstname: any;
  appsiteauditreportcattmp_pk: any;
sitequesansdata:any;
  checkBoxAns: any = {};
  selectedquesCalc: any = []
  selectedbronze: any = 0;
  selectedsilver: any = 0;
  selectedgold: any = 0;
  selectedall: any = [];
  silverper: number;
  goldper: number;
  totalper: number;
  categoryname: string;
  lastNumber: any;  constructor(private translate: TranslateService,private _location:Location,
    private remoteService: RemoteService,
    private cookieService: CookieService,public routeid: ActivatedRoute , private appservice : ApplicationService, public security: Encrypt,public route: Router) {
      this.onValidation = this.onValidation.bind(this);
     }

  
    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr";;

  ngOnInit(): void {
    this.disableSubmit = true;
    this.mattab = 1;
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
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
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
    this.routeid.queryParams.subscribe(params => {
      this.appid = params['id'];
      this.viewpage =this.security.decrypt( params['view']);
    });

    if(this.viewpage == 3 || this.viewpage == 4 || this.viewpage == 5) {
      this.vievalidation = true;
      this.viewcomments = true;
      // setTimeout(() => {
        this.mattab = 0;
      // }, 4000);

    }else {

      this.vievalidation = false;
      this.viewcomments = false;
    //  setTimeout(() => {
        this.mattab = 0;
      // }, 4000);
    }
    if(this.viewpage == 6) {
      console.log("test");
      this.viewcomments = true;
      // setTimeout(() => {
        this.mattab = 0;
      // }, 4000);

    }
  this.sitedata();
  }
previousfive() {
  this.mattab--;
}
previoussixtab() {
  this.mattab--;
  this.onCategoryTabClick(this.mattab)
}
getchilddata(data){
  this.mattab++;
  this.sitecategory[this.mattab]!== undefined ? this.onCategoryTabClick(this.mattab) : this.finalgradetab();
  
  }

  setChoiceData({choiceData, triggerCalculate}) {
    this.checkBoxAns = choiceData;
    if(triggerCalculate){
      console.log(choiceData, 'setchoicedata');
       this.calculatescore();
      }
  }

  updateAnswers(categoryId) {
    const index = this.sitecategory.findIndex(site => site.id === categoryId)
    
    this.appservice.getsitequestions(this.sitequesansdata[index].data[0].appsiteauditreportcattmp_pk).subscribe(data => {
      this.sitequesansdata[index] = this.transformData(data); 
    })
  }

  finalgradetab(){
    this.disableSubmit = true;
    this.appservice.getsitedata(this.appid).subscribe(data => {
      this.disableSubmit = false;
      this.appservice.getFinalTabData(this.getSiteCategory(data.data.data));
    })
  }

  submitForm(index) {
    const submitData = {
      categoryId: this.sitecategory[index].id,
      categoryName:this.sitecategory[index].name,
      multiChoiceCount: this.multichoisecount,
      selectedBronze: this.selectedbronze,
      selectedsilver: this.selectedsilver,
      selectedgold: this.selectedgold,
      gradeMst:this.categorygrade,
    }
    this.appservice.submitQuestForm(submitData);
  }

  onCategoryTabClick(index) {
        this.mattab = index;
      this.disableSubmit = false;
        if(!this.sitequesansdata[index]) return;
        this.multichoisecount =  this.sitequesansdata[index].data.filter(a => a.asaqm_questiontype == 2).length;
        this.appservice.getQuestDataLocal({data: this.sitequesansdata[index].transformedData, categoryid: this.sitecategory[index].id, multiChoiceCount: this.multichoisecount})
        this.calculatescore();

  }

onTabSelect(event: any) {
  const index = event.index;
  console.log(`Selected tab position: ${event.index}`);
  }

getviewdata(data){
  this.commentsview = data;
  console.log(this.commentsview , 'opppp');
  
  }

transformData(data) {
  const siteArr = data.data;
  const transformedData = siteArr.data.map(q => siteArr.Adata.filter(a => a.asaad_auditquestionmst_fk === q.asaad_auditquestionmst_fk))
  siteArr['transformedData'] = transformedData
  return siteArr
}

sitedata(){
  if(this.appid) {
    this.appservice.getgrademst().subscribe(gradeData => {
      this.gradedata =  gradeData.data.data;
       this.bronzepercentage = Number(this.gradedata[0]['gm_scoreinpercent']);
       this.bronzescorefrom=  this.gradedata[0]['gm_scorefrom'];
       this.bronzescoreto  = this.gradedata[0]['gm_scoreto'];
       this.silverpercentage = this.gradedata[1]['gm_scoreinpercent'];
       this.silverscorefrom =  this.gradedata[1]['gm_scorefrom'];
       this.silverscoreto  = this.gradedata[1]['gm_scoreto'];
       this.goldpercentage = this.gradedata[2]['gm_scoreinpercent'];
       this.goldscorefrom=  this.gradedata[2]['gm_scorefrom'];
       this.goldscoreto  = this.gradedata[2]['gm_scoreto'];
     

       this.appservice.getsitedata(this.appid).subscribe(data => {
          this.appsiteauditreportcattmp_pk = data.data.data[0].appsiteauditreportcattmp_pk;
          const siteDatPromise = data.data.data.map(site=> this.appservice.getsitequestions(site.appsiteauditreportcattmp_pk));
          forkJoin(siteDatPromise).subscribe(res => {
            this.sitequesansdata = res.map((data: any) => this.transformData(data))
              this.onCategoryTabClick(0);
          });

          this.firstname = data.data.username;
          this.schdate = data.data.schdate;
          this.appdt_appreferno = data.data.data[0].appdt_appreferno;
          this.appiit_officetype  = (data.data.data[0].appiit_officetype == 1)?'Main Office':'Branch Office';
          this.appdt_apptype     =   (data.data.data[0].appdt_apptype == 1)?'Initial' : (data.data.data[0].appdt_apptype == 2)?'Renewal': 'Updated';
          this.appdt_certificateexpiry =     data.data.data[0].appdt_certificateexpiry;
          this.appdt_certificategenon =      data.data.data[0].appdt_certificategenon;
          this.appdt_submittedon    = data.data.data[0].appdt_submittedon;
          this.appdt_gradingreason = (data.data.data[0].appdt_gradingreason)?data.data.data[0].appdt_gradingreason:'Nil';
          this.appdt_appdecon = data.data.data[0].appdt_appdecon;
          this.appdt_appdeccomment = data.data.data[0].appdt_appdeccomment;
          this.appdt_updatedon     = data.data.data[0].appdt_updatedon;
          this.appdt_status = data.data.data[0].appdt_status; 
          this.appdt_projectmst_fk = data.data.data[0].appdt_projectmst_fk; 
          this.appiit_loclatitude =     data.data.data[0].appiit_loclatitude;
          this.appiit_loclongitude =      data.data.data[0].appiit_loclongitude; 
          var current_date = new Date();
          var specific_date = new Date(data.data.data[0].appdt_certificateexpiry_org); //Year, Month, Date   
          // if (current_date.toDateString() > specific_date.toDateString()) {    
          // this.isexpired = 1; 
          // }else {    
          //   this.isexpired = 0;   
          // }
      
        this.isexpired =  moment(current_date).isAfter(specific_date, 'day') ? 1 : 0;
        this.omrm_companyname_en        =      (this.ifarabic == true)?data.data.data[0].omrm_companyname_ar:data.data.data[0].omrm_companyname_en;
        this.omrm_tpname_en   =  (this.ifarabic == true)?data.data.data[0].omrm_tpname_ar:data.data.data[0].omrm_tpname_en;
         this.appiit_locmapurl = data.data.data[0].appiit_locmapurl; 
         
      
        this.sitecategory  = this.getSiteCategory(data.data.data)
          console.log(this.sitecategory, 'site  category')
          this.lastNumber = this.sitecategory.length;
      });    
     });
      
  } 

}

getSiteCategory(data) {
  return data.map(d =>{
           return {
             id: d.appsiteauditreportcattmp_pk , 
             name: d.asarct_categorytitle_en ,
             asarct_totalques:d.asarct_totalques , 
             asarct_grademst_fk: d.asarct_grademst_fk, 
             bronzePer: Math.round(d.asarct_bronze /d.asarct_totalques * this.bronzepercentage),
             silverPer: Math.round(d.asarct_silver /d.asarct_totalques * this.silverpercentage),goldPer:Math.round(d.asarct_gold /d.asarct_totalques * this.goldpercentage), 
             bronzescorefrom: this.bronzescorefrom,bronzescoreto: this.bronzescoreto,silverscorefrom: this.silverscorefrom ,
             silverscoreto: this.silverscoreto,
             goldscorefrom: this.goldscorefrom,
             goldscoreto: this.goldscoreto 
            }
          })
  } 

getappdata(data){
  this.categorygrade = data;
}
onValidation(form , resetForm){

  this.disableSubmit = true; 
   this.appservice.updateSite(form.value,this.appid,this.viewpage,this.categorygrade).subscribe(data => {
    this.disableSubmit = false;
     if(data.data.msg == 'false'){
      resetForm();
        swal({
          title: this.i18n('siteaudit.somewewron'),
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('siteaudit.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
         // this.standardTemplate = 'MainCentre';
        })
      }else{
       
        swal({
          title: this.i18n('siteaudit.statupdasucc'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('siteaudit.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
 
           this.route.navigate(['centrecertification/home/MQ==']);
        
        })
      }  
      });
   }
    matposition() {
      this.mattab=2;
    }
    goBack() {
      this._location.back(); 
    }
    calculatescore() {
      this.selectedbronze = 0;
      this.selectedsilver = 0;
      this.selectedgold =  0;
      this.categorygrade = 0;
      this.categoryname = '';
      (Object.keys(this.checkBoxAns) as []).forEach((key, index) => {
        let text = this.checkBoxAns[key];
        this.selectedall = [];
        text.forEach((element) => {
          var aray = element.split("_");
          this.selectedall.push(aray[0]);
        });
  
        if (this.selectedall.includes('2')) {
          this.selectedgold += 1;
        } else if (this.selectedall.includes('1')) {
          this.selectedsilver += 1;
        } else if (this.selectedall.includes('0')) {
          this.selectedbronze += 1;
        }
      });
        this.bronzeper = Math.round((this.selectedbronze / this.multichoisecount) * this.bronzepercentage);
        this.silverper = Math.round((this.selectedsilver / this.multichoisecount) * this.silverpercentage);
        this.goldper = Math.round((this.selectedgold / this.multichoisecount) *    this.goldpercentage);

        this.totalper = (this.bronzeper + this.silverper + this.goldper);
        if (this.totalper >= Number(this.sitecategory[this.mattab].bronzescorefrom) && this.totalper <= Number(this.sitecategory[this.mattab].bronzescoreto)) {
          this.categorygrade = 1;
          this.categoryname = 'Bronze';
        }
        if (this.totalper >= Number(this.sitecategory[this.mattab].silverscorefrom) && this.totalper <= Number(this.sitecategory[this.mattab].silverscoreto)) {
          this.categorygrade = 2;
          this.categoryname = 'Silver';
        }
        if (this.totalper >= Number(this.sitecategory[this.mattab].goldscorefrom) && this.totalper <= Number(this.sitecategory[this.mattab].goldscoreto)) {
          this.categorygrade = 3;
          this.categoryname = 'Gold';
        }
    }
}
