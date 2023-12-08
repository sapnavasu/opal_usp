import { ChangeDetectionStrategy, Component, Input, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { GoogleAnalyticsService } from 'angular-ga';
import 'rxjs/add/observable/of';
import swal from 'sweetalert';
import { CountryService } from '../../newcountry/service/country.service';
import { StateService } from '../../state/service/state.service';
import { ManagecityComponent } from '../managecity/managecity.component';
import { CityService } from '../service/city.service';

let countrylist: Object;
@Component({
  selector: 'app-city',
  templateUrl: './city.component.html',
  styleUrls: ['./city.component.css'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class CityComponent implements OnInit {
  public editid: any;
  @Input() tog: any = '';
  @Input() moduleID: any;
  @Input() edit;
  readonly WRITE_ACCESS_TYPE = this.security.encrypt(1);
  readonly READ_ACCESS_TYPE = this.security.encrypt(2);
  readonly UPDATE_ACCESS_TYPE = this.security.encrypt(3);
  readonly DELETE_ACCESS_TYPE = this.security.encrypt(4);
  buttonname = 'Add';
  dupsubmit = false;
  createbutton = true;
  updatebutton = false;
  countrylists: any = null;
  statelists: any;
  checked = true;
  selectedValue: number;
  breadcrums = [
    {
      'url': '/mastermaintance/city', 'params': '', 'label': 'Create City'
    }
  ];
  cityid = null;
  public cityform: FormGroup;
  constructor(
    private fb: FormBuilder,
    private countryservice: CountryService,
    private stateservice: StateService,
    private cityservice: CityService,
    protected router: Router,
    protected security: Encrypt,
    private routeid: ActivatedRoute,
    private gaService: GoogleAnalyticsService,
    private fetch: ManagecityComponent
  ) {}

  ngOnChanges(edit) {
    if (this.edit != 0) {
         this.startEdit(this.edit);
       }

     }
  ngOnInit() {
    this.cityform = this.fb.group({
      CountryMst_Pk: [null, Validators.compose([Validators.required])],
      StateMst_Fk: [null, Validators.compose([Validators.required])],
      CityName: [null, Validators.compose([Validators.required])],
      Status: [null, ''],
      cityid: [null, '']
    });
    this.countryservice.getCountry().subscribe(
      data => {
       this.countrylists = data; //data.data
      });
    this.routeid.params.subscribe(params => {
        if (params.id) {
          this.startEdit(params.id);
        }
      });
    this.gaService.configure('UA-120075477-1');
  }
  toggle() {
    this.cityform.reset();
    this.tog.toggle();
  }
  startEdit(cid: number) { this.buttonname = 'Update';
    this.updatebutton = true;
    this.createbutton = false;
    this.cityservice.editcity(cid, this.moduleID, this.READ_ACCESS_TYPE).subscribe(
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
      if (datas[0].CM_Status == 'A') {
        this.checked = true;
      } else {
        this.checked = false;
      }
      this.stateservice.getstatebyid(datas[0].CountryMst_Pk, this.moduleID, this.READ_ACCESS_TYPE).subscribe(
        data => {
          if (data.data.status == 0) {
            swal({
              title: 'Warning',
              text: data.data.msg,
              icon: 'warning',
            });
          } else {
            this.statelists = data.data;
          }
        });
      this.cityform.patchValue({
        CountryMst_Pk: Number(datas[0].CountryMst_Pk),
        StateMst_Fk: Number(datas[0].CM_StateMst_Fk),
        CityName: datas[0].CM_CityName_en,
        Status: this.checked,
        cityid: datas[0].CityMst_Pk
    });
  }
  onSelect(id: any) {
    this.statelists = [];
    this.stateservice.getstatebyid(id, this.moduleID, this.READ_ACCESS_TYPE).subscribe(
      data => {
        if (data.data.status == 0) {
          swal({
            title: 'Warning',
            text: data.data.msg,
            icon: 'warning',
          });
        } else {
          this.statelists = data.data;
        }
      });
  }
  addcity() {
    this.dupsubmit = true;
    if (this.cityform.value.cityid) {
       this.cityservice.updatecity(this.cityform.value.cityid, this.cityform.value, this.moduleID, this.UPDATE_ACCESS_TYPE).subscribe(data => {
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
      }
       );
    } else {
      this.cityservice.createcity(this.cityform.value, this.moduleID, this.WRITE_ACCESS_TYPE).subscribe(data => {
          this.gaService.event.emit({
            category: 'superadmin/mm',
            action: 'New  City'
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
        }
         );
    }
    this.toggle();
  }
  sweetalert(data) {
  swal({
    text: data.msg,
    icon: data.statusmsg,
  }).then((value) => {
      if (data.flag == 'S') {
        this.router.navigate(['/mastermaintance/managecity']);
      } else {
        this.dupsubmit = false;
      }
  });
  }
}
