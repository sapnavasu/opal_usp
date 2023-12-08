import { Component, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { MatTable } from '@angular/material/table';
import { Encrypt } from '@app/common/class/encrypt';
import { Router } from '@angular/router';
import moment from 'moment';
export interface Inspectionpending {
  vehicleno: string;
  ownername: string;
  inspectiondate: string;
  assignedinspector: string;
  status:string;
  pk: string;
}

export interface Verificationpending {
  vvehicleno: string;
  vownername: string;
  pending: any;
  inspectby: string;
  vpk:string;
}

export interface Approvalpending {
  avehicleno: string;
  aownername: string;
  pending_since: any;
  inspect_by: string;
  apk:string;
}


@Component({
  selector: 'app-pendinglistaccordion',
  templateUrl: './pendinglistaccordion.component.html',
  styleUrls: ['./pendinglistaccordion.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class PendinglistaccordionComponent implements OnInit {
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"; 
  counts: any;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private encrypt: Encrypt,
    private myRoute:Router,
    private cookieService: CookieService) { }

  ipdisplayedColumns: string[] = ['vehicleno', 'ownername', 'inspectiondate', 'assignedinspector'];
  ipdataSource : Inspectionpending[];

  vpdisplayedColumns: string[] = ['vvehicleno', 'vownername', 'pending','inspectby'];
  vpdataSource : Verificationpending[];

  apdisplayedColumns: string[] = ['avehicleno', 'aownername', 'pending_since' , 'inspect_by'];
  apdataSource : Approvalpending[];
  

  @Input('rasVehicleData') rasVehicleData: any;
  @ViewChild(MatTable) tableinsp: MatTable<any>;
  @ViewChild(MatTable) tableverifier: MatTable<any>;
  ngOnInit() { 
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

    this.updateRasData();
  }

  updateRasData()
  {
    let array =[];
    Object.keys(this.rasVehicleData['inspection']).forEach(keys => {
      let obj = {
        vehicleno: this.rasVehicleData['inspection'][keys].rvrd_vechicleregno,
        ownername: this.rasVehicleData['inspection'][keys].rvod_ownername_en,
        inspectiondate: this.rasVehicleData['inspection'][keys].rvrd_dateofinsp ?  moment(this.rasVehicleData['inspection'][keys].rvrd_dateofinsp).format('DD-MM-YYYY').toString() : null,
        inspectionstart: this.rasVehicleData['inspection'][keys].rvrd_inspstarttime ?  moment(this.rasVehicleData['inspection'][keys].rvrd_inspstarttime).format('hh:mm A').toString() : null,
        inspectiondateend: this.rasVehicleData['inspection'][keys].rvrd_inspendtime ? moment(this.rasVehicleData['inspection'][keys].rvrd_inspendtime).format('hh:mm A').toString() : null,
        assignedinspector: this.rasVehicleData['inspection'][keys].Inspector_name,
        status: this.rasVehicleData['inspection'][keys].rvrd_inspectionstatus,
        pk: this.rasVehicleData['inspection'][keys].rasvehicleregdtls_pk
       
      }
      array.push(obj);
    });
    this.ipdataSource = array ;

    let arrayverifier =[];
    Object.keys(this.rasVehicleData['verification']).forEach(keys => {
      let obj = {
        vvehicleno: this.rasVehicleData['verification'][keys].rvrd_vechicleregno,
        vownername: this.rasVehicleData['verification'][keys].rvod_ownername_en,
        pending: this.rasVehicleData['verification'][keys].Pending_since ?  moment(this.rasVehicleData['verification'][keys].Pending_since).format('DD-MM-YYYY').toString() : null,
        inspectby: this.rasVehicleData['verification'][keys].Inspected_by,
        vpk: this.rasVehicleData['verification'][keys].rasvehicleregdtls_pk
       
      }
      arrayverifier.push(obj);
    });
    this.vpdataSource = arrayverifier ;
    console.log(this.vpdataSource.length)

    let arrayapproval =[];
    Object.keys(this.rasVehicleData['approval']).forEach(keys => {
      let obj = {
        avehicleno: this.rasVehicleData['approval'][keys].rvrd_vechicleregno,
        aownername: this.rasVehicleData['approval'][keys].rvod_ownername_en,
        pending_since:  this.rasVehicleData['approval'][keys].Pending_since ?  moment(this.rasVehicleData['approval'][keys].Pending_since).format('DD-MM-YYYY').toString() : null,
        inspect_by: this.rasVehicleData['approval'][keys].verified_by,
        apk: this.rasVehicleData['approval'][keys].rasvehicleregdtls_pk
        
      }
      arrayapproval.push(obj);
    });
    this.apdataSource = arrayapproval ;

    this.counts = this.rasVehicleData['counts'];
    
  }

  navigate(role){
    var idName=this.encrypt.encrypt(role);
      this.myRoute.navigate(['vehiclemanagement/vehiclelisting'],{ queryParams: {grid: role}});
  }

 
  viewdetails(vehNo) {
    let encregpk = this.encrypt.encrypt(vehNo);
    this.myRoute.navigate(['/vehiclemanagement/vehicleinspectionstatus/view'],{ queryParams: { bc: 'spym',p:encregpk }});
  }

}
