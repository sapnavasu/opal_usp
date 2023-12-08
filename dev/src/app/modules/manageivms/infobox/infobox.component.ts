import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Encrypt } from '@app/common/class/encrypt';
import { IvmsdeviceService } from '@app/services/ivmsdev.service';
import { Router } from '@angular/router';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import swal from 'sweetalert';
import { environment } from '@env/environment';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-infobox',
  templateUrl: './infobox.component.html',
  styleUrls: ['./infobox.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class InfoboxComponent implements OnInit {

  @Input("devicePk") devicePk : any;
  @Input("page") pagetype : any;
  
  public ifarbic: boolean = false;
  public loader: boolean = false;

  viewdata: any;
  fullPageLoaders: boolean;
  isfocalpoint: any;
  roles: any;
  userPk: any;
  stktype: any;
  isInstaller: boolean;
  isSeniorTech: boolean;
  useraccess: any;
  approvalaccess: boolean;
  readaccess: boolean;
  createaccess: boolean;
  updateaccess: boolean;
  printcertificateaccess: boolean;
  viewcertificateaccess: boolean;
  admincreateaccess: boolean;
  adminreadaccess: boolean;
  adminupdateaccess: boolean;
  admindownloadaccess: boolean;
  url: string;
  version: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  constructor( private translate: TranslateService,
     private remoteService: RemoteService,
     private security: Encrypt, private ivmsService: IvmsdeviceService, private toastr: ToastrService,
     private cookieService: CookieService,private localstorage:AppLocalStorageServices,private router:Router) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;

    }
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }

    });
   
    this.url = environment.baseUrl;
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.roles = this.localstorage.getInLocal('role');
    this.userPk = this.localstorage.getInLocal('userPk');
    this.stktype = this.localstorage.getInLocal('stktype');
    console.log(this.roles);
    if(this.isfocalpoint == 2)
     {
      console.log(this.roles);
      if(this.roles.includes(20))
      {
        this.isInstaller = true;
      }
      if(this.roles.includes(19))
      {
        this.isSeniorTech = true;
      }
      
     }
     if(this.isfocalpoint == 2)
     {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      console.log(this.useraccess);
      this.SetUseraccess();
     }

    this.getIVMSVehicleInformation();

  }

  getIVMSVehicleInformation()
  {
    this.fullPageLoaders = true;
    let encPk = this.security.encrypt(this.devicePk);
    this.ivmsService.getIVMSVehicleDtlsByPk(encPk).subscribe(response => {
     this.viewdata = response.data;
     this.fullPageLoaders = false;

     console.log(this.viewdata)
    })
  }

  printorviewcertificate(element,type)
  {
    let encpk = this.security.encrypt(element.devicePk);
    this.fullPageLoaders = true;
    this.ivmsService.printorviewcertificate(encpk,type).subscribe(res => {
      this.fullPageLoaders = false;
    });
  }

  SetUseraccess()
  {
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'IVMS Device Installation and Approval');
    
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].approval == 'Y'){
      this.approvalaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].read == 'Y'){
      this.readaccess = true;
    }
    
    if(this.useraccess[moduleid] && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].create == 'Y'){
      this.createaccess = true;
     
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][36] && this.useraccess[moduleid][36].update == 'Y'){
      this.updateaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][37] && this.useraccess[moduleid][37].create == 'Y'){
      this.printcertificateaccess = true;
    }
    if(this.useraccess[moduleid]  && this.useraccess[moduleid][37] && this.useraccess[moduleid][37].read == 'Y'){
      this.viewcertificateaccess = true;
    }
    
    let moduleidadmin = this.localstorage.getaccessmoduleid(this.stktype, 'Manage IVMS Device Installed Vehicles');
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31]  && this.useraccess[moduleidadmin][31].create == 'Y'){
      this.admincreateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31] && this.useraccess[moduleidadmin][31].read == 'Y'){
      this.adminreadaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31] && this.useraccess[moduleidadmin][31].update == 'Y'){
      this.adminupdateaccess = true;
    }
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][31] && this.useraccess[moduleidadmin][31].download == 'Y'){
      this.admindownloadaccess = true;
    }

    
    
    if(!this.adminreadaccess && !this.readaccess && this.isfocalpoint==2)
     {
       if(this.stktype == 1)
       {
         this.router.navigate(['/dashboard/portaladmin'])
       }
       else
       {
        this.router.navigate(['/dashboard/centre'])
       }
     }
    
  }
  generatesticker(element)
  {
    this.version = this.version +1;
    let encpk = this.security.encrypt(element.devicePk);
    this.fullPageLoaders = true;
    swal({
      title: this.i18n("Do you want to Re-Generate the IVMS Certificate ?"),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.ivmsService.ivmscertificate(encpk,1).subscribe(res => {
      
          if(res.data.status == 1)
          {
            this.toastr.success(this.i18n('The IVMS Certificate is Re-Generated'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            this.Vehiclelist();
          }
          else if(res.data.status == 3)
         {
          swal({
            title: this.i18n("Centre Logo is not available to generate the IVMS Certificate. Kindly inform the Centre's Focal Point to upload Logo."),
            icon: 'warning',
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          });
         }
          else
          {
            swal({
              title: this.i18n('There was a problem while generating Certificate.'),
              icon: 'warning',
              className: this.dir =='ltr'?'swalEng':'swalAr',
              closeOnClickOutside: false
            })
          }
        });
        
      } else {
        this.fullPageLoaders = false;
      }
    });
    
    
  }

  getRemovedivicecondition(data)
  {
    if((data.installation_status == 7 || data.installation_status == 3) && data.applicant_type == 1 )
    {
      return true;
    }
    if((data.installation_status == 7 || data.installation_status == 3 || data.installation_status == 2) && (data.applicant_type == 3 || data.applicant_type ==2) )
    {
      return true;
    }
    else{
      return false;
    }
  }

  editdevicedetails(data)
  {
    let encregpk = this.security.encrypt(data.devicePk);
    this.router.navigate(['/manageivms/editivmsvehicle/'+encregpk]);
  }

  installationreport(event,data) {
    let encregpk = this.security.encrypt(data.devicePk);
    if(event == 'upload') {
      this.router.navigate(['/manageivms/uploadreports/'+encregpk]);
    } else {
      this.router.navigate(['/manageivms/updatereports/'+encregpk]);
    }
  }

  schedule(element) {
    let encregpk = this.security.encrypt(element.devicePk);
    this.router.navigate(['/manageivms/sheducledevice/'+encregpk]);
    localStorage.setItem('schedule', 'scheduledevice')
  }

  viewandapprove(dataType,data) {
    let encregpk = this.security.encrypt(data.devicePk);
    if(dataType == 'View') {
      localStorage.setItem('typeView', dataType)
      this.router.navigate(['/manageivms/viewapprove/'+encregpk]);
    }
    else{
      localStorage.setItem('typeView', dataType)
      this.router.navigate(['/manageivms/viewandapproved/'+encregpk]);
    }
    
  }

  renew(element) {
    let encregpk = this.security.encrypt(element.devicePk);
    this.router.navigate(['/manageivms/ivmsrenewnow/'+encregpk]);
  }

  removedevice(element,type)
  {
    let encpk = this.security.encrypt(element.devicePk);
    this.loader = true;
    swal({
      title: this.i18n('Do you want to update the status as "Cancel (Removed Device)"?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.ivmsService.removedevice(encpk).subscribe(res => {
          this.loader = false;
          if(res.data.status == 1)
          {
            
            swal({
              title: this.i18n('The Vehicle Status is updated as "Cancel (Removed Device)".'),
              text: '',
              icon: 'warning',
              buttons: [this.i18n('No'), this.i18n('Yes')],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
            this.Vehiclelist();
          }
        });
      } else {
        this.loader = false
      }
    });
    
  }

  cancelregistration(data)
  {
    let encpk = this.security.encrypt(data.devicePk);
    this.loader = true;
    swal({
      title: this.i18n('Do you want to Cancel the Device Regidtration ?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.ivmsService.cancelRegistration(encpk).subscribe(res => {
          this.loader = false;
          if(res.data.status == 1)
          {
            this.Vehiclelist();
           
          }
        });
      }
      else {
        this.loader = false
      }
    });
  }

  Vehiclelist() {
    if (this.stktype == 1) {
      this.router.navigate(['/manageivms/ivmslist']);
    }
    else{
      this.router.navigate(['/manageivms/ivmscentrelist']);
    }
    
  }


}




