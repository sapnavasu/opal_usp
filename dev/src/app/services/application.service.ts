import { EventEmitter, Injectable, Output } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { PRINT_SCREEN } from '@angular/cdk/keycodes';

@Injectable({
  providedIn: 'root'
})
export class ApplicationService{
  _url = 'center/app-center/';
  @Output() questArray: EventEmitter<any> = new EventEmitter();
  @Output() submitForm: EventEmitter<any> = new EventEmitter();
  @Output() finalTabData: EventEmitter<any> = new EventEmitter(); 
  constructor(public http: RemoteService) { }


  

  
  aprefid(app_ref_id) {

    let body = JSON.stringify({ 'id': app_ref_id });

    return this.http.post(this._url + 'aprefid' , body).map(res => res.json());
  } 

  validbtnshoworhide() {

    return this.http.get(this._url + 'validbtnshoworhide').map(res => res.json());
  } 
  
  finanacevalidbtn() {

    return this.http.get(this._url + 'finanacevalidbtn').map(res => res.json());
  } 

  overallapprovdec(app_ref_id, select_valitate, comments) {

    let body = JSON.stringify({ 'app_ref_id': app_ref_id,'id': app_ref_id,'select_valitate':select_valitate,'comments':comments });
    return this.http.post(this._url + 'overallapprovdec',body).map(res => res.json());
  } 
  
  
  staffapproved(staffinfotmp_pk,staff_id,status,status_info,reportdocument,percentage,mark,comments) {

    let body = JSON.stringify({ 'status': status,'staffinfotmp_pk':staffinfotmp_pk,'staff_id':staff_id,'comments':comments,'status_info':status_info,'reportdocument':reportdocument,'percentage':percentage,'mark':mark });
    return this.http.post(this._url + 'staffapprodecproce',body).map(res => res.json());
  } 


 
  getworkexp(id,staff_id) {

  let body = JSON.stringify({ 'id': id,'staff_id':staff_id });
  return this.http.post(this._url + 'getworkexp',body).map(res => res.json());
} 

  geteducationqulification(id,id1) {

    let body = JSON.stringify({ 'id': id,'id1':id1 });
    return this.http.post(this._url + 'geteducationqulification',body).map(res => res.json());
  } 
  setvalueaccseorloca(id,id1) {

    let body = JSON.stringify({ 'id': id,'id1':id1 });
    return this.http.post(this._url + 'getstaffassesorloca',body).map(res => res.json());
  } 

  setvaluestaffavailabledate(id,id1) {

    let body = JSON.stringify({ 'id': id,'id1':id1 });
    return this.http.post(this._url + 'getstaffavailabledate',body).map(res => res.json());
  } 

  setValuestaffview(id,asit_id) {

    let body = JSON.stringify({ 'id': id,'asit_id':asit_id });
    return this.http.post(this._url + 'getvaluestaffview',body).map(res => res.json());
  } 
  
  
  getstafftab(id) {

    let body = JSON.stringify({ 'id': id });
    return this.http.post(this._url + 'getstaffttab',body).map(res => res.json());
  } 
  getstafftabdata(id,limit,page,serachkey) {

    let body = JSON.stringify({ 'id': id,limit:limit,page:page,serachkey:serachkey });
    return this.http.post(this._url + 'getstaffttabdata',body).map(res => res.json());
  }
  getdocumenttab(id) {

    let body = JSON.stringify({ 'id': id });
    return this.http.post(this._url + 'getdocumenttab',body).map(res => res.json());
  } 


  getinternationaltab(id) {

    let body = JSON.stringify({ 'id': id });
    return this.http.post(this._url + 'getinternational',body).map(res => res.json());
  } 
 
  

  staffstatusChange(id,select_valitate,comments) {

    let body = JSON.stringify({ 'id': id , 'select_valitate':select_valitate, 'comments':comments});
    return this.http.post(this._url + 'stafftatuschanged',body).map(res => res.json());
  }

  documnetstatusChange(id,select_valitate,comments,documentapproved_id) {

    let body = JSON.stringify({ 'id': id , 'select_valitate':select_valitate, 'comments':comments,'documentapproved_id':documentapproved_id});
    return this.http.post(this._url + 'docstatuschanged',body).map(res => res.json());
  }

  internationalstatusChange(id,select_valitate,comments,international_id) {

    

    let body = JSON.stringify({ 'id': id , 'select_valitate':select_valitate, 'comments':comments,'international_id':international_id});
    return this.http.post(this._url + 'interstatuschanged',body).map(res => res.json());
  }

  statusChange(id,select_valitate,comments) {

    let body = JSON.stringify({ 'id': id , 'select_valitate':select_valitate, 'comments':comments});
    return this.http.post(this._url + 'desktopreviewstatuschanged',body).map(res => res.json());
  }



  getsccatabledata(desktopfilter,limit, page, searchkey,filterDataPage: any = null) {

    let body = JSON.stringify({ 'desktopfilter': desktopfilter,limit:limit ,page:page,searchkey:searchkey , sort: filterDataPage.sortFiled, order: filterDataPage.order});
    return this.http.post(this._url + 'standaradcustomize',body).map(res => res.json());
  }


  setValueStandaradCustomizeApproval(id) {

    let body = JSON.stringify({ 'id': id });
    return this.http.post(this._url + 'getonerecordstandaradcustomize?',body).map(res => res.json());


  }

