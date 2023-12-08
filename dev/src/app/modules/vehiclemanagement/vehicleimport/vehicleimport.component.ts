import { Component, ComponentFactoryResolver, OnInit, ViewEncapsulation, Injectable, ViewChild } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from 'ngx-toastr';
import { Router, ActivatedRoute } from '@angular/router';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import * as _moment from 'moment';
import { default as _rollupMoment } from 'moment';
import xlsxParser from 'node_modules/xlsx-parse-json';
import { ServiceVehiclemanagementService } from '../service-vehiclemanagement.service';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';



@Injectable({
  providedIn: 'root',
})

@Component({
  selector: 'app-vehicleimport',
  templateUrl: './vehicleimport.component.html',
  styleUrls: ['./vehicleimport.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
  ],
})


export class VehicleimportComponent implements OnInit {
  stktype: any;
  filtername: string;
  ifarabic: boolean;
  regpk: any;
  @ViewChild('excelFilee') excelFilee: Filee;
  public drv_doc_upload: DriveInput;
  file: any;
  data: any;
  PageLoaders: boolean;
  errors: any;
  displaycounts: boolean = false;
  @ViewChild('assesmentrepot') assesmentrepot: Filee;
  sampleurl: any;
  isfocalpoint: any;


  i18n(key) {
    return this.translate.instant(key);
  }


  SaveVehicleDtlsBtn: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    text: this.i18n('Submit'),
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };

  constructor(
    private _componentFactoryResolver: ComponentFactoryResolver,
    private fb: FormBuilder, public toastr: ToastrService, public router: Router,
    private translate: TranslateService, private remoteService: RemoteService, private cookieService: CookieService,
    public routeid: ActivatedRoute, private localstorage: AppLocalStorageServices, private rasservice: ServiceVehiclemanagementService,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();


  ngOnInit(): void {
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    console.log(this.stktype)
    if(this.stktype != 1 || this.isfocalpoint != 1)
    {
      this.router.navigate(['/admin/login']);
    }

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";

      } else {
        this.filtername = "إخفاء التصفية";

      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";

    }
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarabic = true
    }
    else {
      this.ifarabic = false;
    }
    this.PageLoaders = true;
    this.regpk = this.localstorage.getInLocal('registerPk');
    this.remoteService.getLanguageCookie().subscribe(data => {
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
          ;
        } else {
          this.filtername = "إخفاء التصفية";

        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarabic = true
      }
      else {
        this.ifarabic = false;
      }

    });

    this.initialise();

  }

  initialise() {
    this.drv_doc_upload = {
      fileMstPk: 20,
      selectedFilesPk: [], //Already inserted pksubmitCRdetails
    };

    this.rasservice.getsamplefileurl().subscribe((response) => {
      this.sampleurl = response.data.templateurl;
      this.PageLoaders = false;
    });

  }


  async fileeSelected(files, fileId) {
    this.file = files[0];
    this.PageLoaders = true;
    if(this.file)
    {
      this.rasservice.ExcelImportValidate(this.file).subscribe((response) => {
        this.PageLoaders = false;
  
        document.getElementById("totalrecords").innerHTML = response.data.total;
        document.getElementById("uploadsuccess").innerHTML = response.data.success;
        document.getElementById("uploadfailure").innerHTML = response.data.failed;
  
        this.errors = response.data.errorarray;
        if (this.errors) {
          this.exportToCSV();
          this.displaycounts = true;
        }
  
  
      });
    }
    
  }


  exportToCSV() {

    if (this.errors.length > 0) {
      console.log(this.errors[-1]);

      var csv = '<b>Error Message,Company Name,RAS Centre Name,Office Type,Branch Name,Vehicle Owner Name (English),CR Number,Vehicle Registration Number,Chassis No.,Vehicle Category,Road Type,Date of Inspection,Inspector Name,Date of Expiry,RASIC Number,Verification Code,Sticker Status,Created on<\b>\n';

      this.errors.forEach(function (error) {
        csv += "\"" + error.Over_all_Comments + "\",";
        csv += "\"" + error['Company Name'] + "\",";
        csv += "\"" + error['RAS Centre Name'] + "\",";
        csv += "\"" + error['Office Type'] + "\",";
        csv += "\"" + error['Branch Name'] + "\",";
        csv += "\"" + error['Vehicle Owner Name (English)'] + "\",";
        csv += "\"" + error['CR Number'] + "\",";
        csv += "\"" + error['Vehicle Registration Number'] + "\",";
        csv += "\"" + error['Chassis No.'] + "\",";
        csv += "\"" + error['Vehicle Category'] + "\",";
        csv += "\"" + error['Road Type'] + "\",";
        csv += "\"" + error['Date of Inspection'] + "\",";
        csv += "\"" + error['Inspector Name'] + "\",";
        csv += "\"" + error['Date of Expiry'] + "\",";
        csv += "\"" + error['RASIC Number'] + "\",";
        csv += "\"" + error['Verification Code'] + "\",";
        csv += "\"" + error['Sticker Status'] + "\",";
        csv += "\"" + error['Created on'] + "\",";
        csv += "\n";
      });


      var hiddenElement: any = document.createElement('a');
      let d = new Date();
      var name = d.getTime()
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
      hiddenElement.target = '_blank';
      //provide the name for the CSV file to be downloaded
      hiddenElement.download = 'Error_Log' + name + '.csv';
      hiddenElement.click();
    }
  }

  uploadanother() {
    this.sampleurl = null;
    this.file = null;
    this.drv_doc_upload.selectedFilesPk = [];
    this.errors = null;
    this.displaycounts= false;
    this.assesmentrepot.triggerChange();
     this.initialise();
  }

  close()
  {
    this.router.navigate(['/dashboard/portaladmin']);
  }


}





