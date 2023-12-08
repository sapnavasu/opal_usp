import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
@Component({
  selector: 'app-subscriptionlandingpage',
  templateUrl: './subscriptionlandingpage.component.html',
  styleUrls: ['./subscriptionlandingpage.component.scss']
})
export class SubscriptionlandingpageComponent implements OnInit {

  constructor(public routeid: ActivatedRoute) { }
  public de_act_period: any;
  public lapsed_date: any;
  ngOnInit() {
    this.routeid.queryParams.subscribe(params => {
      this.de_act_period = params['de_period'];
      this.lapsed_date = params['date'];
    });
  }

}
