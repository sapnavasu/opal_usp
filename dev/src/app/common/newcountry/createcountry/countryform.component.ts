import { Component, OnInit, ViewChild, AfterViewInit, Input} from '@angular/core';
import { CountryService } from '../service/country.service';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Router, ActivatedRoute,Params  } from '@angular/router';
import {DataSource} from '@angular/cdk/collections';
import { Country } from "../models/country";
import {MatSort, MatSortable, MatTableDataSource,MatPaginator} from '@angular/material';
import {MatIconModule} from '@angular/material/icon';
import swal from 'sweetalert';
import { GoogleAnalyticsService } from 'angular-ga';
import { CountryComponent } from '../managecountry/country.component';
let countrylist: Object;

@Component({
    selector: 'app-countryform',
    templateUrl: './countryform.component.html',
    styleUrls: ['./countryform.component.css']
})
export class CountryformComponent implements OnInit {
    public editid:any;
    @Input() tog:any="";
    @Input() edit;
    createbutton:boolean=true;
    dupsubmit:boolean=false;
    updatebutton:boolean=false;
    checked:boolean=true;
    buttonname:string="Add";
    breadcrums=[
        {
            "url":"/mastermaintance/countryform","params":"","label":"Create Country"
        }
    ];
    cid:number=null;
    data:any = null;
    public countrymaster: FormGroup;
    constructor(private fb: FormBuilder,
                private countryservice: CountryService,
                protected router: Router,
                private routeid: ActivatedRoute,
                private gaService: GoogleAnalyticsService,
                private fetch: CountryComponent
            ) {}

 ngOnChanges(edit) {
 if(this.edit!=0) { 
      this.startEdit(this.edit);
    }
    
  }
    ngOnInit() {
        this.countrymaster = this.fb.group({
            CountryCode: [null, Validators.compose([Validators.required,Validators.maxLength(3)])],
            CountryName: [null, Validators.compose([Validators.required,])],
            CountryDialCode: [null, Validators.compose([Validators.required,Validators.maxLength(5)])],
            Status: [null, ''],
            cid:[null,'']
        });
        this.routeid.params.subscribe(params => {
            if(params['id'])
            {
                this.startEdit(params['id'])
            }
        });
        this.gaService.configure('UA-120075477-1');
    }
    startEdit(cid:number)
    {
        this.buttonname = 'Update';
        this.updatebutton=true;
        this.createbutton=false;
        this.countryservice.editCountry(cid).subscribe(
            datas => {
                this.setFormValue(datas['data'])
            },
            err => console.error(err),
        );
    }
    setFormValue(datas:any)
    {
        if(datas.CyM_Status =="A")
        {
            this.checked=true;
        }
        else{
            this.checked=false;
        }
        this.countrymaster.patchValue({
            CountryCode:datas.CyM_CountryCode_en,
            CountryName:datas.CyM_CountryName_en,
            CountryDialCode:datas.CyM_CountryDialCode,
            Status:this.checked,
            cid:datas.CountryMst_Pk
        });
    }
    toggle(){
        // this.countrymaster.reset();
        this.tog.toggle();
    }
    addCountry(){
        this.dupsubmit=true;
        if(this.countrymaster.value['cid'])
        {
            this.countryservice.updateCountry(this.countrymaster.value['cid'],this.countrymaster.value,).subscribe(data =>
            {
                this.sweetalert(data['data']);
                this.fetch.fetchData();
            });
        }
        else
        {
            this.countryservice.createCountry(this.countrymaster.value).subscribe(data =>
            {
                this.gaService.event.emit({
                    category: 'superadmin/mm',
                    action: 'New Country'
                    });
                this.sweetalert(data['data']);
                this.fetch.fetchData();
            });
        }
        this.toggle();
    }
    sweetalert(data)
    {
        swal({
            text:data.msg,
            icon:data.statusmsg,
        }).then((value)=>{
            if(data.flag =="S")
            {
                this.router.navigate(['/mastermaintance/managecountry']);
            }
            else {
                this.dupsubmit=false;
            }

        });
    }
}
