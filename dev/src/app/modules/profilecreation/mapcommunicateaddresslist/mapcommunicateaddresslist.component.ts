import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import swal from 'sweetalert';
import { FormControl, Validators } from '@angular/forms';
import { MatDrawer } from '@angular/material/sidenav';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-mapcommunicateaddresslist',
  templateUrl: './mapcommunicateaddresslist.component.html',
  styleUrls: ['./mapcommunicateaddresslist.component.scss']
})
export class MapcommunicateaddresslistComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  @Input('mappingdrawer') mappingdrawer: MatDrawer;  
  animationState3 = 'out';
  public buttonname: string = this.i18n('mapcommunicte.map');
  headoffice: any = [];
  branchoffice: any = [];
  registedoffice: any = [];
  selectedStatus: number;
  representativeoff: any = [];
  @Input() resultmsg: any;
  @Input() addressid: number;
  @Output() valueChange = new EventEmitter();

  addressmap: FormControl= new FormControl('',Validators.required);
  constructor(private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private profileservice: ProfileService) { }
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
    this.profileservice.getcommunicadd().subscribe(returndata => {
        this.headoffice = returndata.data['headquoff'];
        this.branchoffice = returndata.data['branchoff'];
        this.registedoffice = returndata.data['registedoff'];
        this.representativeoff = returndata.data['represetiveoff'];
    });
  }
  ngOnChanges(){
    if(this.addressid){
      this.buttonname = this.i18n('mapcommunicte.upda');
      this.selectedStatus = this.addressid;
      this.addressmap.setValue(this.addressid);
    }
  }

  mapcommincatelistview(divName: string) {
    if (divName === 'mappinglistview') {
      this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
    }
  }
  onSubmitcommunicadd(type) {
    if(this.addressmap.valid || type == 'Update'){
      this.profileservice.savecommunadduserinfo(this.addressmap.value).subscribe(resdata => {
        this.buttonname = this.i18n('mapcommunicte.map');
        this.resultmsg = resdata.data['statusmsg'];
          if (this.resultmsg == "success") {
            this.valueChange.emit(resdata.data['returndata']);
            this.mappingdrawer.toggle();
          }
      });
    }
  }
  clearformadd(){
    this.addressmap.reset();
  }
  mappingAlert() {
    swal({
      title: this.i18n('mapcommunicte.doyouwantcommaddr'),
      text: this.i18n('mapcommunicte.allthedata'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('mapcommunicte.canc'), this.i18n('mapcommunicte.okbutton')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        if(this.addressid){
          this.selectedStatus = this.addressid;
          this.addressmap.setValue(this.addressid);
        }
        this.mappingdrawer.toggle();
      }
    });
    this.animationState3 = 'out';
  }

}
