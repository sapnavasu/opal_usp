import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { RemoteService } from '@app/remote.service';

@Injectable()
export class AdminService {

  public usenameurl = 'lgn/login/getusers';
  public baseurl = 'lgn/login/login';
  public forgoturl = 'lgn/login/forgotpassword';
  public forgotsend = 'lgn/login/sendforgotpwdmail';
  public resetpassword = 'lgn/login/resetpassword';
  public isvalidlink = 'lgn/login/isvalidlink';
  public fgtotpverify = 'lgn/login/fgtotpverify';
  public sendloginotp = 'lgn/login/sendloginotp';
  public configurationjson = 'backend/configuration/formdata';
  public socialurl = 'lgn/login/sociallogin';
  public sendotp = 'lgn/login/sendotp';
  public verifyotp = 'lgn/login/verifyotp';
  public userpermission = 'lgn/login/userpermission';
  public resendotp = 'lgn/login/resendotp';
  public getpwdmodfy = 'lgn/login/getpdmodify';
  public learner = 'lgn/login/';
 // public setpassword = 'admin/login/setpassword';
  constructor(private remoteservice: RemoteService, private http: HttpClient, private oldhttp: Http) { }


  getlearnerfeedbackquestion(learnerId) {
    return this.remoteservice.get(this.learner + 'getfeedbackquestion?learnerId=' + learnerId).map(res => res.json());
  }

  savefeedbackquestion(data){
    return this.remoteservice.post(this.learner + 'savefeedbackquestion', data).map(res => res.json());
  }

  adminlogin(username: any, password: any, isDemo:boolean,userpk:number,stktype?:number,countrycode?:any) {
    return this.remoteservice.post(this.baseurl,
      JSON.stringify({ 'AdminLoginForm': { username, password, isDemo ,userpk,stktype,countrycode:countrycode}})
    ).map(loginresponse => loginresponse.json());
  }
  getusers(username: any,type?:any) {
    return this.remoteservice.post(this.usenameurl,
      JSON.stringify({ 'formdata': { username,type }})
    ).map(loginresponse => loginresponse.json());
  }
  sociallogin(username: any) {
    return this.remoteservice.post(this.socialurl,
      JSON.stringify({
        'SocialLoginForm': {
          'username': username
        }
      })
    ).map(loginresponse => loginresponse.json());
  }
  forgotcheck(type: any, value: any) {
    if (type == 1) {
      const body = JSON.stringify({ 'forgotmail': { 'email': value.email } });
      return this.remoteservice.post(this.forgoturl, body).map(res => res.json());
    } else {
      const body = JSON.stringify({ 'forgotmail': { 'email': value.email, 'userid': value.utype}});
      return this.remoteservice.post(this.forgotsend, body).map(res => res.json());
    }
  }
  fillpassword(formdata: any) {
    const body = JSON.stringify({'setpassword': formdata});
    return this.remoteservice.post(this.resetpassword, body).map(res => res.json());
  }
  getuseremailid(usertoken: any) {
    const body = JSON.stringify({'usertoken': usertoken});
    return this.remoteservice.get('admin/login/getuserdata?token=' + usertoken).map(res => res.json());
  }
  configurjson() {
    return this.remoteservice.get(this.configurationjson + '?type=Setting').map(res => res.json());
  }
  sendForgotMail(email: any,userpk: any,type?:any) {
    return this.remoteservice.post(this.forgotsend,
      JSON.stringify({ 'email': email,'userpk':userpk,'type':type})
    ).map(response => response.json());
  }
  getuserssendemail(email: any,pk:any,type:any) {
    return this.remoteservice.post('lgn/login/sendforgotpwdmail',
      JSON.stringify({ 'email': email,'pk':pk,'type':type})
    ).map(response => response.json());
  }
  resetPassword(userpk: any, password: any, otptype:any = 'email',diff) {
    return this.remoteservice.post(this.resetpassword,
      JSON.stringify({ 'userpk': userpk, 'password': password, 'type':otptype ,'diff':diff})
    ).map(response => response.json());
  }
  checkValidResetLink(userpk: any, datetime: any) {
    return this.remoteservice.post(this.isvalidlink,
      JSON.stringify({ 'userpk': userpk, 'dt': datetime  })
    ).map(response => response.json());
  }
  checkValidOTP(userpk: any, otp: any,type?:any) {
    return this.remoteservice.post(this.fgtotpverify,
      JSON.stringify({ 'userpk': userpk, 'otp': otp,'type':type  })
    ).map(response => response.json());
  }
  validateloginotp(userpk: any, otp: any,type?:any) {
    return this.remoteservice.post('lgn/login/validateloginotp',
      JSON.stringify({ 'userpk': userpk, 'otp': otp,'type':type  })
    ).map(response => response.json());
  }
 
  sendLoginOtp(pk:any){
    // alert(pk);
    return this.remoteservice.post(this.sendloginotp,
      JSON.stringify({ 'pk': pk  })
    ).map(response => response.json());
  }
  
  sendOTP(userpk: any, password: any ,otptype: any) {
    return this.remoteservice.post(this.sendotp,
      JSON.stringify({ 'userpk': userpk, 'currentpassword': password, 'otptype': otptype })
    ).map(response => response.json());
  }

  verifyOTP(userpk: any, otp: any ,otptype: any) {
    return this.remoteservice.post(this.verifyotp,
      JSON.stringify({ 'userpk': userpk, 'OTP': otp, 'otptype': otptype })
    ).map(response => response.json());
  }

  getuserpermission(userpk: any) {
    return this.remoteservice.post(this.userpermission,
      JSON.stringify({ 'userpk': userpk})
    ).map(response => response.json());
  }
  getlastmodify(userpk: any) {
    return this.remoteservice.post(this.getpwdmodfy,
      JSON.stringify({ 'userpk': userpk})
    ).map(response => response.json());
  }
  resendOTP(userpk: any, password: any, newpassword: any,otptype: any) {
    return this.remoteservice.post(this.resendotp,
      JSON.stringify({ 'userpk': userpk, 'currentpassword': password, 'newpassword': newpassword, 'otptype': otptype })
    ).map(response => response.json());
  }
  
  acceptOrCancelReg(type: string, regPk: string, cancelcomment: any, willingon: string) {
    let url = (type === 'accept') ? 'lgn/login/acceptreg' : 'lgn/login/cancelreg';
    if(type === 'cancel'){
      url += `?reg_pk=${regPk}&type=${type}&cancelcomment=${cancelcomment}&willingon=${willingon}`;
    }else{
      url += `?reg_pk=${regPk}&type=${type}`;
    }    
    return this.remoteservice.get(url).map(response => response.json());
  }
  getOttuResponseData(encryptedPaymentDtl: string) {
    const body = JSON.stringify({ paymentDtl: encryptedPaymentDtl  });
    return this.remoteservice.post('lgn/login/getotturesponsedata',body).map(res => res.json());
  }

  userterevedtls(memReg: string,projectType: Number) {
    const body = JSON.stringify({ memReg: memReg ,projectType:projectType });
    return this.remoteservice.post('center/app-center/userterevedtls',body).map(res => res.json());
  }
getuserpermissionaccess(userpk: string){

    const body = JSON.stringify({ userpk: userpk  });
    return this.remoteservice.post('lgn/login/getuseraccess',body).map(res => res.json());
  }  
}

