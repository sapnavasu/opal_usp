import { Component, OnInit,ViewEncapsulation } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { RegistrationService } from '../registration.service';

@Component({
  selector: 'app-view-offline-regdata',
  templateUrl: './view-offline-regdata.component.html',
  styleUrls: ['./view-offline-regdata.component.scss'],
  encapsulation: ViewEncapsulation.ShadowDom,
})
export class ViewOfflineRegdataComponent implements OnInit {
  tableData: string;
  public id : number;
  constructor(private regService: RegistrationService) { }

  ngOnInit() {
    this.getOfflinedata();
  }
  getOfflinedata(){
    this.regService.getOfflineRegData().subscribe(data => {
      this.tableData = data['data'].table;
    })
  }

}
