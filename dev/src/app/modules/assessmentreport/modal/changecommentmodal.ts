import { Inject, Component, OnInit, ViewEncapsulation } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { ErrorStateMatcher } from '@angular/material/core';
import { Encrypt } from "@app/common/class/encrypt";
import { AppLocalStorageServices } from "@app/common/localstorage/applocalstorage.services";
import { RegistrationService } from "@app/modules/registration/registration.service";
import { CookieService } from 'ngx-cookie-service';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { MatProgressButtonOptions } from "mat-progress-buttons";
import { ToastrService } from 'ngx-toastr';
import { MatSpinner } from "@angular/material/progress-spinner";
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
@Component({
    selector: "changecommentmodal",
    templateUrl: "changecommentmodal.html",
    styleUrls: ["changecommentmodal.scss"],
    encapsulation: ViewEncapsulation.None
  })
export class changecommentmodal implements OnInit {
  formBuilder: any;
  returndata: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  length = '';
  editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  validationForm: FormGroup;
  public content: string;
  done: boolean = true;
  showField1 = false;
  showField2 = false;
  showField3 = false;
  statustrue = true;
  showField4 = true;
    constructor(public dialogRef: MatDialogRef<changecommentmodal>, public toastr: ToastrService,
       private security: Encrypt,
       private regService: RegistrationService,
       private fb: FormBuilder,
       private applocalstorage: AppLocalStorageServices,
       private translate: TranslateService,
       private remoteService: RemoteService,
       private cookieService: CookieService,
       
        @Inject(MAT_DIALOG_DATA) public data: any) {
          if (data.fieldToShow === 'field1') {
            this.showField1 = true;
          } else if (data.fieldToShow === 'field2') {
            this.showField2 = true;
          }else if(data.fieldToShow === 'field3'){
            this.showField3 = true;
          }else if(data.fieldToShow === 'field4') {
            this.showField4 = true;
          }

         }
        
         languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
         { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
         dir = "ltr"
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
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties',]
          },
          placeholder: "Type the content here!"
        }
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
      this.validForm()
    }
    onChangeeditor(event) {
      this.length_Of_ck = $(this.validationForm.controls['comments'].value).text().length;
      this.comments = $(this.validationForm.controls['comments'].value).text();
      if (this.length_Of_ck > 1000) {
        this.validationForm.setErrors({ 'invalid': true });
        this.validationForm.controls['comments'].setErrors({ 'incorrect': true });
        this.done = true;
      }
    
  
    }
    close() {
      this.validationForm.reset();
      this.techinfo = "";
      this.dialogRef.close({ data: true });
      this.validationForm.controls.status.reset()
    }
    resinfo() {
      this.validationForm.controls['comments'].setValue(``);
      this.techinfo = "";
      this.comments = ``;
      
    }
    validForm() {
      this.validationForm = this.fb.group({
        comments: [''],
        status: ['']
      })
    }
    get f() {
      return this.validationForm.controls;
    }
    editinfo() {
      this.edittechinfo = !this.edittechinfo;
    }
    
    closeModalPopup(): void{
        this.dialogRef.close({ data: true });
        this.resinfo();
        this.validationForm.controls.status.reset()
      }
      messagedone() {
        this.addinfo();
        this.editinfo();
        this.done = false;
      
      }
      addinfo() {
        this.techinfo = this.validationForm.controls['comments'].value;
      }
      submitted() {
        this.returndata = $(this.validationForm.controls['comments'].value).text();
        this.resinfo();
        this.dialogRef.close({ data: this.returndata });
        this.validationForm.controls.status.reset()
      }
      statusupdatevalue(value) {
        value = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
          if(value == value) {
            this.statustrue = false;
          }else {
            // console.log(23456789)
            this.statustrue = true;

          }
      }
}