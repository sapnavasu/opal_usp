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
  selector: 'app-valiation',
  templateUrl: './valiation.component.html',
  styleUrls: ['./valiation.component.scss'],
  animations: [SlideInOutAnimation, trigger('detailExpand', [
    state('collapsed', style({ height: '0px', minHeight: '0', visibility: 'hidden' })),
    state('expanded', style({ height: '*', visibility: 'visible' })),
    transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
  ]),],
  encapsulation: ViewEncapsulation.None,
})
export class ValiationComponent implements OnInit {
  i18n(key) {
    return this.translate.instant(key);
  }
  public popoverIsOpen: any;
	public dropdoenvalue: boolean = true;	
  public isSupervisor: boolean;
  public roles: any;
  public isVerifier: boolean;  
  public validationForm: FormGroup;
  public aboutsuccess: boolean = false;
  public visible = true;
  public ck = new InptLang_Ctrl();
  public selectable = true;
  public removable = true;
  public addOnBlur = true;
  public emailvalue = false;
  public animation: boolean;
  public done: boolean = true;
  public app_ref_id: any;
  public length = '';
  public editerfield: boolean = false;
  public validatestatus_info;
  public notallowed: boolean = false;
  public approval: boolean = false;
  public contact: string = ``;
  public approvalpopup: boolean;
  public popupcontent: any;
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  public manditory: boolean = false;
  public notrequired: boolean = false;
  public decline: boolean = true;
  public Approvalbtn: boolean = false;
  public Rejectedbtn: boolean = false;
  @Output() private approvedEmitter = new EventEmitter<any>();
  @Output() private declinedEmitter = new EventEmitter<any>();
  @Output() private docsapprovedEmitter = new EventEmitter<any>();
  @Output() private siteauditapprovalEmitter = new EventEmitter<any>();
  @Input() private from: any = '';
  @Output() pkemit = new EventEmitter<number>(); readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  @ViewChild('ccInput', { static: false }) ccInput: ElementRef<HTMLInputElement>;
  @ViewChild('inputElement') inputElement: ElementRef;
  @ViewChild('myPopover', { static: false }) pop: PopoverDirective;
  @Input('condition') condition: boolean = false;
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
  @Input('buttonName') buttonName: string;
  @Input('submitbutton') submitbutton: string;
  @ViewChild('myEditor') myEditor: any;
  @Output() booleanValue = new EventEmitter<boolean>();
  @Input() international_id: [];
  @Input() staffpopup: boolean = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  @Input() callbackFn: (validForm: any, resetForm: any) => void;
  @Output() shareData: EventEmitter<any> = new EventEmitter();
  @Input('validationPlaceholder') validationPlaceholder: any;
  @Input('submitPlaceholder') submitPlaceholder: any;
  @Input('addClass') addClass: any;
  @Input('dropIcon') dropIcon: boolean = false;
  @Input() public set validatestatus(value: any) {    this.validatestatus_info = value;
    console.log('value', this.validatestatus_info)
  }
 
 
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
      select_valitate: new FormControl(),
      comments: new FormControl(),
    })
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
  
  submitvalidation() {
      this.pop.hide();
      this.resetForm()
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

  submitvalidationnew() {
    let data :any;
    data = {
      'status' : this.validationForm.controls['select_valitate'].value,
      'comments' : this.validationForm.controls['comments'].value,
      'popover' : this.popoverIsOpen
    }
    this.approvedEmitter.emit(data);
  }

  submitvalidationdecline() {
    let data :any;
    data = {
      'status' : this.validationForm.controls['select_valitate'].value,
      'comments' : this.validationForm.controls['comments'].value,
      'popover' : this.popoverIsOpen
    }
    this.declinedEmitter.emit(data);
  }
  
}
