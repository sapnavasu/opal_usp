import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-thankyoucard',
  templateUrl: './thankyoucard.component.html',
  styleUrls: ['./thankyoucard.component.scss']
})
export class ThankyoucardComponent implements OnInit {

  @Input() firstname: string;
  constructor() { }

  ngOnInit() {
  }

}
