import { Injectable } from '@angular/core';
import { RemoteService } from '@app/remote.service';



@Injectable({
  providedIn: 'root'
})
export class IvmsdeviceService{
  _url = 'ivmsdev/device/';
  _registerurl: string = 'stkreg/register/';
  constructor(public http: RemoteService) { }


  getivmsdevicegriddata(limit,page,searchkey,sorting){
    let body = JSON.stringify({limit:limit,page:page,searchkey:searchkey,sorting:sorting});
    return this.http.post(this._url+'getivmsdevicegriddata',body).map(response => response.json());
  }

  getivmsvehiclregdlsbyvhclpk(vehiclPk)
  {
    return this.http.get(this._url + 'getivmsvehiclregdlsbyvhclpk?vclrgpk=' + vehiclPk).map(res => res.json());
  }

  getDeviceInfoByAppPk(appPk,pk)
  {
    return this.http.get(this._url + 'get-device-info-by-app-pk?appPk=' + appPk+'&exclPk='+pk).map(res => res.json());
  }

  getvehiclesubcatList(catPk)
  {
    return this.http.get(this._url + 'get-vehicle-subcat-list-by-catpk?catPk=' + catPk).map(res => res.json());
  }

  getVehicleCategoryIVMS()
  {
    return this.http.get(this._url + 'get-all-vehicle-categories-i-v-m-s').map(res => res.json());
  }

  getInstallationTechnician(appPk)
  {
    return this.http.get(this._url + 'get-instation-technician?appPk=' + appPk).map(res => res.json());
  }

  saveDeviceVehicleDtls(formValue)
  {
    
      let body = JSON.stringify({ vehicledtls: formValue });
      return this.http.post(this._url+'savevehicledtls',body).map(response => response.json());
    
  }

  getIVMSVehicleDtlsByPk(ivmsvcl_pk)
  {
    return this.http.get(this._url + 'getivmsvehicledtlsbypk?pk='+ivmsvcl_pk).map(res => res.json());
  }

  getIVMSVehicleRegistrationStatus(ivmsvcl_pk)
  {
    return this.http.get(this._url + 'getivmsvhclregstatus?pk='+ivmsvcl_pk).map(res => res.json());
  }

  getIVMSInspectionDetailsForEdit(ivmsvcl_pk)
  {
    return this.http.get(this._url + 'get-ivmsinspection-details-for-edit?vclrgpk=' + ivmsvcl_pk).map(res => res.json());
  }

  submitforapproval(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'submitforapproval',body).map(response => response.json());
  }
 
  getInstallationDtls(pk)
  {
    return this.http.get(this._url + 'get-installation-dtls?pk='+pk).map(res => res.json());
  }

  approvalSubmit(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'approval-submit',body).map(response => response.json());
  }

  IssueCertificate(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'issue-certificate',body).map(response => response.json());
  }

  printorviewcertificate(vehiclepk,type){
    let body = JSON.stringify({pk:vehiclepk,type:type});
    return this.http.post(this._url+'printorviewcertificate',body).map(response => response.json());
  }

  removedevice(vehiclepk){
    let body = JSON.stringify({pk:vehiclepk});
    return this.http.post(this._url+'removedevice',body).map(response => response.json());
  }

  getInstallationChecklistByVehicleRegPk(encpk)
  { 
    return this.http.get(this._url + 'get-ivms-checklist-by-vecl-regpk?vclrgpk=' + encpk).map(res => res.json());
  }

  renewIvmsVehicleRegistration(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'renew-ivms-vehicle-reg',body).map(response => response.json());
  }

  getInstallerlistByVehiclPk(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url + 'getinstallerlistbyvhclregpk' , body).map(res => res.json());
  }

  getAllPassAnswersForChklist(vehiclPk)
   {
     return this.http.get(this._url + 'get-all-pass-answers-for-chklist?vclrgpk=' + vehiclPk).map(res => res.json());
   }

   checkVehicleRegistered(vehiclenum?: any,regpk?: any){ 
    var responseBody = JSON.stringify({ data: vehiclenum, regpk:regpk })
    return this.http.post(this._url+'checkvehicleregistered',responseBody).map(res => res.json());
  }

  checkVehicleNum(vehiclenum?: any,regpk?: any){ 
    var responseBody = JSON.stringify({ data: vehiclenum, regpk:regpk, type: 'ivmsvehiclenum' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }
  checkChassNum(chassnum?: any,regpk?: any){
    var responseBody = JSON.stringify({ data: chassnum,  regpk:regpk, type: 'ivmschassnum' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }

  declineSubmit(formData)
  {
    let body = JSON.stringify({formData:formData});
    return this.http.post(this._url+'declinesubmit',body).map(response => response.json());
  }
  cancelRegistration(pk)
  {
    let body = JSON.stringify({reg_pk:pk});
    return this.http.post(this._url+'cancelregistration',body).map(response => response.json());
  }

  
  exportIvmsGridData(limit,page,searchkey,visiblecoulumns){
    let body = JSON.stringify({limit:limit,page:page,searchkey:searchkey,columns:visiblecoulumns});
    return this.http.post(this._url+'export-ivms-grid-data',body).map(response => response.json());
  }

  getsamplefileurl(){
    return this.http.get(this._url+'getsampleurl').map(res => res.json());
  }

  ExcelIvmsImportValidate(file){
    let body = JSON.stringify({file:file});
    return this.http.post(this._url+'importivmsexceldata',body).map(response => response.json());
  }

  ivmscertificate(vehiclepk,isregen){
    let body = JSON.stringify({pk:vehiclepk,isregen:isregen});
    return this.http.post(this._url+'ivmscertificate',body).map(response => response.json());
  }

  getnumberofinstalations(devPk){
    let body = JSON.stringify({pk:devPk});
    return this.http.post(this._url+'getnumberofinstalations',body).map(response => response.json());
  }

  
}