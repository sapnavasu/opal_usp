import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import moment from 'moment';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { TechnicalstaffService } from '@app/services/technicalStaff.service';

@Component({
  selector: 'app-tarnsfertechnical',
  templateUrl: './tarnsfertechnical.component.html',
  styleUrls: ['./tarnsfertechnical.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class TarnsfertechnicalComponent implements OnInit {
  civilNumber: any;
  viewStaffResponse: any;
  staffinforepo_pk: any;
  fullPageLoaders: boolean;
  i18n(key) {
    return this.translate.instant(key);
  }
  constructor(private fb: FormBuilder, public router: Router,
    private formBuilder: FormBuilder,
    private el: ElementRef,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private toastr: ToastrService,
    private technicalstaff: TechnicalstaffService,
    private activeRoute: ActivatedRoute,
    protected security: Encrypt,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  today = new Date();
  public tranferForms: FormGroup;
  ngOnInit(): void {
    this.fullPageLoaders = true;
    this.activeRoute.queryParamMap.subscribe((data: any) => {
      this.civilNumber = data.get("id");
    });
    // this.getDataViaCivil();
    this.branchLists();
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
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
    });
    this.formControls()
  }
  formControls() {
    this.tranferForms = this.fb.group({
      offtype: ['', '',],
      branch_name: ['', ''],
      locate: ['', '']
    })
  }
  branchList = []
  // cancel
  cancel() {
    if (this.tranferForms.touched) {
      swal({
        title: this.i18n('Do you want to cancel?'),
        text: 'If yes, any unsaved data will be lost.',
        icon: 'warning',
        buttons: [this.i18n('No'), this.i18n('yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.router.navigate(['approvalstaffmanagement/technicalcentre']);
          setTimeout(() => {
            this.tranferForms.reset()
          }, 1000);
        }
      }
      )
    } else {
      this.router.navigate(['approvalstaffmanagement/technicalcentre']);
      setTimeout(() => {
        this.tranferForms.reset()
      }, 1000);
    }
  }
  // submit
  saveFormDetails() {
    if (this.tranferForms.value) {
      this.router.navigate(['approvalstaffmanagement/technicalcentre']);
      setTimeout(() => {
        this.tranferForms.reset()
      }, 1000);
    } else {
      this.focusInvalidInput(this.tranferForms)
    }
  }
  // focus
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        // console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }

  // View API Call
  getDataViaCivil() {
    this.technicalstaff.viewStaff(atob(this.civilNumber))
      .subscribe((data) => {
        this.viewStaffResponse = data?.data;
        this.fullPageLoaders = false;
        this.staffinforepo_pk = data?.data?.staffinforepo_pk;
      })
  }

  branchLists() {
    var branchListItems = [];
    this.technicalstaff.branchList()
      .subscribe((data) => {
        this.branchList = data?.data;

        this.branchList = this.branchList.map((val, key) => { 
          var k = val.appinstinfomain_pk;
          // console.log(k,'kk');
          
        return {
          k : val?.branchname_en
        };
      });
      console.log(this.branchList,'this.branchList')
    })
  }
}

