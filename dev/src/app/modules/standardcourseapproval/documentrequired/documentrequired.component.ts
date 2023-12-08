import { SelectionModel } from '@angular/cdk/collections';
import { Component, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { animate, state, style, transition, trigger } from '@angular/animations';
import { formatDate } from '@angular/common';
import moment from 'moment';
import { ApplicationService } from '@app/services/application.service';
import { ActivatedRoute } from '@angular/router';
export interface Documentrecorddata {
  documentname: any;
  documentprovided: any;
  status: any;
  showmoredata: any;
  addedon: any;
  lastupdated: any;
  appdocsubmissiontmp_pk: any;
}

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

const documentrecord_data: Documentrecorddata[] = [
  { documentname: 'Oman Society for Petroleum Services (OPAL)', documentprovided: "Yes", status: "A", showmoredata: "pdfformat", addedon: "", lastupdated: "", appdocsubmissiontmp_pk: '' },
];

@Component({
  selector: 'app-documentrequired',
  templateUrl: './documentrequired.component.html',
  styleUrls: ['./documentrequired.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({ height: '0px', minHeight: '0' })),
      state('expanded', style({ height: '*' })),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ],
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})

export class DocumentrequiredComponent implements OnInit {
  newone:boolean = false;
  data = 'document';
  docappro = null;
  arr: any[] = [];

  @Output() documentbutton = new EventEmitter<void>();
  @Output() documentprevious = new EventEmitter<void>();
  documentname_filter = new FormControl('');
  documentprovided_filter = new FormControl('');
  // expandedElement: Documentrecorddata | null;
  status_filter = new FormControl('');
  addon = new FormControl('');
  lastdate = new FormControl('');
  docs_id: any[] = [];

  public filterValues = {
    document_name: '',
    document_provided: '',
    LastAudited: '',
    status_app: '',
    lastupdated:'',
    addondate:''



  };
  last_index = 100;
  counter = 100;
  disableSubmitButton: boolean;
  applytype: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  expandedElement: boolean = false;

  approved: boolean = true;
  update: boolean = false;
  approval: boolean = true;
  decline: boolean = false;
  success: boolean = false;
  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
  @ViewChild("paginator") paginator: MatPaginator;
  Documentrecordcolumn = ['checkbox', 'document_name', 'document_provided', 'document_remarks', 'status', 'addedon', 'lastupdated','action'];
  documentsrecord = new MatTableDataSource<Documentrecorddata>();
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  resultsLength: number;
  firstCount = 100
  tblplaceholder: boolean = false;
  @Output() docuaprovaltrue = new EventEmitter<any>();
  viewcertificate:boolean = true;
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private applicationservice: ApplicationService,
    private activatedRoute: ActivatedRoute,
  ) { }
  showTxt = "Show More";
  app_ref_id: any;
  info = "In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.";
  ngOnInit(): void {

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
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
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
    }
  
  
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


        this.applicationservice.getdocumenttab(this.app_ref_id).subscribe(res => {
        this.tblplaceholder = true;
          this.documentsrecord = new MatTableDataSource(res.data);
          this.documentsrecord.paginator = this.paginator;
          this.documentsrecord.filterPredicate = this.createFilter();
          this.applytype = res.data[0].appdt_apptype;
          this.arr = [];

          this.documentsrecord.filteredData.forEach(data => {
            this.arr.push(data.status);
            console.log( this.arr+'nun');
            // return;
            if (this.arr.includes('4') && !this.arr.includes('1')) {
              this.approval = false;
              this.decline = true;
          this.newone = false;

              this.docappro = "decline";
              this.docuaprovaltrue.emit("decline");


            }
            else if(this.arr.includes('1'))
            {

              this.newone = true;
              this.approval = false;
              this.decline = false;
              this.docappro = "new";
              this.docuaprovaltrue.emit("approved");

            }
            else if(this.arr.length == 0)
            {
              this.newone = false;
              this.approval = false;
              this.decline = false;
            }
            else  {
              this.approval = true;
              this.decline = false;
          this.newone = false;

              this.docappro = "approved"; 
              this.docuaprovaltrue.emit("approved");




            }


          })
              setTimeout(() => {
                this.tblplaceholder = false;
              }, 2000);


        })
      }



    });




    this.documentname_filter.valueChanges
      .subscribe(
        document_name => {
          this.filterValues.document_name = document_name.toLowerCase().trim();

          this.documentsrecord.filter = JSON.stringify(this.filterValues);
          this.documentsrecord.filterPredicate = this.createFilter();
        }



      )



    this.status_filter.valueChanges
      .subscribe(
        status_app => {
          this.filterValues.status_app = status_app;

          this.documentsrecord.filter = JSON.stringify(this.filterValues);
          this.documentsrecord.filterPredicate = this.createFilter();
        }



      )
    this.documentprovided_filter.valueChanges
      .subscribe(
        document_provided => {
          this.filterValues.document_provided = document_provided;

          this.documentsrecord.filter = JSON.stringify(this.filterValues);
          this.documentsrecord.filterPredicate = this.createFilter();
        }
      )
      this.addon.valueChanges
      .subscribe(
        addondate => {
          this.filterValues.addondate = addondate?.startDate ? Date.parse(moment(addondate.startDate._d).format('MM-DD-YYYY').toString())+','+Date.parse(moment(addondate.endDate._d).format('MM-DD-YYYY').toString()) : '';

          this.documentsrecord.filter = JSON.stringify(this.filterValues);
          this.documentsrecord.filterPredicate = this.createFilter();
        }
      )
      this.lastdate.valueChanges
      .subscribe(
        lastupdated => {
          this.filterValues.lastupdated = lastupdated?.startDate ? Date.parse(moment(lastupdated.startDate._d).format('MM-DD-YYYY').toString())+','+Date.parse(moment(lastupdated.endDate._d).format('MM-DD-YYYY').toString()) : '';

          this.documentsrecord.filter = JSON.stringify(this.filterValues);
          this.documentsrecord.filterPredicate = this.createFilter();
        }
      )

    this.last_index = (this.info.substring(0, 100)).lastIndexOf(' ');
    if (this.last_index > 100)
      this.last_index = 100;
    this.counter = this.last_index;
      }
  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
      console.log('page-content')
    } catch (error) {
      // console.log('page-content')
    }
  }


  selection = new SelectionModel<Documentrecorddata>(true, []);
  isAllSelected() {
    const numSelected = this.selection.selected.length;
    const numRows = this.documentsrecord.data.length;
    return numSelected === numRows;
  }
  /** Selects all rows if they are not all selected; otherwise clear selection. */
  masterToggle() {
    this.isAllSelected() ?
      this.selection.clear() :
      this.documentsrecord.data.forEach(row => this.selection.select(row));
  }

  toggleSkil() {
    if (this.counter < 101) {
      this.counter = this.info.length;
      this.showTxt = this.i18n('documentrequired.showless')
    }
    else {
      this.counter = this.last_index;
      this.showTxt = this.i18n('documentrequired.showmore')
    }
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
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;
  }



