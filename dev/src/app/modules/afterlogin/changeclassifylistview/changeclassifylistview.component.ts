import { Component, OnInit, Input, Output, EventEmitter, ViewChild, OnChanges, SimpleChanges } from '@angular/core';
import swal from 'sweetalert';

import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { AfterloginService } from '../afterlogin.service';
import { ChangesubscriptionlistComponent } from '@app/@shared/changesubscriptionlist/changesubscriptionlist.component';
import { MatTableDataSource } from '@angular/material/table';
import { MatDrawer } from '@angular/material/sidenav';
import { ToastrService } from 'ngx-toastr';
@Component({
  selector: 'app-changeclassifylistview',
  templateUrl: './changeclassifylistview.component.html',
  styleUrls: ['./changeclassifylistview.component.scss']
})
export class ChangeclassifylistviewComponent implements OnInit, OnChanges {
  dataSource = new MatTableDataSource<any>([]);
  jsrscertifyfee = new MatTableDataSource<any>();
  displayedColumns = ['classification', 'head_count', 'annual_sale',];
  jsrscertifyColumns = ['classificationjsrs', 'Validity', 'certification_fee', 'vatcharges', 'totalpayable'];
  @Input('changeclassifydrawer') changeclassifydrawer: MatDrawer;
  @Input('currentSubscription') currentSubscription: any;
  @Output('changed') changed: EventEmitter<any> = new EventEmitter<any>();
  @ViewChild('changesubscription') changesubscription: ChangesubscriptionlistComponent;
  animationState3 = 'out';
  animationState1 = 'out';
  disableBtn: boolean = true;
  subscriptionloader: boolean = false;
  public buttonname: string = 'Update';
  formGroup: FormGroup;
  packageDtl: any;
  classificationDtl: any;
  termscond: string;
  amountDtls: any;
  constructor(private formBuilder: FormBuilder, private afterloginService: AfterloginService, public toastr: ToastrService) { }

  ngOnInit() {
    this.formGroup = this.formBuilder.group({
      headcount: ['', Validators.required],
      annualsales: ['', Validators.required],
      termsandcondition: [false, Validators.requiredTrue]
    });
    this.getClassificationDtl();
  }

  ngOnChanges(changes: SimpleChanges) {
    if (changes.currentSubscription && this.formGroup) {
      this.formGroup.controls['headcount'].setValue(this.currentSubscription.headCount);
      this.formGroup.controls['annualsales'].setValue(this.currentSubscription.annualSales);
      this.getPackageDtls();
    }
  }

  getClassificationDtl() {
    this.afterloginService.getClassificationDetails().subscribe(data => {
      this.classificationDtl = data['data'].classification;
      this.amountDtls = data['data'].amount;
      this.dataSource.data = data['data'].classification;
      this.jsrscertifyfee.data = data['data'].amount;
      this.jsrscertifyfee.data = data['data'].total_payable;
      this.termscond = data['data'].termsandcndurl;
    })
  }

  changeclassifylistview(divName: string) {
    if (divName === 'changeclassifyview') {
      this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
    }
  }
  selectcontentdescvalidity(divName: string) {
    if (divName === 'selectdropdownvalidity') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }
  changeClassification() {
    if (this.currentSubscription.origin === 'NATIONAL') {
      if (this.formGroup.valid) {
        swal({
          title: "Do you want to change your subscription?",
          text: 'On changing your subscription, your payment invoice will be updated.',
          icon: 'warning',
          closeOnClickOutside: false,
          closeOnEsc: false,
          buttons: ['Cancel', 'Ok'],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            this.subscriptionloader = true;
            const { classicationPk: classificationPk, memsubsbyclassifPk, subscription: { subscriptionPk, duration: { Years: yearSubIn } } } = this.packageDtl;
            const { origin } = this.currentSubscription;

            const request = { classificationPk, subscriptionPk, memsubsbyclassifPk, origin, yearSubIn };
            this.afterloginService.changeClassification(request).subscribe(data => {
              if (data.data.status == 1) {
                this.showSuccess();
                this.subscriptionloader = false;
                this.formGroup.reset();
                this.changed.emit(true);
                this.changeclassifydrawer.toggle();                

              } else {
                this.subscriptionloader = false;
                swal('Warning', 'Due to some error, Subscription not changed', 'warning')
                  .then(() => {
                  });
              }

            });
          }
        });
      }
    } else {
      this.changesubscription.changeSubscription();
    }
  }
  showSuccess() {
    this.toastr.success('Subscription changed successfully', 'Success !', {
      timeOut: 3000,
      closeButton: true,
    });
  }
  clear() {
    if (this.currentSubscription.origin !== 'NATIONAL') {
      this.changesubscription.formGroup.reset();
      this.changesubscription.selectedPackage = undefined;
    } else {
      this.formGroup.reset();
    }
  }

  updatePaymentDetails(event) {
    if (event) {
      this.changed.emit(true);
      this.changeclassifydrawer.toggle();
    }
  }

  changeclassifyAlert() {
    swal({
      title: "Do you want to cancel changing the subscription?",
      text: 'All the data that you entered will be lost.',
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.formGroup.reset();
        if (this.currentSubscription.origin === 'NATIONAL') {
          this.formGroup.controls['headcount'].setValue(this.currentSubscription.headCount);
          this.formGroup.controls['annualsales'].setValue(this.currentSubscription.annualSales);
          this.getPackageDtls();
        } else {
          this.changesubscription.formGroup.controls['durationControl'].setValue(this.currentSubscription.packageDtl.subscription.duration.Years.toString());
          this.changesubscription.getPackageBasedonSelection();
        }
        this.changeclassifydrawer.toggle();
      }
    });
    this.animationState3 = 'out';
  }

  getPackageDtls() {
    if (this.headCount && this.annualSales) {
      this.afterloginService.getPackage(this.headCount, this.annualSales).subscribe(data => {
        this.packageDtl = data['data'];
      });
    }
  }

  get disableByCondition() {
    if (this.headCount === this.currentSubscription.headCount && this.annualSales === this.currentSubscription.annualSales) {
      return true;
    }
    return this.formGroup.invalid;
  }

  get form() {
    return this.formGroup.controls;
  }

  get headCount() {
    return this.formGroup.get('headcount').value;
  }

  get annualSales() {
    return this.formGroup.get('annualsales').value;
  }
}
