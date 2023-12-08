import { Component, ElementRef, Inject, Input, OnInit, ViewChild, ViewEncapsulation, AfterViewInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { CookieService } from 'ngx-cookie-service';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { Datadialog } from '@app/modules/registration/supplierreg/supplierreg.component';
import { Encrypt } from '@app/common/class/encrypt';
@Component({
  selector: 'app-paymentcentre',
  templateUrl: './paymentcentre.component.html',
  styleUrls: ['./paymentcentre.component.scss']
})
export class PaymentcentreComponent implements OnInit, AfterViewInit{
  i18n(key) {
    return this.translate.instant(key);
  }
  @Input('paybtn') paybtn: boolean = true;
  @Input('paymentdtls') paymentdtls: any=[];
  @Input('courseinfo') courseinfo: any=[];
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  public langkey: any='en';
  public frompage: any='mc';
  constructor(private translate: TranslateService,
    public dialog: MatDialog,
    private remoteService: RemoteService,
    private cookieService: CookieService,private route: Router,public routeid: ActivatedRoute , private security: Encrypt) { }
    @Input() dataFromParent: any;
  projectType: any;

  ngOnInit(): void {
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
    this.langkey = (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar')? 'ar': 'en';
    
  }
  ngAfterViewInit(){
    this.routeid.queryParams.subscribe(params => {  
      this.frompage = params['f'];
      this.projectType = this.security.decrypt(params.p);
      // alert(this.projectType)
    });
  }
  viewcertform(){
    this.route.navigate(['/trainingcentremanagement/maincentre'] ,{ queryParams: { renew: this.security.encrypt(3) }});

    if(this.projectType == 1) {
      this.route.navigate(['/trainingcentremanagement/maincentrepay'] ,{ queryParams: {p:this.security.encrypt(1), renew: this.security.encrypt(3) }});
    } else {
      this.route.navigate(['/vehiclemanagement/rascentrepay'] ,{ queryParams: { p:this.security.encrypt(4),renew: this.security.encrypt(3) }});
    }
    // this.route.navigate(['/trainingcentremanagement/maincentrepay'] ,{ queryParams: { renew: this.security.encrypt(3) }});
    //this.route.navigate(['/trainingcentremanagement/maincentre'],{ queryParams: { bc: 'tcm' , renew: this.security.encrypt(3)}});
    //location.reload();
  }
  viewcertformbc(){
    this.route.navigate(['/trainingcentremanagement/branchcentre'],{ queryParams: { bc: 'tcm' , renew: this.security.encrypt(3) }});

    if(this.projectType == 1) {
      this.route.navigate(['/trainingcentremanagement/branchcentrepay'],{ queryParams: {p:this.security.encrypt(1), bc: 'tcm' , renew: this.security.encrypt(3) }});
    } else {
      this.route.navigate(['/vehiclemanagement/rasbranchcentrepay'],{ queryParams: {p:this.security.encrypt(4), bc: 'tcm' , renew: this.security.encrypt(3) }});
    }
    // this.route.navigate(['/trainingcentremanagement/branchcentrepay'],{ queryParams: { bc: 'tcm' , renew: this.security.encrypt(3) }});
    //location.reload();
  }
  viewcourseform(){
    this.route.navigate(['/standardcourse/home'],{ queryParams: { bc: 'stpym' }});
    //location.reload();
  }
  opendialogquicksetup() {
    console.log(233453456)
    const dialogRef = this.dialog.open(Modalpayment, {
      disableClose: true,
      panelClass: 'quicksetuplistpayment',
    });
    //dialogRef.componentInstance.drawer = this.drawercontactus;
    dialogRef.afterClosed().subscribe((result) => {

    });
    this.renewalUpadte()
  }
  renewalUpadte(){
    this.routeid.queryParams.subscribe(params => {
      this.projectType = params['p']
        alert(this.projectType)
    });
  }
}

@Component({
  selector: 'modalpayment',
  templateUrl: './modalpayment.html',
  styleUrls: ['./modalpayment.scss'],
  encapsulation: ViewEncapsulation.None,
})



export class Modalpayment {

  constructor(
    private translate: TranslateService,
    private cookieService: CookieService,
    public dialogRef: MatDialogRef<Modalpayment>,
    private remoteService: RemoteService,
    private el: ElementRef,
    @Inject(MAT_DIALOG_DATA) public data: Datadialog
  ) {
  }
  dir = 'ltr';
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
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
   
  }

 


  @ViewChild('scroll', { read: ElementRef }) public scroll: ElementRef<any>;
  closedialog(): void {
    this.dialogRef.close();
  }

}