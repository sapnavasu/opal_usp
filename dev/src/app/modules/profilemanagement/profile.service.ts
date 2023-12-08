import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable, Output } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { RemoteService } from '@app/remote.service';
import { environment } from '@env/environment';
import * as datacontent from 'backend/json/content/product/Listing.json';
import * as datacontentservice from 'backend/json/content/service/service_page.json';
import * as _moment from 'moment';
import { default as _rollupMoment } from 'moment';
import 'rxjs/add/observable/of';

const moment = _rollupMoment || _moment;

let _url: string;
@Injectable()
export class ProfileService {
  contacturl = 'bussrc/bussource/';
  svfurl = 'svf/svf/';
  _url = 'pm/profile/';
  _url1 = 'svf/svf/';
  _workspaceurl = 'ws/workspace/';
  _departmenturl = 'ea/department/';
  filterurl = 'mst/profilemanagement/index';
  
  @Output() sideNavClose: EventEmitter<any> = new EventEmitter();
  public contentprofle = datacontent.default;
  public contentservprofile = datacontentservice.default;
  public product_createdon_from;
  public product_createdon_to;
  public product_updatedon_from;
  public product_updatedon_to;

  public service_createdon_from;
  public service_createdon_to;
  public service_updatedon_from;
  public service_updatedon_to;

  public filter_form_values;

  public product_createdon = '';
  public product_updatedon = '';

  public service_createdon = '';
  public service_updatedon = '';

  public querystr = '';
  public trackerforbusinesssource = '';
  baseUrl: string = environment.baseUrl;

  constructor(public http: RemoteService, public route: ActivatedRoute,
              public newHttp: HttpClient, private security: Encrypt, private localstorageservice: AppLocalStorageServices) {

  }
  @Output() emitData = new EventEmitter<any>();

  create(postval) {
    const body = JSON.stringify({ 'memcompprofachvdtls': postval });
    return this.http.post(this._url + 'createachvmt', body).map(res => res.json());
  }
  getachvmt(id: number) {
    return this.http.get(this._url + 'getachvmt?id=' + id).map(res => res.json());
  }

  getincorpstyle(countrypk?: number, stkholdertype?: any) {
    return this.http.get(this._url + 'getincorpstyle?country_id=' + countrypk + '&stkholdertype=' + stkholdertype).map(res => res.json());
  }

  corporatedataformsave(formdata) {
    const body = JSON.stringify({ 'organizationdetails': formdata });
    return this.http.post(this._url + 'createcorporateprofile', body).map(res => res.json());
  }
  corporatedata(table: string, formdata: any) {

    const body = '';
    if (table == 'memcompmarpreimgdtls') {
      const body = JSON.stringify({ 'memcompmarpreimgdtls': formdata });
    } else if (table == 'membercompanymst') {
      const body = JSON.stringify({ 'membercompanymst': formdata });
    } else if (table == 'memcompgendtls') {
      const body = JSON.stringify({ 'memcompgendtls': formdata });
    } else if (table == 'memcompprofcertfdtls') {
      const body = JSON.stringify({ 'memcompprofcertfdtls': formdata });
    } else if (table == 'turnover') {
      const body = JSON.stringify({ 'turnover': formdata });
    } else if (table == 'privacy') {
      const body = JSON.stringify({ 'privacy': formdata });
    } else if (table == 'documents') {
      const body = JSON.stringify(formdata);
    }

    if (body) {
      return this.http.post(this._url + 'createcorporate', body).map(res => res.json());
    }

  }
  addaccomplishment(formdata: any) {
    const body = JSON.stringify({ 'accomplishment': formdata });
    return this.http.post(this._url + 'createaccomplishment', body).map(res => res.json());
  }
  adddepartment(body) {
    return this.http.post(this._departmenturl + 'deptcreate', body).map(res => res.json());
  }
  getdepartmentbyid(id: any) {
    return this.http.get(this._departmenturl + 'deptview?pk=' + id).map(res => res.json());
  }

  getdepartmentbypk(id: any) {
    return this.http.get(this._departmenturl + 'getdept?pk=' + id).map(res => res.json());
  }

  getproduct(id: any) {
    return this.http.get(this._url + 'getproduct?pk=' + id).map(res => res.json());
  }
  getproductlistkey(id) {
    return this.http.get(this._url + 'getproductlistkey?pk=' + id).map(res => res.json());
  }
  getSupportFile(selectedData, type) {
    const body = JSON.stringify({ 'selectedData': selectedData, 'type': type });
    return this.http.post(this._url + 'getsupportfile', body).map(res => res.json());
  }
  getservicelistkey(id) {
    return this.http.get(this._url + 'getservicelistkey?pk=' + id).map(res => res.json());
  }
  getaccomplishment(requesturls?: string) {
    if (typeof requesturls == 'undefined') {
      return this.http.get(this._url + 'getaccomplishment').map(res => res.json());
    } else {
      return this.http.get(this._url + 'getaccomplishment').map(res => res.json());
    }

  }
  getaccomplishmentbyid(id) {
    return this.http.get(this._url + 'getaccomplishment?pk=' + id).map(res => res.json());
  }
  getcorpprofile() {
    return this.http.get(this._url + 'getcorporateprofile').map(res => res.json());
  }
  accomplishmentordering(data) {
    const body = JSON.stringify({ 'orderlist': data }); 
    return this.http.post(this._url + 'accomplishmentpriority', body).map(res => res.json());
  }

  getsegmentlist(type?: any) {
    const request_type = type != '' ? `?type=${type}` : '';
    return this.http.get(this._url + 'getsegmentlist' + request_type).map(res => res.json());
  }

  getcategorylist(type?: any, searchkey= '') {
    const request_type = type != '' ? `?type=${type}` : '';
    return this.http.get(this._url + 'getcategorylist' + request_type + '&searchkey=' + searchkey).map(res => res.json());
  }

  getsubcategorybasedoncategory(catid, type) {
    return this.http.get(this._url + 'getsubcategory?category=' + catid + '&type=' + type).map(res => res.json());
  }

  getbgiproductbasedonsubcategory(cat, subcatid, type) {
    return this.http.get(this._url + 'getbgiproduct?category=' + cat + '&subcategory=' + subcatid + '&type=' + type).map(res => res.json());
  }

  getbgiservicebasedonsubcategory(cat, subcatid, type) {
    return this.http.get(this._url + 'getbgiservice?category=' + cat + '&subcategory=' + subcatid + '&type=' + type).map(res => res.json());
  }

  getproductbasedonbgiproduct(proid) {
    return this.http.get(this._url + 'getproductunpsc?product=' + proid).map(res => res.json());
  }
  getservicebasedonbgiservice(serviceid) {
    return this.http.get(this._url + 'getserviceunpsc?service=' + serviceid).map(res => res.json());
  }

  getproductonsearch(searchkey, type) {
    return this.http.get(this._url + 'getproductonsearch?searchkey=' + searchkey + '&searchtype=' + type).map(res => res.json());
  }

  getserviceonsearch(searchkey, type) {
    return this.http.get(this._url + 'getserviceonsearch?searchkey=' + searchkey + '&searchtype=' + type).map(res => res.json());
  }
  getrelatedproduct(subcatid, currentPk) {
    return this.http.get(this._url + 'getrelatedproductsugg?subcat=' + subcatid + '&currentPk=' + currentPk).map(res => res.json());
  }

  getrelatedservice(subcatid, currentPk) {
    return this.http.get(this._url + 'getrelatedservicesugg?subcat=' + subcatid + '&currentPk=' + currentPk).map(res => res.json());
  }

