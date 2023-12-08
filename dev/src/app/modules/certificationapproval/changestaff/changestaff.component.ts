import { Component, ElementRef,OnInit, ViewEncapsulation } from '@angular/core';
import { FormBuilder,  FormGroup, Validators } from '@angular/forms';
import { ErrorStateMatcher} from '@angular/material/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ApplicationService } from '@app/services/application.service';
import { HttpClient } from '@angular/common/http';
import { ToastrService } from 'ngx-toastr';
import swal from 'sweetalert';
@Component({
  selector: 'app-changestaff',
  templateUrl: './changestaff.component.html',
  styleUrls: ['./changestaff.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ChangestaffComponent implements OnInit {
  staffArray: any;
  changestaffform: FormGroup;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  disableSubmitButton: boolean;
  staffid: any;
  asd_date: any;
  omrm_tpname_en: any;
  oum_firstname:any;
  center_name: any;
  appasdt_applicationdtlstmp_fk: any;
  asd_projectmst_fk: any;
  omrm_branch_en: any;
  i18n(key) {
    return this.translate.instant(key);
  }

  constructor(private formBuilder: FormBuilder,private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService , public toastr: ToastrService, private el: ElementRef,private http: HttpClient,private route: Router,public routeid: ActivatedRoute ,private security: Encrypt , private appservice : ApplicationService) { }

    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
    this.initializeForm();

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
    this.routeid.queryParams.subscribe(params => {
      
      this.staffid = params['id'];
    });
    this.appservice.getstaffauditor(this.staffid).subscribe(data => {
      this.staffArray =  data['data'].data;
    });

    this.appservice.getstaffauditordata(this.staffid).subscribe(data => {
      this.disableSubmitButton = false;
     this.asd_date = data.data.data.asd_date;
     this.asd_projectmst_fk = data.data.data.asd_projectmst_fk
     this.omrm_tpname_en = data.data.comdata.omrm_tpname_en;
     this.omrm_branch_en = data.data.comdata.omrm_branch_en;
     this.oum_firstname = data.data.data.oum_firstname;
     this.center_name = data.data.comdata.omrm_companyname_en;
     this.appasdt_applicationdtlstmp_fk = data.data.comdata.appasdt_applicationdtlstmp_fk;
    });
 this.disableSubmitButton = false;

  }

  initializeForm() {
    this.changestaffform = this.formBuilder.group({
      staffname: [null, Validators.required]
    });
  }

  get changestfform() { 
    return this.changestaffform.controls;
  }

  cancel(){
    this.disableSubmitButton = true;
    this.route.navigate(['/centrecertification/schedulesiteaudit'],{ queryParams: { id: this.security.encrypt(this.asd_projectmst_fk) }});
  }

  changestaff(){
  
    if(this.changestaffform.valid){
      this.disableSubmitButton = true;
      this.appservice.changestaff(this.changestaffform.value , this.staffid).subscribe(data => {
        this.disableSubmitButton = false;
        console.log(data.data.data , 'changestaff');
        if(data.data.status=='1'){
          swal({
            title: this.i18n('company.updatsucc'),
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
            }).then(() => {
              this.route.navigate(['/centrecertification/schedulesiteaudit'],{ queryParams: { id: this.security.encrypt(data.data.data) }});   
            }); 
          
        }
                
      });
    }else{
      this.focusInvalidInput(this.changestaffform);
    }
  }



  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        console.log(key);
        if (invalidControl)
        {
          invalidControl.focus();
        }
        break;
      }
    }
  }

  viewapplication(id){
    if(this.asd_projectmst_fk == 1){
      this.route.navigate(['centrecertification/desktopreview/'+this.security.encrypt(id)+'/view/'+this.security.encrypt(1)+'/'+this.security.encrypt(this.asd_projectmst_fk)]);    
    }else{
      this.route.navigate(['centrecertification/rasdesktopreview/'+this.security.encrypt(id)+'/view/'+this.security.encrypt(1)+'/'+this.security.encrypt(this.asd_projectmst_fk)]);    
    }
    //this.route.navigate(['centrecertification/desktopreview/'+this.security.encrypt(id)+'/view/'+this.security.encrypt(1)]);
    
  }

}
