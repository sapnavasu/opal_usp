import { Component, ElementRef, OnInit, ViewChild, ViewEncapsulation, Input, Output, EventEmitter } from '@angular/core';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { FormBuilder, FormControl, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { ErrorStateMatcher } from '@angular/material/core';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { COMMA, ENTER } from '@angular/cdk/keycodes';
import { PopoverDirective } from 'ngx-smart-popover';
import { ActivatedRoute } from '@angular/router';
import { ApplicationService } from '@app/services/application.service';
import { Router } from '@angular/router';
import swal from 'sweetalert';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';

@Component({
  selector: 'app-viewvalidation',
  templateUrl: './viewvalidation.component.html',
  styleUrls: ['./viewvalidation.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', visibility: 'hidden' })),
    state('expanded', style({ height: '*', visibility: 'visible' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None,
})
export class ViewvalidationComponent implements OnInit {
  popoverIsOpen: any;
	dropdoenvalue: boolean = true;	isSupervisor: boolean;
  roles: any;
  isVerifier: boolean;  i18n(key) {
    return this.translate.instant(key);
  }
  validationForm: FormGroup;
  aboutsuccess: boolean = false;
  visible = true;
  public ck = new InptLang_Ctrl();
  selectable = true;
  removable = true;
  addOnBlur = true;
  emailvalue = false;
  animation: boolean;
  done: boolean = true;
  app_ref_id: any;


  @Output() private approvedEmitter = new EventEmitter<any>();
  @Output() private docsapprovedEmitter = new EventEmitter<any>();
  @Output() private siteauditapprovalEmitter = new EventEmitter<any>();
  @Input() private from: any = '';

  @Output() pkemit = new EventEmitter<number>(); readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  @ViewChild('ccInput', { static: false }) ccInput: ElementRef<HTMLInputElement>;
  @ViewChild('inputElement') inputElement: ElementRef;
  length = '';
  editerfield: boolean = false;
  @Input('hidebtn') hidebtn: boolean = false;
  @Input('overallform') overallform: boolean = false;
  @Input('newbtn') newbtn: boolean = false;
  @ViewChild('myPopover', { static: false }) pop: PopoverDirective;
  // isDisabled: boolean = false;
  @Input('condition') condition: boolean = false;
  @Input('paymentcondition') paymentcondition: boolean = false;
  @Input('paymentbutton') paymentbutton: boolean = false;
  @Output() paymentsubmitted = new EventEmitter<void>();
  @Output() dataEmitter = new EventEmitter<boolean>();
  @Output() interapprovedEmitter = new EventEmitter();
  validateOptions = [{ value: 3, name: 'validation.approved' }, { value: 4, name: 'validation.decline' }];
  @Input() international_approved: '';
  @Input() course_approved: '';
  @Input() document_approved: '';
  @Input() staff_approval: '';
  @Input() documentapproved_id: ''
  @Input('assessment_approval') assessment_approval: boolean = false;
  @Input('standardcourse') standardcourse: boolean = false;
  @Input('standapproval') standapproval: boolean = false;
  @Input('vehicleinspection') vehicleinspection: boolean = false;
@Input('rasCentre') rasCentre: boolean = false;
 public validatestatus_info;@Input('inspectionStatus') inspectionStatus: number;
  @Output() ApprovalEmitter = new EventEmitter<any>();
  @Output() IssueStickerEmitter = new EventEmitter<any>();
  @Output() InspEmitter = new EventEmitter<any>();  @Input() public set validatestatus(value: any) {    this.validatestatus_info = value;
    console.log('value', this.validatestatus_info)
    // if (value == 'declined') {
    //   this.validateOptions = [{ value: 4, name: 'validation.decline' }];
    // } else if (value == 'approved') {
    //   this.validateOptions = [{ value: 3, name: 'validation.approved' }];
    // }
  }
  @Output() booleanValue = new EventEmitter<boolean>();
  notallowed: boolean = false;
  approval: boolean = false;
  contact: string = ``;
  public approvalpopup: boolean;
  public popupcontent: any;
  @ViewChild('myEditor') myEditor: any;
  config = {
    toolbar: [
      'heading',
      '|',
      'bold',
      'italic',
      '|',
      'bulletedList',
      'numberedList',
      '|',
      'blockquote',
      '|',
      'undo',
      'redo',
    ],
    image: {
      toolbar: [
        'imageStyle:full',
        'imageStyle:side',
        'imageStyle:alignLeft',
        'imageStyle:alignRight',

        '|',
        'imageTextAlternative'
      ],
      styles: [
        // This option is equal to a situation where no style is applied.
        'full',

        'side',

        // This represents an image aligned to the left.
        'alignLeft',

        // This represents an image aligned to the right.
        'alignRight'
      ]
    },
    table: {
      contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
    },
    placeholder: "Type the content here!"
  }
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  public manditory: boolean = false;
  notrequired: boolean = false;
  @Input() international_id: [];
  @Input() staffpopup: boolean = false;
  disableSubmitButton: boolean = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @Input() callbackFn: (validForm: any, resetForm: any) => void;
  public decline: boolean = true;
  public Approvalbtn: boolean = false;
  // public Approval: boolean = false;
  public Rejectedbtn: boolean = false;
  // @Input('isDisabled') isDisabled : boolean = false;
  @Output() shareData: EventEmitter<any> = new EventEmitter();
  @Input('validationPlaceholder') validationPlaceholder: any;
  @Input('submitPlaceholder') submitPlaceholder: any;
  
  constructor(private formBuilder: FormBuilder, private remoteService: RemoteService, private appservice: ApplicationService,
   
    private translate: TranslateService, private route: Router, private localstorage:AppLocalStorageServices,

    private cookieService: CookieService,
    private activatedRoute: ActivatedRoute) {
    this.resetForm = this.resetForm.bind(this);
    this.resinfo = this.resinfo.bind(this);
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = 'ltr';
  ngOnInit(): void {
    this.roles = this.localstorage.getInLocal('role');
   if(this.roles) {
    if(this.roles.includes(17))
    {
      this.isVerifier = true;
    }
    if(this.roles.includes(18))
    {
      this.isSupervisor = true;
    }
    
   }
    this.activatedRoute.queryParams.subscribe((params) => {
      this.app_ref_id = params['app_ref_id'];
    });

    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;

    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;

    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;


      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;

      }
    });
    this.validForm();
  }
  validForm() {
    this.validationForm = this.formBuilder.group({
      select_valitate: [''],
      comments: ['',],
      // commenteditor: ['', Validators.required],
    })
  }
  get valid() {
    return this.validationForm.controls;
  }
  onInput(event: Event): void {
    const input = event.target as HTMLTextAreaElement;
    input.style.height = 'auto';
    input.style.height = input.scrollHeight + 'px';
  }
  editinfo() {
    this.edittechinfo = !this.edittechinfo;
  }
  get f() { return this.validationForm.controls; }
  resinfo() {
    this.validationForm.controls['comments'].setValue(``);
    this.techinfo = "";
    this.comments = ``;
    this.contact = ``;
    console.log(this, `this`)
  }
  addinfo() {
    this.techinfo = this.validationForm.controls['comments'].value;
  }
  messagedone() {
    this.addinfo();
    this.editinfo();
    this.aboutsuccess = true;
    if(!this.dropdoenvalue){
    this.done = false;
    }
  }
  onChangeeditor(event) {
    this.length_Of_ck = $(this.validationForm.controls['comments'].value).text().length;
    this.comments = $(this.validationForm.controls['comments'].value).text();
    if (this.length_Of_ck > 1000) {
      this.validationForm.setErrors({ 'invalid': true });
      this.validationForm.controls['comments'].setErrors({ 'incorrect': true });
      this.aboutsuccess = false;
    }
    if (this.length_Of_ck > 0) {
      this.decline = false;
    }

  }

  resetForm() {
    this.resinfo()
    this.validationForm.reset();
    this.done = true;
    this.dropdoenvalue = true;
    this.approval = false;
    this.manditory = false;
    this.notrequired = true;
    console.log(false)

  }
  submitvalidationnew() {
    if (this.validationForm.valid) {
      this.callbackFn(this.validationForm, this.resetForm);
      this.pop.hide();
    }
  }

  submitvalidation() {



    if (this.assessment_approval) {
      if (this.validationForm.valid) {
        const value = this.validationForm.value;
        let select_valitate = this.validationForm.controls['select_valitate'].value;
        let comments = this.validationForm.controls['comments'].value;
        this.callbackFn(this.validationForm, this.resetForm);
        this.pop.hide();
      }
    }
    else if (this.course_approved != '' && this.course_approved != undefined) {
      if (this.validationForm.valid) {

        const value = this.validationForm.value;
        let select_valitate = this.validationForm.controls['select_valitate'].value;
        let comments = this.validationForm.controls['comments'].value;
        swal({
          title: 'The Course  has been Validated and Submitted.',
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.booleanValue.emit(true);
          this.disableSubmitButton = true;
          this.appservice.statusChange(this.app_ref_id, select_valitate, comments).subscribe(res => {
            this.disableSubmitButton = false;
            this.booleanValue.emit(false);
            this.approvedEmitter.emit(res.data);
            //  this.callbackFn(this.validationForm, this.resetForm);
            this.pop.hide();
            this.resetForm()
          }
          )
        })

      }
    }
    else if (this.international_approved != '' && this.international_approved != undefined) {
      if (this.validationForm.valid) {
        const value = this.validationForm.value;
        let select_valitate = this.validationForm.controls['select_valitate'].value;
        let comments = this.validationForm.controls['comments'].value;
        swal({
          title: this.i18n('company.intervalidation'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.booleanValue.emit(true);
          this.disableSubmitButton = true;
          this.appservice.internationalstatusChange(this.app_ref_id, select_valitate, comments, this.international_id).subscribe(res => {
            this.disableSubmitButton = false;
            this.booleanValue.emit(false);
            this.interapprovedEmitter.emit(res.data);
            //  this.callbackFn(this.validationForm, this.resetForm);

            this.pop.hide();
            this.resetForm()

          }
          )
        })
      }


    }
    else if (this.document_approved != '' && this.document_approved != undefined) {
      if (this.validationForm.valid) {
        const value = this.validationForm.value;
        let select_valitate = this.validationForm.controls['select_valitate'].value;
        let comments = this.validationForm.controls['comments'].value;
        swal({
          title: this.i18n('company.docuvalidation'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.booleanValue.emit(true);
          this.disableSubmitButton = true;
          this.appservice.documnetstatusChange(this.app_ref_id, select_valitate, comments, this.documentapproved_id).subscribe(res => {
            this.disableSubmitButton = false;
            this.booleanValue.emit(false);
            this.docsapprovedEmitter.emit(res.data);
            // this.callbackFn(this.validationForm, this.resetForm);
            this.pop.hide();
            this.resetForm()
          }
          )
        })
      }
    }
    else if (this.staff_approval != '' && this.staff_approval != undefined) {
      if (this.validationForm.valid) {
        const value = this.validationForm.value;
        let select_valitate = this.validationForm.controls['select_valitate'].value;
        let comments = this.validationForm.controls['comments'].value;
        swal({
          title: this.i18n('company.staffvalidation'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('company.ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        }).then(() => {
          this.booleanValue.emit(true);
          this.disableSubmitButton = true;
          this.appservice.staffstatusChange(this.app_ref_id, select_valitate, comments).subscribe(res => {
            this.disableSubmitButton = false;
            this.booleanValue.emit(false);
            // this.approvedEmitter.emit(res.data);
            //this.callbackFn(this.validationForm, this.resetForm);
            this.pop.hide();
            this.resetForm()

          }
          )
        })
      }
    } else {
      if (this.validationForm.valid) {
        if (this.from == "siteaudit") {
          const value = this.validationForm.value;
          this.siteauditapprovalEmitter.emit(value);
          this.pop.hide();
        } else {
          let select_valitate = this.validationForm.controls['select_valitate'].value;
          let comments = this.validationForm.controls['comments'].value;
          swal({
            title: this.i18n('company.siteaudit'),
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then(() => {
            this.booleanValue.emit(true);
            this.disableSubmitButton = true;
            this.appservice.staffstatusChange(this.app_ref_id, select_valitate, comments).subscribe(res => {
              this.disableSubmitButton = false;
              this.booleanValue.emit(false);
              // this.approvedEmitter.emit(res.data);
              // this.callbackFn(this.validationForm, this.resetForm);
              this.pop.hide();
            this.resetForm()

            })
          })

        }
      }
    }


    return;



  }


  submitted() {
    if (this.validationForm.valid) {
      this.disableSubmitButton = true;
      const value = this.validationForm.value;
      let select_valitate = this.validationForm.controls['select_valitate'].value;
      let comments = this.validationForm.controls['comments'].value;

      if (this.app_ref_id == undefined) {
        this.disableSubmitButton = true;
        this.callbackFn(this.validationForm, this.resetForm);
        this.pop.hide();
        this.notallowed = true;
        this.techinfo = "";
      }
      else {
        // if (this.staffpopup == true) {
        //   if (this.approvalpopup == true) {
        //     this.popupcontent = this.i18n('The Course Certification Form has been Validated and Approved.')
        //    }else if(this.approvalpopup == false) { 
        //     this.popupcontent = this.i18n('The Course Certification Form has been Validated and Declined.')
        //    }
        //   swal({
        //     title: this.popupcontent,
        //     text: "",
        //     icon: 'success',
        //     buttons: [false, this.i18n('company.ok')],
        //     dangerMode: true,
        //     className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        //     closeOnClickOutside: false
        //   }).then(() => {
        //   this.disableSubmitButton = true;
        //     this.appservice.overallapprovdec(this.app_ref_id, select_valitate, comments).subscribe(res => {
        //       this.disableSubmitButton = false;
        //       this.route.navigate(['/standardcourseapproval/approvaldetails']);
        //       //  this.approvedEmitter.emit(res.data);
        //       // this.callbackFn(this.validationForm, this.resetForm);
        //      this.booleanValue.emit(true);
        //       this.pop.hide();
        //     }
        //     )

        //     // this.booleanValue.emit(true);
        //     // this.route.navigate(['/standardcourseapproval/approvaldetails']);

        //   })
        // }
        // else {
          if (this.approvalpopup == true) {
            this.popupcontent = this.i18n('The Course Certification Form has been Validated and Approved.')
           }else if(this.approvalpopup == false) { 
            this.popupcontent = this.i18n('The Course Certification Form has been Validated and Declined.')
           }
           swal({
             title: this.popupcontent,
             text: "",
             icon: 'success',
             buttons: [false, this.i18n('company.ok')],
             dangerMode: true,
             className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
             closeOnClickOutside: false
           }).then(() => {
           this.disableSubmitButton = true;
             this.appservice.overallapprovdec(this.app_ref_id, select_valitate, comments).subscribe(res => {
               this.disableSubmitButton = false;
               this.route.navigate(['/standardcourseapproval/approvaldetails']);
               //  this.approvedEmitter.emit(res.data);
               // this.callbackFn(this.validationForm, this.resetForm);
              this.booleanValue.emit(true);
               this.pop.hide();
             }
             )
 
             // this.booleanValue.emit(true);
             // this.route.navigate(['/standardcourseapproval/approvaldetails']);
 
           })
        // }


      }
    }
    this.disableSubmitButton = false;
  }
  sendData() {
    const data = true;
    this.dataEmitter.emit(data);
    this.pop.hide();
    this.resetForm();

  }

  close() {
    this.validationForm.reset();
    this.pop.hide();
    this.resetForm();
    this.techinfo = "";
    // this.togglePopover();
  }
  comment(value) {
    this.dropdoenvalue = false;
    if (value == 3) {
      if(this.validatestatus_info == 'notok'){
        swal({
          title: this.i18n('Please approve all'),
          text: '',
          icon: 'warning',
          buttons: [false, 'Ok'],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
        this.resetForm();
        return false;
      }
      this.approval = false;
      this.manditory = false;
      this.validationForm.controls['comments'].setValidators(null);
      this.done = false;
      this.decline = true;
      this.notrequired = false;
      this.techinfo = "";
      this.validationForm.controls['comments'].setValue('');
      this.Approvalbtn = true;
      this.Rejectedbtn = false;
      this.approvalpopup = true;
    }
    else {
      this.approval = true;
      this.manditory = true;
      this.decline = true;
      this.validationForm.controls['comments'].setValidators([Validators.required]);
      this.done = true;
      this.notrequired = true;
      this.techinfo = "";
      this.validationForm.controls['comments'].setValue('');
      this.Approvalbtn = false;
      this.Rejectedbtn = true;
      this.approvalpopup = false;

    }
  }
  trimEditorTextIfExceedsMaxLength(maxLength: number) {
    if (this.contact.length > maxLength) {
      this.contact = this.contact.substr(0, maxLength);
    }
  }
  onReady(event) {
    console.log(event);
  }
  togglePopover() {
    this.popoverIsOpen = !this.popoverIsOpen;
    if(this.popoverIsOpen) {
      this.shareData.emit(true)
    }else {
      this.shareData.emit(false); 
    }
  }
  moveSupervisor() {
    let data :any;
    data = {
      'status' : this.validationForm.controls['select_valitate'].value,
      'comments' : this.validationForm.controls['comments'].value,
      'popover' : this.popoverIsOpen
    }
    this.ApprovalEmitter.emit(data);
  }
  issueSticker() {
    let data :any;
    data = {
      'status' : this.validationForm.controls['select_valitate'].value,
      'comments' : this.validationForm.controls['comments'].value,
      'popover' : this.popoverIsOpen
    }
    this.IssueStickerEmitter.emit(data);
  }
  
  moveInspector() {

    let data = {
      'status' : this.validationForm.controls['select_valitate'].value,
      'comments' : this.validationForm.controls['comments'].value,
      'popover' : this.popoverIsOpen
    }
    this.InspEmitter.emit(data);

    
  }
  submitRascentre() {

    if (this.validationForm.valid) {
      this.disableSubmitButton = true;
      const value = this.validationForm.value;
      let select_valitate = this.validationForm.controls['select_valitate'].value;
      let comments = this.validationForm.controls['comments'].value;
      console.log(select_valitate);

      swal({
        title: this.i18n(' '),
        text: " ",
        icon: 'success',
        buttons: [false, this.i18n('OK')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        this.booleanValue.emit(true);
        this.disableSubmitButton = false;
          this.pop.hide();
          this.resetForm()
      })
    }
  }
}