  getsegmentlistforservice() {
    return this.http.get(this._url + 'getsegmentlist?type=S').map(res => res.json());
  }
  getfamilybaedonsegment(segmentid, type, frbizsearch?: boolean) {
    return this.http.get(this._url + 'getfamilylist?segment=' + segmentid + '&type=' + type + '&frbizsearch=' + frbizsearch).map(res => res.json());
  }
  getclassbyfamilyid(family, segment, frbizsearch?: boolean) {
    return this.http.get(this._url + 'getclass?family=' + family + '&segment=' + segment + '&frbizsearch=' + frbizsearch).map(res => res.json());
  }
  getproductlist(classvalue, familyvalue, segmentvalue, frbizsearch?: boolean) {
    return this.http.get(this._url + 'getproductlist?class=' + classvalue + '&family=' + familyvalue + '&segment=' + segmentvalue + '&frbizsearch=' + frbizsearch).map(res => res.json());
  }

  getservicelist(classvalue, familyvalue, segmentvalue, frbizsearch?: boolean) {
    return this.http.get(this._url + 'getservlist?class=' + classvalue + '&family=' + familyvalue + '&segment=' + segmentvalue + '&frbizsearch=' + frbizsearch).map(res => res.json());
  }
  getsectorlist(type) {
    return this.http.get(this._url + 'getsectorlist?type=' + type).map(res => res.json());
  }
  getindustrylist(sector: any) {
    return this.http.get(this._url + 'getindustrylist?sector=' + sector).map(res => res.json());
  }
  getactivitylist(sector, industry) {
    return this.http.get(this._url + 'activitylist?sector=' + sector + '&industry=' + industry).map(res => res.json());
  }
  getactivitylistforcompany() {
    return this.http.get(this._url + 'sectormaping').map(res => res.json());
  }
  getspecification() {
    return this.http.get(this._url + 'getspecification').map(res => res.json());
  }
  getspecificationforservice() {
    return this.http.get(this._url + 'getspecification?type=' + 'S').map(res => res.json());
  }
  getlookup() {
    return this.http.get(this._url + 'getlookup').map(res => res.json());
  }
  addproduct(body) {
    // return this.http.post(this._url + "addproduct", body).map(res => res.json());
    return this.http.post(this._url + 'v3addproduct', body).map(res => res.json());
  }
  addservice(body) {
    return this.http.post(this._url + 'v3addservice', body).map(res => res.json());
    // return this.http.post(this._url + "addservice", body).map(res => res.json());
  }
  wikicontent(content: any, type?: any) {
    const page = type ? type : 'P';
    return this.http.get(this._url + 'getwikipedia?iname=' + content + '&type=' + page).map(res => res.json());
  }
  autocomplete(value, searchby, type) {
    return this.http.get(this._url + 'getsugglist?term=' + value + '&searchby=' + searchby + '&type=' + type).map(res => res.json());
  }
  searchclick(termid, searchby, type) {
    return this.http.get(this._url + 'searchclick?termid=' + termid + '&searchby=' + searchby + '&type=' + type).map(res => res.json());
  }
  getfamilybasedonsegmentforservice(segmentid) {
    return this.http.get(this._url + 'getfamilylist?segment=' + segmentid + '&type=S').map(res => res.json());
  }
  getclassbyfamilyforservice(family, segment, frbizsearch?: boolean) {
    return this.http.get(this._url + 'getclass?family=' + family + '&segment=' + segment + '&type=S' + '&frbizsearch=' + frbizsearch).map(res => res.json());
  }
  wikicontentforservice(content: any) {
    return this.http.get(this._url + 'getwikipedia?iname=' + content + '&type=s').map(res => res.json());
  }
  activitysearchclick(termid, searchby, type) {
    return this.http.get(this._url + 'activitysearchclick?termid=' + termid + '&searchby=' + searchby + '&type=' + type).map(res => res.json());
  }
  autocompleteactivity(value, searchby, type?: any) {
    return this.http.get(this._url + 'getsectorsugglist?term=' + value + '&searchby=' + searchby).map(res => res.json());
  }
  getclientlee(page?: any, size?: any) {
    const pageoptionenable = (typeof page != 'undefined' && page != null) ? `page=${page}&size=${size}&` : '';
    return this.http.get(this._url + 'getmrktprsnce?' + pageoptionenable + 'category=C').map(res => res.json());
  }
  getDesignationList() {
    return this.http.get('ea/user/designationlist').map(res => res.json());
  }
  getcountrylist(type?:any) {
    return this.http.get('mst/country/countrylist?type='+type).map(res => res.json());
  }

  getcurrencylist() {
    return this.http.get('pm/profile/currencylist').map(res => res.json());
  }

  getsocilalist() {
    return this.http.get(this._url + 'getsocialmedialist').map(res => res.json());
  }
  getstatebyid(country: number) {
    return this.http.get('mst/statemaster/statelistbycountry?countryid=' + country + '?custom=1').map(res => res.json());
  }

  getcity(country, state, pk?: any) {
    return this.http.get('mst/citymaster/getcitybystateid?stateid=' + state).map(res => res.json());
  }
  createmrktprsnce(formval) {
    const body = JSON.stringify({ 'memcompmarketpresencedtls': formval });
    return this.http.post(this._url + 'createmrktprsnce', body).map(res => res.json());
  }
  createcontactinfo(formval) {
    const body = JSON.stringify({ 'contactinfo': formval });
    return this.http.post(this._url + 'savecontactinfo', body).map(res => res.json());
  }
  getcountrycode(country: number) {
    return this.http.get('mst/country/getdialcodebycountry?country_pk=' + country).map(res => res.json());
  }
  getpk(value: any, value2: any) {
    return this.http.get(this._url + 'isregionexist?country=' + value + '&state=' + value2).map(res => res.json());
  }
  marketprsncefilter(filterpagestring, searchval, national, international) {
    const requeststring = `${filterpagestring}&search=${searchval}`;
    return this.http.get(this._url + 'getmrktprsnce?' + requeststring + '&national=' + national + '&international=' + international).map(res => res.json());

  }
  marketprsncefiltertwo(filterpagestring, searchval) {
    const requeststring = `${filterpagestring}&search=${searchval}`;
    return this.http.get(this._url + 'getmrktprsnce?' + requeststring).map(res => res.json());

  }
  updatemarktprsnce(pk: any, form: any) {
    return this.http.get(this._url + 'getmrktprsnce?pk=' + pk + '&category=' + form).map(res => res.json());
  }
  deletemarktprsnce(id) {
    return this.http.get(this._url + 'deletemrktprsnce?pk=' + id).map(res => res.json());
  }
  getrepresentativeoffice(page: any, size?: any) {
    return this.http.get(this._url + 'getmrktprsnce?' + `page=${page}&category=R&size=${size}`).map(res => res.json());
  }
  getbrancharray(page?: any, size?: any) {
    return this.http.get(this._url + 'getmrktprsnce?' + `page=${page}&category=B&size=${size}`).map(res => res.json());
  }
  getcontact() {
    return this.http.get(this._url + 'getcontactinfo?update=0').map(res => res.json());
  }
  editcontact() {
    return this.http.get(this._url + 'getcontactinfo?update=1').map(res => res.json());
  }
  addtenderboard(formdata: any) {
    const body = JSON.stringify({ 'mctbrsecgrddtls': formdata });
  }
  dataupdate(tablename: string, formavalue: any) {
    const body='';
    if (tablename == 'memcompprofiledtls') {
      const body = JSON.stringify({ 'memcompprofiledtls': formavalue });
    } else if (tablename == 'memcompgendtls') {
      const body = JSON.stringify({ 'memcompgendtls': formavalue });
    }
    // return this.http.post(this._url + "singleinsertion", body).map(res => res.json());
    return this.http.post(this._url + 'messagefrom', body).map(res => res.json());
  }
  getdatafromserver() {
    return this.http.get(this._url + 'gethomeprofile').map(res => res.json());
  }
  getdatafromserverMangement() {
    return this.http.get(this._url + 'getmanagement').map(res => res.json());
  }
  deleteaccomplishment(id: number) {
    return this.http.get(this._url + 'deleteaccomplishment?pk=' + id).map(res => res.json());
  }
  logout() {
    const userpk = { id: this.security.encrypt(this.localstorageservice.getInLocal('opalusermst_pk')) };
    return this.http.post(this._url + 'logout', JSON.stringify(userpk)).map(res => res.json());
  }
  getagentprncpdtls(type) {
    return this.http.get(this._url + 'getagentprncpdtls?category=' + type).map(res => res.json());
  }
  updatestatus(id) {
    return this.http.get(this._departmenturl + 'deptstatuschange?pk=' + id).map(res => res.json());
  }
  deletedepartment(id) {
    return this.http.get(this._departmenturl + 'deletedept?id=' + id).map(res => res.json());
  }
  deptfilter(filterstring, depatname) {
    const requeststring = `${filterstring}&DM_Name=${depatname}&type=${'filter'}`;
    return this.http.get('ea/department/deptview?' + requeststring).map(res => res.json());
  }
  getContactInfo() {
    return this.http.get(this._url + 'getcontactinfo?').map(res => res.json());
  }
  getUserList() {
    return this.http.get(this._url + 'getuserlist?').map(res => res.json());
  }
  mapContact(department, userPk) {
    return this.http.get(this._url + 'mapdepartment?dep=' + department + '&userpk=' + userPk).map(res => res.json());
  }
  productfilter(filterpagestring, username, date) {
    const requeststring = `${filterpagestring}&search=${username}&date=${date}`;
    return this.http.get('pm/profile/getprodlist?' + requeststring).map(res => res.json());

  }
  servicefilter(filterpagestring, username, date) {
    const requeststring = `${filterpagestring}&search=${username}&date=${date}`;
    return this.http.get('pm/profile/getservicelist?' + requeststring).map(res => res.json());

  }
  getservice(service_id: number) {
    return this.http.get('pm/profile/getservice?pk=' + service_id).map(res => res.json());
  }
  deleteservice(pk) {
    return this.http.get('pm/profile/deleteservice?pk=' + pk).map(res => res.json());
  }
  getworkspacewidgets() {
    return this.http.get(this._workspaceurl + 'workspacewidgetslist').map(res => res.json());
  }
  saveWorkspacePermission(widgetspk: any) {
    return this.http.get(this._workspaceurl + 'saveworkspacepermission?widgets_pk=' + widgetspk).map(res => res.json());
  }
  getproductcount() {
    return this.http.get('pm/profile/productcount').map(res => res.json());
  }

