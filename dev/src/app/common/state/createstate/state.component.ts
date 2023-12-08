import { Component, OnInit, Input } from '@angular/core';
import { CountryService } from '../../newcountry/service/country.service';
import { StateService } from '../../state/service/state.service';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Router, ActivatedRoute, Params  } from '@angular/router';
import {DataSource} from '@angular/cdk/collections';
import { Country } from '../../newcountry/models/country';
import {MatSort, MatSortable, MatTableDataSource, MatPaginator} from '@angular/material';
import {MatIconModule} from '@angular/material/icon';
import swal from 'sweetalert';
import { GoogleAnalyticsService } from 'angular-ga';
import { ManagestateComponent } from '../managestate/managestate.component';
import { Encrypt } from '@lypis_config/common/class/encrypt';
let countrylist: Object;

@Component({
  selector: 'app-state',
  templateUrl: './state.component.html',
  styleUrls: ['./state.component.css']
})
export class StateComponent implements OnInit {
  public editid: any;
  @Input() tog: any = '';
  @Input() edit;
  @Input() moduleID: any;
  dupsubmit = false;
  public buttonname = 'Add';
  checked = true;
  countrylists: any = null;
  createbutton = true;
  updatebutton = false;
  stateid = null;
  readonly WRITE_ACCESS_TYPE = this.security.encrypt(1);
  readonly READ_ACCESS_TYPE = this.security.encrypt(2);
  readonly UPDATE_ACCESS_TYPE = this.security.encrypt(3);
  readonly DELETE_ACCESS_TYPE = this.security.encrypt(4);
  breadcrums = [
    {
      'url': '/mastermaintance/state', 'params': '', 'label': 'State Create'
    }
  ];
  public stateform: FormGroup;
  constructor(private fb: FormBuilder,
              private countryservice: CountryService,
              protected router: Router,
              private stateservice: StateService,
              private routeid: ActivatedRoute,
              private security: Encrypt,
              private gaService: GoogleAnalyticsService,
              private fetch: ManagestateComponent
  ) { }
  ngOnChanges(edit) {

    if (this.edit != 0) {
         this.startEdit(this.edit);
         this.updatebutton = true;
         this.createbutton = false;
       } else {
        this.updatebutton = false;
        this.createbutton = true;
       }

     }
  ngOnInit() {
    this.stateform = this.fb.group({
      CountryMst_Fk: [null, Validators.compose([Validators.required])],
      StateName: [null, Validators.compose([Validators.required])],
      Status: [null, ''],
      stateid: [null, '']
    });
    this.routeid.params.subscribe(params => {
      if (params.id) {
        this.startEdit(params.id);
      }
    });
    this.countryservice.getCountry().subscribe(
      data => {
       this.countrylists = data.data;
      });
    this.gaService.configure('UA-120075477-1');
  }
  toggle() {
    // this.stateform.reset();
    this.tog.toggle();

  }
  addState() {
    this.dupsubmit = true;
    if (this.stateform.value.stateid) {
      this.stateservice.updateState(this.stateform.value.stateid, this.stateform.value, this.moduleID, this.UPDATE_ACCESS_TYPE).subscribe
      (data => {
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
      this.stateservice.createState(this.stateform.value, this.moduleID, this.WRITE_ACCESS_TYPE).subscribe
      (data => {
        this.gaService.event.emit({
          category: 'superadmin/mm',
          action: 'New State'
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
    this.toggle();
  }
  sweetalert(data) {
      swal({
        text: data.msg,
        icon: data.statusmsg,
      }).then((value) => {
        if (data.flag == 'S') {
          // this.router.navigate(['/mastermaintance/state/managestate']);
        } else {
          this.dupsubmit = false;
        }

      });
  }
  startEdit(sid: number) {
    this.buttonname = 'Update';
    this.updatebutton = true;
    this.createbutton = false;
    this.stateservice.editState(sid, this.moduleID, this.READ_ACCESS_TYPE).subscribe(
      data => {
        if (data.data.status == 0) {
          swal({
            title: 'Warning',
            text: data.data.msg,
            icon: 'warning',
          });
        } else {
          this.setFormValue(data.data);
        }
      },
      err => console.error(err),
    );
  }
  setFormValue(datas: any) {
        if (datas.SM_Status == 'A') {
          this.checked = true;
        } else {
          this.checked = false;
        }
        this.stateform.patchValue({
        CountryMst_Fk: datas.SM_CountryMst_Fk,
        StateName: datas.SM_StateName_en,
        Status: this.checked,
        stateid: datas.StateMst_Pk
    });
  }
}
