import { ChangeDetectorRef, Component, Input, OnInit, ViewChild,SimpleChanges} from '@angular/core';
import {ViewModelData} from './viewModel/view-model';
import {ApprovalService} from './../approval.service';
import { getTreeNoValidDataSourceError } from '@angular/cdk/tree';
import { ViewResolverService } from '../view.resolver.service';
import { ActivatedRoute, Router } from '@angular/router';
import {FormGroup,FormBuilder,FormControl,Validator,Validators} from '@angular/forms';
import swal from 'sweetalert';
import { ProjectownercardComponent } from '../projectownercard/projectownercard.component';
import { trigger, state, style, transition, animate } from '@angular/animations';
import {Observable,of} from 'rxjs';
import { DataSource } from '@angular/cdk/collections';
import {map, startWith} from 'rxjs/operators';
import {ViewEncapsulation } from '@angular/core';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { environment } from '@env/environment';
import { MatDrawer } from '@angular/material/sidenav';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { DateAdapter,ErrorStateMatcher,MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { MatMenuTrigger } from '@angular/material/menu';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ToastrService } from 'ngx-toastr'
export interface Validatenow {
  value: string;
  viewValue: string;
}
export interface PeriodicElement {
  mcpah_pymtstatus: any;
  mcpah_appdeclon: any;
  mcpid_paymenttype: any;
  mcpah_comment: any;
  username: any;
  update_by: any;
  mcpid_pymtstatus: any;
  mcpid_submittedon: any;
}