  getservicecount() {
    return this.http.get('pm/profile/servicecount').map(res => res.json());
  }

  getmasterdata(type: string, country_id?: number, state_id?: number, register_id?: number) {
    switch (type) {
      case 'country':
        return this.http.get('mst/master/getmasterdata?type=' + type).map(res => res.json());
      case 'state':
        return this.http.get(`mst/master/getmasterdata?type=${type}&country_id=${country_id}`).map(res => res.json());
      case 'city':
        return this.http.get(`mst/master/getmasterdata?type=${type}&country_id=${country_id}&state_id=${state_id}`).map(res => res.json());
      case 'user':
        return this.http.get(`mst/master/getmasterdata?type=${type}&registerpk=${register_id}`).map(res => res.json());
      case 'company':
        return this.http.get(`mst/master/getmasterdata?type=${type}`).map(res => res.json());
      case 'companywithusers':
        return this.http.get(`mst/master/getmasterdata?type=${type}`).map(res => res.json());
      default:
        break;
    }

  }
  getCategorydata() {
    return this.http.get('pm/profile/getsectorlistvalue').map(res => res.json());

  }

  // LP-22
  partisionsave(data, type, id?: any) {
      const server_obj = {'memcompproddtls_pk': id, 'type': type};
      let body='';
      if (type === 1) {
        body = JSON.stringify({'memcompproddtls': data});
      } else if (type == 2) {
        body = JSON.stringify({'memcompproddtls': data});
      } else if (type == 4 || type == 5) {
        const server_obj = { 'memcompproddtls_pk': id, 
        'type': type,
        productspecfication:'',
        specdata:'',
        trade_prod:'',
        tradespecification:'',
      };
   
      if (type == 5) {
        server_obj.productspecfication = data[0].pspecifications;
        server_obj.specdata = data[1];
        server_obj.trade_prod = 'P';
      } else {
        server_obj.tradespecification = data.tradespecification;
        server_obj.trade_prod = 'T';
      }
      body = JSON.stringify({'memcompproddtls': server_obj});
    } else if (type == 6 || type == 7) {
      const server_obj = {'memcompproddtls_pk': id, 'agentprinciple': data, 'type': type};
      body = JSON.stringify({'memcompproddtls': server_obj});
    } else if (type == 9) {
      const exp_date = 66
      data.qcexpirydate = exp_date;

      const issue_date = moment(data.qcissuedate).format('DD-MM-YYYY').toString();
      data.qcissuedate = issue_date;

      data.memcompproddtls_pk = id;
      body = JSON.stringify({'memcompproddtls': data});
    } else if (type == 10) {
     data.memcompproddtls_pk = id;
     body = JSON.stringify({'memcompproddtls': data});
    } else if (type == 11) {
      const serv_obj = {'memcompproddtls_pk': id, 'string_ids': data[0], 'type': 11, 'locationtype': data[1], 'addinfo_name': data[2]};
      body = JSON.stringify({'memcompproddtls': serv_obj});
    }
    return this.http.post(this._url + 'partisionsave', body).map(res => res.json());
  }
  getproductperctage(productpk,type){
    const serv_obj = {'memcompproddtls_pk': productpk,'type':type};
    const body = JSON.stringify({'memcompproddtls': serv_obj});
    return this.http.post(this._url + 'getproductperctage', body).map(res => res.json());
  }
  getservicesperctage(servicespk,type){
    const serv_obj = {'serdtpk': servicespk,'type':type};
    const body = JSON.stringify({'servicedet': serv_obj});
    return this.http.post(this._url + 'getservicesperctage', body).map(res => res.json());
  }
  saveContactus(contactus, ccmail) {
    const serv_obj = {'contactUs': contactus, 'ccemail': ccmail};
    const body = JSON.stringify({'contdata': serv_obj});
    return this.http.post('mcp/mastercompanyprofile/insertcontactus', body).map(res => res.json());
  }
  getContactUsMaster() {
    return this.http.get('mcp/mastercompanyprofile/contactusmasterdata').map(res => res.json());
  }
  getContactUsccdata() {
    return this.http.get('mcp/mastercompanyprofile/contactusccdata').map(res => res.json());
  }
  getallproducts() {
    return this.http.get('pm/profile/getprodlist').map(res => res.json());
  }

  getCompanyInformation(companypk) {
    return this.http.get('mcp/mastercompanyprofile/companyinformation?companypk=' + companypk).map(res => res.json());
  }
  getprofileperctage(companypk) {
    return this.http.get('mcp/mastercompanyprofile/getprofileperctage?companypk=' + companypk).map(res => res.json());
  }
  getstockmarketlist() {
    return this.http.get('mcp/mastercompanyprofile/getstockmarketlistdet').map(res => res.json());
  }

  saveBasicInformation(formdata) {
    const body = JSON.stringify({ basicinfo: formdata });
    return this.http.post('mcp/mastercompanyprofile/savecpbasicinfo', body).map(res => res.json());
  }

  saveCrDetails(formdata) {
    const body = JSON.stringify({ cr: formdata });
    return this.http.post('mcp/mastercompanyprofile/savecrdetails', body).map(res => res.json());
  }

  saveBusinessUnit(formdata) {
    const body = JSON.stringify({ sectordtls: formdata });
    return this.http.post('mcp/mastercompanyprofile/savebusinessunit', body).map(res => res.json());
  }

