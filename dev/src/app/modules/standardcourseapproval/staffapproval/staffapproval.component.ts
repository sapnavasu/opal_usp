import { SelectionModel } from '@angular/cdk/collections';
import { Component, OnInit, Output, ViewChild, ViewEncapsulation,EventEmitter  } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import {animate, state, style, transition, trigger} from '@angular/animations';
import { ActivatedRoute, Router } from '@angular/router';
import moment from 'moment';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
// import { EventEmitter } from 'protractor';
export interface Staffrecorddata {
  civilnumber: any;
  staffname:any;
  age:any;
  roleforcourse:any;
  cour_subcate:any;
  competencycard:any; 
  status:any;
  addedon:any;
  lastupdated:any;
}

const staffrecord_data: Staffrecorddata[] = [
  { civilnumber: '10610796',staffname:"Ahmed Bin Al Rahman",age:"32",roleforcourse:"Female",cour_subcate:"Temporary",competencycard:"Trainer",status:"A",addedon:"10-10-2021",lastupdated:"10-10-2021"},
  
]; 
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

@Component({
  selector: 'app-staffapproval',
  templateUrl: './staffapproval.component.html',
  styleUrls: ['./staffapproval.component.scss'],
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({height: '0px', minHeight: '0'})),
      state('expanded', style({height: '*'})),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
],
})
export class StaffapprovalComponent implements OnInit {
  [x: string]: any;
  page: number = 10;
  documentname = new FormControl('');
  documentprovided = new FormControl('');
  approved:boolean = false;
  search: { civil_number_filter: any; staff_name_filter: any; rolecourse_filter: any; coursesubcate_filter: any; stat_us_filter: any; addedon_filter: any; last_audit: any; };
  i18n(key) {
    return this.translate.instant(key);
  }
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  newone: boolean = false;
  updatests: boolean = false;
  decline: boolean = false;
  approval: boolean = true;
  current_age:any;
  status = new FormControl('');

  paginationSet =
    BgiJsonconfigServices.bgiConfigData.configuration
      .enterpriseAdminPaginatonSet;
      // expandedElement: Staffrecorddata | null;
      expandedElement: boolean = false;

  @ViewChild("paginator") paginator: MatPaginator;
  staffrecordcolumn = ['civil_number', 'staff_name','age','roleforcourse','cour_subcate','status', 'competencycard' , 'added_on','last_updatedon','action'];
  staffrecorddata = new MatTableDataSource<Staffrecorddata>();
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  resultsLength: number;
  resultsLength1: number = 0;
  app_ref_id:any;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private route: Router,
    private activatedRoute: ActivatedRoute , private applicationservice :ApplicationService,
    private security:Encrypt
  ) { }

  data = 'staff';
  public filterValues = {
    civil_number: '',
    staff_name:'',
    rolecourse:'',
    coursesubcate:'',
    stat_us:'',
  


  };
