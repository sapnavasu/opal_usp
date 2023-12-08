import { Component, OnInit, ViewEncapsulation } from '@angular/core';

@Component({
  selector: 'app-qualitymanagerapproval',
  templateUrl: './qualitymanagerapproval.component.html',
  styleUrls: ['./qualitymanagerapproval.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class QualitymanagerapprovalComponent implements OnInit {
  bronze: boolean = false;
  gold: boolean = false;
  disableSubmitButton: boolean;
  mattab: number =  0;
  constructor() { }

  ngOnInit(): void {
  }

}