  saveAnnualTurnOver(formdata) {
    const body = JSON.stringify({ turnover: formdata });
    return this.http.post('mcp/mastercompanyprofile/saveannualturnover', body).map(res => res.json());
  }

  saveBankerInformation(formdata, module?: any) {
    const body = JSON.stringify({ bankinfo: formdata });
    const queryStrmodule = module != '' ? '?module=' + module : '';
    return this.http.post('mcp/mastercompanyprofile/savebankdetails' + queryStrmodule, body).map(res => res.json());
  }

  saveAuditorTurnoverInformation(formdata, module?: any) {
    const body = JSON.stringify({ auditorinfo: formdata });
    const valque = module ? '?module=scf' : '';
    return this.http.post('mcp/mastercompanyprofile/saveauditordetails' + valque, body).map(res => res.json());
  }

  saveAuditorInformation(formdata) {
    const body = JSON.stringify({ auditorinfo: formdata });
    return this.http.post('mcp/mastercompanyprofile/saveauditordetails', body).map(res => res.json());
  }

  getSectordetails(companypk) {
    return this.http.get('mcp/mastercompanyprofile/sectordetails?companypk=' + companypk).map(res => res.json());
  }

  getAuditorInformation(companypk, isInitialLoad: boolean = false) {
    return this.http.get('mcp/mastercompanyprofile/auditorinformation?companypk=' + companypk + '&is-initial=' + isInitialLoad).map(res => res.json());
  }

  deleteAuditor(pk) {
    return this.http.get('mcp/mastercompanyprofile/deleteauditor?id=' + pk).map(res => res.json());
  }

  deleteSectorActivity(pk) {
    return this.http.get('mcp/mastercompanyprofile/deletesectordetails?id=' + pk).map(res => res.json());
  }

  viewSectorActivity(pk) {
    return this.http.get('mcp/mastercompanyprofile/viewsectordetails?id=' + pk).map(res => res.json());
  }

  viewAuditorInfo(pk) {
    return this.http.get('mcp/mastercompanyprofile/auditorinfo?id=' + pk).map(res => res.json());
  }

  getinsightvalues() {
    return this.http.get('pm/profile/getinsight').map(res => res.json());
  }

  getproductlisting(page, pagesize, filter_form_values, statusvalues,
                    ratingArray, readynessArray, userSort, catpk, quepriority?: any,catalog='',groupCategoryid=null, mainCategoryid=null, subCategoryid=null) {
        this.querystr = '';
        this.product_createdon_from = '';
        this.product_createdon_to = '';
        this.product_updatedon_from = '';
        this.product_updatedon_to = '';

        if (filter_form_values.national_product == true) {
          this.querystr += `&np=1`;
        } else {
          this.querystr += `&np=0`;
        }


        if (statusvalues != '') {
          this.querystr += `&status=${statusvalues}`;
        }
        if (catpk != null) {
          this.querystr += `&catpk=${catpk}&otherCompany=YES`;
        }

        if (ratingArray != '' && ratingArray != undefined) {
          this.querystr += `&rating=${ratingArray}`;
        }

        if (readynessArray != '' && readynessArray != undefined) {
          this.querystr += `&readiness=${readynessArray}`;
        }

        if (filter_form_values.search != '' && filter_form_values.search != undefined) {
            this.querystr += `&search=${filter_form_values.search}`;
          }

        if (filter_form_values.value.product_createdon != null && filter_form_values.value.product_createdon != '' && filter_form_values.value.product_createdon != undefined) {
          if (filter_form_values.value.product_createdon.startDate != '' && filter_form_values.value.product_createdon.startDate != undefined && filter_form_values.value.product_createdon.startDate != null) {
            this.product_createdon_from = moment(filter_form_values.value.product_createdon.startDate._d).format('YYYY-MM-DD').toString();
            this.product_createdon_to = moment(filter_form_values.value.product_createdon.endDate._d).format('YYYY-MM-DD').toString();
          }
        }
        if (filter_form_values.value.product_updatedon != null && filter_form_values.value.product_updatedon != '' && filter_form_values.value.product_updatedon != undefined) {
          if (filter_form_values.value.product_updatedon.startDate != '' && filter_form_values.value.product_updatedon.startDate != undefined && filter_form_values.value.product_updatedon.startDate != null) {
            this.product_updatedon_from = moment(filter_form_values.value.product_updatedon.startDate._d).format('YYYY-MM-DD').toString();
            this.product_updatedon_to = moment(filter_form_values.value.product_updatedon.endDate._d).format('YYYY-MM-DD').toString();
          }
        }

        if (filter_form_values.product_date != '' && filter_form_values.product_date != null && this.filter_form_values.product_date != undefined) {
          this.querystr += `&MCPrD_ProductDate=${this.filter_form_values.product_date}`;
        }

        if (filter_form_values.KeywordSearch != '' && filter_form_values.KeywordSearch != null && this.filter_form_values.KeywordSearch != undefined) {
          this.querystr += `&MCPrD_SearchKeyword=${this.filter_form_values.KeywordSearch}`;
        }

        if (this.product_createdon_from != '' && this.product_createdon_from != null && this.product_createdon_from != undefined) {
          this.querystr += `&MCPrD_CreatedOnStart=${this.product_createdon_from}`;
        }

        if (this.product_createdon_to != '' && this.product_createdon_to != null && this.product_createdon_to != undefined) {
          this.querystr += `&MCPrD_CreatedOnEnd=${this.product_createdon_to}`;
        }

        if (this.product_updatedon_from != '' && this.product_updatedon_from != null && this.product_updatedon_from != undefined) {
          this.querystr += `&MCPrD_UpdatedOnStart=${this.product_updatedon_from}`;
        }

        if (this.product_updatedon_to != '' && this.product_updatedon_to != null && this.product_updatedon_to != undefined) {
          this.querystr += `&MCPrD_UpdatedOnEnd=${this.product_updatedon_to}`;
        }

        if (filter_form_values.product_status != '' && filter_form_values.product_status != null && filter_form_values.product_status != undefined) {
          this.querystr += `&MCPrD_NationalProdStatus=${this.filter_form_values.product_status}`;
        }

        if (filter_form_values.product_displyname != '' && filter_form_values.product_displyname != null && filter_form_values.product_displyname != undefined) {
          this.querystr += `&MCPrD_DisplayName=${this.filter_form_values.product_displyname}`;
        }

        if (filter_form_values.value.businesssource != '' && filter_form_values.value.businesssource != null && filter_form_values.value.businesssource != undefined) {
          this.querystr += `&MCPrD_BusSource=${filter_form_values.value.businesssource}`;
        }

        if (filter_form_values.value.businessdiv != '' && filter_form_values.value.businessdiv != null && filter_form_values.value.businessdiv != undefined) {
          this.querystr += `&MemCompSecDtls_Pk=${filter_form_values.value.businessdiv}`;
        }

        if (filter_form_values.value.businesssunit != '' && filter_form_values.value.businesssunit != null && filter_form_values.value.businesssunit != undefined) {
          this.querystr += `&SectorMst_Pk=${filter_form_values.value.businesssunit}`;
        }

        if (filter_form_values.value.unpsc != '' && filter_form_values.value.unpsc != null && filter_form_values.value.unpsc != undefined) {
          this.querystr += `&PrdM_ProductCode=${filter_form_values.value.unpsc}`;
        }

        if (filter_form_values.value.sector != '' && filter_form_values.value.sector != null && filter_form_values.value.sector != undefined) {
          this.querystr += `&SectorPk=${filter_form_values.value.sector}`;
        }

        if (filter_form_values.value.activity != '' && filter_form_values.value.activity != null && filter_form_values.value.activity != undefined) {
          this.querystr += `&mcprd_activitiesmst_fk=${filter_form_values.value.activity}`;
        }

        if (filter_form_values.filter == 'no') {
          this.querystr = '';
        }

        if (quepriority) {
          this.querystr += `&${quepriority}`;
        }
        if(this.querystr!=''&&catalog!=''){
          this.querystr += `&catalog=${catalog}&groupCategoryid=${groupCategoryid}&mainCategoryid=${mainCategoryid}&subCategoryid=${subCategoryid}`;
        }
        const pageoptionenable = (typeof page != 'undefined' && page != null) ? `?usersort=${userSort}&page=${page}&size=${pagesize}` : '';
        return this.http.get('pm/profile/getprodlist' + pageoptionenable + this.querystr).map(res => res.json());
  }

