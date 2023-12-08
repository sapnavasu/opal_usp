import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-namecard',
  templateUrl: './namecard.component.html',
  styleUrls: ['./namecard.component.scss']
})
export class NamecardComponent implements OnInit {

  @Input() firstname: string;
  @Input() email: string;
  constructor() { }

  ngOnInit() {
  }

}