@Output() staffapprovtrue = new EventEmitter<any>();
staffappro = null;
coursesubcategory: any[]=[];
category_remove: any;
arr :any[]= [];
fail:any;
  ngOnInit(): void {


    
    this.activatedRoute.queryParams.subscribe((params) => {
      this.app_ref_id = params['app_ref_id'];
    
    

      if(this.app_ref_id == '' || this.app_ref_id == undefined)
      {
        return false;
      }
      else{
        this.getstafftabdata(10,0,null)
        this.applicationservice.getstafftab(this.app_ref_id).subscribe(res =>
          {
           
        // this.staffrecorddata = new MatTableDataSource<Staffrecorddata>(res.data);

        this.arr=[];
        this.staffrecorddata.filteredData.forEach(data =>{

          this.arr.push(data.status);
        })
      if(this.arr.includes('4'))
      {
       
        this.approval = false;
        this.updatests = false;
        this.decline = true;
        this.newone = false;
        this.updatests = false;
       this.staffappro = "decline";

        this.staffapprovtrue.emit();
        
      }else if(this.arr.includes('5'))
      {
        this.newone = false;
        this.fail = true;
        this.decline = false;
        this.approval = false;
        this.staffappro = "staffnew";
        this.staffapprovtrue.emit();
      }
      
      else if(this.arr.includes('1'))
      {
        this.newone = true;
        this.decline = false;
        this.approval = false;
        this.staffappro = "staffnew";
        this.updatests = false;
        this.staffapprovtrue.emit();
      }else if(this.arr.includes('2'))
      {
        this.newone = false;
        this.decline = false;
        this.approval = false;
        this.updatests = true;
        this.staffappro = "updated";
        this.staffapprovtrue.emit();
        
      }
      else  if(this.arr.includes('3') && !this.arr.includes('2') ){

        this.approval = true;
        this.decline = false;
        this.newone = false;
        this.updatests = false;
        this.staffappro = "approved";
        this.staffapprovtrue.emit();
      }
        
    
     

        
        this.staffrecorddata.paginator = this.paginator;

        this.tblplaceholder = false;
       
        const status = res.data[0].status;
        if(status == 3)
        {
        this.approved = true;
        
        }
        else if(status == 4)
        {
          this.approved = false;

        }
           
          })
      }

    });



    
    // this.civil_number_filter.valueChanges
    // .subscribe(
    //   civil_number => {
    //     this.filterValues.civil_number = civil_number.toLowerCase();
    //     console.log(civil_number);
    //     this.staffrecorddata.filter = JSON.stringify(this.filterValues);
    //     this.staffrecorddata.filterPredicate = this.createFilter();
    //   }
    // )

    // this.staff_name_filter.valueChanges
    // .subscribe(
    //   staff_name => {
    //     this.filterValues.staff_name = staff_name;
    //     console.log(staff_name);
    //     this.staffrecorddata.filter = JSON.stringify(this.filterValues);
    //     this.staffrecorddata.filterPredicate = this.createFilter();
    //   }
    // )

    // this.rolecourse_filter.valueChanges
    // .subscribe(
    //   rolecourse => {
    //     this.filterValues.rolecourse = rolecourse.toLowerCase();
    //     console.log(rolecourse);
    //     this.staffrecorddata.filter = JSON.stringify(this.filterValues);
    //     this.staffrecorddata.filterPredicate = this.createFilter();
    //   }
    // )
    

    // this.coursesubcate_filter.valueChanges
    // .subscribe(
    //   coursesubcate => {
    //     this.filterValues.coursesubcate = coursesubcate.toLowerCase();
    //     console.log(coursesubcate);
    //     this.staffrecorddata.filter = JSON.stringify(this.filterValues);
    //     this.staffrecorddata.filterPredicate = this.createFilter();
    //   }
    // )

    
    // this.stat_us_filter.valueChanges
    // .subscribe(
    //   stat_us => {
    //     this.filterValues.stat_us = stat_us.toLowerCase();
    //     console.log(stat_us);
    //     this.staffrecorddata.filter = JSON.stringify(this.filterValues);
    //     this.staffrecorddata.filterPredicate = this.createFilter();
    //   }
    // )
    
 
    
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
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
      } else {
        this.filtername = "إخفاء التصفية";
      }
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
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
        } else {
          this.filtername = "إخفاء التصفية";
        }
      }
    });
  }

  getstafftabdata(limit,page,searchkey){
    this.tblplaceholder = true;
    this.applicationservice.getstafftabdata(this.app_ref_id,limit,page,searchkey).subscribe(res =>
      { this.tblplaceholder = false;
        this.staffrecorddata = new MatTableDataSource<Staffrecorddata>(res.data.arr);
        this.resultsLength1 = res.data.totalcount;
      })
  }
  applyFilter(serch, key) {
  this.search ={
    civil_number_filter:this.civil_number_filter.value,
    staff_name_filter:this.staff_name_filter.value,
    rolecourse_filter:this.rolecourse_filter.value,
    coursesubcate_filter:this.coursesubcate_filter.value,
    stat_us_filter:this.stat_us_filter.value,
    addedon_filter:this.addedon_filter.value,
    last_audit:this.last_audit.value

  }
  this.getstafftabdata(this.paginator.pageSize, this.paginator.pageIndex, this.search)
  
  }
  clearFilter(){
      this.civil_number_filter.setValue("");
      this.staff_name_filter.setValue("");
      this.rolecourse_filter.setValue("");
      this.coursesubcate_filter.setValue("");
      this.stat_us_filter.setValue("");
      this.addedon_filter.setValue("");
      this.last_audit.setValue("");
      this.getstafftabdata(10,0,null)

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
  
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('staff.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('staff.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  civil_number_filter = new FormControl('');
  staff_name_filter = new FormControl('');
  ag_e = new FormControl('');
  rolecourse_filter = new FormControl('');
  coursesubcate_filter = new FormControl('');
  stat_us_filter = new FormControl('');
  last_audit = new FormControl('');
  addedon = new FormControl('');
  addedon_filter = new FormControl('');
  comp = new FormControl('');
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
    this.getstafftabdata(this.paginator.pageSize, this.paginator.pageIndex, null)
    // this.paginator.page.emit(event)

  }
  viewpage(data) {
    this.route.navigate(['/standardcourseapproval/staffview'],{ queryParams: { staff_id:data.staffinforepo_pk, asit:this.security.encrypt(data.appostaffinfotmp_pk) }});
  }
  toggleExpansion() {
    this.expandedElement = !this.expandedElement;  
  }

  calculateAge(age)
  {
    const birthDate = new Date(age);
    const currentDate = new Date();
    const diffInMs = currentDate.getTime() - birthDate.getTime();
    const ageDate = new Date(diffInMs);
    const years = Math.floor(diffInMs / (1000 * 60 * 60 * 24 * 365.25));
    const months = Math.floor((diffInMs % (1000 * 60 * 60 * 24 * 365.25)) / (1000 * 60 * 60 * 24 * 30.44));
    const days = Math.floor((diffInMs % (1000 * 60 * 60 * 24 * 30.44)) / (1000 * 60 * 60 * 24));

    this.current_age = { years };
    // this.current_age = { years, months, days };
  
  }


        
  createFilter(): (data: any, filter: string) => boolean {

// this.tblplaceholder = true;

    let filterFunction = function (data, filter): boolean {

      let searchTerms = JSON.parse(filter);

      return data?.civilnumber?.toLowerCase().indexOf(searchTerms.civil_number) !== -1  && 
       data?.staffname?.toLowerCase().indexOf(searchTerms.staff_name) !== -1  && 
       data?.roleforcourse?.toLowerCase().indexOf(searchTerms.rolecourse) !== -1  &&
       data?.cour_subcate?.toLowerCase().indexOf(searchTerms.coursesubcate) !== -1 &&       
       data?.status?.toLowerCase().indexOf(searchTerms.stat_us) !== -1      

    }
  //  setTimeout(() => {
  //   this.tblplaceholder = false;
  //  }, 2000);
    return filterFunction;
  }
  rolofcourse:any;

  splitFunction(val) 
  {
   
    this.rolofcourse = val.split(','); 
    this.rolofcourse_remove = val.split(','); 
    this.rolofcourse_remove.shift(); 
  } 
  splitCourseFunction(data) {
    this.coursesubcategory = data.split(',');
    this.category_remove = data.split(',');
    this.category_remove.shift();
    return this.coursesubcategory[0];
  }
}