//   createFilter(): (data: any, filter: string) => boolean {



//     let filterFunction = function (data, filter): boolean {

//       let searchTerms = JSON.parse(filter);


// console.log(data?.documentname?.toLowerCase().indexOf(searchTerms.document_name)  !== -1);


//       return data?.documentname?.toLowerCase().indexOf(searchTerms.document_name) !== -1 &&
//         data?.documentprovided?.toLowerCase().indexOf(searchTerms.Documentprovided) !== -1 &&
//         data?.status?.toLowerCase().indexOf(searchTerms.status) !== -1


//     }
//     return filterFunction;
//   }


  createFilter(): (data: any, filter: string) => boolean {

this.tblplaceholder = true;

    let filterFunction = function (data, filter): boolean {

      let searchTerms = JSON.parse(filter);
      let addon =  Date.parse(moment(data.addedon).format('MM-DD-YYYY'));
      let lastupdate =  Date.parse(moment(data.appdst_updatedon).format('MM-DD-YYYY'));
      return data?.documentname?.toLowerCase().indexOf(searchTerms.document_name) !== -1 &&
      data?.documentprovided?.toLowerCase().indexOf(searchTerms.document_provided) !== -1 &&
      data?.status?.toLowerCase().indexOf(searchTerms.status_app) !== -1 && (searchTerms?.addondate==undefined || searchTerms?.addondate=='' || (data.addedon!=null && searchTerms?.addondate.split(',')[0]<= addon && searchTerms?.addondate.split(',')[1]>= addon)) && (searchTerms?.lastupdated==undefined || searchTerms?.lastupdated=='' || (data.appdst_updatedon!=null && searchTerms?.lastupdated.split(',')[0]<= lastupdate && searchTerms?.lastupdated.split(',')[1]>= lastupdate))
   
     
       

    }
    setTimeout(() => {
      this.tblplaceholder = false;
    }, 2000);
    return filterFunction;
  }


  docsid(a: any, isall: string = '', checked = false) {

    if (isall) {
      this.docs_id = [];

      if (checked) {
        this.documentsrecord.filteredData.forEach(data => {
          this.docs_id.push(data.appdocsubmissiontmp_pk);

        })


        return 1;
      }


      return 1;

    }

    const index = this.docs_id.indexOf(a);
    if (index !== -1) {
      this.docs_id.splice(index, 1);
    }
    else {
      this.docs_id.push(a);
    }


  }

  approvalchnage(event) {


    this.applicationservice.getdocumenttab(this.app_ref_id).subscribe(res => {
      this.docs_id = [];
      this.documentsrecord = new MatTableDataSource(res.data);
      this.documentsrecord.paginator = this.paginator;
      this.documentsrecord.filterPredicate = this.createFilter();

      this.arr = [];

      this.documentsrecord.filteredData.forEach(data => {
        this.arr.push(data.status);

    
        if (this.arr.includes('4') && !this.arr.includes('1')) {
          this.approval = false;
          this.decline = true;
          this.newone = false;

          this.docappro = "decline";
          this.docuaprovaltrue.emit("decline");


        }
        else if(this.arr.includes('1'))
        {

          this.newone = true;
          this.approval = false;
          this.decline = false;
          
          this.docappro = "new";
          this.docuaprovaltrue.emit("approved");

        }
        else if(this.arr.length == 0)
            {
              this.newone = false;
              this.approval = false;
              this.decline = false;
            }
        else
         {
          this.approval = true;
          this.decline = false;
          this.newone = false;

          this.docappro = "approved"; 
          this.docuaprovaltrue.emit("approved");




        }


      })




    })
  }
  page: number = 10;
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.paginator.page.emit(event)



  }
  clearFilter() {
    this.documentname_filter.setValue("");
    this.documentprovided_filter.setValue("");
    this.status_filter.setValue("");
    this.addon.setValue("");
    this.lastdate.setValue("");
    this.applicationservice.getdocumenttab(this.app_ref_id).subscribe(res => {
      this.tblplaceholder = true;
                this.documentsrecord = new MatTableDataSource(res.data);
                this.documentsrecord.paginator = this.paginator;
                this.documentsrecord.filterPredicate = this.createFilter();
      
                this.arr = [];
                // if(res.data.length==0){
                  
                // }
                this.documentsrecord.filteredData.forEach(data => {
                  this.arr.push(data.status);
      
                  if (this.arr.includes('4')) {
                    this.approval = false;
                    this.decline = true;
                    this.docappro = "decline"; 
              this.docuaprovaltrue.emit("decline");
      
      
                  }
                  else {
                    this.approval = true;
                    this.decline = false;
                    this.docappro = "approved"; 
                    this.docuaprovaltrue.emit("approved");
      
      
      
                  }
      
      
                })
                    setTimeout(() => {
                      this.tblplaceholder = false;
                    }, 2000);
      
      
              })
            }
            onBooleanValue(value: boolean) {
              this.disableSubmitButton = value;
          }
}
