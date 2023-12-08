import { Component, OnInit, ViewChild, AfterViewInit, Input, ChangeDetectionStrategy} from '@angular/core';
import { CurrrencyService } from './currrency.service';
import { FormBuilder, FormGroup, Validators, FormControl, FormGroupDirective } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Router, ActivatedRoute, Params  } from '@angular/router';
import { Currency } from '../models/currency';
import swal from 'sweetalert';
import { GoogleAnalyticsService } from 'angular-ga';
import { ManagecurrencyComponent } from '../managecurrency/managecurrency.component';
import { Encrypt } from '@lypis_config/common/class/encrypt';

@Component({
  selector: 'app-createcurrency',
  templateUrl: './createcurrency.component.html',
  styleUrls: ['./createcurrency.component.css'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class CreatecurrencyComponent implements OnInit {
  public editid: any;
  @Input() tog: any = '';
  @Input() edit;
  @Input() moduleID: any;
  dupsubmit = false;
  checked = true;
  createbutton = true;
  updatebutton = false;
  buttonname = 'Add';
  currencyid = null;
  readonly WRITE_ACCESS_TYPE = this.security.encrypt(1);
  readonly READ_ACCESS_TYPE = this.security.encrypt(2);
  readonly UPDATE_ACCESS_TYPE = this.security.encrypt(3);
  breadcrums = [
    {
      'url': '/mastermaintance/currency/createcurrency', 'params': '', 'label': 'Currency Create'
    }
  ];

  @ViewChild('currencyFormReset') currencyFormReset: FormGroupDirective;
  currencyForm: FormGroup;
  constructor(private fb: FormBuilder,
              private currencyservice: CurrrencyService,
              private routeid: ActivatedRoute,
              protected router: Router,
              protected security: Encrypt,
              private gaService: GoogleAnalyticsService,
              private fetch: ManagecurrencyComponent
  ) {}
  ngOnChanges(edit) {
    if (this.edit != 0) {
      this.buttonname = 'Update';
      this.startEdit(this.edit);
    } else {
      this.buttonname = 'Add';
    }
  }
  ngOnInit() {
    this.currencyForm = this.fb.group({
      CurrSymbol: [null, Validators.compose([Validators.required, Validators.maxLength(3)])],
      CurrencyName: [null, Validators.compose([Validators.required, Validators.maxLength(40)])],
      Status: [null, ''],
      currencyid: [null, '']
    });
    this.routeid.params.subscribe(params => {
      if (params.id) {
        this.startEdit(params.id);
      }
    });
    this.gaService.configure('UA-120075477-1');
  }
  startEdit(cid: number) {
    this.updatebutton = true;
    this.createbutton = false;
    this.buttonname = 'Update';
    this.currencyservice.editcurrency(cid, this.moduleID, this.READ_ACCESS_TYPE).subscribe(
      data => {
       this.setFormValue(data.data);
      },
      err => console.error(err),
    );
  }
  toggle() {
    this.edit = 0;
    this.currencyFormReset.resetForm();
    this.tog.toggle();
  }
  setFormValue(datas: any) {
      if (datas.CurM_Status == 'A') {
        this.checked = true;
      } else {
        this.checked = false;
      }
      this.currencyForm.patchValue({
        Status: this.checked,
        CurrSymbol: datas.CurM_CurrSymbol,
        CurrencyName: datas.CurM_CurrencyName_en,
        currencyid: datas.CurrencyMst_Pk});
  }
  // form submit
  addCurrency() {
    this.dupsubmit = true;
    if (this.currencyForm.value.currencyid) {
      this.currencyservice.update(this.currencyForm.value.currencyid, this.currencyForm.value, this.moduleID, this.UPDATE_ACCESS_TYPE).subscribe(data => {
        if (data.data.status == 0) {
          swal({
            title: 'Warning',
            text: data.data.msg,
            icon: 'warning',
          });
        } else {
            this.sweetalert(data.data);
            this.fetch.fetchData();
        }
      });
    } else {
      this.currencyservice.create(this.currencyForm.value, this.moduleID, this.WRITE_ACCESS_TYPE).subscribe(data => {
        this.gaService.event.emit({
          category: 'superadmin/mm',
          action: 'New Currency'
          });
        if (data.data.status == 0) {
            swal({
              title: 'Warning',
              text: data.data.msg,
              icon: 'warning',
            });
          } else {
              this.sweetalert(data.data);
              this.fetch.fetchData();
          }
      });
    }

   }
  sweetalert(data) {
    swal({
      text: data.msg,
      icon: data.statusmsg,
    }).then((value) => {
      if (data.flag == 'S') {
        this.toggle();
        this.router.navigate(['/mastermaintance/managecurrency']);
      } else {
        this.dupsubmit = false;
      }
    });
  }

  clearForm() {
    const currencyId = this.currencyForm.controls.currencyid.value;
    this.currencyFormReset.resetForm();
    this.currencyForm.patchValue({
      currencyid: currencyId
    });
  }

  closeToggle() {
    this.showSweetAlert();
  }

  showSweetAlert() {
    if (this.currencyForm.touched) {
      swal({
        text: 'Are you sure you want to cancel? If yes all the data will be lost',
        icon: 'warning',
        buttons: ['Cancel', 'Ok'],
        dangerMode: true,
      }).then((willGoBack) => {
        if (willGoBack) {
          this.edit = 0;
          this.currencyFormReset.resetForm();
          this.buttonname = 'Add';
          this.createbutton = true;
          this.updatebutton = false;
          this.tog.toggle();
        }
      });
    } else {
      this.edit = 0;
      this.currencyFormReset.resetForm();
      this.buttonname = 'Add';
      this.createbutton = true;
      this.updatebutton = false;
      this.tog.toggle();
    }
  }
}
