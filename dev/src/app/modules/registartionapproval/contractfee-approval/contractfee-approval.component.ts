import { Component, OnInit,ViewEncapsulation, Input, HostListener,Output, EventEmitter,ViewChild, ElementRef } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray, AbstractControl } from '@angular/forms';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Encrypt } from '@app/common/class/encrypt';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
// import { DriveInput, ValidateDrive } from '@app/common_files/classes/driveInput';

@Component({
  selector: 'app-contractfee-approval',
  templateUrl: './contractfee-approval.component.html',
  styleUrls: ['./contractfee-approval.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractfeeApprovalComponent implements OnInit {
  public eoistatus=0;
  public paymentapproval=0;
  public awardedby='Directorate General of Civil Aviation & Meteorology (Oman)';
  toggle: boolean = false;

  public paymentapprovalForm:FormGroup;
  public ck = new InptLang_Ctrl();
  public productdesc:boolean = false;
  public productdesc_val = "";

  public load_butt = false;
  public load_butt1 = false;
  public Editor = ClassicEditorBuild;

  public sample = '';
  public saved = false;


  @Input('contractfeepanel') paymentstsSidePanel: MatDrawer;
  @Output() private valid = new EventEmitter <boolean> ();
  config = {
    toolbar: [ 'heading', '|', 'bold', 'italic' ,'bulletedlist','numberedlist','blockquote','undo','redo'],
    placeholder: 'Type the content here!'
  }
  constructor(private fb: FormBuilder,public snackBar: MatSnackBar,private encryptClass:Encrypt,) { }

  ngOnInit() {
      this.paymentapprovalForm = this.fb.group({
        sectorlst:[null, Validators.compose([Validators.required])],
        rfq_prodesc: [null, Validators.compose([Validators.required])],
      });
  }
 
  closeslider() {
    this.paymentstsSidePanel.toggle();
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
 
  contractdetails=[
    { 
      contractrefno:'DGCAM199399',
      contracttitle:'Providing Provision Of Transportation Services (3 Years Contract + 1 Year Optional)',
      contawardtype:'General Contract',
      contprotype:'Others',
      contoblitype:'SME & LCC Obligation',
      conttenderpro:'Online Tendering',
      amountusd:'3,125',
      amountomr:'1203.040',
      sucamountomr:'148.418',
      contractinvoice:'pdfnormalimg',
    }
  ]
  paymentdetails=[
    { 
      paymode:'Cheque or Cash Deposit',
      chequeno:'ICICI9983893AFD',
      bankname:'National Bank of Oman',
      datepayment:'12-10-2020',
      payproof:'pdfnormalimg',
      invoicedoc:'pdfnormalimg',
      amountomr:'125.000',
    }
  ]
  payapprovaldtls=[
    { 
      paystatus:'Approved',
      payreceipt:'pdfnormalimg',
      receiptdate:'15-10-2020',
      paycomments:'Payment Recieved & Approved',
      
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
          this.paymentapprovalForm.controls.rfq_prodesc.setValue('');
      }else{
          this.productdesc_val = this.ck.ckeditor_dir('',this.snackBar,this.sample);
          this.paymentapprovalForm.controls.rfq_prodesc.setValue(this.ck.ckeditor_dir('',this.snackBar,this.sample))
      }
  }
  restproductdesp(){
      this.paymentapprovalForm.controls['rfq_prodesc'].reset();
      this.productdesc_val = "";
  }
  recChange(){
      this.saved = false;
  }
  validcheck(){
      this.valid.emit(false);
  }
}
