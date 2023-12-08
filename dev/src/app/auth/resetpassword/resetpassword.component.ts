import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl, ValidatorFn } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { PasswordValidation } from './password-validator';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { Observable } from 'rxjs';
import swal from 'sweetalert';
import { AdminService } from '../admin.service';
//import { resetCompiledComponents } from '@angular/core/src/render3/jit/module';
const check: number = 1;
const send: number = 2;

function passwordMatchValidator(password: string): ValidatorFn {
  return (control: FormControl) => {
    if (!control || !control.parent) {
      return null;
    }
    return control.parent.get(password).value === control.value ? null : { mismatch: true };
  };
}

@Component({
  selector: 'app-resetpassword',
  templateUrl: './resetpassword.component.html',
  styleUrls: ['./resetpassword.component.scss']
})

export class ResetpasswordComponent implements OnInit {
  public userdetails;
  public resetform: FormGroup;
  public usertypeboolean: boolean = false;
  public notexists: boolean = false;
  public aftersucessfullysetpassword:boolean=false;
  public aftersucessfullysetpasswordalreadyset:boolean=false;
  constructor(private fb: FormBuilder, private routerid: Router,
    public adminservice: AdminService, private activatedRoute: ActivatedRoute) {

  }
  listofuser = [];
  ngOnInit() {
    let passwordregex: RegExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
    this.resetform = this.fb.group({
      password: ['', Validators.compose([Validators.required, Validators.minLength(8),Validators.pattern(passwordregex)])],
      token: ['', Validators.required],
      userpk: ['', Validators.required],
      confirmpassword: ['', Validators.required]
    }, {
        validator: PasswordValidation.MatchPassword
      });
    this.activatedRoute.params.subscribe(paramsId => {
      this.resetform.controls['token'].setValue(paramsId['id'].trim())
      this.resetform.controls['userpk'].setValue(paramsId['pk'].trim())
    });

    this.adminservice.getuseremailid(this.resetform.controls['userpk'].value).subscribe(data => {
     if(data['data'].UM_EmailID)
     {
      this.userdetails = data['data'].UM_EmailID;
     }
     else{
        this.aftersucessfullysetpasswordalreadyset=true;
     }

    });
  }
  get password() {
    return this.resetform.get('password');
  }
  get f() {
    return this.resetform.controls;
  }
  getErrorPassword() {
    return this.resetform.get('password').hasError('required') ? 'Password is required' :
      this.resetform.get('password').hasError('pattern') ? 'Need one uppercase,lowercase,numeric and special characters' :
        this.resetform.get('password').hasError('minlength') ? 'Password must be 8 to 12 characters' : '';
  }
  onSubmit() {
    if (this.resetform.valid) {
      this.adminservice.fillpassword(this.resetform.value).subscribe(data => {
         this.aftersucessfullysetpassword=true;
      })
    }
  }
}
