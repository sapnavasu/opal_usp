import { Component, OnInit, Input, ViewChild, Output, EventEmitter   } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router, Event, ActivatedRoute } from '@angular/router';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { ProfileviewdetailsComponent } from '../profileviewdetails/profileviewdetails.component';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { HttpClient } from '@angular/common/http';
@Component({
  selector: 'app-profilelistview',
  templateUrl: './profilelistview.component.html',
  styleUrls: ['./profilelistview.component.scss']
})
export class ProfilelistviewComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @Input() formpage:string="2";
  profileloader:boolean = false;
  initSpinner:boolean = true;
  masterdata: any = [];
  viewserviceid: number;
  @ViewChild('profileviewdetailsref') profileviewdetailsref: ProfileviewdetailsComponent;
  public viewForm: FormGroup;
  // drv_companylogo: DriveInput;
  constructor(private fb: FormBuilder,private profileservice: ProfileService,private routeid: ActivatedRoute,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    ) { }  

    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr";
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
  });
    this.routeid.params.subscribe(params => {
      if (params['id']) {
        this.viewserviceid = params['id'];
      }
    });
      this.profileservice.getUserbasicprofMaster(this.viewserviceid).subscribe(returndata => {
        this.masterdata = returndata.data['mstdata'];  
      });
    this.viewForm = this.fb.group({
      upload:[null,Validators.required],
    });
    
  }
  getprofileviewdetails(userpk){
    if(userpk == ''){
      userpk =this.viewserviceid
    }else{
      this.viewserviceid = userpk;
    }
    this.profileservice.getUserbasicprofMaster(userpk).subscribe(returndata => {
      this.masterdata = returndata.data['mstdata'];
      this.profileservice.getUserprofMaster(userpk).subscribe(returndata1 => {           
          this.profileviewdetailsref.masterdata = returndata1.data['mstdata'];
          this.profileviewdetailsref.certificate = returndata1.data['certificatedata'];
          this.profileviewdetailsref.addressists = returndata1.data['addressists'];     
          this.profileloader=false;  
           this.initSpinner = false;    
      });
    });
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }
}
