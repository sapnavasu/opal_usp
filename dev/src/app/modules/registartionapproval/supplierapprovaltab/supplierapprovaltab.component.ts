import { Component, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import {ViewEncapsulation } from '@angular/core';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import {RegistrationapprovalComponent} from '../registrationapproval/registrationapproval.component';
@Component({
  selector: 'app-supplierapprovaltab',
  templateUrl: './supplierapprovaltab.component.html',
  styleUrls: ['./supplierapprovaltab.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class SupplierapprovaltabComponent implements OnInit {
  Contentplaceloader:boolean = true;
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  public projectName: string;
  public type: string='';
 tabIndex: number=0;
 @ViewChild('regapproval') regapproval:RegistrationapprovalComponent;
  constructor(private activeRoute: ActivatedRoute) { 
  
  }

  ngOnInit() {
    setTimeout(() => { this.Contentplaceloader = false }, 800);
    this.projectName=this.bgiConfigJson.projectName;
    this.activeRoute.paramMap.subscribe((params:ParamMap)=>{
      this.tabIndex = parseInt(params.get('tabindex'));
    });
    this.activeRoute.queryParams.subscribe(params => {
      this.type = params['type'];
    });
  }

  ngAfterViewInit(){

  }
  userdata(data:string){
      this.regapproval.changeList(data);
  }

}