  checkallapprovedornot(id) {

    let body = JSON.stringify({ 'id': id });
    return this.http.post(this._url + 'checkallapprovedornot?',body).map(res => res.json());


  }
  

  getappregdtls(projecttype) {
    let body = JSON.stringify({ projecttype: projecttype });
    return this.http.post(this._url + 'get-reg-dtls',body).map(res => res.json());
  }

  savecompdtls(formValue,appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ comdtls: formValue });
    return this.http.post(this._url+'savecompdtls',body).map(response => response.json());
  }

  saveinsdtls(formValue,appdtlstmp_id,projecttype){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['projecttype'] = projecttype;
    let body = JSON.stringify({ insdtls: formValue });
    return this.http.post(this._url+'saveinsdtls',body).map(response => response.json());
  }

  saveInternational(formValue,appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ insdtls: formValue });
    return this.http.post(this._url+'saveintrdtls',body).map(response => response.json());
  }

  getappinterrecdtls() {
    return this.http.get(this._url + 'getinterrecdtls').map(res => res.json());
  }

  saveOperContr(formValue,appdtlstmp_id) {
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ oprcontr: formValue });
    return this.http.post(this._url+'saveoprcontr',body).map(response => response.json());
  }

  saveCourse(formValue,appdtlstmp_id,memReg) {
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['appoct_opalmemberregmst_fk'] = memReg;
    let body = JSON.stringify({ course: formValue });
    return this.http.post(this._url+'savecourse',body).map(response => response.json());
  }

  saveStaff(formValue,appdtlstmp_id,projecttype) {
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['projecttype'] = projecttype;
    let body = JSON.stringify({ staff: formValue });
    return this.http.post(this._url+'savestaff',body).map(response => response.json());
  }
  staffconfigurationcheckinras(appdtlstmp_id,projecttype) {
    var formValue ={};
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['projecttype'] = projecttype;
    let body = JSON.stringify({ staff: formValue });
    return this.http.post(this._url+'staffconfigurationcheckinras',body).map(response => response.json());
  }
  rascheckvehicalcateforymap(appdtlstmp_id,rascatpk,projecttype) {
    var formValue ={};
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['rascatpk'] = rascatpk;
    formValue['projecttype'] = projecttype;
    let body = JSON.stringify({ formValue });
    return this.http.post(this._url+'rascheckvehicalcateforymap',body).map(response => response.json());
  }
  getcoursedata(){
    let body = JSON.stringify({ insdtls: 'formValue' });
    return this.http.post('cm/coursemanagement/getcourse',body).map(response => response.json());
  }
  getdocmstdata(standorcustom,standpk,reqfor){
    let body = JSON.stringify({ standorcustom: standorcustom ,standpk:standpk,reqfor:reqfor});
    return this.http.post('cm/coursemanagement/getdocmstdata',body).map(response => response.json());
  }
  getstaffsubcategory(pk){
    let body = JSON.stringify({ fk: pk });
    return this.http.post('cm/coursemanagement/getstaffsubcategory',body).map(response => response.json());

  }
  savedocuments(data,referencepk,type){
    let body = JSON.stringify({ data: data,referencepk:referencepk,type });
    return this.http.post('cm/coursemanagement/savedocuments',body).map(response => response.json());
  }
  getcustomcourse(){
    let body = JSON.stringify({ insdtls: 'formValue' });
    return this.http.post('cm/coursemanagement/getcustomcourse',body).map(response => response.json());
  }
  getstaffsinfo(institutepk){
    let body = JSON.stringify({ institutepk: institutepk });
    return this.http.post('cm/coursemanagement/getstaffcivilid',body).map(response => response.json());
  }


  getseccategory(pk,type){
    let body = JSON.stringify({ pk:pk,type:type });
    return this.http.post('cm/coursemanagement/getseccategory',body).map(response => response.json());
  }
  getunit(pk,limit,page){
    let body = JSON.stringify({ pk:pk,limit:limit,page:page });
    return this.http.post('cm/coursemanagement/getunit',body).map(response => response.json());
  }

  getintnatrecogmst(standorsurtom){
    let body = JSON.stringify({ standorcustom: standorsurtom });
    return this.http.post('cm/coursemanagement/getintnatrecogmst',body).map(response => response.json());
  }
  getcountrymst(){
    let body = JSON.stringify({ });
    return this.http.post('cm/coursemanagement/getcountrymst',body).map(response => response.json());
  }
  getstatemst(countryfk){
    let body = JSON.stringify({ countryfk: countryfk });
    return this.http.post('cm/coursemanagement/getstatemst',body).map(response => response.json());
  }
  getcitymst(statefk){
    let body = JSON.stringify({ statefk: statefk });
    return this.http.post('cm/coursemanagement/getcitymst',body).map(response => response.json());
  }
  getstaffinfo(fks){
    let body = JSON.stringify({ fks: fks });
    return this.http.post('cm/coursemanagement/getstaffinfo',body).map(response => response.json());
  }
  getstaffavialabe(fks,referencek){
    let body = JSON.stringify({ fks: fks,referencek:referencek });
    return this.http.post('cm/coursemanagement/getstaffavialabe',body).map(response => response.json());
  }
  checkcivilnum(civilnum,appinstinfomain_pk,referencek){
    let body = JSON.stringify({ civilnum: civilnum,appinstinfomain_pk:appinstinfomain_pk ,referencek:referencek});
    return this.http.post('cm/coursemanagement/checkcivilnum',body).map(response => response.json());
  }
  applycertificate(data){
    let body = JSON.stringify({ value: data });
    return this.http.post('cm/coursemanagement/applycertificate',body).map(response => response.json());
  }
  savestaff(data){
   
    return this.http.post('cm/coursemanagement/savestaff',data).map(response => response.json());
  }
  savestaffedu(data,type){
    let body = JSON.stringify({ data: data,type:type });
    return this.http.post('cm/coursemanagement/savestaffedu',body).map(response => response.json());
  }
  savestaffwork(data,type){
   
    let body = JSON.stringify({ data: data,type:type });
    return this.http.post('cm/coursemanagement/savestaffwork',body).map(response => response.json());
  }
  addcourse(data,type){
    let body = JSON.stringify({ data:data,type:type });
    return this.http.post('cm/coursemanagement/addcourse',body).map(response => response.json());
  }
  saveinternational(data,type,apptype){
    let body = JSON.stringify({ data:data,type:type,apptype:apptype });
    return this.http.post('cm/coursemanagement/saveinternational',body).map(response => response.json());
  }
  getinterawardorgandata(awardpk){
    let body = JSON.stringify({ awardpk:awardpk});
    return this.http.post('cm/coursemanagement/getinterawardorgandata',body).map(response => response.json());
  }
  stafffinalsave(data,type){
    let body = JSON.stringify({ data:data,type:type });
    return this.http.post('cm/coursemanagement/stafffinalsave',body).map(response => response.json());
  }
  staffconfigurationcheck(applicationpk,apptype){
    let body = JSON.stringify({ applicationpk:applicationpk ,apptype:apptype});
    return this.http.post('cm/coursemanagement/staffconfigurationcheck',body).map(response => response.json());
  }
  getsubactegoryarray(applicationpk,ctype){
    let body = JSON.stringify({ applicationpk:applicationpk,ctype:ctype });
    return this.http.post('cm/coursemanagement/getsubactegoryarray',body).map(response => response.json());
  }
  suspend(applicationpk){
    let body = JSON.stringify({ applicationpk:applicationpk});
    return this.http.post('cm/coursemanagement/suspend',body).map(response => response.json());
  }
  activate(applicationpk){
    let body = JSON.stringify({ applicationpk:applicationpk});
    return this.http.post('cm/coursemanagement/activate',body).map(response => response.json());
  }
  getbatchids(staffinfotmppk,date){
    let body = JSON.stringify({ staffinfotmppk:staffinfotmppk,date:date });
    return this.http.post('cm/coursemanagement/getbatchids',body).map(response => response.json());
  }
  getpaymentinfo(pk,type){
    let body = JSON.stringify({ data:pk,type:type });
    return this.http.post('cm/coursemanagement/getpaymentinfo',body).map(response => response.json());
  }
  savepayment(data,type){
    let body = JSON.stringify({ data:data,type:type });
    return this.http.post('cm/coursemanagement/savepayment',body).map(response => response.json());
  }
  getprojectinfo(apppk,projpk){
    let body = JSON.stringify({ apppk:apppk,projpk:projpk });
    return this.http.post('cm/coursemanagement/getprojectinfo',body).map(response => response.json());
  }
  submitdesktoreview(data,type,apptype){
    let body = JSON.stringify({ data:data,type:type,apptype:apptype });
    return this.http.post('cm/coursemanagement/submitdesktoreview',body).map(response => response.json());
  }
  getdocumentdata(data,type,coursefk,reqfor){
    let body = JSON.stringify({ pk:data,type:type,coursefk:coursefk,reqfor:reqfor });
    return this.http.post('cm/coursemanagement/getdocumentdata',body).map(response => response.json());
  }
  getroleforcourse(data,type,coursefk,reqfor){
    let body = JSON.stringify({ pk:data,type:type,coursefk:coursefk,reqfor:reqfor });
    return this.http.post('cm/coursemanagement/getroleforcourse',body).map(response => response.json());
  }
  chechalredyapply(data,reqforfk,appinstinfomain_pk){
    let body = JSON.stringify({ pk:data,reqforfk:reqforfk,appinstinfomain_pk:appinstinfomain_pk });
    return this.http.post('cm/coursemanagement/chechalredyapply',body).map(response => response.json());
  }
  getinternational(pagesize,page,serachkey,referencepk){
  
    let body = JSON.stringify({  limit:pagesize,page:page,serachkey:serachkey,referencepk:referencepk});
    return this.http.post('cm/coursemanagement/getinternational',body).map(response => response.json());
  }
  getstaffgridlist(pagesize,page,serachkey,referencepk){
  
    let body = JSON.stringify({  limit:pagesize,page:page,serachkey:serachkey,referencepk:referencepk});
    return this.http.post('cm/coursemanagement/getstaffgridlist',body).map(response => response.json());
  }
  getstaffedu(pagesize,page,serachkey,referencepk){
  
    let body = JSON.stringify({  limit:pagesize,page:page,serachkey:serachkey,referencepk:referencepk});
    return this.http.post('cm/coursemanagement/getstaffedu',body).map(response => response.json());
  }
  getstaffwork(pagesize,page,serachkey,referencepk){
  
    let body = JSON.stringify({  limit:pagesize,page:page,serachkey:serachkey,referencepk:referencepk});
    return this.http.post('cm/coursemanagement/getstaffwork',body).map(response => response.json());
  }
  getBranchlistbyregpk(regPk,value)
  {
    let body = JSON.stringify({regpk:regPk,officetype:value});
    return this.http.post('cm/coursemanagement/getbranchlistbyregpk',body).map(res => res.json());
  }
  
  getfirstgrid(pagesize,page,serachkey){
  
    let body = JSON.stringify({  limit:pagesize,page:page,serachkey:serachkey});
    return this.http.post('cm/coursemanagement/getfirstgrid',body).map(response => response.json());
  }
  getaccessorscheduledtls(pk,pagesize,page,serachkey){

    let body = JSON.stringify({  pk:pk,limit:pagesize,page:page,serachkey:serachkey});
    return this.http.post('cm/coursemanagement/getaccessorscheduledtls',body).map(response => response.json());
  }
  saveaccessorscheduledtls(pk,data){

    let body = JSON.stringify({  pk:pk,data:data});
    return this.http.post('cm/coursemanagement/saveaccessorscheduledtls',body).map(response => response.json());
  }
  updateaccessorscheduledtls(pk,value){
  
    let body = JSON.stringify({  pk:pk,value:value});
    return this.http.post('cm/coursemanagement/updateaccessorscheduledtls',body).map(response => response.json());
  }


  saveStaffedu(formValue,appdtlstmp_id,repo_tmp) {
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['sacd_staffinforepo_fk'] = repo_tmp;
    let body = JSON.stringify({ staff: formValue });
    return this.http.post(this._url+'savestaffedu',body).map(response => response.json());
  }


  getalldata(pk,projectfk){
  
    let body = JSON.stringify({pk:pk,projectfk:projectfk});
    return this.http.post('cm/coursemanagement/getalldata',body).map(response => response.json());
  }
  interdelete(pk){
    let body = JSON.stringify({pk:pk});
    return this.http.post('cm/coursemanagement/interdelete',body).map(response => response.json());
  }
  deletestaffgrid(pk){
    let body = JSON.stringify({pk:pk});
    return this.http.post('cm/coursemanagement/deletestaffgrid',body).map(response => response.json());
  }
  deletestaffedu(pk){
    let body = JSON.stringify({pk:pk});
    return this.http.post('cm/coursemanagement/deletestaffedu',body).map(response => response.json());
  }
  deletestaffwork(pk){
    let body = JSON.stringify({pk:pk});
    return this.http.post('cm/coursemanagement/deletestaffwork',body).map(response => response.json());
  }
  getstaffdata(pk){ 
    let body = JSON.stringify({pk:pk});
    return this.http.post('cm/coursemanagement/getstaffdata',body).map(response => response.json());
  }

  saveWorkExp(formValue,stafrep_id,appdtlsPk) {
    formValue['stafrep_id'] = stafrep_id;
    formValue['appdtlsPk'] = appdtlsPk;
    let body = JSON.stringify({ workexp: formValue });
    return this.http.post(this._url+'workexp',body).map(response => response.json());
  }

  saveStaffCourmoher(formValue,stafrep_id,staffFormbasc,appdtlsPk,projecttype,doucumentform) {
    formValue['stafrep_id'] = stafrep_id;
    formValue['staffFormbasc'] = staffFormbasc;
    formValue['appdtlsPk'] = appdtlsPk;
    formValue['projecttype'] = projecttype;
    formValue['doucumentform'] = doucumentform;
    let body = JSON.stringify({ courmoher: formValue });
    return this.http.post(this._url+'staffcourmoher',body).map(response => response.json());
  }

  getComDtls(regPk,projecttype){
    let body = JSON.stringify({ regPk: regPk,projecttype:projecttype });
    return this.http.post(this._url+'getcomdtls',body).map(response => response.json());
  }

  getInsInforDtls(appDtlsPk, type){
    let body = JSON.stringify({ appDtlsPk: appDtlsPk, type: type });
    return this.http.post(this._url+'getinsinfrdtls',body).map(response => response.json());
  }

  getintrtr(){
    return this.http.get(this._url+'getintrtr').map(res => res.json());
  }


  getAppDtls(apptempPk) {
    let body = JSON.stringify({ 'apptempPk': apptempPk });
    return this.http.post(this._url + "getappdtls", body).map(res => res.json());
  }

  getallappdtls() {
    return this.http.get(this._url + 'getallappdtls').map(res => res.json());
  }
  getoperatordata(type, data) {
    return this.http.get(this._url + 'getautocompletedata?term=' + data + '&type=' + type).map(res => res.json());

  }

  getstaffdetails(key){
    let body = JSON.stringify({ key:key });
    return this.http.post('cm/coursemanagement/getstaffdetails',body).map(response => response.json());
  }

  getinterrecdtl(appDtlsPk) {
    let body = JSON.stringify({ appDtlsPk: appDtlsPk });
    return this.http.post(this._url+'getinterrecdtl',body).map(response => response.json());
  }



  updateInternational(formValue, appdtlstmp_id){
   formValue['appdtlstmp_id'] = appdtlstmp_id;
   let body = JSON.stringify({ formdata: formValue });
    return this.http.post('cm/coursemanagement/updateinternational',formValue).map(res => res.json());
  }
  getInsInforDtl(appDtlsPk , projectpk){
    let body = JSON.stringify({ appDtlsPk: appDtlsPk,projectpk:projectpk });
    return this.http.post(this._url+'getinsinfrdtl',body).map(response => response.json());
  }
  updateContract(formValue, appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
     return this.http.post('cm/coursemanagement/updatecontract',formValue).map(res => res.json());
   }

   AppSearhService(postParams,href){
    let formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href,formParam).map(res => res.json());
  }

  updateInstitute(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updateinstitute',body).map(response => response.json());
   }

   updateCompany(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updatecompany',body).map(response => response.json());
   }
   updateCourse(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updatecourse',body).map(response => response.json());
   }
  getref(type) {
    return this.http.get(this._url + 'getreference?term=' + type).map(res => res.json());
  }

  getcat() {
    return this.http.get(this._url + 'getcat').map(res => res.json());
  }

  getsubcat(cat) {
    return this.http.get(this._url + 'getsubcat?term=' + cat).map(res => res.json());
  }

  getcourtsted(type) {
    return this.http.get(this._url + 'getreference?term=' + type).map(res => res.json());
  }

  getrec(id){
    return this.http.get(this._url + 'getrec?term=' + id).map(res => res.json());
  }

  getcountry(){
    return this.http.get(this._url + 'getcountry').map(res => res.json());
  }

  getstate(param){
    return this.http.get(this._url + 'getstate?term=' + param).map(res => res.json());
  }

  getcity(state,city){
    return this.http.get(this._url + 'getcity?state=' + state + '&country=' +city).map(res => res.json());
  }

  getrole(){
    return this.http.get(this._url + 'getrole').map(res => res.json());
  }

  offercour(param){
    return this.http.get(this._url + 'getoffercour?param=' + param).map(res => res.json());
  }

  getcourunt(param){
    return this.http.get(this._url + 'getcourunt?param=' + param).map(res => res.json());
  }

  getdocumentdtl(param){
    return this.http.get(this._url + 'getdocumentdtl?param=' + param).map(res => res.json());
  }


  savesubdesk(appdtlstmp_id,renewalaction,projectType,comanydetialsform,diffdoculpoint){
    let body = JSON.stringify({ appdtlstmp_id: appdtlstmp_id ,renewalaction:renewalaction,projectType:projectType,comanydetialsform:comanydetialsform
    ,diffdoculpoint:diffdoculpoint});
    return this.http.post(this._url+'savesubdesk',body).map(response => response.json());
  }

  deleteInternational(formValue){
    let body = JSON.stringify({ insdtls: formValue });
    return this.http.post(this._url+'delintrdtls',body).map(response => response.json());
  }

  deleteOpr(formValue){
    let body = JSON.stringify({ oprdtls: formValue });
    return this.http.post(this._url+'delopr',body).map(response => response.json());
  }

  deleteCour(formValue){
    let body = JSON.stringify({ courdtls: formValue });
    return this.http.post(this._url+'delcour',body).map(response => response.json());
  }

  deleteStaff(formValue){
    let body = JSON.stringify({ stfdtls: formValue });
    return this.http.post(this._url+'delstaff',body).map(response => response.json());
  }

  saveDocuments(formValue , appdtlstmp_id,doc_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['doc_id'] = doc_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'savedocuments',body).map(response => response.json());
   }

   deleteStaffedu(formValue,appdtlsPk){
    formValue['appdtlsPk'] = appdtlsPk;
    let body = JSON.stringify({ stfedu: formValue });
    return this.http.post(this._url+'deletestaffedu',body).map(response => response.json());
  }

  deleteStaffwork(formValue,appdtlsPk){
    formValue['appdtlsPk'] = appdtlsPk;
    let body = JSON.stringify({ stfwork: formValue });
    return this.http.post(this._url+'deletestaffwork',body).map(response => response.json());
  }

  getCenterStatus(param){
    return this.http.get(this._url + 'getcenterstatus?param=' + param).map(res => res.json());
  }

  getdoc(doc_id){
    let body = JSON.stringify({ doc_id: doc_id });
    return this.http.post(this._url+'getdoc',body).map(response => response.json());
  }

  getauditdata(apptempPk, type) {
    let body = JSON.stringify({ 'apptempPk': apptempPk, 'type': type });
    return this.http.post(this._url + "getauditdata", body).map(res => res.json());
  }

   getcompany(apptempPk , projectpk) {
    let body = JSON.stringify({ 'apptempPk': apptempPk , 'projectpk':projectpk});
    return this.http.post(this._url + "getcompany", body).map(res => res.json());
  }

  updateDocument(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updatedocument',body).map(response => response.json());
   }

   
   updateapplication(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updateapplication',body).map(response => response.json());
   }



   updateStaff(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updatestaff',body).map(response => response.json());
   }

   getreferancemst(mst_pk) {
    let body = JSON.stringify({ 'mst_pk': mst_pk });
    return this.http.post(this._url + "getreferance", body).map(res => res.json());
  }
  getcoursecategory() {
    return this.http.get(this._url + 'getcoursecategory').map(res => res.json());
  }
  getsubcoursecategory() {
    return this.http.get(this._url + 'getsubcoursecategory').map(res => res.json());
  }

  getcoursetmp() {
    return this.http.get(this._url + 'getcoursetmp').map(res => res.json());
  }
  
  getappintermst() {
    let body = JSON.stringify({ 'mst_pk': 1 });
    return this.http.post(this._url + "getappintermst", body).map(res => res.json());
  }

  checkcivilnumval(civilnumval,repo) {
    let body = JSON.stringify({ 'civilnumval': civilnumval,'repo':repo });
    return this.http.post(this._url + "checkcivilnumval", body).map(res => res.json());
  }

  getpayment(apptempPk) {
    let body = JSON.stringify({ 'apptempPk': apptempPk });
    return this.http.post(this._url + "getpayment", body).map(res => res.json());
  }
  updatePayment(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updatepayment',body).map(response => response.json());
   }
  

  getCompanyDtls(appDtlsPk){
    let body = JSON.stringify({ appDtlsPk: appDtlsPk });
    return this.http.post(this._url+'getcompanydtls',body).map(response => response.json());
  }

  savescheduledate(data , projectpk){
    data['projectpk'] = projectpk;
    let body = JSON.stringify({ data: data });
    return this.http.post(this._url+'savescheduledate',body).map(response => response.json());
  }

  changestatus(id , status){
    let body = JSON.stringify({ 'id': id,'status':status });
    return this.http.post(this._url+'changestatus',body).map(response => response.json());
   }
   getstaffauditor(staffid) {
    let body = JSON.stringify({ 'staffid': staffid });
    return this.http.post(this._url + "getstaffauditor", body).map(res => res.json());
  }

  changestaff(staffid , pk){
    let body = JSON.stringify({ 'staffid': staffid,'pk':pk });
    return this.http.post(this._url+'changestaff',body).map(response => response.json());
   }

   getsitedata(apptempPk) {
    let body = JSON.stringify({ 'apptempPk': apptempPk });
    return this.http.post(this._url + "getsitedata", body).map(res => res.json());
  }
  payonline(data,type){
    let body = JSON.stringify({ data:data,type:type });
    return this.http.post('cm/coursemanagement/onlinepayment',body).map(response => response.json());
  }
  getavailabledate(projectpk){
    let body = JSON.stringify({ 'projectpk': projectpk });
    return this.http.post(this._url + 'getavailabledate',body).map(res => res.json());
  }
  savesiteauditdate(data,apptempPk,projPk){
    let body = JSON.stringify({ data:data,'apptempPk': apptempPk,'projPk': projPk });
    return this.http.post(this._url + "savesiteaudit", body).map(res => res.json());
  }

  getsiteauditdate(apptempPk) {
    let body = JSON.stringify({ 'apptempPk': apptempPk });
    return this.http.post(this._url + "getsiteauditdate", body).map(res => res.json());
  }

  getstaffauditordata(staffid) {
    let body = JSON.stringify({ 'staffid': staffid });
    return this.http.post(this._url + "getsiteauditordata", body).map(res => res.json());
  }

  submitQuestForm(data) {
    this.submitForm.emit(data)
  }

  getQuestDataLocal(value) {
    this.questArray.emit(value);
  } 
  getFinalTabData(data) {
    this.finalTabData.emit(data);
  } 
  getsitequestions(catid) {
    let body = JSON.stringify({ 'catid': catid });
    return this.http.post(this._url + "getsitequestionsdata", body).map(res => res.json());
  }

  
  getAppMainDtls(temp_pk,type){
    let body = JSON.stringify({ temp_pk: temp_pk,type: type });
    return this.http.post(this._url+'getmaindtls',body).map(response => response.json());
  }
  getAppMainDtlsras(temp_pk,type){
    let body = JSON.stringify({ temp_pk: temp_pk,type: type });
    return this.http.post(this._url+'getmaindtlsras',body).map(response => response.json());
  }

  deleteQuestion(pk){
    let body = JSON.stringify({pk:pk});
    return this.http.post(this._url + 'deletequestions',body).map(response => response.json());
  }
  saveQuestions(formValue , checkbox){
    formValue['gradearray'] = checkbox;
    let body = JSON.stringify({ comdtls: formValue  });
    return this.http.post(this._url+'savequestion',body).map(response => response.json());
  }
  getgrademst(){
    return this.http.get(this._url + 'getgrademst').map(res => res.json());
  }

  userterevedtls(memReg: string,projectType: Number) {
    const body = JSON.stringify({ memReg: memReg ,projectType:projectType });
    return this.http.post('center/app-center/userterevedtls',body).map(res => res.json());
  }

  usertranbranchdtls(apptmppk: string) {
    const body = JSON.stringify({ apptmppk: apptmppk  });
    return this.http.post('center/app-center/userbranchdtls',body).map(res => res.json());
  }
  getappliacationdtls(apptmppk: string) {
    const body = JSON.stringify({ apptmppk: apptmppk  });
    return this.http.post('center/app-center/getappliacationdtls',body).map(res => res.json());
  }

  getDecStatus(apptmppk: string) {
    const body = JSON.stringify({ apptmppk: apptmppk  });
    return this.http.post('center/app-center/getdecstatus',body).map(res => res.json());
  }

  saveLogo(filePk) {
    const body = JSON.stringify({ filePk });
    return this.http.post('center/app-center/deletelogo', body).map(res => res.json());
  }

  getstandcustcourseapprstatus(apptempPk) {
    let body = JSON.stringify({ 'apptempPk': apptempPk });
    return this.http.post('center/app-center/getsccsitedata',body).map(res => res.json());
  }

  getstandardcoursemstlist(temp_pk,type) {
    let body = JSON.stringify({ temp_pk: temp_pk,type: type });
    return this.http.post(this._url+'getstandardcoursemstlist',body).map(response => response.json());
  }

 
  getstandardcourselist(temp_pk,type) {
    let body = JSON.stringify({ auditschedtmpid: temp_pk,type: type });
    return this.http.post(this._url+'getstandardcourselist',body).map(response => response.json());
  }

  savestandcustcourse(res) {
    let body = JSON.stringify({ temp_pk: '1',type: '2', result:res });
    return this.http.post(this._url+'savescsiteaudit',body).map(response => response.json());
  }

  deleteCategoryWithQuestions(categoryId) {
    let body = JSON.stringify({ categoryId: categoryId });
    return this.http.post(this._url+'deletecategorywithquestions',body).map(response => response.json());
  }
  deleteQuestionWithRelatedAnswers(questionId) {
    let body = JSON.stringify({ questionId: questionId });
    return this.http.post(this._url+'deletequestionwithrelatedanswers',body).map(response => response.json());
  }
  getStaffsiteauditlist(app_id) {
    let body = JSON.stringify({ app_id: app_id });
    return this.http.post(this._url+'staffsiteauditlist',body).map(response => response.json());
  }
  uploadAssessmentReport(set_id,data,appstaffinfotmp_id) {
    let body = JSON.stringify({ staffevaluationtemp_pk: set_id, data:data,appstaffinfotmp_pk:appstaffinfotmp_id });
    return this.http.post(this._url+'savestaffevaluationtmp',body).map(response => response.json());
  }
  getStaffAssessmentStatus(set_id,app_id,asit_id) {
    let body = JSON.stringify({ staffevaluationtemp_pk: set_id,app_id:app_id,asit_id:asit_id });
    return this.http.post(this._url+'getstaffassessmentstatus',body).map(response => response.json());

  }
  getLocalSiteAuditList(referenceName) {
    return JSON.parse(localStorage.getItem(referenceName));
  }
  setLocalSiteAuditList(referenceName,data) {
    localStorage.setItem(referenceName,(JSON.stringify(data)));
    return data != null ? true : false;
  }

  ApprovalSiteaudit(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updateapproval',body).map(response => response.json());
   }
   ApprovalSiteaudit1(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updateapproval1',body).map(response => response.json());
   }
   ApprovalSiteauditras(appdtlstmp_id){
   
    let body = JSON.stringify({ formdata: appdtlstmp_id });
    return this.http.post(this._url+'updateapprovalras',body).map(response => response.json());
   }
   ApprovalSiteauditrassavemsg(appdtlstmp_id,message ){
   
    let body = JSON.stringify({ formdata: appdtlstmp_id,message:message });
    return this.http.post(this._url+'updateapprovalrassavemsg',body).map(response => response.json());
   }
   ApprovalSiteauditgetgrade(appdtlstmp_id){
    let body = JSON.stringify({ formdata: appdtlstmp_id });
    return this.http.post(this._url+'approvaliteauditgetgrade',body).map(response => response.json());
   }
   updateSite(formValue , appdtlstmp_id ,approvalid ,categorygrade){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    formValue['approvalid'] = approvalid;
    formValue['categorygrade'] = categorygrade;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updatesite',body).map(response => response.json());
   }
  certificategeneration(){
    let body = JSON.stringify({applicattiontemmpk :1223 });
    return this.http.post(this._url+'finalcerificategeneration',body).map(response => response.json());
    // return this.http.post('cm/coursemanagement/finalcerificategeneration',body).map(response => response.json());
  }
  rassticker(){
    let body = JSON.stringify({});
    return this.http.post('ras/ras/rassticker',body).map(response => response.json());
  }
  deleteStaffEvaluation(set_id) {
    let body = JSON.stringify({ staffevaluationtemp_pk: set_id });
    return this.http.post(this._url+'deletestaffevaluation',body).map(response => response.json());
  }
  getappapprovalhrd(app_id,app_status) {
    let body = JSON.stringify({ app_id: app_id, app_status:app_status  });
    return this.http.post(this._url+'getappapprovalhrd',body).map(response => response.json());
  }
  changeSiteAuditStatus(app_id,data) {
    let body = JSON.stringify({ app_id: app_id, data:data  });
    return this.http.post(this._url+'changesiteauditstatus',body).map(response => response.json());
  }
  saveAppApprovalNextLevel(app_id,data) {
    let body = JSON.stringify({ app_id: app_id, data:data  });
    return this.http.post(this._url+'savenextlevelapprovalstatus',body).map(response => response.json());
  }
  // Getapprovalsitedata
  getapprovalsitedata(app_id,data={}) {
    let body = JSON.stringify({ app_id: app_id ,data:data });
    return this.http.post(this._url+'getapprovalsitedata',body).map(response => response.json());
  }
  getmainrole() {
    return this.http.get(this._url + 'getmainrole').map(res => res.json());
  }

  getCurBranch(param){
    return this.http.get(this._url + 'getcurbranch?param=' + param).map(res => res.json());
  }

  getviewdetails(param){
    return this.http.get(this._url + 'getviewdetails?param=' + param).map(res => res.json());
  }
  getviewdetailsras(param){
    return this.http.get(this._url + 'getviewdetailsras?param=' + param).map(res => res.json());
  }

  getmainview(){
    return this.http.get(this._url + 'getmainview').map(res => res.json());
  }

  savebannerimg(file){
    return this.http.get(`${this._url}changebanner?bannerimageid=${file}`).map(res => res.json());
  }

  deletebannerimg(){
    return this.http.get(`${this._url}removeextbanner`).map(res => res.json());
  }
