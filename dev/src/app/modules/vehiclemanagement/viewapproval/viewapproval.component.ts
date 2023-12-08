import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import moment from 'moment';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { ServiceVehiclemanagementService } from '../service-vehiclemanagement.service';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Location } from '@angular/common';

@Component({
  selector: 'app-viewapproval',
  templateUrl: './viewapproval.component.html',
  styleUrls: ['./viewapproval.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewapprovalComponent implements OnInit {
  public approved: boolean = true;
  pk: any;
  viewdata: any;
  ifarbic: boolean = false;
  loader: boolean = false;
  vehiclepk: any;
  inspcData: any;
  roles: any;
  isSupervisor: boolean = false;
  isVerifier: boolean = false;
  status: any;
  canValidate: boolean = false;
  InspectionTemplate: string = "Offline";
  onlinechklistresponse: any[];
  userPk: any;
  isfocalpoint: any;
  useraccess: any;
  stktype: any;
  approvalaccess: boolean;
  readaccess: boolean;
  adminreadaccess: boolean;
  i18n(key) {
    return this.translate.instant(key);
  }
  
  constructor( public toastr: ToastrService,private activatedRoute: ActivatedRoute, private router : Router,private _location:Location,
    private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService, private remoteService: RemoteService, private cookieService: CookieService,
    private rasservice: ServiceVehiclemanagementService,private localstorage:AppLocalStorageServices,) { }
    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr'; 
    @Input() parampage: any;
    public ViewinspectStatus: boolean;
  ngOnInit(): void {
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.userPk = this.localstorage.getInLocal('userPk');
    this.roles = this.localstorage.getInLocal('role');
    if(this.isfocalpoint == 2)
     {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      this.SetUseraccess();
     }
    if(this.isfocalpoint == 2)
    {
      if(this.roles.includes(17))
      {
        this.isVerifier = true;
      }
      if(this.roles.includes(18))
      {
        this.isSupervisor = true;
      }

    }
    
    this.activatedRoute.queryParams.subscribe(params => { 
      console.log('****************************')
      console.log(params)
      this.pk = params.p
      this.status = params.sts;
     
      if(this.pk)
      {
        this.loader = true;
        this.rasservice.getrasgridviewdata( this.pk ).subscribe(res => {
          this.viewdata = res.data.viewdata;
          this.vehiclepk = res.data.viewdata.rasvehicleregdtls_pk;
          this.loader = false;
        });
      }
      else{
        this.Vehiclelist();
      }
      
     
    });
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
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }

    });
    this.hideShow();
    this. shoWHideview()
  }
   hideShow() {
    this.activatedRoute.queryParams
    .subscribe(params => {
      this.parampage = params.bc
    })
   }

   shoWHideview() {
    if(this.parampage == 'spym') {
       this.ViewinspectStatus = true;
       if(!this.readaccess &&  !this.adminreadaccess  && this.isfocalpoint == 2)
      {
        this.Vehiclelist();
      }

    }else {
      if(!this.approvalaccess && this.isfocalpoint == 2)
      {
        this.Vehiclelist();
      }
      this.ViewinspectStatus = false; 
      if((this.status == 2 && this.isVerifier) || (this.status == 4 && this.isSupervisor))
      {
        
        this.canValidate = true;
      }
      else
      {
        this.canValidate = false;
      }
    }
    
     
    this.loader = true;
      this.getInspectionDetails();
   }

   getInspectionDetails()
   {
    if(this.pk)
    {
      this.rasservice.getInspectionDtls(this.pk).subscribe(res => {
        if(res.data.status == 1)
        {
            this.inspcData = res.data.data ;
            if(this.inspcData.rvrd_inspectorname == this.userPk)
            {
              this.canValidate = false;
            }
            else
            {
              this.canValidate = true;
            }
            this.ChkInspType(this.inspcData.inspType);
            this.status = this.inspcData.rvrd_inspectionstatus;
            
            if(this.status == 1 )
            {
              this.inspcData = null;
            }
            if(this.inspcData.checklist)
            {
              this.onlinechklistresponse = this.inspcData.checklist;
              console.log(this.onlinechklistresponse[0])
            }
            else
            {
              this.onlinechklistresponse = [];
            }
            if(this.status == 4 || this.status == 3)
            {
              
              this.approved = true;
            }
            else{
             
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

   moveToSupervisor(value)
   {
    this.loader = true;
      let data = {
        'vehicleregpk' : this.pk,
        'verifierStatus' : (value.status == 3 ? 1 : 2),
        'verifierComments' : value.comments,
      }
      this.rasservice.moveToSupervisor(data).subscribe(res => {
         if(res.data.status == 1)
         {
          this.toastr.success(this.i18n('This Vehicle Form has been moved to the Supervisor.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.Vehiclelist();
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

   Vehiclelist() {
    if (localStorage.getItem("schedule") == '1') {
      localStorage.removeItem('schedule')
      this._location.back();
    }
    if(this.stktype == 1)
    {
      this.router.navigate(['/vehiclemanagement/list']);
    }
    this.router.navigate(['/vehiclemanagement/vehiclelisting']);
  }

   IssueSticker(value)
   {
     this.loader = true;
     console.log(value);
      let data = {
        'vehicleregpk' : this.pk,
        'supervisorStatus' : (value.status == 3 ? 1 : 2),
        'supervisorComments' : value.comments,
      }
      this.rasservice.IssueSticker(data).subscribe(res => {
        if(res.data.status == 1)
         {
          this.loader = false;
          this.toastr.success(this.i18n('The Sticker has been Issued for the Vehicle.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.Vehiclelist();
         }
         else
         {
          this.loader = false;
          swal({
            title: this.i18n('The Vehicle Registration form has already been Verified (Approved or Decline).'),
            icon: 'warning',
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          })
          this.Vehiclelist();
         }
      });
   }

   moveToInspector(value)
   {
    this.loader = true;
      let data = {
        'vehicleregpk' : this.pk,
        'validationStatus' : (value.status == 3 ? 1 : 2),
        'validationComments' : value.comments,
        'status':this.status,
      }
      this.rasservice.moveToInspector(data).subscribe(res => {
         if(res.data.status == 1)
         {
          this.toastr.success(this.i18n('The Vehicle Form has been moved to the Inspector.'), ''), {
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
  SetUseraccess()
  {
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Vehicle Inspection and Approval');
    if(this.useraccess[moduleid] && this.useraccess[moduleid][27]  && this.useraccess[moduleid][27].approval == 'Y'){
      this.approvalaccess = true;
    }
    if(this.useraccess[moduleid] && this.useraccess[moduleid][27] && this.useraccess[moduleid][27].read == 'Y'){
      this.readaccess = true;
    }
    let moduleidadmin = this.localstorage.getaccessmoduleid(this.stktype, 'RAS Vehicle Management');
   
    if(this.useraccess[moduleidadmin] && this.useraccess[moduleidadmin][30] &&  this.useraccess[moduleidadmin][30].read == 'Y'){
      this.adminreadaccess = true;
    }
    
  }
   
} 
