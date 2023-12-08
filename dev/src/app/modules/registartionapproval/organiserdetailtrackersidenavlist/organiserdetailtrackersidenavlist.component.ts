import { Component, OnInit, Input} from '@angular/core';
import swal from 'sweetalert';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { MatDrawer } from '@angular/material/sidenav';
import { ApprovalService } from '../approval.service';
import { Encrypt } from '@app/common/class/encrypt';
import { CookieService } from 'ngx-cookie-service';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';

@Component({
  selector: 'app-organiserdetailtrackersidenavlist',
  templateUrl: './organiserdetailtrackersidenavlist.component.html',
  styleUrls: ['./organiserdetailtrackersidenavlist.component.scss'],
  animations: [SlideInOutAnimation],
})
export class OrganiserdetailtrackersidenavlistComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  public organiserdetailloader:boolean = false;
  organierlists = [
    {contacttitle:'Khalsa Al Aghbari',contactsubtitle:"Lead Designer",mobilenum:'+968 2416 6100',contactemail:"Khalsa_Al_Aghbari@gmail.com"},
  ];
  animationState6 = 'out';
  @Input('organisertrackerdrawer') organisertrackerdrawer: MatDrawer;
  constructor(private approvalService: ApprovalService,private encryptClass: Encrypt,private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }
    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr"
  ngOnInit() {
  }
  basicdata :any;
  trackerdetails :any;
  getcompanytrackerdata(data){
    this.basicdata = data;
    let regpk = this.encryptClass.encrypt(data.MemberRegMst_Pk);
    let comppk = this.encryptClass.encrypt(data.MemberCompMst_Pk);
    this.approvalService.gettrakerdetails(regpk,comppk).subscribe(res => {
      this.organiserdetailloader=false;
      this.trackerdetails = res['data'];
    });
  }  
  organisertrackeralert() {
    swal({
      title: this.i18n('tsorganiserdetailtrackersidenavlist.doyouwanttocan'),
      text: this.i18n('tsorganiserdetailtrackersidenavlist.areyousuryou'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('tsorganiserdetailtrackersidenavlist.canc'), this.i18n('tsorganiserdetailtrackersidenavlist.ok')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.organisertrackerdrawer.toggle();
      }
    });
    this.animationState6 = 'out';
  }
  organiserlistview(divName: string) {
    if (divName === 'organiserlistviewdetail') {
      this.animationState6 = this.animationState6 === 'out' ? 'in' : 'out';
    }
    
  }
}
