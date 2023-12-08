import { Component, OnInit, HostListener, ViewChild, Input } from '@angular/core';
import 'rxjs/add/observable/of';
import { ProfileService } from '@lypis_core/profilemanagement/profile.service';
import { AppLocalStorageServices } from '@lypis_config/common/localstorage/applocalstorage.services';
import { Encrypt } from '@lypis_config/common/class/encrypt';
import { EnterpriseService } from '@lypis_core/enterpriseadmin/enterprise.service';
import { Router } from '@angular/router';
import { PanelComponent } from './panel/panel.component';
import { environment } from 'environments/environment';
import { BgiJsonconfigServices } from 'app/lypis/BGIConfig/bgi-jsonconfig-services';



@Component({
    selector: 'app-contactinfo',
    templateUrl: './contactinfo.component.html',
    styleUrls: ['./contactinfo.component.scss']
})
export class ContactinfoComponent implements OnInit {
    customCollapsedHeight: string = environment.customCollapsedHeight;
    customExpandedHeight: string = environment.customExpandedHeight;
    paymentcontactlist: any;
    text:boolean=true;
    marketinglist: any;
    businessheadlist: any;
    businessadministrationlist: any;
    financelist: any;
    regpk: number;
    encryptedRegPk: string;
    contactType: number = 0;
    page: number = 1;
    public perpage = BgiJsonconfigServices.bgiConfigData.configuration.accordionPerpage;
    public paginationSet = BgiJsonconfigServices.bgiConfigData.configuration.accordionPaginationSet;
    deptUserList: any;
    panel: number = 1;
    logoUrl: string;
    warnUserBeforeLeavingPage = true;
    businessUnitList: any = [];
    @ViewChild(PanelComponent) panelComponent: PanelComponent;
    @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
        if (this.warnUserBeforeLeavingPage) {
            event.returnValue = false;
        }
    }
    @Input() currentPanel: number;
    constructor(private profileService: ProfileService,
        private localStorage: AppLocalStorageServices,
        private encryptClass: Encrypt,
        private enterpriseService: EnterpriseService,
        private router: Router) { }

    ngOnInit() {
        this.regpk = this.localStorage.getInLocal('reg_pk');
        this.encryptedRegPk = this.encryptClass.encrypt(this.regpk);
        this.contactInfoList(this.encryptedRegPk);
        let postParams = { fetchFor: 'map' };
        this.stakeholderUserDetails(postParams);
    }

    contactInfoList(regpk) {
        this.profileService.getcontactinfo(regpk,0,this.page,this.perpage,'').subscribe(data => {
            this.businessUnitList = data['data'].items;
            this.text = false;
        });
    }

    stakeholderUserDetails(postParam) {
        let postUrl = 'ea/user/users-by-dept';
        this.enterpriseService.enterpriseService(postParam, postUrl).subscribe(data => {
            if (data['data'].status == 100) {
                this.deptUserList = data['data'].data;
            }
        });
    }

    updateDeptUserList(event){
        if(event){
            this.stakeholderUserDetails({ fetchFor: 'map' });
        }
    }

    openNextPage() {
        if (!this.paymentcontactlist) {
            this.panel = 1;
        } else if (!this.marketinglist) {
            this.panel = 2;
        } else if (!this.businessheadlist) {
            this.panel = 3;
        } else if (!this.businessadministrationlist) {
            this.panel = 4;
        }else if (!this.financelist) {
            this.panel = 5;
        } else {
            this.router.navigate(['enterpriseadmin/userroleanddepartment']);
        }
    }
}
