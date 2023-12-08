import { Component, OnInit, SimpleChanges } from '@angular/core';
import { Router } from '@angular/router';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { AfterloginService } from '../afterlogin.service';
import { HttpClient } from '@angular/common/http';
@Component({
  selector: 'app-landingpage',
  templateUrl: './landingpage.component.html',
  styleUrls: ['./landingpage.component.scss']
})
export class LandingpageComponent implements OnInit {
  origin: any = '';
  imglistviews = [{
    image1: 'assets/images/ARA-Petroleum.png',
    image2: 'assets/images/BP-EXPLORATION-(EPSILON).png',
    image3: 'assets/images/Masirah-oil.png',
    image4: 'assets/images/Eni-logo.png',
    image5: 'assets/images/Hydrocarbon.png',
    image6: 'assets/images/Medco-LLC.png',
    // image7:'../../../../assets/images/MOG.png',
    image8: 'assets/images/Occidental-Petroleum-Corporation-(NYSE-OXY).png',
    image9: 'assets/images/Oman-Gas-Company-SAOC-(OGC).png',
    image10: 'assets/images/Oman-Lasso-Exploration-&-Production-“OLEP”.png',
    image11: 'assets/images/Oman-Liquefied-Natural-Gas-LLC-(Oman-LNG).png',
    image12: 'assets/images/Oman-Oil-Company-Exploration-&-Production-LLC-(OOCEP).png',
    image13: 'assets/images/Orpic,-Oman-Oil-Refineries-and-Petroleum-Industries-Company.png',
    image14: 'assets/images/Petrogas-E&P-LLC.png',
    image15: 'assets/images/petroleb.png',
    image16: 'assets/images/Petroleum-Development-Oman-(PDO).png',
    image17: 'assets/images/Petrotel-Oman-LLC.png',
    image18: 'assets/images/Petroleum-ARA.png',
    image19: 'assets/images/Shell-Oman.png',
    image20: 'assets/images/Tethys-Oil-Montasar-Limited.png',
    image21: 'assets/images/Total.png',
    image22: 'assets/images/Consolidated-Contractors-Energy-Development-(CCED).png',
    image23: 'assets/images/DALEEL-PETROLEUM-L.png',
  }];
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private http: HttpClient,
    private router: Router, private afterlogin: AfterloginService, private applocalstorage: AppLocalStorageServices,) { }


  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
        this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
    });
    this.origin = this.applocalstorage.getInLocal('origin');

  }

  paymentaction() {
    this.router.navigate(['afterlogin/certificationpaymentdetail']);
  }

}
