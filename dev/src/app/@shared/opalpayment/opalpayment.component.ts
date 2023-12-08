import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup,FormArray, Validators, FormControl, FormGroupDirective, RequiredValidator } from '@angular/forms';
import { MatTabGroup } from '@angular/material/tabs';
import { CookieService } from 'ngx-cookie-service';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { DriveInput } from '@app/common/classes/driveInput';
import { ApplicationService } from '@app/services/application.service';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import moment from 'moment';
import { DateAdapter, MAT_DATE_FORMATS } from '@angular/material/core';
import swal from 'sweetalert';
import { Filee } from '@app/@shared/filee/filee';
import { Modalpayment } from './paymentcentre/paymentcentre.component';
import { ActivatedRoute, NavigationEnd, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';

@Component({
  selector: 'app-opalpayment',
  templateUrl: './opalpayment.component.html',
  styleUrls: ['./opalpayment.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})

export class OpalpaymentComponent implements OnInit {
  
  previousURL: string = '';
  currentURL: string = '';

paymentinfo: any;
paymentinfos: any; 
@Input() payment: any = [];
@Input() record: any = [];
  classadd: boolean;
  renewalpaymentfine: boolean = false;
  updatepayment: boolean = false;
  paymenttypes: any;
  projectType: any;
i18n(key) {
  return this.translate.instant(key);
}
  payTemplate = 'typeofpayment';
  selectTypepayment = 'typeofPay';
  displaypaymode: any;
  onlinepayment: boolean = false;
  warning: boolean = false;
  chequepayment: boolean = false;
  banktransfer: boolean = false;
  cashpayment: boolean = true;

  constructor( private translate: TranslateService,
    private remoteService: RemoteService,public routeid: ActivatedRoute,
    private secuirty: Encrypt,private myRoute: Router,private security: Encrypt,
    private cookieService: CookieService,private formBuilder: FormBuilder, private el: ElementRef, private appservice: ApplicationService,) { 
      
    }
  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  @ViewChild('pymtproof') pymtproofFilee: Filee;
  @Input() mattab: number = 0;
  @Output() maindata = new EventEmitter<any>();
  public transferForm: FormGroup;
  public requestForm: FormGroup;
  drvInputed: DriveInput;
  public proofdoc: any='';
  public filetype: any='';
  public auditdate: any='';
  public auditorname: any='';
  public auditstatus: any='';
  public appstatus: any='';
  public projname: any='';
  public crossedcontent: any='';
  public langkey: any='en';
  public lista=[];
  public availabledatesarr: any=[];
  paybtn: boolean = true;
  public notedcontent: boolean = true;
  public corssedorcompleted: boolean = false;
  disableBtn: boolean = false;
  disableSubmitButton: boolean = false;
  maxDate = new Date();
  public paymentStatus: any;
  public allDupedDates: Date[] = [];
  public paymentDetails: any;
  public pymtres: any;
  public pymttrkno: any;
  public appdtpk: any;
  public propk: any;
  public apptype: any;
  public applicationtype: any;
  myFilter = (d: Date): boolean => {
    const blockedDates = this.allDupedDates.map((d) => d.valueOf());
    const day = d.getDay();
    // Enable only the given dates.
    return blockedDates.includes(d.valueOf()) && day !== 6;
  };  
  // allDupedDates = [
  //   new Date('2023-03-30'+'T00:00:00+05:30'),
  //   new Date('2023-03-29'+'T00:00:00+05:30'),
  //   new Date('2023-04-21'+'T00:00:00+05:30'),
  //   new Date('2023-04-23'+'T00:00:00+05:30'),
  // ];
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr"


  // rnw: boolean = false;
  // upd: boolean = false;
  ngOnInit(): void {
    this.updatepaymentsts();
    this.paymentinfo = this.payment;
    this.paymentinfos = this.record;
    this.routeid.queryParams.subscribe(params => {
      this.pymtres = params['res'];
      this.pymttrkno = params['trkno'];
      this.appdtpk = params['at'];
      this.propk = params['p'];
      this.apptype = params['t'];
      
      if(this.pymtres){
        this.disableSubmitButton = true;
      }
    });

    this.showPage();
    
    this.transfer();
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

      // check payment status starts
        // this.appservice.getOnlinePaymentStatus(this.paymentinfo).subscribe(data => {
        //   this.paymentDetails = data.data;
        // })
      // check payment status ends
  });

  

  this.langkey = (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar')? 'ar': 'en';
  this.drvInputed = {
    fileMstPk: 7,
    selectedFilesPk: []
  };  
  this.designclass()
   this.renewalUpadte()
   this.findregistertype()
  }

  updatepaymentsts(){
    this.routeid.queryParams.subscribe(params => {
      this.pymtres = params['res'];
      this.pymttrkno = params['trkno'];
      this.appdtpk = params['at'];
      this.propk = params['p'];
      this.apptype = params['t'];
      
      if(this.pymtres){
        this.appservice.saveonlinepayment(this.pymtres,this.pymttrkno,this.appdtpk,this.propk,this.apptype).subscribe(res => {
          if(res.data.status == 200){
            this.proofdoc = res.data.proofdoc;
            this.filetype = res.data.filetype;
            this.appservice.getpaymentinfo(res.data.data.apppdt_applicationdtlstmp_fk,1).subscribe(res => {
              if(res.status == 200){   
                this.paymentinfo =res.data.payment; 
                this.paymentinfos=res.data.record; 
                this.showPage(); 
                this.payTemplate = 'staus_payment';
                this.disableSubmitButton = false;  
              }
            });
          }
        });
      }
    });
  }

  navigateTo() {
    throw new Error('Method not implemented.');
  }

  addEvent(field,event){
    console.log(event)
    this.transferForm.controls[field].setValue(moment(event.value).format('YYYY-MM-DD').toString());
  }  
  showPage(){
    if(this.paymentinfo?.appdt_projectmst_fk!=1){
      this.checkProject();
    }
    this.disableSubmitButton = true;
    this.appstatus = this.paymentinfo?.appdt_status;
    const statusarr: any[] = ['10', '11', '12', '13', '14', '15', '16'];    
    if(this.paymentinfo?.appdt_status == 5 || this.paymentinfo?.appdt_status == 18){
      this.payTemplate = 'typeofpayment';
      this.selectTypepayment = 'typeofPay';
      this.disableSubmitButton = false;
    }else if(this.paymentinfo?.appdt_status == 6){  
      this.paybtn = false;
      this.proofdoc = this.paymentinfo?.proofdoc;
      this.filetype = this.paymentinfo?.filetype;    
      this.payTemplate = 'staus_payment';
      this.disableSubmitButton = false
      // document.querySelector('.breadcrumb-item.active').innerHTML = 'Course';
      //this.selectTypepayment = 'staus_payment' 
    }else if(this.paymentinfo?.appdt_status == 7){
      this.paybtn = false;
      this.payTemplate = 'typeofpayment';
      this.selectTypepayment = 'siteAudit';
      this.disableSubmitButton = false
    }else if(this.paymentinfo?.appdt_status == 8){
      this.paybtn = false;
      this.payTemplate = 'typeofpayment';
      this.selectTypepayment = 'siteAudit';
      this.appservice.getavailabledate(this.paymentinfo?.appdt_projectmst_fk).subscribe(response => {
        this.disableSubmitButton = false
        if(response.status == 200){
          this.availabledatesarr = response?.data?.data;
          this.availabledatesarr.forEach((value, index)=>{
            const dateObj = moment(value.asd_date, 'YYYY-MM-DD').toDate();
            console.log(dateObj)
            this.allDupedDates.push(dateObj);
          });
          console.log(this.allDupedDates)
        }
     }); 
    }else if(this.paymentinfo?.appdt_status == 9){
      this.paybtn = false;
      this.payTemplate = 'typeofpayment';
      this.selectTypepayment = 'siteAudit';
      this.appservice.getsiteauditdate(this.paymentinfo?.apppdt_applicationdtlstmp_fk).subscribe(response => {
        this.disableSubmitButton = false
        if(response.data){
          this.auditdate = moment(response.data?.data?.asd_date).format('DD-MM-YYYY').toString();
          this.auditorname = response.data?.data?.oum_firstname;
          console.log('date infos', response.data?.data?.crosseddate);
          if (response.data?.data?.crosseddate == 1) {
            this.corssedorcompleted = true;
            this.crossedcontent = 'The Site Audit date crossed on';
            if(this.paymentinfo?.appdt_projectmst_fk==1){
              this.projname = 'Training Evaluation Centre Certification';
            }else if(this.paymentinfo?.appdt_projectmst_fk==4) {
              this.projname = 'Technical Evaluation Centre Certification';
            }
            else{
              this.projname = (this.langkey=='en')? this.courseinfo?.pm_projectname_en: (this.courseinfo?.pm_projectname_ar? this.courseinfo?.pm_projectname_ar: this.courseinfo?.pm_projectname_en);
            }
          }
        }
      });
    }else if(statusarr.includes(this.paymentinfo?.appdt_status)){
      this.paybtn = false;
      this.payTemplate = 'typeofpayment';
      this.selectTypepayment = 'siteAudit';
      this.corssedorcompleted = true;
      this.appservice.getsiteauditdate(this.paymentinfo?.apppdt_applicationdtlstmp_fk).subscribe(response => {
        this.disableSubmitButton = false
        if(response.data){
          this.auditdate = moment(response.data?.data?.asd_date).format('DD-MM-YYYY').toString();
          this.auditorname = response.data?.data?.oum_firstname; 
          this.crossedcontent = 'The Site Audit was completed on';     
          if(this.paymentinfo?.appdt_projectmst_fk==1){
            this.projname = 'Training Evaluation Centre Certification';
          }else if(this.paymentinfo?.appdt_projectmst_fk==4) {
            this.projname = 'Technical Evaluation Centre Certification';
          }else{
            this.projname = (this.langkey=='en')? this.courseinfo?.pm_projectname_en: (this.courseinfo?.pm_projectname_ar? this.courseinfo?.pm_projectname_ar: this.courseinfo?.pm_projectname_en);
          }
        }
      });
    }
  }
  public courseinfo: any=[];
  checkProject(){
    this.appservice.getprojectinfo(this.paymentinfo?.applicationdtlstmp_pk, this.paymentinfo?.appdt_projectmst_fk).subscribe(res => {
      console.log('online result', res);
     if(res.data){
      this.courseinfo = res.data.data;
     }  
    });
  }
  cancelSiteAudit(){
    this.requestForm.reset();
  }
  saveSiteAudit(){
    if(this.requestForm.controls['request_date'].value){
      this.disableSubmitButton = true;
      this.auditdate = moment(this.requestForm.controls['request_date'].value).format('DD-MM-YYYY').toString();
      this.requestForm.controls['request_date'].setValue(moment(this.requestForm.controls['request_date'].value).format('YYYY-MM-DD').toString());
      this.appservice.savesiteauditdate(this.requestForm.value, this.paymentinfo?.applicationdtlstmp_pk, this.paymentinfo?.appdt_projectmst_fk).subscribe(response => {
        if(response.data?.data?.status){          
          this.auditorname = response.data?.data?.siteauditor;         
          this.appstatus = response.data?.data?.appdt_status;         
        }else{
          console.log('Audit date is occupied',response.data?.data);          
          swal({
            title: this.i18n('payment.site'),
            text: this.i18n('payment.unfor'),
            icon: "warning",
            buttons: [false, this.i18n('payment.ok')],
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false,
            closeOnEsc: false
          });
        }
        this.disableSubmitButton = false;
     }); 
    }
  }
  makepayment(data){    
    console.log(data)
  }

  paymentpage() {
      this.payTemplate = 'typeofpayment';
      this.selectTypepayment = 'typeofPay';
      this.paybtn = true;
      let domn ='';
      if(this.paymentinfo.appdt_projectmst_fk == '1'){
        domn ='trainingcentremanagement/maincentre';
      }else if(this.paymentinfo.appdt_projectmst_fk == '2' || this.paymentinfo.appdt_projectmst_fk == '3'){
        domn ='standardcourse/home';
      }
      this.myRoute.navigate([domn],
      { queryParams: { p: this.secuirty.encrypt(this.paymentinfo.appdt_projectmst_fk), t: this.secuirty.encrypt(this.paymentinfo.appdt_apptype), s: this.secuirty.encrypt(this.paymentinfo.appdt_status), at: this.secuirty.encrypt(this.paymentinfo.applicationdtlstmp_pk), bc: 'spym', f: 'sc' } });
  }


  proceedtopay(){
    this.disableSubmitButton = true;
    this.appservice.payonline(this.transferForm.value,this.paymentinfo).subscribe(res => {
     if(res.data.status == 1){
      var mapForm = document.createElement("form");
      mapForm.method = "POST"; // or "GET" if appropriate
      mapForm.action = res.data.url;
      
      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "resourcePath";
      mapInput.setAttribute("value", res.data.data.resourcePath);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "keystorePath";
      mapInput.setAttribute("value", res.data.data.keystorePath);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "aliasName";
      mapInput.setAttribute("value", res.data.data.aliasName);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "action";
      mapInput.setAttribute("value", res.data.data.action);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "currency";
      mapInput.setAttribute("value", res.data.data.currency);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "language";
      mapInput.setAttribute("value", res.data.data.language);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "receiptURL";
      mapInput.setAttribute("value", res.data.data.receiptURL);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "errorURL";
      mapInput.setAttribute("value", res.data.data.errorURL);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "tokenFlag";
      mapInput.setAttribute("value", res.data.data.tokenFlag);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "paymenttoken";
      mapInput.setAttribute("value", res.data.data.paymenttoken);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "payment_url";
      mapInput.setAttribute("value", res.data.data.payment_url);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "trackId";
      mapInput.setAttribute("value", res.data.data.trackId);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "amount";
      mapInput.setAttribute("value", this.paymentinfos.total);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "apppymtdtlstmp_pk";
      mapInput.setAttribute("value", res.data.data.apppymtdtlstmp_pk);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "appdt_projectmst_fk";
      mapInput.setAttribute("value", res.data.data.appdt_projectmst_fk);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "appdt_apptype";
      mapInput.setAttribute("value", res.data.data.appdt_apptype);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "appdt_status";
      mapInput.setAttribute("value", res.data.data.appdt_status);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      var mapInput = document.createElement("input");
      mapInput.type = "hidden";
      mapInput.name = "env_type";
      mapInput.setAttribute("value", res.data.data.env_type);
      mapForm.appendChild(mapInput);
      document.body.appendChild(mapForm);

      mapForm.submit();
      //window.open(res.data.payurl,"_self");
     }   
    });

    
    
  }

  
  paylater(){
    this.disableSubmitButton = true;
    console.log("this.paymentinfo",this.paymentinfo)
    if(this.paymentinfo.appdt_projectmst_fk == '2' || this.paymentinfo.appdt_projectmst_fk == '3'){
      this.myRoute.navigate(['standardcourse/home']);
    }else if(this.paymentinfo.appdt_projectmst_fk == '1' || this.paymentinfo.appdt_projectmst_fk == '4'){
      if(this.paymentinfo.appiit_officetype == '1'){
        this.myRoute.navigate(['admin/login']);
      } else if(this.paymentinfo.appiit_officetype == '2') {
        this.myRoute.navigate(['trainingcentremanagement/branchcentre?rt=no']);
      }
      
    }
     
  }

  transfer() {
    this.transferForm = this.formBuilder.group({ 
      choose_type: ['', Validators.required],
      paydate: ['', Validators.required],
      bankname: ['', Validators.required],
      cheque: ['', null],
      transaction: ['', null],
      document_upload:['',Validators.required]
    }),
    this.requestForm = this.formBuilder.group({ 
      request_date: [''],
    })
  }
  get tran() { return this.transferForm.controls; }
 
  paymentmode(event){
    this.displaypaymode = event.value;
    if(this.displaypaymode==3){
      this.transferForm.controls['cheque'].setValue('');
      this.transferForm.controls['transaction'].setValue('');
      this.transferForm.controls['cheque'].setValidators(null);
      this.transferForm.controls['cheque'].updateValueAndValidity();
      this.transferForm.controls['transaction'].setValidators(null);
      this.transferForm.controls['transaction'].updateValueAndValidity();
    }
  }
  
  savepayment(){
    if(this.transferForm.valid){
      this.disableBtn = true;
      this.disableSubmitButton = true;
      this.transferForm.controls['paydate'].setValue(moment(this.transferForm.controls['paydate'].value).format('YYYY-MM-DD').toString());
      this.appservice.savepayment(this.transferForm.value,this.paymentinfo).subscribe(res => {        
        if(res.data.status == 200){
          this.proofdoc = res.data.proofdoc;
          this.filetype = res.data.filetype;
          this.appservice.getpaymentinfo(this.paymentinfo?.apppdt_applicationdtlstmp_fk,1).subscribe(res => {
            if(res.status == 200){   
              this.paymentinfo =res.data.payment; 
              this.paymentinfos=res.data.record;     
            }
          });
          this.transferForm.reset();
          this.payTemplate = 'staus_payment';
        }   
        this.disableBtn = false;
        this.disableSubmitButton = false;
      });
    }
  }
  offlinereset(){
    swal({
      title: this.i18n('payment.pffline'),
      text:  this.i18n('maincenter.doyouwantnote'),
      icon: 'warning',
      buttons: [this.i18n('payment.no'), this.i18n('payment.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((cancelPayment) => {
      if(cancelPayment) {
        this.transferForm.reset();
        this.drvInputed.selectedFilesPk = [];//actvlicenseUpload
        setTimeout(()=> { if(this.pymtproofFilee) this.pymtproofFilee.triggerChange() },500);
      }
    });    
  }

  fileeSelected(fileid,fileData){  
    this.transferForm.controls['document_upload'].setValue(fileid);
  }
   tabClickFunctions = [
    () =>  this.paybtn = true,
    () =>  this.paybtn = false,
   ]

  // ];
  onTabSelect(event: any) {
    const index = event.index;
    this.tabClickFunctions[index]();
  }
  designclass(){
    if(this.paymentinfo?.appdt_projectmst_fk==1){ 
     this.classadd = true;
    }
    else{ 
      this.classadd = false;
    }
  }
 
  renewalUpadte(){
    this.routeid.queryParams.subscribe(params => {
      this.paymenttypes = params['nwrn'];
      this.projectType = this.security.decrypt(params.p);
    });
  }
  findregistertype() {
    if(this.paymenttypes == 'rnj'){
      this.renewalpaymentfine = true;
      this.updatepayment = false;
   }else if(this.paymenttypes == 'upd') {
    this.renewalpaymentfine = false;
    this.updatepayment = true;
   }else {
    this.renewalpaymentfine = false;
    this.updatepayment = false;
   }
  }
}