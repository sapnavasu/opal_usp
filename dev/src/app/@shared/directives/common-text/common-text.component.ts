import { Component, OnInit } from '@angular/core';
import { SharedService } from '@app/@shared/shared.service';



const isHidden = true;
@Component({
  selector: 'app-common-text',
  templateUrl: './common-text.component.html',
  styleUrls: ['./common-text.component.css'],
  providers:[SharedService]
})

export class CommonTextComponent implements OnInit {
  captcha: any;
  captchaurl = 'http://'+window.location.hostname+'/phpcaptcha/captcha.php?page=';
  
  random = Math.floor(Math.random() * (999999 - 100000)) + 100000;
  captchaid = 'common_'+ this.random;
  constructor(public _service: SharedService) { }
  ngOnInit(){
    this.captcha = this.captchaurl + this.captchaid;
  }
  refreshcaptcha(){
    let refresh = Math.floor(Math.random() * (999999 - 100000)) + 100000;
    this.captcha = this.captchaurl + this.captchaid + '&' + refresh;
  }

}
