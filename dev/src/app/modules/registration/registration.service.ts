import { EventEmitter, Injectable, Output } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class RegistrationService {
  _url: string = 'ea/user/';
  _registerurl: string = 'stkreg/register/';
  @Output() agreeData: EventEmitter<any> = new EventEmitter();
  @Output() readaccept: EventEmitter<any> = new EventEmitter();
  usercheck: any;
  constructor(private http: RemoteService,
    private httpClient: HttpClient) { }
    
  agreeFuncation(value) {
    this.agreeData.emit(value);
    this.usercheck = value;
  }
  agreeFuncationreadaccept(value) {
    this.readaccept.emit(value);
  }
  inviteData(pk: string){
    let body = JSON.stringify({ invitepk: pk });
    return this.http.post(this._url+'invitedtls',body).map(response => response.json());
  }

  inviteUser(emails){
    let body = JSON.stringify({ invite: emails});
    return this.http.post(this._url+'inviteuser',body).map(response => response.json());
  }
  

  businesssourceList(){
    return this.http.get('mst/bussource/businesssourcelist').map(response => response.json());
  }
  getuserdetails(pk:any){
    return this.http.get(this._registerurl+'getuserdtlsreg?pk='+pk).map(response => response.json());
  }
  getpaymnetinfo(value:any){
    let body = JSON.stringify({ value: value });
    return this.http.post(this._registerurl+'getpaymnetinfo',body).map(response => response.json());
  }
  validatepaymentlink(userpk: any) {
    return this.http.post( this._registerurl+'validatepaymentlink',
      JSON.stringify({'userpk': userpk})
    ).map(response => response.json());
  }
  sendverifyotp(value:any,type:any,companyname?:any, stkpk?:any){
    let body = JSON.stringify({ value: value, type:type ,companyname:companyname,stkpk:stkpk});
    return this.http.post(this._registerurl+'sendverifyotp',body).map(response => response.json());
  }
  verifyotpdata(value:any,otp:any,type:any){
    let body = JSON.stringify({ 'value': value,'otp':otp, 'type':type });
    return this.http.post(this._registerurl+'validateverifyotp',body).map(response => response.json());
  }
  sendverifyotpdb(value:any,type:any,pk:any,from?:any){
    let body = JSON.stringify({ value: value, type:type,'pk':pk,'from':from});
    return this.http.post(this._registerurl+'sendverifyotpdb',body).map(response => response.json());
  }
  verifyotpdatadb(value:any,otp:any,type:any,pk:any,from?:any){
    let body = JSON.stringify({ 'value': value,'otp':otp, 'type':type,'pk':pk ,'from':from});
    return this.http.post(this._registerurl+'validateverifyotpdb',body).map(response => response.json());
  }

  remindtwofactor(pk:any){
    let body = JSON.stringify({ 'pk':pk });
    return this.http.post(this._registerurl+'remindtwofactor',body).map(response => response.json());
  }

  getIndustrialZoneList(){
    return this.http.get(this._registerurl+'get-industrial-zone-list').map(response => response.json());
  }

  getindustrialestbyzoneid(zone: any) {
    return this.http.get(this._registerurl+'get-industrial-estate-list-by-id?zoneid=' + zone).map(response => response.json());
  }

  setAuthentication(value:any,pk:any) {
    return this.http.get(this._registerurl+'setauthentication?value=' + value+'&pk='+pk).map(response => response.json());
  }

  submitUserInformation(formValue, emailId){
    let body = JSON.stringify({ userdtls: formValue, emailId:emailId });
    return this.http.post(this._url+'save-invited-user-dtls',body).map(response => response.json());
  }

  submitInvestorRegistration(formValue){
    let body = JSON.stringify({ investordtls: formValue });
    return this.http.post(this._registerurl+'saveinvestor',body).map(response => response.json());
  }
  submitProjectOwnerRegistration(formValue){
    let body = JSON.stringify({ projownerdtls: formValue });
    return this.http.post(this._registerurl+'saveprojowner',body).map(response => response.json());
  }

  submitSupplierRegistration(formValue){
    let body = JSON.stringify({ centerdtls: formValue });
    return this.http.post(this._registerurl+'savecentre',body).map(response => response.json());
  }

  submitBuyerRegistration(formValue){
    let body = JSON.stringify({ buyerdtls: formValue });
    return this.http.post(this._registerurl+'savebuyer',body).map(response => response.json());
  }

  getuserIp() {
    return this.httpClient.get('https://ipapi.co/json/');
  }

  getsocilalist() {
    return this.http.get('mst/socialmedia/socialmedia').map(res => res.json());
  }

  applypromocode(promocode?: any,classificationdetails?:any,subsciptionpk?:any,countrypk?:any){
    return this.http.get('stkreg/register/applypromocode?promocode=' + promocode+'&classfication='+classificationdetails+'&subsciptionpk='+subsciptionpk+'&countrypk='+countrypk).map(res => res.json());
  }
  
  getPackagedtl(stktype?:any,headcount?: any,annualsales?: any,validityperiod?:any,origin?:any,classificationmst_pk?:any){
    // let formParam = JSON.stringify({ 'headcount': headcount, 'annualsales': anualsales ,'years':validityperiod});
    // return this.http.post('stkreg/register/getpackagedtl',formParam).map(res => res.json());
    // let body = JSON.stringify({ headcount: headcount, anualsales: anualsales,validityperiod: validityperiod});
    // return this.http.post(this._registerurl+'setsubcription',body).map(response => response.json());
    return this.http.get('stkreg/register/getpackagedtl?stktype='+stktype+'&headcount=' + headcount+'&annualsales='+annualsales+'&years='+validityperiod+'&origin='+origin+'&classificationPk='+classificationmst_pk).map(res => res.json());
  }
  getfeedetails(validityperiod?:any,origin?:any){
    // let formParam = JSON.stringify({ 'headcount': headcount, 'annualsales': anualsales ,'years':validityperiod});
    // return this.http.post('stkreg/register/getpackagedtl',formParam).map(res => res.json());
    // let body = JSON.stringify({ headcount: headcount, anualsales: anualsales,validityperiod: validityperiod});
    // return this.http.post(this._registerurl+'setsubcription',body).map(response => response.json());
    return this.http.get('stkreg/register/getfeedetails?years='+validityperiod+'&origin='+origin).map(res => res.json());
  }
  getheadcountlist(value){
    return this.http.get('stkreg/register/getheadcountlist?stkpk='+value).map(res => res.json());
  }
 /*  getIPdetails(countrycode){
    
    return this.http.post('stkreg/register/getipdetails',countrycode).map(response => response.json());
  } */

  getConfiguration(){
    return this.http.get('stkreg/register/get-configurations').map(res => res.json());
  }
  getMoherigradinglist(){
    return this.http.get('stkreg/register/getmoherigradinglist').map(res => res.json());
  }

  getrightsidecardcounts() {
    return this.http.get('stkreg/register/getrightcardcounts').map(res => res.json());
  }

  getwebinarexhibitionist(type?: number) {
    return this.http.get('mst/webexh/webexhlist?type=' + type).map(res => res.json());
  }

  getOfflineRegData() {
    return this.http.get(this._registerurl+'viewofflineregdata').map(res => res.json());
  }

  storeOfflineFormData(formValue: any) {
    let body = JSON.stringify({ formValue: formValue });
    return this.http.post(this._registerurl+'writeregjsonfile',body).map(response => response.json());
  }
  storeOfflineFormDataReg(formValue: any) {
    let body = JSON.stringify({ formValue: formValue });
    return this.http.post(this._registerurl+'writeregjsonfile',body).map(response => response.json());
  }

  removeOfflineData(formValue: any) {
    let body = JSON.stringify({ formValue: formValue });
    return this.http.post(this._registerurl+'removeregjsonfile',body).map(response => response.json());
  }
  writeregFormDatajson(formValue)
  {
    return this.http.post(this._registerurl+'regformdata',formValue).map(response => response.json());
  }
  getClassificationDtlsbyuserpk(encryptedUserPk: any) {
    
    return this.http.post(this._registerurl+'get-classification-dtlsbyuserpk',encryptedUserPk).map(response => response.json());
  }

  updatepayment(comppk: any) {
    
    return this.http.post(this._registerurl+'updatepayment',comppk).map(response => response.json());
  }

  checkCompanyNameEn(companyname: string,regpk?: any, stkholderType?: any){
    var responseBody = JSON.stringify({ data: companyname, regpk:regpk, stkholderType: stkholderType, type: 'companynameen' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }
  checkCompanyNameAr(companyname: string,regpk?: any, stkholderType?: any){
    var responseBody = JSON.stringify({ data: companyname, regpk:regpk, stkholderType: stkholderType, type: 'companynamear' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }

  checkEmail(email?: string,regpk?: any, stkholderType?: any){
    var responseBody = JSON.stringify({ data: email, regpk:regpk, stkholderType: stkholderType, type: 'focalpointemailid' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }

  checkCRNumber(crNumber?: any, countryPk?: any,regpk?: any){
    var responseBody = JSON.stringify({ data: crNumber, country: countryPk, regpk:regpk, type: 'compcrno' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }
  checkOpalMemNumber(opalmemno?: any, countryPk?: any,regpk?: any){
    var responseBody = JSON.stringify({ data: opalmemno, country: countryPk, regpk:regpk, type: 'opalmembno' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }

  cancelRegistration(regpk: any) {
    return this.http.post(this._registerurl+'cancel-registration',regpk).map(response => response.json());
  }

  checkVehicleNum(vehiclenum?: any,regpk?: any){ 
    var responseBody = JSON.stringify({ data: vehiclenum, regpk:regpk, type: 'vehiclenum' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }
  checkChassNum(chassnum?: any,regpk?: any){
    var responseBody = JSON.stringify({ data: chassnum,  regpk:regpk, type: 'chassnum' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }
  checkIVMSSerialNum(ivmsserial?: any,regpk?: any){
    var responseBody = JSON.stringify({ data: ivmsserial,  regpk:regpk, type: 'ivmsserialnum' })
    return this.http.post(this._registerurl+'checkalreadyexists',responseBody).map(res => res.json());
  }

  

  // 
}
