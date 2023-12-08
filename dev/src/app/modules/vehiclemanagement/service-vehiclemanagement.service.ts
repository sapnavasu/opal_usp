import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { PRINT_SCREEN } from '@angular/cdk/keycodes';

@Injectable({
  providedIn: 'root'
})
export class ServiceVehiclemanagementService {
  
  _url = 'ras/ras/';

  constructor(public http: RemoteService) { }

  
  getrasgriddata(limit,page,searchkey){
    let body = JSON.stringify({limit:limit,page:page,searchkey:searchkey});
    return this.http.post('ras/ras/getrasgriddata',body).map(response => response.json());
  }
  getrasgridviewdata(pk){
    let body = JSON.stringify({pk:pk});
    return this.http.post('ras/ras/getrasgridviewdata',body).map(response => response.json());
  }

  getTechnicalEvalutionCentres(prjPk)
  {
    let body = JSON.stringify({prjPk:prjPk});
    return this.http.post(this._url + 'get-techevalutioncentres',body).map(res => res.json());
  }

  getBranchlistbyregpk(regPk,prjPk)
  {
    return this.http.get(this._url + 'getbranchlistbyregpk?regpk=' + regPk+'&prjPk='+prjPk).map(res => res.json());
  }


  getVehicleCategoryByAppPk(appPk)
  {
    return this.http.get(this._url + 'get-all-vehicle-categories-by-app-pk?appPk=' + appPk).map(res => res.json());
  }
  getInspectorname(appPk)
  {
    return this.http.get(this._url + 'getinspectorname?appPk=' + appPk).map(res => res.json());
  }
  getmasterlistbyType(refpk)
  {
    return this.http.get(this._url + 'get-masters-list-by-type?refpk='+refpk).map(res => res.json());
  }

  saveVehicleDtls(formValue)
  {
    
      let body = JSON.stringify({ vehicledtls: formValue });
      return this.http.post(this._url+'savevehicledtls',body).map(response => response.json());
    
  }
  rassticker(vehiclepk,isregen){
    let body = JSON.stringify({pk:vehiclepk,isregen:isregen});
    return this.http.post(this._url+'rassticker',body).map(response => response.json());
  }
  // 

  printorviewrassticker(vehiclepk,type){
    let body = JSON.stringify({pk:vehiclepk,type:type});
    return this.http.post(this._url+'printorviewrassticker',body).map(response => response.json());
  }

  getPreviousOwnerList(type=1,data='')
  {
    return this.http.get(this._url + 'getpreviousownerlist?type='+type+'&data='+data).map(res => res.json());
  }

  getVehicleDtlsByPk(vcl_pk)
  {
    return this.http.get(this._url + 'getvehicledtlsbypk?pk='+vcl_pk).map(res => res.json());
  }

  getVehicleRegistrationStatus(vcl_pk)
  {
    return this.http.get(this._url + 'getvhclregstatus?pk='+vcl_pk).map(res => res.json());
  }

  moveToVerifier(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'movetoverifier',body).map(response => response.json());
  }
  moveToSupervisor(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'movetosupervisor',body).map(response => response.json());
  }
  moveToInspector(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'movetoinspectorvalidating',body).map(response => response.json());
  }
  IssueSticker(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'issue-sticker',body).map(response => response.json());
  }

  getInspectionDtls(pk)
  {
    return this.http.get(this._url + 'get-inspection-dtls?pk='+pk).map(res => res.json());
  }

  getInspectorlistByVehiclPk(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url + 'getinspectorlistbyvhclregpk' , body).map(res => res.json());
  }

  renewVehicleRegistration(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'renew-vehicle-reg',body).map(response => response.json());
  }

  getInspectionChecklistByVehicleRegPk(encpk)
  { 
    return this.http.get(this._url + 'get-checklist-by-vecl-regpk?vclrgpk=' + encpk).map(res => res.json());
  }

  
  checkVehicleRegistered(vehiclenum?: any,regpk?: any){ 
    var responseBody = JSON.stringify({ data: vehiclenum, regpk:regpk })
    return this.http.post(this._url+'checkvehicleregistered',responseBody).map(res => res.json());
  }
  getIvmsvehicledata(vehiclenum?: any,regpk?: any)
  {
    var responseBody = JSON.stringify({ data: vehiclenum, regpk:regpk })
    return this.http.post(this._url+'getivmsvehicledata',responseBody).map(res => res.json());

  }

  getInspectionDetailsForEdit(vehiclPk)
  {
    return this.http.get(this._url + 'get-inspection-details-for-edit?vclrgpk=' + vehiclPk).map(res => res.json());
  }

  getvehiclregdlsbyvhclpk(vehiclPk)
  {
    return this.http.get(this._url + 'getvehiclregdlsbyvhclpk?vclrgpk=' + vehiclPk).map(res => res.json());
  }

  cancelvehicle(vehiclepk){
    let body = JSON.stringify({pk:vehiclepk});
    return this.http.post(this._url+'cancelvehicle',body).map(response => response.json());
   }

   getAllPassAnswersForChklist(vehiclPk)
   {
     return this.http.get(this._url + 'get-all-pass-answers-for-chklist?vclrgpk=' + vehiclPk).map(res => res.json());
   }


   exportGridData(limit,page,searchkey,visiblecoulumns){
    let body = JSON.stringify({limit:limit,page:page,searchkey:searchkey,columns:visiblecoulumns});
    return this.http.post('ras/ras/export-grid-data',body).map(response => response.json());
  }

  ExcelImportValidate(file){
    let body = JSON.stringify({file:file});
    return this.http.post('ras/ras/importexceldata',body).map(response => response.json());
  }

  getsamplefileurl() {
    return this.http.get('ras/ras/getsampleurl').map(res => res.json());
  }

  getstaffdetailsoncompetancyras(pk,category,vehiclepk){
    let body = JSON.stringify({pk:pk,category:category,vehiclepk:vehiclepk});
    return this.http.post('ras/ras/getstaffdetailsoncompetancyras',body).map(response => response.json());
  }

  getCivino()
  {
    let body = JSON.stringify({});
    return this.http.post(this._url+'get-civilno',body).map(response => response.json());
  }
}
