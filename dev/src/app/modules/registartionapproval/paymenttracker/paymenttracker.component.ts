import { Component, OnInit } from '@angular/core';
export interface Starpack {
  formdate:string;
  todate:string;
  totalpay:number;  
  check:number;
  bank:number;
}
export interface Eachtopiclist {
  logo: string;
  count:string;

}
@Component({
  selector: 'app-paymenttracker',
  templateUrl: './paymenttracker.component.html',
  styleUrls: ['./paymenttracker.component.scss']
})

export class PaymenttrackerComponent implements OnInit {

  constructor() { }
  starpackinfo: Starpack = { formdate:'01-02-2020',todate:'05-02-2020',totalpay:120,check:15,bank:18}
  topicslist: Eachtopiclist[] = [
    {
      logo: "online1.png",
      count:"54"

    },   
    {
      logo: "online2.png",
      count:"27"
    },   
    {
      logo: "online3.png",
      count:"12"
    },   
    {
      logo: "online4.png",
      count:"14"
    },   
    {
      logo: "online1.png",
      count:"24"
    },   
  ];
  public show:boolean = false;
  public buttonName:any = 'Show';

  ngOnInit () {  }

  toggle() {
    this.show = !this.show;

    // CHANGE THE NAME OF THE BUTTON.
    if(this.show)  
      this.buttonName = "Hide";
    else
      this.buttonName = "Show";
  }
  
}
