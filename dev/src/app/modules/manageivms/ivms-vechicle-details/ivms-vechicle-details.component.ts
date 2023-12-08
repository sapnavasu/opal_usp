import { Component, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { DateAdapter, MAT_DATE_FORMATS } from '@angular/material/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { MatCheckbox } from '@angular/material/checkbox';

export interface Element {
  failure_comment: any,
  vichle_reg: any,
  chasis_number: any,
  ivms_device: any,
  dateofexp: any,

}

const ELEMENT_DATA: Element[] = [
  {
    failure_comment: 'Test',
    vichle_reg: 'Main',
    chasis_number: 'Test',
    ivms_device: '1234',
    dateofexp: '321',
  },
];

@Component({
  selector: 'app-ivms-vechicle-details',
  templateUrl: './ivms-vechicle-details.component.html',
  styleUrls: ['./ivms-vechicle-details.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class IvmsVechicleDetailsComponent implements OnInit {
  tableplaceholder: boolean = false;
  i18n(key) {
    return this.translate.instant(key);
  }
  public PageLoaders: boolean = false;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild("paginator") paginator: MatPaginator;
  public filtername = "Hide Filter";
  public resultsLength: number = 0;
  public hidefilder: boolean = true;
  public selectAllVisible: boolean;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  public clearClose: boolean = false;
  displayedColumns = [
    { def: "failure_comment", visible: true, disabled: true },
    { def: "vichle_reg", visible: true, disabled: false },
    { def: "chasis_number", visible: true, disabled: true },
    { def: "ivms_device", visible: true, disabled: false },
    { def: "dateofexp", visible: true, disabled: false },
  ];

  constructor(
    public router: Router,
    private translate: TranslateService,
    protected security: Encrypt,) { }

  public ifarbic: boolean = false;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  ngOnInit(): void {

  }

  // displayed column
  getdisplayedColumn(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
  }

}

