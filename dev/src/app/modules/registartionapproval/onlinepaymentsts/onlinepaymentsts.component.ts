import { Component, OnInit,ViewEncapsulation, Input, HostListener,Output, EventEmitter,ViewChild, ElementRef } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray, AbstractControl } from '@angular/forms';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Encrypt } from '@app/common/class/encrypt';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';


@Component({
  selector: 'app-onlinepaymentsts',
  templateUrl: './onlinepaymentsts.component.html',
  styleUrls: ['./onlinepaymentsts.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class OnlinepaymentstsComponent implements OnInit {
  public eoistatus=0;
  public awardedby='Directorate General of Civil Aviation & Meteorology (Oman)';
  toggle: boolean = false;

  public paymentonlineForm:FormGroup;
  public ck = new InptLang_Ctrl();
  public productdesc:boolean = false;
  public productdesc_val = "";

  public load_butt = false;
  public load_butt1 = false;
  public Editor = ClassicEditorBuild;

  public sample = '';
  public saved = false;


  @Input('paymentstatus') OnlinepaymentstsPanel: MatDrawer;
  @Output() private valid = new EventEmitter <boolean> ();
  config = {
    toolbar: [ 'heading', '|', 'bold', 'italic' ,'bulletedlist','numberedlist','blockquote','undo','redo'],
    placeholder: 'Type the content here!'
  }
  constructor(private fb: FormBuilder,public snackBar: MatSnackBar,private encryptClass:Encrypt,) { }

  ngOnInit() {
      this.paymentonlineForm = this.fb.group({
        paystatuslst:[null, Validators.compose([Validators.required])],
        pay_comment: [null, Validators.compose([Validators.required])],
        rfq_reqdate: [null, Validators.compose([Validators.required])],
      });
  }
 
  closeslider() {
    this.OnlinepaymentstsPanel.toggle();
  }
  despchange() {
    this.toggle = !this.toggle;
  }
  
  contractdtls=[
    {
      contractsuppcode:'OM002278',
      contractname:'Paper Note International Group of Companies (Oman) LLC',
    }
  ]
 
  paymentdtls=[
    { 
      sucamountomr:'148.418',
      paymentdate:'12-10-2020',
      transactid:'1610345729T528',
    }
  ]
 
  // Product Description
  editproductdesp(){
    this.productdesc = !this.productdesc;
    this.load_butt = this.productdesc==true?true:false;
  }
  addproductdesp(){
      if(this.sample.replace(' ','').length==0){
          this.productdesc_val = '';
          this.paymentonlineForm.controls.pay_comment.setValue('');
      }else{
          this.productdesc_val = this.ck.ckeditor_dir('',this.snackBar,this.sample);
          this.paymentonlineForm.controls.pay_comment.setValue(this.ck.ckeditor_dir('',this.snackBar,this.sample))
      }
  }
  restproductdesp(){
      this.paymentonlineForm.controls['pay_comment'].reset();
      this.productdesc_val = "";
  }
  recChange(){
      this.saved = false;
  }
  validcheck(){
      this.valid.emit(false);
  }

}
