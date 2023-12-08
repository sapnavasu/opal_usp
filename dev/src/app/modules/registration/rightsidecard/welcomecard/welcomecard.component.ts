import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-welcomecard',
  templateUrl: './welcomecard.component.html',
  styleUrls: ['./welcomecard.component.scss']
})
export class WelcomecardComponent implements OnInit {

  @Input() orgname: string;
  @Input() counts: any;
  // INV - Investor, PO - Project Owner, SUPPLIER, BUYER 
  @Input() stakeHolder: string;
  constructor() { }

  ngOnInit() {
  }

}
