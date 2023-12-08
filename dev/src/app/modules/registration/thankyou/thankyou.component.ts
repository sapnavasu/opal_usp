import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-thankyou',
  templateUrl: './thankyou.component.html',
  styleUrls: ['./thankyou.component.scss']
})
export class ThankyouComponent implements OnInit {
  @Input() refno: string;
  @Input() name: string;
  @Input() pwdLink: string;
  @Input() forBuyer: boolean = false;
  @Input() forUser: boolean = false;
  constructor() { }

  ngOnInit() {
  }

}
