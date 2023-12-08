import { Component, EventEmitter, Input, OnInit, Output, QueryList, ViewChild, ViewChildren, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { CommoncommentsComponent } from '@app/@shared/commoncomments/commoncomments.component';
import { MatDialog } from '@angular/material/dialog';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { SelectionModel } from '@angular/cdk/collections';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import moment from 'moment';
import { ApplicationService } from '@app/services/application.service';
import { ActivatedRoute } from '@angular/router';
import { InvokeMethodExpr } from '@angular/compiler';

export const MY_FORMATS = {


  parse: {
    dateInput: 'DD-MM-YYYY',
  },
  display: {
    dateInput: 'DD-MM-YYYY',
    monthYearLabel: 'MMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY',
  },
};
export interface Element {



  awarding: any;
  position: any;
  Lastaudited: any;
  document: any;
  addedon: any;
  status: any;
  lastupdated: any;
  intnatrecogmst_pk: any;
  appintrecogtmp_pk: any;



}

// const ELEMENT_DATA: Element[] = [
//   { position: 1, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'A', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
//   { position: 2, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'D', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
//   { position: 3, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'U', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
//   { position: 4, awarding: 'NABET', lastaudited: '10-1-2023', document: 'PDF', status: 'N', addedon: '10-1-2023', lastupdated: 20 - 1 - 2023 },
// ];

@Component({
  selector: 'app-internationalrecognition',
  templateUrl: './internationalrecognition.component.html',
  styleUrls: ['./internationalrecognition.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', visibility: 'hidden' })),
    state('expanded', style({ height: '*', visibility: 'visible' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ]
})
export class InternationalrecognitionComponent implements OnInit {
  interappo = null;
  approval_value = 'international';
  comment: any;
  status: any;
  app_ref_id: any;
  inter_id: any[] = [];
  arr: any[] = [];
  disableSubmitButton: boolean;
  applytype: any;


  i18n(key) {
    return this.translate.instant(key);
  }
  @Output() interprev = new EventEmitter<void>();
  @Output() internationalnext = new EventEmitter<void>();
  newone: boolean = false;
  update: boolean = false;
  approval: boolean = true;
  decline: boolean = false;
  success: boolean = false;
  declinecmd: boolean = false;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page: number = 10;
  resultsLength: number;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;

  @ViewChild("paginator") paginator: MatPaginator;

  displayedColumns = ['checkbox', 'awarding', 'lastaudited', 'document', 'status', 'addedon', 'lastupdated', 'action'];
  dataSource = new MatTableDataSource<Element>();
  // expandedElement: Element | null;
  expandedElement: boolean = false;
  @ViewChildren('check') allcheckbox: QueryList<any>;
  tblplaceholder: boolean = false;
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    private dialog: MatDialog,
    private applicationservice: ApplicationService,
    private activatedRoute: ActivatedRoute,
    private cookieService: CookieService,) {

    this.dataSource.filterPredicate = this.createFilter();

  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }

  Awarding_filter = new FormControl('');
  LastAudited_filter = new FormControl('');
  Status_filter = new FormControl('');
  Addedon = new FormControl('')
  LastUpdated = new FormControl('');
  doc = new FormControl('');
  addon = new FormControl('');
  validbtn:boolean ;
  viewcertificate:boolean = true;

  public filterValues = {
    Awarding: '',
    lastAudited: '',
    status: '',
    lastupdated:'',
    addedon:''



  };

  @Output() interapprovaltrue = new EventEmitter<any>();
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
      } else {
        this.filtername = "إخفاء التصفية";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";

    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
        } else {
          this.filtername = "إخفاء التصفية";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";

      }
    });

    this.activatedRoute.queryParams.subscribe((params) => {
      this.app_ref_id = params['app_ref_id'];

      
      if(params['view'])
      {
       
      
        this.viewcertificate = false;
      } else
      {
       
     
        this.viewcertificate = true;
       
      }

      if (this.app_ref_id == '' || this.app_ref_id == undefined) {
        return false;
      }
      else {

       this.disableSubmitButton = true;
        this.applicationservice.getinternationaltab(this.app_ref_id).subscribe(res => {
          this.disableSubmitButton = false;
          this.dataSource = new MatTableDataSource<Element>(res.data);
          this.dataSource.filterPredicate = this.createFilter();
          this.dataSource.paginator = this.paginator;
          // this.resultsLength =  res.data.totalcount;          
          this.arr = [];
		this.applytype = res.data[0].appdt_apptype;          this.dataSource.filteredData.forEach(data => {
            this.tblplaceholder = true;
       
            this.arr.push(data.status);
          })
            if (this.arr.includes('4') && !this.arr.includes('1') ) {
              this.approval = false;
              this.decline = true;
              this.newone = false;
              this.update =false;
              this.interappo = "decline";
              this.interapprovaltrue.emit("decline");


            }
            else if(this.arr.includes('1'))
            {
              this.newone = true;
              this.approval = false;
              this.decline = false;
              this.update =false;
              this.interappo = "new";
              this.interapprovaltrue.emit("new");

            } 
            else if(this.arr.includes('2'))
            {
              this.newone = false;
              this.approval = false;
              this.decline = false;
              this.update =true;
              this.interappo = "new";
              this.interapprovaltrue.emit("new");

            }
            else if(this.arr.includes('3'))
            {
              this.newone = false;
              this.approval = true;
              this.decline = false;
              this.update =false;
              this.interappo = "approved";
              this.interapprovaltrue.emit("approved");

            }
            else if(this.arr.length == 0)
            {
              this.newone = false;
              this.approval = false;
              this.decline = false;
              this.interappo = "empty";
              this.interapprovaltrue.emit();
            }
            else {
              this.approval = true;
              this.decline = false;
          this.newone = false;

              this.interappo = "approved";
              this.interapprovaltrue.emit("approved");





            }
            setTimeout(() => {
              this.tblplaceholder = false;

            }, 2000);

       


        })
      }


    });





    this.Awarding_filter.valueChanges
      .subscribe(
        Awarding => {
          this.filterValues.Awarding = Awarding.toLowerCase();

          this.dataSource.filter = JSON.stringify(this.filterValues);
          this.dataSource.filterPredicate = this.createFilter();
        }

      )


    this.LastAudited_filter.valueChanges
      .subscribe(
        lastAudited => {
          this.filterValues.lastAudited = lastAudited?.startDate ? Date.parse(moment(lastAudited.startDate._d).format('MM-DD-YYYY').toString())+','+Date.parse(moment(lastAudited.endDate._d).format('MM-DD-YYYY').toString()) : '';
          //lastAudited;
          this.dataSource.filter = JSON.stringify(this.filterValues);
          this.dataSource.filterPredicate = this.createFilter();
        }

      )

    this.Status_filter.valueChanges
      .subscribe(
        status => {
          this.filterValues.status = status;

          this.dataSource.filter = JSON.stringify(this.filterValues);
          this.dataSource.filterPredicate = this.createFilter();
        }

      )
      this.LastUpdated.valueChanges
      .subscribe(
        lastupdated => {
          this.filterValues.lastupdated = lastupdated?.startDate ? Date.parse(moment(lastupdated.startDate._d).format('MM-DD-YYYY').toString())+','+Date.parse(moment(lastupdated.endDate._d).format('MM-DD-YYYY').toString()) : '';

          this.dataSource.filter = JSON.stringify(this.filterValues);
          this.dataSource.filterPredicate = this.createFilter();
        }
      )
      this.Addedon.valueChanges
      .subscribe(
        addedon => {
          this.filterValues.addedon = addedon?.startDate ? Date.parse(moment(addedon.startDate._d).format('MM-DD-YYYY').toString())+','+Date.parse(moment(addedon.endDate._d).format('MM-DD-YYYY').toString()) : '';

          this.dataSource.filter = JSON.stringify(this.filterValues);
          this.dataSource.filterPredicate = this.createFilter();
        }
      )


  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('documentrequired.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('documentrequired.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }


  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.paginator.page.emit(event)



  }
  openComments() {
    let dialogRef = this.dialog.open(CommoncommentsComponent, { disableClose: true, panelClass: 'commentpanel', });
    dialogRef.afterClosed().subscribe(result => {
    });
  }
  selection = new SelectionModel<Element>(true, []);
  isAllSelected() {
    const numSelected = this.selection.selected.length;
    
    const numRows = this.dataSource.data.length;
    return numSelected === numRows;
  }
  /** Selects all rows if they are not all selected; otherwise clear selection. */
  masterToggle() {
    this.isAllSelected() ?
      this.selection.clear() :
      this.dataSource.data.forEach(row => this.selection.select(row));
  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
  }




  createFilter(): (data: any, filter: string) => boolean {

this.tblplaceholder = true;

    let filterFunction = function (data, filter): boolean {

      let searchTerms = JSON.parse(filter);
      let lastAudited =  Date.parse(moment(data.lastaudited).format('MM-DD-YYYY'));
      let addedon =  Date.parse(moment(data.addedon).format('MM-DD-YYYY'));
      let lastupdated =  Date.parse(moment(data.lastupdated).format('MM-DD-YYYY'));
      return data?.awarding?.toLowerCase().indexOf(searchTerms.Awarding) !== -1 &&
        data?.status?.toLowerCase().indexOf(searchTerms.status) !== -1 && (searchTerms?.lastAudited==undefined || searchTerms?.lastAudited=='' || (data.lastaudited!=null && searchTerms?.lastAudited.split(',')[0]<= lastAudited && searchTerms?.lastAudited.split(',')[1]>=lastAudited)  ) && (searchTerms?.addedon==undefined || searchTerms?.addedon=='' || (data.addedon!=null && searchTerms?.addedon.split(',')[0]<= addedon && searchTerms?.addedon.split(',')[1]>= addedon)) && (searchTerms?.lastupdated==undefined || searchTerms?.lastupdated=='' || (data.lastupdated!=null && searchTerms?.lastupdated.split(',')[0]<= lastupdated && searchTerms?.lastupdated.split(',')[1]>= lastupdated))



    }
    setTimeout(() => {
      this.tblplaceholder = false; 
    }, 2000);
    return filterFunction;
  }


  approvechange(event) {

    this.comment = event.appintit_appdeccomment;
    this.status = event.appintit_status;
    this.tblplaceholder = true;
    this.applicationservice.getinternationaltab(this.app_ref_id).subscribe(res => {
      this.inter_id = [];
      this.dataSource = new MatTableDataSource<Element>(res.data);
      // this.resultsLength = res.data?.length;
      this.dataSource.paginator = this.paginator;

      this.arr = [];

      this.dataSource.filteredData.forEach(data => {
        this.tblplaceholder = true;
        this.arr.push(data.status);
        console.log(this.arr);
        if (this.arr.includes('4') && !this.arr.includes('1') ) {
          this.approval = false;
          this.decline = true;
          this.newone = false;
          this.interappo = "decline";
          this.interapprovaltrue.emit("decline");
          console.log('d')



        }
        else if(this.arr.includes('1'))
        {
          console.log('n')
          this.newone = true;
          this.approval = false;
          this.decline = false;
          this.interappo = "approved";
          this.interapprovaltrue.emit("new");

        }
        else if(this.arr.length == 0)
        {
          this.newone = false;
          this.approval = false;
          this.decline = false;
          this.interappo = "empty";
          this.interapprovaltrue.emit();
          console.log('e')

        }
        else {
          console.log('a')

          this.approval = true;
          this.decline = false;
          this.newone = false;
          this.interappo = "approved";
          this.interapprovaltrue.emit("approved");





        }
        setTimeout(() => {
          this.tblplaceholder = false;

        }, 2000);

      })







    })
  }

  interid(a: any, isall: string = '', checked = false) {
    
   

    if (isall) {
      this.inter_id = [];
      if (checked) {
        this.dataSource.filteredData.forEach(data => {
          this.inter_id.push(data.appintrecogtmp_pk);
        })


        return 1;
      }


      return 1;

    }

    const index = this.inter_id.indexOf(a);
    if (index !== -1) {
      this.inter_id.splice(index, 1);
    }
    else {
      this.inter_id.push(a);
    }

  
  



  }

  btnvalid()
  {
    if(this.inter_id.length == 0 )
    {
     this.validbtn = true;
    } else 
    {
      this.validbtn = false;

    }
  }
  clearFilter() {
    this.Awarding_filter.setValue("");
    this.LastAudited_filter.setValue("");
    this.Status_filter.setValue("");
    this.Addedon.setValue("");
    this.LastUpdated.setValue("");
    this.applicationservice.getinternationaltab(this.app_ref_id).subscribe(res => {
      console.log(res , 'tab 2')
      this.dataSource = new MatTableDataSource<Element>(res.data);
     
      // this.resultsLength =  res.data.totalcount;
      this.dataSource.paginator = this.paginator;

      this.arr = [];

      this.dataSource.filteredData.forEach(data => {
        this.tblplaceholder = true;
        this.arr.push(data.status);
        console.log(this.arr);
        if (this.arr.includes('4')) {
          this.approval = false;
          this.decline = true;
           this.interappo = "decline";
           this.interapprovaltrue.emit("decline");



        }
        else {
          this.approval = true;
          this.decline = false;
           this.interappo = "approved";
           this.interapprovaltrue.emit("approved");




        }
        setTimeout(() => {
          this.tblplaceholder = false;

        }, 2000);

      })


    })
  }

  onBooleanValue(value: boolean) {
    this.disableSubmitButton = value;
}
}





