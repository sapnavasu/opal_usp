import {
    ChangeDetectorRef,
    Component,
    OnDestroy,
    Output,
    EventEmitter,
    Input,
  } from '@angular/core';
  import { PerfectScrollbarConfigInterface } from 'ngx-perfect-scrollbar';
  import { MediaMatcher } from '@angular/cdk/layout';
  import { MenuItems } from '@shared/menu-items/menu-items';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { Router } from '@angular/router';
import swal from 'sweetalert';

@Component({
    selector: 'app-superadminsidebar',
    templateUrl: './superadminsidebar.component.html',
    styleUrls: []
})
export class SuperadminsidebarComponent {
  @Output("parentFun") parentFun: EventEmitter<any> = new EventEmitter();
    public config: PerfectScrollbarConfigInterface = {};
  mobileQuery: MediaQueryList;

  @Input() showClass: boolean = false;
  @Output() notify: EventEmitter<boolean> = new EventEmitter<boolean>();

  private _mobileQueryListener: () => void;
  status = true;
  showMenu = '';
  itemSelect: number[] = [];
  parentIndex = 0;
  childIndex = 0;
  user_name: any;
  designation: any;
  stktype: any;
  approved: string;
  disablemenu: boolean = false;
  companylogo: any;
  focalpoint: any;

  addExpandClass(element: any) {
    if (element === this.showMenu) {
      this.showMenu = '0';
    } else {
      this.showMenu = element;
    }
  }

  subclickEvent(): void {
    this.status = true;
  }
  scrollToTop(): void {
    document.querySelector('.page-wrapper').scroll({
      top: 0,
      left: 0,
    });
  }

  constructor(
    changeDetectorRef: ChangeDetectorRef,
    media: MediaMatcher,
    public localstorageservice:AppLocalStorageServices,
    public menuItems: MenuItems,
    private router: Router,
    
  ) {
    this.mobileQuery = media.matchMedia('(min-width: 768px)');
    this._mobileQueryListener = () => changeDetectorRef.detectChanges();
    // tslint:disable-next-line: deprecation
    this.mobileQuery.addListener(this._mobileQueryListener);
    this.user_name = this.localstorageservice.getInLocal('user_name');
    this.designation = this.localstorageservice.getInLocal('designation');
    this.companylogo = this.localstorageservice.getInLocal('companylogo');
    this.stktype =  this.localstorageservice.getInLocal("stktype");
    this.approved = localStorage.getItem('mainorbranch');
    this.focalpoint = this.localstorageservice.getInLocal("isadmin");
    if(this.stktype == 2 && (this.approved && this.approved != '2')){
        this.disablemenu = true;
    }else{
      this.disablemenu = false;
    }
   
  }

  ngOnDestroy(): void {
    // tslint:disable-next-line: deprecation
    this.mobileQuery.removeListener(this._mobileQueryListener);
  }

  handleNotify() {
    if (window.innerWidth < 1024) {
      this.notify.emit(!this.showClass);
    }
  }
  contactsidenavdata(){
    this.parentFun.emit();
}
  // checkuserpermission(link, name){
  //   let useraccess = this.localstorageservice.getInLocal('uerpermission');
  //   if(name == 'Learner Card Log'){
  //     let moduleid = this.localstorageservice.getaccessmoduleid(this.stktype, 'Learner Card Log');
  //     if(this.focalpoint == 1 && this.stktype == 1){
  //       this.router.navigate([link]);
  //     }else if(this.focalpoint != 1 && this.stktype == 1 && useraccess[moduleid] && useraccess[moduleid][18] && useraccess[moduleid][18].read == 'Y'){
  //       this.router.navigate([link]);
  //     }else{
  //       swal({
  //         title: "You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
  //         text: '',
  //         icon: 'warning',
  //         buttons: [false, 'OK'],
  //         dangerMode: true,
  //         className: 'swalEng',
  //         closeOnClickOutside: false
  //       }).then((willGoBack) => {
  //         if (willGoBack) {
  //           this.router.navigate(['/dashboard/portaladmin'])
  //         }
  //        });
  //     }
  //   }
  //   if(name == 'Learner Feedback'){
  //     let moduleid = this.localstorageservice.getaccessmoduleid(this.stktype, 'Learner Feedback');
  //     if((this.focalpoint == 1 && this.stktype == 1) || (this.focalpoint == 1 && this.stktype == 2)){
  //       this.router.navigate([link]);
  //     }else if(this.focalpoint != 1 && this.stktype == 1 && useraccess[moduleid] && useraccess[moduleid][9] && useraccess[moduleid][9].read == 'Y'){
  //       this.router.navigate([link]);
  //     }else if(this.focalpoint != 1 && this.stktype == 2 && useraccess[moduleid] && useraccess[moduleid][26] && useraccess[moduleid][26].read == 'Y'){
  //       this.router.navigate([link]);
  //     }else{
  //       swal({
  //         title: "You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance.",
  //         text: '',
  //         icon: 'warning',
  //         buttons: [false, 'OK'],
  //         dangerMode: true,
  //         className: 'swalEng',
  //         closeOnClickOutside: false
  //       }).then((willGoBack) => {
  //         if (willGoBack) {
  //           this.router.navigate(['/dashboard/portaladmin'])
  //         }
  //        });
  //     }
  //   }

  // }

}
