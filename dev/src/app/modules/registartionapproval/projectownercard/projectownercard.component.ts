import { Component, Input, OnInit } from '@angular/core';
import {ApprovalService} from './../approval.service';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-projectownercard',
  templateUrl: './projectownercard.component.html',
  styleUrls: ['./projectownercard.component.scss']
})
export class ProjectownercardComponent implements OnInit {
  requestParam:any;
  projectData:any = [];
  
  @Input() 
  public projectCardCallback: Function;
  constructor(private apprService: ApprovalService,private _route: ActivatedRoute) { }

  ngOnInit() {
  }

  ngAfterViewInit(){
    this.requestParam = this._route.snapshot.params.id;
    this.apprService.fetchProjectData(this.requestParam).subscribe(res=>{
      this.projectData = JSON.parse(res['data'].data);
      this.projectCardCallback(this.projectData['projectIsActive']);
    });
  }

}