var data:any[];

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
  selector: 'app-viewandvalidate',
  templateUrl: './viewandvalidate.component.html',
  styleUrls: ['./viewandvalidate.component.scss'],
  animations: [SlideInOutAnimation,trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', visibility: 'hidden' })),
    state('expanded', style({ height: '*', visibility: 'visible' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
   encapsulation: ViewEncapsulation.None,
   providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})



/**  Copyright 2019 Google LLC. All Rights Reserved.
    Use of this source code is governed by an MIT-style license that
    can be found in the LICENSE file at http://angular.io/license */

export class ViewandvalidateComponent implements OnInit {
  config = {toolbar: [ 'heading', '|', 'bold', 'italic' , 'link', 'bulletedlist', 'numberedlist', 'blockquote', 'undo', 'redo'], placeholder: 'Type the content here!', maxCharCount: 400};
  public currentsts:any;
  @Input() public set currstatus(value: any) {
    this.currentsts = value;
  }
  public get currstatus() {
    return this.currentsts;
  }
  public Editor = ClassicEditorBuild;
  public GeneraltermDesc = false;
  public generalterm_val = "";
  public load_butt = false;
  public formValidation = false;
  public manditory:boolean = false;
  public disableVal: any;
  public formparmvalue: any;
  public sample = '';
  public saved = false;
  public uimsg :string;
  public ck = new InptLang_Ctrl();
  public validationname:boolean = false;
  public cmdtemplate;
  public dataSourceCount = 0;
  public dataSubmitCount = 0;
  public paymentLastData: any;
  //public commentArray: any=[];
  animationState7 = 'out';
  recChange(){
    this.saved = false;
  }
  @ViewChild('demoMenuTrigger') demoMenuTrigger: MatMenuTrigger;

  public optionList :any;
  public commentArray:any=[];
  public commList = [
    {"text":"Lorem 123 Ipsum is simply dummy text of the printing and types Lorem Ipsum has been the industry's standard"},
    {"text":"dummy text ever since the 1500s, when an unknown printer scrambled it to make a type specimen book. It has survived but also the leap into electronic typesetting, remaining essen"},
    {"text":"Lorem Ipsum is simply dummy text of the printing and types Lorem Ipsum has been the industry's standard"},
    {"text":"dummy text ever since the 1500s, when an unknown printer scrambled it to make a type specimen book. It has survived but also the leap into electronic typesetting, remaining essen"}
  ];

  maxDate = new Date();
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  showLoader: boolean = false;
  public projectName: string;
//   myControl = new FormControl();
  updateoption: string[] = [
  "Create a new dimension with Smart List selected as the Dimension Type",
  "Create members in the dimension. (The members are the items that display in the drop-down, data form, or grid.)",
  "Some examples of approved comments & declined comment available",
  "Assign properties to the Smart List dimension and members. Assign a Label to the Smart List and Smart List members.",
  "Enable Smart Lists for data forms. See the Oracle Hyperion Planning Administrator's Guide.",
  "Use Smart List values in member formulas and business rules.",
 ];
 updateOptions: Observable<string[]>;
  @ViewChild(ProjectownercardComponent) projectcard: ProjectownercardComponent;
  public projectcardload: Function;
  @ViewChild('drawerbizfilter') drawerbizfilter: MatDrawer;
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  //displayedColumns = ['mcpah_pymtstatus','mcpah_appdeclon','mcpid_paymenttype', 'mcpah_comment', 'username'];
 // dataSource = new ExampleDataSource();
 dataSource:any;
  //isExpansionDetailRow = (i: number, row: Object) => row.hasOwnProperty('detailRow');
  //isExpansionDetailRow:null;
  //expandedElement: any;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  columnsToDisplay = ['mcpah_pymtstatus','mcpah_appdeclon','mcpid_paymenttype', 'username','update_by'];
  columnsToDisplay1 = ['mcpid_pymtstatus','mcpid_submittedon','mcpid_paymenttype', 'username','update_by'];
  expandedElement: PeriodicElement | null;
  animationState = 'out';
  animationState1 = 'out';
  animationState2 = 'out';
  animationState3 = 'out';
  selectStatus:boolean = true;
  approvalStatus:boolean = false;
  taxInvoiceBtn:boolean = false;
  invoiceBtn:boolean = true;
  declinedStatus:boolean = false;
  disableloader:boolean = false;
  validating: Validatenow[] = [
    {value: '3', viewValue: 'Approve'},
    {value: '4', viewValue: 'Reject'}
  ];
  // buyerValidation: Validatenow[] = [
  //   {value: '1', viewValue: 'Active'},
  //   {value: '2', viewValue: 'Inactive'}
  // ];
  approvalForm: FormGroup;

  viewData:any=[];
  requestParam;
  queryParam: any;
  router: any;
  appComments:any = 'Comments';
  submitBtnDisabled = false;
  cancelDisabled = false;
  showStatusLable=false;
  approvalfor='payment';
  approvalReqPk = '';
  activeStatus=false;
  inactiveStatus=false;
  failedStatus=false;
  enableSelectStatusForProject=false;
  stkId = 'Nil';
  sectorremainingTxt='';
  sectordisplayText = '';
  enableReceipt=false;
  tabindexparam='';
  renewalStatus='';
  validatetrue:boolean=false;
  showRequired:boolean=false;
  appvalidate:boolean=false;
  paymentReceivedOn:boolean=false;
  hideChangeSubscription: boolean = false;
  discount_enable: boolean = false;
  promocode_enable: boolean = false;
  constructor(private approvalservice: ApprovalService,
    private _route: ActivatedRoute,
    private routerlink : Router,
    private cdRef : ChangeDetectorRef,
    public snackBar: MatSnackBar,
    public toastr: ToastrService,
    private formbuilder:FormBuilder) {
      this.approvalForm = this.formbuilder.group({
        'approvalType': new FormControl("",[Validators.required]),
        'approvedOn': new FormControl(""),
        'approvalCmds': new FormControl("")
      });
     }
  public hasError = (controlName: string, errorName: string) =>{
    return this.approvalForm.controls[controlName].hasError(errorName);
  }
  clearstatusform(){
    this.approvalForm.controls['approvalType'].reset();
    this.approvalForm.controls['approvedOn'].reset();
    this.approvalForm.controls['approvalCmds'].reset();
    this.approvalForm.controls['approvalCmds'].clearValidators();
    this.approvalForm.controls['approvedOn'].clearValidators();
    this.paymentReceivedOn=false;
    this.appComments = 'Comments';
    this.showRequired=false;
  }
  approvalTypeChange(event){

    if(event.value == 4){
      this.approvalForm.controls['approvalCmds'].setValidators([Validators.required]);
      this.approvalForm.controls['approvedOn'].clearValidators();
      this.appComments = 'Comments';
      this.validatetrue=true;
      this.appvalidate=false;
      this.showRequired=true;
      this.paymentReceivedOn=false;
    }else if(event.value == 3){
      this.approvalForm.controls['approvalCmds'].clearValidators();
      this.approvalForm.controls['approvedOn'].setValidators([Validators.required]);
      this.appComments = 'Comments';
      this.paymentReceivedOn=true;      
      this.validatetrue=false;
      this.appvalidate=true;
      this.showRequired=false;
    }
    this.approvalForm.controls['approvalCmds'].updateValueAndValidity();
    this.approvalForm.controls['approvedOn'].updateValueAndValidity();
  }
  ngOnInit(){
    this.projectName=this.bgiConfigJson.projectName;
    // this.updateOptions = this.myControl.valueChanges.pipe(
    //   startWith(''),
    //   map(value => this._filter(value))
    // );
    this.approvalservice.getapprovaltemplate().subscribe(data => {
      this.commentArray = data['data'];
    });
      
  }  
  loaderview(){
    this.disableloader=true;
  }
  loadParent(projectIActive){
    if(projectIActive){
      this.enableSelectStatusForProject = true;
    }else{
      this.enableSelectStatusForProject = false;
    }
  }
 tabView(){
  ///regapproval/supplierapprovaltab/{{tabindexparam}}
  this.routerlink.navigate(['/registration/supplierapprovaltab/',{tabindex:this.tabindexparam}]);
 }
  ngAfterViewInit(){
    this.showLoader = false;
    this.requestParam = this._route.snapshot.params.id;
    this.tabindexparam = this._route.snapshot.params.tabindex;
    this.projectcardload = this.loadParent.bind(this);  
    //this.viewData = JSON.parse(this._route.snapshot.data.listData['data'].data);
    this.approvalservice.fetchPaymentApprovalViewPageData(this.requestParam).subscribe(res => {
      this.viewData = JSON.parse(res['data'].data);
      this.showLoader = false;
      // for sector
      this.paymentLastData = this.viewData['paymentLastData'];
      this.dataSourceCount = this.viewData['paymentLogCount'];
      this.dataSubmitCount = this.viewData['paymentSubmitCount'];
      this.discount_enable = this.viewData['discount_sts'];
      this.promocode_enable = this.viewData['promocode_sts'];
      if(this.dataSourceCount>0){
        this.dataSource = this.viewData['paymentLogData'];
      }else{
        this.dataSource = this.viewData['paymentSubmitData'];
      }
      //this.dataSource = ELEMENT_DATA;
      var sectorstrings = this.viewData['companyInfo']['sector'];
      var comppk = this.viewData['companyInfo']['companyPk'];
      this.renewalStatus = this.viewData['companyInfo']['renewalStatus'];
      this.approvalservice.checkforeignclassification(comppk).subscribe(data => {
        if (data['data'].status == 1) {
          this.hideChangeSubscription = true;
        }
      });
      if(sectorstrings != '' && sectorstrings != null){
        var stringObj = sectorstrings.split(",");
        var splitLength = sectorstrings.split(",").length;
        this.sectorremainingTxt = this.viewData['companyInfo']['sector'];
        if(splitLength > 2){
          this.sectordisplayText = stringObj[0]+'(+'+splitLength+')';
        }
      }
      this.approvalReqPk = this.viewData['paymentPk'];
      this.stkId = this.viewData['companyInfo']['supplierId_investorid'];
      if(this.viewData['paymentStatus'] == 3){
        this.selectStatus = false;
        this.approvalStatus = true;
        this.taxInvoiceBtn = true;
        this.invoiceBtn = false;
        this.declinedStatus = false;
        this.showStatusLable = true;
        this.activeStatus = false;
        this.inactiveStatus = false;
        this.failedStatus=false;
        
      }else if(this.viewData['paymentStatus'] == 4){
        this.selectStatus = false;
        this.approvalStatus = false;
        this.declinedStatus = true;
        this.showStatusLable = true;
        this.activeStatus = false;
        this.inactiveStatus = false;
        this.failedStatus=false;
        this.invoiceBtn = true;
        this.taxInvoiceBtn = false;
      }else if(this.viewData['paymentStatus'] == 6 || this.viewData['paymentStatus'] == 7 || this.viewData['paymentStatus'] == 8){
        this.selectStatus = false;
        this.approvalStatus = false;
        this.declinedStatus = false;
        this.showStatusLable = false;
        this.activeStatus = false;
        this.inactiveStatus = false;
        this.failedStatus=true;
        this.invoiceBtn = true;
        this.taxInvoiceBtn = false;
      }else if(this.viewData['paymentStatus'] == null || this.viewData['paymentStatus'] == ''){
        this.selectStatus = false;
      }
      if((this.viewData['companyInfo']['stktype'] == '7' || (this.viewData['companyInfo']['stktype'] == '6') && (this.viewData['paymentStatus'] == '1'))){
        this.selectStatus = true;
      }else{
        this.selectStatus = false;
      }
      if(this.viewData['companyInfo']['stktype'] == '7'){
        this.approvalReqPk = this.viewData['companyInfo']['registerPk'];
        this.approvalfor = 'buyer';
        // this.validating = this.buyerValidation;
        if(this.viewData['companyInfo']['memberStatus'] == 'A'){
          this.selectStatus = false;
          this.declinedStatus = false;
          this.showStatusLable = false;
          this.activeStatus = true;
          this.inactiveStatus = false;
        }else if(this.viewData['companyInfo']['memberStatus'] == 'I'){
          this.selectStatus = false;
          this.declinedStatus = false;
          this.showStatusLable = false;
          this.activeStatus = false;
          this.inactiveStatus = true;
        }
      }else if(this.viewData['companyInfo']['stktype'] == '6'){
        if(this.viewData['paymentStatus'] == 3){
          this.enableReceipt = true;
        }
      }
      //PROJECT OWNER PAYMENT APPROVAL CONFIG
      if(this.viewData['paymentPk'] != '' && this.enableSelectStatusForProject){
       this.selectStatus = true;
      }else if(this.viewData['paymentPk'] == '' && this.enableSelectStatusForProject){
       this.selectStatus = false;
      }
    });
  }
  
  showSuccess(){
    this.toastr.success("'Supplier's renewal approved successfully'", 'Success !', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showSuccess1(){
    this.toastr.success("'Supplier's registration approved successfully'", 'Success !', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showSuccess2(){
    this.toastr.success('Successfully Declined', 'Success !', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showSuccess3(){
    this.toastr.success('Active Successfully', 'Success !', {
        timeOut: 3000,
        closeButton: true,
    });
  }
  showSuccess4(){
    this.toastr.success('Inactive Successfully', 'Success !', {
        timeOut: 3000,
        closeButton: true,
    });
  }
 
  toggleShowDiv(divName: string) {
    if (divName === 'validateselect') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
  approvedstatus(divName: string) {
    if (divName === 'apprvedselect') {
      this.animationState7 = this.animationState7 === 'out' ? 'in' : 'out';
    }
  }
  activityloginfo(divName: string) {
    if (divName === 'activitylogview') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
    
  }
  submitApprForm(paymentPk,approvalType,stkType,payType){
    var swalText_1 = '';
    var swalPayType = 'registration?';
    this.approvalForm.value['paymentPk'] = paymentPk;
    this.approvalForm.value['stkApproval'] = approvalType;

    if(this.approvalForm.value['approvalType']){
      if(approvalType == 'buyer'){
        if(this.approvalForm.value['approvalType'] == '1'){
          swalText_1 = 'Do you want to active this Buyer registration?';
        }else if(this.approvalForm.value['approvalType'] == '2'){
          swalText_1 = 'Do you want to inactive this Buyer registration?';
        }
      }else{
        if(payType=='Renewal'){
          swalPayType = 'renewal?';
        }
        if(this.approvalForm.value['approvalType'] == '3'){
          swalText_1 = 'Do you want to change the Payment Status as Approved?';
          // if(stkType == '6'){
          //   swalText_1 = 'Do you want to approve this supplier ' + swalPayType;
          // }else if(stkType == '9'){
          //   swalText_1 = 'Do you want to approve this investor ' + swalPayType;
          // }else if(stkType == '11'){
          //   swalText_1 = "Do you want to approve this project Owner's " + swalPayType;            
          // }
        }
        else if(this.approvalForm.value['approvalType'] == '4'){
          swalText_1 = 'Do you want to change the Payment Status as Declined?';
          // if(stkType == '6'){
          //   swalText_1 = 'Do you want to decline this supplier ' + swalPayType;
          // }else if(stkType == '9'){
          //   swalText_1 = 'Do you want to decline this investor ' + swalPayType;
          // }else if(stkType == '11'){
          //   swalText_1 = "Do you want to decline this project Owner's " + swalPayType;
          // }
        }
      }
      swal({
        icon:'warning',
        title: swalText_1,
        buttons: ['No', 'Yes'],
        dangerMode: true,
        closeOnClickOutside:false
      }).then((yesResponse) => {
        if (yesResponse) {
          this.disableloader=true;
          this.showLoader = false;
          this.submitBtnDisabled = true;
          this.cancelDisabled = true;
          this.approvalservice.statusChange(this.approvalForm.value).subscribe(res => {
            this.disableloader=false;
            this.cancelDisabled = false;
            if(res['data'].data.aprStatus == 'approve'){
              this.stkId = res['data'].data.stkId;
              this.viewData['downloadData']['receipt']=res['data'].data.downloadlink;
              this.enableReceipt = true;
              this.selectStatus = false;
              this.approvalStatus = true;
              this.declinedStatus = false;
              this.activeStatus=false;
              this.inactiveStatus=false;
              this.ngAfterViewInit();
              if(payType=='Renewal'){
                this.showSuccess();
                // swal('Success',"Supplier's renewal approved successfully",'success');
              }else{
                this.showSuccess1();
                // swal('Success',"Supplier's registration approved successfully",'success');
              }
            }else if(res['data'].data.aprStatus == 'declined'){
              this.selectStatus = false;
              this.approvalStatus = false;
              this.declinedStatus = true;
              this.activeStatus=false;
              this.inactiveStatus=false;
              this.showSuccess2();
              // swal('Success','Successfully Declined','success');
            }else if(res['data'].data.aprStatus == 'active'){
              this.stkId = JSON.parse(res['data'].data)['stkId'];
              this.selectStatus = false;
              this.approvalStatus = false;
              this.declinedStatus = false;
              this.activeStatus=true;
              this.inactiveStatus=false;
              this.showSuccess3();
              // swal('Success','Active Successfully','success');
            }else if(res['data'].data.aprStatus == 'inactive'){
              this.selectStatus = false;
              this.approvalStatus = false;
              this.declinedStatus = false;
              this.activeStatus=false;
              this.inactiveStatus=true;
              this.showSuccess4();
              // swal('Success','Inactive Successfully','success');
            }
          });
        }else{
          this.disableloader=false;
          this.cancelDisabled = false;
        }
      });
    }
    }
    showAlert() {
          this.animationState1='out';
       
          //if ('') {
            this.drawerbizfilter.toggle();
            
          //}
        
      
    // else {
    //     this.drawerbizfilter.toggle();
        
    //   }
    
        
    }

    editgneral() {
      this.demoMenuTrigger.openMenu();
      this.GeneraltermDesc = !this.GeneraltermDesc;
      this.load_butt = this.GeneraltermDesc == true ? true : false;
    }
    addgneral() {
      if (this.sample.replace(' ', '').length == 0) {
        this.generalterm_val = '';
        this.approvalForm.controls['approvalCmds'].setValue(null);
      } else {
        this.generalterm_val = this.ck.ckeditor_dir('', this.snackBar, this.sample);
        this.approvalForm.controls['approvalCmds'].setValue(this.ck.ckeditor_dir('', this.snackBar, this.sample))
      }
    }
    commchange: string;
    defaultComment(event) {
      if (event) {
        if (event == 'owncomment') {
            this.generalterm_val = '';
            this.GeneraltermDesc = true;
        }else{
          let findCom = this.commList.find(x => x.text == event);
          this.approvalForm.controls['approvalCmds'].setValidators(null);
          this.generalterm_val = findCom.text;
          this.GeneraltermDesc = false;
          this.approvalForm.controls['approvalCmds'].setValue(event);
        }
      }
    }
    // private _filter(value: string): string[] {
    //   const filterValue = value.toLowerCase();
  
    //   return this.updateoption.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
    // }
    ngAfterViewChecked() {
      this.showLoader = false;
      if (this.showLoader != this.showLoader) { // check if it change, tell CD update view
        this.showLoader = false;
        this.cdRef.detectChanges();
      }
    }
  }

  export class ExampleDataSource extends DataSource<any> {
    /** Connect function called by the table to retrieve one stream containing the data to render. */
    connect(): Observable<Element[]> {
      const rows = [];
      data.forEach(element => rows.push(element, { detailRow: true, element }));
      return of(rows);
    }
  
    disconnect() { }
  
  }
  

