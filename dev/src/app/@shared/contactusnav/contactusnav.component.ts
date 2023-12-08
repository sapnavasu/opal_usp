import { COMMA, ENTER, I } from '@angular/cdk/keycodes';
import { Component, ElementRef, EventEmitter, Input, OnInit, Output, SimpleChanges, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { MatAutocomplete, MatAutocompleteSelectedEvent } from '@angular/material/autocomplete';
import { MatChipInputEvent } from '@angular/material/chips';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatDrawer } from '@angular/material/sidenav';
import { UploadAdapter } from '@app/common/class/adaptor';
import { DriveInput } from '@app/common/classes/driveInput';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { Observable } from 'rxjs';
import { map, startWith } from 'rxjs/operators';
import swal from 'sweetalert';
import { Filee } from '../filee/filee';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

export interface Ccmembers {
  name: any;
}
export interface Queries {
  value: string;
  viewValue: string;
}
export interface Contactdoc {
  filePath: string;
  fileName: string;
}
@Component({
  selector: 'app-contactusnav',
  templateUrl: './contactusnav.component.html',
  styleUrls: ['./contactusnav.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None
})
export class ContactusnavComponent implements OnInit {
  aboutsuccess: boolean = false;
  i18n(key) {
    return this.translate.instant(key);
  }

  public mailcccnt: number = BgiJsonconfigServices.bgiConfigData.configuration.ccmailcount;
  @Output() closedialogcontact: any = new EventEmitter<any>();
  visible = true;
  public ck = new InptLang_Ctrl();
  selectable = true;
  removable = true;
  addOnBlur = true;
  emailvalue = false;
  readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  ccCtrl = new FormControl('', [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]);
  filteredCCs: Observable<string[]>;
  ccmails: any[] = [];
  allCC: string[] = [];
  filePks: number[] = [];
  formSubject: string= '';
  // allCC: string[] = ['bakthavachalam@businessgateways.com', 'sathya@gmail.com', 'newuser@gmail.com', 'anotheruser@gmail.com', 'check@gmail.com'];
  @ViewChild('ccInput', { static: false }) ccInput: ElementRef<HTMLInputElement>;
  @ViewChild('auto') matAutocomplete: MatAutocomplete;
  ccmememberlist: Ccmembers[] = [

  ];

  add(event: MatChipInputEvent): void {
    if (!this.matAutocomplete.isOpen) {
      const input = event.input;
      const value = event.value;

      if (this.ccmails.length < this.mailcccnt) {
        if (this.validateEmail(event.value) && !this.ccmails.includes(value.trim())) {
          if ((value || '').trim()) {
            this.ccmails.push(value.trim());
          }
        } else {
          this.emailvalue = true;
        }
      }
      // Reset the input value
      if (input) {
        input.value = '';
      }

      this.ccCtrl.setValue(null);
    }
  }
  public stakeHolderType: any;
  remove(ccmail: string): void {
    const index = this.ccmails.indexOf(ccmail);

    if (index >= 0) {
      this.ccmails.splice(index, 1);
      this.validatemsg = '';
    }
  }

  public validatemsg: any = '';
  selected(event: MatAutocompleteSelectedEvent): void {
    if (this.ccmails.length < this.mailcccnt) {
      this.validatemsg = '';
      if (!this.ccmails.includes(event.option.viewValue)) {
        this.ccmails.push(event.option.viewValue);
        this.ccInput.nativeElement.value = '';
        this.ccCtrl.setValue(null);
      }
    }
    else {
      this.validatemsg = this.i18n('tscontactusnav.youcanonly');
    }
  }

  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.allCC.filter(ccmail => ccmail.toLowerCase().indexOf(filterValue) === 0);
  }
  public lang: number;
  animationState = 'out';
  @Input('drawercontactus') drawercontactus: MatDrawer;
  @Input() contactusData: any = [];
  @Input() subjectdataload: number = 0;
  @Input() scfcontactdata: number = 0;
  @Input() contactussubjectext: any;
  @Input() triggerFrom: any;
  public contact = '';
  @ViewChild(Filee) filee: Filee;
  drv_contactus: DriveInput;
  contactusForm: FormGroup;
  contactusSubmitted: boolean = false;
  leftSideSpinner: boolean = false;
  public edittechinfo = false;
  public techinfo = "";
  submitted = false;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  queries: any = [];
  drv_mcpcontactus: DriveInput;
  contactdocs: Contactdoc[] = [
    { filePath: '', fileName: 'screenshot_one.Jpeg' },
    { filePath: '', fileName: 'screenshot_two.Jpeg' },
    { filePath: '', fileName: 'screenshot_three.Jpeg' },
  ];
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
  constructor(
    private fb: FormBuilder,
    private formBuilder: FormBuilder,
    private profileservice: ProfileService, private localstorageservice: AppLocalStorageServices,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) {
    this.onFileupload = this.onFileupload.bind(this);
    this.filteredCCs = this.ccCtrl.valueChanges.pipe(
      startWith(null),
      map((ccmail: string | null) => ccmail ? this._filter(ccmail) : this.allCC.slice()));
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
      { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  editinfo() {
    this.edittechinfo = !this.edittechinfo;
  }
  resinfo() {
    this.contactusForm.controls['about'].reset();
    this.techinfo = "";
  }
  addinfo() {
    this.techinfo = this.contactusForm.controls['about'].value;
  }

  messagedone() {
    this.addinfo();
    this.editinfo();
    this.aboutsuccess = true;
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }
  ngOnInit() {
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.config.placeholder = 'Type the content here!';
        } else {
          this.config.placeholder = "اكتب المحتوى هنا!";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.config.placeholder = 'Type the content here!';
      }
    });
    this.getMasterData();
    this.getAdminccData();
    this.stakeHolderType = this.localstorageservice.getInLocal('reg_type');
    this.contactusForm = this.formBuilder.group({
      companyName: ['', Validators.required],
      personName: ['', Validators.required],
      typeofQuery: ['3', Validators.required],
      subJect: ['', Validators.required],
      about: ['', Validators.required],
      emailId: ['', [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      contactusdoc: ['', ''],
      ccMembers: ['', [Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
    });
    if (this.contactusForm) {
      this.contactusForm.controls['companyName'].setValue(this.contactusData?.companyname);
      this.contactusForm.controls['personName'].setValue(this.contactusData?.username);
      this.contactusForm.controls['emailId'].setValue(this.contactusData?.useremail);
      this.contactusForm.controls['subJect'].setValue(this.contactusData?.subject);
    }
    if (this.subjectdataload == 1) {
      this.contactusForm.controls['companyName'].disable();
      this.contactusForm.controls['personName'].disable();
      this.contactusForm.controls['emailId'].disable();
      this.contactusForm.controls['subJect'].disable();
      this.contactusForm.controls['typeofQuery'].disable();
      this.contactusForm.controls['typeofQuery'].setValue('3');
    }
    else {
      this.contactusForm.controls['companyName'].enable();
      this.contactusForm.controls['personName'].enable();
      this.contactusForm.controls['emailId'].enable();;
      this.contactusForm.controls['subJect'].enable();
      this.contactusForm.controls['typeofQuery'].enable();
      this.contactusForm.controls['typeofQuery'].setValue('1');
    }
    this.drv_mcpcontactus = {
      fileMstPk: 93,
      selectedFilesPk: []
    }
    this.contactusForm.controls['subJect'].setValue('  ');
    this.contactusSubmitted = false;
  }

  contactsubjectenabled() {
    this.contactusForm.controls['subJect'].enable();
    this.contactusForm.controls['typeofQuery'].enable();
  }
  ngOnChanges(changes: SimpleChanges) {
    if (this.contactusForm) {
      console.log('changes')
      this.contactusForm.controls['companyName'].setValue(this.contactusData.companyname);
      this.contactusForm.controls['personName'].setValue(this.contactusData.username);
      this.contactusForm.controls['emailId'].setValue(this.contactusData.useremail);
      this.contactusForm.controls['subJect'].setValue(this.contactusData.subject);
      if (this.contactusData?.typeofQuery == 3) {
        this.contactusForm.controls['typeofQuery'].setValue('3');
      }
    }
  }
  get f() { return this.contactusForm.controls; }
  clearform() {
    this.contactusForm.controls['typeofQuery'].reset();
    this.contactusForm.controls['subJect'].reset();
    this.contactusForm.controls['about'].reset();
    if (this.subjectdataload == 1) {
      this.contactusForm.controls['typeofQuery'].setValue('3');
    }
    else {
      this.contactusForm.controls['typeofQuery'].setValue('1');
    }
    this.contactusForm.controls['subJect'].setValue(this.contactusData.subject);
    this.contactusForm.controls['companyName'].setValue(this.contactusData.companyname);
    this.contactusForm.controls['personName'].setValue(this.contactusData.username);
    this.contactusForm.controls['emailId'].setValue(this.contactusData.useremail);
    this.ccmails = [];
    this.resinfo();
  }
  getMasterData() {
    this.profileservice.getContactUsMaster().subscribe(returndata => {
      this.queries = returndata.data['data'];
    });
  }
  getAdminccData() {
    this.profileservice.getContactUsccdata().subscribe(returndata => {
      this.allCC = returndata.data['data'];
    });
  }

  onSubjectChange(event) {
    this.contactusForm.controls['subJect'].setValue(event.target.value)
  }

  onSubmit() {
    this.submitted = true;
    // stop here if form is invalid
    this.leftSideSpinner = true;
    this.contactusForm.controls['companyName'].enable();
    this.contactusForm.controls['personName'].enable();
    this.contactusForm.controls['emailId'].enable();
    this.contactusForm.controls['subJect'].enable();
    this.contactusForm.controls['typeofQuery'].enable();
    this.contactusForm.controls['contactusdoc'].setValue(this.filePks);
    console.log(this.contactusForm , 'testuuuu');
    this.profileservice.saveContactus(this.contactusForm.value, this.ccmails).subscribe(resdata => {
      this.contactusSubmitted = true;
      this.leftSideSpinner = false;
      
      if (resdata.success) {
        this.aboutsuccess = false;
        this.contactusForm.controls['subJect'].reset();
        this.contactusForm.controls['about'].reset();
        this.drv_mcpcontactus.selectedFilesPk = [];
        this.contact = '';
        this.drv_mcpcontactus.selectedFilesPk.length = 0;
      }
    });
    if (this.contactusForm.invalid) {
      return;
    }
  }
  @ViewChild('inputElement') inputElement: ElementRef;
  onInput(event: Event): void {
    const input = event.target as HTMLTextAreaElement;
    input.style.height = 'auto';
    input.style.height = input.scrollHeight + 'px';
  }
  closeSide() {
    this.contactusForm.controls['subJect'].reset();
    if (!this.contactusSubmitted && this.contactusForm.touched) {
      swal({
        title: this.i18n('tscontactusnav.doyouwnatcan'),
        text: this.i18n('tscontactusnav.allthedatathatyou'),
        icon: 'warning',
        buttons: [this.i18n('tscontactusnav.no'), this.i18n('tscontactusnav.yes')],
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
      }).then((willGoBack) => {
        if (willGoBack) {
          this.aboutsuccess = false;
          this.closedialogcontact.emit();
          this.clearform();
          this.messagedone();
          this.drawercontactus.toggle();
          this.animationState = 'out';
          this.contactusSubmitted = false;
          this.ccmails = [];
          this.contactusForm.controls['about']?.setValue('');
          this.contact = '';
          this.drv_mcpcontactus.selectedFilesPk.length = 0;
          if (this.subjectdataload == 1) {
            this.contactusForm.controls['typeofQuery'].setValue('3');
          }
          else {
            this.contactusForm.controls['typeofQuery'].setValue('1');
          }
          this.contactusForm.controls['subJect'].setValue(this.contactusData.subject);
        }
      });
    } else {
      this.clearform();
      this.animationState = 'out';
      this.drawercontactus.toggle();
      this.closedialogcontact.emit();
      this.contactusSubmitted = false;
    }
    this.ngOnInit();
    this.filePks = [];
    this.contactusForm.controls['contactusdoc'].setValue('');
    this.length_Of_ck = 0;
  }
  closesider() {
    this.clearform();
    this.contactusForm.controls['typeofQuery'].reset();
    this.contactusForm.controls['subJect'].reset();
    this.contactusForm.controls['about'].reset();
    this.aboutsuccess = false;
    if (this.subjectdataload == 1) {
      this.contactusForm.controls['typeofQuery'].setValue('3');
    }
    else {
      this.contactusForm.controls['typeofQuery'].setValue('1');
    }
    this.contactusForm.controls['subJect'].setValue(this.contactusData.subject);
    this.contactusForm.controls['companyName'].setValue(this.contactusData.companyname);
    this.contactusForm.controls['personName'].setValue(this.contactusData.username);
    this.contactusForm.controls['emailId'].setValue(this.contactusData.useremail);
    this.animationState = 'out';
    this.drawercontactus.toggle();
    this.closedialogcontact.emit();
    this.contactusSubmitted = false;

  }
  toggleShowDiv(divName: string) {
    if (divName === 'contactusinfo') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
  public length_Of_ck = 0;
  public about = '';
  onChangeeditor(event) {
    this.length_Of_ck = $(this.contactusForm.controls['about'].value).text().length;
    this.about = $(this.contactusForm.controls['about'].value).text();
    if (this.length_Of_ck > 5000) {
      this.contactusForm.setErrors({ 'invalid': true });
      this.contactusForm.controls['about'].setErrors({ 'incorrect': true });
      this.aboutsuccess = false;
    }

  }
  checkfile(files, filepk) {
    if (filepk == 4) {
      let value = JSON.stringify(files);
      console.log(value);
      this.f.contact_us.setValue(value);
      this.f.contact_us.updateValueAndValidity();
    }

    if (filepk == 2) {
      let value = JSON.stringify(files);
      console.log(value);
      this.f.cr_activity.setValue(value);
      this.f.cr_activity.updateValueAndValidity();
    }


  }
  onReady(eventData: any, filePath?: any) {
    eventData.plugins.get('FileRepository').createUploadAdapter = function (loader: any) {
      return new UploadAdapter(loader, filePath);
    };
  }
  private validateEmail(email) {
    email = email.replace(/\s/g, '');
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  onFileupload(files) {
    this.filePks = files;
    if(this.filePks.length >=2){
     $('#file').attr('disabled', 'disabled');
    }else{
      $('#file').removeAttr('disabled');

    }
  }

}
