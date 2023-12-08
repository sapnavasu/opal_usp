import { Component, OnInit, Input, Output, ViewChild, EventEmitter } from '@angular/core';
import { SlideInOutAnimation } from '../animation';
import { SEMICOLON, COMMA } from '@angular/cdk/keycodes';
import { FormGroup, Validators, FormBuilder, FormControl, FormArray } from '@angular/forms';
import { RegistrationService } from '@app/modules/registration/registration.service';
import { Inviteuserdialog } from '../modal/inviteuserdialog';
import swal from 'sweetalert';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { BgiJsonconfigServices } from '@app/config/BGIConfig/bgi-jsonconfig-services'; 
import { MatDrawer } from '@angular/material/sidenav';
import { ErrorStateMatcher } from '@angular/material/core';
import { MatDialog } from '@angular/material/dialog';
import { MatChipInputEvent } from '@angular/material/chips';
import {ToastrService} from 'ngx-toastr';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-inviteuser',
  templateUrl: './inviteuser.component.html',
  styleUrls: ['./inviteuser.component.scss'],
  animations: [SlideInOutAnimation]
})
export class InviteuserComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  public bgiConfigJson = BgiJsonconfigServices.bgiConfigData.configuration;
  public projectName: string;
  @Input() logoUrl: string;
  @Input('inviteuser') inviteuser: MatDrawer;
  @Input() companyName: string;
  @Input() lypisID: string;
  @Output() closeAddSlider: any = new EventEmitter<any>();
  animationState: string = 'out';
  matcher: ErrorStateMatcher = new ErrorStateMatcher();  
  visible = true;
  selectable = true;
  removable = true;
  emails: string[] = [];
  disableSendButton: boolean = false;
  heading: boolean = false;
  showResponsiveLoader = false;
  emailFormControl: FormControl = new FormControl(null, Validators.compose([Validators.required]));
  // invitContent: FormControl = new FormControl(null, null);

  readonly separatorKeysCodes: number[] = [SEMICOLON, COMMA];
  @ViewChild('inviteuser') inviteuserDrawer: MatDrawer;
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
        'imageUpload',
        '|',
        'link',
        '|',
        'blockquote',
        '|',
        'insertTable',
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
    placeholder: 'Type the content here!'
}
  public Editor = ClassicEditorBuild;

  @Output() reloadInviteUser: any = new EventEmitter<any>();

  constructor(private regService: RegistrationService,
    private translate : TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private formBuilder: FormBuilder,public toastr: ToastrService,
    private dialog: MatDialog,
    ) { 
    }

    languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr" 

  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
  }); 
    this.projectName=this.bgiConfigJson.projectName;
  }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentuserrole') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  sendInvite() {
    if (this.emails.length > 0) {
      this.disableSendButton = this.showResponsiveLoader = true;
      this.regService.inviteUser(this.emails).subscribe(data => {
        // this.emailForm.reset();
        this.showResponsiveLoader = false;
        this.openDialog(data['data']);
        this.resetForm();
        this.closeAddSlider.emit(true);
      })
    }
  }

  add(event: MatChipInputEvent): void {
    const input = event.input;
    const value = event.value;

    // Add our fruit
    if ((value || '').trim()) {
      this.emails.push(value.trim());
    }

    // Reset the input value
    if (input) {
      input.value = '';
    }
  }

  remove(fruit: any): void {
    const index = this.emails.indexOf(fruit);

    if (index >= 0) {
      this.emails.splice(index, 1);
    }
  }

  openDialog(data): void {
    //  data = { 
    //     "totalEmails": 9,
    //     "sentEmails": ['rfdfd@rest.com','resrtes@rest.com'],
    //     "activeEmailArrInSameCompany": ['manikandan@businessgateways.com', 'rest@test.com','nest@twosttetdtr.com'], 
    //     "activeEmailArrInAnotherCompany": ['manikandan@businessgateways.com', 'rest@test.com','nest@twosttetdtr.com'], 
    //     "alreadyInvitedAndActiveEmailArrInSameCompany": ['manikandan@businessgateways.com', 'rest@test.com','nest@twosttetdtr.com'], 
    //     "alreadyInvitedAndActiveEmailArrInAnotherCompany": ['manikandan@businessgateways.com', 'rest@test.com','nest@twosttetdtr.com'], 
    //     "alreadyInvitedAndExpiredEmailArr": ['manikandan@businessgateways.com', 'rest@test.com','nest@twosttetdtr.com'], 
    //     "inactiveSameCompanyEmails": [], 
    //     "invalidEmails": [], 
    //     "duplicateEmails": []
    // };
    let dialogRef = this.dialog.open(Inviteuserdialog, { disableClose: true, data: data });
    dialogRef.afterClosed().subscribe(result => {

    });
  }

  showSweetAlert() {
    if ((this.emails.length == 0 && this.emailFormControl.value !== '' && this.emailFormControl.touched) ||
      (this.emails.length > 0 || this.emailFormControl.value !== '' && this.emailFormControl.touched)) {
      swal({
        title:this.i18n('enterpriseadmin.doyuuwanttoinvi'),
        text: this.i18n('enterpriseadmin.ifyesany'),
        icon: 'warning',
        buttons: [this.i18n('enterpriseadmin.canc'), this.i18n('enterpriseadmin.ok')],
        dangerMode: true,
      }).then((willGoBack) => {
        if (willGoBack) {
          this.resetForm();
          this.animationState='out';
        }
      })
    } else {
      this.resetForm();
      this.animationState='out';
    }

  }
  showSuccess(){
    this.toastr.success(this.i18n('enterpriseadmin.succ'), this.i18n('enterpriseadmin.delesucc'), {
        timeOut: 3000,
        closeButton: true,
    });
}
  resetForm(resetFor = '') {
    if (resetFor == '') {
      this.inviteuser.toggle();
    }
    this.emails = [];
    this.disableSendButton = false;
    this.emailFormControl.reset();
    this.emailFormControl.setValue('');
    // this.invitContent.setValue('');
    this.animationState = 'out';
  }

}
