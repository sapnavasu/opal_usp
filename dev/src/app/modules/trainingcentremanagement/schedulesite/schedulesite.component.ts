import { Component, OnInit,ViewEncapsulation,ViewChild} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl, FormGroupDirective, RequiredValidator } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

interface staf {
  value: string;
  viewValue: string;
}
export interface BranchData {
  position: any;
  applictionno: any;
  dateofexpiry: any;
  applicationstatus: any;
}
const BranchList_Data: BranchData[] = [
  { position: 1, applictionno: 'Khalid Al Hadi',dateofexpiry: '23-04-2024' ,applicationstatus: 'A'},
  { position: 2, applictionno: 'Khalid Al Hadi',dateofexpiry: '23-04-2024' ,applicationstatus: 'Y'},
  { position: 3, applictionno: 'Khalid Al Hadi',dateofexpiry: '23-04-2024' ,applicationstatus: 'P'},
  { position: 4, applictionno: 'Khalid Al Hadi',dateofexpiry: '23-04-2024' ,applicationstatus: 'PV'},
  { position: 5, applictionno: 'Khalid Al Hadi',dateofexpiry: '23-04-2024' ,applicationstatus: 'S'},
  { position: 6, applictionno: 'Khalid Al Hadi',dateofexpiry: '23-04-2024' ,applicationstatus: 'D'},

];
@Component({
  selector: 'app-schedulesite',
  templateUrl: './schedulesite.component.html',
  styleUrls: ['./schedulesite.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class SchedulesiteComponent implements OnInit {
  resultsLength: number;
  filtername = "Hide Filter";
  hidefilder: boolean = true;
  page: number = 10;
@ViewChild("paginator") paginator: MatPaginator;
BranchListData = ['applictionno', 'dateofexpiry' , 'applicationstatus' ,'action'];
  TrainingBranchData = new MatTableDataSource<BranchData>(BranchList_Data);


  sectorFilter: FormControl = new FormControl();
  
  bussrcFilter: FormControl = new FormControl();
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
  ) { }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
    
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
  
  appl_form = new FormControl('');
  appl_status = new FormControl('');
  date_expiry = new FormControl('');

  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = 'Show Filter';
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = 'Hide Filter';
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }
  stafs: staf[] = [
    {value: '0', viewValue: 'dell'},
    {value: '1', viewValue: 'asus'},
    {value: '2', viewValue: 'lenovo'},
  ];

}
