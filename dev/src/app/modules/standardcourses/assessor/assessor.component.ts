import { Component, ElementRef,EventEmitter, Input, OnInit,Output,ViewChild,ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { ActivatedRoute, ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { LocaleConfig } from 'ngx-daterangepicker-material';
import moment, { Moment } from 'moment';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { MatSort } from '@angular/material/sort';
import swal from 'sweetalert';
import { ApplicationService } from '@app/services/application.service';
import { Encrypt } from '@app/common/class/encrypt';
import { ToastrService } from 'ngx-toastr';
import { MatSelect } from '@angular/material/select';
import { TrainingStaffService } from '@app/services/trainingStaff.service';
import { subscribeTo } from 'rxjs/internal-compatibility';
import { Location } from '@angular/common';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Datepickermodal } from '@app/@shared/datepickermodal/datepickermodal';
import { MatDialog } from '@angular/material/dialog';

export interface TrainingData {
  date: Date;
  status: any;
  time: any;
  action: any;
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

@Component({
  selector: 'app-assessor',
  templateUrl: './assessor.component.html',
  styleUrls: ['./assessor.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ],
})
export class AssessorComponent implements OnInit {
  staffinfodata: any;
  griddata =[];
  search: { startdate: string; enddate: string; status: any; };
  @Input() public set accessordata(value: any) {
    this.pk = value;
    if(this.pk != undefined){
      
      this.getaccessorscheduledtls(10,0,null)
    }
  }
  public get accessordata() {
    return this.pk;
  }

@ViewChild(MatSelect) select: MatSelect;
@Input() applicationtype:any;
  // @Input() public set applicationtype(type: any) {
  //   this.applicationtype = type;
  // }
  // public get applicationtype() {
  //   console.log('------------------------------------')
  //   console.log(this.applicationtype)
  //   return this.applicationtype;
  // }
  TrainingDate = ['date', 'time', 'status', 'action'];
  TrainingtimeData;
  hidefilder: any;
  tblplaceholder: boolean;
  resultsLength: any;
  pk: any;
  training: boolean=false;
  staffpK: any;
  updateData: any;
  selectedDaterange: any = '';
  selectedEndTime: any = '';
  selectedStartTime: any = '';
  i18n(key) {
    return this.translate.instant(key);
  }
  filtername = "Hide Filter";
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  public regpk: any;
  downloadaccess: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;  availabelDate: FormGroup;
  today = new Date();
  updated: boolean = true;
  @ViewChild("paginator") paginator: MatPaginator;
  public page: any =10;
  reqformst = [];
  @Output() cancle = new EventEmitter<void>();
  @Output() subdate = new EventEmitter<void>();
  minDate: Moment;
  @ViewChild('selectedDateInput', { static: false }) selectedDateInput: ElementRef;

  @ViewChild(MatSort) sort: MatSort;
  minTime: Date = new Date();
  maxTime: Date = new Date();
  minAfterTime: Date = new Date();
  maxAfterTime: Date = new Date();
  minselectTime: Date = new Date();
  addeddate = new FormControl('');
  status = new FormControl('');
  public disableSubmitButton: boolean = false;
  constructor(private formBuilder: FormBuilder, private el: ElementRef, private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private appservice: ApplicationService,
    private trainingstaff: TrainingStaffService,
    private _location: Location,
    public commonDialog: MatDialog,
    private localstorage: AppLocalStorageServices,
    private secuirty: Encrypt,public toastr: ToastrService,
    public routeid: ActivatedRoute,public router: Router) { 
      this.minTime.setHours(6, 0, 0); 
      this.maxTime.setHours(12, 0, 0);
      this.minAfterTime.setHours(12, 0, 0); 
      this.maxAfterTime.setHours(18, 0, 0);
      this.minselectTime.setHours(6, 0, 0);
      this.minDate = moment();

    }
    locale: LocaleConfig = {
      format: 'DD-MM-YYYY',
    }
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
    public ifarbic: boolean = false;
    languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
    dir = 'ltr';
    @ViewChild('availabelFormRest') availabelFormRest: FormGroupDirective;
    public editDateavailabilty = false;
  ngOnInit(): void {

    this.useraccess = this.localstorage.getInLocal('uerpermission');
    console.log(this.useraccess,'this.useraccess');
     this.stktype = this.localstorage.getInLocal('stktype');
     this.regpk = this.localstorage.getInLocal('registerPk');
     this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
     let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Staff Management');
 
     if (this.isfocalpoint == 1) {
       this.downloadaccess = true;
       this.readaccess = true;
       this.createaccess = true;
       this.updateaccess = true;
       this.deleteaccess = true;
     }
     let submodule = this.stktype == 1 ? 32 : 38;
     console.log('moduleid',moduleid);
     console.log('submodule',submodule);
     console.log('stktype',this.stktype);
     
     if (this.isfocalpoint == 2 && this.useraccess[moduleid] != undefined) {
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].download == 'Y') {
         this.downloadaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].read == 'Y') {
         this.readaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].create == 'Y') {
         this.createaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].update == 'Y') {
         this.updateaccess = true;
       }
       if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].delete == 'Y') {
         this.deleteaccess = true;
       }
     }

    this.routeid.queryParams
    .subscribe(params => {
      
      if(params.id){
        this.pk = this.secuirty.decrypt(params.id)
        this.training = true;
        this.getaccessorscheduledtls(10,0,null)        
      }
      if(params.staffpK){
        this.staffpK = this.secuirty.decrypt(params.staffpK)
        this.appservice.editBooking(this.staffpK).subscribe((data: any) => {
          if (data?.data?.status == true) {
            // this.toastr.success(data?.data?.message);
              this.updateData = data?.data?.data;
              this.selectedStartTime = new Date(this.patchdates(this.updateData?.assd_starttime));
              this.selectedEndTime = new Date(this.patchdates(  this.updateData?.assd_endtime))
              this.availabelDate.controls['startDate'].setValue(this.selectedStartTime);
              this.availabelDate.controls['EndDate'].setValue(this.selectedEndTime);
              this.editDateavailabilty =  true;
              this.selectedDaterange = {
              startDate: new Date(this.updateData?.assd_starttime),
              endDate: new Date(this.updateData?.assd_endtime)
            }
            this.availabelDate.controls['selectedDate'].setValue(this.selectedDaterange);

          } else {
            this.toastr.warning(data?.data?.message);
          }
    
        })      
      }
    }
    );
   this.stktype = this.localstorage.getInLocal('stktype');
    this.remoteService.getbreadcrumCookieoutput().subscribe(data => { 
      if(data == 4){
        this.cancle.emit()
      }
    });
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.filtername = "Hide Filter";
      } else {
        this.filtername = "إخفاء التصفية";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.filtername = "Hide Filter";
    }
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.filtername = "Hide Filter";
        } else {
          this.filtername = "إخفاء التصفية";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.filtername = "Hide Filter";
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }
    });
    this.FormValidate();
    this.availabelDate.controls['startDate'].valueChanges.subscribe(value => {
      this.availabelDate.controls['EndDate'].reset();
      // if(this.availabelDate.controls['startDate'].value == ) {

      // }
    })
    this.addeddate.valueChanges.debounceTime(400).subscribe(
      register => {
        if (register != null) {
          this.applyFilter('test','test')
        } else if (register == '') {
         
        }
      }
    )
  }
  updateTime() {
    //  this.
  }
  patchdates(value)
  {
    let start = new Date();
    let strattime = moment(start).format('YYYY-MM-DD').toString()+' '+moment(value).format('HH:mm:00').toString();
    return strattime;
  }
  FormValidate() {
    this.availabelDate = this.formBuilder.group({ 
      selectedDate: ['', Validators.required],
      startDate: ['', Validators.required],
      EndDate: ['', Validators.required],
    })

  
  }
  get form() { return this.availabelDate.controls; }
  clear() {
    if(this.availabelDate.touched) {
      swal({
        title: this.i18n('Do you want cancel add Assessor Availability?'),
        text: this.i18n('maincenter.doyouwantnote'),
        icon: 'warning',
        buttons: [this.i18n('uploadfile.no'), this.i18n('uploadfile.yes')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          if(this.editDateavailabilty == false){
            this.availabelDate.reset();
          }else{
            this.editDateavailabilty=true;
            this.availabelDate.controls['startDate'].reset();
            this.availabelDate.controls['EndDate'].reset();
          }
        }
      });
    }else {
      if(this.editDateavailabilty == false){
        this.availabelDate.reset();
      }else{
        this.editDateavailabilty=true;
        this.availabelDate.controls['startDate'].reset();
        this.availabelDate.controls['EndDate'].reset();
      }
    }
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('table.show');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('table.hide');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;

    this.getaccessorscheduledtls(this.paginator.pageSize, this.paginator.pageIndex, this.search)
  }
  getaccessorscheduledtls(limit, page, searchkey) {
    this.tblplaceholder = true;
    this.disableSubmitButton = true;
    this.appservice.getaccessorscheduledtls(this.pk,limit, page, searchkey).subscribe(res => {
      this.disableSubmitButton = false;
      if (res.status == 200) {
        this.tblplaceholder = false;
        this.staffinfodata =  res.data.staffgrid;
        // if(this.staffinfodata?.sir_idnumber){
        //   let encregpk = this.secuirty.encrypt(this.staffinfodata.sir_idnumber);
        //   localStorage.setItem('civil',encregpk) //todo
        // }
        this.griddata = res.data.accessorlist;
        this.griddata.forEach(item => {
          console.log('---------------')
          console.log(item)
          this.griddata['date'] = new Date(item.date);
        });
        this.TrainingtimeData = new MatTableDataSource<TrainingData>(this.griddata);

        this.resultsLength = res.data.totalcount;
        this.TrainingtimeData.sort = this.sort;
      }
    });

  }
 
  clearFiltersecound() {
    this.addeddate.setValue("");
    this.status.setValue("");
    // setTimeout(() => {
      this.getaccessorscheduledtls(this.page, 0, null);

    // }, 6000);
   
  }
  submitdata(){
   
    if(this.availabelDate.controls.selectedDate.value.startDate == 'null' || this.availabelDate.controls.selectedDate.value.startDate == null ){
      this.selectedDateInput.nativeElement.focus();
      return false;
    }
    if(this.availabelDate.valid) {
      let formvalue =this.availabelDate.value;
      formvalue.EndDate =moment(formvalue.EndDate).format('HH:mm:ss').toString();
      formvalue.startDate =moment(formvalue.startDate).format('HH:mm:ss').toString();
      formvalue.selectedDate.startDate   = moment(formvalue.selectedDate.startDate).format('YYYY-MM-DD').toString();
      formvalue.selectedDate.endDate   = moment(formvalue.selectedDate.endDate).format('YYYY-MM-DD').toString();

      this.disableSubmitButton = true;
     this.appservice.saveaccessorscheduledtls(this.pk,formvalue).subscribe(res => {
      if (res.status == 200) {
      if(res.data?.isTimeAvailable == false){
         this.disableSubmitButton = false;
         // this.toastr.success('This Staff member is already booked for the selected date and time. Kindly select a different date and time.', ''), {
         //   timeOut: 2000,
         //   closeButton: false,
         // };
         swal({
           title: this.i18n('The selected date and time is already scheduled for the staff. Please Choose a different date and time.',),
           text: '',
           icon: 'warning',
           buttons: [false, this.i18n('OK')],
           dangerMode: true,
           className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
           closeOnClickOutside: false
         })
       }else if(res.data?.isTimeAvailable_other == false){
         this.disableSubmitButton = false;
         swal({
           title: this.i18n('This Staff member is already booked for the selected date and time with different course. Kindly select a different date and time.',),
           text: '',
           icon: 'warning',
           buttons: [false, this.i18n('OK')],
           dangerMode: true,
           className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
           closeOnClickOutside: false
         })
       }else{
          this.getaccessorscheduledtls(10,0,null);
          this.availabelDate.reset();
            this.toastr.success(this.i18n('Successfully Added Assessor Availability'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
        }
        this.availabelFormRest.reset();


      }
    });
    this.editDateavailabilty = false;
    }else {
      this.focusInvalidInput(this.availabelDate);
    }
  }
  updateaccessorinfo(pk,value){
    this.appservice.updateaccessorscheduledtls(pk,value).subscribe(res => {
      if (res.status == 200) {
        this.getaccessorscheduledtls(10,0,null);
        this.availabelDate.reset();
      }
    });
  }
  applyFilter(serch, key) {
    console.log(this.addeddate.value?.startDate)
    if(this.addeddate.value?.startDate != 'undefind' && this.addeddate.value?.startDate != 'Invalid date' && this.addeddate.value?.startDate != 'null' && this.addeddate.value?.startDate != null){
    var startDate =  moment(this.addeddate.value?.startDate).format('YYYY-MM-DD').toString();
    var enddate =  moment(this.addeddate.value?.endDate).format('YYYY-MM-DD').toString();
    }
   this.search = {
      startdate: startDate,
      enddate: enddate,
      status:this.status.value
    };
    this.select.close();
    this.paginator.pageIndex = 0;
    this.getaccessorscheduledtls(this.page, 0, this.search);

  }

  navigatebatch(pk,date){
    
    let encregstaffinfotmppk = this.secuirty.encrypt(pk);
    this.disableSubmitButton = true;
    this.appservice.getbatchids(pk,date).subscribe(res => {
      // this.disableSubmitButton = false;
      if (res.status == 200) {
        var batchpk = res.data.batchpk;
        this.router.navigate(['/batchindex/batchgridlisting'],{ queryParams: { p: batchpk,t:'fsgrid',d:date }});
      }
    });
   

  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
         console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }

  // traininig
  edit(staffpK: any,course:any) {
    // // let encregpk = this.security.encrypt(id);

    // localStorage.setItem('civil',btoa(this.pk))
    // localStorage.setItem('course',btoa(course))
    this.router.navigate(['/standardcourse/assessoravailability/edit'], { queryParams: { id: btoa(this.pk), staffpK: btoa(staffpK)} });
}

   editData() {
    if (this.availabelDate.controls.selectedDate.value.startDate == 'null' || this.availabelDate.controls.selectedDate.value.startDate == null) {
      this.selectedDateInput.nativeElement.focus();
      return false;
    }
    if (this.availabelDate.valid) {
      let formvalue = this.availabelDate.value;
      formvalue.id = this.staffpK;
      formvalue.EndDate = moment(formvalue.EndDate).format('HH:mm:ss').toString();
      formvalue.startDate = moment(formvalue.startDate).format('HH:mm:ss').toString();
      formvalue.selectedDate.startDate = moment(formvalue.selectedDate.startDate).format('YYYY-MM-DD').toString();
      formvalue.selectedDate.endDate = moment(formvalue.selectedDate.endDate).format('YYYY-MM-DD').toString();
      formvalue.staffinfo = this.updateData?.assd_appstaffinfotmp_fk;

      this.appservice.updateBooking(formvalue).subscribe((data: any) => {
        if (data?.data?.status == true) {
          this.toastr.success(data?.data?.message);
          // this.availabelFormRest.reset();
          this.getaccessorscheduledtls(10,0,null);
        } else {
          swal({
            title: this.i18n(data?.data?.message),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('OK')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          })
        }
      })
      // this.editDateavailabilty = false;
    } else {
      this.focusInvalidInput(this.availabelDate);
    }
  }

  viewtechButton(type, id: any, course: any) {
    if (type == 'viewstaff') {
      this.router.navigate(['/approvalstaffmanagement/trainingcentreview'], { queryParams: { id: btoa(id),'course': btoa(course) } });
      localStorage.setItem('typeView', type)
    } else if (type == 'viewAvailabilty') {
      this.router.navigate(['approvalstaffmanagement/trainingavailability'], { queryParams: { id: btoa(id),'course': btoa(course)  } });
      localStorage.setItem('typeView', type)
    } else if (type == 'addStaff') {
      this.router.navigate(['/standardcourse/assessoravailability/add'], { queryParams: { id: btoa(id) } });
      localStorage.setItem('typeView', type)
    }
  }

  openDatepickerDialog(civil:any,staffInfoTemp:any,staff:any,course:any,coursePk:any) {
    const dialogRef = this.commonDialog.open(Datepickermodal, {
      panelClass: 'availabiltyModel',
      data: {
        title: 'Select Date To Export Data',
        inputName: 'Folder Name',
        noButtonText: 'Cancel',
        submitButtonText: 'Export',
        civil: civil,
        staffInfoTemp: staffInfoTemp,
        staff: staff,
        course: course,
        coursePk: coursePk,
      }
    });
    dialogRef.afterClosed().subscribe(result => {
        this.disableSubmitButton = true;
        if(result?.civil){
          this.trainingstaff.exportSingle(result.civil, result.staffInfoTemp,result.dateRange,result.coursePk).subscribe((data: any) => {
            console.log(data.data.status, '==========')
            if(data.data.status == 3){
              swal({
                title: this.i18n("No records are available for download within the selected date range."),
                text: '',
                icon: 'warning',
                buttons: [false, this.i18n('Ok')],
                dangerMode: true,
                className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
                closeOnClickOutside: false
              }).then((willGoBack) => {
                this.disableSubmitButton = false;
              });
              return false;
            }
          let response = data.data.attend;
          var link = document.createElement('a');
          link.href = response
          link.click();
          this.disableSubmitButton = false;
          })
        }else{
          this.disableSubmitButton = false;
        }
    });
  }

  
  // Remove from center
  removeCenter(id: any) {
    swal({
      title: this.i18n('Do you want to remove from this Centre?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.trainingstaff.removeStaffCentre(id).subscribe((data: any) => {
          if (data?.data?.status == true) {
            this.router.navigate(['/approvalstaffmanagement/trainingcentre']);
          }else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }

  // download(civil: any, staffinfo: any) {
  //   this.trainingstaff.exportSingle(civil, staffinfo).subscribe((data: any) => {
  //     let response = data.data.attend;
  //     var link = document.createElement('a');
  //     link.href = response
  //     link.click();
  //   })
  // }

   // Genrate Competency
   genrateCompetency(id: any) {
    swal({
      title: this.i18n('Do you want to generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.trainingstaff.genrateCompCrad(id).subscribe((data: any) => {
          this.disableSubmitButton = false;
          console.log("Data", data);
          if (data?.data?.status == true) {
            // this.toastr.success(data?.data?.message);
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
            this.router.navigate(['/approvalstaffmanagement/trainingcentre']);

          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
            // this.toastr.warning(data?.data?.message);
          }
        })
      }
    });
  }
  // Re-Genrate Competency
  reGenrateCompetency(id: any) {
    swal({
      title: this.i18n('Do you want to re-generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.trainingstaff.reGenrateCompCrad(id).subscribe((data: any) => {
          this.disableSubmitButton = false;
          console.log("Data", data);
          if (data?.data?.status == true) {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }

  goback() {
    this._location.back();
  }
  
}
