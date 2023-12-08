import { Component, OnInit } from '@angular/core';
import { AdminService } from '@app/auth/admin.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

@Component({
  selector: 'app-transactionlandingpage',
  templateUrl: './transactionlandingpage.component.html',
  styleUrls: ['./transactionlandingpage.component.scss'],
  providers:[AdminService]
})
export class TransactionlandingpageComponent implements OnInit {
  public responseData: any;
  public classification: any;
  public country: any;
  public module: any;
  showLoader: boolean = true;
  public error_type:any;
  enc_comppk: any;
  sameUser: boolean = false;
  constructor(private activatedRoute: ActivatedRoute, private router: Router, private security: Encrypt, private adminService: AdminService, public localstorage: AppLocalStorageServices) { }

  ngOnInit() {

    this.activatedRoute.queryParams.subscribe(params => {
      if(params.type) {
        this.showLoader = false;
        this.error_type = params.type;
      }
      if(params.reference_number) {
        if (localStorage.getItem('v3logindata')) {
            this.enc_comppk = this.localstorage.getInLocal('encCompPk');
        }
        this.classification = params.classification;
        this.country = params.country;
        this.module = params.serv_module;
        const ref_no = params.reference_number;
        const cls = params.classification;
        const country = params.country;
        const serv_module = params.serv_module;
        const userpk = params.userpk;
        const comppk = params.comppk;
        if(this.enc_comppk == params.comppk){
          this.sameUser = true;
        }
        const responseinfo = {ref_no, cls, country, serv_module,userpk, comppk}
        this.adminService.getOttuResponseData(this.security.encrypt(JSON.stringify(responseinfo))).subscribe(data => {
          this.showLoader = false;
          this.responseData = data['data'];
        });
      }
    });
  }

}
