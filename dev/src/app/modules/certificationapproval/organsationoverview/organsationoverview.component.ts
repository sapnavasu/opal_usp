import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-organsationoverview',
  templateUrl: './organsationoverview.component.html',
  styleUrls: ['./organsationoverview.component.scss']
})
export class OrgansationoverviewComponent implements OnInit {
  disableSubmitButton: boolean;

  constructor() { }

  ngOnInit(): void {
  }

}