  getservicelisting(page, pagesize, filter_form_values, statusvalues, ratingArray,
                    readynessArray, userSort, catpk, priority?: any, catalog='',groupCategoryid=null, mainCategoryid=null, subCategoryid=null) {
        this.querystr = '';

        this.service_createdon_from = '';
        this.service_createdon_to = '';
        this.service_updatedon_from = '';
        this.service_updatedon_to = '';

        if (statusvalues != '') {
          this.querystr += `&status=${statusvalues}`;
        }
        if (catpk != null) {
          this.querystr += `&catpk=${catpk}&otherCompany=YES`;
        }
        if (priority) { // scf towards
          this.querystr += `&${priority}`;
        }
        if (ratingArray != '' && ratingArray != undefined) {
          this.querystr += `&rating=${ratingArray}`;
        }

        if (readynessArray != '' && readynessArray != undefined) {
          this.querystr += `&readiness=${readynessArray}`;
        }        

        if (filter_form_values.value.service_createdon != '' && filter_form_values.value.service_createdon != undefined) {
          if (filter_form_values.value.service_createdon.startDate != '' && filter_form_values.value.service_createdon.startDate != undefined && filter_form_values.value.service_createdon.startDate != null) {
            this.service_createdon_from = moment(filter_form_values.value.service_createdon.startDate._d).format('YYYY-MM-DD').toString();
            this.service_createdon_to = moment(filter_form_values.value.service_createdon.endDate._d).format('YYYY-MM-DD').toString();
          }
        }
        if (filter_form_values.value.service_updatedon != '' && filter_form_values.value.service_updatedon != undefined) {
          if (filter_form_values.value.service_updatedon.startDate != '' && filter_form_values.value.service_updatedon.startDate != undefined && filter_form_values.value.service_updatedon.startDate != null) {
            this.service_updatedon_from = moment(filter_form_values.value.service_updatedon.startDate._d).format('YYYY-MM-DD').toString();
            this.service_updatedon_to = moment(filter_form_values.value.service_updatedon.endDate._d).format('YYYY-MM-DD').toString();
          }
        }

        if (filter_form_values.KeywordSearch != '' && filter_form_values.KeywordSearch != null && this.filter_form_values.KeywordSearch != undefined) {
          this.querystr += `&MCPrD_SearchKeyword=${this.filter_form_values.KeywordSearch}`;
        }

        if (this.service_createdon_from != '' && this.service_createdon_from != null && this.service_createdon_from != undefined) {
          this.querystr += `&MCSvD_CreatedOnStart=${this.service_createdon_from}`;
        }

        if (this.service_createdon_to != '' && this.service_createdon_to != null && this.service_createdon_to != undefined) {
          this.querystr += `&MCSvD_CreatedOnEnd=${this.service_createdon_to}`;
        }

        if (this.service_updatedon_from != '' && this.service_updatedon_from != null && this.service_updatedon_from != undefined) {
          this.querystr += `&MCSvD_UpdatedOnStart=${this.service_updatedon_from}`;
        }

        if (this.service_updatedon_to != '' && this.service_updatedon_to != null && this.service_updatedon_to != undefined) {
          this.querystr += `&MCSvD_UpdatedOnEnd=${this.service_updatedon_to}`;
        }

        if (filter_form_values.value.businesssource != '' && filter_form_values.value.businesssource != null && filter_form_values.value.businesssource != undefined) {
          this.querystr += `&MCSvD_BusSource=${filter_form_values.value.businesssource}`;
        }

        if (filter_form_values.value.businesssunit != '' && filter_form_values.value.businesssunit != null && filter_form_values.value.businesssunit != undefined) {
          this.querystr += `&SectorMst_Pk=${filter_form_values.value.businesssunit}`;
        }
        if (filter_form_values.value.unpsc != '' && filter_form_values.value.unpsc != null && filter_form_values.value.unpsc != undefined) {
          this.querystr += `&SrvM_ServiceCode=${filter_form_values.value.unpsc}`;
        }

        if (filter_form_values.value.sector != '' && filter_form_values.value.sector != null && filter_form_values.value.sector != undefined) {
          this.querystr += `&SectorPk=${filter_form_values.value.sector}`;
        }

        if (filter_form_values.value.activity != '' && filter_form_values.value.activity != null && filter_form_values.value.activity != undefined) {
          this.querystr += `&mcsvd_activitiesmst_fk=${filter_form_values.value.activity}`;
        }

        if (filter_form_values.filter == 'no') {
          this.querystr = '';
        }
        if (filter_form_values.search != '' && filter_form_values.search != undefined) {
          this.querystr += `&search=${filter_form_values.search}`;
        }

        if (priority) {
          this.querystr += `&${priority}`;
        }
        if(this.querystr!=''&&catalog!=''){
          this.querystr += `&catalog=${catalog}&groupCategoryid=${groupCategoryid}&mainCategoryid=${mainCategoryid}&subCategoryid=${subCategoryid}`;
        }

        const pageoptionenable = (typeof page != 'undefined' && page != null) ? `?usersort=${userSort}&page=${page}&size=${pagesize}` : '';
        return this.http.get('pm/profile/getservicelist' + pageoptionenable + this.querystr).map(res => res.json());
  }

  complianceCertificationService(postParams, href) {
    const formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href, formParam).map(res => res.json());
  }
  licenseImageDelete(postParams, href) {
    const formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href, formParam).map(res => res.json());
  }