getAppStatus(param){
    return this.http.get(this._url + 'getappstatus?param=' + param).map(res => res.json());
  }
  updateSuspend(appdtlstmp_id , status){
     let body = JSON.stringify({ appdtlstmp_id: appdtlstmp_id,status:status });
    return this.http.post(this._url+'updatesuspend',body).map(response => response.json());
   }
  
   roleaccess() {

    let body = JSON.stringify({ });
    return this.http.post(this._url + 'roleaccess',body).map(res => res.json());
  }
 getrasinspectioncategory(projecttype) {

    let body = JSON.stringify({projecttype:projecttype});
    return this.http.post(this._url + 'getrasinspectioncategory',body).map(res => res.json());
  }
  getrasrole(projecttype) {

    let body = JSON.stringify({projecttype:projecttype});
    return this.http.post(this._url + 'getrasrole',body).map(res => res.json());
  }
  saveinspectioncategory(formvalue,appliationpk) {

    let body = JSON.stringify({formvalue:formvalue,appliationpk:appliationpk});
    return this.http.post(this._url + 'saveinspectioncategory',body).map(res => res.json());
  }
  getrascategorydata(pagesize,page,serachkey,applicationpk){ 
  
    let body = JSON.stringify({  limit:pagesize,page:page,serachkey:serachkey,applicationpk:applicationpk});
    return this.http.post(this._url +'getrascategorydata',body).map(response => response.json());
  }


  updaterasapplication(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updaterasapplication',body).map(response => response.json());
   }
   checkmainofficealreadyapplied(){ 
  
    let body = JSON.stringify({});
    return this.http.post(this._url +'checkmainofficealreadyapplied',body).map(response => response.json());
  }

  updateInspection(formValue , appdtlstmp_id){
    formValue['appdtlstmp_id'] = appdtlstmp_id;
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'updateinspection',body).map(response => response.json());
   }
   getinspectionstaffdata(inspectionpk , staffid,catid ,assessmenttype) {
    let body = JSON.stringify({ 'inspectionpk': inspectionpk , staffid:staffid,catid:catid,assessmenttype:assessmenttype});
    return this.http.post(this._url + "getinspectionstaffdata", body).map(res => res.json());
  }
  inspectionapproved(inspectiontmp_pk,staff_id,status,status_info,reportdocument,percentage,mark,comments , catid , repo_id , assessmenttype) {

    let body = JSON.stringify({ 'status': status,'inspectiontmp_pk':inspectiontmp_pk,'staff_id':staff_id,'comments':comments,'status_info':status_info,'reportdocument':reportdocument,'percentage':percentage,'mark':mark , 'catid' :catid , 'repo_id':repo_id , 'assessmenttype':assessmenttype});
    return this.http.post(this._url + 'inspectionapprodecproce',body).map(res => res.json());
  }
  getroleaccess(){
    let body = JSON.stringify({ });
    return this.http.post(this._url + 'getroleaccess',body).map(response => response.json());
  }
  getroleaccess_course(){
    let body = JSON.stringify({ });
    return this.http.post(this._url + 'getroleaccesscourse',body).map(response => response.json());
  }
  getroleaccess_ras(){
    let body = JSON.stringify({ });
    return this.http.post(this._url + 'getroleaccessras',body).map(response => response.json());
  }
  getOnlinePaymentStatus(formValue){
    let body = JSON.stringify({ formdata: formValue });
    return this.http.post(this._url+'paymentstatus',body).map(response => response.json());
   }

   saveonlinepayment(pymtres,pymttrkno,appdtpk,propk,apptype){
    let body = JSON.stringify({ pymtres:pymtres,pymttrkno:pymttrkno,appdtpk:appdtpk,propk:propk,apptype:apptype });
    return this.http.post('cm/coursemanagement/saveonlinepayment',body).map(response => response.json());
   }
  getaccessproject(projectpk) {
    let body = JSON.stringify({ 'projectpk': projectpk});
    return this.http.post(this._url+'getaccessproject' ,body).map(response => response.json());
  }  editBooking(id:any) {
    let body = JSON.stringify({id: id});
    return this.http.post(this._url + 'get-update-data', body).map(res => res.json());
  }
  updateBooking(data:any) {
    let body = JSON.stringify({data});
    return this.http.post(this._url + 'edit-booking', body).map(res => res.json());
  }  }