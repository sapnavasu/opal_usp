import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-thankpastsubscription',
  templateUrl: './thankpastsubscription.component.html',
  styleUrls: ['./thankpastsubscription.component.scss']
})
export class ThankpastsubscriptionComponent implements OnInit {

  constructor() { }
  @Input() lapsed_date: any;
  @Input() deact_period: any;
  ngOnInit(): void {
  }

}