// ServicePartitionsave

  servicepartisionsave(data, type, id?: any) {
    let body ='';
    if (type == 1) {
      body = JSON.stringify({'memcompservdtls': data});
    } else if (type == 2) {
      //alert('2');
       body = JSON.stringify({'memcompservdtls': data});
    } else if (type == 3) {
      const server_obj = {'memcompservdtls_pk': id, 'socialmediapage': data.socialmediapage, 'type': type};
       body = JSON.stringify({'memcompservdtls': server_obj});
    } else if (type == 4 || type == 5) {
      const server_obj = {'memcompservdtls_pk': id, 'type': type,servicespecfication:'',specdata:''};
      server_obj.servicespecfication = data[0].servicespecfication;
      server_obj.specdata = data[1];
       body = JSON.stringify({'memcompservdtls': server_obj});
    } else if (type == 6 || type == 7) {
      const server_obj = {'memcompservdtls_pk': id, 'agentprinciple': data, 'type': type};
       body = JSON.stringify({'memcompservdtls': server_obj});
    } else if (type == 9) {
      data.memcompservdtls_pk = id;
       body = JSON.stringify({'memcompservdtls': data});
    } else if (type == 10) {
      data.memcompservdtls_pk = id;
       body = JSON.stringify({'memcompservdtls': data});
    } else if (type == 11) {
      const serv_obj = {'memcompservdtls_pk': id, 'string_ids': data[0], 'type': 11, 'locationtype': data[1]};
       body = JSON.stringify({'memcompservdtls': serv_obj});
    } else if (type == 12) {
       body = JSON.stringify({'memcompservdtls': {'memcompservdtls_pk': id, 'typeofinsert': data, 'type': type}});
    }
    return this.http.post(this._url + 'servicepartitionsave', body).map(res => res.json());
  }

  webpresenceinfo(companypk: string, isInitialLoad: boolean = false) {
    return this.http.get('mcp/mastercompanyprofile/webpresence?id=' + companypk + '&is-intial=' + isInitialLoad).map(res => res.json());
  }

  refreshToken() {
    const refreshToken = localStorage.getItem('v3logindatarefresh');
    return this.newHttp.post(this.baseUrl + 'mcp/mastercompanyprofile/refresh', { refreshToken});
  }

  savewebpresence(formValue) {
    const body = JSON.stringify({ webpresence: formValue });
    return this.http.post('mcp/mastercompanyprofile/savewebpresenceinfo', body).map(res => res.json());
  }
  getbusinesssourcelisting() {
    return this.http.get('pm/profile/getbusinesssource').map(res => res.json());
  }
  getbussourcelisting() {
    return this.http.get('pm/profile/getbusinesssourcelist').map(res => res.json());
  }
  getproductbusunitlisting() {
    return this.http.get('pm/profile/getproductbusunitlisting').map(res => res.json());
  }

  getproductdivisionlisting(type) {
    return this.http.get(this.contacturl + 'getdivisionlist?type=' + type).map(res => res.json());
  }

  getbussrcunitlistfordivsion(value) {
    return this.http.get(this.contacturl + 'getbusrcunitlistfordivision?id=' + value).map(res => res.json());
  }

  getservicebusunitlisting() {
    return this.http.get('pm/profile/getservicebusunitlisting').map(res => res.json());
  }

  getbusinesssourcelistingforservice() {
    return this.http.get('pm/profile/getbusinesssourceforservice').map(res => res.json());
  }

  getbussourcelistingforservice() {
    return this.http.get('pm/profile/getbusinesssourcserviceelist').map(res => res.json());
  }

  getunpsclisting() {
    return this.http.get('pm/profile/getunpsc').map(res => res.json());
  }
  getunpsclistingforservice() {
    return this.http.get('pm/profile/getunpscforservice').map(res => res.json());
  }
  getsectorlisting() {
    return this.http.get('pm/profile/getsector').map(res => res.json());
  }

  getsectorlistingforservice() {
    return this.http.get('pm/profile/getsectorforservice').map(res => res.json());
  }

  getActivity(sector_id) {
    return this.http.get('pm/profile/getactivity?sectors=' + sector_id).map(res => res.json());
  }

  getActivityforservice(sector_id) {
    return this.http.get('pm/profile/getactivityforservice?sectors=' + sector_id).map(res => res.json());
  }
  saveBoardOfDirectors(formValue) {
    const body = JSON.stringify({ boardofdirector: formValue });
    return this.http.post('mcp/mastercompanyprofile/save-board-of-director', body).map(res => res.json());
  }
  getBoardOfDirectors(companypk: string, pageno: number, perpage: number, search: string, isInitialLoad: boolean, panel: any) {
    return this.http.get('mcp/mastercompanyprofile/board-of-directors?id=' + companypk + '&page=' + pageno + '&size=' + perpage + '&search=' + search + '&is-initial=' + isInitialLoad + '&panel=' + panel).map(res => res.json());
  }
  getcertifcapagindata(pageno: number, perpage: number, search: string) {
    return this.http.get('mcp/mastercompanyprofile/getcertificatedatapag?page=' + pageno + '&size=' + perpage + '&search=' + search).map(res => res.json());
  }
  boardOfDirectors(bod_pk: string) {
    return this.http.get('mcp/mastercompanyprofile/get-board-of-director?id=' + bod_pk).map(res => res.json());
  }
  deleteBoardOfDirectors(bod_pk: string) {
    return this.http.get('mcp/mastercompanyprofile/delete-board-of-director?id=' + bod_pk).map(res => res.json());
  }
  deleteproduct(product) {
    return this.http.get('pm/profile/deleteproduct?pk=' + product).map(res => res.json());
  }
  checkExternalProfile(external_profile) {
    const responseBody = JSON.stringify({ data: external_profile });
    return this.http.post('mcp/mastercompanyprofile/checkalreadyexists', responseBody).map(res => res.json());
  }

  checkLink(external_profile) {
    const responseBody = JSON.stringify({ data: external_profile });
    return this.http.post('mcp/mastercompanyprofile/isvalidlink', responseBody).map(res => res.json());
  }

  getMarketPresenceList(companypk, type, pageno?: any, perpage?: any, search: string = '') {
		return this.http.get('mcp/mastercompanyprofile/marketpresencelist?id=' + companypk + '&type=' + type + '&page=' + pageno + '&size=' + perpage + '&search=' + search).map(res => res.json());
  }
  
  getlocationdetail(id) {
		return this.http.get('mcp/mastercompanyprofile/getlocation?id=' + id).map(res => res.json());
  }
  
  getcmsmatketpresencelist(type) {
    return this.http.get('mcp/mastercompanyprofile/marketpresencelistbycms?type=' + type).map(res => res.json());
  }
	editMarketPresence(companypk: string) {
		return this.http.get('mcp/mastercompanyprofile/getmarketpresence?id=' + companypk).map(res => res.json());
	}

	saveMarketPresence(formvalue) {
		const body = JSON.stringify({ marketpresence: formvalue });
		return this.http.post('mcp/mastercompanyprofile/savemarketpresence', body).map(res => res.json());
	}
	saveAdditionalInformation(formvalue) {
		const body = JSON.stringify({ additionalValue: formvalue });
		return this.http.post('pm/profile/saveadditionalinfo', body).map(res => res.json());
	}

	deleteMarketPresence(companypk: string, type?: string) {
		return this.http.get('mcp/mastercompanyprofile/deletemarketpresence?id=' + companypk + '&type=' + type).map(res => res.json());
  }

  getCountryStateCityPk(countryname: string, statename?: string, cityname?: string) {
    return this.http.get('mcp/mastercompanyprofile/isregionexist?country=' + countryname + '&state=' + statename + '&city=' + cityname).map(res => res.json());
  }

  getglobalcountrylist() {
    return this.http.get('mst/country/globalcountrylist').map(res => res.json());
  }

  getbankinfolist(companypk: string) {
    return this.http.get('mcp/mastercompanyprofile/bankinfolist?id=' + companypk).map(res => res.json());
  }

  getGrpCmpSugg() {
    return this.http.get('mcp/mastercompanyprofile/grpcmpnamesugg').map(res => res.json());
  }

  getGroupCodeSugg(filterValue: string) {
    return this.http.get('mcp/mastercompanyprofile/grpcmpcodesugg?filterVal=' + filterValue).map(res => res.json());
  }

  getbusinesssource(editproduct= '') {
    const product = editproduct != '' ? `?product=${editproduct}` : '';
    return this.http.get('pm/profile/businesssourcewithtrade' + product).map(res => res.json());
  }
  getbusinesssourceservice() {
    return this.http.get('pm/profile/businesssourceforservice').map(res => res.json());
  }
  deleteBankerInfo(bankpk: string) {
    return this.http.get('mcp/mastercompanyprofile/deletebankerinfo?id=' + bankpk).map(res => res.json());
  }

  getCRInformation(companypk) {
    return this.http.get('mcp/mastercompanyprofile/crinfo?companypk=' + companypk).map(res => res.json());
  }

  updateSort(formvalue) {
		const body = JSON.stringify({ sort: formvalue });
		return this.http.post('mcp/mastercompanyprofile/update-sort', body).map(res => res.json());
	}
  addprodoctcontactinfo(details: any) {
    const body	=	JSON.stringify({'contactdtls': details});
    return this.http.post(this._url + 'map', body).map(res => res.json());
  }
  getBSData(details: any, datatype: any) {
    const body	=	JSON.stringify({'dataPk': details, 'type': datatype});
    return this.http.post(this._url + 'getbusiesssource', body).map(res => res.json());
  }
  addservicecontactinfo(details: any) {
    const body	=	JSON.stringify({'contactdtls': details});
    return this.http.post(this._url + 'mapservice', body).map(res => res.json());
  }
  getCntactById(details: any) {
    const body	=	JSON.stringify({'contactdtls': details});
    return this.http.post(this.contacturl + 'getcontactdetailsmultiple', body).map(res => res.json());
  }
  getcontactdetails(id: any) {
    return this.http.get(this._url + 'getcontactdetails?pk=' + id).map(res => res.json());
  }

  getcontactdetailsforservice(id: any) {
    return this.http.get(this._url + 'getcontactdetailsforservice?pk=' + id).map(res => res.json());
  }

  getcontactinfo(id: string, type?: any , page?: number, size?: number, search?: string) {
    return this.http.get(`mcp/mastercompanyprofile/contactinfolist?id=${id}&type=${type}&page=${page}&size=${size}&search=${search}`).map(res => res.json());
  }
  deletemapdata(product) {
    return this.http.get('pm/profile/deletemapping?product=' + product).map(res => res.json());
  }
  deletemapdataservice(service) {
    return this.http.get('pm/profile/deletemappingservice?service=' + service).map(res => res.json());
  }

  deletecontact(service_pk, contact_pk) {
    const body	=	JSON.stringify({'service_pk': service_pk, 'contact_id': contact_pk});
    return this.http.post('pm/profile/deletecontactinfo', body).map(res => res.json());
  }
  deleteproductcontact(product_id, contact_pk) {
    const body	=	JSON.stringify({'product_pk': product_id, 'contact_id': contact_pk});
    return this.http.post('pm/profile/deleteproductcontactinfo', body).map(res => res.json());
  }
  gettradelist(trade) {
    return this.http.get('pm/profile/tradelist?trade=' + trade).map(res => res.json());
  }
  partisionsavefinal(product_id, type) {
    const body	=	JSON.stringify({'memcompproddtls': {'memcompproddtls_pk': product_id, 'type': type}});
    return this.http.post('pm/profile/partisionsave', body).map(res => res.json());
  }
  submitdocsinfo(product_pk, docs: any) {
    const body	=	JSON.stringify({'product_pk': product_pk, 'docs': docs, });
    return this.http.post('pm/profile/addproductdocs', body).map(res => res.json());
  }
  submitservdocsinfo(service_pk, docs: any) {
    const body	=	JSON.stringify({'service_pk': service_pk, 'docs': docs, });
    return this.http.post('pm/profile/addservicedocs', body).map(res => res.json());
  }

  saveStockMarket(formdata) {
    const body = JSON.stringify({ stockmarket: formdata });
    return this.http.post('mcp/mastercompanyprofile/savestockmarketdtls', body).map(res => res.json());
  }

  getStockMarketdtls() {
    return this.http.get('mcp/mastercompanyprofile/stockmarketdetails').map(res => res.json());
  }

  getUnit() {
    return this.http.get('pm/profile/unitlist').map(res => res.json());
  }

  productvideos(postParams, href) {
    const formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href, formParam).map(res => res.json());
  }

  deletePrice(price_pk) {
    return this.http.get('pm/profile/deleteprice?pricepk=' + price_pk).map(res => res.json());
  }
  getquantityprice(pk, type) {
    return this.http.get('pm/profile/getquantityprice?pricepk=' + pk + '&type=' + type).map(res => res.json());
  }
  clearadditional(locationtype, detailpk, type) {
    return this.http.get('pm/profile/clearadditionalinfo?location=' + locationtype + '&detailpk=' + detailpk + '&type=' + type).map(res => res.json());
  }

  savefaq(faqvalue, type) {
    const body	=	JSON.stringify({'faqdata': faqvalue, 'type': type});
    return this.http.post('pm/profile/faqsave', body).map(res => res.json());
  }
  deletefaq(faq_pk) {
    return this.http.get('pm/profile/deletefaq?faqpk=' + faq_pk).map(res => res.json());
  }
  getprdspecdata(product, selectpkque?: any) {
    return this.http.get('pm/profile/prodspecdtbgi?product=' + product + selectpkque).map(res => res.json());
  }
  getusercreatedspecmst(type, shared, match_val= '', specDesc= '', productmst= '') {
    return this.http.get('pm/profile/getuserdefspecmst?category=' + type + '&shared=' + shared + '&match_val=' + match_val + '&specDesc=' + specDesc + '&productmst=' + productmst).map(res => res.json());
  }
  deletespecification(productService, spctbl, valtbl, type) {
    return this.http.get(`pm/profile/deletemapspec?type=${type}&productandservice=${productService}&sptbl=${spctbl}&valtbl=${valtbl}`).map(res => res.json());
  }
  getservicespec(service, selected?: any) {
    return this.http.get('pm/profile/servicespec?service=' + service + selected).map(res => res.json());
  }
  clearallspec(productorservice, type) {
    return this.http.get('pm/profile/clearallspec?shared=' + productorservice + '&type=' + type).map(res => res.json());
  }

  getkeywordsuggestions(str_arr) {
    return this.http.post('pm/profile/generatekeywords', str_arr).map(res => res.json());
  }

  unmappingbussrc(data) {
    const body	=	JSON.stringify({'bussrcdet': data});
    return this.http.post('pm/profile/unmappingbussrc', body).map(res => res.json());
  }

  getmappedbus(id, type) {
    return this.http.get('pm/profile/getmappedbus?pk=' + id + '&type=' + type).map(res => res.json());
  }

  addproductgroup(data) {
    const body	=	JSON.stringify({'prodgroup': data});
    return this.http.post('pm/profile/addproductgroup', body).map(res => res.json());
  }

  getproductmap() {
    return this.http.get('pm/profile/getproductgroup').map(res => res.json());
  }

  getcategoryproductmap(forpage) {
    return this.http.get('pm/profile/getproductbasedoncategory?forpage=' + forpage).map(res => res.json());
  }

  getproductgroupid(id) {
    const body	=	JSON.stringify({'id': id, 'type': 'P'});
    return this.http.post('pm/profile/getproductgroupid', body).map(res => res.json());
  }

  getservicegroupid(id) {
    const body	=	JSON.stringify({'id': id, 'type': 'S'});
    return this.http.post('pm/profile/getproductgroupid', body).map(res => res.json());
  }

  getproductmapbyid(id) {
    const body	=	JSON.stringify({'id': id});
    return this.http.post('pm/profile/getproductgroupforid', body).map(res => res.json());
  }

  deletegroupid(id) {
    const body	=	JSON.stringify({'id': id});
    return this.http.post('pm/profile/deletegroupid', body).map(res => res.json());
  }

  getproductexportfields(type) {
    return this.http.get('pm/profile/getattrlabel?type=' + type).map(res => res.json());
  }

  downloadexcel(arr, type, search_by) {
    let search_by_val = [{'key' : 'keyword', 'value' : search_by ? search_by : ''}];
    const body	=	JSON.stringify({'excelarray': JSON.stringify(arr), 'type' : type, 'search_by':search_by_val});
    return this.http.post('pm/profile/exportcsv', body).map(res => res.json());
  }

  logmsgdata(logmsg, type) {
    // type 1 = Add file
    // type 2 = Delete file
    // type 3 = Edit file
    const formParam = JSON.stringify({ 'logmsg': logmsg, 'logtype': type });
    return this.http.post(this._url1 + 'logmsgdata', formParam).map(res => res.json());
  }

  getproductmetdetails(pk) {
    return this.http.get('pm/profile/getproductdetails?propk=' + pk).map(res => res.json());
  }

  getservicemstdetails(pk) {
    return this.http.get('pm/profile/getservicedetails?servpk=' + pk).map(res => res.json());
  }

  moveproductgroup(selectedproduct, groupid, pagefor) {
    const body	=	JSON.stringify({'proids': selectedproduct, 'groupid': groupid, 'pagefor': pagefor});
    return this.http.post('pm/profile/moveproductgroup', body).map(res => res.json());
  }
  getdeletioncheck(productservice) {
    return this.http.get(this.svfurl + 'deletecheckprdservice?propk=' + productservice).map(res => res.json());
  }
  getReportedMaster() {
    return this.http.get('mcp/mastercompanyprofile/getreportedto').map(res => res.json());
  }
  getcommunicadd() {
    return this.http.get('mcp/mastercompanyprofile/getcommunicationadd').map(res => res.json());
  }
  saveBasicuserinfo(basicformdet) {
    const body	=	JSON.stringify({'bdata': basicformdet});
    return this.http.post('mcp/mastercompanyprofile/savbsicdet', body).map(res => res.json());
  }
  deletecertif(certid) { 
    const body	=	JSON.stringify({'certid': certid});
    return this.http.post('mcp/mastercompanyprofile/deletecertif', body).map(res => res.json());
  }
  deletesocialmedia(type) {
    const body	=	JSON.stringify({'type': type});
    return this.http.post('mcp/mastercompanyprofile/deletesocialmed', body).map(res => res.json());
  }
  deletewebpresence(type) {
    const body	=	JSON.stringify({'type': type});
    return this.http.post('mcp/mastercompanyprofile/deletewebpre', body).map(res => res.json());
  }
  savecommunuserinfo(communformdet) {
    const body	=	JSON.stringify({'bdata': communformdet});
    return this.http.post('mcp/mastercompanyprofile/savcomunidet', body).map(res => res.json());
  }
  savecommunadduserinfo(communformdet) {
    const body	=	JSON.stringify({'bdata': communformdet});
    return this.http.post('mcp/mastercompanyprofile/savecomunadddet', body).map(res => res.json());
  }
  savecertifinfo(certifformdet, cerid) {
    const body	=	JSON.stringify({'bdata': certifformdet, 'cerid': cerid});
    return this.http.post('mcp/mastercompanyprofile/savcertdet', body).map(res => res.json());
  }
  savesocialmednfo(socilmedformdet) {
    const body	=	JSON.stringify({'bdata': socilmedformdet});
    return this.http.post('mcp/mastercompanyprofile/savcsocialmediadett', body).map(res => res.json());
  }
  getUserbasicprofMaster(id) {
    const body	=	JSON.stringify({'id': id});
    return this.http.post('mcp/mastercompanyprofile/getbasicprofiledet', body).map(res => res.json());
  }
  getUserprofMaster(id) {
    const body	=	JSON.stringify({'id': id});
    return this.http.post('mcp/mastercompanyprofile/getprofiledet', body).map(res => res.json());
  }
  prdservicehistory(type, cardpk) {
    return this.http.get('svf/svf/prdservicehistory?type=' + type + '&itempk=' + cardpk).map(res => res.json());
  }
  saveLogo(filePk) {
    const body = JSON.stringify({ filePk });
    return this.http.post('mcp/mastercompanyprofile/deletelogo', body).map(res => res.json());
  }
  savecmpLogo(filePk) {
    const body = JSON.stringify({ filePk });
    return this.http.post('mcp/mastercompanyprofile/deletecmplogo', body).map(res => res.json());
  }
  deleteboardofdirectorlogo(filePk) {
    const body = JSON.stringify({ filePk });
    return this.http.post('mcp/mastercompanyprofile/deleteboardofdirectorlogo', body).map(res => res.json());
  }

  commonApiService(postParams,href){
    let formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href,formParam).map(res => res.json()); 
  }
  getBusinessUnit(postParams,href){
    let formParam = JSON.stringify({ 'postParams': postParams });
    return this.http.post(href,formParam).map(res => res.json());
  }
  getprofilecommentstemplate() {
    return this.http.get('mcp/mastercompanyprofile/getprofilecommentstemplate').map(res => res.json());
  }
  getmastercompanydontshowstatus(dataVal) {
    let body = JSON.stringify({ dataVal: dataVal })
    return this.http.post('mcp/mastercompanyprofile/getmastercompanylandingpagedata', body).map(res => res.json());
  }
  chkdontshowmcp() {
    return this.http.get('mcp/mastercompanyprofile/getchkdontshowstatusmcp').map(res => res.json());
  }
  setSideNavClose(value,type) {
    this.sideNavClose.emit({type,value});
  } 

  getIndustryZone() {
    return this.http.get('mcp/mastercompanyprofile/industry-zone-list').map(res => res.json());
  }

  getIndustryEstate() {
    return this.http.get('mcp/mastercompanyprofile/industry-estate-list').map(res => res.json());
  }

  getBusinessLicense() {
    return this.http.get('mcp/mastercompanyprofile/buss-license-list').map(res => res.json());
  }
  getOfficeTypeList() {
    return this.http.get('mcp/mastercompanyprofile/office-type-list').map(res => res.json());
  }

  getisicactivitylist(){
    return this.http.get('mcp/mastercompanyprofile/isic-activity-list').map(res => res.json());
  }
  
  getbranchlist(page:any,size:any,searchmarketpresence:any,comp_pk:any){
    const body	=	JSON.stringify({'page': page, 'size': size, 'search': searchmarketpresence,'comp_pk': comp_pk});
    return this.http.post('mcp/mastercompanyprofile/branch-list', body).map(res => res.json());
  }

  getbranchlistbus(page:any,size:any,searchmarketpresence:any){
    const body	=	JSON.stringify({'page': page, 'size': size, 'search': searchmarketpresence});
    return this.http.post('mcp/mastercompanyprofile/branch-list-bus', body).map(res => res.json());
  }

  getbranchlistforexternal(){
    return this.http.get('mcp/mastercompanyprofile/branch-listforexternal').map(res => res.json());
  }

  getselectedbranch(brpk:any){
    return this.http.get('mcp/mastercompanyprofile/branch-list-selected?brpk='+brpk).map(res => res.json());
  }

  getprodbranchlist(prodpk:any,type:any) {
    return this.http.get('pm/profile/prod-branch-list?prodpk='+prodpk+'&type='+type).map(res => res.json());
  }

  getserbranchlist(serPk:any,type:any) {
    return this.http.get('pm/profile/ser-branch-list?serpk='+serPk+'&type='+type).map(res => res.json());
  }

  getbssr_branch_factory(selbs_pkarr:any){
    return this.http.get('mcp/mastercompanyprofile/prod-bsource-branchfactory?selbs_pkarr='+selbs_pkarr).map(res => res.json());
  }

  getbssr_branch_factory_ser(selbs_pkarr:any){
    return this.http.get('mcp/mastercompanyprofile/ser-bsource-branchfactory?selbs_pkarr='+selbs_pkarr).map(res => res.json());
  }

  delbranchfactory(prodid:any,selec_pk:any,type:any) {
    let body = JSON.stringify({prodid:prodid,selec_pk:selec_pk,type:type })
    return this.http.post('pm/profile/removebranchfactory', body).map(res => res.json());
  }

  delbranchfactorySer(serid:any,selec_pk:any,type:any) {
    let body = JSON.stringify({serid:serid,selec_pk:selec_pk,type:type })
    return this.http.post('pm/profile/removebranchfactoryser', body).map(res => res.json());
  }

  updateComEnable(status:any,mem_com:any) {
    let body = JSON.stringify({status:status,mem_com:mem_com })
    return this.http.post('pm/profile/updatecompanyenable', body).map(res => res.json());
  }

  getbranchvalidationdtls(comp_pk,formid,branchdtlspk){
    let body = JSON.stringify({'comp_pk':comp_pk,'formid':formid,'branchdtlspk': branchdtlspk})
    return this.http.post('mcp/mastercompanyprofile/getbranchvalidationdtls', body).map(res => res.json());
  }



}
