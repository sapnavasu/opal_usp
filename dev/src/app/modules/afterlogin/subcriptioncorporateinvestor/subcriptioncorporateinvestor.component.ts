import { Component, OnInit, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-subcriptioncorporateinvestor',
  templateUrl: './subcriptioncorporateinvestor.component.html',
  styleUrls: ['./subcriptioncorporateinvestor.component.scss']
})
export class SubcriptioncorporateinvestorComponent implements OnInit {
  landline_country_code_flag=245;
  public afterform: FormGroup;
  firstname = 'mani';
  email = 'mani@businessgateways.com'
  selected=1;
  animationState = 'out';
  animationState1 = 'out';
  @Input() helpContent: string;
  constructor(private formBuilder:FormBuilder) { }

  ngOnInit(){
    this.afterform = this.formBuilder.group({
      
      firstname: ['', Validators.required],
      lastname: ['', Validators.required],
      emailid: ["", [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      renteremailid: ["", [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      department: ['', Validators.required],
      designation: ['', Validators.required],
      mobileno: ['',[ Validators.required, Validators.minLength(5)]],
      landlineno: ['', Validators.minLength(5)],
      mobilecc:['',Validators.minLength(5)],
      landlinecc:['', Validators.minLength(5)],
      landlineext:['', Validators .minLength(5)]
    }, {
  });
  
  }
  toggleShowDiv(divName: string) {
    if (divName === 'select') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
    
  }
  selectdecription(divName: string) {
    if (divName === 'all') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
    
  }
}
