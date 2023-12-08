import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { ErrorStateMatcher} from '@angular/material/core';
import {animate, state, style, transition, trigger} from '@angular/animations';
import { MatTableDataSource, MatTable } from '@angular/material/table';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';

export interface ModuleElement {
  id: number;
  name: string;
  create: string;
  update: string;
  delete: string;
  approve: string;
  download: string;
  submodule?: SubmoduleElement[] | MatTableDataSource<SubmoduleElement>;
}

export interface SubmoduleElement {
  sid: number;
  sname: string;
  screate: string;
  supdate: string;
  sdelete: string;
  sapprove: string;
  sdownload: string;
}

const ELEMENT_DATA: ModuleElement[] = [
  {
    id: 1,
    name: 'Module - 1',
    create: '',
    update: '',
    delete: '',
    approve: '',
    download: '',
    submodule:[
      {
        sid: 11,
        sname: 'SubModule - 1',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      },
      {
        sid: 12,
        sname: 'SubModule - 2',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      },
      {
        sid: 13,
        sname: 'SubModule - 3',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      }
    ]
  },{
    id: 2,
    name: 'Module - 2',
    create: '',
    update: '',
    delete: '',
    approve: '',
    download: '',
    submodule:[
      {
        sid: 21,
        sname: 'SubModule - 5',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      },
      {
        sid: 22,
        sname: 'SubModule - 6',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      },
      {
        sid: 23,
        sname: 'SubModule - 7',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      }
    ]
  },{
    id: 3,
    name: 'Module - 3',
    create: '',
    update: '',
    delete: '',
    approve: '',
    download: '',
    submodule:[
      {
        sid: 31,
        sname: 'SubModule - 7',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      },
      {
        sid: 32,
        sname: 'SubModule - 8',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      }
    ]
  },{
    id: 4,
    name: 'Module - 4',
    create: '',
    update: '',
    delete: '',
    approve: '',
    download: '',
    submodule:[
      {
        sid: 41,
        sname: 'SubModule - 9',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      },
      {
        sid: 42,
        sname: 'SubModule - 10',
        screate: '',
        supdate: '',
        sdelete: '',
        sapprove: '',
        sdownload: '',
      }
    ]
  }
];


@Component({
  selector: 'app-viewroles',
  templateUrl: './viewroles.component.html',
  styleUrls: ['./viewroles.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({height: '0px', minHeight: '0'})),
      state('expanded', style({height: '*'})),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ],
})
export class ViewrolesComponent implements OnInit {

  viewroleform: FormGroup;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  dataSource = ELEMENT_DATA;
  columnsToDisplay = ['name', 'create', 'update', 'delete', 'approve', 'download'];
  innerDisplayedColumns = ['sname', 'screate', 'supdate', 'sdelete', 'sapprove', 'sdownload'];
  expandedElement: ModuleElement | null;

  constructor(private formBuilder: FormBuilder,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }
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
  }

  initializeForm() {
    this.viewroleform = this.formBuilder.group({
      stkholdertype: [null],
      techeval: [null],
      arrole: [null],
      arrolehigh: [null]
    });
  }

  get viewrolform() { 
    return this.viewroleform.controls;
  }

 

}
