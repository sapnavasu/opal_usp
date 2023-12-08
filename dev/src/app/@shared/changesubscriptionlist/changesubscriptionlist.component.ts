import { Component, EventEmitter, Input, OnChanges, OnInit, Output, SimpleChanges } from '@angular/core';
import {ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { AfterloginService } from '@app/modules/accountsettings/afterlogin.service';
//import { emit } from 'node:process';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr'
@Component({
  selector: 'app-changesubscriptionlist',
  templateUrl: './changesubscriptionlist.component.html',
  styleUrls: ['./changesubscriptionlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ChangesubscriptionlistComponent implements OnInit, OnChanges {
  // subscriptionloader: boolean = false;
  // @Output('showLoader') showLoader: any = new EventEmitter<any>();
  @Output('showloader') showloader: any = new EventEmitter<any>();
  @Input('currentSubscription') currentSubscription: any;
  @Input('termscond') termscond: string;
  @Output('isValid') isValid: any = new EventEmitter<any>();
  @Output('subscriptionChanged') subscriptionChanged: any = new EventEmitter<any>();
  intlSubsPackage: any;
  selectedPackage: any;
  formGroup: FormGroup;
  constructor(private afterloginService: AfterloginService, private formBuilder: FormBuilder,public toastr: ToastrService) { }

  ngOnInit() {
    this.getIntSubscription();
    this.initializeForm();
    this.checkIsValid();
    this.showloader.emit(false);
  }

  initializeForm() {
    this.formGroup = this.formBuilder.group({
      durationControl: [false, Validators.required],
      termsandconditionsControl: [false, Validators.requiredTrue]
    });
  }

  ngOnChanges(changes: SimpleChanges) {
    if(changes.currentSubscription  && this.formGroup && !this.selectedYear){
      this.formGroup.controls['durationControl'].setValue(this.currentSubscription.packageDtl.subscription.duration.Years.toString());
    }
  }

  checkIsValid() {
    this.formGroup.valueChanges.subscribe(d => {
      if(this.selectedYear === this.currentSubscription.packageDtl.subscription.duration.Years.toString()){
        this.isValid.emit(true);
      }else {
        this.isValid.emit(this.formGroup.invalid);
      } 
    });
  }
  
  getIntSubscription() {
    this.afterloginService.getInternationalSubscription().subscribe(data => this.intlSubsPackage = data['data']
    ,() => console.log('error')
    ,() => this.getPackageBasedonSelection());
  }

  getPackageBasedonSelection() {
    let index = this.intlSubsPackage.findIndex(pack => pack.duration == this.selectedYear);
    this.selectedPackage = this.intlSubsPackage[index];
  }

  showTSuccess(){
    this.toastr.success('Subscription changed successfully','Success !',{
        timeOut: 3000,
        closeButton: true,
    });
  }

  changeSubscription() {
    swal({
      title: "Do you want to change your subscription?",
      text: 'On changing your subscription, your payment invoice will be updated.',
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete) {
        this.showloader.emit(true);
        const request = { 
          classificationPk: this.selectedPackage['classificationpk'], 
          subscriptionPk: this.selectedPackage['subscribepk'], 
          memsubsbyclassifPk: this.selectedPackage['memsubsbyclassifpk'], 
          origin: this.currentSubscription.origin, 
          yearSubIn: this.selectedPackage['duration']
        };
        this.afterloginService.changeClassification(request).subscribe(data => {
          this.showloader.emit(false);
          this.formGroup.reset();
          this.subscriptionChanged.emit(true);
          this.showTSuccess();
          // swal('Success', 'Subscription changed successfully', 'success')
          // .then(() => {
          
          // });
        });
      }
    });
  }

  get selectedYear(): number {
    return this.formGroup.controls['durationControl'].value;
  }
}
