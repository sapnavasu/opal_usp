import { Injectable } from '@angular/core';
import { SharedService } from './shared.service';



@Injectable()
export class SelectList {
  constructor(public shared: SharedService) {}
  public departmentList: any = [
    {key: 'BH', name: 'Business Head'},
    {key: 'M', name: 'Marketing'},
    {key: 'BA', name: 'Business Administration'},
    {key: 'J', name: 'JSRS Validation Contact'},
    {key: 'JP', name: 'JSRS Procurement contact'},
    {key: 'F', name: 'Finance'},
  ];

}
