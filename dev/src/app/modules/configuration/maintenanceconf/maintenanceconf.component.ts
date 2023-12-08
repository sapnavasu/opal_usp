import { Component, OnInit } from '@angular/core';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { MatDatepickerInputEvent } from '@angular/material/datepicker';
import { DateAdapter, MAT_DATE_FORMATS } from '@angular/material/core';
import { FormArray, FormBuilder, FormControl, FormGroup, Validators, AbstractControl } from '@angular/forms';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';

@Component({
  selector: 'app-maintenanceconf',
  templateUrl: './maintenanceconf.component.html',
  styleUrls: ['./maintenanceconf.component.scss'],
  providers: [
    {provide: DateAdapter, useClass: AppDateAdapter},
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class MaintenanceconfComponent implements OnInit {

  public Editor = ClassicEditorBuild; /* CK Editor */
  public fullPageLoaders: boolean = false;
  public comments = '';
  public formGroup: FormGroup;
  public ck = new InptLang_Ctrl();
  public contact: string = '';

  get f() { return this.formGroup.controls; }

  i18n(key) {
    return this.translate.instant(key);
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

  constructor(private formBuilder: FormBuilder,private translate: TranslateService, private remoteService: RemoteService,
    private cookieService: CookieService) { }


  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
    { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";

  ngOnInit(): void {
    this.formvalidated();
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
  }

  formvalidated() {
    this.formGroup = this.formBuilder.group({
      description: ['', Validators.required],
      from_date: ['', Validators.required],
      end_date: ['', Validators.required],
      start_time: ['', Validators.required],
      end_time: ['', Validators.required],
    })
  }

  saveFormDetails() {
  }

  cancel(){

  }
  
  updateData(){}
}
