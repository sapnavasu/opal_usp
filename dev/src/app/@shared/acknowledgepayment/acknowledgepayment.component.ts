import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import swal from 'sweetalert';
import { MatDialog } from '@angular/material/dialog';
import { MatDrawer } from '@angular/material/sidenav';
import { Filee } from '@app/@shared/filee/filee';
import { Encrypt } from '@app/common/class/encrypt';
import { DriveInput } from '@app/common/classes/driveInput';
import { CdkTextareaAutosize } from '@angular/cdk/text-field';
import { NgZone } from '@angular/core';
import { take } from 'rxjs/operators';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { SlideInOutAnimation } from '@app/common/drive/animation';
export const MY_FORMATS = {
  parse: {
      dateInput: 'DD-MM-YYYY',
  },
  display: {
      dateInput: 'DD-MM-YYYY',
      monthYearLabel: 'MMM YYYY',
      dateA11yLabel: 'LL',
      monthYearA11yLabel: 'MMMM YYYY',
  },
};


@Component({
  selector: 'app-acknowledgepayment',
  templateUrl: './acknowledgepayment.component.html',
  styleUrls: ['./acknowledgepayment.component.scss'],
  animations: [SlideInOutAnimation],
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
],
})
export class AcknowledgepaymentComponent implements OnInit {
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  acknowledgeform: FormGroup;
  @ViewChild('awardFormReset') awardFormReset:FormGroupDirective;
  @Input("invoicedrawer") invoicedrawer: MatDrawer;
  animationState = 'out';
  animationState2 = 'out';
  public drv_awardinput:DriveInput;
  @ViewChild(Filee) filee:Filee;
  @ViewChild('newsDoc') newsDoc:Filee;
  drv_bodimage: DriveInput;
   public drv_commreg: DriveInput;
   public drvInput:DriveInput;
  constructor(private fb: FormBuilder,private _ngZone: NgZone) { }

  ngOnInit(): void {
    this.drvInput = {
      fileMstPk:81,
      selectedFilesPk:[] 
    };
    this.acknowledgeform = this.fb.group({
      paymentmode: ["", Validators.required],
      chequeno: ["", Validators.required],
      bankname: ["", Validators.required],
      dateoftransfer: ["", Validators.required],
      remarks: ["", Validators.required],
      uploadinvoice: ["", Validators.required],
    });
 
  }
  patchForm(patchdata) {
    this.drv_bodimage.selectedFilesPk = Array(patchdata.bmd_memberdisppic);
    setTimeout(() => this.filee.triggerChange(), 1000);
  }
  resetForm(){
    this.animationState = 'out';
    this.animationState2="out";
    setTimeout(()=> this.filee.triggerChange(),1000);
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }

  resetFile() {
    this.drv_bodimage.selectedFilesPk = [];
    setTimeout(() => this.filee.triggerChange(), 1000);
  }
  showSweetAlert() {
    swal({
      title: 'Do you want to cancel adding this Acknowledge Payment?',
      text: 'All the data that you entered will be lost.',
      icon: 'warning',
      buttons: ['No', 'Yes'],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        this.invoicedrawer.toggle();
      }
    });
    this.animationState = 'out';
    this.animationState2 = 'out';
  }
  infolisting(divName: string) {
    if (divName === 'infoview') {
        this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
  }

  triggerResize() {
    this._ngZone.onStable.pipe(take(1))
      .subscribe(() => this.autosize.resizeToFitContent(true));
  }
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentaward') {
        this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
}
