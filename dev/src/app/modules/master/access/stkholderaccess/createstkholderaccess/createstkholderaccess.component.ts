import {Component, OnInit, Input} from '@angular/core';
import {FormGroup, FormBuilder, Validators} from '@angular/forms';
import {Router, ActivatedRoute} from '@angular/router';
import swal from 'sweetalert';
import {StkholderaccessService} from '../stkholderaccess.service';
import {GoogleAnalyticsService} from 'angular-ga';
import {ManagestkholderaccessComponent} from '../managestkholderaccess/managestkholderaccess.component';

@Component({
  selector: 'app-createstkholderaccess',
  templateUrl: './createstkholderaccess.component.html',
  styleUrls: ['./createstkholderaccess.component.scss']
})
export class CreatestkholderaccessComponent implements OnInit {

  public editid: any = 0;
  @Input() tog: any = '';
  @Input() edit;
  @Input() stkholdtypelist: any[];
  @Input() basemodulelists: any[];
  dupsubmit: boolean = false;
  createbutton: boolean = true;
  updatebutton: boolean = false;
  checked: boolean = true;
  selectedValue: number;
  buttonname: string = 'Add';
  searchbasemodule: string = '';
  searchstkholdtype: string = '';
  breadcrums = [
    {
      'url': '/access/createstkholderaccess', 'params': '', 'label': 'Create Stakeholder Access'
    }
  ];
  cityid = null;
  public stkholdaccessform: FormGroup;

  constructor(
    private fb: FormBuilder,
    private stkholdService: StkholderaccessService,
    protected router: Router,
    private routeid: ActivatedRoute,
    private gaService: GoogleAnalyticsService,
    private manageStkhold: ManagestkholderaccessComponent
  ) {
  }

  ngOnChanges(edit) {
    if (this.edit !== 0) {
      this.startEdit(this.edit);
    }

  }

  ngOnInit() {
    this.stkholdaccessform = this.fb.group({
      basemoduleid: [null, Validators.compose([Validators.required])],
      stkholdertypeid: [null, Validators.compose([Validators.required])],
      order: [null, Validators.compose([Validators.required, Validators.pattern('^[0-9]*$')])],
      stkholderaccessid: [null, null],
    });


    this.routeid.params.subscribe(params => {
      if (params['id']) {
        this.startEdit(params['id']);
      }
    });
    this.gaService.configure('UA-120075477-1');
  }

  toggle() {
    this.stkholdaccessform.reset();
    this.tog.toggle();
  }

  startEdit(cid: number) {
    this.updatebutton = true;
    this.createbutton = false;

    this.stkholdService.editStkholdaccess(cid).subscribe(
      data => {
        this.setFormValue(data['data']);
      },
      err => console.error(err),
    );
  }

  setFormValue(datas: any) {
    this.stkholdaccessform.patchValue({
      basemoduleid: datas.sham_basemodulemst_fk,
      stkholdertypeid: datas.stkholdertypmst_pk,
      order: datas.sham_order,
      stkholderaccessid: datas.stkholderaccessmst_pk
    });
  }

  addstkholderaccess() {
    this.dupsubmit = true;
    let accessType = 1;
    if(this.stkholdaccessform.controls['stkholderaccessid'].value){
      let accessType = 3;
    }
    this.stkholdService.createorEditStkholdaccess(this.stkholdaccessform.value, accessType).subscribe(data => {
        this.sweetalert(data['data']);
        if(data['data'].flag == 'S'){
          this.manageStkhold.fetchData();
          this.toggle();
        }
      }
    );
  }

  sweetalert(data) {
    swal({
      text: data.msg,
      icon: data.statusmsg,
    }).then((value) => {
      if (data.flag == 'E') {
        this.dupsubmit = false;
      }
    });
  }

}
