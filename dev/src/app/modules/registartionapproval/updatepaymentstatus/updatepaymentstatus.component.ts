import { Component, OnInit, Input, Inject } from '@angular/core';
import swal from 'sweetalert';
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';
import { Observable } from 'rxjs';
import { map, startWith } from 'rxjs/operators';
import { ViewEncapsulation } from '@angular/core';
import { ApprovalService } from '../approval.service';
import { MatDrawer } from '@angular/material/sidenav';
import { ErrorStateMatcher } from '@angular/material/core';
import { Route, Router } from '@angular/router';
import { DOCUMENT } from '@angular/common';
import { ToastrService } from 'ngx-toastr';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-updatepaymentstatus',
  templateUrl: './updatepaymentstatus.component.html',
  styleUrls: ['./updatepaymentstatus.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class UpdatepaymentstatusComponent implements OnInit {
  i18n(key){
		return this.translate.instant(key);
	  }
  myControl = new FormControl();
  updateoption: string[] = [
    "Create a new dimension with Smart List selected as the Dimension Type",
    "Create members in the dimension. (The members are the items that display in the drop-down, data form, or grid.)",
    "Some examples of approved comments & declined comment available",
    "Assign properties to the Smart List dimension and members. Assign a Label to the Smart List and Smart List members.",
    "Enable Smart Lists for data forms. See the Oracle Hyperion Planning Administrator's Guide.",
    "Use Smart List values in member formulas and business rules.",
  ];
  updateOptions: Observable<string[]>;
  animationState2 = 'out';
  @Input('updatepaymentdrawer') updatepaymentdrawer: MatDrawer;
  updatepaymtstsdata: any;
  public buttonname: string = 'Update';
  public UpdatepaymentstausForm: FormGroup;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  payidnumber: boolean = false;
  commendsid: boolean = false;
  btndisabled: boolean = false;
  constructor( private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,private fb: FormBuilder, private approvalservice: ApprovalService, private router: Router, @Inject(DOCUMENT) private _document: Document, public toastr: ToastrService
  ) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr"
  
  ngOnInit() {
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
    this.UpdatepaymentstausForm = this.fb.group({
      selectpaymentstatus: ["", Validators.required],
      paymentnumber: [""],
      comments: [""],
    });
    this.updateOptions = this.myControl.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
  }

  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.updateoption.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }
  paymentChange(event) {
    this.UpdatepaymentstausForm.controls['paymentnumber'].setValue("");
    this.UpdatepaymentstausForm.controls['comments'].setValue("");
    if (event.value == 1) {
      this.payidnumber = true;
      this.commendsid = false;

      this.UpdatepaymentstausForm.controls['comments'].clearValidators();
      this.UpdatepaymentstausForm.controls['comments'].updateValueAndValidity();
      this.UpdatepaymentstausForm.controls['paymentnumber'].setValidators([Validators.required]);
      this.UpdatepaymentstausForm.controls['paymentnumber'].updateValueAndValidity();
    } else if (event.value == 8) {
      this.payidnumber = false;
      this.commendsid = true;
      this.UpdatepaymentstausForm.controls['paymentnumber'].clearValidators();
      this.UpdatepaymentstausForm.controls['paymentnumber'].updateValueAndValidity();
      this.UpdatepaymentstausForm.controls['comments'].setValidators([Validators.required]);
      this.UpdatepaymentstausForm.controls['comments'].updateValueAndValidity();
      this.UpdatepaymentstausForm.controls['comments'].setValue(this.i18n('updatepaymentstatus.duetothenetw'));

    }

  }
  formreset() {
    this.UpdatepaymentstausForm.reset();
  }
  showSuccess(){
    this.toastr.success(this.i18n('updatepaymentstatus.updasucc'), this.i18n('updatepaymentstatus.succ'), {
        timeOut: 3000,
        closeButton: true,
    });
  }
  submitpaymentst(idvalue) {
    if (this.UpdatepaymentstausForm.valid) {
      this.btndisabled = true;
      this.approvalservice.paymtupdyestatusChange(idvalue, this.UpdatepaymentstausForm.value).subscribe(res => {
        if (res.data['statusmsg'] == "success") {
          this.btndisabled = false;
          this.updatepaymentdrawer.toggle();
          this.UpdatepaymentstausForm.reset();
          this._document.defaultView.location.reload();
          // swal({
          //   title: "Updated successfully",
          //   icon: 'success',
          // }).then(() => {
        
          // });

        }
      });
    }
  }
  Updatepaymentalert() {
    swal({
      title: this.i18n('updatepaymentstatus.doyouwanttocancupda'),
      text: this.i18n('updatepaymentstatus.allthedatathat'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('updatepaymentstatus.canc'), this.i18n('updatepaymentstatus.okbutton')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.commendsid = false;
        this.payidnumber = false;
        this.UpdatepaymentstausForm.controls['selectpaymentstatus'].setValue("");
        this.UpdatepaymentstausForm.controls['paymentnumber'].setValue("");
        this.UpdatepaymentstausForm.controls['comments'].setValue("");
        this.UpdatepaymentstausForm.controls['selectpaymentstatus'].clearValidators();
        this.UpdatepaymentstausForm.controls['selectpaymentstatus'].updateValueAndValidity();
        this.UpdatepaymentstausForm.controls['paymentnumber'].clearValidators();
        this.UpdatepaymentstausForm.controls['paymentnumber'].updateValueAndValidity();
        this.UpdatepaymentstausForm.controls['comments'].clearValidators();
        this.UpdatepaymentstausForm.controls['comments'].updateValueAndValidity();
        this.updatepaymentdrawer.toggle();
      }
    });
    this.animationState2 = 'out';
  }
}
