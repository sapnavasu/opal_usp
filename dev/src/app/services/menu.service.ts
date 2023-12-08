import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable()
export class MenuService {

  private breadcrumbArray = new BehaviorSubject<any>([]);
  constructor() { }


  getMenu(): Array<any> {
    const menu = [
      { 
        name: 'Enterprise Admin', 
        path: './enterpriseadmin', 
        redirectTo: './landingpage',
        show:true,
        disablelink: false, 
        children: [
          { name: 'Landing', path: './landingpage',show:true},
          { name: 'Divisions', path: './divisions',show:true},
          { name: 'Departments', path: './department',show:true},
          { name: 'Users', path: './usermanagement',show:true},
          { name: 'Invited Users', path: './inviteduser',show:true},
          { name: 'SkyCards Management', path: './skycardlandingpage',show:true},
          { name: 'View SkyCards', path: './viewskycarddetail',show:true},
          { name: 'Received SkyCards', path: './collaboratereceivedcarddetail',show:true},
        ] 
      },
      // { 
      //   name: 'SkyCards Management', 
      //   path: './skycardlandingpage', 
      //   children: [],
      //   show:true,
      //   disablelink: false, 
      // },
      { 
        name: 'Master Company Profile', 
        path: './profilemanagement', 
        redirectTo: './landingpage',
        show:true,
        disablelink: false, 
        children: [
          { name: 'Landing', path: './landingpage',show:true},
          { name: 'Company Information', path: './companyinformation',show:true},
          { name: 'About Company', path: './aboutcompany',show:true},
          { name: 'Accomplishments',path: './masteraccomplishment',show:true},
          { name: 'Market Presence', path: './marketpresence',show:true},
          { name: 'Web Presence', path: './webpresence',show:true},
          { name: 'Board & Management', path: './boardmembers',show:true},
        ] 
      },
      { 
        name: 'Supplier Profile', 
        path: './source', 
        redirectTo: './bsourcelist',
        show:true,
        disablelink: false, 
        children: [
          { name: 'Business Source Listing', path: './bsourcelist',show:true},
          { name: 'Business Source Map to Division', path: './business',show:true},
        ] 
      },      
      { 
        name: 'Supplier Certification Form (SCF)', 
        portalName: 'JSRS Certification Approval',
        path: './scf', 
        redirectTo: './scf/dashboard',
        portalRedirectTo: './scf/prioritylisting',
        show:true, 
        disablelink: false,
        children: [
          { name: 'Certification Contact', path: './scfform',show:false,
            children: [
              { name: 'JSRS Certification Contact', path: './24', show:true,},
              { name: 'Corporate Summary', path: './2', show:true},
              { name: 'Financials', path: './3',show:true},
              { name: 'Products/Services', path: './4', show:true},
              { name: 'QMS/HSE', path: './5', show:true},
              { name: 'In-Country Value (ICV) Elements', path: './7', show:true},
              { name: 'References', path: './8',show:true},
              { name: 'Special Status (LCC) & Riyada Card/Certificate', path: './10', show:true},
              { name: 'Insurance & Legal Documents', path: './12', show:true},
              { name: 'Information & Communication Technology', path: './16', show:true},
              { name: 'Shareholder Information', path: './13', show:true},
            ],
          },
          { name: 'Landing', path: './scflandingpage',show:false,disablelink: false, },
          { name: 'Landing', path: './scf',show:false, disablelink: false, 
            children: [
              { name: 'Landing', path: './dashboard',show:false}
            ],
          },
        ] 
      },
      { 
        name: 'Operators / Buyers Zone', 
        path: './buyerzone', 
        show:false,
        disablelink: false, 
        children: [
          { name: 'Operators / Buyers Zone', path: './buyerlistviewpage',show:true},
        ] 
      },
      { 
        name: 'Account Settings', 
        path: './accountsettings',
        show:true,
        disablelink: false,         
      },
    ];

    return menu;
  }
  breadcrumbArrayValue(value) {
    this.breadcrumbArray.next(value);
  }
  getBreadcrumbArray() {
    return this.breadcrumbArray.asObservable();
  }
}