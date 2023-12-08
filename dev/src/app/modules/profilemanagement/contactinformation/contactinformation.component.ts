import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { FormGroup } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatDrawer } from '@angular/material/sidenav';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { environment } from '@env/environment';
import 'rxjs/add/observable/of';
import { ProfileService } from '../profile.service';

@Component({
  selector: 'app-contactinformation',
  templateUrl: './contactinformation.component.html',
  styleUrls: ['./contactinformation.component.scss']
})
export class ContactinformationComponent implements OnInit {

  @ViewChild('drawer') drawer: MatDrawer;
  @ViewChild('paginator') paginator: MatPaginator;
  @Input() panel: number;
  @Input() panelNo: number;
  @Output() selectedPanel: any = new EventEmitter<any>();
  @Input() listdata: any;
  @Input() logoUrl: string;
  @Input() achivementData: any;   
  panelOpenState: boolean = false;
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  color = 'success';
  mode = 'determinate';
  value = 50;
  bufferValue = 75;
  public buttonname: string = "Add";
  public page: number = 1;
  @Input() perpage: number;
  @Input() paginationSet: number;
  @Input() resultsLength: number;
  public searchmarketpresence: string = '';
  @Input() overallcnt: number;
  public companypk: number;
  public encryptedcompanypk: string = '';
  public formGroup: FormGroup;
  public search = '';
  public loadAddComponent: boolean = false;
  public lusrtpye: string;
  public useraccess: any;
  @Input() locationType: number;
  @Input() countrylist: any = [];
  @Input() companyname: string;

  /*Notify Content*/
  public dyHelpContent: any = {
    'title': 'Fill in the details of your registered branch office. Branch offices are outlets at different locations that do not constitute a separate legal entity.',
    'boldHeading': 'Steps to add your Branch office:',
    'list': [
      {
        'content': 'You can either fill in the address of your Branch office in the google map.'
      },
      {
        'content': 'Or update the location details of your Branch office in the respective fields.'
      }
    ]
  };
  constructor(private profileService: ProfileService,
    private localStorage: AppLocalStorageServices,
    private security: Encrypt) { }



  ngOnInit() {
    this.lusrtpye = this.localStorage.getInLocal('usertype');
    if (this.lusrtpye == 'U') {
      this.useraccess = this.localStorage.getInLocal('uerpermission');
    }
    this.companypk = this.localStorage.getInLocal('comp_pk');
    this.encryptedcompanypk = this.security.encrypt(this.companypk);
  }

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }
  onPaginateChange(event) {
    this.perpage = event.pageSize;
    this.page = parseInt(event.pageIndex) + 1;
    this.getMarketPresenceList(this.encryptedcompanypk, this.locationType, this.page, this.perpage, this.search);
  }

  getMarketPresenceList(companypk, type, pageno, perpage, search?: string, updateresultlength?: boolean) {
    this.profileService.getMarketPresenceList(companypk, type, pageno, perpage, search).subscribe(data => {
      this.listdata = data['data'].items.data;
      this.overallcnt = data['data'].items.overallcount;
      if (updateresultlength) {
        this.resultsLength = data['data'].items.count;
      }
    })
  }

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth' });
    } catch (error) {
      console.log('page-content')
    }
  }

  updatedList(value: any) {
    if (!value.isDelete) {
      this.paginator.firstPage();
    }
    this.listdata = value.data;
    this.resultsLength = value.count;
    this.overallcnt = value.overallcount;
  }

  openPrev() {
    this.panel = this.panel - 1;
    this.selectedPanel.emit(this.panel);
  }

  openNext() {
    this.panel = this.panel + 1;
    this.selectedPanel.emit(this.panel);
  }

  onFilterSubmit() {
    this.getMarketPresenceList(this.encryptedcompanypk, this.locationType, this.page, this.perpage, this.searchmarketpresence, true);
  }
  addbranchoff() {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[21] && this.useraccess[21].create == 'Y')) {
      this.drawer.toggle();
    } else {
      this.security.userpermissionpop();
    }
  }
  edit(data: any) {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[21] && this.useraccess[21].update == 'Y')) {
      this.loadAddComponent = true;
      setTimeout(() => {
        
      }, 10);
    } else {
      this.security.userpermissionpop();
    }
  }

  delete(pk: number, page: number, search?: string) {
    if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[21] && this.useraccess[21].delete == 'Y')) {
      this.loadAddComponent = true;
      if (this.listdata.length == 1) {
        page = page - 1;
        this.paginator.pageIndex = this.paginator.pageIndex - 1;
      }
      setTimeout(() => {
       
      }, 10);
    } else {
      this.security.userpermissionpop();
    }
  }

}
