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
import { RoyaltyService } from '@app/services/royalty.service';
import { AssessmentFeeService } from '@app/services/assessmentFee.service';


@Component({
  selector: 'app-validation',
  templateUrl: './validation.component.html',
  styleUrls: ['./validation.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', visibility: 'hidden' })),
    state('expanded', style({ height: '*', visibility: 'visible' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None,
})
export class ValidationComponent implements OnInit {
  public popoverIsOpen: any;
  royaltyFeePaymentId: any;

  public dropdoenvalue: boolean = true;
  i18n(key) {
    return this.translate.instant(key);
  }
  public validationForm: FormGroup;
  public aboutsuccess: boolean = false;
  public ck = new InptLang_Ctrl();
  public animation: boolean;
  public done: boolean = true;
  public app_ref_id: any;
  public roy_pk: any;
  @Output() pkemit = new EventEmitter<number>(); readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  @ViewChild('ccInput', { static: false }) ccInput: ElementRef<HTMLInputElement>;
  @ViewChild('inputElement') inputElement: ElementRef;
  length = '';
  public editerfield: boolean = false;
  @ViewChild('myPopover', { static: false }) pop: PopoverDirective;
  @Output() dataEmitter = new EventEmitter<boolean>();
  validateOptions = [{ value: 4, name: 'invoice.receive' }, { value: 5, name: 'invoice.notrece' }];
  public validatestatus_info;
  @Input('Validationplaceholder') Validationplaceholder: any;
  @Input('feePaymentId') feePaymentId: any;
  @Input() public set validatestatus(value: any) {
    this.validatestatus_info = value;
    console.log('value', this.validatestatus_info)
  }


  @Output() booleanValue = new EventEmitter<boolean>();
  public notallowed: boolean = false;
  public approval: boolean = false;
  public contact: string = ``;
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
  public manditoryBtn: boolean = false;
  notrequired: boolean = false;
  @Input() international_id: [];
  @Input() staffpopup: boolean = false;
  @Input('assessmentfeebtn') assessmentFeebtn: boolean = false;
  @Input('operatorValid') operatorValid: boolean = false;
  @Input('techoperatorValid') techoperatorValid: boolean = false;
  @Input('courseValid') courseValid: boolean = false;
  @Input('royaltytrainFeebtn') royaltytrainFeebtn: boolean = false;
  @Input('royaltytechFeebtn') royaltytechFeebtn: boolean = false;
  public Validtaionloder: boolean = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public decline: boolean = true;
  public Approvalbtn: boolean = false;
  public Rejectedbtn: boolean = false;

  constructor(private formBuilder: FormBuilder, private remoteService: RemoteService, private appservice: ApplicationService,
    private translate: TranslateService, private route: Router,
    private cookieService: CookieService,
    private service: RoyaltyService,
    private assService: AssessmentFeeService,
    private activatedRoute: ActivatedRoute) {
    this.resetForm = this.resetForm.bind(this);
    this.resinfo = this.resinfo.bind(this);
  }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = 'ltr';
  ngOnInit(): void {
    this.activatedRoute.queryParams.subscribe((params) => {
      this.app_ref_id = params['app_ref_id'];
      // this.roy_pk = params.get("roy_pk");
      // console.log(this.roy_pk);
    });
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;

    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
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
    })
  }

  onInput(event: Event): void {
    const input = event.target as HTMLTextAreaElement;
    input.style.height = 'auto';
    input.style.height = input.scrollHeight + 'px';
  }
  // comment box function
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
  // ck editor done button functions
  messagedone() {
    this.addinfo();
    this.editinfo();
    this.aboutsuccess = true;
    if (!this.dropdoenvalue) {
      this.done = false;
    }
  }
  // ck editor function
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
  // full form reset function
  resetForm() {
    this.resinfo()
    this.validationForm.reset();
    this.done = true;
    this.dropdoenvalue = true;
    this.approval = false;
    this.manditory = false;
    this.notrequired = true;

  }

  // cancel button
  close() {
    this.validationForm.reset();
    this.pop.hide();
    this.resetForm();
    this.techinfo = "";
  }
  // option select functions
  ValueSelect(value) {
    this.dropdoenvalue = false;
    if (value == 3) {
      if (this.validatestatus_info == 'notok') {
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
      this.validationForm.controls['comments'].setValue('');
      this.Approvalbtn = true;
      this.Rejectedbtn = false;
      this.approvalpopup = true;
      this.validationForm.controls['comments'].setValue(``);
      this.techinfo = "";
      this.comments = ``;
      this.contact = ``;
    }
    else {
      this.approval = true;
      this.manditory = true;
      this.decline = true;
      if(value==5){
        this.validationForm.controls['comments'].setValidators([Validators.required]);
        this.manditory = true
        this.manditoryBtn = false
      }else{
        this.manditory = false;
        this.manditoryBtn = true;
      }
      
      this.done = true;
      this.notrequired = true;
      this.validationForm.controls['comments'].setValue('');
      this.Approvalbtn = false;
      this.Rejectedbtn = true;
      this.approvalpopup = false;
      this.techinfo = "";
      this.comments = ``;
      this.contact = ``;
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
  // popover close and open
  togglePopover() {
    this.popoverIsOpen = !this.popoverIsOpen;
  }

  // submit button assessmentfee 
  submitassessment() {
    var data = {
      asmnt_pk: atob(this.feePaymentId),
      rasf_pymtstatus: this.validationForm.controls['select_valitate'].value,
      rasf_appdecComments: this.validationForm.controls['comments'].value,
    }
    console.log(data);
    this.assService.viewConfirmPaymentAssessmentFee(data).subscribe((data: any) => {
      swal({
        title: this.i18n('Status Updated Successfully.'),
        text: '',
        icon: 'success',
        buttons: [false, this.i18n('OK')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.booleanValue.emit(true);
          this.close()
        }
      });
    })
  }


  // submit button tarining operator 
  submitOperator() {
    this.close()
  }
  // submit button technical operator 
  submittechValid() {
    this.close()
  }
  // submit button course
  submitCourse() {
    this.close()
  }
  // submit button royaltyfee training
  submitroyaltytrain() {
    var data = {
      roy_pk: atob(this.feePaymentId),
      rasf_pymtstatus: this.validationForm.controls['select_valitate'].value,
      rasf_appdecComments: this.validationForm.controls['comments'].value,
    }
    console.log(data);
    this.service.viewConfirmPayment(data).subscribe((data: any) => {
      swal({
        title: this.i18n('Status Updated Successfully.'),
        text: '',
        icon: 'success',
        buttons: [false, this.i18n('OK')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.booleanValue.emit(true);
          this.close()
        }
      });
    })
  }

  // submit button royaltyfee technical
  submitroyaltytech() {
    console.log(this.roy_pk);

    swal({
      title: this.i18n(' '),
      text: '',
      icon: 'Success',
      buttons: [false, this.i18n('OK')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.close()
      }
    });
  }
}
