import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute, ParamMap, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { Encrypt } from '@app/common/class/encrypt';
import { IvmsdeviceService } from '@app/services/ivmsdev.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import swal from 'sweetalert';

@Component({
  selector: 'app-viewandapprove',
  templateUrl: './viewandapprove.component.html',
  styleUrls: ['./viewandapprove.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewandapproveComponent implements OnInit {
  
  public ifarbic: boolean = false;
  public loader: boolean = false;
  public InspectionTemplate = 'Offline';
  public view: boolean = false;
  approved: boolean;
  public stktype: any;
  devicePk: string;
  viewdtls: any;
  inspcData: any;
  canValidate: boolean;
  userPk: any;
  isfocalpoint: any;
  decline: boolean;
  onlinechklistresponse: any;
i18n(key) {
    return this.translate.instant(key);
  }
  status: any;

  constructor( private translate: TranslateService,public toastr: ToastrService,private activatedRoute: ActivatedRoute, private router : Router,
     private remoteService: RemoteService, private activeRoute: ActivatedRoute, private security: Encrypt, private ivmsService: IvmsdeviceService,
     private cookieService: CookieService,private localstorage: AppLocalStorageServices,
     ) { }

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
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.userPk = this.localstorage.getInLocal('userPk');
    this.loader = true;
      this.getType();
     
      this.activeRoute.paramMap.subscribe((params: ParamMap) => {
        // if (!this.createaccess && this.isfocalpoint == 2) {
        //   this.Vehiclelist();
        // }
        let pk = params.get('dev_id');
        this.devicePk = this.security.decrypt(pk);
        
        this.getViewDetails();
       setTimeout(() => {
        this.getInspectionDetails();
       },2000);
        
      })

  }
  
  Vehiclelist() {
    if (this.stktype == 2) {
      this.router.navigate(['manageivms/ivmscentrelist']);
    }
    else{
      this.router.navigate(['/manageivms/ivmslist']);
    }
    
  }

  getType() {
    if(this.activeRoute.snapshot.url[0].path == 'viewapprove') {
       this.view = true;
    } else {
      this.view = false;
    }
    localStorage.removeItem('typeView')
  }

  getViewDetails()
  {
    
    let encPk = this.security.encrypt(this.devicePk);
    
    this.ivmsService.getIVMSVehicleDtlsByPk(encPk).subscribe(response => {
      this.viewdtls = response.data;
 
      console.log(this.viewdtls)
     })
  }

  getInspectionDetails()
   {
    if(this.devicePk)
    {
      let encPk = this.security.encrypt(this.devicePk);
      this.loader = true;
      this.ivmsService.getInstallationDtls(encPk).subscribe(res => {
        if(res.data.status == 1)
        {
            this.inspcData = res.data.data ;
            if(this.inspcData.ivrd_Installername == this.userPk)
            {
              this.canValidate = false;
            }
            else
            {
              this.canValidate = true;
            }
            this.ChkInspType(this.inspcData.inspType);
            this.status = this.inspcData.ivrd_installationstatus;
           
            
            if(this.status == 1 )
            {
              this.inspcData = null;
            }
            if(this.inspcData.checklist)
            {
              this.onlinechklistresponse = this.inspcData.checklist;
              console.log(this.onlinechklistresponse)
            }
            else
            {
              this.onlinechklistresponse = [];
            }
            this.decline = false;
            this.approved = false;
            if(this.status == 3)
            {
              this.approved = true;
              this.decline = false;
            }
            if(this.status == 7)
            {
              
              this.decline = true;
              this.approved = false;
            }
            this.loader = false;
        }
        else
        {
          this.loader = false;
         this.inspcData = null;
        //  swal({
        //    title: this.i18n('Unable To Fetch the Ispection details'),
        //    icon: 'warning',
        //    className: this.dir =='ltr'?'swalEng':'swalAr',
        //    closeOnClickOutside: false
        //  })
        }
        });
    }
     
   }

   ChkInspType(value)
   {
      
     if(value == 1)
     {
       this.InspectionTemplate = 'Online';
     }
     else{
       this.InspectionTemplate = 'Offline';
     }
     this.loader = false;
     
     
   }

   declinesubmit(value)
   {
    this.loader = true;
      let data = {
        'vehicleregpk' : this.security.encrypt(this.devicePk),
        'validationStatus' : (value.status == 3 ? 1 : 2),
        'validationComments' : value.comments,
        'status':this.status,
      }
      this.ivmsService.declineSubmit(data).subscribe(res => {
         if(res.data.status == 1)
         {
          this.toastr.success(this.i18n('The Vehicle Form has been moved to the Installer.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.Vehiclelist();
         }
         else
         {
          swal({
            title: this.i18n('This Vehicle Registration Form was verified/declined already.'),
            icon: 'warning',
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
          this.Vehiclelist();
         }
         this.loader = false;
      });
   }

   Approvalsubmit(value)
   {
    this.loader = true;
    let encPk = this.security.encrypt(this.devicePk);
    let data = {
      'vehicleregpk' : encPk,
      'supervisorStatus' : (value.status == 3 ? 1 : 2),
      'supervisorComments' : value.comments,
    }
      this.ivmsService.IssueCertificate(data).subscribe(res => {
         if(res.data.status == 1)
         {
          this.toastr.success(this.i18n('This IVMS Certificate has been Issued Successfully.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.Vehiclelist();
         }
         else if(res.data.status == 3)
         {
          swal({
            title: this.i18n("Centre Logo is not available to generate the IVMS Certificate. Kindly inform your Centre's Focal Point to upload Logo."),
            icon: 'warning',
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          });
         }
         else
         {
          swal({
            title: this.i18n('The Vehicle Registration form has already been Verified (Approved or Decline).'),
            icon: 'warning',
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
         }
         this.loader = false;
      });
   }

}


